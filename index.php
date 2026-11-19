<?php
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Shree Tech | Software Engineering & Cloud Solutions';
$pageDescription = 'Building Digital Solutions That Move Businesses Forward. Enterprise software engineering, modern web platforms, mobile apps, and cloud architectures.';
$currentPage = 'home';

$directorySections = [
    [
        'title' => 'About Shree Tech',
        'description' => 'Dedicated software engineering team, enterprise delivery standards, and client-first culture.',
        'href' => 'about.php',
        'badge' => 'Company Profile',
        'icon' => 'users',
        'backBadge' => 'Core Highlights',
        'backTitle' => 'Engineering Discipline',
        'highlights' => [
            '10+ Years enterprise software delivery record',
            '45+ Senior full-stack developers & architects',
            '99% Long-term client retention rate',
            'ISO-aligned clean code & domain architecture'
        ],
        'ctaText' => 'Explore About Us'
    ],
    [
        'title' => 'Engineering Services',
        'description' => 'Custom software development, high-scale web platforms, mobile apps, and cloud architectures.',
        'href' => 'services.php',
        'badge' => 'Core Capabilities',
        'icon' => 'code-2',
        'backBadge' => '8 Core Offerings',
        'backTitle' => 'End-to-End Delivery',
        'highlights' => [
            'Full-stack enterprise web platforms & SaaS',
            'iOS & Android native & cross-platform apps',
            'Resilient cloud architecture & serverless APIs',
            'Legacy code modernization & DevOps automation'
        ],
        'ctaText' => 'Explore All Services'
    ],
    [
        'title' => 'Technology Stack',
        'description' => 'Modern, battle-tested frameworks across React, Node, Python, AWS, and native mobile compilation.',
        'href' => 'technologies.php',
        'badge' => 'Stack & Tools',
        'icon' => 'cpu',
        'backBadge' => 'Modern Tooling',
        'backTitle' => 'Battle-Tested Tech',
        'highlights' => [
            'Frontend: Next.js 16, React 19 & TypeScript',
            'Backend: Node.js, Python, Laravel & PHP',
            'Databases: PostgreSQL, MongoDB & MySQL',
            'Cloud & DevOps: AWS, Azure & Docker pipelines'
        ],
        'ctaText' => 'View Full Tech Stack'
    ],
    [
        'title' => 'Featured Projects',
        'description' => 'Case studies of enterprise SaaS applications, web portals, and mobile systems built for scale.',
        'href' => 'projects.php',
        'badge' => 'Client Success',
        'icon' => 'briefcase',
        'backBadge' => 'Verified Case Studies',
        'backTitle' => 'Production Impact',
        'highlights' => [
            'Enterprise FinTech: 99.99% SLA, $42M+ processed',
            'HealthCare EHR: HIPAA-compliant clinical suite',
            'Logistics Fleet Engine: 40k+ live tracking events',
            'Omnichannel E-Commerce: Sub-second page loads'
        ],
        'ctaText' => 'Browse Case Studies'
    ],
    [
        'title' => 'Contact & Consultation',
        'description' => 'Discuss your technical roadmap, get detailed project estimates, and start your engineering partnership.',
        'href' => 'contact.php',
        'badge' => 'Start a Project',
        'icon' => 'mail',
        'backBadge' => 'Direct Engagement',
        'backTitle' => 'Start a Conversation',
        'highlights' => [
            'Direct consultation with senior architects',
            'Guaranteed 1-business-day scope reviews',
            'Transparent agile milestones & fixed quotes',
            'Comprehensive NDA & client IP protection'
        ],
        'ctaText' => 'Schedule Consultation'
    ]
];

require_once __DIR__ . '/includes/header.php';
?>

<!-- 1. HERO SECTION -->
<section id="home" class="relative min-h-[90vh] pt-28 pb-20 md:pt-36 md:pb-28 overflow-hidden flex items-center">
  <!-- Subtle Ambient Corner Blooms -->
  <div class="absolute top-1/4 -left-32 w-[38rem] h-[38rem] bg-[#FF6B00]/6 rounded-full blur-[140px] pointer-events-none"></div>
  <div class="absolute top-1/3 -right-32 w-[42rem] h-[42rem] bg-[#C01858]/5 rounded-full blur-[150px] pointer-events-none"></div>
  <div class="absolute bottom-10 left-1/3 w-[34rem] h-[34rem] bg-[#8B5CF6]/5 rounded-full blur-[140px] pointer-events-none"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
      
      <!-- Left Column: Headline & Action Buttons -->
      <div class="lg:col-span-7 flex flex-col items-start text-left z-10">
        <!-- Badge -->
        <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-[#8B5CF6] text-xs font-semibold tracking-wide mb-6">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>Enterprise IT & Modern Digital Experiences</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[2.35rem] xl:text-[2.9rem] 2xl:text-[3.25rem] font-black tracking-tight text-[#0F172A] leading-[1.16]">
          <span class="block lg:whitespace-nowrap">
            Building Digital Solutions That
          </span>
          <span class="block mt-1 sm:mt-2">
            <span id="hero-rotating-phrase" class="inline-block whitespace-nowrap text-gradient-brand transition-all duration-300">
              Move Businesses Forward.
            </span>
          </span>
        </h1>

        <!-- Description -->
        <p class="mt-6 text-base sm:text-lg text-[#475569] max-w-xl font-normal leading-relaxed">
          We help businesses transform bold ideas into scalable digital products through innovative
          software engineering, modern cloud technologies, and thoughtful design.
        </p>

        <!-- Dual Action Buttons -->
        <div class="mt-8 sm:mt-10 flex flex-wrap items-center gap-4 w-full sm:w-auto">
          <a
            href="services.php"
            class="glass-btn-primary inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-2xl font-semibold text-sm cursor-pointer shadow-lg w-full sm:w-auto"
          >
            <span>Explore Our Services</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </a>

          <a
            href="contact.php"
            class="glass-btn-secondary inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-2xl font-semibold text-sm cursor-pointer w-full sm:w-auto shadow-xs"
          >
            <i data-lucide="sparkles" class="w-4 h-4 text-[#FF6B00]"></i>
            <span>Get In Touch</span>
          </a>
        </div>
      </div>

      <!-- Right Column: Hero Visual with Circular Round Orbiting Tools & Phoenix Bird -->
      <div class="lg:col-span-5 relative flex items-center justify-center lg:justify-end min-h-[380px] sm:min-h-[440px] lg:min-h-[480px] lg:translate-x-2 xl:translate-x-4">
        
        <!-- Shared Single Center Anchor -->
        <div class="relative w-[280px] h-[280px] sm:w-[350px] sm:h-[350px] lg:w-[390px] lg:h-[390px] xl:w-[420px] xl:h-[420px] flex items-center justify-center">
          
          <!-- Ambient warm glowing power core behind visual -->
          <div class="absolute -inset-8 bg-gradient-to-tr from-[#FF6B00]/30 via-[#C01858]/25 to-[#8B5CF6]/20 rounded-full blur-3xl pointer-events-none animate-orbit-core"></div>

          <!-- 1. Pulsing Outer Wave Ring along the Round Path -->
          <div class="absolute inset-0 rounded-full border border-orange-400/30 shadow-[0_0_25px_rgba(255,107,0,0.12)] pointer-events-none animate-pulse-ring"></div>

          <!-- 2. Reverse Rotating Dashed Orbit Track -->
          <div class="absolute inset-0 rounded-full border-2 border-dashed border-orange-400/35 pointer-events-none animate-orbit-dashed"></div>

          <!-- 3. Inner Subtle Concentric Ring -->
          <div class="absolute inset-5 rounded-full border border-slate-300/40 pointer-events-none"></div>

          <!-- 4. Animated Light-Sweep Radar Beam along the Round Track -->
          <div
            class="absolute inset-0 rounded-full pointer-events-none opacity-60 animate-radar-sweep"
            style="background: conic-gradient(from 0deg, transparent 0deg, transparent 270deg, rgba(255, 107, 0, 0.2) 320deg, rgba(244, 63, 94, 0.75) 360deg); border-radius: 50%; -webkit-mask: radial-gradient(farthest-side, transparent calc(100% - 3px), black calc(100% - 2px)); mask: radial-gradient(farthest-side, transparent calc(100% - 3px), black calc(100% - 2px));"
          ></div>

          <!-- 5. Fast Traveling Glowing Comets / Energy Light Pulses on the Round Orbit -->
          <div class="absolute inset-0 rounded-full pointer-events-none animate-comet-orbit">
            <!-- Primary Glowing Energy Comet Head -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
              <div class="w-3.5 h-3.5 rounded-full bg-gradient-to-r from-orange-400 to-rose-500 shadow-[0_0_16px_5px_rgba(255,107,0,0.85)] animate-pulse"></div>
              <div class="absolute w-12 h-1.5 rounded-full bg-gradient-to-l from-orange-500/80 to-transparent blur-[1.5px] -left-10"></div>
            </div>

            <!-- Secondary Complementary Comet Head (180° Opposite) -->
            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 flex items-center justify-center">
              <div class="w-2.5 h-2.5 rounded-full bg-gradient-to-r from-rose-400 to-purple-500 shadow-[0_0_14px_4px_rgba(244,63,94,0.75)] animate-pulse"></div>
              <div class="absolute w-9 h-1 rounded-full bg-gradient-to-l from-purple-500/70 to-transparent blur-[1.5px] -left-7"></div>
            </div>
          </div>

          <!-- 6. Orbiting Rotating Container (Smooth 360° Circular Orbit for Tech Badges) -->
          <div class="orbit-spin-track absolute inset-0 pointer-events-none animate-orbit-spin">
            <?php
            $heroTools = [
              ['name' => 'React', 'icon' => 'ReactLogo'],
              ['name' => 'Next.js', 'icon' => 'NextLogo'],
              ['name' => 'JavaScript', 'icon' => 'JavaScriptLogo'],
              ['name' => 'Node.js', 'icon' => 'NodeLogo'],
              ['name' => 'Python', 'icon' => 'PythonLogo'],
              ['name' => 'AWS Cloud', 'icon' => 'AwsLogo'],
              ['name' => 'Flutter', 'icon' => 'FlutterLogo'],
              ['name' => 'Firebase', 'icon' => 'FirebaseLogo'],
            ];
            foreach ($heroTools as $hIdx => $tool):
              $angle = ($hIdx / count($heroTools)) * (2 * M_PI) - (M_PI / 2);
              $xPercent = 50 + 50 * cos($angle);
              $yPercent = 50 + 50 * sin($angle);
            ?>
              <div
                class="orbit-tech-node absolute pointer-events-auto"
                style="left: <?php echo round($xPercent, 2); ?>%; top: <?php echo round($yPercent, 2); ?>%; transform: translate(-50%, -50%);"
              >
                <!-- Counter-rotate: ensures all tool logos remain upright throughout the circular path -->
                <div class="animate-orbit-counter group relative">
                  <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-white/95 backdrop-blur-md border border-white/90 shadow-[0_6px_18px_rgba(15,23,42,0.1),inset_0_1px_2px_rgba(255,255,255,0.95)] flex items-center justify-center p-2 cursor-pointer hover:border-orange-400/80 hover:shadow-[0_10px_25px_rgba(255,107,0,0.35)] hover:scale-125 transition-all duration-300">
                    <span class="absolute -inset-0.5 rounded-xl sm:rounded-2xl bg-gradient-to-r from-orange-400/20 to-rose-400/20 blur-[3px] opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    <?php echo renderTechLogo($tool['icon'], 'relative z-10 w-5 h-5 sm:w-6 sm:h-6 object-contain'); ?>
                  </div>
                  <!-- Tooltip -->
                  <span class="absolute -bottom-7 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-slate-900/90 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md pointer-events-none whitespace-nowrap shadow-md z-50">
                    <?php echo htmlspecialchars($tool['name']); ?>
                  </span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- 7. Central Stable Hub Visual: Centered Phoenix Bird with Light Falling across Wings & Body -->
          <div class="relative z-10 w-[74%] h-[74%] flex items-center justify-center pointer-events-none">
            <!-- Subtle Warm Ambient Core behind Wings -->
            <div class="absolute w-44 h-44 rounded-full bg-gradient-to-tr from-orange-400/25 via-rose-400/20 to-purple-400/15 blur-2xl pointer-events-none animate-phoenix-core"></div>

            <!-- Faint Phoenix Silhouette Watermark to the left (Matching reference image) -->
            <div class="absolute -left-12 -top-4 w-[92%] h-[92%] pointer-events-none opacity-20 filter blur-[0.5px]">
              <img src="images/phoenix-hero.png" alt="" class="w-full h-full object-contain" style="filter: hue-rotate(270deg) saturate(1.8) opacity(0.35);">
            </div>

            <!-- Floating Phoenix Container (Gentle Wing Hover Levitation) -->
            <div class="relative w-full h-full flex items-center justify-center pointer-events-none animate-float-bob">
              <!-- Phoenix Bird Image -->
              <img
                src="images/phoenix-hero.png"
                alt="ShreeTech Phoenix Bird Icon"
                class="w-full h-full object-contain select-none pointer-events-auto filter drop-shadow-[0_20px_45px_rgba(255,107,0,0.35)] transition-transform duration-300 hover:scale-105"
              >

              <!-- Luminous Light Sweep Layer: Masked strictly to the Bird's Wings and Body -->
              <div
                class="absolute inset-0 pointer-events-none overflow-hidden"
                style="
                  -webkit-mask-image: url(images/phoenix-hero.png);
                  mask-image: url(images/phoenix-hero.png);
                  -webkit-mask-size: contain;
                  mask-size: contain;
                  -webkit-mask-repeat: no-repeat;
                  mask-repeat: no-repeat;
                  -webkit-mask-position: center;
                  mask-position: center;
                "
              >
                <!-- Diagonal cascading light sheen -->
                <div
                  class="absolute inset-0 w-[220%] h-[220%] -top-[60%] -left-[60%] pointer-events-none animate-sheen-diag"
                  style="
                    background: linear-gradient(135deg, transparent 40%, rgba(255, 255, 255, 0.4) 47%, rgba(255, 220, 150, 0.85) 50%, rgba(255, 255, 255, 0.45) 53%, transparent 60%);
                    mix-blend-mode: screen;
                  "
                ></div>

                <!-- Vertical ethereal light cascade -->
                <div
                  class="absolute inset-0 pointer-events-none animate-sheen-vert"
                  style="
                    background: linear-gradient(180deg, transparent 0%, rgba(255, 230, 160, 0.4) 40%, rgba(255, 180, 70, 0.6) 50%, transparent 70%);
                    mix-blend-mode: screen;
                  "
                ></div>
              </div>

              <!-- Delicate Glowing Light Feathers / Embers falling down across the Bird's Wings & Body -->
              <div class="absolute inset-0 pointer-events-none overflow-hidden">
                <?php
                $feathers = [
                  ['x' => '32%', 'delay' => '0s', 'duration' => '4.2s', 'width' => 8, 'height' => 16, 'rot' => -15],
                  ['x' => '46%', 'delay' => '1.4s', 'duration' => '4.6s', 'width' => 10, 'height' => 20, 'rot' => 20],
                  ['x' => '60%', 'delay' => '2.6s', 'duration' => '3.8s', 'width' => 7, 'height' => 14, 'rot' => -25],
                  ['x' => '24%', 'delay' => '2.0s', 'duration' => '4.8s', 'width' => 9, 'height' => 18, 'rot' => 15],
                  ['x' => '68%', 'delay' => '0.8s', 'duration' => '4.4s', 'width' => 8, 'height' => 16, 'rot' => -10],
                  ['x' => '52%', 'delay' => '3.3s', 'duration' => '4.0s', 'width' => 9, 'height' => 18, 'rot' => 25],
                ];
                foreach ($feathers as $fIdx => $f):
                ?>
                  <div
                    class="absolute flex items-center justify-center filter drop-shadow-[0_0_6px_rgba(255,180,60,0.75)] animate-falling-feather"
                    style="
                      left: <?php echo $f['x']; ?>;
                      top: 4%;
                      width: <?php echo $f['width']; ?>px;
                      height: <?php echo $f['height']; ?>px;
                      --init-rot: <?php echo $f['rot']; ?>deg;
                      --f-dur: <?php echo $f['duration']; ?>;
                      --f-del: <?php echo $f['delay']; ?>;
                    "
                  >
                    <svg viewBox="0 0 14 26" class="w-full h-full" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M7 0C11.5 5.5 13.5 13.5 11 20C9.5 24 7 26 7 26C7 26 4.5 24 3 20C0.5 13.5 2.5 5.5 7 0Z"
                        fill="url(#featherGlow-<?php echo $fIdx; ?>)"
                        opacity="0.9"
                      />
                      <defs>
                        <linearGradient id="featherGlow-<?php echo $fIdx; ?>" x1="7" y1="0" x2="7" y2="26" gradientUnits="userSpaceOnUse">
                          <stop stop-color="#FFF4C2" />
                          <stop offset="0.45" stop-color="#FF9838" />
                          <stop offset="1" stop-color="#E02E68" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2. ORANGE-TINT SECTION: MULTI-PAGE NAVIGATION DIRECTORY -->
<section id="about" class="relative py-20 sm:py-28 bg-[#FFF4EA]/15 backdrop-blur-xs overflow-hidden border-y border-[#F1E6EE] scroll-mt-20">
  <!-- Subtle Ambient Corner Blooms -->
  <div class="absolute top-1/4 -right-32 w-[36rem] h-[36rem] bg-[#FF6B00]/5 rounded-full blur-[140px] pointer-events-none"></div>
  <div class="absolute bottom-10 -left-32 w-[34rem] h-[34rem] bg-[#C01858]/4 rounded-full blur-[140px] pointer-events-none"></div>
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header -->
    <div class="max-w-3xl mb-12">
      <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-3">
        <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
        <span>Explore Shree Tech</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading">
        Engineering Digital Excellence Across Every Dimension
      </h2>
      <p class="mt-4 text-base sm:text-lg text-[#475569] font-normal leading-relaxed font-body">
        Browse our dedicated sections to learn about our engineering team, explore our services,
        review our battle-tested tech stack, and see our work.
      </p>
    </div>

    <!-- 3D Flip Directory Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($directorySections as $secIdx => $sec): 
        $cardTargetId = str_replace('.php', '', $sec['href']);
      ?>
        <div id="<?php echo $cardTargetId; ?>" class="flip-card-wrapper h-[340px] sm:h-[350px] w-full select-none group cursor-pointer reveal-init reveal-up stagger-<?php echo ($secIdx + 1); ?> scroll-mt-28">
          <div class="flip-card-inner">
            
            <!-- FRONT FACE -->
            <div class="flip-card-front glass-card p-6 sm:p-7 rounded-3xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors duration-500">
              <div class="card-spotlight-layer"></div>
              <div>
                <div class="flex items-center justify-between mb-4">
                  <div class="w-12 h-12 rounded-2xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] group-hover:bg-[#FF6B00] group-hover:text-white transition-all duration-300 shadow-xs">
                    <i data-lucide="<?php echo htmlspecialchars($sec['icon']); ?>" class="w-6 h-6"></i>
                  </div>
                  <span class="text-[11px] font-semibold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-3 py-1 rounded-full font-body uppercase tracking-wider">
                    <?php echo htmlspecialchars($sec['badge']); ?>
                  </span>
                </div>

                <h3 class="text-lg sm:text-xl font-bold text-[#0F172A] mb-2 font-heading group-hover:text-[#C01858] transition-colors duration-300">
                  <?php echo htmlspecialchars($sec['title']); ?>
                </h3>
                <p class="text-xs sm:text-sm text-[#475569] font-normal leading-relaxed font-body">
                  <?php echo htmlspecialchars($sec['description']); ?>
                </p>
              </div>

              <div class="pt-4 border-t border-[#F1E6EE] flex items-center justify-between">
                <span class="text-xs font-semibold text-[#475569] group-hover:text-[#C01858] transition-colors font-body flex items-center gap-1.5">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                  <span>Hover to Flip</span>
                </span>
                <div class="w-8 h-8 rounded-full bg-white border border-[#F1E6EE] group-hover:border-[#C01858] group-hover:bg-[#C01858] text-[#475569] group-hover:text-white flex items-center justify-center transition-all duration-300 shadow-xs">
                  <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform duration-300"></i>
                </div>
              </div>
            </div>

            <!-- BACK FACE -->
            <div class="flip-card-back glass-card p-6 sm:p-7 rounded-3xl flex flex-col justify-between border-2 border-[#C01858] bg-white shadow-lg">
              <div class="relative z-10">
                <div class="flex items-center justify-between mb-3.5">
                  <span class="text-[11px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-3 py-0.5 rounded-full font-body uppercase tracking-wider">
                    <?php echo htmlspecialchars($sec['backBadge']); ?>
                  </span>
                  <span class="text-[11px] font-semibold text-[#475569] font-body flex items-center gap-1">
                    <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00]"></i>
                    Verified
                  </span>
                </div>

                <h4 class="text-base font-bold text-[#0F172A] font-heading mb-3">
                  <?php echo htmlspecialchars($sec['backTitle']); ?>
                </h4>

                <div class="space-y-2">
                  <?php foreach ($sec['highlights'] as $item): ?>
                    <div class="flex items-start gap-2.5 text-xs text-[#475569] font-medium font-body leading-snug">
                      <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                      <span><?php echo htmlspecialchars($item); ?></span>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="relative z-10 pt-4 border-t border-[#F1E6EE]">
                <a
                  href="<?php echo htmlspecialchars($sec['href']); ?>"
                  class="glass-btn-primary w-full py-2.5 px-4 rounded-2xl text-white font-semibold text-xs sm:text-sm font-body flex items-center justify-center gap-2 cursor-pointer shadow-md"
                >
                  <span><?php echo htmlspecialchars($sec['ctaText']); ?></span>
                  <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Trust Highlights Banner -->
    <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-6 pt-10 border-t border-[#F1E6EE]">
      <div class="flex items-center gap-3.5 bg-white p-4 rounded-2xl border border-[#F1E6EE] shadow-xs">
        <div class="w-10 h-10 rounded-xl bg-[#FFF4EA] text-[#FF6B00] border border-[#FF6B00]/20 flex items-center justify-center shrink-0">
          <i data-lucide="shield-check" class="w-5 h-5"></i>
        </div>
        <div>
          <div class="text-sm font-bold text-[#0F172A] font-heading">Enterprise Security</div>
          <div class="text-xs text-[#475569] font-body">ISO & GDPR compliant practices</div>
        </div>
      </div>

      <div class="flex items-center gap-3.5 bg-white p-4 rounded-2xl border border-[#F1E6EE] shadow-xs">
        <div class="w-10 h-10 rounded-xl bg-[#FFF0F5] text-[#C01858] border border-[#C01858]/20 flex items-center justify-center shrink-0">
          <i data-lucide="zap" class="w-5 h-5"></i>
        </div>
        <div>
          <div class="text-sm font-bold text-[#0F172A] font-heading">High-Speed Execution</div>
          <div class="text-xs text-[#475569] font-body">Agile two-week sprint delivery</div>
        </div>
      </div>

      <div class="flex items-center gap-3.5 bg-white p-4 rounded-2xl border border-[#F1E6EE] shadow-xs">
        <div class="w-10 h-10 rounded-xl bg-[#F5F0FF] text-[#8B5CF6] border border-[#8B5CF6]/20 flex items-center justify-center shrink-0">
          <i data-lucide="globe" class="w-5 h-5"></i>
        </div>
        <div>
          <div class="text-sm font-bold text-[#0F172A] font-heading">Global Collaboration</div>
          <div class="text-xs text-[#475569] font-body">Seamless remote engineering teams</div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
