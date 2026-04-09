<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ============================================================
    // CONTENT SCHEMA GUARD
    // ============================================================
    public function ensure_content_schema()
    {
        static $booted = false;
        if ($booted) return;

        // Kolom visimisi background di tabel profil
        if ($this->db->table_exists('profil')) {
            if (!$this->db->field_exists('visimisi_bg_image', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `visimisi_bg_image` VARCHAR(255) NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('visimisi_bg_video', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `visimisi_bg_video` VARCHAR(255) NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('visimisi_overlay_color', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `visimisi_overlay_color` VARCHAR(20) NULL DEFAULT '#052e16'");
            }
            if (!$this->db->field_exists('visimisi_overlay_opacity', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `visimisi_overlay_opacity` TINYINT(3) UNSIGNED NULL DEFAULT 80");
            }
            if (!$this->db->field_exists('struktur_organisasi_judul', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `struktur_organisasi_judul` VARCHAR(255) NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('struktur_organisasi_deskripsi', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `struktur_organisasi_deskripsi` TEXT NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('struktur_organisasi_gambar', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `struktur_organisasi_gambar` VARCHAR(255) NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('about_section_label', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `about_section_label` VARCHAR(120) NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('about_section_badge', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `about_section_badge` VARCHAR(120) NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('about_section_cta_text', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `about_section_cta_text` VARCHAR(120) NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('about_section_cta_link', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `about_section_cta_link` VARCHAR(255) NULL DEFAULT NULL");
            }
            if (!$this->db->field_exists('about_section_media', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `about_section_media` VARCHAR(255) NULL DEFAULT NULL");
            }
            // Hero slider images 2-5
            foreach ([2, 3, 4, 5] as $slide_n) {
                $col = 'hero_image_' . $slide_n;
                if (!$this->db->field_exists($col, 'profil')) {
                    $this->db->query("ALTER TABLE `profil` ADD COLUMN `{$col}` VARCHAR(255) NULL DEFAULT NULL");
                }
            }
            // YouTube embed URL for About section
            if (!$this->db->field_exists('about_section_video_url', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `about_section_video_url` VARCHAR(255) NULL DEFAULT NULL");
            }
            // TikTok social media link
            if (!$this->db->field_exists('tiktok', 'profil')) {
                $this->db->query("ALTER TABLE `profil` ADD COLUMN `tiktok` VARCHAR(255) NULL DEFAULT NULL");
            }
        }

        if ($this->db->table_exists('galeri') && !$this->db->field_exists('label', 'galeri')) {
            $this->db->query("ALTER TABLE `galeri` ADD COLUMN `label` VARCHAR(120) NULL DEFAULT NULL AFTER `kategori`");
        }

        if ($this->db->table_exists('ekskul') && !$this->db->field_exists('slug', 'ekskul')) {
            $this->db->query("ALTER TABLE `ekskul` ADD COLUMN `slug` VARCHAR(190) NULL DEFAULT NULL AFTER `nama`");
        }

        if ($this->db->table_exists('ekskul') && !$this->db->field_exists('detail_lengkap', 'ekskul')) {
            $this->db->query("ALTER TABLE `ekskul` ADD COLUMN `detail_lengkap` LONGTEXT NULL DEFAULT NULL AFTER `deskripsi`");
        }

        if ($this->db->table_exists('ekskul')) {
            $idx = $this->db->query("SHOW INDEX FROM `ekskul` WHERE Key_name = 'idx_ekskul_slug'")->result();
            if (empty($idx)) {
                $this->db->query("ALTER TABLE `ekskul` ADD INDEX `idx_ekskul_slug` (`slug`)");
            }
            $this->db->query("UPDATE `ekskul` SET `slug` = CONCAT('ekskul-', `id`) WHERE `slug` IS NULL OR TRIM(`slug`) = ''");
        }

        // Tabel popup promosi frontend
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `popup_promosi` (
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `gambar` VARCHAR(255) DEFAULT NULL,
                `target_link` VARCHAR(255) DEFAULT NULL,
                `target_mode` VARCHAR(20) NOT NULL DEFAULT '_self',
                `status` TINYINT(1) NOT NULL DEFAULT 1,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `idx_status` (`status`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        // Tabel anggota struktur organisasi
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `struktur_anggota` (
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `nama` VARCHAR(150) NOT NULL,
                `jabatan` VARCHAR(150) NOT NULL,
                `slug` VARCHAR(190) DEFAULT NULL,
                `foto` VARCHAR(255) DEFAULT NULL,
                `deskripsi_lengkap` LONGTEXT DEFAULT NULL,
                `urutan` INT(11) NOT NULL DEFAULT 1,
                `status` TINYINT(1) NOT NULL DEFAULT 1,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                KEY `idx_status` (`status`),
                KEY `idx_urutan` (`urutan`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        if ($this->db->table_exists('struktur_anggota')) {
            if (!$this->db->field_exists('slug', 'struktur_anggota')) {
                $this->db->query("ALTER TABLE `struktur_anggota` ADD COLUMN `slug` VARCHAR(190) NULL DEFAULT NULL AFTER `jabatan`");
            }
            $idx = $this->db->query("SHOW INDEX FROM `struktur_anggota` WHERE Key_name = 'idx_struktur_slug'")->result();
            if (empty($idx)) {
                $this->db->query("ALTER TABLE `struktur_anggota` ADD INDEX `idx_struktur_slug` (`slug`)");
            }
            $this->db->query("UPDATE `struktur_anggota` SET `slug` = CONCAT('anggota-', `id`) WHERE `slug` IS NULL OR TRIM(`slug`) = ''");
        }

        $booted = true;
    }

    // ============================================================
    // RBAC SCHEMA + SEED
    // ============================================================
    public function ensure_rbac_schema()
    {
        static $booted = false;
        if ($booted) return;

        // Roles
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `admin_roles` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `nama` VARCHAR(100) NOT NULL,
                `deskripsi` VARCHAR(255) DEFAULT NULL,
                `is_system` TINYINT(1) NOT NULL DEFAULT 0,
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_admin_roles_nama` (`nama`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        // Permissions
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `admin_permissions` (
                `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                `kode` VARCHAR(120) NOT NULL,
                `modul` VARCHAR(80) NOT NULL,
                `label` VARCHAR(120) NOT NULL,
                `deskripsi` VARCHAR(255) DEFAULT NULL,
                `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE KEY `uniq_admin_permissions_kode` (`kode`),
                KEY `idx_admin_permissions_modul` (`modul`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        // Role ↔ Permission pivot
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `admin_role_permissions` (
                `role_id` INT UNSIGNED NOT NULL,
                `permission_id` INT UNSIGNED NOT NULL,
                PRIMARY KEY (`role_id`, `permission_id`),
                KEY `idx_arp_permission_id` (`permission_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        // Add role_id to admin table if missing
        if (!$this->db->field_exists('role_id', 'admin')) {
            $this->db->query("ALTER TABLE `admin` ADD COLUMN `role_id` INT UNSIGNED NULL DEFAULT NULL AFTER `foto`");
        }

        // Add index role_id if missing
        $idx = $this->db->query("SHOW INDEX FROM `admin` WHERE Key_name = 'idx_admin_role_id'")->result();
        if (empty($idx)) {
            $this->db->query("ALTER TABLE `admin` ADD INDEX `idx_admin_role_id` (`role_id`)");
        }

        // Seed default roles
        $default_roles = [
            ['nama' => 'Super Admin', 'deskripsi' => 'Akses penuh semua fitur', 'is_system' => 1],
            ['nama' => 'Editor', 'deskripsi' => 'Kelola konten tanpa akses pengaturan admin', 'is_system' => 1],
            ['nama' => 'Viewer', 'deskripsi' => 'Akses lihat data dan ubah profil akun sendiri', 'is_system' => 1],
        ];
        foreach ($default_roles as $role) {
            $exists = $this->db->where('nama', $role['nama'])->count_all_results('admin_roles');
            if (!$exists) $this->db->insert('admin_roles', $role);
        }

        // Seed default permissions
        $permission_catalog = $this->get_permission_catalog();
        foreach ($permission_catalog as $perm) {
            $exists = $this->db->where('kode', $perm['kode'])->count_all_results('admin_permissions');
            if (!$exists) $this->db->insert('admin_permissions', $perm);
        }

        // Resolve role ids
        $roles = $this->db->get('admin_roles')->result();
        $role_ids = [];
        foreach ($roles as $role) $role_ids[$role->nama] = (int) $role->id;
        $super_role_id = isset($role_ids['Super Admin']) ? $role_ids['Super Admin'] : 0;
        $editor_role_id = isset($role_ids['Editor']) ? $role_ids['Editor'] : 0;
        $viewer_role_id = isset($role_ids['Viewer']) ? $role_ids['Viewer'] : 0;

        // Super Admin harus selalu punya akses penuh (tambahkan permission baru jika ada)
        if ($super_role_id) {
            $all_codes = array_map(function ($p) {
                return $p['kode'];
            }, $permission_catalog);
            $existing_codes = $this->get_role_permission_codes($super_role_id);
            $missing_codes = array_values(array_diff($all_codes, $existing_codes));
            if (!empty($missing_codes)) {
                $merged = array_values(array_unique(array_merge($existing_codes, $missing_codes)));
                $this->set_role_permissions($super_role_id, $merged);
            }
        }

        // Editor permissions
        if ($editor_role_id && count($this->get_role_permission_codes($editor_role_id)) === 0) {
            $editor_codes = [
                'dashboard.view',
                'profil.view',
                'profil.edit',
                'statistik.view',
                'statistik.create',
                'statistik.edit',
                'sejarah.view',
                'sejarah.create',
                'sejarah.edit',
                'visi_misi.view',
                'visi_misi.create',
                'visi_misi.edit',
                'galeri.view',
                'galeri.create',
                'galeri.edit',
                'ekskul.view',
                'ekskul.create',
                'ekskul.edit',
                'berita.view',
                'berita.create',
                'berita.edit',
                'ppdb.view',
                'ppdb.create',
                'ppdb.edit',
                'struktur.view',
                'struktur.create',
                'struktur.edit',
                'popup.view',
                'popup.edit',
                'akun.view',
                'akun.edit',
            ];
            $this->set_role_permissions($editor_role_id, $editor_codes);
        }

        // Viewer permissions
        if ($viewer_role_id && count($this->get_role_permission_codes($viewer_role_id)) === 0) {
            $viewer_codes = [
                'dashboard.view',
                'profil.view',
                'statistik.view',
                'sejarah.view',
                'visi_misi.view',
                'galeri.view',
                'ekskul.view',
                'berita.view',
                'ppdb.view',
                'struktur.view',
                'popup.view',
                'akun.view',
                'akun.edit',
            ];
            $this->set_role_permissions($viewer_role_id, $viewer_codes);
        }

        // Existing admins fallback to Super Admin
        if ($super_role_id) {
            $this->db->set('role_id', $super_role_id)
                ->where('role_id IS NULL', null, false)
                ->or_where('role_id', 0)
                ->update('admin');
        }

        $booted = true;
    }

    public function get_permission_catalog()
    {
        return [
            ['kode' => 'dashboard.view', 'modul' => 'dashboard', 'label' => 'Lihat Dashboard', 'deskripsi' => 'Akses halaman dashboard'],
            ['kode' => 'profil.view', 'modul' => 'profil', 'label' => 'Lihat Profil Yayasan', 'deskripsi' => 'Akses halaman profil yayasan'],
            ['kode' => 'profil.edit', 'modul' => 'profil', 'label' => 'Edit Profil Yayasan', 'deskripsi' => 'Ubah data profil yayasan'],
            ['kode' => 'statistik.view', 'modul' => 'statistik', 'label' => 'Lihat Statistik', 'deskripsi' => 'Akses menu statistik'],
            ['kode' => 'statistik.create', 'modul' => 'statistik', 'label' => 'Tambah Statistik', 'deskripsi' => 'Tambah data statistik'],
            ['kode' => 'statistik.edit', 'modul' => 'statistik', 'label' => 'Edit Statistik', 'deskripsi' => 'Edit data statistik'],
            ['kode' => 'statistik.delete', 'modul' => 'statistik', 'label' => 'Hapus Statistik', 'deskripsi' => 'Hapus data statistik'],
            ['kode' => 'sejarah.view', 'modul' => 'sejarah', 'label' => 'Lihat Sejarah', 'deskripsi' => 'Akses menu sejarah'],
            ['kode' => 'sejarah.create', 'modul' => 'sejarah', 'label' => 'Tambah Sejarah', 'deskripsi' => 'Tambah data sejarah'],
            ['kode' => 'sejarah.edit', 'modul' => 'sejarah', 'label' => 'Edit Sejarah', 'deskripsi' => 'Edit data sejarah'],
            ['kode' => 'sejarah.delete', 'modul' => 'sejarah', 'label' => 'Hapus Sejarah', 'deskripsi' => 'Hapus data sejarah'],
            ['kode' => 'visi_misi.view', 'modul' => 'visi_misi', 'label' => 'Lihat Visi Misi', 'deskripsi' => 'Akses menu visi misi'],
            ['kode' => 'visi_misi.create', 'modul' => 'visi_misi', 'label' => 'Tambah Visi Misi', 'deskripsi' => 'Tambah data visi/misi'],
            ['kode' => 'visi_misi.edit', 'modul' => 'visi_misi', 'label' => 'Edit Visi Misi', 'deskripsi' => 'Edit data visi/misi'],
            ['kode' => 'visi_misi.delete', 'modul' => 'visi_misi', 'label' => 'Hapus Visi Misi', 'deskripsi' => 'Hapus data visi/misi'],
            ['kode' => 'galeri.view', 'modul' => 'galeri', 'label' => 'Lihat Galeri', 'deskripsi' => 'Akses menu galeri'],
            ['kode' => 'galeri.create', 'modul' => 'galeri', 'label' => 'Tambah Galeri', 'deskripsi' => 'Tambah foto galeri'],
            ['kode' => 'galeri.edit', 'modul' => 'galeri', 'label' => 'Edit Galeri', 'deskripsi' => 'Edit foto galeri'],
            ['kode' => 'galeri.delete', 'modul' => 'galeri', 'label' => 'Hapus Galeri', 'deskripsi' => 'Hapus foto galeri'],
            ['kode' => 'ekskul.view', 'modul' => 'ekskul', 'label' => 'Lihat Ekskul', 'deskripsi' => 'Akses menu ekstrakurikuler'],
            ['kode' => 'ekskul.create', 'modul' => 'ekskul', 'label' => 'Tambah Ekskul', 'deskripsi' => 'Tambah data ekskul'],
            ['kode' => 'ekskul.edit', 'modul' => 'ekskul', 'label' => 'Edit Ekskul', 'deskripsi' => 'Edit data ekskul'],
            ['kode' => 'ekskul.delete', 'modul' => 'ekskul', 'label' => 'Hapus Ekskul', 'deskripsi' => 'Hapus data ekskul'],
            ['kode' => 'berita.view', 'modul' => 'berita', 'label' => 'Lihat Berita', 'deskripsi' => 'Akses menu berita'],
            ['kode' => 'berita.create', 'modul' => 'berita', 'label' => 'Tambah Berita', 'deskripsi' => 'Tambah berita'],
            ['kode' => 'berita.edit', 'modul' => 'berita', 'label' => 'Edit Berita', 'deskripsi' => 'Edit berita'],
            ['kode' => 'berita.delete', 'modul' => 'berita', 'label' => 'Hapus Berita', 'deskripsi' => 'Hapus berita'],
            ['kode' => 'ppdb.view', 'modul' => 'ppdb', 'label' => 'Lihat PPDB', 'deskripsi' => 'Akses menu PPDB'],
            ['kode' => 'ppdb.create', 'modul' => 'ppdb', 'label' => 'Tambah PPDB', 'deskripsi' => 'Tambah data PPDB'],
            ['kode' => 'ppdb.edit', 'modul' => 'ppdb', 'label' => 'Edit PPDB', 'deskripsi' => 'Edit data PPDB'],
            ['kode' => 'ppdb.delete', 'modul' => 'ppdb', 'label' => 'Hapus PPDB', 'deskripsi' => 'Hapus data PPDB'],
            ['kode' => 'struktur.view', 'modul' => 'struktur', 'label' => 'Lihat Struktur Organisasi', 'deskripsi' => 'Akses menu struktur organisasi'],
            ['kode' => 'struktur.create', 'modul' => 'struktur', 'label' => 'Tambah Anggota Struktur', 'deskripsi' => 'Tambah data anggota struktur'],
            ['kode' => 'struktur.edit', 'modul' => 'struktur', 'label' => 'Edit Struktur Organisasi', 'deskripsi' => 'Edit bagan dan data anggota struktur'],
            ['kode' => 'struktur.delete', 'modul' => 'struktur', 'label' => 'Hapus Anggota Struktur', 'deskripsi' => 'Hapus data anggota struktur'],
            ['kode' => 'popup.view', 'modul' => 'popup', 'label' => 'Lihat Popup Website', 'deskripsi' => 'Akses menu popup website'],
            ['kode' => 'popup.edit', 'modul' => 'popup', 'label' => 'Edit Popup Website', 'deskripsi' => 'Ubah gambar dan link popup website'],
            ['kode' => 'akun.view', 'modul' => 'akun', 'label' => 'Lihat Akun Sendiri', 'deskripsi' => 'Akses profil akun sendiri'],
            ['kode' => 'akun.edit', 'modul' => 'akun', 'label' => 'Edit Akun Sendiri', 'deskripsi' => 'Ubah akun sendiri'],
            ['kode' => 'setting.view', 'modul' => 'setting', 'label' => 'Lihat Pengaturan', 'deskripsi' => 'Akses menu pengaturan admin'],
            ['kode' => 'setting.user.create', 'modul' => 'setting', 'label' => 'Tambah Akun Admin', 'deskripsi' => 'Buat akun admin baru'],
            ['kode' => 'setting.user.edit', 'modul' => 'setting', 'label' => 'Edit Akun Admin', 'deskripsi' => 'Edit akun admin'],
            ['kode' => 'setting.user.delete', 'modul' => 'setting', 'label' => 'Hapus Akun Admin', 'deskripsi' => 'Hapus akun admin'],
            ['kode' => 'setting.role.create', 'modul' => 'setting', 'label' => 'Tambah Role', 'deskripsi' => 'Buat role baru'],
            ['kode' => 'setting.role.edit', 'modul' => 'setting', 'label' => 'Edit Role', 'deskripsi' => 'Edit role dan permission'],
            ['kode' => 'setting.role.delete', 'modul' => 'setting', 'label' => 'Hapus Role', 'deskripsi' => 'Hapus role'],
        ];
    }

    // ============================================================
    // GENERIC CRUD METHODS
    // ============================================================

    public function get_all($table, $where = array(), $order_by = 'urutan ASC', $limit = 0)
    {
        if (!empty($where)) $this->db->where($where);
        if ($order_by) $this->db->order_by($order_by);
        if ($limit > 0) $this->db->limit($limit);
        return $this->db->get($table)->result();
    }

    public function get_by_id($table, $id)
    {
        return $this->db->get_where($table, ['id' => $id])->row();
    }

    public function insert($table, $data)
    {
        return $this->db->insert($table, $data);
    }

    public function update($table, $data, $id)
    {
        return $this->db->where('id', $id)->update($table, $data);
    }

    public function delete($table, $id)
    {
        return $this->db->where('id', $id)->delete($table);
    }

    public function count($table, $where = array())
    {
        if (!empty($where)) $this->db->where($where);
        return $this->db->count_all_results($table);
    }

    // ============================================================
    // PROFIL
    // ============================================================
    public function get_profil()
    {
        return $this->db->get('profil')->row();
    }

    public function update_profil($data)
    {
        $exists = $this->db->count_all_results('profil');
        if ($exists > 0) {
            return $this->db->update('profil', $data);
        } else {
            return $this->db->insert('profil', $data);
        }
    }

    // ============================================================
    // SEJARAH
    // ============================================================
    public function get_sejarah_aktif()
    {
        return $this->db->where('status', 1)->order_by('urutan', 'ASC')->get('sejarah')->result();
    }

    public function get_all_sejarah()
    {
        return $this->db->order_by('urutan', 'ASC')->get('sejarah')->result();
    }

    // ============================================================
    // VISI MISI
    // ============================================================
    public function get_visi_misi($tipe = null)
    {
        if ($tipe) $this->db->where('tipe', $tipe);
        $this->db->where('status', 1);
        return $this->db->order_by('urutan', 'ASC')->get('visi_misi')->result();
    }

    public function get_all_visi_misi()
    {
        return $this->db->order_by('tipe', 'ASC')->order_by('urutan', 'ASC')->get('visi_misi')->result();
    }

    // ============================================================
    // GALERI
    // ============================================================
    public function get_galeri_aktif($kategori = null, $limit = 0, $label = null)
    {
        $this->db->where('status', 1);
        if ($kategori) $this->db->where('kategori', $kategori);
        if ($label) $this->db->where('label', $label);
        $this->db->order_by('urutan', 'ASC');
        if ($limit > 0) $this->db->limit($limit);
        return $this->db->get('galeri')->result();
    }

    public function get_all_galeri()
    {
        return $this->db->order_by('urutan', 'ASC')->get('galeri')->result();
    }

    public function get_kategori_galeri()
    {
        return $this->db->select('kategori')->distinct()->get('galeri')->result();
    }

    public function get_label_galeri($only_active = true)
    {
        if ($only_active) $this->db->where('status', 1);
        $this->db->where('label IS NOT NULL', null, false);
        $this->db->where("TRIM(label) <> ''", null, false);
        return $this->db->select('label')->distinct()->order_by('label', 'ASC')->get('galeri')->result();
    }

    // ============================================================
    // EKSKUL
    // ============================================================
    public function get_ekskul_aktif()
    {
        return $this->db->where('status', 1)->order_by('urutan', 'ASC')->get('ekskul')->result();
    }

    public function get_all_ekskul()
    {
        return $this->db->order_by('urutan', 'ASC')->get('ekskul')->result();
    }

    public function get_ekskul_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->where('status', 1)->get('ekskul')->row();
    }

    public function get_ekskul_lainnya($exclude_id = 0, $limit = 3)
    {
        $this->db->where('status', 1);
        if ((int) $exclude_id > 0) {
            $this->db->where('id !=', (int) $exclude_id);
        }
        return $this->db->order_by('urutan', 'ASC')->limit((int) $limit)->get('ekskul')->result();
    }

    public function ekskul_slug_exists($slug, $exclude_id = 0)
    {
        $this->db->where('slug', $slug);
        if ((int) $exclude_id > 0) {
            $this->db->where('id !=', (int) $exclude_id);
        }
        return $this->db->count_all_results('ekskul') > 0;
    }

    // ============================================================
    // BERITA
    // ============================================================
    public function get_berita_aktif($limit = 0, $kategori = null)
    {
        $this->db->where('status', 1);
        if ($kategori) $this->db->where('kategori', $kategori);
        $this->db->order_by('tanggal_publish', 'DESC');
        if ($limit > 0) $this->db->limit($limit);
        return $this->db->get('berita')->result();
    }

    public function get_all_berita()
    {
        return $this->db->order_by('tanggal_publish', 'DESC')->get('berita')->result();
    }

    public function get_berita_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->where('status', 1)->get('berita')->row();
    }

    public function increment_views($id)
    {
        $this->db->set('views', 'views + 1', FALSE)->where('id', $id)->update('berita');
    }

    public function slug_exists($slug, $exclude_id = 0)
    {
        $this->db->where('slug', $slug);
        if ($exclude_id) $this->db->where('id !=', $exclude_id);
        return $this->db->count_all_results('berita') > 0;
    }

    // ============================================================
    // PPDB
    // ============================================================
    public function get_ppdb_aktif()
    {
        return $this->db->where('status', 1)->order_by('id', 'DESC')->limit(1)->get('ppdb')->row();
    }

    public function get_all_ppdb()
    {
        return $this->db->order_by('id', 'DESC')->get('ppdb')->result();
    }

    // ============================================================
    // STATISTIK
    // ============================================================
    public function get_statistik()
    {
        return $this->db->where('status', 1)->order_by('urutan', 'ASC')->get('statistik')->result();
    }

    public function get_all_statistik()
    {
        return $this->db->order_by('urutan', 'ASC')->get('statistik')->result();
    }

    // ============================================================
    // STRUKTUR ORGANISASI
    // ============================================================
    public function get_struktur_anggota_aktif()
    {
        return $this->db->where('status', 1)->order_by('urutan', 'ASC')->order_by('id', 'ASC')->get('struktur_anggota')->result();
    }

    public function get_all_struktur_anggota()
    {
        return $this->db->order_by('urutan', 'ASC')->order_by('id', 'ASC')->get('struktur_anggota')->result();
    }

    public function get_struktur_anggota_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->where('status', 1)->get('struktur_anggota')->row();
    }

    public function struktur_anggota_slug_exists($slug, $exclude_id = 0)
    {
        $this->db->where('slug', $slug);
        if ((int) $exclude_id > 0) {
            $this->db->where('id !=', (int) $exclude_id);
        }
        return $this->db->count_all_results('struktur_anggota') > 0;
    }

    // ============================================================
    // POPUP WEBSITE
    // ============================================================
    public function get_popup_aktif()
    {
        return $this->db->where('status', 1)->order_by('id', 'DESC')->limit(1)->get('popup_promosi')->row();
    }

    public function get_popup_admin()
    {
        return $this->db->order_by('id', 'DESC')->limit(1)->get('popup_promosi')->row();
    }

    public function save_popup($data)
    {
        $existing = $this->get_popup_admin();
        if ($existing) {
            return $this->db->where('id', (int) $existing->id)->update('popup_promosi', $data);
        }
        return $this->db->insert('popup_promosi', $data);
    }

    // ============================================================
    // ADMIN AUTH
    // ============================================================
    public function get_admin_by_username($username)
    {
        return $this->db->select('a.*, r.nama AS role_nama')
            ->from('admin a')
            ->join('admin_roles r', 'r.id = a.role_id', 'left')
            ->where('a.username', $username)
            ->get()
            ->row();
    }

    public function get_admin_by_id($id)
    {
        return $this->db->select('a.*, r.nama AS role_nama')
            ->from('admin a')
            ->join('admin_roles r', 'r.id = a.role_id', 'left')
            ->where('a.id', $id)
            ->get()
            ->row();
    }

    public function update_admin($data, $id)
    {
        return $this->db->where('id', $id)->update('admin', $data);
    }

    public function get_admin_permissions($admin_id)
    {
        $rows = $this->db->select('p.kode')
            ->from('admin a')
            ->join('admin_role_permissions rp', 'rp.role_id = a.role_id', 'inner')
            ->join('admin_permissions p', 'p.id = rp.permission_id', 'inner')
            ->where('a.id', (int) $admin_id)
            ->order_by('p.kode', 'ASC')
            ->get()
            ->result_array();

        return array_column($rows, 'kode');
    }

    public function get_all_permissions()
    {
        return $this->db->order_by('modul', 'ASC')->order_by('label', 'ASC')->get('admin_permissions')->result();
    }

    public function get_all_roles()
    {
        return $this->db->select('r.*, COUNT(DISTINCT a.id) AS total_admin, COUNT(DISTINCT rp.permission_id) AS total_permission')
            ->from('admin_roles r')
            ->join('admin a', 'a.role_id = r.id', 'left')
            ->join('admin_role_permissions rp', 'rp.role_id = r.id', 'left')
            ->group_by('r.id')
            ->order_by('r.id', 'ASC')
            ->get()
            ->result();
    }

    public function get_role_by_id($id)
    {
        return $this->db->where('id', (int) $id)->get('admin_roles')->row();
    }

    public function get_role_by_name($name)
    {
        return $this->db->where('nama', $name)->get('admin_roles')->row();
    }

    public function role_name_exists($name, $exclude_id = 0)
    {
        $this->db->where('nama', $name);
        if ($exclude_id) $this->db->where('id !=', (int) $exclude_id);
        return $this->db->count_all_results('admin_roles') > 0;
    }

    public function get_role_permission_codes($role_id)
    {
        $rows = $this->db->select('p.kode')
            ->from('admin_role_permissions rp')
            ->join('admin_permissions p', 'p.id = rp.permission_id', 'inner')
            ->where('rp.role_id', (int) $role_id)
            ->order_by('p.kode', 'ASC')
            ->get()
            ->result_array();
        return array_column($rows, 'kode');
    }

    public function set_role_permissions($role_id, $permission_codes = [])
    {
        $role_id = (int) $role_id;
        $codes = array_values(array_unique(array_filter((array) $permission_codes)));

        $this->db->where('role_id', $role_id)->delete('admin_role_permissions');
        if (empty($codes)) return true;

        $perms = $this->db->select('id')
            ->where_in('kode', $codes)
            ->get('admin_permissions')
            ->result();

        $batch = [];
        foreach ($perms as $p) {
            $batch[] = [
                'role_id' => $role_id,
                'permission_id' => (int) $p->id,
            ];
        }
        if (!empty($batch)) {
            return $this->db->insert_batch('admin_role_permissions', $batch);
        }
        return true;
    }

    public function create_role($data, $permission_codes = [])
    {
        $this->db->trans_start();
        $this->db->insert('admin_roles', $data);
        $role_id = (int) $this->db->insert_id();
        $this->set_role_permissions($role_id, $permission_codes);
        $this->db->trans_complete();
        return $this->db->trans_status() ? $role_id : 0;
    }

    public function update_role_with_permissions($role_id, $data, $permission_codes = [])
    {
        $this->db->trans_start();
        $this->db->where('id', (int) $role_id)->update('admin_roles', $data);
        $this->set_role_permissions($role_id, $permission_codes);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_role($role_id)
    {
        $role_id = (int) $role_id;
        $this->db->trans_start();
        $this->db->where('role_id', $role_id)->delete('admin_role_permissions');
        $this->db->where('id', $role_id)->delete('admin_roles');
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function count_admin_by_role($role_id)
    {
        return (int) $this->db->where('role_id', (int) $role_id)->count_all_results('admin');
    }

    public function get_all_admin_with_roles()
    {
        return $this->db->select('a.*, r.nama AS role_nama')
            ->from('admin a')
            ->join('admin_roles r', 'r.id = a.role_id', 'left')
            ->order_by('a.id', 'ASC')
            ->get()
            ->result();
    }

    public function create_admin_user($data)
    {
        return $this->db->insert('admin', $data);
    }

    public function update_admin_user($id, $data)
    {
        return $this->db->where('id', (int) $id)->update('admin', $data);
    }

    public function delete_admin_user($id)
    {
        return $this->db->where('id', (int) $id)->delete('admin');
    }

    public function username_exists($username, $exclude_id = 0)
    {
        $this->db->where('username', $username);
        if ($exclude_id) $this->db->where('id !=', (int) $exclude_id);
        return $this->db->count_all_results('admin') > 0;
    }

    // ============================================================
    // DASHBOARD STATS
    // ============================================================
    public function get_dashboard_stats()
    {
        return [
            'total_berita'  => $this->db->count_all('berita'),
            'total_galeri'  => $this->db->count_all('galeri'),
            'total_ekskul'  => $this->db->count_all('ekskul'),
            'total_sejarah' => $this->db->count_all('sejarah'),
        ];
    }
}
