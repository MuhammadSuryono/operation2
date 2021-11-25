<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equestisi extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Aktual_model');
        $this->load->model('Equestisi_model');
        $this->load->model('Equestbaru_model');
        $this->load->library('form_validation');
    }

    public function index($kunjungan, $project){
        $data['judul'] = 'Form Isi Equest';
        // $data['skenario'] = $this->Equestisi_model->getSkenarioByUser();
        // $data['skenario'] = $this->Equestisi_model->getSkenarioByUserKB();
        // var_dump($data['skenario']); die;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestisi/index', $data);
        $this->load->view('templates/footer'); 
    }

    public function isi($kunjungan, $project, $cabang){
        // MRI OPERATION8
        // $dataex = explode("-" , $this->input->post('project'));
        // $id_skenario = $dataex[1];
        // $data['skenario'] = $this->db->get_where('data_skenario',['id_skenario' => $id_skenario])->row_array();
        // $soal = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id_skenario])->row_array();

        // var_dump($this->input->post('project'));
        // echo "<br>";
        // $data = explode("-" , $this->input->post('project'));
        // var_dump($data[0]);
        // echo "<br>";
        // var_dump($data[1]);
        // die;

        // var_dump($soal); die;

        // $data['id_pembuat_soal'] = $soal['id_pembuat_equest'];
        // $data['id_project'] = $dataex[0];
        // $data['id_skenario'] = $id_skenario;
        // $data['id_aktual'] = $dataex[2];
        // $data['kode_cabang'] = $dataex[3];
        // $data['id_kunjungan'] = $this->db->get_where('data_aktual', ['id_aktual' => $dataex[2]])->row_array();
        // $data['soal_equest'] = $this->Equestbaru_model->soalEquest($id_skenario);
        // AKHIR
        $data['judul'] = 'Soal Equest';

        // KERJA BAKTI
        $data['skenario'] = $this->db->query("SELECT a.*, b.nama_project, c.nama as skenarioxx from attribute c join ( data_pembuat_equest a join data_project b on a.kode_project=b.kode_project) on a.kategori=c.kode where a.kategori='$kunjungan' and a.kode_project = '$project'")->row_array();

        $data['id_pembuat_soal'] = $data['skenario']['id_pembuat_equest'];
        $data['id_project'] = $project;
        $data['kode_cabang'] = $cabang;
        $data['id_kunjungan'] = $kunjungan;
        $data['soal_equest'] = $this->Equestbaru_model->soalEquestKB($data['id_pembuat_soal']);
        // AKHIR

        // $cek = $this->db->get_where('data_jawaban_equest', ['id_project'=>$project, 'id_pembuat_equest'=>$data['id_pembuat_soal'], 'id_kunjungan'=>$kunjungan, 'kode_cabang'=>$cabang, 'id_user'=>]);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestisi/lihatKB', $data);
        $this->load->view('templates/footer'); 
    }

    public function simpanisi(){
        // $this->Equestisi_model->simpanjawaban();
        $this->Equestisi_model->simpanjawabanKB();
        // $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
        //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        //         Data Jawaban Equest Anda sudah berhasil <strong>disimpan!</strong>.
        //         </div>');
        // redirect('equestisi');
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Jawaban Equest Anda sudah berhasil <strong>disimpan!</strong>.
                </div>');
        redirect('aktual');
    }

    public function cek(){
        $data['judul'] = 'Cek Jawaban Equest';
        // $data['jawaban'] = $this->Equestisi_model->jawaban();
        $data['jawaban'] = $this->Equestisi_model->jawabanKB();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestisi/cekKB', $data);
        $this->load->view('templates/footer'); 
    }

    public function ubah($id){
        $data['judul'] = 'Ubah Jawaban Equest';
        $data['jawaban'] = $this->Equestisi_model->jawaban();
        $data['soal_equest'] = $this->Equestisi_model->ambilSoal($id);
        $data['jawaban_equest'] = $this->Equestisi_model->ambilJawaban($id);
        $data['id_jawaban'] = $id;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestisi/ubah', $data);
        $this->load->view('templates/footer'); 
    }

    public function updateisi(){
        $this->Equestisi_model->updateIsi();

        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Jawaban Equest telah <strong>diubah!</strong>.
                </div>');

        redirect('equestisi/cek');
    }

    public function lihatKonsistensi($id){
        $data['judul'] = 'Ubah Jawaban Equest';
        //SHP
        $data['jawaban'] = $this->Equestisi_model->jawaban();
        $data['soal_equest'] = $this->Equestisi_model->ambilSoal($id);
        $data['jawaban_equest'] = $this->Equestisi_model->ambilJawaban($id);
        $data['skenario'] = $this->Equestisi_model->getDataSkenarioById($id);
        //AKHIR SHP

        //DP
        // $data['soal'] = $this->Equestisi_model->getSoal($data['skenario']['id_skenario']);
        // $data['jawaban'] = $this->Equestisi_model->getJawaban($data['skenario']['id_skenario']);
        // DP

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('equestisi/lihatkonsistensi', $data);
        $this->load->view('templates/footer'); 
    }

    public function hapus($id){
        $this->Equestisi_model->hapus($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Jawaban Equest telah <strong>dihapus!</strong>.
                </div>');

        redirect('equestisi/cek');
    }

    public function jump(){
        $array = [];
        $id = $_POST['ketsoal'];
        $b = $_POST['pembuat'];
        $ids = $_POST['soal'];
        $jmlsoal = $this->db->query("SELECT kode_soal from data_soal_equest where id_pembuat_equest = $b order by kode_soal ASC")->result_array();

        foreach($jmlsoal as $jb => $dr){
            Array_push($array, $dr['kode_soal']);
        }

        $r = array_search($id, $array) + 1;

        $pg = $this->db->query("SELECT ket_soal from data_pg_equest where id_soal_equest = $ids order by ket_soal ASC")->result_array();

        $data = [$r];
        foreach($pg as $y => $u){
            if($u['ket_soal']!=""){
                Array_push($data, $u['ket_soal']);
            }
        }
		echo json_encode($data);
    }

    public function jumpnull(){
        $array = [];
        $array1 = [];
        $id = $_POST['ketsoal'];
        $b = $_POST['pembuat'];
        $ids = $_POST['soal'];

         $jmlsoal = $this->db->query("SELECT ket_soal from data_pg_equest where id_soal_equest = $ids order by id_pg_equest ASC")->result_array();

        foreach($jmlsoal as $jb => $dr){
            if($dr['ket_soal']!=""){
                Array_push($array, $dr['ket_soal']);
            }
        }

        $tampil = count($array);
        $kodes = $this->db->get_where('data_soal_equest', ['id_soal_equest' => $ids])->row_array();
        $code = $kodes['kode_soal'];
        if($tampil != 0){
            $arrayt = $array[$tampil-1];
            $query = "SELECT * FROM `data_soal_equest` WHERE kode_soal BETWEEN '$code' AND '$arrayt' and kode_soal != '$code'";

            for($i = 0; $i<$tampil; $i++){
                $query .= " AND kode_soal != '$array[$i]'";
            }

            $coba = $this->db->query($query)->row_array();
        } else {

            $coba = $this->db->query("SELECT * from data_soal_equest where kode_soal = (select min(kode_soal) from data_soal_equest where kode_soal > '$code') and id_pembuat_equest = '$b' ")->row_array();

        }

         $jmlsoal1 = $this->db->query("SELECT kode_soal from data_soal_equest where id_pembuat_equest = $b order by kode_soal ASC")->result_array();

        foreach($jmlsoal1 as $jb => $dr){
            Array_push($array1, $dr['kode_soal']);
        }
        $r = array_search($coba['kode_soal'], $array1) + 1;

        if($coba['kode_soal'] == ""){
            $jml = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $b])->num_rows();
            $r = $jml + 1;
        }

        $data = [$r];
        for($i = 0; $i<$tampil; $i++){
            Array_push($data, $array[$i]);
        }

		echo json_encode($data);
    }
}