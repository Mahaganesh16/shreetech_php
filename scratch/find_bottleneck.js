const { spawn } = require('child_process');
const http = require('http');

async function testCondition(name, setupCode) {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9226',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-perf-profile-test',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9226/json', (res) => {
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

  if (setupCode) {
    await send('Runtime.evaluate', { expression: setupCode });
  }

  const fpsData = await send('Runtime.evaluate', {
    expression: `new Promise((resolve) => {
      let frames = [];
      let lastTime = performance.now();
      let animId;

      function measure(now) {
        frames.push(now - lastTime);
        lastTime = now;
        animId = requestAnimationFrame(measure);
      }
      animId = requestAnimationFrame(measure);

      const startTime = performance.now();
      const startScroll = window.scrollY;
      const targetScroll = 3000;

      const scrollInterval = setInterval(() => {
        const elapsed = performance.now() - startTime;
        if (elapsed >= 1500) {
          clearInterval(scrollInterval);
          cancelAnimationFrame(animId);
          const longFrames = frames.filter(f => f > 33);
          const avgFps = 1000 / (frames.reduce((a, b) => a + b, 0) / frames.length);
          resolve({
            name: '${name}',
            totalFrames: frames.length,
            longFramesCount: longFrames.length,
            avgFps: Math.round(avgFps),
            maxFrameTimeMs: Math.round(Math.max(...frames))
          });
        } else {
          window.scrollTo(0, startScroll + (targetScroll - startScroll) * (elapsed / 1500));
        }
      }, 16);
    })`,
    awaitPromise: true,
    returnByValue: true
  });

  console.log(fpsData.result.value);

  ws.close();
  chrome.kill();
}

async function runAll() {
  // Test 1: baseline native scroll
  await testCondition('Baseline Native Scroll', '');

  // Test 2: without background-attachment fixed
  await testCondition('No background-attachment: fixed', `
    document.body.style.backgroundAttachment = 'scroll';
  `);

  // Test 3: without backdrop-filter
  await testCondition('No backdrop-filter + scroll bg', `
    document.body.style.backgroundAttachment = 'scroll';
    const s = document.createElement('style');
    s.textContent = '* { backdrop-filter: none !important; -webkit-backdrop-filter: none !important; }';
    document.head.appendChild(s);
  `);

  // Test 4: without scroll listeners
  await testCondition('No scroll listeners (removeAll)', `
    if (window.__lenis) {
      window.__lenis.emitter.events = {};
    }
  `);
}

runAll().catch(console.error);
