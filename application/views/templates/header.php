<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= isset($title) ? $title . ' - ' : '' ?><?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq' ?>
    </title>
    <meta name="description"
        content="<?= isset($profil) && $profil ? $profil->deskripsi_singkat : 'Website Profil Yayasan Ar-Razaq' ?>">

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
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Scheherazade+New:wght@400;700&display=swap"
        rel="stylesheet">

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
        html.lenis,
        html.lenis body {
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
           NAVBAR STATES (Top vs Scrolled/Floating)
           ============================================================ */
        #navbar {
            padding-top: 0;
            transition: padding 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        #navbar-wrap {
            transition: padding 0.45s ease, max-width 0.45s ease;
        }

        /* State awal: navbar mentok kiri-kanan viewport */
        #navbar:not(.scrolled) #navbar-wrap {
            max-width: 100%;
            padding-left: 0;
            padding-right: 0;
        }

        #navbar-shell {
            position: relative;
            border-radius: 0;
            border: 1px solid transparent;
            background: linear-gradient(180deg, rgba(5, 46, 22, 0.72) 0%, rgba(5, 46, 22, 0.52) 100%);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18);
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1),
                border-radius 0.5s cubic-bezier(0.16, 1, 0.3, 1),
                background-color 0.45s ease,
                border-color 0.45s ease,
                box-shadow 0.45s ease,
                margin 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: visible;
        }

        #navbar-shell::after {
            content: '';
            position: absolute;
            top: 0;
            left: -45%;
            width: 35%;
            height: 100%;
            background: linear-gradient(110deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.36) 50%,
                    transparent 100%);
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s ease;
        }

        #navbar.scrolled {
            padding-top: 12px;
        }

        /* State scroll: navbar dibuat lebih compact */
        #navbar.scrolled #navbar-wrap {
            max-width: min(1380px, calc(100vw - 104px));
            padding-left: 6px;
            padding-right: 6px;
        }

        #navbar.scrolled #navbar-shell {
            margin: 0;
            border-radius: 20px;
            border-color: rgba(255, 255, 255, 0.24);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.94) 0%, rgba(245, 255, 250, 0.93) 100%);
            box-shadow: 0 16px 36px rgba(5, 46, 22, 0.18);
            transform: translateY(0) scale(0.998);
        }

        #navbar.scrolled #navbar-shell::after {
            opacity: 1;
            animation: navSweep 1.1s ease;
        }

        @keyframes navSweep {
            0% {
                left: -45%;
            }

            100% {
                left: 120%;
            }
        }

        /* Nav link: light on top, dark when scrolled */
        .nav-link-front {
            color: rgba(255, 255, 255, 0.9);
            transition: color 0.4s ease, background-color 0.3s ease;
        }

        .nav-link-front:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.12);
        }

        #navbar.scrolled .nav-link-front {
            color: rgba(20, 83, 45, 0.82);
        }

        #navbar.scrolled .nav-link-front:hover {
            color: #14532d;
            background: #f0fdf4;
        }

        /* Profil dropdown */
        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown-toggle {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-dropdown-caret {
            transition: transform 0.3s ease;
        }

        .nav-dropdown-menu {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 220px;
            padding: 8px;
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: rgba(5, 46, 22, 0.94);
            box-shadow: 0 16px 30px rgba(2, 6, 23, 0.24);
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px) scale(0.98);
            transition: opacity 0.25s ease, visibility 0.25s ease, transform 0.25s ease;
            z-index: 120;
        }

        #navbar.scrolled .nav-dropdown-menu {
            background: rgba(255, 255, 255, 0.98);
            border-color: rgba(20, 83, 45, 0.12);
            box-shadow: 0 20px 34px rgba(20, 83, 45, 0.14);
        }

        .nav-dropdown:hover .nav-dropdown-menu,
        .nav-dropdown:focus-within .nav-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .nav-dropdown:hover .nav-dropdown-caret,
        .nav-dropdown:focus-within .nav-dropdown-caret {
            transform: rotate(180deg);
        }

        .nav-dropdown-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            border-radius: 10px;
            padding: 10px 12px;
            color: rgba(255, 255, 255, 0.92);
            font-size: 13px;
            font-weight: 600;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        .nav-dropdown-item:hover {
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
        }

        #navbar.scrolled .nav-dropdown-item {
            color: rgba(20, 83, 45, 0.88);
        }

        #navbar.scrolled .nav-dropdown-item:hover {
            background: #f0fdf4;
            color: #14532d;
        }

        /* Logo text color transition */
        .logo-name {
            color: #ffffff;
            transition: color 0.4s ease;
        }

        .logo-subtitle {
            color: rgba(255, 255, 255, 0.66);
            transition: color 0.4s ease;
        }

        #navbar.scrolled .logo-name {
            color: #14532d;
        }

        #navbar.scrolled .logo-subtitle {
            color: rgba(21, 128, 61, 0.72);
        }

        /* CTA button transitions between states */
        #nav-cta-btn {
            background: rgba(250, 204, 21, 0.95);
            color: #052e16;
            box-shadow: 0 10px 24px rgba(250, 204, 21, 0.26);
            transition: background-color 0.35s ease, color 0.35s ease, box-shadow 0.35s ease;
        }

        #nav-cta-btn:hover {
            background: #fde047;
        }

        #navbar.scrolled #nav-cta-btn {
            background: #14532d;
            color: #ffffff;
            box-shadow: 0 10px 24px rgba(20, 83, 45, 0.28);
        }

        #navbar.scrolled #nav-cta-btn:hover {
            background: #166534;
        }

        /* Nav indicator */
        .nav-link-front .nav-indicator {
            background: linear-gradient(to right, #facc15, #eab308);
        }

        #navbar.scrolled .nav-link-front .nav-indicator {
            background: linear-gradient(to right, #166534, #eab308);
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
            transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-hover:hover {
            transform: translateY(-6px);
        }

        .card-hover-soft:hover {
            transform: translateY(-4px);
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

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-15px) rotate(1deg);
            }

            66% {
                transform: translateY(-8px) rotate(-1deg);
            }
        }

        @keyframes floatSlow {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-25px) rotate(3deg);
            }
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.88; }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
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
            will-change: auto;
            transform: translateZ(0);
        }

        /* ============================================================
           WAVE SECTION DIVIDERS
           ============================================================ */
        .wave-divider {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 100vw;
            min-width: 100%;
            overflow: visible;
            line-height: 0;
            pointer-events: none;
            z-index: 6;
        }

        .wave-divider svg {
            display: block;
            /* Bigger overscan to prevent edge clipping on any zoom/device */
            width: calc(100% + 24px);
            margin-left: -12px;
            height: auto;
            min-height: 60px;
            transform: translateZ(0);
            shape-rendering: geometricPrecision;
        }

        .wave-bottom {
            bottom: -4px;
        }

        .wave-top {
            top: -4px;
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
        <div id="navbar-wrap" class="container mx-auto px-4 lg:px-8">
            <div id="navbar-shell">
                <div class="flex items-center justify-between h-16 lg:h-20 px-3 lg:px-5">
                    <!-- Logo -->
                    <a href="<?= base_url() ?>" class="flex items-center gap-3 group">
                        <?php if (isset($profil) && $profil && $profil->logo): ?>
                            <img src="<?= base_url('assets/images/uploads/profil/' . $profil->logo) ?>" alt="Logo"
                                class="h-10 w-10 object-contain">
                        <?php else: ?>
                            <div
                                class="w-10 h-10 bg-hijau-800 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-hijau-800/30 transition-shadow">
                                <span class="text-white font-arabic text-lg font-bold">ر</span>
                            </div>
                        <?php endif; ?>
                        <div>
                            <div class="logo-name font-display font-bold text-sm leading-tight">
                                <?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq' ?>
                            </div>
                            <div class="logo-subtitle text-xs font-medium">Pesantren Modern</div>
                        </div>
                    </a>

                    <!-- Desktop Nav -->
                    <div class="hidden lg:flex items-center gap-1">
                        <?php
                        $current_url = current_url();
                        $nav_items = [
                            ['url' => base_url(), 'label' => 'Beranda', 'scroll_top' => true],
                            [
                                'label' => 'Profil',
                                'children' => [
                                    ['url' => base_url('tentang-kami'), 'label' => 'Tentang Kami'],
                                    ['url' => base_url('struktur'), 'label' => 'Struktur'],
                                ],
                            ],
                            ['url' => base_url('galeri'), 'label' => 'Galeri'],
                            ['url' => base_url('ekskul'), 'label' => 'Ekskul'],
                            ['url' => base_url('berita'), 'label' => 'Berita'],
                            ['url' => base_url('ppdb'), 'label' => 'PPDB'],
                        ];
                        foreach ($nav_items as $item):
                            if (!empty($item['children'])):
                                $first_child_url = $item['children'][0]['url'];
                            ?>
                                <div class="nav-dropdown group">
                                    <a href="<?= $first_child_url ?>" class="nav-link-front nav-dropdown-toggle px-4 py-2 rounded-xl text-sm font-semibold relative group">
                                        <?= $item['label'] ?>
                                        <i data-feather="chevron-down" class="nav-dropdown-caret w-4 h-4"></i>
                                        <span
                                            class="nav-indicator absolute bottom-1 left-4 right-4 h-0.5 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left rounded-full"></span>
                                    </a>
                                    <div class="nav-dropdown-menu">
                                        <?php foreach ($item['children'] as $child): ?>
                                            <a href="<?= $child['url'] ?>" class="nav-dropdown-item">
                                                <span><?= $child['label'] ?></span>
                                                <i data-feather="arrow-up-right" class="w-3.5 h-3.5 opacity-70"></i>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php else:
                                $scroll_top_attr = !empty($item['scroll_top']) ? 'data-scroll-top="1"' : '';
                            ?>
                                <a href="<?= $item['url'] ?>"
                                    <?= $scroll_top_attr ?>
                                    class="nav-link-front px-4 py-2 rounded-xl text-sm font-semibold relative group">
                                    <?= $item['label'] ?>
                                    <span
                                        class="nav-indicator absolute bottom-1 left-4 right-4 h-0.5 scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left rounded-full"></span>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <a href="<?= base_url('ppdb') ?>" id="nav-cta-btn"
                            class="magnetic-btn ml-3 px-6 py-2.5 rounded-xl text-sm font-bold hover:shadow-lg transition-all duration-500 hover:-translate-y-0.5">
                            Daftar Santri
                        </a>
                    </div>

                    <!-- Mobile Toggle -->
                    <button id="menu-toggle"
                        class="lg:hidden p-2 rounded-xl text-white hover:bg-white/10 transition-colors" aria-label="Menu">
                        <i data-feather="menu" class="w-6 h-6"></i>
                    </button>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu"
                    class="lg:hidden bg-white/95 backdrop-blur-xl border-t border-hijau-100/50 rounded-b-2xl">
                    <div class="py-4 space-y-1">
                        <?php foreach ($nav_items as $item): ?>
                            <?php if (!empty($item['children'])): ?>
                                <div class="px-4 pt-2 pb-1 text-[11px] uppercase tracking-wide font-bold text-hijau-600/80">
                                    <?= $item['label'] ?>
                                </div>
                                <?php foreach ($item['children'] as $child): ?>
                                    <a href="<?= $child['url'] ?>"
                                        class="block pl-8 pr-4 py-2.5 text-sm font-semibold text-hijau-900 hover:bg-hijau-50 rounded-xl mx-2 transition-colors">
                                        <?= $child['label'] ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <a href="<?= $item['url'] ?>"
                                    <?= !empty($item['scroll_top']) ? 'data-scroll-top="1"' : '' ?>
                                    class="block px-4 py-3 text-sm font-semibold text-hijau-900 hover:bg-hijau-50 rounded-xl mx-2 transition-colors">
                                    <?= $item['label'] ?>
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="px-2 pt-2">
                            <a href="<?= base_url('ppdb') ?>"
                                class="block text-center bg-hijau-800 text-white px-4 py-3 rounded-xl text-sm font-bold">
                                Daftar Santri Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
