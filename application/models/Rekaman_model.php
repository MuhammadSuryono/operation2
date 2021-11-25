<?php

class Rekaman_model extends CI_model
{
    public function getDataProject(){
        return $this->db->get('data_project')->result_array();
        //  $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama_project from data_aktual a join data_project b on a.id_project = b.id_project where a.id_user = $id_user and a.id_status = 1")->result_array();
    }

    public function tambah($img){
        $dataex = explode("-", $this->input->post('project'));
        $data = [
            'id_project' => $dataex[0],
            'id_skenario' => $dataex[1],
            'id_user' => $this->session->userdata('id_user'),
            'kode_cabang' => $dataex[2],
            'file_rekaman' => $img,
            'tanggal_input' => date('Y-m-d')
        ];

        $this->db->insert('data_rekaman', $data);
    }

    public function getDataRekaman(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_project, c.nama_skenario, d.nama_cabang FROM data_cabang d join (data_skenario c join ( `data_rekaman` a join data_project b on a.id_project = b.id_project ) on a.id_skenario = c.id_skenario) on a.kode_cabang=d.kode_cabang where id_user = $id_user")->result_array();
    }

    public function getDataRekamanKB(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as cabang, e.nama as kunjunganx FROM attribute e join( cabang d join (attribute c join ( `data_rekaman` a join data_project b on a.id_project = b.kode_project ) on a.id_skenario = c.kode) on a.kode_cabang=d.kode and a.id_project = d.project ) on a.kunjungan = e.kode where a.id_user = '$id_user'")->result_array();
    }

    public function getRekamanKB2($kunjungan, $project, $cabang){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama as skenariox from quest a join attribute b on a.kunjungan = b.kode where a.shp = '$id_user' and not a.status = 0 and a.project = '$project' and a.cabang = '$cabang' and a.kunjungan = '$kunjungan' and a.rekaman_status = 2")->result_array();
    }

    public function getRekamanKB3($kunjungan, $project, $cabang){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama as skenariox from quest a join attribute b on a.kunjungan = b.kode where a.shp = '$id_user' and not a.status = 0 and a.project = '$project' and a.cabang = '$cabang' and a.kunjungan = '$kunjungan' and a.rekaman_status = 0")->result_array();
    }

    public function getDataProjectSkenarioKB(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as cabangx, e.nama as kunjunganx from attribute e join(cabang d join (attribute c join (quest a join data_project b on a.project = b.kode_project) on a.kunjungan = c.kode) on a.cabang = d.kode and a.project = d.project) on a.r_kategori = e.kode where a.rekaman='false' and a.shp='$id_user'")->result_array();
    }

    public function hapus($id){
         $cari = $this->db->get_where('data_rekaman', ['id_rekaman' => $id])->row_array();
         unlink(FCPATH . '/assets/file/rekaman/' . $cari['file_rekaman']);
        $this->db->delete('data_rekaman', ['id_rekaman' => $id]);
    }

    public function edit($img){
        $cari = $this->db->get_where('data_rekaman', ['id_rekaman' => $this->input->post('id')])->row_array();

        if($img != '0'){
            unlink(FCPATH . '/assets/file/rekaman/' . $cari['file_rekaman']);
        } else {
            $img = $cari['file_rekaman'];
        }

        $data = [
            'id_project' => $this->input->post('project'),
            'id_user' => 1,
            'file_rekaman' => $img,
            'tanggal_input' => date('Y-m-d')
        ];

        $this->db->where('id_rekaman', $this->input->post('id'));
        $this->db->update('data_rekaman', $data);
    }

    public function tambahKB($img){
        $dataex = explode("-", $this->input->post('project'));
        $iduser = $this->session->userdata('id_user');
        $data = [
            'id_project' => $dataex[0],
            'kode_cabang' => $dataex[1],
            'id_skenario' => $dataex[2],
            'kunjungan' => $dataex[3],
            'id_user' => $iduser,
            'file_rekaman' => $img,
            'tanggal_input' => date('Y-m-d')
        ];

        $this->db->insert('data_rekaman', $data);
        $this->db->query("UPDATE quest SET rekaman = true where project='$dataex[0]' and cabang='$dataex[1]' and kunjungan='$dataex[2]' and r_kategori='$dataex[3]' and shp = '$iduser'");
    }

    public function editKB($img1, $img3){
        date_default_timezone_set("Asia/Bangkok");
        $cari = $this->db->get_where('data_rekaman', ['id_rekaman' => $this->input->post('id')])->row_array();

        // var_dump($img1);
        // var_dump($img2);
        // die;

        // if($img1 != '0'){
        //     unlink(FCPATH . '/assets/file/rekaman/' . $cari['file_rekaman']);
        // } else {
        //     $img1 = $cari['file_rekaman'];
        // }

        $data = [
            'file_rekaman' => $img3,
        ];

        $this->db->where('id_rekaman', $this->input->post('id'));
        $this->db->update('data_rekaman', $data);

        $rek = $this->db->get_where('data_rekaman', ['id_rekaman'=>$this->input->post('id')])->row_array();
        $update = [
            'rekaman_status' => 1,
        ];

        $tglrekk = date('Y-m-d');
        $tglrek = [
            'tglrekaman' => $tglrekk,
        ];

        $this->db->update('quest', $update, ['project'=>$rek['id_project'], 'cabang'=>$rek['kode_cabang'], 'kunjungan'=>$rek['id_skenario'], 'shp'=>$rek['id_user'], 'r_kategori'=>$rek['kunjungan']]);
        $this->db->update('quest', $tglrek, ['project'=>$rek['id_project'], 'cabang'=>$rek['kode_cabang'], 'kunjungan'=>$rek['id_skenario'], 'shp'=>$rek['id_user'], 'r_kategori'=>$rek['kunjungan']]);

    }

    public function getRekamanKB($kunjungan, $project, $cabang){
        $id_user = $this->session->userdata('id_user');
        $atmcenter = array('064','065','066','067');
        if (in_array($kunjungan, $atmcenter)){
          return $this->db->query("SELECT a.num, '$kunjungan' AS kunjungan, a.namacabang AS nama_cabang, at.nama AS skenariox, '$id_user' AS shp, id.Nama AS nama_shp,
            CASE
                WHEN a.weekend_siang = '$kunjungan' AND a.shp_weekend_siang = '$id_user' THEN a.noform_weekend_siang
                WHEN a.weekend_malam = '$kunjungan' AND a.shp_weekend_malam = '$id_user' THEN a.noform_weekend_malam
                WHEN a.weekday_siang = '$kunjungan' AND a.shp_weekday_siang = '$id_user' THEN a.noform_weekday_siang
                WHEN a.weekday_malam = '$kunjungan' AND a.shp_weekday_malam = '$id_user' THEN a.noform_weekday_malam
                ELSE NULL
            END AS form,
            CASE
                WHEN a.weekend_siang = '$kunjungan' AND a.shp_weekend_siang = '$id_user' THEN a.tgl_weekend_siang
                WHEN a.weekend_malam = '$kunjungan' AND a.shp_weekend_malam = '$id_user' THEN a.tgl_weekend_malam
                WHEN a.weekday_siang = '$kunjungan' AND a.shp_weekday_siang = '$id_user' THEN a.tgl_weekday_siang
                WHEN a.weekday_malam = '$kunjungan' AND a.shp_weekday_malam = '$id_user' THEN a.tgl_weekday_malam
                ELSE NULL
            END AS tanggal
            FROM attribute at
              JOIN atmcenter a ON a.project = '$project' AND a.cabang = '$cabang'
              JOIN id_data id ON id.id = '$id_user'
            WHERE
              a.project = '$project' AND a.cabang = '$cabang' AND at.kode = '$kunjungan'
              AND ((a.weekend_siang = '$kunjungan' AND a.shp_weekend_siang = '$id_user' AND a.status_weekend_siang = 1)
                  OR (a.weekend_malam = '$kunjungan' AND a.shp_weekend_malam = '$id_user' AND a.status_weekend_malam = 1)
                  OR (a.weekday_siang = '$kunjungan' AND a.shp_weekday_siang = '$id_user' AND a.status_weekday_siang = 1)
                  OR (a.weekday_malam = '$kunjungan' AND a.shp_weekday_malam = '$id_user' AND a.status_weekday_malam = 1))
          ")->result_array();
        }else{
          return $this->db->query("SELECT a.*, b.nama as skenariox from quest a join attribute b on a.kunjungan = b.kode where a.shp = '$id_user' and a.rekaman = 'false' and not a.status = 0 and a.project = '$project' and a.cabang = '$cabang' and a.r_kategori = '$kunjungan' and a.rekaman = 'false'")->result_array();
        }
    }

    public function datakunjungan($kunjungan, $project, $cabang){
        $id_user = $this->session->userdata('id_user');
        $atmcenter = array('064','065','066','067');
        if (in_array($kunjungan, $atmcenter)){
          return $this->db->query("SELECT a.namacabang AS nama_cabang, at.nama AS skenariox, '$id_user' AS shp, id.Nama AS nama_shp,
            CASE
                WHEN a.weekend_siang = '$kunjungan' AND a.shp_weekend_siang = '$id_user' THEN a.noform_weekend_siang
                WHEN a.weekend_malam = '$kunjungan' AND a.shp_weekend_malam = '$id_user' THEN a.noform_weekend_malam
                WHEN a.weekday_siang = '$kunjungan' AND a.shp_weekday_siang = '$id_user' THEN a.noform_weekday_siang
                WHEN a.weekday_malam = '$kunjungan' AND a.shp_weekday_malam = '$id_user' THEN a.noform_weekday_malam
                ELSE NULL
            END AS form,
            CASE
                WHEN a.weekend_siang = '$kunjungan' AND a.shp_weekend_siang = '$id_user' THEN a.tgl_weekend_siang
                WHEN a.weekend_malam = '$kunjungan' AND a.shp_weekend_malam = '$id_user' THEN a.tgl_weekend_malam
                WHEN a.weekday_siang = '$kunjungan' AND a.shp_weekday_siang = '$id_user' THEN a.tgl_weekday_siang
                WHEN a.weekday_malam = '$kunjungan' AND a.shp_weekday_malam = '$id_user' THEN a.tgl_weekday_malam
                ELSE NULL
            END AS tanggal
            FROM attribute at
              JOIN atmcenter a ON a.project = '$project' AND a.cabang = '$cabang'
              JOIN id_data id ON id.id = '$id_user'
            WHERE
              a.project = '$project' AND a.cabang = '$cabang' AND at.kode = '$kunjungan'
              AND ((a.weekend_siang = '$kunjungan' AND a.shp_weekend_siang = '$id_user' AND a.status_weekend_siang = 1)
                  OR (a.weekend_malam = '$kunjungan' AND a.shp_weekend_malam = '$id_user' AND a.status_weekend_malam = 1)
                  OR (a.weekday_siang = '$kunjungan' AND a.shp_weekday_siang = '$id_user' AND a.status_weekday_siang = 1)
                  OR (a.weekday_malam = '$kunjungan' AND a.shp_weekday_malam = '$id_user' AND a.status_weekday_malam = 1))
          ")->result_array();
        }else{
          return $this->db->query("SELECT
                                  	a.*,
                                  	b.nama AS skenariox,
                                      c.nama AS nama_cabang,
  	                                d.Nama AS nama_shp
                                  FROM
                                  	quest a
                                  	JOIN attribute b ON a.kunjungan = b.kode
                                      JOIN cabang c ON a.project = c.project
  	                                AND a.cabang = c.kode
  	                                JOIN id_data d ON a.shp = d.id
                                  WHERE
                                  	a.shp = '$id_user'
                                  	AND a.rekaman = 'false'
                                  	AND NOT a.STATUS = 0
                                  	AND a.project = '$project'
                                  	AND a.cabang = '$cabang'
                                  	AND a.r_kategori = '$kunjungan'
                                      AND a.rekaman = 'false'
                                  GROUP BY
  	                            a.shp")->result_array();
        }
    }

    public function tambahKB1_bak(){
        $jml = $this->input->post('jumlahsek');
        date_default_timezone_set("Asia/Bangkok");
        $data = [];
        for($i=1; $i<=$jml; $i++){

            $pro = $this->input->post('kode', true);
            $sek = $this->input->post("skenario$i", true);
            $kun = $this->input->post('kunjungan', true);
            $cabang = $this->input->post('cabang', true);
            $user = $this->session->userdata('id_user');

            $r = $i;
            $img1 = $_FILES["berkas$r"]['name'];
            // var_dump($img1); die;
            if ($img1){
                $config['upload_path']          ='assets/file/rekaman/';
                    if ($pro !== 'AND1' && $kun != '071'  && $kun != '072'  && $kun != '073' ) {
                        $config['allowed_types']        = 'mp4|m4a|mov|mpeg|3gp|avi|mkv';
                    }else{
                        $config['allowed_types']        = 'mp3|wav|ogg|mp4|m4a|mov|amr|mpeg|3gp|avi|mkv|mpga|mpg';
                        // $config['allowed_types']        = 'mp3|wav|ogg|mp4|m4a|mov|amr|mpeg|3gp|avi|mkv';
                    }
                // $config['allowed_types']        = '';
                $config['max-size']             = 0;

                // $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("berkas$r")) {
                    $img1 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                if($this->upload->do_upload("berkas$r")) {
                    $img1 = $this->upload->data('file_name');
                    $img2 = $pro."-".$cabang."-".$kun."-".$sek."-".$img1;

                    //Garul ---- harus ngatur upload_max_filesize sama memory_limit dulu di xampp
                    //File path at local server
                    $source ='assets/file/rekaman/'.$img1;

                    //Load codeigniter FTP class
                    $this->load->library('ftp');

                    //FTP configuration
                    $config['hostname'] = '192.168.8.101';
                    $config['username'] = 'dataauviq';
                    $config['password'] = 'AuviqValidation';
                    $config['debug']    = TRUE;

                    //Connect to the remote server
                    $this->ftp->connect($config);

                    //File upload path of remote server
                    $destination = '/assets/'.$img2;

                    //Upload file to the remote server
                    $this->ftp->upload($source, ".".$destination);

                    //Close FTP connection
                    $this->ftp->close();

                    //Delete file from local server
                    @unlink($source);

                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }

            // $pro = $this->input->post('kode', true);
            // $sek = $this->input->post("skenario$i", true);
            // $kun = $this->input->post('kunjungan', true);
            // $cabang = $this->input->post('cabang', true);
            // $user = $this->session->userdata('id_user');

            $data1 = [

                'id_project' => $pro,
                'id_skenario' => $sek,
                'id_user' => $user,
                'kode_cabang' => $cabang,
                'kunjungan' => $kun,
                'file_rekaman' => $img2,
                'tanggal_input' => date('Y-m-d')
            ];

            $tglrekaman = date('Y-m-d');

            array_push($data, $data1);
            $this->db->query("UPDATE quest SET rekaman = 'true' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");
            $this->db->query("UPDATE quest SET rekaman_status = '1' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");
            $this->db->query("UPDATE quest SET tglrekaman = '$tglrekaman' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");
        }

        $this->db->insert_batch('data_rekaman', $data);
    }

    public function tambahKB1(){

        $jml = $this->input->post('jumlahsek');
        date_default_timezone_set("Asia/Bangkok");
        $data = [];
        for($i=1; $i<=$jml; $i++){

            $pro = $this->input->post('kode', true);
            $sek = $this->input->post("skenario$i", true);
            $kun = $this->input->post('kunjungan', true);
            $cabang = $this->input->post('cabang', true);
            $user = $this->session->userdata('id_user');

            $r = $i;

            $berkas = isset($_FILES["berkas$r"]['error']) != 0 ? $_FILES["berkas$r"] : NULL;

            $file_tmp           = $berkas['tmp_name'];
            $file_ext           = pathinfo($berkas['name'], PATHINFO_EXTENSION);
            $file_save1          = $pro."-".$cabang."-".$kun."-".$sek.".".$file_ext;

            move_uploaded_file($file_tmp,"assets/file/rekaman/".$file_save1);

            //File path at local server
            $source ='assets/file/rekaman/'.$file_save1;

            //Load codeigniter FTP class
            $this->load->library('ftp');

            //FTP configuration
            $config['hostname'] = '192.168.8.101';
            $config['username'] = 'dataauviq';
            $config['password'] = 'AuviqValidation';
            $config['debug']    = TRUE;

            //Connect to the remote server
            $this->ftp->connect($config);
            //File upload path of remote server
            $destination = '/assets/'.$file_save1;

            //Upload file to the remote server
            $this->ftp->upload($source, ".".$destination);

            //Close FTP connection
            $this->ftp->close();

            //Delete file from local server
            @unlink($source);

            $data1 = [

                'id_project' => $pro,
                'id_skenario' => $sek,
                'id_user' => $user,
                'kode_cabang' => $cabang,
                'kunjungan' => $kun,
                'file_rekaman' => $file_save1,
                'tanggal_input' => date('Y-m-d')
            ];

            $tglrekaman = date('Y-m-d');

            array_push($data, $data1);
            // $this->db->query("UPDATE quest SET rekaman = 'true' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");
            $this->db->query("UPDATE quest SET rekaman_status = '1' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");
            $this->db->query("UPDATE quest SET tglrekaman = '$tglrekaman' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");
        }

        $this->db->insert_batch('data_rekaman', $data);
    }

    public function tambahKB2(){

        $jml = $this->input->post('jumlahsek');
        date_default_timezone_set("Asia/Bangkok");
        $data = [];
        $atmcenter = array('064','065','066','067');
        for($i=1; $i<=$jml; $i++){

            $pro = $this->input->post('kode', true);
            $sek = $this->input->post("skenario$i", true);
            $kun = $this->input->post('kunjungan', true);
            $cabang = $this->input->post('cabang', true);
            $user = $this->session->userdata('id_user');

            $r = $i;

            $config['upload_path']          ='assets/file/rekaman/';
            $config['allowed_types']        = 'jpg|jpeg|png|gif';
            $config['max-size']             = 0;

            // $this->upload->initialize($config);
            $this->load->library('upload', $config);

            if($this->upload->do_upload("berkas$r")) {
                $img1 = $this->upload->data('file_name');
            } else {
                echo $this->upload->display_errors();
                die;
            }

            $data1 = [
                'id_project' => $pro,
                'id_skenario' => $sek,
                'id_user' => $user,
                'kode_cabang' => $cabang,
                'kunjungan' => $kun,
                'file_rekaman' => $img1,
                'tanggal_input' => date('Y-m-d')
            ];

            $tglrekaman = date('Y-m-d');

            array_push($data, $data1);
            if (in_array($kun, $atmcenter)){
              $num = $this->input->post("number$i", true);
              $noform = unserialize($this->input->post("formnya$i", true));

              $noform['rekaman_status'] = 4;
              $noform = serialize($noform);

              if($kun == '064'){
                $datac = [
                  'noform_weekday_siang' => $noform
                ];
              }
              else if($kun == '065'){
                $datac = [
                  'noform_weekend_siang' => $noform
                ];
              }
              else if($kun == '066'){
                $datac = [
                  'noform_weekday_malam' => $noform
                ];
              }
              else if($kun == '067'){
                $datac = [
                  'noform_weekend_malam' => $noform
                ];
              }

              $this->db->where(['num' => $num])->update('atmcenter', $datac);

            }else{
              $this->db->query("UPDATE quest SET rekaman_status = '4' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");
              // $this->db->query("UPDATE quest SET tglinputrekaman = '$tglrekaman' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");
            }
        }

        $this->db->insert_batch('data_rekaman', $data);
    }

    public function ubahrekamanKB(){

        $jml = $this->input->post('jumlahsek');
        date_default_timezone_set("Asia/Bangkok");
        $data = [];
        for($i=1; $i<=$jml; $i++){

            $pro = $this->input->post('kode', true);
            $sek = $this->input->post("skenario$i", true);
            $kun = $this->input->post('kunjungan', true);
            $cabang = $this->input->post('cabang', true);
            $user = $this->session->userdata('id_user');

            $r = $i;

            // $config['upload_path']          = 'assets/file/rekaman/';
            // $config['allowed_types']        = 'jpg|jpeg|png|gif';
            // $config['max-size']             = 0;

            // // // $this->upload->initialize($config);
            // // $this->load->library('upload', $config);

            // // if($this->upload->do_upload("berkas$r")) {
            // //     $img1 = $this->upload->data('file_name');
            // // } else {
            // //     echo $this->upload->display_errors();
            // //     die;
            // // }

    //     //UPLOAD ULANG REKAMAN
        $extension_rek  = pathinfo($_FILES['berkas'.$r]['name'], PATHINFO_EXTENSION);
        // $rek_name = "upload_ulangrek_" . time() . "." . $extension_rek;
        $rek_name = $pro."_".$sek."_".$cabang. "_". "uploadulang" . "." . $extension_rek;
        $rek_tmp = $_FILES['berkas'.$r]['tmp_name'];
        move_uploaded_file($rek_tmp, "assets/file/rekaman/" . $rek_name);

            $data1 = [

                'id_project' => $pro,
                'id_skenario' => $sek,
                'id_user' => $user,
                'kode_cabang' => $cabang,
                'kunjungan' => $kun,
                'file_rekaman' => $rek_name,
                'tanggal_input' => date('Y-m-d')
            ];

            $tglrekaman = date('Y-m-d');

            // var_dump($data1);
            // die;

            // array_push($data, $data1);
            $this->db->query("UPDATE quest SET rekaman_status = '1', upload_ulang_rekaman='Y' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");

            $this->db->query("UPDATE quest SET tglrekaman = '$tglrekaman' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");

            // $this->db->query("UPDATE data_rekaman SET file_rekaman = '$img1' where id_project='$pro' and id_skenario='$sek' and id_user='$user' and kode_cabang='$cabang' and kunjungan = '$kun'");
            $this->db->query("UPDATE data_rekaman SET file_rekaman = '$rek_name' where id_project='$pro' and id_skenario='$sek' and id_user='$user' and kode_cabang='$cabang' and kunjungan = '$kun'");

            $this->db->query("UPDATE data_rekaman SET tanggal_input = '$tglrekaman' where id_project='$pro' and id_skenario='$sek' and id_user='$user' and kode_cabang='$cabang' and kunjungan = '$kun'");
        }

    }

}
