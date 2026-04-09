<?php
/** @var object|null $profil Data profil yayasan dari controller */
$p = isset($profil) ? $profil : null;
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_edit = in_array('profil.edit', $permission_codes, true);
?>
<div class="max-w-4xl space-y-6">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <h2 class="font-display font-bold text-gray-900">Struktur Organisasi</h2>
            <p class="text-sm text-gray-500 mt-1">Konten ini tampil di halaman frontend Struktur</p>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul Struktur</label>
                    <input type="text" id="f-struktur-judul" value="<?= $p ? $p->struktur_organisasi_judul : '' ?>" placeholder="Contoh: Struktur Organisasi Yayasan"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi Struktur</label>
                    <textarea id="f-struktur-deskripsi" rows="5" placeholder="Deskripsi singkat struktur organisasi..."
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-y"><?= $p ? $p->struktur_organisasi_deskripsi : '' ?></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Struktur Organisasi</label>
                    <?php if ($p && $p->struktur_organisasi_gambar): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $p->struktur_organisasi_gambar) ?>" class="w-full max-w-xl h-auto mb-3 rounded-lg border border-gray-100 object-cover">
                    <?php endif; ?>
                    <input type="file" id="f-struktur-gambar" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                </div>
            </div>
        </div>

        <?php if ($can_edit): ?>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
                <button onclick="simpanStruktur()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan Struktur
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
    const canEditProfilStruktur = <?= $can_edit ? 'true' : 'false' ?>;

    async function simpanStruktur() {
        if (!canEditProfilStruktur) {
            showToast('Anda tidak punya izin edit profil yayasan.', 'error');
            return;
        }

        const fd = new FormData();
        fd.append('struktur_organisasi_judul', document.getElementById('f-struktur-judul').value);
        fd.append('struktur_organisasi_deskripsi', document.getElementById('f-struktur-deskripsi').value);

        const struktur = document.getElementById('f-struktur-gambar').files[0];
        if (struktur) fd.append('struktur_organisasi_gambar', struktur);

        await ajaxSubmit('<?= base_url('panel-admin/profil/save') ?>', fd, () => {
            setTimeout(() => location.reload(), 700);
        });
    }
</script>
