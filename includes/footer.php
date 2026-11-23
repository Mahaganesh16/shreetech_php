<?php
if (!isset($navLinks) || !isset($servicesData)) {
    require_once __DIR__ . '/data.php';
}
?>
</main>

<footer class="relative z-10 bg-white border-t border-[#F1E6EE] mt-16 sm:mt-20 pt-16 sm:pt-20 pb-12 overflow-hidden shadow-xs">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-16 border-b border-[#F1E6EE]">
      
      <!-- Brand Info (4 Cols) -->
      <div class="lg:col-span-4 space-y-4">
        <a href="#home" class="flex items-center gap-3 group">
          <div class="w-11 h-11 rounded-2xl bg-white border border-[#F1E6EE] p-1 flex items-center justify-center shadow-xs group-hover:border-[#C01858] transition-all overflow-hidden">
            <img src="images/logo-icon.png" alt="Shree Tech Logo" class="w-full h-full object-contain">
          </div>
          <div class="flex flex-col">
            <span class="text-base font-black text-[#0F172A] tracking-tight font-heading">
              Shree Tech
            </span>
            <span class="text-[9px] text-[#475569] font-semibold tracking-wider uppercase -mt-0.5 font-heading">
              Innovations
            </span>
          </div>
        </a>

        <p class="text-sm text-[#475569] font-normal leading-relaxed font-body">
          ShreeTech is an emerging internship training startup lead by highly experienced professionals who unfold various industry chapters and worked with reputable organizations.
        </p>

        <!-- Social Channels -->
        <div class="flex items-center gap-2.5 pt-2">
          <a
            href="https://github.com"
            target="_blank"
            rel="noopener noreferrer"
            class="glass-btn-secondary w-9 h-9 rounded-xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs transition-colors"
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
            class="glass-btn-secondary w-9 h-9 rounded-xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs transition-colors"
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
            class="glass-btn-secondary w-9 h-9 rounded-xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs transition-colors"
            aria-label="Twitter / X"
          >
            <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Quick Navigation (2 Cols) -->
      <div class="lg:col-span-2">
        <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-4 font-heading">
          Navigation
        </h4>
        <ul class="space-y-2 text-sm text-[#475569] font-medium font-body">
          <?php foreach ($navLinks as $l): ?>
            <li>
              <a href="<?php echo htmlspecialchars($l['href']); ?>" class="hover:text-[#C01858] transition-colors">
                <?php echo htmlspecialchars($l['label']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Services (3 Cols) -->
      <div class="lg:col-span-3">
        <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-4 font-heading">
          Services
        </h4>
        <ul class="space-y-2 text-sm text-[#475569] font-medium font-body">
          <?php foreach (array_slice($servicesData, 0, 6) as $s): ?>
            <li>
              <a href="#services" class="hover:text-[#C01858] transition-colors">
                <?php echo htmlspecialchars($s['title']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Contact Info (3 Cols) -->
      <div class="lg:col-span-3">
        <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-4 font-heading">
          Address
        </h4>
        <div class="space-y-3 text-xs text-[#475569] font-body">
          <div class="flex items-center gap-2.5">
            <i data-lucide="mail" class="w-4 h-4 text-[#FF6B00] shrink-0"></i>
            <a href="mailto:<?php echo htmlspecialchars($companyInfo['email']); ?>" class="font-semibold text-[#0F172A] hover:text-[#C01858] transition-colors"><?php echo htmlspecialchars($companyInfo['email']); ?></a>
          </div>
          <div class="flex items-center gap-2.5">
            <i data-lucide="phone" class="w-4 h-4 text-[#FF6B00] shrink-0"></i>
            <a href="tel:<?php echo htmlspecialchars(str_replace(' ', '', $companyInfo['phone'])); ?>" class="font-bold text-[#0F172A] font-stat hover:text-[#C01858] transition-colors"><?php echo htmlspecialchars($companyInfo['phone']); ?></a>
          </div>
          <div class="flex items-start gap-2.5">
            <i data-lucide="map-pin" class="w-4 h-4 text-[#FF6B00] shrink-0 mt-0.5"></i>
            <span><?php echo htmlspecialchars($companyInfo['address']); ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#475569] font-medium font-body">
      <div>
        <?php echo htmlspecialchars($companyInfo['copyright']); ?>
      </div>
      <div class="flex items-center gap-6">
        <a href="#" class="hover:text-[#C01858] transition-colors">Privacy Policy</a>
        <a href="#" class="hover:text-[#C01858] transition-colors">Terms of Service</a>
        <a href="#" class="hover:text-[#C01858] transition-colors">Security</a>
        <button
          onclick="window.scrollTo({top: 0, behavior: 'smooth'});"
          class="glass-btn-secondary px-3.5 py-1.5 rounded-xl inline-flex items-center gap-1.5 text-[#0F172A] hover:text-[#C01858] hover:border-[#C01858] transition-colors cursor-pointer shadow-xs"
        >
          <span>Back to top</span>
          <i data-lucide="arrow-up" class="w-3.5 h-3.5"></i>
        </button>
      </div>
    </div>
  </div>
</footer>

<!-- Core Script -->
<script src="assets/js/main.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/main.js'); ?>"></script>

<!-- React Bits GooeyNav Interactive Engine -->
<script src="assets/js/gooey-nav.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/gooey-nav.js'); ?>"></script>

<!-- 3D Orbit Services Interactive Engine (Dominik Koch Architecture) -->
<script src="assets/js/orbit.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/orbit.js'); ?>"></script>
</body>
</html>
