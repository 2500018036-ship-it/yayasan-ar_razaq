<?php
$p = $profil;
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_edit = in_array('profil.edit', $permission_codes, true);
?>
<div class="max-w-4xl space-y-6">
    <!-- ============================================================ -->
    <!-- PROFIL YAYASAN -->
    <!-- ============================================================ -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <h2 class="font-display font-bold text-gray-900">Informasi Profil Yayasan</h2>
            <p class="text-sm text-gray-500 mt-1">Perubahan akan langsung tampil di website</p>
        </div>
        <div class="p-6 space-y-6">
            <!-- Basic info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Yayasan <span class="text-red-500">*</span></label>
                    <input type="text" id="f-nama" value="<?= $p ? $p->nama_yayasan : '' ?>" placeholder="Nama yayasan..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tagline</label>
                    <input type="text" id="f-tagline" value="<?= $p ? $p->tagline : '' ?>" placeholder="Tagline singkat yayasan..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Lengkap</label>
                    <textarea id="f-deskripsi-lengkap" rows="6" placeholder="Deskripsi utama yayasan. Konten ini akan tampil sebagai ringkasan + deskripsi lengkap di section Sejarah/Profil website..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-y"><?= $p ? $p->deskripsi_lengkap : '' ?></textarea>
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Contact info -->
            <h3 class="font-semibold text-gray-800 text-sm">Informasi Kontak</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat</label>
                    <textarea id="f-alamat" rows="2" placeholder="Alamat lengkap yayasan..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-none"><?= $p ? $p->alamat : '' ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Telepon</label>
                    <input type="text" id="f-telepon" value="<?= $p ? $p->telepon : '' ?>" placeholder="(0411) 123456"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email" id="f-email" value="<?= $p ? $p->email : '' ?>" placeholder="info@yayasan.sch.id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Website</label>
                    <input type="url" id="f-website" value="<?= $p ? $p->website : '' ?>" placeholder="https://yayasan.sch.id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Social media -->
            <h3 class="font-semibold text-gray-800 text-sm">Media Sosial</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Facebook URL</label>
                    <input type="url" id="f-facebook" value="<?= $p ? $p->facebook : '' ?>" placeholder="https://facebook.com/..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Instagram URL</label>
                    <input type="url" id="f-instagram" value="<?= $p ? $p->instagram : '' ?>" placeholder="https://instagram.com/..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">YouTube URL</label>
                    <input type="url" id="f-youtube" value="<?= $p ? $p->youtube : '' ?>" placeholder="https://youtube.com/..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">WhatsApp (angka saja)</label>
                    <input type="text" id="f-whatsapp" value="<?= $p ? $p->whatsapp : '' ?>" placeholder="6281234567890"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Media uploads -->
            <h3 class="font-semibold text-gray-800 text-sm">Logo & Hero Image</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Logo Yayasan</label>
                    <?php if ($p && $p->logo): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $p->logo) ?>" class="w-16 h-16 object-contain mb-2 rounded-lg border border-gray-100">
                    <?php endif; ?>
                    <input type="file" id="f-logo" accept="image/*" onchange="previewImage(this,'img-logo')"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                    <img id="img-logo" src="" class="hidden w-16 h-16 object-contain mt-2 rounded-lg border border-gray-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Hero Image (Background)</label>
                    <?php if ($p && $p->hero_image): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $p->hero_image) ?>" class="w-full h-20 object-cover mb-2 rounded-lg border border-gray-100">
                    <?php endif; ?>
                    <input type="file" id="f-hero" accept="image/*" onchange="previewImage(this,'img-hero')"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                    <img id="img-hero" src="" class="hidden w-full h-20 object-cover mt-2 rounded-lg border border-gray-100">
                </div>
            </div>

            <hr class="border-gray-100">

            <!-- Struktur organisasi -->
            <h3 class="font-semibold text-gray-800 text-sm">Struktur Organisasi (Section Sejarah & Profil)</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Struktur</label>
                    <input type="text" id="f-struktur-judul" value="<?= $p ? $p->struktur_organisasi_judul : '' ?>" placeholder="Contoh: Struktur Organisasi Yayasan"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Struktur</label>
                    <textarea id="f-struktur-deskripsi" rows="4" placeholder="Deskripsi singkat struktur organisasi..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-y"><?= $p ? $p->struktur_organisasi_deskripsi : '' ?></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Struktur Organisasi</label>
                    <?php if ($p && $p->struktur_organisasi_gambar): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $p->struktur_organisasi_gambar) ?>" class="w-full max-w-xl h-auto mb-2 rounded-lg border border-gray-100 object-cover">
                    <?php endif; ?>
                    <input type="file" id="f-struktur-gambar" accept="image/*" onchange="previewImage(this,'img-struktur')"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                    <img id="img-struktur" src="" class="hidden w-full max-w-xl h-auto mt-2 rounded-lg border border-gray-100 object-cover">
                </div>
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
            <!-- Live Preview -->
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

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Hero <span class="text-xs text-gray-400 font-normal">(kosongkan = nama yayasan)</span></label>
                    <input type="text" id="f-hero-title" value="<?= $p ? $p->hero_title : '' ?>" placeholder="<?= $p ? $p->nama_yayasan : '' ?>"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500"
                        oninput="updateHeroPreview()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Subtitle Hero <span class="text-xs text-gray-400 font-normal">(kosongkan = tagline)</span></label>
                    <input type="text" id="f-hero-subtitle" value="<?= $p ? $p->hero_subtitle : '' ?>" placeholder="<?= $p ? $p->tagline : '' ?>"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500"
                        oninput="updateHeroPreview()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Warna Overlay</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="f-hero-color" value="<?= $p ? $p->hero_overlay_color : '#052e16' ?>"
                            class="w-12 h-12 rounded-xl border border-gray-200 cursor-pointer p-1"
                            onchange="updateHeroPreview()">
                        <input type="text" id="f-hero-color-text" value="<?= $p ? $p->hero_overlay_color : '#052e16' ?>" placeholder="#052e16"
                            class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500"
                            oninput="document.getElementById('f-hero-color').value = this.value; updateHeroPreview()">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Opacity Overlay: <span id="opacity-value"><?= $p ? $p->hero_overlay_opacity : '80' ?></span>%</label>
                    <input type="range" id="f-hero-opacity" min="0" max="100" value="<?= $p ? $p->hero_overlay_opacity : '80' ?>"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-hijau-600 mt-3"
                        oninput="document.getElementById('opacity-value').textContent = this.value; updateHeroPreview()">
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>Transparan</span>
                        <span>Gelap</span>
                    </div>
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
        // Hero section
        fd.append('hero_overlay_color', document.getElementById('f-hero-color').value);
        fd.append('hero_overlay_opacity', document.getElementById('f-hero-opacity').value);
        fd.append('hero_title', document.getElementById('f-hero-title').value);
        fd.append('hero_subtitle', document.getElementById('f-hero-subtitle').value);
        // Files
        const logo = document.getElementById('f-logo').files[0];
        const hero = document.getElementById('f-hero').files[0];
        const struktur = document.getElementById('f-struktur-gambar').files[0];
        if (logo) fd.append('logo', logo);
        if (hero) fd.append('hero_image', hero);
        if (struktur) fd.append('struktur_organisasi_gambar', struktur);
        await ajaxSubmit('<?= base_url('panel-admin/profil/save') ?>', fd, () => {
            setTimeout(() => location.reload(), 800);
        });
    }
</script>
