<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ============================================================ -->
<!-- ARTICLE HERO -->
<!-- ============================================================ -->
<section class="relative pt-32 pb-16 md:pt-40 md:pb-24 bg-hijau-950 overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-20"></div>
    <div class="absolute top-1/4 -left-20 w-[400px] h-[400px] bg-hijau-700/15 rounded-full blur-[120px] floating-slow"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-3xl mx-auto text-center">
            <div class="flex items-center justify-center gap-3 mb-6">
                <span class="bg-kuning-500/20 text-kuning-300 text-xs font-bold px-4 py-1.5 rounded-full capitalize"><?= $berita->kategori ?></span>
                <span class="text-hijau-300/50 text-xs flex items-center gap-1.5">
                    <i data-feather="calendar" class="w-3 h-3"></i>
                    <?= date('d M Y', strtotime($berita->tanggal_publish)) ?>
                </span>
                <?php if (isset($berita->views)): ?>
                <span class="text-hijau-300/50 text-xs flex items-center gap-1.5">
                    <i data-feather="eye" class="w-3 h-3"></i>
                    <?= number_format($berita->views) ?> views
                </span>
                <?php endif; ?>
            </div>
            <h1 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-5 leading-tight"><?= $berita->judul ?></h1>
            <?php if ($berita->penulis): ?>
                <div class="flex items-center justify-center gap-2 text-hijau-300/60 text-sm">
                    <i data-feather="user" class="w-4 h-4"></i>
                    <span>Oleh <strong class="text-hijau-200/80"><?= $berita->penulis ?></strong></span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,60 L1440,120 L0,120 Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- ============================================================ -->
<!-- ARTICLE CONTENT -->
<!-- ============================================================ -->
<section class="py-16 md:py-24 bg-white relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <!-- Featured Image -->
            <?php if ($berita->gambar): ?>
            <div class="rounded-3xl overflow-hidden mb-10 shadow-xl shadow-hijau-900/10 -mt-20 relative z-10 reveal">
                <img src="<?= base_url('assets/images/uploads/berita/' . $berita->gambar) ?>" alt="<?= $berita->judul ?>"
                    class="w-full aspect-video object-cover"
                    onerror="this.parentElement.style.display='none'">
            </div>
            <?php endif; ?>

            <!-- Article Body -->
            <article class="prose prose-lg max-w-none text-gray-700 leading-relaxed reveal" style="font-size: 1.05rem; line-height: 1.85;">
                <?= $berita->isi ?>
            </article>

            <!-- Share / Back -->
            <div class="mt-14 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-5 reveal">
                <a href="<?= base_url('berita') ?>" class="inline-flex items-center gap-2 text-hijau-700 font-semibold hover:text-hijau-900 transition-colors group">
                    <i data-feather="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-300"></i>
                    Kembali ke Berita
                </a>
                <div class="flex items-center gap-3">
                    <span class="text-gray-400 text-sm">Bagikan:</span>
                    <a href="https://wa.me/?text=<?= urlencode($berita->judul . ' - ' . current_url()) ?>" target="_blank" class="w-9 h-9 bg-hijau-50 rounded-lg flex items-center justify-center text-hijau-700 hover:bg-hijau-100 transition-colors">
                        <i data-feather="message-circle" class="w-4 h-4"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="w-9 h-9 bg-hijau-50 rounded-lg flex items-center justify-center text-hijau-700 hover:bg-hijau-100 transition-colors">
                        <i data-feather="facebook" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================ -->
<!-- RELATED ARTICLES -->
<!-- ============================================================ -->
<?php if (!empty($berita_terkait)): ?>
<section class="py-20 bg-gray-50 relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12 reveal">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-hijau-900 mb-3">Berita Lainnya</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-7 stagger-parent">
            <?php foreach ($berita_terkait as $post): if ($post->id == $berita->id) continue; ?>
                <article class="stagger-child group">
                    <a href="<?= base_url('berita/' . $post->slug) ?>" class="block bg-white rounded-3xl overflow-hidden border border-gray-100/80 shadow-sm card-hover h-full">
                        <div class="aspect-video overflow-hidden bg-hijau-50 relative">
                            <?php if ($post->gambar): ?>
                                <img src="<?= base_url('assets/images/uploads/berita/' . $post->gambar) ?>" alt="<?= $post->judul ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <?php else: ?>
                                <div class="w-full h-full bg-gradient-to-br from-hijau-50 to-hijau-100 flex items-center justify-center">
                                    <i data-feather="file-text" class="w-10 h-10 text-hijau-300"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-5">
                            <span class="text-gray-400 text-xs"><?= date('d M Y', strtotime($post->tanggal_publish)) ?></span>
                            <h3 class="font-display font-bold text-hijau-900 text-base mt-2 line-clamp-2 group-hover:text-hijau-700 transition-colors"><?= $post->judul ?></h3>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
