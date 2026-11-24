const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9234',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-render-profile',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9234/json', (res) => {
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

  // Benchmark baseline vs optimized
  async function runScrollBenchmark(setupFn) {
    if (setupFn) {
      await send('Runtime.evaluate', { expression: setupFn });
      await new Promise(r => setTimeout(r, 200));
    }

    const t0 = performance.now();
    await send('Profiler.enable');
    await send('Profiler.start');

    await send('Runtime.evaluate', {
      expression: `(() => {
        const start = performance.now();
        // Measure 50 consecutive scrollTo steps
        for (let y = 0; y <= 4000; y += 80) {
          window.scrollTo(0, y);
        }
        return performance.now() - start;
      })()`,
      returnByValue: true
    });

    const prof = await send('Profiler.stop');
    const nodes = prof.profile.nodes;
    const samples = prof.profile.samples;
    const deltas = prof.profile.timeDeltas;

    let totalUs = 0;
    let programUs = 0;
    let scrollToUs = 0;

    for (let i = 0; i < samples.length; i++) {
      const nid = samples[i];
      const dt = deltas[i] || 0;
      totalUs += dt;
      const n = nodes.find(x => x.id === nid);
      if (n && n.callFrame.functionName === '(program)') programUs += dt;
      if (n && n.callFrame.functionName === 'scrollTo') scrollToUs += dt;
    }

    return {
      totalMs: Math.round(totalUs / 1000),
      programPaintMs: Math.round(programUs / 1000),
      scrollToMs: Math.round(scrollToUs / 1000)
    };
  }

  const baseline = await runScrollBenchmark('');
  console.log('BASELINE 50 scroll steps:', baseline);

  const optimized = await runScrollBenchmark(`(() => {
    // 1. Remove background-attachment fixed
    document.body.style.backgroundAttachment = 'scroll';
    // 2. Disable heavy backdrop-filters
    const style = document.createElement('style');
    style.textContent = \`
      .glass-card, .glass-card-spotlight, section {
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
      }
      .stacking-card-box {
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.08) !important;
      }
      body {
        background-attachment: scroll !important;
      }
    \`;
    document.head.appendChild(style);
  })()`);
  console.log('OPTIMIZED 50 scroll steps:', optimized);

  ws.close();
  chrome.kill();
}

main().catch(console.error);
