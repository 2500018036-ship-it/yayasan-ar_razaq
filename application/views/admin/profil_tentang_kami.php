<?php
$p = $profil;
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_edit = in_array('profil.edit', $permission_codes, true);
?>
<div class="max-w-4xl space-y-6">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <h2 class="font-display font-bold text-gray-900">Tentang Kami</h2>
            <p class="text-sm text-gray-500 mt-1">Konten ini tampil di halaman frontend Tentang Kami</p>
        </div>
        <div class="p-6 space-y-6">
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
                    <textarea id="f-deskripsi-lengkap" rows="8" placeholder="Deskripsi utama yayasan..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-y"><?= $p ? $p->deskripsi_lengkap : '' ?></textarea>
                </div>
            </div>

            <hr class="border-gray-100">

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

            <h3 class="font-semibold text-gray-800 text-sm">Logo & Hero Image</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Logo Yayasan</label>
                    <?php if ($p && $p->logo): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $p->logo) ?>" class="w-16 h-16 object-contain mb-2 rounded-lg border border-gray-100">
                    <?php endif; ?>
                    <input type="file" id="f-logo" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Hero Image (Background)</label>
                    <?php if ($p && $p->hero_image): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $p->hero_image) ?>" class="w-full h-20 object-cover mb-2 rounded-lg border border-gray-100">
                    <?php endif; ?>
                    <input type="file" id="f-hero" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                </div>
            </div>
        </div>

        <?php if ($can_edit): ?>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
                <button onclick="simpanTentangKami()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan Tentang Kami
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    const canEditProfilTentang = <?= $can_edit ? 'true' : 'false' ?>;

    async function simpanTentangKami() {
        if (!canEditProfilTentang) {
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
        fd.append('alamat', document.getElementById('f-alamat').value);
        fd.append('telepon', document.getElementById('f-telepon').value);
        fd.append('email', document.getElementById('f-email').value);
        fd.append('website', document.getElementById('f-website').value);
        fd.append('facebook', document.getElementById('f-facebook').value);
        fd.append('instagram', document.getElementById('f-instagram').value);
        fd.append('youtube', document.getElementById('f-youtube').value);
        fd.append('whatsapp', document.getElementById('f-whatsapp').value);

        const logo = document.getElementById('f-logo').files[0];
        const hero = document.getElementById('f-hero').files[0];
        if (logo) fd.append('logo', logo);
        if (hero) fd.append('hero_image', hero);

        await ajaxSubmit('<?= base_url('panel-admin/profil/save') ?>', fd, () => {
            setTimeout(() => location.reload(), 700);
        });
    }
</script>
