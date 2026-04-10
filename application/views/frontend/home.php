<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
// Build hero slides array from profil fields
$hero_slides = [];
$hero_overlay_color = isset($profil) && $profil && !empty($profil->hero_overlay_color) ? $profil->hero_overlay_color : '#052e16';
$hero_overlay_opacity = isset($profil) && $profil && isset($profil->hero_overlay_opacity) ? $profil->hero_overlay_opacity : 70;

$hero_fields = ['hero_image', 'hero_image_2', 'hero_image_3', 'hero_image_4', 'hero_image_5'];
foreach ($hero_fields as $field) {
    if (isset($profil) && $profil && !empty($profil->$field)) {
        $hero_slides[] = base_url('assets/images/uploads/profil/' . $profil->$field);
    }
}
$has_slider = count($hero_slides) > 1;
$hero_title = isset($profil) && $profil && !empty($profil->hero_title) ? $profil->hero_title : (isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq');
$hero_subtitle = isset($profil) && $profil && !empty($profil->hero_subtitle) ? $profil->hero_subtitle : (isset($profil) && $profil && $profil->tagline ? $profil->tagline : 'Membentuk Generasi Qurani yang Berakhlak Mulia');
?>

<!-- ============================================================ -->
<!-- HERO SECTION — FULLSCREEN SLIDER (REDESIGNED)                 -->
<!-- ============================================================ -->
<section id="hero" class="relative min-h-screen flex items-end overflow-hidden bg-hijau-950" style="padding-top:44px;">

    <!-- Slide Images -->
    <?php if (!empty($hero_slides)): ?>
        <div id="hero-slides-container" class="absolute inset-0 z-[1]">
            <?php foreach ($hero_slides as $idx => $slide_url): ?>
                <div class="hero-slide absolute inset-0 transition-opacity duration-[1200ms] ease-in-out <?= $idx === 0 ? 'opacity-100' : 'opacity-0' ?>"
                    data-slide="<?= $idx ?>">
                    <img src="<?= $slide_url ?>" alt="Hero Slide <?= $idx + 1 ?>"
                        class="w-full h-full object-cover">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Layered Overlay: subtle vignette + gradient for text legibility -->
    <div class="absolute inset-0 z-[2]"
        style="background: linear-gradient(to top, <?= $hero_overlay_color ?>f0 0%, <?= $hero_overlay_color ?>80 35%, <?= $hero_overlay_color ?><?= dechex(intval($hero_overlay_opacity * 1.8)) ?> 100%);"></div>

    <!-- Subtle pattern overlay for depth -->
    <div class="absolute inset-0 z-[3] pattern-bg opacity-[0.04]"></div>

    <!-- Thin top accent line (brand identity) -->
    <div class="absolute top-[44px] left-0 right-0 z-[5] h-[3px]"
        style="background: linear-gradient(90deg, transparent 0%, #facc15 40%, #eab308 60%, transparent 100%); opacity: 0.7;"></div>

    <!-- Hero Content — sits at bottom -->
    <div id="hero-content" class="relative z-10 w-full pb-32 md:pb-44">
        <div class="container mx-auto px-4 lg:px-8">

            <!-- Decorative left border accent -->
            <div class="flex items-start gap-6">
                <div class="hidden md:block w-[3px] h-24 mt-2 rounded-full flex-shrink-0"
                    style="background: linear-gradient(to bottom, #facc15, transparent);"></div>

                <div class="flex-1">
                    <!-- Arabic Basmallah -->
                    <div id="hero-arabic" class="font-arabic text-kuning-400/60 text-lg md:text-xl mb-4 opacity-0 translate-y-6 tracking-wider">
                        بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيمِ
                    </div>

                    <h1 id="hero-title"
                        class="font-display text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-5 leading-tight opacity-0 max-w-4xl split-text"
                        style="text-shadow: 0 2px 24px rgba(0,0,0,0.35);">
                        <?= $hero_title ?>
                    </h1>

                    <!-- Divider line -->
                    <div id="hero-divider" class="flex items-center gap-4 mb-5 opacity-0">
                        <div class="h-px w-12 bg-kuning-500/60"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-kuning-400/60"></div>
                        <div class="h-px w-6 bg-white/20"></div>
                    </div>

                    <p id="hero-tagline"
                        class="text-white/60 text-base md:text-lg mb-10 font-normal max-w-2xl leading-relaxed opacity-0 translate-y-6">
                        <?= $hero_subtitle ?>
                    </p>

                    <!-- CTA Buttons -->
                    <div id="hero-cta" class="flex flex-col sm:flex-row gap-3 opacity-0 translate-y-6">
                        <a href="<?= base_url('ppdb') ?>"
                            class="magnetic-btn inline-flex items-center justify-center gap-2 bg-kuning-400 text-hijau-950 font-bold px-7 py-3.5 rounded-xl text-sm transition-all duration-300 hover:-translate-y-0.5 hover:bg-kuning-300 shadow-lg shadow-kuning-500/25">
                            <i data-feather="user-plus" class="w-4 h-4"></i>
                            Daftar Santri Baru
                        </a>
                        <a href="#sejarah"
                            class="magnetic-btn inline-flex items-center justify-center gap-2 border border-white/20 text-white font-semibold px-7 py-3.5 rounded-xl text-sm backdrop-blur-sm hover:bg-white/10 hover:border-white/35 transition-all duration-300 hover:-translate-y-0.5">
                            <i data-feather="info" class="w-4 h-4"></i>
                            Profil Yayasan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Slider Controls (only if multiple images) -->
    <?php if ($has_slider): ?>

        <!-- Slide Dots -->
        <div id="hero-dots" class="absolute bottom-[155px] md:bottom-[185px] left-1/2 -translate-x-1/2 z-20 flex items-center gap-2">
            <?php foreach ($hero_slides as $idx => $slide_url): ?>
                <button class="hero-dot rounded-full transition-all duration-400 <?= $idx === 0 ? 'bg-white' : 'bg-white/35' ?>"
                    style="width: <?= $idx === 0 ? '28px' : '8px' ?>; height: 4px;"
                    data-dot="<?= $idx ?>" aria-label="Slide <?= $idx + 1 ?>"></button>
            <?php endforeach; ?>
        </div>

        <!-- Slide Counter -->
        <div class="absolute bottom-[155px] md:bottom-[185px] right-6 md:right-10 z-20 flex items-center gap-1.5">
            <span id="hero-current-num" class="text-white font-bold text-sm">01</span>
            <span class="text-white/30 text-xs">/</span>
            <span class="text-white/40 text-sm"><?= str_pad(count($hero_slides), 2, '0', STR_PAD_LEFT) ?></span>
        </div>
    <?php endif; ?>

</section>

<!-- ============================================================ -->
<!-- STATISTIK — FLOATING CARDS AT HERO BOUNDARY (REDESIGNED)     -->
<!-- ============================================================ -->
<?php if (!empty($statistik)): ?>
    <div class="relative z-20 -mt-12 md:-mt-14 pb-0">
        <div class="container mx-auto px-4 lg:px-8">
            <!-- Stat cards container with subtle border -->
            <div class="bg-white rounded-2xl shadow-xl shadow-hijau-900/10 border border-gray-100 overflow-hidden">
                <div class="grid divide-x divide-gray-100"
                    style="grid-template-columns: repeat(<?= count($statistik) ?>, 1fr);">
                    <?php foreach ($statistik as $idx => $stat): ?>
                        <div class="stat-card reveal text-center px-6 py-6" style="transition-delay: <?= $idx * 80 ?>ms;">
                            <!-- Top accent -->
                            <?php if ($idx === 0): ?>
                                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-hijau-500 to-kuning-400 rounded-t-xl"></div>
                            <?php endif; ?>
                            <div class="counter-number font-display font-bold text-3xl md:text-4xl text-hijau-800 mb-0.5"
                                data-count="<?= $stat->nilai ?>">
                                0
                            </div>
                            <?php if (!empty($stat->satuan)): ?>
                                <div class="text-kuning-600 text-[10px] font-bold tracking-[0.15em] uppercase mb-1">
                                    <?= $stat->satuan ?>
                                </div>
                            <?php endif; ?>
                            <div class="text-gray-400 text-xs font-medium"><?= $stat->label ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Bottom accent line -->
                <div class="h-[3px] bg-gradient-to-r from-hijau-600 via-hijau-500 to-kuning-400"></div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- ============================================================ -->
<!-- SEJARAH / PROFIL SINGKAT SECTION (REDESIGNED)                -->
<!-- ============================================================ -->
<?php
$about_label   = isset($profil) && $profil && trim((string) $profil->about_section_label) !== '' ? trim((string) $profil->about_section_label) : 'About Us';
$about_badge   = isset($profil) && $profil && trim((string) $profil->about_section_badge) !== '' ? trim((string) $profil->about_section_badge) : 'Profil Singkat';
$about_name    = isset($profil) && $profil && trim((string) $profil->nama_yayasan) !== '' ? trim((string) $profil->nama_yayasan) : 'Yayasan Ar-Razaq';
$about_tagline = isset($profil) && $profil && trim((string) $profil->tagline) !== '' ? trim((string) $profil->tagline) : 'Jejak pengabdian dan pembinaan generasi Islami.';

$about_desc_full = isset($profil) && $profil ? trim(preg_replace('/\s+/', ' ', strip_tags((string) $profil->deskripsi_lengkap))) : '';
$about_desc      = isset($profil) && $profil ? trim((string) $profil->deskripsi_singkat) : '';
if ($about_desc === '' && $about_desc_full !== '') {
    $about_desc = function_exists('mb_strlen') && mb_strlen($about_desc_full, 'UTF-8') > 300
        ? rtrim(mb_substr($about_desc_full, 0, 300, 'UTF-8')) . '...'
        : $about_desc_full;
}
if ($about_desc === '') $about_desc = 'Informasi singkat yayasan belum tersedia.';

$about_cta_text    = isset($profil) && $profil && trim((string) $profil->about_section_cta_text) !== '' ? trim((string) $profil->about_section_cta_text) : 'Selengkapnya';
$about_cta_link_raw = isset($profil) && $profil ? trim((string) $profil->about_section_cta_link) : '';
if ($about_cta_link_raw === '') {
    $about_cta_link = base_url('tentang-kami');
} elseif (preg_match('#^(https?:)?//#i', $about_cta_link_raw) || strpos($about_cta_link_raw, '#') === 0) {
    $about_cta_link = $about_cta_link_raw;
} else {
    $about_cta_link = base_url(ltrim($about_cta_link_raw, '/'));
}

// === Media: YouTube URL takes priority over uploaded file ===
$about_yt_url    = isset($profil) && $profil && !empty($profil->about_section_video_url) ? trim((string) $profil->about_section_video_url) : '';
$about_media_file = isset($profil) && $profil && trim((string) $profil->about_section_media) !== ''
    ? trim((string) $profil->about_section_media)
    : (isset($profil) && $profil && trim((string) $profil->hero_image) !== '' ? trim((string) $profil->hero_image) : '');
$about_media_ext  = strtolower(pathinfo($about_media_file, PATHINFO_EXTENSION));
$about_media_is_video = in_array($about_media_ext, ['mp4', 'webm', 'ogg'], true);
$about_media_url  = $about_media_file !== ''
    ? base_url('assets/images/uploads/profil/' . $about_media_file)
    : base_url('assets/images/placeholder.webp');

// Extract YouTube video ID for embed
$yt_video_id = '';
$yt_embed_url = '';
$yt_thumbnail_url = '';
if ($about_yt_url !== '') {
    if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_\-]{11})/', $about_yt_url, $m)) {
        $yt_video_id = $m[1];
        $yt_embed_url = 'https://www.youtube-nocookie.com/embed/' . $yt_video_id . '?autoplay=1&rel=0&modestbranding=1';
        $yt_thumbnail_url = 'https://i.ytimg.com/vi/' . $yt_video_id . '/hqdefault.jpg';
    }
}
?>
<section id="sejarah" class="py-20 md:py-28 bg-white relative overflow-hidden">
    <!-- Subtle background accent -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-hijau-50 rounded-full -translate-y-1/2 translate-x-1/2 opacity-60 pointer-events-none"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <!-- Section header -->
        <div class="mb-16 reveal">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-[2px] bg-hijau-600 rounded-full"></div>
                <span class="text-xs font-bold tracking-[0.15em] uppercase text-hijau-600"><?= html_escape($about_label) ?></span>
            </div>
            <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-hijau-900 mb-4 split-text" data-split-reveal>
                Sejarah &amp; Profil Yayasan
            </h2>
            <div class="flex items-center gap-3">
                <div class="h-[2px] w-10 bg-kuning-500 rounded-full"></div>
                <div class="h-[2px] w-4 bg-hijau-200 rounded-full"></div>
            </div>
        </div>

        <!-- Two column: media left, text right -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center mb-20">
            <!-- Media column -->
            <div class="reveal-left">
                <div class="relative">
                    <!-- Main media frame -->
                    <div class="relative rounded-2xl overflow-hidden bg-hijau-950 aspect-[4/3] shadow-xl shadow-hijau-900/15">
                        <?php if ($yt_embed_url !== ''): ?>
                            <button type="button"
                                class="group relative w-full h-full text-left focus:outline-none focus-visible:ring-2 focus-visible:ring-kuning-400/80"
                                data-youtube-modal-trigger="1"
                                data-embed-src="<?= html_escape($yt_embed_url) ?>"
                                aria-label="Putar video profil yayasan">
                                <img src="<?= $yt_thumbnail_url !== '' ? $yt_thumbnail_url : $about_media_url ?>"
                                    alt="Thumbnail video <?= html_escape($about_name) ?>"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-tr from-hijau-950/85 via-hijau-950/35 to-transparent"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="flex h-20 w-20 items-center justify-center rounded-full bg-white/90 text-hijau-900 shadow-2xl shadow-black/30 transition-all duration-300 group-hover:scale-110 group-hover:bg-kuning-400">
                                        <i data-feather="play" class="w-8 h-8 ml-1"></i>
                                    </span>
                                </div>
                            </button>
                        <?php elseif ($about_media_is_video): ?>
                            <video autoplay muted loop playsinline preload="metadata"
                                class="w-full h-full object-cover">
                                <source src="<?= $about_media_url ?>" type="video/<?= html_escape($about_media_ext) ?>">
                            </video>
                        <?php else: ?>
                            <img src="<?= $about_media_url ?>" alt="<?= html_escape($about_name) ?>"
                                class="w-full h-full object-cover">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Text column -->
            <div class="reveal-right">
                <span class="inline-flex items-center gap-2 bg-hijau-50 text-hijau-700 text-xs font-semibold px-3 py-1.5 rounded-full mb-5 border border-hijau-100">
                    <i data-feather="book-open" class="w-3 h-3"></i>
                    <?= html_escape($about_badge) ?>
                </span>

                <h3 class="font-display text-3xl md:text-4xl font-bold text-hijau-900 mb-5 leading-tight">
                    <?= html_escape($about_name) ?>
                </h3>

                <!-- Decorative quote line -->
                <div class="border-l-2 border-kuning-400/40 pl-4 mb-6">
                    <p class="text-hijau-700/70 text-sm italic font-medium leading-relaxed">
                        <?= html_escape($about_tagline) ?>
                    </p>
                </div>

                <p class="text-gray-500 text-base leading-relaxed mb-8 max-w-lg">
                    <?= nl2br(html_escape($about_desc)) ?>
                </p>

                <a href="<?= $about_cta_link ?>"
                    class="inline-flex items-center gap-2 bg-hijau-800 text-white font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-hijau-900 transition-all duration-300 hover:-translate-y-0.5 shadow-sm hover:shadow-md hover:shadow-hijau-900/15 group">
                    <?= html_escape($about_cta_text) ?>
                    <i data-feather="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
            </div>
        </div>

        <!-- Timeline -->
        <?php if (!empty($sejarah)): ?>
            <div class="relative max-w-4xl mx-auto">
                <!-- Timeline center line -->
                <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-gray-100 hidden md:block"></div>
                <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-hijau-500 to-kuning-500 hidden md:block timeline-progress" id="timeline-line"></div>

                <?php foreach ($sejarah as $idx => $item):
                    $is_even = $idx % 2 === 0;
                    $sejarah_tahun = isset($item->tahun) ? trim((string) $item->tahun) : '';
                    $sejarah_gambar = isset($item->gambar) ? trim((string) $item->gambar) : '';
                ?>
                    <div class="relative flex flex-col md:flex-row items-center gap-8 mb-16 <?= $is_even ? 'md:flex-row' : 'md:flex-row-reverse' ?>">
                        <!-- Content -->
                        <div class="flex-1 <?= $is_even ? 'md:text-right md:pr-14' : 'md:text-left md:pl-14' ?> reveal<?= $is_even ? '-left' : '-right' ?>">
                            <?php if ($sejarah_gambar !== ''): ?>
                                <div class="rounded-xl overflow-hidden mb-4 aspect-video bg-gray-50">
                                    <img src="<?= base_url('assets/images/uploads/sejarah/' . $sejarah_gambar) ?>"
                                        alt="<?= $item->judul ?>"
                                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                                </div>
                            <?php endif; ?>
                            <div class="bg-white rounded-2xl p-6 border border-gray-100 card-hover shadow-sm" data-toggle-card="1">
                                <h3 class="font-display text-lg font-bold text-hijau-900 mb-3"><?= $item->judul ?></h3>
                                <?php
                                $sejarah_full = trim(preg_replace('/\s+/', ' ', strip_tags((string) $item->konten)));
                                $sejarah_short = $sejarah_full;
                                $sejarah_can_toggle = false;
                                if ($sejarah_full !== '') {
                                    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
                                        $sejarah_can_toggle = mb_strlen($sejarah_full, 'UTF-8') > 170;
                                        if ($sejarah_can_toggle) $sejarah_short = rtrim(mb_substr($sejarah_full, 0, 170, 'UTF-8')) . '...';
                                    } else {
                                        $sejarah_can_toggle = strlen($sejarah_full) > 170;
                                        if ($sejarah_can_toggle) $sejarah_short = rtrim(substr($sejarah_full, 0, 170)) . '...';
                                    }
                                }
                                ?>
                                <?php if ($sejarah_full !== ''): ?>
                                    <p class="sejarah-item-short text-gray-500 text-sm leading-relaxed"><?= html_escape($sejarah_short) ?></p>
                                    <?php if ($sejarah_can_toggle): ?>
                                        <div class="sejarah-item-full-wrap hidden">
                                            <p class="text-gray-500 text-sm leading-relaxed"><?= html_escape($sejarah_full) ?></p>
                                        </div>
                                        <button type="button"
                                            class="sejarah-item-toggle mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-hijau-700 hover:text-hijau-900 transition-colors"
                                            data-open="0" aria-expanded="false">
                                            <span class="sejarah-item-label">Lihat deskripsi lengkap</span>
                                            <i data-feather="chevron-down" class="sejarah-item-arrow w-3 h-3"></i>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Year dot -->
                        <?php if ($sejarah_tahun !== ''): ?>
                            <div class="relative z-10 flex-shrink-0 hidden md:block">
                                <div class="w-12 h-12 bg-hijau-800 border-4 border-white rounded-full flex items-center justify-center shadow-md">
                                    <span class="text-white text-[9px] font-bold leading-tight text-center"><?= html_escape($sejarah_tahun) ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="relative z-10 flex-shrink-0 hidden md:block">
                                <div class="w-3 h-3 bg-hijau-500 border-2 border-white rounded-full shadow-md"></div>
                            </div>
                        <?php endif; ?>

                        <!-- Empty spacer for opposite column -->
                        <div class="flex-1 hidden md:block"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if ($yt_embed_url !== ''): ?>
    <div id="about-video-modal" class="fixed inset-0 z-[110] hidden bg-hijau-950/85 px-4 py-6 md:px-8">
        <div class="flex min-h-full items-center justify-center">
            <div class="relative w-full max-w-5xl">
                <button type="button"
                    id="about-video-close"
                    class="absolute -top-12 right-0 inline-flex items-center gap-2 rounded-full bg-white/12 px-4 py-2 text-sm font-semibold text-white backdrop-blur transition-colors hover:bg-white/20"
                    aria-label="Tutup video">
                    <i data-feather="x" class="w-4 h-4"></i>
                    Tutup
                </button>

                <div class="overflow-hidden rounded-[28px] border border-white/10 bg-black shadow-[0_30px_80px_rgba(0,0,0,0.4)]">
                    <div class="aspect-video bg-black">
                        <iframe id="about-video-frame"
                            src=""
                            class="h-full w-full"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"
                            title="Video profil yayasan"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- ============================================================ -->
<!-- VISI MISI SECTION (REDESIGNED — formal dark green)            -->
<!-- ============================================================ -->
<?php
$vm_bg_image  = isset($profil) && $profil && !empty($profil->vm_bg_image)  ? base_url('assets/images/uploads/profil/' . $profil->vm_bg_image) : '';
$vm_overlay_color = isset($profil) && $profil && !empty($profil->vm_overlay_color) ? $profil->vm_overlay_color : '#052e16';
$vm_ov_alpha  = isset($profil) && $profil && isset($profil->vm_overlay_opacity) ? round($profil->vm_overlay_opacity / 100, 2) : 0.92;
?>
<section id="visi-misi" class="relative overflow-hidden py-24 md:py-32">
    <!-- Background image / color -->
    <?php if ($vm_bg_image): ?>
        <div class="absolute inset-0">
            <img src="<?= $vm_bg_image ?>" alt="" class="w-full h-full object-cover">
        </div>
    <?php else: ?>
        <div class="absolute inset-0 bg-hijau-950"></div>
    <?php endif; ?>

    <!-- Overlay -->
    <div class="absolute inset-0"
        style="background-color:<?= $vm_overlay_color ?>; opacity:<?= $vm_ov_alpha ?>; z-index:1;"></div>

    <!-- Subtle pattern -->
    <div class="absolute inset-0 pattern-bg opacity-[0.05]" style="z-index:2;"></div>

    <!-- Floating particles -->
    <div id="visi-particles" class="absolute inset-0 overflow-hidden pointer-events-none" style="z-index:3;"></div>

    <!-- Decorative corner accent -->
    <div class="absolute top-0 right-0 w-64 h-64 pointer-events-none" style="z-index:3;">
        <div class="w-full h-full border-r-2 border-t-2 border-kuning-500/10 rounded-bl-[60px]"></div>
    </div>
    <div class="absolute bottom-0 left-0 w-48 h-48 pointer-events-none" style="z-index:3;">
        <div class="w-full h-full border-l-2 border-b-2 border-white/5 rounded-tr-[60px]"></div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 lg:px-8 relative py-0" style="z-index:10;">
        <!-- Header -->
        <div class="mb-16 reveal">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-8 h-[2px] bg-kuning-500/70 rounded-full"></div>
                <span class="text-xs font-bold tracking-[0.15em] uppercase text-kuning-400/70">الرؤية والرسالة</span>
            </div>
            <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 split-text" data-split-reveal>
                Visi &amp; Misi
            </h2>
            <div class="flex items-center gap-3">
                <div class="h-[2px] w-10 bg-kuning-500/70 rounded-full"></div>
                <div class="h-[2px] w-4 bg-white/20 rounded-full"></div>
            </div>
            <p class="text-white/40 text-sm mt-4 max-w-md">Fondasi dan arah perjalanan yayasan menuju generasi unggul</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-start mb-16">

            <!-- VISI -->
            <div>
                <?php if (!empty($visi)):
                    $v = $visi[0]; ?>
                    <div class="reveal">
                        <div class="relative border-l-2 border-kuning-400/40 bg-kuning-500/[0.04] rounded-r-2xl pl-8 pr-8 py-8 md:py-10 h-full">
                            <div class="absolute -left-[11px] top-8 w-5 h-5 bg-kuning-400/20 border border-kuning-400/40 rounded-full flex items-center justify-center">
                                <div class="w-2 h-2 bg-kuning-400 rounded-full"></div>
                            </div>

                            <div class="text-kuning-400/60 text-[10px] font-bold tracking-[0.2em] uppercase mb-4 flex items-center gap-2">
                                <i data-feather="eye" class="w-3.5 h-3.5"></i>
                                Visi Kami
                            </div>

                            <p class="text-white font-display text-lg md:text-xl leading-relaxed italic">
                                "<?= $v->konten ?>"
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- MISI -->
            <div>
                <?php if (!empty($misi)): ?>
                    <div class="reveal">
                        <h3 class="font-display text-lg font-semibold text-kuning-400/80 mb-6 flex items-center gap-3">
                            <span class="w-6 h-[1px] bg-kuning-400/40"></span>
                            Misi Yayasan
                        </h3>
                        <div class="grid grid-cols-1 gap-4">
                            <?php foreach ($misi as $item): ?>
                                <div class="flex gap-4 bg-white/[0.03] border border-white/[0.06] rounded-xl p-5 hover:border-kuning-500/20 hover:bg-white/[0.05] transition-all duration-300">
                                    <div class="w-10 h-10 bg-hijau-800/60 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-feather="<?= $item->ikon ?: 'check-circle' ?>" class="w-4.5 h-4.5 text-kuning-400"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-white font-semibold mb-1.5 text-sm"><?= $item->judul ?></h4>
                                        <p class="text-white/40 text-xs leading-relaxed"><?= $item->konten ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Nilai -->
        <?php if (!empty($nilai)): ?>
            <div>
                <h3 class="font-display text-lg font-semibold text-kuning-400/80 mb-6 text-center"> <span class="w-6 h-[1px] bg-kuning-400/40"></span>
                    Nilai-Nilai Kami
                </h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto stagger-parent"> <?php foreach ($nilai as $item): ?>
                        <div class="stagger-child text-center">
                            <div class="w-14 h-14 bg-hijau-800/40 border border-white/[0.05] rounded-xl flex items-center justify-center mx-auto mb-3 hover:bg-kuning-500/15 hover:border-kuning-400/20 transition-all duration-400">
                                <i data-feather="<?= $item->ikon ?: 'star' ?>" class="w-6 h-6 text-kuning-400"></i>
                            </div>
                            <h4 class="text-white font-semibold text-xs mb-1"><?= $item->judul ?></h4>
                            <p class="text-white/35 text-xs leading-relaxed"><?= $item->konten ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================================ -->
<!-- GALERI SECTION — HORIZONTAL SCROLL (REDESIGNED)              -->
<!-- ============================================================ -->
<section id="galeri" class="py-20 md:py-28 bg-gray-50 relative overflow-hidden">
    <!-- Background line accents -->
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-hijau-200 to-transparent"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
            <div class="reveal">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-[2px] bg-hijau-600 rounded-full"></div>
                    <span class="text-xs font-bold tracking-[0.15em] uppercase text-hijau-600">Dokumentasi</span>
                </div>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-hijau-900 mb-2 split-text" data-split-reveal>
                    Galeri Yayasan
                </h2>
                <div class="flex items-center gap-3">
                    <div class="h-[2px] w-10 bg-kuning-500 rounded-full"></div>
                    <div class="h-[2px] w-4 bg-hijau-200 rounded-full"></div>
                </div>
                <p class="text-gray-400 text-sm mt-4 max-w-sm">Mengabadikan setiap momen berharga dalam perjalanan yayasan</p>
            </div>
            <a href="<?= base_url('galeri') ?>"
                class="reveal inline-flex items-center gap-2 border border-hijau-200 text-hijau-700 font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-hijau-50 hover:border-hijau-300 transition-all duration-300 group self-start">
                Lihat Semua
                <i data-feather="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>
    </div>

    <?php if (!empty($galeri)): ?>
        <div id="gallery-scroll-section" class="relative">
            <div class="container mx-auto px-4 lg:px-8">
                <div id="gallery-scroll-wrapper" class="horizontal-scroll-wrapper py-6">
                    <?php foreach ($galeri as $idx => $foto): ?>
                        <div class="gallery-card group relative rounded-2xl overflow-hidden bg-gray-100 cursor-pointer flex-shrink-0 shadow-sm hover:shadow-lg transition-shadow duration-400"
                            onclick="openLightbox('<?= base_url('assets/images/uploads/galeri/' . $foto->gambar) ?>', '<?= htmlspecialchars($foto->judul) ?>')">
                            <?php if ($foto->gambar && strpos($foto->gambar, 'placeholder') === false): ?>
                                <img src="<?= base_url('assets/images/uploads/galeri/' . $foto->gambar) ?>"
                                    alt="<?= $foto->judul ?>"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    onerror="this.src='<?= base_url('assets/images/placeholder.webp') ?>'">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-hijau-50 to-hijau-100 flex items-center justify-center">
                                    <i data-feather="image" class="w-10 h-10 text-hijau-200"></i>
                                </div>
                            <?php endif; ?>
                            <!-- Overlay on hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-hijau-950/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-end p-5">
                                <div>
                                    <p class="text-white font-semibold text-sm mb-1"><?= $foto->judul ?></p>
                                    <?php if (!empty($foto->label)): ?>
                                        <span class="text-xs bg-kuning-500 text-hijau-950 px-2 py-0.5 rounded-full font-semibold"><?= htmlspecialchars($foto->label, ENT_QUOTES) ?></span>
                                    <?php elseif ($foto->kategori): ?>
                                        <span class="text-xs bg-kuning-500 text-hijau-950 px-2 py-0.5 rounded-full font-semibold"><?= ucfirst($foto->kategori) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>

<!-- Lightbox -->
<div id="lightbox"
    class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 invisible transition-all duration-400"
    data-lenis-prevent>
    <button onclick="closeLightbox()"
        class="absolute top-5 right-5 text-white/50 hover:text-white transition-colors">
        <i data-feather="x" class="w-7 h-7"></i>
    </button>
    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[88vh] rounded-xl object-contain">
    <div class="absolute bottom-6 text-center">
        <p id="lightbox-caption" class="text-white/60 text-sm font-medium"></p>
    </div>
</div>

<!-- ============================================================ -->
<!-- EKSKUL SECTION (REDESIGNED)                                   -->
<!-- ============================================================ -->
<section id="ekskul" class="py-20 md:py-28 bg-white relative overflow-hidden">
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-hijau-50 rounded-full translate-y-1/2 -translate-x-1/2 opacity-60 pointer-events-none"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
            <div class="reveal">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-[2px] bg-hijau-600 rounded-full"></div>
                    <span class="text-xs font-bold tracking-[0.15em] uppercase text-hijau-600">Kegiatan</span>
                </div>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-hijau-900 mb-2 split-text" data-split-reveal>
                    Ekstrakurikuler
                </h2>
                <div class="flex items-center gap-3">
                    <div class="h-[2px] w-10 bg-kuning-500 rounded-full"></div>
                    <div class="h-[2px] w-4 bg-hijau-200 rounded-full"></div>
                </div>
                <p class="text-gray-400 text-sm mt-4 max-w-sm">Mengembangkan bakat dan potensi santri melalui berbagai kegiatan unggulan</p>
            </div>
            <a href="<?= base_url('ekskul') ?>"
                class="reveal inline-flex items-center gap-2 border border-hijau-200 text-hijau-700 font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-hijau-50 hover:border-hijau-300 transition-all duration-300 group self-start">
                Lihat Semua
                <i data-feather="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>

        <?php if (!empty($ekskul)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 stagger-parent">
                <?php foreach ($ekskul as $idx => $item): ?>
                    <?php $ekskul_slug = !empty($item->slug) ? $item->slug : ('ekskul-' . (int) $item->id); ?>
                    <div class="stagger-child group">
                        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 card-hover h-full shadow-sm hover:shadow-md hover:shadow-hijau-900/6 transition-all duration-400">
                            <?php if ($item->gambar): ?>
                                <div class="h-44 overflow-hidden relative">
                                    <img src="<?= base_url('assets/images/uploads/ekskul/' . $item->gambar) ?>"
                                        alt="<?= $item->nama ?>"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    <!-- Category strip -->
                                    <div class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-t from-hijau-950/50 to-transparent"></div>
                                </div>
                            <?php else: ?>
                                <div class="h-40 bg-gradient-to-br from-hijau-800 to-hijau-900 flex items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 pattern-bg opacity-20"></div>
                                    <i data-feather="<?= $item->ikon ?: 'star' ?>" class="w-12 h-12 text-kuning-400/30 relative z-10"></i>
                                </div>
                            <?php endif; ?>

                            <div class="p-5">
                                <h3 class="font-display text-base font-bold text-hijau-900 mb-1.5"><?= $item->nama ?></h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-4"><?= $item->deskripsi ?></p>

                                <?php if ($item->jadwal || $item->pembina): ?>
                                    <div class="pt-3 border-t border-gray-50 space-y-1.5 mb-3">
                                        <?php if ($item->jadwal): ?>
                                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                                <i data-feather="clock" class="w-3 h-3 text-hijau-400"></i>
                                                <?= $item->jadwal ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($item->pembina): ?>
                                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                                <i data-feather="user" class="w-3 h-3 text-hijau-400"></i>
                                                <?= $item->pembina ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <a href="<?= base_url('ekskul/' . rawurlencode($ekskul_slug)) ?>"
                                    class="inline-flex items-center gap-1.5 text-sm font-semibold text-hijau-700 hover:text-hijau-900 transition-colors group/link">
                                    Lihat Detail
                                    <i data-feather="arrow-right" class="w-3.5 h-3.5 group-hover/link:translate-x-0.5 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================================ -->
<!-- BERITA SECTION (REDESIGNED)                                   -->
<!-- ============================================================ -->
<section id="berita" class="py-20 md:py-28 bg-gray-50 relative overflow-hidden">
    <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-hijau-200 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-hijau-200 to-transparent"></div>

    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
            <div class="reveal">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-[2px] bg-hijau-600 rounded-full"></div>
                    <span class="text-xs font-bold tracking-[0.15em] uppercase text-hijau-600">Informasi</span>
                </div>
                <h2 class="font-display text-3xl md:text-4xl font-bold text-hijau-900 mb-2 split-text" data-split-reveal>
                    Berita Terkini
                </h2>
                <div class="flex items-center gap-3">
                    <div class="h-[2px] w-10 bg-kuning-500 rounded-full"></div>
                    <div class="h-[2px] w-4 bg-hijau-200 rounded-full"></div>
                </div>
            </div>
            <a href="<?= base_url('berita') ?>"
                class="reveal inline-flex items-center gap-2 border border-hijau-200 text-hijau-700 font-semibold text-sm px-5 py-2.5 rounded-xl hover:bg-hijau-50 hover:border-hijau-300 transition-all duration-300 group self-start">
                Lihat Semua
                <i data-feather="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
        </div>

        <?php if (!empty($berita)): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 stagger-parent">
                <?php foreach ($berita as $idx => $post): ?>
                    <article class="stagger-child group">
                        <a href="<?= base_url('berita/' . $post->slug) ?>"
                            class="block bg-white rounded-2xl overflow-hidden border border-gray-100 card-hover card-hover-soft h-full shadow-sm hover:shadow-md hover:shadow-hijau-900/6">
                            <div class="aspect-video overflow-hidden bg-gray-50 relative">
                                <?php if ($post->gambar): ?>
                                    <img src="<?= base_url('assets/images/uploads/berita/' . $post->gambar) ?>"
                                        alt="<?= $post->judul ?>"
                                        class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-700">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gradient-to-br from-hijau-50 to-hijau-100 flex items-center justify-center">
                                        <i data-feather="file-text" class="w-8 h-8 text-hijau-200"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="absolute top-3 left-3">
                                    <span class="bg-white/90 backdrop-blur-sm text-hijau-800 text-xs font-bold px-2.5 py-1 rounded-full capitalize border border-hijau-100/50">
                                        <?= $post->kategori ?>
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="flex items-center gap-1.5 mb-3 text-gray-400 text-xs">
                                    <i data-feather="calendar" class="w-3 h-3"></i>
                                    <?= date('d M Y', strtotime($post->tanggal_publish)) ?>
                                </div>
                                <h3 class="font-display font-bold text-hijau-900 text-base mb-2 leading-snug line-clamp-2 group-hover:text-hijau-700 transition-colors duration-300">
                                    <?= $post->judul ?>
                                </h3>
                                <?php if ($post->ringkasan): ?>
                                    <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 mb-4"><?= $post->ringkasan ?></p>
                                <?php endif; ?>
                                <div class="flex items-center text-hijau-700 text-sm font-semibold gap-1.5 group-hover:gap-2.5 transition-all duration-300">
                                    Baca Selengkapnya
                                    <i data-feather="arrow-right" class="w-3.5 h-3.5"></i>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================================ -->
<!-- PPDB CTA SECTION (REDESIGNED)                                 -->
<!-- ============================================================ -->
<?php if (!empty($ppdb)): ?>
    <section id="ppdb" class="py-20 md:py-28 relative overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0 bg-hijau-900"></div>
        <div class="absolute inset-0 pattern-bg opacity-[0.06]"></div>


       

        <div class="container mx-auto px-4 lg:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center reveal">


                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-5 split-text" data-split-reveal>
                    <?= $ppdb->judul ?>
                </h2>

                <!-- Divider -->
                <div class="flex items-center justify-center gap-3 mb-6">
                    <div class="h-px w-12 bg-kuning-500/50"></div>
                    <div class="w-1.5 h-1.5 rounded-full bg-kuning-400/60"></div>
                    <div class="h-px w-12 bg-kuning-500/50"></div>
                </div>

                <?php if ($ppdb->deskripsi): ?>
                    <p class="text-white/50 text-base mb-10 max-w-xl mx-auto leading-relaxed">
                        <?= $ppdb->deskripsi ?>
                    </p>
                <?php endif; ?>

                <!-- Key Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-10 max-w-2xl mx-auto">
                    <?php if ($ppdb->tanggal_buka && $ppdb->tanggal_tutup): ?>
                        <div class="bg-white/[0.04] border border-white/[0.07] rounded-xl p-5 hover:border-kuning-500/20 transition-colors duration-300">
                            <div class="text-kuning-400 mb-2"><i data-feather="calendar" class="w-5 h-5 mx-auto"></i></div>
                            <div class="text-white text-xs font-semibold">Periode Pendaftaran</div>
                            <div class="text-white/40 text-xs mt-1"><?= date('d M Y', strtotime($ppdb->tanggal_buka)) ?> – <?= date('d M Y', strtotime($ppdb->tanggal_tutup)) ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if ($ppdb->kuota): ?>
                        <div class="bg-white/[0.04] border border-white/[0.07] rounded-xl p-5 hover:border-kuning-500/20 transition-colors duration-300">
                            <div class="text-kuning-400 mb-2"><i data-feather="users" class="w-5 h-5 mx-auto"></i></div>
                            <div class="text-white text-xs font-semibold">Kuota Tersedia</div>
                            <div class="text-white/40 text-xs mt-1"><?= number_format($ppdb->kuota) ?> Santri</div>
                        </div>
                    <?php endif; ?>
                    <?php if ($ppdb->biaya_pendaftaran): ?>
                        <div class="bg-white/[0.04] border border-white/[0.07] rounded-xl p-5 hover:border-kuning-500/20 transition-colors duration-300">
                            <div class="text-kuning-400 mb-2"><i data-feather="credit-card" class="w-5 h-5 mx-auto"></i></div>
                            <div class="text-white text-xs font-semibold">Biaya Pendaftaran</div>
                            <div class="text-white/40 text-xs mt-1">Rp <?= number_format($ppdb->biaya_pendaftaran, 0, ',', '.') ?></div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="<?= base_url('ppdb') ?>"
                        class="magnetic-btn inline-flex items-center justify-center gap-2 bg-kuning-400 text-hijau-950 font-bold px-8 py-3.5 rounded-xl text-sm hover:-translate-y-0.5 transition-all duration-300 shadow-lg shadow-kuning-500/20 hover:bg-kuning-300">
                        <i data-feather="user-plus" class="w-4 h-4"></i>
                        Daftar Sekarang
                    </a>
                    <?php if ($ppdb->link_pendaftaran): ?>
                        <a href="<?= $ppdb->link_pendaftaran ?>" target="_blank"
                            class="magnetic-btn inline-flex items-center justify-center gap-2 border border-white/20 text-white font-semibold px-8 py-3.5 rounded-xl text-sm hover:bg-white/10 hover:border-white/30 transition-all duration-300 hover:-translate-y-0.5">
                            <i data-feather="external-link" class="w-4 h-4"></i>
                            Daftar Online
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- ============================================================ -->
<!-- PAGE-SPECIFIC SCRIPTS                                         -->
<!-- ============================================================ -->
<style>
    /* Hero Slider */
    .hero-slide {
        will-change: opacity;
    }

    /* Stats floating cards */
    .stat-card {
        will-change: transform, opacity;
        position: relative;
    }

    /* Dot styles */
    .hero-dot {
        cursor: pointer;
        border: none;
        padding: 0;
        transition: width 0.35s cubic-bezier(0.16, 1, 0.3, 1), background 0.35s ease;
    }

    /* Topbar hides when navbar scrolls in floating mode */
    body.topbar-hidden #topbar {
        max-height: 0;
        opacity: 0;
        pointer-events: none;
    }

    /* Adjust hero padding for topbar */
    @media (max-width: 1024px) {
        #topbar {
            max-height: 40px;
        }
    }
</style>

<script>
    // ============================================================
    // ABOUT VIDEO MODAL
    // ============================================================
    (function() {
        const modal = document.getElementById('about-video-modal');
        const frame = document.getElementById('about-video-frame');
        const closeBtn = document.getElementById('about-video-close');
        const triggers = document.querySelectorAll('[data-youtube-modal-trigger="1"]');
        if (!modal || !frame || !triggers.length) return;

        const openModal = (src) => {
            if (!src) return;
            frame.src = src;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        };

        const closeModal = () => {
            frame.src = '';
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        };

        triggers.forEach((trigger) => {
            trigger.addEventListener('click', () => openModal(trigger.getAttribute('data-embed-src')));
        });

        closeBtn?.addEventListener('click', closeModal);
        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    })();

    // ============================================================
    // LIGHTBOX
    // ============================================================
    function openLightbox(src, caption) {
        const lb = document.getElementById('lightbox');
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').textContent = caption;
        lb.classList.remove('opacity-0', 'invisible');
        lb.classList.add('opacity-100', 'visible');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lb = document.getElementById('lightbox');
        lb.classList.add('opacity-0', 'invisible');
        lb.classList.remove('opacity-100', 'visible');
        document.body.style.overflow = '';
    }
    document.getElementById('lightbox')?.addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeLightbox();
    });

    // ============================================================
    // HERO SLIDER
    // ============================================================
    (function() {
        const slides = document.querySelectorAll('.hero-slide');
        const dots = document.querySelectorAll('.hero-dot');
        const prevBtn = document.getElementById('hero-prev');
        const nextBtn = document.getElementById('hero-next');
        const currentNumEl = document.getElementById('hero-current-num');
        if (!slides.length || slides.length === 1) return;

        let current = 0;
        let autoTimer = null;
        const AUTO_INTERVAL = 5500;

        function goTo(idx) {
            slides[current].classList.remove('opacity-100');
            slides[current].classList.add('opacity-0');
            if (dots[current]) {
                dots[current].style.width = '8px';
                dots[current].style.background = 'rgba(255,255,255,0.35)';
            }

            current = (idx + slides.length) % slides.length;

            slides[current].classList.remove('opacity-0');
            slides[current].classList.add('opacity-100');
            if (dots[current]) {
                dots[current].style.width = '28px';
                dots[current].style.background = 'white';
            }
            if (currentNumEl) {
                currentNumEl.textContent = String(current + 1).padStart(2, '0');
            }
        }

        function startAuto() {
            stopAuto();
            autoTimer = setInterval(() => goTo(current + 1), AUTO_INTERVAL);
        }

        function stopAuto() {
            if (autoTimer) {
                clearInterval(autoTimer);
                autoTimer = null;
            }
        }

        prevBtn?.addEventListener('click', () => {
            goTo(current - 1);
            startAuto();
        });
        nextBtn?.addEventListener('click', () => {
            goTo(current + 1);
            startAuto();
        });
        dots.forEach((dot, i) => {
            dot.addEventListener('click', () => {
                goTo(i);
                startAuto();
            });
        });

        // Init dot styles
        dots.forEach((d, i) => {
            d.style.width = i === 0 ? '28px' : '8px';
            d.style.height = '4px';
            d.style.background = i === 0 ? 'white' : 'rgba(255,255,255,0.35)';
            d.style.borderRadius = '4px';
        });

        startAuto();

        document.addEventListener('visibilitychange', () => {
            document.hidden ? stopAuto() : startAuto();
        });
    })();

    // ============================================================
    // BINARY TOGGLE (sejarah expand/collapse)
    // ============================================================
    function initBinaryToggle(buttonSelector, shortSelector, fullSelector, labelSelector, arrowSelector, openLabel, closeLabel) {
        document.querySelectorAll(buttonSelector).forEach(btn => {
            btn.addEventListener('click', () => {
                if (btn.dataset.busy === '1') return;
                const card = btn.closest('[data-toggle-card="1"]');
                if (!card) return;

                const shortEl = card.querySelector(shortSelector);
                const fullWrap = card.querySelector(fullSelector);
                const labelEl = btn.querySelector(labelSelector);
                const arrow = btn.querySelector(arrowSelector);
                if (!fullWrap || !shortEl || !labelEl || !arrow) return;

                const isOpen = btn.dataset.open === '1';
                gsap.killTweensOf([shortEl, fullWrap, arrow]);
                btn.dataset.busy = '1';
                btn.style.pointerEvents = 'none';

                if (!isOpen) {
                    fullWrap.classList.remove('hidden');
                    gsap.set(fullWrap, {
                        display: 'block',
                        height: 0,
                        opacity: 0,
                        overflow: 'hidden'
                    });
                    const targetH = fullWrap.scrollHeight;

                    gsap.timeline()
                        .to(fullWrap, {
                            height: targetH,
                            opacity: 1,
                            duration: 0.44,
                            ease: 'power2.out',
                            onComplete: () => {
                                gsap.set(fullWrap, {
                                    height: 'auto'
                                });
                                gsap.set(shortEl, {
                                    display: 'none'
                                });
                            }
                        }, 0)
                        .to(shortEl, {
                            opacity: 0.35,
                            duration: 0.24,
                            ease: 'power1.out'
                        }, 0.04)
                        .to(arrow, {
                            rotate: 180,
                            duration: 0.28,
                            ease: 'power2.out'
                        }, '<')
                        .add(() => {
                            btn.dataset.busy = '0';
                            btn.style.pointerEvents = '';
                        });
                    btn.dataset.open = '1';
                    btn.setAttribute('aria-expanded', 'true');
                    labelEl.textContent = closeLabel;
                } else {
                    fullWrap.classList.remove('hidden');
                    gsap.set(fullWrap, {
                        display: 'block',
                        height: fullWrap.scrollHeight,
                        opacity: 1,
                        overflow: 'hidden'
                    });
                    gsap.set(shortEl, {
                        display: 'block',
                        opacity: 0.35
                    });

                    gsap.timeline()
                        .to(fullWrap, {
                            height: 0,
                            opacity: 0,
                            duration: 0.42,
                            ease: 'power2.inOut'
                        }, 0)
                        .to(shortEl, {
                            opacity: 1,
                            duration: 0.28,
                            ease: 'power1.out'
                        }, 0.08)
                        .add(() => {
                            fullWrap.classList.add('hidden');
                            gsap.set(fullWrap, {
                                display: 'none',
                                height: 0,
                                opacity: 0
                            });
                            gsap.set(shortEl, {
                                display: 'block',
                                opacity: 1
                            });
                        })
                        .to(arrow, {
                            rotate: 0,
                            duration: 0.28,
                            ease: 'power2.out'
                        }, '<')
                        .add(() => {
                            btn.dataset.busy = '0';
                            btn.style.pointerEvents = '';
                        });
                    btn.dataset.open = '0';
                    btn.setAttribute('aria-expanded', 'false');
                    labelEl.textContent = openLabel;
                }
            });
        });
    }

    initBinaryToggle('.sejarah-item-toggle', '.sejarah-item-short', '.sejarah-item-full-wrap',
        '.sejarah-item-label', '.sejarah-item-arrow', 'Lihat deskripsi lengkap', 'Sembunyikan deskripsi');
</script>