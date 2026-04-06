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
            <span class="font-arabic text-kuning-400/70 text-xl">الصور</span>
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Galeri Yayasan</h1>
        <p class="text-hijau-200/70 text-lg max-w-xl mx-auto">Mengabadikan setiap momen berharga dalam perjalanan yayasan kami</p>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,60 L1440,120 L0,120 Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- ============================================================ -->
<!-- GALERI GRID -->
<!-- ============================================================ -->
<section class="py-20 md:py-28 bg-white relative overflow-hidden">
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <!-- Category Filter -->
        <?php if (!empty($kategori)): ?>
        <div class="flex flex-wrap justify-center gap-3 mb-14 reveal">
            <button class="galeri-filter active px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-hijau-800 text-white shadow-lg shadow-hijau-800/20" data-filter="all">
                Semua
            </button>
            <?php foreach ($kategori as $kat): if (!empty($kat->kategori)): ?>
                <button class="galeri-filter px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-hijau-50 hover:text-hijau-800" data-filter="<?= $kat->kategori ?>">
                    <?= ucfirst($kat->kategori) ?>
                </button>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Gallery Grid -->
        <?php if (!empty($galeri)): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 stagger-parent" id="galeri-grid">
            <?php foreach ($galeri as $idx => $foto): ?>
                <div class="stagger-child galeri-item group relative rounded-2xl overflow-hidden bg-hijau-100 cursor-pointer aspect-square shadow-sm hover:shadow-xl hover:shadow-hijau-900/10 transition-shadow duration-500"
                    data-kategori="<?= $foto->kategori ?>"
                    onclick="openLightbox('<?= base_url('assets/images/uploads/galeri/' . $foto->gambar) ?>', '<?= htmlspecialchars($foto->judul, ENT_QUOTES) ?>')">
                    <?php if ($foto->gambar && strpos($foto->gambar, 'placeholder') === false): ?>
                        <img src="<?= base_url('assets/images/uploads/galeri/' . $foto->gambar) ?>" alt="<?= $foto->judul ?>"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            onerror="this.src='<?= base_url('assets/images/placeholder.jpg') ?>'">
                    <?php else: ?>
                        <div class="w-full h-full bg-gradient-to-br from-hijau-100 to-hijau-200 flex items-center justify-center">
                            <i data-feather="image" class="w-12 h-12 text-hijau-300"></i>
                        </div>
                    <?php endif; ?>
                    <div class="absolute inset-0 img-overlay opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-5">
                        <div>
                            <p class="text-white font-semibold text-sm mb-1.5"><?= $foto->judul ?></p>
                            <?php if ($foto->kategori): ?>
                                <span class="bg-kuning-500/90 text-hijau-950 text-xs font-semibold px-3 py-1 rounded-full"><?= ucfirst($foto->kategori) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="absolute top-3 right-3 w-9 h-9 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 group-hover:scale-100 scale-75">
                        <i data-feather="zoom-in" class="w-4 h-4 text-white"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center py-20 reveal">
            <i data-feather="image" class="w-14 h-14 text-gray-200 mx-auto mb-4"></i>
            <p class="text-gray-400 text-lg font-medium">Belum ada foto di galeri</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox -->
<div id="lightbox" class="fixed inset-0 bg-black/95 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 invisible transition-all duration-500" data-lenis-prevent>
    <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white/60 hover:text-white transition-colors z-10">
        <i data-feather="x" class="w-8 h-8"></i>
    </button>
    <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[85vh] rounded-2xl object-contain shadow-2xl">
    <div class="absolute bottom-8 text-center">
        <p id="lightbox-caption" class="text-white/80 font-medium text-lg"></p>
    </div>
</div>

<script>
    // Lightbox
    function openLightbox(src, caption) {
        const lb = document.getElementById('lightbox');
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-caption').textContent = caption;
        lb.classList.remove('opacity-0', 'invisible');
        lb.classList.add('opacity-100', 'visible');
        document.body.style.overflow = 'hidden';
    }
    function closeLightbox() {
        const lb = document.getElementById('lightbox');
        lb.classList.add('opacity-0', 'invisible');
        lb.classList.remove('opacity-100', 'visible');
        document.body.style.overflow = '';
    }
    document.getElementById('lightbox')?.addEventListener('click', function(e) {
        if (e.target === this) closeLightbox();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLightbox(); });

    // Category filter
    document.querySelectorAll('.galeri-filter').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.galeri-filter').forEach(b => {
                b.classList.remove('bg-hijau-800', 'text-white', 'shadow-lg', 'shadow-hijau-800/20', 'active');
                b.classList.add('bg-gray-100', 'text-gray-600');
            });
            this.classList.remove('bg-gray-100', 'text-gray-600');
            this.classList.add('bg-hijau-800', 'text-white', 'shadow-lg', 'shadow-hijau-800/20', 'active');

            const filter = this.dataset.filter;
            document.querySelectorAll('.galeri-item').forEach(item => {
                if (filter === 'all' || item.dataset.kategori === filter) {
                    item.style.display = '';
                    gsap.fromTo(item, { opacity: 0, scale: 0.9 }, { opacity: 1, scale: 1, duration: 0.4, ease: 'power2.out' });
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
