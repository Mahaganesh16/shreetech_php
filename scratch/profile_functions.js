const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9230',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-trace-profile-fn',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9230/json', (res) => {
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
    categories: 'v8,devtools.timeline,disabled-by-default-v8.cpu_profiler'
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

  const fnDurations = {};
  for (const e of traceEvents) {
    if (e.name === 'FunctionCall' && e.args && e.args.data) {
      const key = (e.args.data.functionName || 'anonymous') + ' @ ' + (e.args.data.url || 'inline') + ':' + (e.args.data.lineNumber || 0);
      fnDurations[key] = (fnDurations[key] || 0) + (e.dur || 0);
    }
  }

  const sorted = Object.entries(fnDurations)
    .sort((a, b) => b[1] - a[1])
    .slice(0, 20)
    .map(([fn, dur]) => ({ fn, durationMs: Math.round(dur / 1000) }));

  console.log('TOP EXPENSIVE JS FUNCTIONS:', JSON.stringify(sorted, null, 2));

  ws.close();
  chrome.kill();
}

main().catch(console.error);
