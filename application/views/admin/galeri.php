<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Page Header -->
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-xs text-gray-400">Kelola foto dan dokumentasi kegiatan</p>
    </div>
    <button onclick="openModal('modal-tambah')" class="btn btn-primary">
        <i data-feather="upload-cloud" class="w-4 h-4"></i>
        Upload Foto
    </button>
</div>

<!-- Filter -->
<div class="bg-white rounded-2xl border border-gray-100 mb-6 px-4 py-3 flex items-center gap-3">
    <i data-feather="filter" class="w-4 h-4 text-gray-300 flex-shrink-0"></i>
    <select id="filter-kategori" onchange="filterGaleri()" class="text-sm text-gray-600 bg-transparent outline-none cursor-pointer">
        <option value="">Semua Kategori</option>
        <option value="umum">Umum</option>
        <option value="kegiatan">Kegiatan</option>
        <option value="fasilitas">Fasilitas</option>
        <option value="prestasi">Prestasi</option>
    </select>
    <div class="ml-auto text-xs text-gray-400"><?= count($galeri) ?> foto</div>
</div>

<!-- Grid -->
<?php if (!empty($galeri)): ?>
    <div id="galeri-grid" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-6">
        <?php foreach ($galeri as $g): ?>
            <div class="galeri-card bg-white rounded-2xl border border-gray-100 overflow-hidden group" data-kategori="<?= $g->kategori ?>">
                <!-- Image -->
                <div class="aspect-square bg-gray-100 relative overflow-hidden">
                    <?php if ($g->gambar): ?>
                        <img src="<?= base_url('assets/images/uploads/galeri/' . $g->gambar) ?>"
                            alt="<?= $g->judul ?>"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <?php else: ?>
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <i data-feather="image" class="w-10 h-10"></i>
                        </div>
                    <?php endif; ?>
                    <!-- Overlay actions -->
                    <div class="absolute inset-0 bg-hijau-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center gap-2">
                        <button onclick='editGaleri(<?= json_encode($g) ?>)' class="w-9 h-9 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center text-white transition-colors backdrop-blur-sm">
                            <i data-feather="edit-2" class="w-4 h-4"></i>
                        </button>
                        <button onclick="confirmDelete('<?= base_url('panel-admin/galeri-delete/' . $g->id) ?>','<?= addslashes($g->judul) ?>')" class="w-9 h-9 bg-red-500/70 hover:bg-red-500 rounded-xl flex items-center justify-center text-white transition-colors">
                            <i data-feather="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
                <!-- Info -->
                <div class="p-3">
                    <div class="font-medium text-gray-800 text-xs truncate"><?= $g->judul ?></div>
                    <div class="flex items-center justify-between mt-1">
                        <span class="badge badge-yellow text-[10px] capitalize"><?= $g->kategori ?></span>
                        <?php if ($g->status): ?>
                            <span class="badge badge-green text-[10px]">Aktif</span>
                        <?php else: ?>
                            <span class="badge badge-gray text-[10px]">Hidden</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="bg-white rounded-2xl border border-gray-100 py-20 text-center text-gray-400">
        <i data-feather="image" class="w-12 h-12 mx-auto mb-3 opacity-20"></i>
        <p class="text-sm font-medium">Galeri masih kosong</p>
        <p class="text-xs mt-1">Klik "Upload Foto" untuk menambahkan foto.</p>
    </div>
<?php endif; ?>

<!-- ============================================================ -->
<!-- MODAL TAMBAH -->
<!-- ============================================================ -->
<div id="modal-tambah" class="modal-overlay">
    <div class="modal-box">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Upload Foto Galeri</h3>
            <button onclick="closeModal('modal-tambah')" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-tambah" enctype="multipart/form-data">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="form-label">Foto *</label>
                    <div class="upload-area" onclick="document.getElementById('tambah-gambar').click()">
                        <i data-feather="upload-cloud" class="w-8 h-8 text-hijau-400 mx-auto mb-2"></i>
                        <p class="text-sm font-medium text-gray-600">Klik untuk pilih foto</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP — Maks 5MB</p>
                    </div>
                    <input type="file" id="tambah-gambar" name="gambar" class="hidden" accept="image/*" required
                        onchange="previewImage(this,'preview-tambah')">
                    <div id="preview-tambah" class="mt-3 text-center"></div>
                </div>
                <div>
                    <label class="form-label">Judul Foto *</label>
                    <input type="text" name="judul" class="form-input" placeholder="Judul atau keterangan foto…" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-input form-select">
                            <option value="umum">Umum</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="fasilitas">Fasilitas</option>
                            <option value="prestasi">Prestasi</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" class="form-input" value="1" min="1">
                    </div>
                </div>
                <div>
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-input" rows="2" placeholder="Deskripsi singkat foto…"></textarea>
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-input form-select">
                        <option value="1">Aktif (Tampil di Website)</option>
                        <option value="0">Sembunyikan</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                <button type="button" onclick="closeModal('modal-tambah')" class="btn btn-ghost">Batal</button>
                <button type="button" onclick="submitTambah()" id="btn-tambah-submit" class="btn btn-primary">
                    <i data-feather="upload-cloud" class="w-4 h-4"></i>
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT -->
<!-- ============================================================ -->
<div id="modal-edit" class="modal-overlay">
    <div class="modal-box">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Edit Foto Galeri</h3>
            <button onclick="closeModal('modal-edit')" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit" enctype="multipart/form-data">
            <input type="hidden" id="edit-id">
            <div class="px-6 py-5 space-y-4">
                <div id="edit-current-img" class="text-center"></div>
                <div>
                    <label class="form-label">Ganti Foto (opsional)</label>
                    <div class="upload-area" onclick="document.getElementById('edit-gambar').click()">
                        <i data-feather="refresh-cw" class="w-5 h-5 text-hijau-400 mx-auto mb-1"></i>
                        <p class="text-xs text-gray-500">Klik untuk mengganti foto</p>
                    </div>
                    <input type="file" id="edit-gambar" name="gambar" class="hidden" accept="image/*"
                        onchange="previewImage(this,'preview-edit')">
                    <div id="preview-edit" class="mt-2 text-center"></div>
                </div>
                <div>
                    <label class="form-label">Judul Foto *</label>
                    <input type="text" name="judul" id="edit-judul" class="form-input" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Kategori</label>
                        <select name="kategori" id="edit-kategori" class="form-input form-select">
                            <option value="umum">Umum</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="fasilitas">Fasilitas</option>
                            <option value="prestasi">Prestasi</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan" id="edit-urutan" class="form-input" min="1">
                    </div>
                </div>
                <div>
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="edit-deskripsi" class="form-input" rows="2"></textarea>
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" id="edit-status" class="form-input form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Sembunyikan</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                <button type="button" onclick="closeModal('modal-edit')" class="btn btn-ghost">Batal</button>
                <button type="button" onclick="submitEdit()" class="btn btn-primary">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function filterGaleri() {
        const kat = document.getElementById('filter-kategori').value;
        document.querySelectorAll('.galeri-card').forEach(c => {
            c.style.display = (!kat || c.dataset.kategori === kat) ? '' : 'none';
        });
    }

    async function submitTambah() {
        const btn = document.getElementById('btn-tambah-submit');
        btn.disabled = true;
        btn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Mengupload…';
        try {
            const fd = new FormData(document.getElementById('form-tambah'));
            const d = await ajaxPost('<?= base_url('panel-admin/galeri-store') ?>', fd);
            showToast(d.message, d.status === 'success' ? 'success' : 'error');
            if (d.status === 'success') {
                closeModal('modal-tambah');
                setTimeout(() => location.reload(), 900);
            }
        } catch (e) {
            showToast('Terjadi kesalahan.', 'error');
        }
        btn.disabled = false;
        btn.innerHTML = '<i data-feather="upload-cloud" class="w-4 h-4"></i> Upload';
        feather.replace();
    }

    function editGaleri(g) {
        document.getElementById('edit-id').value = g.id;
        document.getElementById('edit-judul').value = g.judul;
        document.getElementById('edit-deskripsi').value = g.deskripsi || '';
        document.getElementById('edit-kategori').value = g.kategori;
        document.getElementById('edit-urutan').value = g.urutan;
        document.getElementById('edit-status').value = g.status;

        const ci = document.getElementById('edit-current-img');
        ci.innerHTML = g.gambar ?
            `<img src="<?= base_url('assets/images/uploads/galeri/') ?>${g.gambar}" class="h-24 rounded-xl object-cover mx-auto mb-2">` :
            '<p class="text-xs text-gray-400 mb-2">Belum ada foto</p>';

        document.getElementById('preview-edit').innerHTML = '';
        openModal('modal-edit');
        feather.replace();
    }

    async function submitEdit() {
        try {
            const id = document.getElementById('edit-id').value;
            const fd = new FormData(document.getElementById('form-edit'));
            // Append name fields manually (hidden input inside form-edit not used for file)
            const d = await ajaxPost('<?= base_url('panel-admin/galeri-update/') ?>' + id, fd);
            showToast(d.message, d.status === 'success' ? 'success' : 'error');
            if (d.status === 'success') {
                closeModal('modal-edit');
                setTimeout(() => location.reload(), 900);
            }
        } catch (e) {
            showToast('Terjadi kesalahan.', 'error');
        }
    }
</script>