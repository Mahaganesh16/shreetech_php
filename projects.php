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

      <!-- 3D Flip Case Studies Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach ($projectsData as $idx => $project): 
          $isFeatured = ($project['layoutSpan'] === 'featured');
        ?>
          <div
            class="project-card-item flip-card-wrapper h-[520px] sm:h-[540px] w-full select-none group cursor-pointer reveal-init reveal-up stagger-<?php echo (($idx % 3) + 1); ?> <?php echo $isFeatured ? 'md:col-span-2' : 'col-span-1'; ?>"
            data-category="<?php echo htmlspecialchars($project['category']); ?>"
          >
            <div class="flip-card-inner">
              
              <!-- Front Face -->
              <div class="flip-card-front glass-card rounded-3xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors duration-500 overflow-hidden cursor-pointer">
                <div class="card-spotlight-layer"></div>
                <!-- Image Preview -->
                <div class="relative h-60 sm:h-64 overflow-hidden shrink-0">
                  <img
                    src="<?php echo htmlspecialchars($project['imageUrl']); ?>"
                    alt="<?php echo htmlspecialchars($project['title']); ?>"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  >
                  <div class="absolute inset-0 bg-gradient-to-t from-slate-900/65 via-transparent to-transparent opacity-80"></div>

                  <!-- Badges -->
                  <div class="absolute top-4 left-4 right-4 flex items-center justify-between">
                    <span class="glass-pill px-3 py-1 rounded-xl text-xs font-semibold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE]">
                      <?php echo htmlspecialchars($project['categoryLabel']); ?>
                    </span>
                    <span class="glass-pill text-xs font-stat font-semibold text-[#475569] px-2.5 py-1 rounded-xl bg-white/90 border border-[#F1E6EE]">
                      <?php echo htmlspecialchars($project['year']); ?>
                    </span>
                  </div>

                  <!-- Metric Pill -->
                  <div class="absolute bottom-3 right-3 px-3 py-1 rounded-xl bg-white/95 border border-[#F1E6EE] text-right shadow-xs">
                    <div class="text-[9px] text-[#475569] font-semibold uppercase tracking-wider">
                      <?php echo htmlspecialchars($project['metrics']['label']); ?>
                    </div>
                    <div class="text-xs font-black text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] to-[#C01858] font-stat tracking-tight">
                      <?php echo htmlspecialchars($project['metrics']['value']); ?>
                    </div>
                  </div>
                </div>

                <!-- Front Content -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                  <div>
                    <div class="text-xs font-semibold text-[#FF6B00] mb-1 font-body"><?php echo htmlspecialchars($project['client']); ?></div>
                    <h3 class="text-lg sm:text-xl font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors duration-300 font-heading mb-2">
                      <?php echo htmlspecialchars($project['title']); ?>
                    </h3>
                    <p class="text-xs sm:text-sm text-[#475569] font-normal font-body leading-relaxed line-clamp-2">
                      <?php echo htmlspecialchars($project['summary']); ?>
                    </p>

                    <!-- Tech Tags -->
                    <div class="mt-3 flex flex-wrap gap-1.5">
                      <?php foreach (array_slice($project['technologies'], 0, 3) as $tech): ?>
                        <span class="glass-pill px-2.5 py-0.5 rounded-lg text-[11px] text-[#475569] font-medium font-body bg-[#F5F0FF] border border-[#F1E6EE]">
                          <?php echo htmlspecialchars($tech); ?>
                        </span>
                      <?php endforeach; ?>
                      <?php if (count($project['technologies']) > 3): ?>
                        <span class="text-[11px] text-[#475569]/60 font-medium self-center">
                          +<?php echo count($project['technologies']) - 3; ?> more
                        </span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- Flip Hint -->
                  <div class="pt-3 border-t border-[#F1E6EE] flex items-center justify-between">
                    <span class="text-xs font-semibold text-[#475569] group-hover:text-[#C01858] transition-colors duration-300 font-body flex items-center gap-1.5">
                      <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] transition-transform duration-500 group-hover:rotate-180"></i>
                      <span>Hover to Flip</span>
                    </span>
                    <div class="w-8 h-8 rounded-full bg-white border border-[#F1E6EE] group-hover:border-[#C01858] group-hover:bg-[#C01858] text-[#475569] group-hover:text-white flex items-center justify-center transition-all duration-300 shadow-xs">
                      <i data-lucide="arrow-up-right" class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-300"></i>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Back Face -->
              <div class="flip-card-back glass-card p-6 sm:p-7 rounded-3xl flex flex-col justify-between border-2 border-[#C01858] bg-white shadow-lg">
                <div class="relative z-10">
                  <div class="flex items-center justify-between mb-3">
                    <span class="text-[11px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-3 py-0.5 rounded-full font-body uppercase tracking-wider">
                      <?php echo htmlspecialchars($project['categoryLabel']); ?>
                    </span>
                    <span class="text-[11px] font-semibold text-[#475569] font-body flex items-center gap-1">
                      <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00]"></i>
                      Case Highlights
                    </span>
                  </div>

                  <div class="text-xs font-semibold text-[#FF6B00] font-body"><?php echo htmlspecialchars($project['client']); ?></div>
                  <h4 class="text-lg font-bold text-[#0F172A] font-heading mb-3">
                    <?php echo htmlspecialchars($project['title']); ?>
                  </h4>

                  <!-- Metric Banner -->
                  <div class="p-3 rounded-xl bg-[#FFF4EA] border border-[#F1E6EE] mb-3 flex items-center justify-between">
                    <span class="text-xs text-[#475569] font-medium font-body"><?php echo htmlspecialchars($project['metrics']['label']); ?></span>
                    <span class="text-sm font-black text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] to-[#C01858] font-stat">
                      <?php echo htmlspecialchars($project['metrics']['value']); ?>
                    </span>
                  </div>

                  <div class="space-y-2">
                    <div class="flex items-start gap-2 text-xs text-[#475569] font-medium font-body leading-snug">
                      <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                      <span>Zero downtime rolling deployment architecture</span>
                    </div>
                    <div class="flex items-start gap-2 text-xs text-[#475569] font-medium font-body leading-snug">
                      <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                      <span>High-concurrency cloud scaling & sub-second response times</span>
                    </div>
                  </div>

                  <div class="mt-3 pt-3 border-t border-[#F1E6EE]">
                    <div class="text-[10px] font-bold uppercase tracking-wider text-[#475569] font-body mb-1.5">
                      Technologies Stack
                    </div>
                    <div class="flex flex-wrap gap-1">
                      <?php foreach ($project['technologies'] as $t): ?>
                        <span class="glass-pill px-2 py-0.5 rounded-md text-[10px] text-[#475569] font-medium font-body bg-[#F5F0FF] border border-[#F1E6EE]">
                          <?php echo htmlspecialchars($t); ?>
                        </span>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>

                <div class="relative z-10 pt-4 border-t border-[#F1E6EE]">
                  <button
                    type="button"
                    class="open-project-modal glass-btn-primary w-full py-2.5 px-4 rounded-2xl text-white font-semibold text-xs sm:text-sm font-body flex items-center justify-center gap-2 cursor-pointer shadow-md"
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
                </div>
              </div>
            </div>
          </div>
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
