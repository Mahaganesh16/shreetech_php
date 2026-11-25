<?php
/**
 * Shree Tech Innovations - Careers Page
 * Dedicated careers portal featuring current job openings, culture, and resume submission.
 */
require_once __DIR__ . '/includes/form-security.php';
$csrfToken = ensureFormCsrfToken();

$allowedCareerPositions = [
    'Associate/Senior Software Engineer',
    'Service Sales Manager',
    'Digital Marketing',
    'General Application',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'career') {
    require_once __DIR__ . '/includes/mailer.php';
    header('Content-Type: application/json; charset=UTF-8');

    $securityErr = verifyFormCsrfAndHoneypot($_POST);
    if ($securityErr !== null) {
        http_response_code(403);
        echo json_encode([
            'ok' => false,
            'errors' => [],
            'message' => $securityErr,
        ]);
        exit;
    }

    $validated = validateCareerFields($_POST, $_FILES, $allowedCareerPositions);
    if (!empty($validated['errors'])) {
        echo json_encode([
            'ok' => false,
            'errors' => $validated['errors'],
            'message' => 'Please fix the highlighted fields before submitting.',
        ]);
        exit;
    }

    $mailResult = sendCareerApplicationEmail($validated['data'], $validated['attachment']);
    echo json_encode([
        'ok' => !empty($mailResult['ok']),
        'mode' => $mailResult['mode'] ?? 'server',
        'endpoint' => $mailResult['endpoint'] ?? null,
        'payload' => $mailResult['payload'] ?? null,
        'errors' => [],
        'message' => !empty($mailResult['ok'])
            ? 'Application delivered successfully.'
            : ($mailResult['error'] ?? 'Unable to submit your application right now.'),
    ]);
    exit;
}

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
<section class="relative pt-24 pb-8 sm:pt-28 sm:pb-10 md:pt-28 md:pb-12 overflow-hidden">
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
     2. OPENING POSITIONS SECTION
     ========================================================================= -->
<section id="openings" class="relative pt-6 pb-8 sm:pt-8 sm:pb-10 md:pt-8 md:pb-10 bg-transparent scroll-mt-24">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="max-w-3xl mb-6 sm:mb-8">
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
     3. SUBMIT YOUR RESUME SECTION (Exact UI from user image 3)
     ========================================================================= -->
<section id="submit-resume" class="relative pt-6 pb-8 sm:pt-8 sm:pb-10 md:pt-8 md:pb-12 bg-transparent scroll-mt-24">
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
      <form id="careers-resume-form" method="POST" action="careers.php" class="space-y-5" enctype="multipart/form-data" novalidate>
        <input type="hidden" name="form_type" value="career">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken); ?>">
        <input type="text" name="company_website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">
        
        <!-- Role Selection -->
        <div>
          <label for="career-position" class="block text-xs font-bold uppercase tracking-wider text-[#334155] mb-1.5 font-body">
            Position Applying For <span class="text-[#C01858]">*</span>
          </label>
          <select
            id="career-position"
            name="position"
            required
            class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body"
          >
            <option value="">-- SELECT AN OPENING POSITION --</option>
            <?php foreach ($openPositions as $pos): ?>
              <option value="<?php echo htmlspecialchars($pos['title']); ?>">
                <?php echo htmlspecialchars($pos['title']); ?> (<?php echo $pos['positions']; ?> <?php echo $pos['positions'] > 1 ? 'Openings' : 'Opening'; ?>)
              </option>
            <?php endforeach; ?>
            <option value="General Application">Other / General Engineering Application</option>
          </select>
          <p data-field-error="position" class="hidden text-xs text-[#C01858] mt-1.5 font-medium"></p>
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
            maxlength="3000"
            placeholder="INTRODUCE YOURSELF, PRIMARY TECH STACK, YEARS OF EXPERIENCE & WHY YOU WANT TO JOIN SHREE TECH..."
            class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium placeholder-[#94A3B8] placeholder:uppercase placeholder:text-xs placeholder:tracking-wide focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body resize-y"
          ></textarea>
          <p data-field-error="cover_letter" class="hidden text-xs text-[#C01858] mt-1.5 font-medium"></p>
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
              minlength="2"
              maxlength="80"
              autocapitalize="words"
              autocomplete="name"
              pattern="[A-Za-z][A-Za-z\s.'-]{1,79}"
              placeholder="ENTER YOUR FULL NAME"
              class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium placeholder-[#94A3B8] placeholder:uppercase placeholder:text-xs placeholder:tracking-wide focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body"
            >
            <p data-field-error="name" class="hidden text-xs text-[#C01858] mt-1.5 font-medium"></p>
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
              maxlength="120"
              autocomplete="email"
              placeholder="ENTER YOUR E-MAIL ADDRESS"
              class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm text-[#0F172A] font-medium placeholder-[#94A3B8] placeholder:uppercase placeholder:text-xs placeholder:tracking-wide focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all font-body"
            >
            <p data-field-error="email" class="hidden text-xs text-[#C01858] mt-1.5 font-medium"></p>
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
              inputmode="numeric"
              minlength="10"
              maxlength="10"
              pattern="[0-9]{10}"
              autocomplete="tel-national"
              placeholder="ENTER 10-DIGIT MOBILE NUMBER"
              class="w-full px-4 py-3 rounded-xl border border-[#CBD5E1] bg-white text-sm font-stat text-[#0F172A] font-medium placeholder-[#94A3B8] placeholder:uppercase placeholder:text-xs placeholder:tracking-wide focus:outline-none focus:border-[#C01858] focus:ring-2 focus:ring-[#C01858]/20 transition-all"
            >
            <p data-field-error="phone" class="hidden text-xs text-[#C01858] mt-1.5 font-medium"></p>
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
            <p data-field-error="resume" class="hidden text-xs text-[#C01858] mt-1.5 font-medium"></p>
            <span class="text-[11px] text-[#C01858] font-semibold mt-1 inline-block">
              Resume Upload (PDF, DOC, DOCX up to 10MB)
            </span>
          </div>
        </div>

        <!-- Delivery / Validation Error Banner -->
        <div id="career-error-banner" class="hidden p-3.5 rounded-xl bg-[#FFF0F5] border border-[#C01858]/30 text-xs sm:text-sm text-[#C01858] font-medium flex items-start gap-2">
          <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 mt-0.5"></i>
          <span id="career-error-text"></span>
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
     4. INTERACTIVE JOB DETAILS MODAL
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
     5. APPLICATION SUCCESS MODAL
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
    if (window.__lenis) window.__lenis.stop();
  }

  function closeJobModal() {
    if (!jobModal) return;
    jobModal.classList.add('opacity-0', 'pointer-events-none');
    jobModal.querySelector('.relative').classList.add('scale-95');
    jobModal.querySelector('.relative').classList.remove('scale-100');
    jobModal.setAttribute('aria-hidden', 'true');
    if (window.__lenis) window.__lenis.start();
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
        if (window.__lenis) {
          window.__lenis.scrollTo(formSection, { offset: -90, duration: 1.2 });
        } else {
          formSection.scrollIntoView({ behavior: 'smooth' });
        }
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

  const successModal = document.getElementById('resume-success-modal');
  const closeSuccessBtn = document.getElementById('close-success-modal-btn');

  if (closeSuccessBtn) {
    closeSuccessBtn.addEventListener('click', function () {
      if (successModal) {
        successModal.classList.add('opacity-0', 'pointer-events-none');
        successModal.querySelector('.relative').classList.add('scale-95');
        successModal.querySelector('.relative').classList.remove('scale-100');
        successModal.setAttribute('aria-hidden', 'true');
        if (window.__lenis) window.__lenis.start();
      }
    });
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
