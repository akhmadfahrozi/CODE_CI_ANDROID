<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Json extends CI_Controller
{
    
    function login_json() {
        $id_user = $this->input->get('id_user');
        $username = $this->input->get('username');
        $password = $this->input->get('password');
        //loadmodel
        $this->load->model('Model_m', NULL);
        $data['data'] = array();
        $rest = $this->Model_m->login($username, $password)->result();
        foreach ($rest as $value) {
            $json = array();
            $json['username'] = $value->username;
            $json['name'] = $value->name;
            $json['id_user'] = $value->id_user;
            array_push($data['data'], $json);
        }
        print json_encode($data);
    }

    public function index()
    {
        $berita = $this->Model_m->getListBerita();
        $data['data'] = array();
        $response = array();

        if (sizeof($berita) > 0) {
            foreach ($berita as $content) {
                $response['id'] = $content->id_berita;
                $response['judul'] = $content->judul_berita;
                $response['isi_berita'] = $content->isi_berita;
                $response['gambar'] = $content->gambar;
                $response['tgl_berita'] = date_format(date_create($content->tgl_berita), "d/m/Y H:i");
				$response['kategori'] = $content->kategori_berita;
				$response['viewer'] = $content->viewer_berita;
                array_push($data['data'], $response);
            }

            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }
	
	public function berita_utama()
    {
        $berita = $this->Model_m->getListBerita();

        $data['data'] = array();
        $response = array();

        if (sizeof($berita) > 0) {
            foreach ($berita as $content) {
				if($content->berita_utama==1){
                $response['id'] = $content->id_berita;
                $response['judul'] = $content->judul_berita;
                $response['isi_berita'] = $content->isi_berita;
                $response['gambar'] = $content->gambar;
                $response['tgl_berita'] = date_format(date_create($content->tgl_berita), "d/m/Y H:i");
				$response['kategori'] = $content->kategori_berita;
				$response['viewer'] = $content->viewer_berita;
                array_push($data['data'], $response);
				}
            }

            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }

    public function get_berita($id = null)
    {
        $berita = $this->Model_m->getDetailBerita($id);
        $data['data'] = array();
        $response = array();

        if (sizeof($berita) > 0) {
            foreach ($berita as $key => $content) {
                $response['id'] = $content->id_berita;
                $response['isi_berita'] = $content->isi_berita;
                $response['judul'] = $content->judul_berita;
                $response['gambar'] = $content->gambar;
                $response['tgl_berita'] = date_format(date_create($content->tgl_berita), "d/m/Y H:i");
				$response['kategori'] = $content->kategori_berita;
				$response['viewer'] = $content->viewer_berita;
                array_push($data['data'], $response);
            }
            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }


    public function cari_berita()
    {
        $berita = $this->Model_m->cariBerita($this->input->get('s'));
        $data['data'] = array();
        $response = array();

        if (sizeof($berita) > 0) {
            foreach ($berita as $key => $content) {
                $response['id'] = $content->id_berita;
                $response['isi_berita'] = $content->isi_berita;
                $response['judul'] = $content->judul_berita;
                $response['gambar'] = $content->gambar;
                $response['tgl_berita'] = date_format(date_create($content->tgl_berita), "d/m/Y H:i");
				$response['kategori'] = $content->kategori_berita;
				$response['viewer'] = $content->viewer_berita;
                array_push($data['data'], $response);
            }
            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }
	
	 public function berita_populer()
    {
        $berita = $this->Model_m->getBeritaPopuler();

        $data['data'] = array();
        $response = array();

        if (sizeof($berita) > 0) {
            foreach ($berita as $content) {
                $response['id'] = $content->id_berita;
                $response['judul'] = $content->judul_berita;
                $response['isi_berita'] = $content->isi_berita;
                $response['gambar'] = $content->gambar;
                $response['tgl_berita'] = date_format(date_create($content->tgl_berita), "d/m/Y H:i");
				$response['kategori'] = $content->kategori_berita;
				$response['viewer'] = $content->viewer_berita;
                array_push($data['data'], $response);
            }

            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }
	
	public function getVideo()
    {
        $berita = $this->Model_m->getListvideo();

        $data['data'] = array();
        $response = array();

        if (sizeof($berita) > 0) {
            foreach ($berita as $content) {
                $response['id'] = $content->id_video;
                $response['judul'] = $content->judul_video;
                $response['video'] = $content->video;
                $response['tgl_video'] = date_format(date_create($content->tgl_video), "d/m/Y H:i");
                array_push($data['data'], $response);
            }

            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }
	
	function get_kategori() {
        $res = $this->Model_m->getKategori();
        $data['data'] = array();
        $response = array();
 
        if (sizeof($res) > 0) {
            foreach ($res as $content) {
                $response['kategori_berita'] = $content->kategori_berita;
                array_push($data['data'], $response);
            }
            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }
 
    function getNewsByKategori() {
        $param = $this->input->post("kategori");
        $res = $this->Model_m->getNewsByKategori($param);
 
        $response = array();
        $data['data'] = array();
 
        if (sizeof($res) > 0) {
            foreach ($res as $content) {
                $response['id'] = $content->id_berita;
                $response['judul'] = $content->judul_berita;
                $response['isi_berita'] = $content->isi_berita;
                $response['gambar'] = $content->gambar;
                $response['tgl_berita'] = date_format(date_create($content->tgl_berita), "d/m/Y H:i");
                $response['kategori'] = $content->kategori_berita;
                $response['viewer'] = $content->viewer_berita;
                array_push($data['data'], $response);
            }
            echo json_encode($data);
        } else {
            echo json_encode($data);
        }
    }
    function tambah_berita(){
        $this->load->model("Model_m",NULL);
        
    
        $judul_berita = $this->input->get('judul_berita');
        $isi_berita = $this->input->get('isi_berita');
       
        
        $res = $this->Model_m->tambah_murid($judul_berita,$isi_berita);
        if ($res > 0){
            $data['message']="Berhasil menambah data murid";
            print json_encode($data);
        }else{
            $data['message']="Error saat memproses data";
            print json_encode($data);
        }
    }
    function upload_file(){
        $nama_pan = $this->input->post('nama_pan');
        $Kabupaten_atau_kota = $this->input->post('Kabupaten_atau_kota');
        $Kecamatan = $this->input->post('Kecamatan');
        $Jabatan = $this->input->post('Jabatan');
         $NIK = $this->input->post('NIK');
          $Tanggal_Lahir = $this->input->post('Tanggal_Lahir');
          $Divisi = $this->input->post('Divisi');
          $Tempat_Lahir = $this->input->post('Tempat_Lahir');
          $Agama = $this->input->post('Agama');
          $Jenis_Kelamin = $this->input->post('Jenis_Kelamin');
          $Status_perkawinan = $this->input->post('Status_perkawinan');
          $alamat = $this->input->post('alamat');
          $Email = $this->input->post('Email');
          $pendidikan = $this->input->post('pendidikan');
          $pekerjaan_sebelumnya = $this->input->post('pekerjaan_sebelumnya');
          $Tanggal_Pengangkatan = $this->input->post('Tanggal_Pengangkatan');
          $NO_sk = $this->input->post('NO_sk');
          $Penggalaman_Kepemiluan = $this->input->post('Penggalaman_Kepemiluan');
        
        
        
       //tujuan upload//bikin folder baru
        $config['upload_path'] = "./assets/gambar/";
        //gunakan mime type
        //untuk file JPG mime type image/jpg 
        
        //bintang berarti semua file bsa
        $config['allowed_types']="*";
        //maximum file
        $config['max_size'] = 0;
        
        $config['overwrite']= true;  
        
        $this->load->library('upload',$config);
        
        if(!$this->upload->do_upload('file')){
            $res=0;
            echo json_encode($this->upload->display_errors());
        }else{
            $meta = $this->upload->data();
            $fileNames=$meta['file_name'];
            //ambil ama file dari file panggil_yang terupload 
            //proses insert 
            $dataInsertArray = array(
                'foto' => $fileNames,
                'nama_pan '=>$nama_pan,
            'Kabupaten_atau_kota '=>$Kabupaten_atau_kota,
                'Kecamatan '=>$Kecamatan,
                'Jabatan '=>$Jabatan,
                'NIK '=>$NIK,
                'Tanggal_Lahir'=>$Tanggal_Lahir,
                'Divisi'=>$Divisi,
                'Tempat_Lahir'=>$Tempat_Lahir,
                'Agama'=>$Agama,
                'Jenis_Kelamin'=>$Jenis_Kelamin,
                'Status_perkawinan'=>$Status_perkawinan,
                'alamat'=>$alamat,
                'Email'=>$Email,
                'pendidikan'=>$pendidikan,
                'pekerjaan_sebelumnya'=>$pekerjaan_sebelumnya,
                'Tanggal_Pengangkatan'=>$Tanggal_Pengangkatan,
                'NO_sk'=>$NO_sk,
                'Penggalaman_Kepemiluan'=>$Penggalaman_Kepemiluan,

                   
            );
            $this->load->model("Model_m");
            $res = $this->Model_m->insert_poto("Pendaftaran",$dataInsertArray);
        }
        if($res > 0){
            $data['message']="file berhasil di upload";
            $data['code']= 200;        
        }else{
             $data['message']="file gagal di upload";
             $data['code']= 500;    
        }
        echo json_encode($data);
    }
    function tampil(){
        $this->load->view('welcome_message');
    }
}
