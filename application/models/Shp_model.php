<?php

class Shp_model extends CI_model
{
    public function getAllData(){
        $id_user = $this->session->userdata('id_user');
        //$user = $this->db->get_where('data_user', ['id_user' => $id_user])->row_array();
        // $id = $user['id_user'];
        return $this->db->query("SELECT a.*, b.nama_skenario, c.nama_project, d.nama_cabang from data_cabang d join ( data_project c join ( data_dialog a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_project = c.id_project ) on a.kode_cabang=d.kode_cabang where a.id_user = $id_user")->result_array();
    }

    public function getAllDataKB(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama as skenariox, c.nama_project, d.nama as cabang, e.nama as kunjunganx from attribute e join( cabang d join ( data_project c join ( summary_2 a join attribute b on a.sub_kunjungan_kode = b.kode ) on a.project_kode = c.kode_project ) on a.cabang_kode=d.kode and a.project_kode=d.project) on a.kunjungan_kode=e.kode where a.shp_id = $id_user")->result_array();
    }

    public function getDataProjectSkenario(){
        $id_user = $this->session->userdata('id_user');
        // $cek_equest = $this->db->get_where('data_aktual', ['id_user' => $id_user, 'id_status' => 1, 'id_status_equest' => 1])->row_array();

        // $dialog = $this->db->get_where('data_aktual', ['id_user' => $id_user, 'id_kunjungan' => 1]);

        return $this->db->query("SELECT a.*, b.nama_skenario, c.nama_project, d.nama_cabang from data_cabang d join ( data_project c join ( data_aktual a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_project = c.id_project ) on a.kode_cabang=d.kode_cabang  where a.id_user = $id_user and a.id_status = 1 and a.id_status_equest = 1")->result_array();
    }

    public function getSkenarioById(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_skenario from data_aktual a join data_skenario b on a.id_skenario = b.id_skenario  where a.id_user = $id_user and a.id_status = 1")->result_array();
    }


    public function tambah(){
        $dataex = explode("-" , htmlspecialchars($this->input->post('jenis', true)));
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'id_project' => $dataex[0],
            'id_skenario' => $dataex[1],
            'kode_cabang' => $dataex[2],
            'teks_dialog' => nl2br(htmlspecialchars( $this->input->post('dialog', true)))
        ];

        $this->db->insert('data_dialog', $data);
    }

    public function ubah($id){
        $data = [
            'id_skenario' => htmlspecialchars($this->input->post('jenis', true)),
            'teks_dialog' => nl2br(htmlspecialchars( $this->input->post('dialog', true)))
        ];
        $this->db->where('id_dialog', $id);
        $this->db->update('data_dialog', $data);
    }

    public function hapus($id){
        $this->db->delete('data_dialog', ['id_dialog' => $id]);
    }

    public function hapusKB($id){
        $cari = $this->db->get_where('summary_2', ['num' => $id])->row_array();
        unlink(FCPATH . '/assets/file/dialog/' . $cari['upload_dialog']);
        unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_layout']);
        unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_ss']);
        unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_slip_transaksi']);
        $this->db->delete('summary_2', ['num' => $id]);
    }

    public function upload($img1, $img2, $img3){
        $dataex = explode("-" , htmlspecialchars($this->input->post('jenis', true)));
        $data = [
            'id_user' => $this->session->userdata('id_user'),
            'id_project' => $dataex[0],
            'id_skenario' => $dataex[1],
            'kode_cabang' => $dataex[2],
            'gambar_transaksi' => $img1,
            'gambar_equest' => $img2,
            'gambar_layout' => $img3,
            'tanggal_buat' => date('Y-m-d')
        ];

        $this->db->insert('data_kunjungan', $data);
    }

    public function datakunjungan(){
        $id_user = $this->session->userdata('id_user');
        $user = $this->db->get_where('data_user', ['id_user' => $id_user])->row_array();
        $id = $user['id_user'];
        return $this->db->query("SELECT a.*, DATE_FORMAT(tanggal_buat, '%d-%m-%Y') as tanggal, b.nama_skenario, c.nama_project from data_project c join (data_kunjungan a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_project = c.id_project where a.id_user = $id order by tanggal ASC")->result_array();
    }

    public function getDataKunjunganById($id){
        return $this->db->query("SELECT a.*, DATE_FORMAT(tanggal_buat, '%d-%m-%Y') as tanggal, b.nama_skenario from data_kunjungan a join data_skenario b on a.id_skenario = b.id_skenario where id_kunjungan = $id")->row_array();
    }

    public function ubahkunjungan($id, $img1, $img2, $img3){
        $cari = $this->db->get_where('data_kunjungan', ['id_kunjungan' => $id])->row_array();

        if( $img1 != '0'){
            unlink(FCPATH . '/assets/file/' . $cari['gambar_transaksi']);
        } else {
            $img1 = $cari['gambar_transaksi'];
        }

        if($img2 != '0'){
            unlink(FCPATH . '/assets/file/' . $cari['gambar_equest']);
        } else {
            $img2 = $cari['gambar_equest'];
        }

        if($img3 != '0'){
            unlink(FCPATH . '/assets/file/' . $cari['gambar_layout']);
        } else {
            $img3 = $cari['gambar_layout'];
        }

        $data = [
            'gambar_transaksi' => $img1,
            'gambar_equest' => $img2,
            'gambar_layout' => $img3,
        ];

        $this->db->where('id_kunjungan', $id);
        $this->db->update('data_kunjungan', $data);
    }

    public function hapuskunjungan($id){
        $cari = $this->db->get_where('data_kunjungan', ['id_kunjungan' => $id])->row_array();
        unlink(FCPATH . '/assets/file/' . $cari['gambar_transaksi']);
        unlink(FCPATH . '/assets/file/' . $cari['gambar_equest']);
        unlink(FCPATH . '/assets/file/' . $cari['gambar_layout']);
        $this->db->delete('data_kunjungan', ['id_kunjungan' => $id]);
    }

    public function getDialogSkenarioKB($kunjungan, $project, $cabang){
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama as skenariox from quest a join attribute b on a.kunjungan = b.kode where a.shp = '$id_user' and a.project = '$project' and a.cabang = '$cabang' and a.r_kategori = '$kunjungan'")->result_array();
        $atmcenter = array('064','065','066','067');
        if (in_array($kunjungan, $atmcenter)){
          return $this->db->query("SELECT a.num, a.project, '$kunjungan' AS kunjungan, a.namacabang AS nama_cabang, at.nama AS skenariox, '$id_user' AS shp, id.Nama AS nama_shp,
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
              AND NOT EXISTS (SELECT b.num FROM summary_2 b WHERE b.project_kode = '$project' AND b.cabang_kode = '$cabang' AND b.shp_id = '$id_user' AND b.sub_kunjungan_kode = '$kunjungan' AND b.kunjungan_kode = '$kunjungan')
          ")->result_array();
        }else{
          return $this->db->query("SELECT a.*, c.nama AS nama_cabang, b.nama as skenariox from quest a join attribute b on a.kunjungan = b.kode JOIN cabang c ON a.project = c.project AND a.cabang = c.kode where a.shp = '$id_user' AND not a.status = 0 and a.project = '$project' and a.cabang = '$cabang' and a.r_kategori = '$kunjungan' AND NOT EXISTS (SELECT b.num FROM summary_2 b WHERE a.project = b.project_kode AND a.cabang = b.cabang_kode AND a.shp = b.shp_id AND a.kunjungan = b.sub_kunjungan_kode and a.r_kategori = b.kunjungan_kode)")->result_array();
        }

    }

    public function getdatakunjungan($kunjungan, $project, $cabang){
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama as skenariox from quest a join attribute b on a.kunjungan = b.kode where a.shp = '$id_user' and a.project = '$project' and a.cabang = '$cabang' and a.r_kategori = '$kunjungan'")->result_array();
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
              AND NOT EXISTS (SELECT b.num FROM summary_2 b WHERE b.project_kode = '$project' AND b.cabang_kode = '$cabang' AND b.shp_id = '$id_user' AND b.sub_kunjungan_kode = '$kunjungan' AND b.kunjungan_kode = '$kunjungan')
          ")->result_array();
        }else{
          return $this->db->query("SELECT a.*, c.nama AS nama_cabang, b.nama as skenariox, d.Nama AS nama_shp from quest a join attribute b on a.r_kategori = b.kode JOIN cabang c ON a.project = c.project AND a.cabang = c.kode JOIN id_data d ON a.shp = d.id where a.shp = '$id_user' AND not a.status = 0 and a.project = '$project' and a.cabang = '$cabang' and a.r_kategori = '$kunjungan' AND NOT EXISTS (SELECT b.num FROM summary_2 b WHERE a.project = b.project_kode AND a.cabang = b.cabang_kode AND a.shp = b.shp_id AND a.kunjungan = b.sub_kunjungan_kode and a.r_kategori = b.kunjungan_kode) GROUP BY a.shp")->result_array();
        }

    }

    public function datakunjunganbyid($id)
    {
        return $this->db->query("SELECT
                                    a.*,
                                    c.nama AS nama_cabang,
                                    b.nama AS skenariox,
                                    d.Nama AS nama_shp

                                FROM
                                    quest a
                                    JOIN summary_2 e ON e.project_kode = a.project AND e.cabang_kode = a.cabang AND e.sub_kunjungan_kode = a.kunjungan
                                    JOIN attribute b ON a.kunjungan = b.kode
                                    JOIN cabang c ON a.project = c.project
                                    AND a.cabang = c.kode
                                    JOIN id_data d ON a.shp = d.id
                                WHERE
                                    e.num = '$id'")->result_array();
    }

    public function tambahKB(){
        $jml = $this->input->post('jumlahsek');
        $jml2 = $this->input->post('jmlupload');
        date_default_timezone_set("Asia/Bangkok");
        $data = [];
        $atmcenter = array('064','065','066','067');
        $kun = $this->input->post('kunjungan', true);
        if (in_array($kun, $atmcenter)){
          for($i=1; $i<=$jml2; $i++){
            $pro = $this->input->post('kode', true);
            $kun = $this->input->post('kunjungan', true);
            $cabang = $this->input->post('cabang', true);
            $user = $this->session->userdata('id_user');
            $num = $this->input->post("num$i", true);
            if($kun == '064'){
              $datac = [
                'status_weekday_siang' => 2
              ];
            }
            else if($kun == '065'){
              $datac = [
                'status_weekend_siang' => 2
              ];
            }
            else if($kun == '066'){
              $datac = [
                'status_weekday_malam' => 2
              ];
            }
            else if($kun == '067'){
              $datac = [
                'status_weekend_malam' => 2
              ];
            }
            $data1 = [
                'waktu_upload' => date('Y-m-d H:i:s'),
                'shp_id' => $user,
                'project_kode' => $pro,
                'cabang_kode' => $cabang,
                'kunjungan_kode' => $kun,
                'sub_kunjungan_kode' => $kun,
                'upload_dialog' => NULL,
                'r_teks_dialog' => NULL
            ];
            $this->db->where(['num' => $num])->update('atmcenter', $datac);
            $this->db->insert('summary_2', $data1);
          }
        }else{
          for($i=1; $i<=$jml; $i++){

            $pro = $this->input->post('kode', true);
            $sek = $this->input->post("skenario$i", true);
            $kun = $this->input->post('kunjungan', true);
            $cabang = $this->input->post('cabang', true);
            $user = $this->session->userdata('id_user');
            // PEMBARUAN 14 DESEMBER 2020
            $r = $i;
            $img1 = '';
            if($sek=='001' or $sek=='002'  or $sek=='003'  or $sek=='004'  or $sek=='051'  or $sek=='052' or $sek=='053' or $sek=='054' or $sek=='055' or $sek=='081' or $sek=='012' or $sek=='061' or $sek=='099' or $sek=='071' or $sek=='072'){
                $img1 = $_FILES["berkas$r"]['name'];
                if ($img1){
                    $config['upload_path']          ='./assets/file/dialog/';
                    $config['allowed_types']        = 'pdf';
                    $config['max-size'] = 0;
                    $this->upload->initialize($config);
                    $this->load->library('upload', $config);

                    if($this->upload->do_upload("berkas$r")) {
                        $img1 = $this->upload->data('file_name');
                    } else {
                        echo $this->upload->display_errors();
                        die;
                    }
                }
            }
            // BACKUP 14 DESEMBER 2020
            // if ($sek == '063' OR $sek == '070') {
            //  $img1 = '';
            // }else {
            //   $r = $i;
            //   $img1 = $_FILES["berkas$r"]['name'];
            //   if ($img1){
            //     $config['upload_path']          ='./assets/file/dialog/';
            //     $config['allowed_types']        = 'pdf';
            //     $config['max-size'] = 0;
            //     $this->upload->initialize($config);
            //     $this->load->library('upload', $config);
            //
            //     if($this->upload->do_upload("berkas$r")) {
            //       $img1 = $this->upload->data('file_name');
            //     } else {
            //       echo $this->upload->display_errors();
            //       die;
            //     }
            //   }
            //
            // }
            // === END BACKUP === //
                $data1 = [
                    'waktu_upload' => date('Y-m-d H:i:s'),
                    'shp_id' => $user,
                    'project_kode' => $pro,
                    'cabang_kode' => $cabang,
                    'kunjungan_kode' => $kun,
                    'sub_kunjungan_kode' => $this->input->post("skenario$i", true),
                    'upload_dialog' => $img1,
                    'r_teks_dialog' => nl2br(htmlspecialchars( $this->input->post("dialog$i", true)))
                ];
                $sken = $this->input->post("skenario$i", true);

                // array_push($data, $data1);
                $this->db->query("UPDATE quest SET status = '2' where project='$pro' and cabang='$cabang' and kunjungan='$sken' and r_kategori='$kun' and shp = '$user'");
                $this->db->insert('summary_2', $data1);
                var_dump($data1);
          }
        }

    }

    public function getDialogKB($id){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.*, c.nama as skenariox from attribute c join ( summary_2 a join project b on a.project_kode=b.kode) on a.sub_kunjungan_kode=c.kode where a.num='$id'")->row_array();
    }

    public function ubahKB($id){
        $cari = $this->db->get_where('summary_2', ['num' => $id])->row_array();

            // unlink(FCPATH . '/assets/file/dialog/' . $cari['upload_dialog']);

        $img1 = $_FILES["berkas"]['name'];
            if ($img1){
                $config['upload_path']          ='./assets/file/dialog/';
                $config['allowed_types']        = 'pdf';
                $config['max-size'] = 0;
                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("berkas")) {
                    $img1 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }

        $data = [
            'upload_dialog' => $img1,
            'r_teks_dialog' => nl2br(htmlspecialchars( $this->input->post('dialog', true))),
            'r_sts_dialog' => null
        ];
        $this->db->where('num', $id);
        $this->db->update('summary_2', $data);

        $cek = $this->db->query("SELECT
                                a.*,
                                c.num AS numq
                            FROM
                                summary_2 a
                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.sub_kunjungan_kode
                            WHERE
                                a.num = '$id'")->row_array();

        if($cek != null){
            $numq = $cek['numq'];
            $this->db->query("UPDATE quest
                            SET `status` = '2'
                            WHERE
                                num = '$numq'");
            }

    }

    public function getDataDialogKB($kunjungan, $project, $cabang){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    a.*,
                                    b.*,
                                    c.nama AS skenariox
                                FROM
                                    attribute c
                                    JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode
                                WHERE
                                    (
                                        a.shp_id = '$id_user'
                                        AND a.kunjungan_kode = '$kunjungan'
                                        AND a.project_kode = '$project'
                                        AND a.cabang_kode = '$cabang'
                                    )
                                    AND (
                                        a.upload_layout IS NULL
                                    OR a.upload_ss IS NULL
                                    OR a.upload_slip_transaksi IS NULL)")->result_array();
    }

     public function getDataProjectBySummary_2KB($kunjungan, $project, $cabang){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.* from summary_2 a join data_project b on a.project_kode=b.kode_project where a.shp_id='$id_user' and a.kunjungan_kode = '$kunjungan' and a.project_kode='$project' and a.cabang_kode = '$cabang' and (a.upload_layout = '' or a.upload_ss = '' or a.upload_slip_transaksi = '') group by a.shp_id, a.kunjungan_kode, a.project_kode, a.cabang_kode")->row_array();
    }

    public function uploadKB(){
        $jml = $this->input->post('jmlupload', true);

        for($i=1; $i<=$jml; $i++){
            $img1 = $_FILES["transaksi$i"]['name'];
            $img2 = $_FILES["equest$i"]['name'];
            $img3 = $_FILES["layout$i"]['name'];
            if ($img1 and $img2 and $img3){
                $config['upload_path']          ='./assets/file/buktitrk/';
                $config['allowed_types']        = 'jpg|gif|png|pdf|doc|docx|jpeg';
                $config['max-size'] = 0;

                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("transaksi$i")) {
                    $img11 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                if($this->upload->do_upload("equest$i")) {
                    $img22 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                if($this->upload->do_upload("layout$i")) {
                    $img33 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }

            $data = [
                'upload_layout' => $img11,
                'upload_ss' => $img22,
                'upload_slip_transaksi' => $img33,
            ];

            $this->db->where('num', $this->input->post("num$i"));
            $this->db->update('summary_2', $data);
        }
    }

    public function uploadKZ(){
        $jml = $this->input->post('jmlupload', true);

        for($i=1; $i<=$jml; $i++){
            if($this->input->post("skenario$i", true)!='038' AND $this->input->post("skenario$i", true)!='039'){
            $img1 = $_FILES["transaksi$i"]['name'];

             if ($img1){
                $config['upload_path']          ='./assets/file/buktitrk/';
                $config['allowed_types']        = 'jpg|gif|png|doc|docx|jpeg|pdf';
                $config['max-size'] = 0;

                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("transaksi$i")) {
                    $img11 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }
        }

            if($this->input->post("skenario$i", true)=='001' or $this->input->post("skenario$i", true)=='002' or $this->input->post("skenario$i", true)=='003' or $this->input->post("skenario$i", true)=='051' or $this->input->post("skenario$i", true)=='052'){
                $img2 = $_FILES["equest$i"]['name'];
                $img3 = $_FILES["layout$i"]['name'];

                if ($img2){
                        $config['upload_path']          ='./assets/file/buktitrk/';
                        $config['allowed_types']        = 'jpg|gif|png|doc|docx|jpeg|pdf';
                        $config['max-size'] = 0;

                        $this->upload->initialize($config);
                        $this->load->library('upload', $config);

                        if($this->upload->do_upload("equest$i")) {
                            $img22 = $this->upload->data('file_name');
                        } else {
                            echo $this->upload->display_errors();
                            die;
                        }
                    }

                    if ($img3){
                        $config['upload_path']          ='./assets/file/buktitrk/';
                        $config['allowed_types']        = 'jpg|gif|png|doc|docx|jpeg|pdf';
                        $config['max-size'] = 0;

                        $this->upload->initialize($config);
                        $this->load->library('upload', $config);

                        if($this->upload->do_upload("layout$i")) {
                            $img33 = $this->upload->data('file_name');
                        } else {
                            echo $this->upload->display_errors();
                            die;
                        }
                    }
            }
            if ($this->input->post("skenario$i", true)=='038' or $this->input->post("skenario$i", true)=='039') {
                $img3 = $_FILES["layout$i"]['name'];
                if ($img3){
                        $config['upload_path']          ='./assets/file/buktitrk/';
                        $config['allowed_types']        = 'jpg|gif|png|doc|docx|jpeg|pdf';
                        $config['max-size'] = 0;

                        $this->upload->initialize($config);
                        $this->load->library('upload', $config);

                        if($this->upload->do_upload("layout$i")) {
                            $img33 = $this->upload->data('file_name');
                        } else {
                            echo $this->upload->display_errors();
                            die;
                        }
                    }
            }

            // if ($img1 and $img2 and $img3){
            // if ($img1){
            //     $config['upload_path']          ='./assets/file/buktitrk/';
            //     $config['allowed_types']        = 'jpg|gif|png|doc|docx|jpeg|pdf';
            //     $config['max-size'] = 0;

            //     $this->upload->initialize($config);
            //     $this->load->library('upload', $config);

            //     if($this->upload->do_upload("transaksi$i")) {
            //         $img11 = $this->upload->data('file_name');
            //     } else {
            //         echo $this->upload->display_errors();
            //         die;
            //     }

            //     if($this->upload->do_upload("equest$i")) {
            //         $img22 = $this->upload->data('file_name');
            //     } else {
            //         echo $this->upload->display_errors();
            //         die;
            //     }

            //     if($this->upload->do_upload("layout$i")) {
            //         $img33 = $this->upload->data('file_name');
            //     } else {
            //         echo $this->upload->display_errors();
            //         die;
            //     }
            // }

            $data = [
                'upload_slip_transaksi' => $img11,
                'upload_layout' => $img33,
                'upload_ss' => $img22,
            ];
            // $s = $i+1;
            $pro = $this->input->post('kode', true);
            $sek = $this->input->post("skenario$i", true);
            $kun = $this->input->post('kunjungan', true);
            $cabang = $this->input->post('cabang', true);
            $user = $this->session->userdata('id_user');
            var_dump($data);
            echo "<br>";
            var_dump($pro);
            var_dump($sek);
            var_dump($kun);
            var_dump($cabang);
            var_dump($user);

            echo "<br>";
            echo "<br>";

            $this->db->update('summary_2', $data, ['project_kode'=>$pro, 'sub_kunjungan_kode'=>$sek, 'kunjungan_kode'=>$kun, 'cabang_kode'=>$cabang, 'shp_id'=>$user]);
        }
    }

    public function datakunjunganKB(){
         $id_user = $this->session->userdata('id_user');
        //  return $this->db->query("SELECT a.*, b.*, c.nama as skenariox, d.nama as kunjunganx from attribute d join ( attribute c join ( summary_2 a join data_project b on a.project_kode=b.kode_project) on a.sub_kunjungan_kode=c.kode ) on a.kunjungan_kode=d.kode where a.shp_id='$id_user'")->result_array();
         return $this->db->query("SELECT a.*, b.*, c.nama as skenariox, d.nama as kunjunganx from attribute d join ( attribute c join ( summary_2 a join project b on a.project_kode=b.kode) on a.sub_kunjungan_kode=c.kode ) on a.kunjungan_kode=d.kode where a.shp_id='$id_user'")->result_array();
    }

    public function datakunjunganByIdKB($id){
         return $this->db->query("SELECT a.*, b.*, c.nama as skenariox, d.nama as kunjunganx, e.nama_project from data_project e join ( attribute d join ( attribute c join ( summary_2 a join data_project b on a.project_kode=b.kode_project) on a.sub_kunjungan_kode=c.kode ) on a.kunjungan_kode=d.kode ) on a.project_kode=e.kode_project where a.num='$id'")->row_array();
    }

     public function getDataDialogByIdKB($id){
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.*, c.nama as skenariox from attribute c join ( summary_2 a join data_project b on a.project_kode=b.kode_project) on a.sub_kunjungan_kode=c.kode where a.num='$id'")->result_array();
        return $this->db->query("SELECT a.*, b.*, c.nama as skenariox from attribute c join ( summary_2 a join project b on a.project_kode=b.kode) on a.sub_kunjungan_kode=c.kode where a.num='$id'")->result_array();
    }

    public function ubahkunjunganKB(){
            $cari = $this->db->get_where('summary_2', ['num' => $this->input->post("num1")])->row_array();

            // unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_layout']);
            // unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_ss']);
            // unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_slip_transaksi']);

            $img1 = $_FILES["transaksi1"]['name'];
            $img2 = $_FILES["equest1"]['name'];
            $img3 = $_FILES["layout1"]['name'];
            if ($img1 and $img2 and $img3){
                $config['upload_path']          ='./assets/file/buktitrk/';
                $config['allowed_types']        = 'jpg|gif|png|pdf|doc|docx|jpeg';
                $config['max-size'] = 0;

                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("transaksi1")) {
                    $img11 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                if($this->upload->do_upload("equest1")) {
                    $img22 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                if($this->upload->do_upload("layout1")) {
                    $img33 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }

            $data = [
                'upload_layout' => $img11,
                'upload_ss' => $img22,
                'upload_slip_transaksi' => $img33,
                'r_sts_upload_layout'=> NULL,
                'r_sts_upload_ss' => NULL,
                'r_sts_upload_slip_transaksi' => NULL,
            ];

            $this->db->where('num', $this->input->post("num1"));
            $this->db->update('summary_2', $data);
    }

    public function ubahkunjunganKBNew(){
        $cari = $this->db->get_where('summary_2', ['num' => $this->input->post("num1")])->row_array();
        // var_dump($cari); die;

        // unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_layout']);
        // unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_ss']);
        // unlink(FCPATH . '/assets/file/buktitrk/' . $cari['upload_slip_transaksi']);


        if($cari['r_sts_upload_layout']=='0'){
            $img3 = $_FILES["layout1"]['name'];

            if($img3){
                $config['upload_path']          ='./assets/file/buktitrk/';
                $config['allowed_types']        = 'jpg|gif|png|pdf|doc|docx|jpeg';
                $config['max-size'] = 0;

                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("layout1")) {
                $img33 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                $data = [
                    'upload_layout' => $img33,
                    'upload_ulang_layout' => 'Y',
                    'r_sts_upload_layout'=> NULL,
                ];

                $this->db->where('num', $this->input->post("num1"));
                $this->db->update('summary_2', $data);
            }
        }

        if($cari['r_sts_upload_ss']=='0'){
            $img2 = $_FILES["equest1"]['name'];

            if($img2){
                $config['upload_path']          ='./assets/file/buktitrk/';
                $config['allowed_types']        = 'jpg|gif|png|pdf|doc|docx|jpeg';
                $config['max-size'] = 0;

                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("equest1")) {
                $img22 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                $data = [
                    'upload_ss' => $img22,
                    'upload_ulang_ss' => 'Y',
                    'r_sts_upload_ss'=> NULL,
                ];

                $this->db->where('num', $this->input->post("num1"));
                $this->db->update('summary_2', $data);
            }
        }

        if($cari['r_sts_upload_slip_transaksi']=='0'){
            $img1 = $_FILES["transaksi1"]['name'];
            // var_dump($img1); die;

            if($img1){
                $config['upload_path']          ='./assets/file/buktitrk/';
                $config['allowed_types']        = 'jpg|gif|png|pdf|doc|docx|jpeg';
                $config['max-size'] = 0;

                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("transaksi1")) {
                $img11 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }

                $data = [
                    'upload_slip_transaksi' => $img11,
                    'upload_ulang_slip' => 'Y',
                    'r_sts_upload_slip_transaksi'=> NULL,
                ];

                $this->db->where('num', $this->input->post("num1"));
                $this->db->update('summary_2', $data);
            }
        }

}

    public function getAllDataKunjunganKB(){
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama as skenariox, c.nama_project, d.nama as cabang, e.nama as kunjunganx from attribute e join( cabang d join ( data_project c join ( summary_2 a join attribute b on a.sub_kunjungan_kode = b.kode ) on a.project_kode = c.kode_project ) on a.cabang_kode=d.kode and a.project_kode=d.project) on a.kunjungan_kode=e.kode where a.shp_id = $id_user")->result_array();
        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS skenariox,
                                    c.nama AS nama_project,
                                    d.nama AS cabang,
                                    e.nama AS kunjunganx
                                FROM
                                    attribute e
                                    JOIN (
                                        cabang d
                                        JOIN ( project c JOIN ( summary_2 a JOIN attribute b ON a.sub_kunjungan_kode = b.kode ) ON a.project_kode = c.kode AND c.type = 'n' AND c.visible = 'y' ) ON a.cabang_kode = d.kode
                                        AND a.project_kode = d.project
                                    ) ON a.kunjungan_kode = e.kode
                                WHERE
                                    a.shp_id = '$id_user'")->result_array();
    // }
    }

    public function upfototemuan(){
        $jml = $this->input->post('jumlahtemuan', true);

        // var_dump($jml);
        // die;

        for($i=1; $i<=$jml; $i++){
            $img1 = $_FILES["filetemuan$i"]['name'];

            if ($img1){
                $config['upload_path']          ='./assets/file/foto_temuan/';
                $config['allowed_types']        = 'jpg|gif|png|doc|docx|jpeg|pdf';
                $config['max-size'] = 0;

                $this->upload->initialize($config);
                $this->load->library('upload', $config);

                if($this->upload->do_upload("filetemuan$i")) {
                    $img11 = $this->upload->data('file_name');
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }

            $data = [
                'shp' => $this->session->userdata('id_user'),
                'project' => $this->input->post('sproject', true),
                'cabang' => $this->input->post('rekamancabang', true),
                'kunjungan' => $this->input->post('skunjungan', true),
                'skenario' => $this->input->post('temskenario', true),
                'ket_temuan' => $this->input->post("kettemuan$i", true),
                'foto_temuan' => $img11,
            ];
            $this->db->insert('data_foto_temuan', $data);
        }
    }

    public function getdatatemuan()
    {
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    b.nama AS project,
                                    a.cabang as kode_cabang,
                                    c.nama AS cabang,
                                    a.kunjungan as kunj,
                                    d.nama AS kunjungan,
                                    e.nama AS skenario,
                                    a.ket_temuan,
                                    a.foto_temuan
                                FROM
                                    data_foto_temuan a
                                    JOIN project b ON b.kode = a.project
                                    AND b.type = 'n'
                                    AND b.visible = 'y'
                                    JOIN cabang c ON c.project = a.project
                                    AND c.kode = a.cabang
                                    JOIN attribute d ON a.kunjungan = d.kode
                                    JOIN attribute e ON a.skenario = e.kode
                                WHERE
                                    a.shp = '$id_user'
                                ORDER BY
                                    a.project ASC")->result_array();
    }

    public function getdatatemuanRA()
    {
        return $this->db->query("SELECT
                                    b.nama AS project,
                                    a.cabang as kode_cabang,
                                    c.nama AS cabang,
                                    a.kunjungan as kunj,
                                    d.nama AS kunjungan,
                                    e.nama AS skenario,
                                    a.ket_temuan,
                                    a.foto_temuan
                                FROM
                                    data_foto_temuan a
                                    JOIN project b ON b.kode = a.project
                                    AND b.type = 'n'
                                    AND b.visible = 'y'
                                    JOIN cabang c ON c.project = a.project
                                    AND c.kode = a.cabang
                                    JOIN attribute d ON a.kunjungan = d.kode
                                    JOIN attribute e ON a.skenario = e.kode
                                ORDER BY
                                    a.project ASC")->result_array();
    }

    public function getDialogById($id){
        return $this->db->get_where('summary_2',['num'=>$id])->row_array();
    }

}
