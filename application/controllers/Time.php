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

     public function index_ebanking(){
        $data['judul'] = "Time Delivery E-Banking";
        $data['project'] = $this->Time_model->getproject_ebanking();
        $data['bank'] = $this->Time_model->getbank();
        $data['transaksi'] = $this->Time_model->gettransaksi();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('time/index_ebanking', $data);
        $this->load->view('templates/footer');
    }

    public function getdata_sken()
    {
        $kode = $_POST['kode'];
        $data = $this->Time_model->getdata_sken($kode);
        echo json_encode($data);
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
        $data['piltd'] = $this->Time_model->getdatatd_sort_piltd($id, $ske);
        $data['cek'] = $this->db->query("SELECT * FROM quest WHERE project='$id' AND kunjungan='$ske' AND status='3'")->row_array();    
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

    public function edittd_list($project, $kode){
        $data['judul'] = "Form Kolom Edit Time Develiry";
        $data['project'] = $project;
        $data['kode'] = $kode;

        $data['list'] = $this->db->query("SELECT * FROM data_td WHERE id_project = '$project' AND id_skenario='$kode' ORDER BY id_td ASC")->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('time/edittd_list', $data);
        $this->load->view('templates/footer');
    }

    public function create_ebanking(){
        $data['judul'] = "Form Kolom Time Develiry";
        // $data['project'] = $this->input->post('project_eb');
        $data['bank'] = $this->input->post('bank_eb');
        $data['channel'] = $this->input->post('channel_eb');
        $data['transaksi'] = $this->input->post('transaksi_eb');
        if ($data['channel'] == 'SMS Banking') {
            $data['os'] = $this->input->post('os_eb');
            $data['jenis'] = '';
        } else {
            $os = $this->input->post('os_eb');
            $split = explode("_", $os);

            $data['os'] = $split[0];
            $data['jenis'] = $split[1];
        }

        $cek = [
                // 'project' => $data['project'],
                'bank' => $data['bank'],
                'channel' => $data['channel'],
                'transaksi' => $data['transaksi'],
                'os' => $data['os'],
                'jenis' => $data['jenis']
                ];

        $data['hasilcek'] = $this->db->order_by('versi', 'DESC')->get_where('ebanking_data_td', $cek)->row_array();

        if ($data['hasilcek'] == NULL) {
           
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('time/create_ebanking', $data);
            $this->load->view('templates/footer');
        } else {
            
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('time/create_ebanking', $data);
            $this->load->view('templates/footer');

            
        }
    }

    public function edittd_ebanking()
    { 
        $update = date('Y-m-d');
        if (isset($_POST['hapus_td'])) {
            $id = $this->input->post('delete_id');

            foreach ($id as $row => $val) {
                $this->db->query("DELETE FROM ebanking_data_td WHERE id='$val'");
            }

        $this->session->set_flashdata('flash', 'Berhasil Delete Label Time Delivery');
        redirect('time/index_ebanking');

        } else if (isset($_POST['update_td'])) {
            $id = $this->input->post('id_label');
            $label = $this->input->post('label_td');
            $step = $this->input->post('step_td');
            $channel = $this->input->post('channel');



            foreach ($id as $row => $val) {
                $cek = $this->db->get_where('ebanking_data_td', array('id' => $val))->row();

                if ($cek != NULL) {
                    $this->db->select('*');
                    $this->db->from('ebanking');
                    $this->db->where('bank', $_POST['bank']);
                    $this->db->where('channel', $_POST['channel']);
                    $this->db->where('transaksi', $_POST['transaksi']);
                    if ($channel == 'Mobile Banking' OR $channel == 'Internet Banking') {
                    $this->db->where('jenis', $_POST['jenis']);
                    }
                    if ($channel == 'Mobile Banking' OR $channel == 'SMS Banking') {
                    $this->db->where('os', $_POST['os']);
                    }
                    $this->db->where('versi_label', $_POST['versi_td'][$row]);
                
                    $aksi = $this->db->get()->result_array();
                      if ($aksi == NULL) {
                        $this->db->query("UPDATE ebanking_data_td SET label='$label[$row]', step='$step[$row]', last_update='$update' WHERE id='$val'");
                    } else {
                        $this->db->query("UPDATE ebanking_data_td SET label='$label[$row]', step='$step[$row]' WHERE id='$val'");
                    }
                    
                } else {
                        $data = [
                        'bank' => $_POST['bank'],
                        'channel' => $_POST['channel'],
                        'os' => $_POST['os'],
                        'jenis' => $_POST['jenis'],
                        'transaksi' => $_POST['transaksi'],
                        'step' => $_POST['step_td'][$row],
                        'label' => $label[$row],
                        'versi' => $_POST['versi_td'][$row],
                        'pembuat' => $this->session->userdata('id_user'),
                        'last_update' => $update
                        ];
                     $this->db->insert('ebanking_data_td', $data);
                }

            }
        $this->session->set_flashdata('flash', 'Berhasil Update Label Time Delivery');
        redirect('time/index_ebanking');

        }
    }


    public function tambah(){
        $this->Time_model->tambahA();
        redirect('time/index');
    }

    public function editstep_listtd(){
        $this->Time_model->editstep_listtd();
        $this->session->set_flashdata('flash', 'Berhasil Edit Time Delivery');
        redirect('time/index');
    }

    public function deletestep_listtd($id){
        $get = $this->db->get_where('data_td', array('id_td' => $id))->row_array();
        $this->db->query("DELETE FROM data_td WHERE id_td='$id'");

        $this->session->set_flashdata('flash', 'Berhasil Delete List Time Delivery');
        redirect('time/edittd_list/'.$get['id_project']."/".$get['id_skenario']);        
    }

    public function tambah_ebanking(){
        $this->Time_model->add_td_ebanking();
        $this->session->set_flashdata('flash', 'Berhasil Input Time Delivery');
        redirect('time/index_ebanking');
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
        $num = $this->input->post('num');
        
        $data_quest = ['kom_antrian' => $this->input->post('antrian'),
                        'kom_rekaman_video' => $this->input->post('rekaman_video')];

        $this->db->where('num', $num);
        $this->db->update('quest', $data_quest);


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
                'timestamp' => $this->input->post("jbpiltd$r"),
                'akhir_td' => $this->input->post("akhirburek"),
                'part_1' => $this->input->post("part1"),
                'part_2' => $this->input->post("part2"),
            ];

// ================================insert ke td timpstamp =======================

            // $data2 = [
            //     'id_project' => $project,
            //     'kode_cabang' => $cabang,
            //     'id_skenario' => $formxx,
            //     'proses' => $namakol,
            //     'waktu' => $this->input->post("jbpiltd$r"),
            //     'akhir_td' => $this->input->post("akhirburek"),
            //     'full' => $fulltd,
            //     'ket_interupsi' => $interupsi,
            //     'temuan' => $temuan,
            //     'kapan_isi_form' => $kform,
            //     'jenis_form' => $jform,
            //     'kondisi_pengisian' => $kondform,
            //     'user_entry' => $userentry,
            //     'status_td' => '1',
            // ];

            // $this->db->insert('data_waktu_timestamp', $data2);

//=================================================================================

            array_push($data, $data1);
        }
        $this->db->insert_batch('data_waktu_td', $data);

        echo "Data berhasil di input, silahkan refresh halaman. Terima kasih. ^_^";

        $this->session->set_flashdata('flash', 'Data berhasil disimpan !');
        redirect('validasi/validasidataNew');
    }else{
        $this->session->set_flashdata('flash', 'Data sudah ada di database, gagal menyimpan !');
        redirect('validasi/validasidataNew');
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

    public function get_db_td(){

        $id    = $_POST['id'];
        $ske   = $_POST['sken'];
        $data = $this->db->order_by('kode_cabang', 'ASC')->get_where('data_waktu_td', ['id_project' => $id,'id_skenario' => $ske ])->result_array();
        echo json_encode($data);
    }


     public function getvar_td()
  {
    // $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $chan = $_POST['chan'];
    $pro = $_POST['pro'];
    $data = $this->Time_model->getvar_td($bank, $chan, $pro);
    echo json_encode($data);
  }

   public function gettd_ebanking()
  {
    // $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $chan = $_POST['chan'];
    // $pro = $_POST['pro'];
    $transaksi = $_POST['transaksi'];
    $os = $_POST['os'];
    $jenis = $_POST['jenis'];
    
    $data = $this->Time_model->gettd_ebanking($bank, $chan, $transaksi, $os, $jenis);
    echo json_encode($data);
  }

   public function gettd_ebanking_form()
  {
    // $id = $_POST['id_project'];
    $bank = $_POST['bank'];
    $chan = $_POST['chan'];
    // $pro = $_POST['pro'];
    $transaksi = $_POST['transaksi'];
    $os = $_POST['os'];
    $jenis = $_POST['jenis'];
    
    
    $data = $this->Time_model->gettd_ebanking_form($bank, $chan, $transaksi, $os, $jenis);
    echo json_encode($data);
  }

    public function tambah_gadai_1(){

        $userentry = $this->session->userdata('id_user');
        $project = $this->input->post('project_td');
        $cabang = $this->input->post('cabang');
        $formxx = $this->input->post('formxx');

        $cek = $this->db->get_where('data_waktu_td_gd', ['id_project'=>$project, 'kode_cabang'=>$cabang, 'id_skenario'=>$formxx])->row_array();

        if(is_null($cek)){

        $data = [];

        for ($x=0; $x < 3; $x++) {
            $i = $x + 1; 
            for ($y=0; $y < 3; $y++) { 
                $j = $y + 1;

                $data1 = [
                    'user_entry' => $userentry,
                    'id_project' => $project,
                    'kode_cabang' => $cabang,
                    'id_skenario' => $formxx,
                    'proses' => $this->input->post("proses_$i"),
                    'sub_proses' => $this->input->post("subproses_".$i."_".$j),
                    'td' => $this->input->post("td_".$i."_".$j),
                    'penyebab_lama' => $this->input->post("penyebab_lama_".$i),
                    'temuan' => $this->input->post("temuan"),
                    'kasir_penaksir'=> $this->input->post("kasir_penaksir"),
                ];

                array_push($data, $data1);

                // var_dump($data1);
                // echo '<br>';            
            }
        }
        $this->db->insert_batch('data_waktu_td_gd', $data);
        // die;

        $this->session->set_flashdata('flash', 'Data berhasil disimpan !');
        $id = $this->input->post('numberq');
        redirect("validasi/lihatvalidasi2/$id");
    }else{
        $id = $this->input->post('numberq');
        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Gagal! Data TD sudah ada di database.
        </div>');
        redirect("validasi/lihatvalidasi2/$id");
    }
   
    }

    public function view_gadai()
    {
        $data['judul'] = "Report TD Gadai";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('time/view_gadai', $data);
        $this->load->view('templates/footer');
    }

    public function get_db_gadai()
    {
        $pro    = $_POST['pro'];
        $ske   = $_POST['ske'];
        $data=[];
        $data1 = $this->db->query("SELECT * FROM cabang WHERE project = '$pro' ORDER BY kode ASC")->result_array();
        array_push($data,$data1);
        $data2 = $this->db->query("SELECT a.*, b.name FROM data_waktu_td_gd a JOIN user b ON a.user_entry = b.noid WHERE a.id_project = '$pro' AND a.id_skenario = '$ske' GROUP BY a.kode_cabang")->result_array();
        array_push($data,$data2);
        $data3 = $this->db->query("SELECT * FROM data_waktu_td_gd WHERE id_project = '$pro' AND id_skenario = '$ske'")->result_array();
        array_push($data,$data3);

        echo json_encode($data);
    }

    public function get_cbg_gd()
    {
        $pro    = $_POST['pro'];
        $ske    = $_POST['ske'];
        $data = $this->db->query("SELECT
                                	a.* 
                                FROM
                                	cabang a
                                WHERE
                                	project = '$pro'
                                	AND EXISTS (
                                	SELECT b.id_waktu FROM data_waktu_td_gd b WHERE b.kode_cabang = a.kode AND b.id_skenario = '$ske'
                                	)
                                ORDER BY
                                	a.kode ASC")->result_array();
        echo json_encode($data);
    }

    public function get_cbg_db_edit()
    {
        $pro    = $_POST['pro'];
        $ske    = $_POST['ske'];
        $cbg    = $_POST['cbg'];
        $data = $this->db->query("SELECT * FROM data_waktu_td_gd WHERE id_project = '$pro' AND id_skenario = '$ske' AND kode_cabang = '$cbg'")->result_array();
        echo json_encode($data);
    }

    public function edit_td_gd()
    {
        $kasir_penaksir = $this->input->post('kasir_penaksir', true);
        $temuan = $this->input->post('temuan0', true);

        for ($i=0; $i < 9; $i++) { 

            $num = $this->input->post('num'.$i, true);
            $td = $this->input->post('td'.$i, true);
            $numlama = $this->input->post('numlama'.$i, true);

            if ($i == 0 || $i == 3 || $i == 6 ) {
                $penyebab_lama = $this->input->post('penyebab_lama'.$i, true);
            }

            $data = [
                'td' => $td,
                'penyebab_lama' => $penyebab_lama,
                'temuan' => $temuan,
                'kasir_penaksir' => $kasir_penaksir,
            ];

            $this->db->where('id_waktu', $num);
            $this->db->update('data_waktu_td_gd', $data);
        }

        redirect('time/view_gadai');

    }

    public function editRA($project, $kunjungan, $cabang)
    {
        $data['report_td'] = $this->db->query("SELECT a.*, b.nama AS nama_project, c.nama AS nama_cabang, d.nama AS nama_skenario FROM data_waktu_td a 
                                                LEFT JOIN project b ON a.id_project=b.kode
                                                LEFT JOIN cabang c ON a.id_project=c.project AND a.kode_cabang=c.kode
                                                LEFT JOIN attribute d ON a.id_skenario=d.kode
                                                WHERE a.id_project='$project' AND a.id_skenario='$kunjungan'AND a.kode_cabang='$cabang'")->result_array();
        
        $data['row_data'] = $this->db->query("SELECT a.*, b.nama AS nama_project, c.nama AS nama_cabang, d.nama AS nama_skenario, e.name AS nama_user FROM data_waktu_td a 
                                                LEFT JOIN project b ON a.id_project=b.kode
                                                LEFT JOIN cabang c ON a.id_project=c.project AND a.kode_cabang=c.kode
                                                LEFT JOIN attribute d ON a.id_skenario=d.kode
                                                LEFT JOIN user e ON a.user_revisi=e.noid
                                                WHERE a.id_project='$project' AND a.id_skenario='$kunjungan'AND a.kode_cabang='$cabang'")->row_array();        

        $data['judul'] = "Edit Time Delivery RA";

        $data['project'] = $project;
        $data['skenario'] = $kunjungan;
        $data['cabang'] = $cabang;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('time/editRA', $data);
        $this->load->view('templates/footer');

    }

    public function edittd_RA()
    {
        $project = $this->input->post('project');
        $skenario = $this->input->post('skenario');
        $cabang = $this->input->post('cabang');


        $total_td = $this->input->post('total_td');
        $alasan = $this->input->post('alasan_revisi');
        $user = $this->session->userdata('id_user');
        $datenow = date('Y-m-d');

        $data = ['revisi_ra' => $total_td,
                'alasan_revisi' => $alasan,
                'user_revisi' => $user,
                'tanggal_revisi' => $datenow
                ];

        $this->db->where(array('id_project' => $project, 'id_skenario' => $skenario, 'kode_cabang' => $cabang));
        $this->db->update('data_waktu_td', $data);

        $this->session->set_flashdata('flash', 'Berhasil revisi Total TD!');
        redirect("time/editRA/".$project."/".$skenario."/".$cabang);

    }

    public function editmedia_RA()
    {
        $project = $this->input->post('project');
        $skenario = $this->input->post('skenario');
        $cabang = $this->input->post('cabang');


        $jenis_form = $this->input->post('jenis_form');
        $datenow = date('Y-m-d');

        $data = ['jenis_form' => $jenis_form
                ];

        $this->db->where(array('id_project' => $project, 'id_skenario' => $skenario, 'kode_cabang' => $cabang));
        $this->db->update('data_waktu_td', $data);

        $this->session->set_flashdata('flash', 'Berhasil revisi jenis form!');
        redirect("time/editRA/".$project."/".$skenario."/".$cabang);

    }

}
