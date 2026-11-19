<?php
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Portfolio & Projects | Shree Tech';
$pageDescription = 'Explore our recent case studies and enterprise client projects delivered with high performance and reliability.';
$currentPage = 'projects';

$filterTabs = [
    ['id' => 'all', 'label' => 'All Work & Showcase'],
    ['id' => 'showcase', 'label' => 'Pure Ingredients (Video Showcase)'],
    ['id' => 'web', 'label' => 'Web Applications'],
    ['id' => 'enterprise', 'label' => 'Enterprise SaaS'],
    ['id' => 'mobile', 'label' => 'Mobile Apps'],
    ['id' => 'cloud', 'label' => 'Cloud Infrastructure'],
];

require_once __DIR__ . '/includes/header.php';

$allCards = array_merge($foodShowcaseCards ?? [], $projectsData);
?>

<div class="flex flex-col w-full pt-16 sm:pt-20">
  <section id="projects" class="relative py-20 sm:py-28 bg-[#0D0B0A] text-white overflow-visible border-y border-[#26201b]">
    
    <!-- Ambient subtle radial warm glow -->
    <div class="absolute inset-0 pointer-events-none bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#402213]/40 via-transparent to-transparent"></div>

    <!-- FLOATING FOOD IMAGES (PARALLAX & GENTLE FLOAT FROM REFERENCE VIDEO) -->
    <!-- Left Side: Fresh Sliced Red Tomato -->
    <div class="floating-food floating-food-left -left-8 sm:left-2 lg:left-6 top-32 sm:top-44 w-36 sm:w-56 lg:w-72">
      <img src="images/food-tomato.png" alt="Fresh Organic Sliced Tomato" class="w-full h-auto drop-shadow-[0_20px_40px_rgba(0,0,0,0.9)] contrast-110 filter">
    </div>

    <!-- Right Side Top: Golden Habanero Pepper -->
    <div class="floating-food floating-food-right-top -right-6 sm:right-2 lg:right-8 top-16 sm:top-24 w-32 sm:w-44 lg:w-56">
      <img src="images/food-pepper.png" alt="Golden Habanero Pepper" class="w-full h-auto drop-shadow-[0_20px_40px_rgba(0,0,0,0.9)] contrast-110 filter">
    </div>

    <!-- Right Side Bottom: Natural Red Chili Peppers -->
    <div class="floating-food floating-food-right-bottom -right-8 sm:right-4 lg:right-10 top-[55%] w-36 sm:w-48 lg:w-64">
      <img src="images/food-chili.png" alt="Natural Red Chili Peppers" class="w-full h-auto drop-shadow-[0_20px_40px_rgba(0,0,0,0.9)] contrast-110 filter">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- 1. Centered Cream "SHOP NOW" Button from Reference Video -->
      <div class="flex justify-center mb-6">
        <a href="contact.php" class="btn-cream-action px-8 py-3.5 text-xs sm:text-sm font-black tracking-widest uppercase shadow-2xl">
          <span>SHOP NOW</span>
          <i data-lucide="arrow-up-right" class="w-4 h-4 ml-2"></i>
        </a>
      </div>

      <!-- 2. Large Bold Condensed Typography with Word-by-Word Reveal -->
      <h2 class="reveal-words text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-[#f3ead8] tracking-tight font-heading text-center max-w-4xl mx-auto leading-[1.14] mb-6">
        BBQ Sauces & Digital Solutions Built with Real, Uncompromising Craft.
      </h2>

      <!-- 3. Line-by-Line Paragraph Reveal -->
      <p class="reveal-fade text-sm sm:text-base md:text-lg text-[#b8ad9c] font-body text-center max-w-2xl mx-auto leading-relaxed mb-10">
        No artificial shortcuts, no ultra-processed tricks, no filler code. Just clean formulas and mission-critical engineering that perform when put to the test on the grill and in production.
      </p>

      <!-- 4. Filter Pills Styled in Dark/Cream Aesthetics -->
      <div class="flex flex-wrap items-center justify-center gap-2 mb-14">
        <?php foreach ($filterTabs as $tab): ?>
          <button
            type="button"
            data-category="<?php echo htmlspecialchars($tab['id']); ?>"
            class="project-filter-btn px-4 py-2 text-xs sm:text-sm rounded-xl transition-all cursor-pointer <?php echo ($tab['id'] === 'all') ? 'bg-[#f3ead8] text-[#141210] font-bold shadow-md' : 'bg-white/5 text-[#a89d8d] hover:text-white hover:bg-white/10 border border-white/10'; ?>"
          >
            <?php echo htmlspecialchars($tab['label']); ?>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- 5. STICKY STACKING CARDS CONTAINER (MATCHING REFERENCE VIDEO) -->
      <div class="stacking-cards-container relative max-w-xl mx-auto flex flex-col items-center pt-4 pb-24">
        <?php foreach ($allCards as $idx => $project): 
          $isFoodShowcase = ($project['category'] === 'showcase');
          $iconType = $project['iconType'] ?? null;
        ?>
          <!-- Dynamic Project Stacking Card ($idx: <?php echo $idx; ?>) -->
          <article
            class="stacking-card-item project-card-item w-full"
            data-card-index="<?php echo $idx; ?>"
            data-category="<?php echo htmlspecialchars($project['category']); ?>"
            style="--stack-idx: <?php echo $idx; ?>;"
          >
            <!-- Sticky Inner Wrapper: Pins near viewport top with layered header tab offset -->
            <div class="stacking-card-sticky-inner">
              
              <!-- Card Outer Shell: Dark body #141414 with 1.5px subtle border & shadow -->
              <div class="stacking-card-box">
                
                <!-- TOP HEADER BAR (Folder Tab / Ticket Header from Reference Video) -->
                <div class="stacking-card-header px-4 sm:px-6 flex items-center justify-between select-none">
                  <!-- Left Decorative Rivet Dot -->
                  <span class="card-rivet" aria-hidden="true"></span>

                  <!-- Center: Project Title / Main Headline in Bold Uppercase -->
                  <div class="font-heading font-black text-xs sm:text-sm md:text-base tracking-wider uppercase truncate px-3 text-[#1c1917] text-center flex-1">
                    <span><?php echo htmlspecialchars($project['title']); ?></span>
                  </div>

                  <!-- Right Decorative Rivet Dot -->
                  <span class="card-rivet" aria-hidden="true"></span>
                </div>

                <!-- DARK CARD BODY (#141414 with subtle 1px border) -->
                <div class="stacking-card-body p-6 sm:p-8 flex flex-col items-center text-center text-white">
                  
                  <!-- Center Circular Icon with Thin Border (Exact Match to Video) -->
                  <div class="card-icon-circle w-16 h-16 sm:w-20 sm:h-20 rounded-full flex items-center justify-center mb-5 shrink-0">
                    <?php if ($iconType === 'corn-crossed'): ?>
                      <svg class="card-icon-svg w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 24 24">
                        <path d="M12 2C9.5 2 7.5 5 7.5 9c0 3.5 1.5 6 3 8l1.5 4h0l1.5-4c1.5-2 3-4.5 3-8 0-4-2-7-4.5-7z"/>
                        <path d="M7.5 9h9"/>
                        <path d="M8.5 13h7"/>
                        <line x1="4" y1="4" x2="20" y2="20" stroke="#f3ead8" stroke-width="2.2"/>
                      </svg>
                    <?php elseif ($iconType === 'droplet-crossed'): ?>
                      <svg class="card-icon-svg w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 24 24">
                        <path d="M12 2.5L7.2 9.5C5.8 11.5 5.5 13.8 6.5 16.2C7.7 19 10 20.5 12 20.5C14 20.5 16.3 19 17.5 16.2C18.5 13.8 18.2 11.5 16.8 9.5L12 2.5Z"/>
                        <line x1="4" y1="4" x2="20" y2="20" stroke="#f3ead8" stroke-width="2.2"/>
                      </svg>
                    <?php elseif ($iconType === 'flask-crossed'): ?>
                      <svg class="card-icon-svg w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 24 24">
                        <path d="M2 15c6.667-6 13.333 0 20-6"/>
                        <path d="M9 22c1.798-1.998 2.518-3.995 2.807-5.993"/>
                        <path d="M15 2c-1.798 1.998-2.518 3.995-2.807 5.993"/>
                        <circle cx="12" cy="12" r="2"/>
                        <line x1="4" y1="4" x2="20" y2="20" stroke="#f3ead8" stroke-width="2.2"/>
                      </svg>
                    <?php elseif ($iconType === 'wheat-crossed'): ?>
                      <svg class="card-icon-svg w-8 h-8 sm:w-10 sm:h-10" viewBox="0 0 24 24">
                        <path d="M2 22l10-10"/>
                        <path d="M16 8l-4 4"/>
                        <path d="M18 12c-1.5 0-3-1-3.5-2.5C14 8 15 6.5 16.5 6.5c1.5 0 2.5 1 2.5 2.5 0 1.5-1 3-1 3z"/>
                        <path d="M12 18c0-1.5 1-3 2.5-3.5 1.5-.5 3 .5 3 2 0 1.5-1 2.5-2.5 2.5-1.5 0-3-1-3-1z"/>
                        <line x1="4" y1="4" x2="20" y2="20" stroke="#f3ead8" stroke-width="2.2"/>
                      </svg>
                    <?php else: 
                      $icons = [
                        'apex-finance' => 'trending-up',
                        'health-cloud' => 'activity',
                        'fleet-mobile' => 'truck',
                        'luxury-commerce' => 'shopping-bag',
                        'cloud-security' => 'shield-check',
                        'ai-intelligence' => 'cpu',
                      ];
                      $lucideIcon = $icons[$project['id']] ?? 'sparkles';
                    ?>
                      <i data-lucide="<?php echo $lucideIcon; ?>" class="w-8 h-8 sm:w-10 sm:h-10 text-white stroke-[1.5]"></i>
                    <?php endif; ?>
                  </div>

                  <!-- Client Badge & Category -->
                  <div class="flex items-center gap-2 mb-3">
                    <span class="text-xs font-semibold uppercase tracking-wider text-[#FF6B00] font-heading">
                      <?php echo htmlspecialchars($project['client']); ?>
                    </span>
                    <span class="text-white/30">•</span>
                    <span class="text-xs font-medium text-slate-400 font-body">
                      <?php echo htmlspecialchars($project['categoryLabel']); ?>
                    </span>
                  </div>

                  <!-- Clean Project Description (Exact Match to Video Typography) -->
                  <p class="text-sm sm:text-base text-slate-300 font-normal leading-relaxed max-w-md mx-auto mb-6 font-body">
                    <?php echo htmlspecialchars($project['summary']); ?>
                  </p>

                  <!-- Impact Metric Pill -->
                  <div class="w-full max-w-sm p-3 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-between mb-6">
                    <span class="text-xs text-slate-400 font-medium"><?php echo htmlspecialchars($project['metrics']['label']); ?></span>
                    <span class="text-sm sm:text-base font-black text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] to-[#C01858] font-stat">
                      <?php echo htmlspecialchars($project['metrics']['value']); ?>
                    </span>
                  </div>

                  <!-- Technologies Stack Badges -->
                  <div class="flex flex-wrap justify-center gap-1.5 mb-6">
                    <?php foreach ($project['technologies'] as $tech): ?>
                      <span class="px-2.5 py-1 rounded-lg text-xs font-medium text-slate-300 bg-white/5 border border-white/10 font-body">
                        <?php echo htmlspecialchars($tech); ?>
                      </span>
                    <?php endforeach; ?>
                  </div>

                  <!-- Action Buttons -->
                  <div class="w-full max-w-sm flex items-center gap-3">
                    <button
                      type="button"
                      class="open-project-modal btn-cream-action flex-1 py-2.5 px-4 rounded-xl text-[#141210] font-black text-xs sm:text-sm flex items-center justify-center gap-2 cursor-pointer shadow-lg hover:scale-105 active:scale-95 transition-all"
                      data-title="<?php echo htmlspecialchars($project['title']); ?>"
                      data-client="<?php echo htmlspecialchars($project['client']); ?>"
                      data-summary="<?php echo htmlspecialchars($project['summary']); ?>"
                      data-category="<?php echo htmlspecialchars($project['categoryLabel']); ?>"
                      data-metric-val="<?php echo htmlspecialchars($project['metrics']['value']); ?>"
                      data-metric-label="<?php echo htmlspecialchars($project['metrics']['label']); ?>"
                    >
                      <span><?php echo $isFoodShowcase ? 'View Story' : 'View Case Study'; ?></span>
                      <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                    </button>

                    <a
                      href="contact.php"
                      class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-colors inline-flex items-center gap-1 cursor-pointer shrink-0"
                    >
                      <span><?php echo $isFoodShowcase ? 'Order Recipe' : 'Consult'; ?></span>
                    </a>
                  </div>

                </div>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</div>

<!-- CASE STUDY DETAIL MODAL -->
<div id="project-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-md">
  <div class="modal-dialog-box relative w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 sm:p-8 rounded-3xl bg-white border border-[#F1E6EE] shadow-2xl">
    
    <!-- Close Button -->
    <button
      id="modal-close"
      type="button"
      class="absolute top-5 right-5 p-2.5 rounded-2xl bg-white text-[#475569] hover:text-[#0F172A] border border-[#F1E6EE] shadow-xs transition-colors cursor-pointer"
      aria-label="Close dialog"
    >
      <i data-lucide="x" class="w-5 h-5"></i>
    </button>

    <div class="flex items-center gap-3 mb-3">
      <span id="modal-category" class="glass-pill px-3 py-1 rounded-xl text-xs font-semibold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE]"></span>
      <span id="modal-client" class="text-xs text-[#475569] font-medium"></span>
    </div>

    <h3 id="modal-title" class="text-2xl font-black text-[#0F172A] mb-2 font-heading"></h3>
    <p id="modal-summary" class="text-sm text-[#475569] leading-relaxed font-normal font-body"></p>

    <div class="mt-6 p-4 rounded-2xl bg-white border border-[#F1E6EE] shadow-xs flex items-center justify-between">
      <div>
        <div class="text-xs text-[#475569] font-medium">Primary Impact Metric</div>
        <div id="modal-metric-val" class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] to-[#C01858] font-stat tracking-tight mt-0.5"></div>
      </div>
      <div id="modal-metric-label" class="text-xs text-[#475569] font-semibold"></div>
    </div>

    <div class="mt-6 space-y-3">
      <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] font-heading">
        Architectural Highlights
      </h4>
      <div class="space-y-2 text-xs sm:text-sm text-[#475569] font-body">
        <div class="flex items-start gap-2">
          <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
          <span>Sub-second response latencies verified under peak production load</span>
        </div>
        <div class="flex items-start gap-2">
          <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
          <span>Strict TypeScript type safety ensuring zero unhandled runtime exceptions</span>
        </div>
        <div class="flex items-start gap-2">
          <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
          <span>Automated CI/CD build and testing pipeline with zero-downtime rolling deploys</span>
        </div>
      </div>
    </div>

    <div class="mt-8 pt-4 border-t border-[#F1E6EE] flex justify-end">
      <a
        href="contact.php"
        class="glass-btn-primary px-6 py-2.5 rounded-2xl font-semibold text-xs sm:text-sm cursor-pointer inline-flex items-center font-body text-white shadow-md"
      >
        Discuss a Similar Project
      </a>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
