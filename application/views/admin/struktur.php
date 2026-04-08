<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_create = in_array('struktur.create', $permission_codes, true);
$can_edit = in_array('struktur.edit', $permission_codes, true);
$can_delete = in_array('struktur.delete', $permission_codes, true);
$p = isset($profil) ? $profil : null;
$anggota = isset($anggota) && is_array($anggota) ? $anggota : [];
?>

<div class="space-y-6">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between gap-4">
            <div>
                <h2 class="font-display font-bold text-gray-900">Bagan Struktur Organisasi</h2>
                <p class="text-sm text-gray-500 mt-1">Bagian ini tampil di paling atas halaman Struktur frontend.</p>
            </div>
            <?php if ($can_edit): ?>
                <button onclick="simpanBaganStruktur()" class="btn btn-primary">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan Bagan
                </button>
            <?php endif; ?>
        </div>

        <div class="p-6 grid grid-cols-1 lg:grid-cols-3 gap-5">
            <div class="lg:col-span-2 space-y-4">
                <div>
                    <label class="form-label">Judul Struktur</label>
                    <input id="bagan-judul" type="text" class="form-input" placeholder="Contoh: Struktur Susunan Organisasi Yayasan" value="<?= $p ? htmlspecialchars((string) $p->struktur_organisasi_judul, ENT_QUOTES, 'UTF-8') : '' ?>">
                </div>
                <div>
                    <label class="form-label">Deskripsi Struktur</label>
                    <textarea id="bagan-deskripsi" rows="4" class="form-input" placeholder="Deskripsi singkat struktur organisasi..."><?= $p ? htmlspecialchars((string) $p->struktur_organisasi_deskripsi, ENT_QUOTES, 'UTF-8') : '' ?></textarea>
                </div>
                <div>
                    <label class="form-label">Upload / Ganti Gambar Bagan</label>
                    <div id="bagan-dropzone" class="upload-area">
                        <i data-feather="upload-cloud" class="w-7 h-7 text-hijau-500 mx-auto mb-2"></i>
                        <p class="text-sm font-semibold text-gray-700">Drop gambar bagan di sini</p>
                        <p class="text-xs text-gray-500 mt-1">atau klik untuk pilih file (JPG, PNG, WEBP, maks 5MB)</p>
                    </div>
                    <input type="file" id="bagan-gambar" accept="image/*" class="hidden" onchange="previewBagan(this)">
                    <div id="bagan-filename" class="text-xs text-gray-500 mt-2"></div>
                </div>
            </div>

            <div>
                <label class="form-label">Preview Bagan Saat Ini</label>
                <div id="bagan-preview-wrap" class="rounded-2xl border border-gray-100 bg-gray-50 p-3 min-h-[220px] flex items-center justify-center">
                    <?php if ($p && !empty($p->struktur_organisasi_gambar)): ?>
                        <img id="bagan-preview" src="<?= base_url('assets/images/uploads/profil/' . $p->struktur_organisasi_gambar) ?>" class="w-full h-auto rounded-xl border border-gray-200 object-contain" alt="Bagan Struktur">
                    <?php else: ?>
                        <div id="bagan-preview" class="text-xs text-gray-400 text-center">Belum ada gambar bagan</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex items-center justify-between gap-4">
            <div>
                <h2 class="font-display font-bold text-gray-900">Anggota Struktur Organisasi</h2>
                <p class="text-sm text-gray-500 mt-1">Urutan terkecil = jabatan tertinggi (ditampilkan paling awal di frontend).</p>
            </div>
            <?php if ($can_create): ?>
                <button onclick="openModal('modal-anggota-tambah')" class="btn btn-primary">
                    <i data-feather="plus" class="w-4 h-4"></i>
                    Tambah Anggota
                </button>
            <?php endif; ?>
        </div>

        <?php if (!empty($anggota)): ?>
            <div class="overflow-x-auto">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Urutan</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($anggota as $row): ?>
                            <tr>
                                <td><span class="badge badge-gray"><?= (int) $row->urutan ?></span></td>
                                <td>
                                    <?php if (!empty($row->foto)): ?>
                                        <img src="<?= base_url('assets/images/uploads/struktur/' . $row->foto) ?>" class="w-12 h-12 rounded-lg object-cover border border-gray-200" alt="<?= htmlspecialchars($row->nama, ENT_QUOTES, 'UTF-8') ?>">
                                    <?php else: ?>
                                        <div class="w-12 h-12 rounded-lg border border-gray-200 bg-gray-50 flex items-center justify-center text-gray-300">
                                            <i data-feather="user" class="w-4 h-4"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="font-semibold text-gray-800"><?= htmlspecialchars($row->nama, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($row->jabatan, ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <?php if ((int) $row->status === 1): ?>
                                        <span class="badge badge-green">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-gray">Hidden</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <?php if ($can_edit): ?>
                                            <button type="button" onclick='editAnggota(<?= json_encode($row) ?>)' class="btn btn-ghost" style="padding:7px 10px;">
                                                <i data-feather="edit-2" class="w-4 h-4"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($can_delete): ?>
                                            <button type="button" onclick="confirmDelete('<?= base_url('panel-admin/struktur/anggota/delete/' . (int) $row->id) ?>','<?= addslashes($row->nama) ?>')" class="btn btn-danger" style="padding:7px 10px;">
                                                <i data-feather="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="px-6 py-16 text-center text-gray-400">
                <i data-feather="users" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                <p class="font-medium text-sm">Belum ada anggota struktur.</p>
                <p class="text-xs mt-1">Tambahkan anggota agar tampil di halaman Struktur frontend.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if ($can_create): ?>
<div id="modal-anggota-tambah" class="modal-overlay">
    <div class="modal-box">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Tambah Anggota Struktur</h3>
            <button onclick="closeModal('modal-anggota-tambah')" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-anggota-tambah" enctype="multipart/form-data">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="form-label">Foto</label>
                    <div class="upload-area" onclick="document.getElementById('tambah-foto').click()">
                        <i data-feather="image" class="w-6 h-6 text-hijau-400 mx-auto mb-2"></i>
                        <p class="text-xs text-gray-500">Klik untuk pilih foto</p>
                    </div>
                    <input id="tambah-foto" name="foto" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'tambah-preview')">
                    <div id="tambah-preview" class="mt-2 text-center"></div>
                </div>
                <div>
                    <label class="form-label">Nama *</label>
                    <input name="nama" type="text" class="form-input" placeholder="Nama lengkap" required>
                </div>
                <div>
                    <label class="form-label">Jabatan *</label>
                    <input name="jabatan" type="text" class="form-input" placeholder="Contoh: Ketua Yayasan" required>
                </div>
                <div>
                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea name="deskripsi_lengkap" rows="5" class="form-input" placeholder="Profil lengkap anggota..."></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Urutan</label>
                        <input name="urutan" type="number" min="1" value="1" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Status</label>
                        <select name="status" class="form-input form-select">
                            <option value="1">Aktif</option>
                            <option value="0">Sembunyikan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-anggota-tambah')">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitTambahAnggota()">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php if ($can_edit): ?>
<div id="modal-anggota-edit" class="modal-overlay">
    <div class="modal-box">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Edit Anggota Struktur</h3>
            <button onclick="closeModal('modal-anggota-edit')" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-anggota-edit" enctype="multipart/form-data">
            <input id="edit-id" type="hidden">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="form-label">Foto Saat Ini</label>
                    <div id="edit-current-photo" class="text-center text-xs text-gray-400">Belum ada foto</div>
                </div>
                <div>
                    <label class="form-label">Ganti Foto</label>
                    <div class="upload-area" onclick="document.getElementById('edit-foto').click()">
                        <i data-feather="refresh-cw" class="w-6 h-6 text-hijau-400 mx-auto mb-2"></i>
                        <p class="text-xs text-gray-500">Klik untuk ganti foto</p>
                    </div>
                    <input id="edit-foto" name="foto" type="file" class="hidden" accept="image/*" onchange="previewImage(this, 'edit-preview')">
                    <div id="edit-preview" class="mt-2 text-center"></div>
                </div>
                <div>
                    <label class="form-label">Nama *</label>
                    <input id="edit-nama" name="nama" type="text" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Jabatan *</label>
                    <input id="edit-jabatan" name="jabatan" type="text" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea id="edit-deskripsi" name="deskripsi_lengkap" rows="5" class="form-input"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Urutan</label>
                        <input id="edit-urutan" name="urutan" type="number" min="1" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">Status</label>
                        <select id="edit-status" name="status" class="form-input form-select">
                            <option value="1">Aktif</option>
                            <option value="0">Sembunyikan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-anggota-edit')">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitEditAnggota()">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<script>
    const canCreateAnggota = <?= $can_create ? 'true' : 'false' ?>;
    const canEditAnggota = <?= $can_edit ? 'true' : 'false' ?>;

    (function bindBaganDropzone() {
        const dropzone = document.getElementById('bagan-dropzone');
        const input = document.getElementById('bagan-gambar');
        if (!dropzone || !input) return;

        dropzone.addEventListener('click', () => input.click());
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-hijau-500', 'bg-hijau-50');
        });
        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-hijau-500', 'bg-hijau-50');
        });
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-hijau-500', 'bg-hijau-50');
            if (!e.dataTransfer || !e.dataTransfer.files || !e.dataTransfer.files.length) return;
            const dt = new DataTransfer();
            dt.items.add(e.dataTransfer.files[0]);
            input.files = dt.files;
            previewBagan(input);
        });
    })();

    function previewBagan(input) {
        if (!input.files || !input.files[0]) return;
        const filename = document.getElementById('bagan-filename');
        if (filename) filename.textContent = 'File dipilih: ' + input.files[0].name;

        const previewWrap = document.getElementById('bagan-preview-wrap');
        const reader = new FileReader();
        reader.onload = (e) => {
            previewWrap.innerHTML = `<img src="${e.target.result}" class="w-full h-auto rounded-xl border border-gray-200 object-contain" alt="Preview Bagan">`;
        };
        reader.readAsDataURL(input.files[0]);
    }

    async function simpanBaganStruktur() {
        const fd = new FormData();
        fd.append('struktur_organisasi_judul', document.getElementById('bagan-judul').value);
        fd.append('struktur_organisasi_deskripsi', document.getElementById('bagan-deskripsi').value);
        const gambar = document.getElementById('bagan-gambar').files[0];
        if (gambar) fd.append('struktur_organisasi_gambar', gambar);

        await ajaxSubmit('<?= base_url('panel-admin/struktur/bagan/save') ?>', fd, () => {
            setTimeout(() => location.reload(), 700);
        });
    }

    async function submitTambahAnggota() {
        if (!canCreateAnggota) {
            showToast('Anda tidak punya izin tambah anggota.', 'error');
            return;
        }

        const fd = new FormData(document.getElementById('form-anggota-tambah'));
        await ajaxSubmit('<?= base_url('panel-admin/struktur/anggota/store') ?>', fd, () => {
            closeModal('modal-anggota-tambah');
            setTimeout(() => location.reload(), 700);
        });
    }

    function editAnggota(row) {
        if (!canEditAnggota) {
            showToast('Anda tidak punya izin edit anggota.', 'error');
            return;
        }

        document.getElementById('edit-id').value = row.id;
        document.getElementById('edit-nama').value = row.nama || '';
        document.getElementById('edit-jabatan').value = row.jabatan || '';
        document.getElementById('edit-deskripsi').value = row.deskripsi_lengkap || '';
        document.getElementById('edit-urutan').value = row.urutan || 1;
        document.getElementById('edit-status').value = row.status || 1;

        const current = document.getElementById('edit-current-photo');
        if (row.foto) {
            current.innerHTML = `<img src="<?= base_url('assets/images/uploads/struktur/') ?>${row.foto}" class="w-24 h-24 rounded-xl object-cover border border-gray-200 mx-auto">`;
        } else {
            current.innerHTML = '<div class="text-xs text-gray-400">Belum ada foto</div>';
        }

        document.getElementById('edit-preview').innerHTML = '';
        openModal('modal-anggota-edit');
        feather.replace();
    }

    async function submitEditAnggota() {
        if (!canEditAnggota) {
            showToast('Anda tidak punya izin edit anggota.', 'error');
            return;
        }

        const id = document.getElementById('edit-id').value;
        if (!id) {
            showToast('ID anggota tidak valid.', 'error');
            return;
        }

        const fd = new FormData(document.getElementById('form-anggota-edit'));
        await ajaxSubmit('<?= base_url('panel-admin/struktur/anggota/update/') ?>' + id, fd, () => {
            closeModal('modal-anggota-edit');
            setTimeout(() => location.reload(), 700);
        });
    }
</script>
