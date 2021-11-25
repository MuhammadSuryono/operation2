<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('id_user')){
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Silahkan Login </strong>.
              </div>');
            redirect('block');

        } else {

            $id_user = $this->session->userdata('id_user');
            $user = $this->db->get_where('data_user', ['id_user' => $id_user])->row_array();

            if($user['id_akses'] == 2) {
                redirect('block');
            }
        }

        $this->load->model('Dashboard_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = 'Dashboard - Client';
        $data['data_user'] = $this->Dashboard_model->getAllData();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('dashboard/indexbaru', $data);
        $this->load->view('templates/footer');  
    }

    public function tambah(){
        $data['judul'] = 'Tambah User ID Client';
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tgl', 'tgl', 'required|min_length[10]|max_length[10]', [
            'min_length' => 'Format Tanggal Salah (dd-mm-yyyy). *tanpa spasi',
            'max_length' => 'Format Tanggal Salah (dd-mm-yyyy). *tanpa spasi',
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dashboard/tambah');
            $this->load->view('templates/footer');                                                                                                                                                                      
        } else {

            $this->Dashboard_model->tambah();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data User telah <strong>ditambahkan!</strong>.
              </div>');

            redirect('dashboard');
        }
    }

    public function hapus($id){
        $this->Dashboard_model->hapus($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data User telah <strong>dihapus!</strong>.
              </div>');

            redirect('dashboard');
    }

    public function ubah($id){
        $data['judul'] = 'Ubah Data User';
        $data['data_user'] = $this->Dashboard_model->getDataById($id);
        $data['jk'] = $this->db->get('data_gender')->result_array();
        
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tgl', 'tgl', 'required|min_length[10]|max_length[10]', [
            'min_length' => 'Format Tanggal Salah (dd-mm-yyyy). *tanpa spasi',
            'max_length' => 'Format Tanggal Salah (dd-mm-yyyy). *tanpa spasi',
        ]);

        if($this->form_validation->run() == false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('dashboard/ubah', $data);
            $this->load->view('templates/footer'); 
        } else {
            $this->Dashboard_model->ubah($id);

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data User telah <strong>diubah!</strong>.
              </div>');

            redirect('dashboard');
        }
        
    }

}