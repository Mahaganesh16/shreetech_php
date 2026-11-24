const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9225',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-perf-profile',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9225/json', (res) => {
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

  // Enable performance metrics
  await send('Performance.enable');

  // Measure scrolling FPS and frame times
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

      // Scroll smoothly down the page over 3 seconds
      const startTime = performance.now();
      const startScroll = window.scrollY;
      const targetScroll = 4000;

      const scrollInterval = setInterval(() => {
        const elapsed = performance.now() - startTime;
        if (elapsed >= 2500) {
          clearInterval(scrollInterval);
          cancelAnimationFrame(animId);
          const longFrames = frames.filter(f => f > 33); // frames taking > 33ms (< 30fps)
          const avgFps = 1000 / (frames.reduce((a, b) => a + b, 0) / frames.length);
          resolve({
            totalFrames: frames.length,
            longFramesCount: longFrames.length,
            avgFps: Math.round(avgFps),
            maxFrameTimeMs: Math.round(Math.max(...frames)),
            sampleFrameTimes: frames.slice(0, 30).map(f => Math.round(f))
          });
        } else {
          // Trigger Lenis or native scroll
          if (window.__lenis) {
            window.__lenis.scrollTo(startScroll + (targetScroll - startScroll) * (elapsed / 2500), { immediate: true });
          } else {
            window.scrollTo(0, startScroll + (targetScroll - startScroll) * (elapsed / 2500));
          }
        }
      }, 16);
    })`,
    awaitPromise: true,
    returnByValue: true
  });

  console.log('PERF METRICS CURRENT:', fpsData.result.value);

  ws.close();
  chrome.kill();
}

main().catch(console.error);
