<?php
defined('BASEPATH') or exit('No direct script access allowed');

// ============================================================
// FRONTEND ROUTES
// ============================================================
$route['default_controller'] = 'Frontend';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Frontend Pages
$route['beranda']          = 'Frontend/index';
$route['profil']           = 'Frontend/profil';
$route['tentang-kami']     = 'Frontend/tentang_kami';
$route['struktur']         = 'Frontend/struktur';
$route['struktur/anggota/(:any)'] = 'Frontend/detail_struktur_anggota/$1';
$route['sejarah']          = 'Frontend/sejarah';
$route['visi-misi']        = 'Frontend/visi_misi';
$route['galeri']           = 'Frontend/galeri';
$route['ekskul']           = 'Frontend/ekskul';
$route['ekskul/(:any)']    = 'Frontend/detail_ekskul/$1';
$route['berita']           = 'Frontend/berita';
$route['berita/(:any)']    = 'Frontend/detail_berita/$1';
$route['ppdb']             = 'Frontend/ppdb';
$route['kontak']           = 'Frontend/kontak';

// ============================================================
// BACKEND / PANEL ADMIN ROUTES
// ============================================================
$route['panel-admin']                   = 'Admin/dashboard';
$route['panel-admin/login']             = 'Admin/login';
$route['panel-admin/do-login']          = 'Admin/do_login';
$route['panel-admin/logout']            = 'Admin/logout';
$route['panel-admin/dashboard']         = 'Admin/dashboard';

// Admin - Profil
$route['panel-admin/profil']            = 'Admin/profil';
$route['panel-admin/profil/tentang-kami'] = 'Admin/profil_tentang_kami';
$route['panel-admin/profil/struktur']     = 'Admin/struktur'; // backward compatibility
$route['panel-admin/profil/update']     = 'Admin/profil_update';
$route['panel-admin/profil/save']       = 'Admin/profil_update'; // alias used by view

// Admin - Struktur Organisasi
$route['panel-admin/struktur']                  = 'Admin/struktur';
$route['panel-admin/struktur/bagan/save']       = 'Admin/struktur_bagan_save';
$route['panel-admin/struktur/anggota/store']    = 'Admin/struktur_anggota_store';
$route['panel-admin/struktur/anggota/get/(:num)'] = 'Admin/struktur_anggota_get/$1';
$route['panel-admin/struktur/anggota/update/(:num)'] = 'Admin/struktur_anggota_update/$1';
$route['panel-admin/struktur/anggota/delete/(:num)'] = 'Admin/struktur_anggota_delete/$1';

// Admin - Sejarah
$route['panel-admin/sejarah']           = 'Admin/sejarah';
$route['panel-admin/sejarah/store']     = 'Admin/sejarah_store';
$route['panel-admin/sejarah/save']      = 'Admin/sejarah_store'; // alias used by view
$route['panel-admin/sejarah/update/(:num)'] = 'Admin/sejarah_update/$1';
$route['panel-admin/sejarah/delete/(:num)'] = 'Admin/sejarah_delete/$1';
$route['panel-admin/sejarah/delete']    = 'Admin/sejarah_delete'; // alias used by view
$route['panel-admin/sejarah/get/(:num)']    = 'Admin/sejarah_get/$1';

// Admin - Visi Misi
$route['panel-admin/visi-misi']                         = 'Admin/visi_misi';
$route['panel-admin/visi-misi/bg-save']                 = 'Admin/visi_misi_bg_save';
$route['panel-admin/visi-misi/bg-delete-image']         = 'Admin/visi_misi_bg_delete_image';
$route['panel-admin/visi-misi/bg-delete-video']         = 'Admin/visi_misi_bg_delete_video';
$route['panel-admin/visi-misi/toggle/(:num)']           = 'Admin/visi_misi_toggle/$1';
$route['panel-admin/visi-misi/store']                   = 'Admin/visi_misi_store';
$route['panel-admin/visi-misi/update/(:num)']           = 'Admin/visi_misi_update/$1';
$route['panel-admin/visi-misi/delete/(:num)']           = 'Admin/visi_misi_delete/$1';
$route['panel-admin/visi-misi/get/(:num)']              = 'Admin/visi_misi_get/$1';

// Admin - Galeri
$route['panel-admin/galeri']                = 'Admin/galeri';
$route['panel-admin/galeri/store']          = 'Admin/galeri_store';
$route['panel-admin/galeri-store']          = 'Admin/galeri_store'; // alias used by view
$route['panel-admin/galeri/update/(:num)']  = 'Admin/galeri_update/$1';
$route['panel-admin/galeri-update/(:num)']  = 'Admin/galeri_update/$1'; // alias used by view
$route['panel-admin/galeri/delete/(:num)']  = 'Admin/galeri_delete/$1';
$route['panel-admin/galeri-delete/(:num)']  = 'Admin/galeri_delete/$1'; // alias used by view
$route['panel-admin/galeri/get/(:num)']     = 'Admin/galeri_get/$1';
$route['panel-admin/galeri-get/(:num)']     = 'Admin/galeri_get/$1'; // alias used by view

// Admin - Ekskul
$route['panel-admin/ekskul']                = 'Admin/ekskul';
$route['panel-admin/ekskul/store']          = 'Admin/ekskul_store';
$route['panel-admin/ekskul/save']           = 'Admin/ekskul_store'; // alias used by view
$route['panel-admin/ekskul/update/(:num)']  = 'Admin/ekskul_update/$1';
$route['panel-admin/ekskul/delete/(:num)']  = 'Admin/ekskul_delete/$1';
$route['panel-admin/ekskul/delete']         = 'Admin/ekskul_delete'; // alias used by view
$route['panel-admin/ekskul/get/(:num)']     = 'Admin/ekskul_get/$1';

// Admin - Berita
$route['panel-admin/berita']                = 'Admin/berita';
$route['panel-admin/berita/store']          = 'Admin/berita_store';
$route['panel-admin/berita-store']          = 'Admin/berita_store'; // alias used by view
$route['panel-admin/berita/update/(:num)']  = 'Admin/berita_update/$1';
$route['panel-admin/berita-update/(:num)']  = 'Admin/berita_update/$1'; // alias used by view
$route['panel-admin/berita/delete/(:num)']  = 'Admin/berita_delete/$1';
$route['panel-admin/berita-delete/(:num)']  = 'Admin/berita_delete/$1'; // alias used by view
$route['panel-admin/berita/get/(:num)']     = 'Admin/berita_get/$1';

// Admin - PPDB
$route['panel-admin/ppdb']                  = 'Admin/ppdb';
$route['panel-admin/ppdb/store']            = 'Admin/ppdb_store';
$route['panel-admin/ppdb/update/(:num)']    = 'Admin/ppdb_update/$1';
$route['panel-admin/ppdb/delete/(:num)']    = 'Admin/ppdb_delete/$1';
$route['panel-admin/ppdb/get/(:num)']       = 'Admin/ppdb_get/$1';

// Admin - Popup Website
$route['panel-admin/popup']                 = 'Admin/popup';
$route['panel-admin/popup/update']          = 'Admin/popup_update';

// Admin - Statistik
$route['panel-admin/statistik']                = 'Admin/statistik';
$route['panel-admin/statistik/store']          = 'Admin/statistik_store';
$route['panel-admin/statistik/update/(:num)']  = 'Admin/statistik_update/$1';
$route['panel-admin/statistik/delete/(:num)']  = 'Admin/statistik_delete/$1';
$route['panel-admin/statistik/get/(:num)']     = 'Admin/statistik_get/$1';

// Admin - Profil Akun Admin
$route['panel-admin/akun']              = 'Admin/akun';
$route['panel-admin/akun/update']       = 'Admin/akun_update';

// Admin - Setting (Role, Permission, Admin User)
$route['panel-admin/setting']                      = 'Admin/setting';
$route['panel-admin/setting/role/get/(:num)']     = 'Admin/setting_role_get/$1';
$route['panel-admin/setting/role/store']           = 'Admin/setting_role_store';
$route['panel-admin/setting/role/update/(:num)']  = 'Admin/setting_role_update/$1';
$route['panel-admin/setting/role/delete/(:num)']  = 'Admin/setting_role_delete/$1';
$route['panel-admin/setting/user/get/(:num)']     = 'Admin/setting_user_get/$1';
$route['panel-admin/setting/user/store']           = 'Admin/setting_user_store';
$route['panel-admin/setting/user/update/(:num)']  = 'Admin/setting_user_update/$1';
$route['panel-admin/setting/user/delete/(:num)']  = 'Admin/setting_user_delete/$1';
