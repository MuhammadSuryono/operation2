<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        //AUTH
        // if(!$this->session->userdata('id_user')){
        //     $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
        //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        //         <strong> Silahkan Login </strong>.
        //       </div>');
        //     redirect('block');

        // } else {

        //     $id_user = $this->session->userdata('id_user');
        //     $user = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

        //     if($user['id_akses'] == 2) {
        //         redirect('block');
        //     }
        // }

        //AUTH2
        if(!$this->session->userdata('id_user')){
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Silahkan Login </strong>.
              </div>');
            redirect('block');

        } else {

            $id_user = $this->session->userdata('id_user');
            $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();

            if($user['id_akses'] == 2) {
                redirect('block');
            }
        }

        $this->load->model('Dashboard_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = 'MRI-ENTERPRISE';
        // $data['data_user'] = $this->Dashboard_model->getAllData();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('welcome_message');
        $this->load->view('templates/footer');  
    }
}
