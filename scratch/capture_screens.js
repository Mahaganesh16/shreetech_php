const { spawn } = require('child_process');
const http = require('http');
const fs = require('fs');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9224',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-debug-profile-3',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9224/json', (res) => {
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
  const shot1 = await send('Page.captureScreenshot');
  fs.writeFileSync('C:/Users/SYSTEM1/.gemini/antigravity/brain/bb648d27-47f8-4e70-a7d8-24f21b6ba1b8/smooth_scroll_hero.png', Buffer.from(shot1.data, 'base64'));

  // Scroll to services
  await send('Runtime.evaluate', { expression: 'window.__lenis.scrollTo("#services", { immediate: true })' });
  await new Promise(r => setTimeout(r, 600));
  const shot2 = await send('Page.captureScreenshot');
  fs.writeFileSync('C:/Users/SYSTEM1/.gemini/antigravity/brain/bb648d27-47f8-4e70-a7d8-24f21b6ba1b8/smooth_scroll_services.png', Buffer.from(shot2.data, 'base64'));

  // Scroll to projects
  await send('Runtime.evaluate', { expression: 'window.__lenis.scrollTo("#projects", { immediate: true })' });
  await new Promise(r => setTimeout(r, 600));
  const shot3 = await send('Page.captureScreenshot');
  fs.writeFileSync('C:/Users/SYSTEM1/.gemini/antigravity/brain/bb648d27-47f8-4e70-a7d8-24f21b6ba1b8/smooth_scroll_projects.png', Buffer.from(shot3.data, 'base64'));

  console.log('Screenshots captured successfully!');
  ws.close();
  chrome.kill();
}

main().catch(console.error);
