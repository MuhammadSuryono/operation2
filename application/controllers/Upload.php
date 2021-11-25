<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Aktual_model');
        $this->load->model('Upload_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = 'Daftar Data Equest';
        $data['skenario'] = $this->db->get('data_skenario')->result_array();
        $data['buat_equest'] = [];
        $data['buat_equest1'] = [];

        if($this->input->post('div2')){
            $data['buat_equest'] = $this->Upload_model->getKolomDivDP();
            $data['buat_equest1'] = $this->Upload_model->getKolomDivRE();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('upload/index', $data);
        $this->load->view('templates/footer'); 
    }

    public function tambah(){
        $img1 = $_FILES['berkas']['name'];
        // var_dump($img1); die;

        if($img1){
            $config['upload_path']          = './assets/file/kolom/';
            $config['allowed_types']        = 'xls|xlsx';

            $this->load->library('upload', $config);
            if($this->upload->do_upload('berkas')) {
                $img = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->Upload_model->upload($img);
        redirect('upload');
    }

    public function download($id){
        $file = $this->db->get_where('data_upload', ['id_upload' => $id])->row_array();
        $berkas = FCPATH . '/assets/file/kolom/' . $file['file_upload'];
        force_download($berkas, NULL);
    }
}