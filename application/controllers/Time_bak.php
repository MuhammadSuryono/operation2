<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata('id_user')){
            redirect('auth');
        }

        $this->load->model('Time_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = "Time Delivery";
        $data['project'] = $this->Time_model->getallproject();
        $data['attribute'] = $this->Time_model->getattribute();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('time/index', $data);
        $this->load->view('templates/footer');
    }

    // public function view(){
    //     $data['judul'] = "Report TD";
    //     $data['project'] = $this->Time_model->getallproject();

    //     $this->load->view('templates/header', $data);
    //     $this->load->view('templates/sidebar');
    //     $this->load->view('time/view', $data);
    //     $this->load->view('templates/footer');
    // }

    public function view(){
        $data['judul'] = "Report TD";
        $data['project'] = $this->Time_model->getallproject();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('time/view_2', $data);
        $this->load->view('templates/footer');
    }

    public function getdatatd_report_sum(){

        $id    = $_POST['id'];
        $ske   = $_POST['ske'];
        $data = $this->Time_model->getdatatd_report_sum($id, $ske);
        echo json_encode($data);

    }

    public function getdatatd_sort_sk(){

        $id    = $_POST['id'];
        $data = $this->Time_model->getdatatd_sort_sk($id);
        echo json_encode($data);

    }

    public function getdatatd_sort_piltd(){

        $id    = $_POST['id'];
        $ske   = $_POST['ske'];
        $data = $this->Time_model->getdatatd_sort_piltd($id, $ske);
        echo json_encode($data);

    }

    public function getjumcabang(){

        $id    = $_POST['id'];
        $data = $this->Time_model->getjumcabang($id);
        echo json_encode($data);

    }

    public function getdatatd_report(){

        $id    = $_POST['id'];
        $ske   = $_POST['ske'];
        $data = $this->Time_model->getdatatd_report($id, $ske);
        echo json_encode($data);

    }

    //tambahan edit TD

    public function getcbg_tdedit(){

        $id    = $_POST['id'];
        $sken   = $_POST['sken'];
        $data = $this->Time_model->getcbg_tdedit($id, $sken);
        echo json_encode($data);

    }

    public function getdata_tdedit(){

        $pro    = $_POST['pro'];
        $sken   = $_POST['sken'];
        $cbg   = $_POST['cbg'];
        $data = $this->Time_model->getdata_tdedit($pro, $sken, $cbg);
        echo json_encode($data);

    }

    public function buat(){
        $data['judul'] = "Form Kolom Time Develiry";
        $data['project'] = $this->input->post('projectid');
        $data['kode'] = $this->input->post('project');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('time/buat', $data);
        $this->load->view('templates/footer');
    }

    public function tambah(){
        $this->Time_model->tambahA();
        redirect('time/index');
    }

    public function valid(){
        $data['judul'] = "AUVIQ";
        $data['project'] = $this->Time_model->getallproject();
        $data['form'] = $this->Time_model->getattribute();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('time/valid', $data);
        $this->load->view('templates/footer');
    }

    public function getdaftarcabang(){
        $id    = $_POST['id'];
        $ske   = $_POST['ske'];
        $data = $this->Time_model->getdaftarcabang($id, $ske);
        echo json_encode($data);
    }

    public function tambahAg(){

        $jml = $this->input->post('jumlahpiltd');
        $durasi = explode(":", $this->input->post('part1'));
        $part2 = $this->input->post('part2');
        $jmldurasi = "$durasi[0] hours + $durasi[1] minutes + $durasi[2] seconds";
        $user = $this->session->userdata('id_user');
        $project = $this->input->post('project_td');
        // $bank = $this->input->post('bank');
        $cabang = $this->input->post('cabang');
        $formxx = $this->input->post('formxx');
        $kform = $this->input->post('kapan_isi_form');
        $jform = $this->input->post('jenis_form');
        $kondform = $this->input->post('selesai_isi_form');
        $userentry = $this->session->userdata('id_user');

        var_dump($jml);
        var_dump($user);
        var_dump($project);
        var_dump($cabang);
        var_dump($formxx);
        var_dump($kform);
        var_dump($jform);
        var_dump($kondform);

        $cek = $this->db->get_where('data_waktu_td', ['id_project'=>$project, 'kode_cabang'=>$cabang, 'id_skenario'=>$formxx])->row_array();

        if(is_null($cek)){

        $temuan = $this->input->post('temuan');
        $data = [];

        for($i=1; $i<=$jml; $i++){
            $r = $i+1;
            $s = $r+1;
            $namakol = $this->input->post("piltd$i");
            // $interupsi = "";
            $interupsi = $this->input->post("ketinterupsi$r");
            // $date  = date_create($this->input->post("jbpiltd$r"));
            // $date1 = date_create($this->input->post("jbpiltd$s"));
            $awal  = date_create($this->input->post("jbpiltd$r"));
            $awalbgt  = date_create($this->input->post("jbpiltd2"));


            // $awal = date_add($date,date_interval_create_from_date_string("$jmldurasi"));
            // $akhir = date_add($date1,date_interval_create_from_date_string("$jmldurasi"));

            if(strtotime($this->input->post("jbpiltd$r"))>=strtotime($this->input->post("jbpiltd$s")) and $this->input->post("jbpiltd$s")!=null){
                $datexx = date_create($this->input->post("jbpiltd$s"));
                $akhir = date_add($datexx,date_interval_create_from_date_string("$jmldurasi"));
                var_dump($this->input->post("jbpiltd$s"));
            } else {
                $akhir = date_create($this->input->post("jbpiltd$s"));
            }

            // if($this->input->post("jbpiltd$s")!=null){
            //     $akhir = date_create($this->input->post("akhirburek"));
            // }

            // if(strpos($namakol, "Interupsi")>-1){
            //     $no = substr($namakol, -1, 1);
            //     // $data["ket_interupsi_$no"] = $this->input->post("ketinterupsi$i");
            //     $interupsi = $this->input->post("ketinterupsi$r");
            //     // $interupsi = $this->input->post("ketinterupsi$i");
            //     // var_dump($r);
            //     // var_dump($interupsi); die;
            // }

            if($this->input->post("jbpiltd$s") == ''){
                // $date1 = date_create($this->input->post("akhirburek"));
                $akhir = date_create($this->input->post("akhirburek"));
                // $akhir = date_add($date1,date_interval_create_from_date_string("$jmldurasi"));
            }

            if($part2 = ""){
                $akhirbgt = date_create($this->input->post("akhirburek"));
            } else {
                $akhirxx = date_create($this->input->post("akhirburek"));
                $akhirbgt = date_add($akhirxx, date_interval_create_from_date_string("$jmldurasi"));
            }

            $diff  = date_diff( $awal, $akhir );
            $namakol1 = str_replace(" ", '_', $namakol);
            $selisih = $diff->h . ':' . $diff->i . ':' . $diff->s;
            $diffbgt  = date_diff( $awalbgt, $akhirbgt );
            $fulltd = $diffbgt->h . ':' . $diffbgt->i . ':' . $diffbgt->s;
            // $data["$namakol1"]= $diff->h . ':' . $diff->i . ':' . $diff->s;

            var_dump($namakol);
            var_dump($this->input->post("jbpiltd$r"));
            var_dump($this->input->post("akhirburek"));
            echo "<br>";

            $data1 = [
                'id_project' => $project,
                'kode_cabang' => $cabang,
                'id_skenario' => $formxx,
                'proses' => $namakol,
                'waktu' => $selisih,
                'full' => $fulltd,
                'ket_interupsi' => $interupsi,
                'temuan' => $temuan,
                'kapan_isi_form' => $kform,
                'jenis_form' => $jform,
                'kondisi_pengisian' => $kondform,
                'user_entry' => $userentry,
                'status_td' => 1,
            ];

// ================================insert ke td timpstamp =======================

            $data2 = [
                'id_project' => $project,
                'kode_cabang' => $cabang,
                'id_skenario' => $formxx,
                'proses' => $namakol,
                'waktu' => $this->input->post("jbpiltd$r"),
                'akhir_td' => $this->input->post("akhirburek"),
                'full' => $fulltd,
                'ket_interupsi' => $interupsi,
                'temuan' => $temuan,
                'kapan_isi_form' => $kform,
                'jenis_form' => $jform,
                'kondisi_pengisian' => $kondform,
                'user_entry' => $userentry,
                'status_td' => '1',
            ];

            $this->db->insert('data_waktu_timestamp', $data2);

//=================================================================================

            array_push($data, $data1);
            // $this->db->insert('a_data_waktu_td', $data1);
        }
        $this->db->insert_batch('data_waktu_td', $data);

        echo "Data berhasil di input, silahkan refresh halaman. Terima kasih. ^_^";

        $this->session->set_flashdata('flash', 'Data berhasil disimpan !');
        redirect('time/valid');
    }else{
        $this->session->set_flashdata('flash', 'Data sudah ada di database, gagal menyimpan !');
        redirect('time/valid');
    }
    }

    public function jenistime(){
        $id = $_POST['skenario'];
        $pro = $_POST['project'];
        $this->db->order_by('id_td', 'ASC');
        $data =  $this->db->get_where('data_td', ['id_skenario' => $id,'id_project'=>$pro])->result_array();
		echo json_encode($data);
    }

    public function getdatawaktutd(){

        $id    = $_POST['id'];
        $ske   = $_POST['ske'];
        $data = $this->Time_model->getdatawaktutd($id, $ske);
        echo json_encode($data);
    }

}
