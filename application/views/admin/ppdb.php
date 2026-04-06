<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_create = in_array('ppdb.create', $permission_codes, true);
$can_edit = in_array('ppdb.edit', $permission_codes, true);
$can_delete = in_array('ppdb.delete', $permission_codes, true);
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Data PPDB</h2>
            <p class="text-sm text-gray-500">Kelola data penerimaan santri baru</p>
        </div>
        <?php if ($can_create): ?>
            <button onclick="openAddModal()" class="btn btn-primary">
                <i data-feather="plus" class="w-4 h-4"></i>
                Tambah PPDB
            </button>
        <?php endif; ?>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tahun Ajaran</th>
                        <th>Judul</th>
                        <th>Periode</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($ppdb)): ?>
                        <?php foreach ($ppdb as $item): ?>
                            <tr>
                                <td class="font-semibold"><?= $item->tahun_ajaran ?></td>
                                <td><?= $item->judul ?></td>
                                <td class="text-xs text-gray-500">
                                    <?= $item->tanggal_buka ? date('d/m/Y', strtotime($item->tanggal_buka)) : '-' ?> —
                                    <?= $item->tanggal_tutup ? date('d/m/Y', strtotime($item->tanggal_tutup)) : '-' ?>
                                </td>
                                <td><?= $item->kuota ? number_format($item->kuota) : '-' ?></td>
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
                                                <button onclick="confirmDelete('<?= base_url('panel-admin/ppdb/delete/' . $item->id) ?>', '<?= htmlspecialchars($item->judul) ?>')" class="btn btn-danger" style="padding:6px 10px;">
                                                    <i data-feather="trash-2" class="w-3.5 h-3.5"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-xs text-gray-300">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-gray-400 py-12">
                                <i data-feather="user-plus" class="w-10 h-10 mx-auto mb-3 text-gray-200"></i>
                                <p>Belum ada data PPDB</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<?php if ($can_create || $can_edit): ?>
    <div id="modal-ppdb" class="modal-overlay">
        <div class="modal-box">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 id="modal-title" class="font-bold text-gray-900">Tambah PPDB</h3>
                <button onclick="closeModal('modal-ppdb')" class="text-gray-400 hover:text-gray-600">
                    <i data-feather="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="form-ppdb" class="p-6 space-y-5">
            <input type="hidden" id="edit-id" value="">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Tahun Ajaran *</label>
                    <input type="text" id="f-tahun-ajaran" class="form-input" placeholder="2025/2026" required>
                </div>
                <div>
                    <label class="form-label">Judul *</label>
                    <input type="text" id="f-judul" class="form-input" placeholder="Penerimaan Santri Baru" required>
                </div>
            </div>

            <div>
                <label class="form-label">Deskripsi</label>
                <textarea id="f-deskripsi" class="form-input" rows="3" placeholder="Deskripsi singkat PPDB..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Tanggal Buka</label>
                    <input type="date" id="f-tanggal-buka" class="form-input">
                </div>
                <div>
                    <label class="form-label">Tanggal Tutup</label>
                    <input type="date" id="f-tanggal-tutup" class="form-input">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Kuota</label>
                    <input type="number" id="f-kuota" class="form-input" placeholder="100">
                </div>
                <div>
                    <label class="form-label">Biaya Pendaftaran</label>
                    <input type="text" id="f-biaya" class="form-input" placeholder="250000">
                </div>
            </div>

            <div>
                <label class="form-label">Syarat Pendaftaran</label>
                <textarea id="f-syarat" class="form-input" rows="4" placeholder="Tuliskan per baris..."></textarea>
            </div>

            <div>
                <label class="form-label">Alur Pendaftaran</label>
                <textarea id="f-alur" class="form-input" rows="4" placeholder="Tuliskan per baris..."></textarea>
            </div>

            <div>
                <label class="form-label">Kontak Info</label>
                <textarea id="f-kontak" class="form-input" rows="2" placeholder="Informasi kontak pendaftaran..."></textarea>
            </div>

            <div>
                <label class="form-label">Link Pendaftaran Online</label>
                <input type="url" id="f-link" class="form-input" placeholder="https://...">
            </div>

            <div>
                <label class="form-label">URL Google Maps</label>
                <input type="url" id="f-maps-url" class="form-input" placeholder="https://maps.google.com/...">
                <p class="text-xs text-gray-400 mt-1">Masukkan URL Google Maps lokasi yayasan. Preview peta akan tampil di halaman PPDB.</p>
            </div>

            <div>
                <label class="form-label">Status</label>
                <select id="f-status" class="form-input form-select">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('modal-ppdb')" class="btn btn-ghost">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i data-feather="save" class="w-4 h-4"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<script>
    const canCreatePpdb = <?= $can_create ? 'true' : 'false' ?>;
    const canEditPpdb = <?= $can_edit ? 'true' : 'false' ?>;

    function openAddModal() {
        if (!canCreatePpdb) {
            showToast('Anda tidak punya izin tambah PPDB.', 'error');
            return;
        }
        document.getElementById('modal-title').textContent = 'Tambah PPDB';
        document.getElementById('edit-id').value = '';
        document.getElementById('form-ppdb').reset();
        openModal('modal-ppdb');
    }

    async function editItem(id) {
        if (!canEditPpdb) {
            showToast('Anda tidak punya izin edit PPDB.', 'error');
            return;
        }
        const res = await fetch('<?= base_url('panel-admin/ppdb/get/') ?>' + id);
        const json = await res.json();
        const d = json.data;
        document.getElementById('modal-title').textContent = 'Edit PPDB';
        document.getElementById('edit-id').value = id;
        document.getElementById('f-tahun-ajaran').value = d.tahun_ajaran || '';
        document.getElementById('f-judul').value = d.judul || '';
        document.getElementById('f-deskripsi').value = d.deskripsi || '';
        document.getElementById('f-tanggal-buka').value = d.tanggal_buka || '';
        document.getElementById('f-tanggal-tutup').value = d.tanggal_tutup || '';
        document.getElementById('f-kuota').value = d.kuota || '';
        document.getElementById('f-biaya').value = d.biaya_pendaftaran || '';
        document.getElementById('f-syarat').value = d.syarat || '';
        document.getElementById('f-alur').value = d.alur_pendaftaran || '';
        document.getElementById('f-kontak').value = d.kontak_info || '';
        document.getElementById('f-link').value = d.link_pendaftaran || '';
        document.getElementById('f-maps-url').value = d.maps_url || '';
        document.getElementById('f-status').value = d.status;
        openModal('modal-ppdb');
    }

    const formPpdb = document.getElementById('form-ppdb');
    if (formPpdb) {
        formPpdb.addEventListener('submit', async function(e) {
            e.preventDefault();
            const id = document.getElementById('edit-id').value;
            if (id && !canEditPpdb) {
                showToast('Anda tidak punya izin edit PPDB.', 'error');
                return;
            }
            if (!id && !canCreatePpdb) {
                showToast('Anda tidak punya izin tambah PPDB.', 'error');
                return;
            }
            const url = id
                ? '<?= base_url('panel-admin/ppdb/update/') ?>' + id
                : '<?= base_url('panel-admin/ppdb/store') ?>';

            const fd = new FormData();
            fd.append('tahun_ajaran', document.getElementById('f-tahun-ajaran').value);
            fd.append('judul', document.getElementById('f-judul').value);
            fd.append('deskripsi', document.getElementById('f-deskripsi').value);
            fd.append('tanggal_buka', document.getElementById('f-tanggal-buka').value);
            fd.append('tanggal_tutup', document.getElementById('f-tanggal-tutup').value);
            fd.append('kuota', document.getElementById('f-kuota').value);
            fd.append('biaya_pendaftaran', document.getElementById('f-biaya').value);
            fd.append('syarat', document.getElementById('f-syarat').value);
            fd.append('alur_pendaftaran', document.getElementById('f-alur').value);
            fd.append('kontak_info', document.getElementById('f-kontak').value);
            fd.append('link_pendaftaran', document.getElementById('f-link').value);
            fd.append('maps_url', document.getElementById('f-maps-url').value);
            fd.append('status', document.getElementById('f-status').value);

            await ajaxSubmit(url, fd, () => {
                closeModal('modal-ppdb');
                setTimeout(() => location.reload(), 800);
            });
        });
    }
</script>
