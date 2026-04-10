<?php
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_create = in_array('ekskul.create', $permission_codes, true);
$can_edit = in_array('ekskul.edit', $permission_codes, true);
$can_delete = in_array('ekskul.delete', $permission_codes, true);
?>
<!-- Header action -->
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-gray-500 text-sm"><?= count($ekskul) ?> ekstrakurikuler</p>
    <?php if ($can_create): ?>
        <button onclick="openAdd()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-hijau-700 transition-colors shadow-sm">
            <i data-feather="plus" class="w-4 h-4"></i>
            Tambah Ekskul
        </button>
    <?php endif; ?>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="text-left px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ekstrakurikuler</th>
                    <th class="text-left px-4 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Jadwal</th>
                    <th class="text-left px-4 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Pembina</th>
                    <th class="text-right px-6 py-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php if (!empty($ekskul)): foreach ($ekskul as $e): ?>
                        <tr class="hover:bg-gray-50 transition-colors" id="row-<?= $e->id ?>">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-hijau-50 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <i data-feather="<?= $e->ikon ?: 'star' ?>" class="w-5 h-5 text-hijau-600"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-sm text-gray-800"><?= $e->nama ?></div>
                                        <div class="text-xs text-gray-400 mt-0.5 line-clamp-1"><?= $e->deskripsi ?></div>
                                        <?php if (!empty($e->detail_lengkap)): ?>
                                            <div class="text-[10px] text-hijau-600 mt-1 font-semibold">Detail tersedia</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 hidden md:table-cell text-sm text-gray-500"><?= $e->jadwal ?: '-' ?></td>
                            <td class="px-4 py-4 hidden lg:table-cell text-sm text-gray-500"><?= $e->pembina ?: '-' ?></td>
                            <td class="px-6 py-4">
                                <?php if ($can_edit || $can_delete): ?>
                                    <div class="flex items-center justify-end gap-2">
                                        <?php if ($can_edit): ?>
                                            <button onclick="openEdit(<?= htmlspecialchars(json_encode($e)) ?>)" class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center transition-colors">
                                                <i data-feather="edit-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($can_delete): ?>
                                            <button onclick="hapus(<?= $e->id ?>, '<?= addslashes($e->nama) ?>')" class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg flex items-center justify-center transition-colors">
                                                <i data-feather="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="text-right text-xs text-gray-300">-</div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach;
                else: ?>
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center text-gray-400">Belum ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL -->
<?php if ($can_create || $can_edit): ?>
    <div id="modal-form" data-modal class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 sticky top-0 bg-white rounded-t-2xl">
                <h3 id="modal-title" class="font-display font-bold text-gray-900 text-lg">Tambah Ekskul</h3>
                <button onclick="closeModal('modal-form')" class="text-gray-400 hover:text-gray-600 w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center">
                    <i data-feather="x" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <input type="hidden" id="f-id">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Ekskul <span class="text-red-500">*</span></label>
                    <input type="text" id="f-nama" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" placeholder="Tahfidz Al-Quran...">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea id="f-deskripsi" rows="3" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-none" placeholder="Deskripsi singkat..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Detail Lengkap</label>
                    <textarea id="f-detail-lengkap" rows="5" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-y" placeholder="Deskripsi panjang untuk halaman detail ekskul..."></textarea>
                    <p class="text-[11px] text-gray-400 mt-1">Konten ini akan tampil di halaman detail ekskul ketika kartu diklik.</p>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Ikon (Feather)</label>
                        <input type="text" id="f-ikon" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" placeholder="book-open">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                        <input type="number" id="f-urutan" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" placeholder="0">
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Jadwal</label>
                        <input type="text" id="f-jadwal" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" placeholder="Sabtu, 14.00-17.00">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Pembina</label>
                        <input type="text" id="f-pembina" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" placeholder="Nama pembina...">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar (Opsional)</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-hijau-400 transition-colors cursor-pointer relative">
                        <input type="file" id="f-gambar" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this,'img-preview')">
                        <img id="img-preview" src="" class="hidden w-full h-32 object-cover rounded-lg mb-2">
                        <i data-feather="upload" class="w-5 h-5 text-gray-400 mx-auto mb-1"></i>
                        <p class="text-xs text-gray-400">Upload gambar ekskul (opsional)</p>
                    </div>
                </div>
            </div>
            <div class="sticky bottom-0 flex flex-col-reverse gap-3 rounded-b-2xl border-t border-gray-100 bg-white px-6 py-4 sm:flex-row sm:justify-end">
                <button onclick="closeModal('modal-form')" class="px-5 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50">Batal</button>
                <button onclick="simpan()" class="px-6 py-2.5 bg-hijau-800 text-white rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm flex items-center gap-2">
                    <i data-feather="save" class="w-4 h-4"></i> Simpan
                </button>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    const canCreateEkskul = <?= $can_create ? 'true' : 'false' ?>;
    const canEditEkskul = <?= $can_edit ? 'true' : 'false' ?>;
    const canDeleteEkskul = <?= $can_delete ? 'true' : 'false' ?>;

    function openAdd() {
        if (!canCreateEkskul) {
            showToast('Anda tidak punya izin tambah ekskul.', 'error');
            return;
        }
        document.getElementById('modal-title').textContent = 'Tambah Ekskul';
        ['id', 'nama', 'deskripsi', 'detail-lengkap', 'ikon', 'jadwal', 'pembina'].forEach(k => {
            const el = document.getElementById('f-' + k);
            if (el) el.value = '';
        });
        document.getElementById('f-urutan').value = '0';
        document.getElementById('f-gambar').value = '';
        document.getElementById('img-preview').classList.add('hidden');
        openModal('modal-form');
        feather.replace();
    }

    function openEdit(data) {
        if (!canEditEkskul) {
            showToast('Anda tidak punya izin edit ekskul.', 'error');
            return;
        }
        document.getElementById('modal-title').textContent = 'Edit Ekskul';
        document.getElementById('f-id').value = data.id;
        document.getElementById('f-nama').value = data.nama;
        document.getElementById('f-deskripsi').value = data.deskripsi || '';
        document.getElementById('f-detail-lengkap').value = data.detail_lengkap || '';
        document.getElementById('f-ikon').value = data.ikon || '';
        document.getElementById('f-urutan').value = data.urutan;
        document.getElementById('f-jadwal').value = data.jadwal || '';
        document.getElementById('f-pembina').value = data.pembina || '';
        document.getElementById('f-gambar').value = '';
        if (data.gambar) {
            const img = document.getElementById('img-preview');
            img.src = '<?= base_url('assets/images/uploads/ekskul/') ?>' + data.gambar;
            img.classList.remove('hidden');
        } else {
            document.getElementById('img-preview').classList.add('hidden');
        }
        openModal('modal-form');
        feather.replace();
    }
    async function simpan() {
        const id = document.getElementById('f-id').value;
        if (id && !canEditEkskul) {
            showToast('Anda tidak punya izin edit ekskul.', 'error');
            return;
        }
        if (!id && !canCreateEkskul) {
            showToast('Anda tidak punya izin tambah ekskul.', 'error');
            return;
        }
        const nama = document.getElementById('f-nama').value.trim();
        if (!nama) {
            showToast('Nama ekskul wajib diisi', 'error');
            return;
        }
        const fd = new FormData();
        fd.append('id', document.getElementById('f-id').value);
        fd.append('nama', nama);
        fd.append('deskripsi', document.getElementById('f-deskripsi').value);
        fd.append('detail_lengkap', document.getElementById('f-detail-lengkap').value);
        fd.append('ikon', document.getElementById('f-ikon').value || 'star');
        fd.append('urutan', document.getElementById('f-urutan').value || 0);
        fd.append('jadwal', document.getElementById('f-jadwal').value);
        fd.append('pembina', document.getElementById('f-pembina').value);
        fd.append('status', 1);
        const gambar = document.getElementById('f-gambar').files[0];
        if (gambar) fd.append('gambar', gambar);
        const url = id ? '<?= base_url('panel-admin/ekskul/update/') ?>' + id : '<?= base_url('panel-admin/ekskul/store') ?>';
        await ajaxSubmit(url, fd, () => {
            closeModal('modal-form');
            setTimeout(() => location.reload(), 500);
        });
    }
    async function hapus(id, nama) {
        if (!canDeleteEkskul) {
            showToast('Anda tidak punya izin hapus ekskul.', 'error');
            return;
        }
        showConfirm(`Hapus ekskul "${nama}"?`, async () => {
            const fd = new FormData();
            fd.append('id', id);
            await ajaxSubmit('<?= base_url('panel-admin/ekskul/delete/') ?>' + id, fd, () => {
                document.getElementById('row-' + id)?.remove();
            });
        });
    }
</script>
