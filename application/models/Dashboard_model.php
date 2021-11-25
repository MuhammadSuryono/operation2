<?php

class Dashboard_model extends CI_model
{
    public function getAllData(){
        return $this->db->query("SELECT *, DATE_FORMAT(tanggal_lahir, '%d-%m-%Y') as tanggal FROM data_user a JOIN data_gender b on a.jenis_kelamin=b.id_gender where a.id_akses = 2")->result_array();
    }

    public function tambah(){
        $tgl1 = htmlspecialchars($this->input->post('tgl', true));
        list($m, $d, $y) = explode ( '-', $tgl1);
        $pw = htmlspecialchars($this->input->post('password1', true));

        $data =[
            'id_user' => htmlspecialchars($this->input->post('id', true)),
            'nama_user' => htmlspecialchars($this->input->post('nama', true)),
            'password_user' => password_hash($pw, PASSWORD_DEFAULT),
            'jenis_kelamin' => htmlspecialchars($this->input->post('jk', true)),
            'id_akses' => 2,
            'tanggal_lahir' => "$y-$d-$m",
            'tanggal_buat' => date('Y-m-d')
        ];
        $this->db->insert('data_user', $data);
    }

    public function getRow(){
        return $this->db->get('data_user')->num_rows();
    }

    public function hapus($id){
        $this->db->delete('data_user', ['id_user' => $id]);
    }

    public function getDataById($id){
        return $this->db->query("SELECT *, DATE_FORMAT(tanggal_lahir, '%d-%m-%Y') as tanggal FROM data_user WHERE id_user=$id")->row_array();
    }

    public function ubah($id){
        $tgl1 = htmlspecialchars($this->input->post('tgl', true));
        list($m, $d, $y) = explode ( '-', $tgl1);
        

        $data =[
            'nama_user' => htmlspecialchars($this->input->post('nama', true)),
            'jenis_kelamin' => htmlspecialchars($this->input->post('jk', true)),
            'tanggal_lahir' => "$y-$d-$m",
        ];

        $this->db->where('id_user', $id);
        $this->db->update('data_user', $data);
    }
}