<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$permission_codes = isset($permission_codes) && is_array($permission_codes) ? $permission_codes : [];
$can_edit = in_array('popup.edit', $permission_codes, true);
$popup = isset($popup) ? $popup : null;
?>

<div class="max-w-4xl space-y-6">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <h2 class="font-display font-bold text-gray-900">Popup Website</h2>
            <p class="text-sm text-gray-500 mt-1">Popup tampil saat pengunjung pertama kali membuka website. Gambar bisa diklik sesuai link tujuan.</p>
        </div>

        <form id="form-popup" enctype="multipart/form-data">
            <div class="p-6 space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status Popup</label>
                    <select name="status" id="popup-status" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" <?= $can_edit ? '' : 'disabled' ?>>
                        <option value="1" <?= ($popup && (int) $popup->status === 1) ? 'selected' : '' ?>>Aktif (Tampil di Website)</option>
                        <option value="0" <?= ($popup && (int) $popup->status === 0) ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Link Tujuan Saat Gambar Diklik</label>
                        <input
                            type="text"
                            name="target_link"
                            id="popup-target-link"
                            value="<?= $popup ? htmlspecialchars((string) $popup->target_link, ENT_QUOTES, 'UTF-8') : '' ?>"
                            placeholder="Contoh: /ppdb, #ppdb, atau https://domain.com"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500"
                            <?= $can_edit ? '' : 'disabled' ?>
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Buka Link</label>
                        <select name="target_mode" id="popup-target-mode" class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500" <?= $can_edit ? '' : 'disabled' ?>>
                            <option value="_self" <?= ($popup && $popup->target_mode === '_blank') ? '' : 'selected' ?>>Tab yang sama</option>
                            <option value="_blank" <?= ($popup && $popup->target_mode === '_blank') ? 'selected' : '' ?>>Tab baru</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Popup</label>
                    <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-4">
                        <div id="popup-preview" class="w-full flex justify-center">
                            <?php if ($popup && !empty($popup->gambar)): ?>
                                <img src="<?= base_url('assets/images/uploads/popup/' . $popup->gambar) ?>" alt="Popup aktif" class="max-h-[360px] w-auto rounded-xl object-contain border border-gray-200 bg-white">
                            <?php else: ?>
                                <div class="text-sm text-gray-400 py-10">Belum ada gambar popup.</div>
                            <?php endif; ?>
                        </div>

                        <?php if ($can_edit): ?>
                            <div class="mt-4 flex flex-col gap-3">
                                <div id="popup-dropzone"
                                    class="rounded-xl border-2 border-dashed border-hijau-200 bg-white px-4 py-6 text-center cursor-pointer transition-colors hover:border-hijau-400 hover:bg-hijau-50/40">
                                    <i data-feather="upload-cloud" class="w-6 h-6 text-hijau-500 mx-auto mb-2"></i>
                                    <p class="text-sm font-semibold text-gray-700">Drop gambar di sini</p>
                                    <p class="text-xs text-gray-500 mt-1">atau klik untuk pilih file</p>
                                    <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, WebP, GIF (maks 5MB)</p>
                                </div>
                                <input type="file" name="gambar" id="popup-gambar" accept="image/*" onchange="previewPopupImage(this)" class="hidden">
                                <div id="popup-filename" class="text-xs text-gray-500"></div>
                                <p class="text-xs text-gray-500">Jika upload gambar baru, gambar popup lama otomatis terganti.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php if ($can_edit): ?>
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
                    <button type="button" onclick="simpanPopup()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm">
                        <i data-feather="save" class="w-4 h-4"></i>
                        Simpan Popup
                    </button>
                </div>
            <?php endif; ?>
        </form>
    </div>
</div>

<script>
    const canEditPopup = <?= $can_edit ? 'true' : 'false' ?>;
    const popupUpdateUrl = window.location.pathname.replace(/\/+$/, '') + '/update';

    function previewPopupImage(input) {
        const preview = document.getElementById('popup-preview');
        if (!preview || !input.files || !input.files[0]) return;
        const filename = document.getElementById('popup-filename');
        if (filename) filename.textContent = 'File dipilih: ' + input.files[0].name;

        const reader = new FileReader();
        reader.onload = (e) => {
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview Popup" class="max-h-[360px] w-auto rounded-xl object-contain border border-gray-200 bg-white">`;
        };
        reader.readAsDataURL(input.files[0]);
    }

    async function simpanPopup() {
        if (!canEditPopup) {
            showToast('Anda tidak punya izin edit popup website.', 'error');
            return;
        }

        const fd = new FormData(document.getElementById('form-popup'));

        await ajaxSubmit(popupUpdateUrl, fd, () => {
            setTimeout(() => location.reload(), 700);
        });
    }

    (function initPopupDropzone() {
        const dropzone = document.getElementById('popup-dropzone');
        const input = document.getElementById('popup-gambar');
        if (!dropzone || !input) return;

        dropzone.addEventListener('click', () => {
            input.click();
        });

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
            previewPopupImage(input);
        });
    })();
</script>
