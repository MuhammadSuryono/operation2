<?php

class Fieldsdm_model extends CI_model
{

    public function getAllData()
    {
        return $this->db->query("SELECT 
                                    a.*, b.Nama, c.nm_kota, d.Nama AS nama_kader, e.Nama AS nama_kepala 
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                    LEFT JOIN id_data d ON a.kader_id=d.Id
                                    LEFT JOIN id_data e ON a.kepala_id=e.Id
                                ORDER BY b.Nama ASC
                                ")->result_array();
    }
    public function getAllDataMitra()
    {
        return $this->db->query("SELECT 
                                    a.*, b.Nama, c.nm_kota, d.Nama AS nama_kader, e.Nama AS nama_kepala 
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                    LEFT JOIN id_data d ON a.kader_id=d.Id
                                    LEFT JOIN id_data e ON a.kepala_id=e.Id
                                WHERE a.status = 'Mitra'
                                ")->result_array();
    }
    public function getAllDataKontrak()
    {
        return $this->db->query("SELECT 
                                    a.*, b.Nama, c.nm_kota, d.Nama AS nama_kader, e.Nama AS nama_kepala 
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                    LEFT JOIN id_data d ON a.kader_id=d.Id
                                    LEFT JOIN id_data e ON a.kepala_id=e.Id
                                WHERE a.status != 'Mitra' AND (a.posisi = 'Area Head' OR a.posisi = 'Kepala Field')
                                ")->result_array();
    }
    public function getAllDataFo()
    {
        return $this->db->query("SELECT 
                                    a.*, b.Nama, c.nm_kota, d.Nama AS nama_kader, e.Nama AS nama_kepala 
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                    LEFT JOIN id_data d ON a.kader_id=d.Id
                                    LEFT JOIN id_data e ON a.kepala_id=e.Id
                                WHERE a.posisi = 'Field Officer' OR a.posisi = 'Pewitness'
                                ")->result_array();
    }

    public function getSdmById($id)
    {
        return $this->db->query("SELECT 
                                    a.*, b.Nama, b.KotaTgl AS kota_asal, c.nm_kota
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                WHERE 
                                    a.id = $id
                                ")->row_array();
    }
    public function getSdmByIdData($id)
    {
        return $this->db->query("SELECT 
                                    a.*, b.Nama, b.KotaTgl AS kota_asal, c.nm_kota
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                WHERE 
                                    a.id_data_id = $id
                                ")->row_array();
    }

    public function getAllSdmFo()
    {
        return $this->db->query("SELECT 
                                    a.*, b.Nama, c.nm_kota 
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                    WHERE a.posisi = 'Field Officer'
                                ")->result_array();
    }

    public function tambah()
    {
        //UPLOAD MEMO
        $extension_memo  = pathinfo($_FILES['memo_sdm']['name'], PATHINFO_EXTENSION);
        $memo_name = "memo_fieldsdm_" . time() . "." . $extension_memo;
        $memo_tmp = $_FILES['memo_sdm']['tmp_name'];
        move_uploaded_file($memo_tmp, "assets/file/field_sdm/" . $memo_name);

        if ($this->input->post('posisi') == 'Field Officer' || $this->input->post('posisi') == 'Pewitnes') {
            $tanggal_mulai = null;
            $tanggal_selesai = null;
            $status = null;

            $tanggal_kaderisasi = $this->input->post('tanggal_kaderisasi');
            $kader_id = $this->input->post('kader_id');
            $kepala_id = $this->input->post('kepala_id');

            $mulai_kaderisasi = null;
            $selesai_kaderisasi = null;
        } else {
            $tgl_mulai = $this->input->post('tanggal_mulai');
            $tgl_selesai = $this->input->post('tanggal_selesai');

            if ($tgl_mulai != NULL and $tgl_selesai != NULL) {
                $tanggal_mulai = $tgl_mulai;
                $tanggal_selesai = $tgl_selesai;
            } else {
                $tanggal_mulai = NULL;
                $tanggal_selesai = NULL;
            }
            $status = $this->input->post('status');

            $tanggal_kaderisasi = null;
            $kader_id = null;
            $kepala_id = null;

            if ($this->input->post('posisi') == 'Area Head') {
                $mulai_kaderisasi = $this->input->post('mulai_kaderisasi');
                $selesai_kaderisasi = $this->input->post('selesai_kaderisasi');
                $penanggung_jawab_kaderisasi = $this->input->post('penanggung_jawab_kaderisasi');
            } else {
                $mulai_kaderisasi = null;
                $selesai_kaderisasi = null;
            }
        }

        $data = [
            'id_data_id' => $this->input->post('id_data_id'),
            'kota_id' => $this->input->post('kota_id'),
            'posisi' => $this->input->post('posisi'),
            'status' => $status,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'tanggal_kaderisasi' => $tanggal_kaderisasi,
            'kader_id' => $kader_id,
            'kepala_id' => $kepala_id,
            'jumlah_kaderisasi' => $this->input->post('jumlah_kaderisasi'),
            'mulai_kaderisasi' => $mulai_kaderisasi,
            'selesai_kaderisasi' => $selesai_kaderisasi,
            'penanggung_jawab_kaderisasi' => $penanggung_jawab_kaderisasi,
            'memo' => $memo_name,
            'user_update' => $this->session->userdata('id_user'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('field_sdm', $data);
    }

    public function edit()
    {
        $get = $this->db->get_where('field_sdm', ['id' => $this->input->post('id')])->row_array();

        //UPLOAD MEMO
        if ($_FILES['memo_sdm']['name'] == NULL) {
          $memo_name = $get['memo'];
        } else {
             //UPLOAD MEMO
            $extension_memo  = pathinfo($_FILES['memo_sdm']['name'], PATHINFO_EXTENSION);
            $memo_name = "memo_fieldsdm_" . time() . "." . $extension_memo;
            $memo_tmp = $_FILES['memo_sdm']['tmp_name'];
            move_uploaded_file($memo_tmp, "assets/file/memo/" . $memo_name);
        }
        

        if ($this->input->post('posisi') == 'Field Officer' || $this->input->post('posisi') == 'Pewitnes') {
            $tanggal_mulai = null;
            $tanggal_selesai = null;
            $status = null;

            $tanggal_kaderisasi = $this->input->post('tanggal_kaderisasi');
            $kader_id = $this->input->post('kader_id');
            $kepala_id = $this->input->post('kepala_id');

            $mulai_kaderisasi = null;
            $selesai_kaderisasi = null;
        } else {
            $tgl_mulai = $this->input->post('tanggal_mulai');
            $tgl_selesai = $this->input->post('tanggal_selesai');

            if ($tgl_mulai != NULL and $tgl_selesai != NULL) {
                $tanggal_mulai = $tgl_mulai;
                $tanggal_selesai = $tgl_selesai;
            } else {
                $tanggal_mulai = NULL;
                $tanggal_selesai = NULL;
            }
            $status = $this->input->post('status');

            $tanggal_kaderisasi = null;
            $kader_id = null;
            $kepala_id = null;

            if ($this->input->post('posisi') == 'Area Head') {
                $mulai_kaderisasi = $this->input->post('mulai_kaderisasi');
                $selesai_kaderisasi = $this->input->post('selesai_kaderisasi');
                $penanggung_jawab_kaderisasi = $this->input->post('penanggung_jawab_kaderisasi');
            } else {
                $mulai_kaderisasi = null;
                $selesai_kaderisasi = null;
            }
        }

        $data = [
            'id_data_id' => $this->input->post('id_data_id'),
            'kota_id' => $this->input->post('kota_id'),
            'posisi' => $this->input->post('posisi'),
            'status' => $status,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'tanggal_kaderisasi' => $tanggal_kaderisasi,
            'kader_id' => $kader_id,
            'kepala_id' => $kepala_id,
            'jumlah_kaderisasi' => $this->input->post('jumlah_kaderisasi'),
            'mulai_kaderisasi' => $mulai_kaderisasi,
            'selesai_kaderisasi' => $selesai_kaderisasi,
            'penanggung_jawab_kaderisasi' => $penanggung_jawab_kaderisasi,
            'memo' => $memo_name,
            'aktif' => $this->input->post('aktif'),
            'user_update' => $this->session->userdata('id_user')
        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('field_sdm', $data);
    }

    public function delete($id)
    {
        $this->db->delete('project_plan', ['id' => $id]);
    }

    public function getAllHonor()
    {
        return $this->db->query("SELECT * FROM matrix_honor_sdm_field")->result_array();
    }

    public function tambah_matrixhonor()
    {
        $data = [
            'jeniskota' => $this->input->post('kota'),
            'posisi' => $this->input->post('posisi'),
            'status' => $this->input->post('status'),
            'produktivitas' => $this->input->post('produktivitas'),
            'produktivitas_lk' => $this->input->post('produktivitas_lk'),
            'supervisi_kontrak' => ($this->input->post('supervisi_kontrak') ? $this->input->post('supervisi_kontrak') : 0),
            'supervisi_mitra' => ($this->input->post('supervisi_mitra') ? $this->input->post('supervisi_mitra') : 0),
            'training' => $this->input->post('training'),
            'insentif_timeline' => $this->input->post('insentif_timeline'),
            'insentif_kaderisasi' => $this->input->post('insentif_kaderisasi'),
            'insentif_upload' => $this->input->post('insentif_upload'),
            'penalti_pengulangan' => $this->input->post('penalti_pengulangan'),
            'penalti_keterlambatan_upload' => $this->input->post('penalti_keterlambatan_upload'),
            'penalti_keterlambatan_timeline' => $this->input->post('penalti_keterlambatan_timeline'),
            'penalti_kaderisasi' => $this->input->post('penalti_kaderisasi'),
            'user_update' => $this->session->userdata('id_user'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->insert('matrix_honor_sdm_field', $data);
    }

    public function edit_matrixhonor()
    {
        $data = [
            'jeniskota' => $this->input->post('kota'),
            'posisi' => $this->input->post('posisi'),
            'status' => $this->input->post('status'),
            'produktivitas' => $this->input->post('produktivitas'),
            'produktivitas_lk' => $this->input->post('produktivitas_lk'),
            'supervisi_kontrak' => ($this->input->post('supervisi_kontrak') ? $this->input->post('supervisi_kontrak') : 0),
            'supervisi_mitra' => ($this->input->post('supervisi_mitra') ? $this->input->post('supervisi_mitra') : 0),
            'training' => $this->input->post('training'),
            'insentif_timeline' => $this->input->post('insentif_timeline'),
            'insentif_kaderisasi' => $this->input->post('insentif_kaderisasi'),
            'insentif_upload' => $this->input->post('insentif_upload'),
            'penalti_pengulangan' => $this->input->post('penalti_pengulangan'),
            'penalti_keterlambatan_upload' => $this->input->post('penalti_keterlambatan_upload'),
            'penalti_keterlambatan_timeline' => $this->input->post('penalti_keterlambatan_timeline'),
            'penalti_kaderisasi' => $this->input->post('penalti_kaderisasi'),
            'user_update' => $this->session->userdata('id_user'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('matrix_honor_sdm_field', $data);
    }

    public function getSdmMatrix($kota_id, $posisi, $status)
    {
        return $this->db->query("SELECT
                                    * 
                                FROM 
                                    field_kotakab a
                                JOIN 
                                    matrix_honor_sdm_field b ON a.jeniskota = b.jeniskota
                                WHERE
                                    a.kota_id = $kota_id AND b.posisi = '$posisi' AND b.status = '$status'
         ")->row_array();
    }

    public function getInsentifKaderisasi($tanggal_mulai, $tanggal_selesai, $id)
    {
        $this->db->select('*');
        $this->db->from('field_sdm');
        $this->db->join('id_data', 'id_data.Id = field_sdm.id_data_id');
        $this->db->where('field_sdm.kader_id', $id);
        $this->db->where('field_sdm.tanggal_kaderisasi >=', $tanggal_mulai);
        $this->db->where('field_sdm.tanggal_kaderisasi <=', $tanggal_selesai);
        return $this->db->get()->result_array();
    }

    public function countInsentifKaderisasi($tanggal_mulai, $tanggal_selesai, $id)
    {
        $this->db->select('*');
        $this->db->from('field_sdm');
        $this->db->where('kader_id', $id);
        if ($tanggal_mulai && $tanggal_selesai) {
            $this->db->where('tanggal_kaderisasi >=', $tanggal_mulai);
            $this->db->where('tanggal_kaderisasi <=', $tanggal_selesai);
        }
        return $this->db->get()->num_rows();
    }

    public function countPenaltiKaderisasi($tanggal_mulai, $tanggal_selesai, $id, $tanggal_selesai_kaderisasi)
    {
        $this->db->select('*');
        $this->db->from('field_sdm');
        $this->db->where('kader_id', $id);
        $this->db->where('tanggal_kaderisasi >=', $tanggal_mulai);
        $this->db->where('tanggal_kaderisasi <=', $tanggal_selesai);
        $this->db->where('tanggal_kaderisasi >=', $tanggal_selesai_kaderisasi);
        return $this->db->get()->num_rows();
    }

    public function getPenaltiKaderisasi($tanggal_mulai, $tanggal_selesai, $id, $tanggal_selesai_kaderisasi)
    {
        $this->db->select('*');
        $this->db->from('field_sdm');
        $this->db->join('id_data', 'id_data.Id = field_sdm.id_data_id');
        $this->db->where('field_sdm.kader_id', $id);
        $this->db->where('field_sdm.tanggal_kaderisasi >=', $tanggal_mulai);
        $this->db->where('field_sdm.tanggal_kaderisasi <=', $tanggal_selesai);
        $this->db->where('tanggal_kaderisasi >=', $tanggal_selesai_kaderisasi);
        return $this->db->get()->result_array();
    }

    // End Matrix Honor

    // Kota kab

    public function tambah_kotakab()
    {
        $umpHarian = $this->input->post('ump_harian');
        if ($umpHarian > 200000)
            $jenisKota = "KOTA 1";
        else if ($umpHarian <= 200000 && $umpHarian >= 100000)
            $jenisKota = "KOTA 2";
        else
            $jenisKota = "KOTA 3";

        $data = [
            'kota_id' => $this->input->post('kota_id'),
            'jeniskota' => $jenisKota,
            'ump_harian' => $umpHarian,
            'ump_bulanan' => $this->input->post('ump_bulanan'),
            'tahun' => $this->input->post('tahun'),
            'user_update' => $this->session->userdata('id_user'),
            'user_update' => $this->session->userdata('id_user'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->db->insert('field_kotakab', $data);
    }

    public function getAllKotaKab()
    {
        return $this->db->query("SELECT 
                                    a.*, b.nm_kota as nama_kota
                                FROM
                                    field_kotakab a
                                JOIN 
                                    kota b ON a.kota_id = b.id 
                                ")->result_array();
    }

    public function edit_kotakab()
    {
        $umpHarian = $this->input->post('ump_harian');
        if ($umpHarian > 200000)
            $jenisKota = "KOTA 1";
        else if ($umpHarian <= 200000 && $umpHarian >= 100000)
            $jenisKota = "KOTA 2";
        else
            $jenisKota = "KOTA 3";

        $data = [
            'kota_id' => $this->input->post('kota_id'),
            'jeniskota' => $jenisKota,
            'ump_harian' => $umpHarian,
            'ump_bulanan' => $this->input->post('ump_bulanan'),
            'tahun' => $this->input->post('tahun'),
            'user_update' => $this->session->userdata('id_user')
        ];

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('field_kotakab', $data);
    }

    // End Kota Kab

    // Field Pembayaran

    public function countFieldPembayaran($nomorstkb, $term, $pic, $project)
    {
        $this->db->select('*');
        $this->db->from('field_pembayaran');
        // $this->db->where('nomorstkb', $nomorstkb);
        $this->db->where('kodeproject', $project);
        $this->db->where('term', $term);
        $this->db->where('id_data_id', $pic);
        return $this->db->get()->num_rows();
    }

    public function insertFieldPembayaran($total, $pic, $progress, $project, $term)
    {

        if ($term == 1) {
            $total_aktual = $total * 0.25;
            $term = '1';
        } else if ($term == 2) {
            $dataTerm1 = $this->db->query("SELECT * FROM field_pembayaran WHERE id_data_id = '$pic' AND kodeproject = '$project' AND term = 1")->row_array();

            $total_aktual = ($total * 0.5) - $dataTerm1['total_aktual'];
            $term = '2';
        } else if ($term == 3) {
            $dataTerm1 = $this->db->query("SELECT * FROM field_pembayaran WHERE id_data_id = '$pic' AND kodeproject = '$project' AND term = 1")->row_array();

            $dataTerm2 = $this->db->query("SELECT * FROM field_pembayaran WHERE id_data_id = '$pic' AND kodeproject = '$project' AND term = 2")->row_array();
            $total_aktual = $total - ($dataTerm1['total_aktual'] + $dataTerm2['total_aktual']);
            $term = '3';
        }

        $data = [
            // 'nomorstkb' => $this->input->post('nomorstkb'),
            'term' => $term,
            'tanggalbuat' => date('Y-m-d'),
            'kodeproject' => $project,
            'id_data_id' => $pic,
            'total' => $total,
            'total_aktual' => $total_aktual,
            'status_pembayaran' => 1
        ];

        return $this->db->insert('field_pembayaran', $data);
    }

    public function getMaxTerm($id, $project)
    {
        return $this->db->query("SELECT max(term) AS term FROM field_pembayaran WHERE id_data_id = '$id' AND kodeproject = '$project'")->row_array();
    }

    public function get_data_pengajuan()
    {
        $this->datatables->select('
        b.project AS kodeproject,
        c.nama AS namaproject,
        d.Id AS idsdm,
        d.Nama AS namasdm,
        a.id AS field_sdm_id
    ', FALSE);
        $this->datatables->from('field_sdm a');
        $this->datatables->join('plan b', 'b.area_head = a.id_data_id');
        $this->datatables->join('project c', 'b.project = c.kode');
        $this->datatables->join('id_data d', 'd.Id = a.id_data_id');
        $this->datatables->where('a.status = "Mitra"', NULL, FALSE);
        $this->datatables->add_column('cek', '<button type="button" class="btn btn-sm btn-primary btn-ajukan" id="btn-ajukan-$2" data-target="#pengajuanModal" data-toggle="modal" data-idsdm="$2" data-kodeproject="$1">Ajukan</button>', 'kodeproject,idsdm');
        $this->datatables->add_column('print', '<button type="button" class="btn btn-sm btn-primary btn-print" id="btn-print-$2" data-target="#printSdmMitra" data-toggle="modal" data-id="$3" data-idsdm="$2" data-kodeproject="$1">Print</button>', 'kodeproject,idsdm,field_sdm_id');
        // $this->datatables->add_column('print', '<a href="printstkb/$1/0" target="_blank"><i class="fa fa-print"></i> Print</a><input type="hidden" name="akomodasi$1" value="$2"><input type="hidden" name="bpjs$1" value="$3"><input type="hidden" name="jumlahops$1" value="$4"><input type="hidden" name="jumlahtrk$1" value="$5"><input type="hidden" name="total$1" value="$6">', 'nmrstkb,akomodasi,bpjs,jumlahops,jumlahtrk,total');
        $this->db->group_by(array('b.project', 'b.area_head'));
        $data = json_decode($this->datatables->generate(), TRUE);
        $no = 0;
        $newArray = array();
        foreach ($data['data'] as $keyy) {
            $count = 0;
            $averageProgress = 0;
            $length = 0;
            $getStkb = $this->db->query("SELECT * FROM plan WHERE area_head = '$keyy[idsdm]' AND project = '$keyy[kodeproject]' GROUP BY nomorstkb")->result_array();
            foreach ($getStkb as $stkb) {
                $progressnya = 0;
                $count++;
                $cabang = $this->db->query("SELECT * FROM plan WHERE area_head = '$keyy[idsdm]' AND project = '$keyy[kodeproject]' AND nomorstkb = '$stkb[nomorstkb]' GROUP BY kode")->result_array();
                $x = 1;
                $length += count($cabang);

                $query = $this->db->query("SELECT
                                            100 * COUNT(nomorstkb) / (
                                              SELECT
                                                -- COUNT(b.att)
                                                COUNT(a.kunjungan)
                                              FROM
                                                plan a
                                              -- JOIN skenario b ON b.project = a.project
                                              JOIN skenario b ON b.att = a.kunjungan
                                              -- AND b.kategori = a.kunjungan
                                                        -- AND b.att = a.kunjungan
                                              AND b.project = a.project
                                              WHERE
                                                a.nomorstkb = '$stkb[nomorstkb]' AND
                                                att IN ('001','002','003','051','052','053','071','072','073')
                                            ) AS jumlahnya
                                          FROM
                                            quest
                                          WHERE
                                            nomorstkb = '$stkb[nomorstkb]'
                                          AND STATUS >= 3
                                          AND kunjungan IN ('001','002','003','051','052','053','071','072','073')")->row_array();
                //$progress = mysqli_fetch_array($query);
                // TAMBAHAN BY ADAM SANTOSO
                $query2 = $this->db->query("SELECT count(kunjungan) as kjt, project, kode, kunjungan FROM plan WHERE nomorstkb = '$stkb[nomorstkb]' AND kunjungan IN ('064','065','066','067') GROUP BY kode")->result_array();
                if ($query['jumlahnya'] != 0) {
                    //echo json_encode($query['jumlahnya']);
                    $progressnya = $query['jumlahnya'];
                } else if (count($query2) != 0) {
                    $jmlKunjungan = 0;
                    $nilaiP1 = 0;
                    foreach ($query2 as $val) {
                        $p1 = $this->db->query("SELECT project, kode, kunjungan FROM plan WHERE nomorstkb = '$stkb[nomorstkb]' AND kode = '$val[kode]'")->result_array();
                        $bagiP1 = count($p1);
                        foreach ($p1 as $val2) {
                            $status = $this->db->query("SELECT * FROM atmcenter WHERE project = '$val2[project]' AND cabang = '$val2[kode]'")->row_array();
                            $sts1 = 0; // 065 = WEEKEND SIANG
                            $sts2 = 0; // 067 = WEEKEND MALAM
                            $sts3 = 0; // 064 = WEEKDAY SIANG
                            $sts4 = 0; // 066 = WEEKDAY MALAM

                            if ($val2['kunjungan'] == '064') {
                                $sts3 = $status['status_weekday_siang'] >= '3' ? 100 : 0;
                            } else if ($val2['kunjungan'] == '065') {
                                $sts1 = $status['status_weekend_siang'] >= '3' ? 100 : 0;
                            } else if ($val2['kunjungan'] == '066') {
                                $sts4 = $status['status_weekday_malam'] >= '3' ? 100 : 0;
                            } else if ($val2['kunjungan'] == '067') {
                                $sts2 = $status['status_weekend_malam'] >= '3' ? 100 : 0;
                            }
                            $nilaiP1 += $sts1 + $sts2 + $sts3 + $sts4;
                        }
                        $jmlKunjungan += $bagiP1;
                    }
                    $progressnya = $nilaiP1 / $jmlKunjungan;
                } else {
                    $progressnya = 0;
                }

                $averageProgress += $progressnya;
            }

            $newArray[] = array(
                "namasdm" => $keyy['namasdm'],
                "namaproject" => $keyy['namaproject'],
                "kodeproject" => $keyy['kodeproject'],
                "idsdm" => $keyy['idsdm'],
                "averageProgress" => number_format((float)($averageProgress / count($getStkb)), 2, '.', ''),
                // "averageProgress" => number_format((float)(300 / 3), 2, '.', ''),
                "jumlahcabang" => $length,
                "jumlahstkb" => count($getStkb),
                "cek" => $keyy['cek'],
                "print" => $keyy['print']
            );
            $no++;
        }

        $dataTable = [
            'draw' => 0,
            'recordsTotal' => $no,
            'recordsFiltered' => $no,
            'data' => $newArray
        ];
        return json_encode($dataTable);
    }

    public function get_data_term1()
    {
        $getTerm1 = $this->db->query("SELECT kode FROM project")->result_array();
        $newT1 = array();
        foreach ($getTerm1 as $t1) {
            $newT1[] = $t1['kode'];
        }
        $this->datatables->select('
        a.id AS data_id,
      a.kodeproject AS kodeproject,
      a.tanggalbuat AS tanggalbuat,
      a.total AS total,
      a.total_aktual AS total_aktual,
      a.term AS term,
      c.nama AS namaproject,
      b.Nama AS namapenerima,
      a.id_data_id AS idpic,
    ', FALSE);
        $this->datatables->from('field_pembayaran a');
        $this->datatables->join('id_data b', 'a.id_data_id = b.Id');
        $this->datatables->join('project c', 'a.kodeproject = c.kode');
        // $this->datatables->join('project d', 'a.project = d.kode');
        $this->datatables->where('a.status_pembayaran = 1 AND a.term = 1', NULL, FALSE);
        $this->datatables->add_column('cek', '<input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree1" name="statusbayar[]" value="$4" /><input type="hidden" name="idsdm-$4" value="$1"><input type="hidden" name="kodeproject-$4" value="$2"><input type="hidden" name="term-$4" value="$3"><input type="hidden" name="total-$4" value="$5">', 'idpic,kodeproject,term, data_id, total_aktual');
        $this->datatables->add_column('print', '<a href="printstkb/$1/0" target="_blank"><i class="fa fa-print"></i> Print</a><input type="hidden" name="akomodasi$1" value="$2"><input type="hidden" name="bpjs$1" value="$3"><input type="hidden" name="jumlahops$1" value="$4"><input type="hidden" name="jumlahtrk$1" value="$5"><input type="hidden" name="total$1" value="$6">', 'nmrstkb,akomodasi,bpjs,jumlahops,jumlahtrk,total');
        $this->db->order_by('c.nama', 'ASC');
        $data = json_decode($this->datatables->generate(), TRUE);
        $no = 0;
        $newArray = array();
        foreach ($data['data'] as $keyy) {
            // if (!in_array($keyy['kodeproject'], $newT1)) {
            $rek = $this->db->query("SELECT b.nama, d.NoRek as no FROM datarekening d JOIN bank b ON d.CodeBank = b.kode WHERE d.Id = '$keyy[idpic]'")->row_array();
            $newArray[] = array(
                "kodeproject" => $keyy['kodeproject'],
                "term" => $keyy['term'],
                "tanggalbuat" => $keyy['tanggalbuat'],
                "total" => $keyy['total'],
                "total_aktual" => $keyy['total_aktual'],
                "namaproject" => $keyy['namaproject'],
                "namapenerima" => $keyy['namapenerima'],
                "cek" => $keyy['cek'],
                "print" => $keyy['print'],
                "bank" => $rek['nama'],
                "rekening" => $rek['no']
            );
            $no++;
            // }
        }

        $dataTable = [
            'draw' => 0,
            'recordsTotal' => $no,
            'recordsFiltered' => $no,
            'data' => $newArray
        ];
        return json_encode($dataTable);
    }

    public function get_data_term2()
    {
        $getTerm1 = $this->db->query("SELECT kode FROM project")->result_array();
        $newT1 = array();
        foreach ($getTerm1 as $t1) {
            $newT1[] = $t1['kode'];
        }
        $this->datatables->select('
        a.id AS data_id,
      a.kodeproject AS kodeproject,
      a.tanggalbuat AS tanggalbuat,
      a.total AS total,
      a.total_aktual AS total_aktual,
      a.term AS term,
      c.nama AS namaproject,
      b.Nama AS namapenerima,
      a.id_data_id AS idpic,
    ', FALSE);
        $this->datatables->from('field_pembayaran a');
        $this->datatables->join('id_data b', 'a.id_data_id = b.Id');
        $this->datatables->join('project c', 'a.kodeproject = c.kode');
        // $this->datatables->join('project d', 'a.project = d.kode');
        $this->datatables->where('a.status_pembayaran = 1 AND a.term = 2', NULL, FALSE);
        $this->datatables->add_column('cek', '<input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree1" name="statusbayar[]" value="$4" /><input type="hidden" name="idsdm-$4" value="$1"><input type="hidden" name="kodeproject-$4" value="$2"><input type="hidden" name="term-$4" value="$3"><input type="hidden" name="total-$4" value="$5">', 'idpic,kodeproject,term, data_id, total_aktual');
        $this->datatables->add_column('print', '<a href="printstkb/$1/0" target="_blank"><i class="fa fa-print"></i> Print</a><input type="hidden" name="akomodasi$1" value="$2"><input type="hidden" name="bpjs$1" value="$3"><input type="hidden" name="jumlahops$1" value="$4"><input type="hidden" name="jumlahtrk$1" value="$5"><input type="hidden" name="total$1" value="$6">', 'nmrstkb,akomodasi,bpjs,jumlahops,jumlahtrk,total');
        $this->db->order_by('c.nama', 'ASC');
        $data = json_decode($this->datatables->generate(), TRUE);
        $no = 0;
        $newArray = array();
        foreach ($data['data'] as $keyy) {
            // if (!in_array($keyy['kodeproject'], $newT1)) {
            $rek = $this->db->query("SELECT b.nama, d.NoRek as no FROM datarekening d JOIN bank b ON d.CodeBank = b.kode WHERE d.Id = '$keyy[idpic]'")->row_array();
            $newArray[] = array(
                "kodeproject" => $keyy['kodeproject'],
                "term" => $keyy['term'],
                "tanggalbuat" => $keyy['tanggalbuat'],
                "total" => $keyy['total'],
                "total_aktual" => $keyy['total_aktual'],
                "namaproject" => $keyy['namaproject'],
                "namapenerima" => $keyy['namapenerima'],
                "cek" => $keyy['cek'],
                "print" => $keyy['print'],
                "bank" => $rek['nama'],
                "rekening" => $rek['no']
            );
            $no++;
            // }
        }

        $dataTable = [
            'draw' => 0,
            'recordsTotal' => $no,
            'recordsFiltered' => $no,
            'data' => $newArray
        ];
        return json_encode($dataTable);
    }

    public function get_data_term3()
    {
        $getTerm1 = $this->db->query("SELECT kode FROM project")->result_array();
        $newT1 = array();
        foreach ($getTerm1 as $t1) {
            $newT1[] = $t1['kode'];
        }
        $this->datatables->select('
        a.id AS data_id,
      a.kodeproject AS kodeproject,
      a.tanggalbuat AS tanggalbuat,
      a.total AS total,
      a.total_aktual AS total_aktual,
      a.term AS term,
      c.nama AS namaproject,
      b.Nama AS namapenerima,
      a.id_data_id AS idpic,
    ', FALSE);
        $this->datatables->from('field_pembayaran a');
        $this->datatables->join('id_data b', 'a.id_data_id = b.Id');
        $this->datatables->join('project c', 'a.kodeproject = c.kode');
        // $this->datatables->join('project d', 'a.project = d.kode');
        $this->datatables->where('a.status_pembayaran = 1 AND a.term = 3', NULL, FALSE);
        $this->datatables->add_column('cek', '<input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree1" name="statusbayar[]" value="$4" /><input type="hidden" name="idsdm-$4" value="$1"><input type="hidden" name="kodeproject-$4" value="$2"><input type="hidden" name="term-$4" value="$3"><input type="hidden" name="total-$4" value="$5">', 'idpic,kodeproject,term, data_id, total_aktual');
        $this->datatables->add_column('print', '<a href="printstkb/$1/0" target="_blank"><i class="fa fa-print"></i> Print</a><input type="hidden" name="akomodasi$1" value="$2"><input type="hidden" name="bpjs$1" value="$3"><input type="hidden" name="jumlahops$1" value="$4"><input type="hidden" name="jumlahtrk$1" value="$5"><input type="hidden" name="total$1" value="$6">', 'nmrstkb,akomodasi,bpjs,jumlahops,jumlahtrk,total');
        $this->db->order_by('c.nama', 'ASC');
        $data = json_decode($this->datatables->generate(), TRUE);
        $no = 0;
        $newArray = array();
        foreach ($data['data'] as $keyy) {
            // if (!in_array($keyy['kodeproject'], $newT1)) {
            $rek = $this->db->query("SELECT b.nama, d.NoRek as no FROM datarekening d JOIN bank b ON d.CodeBank = b.kode WHERE d.Id = '$keyy[idpic]'")->row_array();
            $newArray[] = array(
                "kodeproject" => $keyy['kodeproject'],
                "term" => $keyy['term'],
                "tanggalbuat" => $keyy['tanggalbuat'],
                "total" => $keyy['total'],
                "total_aktual" => $keyy['total_aktual'],
                "namaproject" => $keyy['namaproject'],
                "namapenerima" => $keyy['namapenerima'],
                "cek" => $keyy['cek'],
                "print" => $keyy['print'],
                "bank" => $rek['nama'],
                "rekening" => $rek['no']
            );
            $no++;
            // }
        }

        $dataTable = [
            'draw' => 0,
            'recordsTotal' => $no,
            'recordsFiltered' => $no,
            'data' => $newArray
        ];
        return json_encode($dataTable);
    }

    public function get_data_rtp_mri_kas()
    {
        $getTerm1 = $this->db->query("SELECT kode FROM project")->result_array();
        $newT1 = array();
        foreach ($getTerm1 as $t1) {
            $newT1[] = $t1['kode'];
        }
        $this->datatables->select('
        a.id AS data_id,
      a.kodeproject AS kodeproject,
      a.tanggalbuat AS tanggalbuat,
      a.total AS total,
      a.total_aktual AS total_aktual,
      a.term AS term,
      c.nama AS namaproject,
      b.Nama AS namapenerima,
      a.id_data_id AS idpic,
    ', FALSE);
        $this->datatables->from('field_pembayaran a');
        $this->datatables->join('id_data b', 'a.id_data_id = b.Id');
        $this->datatables->join('project c', 'a.kodeproject = c.kode');
        // $this->datatables->join('project d', 'a.project = d.kode');
        $this->datatables->where('a.status_pembayaran = 2 AND a.metode_pembayaran = "MRI Kas"', NULL, FALSE);
        $this->datatables->add_column('cek', '<input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree1" name="statusbayar[]" value="$4" /><input type="hidden" name="idsdm-$4" value="$1"><input type="hidden" name="kodeproject-$4" value="$2"><input type="hidden" name="term-$4" value="$3"><input type="hidden" name="total-$4" value="$5">', 'idpic,kodeproject,term, data_id, total_aktual');
        $this->datatables->add_column('print', '<a href="printstkb/$1/0" target="_blank"><i class="fa fa-print"></i> Print</a><input type="hidden" name="akomodasi$1" value="$2"><input type="hidden" name="bpjs$1" value="$3"><input type="hidden" name="jumlahops$1" value="$4"><input type="hidden" name="jumlahtrk$1" value="$5"><input type="hidden" name="total$1" value="$6">', 'nmrstkb,akomodasi,bpjs,jumlahops,jumlahtrk,total');
        $this->db->order_by('c.nama', 'ASC');
        $data = json_decode($this->datatables->generate(), TRUE);
        $no = 0;
        $newArray = array();
        foreach ($data['data'] as $keyy) {
            // if (!in_array($keyy['kodeproject'], $newT1)) {
            $rek = $this->db->query("SELECT b.nama, d.NoRek as no FROM datarekening d JOIN bank b ON d.CodeBank = b.kode WHERE d.Id = '$keyy[idpic]'")->row_array();
            $newArray[] = array(
                "kodeproject" => $keyy['kodeproject'],
                "term" => $keyy['term'],
                "tanggalbuat" => $keyy['tanggalbuat'],
                "total" => $keyy['total'],
                "total_aktual" => $keyy['total_aktual'],
                "namaproject" => $keyy['namaproject'],
                "namapenerima" => $keyy['namapenerima'],
                "cek" => $keyy['cek'],
                "print" => $keyy['print'],
                "bank" => $rek['nama'],
                "rekening" => $rek['no']
            );
            $no++;
            // }
        }

        $dataTable = [
            'draw' => 0,
            'recordsTotal' => $no,
            'recordsFiltered' => $no,
            'data' => $newArray
        ];
        return json_encode($dataTable);
    }

    public function get_data_rtp_mri_pal()
    {
        $getTerm1 = $this->db->query("SELECT kode FROM project")->result_array();
        $newT1 = array();
        foreach ($getTerm1 as $t1) {
            $newT1[] = $t1['kode'];
        }
        $this->datatables->select('
        a.id AS data_id,
      a.kodeproject AS kodeproject,
      a.tanggalbuat AS tanggalbuat,
      a.total AS total,
      a.total_aktual AS total_aktual,
      a.term AS term,
      c.nama AS namaproject,
      b.Nama AS namapenerima,
      a.id_data_id AS idpic,
    ', FALSE);
        $this->datatables->from('field_pembayaran a');
        $this->datatables->join('id_data b', 'a.id_data_id = b.Id');
        $this->datatables->join('project c', 'a.kodeproject = c.kode');
        // $this->datatables->join('project d', 'a.project = d.kode');
        $this->datatables->where('a.status_pembayaran = 2 AND a.metode_pembayaran = "MRI PAL"', NULL, FALSE);
        // $this->datatables->add_column('cek', '<input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree1" name="statusbayar[]" value="$4" /><input type="hidden" name="idsdm-$1" value="$1"><input type="hidden" name="kodeproject-$4" value="$2"><input type="hidden" name="term-$4" value="$3">', 'idpic,kodeproject,term, data_id');
        $this->datatables->add_column('print', '<a href="printstkb/$1/0" target="_blank"><i class="fa fa-print"></i> Print</a><input type="hidden" name="akomodasi$1" value="$2"><input type="hidden" name="bpjs$1" value="$3"><input type="hidden" name="jumlahops$1" value="$4"><input type="hidden" name="jumlahtrk$1" value="$5"><input type="hidden" name="total$1" value="$6">', 'nmrstkb,akomodasi,bpjs,jumlahops,jumlahtrk,total');
        $this->db->order_by('c.nama', 'ASC');
        $data = json_decode($this->datatables->generate(), TRUE);
        $no = 0;
        $newArray = array();
        foreach ($data['data'] as $keyy) {
            // if (!in_array($keyy['kodeproject'], $newT1)) {
            $rek = $this->db->query("SELECT b.nama, d.NoRek as no FROM datarekening d JOIN bank b ON d.CodeBank = b.kode WHERE d.Id = '$keyy[idpic]'")->row_array();
            $newArray[] = array(
                "kodeproject" => $keyy['kodeproject'],
                "term" => $keyy['term'],
                "tanggalbuat" => $keyy['tanggalbuat'],
                "total" => $keyy['total'],
                "total_aktual" => $keyy['total_aktual'],
                "namaproject" => $keyy['namaproject'],
                "namapenerima" => $keyy['namapenerima'],
                "cek" => $keyy['cek'],
                "print" => $keyy['print'],
                "bank" => $rek['nama'],
                "rekening" => $rek['no']
            );
            $no++;
            // }
        }

        $dataTable = [
            'draw' => 0,
            'recordsTotal' => $no,
            'recordsFiltered' => $no,
            'data' => $newArray
        ];
        return json_encode($dataTable);
    }

    public function get_data_paid()
    {
        $getTerm1 = $this->db->query("SELECT kode FROM project")->result_array();
        $newT1 = array();
        foreach ($getTerm1 as $t1) {
            $newT1[] = $t1['kode'];
        }
        $this->datatables->select('
      a.kodeproject AS kodeproject,
      a.tanggalbuat AS tanggalbuat,
      a.total AS total,
      a.total_aktual AS total_aktual,
      a.term AS term,
      c.nama AS namaproject,
      b.Nama AS namapenerima,
      a.id_data_id AS idpic,
    ', FALSE);
        $this->datatables->from('field_pembayaran a');
        $this->datatables->join('id_data b', 'a.id_data_id = b.Id');
        $this->datatables->join('project c', 'a.kodeproject = c.kode');
        // $this->datatables->join('project d', 'a.project = d.kode');
        $this->datatables->where('a.status_pembayaran = 3', NULL, FALSE);
        // $this->datatables->add_column('cek', '<input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree1" name="statusbayar[]" value="$4" /><input type="hidden" name="idsdm-$1" value="$1"><input type="hidden" name="kodeproject-$4" value="$2"><input type="hidden" name="term-$4" value="$3">', 'idpic,kodeproject,term, data_id');
        // $this->datatables->add_column('print', '<a href="printstkb/$1/0" target="_blank"><i class="fa fa-print"></i> Print</a><input type="hidden" name="akomodasi$1" value="$2"><input type="hidden" name="bpjs$1" value="$3"><input type="hidden" name="jumlahops$1" value="$4"><input type="hidden" name="jumlahtrk$1" value="$5"><input type="hidden" name="total$1" value="$6">', 'nmrstkb,akomodasi,bpjs,jumlahops,jumlahtrk,total');
        $this->db->order_by('c.nama', 'ASC');
        $data = json_decode($this->datatables->generate(), TRUE);
        $no = 0;
        $newArray = array();
        foreach ($data['data'] as $keyy) {
            // if (!in_array($keyy['kodeproject'], $newT1)) {
            $rek = $this->db->query("SELECT b.nama, d.NoRek as no FROM datarekening d JOIN bank b ON d.CodeBank = b.kode WHERE d.Id = '$keyy[idpic]'")->row_array();
            $newArray[] = array(
                "kodeproject" => $keyy['kodeproject'],
                "term" => $keyy['term'],
                "tanggalbuat" => $keyy['tanggalbuat'],
                "total" => $keyy['total'],
                "total_aktual" => $keyy['total_aktual'],
                "namaproject" => $keyy['namaproject'],
                "namapenerima" => $keyy['namapenerima'],
                "cek" => $keyy['cek'],
                "print" => $keyy['print'],
                "bank" => $rek['nama'],
                "rekening" => $rek['no']
            );
            $no++;
            // }
        }

        $dataTable = [
            'draw' => 0,
            'recordsTotal' => $no,
            'recordsFiltered' => $no,
            'data' => $newArray
        ];
        return json_encode($dataTable);
    }

    public function updateStatusPembayaran($id, $metode_pembayaran, $noid_bpu)
    {
        $this->db->query("UPDATE field_pembayaran SET status_pembayaran = 2, metode_pembayaran = '$metode_pembayaran', noid_bpu = '$noid_bpu' WHERE id = $id");
    }

    public function updateStatusPaidPembayaran($id)
    {
        $this->db->query("UPDATE field_pembayaran SET status_pembayaran = 3 WHERE id = $id");
    }

    public function getPaidPembayaran($id)
    {
        return $this->db->query("SELECT * FROM field_pembayaran WHERE id = $id")->row_array();
    }

    // End Field Pembayaran


    public function countByProject($kode)
    {
        $this->db->select('*');
        $this->db->from('project_plan');
        $this->db->where('project_kode', $kode);
        return $this->db->get()->num_rows();
    }

    public function getDetailDaftarCabang($id, $project)
    {
        return $this->db->query("SELECT a.*, b.nama 
                                    FROM plan a
                                    JOIN project b ON b.kode = a.project
                                    WHERE a.area_head = '$id'
                                    AND a.project = '$project' 
                                    GROUP BY a.kode, b.kode")->result_array();
    }
    public function getDaftarCabang($id)
    {
        return $this->db->query("SELECT a.*, b.nama 
                                    FROM plan a
                                    JOIN project b ON b.kode = a.project
                                    WHERE a.area_head = '$id' 
                                    GROUP BY a.kode, b.kode")->result_array();
    }
    public function countDaftarCabang($id, $project)
    {
        return $this->db->query("SELECT COUNT(a.kode) AS jumlah_cabang
                                    FROM plan a
                                    JOIN project b ON b.kode = a.project
                                    WHERE a.area_head = '$id' 
                                    AND a.project = '$project'
                                    GROUP BY a.kode, b.kode")->num_rows();
    }
}
