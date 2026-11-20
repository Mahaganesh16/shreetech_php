<?php
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Contact Us | Shree Tech';
$pageDescription = 'Get in touch with Shree Tech for software consulting, project estimates, and engineering partnerships.';
$currentPage = 'contact';

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

require_once __DIR__ . '/includes/header.php';
?>

<div class="flex flex-col w-full pt-16 sm:pt-20">
  <section id="contact" class="relative py-20 sm:py-28 bg-[#F5F0FF]/25 backdrop-blur-xs overflow-hidden border-y border-[#F1E6EE]">
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
        
        <!-- Left Side: Contact Channels (5 Cols) -->
        <div class="lg:col-span-5 space-y-8 reveal-init reveal-left">
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
                      <div class="text-xs text-[#475569] font-medium font-body">Direct Inquiries</div>
                      <div class="text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors font-heading truncate">
                        contact@shreetech.com
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col items-end gap-1 shrink-0 pl-2">
                    <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                    <span class="text-[10px] text-[#475569] font-body">Flip</span>
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
                    <div class="text-xs text-[#475569] font-medium font-body truncate">
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
                      <div class="text-xs text-[#475569] font-medium font-body">Direct Hotline</div>
                      <div class="text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors font-heading truncate">
                        +1 (800) 840-2030
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col items-end gap-1 shrink-0 pl-2">
                    <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                    <span class="text-[10px] text-[#475569] font-body">Flip</span>
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
                    <div class="text-xs text-[#475569] font-medium font-body truncate">
                      Mon-Fri, 8:00 AM - 8:00 PM PST
                    </div>
                  </div>
                  <a
                    href="tel:+18008402030"
                    class="glass-btn-primary px-3.5 py-2 rounded-xl text-white font-semibold text-xs flex items-center gap-1 shrink-0 shadow-xs hover:scale-105 transition-transform font-body"
                  >
                    <span>Call Direct</span>
                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                  </a>
                </div>
              </div>
            </div>

            <!-- HQ Flip Card -->
            <div class="flip-card-wrapper h-24 sm:h-28 w-full select-none group cursor-pointer">
              <div class="flip-card-inner">
                <div class="flip-card-front glass-card p-4 rounded-3xl flex items-center justify-between border border-[#F1E6EE] shadow-xs group-hover:border-[#C01858] transition-colors">
                  <div class="flex items-center gap-4 min-w-0">
                    <div class="w-12 h-12 rounded-2xl bg-[#FFF4EA] border border-[#F1E6EE] flex items-center justify-center text-[#FF6B00] group-hover:bg-[#FF6B00] group-hover:text-white group-hover:scale-105 transition-all duration-300 shrink-0 shadow-xs">
                      <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <div class="min-w-0">
                      <div class="text-xs text-[#475569] font-medium font-body">Headquarters</div>
                      <div class="text-sm font-bold text-[#0F172A] group-hover:text-[#C01858] transition-colors font-heading truncate">
                        500 Howard St, San Francisco
                      </div>
                    </div>
                  </div>
                  <div class="flex flex-col items-end gap-1 shrink-0 pl-2">
                    <i data-lucide="rotate-cw" class="w-3.5 h-3.5 text-[#FF6B00] group-hover:rotate-180 transition-transform duration-500"></i>
                    <span class="text-[10px] text-[#475569] font-body">Flip</span>
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
                    <div class="text-xs text-[#475569] font-medium font-body truncate">
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
                  href="contact.php"
                  class="glass-btn-secondary mt-4 inline-block px-6 py-2.5 rounded-2xl text-xs font-semibold text-[#0F172A] cursor-pointer"
                >
                  Submit Another Inquiry
                </a>
              </div>
            <?php else: ?>
              <form id="contact-form" method="POST" action="contact.php" class="space-y-6" data-ajax="false">
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
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

