<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ebanking extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ebanking_model');
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

    public function image_ebanking()
    {
        $data['judul'] = "Data Image E-Banking";
        $data['project'] = $this->Ebanking_model->getproject();
        $data['transaksi'] = $this->Ebanking_model->gettransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('ebanking/image_ebanking', $data);
        $this->load->view('templates/footer');
    }

    public function getlist_image()
    {
        $pro = $_POST['pro'];
        $transaksi = $_POST['transaksi'];

        $data = $this->Ebanking_model->getlist_image($pro, $transaksi);

        echo json_encode($data);
    }



}