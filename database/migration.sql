-- ============================================================
-- MIGRATION: Yayasan Ar-Razaq — New columns
-- Run this SQL in phpMyAdmin or MySQL CLI
-- ============================================================

-- 1. Profil table: Visi Misi background settings
ALTER TABLE `profil`
ADD COLUMN IF NOT EXISTS `visimisi_bg_image` VARCHAR(255) NULL DEFAULT NULL AFTER `hero_subtitle`,
ADD COLUMN IF NOT EXISTS `visimisi_bg_video` VARCHAR(255) NULL DEFAULT NULL AFTER `visimisi_bg_image`,
ADD COLUMN IF NOT EXISTS `visimisi_overlay_color` VARCHAR(20) NOT NULL DEFAULT '#052e16' AFTER `visimisi_bg_video`,
ADD COLUMN IF NOT EXISTS `visimisi_overlay_opacity` INT NOT NULL DEFAULT 80 AFTER `visimisi_overlay_color`,
ADD COLUMN IF NOT EXISTS `struktur_organisasi_judul` VARCHAR(255) NULL DEFAULT NULL AFTER `visimisi_overlay_opacity`,
ADD COLUMN IF NOT EXISTS `struktur_organisasi_deskripsi` TEXT NULL DEFAULT NULL AFTER `struktur_organisasi_judul`,
ADD COLUMN IF NOT EXISTS `struktur_organisasi_gambar` VARCHAR(255) NULL DEFAULT NULL AFTER `struktur_organisasi_deskripsi`;

-- 2. PPDB table: Google Maps URL
ALTER TABLE `ppdb`
ADD COLUMN IF NOT EXISTS `maps_url` TEXT NULL DEFAULT NULL AFTER `link_pendaftaran`;

-- 3. Admin RBAC tables
CREATE TABLE IF NOT EXISTS `admin_roles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` VARCHAR(100) NOT NULL,
  `deskripsi` VARCHAR(255) DEFAULT NULL,
  `is_system` TINYINT(1) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_admin_roles_nama` (`nama`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `admin_role_permissions` (
  `role_id` INT UNSIGNED NOT NULL,
  `permission_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `permission_id`),
  KEY `idx_arp_permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `admin`
ADD COLUMN IF NOT EXISTS `role_id` INT UNSIGNED NULL DEFAULT NULL AFTER `foto`,
ADD INDEX `idx_admin_role_id` (`role_id`);

-- 4. Galeri: label untuk sortir dinamis di frontend
ALTER TABLE `galeri`
ADD COLUMN IF NOT EXISTS `label` VARCHAR(120) NULL DEFAULT NULL AFTER `kategori`;

-- 5. Ekskul: slug + detail lengkap untuk halaman detail
ALTER TABLE `ekskul`
ADD COLUMN IF NOT EXISTS `slug` VARCHAR(190) NULL DEFAULT NULL AFTER `nama`,
ADD COLUMN IF NOT EXISTS `detail_lengkap` LONGTEXT NULL DEFAULT NULL AFTER `deskripsi`;

-- Backfill slug data lama jika masih kosong
UPDATE `ekskul`
SET `slug` = CONCAT('ekskul-', `id`)
WHERE `slug` IS NULL OR TRIM(`slug`) = '';
