const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9236',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-wheel-profile',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9236/json', (res) => {
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
          backdrop-filter: blur(8px) !important;
          -webkit-backdrop-filter: blur(8px) !important;
          background: rgba(255, 255, 255, 0.95) !important;
        }
        .fixed { transform: translateZ(0); will-change: transform; }
      \`;
      document.head.appendChild(s);
    })()`
  });
  await new Promise(r => setTimeout(r, 500));

  // Measure RAF rate during actual wheel events
  await send('Runtime.evaluate', {
    expression: `(() => {
      window.__fpsData = [];
      let last = performance.now();
      window.__rafCounter = (now) => {
        window.__fpsData.push(now - last);
        last = now;
        requestAnimationFrame(window.__rafCounter);
      };
      requestAnimationFrame(window.__rafCounter);
    })()`
  });

  console.log('Dispatching 15 natural mouse wheel events...');
  for (let i = 0; i < 15; i++) {
    await send('Input.dispatchMouseEvent', {
      type: 'mouseWheel',
      x: 700,
      y: 400,
      deltaX: 0,
      deltaY: 100
    });
    await new Promise(r => setTimeout(r, 80));
  }

  await new Promise(r => setTimeout(r, 600));

  const fpsRes = await send('Runtime.evaluate', {
    expression: `(() => {
      const deltas = window.__fpsData;
      const avg = deltas.reduce((a, b) => a + b, 0) / deltas.length;
      const slow = deltas.filter(d => d > 25);
      return {
        totalFrames: deltas.length,
        avgFps: (1000 / avg).toFixed(1),
        avgFrameTime: avg.toFixed(1) + 'ms',
        slowFramesCount: slow.length,
        worstFrameMs: Math.max(...deltas).toFixed(1) + 'ms',
        scrollY: window.scrollY
      };
    })()`,
    returnByValue: true
  });

  console.log('REAL MOUSE WHEEL BENCHMARK:', fpsRes.result.value);

  ws.close();
  chrome.kill();
}

main().catch(console.error);
