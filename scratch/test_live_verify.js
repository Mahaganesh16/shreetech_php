const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9237',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-wheel-profile-verify',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9237/json', (res) => {
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
  await new Promise(r => setTimeout(r, 1000));

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
    await new Promise(r => setTimeout(r, 70));
  }

  await new Promise(r => setTimeout(r, 600));

  const fpsRes = await send('Runtime.evaluate', {
    expression: `(() => {
      const deltas = window.__fpsData;
      const avg = deltas.reduce((a, b) => a + b, 0) / deltas.length;
      return {
        totalFrames: deltas.length,
        avgFps: (1000 / avg).toFixed(1),
        avgFrameTime: avg.toFixed(1) + 'ms',
        worstFrameMs: Math.max(...deltas).toFixed(1) + 'ms',
        scrollY: window.scrollY,
        htmlClasses: document.documentElement.className,
        pinTrackHeight: document.getElementById('projects-pin-track')?.offsetHeight
      };
    })()`,
    returnByValue: true
  });

  console.log('LIVE MEASUREMENT:', fpsRes.result.value);

  ws.close();
  chrome.kill();
}

main().catch(console.error);
