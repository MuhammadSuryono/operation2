<?php

class Akun_model extends CI_model
{
    public function getAllData()
    {
        return $this->db->query("SELECT a.*, b.keterangan_divisi 
                                FROM user a
                                LEFT JOIN data_divisi b on a.id_divisi = b.id
                                -- ORDER BY keterangan_divisi ASC
                                ORDER BY a.name 
                                ")->result_array();
    }

    public function getDivisi()
    {
        return $this->db->get('data_divisi')->result_array();
    }

    public function tambah()
    {
        $tgl1 = htmlspecialchars($this->input->post('tgl', true));
        list($m, $d, $y) = explode('-', $tgl1);

        $data = [
            'noid' => htmlspecialchars($this->input->post('id', true)),
            'name' => htmlspecialchars($this->input->post('nama', true)),
            'password' => htmlspecialchars($this->input->post('password1')),
            'id_akses' => 1,
            'id_divisi' => $this->input->post('div'),
        ];
        $this->db->insert('user', $data);
    }

    public function getDataById($id)
    {
        return $this->db->query("SELECT * FROM user where noid = $id")->row_array();
    }

    public function ubah($id)
    {
        $status = $this->input->post('status');
        if ($status == 0) {
            $dataku = [
                'name' => htmlspecialchars($this->input->post('nama', true)),
                'id_divisi' => $this->input->post('div'),
                'status'=> $this->input->post('status'),
                'password' => NULL
            ];
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('nama', true)),
                'id_divisi' => $this->input->post('div'),
                'status'=> $this->input->post('status')
            ];

            if ($this->input->post('new_password') != NULL) {
                    $data2 = ['password' => $this->input->post('new_password')];
            } else {
                $data2 = [];
            }

            $dataku = array_merge($data, $data2);
        }

        $this->db->where('noid', $id);
        $this->db->update('user', $dataku);
    }

    public function hapus($id)
    {
        $this->db->delete('user', ['noid' => $id]);
    }

    public function ubahPassword($id)
    {
        $data = [
            'password' => htmlspecialchars($this->input->post('password1')),
        ];

        $this->db->where('noid', $id);
        $this->db->update('user', $data);
    }
}
