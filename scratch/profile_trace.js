const { spawn } = require('child_process');
const http = require('http');
const fs = require('fs');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9229',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-trace-profile',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9229/json', (res) => {
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

  let traceEvents = [];
  ws.addEventListener('message', (event) => {
    const data = JSON.parse(event.data);
    if (data.method === 'Tracing.dataCollected') {
      traceEvents.push(...data.params.value);
    }
  });

  await send('Tracing.start', {
    categories: '-*,devtools.timeline,disabled-by-default-devtools.timeline,blink.user_timing,v8.execute'
  });

  // Scroll down page
  await send('Runtime.evaluate', {
    expression: `new Promise(async (resolve) => {
      const startTime = performance.now();
      while (performance.now() - startTime < 1500) {
        const p = (performance.now() - startTime) / 1500;
        window.scrollTo(0, p * 4000);
        await new Promise(r => requestAnimationFrame(r));
      }
      resolve();
    })`,
    awaitPromise: true
  });

  await send('Tracing.end');
  await new Promise(r => setTimeout(r, 1000));

  // Aggregate time spent by event name
  const durations = {};
  for (const e of traceEvents) {
    if (e.dur) {
      durations[e.name] = (durations[e.name] || 0) + e.dur;
    }
  }

  // Sort descending
  const sorted = Object.entries(durations)
    .sort((a, b) => b[1] - a[1])
    .slice(0, 15)
    .map(([name, dur]) => ({ name, durationMs: Math.round(dur / 1000) }));

  console.log('TRACE TOP EXPENSIVE OPERATIONS (ms):', JSON.stringify(sorted, null, 2));

  ws.close();
  chrome.kill();
}

main().catch(console.error);
