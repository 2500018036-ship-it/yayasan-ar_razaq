<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ============================================================ -->
<!-- HERO                                                           -->
<!-- ============================================================ -->
<section class="relative overflow-hidden bg-hijau-950 pb-20 pt-32 grain md:pb-28 md:pt-40">
    <div class="absolute inset-0 pattern-bg opacity-20"></div>
    <div class="absolute top-1/4 -left-20 h-[400px] w-[400px] rounded-full bg-hijau-700/15 blur-[120px] floating-slow"></div>
    <div class="absolute bottom-1/3 -right-20 h-[300px] w-[300px] rounded-full bg-kuning-500/8 blur-[100px] floating"></div>
    <div class="container relative z-10 mx-auto px-4 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <div class="ornament-divider mx-auto mb-5 max-w-xs">
                <span class="font-arabic text-xl text-kuning-400/70">Pendaftaran</span>
            </div>
            <h1 class="font-display text-4xl font-bold text-white md:text-5xl lg:text-6xl">Penerimaan Santri Baru</h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-relaxed text-hijau-200/70">Informasi pendaftaran disusun lebih ringkas, formal, dan mudah ditinjau agar orang tua maupun calon santri dapat memahami alur secara cepat.</p>
        </div>
    </div>
</section>

<?php if (!empty($ppdb)): ?>
    <?php
    /* ── Maps URL ──────────────────────────────────────────────────── */
    $maps_embed_url = '';
    if (!empty($ppdb->maps_url)) {
        $maps_embed_url = $ppdb->maps_url;
        if (strpos($maps_embed_url, '/embed') === false) {
            if (preg_match('~(?:^|/)place/([^/?#]+)~', $maps_embed_url, $m)) {
                $maps_embed_url = 'https://maps.google.com/maps?q=' . urlencode(urldecode($m[1])) . '&output=embed';
            } elseif (preg_match('/@([\d.-]+),([\d.-]+)/', $maps_embed_url, $m)) {
                $maps_embed_url = 'https://maps.google.com/maps?q=' . $m[1] . ',' . $m[2] . '&output=embed';
            } else {
                $maps_embed_url = 'https://maps.google.com/maps?q=' . urlencode($maps_embed_url) . '&output=embed';
            }
        }
    }
    $has_maps_preview = $maps_embed_url !== '';

    /* ── Split lines ───────────────────────────────────────────────── */
    $split = static function ($str) {
        $lines = preg_split('/\r\n|\r|\n/', trim((string) $str));
        return array_values(array_filter(array_map('trim', $lines), static fn($l) => $l !== ''));
    };
    $syarat_lines = $split($ppdb->syarat);
    $alur_lines   = $split($ppdb->alur_pendaftaran);
    $kontak_lines = $split($ppdb->kontak_info);

    /* ── Status badge ──────────────────────────────────────────────── */
    $ppdb_year  = isset($ppdb->tahun_ajaran) ? trim((string) $ppdb->tahun_ajaran) : '';
    $today      = strtotime(date('Y-m-d'));
    $open_ts    = !empty($ppdb->tanggal_buka)  ? strtotime($ppdb->tanggal_buka)  : null;
    $close_ts   = !empty($ppdb->tanggal_tutup) ? strtotime($ppdb->tanggal_tutup) : null;
    $status_label = 'Informasi pendaftaran telah dipublikasikan';
    $status_note  = 'Silakan tinjau ringkasan, persyaratan, dan alur sebelum menghubungi panitia.';
    $status_cls   = 'border-hijau-200 bg-hijau-50 text-hijau-800';
    if ($open_ts && $close_ts) {
        if ($today < $open_ts) {
            $status_label = 'Pendaftaran segera dibuka';
            $status_note  = 'Periode pendaftaran dimulai pada ' . date('d M Y', $open_ts) . '.';
            $status_cls   = 'border-kuning-200 bg-kuning-50 text-kuning-700';
        } elseif ($today > $close_ts) {
            $status_label = 'Periode pendaftaran telah berakhir';
            $status_note  = 'Silakan hubungi admin untuk informasi gelombang berikutnya.';
            $status_cls   = 'border-gray-200 bg-gray-50 text-gray-600';
        } else {
            $status_label = 'Pendaftaran sedang berlangsung';
            $status_note  = 'Pendaftaran aktif sampai ' . date('d M Y', $close_ts) . '.';
        }
    }
    ?>

    <!-- ============================================================ -->
    <!-- MAIN CONTENT                                                   -->
    <!-- Kiri  : judul · deskripsi · status · syarat · alur (menyatu) -->
    <!-- Kanan : Ringkasan Pendaftaran (panel gelap, sticky)           -->
    <!-- ============================================================ -->
    <section class="relative overflow-hidden bg-slate-50 py-16 md:py-24">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(202,138,4,0.08),_transparent_32%),radial-gradient(circle_at_bottom_left,_rgba(22,101,52,0.08),_transparent_28%)]"></div>

        <div class="container relative z-10 mx-auto px-4 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="grid grid-cols-1 items-start gap-12 xl:grid-cols-[1fr_380px]">

                    <!-- ══ KIRI · menyatu ke body, tanpa wrapper card ══ -->
                    <div class="reveal space-y-12">

                        <!-- Judul & deskripsi -->
                        <div>
                            <div class="inline-flex items-center gap-2 rounded-full border border-hijau-100 bg-hijau-50 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-hijau-700">
                                Informasi Resmi PPDB
                            </div>
                            <h2 class="mt-5 font-display text-3xl font-bold leading-tight text-hijau-950 md:text-4xl lg:text-5xl"><?= $ppdb->judul ?></h2>
                            <?php if ($ppdb->deskripsi): ?>
                                <p class="mt-5 max-w-2xl text-base leading-relaxed text-gray-500 md:text-lg"><?= $ppdb->deskripsi ?></p>
                            <?php endif; ?>
                            <!-- Status inline -->
                            <div class="mt-6 inline-flex flex-col rounded-2xl border px-5 py-4 text-sm <?= $status_cls ?>">
                                <span class="text-[10px] font-bold uppercase tracking-[0.18em] opacity-60">Status Pendaftaran</span>
                                <span class="mt-1 font-semibold"><?= $status_label ?></span>
                                <span class="mt-1 text-xs leading-relaxed opacity-75"><?= $status_note ?></span>
                            </div>
                        </div>

                        <!-- Syarat Pendaftaran -->
                        <?php if (!empty($syarat_lines)): ?>
                            <div>
                                <div class="mb-5 flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-hijau-900 text-white shadow-sm">
                                        <i data-feather="check-square" class="h-4 w-4"></i>
                                    </div>
                                    <h3 class="font-display text-xl font-bold text-hijau-950">Syarat Pendaftaran</h3>
                                </div>
                                <p class="mb-5 max-w-xl text-sm leading-relaxed text-gray-400">Dokumen dan ketentuan yang perlu disiapkan sebelum proses pendaftaran dimulai.</p>
                                <div class="space-y-3">
                                    <?php foreach ($syarat_lines as $i => $line): ?>
                                        <div class="flex items-start gap-4">
                                            <div class="flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-full bg-hijau-100 text-xs font-bold text-hijau-700"><?= $i + 1 ?></div>
                                            <p class="pt-0.5 text-sm leading-relaxed text-gray-600"><?= htmlspecialchars($line, ENT_QUOTES) ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Alur Pendaftaran -->
                        <?php if (!empty($alur_lines)): ?>
                            <div>
                                <div class="mb-5 flex items-center gap-3">
                                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-kuning-500 text-hijau-950 shadow-sm">
                                        <i data-feather="git-branch" class="h-4 w-4"></i>
                                    </div>
                                    <h3 class="font-display text-xl font-bold text-hijau-950">Alur Pendaftaran</h3>
                                </div>
                                <p class="mb-5 max-w-xl text-sm leading-relaxed text-gray-400">Urutan proses dibuat runtut agar calon wali santri dapat mengikuti setiap tahap dengan jelas.</p>
                                <!-- Timeline vertikal -->
                                <div class="relative pl-5">
                                    <div class="absolute left-[13px] top-2 bottom-2 w-px bg-gray-200"></div>
                                    <div class="space-y-6">
                                        <?php foreach ($alur_lines as $i => $line): ?>
                                            <div class="relative flex items-start gap-5">
                                                <div class="relative z-10 flex h-7 w-7 flex-shrink-0 -translate-x-1/2 items-center justify-center rounded-full border-2 border-kuning-400 bg-white text-xs font-bold text-kuning-600"><?= $i + 1 ?></div>
                                                <p class="pt-0.5 text-sm leading-relaxed text-gray-600"><?= htmlspecialchars($line, ENT_QUOTES) ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div><!-- /kiri -->

                    <!-- ══ KANAN · Ringkasan Pendaftaran (satu-satunya card) ══ -->
                    <aside class="reveal-right xl:sticky xl:top-28 rounded-[28px] bg-hijau-950 p-8 text-white shadow-2xl shadow-hijau-950/20">
                        <div class="mt-6 space-y-2.5">
                            <?php if ($ppdb_year !== ''): ?>
                                <div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                    <span class="text-sm text-hijau-200/80">Tahun Ajaran</span>
                                    <span class="text-sm font-semibold text-white"><?= html_escape($ppdb_year) ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($ppdb->tanggal_buka && $ppdb->tanggal_tutup): ?>
                                <div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                    <span class="text-sm text-hijau-200/80">Periode</span>
                                    <span class="text-right text-sm font-semibold text-white"><?= date('d M Y', strtotime($ppdb->tanggal_buka)) ?> – <?= date('d M Y', strtotime($ppdb->tanggal_tutup)) ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ($ppdb->kuota): ?>
                                <div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                    <span class="text-sm text-hijau-200/80">Kuota</span>
                                    <span class="text-sm font-semibold text-white"><?= number_format($ppdb->kuota) ?> santri</span>
                                </div>
                            <?php endif; ?>
                            <?php if ($ppdb->biaya_pendaftaran): ?>
                                <div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">
                                    <span class="text-sm text-hijau-200/80">Biaya</span>
                                    <span class="text-sm font-semibold text-white">Rp <?= number_format($ppdb->biaya_pendaftaran, 0, ',', '.') ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="mt-7 flex flex-col gap-3">
                            <?php if ($ppdb->link_pendaftaran): ?>
                                <a href="<?= htmlspecialchars($ppdb->link_pendaftaran, ENT_QUOTES) ?>" target="_blank"
                                    class="magnetic-btn inline-flex items-center justify-center gap-2 rounded-2xl bg-kuning-500 px-6 py-4 text-sm font-bold text-hijau-950 shadow-xl shadow-kuning-500/20 transition-all duration-500 hover:-translate-y-1 hover:bg-kuning-400">
                                    <i data-feather="external-link" class="h-5 w-5"></i>
                                    Daftar Online
                                </a>
                            <?php endif; ?>
                            <?php if (isset($profil) && $profil && $profil->whatsapp): ?>
                                <a href="https://wa.me/<?= $profil->whatsapp ?>?text=Assalamu'alaikum, saya ingin bertanya mengenai pendaftaran santri baru"
                                    target="_blank"
                                    class="magnetic-btn inline-flex items-center justify-center gap-2 rounded-2xl border border-white/15 px-6 py-4 text-sm font-semibold text-white transition-all duration-500 hover:bg-white/10">
                                    <i data-feather="message-circle" class="h-5 w-5"></i>
                                    WhatsApp
                                </a>
                            <?php endif; ?>
                        </div>
                    </aside>

                </div><!-- /grid -->
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- INFORMASI PPDB · bg putih, menyatu, ikon kuning bulat         -->
    <!-- Persis gaya "Informasi Kontak" pada referensi gambar          -->
    <!-- ============================================================ -->
    <section class="bg-white py-16 md:py-20">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="mb-10">
                    <h2 class="font-display text-2xl font-bold text-hijau-950 md:text-3xl">Informasi PPDB</h2>
                    <div class="mt-2 h-1 w-12 rounded-full bg-kuning-500"></div>
                </div>

                <div class="grid grid-cols-1 gap-x-12 gap-y-8 sm:grid-cols-2 lg:grid-cols-3">

                    <?php if ($ppdb_year !== ''): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="book-open" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">Tahun Ajaran</p>
                                <p class="mt-0.5 text-sm leading-relaxed text-gray-500"><?= html_escape($ppdb_year) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($ppdb->tanggal_buka && $ppdb->tanggal_tutup): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="calendar" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">Periode Pendaftaran</p>
                                <p class="mt-0.5 text-sm leading-relaxed text-gray-500"><?= date('d M Y', strtotime($ppdb->tanggal_buka)) ?> – <?= date('d M Y', strtotime($ppdb->tanggal_tutup)) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($ppdb->kuota): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="users" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">Kuota Santri</p>
                                <p class="mt-0.5 text-sm leading-relaxed text-gray-500"><?= number_format($ppdb->kuota) ?> santri</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($ppdb->biaya_pendaftaran): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="credit-card" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">Biaya Pendaftaran</p>
                                <p class="mt-0.5 text-sm leading-relaxed text-gray-500">Rp <?= number_format($ppdb->biaya_pendaftaran, 0, ',', '.') ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($profil) && $profil && $profil->whatsapp): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="message-circle" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">WhatsApp</p>
                                <a href="https://wa.me/<?= $profil->whatsapp ?>?text=Assalamu'alaikum, saya ingin bertanya mengenai pendaftaran santri baru"
                                    target="_blank" class="mt-0.5 block text-sm leading-relaxed text-kuning-600 hover:underline">
                                    <?= htmlspecialchars($profil->whatsapp, ENT_QUOTES) ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($profil) && $profil && !empty($profil->email)): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="mail" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">Email</p>
                                <a href="mailto:<?= htmlspecialchars($profil->email, ENT_QUOTES) ?>"
                                    class="mt-0.5 block text-sm leading-relaxed text-kuning-600 hover:underline">
                                    <?= htmlspecialchars($profil->email, ENT_QUOTES) ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($profil) && $profil && !empty($profil->website)): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="globe" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">Website</p>
                                <a href="<?= htmlspecialchars($profil->website, ENT_QUOTES) ?>" target="_blank"
                                    class="mt-0.5 block text-sm leading-relaxed text-kuning-600 hover:underline">
                                    <?= htmlspecialchars($profil->website, ENT_QUOTES) ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($profil) && $profil && !empty($profil->alamat)): ?>
                        <div class="flex items-start gap-4 sm:col-span-2 lg:col-span-1">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="map-pin" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">Alamat</p>
                                <p class="mt-0.5 text-sm leading-relaxed text-gray-500"><?= htmlspecialchars($profil->alamat, ENT_QUOTES) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($ppdb->link_pendaftaran): ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-full bg-kuning-500 text-white shadow-md shadow-kuning-500/30">
                                <i data-feather="external-link" class="h-4 w-4"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-hijau-950">Formulir Online</p>
                                <a href="<?= htmlspecialchars($ppdb->link_pendaftaran, ENT_QUOTES) ?>" target="_blank"
                                    class="mt-0.5 block text-sm leading-relaxed text-kuning-600 hover:underline">
                                    Klik untuk mendaftar online
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div><!-- /grid info -->
            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- GOOGLE MAPS · Full-width, menggantikan footer                  -->
    <!-- ============================================================ -->
    <?php if ($has_maps_preview): ?>
        <div class="relative w-full overflow-hidden" style="height: 440px;">
            <?php if (!empty($ppdb->maps_url)): ?>
                <a href="<?= htmlspecialchars($ppdb->maps_url, ENT_QUOTES) ?>" target="_blank" rel="noopener"
                    class="absolute bottom-5 right-5 z-10 inline-flex items-center gap-2 rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-hijau-900 shadow-xl transition-all duration-300 hover:-translate-y-0.5 hover:shadow-2xl">
                    <i data-feather="navigation" class="h-4 w-4 text-hijau-700"></i>
                    Buka di Google Maps
                </a>
            <?php endif; ?>
            <iframe
                src="<?= htmlspecialchars($maps_embed_url, ENT_QUOTES) ?>"
                class="absolute inset-0 h-full w-full"
                style="border:0; filter: saturate(0.85) contrast(1.05);"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    <?php else: ?>
        <?php $this->load->view('templates/footer', isset($data) ? $data : []); ?>
    <?php endif; ?>

<?php else: ?>
    <!-- ============================================================ -->
    <!-- EMPTY STATE                                                    -->
    <!-- ============================================================ -->
    <section class="bg-white py-28">
        <div class="container mx-auto px-4 text-center">
            <i data-feather="user-plus" class="mx-auto mb-4 h-14 w-14 text-gray-200"></i>
            <p class="text-lg font-medium text-gray-400">Informasi pendaftaran santri baru belum tersedia</p>
            <p class="mt-2 text-sm text-gray-300">Silakan hubungi kami untuk mendapatkan informasi lebih lanjut.</p>
        </div>
    </section>
<?php endif; ?>