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
            <span class="font-arabic text-kuning-400/70 text-xl">الرؤية</span>
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Visi & Misi</h1>
        <p class="text-hijau-200/70 text-lg max-w-xl mx-auto">Fondasi dan arah perjalanan Yayasan Ar-Razaq dalam membentuk generasi terbaik bangsa</p>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,60 L1440,120 L0,120 Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- ============================================================ -->
<!-- VISI SECTION -->
<!-- ============================================================ -->
<?php if (!empty($visi)):
    $v = $visi[0]; ?>
<section class="py-20 md:py-28 bg-white relative overflow-hidden">
    <div class="absolute top-20 right-0 w-72 h-72 bg-hijau-50 rounded-full blur-[100px] opacity-60"></div>
    <div class="absolute bottom-20 left-0 w-60 h-60 bg-kuning-50 rounded-full blur-[80px] opacity-40"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16 reveal">
                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-hijau-900 mb-5">Visi Kami</h2>
                <p class="text-gray-500 max-w-lg mx-auto text-base">Pandangan ke depan yang menjadi pedoman dalam setiap langkah</p>
            </div>

            <div class="reveal">
                <div class="relative bg-hijau-950 rounded-[2rem] p-10 md:p-16 text-center overflow-hidden grain">
                    <div class="absolute inset-0 pattern-bg opacity-15"></div>
                    <!-- Corner accents -->
                    <div class="absolute top-0 left-0 w-24 h-24 border-t-2 border-l-2 border-kuning-500/20 rounded-tl-[2rem]"></div>
                    <div class="absolute bottom-0 right-0 w-24 h-24 border-b-2 border-r-2 border-kuning-500/20 rounded-br-[2rem]"></div>

                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-kuning-500/10 rounded-2xl flex items-center justify-center mx-auto mb-8">
                            <i data-feather="eye" class="w-8 h-8 text-kuning-400"></i>
                        </div>
                        <div class="text-kuning-400/80 font-medium text-xs tracking-[0.2em] uppercase mb-6">Visi Yayasan</div>
                        <p class="text-white font-display text-2xl md:text-3xl lg:text-4xl leading-relaxed font-medium italic max-w-3xl mx-auto">
                            "<?= $v->konten ?>"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C480,100 960,0 1440,40 L1440,100 L0,100 Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>
<?php endif; ?>

<!-- ============================================================ -->
<!-- MISI SECTION -->
<!-- ============================================================ -->
<?php if (!empty($misi)): ?>
<section class="py-20 md:py-28 bg-gray-50 relative overflow-hidden">
    <div class="absolute inset-0 pattern-bg opacity-30"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16 reveal">
                <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-hijau-900 mb-5">Misi Yayasan</h2>
                <p class="text-gray-500 max-w-lg mx-auto text-base">Langkah-langkah nyata untuk mewujudkan visi kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 stagger-parent">
                <?php foreach ($misi as $idx => $item): ?>
                    <div class="stagger-child group">
                        <div class="bg-white rounded-3xl p-7 border border-gray-100/80 shadow-sm card-hover h-full">
                            <div class="flex gap-5">
                                <div class="w-12 h-12 bg-hijau-50 rounded-2xl flex items-center justify-center flex-shrink-0 group-hover:bg-hijau-100 transition-colors duration-500">
                                    <i data-feather="<?= $item->ikon ?: 'check-circle' ?>" class="w-6 h-6 text-hijau-700"></i>
                                </div>
                                <div>
                                    <div class="text-kuning-600 text-xs font-bold tracking-wider uppercase mb-2">Misi <?= str_pad($idx + 1, 2, '0', STR_PAD_LEFT) ?></div>
                                    <h3 class="font-display text-lg font-bold text-hijau-900 mb-3"><?= $item->judul ?></h3>
                                    <p class="text-gray-500 text-sm leading-relaxed"><?= $item->konten ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,40 C480,100 960,0 1440,40 L1440,100 L0,100 Z" fill="#052e16"/>
        </svg>
    </div>
</section>
<?php endif; ?>

<!-- ============================================================ -->
<!-- NILAI-NILAI SECTION -->
<!-- ============================================================ -->
<?php if (!empty($nilai)): ?>
<section class="py-24 md:py-32 bg-hijau-950 relative overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-15"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-kuning-500/5 rounded-full blur-[150px]"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-hijau-400/5 rounded-full blur-[120px]"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="text-center mb-16 reveal">
            <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-5">Nilai-Nilai Kami</h2>
            <p class="text-hijau-300/70 max-w-lg mx-auto text-base">Prinsip yang kami pegang teguh dalam setiap langkah</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto stagger-parent">
            <?php foreach ($nilai as $item): ?>
                <div class="stagger-child text-center group">
                    <div class="w-20 h-20 bg-hijau-800 group-hover:bg-kuning-500 rounded-2xl flex items-center justify-center mx-auto mb-5 transition-all duration-700 shadow-lg group-hover:shadow-kuning-500/20 group-hover:-translate-y-1">
                        <i data-feather="<?= $item->ikon ?: 'star' ?>" class="w-8 h-8 text-kuning-400 group-hover:text-hijau-950 transition-colors duration-500"></i>
                    </div>
                    <h4 class="text-white font-semibold text-base mb-2"><?= $item->judul ?></h4>
                    <p class="text-hijau-400/50 text-sm leading-relaxed"><?= $item->konten ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C240,10 480,90 720,50 C960,10 1200,80 1440,40 L1440,100 L0,100 Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>
<?php endif; ?>
