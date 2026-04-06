<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php
$can_role_create = in_array('setting.role.create', $permission_codes ?? [], true);
$can_role_edit = in_array('setting.role.edit', $permission_codes ?? [], true);
$can_role_delete = in_array('setting.role.delete', $permission_codes ?? [], true);
$can_user_create = in_array('setting.user.create', $permission_codes ?? [], true);
$can_user_edit = in_array('setting.user.edit', $permission_codes ?? [], true);
$can_user_delete = in_array('setting.user.delete', $permission_codes ?? [], true);
$current_admin_id = (int) $this->session->userdata('admin_id');

$permission_groups = [];
if (!empty($permissions)) {
    foreach ($permissions as $p) {
        if (!isset($permission_groups[$p->modul])) $permission_groups[$p->modul] = [];
        $permission_groups[$p->modul][] = $p;
    }
}
?>

<div class="mb-6">
    <p class="text-xs text-gray-400">Kelola akun admin, role, dan permission akses menu</p>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    <!-- Role Management -->
    <section class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-display font-bold text-gray-900">Role & Permission</h2>
                <p class="text-xs text-gray-400 mt-1">Atur hak akses tiap role</p>
            </div>
            <?php if ($can_role_create): ?>
                <button class="btn btn-primary" onclick="openRoleModal()">
                    <i data-feather="plus" class="w-4 h-4"></i>
                    Tambah Role
                </button>
            <?php endif; ?>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Admin</th>
                        <th>Permission</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($roles)): ?>
                        <?php foreach ($roles as $role): ?>
                            <tr>
                                <td>
                                    <div class="font-semibold text-gray-800"><?= htmlspecialchars($role->nama) ?></div>
                                    <div class="text-xs text-gray-400"><?= htmlspecialchars($role->deskripsi ?: '-') ?></div>
                                </td>
                                <td><span class="badge badge-gray"><?= (int) $role->total_admin ?> akun</span></td>
                                <td><span class="badge badge-yellow"><?= (int) $role->total_permission ?> izin</span></td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <?php if ($can_role_edit): ?>
                                            <button class="btn btn-ghost py-1.5 px-3 text-xs" onclick="openRoleModal(<?= (int) $role->id ?>)">
                                                <i data-feather="edit-2" class="w-3 h-3"></i> Edit
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($can_role_delete && !(int) $role->is_system): ?>
                                            <button class="btn btn-danger py-1.5 px-3 text-xs" onclick="deleteRole(<?= (int) $role->id ?>, '<?= addslashes($role->nama) ?>')">
                                                <i data-feather="trash-2" class="w-3 h-3"></i> Hapus
                                            </button>
                                        <?php endif; ?>
                                        <?php if ((int) $role->is_system): ?>
                                            <span class="badge badge-green">System</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-gray-400">Belum ada role.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Admin Management -->
    <section class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h2 class="font-display font-bold text-gray-900">Akun Admin</h2>
                <p class="text-xs text-gray-400 mt-1">Buat akun baru, ubah role, dan kelola akses</p>
            </div>
            <?php if ($can_user_create): ?>
                <button class="btn btn-primary" onclick="openUserModal()">
                    <i data-feather="user-plus" class="w-4 h-4"></i>
                    Tambah Akun
                </button>
            <?php endif; ?>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($admins)): ?>
                        <?php foreach ($admins as $adm): ?>
                            <tr>
                                <td>
                                    <div class="font-semibold text-gray-800"><?= htmlspecialchars($adm->nama) ?></div>
                                    <div class="text-xs text-gray-400"><?= htmlspecialchars($adm->email ?: '-') ?></div>
                                </td>
                                <td><?= htmlspecialchars($adm->username) ?></td>
                                <td><span class="badge badge-green"><?= htmlspecialchars($adm->role_nama ?: 'Tanpa Role') ?></span></td>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <?php if ($can_user_edit): ?>
                                            <button class="btn btn-ghost py-1.5 px-3 text-xs" onclick="openUserModal(<?= (int) $adm->id ?>)">
                                                <i data-feather="edit-2" class="w-3 h-3"></i> Edit
                                            </button>
                                        <?php endif; ?>
                                        <?php if ($can_user_delete && (int) $adm->id !== $current_admin_id): ?>
                                            <button class="btn btn-danger py-1.5 px-3 text-xs" onclick="deleteUser(<?= (int) $adm->id ?>, '<?= addslashes($adm->nama) ?>')">
                                                <i data-feather="trash-2" class="w-3 h-3"></i> Hapus
                                            </button>
                                        <?php endif; ?>
                                        <?php if ((int) $adm->id === $current_admin_id): ?>
                                            <span class="badge badge-yellow">Anda</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-gray-400">Belum ada akun admin.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<!-- Modal Role -->
<div id="modal-role" class="modal-overlay">
    <div class="modal-box">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 id="role-modal-title" class="font-semibold text-gray-900">Tambah Role</h3>
            <button onclick="closeModal('modal-role')" class="text-gray-400 hover:text-gray-600"><i data-feather="x" class="w-5 h-5"></i></button>
        </div>
        <form id="form-role">
            <input type="hidden" id="role-id">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="form-label">Nama Role *</label>
                    <input type="text" id="role-nama" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Deskripsi</label>
                    <textarea id="role-deskripsi" class="form-input" rows="2"></textarea>
                </div>
                <div>
                    <label class="form-label">Permission</label>
                    <div class="border border-gray-100 rounded-xl p-4 max-h-72 overflow-y-auto space-y-4">
                        <?php foreach ($permission_groups as $module => $perms): ?>
                            <div>
                                <div class="text-xs font-bold uppercase tracking-wide text-gray-500 mb-2"><?= htmlspecialchars(str_replace('_', ' ', $module)) ?></div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <?php foreach ($perms as $perm): ?>
                                        <label class="flex items-start gap-2 text-xs text-gray-700">
                                            <input type="checkbox" class="role-perm mt-0.5" value="<?= htmlspecialchars($perm->kode) ?>">
                                            <span>
                                                <span class="font-semibold"><?= htmlspecialchars($perm->label) ?></span><br>
                                                <span class="text-gray-400"><?= htmlspecialchars($perm->kode) ?></span>
                                            </span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-role')">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitRole()">Simpan Role</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal User -->
<div id="modal-user" class="modal-overlay">
    <div class="modal-box">
        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
            <h3 id="user-modal-title" class="font-semibold text-gray-900">Tambah Akun Admin</h3>
            <button onclick="closeModal('modal-user')" class="text-gray-400 hover:text-gray-600"><i data-feather="x" class="w-5 h-5"></i></button>
        </div>
        <form id="form-user" enctype="multipart/form-data">
            <input type="hidden" id="user-id">
            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="form-label">Nama *</label>
                    <input type="text" id="user-nama" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Email</label>
                    <input type="email" id="user-email" class="form-input">
                </div>
                <div>
                    <label class="form-label">Username *</label>
                    <input type="text" id="user-username" class="form-input" required>
                </div>
                <div>
                    <label class="form-label">Password <span class="text-gray-400 normal-case">(wajib saat akun baru)</span></label>
                    <input type="password" id="user-password" class="form-input">
                </div>
                <div>
                    <label class="form-label">Role *</label>
                    <select id="user-role-id" class="form-input form-select">
                        <?php foreach ($roles as $role): ?>
                            <option value="<?= (int) $role->id ?>"><?= htmlspecialchars($role->nama) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Foto Profil</label>
                    <input type="file" id="user-foto" accept="image/*" class="form-input">
                </div>
            </div>
            <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3 rounded-b-2xl">
                <button type="button" class="btn btn-ghost" onclick="closeModal('modal-user')">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitUser()">Simpan Akun</button>
            </div>
        </form>
    </div>
</div>

<script>
    function clearRoleForm() {
        document.getElementById('role-id').value = '';
        document.getElementById('role-nama').value = '';
        document.getElementById('role-deskripsi').value = '';
        document.querySelectorAll('.role-perm').forEach(cb => cb.checked = false);
    }

    async function openRoleModal(id = null) {
        clearRoleForm();
        document.getElementById('role-modal-title').textContent = id ? 'Edit Role' : 'Tambah Role';
        if (id) {
            const d = await ajaxPost('<?= base_url('panel-admin/setting/role/get/') ?>' + id, new FormData());
            if (d.status !== 'success') {
                showToast(d.message || 'Gagal memuat role.', 'error');
                return;
            }
            const role = d.data.role;
            document.getElementById('role-id').value = role.id;
            document.getElementById('role-nama').value = role.nama || '';
            document.getElementById('role-deskripsi').value = role.deskripsi || '';
            const codes = d.data.permission_codes || [];
            document.querySelectorAll('.role-perm').forEach(cb => {
                cb.checked = codes.includes(cb.value);
            });
        }
        openModal('modal-role');
        feather.replace();
    }

    async function submitRole() {
        const id = document.getElementById('role-id').value;
        const nama = document.getElementById('role-nama').value.trim();
        if (!nama) return showToast('Nama role wajib diisi.', 'error');

        const checked = Array.from(document.querySelectorAll('.role-perm:checked')).map(cb => cb.value);
        const fd = new FormData();
        fd.append('nama', nama);
        fd.append('deskripsi', document.getElementById('role-deskripsi').value);
        fd.append('permissions_json', JSON.stringify(checked));

        const url = id
            ? '<?= base_url('panel-admin/setting/role/update/') ?>' + id
            : '<?= base_url('panel-admin/setting/role/store') ?>';

        await ajaxSubmit(url, fd, () => setTimeout(() => location.reload(), 700));
    }

    async function deleteRole(id, name) {
        if (!confirm(`Hapus role "${name}"?`)) return;
        await ajaxSubmit('<?= base_url('panel-admin/setting/role/delete/') ?>' + id, new FormData(), () => {
            setTimeout(() => location.reload(), 700);
        });
    }

    function clearUserForm() {
        document.getElementById('user-id').value = '';
        document.getElementById('user-nama').value = '';
        document.getElementById('user-email').value = '';
        document.getElementById('user-username').value = '';
        document.getElementById('user-password').value = '';
        document.getElementById('user-foto').value = '';
        const roleSelect = document.getElementById('user-role-id');
        if (roleSelect.options.length > 0) roleSelect.selectedIndex = 0;
    }

    async function openUserModal(id = null) {
        clearUserForm();
        document.getElementById('user-modal-title').textContent = id ? 'Edit Akun Admin' : 'Tambah Akun Admin';
        if (id) {
            const d = await ajaxPost('<?= base_url('panel-admin/setting/user/get/') ?>' + id, new FormData());
            if (d.status !== 'success') {
                showToast(d.message || 'Gagal memuat akun.', 'error');
                return;
            }
            const u = d.data;
            document.getElementById('user-id').value = u.id;
            document.getElementById('user-nama').value = u.nama || '';
            document.getElementById('user-email').value = u.email || '';
            document.getElementById('user-username').value = u.username || '';
            if (u.role_id) document.getElementById('user-role-id').value = u.role_id;
        }
        openModal('modal-user');
        feather.replace();
    }

    async function submitUser() {
        const id = document.getElementById('user-id').value;
        const nama = document.getElementById('user-nama').value.trim();
        const username = document.getElementById('user-username').value.trim();
        const password = document.getElementById('user-password').value;
        if (!nama || !username) return showToast('Nama dan username wajib diisi.', 'error');
        if (!id && !password) return showToast('Password wajib diisi untuk akun baru.', 'error');

        const fd = new FormData();
        fd.append('nama', nama);
        fd.append('email', document.getElementById('user-email').value.trim());
        fd.append('username', username);
        fd.append('password', password);
        fd.append('role_id', document.getElementById('user-role-id').value);
        const foto = document.getElementById('user-foto').files[0];
        if (foto) fd.append('foto', foto);

        const url = id
            ? '<?= base_url('panel-admin/setting/user/update/') ?>' + id
            : '<?= base_url('panel-admin/setting/user/store') ?>';

        await ajaxSubmit(url, fd, () => setTimeout(() => location.reload(), 700));
    }

    async function deleteUser(id, name) {
        if (!confirm(`Hapus akun "${name}"?`)) return;
        await ajaxSubmit('<?= base_url('panel-admin/setting/user/delete/') ?>' + id, new FormData(), () => {
            setTimeout(() => location.reload(), 700);
        });
    }
</script>
