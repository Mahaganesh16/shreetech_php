<?php
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'About Us | Shree Tech';
$pageDescription = 'Learn about Shree Tech, our engineering values, team methodology, and why clients trust us.';
$currentPage = 'about';

$marqueeTestimonials = array_merge($testimonialsData, $testimonialsData);

require_once __DIR__ . '/includes/header.php';
?>

<div class="flex flex-col w-full pt-16 sm:pt-20">

  <!-- 1. MAIN ABOUT SECTION (Transparent Background) -->
  <section id="about" class="relative py-20 sm:py-28 bg-transparent overflow-hidden">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        
        <!-- Left Column: Story & Deliverables -->
        <div class="lg:col-span-6 space-y-6">
          <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6]">
            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
            <span>About Shree Tech</span>
          </div>

          <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight leading-tight font-heading">
            A Dedicated Software Engineering Partner for Growing Businesses
          </h2>

          <p class="text-base text-[#475569] leading-relaxed font-normal font-body">
            Shree Tech is an independent software development and consulting agency. We partner with
            fast-growing businesses, enterprise technology leaders, and modern startups to design, build,
            and maintain mission-critical software solutions with clean, frosted glassmorphism UI.
          </p>

          <p class="text-sm text-[#475569] leading-relaxed font-normal font-body">
            Unlike traditional agencies that pass work to inexperienced subcontractors, our core engineering
            team directly designs your architecture, writes strict type-safe code, and provides continuous
            deployment visibility.
          </p>

          <!-- Core Achievements -->
          <div class="glass-card p-6 rounded-3xl space-y-3.5 border border-[#F1E6EE]">
            <?php
            $achievements = [
                'Full-stack engineering capabilities from concept through multi-cloud deployment',
                'Strict adherence to Domain-Driven Design, clean architecture, and automated testing',
                'Transparent agile communication with direct access to senior developers',
                'Guaranteed response SLAs and dedicated ongoing maintenance support'
            ];
            foreach ($achievements as $ach): ?>
              <div class="flex items-start gap-3">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-[#FF6B00] shrink-0 mt-0.5"></i>
                <span class="text-sm text-[#0F172A] font-medium font-body"><?php echo htmlspecialchars($ach); ?></span>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="pt-2">
            <a
              href="services.php"
              class="inline-flex items-center gap-2 text-sm font-semibold text-[#FF6B00] hover:text-[#C01858] transition-colors group cursor-pointer font-body"
            >
              <span>Read More About Our Engineering Practices</span>
              <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
            </a>
          </div>
        </div>

        <!-- Right Column: Visual Workplace & Stat Counters -->
        <div class="lg:col-span-6 space-y-6">
          <div class="relative rounded-3xl overflow-hidden glass-card glass-card-hover p-2.5 shadow-2xl group">
            <div class="rounded-2xl overflow-hidden relative">
              <img
                src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1000&q=80"
                alt="Shree Tech software engineering team collaborating on architecture"
                class="w-full h-72 sm:h-80 object-cover group-hover:scale-102 transition-transform duration-500"
              >
              <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-80"></div>
              <div class="absolute bottom-4 left-4 right-4 p-3.5 rounded-xl bg-white/95 border border-[#F1E6EE] flex items-center justify-between text-xs text-[#0F172A] shadow-sm">
                <span class="font-bold text-[#0F172A] font-heading">Shree Tech Engineering Labs</span>
                <span class="text-[#475569] font-medium font-body">Sprint Planning</span>
              </div>
            </div>
          </div>

          <!-- 4 Statistics in 3D Flip Cards with Count-Up -->
          <div class="grid grid-cols-2 gap-4">
            <?php
            $stats = [
                ['value' => 150, 'suffix' => '+', 'label' => 'Delivered Projects', 'sublabel' => 'Web, mobile & cloud SaaS', 'detail' => 'Delivered across 12 countries for FinTech, MedTech, and high-growth enterprise SaaS.'],
                ['value' => 99, 'suffix' => '%', 'label' => 'Client Retention', 'sublabel' => 'Long-term technology partners', 'detail' => 'Sustained multi-year engineering partnerships with predictable ongoing delivery SLAs.'],
                ['value' => 10, 'suffix' => '+', 'label' => 'Years Experience', 'sublabel' => 'Established engineering record', 'detail' => 'A decade of architecting distributed systems, cloud migrations, and product launches.'],
                ['value' => 45, 'suffix' => '+', 'label' => 'Senior Engineers', 'sublabel' => 'Specialized across full stack', 'detail' => 'Elite technical directors and full-stack devs specialized in React, Node, Python & Cloud.']
            ];
            foreach ($stats as $sIdx => $st): ?>
              <div class="flip-card-wrapper h-36 sm:h-40 w-full select-none group cursor-pointer reveal-init reveal-up stagger-<?php echo ($sIdx + 1); ?>">
                <div class="flip-card-inner">
                  <!-- Front -->
                  <div class="flip-card-front glass-card p-5 sm:p-6 rounded-2xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                    <div class="card-spotlight-layer"></div>
                    <div>
                      <div class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-stat group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-[#FF6B00] group-hover:to-[#C01858] transition-all duration-300">
                        <span class="stat-counter-number" data-target="<?php echo $st['value']; ?>">0</span><?php echo $st['suffix']; ?>
                      </div>
                      <div class="text-sm font-bold text-[#0F172A] mt-1"><?php echo htmlspecialchars($st['label']); ?></div>
                      <div class="text-xs text-[#475569] mt-0.5"><?php echo htmlspecialchars($st['sublabel']); ?></div>
                    </div>
                    <div class="flex items-center justify-between text-[10px] text-[#475569] group-hover:text-[#C01858] transition-colors pt-2 border-t border-[#F1E6EE]">
                      <span>Flip for detail</span>
                      <i data-lucide="rotate-cw" class="w-3 h-3 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                    </div>
                  </div>

                  <!-- Back -->
                  <div class="flip-card-back glass-card p-4 sm:p-5 rounded-2xl flex flex-col justify-between border-2 border-[#C01858] shadow-md">
                    <div>
                      <div class="flex items-center justify-between mb-1">
                        <span class="text-[10px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2 py-0.5 rounded-full uppercase tracking-wider font-body">
                          Verified Metric
                        </span>
                        <i data-lucide="sparkles" class="w-3 h-3 text-[#8B5CF6]"></i>
                      </div>
                      <div class="text-xs font-bold text-[#0F172A] font-heading mt-1"><?php echo htmlspecialchars($st['label']); ?></div>
                      <p class="text-[11px] text-[#475569] font-normal leading-relaxed mt-1 font-body">
                        <?php echo htmlspecialchars($st['detail']); ?>
                      </p>
                    </div>
                    <div class="flex items-center gap-1.5 text-[10px] text-[#FF6B00] font-semibold pt-1 border-t border-[#F1E6EE]">
                      <i data-lucide="check-circle-2" class="w-3 h-3 shrink-0"></i>
                      <span>Enterprise Benchmark</span>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- 2. MAGENTA-TINT SECTION: WHY CHOOSE US -->
  <section id="why-us" class="relative py-28 sm:py-36 bg-[#FFF0F5]/25 backdrop-blur-xs overflow-hidden border-y border-[#F1E6EE]">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="max-w-3xl mb-16">
        <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-3">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>Why Choose Shree Tech</span>
        </div>
        <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading">
          Engineering Rigor. Transparent Communication. Measurable Outcomes.
        </h2>
        <p class="mt-4 text-base sm:text-lg text-[#475569] font-normal leading-relaxed font-body">
          We operate with the standards of an elite in-house engineering team. Here is how our engineering
          principles translate into clear business advantages for our clients.
        </p>
      </div>

      <!-- 6 Advantages in 3D Flip Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        <?php foreach ($whyChooseUsData as $idx => $item): ?>
          <div class="flip-card-wrapper h-[380px] sm:h-[400px] w-full select-none group cursor-pointer reveal-init reveal-up stagger-<?php echo ($idx + 1); ?>">
            <div class="flip-card-inner">
              <!-- Front -->
              <div class="flip-card-front glass-card p-6 sm:p-8 rounded-3xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors duration-500">
                <div class="card-spotlight-layer"></div>
                <div>
                  <div class="flex items-center justify-between mb-5">
                    <div class="w-12 h-12 rounded-2xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] group-hover:bg-[#FF6B00] group-hover:text-white transition-all duration-300 shadow-xs">
                      <i data-lucide="<?php echo htmlspecialchars($item['iconName']); ?>" class="w-5 h-5"></i>
                    </div>
                    <span class="text-xs font-bold font-stat text-[#475569]/60 group-hover:text-[#FF6B00] transition-colors duration-300">
                      0<?php echo $idx + 1; ?>
                    </span>
                  </div>

                  <h3 class="text-lg font-bold text-[#0F172A] mb-2.5 group-hover:text-[#C01858] transition-colors duration-300 font-heading">
                    <?php echo htmlspecialchars($item['title']); ?>
                  </h3>
                  <p class="text-sm text-[#475569] leading-relaxed font-normal font-body">
                    <?php echo htmlspecialchars($item['description']); ?>
                  </p>
                </div>

                <div class="pt-4 border-t border-[#F1E6EE] flex items-center justify-between">
                  <div class="flex items-center gap-1.5 text-xs font-semibold text-[#475569] group-hover:text-[#C01858] transition-colors">
                    <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] transition-transform duration-500 group-hover:rotate-180"></i>
                    <span>Hover to Flip</span>
                  </div>
                  <span class="text-xs font-black font-stat text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] to-[#C01858] tracking-tight">
                    <?php echo htmlspecialchars($item['metric']); ?>
                  </span>
                </div>
              </div>

              <!-- Back -->
              <div class="flip-card-back glass-card p-6 sm:p-8 rounded-3xl flex flex-col justify-between border-2 border-[#C01858] shadow-lg">
                <div class="relative z-10">
                  <div class="flex items-center justify-between mb-3.5">
                    <span class="text-[11px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-3 py-0.5 rounded-full font-body uppercase tracking-wider">
                      Engineering Standard
                    </span>
                    <span class="text-[11px] font-semibold text-[#475569] font-body flex items-center gap-1">
                      <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00]"></i>
                      Guaranteed
                    </span>
                  </div>

                  <h4 class="text-base font-bold text-[#0F172A] font-heading mb-3">
                    <?php echo htmlspecialchars($item['title']); ?>
                  </h4>

                  <div class="space-y-2.5">
                    <?php foreach ($item['guarantees'] as $g): ?>
                      <div class="flex items-start gap-2.5 text-xs text-[#475569] font-medium font-body leading-snug">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                        <span><?php echo htmlspecialchars($g); ?></span>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>

                <div class="relative z-10 pt-4 border-t border-[#F1E6EE]">
                  <a
                    href="contact.php"
                    class="glass-btn-primary w-full py-2.5 px-4 rounded-2xl text-white font-semibold text-xs sm:text-sm font-body flex items-center justify-center gap-2 cursor-pointer shadow-md"
                  >
                    <span>Partner With Us</span>
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

  <!-- 3. PURPLE-TINT SECTION: CLIENT TESTIMONIALS -->
  <section id="testimonials" class="relative py-28 sm:py-36 bg-[#F5F0FF]/25 backdrop-blur-xs overflow-hidden border-y border-[#F1E6EE]">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header -->
      <div class="text-center max-w-2xl mx-auto mb-14">
        <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-3">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>Client Testimonials</span>
        </div>
        <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading">
          Trusted by Technology Leaders
        </h2>
        <p class="mt-3 text-base text-[#475569] font-normal font-body">
          Read what engineering and product executives say about partnering with Shree Tech.
        </p>
      </div>

      <!-- Testimonials Auto-Scrolling Track with Left/Right Controls -->
      <div class="relative w-full overflow-hidden py-4">
        <!-- Soft Horizon Fade Masks -->
        <div class="pointer-events-none absolute left-0 inset-y-0 w-16 sm:w-28 bg-gradient-to-r from-[#F5F0FF] via-[#F5F0FF]/85 to-transparent z-20"></div>
        <div class="pointer-events-none absolute right-0 inset-y-0 w-16 sm:w-28 bg-gradient-to-l from-[#F5F0FF] via-[#F5F0FF]/85 to-transparent z-20"></div>

        <!-- Scrollable Row -->
        <div
          id="testimonials-track"
          class="flex w-full overflow-x-auto no-scrollbar gap-5 sm:gap-7 select-none scroll-smooth py-2 px-4"
        >
          <?php foreach ($marqueeTestimonials as $t): ?>
            <div class="w-[360px] sm:w-[440px] h-[330px] sm:h-[350px] shrink-0 flip-card-wrapper group cursor-pointer select-none">
              <div class="flip-card-inner">
                
                <!-- Front -->
                <div class="flip-card-front glass-card p-6 sm:p-7 rounded-3xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                  <div>
                    <div class="flex items-center justify-between mb-4">
                      <i data-lucide="quote" class="w-10 h-10 text-[#FF6B00]/25 group-hover:text-[#FF6B00]/40 transition-all duration-300"></i>
                      <div class="flex items-center gap-1">
                        <?php for ($r = 0; $r < $t['rating']; $r++): ?>
                          <i data-lucide="star" class="w-3.5 h-3.5 fill-[#FF6B00] text-[#FF6B00]"></i>
                        <?php endfor; ?>
                      </div>
                    </div>

                    <p class="text-xs sm:text-sm text-[#475569] font-normal font-body leading-relaxed line-clamp-4 italic">
                      &ldquo;<?php echo htmlspecialchars($t['content']); ?>&rdquo;
                    </p>
                  </div>

                  <div class="pt-4 border-t border-[#F1E6EE] flex items-center justify-between">
                    <div class="flex items-center gap-3 min-w-0">
                      <div class="w-11 h-11 rounded-xl p-[2px] bg-gradient-to-tr from-[#FF6B00] via-[#C01858] to-[#8B5CF6] shadow-xs shrink-0">
                        <img src="<?php echo htmlspecialchars($t['imageUrl']); ?>" alt="<?php echo htmlspecialchars($t['name']); ?>" class="w-full h-full rounded-[10px] object-cover">
                      </div>
                      <div class="min-w-0">
                        <div class="text-xs font-bold text-[#0F172A] font-heading truncate"><?php echo htmlspecialchars($t['name']); ?></div>
                        <div class="text-[11px] text-[#475569] font-medium font-body truncate">
                          <?php echo htmlspecialchars($t['designation']); ?>, <span class="text-[#FF6B00] font-semibold"><?php echo htmlspecialchars($t['company']); ?></span>
                        </div>
                      </div>
                    </div>

                    <div class="flex items-center gap-1 text-[11px] font-semibold text-[#475569] group-hover:text-[#C01858] transition-colors shrink-0 pl-2">
                      <i data-lucide="rotate-cw" class="w-3 h-3 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                      <span>Flip</span>
                    </div>
                  </div>
                </div>

                <!-- Back -->
                <div class="flip-card-back glass-card p-6 sm:p-7 rounded-3xl flex flex-col justify-between border-2 border-[#C01858] shadow-lg">
                  <div class="relative z-10">
                    <div class="flex items-center justify-between mb-3">
                      <span class="text-[10px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2.5 py-0.5 rounded-full uppercase tracking-wider font-body">
                        Verified Client Review
                      </span>
                      <div class="flex items-center gap-1 text-[11px] font-semibold text-[#475569] font-body">
                        <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00]"></i>
                        5.0 Rating
                      </div>
                    </div>

                    <h4 class="text-sm font-bold text-[#0F172A] font-heading mb-1">
                      <?php echo htmlspecialchars($t['company']); ?>
                    </h4>
                    <div class="text-[11px] text-[#475569] font-body mb-3">
                      Client Contact: <?php echo htmlspecialchars($t['name']); ?> (<?php echo htmlspecialchars($t['designation']); ?>)
                    </div>

                    <div class="space-y-2">
                      <div class="flex items-start gap-2 text-xs text-[#475569] font-medium font-body leading-snug">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                        <span><strong>Scope:</strong> <?php echo htmlspecialchars($t['scope']); ?></span>
                      </div>
                      <div class="flex items-start gap-2 text-xs text-[#475569] font-medium font-body leading-snug">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                        <span><strong>Tech:</strong> <?php echo htmlspecialchars($t['stack']); ?></span>
                      </div>
                      <div class="flex items-start gap-2 text-xs text-[#475569] font-medium font-body leading-snug">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                        <span><strong>Outcome:</strong> <?php echo htmlspecialchars($t['outcome']); ?></span>
                      </div>
                    </div>
                  </div>

                  <div class="relative z-10 pt-3 border-t border-[#F1E6EE]">
                    <a
                      href="contact.php"
                      class="glass-btn-primary w-full py-2 px-4 rounded-xl text-white font-semibold text-xs font-body flex items-center justify-center gap-1.5 shadow-md"
                    >
                      <span>Discuss Similar Project</span>
                      <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Controls: Left & Right Buttons -->
      <div class="mt-6 flex items-center justify-end">
        <div class="flex items-center gap-2.5">
          <button
            id="testimonials-prev"
            aria-label="Previous testimonial"
            class="glass-btn-secondary p-3 rounded-2xl text-[#0F172A] hover:text-[#C01858] hover:border-[#C01858] active:scale-95 transition-all cursor-pointer shadow-xs"
            title="Previous (Left Arrow key)"
          >
            <i data-lucide="chevron-left" class="w-5 h-5"></i>
          </button>
          <button
            id="testimonials-next"
            aria-label="Next testimonial"
            class="glass-btn-secondary p-3 rounded-2xl text-[#0F172A] hover:text-[#C01858] hover:border-[#C01858] active:scale-95 transition-all cursor-pointer shadow-xs"
            title="Next (Right Arrow key)"
          >
            <i data-lucide="chevron-right" class="w-5 h-5"></i>
          </button>
        </div>
      </div>
    </div>
  </section>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
