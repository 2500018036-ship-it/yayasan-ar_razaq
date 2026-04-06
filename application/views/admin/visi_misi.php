<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_create = in_array('visi_misi.create', $permission_codes, true);
$can_edit = in_array('visi_misi.edit', $permission_codes, true);
$can_delete = in_array('visi_misi.delete', $permission_codes, true);
?>

<div class="space-y-6">

    <!-- ============================================================ -->
    <!-- BACKGROUND SETTINGS (moved from profil) -->
    <!-- ============================================================ -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-hijau-100 rounded-lg flex items-center justify-center">
                    <i data-feather="image" class="w-5 h-5 text-hijau-700"></i>
                </div>
                <div>
                    <h2 class="font-display font-bold text-gray-900">Background Section Visi & Misi</h2>
                    <p class="text-sm text-gray-500">Atur gambar/video dan overlay section Visi & Misi di homepage</p>
                </div>
            </div>
        </div>
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Background Gambar</label>
                    <?php if (isset($profil) && $profil && !empty($profil->visimisi_bg_image)): ?>
                        <img src="<?= base_url('assets/images/uploads/profil/' . $profil->visimisi_bg_image) ?>" class="w-full h-20 object-cover mb-2 rounded-lg border border-gray-100">
                    <?php endif; ?>
                    <input type="file" id="f-vm-image" accept="image/*"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                    <p class="text-xs text-gray-400 mt-1">Digunakan sebagai background section Visi & Misi</p>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Background Video (MP4)</label>
                    <?php if (isset($profil) && $profil && !empty($profil->visimisi_bg_video)): ?>
                        <p class="text-xs text-hijau-700 bg-hijau-50 px-3 py-2 rounded-lg mb-2 inline-block"><?= $profil->visimisi_bg_video ?></p>
                    <?php endif; ?>
                    <input type="file" id="f-vm-video" accept="video/mp4,video/webm"
                        class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
                    <p class="text-xs text-gray-400 mt-1">Video prioritas di atas gambar. Max 50MB.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Warna Overlay</label>
                    <div class="flex items-center gap-3">
                        <input type="color" id="f-vm-color" value="<?= isset($profil) && $profil && !empty($profil->visimisi_overlay_color) ? $profil->visimisi_overlay_color : '#052e16' ?>"
                            class="w-12 h-12 rounded-xl border border-gray-200 cursor-pointer p-1">
                        <input type="text" id="f-vm-color-text" value="<?= isset($profil) && $profil && !empty($profil->visimisi_overlay_color) ? $profil->visimisi_overlay_color : '#052e16' ?>" placeholder="#052e16"
                            class="flex-1 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500"
                            oninput="document.getElementById('f-vm-color').value = this.value;">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Opacity Overlay: <span id="vm-opacity-value"><?= isset($profil) && $profil && isset($profil->visimisi_overlay_opacity) ? $profil->visimisi_overlay_opacity : '80' ?></span>%</label>
                    <input type="range" id="f-vm-opacity" min="0" max="100" value="<?= isset($profil) && $profil && isset($profil->visimisi_overlay_opacity) ? $profil->visimisi_overlay_opacity : '80' ?>"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-hijau-600 mt-3"
                        oninput="document.getElementById('vm-opacity-value').textContent = this.value;">
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>Transparan</span>
                        <span>Gelap</span>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($can_edit): ?>
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
                <button onclick="simpanBackground()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan Background
                </button>
            </div>
        <?php endif; ?>
    </div>

    <!-- ============================================================ -->
    <!-- DATA VISI MISI CRUD -->
    <!-- ============================================================ -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Data Visi & Misi</h2>
            <p class="text-sm text-gray-500">Kelola konten visi, misi, dan nilai-nilai yayasan</p>
        </div>
        <?php if ($can_create): ?>
            <button onclick="openAddModal()" class="btn btn-primary">
                <i data-feather="plus" class="w-4 h-4"></i>
                Tambah Data
            </button>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tipe</th>
                        <th>Judul</th>
                        <th>Konten</th>
                        <th>Ikon</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($visi_misi)): ?>
                        <?php foreach ($visi_misi as $item): ?>
                            <tr>
                                <td>
                                    <span class="badge <?= $item->tipe === 'visi' ? 'badge-yellow' : ($item->tipe === 'misi' ? 'badge-green' : 'badge-gray') ?>">
                                        <?= ucfirst($item->tipe) ?>
                                    </span>
                                </td>
                                <td class="font-semibold"><?= $item->judul ?></td>
                                <td class="text-gray-500 text-xs max-w-[200px] truncate"><?= $item->konten ?></td>
                                <td>
                                    <?php if ($item->ikon): ?>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded"><?= $item->ikon ?></span>
                                    <?php else: ?>
                                        <span class="text-gray-300">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center font-semibold text-gray-400"><?= $item->urutan ?></td>
                                <td>
                                    <span class="badge <?= $item->status ? 'badge-green' : 'badge-gray' ?>">
                                        <?= $item->status ? 'Aktif' : 'Nonaktif' ?>
                                    </span>
                                </td>
                                <td class="text-right">
                                    <?php if ($can_edit || $can_delete): ?>
                                        <div class="flex items-center justify-end gap-2">
                                            <?php if ($can_edit): ?>
                                                <button onclick="editItem(<?= $item->id ?>)" class="btn btn-ghost" style="padding:6px 10px;">
                                                    <i data-feather="edit-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            <?php endif; ?>
                                            <?php if ($can_delete): ?>
                                                <button onclick="confirmDelete('<?= base_url('panel-admin/visi-misi/delete/' . $item->id) ?>', '<?= htmlspecialchars($item->judul) ?>')" class="btn btn-danger" style="padding:6px 10px;">
                                                    <i data-feather="trash-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-gray-400 py-12">
                                <i data-feather="eye" class="w-10 h-10 mx-auto mb-3 text-gray-200"></i>
                                <p>Belum ada data visi & misi</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modal-vm" class="modal-overlay">
    <div class="modal-box">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 id="modal-title" class="font-bold text-gray-900">Tambah Data</h3>
            <button onclick="closeModal('modal-vm')" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-vm" class="p-6 space-y-5">
            <input type="hidden" id="edit-id" value="">

            <div>
                <label class="form-label">Tipe *</label>
                <select id="f-tipe" class="form-input form-select" required>
                    <option value="visi">Visi</option>
                    <option value="misi">Misi</option>
                    <option value="nilai">Nilai</option>
                </select>
            </div>

            <div>
                <label class="form-label">Judul *</label>
                <input type="text" id="f-judul" class="form-input" placeholder="Judul visi / misi / nilai" required>
            </div>

            <div>
                <label class="form-label">Konten *</label>
                <textarea id="f-konten" class="form-input" rows="4" placeholder="Deskripsi lengkap..." required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Ikon (Feather Icons)</label>
                    <input type="text" id="f-ikon" class="form-input" placeholder="eye / check-circle / star">
                    <p class="text-xs text-gray-400 mt-1">Lihat daftar: <a href="https://feathericons.com" target="_blank" class="text-hijau-600 underline">feathericons.com</a></p>
                </div>
                <div>
                    <label class="form-label">Urutan</label>
                    <input type="number" id="f-urutan" class="form-input" placeholder="1" value="1">
                </div>
            </div>

            <div>
                <label class="form-label">Status</label>
                <select id="f-status" class="form-input form-select">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="closeModal('modal-vm')" class="btn btn-ghost">Batal</button>
                <?php if ($can_create || $can_edit): ?>
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="save" class="w-4 h-4"></i>
                        Simpan
                    </button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<script>
    // ============================================================
    // BACKGROUND SAVE
    // ============================================================
    async function simpanBackground() {
        const fd = new FormData();
        fd.append('visimisi_overlay_color', document.getElementById('f-vm-color').value);
        fd.append('visimisi_overlay_opacity', document.getElementById('f-vm-opacity').value);
        const vmImage = document.getElementById('f-vm-image').files[0];
        const vmVideo = document.getElementById('f-vm-video').files[0];
        if (vmImage) fd.append('visimisi_bg_image', vmImage);
        if (vmVideo) fd.append('visimisi_bg_video', vmVideo);
        await ajaxSubmit('<?= base_url('panel-admin/visi-misi/bg-save') ?>', fd, () => {
            setTimeout(() => location.reload(), 800);
        });
    }

    // ============================================================
    // CRUD
    // ============================================================
    function openAddModal() {
        document.getElementById('modal-title').textContent = 'Tambah Data';
        document.getElementById('edit-id').value = '';
        document.getElementById('form-vm').reset();
        openModal('modal-vm');
    }

    async function editItem(id) {
        const res = await fetch('<?= base_url('panel-admin/visi-misi/get/') ?>' + id);
        const json = await res.json();
        const d = json.data;
        document.getElementById('modal-title').textContent = 'Edit Data';
        document.getElementById('edit-id').value = id;
        document.getElementById('f-tipe').value = d.tipe || 'misi';
        document.getElementById('f-judul').value = d.judul || '';
        document.getElementById('f-konten').value = d.konten || '';
        document.getElementById('f-ikon').value = d.ikon || '';
        document.getElementById('f-urutan').value = d.urutan || 1;
        document.getElementById('f-status').value = d.status;
        openModal('modal-vm');
    }

    document.getElementById('form-vm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const id = document.getElementById('edit-id').value;
        const url = id
            ? '<?= base_url('panel-admin/visi-misi/update/') ?>' + id
            : '<?= base_url('panel-admin/visi-misi/store') ?>';

        const fd = new FormData();
        fd.append('tipe', document.getElementById('f-tipe').value);
        fd.append('judul', document.getElementById('f-judul').value);
        fd.append('konten', document.getElementById('f-konten').value);
        fd.append('ikon', document.getElementById('f-ikon').value);
        fd.append('urutan', document.getElementById('f-urutan').value);
        fd.append('status', document.getElementById('f-status').value);

        await ajaxSubmit(url, fd, () => {
            closeModal('modal-vm');
            setTimeout(() => location.reload(), 800);
        });
    });
</script>
