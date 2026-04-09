<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
$about_label = isset($profil) && $profil && trim((string) $profil->about_section_label) !== '' ? trim((string) $profil->about_section_label) : 'About Us';
$about_badge = isset($profil) && $profil && trim((string) $profil->about_section_badge) !== '' ? trim((string) $profil->about_section_badge) : 'Profil Singkat';
$about_name = isset($profil) && $profil && trim((string) $profil->nama_yayasan) !== '' ? trim((string) $profil->nama_yayasan) : 'Yayasan Ar-Razaq';
$about_tagline = isset($profil) && $profil && trim((string) $profil->tagline) !== '' ? trim((string) $profil->tagline) : 'Profil resmi yayasan dan perjalanan pengabdian kami.';

$about_full = isset($profil) && $profil ? trim((string) $profil->deskripsi_lengkap) : '';
$about_short = isset($profil) && $profil ? trim((string) $profil->deskripsi_singkat) : '';
if ($about_short === '' && $about_full !== '') {
    $plain = trim(preg_replace('/\s+/', ' ', strip_tags($about_full)));
    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        $about_short = mb_strlen($plain, 'UTF-8') > 260 ? rtrim(mb_substr($plain, 0, 260, 'UTF-8')) . '...' : $plain;
    } else {
        $about_short = strlen($plain) > 260 ? rtrim(substr($plain, 0, 260)) . '...' : $plain;
    }
}
if ($about_short === '') {
    $about_short = 'Informasi tentang yayasan belum tersedia. Silakan lengkapi melalui panel admin.';
}

$about_cta_text = isset($profil) && $profil && trim((string) $profil->about_section_cta_text) !== '' ? trim((string) $profil->about_section_cta_text) : 'Hubungi Kami';
$about_cta_link_raw = isset($profil) && $profil ? trim((string) $profil->about_section_cta_link) : '';
if ($about_cta_link_raw === '') {
    $about_cta_link = base_url('ppdb');
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
    : base_url('assets/images/placeholder.webp');

$history_items = !empty($sejarah) && is_array($sejarah) ? $sejarah : [];
?>

<section class="relative pt-32 pb-20 md:pt-40 md:pb-28 bg-hijau-950 overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-12"></div>
    <div class="absolute top-1/4 -left-20 w-[360px] h-[360px] bg-hijau-700/10 rounded-full blur-[80px]"></div>
    <div class="absolute bottom-1/3 -right-20 w-[280px] h-[280px] bg-kuning-500/8 rounded-full blur-[72px]"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <div class="ornament-divider mb-5 max-w-xs mx-auto">
            <span class="font-arabic text-kuning-400/70 text-xl">Man nahnu</span>
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Sejarah &amp; Profil Yayasan</h1>
        <p class="text-hijau-200/70 text-lg max-w-2xl mx-auto"><?= html_escape($about_tagline) ?></p>
    </div>
</section>

<section class="py-20 md:py-28 bg-gray-50 relative overflow-hidden">
    <div class="absolute top-20 right-0 w-72 h-72 bg-hijau-50 rounded-full blur-[100px] opacity-70"></div>
    <div class="absolute bottom-16 left-0 w-64 h-64 bg-kuning-50 rounded-full blur-[90px] opacity-60"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 space-y-14">
        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.05fr)_minmax(0,0.95fr)] gap-10 lg:gap-14 items-center">
            <div class="reveal-left relative">
                <div class="absolute -top-5 -right-5 w-24 h-24 rounded-[28px] bg-kuning-100/70 blur-2xl"></div>
                <div class="absolute -bottom-8 -left-8 w-28 h-28 rounded-full bg-hijau-100/70 blur-3xl"></div>

                <div class="relative overflow-hidden rounded-[32px] border border-hijau-100/70 bg-hijau-950 shadow-[0_40px_80px_rgba(5,46,22,0.14)]">
                    <?php if ($about_media_is_video): ?>
                        <video autoplay muted loop playsinline preload="metadata" controls
                            class="w-full h-[320px] sm:h-[420px] lg:h-[520px] object-cover bg-hijau-950">
                            <source src="<?= $about_media_url ?>" type="video/<?= html_escape($about_media_ext) ?>">
                        </video>
                    <?php else: ?>
                        <img src="<?= $about_media_url ?>" alt="<?= html_escape($about_name) ?>"
                            class="w-full h-[320px] sm:h-[420px] lg:h-[520px] object-cover">
                    <?php endif; ?>

                    <div class="absolute inset-0 bg-gradient-to-tr from-hijau-950 via-hijau-950/40 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6 md:p-8 pointer-events-none">
                        <div class="inline-flex items-center gap-2 rounded-full bg-white/12 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur">
                            <i data-feather="<?= $about_media_is_video ? 'video' : 'image' ?>" class="w-3.5 h-3.5"></i>
                            <?= $about_media_is_video ? 'Video Profil' : 'Visual Profil' ?>
                        </div>
                        <h2 class="mt-4 font-display text-3xl md:text-4xl font-bold text-white leading-tight"><?= html_escape($about_name) ?></h2>
                        <p class="mt-3 text-sm md:text-base text-white/78 max-w-lg leading-relaxed"><?= html_escape($about_tagline) ?></p>
                    </div>
                </div>
            </div>

            <div class="reveal-right">
                <div class="inline-flex items-center gap-2 rounded-full bg-kuning-50 px-4 py-2 text-sm font-semibold text-kuning-700 border border-kuning-100">
                    <i data-feather="sparkles" class="w-4 h-4"></i>
                    <?= html_escape($about_label) ?>
                </div>

                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center gap-2 rounded-full bg-hijau-50 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-hijau-700 border border-hijau-100">
                        Sejarah &amp; Profil
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 text-xs font-semibold text-gray-600 border border-gray-200">
                        <i data-feather="book-open" class="w-3.5 h-3.5 text-hijau-700"></i>
                        <?= html_escape($about_badge) ?>
                    </span>
                </div>

                <h2 class="mt-6 font-display text-4xl md:text-5xl font-bold text-hijau-900 leading-tight"><?= html_escape($about_name) ?></h2>
                <p class="mt-6 text-gray-600 text-base md:text-lg leading-[1.95]"><?= nl2br(html_escape($about_short)) ?></p>

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-3xl border border-hijau-100 bg-white p-5 shadow-sm">
                        <div class="text-xs uppercase tracking-[0.22em] font-bold text-hijau-700 mb-2">Profil Singkat</div>
                        <p class="text-sm text-gray-600 leading-relaxed">Konten utama section ini dikelola dari menu Profil pada dashboard admin.</p>
                    </div>
                    <div class="rounded-3xl border border-kuning-100 bg-white p-5 shadow-sm">
                        <div class="text-xs uppercase tracking-[0.22em] font-bold text-kuning-700 mb-2">Data Sejarah</div>
                        <p class="text-sm text-gray-600 leading-relaxed"><?= count($history_items) ?> data sejarah aktif ditampilkan otomatis pada halaman ini.</p>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row sm:items-center gap-4">
                    <a href="<?= $about_cta_link ?>"
                        class="magnetic-btn inline-flex items-center justify-center gap-3 rounded-2xl bg-[#6d3138] px-7 py-4 text-sm font-bold uppercase tracking-wide text-white shadow-[0_18px_40px_rgba(109,49,56,0.22)] transition-all duration-500 hover:-translate-y-1 hover:bg-[#5a272d]">
                        <?= html_escape($about_cta_text) ?>
                        <i data-feather="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <p class="text-sm text-gray-500 max-w-md">Perubahan teks, gambar, atau video di dashboard akan langsung tersinkron ke area ini.</p>
                </div>
            </div>
        </div>

        <?php if ($about_full !== ''): ?>
            <div class="bg-white rounded-[32px] border border-gray-100 shadow-sm p-8 md:p-10 reveal">
                <div class="flex flex-col md:flex-row md:items-start gap-5 md:gap-8">
                    <div class="w-14 h-14 rounded-2xl bg-hijau-100 text-hijau-800 flex items-center justify-center flex-shrink-0">
                        <i data-feather="feather" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h3 class="font-display text-2xl md:text-3xl font-bold text-hijau-900 mb-4">Cerita Lengkap Yayasan</h3>
                        <p class="text-gray-600 leading-[1.95] text-base md:text-lg"><?= nl2br(html_escape($about_full)) ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($history_items)): ?>
            <div class="reveal">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
                    <div>
                        <div class="text-xs uppercase tracking-[0.24em] font-bold text-hijau-700 mb-2">Jejak Yayasan</div>
                        <h3 class="font-display text-3xl md:text-4xl font-bold text-hijau-900">Perjalanan yang Terus Bertumbuh</h3>
                    </div>
                    <p class="text-sm text-gray-500 max-w-xl">Setiap data sejarah yang aktif dari dashboard admin akan langsung muncul sebagai rangkaian perjalanan yayasan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 stagger-parent">
                    <?php foreach ($history_items as $idx => $item): ?>
                        <?php
                        $history_plain = trim(preg_replace('/\s+/', ' ', strip_tags((string) $item->konten)));
                        if (function_exists('mb_strlen') && function_exists('mb_substr')) {
                            $history_excerpt = mb_strlen($history_plain, 'UTF-8') > 170 ? rtrim(mb_substr($history_plain, 0, 170, 'UTF-8')) . '...' : $history_plain;
                        } else {
                            $history_excerpt = strlen($history_plain) > 170 ? rtrim(substr($history_plain, 0, 170)) . '...' : $history_plain;
                        }
                        ?>
                        <article class="stagger-child rounded-[28px] bg-white border border-gray-100 shadow-sm overflow-hidden card-hover-soft">
                            <?php if (!empty($item->gambar)): ?>
                                <div class="aspect-[16/10] overflow-hidden bg-hijau-50">
                                    <img src="<?= base_url('assets/images/uploads/sejarah/' . $item->gambar) ?>" alt="<?= html_escape($item->judul) ?>"
                                        class="w-full h-full object-cover transition-transform duration-700 hover:scale-105">
                                </div>
                            <?php endif; ?>

                            <div class="p-6">
                                <div class="inline-flex items-center gap-2 rounded-full bg-hijau-50 px-3 py-1 text-xs font-semibold text-hijau-700 mb-4">
                                    Periode <?= str_pad($idx + 1, 2, '0', STR_PAD_LEFT) ?>
                                </div>
                                <h4 class="font-display text-2xl font-bold text-hijau-900 mb-3"><?= html_escape($item->judul) ?></h4>
                                <p class="text-sm text-gray-600 leading-relaxed"><?= html_escape($history_excerpt) ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
