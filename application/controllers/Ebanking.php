<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebanking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cabang_model');
        $this->load->model('Skenario_model');
        $this->load->library('form_validation');

    }

    public function index(){
    // $id_user = $this->session->userdata('id_user');
    $data['judul'] = "E-Banking";
    
    
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
        $this->load->view('ebanking/form', $data);
        $this->load->view('templates/footer');
    }



}