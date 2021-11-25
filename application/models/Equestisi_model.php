<?php

class Equestisi_model extends CI_model
{
    public function simpanjawaban()
    {
        $id_pembuat_equest = $this->input->post('id_pembuat_equest');
        $id_project = $this->input->post('id_project');
        $id_skenario = $this->input->post('id_skenario');
        $kunjungan = $this->input->post('id_kunjungan');
        $cabang = $this->input->post('kode_cabang');

        // var_dump($id_pembuat_equest);
        // var_dump($id_project);
        // var_dump($id_skenario);
        // die;


        $this->db->order_by('id_soal_equest', 'ASC');
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id_pembuat_equest])->result_array();
        // var_dump($id_pembuat_equest);
        $no = 1;
        $p=1;
        $implode = [];

        foreach($soal as $db => $sl){
            // var_dump($sl['soal_equest']);
            var_dump($sl['jenis_soal']);
            // MULTIPLE CHOICE
            if($sl['jenis_soal'] == 5){
                $jb = 'jb'.$no++;
                $jb1 = $this->input->post($jb);
                if($jb1 == ""){
                    $jb2 = '0';
                } else {
                    $jb2 = implode(" ",$jb1);
                }
                Array_push($implode, $jb2);
            }
            var_dump($p++);
            //AKHIR MULTIPLE CHOICE

            if($sl['jenis_soal'] == 4){
                //var_dump("MASUK WAY");
                $jb = 'jb'.$no++;
                if($this->input->post($jb) == ""){
                    $n = $no-1;
                    $jbr = 'lain'.$n;
                    $jb1 = htmlspecialchars($this->input->post($jbr, true));
                    if($jb1 == ""){
                        $jb1 = '0';
                    }
                    $jb2 = '#@!'.$jb1;
                    Array_push($implode, $jb2);
                } else {
                    $n = $no-1;
                    $jb = 'jb'.$n;
                    $jb1 = htmlspecialchars($this->input->post($jb, true));
                    if($jb1 == ""){
                        $jb1 = '0';
                    }
                    Array_push($implode, $jb1);
                }
             } //else {
            //     $jb = 'jb'.$no++;
            //     $jb1 = htmlspecialchars($this->input->post($jb, true));
            //     if($jb1 == ""){
            //         $jb1 = '0';
            //     }
            //     Array_push($implode, $jb1);
            //     // Array_push($implode, htmlspecialchars($this->input->post($jb, true)));
            //  }
            // var_dump($this->input->post($jb));
            // Array_push($implode, htmlspecialchars($this->input->post($jb, true)));
            // var_dump($jb);
            if($sl['jenis_soal'] == 1 or $sl['jenis_soal'] == 2 or $sl['jenis_soal'] == 3){
                $jb = 'jb'.$no++;
                $jb1 = htmlspecialchars($this->input->post($jb, true));
                if($jb1 == ""){
                    $jb1 = '0';
                }
                Array_push($implode, $jb1);
            }
        }
        $jawaban = implode('|', $implode);
        var_dump($jawaban);
        //  var_dump($this->session->userdata('id_user')); die;

        $data=[
            'id_project' => $id_project,
            'id_skenario' => $id_skenario,
            'id_pembuat_equest' => $id_pembuat_equest,
            'id_kunjungan' => $kunjungan,
            'kode_cabang' => $cabang,
            'id_user' => $this->session->userdata('id_user'),
            'jawaban_equest' => $jawaban,
        ];
            // die;
        $this->db->insert('data_jawaban_equest', $data);

        $update = [
            'id_status_equest' => 1
        ];

        $this->db->where('id_aktual', $this->input->post('id_aktual'));
        $this->db->update('data_aktual', $update);
    }

    public function getSkenarioByUser(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_skenario, c.nama_project from data_project c join ( data_aktual a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_project=c.id_project where a.id_user = $id_user and a.id_status = 1 and a.id_status_equest = 0")->result_array();
        // return $this->db->query("SELECT a.id_project, a.id_skenario, a.id_aktual, b.nama_skenario, c.nama_project from data_project c join ( data_aktual a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_project=c.id_project where a.id_user = $id_user and a.id_status = 1 and a.id_status_equest = 0")->result_array();
    }

     public function getSkenarioByUserKB($kunjungan, $pro){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_skenario, c.nama_project from data_project c join ( data_aktual a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_project=c.id_project where a.id_user = $id_user and a.id_status = 1 and a.id_status_equest = 0")->result_array();
    }

    public function jawaban(){
        // return $this->db->get_where('data_jawaban_equest', ['id_user' => $this->session->userdata('id_user')])->result_array();
        $id = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_project from data_jawaban_equest a join data_project b on a.id_project = b.id_project where a.id_user = $id ORDER BY a.id_project ASC, a.id_kunjungan ASC")->result_array();
    }

    public function ambilSoal($id){
        $id_pembuat = $this->db->get_where('data_jawaban_equest', ['id_jawaban' => $id])->row_array();

        $this->db->order_by('id_soal_equest', 'ASC');
        return $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id_pembuat['id_pembuat_equest']])->result_array();
    }

    public function ambilJawaban($id){
        $jwb = $this->db->get_where('data_jawaban_equest', ['id_jawaban' => $id])->row_array();

        $data = explode("|" , $jwb['jawaban_equest']);

        return $data;
    }

    public function updateIsi(){
        $id_pembuat_equest = $this->db->get_where('data_jawaban_equest', ['id_jawaban' => $this->input->post('id_jawaban')])->row_array();

        $this->db->order_by('id_soal_equest', 'ASC');
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id_pembuat_equest['id_pembuat_equest']])->result_array();
        $no = 1;
        $implode = [];

        foreach($soal as $db => $sl){
            var_dump($sl['jenis_soal']);
            if($sl['jenis_soal'] == 4){
                $jb = 'lain'.$no++;
                if($this->input->post($jb) != ""){
                    $n = $no-1;
                    $jbr = 'lain'.$n;
                    $jb1 = htmlspecialchars($this->input->post($jbr, true));
                    $jb2 = '#@!'.$jb1;
                    Array_push($implode, $jb2);
                } else {
                    $n = $no-1;
                    $jb = 'jb'.$n;
                    Array_push($implode, htmlspecialchars($this->input->post($jb, true)));
                }
            } else {
                $jb = 'jb'.$no++;
                Array_push($implode, htmlspecialchars($this->input->post($jb, true)));
             }
             
            
        }
        $jawaban = implode('|', $implode);

        $data=[
            'jawaban_equest' => $jawaban,
        ];

        $this->db->where('id_jawaban', $this->input->post('id_jawaban'));
        $this->db->update('data_jawaban_equest', $data);
    }

    public function hapus($id){
        $this->db->delete('data_jawaban_equest', ['id_jawaban' => $id]);
    }

    public function getDataSkenarioById($id){
        $id_pembuat_equest = $this->db->get_where('data_jawaban_equest', ['id_jawaban' => $id])->row_array();
        $p= $id_pembuat_equest['id_pembuat_equest'];
        return $this->db->query("SELECT a.*, b.nama_skenario from data_pembuat_equest a join data_skenario b on a.id_skenario=b.id_skenario where a.id_pembuat_equest = $p")->row_array();
        //get_where('data_jawaban_equest', ['id_pembuat_equest' => $id_pembuat_equest['id_pembuat_equest']])->row_array();
    }

    // DP
    public function getSoal($id){
        $id_pembuat_equest = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id])->row_array();
        return $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id_pembuat_equest['id_pembuat_equest']])->result_array();
    }

    public function getJawaban($id){
        $id_pembuat_equest = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id])->row_array();
        $id = $id_pembuat_equest['id_pembuat_equest'];
        return $this->db->query("SELECT a.*,b.nama_user from data_jawaban_equest a join data_user b on a.id_user=b.id_user where id_pembuat_equest = $id")->result_array();
    }

    public function simpanjawabanKB()
    {
        $id_pembuat_equest = $this->input->post('id_pembuat_equest');
        $id_project = $this->input->post('id_project');
        $kunjungan = $this->input->post('id_kunjungan');
        $cabang = $this->input->post('kode_cabang');

        $this->db->order_by('id_soal_equest', 'ASC');
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id_pembuat_equest])->result_array();
        $no = 1;
        $p=1;
        $implode = [];

        foreach($soal as $db => $sl){
            var_dump($sl['jenis_soal']);
            // MULTIPLE CHOICE
            if($sl['jenis_soal'] == 5){
                $jb = 'jb'.$no++;
                $jb1 = $this->input->post($jb);
                if($jb1 == ""){
                    $jb2 = '0';
                } else {
                    $jb2 = implode(" ",$jb1);
                }
                Array_push($implode, $jb2);
            }
            var_dump($p++);
            //AKHIR MULTIPLE CHOICE

            if($sl['jenis_soal'] == 4){
                $jb = 'jb'.$no++;
                if($this->input->post($jb) == ""){
                    $n = $no-1;
                    $jbr = 'lain'.$n;
                    $jb1 = htmlspecialchars($this->input->post($jbr, true));
                    if($jb1 == ""){
                        $jb1 = '0';
                    }
                    $jb2 = '#@!'.$jb1;
                    Array_push($implode, $jb2);
                } else {
                    $n = $no-1;
                    $jb = 'jb'.$n;
                    $jb1 = htmlspecialchars($this->input->post($jb, true));
                    if($jb1 == ""){
                        $jb1 = '0';
                    }
                    Array_push($implode, $jb1);
                }
             } 
            if($sl['jenis_soal'] == 1 or $sl['jenis_soal'] == 2 or $sl['jenis_soal'] == 3){
                $jb = 'jb'.$no++;
                $jb1 = htmlspecialchars($this->input->post($jb, true));
                if($jb1 == ""){
                    $jb1 = '0';
                }
                Array_push($implode, $jb1);
            }
        }
        $jawaban = implode('|', $implode);
        var_dump($jawaban);

        $data=[
            'id_project' => $id_project,
            'id_pembuat_equest' => $id_pembuat_equest,
            'id_kunjungan' => $kunjungan,
            'kode_cabang' => $cabang,
            'id_user' => $this->session->userdata('id_user'),
            'jawaban_equest' => $jawaban,
        ];
        $this->db->insert('data_jawaban_equest', $data);
    }

    public function jawabanKB(){
        $id = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_project, c.nama as cabang, d.nama as skenariox from attribute d join ( cabang c join ( data_jawaban_equest a join data_project b on a.id_project = b.kode_project) on a.kode_cabang=c.kode and a.id_project = c.project ) on a.id_kunjungan = d.kode where a.id_user = $id ORDER BY a.id_project ASC, a.id_kunjungan ASC")->result_array();
    }
    // AKHIR DP
}
