<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ============================================================ -->
<!-- PAGE HERO BANNER -->
<!-- ============================================================ -->
<section class="relative pt-32 pb-20 md:pt-40 md:pb-28 bg-hijau-950 overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-20"></div>
    <div class="absolute top-1/4 -left-20 w-[400px] h-[400px] bg-hijau-700/15 rounded-full blur-[120px] floating-slow"></div>
    <div class="absolute bottom-1/3 -right-20 w-[300px] h-[300px] bg-kuning-500/8 rounded-full blur-[100px] floating"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <div class="ornament-divider mb-5 max-w-xs mx-auto">
            <span class="font-arabic text-kuning-400/70 text-xl">النشاطات</span>
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Ekstrakurikuler</h1>
        <p class="text-hijau-200/70 text-lg max-w-xl mx-auto">Mengembangkan bakat dan potensi santri melalui berbagai kegiatan unggulan</p>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,60 L1440,120 L0,120 Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- ============================================================ -->
<!-- EKSKUL GRID -->
<!-- ============================================================ -->
<section class="py-20 md:py-28 bg-white relative overflow-hidden">
    <div class="absolute right-0 top-20 w-80 h-80 bg-hijau-50 rounded-full blur-[120px] opacity-50"></div>
    <div class="absolute left-0 bottom-20 w-72 h-72 bg-kuning-50 rounded-full blur-[100px] opacity-40"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <?php if (!empty($ekskul)): ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 stagger-parent">
                <?php foreach ($ekskul as $idx => $item): ?>
                    <?php $ekskul_slug = !empty($item->slug) ? $item->slug : ('ekskul-' . (int) $item->id); ?>
                    <div class="stagger-child group">
                        <div class="bg-white rounded-3xl overflow-hidden border border-gray-100/80 shadow-sm card-hover h-full">
                            <?php if ($item->gambar): ?>
                                <div class="h-52 overflow-hidden relative">
                                    <img src="<?= base_url('assets/images/uploads/ekskul/' . $item->gambar) ?>" alt="<?= $item->nama ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                </div>
                            <?php else: ?>
                                <div class="h-48 bg-gradient-to-br from-hijau-800 to-hijau-900 flex items-center justify-center relative overflow-hidden">
                                    <div class="absolute inset-0 pattern-bg opacity-20"></div>
                                    <i data-feather="<?= $item->ikon ?: 'star' ?>" class="w-16 h-16 text-kuning-400/30 relative z-10 group-hover:scale-110 transition-transform duration-500"></i>
                                </div>
                            <?php endif; ?>

                            <div class="p-7">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 bg-hijau-50 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-hijau-100 transition-colors duration-300">
                                        <i data-feather="<?= $item->ikon ?: 'star' ?>" class="w-6 h-6 text-hijau-700"></i>
                                    </div>
                                    <span class="text-xs font-semibold text-hijau-600 bg-hijau-50 px-3 py-1.5 rounded-full">Aktif</span>
                                </div>
                                <h3 class="font-display text-xl font-bold text-hijau-900 mb-3"><?= $item->nama ?></h3>
                                <p class="text-gray-500 text-sm leading-relaxed mb-5"><?= $item->deskripsi ?></p>

                                <?php if ($item->jadwal || $item->pembina): ?>
                                    <div class="pt-5 border-t border-gray-100 space-y-3">
                                        <?php if ($item->jadwal): ?>
                                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                                <div class="w-7 h-7 bg-hijau-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <i data-feather="clock" class="w-3.5 h-3.5 text-hijau-600"></i>
                                                </div>
                                                <?= $item->jadwal ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($item->pembina): ?>
                                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                                <div class="w-7 h-7 bg-hijau-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                                    <i data-feather="user" class="w-3.5 h-3.5 text-hijau-600"></i>
                                                </div>
                                                <?= $item->pembina ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="pt-5">
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
        <?php else: ?>
            <div class="text-center py-20 reveal">
                <i data-feather="star" class="w-14 h-14 text-gray-200 mx-auto mb-4"></i>
                <p class="text-gray-400 text-lg font-medium">Belum ada data ekstrakurikuler</p>
            </div>
        <?php endif; ?>
    </div>
</section>
