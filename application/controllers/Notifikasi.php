<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('id_user')) {
            redirect('auth');
        }
        $this->load->model('Notifikasi_model');
        $this->load->library('form_validation');
    }

    // USER
    public function index()
    {
        $data['judul'] = "Notifikasi Validasi E-Quest";
        $data['notif'] = $this->Notifikasi_model->getAllData();

        $akses = $this->session->userdata('id_divisi');
        $datenow = date('Y-m-d');

        $id_user = $this->session->userdata('id_user');
        $data['notif1'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang,
	                                            d.nama AS skenario
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project_kode = c.project AND a.cabang_kode = c.kode
	                                            JOIN attribute d ON a.sub_kunjungan_kode = d.kode
                                            WHERE
                                                a.shp_id = '$id_user'
                                                AND a.r_sts_dialog = 0")->result_array();

        $data['notif3'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang,
	                                            d.nama AS skenario
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project_kode = c.project AND a.cabang_kode = c.kode
	                                            JOIN attribute d ON a.sub_kunjungan_kode = d.kode
                                            WHERE
                                                a.shp_id = '$id_user'
                                                AND a.r_sts_upload_layout = 0")->result_array();

        $data['notif4'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang,
	                                            d.nama AS skenario
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project_kode = c.project AND a.cabang_kode = c.kode
	                                            JOIN attribute d ON a.sub_kunjungan_kode = d.kode
                                            WHERE
                                                a.shp_id = '$id_user'
                                                AND a.r_sts_upload_ss = 0")->result_array();

        $data['notif5'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang,
	                                            d.nama AS skenario
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project_kode = c.project AND a.cabang_kode = c.kode
	                                            JOIN attribute d ON a.sub_kunjungan_kode = d.kode
                                            WHERE
                                                a.shp_id = '$id_user'
                                                AND a.r_sts_upload_slip_transaksi = 0")->result_array();

        $data['notif2'] = $this->db->query("SELECT
                                                a.*
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.rekaman_status = 2")->result_array();

        $data['notif99'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                a.r_kategori,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign,
                                                a.tanggal, a.keterlambatan_upload
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.rekaman_status = 0
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();

        $data['notif99d'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                a.r_kategori,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign,
                                                a.tanggal, a.keterlambatan_upload
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.status = '1'
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();

        $data['notif99e1'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.kunjungan = '001'
                                                AND a.equest is null
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();
        $data['notif99e2'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.kunjungan = '002'
                                                AND a.equest is null
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();
        $data['notif99e3'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.kunjungan = '003'
                                                AND a.equest is null
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();
        $data['pengulangan'] = $this->db->query("SELECT 
                                                    a.shp,
                                                    a.project,
                                                    a.cabang,
                                                    a.kunjungan,
                                                    z.nama as nama_project,
                                                    b.nama as nama_cabang,
                                                    c.nama as nama_kunjungan,
                                                    a.r_keterangan_ra
                                                FROM quest_ulang a
                                                    LEFT JOIN project z ON a.project=z.kode
                                                    LEFT JOIN cabang b ON a.cabang=b.kode AND a.project=b.project
                                                    LEFT JOIN attribute c ON a.kunjungan=c.kode
                                                    LEFT JOIN plan d ON a.project=d.project AND a.cabang=d.kode AND a.kunjungan=d.kunjungan
                                                WHERE
                                                    (a.shp = '$id_user' OR a.pwt = '$id_user')
                                                ")->result_array();

        if ($akses == 1 OR $akses == 99) {
            $data['notif_eb'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM ebanking a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    WHERE (d.id_user='$id_user' OR a.user_input='$id_user')
                                                    AND a.status = 1
                                                ")->result_array();
        } else if ($akses == 4) {
            $data['notif_eb'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM ebanking a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    
                                                    WHERE a.validator_id='$id_user'
                                                    AND a.status = 1
                                                ")->result_array();
        } else {
            $data['notif_eb'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM ebanking a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    
                                                    WHERE a.user_input='$id_user'
                                                    AND a.status = 1
                                                ")->result_array();
        }


        if ($akses == 1 OR $akses == 99) {
            $data['notif_sm'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_skenario,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM sosmed a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    WHERE (d.id_user='$id_user' OR a.user_input='$id_user')
                                                    AND a.status = 1
                                                ")->result_array();
        } else if ($akses == 4) {
            $data['notif_sm'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_skenario,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM sosmed a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    
                                                    WHERE a.validator_id='$id_user'
                                                    AND a.status = 1
                                                ")->result_array();
        } else {
            $data['notif_sm'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_skenario,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM sosmed a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    
                                                    WHERE a.user_input='$id_user'
                                                    AND a.status = 1
                                                ")->result_array();
        }


        $data['notif_project'] = $this->db->query("SELECT a.*, b.nama AS nama_bank FROM project a 
                                                    LEFT JOIN bank b ON a.bank=b.kode 
                                                    WHERE visible='y' AND type='n'
                                                    AND  a.tanggal > '2021-05-01'
                                                     AND id_user='$id_user'")->result_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('notif/_index', $data);
        $this->load->view('templates/footer');
    }

    public function indexpic()
    {
        ini_set('display_errors', 1);
        $data['judul'] = "Notifikasi";
        $id_user = $this->session->userdata('id_user');
        $data['notif'] = $this->Notifikasi_model->getAllData();

        $akses = $this->session->userdata('id_divisi');

        $data['notif1'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.pwt
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND a.sub_kunjungan_kode = c.kunjungan
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                            WHERE
                                                c.r_kategori is not null
                                                AND (c.pwt = '$id_user' OR c.r_spv = '$id_user' OR c.r_kareg = '$id_user')
                                                AND a.r_sts_dialog = 0")->result_array();

        $data['notif3'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.pwt
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND a.sub_kunjungan_kode = c.kunjungan
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                            WHERE
                                                c.r_kategori is not null
                                                AND (c.pwt = '$id_user' OR c.r_spv = '$id_user' OR c.r_kareg = '$id_user')
                                                AND a.r_sts_upload_layout = 0")->result_array();

        $data['notif4'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.pwt
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND a.sub_kunjungan_kode = c.kunjungan
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                            WHERE
                                                c.r_kategori is not null
                                                AND (c.pwt = '$id_user' OR c.r_spv = '$id_user' OR c.r_kareg = '$id_user')
                                                AND a.r_sts_upload_ss = 0")->result_array();

        $data['notif5'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.pwt
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                JOIN quest c ON c.project = a.project_kode AND c.cabang = a.cabang_kode AND a.sub_kunjungan_kode = c.kunjungan
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                            WHERE
                                                c.r_kategori is not null
                                                AND (c.pwt = '$id_user' OR c.r_spv = '$id_user' OR c.r_kareg = '$id_user')
                                                AND a.r_sts_upload_slip_transaksi = 0")->result_array();

        $data['notif2'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project = c.project AND a.cabang = c.kode
                                            WHERE
                                                a.rekaman_status = 2
                                                AND a.r_kategori is not null
                                                AND (a.pwt = '$id_user' OR a.r_spv = '$id_user' OR a.r_kareg = '$id_user')
                                                ")->result_array();

        $data['notif99'] = $this->db->query("SELECT
                                                a.shp,
                                                a.timestamp,
                                                a.project,
                                                b.nama as nama_project,
                                                a.cabang,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.status != '3'
                                                AND (a.pwt = '$id_user' OR a.r_spv = '$id_user' OR a.r_kareg = '$id_user')
                                                AND a.r_kategori is not null
                                                AND date(a.waktuassign) <= CURDATE()
                                            ORDER BY
                                                a.waktuassign")->result_array();

        //NOTIF PIC SEBAGAI SHOPPER
        $data['notif11'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang,
	                                            d.nama AS skenario
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project_kode = c.project AND a.cabang_kode = c.kode
	                                            JOIN attribute d ON a.sub_kunjungan_kode = d.kode
                                            WHERE
                                                a.shp_id = '$id_user'
                                                AND a.r_sts_dialog = 0")->result_array();

        $data['notif31'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang,
	                                            d.nama AS skenario
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project_kode = c.project AND a.cabang_kode = c.kode
	                                            JOIN attribute d ON a.sub_kunjungan_kode = d.kode
                                            WHERE
                                                a.shp_id = '$id_user'
                                                AND a.r_sts_upload_layout = 0")->result_array();

        $data['notif41'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang,
	                                            d.nama AS skenario
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project_kode = c.project AND a.cabang_kode = c.kode
	                                            JOIN attribute d ON a.sub_kunjungan_kode = d.kode
                                            WHERE
                                                a.shp_id = '$id_user'
                                                AND a.r_sts_upload_ss = 0")->result_array();

        $data['notif51'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang,
	                                            d.nama AS skenario
                                            FROM
                                                summary_2 a
                                                JOIN project b ON b.kode = a.project_kode
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project_kode = c.project AND a.cabang_kode = c.kode
	                                            JOIN attribute d ON a.sub_kunjungan_kode = d.kode
                                            WHERE
                                                a.shp_id = '$id_user'
                                                AND a.r_sts_upload_slip_transaksi = 0")->result_array();

        $data['notif21'] = $this->db->query("SELECT
                                                a.*,
                                                b.nama AS nama_project,
                                                c.nama AS nama_cabang
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN cabang c ON a.project = c.project
	                                            AND a.cabang = c.kode
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.r_kategori is not null
                                                AND a.rekaman_status = 2")->result_array();

        $data['notif991'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                a.r_kategori,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign,
                                                a.tanggal, a.keterlambatan_upload
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.rekaman_status = 0
                                                AND a.r_kategori is not null
                                                AND date(a.waktuassign) <= CURDATE()")->result_array();

        $data['notif991d'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                a.r_kategori,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign,
                                                a.tanggal, a.keterlambatan_upload
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.status = '1'
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();

        $data['notif991e1'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.kunjungan = '001'
                                                AND a.equest is null
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();

        $data['notif991e2'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.kunjungan = '002'
                                                AND a.equest is null
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();

        $data['notif991e3'] = $this->db->query("SELECT
                                                a.project,
                                                a.cabang,
                                                b.nama as nama_project,
                                                d.nama as nama_cabang,
                                                a.kunjungan,
                                                c.nama,
                                                date(a.waktuassign) as waktuassign
                                            FROM
                                                quest a
                                                JOIN project b ON b.kode = a.project
                                                AND b.type = 'n'
                                                AND b.visible = 'y'
                                                JOIN attribute c ON a.kunjungan = c.kode
                                                JOIN cabang d ON a.cabang = d.kode AND a.project = d.project
                                            WHERE
                                                a.shp = '$id_user'
                                                AND a.kunjungan = '003'
                                                AND a.equest is null
                                                AND date(a.waktuassign) <= CURDATE()
                                                AND a.r_kategori is not null
                                                ")->result_array();
        $data['pengulangan'] = $this->db->query("SELECT 
                                                    a.shp,
                                                    a.project,
                                                    a.cabang,
                                                    a.kunjungan,
                                                    z.nama as nama_project,
                                                    b.nama as nama_cabang,
                                                    c.nama as nama_kunjungan,
                                                    a.r_keterangan_ra
                                                FROM quest_ulang a
                                                    JOIN project z ON a.project=z.kode
                                                    JOIN cabang b ON a.cabang=b.kode AND a.project=b.project
                                                    JOIN attribute c ON a.kunjungan=c.kode
                                                    JOIN plan d ON a.project=d.project AND a.cabang=d.kode AND a.kunjungan=d.kunjungan
                                                WHERE
                                                    (d.penanggung_jawab_field = '$id_user' OR d.area_head = '$id_user' OR d.field_officer='$id_user')
                                                ")->result_array();

        if ($akses == 1 OR $akses == 99) {
            $data['notif_eb'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM ebanking a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    WHERE d.id_user='$id_user'
                                                    AND a.status = 1
                                                ")->result_array();
        } else if ($akses == 4) {
            $data['notif_eb'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM ebanking a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    
                                                    WHERE a.validator_id='$id_user'
                                                    
                                                    AND a.status = 1
                                                ")->result_array();
        } else {
            $data['notif_eb'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    
                                                    FROM ebanking a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    
                                                    WHERE a.user_input='$id_user'
                                                    AND a.status = 1
                                                ")->result_array();
        }


        if ($akses == 1 OR $akses == 99) {
            $data['notif_sm'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_skenario,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM sosmed a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    WHERE d.id_user='$id_user'
                                                    AND a.status = 1
                                                ")->result_array();
        } else if ($akses == 4) {
            $data['notif_sm'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_skenario,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2
                                                    FROM sosmed a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    
                                                    WHERE a.validator_id='$id_user'
                                                    
                                                    AND a.status = 1
                                                ")->result_array();
        } else {
            $data['notif_sm'] = $this->db->query("SELECT a.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_skenario,
                                                    d.nama AS nama_project,
                                                    e.name AS nama_user1,
                                                    f.nama AS nama_user2                                                    
                                                    FROM sosmed a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    LEFT JOIN user e ON a.user_input=e.noid
                                                    LEFT JOIN ebanking_shopper f ON a.user_input=f.user_id
                                                    
                                                    WHERE a.user_input='$id_user'
                                                    AND a.status = 1
                                                ")->result_array();
        }

        $data['notif_project'] = $this->db->query("SELECT a.*, b.nama AS nama_bank FROM project a 
                                                    LEFT JOIN bank b ON a.bank=b.kode 
                                                    WHERE visible='y' AND type='n'
                                                    AND  a.tanggal > '2021-05-01'
                                                     AND id_user='$id_user'")->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('notif/_indexpic', $data);
        $this->load->view('templates/footer');
    }

    public function simpan()
    {
        $this->Notifikasi_model->simpan();
        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable mb">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Keterangan Validasi berhasil <strong>disimpan!</strong>.
              </div>');

        redirect('notifikasi');
    }
    // AKHIR USER

    // admin
    public function notifikasiRA()
    {
        $data['judul'] = "Notifikasi Temuan";
        $data['dialog'] = $this->Notifikasi_model->getDataTemuanDialog();
        $data['rekaman'] = $this->Notifikasi_model->getDataTemuanRekaman();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('notif/indexRA', $data);
        // $this->load->view('notif/audio', $data);
        $this->load->view('templates/footer');
    }

    public function dialog($id)
    {
        $this->Notifikasi_model->dialog($id);
        $this->session->set_flashdata('info', 'Data Berhasil Disimpan');

        redirect("notifikasi/notifikasiRA");
    }

    public function rekaman($id)
    {
        $this->Notifikasi_model->rekaman($id);
        $this->session->set_flashdata('info', 'Data Berhasil Disimpan');

        redirect("notifikasi/notifikasiRA");
    }
    // akhir admin

    // VALIDASI
    public function notifikasiValidasi()
    {
        $data['judul'] = "Notifikasi Uploadan Ulang";
        $data['dialog'] = $this->Notifikasi_model->getDataUploadUlangDialog();
        $data['slip'] = $this->Notifikasi_model->getDataUploadUlangSlip();
        $data['layout'] = $this->Notifikasi_model->getDataUploadUlangLayout();
        $data['ss'] = $this->Notifikasi_model->getDataUploadUlangSs();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('notif/indexValidasi', $data);
        $this->load->view('templates/footer');
    }
    // VALIDASI

    public function daftar_email()
    {
        $id_user = $this->input->post('id_user');
        $table = $this->input->post('table');
        $kolom = $this->input->post('kolom');
        $where_col = $this->input->post('where_col');

        $email = $this->input->post('email');

        $daftar = $this->db->query("UPDATE $table SET $kolom='$email' WHERE $where_col='$id_user'");

        $this->session->set_flashdata('flash', 'Anda Berhasil Mendaftarkan Email');
        redirect('notifikasi');
    }
}
