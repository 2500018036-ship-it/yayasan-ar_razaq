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
    public function get_galeri_aktif($kategori = null, $limit = 0)
    {
        $this->db->where('status', 1);
        if ($kategori) $this->db->where('kategori', $kategori);
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
    // ADMIN AUTH
    // ============================================================
    public function get_admin_by_username($username)
    {
        return $this->db->where('username', $username)->get('admin')->row();
    }

    public function get_admin_by_id($id)
    {
        return $this->db->where('id', $id)->get('admin')->row();
    }

    public function update_admin($data, $id)
    {
        return $this->db->where('id', $id)->update('admin', $data);
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
