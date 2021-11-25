<?php

class Task_model extends CI_model
{

    public function getAllData()
    {
        // return $this->db->query("SELECT *, bank as bank, DATE_FORMAT(tanggal_project, '%d-%m-%Y') as tanggal, DATE_FORMAT(tanggal_end_project, '%d-%m-%Y') as tanggal2 FROM data_project WHERE id_user=$id LIMIT $start, $limit")->result_array();
        return $this->db->query("SELECT * FROM task")->result_array();
    }

    public function tambah()
    {
        $data = [
            'kegiatan' => $this->input->post('task')
        ];

        $this->db->insert('task', $data);
    }
}
