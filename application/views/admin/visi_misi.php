<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php
// Resolusi data background dari profil
$_adm_bg_video   = isset($profil) && $profil && !empty($profil->visimisi_bg_video)       ? $profil->visimisi_bg_video       : null;
$_adm_bg_image   = isset($profil) && $profil && !empty($profil->visimisi_bg_image)       ? $profil->visimisi_bg_image       : null;
$_adm_ov_color   = isset($profil) && $profil && !empty($profil->visimisi_overlay_color)  ? $profil->visimisi_overlay_color  : '#052e16';
$_adm_ov_opacity = isset($profil) && $profil && isset($profil->visimisi_overlay_opacity) ? (int) $profil->visimisi_overlay_opacity : 80;

// Helper permission check (PHP pengganti adminCan() JavaScript)
$_perms = (isset($permission_codes) && is_array($permission_codes)) ? $permission_codes : [];
?>

<!-- ============================================================ -->
<!-- PAGE HEADER                                                   -->
<!-- ============================================================ -->
<div class="page-header mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Visi &amp; Misi</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola visi, misi, nilai yayasan, dan background section</p>
        </div>
        <?php if (in_array('visi_misi.create', $_perms, true)): ?>
            <button onclick="openModal('modal-tambah')"
                class="flex items-center gap-2 bg-hijau-700 hover:bg-hijau-600 text-white font-semibold text-sm px-5 py-2.5 rounded-2xl transition-colors duration-200">
                <i data-feather="plus" class="w-4 h-4"></i>
                Tambah Data
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- ============================================================ -->
<!-- PANEL BACKGROUND VISI MISI                                    -->
<!-- ============================================================ -->
<?php if (in_array('visi_misi.edit', $_perms, true)): ?>
    <div class="card mb-8">
        <div class="card-header">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-hijau-100 rounded-xl flex items-center justify-center">
                    <i data-feather="image" class="w-4 h-4 text-hijau-700"></i>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 text-sm">Background Section Visi &amp; Misi</h3>
                    <p class="text-xs text-gray-400 mt-0.5">Video = prioritas 1 · Gambar = prioritas 2 · Kosong = warna default hijau</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form id="form-visimisi-bg" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <!-- ── KOLOM 1: Background Gambar ────────────── -->
                    <div class="space-y-3">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Background Gambar
                            <span class="ml-1 text-gray-400 font-normal normal-case">(Prioritas 2)</span>
                        </label>

                        <!-- Preview gambar aktif -->
                        <div id="preview-vm-image"
                            class="w-full h-36 rounded-2xl bg-gray-100 border border-gray-200 overflow-hidden flex items-center justify-center">
                            <?php if ($_adm_bg_image): ?>
                                <img src="<?= base_url('assets/images/uploads/profil/' . $_adm_bg_image) ?>"
                                    class="w-full h-full object-cover" alt="BG Gambar">
                            <?php else: ?>
                                <div class="text-center text-gray-400">
                                    <i data-feather="image" class="w-8 h-8 mx-auto mb-1 opacity-40"></i>
                                    <p class="text-xs">Belum ada gambar</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Input file -->
                        <input type="file" name="visimisi_bg_image" id="input-vm-image"
                            accept="image/jpeg,image/png,image/webp,image/gif"
                            class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100 cursor-pointer"
                            onchange="previewImage(this, 'preview-vm-image')">
                        <p class="text-[11px] text-gray-400">Format: JPG, PNG, WEBP · Maks 5MB</p>

                        <?php if ($_adm_bg_image): ?>
                            <button type="button" onclick="deleteVmBg('image')"
                                class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl border border-red-200 text-red-500 text-xs font-semibold hover:bg-red-50 transition-colors duration-200">
                                <i data-feather="trash-2" class="w-3.5 h-3.5"></i>
                                Hapus Gambar
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- ── KOLOM 2: Background Video ─────────────── -->
                    <div class="space-y-3">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Background Video
                            <span class="ml-1 text-kuning-600 font-bold">(Prioritas 1)</span>
                        </label>

                        <!-- Preview / status video aktif -->
                        <div class="w-full h-36 rounded-2xl bg-gray-100 border border-gray-200 overflow-hidden flex items-center justify-center">
                            <?php if ($_adm_bg_video): ?>
                                <video class="w-full h-full object-cover" autoplay muted loop playsinline>
                                    <source src="<?= base_url('assets/images/uploads/profil/' . $_adm_bg_video) ?>" type="video/mp4">
                                </video>
                            <?php else: ?>
                                <div class="text-center text-gray-400">
                                    <i data-feather="video" class="w-8 h-8 mx-auto mb-1 opacity-40"></i>
                                    <p class="text-xs">Belum ada video</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Input file video -->
                        <input type="file" name="visimisi_bg_video" id="input-vm-video"
                            accept="video/mp4,video/webm"
                            class="block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-kuning-50 file:text-kuning-700 hover:file:bg-kuning-100 cursor-pointer">
                        <p class="text-[11px] text-gray-400">Format: MP4 · Maks 50MB · Video menggantikan gambar secara otomatis</p>

                        <?php if ($_adm_bg_video): ?>
                            <button type="button" onclick="deleteVmBg('video')"
                                class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-xl border border-red-200 text-red-500 text-xs font-semibold hover:bg-red-50 transition-colors duration-200">
                                <i data-feather="trash-2" class="w-3.5 h-3.5"></i>
                                Hapus Video
                            </button>
                        <?php endif; ?>
                    </div>

                    <!-- ── KOLOM 3: Overlay & Aksi ───────────────── -->
                    <div class="space-y-4">
                        <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider">Overlay &amp; Aksi</label>

                        <!-- Color picker -->
                        <div class="flex items-center gap-3">
                            <input type="color" name="visimisi_overlay_color" id="vm-ov-color"
                                value="<?= htmlspecialchars($_adm_ov_color) ?>"
                                class="w-12 h-10 rounded-xl border border-gray-200 cursor-pointer p-0.5 bg-white">
                            <div>
                                <p class="text-xs font-medium text-gray-700">Warna Overlay</p>
                                <p class="text-[11px] text-gray-400">Default: hijau tua #052e16</p>
                            </div>
                        </div>

                        <!-- Opacity slider -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="vm-ov-opacity" class="text-xs text-gray-600 font-medium">Transparansi Overlay</label>
                                <span id="vm-ov-opacity-val" class="text-xs font-bold text-hijau-700"><?= $_adm_ov_opacity ?>%</span>
                            </div>
                            <input type="range" name="visimisi_overlay_opacity" id="vm-ov-opacity"
                                min="0" max="100" step="5"
                                value="<?= $_adm_ov_opacity ?>"
                                class="w-full h-2 rounded-full accent-hijau-600 cursor-pointer"
                                oninput="document.getElementById('vm-ov-opacity-val').textContent = this.value + '%'">
                            <div class="flex justify-between text-[10px] text-gray-400 mt-1">
                                <span>Transparan (0%)</span>
                                <span>Solid (100%)</span>
                            </div>
                        </div>

                        <!-- Info prioritas -->
                        <div class="bg-gray-50 rounded-2xl p-3 border border-gray-100">
                            <p class="text-[11px] text-gray-500 font-semibold mb-1.5 uppercase tracking-wider">Urutan Prioritas</p>
                            <div class="space-y-1.5">
                                <div class="flex items-center gap-2 text-[11px] text-gray-600">
                                    <span class="w-4 h-4 bg-kuning-500 rounded-full flex items-center justify-center text-white text-[8px] font-bold flex-shrink-0">1</span>
                                    Video (jika diunggah)
                                </div>
                                <div class="flex items-center gap-2 text-[11px] text-gray-600">
                                    <span class="w-4 h-4 bg-hijau-500 rounded-full flex items-center justify-center text-white text-[8px] font-bold flex-shrink-0">2</span>
                                    Gambar (jika tidak ada video)
                                </div>
                                <div class="flex items-center gap-2 text-[11px] text-gray-600">
                                    <span class="w-4 h-4 bg-gray-400 rounded-full flex items-center justify-center text-white text-[8px] font-bold flex-shrink-0">3</span>
                                    Warna hijau default
                                </div>
                            </div>
                        </div>

                        <!-- Tombol simpan -->
                        <button type="button" onclick="saveVmBg()"
                            class="w-full flex items-center justify-center gap-2 bg-hijau-700 hover:bg-hijau-600 text-white font-semibold text-sm px-4 py-3 rounded-2xl transition-colors duration-200">
                            <i data-feather="save" class="w-4 h-4"></i>
                            Simpan Pengaturan Background
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
<?php endif; ?>

<!-- ============================================================ -->
<!-- TABEL DATA VISI MISI                                          -->
<!-- ============================================================ -->
<div class="card">
    <div class="card-header">
        <h3 class="font-semibold text-gray-800 text-sm">Data Visi, Misi &amp; Nilai</h3>
    </div>
    <div class="card-body p-0">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Ikon</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Urutan</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if (!empty($visi_misi)): ?>
                        <?php foreach ($visi_misi as $item): ?>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-5 py-4">
                                    <?php
                                    $tipe_colors = [
                                        'visi'  => 'bg-blue-50 text-blue-700',
                                        'misi'  => 'bg-hijau-50 text-hijau-700',
                                        'nilai' => 'bg-kuning-50 text-kuning-700',
                                    ];
                                    $tipe_color = isset($tipe_colors[$item->tipe]) ? $tipe_colors[$item->tipe] : 'bg-gray-50 text-gray-600';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold capitalize <?= $tipe_color ?>">
                                        <?= $item->tipe ?>
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <p class="font-medium text-gray-800 max-w-xs truncate"><?= $item->judul ?: '<span class="text-gray-400 italic text-xs">—</span>' ?></p>
                                    <?php if ($item->konten): ?>
                                        <p class="text-gray-400 text-xs mt-0.5 truncate max-w-xs"><?= $item->konten ?></p>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4">
                                    <?php if ($item->ikon): ?>
                                        <div class="flex items-center gap-2">
                                            <i data-feather="<?= $item->ikon ?>" class="w-4 h-4 text-hijau-600"></i>
                                            <code class="text-xs text-gray-400"><?= $item->ikon ?></code>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-gray-300 text-xs">—</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-gray-500"><?= $item->urutan ?></td>
                                <td class="px-5 py-4">
                                    <?php if (in_array('visi_misi.edit', $_perms, true)): ?>
                                        <button onclick="toggleStatus('<?= base_url('panel-admin/visi-misi/toggle/' . $item->id) ?>', this)"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold transition-all duration-200 <?= $item->status ? 'bg-hijau-50 text-hijau-700 hover:bg-hijau-100' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' ?>">
                                            <span class="w-1.5 h-1.5 rounded-full <?= $item->status ? 'bg-hijau-500' : 'bg-gray-400' ?>"></span>
                                            <?= $item->status ? 'Aktif' : 'Nonaktif' ?>
                                        </button>
                                    <?php else: ?>
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold <?= $item->status ? 'bg-hijau-50 text-hijau-700' : 'bg-gray-100 text-gray-500' ?>">
                                            <span class="w-1.5 h-1.5 rounded-full <?= $item->status ? 'bg-hijau-500' : 'bg-gray-400' ?>"></span>
                                            <?= $item->status ? 'Aktif' : 'Nonaktif' ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <?php if (in_array('visi_misi.edit', $_perms, true)): ?>
                                            <button onclick="editItem(<?= $item->id ?>)"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-hijau-50 text-hijau-700 hover:bg-hijau-100 transition-colors">
                                                <i data-feather="edit-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if (in_array('visi_misi.delete', $_perms, true)): ?>
                                            <button onclick="confirmDelete('<?= base_url('panel-admin/visi-misi/delete/' . $item->id) ?>', '<?= addslashes($item->judul ?: $item->tipe) ?>')"
                                                class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition-colors">
                                                <i data-feather="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                                <i data-feather="inbox" class="w-10 h-10 mx-auto mb-3 opacity-30"></i>
                                <p class="text-sm">Belum ada data visi/misi.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL TAMBAH                                                  -->
<!-- ============================================================ -->
<div id="modal-tambah" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3 class="font-semibold text-gray-800">Tambah Data Visi/Misi</h3>
            <button onclick="closeModal('modal-tambah')" class="modal-close-btn">
                <i data-feather="x" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="modal-body space-y-4">
            <div>
                <label class="form-label">Tipe <span class="text-red-500">*</span></label>
                <select id="tambah-tipe" class="form-input">
                    <option value="visi">Visi</option>
                    <option value="misi">Misi</option>
                    <option value="nilai">Nilai</option>
                </select>
            </div>
            <div>
                <label class="form-label">Judul</label>
                <input type="text" id="tambah-judul" class="form-input" placeholder="Judul (opsional untuk visi)">
            </div>
            <div>
                <label class="form-label">Konten <span class="text-red-500">*</span></label>
                <textarea id="tambah-konten" class="form-input" rows="4" placeholder="Isi konten..."></textarea>
            </div>
            <div>
                <label class="form-label">Ikon Feather</label>
                <input type="text" id="tambah-ikon" class="form-input" placeholder="cth: check-circle, star, book">
                <p class="text-xs text-gray-400 mt-1">Lihat daftar ikon di <a href="https://feathericons.com" target="_blank" class="text-hijau-600 underline">feathericons.com</a></p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Urutan</label>
                    <input type="number" id="tambah-urutan" class="form-input" value="1" min="1">
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select id="tambah-status" class="form-input">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('modal-tambah')" class="btn-secondary">Batal</button>
            <button onclick="submitTambah()" class="btn-primary">Simpan</button>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- MODAL EDIT                                                    -->
<!-- ============================================================ -->
<div id="modal-edit" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h3 class="font-semibold text-gray-800">Edit Data Visi/Misi</h3>
            <button onclick="closeModal('modal-edit')" class="modal-close-btn">
                <i data-feather="x" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="modal-body space-y-4">
            <input type="hidden" id="edit-id">
            <div>
                <label class="form-label">Tipe <span class="text-red-500">*</span></label>
                <select id="edit-tipe" class="form-input">
                    <option value="visi">Visi</option>
                    <option value="misi">Misi</option>
                    <option value="nilai">Nilai</option>
                </select>
            </div>
            <div>
                <label class="form-label">Judul</label>
                <input type="text" id="edit-judul" class="form-input" placeholder="Judul (opsional untuk visi)">
            </div>
            <div>
                <label class="form-label">Konten <span class="text-red-500">*</span></label>
                <textarea id="edit-konten" class="form-input" rows="4"></textarea>
            </div>
            <div>
                <label class="form-label">Ikon Feather</label>
                <input type="text" id="edit-ikon" class="form-input" placeholder="cth: check-circle, star, book">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="form-label">Urutan</label>
                    <input type="number" id="edit-urutan" class="form-input" min="1">
                </div>
                <div>
                    <label class="form-label">Status</label>
                    <select id="edit-status" class="form-input">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button onclick="closeModal('modal-edit')" class="btn-secondary">Batal</button>
            <button onclick="submitEdit()" class="btn-primary">Perbarui</button>
        </div>
    </div>
</div>

<!-- ============================================================ -->
<!-- JAVASCRIPT                                                    -->
<!-- ============================================================ -->
<script>
    const BASE_URL = '<?= base_url('panel-admin') ?>';

    // ── Tambah ────────────────────────────────────────────────────
    function submitTambah() {
        const fd = new FormData();
        fd.append('tipe', document.getElementById('tambah-tipe').value);
        fd.append('judul', document.getElementById('tambah-judul').value);
        fd.append('konten', document.getElementById('tambah-konten').value);
        fd.append('ikon', document.getElementById('tambah-ikon').value);
        fd.append('urutan', document.getElementById('tambah-urutan').value);
        fd.append('status', document.getElementById('tambah-status').value);
        ajaxSubmit(BASE_URL + '/visi-misi/store', fd, () => {
            closeModal('modal-tambah');
            setTimeout(() => location.reload(), 700);
        });
    }

    // ── Edit ──────────────────────────────────────────────────────
    function editItem(id) {
        fetch(BASE_URL + '/visi-misi/get/' + id, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(r => r.json())
            .then(d => {
                if (d.status !== 'success') {
                    showToast(d.message, 'error');
                    return;
                }
                const item = d.data;
                document.getElementById('edit-id').value = item.id;
                document.getElementById('edit-tipe').value = item.tipe;
                document.getElementById('edit-judul').value = item.judul || '';
                document.getElementById('edit-konten').value = item.konten || '';
                document.getElementById('edit-ikon').value = item.ikon || '';
                document.getElementById('edit-urutan').value = item.urutan || 1;
                document.getElementById('edit-status').value = item.status;
                openModal('modal-edit');
                feather.replace();
            })
            .catch(() => showToast('Gagal memuat data.', 'error'));
    }

    function submitEdit() {
        const id = document.getElementById('edit-id').value;
        const fd = new FormData();
        fd.append('tipe', document.getElementById('edit-tipe').value);
        fd.append('judul', document.getElementById('edit-judul').value);
        fd.append('konten', document.getElementById('edit-konten').value);
        fd.append('ikon', document.getElementById('edit-ikon').value);
        fd.append('urutan', document.getElementById('edit-urutan').value);
        fd.append('status', document.getElementById('edit-status').value);
        ajaxSubmit(BASE_URL + '/visi-misi/update/' + id, fd, () => {
            closeModal('modal-edit');
            setTimeout(() => location.reload(), 700);
        });
    }

    // ── Background ────────────────────────────────────────────────
    function saveVmBg() {
        const form = document.getElementById('form-visimisi-bg');
        const fd = new FormData(form);
        ajaxSubmit(BASE_URL + '/visi-misi/bg-save', fd, () => {
            setTimeout(() => location.reload(), 800);
        });
    }

    function deleteVmBg(type) {
        const label = type === 'video' ? 'background video' : 'background gambar';
        const next = type === 'video' ? 'gambar (jika ada) atau warna default.' : 'warna default.';
        if (!confirm('Hapus ' + label + '? Tampilan akan kembali menggunakan ' + next)) return;

        const url = type === 'video' ?
            BASE_URL + '/visi-misi/bg-delete-video' :
            BASE_URL + '/visi-misi/bg-delete-image';

        fetch(url, {
                method: 'POST'
            })
            .then(r => r.json())
            .then(d => {
                showToast(d.message, d.status === 'success' ? 'success' : 'error');
                if (d.status === 'success') setTimeout(() => location.reload(), 800);
            })
            .catch(() => showToast('Terjadi kesalahan.', 'error'));
    }
</script>