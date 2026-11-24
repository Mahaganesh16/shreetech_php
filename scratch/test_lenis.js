const { spawn } = require('child_process');
const http = require('http');

async function main() {
  const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
  const chrome = spawn(chromePath, [
    '--headless=new',
    '--remote-debugging-port=9222',
    '--user-data-dir=C:\\Users\\SYSTEM1\\AppData\\Local\\Temp\\chrome-debug-profile',
    'http://localhost/shreetech-php/index.php'
  ]);

  await new Promise(r => setTimeout(r, 2000));

  const json = await new Promise((resolve, reject) => {
    http.get('http://127.0.0.1:9222/json', (res) => {
      let data = '';
      res.on('data', chunk => data += chunk);
      res.on('end', () => resolve(JSON.parse(data)));
    }).on('error', reject);
  });

  const page = json.find(t => t.url.includes('shreetech-php'));
  if (!page) {
    console.log('Page not found');
    chrome.kill();
    return;
  }

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

  await send('Page.enable');
  await send('Runtime.enable');
  await send('Log.enable');

  ws.addEventListener('message', (event) => {
    const data = JSON.parse(event.data);
    if (data.method === 'Runtime.consoleAPICalled') {
      console.log('CONSOLE:', data.params.type, data.params.args.map(a => a.value));
    }
    if (data.method === 'Runtime.exceptionThrown') {
      console.error('EXCEPTION:', data.params.exceptionDetails);
    }
  });

  // Reload and wait for loadEventFired
  const loadedPromise = new Promise(resolve => {
    const handler = (event) => {
      const data = JSON.parse(event.data);
      if (data.method === 'Page.loadEventFired') {
        ws.removeEventListener('message', handler);
        resolve();
      }
    };
    ws.addEventListener('message', handler);
  });
  await send('Page.reload');
  await loadedPromise;
  await new Promise(r => setTimeout(r, 1000));

  // Evaluate page status
  const res = await send('Runtime.evaluate', {
    expression: `(() => {
      return {
        htmlScrollBehavior: window.getComputedStyle(document.documentElement).scrollBehavior,
        bodyScrollBehavior: window.getComputedStyle(document.body).scrollBehavior,
        htmlClasses: document.documentElement.className,
        hasLenis: typeof Lenis !== 'undefined',
        hasWindowLenis: !!window.__lenis,
        lenisOptions: window.__lenis ? {
          lerp: window.__lenis.options.lerp,
          duration: window.__lenis.options.duration,
          smoothWheel: window.__lenis.options.smoothWheel,
          wheelMultiplier: window.__lenis.options.wheelMultiplier,
          touchMultiplier: window.__lenis.options.touchMultiplier
        } : null,
        pinTrackHeight: document.getElementById('projects-pin-track')?.offsetHeight,
        viewportHeight: window.innerHeight,
        totalScrollHeight: document.documentElement.scrollHeight
      };
    })()`,
    returnByValue: true
  });

  console.log('RESULT:', JSON.stringify(res.result.value, null, 2));

  // Test actual mouse wheel dispatch
  console.log('--- Testing actual mouse wheel events (5 ticks down) ---');
  for (let i = 0; i < 5; i++) {
    await send('Input.dispatchMouseEvent', {
      type: 'mouseWheel',
      x: 300,
      y: 300,
      deltaX: 0,
      deltaY: 120
    });
    await new Promise(r => setTimeout(r, 100));
  }

  await new Promise(r => setTimeout(r, 600));
  const afterWheel = await send('Runtime.evaluate', {
    expression: `({ scrollY: window.scrollY, lenisScroll: window.__lenis.scroll, isScrolling: window.__lenis.isScrolling })`,
    returnByValue: true
  });
  console.log('After wheel events:', afterWheel.result.value);

  // Scroll to projects section and check what happens
  console.log('--- Scrolling into #projects section ---');
  const projectsTopRes = await send('Runtime.evaluate', {
    expression: `document.getElementById('projects').offsetTop`,
    returnByValue: true
  });
  const projectsTop = projectsTopRes.result.value;
  console.log('#projects offsetTop:', projectsTop);

  await send('Runtime.evaluate', {
    expression: `window.__lenis.scrollTo(${projectsTop + 200}, { immediate: true })`
  });
  await new Promise(r => setTimeout(r, 200));

  // Now dispatch 10 wheel events while inside #projects
  console.log('--- Dispatching 10 wheel events inside #projects ---');
  for (let i = 0; i < 10; i++) {
    await send('Input.dispatchMouseEvent', {
      type: 'mouseWheel',
      x: 400,
      y: 300,
      deltaX: 0,
      deltaY: 120
    });
    await new Promise(r => setTimeout(r, 50));
  }
  await new Promise(r => setTimeout(r, 1000));

  const afterProjectsWheel = await send('Runtime.evaluate', {
    expression: `(() => {
      const pinStage = document.getElementById('projects-pin-stage');
      const stageRect = pinStage.getBoundingClientRect();
      const trackRect = document.getElementById('projects-pin-track').getBoundingClientRect();
      return {
        scrollY: window.scrollY,
        lenisScroll: window.__lenis.scroll,
        stageTop: stageRect.top,
        trackTop: trackRect.top,
        trackHeight: trackRect.height
      };
    })()`,
    returnByValue: true
  });
  console.log('After projects wheel:', afterProjectsWheel.result.value);

  ws.close();
  chrome.kill();
}

main().catch(err => {
  console.error(err);
  process.exit(1);
});
