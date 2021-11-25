<?php

class Proses_model extends CI_model
{
        // DP
    public function getSoal($id){
        $id_pembuat_equest = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id])->row_array();
        return $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id_pembuat_equest['id_pembuat_equest']])->result_array();
    }

    public function getJawaban($id_project,$id_skenario){
        // $id_pembuat_equest = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id_skenario])->row_array();
        // $id = $id_pembuat_equest['id_pembuat_equest'];
        // if($id == ""){
        //     return [];
        // } else {
            return $this->db->query("SELECT a.*,b.nama_user, c.nama_project, d.nama_cabang from data_cabang d join ( data_project c join ( data_jawaban_equest a join data_user b on a.id_user=b.id_user ) on a.id_project = c.id_project) on a.kode_cabang=d.kode_cabang where a.id_project = $id_project and a.id_skenario = $id_skenario")->result_array();
            // return $this->db->query("SELECT a.*,b.nama_user, c.nama_project from data_project c join ( data_jawaban_equest a join data_user b on a.id_user=b.id_user ) on a.id_project = c.id_project where id_pembuat_equest = $id")->result_array();
        // }
    }

    public function getJawabanInkonsistensi($id_project,$id_skenario){
            return $this->db->query("SELECT a.*,b.nama_user, c.nama_project, d.nama_cabang from data_cabang d join ( data_project c join ( data_jawaban_equest a join data_user b on a.id_user=b.id_user ) on a.id_project = c.id_project) on a.kode_cabang=d.kode_cabang where a.id_project = $id_project and a.id_skenario = $id_skenario and a.sts = 3")->result_array();
    }

    public function editJawabanEquest($id){
        $jawaban = $this->db->get_where('data_jawaban_equest', ['id_jawaban' => $id])->row_array();
        $soal = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $jawaban['id_pembuat_equest']])->result_array();
        return array(
            'jawaban' => explode("|", $jawaban['jawaban_equest']),
            'soal' => $soal,
            'validasi' => $jawaban['ket_jawab'],
            'project' => $jawaban['id_project'],
            'skenario' => $jawaban['id_skenario'],
        );
    }

    public function simpanEditJawabanEquest($id, $jawaban){
        $name = 0;
        $jwbequest = "";
        $jml = count($jawaban)-1;
        foreach($jawaban as $jb){
            $jwbequest .= htmlspecialchars($this->input->post($name));
            if($name!=$jml){
                $jwbequest .= "|";
            } $name++;
        }

        $data = [
            'jawaban_equest' => $jwbequest,
        ];
        $this->db->where('id_jawaban', $id);
        $this->db->update('data_jawaban_equest', $data);
    }

    public function updatests($id){
        $sts = $this->db->get_where('data_jawaban_equest', ['id_jawaban' => $id])->row_array();

        if($sts['sts'] == 0){
            $data = [
                'sts' => 1
            ];
        } else {
            $data = [
                'sts' => 0
            ];
        }

        $this->db->where('id_jawaban', $id);
        $this->db->update('data_jawaban_equest', $data);
    }
    // AKHIR DP

    public function getSkenarioKunjungan(){
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama_skenario from data_skenario c join ( data_skenario_kunjungan a join data_project b on a.id_project = b.id_project) on a.id_skenario = c.id_skenario order by a.id_project DESC")->result_array();
        return $this->db->query("SELECT a.*, b.nama_project, c.nama as nama_skenario from attribute c join ( data_skenario_kunjungan a join data_project b on a.kode_project = b.kode_project) on a.kode = c.kode order by a.kode_project DESC")->result_array();
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama_skenario from data_skenario c join ( data_skenario_kunjungan a join data_project b on a.id_project = b.id_project) on a.id_skenario = c.id_skenario")->result_array();
    }

    public function getProjectById($id){
        return $this->db->get_where('data_project', ['id_project' => $id])->row_array();
    }

    public function getSkenarioById($id){
        return $this->db->get_where('data_skenario', ['id_skenario' => $id])->row_array();
    }

    public function simpankonsistensi($pro, $sek){
        $user = $this->session->userdata('id_user');
        // $query = "";
        $data = array();
        for($z=1; $z<=$this->input->post('jmldata'); $z++){
            $jenis_cek = $this->input->post("cek_"."$z");

            if($jenis_cek == 1){
                $kode1 = $this->input->post("kode_cek1"."$z");
                $ket1 = $this->input->post("ket_cek1"."$z");
                $data1 = [
                    'id_project' => $pro,
                    'id_skenario' => $sek,
                    'id_user_pembuat' => $user,
                    'kode_cek_1' => $kode1,
                    'nilai_cek_1' => '',
                    'kode_cek_2' => '',
                    'nilai_cek_2' => '',
                    'jenis_cek' => 1,
                    'ket_cek' => $ket1
                ];

                array_push($data, $data1);
                // $query .= "INSERT INTO data_cek (id_project, id_skenario, id_user_pembuat, kode_cek_1, jenis_cek) VALUES ($pro, $sek, $user, '$kode1', $jenis_cek);";
            }

            if($jenis_cek == 2){
                $kode1 = $this->input->post("kode_cek1"."$z");
                $nilai1 = $this->input->post("nilai_cek1"."$z");
                $ket1 = $this->input->post("ket_cek1"."$z");

                $data2 = [
                    'id_project' => $pro,
                    'id_skenario' => $sek,
                    'id_user_pembuat' => $user,
                    'kode_cek_1' => $kode1,
                    'nilai_cek_1' => $nilai1,
                    'kode_cek_2' => '',
                    'nilai_cek_2' => '',
                    'jenis_cek' => 2,
                    'ket_cek' => $ket1
                ];
                array_push($data, $data2);
                // $query .= "INSERT INTO data_cek (id_project, id_skenario, id_user_pembuat, kode_cek_1, nilai_cek_1, jenis_cek) VALUES ($pro, $sek, $user, '$kode1', '$nilai1',  $jenis_cek);";
            }

            if($jenis_cek == 3 or $jenis_cek == 4 or $jenis_cek == 5){
                $kode1 = $this->input->post("kode_cek1"."$z");
                $nilai1 = $this->input->post("nilai_cek1"."$z");
                $kode2 = $this->input->post("kode_cek2"."$z");
                $nilai2 = $this->input->post("nilai_cek2"."$z");
                $ket1 = $this->input->post("ket_cek1"."$z");
                $data3 = [
                    'id_project' => $pro,
                    'id_skenario' => $sek,
                    'id_user_pembuat' => $user,
                    'kode_cek_1' => $kode1,
                    'nilai_cek_1' => $nilai1,
                    'kode_cek_2' => $kode2,
                    'nilai_cek_2' => $nilai2,
                    'jenis_cek' => $jenis_cek,
                    'ket_cek' => $ket1
                ];
                array_push($data, $data3);
                // $query .= "INSERT INTO data_cek (id_project, id_skenario, id_user_pembuat, kode_cek_1, nilai_cek_1, kode_cek_2, nilai_cek_2,            jenis_cek) VALUES ($pro, $sek, $user, '$kode1', '$nilai1', '$kode2', '$nilai2',  $jenis_cek);";

            }

        }
        // var_dump($data);
        $this->db->insert_batch('data_cek', $data); 
        // $this->db->insert_batch('mytable', $data);
        // $this->db->query($query);
        // $koneksi = mysqli_connect("localhost","root","","mri_operation");
        // mysqli_query($koneksi,$query);
    }

    public function getDataCek(){
        return $this->db->query("SELECT a.*, count(a.id_project AND a.id_skenario) as jml, b.nama_project, c.nama_skenario FROM data_skenario c JOIN ( `data_cek` a JOIN data_project b on a.id_project=b.id_project) on a.id_skenario=c.id_skenario GROUP BY a.id_project,a.id_skenario")->result_array();
    }

    public function hapuskonsistensi($pro, $sek){
        $this->db->delete('data_cek', ['id_project' => $pro, 'id_skenario' => $sek]);
    }

    public function getDataCekById($pro, $sek){
        return $this->db->get_where('data_cek', ['id_project' => $pro, 'id_skenario' => $sek])->result_array();
    }

    public function hapuskosistensibyid($id){
        $this->db->delete('data_cek', ['id_cek' => $id]);
    }

    public function getCoulom(){
        return $this->db->query("SELECT COLUMN_NAME FROM information_schema.columns WHERE table_name='tbl_performence'")->result_array();
    }

    public function getisiCoulom(){
        // return $this->db->get('tbl_performence')->row_array();
        return $this->db->get('tbl_performence')->result_array();
        // return $this->db->get('data_user')->result_array();
    }

}