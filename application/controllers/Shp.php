<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shp extends CI_Controller {

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

            $id_user = $this->session->userdata('id_user');
            $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();

            if($user['id_akses'] == 1) {
                redirect('block');
            }
        }

        $this->load->model('Shp_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index(){
        $data['judul'] = 'Daftar Dialog';
        $data['data_dialog'] = $this->Shp_model->getAllData();
        $data['data_dialog'] = $this->Shp_model->getAllDataKB();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah($kunjungan, $project, $cabang){
        $data['judul'] = 'Form Pengisian Dialog';
        // $data['jenis_skenario'] = $this->Shp_model->getDataProjectSkenario(); //$this->db->get('data_skenario')->result_array();
        // $jenis_skenario = $this->Shp_model->getDataProjectSkenario(); //$this->db->get('data_skenario')->result_array();

        // $id_user = $this->session->userdata('id_user'); foreach($jenis_skenario as $js => $sk){ $no = 0;
        //                 $cek_equest = $this->db->get_where('data_aktual', ['id_user' => $id_user, 'id_kunjungan' => $sk['id_kunjungan']])->result_array();

        //                 foreach($cek_equest as $cek => $ce){
        //                     if($ce['id_status_equest'] == 0){
        //                       $no++;
        //                     }
        //                     var_dump($ce);
        //                     echo "<br>";
        //                 }
        // }

        // // if($no != 0){
        // //     var_dump($no);
        // // }
        // die;

        $data['project'] = $this->db->get_where('project', ['kode' => $project])->row_array();
        $data['quest'] = $this->Shp_model->getDialogSkenarioKB($kunjungan, $project, $cabang);
        $data['kunjungan'] = $kunjungan;
        $data['cabang'] = $cabang;

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/tambahKB', $data);
            $this->load->view('templates/footer');
        } else {
            // $this->Shp_model->tambah();

            $this->Shp_model->tambahKB();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Dialog berhasil<strong> disimpan!</strong>.
                </div>');
            redirect('aktual');
        }
    }

    public function ubah($id){
        $data['judul'] = "Ubah Dialog Skenario";
        $data['data_dialog'] = $this->db->get_where('data_dialog', ['id_dialog' => $id])->row_array();
        $data['jenis_skenario'] = $this->db->get('data_skenario')->result_array();
        $this->form_validation->set_rules('dialog', 'Dialog', 'required');

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Shp_model->ubah($id);
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Dialog berhasil<strong> diubah!</strong>.
                </div>');
            redirect('shp');
        }
    }

    public function ubahKB($id){
        $data['judul'] = "Ubah Dialog Skenario";
        $data['dialog'] = $this->Shp_model->getDialogKB($id);
        $data['datakunjungan'] = $this->Shp_model->datakunjunganbyid($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/ubahKB', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Shp_model->ubahKB($id);
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Dialog berhasil<strong> diubah!</strong>.
                </div>');
            redirect('shp/cekdata');
        }
    }

    public function hapus($id){
        // $this->Shp_model->hapus($id);
        $this->Shp_model->hapusKB($id);
         $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Dialog telah<strong> dihapuskan!</strong>.
                </div>');
            redirect('shp');
    }

    public function upload(){
        $data['judul'] = 'Upload Kunjungan';
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        // $data['jenis_skenario'] = $this->db->get('data_skenario')->result_array();
        // $data['jenis_skenario'] = $this->Shp_model->getSkenarioById();
        $data['jenis_skenario'] = $this->Shp_model->getDataProjectSkenario();

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/upload', $data);
            $this->load->view('templates/footer');
        } else {

            $img1 = $_FILES['transaksi']['name'];
            $img2 = $_FILES['equest']['name'];
            $img3 = $_FILES['layout']['name'];

            if ($img1 and $img2 and $img3){
                $config['upload_path']          = './assets/file/';
                $config['allowed_types']        = 'jpg|gif|png|jpeg|pdf|docx|doc';

                $this->load->library('upload', $config);

                if($this->upload->do_upload('transaksi')) {
                       $img1 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                if($this->upload->do_upload('equest')) {
                       $img2 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                if($this->upload->do_upload('layout')) {
                       $img3 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

            }

            $this->Shp_model->upload($img1, $img2, $img3);
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Kunjungan telah<strong> ditambahkan!</strong>.
                </div>');
            redirect('shp/daftarkunjungan');
        }

    }

    public function daftarkunjungan(){
        $data['judul'] = 'Daftar Kunjungan';
        // $data['data_kunjungan'] = $this->Shp_model->datakunjungan();
        $data['data_kunjungan'] = $this->Shp_model->datakunjunganKB();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/daftarkunjunganKB', $data);
        $this->load->view('templates/footer');
    }

    public function lihat($id){
        // $data['data_kunjungan'] = $this->Shp_model->getDataKunjunganById($id);
        $data['data_kunjungan'] = $this->Shp_model->datakunjunganByIdKB($id);
        $data['judul'] = 'Bukti Kunjungan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/lihatkunjunganbaruKB', $data);
        $this->load->view('templates/footer');
    }

    public function ubahkunjungan($id){
        $this->form_validation->set_rules('jenis', 'Jenis', 'required');
        $data['jenis_skenario'] = $this->db->get('data_skenario')->result_array();
        $data['data_kunjungan'] = $this->Shp_model->getDataKunjunganById($id);
        $data['judul'] = 'Ubah Data Kunjungan';

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/ubahkunjungan', $data);
            $this->load->view('templates/footer');
        } else {
            $img1 = $_FILES['transaksi']['name'];
            $img2 = $_FILES['equest']['name'];
            $img3 = $_FILES['layout']['name'];

            if($img1){
                $config['upload_path']          = './assets/file/';
                $config['allowed_types']        = 'jpg|gif|png|jpeg|pdf|docx|doc';

                $this->load->library('upload', $config);
                if($this->upload->do_upload('transaksi')) {
                       $img1 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            } else {
                $img1 = 0;
            }

            if($img2){
                $config['upload_path']          = './assets/file/';
                $config['allowed_types']        = 'jpg|gif|png|jpeg|pdf|docx|doc';

                $this->load->library('upload', $config);
                if($this->upload->do_upload('equest')) {
                       $img2 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            } else {
                $img2 = 0;
            }

            if($img3){
                $config['upload_path']          = './assets/file/';
                $config['allowed_types']        = 'jpg|gif|png|jpeg|pdf|docx|doc';

                $this->load->library('upload', $config);
                if($this->upload->do_upload('layout')) {
                    $img3 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            } else {
                $img3 = 0;
            }

            $this->Shp_model->ubahkunjungan($id, $img1, $img2, $img3);
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Kunjungan telah<strong> diubah!</strong>.
                </div>');
            redirect('shp/daftarkunjungan');
        }
    }

    public function hapuskunjungan($id){
        $this->Shp_model->hapuskunjungan($id);

        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bukti Kunjungan telah<strong> dihapus!</strong>.
                </div>');
        redirect('shp/daftarkunjungan');
    }

    public function uploadKB($kunjungan, $project, $cabang){
        $data['judul'] = 'Upload Bukti Kunjungan';
        $data['project'] = $this->db->get_where('project', ['kode' => $project])->row_array();
        // $data['project'] = $this->Shp_model->getDataProjectBySummary_2KB($kunjungan, $project, $cabang);
        $data['quest'] = $this->Shp_model->getDataDialogKB($kunjungan, $project, $cabang);
        // var_dump($data['quest']); die;
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/uploadKB', $data);
            $this->load->view('templates/footer');
        } else {
            // var_dump("MASUK WAY"); die;
            // $this->Shp_model->upload($img1, $img2, $img3);
            $this->Shp_model->uploadKB();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Bukti Kunjungan telah<strong> ditambahkan!</strong>.
                </div>');
            redirect('aktual');
        }

    }

    public function ubahkunjunganKB($id){
        $data['judul'] = 'Ubah Data Kunjungan';
        $data['quest'] = $this->Shp_model->getDataDialogByIdKB($id);
        $data['dialog'] = $this->Shp_model->getDialogKB($id);
        $data['datakunjungan'] = $this->Shp_model->datakunjunganbyid($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/ubahkunjunganKB', $data);
            $this->load->view('templates/footer');
        } else {
            // $this->Shp_model->ubahkunjungan($id, $img1, $img2, $img3);
            $this->Shp_model->ubahkunjunganKB();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Kunjungan telah<strong> diubah!</strong>.
                </div>');
            redirect('shp/cekdata');
        }
    }

    public function ubahkunjunganKBNew($id){
        $data['judul'] = 'Ubah Data Kunjungan';
        $data['quest'] = $this->Shp_model->getDataDialogByIdKB($id);
        $data['dialog'] = $this->Shp_model->getDialogKB($id);
        $data['datakunjungan'] = $this->Shp_model->datakunjunganbyid($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/ubahkunjunganKBNew', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Shp_model->ubahkunjunganKBNew();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Kunjungan telah<strong> diubah!</strong>.
                </div>');
            redirect('shp/cekdata');
        }
    }

    public function cekdata(){
        $data['judul'] = 'Ubah Data Kunjungan';
        $data['data_dialog'] = $this->Shp_model->getAllDataKunjunganKB();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/cekdata', $data);
        $this->load->view('templates/footer');

    }

    public function tambahKZ($kunjungan, $project, $cabang){
        $data['judul'] = 'KZ Form Pengisian Dialog';

        $data['project'] = $this->db->get_where('project', ['kode' => $project])->row_array();
        $data['quest'] = $this->Shp_model->getDialogSkenarioKB($kunjungan, $project, $cabang);
        $data['datakunjungan'] = $this->Shp_model->getdatakunjungan($kunjungan, $project, $cabang);
        $data['kunjungan'] = $kunjungan;
        $data['cabang'] = $cabang;

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('kode', 'Kode', 'required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/tambahKZBARU', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Shp_model->tambahKB();
            $this->Shp_model->uploadKZ();
            $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Dialog berhasil<strong> disimpan!</strong>.
                </div>');
            redirect('aktual');
        }
    }

    public function simpanKZ(){
        $this->Shp_model->tambahKB();
        $this->Shp_model->uploadKB();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Dialog + Bukti Kunjungan berhasil<strong> disimpan!</strong>.
                </div>');
        redirect('aktual');
    }

    public function upload_foto_temuan(){

        $data['judul'] = "Upload Foto Temuan";
        $data['project'] = $this->db->get_where('project', ['visible' => 'y', 'type' => 'n' ] )->result_array();

        $this->form_validation->set_rules('sproject', 'sproject', 'required');
        $this->form_validation->set_rules('skunjungan', 'skunjungan', 'required');
        $this->form_validation->set_rules('temskenario', 'temskenario', 'required');
        $this->form_validation->set_rules('rekamancabang', 'rekamancabang', 'required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/upfototemuan', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Shp_model->upfototemuan();
            $this->session->set_flashdata('flash', 'Bukti foto berhasil disimpan !');
            redirect('shp/upload_foto_temuan');

        }
    }


    public function upload_foto_temuanRA($pjk, $kunj, $sken, $cab){

        $data['temuannya'] = $this->db->query("SELECT * FROM data_foto_temuan WHERE project='$pjk' AND cabang='$cab' AND kunjungan='$kunj' AND skenario='$sken'")->result_array();
        $data['pjk'] = $this->db->get_where('project', array('kode' => $pjk))->row_array();
        $data['kunj'] = $this->db->get_where('attribute', array('kode' => $kunj))->row_array();
        $data['sken'] = $this->db->get_where('attribute', array('kode' => $sken))->row_array();
        $data['cab'] = $this->db->get_where('cabang', array('project' => $pjk, 'kode' => $cab))->row_array();


        $data['judul'] = "Upload Foto Temuan";
        $data['project'] = $this->db->get_where('project', ['visible' => 'y', 'type' => 'n' ] )->result_array();

        $this->form_validation->set_rules('sproject', 'sproject', 'required');
        $this->form_validation->set_rules('skunjungan', 'skunjungan', 'required');
        $this->form_validation->set_rules('temskenario', 'temskenario', 'required');
        $this->form_validation->set_rules('rekamancabang', 'rekamancabang', 'required');
        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('shp/upfototemuanRA', $data);
            $this->load->view('templates/footer');
        } else {

            $this->Shp_model->upfototemuan();
            $this->session->set_flashdata('flash', 'Bukti foto berhasil disimpan !');
            redirect('shp/upload_foto_temuanRA/'.$pjk."/".$kunj)."/".$sken."/".$cab;

        }
    }

    public function getcabangrekaman(){
        $id_user = $this->session->userdata('id_user');
        $id_divisi = $this->session->userdata('id_divisi');

        $pro = $_POST['pro'];
        $sken = $_POST['sken'];
        if ($id_divisi == 1) {
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
    } else {
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
                                    AND d.shp = '$id_user'
                                ORDER BY
                                    b.kode ASC")->result_array();
    }
        echo json_encode($data);
    }

    public function cekdatatemuan(){
        $data['judul'] = 'Data Temuan';
        $data['data_temuan'] = $this->Shp_model->getdatatemuan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/datatemuan', $data);
        $this->load->view('templates/footer');

    }

    public function cekdatatemuanRA(){
        $data['judul'] = 'Data Temuan';
        $data['data_temuan'] = $this->Shp_model->getdatatemuanRA();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/datatemuan', $data);
        $this->load->view('templates/footer');

    }

    public function lihatDialog($id){
        $data['judul'] = 'Dialog';
        $data['dialog'] = $this->Shp_model->getDialogById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/lihatDialog', $data);
        $this->load->view('templates/footer');
    }

    public function tracking()
    {
        $data['judul'] = 'Tracking';
        $data['project'] = $this->db->get_where('project', ['visible' => 'y', 'type' => 'n'])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('shp/tracking', $data);
        $this->load->view('templates/footer');

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

    public function getkunjungan(){
        $kode = $_POST['id'];
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

    public function gettemuan_sebelumnya(){
        // $id_user = $this->session->userdata('id_user');
        $id_divisi = $this->session->userdata('id_divisi');

        $pro = $_POST['pro'];
        $sken = $_POST['sken'];
        $kunj = $_POST['kunj'];
        $cabang = $_POST['cabang'];
        if ($id_divisi == 1) {
        $data = $this->db->query("SELECT
                                    *
                                FROM
                                    data_foto_temuan
                                WHERE
                                    project = '$pro' AND cabang='$cabang' AND kunjungan='$kunj' AND skenario='$sken'
                                ")->result_array();
        } 
        echo json_encode($data);
    }


}
