<?php

class Model_m extends CI_Model
{
    function login($username, $password) {
        $query = $this->db->query("select * from user where username='$username' and password='$password'");
        return$query;
    }
    public function getListBerita()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('tgl_berita', 'desc');
        
        return $this->db->get()->result();
    }
	
	public function getListVideo()
    {
        $this->db->select('*');
        $this->db->from('video');
        $this->db->order_by('tgl_video', 'desc');
        
        return $this->db->get()->result();
    }
	
	public function getBeritaPopuler()
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->order_by('viewer_berita', 'desc');
        
        return $this->db->get()->result();
    }

    public function getDetailBerita($idBerita)
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->where('id_berita', $idBerita);
        
        return $this->db->get()->result();
    }

    public function cariBerita($judul)
    {
        $this->db->select('*');
        $this->db->from('berita');
        $this->db->like('judul_berita', $judul);

        return $this->db->get()->result();
    }
	public function getKategori() {
        return $this->db->query("SELECT kategori_berita FROM berita GROUP BY kategori_berita")->result();
    }
 
    public function getNewsByKategori($kat) {
        return $this->db->query("SELECT * FROM berita WHERE kategori_berita LIKE '%$kat%'")->result();
    }
    function tambah_murid($judul_berita, $isi_berita) {
        $data = array(
            
            'judul_berita' => $judul_berita,
            'isi_berita' => $isi_berita,
        
        );
        $this->db->insert('berita', $data);
        return $this->db->affected_rows();
    }
     function insert_poto($Pendaftaran,$data){
        $this->db->insert($Pendaftaran, $data);
        return $this->db->affected_rows();
        
    }
}
