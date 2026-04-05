<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?><?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq' ?></title>
    <meta name="description" content="<?= isset($profil) && $profil ? $profil->deskripsi_singkat : 'Website Profil Yayasan Ar-Razaq' ?>">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hijau': {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                            950: '#052e16',
                        },
                        'kuning': {
                            50: '#fefce8',
                            100: '#fef9c3',
                            200: '#fef08a',
                            300: '#fde047',
                            400: '#facc15',
                            500: '#eab308',
                            600: '#ca8a04',
                            700: '#a16207',
                        }
                    },
                    fontFamily: {
                        'arabic': ['Scheherazade New', 'serif'],
                        'display': ['Playfair Display', 'serif'],
                        'body': ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Scheherazade+New:wght@400;700&display=swap" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <!-- GSAP + Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <!-- Lenis Smooth Scroll -->
    <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.18/dist/lenis.min.js"></script>

    <!-- SplitType for text animations -->
    <script src="https://cdn.jsdelivr.net/npm/split-type@0.3.4/umd/index.min.js"></script>

    <style>
        /* ============================================================
           BASE TYPOGRAPHY
           ============================================================ */
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-display {
            font-family: 'Playfair Display', serif;
        }

        .font-arabic {
            font-family: 'Scheherazade New', serif;
        }

        /* ============================================================
           LENIS SMOOTH SCROLL
           ============================================================ */
        html.lenis, html.lenis body {
            height: auto;
        }

        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }

        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }

        .lenis.lenis-stopped {
            overflow: hidden;
        }

        /* ============================================================
           CUSTOM SCROLLBAR
           ============================================================ */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #166534, #15803d);
            border-radius: 10px;
        }

        /* ============================================================
           NAVBAR
           ============================================================ */
        #navbar {
            transform: translateY(-100%);
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1),
                background-color 0.4s ease,
                box-shadow 0.4s ease;
        }

        #navbar.visible {
            transform: translateY(0);
        }

        #navbar.scrolled {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            box-shadow: 0 1px 40px rgba(5, 46, 22, 0.08);
        }

        /* ============================================================
           SECTION REVEAL BASE STATES
           ============================================================ */
        .reveal {
            opacity: 0;
            transform: translateY(50px);
            will-change: transform, opacity;
        }

        .reveal-left {
            opacity: 0;
            transform: translateX(-80px);
            will-change: transform, opacity;
        }

        .reveal-right {
            opacity: 0;
            transform: translateX(80px);
            will-change: transform, opacity;
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(0.85);
            will-change: transform, opacity;
        }

        /* ============================================================
           ORNAMENTAL DIVIDER
           ============================================================ */
        .ornament-divider {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .ornament-divider::before,
        .ornament-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(22, 101, 52, 0.3), transparent);
        }

        /* ============================================================
           ISLAMIC PATTERN
           ============================================================ */
        .pattern-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23166534' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* ============================================================
           GRADIENT TEXT
           ============================================================ */
        .gradient-text {
            background: linear-gradient(135deg, #166534 0%, #15803d 50%, #ca8a04 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ============================================================
           CARD EFFECTS
           ============================================================ */
        .card-hover {
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1),
                box-shadow 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-hover:hover {
            transform: translateY(-10px) scale(1.01);
            box-shadow: 0 30px 60px rgba(5, 46, 22, 0.12);
        }

        .card-3d {
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            transform-style: preserve-3d;
            perspective: 1000px;
        }

        /* ============================================================
           FLOATING ANIMATIONS
           ============================================================ */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-15px) rotate(1deg); }
            66% { transform: translateY(-8px) rotate(-1deg); }
        }

        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(3deg); }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(234, 179, 8, 0.3); }
            50% { box-shadow: 0 0 40px rgba(234, 179, 8, 0.6); }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .floating {
            animation: float 8s ease-in-out infinite;
        }

        .floating-slow {
            animation: floatSlow 12s ease-in-out infinite;
        }

        .floating-delay {
            animation: float 8s ease-in-out 3s infinite;
        }

        .spin-slow {
            animation: spin-slow 30s linear infinite;
        }

        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .animated-gradient {
            background-size: 200% 200%;
            animation: gradientMove 8s ease infinite;
        }

        /* ============================================================
           IMAGE OVERLAY
           ============================================================ */
        .img-overlay {
            background: linear-gradient(to top, rgba(5, 46, 22, 0.9) 0%, rgba(5, 46, 22, 0.3) 50%, transparent 100%);
        }

        /* ============================================================
           GRAIN TEXTURE OVERLAY
           ============================================================ */
        .grain::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise' x='0' y='0'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
        }

        /* ============================================================
           WAVE SECTION DIVIDERS
           ============================================================ */
        .wave-divider {
            position: absolute;
            left: 0;
            right: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave-divider svg {
            display: block;
            width: 100%;
            height: auto;
        }

        .wave-top {
            top: -1px;
        }

        .wave-bottom {
            bottom: -1px;
        }

        /* ============================================================
           HORIZONTAL SCROLL GALLERY
           ============================================================ */
        .horizontal-scroll-wrapper {
            display: flex;
            gap: 24px;
            will-change: transform;
        }

        .horizontal-scroll-wrapper .gallery-card {
            flex-shrink: 0;
            width: 350px;
            height: 420px;
        }

        @media (max-width: 768px) {
            .horizontal-scroll-wrapper .gallery-card {
                width: 280px;
                height: 340px;
            }
        }

        /* ============================================================
           SPLIT TEXT ANIMATION
           ============================================================ */
        .split-text .char {
            display: inline-block;
            will-change: transform, opacity;
        }

        .split-text .word {
            display: inline-block;
            overflow: hidden;
        }

        /* ============================================================
           COUNTER NUMBER
           ============================================================ */
        .counter-number {
            display: inline-block;
            font-variant-numeric: tabular-nums;
        }

        /* ============================================================
           TIMELINE
           ============================================================ */
        .timeline-progress {
            transform-origin: top center;
            transform: scaleY(0);
            will-change: transform;
        }

        /* ============================================================
           MOBILE MENU
           ============================================================ */
        #mobile-menu {
            transition: max-height 0.5s cubic-bezier(0.16, 1, 0.3, 1),
                opacity 0.4s ease;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }

        #mobile-menu.open {
            max-height: 500px;
            opacity: 1;
        }

        /* ============================================================
           MAGNETIC BUTTON
           ============================================================ */
        .magnetic-btn {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* ============================================================
           LINE CLAMP
           ============================================================ */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ============================================================
           PARTICLES
           ============================================================ */
        .particle {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            will-change: transform, opacity;
        }
    </style>
</head>

<body class="bg-white text-gray-800 overflow-x-hidden">

    <!-- ============================================================ -->
    <!-- NAVBAR -->
    <!-- ============================================================ -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <a href="<?= base_url() ?>" class="flex items-center gap-3 group">
                    <?php if (isset($profil) && $profil && $profil->logo): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $profil->logo) ?>" alt="Logo" class="h-10 w-10 object-contain">
                    <?php else: ?>
                        <div class="w-10 h-10 bg-gradient-to-br from-hijau-800 to-hijau-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-hijau-800/30 transition-shadow">
                            <span class="text-white font-arabic text-lg font-bold">ر</span>
                        </div>
                    <?php endif; ?>
                    <div>
                        <div class="font-display font-bold text-hijau-900 text-sm leading-tight">
                            <?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq' ?>
                        </div>
                        <div class="text-xs text-hijau-600/70 font-medium">Pesantren Modern</div>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden lg:flex items-center gap-1">
                    <?php
                    $current_url = current_url();
                    $nav_items = [
                        ['url' => base_url(), 'label' => 'Beranda'],
                        ['url' => '#sejarah', 'label' => 'Profil'],
                        ['url' => '#galeri', 'label' => 'Galeri'],
                        ['url' => '#ekskul', 'label' => 'Ekskul'],
                        ['url' => base_url('berita'), 'label' => 'Berita'],
                        ['url' => base_url('ppdb'), 'label' => 'PPDB'],
                    ];
                    foreach ($nav_items as $item):
                    ?>
                        <a href="<?= $item['url'] ?>" class="px-4 py-2 rounded-xl text-sm font-semibold text-hijau-900/80 hover:text-hijau-900 hover:bg-hijau-50 transition-all duration-300 relative group">
                            <?= $item['label'] ?>
                            <span class="absolute bottom-1 left-4 right-4 h-0.5 bg-gradient-to-r from-hijau-600 to-kuning-500 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left rounded-full"></span>
                        </a>
                    <?php endforeach; ?>
                    <a href="<?= base_url('ppdb') ?>" class="magnetic-btn ml-3 bg-gradient-to-r from-hijau-800 to-hijau-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:shadow-lg hover:shadow-hijau-800/25 transition-all duration-500 hover:-translate-y-0.5">
                        Daftar Santri
                    </a>
                </div>

                <!-- Mobile Toggle -->
                <button id="menu-toggle" class="lg:hidden p-2 rounded-xl text-hijau-800 hover:bg-hijau-50 transition-colors">
                    <i data-feather="menu" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden bg-white/95 backdrop-blur-xl border-t border-hijau-100/50 rounded-b-2xl">
                <div class="py-4 space-y-1">
                    <?php foreach ($nav_items as $item): ?>
                        <a href="<?= $item['url'] ?>" class="block px-4 py-3 text-sm font-semibold text-hijau-900 hover:bg-hijau-50 rounded-xl mx-2 transition-colors">
                            <?= $item['label'] ?>
                        </a>
                    <?php endforeach; ?>
                    <div class="px-2 pt-2">
                        <a href="<?= base_url('ppdb') ?>" class="block text-center bg-gradient-to-r from-hijau-800 to-hijau-700 text-white px-4 py-3 rounded-xl text-sm font-bold">
                            Daftar Santri Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>