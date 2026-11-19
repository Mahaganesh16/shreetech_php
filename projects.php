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

<div class="flex flex-col w-full pt-16 sm:pt-20">
  <section id="projects" class="relative py-20 sm:py-28 bg-[#FFF0F5]/25 backdrop-blur-xs overflow-hidden border-y border-[#F1E6EE]">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
        <div class="max-w-2xl">
          <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-3">
            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
            <span>Selected Case Studies</span>
          </div>
          <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading">
            Featured Client Deployments
          </h2>
          <p class="mt-4 text-base text-[#475569] font-normal leading-relaxed font-body">
            Explore how our engineering teams design, build, and scale mission-critical digital systems
            across finance, healthcare, logistics, and global commerce.
          </p>
        </div>

        <!-- Filter Pills -->
        <div class="flex flex-wrap items-center gap-2">
          <?php foreach ($filterTabs as $tab): ?>
            <button
              type="button"
              data-category="<?php echo htmlspecialchars($tab['id']); ?>"
              class="project-filter-btn px-4 py-2 text-xs sm:text-sm font-semibold rounded-2xl transition-all cursor-pointer <?php echo ($tab['id'] === 'all') ? 'glass-btn-primary shadow-sm text-white' : 'glass-btn-secondary text-[#475569] hover:text-[#C01858] hover:border-[#C01858]'; ?>"
            >
              <?php echo htmlspecialchars($tab['label']); ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- STICKY STACKING CARDS CONTAINER -->
      <div class="stacking-cards-container relative max-w-5xl mx-auto flex flex-col items-center pt-4">
        <?php foreach ($projectsData as $idx => $project): 
          $initialTilt = ($idx % 2 === 0) ? '-2deg' : '2deg';
        ?>
          <!-- Dynamic Project Card Item ($idx: <?php echo $idx; ?>) -->
          <article
            class="stacking-card-item project-card-item w-full"
            data-card-index="<?php echo $idx; ?>"
            data-category="<?php echo htmlspecialchars($project['category']); ?>"
            style="--stack-idx: <?php echo $idx; ?>;"
          >
            <!-- Sticky Inner Wrapper: Pins near viewport top with layered header offset -->
            <div class="stacking-card-sticky-inner">
              
              <!-- Card Outer Shell: Dark body with subtle border, 3D shadow, and hardware transform -->
              <div class="stacking-card-box">
                
                <!-- 1. DISTINCT TOP HEADER BAR (Folder Tab / Ticket Header) -->
                <div class="stacking-card-header px-4 sm:px-6 flex items-center justify-between border-b border-black/10 select-none">
                  
                  <!-- Left Rivet Dots & Index -->
                  <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <div class="rivet-dot-group" aria-hidden="true" title="Decorative Rivet">
                      <span class="rivet-dot rivet-dot-lg"></span>
                      <span class="rivet-dot rivet-dot-sm"></span>
                    </div>
                    <span class="font-stat text-[11px] sm:text-xs font-black tracking-widest uppercase opacity-75 text-[#1c1917]">
                      // <?php echo str_pad($idx + 1, 2, '0', STR_PAD_LEFT); ?>
                    </span>
                    <span class="text-[10px] sm:text-xs font-bold font-heading uppercase tracking-wider text-[#C01858] bg-[#C01858]/10 px-2.5 py-0.5 rounded-full hidden sm:inline-block">
                      <?php echo htmlspecialchars($project['categoryLabel']); ?>
                    </span>
                  </div>

                  <!-- Center: Project Title in Header Tab -->
                  <div class="font-heading font-extrabold text-xs sm:text-sm md:text-base tracking-tight truncate px-3 text-[#1c1917] flex-1 text-center sm:text-left">
                    <span><?php echo htmlspecialchars($project['title']); ?></span>
                  </div>

                  <!-- Right: Year & Decorative Rivet Dots -->
                  <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    <span class="font-stat text-[11px] sm:text-xs font-bold tracking-wider text-[#1c1917]/70 hidden xs:inline-block">
                      <?php echo htmlspecialchars($project['year']); ?>
                    </span>
                    <div class="rivet-dot-group" aria-hidden="true" title="Decorative Rivet">
                      <span class="rivet-dot rivet-dot-sm"></span>
                      <span class="rivet-dot rivet-dot-lg"></span>
                    </div>
                  </div>
                </div>

                <!-- 2. DARK CARD BODY (#0f0f0f / #111317) -->
                <div class="stacking-card-body p-5 sm:p-7 md:p-8 grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-center text-white">
                  
                  <!-- Visual Preview Column -->
                  <div class="lg:col-span-6 relative rounded-2xl overflow-hidden border border-white/10 group/preview h-56 sm:h-64 lg:h-[300px] bg-black/40 shadow-inner">
                    <img
                      src="<?php echo htmlspecialchars($project['imageUrl']); ?>"
                      alt="<?php echo htmlspecialchars($project['title']); ?>"
                      class="w-full h-full object-cover group-hover/preview:scale-105 transition-transform duration-700 filter brightness-95"
                      loading="lazy"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/25 to-transparent pointer-events-none"></div>

                    <!-- Category Badge -->
                    <div class="absolute top-3.5 left-3.5">
                      <span class="glass-pill text-[11px] font-semibold text-white/95 px-3 py-1 rounded-full bg-black/60 backdrop-blur-md border border-white/20">
                        <?php echo htmlspecialchars($project['categoryLabel']); ?>
                      </span>
                    </div>

                    <!-- Primary Impact Metric -->
                    <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between p-2.5 sm:p-3 rounded-xl bg-black/75 backdrop-blur-md border border-white/15 shadow-md">
                      <div class="flex items-center gap-2">
                        <i data-lucide="zap" class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-[#FF6B00]"></i>
                        <span class="text-[11px] sm:text-xs text-white/80 font-medium"><?php echo htmlspecialchars($project['metrics']['label']); ?></span>
                      </div>
                      <span class="text-xs sm:text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] via-[#FF9838] to-[#C01858] font-stat">
                        <?php echo htmlspecialchars($project['metrics']['value']); ?>
                      </span>
                    </div>
                  </div>

                  <!-- Project Details Column -->
                  <div class="lg:col-span-6 flex flex-col justify-between h-full space-y-4">
                    <div>
                      <div class="flex items-center gap-2 mb-2">
                        <span class="w-2 h-2 rounded-full bg-[#FF6B00] animate-pulse"></span>
                        <span class="text-xs font-semibold uppercase tracking-wider text-[#FF6B00] font-heading">
                          <?php echo htmlspecialchars($project['client']); ?>
                        </span>
                      </div>

                      <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight font-heading leading-snug">
                        <?php echo htmlspecialchars($project['title']); ?>
                      </h3>

                      <p class="mt-2.5 text-xs sm:text-sm text-slate-300 font-normal leading-relaxed line-clamp-3 font-body">
                        <?php echo htmlspecialchars($project['summary']); ?>
                      </p>

                      <!-- Key Architectural Highlights -->
                      <div class="mt-4 space-y-2 pt-3 border-t border-white/10 font-body">
                        <div class="flex items-start gap-2 text-xs text-slate-300">
                          <i data-lucide="shield-check" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                          <span>Zero-downtime rolling cloud deployment architecture</span>
                        </div>
                        <div class="flex items-start gap-2 text-xs text-slate-300">
                          <i data-lucide="check-circle-2" class="w-4 h-4 text-[#C01858] shrink-0 mt-0.5"></i>
                          <span>High-concurrency streaming telemetry with sub-second latency</span>
                        </div>
                      </div>

                      <!-- Technology Stack Pills -->
                      <div class="mt-4 flex flex-wrap gap-1.5">
                        <?php foreach ($project['technologies'] as $tech): ?>
                          <span class="px-2.5 py-1 rounded-lg text-[11px] font-medium text-slate-200 bg-white/5 border border-white/10 font-body">
                            <?php echo htmlspecialchars($tech); ?>
                          </span>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <!-- Action Trigger Buttons -->
                    <div class="pt-4 border-t border-white/10 flex flex-wrap items-center gap-3">
                      <button
                        type="button"
                        class="open-project-modal glass-btn-primary px-5 py-2.5 rounded-xl text-white font-semibold text-xs sm:text-sm flex items-center gap-2 cursor-pointer shadow-lg hover:scale-105 active:scale-95 transition-all"
                        data-title="<?php echo htmlspecialchars($project['title']); ?>"
                        data-client="<?php echo htmlspecialchars($project['client']); ?>"
                        data-summary="<?php echo htmlspecialchars($project['summary']); ?>"
                        data-category="<?php echo htmlspecialchars($project['categoryLabel']); ?>"
                        data-metric-val="<?php echo htmlspecialchars($project['metrics']['value']); ?>"
                        data-metric-label="<?php echo htmlspecialchars($project['metrics']['label']); ?>"
                      >
                        <span>View Full Case Study</span>
                        <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                      </button>

                      <a
                        href="contact.php"
                        class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold text-slate-300 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-colors inline-flex items-center gap-1.5 cursor-pointer"
                      >
                        <span>Discuss Similar Project</span>
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
  </section>
</div>

<!-- CASE STUDY DETAIL MODAL -->
<div id="project-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-md">
  <div class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6 sm:p-8 rounded-3xl bg-white border border-[#F1E6EE] shadow-2xl">
    
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
