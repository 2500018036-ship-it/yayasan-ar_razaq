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
            <span class="font-arabic text-kuning-400/70 text-xl">الملف</span>
        </div>
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Profil Yayasan</h1>
        <p class="text-hijau-200/70 text-lg max-w-xl mx-auto">Mengenal lebih dekat Yayasan Ar-Razaq dan perjalanan kami dalam mendidik generasi terbaik bangsa</p>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,60 L1440,120 L0,120 Z" fill="white"/>
        </svg>
    </div>
</section>

<!-- ============================================================ -->
<!-- TENTANG YAYASAN -->
<!-- ============================================================ -->
<section class="py-20 md:py-28 bg-white relative overflow-hidden">
    <div class="absolute top-20 right-0 w-72 h-72 bg-hijau-50 rounded-full blur-[100px] opacity-60"></div>
    <div class="absolute bottom-20 left-0 w-60 h-60 bg-kuning-50 rounded-full blur-[80px] opacity-40"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-10 items-start reveal">
                <!-- Info Sidebar -->
                <div class="md:col-span-2">
                    <div class="bg-gradient-to-br from-hijau-50 to-white border border-hijau-100/60 rounded-3xl p-7 card-hover">
                        <div class="flex items-center gap-3 mb-6">
                            <?php if (isset($profil) && $profil && $profil->logo): ?>
                                <img src="<?= base_url('assets/images/uploads/profil/' . $profil->logo) ?>" alt="Logo" class="w-14 h-14 object-contain rounded-xl">
                            <?php else: ?>
                                <div class="w-14 h-14 bg-gradient-to-br from-hijau-800 to-hijau-600 rounded-xl flex items-center justify-center">
                                    <span class="font-arabic text-white text-2xl font-bold">ر</span>
                                </div>
                            <?php endif; ?>
                            <div>
                                <h3 class="font-display text-lg font-bold text-hijau-900"><?= isset($profil) && $profil ? $profil->nama_yayasan : 'Yayasan Ar-Razaq' ?></h3>
                                <span class="text-xs text-hijau-600">Pesantren Modern</span>
                            </div>
                        </div>
                        <div class="space-y-4 text-sm">
                            <?php if (isset($profil) && $profil): ?>
                                <?php if (!empty($profil->tahun_berdiri)): ?>
                                <div class="flex items-center gap-3 text-gray-600">
                                    <div class="w-8 h-8 bg-hijau-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-feather="calendar" class="w-4 h-4 text-hijau-700"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-400 uppercase font-semibold tracking-wider">Berdiri Sejak</div>
                                        <div class="font-semibold text-hijau-900"><?= $profil->tahun_berdiri ?></div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($profil->status_akreditasi)): ?>
                                <div class="flex items-center gap-3 text-gray-600">
                                    <div class="w-8 h-8 bg-kuning-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-feather="award" class="w-4 h-4 text-kuning-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-400 uppercase font-semibold tracking-wider">Akreditasi</div>
                                        <div class="font-semibold text-hijau-900"><?= $profil->status_akreditasi ?></div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($profil->alamat)): ?>
                                <div class="flex items-start gap-3 text-gray-600">
                                    <div class="w-8 h-8 bg-hijau-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i data-feather="map-pin" class="w-4 h-4 text-hijau-700"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-400 uppercase font-semibold tracking-wider">Alamat</div>
                                        <div class="font-medium text-gray-700 leading-relaxed"><?= $profil->alamat ?></div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($profil->telepon)): ?>
                                <div class="flex items-center gap-3 text-gray-600">
                                    <div class="w-8 h-8 bg-hijau-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-feather="phone" class="w-4 h-4 text-hijau-700"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-400 uppercase font-semibold tracking-wider">Telepon</div>
                                        <a href="tel:<?= $profil->telepon ?>" class="font-medium text-hijau-700 hover:text-hijau-900"><?= $profil->telepon ?></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($profil->email)): ?>
                                <div class="flex items-center gap-3 text-gray-600">
                                    <div class="w-8 h-8 bg-hijau-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i data-feather="mail" class="w-4 h-4 text-hijau-700"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-400 uppercase font-semibold tracking-wider">Email</div>
                                        <a href="mailto:<?= $profil->email ?>" class="font-medium text-hijau-700 hover:text-hijau-900"><?= $profil->email ?></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="md:col-span-3">
                    <h2 class="font-display text-3xl md:text-4xl font-bold text-hijau-900 mb-5">Tentang Kami</h2>
                    <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed space-y-4">
                        <?php if (isset($profil) && $profil && !empty($profil->deskripsi_lengkap)): ?>
                            <?= nl2br($profil->deskripsi_lengkap) ?>
                        <?php elseif (isset($profil) && $profil && !empty($profil->deskripsi_singkat)): ?>
                            <p><?= $profil->deskripsi_singkat ?></p>
                        <?php else: ?>
                            <p>Yayasan Ar-Razaq adalah lembaga pendidikan Islam terpercaya yang berkomitmen membentuk generasi Qurani yang berakhlak mulia dan berwawasan luas. Dengan kurikulum yang mengintegrasikan ilmu agama dan ilmu umum, kami menyiapkan santri untuk menjadi pemimpin masa depan yang berintegritas.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================ -->
<!-- STATISTIK -->
<!-- ============================================================ -->
<?php if (!empty($statistik)): ?>
<section class="py-16 bg-gray-50 relative overflow-hidden">
    <div class="absolute inset-0 pattern-bg opacity-30"></div>
    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8">
                <?php foreach ($statistik as $idx => $stat): ?>
                    <div class="stat-card reveal text-center group" style="transition-delay: <?= $idx * 100 ?>ms;">
                        <div class="bg-gradient-to-br from-hijau-50 to-white border border-hijau-100/60 rounded-3xl p-6 md:p-8 card-hover relative overflow-hidden">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-12 h-1 bg-gradient-to-r from-hijau-500 to-kuning-500 rounded-b-full"></div>
                            <div class="counter-number font-display font-bold text-3xl md:text-4xl lg:text-5xl text-hijau-800 mb-1" data-count="<?= $stat->nilai ?>">0</div>
                            <div class="text-kuning-600 text-xs font-semibold tracking-wider uppercase mb-1"><?= $stat->satuan ?></div>
                            <div class="text-gray-600 text-sm font-medium"><?= $stat->label ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================================================ -->
<!-- SEJARAH / TIMELINE -->
<!-- ============================================================ -->
<?php if (!empty($sejarah)): ?>
<section class="py-24 md:py-32 bg-white relative overflow-hidden">
    <div class="absolute top-20 right-0 w-72 h-72 bg-hijau-50 rounded-full blur-[100px] opacity-60"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="text-center mb-20 reveal">
            <div class="ornament-divider mb-5 max-w-xs mx-auto">
                <span class="font-arabic text-hijau-600/70 text-xl">الجذور</span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-hijau-900 mb-5 split-text" data-split-reveal>Sejarah Yayasan</h2>
            <p class="text-gray-500 max-w-lg mx-auto text-base">Perjalanan panjang kami dalam mendidik generasi terbaik bangsa</p>
        </div>

        <div class="relative max-w-4xl mx-auto">
            <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-hijau-100 hidden md:block"></div>
            <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-hijau-500 via-hijau-600 to-kuning-500 hidden md:block timeline-progress" id="timeline-line"></div>

            <?php foreach ($sejarah as $idx => $item): $is_even = $idx % 2 === 0; ?>
                <div class="relative flex flex-col md:flex-row items-center gap-8 mb-20 <?= $is_even ? 'md:flex-row' : 'md:flex-row-reverse' ?>">
                    <div class="flex-1 <?= $is_even ? 'md:text-right md:pr-16' : 'md:text-left md:pl-16' ?> reveal<?= $is_even ? '-left' : '-right' ?>">
                        <?php if ($item->gambar): ?>
                            <div class="rounded-3xl overflow-hidden mb-5 aspect-video bg-hijau-50 shadow-lg shadow-hijau-900/5">
                                <img src="<?= base_url('assets/images/uploads/sejarah/' . $item->gambar) ?>" alt="<?= $item->judul ?>" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                            </div>
                        <?php endif; ?>
                        <div class="bg-white rounded-3xl p-7 border border-hijau-100/50 card-hover shadow-sm">
                            <h3 class="font-display text-xl font-bold text-hijau-900 mb-3"><?= $item->judul ?></h3>
                            <p class="text-gray-500 leading-relaxed text-sm"><?= $item->konten ?></p>
                        </div>
                    </div>
                    <div class="hidden md:flex w-12 h-12 bg-white border-2 border-hijau-500 rounded-full items-center justify-center shadow-lg shadow-hijau-500/10 flex-shrink-0 z-10 reveal-scale">
                        <span class="text-hijau-800 font-bold text-sm"><?= str_pad($idx + 1, 2, '0', STR_PAD_LEFT) ?></span>
                    </div>
                    <div class="flex-1 hidden md:block"></div>
                </div>
            <?php endforeach; ?>
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
<!-- VISI MISI -->
<!-- ============================================================ -->
<section class="py-24 md:py-32 bg-hijau-950 relative overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-15"></div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-kuning-500/5 rounded-full blur-[150px]"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-hijau-400/5 rounded-full blur-[120px]"></div>

    <div id="visi-particles" class="absolute inset-0 overflow-hidden pointer-events-none"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="text-center mb-20 reveal">
            <div class="ornament-divider mb-5 max-w-xs mx-auto">
                <span class="font-arabic text-kuning-400/70 text-xl">الرؤية</span>
            </div>
            <h2 class="font-display text-4xl md:text-5xl font-bold text-white mb-5 split-text" data-split-reveal>Visi & Misi</h2>
            <p class="text-hijau-300/70 max-w-lg mx-auto text-base">Fondasi dan arah perjalanan Yayasan Ar-Razaq</p>
        </div>

        <?php if (!empty($visi)): $v = $visi[0]; ?>
            <div class="max-w-3xl mx-auto mb-20 reveal">
                <div class="relative bg-gradient-to-br from-kuning-500/8 to-transparent border border-kuning-500/15 rounded-[2rem] p-8 md:p-14 text-center backdrop-blur-sm overflow-hidden">
                    <div class="absolute top-0 left-0 w-20 h-20 border-t-2 border-l-2 border-kuning-500/20 rounded-tl-[2rem]"></div>
                    <div class="absolute bottom-0 right-0 w-20 h-20 border-b-2 border-r-2 border-kuning-500/20 rounded-br-[2rem]"></div>
                    <div class="w-14 h-14 bg-kuning-500/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i data-feather="eye" class="w-7 h-7 text-kuning-400"></i>
                    </div>
                    <div class="text-kuning-400/80 font-medium text-xs tracking-[0.2em] uppercase mb-5">Visi Kami</div>
                    <p class="text-white font-display text-xl md:text-2xl leading-relaxed font-medium italic">"<?= $v->konten ?>"</p>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($misi)): ?>
            <div class="mb-20">
                <h3 class="font-display text-2xl font-bold text-kuning-400 text-center mb-12 reveal">Misi Yayasan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl mx-auto stagger-parent">
                    <?php foreach ($misi as $item): ?>
                        <div class="stagger-child group">
                            <div class="flex gap-5 bg-white/[0.03] backdrop-blur-sm border border-white/[0.06] rounded-2xl p-6 hover:border-kuning-500/20 hover:bg-white/[0.06] transition-all duration-500 card-3d h-full">
                                <div class="w-11 h-11 bg-hijau-800/60 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-kuning-500/20 transition-colors duration-500">
                                    <i data-feather="<?= $item->ikon ?: 'check-circle' ?>" class="w-5 h-5 text-kuning-400"></i>
                                </div>
                                <div>
                                    <h4 class="text-white font-semibold mb-2 text-[15px]"><?= $item->judul ?></h4>
                                    <p class="text-hijau-300/60 text-sm leading-relaxed"><?= $item->konten ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($nilai)): ?>
            <div>
                <h3 class="font-display text-2xl font-bold text-kuning-400 text-center mb-12 reveal">Nilai-Nilai Kami</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-5 max-w-3xl mx-auto stagger-parent">
                    <?php foreach ($nilai as $item): ?>
                        <div class="stagger-child text-center group">
                            <div class="w-16 h-16 bg-gradient-to-br from-hijau-800 to-hijau-900 group-hover:from-kuning-500 group-hover:to-kuning-600 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all duration-700 shadow-lg group-hover:shadow-kuning-500/20 group-hover:-translate-y-1">
                                <i data-feather="<?= $item->ikon ?: 'star' ?>" class="w-7 h-7 text-kuning-400 group-hover:text-hijau-950 transition-colors duration-500"></i>
                            </div>
                            <h4 class="text-white font-semibold text-sm mb-1"><?= $item->judul ?></h4>
                            <p class="text-hijau-400/50 text-xs leading-relaxed"><?= $item->konten ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="wave-divider wave-bottom">
        <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,60 C240,10 480,90 720,50 C960,10 1200,80 1440,40 L1440,100 L0,100 Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

<!-- ============================================================ -->
<!-- MAPS EMBED -->
<!-- ============================================================ -->
<?php if (isset($profil) && $profil && !empty($profil->maps_embed)): ?>
<section class="py-20 bg-gray-50 relative">
    <div class="container mx-auto px-4 lg:px-8">
        <div class="text-center mb-12 reveal">
            <h2 class="font-display text-3xl md:text-4xl font-bold text-hijau-900 mb-3">Lokasi Kami</h2>
            <p class="text-gray-500 text-base">Temukan kami di maps</p>
        </div>
        <div class="max-w-4xl mx-auto rounded-3xl overflow-hidden shadow-xl shadow-hijau-900/10 border border-gray-100 reveal">
            <div class="aspect-video">
                <?= $profil->maps_embed ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
