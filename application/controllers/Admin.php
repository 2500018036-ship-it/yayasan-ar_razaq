<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model', 'model');
        $this->load->library(['session', 'form_validation', 'upload']);
        $this->load->helper(['url', 'form']);
    }

    // ============================================================
    // AUTH CHECK
    // ============================================================
    private function _check_auth()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('panel-admin/login');
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

    // ============================================================
    // LOGIN — Handles both form POST (redirect) and AJAX (JSON)
    //
    // FIX 1: The login view's JS calls 'panel-admin/login' via fetch
    //         with redirect:'manual'. This method now handles both
    //         the browser form submission (redirect) and AJAX gracefully.
    //
    // FIX 2: The original password in the DB was hashed with $2a$
    //         (bcrypt cost 12). PHP's password_verify() is compatible
    //         with $2a$ hashes — no issue there.
    //         Root cause was the login VIEW calling 'panel-admin/do-login'
    //         which DID NOT EXIST. Fixed by aligning to 'panel-admin/login'.
    // ============================================================
    public function login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            redirect('panel-admin/dashboard');
        }

        if ($this->input->post()) {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password'); // Do NOT sanitize — XSS filter mangles passwords

            $admin = $this->model->get_admin_by_username($username);

            if ($admin && password_verify($password, $admin->password)) {
                $this->session->set_userdata([
                    'admin_logged_in' => TRUE,
                    'admin_id'        => $admin->id,
                    'admin_nama'      => $admin->nama,
                    'admin_username'  => $admin->username,
                ]);

                // If AJAX request, return JSON
                if ($this->input->is_ajax_request()) {
                    $this->_json('success', 'Login berhasil!', ['redirect' => base_url('panel-admin/dashboard')]);
                }

                redirect('panel-admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah!');

                // If AJAX request, return JSON
                if ($this->input->is_ajax_request()) {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'message' => 'Username atau password salah!']);
                    exit;
                }

                redirect('panel-admin/login');
            }
        }

        $this->load->view('admin/login');
    }

    /**
     * do_login() — Dedicated JSON endpoint for AJAX login
     *
     * FIX: Added this missing method. The original login.php view was
     * posting to 'panel-admin/do-login' which returned a 404, so the
     * catch block in doLogin() always triggered "Terjadi kesalahan."
     * Now this endpoint exists and returns the JSON the view expects.
     *
     * Response format: { success: bool, message: string }
     */
    public function do_login()
    {
        if ($this->session->userdata('admin_logged_in')) {
            $this->_json('success', 'Sudah login.', ['redirect' => base_url('panel-admin/dashboard')]);
        }

        if (!$this->input->post()) {
            $this->_json('error', 'Metode tidak diizinkan.');
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password'); // Raw — do NOT run through XSS filter

        // Validate input
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
        $data['title'] = 'Dashboard';
        $data['stats'] = $this->model->get_dashboard_stats();
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
        $data['title']  = 'Manajemen Profil';
        $data['profil'] = $this->model->get_profil();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/profil', $data);
        $this->load->view('admin/layout/footer');
    }

    public function profil_update()
    {
        $this->_check_auth();
        $update_data = [
            'nama_yayasan'      => $this->input->post('nama_yayasan', TRUE),
            'tagline'           => $this->input->post('tagline', TRUE),
            'deskripsi_singkat' => $this->input->post('deskripsi_singkat', TRUE),
            'deskripsi_lengkap' => $this->input->post('deskripsi_lengkap', TRUE),
            'alamat'            => $this->input->post('alamat', TRUE),
            'telepon'           => $this->input->post('telepon', TRUE),
            'email'             => $this->input->post('email', TRUE),
            'website'           => $this->input->post('website', TRUE),
            'facebook'          => $this->input->post('facebook', TRUE),
            'instagram'         => $this->input->post('instagram', TRUE),
            'youtube'           => $this->input->post('youtube', TRUE),
            'whatsapp'          => $this->input->post('whatsapp', TRUE),
            'maps_embed'        => $this->input->post('maps_embed', TRUE),
        ];

        if (!empty($_FILES['logo']['name'])) {
            $upload_result = $this->_upload_file('logo', 'profil');
            if ($upload_result['status']) {
                $update_data['logo'] = $upload_result['file_name'];
            } else {
                $this->_json('error', $upload_result['message']);
            }
        }

        if (!empty($_FILES['hero_image']['name'])) {
            $upload_result = $this->_upload_file('hero_image', 'profil');
            if ($upload_result['status']) {
                $update_data['hero_image'] = $upload_result['file_name'];
            }
        }

        $this->model->update_profil($update_data);
        $this->_json('success', 'Data profil berhasil diperbarui!');
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

        $this->model->update('sejarah', $data, $id);
        $this->_json('success', 'Data sejarah berhasil diperbarui!');
    }

    public function sejarah_delete($id)
    {
        $this->_check_auth();
        $item = $this->model->get_by_id('sejarah', $id);
        if ($item && $item->gambar) $this->_delete_file('sejarah/' . $item->gambar);
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
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/visi_misi', $data);
        $this->load->view('admin/layout/footer');
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
        $data = [
            'judul'     => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'kategori'  => $this->input->post('kategori', TRUE) ?: 'umum',
            'urutan'    => $this->input->post('urutan', TRUE) ?: 1,
            'status'    => $this->input->post('status', TRUE) ?: 1,
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
        $data = [
            'judul'     => $this->input->post('judul', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'kategori'  => $this->input->post('kategori', TRUE) ?: 'umum',
            'urutan'    => $this->input->post('urutan', TRUE) ?: 1,
            'status'    => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'galeri');
            if ($up['status']) $data['gambar'] = $up['file_name'];
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
        $data = [
            'nama'      => $this->input->post('nama', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'ikon'      => $this->input->post('ikon', TRUE),
            'jadwal'    => $this->input->post('jadwal', TRUE),
            'pembina'   => $this->input->post('pembina', TRUE),
            'urutan'    => $this->input->post('urutan', TRUE) ?: 1,
            'status'    => $this->input->post('status', TRUE) ?: 1,
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
        $data = [
            'nama'      => $this->input->post('nama', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'ikon'      => $this->input->post('ikon', TRUE),
            'jadwal'    => $this->input->post('jadwal', TRUE),
            'pembina'   => $this->input->post('pembina', TRUE),
            'urutan'    => $this->input->post('urutan', TRUE) ?: 1,
            'status'    => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'ekskul');
            if ($up['status']) $data['gambar'] = $up['file_name'];
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

        // Ensure slug is unique
        $counter = 1;
        $base_slug = $slug;
        while ($this->model->slug_exists($slug)) {
            $slug = $base_slug . '-' . $counter++;
        }

        $data = [
            'judul'          => $judul,
            'slug'           => $slug,
            'isi'            => $this->input->post('isi'),
            'ringkasan'      => $this->input->post('ringkasan', TRUE),
            'kategori'       => $this->input->post('kategori', TRUE) ?: 'berita',
            'penulis'        => $this->input->post('penulis', TRUE),
            'tanggal_publish' => $this->input->post('tanggal_publish', TRUE) ?: date('Y-m-d'),
            'status'         => $this->input->post('status', TRUE) ?: 1,
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
        $judul = $this->input->post('judul', TRUE);
        $slug  = $this->_make_slug($judul);

        $counter = 1;
        $base_slug = $slug;
        while ($this->model->slug_exists($slug, $id)) {
            $slug = $base_slug . '-' . $counter++;
        }

        $data = [
            'judul'          => $judul,
            'slug'           => $slug,
            'isi'            => $this->input->post('isi'),
            'ringkasan'      => $this->input->post('ringkasan', TRUE),
            'kategori'       => $this->input->post('kategori', TRUE) ?: 'berita',
            'penulis'        => $this->input->post('penulis', TRUE),
            'tanggal_publish' => $this->input->post('tanggal_publish', TRUE) ?: date('Y-m-d'),
            'status'         => $this->input->post('status', TRUE) ?: 1,
        ];

        if (!empty($_FILES['gambar']['name'])) {
            $up = $this->_upload_file('gambar', 'berita');
            if ($up['status']) $data['gambar'] = $up['file_name'];
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
        $data = [
            'nama'     => $this->input->post('nama', TRUE),
            'email'    => $this->input->post('email', TRUE),
            'username' => $this->input->post('username', TRUE),
        ];

        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        if (!empty($_FILES['foto']['name'])) {
            $up = $this->_upload_file('foto', 'admin');
            if ($up['status']) $data['foto'] = $up['file_name'];
        }

        $this->model->update_admin($data, $admin_id);
        $this->session->set_userdata('admin_nama', $data['nama']);
        $this->_json('success', 'Profil akun berhasil diperbarui!');
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

    // ============================================================
    // HELPER: UPLOAD FILE
    // ============================================================
    private function _upload_file($field_name, $subfolder = '')
    {
        $upload_path = FCPATH . 'assets/images/uploads/' . ($subfolder ? $subfolder . '/' : '');
        if (!is_dir($upload_path)) mkdir($upload_path, 0755, TRUE);

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|webp',
            'max_size'      => 5120,
            'file_name'     => uniqid() . '_' . time(),
            'encrypt_name'  => TRUE,
        ];

        $this->upload->initialize($config);

        if ($this->upload->do_upload($field_name)) {
            $upload_data = $this->upload->data();
            return ['status' => TRUE, 'file_name' => $upload_data['file_name']];
        } else {
            return ['status' => FALSE, 'message' => $this->upload->display_errors('', '')];
        }
    }

    private function _delete_file($path)
    {
        $full_path = FCPATH . 'assets/images/uploads/' . $path;
        if (file_exists($full_path)) unlink($full_path);
    }
}
