<?php
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Our Services | Shree Tech';
$pageDescription = 'Enterprise software development, web & mobile applications, cloud architecture, and automation services.';
$currentPage = 'services';

require_once __DIR__ . '/includes/header.php';
?>

<div class="flex flex-col w-full pt-16 sm:pt-20">

  <!-- 1. SERVICES SECTION (Transparent Background) -->
  <section id="services" class="relative py-20 sm:py-28 bg-transparent overflow-hidden">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="max-w-3xl mb-16">
        <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-3">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>Our Services</span>
        </div>
        <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading">
          Comprehensive Software Engineering & Technical Consulting
        </h2>
        <p class="mt-4 text-base sm:text-lg text-[#475569] font-normal leading-relaxed font-body">
          We provide end-to-end technology services tailored to modern enterprise requirements. Explore
          our eight core service disciplines engineered with clean, frosted glassmorphism UI.
        </p>
      </div>

      <!-- 8 Services in 3D Flip Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($servicesData as $idx => $service): ?>
          <div class="flip-card-wrapper h-[380px] sm:h-[400px] w-full select-none group cursor-pointer reveal-init reveal-up stagger-<?php echo (($idx % 4) + 1); ?>">
            <div class="flip-card-inner">
              
              <!-- Front Face -->
              <div class="flip-card-front glass-card p-6 sm:p-7 rounded-3xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors duration-500">
                <div class="card-spotlight-layer"></div>
                <div>
                  <div class="flex items-center justify-between mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] group-hover:bg-[#FF6B00] group-hover:text-white group-hover:scale-105 transition-all duration-300 shadow-xs">
                      <i data-lucide="<?php echo htmlspecialchars($service['iconName']); ?>" class="w-6 h-6"></i>
                    </div>
                    <span class="text-xs font-bold font-stat text-[#475569]/60 group-hover:text-[#FF6B00] transition-colors">
                      0<?php echo $idx + 1; ?>
                    </span>
                  </div>

                  <h3 class="text-lg font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors duration-300 font-heading mb-2.5">
                    <?php echo htmlspecialchars($service['title']); ?>
                  </h3>

                  <p class="text-xs sm:text-sm text-[#475569] font-normal leading-relaxed">
                    <?php echo htmlspecialchars($service['description']); ?>
                  </p>
                </div>

                <div class="pt-4 border-t border-[#F1E6EE] flex items-center justify-between">
                  <span class="text-xs font-semibold text-[#475569] group-hover:text-[#C01858] transition-colors duration-300 font-body flex items-center gap-1.5">
                    <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] transition-transform duration-500 group-hover:rotate-180"></i>
                    <span>Hover to Flip</span>
                  </span>
                  <div class="w-8 h-8 rounded-full bg-white border border-[#F1E6EE] group-hover:border-[#C01858] group-hover:bg-[#C01858] text-[#475569] group-hover:text-white flex items-center justify-center transition-all duration-300 shadow-xs">
                    <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform duration-300"></i>
                  </div>
                </div>
              </div>

              <!-- Back Face -->
              <div class="flip-card-back glass-card p-6 sm:p-7 rounded-3xl flex flex-col justify-between border-2 border-[#C01858] shadow-lg">
                <div class="relative z-10">
                  <div class="flex items-center justify-between mb-3.5">
                    <span class="text-[11px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-3 py-0.5 rounded-full font-body uppercase tracking-wider">
                      Key Deliverables
                    </span>
                    <span class="text-[11px] font-semibold text-[#475569] font-body flex items-center gap-1">
                      <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00]"></i>
                      Included Scope
                    </span>
                  </div>

                  <h4 class="text-base font-bold text-[#0F172A] font-heading mb-3">
                    <?php echo htmlspecialchars($service['title']); ?>
                  </h4>

                  <div class="space-y-2">
                    <?php foreach ($service['deliverables'] as $item): ?>
                      <div class="flex items-start gap-2 text-xs text-[#475569] font-medium">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#FF6B00] shrink-0 mt-0.5"></i>
                        <span class="leading-snug"><?php echo htmlspecialchars($item); ?></span>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

                <div class="relative z-10 pt-4 border-t border-[#F1E6EE]">
                  <a
                    href="contact.php"
                    class="glass-btn-primary w-full py-2.5 px-4 rounded-2xl text-white font-semibold text-xs sm:text-sm font-body flex items-center justify-center gap-2 cursor-pointer shadow-md"
                  >
                    <span>Discuss Requirement</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                  </a>
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
