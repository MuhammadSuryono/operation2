<?php

class Equest_model extends CI_model
{
    // db kerjabakti
    // public function getproject(){
    //     $id_user = $this->session->userdata('id_user');
    //     return $this->db->query("SELECT
    //                                 a.project,
    //                                 b.nama_project 
    //                             FROM
    //                                 plan a
    //                                 JOIN data_project b ON a.project = b.kode_project 
    //                             WHERE
    //                                 NOT EXISTS (
    //                                 SELECT
    //                                     c.id_nilai 
    //                                 FROM
    //                                     data_nilai c 
    //                                 WHERE
    //                                     c.kode_project = a.project 
    //                                     AND c.id_user = '$id_user' 
    //                                     AND c.total_nilai = '100'
    //                                     AND c.kunjungan = a.kunjungan
    //                                 ) 
    //                             GROUP BY
    //                                 a.project")->result_array();
        
    // }

    //db jay2
    public function getproject(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    a.project,
                                    b.nama AS nama_project 
                                FROM
                                    plan a
                                    JOIN project b ON a.project = b.kode
                                WHERE
                                    -- GANTI DI SINI UNTUK TYPE PROJECT --
                                    b.type = 'n'
                                    AND b.visible = 'y'
                                    AND a.kareg = '$id_user'    
                                    AND NOT EXISTS (
                                    SELECT
                                        c.id_nilai 
                                    FROM
                                        data_nilai c 
                                    WHERE
                                        c.kode_project = a.project 
                                        AND c.id_user = '$id_user' 
                                        AND c.total_nilai = '100'
                                        AND c.kunjungan = a.kunjungan
                                    ) 
                                GROUP BY
                                    a.project")->result_array();
        
    }

    //db kerjabakti
    // public function getprojectshpkunjungan($id_user, $pro){
    //     return $this->db->query("SELECT
    //                                 a.project,
    //                                 b.nama_project,
    //                                 a.kunjungan,
    //                                 d.nama
    //                             FROM
    //                                 plan a
    //                                 JOIN data_project b ON a.project = b.kode_project
    //                                 JOIN attribute d ON a.kunjungan = d.kode
    //                             WHERE
    //                                 NOT EXISTS (
    //                                 SELECT
    //                                     c.id_nilai 
    //                                 FROM
    //                                     data_nilai c 
    //                                 WHERE
    //                                     c.kode_project = '$pro' 
    //                                     AND c.id_user = '$id_user' 
    //                                     AND c.total_nilai = '100' 
    //                                     AND c.kunjungan = a.kunjungan 
    //                                 ) 
    //                             GROUP BY
    //                                 a.kunjungan")->result_array();
    // }
    
    //db jay2
    public function getprojectshpkunjungan($id_user, $pro){
        return $this->db->query("SELECT
                                    a.*,
                                    c.nama as skenario,
                                    b.nama AS nama_project 
                                FROM
                                    plan a
                                    JOIN project b ON a.project = b.kode
                                    JOIN attribute c ON a.kunjungan = c.kode
                                WHERE
                                    -- GANTI DI SINI UNTUK TYPE PROJECT --
                                    b.type = 'n'
                                    AND b.visible = 'y'
                                    AND a.kareg = '$id_user'    
                                    AND NOT EXISTS (
                                    SELECT
                                        c.id_nilai 
                                    FROM
                                        data_nilai c 
                                    WHERE
                                        c.kode_project = '$pro' 
                                        AND c.id_user = '$id_user' 
                                        AND c.total_nilai = '100'
                                        AND c.kunjungan = a.kunjungan
                                    ) 
                                GROUP BY
                                    a.project")->result_array();
    }
    
    //DB Kerjabakti
    // public function getprojectskenario(){
    //     $id_user = $this->session->userdata('id_user');
    //     return $this->db->query("SELECT
    //                                 a.*,
    //                                 b.nama_project,
    //                                 d.nama 
    //                             FROM
    //                                 data_skenario_kunjungan a
    //                                 JOIN data_project b ON a.kode_project = b.kode_project
    //                                 JOIN attribute d ON d.kode = a.kategori 
    //                             WHERE
    //                             a.id_user = '$id_user' 
    //                             AND
    //                                 NOT EXISTS (
    //                                 SELECT
    //                                     c.id_kuis 
    //                                 FROM
    //                                     data_kuis c 
    //                                 WHERE
    //                                     c.kode_project = a.kode_project 
    //                                     AND c.kunjungan = a.kategori 
    //                                     AND a.id_user = '$id_user' 
    //                                 ) 
    //                             GROUP BY
    //                                 b.nama_project")->result_array();
    // }

    //DB JAY2
    public function getprojectskenario(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                	a.project AS kode_project,
                                	b.nama AS nama_project,
                                	d.nama 
                                FROM
                                	skenario a
                                	JOIN project b ON a.project = b.kode
                                	JOIN attribute d ON d.kode = a.kategori 
                                WHERE
                                	b.id_user = '$id_user' 
                                	AND NOT EXISTS (
                                	SELECT
                                		c.id_kuis 
                                	FROM
                                		data_kuis c 
                                	WHERE
                                		c.kode_project = a.project 
                                		AND c.kunjungan = a.kategori 
                                		AND b.id_user = '$id_user' 
                                	) 
                                GROUP BY
                                	a.project")->result_array();
    }

    public function getprojectsubskenario($id_user, $pro){
        // $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    a.*,
                                    b.nama_project,
                                    d.nama 
                                FROM
                                    data_skenario_kunjungan a
                                    JOIN data_project b ON a.kode_project = b.kode_project
                                    JOIN attribute d ON d.kode = a.kategori 
                                WHERE
                                a.id_user = '$id_user' 
                                AND a.kode_project = '$pro'
                                AND
                                    NOT EXISTS (
                                    SELECT
                                        c.id_kuis 
                                    FROM
                                        data_kuis c 
                                    WHERE
                                        c.kode_project = '$pro' 
                                        AND c.kunjungan = a.kategori 
                                        AND a.id_user = '$id_user' 
                                    ) 
                                GROUP BY
                                    b.nama_project")->result_array();

    }

    public function getAllData($id_user){
        return $this->db->query("SELECT a.*, b.nama_skenario FROM `data_kuis` a JOIN data_skenario b on a.kunjungan = b.nama_skenario AND a.kode_project = b.kode_project  where id_user=$id_user")->result_array();
        
    }

    public function getSkenarioByAktual(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_skenario from data_aktual_ex a join data_skenario b on a.kunjungan = b.nama_skenario and a.kode_project = b.kode_project where a.id_user = $id_user")->result_array();
    }

     public function getAllDataById($start, $limit, $id){
        return $this->db->query("SELECT *, b.kunjungan FROM `data_kuis` a JOIN data_skenario b on a.id_skenario = b.id_skenario WHERE a.id_skenario = $id LIMIT $start, $limit")->result_array();
    }
    
    public function getKuisById($id){
        return $this->db->get_where('data_kuis', ['id_kuis' => $id])->row_array();
    }
    public function tambah($jumlahsoal){
        //  $query = "";

        // for($i=1; $i<=$jumlahsoal; $i++){
        //         $skenario = htmlspecialchars($this->input->post("jenis"), true);
        //         $soal = htmlspecialchars($this->input->post("pertanyaan$i"), true);
        //         $jb = htmlspecialchars($this->input->post("jb$i"), true);
        //         $js1 = htmlspecialchars($this->input->post("js1$i"), true);
        //         $js2 = htmlspecialchars($this->input->post("js2$i"), true);
        //         $js3 = htmlspecialchars($this->input->post("js3$i"), true);

        //         $query .= "INSERT INTO data_kuis VALUES ('', '$soal', '$jb', '$js1', '$js2', '$js3', '$skenario');";
        //     }
        // $this->db->query("$query");
        $nama_project = htmlspecialchars($this->input->post("projectkuis"), true);
        $kunjungan = htmlspecialchars($this->input->post("kunjungan"), true);

        $data = [];    
        $j = 0;

            for($i=1; $i<=$jumlahsoal; $i++){
            
                $data1 = [
                'kode_project' => $nama_project,
                'kunjungan' => $kunjungan,
                'soal_kuis' => htmlspecialchars($this->input->post("pertanyaan$i"), true),
                'benar_kuis' => htmlspecialchars($this->input->post("jb$i"), true),
                'salah1_kuis' => htmlspecialchars($this->input->post("js1$i"), true),
                'salah2_kuis' => htmlspecialchars($this->input->post("js2$i"), true),
                'salah3_kuis' => htmlspecialchars($this->input->post("js3$i"), true),
                'id_skenario' => htmlspecialchars($this->input->post("kunjungan"), true)
                ];
                $data[$j] = $data1;
                $j++;

            }

        $this->db->insert_batch('data_kuis', $data);
    }

    public function ubah(){

        $data = [
            'soal_kuis' => $this->input->post('soal'),
            'benar_kuis' => $this->input->post('jb'),
            'salah1_kuis' => $this->input->post('js1'),
            'salah2_kuis' => $this->input->post('js2'),
            'salah3_kuis' => $this->input->post('js3'),
        ];

        $this->db->where('id_kuis', $this->input->post('id'));
        $this->db->update('data_kuis', $data);
    }

    public function hapus($id){
        $this->db->delete('data_kuis', ['id_kuis' => $id]);
    }

    public function kuis(){
        return $this->db->get_where('data_kuis', ['kunjungan' => $this->input->post('jenis'), 'kode_project' =>$this->input->post('projectbrief')])->result_array();
    }

    public function kuisjs($kun,$pro){
        return $this->db->get_where('data_kuis', ['kunjungan' => $kun, 'kode_project' =>$pro])->result_array();
    }

    public function jumlahjs($kun,$pro){
        return $this->db->get_where('data_kuis', ['id_skenario' => $kun, 'kode_project' =>$pro])->num_rows();
    }

    public function jumlah(){
        return $this->db->get_where('data_kuis', ['id_skenario' => $this->input->post('jenis'), 'kode_project' =>$this->input->post('projectbrief')])->num_rows();
    }

    public function getNamaSkenario(){
        return $this->db->get_where('data_skenario', ['id_skenario' => $this->input->post('jenis')])->row_array();
    }

    public function cekjawaban(){
        $total = 0;
        $jumlah = $this->db->get_where('data_kuis', ['kunjungan' => $this->input->post('id'), 'kode_project' =>$this->input->post('kode')])->num_rows();
        $id = $this->input->post('id');
        $pro = $this->input->post('kode');
        // for($i=1; $i<=$jumlah; $i++){
            // var_dump($this->input->post('id'));
            // var_dump($this->input->post("id$i"));
            // $data = $this->db->get_where('data_kuis', ['id_skenario' => $id])->result_array(); // BISA DIGUNAKAN
            $data = $this->db->get_where('data_kuis', ['kunjungan' => $id, 'kode_project' =>$this->input->post('kode')])->result_array();
            // $data = $this->db->get_where('data_kuis', ['id_skenario' => $this->input->post('id')])->result_array();
            // var_dump($data[$i-1]['id_kuis']);
            // var_dump($data[$i-1]['id_kuis']);

            foreach ($data as $j => $nilai) {
                // var_dump($j);
                // var_dump($nilai['id_kuis']);
                $id_kuis = $nilai['id_kuis'];
                $jb = $this->db->query("SELECT * FROM data_kuis WHERE id_kuis=$id_kuis")->row_array();
                // var_dump($jb);
                // $jb = $this->db->query("SELECT * FROM data_kuis WHERE id_kuis=$j['id_kuis']")->row_array();
                // var_dump($this->input->post("id$id_kuis"));
                if($this->input->post("id$id_kuis") === $jb['benar_kuis']){
                    $total = $total + 1;
                    // var_dump("BENAR BRO");
                } 
            // }
        }
        return "$total-$jumlah-$id-$pro";
    }

    public function saveJawaban($id_skenario, $total_nilai, $benar_nilai, $salah_nilai){
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'id_skenario' => $id_skenario,
            'total_nilai' => $total_nilai,
            'benar_nilai' => $benar_nilai,
            'salah_nilai' => $salah_nilai,
            'tanggal_nilai' => date('Y-m-d'),
        ];

        $this->db->insert('data_nilai', $data);
    }

    public function saveJawabanKB($project, $id_skenario, $total_nilai, $benar_nilai, $salah_nilai){
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'kode_project' => $project,
            'kunjungan' => $id_skenario,
            'total_nilai' => $total_nilai,
            'benar_nilai' => $benar_nilai,
            'salah_nilai' => $salah_nilai,
            'tanggal_nilai' => date('Y-m-d'),
        ];

        $this->db->insert('data_nilai', $data);
    }

    public function getDataNilaiById($id){
        return $this->db->query("SELECT *, DATE_FORMAT(a.tanggal_nilai, '%d-%m-%Y') as tanggal FROM data_nilai a JOIN data_skenario b ON a.id_skenario = b.id_skenario where id_user = $id order by tanggal DESC")->result_array();
    }
    public function getDataNilaiByIdKB($id){
        // return $this->db->query("SELECT a.*,b.nama as kunjunganx, c.nama_project, DATE_FORMAT(a.tanggal_nilai, '%d-%m-%Y') as tanggal FROM data_project c join (data_nilai a JOIN attribute b ON a.kunjungan = b.kode) on a.kode_project = c.kode_project where a.id_user = $id order by tanggal DESC")->result_array();
        return $this->db->query("SELECT a.*,b.nama as kunjunganx, c.nama AS nama_project, DATE_FORMAT(a.tanggal_nilai, '%d-%m-%Y') as tanggal FROM project c join (data_nilai a JOIN attribute b ON a.kunjungan = b.kode) on a.kode_project = c.kode where a.id_user = '$id' order by tanggal DESC")->result_array();
    }

}