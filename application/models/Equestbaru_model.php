<?php

class Equestbaru_model extends CI_model
{
    public function getAllData(){
        return $this->db->get('data_skenario')->result_array();
    }

    public function getAllDataKB(){
        $user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_project, c.nama as kunjunganx from attribute c join (data_skenario_kunjungan a join data_project b on a.kode_project = b.kode_project) on a.kategori=c.kode where a.id_user='$user' group by a.id_user, a.kode_project, a.kategori")->result_array();
    }

    public function getDataBuatEquest(){
        return $this->db->query("SELECT a.*, b.nama_user, c.nama_skenario, DATE_FORMAT(a.tanggal_buat, '%d-%m-%Y') as tanggal FROM data_skenario c JOIN ( `data_pembuat_equest` a JOIN data_user b on a.id_user = b.id_user ) on a.id_skenario = c.id_skenario ORDER BY tanggal ASC")->result_array();
    }

    public function getDataBuatEquestKB(){
        return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox FROM attribute c JOIN ( `data_pembuat_equest` a JOIN data_project b on a.kode_project = b.kode_project ) on a.kategori = c.kode ORDER BY a.tanggal_buat ASC")->result_array();
    }

    public function simpanskenario(){
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'id_skenario' => $this->input->post('project'),
            'tanggal_buat' => date('Y-m-d')
        ];

        $this->db->insert('data_pembuat_equest', $data);
    }

    public function simpanskenarioKB(){
        $dataex = explode("-", $this->input->post('project'));
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'kode_project' => $dataex[1],
            'kategori' => $dataex[0],
            'tanggal_buat' => date('Y-m-d')
        ];

        $this->db->insert('data_pembuat_equest', $data);
    }

    public function simpanequest(){
        $jumlah = $this->input->post('jmlsoal');
        $id_pembuat = $this->input->post('id_skenario');
        // $id_pembuat = '210';
        // $jenissoal = $this->input->post('jenissoal');
        // var_dump($jenissoal);
        // var_dump($id_pembuat);
        // die;

        for($i=1; $i<=$jumlah; $i++){
            $jenissoal = 'jenissoal'.$i;
            $kode = 'kode'.$i;
            $soal = 'message'.$i;
            $jlmpg = 'jmlpg'.$i;

            // if($this->input->post('jenissoal') == '3'){
            //     var_dump($this->input->post('message'));
            //     for($j=1; $j<=$this->input->post('jmlpg'); $j++){
            //         $pg = 'pg'.$j;
            //         var_dump($this->input->post($pg));
            //     }
            // }

            if($this->input->post($jenissoal) == '3'){
                // var_dump($this->input->post($soal));
                $data = [
                    'id_pembuat_equest' => $id_pembuat,
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal))
                ];
                $this->db->insert('data_soal_equest', $data);

                $cari = $this->db->get_where('data_soal_equest', ['soal_equest' => $this->input->post($soal)])->row_array();
                // var_dump($cari['id_soal_equest']);
                for($j=1; $j<=$this->input->post($jlmpg); $j++){
                    $pg = 'pg'.$j.$i;
                    $kodepg = 'kodepg'.$j.$i;
                    $jump = 'jump'.$j.$i;
                    // var_dump($this->input->post($pg));

                    $data1 = [
                        'id_soal_equest' => $cari['id_soal_equest'],
                        'pg_equest' => htmlspecialchars($this->input->post($pg)),
                        'kode_pg_equest' => htmlspecialchars($this->input->post($kodepg)),
                        'ket_soal' => htmlspecialchars($this->input->post($jump))
                    ];

                    $this->db->insert('data_pg_equest', $data1);
                }
            } 


            if($this->input->post($jenissoal) == '1'){
                // var_dump($this->input->post($soal));
                // var_dump($this->input->post($jenissoal));
                 $data2 = [
                    'id_pembuat_equest' => $id_pembuat,
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal))
                ];
                $this->db->insert('data_soal_equest', $data2);
            }

            if($this->input->post($jenissoal) == '2'){
                // var_dump($this->input->post($soal));
                // var_dump($this->input->post($jenissoal));

                 $data3 = [
                    'id_pembuat_equest' => $id_pembuat,
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal))
                ];
                $this->db->insert('data_soal_equest', $data3);
            }

            if($this->input->post($jenissoal) == '4'){
                // var_dump($this->input->post($soal));

                $data4 = [
                    'id_pembuat_equest' => $id_pembuat,
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal))
                ];
                $this->db->insert('data_soal_equest', $data4);

                $cari1 = $this->db->get_where('data_soal_equest', ['soal_equest' => $this->input->post($soal)])->row_array();

                for($j=1; $j<=$this->input->post($jlmpg); $j++){
                    $pg = 'pg'.$j.$i;
                    $kodepg = 'kodepg'.$j.$i;
                    $jump = 'jump'.$j.$i;
                    // var_dump($this->input->post($pg));

                    $data6 = [
                        'id_soal_equest' => $cari1['id_soal_equest'],
                        'pg_equest' => htmlspecialchars($this->input->post($pg)),
                        'kode_pg_equest' => htmlspecialchars($this->input->post($kodepg)),
                        'ket_soal' => htmlspecialchars($this->input->post($jump))
                    ];

                    $this->db->insert('data_pg_equest', $data6);
                    // var_dump($data6);
                }
            }

            if($this->input->post($jenissoal) == '5'){
                // var_dump($this->input->post($soal));

                $data7 = [
                    'id_pembuat_equest' => $id_pembuat,
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal))
                ];
                $this->db->insert('data_soal_equest', $data7);

                $cari1 = $this->db->get_where('data_soal_equest', ['soal_equest' => $this->input->post($soal)])->row_array();

                for($j=1; $j<=$this->input->post($jlmpg); $j++){
                    $pg = 'pg'.$j.$i;
                    $kodepg = 'kodepg'.$j.$i;
                    $jump = 'jump'.$j.$i;
                    // var_dump($this->input->post($pg));

                    $data8 = [
                        'id_soal_equest' => $cari1['id_soal_equest'],
                        'pg_equest' => htmlspecialchars($this->input->post($pg)),
                        'kode_pg_equest' => htmlspecialchars($this->input->post($kodepg)),
                        'ket_soal' => htmlspecialchars($this->input->post($jump))
                    ];

                    $this->db->insert('data_pg_equest', $data8);
                    // var_dump($data6);
                }
            }


            // $soal = 'message'.$i;
            // var_dump($this->input->post($soal));
        }

        // die;
    }

    public function soalEquest($id_skenario){
        $soal = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id_skenario])->row_array();

        $this->db->order_by('id_soal_equest', 'ASC');
        return $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $soal['id_pembuat_equest']])->result_array();
    }

    public function soalEquestKB($id_skenario){
        // $soal = $this->db->get_where('data_pembuat_equest', ['id_skenario' => $id_skenario])->row_array();

        $this->db->order_by('id_soal_equest', 'ASC');
        return $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id_skenario])->result_array();
    }

    public function getRowData($id_skenario){
        return $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $soal['id_pembuat_equest']])->num_rows();
    }

    public function hapus($id){
        $pg = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id, 'jenis_soal' => 3])->result_array();
        $pg1 = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $id, 'jenis_soal' => 4])->result_array();

        if($pg){
            foreach($pg as $db => $n){
                var_dump($n['id_soal_equest']);
                $this->db->delete('data_pg_equest', ['id_soal_equest' => $n['id_soal_equest']]);
            }
        } 
        
        if($pg1){
            foreach($pg1 as $db => $n){
                var_dump($n['id_soal_equest']);
                $this->db->delete('data_pg_equest', ['id_soal_equest' => $n['id_soal_equest']]);
            }
        }

        $this->db->delete('data_soal_equest', ['id_pembuat_equest' => $id]);
        $this->db->delete('data_pembuat_equest', ['id_pembuat_equest' => $id]);
    }

    public function simpanLibraryEquest(){
        $jumlah = $this->input->post('jmlsoal');
        $nama = $this->input->post('nama_library');

        for($i=1; $i<=$jumlah; $i++){
            $jenissoal = 'jenissoal'.$i;
            $kode = 'kode'.$i;
            $soal = 'message'.$i;
            $jlmpg = 'jmlpg'.$i;

            if($this->input->post($jenissoal) == '3'){
                $data = [
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal)),
                    'nama_library' => $nama
                ];
                $this->db->insert('data_library_equest', $data);

                $cari = $this->db->get_where('data_library_equest', ['soal_equest' => $this->input->post($soal)])->row_array();

                for($j=1; $j<=$this->input->post($jlmpg); $j++){
                    $pg = 'pg'.$j.$i;
                    $kodepg = 'kodepg'.$j.$i;
                    $jump = 'jump'.$j.$i;

                    $data1 = [
                        'id_soal_equest' => $cari['id_soal_equest'],
                        'pg_equest' => htmlspecialchars($this->input->post($pg)),
                        'kode_pg_equest' => htmlspecialchars($this->input->post($kodepg)),
                        'ket_soal' => htmlspecialchars($this->input->post($jump))
                    ];

                    $this->db->insert('data_pg_library_equest', $data1);
                }
            } 


            if($this->input->post($jenissoal) == '1'){
                 $data2 = [
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal)),
                    'nama_library' => $nama
                ];
                $this->db->insert('data_library_equest', $data2);
            }

            if($this->input->post($jenissoal) == '2'){

                 $data3 = [
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal)),
                    'nama_library' => $nama
                ];
                $this->db->insert('data_library_equest', $data3);
            }

            if($this->input->post($jenissoal) == '4'){

                $data4 = [
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal)),
                    'nama_library' => $nama
                ];
                $this->db->insert('data_library_equest', $data4);

                $cari1 = $this->db->get_where('data_library_equest', ['soal_equest' => $this->input->post($soal)])->row_array();

                for($j=1; $j<=$this->input->post($jlmpg); $j++){
                    $pg = 'pg'.$j.$i;
                    $kodepg = 'kodepg'.$j.$i;
                    $jump = 'jump'.$j.$i;

                    $data6 = [
                        'id_soal_equest' => $cari1['id_soal_equest'],
                        'pg_equest' => htmlspecialchars($this->input->post($pg)),
                        'kode_pg_equest' => htmlspecialchars($this->input->post($kodepg)),
                        'ket_soal' => htmlspecialchars($this->input->post($jump))
                    ];

                    $this->db->insert('data_pg_library_equest', $data6);
                }
            }

            if($this->input->post($jenissoal) == '5'){

                $data7 = [
                    'kode_soal' => htmlspecialchars($this->input->post($kode)),
                    'soal_equest' => htmlspecialchars($this->input->post($soal)),
                    'jenis_soal' => htmlspecialchars($this->input->post($jenissoal)),
                    'nama_library' => $nama
                ];
                $this->db->insert('data_library_equest', $data7);

                $cari1 = $this->db->get_where('data_soal_equest', ['soal_equest' => $this->input->post($soal)])->row_array();

                for($j=1; $j<=$this->input->post($jlmpg); $j++){
                    $pg = 'pg'.$j.$i;
                    $kodepg = 'kodepg'.$j.$i;
                    $jump = 'jump'.$j.$i;

                    $data8 = [
                        'id_soal_equest' => $cari1['id_soal_equest'],
                        'pg_equest' => htmlspecialchars($this->input->post($pg)),
                        'kode_pg_equest' => htmlspecialchars($this->input->post($kodepg)),
                        'ket_soal' => htmlspecialchars($this->input->post($jump))
                    ];

                    $this->db->insert('data_pg_library_equest', $data8);
                }
            }

        }

    }

}