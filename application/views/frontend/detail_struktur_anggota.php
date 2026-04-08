<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
$item = isset($anggota) ? $anggota : null;
if (!$item) {
    return;
}
?>

<section class="relative pt-32 pb-16 md:pt-40 md:pb-20 bg-hijau-950 overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-10"></div>
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <a href="<?= base_url('struktur') ?>" class="inline-flex items-center gap-2 text-hijau-200 hover:text-white text-sm font-semibold mb-6 transition-colors">
            <i data-feather="arrow-left" class="w-4 h-4"></i>
            Kembali ke Struktur
        </a>

        <h1 class="font-display text-4xl md:text-5xl font-bold text-white leading-tight">
            <?= htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8') ?>
        </h1>
        <p class="text-hijau-200 text-lg md:text-xl mt-3">
            <?= htmlspecialchars($item->jabatan, ENT_QUOTES, 'UTF-8') ?>
        </p>
    </div>
</section>

<section class="py-14 md:py-20 bg-[#eef2f2]">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-7">
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-4 sticky top-24">
                    <?php if (!empty($item->foto)): ?>
                        <img src="<?= base_url('assets/images/uploads/struktur/' . $item->foto) ?>" alt="<?= htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8') ?>" class="w-full aspect-[4/5] object-cover rounded-2xl">
                    <?php else: ?>
                        <div class="w-full aspect-[4/5] rounded-2xl bg-gray-100 flex items-center justify-center text-gray-300">
                            <i data-feather="user" class="w-14 h-14"></i>
                        </div>
                    <?php endif; ?>
                    <div class="mt-4 text-center">
                        <h2 class="font-semibold text-xl text-gray-900"><?= htmlspecialchars($item->nama, ENT_QUOTES, 'UTF-8') ?></h2>
                        <p class="text-hijau-700 font-medium mt-1"><?= htmlspecialchars($item->jabatan, ENT_QUOTES, 'UTF-8') ?></p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8">
                    <h3 class="font-display text-2xl md:text-3xl font-bold text-hijau-900 mb-4">Profil Lengkap</h3>
                    <div class="text-gray-700 leading-relaxed text-base md:text-lg">
                        <?php if (!empty($item->deskripsi_lengkap)): ?>
                            <?= nl2br(htmlspecialchars($item->deskripsi_lengkap, ENT_QUOTES, 'UTF-8')) ?>
                        <?php else: ?>
                            <p>Deskripsi lengkap untuk anggota ini belum tersedia.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
