const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9232',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-opt-measure',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9232/json', (res) => {
      let data = '';
      res.on('data', chunk => data += chunk);
      res.on('end', () => resolve(JSON.parse(data)));
    }).on('error', reject);
  });

  const page = json.find(t => t.url.includes('shreetech-php'));
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise(r => ws.onopen = r);

  let id = 1;
  function send(method, params = {}) {
    return new Promise(resolve => {
      const reqId = id++;
      const handler = (event) => {
        const resp = JSON.parse(event.data);
        if (resp.id === reqId) {
          ws.removeEventListener('message', handler);
          resolve(resp.result);
        }
      };
      ws.addEventListener('message', handler);
      ws.send(JSON.stringify({ id: reqId, method, params }));
    });
  }

  await send('Emulation.setDeviceMetricsOverride', { width: 1440, height: 900, deviceScaleFactor: 1, mobile: false });
  await new Promise(r => setTimeout(r, 800));

  // Apply optimizations in browser
  await send('Runtime.evaluate', {
    expression: `(() => {
      // 1. Prevent Lenis from modifying html.className during scroll
      if (window.__lenis) {
        window.__lenis.updateClassName = () => {};
      }

      // 2. Body background scroll instead of fixed
      document.body.style.backgroundAttachment = 'scroll';

      // 3. Watermark GPU isolation
      const wm = document.querySelector('.fixed.inset-x-0.top-20');
      if (wm) {
        wm.style.transform = 'translateZ(0)';
        wm.style.willChange = 'transform';
      }

      // 4. Header GPU isolation
      const hdr = document.querySelector('header');
      if (hdr) {
        hdr.style.transform = 'translateZ(0)';
      }
    })()`
  });

  // Now measure smooth scroll performance over 2 seconds
  const result = await send('Runtime.evaluate', {
    expression: `new Promise(async (resolve) => {
      let frameDeltas = [];
      let lastTime = performance.now();
      let active = true;

      function onRaf(now) {
        if (!active) return;
        frameDeltas.push(now - lastTime);
        lastTime = now;
        requestAnimationFrame(onRaf);
      }
      requestAnimationFrame(onRaf);

      const maxScroll = 4000;
      const duration = 2000;
      const startTime = performance.now();

      while (performance.now() - startTime < duration) {
        const elapsed = performance.now() - startTime;
        const target = (elapsed / duration) * maxScroll;
        window.scrollTo(0, target);
        await new Promise(r => requestAnimationFrame(r));
      }

      active = false;
      const avg = frameDeltas.reduce((a, b) => a + b, 0) / frameDeltas.length;
      const jank = frameDeltas.filter(d => d > 33);
      const smooth = frameDeltas.filter(d => d <= 20);

      resolve({
        totalFrames: frameDeltas.length,
        avgFps: (1000 / avg).toFixed(1),
        avgFrameTime: avg.toFixed(1) + 'ms',
        smoothFramesPercent: ((smooth.length / frameDeltas.length) * 100).toFixed(1) + '%',
        jankFrames: jank.length,
        worstFrameMs: Math.max(...frameDeltas).toFixed(1) + 'ms'
      });
    })`,
    awaitPromise: true,
    returnByValue: true
  });

  console.log('OPTIMIZED BENCHMARK RESULT:', result.result.value);

  ws.close();
  chrome.kill();
}

main().catch(console.error);
