<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Aktual_model');
        $this->load->model('Project_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = 'KPI Shopper';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('kpi/index');
        $this->load->view('templates/footer'); 
    }

}