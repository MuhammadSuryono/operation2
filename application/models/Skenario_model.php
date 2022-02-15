<?php

class Skenario_model extends CI_model
{

    // DB di kerjabakti
    // public function getdatabriefing($id_user){
    //     $this->db->select('a.*');
    //     $this->db->select('b.nama_project');
    //     $this->db->from('data_skenario a');
    //     $this->db->join('data_project b', 'a.kode_project = b.kode_project');
    //     $this->db->where('a.id_user', $id_user);
    //     return $this->db->get()->result_array();
    // }

    //DB JAY2
    public function getdatabriefing($id_user){

        return $this->db->query("SELECT
                                    a.nama AS nama_project,
                                    b.*,
                                    c.nama AS nama_skenario

                                FROM
                                    project a
                                    JOIN data_skenario b ON a.kode = b.kode_project
                                    JOIN attribute c ON b.nama_skenario = c.kode
                                WHERE
                                a.id_user = '$id_user'
                                AND a.visible = 'y'
                                AND a.type = 'n'")->result_array();
    }

    // DB di kerjabakti
    // public function getprojects($id_user){
    //     $this->db->select('*');
    //     $this->db->from('data_project');
    //     $this->db->where('id_user', $id_user);
    //     return $this->db->get()->result_array();
    // }

    //DB JAY2
    public function getprojects($id_user){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project,
                                    b.kategori
                                FROM
                                    project a
                                    JOIN skenario b ON a.kode = b.project
                                WHERE
                                    a.id_user = '$id_user'
                                    AND a.visible = 'y'
                                    AND a.type = 'n'
                                -- 	AND NOT EXISTS ( SELECT c.num FROM skenario c WHERE c.project = a.kode AND b.kategori = c.kategori )
                                GROUP BY
                                    a.kode")->result_array();
    }

    public function getprojects2($id_user){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project
                                FROM
                                    project a
                                WHERE
                                    a.id_user = '$id_user'
                                    AND a.visible = 'y'
                                    AND a.type = 'n'
                                    AND (channel != 'E-Banking' OR channel IS NULL)
                                GROUP BY
                                    a.kode")->result_array();
    }

    public function getproject_ebanking($id_user){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project
                                FROM
                                    project a
                                WHERE
                                    a.id_user = '$id_user'
                                    AND a.visible = 'y'
                                    AND a.type = 'n'
                                    AND channel='E-Banking'
                                GROUP BY
                                    a.kode")->result_array();
    }

    public function getproject_digital($id_user){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project
                                FROM
                                    project a
                                WHERE
                                    a.id_user = '$id_user'
                                    AND a.visible = 'y'
                                    AND a.type = 'n'
                                    AND channel='Digital Banking'
                                GROUP BY
                                    a.kode")->result_array();
    }




    public function getprojectskenario($id_user){
        $this->db->select('*');
        $this->db->from('data_project_kunjungan');
        $this->db->where('id_user', $id_user);
        $this->db->group_by('kode_project');
        return $this->db->get()->result_array();
    }

    public function getprojectskenario2($id_user){
        $this->db->select('*');
        $this->db->from('data_project_kunjungan');
        $this->db->where('id_user', $id_user);
        return $this->db->get()->result_array();
    }

    //DB Kerjabakti
    // public function viewskenario($id_user){
    //     return $this->db->query("SELECT
    //                             a.*,
    //                             c.nama_project,
    //                             d.nama,
    //                             GROUP_CONCAT( b.nama ) AS skenariox
    //                         FROM
    //                             data_skenario_kunjungan a
    //                         JOIN attribute b ON a.kode = b.kode
    //                         JOIN data_project c ON a.kode_project = c.kode_project
    //                         JOIN attribute d ON a.kategori = d.kode
    //                         WHERE
    //                             a.id_user = '$id_user'
    //                         GROUP BY a.kode_project, a.kategori")->result_array();
    // }

    public function viewskenario($id_user){

        /*return $this->db->query("SELECT a.*, b.*,
                                	c.nama AS nama_project,
					c.kode,
                                	d.nama,
                                	GROUP_CONCAT( b.nama SEPARATOR ' - ' ) AS skenariox
                                FROM
                                	skenario a
                                	JOIN attribute b ON a.att = b.kode
                                	JOIN project c ON a.project = c.kode AND c.visible = 'y' AND c.type = 'n'
                                	JOIN attribute d ON a.kategori = d.kode
                                WHERE
                                	c.id_user = '$id_user'
                                GROUP BY
                                	a.project,
                                	a.kategori
                                ORDER BY
                                	a.project ASC,
                                	a.kategori ASC,
                                	a.att ASC")->result_array();*/
//Revisi AdamSantoso
return $this->db->query("SELECT a.*, b.*,
                                    z.nama AS nama_kunjungan,
                                	c.nama AS nama_project,
					GROUP_CONCAT( b.nama order by a.att SEPARATOR ' - ' ) AS skenariox
                                FROM
                                	skenario a
                                    JOIN attribute z ON a.kategori = z.kode
                                	JOIN attribute b ON a.att = b.kode
                                	JOIN project c ON a.project = c.kode AND c.visible = 'y' AND c.type = 'n'
                                WHERE
                                	c.id_user = '$id_user'
                                GROUP BY
                                	a.project,
                                	a.kategori
                                ORDER BY
                                	a.project ASC,
                                	a.kategori ASC,
                                	a.att ASC")->result_array();



    }

     public function viewskenario_ebanking($id_user){

        
    return $this->db->query("SELECT a.*, 
                                    -- z.nama AS nama_kunjungan,
                                    c.nama AS nama_project,
                                    z.nama AS nama_transaksi,
                                    b.nama AS nama_bank
                    
                                 FROM
                                    ebanking a
                                    JOIN attribute_ebanking z ON a.transaksi = z.kode
                                    JOIN bank b ON a.bank = b.kode
                                    
                                    JOIN project c ON a.project = c.kode AND c.visible = 'y' AND c.type = 'n'
                                WHERE
                                    c.id_user = '$id_user'
                                -- GROUP BY
                                --     a.project,
                                --     a.kategori
                                ORDER BY
                                    a.project ASC,
                                    a.num ASC
                                    -- a.kategori ASC,
                                    -- a.att ASC
                                    ")->result_array();




    }

    //DB Kerjabakti
    // public function getskenariokunjungan($id_user, $id){

    //     // $this->db->select('a.*, b.nama');
    //     // $this->db->from('data_project_kunjungan a');
    //     // $this->db->join('attribute b', 'a.kategori = b.kode');
    //     // $this->db->where('a.id_user', $id_user);
    //     // $this->db->where('a.kode_project', $id);
    //     // $this->db->group_by('kategori');
    //     // return $this->db->get()->result_array();

    //     return $this->db->query("SELECT a.*, b.nama FROM data_skenario_kunjungan a JOIN attribute b ON a.kategori = b.kode WHERE a.kode_project = '$id' AND a.id_user = '$id_user' group by a.kategori")->result_array();
    // }

    //DB Jay2
    public function getskenariokunjungan($id_user, $id){

        return $this->db->query("SELECT
                                    a.kode AS kode_project,
                                    a.nama AS nama_project,
                                    b.kategori AS kode,
                                    d.nama
                                FROM
                                    project a
                                    JOIN skenario b ON a.kode = b.project
                                    JOIN attribute d ON d.kode = b.kategori
                                WHERE
                                    a.id_user = '$id_user'
                                    AND a.kode = '$id'
                                    AND NOT EXISTS ( SELECT c.id_skenario FROM data_skenario c WHERE c.kode_project = a.kode AND b.kategori = c.nama_skenario )
                                GROUP BY
                                    b.kategori")->result_array();
    }

    public function getkunjungan(){
        $this->db->order_by('kode');
        return $this->db->get_where('attribute', ['flag'=>1])->result_array();
        //return $this->db->get_where('attribute', ['kunjungan_q'=>1])->result_array();
    }

    public function gettransaksi(){
         $this->db->order_by('nama');
        return $this->db->get('attribute_ebanking')->result_array();
    }

    public function getAllDataSkenario(){
        $this->db->Select('*');
        $this->db->From('attribute');
        $this->db->order_by('nama', 'asc');
        return $this->db->get()->result_array();
    }

    public function tambah($img1, $img2){

        $data = [
                'id_user' => $this->session->userdata['id_user'],
                'kode_project' => $this->input->post('project'),
                'nama_skenario' => $this->input->post('kunjungan'),
                'file_skenario' => $img1,
                'file_kuis' => $img2,
            ];
            $this->db->insert('data_skenario', $data);
    }

    public function hapus($id){
        $data = $this->db->get_where('data_skenario', ['id_skenario' => $id])->row_array();

        unlink(FCPATH . '/assets/file/skenario' . $data['file_skenario']);
        unlink(FCPATH . '/assets/file/skenario' . $data['file_kuis']);
        $this->db->delete('data_skenario', ['id_skenario' => $id]);
    }

    public function getRowData(){
        return $this->db->get('data_skenario')->num_rows();
    }

    public function getSkenarioById($id){
        return $this->db->get_where('data_skenario', ['id_skenario' => $id])->row_array();
    }

    public function ubah($id, $img, $img3){
        $data = $this->db->get_where('data_skenario', ['id_skenario' => $id])->row_array();

        //jika ada img1 REKAMAN baru
        if ($img != 0){
            unlink(FCPATH . '/assets/file/skenario/' . $data['file_skenario']);
        } else {
            $img = $data['file_skenario'];
        }

        //jika ada img1 KUIS baru
        if ($img3 != 0){
            unlink(FCPATH . '/assets/file/skenario/' . $data['file_kuis']);
        } else {
            $img3 = $data['file_kuis'];
        }

        $data = [
                'nama_skenario' => htmlspecialchars($this->input->post('skenario', true)),
                'file_skenario' => $img,
                'file_kuis' => $img3,
            ];

            $this->db->where('id_skenario', $id);
            $this->db->update('data_skenario', $data);
    }

    public function getAllDataProject(){
        return $this->db->get('data_project')->result_array();
    }

    //db kerjabakti
    // public function getallprojectskenario(){

    //     return $this->db->query("SELECT
    //                                 a.num,
    //                                 a.nostkb,
    //                                 d.nama AS nama_cabang,
    //                                 a.shp,
    //                                 b.Nama,
    //                                 c.nama_project,
    //                                 e.nama AS r_kategori,
    //                                 f.nama AS skenario
    //                             FROM
    //                                 quest a
    //                                 JOIN id_data b ON a.shp = b.Id
    //                                 JOIN data_project c ON a.project = c.kode_project
    //                                 JOIN cabang d ON a.cabang = d.kode
    //                                 AND a.project = d.project
    //                                 JOIN attribute e ON a.r_kategori = e.kode
    //                                 JOIN attribute f ON a.kunjungan = f.kode

    //                             WHERE
    //                                 NOT a.rekaman_status = '3'")->result_array();

    // }

    //db jay2
    public function getallprojectskenario(){
        $id_user = $this->session->userdata('id_user');
        $dataNonATM = $this->db->query("SELECT
                                    a.*,
                                    -- a.num,
                                    -- a.tanggal,
                                    -- a.nomorstkb,
                                    d.nama AS nama_cabang,
                                    -- a.pwt,
                                    h.nama as nama_pwt,
                                    -- a.shp,
                                    b.Nama,
                                    c.nama AS nama_project,
                                    e.nama AS r_kategori,
                                    f.nama AS skenario
                                FROM
                                    quest a
                                    JOIN id_data b ON a.shp = b.Id
                                    LEFT JOIN id_data h ON a.pwt = h.Id
                                    JOIN project c ON a.project = c.kode
                                    JOIN cabang d ON a.cabang = d.kode
                                    JOIN plan g ON a.project = g.project AND a.cabang = g.kode AND a.nomorstkb = g.nomorstkb
                                    AND a.project = d.project
                                    JOIN attribute e ON a.r_kategori = e.kode
                                    JOIN attribute f ON a.kunjungan = f.kode
                                WHERE
                                    (g.kareg = '$id_user' OR g.field_officer = '$id_user')
                                    AND NOT a.rekaman_status = '3'
                                    AND c.type = 'n'
                                GROUP BY
                                a.project,
	                            a.cabang,
	                            a.kunjungan")->result_array();

        $dataATM = $this->db->query("SELECT a.num, b.project,
                                  c.nama as nama_project,
                                  b.nomorstkb,
                                  b.kunjungan as r_kategori,
                                  d.nama as skenario,
                                  a.namacabang as nama_cabang,
                                  a.shp_weekend_siang, a.tgl_weekend_siang,
                                  a.shp_weekend_malam, a.tgl_weekend_malam,
                                  a.shp_weekday_siang, a.tgl_weekday_siang,
                                  a.shp_weekday_malam, a.tgl_weekday_malam,
                                  '' as pwt, '' as nama_pwt, '' as shp, '' as Nama
                                  -- e.shp, f.Nama, e.tanggal,
                                  -- e.pwt, g.Nama as nama_pwt
                                FROM
                                    plan b
                                    LEFT JOIN atmcenter a ON a.project = b.project AND a.cabang = b.kode
                                    AND (a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL)
                                    AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3)
                                    OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
                                    OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
                                    OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
                                    -- LEFT JOIN cabang c2 ON b.kode = c2.kode AND b.project = c2.project
                                    -- LEFT JOIN quest e ON b.project = e.project AND b.kode = e.cabang AND e.status < 3
                                    JOIN project c ON a.project = c.kode
                                    -- LEFT JOIN attribute e2 ON e.r_kategori = e2.kode
                                    JOIN attribute d ON b.kunjungan = d.kode
                                    -- LEFT JOIN id_data f ON e.shp = f.Id
                                    -- LEFT JOIN id_data g ON e.pwt = g.Id
                                WHERE
                                  (b.kareg = '$id_user' OR b.field_officer = '$id_user') AND
                                  (a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL
                                  AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3) OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
                                        OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
                                        OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
                                  )
                                  -- NOT e.rekaman_status = 3 AND e.shp IS NOT NULL AND e.kunjungan = b.kunjungan
                                GROUP BY
                                  b.kunjungan
                                ORDER BY b.nomorstkb DESC
                                ")->result_array();

      return array_merge($dataNonATM, $dataATM);
    }
    // public function getallprojectskenario(){
    //     $id_user = $this->session->userdata('id_user');
    //     // KODINGAN AWAL BANGET
    //     // return $this->db->query("SELECT
    //     //                             a.num,
    //     //                             a.tanggal,
    //     //                             a.nomorstkb,
    //     //                             d.nama AS nama_cabang,
    //     //                             a.pwt,
    //     //                             h.nama as nama_pwt,
    //     //                             a.shp,
    //     //                             b.Nama,
    //     //                             c.nama AS nama_project,
    //     //                             e.nama AS r_kategori,
    //     //                             f.nama AS skenario
    //     //                         FROM
    //     //                             quest a
    //     //                             JOIN id_data b ON a.shp = b.Id
    //     //                             LEFT JOIN id_data h ON a.pwt = h.Id
    //     //                             JOIN project c ON a.project = c.kode
    //     //                             LEFT JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
    //     //                             JOIN plan g ON a.project = g.project AND a.cabang = g.kode AND a.nomorstkb = g.nomorstkb
    //     //                             JOIN attribute e ON a.r_kategori = e.kode
    //     //                             JOIN attribute f ON a.kunjungan = f.kode
    //     //                         WHERE
    //     //                             g.kareg = '$id_user'
    //     //                             AND NOT a.rekaman_status = '3'
    //     //                         GROUP BY
    //     //                         a.project,
	  //     //                       a.cabang,
	  //     //                       a.kunjungan")->result_array();
    //     // KODINGAN BARU BY ADAM SANTOSO
    //     // return $this->db->query("SELECT b.project,
    //     //                           c.nama as nama_project,
    //     //                           b.nomorstkb,
    //     //                           b.kunjungan as r_kategori,
    //     //                           d.nama as skenario,
    //     //                           IF(a.namacabang IS NOT NULL, a.namacabang, c2.nama) as nama_cabang,
    //     //                           -- c2.nama as nama_cabang,
    //     //                           a.shp_weekend_siang, a.tgl_weekend_siang,
    //     //                           a.shp_weekend_malam, a.tgl_weekend_malam,
    //     //                           a.shp_weekday_siang, a.tgl_weekday_siang,
    //     //                           a.shp_weekday_malam, a.tgl_weekday_malam,
    //     //                           e.shp, f.Nama, e.tanggal,
    //     //                           e.pwt, g.Nama as nama_pwt
    //     //                         FROM
    //     //                             plan b
    //     //                             LEFT JOIN atmcenter a ON a.project = b.project AND a.cabang = b.kode
    //     //                             AND (a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL)
    //     //                             AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3)
    //     //                             OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
    //     //                             OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
    //     //                             OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
    //     //                             LEFT JOIN cabang c2 ON b.kode = c2.kode AND b.project = c2.project
    //     //                             LEFT JOIN quest e ON b.project = e.project AND b.kode = e.cabang AND e.status < 3
    //     //                             JOIN project c ON e.project = c.kode
    //     //                              OR a.project = c.kode
    //     //                             LEFT JOIN attribute e2 ON e.r_kategori = e2.kode
    //     //                             JOIN attribute d ON b.kunjungan = d.kode
    //     //                             LEFT JOIN id_data f ON e.shp = f.Id
    //     //                             LEFT JOIN id_data g ON e.pwt = g.Id
    //     //                         WHERE
    //     //                           b.kareg = '$id_user' AND
    //     //                           ((a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL
    //     //                           AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3) OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
    //     //                                 OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
    //     //                                 OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
    //     //                           ) OR (e.shp IS NOT NULL AND NOT e.rekaman_status = 3 AND e.nomorstkb = b.nomorstkb))
    //     //                           -- NOT e.rekaman_status = 3 AND e.shp IS NOT NULL AND e.kunjungan = b.kunjungan
    //     //                         GROUP BY
    //     //                           b.kunjungan
    //     //                         ORDER BY b.nomorstkb DESC
    //     //                         ")->result_array();
    //
    //     // TAMBAHAN BARU BANGET BY ADAM SANTOSO 7 DESEMBER 2020
    //     $dataNonATM = $this->db->query("SELECT b.project,
    //                               c.nama as nama_project,
    //                               b.nomorstkb,
    //                               b.kunjungan as r_kategori,
    //                               d.nama as skenario,
    //                               -- IF(a.namacabang IS NOT NULL, a.namacabang, c2.nama) as nama_cabang,
    //                               c2.nama as nama_cabang,
    //                               -- a.shp_weekend_siang, a.tgl_weekend_siang,
    //                               -- a.shp_weekend_malam, a.tgl_weekend_malam,
    //                               -- a.shp_weekday_siang, a.tgl_weekday_siang,
    //                               -- a.shp_weekday_malam, a.tgl_weekday_malam,
    //                               e.shp, f.Nama, e.tanggal,
    //                               e.pwt, g.Nama as nama_pwt
    //                             FROM
    //                                 plan b
    //                                 -- LEFT JOIN atmcenter a ON a.project = b.project AND a.cabang = b.kode
    //                                 -- AND (a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL)
    //                                 -- AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3)
    //                                 -- OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
    //                                 -- OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
    //                                 -- OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
    //                                 LEFT JOIN cabang c2 ON b.kode = c2.kode AND b.project = c2.project
    //                                 LEFT JOIN quest e ON b.project = e.project AND b.kode = e.cabang AND e.status < 3
    //                                 JOIN project c ON e.project = c.kode
    //                                  -- OR a.project = c.kode
    //                                 LEFT JOIN attribute e2 ON e.r_kategori = e2.kode
    //                                 JOIN attribute d ON b.kunjungan = d.kode
    //                                 LEFT JOIN id_data f ON e.shp = f.Id
    //                                 LEFT JOIN id_data g ON e.pwt = g.Id
    //                             WHERE
    //                               b.kareg = '$id_user' AND
    //                               -- ((a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL
    //                               -- AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3) OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
    //                               --       OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
    //                               --       OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
    //                               -- ) OR (e.shp IS NOT NULL AND NOT e.rekaman_status = 3 AND e.nomorstkb = b.nomorstkb))
    //                               NOT e.rekaman_status = 3 AND e.shp IS NOT NULL AND e.kunjungan = b.kunjungan AND e.nomorstkb = b.nomorstkb
    //                             GROUP BY
    //                               b.kunjungan
    //                             ORDER BY b.nomorstkb DESC
    //                             ")->result_array();
    //     $dataATM = $this->db->query("SELECT b.project,
    //                               c.nama as nama_project,
    //                               b.nomorstkb,
    //                               b.kunjungan as r_kategori,
    //                               d.nama as skenario,
    //                               a.namacabang as nama_cabang,
    //                               a.shp_weekend_siang, a.tgl_weekend_siang,
    //                               a.shp_weekend_malam, a.tgl_weekend_malam,
    //                               a.shp_weekday_siang, a.tgl_weekday_siang,
    //                               a.shp_weekday_malam, a.tgl_weekday_malam
    //                               -- e.shp, f.Nama, e.tanggal,
    //                               -- e.pwt, g.Nama as nama_pwt
    //                             FROM
    //                                 plan b
    //                                 LEFT JOIN atmcenter a ON a.project = b.project AND a.cabang = b.kode
    //                                 AND (a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL)
    //                                 AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3)
    //                                 OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
    //                                 OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
    //                                 OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
    //                                 -- LEFT JOIN cabang c2 ON b.kode = c2.kode AND b.project = c2.project
    //                                 -- LEFT JOIN quest e ON b.project = e.project AND b.kode = e.cabang AND e.status < 3
    //                                 JOIN project c ON a.project = c.kode
    //                                 -- LEFT JOIN attribute e2 ON e.r_kategori = e2.kode
    //                                 JOIN attribute d ON b.kunjungan = d.kode
    //                                 -- LEFT JOIN id_data f ON e.shp = f.Id
    //                                 -- LEFT JOIN id_data g ON e.pwt = g.Id
    //                             WHERE
    //                               b.kareg = '$id_user' AND
    //                               (a.shp_weekend_siang IS NOT NULL OR a.shp_weekend_malam IS NOT NULL OR a.shp_weekday_siang IS NOT NULL OR a.shp_weekday_malam IS NOT NULL
    //                               AND ((a.status_weekend_siang >= 0 AND a.status_weekend_siang < 3) OR (a.status_weekend_malam >= 0 AND a.status_weekend_malam < 3)
    //                                     OR (a.status_weekday_siang >= 0 AND a.status_weekday_siang < 3)
    //                                     OR (a.status_weekday_malam >= 0 AND a.status_weekday_malam < 3))
    //                               )
    //                               -- NOT e.rekaman_status = 3 AND e.shp IS NOT NULL AND e.kunjungan = b.kunjungan
    //                             GROUP BY
    //                               b.kunjungan
    //                             ORDER BY b.nomorstkb DESC
    //                             ")->result_array();
    //   return array_merge($dataNonATM, $dataATM);
    //
    // }

    public function tambahkunjungan($jumlahskenario){

        $project = $this->input->post('project1', true);
        $skenario = $this->input->post('kunjungan', true);
        $cek = $this->db->get_where('skenario', ['project' => $project, 'att' => $skenario ])->num_rows();
        //$cek = $this->db->get_where('data_skenario_kunjungan', ['id_project' => $project, 'kunjungan' => $kunjungan])->num_rows();


         if($cek == 0){
             if($project == "" or $skenario == "" or $jumlahskenario == null){
               $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  Project atau Kunjungan belum dipilih!
                   </div>');
                 redirect('skenario/kunjungan');
             } else {

                $data = [];
                $j = 0;

                    for($i=1; $i<=$jumlahskenario; $i++){
                      $att = htmlspecialchars($this->input->post("skenario".$i, true));
                        if ($att == '011' OR $att == '012' OR $att == '013' OR $att == '014' AND $att != 'Pilih Skenario') {
                          $data1 = [
                              'project' => $project,
                              'att' => $skenario,
                              'ket' => $att,
                                'numrow' => $j+1,
                              'kategori' => $skenario,
                            ];
                      } else if ($att != 'Pilih Skenario') {
                        $data1 = [
                          'project' => $project,
                          'att' => $att,
                              'numrow' => $j+1,
                          'kategori' => $skenario,
                        ];
                    }
                    $this->db->insert('skenario', $data1);

                    $j++;
                     
                    }

                
                //     for($i=1; $i<=$jumlahskenario; $i++){
                //       $att = htmlspecialchars($this->input->post("skenario".$i, true));
                //         $data1 = [
                //           'project' => $project,
                //           'att' => $att,
                //               'numrow' => $j+1,
                //           'kategori' => $skenario,
                //         ];
                //         if($att != 'Pilih Skenario'){
                //           $data[$j] = $data1;
                //         }
                //         $j++;
                //     }

                // $this->db->insert_batch('skenario', $data);


                $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Skenario Kunjungan telah <strong>ditambahkan!</strong>.
                </div>');

                redirect('skenario/kunjungan');
}
         } else {

             $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 Skenario Kunjungan sudah <strong>ada!</strong>.
                 </div>');

                 redirect('skenario/kunjungan');
         }
    }

    public function hapusshpkunjungan($id){

        $dbquest = $this->db->get_where('quest', ['num'=>$id])->row_array();

        $data = [
            'num' => $dbquest['num'],
            'project' => $dbquest['project'],
            'cabang' => $dbquest['cabang'],
            'kunjungan' => $dbquest['kunjungan'],
            'teller' => $dbquest['teller'],
            'shp' => $dbquest['shp'],
            'pwt' => $dbquest['pwt'],
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
            'centang' => $dbquest['centang'],
            'latitude' => $dbquest['latitude'],
            'longitude' => $dbquest['longitude'],
            'spvdua' => $dbquest['spvdua'],
            'tglkunjspv' => $dbquest['tglkunjspv'],
            'idstkb' => $dbquest['idstkb'],
            'waktuassign' => $dbquest['waktuassign'],
            'tdcs' => $dbquest['tdcs'],
            'tdteller' => $dbquest['tdteller'],
            'hasilgagal' => $dbquest['hasilgagal'],
            'keterangan' => 'dihapus PIC',
        ];

        $this->db->insert('quest_hapus_history', $data);

        $this->db->delete('quest', ['num' => $id]);
    }

    // DB KERJABAKTI
    // public function getAllDataSkenarioKunjungan(){

    //     $id = $this->session->userdata('id_user');

    //     return $this->db->query("SELECT
    //                                 a.*,
    //                                 c.nama_project,
    //                                 b.nama,
    //                                 g.nama AS cabang,
    //                                 h.Nama AS kareg,
    //                                 GROUP_CONCAT( e.nama SEPARATOR ' - ' ) AS skenario
    //                             FROM
    //                                 plan a
    //                                 JOIN attribute b ON a.kunjungan = b.kode
    //                                 JOIN data_project c ON a.project = c.kode_project
    //                                 JOIN data_skenario_kunjungan d ON a.project = d.kode_project
    //                                 AND a.kunjungan = d.kategori
    //                                 JOIN attribute e ON d.kode = e.kode
    //                                 JOIN cabang g ON a.kode = g.kode
    //                                 AND a.project = g.project
    //                                 JOIN id_data h ON h.Id = a.kareg
    //                             WHERE
    //                                 a.pic = '$id'
    //                                 AND NOT EXISTS (
    //                                 SELECT
    //                                     f.num
    //                                 FROM
    //                                     quest f
    //                                 WHERE
    //                                     a.project = f.project
    //                                     AND d.kode = f.kunjungan
    //                                     AND a.kode = f.cabang
    //                                 )
    //                                 AND EXISTS (
    //                                 SELECT
    //                                     g.total_nilai
    //                                 FROM
    //                                     data_nilai g
    //                                 WHERE
    //                                     g.kode_project = a.project
    //                                     AND g.kunjungan = a.kunjungan
    //                                     AND g.id_user = '$id'
    //                                 )
    //                             GROUP BY
    //                                 a.project,
    //                                 a.kunjungan,
    //                                 a.kode
    //                             ORDER BY
    //                                 a.planend ASC")->result_array();

    // }

    public function akunpribadi_sosmed(){
        return $this->db->get_where('sosmed_akun', array('milik' => 'Pribadi'))->result_array();
    }

    public function akunbank_sosmed(){
        return $this->db->join('bank', 'sosmed_akun.bank=bank.kode')->get_where('sosmed_akun', array('milik' => 'Bank'))->result_array();
    }

    public function skenario_sosmed(){
        return $this->db->get('sosmed_skenario')->result_array();
    }

    public function greeting_sosmed(){
        return $this->db->order_by('urut', 'asc')->get('sosmed_greeting')->result_array();
    }

    public function tambah_sosmed($jumlahskenario){

        $project = $this->input->post('project1', true);
        $bank = $this->input->post('bank', true);
        
        $platform = $this->input->post('platform', true);
        $skenario = $this->input->post('skenario', true);
        $cek = $this->db->get_where('sosmed', ['project' => $project, 'platform' => $platform, 'skenario' => $skenario ])->num_rows();
        //$cek = $this->db->get_where('data_skenario_kunjungan', ['id_project' => $project, 'kunjungan' => $kunjungan])->num_rows();


         // if($cek == 0){
             if($project == "" or $platform == "" or $skenario == "" or $jumlahskenario == null){
               $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  Project atau Platform atau Skenario belum dipilih!
                   </div>');
                 redirect('skenario/sosmed');
             } else {

                foreach ($bank as $key => $val) :
            

                    $data = [];
                    $j = 0;                    
                        
                    for($i=1; $i<=$jumlahskenario; $i++){
                          $hari = htmlspecialchars($this->input->post("hari".$i, true));
                          $waktu = htmlspecialchars($this->input->post("waktu".$i, true));
                          $kuota = htmlspecialchars($this->input->post("kuota".$i, true));
                           for($t=1; $t<=$kuota; $t++) {
                              $data1 = [
                                  'project' => $project,
                                  'platform' => $platform,
                                  'bank' => $val,
                                  'skenario' => $skenario,
                                    'hari' => $hari,
                                  'waktu' => $waktu,
                                  'trx_ke' => $t
                                ];
                          
                        $this->db->insert('sosmed', $data1);
                        }
                        $j++;
                     
                        }
                endforeach;
            }
                    


                $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Skenario Evaluasi Sosial Media telah <strong>ditambahkan!</strong>.
                </div>');

                redirect('skenario/sosmed');
                // var_dump($data1);
}

    public function tambah_ebanking($jumlahskenario){

        $project = $this->input->post('project1', true);
        $bank = $this->input->post('bank', true);
        
        $channel = $this->input->post('channel', true);
        $transaksi = $this->input->post('transaksi', true);
        $provider = $this->input->post('provider');
        $os = $this->input->post('os');
        $cek = $this->db->get_where('ebanking', ['project' => $project, 'channel' => $channel, 'transaksi' => $transaksi ])->num_rows();
        //$cek = $this->db->get_where('data_skenario_kunjungan', ['id_project' => $project, 'kunjungan' => $kunjungan])->num_rows();


         // if($cek == 0){
             if($project == "" or $channel == "" or $transaksi == "" or $jumlahskenario == null){
               $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  Project atau Channel atau Transaksi belum dipilih!
                   </div>');
                 redirect('skenario/ebanking');
             } else {

                foreach ($bank as $key => $val) :
                        $data = [];
                        $j = 0;

                        if($os != NULL) {
                        foreach ($os as $key => $val_os) {
                            foreach ($provider as $row => $val_provider) {
                            
                            
                                for($i=1; $i<=$jumlahskenario; $i++){
                                  $hari = htmlspecialchars($this->input->post("hari".$i, true));
                                  $waktu = htmlspecialchars($this->input->post("waktu".$i, true));
                                  $kuota = htmlspecialchars($this->input->post("kuota".$i, true));
                                   for($t=1; $t<=$kuota; $t++) {
                                      $data1 = [
                                          'project' => $project,
                                          'channel' => $channel,
                                          'bank' => $val,
                                          'transaksi' => $transaksi,
                                          'os' => $val_os,
                                          'provider' => $val_provider,
                                            'hari' => $hari,
                                          'waktu' => $waktu,
                                          'trx_ke' => $t
                                        ];
                                  
                                $this->db->insert('ebanking', $data1);
                                }
                                $j++;
                             
                                }
                            }
                        }
                        } else {
                            $val_os= NULL;
                             foreach ($provider as $row => $val_provider) {
                            
                            
                                for($i=1; $i<=$jumlahskenario; $i++){
                                  $hari = htmlspecialchars($this->input->post("hari".$i, true));
                                  $waktu = htmlspecialchars($this->input->post("waktu".$i, true));
                                  $kuota = htmlspecialchars($this->input->post("kuota".$i, true));
                                   for($t=1; $t<=$kuota; $t++) {
                                      $data1 = [
                                          'project' => $project,
                                          'channel' => $channel,
                                          'bank' => $val,
                                          'transaksi' => $transaksi,
                                          'os' => $val_os,
                                          'provider' => $val_provider,
                                            'hari' => $hari,
                                          'waktu' => $waktu,
                                          'trx_ke' => $t
                                        ];
                                  
                                $this->db->insert('ebanking', $data1);
                                }
                                $j++;
                             
                                }
                            }

                        }
                    endforeach;

                
                //     for($i=1; $i<=$jumlahskenario; $i++){
                //       $att = htmlspecialchars($this->input->post("skenario".$i, true));
                //         $data1 = [
                //           'project' => $project,
                //           'att' => $att,
                //               'numrow' => $j+1,
                //           'kategori' => $skenario,
                //         ];
                //         if($att != 'Pilih Skenario'){
                //           $data[$j] = $data1;
                //         }
                //         $j++;
                //     }

                // $this->db->insert_batch('skenario', $data);


                $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Skenario E-Banking telah <strong>ditambahkan!</strong>.
                </div>');

                redirect('skenario/ebanking');
                // var_dump($data1);
}
         // } else {

         //     $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
         //         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         //         Skenario untuk Transaksi di Project tersebut sudah <strong>ada!</strong>.
         //         </div>');

         //         redirect('skenario/ebanking');
         // }
    }

    public function transaksi_ebanking(){
        return $this->db->get('attribute_ebanking')->result_array();
    }


    public function rekening_ebanking(){
        return $this->db->query("SELECT a.*, b.nama AS nama_bank FROM ebanking_rekening a LEFT JOIN bank b ON a.bank=b.kode")->result_array();
    }

    public function aplikasi_ebanking(){
        return $this->db->query("SELECT a.*, b.nama AS nama_bank FROM ebanking_aplikasi a JOIN bank b ON a.bank=b.kode")->result_array();
    }

    public function shopper_ebanking(){
        return $this->db->query("SELECT * FROM ebanking_shopper")->result_array();
    }    

    //DB JAY
    public function getAllDataSkenarioKunjungan(){

        $id = $this->session->userdata('id_user');

        // KODINGAN LAMA DOUBLE JOIN ATMCENTER/CABANG
        // return $this->db->query("SELECT
        //                             a.kareg,
        //                             a.spv,
        //                             c.nama,
        //                             a.nomorstkb,
        //                             a.project,
        //                             b.nama AS nama_project,
        //                             a.planstart,
        //                             a.planend,
        //                             a.kota,
        //                             a.kode,
        //                             IF(d.nama IS NOT NULL, d.nama, z.namacabang) AS cabang,
        //                             z.shp_weekend_siang,
        //                             z.shp_weekend_malam,
        //                             z.shp_weekday_siang,
        //                             z.shp_weekday_malam,
        //                             e.kategori AS kunjungan,
        //                             GROUP_CONCAT( f.nama SEPARATOR ' - ' ) AS skenario
        //                         FROM
        //                             plan a
        //                             JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n'
        //                             JOIN id_data c ON a.kareg = c.Id
        //                             LEFT JOIN cabang d ON d.kode = a.kode AND a.project = d.project
        //                             LEFT JOIN atmcenter z ON a.project = z.project AND a.kode = z.cabang
        //                             JOIN skenario e ON a.project = e.project AND a.kunjungan = e.kategori
        //                             JOIN attribute f ON e.att = f.kode
        //                         WHERE
        //                             a.kareg = '$id'
        //                             AND a.planstart >= '2019-11-25'
        //                             AND NOT EXISTS (
        //                             SELECT
        //                                 g.num
        //                             FROM
        //                                 quest g
        //                             WHERE
        //                                 a.project = g.project
        //                                 AND e.att = g.kunjungan
        //                                 AND a.kode = g.cabang
        //                             )
        //
        //                             -- AND EXISTS (
        //                             -- SELECT
        //                             --     h.total_nilai
        //                             -- FROM
        //                             --     data_nilai h
        //                             -- WHERE
        //                             --     h.kode_project = a.project
        //                             --     AND h.kunjungan = a.kunjungan
        //                             --     AND h.id_user = '$id'
        //                             --     AND h.total_nilai = '100'
        //                             -- )
        //                         GROUP BY
        //                             a.project,
        //                             a.kode,
        //                             a.kunjungan
        //                         ORDER BY
        //                             a.kode ASC,
        //                             a.kunjungan ASC,
        //                             e.numrow ASC,
        //                             a.planend ASC")->result_array();

        return $this->db->query("SELECT
                                    a.no,
                                    a.kareg,
                                    a.spv,
                                    a.area_head,
                                    a.field_officer,
                                    c.nama,
                                    a.nomorstkb,
                                    a.project,
                                    b.kode AS kode_project,
                                    b.nama AS nama_project,
                                    a.planstart,
                                    a.planend,
                                    a.kota,
                                    a.kode,
                                    IF(d.nama IS NOT NULL, d.nama, (SELECT namacabang FROM atmcenter WHERE project = a.project AND cabang = a.kode)) AS cabang,
                                    -- z.shp_weekend_siang,
                                    -- z.shp_weekend_malam,
                                    -- z.shp_weekday_siang,
                                    -- z.shp_weekday_malam,
                                    -- IF(e.kategori = '064', (SELECT shp_weekend_siang FROM atmcenter WHERE project = a.project AND cabang = a.kode), NULL),
                                    CASE
                                      WHEN e.kategori = '065' THEN (SELECT shp_weekend_siang FROM atmcenter WHERE project = a.project AND cabang = a.kode)
                                    END AS shp_weekend_siang,
                                    CASE
                                      WHEN e.kategori = '067' THEN (SELECT shp_weekend_malam FROM atmcenter WHERE project = a.project AND cabang = a.kode)
                                    END AS shp_weekend_malam,
                                    CASE
                                      WHEN e.kategori = '064' THEN (SELECT shp_weekday_siang FROM atmcenter WHERE project = a.project AND cabang = a.kode)
                                    END AS shp_weekday_siang,
                                    CASE
                                      WHEN e.kategori = '066' THEN (SELECT shp_weekday_malam FROM atmcenter WHERE project = a.project AND cabang = a.kode)
                                    END AS shp_weekday_malam,
                                    -- e.kategori AS kunjungan,
                                    -- GROUP_CONCAT( f.nama SEPARATOR ' - ' ) AS skenario
                                    e.att as kunjungan,
                                    e.kategori AS groupkunjungan,
                                    f.nama as skenario
                                FROM
                                    plan a
                                    JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n'
                                    JOIN id_data c ON a.kareg = c.Id OR a.field_officer = c.Id
                                    LEFT JOIN cabang d ON d.kode = a.kode AND a.project = d.project
                                    -- LEFT JOIN atmcenter z ON a.project = z.project AND a.kode = z.cabang
                                    JOIN skenario e ON a.project = e.project AND (a.kunjungan = e.kategori OR a.kunjungan=e.att)
                                    JOIN attribute f ON e.att = f.kode
                                WHERE
                                    (a.kareg = '$id' OR a.field_officer = '$id') 
                                    AND a.planstart >= '2019-11-25'
                                    -- AND NOT EXISTS (SELECT g.num FROM quest g WHERE a.project = g.project AND e.att = g.kunjungan AND a.kode = g.cabang)

                                    -- AND EXISTS (
                                    -- SELECT
                                    --     h.total_nilai
                                    -- FROM
                                    --     data_nilai h
                                    -- WHERE
                                    --     h.kode_project = a.project
                                    --     AND h.kunjungan = a.kunjungan
                                    --     AND h.id_user = '$id'
                                    --     AND h.total_nilai = '100'
                                    -- )
                                GROUP BY
                                    e.att,
                                    a.project,
                                    a.kode
                                --     a.kunjungan
                                ORDER BY
                                    a.kode ASC,
                                    a.kunjungan ASC,
                                    e.numrow ASC,
                                    a.planend ASC")->result_array();
    }

    public function getprojectperskenario($id){
        $this->db->delete('data_skenario_kunjungan', ['id_skenario_kunjungan' => $id]);
    }

    public function getshopper(){
        return $this->db->get('id_data')->result_array();
    }

    //db kerjabakti
    // public function getskennotinquest($kunj, $cbg){

    //     $id = $this->session->userdata('id_user');

    //     return $this->db->query("SELECT
    //                                 a.*,
    //                                 c.nama_project,
    //                                 b.nama,
    //                                 g.nama as cabang,
    //                                 d.kode as ksken,
    //                                 e.nama as sken
    //                             FROM
    //                                 plan a
    //                                 JOIN attribute b ON a.kunjungan = b.kode
    //                                 JOIN data_project c ON a.project = c.kode_project
    //                                 JOIN data_skenario_kunjungan d ON a.project = d.kode_project AND a.kunjungan = d.kategori
    //                                 JOIN attribute e ON d.kode = e.kode
    //                                 JOIN cabang g ON a.kode = g.kode AND a.project = g.project

    //                             WHERE
    //                                 a.pic = '$id'
    //                                 AND a.kode = '$cbg'
    //                                 AND
    //                                 a.kunjungan = '$kunj'
    //                                 AND NOT EXISTS (
    //                                 SELECT f.num FROM quest f WHERE
    //                                 a.project = f.project AND d.kode = f.kunjungan AND f.cabang = '$cbg'
    //                                 )
    //                             ORDER BY a.planend ASC")->result_array();
    // }

    //db jay
    public function getskennotinquest($kunj, $cbg, $pro){

        $id = $this->session->userdata('id_user');

        return $this->db->query("SELECT
                                    a.kareg,
                                    c.nama,
                                    a.nomorstkb,
                                    a.project,
                                    b.nama AS nama_project,
                                    a.planstart,
                                    a.planend,
                                    a.kota,
                                    a.kode,
                                    d.nama AS cabang,
                                    h.namacabang AS cabang,
                                    e.kategori AS kunjungan,
                                    f.kode as ksken,
                                    f.nama as sken
                                FROM
                                    plan a
                                    JOIN project b ON a.project = b.kode
                                    JOIN id_data c ON a.kareg = c.Id OR a.field_officer=c.Id
                                    LEFT JOIN cabang d ON a.kode = d.kode AND a.project = d.project
                                    LEFT JOIN atmcenter h ON a.kode = h.cabang AND a.project = h.project
                                    -- JOIN skenario e ON a.project = e.project AND a.kunjungan = e.kategori
                                    JOIN skenario e ON a.project = e.project AND (a.kunjungan = e.att OR a.kunjungan = e.kategori)
                        
                                    JOIN attribute f ON e.att = f.kode
                                WHERE
                                    (a.kareg = '$id' OR a.field_officer='$id')
                                    AND a.project = '$pro'
                                    AND a.kode = '$cbg'
                                    AND e.att = '$kunj'
                                    AND NOT EXISTS (
                                    SELECT
                                        g.num
                                    FROM
                                        quest g
                                    WHERE
                                        a.project = g.project
                                        AND g.kunjungan = e.att
                                        AND g.cabang = '$cbg'
                                    )
                                    -- AND EXISTS (
                                    -- SELECT
                                    --     h.total_nilai
                                    -- FROM
                                    --     data_nilai h
                                    -- WHERE
                                    --     h.kode_project = a.project
                                    --     AND h.kunjungan = '$kunj'
                                    --     AND h.id_user = '$id'
                                    --     AND h.total_nilai = '100'
                                    -- )
                                ORDER BY
                                    a.kode ASC,
                                    a.kunjungan ASC,
                                    e.numrow ASC,
                                    a.planend ASC")->result_array();
    }

    public function getAllDataUser(){
        return $this->db->get_where('data_user', ['id_akses' => 2])->result_array();
    }

    public function tambahshpkunjungan(){
        $tgl = htmlspecialchars($this->input->post('datekunj', true));
        list($y, $m, $d) = explode ( '-', $tgl);

        $skenario = $this->input->post('check');
        $project = $this->input->post('kpro');
        $cabang = $this->input->post('kcab');
        $kunj = $this->input->post('kategori');
        $shp = $this->input->post('shp');
        $pwt = $this->input->post('pwt');
        $stkb = $this->input->post('stkb');
        $kareg = $this->input->post('krg');
        $spv = $this->input->post('supv');

        if(in_array('064', $skenario) OR in_array('065', $skenario) OR in_array('066', $skenario) OR in_array('067', $skenario)){
          $atmcenter = array('064','065','066','067');
           for ($i=0; $i<count($skenario); $i++){
             $tgl = "$y-$m-$d";
             if($skenario[$i] == '064'){ //$id_shp = $shp; $sts = $key['status_weekday_siang'] >= 0 ? $key['status_weekday_siang'] : NULL;
               $data = [
                 'weekday_siang' => $skenario[$i],
                 'shp_weekday_siang' => $shp,
                 'tgl_weekday_siang' => $tgl,
                 'status_weekday_siang' => 0
               ];
             }
             else if($skenario[$i] == '065'){
               $data = [
                 'weekend_siang' => $skenario[$i],
                 'shp_weekend_siang' => $shp,
                 'tgl_weekend_siang' => $tgl,
                 'status_weekend_siang' => 0
               ];
             }
             else if($skenario[$i] == '066'){
               $data = [
                 'weekday_malam' => $skenario[$i],
                 'shp_weekday_malam' => $shp,
                 'tgl_weekday_malam' => $tgl,
                 'status_weekday_malam' => 0
               ];
             }
             else if($skenario[$i] == '067'){
               $data = [
                 'weekend_malam' => $skenario[$i],
                 'shp_weekend_malam' => $shp,
                 'tgl_weekend_malam' => $tgl,
                 'status_weekend_malam' => 0
               ];
             }
             // else{
             //   $data = [
             //       'shp' => $shp,
             //       'pwt' => $pwt,
             //       'r_kategori' => $kunj,
             //       'kunjungan' => $skenario[$i],
             //       'project' => $project,
             //       'tanggal' => $tgl,
             //       'cabang' => $cabang,
             //       'rekaman' => 'false',
             //       'rekaman_status' => 0,
             //       'status' => 0,
             //       'nomorstkb' => $stkb,
             //       'r_kareg' => $kareg,
             //       'r_spv' => $spv,
             //   ];
             // }

             if (in_array($skenario[$i], $atmcenter)){
               $this->db->where(['project' => $project, 'cabang' => $cabang])->update('atmcenter', $data);
             }
             // else{
             //   $this->db->insert('quest', $data);
             // }

           }
        }else{
            $data = [];
            for ($i=0; $i<count($skenario); $i++){
                $data1 = [
                    'shp' => $shp,
                    'pwt' => $pwt,
                    'r_kategori' => $kunj,
                    'kunjungan' => $skenario[$i],
                    'project' => $project,
                    'tanggal' => "$y-$m-$d",
                    'cabang' => $cabang,
                    'rekaman' => 'false',
                    'rekaman_status' => 0,
                    'status' => 0,
                    'nomorstkb' => $stkb,
                    'r_kareg' => $kareg,
                    'r_spv' => $spv,
                ];
                array_push($data,$data1);
            }
            $this->db->insert_batch('quest', $data);
        }

    }

    public function getDataAktual(){
        return $this->db->query("SELECT a.*, c.nama_user, d.nama_project, GROUP_CONCAT(b.nama_skenario SEPARATOR ', ') as skenario, e.nama_cabang FROM data_cabang e JOIN ( data_project d JOIN ( data_user c JOIN ( `data_aktual` a join data_skenario b on a.id_skenario = b.id_skenario ) on a.id_user = c.id_user ) on a.id_project = d.id_project ) on a.kode_cabang= e.kode_cabang WHERE id_status = 0 GROUP By a.id_project, a.id_kunjungan")->result_array();
    }

    public function getDataProjectSkenario($id){
      $startDate = date('Y-m-d',strtotime("-1 month")); // Tanggal 1 bulan kebelakang
      $endDate   = date('Y-m-d',strtotime("now")); // Tanggal hari ini
      $kodeProject = $this->db->query("SELECT kode FROM project WHERE id_user = '$id' AND visible = 'y'")->result_array();
      $data = array();
      foreach ($kodeProject as $project) {
        //CEK ATM ATAU BUKAN
        $db2 = $this->load->database('database_kedua', TRUE);
        $arrayatm = array('064','065','066','067');
        $db2->select('att');
        $db2->from('skenario');
        $db2->where('project', $project['kode']);
        $db2->where_in('att', $arrayatm);
        $atmBukan = $db2->get()->result_array();
        if($atmBukan){
          $this->db->select('
          project.nama as projectnama,
          plan.no, plan.planstart, plan.planend, plan.project as kodeproject, plan.nomorstkb,
          atmcenter.cabang as kodecabang, atmcenter.namacabang as namacabang,
          attribute.kode as kodekunjungan, attribute.nama as namaatt');
          $this->db->from('plan');
    		  $this->db->join('project','project.kode=plan.project');
    		  $this->db->join('atmcenter','atmcenter.cabang=plan.kode and atmcenter.project=plan.project');
    		  $this->db->join('attribute','attribute.kode=plan.kunjungan');
          $this->db->where('plan.project', $project['kode']);
          // $this->db->where("str_to_date(plan.planend,'%Y-%m-%d') BETWEEN str_to_date('$startDate','%Y-%m-%d') AND str_to_date('$endDate','%Y-%m-%d')");
          $this->db->where("str_to_date(plan.planend,'%Y-%m-%d') <= str_to_date('$endDate','%Y-%m-%d')");

          $query = $this->db->get();
          if($query->num_rows()){
            $data[] = $query->result_array();
          }
        }else{
          $this->db->select('
          project.nama as projectnama,
          plan.no, plan.planstart, plan.planend, plan.project as kodeproject, plan.nomorstkb,
          cabang.kode as kodecabang, cabang.nama as namacabang,
          attribute.kode as kodekunjungan, attribute.nama as namaatt');
          $this->db->from('plan');
    		  $this->db->join('project','project.kode=plan.project');
    		  $this->db->join('cabang','cabang.kode=plan.kode and cabang.project=plan.project');
    		  $this->db->join('attribute','attribute.kode=plan.kunjungan');
          $this->db->where('plan.project', $project['kode']);
          // $this->db->where("str_to_date(plan.planend,'%Y-%m-%d') BETWEEN str_to_date('$startDate','%Y-%m-%d') AND str_to_date('$endDate','%Y-%m-%d')");
          $this->db->where("str_to_date(plan.planend,'%Y-%m-%d') <= str_to_date('$endDate','%Y-%m-%d')");

          $query = $this->db->get();
          if($query->num_rows()){
            $data[] = $query->result_array();
          }
        }

      }
      return $data;
    }

    public function cekDataProjectSkenarioATMBukan($kodeproject){
      $db2 = $this->load->database('database_kedua', TRUE);
      $arrayatm = array('064','065','066','067');
      $db2->select('att');
      $db2->from('skenario');
      $db2->where('project', $kodeproject);
      $db2->where_in('att', $arrayatm);
      return $db2->get()->result_array();
    }



    // <= 21/10/2020 13:35
    public function OLDgetDataProjectSkenario($id){
      //$kodeProject = $this->db->query("SELECT kode FROM project WHERE id_user = '$id' AND visible = 'y'")->result_array();
      /*$key = 0;
      foreach ($project as $val) {
        $val = $val['kode'];
        $cek = $this->db->query("SELECT num from quest where project = '$val'")->result_array();
        if($cek){
          foreach ($cek as $val2) {
            $cek2 = $this->db->query("SELECT project, kunjungan from quest where num = '$val2[num]' AND status < 2")->result_array();
            if($cek2){
              foreach ($cek2 as $val3) {
                $kodeProject[] = array("project" => $val3['project'], "kunjungan" => $val3['kunjungan']);
              }
            }
          }
        }else{
          $kodeProject[] = array("project" => $val, "kunjungan" => null);
        }
        $key++;
      }*/

      /*$data = array();
      foreach ($kodeProject as $project) {
        //CEK ATM ATAU BUKAN
        $db2 = $this->load->database('database_kedua', TRUE);
        $arrayatm = array('064','065','066','067');
        $db2->select('att');
        $db2->from('skenario');
        $db2->where('project', $project['kode']);
        $db2->where_in('att', $arrayatm);
        $atmBukan = $db2->get()->result_array();
        if($atmBukan){
          $this->db->select('
          project.nama as projectnama,
          plan.no, plan.planstart, plan.planend, plan.project as kodeproject,
          atmcenter.cabang as kodecabang, atmcenter.namacabang as namacabang,
          attribute.kode as kodekunjungan, attribute.nama as namaatt');
          $this->db->from('plan');
    		  $this->db->join('project','project.kode=plan.project');
    		  $this->db->join('atmcenter','atmcenter.cabang=plan.kode and atmcenter.project=plan.project');
    		  $this->db->join('attribute','attribute.kode=plan.kunjungan');
          $this->db->where('plan.project', $project['kode']);
          $this->db->where('plan.planend <=','DATE_ADD(NOW(),INTERVAL 30 DAYS )');
          //if($project['kunjungan'] != null){
          //$this->db->where('plan.kunjungan', $project['kunjungan']);
          //}
          //$this->db->group_by(array("plan.kode", "plan.kunjungan"));
          $query = $this->db->get();
          if($query->num_rows()){
            $data[] = $query->result_array();
          }
        }else{
          $this->db->select('
          project.nama as projectnama,
          plan.no, plan.planstart, plan.planend, plan.project as kodeproject,
          cabang.kode as kodecabang, cabang.nama as namacabang,
          attribute.kode as kodekunjungan, attribute.nama as namaatt');
          $this->db->from('plan');
    		  $this->db->join('project','project.kode=plan.project');
    		  $this->db->join('cabang','cabang.kode=plan.kode and cabang.project=plan.project');
    		  $this->db->join('attribute','attribute.kode=plan.kunjungan');
          $this->db->where('plan.project', $project['kode']);
          $this->db->where('plan.planend <=','DATE_ADD(NOW(),INTERVAL 30 DAYS )');
          //if($project['kunjungan'] != null){
          //$this->db->where('plan.kunjungan', $project['kunjungan']);
          //}
          //$this->db->group_by(array("plan.kode", "plan.kunjungan"));
          $query = $this->db->get();
          if($query->num_rows()){
            $data[] = $query->result_array();
          }
        }

      }

      return $data;*/
    }
}
