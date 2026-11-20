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

      <!-- Technology Groups with Auto-Scrolling Rows -->
      <div class="mt-10 space-y-12">
        <?php 
        // Alternating directions and category-specific durations as required:
        // Frontend: Right-to-Left (marquee-left), 30s
        // Backend: Left-to-Right (marquee-right), 35s
        // Database: Right-to-Left (marquee-left), 32s
        // Mobile: Left-to-Right (marquee-right), 28s
        // Cloud: Right-to-Left (marquee-left), 35s
        $categorySettings = [
            'Frontend' => ['direction' => 'marquee-left',  'duration' => '30s'],
            'Backend'  => ['direction' => 'marquee-right', 'duration' => '35s'],
            'Database' => ['direction' => 'marquee-left',  'duration' => '32s'],
            'Mobile'   => ['direction' => 'marquee-right', 'duration' => '28s'],
            'Cloud'    => ['direction' => 'marquee-left',  'duration' => '35s'],
        ];

        foreach ($technologyGroups as $idx => $group): 
          $catName = $group['category'];
          $config = $categorySettings[$catName] ?? [
              'direction' => ($idx % 2 === 0) ? 'marquee-left' : 'marquee-right',
              'duration'  => '32s'
          ];
          // Base set has at least 8 items so a single group spans > 2400px
          $baseItems = getMarqueeBaseSet($group['items'], 8);
        ?>
          <div class="tech-category-group space-y-4 reveal-init reveal-fade" data-category="<?php echo htmlspecialchars($group['category']); ?>">
            
            <!-- Category Header -->
            <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1 pb-2 border-b border-[#F1E6EE]">
              <h3 class="text-xl font-bold text-[#0F172A] font-heading">
                <?php echo htmlspecialchars($group['category']); ?> Engineering
              </h3>
              <span class="text-xs text-[#475569] font-normal font-body"><?php echo htmlspecialchars($group['description']); ?></span>
            </div>

            <!-- Continuous Infinite Auto-Scrolling Track -->
            <div 
              class="tech-marquee-wrapper relative w-full overflow-hidden py-3" 
              style="--marquee-duration: <?php echo htmlspecialchars($config['duration']); ?>;"
            >
              <!-- Soft Horizon Fade Masks -->
              <div class="pointer-events-none absolute left-0 inset-y-0 w-12 sm:w-24 md:w-32 bg-gradient-to-r from-white via-white/85 to-transparent z-10"></div>
              <div class="pointer-events-none absolute right-0 inset-y-0 w-12 sm:w-24 md:w-32 bg-gradient-to-l from-white via-white/85 to-transparent z-10"></div>

              <!-- Dual-group Track for 100% Seamless Infinite Looping -->
              <div class="tech-marquee-track <?php echo htmlspecialchars($config['direction']); ?>">
                
                <!-- Sequence 1 -->
                <div class="tech-marquee-group" aria-hidden="false">
                  <?php foreach ($baseItems as $tech): ?>
                    <div class="tech-card-item w-[240px] sm:w-[260px] md:w-[280px] h-[88px] sm:h-[92px] shrink-0 flip-card-wrapper group cursor-pointer select-none">
                      <div class="flip-card-inner">
                        
                        <!-- Front Face -->
                        <div class="flip-card-front glass-card p-3 sm:p-3.5 rounded-2xl flex items-center gap-3 sm:gap-3.5 border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                          <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-white border border-[#F1E6EE] flex items-center justify-center shrink-0 p-2 shadow-xs">
                            <?php echo renderTechLogo($tech['iconComponent'], 'w-full h-full object-contain'); ?>
                          </div>
                          <div class="overflow-hidden min-w-0 flex-1">
                            <div class="flex items-center justify-between">
                              <h4 class="text-xs sm:text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors truncate font-heading">
                                <?php echo htmlspecialchars($tech['name']); ?>
                              </h4>
                              <i data-lucide="rotate-cw" class="w-3 h-3 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500 shrink-0"></i>
                            </div>
                            <p class="text-[10px] sm:text-[11px] text-[#475569] truncate mt-0.5 font-normal font-body">
                              <?php echo htmlspecialchars($tech['description']); ?>
                            </p>
                          </div>
                        </div>

                        <!-- Back Face -->
                        <div class="flip-card-back glass-card p-2.5 sm:p-3 rounded-2xl flex items-center justify-between gap-2.5 sm:gap-3 border-2 border-[#C01858] bg-white shadow-md">
                          <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-1.5 mb-1">
                              <span class="text-[8px] sm:text-[9px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2 py-0.5 rounded-full uppercase tracking-wider font-body">
                                <?php echo htmlspecialchars($group['category']); ?>
                              </span>
                              <span class="text-[9px] sm:text-[10px] font-bold text-[#0F172A] font-heading truncate">
                                <?php echo htmlspecialchars($tech['name']); ?>
                              </span>
                            </div>
                            <div class="flex items-center gap-1 text-[9px] sm:text-[10px] text-[#475569] font-medium font-body truncate">
                              <i data-lucide="check-circle-2" class="w-3 h-3 text-[#FF6B00] shrink-0"></i>
                              <span>Production-Hardened</span>
                            </div>
                          </div>
                          <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center shrink-0 text-[#FF6B00]">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>

                <!-- Sequence 2 (Identical Clone for unbroken seamless loop) -->
                <div class="tech-marquee-group" aria-hidden="true">
                  <?php foreach ($baseItems as $tech): ?>
                    <div class="tech-card-item w-[240px] sm:w-[260px] md:w-[280px] h-[88px] sm:h-[92px] shrink-0 flip-card-wrapper group cursor-pointer select-none">
                      <div class="flip-card-inner">
                        
                        <!-- Front Face -->
                        <div class="flip-card-front glass-card p-3 sm:p-3.5 rounded-2xl flex items-center gap-3 sm:gap-3.5 border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                          <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-white border border-[#F1E6EE] flex items-center justify-center shrink-0 p-2 shadow-xs">
                            <?php echo renderTechLogo($tech['iconComponent'], 'w-full h-full object-contain'); ?>
                          </div>
                          <div class="overflow-hidden min-w-0 flex-1">
                            <div class="flex items-center justify-between">
                              <h4 class="text-xs sm:text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors truncate font-heading">
                                <?php echo htmlspecialchars($tech['name']); ?>
                              </h4>
                              <i data-lucide="rotate-cw" class="w-3 h-3 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500 shrink-0"></i>
                            </div>
                            <p class="text-[10px] sm:text-[11px] text-[#475569] truncate mt-0.5 font-normal font-body">
                              <?php echo htmlspecialchars($tech['description']); ?>
                            </p>
                          </div>
                        </div>

                        <!-- Back Face -->
                        <div class="flip-card-back glass-card p-2.5 sm:p-3 rounded-2xl flex items-center justify-between gap-2.5 sm:gap-3 border-2 border-[#C01858] bg-white shadow-md">
                          <div class="min-w-0 flex-1">
                            <div class="flex items-center gap-1.5 mb-1">
                              <span class="text-[8px] sm:text-[9px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2 py-0.5 rounded-full uppercase tracking-wider font-body">
                                <?php echo htmlspecialchars($group['category']); ?>
                              </span>
                              <span class="text-[9px] sm:text-[10px] font-bold text-[#0F172A] font-heading truncate">
                                <?php echo htmlspecialchars($tech['name']); ?>
                              </span>
                            </div>
                            <div class="flex items-center gap-1 text-[9px] sm:text-[10px] text-[#475569] font-medium font-body truncate">
                              <i data-lucide="check-circle-2" class="w-3 h-3 text-[#FF6B00] shrink-0"></i>
                              <span>Production-Hardened</span>
                            </div>
                          </div>
                          <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center shrink-0 text-[#FF6B00]">
                            <i data-lucide="sparkles" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
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
