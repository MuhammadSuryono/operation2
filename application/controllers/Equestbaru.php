<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equestbaru extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Equestbaru_model');
        $this->load->model('Skenario_model');
        $this->load->library('form_validation');
    }

    public function equest(){
        $data['judul'] = 'Buat Equest';

        // MRI OPERATION8
        $data['skenario'] = $this->Equestbaru_model->getAllData();
        $data['buat_equest'] = $this->Equestbaru_model->getDataBuatEquest();
        // AKHIR

        // KERJA BAKTI
        $data['skenario'] = $this->Equestbaru_model->getAllDataKB();
        $data['buat_equest'] = $this->Equestbaru_model->getDataBuatEquestKB();
        // AKHIR

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestbaru/indexKB', $data);
        $this->load->view('templates/footer'); 
    }

    public function skenario(){
        // $this->Equestbaru_model->simpanskenario();
        $this->Equestbaru_model->simpanskenarioKB();

        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Equest telah berhasil <strong>ditambahkan!</strong>.
                </div>');

        redirect('equestbaru/equest');

        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar');
        // $this->load->view('equestbaru/tambah', $data);
        // $this->load->view('templates/footer'); 
    }

    public function buat($id){
        $data['judul'] = 'Buat Equest';
        $data['skenario'] = $id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestbaru/tambah', $data);
        $this->load->view('templates/footer'); 
    }

    public function simpan(){
        // $jumlah = $this->input->post('jmlsoal');
        // $id_pembuat = $this->input->post('id_skenario');
        // var_dump($this->input->post($jumlah));
        // var_dump($this->input->post($id_pembuat));
        // die;
        $this->Equestbaru_model->simpanequest();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Soal Equest telah berhasil <strong>ditambahkan!</strong>.
                </div>');
        redirect('equestbaru/equest');
        // var_dump($this->input->post('id_skenario'));
        // var_dump($this->input->post('jmlsoal'));
        // die;
    }

    public function lihat($pembuat){
        // $data['skenario'] = $this->db->get_where('data_skenario',['id_skenario' => $id_skenario])->row_array();
        // $soal = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id_skenario])->row_array();
        // $data['id_pembuat_soal'] = $soal['id_pembuat_equest'];
        $data['id_pembuat_soal'] = $pembuat;
        // $data['soal_equest'] = $this->Equestbaru_model->soalEquest($id_skenario);
        $data['soal_equest'] = $this->Equestbaru_model->soalEquestKB($pembuat);
        $data['skenario'] = $this->db->query("SELECT a.*, b.nama_project, c.nama as skenarioxx from attribute c join ( data_pembuat_equest a join data_project b on a.kode_project=b.kode_project) on a.kategori=c.kode where a.id_pembuat_equest='$pembuat'")->row_array();
        $data['judul'] = 'Soal Equest';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestbaru/lihat', $data);
        $this->load->view('templates/footer'); 
    }

    public function hapus($id){
        $this->Equestbaru_model->hapus($id);
        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Soal Equest telah <strong>dihapus!</strong>.
                </div>');
        redirect('equestbaru/equest');
    }

    public function ubah($pembuat){
        // $data['skenario'] = $this->db->get_where('data_skenario',['id_skenario' => $id_skenario])->row_array();
        // $soal = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id_skenario])->row_array();
        $data['id_pembuat_soal'] = $pembuat;
        $data['soal_equest'] = $this->Equestbaru_model->soalEquestKB($pembuat);
        $data['skenario'] = $this->db->query("SELECT a.*, b.nama_project, c.nama as skenarioxx from attribute c join ( data_pembuat_equest a join data_project b on a.kode_project=b.kode_project) on a.kategori=c.kode where a.id_pembuat_equest='$pembuat'")->row_array();
        $data['judul'] = 'Ubah Soal Equest';
        // var_dump($data['soal_equest']); die;    

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestbaru/ubah', $data);
        $this->load->view('templates/footer');
    }

    public function ubahbyid(){
        $id = $_POST['id'];
        $kode = $_POST['kode'];
        $soal = $_POST['soal'];
        $data =  [
            'kode_soal' => $kode,
            'soal_equest' => $soal,
        ];

        $this->db->where('id_soal_equest', $id);
        $this->db->update('data_soal_equest', $data);
		
		// echo json_encode($data);
    }

     public function ubahbyid1(){
        $id = $_POST['id'];
        $soal = $_POST['kode'];
        $kode = $_POST['soal'];
        $jump1 = $_POST['jump'];
        $data =  [
            'kode_pg_equest' => $kode,
            'pg_equest' => $soal,
            'ket_soal' => $jump1,
        ];

       $this->db->where('id_pg_equest', $id);
      $this->db->update('data_pg_equest', $data);
		
		// echo json_encode($data);
    }

    public function savepgedit(){
        $id = $_POST['id'];
        $soal = $_POST['kode'];
        $kode = $_POST['soal'];
        $jump = $_POST['jump'];

        $data =  [
            'id_soal_equest' => $id,
            'kode_pg_equest' => $soal,
            'pg_equest' => $kode,
            'ket_soal' => $jump,
        ];

        $this->db->insert('data_pg_equest', $data); 
        $data = $this->db->get_where('data_pg_equest', ['id_soal_equest' => $id,
            'kode_pg_equest' => $soal,
            'pg_equest' => $kode,
            'ket_soal' => $jump])->row_array();
        echo json_encode($data);
    }

    public function hapusbyid(){
        $id = $_POST['id'];
        $this->db->delete('data_soal_equest', ['id_soal_equest' => $id]);
        $this->db->delete('data_pg_equest', ['id_soal_equest' => $id]);
    }

    public function hapuspgbyid(){
        $id = $_POST['id'];
        $this->db->delete('data_pg_equest', ['id_pg_equest' => $id]);
    }

    public function libraryEquest(){
        $data['judul'] = "Library Equest";
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestbaru/libraryEquest', $data);
        $this->load->view('templates/footer');
    }

    public function buatLibraryEquest(){
        var_dump($this->input->post('nama'));
        $data['nama'] = $this->input->post('nama');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestbaru/buatLibraryEquest', $data);
        $this->load->view('templates/footer');
    }
    
    public function simpanLibraryEquest(){
        $this->Equestbaru_model->simpanLibraryEquest();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Soal Equest telah berhasil <strong>ditambahkan!</strong>.
                </div>');
        redirect('equestbaru/libraryEquest');
    }

}