<?php
if (!isset($companyInfo)) {
    require_once __DIR__ . '/data.php';
}

$pageTitle = $pageTitle ?? $companyInfo['title'];
$pageDescription = $pageDescription ?? 'Building Digital Solutions That Move Businesses Forward. Shree Tech is an enterprise software engineering and technical consulting firm.';
$currentPage = $currentPage ?? 'home';

if (!headers_sent()) {
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
  <meta name="theme-color" content="#ffffff">

  <!-- Open Graph -->
  <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
  <meta property="og:type" content="website">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/logo-icon.png">
  <link rel="apple-touch-icon" href="images/logo-icon.png">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

  <!-- Pre-Compiled Tailwind CSS (Zero runtime MutationObserver / JIT overhead) -->
  <link rel="stylesheet" href="assets/css/tailwind.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/tailwind.css'); ?>">

  <!-- Lucide Icons (Local UMD bundle: zero blocking external CDN network dependency) -->
  <script src="assets/js/lucide.min.js?v=<?php echo filemtime(__DIR__ . '/../assets/js/lucide.min.js'); ?>" defer></script>

  <!-- Signature Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/style.css'); ?>">

  <!-- React Bits GooeyNav Stylesheet -->
  <link rel="stylesheet" href="assets/css/gooey-nav.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/gooey-nav.css'); ?>">

  <!-- 3D Orbit Services Stylesheet -->
  <link rel="stylesheet" href="assets/css/orbit.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/orbit.css'); ?>">
</head>
<body class="bg-white text-[#1E293B] min-h-screen flex flex-col selection:bg-[#FF6B00]/15 selection:text-[#C01858] relative">

  <!-- Fixed Brand Watermark Centered Behind Desktop Content Layers -->
  <div
    aria-hidden="true"
    class="hidden md:flex fixed inset-x-0 top-20 bottom-0 z-0 pointer-events-none items-center justify-center overflow-hidden"
    style="transform: translateZ(0);"
  >
    <div class="relative flex items-center justify-center w-[min(48vw,336px)] h-[min(48vw,336px)]">
      <div
        class="absolute -inset-6 rounded-full pointer-events-none"
        style="background: radial-gradient(circle, rgba(255, 107, 0, 0.06) 0%, rgba(192, 24, 88, 0.04) 45%, transparent 72%);"
      ></div>
      <img
        src="images/logo-icon.png"
        alt="Shree Tech Logo Watermark"
        decoding="async"
        class="relative w-full h-full object-contain opacity-[0.045] select-none"
      >
    </div>
  </div>

<?php require_once __DIR__ . '/navbar.php'; ?>
<main class="flex-1 relative z-10">
