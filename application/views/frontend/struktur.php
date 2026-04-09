<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
$struktur_title = isset($profil) && $profil && !empty($profil->struktur_organisasi_judul)
    ? $profil->struktur_organisasi_judul
    : 'Struktur Susunan Organisasi Yayasan Ar-Razaq';
$struktur_desc = isset($profil) && $profil ? trim((string) $profil->struktur_organisasi_deskripsi) : '';
$struktur_img = isset($profil) && $profil ? trim((string) $profil->struktur_organisasi_gambar) : '';
$anggota = isset($anggota_struktur) && is_array($anggota_struktur) ? $anggota_struktur : [];
?>

<section class="relative pt-32 pb-20 md:pt-40 md:pb-28 bg-hijau-950 overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-20"></div>
    <div class="absolute top-1/4 -left-20 w-[400px] h-[400px] bg-hijau-700/15 rounded-full blur-[120px] floating-slow"></div>
    <div class="absolute bottom-1/3 -right-20 w-[300px] h-[300px] bg-kuning-500/8 rounded-full blur-[100px] floating"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <div class="ornament-divider mb-5 max-w-xs mx-auto">
            <span class="font-arabic text-kuning-400/70 text-xl">بنية</span>
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Struktur</h1>
        <p class="text-hijau-200/70 text-lg max-w-xl mx-auto">Informasi terbaru dari Yayasan Ar-Razaq</p>
    </div>
</section>

<section class="relative pt-32 pb-20 md:pt-40 md:pb-24 bg-[#eef2f2] overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <p class="text-sm font-semibold text-hijau-700 mb-2 reveal">Struktur Organisasi</p>
            <h1 class="font-display text-4xl md:text-5xl font-bold text-hijau-950 leading-tight reveal">
                <?= html_escape($struktur_title) ?>
            </h1>
            <?php if ($struktur_desc !== ''): ?>
                <p class="text-gray-600 mt-4 text-base md:text-lg max-w-3xl reveal">
                    <?= nl2br(html_escape($struktur_desc)) ?>
                </p>
            <?php endif; ?>

            <div class="mt-10 bg-white rounded-3xl border border-gray-200 shadow-sm p-4 md:p-7 reveal">
                <?php if ($struktur_img !== ''): ?>
                    <img
                        src="<?= base_url('assets/images/uploads/profil/' . $struktur_img) ?>"
                        alt="<?= html_escape($struktur_title) ?>"
                        class="w-full h-auto rounded-2xl border border-gray-100 object-contain"
                        loading="lazy">
                <?php else: ?>
                    <div class="py-20 text-center text-gray-400">
                        <i data-feather="image" class="w-12 h-12 mx-auto mb-3 opacity-40"></i>
                        <p class="font-semibold text-gray-500">Gambar bagan struktur belum tersedia</p>
                        <p class="text-sm mt-1">Silakan upload lewat Dashboard Admin menu Struktur.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="py-16 md:py-24 bg-[#eef2f2]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="mb-8 md:mb-10">
                <h2 class="font-display text-3xl md:text-4xl font-bold text-hijau-950 reveal">Profil Pengurus</h2>
                <p class="text-gray-600 mt-2 reveal">Daftar anggota organisasi berdasarkan hierarki jabatan.</p>
            </div>

            <?php if (!empty($anggota)): ?>
                <?php $utama = $anggota[0]; ?>
                <div class="mb-7 reveal">
                    <a href="<?= base_url('struktur/anggota/' . rawurlencode(!empty($utama->slug) ? $utama->slug : ('anggota-' . (int) $utama->id))) ?>"
                        class="group relative block max-w-sm bg-white rounded-[28px] border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden">
                        <span class="absolute top-4 right-4 z-10 w-10 h-10 rounded-xl bg-kuning-500/90 text-hijau-950 flex items-center justify-center shadow-md">
                            <i data-feather="arrow-up-right" class="w-4 h-4"></i>
                        </span>
                        <div class="p-3">
                            <?php if (!empty($utama->foto)): ?>
                                <img src="<?= base_url('assets/images/uploads/struktur/' . $utama->foto) ?>" alt="<?= html_escape($utama->nama) ?>" class="w-full aspect-[4/5] object-cover rounded-2xl">
                            <?php else: ?>
                                <div class="w-full aspect-[4/5] rounded-2xl bg-gray-100 flex items-center justify-center text-gray-300">
                                    <i data-feather="user" class="w-12 h-12"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="px-5 pb-5 pt-1">
                            <h3 class="font-semibold text-xl text-gray-900 leading-tight"><?= html_escape($utama->nama) ?></h3>
                            <p class="text-hijau-700 font-medium mt-1"><?= html_escape($utama->jabatan) ?></p>
                            <div class="mt-3 inline-flex items-center gap-2 text-sm font-semibold text-hijau-800">Lihat profil</div>
                        </div>
                    </a>
                </div>

                <?php if (count($anggota) > 1): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 md:gap-6">
                        <?php foreach (array_slice($anggota, 1) as $row): ?>
                            <?php $slug = !empty($row->slug) ? $row->slug : ('anggota-' . (int) $row->id); ?>
                            <a href="<?= base_url('struktur/anggota/' . rawurlencode($slug)) ?>"
                                class="group relative block bg-white rounded-[24px] border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden reveal">
                                <span class="absolute top-4 right-4 z-10 w-9 h-9 rounded-xl bg-kuning-500/85 text-hijau-950 flex items-center justify-center shadow-sm">
                                    <i data-feather="arrow-up-right" class="w-3.5 h-3.5"></i>
                                </span>
                                <div class="p-3">
                                    <?php if (!empty($row->foto)): ?>
                                        <img src="<?= base_url('assets/images/uploads/struktur/' . $row->foto) ?>" alt="<?= html_escape($row->nama) ?>" class="w-full aspect-[4/5] object-cover rounded-2xl">
                                    <?php else: ?>
                                        <div class="w-full aspect-[4/5] rounded-2xl bg-gray-100 flex items-center justify-center text-gray-300">
                                            <i data-feather="user" class="w-10 h-10"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="px-4 pb-5 pt-1">
                                    <h3 class="font-semibold text-lg text-gray-900 leading-tight"><?= html_escape($row->nama) ?></h3>
                                    <p class="text-gray-600 mt-1"><?= html_escape($row->jabatan) ?></p>
                                    <div class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-hijau-800">Lihat profil</div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="bg-white rounded-3xl border border-gray-200 shadow-sm py-14 px-6 text-center text-gray-500 reveal">
                    <i data-feather="users" class="w-12 h-12 mx-auto mb-3 opacity-40"></i>
                    <p class="font-semibold">Data anggota struktur belum tersedia.</p>
                    <p class="text-sm mt-1">Tambahkan anggota melalui Dashboard Admin menu Struktur.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>