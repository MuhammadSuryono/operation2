<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Rekap_model');
        $this->load->model('Skenario_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = 'Rekap Skill Dialog';
        $data['skenario'] = $this->db->get('data_project')->result_array();//$this->Skenario_model->getAllData();
        $data['buat_equest'] = [];

        if($this->input->post('project')){
            $data['buat_equest'] = $this->Rekap_model->getDataDialog($this->input->post('project'));
        }

        if($this->uri->segment(3)){
            $data['buat_equest'] = $this->Rekap_model->getDataDialog($this->uri->segment(3));
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekap/index', $data);
        $this->load->view('templates/footer'); 
    }

    public function rekap($id){
        $data['judul'] = 'Rekap Skill Dialog';
        $data['dialog'] = $this->Rekap_model->getDialogById($id);
        // $this->form_validation->set_rules('col1', 'Understanding', 'required');
        // $this->form_validation->set_rules('col2', 'Col2', 'required');
        // $this->form_validation->set_rules('col3', 'Col3', 'required');
        // $this->form_validation->set_rules('col4', 'Col4', 'required');
        // $this->form_validation->set_rules('col5', 'Col5', 'required');

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('rekap/rekap', $data);
            $this->load->view('templates/footer'); 
        } else {
            
        }
    }

    public function rekap1(){
        $this->Rekap_model->simpanDialog();

            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Dialog telah berhasil <strong>direkap!</strong>.
                </div>');
            $id = $this->input->post('project');
            redirect("rekap/index/$id");
    }

    public function hasil(){
        $data['judul'] = 'Hasil Rekap Skill Dialog';
        // $data['skenario'] = $this->Skenario_model->getAllData();
        $data['skenario'] = $this->db->get('data_project')->result_array();
        $data['skill'] = $this->db->get('data_skill')->result_array();
        $data['rekap'] = [];
        $data['skn'] = '';

        if($this->input->post('project')){
            $data['skn'] = $this->input->post('project');
            $data['rekap'] = $this->Rekap_model->getDataRekap($this->input->post('project'));
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekap/hasil', $data);
        $this->load->view('templates/footer'); 
    }

    public function cetak($id){
        $data['judul'] = $this->db->get_where('data_skenario', ['id_skenario' => $id])->row_array();
        $data['skill'] = $this->db->get('data_skill')->result_array();
        $data['rekap'] = $this->Rekap_model->getDataRekap($id);
        $this->load->view('rekap/cetak', $data);
    }

    public function buatkolom(){
        $data['judul'] = "Form Pembuatan Kolom Skill";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('rekap/buatkolom', $data);
        $this->load->view('templates/footer'); 
    }

    public function simpankolom(){
        $this->Rekap_model->simpankolom();
        redirect('rekap/buatkolom');        
    }
}