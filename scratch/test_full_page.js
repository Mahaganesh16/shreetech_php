const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9227',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-perf-profile-4',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9227/json', (res) => {
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

  await send('Emulation.setDeviceMetricsOverride', {
    width: 1440,
    height: 900,
    deviceScaleFactor: 1,
    mobile: false
  });

  await new Promise(r => setTimeout(r, 1000));

  // Measure FPS during smooth wheel scroll through each 1000px segment
  const totalHeightRes = await send('Runtime.evaluate', { expression: 'document.documentElement.scrollHeight' });
  const totalHeight = totalHeightRes.result.value;
  console.log('Total document height:', totalHeight);

  // Dispatch wheel events and measure frame intervals
  const testResults = await send('Runtime.evaluate', {
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

      // Simulate natural wheel scroll down the entire page over 4 seconds
      const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
      const duration = 4000;
      const startTime = performance.now();

      while (performance.now() - startTime < duration) {
        const elapsed = performance.now() - startTime;
        const target = (elapsed / duration) * maxScroll;
        window.scrollTo(0, target);
        await new Promise(r => setTimeout(r, 16));
      }

      active = false;
      const slow = frameDeltas.filter(d => d > 25);
      const jank = frameDeltas.filter(d => d > 50);
      const avg = frameDeltas.reduce((a, b) => a + b, 0) / frameDeltas.length;

      resolve({
        totalFrames: frameDeltas.length,
        avgFrameTime: avg.toFixed(2),
        avgFps: (1000 / avg).toFixed(1),
        slowFrames: slow.length,
        jankFrames: jank.length,
        worstFrameMs: Math.max(...frameDeltas).toFixed(1)
      });
    })`,
    awaitPromise: true,
    returnByValue: true
  });

  console.log('FULL PAGE SCROLL BENCHMARK:', testResults.result.value);

  ws.close();
  chrome.kill();
}

main().catch(console.error);
