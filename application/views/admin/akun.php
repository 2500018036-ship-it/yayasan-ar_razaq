<?php $a = isset($admin) ? $admin : null; ?>
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50">
            <h2 class="font-display font-bold text-gray-900">Profil Akun Admin</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola informasi akun dan keamanan Anda</p>
        </div>
        <div class="p-6 space-y-5">
            <div class="flex items-center gap-5 pb-5 border-b border-gray-100">
                <?php if ($a && !empty($a->foto)): ?>
                    <img src="<?= base_url('assets/images/uploads/admin/' . $a->foto) ?>" class="w-16 h-16 rounded-2xl object-cover border-2 border-hijau-100">
                <?php else: ?>
                    <div class="w-16 h-16 bg-gradient-to-br from-kuning-400 to-kuning-600 rounded-2xl flex items-center justify-center text-hijau-950 font-bold text-xl">
                        <?= strtoupper(substr($a ? $a->nama : 'A', 0, 1)) ?>
                    </div>
                <?php endif; ?>
                <div>
                    <div class="font-semibold text-gray-900"><?= $a ? $a->nama : 'Admin' ?></div>
                    <div class="text-xs text-gray-400">Administrator</div>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="akun-nama" value="<?= $a ? $a->nama : '' ?>" placeholder="Nama lengkap…"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input type="email" id="akun-email" value="<?= $a ? $a->email : '' ?>" placeholder="admin@yayasan.sch.id"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                <input type="text" id="akun-username" value="<?= $a ? $a->username : '' ?>" placeholder="username"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
            </div>

            <hr class="border-gray-100">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password Baru <span class="text-xs text-gray-400 font-normal">(kosongkan jika tidak ingin mengubah)</span></label>
                <input type="password" id="akun-password" placeholder="••••••••"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-hijau-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Foto Profil</label>
                <?php if ($a && !empty($a->foto)): ?>
                    <img src="<?= base_url('assets/images/uploads/admin/' . $a->foto) ?>" class="w-14 h-14 rounded-xl object-cover mb-2 border border-gray-100">
                <?php endif; ?>
                <input type="file" id="akun-foto" accept="image/*"
                    class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-hijau-50 file:text-hijau-700 hover:file:bg-hijau-100">
            </div>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
            <button onclick="simpanAkun()" class="inline-flex items-center gap-2 bg-hijau-800 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-hijau-700 transition-colors shadow-sm">
                <i data-feather="save" class="w-4 h-4"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

<script>
    async function simpanAkun() {
        const nama = document.getElementById('akun-nama').value.trim();
        if (!nama) {
            showToast('Nama wajib diisi', 'error');
            return;
        }
        const fd = new FormData();
        fd.append('nama', nama);
        fd.append('email', document.getElementById('akun-email').value);
        fd.append('username', document.getElementById('akun-username').value);
        fd.append('password', document.getElementById('akun-password').value);
        const foto = document.getElementById('akun-foto').files[0];
        if (foto) fd.append('foto', foto);
        await ajaxSubmit('<?= base_url('panel-admin/akun/update') ?>', fd, () => {
            setTimeout(() => location.reload(), 800);
        });
    }
</script>
