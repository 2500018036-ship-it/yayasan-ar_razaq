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
$article_body = $about_full !== '' ? $about_full : $about_short;
$article_lead = ($about_short !== '' && $about_short !== $article_body) ? $about_short : '';
$article_image_file = '';
if ($about_media_file !== '' && !$about_media_is_video) {
    $article_image_file = $about_media_file;
} elseif (isset($profil) && $profil && trim((string) $profil->hero_image) !== '') {
    $article_image_file = trim((string) $profil->hero_image);
}
$article_image_url = $article_image_file !== ''
    ? base_url('assets/images/uploads/profil/' . $article_image_file)
    : base_url('assets/images/placeholder.webp');
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

<section class="py-16 md:py-24 bg-white relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-6xl mx-auto grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_280px] gap-10 xl:gap-12 items-start">
            <article class="min-w-0">
                <div class="rounded-[32px] overflow-hidden border border-gray-100 shadow-xl shadow-hijau-900/8 bg-white reveal">
                    <img src="<?= $article_image_url ?>" alt="<?= html_escape($about_name) ?>"
                        class="w-full aspect-[16/9] object-cover"
                        onerror="this.src='<?= base_url('assets/images/placeholder.webp') ?>'">
                </div>

                <div class="mt-8 flex flex-wrap items-center gap-3 text-xs font-semibold reveal">
                    <span class="inline-flex items-center gap-2 rounded-full bg-hijau-50 px-4 py-2 text-hijau-700 border border-hijau-100">
                        <i data-feather="book-open" class="w-3.5 h-3.5"></i>
                        <?= html_escape($about_label) ?>
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-gray-50 px-4 py-2 text-gray-500 border border-gray-100">
                        <i data-feather="file-text" class="w-3.5 h-3.5"></i>
                        <?= html_escape($about_badge) ?>
                    </span>
                </div>

                <header class="mt-6 reveal">
                    <h2 class="font-display text-4xl md:text-5xl font-bold text-hijau-900 leading-tight"><?= html_escape($about_name) ?></h2>
                    <?php if ($about_tagline !== ''): ?>
                        <p class="mt-5 text-lg text-gray-500 leading-relaxed max-w-3xl"><?= html_escape($about_tagline) ?></p>
                    <?php endif; ?>
                </header>

                <div class="mt-10 rounded-[32px] border border-gray-100 bg-white shadow-sm p-8 md:p-10 reveal">
                    <?php if ($article_lead !== ''): ?>
                        <p class="text-xl text-hijau-900 leading-relaxed font-medium pb-8 mb-8 border-b border-gray-100"><?= nl2br(html_escape($article_lead)) ?></p>
                    <?php endif; ?>

                    <div class="prose prose-lg max-w-none text-gray-700" style="font-size: 1.05rem; line-height: 1.95;">
                        <?= nl2br(html_escape($article_body)) ?>
                    </div>
                </div>

                <?php if ($about_cta_text !== '' || !empty($history_items)): ?>
                <?php endif; ?>
            </article>

            <aside class="reveal-right">
                <div class="xl:sticky xl:top-32 space-y-5">
                    <div class="rounded-[28px] border border-hijau-100 bg-hijau-50 p-6">
                        <div class="text-xs uppercase tracking-[0.24em] font-bold text-hijau-700">Profil Singkat</div>
                        <p class="mt-3 text-sm text-gray-600 leading-relaxed"><?= nl2br(html_escape($about_short)) ?></p>

                        <div class="mt-5 space-y-3">
                            <div class="rounded-2xl border border-white/80 bg-white px-4 py-3">
                                <div class="text-[11px] uppercase tracking-[0.18em] font-bold text-gray-400">Nama Yayasan</div>
                                <div class="mt-1 text-sm font-semibold text-hijau-900"><?= html_escape($about_name) ?></div>
                            </div>
                            <div class="rounded-2xl border border-white/80 bg-white px-4 py-3">
                                <div class="text-[11px] uppercase tracking-[0.18em] font-bold text-gray-400">Tagline</div>
                                <div class="mt-1 text-sm leading-relaxed text-gray-600"><?= html_escape($about_tagline) ?></div>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($history_items)): ?>
                        <div class="rounded-[28px] border border-gray-100 bg-white p-6 shadow-sm">
                            <div class="text-xs uppercase tracking-[0.24em] font-bold text-hijau-700">Jejak Perjalanan</div>
                            <div class="mt-5 space-y-4">
                                <?php foreach (array_slice($history_items, 0, 4) as $history_item): ?>
                                    <?php
                                    $history_excerpt = trim(preg_replace('/\s+/', ' ', strip_tags((string) $history_item->konten)));
                                    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
                                        $history_excerpt = mb_strlen($history_excerpt, 'UTF-8') > 90 ? rtrim(mb_substr($history_excerpt, 0, 90, 'UTF-8')) . '...' : $history_excerpt;
                                    } else {
                                        $history_excerpt = strlen($history_excerpt) > 90 ? rtrim(substr($history_excerpt, 0, 90)) . '...' : $history_excerpt;
                                    }
                                    ?>
                                    <div class="flex gap-4">
                                        <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-2xl bg-hijau-900 text-xs font-bold text-kuning-400">
                                            <?= html_escape((string) ($history_item->tahun ?: '-')) ?>
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="text-sm font-semibold text-hijau-900"><?= html_escape((string) $history_item->judul) ?></h4>
                                            <?php if ($history_excerpt !== ''): ?>
                                                <p class="mt-1 text-xs leading-relaxed text-gray-500"><?= html_escape($history_excerpt) ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </aside>
        </div>
    </div>
</section>
