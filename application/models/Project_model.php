<?php

class Project_model extends CI_model
{

    public function getAllData($id, $start, $limit)
    {
        // return $this->db->query("SELECT *, bank as bank, DATE_FORMAT(tanggal_project, '%d-%m-%Y') as tanggal, DATE_FORMAT(tanggal_end_project, '%d-%m-%Y') as tanggal2 FROM data_project WHERE id_user=$id LIMIT $start, $limit")->result_array();
        return $this->db->query("SELECT
                                    a.kode,
                                    a.nama,
                                    b.nama AS bank,
                                    DATE_FORMAT( a.tanggal, '%d-%m-%Y' ) AS tanggal,
                                    DATE_FORMAT( a.tanggal_end, '%d-%m-%Y' ) AS tanggal2,
                                    a.type
                                FROM
                                    project a
                                    JOIN bank b ON a.bank = b.kode
                                WHERE
                                    id_user = '$id'
                                    AND visible = 'y' 
                                    AND type = 'n'
                                -- LIMIT $start, 
                                -- $limit
                                ")->result_array();
    }

    public function getAllDataForPlan($id, $start, $limit)
    {
        // return $this->db->query("SELECT *, bank as bank, DATE_FORMAT(tanggal_project, '%d-%m-%Y') as tanggal, DATE_FORMAT(tanggal_end_project, '%d-%m-%Y') as tanggal2 FROM data_project WHERE id_user=$id LIMIT $start, $limit")->result_array();
        return $this->db->query("SELECT
                                    a.kode,
                                    a.nama,
                                    b.nama AS bank,
                                    DATE_FORMAT( a.tanggal, '%d-%m-%Y' ) AS tanggal,
                                    DATE_FORMAT( a.tanggal_end, '%d-%m-%Y' ) AS tanggal2,
                                    a.type
                                FROM
                                    project a
                                    JOIN bank b ON a.bank = b.kode
                                    JOIN user c ON a.id_user = c.noid
                                WHERE
                                    id_user = '$id' OR c.id_divisi = 1
                                    AND visible = 'y' 
                                    AND type = 'n'
                                -- LIMIT $start, 
                                -- $limit
                                ")->result_array();
    }

    public function getbank()
    {
        return $this->db->get('bank')->result_array();
    }

    // public function tambah($img2){
    public function tambah()
    {

        $tgl1 = htmlspecialchars($this->input->post('tgl', true));
        list($m1, $d1, $y1) = explode('-', $tgl1);
        $tgl2 = htmlspecialchars($this->input->post('tgl2', true));
        list($m2, $d2, $y2) = explode('-', $tgl2);
        $data = [
            // 'id_user' => $this->session->userdata['id_user'],
            // 'nama_project' => htmlspecialchars($this->input->post('nama', true)),
            // 'bank' => htmlspecialchars($this->input->post('bank', true)),
            // 'kode_project' => htmlspecialchars($this->input->post('kode', true)),
            // 'tanggal_project' => "$y1-$m1-$d1",
            // 'tanggal_end_project' => "$y2-$m2-$d2",
            // 'jenis_project' => htmlspecialchars($this->input->post('jenis', true)),
            // 'file_projectspec' => $img2,
            // 'type' => htmlspecialchars($this->input->post('jenis', true)),
            // 'visible' => 'y',

            'id_user' => $this->session->userdata['id_user'],
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'bank' => htmlspecialchars($this->input->post('bank', true)),
            'kode' => htmlspecialchars($this->input->post('kode', true)),
            'tanggal' => "$y1-$m1-$d1",
            'tanggal_end' => "$y2-$m2-$d2",
            'type' => htmlspecialchars($this->input->post('jenis', true)),
            'visible' => 'y',
            'channel' => htmlspecialchars($this->input->post('channel', true)),
            'project_client' => htmlspecialchars($this->input->post('project_client', true)),

        ];
        $kode = $this->input->post('kode', true);
        $cek = $this->db->get_where('project', array('kode' => $kode))->num_rows();
        if ($cek == 0) {
            $this->db->insert('project', $data);
        }
    }

    public function hapus($id)
    {
        $this->db->delete('project', ['kode' => $id]);
    }

    public function getProjectById($id_project)
    {
        // REVSI IWAYRIWAY (TANYA DULU)
        // return $this->db->query("SELECT *, bank as bank, DATE_FORMAT(tanggal_project, '%m-%d-%Y') as tanggal1, DATE_FORMAT(tanggal_end_project, '%m-%d-%Y') as tanggal2 FROM data_project where kode_project = '$id_project'")->row_array();
        return $this->db->query("SELECT *, nama as nama_project, kode as kode_project, tanggal as tanggal_project, type as jenis_project, bank as bank, DATE_FORMAT(tanggal, '%m-%d-%Y') as tanggal1 FROM project where kode = '$id_project'")->row_array();
    }

    public function ubah($id_project)
    {

        $data = $this->db->get_where('data_project', ['id_project' => $id_project])->row_array();

        $tgl1 = htmlspecialchars($this->input->post('tgl1', true));
        list($m1, $d1, $y1) = explode('-', $tgl1);
        $tgl2 = htmlspecialchars($this->input->post('tgl2', true));
        list($m2, $d2, $y2) = explode('-', $tgl2);
        $data = [
            'nama_project' => htmlspecialchars($this->input->post('nama', true)),
            'bank' => htmlspecialchars($this->input->post('bank', true)),
            'kode_project' => htmlspecialchars($this->input->post('kode', true)),
            'tanggal_project' => "$y1-$m1-$d1",
            'tanggal_end_project' => "$y2-$m2-$d2",
            'jenis_project' => htmlspecialchars($this->input->post('jenis', true)),
        ];

        $this->db->where('id_project', $id_project);
        $this->db->update('data_project', $data);
    }

    public function download()
    {
        $data = $this->uri->segment(3);
        $file = urldecode($data);
        $berkas = FCPATH . '/assets/file/project' . $file;
        force_download($berkas, NULL);
    }

    public function getRowData($id)
    {
        $this->db->select('*');
        $this->db->from('project');
        $this->db->where('id_user', $id);
        return $this->db->get()->num_rows();
    }

    public function add_pengecekan()
    {

            $project = $this->input->post('project');
            $tanggal = $this->input->post('tanggal_field');
            $waktu = $this->input->post('waktu_field');
            $hari = $this->input->post('hari_field');
            $jam = $this->input->post('jam_field');


            foreach ($jam as $row => $val) {

            $provider = $_POST['provider'][$row];
            $bukti = $_FILES['bukti'];

                $extension_format  = pathinfo($bukti['name'][$row], PATHINFO_EXTENSION);
                $format_name = "BuktiSS_".$project."_".$provider."_". time() . "." . $extension_format;
                $format_tmp = $bukti['tmp_name'][$row];
                move_uploaded_file($format_tmp, "assets/file/project/" . $format_name);
                    
                    $data = [
                        'project' => $project,
                        'provider' => $provider,
                        'tanggal' => $tanggal,
                        'jam' => $val,
                        'hari' => $hari,
                        'waktu' => $waktu,
                        'download' => $_POST['download'][$row],
                        'upload' => $_POST['upload'][$row],
                        'bukti' => $format_name

                        ];

                $this->db->insert('ebanking_cekfield', $data);
                // var_dump($bukti['name'][0]);
        }
    }

    public function getprovider()
    {
        return $this->db->get('ebanking_provider')->result_array();
    }

    public function add_peralatan()
    {
            $datenow = date('Y-m-d');
            $project = $this->input->post('project');
            $nama = $this->input->post('alat');


            foreach ($nama as $row => $val) {

            $bukti = $_FILES['bukti'];

                $extension_format  = pathinfo($bukti['name'][$row], PATHINFO_EXTENSION);
                $format_name = "BuktiAlat_".$project."_".$val."_". time() . "." . $extension_format;
                $format_tmp = $bukti['tmp_name'][$row];
                move_uploaded_file($format_tmp, "assets/file/project/" . $format_name);
                    
                    $data = [
                        'project' => $project,
                        'nama' => $val,
                        'jenis' => $_POST['jenis'][$row],
                        'terpakai' => $_POST['terpakai'][$row],
                        'kosong' => $_POST['kosong'][$row],
                        'bukti' => $format_name,
                        'tanggal' => $datenow

                        ];

                $this->db->insert('ebanking_peralatan', $data);
                // var_dump($bukti['name'][0]);
        }
    }

    public function setpublish($num, $publish, $user_publish)
      {
       
        return $this->db->query("UPDATE quest SET publish='$publish', user_publish='$user_publish' WHERE num='$num'");
      }

    public function stepprogress($idku, $status_progress)
      {
        return $this->db->query("UPDATE project_plan SET status='$status_progress' WHERE id='$idku'");
      }

    public function input_client()
    {
        $db_cl = $this->load->database('db_client', TRUE);

        $data = [
                'nama' => $this->input->post('nama'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'bank' => $this->input->post('bank'),
                'branch' => $this->input->post('branch'),
                'email' => $this->input->post('email')
                ];

        $db_cl->insert('user_client', $data);
    }

    public function gettable($kata, $ktg, $pro)
    {
        if ($kata == 'All Data') {
           
            return $this->db->query("SELECT a.*, c.nama AS nama_cabang, d.* FROM quest a 
                                    JOIN skenario b ON a.kunjungan=b.att AND a.project=b.project AND a.r_kategori=b.kategori
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    LEFT JOIN data_waktu_td  d ON a.project=d.id_project AND a.cabang=d.kode_cabang AND a.kunjungan=d.id_skenario
                                    WHERE a.kunjungan NOT IN ('051', '052', '053', '054', '094') AND 
                                    a.r_kategori='$ktg' AND a.project='$pro'
                                    GROUP BY a.project, a.cabang, a.kunjungan")->result_array(); 
                
            }
    }

     public function getfilter($kata, $pro)
    {
        if ($kata == 'Provinsi') {
           
            // return $this->db->query("SELECT *, provinsi as filter FROM cabang WHERE project='$pro' GROUP BY provinsi ORDER BY provinsi")->result_array(); 
            return $this->db->query("SELECT provinsi AS filter, COUNT( provinsi ) AS jumlah 
                                        -- SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang
                                        -- JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE project = '$pro'
                                        -- AND b.r_kategori IN ('001', '002', '003', '004') AND
                                        --         b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY provinsi")->result_array();
        } else if ($kata == 'Kota') {
            // return $this->db->query("SELECT *, kota as filter FROM cabang WHERE project='$pro' GROUP BY kota ORDER BY kota")->result_array();
            return $this->db->query("SELECT kota AS filter, COUNT( kota ) AS jumlah 
                                        -- SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang
                                        -- JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE project = '$pro'
                                        -- AND b.r_kategori IN ('001', '002', '003', '004') AND
                                        --         b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY kota")->result_array(); 

        } else if ($kata == 'Kanwil') {
            // return $this->db->query("SELECT *, kanwil as filter FROM cabang WHERE project='$pro' GROUP BY kanwil ORDER BY kanwil")->result_array(); 
             return $this->db->query("SELECT kanwil AS filter, COUNT( kanwil ) AS jumlah 
                                        -- SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang
                                        -- JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE project = '$pro'
                                        -- AND b.r_kategori IN ('001', '002', '003', '004') AND
                                        --         b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY kanwil")->result_array();
        } 
    }

    public function getfilter_progress($kata, $pro, $filter)
    {
        if ($kata == 'Provinsi') {
           
            // return $this->db->query("SELECT *, provinsi as filter FROM cabang WHERE project='$pro' GROUP BY provinsi ORDER BY provinsi")->result_array(); 
            return $this->db->query("SELECT provinsi AS filter, COUNT( provinsi ) AS total, 
                                        SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang a
                                        JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE b.project = '$pro'
                                        AND provinsi = '$filter'
                                        AND b.r_kategori IN ('001', '002', '003', '004') AND
                                                b.kunjungan IN ('001', '002', '003', '004') AND

                                                b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY a.provinsi")->row_array();
        } else if ($kata == 'Kota') {
            // return $this->db->query("SELECT *, kota as filter FROM cabang WHERE project='$pro' GROUP BY kota ORDER BY kota")->result_array();
            return $this->db->query("SELECT kota AS filter, COUNT( kota ) AS total, 
                                        SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang a
                                        JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE b.project = '$pro'
                                        AND kota = '$filter'
                                        AND b.r_kategori IN ('001', '002', '003', '004') AND
                                                b.kunjungan IN ('001', '002', '003', '004') AND

                                                b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY a.kota")->row_array(); 

        } else if ($kata == 'Kanwil') {
            // return $this->db->query("SELECT *, kanwil as filter FROM cabang WHERE project='$pro' GROUP BY kanwil ORDER BY kanwil")->result_array(); 
             return $this->db->query("SELECT kanwil AS filter, COUNT( kanwil ) AS total, 
                                        SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang a
                                        JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE b.project = '$pro'
                                        AND kanwil = '$filter'
                                        AND b.r_kategori IN ('001', '002', '003', '004') AND
                                                b.kunjungan IN ('001', '002', '003', '004') AND

                                                b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY a.kanwil")->row_array();
        } 
    }

    public function getfilter2($kata, $pro)
    {
        if ($kata == 'Provinsi') {
           
            // return $this->db->query("SELECT *, provinsi as filter FROM cabang WHERE project='$pro' GROUP BY provinsi ORDER BY provinsi")->result_array(); 
            return $this->db->query("SELECT provinsi AS filter, COUNT( provinsi ) AS jumlah 
                                        -- SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang
                                        -- JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE project = '$pro'
                                        -- AND b.r_kategori IN ('001', '002', '003', '004') AND
                                        --         b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY provinsi")->result_array();
        } else if ($kata == 'Kota') {
            // return $this->db->query("SELECT *, kota as filter FROM cabang WHERE project='$pro' GROUP BY kota ORDER BY kota")->result_array();
            return $this->db->query("SELECT kota AS filter, COUNT( kota ) AS jumlah 
                                        -- SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang
                                        -- JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE project = '$pro'
                                        -- AND b.r_kategori IN ('001', '002', '003', '004') AND
                                        --         b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY kota")->result_array(); 

        } else if ($kata == 'Kanwil') {
            // return $this->db->query("SELECT *, kanwil as filter FROM cabang WHERE project='$pro' GROUP BY kanwil ORDER BY kanwil")->result_array(); 
             return $this->db->query("SELECT kanwil AS filter, COUNT( kanwil ) AS jumlah 
                                        -- SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang
                                        -- JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE project = '$pro'
                                        -- AND b.r_kategori IN ('001', '002', '003', '004') AND
                                        --         b.kunjungan NOT IN ('051', '052', '053', '054', '094')
                                        GROUP BY kanwil")->result_array();
        } 
    }

    public function getfilter_progress2($kata, $pro, $filter)
    {
        if ($kata == 'Provinsi') {
           
            // return $this->db->query("SELECT *, provinsi as filter FROM cabang WHERE project='$pro' GROUP BY provinsi ORDER BY provinsi")->result_array(); 
            return $this->db->query("SELECT provinsi AS filter, COUNT( provinsi ) AS total, 
                                        SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang a
                                        JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE b.project = '$pro'
                                        AND provinsi = '$filter'

                                        AND  b.kunjungan IN ('051', '052', '053', '054', '094')
                                        GROUP BY a.provinsi")->result_array();
        } else if ($kata == 'Kota') {
            // return $this->db->query("SELECT *, kota as filter FROM cabang WHERE project='$pro' GROUP BY kota ORDER BY kota")->result_array();
            return $this->db->query("SELECT kota AS filter, COUNT( kota ) AS total, 
                                        SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang a
                                        JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE b.project = '$pro'
                                        AND kota = '$filter'
                                        
                                        AND  b.kunjungan IN ('051', '052', '053', '054', '094')
                                        GROUP BY a.kota")->result_array(); 

        } else if ($kata == 'Kanwil') {
            // return $this->db->query("SELECT *, kanwil as filter FROM cabang WHERE project='$pro' GROUP BY kanwil ORDER BY kanwil")->result_array(); 
             return $this->db->query("SELECT kanwil AS filter, COUNT( kanwil ) AS total, 
                                        SUM(CASE b.status WHEN '3' THEN 1 ELSE 0 END ) AS finish
                                        FROM cabang a
                                        JOIN quest b ON a.kode = b.cabang AND a.project=b.project
                                        WHERE b.project = '$pro'
                                        AND kanwil = '$filter'
                                        
                                        AND  b.kunjungan IN ('051', '052', '053', '054', '094')
                                        GROUP BY a.kanwil")->result_array();
        } 
    }
}
