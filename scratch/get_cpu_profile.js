const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9233',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-cpu-profile',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9233/json', (res) => {
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

  await send('Profiler.enable');
  await send('Profiler.start');

  // Trigger scroll
  await send('Runtime.evaluate', {
    expression: `(() => {
      for (let y = 0; y <= 3000; y += 100) {
        window.scrollTo(0, y);
      }
    })()`
  });

  const profileRes = await send('Profiler.stop');
  const profile = profileRes.profile;

  // Aggregate time by node functionName and url
  const nodes = profile.nodes;
  const samples = profile.samples;
  const timeDeltas = profile.timeDeltas;

  const nodeTimes = {};
  for (let i = 0; i < samples.length; i++) {
    const nodeId = samples[i];
    const dt = timeDeltas[i] || 0;
    nodeTimes[nodeId] = (nodeTimes[nodeId] || 0) + dt;
  }

  const results = Object.entries(nodeTimes).map(([id, timeUs]) => {
    const node = nodes.find(n => n.id === parseInt(id));
    return {
      fn: node ? node.callFrame.functionName : 'unknown',
      url: node ? node.callFrame.url : '',
      line: node ? node.callFrame.lineNumber : 0,
      timeMs: Math.round(timeUs / 1000)
    };
  }).sort((a, b) => b.timeMs - a.timeMs).slice(0, 15);

  console.log('CPU PROFILE OF window.scrollTo(0, y):', JSON.stringify(results, null, 2));

  ws.close();
  chrome.kill();
}

main().catch(console.error);
