/**
 * Shree Tech - Continuous Curved 3D Orbit Carousel Engine
 * High-Performance 60FPS RAF Continuous Orbital Scrolling (Never Pauses on Hover)
 */
(function () {
  'use strict';

  // Symmetrical orbit slot angles in degrees (clockwise)
  // Slot 0: Center Active Focus (front bottom, 90 deg)
  // Slots 1-7: Satellites passing cleanly along reduced orbit line
  const SLOT_ANGLES = [90, 28, -12, -52, -90, -128, -168, -208];

  // Silky quartic ease-out for drag release, smooth cubic ease-in-out for click/button transitions
  function easeOutQuart(x) {
    return 1 - Math.pow(1 - x, 4);
  }

  function easeInOutCubic(x) {
    return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2;
  }

  class OrbitServicesEngine {
    constructor(root, options = {}) {
      this.root = root;
      this.options = Object.assign(
        {
          autoRotate: true,
          // Balanced smooth continuous rotation speed (~0.22 slots/sec = ~4.5s per card)
          speed: 0.22,
          onActiveChange: null
        },
        options
      );

      this.items = Array.from(this.root.querySelectorAll('[data-orbit-item]'));
      this.itemMeta = this.items.map(el => ({
        el,
        full: el.querySelector('.card-full-view'),
        glows: el.querySelector('.card-ambient-glows'),
        interactive: null
      }));
      this.count = this.items.length;
      this.activeIndex = 0;

      // Continuous rotation float (0.0 = card 0 active, 1.0 = card 1 active, etc.)
      this.currentRot = 0;
      this.targetRot = 0;
      this.isAnimating = false;
      this.rafId = null;
      this.continuousRafId = null;
      this.lastTickTime = null;

      // Interaction & visibility flags
      this.isInView = true;
      this.isDragging = false;
      this.dragStartX = 0;
      this.rotAtDragStart = 0;
      this.hasMoved = false;

      this.init();
    }

    init() {
      if (!this.root || !this.count) return;

      this.build();
      this.render(this.currentRot);
      this.bindEvents();
      this.startAutoRotate();

      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    }

    build() {
      this.width = this.root.clientWidth || 1200;
      this.height = this.root.clientHeight || 750;
      this.isMobile = (typeof window !== 'undefined' && window.innerWidth <= 768) || this.width < 768;
      this.isTablet = !this.isMobile && this.width < 1100;

      // Calculate horizontal elliptical path geometry (tighter vertical framing)
      if (this.isMobile) {
        this.rx = Math.min(270, Math.round(this.width * 0.38));
        this.ry = Math.min(118, Math.round(this.height * 0.215));
        this.cx = this.width / 2;
        this.cy = Math.round(this.height * 0.40);
      } else if (this.isTablet) {
        this.rx = Math.min(340, Math.round(this.width * 0.34));
        this.ry = Math.min(132, Math.round(this.height * 0.23));
        this.cx = this.width / 2;
        this.cy = Math.round(this.height * 0.40);
      } else {
        // Desktop: compact ellipse framing with zero top/bottom clipping
        this.rx = Math.min(390, Math.round(this.width * 0.32));
        this.ry = Math.min(142, Math.round(this.height * 0.23));
        this.cx = this.width / 2;
        this.cy = Math.round(this.height * 0.38);
      }

      // Update SVG path for exact visual orbit guide line
      const pathEl = this.root.querySelector('[data-orbit-path]');
      if (pathEl) {
        const d = `M ${this.cx - this.rx} ${this.cy} A ${this.rx} ${this.ry} 0 1 0 ${this.cx + this.rx} ${this.cy} A ${this.rx} ${this.ry} 0 1 0 ${this.cx - this.rx} ${this.cy}`;
        pathEl.setAttribute('d', d);
      }

      const svgEl = this.root.querySelector('[data-orbit-svg]');
      if (svgEl) {
        svgEl.setAttribute('viewBox', `0 0 ${this.width} ${this.height}`);
      }
    }

    /**
     * Continuous 60fps rendering of all cards at rotation float `rot`
     * Guarantees every card center is mathematically ON the ellipse arc at every millisecond
     */
    render(rot) {
      const count = this.count;
      let nearestIdx = 0;
      let minDist = Infinity;

      for (let i = 0; i < count; i++) {
        const it = this.items[i];
        // Relative slot position in continuous floating-point space [0, count)
        const relPos = ((i - rot) % count + count) % count;
        const baseIdx = Math.floor(relPos);
        const frac = relPos - baseIdx;

        // Smooth angle interpolation along the 8 orbit slots
        const a1 = SLOT_ANGLES[baseIdx % count];
        const a2 = SLOT_ANGLES[(baseIdx + 1) % count];
        let diff = a2 - a1;
        while (diff > 180) diff -= 360;
        while (diff < -180) diff += 360;
        const angleDeg = a1 + diff * frac;
        const angleRad = (angleDeg * Math.PI) / 180;

        // Coordinates strictly on the ellipse curve
        const px = this.cx + this.rx * Math.cos(angleRad);
        const py = this.cy + this.ry * Math.sin(angleRad);
        const depth = Math.sin(angleRad); // -1 (back top) to +1 (front bottom)
        const depthNorm = (depth + 1) / 2; // 0 (back) to 1 (front)

        // Distance from center active slot (relPos == 0)
        const distFromCenter = Math.min(relPos, count - relPos);
        if (distFromCenter < minDist) {
          minDist = distFromCenter;
          nearestIdx = i;
        }
        const isCenter = distFromCenter < 0.45;

        // Smooth continuous growth/shrink curve across approach/departure zone [0, 1.1]
        const focusRaw = Math.max(0, 1 - distFromCenter / 1.1);
        const smoothFocus = focusRaw * focusRaw * (3 - 2 * focusRaw);

        // Subtle 3D Y-axis tilt fading gently to flat at center focus
        const tiltY = -Math.cos(angleRad) * 10 * (1 - smoothFocus * 0.6);

        // Continuous pure GPU scaling: smaller along back/sides, swelling smoothly to 1.0 at center
        const minSat = this.isMobile ? 0.35 : 0.40;
        const satRange = this.isMobile ? 0.08 : 0.09;
        const satScale = minSat + satRange * depthNorm;
        const scale = satScale + (1.0 - satScale) * smoothFocus;

        // On mobile view, hide all small backside/side cards (opacity 0) and reveal clearly only when entering center
        let opacity;
        if (this.isMobile) {
          const mobileVisRaw = Math.min(1, Math.max(0, (0.54 - distFromCenter) / 0.32));
          opacity = mobileVisRaw * mobileVisRaw * (3 - 2 * mobileVisRaw);
        } else {
          opacity = Math.min(1, 0.78 + 0.22 * depthNorm + 0.22 * smoothFocus);
        }
        const zIndex = 10 + Math.round(depthNorm * 40 + smoothFocus * 60);

        // Center-anchored GPU transform with 3D perspective (zero layout reflows)
        it.style.transform = `translate3d(${px.toFixed(1)}px, ${py.toFixed(1)}px, 0px) translate(-50%, -50%) rotateY(${tiltY.toFixed(1)}deg) scale(${scale.toFixed(3)})`;
        it.style.zIndex = String(zIndex);
        it.style.opacity = opacity.toFixed(3);
        it.style.visibility = opacity <= 0.01 ? 'hidden' : 'visible';
        it.style.pointerEvents = opacity > 0.05 ? 'auto' : 'none';

        // Keep identical card content at every size; fade only ambient edge glows smoothly on focus
        const meta = this.itemMeta[i];
        if (meta) {
          if (meta.glows) meta.glows.style.opacity = smoothFocus.toFixed(3);

          const fullInteractive = smoothFocus >= 0.45;
          if (meta.interactive !== fullInteractive) {
            meta.interactive = fullInteractive;
            if (meta.full) meta.full.style.pointerEvents = fullInteractive ? 'auto' : 'none';
          }
        }

        // Toggle active state via data-active (CSS border/glow state only, no dimension snap)
        const wasActive = it.getAttribute('data-active') === 'true';
        if (isCenter && !wasActive) {
          it.setAttribute('data-active', 'true');
        } else if (!isCenter && wasActive) {
          it.removeAttribute('data-active');
        }
      }

      if (nearestIdx !== this.activeIndex) {
        this.activeIndex = nearestIdx;
        if (typeof this.options.onActiveChange === 'function') {
          this.options.onActiveChange(this.activeIndex);
        }
      }
    }

    /**
     * Smoothly animates carousel rotation from currentRot to targetRot over duration (ms)
     */
    animateTo(targetRot, duration = 950, easeFn = easeInOutCubic) {
      if (this.rafId) {
        cancelAnimationFrame(this.rafId);
        this.rafId = null;
      }

      this.isAnimating = true;
      const startRot = this.currentRot;
      const startTime = performance.now();

      const tick = now => {
        const elapsed = now - startTime;
        const progress = Math.min(1, elapsed / duration);
        const ease = easeFn(progress);

        this.currentRot = startRot + (targetRot - startRot) * ease;
        this.render(this.currentRot);

        if (progress < 1) {
          this.rafId = requestAnimationFrame(tick);
        } else {
          this.currentRot = targetRot;
          this.render(this.currentRot);
          this.isAnimating = false;
          this.rafId = null;
          this.lastTickTime = performance.now();
        }
      };

      this.rafId = requestAnimationFrame(tick);
    }

    setActive(index) {
      const currentNorm = ((this.currentRot % this.count) + this.count) % this.count;
      let diff = index - currentNorm;
      if (diff > this.count / 2) diff -= this.count;
      if (diff < -this.count / 2) diff += this.count;

      this.targetRot = this.currentRot + diff;
      this.animateTo(this.targetRot, 780, easeInOutCubic);
    }

    next() {
      this.targetRot = Math.round(this.currentRot) + 1;
      this.animateTo(this.targetRot, 750, easeInOutCubic);
    }

    prev() {
      this.targetRot = Math.round(this.currentRot) - 1;
      this.animateTo(this.targetRot, 750, easeInOutCubic);
    }

    startAutoRotate() {
      if (!this.options.autoRotate) return;
      if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
      if (this.continuousRafId) return;

      this.lastTickTime = performance.now();

      const loop = now => {
        this.continuousRafId = requestAnimationFrame(loop);

        const dt = Math.min(0.05, Math.max(0, (now - (this.lastTickTime || now)) / 1000));
        this.lastTickTime = now;

        // Continuously advance rotation regardless of hover state; pause only during active drag or snap tween
        if (!document.hidden && this.isInView && !this.isDragging && !this.isAnimating) {
          this.currentRot += dt * this.options.speed;
          // Keep float bounded neatly while preserving continuous wrap-around
          if (this.currentRot >= this.count * 1000) {
            this.currentRot -= this.count * 1000;
          }
          this.render(this.currentRot);
        }
      };

      this.continuousRafId = requestAnimationFrame(loop);
    }

    stopAutoRotate() {
      if (this.continuousRafId) {
        cancelAnimationFrame(this.continuousRafId);
        this.continuousRafId = null;
      }
    }

    bindEvents() {
      // 1. Next / Previous Buttons across all cards
      this.root.querySelectorAll('.orbit-next-btn').forEach(btn => {
        btn.addEventListener('click', e => {
          e.preventDefault();
          e.stopPropagation();
          this.next();
        });
      });

      this.root.querySelectorAll('.orbit-prev-btn').forEach(btn => {
        btn.addEventListener('click', e => {
          e.preventDefault();
          e.stopPropagation();
          this.prev();
        });
      });

      // 2. Interactive Dragging: Desktop Mouse & Mobile Touch
      const onDragStart = clientX => {
        this.isDragging = true;
        this.hasMoved = false;
        this.dragStartX = clientX;
        this.rotAtDragStart = this.currentRot;
        this.root.setAttribute('data-dragging', 'true');
        if (this.rafId) {
          cancelAnimationFrame(this.rafId);
          this.rafId = null;
          this.isAnimating = false;
        }
      };

      const onDragMove = clientX => {
        if (!this.isDragging) return;
        const diffX = clientX - this.dragStartX;
        if (Math.abs(diffX) > 6) {
          this.hasMoved = true;
        }
        // Pixel-to-rotation mapping: 260px drag = 1 slot rotation
        const sensitivity = this.isMobile ? 180 : 260;
        const deltaRot = -diffX / sensitivity;
        this.currentRot = this.rotAtDragStart + deltaRot;
        this.render(this.currentRot);
      };

      const onDragEnd = () => {
        if (!this.isDragging) return;
        this.isDragging = false;
        this.root.removeAttribute('data-dragging');

        // Snap smoothly to nearest integer slot if user dragged, then continue flowing
        if (this.hasMoved) {
          const nearestSlot = Math.round(this.currentRot);
          this.targetRot = nearestSlot;
          this.animateTo(nearestSlot, 520, easeOutQuart);
        } else {
          this.lastTickTime = performance.now();
        }

        setTimeout(() => {
          this.hasMoved = false;
        }, 50);
      };

      // Mouse drag handlers
      this.root.addEventListener('mousedown', e => {
        if (e.target.closest('a') || e.target.closest('button')) return;
        onDragStart(e.clientX);
      });

      window.addEventListener('mousemove', e => {
        onDragMove(e.clientX);
      });

      window.addEventListener('mouseup', () => {
        onDragEnd();
      });

      // Touch handlers
      this.root.addEventListener(
        'touchstart',
        e => {
          if (e.touches && e.touches[0]) {
            if (e.target.closest('a') || e.target.closest('button')) return;
            onDragStart(e.touches[0].clientX);
          }
        },
        { passive: true }
      );

      this.root.addEventListener(
        'touchmove',
        e => {
          if (e.touches && e.touches[0]) {
            onDragMove(e.touches[0].clientX);
          }
        },
        { passive: true }
      );

      this.root.addEventListener('touchend', () => {
        onDragEnd();
      });

      // 3. Click any inactive satellite card to bring it to center focus
      this.items.forEach((item, idx) => {
        item.addEventListener('click', e => {
          if (this.hasMoved) return;
          if (idx === this.activeIndex) return;
          if (e.target.closest('a') || e.target.closest('button')) return;
          e.preventDefault();
          this.setActive(idx);
        });
      });

      // 4. Pause RAF only when scrolled far off-screen for scroll performance (keep spinning on hover!)
      if ('IntersectionObserver' in window) {
        const viewObserver = new IntersectionObserver(
          entries => {
            this.isInView = entries[0].isIntersecting;
            if (this.isInView) {
              this.lastTickTime = performance.now();
            }
          },
          { rootMargin: '150px 0px' }
        );
        viewObserver.observe(this.root);
      }

      // 5. Responsive window & container resize handling (syncs DevTools mobile toolbar toggles immediately)
      let resizeTimer = null;
      const syncResponsiveBuild = () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
          this.build();
          this.render(this.currentRot);
        }, 80);
      };
      window.addEventListener('resize', syncResponsiveBuild);
      if ('ResizeObserver' in window) {
        const ro = new ResizeObserver(syncResponsiveBuild);
        ro.observe(this.root);
      }
    }
  }

  // Auto-initialize when DOM is ready
  function init() {
    const container = document.getElementById('services-orbit-container');
    if (!container) return;

    const engine = new OrbitServicesEngine(container, {
      autoRotate: true,
      speed: 0.22
    });

    window.__shreeTechOrbit = engine;
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
