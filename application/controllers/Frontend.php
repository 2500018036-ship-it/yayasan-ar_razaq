<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model', 'model');
    }

    private function _get_base_data()
    {
        $profil = $this->model->get_profil();
        return [
            'profil'    => $profil,
            'statistik' => $this->model->get_statistik(),
        ];
    }

    public function index()
    {
        $data = $this->_get_base_data();
        $data['title']      = 'Beranda';
        $data['sejarah']    = $this->model->get_sejarah_aktif();
        $data['visi']       = $this->model->get_visi_misi('visi');
        $data['misi']       = $this->model->get_visi_misi('misi');
        $data['nilai']      = $this->model->get_visi_misi('nilai');
        $data['galeri']     = $this->model->get_galeri_aktif(null, 8);
        $data['ekskul']     = $this->model->get_ekskul_aktif();
        $data['berita']     = $this->model->get_berita_aktif(3);
        $data['ppdb']       = $this->model->get_ppdb_aktif();
        $this->load->view('templates/header', $data);
        $this->load->view('frontend/home', $data);
        $this->load->view('templates/footer', $data);
    }

    public function berita()
    {
        $data = $this->_get_base_data();
        $data['title']  = 'Berita & Informasi';
        $data['berita'] = $this->model->get_berita_aktif();
        $this->load->view('templates/header', $data);
        $this->load->view('frontend/berita', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detail_berita($slug)
    {
        $berita = $this->model->get_berita_by_slug($slug);
        if (!$berita) show_404();
        $this->model->increment_views($berita->id);
        $data = $this->_get_base_data();
        $data['title']  = $berita->judul;
        $data['berita'] = $berita;
        $data['berita_terkait'] = $this->model->get_berita_aktif(3);
        $this->load->view('templates/header', $data);
        $this->load->view('frontend/detail_berita', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ppdb()
    {
        $data = $this->_get_base_data();
        $data['title'] = 'Penerimaan Santri Baru';
        $data['ppdb']  = $this->model->get_ppdb_aktif();
        $this->load->view('templates/header', $data);
        $this->load->view('frontend/ppdb', $data);
        $this->load->view('templates/footer', $data);
    }
}
