<?php
/**
 * Shree Tech Innovations - Careers Page
 * Dedicated careers portal featuring current job openings, culture, and resume submission.
 */
$pageTitle = 'Careers | Shree Tech Innovations - Web & Mobile Development Careers in Madurai';
$pageDescription = 'Build your technology career with Shree Tech Innovations in Madurai. Explore open positions for Software Engineers, Sales Managers, and Digital Marketers. Submit your resume today.';
$currentPage = 'careers';

require_once __DIR__ . '/includes/header.php';

// Job Openings Data (matching Shree Tech requirements)
$openPositions = [
    [
        'id' => 'software-engineer',
        'title' => 'Associate/Senior Software Engineer',
        'experience' => '1.5 - 5 years',
        'positions' => 4,
        'location' => 'Madurai',
        'department' => 'Engineering & Development',
        'type' => 'Full-time',
        'description' => 'We are seeking passionate Associate and Senior Software Engineers to build modern, high-performance web and mobile platforms. You will architect robust backends, develop responsive frontends, and collaborate with enterprise clients.',
        'responsibilities' => [
            'Design, develop, and test scalable web applications and RESTful microservices.',
            'Collaborate closely with UI/UX designers, product managers, and senior architects.',
            'Write clean, well-documented, test-driven code adhering to clean architecture standards.',
            'Participate in sprint planning, code reviews, and CI/CD deployment automation.'
        ],
        'skills' => ['PHP / Laravel', 'JavaScript / TypeScript', 'React.js', 'Node.js', 'MySQL / PostgreSQL', 'REST APIs', 'Git']
    ],
    [
        'id' => 'sales-manager',
        'title' => 'Service Sales Manager',
        'experience' => '5+ years',
        'positions' => 1,
        'location' => 'Madurai',
        'department' => 'Business Development & Sales',
        'type' => 'Full-time',
        'description' => 'Looking for an experienced Service Sales Manager to drive strategic enterprise client acquisition, consult on IT services, and lead business development initiatives across national and global markets.',
        'responsibilities' => [
            'Drive B2B sales cycles from lead discovery to final enterprise contract closure.',
            'Understand client technical requirements and formulate bespoke software engineering proposals.',
            'Conduct consultative product pitches and negotiate high-value service contracts.',
            'Foster long-term relationships with CTOs, engineering heads, and startup founders.'
        ],
        'skills' => ['B2B Sales', 'IT Solution Selling', 'Client Engagement', 'RFP Proposal Writing', 'Contract Negotiation', 'CRM Systems']
    ],
    [
        'id' => 'digital-marketing',
        'title' => 'Digital Marketing',
        'experience' => '5+ years',
        'positions' => 1,
        'location' => 'Madurai',
        'department' => 'Marketing & Growth',
        'type' => 'Full-time',
        'description' => 'Seeking a results-oriented Digital Marketing specialist to scale Shree Tech online presence, lead generation, technical content marketing, and multi-channel inbound campaigns.',
        'responsibilities' => [
            'Formulate and execute comprehensive technical SEO and link-building roadmaps.',
            'Manage and optimize high-ROI paid campaigns across Google Ads, LinkedIn, and Meta.',
            'Author compelling case studies, industry articles, and social media thought leadership.',
            'Analyze traffic, conversion funnels, and customer acquisition metrics using GA4 and Search Console.'
        ],
        'skills' => ['SEO & SEM', 'Google Ads', 'Content Strategy', 'Social Media Marketing', 'Google Analytics 4', 'Inbound Lead Gen']
    ]
];
?>

<!-- =========================================================================
     1. CAREERS HERO SECTION
     ========================================================================= -->
<section class="relative pt-24 pb-12 sm:pt-36 sm:pb-20 md:pt-40 md:pb-24 overflow-hidden">
  <!-- Ambient Colorful Glows -->
  <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[650px] h-[320px] bg-gradient-to-tr from-[#FF6B00]/12 via-[#C01858]/10 to-[#8B5CF6]/12 rounded-full blur-3xl pointer-events-none"></div>

  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    
    <!-- Hiring Badge -->
    <div class="glass-pill inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-[#C01858] mb-4 shadow-xs">
      <i data-lucide="sparkles" class="w-4 h-4 text-[#FF6B00]"></i>
      <span>We Are Hiring &bull; Join Our Team</span>
    </div>

    <!-- Main Title -->
    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-[#C01858] tracking-tight font-heading mb-6">
      Careers
    </h1>

    <!-- Subtitle -->
    <p class="max-w-3xl mx-auto text-base sm:text-lg text-[#334155] font-medium leading-relaxed font-body">
      If you are one looking for a challenging career in web and mobile development and wish to work with a group of professionals, it&apos;s never late, please drop your resume. We will get back to you.
    </p>

    <!-- Quick Action Anchor Buttons -->
    <div class="mt-8 flex flex-wrap items-center justify-center gap-3.5">
      <a
        href="#openings"
        class="glass-btn-primary px-6 py-3 rounded-full text-white font-bold text-sm inline-flex items-center gap-2 shadow-md hover:scale-105 active:scale-95 transition-all"
        style="background: linear-gradient(135deg, #FF6B00 0%, #C01858 55%, #8B5CF6 100%);"
      >
        <span>Explore Open Positions</span>
        <i data-lucide="arrow-down" class="w-4 h-4"></i>
      </a>
      <a
        href="#submit-resume"
        class="glass-btn-secondary px-6 py-3 rounded-full text-[#0F172A] font-bold text-sm inline-flex items-center gap-2 border border-[#F1E6EE] hover:border-[#C01858] hover:text-[#C01858] shadow-xs transition-all"
      >
        <span>Drop Your Resume</span>
        <i data-lucide="file-up" class="w-4 h-4 text-[#FF6B00]"></i>
      </a>
    </div>
  </div>
</section>

<!-- =========================================================================
     2. WORK AT SHREETECH SECTION
     ========================================================================= -->
<section class="relative py-11 sm:py-16 md:py-[90px] bg-[#FFF0F5]/25 border-y border-[#F1E6EE] backdrop-blur-xs">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-3xl mb-8 sm:mb-12">
      <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[#8B5CF6] mb-3">
        <i data-lucide="users-2" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
        <span>Work Culture</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading mb-4">
        Work at <span class="text-[#C01858]">SHREETECH</span>
      </h2>
      <p class="text-base text-[#334155] font-medium leading-relaxed font-body">
        At <strong class="font-bold text-[#0F172A]">SHREETECH Business Solution Private Limited</strong> - Best IT Company in Madurai. We value talents and believe that working in a friendly environment is the best way to advance one&apos;s career. Check out the position and submit your CV.
      </p>
    </div>

    <!-- 4 Culture & Value Highlights -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="glass-card p-6 rounded-2xl border border-[#F1E6EE] shadow-xs hover:border-[#C01858] transition-all group">
        <div class="w-12 h-12 rounded-xl bg-[#FFF4EA] border border-[#F1E6EE] text-[#FF6B00] flex items-center justify-center mb-4 group-hover:bg-[#FF6B00] group-hover:text-white transition-all shadow-xs">
          <i data-lucide="rocket" class="w-6 h-6"></i>
        </div>
        <h4 class="text-base font-bold text-[#0F172A] mb-2 font-heading">High-Impact Projects</h4>
        <p class="text-sm text-[#475569] font-medium leading-relaxed font-body">
          Build modern web apps, mobile solutions, and enterprise software used by thousands worldwide.
        </p>
      </div>

      <div class="glass-card p-6 rounded-2xl border border-[#F1E6EE] shadow-xs hover:border-[#C01858] transition-all group">
        <div class="w-12 h-12 rounded-xl bg-[#FFF0F5] border border-[#F1E6EE] text-[#C01858] flex items-center justify-center mb-4 group-hover:bg-[#C01858] group-hover:text-white transition-all shadow-xs">
          <i data-lucide="heart-handshake" class="w-6 h-6"></i>
        </div>
        <h4 class="text-base font-bold text-[#0F172A] mb-2 font-heading">Friendly Environment</h4>
        <p class="text-sm text-[#475569] font-medium leading-relaxed font-body">
          Supportive team spirit, flat hierarchies, open communication, and true psychological safety.
        </p>
      </div>

      <div class="glass-card p-6 rounded-2xl border border-[#F1E6EE] shadow-xs hover:border-[#C01858] transition-all group">
        <div class="w-12 h-12 rounded-xl bg-[#F5F0FF] border border-[#F1E6EE] text-[#8B5CF6] flex items-center justify-center mb-4 group-hover:bg-[#8B5CF6] group-hover:text-white transition-all shadow-xs">
          <i data-lucide="award" class="w-6 h-6"></i>
        </div>
        <h4 class="text-base font-bold text-[#0F172A] mb-2 font-heading">Career Growth & Mentorship</h4>
        <p class="text-sm text-[#475569] font-medium leading-relaxed font-body">
          Direct mentorship from veteran architects, continuous upskilling, and rapid career progression.
        </p>
      </div>

      <div class="glass-card p-6 rounded-2xl border border-[#F1E6EE] shadow-xs hover:border-[#C01858] transition-all group">
        <div class="w-12 h-12 rounded-xl bg-[#FFF4EA] border border-[#F1E6EE] text-[#FF6B00] flex items-center justify-center mb-4 group-hover:bg-[#FF6B00] group-hover:text-white transition-all shadow-xs">
          <i data-lucide="shield-check" class="w-6 h-6"></i>
        </div>
        <h4 class="text-base font-bold text-[#0F172A] mb-2 font-heading">Competitive Rewards</h4>
        <p class="text-sm text-[#475569] font-medium leading-relaxed font-body">
          Transparent compensation, performance rewards, work-life balance, and wellness benefits.
        </p>
      </div>
    </div>

  </div>
</section>

<!-- =========================================================================
     3. OPENING POSITIONS SECTION
     ========================================================================= -->
<section id="openings" class="relative py-11 sm:py-16 md:py-[90px] bg-transparent scroll-mt-24">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-3xl mb-8 sm:mb-12">
      <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[#C01858] mb-3">
        <i data-lucide="briefcase" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
        <span>Current Openings</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-black text-[#0F172A] tracking-tight font-heading">
        Opening Positions
      </h2>
      <p class="mt-3 text-base text-[#475569] font-medium leading-relaxed font-body">
        Select a role below to review key responsibilities and apply directly.
      </p>
    </div>

    <!-- 3 Job Opening Cards Grid (Exact design from user attachments) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
      <?php foreach ($openPositions as $pIdx => $pos): 
        $posJson = json_encode($pos);
      ?>
        <div class="glass-card p-6 sm:p-7 rounded-2xl border-2 border-[#E2E8F0] hover:border-[#C01858] transition-all duration-300 shadow-sm hover:shadow-lg flex flex-col justify-between group">
          <div>
            <!-- Header Row: Title & Department -->
            <div class="flex items-start justify-between gap-3 mb-4">
              <div>
                <h3 class="text-lg sm:text-xl font-bold text-[#C01858] group-hover:text-[#991244] transition-colors font-heading leading-snug">
                  <?php echo htmlspecialchars($pos['title']); ?>
                </h3>
                <span class="text-xs text-[#8B5CF6] font-semibold font-body inline-block mt-0.5">
                  <?php echo htmlspecialchars($pos['department']); ?>
                </span>
              </div>
              <span class="text-xs font-bold font-stat text-[#FF6B00] bg-[#FFF4EA] border border-[#FF6B00]/25 px-2.5 py-0.5 rounded-full shadow-2xs shrink-0">
                <?php echo $pos['positions']; ?> <?php echo $pos['positions'] > 1 ? 'Openings' : 'Opening'; ?>
              </span>
            </div>

            <!-- Metadata List (Experience, Positions, Location) -->
            <div class="space-y-2 py-3 border-y border-[#F1E6EE] text-sm text-[#334155] font-medium font-body">
              <div class="flex items-center gap-2">
                <span class="text-[#64748B] font-semibold w-36 shrink-0">Experience:</span>
                <span class="text-[#0F172A] font-bold"><?php echo htmlspecialchars($pos['experience']); ?></span>
              </div>
              <div class="flex items-center gap-2">
                <span class="text-[#64748B] font-semibold w-36 shrink-0">Number of Positions:</span>
                <span class="text-[#0F172A] font-bold"><?php echo $pos['positions']; ?></span>
              </div>
              <div class="flex items-center gap-2">
                <span class="text-[#64748B] font-semibold w-36 shrink-0">Location:</span>
                <span class="text-[#0F172A] font-bold"><?php echo htmlspecialchars($pos['location']); ?></span>
              </div>
            </div>

            <!-- Short Description -->
            <p class="text-xs sm:text-sm text-[#475569] font-normal leading-relaxed mt-3.5 mb-4 font-body line-clamp-2">
              <?php echo htmlspecialchars($pos['description']); ?>
            </p>
          </div>

          <!-- Bottom Action: Red Pill VIEW MORE Button -->
          <div class="pt-2 flex items-center justify-end">
            <button
              type="button"
              class="open-job-modal-btn px-6 py-2.5 rounded-full text-white font-bold text-xs uppercase tracking-wider inline-flex items-center gap-2 shadow-sm hover:shadow-md hover:scale-105 active:scale-95 transition-all cursor-pointer"
              style="background: #C01858;"
              data-job-json="<?php echo htmlspecialchars($posJson, ENT_QUOTES, 'UTF-8'); ?>"
            >
              <span>View More</span>
              <span class="inline-flex items-center">
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 -mr-1.5"></i>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
              </span>
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- =========================================================================
     4. HIRING STEPS SECTION
     ========================================================================= -->
<section class="relative py-11 sm:py-16 md:py-[90px] bg-[#FFF4EA]/20 border-y border-[#F1E6EE] backdrop-blur-xs">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    
    <div class="max-w-2xl mx-auto mb-8 sm:mb-12">
      <div class="glass-pill inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-[#8B5CF6] mb-3">
        <i data-lucide="git-merge" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
        <span>Streamlined Hiring</span>
      </div>
      <h2 class="text-2xl sm:text-3xl font-black text-[#0F172A] font-heading">
        What Are Our Hiring Steps?
      </h2>
      <p class="mt-2 text-sm text-[#475569] font-medium font-body">
        Our process is transparent, respectful of your time, and designed to let your talents shine.
      </p>
    </div>

    <!-- 4 Hiring Steps -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="p-6 rounded-2xl bg-white border border-[#F1E6EE] shadow-xs relative">
        <div class="w-9 h-9 rounded-full bg-[#FFF4EA] text-[#FF6B00] font-black font-stat flex items-center justify-center mx-auto mb-3 shadow-2xs">
          01
        </div>
        <h4 class="text-base font-bold text-[#0F172A] mb-1 font-heading">Resume Drop</h4>
        <p class="text-xs text-[#475569] font-medium leading-relaxed font-body">
          Submit your profile and cover letter through our portal below.
        </p>
      </div>

      <div class="p-6 rounded-2xl bg-white border border-[#F1E6EE] shadow-xs relative">
        <div class="w-9 h-9 rounded-full bg-[#FFF0F5] text-[#C01858] font-black font-stat flex items-center justify-center mx-auto mb-3 shadow-2xs">
          02
        </div>
        <h4 class="text-base font-bold text-[#0F172A] mb-1 font-heading">Initial Screening</h4>
        <p class="text-xs text-[#475569] font-medium leading-relaxed font-body">
          A friendly conversation with HR about your goals and background.
        </p>
      </div>

      <div class="p-6 rounded-2xl bg-white border border-[#F1E6EE] shadow-xs relative">
        <div class="w-9 h-9 rounded-full bg-[#F5F0FF] text-[#8B5CF6] font-black font-stat flex items-center justify-center mx-auto mb-3 shadow-2xs">
          03
        </div>
        <h4 class="text-base font-bold text-[#0F172A] mb-1 font-heading">Technical Discussion</h4>
        <p class="text-xs text-[#475569] font-medium leading-relaxed font-body">
          Practical assessment and discussion with our lead engineers.
        </p>
      </div>

      <div class="p-6 rounded-2xl bg-white border border-[#F1E6EE] shadow-xs relative">
        <div class="w-9 h-9 rounded-full bg-[#ECFDF5] text-[#059669] font-black font-stat flex items-center justify-center mx-auto mb-3 shadow-2xs">
          04
        </div>
        <h4 class="text-base font-bold text-[#0F172A] mb-1 font-heading">Offer & Onboarding</h4>
        <p class="text-xs text-[#475569] font-medium leading-relaxed font-body">
          Welcome to Shree Tech! Fast-track onboarding and team welcome.
        </p>
      </div>
    </div>

  </div>
</section>

<!-- =========================================================================
     5. SUBMIT YOUR RESUME SECTION (Exact UI from user image 3)
     ========================================================================= -->
<section id="submit-resume" class="relative py-11 sm:py-16 md:py-[90px] bg-transparent scroll-mt-24">
  <!-- Subtle Ambient Glow -->
  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[400px] bg-gradient-to-tr from-[#FF6B00]/10 via-[#C01858]/10 to-[#8B5CF6]/10 rounded-full blur-3xl pointer-events-none"></div>

  <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Form Container Card -->
    <div class="glass-card p-5 sm:p-8 md:p-12 rounded-2xl sm:rounded-3xl border border-[#F1E6EE] shadow-2xl bg-white/90 backdrop-blur-xl">
      
      <!-- Red Form Title -->
      <div class="text-center mb-8">
        <h2 class="text-2xl sm:text-3xl font-black text-[#C01858] tracking-tight font-heading mb-2">
          Submit Your Resume
        </h2>
        <p class="text-xs sm:text-sm text-[#475569] font-medium font-body max-w-lg mx-auto">
          Please fill out the details below and attach your latest resume. Our talent team will review your application promptly.
        </p>
      </div>

      <!-- Application Form -->
      <form id="careers-resume-form" class="space-y-5" enctype="multipart/form-data">
        
        <!-- Role Selection -->
        <div>
          <label for="career-position" class="block text-xs font-bold uppercase tracking-wider text-[#334155] mb-1.5 font-body">
            Position Applying For
          </label>
          <select
            id="career-position"
            name="position"
            required
            class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body"
          >
            <option value="">-- Select an Opening Position --</option>
            <?php foreach ($openPositions as $pos): ?>
              <option value="<?php echo htmlspecialchars($pos['title']); ?>">
                <?php echo htmlspecialchars($pos['title']); ?> (<?php echo $pos['positions']; ?> <?php echo $pos['positions'] > 1 ? 'Openings' : 'Opening'; ?>)
              </option>
            <?php endforeach; ?>
            <option value="General Application">Other / General Engineering Application</option>
          </select>
        </div>

        <!-- Cover Letter Textarea -->
        <div>
          <label for="career-cover-letter" class="block text-xs font-bold uppercase tracking-wider text-[#334155] mb-1.5 font-body">
            Resume Cover Letter
          </label>
          <textarea
            id="career-cover-letter"
            name="cover_letter"
            rows="5"
            placeholder="Resume Cover Letter: Introduce yourself, share your primary tech stack, years of experience, and why you are excited to join Shree Tech..."
            class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium placeholder-[#94A3B8] focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body resize-y"
          ></textarea>
        </div>

        <!-- Row 1: Your Name & E-Mail -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="career-name" class="block text-xs font-bold uppercase tracking-wider text-[#334155] mb-1.5 font-body">
              Your Name <span class="text-[#C01858]">*</span>
            </label>
            <input
              type="text"
              id="career-name"
              name="name"
              required
              placeholder="Your Name"
              class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium placeholder-[#94A3B8] focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body"
            >
          </div>
          <div>
            <label for="career-email" class="block text-xs font-bold uppercase tracking-wider text-[#334155] mb-1.5 font-body">
              E-Mail <span class="text-[#C01858]">*</span>
            </label>
            <input
              type="email"
              id="career-email"
              name="email"
              required
              placeholder="E-Mail"
              class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium placeholder-[#94A3B8] focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body"
            >
          </div>
        </div>

        <!-- Row 2: Mobile Number & Resume Upload -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="career-phone" class="block text-xs font-bold uppercase tracking-wider text-[#334155] mb-1.5 font-body">
              Mobile Number <span class="text-[#C01858]">*</span>
            </label>
            <input
              type="tel"
              id="career-phone"
              name="phone"
              required
              placeholder="Mobile Number"
              class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium placeholder-[#94A3B8] focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body"
            >
          </div>

          <div>
            <label for="career-resume" class="block text-xs font-bold uppercase tracking-wider text-[#334155] mb-1.5 font-body">
              Resume Upload <span class="text-[#C01858]">*</span>
            </label>
            <div class="relative w-full">
              <input
                type="file"
                id="career-resume"
                name="resume"
                required
                accept=".pdf,.doc,.docx"
                class="block w-full text-sm text-[#475569] file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#F1E6EE] file:text-[#C01858] hover:file:bg-[#C01858] hover:file:text-white file:transition-colors file:cursor-pointer px-3 py-1.5 rounded-xl border border-[#CBD5E1] bg-white cursor-pointer focus:outline-none focus:border-[#C01858]"
              >
            </div>
            <span class="text-[11px] text-[#C01858] font-semibold mt-1 inline-block">
              Resume Upload (PDF, DOC, DOCX up to 10MB)
            </span>
          </div>
        </div>

        <!-- Submit Button (Centered Red Pill) -->
        <div class="pt-4 text-center">
          <button
            type="submit"
            id="career-submit-btn"
            class="px-12 py-3 rounded-full text-white font-extrabold text-sm uppercase tracking-wider inline-flex items-center justify-center gap-2 shadow-md hover:shadow-lg hover:scale-105 active:scale-95 transition-all cursor-pointer"
            style="background: #C01858;"
          >
            <span>Submit</span>
            <i data-lucide="send" class="w-4 h-4"></i>
          </button>
        </div>

      </form>

    </div>

  </div>
</section>

<!-- =========================================================================
     6. INTERACTIVE JOB DETAILS MODAL
     ========================================================================= -->
<div
  id="job-details-modal"
  class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300"
  role="dialog"
  aria-modal="true"
  aria-hidden="true"
>
  <div class="relative w-full max-w-2xl bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-[#F1E6EE] transform scale-95 transition-all duration-300 max-h-[90vh] overflow-y-auto">
    
    <!-- Close Button -->
    <button
      type="button"
      id="close-job-modal-btn"
      class="absolute top-5 right-5 p-2 rounded-full text-[#64748B] hover:text-[#C01858] hover:bg-[#FFF0F5] transition-colors cursor-pointer"
      aria-label="Close dialog"
    >
      <i data-lucide="x" class="w-5 h-5"></i>
    </button>

    <!-- Header -->
    <div class="flex items-center gap-2 mb-2">
      <span id="modal-job-department" class="glass-pill px-3 py-1 rounded-full text-xs font-bold text-[#8B5CF6] bg-[#F5F0FF] border border-[#F1E6EE] uppercase tracking-wider"></span>
      <span id="modal-job-type" class="text-xs font-semibold text-[#FF6B00] bg-[#FFF4EA] border border-[#FF6B00]/25 px-2.5 py-0.5 rounded-full"></span>
    </div>

    <h3 id="modal-job-title" class="text-2xl sm:text-3xl font-black text-[#C01858] mb-3 font-heading leading-tight"></h3>
    
    <!-- Meta Bar -->
    <div class="grid grid-cols-3 gap-2 p-3.5 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0] mb-5 text-center">
      <div>
        <div class="text-[11px] text-[#64748B] font-medium">Experience</div>
        <div id="modal-job-exp" class="text-xs sm:text-sm font-bold text-[#0F172A] mt-0.5"></div>
      </div>
      <div>
        <div class="text-[11px] text-[#64748B] font-medium">Openings</div>
        <div id="modal-job-openings" class="text-xs sm:text-sm font-bold text-[#FF6B00] mt-0.5"></div>
      </div>
      <div>
        <div class="text-[11px] text-[#64748B] font-medium">Location</div>
        <div id="modal-job-loc" class="text-xs sm:text-sm font-bold text-[#0F172A] mt-0.5"></div>
      </div>
    </div>

    <!-- Overview -->
    <div class="mb-5">
      <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] font-heading mb-1.5">
        Role Overview
      </h4>
      <p id="modal-job-desc" class="text-sm text-[#334155] leading-relaxed font-body"></p>
    </div>

    <!-- Key Responsibilities -->
    <div class="mb-5">
      <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] font-heading mb-2">
        Key Responsibilities
      </h4>
      <ul id="modal-job-responsibilities" class="space-y-2 text-xs sm:text-sm text-[#334155] font-medium font-body"></ul>
    </div>

    <!-- Skills -->
    <div class="mb-6">
      <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] font-heading mb-2">
        Required Skills & Qualifications
      </h4>
      <div id="modal-job-skills" class="flex flex-wrap gap-1.5"></div>
    </div>

    <!-- Modal Footer Actions -->
    <div class="pt-4 border-t border-[#F1E6EE] flex items-center justify-between gap-3">
      <span class="text-xs text-[#64748B] font-medium">
        Ready to take the next step?
      </span>
      <button
        type="button"
        id="modal-apply-now-btn"
        class="px-6 py-2.5 rounded-full text-white font-bold text-xs sm:text-sm uppercase tracking-wider inline-flex items-center gap-2 shadow-md hover:scale-105 active:scale-95 transition-all cursor-pointer"
        style="background: #C01858;"
      >
        <span>Apply for this Role</span>
        <i data-lucide="arrow-right" class="w-4 h-4"></i>
      </button>
    </div>

  </div>
</div>

<!-- =========================================================================
     7. APPLICATION SUCCESS MODAL
     ========================================================================= -->
<div
  id="resume-success-modal"
  class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300"
  role="dialog"
  aria-modal="true"
  aria-hidden="true"
>
  <div class="relative w-full max-w-md bg-white rounded-3xl p-8 text-center shadow-2xl border border-[#F1E6EE] transform scale-95 transition-all duration-300">
    <div class="w-16 h-16 rounded-full bg-[#ECFDF5] border border-[#A7F3D0] text-[#059669] flex items-center justify-center mx-auto mb-4 shadow-sm">
      <i data-lucide="check-circle" class="w-9 h-9"></i>
    </div>
    <h3 class="text-2xl font-black text-[#0F172A] font-heading mb-2">
      Application Submitted!
    </h3>
    <p class="text-sm text-[#475569] leading-relaxed font-body mb-6">
      Thank you for dropping your resume with Shree Tech Innovations. Our human resources team will evaluate your profile and get in touch with you shortly.
    </p>
    <button
      type="button"
      id="close-success-modal-btn"
      class="px-8 py-2.5 rounded-full text-white font-bold text-xs uppercase tracking-wider inline-flex items-center gap-2 shadow-md hover:scale-105 transition-all cursor-pointer"
      style="background: #C01858;"
    >
      <span>Done</span>
    </button>
  </div>
</div>

<!-- Page Specific Script for Modal & Form Interactivity -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }

  // Job Details Modal
  const jobModal = document.getElementById('job-details-modal');
  const closeJobModalBtn = document.getElementById('close-job-modal-btn');
  const modalApplyBtn = document.getElementById('modal-apply-now-btn');
  const positionSelect = document.getElementById('career-position');

  let currentSelectedJobTitle = '';

  function openJobModal(jobData) {
    if (!jobModal || !jobData) return;

    currentSelectedJobTitle = jobData.title || '';
    document.getElementById('modal-job-department').textContent = jobData.department || 'Engineering';
    document.getElementById('modal-job-type').textContent = jobData.type || 'Full-time';
    document.getElementById('modal-job-title').textContent = jobData.title || '';
    document.getElementById('modal-job-exp').textContent = jobData.experience || '';
    document.getElementById('modal-job-openings').textContent = (jobData.positions || 1) + ' Open';
    document.getElementById('modal-job-loc').textContent = jobData.location || 'Madurai';
    document.getElementById('modal-job-desc').textContent = jobData.description || '';

    // Render Responsibilities
    const respList = document.getElementById('modal-job-responsibilities');
    respList.innerHTML = '';
    (jobData.responsibilities || []).forEach(function (resp) {
      const li = document.createElement('li');
      li.className = 'flex items-start gap-2';
      li.innerHTML = '<i data-lucide="check-circle-2" class="w-4 h-4 text-[#C01858] shrink-0 mt-0.5"></i><span>' + resp + '</span>';
      respList.appendChild(li);
    });

    // Render Skills
    const skillsDiv = document.getElementById('modal-job-skills');
    skillsDiv.innerHTML = '';
    (jobData.skills || []).forEach(function (skill) {
      const span = document.createElement('span');
      span.className = 'px-2.5 py-1 rounded-lg text-xs font-semibold bg-[#F1E6EE] text-[#C01858] border border-[#C01858]/20';
      span.textContent = skill;
      skillsDiv.appendChild(span);
    });

    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }

    jobModal.classList.remove('opacity-0', 'pointer-events-none');
    jobModal.querySelector('.relative').classList.remove('scale-95');
    jobModal.querySelector('.relative').classList.add('scale-100');
    jobModal.setAttribute('aria-hidden', 'false');
  }

  function closeJobModal() {
    if (!jobModal) return;
    jobModal.classList.add('opacity-0', 'pointer-events-none');
    jobModal.querySelector('.relative').classList.add('scale-95');
    jobModal.querySelector('.relative').classList.remove('scale-100');
    jobModal.setAttribute('aria-hidden', 'true');
  }

  document.querySelectorAll('.open-job-modal-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      try {
        const data = JSON.parse(btn.getAttribute('data-job-json'));
        openJobModal(data);
      } catch (e) {
        console.error('Error parsing job json', e);
      }
    });
  });

  if (closeJobModalBtn) {
    closeJobModalBtn.addEventListener('click', closeJobModal);
  }

  if (modalApplyBtn) {
    modalApplyBtn.addEventListener('click', function () {
      closeJobModal();
      if (positionSelect && currentSelectedJobTitle) {
        // Find matching option
        for (let i = 0; i < positionSelect.options.length; i++) {
          if (positionSelect.options[i].value.indexOf(currentSelectedJobTitle) !== -1 || positionSelect.options[i].text.indexOf(currentSelectedJobTitle) !== -1) {
            positionSelect.selectedIndex = i;
            break;
          }
        }
      }
      const formSection = document.getElementById('submit-resume');
      if (formSection) {
        formSection.scrollIntoView({ behavior: 'smooth' });
        setTimeout(function () {
          const nameInput = document.getElementById('career-name');
          if (nameInput) nameInput.focus();
        }, 500);
      }
    });
  }

  // Close modal when clicking on backdrop
  if (jobModal) {
    jobModal.addEventListener('click', function (e) {
      if (e.target === jobModal) closeJobModal();
    });
  }

  // Resume Form Handling
  const resumeForm = document.getElementById('careers-resume-form');
  const successModal = document.getElementById('resume-success-modal');
  const closeSuccessBtn = document.getElementById('close-success-modal-btn');

  if (resumeForm) {
    resumeForm.addEventListener('submit', function (e) {
      e.preventDefault();

      const submitBtn = document.getElementById('career-submit-btn');
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span>Submitting...</span>';
      }

      setTimeout(function () {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = '<span>Submit</span><i data-lucide="send" class="w-4 h-4"></i>';
        }
        resumeForm.reset();

        // Show Success Modal
        if (successModal) {
          successModal.classList.remove('opacity-0', 'pointer-events-none');
          successModal.querySelector('.relative').classList.remove('scale-95');
          successModal.querySelector('.relative').classList.add('scale-100');
          successModal.setAttribute('aria-hidden', 'false');
          if (typeof lucide !== 'undefined') lucide.createIcons();
        }
      }, 700);
    });
  }

  if (closeSuccessBtn) {
    closeSuccessBtn.addEventListener('click', function () {
      if (successModal) {
        successModal.classList.add('opacity-0', 'pointer-events-none');
        successModal.querySelector('.relative').classList.add('scale-95');
        successModal.querySelector('.relative').classList.remove('scale-100');
        successModal.setAttribute('aria-hidden', 'true');
      }
    });
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
