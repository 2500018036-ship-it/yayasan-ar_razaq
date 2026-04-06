<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_create = in_array('statistik.create', $permission_codes, true);
$can_edit = in_array('statistik.edit', $permission_codes, true);
$can_delete = in_array('statistik.delete', $permission_codes, true);
?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Data Statistik</h2>
            <p class="text-sm text-gray-500">Statistik yang ditampilkan di halaman utama (tahun berdiri, jumlah alumni, dll)</p>
        </div>
        <?php if ($can_create): ?>
            <button onclick="openAddModal()" class="btn btn-primary">
                <i data-feather="plus" class="w-4 h-4"></i>
                Tambah Statistik
            </button>
        <?php endif; ?>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Label</th>
                        <th>Nilai</th>
                        <th>Satuan</th>
                        <th>Ikon</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($statistik)): ?>
                        <?php foreach ($statistik as $item): ?>
                            <tr>
                                <td class="text-center font-semibold text-gray-400"><?= $item->urutan ?></td>
                                <td class="font-semibold"><?= $item->label ?></td>
                                <td class="font-bold text-hijau-800"><?= $item->nilai ?></td>
                                <td class="text-gray-500"><?= $item->satuan ?: '-' ?></td>
                                <td>
                                    <?php if ($item->ikon): ?>
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded"><?= $item->ikon ?></span>
                                    <?php else: ?>
                                        <span class="text-gray-300">—</span>
                                    <?php endif; ?>
                                </td>
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
                                                <button onclick="confirmDelete('<?= base_url('panel-admin/statistik/delete/' . $item->id) ?>', '<?= htmlspecialchars($item->label) ?>')" class="btn btn-danger" style="padding:6px 10px;">
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
                            <td colspan="7" class="text-center text-gray-400 py-12">
                                <i data-feather="bar-chart-2" class="w-10 h-10 mx-auto mb-3 text-gray-200"></i>
                                <p>Belum ada data statistik</p>
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
    <div id="modal-statistik" class="modal-overlay">
        <div class="modal-box">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 id="modal-title" class="font-bold text-gray-900">Tambah Statistik</h3>
                <button onclick="closeModal('modal-statistik')" class="text-gray-400 hover:text-gray-600">
                    <i data-feather="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="form-statistik" class="p-6 space-y-5">
            <input type="hidden" id="edit-id" value="">

            <div>
                <label class="form-label">Label *</label>
                <input type="text" id="f-label" class="form-input" placeholder="Jumlah Alumni" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Nilai *</label>
                    <input type="text" id="f-nilai" class="form-input" placeholder="1500" required>
                    <p class="text-xs text-gray-400 mt-1">Bisa berupa angka atau teks (mis: 2005)</p>
                </div>
                <div>
                    <label class="form-label">Satuan</label>
                    <input type="text" id="f-satuan" class="form-input" placeholder="Orang / Tahun / +">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Ikon (Feather Icons)</label>
                    <input type="text" id="f-ikon" class="form-input" placeholder="users / award / calendar">
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
                    <button type="button" onclick="closeModal('modal-statistik')" class="btn btn-ghost">Batal</button>
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
    const canCreateStatistik = <?= $can_create ? 'true' : 'false' ?>;
    const canEditStatistik = <?= $can_edit ? 'true' : 'false' ?>;

    function openAddModal() {
        if (!canCreateStatistik) {
            showToast('Anda tidak punya izin tambah statistik.', 'error');
            return;
        }
        document.getElementById('modal-title').textContent = 'Tambah Statistik';
        document.getElementById('edit-id').value = '';
        document.getElementById('form-statistik').reset();
        openModal('modal-statistik');
    }

    async function editItem(id) {
        if (!canEditStatistik) {
            showToast('Anda tidak punya izin edit statistik.', 'error');
            return;
        }
        const res = await fetch('<?= base_url('panel-admin/statistik/get/') ?>' + id);
        const json = await res.json();
        const d = json.data;
        document.getElementById('modal-title').textContent = 'Edit Statistik';
        document.getElementById('edit-id').value = id;
        document.getElementById('f-label').value = d.label || '';
        document.getElementById('f-nilai').value = d.nilai || '';
        document.getElementById('f-satuan').value = d.satuan || '';
        document.getElementById('f-ikon').value = d.ikon || '';
        document.getElementById('f-urutan').value = d.urutan || 1;
        document.getElementById('f-status').value = d.status;
        openModal('modal-statistik');
    }

    const formStatistik = document.getElementById('form-statistik');
    if (formStatistik) {
        formStatistik.addEventListener('submit', async function(e) {
            e.preventDefault();
            const id = document.getElementById('edit-id').value;
            if (id && !canEditStatistik) {
                showToast('Anda tidak punya izin edit statistik.', 'error');
                return;
            }
            if (!id && !canCreateStatistik) {
                showToast('Anda tidak punya izin tambah statistik.', 'error');
                return;
            }
            const url = id
                ? '<?= base_url('panel-admin/statistik/update/') ?>' + id
                : '<?= base_url('panel-admin/statistik/store') ?>';

            const fd = new FormData();
            fd.append('label', document.getElementById('f-label').value);
            fd.append('nilai', document.getElementById('f-nilai').value);
            fd.append('satuan', document.getElementById('f-satuan').value);
            fd.append('ikon', document.getElementById('f-ikon').value);
            fd.append('urutan', document.getElementById('f-urutan').value);
            fd.append('status', document.getElementById('f-status').value);

            await ajaxSubmit(url, fd, () => {
                closeModal('modal-statistik');
                setTimeout(() => location.reload(), 800);
            });
        });
    }
</script>
