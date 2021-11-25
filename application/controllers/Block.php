<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Block extends CI_Controller {

    public function index(){
        $this->load->view('templates/blocked');
    }

    public function contoh(){
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/galeri');
        $this->load->view('templates/footer');
    }
}