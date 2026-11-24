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
      this.height = this.root.clientHeight || 750;
      this.isMobile = this.width < 768;
      this.isTablet = this.width >= 768 && this.width < 1100;

      // Calculate horizontal elliptical path geometry (reduced for elegant framing)
      if (this.isMobile) {
        this.rx = Math.min(270, Math.round(this.width * 0.38));
        this.ry = Math.min(130, Math.round(this.height * 0.21));
        this.cx = this.width / 2;
        this.cy = this.height / 2 - 10;
      } else if (this.isTablet) {
        this.rx = Math.min(340, Math.round(this.width * 0.34));
        this.ry = Math.min(145, Math.round(this.height * 0.21));
        this.cx = this.width / 2;
        this.cy = this.height / 2 - 18;
      } else {
        // Desktop: reduced radius for a tighter, elegant ellipse
        this.rx = Math.min(390, Math.round(this.width * 0.32));
        this.ry = Math.min(160, Math.round(this.height * 0.21));
        this.cx = this.width / 2;
        this.cy = this.height / 2 - 20;
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

      // Symmetrical orbit slot angles in degrees (clockwise)
      // Slot 0: Focus Center (front bottom, 90 deg)
      // Slots 1-7: Satellites passing cleanly along reduced orbit line
      const SLOT_ANGLES_DEG = [
        90,     // Slot 0: Center active (front bottom)
        28,     // Slot 1: Satellite bottom-right (clears center card)
        -12,    // Slot 2: Satellite mid-right
        -52,    // Slot 3: Satellite top-right
        -90,    // Slot 4: Satellite top center
        -128,   // Slot 5: Satellite top-left
        -168,   // Slot 6: Satellite mid-left
        -208    // Slot 7: Satellite bottom-left (= 152 deg, clears center card)
      ];

      if (!animate) {
        this.items.forEach(it => {
          it.style.transition = 'none';
        });
      }

      for (let i = 0; i < this.count; i++) {
        const it = this.items[i];
        // Relative slot distance from current active index
        const relIdx = (i - this.activeIndex + this.count) % this.count;
        const isCenter = relIdx === 0;

        const angleDeg = SLOT_ANGLES_DEG[relIdx] !== undefined
          ? SLOT_ANGLES_DEG[relIdx]
          : (90 - relIdx * (360 / this.count));
        const angle = (angleDeg * Math.PI) / 180;
        const px = this.cx + this.rx * Math.cos(angle);
        const py = this.cy + this.ry * Math.sin(angle);
        const depth = Math.sin(angle); // 1 = front bottom, -1 = back top

        let zIndex, transform;

        if (isCenter) {
          zIndex = 100;
          // Center-anchored GPU scaling: card expands symmetrically outward from its center
          transform = `translate3d(${Math.round(px)}px, ${Math.round(py)}px, 0px) translate(-50%, -50%) scale(1)`;
          it.classList.add('is-active');
        } else {
          // Subtle organic depth scale for 3D realism
          const depthNorm = (depth + 1) / 2; // 0 (back) to 1 (front sides)
          const scale = 0.90 + 0.10 * depthNorm;
          zIndex = 10 + Math.round(depthNorm * 40);
          // Center-anchored GPU scaling: card glides and contracts symmetrically into its center
          transform = `translate3d(${Math.round(px)}px, ${Math.round(py)}px, 0px) translate(-50%, -50%) scale(${scale.toFixed(3)})`;
          it.classList.remove('is-active');
        }

        // Apply hardware-accelerated transform & positioning
        it.style.transform = transform;
        it.style.zIndex = String(zIndex);
      }

      if (!animate) {
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            this.items.forEach(it => {
              it.style.transition = '';
            });
          });
        });
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

      // Desktop Mouse Drag state
      let isMouseDown = false;
      let mouseStartX = 0;
      let dragDistance = 0;
      let hasDragged = false;

      this.root.addEventListener('mousedown', e => {
        if (e.target.closest('a') || e.target.closest('button')) return;
        isMouseDown = true;
        hasDragged = false;
        mouseStartX = e.clientX;
        dragDistance = 0;
        this.root.setAttribute('data-dragging', 'true');
      });

      window.addEventListener('mousemove', e => {
        if (!isMouseDown) return;
        dragDistance = e.clientX - mouseStartX;
        if (Math.abs(dragDistance) > 8) {
          hasDragged = true;
        }
      });

      window.addEventListener('mouseup', () => {
        if (!isMouseDown) return;
        isMouseDown = false;
        this.root.removeAttribute('data-dragging');
        if (hasDragged && Math.abs(dragDistance) > 35) {
          if (dragDistance < 0) {
            this.next();
          } else {
            this.prev();
          }
        }
        setTimeout(() => {
          hasDragged = false;
        }, 50);
      });

      // Mouse wheel support (carousel-like horizontal stepping)
      let wheelCooldown = false;
      this.root.addEventListener(
        'wheel',
        e => {
          const delta = Math.abs(e.deltaX) > Math.abs(e.deltaY) ? e.deltaX : e.deltaY;
          if (Math.abs(delta) < 25 || wheelCooldown) return;
          wheelCooldown = true;
          if (delta > 0) {
            this.next();
          } else {
            this.prev();
          }
          setTimeout(() => {
            wheelCooldown = false;
          }, 600);
        },
        { passive: true }
      );

      // 2. Click any inactive satellite card to bring it to center focus
      this.items.forEach((item, idx) => {
        item.addEventListener('click', e => {
          if (hasDragged) return; // Prevent triggering if dragged
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
