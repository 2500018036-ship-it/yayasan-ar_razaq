<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ============================================================ -->
<!-- PAGE HERO BANNER -->
<!-- ============================================================ -->
<section class="relative pt-32 pb-20 md:pt-40 md:pb-28 bg-hijau-950 overflow-hidden grain">
    <div class="absolute inset-0 pattern-bg opacity-20"></div>
    <div class="absolute top-1/4 -left-20 w-[400px] h-[400px] bg-hijau-700/15 rounded-full blur-[120px] floating-slow"></div>
    <div class="absolute bottom-1/3 -right-20 w-[300px] h-[300px] bg-kuning-500/8 rounded-full blur-[100px] floating"></div>

    <!-- Floating crescents -->
    <div class="absolute top-20 left-[10%] opacity-[0.06] floating hidden lg:block">
        <svg width="60" height="60" viewBox="0 0 60 60" fill="white">
            <path d="M30 5C16.2 5 5 16.2 5 30s11.2 25 25 25c-8.3 0-15-11.2-15-25S21.7 5 30 5z"/>
        </svg>
    </div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
        <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4">Penerimaan Santri Baru</h1>
        <p class="text-hijau-200/70 text-lg max-w-xl mx-auto">Bergabunglah bersama kami dalam membentuk generasi Qurani yang berakhlak mulia</p>
    </div>
</section>

<?php if (!empty($ppdb)): ?>
<!-- ============================================================ -->
<!-- PPDB INFO SECTION -->
<!-- ============================================================ -->
<section class="py-20 md:py-28 bg-white relative overflow-hidden">
    <div class="absolute top-20 right-0 w-72 h-72 bg-hijau-50 rounded-full blur-[100px] opacity-60"></div>
    <div class="absolute bottom-20 left-0 w-60 h-60 bg-kuning-50 rounded-full blur-[80px] opacity-40"></div>

    <div class="container mx-auto px-4 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Title & Description -->
            <div class="text-center mb-16 reveal">
                <h2 class="font-display text-3xl md:text-4xl font-bold text-hijau-900 mb-5"><?= $ppdb->judul ?></h2>
                <?php if ($ppdb->deskripsi): ?>
                    <p class="text-gray-500 text-lg max-w-2xl mx-auto leading-relaxed"><?= $ppdb->deskripsi ?></p>
                <?php endif; ?>
            </div>

            <!-- Info Cards -->
            <div class="flex gap-4 overflow-x-auto pb-4 px-1 -mx-1 md:grid md:grid-cols-3 md:gap-6 md:overflow-visible md:pb-0 md:px-0 md:mx-0 mb-16 stagger-parent snap-x snap-mandatory">
                <?php if ($ppdb->tanggal_buka && $ppdb->tanggal_tutup): ?>
                <div class="stagger-child min-w-[240px] sm:min-w-[270px] md:min-w-0 flex-shrink-0 md:flex-shrink snap-start">
                    <div class="bg-hijau-50 border border-hijau-100/60 rounded-3xl p-7 text-center card-hover h-full">
                        <div class="w-14 h-14 bg-hijau-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                            <i data-feather="calendar" class="w-7 h-7 text-hijau-700"></i>
                        </div>
                        <h3 class="font-display font-bold text-hijau-900 mb-2">Periode Pendaftaran</h3>
                        <p class="text-gray-500 text-sm">
                            <?= date('d M Y', strtotime($ppdb->tanggal_buka)) ?><br>
                            <span class="text-gray-300">s/d</span><br>
                            <?= date('d M Y', strtotime($ppdb->tanggal_tutup)) ?>
                        </p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($ppdb->kuota): ?>
                <div class="stagger-child min-w-[240px] sm:min-w-[270px] md:min-w-0 flex-shrink-0 md:flex-shrink snap-start">
                    <div class="bg-kuning-50 border border-kuning-100/60 rounded-3xl p-7 text-center card-hover h-full">
                        <div class="w-14 h-14 bg-kuning-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                            <i data-feather="users" class="w-7 h-7 text-kuning-600"></i>
                        </div>
                        <h3 class="font-display font-bold text-hijau-900 mb-2">Kuota Tersedia</h3>
                        <p class="text-3xl font-display font-bold text-kuning-600"><?= number_format($ppdb->kuota) ?></p>
                        <p class="text-gray-400 text-sm mt-1">Santri</p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($ppdb->biaya_pendaftaran): ?>
                <div class="stagger-child min-w-[240px] sm:min-w-[270px] md:min-w-0 flex-shrink-0 md:flex-shrink snap-start">
                    <div class="bg-hijau-50 border border-hijau-100/60 rounded-3xl p-7 text-center card-hover h-full">
                        <div class="w-14 h-14 bg-hijau-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                            <i data-feather="credit-card" class="w-7 h-7 text-hijau-700"></i>
                        </div>
                        <h3 class="font-display font-bold text-hijau-900 mb-2">Biaya Pendaftaran</h3>
                        <p class="text-2xl font-display font-bold text-hijau-800">Rp <?= number_format($ppdb->biaya_pendaftaran, 0, ',', '.') ?></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Syarat Pendaftaran -->
            <?php if (!empty($ppdb->syarat)): ?>
            <div class="mb-16 reveal">
                <div class="bg-white rounded-3xl border border-gray-100/80 shadow-sm overflow-hidden">
                    <div class="px-8 py-6 bg-hijau-800 relative overflow-hidden">
                        <div class="absolute inset-0 pattern-bg opacity-10"></div>
                        <h3 class="font-display text-xl font-bold text-white relative z-10 flex items-center gap-3">
                            <i data-feather="clipboard" class="w-5 h-5 text-kuning-400"></i>
                            Syarat Pendaftaran
                        </h3>
                    </div>
                    <div class="p-8 text-gray-600 leading-relaxed prose max-w-none">
                        <?= nl2br($ppdb->syarat) ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Alur Pendaftaran -->
            <?php if (!empty($ppdb->alur_pendaftaran)): ?>
            <div class="mb-16 reveal">
                <div class="bg-white rounded-3xl border border-gray-100/80 shadow-sm overflow-hidden">
                    <div class="px-8 py-6 bg-kuning-500 relative overflow-hidden">
                        <div class="absolute inset-0 pattern-bg opacity-10"></div>
                        <h3 class="font-display text-xl font-bold text-hijau-950 relative z-10 flex items-center gap-3">
                            <i data-feather="git-branch" class="w-5 h-5"></i>
                            Alur Pendaftaran
                        </h3>
                    </div>
                    <div class="p-8 text-gray-600 leading-relaxed prose max-w-none">
                        <?= nl2br($ppdb->alur_pendaftaran) ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Kontak Info -->
            <?php if (!empty($ppdb->kontak_info)): ?>
            <div class="mb-16 reveal">
                <div class="bg-white rounded-3xl border border-gray-100/80 shadow-sm overflow-hidden">
                    <div class="px-8 py-6 bg-hijau-800 relative overflow-hidden">
                        <div class="absolute inset-0 pattern-bg opacity-10"></div>
                        <h3 class="font-display text-xl font-bold text-white relative z-10 flex items-center gap-3">
                            <i data-feather="phone" class="w-5 h-5 text-kuning-400"></i>
                            Informasi Kontak
                        </h3>
                    </div>
                    <div class="p-8 md:p-10">
                        <?php
                        $kontak_lines = preg_split('/\r\n|\r|\n/', trim((string) $ppdb->kontak_info));
                        $kontak_lines = array_values(array_filter(array_map('trim', $kontak_lines), static function ($line) {
                            return $line !== '';
                        }));
                        ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php if (!empty($kontak_lines)): ?>
                                <?php foreach ($kontak_lines as $line): ?>
                                    <div class="flex items-start gap-3 bg-hijau-50/70 border border-hijau-100 rounded-2xl px-5 py-4">
                                        <span class="flex-shrink-0 w-8 h-8 rounded-lg bg-hijau-100 text-hijau-700 inline-flex items-center justify-center">
                                            <i data-feather="chevron-right" class="w-4 h-4"></i>
                                        </span>
                                        <p class="text-gray-700 leading-relaxed"><?= htmlspecialchars($line, ENT_QUOTES) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-600 leading-relaxed"><?= nl2br(htmlspecialchars($ppdb->kontak_info, ENT_QUOTES)) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Google Maps Preview -->
            <?php if (!empty($ppdb->maps_url)): ?>
            <div class="mb-16 reveal">
                <div class="bg-white rounded-3xl border border-gray-100/80 shadow-sm overflow-hidden">
                    <div class="px-8 py-6 bg-hijau-800 relative overflow-hidden">
                        <div class="absolute inset-0 pattern-bg opacity-10"></div>
                        <h3 class="font-display text-xl font-bold text-white relative z-10 flex items-center gap-3">
                            <i data-feather="map-pin" class="w-5 h-5 text-kuning-400"></i>
                            Lokasi Yayasan
                        </h3>
                    </div>
                    <div class="aspect-video">
                        <?php
                        $maps_embed_url = $ppdb->maps_url;
                        // Convert Google Maps URL to embed URL
                        if (strpos($maps_embed_url, '/embed') === false) {
                            // Use ~ delimiter so URL slashes do not break regex parsing
                            if (preg_match('~(?:^|/)place/([^/?#]+)~', $maps_embed_url, $matches)) {
                                $maps_embed_url = 'https://maps.google.com/maps?q=' . urlencode(urldecode($matches[1])) . '&output=embed';
                            } elseif (preg_match('/@([\d.-]+),([\d.-]+)/', $maps_embed_url, $matches)) {
                                $maps_embed_url = 'https://maps.google.com/maps?q=' . $matches[1] . ',' . $matches[2] . '&output=embed';
                            } else {
                                $maps_embed_url = 'https://maps.google.com/maps?q=' . urlencode($maps_embed_url) . '&output=embed';
                            }
                        }
                        ?>
                        <iframe src="<?= $maps_embed_url ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- CTA -->
            <div class="text-center reveal">
                <div class="bg-hijau-900 rounded-3xl p-10 md:p-14 relative overflow-hidden">
                    <div class="absolute inset-0 pattern-bg opacity-10"></div>
                    <div class="relative z-10">
                        <h3 class="font-display text-2xl md:text-3xl font-bold text-white mb-4">Siap Bergabung?</h3>
                        <p class="text-hijau-200/70 text-base mb-8 max-w-lg mx-auto">Daftarkan putra/putri Anda sekarang dan jadilah bagian dari keluarga besar Yayasan Ar-Razaq</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <?php if ($ppdb->link_pendaftaran): ?>
                                <a href="<?= $ppdb->link_pendaftaran ?>" target="_blank" class="magnetic-btn bg-kuning-500 text-hijau-950 font-bold px-10 py-4 rounded-2xl text-base shadow-xl shadow-kuning-500/20 hover:shadow-kuning-500/40 transition-all duration-500 hover:-translate-y-1 flex items-center justify-center gap-2 pulse-glow">
                                    <i data-feather="external-link" class="w-5 h-5"></i>
                                    Daftar Online
                                </a>
                            <?php endif; ?>
                            <?php if (isset($profil) && $profil && $profil->whatsapp): ?>
                                <a href="https://wa.me/<?= $profil->whatsapp ?>?text=Assalamu'alaikum, saya ingin bertanya mengenai pendaftaran santri baru" target="_blank" class="magnetic-btn border border-white/15 text-white font-semibold px-10 py-4 rounded-2xl text-base hover:bg-white/10 transition-all duration-500 flex items-center justify-center gap-2">
                                    <i data-feather="message-circle" class="w-5 h-5"></i>
                                    Hubungi via WhatsApp
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php else: ?>
<!-- No PPDB Data -->
<section class="py-28 bg-white">
    <div class="container mx-auto px-4 text-center">
        <i data-feather="user-plus" class="w-14 h-14 text-gray-200 mx-auto mb-4"></i>
        <p class="text-gray-400 text-lg font-medium">Informasi pendaftaran santri baru belum tersedia</p>
        <p class="text-gray-300 text-sm mt-2">Silakan hubungi kami untuk informasi lebih lanjut</p>
    </div>
</section>
<?php endif; ?>
