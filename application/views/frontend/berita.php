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
            <span class="font-arabic text-kuning-400/70 text-xl">الأخبار</span>
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Berita & Informasi</h1>
        <p class="text-hijau-200/70 text-lg max-w-xl mx-auto">Informasi terbaru dari Yayasan Ar-Razaq</p>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,60 L1440,120 L0,120 Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

<!-- ============================================================ -->
<!-- BERITA LIST -->
<!-- ============================================================ -->
<section class="py-20 md:py-28 bg-gray-50 relative overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8 relative z-10">

        <?php if (!empty($berita)): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 stagger-parent">
                <?php foreach ($berita as $idx => $post): ?>
                    <article class="stagger-child group">
                        <a href="<?= base_url('berita/' . $post->slug) ?>" class="block bg-white rounded-3xl overflow-hidden border border-gray-100/80 shadow-sm card-hover h-full">
                            <!-- Thumbnail -->
                            <div class="aspect-video overflow-hidden bg-hijau-50 relative">
                                <?php if ($post->gambar): ?>
                                    <img src="<?= base_url('assets/images/uploads/berita/' . $post->gambar) ?>" alt="<?= $post->judul ?>"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                        onerror="this.parentElement.innerHTML='<div class=\'w-full h-full bg-gradient-to-br from-hijau-100 to-hijau-200 flex items-center justify-center\'><svg class=\'w-10 h-10 text-hijau-400\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><rect x=\'3\' y=\'3\' width=\'18\' height=\'18\' rx=\'2\' ry=\'2\'/><circle cx=\'8.5\' cy=\'8.5\' r=\'1.5\'/><polyline points=\'21 15 16 10 5 21\'/></svg></div>'">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gradient-to-br from-hijau-50 to-hijau-100 flex items-center justify-center">
                                        <i data-feather="file-text" class="w-10 h-10 text-hijau-300"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 backdrop-blur-sm text-hijau-800 text-xs font-bold px-3 py-1.5 rounded-full capitalize shadow-sm"><?= $post->kategori ?></span>
                                </div>
                            </div>

                            <div class="p-6">
                                <div class="flex items-center gap-3 mb-3">
                                    <span class="text-gray-400 text-xs flex items-center gap-1.5">
                                        <i data-feather="calendar" class="w-3 h-3"></i>
                                        <?= date('d M Y', strtotime($post->tanggal_publish)) ?>
                                    </span>
                                    <?php if (isset($post->views)): ?>
                                    <span class="text-gray-400 text-xs flex items-center gap-1.5">
                                        <i data-feather="eye" class="w-3 h-3"></i>
                                        <?= number_format($post->views) ?>
                                    </span>
                                    <?php endif; ?>
                                </div>

                                <h3 class="font-display font-bold text-hijau-900 text-lg mb-3 leading-snug line-clamp-2 group-hover:text-hijau-700 transition-colors duration-300">
                                    <?= $post->judul ?>
                                </h3>

                                <?php if ($post->ringkasan): ?>
                                    <p class="text-gray-400 text-sm leading-relaxed line-clamp-3 mb-5"><?= $post->ringkasan ?></p>
                                <?php endif; ?>

                                <div class="flex items-center text-hijau-600 text-sm font-semibold group-hover:gap-3 transition-all duration-300 gap-1.5">
                                    Baca Selengkapnya
                                    <i data-feather="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-300"></i>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-20 reveal">
                <i data-feather="file-text" class="w-14 h-14 text-gray-200 mx-auto mb-4"></i>
                <p class="text-gray-400 text-lg font-medium">Belum ada berita</p>
                <p class="text-gray-300 text-sm mt-2">Berita dan informasi terbaru akan tampil di sini</p>
            </div>
        <?php endif; ?>
    </div>
</section>
