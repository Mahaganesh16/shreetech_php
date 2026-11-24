/**
 * Shree Tech - Continuous Curved 3D Orbit Carousel Engine
 * High-Performance 60FPS RAF with 3D Depth, Real-Time Dragging & Continuous Glide
 */
(function () {
  'use strict';

  // Symmetrical orbit slot angles in degrees (clockwise)
  // Slot 0: Center Active Focus (front bottom, 90 deg)
  // Slots 1-7: Satellites passing cleanly along reduced orbit line
  const SLOT_ANGLES = [90, 28, -12, -52, -90, -128, -168, -208];

  // Silky quartic ease-out for authentic carousel gliding
  function easeOutQuart(x) {
    return 1 - Math.pow(1 - x, 4);
  }

  class OrbitServicesEngine {
    constructor(root, options = {}) {
      this.root = root;
      this.options = Object.assign(
        {
          autoRotate: true,
          interval: 2600,
          onActiveChange: null
        },
        options
      );

      this.items = Array.from(this.root.querySelectorAll('[data-orbit-item]'));
      this.count = this.items.length;
      this.activeIndex = 0;

      // Continuous rotation float (0.0 = card 0 active, 1.0 = card 1 active, etc.)
      this.currentRot = 0;
      this.targetRot = 0;
      this.isAnimating = false;
      this.rafId = null;

      // Interaction flags
      this.timer = null;
      this.isPaused = false;
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

    /**
     * Continuous 60fps rendering of all cards at rotation float `rot`
     * Guarantees every card center is mathematically ON the ellipse arc at every millisecond
     */
    render(rot) {
      const count = this.count;

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
        const isCenter = distFromCenter < 0.5;

        // Subtle 3D Y-axis tilt: cards face gently inward toward the center
        const tiltY = -Math.cos(angleRad) * 10;

        // Continuous smooth scaling:
        // When center card: swells smoothly to 1.0 at center
        // When satellite: scales organically with 3D depth from 0.88 (back) to 0.94 (sides)
        let scale;
        if (isCenter) {
          scale = 1.0 - distFromCenter * 0.12;
        } else {
          scale = 0.88 + 0.08 * depthNorm;
        }

        const opacity = isCenter ? 1 : (0.75 + 0.25 * depthNorm);
        const zIndex = isCenter ? 100 : (10 + Math.round(depthNorm * 40));

        // Center-anchored GPU transform with 3D perspective
        it.style.transform = `translate3d(${Math.round(px)}px, ${Math.round(py)}px, 0px) translate(-50%, -50%) rotateY(${tiltY.toFixed(1)}deg) scale(${scale.toFixed(3)})`;
        it.style.zIndex = String(zIndex);
        it.style.opacity = opacity.toFixed(2);

        // Toggle active class smoothly
        if (isCenter && !it.classList.contains('is-active')) {
          it.classList.add('is-active');
        } else if (!isCenter && it.classList.contains('is-active')) {
          it.classList.remove('is-active');
        }
      }
    }

    /**
     * Smoothly animates carousel rotation from currentRot to targetRot over duration (ms)
     */
    animateTo(targetRot, duration = 600) {
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
        const ease = easeOutQuart(progress);

        this.currentRot = startRot + (targetRot - startRot) * ease;
        this.render(this.currentRot);

        if (progress < 1) {
          this.rafId = requestAnimationFrame(tick);
        } else {
          this.currentRot = targetRot;
          this.activeIndex = ((Math.round(targetRot) % this.count) + this.count) % this.count;
          this.render(this.currentRot);
          this.isAnimating = false;
          this.rafId = null;

          if (typeof this.options.onActiveChange === 'function') {
            this.options.onActiveChange(this.activeIndex);
          }
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
      this.animateTo(this.targetRot, 620);
      this.resetAutoRotate();
    }

    next() {
      this.targetRot = Math.round(this.currentRot) + 1;
      this.animateTo(this.targetRot, 600);
      this.resetAutoRotate();
    }

    prev() {
      this.targetRot = Math.round(this.currentRot) - 1;
      this.animateTo(this.targetRot, 600);
      this.resetAutoRotate();
    }

    startAutoRotate() {
      if (!this.options.autoRotate) return;
      this.stopAutoRotate();
      this.timer = setInterval(() => {
        if (!this.isPaused && !this.isDragging) {
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

      // 2. Interactive Dragging: Desktop Mouse & Mobile Touch
      const onDragStart = (clientX, isTouch = false) => {
        this.isDragging = true;
        this.hasMoved = false;
        this.dragStartX = clientX;
        this.rotAtDragStart = this.currentRot;
        this.root.setAttribute('data-dragging', 'true');
        if (this.rafId) {
          cancelAnimationFrame(this.rafId);
          this.rafId = null;
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

        // Snap smoothly to nearest integer slot with momentum
        const nearestSlot = Math.round(this.currentRot);
        this.targetRot = nearestSlot;
        this.animateTo(nearestSlot, 420);
        this.resetAutoRotate();

        setTimeout(() => {
          this.hasMoved = false;
        }, 50);
      };

      // Mouse drag handlers
      this.root.addEventListener('mousedown', e => {
        if (e.target.closest('a') || e.target.closest('button')) return;
        onDragStart(e.clientX, false);
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
            onDragStart(e.touches[0].clientX, true);
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

      // 3. Mouse Wheel Support (Carousel Stepping)
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
          }, 550);
        },
        { passive: true }
      );

      // 4. Click any inactive satellite card to bring it to center focus
      this.items.forEach((item, idx) => {
        item.addEventListener('click', e => {
          if (this.hasMoved) return; // Prevent triggering click if user dragged
          if (idx === this.activeIndex) return;
          if (e.target.closest('a') || e.target.closest('button')) return;
          e.preventDefault();
          this.setActive(idx);
        });
      });

      // 5. Pause auto-rotate on hover
      this.root.addEventListener('mouseenter', () => {
        this.isPaused = true;
      });

      this.root.addEventListener('mouseleave', () => {
        this.isPaused = false;
      });

      // 6. Responsive window resize handling
      let resizeTimer = null;
      window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
          this.build();
          this.render(this.currentRot);
        }, 150);
      });
    }
  }

  // Auto-initialize when DOM is ready
  function init() {
    const container = document.getElementById('services-orbit-container');
    if (!container) return;

    const engine = new OrbitServicesEngine(container, {
      autoRotate: true,
      interval: 2600
    });

    window.__shreeTechOrbit = engine;
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();
