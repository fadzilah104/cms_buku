<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    var $limit=10;
	var $offset=10;

    public function __construct() {
        parent::__construct();
        $this->load->model('m_buku'); //load model m_buku yang berada di folder model
        $this->load->helper(array('url')); //load helper url
        $this->load->library('upload'); // memanggil library upload 

    }

	public function index($page=NULL,$offset='',$key=NULL)
	{        
        $data['query'] = $this->m_buku->get_buku(); //query dari model
        
        $this->load->view('home',$data); //tampilan awal ketika controller upload di akses
	}

    public function add() {
        //view yang tampil jika fungsi add diakses pada url
        $this->load->view('add_buku');
       
    }
    public function insert(){
        $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './assets/uploads/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        
        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data = array(
                  'cover' =>$gbr['file_name'],
                  'judul' =>$this->input->post('judul'),
                  'pengarang' =>$this->input->post('pengarang'),
                  'penerbit' =>$this->input->post('penerbit'),
                  'id_kategori' =>$this->input->post('kategori'),
                  'isbn' =>$this->input->post('isbn'),
                  'tahun_terbit' =>$this->input->post('thn_terbit')
                  
                );

                $this->m_buku->get_insert($data); //akses model untuk menyimpan ke database

                $config2['image_library'] = 'gd2'; 
                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config2['new_image'] = './assets/hasil_resize/'; // folder tempat menyimpan hasil resize
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 100; //lebar setelah resize menjadi 100 px
                $config2['height'] = 100; //lebar setelah resize menjadi 100 px
                $this->load->library('image_lib',$config2); 

                //pesan yang muncul jika resize error dimasukkan pada session flashdata
                if ( !$this->image_lib->resize()){
                $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
              }
                //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil Ditambahkan !!</div></div>");
                redirect('buku'); //jika berhasil maka akan ditampilkan view upload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Data Gagal Ditambahkan !!</div></div>");
                redirect('buku/add'); //jika gagal maka akan ditampilkan form upload
            }
        }
    }

    public function edit($id_buku) {
        //view yang tampil jika fungsi add diakses pada url
        $data['title'] = "Daftar Buku";
        $data['buku'] = $this->m_buku->select_by_id($id_buku)->row();
        $this->load->view('edit_buku', $data);
       
    }


    public function proses_edit_buku() {

        $this->dicoba();
        // $data['judul'] = $this->input->post('judul');
        // $data['pengarang'] = $this->input->post('pengarang');
        // $data['penerbit'] = $this->input->post('penerbit');
        // $data['id_kategori'] = $this->input->post('kategori');
        // $data['isbn'] = $this->input->post('isbn');
        // $data['tahun_terbit'] = $this->input->post('thn_terbit');
        // $id_buku = $this->input->post('id_buku');
        // $res = $this->m_buku->update_buku($id_buku, $data);

        // if($res >= 0) {
        //     $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diubah !!</div></div>");
        //         redirect('buku'); //jika berhasil maka akan ditampilkan view upload
        //     }else{
        //         //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
        //         $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Data Gagal Ditambahkan !!</div></div>");
        //         redirect('buku/edit'); //jika gagal maka akan ditampilkan form upload
        //     }

        $data['judul'] = $this->input->post('judul');
        $data['pengarang'] = $this->input->post('pengarang');
        $data['penerbit'] = $this->input->post('penerbit');
        $data['id_kategori'] = $this->input->post('kategori');
        $data['isbn'] = $this->input->post('isbn');
        $data['tahun_terbit'] = $this->input->post('thn_terbit');
        $id_buku = $this->input->post('id_buku');
        $this->m_buku->update_buku($id_buku, $data);


        if($_FILES['filefoto']['name'])
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $data['cover'] = $gbr['file_name'];
                $id_buku2 = $this->input->post('id_buku');
                $this->m_buku->update_buku($id_buku2, $data); //akses model untuk menyimpan ke database

                $config2['image_library'] = 'gd2'; 
                $config2['source_image'] = $this->upload->upload_path.$this->upload->file_name;
                $config2['new_image'] = './assets/hasil_resize/'; // folder tempat menyimpan hasil resize
                $config2['maintain_ratio'] = TRUE;
                $config2['width'] = 100; //lebar setelah resize menjadi 100 px
                $config2['height'] = 100; //lebar setelah resize menjadi 100 px
                $this->load->library('image_lib',$config2); 

                //pesan yang muncul jika resize error dimasukkan pada session flashdata
                if ( !$this->image_lib->resize()){
                $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));   
              }
                //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diubah !!</div></div>");
                redirect('buku'); //jika berhasil maka akan ditampilkan view upload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Data Gagal Ditambahkan !!</div></div>");
                redirect('buku/edit'); //jika gagal maka akan ditampilkan form upload
            }
        }

        $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil Diubah !!</div></div>");
                redirect('buku'); //jika berhasil maka akan ditampilkan view upload


    }

    // public function edit_buku($id_buku) {
    //     $data['title'] = "Daftar Buku";
    //     $data['buku'] = $this->m_buku->select_by_id($id_buku)->row();
    //     $this->load->view('daftaragenda/form_edit_agenda', $data);
    // }

    public function deletebuku($id_buku) {
        $res = $this->m_buku->delete('buku', 'id_buku', $id_buku);
        if($res >= 0) {
        //pesan yang muncul jika berhasil diupload pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-success\" id=\"alert\">Data Berhasil Dihapus !!</div></div>");
                redirect('buku'); //jika berhasil maka akan ditampilkan view upload
            }else{
                //pesan yang muncul jika terdapat error dimasukkan pada session flashdata
                $this->session->set_flashdata("pesan", "<div class=\"col-md-12\"><div class=\"alert alert-danger\" id=\"alert\">Data Gagal Dihapus !!</div></div>");
                redirect('buku'); //jika gagal maka akan ditampilkan form upload
            }
    }

    public function dicoba() {
        $nmfile = "file_".time(); //nama file saya beri nama langsung dan diikuti fungsi time
        $config['upload_path'] = './assets/uploads/'; //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '3072'; //maksimum besar file 3M
        $config['max_width']  = '5000'; //lebar maksimum 5000 px
        $config['max_height']  = '5000'; //tinggi maksimu 5000 px
        $config['file_name'] = $nmfile; //nama yang terupload nantinya

        $this->upload->initialize($config);
        
    }
}
