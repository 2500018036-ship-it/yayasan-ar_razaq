<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Page Header -->
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-xs text-gray-400">Kelola semua artikel dan pengumuman</p>
    </div>
    <button onclick="openModal('modal-tambah')" class="btn btn-primary">
        <i data-feather="plus" class="w-4 h-4"></i>
        Tambah Berita
    </button>
</div>

<!-- Filter / Search bar -->
<div class="bg-white rounded-2xl border border-gray-100 mb-6 px-4 py-3 flex items-center gap-3">
    <i data-feather="search" class="w-4 h-4 text-gray-300 flex-shrink-0"></i>
    <input type="text" id="search-input" placeholder="Cari judul berita…"
        class="flex-1 text-sm outline-none bg-transparent text-gray-700 placeholder-gray-300"
        oninput="filterTable()">
    <select id="filter-kategori" onchange="filterTable()" class="text-xs text-gray-500 bg-transparent outline-none border-l border-gray-100 pl-3 cursor-pointer">
        <option value="">Semua Kategori</option>
        <option value="berita">Berita</option>
        <option value="pengumuman">Pengumuman</option>
        <option value="kegiatan">Kegiatan</option>
        <option value="prestasi">Prestasi</option>
    </select>
</div>

<!-- Table -->
<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
    <?php if (!empty($berita)): ?>
        <div class="overflow-x-auto">
            <table class="data-table" id="berita-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul & Penulis</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($berita as $idx => $b): ?>
                        <tr data-judul="<?= strtolower($b->judul) ?>" data-kategori="<?= $b->kategori ?>">
                            <td class="text-gray-400 text-xs w-8"><?= $idx + 1 ?></td>
                            <td>
                                <div class="font-medium text-gray-800 max-w-xs"><?= $b->judul ?></div>
                                <div class="text-xs text-gray-400 mt-0.5"><?= $b->penulis ?: '—' ?></div>
                            </td>
                            <td><span class="badge badge-yellow capitalize"><?= $b->kategori ?></span></td>
                            <td class="text-gray-500 text-xs whitespace-nowrap"><?= $b->tanggal_publish ? date('d M Y', strtotime($b->tanggal_publish)) : '—' ?></td>
                            <td class="text-gray-400 text-xs"><?= number_format($b->views) ?></td>
                            <td>
                                <?php if ($b->status): ?>
                                    <span class="badge badge-green">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-gray">Draft</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-2">
                                    <button onclick='editBerita(<?= json_encode($b) ?>)' class="btn btn-ghost py-1.5 px-3 text-xs">
                                        <i data-feather="edit-2" class="w-3 h-3"></i> Edit
                                    </button>
                                    <button onclick="confirmDelete('<?= base_url('panel-admin/berita-delete/' . $b->id) ?>','<?= addslashes($b->judul) ?>')" class="btn btn-danger py-1.5 px-3 text-xs">
                                        <i data-feather="trash-2" class="w-3 h-3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="py-16 text-center text-gray-400">
            <i data-feather="file-text" class="w-10 h-10 mx-auto mb-3 opacity-20"></i>
            <p class="text-sm font-medium">Belum ada berita</p>
            <p class="text-xs mt-1">Klik "Tambah Berita" untuk mulai menulis.</p>
        </div>
    <?php endif; ?>
</div>

<!-- ============================================================ -->
<!-- MODAL TAMBAH -->
<!-- ============================================================ -->
<div id="modal-tambah" class="modal-overlay">
    <div class="modal-box">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-semibold text-gray-900">Tambah Berita</h3>
            <button onclick="closeModal('modal-tambah')" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-tambah" enctype="multipart/form-data">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="form-label">Judul *</label>
                    <input type="text" name="judul" class="form-input" placeholder="Judul berita..." required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-input form-select">
                            <option value="berita">Berita</option>
                            <option value="pengumuman">Pengumuman</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="prestasi">Prestasi</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Publish</label>
                        <input type="date" name="tanggal_publish" class="form-input" value="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div>
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-input" placeholder="Nama penulis" value="Admin Yayasan">
                </div>
                <div>
                    <label class="form-label">Ringkasan</label>
                    <textarea name="ringkasan" class="form-input" rows="2" placeholder="Ringkasan singkat berita…"></textarea>
                </div>
                <div>
                    <label class="form-label">Isi Berita *</label>
                    <textarea name="isi" class="form-input" rows="5" placeholder="Tulis isi berita di sini…" required></textarea>
                </div>
                <div>
                    <label class="form-label">Foto Utama</label>
                    <div class="upload-area" onclick="document.getElementById('tambah-gambar').click()">
                        <i data-feather="image" class="w-6 h-6 text-hijau-400 mx-auto mb-2"></i>
                        <p class="text-xs text-gray-500">Klik untuk upload foto (JPG, PNG, WebP — maks 5MB)</p>
                    </div>
                    <input type="file" id="tambah-gambar" name="gambar" class="hidden" accept="image/*"
                        onchange="previewImage(this,'preview-tambah-gambar')">
                    <div id="preview-tambah-gambar" class="mt-2"></div>
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-input form-select">
                        <option value="1">Aktif (Tampil)</option>
                        <option value="0">Draft (Tersembunyi)</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                <button type="button" onclick="closeModal('modal-tambah')" class="btn btn-ghost">Batal</button>
                <button type="button" onclick="submitTambah()" class="btn btn-primary" id="btn-tambah-submit">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Simpan Berita
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
            <h3 class="font-semibold text-gray-900">Edit Berita</h3>
            <button onclick="closeModal('modal-edit')" class="text-gray-400 hover:text-gray-600">
                <i data-feather="x" class="w-5 h-5"></i>
            </button>
        </div>
        <form id="form-edit" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" id="edit-id">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="form-label">Judul *</label>
                    <input type="text" name="judul" id="edit-judul" class="form-input" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Kategori</label>
                        <select name="kategori" id="edit-kategori" class="form-input form-select">
                            <option value="berita">Berita</option>
                            <option value="pengumuman">Pengumuman</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="prestasi">Prestasi</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Tanggal Publish</label>
                        <input type="date" name="tanggal_publish" id="edit-tanggal" class="form-input">
                    </div>
                </div>
                <div>
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" id="edit-penulis" class="form-input">
                </div>
                <div>
                    <label class="form-label">Ringkasan</label>
                    <textarea name="ringkasan" id="edit-ringkasan" class="form-input" rows="2"></textarea>
                </div>
                <div>
                    <label class="form-label">Isi Berita *</label>
                    <textarea name="isi" id="edit-isi" class="form-input" rows="5" required></textarea>
                </div>
                <div>
                    <label class="form-label">Foto Utama (kosongkan jika tidak ingin mengganti)</label>
                    <div id="edit-current-img" class="mb-2"></div>
                    <div class="upload-area" onclick="document.getElementById('edit-gambar').click()">
                        <i data-feather="refresh-cw" class="w-5 h-5 text-hijau-400 mx-auto mb-1"></i>
                        <p class="text-xs text-gray-500">Klik untuk mengganti foto</p>
                    </div>
                    <input type="file" id="edit-gambar" name="gambar" class="hidden" accept="image/*"
                        onchange="previewImage(this,'preview-edit-gambar')">
                    <div id="preview-edit-gambar" class="mt-2"></div>
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select name="status" id="edit-status" class="form-input form-select">
                        <option value="1">Aktif (Tampil)</option>
                        <option value="0">Draft (Tersembunyi)</option>
                    </select>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                <button type="button" onclick="closeModal('modal-edit')" class="btn btn-ghost">Batal</button>
                <button type="button" onclick="submitEdit()" class="btn btn-primary">
                    <i data-feather="save" class="w-4 h-4"></i>
                    Update Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Filter table
    function filterTable() {
        const q = document.getElementById('search-input').value.toLowerCase();
        const kat = document.getElementById('filter-kategori').value;
        document.querySelectorAll('#berita-table tbody tr').forEach(row => {
            const judul = row.dataset.judul || '';
            const kategori = row.dataset.kategori || '';
            const matchQ = judul.includes(q);
            const matchK = !kat || kategori === kat;
            row.style.display = (matchQ && matchK) ? '' : 'none';
        });
    }

    // Submit tambah
    async function submitTambah() {
        const btn = document.getElementById('btn-tambah-submit');
        btn.disabled = true;
        btn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Menyimpan…';
        try {
            const fd = new FormData(document.getElementById('form-tambah'));
            const d = await ajaxPost('<?= base_url('panel-admin/berita-store') ?>', fd);
            showToast(d.message, d.status === 'success' ? 'success' : 'error');
            if (d.status === 'success') {
                closeModal('modal-tambah');
                setTimeout(() => location.reload(), 900);
            }
        } catch (e) {
            showToast('Terjadi kesalahan.', 'error');
        }
        btn.disabled = false;
        btn.innerHTML = '<i data-feather="save" class="w-4 h-4"></i> Simpan Berita';
        feather.replace();
    }

    // Edit — populate modal
    function editBerita(b) {
        document.getElementById('edit-id').value = b.id;
        document.getElementById('edit-judul').value = b.judul;
        document.getElementById('edit-ringkasan').value = b.ringkasan || '';
        document.getElementById('edit-isi').value = b.isi;
        document.getElementById('edit-penulis').value = b.penulis || '';
        document.getElementById('edit-tanggal').value = b.tanggal_publish || '';
        document.getElementById('edit-status').value = b.status;
        document.getElementById('edit-kategori').value = b.kategori;

        const ci = document.getElementById('edit-current-img');
        ci.innerHTML = b.gambar ?
            `<img src="<?= base_url('assets/images/uploads/berita/') ?>${b.gambar}" class="h-20 rounded-xl object-cover">` :
            '<p class="text-xs text-gray-400">Belum ada foto</p>';

        document.getElementById('preview-edit-gambar').innerHTML = '';
        openModal('modal-edit');
        feather.replace();
    }

    // Submit edit
    async function submitEdit() {
        try {
            const id = document.getElementById('edit-id').value;
            const fd = new FormData(document.getElementById('form-edit'));
            const d = await ajaxPost('<?= base_url('panel-admin/berita-update/') ?>' + id, fd);
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