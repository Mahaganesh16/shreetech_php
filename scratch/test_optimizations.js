const { spawn } = require('child_process');
const http = require('http');

async function testVariant(label, code) {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9228',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-perf-opt',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9228/json', (res) => {
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

  if (code) {
    await send('Runtime.evaluate', { expression: code });
    await new Promise(r => setTimeout(r, 500));
  }

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
        await new Promise(r => setTimeout(r, 16));
      }

      active = false;
      const avg = frameDeltas.reduce((a, b) => a + b, 0) / frameDeltas.length;
      const jank = frameDeltas.filter(d => d > 33);

      resolve({
        label: '${label}',
        totalFrames: frameDeltas.length,
        avgFps: (1000 / avg).toFixed(1),
        avgFrameTime: avg.toFixed(1) + 'ms',
        jankFrames: jank.length,
        worstFrameMs: Math.max(...frameDeltas).toFixed(1) + 'ms'
      });
    })`,
    awaitPromise: true,
    returnByValue: true
  });

  console.log(result.result.value);
  ws.close();
  chrome.kill();
}

async function run() {
  await testVariant('Current Baseline', '');
  await testVariant('Fix 1: Body background-attachment scroll', `
    document.body.style.backgroundAttachment = 'scroll';
  `);
  await testVariant('Fix 2: Body bg scroll + remove backdrop-filter on cards', `
    document.body.style.backgroundAttachment = 'scroll';
    const s = document.createElement('style');
    s.textContent = '.glass-card, .glass-card-spotlight, section { backdrop-filter: none !important; -webkit-backdrop-filter: none !important; }';
    document.head.appendChild(s);
  `);
  await testVariant('Fix 3: Fix 2 + isolate watermark with GPU layer', `
    document.body.style.backgroundAttachment = 'scroll';
    const s = document.createElement('style');
    s.textContent = \`
      .glass-card, .glass-card-spotlight, section { backdrop-filter: none !important; -webkit-backdrop-filter: none !important; }
      .fixed { will-change: transform; transform: translateZ(0); }
    \`;
    document.head.appendChild(s);
  `);
}

run().catch(console.error);
