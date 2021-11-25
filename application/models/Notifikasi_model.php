<?php

class Notifikasi_model extends CI_model
{
    public function getAllData(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->get_where('data_jawaban_equest', ['id_user' => $id_user, 'ket_cek !=' => '', 'sts' => '3'])->result_array();
    }

    public function getAllData2(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->get_where('quest', ['shp' => $id_user, 'rekaman_status' => '3'])->result_array();
    }

    public function getAllData1(){
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT * from summary_2 where shp_id = '$id_user' and (r_sts_dialog = 0 or r_sts_upload_layout = 0 or r_sts_upload_ss = 0 or r_sts_upload_slip_transaksi = 0)")->result_array();
    }

    public function simpan(){
        $id = $this->input->post('id_jawaban');
        $ket_jawab = $this->db->get_where('data_jawaban_equest', ['id_jawaban' => $id])->row_array();
        $ket_jawab = $ket_jawab['ket_jawab'].$this->input->post('id_cek')."-".$this->input->post('jawab')."|";

        $data = [
            'ket_jawab' => $ket_jawab
        ];

        $this->db->where('id_jawaban', $id);
        $this->db->update('data_jawaban_equest', $data);
    }

    public function getDataTemuanDialog(){
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as kunjunganx, e.nama_user, f.nama as cabangx from cabang f join ( data_user e join ( attribute d join ( attribute c join (summary_2 a join data_project b on a.project_kode=b.kode_project) on a.sub_kunjungan_kode = c.kode) on a.kunjungan_kode=d.kode) on a.shp_id=e.id_user) on a.cabang_kode=f.kode and a.project_kode=f.project where a.r_sts_temuan = 1 and b.id_user='$id_user'")->result_array();
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as kunjunganx, e.nama_user, f.nama as cabangx from cabang f join ( data_user e join ( attribute d join ( attribute c join (summary_2 a join data_project b on a.project_kode=b.kode_project) on a.sub_kunjungan_kode = c.kode) on a.kunjungan_kode=d.kode) on a.shp_id=e.id_user) on a.cabang_kode=f.kode and a.project_kode=f.project where a.r_sts_temuan = 1")->result_array();
        // return $this->db->query("SELECT
        //                             a.*,
        //                             b.nama AS nama_project,
        //                             c.nama AS skenariox,
        //                             d.nama AS kunjunganx,
        //                             e.Nama AS nama_user,
        //                             f.nama AS cabangx 
        //                         FROM
        //                             cabang f
        //                             JOIN (
        //                                 id_data e
        //                                 JOIN (
        //                                     attribute d
        //                                     JOIN ( attribute c JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode ) ON a.kunjungan_kode = d.kode 
        //                                 ) ON a.shp_id = e.Id 
        //                             ) ON a.cabang_kode = f.kode 
        //                             AND a.project_kode = f.project 
        //                         WHERE
        //                             a.r_sts_temuan = 1")->result_array();

        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx 
                                FROM
                                    project g
                                        JOIN (
                                            cabang f
                                            JOIN (
                                                id_data e
                                                JOIN (
                                                    attribute d
                                                    JOIN ( attribute c JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode ) ON a.kunjungan_kode = d.kode 
                                                ) ON a.shp_id = e.Id 
                                            ) ON a.cabang_kode = f.kode 
                                            AND a.project_kode = f.project 
                                        ) ON g.kode = a.project_kode 
                                        AND g.type = 'n' 
                                        AND g.visible = 'y' 
                                WHERE
                                    a.r_sts_temuan = 1")->result_array();
    }

    public function getDataTemuanRekaman(){
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as kunjunganx, e.nama_user, f.nama as cabangx from cabang f join ( data_user e join ( attribute d join ( attribute c join (quest a join data_project b on a.project=b.kode_project) on a.kunjungan = c.kode) on a.r_kategori=d.kode) on a.shp=e.id_user) on a.cabang=f.kode and a.project=f.project where a.r_sts_temuan = 1 and b.id_user = '$id_user'")->result_array();
        
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as kunjunganx, e.nama_user, f.nama as cabangx from cabang f join ( data_user e join ( attribute d join ( attribute c join (quest a join data_project b on a.project=b.kode_project) on a.kunjungan = c.kode) on a.r_kategori=d.kode) on a.shp=e.id_user) on a.cabang=f.kode and a.project=f.project where a.r_sts_temuan = 1")->result_array();
        // return $this->db->query("SELECT
        //                             a.*,
        //                             b.nama AS nama_project,
        //                             c.nama AS skenariox,
        //                             d.nama AS kunjunganx,
        //                             e.Nama AS nama_user,
        //                             f.nama AS cabangx 
        //                         FROM
        //                             cabang f
        //                             JOIN (
        //                                 id_data e
        //                                 JOIN (
        //                                     attribute d
        //                                     JOIN ( attribute c JOIN ( quest a JOIN project b ON a.project = b.kode ) ON a.kunjungan = c.kode ) ON a.r_kategori = d.kode 
        //                                 ) ON a.shp = e.Id 
        //                             ) ON a.cabang = f.kode 
        //                             AND a.project = f.project 
        //                         WHERE
        //                             a.r_sts_temuan = 1")->result_array();

        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx 
                                FROM
                                    project g
                                    JOIN (
                                        cabang f
                                        JOIN (
                                            id_data e
                                            JOIN (
                                                attribute d
                                                JOIN ( attribute c JOIN ( quest a JOIN project b ON a.project = b.kode ) ON a.kunjungan = c.kode ) ON a.r_kategori = d.kode 
                                            ) ON a.shp = e.Id 
                                        ) ON a.cabang = f.kode 
                                        AND a.project = f.project 
                                    ) ON g.kode = a.project 
                                    AND g.type = 'n' 
                                    AND g.visible = 'y' 
                                WHERE
                                    a.r_sts_temuan = 1")->result_array();
    }

    public function dialog($id){
        $ulang = $this->input->post("ulang$id");
        if($ulang==2){
            $data = [
                'num' => $id,
                'r_sts_dialog' => 1,
                'r_sts_temuan' => 2,
                'r_keterangan_ra' => $this->input->post("keteranganRE$id"),
            ];
            $this->db->update('summary_2', $data, ['num'=>$id]);

            $cek = $this->db->query("SELECT
                                        a.*,
                                        c.num AS numq 
                                    FROM
                                        summary_2 a
                                        JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.kunjungan_kode 
                                    WHERE
                                        a.num = '$id'
                                        AND a.r_sts_dialog = 1 
                                        AND a.r_sts_upload_layout = 1 
                                        AND a.r_sts_upload_ss = 1 
                                        AND a.r_sts_upload_slip_transaksi = 1 
                                        AND c.rekaman_status = 3")->row_array();

            if($cek>=1){
            $numbernya = $cek['numq'];
            $this->db->query("UPDATE quest 
                            SET `status` = '3' 
                            WHERE
                            num = '$numbernya'");
            }

        } else {
            $db = $this->db->get_where('summary_2', ['num'=>$id])->row_array();
            $dbquest = $this->db->get_where('quest', ['project'=>$db['project_kode'],'cabang'=>$db['cabang_kode'],'kunjungan'=>$db['sub_kunjungan_kode'], 'shp'=>$db['shp_id'],'r_kategori'=>$db['kunjungan_kode'],])->row_array();

            $data = [
                'num' => $dbquest['num'],
                'project' => $dbquest['project'],
                'cabang' => $dbquest['cabang'],
                'kunjungan' => $dbquest['kunjungan'],
                'teller' => $dbquest['teller'],
                'shp' => $dbquest['shp'],
                // 'shp_paid' => $dbquest['shp_paid'],
                // 'shp_rtp_date' => $dbquest['shp_rtp_date'],
                // 'shp_paid_date' => $dbquest['shp_paid_date'],
                'pwt' => $dbquest['pwt'],
                // 'pwt_paid' => $dbquest['pwt_paid'],
                // 'pwt_rtp_date' => $dbquest['pwt_rtp_date'],
                // 'pwt_paid_date' => $dbquest['pwt_paid_date'],
                'tl' => $dbquest['tl'],
                'tanggal' => $dbquest['tanggal'],
                'jam' => $dbquest['jam'],
                'status' => $dbquest['status'],
                'timestamp' => $dbquest['timestamp'],
                'rekaman' => $dbquest['rekaman'],
                'rekaman_status' => $dbquest['rekaman_status'],
                'tglrekaman' => $dbquest['tglrekaman'],
                'tlhonor' => $dbquest['tlhonor'],
                'bukti' => $dbquest['bukti'],
                'equest' => $dbquest['equest'],
                'dp' => $dbquest['dp'],
                // 'centang' => $dbquest['centang'],
                // 'latitude' => $dbquest['latitude'],
                // 'longitude' => $dbquest['longitude'],
                // 'spvdua' => $dbquest['spvdua'],
                // 'tglkunjspv' => $dbquest['tglkunjspv'],
                // 'idstkb' => $dbquest['idstkb'],
                // 'waktuassign' => $dbquest['waktuassign'],
                // 'tdcs' => $dbquest['tdcs'],
                // 'tdteller' => $dbquest['tdteller'],
                // 'hasilgagal' => $dbquest['hasilgagal'],
                // 'r_kategori' => $dbquest['r_kategori'],
                // 'r_sts_temuan' => $dbquest['r_sts_temuan'],
                // 'r_temuan_rekaman' => $dbquest['r_temuan_rekaman'],
                'r_kesalahan' => $this->input->post("salah$id"),
                'r_keterangan_ra' => $this->input->post("keteranganRE$id"),
            ];

            $this->db->insert('quest_ulang', $data);
            $this->db->delete('quest', ['num'=>$dbquest['num']]);
            $rek = $this->db->get_where('data_rekaman', ['id_project'=>$db['project_kode'],'kode_cabang'=>$db['cabang_kode'],'id_skenario'=>$db['sub_kunjungan_kode'], 'id_user'=>$db['shp_id'],'kunjungan'=>$db['kunjungan_kode']])->row_array();
            
            unlink(FCPATH . '/assets/file/rekaman/' . $rek['file_rekaman']);
            unlink(FCPATH . '/assets/file/dialog/' . $db['upload_dialog']);
            unlink(FCPATH . '/assets/file/buktitrk/' . $db['upload_layout']);
            unlink(FCPATH . '/assets/file/buktitrk/' . $db['upload_ss']);
            unlink(FCPATH . '/assets/file/buktitrk/' . $db['upload_slip_transaksi']);

            $this->db->delete('data_rekaman', ['id_project'=>$db['project_kode'],'kode_cabang'=>$db['cabang_kode'],'id_skenario'=>$db['sub_kunjungan_kode'], 'id_user'=>$db['shp_id'],'kunjungan'=>$db['kunjungan_kode'],]);
            $this->db->delete('summary_2 ', ['num'=>$id]);
        }
    }
    
    public function rekaman($id){
        $ulang = $this->input->post("ulang$id");
        if($ulang==2){
            $data = [
                'num' => $id,
                'rekaman_status' => 3,
                'r_sts_temuan' => 2,
                'r_keterangan_ra' => $this->input->post("keteranganRE$id"),
            ];
            $this->db->update('quest', $data, ['num'=>$id]);
            
            $cek = $this->db->query("SELECT
                                        a.*,
                                        c.num AS numq 
                                    FROM
                                        summary_2 a
                                        JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND c.kunjungan = a.kunjungan_kode 
                                    WHERE
                                        c.num = '$id'
                                        AND a.r_sts_dialog = 1 
                                        AND a.r_sts_upload_layout = 1 
                                        AND a.r_sts_upload_ss = 1 
                                        AND a.r_sts_upload_slip_transaksi = 1 
                                        AND c.rekaman_status = 3")->row_array();

            if($cek>=1){
            $this->db->query("UPDATE quest 
                            SET `status` = '3' 
                            WHERE
                                num = '$id'");
            }

        } else {
            $dbquest = $this->db->get_where('quest', ['num'=>$id])->row_array();
            // $dbquest = $this->db->get_where('quest', ['project'=>$db['project_kode'],'cabang'=>$db['cabang_kode'],'kunjungan'=>$db['sub_kunjungan_kode'], 'shp'=>$db['shp_id'],'r_kategori'=>$db['kunjungan_kode'],])->row_array();

            $data = [
                'num' => $dbquest['num'],
                'project' => $dbquest['project'],
                'cabang' => $dbquest['cabang'],
                'kunjungan' => $dbquest['kunjungan'],
                'teller' => $dbquest['teller'],
                'shp' => $dbquest['shp'],
                // 'shp_paid' => $dbquest['shp_paid'],
                // 'shp_rtp_date' => $dbquest['shp_rtp_date'],
                // 'shp_paid_date' => $dbquest['shp_paid_date'],
                'pwt' => $dbquest['pwt'],
                // 'pwt_paid' => $dbquest['pwt_paid'],
                // 'pwt_rtp_date' => $dbquest['pwt_rtp_date'],
                // 'pwt_paid_date' => $dbquest['pwt_paid_date'],
                'tl' => $dbquest['tl'],
                'tanggal' => $dbquest['tanggal'],
                'jam' => $dbquest['jam'],
                'status' => $dbquest['status'],
                'timestamp' => $dbquest['timestamp'],
                'rekaman' => $dbquest['rekaman'],
                'rekaman_status' => $dbquest['rekaman_status'],
                'tglrekaman' => $dbquest['tglrekaman'],
                'tlhonor' => $dbquest['tlhonor'],
                'bukti' => $dbquest['bukti'],
                'equest' => $dbquest['equest'],
                'dp' => $dbquest['dp'],
                // 'centang' => $dbquest['centang'],
                // 'latitude' => $dbquest['latitude'],
                // 'longitude' => $dbquest['longitude'],
                // 'spvdua' => $dbquest['spvdua'],
                // 'tglkunjspv' => $dbquest['tglkunjspv'],
                // 'idstkb' => $dbquest['idstkb'],
                // 'waktuassign' => $dbquest['waktuassign'],
                // 'tdcs' => $dbquest['tdcs'],
                // 'tdteller' => $dbquest['tdteller'],
                // 'hasilgagal' => $dbquest['hasilgagal'],
                // 'r_kategori' => $dbquest['r_kategori'],
                // 'r_sts_temuan' => $dbquest['r_sts_temuan'],
                // 'r_temuan_rekaman' => $dbquest['r_temuan_rekaman'],
                'r_kesalahan' => $this->input->post("salah$id"),
                'r_keterangan_ra' => $this->input->post("keteranganRE$id"),
            ];

            $this->db->insert('quest_ulang', $data);
            $rek = $this->db->get_where('data_rekaman', ['id_project'=>$dbquest['project'],'kode_cabang'=>$dbquest['cabang'],'id_skenario'=>$dbquest['kunjungan'], 'id_user'=>$dbquest['shp'],'kunjungan'=>$dbquest['r_kategori']])->row_array();
            $db = $this->db->get_where('summary_2', ['project_kode'=>$dbquest['project'],'cabang_kode'=>$dbquest['cabang'],'sub_kunjungan_kode'=>$dbquest['kunjungan'], 'shp_id'=>$dbquest['shp'],'kunjungan_kode'=>$dbquest['r_kategori']])->row_array();
            
            unlink(FCPATH . '/assets/file/rekaman/' . $rek['file_rekaman']);
            unlink(FCPATH . '/assets/file/dialog/' . $db['upload_dialog']);
            unlink(FCPATH . '/assets/file/buktitrk/' . $db['upload_layout']);
            unlink(FCPATH . '/assets/file/buktitrk/' . $db['upload_ss']);
            unlink(FCPATH . '/assets/file/buktitrk/' . $db['upload_slip_transaksi']);
            
            $this->db->delete('data_rekaman', ['id_project'=>$dbquest['project'],'kode_cabang'=>$dbquest['cabang'],'id_skenario'=>$dbquest['kunjungan'], 'id_user'=>$dbquest['shp'],'kunjungan'=>$dbquest['r_kategori']]);
            $this->db->delete('summary_2', ['project_kode'=>$dbquest['project'],'cabang_kode'=>$dbquest['cabang'],'sub_kunjungan_kode'=>$dbquest['kunjungan'], 'shp_id'=>$dbquest['shp'],'kunjungan_kode'=>$dbquest['r_kategori']]);
            $this->db->delete('quest', ['num'=>$id]);
        }
    }

    public function getDataUploadUlangDialog()
    {
        $user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx 
                                FROM
                                    project g
                                        JOIN (
                                            cabang f
                                            JOIN (
                                                id_data e
                                                JOIN (
                                                    attribute d
                                                    JOIN ( attribute c JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode ) ON a.kunjungan_kode = d.kode 
                                                ) ON a.shp_id = e.Id 
                                            ) ON a.cabang_kode = f.kode 
                                            AND a.project_kode = f.project 
                                        ) ON g.kode = a.project_kode 
                                        AND g.type = 'n' 
                                        AND g.visible = 'y' 
                                WHERE
                                    a.upload_ulang_dialog = 'Y' AND validator_id = '$user'")->result_array();
    }

    public function getDataUploadUlangSlip()
    {
        $user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx 
                                FROM
                                    project g
                                        JOIN (
                                            cabang f
                                            JOIN (
                                                id_data e
                                                JOIN (
                                                    attribute d
                                                    JOIN ( attribute c JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode ) ON a.kunjungan_kode = d.kode 
                                                ) ON a.shp_id = e.Id 
                                            ) ON a.cabang_kode = f.kode 
                                            AND a.project_kode = f.project 
                                        ) ON g.kode = a.project_kode 
                                        AND g.type = 'n' 
                                        AND g.visible = 'y' 
                                WHERE
                                    a.upload_ulang_slip = 'Y' AND validator_id = '$user'")->result_array();
    }

    public function getDataUploadUlangLayout()
    {
        $user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx 
                                FROM
                                    project g
                                        JOIN (
                                            cabang f
                                            JOIN (
                                                id_data e
                                                JOIN (
                                                    attribute d
                                                    JOIN ( attribute c JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode ) ON a.kunjungan_kode = d.kode 
                                                ) ON a.shp_id = e.Id 
                                            ) ON a.cabang_kode = f.kode 
                                            AND a.project_kode = f.project 
                                        ) ON g.kode = a.project_kode 
                                        AND g.type = 'n' 
                                        AND g.visible = 'y' 
                                WHERE
                                    a.upload_ulang_layout = 'Y' AND validator_id = '$user'")->result_array();
    }

    public function getDataUploadUlangSs()
    {
        $user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx 
                                FROM
                                    project g
                                        JOIN (
                                            cabang f
                                            JOIN (
                                                id_data e
                                                JOIN (
                                                    attribute d
                                                    JOIN ( attribute c JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode ) ON a.kunjungan_kode = d.kode 
                                                ) ON a.shp_id = e.Id 
                                            ) ON a.cabang_kode = f.kode 
                                            AND a.project_kode = f.project 
                                        ) ON g.kode = a.project_kode 
                                        AND g.type = 'n' 
                                        AND g.visible = 'y' 
                                WHERE
                                    a.upload_ulang_ss = 'Y' AND validator_id = '$user'")->result_array();
    }

    public function getDataUploadUlangRekaman()
    {
        $user = $this->session->userdata('id_user');
        return $this->db->query("SELECT
                                    a.*, b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.Nama AS nama_user,
                                    f.nama AS cabangx
                                FROM
                                    project g
                                JOIN (
                                    cabang f
                                    JOIN (
                                        id_data e
                                        JOIN (
                                            attribute d
                                            JOIN (
                                                attribute c
                                                JOIN (
                                                    quest a
                                                    JOIN project b ON a.project = b.kode
                                                ) ON a.kunjungan = c.kode
                                            ) ON a.r_kategori = d.kode
                                        ) ON a.shp = e.Id
                                    ) ON a.cabang = f.kode
                                    AND a.project = f.project
                                ) ON g.kode = a.project
                                AND g.type = 'n'
                                AND g.visible = 'y'
                                WHERE
                                    a.upload_ulang_rekaman = 'Y' AND validator_id = '$user'")->result_array();
    }
}