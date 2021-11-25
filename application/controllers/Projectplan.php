<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Projectplan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('id_user')) {
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Silahkan Login </strong>.
              </div>');
            redirect('block');
        } else {

            $id_user = $this->session->userdata('id_user');
            $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();

            if ($user['id_akses'] == 2) {
                redirect('block');
            }
        }

        $this->load->model('Project_model');
        $this->load->model('Projectplan_model');
        $this->load->model('Task_model');
        $this->load->library('form_validation');
        $this->load->library('Pdf');
    }
    public function index()
    {

        $id = $this->session->userdata('id_user');
        $data['judul'] = 'MRI Operation';
        $data['jumlah_data'] = $this->Project_model->getRowData($id);

        // PAGINATION
        $this->load->library('pagination');

        $config['base_url'] = 'http://localhost/mri-operation/project/index';
        $config['total_rows'] = $this->Project_model->getRowData($id);
        $config['per_page'] = 10;

        $config['full_tag_open'] = '<nav class="mt-3"><ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'Awal';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Akhir';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);

        if ($data['start'] == "") {
            $data['start'] = 0;
        }
        $data['data_project'] = $this->Project_model->getAllDataForPlan($id, $data['start'], $config['per_page']);
        // PAGINATION

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('projectplan/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($kode)
    {
        $data['judul'] = 'MRI Operation';
        $data['jumlah_data'] = 1;

        $data['project_plan'] = $this->Projectplan_model->getByProject($kode);
        $data['project'] = $this->Project_model->getProjectById($kode);
        $data['task'] = $this->Task_model->getAllData();

        // PAGINATION
        $this->load->library('pagination');

        $config['base_url'] = 'http://localhost/mri-operation/project/index';
        $config['total_rows'] = $this->Projectplan_model->countByProject($kode);
        $config['per_page'] = 10;

        $config['full_tag_open'] = '<nav class="mt-3"><ul class="pagination pagination-sm justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'Awal';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Akhir';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');



        $this->pagination->initialize($config);
        // $data['start'] = $this->uri->segment(3);

        $data['start'] = 0;
        // }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('projectplan/view', $data);
        $this->load->view('templates/footer');
    }

    public function store()
    {
        $checkSpec = $this->Projectplan_model->countPsByProject($this->input->post('project_kode'));
        if (!$checkSpec) {
            $this->Projectplan_model->tambahProjectSpec();
        }

        $this->Projectplan_model->tambah();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Data Kegiatan Project telah <strong>ditambahkan!</strong>.
            </div>');
        redirect('projectplan/view/' . $this->input->post('project_kode'));
    }

    public function update()
    {
        $this->Projectplan_model->edit();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Data Kegiatan Project telah <strong>diubah!</strong>.
            </div>');
        redirect('projectplan/view/' . $this->input->post('project_kode'));
    }

    public function delete()
    {
        $this->Projectplan_model->delete($this->input->post('id'));
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Data Kegiatan Project telah <strong>diubah!</strong>.
            </div>');
        redirect('projectplan/view/' . $this->input->post('project_kode'));
    }

    public function storeTask()
    {
        $this->Task_model->tambah();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Data Kegiatan Project telah <strong>ditambahkan!</strong>.
            </div>');
        redirect('projectplan/view/' . $this->input->post('project_kode'));
    }

    public function spec($kode)
    {
        $data['judul'] = 'MRI Operation';
        $data['jumlah_data'] = 1;

        $data['project'] = $this->Project_model->getProjectById($kode);
        $data['ps'] = $this->Projectplan_model->getPsByKode($kode);
        // $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar');
        $this->load->view('projectplan/spec', $data);
        // $this->load->view('templates/footer');
    }

    public function updateSpec($kode)
    {
        // die;    
        $this->Projectplan_model->updateSpec($this->input->post('project_kode'));
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Data Project Spec telah <strong>disimpan!</strong>.
        </div>');
        redirect('projectplan/spec/' . $this->input->post('project_kode'));
    }

    public function updatePP()
    {
        $kode = $_GET['kode'];
        $data = $this->Projectplan_model->updatePP($kode);
        echo json_encode($data);
    }

    public function updateUserSpec()
    {
        $kode = $_GET['kode'];
        $data = $this->Projectplan_model->updateUserSpec($kode);
        $arrUser = [];
        if ($data['user_created']) {
            $user = $this->db->query("SELECT name FROM user WHERE noid = '$data[user_created]'")->row_array();
            array_push($arrUser, $user['name']);
        }
        if ($data['user_checked']) {
            $user = $this->db->query("SELECT name FROM user WHERE noid = '$data[user_checked]'")->row_array();
            array_push($arrUser, $user['name']);
        }
        if ($data['user_approved']) {
            $user = $this->db->query("SELECT name FROM user WHERE noid = '$data[user_approved]'")->row_array();
            array_push($arrUser, $user['name']);
        }
        echo json_encode($arrUser);
    }

    public function checkedProjectSpec($kode)
    {
        $data = $this->Projectplan_model->checkSpec($kode);
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Data Project Spec telah <strong>di check!</strong>.
        </div>');

        redirect('projectplan/spec/' . $kode);
    }

    public function approvedProjectSpec($kode)
    {
        $data = $this->Projectplan_model->approveSpec($kode);
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Data Project Spec telah <strong>di setujui!</strong>.
        </div>');

        redirect('projectplan/spec/' . $kode);
    }

    public function revisionProjectSpec($kode)
    {
        $dompdf = new Pdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $docPS = $this->Projectplan_model->getPsByKode($kode);
        $css = '<style type="text/css">.tbl-spec{table-layout:fixed!important;width:100%!important;word-wrap:break-word!important;}.tbl-logo{text-align:center!important;vertical-align:middle!important}.b-t{border-top:1px solid #000!important}.b-b{border-bottom:1px solid #000!important}.b-l{border-left:1px solid #000!important}.b-r{border-right:1px solid #000!important}.b-all{border:1px solid #000!important}.bg-b{background:#000!important;color:#FFF!important;font-weight:bold!important;text-align:center!important}.text-center{text-align:center!important}.footer-doc{position:fixed;bottom:0px;font-size:12px;color:#111;text-align:left}table td {page-break-before: always;}</style>';
        $footerDoc = '<div class="footer-doc">Dokumen ini dibuat melalui Aplikasi Operation.</div>';
        $data = htmlspecialchars_decode($docPS['keterangan'], ENT_QUOTES);
        $dompdf->load_html($css . $data . $footerDoc);
        $dompdf->set_paper('A4', 'portait');
        $here = $dompdf->render();
        $output = $dompdf->output();
        // file_put_contents('assets/file/memo/' . $kode . time() . '.pdf',  $dompdf->stream('Document Project Spec ' . $id . '.pdf', array("Attachment" => true)));
        // var_dump($dompdf->render());
        var_dump($docPS);
        die;

        redirect('projectplan/spec/' . $kode);
    }

    public function printPdfSpec($status, $id)
    {
        $dompdf = new Pdf();
        $dompdf->set_option('isRemoteEnabled', TRUE);
        $docPS = $this->Projectplan_model->getPsByKode($id);
        $css = '<style type="text/css">.tbl-spec{table-layout:fixed!important;width:100%!important;word-wrap:break-word!important;}.tbl-logo{text-align:center!important;vertical-align:middle!important}.b-t{border-top:1px solid #000!important}.b-b{border-bottom:1px solid #000!important}.b-l{border-left:1px solid #000!important}.b-r{border-right:1px solid #000!important}.b-all{border:1px solid #000!important}.bg-b{background:#000!important;color:#FFF!important;font-weight:bold!important;text-align:center!important}.text-center{text-align:center!important}.footer-doc{position:fixed;bottom:0px;font-size:12px;color:#111;text-align:left}table td {page-break-before: always;}</style>';
        $footerDoc = '<div class="footer-doc">Dokumen ini dibuat melalui Aplikasi Operation.</div>';
        $data = htmlspecialchars_decode($docPS['keterangan'], ENT_QUOTES);
        $dompdf->load_html($css . $data . $footerDoc);
        $dompdf->set_paper('A4', 'portait');
        $dompdf->render();
        $pdf = $dompdf->output();
        // var_dump($status);
        // die;
        if ($status == "view") $dompdf->stream('Document Project Spec ' . $id . '.pdf', array("Attachment" => false));
        else if ($status == 'revisi') {

            $data = $this->Projectplan_model->revisionSpec($id);
            // file_put_contents('assets/file/project_spec/' . $id . time() . '.pdf',  $pdf);
            var_dump(file_put_contents('assets/file/memo/' . $id . time() . '.pdf',  $pdf));
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Pengajuan Revisi <strong>berhasil!</strong>.
            </div>');
            redirect('projectplan/spec/' . $id);
            // die;
        } else $dompdf->stream('Document Project Spec ' . $id . '.pdf', array("Attachment" => true));
    }
}
