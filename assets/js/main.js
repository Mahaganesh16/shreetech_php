/**
 * Shree Tech - Core JavaScript & Full Animation Engine
 * Faithfully ported from Next.js & Framer Motion to native Vanilla JS
 */

function initShreeTech() {
  if (window.__shreeTechInitialized) return;
  window.__shreeTechInitialized = true;

  const prefersReducedMotion = !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);

  // 0. Initialize Lenis Smooth Scroll Engine (Singleton + Explicit RAF Loop)
  let lenis = window.__lenis || null;
  if (!lenis && typeof Lenis !== 'undefined' && !prefersReducedMotion) {
    lenis = new Lenis({
      lerp: 0.1,
      wheelMultiplier: 1.0,
      touchMultiplier: 1.25,
      smoothWheel: true,
      syncTouch: false,
      autoRaf: false,
    });

    // Prevent per-frame html.className mutations that trigger runtime CSS MutationObservers
    lenis.updateClassName = function () {};
    document.documentElement.classList.add('lenis');

    function raf(time) {
      lenis.raf(time);
      requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    window.__lenis = lenis;
  }

  // 0.1 Initialize Lucide Icons
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // =========================================================================
  // 1. SCROLL-TRIGGERED ENTRANCE REVEAL ENGINE (FRAMER MOTION EQUIVALENT)
  // =========================================================================
  const revealElements = document.querySelectorAll(
    '.reveal-init, .reveal-up, .reveal-scale, .reveal-left, .reveal-right, .reveal-fade'
  );

  function revealAllNow() {
    revealElements.forEach((el) => {
      if (el.getAttribute('data-revealed') !== 'true') {
        el.setAttribute('data-revealed', 'true');
      }
    });
  }

  if ('IntersectionObserver' in window && revealElements.length > 0) {
    const revealObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.setAttribute('data-revealed', 'true');
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.01,
        rootMargin: '120px 0px 80px 0px',
      }
    );

    revealElements.forEach((el) => {
      // Immediately reveal elements already inside or near the viewport
      const rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight + 150 && rect.bottom > -100) {
        el.setAttribute('data-revealed', 'true');
      } else {
        revealObserver.observe(el);
      }
    });

    // Safety fallback: ensure cards are never stuck invisible if scrolling fast or on complex layouts
    setTimeout(revealAllNow, 500);
  } else {
    // Fallback for browsers without IntersectionObserver
    revealAllNow();
  }

  // =========================================================================
  // 2. DYNAMIC CURSOR SPOTLIGHT ON CARDS (OPTIMIZED & CONFLICT-FREE)
  // =========================================================================
  const spotlightCards = document.querySelectorAll('.glass-card:not(.flip-card-front):not(.flip-card-back)');

  spotlightCards.forEach((card) => {
    // Ensure spotlight layer exists
    let spotlight = card.querySelector('.card-spotlight-layer');
    if (!spotlight) {
      spotlight = document.createElement('div');
      spotlight.className = 'card-spotlight-layer pointer-events-none absolute inset-0';
      spotlight.style.position = 'absolute';
      card.prepend(spotlight);
    }

    card.addEventListener('mousemove', (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      if (spotlight) {
        spotlight.style.background = `radial-gradient(350px circle at ${x}px ${y}px, rgba(255, 107, 0, 0.12), transparent 75%)`;
        spotlight.style.opacity = '1';
      }
    });

    card.addEventListener('mouseleave', () => {
      if (spotlight) {
        spotlight.style.opacity = '0';
      }
    });
  });

  // =========================================================================
  // 3. HARDWARE-ACCELERATED 3D CARD FLIP ON CLICK / TOUCH
  // =========================================================================
  const flipCardWrappers = document.querySelectorAll('.flip-card-wrapper');
  const canHoverFine = !!(window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches);
  flipCardWrappers.forEach((wrapper) => {
    let touchStartX = 0;
    let touchStartY = 0;
    let lastTouchTime = 0;
    let lastFlipToggle = 0;

    const toggleFlip = (e) => {
      // Don't flip if user interacted with a link or button inside back card
      if (e.target.closest('a') || e.target.closest('button')) {
        return;
      }
      const now = performance.now();
      if (now - lastFlipToggle < 400) return; // Prevent double-toggle from touchend + click or rapid bounce
      lastFlipToggle = now;

      const inner = wrapper.querySelector('.flip-card-inner');
      if (inner) {
        const nextState = inner.getAttribute('data-flipped') !== 'true';
        if (nextState) {
          inner.setAttribute('data-flipped', 'true');
        } else {
          inner.removeAttribute('data-flipped');
        }
      }
    };

    wrapper.addEventListener('touchstart', (e) => {
      lastTouchTime = performance.now();
      if (e.touches && e.touches[0]) {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
      }
    }, { passive: true });

    wrapper.addEventListener('touchend', (e) => {
      if (e.changedTouches && e.changedTouches[0]) {
        const dx = Math.abs(e.changedTouches[0].clientX - touchStartX);
        const dy = Math.abs(e.changedTouches[0].clientY - touchStartY);
        if (dx < 10 && dy < 10) {
          toggleFlip(e);
        }
      }
    }, { passive: true });

    wrapper.addEventListener('click', (e) => {
      const isTouchTap = !canHoverFine || (performance.now() - lastTouchTime < 700);
      if (!isTouchTap) return;
      toggleFlip(e);
    });
  });

  // =========================================================================
  // 4. HERO ROTATING HEADLINE WITH BLUR & SLIDE (AnimatePresence EQUIVALENT)
  // =========================================================================
  const rotatingPhrases = [
    'Move Businesses Forward.',
    'Move Design Forward.'
  ];
  const phraseEl = document.getElementById('hero-rotating-phrase');
  if (phraseEl) {
    let pIdx = 0;
    setInterval(() => {
      pIdx = (pIdx + 1) % rotatingPhrases.length;
      phraseEl.style.transition = 'all 0.4s cubic-bezier(0.22, 1, 0.36, 1)';
      phraseEl.style.opacity = '0';
      phraseEl.style.transform = 'translateY(14px)';
      phraseEl.style.filter = 'blur(4px)';

      setTimeout(() => {
        phraseEl.textContent = rotatingPhrases[pIdx];
        phraseEl.style.opacity = '1';
        phraseEl.style.transform = 'translateY(0)';
        phraseEl.style.filter = 'blur(0px)';
      }, 380);
    }, 3400);
  }

  // =========================================================================
  // 5. NAVBAR SCROLL HIDE/SHOW & MOBILE MENU TOGGLE
  // =========================================================================
  const header = document.getElementById('main-header') || document.querySelector('header');
  const mobileToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  let lastHeaderScrollY = Math.max(0, window.scrollY || 0);
  let lastHeaderHidden = null;

  const setHeaderHidden = (hidden) => {
    if (!header || hidden === lastHeaderHidden) return;
    lastHeaderHidden = hidden;
    if (hidden) {
      header.setAttribute('data-nav-hidden', 'true');
      if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
        mobileMenu.classList.add('hidden');
      }
    } else {
      header.removeAttribute('data-nav-hidden');
    }
  };

  const updateHeaderScroll = (scrollPos) => {
    const rawY = typeof scrollPos === 'number' ? scrollPos : window.scrollY;
    const y = Math.max(0, rawY);

    const delta = y - lastHeaderScrollY;
    if (y <= 40) {
      // Always visible at the top of the page
      setHeaderHidden(false);
      lastHeaderScrollY = y;
    } else if (delta > 4) {
      // Scrolling down -> hide navbar
      setHeaderHidden(true);
      lastHeaderScrollY = y;
    } else if (delta < -4) {
      // Scrolling up -> show navbar
      setHeaderHidden(false);
      lastHeaderScrollY = y;
    }
  };
  if (!lenis) {
    window.addEventListener('scroll', () => updateHeaderScroll(), { passive: true });
  }
  updateHeaderScroll();

  if (mobileToggle && mobileMenu) {
    mobileToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }

  // =========================================================================
  // 7. TESTIMONIALS AUTO-DRIFT WITH MULTI-MODE INTERACTION
  // =========================================================================
  const testTrack = document.getElementById('testimonials-track');
  const btnPrev = document.getElementById('testimonials-prev');
  const btnNext = document.getElementById('testimonials-next');

  if (testTrack) {
    let isHovered = false;
    let isInteracting = false;
    let isVisible = false;
    let interactionTimeout = null;

    testTrack.addEventListener('mouseenter', () => { isHovered = true; });
    testTrack.addEventListener('mouseleave', () => { isHovered = false; });
    testTrack.addEventListener('touchstart', () => { isHovered = true; }, { passive: true });
    testTrack.addEventListener('touchend', () => { isHovered = false; });

    let driftRafId = null;
    let cachedHalfScrollWidth = testTrack.scrollWidth / 2;
    let virtualScrollLeft = testTrack.scrollLeft;
    window.addEventListener('resize', () => {
      cachedHalfScrollWidth = testTrack.scrollWidth / 2;
    }, { passive: true });
    testTrack.addEventListener('scroll', () => {
      if (isHovered || isInteracting) {
        virtualScrollLeft = testTrack.scrollLeft;
      }
    }, { passive: true });

    const stepDrift = () => {
      driftRafId = null;
      if (!isVisible || prefersReducedMotion) return;
      if (!isHovered && !isInteracting && testTrack) {
        virtualScrollLeft += 0.85;
        if (cachedHalfScrollWidth > 0 && virtualScrollLeft >= cachedHalfScrollWidth) {
          virtualScrollLeft -= cachedHalfScrollWidth;
        }
        testTrack.scrollLeft = virtualScrollLeft;
      }
      driftRafId = requestAnimationFrame(stepDrift);
    };

    const startDrift = () => {
      if (!driftRafId && isVisible && !prefersReducedMotion) {
        driftRafId = requestAnimationFrame(stepDrift);
      }
    };

    const stopDrift = () => {
      if (driftRafId) {
        cancelAnimationFrame(driftRafId);
        driftRafId = null;
      }
    };

    const testSection = document.getElementById('testimonials');
    if ('IntersectionObserver' in window && testSection) {
      const io = new IntersectionObserver((entries) => {
        isVisible = entries[0].isIntersecting;
        if (isVisible) {
          startDrift();
        } else {
          stopDrift();
        }
      }, { rootMargin: '100px' });
      io.observe(testSection);
    } else {
      isVisible = true;
      startDrift();
    }

    function nudgeTrack(direction) {
      if (!testTrack) return;
      isInteracting = true;
      if (interactionTimeout) clearTimeout(interactionTimeout);
      interactionTimeout = setTimeout(() => { isInteracting = false; }, 850);

      const step = window.innerWidth < 640 ? 340 : 470;
      if (direction === 'left') {
        if (testTrack.scrollLeft <= 50) {
          testTrack.scrollLeft += testTrack.scrollWidth / 2;
        }
        testTrack.scrollBy({ left: -step, behavior: 'smooth' });
      } else {
        if (testTrack.scrollLeft >= testTrack.scrollWidth / 2) {
          testTrack.scrollLeft -= testTrack.scrollWidth / 2;
        }
        testTrack.scrollBy({ left: step, behavior: 'smooth' });
      }
    }

    if (btnPrev) btnPrev.addEventListener('click', () => nudgeTrack('left'));
    if (btnNext) btnNext.addEventListener('click', () => nudgeTrack('right'));

    // Keyboard Arrow Keys support
    window.addEventListener('keydown', (e) => {
      if (['INPUT', 'TEXTAREA'].includes(document.activeElement?.tagName)) return;
      if (e.key === 'ArrowLeft') {
        e.preventDefault();
        nudgeTrack('left');
      } else if (e.key === 'ArrowRight') {
        e.preventDefault();
        nudgeTrack('right');
      }
    });
  }

  // =========================================================================
  // 8. STAT COUNTER ANIMATION WITH CUBIC EASING (FROM About.tsx)
  // =========================================================================
  const statNumbers = document.querySelectorAll('.stat-counter-number');
  if (statNumbers.length > 0 && 'IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const el = entry.target;
          const target = parseInt(el.getAttribute('data-target') || '0', 10);
          const duration = 1200;
          const stepTime = 1000 / 60;
          const totalSteps = duration / stepTime;
          let step = 0;

          const counter = setInterval(() => {
            step++;
            const progress = step / totalSteps;
            const current = Math.round(target * (1 - Math.pow(1 - progress, 3)));
            el.textContent = current;
            if (step >= totalSteps) {
              clearInterval(counter);
              el.textContent = target;
            }
          }, stepTime);

          obs.unobserve(el);
        }
      });
    }, { threshold: 0.2 });

    statNumbers.forEach((num) => observer.observe(num));
  }

  // =========================================================================
  // 9. TECHNOLOGIES FILTER TABS WITH DIAGONAL TRACK SWITCHING & ANIMATION SYNC
  // =========================================================================
  const techTabs = document.querySelectorAll('.tech-filter-btn');
  const techGroups = document.querySelectorAll('.tech-category-group');
  const activeTitle = document.getElementById('active-category-title');
  const activeBadge = document.getElementById('active-category-badge');

  const categoryMeta = {
    'All': {
      badge: 'Multi-Discipline Engineering',
      title: 'All Technology Disciplines'
    },
    'Frontend': {
      badge: 'Client-Side Engineering',
      title: 'Frontend Languages & UI Frameworks (HTML, CSS, JS)'
    },
    'Backend': {
      badge: 'Server Architecture',
      title: 'Backend Frameworks & Server APIs (eg: Python, Laravel, PHP, Node.js)'
    },
    'Database': {
      badge: 'Data Layer & Caching',
      title: 'Database & Storage Systems (eg: MySQL, MongoDB, PostgreSQL, Redis)'
    },
    'Mobile': {
      badge: 'Native & Multiplatform',
      title: 'Mobile App Development (eg: Flutter, Swift, React Native, iOS)'
    },
    'Cloud': {
      badge: 'Infrastructure & DevOps',
      title: 'Cloud & DevOps Engineering (eg: AWS, Azure, Google Cloud, Docker)'
    }
  };

  techTabs.forEach((btn) => {
    btn.addEventListener('click', () => {
      const cat = btn.getAttribute('data-category');
      techTabs.forEach((b) => {
        b.classList.remove('glass-btn-primary', 'shadow-sm', 'text-white');
        b.classList.add('glass-btn-secondary', 'text-[#475569]');
      });
      btn.classList.add('glass-btn-primary', 'shadow-sm', 'text-white');
      btn.classList.remove('glass-btn-secondary', 'text-[#475569]');

      if (categoryMeta[cat]) {
        if (activeTitle) activeTitle.textContent = categoryMeta[cat].title;
        if (activeBadge) activeBadge.textContent = categoryMeta[cat].badge;
      }

      techGroups.forEach((group) => {
        const match = group.getAttribute('data-category') === cat;
        const tracks = group.querySelectorAll('.tech-row-track');
        if (match) {
          group.style.display = 'block';
          group.style.opacity = '0';
          group.style.transform = 'translateY(10px)';
          group.style.transition = 'all 0.35s ease';
          tracks.forEach((track) => {
            track.style.animationPlayState = 'running';
          });
          setTimeout(() => {
            group.style.opacity = '1';
            group.style.transform = 'translateY(0)';
          }, 30);
        } else {
          group.style.display = 'none';
        }
      });

      if (typeof lucide !== 'undefined') {
        lucide.createIcons();
      }
      if (typeof refreshSectionOffsets === 'function') {
        refreshSectionOffsets();
      }
      if (lenis) lenis.resize();
    });
  });

  // =========================================================================
  // 10. STICKY STACKING CARDS SCROLL ENGINE (PINNED STAGE + JAVASCRIPT SCROLL)
  // =========================================================================
  const pinTrack = document.getElementById('projects-pin-track');
  const pinStage = document.getElementById('projects-pin-stage');
  const deckContainer = document.querySelector('.stacking-deck-container');
  const stageHeader = pinStage ? pinStage.querySelector('.max-w-3xl') : null;
  const projectCards = document.querySelectorAll('.stacking-card-item');
  const projectTabs = document.querySelectorAll('.project-filter-btn');
  let lastStackProgress = -1;
  let visibleStackItems = [];
  let cachedTrackTop = 0;
  let cachedTrackMaxScroll = 0;
  let cachedTravelDistance = 620;
  let cachedIntroEnd = 0.06;
  let cachedAnimEnd = 0.89;

  function syncTrackBounds() {
    if (!pinTrack) return;
    cachedTrackTop = pinTrack.getBoundingClientRect().top + (window.scrollY || window.pageYOffset || 0);
    cachedTrackMaxScroll = Math.max(0, pinTrack.offsetHeight - window.innerHeight);
    cachedTravelDistance = Math.max(window.innerHeight * 0.95, 620);
  }

  function updateTrackHeight() {
    if (!pinTrack) return;
    visibleStackItems = Array.from(projectCards)
      .filter((card) => card.style.display !== 'none')
      .map((card, idx) => {
        card.style.setProperty('--stack-idx', idx);
        return {
          card,
          headerTab: card.querySelector('.stacking-card-header'),
          lastBg: '',
        };
      });
    const count = visibleStackItems.length;
    if (count <= 1) {
      pinTrack.style.height = '100vh';
      cachedIntroEnd = 0;
      cachedAnimEnd = 1;
    } else {
      // Generous sequential runway so every card arrives one-by-one before unpinning to next section
      const isCompactViewport = window.innerWidth < 768;
      const scrollPerCard = isCompactViewport ? 280 : 240;
      const introPad = 100;
      const outroHold = 180;
      const totalScrollTravel = introPad + (count - 1) * scrollPerCard + outroHold;
      cachedIntroEnd = introPad / totalScrollTravel;
      cachedAnimEnd = (totalScrollTravel - outroHold) / totalScrollTravel;
      pinTrack.style.height = `${window.innerHeight + totalScrollTravel}px`;
    }
    if (deckContainer) {
      deckContainer.style.transform = 'translate3d(0, 0, 0)';
      deckContainer.style.opacity = '1';
    }
    if (stageHeader) {
      stageHeader.style.opacity = '1';
    }
    syncTrackBounds();
    if (lenis) lenis.resize();
  }

  function updateStackingCards(forceUpdate = false, scrollPos) {
    if (!pinTrack || !pinStage || !visibleStackItems.length) return;

    const totalCards = visibleStackItems.length;
    if (totalCards === 1) {
      const onlyCard = visibleStackItems[0].card;
      onlyCard.style.transform = 'translate3d(0, 0, 0) scale(1) rotate(0deg)';
      onlyCard.style.opacity = '1';
      onlyCard.style.visibility = 'visible';
      onlyCard.style.pointerEvents = 'auto';
      return;
    }

    if (cachedTrackMaxScroll <= 0) {
      syncTrackBounds();
      if (cachedTrackMaxScroll <= 0) return;
    }

    // Progress goes strictly from 0 to 1 while pinned in the viewport (zero layout reads per scroll tick)
    const y = typeof scrollPos === 'number' ? scrollPos : (window.scrollY || window.pageYOffset || 0);
    const trackTop = cachedTrackTop - y;
    const progress = Math.min(Math.max(-trackTop / cachedTrackMaxScroll, 0), 1);
    if (!forceUpdate && Math.abs(progress - lastStackProgress) < 0.0005) {
      return;
    }
    lastStackProgress = progress;
    const totalSteps = totalCards - 1;

    // Timeline partitions computed from pixel pads so all cards arrive one-by-one before outro unpins
    const introEnd = cachedIntroEnd;
    const animEnd = cachedAnimEnd;
    const animSpan = Math.max(0.01, animEnd - introEnd);
    const stepSpan = animSpan / totalSteps;
    const travelDistance = cachedTravelDistance;

    for (let index = 0; index < totalCards; index++) {
      const item = visibleStackItems[index];
      const card = item.card;
      const headerTab = item.headerTab;

      if (index === 0) {
        // Foundation card: stays in place, dims & scales as cards stack over it
        let coveredDepth = 0;
        if (progress > introEnd) {
          coveredDepth = Math.min((progress - introEnd) / stepSpan, totalSteps);
        }

        const scale = Math.max(1 - coveredDepth * 0.024, 0.89);
        const tabR = Math.round(Math.max(255 - coveredDepth * 10, 226));
        const tabG = Math.round(Math.max(255 - coveredDepth * 9, 232));
        const tabB = Math.round(Math.max(255 - coveredDepth * 7, 240));
        const nextBg = `rgb(${tabR}, ${tabG}, ${tabB})`;

        card.style.transform = `translate3d(0, 0, 0) scale(${scale.toFixed(4)}) rotate(0deg)`;
        if (forceUpdate || card.dataset.cardState !== 'base') {
          card.dataset.cardState = 'base';
          card.style.opacity = '1';
          card.style.visibility = 'visible';
          card.style.pointerEvents = 'auto';
        }
        if (headerTab && item.lastBg !== nextBg) {
          item.lastBg = nextBg;
          headerTab.style.backgroundColor = nextBg;
        }
        continue;
      }

      // Subsequent cards (index >= 1)
      const stepStart = introEnd + (index - 1) * stepSpan;
      const stepEnd = introEnd + index * stepSpan;
      const initialTilt = (index % 2 === 1) ? -2.2 : 2.2;

      if (progress <= stepStart) {
        // Card is waiting below the stage (skip redundant writes if already waiting)
        if (card.dataset.cardState !== 'waiting' || forceUpdate) {
          card.dataset.cardState = 'waiting';
          card.style.transform = `translate3d(0, ${travelDistance}px, 0) scale(1) rotate(${initialTilt}deg)`;
          card.style.opacity = '0';
          card.style.visibility = 'hidden';
          card.style.pointerEvents = 'none';
          if (headerTab && item.lastBg !== 'rgb(255, 255, 255)') {
            item.lastBg = 'rgb(255, 255, 255)';
            headerTab.style.backgroundColor = 'rgb(255, 255, 255)';
          }
        }
      } else if (progress >= stepEnd) {
        // Card is fully docked; calculate depth from cards docked on top of it
        const cardsAbove = (progress - stepEnd) / stepSpan;
        const coveredDepth = Math.max(0, Math.min(cardsAbove, totalSteps - index));

        const scale = Math.max(1 - coveredDepth * 0.024, 0.89);
        const tabR = Math.round(Math.max(255 - coveredDepth * 10, 226));
        const tabG = Math.round(Math.max(255 - coveredDepth * 9, 232));
        const tabB = Math.round(Math.max(255 - coveredDepth * 7, 240));
        const nextBg = `rgb(${tabR}, ${tabG}, ${tabB})`;

        card.style.transform = `translate3d(0, 0, 0) scale(${scale.toFixed(4)}) rotate(0deg)`;
        if (card.dataset.cardState !== 'docked' || forceUpdate) {
          card.dataset.cardState = 'docked';
          card.style.opacity = '1';
          card.style.visibility = 'visible';
          card.style.pointerEvents = 'auto';
        }
        if (headerTab && item.lastBg !== nextBg) {
          item.lastBg = nextBg;
          headerTab.style.backgroundColor = nextBg;
        }
      } else {
        // Card is actively traveling and docking in line-by-line order
        const prevState = card.dataset.cardState;
        const t = (progress - stepStart) / (stepEnd - stepStart);
        // Smooth cubic ease-out
        const ease = 1 - Math.pow(1 - t, 2.5);

        const currentY = (1 - ease) * travelDistance;
        const currentTilt = (1 - ease) * initialTilt;
        // Fade in quickly during first 25% of travel, then fully opaque as it moves
        const currentOpacity = Math.min(t * 4.0, 1);

        card.style.transform = `translate3d(0, ${currentY.toFixed(1)}px, 0) scale(1) rotate(${currentTilt.toFixed(2)}deg)`;
        card.style.opacity = currentOpacity.toFixed(3);
        if (prevState !== 'moving' || forceUpdate) {
          card.dataset.cardState = 'moving';
          card.style.visibility = 'visible';
          card.style.pointerEvents = 'auto';
        }
        if (headerTab && item.lastBg !== 'rgb(255, 255, 255)') {
          item.lastBg = 'rgb(255, 255, 255)';
          headerTab.style.backgroundColor = 'rgb(255, 255, 255)';
        }
      }
    }
  }

  let stackTicking = false;
  function onStackScroll() {
    if (!stackTicking) {
      requestAnimationFrame(() => {
        updateStackingCards();
        stackTicking = false;
      });
      stackTicking = true;
    }
  }

  if (pinTrack) {
    updateTrackHeight();
    if (!lenis) {
      window.addEventListener('scroll', onStackScroll, { passive: true });
    }
    window.addEventListener('resize', () => {
      updateTrackHeight();
      updateStackingCards(true);
    }, { passive: true });
    window.addEventListener('load', () => {
      syncTrackBounds();
      updateStackingCards(true);
    }, { passive: true });
    updateStackingCards(true);
  }

  // Filter Buttons Handler
  projectTabs.forEach((btn) => {
    btn.addEventListener('click', () => {
      const cat = btn.getAttribute('data-category');
      projectTabs.forEach((b) => {
        b.classList.remove('glass-btn-primary', 'shadow-sm', 'text-white');
        b.classList.add('glass-btn-secondary', 'text-[#475569]');
      });
      btn.classList.add('glass-btn-primary', 'shadow-sm', 'text-white');
      btn.classList.remove('glass-btn-secondary', 'text-[#475569]');

      let visibleCount = 0;
      projectCards.forEach((card) => {
        const match = (cat === 'all' || card.getAttribute('data-category') === cat);
        if (match) {
          card.style.display = '';
          card.style.setProperty('--stack-idx', visibleCount);
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      // Recalculate track height and stacking immediately
      updateTrackHeight();
      updateStackingCards(true);
      if (typeof refreshSectionOffsets === 'function') {
        refreshSectionOffsets();
      }
    });
  });

  // Modal Setup
  const modal = document.getElementById('project-modal');
  const modalClose = document.getElementById('modal-close');
  const modalTriggers = document.querySelectorAll('.open-project-modal');

  if (modal) {
    const modalContent = modal.querySelector('.modal-dialog-box') || modal.firstElementChild;

    modalTriggers.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const title = btn.getAttribute('data-title') || '';
        const client = btn.getAttribute('data-client') || '';
        const summary = btn.getAttribute('data-summary') || '';
        const category = btn.getAttribute('data-category') || '';
        const metricVal = btn.getAttribute('data-metric-val') || '';
        const metricLabel = btn.getAttribute('data-metric-label') || '';

        const mTitle = document.getElementById('modal-title');
        const mClient = document.getElementById('modal-client');
        const mSummary = document.getElementById('modal-summary');
        const mCategory = document.getElementById('modal-category');
        const mMetricVal = document.getElementById('modal-metric-val');
        const mMetricLabel = document.getElementById('modal-metric-label');

        if (mTitle) mTitle.textContent = title;
        if (mClient) mClient.textContent = 'Client: ' + client;
        if (mSummary) mSummary.textContent = summary;
        if (mCategory) mCategory.textContent = category;
        if (mMetricVal) mMetricVal.textContent = metricVal;
        if (mMetricLabel) mMetricLabel.textContent = metricLabel;

        modal.classList.remove('hidden');
        modal.classList.add('modal-animate-backdrop');
        if (modalContent) modalContent.classList.add('modal-animate-content');
        document.body.style.overflow = 'hidden';
        if (lenis) lenis.stop();
      });
    });

    const closeModal = () => {
      modal.classList.add('hidden');
      modal.classList.remove('modal-animate-backdrop');
      if (modalContent) modalContent.classList.remove('modal-animate-content');
      document.body.style.overflow = '';
      if (lenis) lenis.start();
    };

    if (modalClose) modalClose.addEventListener('click', closeModal);

    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeModal();
    });

    window.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
      }
    });
  }

  // =========================================================================
  // 11. MAGNETIC BUTTONS (TACTILE CURSOR ATTRACTION)
  // =========================================================================
  const magneticButtons = document.querySelectorAll('.glass-btn-primary, .glass-btn-secondary');
  if (canHoverFine && !prefersReducedMotion) {
    magneticButtons.forEach((btn) => {
      btn.addEventListener('mousemove', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        btn.style.transform = `translate3d(${x * 0.15}px, ${y * 0.15}px, 0)`;
      });

      btn.addEventListener('mouseleave', () => {
        btn.style.transform = '';
        btn.style.transition = 'transform 0.3s cubic-bezier(0.16, 1, 0.3, 1)';
      });

      btn.addEventListener('mouseenter', () => {
        btn.style.transition = 'none';
      });
    });
  }

  // =========================================================================
  // 12. SHARED FORM VALIDATION, 10-DIGIT MASKING & REAL SMTP SUBMISSION
  // =========================================================================
  const validateNameValue = (raw) => {
    const cleaned = String(raw || '').replace(/\s+/g, ' ').trim();
    if (cleaned.length < 2 || cleaned.length > 80 || !/^[A-Za-z][A-Za-z\s.'-]{1,79}$/.test(cleaned)) {
      return 'Please enter a valid full name using letters only (2-80 chars).';
    }
    return '';
  };

  const validateEmailValue = (raw) => {
    const email = String(raw || '').trim();
    if (!email || email.length > 120 || !/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email)) {
      return 'Please enter a valid email address (e.g. name@company.com).';
    }
    return '';
  };

  const validateTenDigitPhoneValue = (raw) => {
    const digits = String(raw || '').replace(/\D+/g, '');
    if (!/^[0-9]{10}$/.test(digits) || digits === '0000000000') {
      return 'Please enter a valid 10-digit mobile number.';
    }
    return '';
  };

  const wireValidatedAjaxForm = ({
    form,
    endpoint,
    loadingText,
    bannerEl,
    bannerTextEl,
    validateFn,
    onSuccess,
  }) => {
    if (!form) return;

    const showBanner = (msg) => {
      if (bannerTextEl) bannerTextEl.textContent = msg;
      if (bannerEl) bannerEl.classList.remove('hidden');
    };

    const hideBanner = () => {
      if (bannerEl) bannerEl.classList.add('hidden');
      if (bannerTextEl) bannerTextEl.textContent = '';
    };

    const setFieldError = (fieldName, msg) => {
      const errEl = form.querySelector(`[data-field-error="${fieldName}"]`);
      const inputEl = form.querySelector(`[name="${fieldName}"]`);
      if (errEl) {
        errEl.textContent = msg || '';
        errEl.classList.toggle('hidden', !msg);
      }
      if (inputEl) {
        inputEl.classList.toggle('is-invalid', Boolean(msg));
      }
    };

    const clearAllFieldErrors = () => {
      form.querySelectorAll('[data-field-error]').forEach((el) => {
        el.textContent = '';
        el.classList.add('hidden');
      });
      form.querySelectorAll('input, select, textarea').forEach((el) => {
        el.classList.remove('is-invalid');
      });
    };

    // Enforce numeric-only 10 digits on type/paste (handles +91 or leading 0 pastes cleanly)
    const phoneInput = form.querySelector('input[name="phone"]');
    if (phoneInput) {
      const normalizePhoneValue = (raw) => {
        let digitsOnly = String(raw || '').replace(/\D+/g, '');
        if (digitsOnly.length === 12 && digitsOnly.startsWith('91')) {
          digitsOnly = digitsOnly.slice(2);
        } else if (digitsOnly.length === 11 && digitsOnly.startsWith('0')) {
          digitsOnly = digitsOnly.slice(1);
        }
        return digitsOnly.slice(0, 10);
      };
      phoneInput.addEventListener('paste', (ev) => {
        const text = ev.clipboardData ? ev.clipboardData.getData('text') : '';
        if (text) {
          ev.preventDefault();
          phoneInput.value = normalizePhoneValue(text);
          phoneInput.dispatchEvent(new Event('input', { bubbles: true }));
        }
      });
      phoneInput.addEventListener('input', () => {
        const clean = normalizePhoneValue(phoneInput.value);
        if (phoneInput.value !== clean) {
          phoneInput.value = clean;
        }
      });
    }

    // Clear inline field error immediately when user edits field
    form.querySelectorAll('input, select, textarea').forEach((el) => {
      const clearField = () => {
        const name = el.getAttribute('name');
        if (name) setFieldError(name, '');
        hideBanner();
      };
      el.addEventListener('input', clearField);
      el.addEventListener('change', clearField);
    });

    form.addEventListener('submit', async (e) => {
      if (form.getAttribute('data-ajax') === 'false') return;
      e.preventDefault();
      hideBanner();
      clearAllFieldErrors();

      const clientErrors = validateFn(form);
      const errKeys = Object.keys(clientErrors);
      if (errKeys.length > 0) {
        errKeys.forEach((k) => setFieldError(k, clientErrors[k]));
        const firstEl = form.querySelector(`[name="${errKeys[0]}"]`);
        if (firstEl) firstEl.focus();
        return;
      }

      const submitBtn = form.querySelector('button[type="submit"]');
      const originalHtml = submitBtn ? submitBtn.innerHTML : '';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `<span>${loadingText}</span>`;
      }

      try {
        const res = await fetch(endpoint, {
          method: 'POST',
          headers: { 'X-Requested-With': 'XMLHttpRequest' },
          body: new FormData(form),
        });
        const rawText = await res.text();
        let data = null;
        try {
          data = JSON.parse(rawText);
        } catch (_) {
          showBanner('Unexpected server response. Please try again.');
          return;
        }

        if (data && data.ok) {
          if (data.mode === 'web3forms_client' && data.endpoint && data.payload) {
            const wfRes = await fetch(data.endpoint, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
              },
              body: JSON.stringify(data.payload),
            });
            const wfText = await wfRes.text();
            let wfData = null;
            try {
              wfData = JSON.parse(wfText);
            } catch (_) {
              wfData = null;
            }
            if (!wfData || !(wfData.success === true || wfData.success === 'true')) {
              const fallbackMsg = wfRes.status === 403
                ? 'Email relay rejected the automated/headless request (HTTP 403). Test in a normal browser tab, or add a Gmail App Password in includes/mail-config.local.php.'
                : `Unable to deliver email via Web3Forms (HTTP ${wfRes.status}).`;
              showBanner((wfData && wfData.message) ? wfData.message : fallbackMsg);
              return;
            }
          }
          form.reset();
          onSuccess();
          if (typeof lucide !== 'undefined') lucide.createIcons();
        } else {
          if (data && data.errors && Object.keys(data.errors).length > 0) {
            Object.entries(data.errors).forEach(([k, msg]) => setFieldError(k, msg));
          } else {
            showBanner((data && data.message) ? data.message : 'Unable to submit right now.');
          }
        }
      } catch (err) {
        showBanner('Network error while sending submission. Please try again.');
      } finally {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalHtml;
          if (typeof lucide !== 'undefined') lucide.createIcons();
        }
      }
    });
  };

  // Contact Inquiry Form (index.php)
  const contactForm = document.getElementById('contact-form');
  const contactSuccess = document.getElementById('contact-success');
  const contactResetBtn = document.getElementById('contact-reset-btn');
  if (contactForm && contactSuccess) {
    wireValidatedAjaxForm({
      form: contactForm,
      endpoint: 'index.php',
      loadingText: 'Sending Inquiry...',
      bannerEl: document.getElementById('contact-error-banner'),
      bannerTextEl: document.getElementById('contact-error-text'),
      validateFn: (form) => {
        const errs = {};
        const nameErr = validateNameValue(form.querySelector('[name="name"]')?.value);
        const emailErr = validateEmailValue(form.querySelector('[name="email"]')?.value);
        const phoneErr = validateTenDigitPhoneValue(form.querySelector('[name="phone"]')?.value);
        const msg = String(form.querySelector('[name="message"]')?.value || '').trim();
        if (nameErr) errs.name = nameErr;
        if (emailErr) errs.email = emailErr;
        if (phoneErr) errs.phone = phoneErr;
        if (msg.length < 15 || msg.length > 2000) {
          errs.message = 'Project description must be between 15 and 2000 characters.';
        }
        return errs;
      },
      onSuccess: () => {
        contactForm.classList.add('hidden');
        contactSuccess.classList.remove('hidden');
      },
    });

    if (contactResetBtn) {
      contactResetBtn.addEventListener('click', () => {
        const errBanner = document.getElementById('contact-error-banner');
        if (errBanner) errBanner.classList.add('hidden');
        contactSuccess.classList.add('hidden');
        contactForm.classList.remove('hidden');
      });
    }
  }

  // Careers Resume Form (careers.php)
  const resumeForm = document.getElementById('careers-resume-form');
  const resumeSuccessModal = document.getElementById('resume-success-modal');
  if (resumeForm) {
    wireValidatedAjaxForm({
      form: resumeForm,
      endpoint: 'careers.php',
      loadingText: 'Submitting...',
      bannerEl: document.getElementById('career-error-banner'),
      bannerTextEl: document.getElementById('career-error-text'),
      validateFn: (form) => {
        const errs = {};
        const pos = String(form.querySelector('[name="position"]')?.value || '').trim();
        const cover = String(form.querySelector('[name="cover_letter"]')?.value || '').trim();
        const nameErr = validateNameValue(form.querySelector('[name="name"]')?.value);
        const emailErr = validateEmailValue(form.querySelector('[name="email"]')?.value);
        const phoneErr = validateTenDigitPhoneValue(form.querySelector('[name="phone"]')?.value);
        const fileInput = form.querySelector('[name="resume"]');
        const file = fileInput && fileInput.files ? fileInput.files[0] : null;

        if (!pos) errs.position = 'Please select an opening position.';
        if (cover.length > 3000) errs.cover_letter = 'Cover letter must be 3000 characters or fewer.';
        if (nameErr) errs.name = nameErr;
        if (emailErr) errs.email = emailErr;
        if (phoneErr) errs.phone = phoneErr;
        if (!file) {
          errs.resume = 'Please attach your resume (PDF, DOC, or DOCX up to 10MB).';
        } else {
          const ext = file.name.split('.').pop().toLowerCase();
          if (!['pdf', 'doc', 'docx'].includes(ext)) {
            errs.resume = 'Resume must be a PDF, DOC, or DOCX file.';
          } else if (file.size <= 0 || file.size > 10 * 1024 * 1024) {
            errs.resume = 'Resume file size must be between 1 byte and 10MB.';
          }
        }
        return errs;
      },
      onSuccess: () => {
        if (resumeSuccessModal) {
          resumeSuccessModal.classList.remove('opacity-0', 'pointer-events-none');
          resumeSuccessModal.querySelector('.relative').classList.remove('scale-95');
          resumeSuccessModal.querySelector('.relative').classList.add('scale-100');
          resumeSuccessModal.setAttribute('aria-hidden', 'false');
          if (lenis) lenis.stop();
        }
      },
    });
  }

  // =========================================================================
  // 13. SINGLE PAGE SCROLLSPY & UNIVERSAL ANCHOR NAVIGATION
  // =========================================================================
  const navTrackSections = [
    { id: 'home', navIndex: 0 },
    { id: 'about', navIndex: 1 },
    { id: 'why-us', navIndex: 1 },
    { id: 'services', navIndex: 2 },
    { id: 'technologies', navIndex: 3 },
    { id: 'projects', navIndex: 4 },
    { id: 'testimonials', navIndex: 4 },
    { id: 'contact', navIndex: -1 },
  ];

  let currentActiveNavIndex = -1;
  const gooeyEl = document.getElementById('shree-gooey-nav');
  const mobileNavLinks = document.querySelectorAll('#mobile-menu a[href^="#"]');

  const updateActiveNav = (newIndex, activeSectionId) => {
    if (newIndex === currentActiveNavIndex) return;
    currentActiveNavIndex = newIndex;

    // 1. Sync GooeyNav liquid pill if available
    if (gooeyEl && gooeyEl.__gooeyNavInstance && typeof gooeyEl.__gooeyNavInstance.select === 'function') {
      if (newIndex >= 0) {
        gooeyEl.__gooeyNavInstance.select(newIndex);
      } else {
        gooeyEl.querySelectorAll('.gooey-nav__item').forEach((it) => {
          it.removeAttribute('data-active');
          it.querySelector('.gooey-nav__link')?.removeAttribute('aria-current');
        });
      }
    }

    // 2. Sync mobile nav active link styling via data-mobile-active (avoids Tailwind class MutationObserver scan)
    if (mobileNavLinks && mobileNavLinks.length) {
      mobileNavLinks.forEach((link) => {
        const href = link.getAttribute('href');
        const isMatch = href === '#' + activeSectionId || (newIndex === 0 && href === '#home');
        if (isMatch) {
          link.setAttribute('data-mobile-active', 'true');
        } else {
          link.removeAttribute('data-mobile-active');
        }
      });
    }
  };

  let cachedSections = [];
  let cachedDocHeight = 0;
  let cachedWinHeight = window.innerHeight;
  let refreshSectionOffsets = () => {
    cachedDocHeight = document.documentElement.scrollHeight;
    cachedWinHeight = window.innerHeight;
    cachedSections = [];
    for (let i = 0; i < navTrackSections.length; i++) {
      const item = navTrackSections[i];
      const secEl = document.getElementById(item.id);
      if (secEl) {
        cachedSections.push({
          id: item.id,
          navIndex: item.navIndex,
          top: secEl.offsetTop,
        });
      }
    }
  };

  const evaluateScrollSpy = (scrollPos) => {
    const y = typeof scrollPos === 'number' ? scrollPos : window.scrollY;
    if (!cachedDocHeight || cachedSections.length === 0) {
      refreshSectionOffsets();
    }

    // If user reaches near bottom of the page, unselect dock nav
    const scrollBottom = y + cachedWinHeight;
    if (scrollBottom >= cachedDocHeight - 80) {
      updateActiveNav(-1, 'contact');
      return;
    }

    const scrollTriggerPos = y + 180;
    let activeIndex = 0;
    let activeId = 'home';

    for (let i = cachedSections.length - 1; i >= 0; i--) {
      const item = cachedSections[i];
      if (scrollTriggerPos >= item.top) {
        activeIndex = item.navIndex;
        activeId = item.id;
        break;
      }
    }

    updateActiveNav(activeIndex, activeId);
  };

  let scrollSpyTicking = false;
  const onScrollSpy = (scrollPos) => {
    if (typeof scrollPos === 'number') {
      evaluateScrollSpy(scrollPos);
      return;
    }
    if (scrollSpyTicking) return;
    scrollSpyTicking = true;
    requestAnimationFrame(() => {
      scrollSpyTicking = false;
      evaluateScrollSpy();
    });
  };

  // Only enable scrollspy on pages with single-page section anchors (like index.php)
  const isSinglePageApp = !!document.getElementById('services');
  if (isSinglePageApp) {
    refreshSectionOffsets();
    window.addEventListener('resize', refreshSectionOffsets, { passive: true });
    window.addEventListener('load', refreshSectionOffsets, { passive: true });
    if (!lenis) {
      window.addEventListener('scroll', () => onScrollSpy(), { passive: true });
    }
    setTimeout(() => {
      refreshSectionOffsets();
      evaluateScrollSpy();
    }, 200);
  }

  // Smooth scroll handler for all internal anchor links (Directory cards, mobile links, buttons, footer)
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    // Avoid double-handling gooey-nav links
    if (anchor.closest('.gooey-nav')) return;

    anchor.addEventListener('click', (e) => {
      const hash = anchor.getAttribute('href');
      if (!hash || hash === '#' || hash.startsWith('#!')) return;

      const target = document.querySelector(hash);
      if (target) {
        e.preventDefault();

        // Close mobile dropdown menu if open
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
          mobileMenu.classList.add('hidden');
        }

        // Scroll to target with offset for sticky navbar
        const navOffset = 80;
        const targetTop = target.getBoundingClientRect().top + window.pageYOffset - navOffset;
        if (lenis) {
          lenis.scrollTo(target, { offset: -navOffset, duration: 1.2 });
        } else {
          window.scrollTo({
            top: Math.max(0, targetTop),
            behavior: 'smooth',
          });
        }

        if (history.pushState) {
          history.pushState(null, '', hash);
        }

        // Identify corresponding nav index
        const found = navTrackSections.find((item) => '#' + item.id === hash);
        if (found) {
          updateActiveNav(found.navIndex, found.id);
        }
      }
    });
  });

  // Handle direct navigation with hash on page load
  if (window.location.hash) {
    setTimeout(() => {
      const initialTarget = document.querySelector(window.location.hash);
      if (initialTarget) {
        const navOffset = 80;
        const targetTop = initialTarget.getBoundingClientRect().top + window.pageYOffset - navOffset;
        if (lenis) {
          lenis.scrollTo(initialTarget, { offset: -navOffset, duration: 1.2 });
        } else {
          window.scrollTo({
            top: Math.max(0, targetTop),
            behavior: 'smooth',
          });
        }
        const found = navTrackSections.find((item) => '#' + item.id === window.location.hash);
        if (found) {
          updateActiveNav(found.navIndex, found.id);
        }
      }
    }, 300);
  }

  // Pause off-screen continuous CSS animations (hero orbit & tech marquee) to keep scrolling 60FPS
  // Using data attributes instead of inline animationPlayState preserves CSS :hover pause rules!
  if ('IntersectionObserver' in window && !prefersReducedMotion) {
    const heroSection = document.getElementById('home');
    if (heroSection) {
      const heroObs = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
          heroSection.removeAttribute('data-orbit-offscreen');
        } else {
          heroSection.setAttribute('data-orbit-offscreen', 'true');
        }
      }, { rootMargin: '250px 0px' });
      heroObs.observe(heroSection);
    }

    const techSection = document.getElementById('technologies');
    if (techSection) {
      const techObs = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
          techSection.removeAttribute('data-tech-offscreen');
        } else {
          techSection.setAttribute('data-tech-offscreen', 'true');
        }
      }, { rootMargin: '250px 0px' });
      techObs.observe(techSection);
    }
  }

  // Sync scroll-driven components directly with Lenis smooth scroll
  if (lenis) {
    lenis.on('scroll', (e) => {
      const y = e && typeof e.scroll === 'number' ? e.scroll : window.scrollY;
      updateHeaderScroll(y);
      if (pinTrack) {
        updateStackingCards(false, y);
      }
      if (isSinglePageApp) {
        evaluateScrollSpy(y);
      }
    });
  }
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initShreeTech);
} else {
  initShreeTech();
}
