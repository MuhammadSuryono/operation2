<?php
class Training_model extends CI_model
{
    public function get_all_training()
    {
        return $this->db->query("SELECT 
                                    a.*, b.nama AS nama_project, c.keterangan AS jenis_training
                                FROM
                                    training a
                                    LEFT JOIN project b ON a.project_kode = b.kode
                                    LEFT JOIN jenis_training c ON a.jenis_training_id = c.id
                                ")->result_array();
    }

    public function get_training_by_id($id)
    {
        return $this->db->query("SELECT 
                                    a.*, b.nama AS nama_project, c.keterangan AS jenis_training
                                FROM
                                    training a
                                    LEFT JOIN project b ON a.project_kode = b.kode
                                    LEFT JOIN jenis_training c ON a.jenis_training_id = c.id
                                WHERE a.id = '$id'
                                ")->row_array();
    }

    public function get_status_pengajuan_by_training_id($id)
    {
        return $this->db->query("SELECT status_pengajuan WHERE id = '$id'")->row_array();
    }

    public function tambah_training()
    {
        $kategori = $this->input->post('kategori');
        if ($kategori == 'project') {
            $project_kode = $this->input->post('project_kode');
            $jenis = $this->input->post('jenis');
            $nama = null;
        } else {
            $project_kode = null;
            $jenis = null;
            $nama =  $this->input->post('nama');
        }

        $data = [
            'kategori' => $kategori,
            'project_kode' => $project_kode,
            'jenis_training_id' => $jenis,
            'nama' => $nama,
            'user_update' => $this->session->userdata('id_user'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->insert('training', $data);
    }

    public function edit_training()
    {
        $kategori = $this->input->post('kategori');
        if ($kategori == 'project') {
            $project_kode = $this->input->post('project_kode');
            $jenis = $this->input->post('jenis');
            $nama = null;
        } else {
            $project_kode = null;
            $jenis = null;
            $nama =  $this->input->post('nama');
        }

        $data = [
            'kategori' => $kategori,
            'project_kode' => $project_kode,
            'jenis_training_id' => $jenis,
            'nama' => $nama,
            'user_update' => $this->session->userdata('id_user'),
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('training', $data);
    }

    public function hapus_training($id)
    {
        $this->db->delete('training', ['id' => $id]);
    }

    public function tambah_honor_training()
    {
        $training_id = $this->input->post('training_id');
        $honor = $this->input->post('nama_honor[]');
        $nominal = $this->input->post('nominal_honor[]');

        $this->db->delete('honor_training', ['training_id', $training_id]);

        for ($i = 0; $i < count($honor); $i++) {
            $data = [
                'training_id' => $training_id,
                'nama_honor' => $honor[$i],
                'nominal_honor' => $nominal[$i],
                'created_at' => date('Y-m-d H:i:s')
            ];

            $insert = $this->db->insert('honor_training', $data);

            if (!$insert) {
                return 0;
            }
        }

        return $insert;
    }

    public function get_honor_by_training_id($training_id)
    {
        return $this->db->query("SELECT * FROM honor_training WHERE training_id = '$training_id'")->result_array();
    }

    public function upload_file()
    {
        $training_id = $this->input->post('training_id');
        $get_training = $this->db->query("SELECT * FROM training WHERE id = '$training_id'")->row_array();

        $file = $_FILES['file'];

        $extension_format  = pathinfo($file['name'], PATHINFO_EXTENSION);
        $format_name = "file_training_" . (($get_training['project_kode']) ? $get_training['project_kode'] : $get_training['nama']) . "_" . time() . "." . $extension_format;
        $format_tmp = $file['tmp_name'];
        move_uploaded_file($format_tmp, "assets/file/field_sdm/" . $format_name);

        $this->db->where('id', $training_id);
        return $this->db->update('training', ['file' => $format_name]);
    }

    public function tambah_peserta_training()
    {
        return $this->db->insert('peserta_training', [
            'training_id' => $this->input->post('training_id'),
            'id_data_id' => $this->input->post('field_sdm'),
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function get_peserta_training_by_training_id($id)
    {
        return $this->db->query("SELECT a.*, b.Nama, b.Email FROM peserta_training a JOIN id_data b ON a.id_data_id = b.Id WHERE a.training_id =  '$id'")->result_array();
    }

    public function hapus_peserta_training($id)
    {
        $this->db->delete('peserta_training', ['id' => $id]);
    }

    public function get_materi_training_by_training_id($id)
    {
        return $this->db->query("SELECT a.*, b.status_pengajuan, c.name FROM materi_training a JOIN training b ON a.training_id = b.id LEFT JOIN user c ON c.noid = a.user_noid WHERE a.training_id = '$id'")->result_array();
    }

    public function tambah_materi_training()
    {
        $training_id = $this->input->post('training_id');
        $materi = $this->input->post('materi');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $pemateri = $this->input->post('pemateri');

        $data = [
            'training_id' => $training_id,
            'user_noid' => $pemateri,
            'materi' => $materi,
            'tanggal_mulai' => $tanggal_mulai,
            'jam_mulai' => $jam_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'jam_selesai' => $jam_selesai
        ];
        return $this->db->insert('materi_training', $data);
    }

    public function edit_materi_training()
    {
        $materi = $this->input->post('materi');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');
        $jam_mulai = $this->input->post('jam_mulai');
        $jam_selesai = $this->input->post('jam_selesai');
        $pemateri = $this->input->post('pemateri');


        $data = [
            'user_noid' => $pemateri,
            'materi' => $materi,
            'tanggal_mulai' => $tanggal_mulai,
            'jam_mulai' => $jam_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'jam_selesai' => $jam_selesai
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('materi_training', $data);
    }

    public function hapus_materi_training($id)
    {
        $this->db->delete('materi_training', ['id' => $id]);
    }

    public function insert_presensi_training()
    {
        $materi_id = $this->input->post('materi_id');
        $peserta_id = $this->input->post('peserta_id');
        $training_id = $this->input->post('training_id');

        $data = [
            'materi_training_id' => $materi_id,
            'peserta_training_id' => $peserta_id,
            'training_id' => $training_id,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $check = $this->db->query("SELECT COUNT(*) AS count FROM presensi_training WHERE materi_training_id='$materi_id' AND peserta_training_id='$peserta_id' AND training_id='$training_id'")->row_array();

        if (!$check['count']) {
            return $this->db->insert('presensi_training', $data);
        } else {
            return 1;
        }
    }

    public function get_checked_peserta_by_training_id_and_materi_id($training_id, $materi_id)
    {
        return $this->db->query("SELECT peserta_training_id FROM presensi_training WHERE training_id = '$training_id' AND materi_training_id = '$materi_id'")->result_array();
    }

    public function get_pemateri()
    {
        return $this->db->query("SELECT * FROM user WHERE id_divisi = 1 OR id_divisi = 8 ORDER BY name ASC")->result_array();
    }
}
