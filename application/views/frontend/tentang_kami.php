<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
$about_full = isset($profil) && $profil ? trim((string) $profil->deskripsi_lengkap) : '';
$about_short = isset($profil) && $profil ? trim((string) $profil->deskripsi_singkat) : '';
$about_text = $about_full !== '' ? $about_full : $about_short;
if ($about_text === '') {
    $about_text = 'Informasi tentang yayasan belum tersedia. Silakan lengkapi melalui panel admin.';
}
?>

<section class="relative pt-32 pb-20 md:pt-40 md:pb-28 bg-hijau-950 overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-12"></div>
    <div class="absolute top-1/4 -left-20 w-[360px] h-[360px] bg-hijau-700/10 rounded-full blur-[80px]"></div>
    <div class="absolute bottom-1/3 -right-20 w-[280px] h-[280px] bg-kuning-500/8 rounded-full blur-[72px]"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <div class="ornament-divider mb-5 max-w-xs mx-auto">
            <span class="font-arabic text-kuning-400/70 text-xl">من نحن</span>
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Tentang Kami</h1>
        <p class="text-hijau-200/70 text-lg max-w-2xl mx-auto">
            <?= isset($profil) && $profil && !empty($profil->tagline) ? html_escape($profil->tagline) : 'Profil resmi Yayasan Ar-Razaq dan perjalanan pengabdian kami.' ?>
        </p>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,60 L1440,120 L0,120 Z" fill="#f9fafb" />
        </svg>
    </div>
</section>

<section class="py-20 md:py-28 bg-gray-50 relative overflow-hidden">
    <div class="absolute top-20 right-0 w-72 h-72 bg-hijau-50 rounded-full blur-[100px] opacity-70"></div>
    <div class="absolute bottom-16 left-0 w-64 h-64 bg-kuning-50 rounded-full blur-[90px] opacity-60"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 md:p-10 reveal">
                <div class="flex flex-col md:flex-row md:items-center gap-5 md:gap-8 mb-5">
                    <div class="w-14 h-14 rounded-2xl bg-hijau-100 text-hijau-800 flex items-center justify-center">
                        <i data-feather="book-open" class="w-7 h-7"></i>
                    </div>
                    <div>
                        <h2 class="font-display text-2xl md:text-3xl font-bold text-hijau-900">Profil Yayasan</h2>
                        <p class="text-gray-500 text-sm mt-1">Konten ini bisa Anda ubah dari Dashboard Admin menu Profil Yayasan</p>
                    </div>
                </div>

                <p class="text-gray-600 leading-relaxed text-base md:text-lg">
                    <?= nl2br(html_escape($about_text)) ?>
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                    <div class="rounded-2xl border border-hijau-100 bg-hijau-50/50 px-5 py-4">
                        <div class="text-xs uppercase tracking-wide font-semibold text-hijau-700 mb-1">Tahun Berdiri</div>
                        <div class="text-hijau-900 font-display text-2xl font-bold">
                            <?= isset($profil) && $profil && !empty($profil->tahun_berdiri) ? html_escape($profil->tahun_berdiri) : '-' ?>
                        </div>
                    </div>
                    <div class="rounded-2xl border border-kuning-100 bg-kuning-50/40 px-5 py-4">
                        <div class="text-xs uppercase tracking-wide font-semibold text-kuning-700 mb-1">Akreditasi</div>
                        <div class="text-hijau-900 font-display text-2xl font-bold">
                            <?= isset($profil) && $profil && !empty($profil->status_akreditasi) ? html_escape($profil->status_akreditasi) : '-' ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($sejarah)): ?>
                <div class="mt-14 reveal">
                    <h3 class="font-display text-2xl md:text-3xl font-bold text-hijau-900 mb-6 text-center">Jejak Perjalanan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 stagger-parent">
                        <?php foreach ($sejarah as $idx => $item): ?>
                            <div class="stagger-child rounded-2xl bg-white border border-gray-100 shadow-sm p-6">
                                <div class="text-kuning-600 text-xs font-semibold tracking-wide uppercase mb-2">
                                    Periode <?= str_pad($idx + 1, 2, '0', STR_PAD_LEFT) ?>
                                </div>
                                <h4 class="font-display text-xl font-bold text-hijau-900 mb-3"><?= html_escape($item->judul) ?></h4>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <?= nl2br(html_escape($item->konten)) ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
