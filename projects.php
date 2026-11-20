<?php
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Portfolio & Projects | Shree Tech';
$pageDescription = 'Explore our recent case studies and enterprise client projects delivered with high performance and reliability.';
$currentPage = 'projects';

$filterTabs = [
    ['id' => 'all', 'label' => 'All Projects'],
    ['id' => 'web', 'label' => 'Web Applications'],
    ['id' => 'enterprise', 'label' => 'Enterprise SaaS'],
    ['id' => 'mobile', 'label' => 'Mobile Apps'],
    ['id' => 'cloud', 'label' => 'Cloud Infrastructure'],
];

require_once __DIR__ . '/includes/header.php';
?>

<div class="flex flex-col w-full">
  
  <!-- OUTER PINNED SCROLL TRACK (DRIVES JS SCROLL STACKING ANIMATION BEFORE PROCEEDING TO FOOTER) -->
  <section id="projects-pin-track" class="relative w-full bg-[#FFF0F5]/25 border-y border-[#F1E6EE]">
    
    <!-- STICKY VIEWPORT STAGE (PERFECT FULL-VIEW ALIGNMENT: ZERO CLIPPING & SAFE NAVBAR CLEARANCE) -->
    <div id="projects-pin-stage" class="sticky top-0 w-full min-h-screen flex flex-col justify-start items-center overflow-hidden pt-20 sm:pt-24 pb-4 px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header (Cleanly Spaced Below Floating Navbar) -->
      <div class="w-full max-w-3xl mx-auto flex flex-col items-center text-center mb-2 sm:mb-2.5 shrink-0">
        <div class="glass-pill inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-1 shadow-xs">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>Selected Case Studies</span>
        </div>
        <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-[#0F172A] tracking-tight font-heading mb-1.5">
          Featured Client Deployments
        </h2>

        <!-- Filter Pills -->
        <div class="flex flex-wrap items-center justify-center gap-1 sm:gap-1.5">
          <?php foreach ($filterTabs as $tab): ?>
            <button
              type="button"
              data-category="<?php echo htmlspecialchars($tab['id']); ?>"
              class="project-filter-btn px-3 py-0.5 sm:py-1 text-xs font-semibold rounded-xl transition-all cursor-pointer <?php echo ($tab['id'] === 'all') ? 'glass-btn-primary shadow-xs text-white' : 'glass-btn-secondary text-[#475569] hover:text-[#C01858] hover:border-[#C01858]'; ?>"
            >
              <?php echo htmlspecialchars($tab['label']); ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- STACKING CARDS DECK (BALANCED MEDIUM CARD PRESENTATION ACCORDING TO TEMPLATE) -->
      <div class="stacking-deck-container relative w-full max-w-2xl sm:max-w-3xl lg:max-w-4xl mx-auto flex flex-col justify-start items-center">
        <div class="stacking-cards-deck relative w-full h-[380px] sm:h-[410px] md:h-[430px] lg:h-[450px]">
          <?php foreach ($projectsData as $idx => $project): 
            $icons = [
              'apex-finance' => 'trending-up',
              'health-cloud' => 'activity',
              'fleet-mobile' => 'truck',
              'luxury-commerce' => 'shopping-bag',
              'cloud-security' => 'shield-check',
              'ai-intelligence' => 'cpu',
            ];
            $icon = $icons[$project['id']] ?? 'sparkles';
          ?>
            <!-- Dynamic Project Stacking Card ($idx: <?php echo $idx; ?>) -->
            <article
              class="stacking-card-item project-card-item"
              data-card-index="<?php echo $idx; ?>"
              data-category="<?php echo htmlspecialchars($project['category']); ?>"
              style="--stack-idx: <?php echo $idx; ?>;"
            >
              <!-- Card Outer Shell: Dark body #141414 with 1.5px subtle border & shadow -->
              <div class="stacking-card-box">
                
                <!-- TOP HEADER BAR (Folder Tab / Ticket Header from Reference Video in White) -->
                <div class="stacking-card-header px-4 sm:px-6 lg:px-8 flex items-center justify-between select-none">
                  <!-- Left Decorative Rivet Dot & Index -->
                  <div class="flex items-center gap-2 sm:gap-3">
                    <span class="card-rivet" aria-hidden="true"></span>
                    <span class="font-stat text-[11px] sm:text-xs font-black tracking-widest uppercase text-[#C01858]">
                      // <?php echo str_pad($idx + 1, 2, '0', STR_PAD_LEFT); ?>
                    </span>
                  </div>

                  <!-- Center: Project Title / Main Headline in Bold Uppercase -->
                  <div class="font-heading font-black text-xs sm:text-sm md:text-base tracking-wider uppercase truncate px-3 text-[#0F172A] text-center flex-1">
                    <span><?php echo htmlspecialchars($project['title']); ?></span>
                  </div>

                  <!-- Right Decorative Rivet Dot & Year Tag -->
                  <div class="flex items-center gap-2 sm:gap-3">
                    <span class="text-[10px] sm:text-xs font-bold tracking-wider font-heading text-[#64748B] hidden sm:inline">
                      <?php echo htmlspecialchars($project['year']); ?>
                    </span>
                    <span class="card-rivet" aria-hidden="true"></span>
                  </div>
                </div>

                <!-- WHITE CARD BODY (#FFFFFF) CLEAN CONTEMPORARY THEME - FULL-WIDTH SHOWCASE IMAGE -->
                <div class="stacking-card-body p-3 sm:p-4 text-[#0F172A] bg-white">
                  <!-- Proportional High-Resolution Project Preview -->
                  <div
                    class="open-project-modal relative w-full h-[280px] sm:h-[310px] md:h-[330px] lg:h-[350px] group overflow-hidden rounded-2xl border border-[#F1E6EE] bg-slate-50 flex items-center justify-center shadow-md cursor-pointer select-none"
                    data-title="<?php echo htmlspecialchars($project['title']); ?>"
                    data-client="<?php echo htmlspecialchars($project['client']); ?>"
                    data-summary="<?php echo htmlspecialchars($project['summary']); ?>"
                    data-category="<?php echo htmlspecialchars($project['categoryLabel']); ?>"
                    data-metric-val="<?php echo htmlspecialchars($project['metrics']['value']); ?>"
                    data-metric-label="<?php echo htmlspecialchars($project['metrics']['label']); ?>"
                  >
                    <img
                      src="<?php echo htmlspecialchars($project['imageUrl']); ?>"
                      alt="<?php echo htmlspecialchars($project['title']); ?>"
                      class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-102"
                      loading="lazy"
                    >
                    <!-- Subtle image overlay gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>

                    <!-- Top-left Year Tag -->
                    <div class="absolute top-3.5 left-3.5 px-3 py-1 rounded-full bg-white/95 backdrop-blur-md border border-[#F1E6EE] text-[11px] font-bold text-[#0F172A] font-heading shadow-xs">
                      <span><?php echo htmlspecialchars($project['year']); ?></span>
                    </div>

                    <!-- Bottom-left Category Tag -->
                    <div class="absolute bottom-3.5 left-3.5 px-3 py-1 rounded-full bg-[#FF6B00] text-[11px] font-bold text-white uppercase tracking-wider font-heading shadow-xs">
                      <span><?php echo htmlspecialchars($project['categoryLabel']); ?></span>
                    </div>

                    <!-- Circular Tech Icon Badge -->
                    <div class="absolute top-3.5 right-3.5 w-8 h-8 rounded-full bg-white/95 backdrop-blur-md border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] shadow-sm">
                      <i data-lucide="<?php echo $icon; ?>" class="w-4 h-4 text-[#FF6B00]"></i>
                    </div>
                  </div>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
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
