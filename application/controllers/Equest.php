<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equest extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('id_user')){
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Silahkan Login </strong>.
              </div>');
            redirect('block');
        }

        $this->load->model('skenario_model');
        $this->load->model('Equest_model');
        $this->load->library('form_validation');
    }

    private function __user(){
        $id_user = $this->session->userdata('id_user');
        $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();

        return $user;
    }

    public function index(){
        $user = $this->__user();
        if($user['id_divisi'] == 1 or $user['id_akses'] == 2 or $user['id_divisi'] == 99){
        $id_user = $this->session->userdata('id_user');
        $data['judul'] = 'E-quest MRI';
        $data['data_kuis'] = $this->Equest_model->getAllData($id_user);
        $data['jenis_skenario'] = $this->Equest_model->getprojectskenario();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equest/index', $data);
        $this->load->view('templates/footer');
        } else {
            redirect('block');
        }

    }

    public function tambah1(){
        $jumlahsoal = $this->input->post('idsoal');
        $query = "";

        if(!$jumlahsoal){
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Soal Kuis <strong>tidak ada!</strong>.
                </div>');
            redirect('equest/tambah');
        } else{
            $this->Equest_model->tambah($jumlahsoal);
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Soal Kuis berhasil<strong> ditambahkan!</strong>.
                </div>');
            redirect('equest/tambah');
        }
    }

    public function tambah(){
        $user = $this->__user();
        if($user['id_divisi'] == 1 or $user['id_divisi'] == 99){
            $data['judul'] = 'Tambah E-quest MRI';
            $data['jenis_skenario'] = $this->Equest_model->getprojectskenario();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('equest/index', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('block');
        }

    }

    public function ubah($id){


        $user = $this->__user();
        if($user['id_divisi'] == 1 or $user['id_divisi'] == 99){
            $data['data_kuis'] = $this->Equest_model->getKuisById($id);
            $data['judul'] = 'Ubah Soal Kuis';
            $this->form_validation->set_rules('soal', 'Soal', 'required');
            $this->form_validation->set_rules('jb', 'Jawaban Benar', 'required');
            $this->form_validation->set_rules('js1', 'Jawaban Salah 1', 'required');
            $this->form_validation->set_rules('js2', 'Jawaban Salah 2', 'required');
            $this->form_validation->set_rules('js3', 'Jawaban Salah 3', 'required');

            if($this->form_validation->run()==false){
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar');
                $this->load->view('equest/ubah', $data);
                $this->load->view('templates/footer');
            } else {
                $this->Equest_model->ubah();
                $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Data Soal Kuis berhasil<strong> diubah!</strong>.
                    </div>');
                    $id = $this->input->post('id');
                redirect("equest/ubah/$id");
            }
        } else {
            redirect('block ');
        }
    }

    public function hapus($id){
        $user = $this->__user();
        if($user['id_divisi'] == 1 or $user['id_divisi'] == 99){
            $this->Equest_model->hapus($id);

            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Data Soal Kuis telah <strong>dihapus!</strong>.
                  </div>');

            redirect('equest');
        } else {
            redirect('block');
        }
    }

    public function shp(){
        $user = $this->__user();
        if($user['id_divisi'] == 6 OR $user['id_divisi'] == 3 OR $user['id_divisi'] == 8) { //ADA YG ANEH SAMA BARIS INI // sekarang dibuka buat PIC bukan SHP
        // if($user['id_divisi'] == 0) { //ADA YG ANEH SAMA BARIS INI // sekarang dibuka buat PIC bukan SHP
            $data['project'] = $this->Equest_model->getproject();
            //$this->db->get('data_skenario')->result_array();
            // $data['jenis_skenario'] = $this->Equest_model->getSkenarioByAktual();//$this->db->get('data_skenario')->result_array();
            $data['judul'] = 'Soal Kuis Skenario';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('equest/indexshp', $data);
            $this->load->view('templates/footer');
         } else {
            redirect('block');
        }
    }

    public function getprojectsubskenario()
	{
        $pro = $_POST['pro'];
        $id_user = $this->session->userdata('id_user');
        $data= $this->Equest_model->getprojectsubskenario($id_user, $pro);

        echo json_encode($data);
    }

    public function getprojectshpkunjungan()
	{
        $pro = $_POST['pro'];
        $id_user = $this->session->userdata('id_user');
        $data= $this->Equest_model->getprojectshpkunjungan($id_user, $pro);

        echo json_encode($data);
    }

    public function skenario()
	{
        $pro = $_POST['proj'];
		$id = $_POST['jenis'];
        $data =  $this->db->get_where('data_skenario', ['nama_skenario' => $id, 'kode_project' => $pro])->result_array();

		echo json_encode($data);
    }

    public function kuis(){
        $user = $this->__user();
        if($user['id_akses'] == 2) {
            $data['judul'] = 'Kuis Skenario';
            $data['data_kuis'] = $this->Equest_model->kuis();
            $data['jumlah'] = $this->Equest_model->jumlah();
            $coba = $this->Equest_model->getNamaSkenario();
            $this->session->set_flashdata('skenario', $coba['nama_skenario']);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('equest/kuis', $data);
            $this->load->view('templates/footer');

         } else {
            redirect('block');
        }
    }

    public function kuisjs($kun, $pro){
        $user = $this->__user();
        if($user['id_divisi'] == 6) {
            $data['judul'] = 'Kuis Skenario';
            $data['data_kuis'] = $this->Equest_model->kuisjs($kun, $pro);
            $data['jumlah'] = $this->Equest_model->jumlahjs($kun, $pro);
            $coba = $this->Equest_model->getNamaSkenario();
            $this->session->set_flashdata('skenario', $coba['nama_skenario']);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('equest/kuis', $data);
            $this->load->view('templates/footer');
         } else {
            redirect('block');
        }
    }

    public function kuis1(){

        $jawab = $this->Equest_model->cekjawaban();
        // var_dump($jawab);
        $data = explode("-" , $jawab);
        // var_dump($data[2]);
        // var_dump($data[1]);
        // var_dump($data[0]);
        // die;
        $data['jawab'] = ($data[0]/$data[1])*100;
        $data['benar'] = $data[0];
        $data['salah'] = $data[1]-$data[0];
        $id = $data[2];
        $pro = $data[3];

        // $this->Equest_model->saveJawabanKB($id, $data['jawab'], $data['benar'], $data['salah']);
        $this->Equest_model->saveJawabanKB($pro, $id, $data['jawab'], $data['benar'], $data['salah']);
        $data['judul'] = 'Nilai Kuis';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equest/nilai', $data);
        $this->load->view('templates/footer');
    }

    public function daftarnilai(){
        $user = $this->__user();
        if($user['id_divisi']==6 || $user['id_divisi']==3){
            $data['judul'] = 'Score Kuis';
            // $data['data_nilai'] = $this->Equest_model->getDataNilaiById($user['id_user']);
            $data['data_nilai'] = $this->Equest_model->getDataNilaiByIdKB($user['noid']);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('equest/daftarnilai', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('block');
        }
    }

    // IWAYRIWAY
    public function getprojectskenario(){
        $pro = $_POST['pro'];
        $id_user = $this->session->userdata('id_user');
        //db KERJABAKTI
        // $data = $this->db->query("SELECT
        //                             a.*,
        //                             b.nama
        //                         FROM
        //                             data_skenario_kunjungan a
        //                             JOIN attribute b ON a.kategori = b.kode
        //                         WHERE
        //                             a.kode_project = '$pro'
        //                             AND a.id_user = '$id_user'
        //                             AND NOT EXISTS ( SELECT c.id_kuis FROM data_kuis c WHERE c.kode_project = '$pro' AND c.kunjungan = a.kategori )
        //                         GROUP BY
        //                             a.kategori")->result_array();

        //DB JAY2
        $data = $this->db->query("SELECT
                                    a.project AS kode_project,
                                    b.nama AS nama_project,
                                    d.kode,
                                    d.nama
                                FROM
                                    skenario a
                                    JOIN project b ON a.project = b.kode
                                    JOIN attribute d ON d.kode = a.kategori
                                WHERE
                                    b.id_user = '$id_user'
                                    AND a.project = '$pro'
                                    AND NOT EXISTS (
                                    SELECT
                                        c.id_kuis
                                    FROM
                                        data_kuis c
                                    WHERE
                                        c.kode_project = '$pro'
                                        AND c.kunjungan = a.kategori
                                        AND b.id_user = '$id_user'
                                    )
                                GROUP BY
                                    a.kategori")->result_array();
        echo json_encode($data);
    }
    // IWAYRIWAY
}
