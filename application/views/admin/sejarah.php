<!-- SEJARAH ADMIN VIEW -->
<!-- Header action -->
<div class="flex items-center justify-between mb-6">
    <p class="text-gray-500 text-sm"><?= count($sejarah) ?> data sejarah</p>
    <button onclick="openAdd()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-hijau-700 transition-colors shadow-sm">
        <i data-feather="plus" class="w-4 h-4"></i>
        Tambah Sejarah
    </button>
</div>

<div class="space-y-4" id="sejarah-list">
    <?php if (!empty($sejarah)): foreach ($sejarah as $s): ?>
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5" id="row-<?= $s->id ?>">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-4 flex-1 min-w-0">
                        <div class="w-12 h-12 bg-hijau-900 text-kuning-400 rounded-xl flex items-center justify-center flex-shrink-0 font-display font-bold text-sm">
                            <?= $s->tahun ?? '#' ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-semibold text-gray-900 mb-1"><?= $s->judul ?></h3>
                            <p class="text-sm text-gray-500 line-clamp-2"><?= $s->konten ?></p>
                        </div>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <button onclick="openEdit(<?= htmlspecialchars(json_encode($s)) ?>)" class="w-8 h-8 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                            <i data-feather="edit-2" class="w-3.5 h-3.5"></i>
                        </button>
                        <button onclick="hapus(<?= $s->id ?>, '<?= addslashes($s->judul) ?>')" class="w-8 h-8 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg flex items-center justify-center">
                            <i data-feather="trash-2" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach;
    else: ?>
        <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center text-gray-400">Belum ada data sejarah</div>
    <?php endif; ?>
</div>

<!-- MODAL -->
<div id="modal-form" data-modal class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100 sticky top-0 bg-white rounded-t-2xl">
            <h3 id="modal-title" class="font-display font-bold text-gray-900 text-lg">Tambah Sejarah</h3>
            <button onclick="closeModal('modal-form')" class="text-gray-400 hover:text-gray-600 w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center">
                <i data-feather="x" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="p-6 space-y-4">
            <input type="hidden" id="f-id">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Judul <span class="text-red-500">*</span></label>
                <input type="text" id="f-judul" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" placeholder="Pendirian Yayasan...">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tahun</label>
                    <input type="number" id="f-tahun" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" placeholder="1995">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Urutan</label>
                    <input type="number" id="f-urutan" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" placeholder="0">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konten <span class="text-red-500">*</span></label>
                <textarea id="f-konten" rows="5" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500 resize-none" placeholder="Deskripsi sejarah..."></textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar (Opsional)</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-hijau-400 transition-colors cursor-pointer relative">
                    <input type="file" id="f-gambar" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(this,'img-preview')">
                    <img id="img-preview" src="" class="hidden w-full h-32 object-cover rounded-lg mb-2">
                    <i data-feather="upload" class="w-5 h-5 text-gray-400 mx-auto mb-1"></i>
                    <p class="text-xs text-gray-400">Upload gambar</p>
                </div>
            </div>
        </div>
        <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-3 sticky bottom-0 bg-white rounded-b-2xl">
            <button onclick="closeModal('modal-form')" class="px-5 py-2.5 border border-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-50">Batal</button>
            <button onclick="simpan()" class="px-6 py-2.5 bg-hijau-800 text-white rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm flex items-center gap-2">
                <i data-feather="save" class="w-4 h-4"></i> Simpan
            </button>
        </div>
    </div>
</div>

<script>
    function openAdd() {
        document.getElementById('modal-title').textContent = 'Tambah Sejarah';
        ['id', 'judul', 'konten'].forEach(k => {
            const el = document.getElementById('f-' + k);
            if (el) el.value = '';
        });
        document.getElementById('f-tahun').value = new Date().getFullYear();
        document.getElementById('f-urutan').value = '0';
        document.getElementById('f-gambar').value = '';
        document.getElementById('img-preview').classList.add('hidden');
        openModal('modal-form');
        feather.replace();
    }

    function openEdit(data) {
        document.getElementById('modal-title').textContent = 'Edit Sejarah';
        document.getElementById('f-id').value = data.id;
        document.getElementById('f-judul').value = data.judul;
        document.getElementById('f-konten').value = data.konten;
        document.getElementById('f-tahun').value = data.tahun || '';
        document.getElementById('f-urutan').value = data.urutan;
        document.getElementById('f-gambar').value = '';
        if (data.gambar) {
            const img = document.getElementById('img-preview');
            img.src = '<?= base_url('assets/images/uploads/sejarah/') ?>' + data.gambar;
            img.classList.remove('hidden');
        } else {
            document.getElementById('img-preview').classList.add('hidden');
        }
        openModal('modal-form');
        feather.replace();
    }
    async function simpan() {
        const judul = document.getElementById('f-judul').value.trim();
        const konten = document.getElementById('f-konten').value.trim();
        if (!judul || !konten) {
            showToast('Judul dan konten wajib diisi', 'error');
            return;
        }
        const fd = new FormData();
        fd.append('id', document.getElementById('f-id').value);
        fd.append('judul', judul);
        fd.append('konten', konten);
        fd.append('tahun', document.getElementById('f-tahun').value);
        fd.append('urutan', document.getElementById('f-urutan').value || 0);
        fd.append('status', 1);
        const gambar = document.getElementById('f-gambar').files[0];
        if (gambar) fd.append('gambar', gambar);
        await ajaxSubmit('<?= base_url('panel-admin/sejarah/save') ?>', fd, () => {
            closeModal('modal-form');
            setTimeout(() => location.reload(), 500);
        });
    }
    async function hapus(id, judul) {
        showConfirm(`Hapus sejarah "${judul}"?`, async () => {
            const fd = new FormData();
            fd.append('id', id);
            await ajaxSubmit('<?= base_url('panel-admin/sejarah/delete') ?>', fd, () => {
                document.getElementById('row-' + id)?.remove();
            });
        });
    }
</script>