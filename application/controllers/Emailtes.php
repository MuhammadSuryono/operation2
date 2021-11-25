<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailtes extends CI_Controller {

    public function index(){
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'smks.tunasteknologi@gmail.com',
            'smtp_pass' => 'Iwayriway21',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->email->initialize($config);
        $this->load->library('email', $config);

        $this->email->from('smks.tunasteknologi@gmail.com', 'SMK Tunas Teknologi');
		$this->email->to('riway.restu@gmail.com');
		$this->email->message('Testing');
		$this->email->send();
    }
    
    public function test(){
        $this->load->view('templates/headertest');
        $this->load->view('templates/sidetest');
        $this->load->view('templates/main');
        $this->load->view('templates/footertest');  
    }
}