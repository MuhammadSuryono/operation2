<?php

class Aktual_model extends CI_model
{

      // start datatables EBANKING
    var $column_order = array(null, 'nama_project', 'nama_bank', 'channel', 'os', 'nama_transaksi', 'provider', 'tanggal_evaluasi'); //set column field database for datatable orderable
    var $column_search = array('d.nama', 'b.nama', 'a.channel', 'a.os', 'c.nama', 'provider', 'tanggal_evaluasi'); //set column field database for datatable searchable
    var $order = array('num' => 'asc'); // default order 
 
    private function _get_datatables_query() {
        $this->db->select('a.*, b.nama AS nama_bank, c.nama AS nama_transaksi, d.nama AS nama_project');
        $this->db->from('ebanking a');
        $this->db->join('bank b', 'a.bank=b.kode', 'left');
        $this->db->join('attribute_ebanking c', 'a.transaksi=c.kode', 'left');
        $this->db->join('project d', 'a.project=d.kode', 'left');
        $this->db->where('tanggal_evaluasi !=', NULL);
        $this->db->where('status', '0');
        $this->db->where('d.type', 'n');


        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1) {
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('ebanking a');
        $this->db->join('project d', 'a.project=d.kode', 'left');
        $this->db->where('tanggal_evaluasi', 'IS NOT NULL');
        $this->db->where('status', '0');
        $this->db->where('d.type', 'n');
        return $this->db->count_all_results();
    }
    // end datatables



    // start datatables SOSMED
    var $sosmed_order2 = array(null, 'nama_project', 'nama_bank', 'platform', 'nama_skenario', 'tanggal_evaluasi'); //set column field database for datatable orderable
    var $sosmed_search2 = array('d.nama', 'b.nama', 'a.platform', 'c.nama', 'tanggal_evaluasi'); //set column field database for datatable searchable
    var $order2 = array('num' => 'asc'); // default order 
 
    private function sosmed_get_datatables_query() {
        $this->db->select('a.*, b.nama AS nama_bank, c.nama AS nama_skenario, d.nama AS nama_project');
        $this->db->from('sosmed a');
        $this->db->join('bank b', 'a.bank=b.kode', 'left');
        $this->db->join('sosmed_skenario c', 'a.skenario=c.kode', 'left');
        $this->db->join('project d', 'a.project=d.kode', 'left');
        $this->db->where('tanggal_evaluasi !=', NULL);
        $this->db->where('status', '0');
        $this->db->where('d.type', 'n');


        $i = 0;
        foreach ($this->sosmed_search2 as $item) { // loop column 
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->sosmed_search2) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->sosmed_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order2)) {
            $order2 = $this->order2;
            $this->db->order_by(key($order2), $order2[key($order2)]);
        }
    }
    function get_datatables_sosmed() {
        $this->sosmed_get_datatables_query();
        if($_POST['length'] != -1) {
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_sosmed() {
        $this->sosmed_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_sosmed() {
        $this->db->from('sosmed a');
        $this->db->join('project d', 'a.project=d.kode', 'left');
        $this->db->where('tanggal_evaluasi', 'IS NOT NULL');
        $this->db->where('status', '0');
        $this->db->where('d.type', 'n');
        return $this->db->count_all_results();
    }
    // end datatables








    public function getSkenario()
    {
        return $this->db->get('data_skenario')->result_array();
    }

    public function getSkenarioKB()
    {
        return $this->db->get('data_skenario')->result_array();
    }

    public function getAktual()
    {
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_project, c.nama_cabang FROM data_cabang c join ( `data_aktual` a JOIN data_project b on a.id_project = b.id_project ) on a.kode_cabang = c.kode_cabang WHERE id_user = '$id_user' and ( id_status = 0 or id_status = 3) GROUP BY id_project, id_kunjungan")->result_array();
    }

    public function getAktualKB()
    {
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama FROM cabang c join ( `data_aktual` a JOIN data_project b on a.kode_project = b.kode_project ) on a.kode_cabang = c.num WHERE a.id_user = '$id_user' and ( id_status = 0 or id_status = 3) GROUP BY a.kode_project, a.kunjungan")->result_array();
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as cabangx,GROUP_CONCAT(a.kunjungan) as kode_skenario, GROUP_CONCAT(d.nama) as skenario, GROUP_CONCAT(a.`status`) as sts, d.nama as kunjungan1 FROM attribute d join ( cabang c join ( `quest` a JOIN data_project b on a.project = b.kode_project ) on a.cabang = c.kode and a.project=c.project) on a.kunjungan = d.kode WHERE a.shp = '$id_user' GROUP BY a.project,a.cabang, a.r_kategori")->result_array();

        // 30 NOVEMBER 2020 KODINGAN LAMA
        $dataNonATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    b.kode AS kode_project,
                                    c.nama AS cabangx,
                                    GROUP_CONCAT( a.kunjungan ) AS kode_skenario,
                                    GROUP_CONCAT( d.nama ) AS skenario,
                                    GROUP_CONCAT( a.`status` ) AS sts,
                                    d.nama AS kunjungan1
                                FROM
                                    attribute d
                                    JOIN (
                                        cabang c
                                        JOIN ( `quest` a JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n' ) ON a.cabang = c.kode
                                        AND a.project = c.project
                                    ) ON a.kunjungan = d.kode
                                WHERE
                                    a.shp = '$id_user'
                                GROUP BY
                                    a.project,
                                    a.cabang,
                                    a.r_kategori
                                ")->result_array();
      // BARU LAGI 7 DESEMBER 2020
      $dataATM = $this->db->query("SELECT
                                  b.nama AS nama_project, b.kode AS kode_project, p.nomorstkb,
                                  a.namacabang AS cabangx,
                                  a.cabang AS cabang,
                                  at.nama AS kunjungan1,
                                  p.kunjungan AS r_kategori,
                                  IF(p.kunjungan IN ('064','065','066','067'), p.kunjungan, NULL) AS skenario,
                                  CASE
                                      WHEN a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL THEN a.status_weekend_siang
                                      WHEN a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL THEN a.status_weekend_malam
                                      WHEN a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL THEN a.status_weekday_siang
                                      WHEN a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL THEN a.status_weekday_malam
                                      ELSE NULL
                                  END AS status
                              FROM

                                  plan p
                                  JOIN project b ON p.project = b.kode AND b.visible = 'y' AND b.type = 'n'
                                  LEFT JOIN atmcenter a ON a.project = p.project AND a.cabang = p.kode
                                  AND ((a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL)
                                  OR (a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL)
                                  OR (a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL)
                                  OR (a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL))
                                  JOIN attribute at ON p.kunjungan = at.kode
                              WHERE
                                a.shp_weekend_siang = '$id_user' OR a.shp_weekend_malam = '$id_user' OR a.shp_weekday_siang = '$id_user' OR a.shp_weekday_malam = '$id_user'
                              GROUP BY
                                p.kunjungan, p.nomorstkb
                                ")->result_array();
        // MERGING DATA YG DIDAPAT DARI STKB NON/ATMCENTER
        return array_merge($dataNonATM, $dataATM);
    }

    public function getAktualKB2()
    {
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama FROM cabang c join ( `data_aktual` a JOIN data_project b on a.kode_project = b.kode_project ) on a.kode_cabang = c.num WHERE a.id_user = '$id_user' and ( id_status = 0 or id_status = 3) GROUP BY a.kode_project, a.kunjungan")->result_array();
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as cabangx,GROUP_CONCAT(a.kunjungan) as kode_skenario, GROUP_CONCAT(d.nama) as skenario, GROUP_CONCAT(a.`status`) as sts, d.nama as kunjungan1 FROM attribute d join ( cabang c join ( `quest` a JOIN data_project b on a.project = b.kode_project ) on a.cabang = c.kode and a.project=c.project) on a.kunjungan = d.kode WHERE a.shp = '$id_user' GROUP BY a.project,a.cabang, a.r_kategori")->result_array();

        // 30 NOVEMBER 2020 KODINGAN LAMA
        $dataNonATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    b.kode AS kode_project,
                                    c.nama AS cabangx,
                                    GROUP_CONCAT( a.kunjungan ) AS kode_skenario,
                                    GROUP_CONCAT( d.nama ) AS skenario,
                                    GROUP_CONCAT( a.`status` ) AS sts,
                                    d.nama AS kunjungan1
                                FROM
                                    attribute d
                                    JOIN (
                                        cabang c
                                        JOIN ( `quest` a JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n' ) ON a.cabang = c.kode
                                        AND a.project = c.project
                                    ) ON a.kunjungan = d.kode
                                WHERE
                                    a.shp = '$id_user'
                                    AND a.r_kategori is not null
                                GROUP BY
                                    a.project,
                                    a.cabang,
                                    a.r_kategori")->result_array();
        // BARU 01 DESEMBER 2020
        $dataATM = $this->db->query("SELECT
                                    b.kode AS kode_project, b.nama AS nama_project, p.nomorstkb,
                                    a.namacabang AS num,
                                    a.namacabang AS cabangx,
                                    a.cabang AS cabang,
                                    at.nama AS kunjungan1,
                                    p.kunjungan AS r_kategori,
                                    IF(p.kunjungan IN ('064','065','066','067'), p.kunjungan, NULL) AS skenario,
                                    CASE
                                        WHEN a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL THEN a.status_weekend_siang
                                        WHEN a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL THEN a.status_weekend_malam
                                        WHEN a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL THEN a.status_weekday_siang
                                        WHEN a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL THEN a.status_weekday_malam
                                    END AS status,
                                    CASE
                                        WHEN a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL THEN a.noform_weekend_siang
                                        WHEN a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL THEN a.noform_weekend_malam
                                        WHEN a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL THEN a.noform_weekday_siang
                                        WHEN a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL THEN a.noform_weekday_malam
                                    END AS rekaman_status
                                FROM
                                    plan p
                                    JOIN project b ON p.project = b.kode AND b.visible = 'y' AND b.type = 'n'
                                    LEFT JOIN atmcenter a ON a.project = p.project AND a.cabang = p.kode
                                    AND ((a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL AND a.status_weekend_siang = 1)
                                    OR (a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL AND a.status_weekend_malam = 1)
                                    OR (a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL AND a.status_weekday_siang = 1)
                                    OR (a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL AND a.status_weekday_malam = 1))
                                    JOIN attribute at ON p.kunjungan = at.kode
                                WHERE
                                  a.shp_weekend_siang = '$id_user' OR a.shp_weekend_malam = '$id_user' OR a.shp_weekday_siang = '$id_user' OR a.shp_weekday_malam = '$id_user'
                                GROUP BY
                                  p.kunjungan, p.nomorstkb
                                  ")->result_array();
        // MERGING DATA YG DIDAPAT DARI STKB NON/ATMCENTER
        return array_merge($dataNonATM, $dataATM);
    }

    public function getBeritaAcara()
    {
        $id_user = $this->session->userdata('id_user');
        $divisi = $this->session->userdata('id_divisi');

        if ($divisi == 1) {
           $cek= 'a.approval IS NULL AND a.mengetahui IS NOT NULL';
        } else {
            $cek = 'a.mengetahui IS NULL';
        }

        // return $this->db->query("SELECT a.*, b.nama_project, c.nama FROM cabang c join ( `data_aktual` a JOIN data_project b on a.kode_project = b.kode_project ) on a.kode_cabang = c.num WHERE a.id_user = '$id_user' and ( id_status = 0 or id_status = 3) GROUP BY a.kode_project, a.kunjungan")->result_array();
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as cabangx,GROUP_CONCAT(a.kunjungan) as kode_skenario, GROUP_CONCAT(d.nama) as skenario, GROUP_CONCAT(a.`status`) as sts, d.nama as kunjungan1 FROM attribute d join ( cabang c join ( `quest` a JOIN data_project b on a.project = b.kode_project ) on a.cabang = c.kode and a.project=c.project) on a.kunjungan = d.kode WHERE a.shp = '$id_user' GROUP BY a.project,a.cabang, a.r_kategori")->result_array();

        // 30 NOVEMBER 2020 KODINGAN LAMA
        $dataNonATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    (a.ra_project = '$id_user' OR a.pj_field = '$id_user')
                                    AND $cek
                                GROUP BY
                                    a.num_quest
                                    
                                    ")->result_array();
        // BARU 01 DESEMBER 2020
        $dataATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.namacabang AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN atmcenter c ON a.cabang=c.cabang AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    (a.ra_project = '$id_user' OR a.pj_field = '$id_user')
                                    AND $cek
                                GROUP BY
                                    a.num_quest
                                    ")->result_array();
        // MERGING DATA YG DIDAPAT DARI STKB NON/ATMCENTER
        return array_merge($dataNonATM, $dataATM);
    }

    public function getBeritaAcara_Done()
    {
        $id_user = $this->session->userdata('id_user');
        $divisi = $this->session->userdata('id_divisi');

        if ($divisi == 1) {
           $cek= 'a.approval IS NOT NULL';
        } else {
            $cek = 'a.mengetahui IS NOT NULL';
        }

        // return $this->db->query("SELECT a.*, b.nama_project, c.nama FROM cabang c join ( `data_aktual` a JOIN data_project b on a.kode_project = b.kode_project ) on a.kode_cabang = c.num WHERE a.id_user = '$id_user' and ( id_status = 0 or id_status = 3) GROUP BY a.kode_project, a.kunjungan")->result_array();
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as cabangx,GROUP_CONCAT(a.kunjungan) as kode_skenario, GROUP_CONCAT(d.nama) as skenario, GROUP_CONCAT(a.`status`) as sts, d.nama as kunjungan1 FROM attribute d join ( cabang c join ( `quest` a JOIN data_project b on a.project = b.kode_project ) on a.cabang = c.kode and a.project=c.project) on a.kunjungan = d.kode WHERE a.shp = '$id_user' GROUP BY a.project,a.cabang, a.r_kategori")->result_array();

        // 30 SEPTEMBER 2021
        $dataNonATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    (a.ra_project = '$id_user' OR a.pj_field = '$id_user')
                                    AND $cek
                                GROUP BY
                                    a.num_quest
                                    
                                    ")->result_array();
        // 30 SEPTEMBER 2021
        $dataATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.namacabang AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN atmcenter c ON a.cabang=c.cabang AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    (a.ra_project = '$id_user' OR a.pj_field = '$id_user')
                                    AND $cek
                                GROUP BY
                                    a.num_quest
                                    ")->result_array();
        // MERGING DATA YG DIDAPAT DARI STKB NON/ATMCENTER
        return array_merge($dataNonATM, $dataATM);
    }

    public function getDataRow()
    {
        $id_user = $this->session->userdata('id_user');
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama FROM cabang c join ( `data_aktual` a JOIN data_project b on a.kode_project = b.kode_project ) on a.kode_cabang = c.num WHERE a.id_user = '$id_user' and ( id_status = 0 or id_status = 3) GROUP BY a.kode_project, a.kunjungan")->result_array();
        // return $this->db->query("SELECT a.*, b.nama_project, c.nama as cabangx,GROUP_CONCAT(a.kunjungan) as kode_skenario, GROUP_CONCAT(d.nama) as skenario, GROUP_CONCAT(a.`status`) as sts, d.nama as kunjungan1 FROM attribute d join ( cabang c join ( `quest` a JOIN data_project b on a.project = b.kode_project ) on a.cabang = c.kode and a.project=c.project) on a.kunjungan = d.kode WHERE a.shp = '$id_user' GROUP BY a.project,a.cabang, a.r_kategori")->result_array();

        // 30 NOVEMBER 2020 KODINGAN LAMA
        $dataNonATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    b.kode AS kode_project,
                                    c.nama AS cabangx,
                                    GROUP_CONCAT( a.kunjungan ) AS kode_skenario,
                                    GROUP_CONCAT( d.nama ) AS skenario,
                                    GROUP_CONCAT( a.`status` ) AS sts,
                                    d.nama AS kunjungan1
                                FROM
                                    attribute d
                                    JOIN (
                                        cabang c
                                        JOIN ( `quest` a JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n' ) ON a.cabang = c.kode
                                        AND a.project = c.project
                                    ) ON a.kunjungan = d.kode
                                WHERE
                                    (a.shp = '$id_user' OR a.pwt = '$id_user')
                                    AND a.r_kategori is not null
                                    AND (a.status = '1' OR a.rekaman_status = '0')
                                GROUP BY
                                    a.project,
                                    a.cabang,
                                    a.r_kategori")->result_array();
        // BARU 01 DESEMBER 2020
        $dataATM = $this->db->query("SELECT
                                    b.kode AS kode_project, b.nama AS nama_project, p.nomorstkb,
                                    a.namacabang AS num,
                                    a.namacabang AS cabangx,
                                    a.cabang AS cabang,
                                    at.nama AS kunjungan1,
                                    p.kunjungan AS r_kategori,
                                    IF(p.kunjungan IN ('064','065','066','067'), p.kunjungan, NULL) AS skenario,
                                    CASE
                                        WHEN a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL THEN a.status_weekend_siang
                                        WHEN a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL THEN a.status_weekend_malam
                                        WHEN a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL THEN a.status_weekday_siang
                                        WHEN a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL THEN a.status_weekday_malam
                                    END AS status,
                                    CASE
                                        WHEN a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL THEN a.noform_weekend_siang
                                        WHEN a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL THEN a.noform_weekend_malam
                                        WHEN a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL THEN a.noform_weekday_siang
                                        WHEN a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL THEN a.noform_weekday_malam
                                    END AS rekaman_status
                                FROM
                                    plan p
                                    JOIN project b ON p.project = b.kode AND b.visible = 'y' AND b.type = 'n'
                                    LEFT JOIN atmcenter a ON a.project = p.project AND a.cabang = p.kode
                                    AND ((a.weekend_siang = p.kunjungan AND a.shp_weekend_siang IS NOT NULL AND a.status_weekend_siang = 1)
                                    OR (a.weekend_malam = p.kunjungan AND a.shp_weekend_malam IS NOT NULL AND a.status_weekend_malam = 1)
                                    OR (a.weekday_siang = p.kunjungan AND a.shp_weekday_siang IS NOT NULL AND a.status_weekday_siang = 1)
                                    OR (a.weekday_malam = p.kunjungan AND a.shp_weekday_malam IS NOT NULL AND a.status_weekday_malam = 1))
                                    JOIN attribute at ON p.kunjungan = at.kode
                                WHERE
                                  a.shp_weekend_siang = '$id_user' OR a.shp_weekend_malam = '$id_user' OR a.shp_weekday_siang = '$id_user' OR a.shp_weekday_malam = '$id_user'
                                GROUP BY
                                  p.kunjungan, p.nomorstkb
                                  ")->result_array();
        // MERGING DATA YG DIDAPAT DARI STKB NON/ATMCENTER
        return array_merge($dataNonATM, $dataATM);
    }

    public function getPengajuan_BA()
    {
        $id_user = $this->session->userdata('id_user');
        
        // 30 SEPTEMBER 2021
        $dataNonATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    a.pemohon = '$id_user'
                                GROUP BY
                                    a.num_quest
                                    
                                    ")->result_array();
        // 30 SEPTEMBER 2021
        $dataATM = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.namacabang AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN atmcenter c ON a.cabang=c.cabang AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    a.pemohon = '$id_user'
                                GROUP BY
                                    a.num_quest
                                    ")->result_array();
        // MERGING DATA YG DIDAPAT DARI STKB NON/ATMCENTER
        return array_merge($dataNonATM, $dataATM);
    }

    public function getAktualSuccess()
    {
        $id_user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_project, c.nama_cabang FROM data_cabang c join ( `data_aktual` a JOIN data_project b on a.id_project = b.id_project ) on a.kode_cabang = c.kode_cabang  WHERE id_user = '$id_user' and id_status = 1 GROUP BY id_project, id_kunjungan")->result_array();
    }

    public function getSkenarioById($id, $project)
    {
        $user = $this->session->userdata('id_user');
        return $this->db->query("SELECT a.*, b.nama_skenario FROM `data_aktual`a join data_skenario b on a.id_skenario = b.id_skenario WHERE id_kunjungan = $id and id_project = $project and id_user = $user")->result_array();
    }

    public function getSkenarioByIdKB($id, $project, $cabang)
    {
        $user = $this->session->userdata('id_user');
        $atmcenter = array('064','065','066','067');
        if (in_array($id, $atmcenter)){
          $data = $this->db->query("SELECT a.num, a.project, a.cabang, p.kunjungan, p.kunjungan AS r_kategori, at.nama AS skenario, '$user' AS shp, p.nomorstkb,
            CASE
                WHEN a.weekend_siang = p.kunjungan AND a.shp_weekend_siang = '$user' THEN a.tgl_weekend_siang
                WHEN a.weekend_malam = p.kunjungan AND a.shp_weekend_malam = '$user' THEN a.tgl_weekend_malam
                WHEN a.weekday_siang = p.kunjungan AND a.shp_weekday_siang = '$user' THEN a.tgl_weekday_siang
                WHEN a.weekday_malam = p.kunjungan AND a.shp_weekday_malam = '$user' THEN a.tgl_weekday_malam
                ELSE NULL
            END AS tanggal,
            CASE
                WHEN a.weekend_siang = p.kunjungan AND a.shp_weekend_siang = '$user' THEN a.status_weekend_siang
                WHEN a.weekend_malam = p.kunjungan AND a.shp_weekend_malam = '$user' THEN a.status_weekend_malam
                WHEN a.weekday_siang = p.kunjungan AND a.shp_weekday_siang = '$user' THEN a.status_weekday_siang
                WHEN a.weekday_malam = p.kunjungan AND a.shp_weekday_malam = '$user' THEN a.status_weekday_malam
                ELSE NULL
            END AS status
            FROM atmcenter a JOIN plan p ON p.project = a.project AND p.kode = a.cabang JOIN attribute at on p.kunjungan = at.kode WHERE a.project = '$project' AND a.cabang = '$cabang' AND p.kunjungan = '$id'
            AND ((a.weekend_siang = p.kunjungan AND a.shp_weekend_siang = '$user' AND a.status_weekend_siang = 0)
                OR (a.weekend_malam = p.kunjungan AND a.shp_weekend_malam = '$user' AND a.status_weekend_malam = 0)
                OR (a.weekday_siang = p.kunjungan AND a.shp_weekday_siang = '$user' AND a.status_weekday_siang = 0)
                OR (a.weekday_malam = p.kunjungan AND a.shp_weekday_malam = '$user' AND a.status_weekday_malam = 0))")->result_array();
        }else{
          $data = $this->db->query("SELECT a.*, b.nama as skenario FROM `quest`a join attribute b on a.kunjungan = b.kode WHERE r_kategori = $id and project = '$project' and shp = '$user' and cabang = '$cabang' and status = 0")->result_array();
        }
        return $data;
    }

    public function updateAktual()
    {
        $id_project = $this->input->post('project', true);
        $id_user = $this->session->userdata('id_user');
        $kunjungan = $this->input->post('kodekunjungan');

        $datacek = $this->db->get_where('data_aktual', ['id_user' => $id_user, 'id_project' => $id_project, 'id_kunjungan' => $kunjungan])->result_array();

        foreach ($datacek as $data => $nilai) {
            $data = [
                'id_status' => $this->input->post('cek' . $nilai['id_aktual'], true)
            ];

            $this->db->where('id_aktual', $nilai['id_aktual']);
            $this->db->update('data_aktual', $data);
        }
    }

    public function updateAktualKB()
    {
        date_default_timezone_get('asia/bangkok');
        $project = $this->input->post('project', true);
        $id_user = $this->session->userdata('id_user');
        $kunjungan = $this->input->post('kodekunjungan');
        $cabang = $this->input->post('cabang');
        $lang = $this->input->post('lang');
        $long = $this->input->post('long');

        $datacek = $this->db->get_where('quest', ['shp' => $id_user, 'project' => $project, 'r_kategori' => $kunjungan, 'cabang' => $cabang])->result_array();

        $waktuassignjuga = date('Y-m-d H:i:s');

        foreach ($datacek as $data => $nilai) {

            $status = $this->input->post('cek' . $nilai['num'], true);

            if($status == 99){

                $this->db->where('num', $nilai['num']);
                $this->db->delete('quest');

            }else{

                $data = [
                    'status' => $status,
                    'latitude' => $lang,
                    'longitude' => $long,
                    'waktuassign' => $waktuassignjuga,
                ];

                $this->db->where('num', $nilai['num']);
                $this->db->update('quest', $data);

            }

        }
        // die;
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

    public function getproject_eb_user($id_user){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project
                                FROM
                                    project a
                                WHERE
                                    a.visible = 'y'
                                    AND a.type = 'n'
                                    AND channel='E-Banking'
                                    AND id_user='$id_user'
                                GROUP BY
                                    a.kode")->result_array();
    }

    public function getproject_digital_user($id_user){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project
                                FROM
                                    project a
                                WHERE
                                    a.visible = 'y'
                                    AND a.type = 'n'
                                    AND channel='Digital Banking'
                                    AND id_user='$id_user'
                                GROUP BY
                                    a.kode")->result_array();
    }

    public function getbank()
    {
        return $this->db->query("SELECT * FROM bank")->result_array();
    }

    public function gettransaksi()
    {
        return $this->db->query("SELECT * FROM attribute_ebanking")->result_array();
    }

    public function getsken_sosmed()
    {
        return $this->db->query("SELECT * FROM sosmed_skenario")->result_array();
    }

    public function getbank_progress($pro)
    {
        return $this->db->query("SELECT a.*,
                                    b.nama AS nama_bank
                                    FROM ebanking a
                                    LEFT JOIN bank b on a.bank=b.kode
                                    WHERE project='$pro'
                                    GROUP BY a.bank ")->result_array();
    }

    public function getbank_sosmed($pro)
    {
        return $this->db->query("SELECT a.*,
                                    b.nama AS nama_bank
                                    FROM sosmed a
                                    LEFT JOIN bank b on a.bank=b.kode
                                    WHERE project='$pro'
                                    GROUP BY a.bank ")->result_array();
    }

    public function getprogress($id, $bank, $channel, $transaksi, $plotting)
    {

            $this->db->select('a.*, b.nama AS nama_bank, c.nama AS nama_transaksi, d.nama AS nama_project, f.nama AS shopper');
            $this->db->from('ebanking a');
            $this->db->join('bank b', 'a.bank=b.kode', 'left');
            $this->db->join('attribute_ebanking c', 'a.transaksi=c.kode', 'left');
            $this->db->join('project d', 'a.project=d.kode', 'left');
            $this->db->join('ebanking_shopper f', 'a.nama_shopper=f.id', 'left');

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
        if ($plotting != '') {
            if ($plotting == 1) {
                $this->db->where('a.tanggal_evaluasi !=', NULL);
                $this->db->where('a.status', 0);
            } else if ($plotting == 0) {
                $this->db->where('a.tanggal_evaluasi', NULL);
                $this->db->where('a.status', 0);
            }
        }

            return $this->db->get()->result_array(); 

        // if ($id != '' AND $bank != '' AND $channel != '' AND $transaksi != '') {
          
        //     return $this->db->query("SELECT a.*,
        //                                 b.nama AS nama_bank,
        //                                 c.nama AS nama_transaksi,
        //                                 d.nama AS nama_project
        //                                 FROM ebanking a
        //                                 LEFT JOIN bank b ON a.bank=b.kode
        //                                 LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
        //                                 LEFT JOIN project d ON a.project=d.kode
        //                                 WHERE project='$id'
        //                                 AND a.bank = '$bank'
        //                                 AND a.channel = '$channel'
        //                                 AND a.transaksi = '$transaksi'

        //                                 ")->result_array();
        // } else if ($id != '' AND $bank != '' AND $channel != '' AND $transaksi == '') {
          
        //     return $this->db->query("SELECT a.*,
        //                                 b.nama AS nama_bank,
        //                                 c.nama AS nama_transaksi,
        //                                 d.nama AS nama_project
        //                                 FROM ebanking a
        //                                 LEFT JOIN bank b ON a.bank=b.kode
        //                                 LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
        //                                 LEFT JOIN project d ON a.project=d.kode
        //                                 WHERE project='$id'
        //                                 AND a.bank = '$bank'
        //                                 AND a.channel = '$channel'
        //                                 -- AND a.transaksi = '$transaksi'
        //                                 ")->result_array();
        // } else if ($id != '' AND $bank != '' AND $channel == '' AND $transaksi == '') {
          
        //     return $this->db->query("SELECT a.*,
        //                                 b.nama AS nama_bank,
        //                                 c.nama AS nama_transaksi,
        //                                 d.nama AS nama_project
        //                                 FROM ebanking a
        //                                 LEFT JOIN bank b ON a.bank=b.kode
        //                                 LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
        //                                 LEFT JOIN project d ON a.project=d.kode
        //                                 WHERE project='$id'
        //                                 AND a.bank = '$bank'
        //                                 -- AND a.channel = '$channel'
        //                                 -- AND a.transaksi = '$transaksi'
        //                                 ")->result_array();
        // } else if ($id != '' AND $bank == '' AND $channel == '' AND $transaksi == '') {
          
        //     return $this->db->query("SELECT a.*,
        //                                 b.nama AS nama_bank,
        //                                 c.nama AS nama_transaksi,
        //                                 d.nama AS nama_project
        //                                 FROM ebanking a
        //                                 LEFT JOIN bank b ON a.bank=b.kode
        //                                 LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
        //                                 LEFT JOIN project d ON a.project=d.kode
        //                                 WHERE project='$id'
        //                                 -- AND a.bank = '$bank'
        //                                 -- AND a.channel = '$channel'
        //                                 -- AND a.transaksi = '$transaksi'
        //                                 ")->result_array();
        // } else if ($id != '' AND $bank == '' AND $channel != '' AND $transaksi == '') {
          
        //     return $this->db->query("SELECT a.*,
        //                                 b.nama AS nama_bank,
        //                                 c.nama AS nama_transaksi,
        //                                 d.nama AS nama_project
        //                                 FROM ebanking a
        //                                 LEFT JOIN bank b ON a.bank=b.kode
        //                                 LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
        //                                 LEFT JOIN project d ON a.project=d.kode
        //                                 WHERE project='$id'
        //                                 -- AND a.bank = '$bank'
        //                                 AND a.channel = '$channel'
        //                                 -- AND a.transaksi = '$transaksi'
        //                                 ")->result_array();
        // }

    }

    public function getplotsosmed($id, $bank, $platform, $skenario, $hari, $waktu, $trx)
    {

          
            return $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_skenario,
                                        d.nama AS nama_project
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        -- AND a.bank = '$bank'
                                        AND a.platform = '$platform'
                                        AND a.skenario = '$skenario'
                                        AND a.hari = '$hari'
                                        AND a.waktu = '$waktu'
                                        AND a.trx_ke = '$trx'
                                        AND a.tanggal_evaluasi IS NULL
                                        AND a.status = 0
                                        ")->result_array();
     
    }

    public function getplotsosmed99($id, $bank, $platform, $skenario, $hari, $waktu, $trx)
    {

          
            return $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_skenario,
                                        d.nama AS nama_project
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        AND a.bank = '$bank'
                                        AND a.platform = '$platform'
                                        AND a.skenario = '$skenario'
                                        AND a.hari = '$hari'
                                        AND a.waktu = '$waktu'
                                        AND a.trx_ke = '$trx'
                                        AND a.tanggal_evaluasi IS NOT NULL
                                        AND a.status = 0
                                        ")->result_array();
     
    }

    public function getupdate_plotsosmed($id, $bank, $platform, $skenario, $hari, $waktu, $trx)
    {

          
            return $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_skenario,
                                        d.nama AS nama_project
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        -- AND a.bank = '$bank'
                                        AND a.platform = '$platform'
                                        AND a.skenario = '$skenario'
                                        AND a.hari = '$hari'
                                        AND a.waktu = '$waktu'
                                        AND a.trx_ke = '$trx'
                                        AND a.tanggal_evaluasi IS NOT NULL
                                        AND a.status = 0
                                        ")->result_array();
     
    }

    public function getplotting($id, $bank, $channel, $transaksi, $hari, $waktu, $trx)
    {

          
            return $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_transaksi,
                                        d.nama AS nama_project
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        -- AND a.bank = '$bank'
                                        AND a.channel = '$channel'
                                        AND a.transaksi = '$transaksi'
                                        AND a.hari = '$hari'
                                        AND a.waktu = '$waktu'
                                        AND a.trx_ke = '$trx'
                                        AND a.tanggal_evaluasi IS NULL
                                        AND a.status = 0
                                        ")->result_array();
     
    }

    public function getupdate_plotting($id, $bank, $channel, $transaksi, $hari, $waktu, $trx)
    {

          
            return $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_transaksi,
                                        d.nama AS nama_project
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        -- AND a.bank = '$bank'
                                        AND a.channel = '$channel'
                                        AND a.transaksi = '$transaksi'
                                        AND a.hari = '$hari'
                                        AND a.waktu = '$waktu'
                                        AND a.trx_ke = '$trx'
                                        AND a.tanggal_evaluasi IS NOT NULL
                                        AND a.status = 0
                                        ")->result_array();
     
    }

    public function getsken_plotsosmed($pro, $bank, $plat)
    {
        return $this->db->query("SELECT a.*,
                                    c.nama as nama_skenario
                                    FROM sosmed a
                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                    WHERE project='$pro'
                                    -- AND bank = '$bank'
                                    AND platform = '$plat'
                                   GROUP BY a.skenario
                                    ")->result_array();
    }

    public function getprogress_sosmed($id, $bank, $platform, $skenario, $plotting)
    {

            $this->db->select('a.*, b.nama AS nama_bank, c.nama AS nama_skenario, d.nama AS nama_project, f.nama AS shopper');
            $this->db->from('sosmed a');
            $this->db->join('bank b', 'a.bank=b.kode', 'left');
            $this->db->join('sosmed_skenario c', 'a.skenario=c.kode', 'left');
            $this->db->join('project d', 'a.project=d.kode', 'left');
            $this->db->join('ebanking_shopper f', 'a.nama_shopper=f.id', 'left');

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
        if ($plotting != '') {
            if ($plotting == 1) {
                $this->db->where('a.tanggal_evaluasi !=', NULL);
                $this->db->where('a.status', 0);
            } else if ($plotting == 0) {
                $this->db->where('a.tanggal_evaluasi', NULL);
                $this->db->where('a.status', 0);
            }
        }

            return $this->db->get()->result_array();
    }

    public function gettransaksi_plotting($pro, $bank, $chan)
    {
        return $this->db->query("SELECT a.*,
                                    c.nama as nama_transaksi
                                    FROM ebanking a
                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                    WHERE project='$pro'
                                    -- AND bank = '$bank'
                                    AND channel = '$chan'
                                   GROUP BY a.transaksi
                                    ")->result_array();
    }

    public function gettransaksi_ebanking_form($pro, $bank, $chan)
    {
        if ($bank == NULL) {
         return $this->db->query("SELECT a.*,
                                    c.nama as nama_transaksi
                                    FROM ebanking a
                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                    WHERE project='$pro'
                                    -- AND bank = '$bank'
                                    AND channel = '$chan'
                                   GROUP BY a.transaksi
                                    ")->result_array();
        } else {
        return $this->db->query("SELECT a.*,
                                    c.nama as nama_transaksi
                                    FROM ebanking a
                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                    WHERE project='$pro'
                                    AND bank = '$bank'
                                    AND channel = '$chan'
                                   GROUP BY a.transaksi
                                    ")->result_array();
        }
    }

    public function getsken_sosmed_form($pro, $bank, $plat)
    {
        return $this->db->query("SELECT a.*,
                                    c.nama as nama_skenario
                                    FROM sosmed a
                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                    WHERE project='$pro'
                                    AND bank = '$bank'
                                    AND platform = '$plat'
                                   GROUP BY a.skenario
                                    ")->result_array();
    }

    public function getaplikasi($bank, $chan)
    {
        return $this->db->query("SELECT *
                                    FROM ebanking_aplikasi
                                    WHERE bank = '$bank'
                                    AND channel = '$chan'
                                    ")->result_array();
    }

    public function getaplikasi_aktual($bank, $chan, $pro)
    {
        if ($chan == 'SMS Banking') {
        return $this->db->query("SELECT *
                                    FROM ebanking
                                    WHERE channel = '$chan'
                                    AND project ='$pro'
                                    AND bank='$bank'
                                    GROUP BY os
                                    ")->result_array();
        } else {
        return $this->db->query("SELECT *
                                    FROM ebanking_aplikasi
                                    WHERE bank = '$bank'
                                    AND channel = '$chan'
                                    ")->result_array();
        }
    }


    public function getversi($bank, $chan, $transaksi, $os)
    {
        if ($chan == 'SMS Banking') {
            $os2 = $os;
            $jenis = '';
        } else {
            $split = explode("_", $os);

            $os2 = $split[0];
            $jenis = $split[1];
        }
        return $this->db->query("SELECT *
                                    FROM ebanking_data_td
                                    WHERE bank = '$bank'
                                    AND channel = '$chan'
                                    AND transaksi = '$transaksi'
                                    AND os = '$os2'
                                    AND jenis = '$jenis'
                                GROUP BY bank, channel, transaksi, os, jenis, versi
                                    ")->result_array();
    }

    public function getchannel($id_bank){
         return $this->db->query("SELECT
                                    * from ebanking where bank='$id_bank'
                                    GROUP BY channel")->result_array();
    }

    public function gettujuan($bank, $transaksi, $jumlah, $nama_trx)
    {
        $get = $this->db->get_where('attribute_ebanking', array('kode' => $transaksi))->row_array();

        if ($nama_trx == 'Overbooking') {
            return $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.bank='$bank'
                                        AND a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else if ($nama_trx == 'Interbank Online' OR $nama_trx == 'Interbank Offline' OR $nama_trx == 'ITB Online' OR $nama_trx == 'ITB Offline') {
            return $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.bank!='$bank'
                                        AND a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else if(strpos($nama_trx,"Pulsa")) {
             return $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else if(strpos($nama_trx,"Kartu Kredit")) {
             return $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else if(strpos($nama_trx,"E-Money") OR strpos($nama_trx,"EMoney")) {
             return $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else {
            return $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE 
                                        -- a.bank='$bank'
                                        -- AND 
                                        a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        }
    }

    public function gettransaksi_eb($bank, $channel, $project){
         return $this->db->query("SELECT
                                    a.transaksi, b.nama 
                                    from ebanking a join attribute_ebanking b on a.transaksi=b.kode 
                                    where bank='$bank' AND channel='$channel' AND project='$project'
                                    GROUP BY a.transaksi")->result_array();
    }

    public function getwaktu($jam_mulai, $jam_selesai){
         return $this->db->query("SELECT * FROM `waktu` WHERE awal <= '$jam_mulai' AND akhir >= '$jam_mulai'")->result_array();
    }

    public function updateAktualKB2()
    {
        date_default_timezone_get('asia/bangkok');
        $project = $this->input->post('project', true);
        $id_user = $this->session->userdata('id_user');
        $kunjungan = $this->input->post('kodekunjungan');
        $cabang = $this->input->post('cabang');
        $lang = $this->input->post('lang');
        $long = $this->input->post('long');

        $datacek = $this->db->get_where('quest', ['shp' => $id_user, 'project' => $project, 'r_kategori' => $kunjungan, 'cabang' => $cabang])->result_array();

        $waktuassignjuga = date('Y-m-d H:i:s');
        $atmcenter = array('064','065','066','067');
        if (in_array($kunjungan, $atmcenter)){
          $num = $this->input->post('numnya', true);
          $status = $this->input->post('cek' . $num, true);
          $noform = serialize(array(
            "waktuassign" => $waktuassignjuga,
            "latitude" => $lang,
            "longitude" => $long,
            "rekaman" => false,
            "tglrekaman" => NULL,
            "rekaman_status" => 0,
            "upload_ulang_rekaman" => NULL,
            "equest" => NULL,
            "tlhonor" => 0,
            "bukti" => NULL,
            "dp" => NULL,
            "validator_id" => NULL
          ));
          if($kunjungan == '064'){
            $data = [
              'status_weekday_siang' => $status,
              'noform_weekday_siang' => $noform
            ];
          }
          else if($kunjungan == '065'){
            $data = [
              'status_weekend_siang' => $status,
              'noform_weekend_siang' => $noform
            ];
          }
          else if($kunjungan == '066'){
            $data = [
              'status_weekday_malam' => $status,
              'noform_weekday_malam' => $noform
            ];
          }
          else if($kunjungan == '067'){
            $data = [
              'status_weekend_malam' => $status,
              'noform_weekend_malam' => $noform
            ];
          }
          $this->db->where(['num' => $num])->update('atmcenter', $data);
        }else {
            foreach ($datacek as $data => $nilai) {

                $ketgagal = $this->input->post('ketgagal' . $nilai['num'], true);

                if ($ketgagal == null) {

                    if ($nilai['status'] == '0') {
                        $data = [
                            'status' => $this->input->post('cek' . $nilai['num'], true),
                            'latitude' => $lang,
                            'longitude' => $long,
                            'waktuassign' => $waktuassignjuga,
                        ];
                        $this->db->where('num', $nilai['num']);
                        $this->db->update('quest', $data);
                    }
                    // var_dump($data);
                    // die;
                }else{
                      $data = [
                          'project' => $project,
                          'cabang' => $cabang,
                          'kunjungan' => $this->input->post('kodeskenario' . $nilai['num'], true),
                          'shp' => $id_user,
                          'tanggal' => $this->input->post('tglkunj' . $nilai['num'], true),
                          'idstkb' => $this->input->post('stkb' . $nilai['num'], true),
                          'status' => 0,
                          'latitude' => $lang,
                          'longitude' => $long,
                          'waktuassign' => $waktuassignjuga,
                          'keterangan' => $this->input->post('ketgagal' . $nilai['num'], true),
                      ];
                      $this->db->insert('quest_hapus_history', $data);
                      $this->db->delete('quest', ['num' => $nilai['num']]);
                      // var_dump($data);
                      // die;
                }
            }
            // die;
        }
    }

    public function getnorek_ebanking()
    {
        return $this->db->query("SELECT a.*, b.nama AS nama_bank FROM ebanking_rekening a JOIN bank b ON a.bank=b.kode ORDER BY a.nama")->result_array();
    }

    public function getnorek_bank($bank)
    {
        return $this->db->query("SELECT a.*, b.nama AS nama_bank FROM ebanking_rekening a JOIN bank b ON a.bank=b.kode WHERE a.bank='$bank' AND kategori='Rekening' ORDER BY a.nama")->result_array();
    }

}
