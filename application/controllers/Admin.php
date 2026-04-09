<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_Loader           $load
 * @property CI_Session          $session
 * @property CI_Security         $security
 * @property CI_Input            $input
 * @property CI_Router           $router
 * @property CI_Upload           $upload
 * @property Main_model          $model
 */
class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model', 'model');
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->helper(['url', 'form']);
        $this->model->ensure_content_schema();
        $this->model->ensure_rbac_schema();
    }

    // ============================================================
    // AUTH CHECK
    // ============================================================
    private function _check_auth()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            if ($this->input->is_ajax_request()) {
                $this->_json('error', 'Sesi login berakhir. Silakan login ulang.', [
                    'redirect' => base_url('panel-admin/login')
                ]);
            }
            redirect('panel-admin/login');
        }

        $this->_refresh_admin_acl_session();

        $permission_codes = $this->session->userdata('admin_permissions');
        if (!is_array($permission_codes)) $permission_codes = [];
        $this->load->vars([
            'permission_codes' => $permission_codes,
            'admin_role_name' => $this->session->userdata('admin_role_name') ?: 'Tanpa Role',
        ]);

        $method = $this->router->fetch_method();
        $map = $this->_permission_map();
        if (isset($map[$method])) {
            $this->_require_permission($map[$method]);
        }
    }

    private function _json($status, $message, $data = null)
    {
        header('Content-Type: application/json');
        $response = ['status' => $status, 'message' => $message];
        if ($data !== null) $response['data'] = $data;
        echo json_encode($response);
        exit;
    }

    private function _permission_map()
    {
        return [
            'dashboard'                  => 'dashboard.view',
            'profil'                     => 'profil.view',
            'profil_tentang_kami'        => 'profil.view',
            'profil_struktur'            => 'profil.view',
            'profil_update'              => 'profil.edit',
            'struktur'                   => 'struktur.view',
            'struktur_bagan_save'        => 'struktur.edit',
            'struktur_anggota_get'       => 'struktur.view',
            'struktur_anggota_store'     => 'struktur.create',
            'struktur_anggota_update'    => 'struktur.edit',
            'struktur_anggota_delete'    => 'struktur.delete',
            'sejarah'                    => 'sejarah.view',
            'sejarah_get'                => 'sejarah.view',
            'sejarah_store'              => 'sejarah.create',
            'sejarah_update'             => 'sejarah.edit',
            'sejarah_delete'             => 'sejarah.delete',
            'visi_misi'                  => 'visi_misi.view',
            'visi_misi_get'              => 'visi_misi.view',
            'visi_misi_bg_save'          => 'visi_misi.edit',
            'visi_misi_bg_delete_image'  => 'visi_misi.edit',
            'visi_misi_bg_delete_video'  => 'visi_misi.edit',
            'visi_misi_store'            => 'visi_misi.create',
            'visi_misi_update'           => 'visi_misi.edit',
            'visi_misi_delete'           => 'visi_misi.delete',
            'galeri'                     => 'galeri.view',
            'galeri_get'                 => 'galeri.view',
            'galeri_store'               => 'galeri.create',
            'galeri_update'              => 'galeri.edit',
            'galeri_delete'              => 'galeri.delete',
            'ekskul'                     => 'ekskul.view',
            'ekskul_get'                 => 'ekskul.view',
            'ekskul_store'               => 'ekskul.create',
            'ekskul_update'              => 'ekskul.edit',
            'ekskul_delete'              => 'ekskul.delete',
            'berita'                     => 'berita.view',
            'berita_get'                 => 'berita.view',
            'berita_store'               => 'berita.create',
            'berita_update'              => 'berita.edit',
            'berita_delete'              => 'berita.delete',
            'ppdb'                       => 'ppdb.view',
            'ppdb_get'                   => 'ppdb.view',
            'ppdb_store'                 => 'ppdb.create',
            'ppdb_update'                => 'ppdb.edit',
            'ppdb_delete'                => 'ppdb.delete',
            'popup'                      => 'popup.view',
            'popup_update'               => 'popup.edit',
            'statistik'                  => 'statistik.view',
            'statistik_get'              => 'statistik.view',
            'statistik_store'            => 'statistik.create',
            'statistik_update'           => 'statistik.edit',
            'statistik_delete'           => 'statistik.delete',
            'akun'                       => 'akun.view',
            'akun_update'                => 'akun.edit',
            'setting'                    => 'setting.view',
            'setting_role_get'           => 'setting.view',
            'setting_role_store'         => 'setting.role.create',
            'setting_role_update'        => 'setting.role.edit',
            'setting_role_delete'        => 'setting.role.delete',
            'setting_user_get'           => 'setting.view',
            'setting_user_store'         => 'setting.user.create',
            'setting_user_update'        => 'setting.user.edit',
            'setting_user_delete'        => 'setting.user.delete',
        ];
    }

    private function _refresh_admin_acl_session($force = false)
    {
        if (!$this->session->userdata('admin_logged_in')) return;

        $admin_id = (int) $this->session->userdata('admin_id');
        if (!$admin_id) return;

        $admin = $this->model->get_admin_by_id($admin_id);
        if (!$admin) {
            $this->session->sess_destroy();
            redirect('panel-admin/login');
        }

        $permission_codes = $this->model->get_admin_permissions($admin_id);
        $this->session->set_userdata([
            'admin_nama'        => $admin->nama,
            'admin_username'    => $admin->username,
            'admin_foto'        => $admin->foto,
            'admin_role_id'     => (int) $admin->role_id,
            'admin_role_name'   => $admin->role_nama ?: 'Tanpa Role',
            'admin_permissions' => $permission_codes,
        ]);
    }

    private function _has_permission($permission_code)
    {
        $codes = $this->session->userdata('admin_permissions');
        if (!is_array($codes)) return false;
        return in_array($permission_code, $codes, true);
    }

    private function _require_permission($permission_code)
    {
        if ($this->_has_permission($permission_code)) return;

        if ($this->input->is_ajax_request()) {
            $this->_json('error', 'Anda tidak memiliki permission: ' . $permission_code);
        }
        show_error('Anda tidak memiliki izin untuk mengakses fitur ini.', 403, 'Akses Ditolak');
    }

    // ============================================================
    // LOGIN
    // ============================================================
    public function login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('panel-admin/dashboard');
        }

        if ($this->input->post()) {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password');

            $admin = $this->model->get_admin_by_username($username);

            if ($admin && password_verify($password, $admin->password)) {
                $this->session->set_userdata([
                    'admin_logged_in' => TRUE,
                    'admin_id'        => $admin->id,
                    'admin_nama'      => $admin->nama,
                    'admin_username'  => $admin->username,
                ]);
                $this->_refresh_admin_acl_session(true);

                if ($this->input->is_ajax_request()) {
                    $this->_json('success', 'Login berhasil!', ['redirect' => base_url('panel-admin/dashboard')]);
                }

                redirect('panel-admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah!');

                if ($this->input->is_ajax_request()) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' => 'Username atau password salah!']);
                    exit;
                }

                redirect('panel-admin/login');
            }
        }

        $data['profil'] = $this->model->get_profil();
        $this->load->view('admin/login', $data);
    }

    public function do_login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            $this->_json('success', 'Sudah login.', ['redirect' => base_url('panel-admin/dashboard')]);
        }

        if (!$this->input->post()) {
            $this->_json('error', 'Metode tidak diizinkan.');
        }

        $username = $this->input->post('username', TRUE);
        $password = (string) $this->input->post('password');

        if (empty($username) || empty($password)) {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Username dan password wajib diisi.']);
            exit;
        }

        $admin = $this->model->get_admin_by_username($username);

        if ($admin && password_verify($password, $admin->password)) {
            $this->session->set_userdata([
                'admin_logged_in' => TRUE,
                'admin_id'        => $admin->id,
                'admin_nama'      => $admin->nama,
                'admin_username'  => $admin->username,
            ]);
            $this->_refresh_admin_acl_session(true);

            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'message' => 'Login berhasil!']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Username atau password salah!']);
        }
        exit;
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('panel-admin/login');
    }

    // ============================================================
    // DASHBOARD
    // ============================================================
    public function dashboard()
    {
        $this->_check_auth();
        $data['title']          = 'Dashboard';
        $data['stats']          = $this->model->get_dashboard_stats();
        $data['berita_terbaru'] = $this->model->get_berita_aktif(5);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layout/footer');
    }

    // ============================================================
    // PROFIL
    // ============================================================
    public function profil()
    {
        $this->_check_auth();
        $data['title']  = 'Profil Yayasan';
        $data['profil'] = $this->model->get_profil();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/profil', $data);
        $this->load->view('admin/layout/footer');
    }

    public function profil_tentang_kami()
    {
        // Legacy alias – delegate to profil().
        $this->profil();
    }

    public function profil_struktur()
    {
        redirect('panel-admin/struktur');
    }

    public function profil_update()
    {
        $this->_check_auth();
        $existing = $this->model->get_profil();

        $deskripsi_lengkap = trim((string) $this->_post_or_existing('deskripsi_lengkap', $existing ? $existing->deskripsi_lengkap : '', FALSE));
        $deskripsi_singkat_input = trim((string) $this->_post_or_existing('deskripsi_singkat', $existing ? $existing->deskripsi_singkat : '', FALSE));
        $deskripsi_singkat = $deskripsi_singkat_input !== '' ? $deskripsi_singkat_input : $this->_make_excerpt($deskripsi_lengkap, 180);

        $hero_overlay_color = trim((string) $this->_post_or_existing('hero_overlay_color', $existing ? $existing->hero_overlay_color : '#052e16', TRUE));
        if ($hero_overlay_color === '') $hero_overlay_color = '#052e16';
        $hero_overlay_opacity_raw = $this->_post_or_existing('hero_overlay_opacity', $existing ? $existing->hero_overlay_opacity : 80, TRUE);
        $hero_overlay_opacity = ($hero_overlay_opacity_raw === null || $hero_overlay_opacity_raw === '')
            ? 80
            : (int) $hero_overlay_opacity_raw;
        if ($hero_overlay_opacity < 0 || $hero_overlay_opacity > 100) $hero_overlay_opacity = 80;

        $uploaded_files = [];
        $files_to_delete = [];

        $update_data = [
            'nama_yayasan'                  => $this->_post_or_existing('nama_yayasan', $existing ? $existing->nama_yayasan : null, TRUE),
            'tagline'                       => $this->_post_or_existing('tagline', $existing ? $existing->tagline : null, TRUE),
            'deskripsi_singkat'             => $deskripsi_singkat,
            'deskripsi_lengkap'             => $deskripsi_lengkap,
            'alamat'                        => $this->_post_or_existing('alamat', $existing ? $existing->alamat : null, TRUE),
            'telepon'                       => $this->_post_or_existing('telepon', $existing ? $existing->telepon : null, TRUE),
            'email'                         => $this->_post_or_existing('email', $existing ? $existing->email : null, TRUE),
            'website'                       => $this->_post_or_existing('website', $existing ? $existing->website : null, TRUE),
            'facebook'                      => $this->_post_or_existing('facebook', $existing ? $existing->facebook : null, TRUE),
            'instagram'                     => $this->_post_or_existing('instagram', $existing ? $existing->instagram : null, TRUE),
            'youtube'                       => $this->_post_or_existing('youtube', $existing ? $existing->youtube : null, TRUE),
            'whatsapp'                      => $this->_post_or_existing('whatsapp', $existing ? $existing->whatsapp : null, TRUE),
            'tiktok'                        => $this->_post_or_existing('tiktok', ($existing && isset($existing->tiktok)) ? $existing->tiktok : null, TRUE),
            'maps_embed'                    => $this->_post_or_existing('maps_embed', $existing ? $existing->maps_embed : null, TRUE),
            'hero_overlay_color'            => $hero_overlay_color,
            'hero_overlay_opacity'          => $hero_overlay_opacity,
            'hero_title'                    => $this->_post_or_existing('hero_title', $existing ? $existing->hero_title : null, TRUE),
            'hero_subtitle'                 => $this->_post_or_existing('hero_subtitle', $existing ? $existing->hero_subtitle : null, TRUE),
            'about_section_label'           => $this->_post_or_existing('about_section_label', $existing ? $existing->about_section_label : null, TRUE),
            'about_section_badge'           => $this->_post_or_existing('about_section_badge', $existing ? $existing->about_section_badge : null, TRUE),
            'about_section_cta_text'        => $this->_post_or_existing('about_section_cta_text', $existing ? $existing->about_section_cta_text : null, TRUE),
            'about_section_cta_link'        => $this->_post_or_existing('about_section_cta_link', $existing ? $existing->about_section_cta_link : null, TRUE),
            'about_section_video_url'       => $this->_post_or_existing('about_section_video_url', ($existing && isset($existing->about_section_video_url)) ? $existing->about_section_video_url : null, TRUE),
            'struktur_organisasi_judul'     => $this->_post_or_existing('struktur_organisasi_judul', $existing ? $existing->struktur_organisasi_judul : null, TRUE),
            'struktur_organisasi_deskripsi' => $this->_post_or_existing('struktur_organisasi_deskripsi', $existing ? $existing->struktur_organisasi_deskripsi : null, FALSE),
        ];

        if (!empty($_FILES['logo']['name'])) {
            $upload_result = $this->_upload_file('logo', 'profil');
            if ($upload_result['status']) {
                $update_data['logo'] = $upload_result['file_name'];
                $uploaded_files[] = 'profil/' . $upload_result['file_name'];
                if ($existing && !empty($existing->logo) && $existing->logo !== $upload_result['file_name']) {
                    $files_to_delete[] = 'profil/' . $existing->logo;
                }
            } else {
                foreach ($uploaded_files as $path) {
                    $this->_delete_file($path);
                }
                $this->_json('error', $upload_result['message']);
            }
        }

        if (!empty($_FILES['hero_image']['name'])) {
            $upload_result = $this->_upload_file('hero_image', 'profil');
            if ($upload_result['status']) {
                $update_data['hero_image'] = $upload_result['file_name'];
                $uploaded_files[] = 'profil/' . $upload_result['file_name'];
                if ($existing && !empty($existing->hero_image) && $existing->hero_image !== $upload_result['file_name']) {
                    $files_to_delete[] = 'profil/' . $existing->hero_image;
                }
            } else {
                foreach ($uploaded_files as $path) {
                    $this->_delete_file($path);
                }
                $this->_json('error', $upload_result['message']);
            }
        }

        // Hero slider images 2-5
        foreach ([2, 3, 4, 5] as $slide_n) {
            $slide_field = 'hero_image_' . $slide_n;
            if (!empty($_FILES[$slide_field]['name'])) {
                $up = $this->_upload_file($slide_field, 'profil');
                if ($up['status']) {
                    $update_data[$slide_field] = $up['file_name'];
                    $uploaded_files[] = 'profil/' . $up['file_name'];
                    if ($existing && !empty($existing->$slide_field) && $existing->$slide_field !== $up['file_name']) {
                        $files_to_delete[] = 'profil/' . $existing->$slide_field;
                    }
                } else {
                    foreach ($uploaded_files as $path) { $this->_delete_file($path); }
                    $this->_json('error', $up['message']);
                }
            }
        }

        if (!empty($_FILES['struktur_organisasi_gambar']['name'])) {
            $upload_result = $this->_upload_file('struktur_organisasi_gambar', 'profil');
            if ($upload_result['status']) {
                $update_data['struktur_organisasi_gambar'] = $upload_result['file_name'];
                $uploaded_files[] = 'profil/' . $upload_result['file_name'];
                if ($existing && !empty($existing->struktur_organisasi_gambar) && $existing->struktur_organisasi_gambar !== $upload_result['file_name']) {
                    $files_to_delete[] = 'profil/' . $existing->struktur_organisasi_gambar;
                }
            } else {
                foreach ($uploaded_files as $path) {
                    $this->_delete_file($path);
                }
                $this->_json('error', $upload_result['message']);
            }
        }

        if (!empty($_FILES['about_section_media']['name'])) {
            $upload_result = $this->_upload_media('about_section_media', 'profil');
            if ($upload_result['status']) {
                $update_data['about_section_media'] = $upload_result['file_name'];
                $uploaded_files[] = 'profil/' . $upload_result['file_name'];
                if ($existing && !empty($existing->about_section_media) && $existing->about_section_media !== $upload_result['file_name']) {
                    $files_to_delete[] = 'profil/' . $existing->about_section_media;
                }
            } else {
                foreach ($uploaded_files as $path) {
                    $this->_delete_file($path);
                }
                $this->_json('error', $upload_result['message']);
            }
        } elseif ((int) $this->input->post('remove_about_section_media', TRUE) === 1 && $existing && !empty($existing->about_section_media)) {
            $update_data['about_section_media'] = null;
            $files_to_delete[] = 'profil/' . $existing->about_section_media;
        }

        $saved = $this->model->update_profil($update_data);
        if (!$saved) {
            foreach ($uploaded_files as $path) {
                $this->_delete_file($path);
            }
            $this->_json('error', 'Gagal menyimpan data profil.');
        }

        foreach (array_unique($files_to_delete) as $path) {
            $this->_delete_file($path);
        }

        $this->_json('success', 'Data profil berhasil diperbarui!');
    }

    // ============================================================
    // STRUKTUR ORGANISASI
    // ============================================================
    public function struktur()
    {
        $this->_check_auth();
        $data['title'] = 'Manajemen Struktur Organisasi';
        $data['profil'] = $this->model->get_profil();
        $data['anggota'] = $this->model->get_all_struktur_anggota();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/struktur', $data);
        $this->load->view('admin/layout/footer');
    }

    public function struktur_bagan_save()
    {
        $this->_check_auth();
        $profil = $this->model->get_profil();

        $update_data = [
            'struktur_organisasi_judul' => $this->input->post('struktur_organisasi_judul', TRUE),
            'struktur_organisasi_deskripsi' => $this->input->post('struktur_organisasi_deskripsi'),
        ];

        if (!empty($_FILES['struktur_organisasi_gambar']['name'])) {
            $up = $this->_upload_file('struktur_organisasi_gambar', 'profil');
            if ($up['status']) {
                $update_data['struktur_organisasi_gambar'] = $up['file_name'];
                if ($profil && !empty($profil->struktur_organisasi_gambar) && $profil->struktur_organisasi_gambar !== $up['file_name']) {
                    $this->_delete_file('profil/' . $profil->struktur_organisasi_gambar);
                }
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $this->model->update_profil($update_data);
        $this->_json('success', 'Bagan struktur berhasil diperbarui.');
    }

    public function struktur_anggota_get($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('struktur_anggota', (int) $id);
        if (!$item) {
            $this->_json('error', 'Data anggota tidak ditemukan.');
        }
        $this->_json('success', 'OK', $item);
    }

    public function struktur_anggota_store()
    {
        $this->_check_auth();

        $nama = trim((string) $this->input->post('nama', TRUE));
        $jabatan = trim((string) $this->input->post('jabatan', TRUE));
        if ($nama === '' || $jabatan === '') {
            $this->_json('error', 'Nama dan jabatan wajib diisi.');
        }

        $slug = $this->_make_unique_struktur_anggota_slug($nama);

        $data = [
            'nama' => $nama,
            'jabatan' => $jabatan,
            'slug' => $slug,
            'deskripsi_lengkap' => $this->input->post('deskripsi_lengkap'),
            'urutan' => $this->input->post('urutan', TRUE) ?: 1,
            'status' => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['foto']['name'])) {
            $up = $this->_upload_file('foto', 'struktur');
            if ($up['status']) {
                $data['foto'] = $up['file_name'];
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $this->model->insert('struktur_anggota', $data);
        $this->_json('success', 'Anggota struktur berhasil ditambahkan.');
    }

    public function struktur_anggota_update($id)
    {
        $this->_check_auth();
        $id = (int) $id;
        $item = $this->model->get_by_id('struktur_anggota', $id);
        if (!$item) {
            $this->_json('error', 'Data anggota tidak ditemukan.');
        }

        $nama = trim((string) $this->input->post('nama', TRUE));
        $jabatan = trim((string) $this->input->post('jabatan', TRUE));
        if ($nama === '' || $jabatan === '') {
            $this->_json('error', 'Nama dan jabatan wajib diisi.');
        }

        $slug = $this->_make_unique_struktur_anggota_slug($nama, $id);

        $data = [
            'nama' => $nama,
            'jabatan' => $jabatan,
            'slug' => $slug,
            'deskripsi_lengkap' => $this->input->post('deskripsi_lengkap'),
            'urutan' => $this->input->post('urutan', TRUE) ?: 1,
            'status' => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['foto']['name'])) {
            $up = $this->_upload_file('foto', 'struktur');
            if ($up['status']) {
                $data['foto'] = $up['file_name'];
                if (!empty($item->foto) && $item->foto !== $up['file_name']) {
                    $this->_delete_file('struktur/' . $item->foto);
                }
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $this->model->update('struktur_anggota', $data, $id);
        $this->_json('success', 'Data anggota struktur berhasil diperbarui.');
    }

    public function struktur_anggota_delete($id)
    {
        $this->_check_auth();
        $id = (int) $id;
        $item = $this->model->get_by_id('struktur_anggota', $id);
        if (!$item) {
            $this->_json('error', 'Data anggota tidak ditemukan.');
        }

        if (!empty($item->foto)) {
            $this->_delete_file('struktur/' . $item->foto);
        }

        $this->model->delete('struktur_anggota', $id);
        $this->_json('success', 'Data anggota struktur berhasil dihapus.');
    }

    // ============================================================
    // SEJARAH CRUD
    // ============================================================
    public function sejarah()
    {
        $this->_check_auth();
        $data['title']   = 'Manajemen Sejarah';
        $data['sejarah'] = $this->model->get_all_sejarah();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/sejarah', $data);
        $this->load->view('admin/layout/footer');
    }

    public function sejarah_get($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('sejarah', $id);
        $this->_json('success', 'OK', $item);
    }

    public function sejarah_store()
    {
        $this->_check_auth();
        $data = [
            'judul'  => $this->input->post('judul', TRUE),
            'konten' => $this->input->post('konten', TRUE),
            'urutan' => $this->input->post('urutan', TRUE) ?: 1,
            'status' => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'sejarah');
            if ($up['status']) $data['gambar'] = $up['file_name'];
        }

        $this->model->insert('sejarah', $data);
        $this->_json('success', 'Data sejarah berhasil ditambahkan!');
    }

    public function sejarah_update($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('sejarah', $id);
        $data = [
            'judul'  => $this->input->post('judul', TRUE),
            'konten' => $this->input->post('konten', TRUE),
            'urutan' => $this->input->post('urutan', TRUE) ?: 1,
            'status' => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'sejarah');
            if ($up['status']) {
                $data['gambar'] = $up['file_name'];
                if ($item && !empty($item->gambar) && $item->gambar !== $up['file_name']) {
                    $this->_delete_file('sejarah/' . $item->gambar);
                }
            }
        }

        $this->model->update('sejarah', $data, $id);
        $this->_json('success', 'Data sejarah berhasil diperbarui!');
    }

    public function sejarah_delete($id = null)
    {
        $this->_check_auth();
        $id = $id ? (int) $id : (int) $this->input->post('id', TRUE);
        if ($id <= 0) {
            $this->_json('error', 'ID sejarah tidak valid.');
        }

        $item = $this->model->get_by_id('sejarah', $id);
        if (!$item) {
            $this->_json('error', 'Data sejarah tidak ditemukan.');
        }

        if (!empty($item->gambar)) $this->_delete_file('sejarah/' . $item->gambar);
        $this->model->delete('sejarah', $id);
        $this->_json('success', 'Data sejarah berhasil dihapus!');
    }

    // ============================================================
    // VISI MISI CRUD
    // ============================================================
    public function visi_misi()
    {
        $this->_check_auth();
        $data['title']     = 'Manajemen Visi Misi';
        $data['visi_misi'] = $this->model->get_all_visi_misi();
        $data['profil']    = $this->model->get_profil();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/visi_misi', $data);
        $this->load->view('admin/layout/footer');
    }

    public function visi_misi_bg_save()
    {
        $this->_check_auth();
        $profil = $this->model->get_profil();
        $update_data = [
            'visimisi_overlay_color'   => $this->input->post('visimisi_overlay_color', TRUE) ?: '#052e16',
            'visimisi_overlay_opacity' => $this->input->post('visimisi_overlay_opacity', TRUE) ?: 80,
        ];

        if (!empty($_FILES['visimisi_bg_image']['name'])) {
            $up = $this->_upload_file('visimisi_bg_image', 'profil');
            if ($up['status']) {
                $update_data['visimisi_bg_image'] = $up['file_name'];
                if ($profil && !empty($profil->visimisi_bg_image) && $profil->visimisi_bg_image !== $up['file_name']) {
                    $this->_delete_file('profil/' . $profil->visimisi_bg_image);
                }
            } else {
                $this->_json('error', $up['message']);
            }
        }

        if (!empty($_FILES['visimisi_bg_video']['name'])) {
            $up = $this->_upload_video('visimisi_bg_video', 'profil');
            if ($up['status']) {
                $update_data['visimisi_bg_video'] = $up['file_name'];
                if ($profil && !empty($profil->visimisi_bg_video) && $profil->visimisi_bg_video !== $up['file_name']) {
                    $this->_delete_file('profil/' . $profil->visimisi_bg_video);
                }
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $this->model->update_profil($update_data);
        $this->_json('success', 'Background Visi & Misi berhasil diperbarui!');
    }

    public function visi_misi_bg_delete_image()
    {
        $this->_check_auth();
        $profil = $this->model->get_profil();
        if ($profil && !empty($profil->visimisi_bg_image)) {
            $this->_delete_file('profil/' . $profil->visimisi_bg_image);
        }
        $this->model->update_profil(['visimisi_bg_image' => null]);
        $this->_json('success', 'Background gambar berhasil dihapus.');
    }

    public function visi_misi_bg_delete_video()
    {
        $this->_check_auth();
        $profil = $this->model->get_profil();
        if ($profil && !empty($profil->visimisi_bg_video)) {
            $this->_delete_file('profil/' . $profil->visimisi_bg_video);
        }
        $this->model->update_profil(['visimisi_bg_video' => null]);
        $this->_json('success', 'Background video berhasil dihapus.');
    }

    public function visi_misi_get($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('visi_misi', $id);
        $this->_json('success', 'OK', $item);
    }

    public function visi_misi_store()
    {
        $this->_check_auth();
        $data = [
            'tipe'   => $this->input->post('tipe', TRUE),
            'judul'  => $this->input->post('judul', TRUE),
            'konten' => $this->input->post('konten', TRUE),
            'ikon'   => $this->input->post('ikon', TRUE),
            'urutan' => $this->input->post('urutan', TRUE) ?: 1,
            'status' => $this->input->post('status', TRUE) ?: 1,
        ];
        $this->model->insert('visi_misi', $data);
        $this->_json('success', 'Data visi/misi berhasil ditambahkan!');
    }

    public function visi_misi_update($id)
    {
        $this->_check_auth();
        $data = [
            'tipe'   => $this->input->post('tipe', TRUE),
            'judul'  => $this->input->post('judul', TRUE),
            'konten' => $this->input->post('konten', TRUE),
            'ikon'   => $this->input->post('ikon', TRUE),
            'urutan' => $this->input->post('urutan', TRUE) ?: 1,
            'status' => $this->input->post('status', TRUE) ?: 1,
        ];
        $this->model->update('visi_misi', $data, $id);
        $this->_json('success', 'Data visi/misi berhasil diperbarui!');
    }

    public function visi_misi_delete($id)
    {
        $this->_check_auth();
        $this->model->delete('visi_misi', $id);
        $this->_json('success', 'Data visi/misi berhasil dihapus!');
    }

    // ============================================================
    // GALERI CRUD
    // ============================================================
    public function galeri()
    {
        $this->_check_auth();
        $data['title']  = 'Manajemen Galeri';
        $data['galeri'] = $this->model->get_all_galeri();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/galeri', $data);
        $this->load->view('admin/layout/footer');
    }

    public function galeri_get($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('galeri', $id);
        $this->_json('success', 'OK', $item);
    }

    public function galeri_store()
    {
        $this->_check_auth();
        $status_input = $this->input->post('status', TRUE);
        $data = [
            'judul'     => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'kategori'  => $this->input->post('kategori', TRUE) ?: 'umum',
            'label'     => trim((string) $this->input->post('label', TRUE)),
            'urutan'    => $this->input->post('urutan', TRUE) ?: 1,
            'status'    => ($status_input === null || $status_input === '') ? 1 : (int) $status_input,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'galeri');
            if ($up['status']) {
                $data['gambar'] = $up['file_name'];
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $this->model->insert('galeri', $data);
        $this->_json('success', 'Galeri berhasil ditambahkan!');
    }

    public function galeri_update($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('galeri', $id);
        $status_input = $this->input->post('status', TRUE);
        $data = [
            'judul'     => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'kategori'  => $this->input->post('kategori', TRUE) ?: 'umum',
            'label'     => trim((string) $this->input->post('label', TRUE)),
            'urutan'    => $this->input->post('urutan', TRUE) ?: 1,
            'status'    => ($status_input === null || $status_input === '') ? 1 : (int) $status_input,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'galeri');
            if ($up['status']) {
                $data['gambar'] = $up['file_name'];
                if ($item && !empty($item->gambar) && $item->gambar !== $up['file_name']) {
                    $this->_delete_file('galeri/' . $item->gambar);
                }
            }
        }

        $this->model->update('galeri', $data, $id);
        $this->_json('success', 'Galeri berhasil diperbarui!');
    }

    public function galeri_delete($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('galeri', $id);
        if ($item && $item->gambar) $this->_delete_file('galeri/' . $item->gambar);
        $this->model->delete('galeri', $id);
        $this->_json('success', 'Galeri berhasil dihapus!');
    }

    // ============================================================
    // EKSKUL CRUD
    // ============================================================
    public function ekskul()
    {
        $this->_check_auth();
        $data['title']  = 'Manajemen Ekskul';
        $data['ekskul'] = $this->model->get_all_ekskul();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/ekskul', $data);
        $this->load->view('admin/layout/footer');
    }

    public function ekskul_get($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('ekskul', $id);
        $this->_json('success', 'OK', $item);
    }

    public function ekskul_store()
    {
        $this->_check_auth();
        $nama = trim((string) $this->input->post('nama', TRUE));
        $slug = $this->_make_unique_ekskul_slug($nama);
        $data = [
            'nama'           => $nama,
            'slug'           => $slug,
            'deskripsi'      => $this->input->post('deskripsi', TRUE),
            'detail_lengkap' => $this->input->post('detail_lengkap'),
            'ikon'           => $this->input->post('ikon', TRUE),
            'jadwal'         => $this->input->post('jadwal', TRUE),
            'pembina'        => $this->input->post('pembina', TRUE),
            'urutan'         => $this->input->post('urutan', TRUE) ?: 1,
            'status'         => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'ekskul');
            if ($up['status']) $data['gambar'] = $up['file_name'];
        }

        $this->model->insert('ekskul', $data);
        $this->_json('success', 'Ekskul berhasil ditambahkan!');
    }

    public function ekskul_update($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('ekskul', $id);
        $nama = trim((string) $this->input->post('nama', TRUE));
        $slug = $this->_make_unique_ekskul_slug($nama, (int) $id);
        $data = [
            'nama'           => $nama,
            'slug'           => $slug,
            'deskripsi'      => $this->input->post('deskripsi', TRUE),
            'detail_lengkap' => $this->input->post('detail_lengkap'),
            'ikon'           => $this->input->post('ikon', TRUE),
            'jadwal'         => $this->input->post('jadwal', TRUE),
            'pembina'        => $this->input->post('pembina', TRUE),
            'urutan'         => $this->input->post('urutan', TRUE) ?: 1,
            'status'         => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'ekskul');
            if ($up['status']) {
                $data['gambar'] = $up['file_name'];
                if ($item && !empty($item->gambar) && $item->gambar !== $up['file_name']) {
                    $this->_delete_file('ekskul/' . $item->gambar);
                }
            }
        }

        $this->model->update('ekskul', $data, $id);
        $this->_json('success', 'Ekskul berhasil diperbarui!');
    }

    public function ekskul_delete($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('ekskul', $id);
        if ($item && $item->gambar) $this->_delete_file('ekskul/' . $item->gambar);
        $this->model->delete('ekskul', $id);
        $this->_json('success', 'Ekskul berhasil dihapus!');
    }

    // ============================================================
    // BERITA CRUD
    // ============================================================
    public function berita()
    {
        $this->_check_auth();
        $data['title']  = 'Manajemen Berita';
        $data['berita'] = $this->model->get_all_berita();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/berita', $data);
        $this->load->view('admin/layout/footer');
    }

    public function berita_get($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('berita', $id);
        $this->_json('success', 'OK', $item);
    }

    public function berita_store()
    {
        $this->_check_auth();
        $judul = $this->input->post('judul', TRUE);
        $slug  = $this->_make_slug($judul);

        $counter   = 1;
        $base_slug = $slug;
        while ($this->model->slug_exists($slug)) {
            $slug = $base_slug . '-' . $counter++;
        }

        $data = [
            'judul'           => $judul,
            'slug'            => $slug,
            'isi'             => $this->input->post('isi'),
            'ringkasan'       => $this->input->post('ringkasan', TRUE),
            'kategori'        => $this->input->post('kategori', TRUE) ?: 'berita',
            'penulis'         => $this->input->post('penulis', TRUE),
            'tanggal_publish' => $this->input->post('tanggal_publish', TRUE) ?: date('Y-m-d'),
            'status'          => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'berita');
            if ($up['status']) $data['gambar'] = $up['file_name'];
        }

        $this->model->insert('berita', $data);
        $this->_json('success', 'Berita berhasil ditambahkan!');
    }

    public function berita_update($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('berita', $id);
        $judul = $this->input->post('judul', TRUE);
        $slug  = $this->_make_slug($judul);

        $counter   = 1;
        $base_slug = $slug;
        while ($this->model->slug_exists($slug, $id)) {
            $slug = $base_slug . '-' . $counter++;
        }

        $data = [
            'judul'           => $judul,
            'slug'            => $slug,
            'isi'             => $this->input->post('isi'),
            'ringkasan'       => $this->input->post('ringkasan', TRUE),
            'kategori'        => $this->input->post('kategori', TRUE) ?: 'berita',
            'penulis'         => $this->input->post('penulis', TRUE),
            'tanggal_publish' => $this->input->post('tanggal_publish', TRUE) ?: date('Y-m-d'),
            'status'          => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'berita');
            if ($up['status']) {
                $data['gambar'] = $up['file_name'];
                if ($item && !empty($item->gambar) && $item->gambar !== $up['file_name']) {
                    $this->_delete_file('berita/' . $item->gambar);
                }
            }
        }

        $this->model->update('berita', $data, $id);
        $this->_json('success', 'Berita berhasil diperbarui!');
    }

    public function berita_delete($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('berita', $id);
        if ($item && $item->gambar) $this->_delete_file('berita/' . $item->gambar);
        $this->model->delete('berita', $id);
        $this->_json('success', 'Berita berhasil dihapus!');
    }

    // ============================================================
    // PPDB CRUD
    // ============================================================
    public function ppdb()
    {
        $this->_check_auth();
        $data['title'] = 'Manajemen PPDB';
        $data['ppdb']  = $this->model->get_all_ppdb();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/ppdb', $data);
        $this->load->view('admin/layout/footer');
    }

    public function ppdb_get($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('ppdb', $id);
        $this->_json('success', 'OK', $item);
    }

    public function ppdb_store()
    {
        $this->_check_auth();
        $data = [
            'tahun_ajaran'      => $this->input->post('tahun_ajaran', TRUE),
            'judul'             => $this->input->post('judul', TRUE),
            'deskripsi'         => $this->input->post('deskripsi', TRUE),
            'tanggal_buka'      => $this->input->post('tanggal_buka', TRUE),
            'tanggal_tutup'     => $this->input->post('tanggal_tutup', TRUE),
            'kuota'             => $this->input->post('kuota', TRUE),
            'biaya_pendaftaran' => str_replace(['.', ','], '', $this->input->post('biaya_pendaftaran', TRUE)),
            'syarat'            => $this->input->post('syarat', TRUE),
            'alur_pendaftaran'  => $this->input->post('alur_pendaftaran', TRUE),
            'kontak_info'       => $this->input->post('kontak_info', TRUE),
            'link_pendaftaran'  => $this->input->post('link_pendaftaran', TRUE),
            'maps_url'          => $this->input->post('maps_url', TRUE),
            'status'            => $this->input->post('status', TRUE) ?: 1,
        ];
        $this->model->insert('ppdb', $data);
        $this->_json('success', 'Data PPDB berhasil ditambahkan!');
    }

    public function ppdb_update($id)
    {
        $this->_check_auth();
        $data = [
            'tahun_ajaran'      => $this->input->post('tahun_ajaran', TRUE),
            'judul'             => $this->input->post('judul', TRUE),
            'deskripsi'         => $this->input->post('deskripsi', TRUE),
            'tanggal_buka'      => $this->input->post('tanggal_buka', TRUE),
            'tanggal_tutup'     => $this->input->post('tanggal_tutup', TRUE),
            'kuota'             => $this->input->post('kuota', TRUE),
            'biaya_pendaftaran' => str_replace(['.', ','], '', $this->input->post('biaya_pendaftaran', TRUE)),
            'syarat'            => $this->input->post('syarat', TRUE),
            'alur_pendaftaran'  => $this->input->post('alur_pendaftaran', TRUE),
            'kontak_info'       => $this->input->post('kontak_info', TRUE),
            'link_pendaftaran'  => $this->input->post('link_pendaftaran', TRUE),
            'maps_url'          => $this->input->post('maps_url', TRUE),
            'status'            => $this->input->post('status', TRUE) ?: 1,
        ];
        $this->model->update('ppdb', $data, $id);
        $this->_json('success', 'Data PPDB berhasil diperbarui!');
    }

    public function ppdb_delete($id)
    {
        $this->_check_auth();
        $this->model->delete('ppdb', $id);
        $this->_json('success', 'Data PPDB berhasil dihapus!');
    }

    // ============================================================
    // POPUP WEBSITE
    // ============================================================
    public function popup()
    {
        $this->_check_auth();
        $data['title'] = 'Popup Website';
        $data['popup'] = $this->model->get_popup_admin();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/popup', $data);
        $this->load->view('admin/layout/footer');
    }

    public function popup_update()
    {
        $this->_check_auth();
        $existing = $this->model->get_popup_admin();

        $status = (int) $this->input->post('status', TRUE);
        $target_link = trim((string) $this->input->post('target_link', TRUE));
        $target_mode = $this->input->post('target_mode', TRUE) === '_blank' ? '_blank' : '_self';
        $remove_image = (int) $this->input->post('remove_image', TRUE) === 1;

        $update_data = [
            'status'      => $status ? 1 : 0,
            'target_link' => $target_link !== '' ? $target_link : null,
            'target_mode' => $target_mode,
        ];

        if ($remove_image && $existing && !empty($existing->gambar)) {
            $this->_delete_file('popup/' . $existing->gambar);
            $update_data['gambar'] = null;
        }

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'popup');
            if ($up['status']) {
                $update_data['gambar'] = $up['file_name'];
                if ($existing && !empty($existing->gambar) && $existing->gambar !== $up['file_name']) {
                    $this->_delete_file('popup/' . $existing->gambar);
                }
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $ok = $this->model->save_popup($update_data);
        if (!$ok) {
            $this->_json('error', 'Gagal menyimpan data popup.');
        }

        $this->_json('success', 'Popup website berhasil diperbarui.');
    }

    // ============================================================
    // STATISTIK CRUD
    // ============================================================
    public function statistik()
    {
        $this->_check_auth();
        $data['title']     = 'Manajemen Statistik';
        $data['statistik'] = $this->model->get_all_statistik();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/statistik', $data);
        $this->load->view('admin/layout/footer');
    }

    public function statistik_get($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('statistik', $id);
        $this->_json('success', 'OK', $item);
    }

    public function statistik_store()
    {
        $this->_check_auth();
        $data = [
            'label'  => $this->input->post('label', TRUE),
            'nilai'  => $this->input->post('nilai', TRUE),
            'satuan' => $this->input->post('satuan', TRUE),
            'ikon'   => $this->input->post('ikon', TRUE),
            'urutan' => $this->input->post('urutan', TRUE) ?: 1,
            'status' => $this->input->post('status', TRUE) ?: 1,
        ];
        $this->model->insert('statistik', $data);
        $this->_json('success', 'Statistik berhasil ditambahkan!');
    }

    public function statistik_update($id)
    {
        $this->_check_auth();
        $data = [
            'label'  => $this->input->post('label', TRUE),
            'nilai'  => $this->input->post('nilai', TRUE),
            'satuan' => $this->input->post('satuan', TRUE),
            'ikon'   => $this->input->post('ikon', TRUE),
            'urutan' => $this->input->post('urutan', TRUE) ?: 1,
            'status' => $this->input->post('status', TRUE) ?: 1,
        ];
        $this->model->update('statistik', $data, $id);
        $this->_json('success', 'Statistik berhasil diperbarui!');
    }

    public function statistik_delete($id)
    {
        $this->_check_auth();
        $this->model->delete('statistik', $id);
        $this->_json('success', 'Statistik berhasil dihapus!');
    }

    // ============================================================
    // AKUN ADMIN
    // ============================================================
    public function akun()
    {
        $this->_check_auth();
        $data['title'] = 'Profil Akun';
        $data['admin'] = $this->model->get_admin_by_id($this->session->userdata('admin_id'));
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/akun', $data);
        $this->load->view('admin/layout/footer');
    }

    public function akun_update()
    {
        $this->_check_auth();
        $admin_id = $this->session->userdata('admin_id');
        $current_admin = $this->model->get_admin_by_id($admin_id);
        $username = $this->input->post('username', TRUE);
        if ($this->model->username_exists($username, $admin_id)) {
            $this->_json('error', 'Username sudah digunakan akun lain.');
        }

        $data = [
            'nama'     => $this->input->post('nama', TRUE),
            'email'    => $this->input->post('email', TRUE),
            'username' => $username,
        ];

        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        if (!empty($_FILES['foto']['name'])) {
            $up = $this->_upload_file('foto', 'admin');
            if ($up['status']) {
                $data['foto'] = $up['file_name'];
                if ($current_admin && !empty($current_admin->foto) && $current_admin->foto !== $up['file_name']) {
                    $this->_delete_file('admin/' . $current_admin->foto);
                }
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $this->model->update_admin($data, $admin_id);
        $this->session->set_userdata('admin_nama', $data['nama']);
        $this->_refresh_admin_acl_session(true);
        $this->_json('success', 'Profil akun berhasil diperbarui!');
    }

    // ============================================================
    // SETTING (ROLE & PERMISSION & AKUN ADMIN)
    // ============================================================
    public function setting()
    {
        $this->_check_auth();
        $data['title']       = 'Pengaturan Admin';
        $data['roles']       = $this->model->get_all_roles();
        $data['permissions'] = $this->model->get_all_permissions();
        $data['admins']      = $this->model->get_all_admin_with_roles();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/setting', $data);
        $this->load->view('admin/layout/footer');
    }

    public function setting_role_get($id)
    {
        $this->_check_auth();
        $role = $this->model->get_role_by_id($id);
        if (!$role) $this->_json('error', 'Role tidak ditemukan.');
        $payload = [
            'role'             => $role,
            'permission_codes' => $this->model->get_role_permission_codes($id),
        ];
        $this->_json('success', 'OK', $payload);
    }

    public function setting_role_store()
    {
        $this->_check_auth();
        $nama             = trim((string) $this->input->post('nama', TRUE));
        $deskripsi        = trim((string) $this->input->post('deskripsi', TRUE));
        $permission_codes = json_decode((string) $this->input->post('permissions_json'), true);
        if (!is_array($permission_codes)) $permission_codes = [];

        if ($nama === '') $this->_json('error', 'Nama role wajib diisi.');
        if ($this->model->role_name_exists($nama)) {
            $this->_json('error', 'Nama role sudah digunakan.');
        }

        $role_id = $this->model->create_role([
            'nama'      => $nama,
            'deskripsi' => $deskripsi,
            'is_system' => 0,
        ], $permission_codes);

        if (!$role_id) $this->_json('error', 'Gagal membuat role.');
        $this->_refresh_admin_acl_session(true);
        $this->_json('success', 'Role berhasil dibuat!');
    }

    public function setting_role_update($id)
    {
        $this->_check_auth();
        $role = $this->model->get_role_by_id($id);
        if (!$role) $this->_json('error', 'Role tidak ditemukan.');

        $nama             = trim((string) $this->input->post('nama', TRUE));
        $deskripsi        = trim((string) $this->input->post('deskripsi', TRUE));
        $permission_codes = json_decode((string) $this->input->post('permissions_json'), true);
        if (!is_array($permission_codes)) $permission_codes = [];

        if ($nama === '') $this->_json('error', 'Nama role wajib diisi.');
        if ($this->model->role_name_exists($nama, $id)) {
            $this->_json('error', 'Nama role sudah digunakan.');
        }

        $update_data = [
            'nama'      => ((int) $role->is_system) ? $role->nama : $nama,
            'deskripsi' => $deskripsi,
        ];
        if ($role->nama === 'Super Admin') {
            $catalog          = $this->model->get_permission_catalog();
            $permission_codes = array_map(function ($p) {
                return $p['kode'];
            }, $catalog);
        }

        $ok = $this->model->update_role_with_permissions($id, $update_data, $permission_codes);
        if (!$ok) $this->_json('error', 'Gagal memperbarui role.');

        $this->_refresh_admin_acl_session(true);
        $this->_json('success', 'Role berhasil diperbarui!');
    }

    public function setting_role_delete($id)
    {
        $this->_check_auth();
        $role = $this->model->get_role_by_id($id);
        if (!$role) $this->_json('error', 'Role tidak ditemukan.');
        if ((int) $role->is_system === 1) {
            $this->_json('error', 'Role sistem tidak bisa dihapus.');
        }

        $in_use = $this->model->count_admin_by_role($id);
        if ($in_use > 0) {
            $this->_json('error', 'Role masih dipakai oleh ' . $in_use . ' akun admin.');
        }

        $ok = $this->model->delete_role($id);
        if (!$ok) $this->_json('error', 'Gagal menghapus role.');

        $this->_refresh_admin_acl_session(true);
        $this->_json('success', 'Role berhasil dihapus!');
    }

    public function setting_user_get($id)
    {
        $this->_check_auth();
        $user = $this->model->get_admin_by_id($id);
        if (!$user) $this->_json('error', 'Akun admin tidak ditemukan.');
        $this->_json('success', 'OK', $user);
    }

    public function setting_user_store()
    {
        $this->_check_auth();
        $nama     = trim((string) $this->input->post('nama', TRUE));
        $username = trim((string) $this->input->post('username', TRUE));
        $email    = trim((string) $this->input->post('email', TRUE));
        $password = (string) $this->input->post('password');
        $role_id  = (int) $this->input->post('role_id', TRUE);

        if ($nama === '' || $username === '' || $password === '') {
            $this->_json('error', 'Nama, username, dan password wajib diisi.');
        }
        if ($role_id <= 0 || !$this->model->get_role_by_id($role_id)) {
            $this->_json('error', 'Role tidak valid.');
        }
        if ($this->model->username_exists($username)) {
            $this->_json('error', 'Username sudah digunakan.');
        }

        $data = [
            'nama'     => $nama,
            'email'    => $email ?: null,
            'username' => $username,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role_id'  => $role_id,
        ];

        if (!empty($_FILES['foto']['name'])) {
            $up = $this->_upload_file('foto', 'admin');
            if ($up['status']) {
                $data['foto'] = $up['file_name'];
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $ok = $this->model->create_admin_user($data);
        if (!$ok) $this->_json('error', 'Gagal membuat akun admin.');
        $this->_json('success', 'Akun admin berhasil dibuat!');
    }

    public function setting_user_update($id)
    {
        $this->_check_auth();
        $target   = $this->model->get_admin_by_id($id);
        if (!$target) $this->_json('error', 'Akun admin tidak ditemukan.');

        $nama     = trim((string) $this->input->post('nama', TRUE));
        $username = trim((string) $this->input->post('username', TRUE));
        $email    = trim((string) $this->input->post('email', TRUE));
        $password = (string) $this->input->post('password');
        $role_id  = (int) $this->input->post('role_id', TRUE);

        if ($nama === '' || $username === '') {
            $this->_json('error', 'Nama dan username wajib diisi.');
        }
        if ($role_id <= 0 || !$this->model->get_role_by_id($role_id)) {
            $this->_json('error', 'Role tidak valid.');
        }
        if ($this->model->username_exists($username, $id)) {
            $this->_json('error', 'Username sudah digunakan.');
        }

        $data = [
            'nama'    => $nama,
            'email'   => $email ?: null,
            'username' => $username,
            'role_id' => $role_id,
        ];
        if ($password !== '') {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        if (!empty($_FILES['foto']['name'])) {
            $up = $this->_upload_file('foto', 'admin');
            if ($up['status']) {
                $data['foto'] = $up['file_name'];
                if ($target && !empty($target->foto) && $target->foto !== $up['file_name']) {
                    $this->_delete_file('admin/' . $target->foto);
                }
            } else {
                $this->_json('error', $up['message']);
            }
        }

        $ok = $this->model->update_admin_user($id, $data);
        if (!$ok) $this->_json('error', 'Gagal memperbarui akun admin.');

        if ((int) $this->session->userdata('admin_id') === (int) $id) {
            $this->_refresh_admin_acl_session(true);
        }
        $this->_json('success', 'Akun admin berhasil diperbarui!');
    }

    public function setting_user_delete($id)
    {
        $this->_check_auth();
        $id         = (int) $id;
        $current_id = (int) $this->session->userdata('admin_id');
        if ($id === $current_id) {
            $this->_json('error', 'Akun yang sedang login tidak bisa dihapus.');
        }

        $target = $this->model->get_admin_by_id($id);
        if (!$target) $this->_json('error', 'Akun admin tidak ditemukan.');
        if (!empty($target->foto)) {
            $this->_delete_file('admin/' . $target->foto);
        }

        $ok = $this->model->delete_admin_user($id);
        if (!$ok) $this->_json('error', 'Gagal menghapus akun admin.');
        $this->_json('success', 'Akun admin berhasil dihapus!');
    }

    // ============================================================
    // HELPER: SLUG GENERATOR
    // ============================================================
    private function _make_slug($string)
    {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        return trim($slug, '-');
    }

    private function _make_unique_ekskul_slug($nama, $exclude_id = 0)
    {
        $base = $this->_make_slug($nama ?: ('ekskul-' . date('YmdHis')));
        if ($base === '') {
            $base = 'ekskul-' . date('YmdHis');
        }

        $slug    = $base;
        $counter = 1;
        while ($this->model->ekskul_slug_exists($slug, (int) $exclude_id)) {
            $slug = $base . '-' . $counter++;
        }
        return $slug;
    }

    private function _make_unique_struktur_anggota_slug($nama, $exclude_id = 0)
    {
        $base = $this->_make_slug($nama ?: ('anggota-' . date('YmdHis')));
        if ($base === '') {
            $base = 'anggota-' . date('YmdHis');
        }

        $slug = $base;
        $counter = 1;
        while ($this->model->struktur_anggota_slug_exists($slug, (int) $exclude_id)) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    private function _post_or_existing($key, $existing = null, $xss_clean = true)
    {
        $value = $this->input->post($key, $xss_clean);
        return ($value === null) ? $existing : $value;
    }

    private function _make_excerpt($text, $limit = 180)
    {
        $plain = trim(preg_replace('/\s+/', ' ', strip_tags((string) $text)));
        if ($plain === '') return '';

        if (function_exists('mb_strlen') && function_exists('mb_substr')) {
            if (mb_strlen($plain, 'UTF-8') <= $limit) return $plain;
            return rtrim(mb_substr($plain, 0, $limit, 'UTF-8')) . '...';
        }

        if (strlen($plain) <= $limit) return $plain;
        return rtrim(substr($plain, 0, $limit)) . '...';
    }

    private function _prepare_upload_path($subfolder = '')
    {
        $normalized = trim(str_replace('\\', '/', (string) $subfolder), '/');
        $upload_path = FCPATH . 'assets/images/uploads/' . ($normalized !== '' ? $normalized . '/' : '');

        if (!is_dir($upload_path)) {
            if (!@mkdir($upload_path, 0777, TRUE) && !is_dir($upload_path)) {
                return ['status' => FALSE, 'message' => 'Folder upload tidak bisa dibuat: ' . $upload_path];
            }
            @chmod($upload_path, 0777);
        }

        if (!is_writable($upload_path)) {
            @chmod($upload_path, 0777);
        }
        if (!is_writable($upload_path)) {
            return ['status' => FALSE, 'message' => 'Folder upload tidak writable: ' . $upload_path];
        }

        return ['status' => TRUE, 'path' => $upload_path];
    }

    private function _handle_upload($field_name, $subfolder, $allowed_types, $max_size)
    {
        $path_result = $this->_prepare_upload_path($subfolder);
        if (!$path_result['status']) {
            return $path_result;
        }

        $config = [
            'upload_path'   => $path_result['path'],
            'allowed_types' => $allowed_types,
            'max_size'      => $max_size,
            'encrypt_name'  => TRUE,
        ];

        $this->upload->initialize($config);

        if ($this->upload->do_upload($field_name)) {
            $upload_data = $this->upload->data();
            
            // Auto-convert process
            $final_path      = $this->_auto_convert_to_webp($upload_data['full_path']);
            $final_file_name = basename((string)$final_path);
            
            return ['status' => TRUE, 'file_name' => $final_file_name];
        }

        return ['status' => FALSE, 'message' => $this->upload->display_errors('', '')];
    }

    private function _auto_convert_to_webp($file_path)
    {
        $ext = strtolower(pathinfo((string)$file_path, PATHINFO_EXTENSION));
        // Skip formats that don't need or natively support webp conversion cleanly via simple GD.
        if (in_array($ext, ['webp', 'svg', 'gif', 'mp4', 'webm', 'ogg'])) {
            return $file_path; 
        }

        $image = null;
        if ($ext === 'jpeg' || $ext === 'jpg') {
            $image = @imagecreatefromjpeg($file_path);
        } elseif ($ext === 'png') {
            $image = @imagecreatefrompng($file_path);
            if ($image) {
                @imagepalettetotruecolor($image);
                @imagealphablending($image, true);
                @imagesavealpha($image, true);
            }
        }

        if ($image) {
            $new_path = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', (string)$file_path);
            if (@imagewebp($image, $new_path, 80)) {
                @imagedestroy($image);
                @unlink($file_path);
                return $new_path;
            }
            @imagedestroy($image);
        }

        return $file_path; // Fallback to original if conversion fails
    }

    // ============================================================
    // HELPER: UPLOAD FILE (GAMBAR)
    // ============================================================
    private function _upload_file($field_name, $subfolder = '')
    {
        return $this->_handle_upload($field_name, $subfolder, 'jpg|jpeg|png|gif|webp|svg', 5120);
    }

    // ============================================================
    // HELPER: DELETE FILE
    // ============================================================
    private function _delete_file($path)
    {
        $relative_path = trim(str_replace('\\', '/', (string) $path), '/');
        if ($relative_path === '' || strpos($relative_path, '..') !== false) {
            return FALSE;
        }

        $base_path = realpath(FCPATH . 'assets/images/uploads');
        if ($base_path === FALSE) {
            return FALSE;
        }

        $target_path = $base_path . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relative_path);
        $target_dir = realpath(dirname($target_path));
        if ($target_dir === FALSE) {
            return FALSE;
        }

        $normalized_base = rtrim(str_replace('\\', '/', $base_path), '/');
        $normalized_dir = rtrim(str_replace('\\', '/', $target_dir), '/');
        if ($normalized_dir !== $normalized_base && strpos($normalized_dir . '/', $normalized_base . '/') !== 0) {
            return FALSE;
        }

        $resolved_path = $target_dir . DIRECTORY_SEPARATOR . basename($target_path);
        if (!is_file($resolved_path)) {
            return FALSE;
        }

        return @unlink($resolved_path);
    }

    // ============================================================
    // HELPER: UPLOAD VIDEO
    // ============================================================
    private function _upload_video($field_name, $subfolder = '')
    {
        return $this->_handle_upload($field_name, $subfolder, 'mp4|webm|ogg', 51200);
    }

    private function _upload_media($field_name, $subfolder = '')
    {
        return $this->_handle_upload($field_name, $subfolder, 'jpg|jpeg|png|gif|webp|svg|mp4|webm|ogg', 51200);
    }
}
