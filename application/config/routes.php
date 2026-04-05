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
$route['sejarah']          = 'Frontend/sejarah';
$route['visi-misi']        = 'Frontend/visi_misi';
$route['galeri']           = 'Frontend/galeri';
$route['ekskul']           = 'Frontend/ekskul';
$route['berita']           = 'Frontend/berita';
$route['berita/(:any)']    = 'Frontend/detail_berita/$1';
$route['ppdb']             = 'Frontend/ppdb';
$route['kontak']           = 'Frontend/kontak';

// ============================================================
// BACKEND / PANEL ADMIN ROUTES
// ============================================================
$route['panel-admin']                   = 'Admin/dashboard';
$route['panel-admin/login']             = 'Admin/login';
$route['panel-admin/logout']            = 'Admin/logout';
$route['panel-admin/dashboard']         = 'Admin/dashboard';

// Admin - Profil
$route['panel-admin/profil']            = 'Admin/profil';
$route['panel-admin/profil/update']     = 'Admin/profil_update';

// Admin - Sejarah
$route['panel-admin/sejarah']           = 'Admin/sejarah';
$route['panel-admin/sejarah/store']     = 'Admin/sejarah_store';
$route['panel-admin/sejarah/update/(:num)'] = 'Admin/sejarah_update/$1';
$route['panel-admin/sejarah/delete/(:num)'] = 'Admin/sejarah_delete/$1';
$route['panel-admin/sejarah/get/(:num)']    = 'Admin/sejarah_get/$1';

// Admin - Visi Misi
$route['panel-admin/visi-misi']                  = 'Admin/visi_misi';
$route['panel-admin/visi-misi/store']            = 'Admin/visi_misi_store';
$route['panel-admin/visi-misi/update/(:num)']    = 'Admin/visi_misi_update/$1';
$route['panel-admin/visi-misi/delete/(:num)']    = 'Admin/visi_misi_delete/$1';
$route['panel-admin/visi-misi/get/(:num)']       = 'Admin/visi_misi_get/$1';

// Admin - Galeri
$route['panel-admin/galeri']                = 'Admin/galeri';
$route['panel-admin/galeri/store']          = 'Admin/galeri_store';
$route['panel-admin/galeri/update/(:num)']  = 'Admin/galeri_update/$1';
$route['panel-admin/galeri/delete/(:num)']  = 'Admin/galeri_delete/$1';
$route['panel-admin/galeri/get/(:num)']     = 'Admin/galeri_get/$1';

// Admin - Ekskul
$route['panel-admin/ekskul']                = 'Admin/ekskul';
$route['panel-admin/ekskul/store']          = 'Admin/ekskul_store';
$route['panel-admin/ekskul/update/(:num)']  = 'Admin/ekskul_update/$1';
$route['panel-admin/ekskul/delete/(:num)']  = 'Admin/ekskul_delete/$1';
$route['panel-admin/ekskul/get/(:num)']     = 'Admin/ekskul_get/$1';

// Admin - Berita
$route['panel-admin/berita']                = 'Admin/berita';
$route['panel-admin/berita/store']          = 'Admin/berita_store';
$route['panel-admin/berita/update/(:num)']  = 'Admin/berita_update/$1';
$route['panel-admin/berita/delete/(:num)']  = 'Admin/berita_delete/$1';
$route['panel-admin/berita/get/(:num)']     = 'Admin/berita_get/$1';

// Admin - PPDB
$route['panel-admin/ppdb']                  = 'Admin/ppdb';
$route['panel-admin/ppdb/store']            = 'Admin/ppdb_store';
$route['panel-admin/ppdb/update/(:num)']    = 'Admin/ppdb_update/$1';
$route['panel-admin/ppdb/delete/(:num)']    = 'Admin/ppdb_delete/$1';
$route['panel-admin/ppdb/get/(:num)']       = 'Admin/ppdb_get/$1';

// Admin - Statistik
$route['panel-admin/statistik']                = 'Admin/statistik';
$route['panel-admin/statistik/store']          = 'Admin/statistik_store';
$route['panel-admin/statistik/update/(:num)']  = 'Admin/statistik_update/$1';
$route['panel-admin/statistik/delete/(:num)']  = 'Admin/statistik_delete/$1';
$route['panel-admin/statistik/get/(:num)']     = 'Admin/statistik_get/$1';

// Admin - Profil Akun Admin
$route['panel-admin/akun']              = 'Admin/akun';
$route['panel-admin/akun/update']       = 'Admin/akun_update';
