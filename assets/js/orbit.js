/**
 * Shree Tech - 3D Orbit Services Interactive Engine
 * Based on OrbitImages architecture by Dominik Koch (https://x.com/dominikkoch)
 * Implemented in pure Vanilla JavaScript for high performance, smooth 60 FPS 3D rendering.
 */

(function () {
  'use strict';

  const SAMPLES = 720;
  const FRONT_GROW = 0.38;
  const BACK_SHRINK = 0.38;
  const BACK_DIM = 0.55;
  const INTRO_SPREAD = 1.3;
  const INTRO_FADE = 0.45;
  const DRAG_THRESHOLD = 5;

  function generateEllipsePath(cx, cy, rx, ry) {
    return `M ${cx - rx} ${cy} A ${rx} ${ry} 0 1 0 ${cx + rx} ${cy} A ${rx} ${ry} 0 1 0 ${cx - rx} ${cy}`;
  }

  const clamp = (value, min, max) => Math.min(max, Math.max(min, value));
  const wrapSigned = value => value - Math.round(value);

  const cubicBezier = (x1, y1, x2, y2) => {
    const sample = (a1, a2, t) => ((1 - 3 * a2 + 3 * a1) * t + (3 * a2 - 6 * a1)) * t * t + 3 * a1 * t;
    const slope = (a1, a2, t) => 3 * (1 - 3 * a2 + 3 * a1) * t * t + 2 * (3 * a2 - 6 * a1) * t + 3 * a1;
    return x => {
      if (x <= 0 || x >= 1) return x;
      let t = x;
      for (let i = 0; i < 8; i++) {
        const s = slope(x1, x2, t);
        if (Math.abs(s) < 1e-6) break;
        t = clamp(t - (sample(x1, x2, t) - x) / s, 0, 1);
      }
      return sample(y1, y2, t);
    };
  };

  const EASINGS = {
    linear: t => t,
    easeIn: cubicBezier(0.42, 0, 1, 1),
    easeOut: cubicBezier(0, 0, 0.58, 1),
    easeInOut: cubicBezier(0.42, 0, 0.58, 1)
  };

  const easeOutQuint = t => 1 - Math.pow(1 - t, 5);

  class OrbitServicesEngine {
    constructor(root, options = {}) {
      this.root = root;
      this.options = Object.assign(
        {
          baseWidth: 1400,
          radiusX: 620,
          radiusY: 310,
          rotation: -4,
          duration: 38,
          itemWidth: 320,
          itemHeight: 185,
          direction: 'normal',
          fill: true,
          pathWidth: 2,
          pathDash: 0,
          easing: 'linear',
          paused: false,
          depth: 0.55,
          hoverScale: 1.08,
          hoverSpeed: 0.2,
          draggable: true,
          clickToFront: true,
          intro: true,
          onActiveChange: null
        },
        options
      );

      const query = typeof window.matchMedia === 'function' ? window.matchMedia('(prefers-reduced-motion: reduce)') : null;
      this.st = {
        lut: null,
        length: 0,
        front: 0,
        yMid: 0,
        yHalf: 1,
        bbox: [0, 0, 1, 1],
        width: 0,
        height: 0,
        scale: 0,
        itemW: this.options.itemWidth,
        itemH: this.options.itemHeight,
        items: [],
        strokes: [],
        lap: 0,
        manual: 0,
        glide: 0,
        speed: 1,
        drag: null,
        seek: null,
        hovered: false,
        hoverIndex: -1,
        suppressUntil: 0,
        introStart: -1,
        introDone: !this.options.intro,
        visible: typeof IntersectionObserver === 'undefined',
        reduced: !!query?.matches,
        raf: 0,
        last: 0,
        destroyed: false,
        activeIdx: -1
      };

      this.st.speed = this.st.reduced || this.options.paused ? 0 : 1;

      this.initPath();
      this.bindEvents();
      this.refresh();
    }

    initPath() {
      const center = this.options.baseWidth / 2;
      const d = generateEllipsePath(center, center, this.options.radiusX, this.options.radiusY);
      const paths = this.root.querySelectorAll('[data-orbit-path]');
      paths.forEach(p => {
        p.setAttribute('d', d);
        p.setAttribute('transform', `rotate(${this.options.rotation} ${center} ${center})`);
      });
    }

    collect() {
      this.st.items = Array.from(this.root.querySelectorAll('[data-orbit-item]')).map((el, i) => ({
        el,
        index: i,
        t: '',
        o: '',
        z: ''
      }));
      this.st.strokes = Array.from(this.root.querySelectorAll('[data-orbit-stroke]'));
    }

    build() {
      const path = this.root.querySelector('[data-orbit-path]');
      let length = 0;
      try {
        length = path ? path.getTotalLength() : 0;
      } catch {
        length = 0;
      }
      if (!path || !length || !isFinite(length)) {
        this.st.lut = null;
        return;
      }

      const lut = new Float32Array(SAMPLES * 2);
      const angle = (this.options.rotation * Math.PI) / 180;
      const cos = Math.cos(angle);
      const sin = Math.sin(angle);
      const origin = this.options.baseWidth / 2;
      let x0 = Infinity,
        x1 = -Infinity,
        y0 = Infinity,
        y1 = -Infinity;
      let front = 0;

      for (let i = 0; i < SAMPLES; i++) {
        const point = path.getPointAtLength((i / SAMPLES) * length);
        const dx = point.x - origin;
        const dy = point.y - origin;
        const x = origin + dx * cos - dy * sin;
        const y = origin + dx * sin + dy * cos;
        lut[i * 2] = x;
        lut[i * 2 + 1] = y;
        x0 = Math.min(x0, x);
        x1 = Math.max(x1, x);
        y0 = Math.min(y0, y);
        y1 = Math.max(y1, y);
        if (y > lut[front * 2 + 1] + 1e-6) front = i;
      }

      this.st.lut = lut;
      this.st.length = length;
      this.st.front = front / SAMPLES;
      this.st.yMid = (y0 + y1) / 2;
      this.st.yHalf = Math.max(1e-3, (y1 - y0) / 2);
      const depth = clamp(this.options.depth, 0, 1);
      const margin = (this.options.itemWidth / 2) * (1 + depth * FRONT_GROW) * Math.max(1, this.options.hoverScale) + 4;
      this.st.bbox = [x0 - margin, y0 - margin, x1 + margin, y1 + margin];
    }

    layout() {
      this.st.width = this.root.clientWidth;
      this.st.height = this.root.clientHeight || 520;
      if (!this.st.lut) return;

      const [bx0, by0, bx1, by1] = this.st.bbox;
      const scale = Math.min(this.st.width / (bx1 - bx0), this.st.height / (by1 - by0));
      this.st.scale = scale > 0 && isFinite(scale) ? scale : 0;

      // Adjust item sizing responsively
      const isMobile = this.st.width < 640;
      const baseW = isMobile ? 190 : this.options.itemWidth;
      const baseH = isMobile ? 120 : this.options.itemHeight;

      this.st.itemW = baseW * this.st.scale;
      this.st.itemH = baseH * this.st.scale;

      for (const it of this.st.items) {
        it.el.style.width = `${this.st.itemW}px`;
        it.el.style.height = `${this.st.itemH}px`;
      }

      if (!this.st.scale) return;
      const vw = this.st.width / this.st.scale;
      const vh = this.st.height / this.st.scale;
      const cx = (bx0 + bx1) / 2;
      const cy = (by0 + by1) / 2;

      this.root.querySelectorAll('[data-orbit-svg]').forEach(svg => {
        svg.setAttribute('viewBox', `${cx - vw / 2} ${cy - vh / 2} ${vw} ${vh}`);
      });

      const clip = this.root.querySelector('[data-orbit-clip]');
      if (clip) {
        clip.setAttribute('x', String(cx - vw));
        clip.setAttribute('y', String(this.st.yMid));
        clip.setAttribute('width', String(vw * 2));
        clip.setAttribute('height', String(vh * 2));
      }

      for (const stroke of this.st.strokes) {
        stroke.style.strokeWidth = String(this.options.pathWidth / this.st.scale);
      }
      this.applyDash(1);
    }

    applyDash(reveal) {
      const dash = this.options.pathDash > 0 && this.st.scale ? this.options.pathDash / this.st.scale : 0;
      for (const stroke of this.st.strokes) {
        if (reveal < 1 && !dash) {
          stroke.style.strokeDasharray = `${this.st.length} ${this.st.length}`;
          stroke.style.strokeDashoffset = String(this.st.length * (1 - reveal));
          stroke.style.opacity = '';
        } else {
          stroke.style.strokeDasharray = dash ? `${dash} ${dash * 1.6}` : '';
          stroke.style.strokeDashoffset = '';
          stroke.style.opacity = reveal < 1 ? String(reveal) : '';
        }
      }
    }

    sample(u) {
      const f = (((u % 1) + 1) % 1) * SAMPLES;
      const i0 = Math.floor(f) % SAMPLES;
      const i1 = (i0 + 1) % SAMPLES;
      const t = f - Math.floor(f);
      const lut = this.st.lut;
      return [lut[i0 * 2] + (lut[i1 * 2] - lut[i0 * 2]) * t, lut[i0 * 2 + 1] + (lut[i1 * 2 + 1] - lut[i0 * 2 + 1]) * t];
    }

    progress() {
      const ease = EASINGS[this.options.easing] || EASINGS.linear;
      const whole = Math.floor(this.st.lap);
      return (whole + ease(this.st.lap - whole)) * (this.options.direction === 'reverse' ? -1 : 1) + this.st.manual;
    }

    offsetOf(index, count) {
      if (this.options.fill) return index / Math.max(1, count);
      return (-index * this.options.itemWidth * 1.3) / Math.max(1, this.st.length);
    }

    write(it, key, prop, value) {
      if (it[key] !== value) {
        it[key] = value;
        it.el.style[prop] = value;
      }
    }

    render(now) {
      if (!this.st.lut || !this.st.scale) return;
      const p = this.progress();
      const count = this.st.items.length;
      const depth = clamp(this.options.depth, 0, 1);
      const [bx0, by0, bx1, by1] = this.st.bbox;
      const cx = (bx0 + bx1) / 2;
      const cy = (by0 + by1) / 2;
      const halfW = this.st.itemW / 2;
      const halfH = this.st.itemH / 2;
      const introRunning = this.st.introStart >= 0;
      const elapsed = introRunning ? (now - this.st.introStart) / 1000 : 0;
      const spread = introRunning ? easeOutQuint(clamp(elapsed / INTRO_SPREAD, 0, 1)) : 1;
      const appear = introRunning ? clamp(elapsed / INTRO_FADE, 0, 1) : 1;

      let closestIdx = -1;
      let maxDepth = -Infinity;

      for (let i = 0; i < count; i++) {
        const it = this.st.items[i];
        let u = p + this.offsetOf(i, count);
        if (introRunning) u = this.st.front + wrapSigned(u - this.st.front) * spread;
        const [x, y] = this.sample(u);
        const d = clamp((y - this.st.yMid) / this.st.yHalf, -1, 1);
        const w = (d + 1) / 2;
        let scale = 1 + depth * (FRONT_GROW * w - BACK_SHRINK * (1 - w));
        let opacity = 1 - depth * BACK_DIM * (1 - w);

        if (introRunning) {
          scale *= 0.7 + 0.3 * appear;
          opacity *= appear * appear * (3 - 2 * appear);
        }

        const sx = (x - cx) * this.st.scale + this.st.width / 2 - halfW;
        const sy = (y - cy) * this.st.scale + this.st.height / 2 - halfH;
        let z = depth > 0 ? (d <= 0 ? 10 + Math.round((d + 1) * 80) : 110 + Math.round(d * 80)) : 1;
        if (i === this.st.hoverIndex) z += 200;

        this.write(
          it,
          't',
          'transform',
          `translate3d(${sx.toFixed(2)}px, ${sy.toFixed(2)}px, 0px) scale(${scale.toFixed(4)})`
        );
        this.write(it, 'o', 'opacity', opacity > 0.999 ? '1' : opacity.toFixed(3));
        this.write(it, 'z', 'zIndex', String(z));

        if (d > maxDepth) {
          maxDepth = d;
          closestIdx = i;
        }
      }

      // Track active front-most item
      if (closestIdx !== -1 && closestIdx !== this.st.activeIdx) {
        this.st.activeIdx = closestIdx;
        this.st.items.forEach((it, idx) => {
          if (idx === closestIdx) {
            it.el.classList.add('is-active');
          } else {
            it.el.classList.remove('is-active');
          }
        });
        if (typeof this.options.onActiveChange === 'function') {
          this.options.onActiveChange(closestIdx);
        }
      }

      if (introRunning) this.applyDash(easeOutQuint(clamp(elapsed / INTRO_SPREAD, 0, 1)));
    }

    frame(now) {
      this.st.raf = 0;
      if (this.st.destroyed) return;
      const dt = this.st.last ? clamp((now - this.st.last) / 1000, 0, 0.1) : 0;
      this.st.last = now;
      let busy = false;

      if (this.st.lut && this.st.scale && this.st.introStart === -1 && !this.st.introDone && this.st.visible) {
        if (this.options.intro && !this.st.reduced) {
          this.st.introStart = now;
        } else {
          this.st.introDone = true;
        }
        this.root.removeAttribute('data-intro');
      }

      if (this.st.introStart >= 0) {
        if ((now - this.st.introStart) / 1000 >= INTRO_SPREAD) {
          this.st.introStart = -2;
          this.st.introDone = true;
          this.applyDash(1);
        } else {
          busy = true;
        }
      }

      const want = this.options.paused || this.st.reduced ? 0 : this.st.hovered ? clamp(this.options.hoverSpeed, 0, 1) : 1;
      if (this.st.speed !== want) {
        this.st.speed += (want - this.st.speed) * (1 - Math.exp(-dt / 0.35));
        if (Math.abs(this.st.speed - want) < 0.002) this.st.speed = want;
        busy = true;
      }

      if (this.st.speed > 0 && this.options.duration > 0) {
        this.st.lap += (dt * this.st.speed) / this.options.duration;
        busy = true;
      }

      if (this.st.drag?.active) {
        busy = true;
      } else if (this.st.seek) {
        this.st.seek.t = Math.min(1, this.st.seek.t + dt / this.st.seek.dur);
        const e = this.st.seek.t < 0.5 ? 4 * Math.pow(this.st.seek.t, 3) : 1 - Math.pow(-2 * this.st.seek.t + 2, 3) / 2;
        this.st.manual = this.st.seek.from + this.st.seek.delta * e;
        if (this.st.seek.t >= 1) this.st.seek = null;
        busy = true;
      } else if (this.st.glide) {
        this.st.manual += this.st.glide * dt;
        this.st.glide *= Math.exp(-dt / 0.7);
        if (Math.abs(this.st.glide) < 0.0004) this.st.glide = 0;
        busy = true;
      }

      this.render(now);
      const whole = Math.floor(this.st.lap);
      if (whole) this.st.lap -= whole;
      if (!this.st.drag && !this.st.seek) this.st.manual -= Math.floor(this.st.manual);
      if (busy && this.st.visible && !this.st.destroyed) {
        this.st.raf = requestAnimationFrame(t => this.frame(t));
      }
    }

    wake() {
      if (this.st.raf || this.st.destroyed || !this.st.visible) return;
      this.st.last = 0;
      this.st.raf = requestAnimationFrame(t => this.frame(t));
    }

    local(e) {
      const r = this.root.getBoundingClientRect();
      const k = this.root.offsetWidth ? r.width / this.root.offsetWidth || 1 : 1;
      return [(e.clientX - r.left) / k, (e.clientY - r.top) / k];
    }

    dragRate() {
      if (!this.st.lut || !this.st.scale) return 0;
      const a = this.sample(this.st.front - 3 / SAMPLES);
      const b = this.sample(this.st.front + 3 / SAMPLES);
      const along = ((b[0] - a[0]) / (6 / SAMPLES)) * this.st.scale;
      const floor = this.st.length * this.st.scale * 0.35;
      return Math.abs(along) < floor ? Math.sign(along || 1) * floor : along;
    }

    itemIndex(target) {
      const el = target instanceof Element ? target.closest('[data-orbit-item]') : null;
      return el && this.root.contains(el) ? Number(el.getAttribute('data-orbit-item')) : -1;
    }

    bringToFront(index) {
      if (!this.st.lut || index < 0) return;
      const u = this.progress() + this.offsetOf(index, this.st.items.length);
      const delta = wrapSigned(this.st.front - u);
      this.st.glide = 0;
      this.st.seek = { from: this.st.manual, delta, t: 0, dur: 0.45 + Math.abs(delta) * 1.4 };
      this.wake();
    }

    bindEvents() {
      const root = this.root;

      root.addEventListener('pointerenter', () => {
        this.st.hovered = true;
        this.wake();
      });

      root.addEventListener('pointerleave', () => {
        this.st.hovered = false;
        this.st.hoverIndex = -1;
        this.wake();
      });

      root.addEventListener('pointerover', e => {
        const index = this.itemIndex(e.target);
        if (index !== this.st.hoverIndex) {
          this.st.hoverIndex = index;
          if (this.st.lut) this.render(performance.now());
        }
      });

      root.addEventListener('pointerdown', e => {
        if (!this.options.draggable || (e.pointerType === 'mouse' && e.button !== 0)) return;
        if (e.target instanceof Element && e.target.closest('[data-orbit-center]')) return;
        const [x, y] = this.local(e);
        this.st.drag = { id: e.pointerId, x, y, active: false, samples: [], rate: this.dragRate(), anchor: 0, manual: 0 };
      });

      root.addEventListener('pointermove', e => {
        const d = this.st.drag;
        if (!d || e.pointerId !== d.id) return;
        const [x, y] = this.local(e);
        const along = x - d.x;

        if (!d.active) {
          if (Math.abs(along) < DRAG_THRESHOLD) return;
          if (Math.abs(y - d.y) > Math.abs(along)) {
            this.st.drag = null;
            return;
          }
          d.active = true;
          d.anchor = along;
          d.manual = this.st.manual;
          this.st.seek = null;
          this.st.glide = 0;
          try {
            root.setPointerCapture(e.pointerId);
          } catch {}
          root.setAttribute('data-dragging', '');
        }

        if (d.rate) this.st.manual = d.manual + (along - d.anchor) / d.rate;
        const now = performance.now();
        d.samples.push([now, along]);
        while (d.samples.length > 2 && now - d.samples[0][0] > 100) d.samples.shift();
        this.wake();
      });

      const endDrag = (e, cancelled) => {
        const d = this.st.drag;
        if (!d || e.pointerId !== d.id) return;
        this.st.drag = null;
        if (!d.active) return;
        root.removeAttribute('data-dragging');
        try {
          root.releasePointerCapture(e.pointerId);
        } catch {}

        const now = performance.now();
        this.st.suppressUntil = now + 400;
        const s = d.samples;
        if (!cancelled && s.length > 1 && d.rate) {
          const [t0, a0] = s[0];
          const [t1, a1] = s[s.length - 1];
          if (t1 > t0 && now - t1 < 80) {
            this.st.glide = clamp((((a1 - a0) / (t1 - t0)) * 1000) / d.rate, -3, 3);
          }
        }
        this.wake();
      };

      root.addEventListener('pointerup', e => endDrag(e, false));
      root.addEventListener('pointercancel', e => endDrag(e, true));
      root.addEventListener('lostpointercapture', e => endDrag(e, true));

      root.addEventListener('click', e => {
        if (performance.now() < this.st.suppressUntil) {
          e.preventDefault();
          e.stopPropagation();
          this.st.suppressUntil = 0;
          return;
        }
        const index = this.itemIndex(e.target);
        if (index >= 0) {
          if (this.options.clickToFront) this.bringToFront(index);
        }
      });

      if (typeof ResizeObserver !== 'undefined') {
        const ro = new ResizeObserver(() => {
          this.layout();
          this.render(performance.now());
          this.wake();
        });
        ro.observe(root);
      }

      if (typeof IntersectionObserver !== 'undefined') {
        const io = new IntersectionObserver(
          entries => {
            this.st.visible = entries[entries.length - 1].isIntersecting;
            if (this.st.visible) this.wake();
          },
          { threshold: 0.05 }
        );
        io.observe(root);
      }

      document.addEventListener('visibilitychange', () => {
        if (!document.hidden) this.wake();
      });
      window.addEventListener('resize', () => this.wake());
    }

    refresh() {
      this.collect();
      this.build();
      this.layout();
      this.render(performance.now());
      this.wake();
    }
  }

  // =========================================================================
  // INITIALIZATION ON DOM READY
  // =========================================================================
  function initOrbitServices() {
    const orbitContainer = document.getElementById('services-orbit-container');
    if (!orbitContainer) return;

    // Service data cache from data attributes
    const serviceItems = Array.from(orbitContainer.querySelectorAll('[data-orbit-item]'));
    const servicesMeta = serviceItems.map(el => {
      try {
        return JSON.parse(el.getAttribute('data-service-json') || '{}');
      } catch {
        return {};
      }
    });

    // Center Stage DOM references
    const centerIcon = document.getElementById('center-service-icon');
    const centerBadge = document.getElementById('center-service-badge');
    const centerTitle = document.getElementById('center-service-title');
    const centerDesc = document.getElementById('center-service-desc');
    const centerDeliverables = document.getElementById('center-service-deliverables');

    function updateCenterStage(idx) {
      const s = servicesMeta[idx];
      if (!s) return;

      if (centerIcon) {
        centerIcon.innerHTML = `<i data-lucide="${s.iconName || 'sparkles'}" class="w-7 h-7"></i>`;
      }
      if (centerBadge) {
        centerBadge.textContent = `Service 0${idx + 1}`;
      }
      if (centerTitle) {
        centerTitle.textContent = s.title || '';
      }
      if (centerDesc) {
        centerDesc.textContent = s.description || '';
      }
      if (centerDeliverables && Array.isArray(s.deliverables)) {
        centerDeliverables.innerHTML = s.deliverables
          .slice(0, 3)
          .map(
            d => `
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-semibold text-[#1E293B] bg-white border border-[#F1E6EE] shadow-xs">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
              <span>${d}</span>
            </span>`
          )
          .join('');
      }

      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    }

    // Instantiate engine
    const engine = new OrbitServicesEngine(orbitContainer, {
      baseWidth: 1400,
      radiusX: 620,
      radiusY: 310,
      rotation: -4,
      duration: 38,
      itemWidth: 320,
      itemHeight: 185,
      depth: 0.55,
      showPath: true,
      draggable: true,
      clickToFront: true,
      onActiveChange: updateCenterStage
    });

    // Initial update
    updateCenterStage(0);

    // Prev / Next button step controls
    const prevBtn = document.getElementById('orbit-prev-btn');
    const nextBtn = document.getElementById('orbit-next-btn');

    if (prevBtn) {
      prevBtn.addEventListener('click', e => {
        e.preventDefault();
        e.stopPropagation();
        const count = serviceItems.length;
        const cur = engine.st.activeIdx >= 0 ? engine.st.activeIdx : 0;
        const target = (cur - 1 + count) % count;
        engine.bringToFront(target);
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', e => {
        e.preventDefault();
        e.stopPropagation();
        const count = serviceItems.length;
        const cur = engine.st.activeIdx >= 0 ? engine.st.activeIdx : 0;
        const target = (cur + 1) % count;
        engine.bringToFront(target);
      });
    }

    // View switcher: 3D Orbit View vs Grid View
    const orbitViewBtn = document.getElementById('btn-services-view-orbit');
    const gridViewBtn = document.getElementById('btn-services-view-grid');
    const orbitWrapper = document.getElementById('services-orbit-wrapper');
    const gridWrapper = document.getElementById('services-grid-wrapper');

    if (orbitViewBtn && gridViewBtn && orbitWrapper && gridWrapper) {
      orbitViewBtn.addEventListener('click', () => {
        orbitViewBtn.className =
          'px-4 py-1.5 text-xs font-bold rounded-xl transition-all cursor-pointer glass-btn-primary shadow-xs text-white';
        gridViewBtn.className =
          'px-4 py-1.5 text-xs font-semibold rounded-xl transition-all cursor-pointer glass-btn-secondary text-[#475569] hover:text-[#C01858]';
        orbitWrapper.classList.remove('hidden');
        gridWrapper.classList.add('hidden');
        engine.refresh();
      });

      gridViewBtn.addEventListener('click', () => {
        gridViewBtn.className =
          'px-4 py-1.5 text-xs font-bold rounded-xl transition-all cursor-pointer glass-btn-primary shadow-xs text-white';
        orbitViewBtn.className =
          'px-4 py-1.5 text-xs font-semibold rounded-xl transition-all cursor-pointer glass-btn-secondary text-[#475569] hover:text-[#C01858]';
        orbitWrapper.classList.add('hidden');
        gridWrapper.classList.remove('hidden');
      });
    }

    // Expose engine to global window for external access
    window.__shreeTechOrbit = engine;
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initOrbitServices);
  } else {
    initOrbitServices();
  }
})();
