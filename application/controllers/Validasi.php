<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasi extends CI_Controller {

     public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('id_user')){
            $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Silahkan Login </strong>.
              </div>');
            redirect('block');

        } else {

            $akses = $this->session->userdata('id_divisi');

            if($akses == 4 or $akses == 1 or $akses == 99 or $akses == 10) {
            }else{
                redirect('block');
            }
        }

        $this->load->model('Validasi_model');
        $this->load->model('Rekaman_model');
        $this->load->model('Shp_model');
        $this->load->library('form_validation');
    }

    public function index(){

        $data['judul'] = 'Bukti Kunjungan';
        $data['data_kunjungan'] = [];

        if($this->uri->segment(3) !=0 ){
            $data['data_kunjungan'] = $this->Validasi_model->getDataKunjungan($this->uri->segment(3));
        }
        else {
            if($this->input->post('div')){
            $data['data_kunjungan'] = $this->Validasi_model->getDataKunjungan($this->input->post('div'));
            }
        }


        // $data['skenario'] = $this->db->get('data_skenario')->result_array();
        $data['skenario'] = $this->db->get('data_project')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function rekaman(){
        $data['judul'] = 'Daftar Rekaman SHP';
        $data['project'] = $this->Rekaman_model->getDataProject();
         $data['rekaman'] = [];

        if($this->input->post('project')){
            $data['rekaman'] = $this->Validasi_model->getDataRekamanById($this->input->post('project'));
        }

        if($this->uri->segment(3)){
            $data = $this->db->get_where('data_rekaman', ['id_rekaman' => $this->uri->segment(3)])->row_array();
            $data['rekaman'] = $this->Validasi_model->getDataRekamanById($data['id_project']);
            $data['judul'] = 'Daftar Rekaman SHP';
             $data['project'] = $this->Rekaman_model->getDataProject();
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/rekaman', $data);
        $this->load->view('templates/footer');
    }

    public function lihat($id){
        $data['data_kunjungan'] = $this->Shp_model->getDataKunjunganById($id);
        $data['judul'] = 'Bukti Kunjungan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/lihatkunjunganbaru', $data);
        $this->load->view('templates/footer');
    }

    public function tes(){
        var_dump( $this->uri->segment(3));
        die;
    }

    public function stsTransaksi($id){
        $this->Validasi_model->updateTransaksi($id);

        redirect("validasi/lihat/$id");
    }

    public function stsTransaksi1($id){
        $this->Validasi_model->updateTransaksi1($id);

        redirect("validasi/lihat/$id");
    }

    public function stsEquest($id){
        $this->Validasi_model->updateEquest($id);

        redirect("validasi/lihat/$id");
    }

    public function stsEquest1($id){
        $this->Validasi_model->updateEquest1($id);

        redirect("validasi/lihat/$id");
    }

    public function stsLayout($id){
        $this->Validasi_model->updateLayout($id);

        redirect("validasi/lihat/$id");
    }

    public function stsLayout1($id){
        $this->Validasi_model->updateLayout1($id);

        redirect("validasi/lihat/$id");
    }

    public function updateStsRekaman($id){
        $this->Validasi_model->updateStsRekaman($id);
        redirect("validasi/rekaman/$id");
    }

    public function valid(){
        $data['judul'] = 'Validasi Data';
        $data['skenario'] = $this->db->get('data_project')->result_array();
        $data['rekap'] = [];

        if($this->input->post('project')){
            $data['rekap'] = $this->Validasi_model->getAllData($this->input->post('project'));
        }

        if($this->uri->segment(3)){
            $data['rekap'] = $this->Validasi_model->getAllData($this->uri->segment(3));
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/valid', $data);
        $this->load->view('templates/footer');
    }

    public function cekvalid($rekaman, $dialog){
        $data['judul'] = "Validasi Rekaman - Dialog";
        $data['rekaman'] = $this->Validasi_model->getRekamanById($rekaman);
        $data['dialog'] = $this->Validasi_model->getDialogById($dialog);
        $this->db->order_by('pilihan_td', 'ASC');
        $data['time'] = $this->db->get_where('data_td', ['id_skenario' => $data['rekaman']['id_skenario']])->result_array();
        // var_dump($data['dialog']); die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/cekvalid', $data);
        $this->load->view('templates/footer');
    }

    public function stsValidDialog($dialog, $rekaman){
        $this->Validasi_model->stsValidDialog($dialog);
        redirect("validasi/cekvalid/$rekaman/$dialog");
    }

    public function stsInvalidDialog($dialog, $rekaman){
        $this->Validasi_model->stsInvalidDialog($dialog);
        redirect("validasi/cekvalid/$rekaman/$dialog");
    }

    public function stsValidRekaman($dialog, $rekaman){
        $this->Validasi_model->stsValidRekaman($rekaman);
        redirect("validasi/cekvalid/$rekaman/$dialog");
    }

    public function stsInvalidRekaman($dialog, $rekaman){
        $this->Validasi_model->stsInvalidRekaman($rekaman);
        redirect("validasi/cekvalid/$rekaman/$dialog");
    }

    public function validasidata(){
        $data['judul'] = "Validasi Data Kunjungan";
        $data['project'] = $this->db->get_where('project', ['visible' => 'y', 'type' => 'n' ] )->result_array();
        $data['data_kunjungan'] = [];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/validasidata', $data);
        $this->load->view('templates/footer');
    }

    public function getquestdata()
    {

        $pro = $_POST['pro'];
        $cbg = $_POST['cbg'];

        $data = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.nama AS nama_user,
                                    f.nama AS cabangx,
                                    date( a.waktuassign ) AS waktu_assign,
                                    date( g.waktu_upload ) AS waktu_upload,
                                    g.r_sts_dialog,
                                    g.upload_dialog,
                                    g.r_sts_upload_layout,
                                    g.upload_layout,
                                    g.r_sts_upload_ss,
                                    g.upload_ss,
                                    g.r_sts_upload_slip_transaksi,
                                    g.upload_slip_transaksi 
                                FROM
                                    summary_2 g
                                    RIGHT JOIN (
                                        cabang f
                                        JOIN (
                                            id_data e
                                            JOIN (
                                                attribute d
                                                JOIN ( attribute c JOIN ( quest a JOIN project b ON a.project = b.kode ) ON a.kunjungan = c.kode ) ON a.r_kategori = d.kode 
                                            ) ON a.shp = e.Id 
                                        ) ON a.cabang = f.kode 
                                        AND a.project = f.project 
                                    ) ON g.project_kode = a.project 
                                    AND g.sub_kunjungan_kode = a.kunjungan 
                                    AND g.cabang_kode = a.cabang 
                                WHERE
                                    a.project = '$pro'  
                                    AND a.cabang = '$cbg'  
                                ORDER BY
                                    a.tanggal ASC,
                                    f.kode ASC,
                                    a.r_kategori ASC")->result_array();

        echo json_encode($data);

    }

    public function getquestdata2()
    {

        $pro = $_POST['pro'];

        $data = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.nama AS nama_user,
                                    f.nama AS cabangx,
                                    date( a.waktuassign ) AS waktu_assign,
                                    date( g.waktu_upload ) AS waktu_upload,
                                    g.r_sts_dialog,
                                    g.upload_dialog,
                                    g.r_sts_upload_layout,
                                    g.upload_layout,
                                    g.r_sts_upload_ss,
                                    g.upload_ss,
                                    g.r_sts_upload_slip_transaksi,
                                    g.upload_slip_transaksi 
                                FROM
                                    summary_2 g
                                    RIGHT JOIN (
                                        cabang f
                                        JOIN (
                                            id_data e
                                            JOIN (
                                                attribute d
                                                JOIN ( attribute c JOIN ( quest a JOIN project b ON a.project = b.kode AND visible = 'y' ) ON a.kunjungan = c.kode ) ON a.r_kategori = d.kode 
                                            ) ON a.shp = e.Id 
                                        ) ON a.cabang = f.kode 
                                        AND a.project = f.project 
                                    ) ON g.project_kode = a.project 
                                    AND g.sub_kunjungan_kode = a.kunjungan 
                                    AND g.cabang_kode = a.cabang 
                                WHERE
                                    a.project = '$pro'   
                                ORDER BY
                                    a.tanggal ASC,
                                    f.kode ASC,
                                    a.r_kategori ASC")->result_array();

        echo json_encode($data);

    }

    public function validasidataNew(){
        $data['judul'] = "Validasi Data Kunjungan";
        $data['project'] = $this->db->get_where('project', ['visible' => 'y', 'type' => 'n' ] )->result_array();
        $data['data_kunjungan'] = [];

        // if($this->input->post('ssproject')){
        //      $data['data_kunjungan'] = $this->Validasi_model->getAllDataQuestNew();
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('validasi/validasidataNew2', $data);
        $this->load->view('validasi/validasidata', $data);
        $this->load->view('templates/footer');
    }

    public function validasidata_Ebanking(){
        $data['judul'] = "Validasi Data Ebanking";
        $data['project'] = $this->Validasi_model->getproject_ebanking();
        $data['bank'] = $this->Validasi_model->getbank();
        // $data['data_kunjungan'] = [];

        // if($this->input->post('ssproject')){
        //      $data['data_kunjungan'] = $this->Validasi_model->getAllDataQuestNew();
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('validasi/validasidataNew2', $data);
        $this->load->view('validasi/validasiebanking', $data);
        $this->load->view('templates/footer');
    }

     public function getval_ebanking()
  {
    $id = $_POST['pro'];
    $bank = $_POST['bank'];
    $channel = $_POST['chan'];
    $transaksi = $_POST['transaksi'];
    $data = $this->Validasi_model->getval_ebanking($id, $bank, $channel, $transaksi);
    echo json_encode($data);
  }

  public function validasidata_sosmed(){
        $data['judul'] = "Validasi Data Evaluasi Sosial Media";
        $data['project'] = $this->Validasi_model->getproject_ebanking();
        $data['bank'] = $this->Validasi_model->getbank();
        // $data['data_kunjungan'] = [];

        // if($this->input->post('ssproject')){
        //      $data['data_kunjungan'] = $this->Validasi_model->getAllDataQuestNew();
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('validasi/validasidataNew2', $data);
        $this->load->view('validasi/validasisosmed', $data);
        $this->load->view('templates/footer');
    }

   public function getval_sosmed()
  {
    $id = $_POST['pro'];
    $bank = $_POST['bank'];
    $platform = $_POST['plat'];
    $skenario = $_POST['skenario'];
    $data = $this->Validasi_model->getval_sosmed($id, $bank, $platform, $skenario);
    echo json_encode($data);
  }

    public function dataRA(){
        $data['judul'] = "Validasi Data Kunjungan";
        // $data['project'] = $this->db->get('data_project')->result_array();
        $data['project'] = $this->db->get_where('project', ['visible' => 'y', 'type' => 'n' ] )->result_array();
        $data['data_kunjungan'] = [];

        // if($this->input->post('ssproject')){
        //      $data['data_kunjungan'] = $this->Validasi_model->getAllDataQuestNew();
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        // $this->load->view('validasi/data_ra', $data);
        $this->load->view('validasi/data_ra2', $data);
        $this->load->view('templates/footer');
    }

    public function getkunjungan(){
        $kode = $_POST['id'];
        // $data = $this->db->query("SELECT a.*, b.nama as kunjunganx from data_skenario_kunjungan a join attribute b on a.kategori = b.kode where a.kode_project = '$kode' group by a.kategori")->result_array();
        $data = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS kunjunganx
                                FROM
                                    skenario a
                                    JOIN attribute b ON a.kategori = b.kode
                                WHERE
                                    a.project = '$kode'
                                GROUP BY
                                    a.kategori")->result_array();
		echo json_encode($data);
    }

    public function getskenario(){
        $kunjungan = $_POST['id'];
        $pro = $_POST['pro'];
        $data = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS skenariox
                                FROM
                                    skenario a
                                    JOIN attribute b ON a.att = b.kode
                                WHERE
                                    a.project = '$pro'
                                    AND a.kategori = '$kunjungan'")->result_array();
		echo json_encode($data);
    }

    public function gethapusdataTD(){
        $pro = $_POST['id'];
        
        if ($pro=='AND1') {

            $data=[
                array('id_skenario' => '001', 'skenariox' => 'Q1'),
                array('id_skenario' => '002', 'skenariox' => 'Q2'),
            ];

            echo json_encode($data);

        }else {
            $data = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS skenariox
                                FROM
                                    data_td a
                                    JOIN attribute b ON a.id_skenario = b.kode
                                WHERE
                                    a.id_project = '$pro'
                                GROUP BY
                                    a.id_skenario")->result_array();
		    echo json_encode($data);
        }
    }

    public function lihatvalidasi($id){
        $data['judul'] = "Validasi Data Kunjungan";
        $data['db'] = $this->Validasi_model->getAllDataSummary($id);
        $data['rekaman'] = $this->Validasi_model->getAllDataRekaman($id);
        $data['sts_quest'] = $this->Validasi_model->getAllDataQuestById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/lihatvalidasi', $data);
        $this->load->view('templates/footer');
    }

    public function lihatvalidasi_ebanking($id){
        $data['judul'] = "Validasi Data Ebanking";
        $data['db'] = $this->Validasi_model->lihatvalidasi_ebanking($id);
        $data['td'] = $this->Validasi_model->getdetail_td($id);
        // $data['rekaman'] = $this->Validasi_model->getAllDataRekaman($id);
        // $data['sts_quest'] = $this->Validasi_model->getAllDataQuestById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/lihatvalidasi_ebanking', $data);
        $this->load->view('templates/footer');
    }

    public function lihatvalidasi_sosmed($id){
        $data['judul'] = "Validasi Data Evaluasi Sosmed";
        $data['db'] = $this->Validasi_model->lihatvalidasi_sosmed($id);
        // $data['td'] = $this->Validasi_model->getdetail_td($id);
        // $data['rekaman'] = $this->Validasi_model->getAllDataRekaman($id);
        // $data['sts_quest'] = $this->Validasi_model->getAllDataQuestById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/lihatvalidasi_sosmed', $data);
        $this->load->view('templates/footer');
    }

    public function lihatvalidasi2($id){
        $data['judul'] = "Validasi Data Kunjungan";
        $data['db'] = $this->Validasi_model->getAllDataSummary($id);
        $data['rekaman'] = $this->Validasi_model->getAllDataRekaman($id);
        $data['sts_quest'] = $this->Validasi_model->getAllDataQuestById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/lihatvalidasi2', $data);
        $this->load->view('templates/footer');
    }

    public function lihatdata($id){
        $data['judul'] = "Validasi Data Kunjungan";
        $data['db'] = $this->Validasi_model->getAllDataSummary($id);
        $data['rekaman'] = $this->Validasi_model->getAllDataRekaman($id);
        $data['sts_quest'] = $this->Validasi_model->getAllDataQuestById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/lihatdata', $data);
        $this->load->view('templates/footer');
    }

    public function inputrekaman(){
        $data['judul'] = "Input Rekaman";
        $data['judul'] = "Validasi Data Kunjungan";
        $data['project'] = $this->db->get_where('project', ['visible' => 'y', 'type' => 'n' ] )->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/inputrekaman', $data);
        $this->load->view('templates/footer');
    }

    public function validasi_eb(){
        $datenow = date('Y-m-d');
        $num = $_POST['id'];

        $bank = $_POST['bank'];
        $tanggal = $_POST['tanggal'];
        $hari = $_POST['hari'];
        $transaksi = $_POST['transaksi'];
        $jam = $_POST['jam'];
        $tujuan = $_POST['tujuan'];

        $form = [
                'num_eb' => $num,
                'bank' => $bank,
                'tanggal' => $tanggal,
                'hari' => $hari,
                'transaksi' => $transaksi,
                'jam' => $jam,
                'tujuan' => $tujuan
                ];
        
        $data = [
            'status' => 3,
            'validator_id' => $this->session->userdata('id_user'),
            'tgl_validasi' => $datenow,
        ];
        $this->db->where('num', $num);
        $this->db->update('ebanking', $data);


        $cek = $this->db->get_where('form_validasi', array('num_eb' => $num))->row_array();
        if ($cek == NULL) {
                $this->db->insert('form_validasi', $form);
         } else {
                $this->db->update('form_validasi', $form, ['num_eb'=> $num]);
         }



        echo json_encode($data);
        }

                public function tolak_eb(){
            $num = $this->input->post('id');
            $keterangan = $this->input->post('keterangan');

            $datenow = date('Y-m-d');


            $bank = $this->input->post('bank');
            $tanggal = $this->input->post('tanggal');
            $hari = $this->input->post('hari');
            $transaksi = $this->input->post('transaksi');
            $jam = $this->input->post('jam');
            $tujuan = $this->input->post('tujuan');

            $form = [
                    'num_eb' => $num,
                    'bank' => $bank,
                    'tanggal' => $tanggal,
                    'hari' => $hari,
                    'transaksi' => $transaksi,
                    'jam' => $jam,
                    'tujuan' => $tujuan
                    ];
            
            $data = [
            'status' => 1,
            'r_temuan' => $keterangan,
            'validator_id' => $this->session->userdata('id_user'),
            'tgl_validasi' => $datenow,
        ];

        $this->db->update('ebanking', $data, ['num'=> $num]);

        $cek = $this->db->get_where('form_validasi', array('num_eb' => $num))->row_array();
        if ($cek == 0) {
                $this->db->insert('form_validasi', $form);
         } else {
                $this->db->update('form_validasi', $form, ['num_eb'=> $num]);
         }

        $this->session->set_flashdata('info1', 'Data Di Tolak');

        redirect("validasi/lihatvalidasi_ebanking/$num");
               
        }

        public function validasi_sosmed(){
        $datenow = date('Y-m-d');
        $num = $_POST['id'];

            $platform= $_POST['platform'];
            $tujuan = $_POST['tujuan'];
            $skenario = $_POST['skenario'];
            $tanggal = $_POST['tanggal'];
            $hari = $_POST['hari'];
            $jam = $_POST['jam'];
            $greetawal = $_POST['greetawal'];
            $greetakhir = $_POST['greetakhir'];
            $greetakhir_after = $_POST['greetakhir_after'];

            $responagent = $_POST['responagent'];
            $waktukirim = $_POST['waktukirim'];
            $waktubalas = $_POST['waktubalas'];
            $responotomatis = $_POST['responotomatis'];

        $form = [
                'num_sos' => $num,
                'platform' => $platform,
                'tujuan' => $tujuan,
                'skenario' => $skenario,                
                'tanggal' => $tanggal,
                'hari' => $hari,
                'jam' => $jam,
                'greetawal' => $greetawal,
                'greetakhir' => $greetakhir,
                'greetakhir_after' => $greetakhir_after,

                'responagent' => $responagent,
                'waktukirim' => $waktukirim,
                'waktubalas' => $waktubalas,
                'responotomatis' => $responotomatis
                ];
        
        $data = [
            'status' => 3,
            'validator_id' => $this->session->userdata('id_user'),
            'tgl_validasi' => $datenow,
        ];
        $this->db->where('num', $num);
        $this->db->update('sosmed', $data);


        $cek = $this->db->get_where('sosmed_form_validasi', array('num_sos' => $num))->row_array();
        if ($cek == NULL) {
                $this->db->insert('sosmed_form_validasi', $form);
         } else {
                $this->db->update('sosmed_form_validasi', $form, ['num_sos'=> $num]);
         }



        echo json_encode($data);
        }

         public function tolak_sosmed(){
            $num = $this->input->post('id');
            $keterangan = $this->input->post('keterangan');

            $datenow = date('Y-m-d');


            $platform= $this->input->post('platform');
            $tujuan = $this->input->post('tujuan');
            $skenario = $this->input->post('skenario');
            $tanggal = $this->input->post('tanggal');
            $hari = $this->input->post('hari');
            $jam = $this->input->post('jam');
            $greetawal = $this->input->post('greetawal');
            $greetakhir = $this->input->post('greetakhir');
            $greetakhir_after = $this->input->post('greetakhir_after');

            $responagent = $this->input->post('responagent');
            $waktukirim = $this->input->post('waktukirim');
            $waktubalas = $this->input->post('waktubalas');
            $responotomatis = $this->input->post('responotomatis');

        $form = [
                'num_sos' => $num,
                'platform' => $platform,
                'tujuan' => $tujuan,
                'skenario' => $skenario,                
                'tanggal' => $tanggal,
                'hari' => $hari,
                'jam' => $jam,
                'greetawal' => $greetawal,
                'greetakhir' => $greetakhir,
                'greetakhir_after' => $greetakhir_after,

                'responagent' => $responagent,
                'waktukirim' => $waktukirim,
                'waktubalas' => $waktubalas,
                'responotomatis' => $responotomatis
                ];
        
            
            $data = [
            'status' => 1,
            'r_temuan' => $keterangan,
            'validator_id' => $this->session->userdata('id_user'),
            'tgl_validasi' => $datenow,
        ];

        $this->db->update('sosmed', $data, ['num'=> $num]);

        $cek = $this->db->get_where('sosmed_form_validasi', array('num_sos' => $num))->row_array();
        if ($cek == NULL) {
                $this->db->insert('sosmed_form_validasi', $form);
         } else {
                $this->db->update('sosmed_form_validasi', $form, ['num_sos'=> $num]);
         }

        $this->session->set_flashdata('info1', 'Data Di Tolak');

        redirect("validasi/lihatvalidasi_sosmed/$num");
               
        }



        public function reset_eb()
        {
            $num = $this->input->post('id');
            $keterangan = $this->input->post('keterangan');

            $data = [
            'status' => 2,
            'r_temuan' => NULL,
            'validator_id' => NULL,
            'tgl_validasi' => NULL,
            'ket_reset' => $keterangan
            ];

            $this->db->update('ebanking', $data, ['num'=> $num]);
            $this->db->delete('form_validasi', array('num_eb' => $num)); 

        $this->session->set_flashdata('flash', 'Berhasil Reset');

        redirect("validasi/lihatvalidasi_ebanking/$num");


        }

        public function reset_sosmed()
        {
            $num = $this->input->post('id');
            $keterangan = $this->input->post('keterangan');

            $data = [
            'status' => 2,
            'r_temuan' => NULL,
            'validator_id' => NULL,
            'tgl_validasi' => NULL,
            'ket_reset' => $keterangan
            ];

            $this->db->update('sosmed', $data, ['num'=> $num]);
            $this->db->delete('sosmed_form_validasi', array('num_sos' => $num)); 

        $this->session->set_flashdata('flash', 'Berhasil Reset');

        redirect("validasi/lihatvalidasi_sosmed/$num");


        }

    public function getcabangrekaman(){
        $pro = $_POST['pro'];
        $sken = $_POST['sken'];
        $data = $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    b.kode,
                                    b.nama
                                FROM
                                    project a
                                    JOIN cabang b ON a.kode = b.project
                                    JOIN quest d ON d.project = '$pro' AND d.kunjungan = '$sken' AND b.kode = d.cabang
                                WHERE
                                    a.kode = '$pro'
                                    AND NOT EXISTS (
                                    SELECT
                                        c.file_rekaman
                                    FROM
                                        data_rekaman c
                                    WHERE
                                        c.id_project = '$pro'
                                        AND c.id_skenario = '$sken'
                                        AND c.kode_cabang = b.kode
                                    )
                                ORDER BY
                                    b.kode ASC")->result_array();

        echo json_encode($data);
    }

    public function inputdatarekaman(){

        $img1 = $_FILES['rekaman']['name'];

        if ($img1){
            $this->Validasi_model->inputrekamanmanual();
            $this->session->set_flashdata('flash', 'rekaman berhasil disimpan !');
            redirect('validasi/inputrekaman');

        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Gagal! File Rekaman belum<strong> dilampirkan!</strong>.
                </div>');
            redirect('validasi/inputrekaman');
        }
    }

    public function validasidialog(){

        $num = $_POST['id'];
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_dialog' => 1,
            'upload_ulang_dialog' => 'N',
        ];

        $this->db->where('num', $num);
        $this->db->update('summary_2', $data);

        $cek = $this->db->query("SELECT
                                a.*,
                                c.num AS numq
                            FROM
                                summary_2 a
                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                            WHERE
                                a.num = '$num'
                                AND a.r_sts_dialog = 1
                                AND a.r_sts_upload_layout = 1
                                AND a.r_sts_upload_ss = 1
                                AND a.r_sts_upload_slip_transaksi = 1
                                AND c.rekaman_status = 3")->row_array();

    if($cek != null){
        date_default_timezone_set('Asia/Jakarta');

        $numq = $cek['numq'];
        $this->db->query("UPDATE quest
                        SET `status` = '3'
                        WHERE
                            num = '$numq'");

            $update = [
                'validator_time' => date('Y-m-d H:i:s'),
            ];

            $this->db->update('summary_2', $update, ['num' => $num]);
    }

        echo json_encode($data);

        }

        public function tolakdialog(){
            $num = $_POST['id'];
            $data = [
            'r_sts_dialog' => 0,
        ];
        $this->db->where('num', $num);
        $this->db->update('summary_2', $data);

        $cek = $this->db->query("SELECT
                                a.*,
                                c.num AS numq
                            FROM
                                summary_2 a
                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                            WHERE
                                a.num = '$num'")->row_array();

            $numq = $cek['numq'];
            $this->db->query("UPDATE quest
                            SET `status` = '1'
                            WHERE
                                num = '$numq'");

        echo json_encode($data);
    }

    public function validasirekaman(){
        $num = $_POST['id'];
        $data = [
            'rekaman_status' => 3,
            'upload_ulang_rekaman' => 'N',
            'validator_id' => $this->session->userdata('id_user'),
        ];
        $this->db->where('num', $num);
        $this->db->update('quest', $data);

        $cek = $this->db->query("SELECT
                                    a.*,
                                    a.num AS numq
                                FROM
                                    summary_2 a
                                    JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                                WHERE
                                    c.num = '$num'
                                    AND a.r_sts_dialog = 1
                                    AND a.r_sts_upload_layout = 1
                                    AND a.r_sts_upload_ss = 1
                                    AND a.r_sts_upload_slip_transaksi = 1
                                    AND c.rekaman_status = 3")->row_array();

        if($cek != null){
            date_default_timezone_set('Asia/Jakarta');

            $this->db->query("UPDATE quest
                            SET `status` = '3', rekaman = 'true'
                            WHERE
                                num = '$num'");

                $update = [
                    'validator_time' => date('Y-m-d H:i:s'),
                ];

                $this->db->update('summary_2', $update, ['num' => $cek['num']]);
            }

        echo json_encode($data);
        }

public function tolakrekaman(){
    $num = $_POST['id'];
        $data = [
            'rekaman_status' => 2,
            'rekaman' => 'false',
        ];
        $this->db->where('num', $num);
        $this->db->update('quest', $data);

        echo json_encode($data);
    }

    public function validasilayout(){
        $num = $_POST['id'];
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_upload_layout' => 1,
            'upload_ulang_layout' => 'N',
        ];
        $this->db->where('num', $num);
        $this->db->update('summary_2', $data);

        $cek = $this->db->query("SELECT
                                    a.*,
                                    c.num AS numq
                                FROM
                                    summary_2 a
                                    JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                                WHERE
                                    a.num = '$num'
                                    AND a.r_sts_dialog = 1
                                    AND a.r_sts_upload_layout = 1
                                    AND a.r_sts_upload_ss = 1
                                    AND a.r_sts_upload_slip_transaksi = 1
                                    AND c.rekaman_status = 3")->row_array();

        if($cek != null){
            date_default_timezone_set('Asia/Jakarta');
            
            $numq = $cek['numq'];
            $this->db->query("UPDATE quest
                            SET `status` = '3'
                            WHERE
                                num = '$numq'");

                $update = [
                    'validator_time' => date('Y-m-d H:i:s'),
                ];

                $this->db->update('summary_2', $update, ['num' => $num]);
            }
        echo json_encode($data);
    }

    public function tolaklayout(){
        $num = $_POST['id'];
        $data = [
            'r_sts_upload_layout' => 0,
        ];
        $this->db->where('num', $num);
        $this->db->update('summary_2', $data);


        $cek = $this->db->query("SELECT
                                a.*,
                                c.num AS numq
                            FROM
                                summary_2 a
                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                            WHERE
                                a.num = '$num'")->row_array();

        if($cek != null){
            $numq = $cek['numq'];
            $this->db->query("UPDATE quest
                            SET `status` = '1'
                            WHERE
                                num = '$numq'");
        }

        echo json_encode($data);
    }

    public function validasiss(){
        $num = $_POST['id'];
        $data = [
            'r_sts_upload_ss' => 1,
            'upload_ulang_ss' => 'N',
        ];
        $this->db->where('num', $num);
        $this->db->update('summary_2', $data);

        $cek = $this->db->query("SELECT
                                    a.*,
                                    c.num AS numq
                                FROM
                                    summary_2 a
                                    JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                                WHERE
                                    a.num = '$num'
                                    AND a.r_sts_dialog = 1
                                    AND a.r_sts_upload_layout = 1
                                    AND a.r_sts_upload_ss = 1
                                    AND a.r_sts_upload_slip_transaksi = 1
                                    AND c.rekaman_status = 3")->row_array();

        if($cek != null){
            $numq = $cek['numq'];
            $this->db->query("UPDATE quest
                            SET `status` = '3'
                            WHERE
                                num = '$numq'");
            }

        echo json_encode($data);
    }

    public function tolakss(){
        $num = $_POST['id'];
        $data = [
            'r_sts_upload_ss' => 0,
        ];
        $this->db->where('num', $num);
        $this->db->update('summary_2', $data);

        $cek = $this->db->query("SELECT
                                a.*,
                                c.num AS numq
                            FROM
                                summary_2 a
                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                            WHERE
                                a.num = '$num'")->row_array();

        if($cek != null){
            $numq = $cek['numq'];
            $this->db->query("UPDATE quest
                            SET `status` = '1'
                            WHERE
                                num = '$numq'");
        }

        echo json_encode($data);
    }

    public function validasitransaksi(){
        $num = $_POST['id'];
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_upload_slip_transaksi' => 1,
            'upload_ulang_slip' => 'N',
        ];
        $this->db->where('num', $num);
        $this->db->update('summary_2', $data);

        $cek = $this->db->query("SELECT
                                    a.*,
                                    c.num AS numq
                                FROM
                                    summary_2 a
                                    JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                                WHERE
                                    a.num = '$num'
                                    AND a.r_sts_dialog = 1
                                    AND a.r_sts_upload_layout = 1
                                    AND a.r_sts_upload_ss = 1
                                    AND a.r_sts_upload_slip_transaksi = 1
                                    AND c.rekaman_status = 3")->row_array();

        if($cek != null){
            date_default_timezone_set('Asia/Jakarta');

            $numq = $cek['numq'];
            $this->db->query("UPDATE quest
                            SET `status` = '3'
                            WHERE
                                num = '$numq'");

                $update = [
                    'validator_time' => date('Y-m-d H:i:s'),
                ];

                $this->db->update('summary_2', $update, ['num' => $num]);
            }

        echo json_encode($data);
    }

    public function tolaktransaksi(){
        $num = $_POST['id'];
        $data = [
            'r_sts_upload_slip_transaksi' => 0,
        ];
        $this->db->where('num', $num);
        $this->db->update('summary_2', $data);

        $cek = $this->db->query("SELECT
                                a.*,
                                c.num AS numq
                            FROM
                                summary_2 a
                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                            WHERE
                                a.num = '$num'")->row_array();

        if($cek != null){
            $numq = $cek['numq'];
            $this->db->query("UPDATE quest
                            SET `status` = '1'
                            WHERE
                                num = '$numq'");
        }

        echo json_encode($data);
    }

    public function temuandialog(){
        $id = $this->input->post('id');
        $this->Validasi_model->temuandialog();
        $this->session->set_flashdata('info', 'Data Berhasil Disimpan');

        redirect("validasi/lihatvalidasi/$id");
    }

    public function tolakdialog2(){
        $id = $this->input->post('id');
        $this->Validasi_model->tolakdialog2();
        $this->session->set_flashdata('info1', 'Data Dialog Di Tolak');

        redirect("validasi/lihatvalidasi/$id");
    }

    public function tolakrekaman2(){
        $id = $this->input->post('id');
        $this->Validasi_model->tolakrekaman2();
        $this->session->set_flashdata('info1', 'Data Rekaman Di Tolak');

        redirect("validasi/lihatvalidasi/$id");
    }

    public function tolakrekaman22(){
        $id = $this->input->post('id');
        $this->Validasi_model->tolakrekaman2();
        $this->session->set_flashdata('info1', 'Data Rekaman Di Tolak');

        redirect("validasi/lihatvalidasi/$id");
    }

    public function temuanlayout(){
        $id = $this->input->post('id');
        $this->Validasi_model->temuanlayout();
        $this->session->set_flashdata('info1', 'Data Layout Di Tolak');

        redirect("validasi/lihatvalidasi/$id");
    }

    public function temuanss(){
        $id = $this->input->post('id');
        $this->Validasi_model->temuanss();
        $this->session->set_flashdata('info1', 'Data SS Di Tolak');

        redirect("validasi/lihatvalidasi/$id");
    }

    public function temuanslip(){
        $id = $this->input->post('id');
        $this->Validasi_model->temuanslip();
        $this->session->set_flashdata('info1', 'Data Slip Transaksi Di Tolak');

        redirect("validasi/lihatvalidasi/$id");
    }

    public function temuanrekaman(){
        $id = $this->input->post('id');
        $this->Validasi_model->temuanrekaman();
        $this->session->set_flashdata('info', 'Data Berhasil Disimpan');

        redirect("validasi/lihatvalidasi/$id");
        // var_dump($this->input->post('kode'));
        // echo "<br>";
        // var_dump($this->input->post('kunjungan'));
        // echo "<br>";
        // var_dump($this->input->post('skenario'));
        // echo "<br>";
        // var_dump($this->input->post('cabang'));
        // echo "<br>";
        // var_dump($this->input->post('shp'));
        // echo "<br>";
        // var_dump($this->input->post('keterangan'));
        // echo "<br>";
        // die;
    }

    public function hapusTd()
    {
        $data['judul'] = 'HAPUS TD';
        $data['waktutd']= [];
        $data['idproject']= '';
        $data['idcabang']= '';
        $data['idskenario']= '';
        $data['project'] = $this->db->get_where('project', ['visible' => 'y', 'type' => 'n' ] )->result_array();

        if($this->input->post("ssprojecthapus")){
            $data['waktutd'] = $this->db->get_where('data_waktu_td', ['id_project' => $this->input->post("ssprojecthapus"), 'kode_cabang' => $this->input->post("cabanghapus"), 'id_skenario'=>$this->input->post("kunjunganhapus")] )->result_array();
            $data['idproject']=  $this->input->post("ssprojecthapus");
            $data['idcabang']= $this->input->post("cabanghapus");
            $data['idskenario']= $this->input->post("kunjunganhapus");
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('validasi/hapusTd', $data);
        $this->load->view('templates/footer');
    }

    public function getcabang()
    {
        $idproject = $_POST['id'];

        $data = $this->db->get_where('cabang', ['project'=> $idproject])->result_array();

        echo json_encode($data);
    }

    public function updatetglrekaman()
    {
		// $kpro = $this->input->post('kpro');
		// $kcab = $this->input->post('kcab');
        // $ksken = $this->input->post('ksken');
        // $tgl = $this->input->post('datemasukrekaman');

		$kpro = $_POST['kpro'];
		$kcab = $_POST['kcab'];
        $ksken = $_POST['ksken'];
        $tgl = $_POST['datemasukrekaman'];
        
        $data =[
            'tglrekaman' => $tgl,
            'rekaman_status' => '1',
        ];

        $this->db->update('quest', $data, ['project'=> $kpro, 'cabang'=> $kcab, 'kunjungan' => $ksken ]);

        echo json_encode($data);
    }

    public function hapusTdNya($pro,$cab,$kun)
    {

        // $cek = $this->db->query("SELECT * FORM data_waktu_td WHERE id_project = '$pro' AND kode_cabang= '$cab' AND id_skenario = '$kun'")->row_array();

        // if ($cek!=null) {
        
            $this->db->delete('data_waktu_td', ['id_project'=>$pro, 'kode_cabang'=>$cab, 'id_skenario'=>$kun]);
            $this->session->set_flashdata('hapus', 'Data Dihapus');
            
            redirect("validasi/hapusTd");
        // }else {
            
        // }
    }

    public function trcabang(){
        $pro = $_POST['pro'];
        $sken = $_POST['sken'];
        $data = $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    b.kode,
                                    b.nama
                                FROM
                                    project a
                                    JOIN cabang b ON a.kode = b.project
                                    JOIN quest d ON d.project = '$pro' AND d.kunjungan = '$sken' AND b.kode = d.cabang
                                WHERE
                                    a.kode = '$pro'
                                ORDER BY
                                    b.kode ASC")->result_array();

        echo json_encode($data);
    }

    public function trackingq(){
        $pro = $_POST['pro'];
        $sken = $_POST['sken'];
        $cbg = $_POST['cbg'];

        $data = $this->db->query("SELECT
                                        a.tanggal,
                                        a.STATUS,
                                        a.rekaman_status,
                                        CASE WHEN a.tglrekaman is NULL THEN 0 ELSE a.tglrekaman END as tglrek,
                                        a.cabang,
                                        CASE WHEN b.waktu_upload is NULL THEN 0 ELSE DATE(b.waktu_upload) END as tgldialog,
                                        CASE WHEN b.validator_time  is NULL THEN 0 ELSE DATE(b.validator_time)  END as tglvalid,
                                        CASE WHEN a.shp_rtp_date is NULL THEN 0 ELSE DATE(a.shp_rtp_date)  END as tglrtp,
                                        CASE WHEN a.shp_paid_date is NULL THEN 0 ELSE DATE(a.shp_paid_date)  END as tglshp
                                    FROM
                                        quest a
                                        LEFT JOIN summary_2 b ON a.project = b.project_kode 
                                        AND a.cabang = b.cabang_kode 
                                        AND a.kunjungan = b.sub_kunjungan_kode 
                                    WHERE
                                        a.project = '$pro' 
                                        AND a.cabang = '$cbg' 
                                        AND a.kunjungan = '$sken'
                               ")->result_array();

        echo json_encode($data);
    }

    public function lihatValidasiUploadUlang($num)
    {
        $dt = $this->db->get_where('summary_2', ['num'=>$num])->row_array();
        $db = $this->db->get_where('quest', ['shp'=>$dt['shp_id'], 'kunjungan'=>$dt['sub_kunjungan_kode'], 'cabang'=>$dt['cabang_kode'], 'project'=>$dt['project_kode']])->row_array();

        redirect('validasi/lihatvalidasi/'.$db['num']);
    }

}
