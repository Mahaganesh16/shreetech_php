/**
 * Shree Tech - Core JavaScript & Full Animation Engine
 * Faithfully ported from Next.js & Framer Motion to native Vanilla JS
 */

function initShreeTech() {
  // 0. Initialize Lucide Icons
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
    revealElements.forEach((el) => el.classList.add('is-revealed'));
  }

  if ('IntersectionObserver' in window && revealElements.length > 0) {
    const revealObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');
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
        el.classList.add('is-revealed');
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
  flipCardWrappers.forEach((wrapper) => {
    wrapper.addEventListener('click', (e) => {
      // Don't flip if user clicked on a link or button inside back card
      if (e.target.closest('a') || e.target.closest('button')) {
        return;
      }
      // On touch devices without hover capability, tap toggles flip
      if (window.matchMedia && window.matchMedia('(hover: none)').matches) {
        const inner = wrapper.querySelector('.flip-card-inner');
        if (inner) {
          inner.classList.toggle('is-flipped');
        }
      }
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
  // 5. HERO 8-NODE ORBITING TECH ENGINE WITH COUNTER-ROTATION & TOOLTIPS
  // =========================================================================
  const orbitContainer = document.querySelector('.orbit-spin-track');
  const orbitNodes = document.querySelectorAll('.orbit-tech-node');

  if (orbitNodes.length > 0) {
    const totalNodes = orbitNodes.length;
    orbitNodes.forEach((node, idx) => {
      const angle = (idx / totalNodes) * (2 * Math.PI) - (Math.PI / 2);
      const xPercent = 50 + 50 * Math.cos(angle);
      const yPercent = 50 + 50 * Math.sin(angle);

      node.style.left = `${xPercent}%`;
      node.style.top = `${yPercent}%`;
      node.style.transform = 'translate(-50%, -50%)';
    });
  }

  // =========================================================================
  // 6. NAVBAR SCROLL EFFECT & MOBILE MENU TOGGLE
  // =========================================================================
  const header = document.querySelector('header');
  const dock = document.getElementById('navbar-dock');
  const updateHeaderScroll = () => {
    const isScrolled = window.scrollY > 20;
    if (header) {
      if (isScrolled) {
        header.classList.add('glass-navbar-scrolled');
        header.classList.remove('glass-navbar-top');
      } else {
        header.classList.add('glass-navbar-top');
        header.classList.remove('glass-navbar-scrolled');
      }
    }
    if (dock) {
      if (isScrolled) {
        dock.classList.add('is-scrolled');
      } else {
        dock.classList.remove('is-scrolled');
      }
    }
  };
  window.addEventListener('scroll', updateHeaderScroll, { passive: true });
  updateHeaderScroll();

  const mobileToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
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
    let interactionTimeout = null;

    testTrack.addEventListener('mouseenter', () => { isHovered = true; });
    testTrack.addEventListener('mouseleave', () => { isHovered = false; });
    testTrack.addEventListener('touchstart', () => { isHovered = true; }, { passive: true });
    testTrack.addEventListener('touchend', () => { isHovered = false; });

    // Smooth continuous auto drift
    function stepDrift() {
      if (!isHovered && !isInteracting && testTrack) {
        testTrack.scrollLeft += 0.85;
        if (testTrack.scrollLeft >= testTrack.scrollWidth / 2) {
          testTrack.scrollLeft -= testTrack.scrollWidth / 2;
        }
      }
      requestAnimationFrame(stepDrift);
    }
    requestAnimationFrame(stepDrift);

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
  const activeDesc = document.getElementById('active-category-desc');
  const activeBadge = document.getElementById('active-category-badge');

  const categoryMeta = {
    'All': {
      badge: 'Multi-Discipline Engineering',
      title: 'All Technology Disciplines',
      desc: 'Comprehensive enterprise ecosystem featuring frontend languages, backend runtimes, databases, mobile frameworks, and cloud engineering.'
    },
    'Frontend': {
      badge: 'Client-Side Engineering',
      title: 'Frontend Languages & UI Frameworks (HTML, CSS, JS)',
      desc: 'Semantic HTML5 markup, modern responsive CSS3 styling, and reactive JavaScript frameworks built for high-performance user interfaces.'
    },
    'Backend': {
      badge: 'Server Architecture',
      title: 'Backend Frameworks & Server APIs (eg: Python, Laravel, PHP, Node.js)',
      desc: 'Resilient server runtimes and enterprise frameworks built for high concurrency, microservices, and robust data APIs.'
    },
    'Database': {
      badge: 'Data Layer & Caching',
      title: 'Database & Storage Systems (eg: MySQL, MongoDB, PostgreSQL, Redis)',
      desc: 'Relational, document, and analytical databases engineered for extreme data integrity, ACID compliance, and sub-millisecond cache latency.'
    },
    'Mobile': {
      badge: 'Native & Multiplatform',
      title: 'Mobile App Development (eg: Flutter, Swift, React Native, iOS)',
      desc: 'Cross-platform native mobile compilation and platform-native frameworks delivering fluid 60FPS experiences for iOS and Android.'
    },
    'Cloud': {
      badge: 'Infrastructure & DevOps',
      title: 'Cloud & DevOps Engineering (eg: AWS, Azure, Google Cloud, Docker)',
      desc: 'Elastic cloud hosting, automated container orchestration, and serverless architectures engineered for 99.99% uptime.'
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
        if (activeDesc) activeDesc.textContent = categoryMeta[cat].desc;
        if (activeBadge) activeBadge.textContent = categoryMeta[cat].badge;
      }

      techGroups.forEach((group) => {
        const match = group.getAttribute('data-category') === cat;
        const tracks = group.querySelectorAll('.tech-row-track, .tech-column-track');
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

  function updateTrackHeight() {
    if (!pinTrack) return;
    const visibleCards = Array.from(projectCards).filter(
      (card) => card.style.display !== 'none'
    );
    const count = visibleCards.length;
    if (count <= 1) {
      pinTrack.style.height = '100vh';
    } else {
      // 400px of scroll per card transition for clear, rhythmic sequential movement
      const scrollPerCard = 400;
      // Runway: intro pad (140px) + transitions + outro hold (280px) so stack stays pinned at completion
      const totalScrollTravel = 140 + (count - 1) * scrollPerCard + 280;
      pinTrack.style.height = `${window.innerHeight + totalScrollTravel}px`;
    }
  }

  function updateStackingCards() {
    if (!pinTrack || !pinStage || !projectCards.length) return;

    const visibleCards = Array.from(projectCards).filter(
      (card) => card.style.display !== 'none'
    );
    const totalCards = visibleCards.length;
    if (totalCards === 0) return;

    if (totalCards === 1) {
      visibleCards[0].style.transform = 'translate3d(0, 0, 0) scale(1) rotate(0deg)';
      visibleCards[0].style.opacity = '1';
      visibleCards[0].style.visibility = 'visible';
      visibleCards[0].style.filter = 'brightness(1)';
      visibleCards[0].style.pointerEvents = 'auto';
      return;
    }

    const trackRect = pinTrack.getBoundingClientRect();
    const maxScroll = pinTrack.offsetHeight - window.innerHeight;
    if (maxScroll <= 0) return;

    // Progress goes strictly from 0 to 1 while pinned in the viewport
    const progress = Math.min(Math.max(-trackRect.top / maxScroll, 0), 1);
    const totalSteps = totalCards - 1;

    // Timeline partitions:
    // 0.00 to introEnd: rest on Card 0
    // introEnd to animEnd: sequential card arrivals (Cards 1 to totalCards - 1)
    // animEnd to 1.00: complete cards stack stays visible and docked
    const introEnd = 0.04;
    const animEnd = 0.92;
    const animSpan = animEnd - introEnd;
    const stepSpan = animSpan / totalSteps;

    // Keep deck and header fully visible (no blank gaps)
    if (deckContainer) {
      deckContainer.style.transform = 'translate3d(0, 0, 0)';
      deckContainer.style.opacity = '1';
    }
    if (stageHeader) {
      stageHeader.style.opacity = '1';
    }

    // Travel distance: from docked position to below the viewport
    const travelDistance = Math.max(window.innerHeight * 0.95, 620);

    visibleCards.forEach((card, index) => {
      card.style.setProperty('--stack-idx', index);
      const headerTab = card.querySelector('.stacking-card-header');

      if (index === 0) {
        // Foundation card: stays in place, dims & scales as cards stack over it
        let coveredDepth = 0;
        if (progress > introEnd) {
          coveredDepth = Math.min((progress - introEnd) / stepSpan, totalSteps);
        }

        const scale = Math.max(1 - coveredDepth * 0.024, 0.89);
        const brightness = Math.max(1 - coveredDepth * 0.03, 0.94);
        const tabR = Math.round(Math.max(255 - coveredDepth * 10, 226));
        const tabG = Math.round(Math.max(255 - coveredDepth * 9, 232));
        const tabB = Math.round(Math.max(255 - coveredDepth * 7, 240));

        card.style.transform = `translate3d(0, 0, 0) scale(${scale.toFixed(4)}) rotate(0deg)`;
        card.style.opacity = '1';
        card.style.visibility = 'visible';
        card.style.filter = `brightness(${brightness.toFixed(3)})`;
        card.style.pointerEvents = 'auto';
        if (headerTab) headerTab.style.backgroundColor = `rgb(${tabR}, ${tabG}, ${tabB})`;
        return;
      }

      // Subsequent cards (index >= 1)
      const stepStart = introEnd + (index - 1) * stepSpan;
      const stepEnd = introEnd + index * stepSpan;
      const initialTilt = (index % 2 === 1) ? -2.2 : 2.2;

      if (progress <= stepStart) {
        // Card is waiting below the stage (off bottom of screen)
        card.style.transform = `translate3d(0, ${travelDistance}px, 0) scale(1) rotate(${initialTilt}deg)`;
        card.style.opacity = '0';
        card.style.visibility = 'hidden';
        card.style.filter = 'brightness(1)';
        card.style.pointerEvents = 'none';
        if (headerTab) headerTab.style.backgroundColor = 'rgb(255, 255, 255)';
      } else if (progress >= stepEnd) {
        // Card is fully docked; calculate depth from cards docked on top of it
        const cardsAbove = (progress - stepEnd) / stepSpan;
        const coveredDepth = Math.max(0, Math.min(cardsAbove, totalSteps - index));

        const scale = Math.max(1 - coveredDepth * 0.024, 0.89);
        const brightness = Math.max(1 - coveredDepth * 0.03, 0.94);
        const tabR = Math.round(Math.max(255 - coveredDepth * 10, 226));
        const tabG = Math.round(Math.max(255 - coveredDepth * 9, 232));
        const tabB = Math.round(Math.max(255 - coveredDepth * 7, 240));

        card.style.transform = `translate3d(0, 0, 0) scale(${scale.toFixed(4)}) rotate(0deg)`;
        card.style.opacity = '1';
        card.style.visibility = 'visible';
        card.style.filter = `brightness(${brightness.toFixed(3)})`;
        card.style.pointerEvents = 'auto';
        if (headerTab) headerTab.style.backgroundColor = `rgb(${tabR}, ${tabG}, ${tabB})`;
      } else {
        // Card is actively traveling and docking in line-by-line order
        const t = (progress - stepStart) / (stepEnd - stepStart);
        // Smooth cubic ease-out
        const ease = 1 - Math.pow(1 - t, 2.5);

        const currentY = (1 - ease) * travelDistance;
        const currentTilt = (1 - ease) * initialTilt;
        // Fade in quickly during first 25% of travel, then fully opaque as it moves
        const currentOpacity = Math.min(t * 4.0, 1);

        card.style.transform = `translate3d(0, ${currentY.toFixed(1)}px, 0) scale(1) rotate(${currentTilt.toFixed(2)}deg)`;
        card.style.opacity = currentOpacity.toFixed(3);
        card.style.visibility = 'visible';
        card.style.filter = 'brightness(1)';
        card.style.pointerEvents = 'auto';
        if (headerTab) headerTab.style.backgroundColor = 'rgb(255, 255, 255)';
      }
    });
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
    window.addEventListener('scroll', onStackScroll, { passive: true });
    window.addEventListener('resize', () => {
      updateTrackHeight();
      onStackScroll();
    }, { passive: true });
    updateStackingCards();
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
      onStackScroll();
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
      });
    });

    const closeModal = () => {
      modal.classList.add('hidden');
      modal.classList.remove('modal-animate-backdrop');
      if (modalContent) modalContent.classList.remove('modal-animate-content');
      document.body.style.overflow = '';
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
  magneticButtons.forEach((btn) => {
    btn.addEventListener('mousemove', (e) => {
      const rect = btn.getBoundingClientRect();
      const x = e.clientX - rect.left - rect.width / 2;
      const y = e.clientY - rect.top - rect.height / 2;
      btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
    });

    btn.addEventListener('mouseleave', () => {
      btn.style.transform = '';
      btn.style.transition = 'transform 0.3s cubic-bezier(0.16, 1, 0.3, 1)';
    });

    btn.addEventListener('mouseenter', () => {
      btn.style.transition = 'none';
    });
  });

  // =========================================================================
  // 12. CONTACT FORM FEEDBACK
  // =========================================================================
  const contactForm = document.getElementById('contact-form');
  const contactSuccess = document.getElementById('contact-success');
  if (contactForm && contactSuccess) {
    contactForm.addEventListener('submit', (e) => {
      if (contactForm.getAttribute('data-ajax') === 'true') {
        e.preventDefault();
        const submitBtn = contactForm.querySelector('button[type="submit"]');
        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<span>Transmitting payload...</span>';
        }
        setTimeout(() => {
          contactForm.classList.add('hidden');
          contactSuccess.classList.remove('hidden');
          contactForm.reset();
        }, 800);
      }
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

    // 2. Sync mobile nav active link styling
    if (mobileNavLinks && mobileNavLinks.length) {
      mobileNavLinks.forEach((link) => {
        const href = link.getAttribute('href');
        const isMatch = href === '#' + activeSectionId || (newIndex === 0 && href === '#home');
        if (isMatch) {
          link.classList.add('text-[#C01858]', 'bg-[#FFF0F5]', 'border', 'border-[#F1E6EE]', 'font-semibold', 'shadow-xs');
          link.classList.remove('text-[#505D70]');
        } else {
          link.classList.remove('text-[#C01858]', 'bg-[#FFF0F5]', 'border', 'border-[#F1E6EE]', 'font-semibold', 'shadow-xs');
          link.classList.add('text-[#505D70]');
        }
      });
    }
  };

  let scrollSpyTicking = false;
  const onScrollSpy = () => {
    if (scrollSpyTicking) return;
    scrollSpyTicking = true;
    requestAnimationFrame(() => {
      scrollSpyTicking = false;

      // If user reaches near bottom of the page, unselect dock nav
      const docHeight = document.documentElement.scrollHeight;
      const scrollBottom = window.scrollY + window.innerHeight;
      if (scrollBottom >= docHeight - 80) {
        updateActiveNav(-1, 'contact');
        return;
      }

      const scrollTriggerPos = window.scrollY + 180;
      let activeIndex = 0;
      let activeId = 'home';

      for (let i = navTrackSections.length - 1; i >= 0; i--) {
        const item = navTrackSections[i];
        const secEl = document.getElementById(item.id);
        if (secEl) {
          const top = secEl.offsetTop;
          if (scrollTriggerPos >= top) {
            activeIndex = item.navIndex;
            activeId = item.id;
            break;
          }
        }
      }

      updateActiveNav(activeIndex, activeId);
    });
  };

  // Only enable scrollspy on pages with single-page section anchors (like index.php)
  const isSinglePageApp = !!document.getElementById('services');
  if (isSinglePageApp) {
    window.addEventListener('scroll', onScrollSpy, { passive: true });
    setTimeout(onScrollSpy, 200);
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
        window.scrollTo({
          top: Math.max(0, targetTop),
          behavior: 'smooth',
        });

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
        window.scrollTo({
          top: Math.max(0, targetTop),
          behavior: 'smooth',
        });
        const found = navTrackSections.find((item) => '#' + item.id === window.location.hash);
        if (found) {
          updateActiveNav(found.navIndex, found.id);
        }
      }
    }, 300);
  }
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initShreeTech);
} else {
  initShreeTech();
}
