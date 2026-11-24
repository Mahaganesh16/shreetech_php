const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9235',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-verify-profile',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9235/json', (res) => {
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

  // Apply optimizations
  await send('Runtime.evaluate', {
    expression: `(() => {
      // 1. Lenis class name thrashing stopped
      if (window.__lenis) {
        window.__lenis.updateClassName = () => {};
        window.__lenis.options.lerp = 0.16;
        window.__lenis.options.wheelMultiplier = 1.15;
      }

      // 2. CSS scroll background and reduced blur
      const s = document.createElement('style');
      s.textContent = \`
        body { background-attachment: scroll !important; }
        .glass-card {
          backdrop-filter: blur(10px) saturate(140%) !important;
          -webkit-backdrop-filter: blur(10px) saturate(140%) !important;
          background: rgba(255, 255, 255, 0.94) !important;
        }
        .fixed { transform: translateZ(0); will-change: transform; }
      \`;
      document.head.appendChild(s);
    })()`
  });

  await new Promise(r => setTimeout(r, 400));

  // Measure continuous wheel scroll
  const res = await send('Runtime.evaluate', {
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

      // Scroll across 4000px using Lenis over 2.5 seconds
      const start = performance.now();
      while (performance.now() - start < 2000) {
        const p = (performance.now() - start) / 2000;
        if (window.__lenis) {
          window.__lenis.scrollTo(p * 4500, { immediate: true });
        } else {
          window.scrollTo(0, p * 4500);
        }
        await new Promise(r => setTimeout(r, 16));
      }

      active = false;
      const avg = frameDeltas.reduce((a, b) => a + b, 0) / frameDeltas.length;
      const smoothFrames = frameDeltas.filter(d => d <= 25);
      const jankFrames = frameDeltas.filter(d => d > 40);

      resolve({
        totalFrames: frameDeltas.length,
        avgFps: (1000 / avg).toFixed(1),
        avgFrameTime: avg.toFixed(1) + 'ms',
        smoothRatio: ((smoothFrames.length / frameDeltas.length) * 100).toFixed(0) + '%',
        jankFramesCount: jankFrames.length,
        worstFrameMs: Math.max(...frameDeltas).toFixed(1) + 'ms'
      });
    })`,
    awaitPromise: true,
    returnByValue: true
  });

  console.log('FINAL BENCHMARK TEST:', res.result.value);

  ws.close();
  chrome.kill();
}

main().catch(console.error);
