/**
 * Shree Tech - Smooth Orbit Services Carousel Engine
 * Pure JavaScript with GPU-Accelerated CSS Transitions
 */
(function () {
  'use strict';

  class OrbitServicesEngine {
    constructor(root, options = {}) {
      this.root = root;
      this.options = Object.assign(
        {
          baseWidth: 1400,
          autoRotate: true,
          interval: 2000,
          onActiveChange: null
        },
        options
      );

      this.items = Array.from(this.root.querySelectorAll('[data-orbit-item]'));
      this.count = this.items.length;
      this.activeIndex = 0; // Starts with Service 01 active at center
      this.timer = null;
      this.isPaused = false;
      this.touchStartX = 0;
      this.touchStartY = 0;

      this.init();
    }

    init() {
      if (!this.root || !this.count) return;

      this.build();
      this.update(false); // Initial positioning without animation delay
      this.bindEvents();
      this.startAutoRotate();

      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
    }

    build() {
      this.width = this.root.clientWidth || 1200;
      this.height = this.root.clientHeight || 800;
      this.isMobile = this.width < 768;
      this.isTablet = this.width >= 768 && this.width < 1100;

      // Calculate horizontal elliptical path geometry
      if (this.isMobile) {
        this.rx = Math.min(340, this.width * 0.42);
        this.ry = Math.min(145, this.height * 0.22);
        this.cx = this.width / 2;
        this.cy = this.height / 2 - 10;
      } else if (this.isTablet) {
        this.rx = Math.min(410, this.width * 0.38);
        this.ry = Math.min(195, this.height * 0.25);
        this.cx = this.width / 2;
        this.cy = this.height / 2 - 15;
      } else {
        this.rx = Math.min(495, Math.round(this.width * 0.385));
        this.ry = Math.min(225, Math.round(this.height * 0.275));
        this.cx = this.width / 2;
        this.cy = this.height / 2 - 15;
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

    update(animate = true) {
      if (!this.items.length) return;

      const isMobile = this.isMobile;

      for (let i = 0; i < this.count; i++) {
        const it = this.items[i];
        // Relative slot distance from current active index
        const relIdx = (i - this.activeIndex + this.count) % this.count;
        const isCenter = relIdx === 0;

        // Angle around horizontal ellipse:
        // relIdx = 0: PI / 2 (90 deg, bottom center down-line)
        // relIdx = 1: next upcoming card (bottom right)
        // relIdx = 7: previous card (bottom left)
        const angle = Math.PI / 2 - relIdx * (2 * Math.PI / this.count);
        const px = this.cx + this.rx * Math.cos(angle);
        const py = this.cy + this.ry * Math.sin(angle);
        const depth = Math.sin(angle); // 1 = front bottom, -1 = back top

        let w, h, sx, sy, zIndex, transform;

        if (isCenter) {
          // Large Featured Card at Focus Center
          w = isMobile ? 330 : (this.isTablet ? 380 : 440);
          h = isMobile ? 370 : (this.isTablet ? 370 : 400);
          const elevate = isMobile ? 18 : 32;
          sx = Math.round(px - w / 2);
          sy = Math.round(py - h / 2 - elevate);
          zIndex = 100;
          transform = `translate3d(${sx}px, ${sy}px, 0px) scale(1)`;

          it.classList.add('is-active');
        } else {
          // Small Compact Satellite Card
          w = isMobile ? 165 : (this.isTablet ? 180 : 205);
          h = isMobile ? 120 : (this.isTablet ? 130 : 142);
          sx = Math.round(px - w / 2);
          sy = Math.round(py - h / 2);

          // Subtle organic depth scale for 3D realism
          const depthNorm = (depth + 1) / 2; // 0 (back) to 1 (front sides)
          const scale = 0.92 + 0.08 * depthNorm;
          zIndex = 10 + Math.round(depthNorm * 40);
          transform = `translate3d(${sx}px, ${sy}px, 0px) scale(${scale.toFixed(3)})`;

          it.classList.remove('is-active');
        }

        // Apply hardware-accelerated transform & positioning
        it.style.transform = transform;
        it.style.zIndex = String(zIndex);
      }

      if (typeof this.options.onActiveChange === 'function') {
        this.options.onActiveChange(this.activeIndex);
      }
    }

    setActive(index) {
      if (this.activeIndex === index) return;
      this.activeIndex = (index + this.count) % this.count;
      this.update(true);
      this.resetAutoRotate();
    }

    next() {
      this.setActive((this.activeIndex + 1) % this.count);
    }

    prev() {
      this.setActive((this.activeIndex - 1 + this.count) % this.count);
    }

    startAutoRotate() {
      if (!this.options.autoRotate) return;
      this.stopAutoRotate();
      this.timer = setInterval(() => {
        if (!this.isPaused) {
          this.next();
        }
      }, this.options.interval);
    }

    stopAutoRotate() {
      if (this.timer) {
        clearInterval(this.timer);
        this.timer = null;
      }
    }

    resetAutoRotate() {
      if (this.options.autoRotate) {
        this.startAutoRotate();
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

      // 2. Click any inactive satellite card to bring it to center focus
      this.items.forEach((item, idx) => {
        item.addEventListener('click', e => {
          // If already active or clicked on an action button/link, don't trigger parent click
          if (idx === this.activeIndex) return;
          if (e.target.closest('a') || e.target.closest('button')) return;
          e.preventDefault();
          this.setActive(idx);
        });
      });

      // 3. Pause auto-rotate on hover
      this.root.addEventListener('mouseenter', () => {
        this.isPaused = true;
      });

      this.root.addEventListener('mouseleave', () => {
        this.isPaused = false;
      });

      // 4. Touch swipe gesture support for mobile & tablet
      this.root.addEventListener(
        'touchstart',
        e => {
          if (e.touches && e.touches[0]) {
            this.touchStartX = e.touches[0].clientX;
            this.touchStartY = e.touches[0].clientY;
          }
        },
        { passive: true }
      );

      this.root.addEventListener(
        'touchend',
        e => {
          if (!this.touchStartX) return;
          const endX = e.changedTouches[0].clientX;
          const endY = e.changedTouches[0].clientY;
          const diffX = endX - this.touchStartX;
          const diffY = endY - this.touchStartY;

          // Only trigger if horizontal swipe is prominent
          if (Math.abs(diffX) > 40 && Math.abs(diffX) > Math.abs(diffY)) {
            if (diffX < 0) {
              this.next(); // Swipe left -> advance to next card
            } else {
              this.prev(); // Swipe right -> back to previous card
            }
          }
          this.touchStartX = 0;
        },
        { passive: true }
      );

      // 5. Responsive window resize handling
      let resizeTimer = null;
      window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
          this.build();
          this.update(false);
        }, 150);
      });
    }
  }

  // Auto-initialize when DOM is ready
  function init() {
    const container = document.getElementById('services-orbit-container');
    if (!container) return;

    const engine = new OrbitServicesEngine(container, {
      baseWidth: 1400,
      autoRotate: true,
      interval: 2000
    });

    window.__shreeTechOrbit = engine;
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
