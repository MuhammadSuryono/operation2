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

    public function tambahhost()
    {
        $hostname = $this->input->post('hostname');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = ['hostname' => $hostname,
                'nama' => $nama,
                'username' => $username,
                'password' => $password];

        return $this->db->insert('datahost', $data);
    }

    public function edithost()
    {
        $id = $this->input->post('id');
        $hostname = $this->input->post('hostname');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = ['hostname' => $hostname,
                'nama' => $nama,
                'username' => $username,
                'password' => $password];

        return $this->db->update('datahost', $data, ['id' => $id]);
    }

    public function deletehost($id)
    {
     
        return $this->db->delete('datahost', ['id' => $id]);
    }

    public function get_progressquery()
    {
        $query = $_POST['query'];
        $project = $_POST['project'];

        return $this->db->get_where('konsistensi_progress', ['query' => $query, 'project' => $project])->result_array();
    }

    public function editquery()
    {
        $num = $this->input->post('num');

        $query = $this->input->post('query');
        $kategori = $this->input->post('kategori');
        $user = $this->session->userdata('id_user');
        $datenow = date('Y-m-d');

        $data = ['query' => $query,
                'kategori' => $kategori,
                'user' => $user,
                'tgl_input' => $datenow
                ];

        $this->db->update('konsistensi_query', $data, ['num' => $num]);
    }

    public function add_listquery()
    {
        $query = $this->input->post('query');
        $variable = $this->input->post('variable');
        $kode = $this->input->post('kode');
        $check = $this->input->post('check');
        $kategori = $this->input->post('kategori');


        $user = $this->session->userdata('id_user');
        $datenow = date('Y-m-d');

        $get = explode("FROM", $query);

        // $kalimat = $get[0].", '".$variable."' AS variable, '".$kode."' AS kode, '".$check."' AS `check` FROM".$get[1];
        $kalimat = $get[0].", '".$variable."' AS variable, '".$check."' AS `check` FROM".$get[1];
        
        // var_dump($kalimat);
         $test = $this->db->get_where('konsistensi_query', ['query' => $kalimat, 'kategori' => $kategori])->num_rows();
        if($test == 0){
            $this->db->insert('konsistensi_query', ['query' => $kalimat, 'keterangan' => $check, 'kategori' => $kategori, 'user' => $user, 'tgl_input' => $datenow]);
        }

    }

    public function getdba()
    {
        $host = $_POST['host'];

        $row = $this->db->get_where('datahost', ['hostname' => $host])->row_array();
        // var_dump($row);
        
        $dsn1 = 'mysqli://'.$row['username'].':'.$row['password'].'@'.$row['hostname'].'/mys_sys';
        $db1 = $this->load->database($dsn1, true);
        
        return $db1->get('mys_projects')->result_array();
    }

    public function save_konsistensi()
    {
        $jumlah = $this->input->post('total_row');
        $project_name = $this->input->post('project_name');
        $kategori = $this->input->post('kategori');


        // var_dump($_POST);
        for ($i=1; $i <=$jumlah ; $i++) { 
            $serial = $this->input->post('SERIAL'.$i);
            $code = $this->input->post('CODE'.$i);
            $cabang = $this->input->post('CABANG'.$i);
            $z3 = $this->input->post('Z3'.$i);
            $variable = $this->input->post('VARIABLE'.$i);
            $kode = $this->input->post('KODE'.$i);
            $check = $this->input->post('CHECK'.$i);


            $unique = $project_name.$serial.$variable.$kode.$check;

            $data = ['project_name' => $project_name,
                    'unique' => $unique,
                    'kategori' => $kategori,
                    'serial' => $serial,
                    'code' => $code,
                    'cabang' => $cabang,
                    'z3' => $z3,
                    'variable' => $variable,
                    'kode' => $kode,
                    'check' => $check
                    ];

            // var_dump($data);

            $get = $this->db->get_where('konsistensi', ['unique' => $unique])->row_array();

            if ($get == NULL) {
                $this->db->insert('konsistensi', $data);
            }


        }
    }

    public function getdata_query()
    {
        $this->db->select('a.*, b.name');
        $this->db->from('konsistensi_query a');
        $this->db->join('user b', 'a.user=b.noid', 'left');
        return $this->db->get()->result_array();
    }

    public function getdata_kelompokquery()
    {
        $this->db->select('*');
        $this->db->from('konsistensi_groupquery');
        $this->db->group_by('kd_group');
        $this->db->order_by('kd_group', 'ASC');
        return $this->db->get()->result_array();
    }

    function get_between_data($string, $start, $end)
        {
        $pos_string = stripos($string, $start);
        $substr_data = substr($string, $pos_string);
        $string_two = substr($substr_data, strlen($start));
        $second_pos = stripos($string_two, $end);
        $string_three = substr($string_two, 0, $second_pos);
        // remove whitespaces from result
        $result_unit = trim($string_three);
        // return result_unit
        return $result_unit;
        }

    public function create_groupquery()
    {
        $id = $this->db->query("SELECT * FROM konsistensi_groupquery ORDER BY kd_group DESC LIMIT 1")->row_array();
        $kd = $id['kd_group'] + 1;
        $nama = $this->input->post('nama_kelompok');
        $datenow = date('Y-m-d');
        $kategori = $this->input->post('kategori');
        $list = $this->input->post('id_query');

        $get = $this->db->get_where('konsistensi_query', ['num' => $list[0]])->row_array();
        $table = $this->get_between_data($get['query'], 'FROM', 'WHERE');

        $hitung = 0;
        foreach ($list as $key => $val) {
        $dum = $this->db->get_where('konsistensi_query', ['num' => $val])->row_array();
        $tab = $this->get_between_data($dum['query'], 'FROM', 'WHERE');

        if ($tab == $table) {
           $hitung = $hitung + 1;
        }

            $data[] = [ 'kd_group' => $kd,
                    'kategori' => $kategori, 
                    'nama_group' => $nama,
                    'kd_list' => $val,
                    'tgl_create' => $datenow
                    ];

            // $this->db->insert('konsistensi_groupquery', $data);
        }

        if ($hitung == count($list)) {
            $this->db->insert_batch('konsistensi_groupquery', $data);
            $respon = array('state' => 1, 'msg' => 'Berhasil Di Simpan');
              return $respon;
            } else {
              $respon = array('state' => 0, 'msg' => 'Gagal Di Simpan. Table Sumber Tidak Boleh Berbeda!');
              return $respon;
            }


    }

    public function edit_groupquery()
    {
        $kd = $this->input->post('kd_group');
        $nama = $this->input->post('nama_kelompok');
        $datenow = date('Y-m-d');
        $list = $this->input->post('id_query');
        $kategori = $this->input->post('kategori');


        $this->db->delete('konsistensi_groupquery', ['kd_group' => $kd]);

        foreach ($list as $key => $val) {
            $data = [ 'kd_group' => $kd, 
                    'nama_group' => $nama,
                    'kategori' => $kategori,
                    'kd_list' => $val,
                    'tgl_create' => $datenow
                    ];

            $this->db->insert('konsistensi_groupquery', $data);
        }
    }

    function string_between_two_string($str, $starting_word, $ending_word)
    {
        $subtring_start = strpos($str, $starting_word);
        //Adding the strating index of the strating word to 
        //its length would give its ending index
        $subtring_start += strlen($starting_word);  
        //Length of our required sub string
        $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;  
        // Return the substring from the index substring_start of length size 
        return substr($str, $subtring_start, $size);  
    }

    public function getprojectkonsistensi()
    {
      return $this->db->group_by('project_name')->get('konsistensi')->result_array();
    }

    public function get_kelompok()
    {
        $kd_group = $_POST['kd_group'];
        $project = $_POST['project'];

        $this->db->select('a.*, b.query AS listquery');
        $this->db->from('konsistensi_groupquery a');
        $this->db->join('konsistensi_query b', 'a.kd_list=b.num', 'left');
        $this->db->join('konsistensi_progress c', 'a.kd_group=c.kd_group AND b.query=c.query', 'left');

        $this->db->where('a.kd_group', $kd_group);
        return $this->db->get()->result_array();

        // return $this->db->query("SELECT a.*, b.query AS listquery FROM konsistensi_groupquery a LEFT JOIN konsistensi_query a ON a.id_list=b.num WHERE a.kd_group='$kd_group'")->result_array();

    }

    public function get_targetgroup()
    {
        $kd_group = $_POST['kd_group'];
        $project = $_POST['project'];

        $this->db->select('*');
        $this->db->from('konsistensi_progress');
        $this->db->where('kd_group', $kd_group);
        $this->db->where('project', $project);

        return $this->db->get()->result_array();

    }

    public function getprogress_query()
    {
        $query = $_POST['query'];
        $project = $_POST['project'];
        $kd_group = $_POST['kd_group'];

        $this->db->select('*');
        $this->db->from('konsistensi_progress');
        $this->db->where('query', $query);
        $this->db->where('project', $project);
        $this->db->where('kd_group', $kd_group);


        return $this->db->get()->row_array();

    }
}
