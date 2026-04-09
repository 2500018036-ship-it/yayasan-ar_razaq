<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ============================================================ -->
<!-- HERO SECTION - IMMERSIVE FULLSCREEN -->
<!-- ============================================================ -->
<section id="hero" class="relative min-h-screen flex items-center justify-center overflow-hidden bg-hijau-950 grain">
    <!-- Hero background image if exists (FIRST layer, full cover) -->
    <?php
    $hero_overlay_color = isset($profil) && $profil && !empty($profil->hero_overlay_color) ? $profil->hero_overlay_color : '#052e16';
    $hero_overlay_opacity = isset($profil) && $profil && isset($profil->hero_overlay_opacity) ? $profil->hero_overlay_opacity : 80;
    ?>
    <?php if (isset($profil) && $profil && $profil->hero_image): ?>
        <div class="absolute inset-0 z-[1]">
            <img src="<?= base_url('assets/images/uploads/profil/' . $profil->hero_image) ?>" alt="Hero"
                class="w-full h-full object-cover">
            <div class="absolute inset-0"
                style="background: <?= $hero_overlay_color ?>; opacity: <?= $hero_overlay_opacity / 100 ?>;"></div>
        </div>
    <?php endif; ?>

    <!-- Parallax background layers -->
    <div class="absolute inset-0 pattern-bg opacity-20 z-[2]" data-parallax-bg="0.15"></div>

    <!-- Animated gradient orbs with parallax -->
    <div class="absolute top-1/4 -left-20 w-[500px] h-[500px] bg-hijau-700/15 rounded-full blur-[120px] floating-slow z-[2]"
        data-parallax-bg="0.2"></div>
    <div class="absolute bottom-1/3 -right-20 w-[400px] h-[400px] bg-kuning-500/8 rounded-full blur-[100px] floating z-[2]"
        data-parallax-bg="0.3"></div>
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-hijau-600/5 rounded-full blur-[150px] z-[2]">
    </div>

    <!-- Decorative geometric elements with parallax -->
    <div class="absolute top-24 right-20 opacity-20 z-[2]" data-parallax-bg="0.4">
        <div class="w-20 h-20 border border-kuning-400/40 rotate-45 floating"></div>
    </div>
    <div class="absolute bottom-40 left-16 opacity-15 z-[2]" data-parallax-bg="0.25">
        <div class="w-14 h-14 border border-hijau-400/30 rotate-12 floating-delay"></div>
    </div>
    <div class="absolute top-1/3 right-[15%] w-3 h-3 bg-kuning-400/50 rounded-full floating-slow z-[2]"
        data-parallax-bg="0.5"></div>
    <div class="absolute top-2/3 left-[20%] w-2 h-2 bg-hijau-400/40 rounded-full floating z-[2]" data-parallax-bg="0.35">
    </div>

    <!-- Spinning ornament -->
    <div class="absolute top-[15%] left-[10%] opacity-[0.06] spin-slow hidden lg:block z-[2]" data-parallax-bg="0.2">
        <svg width="120" height="120" viewBox="0 0 120 120" fill="none">
            <path d="M60 0L67 53L120 60L67 67L60 120L53 67L0 60L53 53L60 0Z" fill="#facc15" />
        </svg>
    </div>
    <div class="absolute bottom-[20%] right-[8%] opacity-[0.05] spin-slow hidden lg:block z-[2]" data-parallax-bg="0.15"
        style="animation-direction: reverse;">
        <svg width="80" height="80" viewBox="0 0 120 120" fill="none">
            <path d="M60 0L67 53L120 60L67 67L60 120L53 67L0 60L53 53L60 0Z" fill="#4ade80" />
        </svg>
    </div>

    <!-- Hero Content -->
    <div id="hero-content" class="relative z-10 text-center px-4 max-w-5xl mx-auto">
        <!-- Arabic text decoration -->
        <div id="hero-arabic" class="font-arabic text-kuning-400/80 text-2xl md:text-4xl mb-6 opacity-0 translate-y-8">
            بِسْمِ اللهِ الرَّحْمَنِ الرَّحِيمِ
        </div>

        <h1 id="hero-title"
            class="font-display text-4xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight opacity-0 split-text">
            <?= isset($profil) && $profil && !empty($profil->hero_title) ? $profil->hero_title : (isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq') ?>
        </h1>

        <p id="hero-tagline"
            class="text-hijau-200/80 text-lg md:text-xl lg:text-2xl mb-12 font-light max-w-3xl mx-auto leading-relaxed opacity-0 translate-y-8">
            <?= isset($profil) && $profil && !empty($profil->hero_subtitle) ? $profil->hero_subtitle : (isset($profil) && $profil && $profil->tagline ? $profil->tagline : 'Membentuk Generasi Qurani yang Berakhlak Mulia') ?>
        </p>

        <!-- CTA Buttons -->
        <div id="hero-cta" class="flex flex-col sm:flex-row gap-4 justify-center items-center opacity-0 translate-y-8">
            <a href="<?= base_url('ppdb') ?>"
                class="magnetic-btn group bg-kuning-500 text-hijau-950 font-bold px-8 py-4 rounded-2xl text-base shadow-xl shadow-kuning-500/20 hover:shadow-kuning-500/40 transition-all duration-500 hover:-translate-y-1 flex items-center gap-2">
                <i data-feather="user-plus" class="w-5 h-5"></i>
                Daftar Santri Baru
                <i data-feather="arrow-right"
                    class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"></i>
            </a>
            <a href="#sejarah"
                class="magnetic-btn border border-white/15 text-white font-semibold px-8 py-4 rounded-2xl text-base hover:bg-white/10 transition-all duration-500 hover:-translate-y-1 flex items-center gap-2 backdrop-blur-sm">
                <i data-feather="info" class="w-5 h-5"></i>
                Profil Yayasan
            </a>
        </div>
    </div>
</section>

<!-- ============================================================ -->
<!-- STATISTIK SECTION - STANDALONE -->
<!-- ============================================================ -->
<?php if (!empty($statistik)): ?>
    <section id="statistik" class="py-16 md:py-20 bg-white relative overflow-hidden">
        <div class="absolute inset-0 pattern-bg opacity-30"></div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10">
            <div class="max-w-5xl mx-auto">
                <div class="grid gap-6 md:gap-8 justify-center"
                    style="grid-template-columns: repeat(auto-fit, minmax(200px, max-content));">
                    <?php foreach ($statistik as $idx => $stat): ?>
                        <div class="stat-card reveal text-center group" style="transition-delay: <?= $idx * 100 ?>ms;">
                            <div
                                class="bg-gradient-to-br from-hijau-50 to-white border border-hijau-100/60 rounded-3xl p-6 md:p-8 card-hover relative overflow-hidden">
                                <!-- Decorative accent -->
                                <div
                                    class="absolute top-0 left-1/2 -translate-x-1/2 w-12 h-1 bg-gradient-to-r from-hijau-500 to-kuning-500 rounded-b-full">
                                </div>

                                <div class="counter-number font-display font-bold text-3xl md:text-4xl lg:text-5xl text-hijau-800 mb-1"
                                    data-count="<?= $stat->nilai ?>">
                                    0
                                </div>
                                <div class="text-kuning-600 text-xs font-semibold tracking-wider uppercase mb-1">
                                    <?= $stat->satuan ?></div>
                                <div class="text-gray-600 text-sm font-medium"><?= $stat->label ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- ============================================================ -->
<!-- SEJARAH SECTION -->
<!-- ============================================================ -->
<section id="sejarah" class="py-12 md:py-16 bg-white relative overflow-hidden">
    <div class="absolute top-20 right-0 w-72 h-72 bg-hijau-50 rounded-full blur-[100px] opacity-60"></div>
    <div class="absolute bottom-20 left-0 w-60 h-60 bg-kuning-50 rounded-full blur-[80px] opacity-40"></div>
    <div class="absolute inset-x-0 top-1/2 h-px bg-gradient-to-r from-transparent via-hijau-100 to-transparent"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <div class="ornament-divider mb-5 max-w-xs mx-auto">
                <span class="font-arabic text-hijau-600/70 text-xl">الجذور</span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-hijau-900 mb-5 split-text"
                data-split-reveal>Sejarah & Profil Yayasan</h2>
            <p class="text-gray-500 max-w-lg mx-auto text-base">Perjalanan panjang kami dalam mendidik generasi terbaik
                bangsa</p>
        </div>

        <?php
        $about_label = isset($profil) && $profil && trim((string) $profil->about_section_label) !== '' ? trim((string) $profil->about_section_label) : 'About Us';
        $about_badge = isset($profil) && $profil && trim((string) $profil->about_section_badge) !== '' ? trim((string) $profil->about_section_badge) : 'Profil Singkat';
        $about_name = isset($profil) && $profil && trim((string) $profil->nama_yayasan) !== '' ? trim((string) $profil->nama_yayasan) : 'Yayasan Ar-Razaq';
        $about_tagline = isset($profil) && $profil && trim((string) $profil->tagline) !== '' ? trim((string) $profil->tagline) : 'Jejak pengabdian, pendidikan, dan pembinaan generasi Islami.';

        $about_desc_full = isset($profil) && $profil ? trim(preg_replace('/\s+/', ' ', strip_tags((string) $profil->deskripsi_lengkap))) : '';
        $about_desc = isset($profil) && $profil ? trim((string) $profil->deskripsi_singkat) : '';
        if ($about_desc === '' && $about_desc_full !== '') {
            if (function_exists('mb_strlen') && function_exists('mb_substr')) {
                $about_desc = mb_strlen($about_desc_full, 'UTF-8') > 250
                    ? rtrim(mb_substr($about_desc_full, 0, 250, 'UTF-8')) . '...'
                    : $about_desc_full;
            } else {
                $about_desc = strlen($about_desc_full) > 250
                    ? rtrim(substr($about_desc_full, 0, 250)) . '...'
                    : $about_desc_full;
            }
        }
        if ($about_desc === '') {
            $about_desc = 'Informasi singkat yayasan belum tersedia. Silakan lengkapi melalui panel admin.';
        }

        $about_cta_text = isset($profil) && $profil && trim((string) $profil->about_section_cta_text) !== '' ? trim((string) $profil->about_section_cta_text) : 'Selengkapnya';
        $about_cta_link_raw = isset($profil) && $profil ? trim((string) $profil->about_section_cta_link) : '';
        if ($about_cta_link_raw === '') {
            $about_cta_link = base_url('tentang-kami');
        } elseif (preg_match('#^(https?:)?//#i', $about_cta_link_raw) || strpos($about_cta_link_raw, '#') === 0 || strpos($about_cta_link_raw, 'mailto:') === 0 || strpos($about_cta_link_raw, 'tel:') === 0) {
            $about_cta_link = $about_cta_link_raw;
        } else {
            $about_cta_link = base_url(ltrim($about_cta_link_raw, '/'));
        }

        $about_media_file = isset($profil) && $profil && trim((string) $profil->about_section_media) !== ''
            ? trim((string) $profil->about_section_media)
            : (isset($profil) && $profil && trim((string) $profil->hero_image) !== '' ? trim((string) $profil->hero_image) : '');
        $about_media_ext = strtolower(pathinfo($about_media_file, PATHINFO_EXTENSION));
        $about_media_is_video = in_array($about_media_ext, ['mp4', 'webm', 'ogg'], true);
        $about_media_url = $about_media_file !== ''
            ? base_url('assets/images/uploads/profil/' . $about_media_file)
            : base_url('assets/images/placeholder.jpg');

        $about_history_items = !empty($sejarah) && is_array($sejarah) ? array_slice($sejarah, 0, 3) : [];
        $about_history_count = !empty($sejarah) && is_array($sejarah) ? count($sejarah) : 0;
        ?>

        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.05fr)_minmax(0,0.95fr)] gap-10 lg:gap-14 items-center">
            <div class="reveal-left relative">
                <div class="absolute -top-6 -right-6 w-24 h-24 rounded-[28px] bg-kuning-100/70 blur-2xl"></div>
                <div class="absolute -bottom-8 -left-8 w-28 h-28 rounded-full bg-hijau-100/80 blur-3xl"></div>

                <div class="relative overflow-hidden rounded-[32px] border border-hijau-100/70 bg-hijau-950 shadow-[0_40px_80px_rgba(5,46,22,0.16)]">
                    <?php if ($about_media_is_video): ?>
                        <video autoplay muted loop playsinline preload="metadata"
                            class="w-full h-[320px] sm:h-[420px] lg:h-[520px] object-cover">
                            <source src="<?= $about_media_url ?>" type="video/<?= html_escape($about_media_ext) ?>">
                        </video>
                    <?php else: ?>
                        <img src="<?= $about_media_url ?>" alt="<?= html_escape($about_name) ?>"
                            class="w-full h-[320px] sm:h-[420px] lg:h-[520px] object-cover">
                    <?php endif; ?>
                </div>
            </div>

            <div class="reveal-right">
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-semibold text-gray-600 border border-gray-200">
                        <i data-feather="book-open" class="w-3.5 h-3.5 text-hijau-700"></i>
                        <?= html_escape($about_badge) ?>
                    </span>
                </div>

                <h2 class="mt-6 font-display text-4xl md:text-5xl lg:text-6xl font-bold text-hijau-900 leading-tight split-text"
                    data-split-reveal><?= html_escape($about_name) ?></h2>
                <p class="mt-6 text-gray-600 text-base md:text-lg leading-[1.95] max-w-2xl"><?= nl2br(html_escape($about_desc)) ?></p>


                <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4">
                    <a href="<?= $about_cta_link ?>"
                        class="sejarah-item-toggle mt-3 inline-flex items-center gap-2 text-hijau-700 hover:text-hijau-900 text-xs font-semibold transition-colors">
                        <?= html_escape($about_cta_text) ?>
                        <i data-feather="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Timeline -->
    <?php if (!empty($sejarah)): ?>
        <div class="relative max-w-4xl mx-auto">
            <!-- Timeline line (grows on scroll) -->
            <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-hijau-100 hidden md:block"></div>
            <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-hijau-500 via-hijau-600 to-kuning-500 hidden md:block timeline-progress"
                id="timeline-line"></div>

            <?php foreach ($sejarah as $idx => $item):
                $is_even = $idx % 2 === 0; ?>
                <div
                    class="relative flex flex-col md:flex-row items-center gap-8 mb-20 <?= $is_even ? 'md:flex-row' : 'md:flex-row-reverse' ?>">
                    <!-- Content -->
                    <div
                        class="flex-1 <?= $is_even ? 'md:text-right md:pr-16' : 'md:text-left md:pl-16' ?> reveal<?= $is_even ? '-left' : '-right' ?>">
                        <?php if ($item->gambar): ?>
                            <div class="rounded-3xl overflow-hidden mb-5 aspect-video bg-hijau-50 shadow-lg shadow-hijau-900/5">
                                <img src="<?= base_url('assets/images/uploads/sejarah/' . $item->gambar) ?>"
                                    alt="<?= $item->judul ?>"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                            </div>
                        <?php endif; ?>
                        <div class="bg-white rounded-3xl p-7 border border-hijau-100/50 card-hover shadow-sm" data-toggle-card="1">
                            <h3 class="font-display text-xl font-bold text-hijau-900 mb-3"><?= $item->judul ?></h3>
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
                            <p class="text-gray-500 leading-relaxed text-sm sejarah-item-short"><?= htmlspecialchars($sejarah_short, ENT_QUOTES) ?></p>

                            <?php if ($sejarah_can_toggle): ?>
                                <div class="sejarah-item-full-wrap mt-3 hidden" style="height:0; opacity:0; overflow:hidden;">
                                    <p class="text-gray-500 leading-relaxed text-sm"><?= nl2br(htmlspecialchars($sejarah_full, ENT_QUOTES)) ?></p>
                                </div>
                                <button type="button"
                                    class="sejarah-item-toggle mt-3 inline-flex items-center gap-2 text-hijau-700 hover:text-hijau-900 text-xs font-semibold transition-colors"
                                    data-open="0">
                                    <span class="sejarah-item-label">Lihat deskripsi lengkap</span>
                                    <i data-feather="chevron-down" class="w-4 h-4 sejarah-item-arrow transition-transform duration-300"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Timeline dot -->
                    <div
                        class="hidden md:flex w-12 h-12 bg-white border-2 border-hijau-500 rounded-full items-center justify-center shadow-lg shadow-hijau-500/10 flex-shrink-0 z-10 reveal-scale">
                        <span class="text-hijau-800 font-bold text-sm"><?= str_pad($idx + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    </div>

                    <!-- Empty space -->
                    <div class="flex-1 hidden md:block"></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<!-- ============================================================ -->
<!-- VISI MISI SECTION -->
<!-- ============================================================ -->
<?php
// RESOLUSI BACKGROUND: video > gambar > default hijau
// PERBAIKAN TYPO: "isimisi_*" → "visimisi_*" (typo di file asli)
$vm_bg_video        = isset($profil) && $profil && !empty($profil->visimisi_bg_video)        ? $profil->visimisi_bg_video        : null;
$vm_bg_image        = isset($profil) && $profil && !empty($profil->visimisi_bg_image)        ? $profil->visimisi_bg_image        : null;
$vm_overlay_color   = isset($profil) && $profil && !empty($profil->visimisi_overlay_color)   ? $profil->visimisi_overlay_color   : '#052e16';
$vm_overlay_opacity = isset($profil) && $profil && isset($profil->visimisi_overlay_opacity)  ? (int) $profil->visimisi_overlay_opacity : 85;

$vm_ov_alpha   = round($vm_overlay_opacity / 100, 2);
$vm_has_video  = !empty($vm_bg_video);
$vm_has_image  = !empty($vm_bg_image);
$vm_has_custom = $vm_has_video || $vm_has_image;
$vm_use_video_on_home = $vm_has_video && !$vm_has_image;
?>
<section id="visi-misi" class="min-h-screen relative overflow-hidden<?= !$vm_has_custom ? ' bg-hijau-950 grain' : '' ?>" style="isolation:isolate; display:flex; flex-direction:column; justify-content:center; contain: layout style;">

    <?php if ($vm_use_video_on_home): ?>
        <!-- VIDEO BACKGROUND — optimized: decoding on separate thread, no preload of full video -->
        <video id="visi-video-bg" muted loop playsinline preload="none" disablepictureinpicture
            class="absolute inset-0 w-full h-full object-cover"
            style="z-index:0; transform:translateZ(0); backface-visibility:hidden;">
            <source src="<?= base_url('assets/images/uploads/profil/' . $vm_bg_video) ?>" type="video/mp4">
        </video>

    <?php elseif ($vm_has_image): ?>
        <!-- IMAGE BACKGROUND -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
            style="background-image:url('<?= base_url('assets/images/uploads/profil/' . $vm_bg_image) ?>'); z-index:0;"></div>
    <?php endif; ?>

    <!-- COLOR OVERLAY — selalu tampil agar teks tetap terbaca -->
    <div class="absolute inset-0"
        style="background-color:<?= $vm_overlay_color ?>; opacity:<?= $vm_ov_alpha ?>; z-index:1;"></div>

    <!-- Pattern & dekorasi -->
    <div class="absolute inset-0 pattern-bg opacity-10" style="z-index:2;"></div>
    <?php if ($vm_has_custom): ?>
        <div class="absolute inset-0 grain" style="z-index:2; opacity:.14;"></div>
    <?php endif; ?>

    <!-- Decorative blobs — reduced blur radius for GPU savings -->
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full"
        style="z-index:3; background:radial-gradient(circle, rgba(234,179,8,0.05) 0%, transparent 70%); opacity:.85;"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full"
        style="z-index:3; background:radial-gradient(circle, rgba(74,222,128,0.04) 0%, transparent 72%); opacity:.75;"></div>

    <!-- Floating particles (CSS-only, no GSAP, runs on compositor thread) -->
    <div id="visi-particles" class="absolute inset-0 overflow-hidden pointer-events-none" style="z-index:3;"></div>

    <!-- CONTENT -->
    <div class="container mx-auto px-4 lg:px-8 relative pt-28 pb-32 md:pt-36 md:pb-40" style="z-index:10;">
        <!-- Section header -->
        <div class="text-center mb-20 reveal">
            <div class="ornament-divider mb-5 max-w-xs mx-auto">
                <span class="font-arabic text-kuning-400/70 text-xl">الرؤية</span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-5 split-text"
                data-split-reveal>Visi &amp; Misi</h2>
            <p class="text-hijau-300/70 max-w-lg mx-auto text-base">Fondasi dan arah perjalanan Yayasan Ar-Razaq</p>
        </div>

        <!-- VISI -->
        <?php if (!empty($visi)):
            $v = $visi[0]; ?>
            <div class="max-w-3xl mx-auto mb-20 reveal">
                <div class="relative bg-gradient-to-br from-kuning-500/10 to-kuning-500/3 border border-kuning-500/15 rounded-[2rem] p-8 md:p-14 text-center overflow-hidden">
                    <div class="absolute top-0 left-0 w-20 h-20 border-t-2 border-l-2 border-kuning-500/20 rounded-tl-[2rem]"></div>
                    <div class="absolute bottom-0 right-0 w-20 h-20 border-b-2 border-r-2 border-kuning-500/20 rounded-br-[2rem]"></div>
                    <div class="w-14 h-14 bg-kuning-500/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i data-feather="eye" class="w-7 h-7 text-kuning-400"></i>
                    </div>
                    <div class="text-kuning-400/80 font-medium text-xs tracking-[0.2em] uppercase mb-5">Visi Kami</div>
                    <p class="text-white font-display text-xl md:text-2xl leading-relaxed font-medium italic">
                        "<?= $v->konten ?>"
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <!-- MISI -->
        <?php if (!empty($misi)): ?>
            <div class="mb-20">
                <h3 class="font-display text-2xl font-bold text-kuning-400 text-center mb-12 reveal">Misi Yayasan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl mx-auto stagger-parent">
                    <?php foreach ($misi as $idx => $item): ?>
                        <div class="stagger-child group">
                            <div class="flex gap-5 bg-white/[0.04] border border-white/[0.08] rounded-2xl p-6 hover:border-kuning-500/20 hover:bg-white/[0.07] transition-colors duration-300 h-full">
                                <div class="w-11 h-11 bg-hijau-800/60 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-kuning-500/20 transition-colors duration-500">
                                    <i data-feather="<?= $item->ikon ?: 'check-circle' ?>" class="w-5 h-5 text-kuning-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold mb-2 text-[15px]"><?= $item->judul ?></h4>
                                    <p class="text-hijau-300/60 text-sm leading-relaxed"><?= $item->konten ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- NILAI -->
        <?php if (!empty($nilai)): ?>
            <div>
                <h3 class="font-display text-2xl font-bold text-kuning-400 text-center mb-12 reveal">Nilai-Nilai Kami</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5 max-w-3xl mx-auto stagger-parent">
                    <?php foreach ($nilai as $item): ?>
                        <div class="stagger-child text-center group">
                            <div class="w-16 h-16 bg-gradient-to-br from-hijau-800 to-hijau-900 group-hover:from-kuning-500 group-hover:to-kuning-600 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all duration-700 shadow-lg group-hover:shadow-kuning-500/20 group-hover:-translate-y-1">
                                <i data-feather="<?= $item->ikon ?: 'star' ?>" class="w-7 h-7 text-kuning-400 group-hover:text-hijau-950 transition-colors duration-500"></i>
                            </div>
                            <h4 class="text-white font-semibold text-sm mb-1"><?= $item->judul ?></h4>
                            <p class="text-hijau-400/50 text-xs leading-relaxed"><?= $item->konten ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>


<!-- ============================================================ -->
<!-- GALERI SECTION - HORIZONTAL SCROLL -->
<!-- ============================================================ -->
<section id="galeri" class="py-24 md:py-32 bg-gray-50 relative overflow-hidden">
    <div
        class="absolute top-0 left-0 right-0 h-40 bg-gradient-to-b from-gray-50 to-transparent z-10 pointer-events-none">
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <div class="ornament-divider mb-5 max-w-xs mx-auto">
                <span class="font-arabic text-hijau-600/70 text-xl">الصور</span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-hijau-900 mb-5 split-text"
                data-split-reveal>Galeri Yayasan</h2>
            <p class="text-gray-500 max-w-lg mx-auto text-base">Mengabadikan setiap momen berharga dalam perjalanan
                yayasan kami</p>
        </div>
    </div>

    <?php if (!empty($galeri)): ?>
        <!-- Horizontal scroll container -->
        <div id="gallery-scroll-section" class="relative">
            <div class="container mx-auto px-4 lg:px-8">
                <div id="gallery-scroll-wrapper" class="horizontal-scroll-wrapper py-8">
                    <?php foreach ($galeri as $idx => $foto): ?>
                        <div class="gallery-card group relative rounded-3xl overflow-hidden bg-hijau-100 cursor-pointer flex-shrink-0 shadow-lg shadow-hijau-900/5"
                            onclick="openLightbox('<?= base_url('assets/images/uploads/galeri/' . $foto->gambar) ?>', '<?= htmlspecialchars($foto->judul) ?>')">
                            <?php if ($foto->gambar && strpos($foto->gambar, 'placeholder') === false): ?>
                                <img src="<?= base_url('assets/images/uploads/galeri/' . $foto->gambar) ?>"
                                    alt="<?= $foto->judul ?>"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    onerror="this.src='<?= base_url('assets/images/placeholder.jpg') ?>'">
                            <?php else: ?>
                                <div
                                    class="w-full h-full bg-gradient-to-br from-hijau-100 to-hijau-200 flex items-center justify-center">
                                    <i data-feather="image" class="w-12 h-12 text-hijau-300"></i>
                                </div>
                            <?php endif; ?>
                            <div
                                class="absolute inset-0 img-overlay opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                                <div>
                                    <p class="text-white font-semibold text-base mb-1"><?= $foto->judul ?></p>
                                    <?php if (!empty($foto->label)): ?>
                                        <span
                                            class="bg-kuning-500/90 text-hijau-950 text-xs font-semibold px-3 py-1 rounded-full"><?= htmlspecialchars($foto->label, ENT_QUOTES) ?></span>
                                    <?php elseif ($foto->kategori): ?>
                                        <span
                                            class="bg-kuning-500/90 text-hijau-950 text-xs font-semibold px-3 py-1 rounded-full"><?= ucfirst($foto->kategori) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div
                                class="absolute top-4 right-4 w-10 h-10 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 group-hover:scale-100 scale-75">
                                <i data-feather="zoom-in" class="w-4 h-4 text-white"></i>
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
    class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 invisible transition-all duration-500"
    data-lenis-prevent>
    <button onclick="closeLightbox()"
        class="absolute top-6 right-6 text-white/60 hover:text-white transition-colors z-10">
        <i data-feather="x" class="w-8 h-8"></i>
    </button>
    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[85vh] rounded-2xl object-contain shadow-2xl">
    <div class="absolute bottom-8 text-center">
        <p id="lightbox-caption" class="text-white/80 font-medium text-lg"></p>
    </div>
</div>

<!-- ============================================================ -->
<!-- EKSKUL SECTION -->
<!-- ============================================================ -->
<section id="ekskul" class="py-24 md:py-32 bg-white relative overflow-hidden">
    <!-- Wave top -->
    <div class="wave-divider wave-top">
        <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="display:block;">
            <path d="M0,40 C360,0 720,80 1080,40 C1260,20 1380,30 1440,40 L1440,0 L0,0 Z" fill="#f9fafb" />
        </svg>
    </div>

    <!-- Decorative bg -->
    <div class="absolute right-0 top-20 w-80 h-80 bg-hijau-50 rounded-full blur-[120px] opacity-50"></div>
    <div class="absolute left-0 bottom-20 w-72 h-72 bg-kuning-50 rounded-full blur-[100px] opacity-40"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="text-center mb-20 reveal">
            <div class="ornament-divider mb-5 max-w-xs mx-auto">
                <span class="font-arabic text-hijau-600/70 text-xl">النشاطات</span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-hijau-900 mb-5 split-text"
                data-split-reveal>Ekstrakurikuler</h2>
            <p class="text-gray-500 max-w-lg mx-auto text-base">Mengembangkan bakat dan potensi santri melalui berbagai
                kegiatan unggulan</p>
        </div>

        <?php if (!empty($ekskul)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 stagger-parent">
                <?php foreach ($ekskul as $idx => $item): ?>
                    <?php $ekskul_slug = !empty($item->slug) ? $item->slug : ('ekskul-' . (int) $item->id); ?>
                    <div class="stagger-child group">
                        <div class="bg-white rounded-3xl overflow-hidden border border-gray-100/80 shadow-sm card-hover h-full">
                            <!-- Image or gradient header -->
                            <?php if ($item->gambar): ?>
                                <div class="h-48 overflow-hidden relative">
                                    <img src="<?= base_url('assets/images/uploads/ekskul/' . $item->gambar) ?>"
                                        alt="<?= $item->nama ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                            <?php else: ?>
                                <div
                                    class="h-44 bg-gradient-to-br from-hijau-800 to-hijau-900 flex items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 pattern-bg opacity-20"></div>
                                    <i data-feather="<?= $item->ikon ?: 'star' ?>"
                                        class="w-14 h-14 text-kuning-400/30 relative z-10 group-hover:scale-110 transition-transform duration-500"></i>
                                </div>
                            <?php endif; ?>

                            <div class="p-6">
                                <div class="flex items-start justify-between mb-4">
                                    <div
                                        class="w-10 h-10 bg-hijau-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-hijau-100 transition-colors duration-300">
                                        <i data-feather="<?= $item->ikon ?: 'star' ?>" class="w-5 h-5 text-hijau-700"></i>
                                    </div>
                                    <span
                                        class="text-xs font-semibold text-hijau-600 bg-hijau-50 px-3 py-1 rounded-full">Aktif</span>
                                </div>
                                <h3 class="font-display text-lg font-bold text-hijau-900 mb-2"><?= $item->nama ?></h3>
                                <p class="text-gray-500 text-sm leading-relaxed mb-4"><?= $item->deskripsi ?></p>

                                <?php if ($item->jadwal || $item->pembina): ?>
                                    <div class="pt-4 border-t border-gray-100 space-y-2">
                                        <?php if ($item->jadwal): ?>
                                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                                <i data-feather="clock" class="w-3.5 h-3.5 text-hijau-500"></i>
                                                <?= $item->jadwal ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($item->pembina): ?>
                                            <div class="flex items-center gap-2 text-xs text-gray-400">
                                                <i data-feather="user" class="w-3.5 h-3.5 text-hijau-500"></i>
                                                <?= $item->pembina ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="pt-4">
                                    <a href="<?= base_url('ekskul/' . rawurlencode($ekskul_slug)) ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-hijau-700 hover:text-hijau-900 transition-colors">
                                        Lihat Detail
                                        <i data-feather="arrow-right" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================================================ -->
<!-- BERITA SECTION -->
<!-- ============================================================ -->
<section id="berita" class="pt-24 md:pt-32 pb-10 md:pb-12 bg-gray-50 relative overflow-visible">
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="reveal">
                <div class="ornament-divider mb-5 max-w-[200px]">
                    <span class="font-arabic text-hijau-600/70 text-xl">الأخبار</span>
                </div>
                <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-hijau-900 mb-3 split-text"
                    data-split-reveal>Berita Terkini</h2>
                <p class="text-gray-500 text-base">Informasi terbaru dari Yayasan Ar-Razaq</p>
            </div>
            <a href="<?= base_url('berita') ?>"
                class="reveal inline-flex items-center gap-2 text-hijau-700 font-semibold hover:text-hijau-900 transition-colors group self-start md:self-auto">
                Lihat Semua
                <i data-feather="arrow-right"
                    class="w-4 h-4 group-hover:translate-x-2 transition-transform duration-300"></i>
            </a>
        </div>

        <?php if (!empty($berita)): ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-7 stagger-parent overflow-visible">
                <?php foreach ($berita as $idx => $post): ?>
                    <article class="stagger-child group overflow-visible">
                        <a href="<?= base_url('berita/' . $post->slug) ?>"
                            class="block bg-white rounded-3xl overflow-hidden border border-gray-100/80 shadow-sm card-hover card-hover-soft h-full">
                            <!-- Thumbnail -->
                            <div class="aspect-video overflow-hidden bg-hijau-50 relative">
                                <?php if ($post->gambar): ?>
                                    <img src="<?= base_url('assets/images/uploads/berita/' . $post->gambar) ?>"
                                        alt="<?= $post->judul ?>"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-hijau-100 to-hijau-200 flex items-center justify-center\'><i data-feather=\'image\' class=\'w-10 h-10 text-hijau-400\'></i></div>'">
                                <?php else: ?>
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-hijau-50 to-hijau-100 flex items-center justify-center">
                                        <i data-feather="file-text" class="w-10 h-10 text-hijau-300"></i>
                                    </div>
                                <?php endif; ?>
                                <!-- Category overlay -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="bg-white/90 backdrop-blur-sm text-hijau-800 text-xs font-bold px-3 py-1.5 rounded-full capitalize shadow-sm"><?= $post->kategori ?></span>
                                </div>
                            </div>

                            <div class="p-6">
                                <!-- Date -->
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="text-gray-400 text-xs flex items-center gap-1.5">
                                        <i data-feather="calendar" class="w-3 h-3"></i>
                                        <?= date('d M Y', strtotime($post->tanggal_publish)) ?>
                                    </span>
                                </div>

                                <h3
                                    class="font-display font-bold text-hijau-900 text-lg mb-3 leading-snug line-clamp-2 group-hover:text-hijau-700 transition-colors duration-300">
                                    <?= $post->judul ?>
                                </h3>

                                <?php if ($post->ringkasan): ?>
                                    <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 mb-5"><?= $post->ringkasan ?></p>
                                <?php endif; ?>

                                <div
                                    class="flex items-center text-hijau-600 text-sm font-semibold group-hover:gap-3 transition-all duration-300 gap-1.5">
                                    Baca Selengkapnya
                                    <i data-feather="arrow-right"
                                        class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"></i>
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
<!-- PPDB SECTION (CTA Banner) -->
<!-- ============================================================ -->
<?php if (!empty($ppdb)): ?>
    <section id="ppdb" class="pt-16 md:pt-20 pb-24 md:pb-32 relative overflow-hidden grain">

        <!-- Solid background -->
        <div class="absolute inset-0 bg-hijau-900"></div>
        <div class="absolute inset-0 pattern-bg opacity-15"></div>

        <!-- Decorative elements -->
        <div class="absolute -top-32 -right-32 w-96 h-96 bg-kuning-400/8 rounded-full blur-[100px] floating-slow"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-hijau-400/8 rounded-full blur-[80px] floating"></div>

        <!-- Floating crescents -->
        <div class="absolute top-20 left-[10%] opacity-[0.06] floating hidden lg:block">
            <svg width="60" height="60" viewBox="0 0 60 60" fill="white">
                <path d="M30 5C16.2 5 5 16.2 5 30s11.2 25 25 25c-8.3 0-15-11.2-15-25S21.7 5 30 5z" />
            </svg>
        </div>
        <div class="absolute bottom-32 right-[12%] opacity-[0.05] floating-delay hidden lg:block">
            <svg width="40" height="40" viewBox="0 0 60 60" fill="white">
                <path d="M30 5C16.2 5 5 16.2 5 30s11.2 25 25 25c-8.3 0-15-11.2-15-25S21.7 5 30 5z" />
            </svg>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-20">
            <div class="max-w-4xl mx-auto text-center reveal">
                <div
                    class="inline-flex items-center gap-2 bg-kuning-400/10 border border-kuning-400/20 text-kuning-300 px-5 py-2 rounded-full text-sm font-medium mb-10">
                    <span class="w-2 h-2 bg-kuning-400 rounded-full animate-pulse"></span>
                    Pendaftaran Tahun Ajaran <?= $ppdb->tahun_ajaran ?>
                </div>

                <h2 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 split-text"
                    data-split-reveal>
                    <?= $ppdb->judul ?>
                </h2>

                <?php if ($ppdb->deskripsi): ?>
                    <p class="text-hijau-200/70 text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
                        <?= $ppdb->deskripsi ?>
                    </p>
                <?php endif; ?>

                <!-- Key info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12 max-w-3xl mx-auto">
                    <?php if ($ppdb->tanggal_buka && $ppdb->tanggal_tutup): ?>
                        <div class="bg-white/[0.04] backdrop-blur-sm border border-white/[0.08] rounded-2xl p-6 card-hover">
                            <div class="text-kuning-400 mb-3"><i data-feather="calendar" class="w-6 h-6 mx-auto"></i></div>
                            <div class="text-white text-sm font-semibold">Periode Pendaftaran</div>
                            <div class="text-hijau-300/60 text-xs mt-1"><?= date('d M Y', strtotime($ppdb->tanggal_buka)) ?> -
                                <?= date('d M Y', strtotime($ppdb->tanggal_tutup)) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if ($ppdb->kuota): ?>
                        <div class="bg-white/[0.04] backdrop-blur-sm border border-white/[0.08] rounded-2xl p-6 card-hover">
                            <div class="text-kuning-400 mb-3"><i data-feather="users" class="w-6 h-6 mx-auto"></i></div>
                            <div class="text-white text-sm font-semibold">Kuota Tersedia</div>
                            <div class="text-hijau-300/60 text-xs mt-1"><?= number_format($ppdb->kuota) ?> Santri</div>
                        </div>
                    <?php endif; ?>

                    <?php if ($ppdb->biaya_pendaftaran): ?>
                        <div class="bg-white/[0.04] backdrop-blur-sm border border-white/[0.08] rounded-2xl p-6 card-hover">
                            <div class="text-kuning-400 mb-3"><i data-feather="credit-card" class="w-6 h-6 mx-auto"></i></div>
                            <div class="text-white text-sm font-semibold">Biaya Pendaftaran</div>
                            <div class="text-hijau-300/60 text-xs mt-1">Rp
                                <?= number_format($ppdb->biaya_pendaftaran, 0, ',', '.') ?></div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?= base_url('ppdb') ?>"
                        class="magnetic-btn bg-kuning-500 text-hijau-950 font-bold px-10 py-4 rounded-2xl text-base shadow-xl shadow-kuning-500/20 hover:shadow-kuning-500/40 transition-all duration-500 hover:-translate-y-1 flex items-center justify-center gap-2 pulse-glow">
                        <i data-feather="user-plus" class="w-5 h-5"></i>
                        Daftar Sekarang
                    </a>
                    <?php if ($ppdb->link_pendaftaran): ?>
                        <a href="<?= $ppdb->link_pendaftaran ?>" target="_blank"
                            class="magnetic-btn border border-white/15 text-white font-semibold px-10 py-4 rounded-2xl text-base hover:bg-white/10 transition-all duration-500 flex items-center justify-center gap-2">
                            <i data-feather="external-link" class="w-5 h-5"></i>
                            Daftar Online
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- ============================================================ -->
<!-- PAGE-SPECIFIC SCRIPTS -->
<!-- ============================================================ -->
<script>
    // Lightbox functions
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
                    gsap.set(shortEl, {
                        display: 'block',
                        opacity: 1,
                        y: 0
                    });
                    gsap.set(fullWrap, {
                        display: 'block',
                        height: 'auto',
                        opacity: 0,
                        overflow: 'hidden'
                    });
                    const targetHeight = fullWrap.scrollHeight;
                    gsap.set(fullWrap, {
                        height: 0,
                        opacity: 0
                    });

                    gsap.timeline()
                        .to(fullWrap, {
                            height: targetHeight,
                            opacity: 1,
                            duration: 0.46,
                            ease: 'power2.out',
                            onComplete: () => {
                                gsap.set(fullWrap, {
                                    height: 'auto'
                                });
                                gsap.set(shortEl, {
                                    display: 'none',
                                    opacity: 1,
                                    y: 0
                                });
                            }
                        }, 0)
                        .to(shortEl, {
                            opacity: 0.35,
                            duration: 0.26,
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
                        opacity: 0.35,
                        y: 0
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
                                opacity: 1,
                                y: 0
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

    // Sejarah profile description expand/collapse (binary: ringkas <-> lengkap)
    initBinaryToggle(
        '.sejarah-overview-toggle',
        '.sejarah-overview-short',
        '.sejarah-overview-full-wrap',
        '.sejarah-overview-label',
        '.sejarah-overview-arrow',
        'Lihat deskripsi lengkap',
        'Sembunyikan deskripsi lengkap'
    );

    // Sejarah timeline item expand/collapse (binary: ringkas <-> lengkap)
    initBinaryToggle(
        '.sejarah-item-toggle',
        '.sejarah-item-short',
        '.sejarah-item-full-wrap',
        '.sejarah-item-label',
        '.sejarah-item-arrow',
        'Lihat deskripsi lengkap',
        'Sembunyikan deskripsi'
    );
</script>