<?php

class Validasi_model extends CI_model
{
    public function getDataRekamanById($id){
        return $this->db->query("SELECT a.*, b.nama_project, c.nama_user, d.nama_skenario, e.nama_cabang FROM data_cabang e join ( data_skenario d join ( data_user c JOIN ( data_rekaman a JOIN data_project b on a.id_project = b.id_project) on a.id_user = c.id_user ) on a.id_skenario=d.id_skenario ) on a.kode_cabang = e.kode_cabang where a.id_project = $id")->result_array();
    }

    public function getDataKunjungan($id){
        return $this->db->query("SELECT a.*, b.nama_user, c.nama_skenario, d.nama_cabang, DATE_FORMAT(a.tanggal_buat, '%d-%m-%Y') as tanggal FROM data_cabang d join ( data_skenario c JOIN ( data_kunjungan a JOIN data_user b on a.id_user = b. id_user) on a.id_skenario = c.id_skenario ) on a.kode_cabang = d.kode_cabang where a.id_project = $id order by tanggal asc")->result_array();
    }

    public function updateTransaksi($id){
        $data = [
            'sts_transaksi' => 1
        ];

        $this->db->where('id_kunjungan', $id);
        $this->db->update('data_kunjungan', $data);
    }

    public function updateTransaksi1($id){
        $data = [
            'sts_transaksi' => 2
        ];

        $this->db->where('id_kunjungan', $id);
        $this->db->update('data_kunjungan', $data);
    }

    public function updateEquest($id){
        $data = [
            'sts_equest' => 1
        ];

        $this->db->where('id_kunjungan', $id);
        $this->db->update('data_kunjungan', $data);
    }

    public function updateEquest1($id){
        $data = [
            'sts_equest' => 2
        ];

        $this->db->where('id_kunjungan', $id);
        $this->db->update('data_kunjungan', $data);
    }

    public function updateLayout($id){
        $data = [
            'sts_layout' => 1
        ];

        $this->db->where('id_kunjungan', $id);
        $this->db->update('data_kunjungan', $data);
    }

    public function updateLayout1($id){
        $data = [
            'sts_layout' => 2
        ];

        $this->db->where('id_kunjungan', $id);
        $this->db->update('data_kunjungan', $data);
    }

    public function updateStsRekaman($id){
        $sts = $this->db->get_where('data_rekaman', ['id_rekaman' => $id])->row_array();

        if($sts['sts_rekaman'] == 1){
            $data = [
                'sts_rekaman' => 0
            ];
        } else {
            $data = [
                'sts_rekaman' => 1
            ];
        }

        $this->db->where('id_rekaman', $id);
        $this->db->update('data_rekaman', $data);
    }

    public function getproject_ebanking(){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project
                                FROM
                                    project a
                                WHERE
                                    a.visible = 'y'
                                    AND a.type = 'n'
                                    AND channel='E-Banking'
                                GROUP BY
                                    a.kode")->result_array();
    }

    public function getproject_digital(){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project
                                FROM
                                    project a
                                WHERE
                                    a.visible = 'y'
                                    AND a.type = 'n'
                                    AND channel='Digital Banking'
                                GROUP BY
                                    a.kode")->result_array();
    }

    public function getbank()
    {
        return $this->db->query("SELECT * FROM bank")->result_array();
    }


    public function getval_ebanking($id, $bank, $channel, $transaksi)
    {
        $this->db->select('a.*, b.nama AS nama_bank, c.nama AS nama_transaksi, d.nama AS nama_project, f.nama AS shopper, g.nama AS penginput, h.name AS penginput2');
            $this->db->from('ebanking a');
            $this->db->join('bank b', 'a.bank=b.kode', 'left');
            $this->db->join('attribute_ebanking c', 'a.transaksi=c.kode', 'left');
            $this->db->join('project d', 'a.project=d.kode', 'left');
            $this->db->join('ebanking_shopper f', 'a.nama_shopper=f.id', 'left');
            $this->db->join('ebanking_shopper g', 'a.user_input=g.user_id', 'left');
            $this->db->join('user h', 'a.user_input=h.noid', 'left');


            $this->db->where('a.status !=', 0);
            $this->db->where('a.project', $id);
        if ($bank != '') {
            $this->db->where('a.bank', $bank);
        }
        if ($channel != '') {
            $this->db->where('a.channel', $channel);
        }
        if ($transaksi != '') {
            $this->db->where('a.transaksi', $transaksi);
        }   
            $this->db->order_by('a.status', 'ASC');

            return $this->db->get()->result_array();

       // if ($id != '' AND $bank != '' AND $channel != '' AND $transaksi != '') {
          
       //      return $this->db->query("SELECT a.*,
       //                                  b.nama AS nama_bank,
       //                                  c.nama AS nama_transaksi,
       //                                  d.nama AS nama_project
       //                                  FROM ebanking a
       //                                  LEFT JOIN bank b ON a.bank=b.kode
       //                                  LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
       //                                  LEFT JOIN project d ON a.project=d.kode
       //                                  WHERE project='$id'
       //                                  AND a.bank = '$bank'
       //                                  AND a.channel = '$channel'
       //                                  AND a.transaksi = '$transaksi'
       //                                  AND a.status != 0
       //                                  ORDER BY a.status
       //                                  ")->result_array();
       //  } else if ($id != '' AND $bank != '' AND $channel != '' AND $transaksi == '') {
          
       //      return $this->db->query("SELECT a.*,
       //                                  b.nama AS nama_bank,
       //                                  c.nama AS nama_transaksi,
       //                                  d.nama AS nama_project
       //                                  FROM ebanking a
       //                                  LEFT JOIN bank b ON a.bank=b.kode
       //                                  LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
       //                                  LEFT JOIN project d ON a.project=d.kode
       //                                  WHERE project='$id'
       //                                  AND a.bank = '$bank'
       //                                  AND a.channel = '$channel'
       //                                  -- AND a.transaksi = '$transaksi'
       //                                  AND a.status != 0
       //                                  ORDER BY a.status
       //                                  ")->result_array();
       //  } else if ($id != '' AND $bank != '' AND $channel == '' AND $transaksi == '') {
          
       //      return $this->db->query("SELECT a.*,
       //                                  b.nama AS nama_bank,
       //                                  c.nama AS nama_transaksi,
       //                                  d.nama AS nama_project
       //                                  FROM ebanking a
       //                                  LEFT JOIN bank b ON a.bank=b.kode
       //                                  LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
       //                                  LEFT JOIN project d ON a.project=d.kode
       //                                  WHERE project='$id'
       //                                  AND a.bank = '$bank'
       //                                  -- AND a.channel = '$channel'
       //                                  -- AND a.transaksi = '$transaksi'
       //                                  AND a.status != 0
       //                                  ORDER BY a.status
       //                                  ")->result_array();
       //  } else if ($id != '' AND $bank == '' AND $channel == '' AND $transaksi == '') {
          
       //      return $this->db->query("SELECT a.*,
       //                                  b.nama AS nama_bank,
       //                                  c.nama AS nama_transaksi,
       //                                  d.nama AS nama_project
       //                                  FROM ebanking a
       //                                  LEFT JOIN bank b ON a.bank=b.kode
       //                                  LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
       //                                  LEFT JOIN project d ON a.project=d.kode
       //                                  WHERE project='$id'
       //                                  -- AND a.bank = '$bank'
       //                                  -- AND a.channel = '$channel'
       //                                  -- AND a.transaksi = '$transaksi'
       //                                  AND a.status != 0
       //                                  ORDER BY a.status
       //                                  ")->result_array();
       //  }

    }

    public function getval_sosmed($id, $bank, $platform, $skenario)
    {
        $this->db->select('a.*, b.nama AS nama_bank, c.nama AS nama_skenario, d.nama AS nama_project, f.nama AS shopper');
            $this->db->from('sosmed a');
            $this->db->join('bank b', 'a.bank=b.kode', 'left');
            $this->db->join('sosmed_skenario c', 'a.skenario=c.kode', 'left');
            $this->db->join('project d', 'a.project=d.kode', 'left');
            $this->db->join('ebanking_shopper f', 'a.nama_shopper=f.id', 'left');

            $this->db->where('a.status !=', 0);
            $this->db->where('a.project', $id);
        if ($bank != '') {
            $this->db->where('a.bank', $bank);
        }
        if ($platform != '') {
            $this->db->where('a.platform', $platform);
        }
        if ($skenario != '') {
            $this->db->where('a.skenario', $skenario);
        }   
            $this->db->order_by('a.status', 'ASC');

            return $this->db->get()->result_array();

    }


    public function lihatvalidasi_ebanking($id)
    {
            return $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_transaksi,
                                        d.nama AS nama_project,
                                        e.name AS nama_input,
                                        f.nama AS shopper,
                                        g.nama AS nama_shp
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        LEFT JOIN user e ON a.user_input=e.noid
                                        LEFT JOIN ebanking_shopper f ON a.nama_shopper=f.id
                                        LEFT JOIN ebanking_shopper g ON a.user_input=g.user_id
                                        WHERE a.num='$id'
                                       
                                        ")->row_array();
    }

    public function lihatvalidasi_sosmed($id)
    {
       return $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_skenario,
                                        d.nama AS nama_project,
                                        e.name AS nama_input,
                                        f.nama AS shopper,
                                        g.nama AS nama_shp
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        LEFT JOIN user e ON a.user_input=e.noid
                                        LEFT JOIN ebanking_shopper f ON a.nama_shopper=f.id
                                        LEFT JOIN ebanking_shopper g ON a.user_input=g.user_id
                                        WHERE a.num='$id'
                                        ")->row_array();
    }

    public function getdetail_td($id)
    {

            return $this->db->query("SELECT * FROM ebanking_td
                                        WHERE num_eb='$id'
                                       
                                        ")->row_array();
    }

    public function getAllData($pro){
        // return $this->db->query("SELECT a.*, b.* from data_rekaman a join data_dialog b on a.id_project = b.id_project and a.id_skenario = b.id_skenario and a.id_user = b.id_user and a.kode_cabang = b.kode_cabang where a.id_project = $pro and b.id_project = $pro")->result_array();
        return $this->db->query("SELECT a.*, b.*, a.sts_valid as sts_rekaman, b.sts_valid as sts_dialog, c.nama_project, d.nama_skenario, e.nama_cabang, f.nama_user from data_user f join ( data_cabang e join ( data_skenario d join ( data_project c join ( data_rekaman a join data_dialog b on a.id_project = b.id_project and a.id_skenario = b.id_skenario and a.id_user = b.id_user and a.kode_cabang = b.kode_cabang ) on a.id_project=c.id_project ) on a.id_skenario=d.id_skenario ) on a.kode_cabang = e.kode_cabang ) on a.id_user = f.id_user where a.id_project = $pro and b.id_project = $pro")->result_array();
    }

    public function getRekamanById($id){
        return $this->db->get_where('data_rekaman', ['id_rekaman' => $id])->row_array();
    }

    public function getDialogById($id){
        return $this->db->get_where('data_dialog', ['id_dialog' => $id])->row_array();
    }

    public function stsValidDialog($id){
        $data = [
            'sts_valid' => 1
        ];
        $this->db->where('id_dialog', $id);
        $this->db->update('data_dialog', $data);
    }

    public function stsInvalidDialog($id){
        $data = [
            'sts_valid' => 0
        ];
        $this->db->where('id_dialog', $id);
        $this->db->update('data_dialog', $data);
    }

    public function stsValidRekaman($id){
        $data = [
            'sts_valid' => 1
        ];
        $this->db->where('id_rekaman', $id);
        $this->db->update('data_rekaman', $data);
    }

    public function stsInvalidRekaman($id){
        $data = [
            'sts_valid' => 0
        ];
        $this->db->where('id_rekaman', $id);
        $this->db->update('data_rekaman', $data);
    }

    public function getAllDataQuest(){
        $pro = $this->input->post('sproject');
        $kun = $this->input->post('skunjungan');
        $sek = $this->input->post('skenario');

        return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as kunjunganx, e.nama_user, f.nama as cabangx from cabang f join ( data_user e join ( attribute d join ( attribute c join (quest a join data_project b on a.project=b.kode_project) on a.kunjungan = c.kode) on a.r_kategori=d.kode) on a.shp=e.id_user) on a.cabang=f.kode and a.project=f.project where a.project='$pro' and a.kunjungan = '$sek' and a.r_kategori='$kun'")->result_array();
    }

    public function getAllDataQuestNew(){
        $pro = $this->input->post('ssproject');
        $kun1 = $this->input->post('cek0');
        $kun2 = $this->input->post('cek1');
        $kun3 = $this->input->post('cek2');
        $kun4 = $this->input->post('cek3');
        $kun5 = $this->input->post('cek4');
        $kun6 = $this->input->post('cek5');
        $kun7 = $this->input->post('cek6');
        $kun8 = $this->input->post('cek7');
        $kun9 = $this->input->post('cek8');
        $kun10 = $this->input->post('cek9');

        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as kunjunganx, e.nama_user, f.nama as cabangx from cabang f join ( data_user e join ( attribute d join ( attribute c join (quest a join data_project b on a.project=b.kode_project) on a.kunjungan = c.kode) on a.r_kategori=d.kode) on a.shp=e.id_user) on a.cabang=f.kode and a.project=f.project where a.project='$pro' and a.r_kategori='$kun' order by f.kode ASC, a.r_kategori ASC ")->result_array();

        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.nama AS nama_user,
                                    f.nama AS cabangx,
                                    date(a.waktuassign) AS waktu_assign,
                                    date(g.waktu_upload) as waktu_upload

                                FROM
                                summary_2 g
                                RIGHT JOIN (
                                    cabang f
                                    JOIN (
                                        id_data e
                                        JOIN (
                                            attribute d
                                            JOIN ( attribute c JOIN ( quest a JOIN project b ON a.project = b.kode ) ON a.kunjungan = c.kode ) ON a.r_kategori = d.kode
                                        ) ON a.shp = e.Id
                                    ) ON a.cabang = f.kode
                                    AND a.project = f.project
                                    ) ON g.project_kode = a.project AND g.sub_kunjungan_kode = a.kunjungan AND g.cabang_kode = a.cabang
                                WHERE
                                    a.project = '$pro'
                                    AND (a.r_kategori = '$kun1' OR a.r_kategori = '$kun2' OR a.r_kategori = '$kun3' OR a.r_kategori = '$kun4' OR a.r_kategori = '$kun5' OR a.r_kategori = '$kun6' OR a.r_kategori = '$kun7' OR a.r_kategori = '$kun8' OR a.r_kategori = '$kun9' OR a.r_kategori = '$kun10')
                                ORDER BY
                                    a.tanggal ASC,
                                    f.kode ASC,
                                    a.r_kategori ASC")->result_array();
    }

    public function getAllDataQuestNew2(){

        $pro = $_POST['pro'];
        $kun1 = $_POST['kun1'];
        $kun2 = $_POST['kun2'];
        $kun3 = $_POST['kun3'];
        $kun4 = $_POST['kun4'];
        $kun5 = $_POST['kun5'];
        $kun6 = $_POST['kun6'];
        $kun7 = $_POST['kun7'];
        $kun8 = $_POST['kun8'];
        $kun9 = $_POST['kun9'];
        $kun10 = $_POST['kun10'];

        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.nama AS nama_user,
                                    f.nama AS cabangx,
                                    date(a.waktuassign) AS waktu_assign,
                                    date(g.waktu_upload) as waktu_upload,
                                    g.r_sts_dialog,
	                                g.upload_dialog,
	                                g.r_sts_upload_layout,
	                                g.upload_layout,
	                                g.r_sts_upload_ss,
	                                g.upload_ss,
	                                g.r_sts_upload_slip_transaksi,
	                                g.upload_slip_transaksi

                                FROM
                                summary_2 g
                                RIGHT JOIN (
                                    cabang f
                                    JOIN (
                                        id_data e
                                        JOIN (
                                            attribute d
                                            JOIN ( attribute c JOIN ( quest a JOIN project b ON a.project = b.kode ) ON a.kunjungan = c.kode ) ON a.r_kategori = d.kode
                                        ) ON a.shp = e.Id
                                    ) ON a.cabang = f.kode
                                    AND a.project = f.project
                                    ) ON g.project_kode = a.project AND g.sub_kunjungan_kode = a.kunjungan AND g.cabang_kode = a.cabang
                                WHERE
                                    a.project = '$pro'
                                    AND (a.r_kategori = '$kun1' OR a.r_kategori = '$kun2' OR a.r_kategori = '$kun3' OR a.r_kategori = '$kun4' OR a.r_kategori = '$kun5' OR a.r_kategori = '$kun6' OR a.r_kategori = '$kun7' OR a.r_kategori = '$kun8' OR a.r_kategori = '$kun9' OR a.r_kategori = '$kun10')
                                ORDER BY
                                    a.tanggal ASC,
                                    f.kode ASC,
                                    a.r_kategori ASC")->result_array();
    }

    public function getAllDataSummary($id){
        $dt = $this->db->get_where('quest', ['num'=>$id])->row_array();
        $pro = $dt['project'];
        $shp = $dt['shp'];
        $cab = $dt['cabang'];
        $sek = $dt['kunjungan'];
        $kun = $dt['r_kategori'];
        // return $this->db->get_where('summary_2', ['shp_id' => $dt['shp'], 'project_kode'=>$dt['project'], 'cabang_kode'=>$dt['cabang'], 'sub_kunjungan_kode'=>$db['kunjungan'], 'kunjungan_kode'=>$dt['r_kategori']])->row_array();

        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as skenariox, d.nama as kunjunganx, e.nama_user, f.nama as cabangx from cabang f join ( data_user e join ( attribute d join ( attribute c join (summary_2 a join data_project b on a.project_kode=b.kode_project) on a.sub_kunjungan_kode = c.kode) on a.kunjungan_kode=d.kode) on a.shp_id=e.id_user) on a.cabang_kode=f.kode and a.project_kode=f.project where a.project_kode='$pro' and a.kunjungan_kode = '$kun' and a.sub_kunjungan_kode='$sek' and a.cabang_kode = '$cab' and a.shp_id='$shp'")->row_array();
        return $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS skenariox,
                                    d.nama AS kunjunganx,
                                    e.nama AS nama_user,
                                    f.nama AS cabangx
                                FROM
                                    cabang f
                                    JOIN (
                                        id_data e
                                        JOIN (
                                            attribute d
                                            JOIN ( attribute c JOIN ( summary_2 a JOIN project b ON a.project_kode = b.kode ) ON a.sub_kunjungan_kode = c.kode ) ON a.kunjungan_kode = d.kode
                                        ) ON a.shp_id = e.Id
                                    ) ON a.cabang_kode = f.kode
                                    AND a.project_kode = f.project
                                WHERE
                                    a.project_kode = '$pro'
                                    AND a.kunjungan_kode = '$kun'
                                    AND a.sub_kunjungan_kode = '$sek'
                                    AND a.cabang_kode = '$cab'
                                    AND a.shp_id = '$shp'")->row_array();
    }

    public function getAllDataRekaman($id){
        $dt = $this->db->get_where('quest', ['num'=>$id])->row_array();
        return $this->db->get_where('data_rekaman', ['id_user' => $dt['shp'], 'id_project'=>$dt['project'], 'kode_cabang'=>$dt['cabang'], 'id_skenario'=>$dt['kunjungan'], 'kunjungan'=>$dt['r_kategori']])->row_array();
    }

    public function getAllDataQuestById($id){
        return $this->db->get_where('quest', ['num'=>$id])->row_array();
    }

    public function temuandialog(){
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_temuan' => 1,
            'r_temuan_dialog' => $this->input->post('keterangan'),
        ];

        $this->db->update('summary_2', $data, ['project_kode'=>$this->input->post('kode'), 'cabang_kode'=>$this->input->post('cabang'), 'kunjungan_kode'=>$this->input->post('kunjungan'), 'sub_kunjungan_kode'=>$this->input->post('skenario'), 'shp_id'=>$this->input->post('shp')]);
    }

    public function tolakdialog2(){
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_dialog' => 0,
            'r_temuan_dialog' => $this->input->post('keterangan'),
        ];

        $this->db->update('summary_2', $data, ['project_kode'=>$this->input->post('kode'), 'cabang_kode'=>$this->input->post('cabang'), 'kunjungan_kode'=>$this->input->post('kunjungan'), 'sub_kunjungan_kode'=>$this->input->post('skenario'), 'shp_id'=>$this->input->post('shp')]);
    }

    public function tolakrekaman2(){
        $data = [
            'rekaman_status' => 2,
            'r_temuan_rekaman' => $this->input->post('keterangan'),
            'validator_id' => $this->session->userdata('id_user'),
        ];

        $this->db->update('quest', $data, ['num'=>$this->input->post('id')]);
    }

    public function temuanlayout(){
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_upload_layout' => 0,
            'r_temuan_layout' => $this->input->post('keterangan'),
        ];

        $this->db->update('summary_2', $data, ['project_kode'=>$this->input->post('kode'), 'cabang_kode'=>$this->input->post('cabang'), 'kunjungan_kode'=>$this->input->post('kunjungan'), 'sub_kunjungan_kode'=>$this->input->post('skenario'), 'shp_id'=>$this->input->post('shp')]);
    }

    public function temuanss(){
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_upload_ss' => 0,
            'r_temuan_ss' => $this->input->post('keterangan'),
        ];

        $this->db->update('summary_2', $data, ['project_kode'=>$this->input->post('kode'), 'cabang_kode'=>$this->input->post('cabang'), 'kunjungan_kode'=>$this->input->post('kunjungan'), 'sub_kunjungan_kode'=>$this->input->post('skenario'), 'shp_id'=>$this->input->post('shp')]);
    }

    public function temuanslip(){
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_upload_slip_transaksi' => 0,
            'r_temuan_slip_transaksi' => $this->input->post('keterangan'),
        ];

        $this->db->update('summary_2', $data, ['project_kode'=>$this->input->post('kode'), 'cabang_kode'=>$this->input->post('cabang'), 'kunjungan_kode'=>$this->input->post('kunjungan'), 'sub_kunjungan_kode'=>$this->input->post('skenario'), 'shp_id'=>$this->input->post('shp')]);
    }

    public function temuanrekaman(){
        $data = [
            'validator_id' => $this->session->userdata('id_user'),
            'r_sts_temuan' => 1,
            'r_temuan_rekaman' => $this->input->post('keterangan'),
        ];

        $this->db->update('quest', $data, ['project'=>$this->input->post('kode'), 'cabang'=>$this->input->post('cabang'), 'kunjungan'=>$this->input->post('skenario'), 'r_kategori'=>$this->input->post('kunjungan'), 'shp'=>$this->input->post('shp')]);
    }

    public function inputrekamanmanual(){

        date_default_timezone_set("Asia/Bangkok");

            $pro = $this->input->post('sproject', true);
            $sek = $this->input->post("rekamanskenario", true);
            $kun = $this->input->post('skunjungan', true);
            $cabang = $this->input->post('rekamancabang', true);
            // $user = $this->input->post('shopper', true);

            $img1 = $_FILES["rekaman"]['name'];
            // var_dump($img1); die;
            if ($img1){
                $config['upload_path']          ='assets/file/rekaman/';
                $config['allowed_types']        = 'mp3|wav|ogg|mp4|mov|m4a|3gp';
                $config['max-size']             = 0;

                $this->load->library('upload', $config);

                if($this->upload->do_upload("rekaman")) {
                    $img1 = $this->upload->data('file_name');
                    $img2 = $pro."-".$cabang."-".$kun."-".$sek."-".$img1;

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

            $shopper = $this->db->query("SELECT shp FROM quest where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun'")->row_array();
            $user = $shopper['shp'];

            // var_dump($user);
            // die;

            $data = [

                'id_project' => $pro,
                'id_skenario' => $sek,
                'id_user' => $user,
                'kode_cabang' => $cabang,
                'kunjungan' => $kun,
                'file_rekaman' => $img2,
                'tanggal_input' => date('Y-m-d')
            ];

            $this->db->insert('data_rekaman', $data);

            $this->db->query("UPDATE quest SET rekaman = 'true' where project='$pro' and cabang='$cabang' and kunjungan='$sek' and r_kategori='$kun' and shp = '$user'");

    }
}
