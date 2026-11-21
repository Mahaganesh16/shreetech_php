<?php
if (!isset($companyInfo)) {
    require_once __DIR__ . '/data.php';
}

$currentPage = $currentPage ?? 'home';
$isHomePage = ($currentPage === 'home' || basename($_SERVER['PHP_SELF'] ?? '') === 'index.php');

$navItems = [
    ['label' => 'Home', 'href' => '#home', 'page' => 'home'],
    ['label' => 'About', 'href' => '#about', 'page' => 'about'],
    ['label' => 'Services', 'href' => '#services', 'page' => 'services'],
    ['label' => 'Technologies', 'href' => '#technologies', 'page' => 'technologies'],
    ['label' => 'Projects', 'href' => '#projects', 'page' => 'projects'],
    ['label' => 'Contact', 'href' => '#contact', 'page' => 'contact'],
];

$activeIndex = 0;
foreach ($navItems as $idx => $item) {
    if ($currentPage === $item['page']) {
        $activeIndex = $idx;
        break;
    }
}
?>
<header id="main-header" class="fixed top-2.5 sm:top-4 inset-x-0 z-50 pointer-events-none transition-all duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div id="navbar-dock" class="w-full pointer-events-auto rounded-full glass-navbar-dock px-3.5 sm:px-5 py-2 sm:py-2.5 flex items-center justify-between transition-all duration-300">
      
      <!-- 1. LEFT SIDE: Shree Tech Innovations Logo & Brand Name -->
      <a href="#home" class="flex items-center gap-2.5 sm:gap-3 group select-none cursor-pointer flex-shrink-0">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white/40 border border-white/60 p-1 flex items-center justify-center shadow-xs group-hover:border-[#C01858] group-hover:scale-105 transition-all overflow-hidden">
          <img src="images/logo-icon.png" alt="Shree Tech Logo" class="w-full h-full object-contain">
        </div>
        <div class="flex flex-col">
          <span class="text-sm sm:text-base font-black text-[#0F172A] tracking-tight font-heading leading-tight">
            Shree Tech
          </span>
          <span class="text-[9px] text-[#475569] font-semibold tracking-wider uppercase font-heading">
            Innovations
          </span>
        </div>
      </a>

      <!-- 2. CENTER: React Bits GooeyNav Component -->
      <div class="hidden md:flex items-center justify-center flex-1 mx-3 lg:mx-4">
        <nav
          id="shree-gooey-nav"
          class="gooey-nav gooey-nav--md gooey-nav--framed"
          data-active-index="<?php echo $activeIndex; ?>"
          data-theme="light"
          data-color="#FFF0F5"
          data-active-text-color="#C01858"
          data-particle-count="15"
          data-spread="45"
          data-animation-time="600"
          data-time-variance="250"
          data-gooeyness="0.5"
          data-wobble="0.4"
          data-hover-effect="true"
          style="--gn-frame: rgba(255, 255, 255, 0.20); --gn-frame-edge: rgba(255, 255, 255, 0.55); --gn-frame-highlight: rgba(255, 255, 255, 0.75); --gn-frame-shadow: none; --gn-pill: #FFF0F5; --gn-active-ink: #C01858; --gn-ink: #C01858; --gn-muted: #505D70;"
        >
          <span class="gooey-nav__rim"></span>
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

      <!-- 3. RIGHT SIDE: Gradient Contact Us Button with Arrow Icon -->
      <div class="hidden md:flex items-center gap-3 flex-shrink-0">
        <a
          href="#contact"
          class="glass-btn-primary inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-xs lg:text-sm font-semibold text-white cursor-pointer shadow-md hover:shadow-lg hover:scale-105 active:scale-95 transition-all"
          style="background: linear-gradient(135deg, #FF6B00 0%, #C01858 55%, #8B5CF6 100%);"
        >
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-white/95"></i>
          <span>Contact Us</span>
          <i data-lucide="arrow-up-right" class="w-4 h-4 text-white/95"></i>
        </a>
      </div>

      <!-- Mobile Hamburger Button -->
      <div class="md:hidden flex items-center">
        <button
          id="mobile-menu-toggle"
          class="p-2 text-[#475569] hover:text-[#0F172A] rounded-full bg-white/70 backdrop-blur-md border border-[#F1E6EE] shadow-xs focus:outline-none cursor-pointer"
          aria-label="Toggle navigation menu"
        >
          <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
      </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="hidden md:hidden mt-2 p-3.5 rounded-2xl border border-[#F1E6EE] pointer-events-auto shadow-xl" style="background: rgba(255, 255, 255, 0.75); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);">
      <div class="flex flex-col gap-1.5">
        <?php foreach ($navItems as $item): 
          $isActive = ($currentPage === $item['page']);
        ?>
          <a
            href="<?php echo htmlspecialchars($item['href']); ?>"
            class="px-4 py-2.5 text-sm font-medium rounded-xl transition-all <?php echo $isActive ? 'text-[#C01858] bg-[#FFF0F5] border border-[#F1E6EE] font-semibold shadow-xs' : 'text-[#505D70] hover:text-[#C01858] hover:bg-[#FFF0F5]'; ?>"
          >
            <?php echo htmlspecialchars($item['label']); ?>
          </a>
        <?php endforeach; ?>
        <div class="pt-2 mt-1 border-t border-[#F1E6EE]">
          <a
            href="#contact"
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
