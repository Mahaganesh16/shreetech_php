<?php
if (!isset($companyInfo)) {
    require_once __DIR__ . '/data.php';
}

$currentPage = $currentPage ?? 'home';
$isHomePage = ($currentPage === 'home' || basename($_SERVER['PHP_SELF'] ?? '') === 'index.php');

$navItems = [
    ['label' => 'Home', 'href' => $isHomePage ? '#home' : 'index.php#home', 'page' => 'home'],
    ['label' => 'About', 'href' => $isHomePage ? '#about' : 'index.php#about', 'page' => 'about'],
    ['label' => 'Services', 'href' => $isHomePage ? '#services' : 'index.php#services', 'page' => 'services'],
    ['label' => 'Technologies', 'href' => $isHomePage ? '#technologies' : 'index.php#technologies', 'page' => 'technologies'],
    ['label' => 'Projects', 'href' => $isHomePage ? '#projects' : 'index.php#projects', 'page' => 'projects'],
    ['label' => 'Careers', 'href' => 'careers.php', 'page' => 'careers'],
];

$activeIndex = 0;
foreach ($navItems as $idx => $item) {
    if ($currentPage === $item['page']) {
        $activeIndex = $idx;
        break;
    }
}
?>
<header id="main-header" class="fixed top-2.5 sm:top-4 inset-x-0 z-50 pointer-events-none">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div id="navbar-dock" class="w-full pointer-events-auto glass-navbar-dock px-3 sm:px-4 py-1.5 sm:py-2 flex items-center justify-between transition-all duration-300">
      
      <!-- 1. LEFT SIDE: Shree Tech Innovations Logo & Brand Name -->
      <a href="<?php echo $isHomePage ? '#home' : 'index.php#home'; ?>" class="flex items-center gap-2.5 sm:gap-3 group select-none cursor-pointer pointer-events-auto flex-shrink-0">
        <div class="w-9 h-9 flex items-center justify-center group-hover:scale-105 transition-transform">
          <img src="images/logo-icon.png" alt="Shree Tech Logo" class="w-full h-full object-contain">
        </div>
        <div class="flex flex-col">
          <span class="text-sm sm:text-base font-black text-[#0F172A] tracking-tight font-heading leading-tight">
            Shree Tech
          </span>
          <span class="text-[10px] text-[#0F172A] font-bold tracking-wider uppercase font-heading">
            Innovations
          </span>
        </div>
      </a>

      <!-- 2. CENTER: React Bits GooeyNav Component (Frameless inside unified glass navbar container) -->
      <div class="hidden lg:flex navbar-desktop-nav items-center justify-center flex-1 mx-2 xl:mx-4">
        <nav
          id="shree-gooey-nav"
          class="gooey-nav gooey-nav--md pointer-events-auto"
          data-active-index="<?php echo $activeIndex; ?>"
          data-theme="light"
          data-color="#FFECF3"
          data-active-text-color="#B8124E"
          data-particle-count="15"
          data-spread="45"
          data-animation-time="600"
          data-time-variance="250"
          data-gooeyness="0.5"
          data-wobble="0.4"
          data-hover-effect="true"
          style="--gn-pill: rgba(255, 236, 243, 0.96); --gn-active-ink: #B8124E; --gn-ink: #B8124E; --gn-muted: #020617;"
        >
          <div class="gooey-nav__stage">
            <canvas class="gooey-nav__canvas" aria-hidden="true"></canvas>
            <span class="gooey-nav__fallback" aria-hidden="true"></span>
            
            <!-- Inactive / Normal Item List -->
            <ul class="gooey-nav__list">
              <?php foreach ($navItems as $index => $item): ?>
                <li
                  class="gooey-nav__item"
                  data-gooey-index="<?php echo $index; ?>"
                  <?php echo $index === $activeIndex ? 'data-active=""' : ''; ?>
                >
                  <a
                    href="<?php echo htmlspecialchars($item['href']); ?>"
                    class="gooey-nav__link"
                    <?php echo $index === $activeIndex ? 'aria-current="page"' : ''; ?>
                  >
                    <span class="gooey-nav__label"><?php echo htmlspecialchars($item['label']); ?></span>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>

            <!-- Active Overlay List (Clipped dynamically by SVG Path / WebGL Mask) -->
            <ul class="gooey-nav__list gooey-nav__list--active" aria-hidden="true">
              <?php foreach ($navItems as $index => $item): ?>
                <li class="gooey-nav__item">
                  <span class="gooey-nav__link">
                    <span class="gooey-nav__label"><?php echo htmlspecialchars($item['label']); ?></span>
                  </span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </nav>
      </div>

      <!-- 3. RIGHT SIDE: Gradient Contact Us Button with Arrow Icon (Desktop) -->
      <div class="hidden lg:flex navbar-desktop-cta items-center gap-3 pointer-events-auto flex-shrink-0">
        <a
          href="<?php echo $isHomePage ? '#contact' : 'index.php#contact'; ?>"
          class="glass-btn-primary inline-flex items-center gap-1.5 xl:gap-2 px-3.5 py-2 xl:px-5 xl:py-2.5 rounded-full text-xs xl:text-sm font-bold text-white cursor-pointer shadow-md hover:shadow-lg hover:scale-105 active:scale-95 transition-all whitespace-nowrap"
          style="background: linear-gradient(135deg, #FF6B00 0%, #C01858 55%, #8B5CF6 100%);"
        >
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-white/95"></i>
          <span>Contact Us</span>
          <i data-lucide="arrow-up-right" class="w-4 h-4 text-white/95"></i>
        </a>
      </div>

      <!-- Mobile & Tablet Hamburger Toggle (+ sleek compact contact button for tablets) -->
      <div class="lg:hidden navbar-mobile-toggle flex items-center gap-2 sm:gap-2.5 pointer-events-auto">
        <a
          href="<?php echo $isHomePage ? '#contact' : 'index.php#contact'; ?>"
          class="hidden sm:inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold text-white shadow-sm hover:shadow active:scale-95 transition-all whitespace-nowrap"
          style="background: linear-gradient(135deg, #FF6B00 0%, #C01858 55%, #8B5CF6 100%);"
        >
          <i data-lucide="sparkles" class="w-3 h-3 text-white"></i>
          <span>Contact</span>
        </a>
        <button
          id="mobile-menu-toggle"
          type="button"
          class="p-2 text-[#0F172A] hover:text-[#C01858] rounded-full bg-white border border-[#F1E6EE] shadow-sm focus:outline-none cursor-pointer transition-colors"
          aria-label="Toggle navigation menu"
          aria-expanded="false"
        >
          <svg class="mobile-icon-open w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
          <svg class="mobile-icon-close hidden w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
      </div>
    </div>

    <!-- Mobile Dropdown Menu (Outside glass dock; solid opaque white for crisp legibility) -->
    <div id="mobile-menu" class="hidden lg:hidden mt-2 p-3.5 rounded-2xl bg-white border border-[#F1E6EE] pointer-events-auto shadow-xl transition-all">
      <div class="flex flex-col gap-1.5">
        <?php foreach ($navItems as $item): 
          $isActive = ($currentPage === $item['page']);
        ?>
          <a
            href="<?php echo htmlspecialchars($item['href']); ?>"
            class="px-4 py-2.5 text-sm font-bold rounded-xl transition-colors <?php echo $isActive ? 'text-[#C01858] bg-[#FFF0F5] border border-[#F1E6EE] shadow-xs' : 'text-[#020617] hover:text-[#C01858] hover:bg-[#FFF0F5]'; ?>"
          >
            <?php echo htmlspecialchars($item['label']); ?>
          </a>
        <?php endforeach; ?>
        <div class="pt-2 mt-1 border-t border-[#F1E6EE]">
          <a
            href="<?php echo $isHomePage ? '#contact' : 'index.php#contact'; ?>"
            class="w-full py-2.5 px-4 text-center text-sm font-semibold text-white rounded-xl block shadow-md"
            style="background: linear-gradient(135deg, #FF6B00 0%, #C01858 55%, #8B5CF6 100%);"
          >
            Contact Us
          </a>
        </div>
      </div>
    </div>
  </div>
</header>
