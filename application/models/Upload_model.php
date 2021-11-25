<?php

class Upload_model extends CI_model
{
    public function upload($id){
        date_default_timezone_set("Asia/Jakarta");
        $id_user = $this->session->userdata('id_user');
        $user = $this->db->get_where('data_user', ['id_user' => $id_user])->row_array();
        $data = [
            'id_user' => $id_user,
            'id_skenario' => $this->input->post('div'),
            'file_upload' => $id,
            'id_div' => $user['id_divisi'],
            'tanggal_buat' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('data_upload', $data);
    }

    public function getKolomDivRE(){
        $id = $this->input->post('div2');
        return $this->db->query("SELECT a.*, b.nama_skenario, c.nama_user, DATE_FORMAT(a.tanggal_buat, '%d-%m-%Y %H:%i:%S') as tanggal from data_user c join ( data_upload a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_user = c.id_user where a.id_skenario = $id and a.id_div = 1 order by tanggal DESC")->result_array();
    }

    public function getKolomDivDP(){
         $id = $this->input->post('div2');
        return $this->db->query("SELECT a.*, b.nama_skenario, c.nama_user, DATE_FORMAT(a.tanggal_buat, '%d-%m-%Y %H:%i:%S') as tanggal from data_user c join ( data_upload a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_user = c.id_user where a.id_skenario = $id and a.id_div = 2 order by tanggal DESC")->result_array();
    }
}