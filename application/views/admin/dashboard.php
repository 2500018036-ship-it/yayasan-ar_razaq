<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can = function ($perm) use ($permission_codes) {
    return in_array($perm, $permission_codes, true);
};
?>

<!-- Stat Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <?php
    $cards = [
        ['label' => 'Total Berita',   'val' => $stats['total_berita'],  'icon' => 'file-text',  'color' => 'from-blue-500 to-blue-600',    'bg' => 'bg-blue-50',   'text' => 'text-blue-700'],
        ['label' => 'Total Galeri',   'val' => $stats['total_galeri'],  'icon' => 'image',      'color' => 'from-violet-500 to-violet-600', 'bg' => 'bg-violet-50', 'text' => 'text-violet-700'],
        ['label' => 'Ekskul',         'val' => $stats['total_ekskul'],  'icon' => 'star',       'color' => 'from-amber-500 to-amber-600',  'bg' => 'bg-amber-50',  'text' => 'text-amber-700'],
        ['label' => 'Sejarah',        'val' => $stats['total_sejarah'], 'icon' => 'clock',      'color' => 'from-hijau-600 to-hijau-700',  'bg' => 'bg-hijau-50',  'text' => 'text-hijau-700'],
    ];
    foreach ($cards as $c):
    ?>
        <div class="stat-card flex items-center gap-4">
            <div class="w-11 h-11 bg-gradient-to-br <?= $c['color'] ?> rounded-2xl flex items-center justify-center flex-shrink-0 shadow-md">
                <i data-feather="<?= $c['icon'] ?>" class="w-5 h-5 text-white"></i>
            </div>
            <div>
                <div class="text-2xl font-bold text-gray-900 leading-tight"><?= $c['val'] ?></div>
                <div class="text-xs text-gray-500 font-medium"><?= $c['label'] ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Quick links -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-8">
    <?php
    $quick = [
        ['url' => 'panel-admin/berita',   'label' => 'Tambah Berita',   'icon' => 'plus-circle', 'color' => 'text-blue-600',   'bg' => 'bg-blue-50 hover:bg-blue-100', 'perm' => 'berita.create'],
        ['url' => 'panel-admin/galeri',   'label' => 'Upload Foto',     'icon' => 'upload',      'color' => 'text-violet-600', 'bg' => 'bg-violet-50 hover:bg-violet-100', 'perm' => 'galeri.create'],
        ['url' => 'panel-admin/ppdb',     'label' => 'Kelola PPDB',     'icon' => 'user-plus',   'color' => 'text-amber-600',  'bg' => 'bg-amber-50 hover:bg-amber-100', 'perm' => 'ppdb.view'],
        ['url' => 'panel-admin/profil/tentang-kami', 'label' => 'Edit Profil', 'icon' => 'settings', 'color' => 'text-hijau-700', 'bg' => 'bg-hijau-50 hover:bg-hijau-100', 'perm' => 'profil.edit'],
        ['url' => 'panel-admin/setting',  'label' => 'Setting Admin',   'icon' => 'shield',      'color' => 'text-slate-700',  'bg' => 'bg-slate-100 hover:bg-slate-200', 'perm' => 'setting.view'],
    ];
    foreach ($quick as $q):
        if (!$can($q['perm'])) continue;
    ?>
        <a href="<?= base_url($q['url']) ?>" class="flex items-center gap-3 p-4 rounded-2xl <?= $q['bg'] ?> transition-colors group">
            <i data-feather="<?= $q['icon'] ?>" class="w-4 h-4 <?= $q['color'] ?> flex-shrink-0"></i>
            <span class="text-sm font-semibold text-gray-700"><?= $q['label'] ?></span>
        </a>
    <?php endforeach; ?>
</div>

<!-- Recent News -->
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <div class="px-6 py-5 border-b border-gray-50 flex items-center justify-between">
        <div>
            <h2 class="font-semibold text-gray-900 text-sm">Berita Terbaru</h2>
            <p class="text-xs text-gray-400 mt-0.5">5 berita terakhir yang dipublikasikan</p>
        </div>
        <a href="<?= base_url('panel-admin/berita') ?>" class="text-xs text-hijau-700 font-semibold hover:underline">Lihat Semua →</a>
    </div>

    <?php if (!empty($berita_terbaru)): ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Views</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($berita_terbaru as $b): ?>
                    <tr>
                        <td>
                            <div class="font-medium text-gray-800 max-w-xs truncate"><?= $b->judul ?></div>
                            <div class="text-xs text-gray-400 mt-0.5"><?= $b->penulis ?: '-' ?></div>
                        </td>
                        <td><span class="badge badge-yellow capitalize"><?= $b->kategori ?></span></td>
                        <td class="text-gray-500 text-xs"><?= $b->tanggal_publish ? date('d M Y', strtotime($b->tanggal_publish)) : '-' ?></td>
                        <td class="text-gray-500 text-xs"><?= number_format($b->views) ?></td>
                        <td>
                            <?php if ($b->status): ?>
                                <span class="badge badge-green">Aktif</span>
                            <?php else: ?>
                                <span class="badge badge-gray">Draft</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="px-6 py-12 text-center text-gray-400 text-sm">
            <i data-feather="file-text" class="w-8 h-8 mx-auto mb-3 opacity-30"></i>
            Belum ada berita yang dipublikasikan.
        </div>
    <?php endif; ?>
</div>
