<?php
if (!isset($navLinks) || !isset($servicesData)) {
    require_once __DIR__ . '/data.php';
}

$techPills = ['Next.js', 'React', 'TypeScript', 'Node.js', 'Python', 'AWS', 'Flutter', 'PostgreSQL'];
?>
</main>

<footer class="relative z-10 bg-white border-t border-[#F1E6EE] mt-16 sm:mt-20 pt-16 sm:pt-20 pb-12 overflow-hidden shadow-xs">
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-10 pb-16 border-b border-[#F1E6EE]">
      
      <!-- Brand Info (4 Cols) -->
      <div class="lg:col-span-4 space-y-4">
        <a href="index.php" class="flex items-center gap-3 group">
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
          Shree Tech is an enterprise software engineering and technology consulting company. We
          architect, design, and engineer custom digital solutions with clean, precision architecture.
        </p>

        <!-- Social Channels -->
        <div class="flex items-center gap-2.5 pt-2">
          <a
            href="https://github.com"
            target="_blank"
            rel="noopener noreferrer"
            class="glass-btn-secondary w-9 h-9 rounded-xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs"
            aria-label="GitHub"
          >
            <i data-lucide="github" class="w-4 h-4"></i>
          </a>
          <a
            href="https://linkedin.com"
            target="_blank"
            rel="noopener noreferrer"
            class="glass-btn-secondary w-9 h-9 rounded-xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs"
            aria-label="LinkedIn"
          >
            <i data-lucide="linkedin" class="w-4 h-4"></i>
          </a>
          <a
            href="https://x.com"
            target="_blank"
            rel="noopener noreferrer"
            class="glass-btn-secondary w-9 h-9 rounded-xl text-[#475569] hover:text-[#C01858] hover:border-[#C01858] flex items-center justify-center cursor-pointer shadow-xs"
            aria-label="Twitter / X"
          >
            <i data-lucide="twitter" class="w-4 h-4"></i>
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
              <a href="services.php" class="hover:text-[#C01858] transition-colors">
                <?php echo htmlspecialchars($s['title']); ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- Technologies & Contact Info (3 Cols) -->
      <div class="lg:col-span-3 space-y-6">
        <div>
          <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F172A] mb-3 font-heading">
            Core Technologies
          </h4>
          <div class="flex flex-wrap gap-1.5">
            <?php foreach ($techPills as $t): ?>
              <span class="glass-pill px-2.5 py-1 rounded-xl text-xs text-[#475569] font-medium font-body bg-[#F5F0FF] border border-[#F1E6EE]">
                <?php echo htmlspecialchars($t); ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="space-y-2 text-xs text-[#475569] pt-2 border-t border-[#F1E6EE] font-body">
          <div class="flex items-center gap-2">
            <i data-lucide="mail" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
            <span class="font-semibold text-[#0F172A]"><?php echo htmlspecialchars($companyInfo['email']); ?></span>
          </div>
          <div class="flex items-center gap-2">
            <i data-lucide="phone" class="w-3.5 h-3.5 text-[#FF6B00]"></i>
            <span class="font-bold text-[#0F172A] font-stat"><?php echo htmlspecialchars($companyInfo['phone']); ?></span>
          </div>
          <div class="flex items-start gap-2">
            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#FF6B00] mt-0.5"></i>
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
<script src="assets/js/main.js"></script>

<!-- React Bits GooeyNav Interactive Engine -->
<script src="assets/js/gooey-nav.js"></script>
</body>
</html>
