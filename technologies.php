<?php
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Technologies | Shree Tech';
$pageDescription = 'Our battle-tested modern technology stack across frontend, backend, databases, mobile, and cloud engineering.';
$currentPage = 'technologies';

$categories = ['All', 'Frontend', 'Backend', 'Database', 'Mobile', 'Cloud'];

require_once __DIR__ . '/includes/header.php';
?>

<div class="flex flex-col w-full pt-16 sm:pt-20">
  <section id="technologies" class="relative py-20 sm:py-28 bg-transparent overflow-hidden">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="max-w-3xl mb-12">
        <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-3">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>Core Technology Stack</span>
        </div>
        <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading">
          Battle-Tested Modern Technologies
        </h2>
        <p class="mt-4 text-base sm:text-lg text-[#475569] font-normal leading-relaxed font-body">
          We build with reliable, industry-standard languages and frameworks that guarantee long-term
          maintainability, enterprise scalability, and developer ergonomics.
        </p>
      </div>

      <!-- Filter Buttons -->
      <div class="flex flex-wrap items-center gap-2 pb-8 border-b border-[#F1E6EE]">
        <?php foreach ($categories as $cat): ?>
          <button
            type="button"
            data-category="<?php echo htmlspecialchars($cat); ?>"
            class="tech-filter-btn px-4 py-2 text-xs sm:text-sm font-semibold rounded-2xl transition-all cursor-pointer font-body <?php echo ($cat === 'All') ? 'glass-btn-primary shadow-sm text-white' : 'glass-btn-secondary text-[#475569] hover:text-[#C01858] hover:border-[#C01858]'; ?>"
          >
            <?php echo htmlspecialchars($cat); ?>
          </button>
        <?php endforeach; ?>
      </div>

      <!-- Technology Showcase Strip (Single Unified Strip with Category Sequencing) -->
      <div class="mt-10">
        
        <!-- Active Category Header & Description -->
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1 pb-2 border-b border-[#F1E6EE] mb-6">
          <h3 id="active-category-title" class="text-xl font-bold text-[#0F172A] font-heading">
            All Technology Disciplines
          </h3>
          <span id="active-category-desc" class="text-xs text-[#475569] font-normal font-body">
            Comprehensive enterprise ecosystem across frontend, backend, databases, mobile, and cloud engineering.
          </span>
        </div>

        <?php 
        // Build all technologies array (5 per category, 25 total) for the "All" single master strip
        $allTechnologies = [];
        foreach ($technologyGroups as $group) {
            foreach ($group['items'] as $item) {
                $item['category'] = $group['category'];
                $allTechnologies[] = $item;
            }
        }

        // Category-specific durations
        $categoryDurations = [
            'All'      => '50s',
            'Frontend' => '30s',
            'Backend'  => '32s',
            'Database' => '35s',
            'Mobile'   => '28s',
            'Cloud'    => '34s',
        ];

        /**
         * Reusable technology card markup with increased dimensions (330px x 104px)
         */
        function renderShowcaseCard($tech, $catName) {
        ?>
          <div class="tech-card-item w-[280px] sm:w-[310px] md:w-[330px] h-[96px] sm:h-[104px] shrink-0 flip-card-wrapper group cursor-pointer select-none">
            <div class="flip-card-inner">
              
              <!-- Front Face -->
              <div class="flip-card-front glass-card p-3 sm:p-3.5 rounded-2xl flex items-center gap-3 sm:gap-3.5 border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-xl bg-white border border-[#F1E6EE] flex items-center justify-center shrink-0 p-2 sm:p-2.5 shadow-xs">
                  <?php echo renderTechLogo($tech['iconComponent'], 'w-full h-full object-contain'); ?>
                </div>
                <div class="overflow-hidden min-w-0 flex-1">
                  <div class="flex items-center justify-between gap-1 mb-0.5">
                    <span class="text-[8px] sm:text-[9px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2 py-0.5 rounded-full uppercase tracking-wider font-body shrink-0">
                      <?php echo htmlspecialchars($catName); ?>
                    </span>
                    <i data-lucide="rotate-cw" class="w-3 h-3 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500 shrink-0"></i>
                  </div>
                  <h4 class="text-xs sm:text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors truncate font-heading">
                    <?php echo htmlspecialchars($tech['name']); ?>
                  </h4>
                  <p class="text-[10px] sm:text-[11px] text-[#475569] truncate mt-0.5 font-normal font-body">
                    <?php echo htmlspecialchars($tech['description']); ?>
                  </p>
                </div>
              </div>

              <!-- Back Face -->
              <div class="flip-card-back glass-card p-3 rounded-2xl flex items-center justify-between gap-3 border-2 border-[#C01858] bg-white shadow-md">
                <div class="min-w-0 flex-1">
                  <div class="flex items-center gap-1.5 mb-1">
                    <span class="text-[8px] sm:text-[9px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2 py-0.5 rounded-full uppercase tracking-wider font-body">
                      <?php echo htmlspecialchars($catName); ?>
                    </span>
                    <span class="text-[10px] sm:text-[11px] font-bold text-[#0F172A] font-heading truncate">
                      <?php echo htmlspecialchars($tech['name']); ?>
                    </span>
                  </div>
                  <div class="flex items-center gap-1 text-[9px] sm:text-[10px] text-[#475569] font-medium font-body truncate">
                    <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#FF6B00] shrink-0"></i>
                    <span>Production-Hardened</span>
                  </div>
                </div>
                <div class="w-8 h-8 rounded-xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center shrink-0 text-[#FF6B00]">
                  <i data-lucide="sparkles" class="w-4 h-4"></i>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>

        <!-- 1. Master Single Strip for "All" (Frontend -> Backend -> Database -> Mobile -> Cloud) -->
        <div class="tech-category-group" data-category="All">
          <div 
            class="tech-marquee-wrapper relative w-full overflow-hidden py-4" 
            style="--marquee-duration: <?php echo $categoryDurations['All']; ?>;"
          >
            <!-- Soft Horizon Fade Masks -->
            <div class="pointer-events-none absolute left-0 inset-y-0 w-12 sm:w-24 md:w-36 bg-gradient-to-r from-white via-white/85 to-transparent z-10"></div>
            <div class="pointer-events-none absolute right-0 inset-y-0 w-12 sm:w-24 md:w-36 bg-gradient-to-l from-white via-white/85 to-transparent z-10"></div>

            <div class="tech-marquee-track marquee-left">
              <!-- Sequence 1: All 25 technologies in order (5 per category) -->
              <div class="tech-marquee-group" aria-hidden="false">
                <?php foreach ($allTechnologies as $tech): 
                  renderShowcaseCard($tech, $tech['category']);
                endforeach; ?>
              </div>

              <!-- Sequence 2: Identical 25 technologies clone for 100% seamless infinite loop -->
              <div class="tech-marquee-group" aria-hidden="true">
                <?php foreach ($allTechnologies as $tech): 
                  renderShowcaseCard($tech, $tech['category']);
                endforeach; ?>
              </div>
            </div>
          </div>
        </div>

        <!-- 2. Category-Specific Strips (Activated when specific filter is clicked) -->
        <?php foreach ($technologyGroups as $group): 
          $catName = $group['category'];
          $duration = $categoryDurations[$catName] ?? '32s';
          // 5 items repeated 2x so single group spans > 3000px
          $catItems = array_merge($group['items'], $group['items']);
        ?>
          <div class="tech-category-group hidden" data-category="<?php echo htmlspecialchars($catName); ?>">
            <div 
              class="tech-marquee-wrapper relative w-full overflow-hidden py-4" 
              style="--marquee-duration: <?php echo htmlspecialchars($duration); ?>;"
            >
              <!-- Soft Horizon Fade Masks -->
              <div class="pointer-events-none absolute left-0 inset-y-0 w-12 sm:w-24 md:w-36 bg-gradient-to-r from-white via-white/85 to-transparent z-10"></div>
              <div class="pointer-events-none absolute right-0 inset-y-0 w-12 sm:w-24 md:w-36 bg-gradient-to-l from-white via-white/85 to-transparent z-10"></div>

              <div class="tech-marquee-track marquee-left">
                <!-- Sequence 1 -->
                <div class="tech-marquee-group" aria-hidden="false">
                  <?php foreach ($catItems as $tech): 
                    renderShowcaseCard($tech, $catName);
                  endforeach; ?>
                </div>

                <!-- Sequence 2 (Identical clone for seamless loop) -->
                <div class="tech-marquee-group" aria-hidden="true">
                  <?php foreach ($catItems as $tech): 
                    renderShowcaseCard($tech, $catName);
                  endforeach; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
    </div>
  </section>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
