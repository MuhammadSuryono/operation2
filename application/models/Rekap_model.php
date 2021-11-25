<?php

class Rekap_model extends CI_model
{
    public function getDataDialog($id){
        return $this->db->query("SELECT a.*, b.nama_user, c.nama_skenario, d.nama_cabang from data_cabang d join (data_skenario c join ( data_dialog a join data_user b on a.id_user=b.id_user) on a.id_skenario = c.id_skenario) on a.kode_cabang=d.kode_cabang where a.id_project = $id")->result_array();
        //$this->db->get_where('data_dialog', ['id_skenario' => $this->input->post('project')])->result_array(); 
    }

    public function getDialogById($id){
        return $this->db->get_where('data_dialog', ['id_dialog' => $id])->row_array();
    }

    public function simpanDialog(){
        $cek = $this->db->get_where('data_dialog', ['id_dialog' => $this->input->post('dialog')])->row_array();

        if($cek['sts_dialog'] == 1){
            $this->db->delete('data_rekap', ['id_dialog' => $this->input->post('dialog')]);
        } 

        $kolom = $this->db->get('data_skill')->result_array();

        // var_dump($this->input->post('dialog'));
        // var_dump();
        // var_dump($this->input->post('skenario'));
        // die;
        $query = "INSERT INTO data_rekap (id_dialog, id_project, id_skenario, kode_cabang, id_user, ";


        // $data = [
        //     'id_dialog' => $this->input->post('dialog'),
        //     'id_project' => $this->input->post('project'),
        //     'id_skenario' => $this->input->post('skenario'),
        //     'id_user' => $this->session->userdata('id_user'),
        $o = 1;
            foreach($kolom as $klm => $kl){
                $query .= $kl['kode_kolom'];
                if($o != count($kolom)){
                    $query .= ", ";
                } else {
                    $query .= ") VALUES (";
                } $o++;
                // $kode = $kl['kode_kolom'];
                // "$kode" => $this->input->post($kode),
            }
        $dialog = $this->input->post('dialog');
        $project = $this->input->post('project');
        $skenario = $this->input->post('skenario');
        $cabang = $this->input->post('cabang');
        $user = $this->session->userdata('id_user');
        $query .= "$dialog, $project, $skenario, $cabang, $user, ";
        // ];
        
        $o1 = 1;
        foreach($kolom as $klm => $kl){
                $query .= $this->input->post($kl['kode_kolom']); //"$kl['kode_kolom']"
                if($o1 != count($kolom)){
                    $query .= ", ";
                } else {
                    $query .= ")";
                }
                $o1++;
            }

        // $this->db->insert('data_rekap', $data);
        $this->db->query($query);

        $data = [
            'sts_dialog' => 1
        ];

        $this->db->where('id_dialog', $this->input->post('dialog'));
        $this->db->update('data_dialog', $data);
    }

    public function getDataRekap($id){
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama_skenario, d.nama_user from data_user d join ( data_skenario c join ( data_rekap a join data_project b on a.id_project = b.id_project) on a.id_skenario = c.id_skenario) on a.id_user = d.id_user where a.id_skenario = $id")->result_array();
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama_skenario, d.nama_user from data_user d join ( data_skenario c join ( data_rekap a join data_project b on a.id_project = b.id_project) on a.id_skenario = c.id_skenario) on a.id_user = d.id_user where a.id_project = $id")->result_array();
        return $this->db->query("SELECT a.*, b.nama_project, c.nama_skenario, d.nama_user, e.nama_cabang from data_cabang e join ( data_user d join ( data_skenario c join ( data_rekap a join data_project b on a.id_project = b.id_project) on a.id_skenario = c.id_skenario) on a.id_user = d.id_user ) on a.kode_cabang = e.kode_cabang where a.id_project = $id")->result_array();
    }

    public function simpankolom(){
        $ulang = $this->input->post('jmlkolomskill');
        $data = [];
        $query = "ALTER TABLE data_rekap ";
        for($d=1;$d<=$ulang;$d++){
            $kode = "kode".$d;
            $pertanyaan = "pertanyaan".$d;
            $ket = "keterangan".$d;
            $kode_kolom = htmlspecialchars($this->input->post($kode));
            $data1 = [
                // 'kode_kolom' => htmlspecialchars($this->input->post($kode)),
                'kode_kolom' => $kode_kolom,
                'nama_kolom' => htmlspecialchars($this->input->post($pertanyaan)),
                'ket_kolom' => htmlspecialchars($this->input->post($ket))
            ];

            array_push($data, $data1);
            $query .= "ADD $kode_kolom text, ";
        }

        $this->db->insert_batch('data_skill', $data);

        // $kolom = $this->db->get('data_skill')->result_array();
        // $query = "ALTER TABLE data_rekap ADD id_dialog int(11), ADD id_project int(11), ADD id_skenario int(11), ADD id_user int(11), ";
        // foreach($kolom as $klm => $kl){
        //     $field = $kl['kode_kolom'];
        //     $query .= "ADD $field text, ";
        // }
        $koma = strrpos($query, ",");
        $query = substr($query,0, $koma);
        $query .= ";";

        $this->db->query($query);
    }
}