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

      <!-- STACKING CARDS DECK (CALIBRATED FOR ZERO CLIPPING ACROSS ALL VIEWPORTS) -->
      <div class="stacking-deck-container relative w-full max-w-4xl lg:max-w-5xl mx-auto flex flex-col justify-start items-center">
        <div class="stacking-cards-deck relative w-full h-[400px] sm:h-[430px] md:h-[450px]">
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
            <!-- Dynamic Big Project Stacking Card ($idx: <?php echo $idx; ?>) -->
            <article
              class="stacking-card-item project-card-item"
              data-card-index="<?php echo $idx; ?>"
              data-category="<?php echo htmlspecialchars($project['category']); ?>"
              style="--stack-idx: <?php echo $idx; ?>;"
            >
              <!-- Card Outer Shell: Dark body #141414 with 1.5px subtle border & shadow -->
              <div class="stacking-card-box">
                
                <!-- TOP HEADER BAR (Folder Tab / Ticket Header from Reference Video) -->
                <div class="stacking-card-header px-4 sm:px-6 flex items-center justify-between select-none">
                  <!-- Left Decorative Rivet Dot -->
                  <span class="card-rivet" aria-hidden="true"></span>

                  <!-- Center: Project Title / Main Headline in Bold Uppercase -->
                  <div class="font-heading font-black text-xs sm:text-sm tracking-wider uppercase truncate px-3 text-[#1c1917] text-center flex-1">
                    <span><?php echo htmlspecialchars($project['title']); ?></span>
                  </div>

                  <!-- Right Decorative Rivet Dot -->
                  <span class="card-rivet" aria-hidden="true"></span>
                </div>

                <!-- DARK CARD BODY (#141414) CALIBRATED FOR FULL VIEW WITH NO CUTOFFS -->
                <div class="stacking-card-body p-3.5 sm:p-4 md:p-5 text-white">
                  <div class="grid grid-cols-1 md:grid-cols-12 gap-3.5 md:gap-5 items-center">
                    
                    <!-- LEFT COLUMN: Substantial High-Resolution Project Preview -->
                    <div class="md:col-span-5 relative group overflow-hidden rounded-xl border border-white/10 bg-black/40 h-44 sm:h-52 md:h-60 lg:h-[250px] xl:h-[265px] flex items-center justify-center shadow-lg">
                      <img
                        src="<?php echo htmlspecialchars($project['imageUrl']); ?>"
                        alt="<?php echo htmlspecialchars($project['title']); ?>"
                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        loading="lazy"
                      >
                      <!-- Subtle image overlay gradient -->
                      <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/25 to-transparent pointer-events-none"></div>

                      <!-- Top-left Year Tag -->
                      <div class="absolute top-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-black/60 backdrop-blur-md border border-white/15 text-[11px] font-semibold text-white/90 font-heading shadow-xs">
                        <span><?php echo htmlspecialchars($project['year']); ?></span>
                      </div>

                      <!-- Bottom-left Category Tag -->
                      <div class="absolute bottom-2.5 left-2.5 px-2.5 py-0.5 rounded-full bg-[#FF6B00]/90 backdrop-blur-md text-[10px] font-bold text-white uppercase tracking-wider font-heading shadow-xs">
                        <span><?php echo htmlspecialchars($project['categoryLabel']); ?></span>
                      </div>

                      <!-- Circular Tech Icon Badge -->
                      <div class="absolute top-2.5 right-2.5 w-7 h-7 rounded-full bg-black/60 backdrop-blur-md border border-white/20 flex items-center justify-center text-white shadow-sm">
                        <i data-lucide="<?php echo $icon; ?>" class="w-3.5 h-3.5 text-white"></i>
                      </div>
                    </div>

                    <!-- RIGHT COLUMN: Rich Project Content, Metrics, Technologies & Actions -->
                    <div class="md:col-span-7 flex flex-col justify-between text-left py-0.5">
                      
                      <div>
                        <!-- Client Header -->
                        <div class="flex items-center gap-1.5 mb-1">
                          <span class="w-1.5 h-1.5 rounded-full bg-[#FF6B00]"></span>
                          <span class="text-xs font-bold uppercase tracking-wider text-[#FF6B00] font-heading">
                            <?php echo htmlspecialchars($project['client']); ?>
                          </span>
                        </div>

                        <!-- Project Title -->
                        <h3 class="text-base sm:text-lg md:text-xl font-black text-white tracking-tight font-heading mb-1 leading-tight">
                          <?php echo htmlspecialchars($project['title']); ?>
                        </h3>

                        <!-- Summary Description -->
                        <p class="text-xs text-slate-300 font-normal leading-relaxed mb-2 font-body line-clamp-2">
                          <?php echo htmlspecialchars($project['summary']); ?>
                        </p>

                        <!-- Impact Metric Highlight Box -->
                        <div class="p-2 sm:p-2.5 rounded-xl bg-white/5 border border-white/10 flex items-center justify-between mb-2 max-w-lg shadow-inner">
                          <div class="flex flex-col">
                            <span class="text-[10px] text-slate-400 font-medium">Primary Impact Metric</span>
                            <span class="text-xs text-slate-200 font-semibold"><?php echo htmlspecialchars($project['metrics']['label']); ?></span>
                          </div>
                          <span class="text-base sm:text-lg md:text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] to-[#C01858] font-stat">
                            <?php echo htmlspecialchars($project['metrics']['value']); ?>
                          </span>
                        </div>

                        <!-- Technologies Stack Badges -->
                        <div class="flex flex-wrap gap-1 sm:gap-1.5 mb-2.5">
                          <?php foreach ($project['technologies'] as $tech): ?>
                            <span class="px-2 py-0.5 rounded-md text-[11px] font-medium text-slate-300 bg-white/5 border border-white/10 font-body">
                              <?php echo htmlspecialchars($tech); ?>
                            </span>
                          <?php endforeach; ?>
                        </div>
                      </div>

                      <!-- Action Buttons -->
                      <div class="flex items-center gap-2.5 pt-2 border-t border-white/10">
                        <button
                          type="button"
                          class="open-project-modal glass-btn-primary flex-1 py-2 px-3.5 rounded-xl text-white font-semibold text-xs sm:text-sm flex items-center justify-center gap-1.5 cursor-pointer shadow-lg hover:scale-102 active:scale-98 transition-all"
                          data-title="<?php echo htmlspecialchars($project['title']); ?>"
                          data-client="<?php echo htmlspecialchars($project['client']); ?>"
                          data-summary="<?php echo htmlspecialchars($project['summary']); ?>"
                          data-category="<?php echo htmlspecialchars($project['categoryLabel']); ?>"
                          data-metric-val="<?php echo htmlspecialchars($project['metrics']['value']); ?>"
                          data-metric-label="<?php echo htmlspecialchars($project['metrics']['label']); ?>"
                        >
                          <span>View Full Case Study</span>
                          <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                        </button>

                        <a
                          href="contact.php"
                          class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-colors inline-flex items-center gap-1 cursor-pointer shrink-0"
                        >
                          <span>Consult</span>
                        </a>
                      </div>

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
