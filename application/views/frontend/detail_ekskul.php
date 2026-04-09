<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
/** @var object|null $ekskul_item Data ekskul dari controller */
$item = isset($ekskul_item) ? $ekskul_item : null;
if (!$item) return;
?>

<section class="relative pt-32 pb-16 md:pt-40 md:pb-24 bg-hijau-950 overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-20"></div>
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <a href="<?= base_url('ekskul') ?>" class="inline-flex items-center gap-2 text-hijau-200 hover:text-white text-sm font-semibold mb-6 transition-colors">
            <i data-feather="arrow-left" class="w-4 h-4"></i>
            Kembali ke Ekskul
        </a>
        <h1 class="font-display text-4xl md:text-5xl font-bold text-white mb-4"><?= htmlspecialchars($item->nama, ENT_QUOTES) ?></h1>
        <div class="flex flex-wrap gap-3 text-sm text-hijau-100/90">
            <?php if (!empty($item->jadwal)): ?>
                <span class="inline-flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full"><i data-feather="clock" class="w-4 h-4"></i><?= htmlspecialchars($item->jadwal, ENT_QUOTES) ?></span>
            <?php endif; ?>
            <?php if (!empty($item->pembina)): ?>
                <span class="inline-flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-full"><i data-feather="user" class="w-4 h-4"></i><?= htmlspecialchars($item->pembina, ENT_QUOTES) ?></span>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <?php if (!empty($item->gambar)): ?>
                    <img src="<?= base_url('assets/images/uploads/ekskul/' . $item->gambar) ?>" alt="<?= htmlspecialchars($item->nama, ENT_QUOTES) ?>" class="w-full max-h-[420px] object-cover rounded-3xl shadow-sm border border-gray-100 mb-6">
                <?php endif; ?>

                <div class="prose prose-gray max-w-none">
                    <p class="text-gray-700 leading-relaxed"><?= nl2br(htmlspecialchars(!empty($item->detail_lengkap) ? $item->detail_lengkap : (string) $item->deskripsi, ENT_QUOTES)) ?></p>
                </div>
            </div>

            <aside class="bg-gray-50 rounded-3xl border border-gray-100 p-6 h-fit">
                <h3 class="font-display text-2xl font-bold text-hijau-900 mb-4">Informasi</h3>
                <div class="space-y-3 text-sm text-gray-600">
                    <div>
                        <div class="text-xs uppercase tracking-wide text-gray-400 mb-1">Nama Ekskul</div>
                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($item->nama, ENT_QUOTES) ?></div>
                    </div>
                    <div>
                        <div class="text-xs uppercase tracking-wide text-gray-400 mb-1">Jadwal</div>
                        <div><?= !empty($item->jadwal) ? htmlspecialchars($item->jadwal, ENT_QUOTES) : '-' ?></div>
                    </div>
                    <div>
                        <div class="text-xs uppercase tracking-wide text-gray-400 mb-1">Pembina</div>
                        <div><?= !empty($item->pembina) ? htmlspecialchars($item->pembina, ENT_QUOTES) : '-' ?></div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php if (!empty($ekskul_lainnya)): ?>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h2 class="font-display text-3xl font-bold text-hijau-900">Ekskul Lainnya</h2>
            <a href="<?= base_url('ekskul') ?>" class="text-sm font-semibold text-hijau-700 hover:text-hijau-900">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <?php foreach ($ekskul_lainnya as $row): ?>
                <?php $slug = !empty($row->slug) ? $row->slug : ('ekskul-' . (int) $row->id); ?>
                <a href="<?= base_url('ekskul/' . rawurlencode($slug)) ?>" class="block bg-white rounded-2xl border border-gray-100 p-5 hover:shadow-md transition-shadow">
                    <h3 class="font-semibold text-gray-900 mb-2"><?= htmlspecialchars($row->nama, ENT_QUOTES) ?></h3>
                    <p class="text-sm text-gray-500 line-clamp-2"><?= htmlspecialchars((string) $row->deskripsi, ENT_QUOTES) ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
