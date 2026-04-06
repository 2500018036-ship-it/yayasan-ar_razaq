-- ============================================================
-- MIGRATION: Yayasan Ar-Razaq — New columns
-- Run this SQL in phpMyAdmin or MySQL CLI
-- ============================================================

-- 1. Profil table: Visi Misi background settings
ALTER TABLE `profil`
ADD COLUMN `visimisi_bg_image` VARCHAR(255) NULL DEFAULT NULL AFTER `hero_subtitle`,
ADD COLUMN `visimisi_bg_video` VARCHAR(255) NULL DEFAULT NULL AFTER `visimisi_bg_image`,
ADD COLUMN `visimisi_overlay_color` VARCHAR(20) NOT NULL DEFAULT '#052e16' AFTER `visimisi_bg_video`,
ADD COLUMN `visimisi_overlay_opacity` INT NOT NULL DEFAULT 80 AFTER `visimisi_overlay_color`;

-- 2. PPDB table: Google Maps URL
ALTER TABLE `ppdb`
ADD COLUMN `maps_url` TEXT NULL DEFAULT NULL AFTER `link_pendaftaran`;
