<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // $this->load->model('Aktual_model');
        $this->load->model('Proses_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = 'Daftar Data Equest';
        // $data['skenario'] = $this->db->get('data_skenario_kunjungan')->result_array();
        $data['skenario'] = $this->db->query("SELECT a.*, b.nama_project, c.nama as nama_skenario from attribute c join ( data_skenario_kunjungan a join data_project b on a.kode_project = b.kode_project) on a.kode = c.kode order by a.kode_project DESC")->result_array();
        // $data['aktual'] = $this->Aktual_model->getAktual();
        $data['jawaban'] = [];  
        $data['soal'] = [];
        $data['modalproject'] = "";
        $data['modalskenario'] = "";

        if($this->input->post('div')){
            $dataex = explode("-", $this->input->post('div'));
            $data['skenario1'] = $this->db->get_where('data_skenario', ['id_skenario' => $dataex[1]])->row_array();
            $data['soal'] = $this->Proses_model->getSoal($dataex[1]);
            $data['jawaban'] = $this->Proses_model->getJawaban($dataex[0], $dataex[1]);
            $data['project1'] = $this->db->get_where('data_project', ['id_project' => $dataex[0]])->row_array();
            $data['modalproject'] = $dataex[0];
            $data['modalskenario'] = $dataex[1];
        }

        if($this->uri->segment(3) and $this->uri->segment(4)){
            $data['skenario1'] = $this->db->get_where('data_skenario', ['id_skenario' => $this->uri->segment(4)])->row_array();
            $data['soal'] = $this->Proses_model->getSoal($this->uri->segment(4));
            $data['jawaban'] = $this->Proses_model->getJawaban($this->uri->segment(3), $this->uri->segment(4));
            $data['project1'] = $this->db->get_where('data_project', ['id_project' => $this->uri->segment(3)])->row_array();
            $data['modalproject'] = $this->uri->segment(3);
            $data['modalskenario'] = $this->uri->segment(4);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('proses/cek4', $data); //cek2=antar kunjungan; cek3=antar soal; cek4=cek konsistensi dari database;
        $this->load->view('templates/footer'); 
    }

    public function inkonsistensi(){
        $data['judul'] = 'Daftar Data Equest Inkonsisten';
        $data['skenario'] = $this->db->query("SELECT a.*, b.nama_project, c.nama as nama_skenario from attribute c join ( data_skenario_kunjungan a join data_project b on a.kode_project = b.kode_project) on a.kode = c.kode order by a.kode_project DESC")->result_array();
        $data['jawaban'] = [];  
        $data['soal'] = [];
        $data['modalproject'] = "";
        $data['modalskenario'] = "";

        if($this->input->post('div')){
            $dataex = explode("-", $this->input->post('div'));
            $data['skenario1'] = $this->db->get_where('data_skenario', ['id_skenario' => $dataex[1]])->row_array();
            $data['soal'] = $this->Proses_model->getSoal($dataex[1]);
            $data['jawaban'] = $this->Proses_model->getJawabanInkonsistensi($dataex[0], $dataex[1]);
            $data['project1'] = $this->db->get_where('data_project', ['id_project' => $dataex[0]])->row_array();
            $data['modalproject'] = $dataex[0];
            $data['modalskenario'] = $dataex[1];
        }

        if($this->uri->segment(3) and $this->uri->segment(4)){
            $data['skenario1'] = $this->db->get_where('data_skenario', ['id_skenario' => $this->uri->segment(4)])->row_array();
            $data['soal'] = $this->Proses_model->getSoal($this->uri->segment(4));
            $data['jawaban'] = $this->Proses_model->getJawabanInkonsistensi($this->uri->segment(3), $this->uri->segment(4));
            $data['project1'] = $this->db->get_where('data_project', ['id_project' => $this->uri->segment(3)])->row_array();
            $data['modalproject'] = $this->uri->segment(3);
            $data['modalskenario'] = $this->uri->segment(4);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('proses/cek5', $data); //cek2=antar kunjungan; cek3=antar soal; cek4=cek konsistensi dari database;
        $this->load->view('templates/footer'); 
    }

    public function editJawabanEquest($id){
        $data['judul'] = "Edit Jawaban Equest";
        $dataex = $this->Proses_model->editJawabanEquest($id);
        $data['jawaban'] = $dataex['jawaban'];
        $data['soal'] = $dataex['soal'];
        $data['validasi'] = $dataex['validasi'];
        $pro = $dataex['project'];
        $sek = $dataex['skenario'];
        $i=0;
        foreach($data['soal'] as $db){
            $this->form_validation->set_rules("$i", 'Kolom', 'required');
            $i++;
        }

        if($this->form_validation->run()==false){
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar');
            $this->load->view('proses/editJawabanEquest', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Proses_model->simpanEditJawabanEquest($id, $data['jawaban']);
            redirect("proses/inkonsistensi/$pro/$sek");
        }
    }

    public function status($id_jawaban, $id_skenario){
        $this->Proses_model->updatests($id_jawaban);
        redirect("proses/index/$id_skenario");
        
    }

    public function status2(){
        $arraysoal = [];
        $sek = $this->input->post('id_skenario');
        $p = $this->input->post('id_project');
        // var_dump($this->input->post('kode'));
        $arraykode = explode(",", $this->input->post('kode'));
        // var_dump($arraykode);
        
        $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $sek])->row_array();
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
        $id_pembuat = $pembuat['id_pembuat_equest'];
        $jawaban = $this->db->query("SELECT * from data_jawaban_equest where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek group by id_user")->result_array();

        foreach($soal as $sl => $u){
            array_push($arraysoal, $u['kode_soal']);
        }

        // var_dump(count($jawaban));
        // var_dump($arraysoal);

        foreach($jawaban as $jb => $ku){
            $kunjungan = $this->db->get_where('data_jawaban_equest', ['id_project' => $p, 'id_skenario' => $sek, 'id_pembuat_equest'=>$id_pembuat, 'id_user'=>$ku['id_user']])->result_array();
            $id_user = $ku['id_user'];
            // var_dump(count($kunjungan));
            //  echo "<br>";
            
            if(count($kunjungan)==2){
                var_dump("INI DUA");
                echo "<br>";
                $varequest = "";
                $arrayjawaban = [];
                $prefix = "array_";

                foreach($kunjungan as $it => $n){
                    array_push($arrayjawaban, $n['jawaban_equest']);
                }

                for($t=1; $t<=count($arrayjawaban); $t++){
                    ${$prefix . "$t"} = explode("|", $arrayjawaban[$t-1]);
                    // var_dump(${$prefix . "$t"});
                    // echo "<br>";
                }

                for($a=1; $a<=count($arraykode); $a++){
                    $nosoal = array_search($arraykode[$a-1], $arraysoal);
                    // var_dump(${$prefix . "$a"}[)

                    for($b=1; $b<=count($arrayjawaban)-1; $b++){
                        $c=$b+1;
                        if(${$prefix . "$b"}[$nosoal] != ${$prefix . "$c"}[$nosoal]){
                            var_dump("TIDAK KONSISTEN");
                            echo "<br>";
                            $varequest .= "$arraykode[$nosoal],";
                        }
                    }
                }
                // var_dump($varequest);
                if($varequest != ""){
                    $this->db->query("UPDATE data_jawaban_equest SET var_equest = '$varequest', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_user = $id_user");
                }
            }

            // if(count($kunjungan)==3){
            //     var_dump("INI TIGA");
            //     echo "<br>";
            // }

            if(count($kunjungan)==3){
                var_dump("INI TIGA");
                echo "<br>";

                $arrayjawaban = [];
                $prefix = "array_";
                $varequest = "";

                foreach($kunjungan as $it => $n){
                    array_push($arrayjawaban, $n['jawaban_equest']);
                }

                for($t=1; $t<=count($arrayjawaban); $t++){
                    ${$prefix . "$t"} = explode("|", $arrayjawaban[$t-1]);
                    // var_dump(${$prefix . "$t"});
                    // echo "<br>";
                }

                for($a=1; $a<=count($arraykode); $a++){
                    $nosoal1 = array_search($arraykode[$a-1], $arraysoal);
                    // var_dump(${$prefix . "$a"}[)

                    for($d=1; $d<count($arrayjawaban)-1; $d++){
                        $e=$d+1;
                        $f=$e+1;
                        // var_dump($d);
                        // echo "<br>";
                        // var_dump($e);
                        // echo "<br>";
                        // var_dump($f);
                        // echo "<br>";
                        if(${$prefix . "$d"}[$nosoal1] != ${$prefix . "$e"}[$nosoal1] or ${$prefix . "$d"}[$nosoal1] != ${$prefix . "$f"}[$nosoal1] or ${$prefix . "$e"}[$nosoal1] != ${$prefix . "$f"}[$nosoal1]){
                            var_dump("TIDAK KONSISTEN");
                            echo "<br>";
                            $varequest .= "$arraykode[$nosoal],";
                        }
                    }
                }
                if($varequest != ""){
                    $this->db->query("UPDATE data_jawaban_equest SET var_equest = '$varequest', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_user = $id_user");
                }
            }
            
        }


        redirect("proses/index/$p/$sek");
        // var_dump($arrayjawaban);
    }

    public function status3(){
        // var_dump($this->input->post('kode'));
        // echo "<br>";
        // var_dump($this->input->post('nilai'));
        // echo "<br>";
        // var_dump($this->input->post('kode'));
        // echo "<br>";
        // var_dump($this->input->post('nilai1'));
        // echo "<br>";
        $arraysoal = [];
        $sek = $this->input->post('id_skenario');
        $p = $this->input->post('id_project');
        
        $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $sek])->row_array();
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
        $id_pembuat = $pembuat['id_pembuat_equest'];
        $jawaban = $this->db->query("SELECT * from data_jawaban_equest where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek group by id_user")->result_array();
        $kunjungan = $this->db->get_where('data_jawaban_equest', ['id_project' => $p, 'id_skenario' => $sek, 'id_pembuat_equest'=>$id_pembuat])->result_array();

        foreach($soal as $sl => $u){
            array_push($arraysoal, $u['kode_soal']);
        }

        foreach($kunjungan as $kj => $nya){
            $arrayjawaban = explode("|", $nya['jawaban_equest']);
            // var_dump($arrayjawaban);
            // echo "<br>";
            $posisi = array_search($this->input->post('kode'), $arraysoal);
            $posisi1 = array_search($this->input->post('kode1'), $arraysoal);

            if($arrayjawaban[$posisi]==$this->input->post('nilai') and $arrayjawaban[$posisi1]==$this->input->post('nilai1')){

            } else {
                var_dump("TIDAK KONSISTEN");
                echo "<br>";
            }
        }
        // var_dump(count($kunjungan));

    }

     public function status4(){
        $arraysoal = [];
        $sek = $this->input->post('id_skenario');
        $p = $this->input->post('id_project');
        
        $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $sek])->row_array();
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
        $id_pembuat = $pembuat['id_pembuat_equest'];
        $jawaban = $this->db->query("SELECT * from data_jawaban_equest where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek group by id_user")->result_array();
        $kunjungan = $this->db->get_where('data_jawaban_equest', ['id_project' => $p, 'id_skenario' => $sek, 'id_pembuat_equest'=>$id_pembuat])->result_array();

        foreach($soal as $sl => $u){
            array_push($arraysoal, $u['kode_soal']);
        }

        foreach($kunjungan as $kj => $nya){
            $arrayjawaban = explode("|", $nya['jawaban_equest']);
            $posisi = array_search($this->input->post('kode'), $arraysoal);
            $posisi1 = array_search($this->input->post('kode1'), $arraysoal);

            if($arrayjawaban[$posisi]==$this->input->post('nilai') and $arrayjawaban[$posisi1]==$this->input->post('nilai1')){
                var_dump("TIDAK KONSISTEN");
                echo "<br>";
            } 
        }

    }

    public function status5(){
        $arraysoal = [];
        $sek = $this->input->post('id_skenario');
        $p = $this->input->post('id_project');
        
        $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $sek])->row_array();
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
        $id_pembuat = $pembuat['id_pembuat_equest'];
        $jawaban = $this->db->query("SELECT * from data_jawaban_equest where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek group by id_user")->result_array();
        $kunjungan = $this->db->get_where('data_jawaban_equest', ['id_project' => $p, 'id_skenario' => $sek, 'id_pembuat_equest'=>$id_pembuat])->result_array();

        foreach($soal as $sl => $u){
            array_push($arraysoal, $u['kode_soal']);
        }

        foreach($kunjungan as $kj => $nya){
            $arrayjawaban = explode("|", $nya['jawaban_equest']);
            $posisi = array_search($this->input->post('kode'), $arraysoal);

            if($arrayjawaban[$posisi]==$this->input->post('nilai')){
                var_dump("TIDAK KONSISTEN");
                echo "<br>";
            } 
        }
    }

    public function status6(){
        $sek = $this->input->post('id_skenario');
        $p = $this->input->post('id_project');
        $arraysoal = [];
        // $arrayhapuskata= ["Menit", "MENIT", "menit", "Detik", "DETIK", "detik", " "];
        // var_dump($this->input->post('kode'));
        // echo "<br>";
        // var_dump($this->input->post('nilai'));
        // echo "<br>";
        // var_dump($this->input->post('kode1'));
        // echo "<br>";
        // var_dump($this->input->post('nilai1'));
        // echo "<br>";

        // $num ="23menit  22 ";
        // $num1=str_replace("menit",".",$num);
        // $num2=str_replace(" ","",$num1);
        // $soal = "88";

        $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $sek])->row_array();
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
        $id_pembuat = $pembuat['id_pembuat_equest'];
        $jawaban = $this->db->query("SELECT * from data_jawaban_equest where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek group by id_user")->result_array();
        $kunjungan = $this->db->get_where('data_jawaban_equest', ['id_project' => $p, 'id_skenario' => $sek, 'id_pembuat_equest'=>$id_pembuat])->result_array();

        foreach($soal as $sl => $u){
            array_push($arraysoal, $u['kode_soal']);
        }

        foreach($kunjungan as $kj => $nya){
            $arrayjawaban = explode("|", $nya['jawaban_equest']);
            $posisi = array_search($this->input->post('kode'), $arraysoal);
            $posisi1 = array_search($this->input->post('kode1'), $arraysoal);

            if($arrayjawaban[$posisi]==$this->input->post('nilai')){
                // $num = $arrayjawaban[$posisi1];
                // $num1=str_replace("menit",".",$num);
                $num1=str_replace("menit",".", strtolower($arrayjawaban[$posisi1]));
                $num2=str_replace(" ","",$num1);
                // var_dump($arrayjawaban[$posisi1]);
                // var_dump("TIDAK KONSISTEN");
                // echo "<br>";
                if(str_replace("detik","",$num2)>="2.00" and str_replace("detik","",$num2)<="4.59"){
                // if(str_replace("detik","",$num2)>="10.58"){
                    var_dump($nya['id_jawaban']);
                    var_dump("true");
                    echo "<br>";
                }
                // if(str_replace("detik","",$num2)>="10.58"){
                //     var_dump($nya['id_jawaban']);
                //     var_dump("true");
                //     echo "<br>";
                // }
            } 
        }


        // if("88" == $this->input->post('nilai')){
        //     if($num2<="2.59"){
        //         var_dump("true");
        //     }
        // }
    }

    public function semuaSts(){
        var_dump($this->input->post('id_project'));
        echo "<br>";
        var_dump($this->input->post('id_skenario'));
        echo "<br>";

        $arraysoal = [];
        $arraykode = [];
        $arraykode2 = [];
        $arrayjbkode2 = [];
        $arraykode31 = [];
        $arraykode32 = [];
        $arrayjbkode31 = [];
        $arrayjbkode32 = [];
        $arraykode41 = [];
        $arraykode42 = [];
        $arrayjbkode41 = [];
        $arrayjbkode42 = [];
        $arraykode51 = [];
        $arraykode52 = [];
        $arrayjbkode51 = [];
        $arrayjbkode52 = [];
        $arrayjawaban2 = [];
        $sek = $this->input->post('id_skenario');
        $p = $this->input->post('id_project');
        $cekkonsistensi = $this->db->get_where('data_cek', ['id_skenario' => $sek, 'id_project' => $p, 'jenis_cek !=' => 1])->result_array();
        $cekkonsistensihanyajika = $this->db->get_where('data_cek', ['id_skenario' => $sek, 'id_project' => $p, 'jenis_cek' => 2])->result_array();
        $cekkonsistensijikamaka= $this->db->get_where('data_cek', ['id_skenario' => $sek, 'id_project' => $p, 'jenis_cek' => 3])->result_array();
        $cekkonsistensijikatapi= $this->db->get_where('data_cek', ['id_skenario' => $sek, 'id_project' => $p, 'jenis_cek' => 4])->result_array();
        $cekkonsistensiwaktu= $this->db->get_where('data_cek', ['id_skenario' => $sek, 'id_project' => $p, 'jenis_cek' => 5])->result_array();
        $cekkonsistensiantarkunjungan = $this->db->get_where('data_cek', ['id_skenario' => $sek, 'id_project' => $p, 'jenis_cek' => 1])->result_array();

        // var_dump($cekkonsistensiantarsoal); die;

        $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $sek])->row_array();
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
        $id_pembuat = $pembuat['id_pembuat_equest'];
        $jawaban = $this->db->query("SELECT * from data_jawaban_equest where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek group by id_user")->result_array();
        $kunjungan = $this->db->get_where('data_jawaban_equest', ['id_project' => $p, 'id_skenario' => $sek, 'id_pembuat_equest'=>$id_pembuat])->result_array();

        // var_dump($cekkonsistensi);
        // echo "<br>";

        foreach($soal as $sl => $u){
            array_push($arraysoal, $u['kode_soal']);
        }

        foreach($cekkonsistensiantarkunjungan as $ckk => $ck){
            array_push($arraykode, $ck['kode_cek_1']);
        }

        // ANTAR KUNJUNGAN
        foreach($jawaban as $jb => $ku){
            $kunjungansatu = $this->db->get_where('data_jawaban_equest', ['id_project' => $p, 'id_skenario' => $sek, 'id_pembuat_equest'=>$id_pembuat, 'id_user'=>$ku['id_user']])->result_array();
            $id_user1 = $ku['id_user'];
            
            if(count($kunjungansatu)==2){
                // var_dump("INI DUA");
                // echo "<br>";
                $varequest1 = "";
                $arrayjawaban1 = [];
                $prefix1 = "array_";

                foreach($kunjungansatu as $it => $n){
                    array_push($arrayjawaban1, $n['jawaban_equest']);
                }

                for($t=1; $t<=count($arrayjawaban1); $t++){
                    ${$prefix1 . "$t"} = explode("|", $arrayjawaban1[$t-1]);
                }

                for($a=1; $a<=count($arraykode); $a++){
                    $nosoal1 = array_search($arraykode[$a-1], $arraysoal);
                    for($b=1; $b<=count($arrayjawaban1)-1; $b++){
                        $c=$b+1;
                        if(${$prefix1 . "$b"}[$nosoal1] != ${$prefix1 . "$c"}[$nosoal1]){
                            // var_dump("TIDAK KONSISTEN");
                            // echo "<br>";
                            $varequest1 .= "$arraykode[$nosoal1],";
                        }
                    }
                }
                if($varequest1 != ""){
                    $this->db->query("UPDATE data_jawaban_equest SET var_equest = '$varequest1', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_user = $id_user1");
                }else {
                    $this->db->query("UPDATE data_jawaban_equest SET var_equest = '', sts = 0 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
                }
            }

            if(count($kunjungansatu)==3){
                // var_dump("INI TIGA");
                // echo "<br>";

                $arrayjawaban1 = [];
                $prefix1 = "array_";
                $varequest1 ="";

                foreach($kunjungansatu as $it => $n){
                    array_push($arrayjawaban1, $n['jawaban_equest']);
                }

                for($t=1; $t<=count($arrayjawaban1); $t++){
                    ${$prefix1 . "$t"} = explode("|", $arrayjawaban1[$t-1]);
                }

                for($a=1; $a<=count($arraykode); $a++){
                    $nosoal1 = array_search($arraykode[$a-1], $arraysoal);

                    for($d=1; $d<count($arrayjawaban1)-1; $d++){
                        $e=$d+1;
                        $f=$e+1;
                        if(${$prefix1 . "$d"}[$nosoal1] != ${$prefix1 . "$e"}[$nosoal1] or ${$prefix1 . "$d"}[$nosoal1] != ${$prefix1 . "$f"}[$nosoal1] or ${$prefix1 . "$e"}[$nosoal1] != ${$prefix1 . "$f"}[$nosoal1]){
                            // var_dump("TIDAK KONSISTEN");
                            // echo "<br>";
                            $varequest1 .= "$arraykode[$nosoal1],";
                            // var_dump($varequest1);
                            // echo "<br>";
                        }
                    }
                }
                if($varequest1 != "" ){
                    $this->db->query("UPDATE data_jawaban_equest SET var_equest = '$varequest1', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_user = $id_user1");
                }else {
                    $this->db->query("UPDATE data_jawaban_equest SET var_equest = '', sts = 0 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
                }
                
            }
        }
        // AKHIR ANTAR KUNJUNGAN

        // KONSISTENSI ANTAR SOAL
        foreach($cekkonsistensihanyajika as $ckhk => $hk){
            array_push($arraykode2, $hk['kode_cek_1']);
            array_push($arrayjbkode2, $hk['nilai_cek_1']);
        }

        foreach($cekkonsistensijikamaka as $ckjm => $jm){
            array_push($arraykode31, $jm['kode_cek_1']);
            array_push($arraykode32, $jm['kode_cek_2']);
            array_push($arrayjbkode31, $jm['nilai_cek_1']);
            array_push($arrayjbkode32, $jm['nilai_cek_2']);
        }

        foreach($cekkonsistensijikatapi as $ckjt => $jt){
            array_push($arraykode41, $jt['kode_cek_1']);
            array_push($arraykode42, $jt['kode_cek_2']);
            array_push($arrayjbkode41, $jt['nilai_cek_1']);
            array_push($arrayjbkode42, $jt['nilai_cek_2']);
        }

        foreach($cekkonsistensiwaktu as $ckw => $wak){
            array_push($arraykode51, $wak['kode_cek_1']);
            array_push($arraykode52, $wak['kode_cek_2']);
            array_push($arrayjbkode51, $wak['nilai_cek_1']);
            array_push($arrayjbkode52, $wak['nilai_cek_2']);
        }

        $jb = "arrayjawaban_";
        $x = 1;
        foreach($kunjungan as $kun => $jk){
            array_push($arrayjawaban2, $jk['jawaban_equest']);
            ${$jb . "$x"} = explode("|", $arrayjawaban2[$x-1]);
            $x++;
        }
        // var_dump($arrayjawaban_1); die;

        $angel = 1;
        foreach ($kunjungan as $kunju => $kun) {
            $varequest2 = "";
            $varequest3 = "";
            $varequest4 = "";
            $varequest5 = "";
            $id_user1 = $kun['id_jawaban'];

            // INI KODE HANYA JIKA (KODE 2)
            for($a=0; $a<count($arraykode2); $a++){
                $posisi = array_search($arraykode2[$a], $arraysoal);
                $cari2 = ${$jb . "$angel"}[$posisi];
                $cari21 = $arrayjbkode2[$a];
                // if(${$jb . "$angel"}[$posisi] == $arrayjbkode2[$a]){ IF INI BISA DIGUNAKAN JUGA
                // if(preg_match("/\b$cari2\b/", $arrayjbkode2[$a])){ IF INI BISA DIGUNAKAN JUGA
                if(preg_match("/\b$cari21\b/", $cari2)){
                    var_dump("TIDAK KONSISTEN");
                    echo "<br>";
                    $varequest2 .= "$arraykode2[$a],";
                }
            }  

            if($varequest2 != ""){
                // var_dump($varequest2);  
                $this->db->query("UPDATE data_jawaban_equest SET var_equest2 = '$varequest2', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
            } else {
                $this->db->query("UPDATE data_jawaban_equest SET var_equest2 = '', sts = 0 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
            }
            // AKHIR KODE HANYA JIKA (KODE 2)

            // INI KODE JIKA MAKA (KODE 3)
            for($b=0; $b<count($arraykode31); $b++){
                $posisi31 = array_search($arraykode31[$b], $arraysoal);
                $posisi32 = array_search($arraykode32[$b], $arraysoal);
                $cari3 = ${$jb . "$angel"}[$posisi31];
                $cari31 = $arrayjbkode31[$b];
                // if((${$jb . "$angel"}[$posisi31] == $arrayjbkode31[$b] and ${$jb . "$angel"}[$posisi32] == $arrayjbkode32[$b])){
                // } else {
                //     var_dump("TIDAK KONSISTEN");
                //     echo "<br>";
                //     $varequest3 .= "$arraykode31[$b],$arraykode32[$b]";
                // }
                // if((${$jb . "$angel"}[$posisi31] == $arrayjbkode31[$b] and ${$jb . "$angel"}[$posisi32] != $arrayjbkode32[$b])){ IF INI BISA DIGUNAKAN JUGA
                    // if(preg_match("/\b$cari3\b/", $arrayjbkode31[$b]) and ${$jb . "$angel"}[$posisi32] != $arrayjbkode32[$b]){ IF INI BISA DIGUNAKAN JUGA
                    if(preg_match("/\b$cari31\b/", $cari3) and ${$jb . "$angel"}[$posisi32] != $arrayjbkode32[$b]){
                    // var_dump("TIDAK KONSISTEN");
                    // echo "<br>";
                    $varequest3 .= "$arraykode31[$b],$arraykode32[$b],";
                } 
            }

            if($varequest3 != ""){
                var_dump($varequest3);  
                $this->db->query("UPDATE data_jawaban_equest SET var_equest3 = '$varequest3', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
            }else {
                $this->db->query("UPDATE data_jawaban_equest SET var_equest3 = '', sts = 0 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
            }
            // AKHIR KODE JIKA MAKA (KODE 3)

            // INI KODE JIKA TAPI (KODE 4)
            for($c=0; $c<count($arraykode41); $c++){
                $posisi41 = array_search($arraykode41[$c], $arraysoal);
                $posisi42 = array_search($arraykode42[$c], $arraysoal);
                $cari41 = ${$jb . "$angel"}[$posisi42];
                $cari42 = ${$jb . "$angel"}[$posisi41];
                $cari411 = $arrayjbkode42[$c];
                $cari421 =  $arrayjbkode41[$c];
                // if((${$jb . "$angel"}[$posisi41] == $arrayjbkode41[$c] and ${$jb . "$angel"}[$posisi42] == $arrayjbkode42[$c])){
                //     var_dump("TIDAK KONSISTEN");
                //     echo "<br>";
                //     $varequest4 .= "$arraykode41[$c],$arraykode42[$c],";
                // } 
                // if(${$jb . "$angel"}[$posisi41] == $arrayjbkode41[$c] ){
                //     var_dump("TIDAK KONSISTEN");
                //     echo "<br>";
                //     var_dump($id_user1);
                //     echo "<br>";
                //     // $varequest4 .= "$arraykode41[$c],$arraykode42[$c],";
                // } 
                // if(${$jb . "$angel"}[$posisi42] == $arrayjbkode42[$c] and ${$jb . "$angel"}[$posisi41] == $arrayjbkode41[$c]){ IF INI BISA DIGUNAKAN JUGA
                // if(preg_match("/\b$cari41\b/", $arrayjbkode42[$c]) and preg_match("/\b$cari42\b/", $arrayjbkode41[$c])){ IF INI BISA DIGUNAKAN JUGA
                if(preg_match("/\b$cari411\b/", $cari41) and preg_match("/\b$cari421\b/",$cari42)){
                    // var_dump("TIDAK KONSISTEN");
                    // echo "<br>";
                    // var_dump($id_user1);
                    // echo "<br>";
                    $varequest4 .= "$arraykode41[$c],$arraykode42[$c],";
                } 
            }

            if($varequest4 != ""){
                // var_dump($varequest4);  
                $this->db->query("UPDATE data_jawaban_equest SET var_equest4 = '$varequest4', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
            } else {
                $this->db->query("UPDATE data_jawaban_equest SET var_equest4 = '', sts = 0 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
            }
            // AKHIR KODE JIKA TAPI (KODE 4)

            // INI KODE WAKTU (KODE 5)
                for($d=0; $d<count($arraykode51); $d++){
                    $posisi51 = array_search($arraykode51[$d], $arraysoal);
                    $posisi52 = array_search($arraykode52[$d], $arraysoal);
                    $datawak = explode("-",$arrayjbkode52[$d]);
                    // var_dump($datawak[0]);
                    // echo "<br>";
                    // var_dump($datawak[1]);
                    // echo "<br>";
                    $num1=str_replace("menit",".", strtolower(${$jb . "$angel"}[$posisi52]));
                    $num2=str_replace(" ","",$num1);
                    // var_dump(str_replace("detik","",$num2));
                    // echo "<br>";
                    // var_dump(${$jb . "$angel"}[$posisi51]);
                    // echo "<br>";

                    if(${$jb . "$angel"}[$posisi51] != $arrayjbkode51[$d] and str_replace("detik","",$num2) >= $datawak[0]  and str_replace("detik","",$num2) <= $datawak[1]){
                        // var_dump($id_user1);
                        // echo "<br>";
                        // var_dump("MASUK SISNI WAY");
                        // echo "<br>";
                        $varequest5 .= "$arraykode51[$c],$arraykode52[$c],";
                    }

                    if($varequest5 != ""){
                        // var_dump($varequest5);  
                        // echo "<br>";
                        $this->db->query("UPDATE data_jawaban_equest SET var_equest5 = '$varequest5', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
                    }else {
                        $this->db->query("UPDATE data_jawaban_equest SET var_equest5 = '', sts = 0 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
                    }

                    // if((${$jb . "$angel"}[$posisi51] == $arrayjbkode51[$d]) and (str_replace("detik","",$num2) >= $datawak[0] and str_replace("detik","",$num2) <= $datawak[1])){
                    //     // $varequest4 .= "$arraykode41[$c],$arraykode42[$c],";
                    // } else {
                    //     var_dump("TIDAK KONSISTEN");
                    //     echo "<br>";
                    //     var_dump($id_user1);
                    //     echo "<br>";
                    // }
                }
            // AKHIR KODE WAKTU (KODE 5)


            $angel++;
        }
        // AKHIR KONSISTENSI ANTAR SOAL

        // NOTE NOTE INKONSISTEN
        foreach($kunjungan as $jwb => $rt){
            $ket_cek = "";
            if($rt['var_equest'] != ""){
                $data1 = explode(",",$rt['var_equest']);
                for ($i=0; $i < count($data1)-1; $i++) { 
                    $cekketsoal = $this->db->get_where('data_cek', ['jenis_cek' => 1, 'id_project' =>$p, 'id_skenario'=>$sek, 'kode_cek_1' => $data1[$i]])->row_array();
                    $ket_cek .= $cekketsoal['id_cek'].",";
                }
            }

            if($rt['var_equest2'] != ""){
                $data2 = explode(",",$rt['var_equest2']);
                for ($j=0; $j < count($data2)-1; $j++) { 
                    $cekketsoal2 = $this->db->get_where('data_cek', ['jenis_cek' => 2, 'id_project' =>$p, 'id_skenario'=>$sek, 'kode_cek_1' => $data2[$j]])->row_array();
                    $ket_cek .= $cekketsoal2['id_cek'].",";
                }
                // var_dump($ket_cek); die;
            }

            if($rt['var_equest3'] != ""){
                $data3 = explode(",",$rt['var_equest3']);
                for ($k=0; $k < count($data3)-1; $k++) { 
                    $cekketsoal3 = $this->db->get_where('data_cek', ['jenis_cek' => 3, 'id_project' =>$p, 'id_skenario'=>$sek, 'kode_cek_1' => $data3[$k]])->row_array();
                    if($cekketsoal3['id_cek']!=""){
                        $ket_cek .= $cekketsoal3['id_cek'].",";
                    }
                }
            }

            if($rt['var_equest4'] != ""){
                $data4 = explode(",",$rt['var_equest4']);
                for ($l=0; $l < count($data4)-1; $l++) { 
                    $cekketsoal4 = $this->db->get_where('data_cek', ['jenis_cek' => 4, 'id_project' =>$p, 'id_skenario'=>$sek, 'kode_cek_1' => $data4[$l]])->row_array();
                    if($cekketsoal4['id_cek']!=""){
                        $ket_cek .= $cekketsoal4['id_cek'].",";
                    }
                }
            }

            if($rt['var_equest5'] != ""){
                $data5 = explode(",",$rt['var_equest5']);
                for ($m=0; $m < count($data5)-1; $m++) { 
                    $cekketsoal5 = $this->db->get_where('data_cek', ['jenis_cek' => 5, 'id_project' =>$p, 'id_skenario'=>$sek, 'kode_cek_1' => $data5[$m]])->row_array();
                    if($cekketsoal5['id_cek']!=""){
                        $ket_cek .= $cekketsoal5['id_cek'].",";
                    }
                }
            }

            $update = [
                'ket_cek' => $ket_cek,
            ];
            $this->db->where('id_jawaban', $rt['id_jawaban']);
            $this->db->update('data_jawaban_equest', $update);
        }
        // AKHIR NOTE NOTE INKONSISTEN

        // UNTUK MENAMPILKAN NOTENOTE
        // foreach($kunjungan as $kjgn => $kj){
            //     $datacek = explode(",", $kj['ket_cek']);
            //     for ($p=0; $p < count($datacek)-1; $p++) { 
                //         $ketcek = $this->db->get_where('data_cek', ['id_cek' => $datacek[$p]])->row_array();
                //         var_dump($ketcek['ket_cek']);
        //         echo "<br>";
        //     }
        //     echo "<br>";
        //     echo "<br>";
        // }
        // AKHIR UNTUK MENAMPILKAN NOTENOTE

        redirect("proses/index/$p/$sek");

        // HANYA JIKA
        // foreach($cekkonsistensihanyajika as $ckhj => $hj){
        //     foreach($kunjungan as $kj => $nya){
        //         $arrayjawaban = explode("|", $nya['jawaban_equest']);
        //         $posisi = array_search($hj['kode_cek_1'], $arraysoal);
        //         $id_user1 = $nya['id_user'];
        //         $varequest2 = $nya['var_equest2'];
        //         // var_dump($varequest2);
        //         $t = $nya['id_jawaban'];
        //         if($arrayjawaban[$posisi]==$hj['nilai_cek_1']){
                    
        //             echo "<br>";
        //             $varequest2 .= $hj['kode_cek_1'];
        //             // $varequest8 = $hj['kode_cek_1'];
        //             // var_dump($varequest8);
        //             // echo "<br>";
        //         } 
        //         // var_dump(${$prefix . "$t"});
        //         // echo "<br>";
        //         // $this->db->query("UPDATE data_jawaban_equest SET var_equest2 = '$varequest2', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_user = $id_user1");
        //         // var_dump("TIDAK KONSISTEN");
        //      }
        //     // foreach($kunjungan as $kj => $nya){
        //     //     foreach($kunjungan as $kj => $nya){
        //     //         $arrayjawaban = explode("|", $nya['jawaban_equest']);
        //     //         $posisi = array_search($hj['kode_cek_1'], $arraysoal);
        //     //         for($iway=1;$iway<=count($arrayjawaban); $iway++){

        //     //         }
        //     //     }
        //     // }
        // } 
        // AKHIR HANYA JIKA

        // HANYA JIKA
        // foreach($cekkonsistensihanyajika as $ckhk => $hk){
        //     array_push($arraykode2, $hk['kode_cek_1']);
        //     array_push($arrayjbkode2, $hk['nilai_cek_1']);
        // }

        // $jb = "arrayjawaban_";
        // $x = 1;
        // foreach($kunjungan as $kun => $jk){
        //     array_push($arrayjawaban2, $jk['jawaban_equest']);
        //     ${$jb . "$x"} = explode("|", $arrayjawaban2[$x-1]);
        //     // var_dump(${$jb . "$x"});
        //     // echo "<br>";
        //     $x++;
        // }

        // $pos = "posisi_";
        
        // // for($r=0; $r<count($arraykode2); $r++){
        //     // $posisi = array_search($arraykode2[$r], $arraysoal);
        //     $y = 1;
            
        //     foreach($kunjungan as $kun => $o){
        //         $posisi = array_search($arraykode2[$y-1], $arraysoal);
        //         $varequest2 = $o['var_equest2'];
        //         // $varequest2 = "9,".$o['var_equest2'];
        //         $id_user1 = $o['id_jawaban'];
        //         // for($z=1; $z<=count(${$jb . "$y"}); $z++){
        //         //     if(${$jb . "$y"}[$posisi] == $arrayjbkode2[$r]){
        //         //         var_dump("TIDAK KONSISTEN");
        //         //         echo "<br>";
        //         //         $varequest2 .= "$arraykode2[$r],";
        //         //     }
        //         // }
        //         if(${$jb . "$y"}[$posisi] == $arrayjbkode2[$y-1]){
        //             var_dump("TIDAK KONSISTEN");
        //             echo "<br>";
        //             // $varequest2 .= "$arraykode2[$r],";
        //             //  $this->db->query("UPDATE data_jawaban_equest SET var_equest2 = '$varequest2', sts = 3 where id_pembuat_equest = $id_pembuat and id_project = $p and id_skenario = $sek and id_jawaban = $id_user1");
        //         }
        //         // ${$pos . "$r"} = array_search($arraykode2[$r], $arraysoal);
        //         // var_dump(${$pos . "$r"});
        //         // var_dump($posisi);
        //         // $i++;
        //         if($varequest2 != ""){
        //             var_dump($varequest2);
        //             echo "<br>";
        //         }
        //         var_dump($varequest2);
        //         $y++;
        //     }
        // // }

        // var_dump($arraykode2);
        // echo "<br>";
        // var_dump($arrayjbkode2);
        // echo "<br>";
        // // var_dump($);
        // die;
        //AKHIR HANYA JIKA

        




        // var_dump($arraykode); die;

        

        // foreach($cekkonsistensi as $cek => $ceku){
            
        //     if($ceku['jenis_cek'] == 2){
        //          foreach($kunjungan as $kj => $nya){
        //             //  $d = $nya['id_user'];
        //             //  ${$prefix1 . "$d"} = ""
        //             $varequest2 = $nya['var_equest'];
                    
        //             // $varequest2 = $nya['var_equest'];
        //             $arrayjawaban = explode("|", $nya['jawaban_equest']);
        //             $posisi = array_search($ceku['kode_cek_1'], $arraysoal);
        //             $id_user1 = $nya['id_user'];
        //             // $prefix1 = "array_";
        //             if($arrayjawaban[$posisi]==$ceku['nilai_cek_1']){
        //                 // var_dump($ceku['kode_cek_1']);
        //                 // echo "<br>";
        //                 // var_dump("TIDAK KONSISTEN");
        //                 // echo "<br>";
        //                 $iyu = $ceku['kode_cek_1'];
        //                 $varequest2 .= "$iyu,";
        //                 // ${$prefix1 . "$d"}
        //                 // $varequest21 = $nya['var_equest']."$varequest2";
        //                 // var_dump($varequest2);
        //                 // echo "<br>";
        //                 var_dump($varequest2);
        //                 // $varequest2 .= "$iyu,";
    //                  
        //             } 
        //         }
        //     }

        // }

        // redirect("proses/index/$p/$sek");
    }

    public function buatkonsistensi(){
        $data['judul'] = "Form Pembuatan Konsistensi";
        $data['skenario'] = $this->Proses_model->getSkenarioKunjungan();
        $data['datacek'] = $this->Proses_model->getDataCek();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('proses/buatkonsistensi', $data);
        $this->load->view('templates/footer');
    }

    public function buatkonsistensi2(){
        // var_dump($this->input->post('project'));
        $dataex = explode("-", $this->input->post('project'));
        // var_dump($dataex); die;
        $data['project'] = $this->Proses_model->getProjectById($dataex[0]);
        $data['skenario'] = $this->Proses_model->getSkenarioById($dataex[1]);
        // var_dump($data['skenario']); die;
        $data['judul'] = "Form Pembuatan Konsistensi";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('proses/buatkonsistensi2', $data);
        $this->load->view('templates/footer');
    }

    public function simpankonsistensi(){
        $this->Proses_model->simpankonsistensi($this->input->post('id_project'),$this->input->post('id_skenario'));
        redirect('proses/buatkonsistensi');
    }

    public function hapuskosistensi($pro, $sek){
        $this->Proses_model->hapuskonsistensi($pro, $sek);
        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Konsistensi telah <strong>dihapus!</strong>.
                </div>');

        redirect('proses/buatkonsistensi');
    }

    public function editkonsistensi($pro, $sek){
        // var_dump($pro);
        // var_dump($sek);
        // die;
        $data['project'] = $this->db->get_where('data_project', ['id_project' => $pro])->row_array();
        $data['skenario'] = $this->db->get_where('data_skenario', ['id_skenario' => $sek])->row_array();
        $data['datacek'] = $this->Proses_model->getDataCekById($pro, $sek);
        $data['judul'] = "Ubah Data Konsistensi";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('proses/ubahkonsistesi', $data);
        $this->load->view('templates/footer');
    }

    public function hapuskosistensibyid($id){
        $this->Proses_model->hapuskosistensibyid($id);
        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Data Konsistensi telah <strong>dihapus!</strong>.
                </div>');

        redirect('proses/buatkonsistensi');
    }

    public function kolom(){
        $data['fields'] = [];
        $data['isifields'] = [];

        if($this->uri->segment(3)){
            $data['fields'] = $this->Proses_model->getCoulom();
            $data['isifields'] = $this->Proses_model->getisiCoulom();
            //  var_dump($data['isifields']); die;
        }

        $data['judul'] = "Proses Kolom";
        $data['project'] = $this->db->get('data_project')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('proses/kolom', $data);
        $this->load->view('templates/footer');
    }

    public function buatkolom(){
        // HAPUS TABEL DULU
        // $tabel = mysqli_query('select 1 from `data_kolom` LIMIT 1'); //$this->db->get('data_kolom');
        // if($tabel !== FALSE){
        //     $this->db->query("DROP TABLE data_kolom;");
        // }
        // if($this->db->query("DESCRIBE `data_kolom`")){
        //     $this->db->query("DROP TABLE data_kolom;");
        // }
           $table = "tbl_performence";
           $result = $this->db->query("SHOW TABLES LIKE '{$table}'")->num_rows();
            if( $result == 1 ){
                   $this->db->query("DROP TABLE tbl_performence;");
            }

        // BUAT TABEL DULU
        $this->db->query("CREATE TABLE tbl_performence (id int NOT NULL AUTO_INCREMENT, kode_project varchar(10), kode_kunjungan varchar(10), kode_cabang varchar(10), kode_shp varchar(50),  PRIMARY KEY (id));");

        $skenariokunjunngan = $this->db->get_where('data_skenario_kunjungan', ['id_project' => $this->input->post('project')])->result_array();
        $kode_project = $this->db->get_where('data_project', ['id_project' => $this->input->post('project')])->row_array();
        $kodeproject = $kode_project['kode_project'];
        $query = "ALTER TABLE tbl_performence ";
        $h = 1;
        foreach($skenariokunjunngan as $sk => $ku){
            $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $ku['id_skenario']])->row_array();
            $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();

            foreach($soal as $sl => $ny){
                $field = $ny['kode_soal'];
                $query .= "ADD $field text, ";
                var_dump($ny['kode_soal']);
                echo "<br>";
            }
        }
        $koma = strrpos($query, ",");
        $query = substr($query,0, $koma);
        $query .= ";";
        var_dump($query);
        echo "<br>";
        $this->db->query($query); //INSERT KOLOM

        //  foreach($skenariokunjunngan as $sk => $ku){
            // $arrayjawaban = [];
            
            $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $ku['id_skenario']])->row_array();
            $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
            // $jawaban = $this->db->get_where('data_jawaban_equest', ['id_project' => $this->input->post('project'), 'id_skenario' => $ku['id_skenario'], 'id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
            $pro = $this->input->post('project');
            $sek = $ku['id_skenario'];
            $idp = $pembuat['id_pembuat_equest'];

            // $allJawaban = $this->db->get_where('data_jawaban_equest', ['id_project' => $this->input->post('project')])->result_array();
            $jawaban = $this->db->query("SELECT * from data_jawaban_equest where id_project = $pro group by id_kunjungan, id_user order by id_user ASC, id_kunjungan ASC")->result_array();
            // $query = "INSERT INTO tbl_performence (";

            // foreach ($jawaban as $jb => $u){
            //     array_push($arrayjawaban, $u['jawaban_equest']);
            // }

            
            foreach ($jawaban as $jb => $u){
                $shp = $u['id_user'];
                $kunjungan = $u['id_kunjungan'];
                $cabang = $u['kode_cabang'];
                $r = 1;
                $ri = 0;
                $riw = 1;

                // $ceksudahadaataubelum = $this->db->get_where('tbl_performence', ['kode_project' => $kodeproject, 'kode_kunjungan' => $kunjungan, 'kode_shp' => $shp])->num_rows();

                // if($ceksudahadaataubelum == 1){
                //     $querysimpan = "UPDATE tbl_performence SET ";
                //     $datajawaban = explode("|", $arrayjawaban[$ri]);
                //     foreach($soal as $sl => $ny){
                //             $jwb = str_replace("#@!","",$datajawaban[$ri]);
                //             $querysimpan .= $ny['kode_soal'];
                //             $querysimpan .= "= '$jwb'";
                //             if($r != count($soal)){
                //                 $querysimpan .= ", ";
                //             } else {
                //                 $querysimpan .= "WHERE kode_project = '$kodeproject' and kode_kunjungan = '$kunjungan' and kode_shp = '$shp';";
                //             }
                //             $r++; $ri++;
                //     }
                // } else {
                    $querysimpan = "INSERT INTO tbl_performence ( kode_project, kode_shp, kode_kunjungan, kode_cabang ";
                    // $datajawaban = explode("|", $arrayjawaban[$ri]);
                    // foreach($soal as $sl => $ny){
                    //         $querysimpan .= $ny['kode_soal'];
                    //         if($r != count($soal)){
                    //             $querysimpan .= ", ";
                    //         } else {
                                $querysimpan .= ") VALUES (";
                    //         }
                    //         $r++;
                    // }

                    $querysimpan .= "'$kodeproject', '$shp', '$kunjungan', '$cabang'); ";

                    // foreach($soal as $sl => $ny){
                    //     $jwb = str_replace("#@!","",$datajawaban[$ri]);
                    //     $querysimpan .= "'$jwb'";
                    //     if($riw != count($soal)){
                    //         $querysimpan .= ", ";
                    //     } else {
                    //         $querysimpan .= "); ";
                    //     }

                    //     $riw++; $ri++;
                    // }
                // }
                

               
                // var_dump($querysimpan);
                // echo "<br>";
                $this->db->query($querysimpan); //INSERT RECORD KUNJUNGAN
            }

            foreach($skenariokunjunngan as $sk => $ku){
                $arrayjawaban = [];
            
                $pembuat = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $ku['id_skenario']])->row_array();
                $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();
                $allJawaban = $this->db->get_where('data_jawaban_equest', ['id_project' => $this->input->post('project'), 'id_skenario' => $ku['id_skenario'], 'id_pembuat_equest' => $pembuat['id_pembuat_equest']])->result_array();

                foreach ($allJawaban as $jb => $u){
                    array_push($arrayjawaban, $u['jawaban_equest']);
                }
                
                
                $riw = 0;
                foreach($allJawaban as $ajwb => $jwb){
                    $queryupdate = "UPDATE tbl_performence SET ";
                    $shp = $jwb['id_user'];
                    $kunjungan = $jwb['id_kunjungan'];
                    $r = 1;
                    $ri = 0;
                    
                    $datajawaban = explode("|", $arrayjawaban[$riw]);
                    // var_dump($jwb['id_jawaban']);
                    var_dump($datajawaban);
                    echo "<br>";
                    foreach($soal as $sl => $ny){
                            $jwb = str_replace("#@!","",$datajawaban[$ri]);
                            $queryupdate .= $ny['kode_soal'];
                            $queryupdate .= "= '$jwb'";
                            if($r != count($soal)){
                                $queryupdate .= ", ";
                            } else {
                                $queryupdate .= "WHERE kode_project = '$kodeproject' and kode_kunjungan = '$kunjungan' and kode_shp = '$shp';";
                            }
                            $r++; $ri++;
                        }
                        $riw++;
                        $this->db->query($queryupdate); //INSERT JAWABAN     
                }

                
            }

        // }
            
            redirect('proses/kolom/1');
    }

    public function cetak(){
        $data['fields'] = $this->Proses_model->getCoulom();
        $data['isifields'] = $this->Proses_model->getisiCoulom();
        $this->load->view('proses/cetak', $data);
    }

    public function cetakkolom(){
        $this->load->view('proses/cetakkolom', $data);
    }

    public function cetakkonsistensi(){
        $pro = $this->input->post('id_project');
        $sek = $this->input->post('id_skenario');
        $data['skenario1'] = $this->db->get_where('data_skenario', ['id_skenario' => $sek])->row_array();
        $data['soal'] = $this->Proses_model->getSoal($sek);
        $data['jawaban'] = $this->Proses_model->getJawaban($pro, $sek);
        $data['project1'] = $this->db->get_where('data_project', ['id_project' => $pro])->row_array();
        $this->load->view('proses/cetakkonsistensi', $data);

        // redirect("proses/index/$pro/$sek");
    }

}
