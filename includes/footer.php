<?php
if (!isset($navLinks) || !isset($servicesData)) {
    require_once __DIR__ . '/data.php';
}
?>
</main>

<footer class="relative z-10 bg-white border-t border-[#F1E6EE] pt-10 sm:pt-16 md:pt-20 pb-8 sm:pb-12 overflow-hidden shadow-xs">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8 sm:gap-10 pb-10 sm:pb-16 border-b border-[#F1E6EE]">
      
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
            href="https://instagram.com"
            target="_blank"
            rel="noopener noreferrer"
            class="glass-btn-secondary w-9 h-9 rounded-xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs transition-colors"
            aria-label="Instagram"
          >
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
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
            <a href="tel:<?php echo htmlspecialchars(str_replace(' ', '', $companyInfo['phone'])); ?>" class="font-semibold text-[#0F172A] hover:text-[#C01858] transition-colors"><?php echo htmlspecialchars($companyInfo['phone']); ?></a>
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
          onclick="if (window.__lenis) { window.__lenis.scrollTo(0, { duration: 1.2 }); } else { window.scrollTo({top: 0, behavior: 'smooth'}); }"
          class="glass-btn-secondary px-3.5 py-1.5 rounded-xl inline-flex items-center gap-1.5 text-[#0F172A] hover:text-[#C01858] hover:border-[#C01858] transition-colors cursor-pointer shadow-xs"
        >
          <span>Back to top</span>
          <i data-lucide="arrow-up" class="w-3.5 h-3.5"></i>
        </button>
      </div>
    </div>
  </div>
</footer>

<!-- Lenis Smooth Scroll Engine (Momentum-based 60/120 FPS Fluid Scroll) -->
<script src="assets/js/lenis.min.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/lenis.min.js'); ?>"></script>

<!-- Core Script -->
<script src="assets/js/main.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/main.js'); ?>"></script>

<!-- React Bits GooeyNav Interactive Engine -->
<script src="assets/js/gooey-nav.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/gooey-nav.js'); ?>"></script>

<!-- 3D Orbit Services Interactive Engine (Dominik Koch Architecture) -->
<script src="assets/js/orbit.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/orbit.js'); ?>"></script>
</body>
</html>
