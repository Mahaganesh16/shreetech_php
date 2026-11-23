<?php
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Shree Tech | Software Engineering & Cloud Solutions';
$pageDescription = 'Building Digital Solutions That Move Businesses Forward. Enterprise software engineering, modern web platforms, mobile apps, and cloud architectures.';
$currentPage = 'home';

// Contact Form Processing for Single-Page Submissions
$formSubmitted = false;
$formErrors = [];
$formData = [
    'name' => '',
    'email' => '',
    'phone' => '',
    'service' => 'Website Development',
    'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData['name'] = trim($_POST['name'] ?? '');
    $formData['email'] = trim($_POST['email'] ?? '');
    $formData['phone'] = trim($_POST['phone'] ?? '');
    $formData['service'] = trim($_POST['service'] ?? 'Website Development');
    $formData['message'] = trim($_POST['message'] ?? '');

    if (empty($formData['name']) || strlen($formData['name']) < 2) {
        $formErrors['name'] = 'Name must be at least 2 characters';
    }
    if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $formErrors['email'] = 'Please provide a valid business email';
    }
    if (empty($formData['phone']) || strlen($formData['phone']) < 7) {
        $formErrors['phone'] = 'Please enter a valid phone number';
    }
    if (empty($formData['message']) || strlen($formData['message']) < 15) {
        $formErrors['message'] = 'Please provide at least 15 characters of detail';
    }

    if (empty($formErrors)) {
        $formSubmitted = true;
    }
}

// Setup data for Technologies section
$techCategories = ['All', 'Frontend', 'Backend', 'Database', 'Mobile', 'Cloud'];
$techCategoryLabels = [
    'All'      => 'All Disciplines',
    'Frontend' => 'Frontend (HTML5, CSS3, JS)',
    'Backend'  => 'Backend (PHP, Node, Python)',
    'Database' => 'Database (MySQL, Mongo)',
    'Mobile'   => 'Mobile (Flutter, Swift)',
    'Cloud'    => 'Cloud (AWS, Azure, Docker)',
];

// All Disciplines: Upper Stream (Frontend & Backend Core Languages)
$allUpStream = [
    ['name' => 'HTML5', 'description' => 'Semantic, accessible markup standards', 'iconComponent' => 'HtmlLogo', 'category' => 'Frontend', 'tag' => 'Frontend Language'],
    ['name' => 'JavaScript', 'description' => 'ESNext interactive web scripting', 'iconComponent' => 'JavaScriptLogo', 'category' => 'Frontend', 'tag' => 'Frontend Language'],
    ['name' => 'Next.js', 'description' => 'Server-side rendering & App Router', 'iconComponent' => 'NextLogo', 'category' => 'Frontend', 'tag' => 'Frontend Framework'],
    ['name' => 'Python', 'description' => 'Data processing, APIs, and AI automation', 'iconComponent' => 'PythonLogo', 'category' => 'Backend', 'tag' => 'Backend Language'],
    ['name' => 'PHP', 'description' => 'Battle-tested server-side web scripting', 'iconComponent' => 'PhpLogo', 'category' => 'Backend', 'tag' => 'Backend Language'],
    ['name' => 'Java', 'description' => 'Enterprise-grade robust application platform', 'iconComponent' => 'JavaLogo', 'category' => 'Backend', 'tag' => 'Backend Language'],
    ['name' => 'Flutter', 'description' => 'Google native multi-platform compilation', 'iconComponent' => 'FlutterLogo', 'category' => 'Mobile', 'tag' => 'Mobile Framework'],
    ['name' => 'AWS', 'description' => 'Global cloud infrastructure & services', 'iconComponent' => 'AwsLogo', 'category' => 'Cloud', 'tag' => 'Cloud Platform'],
    ['name' => 'Docker', 'description' => 'Industry-standard container virtualization', 'iconComponent' => 'DockerLogo', 'category' => 'Cloud', 'tag' => 'Cloud Container'],
];

// All Disciplines: Lower Stream (Styling, UI Frameworks & Databases)
$allDownStream = [
    ['name' => 'CSS3', 'description' => 'Responsive design & modern layouts', 'iconComponent' => 'CssLogo', 'category' => 'Frontend', 'tag' => 'Frontend Styling'],
    ['name' => 'React.js', 'description' => 'Declarative component-driven interfaces', 'iconComponent' => 'ReactLogo', 'category' => 'Frontend', 'tag' => 'Frontend Framework'],
    ['name' => 'Laravel', 'description' => 'Full-featured enterprise PHP web framework', 'iconComponent' => 'LaravelLogo', 'category' => 'Backend', 'tag' => 'Backend Framework'],
    ['name' => 'Node.js', 'description' => 'Event-driven asynchronous backend services', 'iconComponent' => 'NodeLogo', 'category' => 'Backend', 'tag' => 'Backend Runtime'],
    ['name' => 'MySQL', 'description' => 'High-reliability transactional relational DB', 'iconComponent' => 'MySqlLogo', 'category' => 'Database', 'tag' => 'Relational Database'],
    ['name' => 'PostgreSQL', 'description' => 'Advanced open-source relational database', 'iconComponent' => 'PostgresLogo', 'category' => 'Database', 'tag' => 'Relational Database'],
    ['name' => 'MongoDB', 'description' => 'Document-based flexible NoSQL database', 'iconComponent' => 'MongoLogo', 'category' => 'Database', 'tag' => 'NoSQL Database'],
    ['name' => 'Redis', 'description' => 'In-memory high-speed caching & key-value store', 'iconComponent' => 'RedisLogo', 'category' => 'Database', 'tag' => 'Cache Database'],
    ['name' => 'Swift', 'description' => 'High-performance, type-safe iOS architecture', 'iconComponent' => 'SwiftLogo', 'category' => 'Mobile', 'tag' => 'Mobile Language'],
    ['name' => 'Kubernetes', 'description' => 'Automated container orchestration & scaling', 'iconComponent' => 'K8sLogo', 'category' => 'Cloud', 'tag' => 'Cloud Orchestration'],
];

$allTechnologies = array_merge($allUpStream, $allDownStream);

$categoryDurations = [
    'All'      => '50s',
    'Frontend' => '30s',
    'Backend'  => '32s',
    'Database' => '35s',
    'Mobile'   => '28s',
    'Cloud'    => '34s',
];

// Testimonials data set for seamless loop
$marqueeTestimonials = array_merge($testimonialsData, $testimonialsData);

require_once __DIR__ . '/includes/header.php';
?>

<!-- =========================================================================
     1. HERO SECTION (#home)
     ========================================================================= -->
<section id="home" class="relative pt-20 pb-10 sm:pt-28 sm:pb-14 md:pt-32 md:pb-16 overflow-hidden flex items-center scroll-mt-24">
  <!-- Subtle Ambient Corner Blooms -->
  <div class="absolute top-1/4 -left-32 w-[38rem] h-[38rem] bg-[#FF6B00]/6 rounded-full blur-[140px] pointer-events-none"></div>
  <div class="absolute top-1/3 -right-32 w-[42rem] h-[42rem] bg-[#C01858]/5 rounded-full blur-[150px] pointer-events-none"></div>
  <div class="absolute bottom-10 left-1/3 w-[34rem] h-[34rem] bg-[#8B5CF6]/5 rounded-full blur-[140px] pointer-events-none"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-10 lg:gap-8 items-center">
      
      <!-- Left Column: Headline & Action Buttons -->
      <div class="lg:col-span-7 flex flex-col items-start text-left z-10">
        <!-- Badge -->
        <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-[#8B5CF6] text-xs font-semibold tracking-wide mb-4 sm:mb-6">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>Enterprise IT & Modern Digital Experiences</span>
        </div>

        <!-- Headline -->
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-[2.35rem] xl:text-[2.9rem] 2xl:text-[3.25rem] font-black tracking-tight text-[#0F172A] leading-[1.16]">
          <span class="block lg:whitespace-nowrap">
            Shreetech Web Development 
          </span>
          <span class="block mt-1 sm:mt-2">
            <span id="hero-rotating-phrase" class="inline-block whitespace-nowrap text-gradient-brand transition-all duration-300">
              Service and Solutions
            </span>
          </span>
        </h1>

        <!-- Description -->
        <p class="mt-4 sm:mt-6 text-sm sm:text-base md:text-lg text-[#475569] max-w-xl font-normal leading-relaxed">
          ShreeTech is an emerging internship training startup lead by highly experienced professionals who unfold various industry chapters and worked with reputable organizations.
        </p>

        <!-- Dual Action Buttons -->
        <div class="mt-6 sm:mt-10 flex flex-wrap items-center gap-3.5 sm:gap-4 w-full sm:w-auto">
          <a
            href="#contact"
            class="glass-btn-primary inline-flex items-center justify-center gap-2.5 px-6 py-3 sm:px-7 sm:py-3.5 rounded-2xl font-semibold text-sm cursor-pointer shadow-lg w-full sm:w-auto"
          >
            <span>Get a Free Consultation!</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
          </a>

          <a
            href="#about"
            class="glass-btn-secondary inline-flex items-center justify-center gap-2 px-6 py-3 sm:px-7 sm:py-3.5 rounded-2xl font-semibold text-sm cursor-pointer w-full sm:w-auto shadow-xs"
          >
            <i data-lucide="sparkles" class="w-4 h-4 text-[#FF6B00]"></i>
            <span>Know More</span>
          </a>
        </div>
      </div>

      <!-- Right Column: Hero Visual with Circular Round Orbiting Tools & Phoenix Bird -->
      <div class="lg:col-span-5 relative flex items-center justify-center lg:justify-end min-h-[300px] sm:min-h-[400px] lg:min-h-[480px] lg:translate-x-2 xl:translate-x-4">
        
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
            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
              <div class="w-3.5 h-3.5 rounded-full bg-gradient-to-r from-orange-400 to-rose-500 shadow-[0_0_16px_5px_rgba(255,107,0,0.85)] animate-pulse"></div>
              <div class="absolute w-12 h-1.5 rounded-full bg-gradient-to-l from-orange-500/80 to-transparent blur-[1.5px] -left-10"></div>
            </div>

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
                <div class="animate-orbit-counter group relative">
                  <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-white/95 backdrop-blur-md border border-white/90 shadow-[0_6px_18px_rgba(15,23,42,0.1),inset_0_1px_2px_rgba(255,255,255,0.95)] flex items-center justify-center p-2 cursor-pointer hover:border-orange-400/80 hover:shadow-[0_10px_25px_rgba(255,107,0,0.35)] hover:scale-125 transition-all duration-300">
                    <span class="absolute -inset-0.5 rounded-xl sm:rounded-2xl bg-gradient-to-r from-orange-400/20 to-rose-400/20 blur-[3px] opacity-0 group-hover:opacity-100 transition-opacity"></span>
                    <?php echo renderTechLogo($tool['icon'], 'relative z-10 w-5 h-5 sm:w-6 sm:h-6 object-contain'); ?>
                  </div>
                  <span class="absolute -bottom-7 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-slate-900/90 text-white text-[10px] font-semibold px-2 py-0.5 rounded-md pointer-events-none whitespace-nowrap shadow-md z-50">
                    <?php echo htmlspecialchars($tool['name']); ?>
                  </span>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- 7. Central Stable Hub Visual: Centered Phoenix Bird with Light Sheen -->
          <div class="relative z-10 w-[74%] h-[74%] flex items-center justify-center pointer-events-none">
            <div class="absolute w-44 h-44 rounded-full bg-gradient-to-tr from-orange-400/25 via-rose-400/20 to-purple-400/15 blur-2xl pointer-events-none animate-phoenix-core"></div>

            <div class="absolute -left-12 -top-4 w-[92%] h-[92%] pointer-events-none opacity-20 filter blur-[0.5px]">
              <img src="images/phoenix-hero.png" alt="" class="w-full h-full object-contain" style="filter: hue-rotate(270deg) saturate(1.8) opacity(0.35);">
            </div>

            <div class="relative w-full h-full flex items-center justify-center pointer-events-none animate-float-bob">
              <img
                src="images/phoenix-hero.png"
                alt="ShreeTech Phoenix Bird Icon"
                class="w-full h-full object-contain select-none pointer-events-auto filter drop-shadow-[0_20px_45px_rgba(255,107,0,0.35)] transition-transform duration-300 hover:scale-105"
              >

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
                <div
                  class="absolute inset-0 w-[220%] h-[220%] -top-[60%] -left-[60%] pointer-events-none animate-sheen-diag"
                  style="
                    background: linear-gradient(135deg, transparent 40%, rgba(255, 255, 255, 0.4) 47%, rgba(255, 220, 150, 0.85) 50%, rgba(255, 255, 255, 0.45) 53%, transparent 60%);
                    mix-blend-mode: screen;
                  "
                ></div>

                <div
                  class="absolute inset-0 pointer-events-none animate-sheen-vert"
                  style="
                    background: linear-gradient(180deg, transparent 0%, rgba(255, 230, 160, 0.4) 40%, rgba(255, 180, 70, 0.6) 50%, transparent 70%);
                    mix-blend-mode: screen;
                  "
                ></div>
              </div>

              <!-- Delicate Glowing Light Feathers falling down across the Bird -->
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

<!-- =========================================================================
     2. ABOUT SHREE TECH SECTION (#about)
     ========================================================================= -->
<section id="about" class="relative pt-8 pb-14 sm:pt-12 sm:pb-20 md:pb-28 bg-transparent overflow-hidden scroll-mt-24">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-12 lg:gap-16 items-center">
      
      <!-- Left Column: Story & Deliverables -->
      <div class="lg:col-span-6 space-y-4 sm:space-y-6">
        <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6]">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>About Shree Tech</span>
        </div>

        <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight leading-tight font-heading">
          SHREETECH Innovations And Web Development In Madurai
        </h2>

        <p class="text-base text-[#334155] leading-relaxed font-medium font-body">
          <strong class="font-bold text-[#0F172A]">SHREETECH</strong> We would be happy to collaborate with you to present you to the information technology solutions we have to offer. Shreetech Hub, which was founded in 2015, is a pioneer in offering IT infrastructure and solutions across a range of platforms. Since their inception, businesses have been using Shreetech. Shreetech believes in going above and beyond the duty of a simple solution provider to its clientele by fusing intuition and rigour with practical business acumen. Shreetech gives consumers access to technology through the delivery of simple solutions that increase productivity.
        </p>

        <p class="text-base text-[#334155] leading-relaxed font-medium font-body">
          We are a skilled team of professionals, having more than 15 years of experience in Web and Mobile Application Development. We have 40+ employees with Business Analyst, Designer, Developers & DevOps team and are ready to take up new projects any time and we assure we meet the right deadlines with high quality.
        </p>

        <!-- Core Achievements -->
        <div class="glass-card p-6 rounded-3xl space-y-4 border border-[#F1E6EE]">
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
              <span class="text-[15px] sm:text-base text-[#0F172A] font-semibold font-body leading-snug"><?php echo htmlspecialchars($ach); ?></span>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="pt-2">
          <a
            href="#services"
            class="inline-flex items-center gap-2 text-base font-bold text-[#FF6B00] hover:text-[#C01858] transition-colors group cursor-pointer font-body"
          >
            <span>Read More About Our Engineering Practices</span>
            <i data-lucide="arrow-right" class="w-4.5 h-4.5 group-hover:translate-x-1 transition-transform"></i>
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
              ['value' => 100, 'suffix' => '+', 'label' => 'Delivered Projects', 'sublabel' => 'Web, mobile & cloud SaaS', 'detail' => 'Delivered across 12 countries for FinTech, MedTech, and high-growth enterprise SaaS.'],
              ['value' => 99, 'suffix' => '%', 'label' => 'Client Retention', 'sublabel' => 'Long-term technology partners', 'detail' => 'Sustained multi-year engineering partnerships with predictable ongoing delivery SLAs.'],
              ['value' => 10, 'suffix' => '+', 'label' => 'Years Experience', 'sublabel' => 'Established engineering record', 'detail' => 'A decade of architecting distributed systems, cloud migrations, and product launches.'],
              ['value' => 45, 'suffix' => '+', 'label' => 'Senior Engineers', 'sublabel' => 'Specialized across full stack', 'detail' => 'Elite technical directors and full-stack devs specialized in React, Node, Python & Cloud.']
          ];
          foreach ($stats as $sIdx => $st): ?>
            <div class="flip-card-wrapper h-44 sm:h-48 w-full select-none group cursor-pointer reveal-init reveal-up stagger-<?php echo ($sIdx + 1); ?>">
              <div class="flip-card-inner">
                <!-- Front -->
                <div class="flip-card-front glass-card p-5 sm:p-6 rounded-2xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                  <div class="card-spotlight-layer"></div>
                  <div>
                    <div class="text-3xl sm:text-4xl font-extrabold text-[#0F172A] tracking-tight font-stat group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-[#FF6B00] group-hover:to-[#C01858] transition-all duration-300">
                      <span class="stat-counter-number" data-target="<?php echo $st['value']; ?>">0</span><?php echo $st['suffix']; ?>
                    </div>
                    <div class="text-base font-bold text-[#0F172A] mt-1.5 leading-snug"><?php echo htmlspecialchars($st['label']); ?></div>
                    <div class="text-sm font-medium text-[#475569] mt-1 leading-snug"><?php echo htmlspecialchars($st['sublabel']); ?></div>
                  </div>
                  <div class="flex items-center justify-between text-xs font-semibold text-[#475569] group-hover:text-[#C01858] transition-colors pt-2.5 border-t border-[#F1E6EE]">
                    <span>Flip for detail</span>
                    <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                  </div>
                </div>

                <!-- Back -->
                <div class="flip-card-back glass-card p-5 sm:p-6 rounded-2xl flex flex-col justify-between border-2 border-[#C01858] shadow-md">
                  <div>
                    <div class="flex items-center justify-between mb-1.5">
                      <span class="text-xs font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2.5 py-0.5 rounded-full uppercase tracking-wider font-body">
                        Verified Metric
                      </span>
                      <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#8B5CF6]"></i>
                    </div>
                    <div class="text-base font-bold text-[#0F172A] font-heading mt-1.5 leading-snug"><?php echo htmlspecialchars($st['label']); ?></div>
                    <p class="text-sm font-medium text-[#334155] leading-relaxed mt-2 font-body">
                      <?php echo htmlspecialchars($st['detail']); ?>
                    </p>
                  </div>
                  <div class="flex items-center gap-1.5 text-xs font-semibold text-[#FF6B00] pt-2 border-t border-[#F1E6EE]">
                    <i data-lucide="check-circle-2" class="w-4 h-4 shrink-0"></i>
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

<!-- =========================================================================
     4. WHY CHOOSE US SECTION (#why-us)
     ========================================================================= -->
<section id="why-us" class="relative py-14 sm:py-20 md:py-28 bg-[#FFF0F5]/25 backdrop-blur-xs overflow-hidden border-y border-[#F1E6EE] scroll-mt-24">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mb-8 sm:mb-12">
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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">
      <?php foreach ($whyChooseUsData as $idx => $item): ?>
        <div class="flip-card-wrapper h-[340px] sm:h-[370px] md:h-[400px] w-full select-none group cursor-pointer reveal-init reveal-up stagger-<?php echo ($idx + 1); ?>">
          <div class="flip-card-inner">
            <!-- Front -->
            <div class="flip-card-front glass-card p-5 sm:p-7 md:p-8 rounded-2xl sm:rounded-3xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors duration-500">
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

                <h3 class="text-base sm:text-lg font-bold text-[#0F172A] mb-2.5 group-hover:text-[#C01858] transition-colors duration-300 font-heading">
                  <?php echo htmlspecialchars($item['title']); ?>
                </h3>
                <p class="text-sm text-[#475569] leading-relaxed font-medium font-body">
                  <?php echo htmlspecialchars($item['description']); ?>
                </p>
              </div>

              <div class="pt-4 border-t border-[#F1E6EE] flex items-center justify-between">
                <div class="flex items-center gap-1.5 text-xs font-semibold text-[#64748B] group-hover:text-[#C01858] transition-colors">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] transition-transform duration-500 group-hover:rotate-180"></i>
                  <span>Hover to Flip</span>
                </div>
                <span class="text-xs font-bold font-stat text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] to-[#C01858] tracking-tight">
                  <?php echo htmlspecialchars($item['metric']); ?>
                </span>
              </div>
            </div>

            <!-- Back -->
            <div class="flip-card-back glass-card p-6 sm:p-8 rounded-3xl flex flex-col justify-between border-2 border-[#C01858] shadow-lg">
              <div class="relative z-10">
                <div class="flex items-center justify-between mb-3.5">
                  <span class="text-xs font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-3 py-0.5 rounded-full font-body uppercase tracking-wider">
                    Engineering Standard
                  </span>
                  <span class="text-xs font-semibold text-[#475569] font-body flex items-center gap-1">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
                    Guaranteed
                  </span>
                </div>

                <h4 class="text-base sm:text-lg font-bold text-[#0F172A] font-heading mb-3">
                  <?php echo htmlspecialchars($item['title']); ?>
                </h4>

                <div class="space-y-2.5">
                  <?php foreach ($item['guarantees'] as $g): ?>
                    <div class="flex items-start gap-2.5 text-sm text-[#334155] font-medium font-body leading-relaxed">
                      <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                      <span><?php echo htmlspecialchars($g); ?></span>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="relative z-10 pt-4 border-t border-[#F1E6EE]">
                <a
                  href="#contact"
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

<!-- =========================================================================
     5. ENGINEERING SERVICES SECTION (#services)
     ========================================================================= -->
<section id="services" class="relative py-14 sm:py-20 md:py-28 bg-transparent overflow-hidden scroll-mt-24">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header -->
    <div class="max-w-3xl mb-8 sm:mb-12">
      <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-3">
        <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
        <span>Our Services</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading">
        Comprehensive Software Engineering & Technical Consulting
      </h2>
      <p class="mt-4 text-base sm:text-lg text-[#334155] font-normal leading-relaxed font-body">
        We provide end-to-end technology services tailored to modern enterprise requirements. Explore
        our eight core service disciplines through interactive 3D orbital navigation.
      </p>
    </div>

    <!-- 1. INTERACTIVE 3D ORBIT VIEW (DOMINIK KOCH ARCHITECTURE) -->
    <div id="services-orbit-wrapper" class="relative w-full py-4 select-none">
      <!-- Ambient Orbit Light Glows -->
      <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[680px] h-[340px] bg-gradient-to-tr from-[#FF6B00]/10 via-[#C01858]/8 to-[#8B5CF6]/10 rounded-full blur-3xl pointer-events-none"></div>

      <!-- Orbit Container -->
      <div
        id="services-orbit-container"
        class="orbit-container"
        data-draggable=""
        data-intro=""
      >
        <!-- Horizontal Smooth Elliptical Orbit Line (Light Pink) -->
        <svg
          class="orbit-path-svg"
          data-orbit-svg=""
          preserveAspectRatio="none"
          aria-hidden="true"
        >
          <path
            data-orbit-path=""
            data-orbit-stroke=""
            class="orbit-path-line"
          />
        </svg>

        <!-- 8 Smooth Animated Service Cards (Exchange Size & Position Along Orbit) -->
        <?php foreach ($servicesData as $idx => $service): 
          $svcJson = json_encode([
            'id' => $service['id'],
            'title' => $service['title'],
            'description' => $service['description'],
            'iconName' => $service['iconName'],
            'deliverables' => $service['deliverables']
          ]);
        ?>
          <div
            class="orbit-item group<?php echo $idx === 0 ? ' is-active' : ''; ?>"
            data-orbit-item="<?php echo $idx; ?>"
            data-service-index="<?php echo $idx; ?>"
            data-clickable=""
            data-service-json="<?php echo htmlspecialchars($svcJson, ENT_QUOTES, 'UTF-8'); ?>"
          >
            <div class="orbit-item-inner">
              <div class="orbit-service-card group-hover:border-[#C01858]">
                
                <!-- Ambient Glows (Smoothly visible when active featured card) -->
                <div class="card-ambient-glows pointer-events-none">
                  <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#FF6B00]/15 rounded-full blur-xl"></div>
                  <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-[#C01858]/15 rounded-full blur-xl"></div>
                </div>

                <!-- 1. COMPACT PREVIEW (Visible on Inactive Small Cards) -->
                <div class="card-compact-view">
                  <!-- Top Row: Icon + Service Number Badge -->
                  <div class="flex items-center justify-between w-full mb-0.5">
                    <div class="w-7 h-7 rounded-lg bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] group-hover:bg-[#FF6B00] group-hover:text-white transition-all duration-300 shadow-xs shrink-0">
                      <i data-lucide="<?php echo htmlspecialchars($service['iconName']); ?>" class="w-3.5 h-3.5"></i>
                    </div>
                    <span class="text-[11px] font-bold font-stat text-[#FF6B00] bg-[#FFF4EA] border border-[#FF6B00]/25 px-2 py-0.5 rounded-full shadow-2xs">
                      0<?php echo $idx + 1; ?>
                    </span>
                  </div>

                  <!-- Middle: Title + 2-Line Description Snippet -->
                  <div class="w-full min-w-0 my-0.5">
                    <h4 class="text-[12.5px] font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors truncate font-heading leading-tight mb-0.5">
                      <?php echo htmlspecialchars($service['title']); ?>
                    </h4>
                    <p class="text-[10.5px] text-[#475569] leading-tight line-clamp-2 font-normal font-body">
                      <?php echo htmlspecialchars($service['description']); ?>
                    </p>
                  </div>

                  <!-- Bottom Row: Click to Focus Indicator -->
                  <div class="flex items-center justify-between pt-1 border-t border-[#F1E6EE]/80 text-[10px] font-semibold text-[#8B5CF6] group-hover:text-[#C01858] transition-colors">
                    <span class="inline-flex items-center gap-1">
                      <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00]"></i>
                      <span>Click to Focus</span>
                    </span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform"></i>
                  </div>
                </div>

                <!-- 2. FULL DETAILS (Visible on Large Featured Active Card) -->
                <div class="card-full-view">
                  <!-- Top Section: Large Icon + Badge + Title + Description -->
                  <div class="flex flex-col items-center w-full">
                    <div class="w-13 h-13 rounded-2xl bg-gradient-to-tr from-[#FFF4EA] to-white border border-[#FF6B00]/30 flex items-center justify-center text-[#FF6B00] shadow-md mb-2 shrink-0">
                      <i data-lucide="<?php echo htmlspecialchars($service['iconName']); ?>" class="w-6.5 h-6.5"></i>
                    </div>
                    <span class="glass-pill px-3.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wider text-[#8B5CF6] mb-1.5 shadow-xs shrink-0">
                      Service 0<?php echo $idx + 1; ?>
                    </span>
                    <h3 class="text-xl sm:text-2xl font-black text-[#0F172A] font-heading tracking-tight mb-1.5 leading-tight">
                      <?php echo htmlspecialchars($service['title']); ?>
                    </h3>
                    <p class="text-xs sm:text-[13px] text-[#475569] font-normal leading-relaxed mb-3 max-w-sm line-clamp-2 sm:line-clamp-3">
                      <?php echo htmlspecialchars($service['description']); ?>
                    </p>
                  </div>

                  <!-- Middle Section: 3 Deliverables Checklist Tags -->
                  <div class="flex flex-wrap items-center justify-center gap-1.5 mb-3 max-w-sm">
                    <?php foreach (array_slice($service['deliverables'], 0, 3) as $deliverable): ?>
                      <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-semibold text-[#1E293B] bg-white border border-[#F1E6EE] shadow-xs">
                        <i data-lucide="check-circle-2" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
                        <span><?php echo htmlspecialchars($deliverable); ?></span>
                      </span>
                    <?php endforeach; ?>
                  </div>

                  <!-- Bottom Section: CTA Button + Prev/Next Orbit Steppers -->
                  <div class="flex items-center gap-2.5 w-full justify-center shrink-0 pt-1">
                    <a
                      href="#contact"
                      class="glass-btn-primary px-5 py-2.5 rounded-xl text-white font-semibold text-xs sm:text-sm flex items-center gap-2 shadow-md hover:scale-102 transition-transform"
                    >
                      <span>Discuss Requirement</span>
                      <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <button
                      type="button"
                      class="orbit-prev-btn p-2.5 rounded-xl glass-btn-secondary text-[#0F172A] hover:text-[#C01858] transition-colors cursor-pointer shadow-xs"
                      title="Previous Service"
                    >
                      <i data-lucide="chevron-left" class="w-4 h-4"></i>
                    </button>
                    <button
                      type="button"
                      class="orbit-next-btn p-2.5 rounded-xl glass-btn-secondary text-[#0F172A] hover:text-[#C01858] transition-colors cursor-pointer shadow-xs"
                      title="Next Service"
                    >
                      <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </button>
                  </div>
                </div>

              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Drag & Interaction Hint -->
      <div class="flex items-center justify-center gap-2 mt-4 text-xs text-[#475569] font-medium font-body">
        <i data-lucide="move-horizontal" class="w-3.5 h-3.5 text-[#FF6B00] animate-pulse"></i>
        <span>Drag horizontally to rotate orbit &bull; Click any card to focus</span>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     4. CORE TECHNOLOGY STACK SECTION (#technologies)
     ========================================================================= -->
<section id="technologies" class="relative py-14 sm:py-20 md:py-28 bg-[#FFF4EA]/15 backdrop-blur-xs overflow-hidden border-y border-[#F1E6EE] scroll-mt-24">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Section Header -->
    <div class="max-w-3xl mb-8 sm:mb-12">
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
    <div class="flex flex-wrap items-center gap-2 pb-6 border-b border-[#F1E6EE]">
      <?php foreach ($techCategories as $cat): 
        $label = $techCategoryLabels[$cat] ?? $cat;
      ?>
        <button
          type="button"
          data-category="<?php echo htmlspecialchars($cat); ?>"
          class="tech-filter-btn px-4 py-2 text-xs sm:text-sm font-semibold rounded-2xl transition-all cursor-pointer font-body <?php echo ($cat === 'All') ? 'glass-btn-primary shadow-sm text-white' : 'glass-btn-secondary text-[#475569] hover:text-[#C01858] hover:border-[#C01858]'; ?>"
        >
          <?php echo htmlspecialchars($label); ?>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Technology Showcase Stage (Right-to-Left Diagonal Stream) -->
    <div class="mt-8">
      
      <!-- Active Category Header & Description -->
      <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-1 pb-3 border-b border-[#F1E6EE] mb-6">
        <div>
          <span class="inline-flex items-center gap-1.5 text-xs font-bold text-[#FF6B00] uppercase tracking-wider mb-1 font-body">
            <i data-lucide="layers" class="w-3.5 h-3.5"></i>
            <span id="active-category-badge">Multi-Discipline Engineering</span>
          </span>
          <h3 id="active-category-title" class="text-xl sm:text-2xl font-black text-[#0F172A] font-heading">
            All Technology Disciplines
          </h3>
        </div>
        <span id="active-category-desc" class="text-xs sm:text-sm text-[#475569] font-normal font-body max-w-xl">
          Comprehensive enterprise ecosystem featuring frontend languages, backend runtimes, databases, mobile frameworks, and cloud engineering.
        </span>
      </div>

      <!-- 1. Master Diagonal Right-to-Left Rows for "All" -->
      <div class="tech-category-group" data-category="All">
        <div class="tech-diagonal-stage relative w-full overflow-hidden">
          
          <!-- Subtle Narrow Edge Fades (Keep 90% Stage Crystal Clear) -->
          <div class="tech-fade-left pointer-events-none absolute inset-y-0 left-0 w-8 sm:w-14 bg-gradient-to-r from-[#F8FAFC]/90 to-transparent z-20"></div>
          <div class="tech-fade-right pointer-events-none absolute inset-y-0 right-0 w-8 sm:w-14 bg-gradient-to-l from-[#F8FAFC]/90 to-transparent z-20"></div>

          <!-- Subtle Ambient Blooms -->
          <div class="absolute -top-16 -left-16 w-56 h-56 bg-[#FF6B00]/10 rounded-full blur-3xl pointer-events-none"></div>
          <div class="absolute -bottom-16 -right-16 w-56 h-56 bg-[#C01858]/10 rounded-full blur-3xl pointer-events-none"></div>

          <!-- Tilted Dual-Row Diagonal Matrix (Right-to-Left Scrolling) -->
          <div class="tech-diagonal-matrix">
            
            <!-- Row 1: Core Languages Stream -->
            <div class="tech-diagonal-row row-up" style="--row-duration: 36s;">
              <div class="tech-row-track">
                
                <!-- Sequence Group 1 -->
                <div class="tech-row-group" aria-hidden="false">
                  <div class="tech-row-lane-pill pill-up">
                    <i data-lucide="code-2" class="w-3.5 h-3.5"></i>
                    <span>Frontend & Backend Languages</span>
                  </div>
                  <?php foreach ($allUpStream as $tech): 
                    renderShowcaseCard($tech, $tech['category']);
                  endforeach; ?>
                </div>

                <!-- Sequence Group 2 (Duplicate for Seamless Infinite Loop) -->
                <div class="tech-row-group" aria-hidden="true">
                  <div class="tech-row-lane-pill pill-up">
                    <i data-lucide="code-2" class="w-3.5 h-3.5"></i>
                    <span>Frontend & Backend Languages</span>
                  </div>
                  <?php foreach ($allUpStream as $tech): 
                    renderShowcaseCard($tech, $tech['category']);
                  endforeach; ?>
                </div>

              </div>
            </div>

            <!-- Row 2: Styling, Frameworks & Databases Stream -->
            <div class="tech-diagonal-row row-down" style="--row-duration: 40s;">
              <div class="tech-row-track">
                
                <!-- Sequence Group 1 -->
                <div class="tech-row-group" aria-hidden="false">
                  <div class="tech-row-lane-pill pill-down">
                    <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                    <span>Styling, Frameworks & Databases</span>
                  </div>
                  <?php foreach ($allDownStream as $tech): 
                    renderShowcaseCard($tech, $tech['category']);
                  endforeach; ?>
                </div>

                <!-- Sequence Group 2 (Duplicate for Seamless Infinite Loop) -->
                <div class="tech-row-group" aria-hidden="true">
                  <div class="tech-row-lane-pill pill-down">
                    <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                    <span>Styling, Frameworks & Databases</span>
                  </div>
                  <?php foreach ($allDownStream as $tech): 
                    renderShowcaseCard($tech, $tech['category']);
                  endforeach; ?>
                </div>

              </div>
            </div>

          </div>

        </div>
      </div>

      <!-- 2. Category-Specific Diagonal Views (Right-to-Left Rows: Up & Down) -->
      <?php foreach ($technologyGroups as $group): 
        $catName = $group['category'];
        $groupItems = $group['items'];
        
        // Split items cleanly between Row 1 (Core Languages) and Row 2 (Frameworks/Styling)
        if ($catName === 'Frontend') {
          $upItems = [
            ['name' => 'HTML5', 'description' => 'Semantic, accessible markup standards', 'iconComponent' => 'HtmlLogo', 'tag' => 'Frontend Language'],
            ['name' => 'JavaScript', 'description' => 'ESNext interactive web scripting', 'iconComponent' => 'JavaScriptLogo', 'tag' => 'Frontend Language'],
            ['name' => 'Next.js', 'description' => 'Server-side rendering & App Router', 'iconComponent' => 'NextLogo', 'tag' => 'Frontend Framework'],
          ];
          $downItems = [
            ['name' => 'CSS3', 'description' => 'Responsive design & modern layouts', 'iconComponent' => 'CssLogo', 'tag' => 'Frontend Styling'],
            ['name' => 'React.js', 'description' => 'Declarative component-driven interfaces', 'iconComponent' => 'ReactLogo', 'tag' => 'UI Framework'],
            ['name' => 'CSS3', 'description' => 'CSS Flexbox, Grid & Modern Animation', 'iconComponent' => 'CssLogo', 'tag' => 'Responsive CSS'],
          ];
          $upPillText = 'Frontend Core Languages';
          $downPillText = 'UI Frameworks & Styling';
        } else {
          $half = (int)ceil(count($groupItems) / 2);
          $upItems = array_slice($groupItems, 0, $half);
          $downItems = array_slice($groupItems, $half);
          if (empty($downItems)) $downItems = $upItems;
          $upPillText = $group['uniqueHeading'] . ' · Core';
          $downPillText = $group['uniqueHeading'] . ' · Ecosystem';
        }
        
        // Ensure enough items for seamless infinite horizontal loop
        $upSeq = array_merge($upItems, $upItems, $upItems);
        $downSeq = array_merge($downItems, $downItems, $downItems);
      ?>
        <div class="tech-category-group hidden" data-category="<?php echo htmlspecialchars($catName); ?>">
          <div class="tech-diagonal-stage relative w-full overflow-hidden">
            
            <!-- Subtle Narrow Edge Fades (Keep 90% Stage Crystal Clear) -->
            <div class="tech-fade-left pointer-events-none absolute inset-y-0 left-0 w-8 sm:w-14 bg-gradient-to-r from-[#F8FAFC]/90 to-transparent z-20"></div>
            <div class="tech-fade-right pointer-events-none absolute inset-y-0 right-0 w-8 sm:w-14 bg-gradient-to-l from-[#F8FAFC]/90 to-transparent z-20"></div>

            <div class="tech-diagonal-matrix">
              
              <!-- Upper Stream: Core Languages -->
              <div class="tech-diagonal-row row-up" style="--row-duration: 28s;">
                <div class="tech-row-track">
                  
                  <div class="tech-row-group" aria-hidden="false">
                    <div class="tech-row-lane-pill pill-up">
                      <i data-lucide="code-2" class="w-3.5 h-3.5"></i>
                      <span><?php echo htmlspecialchars($upPillText); ?></span>
                    </div>
                    <?php foreach ($upSeq as $tech): 
                      renderShowcaseCard($tech, $catName);
                    endforeach; ?>
                  </div>

                  <div class="tech-row-group" aria-hidden="true">
                    <div class="tech-row-lane-pill pill-up">
                      <i data-lucide="code-2" class="w-3.5 h-3.5"></i>
                      <span><?php echo htmlspecialchars($upPillText); ?></span>
                    </div>
                    <?php foreach ($upSeq as $tech): 
                      renderShowcaseCard($tech, $catName);
                    endforeach; ?>
                  </div>

                </div>
              </div>

              <!-- Lower Stream: Styling & Frameworks -->
              <div class="tech-diagonal-row row-down" style="--row-duration: 32s;">
                <div class="tech-row-track">
                  
                  <div class="tech-row-group" aria-hidden="false">
                    <div class="tech-row-lane-pill pill-down">
                      <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                      <span><?php echo htmlspecialchars($downPillText); ?></span>
                    </div>
                    <?php foreach ($downSeq as $tech): 
                      renderShowcaseCard($tech, $catName);
                    endforeach; ?>
                  </div>

                  <div class="tech-row-group" aria-hidden="true">
                    <div class="tech-row-lane-pill pill-down">
                      <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                      <span><?php echo htmlspecialchars($downPillText); ?></span>
                    </div>
                    <?php foreach ($downSeq as $tech): 
                      renderShowcaseCard($tech, $catName);
                    endforeach; ?>
                  </div>

                </div>
              </div>

            </div>

          </div>
        </div>
      <?php endforeach; ?>

      <!-- Helpful Interaction Hint at Bottom -->
      <div class="mt-4 flex items-center justify-center gap-2 text-xs text-[#64748B] font-medium select-none">
        <i data-lucide="mouse-pointer" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
        <span>Hover over any column or card to pause animation & flip card for details</span>
      </div>

    </div>
  </div>
</section>

<!-- =========================================================================
     7. FEATURED PROJECTS SECTION (#projects) - 3D STACKING CARD DECK
     ========================================================================= -->
<section id="projects" class="relative w-full bg-[#FFF0F5]/25 border-y border-[#F1E6EE] select-none scroll-mt-24">
  
  <!-- SCROLL-CONTROLLED PINNED STACKING TRACK -->
  <div id="projects-pin-track" class="relative w-full">
    
    <!-- STICKY VIEWPORT STAGE (PERFECT FULL-VIEW ALIGNMENT: ZERO CLIPPING & SAFE NAVBAR CLEARANCE) -->
    <div id="projects-pin-stage" class="sticky top-0 w-full min-h-screen flex flex-col justify-start items-center overflow-hidden pt-20 sm:pt-28 pb-8 px-4 sm:px-6 lg:px-8">
      
      <!-- Section Header (Cleanly Spaced Below Floating Navbar) -->
      <div class="w-full max-w-3xl mx-auto flex flex-col items-center text-center mb-2 sm:mb-2.5 shrink-0">
        <div class="glass-pill inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-1 shadow-xs">
          <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
          <span>Selected Case Studies</span>
        </div>
        <h2 class="text-xl sm:text-2xl md:text-3xl font-black text-[#0F172A] tracking-tight font-heading mb-1.5">
          Featured Client Deployments
        </h2>

        <!-- Category Filter Pills -->
        <div class="flex flex-wrap items-center justify-center gap-1 sm:gap-1.5">
          <button
            type="button"
            data-category="all"
            class="project-filter-btn px-3 py-0.5 sm:py-1 text-xs font-semibold rounded-xl transition-all cursor-pointer glass-btn-primary shadow-xs text-white"
          >
            All Projects
          </button>
          <button
            type="button"
            data-category="web"
            class="project-filter-btn px-3 py-0.5 sm:py-1 text-xs font-semibold rounded-xl transition-all cursor-pointer glass-btn-secondary text-[#475569] hover:text-[#C01858] hover:border-[#C01858]"
          >
            Web Applications
          </button>
          <button
            type="button"
            data-category="enterprise"
            class="project-filter-btn px-3 py-0.5 sm:py-1 text-xs font-semibold rounded-xl transition-all cursor-pointer glass-btn-secondary text-[#475569] hover:text-[#C01858] hover:border-[#C01858]"
          >
            Enterprise SaaS
          </button>
          <button
            type="button"
            data-category="mobile"
            class="project-filter-btn px-3 py-0.5 sm:py-1 text-xs font-semibold rounded-xl transition-all cursor-pointer glass-btn-secondary text-[#475569] hover:text-[#C01858] hover:border-[#C01858]"
          >
            Mobile Apps
          </button>
          <button
            type="button"
            data-category="cloud"
            class="project-filter-btn px-3 py-0.5 sm:py-1 text-xs font-semibold rounded-xl transition-all cursor-pointer glass-btn-secondary text-[#475569] hover:text-[#C01858] hover:border-[#C01858]"
          >
            Cloud Infrastructure
          </button>
        </div>
      </div>

      <!-- STACKING CARDS DECK (BALANCED MEDIUM CARD PRESENTATION ACCORDING TO TEMPLATE) -->
      <div class="stacking-deck-container relative w-full max-w-2xl sm:max-w-3xl lg:max-w-4xl mx-auto flex flex-col justify-start items-center">
        <div class="stacking-cards-deck relative w-full h-[380px] sm:h-[410px] md:h-[430px] lg:h-[450px]">
          <?php 
          $iconMap = [
              'apex-finance' => 'trending-up',
              'health-cloud' => 'activity',
              'fleet-mobile' => 'truck',
              'luxury-commerce' => 'shopping-bag',
              'cloud-security' => 'shield-check',
              'ai-intelligence' => 'cpu',
              'web' => 'globe',
              'enterprise' => 'cpu',
              'mobile' => 'truck',
              'cloud' => 'shield-check',
          ];
          foreach ($projectsData as $idx => $project): 
              $icon = $iconMap[$project['id']] ?? $iconMap[$project['category']] ?? 'sparkles';
              $cardNumber = str_pad($idx + 1, 2, '0', STR_PAD_LEFT);
          ?>
            <!-- Dynamic Project Stacking Card ($idx: <?php echo $idx; ?>) -->
            <article
              class="stacking-card-item project-card-item"
              data-card-index="<?php echo $idx; ?>"
              data-category="<?php echo htmlspecialchars($project['category']); ?>"
              style="--stack-idx: <?php echo $idx; ?>;"
            >
              <!-- Card Outer Shell: White card with 1.5px subtle border & shadow -->
              <div class="stacking-card-box">
                
                <!-- TOP HEADER BAR (Folder Tab / Ticket Header from Reference Video in White) -->
                <div class="stacking-card-header px-4 sm:px-6 lg:px-8 flex items-center justify-between select-none">
                  <!-- Left Decorative Rivet Dot & Index -->
                  <div class="flex items-center gap-2 sm:gap-3">
                    <span class="card-rivet" aria-hidden="true"></span>
                    <span class="font-stat text-[11px] sm:text-xs font-black tracking-widest uppercase text-[#C01858]">
                      // <?php echo $cardNumber; ?>
                    </span>
                  </div>

                  <!-- Center: Project Title / Main Headline in Bold Uppercase -->
                  <div class="font-heading font-black text-xs sm:text-sm md:text-base tracking-wider uppercase truncate px-3 text-[#0F172A] text-center flex-1">
                    <span><?php echo htmlspecialchars($project['title']); ?></span>
                  </div>

                  <!-- Right Decorative Rivet Dot & Year Tag -->
                  <div class="flex items-center gap-2 sm:gap-3">
                    <span class="text-[10px] sm:text-xs font-bold tracking-wider font-heading text-[#334155] hidden sm:inline">
                      <?php echo htmlspecialchars($project['year']); ?>
                    </span>
                    <span class="card-rivet" aria-hidden="true"></span>
                  </div>
                </div>

                <!-- WHITE CARD BODY (#FFFFFF) CLEAN CONTEMPORARY THEME - FULL-WIDTH SHOWCASE IMAGE -->
                <div class="stacking-card-body p-3 sm:p-4 text-[#0F172A] bg-white">
                  <?php
                    $imgFit = $project['imageFit'] ?? 'cover';
                    $imgBgStyle = isset($project['imageBg']) ? 'style="background-color: ' . htmlspecialchars($project['imageBg']) . ';"' : '';
                  ?>
                  <div
                    class="open-project-modal relative w-full h-[280px] sm:h-[310px] md:h-[330px] lg:h-[350px] group overflow-hidden rounded-2xl border border-[#F1E6EE] bg-slate-50 flex items-center justify-center shadow-md cursor-pointer select-none"
                    <?php echo $imgBgStyle; ?>
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
                      class="w-full h-full <?php echo ($imgFit === 'contain') ? 'object-contain object-center' : 'object-cover object-top'; ?> transition-transform duration-500 group-hover:scale-102"
                      loading="lazy"
                    >
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
  </div>
</section>

<!-- =========================================================================
     8. CLIENT TESTIMONIALS SECTION (#testimonials)
     ========================================================================= -->
<section id="testimonials" class="relative py-14 sm:py-20 md:py-28 bg-[#F5F0FF]/25 backdrop-blur-xs overflow-hidden border-y border-[#F1E6EE] scroll-mt-24">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-12">
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

    <!-- Testimonials Scrollable Row -->
    <div class="relative w-full overflow-hidden py-4">
      <div class="pointer-events-none absolute left-0 inset-y-0 w-16 sm:w-28 bg-gradient-to-r from-[#F5F0FF] via-[#F5F0FF]/85 to-transparent z-20"></div>
      <div class="pointer-events-none absolute right-0 inset-y-0 w-16 sm:w-28 bg-gradient-to-l from-[#F5F0FF] via-[#F5F0FF]/85 to-transparent z-20"></div>

      <div
        id="testimonials-track"
        class="flex w-full overflow-x-auto no-scrollbar gap-5 sm:gap-7 select-none scroll-smooth py-2 px-4"
      >
        <?php foreach ($marqueeTestimonials as $t): ?>
          <div class="w-[360px] sm:w-[440px] h-[270px] sm:h-[280px] shrink-0 flip-card-wrapper group cursor-pointer select-none">
            <div class="flip-card-inner">
              
              <!-- Front -->
              <div class="flip-card-front glass-card p-5 sm:p-6 rounded-3xl flex flex-col justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                <div>
                  <div class="flex items-center justify-between mb-3">
                    <i data-lucide="quote" class="w-8 h-8 text-[#FF6B00]/25 group-hover:text-[#FF6B00]/40 transition-all duration-300"></i>
                    <div class="flex items-center gap-1">
                      <?php for ($r = 0; $r < $t['rating']; $r++): ?>
                        <i data-lucide="star" class="w-3.5 h-3.5 fill-[#FF6B00] text-[#FF6B00]"></i>
                      <?php endfor; ?>
                    </div>
                  </div>

                  <p class="text-xs sm:text-sm text-[#1E293B] font-medium font-body leading-relaxed line-clamp-4">
                    &ldquo;<?php echo htmlspecialchars($t['content']); ?>&rdquo;
                  </p>
                </div>

                <div class="pt-3.5 border-t border-[#F1E6EE] flex items-center justify-between">
                  <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl p-[2px] bg-gradient-to-tr from-[#FF6B00] via-[#C01858] to-[#8B5CF6] shadow-xs shrink-0">
                      <img src="<?php echo htmlspecialchars($t['imageUrl']); ?>" alt="<?php echo htmlspecialchars($t['name']); ?>" class="w-full h-full rounded-[10px] object-cover">
                    </div>
                    <div class="min-w-0">
                      <div class="text-xs font-bold text-[#0F172A] font-heading truncate"><?php echo htmlspecialchars($t['name']); ?></div>
                      <div class="text-[11px] text-[#334155] font-medium font-body truncate">
                        <?php echo htmlspecialchars($t['designation']); ?>, <span class="text-[#FF6B00] font-semibold"><?php echo htmlspecialchars($t['company']); ?></span>
                      </div>
                    </div>
                  </div>

                  <div class="flex items-center gap-1 text-[11px] font-semibold text-[#334155] group-hover:text-[#C01858] transition-colors shrink-0 pl-2">
                    <i data-lucide="rotate-cw" class="w-3 h-3 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                    <span>Flip</span>
                  </div>
                </div>
              </div>

              <!-- Back -->
              <div class="flip-card-back glass-card p-4 sm:p-5 rounded-3xl flex flex-col justify-between border-2 border-[#C01858] shadow-lg">
                <div class="relative z-10">
                  <div class="flex items-center justify-between mb-2">
                    <span class="text-[10px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2.5 py-0.5 rounded-full uppercase tracking-wider font-body">
                      Verified Client Review
                    </span>
                    <div class="flex items-center gap-1 text-[11px] font-semibold text-[#334155] font-body">
                      <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00]"></i>
                      5.0 Rating
                    </div>
                  </div>

                  <h4 class="text-sm font-bold text-[#0F172A] font-heading mb-0.5">
                    <?php echo htmlspecialchars($t['company']); ?>
                  </h4>
                  <div class="text-[11px] text-[#334155] font-medium font-body mb-2">
                    Client Contact: <?php echo htmlspecialchars($t['name']); ?> (<?php echo htmlspecialchars($t['designation']); ?>)
                  </div>

                  <div class="space-y-1.5">
                    <div class="flex items-start gap-2 text-xs text-[#1E293B] font-medium font-body leading-snug">
                      <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                      <span><strong>Scope:</strong> <?php echo htmlspecialchars($t['scope']); ?></span>
                    </div>
                    <div class="flex items-start gap-2 text-xs text-[#1E293B] font-medium font-body leading-snug">
                      <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                      <span><strong>Tech:</strong> <?php echo htmlspecialchars($t['stack']); ?></span>
                    </div>
                    <div class="flex items-start gap-2 text-xs text-[#1E293B] font-medium font-body leading-snug">
                      <i data-lucide="check-circle-2" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
                      <span><strong>Outcome:</strong> <?php echo htmlspecialchars($t['outcome']); ?></span>
                    </div>
                  </div>
                </div>

                <div class="relative z-10 pt-2.5 border-t border-[#F1E6EE]">
                  <a
                    href="#contact"
                    class="glass-btn-primary w-full py-1.5 px-4 rounded-xl text-white font-semibold text-xs font-body flex items-center justify-center gap-1.5 shadow-md"
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

<!-- =========================================================================
     9. CONTACT & CONSULTATION SECTION (#contact)
     ========================================================================= -->
<section id="contact" class="relative py-14 sm:py-20 md:py-28 bg-transparent overflow-hidden scroll-mt-24">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 sm:gap-12 lg:gap-16 items-start">
      
      <!-- Left Side: Contact Channels (5 Cols) -->
      <div class="lg:col-span-5 space-y-6 sm:space-y-8 reveal-init reveal-left">
        <div>
          <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider text-[#8B5CF6] mb-3">
            <i data-lucide="sparkles" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
            <span>Start a Conversation</span>
          </div>
          <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight leading-tight font-heading">
            Let&apos;s Discuss Your Project
          </h2>
          <p class="mt-4 text-base text-[#475569] font-normal leading-relaxed font-body">
            Whether you are modernizing a legacy software platform, launching a new digital product,
            or scaling your engineering squad, our senior architects are ready to assist.
          </p>
        </div>

        <!-- Direct Channels in 3D Flip Cards -->
        <div class="space-y-4">
          
          <!-- Email Flip Card -->
          <div class="flip-card-wrapper h-24 sm:h-28 w-full select-none group cursor-pointer">
            <div class="flip-card-inner">
              <div class="flip-card-front glass-card p-4 rounded-3xl flex items-center justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                <div class="flex items-center gap-4 min-w-0">
                  <div class="w-12 h-12 rounded-2xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] group-hover:bg-[#FF6B00] group-hover:text-white group-hover:scale-105 transition-all duration-300 shrink-0 shadow-xs">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                  </div>
                  <div class="min-w-0">
                    <div class="text-xs text-[#64748B] font-medium font-body">Direct Inquiries</div>
                    <div class="text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors font-heading truncate">
                      contact@shreetech.com
                    </div>
                  </div>
                </div>
                <div class="flex flex-col items-end gap-1 shrink-0 pl-2">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                  <span class="text-[10px] text-[#334155] font-body">Flip</span>
                </div>
              </div>

              <div class="flip-card-back glass-card p-4 rounded-3xl flex items-center justify-between border-2 border-[#C01858] shadow-md">
                <div class="min-w-0 flex-1 pr-3">
                  <div class="flex items-center gap-1.5 mb-1">
                    <span class="text-[10px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2 py-0.5 rounded-full uppercase tracking-wider font-body">
                      Priority Email
                    </span>
                    <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00] shrink-0"></i>
                  </div>
                  <div class="text-xs text-[#1E293B] font-medium font-body truncate">
                    Average response: &lt; 2 business hours
                  </div>
                </div>
                <a
                  href="mailto:contact@shreetech.com"
                  class="glass-btn-primary px-3.5 py-2 rounded-xl text-white font-semibold text-xs flex items-center gap-1 shrink-0 shadow-xs hover:scale-105 transition-transform font-body"
                >
                  <span>Email Us</span>
                  <i data-lucide="arrow-right" class="w-3 h-3"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Phone Flip Card -->
          <div class="flip-card-wrapper h-24 sm:h-28 w-full select-none group cursor-pointer">
            <div class="flip-card-inner">
              <div class="flip-card-front glass-card p-4 rounded-3xl flex items-center justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                <div class="flex items-center gap-4 min-w-0">
                  <div class="w-12 h-12 rounded-2xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] group-hover:bg-[#FF6B00] group-hover:text-white group-hover:scale-105 transition-all duration-300 shrink-0 shadow-xs">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                  </div>
                  <div class="min-w-0">
                    <div class="text-xs text-[#64748B] font-medium font-body">Direct Hotline</div>
                    <div class="text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors font-heading truncate">
                      +1 (800) 840-2030
                    </div>
                  </div>
                </div>
                <div class="flex flex-col items-end gap-1 shrink-0 pl-2">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                  <span class="text-[10px] text-[#334155] font-body">Flip</span>
                </div>
              </div>

              <div class="flip-card-back glass-card p-4 rounded-3xl flex items-center justify-between border-2 border-[#C01858] shadow-md">
                <div class="min-w-0 flex-1 pr-3">
                  <div class="flex items-center gap-1.5 mb-1">
                    <span class="text-[10px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2 py-0.5 rounded-full uppercase tracking-wider font-body">
                      Live Dispatch
                    </span>
                    <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00] shrink-0"></i>
                  </div>
                  <div class="text-xs text-[#1E293B] font-medium font-body truncate">
                    Available Mon–Fri, 8am–7pm EST
                  </div>
                </div>
                <a
                  href="tel:+18008402030"
                  class="glass-btn-primary px-3.5 py-2 rounded-xl text-white font-semibold text-xs flex items-center gap-1 shrink-0 shadow-xs hover:scale-105 transition-transform font-body"
                >
                  <span>Call Now</span>
                  <i data-lucide="phone" class="w-3 h-3"></i>
                </a>
              </div>
            </div>
          </div>

          <!-- Headquarters Flip Card -->
          <div class="flip-card-wrapper h-24 sm:h-28 w-full select-none group cursor-pointer">
            <div class="flip-card-inner">
              <div class="flip-card-front glass-card p-4 rounded-3xl flex items-center justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                <div class="flex items-center gap-4 min-w-0">
                  <div class="w-12 h-12 rounded-2xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] group-hover:bg-[#FF6B00] group-hover:text-white group-hover:scale-105 transition-all duration-300 shrink-0 shadow-xs">
                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                  </div>
                  <div class="min-w-0">
                    <div class="text-xs text-[#64748B] font-medium font-body">Headquarters</div>
                    <div class="text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors font-heading truncate">
                      500 Howard St, San Francisco
                    </div>
                  </div>
                </div>
                <div class="flex flex-col items-end gap-1 shrink-0 pl-2">
                  <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                  <span class="text-[10px] text-[#334155] font-body">Flip</span>
                </div>
              </div>

              <div class="flip-card-back glass-card p-4 rounded-3xl flex items-center justify-between border-2 border-[#C01858] shadow-md">
                <div class="min-w-0 flex-1 pr-3">
                  <div class="flex items-center gap-1.5 mb-1">
                    <span class="text-[10px] font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] px-2 py-0.5 rounded-full uppercase tracking-wider font-body">
                      Bay Area HQ
                    </span>
                    <i data-lucide="sparkles" class="w-3 h-3 text-[#FF6B00] shrink-0"></i>
                  </div>
                  <div class="text-xs text-[#1E293B] font-medium font-body truncate">
                    Suite 400, SF Financial District
                  </div>
                </div>
                <a
                  href="https://maps.google.com/?q=500+Howard+Street+San+Francisco+CA+94105"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="glass-btn-primary px-3.5 py-2 rounded-xl text-white font-semibold text-xs flex items-center gap-1 shrink-0 shadow-xs hover:scale-105 transition-transform font-body"
                >
                  <span>View Map</span>
                  <i data-lucide="arrow-right" class="w-3 h-3"></i>
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Social Channels -->
        <div class="pt-2">
          <div class="text-xs text-[#475569] font-medium mb-3">Direct Channels</div>
          <div class="flex items-center gap-3">
            <a
              href="https://github.com"
              target="_blank"
              rel="noopener noreferrer"
              class="glass-btn-secondary w-10 h-10 rounded-2xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs transition-colors"
              aria-label="GitHub"
            >
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
              </svg>
            </a>
            <a
              href="https://linkedin.com"
              target="_blank"
              rel="noopener noreferrer"
              class="glass-btn-secondary w-10 h-10 rounded-2xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs transition-colors"
              aria-label="LinkedIn"
            >
              <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 8.76a1.65 1.65 0 1 0-.02-3.3 1.65 1.65 0 0 0 .02 3.3m1.4 9.74v-8.37H5.06v8.37h2.8z"/>
              </svg>
            </a>
            <a
              href="https://x.com"
              target="_blank"
              rel="noopener noreferrer"
              class="glass-btn-secondary w-10 h-10 rounded-2xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs transition-colors"
              aria-label="Twitter / X"
            >
              <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- Right Side: Contact Form (7 Cols) -->
      <div class="lg:col-span-7 reveal-init reveal-right">
        <div class="p-8 sm:p-10 rounded-3xl glass-card contact-form-card border border-white/80 shadow-2xl relative overflow-hidden">
          
          <?php if ($formSubmitted): ?>
            <div id="contact-success" class="py-12 text-center space-y-4">
              <div class="w-16 h-16 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 mx-auto shadow-xs">
                <i data-lucide="check-circle-2" class="w-8 h-8"></i>
              </div>
              <h3 class="text-2xl font-black text-[#0F172A] font-heading">Inquiry Transmitted</h3>
              <p class="text-sm text-[#475569] max-w-md mx-auto leading-relaxed font-normal font-body">
                We have received your project inquiry. A senior technical director will review your
                scope and respond within one business day.
              </p>
              <a
                href="#contact"
                class="glass-btn-secondary mt-4 inline-block px-6 py-2.5 rounded-2xl text-xs font-semibold text-[#0F172A] cursor-pointer"
              >
                Submit Another Inquiry
              </a>
            </div>
          <?php else: ?>
            <form id="contact-form" method="POST" action="#contact" class="space-y-6" data-ajax="false">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                
                <!-- Full Name -->
                <div>
                  <label class="block text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-2 font-heading">
                    Full Name <span class="text-[#FF6B00]">*</span>
                  </label>
                  <input
                    type="text"
                    name="name"
                    required
                    value="<?php echo htmlspecialchars($formData['name']); ?>"
                    placeholder="Elena Vance"
                    class="w-full px-4 py-3 rounded-2xl glass-input text-sm text-[#0F172A]"
                  >
                  <?php if (isset($formErrors['name'])): ?>
                    <div class="flex items-center gap-1 text-xs text-[#C01858] mt-1.5 font-medium">
                      <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                      <span><?php echo htmlspecialchars($formErrors['name']); ?></span>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Business Email -->
                <div>
                  <label class="block text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-2 font-heading">
                    Business Email <span class="text-[#FF6B00]">*</span>
                  </label>
                  <input
                    type="email"
                    name="email"
                    required
                    value="<?php echo htmlspecialchars($formData['email']); ?>"
                    placeholder="elena@company.com"
                    class="w-full px-4 py-3 rounded-2xl glass-input text-sm text-[#0F172A]"
                  >
                  <?php if (isset($formErrors['email'])): ?>
                    <div class="flex items-center gap-1 text-xs text-[#C01858] mt-1.5 font-medium">
                      <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                      <span><?php echo htmlspecialchars($formErrors['email']); ?></span>
                    </div>
                  <?php endif; ?>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Phone Number -->
                <div>
                  <label class="block text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-2 font-heading">
                    Phone Number <span class="text-[#FF6B00]">*</span>
                  </label>
                  <input
                    type="tel"
                    name="phone"
                    required
                    value="<?php echo htmlspecialchars($formData['phone']); ?>"
                    placeholder="+1 (555) 000-0000"
                    class="w-full px-4 py-3 rounded-2xl glass-input text-sm font-stat text-[#0F172A]"
                  >
                  <?php if (isset($formErrors['phone'])): ?>
                    <div class="flex items-center gap-1 text-xs text-[#C01858] mt-1.5 font-medium">
                      <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                      <span><?php echo htmlspecialchars($formErrors['phone']); ?></span>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Service Selection -->
                <div>
                  <label class="block text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-2 font-heading">
                    Service Offering
                  </label>
                  <select
                    name="service"
                    class="w-full px-4 py-3 rounded-2xl glass-input text-sm text-[#0F172A] cursor-pointer"
                  >
                    <?php
                    $servicesList = [
                        'Website Development',
                        'Mobile Application Development',
                        'Custom Software Development',
                        'UI/UX Design',
                        'E-Commerce Development',
                        'Cloud & DevOps',
                        'Digital Transformation',
                        'AI & Automation'
                    ];
                    foreach ($servicesList as $srv): ?>
                      <option value="<?php echo htmlspecialchars($srv); ?>" <?php echo ($formData['service'] === $srv) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($srv); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <!-- Message -->
              <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-2 font-heading">
                  Project Description <span class="text-[#FF6B00]">*</span>
                </label>
                <textarea
                  name="message"
                  rows="4"
                  required
                  placeholder="Please share details about your requirements, timeline, or architecture challenges..."
                  class="w-full px-4 py-3 rounded-2xl glass-input text-sm resize-none text-[#0F172A]"
                ><?php echo htmlspecialchars($formData['message']); ?></textarea>
                <?php if (isset($formErrors['message'])): ?>
                  <div class="flex items-center gap-1 text-xs text-[#C01858] mt-1.5 font-medium">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    <span><?php echo htmlspecialchars($formErrors['message']); ?></span>
                  </div>
                <?php endif; ?>
              </div>

              <!-- Submit Button -->
              <button
                type="submit"
                class="glass-btn-primary w-full py-4 rounded-2xl font-bold text-sm flex items-center justify-center gap-2 cursor-pointer shadow-md text-white"
              >
                <span>Submit Project Inquiry</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
              </button>

              <div class="flex items-center justify-center gap-1.5 text-center text-xs text-[#475569] font-medium font-body">
                <i data-lucide="shield-check" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
                <span>Protected under Non-Disclosure Agreement (NDA)</span>
              </div>
            </form>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     10. CASE STUDY DETAIL MODAL (FOR PROJECT CARDS)
     ========================================================================= -->
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
      <span id="modal-client" class="text-xs text-[#334155] font-semibold"></span>
    </div>

    <h3 id="modal-title" class="text-2xl font-black text-[#0F172A] mb-2 font-heading"></h3>
    <p id="modal-summary" class="text-sm text-[#334155] leading-relaxed font-normal font-body"></p>

    <div class="mt-6 p-4 rounded-2xl bg-white border border-[#F1E6EE] shadow-xs flex items-center justify-between">
      <div>
        <div class="text-xs text-[#64748B] font-medium">Primary Impact Metric</div>
        <div id="modal-metric-val" class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#FF6B00] to-[#C01858] font-stat tracking-tight mt-0.5"></div>
      </div>
      <div id="modal-metric-label" class="text-xs text-[#334155] font-semibold"></div>
    </div>

    <div class="mt-6 space-y-3">
      <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] font-heading">
        Architectural Highlights
      </h4>
      <div class="space-y-2 text-xs sm:text-sm text-[#1E293B] font-medium font-body">
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
        href="#contact"
        id="modal-discuss-btn"
        class="glass-btn-primary px-6 py-2.5 rounded-2xl font-semibold text-xs sm:text-sm cursor-pointer inline-flex items-center font-body text-white shadow-md"
      >
        Discuss a Similar Project
      </a>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
