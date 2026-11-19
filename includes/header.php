<?php
if (!isset($companyInfo)) {
    require_once __DIR__ . '/data.php';
}

$pageTitle = $pageTitle ?? $companyInfo['title'];
$pageDescription = $pageDescription ?? 'Building Digital Solutions That Move Businesses Forward. Shree Tech is an enterprise software engineering and technical consulting firm.';
$currentPage = $currentPage ?? 'home';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
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

  <!-- Tailwind CSS via CDN with Brand Color Theme Configuration -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brandOrange: '#FF6B00',
            brandMagenta: '#C01858',
            brandPurple: '#8B5CF6',
            heading: '#0F172A',
            body: '#475569',
            borderCustom: '#F1E6EE',
            tintOrange: '#FFF4EA',
            tintMagenta: '#FFF0F5',
            tintPurple: '#F5F0FF',
          },
          fontFamily: {
            heading: ['Outfit', 'Plus Jakarta Sans', 'system-ui', 'sans-serif'],
            body: ['Plus Jakarta Sans', 'system-ui', 'sans-serif'],
            stat: ['Outfit', 'Plus Jakarta Sans', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>

  <!-- Signature Stylesheet -->
  <link rel="stylesheet" href="assets/css/style.css">

  <!-- React Bits GooeyNav Stylesheet -->
  <link rel="stylesheet" href="assets/css/gooey-nav.css">
</head>
<body class="bg-white text-[#475569] min-h-screen flex flex-col antialiased selection:bg-[#FF6B00]/15 selection:text-[#C01858] relative">

  <!-- Fixed Brand Watermark Centered Behind Glassmorphism Layers -->
  <div
    aria-hidden="true"
    class="fixed inset-x-0 top-20 bottom-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden"
  >
    <div class="relative flex items-center justify-center w-[min(78vw,560px)] h-[min(78vw,560px)]">
      <div class="absolute inset-12 rounded-full bg-gradient-to-tr from-[#FF6B00]/15 via-[#C01858]/15 to-[#8B5CF6]/10 blur-[90px]"></div>
      <img
        src="images/logo-icon.png"
        alt="Shree Tech Logo Watermark"
        class="relative w-full h-full object-contain opacity-[0.20] select-none filter drop-shadow-[0_0_48px_rgba(255,107,0,0.22)]"
      >
    </div>
  </div>

<?php require_once __DIR__ . '/navbar.php'; ?>
<main class="flex-1 relative z-10">
