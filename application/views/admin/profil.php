<?php
/** @var object|null $profil Data profil yayasan dari controller */
$p = isset($profil) ? $profil : null;
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_edit = in_array('profil.edit', $permission_codes, true);

$about_media = $p && !empty($p->about_section_media) ? (string) $p->about_section_media : '';
$about_media_ext = strtolower(pathinfo($about_media, PATHINFO_EXTENSION));
$about_media_is_video = in_array($about_media_ext, ['mp4', 'webm', 'ogg'], true);
?>

<div class="max-w-5xl space-y-6">
    <!-- ============================================================ -->
    <!-- PROFIL YAYASAN -->
    <!-- ============================================================ -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <h2 class="font-display font-bold text-gray-900">Informasi Profil Yayasan</h2>
            <p class="text-sm text-gray-500 mt-1">Semua input lama tetap dipakai, lalu saya tambahkan pengaturan untuk section Sejarah &amp; Profil pada frontend.</p>
        </div>
        <div class="p-6 space-y-6">
            <!-- Basic info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Yayasan <span class="text-red-500">*</span></label>
                    <input type="text" id="f-nama" value="<?= $p ? html_escape($p->nama_yayasan) : '' ?>" placeholder="Nama yayasan..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tagline</label>
                    <input type="text" id="f-tagline" value="<?= $p ? html_escape($p->tagline) : '' ?>" placeholder="Tagline singkat yayasan..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Lengkap</label>
                    <textarea id="f-deskripsi-lengkap" rows="6" placeholder="Deskripsi utama yayasan. Konten ini tampil di halaman Tentang Kami..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-y"><?= $p ? html_escape($p->deskripsi_lengkap) : '' ?></textarea>
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Section Sejarah & Profil -->
            <h3 class="font-semibold text-gray-800 text-sm">Section Sejarah &amp; Profil</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Label Kecil</label>
                    <input type="text" id="f-about-label" value="<?= $p ? html_escape($p->about_section_label) : 'About Us' ?>" placeholder="About Us"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Sub Bagian</label>
                    <input type="text" id="f-about-badge" value="<?= $p ? html_escape($p->about_section_badge) : 'Profil Singkat' ?>" placeholder="Profil Singkat"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Profil Singkat</label>
                    <textarea id="f-deskripsi-singkat" rows="4" placeholder="Ringkasan singkat untuk section Sejarah & Profil..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-y"><?= $p ? html_escape($p->deskripsi_singkat) : '' ?></textarea>
                    <p class="text-xs text-gray-400 mt-2">Jika dikosongkan, sistem akan membuat ringkasan otomatis dari deskripsi lengkap.</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Teks Tombol</label>
                    <input type="text" id="f-about-cta-text" value="<?= $p ? html_escape($p->about_section_cta_text) : 'Selengkapnya' ?>" placeholder="Selengkapnya"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Link Tombol</label>
                    <input type="text" id="f-about-cta-link" value="<?= $p ? html_escape($p->about_section_cta_link) : 'tentang-kami' ?>" placeholder="tentang-kami atau https://..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Contact info -->
            <h3 class="font-semibold text-gray-800 text-sm">Informasi Kontak</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat</label>
                    <textarea id="f-alamat" rows="2" placeholder="Alamat lengkap yayasan..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-none"><?= $p ? html_escape($p->alamat) : '' ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon</label>
                    <input type="text" id="f-telepon" value="<?= $p ? html_escape($p->telepon) : '' ?>" placeholder="(0411) 123456"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" id="f-email" value="<?= $p ? html_escape($p->email) : '' ?>" placeholder="info@yayasan.sch.id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Website</label>
                    <input type="url" id="f-website" value="<?= $p ? html_escape($p->website) : '' ?>" placeholder="https://yayasan.sch.id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Social media -->
            <h3 class="font-semibold text-gray-800 text-sm">Media Sosial</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Facebook URL</label>
                    <input type="url" id="f-facebook" value="<?= $p ? html_escape($p->facebook) : '' ?>" placeholder="https://facebook.com/..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instagram URL</label>
                    <input type="url" id="f-instagram" value="<?= $p ? html_escape($p->instagram) : '' ?>" placeholder="https://instagram.com/..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">YouTube URL</label>
                    <input type="url" id="f-youtube" value="<?= $p ? html_escape($p->youtube) : '' ?>" placeholder="https://youtube.com/..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">WhatsApp (angka saja)</label>
                    <input type="text" id="f-whatsapp" value="<?= $p ? html_escape($p->whatsapp) : '' ?>" placeholder="6281234567890"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">TikTok URL</label>
                    <input type="url" id="f-tiktok" value="<?= $p && !empty($p->tiktok) ? html_escape($p->tiktok) : '' ?>" placeholder="https://tiktok.com/@..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Media uploads -->
            <h3 class="font-semibold text-gray-800 text-sm">Logo Yayasan</h3>
            <div class="grid grid-cols-1 gap-5">
                <div class="max-w-md">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Logo Yayasan</label>
                    <?php if ($p && $p->logo): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $p->logo) ?>" class="w-16 h-16 object-contain mb-2 rounded-lg border border-gray-100">
                    <?php endif; ?>
                    <input type="file" id="f-logo" accept="image/*" onchange="previewImage(this,'img-logo')"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                    <img id="img-logo" src="" class="hidden w-16 h-16 object-contain mt-2 rounded-lg border border-gray-100">
                </div>
            </div>

            <div class="rounded-2xl border border-dashed border-hijau-200 bg-hijau-50/40 p-5">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-800">Media Section Sejarah &amp; Profil</h4>
                        <p class="text-xs text-gray-500 mt-1">Tambahan baru sesuai instruksi Anda. Input lama tidak dihapus. Media ini akan tampil di kolom kiri section frontend.</p>
                    </div>
                    <?php if ($about_media && $can_edit): ?>
                        <button type="button" onclick="hapusMediaSection()"
                            class="inline-flex items-center gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 transition-colors">
                            <i data-feather="trash-2" class="w-4 h-4"></i>
                            Hapus Media
                        </button>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_260px] gap-5 mt-4">
                    <div>
                        <input type="file" id="f-about-media" accept="image/*,video/mp4,video/webm,video/ogg" onchange="previewSectionMedia(this)"
                            class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-100 file:text-hijau-800 hover:file:bg-hijau-200">
                        <div class="mt-3 rounded-xl bg-white border border-gray-100 px-4 py-3 text-xs text-gray-500 space-y-1">
                            <p>Format gambar: JPG, JPEG, PNG, GIF, WEBP.</p>
                            <p>Format video: MP4, WEBM, OGG.</p>
                            <p>File lama akan dihapus otomatis saat diganti atau dihapus.</p>
                        </div>
                    </div>

                    <div id="about-media-preview" class="rounded-2xl border border-gray-100 bg-white p-3">
                        <?php if ($about_media): ?>
                            <?php if ($about_media_is_video): ?>
                                <video controls class="w-full aspect-[4/5] rounded-xl object-cover bg-gray-900">
                                    <source src="<?= base_url('assets/images/uploads/profil/' . $about_media) ?>" type="video/<?= html_escape($about_media_ext) ?>">
                                </video>
                            <?php else: ?>
                                <img src="<?= base_url('assets/images/uploads/profil/' . $about_media) ?>" alt="Media section"
                                    class="w-full aspect-[4/5] rounded-xl object-cover">
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="aspect-[4/5] rounded-xl border border-dashed border-gray-200 bg-gray-50 flex items-center justify-center text-center text-sm text-gray-400 px-4">
                                Preview media section
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- YouTube Embed URL for About Section -->
            <div class="rounded-2xl border border-dashed border-blue-200 bg-blue-50/40 p-5">
                <h4 class="text-sm font-semibold text-gray-800 mb-1">Video YouTube — Section Profil Singkat</h4>
                <p class="text-xs text-gray-500 mb-3">Isi URL video YouTube jika ingin menampilkan video embed di kolom kiri section Sejarah &amp; Profil. Jika diisi, URL ini diutamakan di atas upload gambar/video.</p>
                <input type="url" id="f-about-video-url"
                    value="<?= $p && !empty($p->about_section_video_url) ? html_escape($p->about_section_video_url) : '' ?>"
                    placeholder="https://www.youtube.com/watch?v=..."
                    class="w-full px-4 py-2.5 border border-blue-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
            </div>

        </div>

        <?php if ($can_edit): ?>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
                <button onclick="simpan()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan Perubahan
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- ============================================================ -->
    <!-- HERO SECTION SETTINGS -->
    <!-- ============================================================ -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gradient-to-r from-hijau-50 to-kuning-50">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-hijau-100 rounded-lg flex items-center justify-center">
                    <i data-feather="monitor" class="w-5 h-5 text-hijau-700"></i>
                </div>
                <div>
                    <h2 class="font-display font-bold text-gray-900">Hero Section</h2>
                    <p class="text-sm text-gray-500">Atur tampilan hero beranda website</p>
                </div>
            </div>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr)_320px] gap-6 items-start">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Preview Hero Section</label>
                    <div class="rounded-2xl overflow-hidden border border-gray-200 relative" style="height: 240px;" id="hero-preview">
                        <img src="<?= $p && $p->hero_image ? base_url('assets/images/uploads/profil/' . $p->hero_image) : '' ?>"
                            class="w-full h-full object-cover absolute inset-0" id="hero-preview-bg"
                            onerror="this.style.display='none'">
                        <div class="absolute inset-0 flex items-center justify-center" id="hero-preview-overlay"
                            style="background: <?= $p && $p->hero_overlay_color ? $p->hero_overlay_color : '#052e16' ?>; opacity: <?= $p && $p->hero_overlay_opacity ? ($p->hero_overlay_opacity / 100) : '0.8' ?>;">
                        </div>
                        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center p-6">
                            <h3 class="font-display text-2xl md:text-3xl font-bold text-white mb-2" id="hero-preview-title">
                                <?= $p && $p->hero_title ? $p->hero_title : ($p ? $p->nama_yayasan : 'Yayasan Ar-Razaq') ?>
                            </h3>
                            <p class="text-white/70 text-sm" id="hero-preview-subtitle">
                                <?= $p && $p->hero_subtitle ? $p->hero_subtitle : ($p ? $p->tagline : 'Membentuk Generasi Qurani') ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-dashed border-hijau-200 bg-hijau-50/50 p-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Hero Utama</label>
                    <img id="hero-upload-preview"
                        src="<?= $p && $p->hero_image ? base_url('assets/images/uploads/profil/' . $p->hero_image) : '' ?>"
                        class="<?= $p && $p->hero_image ? '' : 'hidden ' ?>w-full h-28 object-cover rounded-xl border border-gray-100 mb-3">
                    <input type="file" id="f-hero" accept="image/*" onchange="handleHeroImageChange(this)"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-100 file:text-hijau-800 hover:file:bg-hijau-200">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Hero <span class="text-xs text-gray-400 font-normal">(kosongkan = nama yayasan)</span></label>
                    <input type="text" id="f-hero-title" value="<?= $p ? html_escape($p->hero_title) : '' ?>" placeholder="<?= $p ? html_escape($p->nama_yayasan) : '' ?>"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500"
                        oninput="updateHeroPreview()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subtitle Hero <span class="text-xs text-gray-400 font-normal">(kosongkan = tagline)</span></label>
                    <input type="text" id="f-hero-subtitle" value="<?= $p ? html_escape($p->hero_subtitle) : '' ?>" placeholder="<?= $p ? html_escape($p->tagline) : '' ?>"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500"
                        oninput="updateHeroPreview()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Warna Overlay</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="f-hero-color" value="<?= $p ? html_escape($p->hero_overlay_color) : '#052e16' ?>"
                            class="w-12 h-12 rounded-xl border border-gray-200 cursor-pointer p-1"
                            onchange="updateHeroPreview()">
                        <input type="text" id="f-hero-color-text" value="<?= $p ? html_escape($p->hero_overlay_color) : '#052e16' ?>" placeholder="#052e16"
                            class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500"
                            oninput="document.getElementById('f-hero-color').value = this.value; updateHeroPreview()">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Opacity Overlay: <span id="opacity-value"><?= $p ? (int) $p->hero_overlay_opacity : 80 ?></span>%</label>
                    <input type="range" id="f-hero-opacity" min="0" max="100" value="<?= $p ? (int) $p->hero_overlay_opacity : 80 ?>"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-hijau-600 mt-3"
                        oninput="document.getElementById('opacity-value').textContent = this.value; updateHeroPreview()">
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>Transparan</span>
                        <span>Gelap</span>
                    </div>
                </div>
            </div>

            <!-- Hero Slider Images -->
            <div class="rounded-xl border border-dashed border-hijau-200 bg-hijau-50/40 p-5">
                <h4 class="text-sm font-semibold text-gray-800 mb-1">🖼️ Slider Gambar Hero (maks. 5)</h4>
                <p class="text-xs text-gray-500 mb-4">Hero Image 1 sudah diset di atas. Tambahkan gambar 2–5 di bawah ini untuk mengaktifkan slider otomatis. Gambar yang kosong akan dilewati.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php
                    $slider_fields = ['hero_image_2', 'hero_image_3', 'hero_image_4', 'hero_image_5'];
                    foreach ($slider_fields as $sf_idx => $sf):
                        $sf_num = $sf_idx + 2;
                    ?>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Gambar <?= $sf_num ?></label>
                        <?php if ($p && !empty($p->$sf)): ?>
                            <img src="<?= base_url('assets/images/uploads/profil/' . $p->$sf) ?>"
                                 class="w-full h-20 object-cover mb-2 rounded-lg border border-gray-100">
                        <?php endif; ?>
                        <input type="file" id="f-hero-<?= $sf_num ?>" accept="image/*" onchange="previewImage(this,'img-hero-<?= $sf_num ?>')"
                            class="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                        <img id="img-hero-<?= $sf_num ?>" src="" class="hidden w-full h-20 object-cover mt-2 rounded-lg border border-gray-100">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php if ($can_edit): ?>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
                <button onclick="simpan()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan Semua
                </button>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>
    const canEditProfil = <?= $can_edit ? 'true' : 'false' ?>;

    function updateHeroPreview() {
        const color = document.getElementById('f-hero-color').value;
        const opacity = document.getElementById('f-hero-opacity').value / 100;
        const title = document.getElementById('f-hero-title').value || document.getElementById('f-hero-title').placeholder;
        const subtitle = document.getElementById('f-hero-subtitle').value || document.getElementById('f-hero-subtitle').placeholder;

        document.getElementById('hero-preview-overlay').style.background = color;
        document.getElementById('hero-preview-overlay').style.opacity = opacity;
        document.getElementById('hero-preview-title').textContent = title;
        document.getElementById('hero-preview-subtitle').textContent = subtitle;
        document.getElementById('f-hero-color-text').value = color;
    }

    function previewSectionMedia(input) {
        const preview = document.getElementById('about-media-preview');
        const file = input.files && input.files[0];

        if (!file) {
            return;
        }

        const url = URL.createObjectURL(file);
        const isVideo = file.type.startsWith('video/');

        preview.innerHTML = isVideo
            ? `<video controls class="w-full aspect-[4/5] rounded-xl object-cover bg-gray-900"><source src="${url}" type="${file.type}"></video>`
            : `<img src="${url}" alt="Preview media section" class="w-full aspect-[4/5] rounded-xl object-cover">`;
    }

    async function hapusMediaSection() {
        if (!canEditProfil) {
            showToast('Anda tidak punya izin edit profil yayasan.', 'error');
            return;
        }

        if (!confirm('Hapus media section Sejarah & Profil? File terkait juga akan dihapus dari folder upload.')) {
            return;
        }

        const fd = new FormData();
        fd.append('remove_about_section_media', '1');

        await ajaxSubmit('<?= base_url('panel-admin/profil/save') ?>', fd, () => {
            setTimeout(() => location.reload(), 800);
        });
    }

    async function simpan() {
        if (!canEditProfil) {
            showToast('Anda tidak punya izin edit profil yayasan.', 'error');
            return;
        }
        const nama = document.getElementById('f-nama').value.trim();
        if (!nama) {
            showToast('Nama yayasan wajib diisi', 'error');
            return;
        }

        const fd = new FormData();
        fd.append('nama_yayasan', nama);
        fd.append('tagline', document.getElementById('f-tagline').value);
        fd.append('deskripsi_lengkap', document.getElementById('f-deskripsi-lengkap').value);
        fd.append('deskripsi_singkat', document.getElementById('f-deskripsi-singkat').value);
        fd.append('about_section_label', document.getElementById('f-about-label').value);
        fd.append('about_section_badge', document.getElementById('f-about-badge').value);
        fd.append('about_section_cta_text', document.getElementById('f-about-cta-text').value);
        fd.append('about_section_cta_link', document.getElementById('f-about-cta-link').value);
        fd.append('struktur_organisasi_judul', document.getElementById('f-struktur-judul').value);
        fd.append('struktur_organisasi_deskripsi', document.getElementById('f-struktur-deskripsi').value);
        fd.append('alamat', document.getElementById('f-alamat').value);
        fd.append('telepon', document.getElementById('f-telepon').value);
        fd.append('email', document.getElementById('f-email').value);
        fd.append('website', document.getElementById('f-website').value);
        fd.append('facebook', document.getElementById('f-facebook').value);
        fd.append('instagram', document.getElementById('f-instagram').value);
        fd.append('youtube', document.getElementById('f-youtube').value);
        fd.append('whatsapp', document.getElementById('f-whatsapp').value);
        const tiktokEl = document.getElementById('f-tiktok');
        if (tiktokEl) fd.append('tiktok', tiktokEl.value);
        fd.append('hero_overlay_color', document.getElementById('f-hero-color').value);
        fd.append('hero_overlay_opacity', document.getElementById('f-hero-opacity').value);
        fd.append('hero_title', document.getElementById('f-hero-title').value);
        fd.append('hero_subtitle', document.getElementById('f-hero-subtitle').value);
        const aboutVideoUrlEl = document.getElementById('f-about-video-url');
        if (aboutVideoUrlEl) fd.append('about_section_video_url', aboutVideoUrlEl.value);

        const logo = document.getElementById('f-logo').files[0];
        const hero = document.getElementById('f-hero').files[0];
        const struktur = document.getElementById('f-struktur-gambar').files[0];
        const aboutMedia = document.getElementById('f-about-media').files[0];

        if (logo) fd.append('logo', logo);
        if (hero) fd.append('hero_image', hero);
        if (struktur) fd.append('struktur_organisasi_gambar', struktur);
        if (aboutMedia) fd.append('about_section_media', aboutMedia);

        // Hero slider images 2–5
        [2, 3, 4, 5].forEach(n => {
            const sliderInput = document.getElementById('f-hero-' + n);
            if (sliderInput && sliderInput.files[0]) fd.append('hero_image_' + n, sliderInput.files[0]);
        });

        await ajaxSubmit('<?= base_url('panel-admin/profil/save') ?>', fd, () => {
            setTimeout(() => location.reload(), 800);
        });
    }
</script>
