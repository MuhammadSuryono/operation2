<?php
defined('BASEPATH') or exit('No direct script access allowed');

defined("RABU") OR define("RABU", 3);
defined("JUMAT") OR define("JUMAT", 5);

include_once (dirname(__FILE__) . "/Whatsapp.php");
class Stkb extends Whatsapp
{

  public function __construct()
  {
    parent::__construct();

    if (!$this->session->userdata('id_user')) {
      $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong> Silahkan Login </strong>.
              </div>');
      redirect('block');
    } else {

      $id_user = $this->session->userdata('id_user');
      $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();

      if ($user['id_akses'] == 2) {
        redirect('block');
      }
    }

    $this->load->model('Projectplan_model');
    $this->load->model('Fieldsdm_model');
    $this->load->model('Training_model');
    $this->load->model('Stkb_model');
    $this->load->model('Project_model');
    $this->load->model('Cabang_model');
    $this->load->model('Akun_model');
    $this->load->library('form_validation');
  }

  /******** Controller STKB Dasar TRK ********/
  public function dasartrk()
  {
    $data['judul'] = "STKB || Dasar TRK";
    $data['stkbdasartrkbank'] = $this->Stkb_model->getallstkbbank();
    $data['stkbdasartrksken'] = $this->Stkb_model->getallstkbskenario();
    $proses = $this->Stkb_model->getallstkbbank();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/dasartrk/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_dasartrk()
  {
    $data['judul'] = "STKB || Tambah Dasar TRK";
    $data['stkbbanktanpa'] = $this->Stkb_model->getbanktanpa();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/dasartrk/tambah', $data);
    $this->load->view('templates/footer');
  }

  public function edit_dasartrk($id)
  {
    $data['kode'] = $this->Stkb_model->getBankByKode($id);
    // var_dump($data['kode']);
    // die;
    $data['skenario'] = $this->Stkb_model->getSkenario($id);

    $this->form_validation->set_rules('kodebank', 'Kodebank', 'trim');

    $db2 = $this->load->database('database_kedua', TRUE);
    $ulangtrk = $db2->get_where('stkb_dasar_trk', ['kodebank' => $id])->num_rows();

    for ($i = 1; $i < $ulangtrk; $i++) {
      $this->form_validation->set_rules("$i", "$i", 'trim');
    }

    if ($this->form_validation->run() == false) {
      $data['judul'] = "STKB || Edit Dasar TRK";
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('stkb/dasartrk/edit', $data);
      $this->load->view('templates/footer');
    } else {
      $this->Stkb_model->ubahDasarTrk($id, $i);
      $this->session->set_flashdata('flash', 'Data berhasil di ubah');
      redirect('stkb/dasartrk');
    }
  }
  /******** //Controller STKB Dasar TRK ********/

  /******** Controller STKB Matrix Perdin ********/
  public function matrixperdin()
  {
    $data['judul'] = "STKB || Matrix Perdin";
    $data['stkbperdin'] = $this->Stkb_model->getAllStkbPerdin();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/matrixperdin/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_matrixperdin()
  {
    $this->Stkb_model->tambahdatamatrixperdin();
    $this->session->set_flashdata('flash', 'Data Ditambahkan');
    redirect('stkb/matrixperdin');
  }

  public function edit_matrixperdin()
  {
    $this->Stkb_model->editmatrixperdin();
    $this->session->set_flashdata('flash', 'Edit Berhasil');
    redirect('stkb/matrixperdin');
  }

  public function hapus_matrixperdin($id)
  {
    $this->Stkb_model->hapusDatastkbperdin($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect('stkb/matrixperdin');
  }

  public function cekperdinkotaasaldinas()
  {
    $asal = $this->input->post('asal');
    $tujuan = $this->input->post('tujuan');
    $cek = $this->Stkb_model->getStkbPerdinByAsalTujuan($asal, $tujuan);
    echo json_encode($cek);
  }
  /******** //Controller STKB Matrix Perdin ********/

  /******** Controller STKB Skenario ********/
  public function skenario()
  {
    $data['judul'] = "STKB || Skenario";
    $data['stkbskenario'] = $this->Stkb_model->getAllStkbSkenario();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/skenario/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_skenario()
  {
    $this->Stkb_model->tambahdatastkbskenario();
    $this->session->set_flashdata('flash', 'Data Ditambahkan');
    redirect('stkb/skenario/index');
  }

  public function edit_skenario($id)
  {
    $this->Stkb_model->ubahdatastkbskenario($id);
    $this->session->set_flashdata('flash', 'Diubah');
    redirect('stkb/skenario/index');
  }

  public function hapus_skenario($id)
  {
    $this->Stkb_model->hapusdatastkbskenario($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect('stkb/skenario/index');
  }
  /******* //Controller STKB Skenario ********/


  /******* Controller STKB 1-project ********/
  public function oneproject()
  {
    $data['judul'] = "STKB || 1-Project";
    $data['semuaproject'] = $this->Stkb_model->getallproject();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/1project/index', $data);
    $this->load->view('templates/footer');
  }

  public function edit_oneproject($kopro)
  {
    $data['judul'] = "STKB || Edit 1-Project";
    $data['kode'] = $this->Stkb_model->getprojectbykode($kopro);
    $data['id'] = $this->Stkb_model->getskenariopro($kopro);
    $data['sken'] = $this->Stkb_model->getallstkbskenario();
    $data['kunjungangede'] = $this->Stkb_model->getkunjungangede($kopro);
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/1project/edit', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_oneproject()
  {
    $kopro = $_POST['kodeproject'];
    $this->Stkb_model->tambahskenarioproject();
    $this->session->set_flashdata('flash', 'Skenario Ditambahkan');
    redirect("stkb/edit_oneproject/$kopro");
  }

  public function hapus_oneproject($id, $kopro)
  {
    $this->Stkb_model->hapusskenoneproject($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect("stkb/edit_oneproject/$kopro");
  }

  public function proses_editoneproject()
  {
    $kopro = $_POST['project'];
    $this->Stkb_model->editskenarioproject();
    $this->session->set_flashdata('flash', 'Edit Berhasil');
    redirect("stkb/edit_oneproject/$kopro");
  }
  /******* //Controller STKB 1-project ********/


  /******* //Controller STKB Transaksi ********/
  public function transaksi()
  {
    $data['judul'] = "STKB || Transaksi";
    $data['getstkbtrk'] = $this->Stkb_model->getallstkbtrk();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/transaksi/index', $data);
    $this->load->view('templates/footer');
  }
  /******* //Controller STKB Transaksi ********/


  /******* //Controller STKB Operational ********/
  public function operational()
  {
    $data['judul'] = "STKB || Operational";
    $data['stkbops'] = $this->Stkb_model->getAllStkbOps();
    $data['allproject'] = $this->Stkb_model->getallproject();
    $data['dariiddata'] = $this->Stkb_model->getalliddata();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/operational/index', $data);
    $this->load->view('templates/footer');
  }
  /******* //Controller STKB Operational ********/

  /******* //Controller STKB Master Plan ********/
  public function masterplan_OLD() // 10 Desember 2020
  {
    $data['judul'] = "STKB || Master Plan";
    $data['masterplannama'] = $this->Stkb_model->getallnama();
    $data['masterplanproject'] = $this->Stkb_model->getallprojectmaster();
    $data['masterplankota'] = $this->Stkb_model->kotakabupaten();
    $data['getallitinerary'] = $this->Stkb_model->getitinerary();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/masterplan/index', $data);
    $this->load->view('templates/footer', $data);
  }

  public function masterplan() // BARU 10 Desember 2020
  {
    $data['judul'] = "STKB || Master Plan";
    $data['masterplannama'] = $this->Stkb_model->getallnama();
    $data['masterplanproject'] = $this->Stkb_model->getallprojectmaster();
    $data['masterplankota'] = $this->Stkb_model->kotakabupaten();
    $data['getallitinerary'] = $this->Stkb_model->getitinerary();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/masterplan/index', $data);
    $this->load->view('templates/footer', $data);
  }

  public function getcabang_nonatm()
  {
    $id = $_POST['id_project'];
    $data = $this->Stkb_model->getcabang_nonatm($id);
    echo json_encode($data);
  }

  public function getcabang_atmcenter()
  {
    $id = $_POST['id_project'];
    $data = $this->Stkb_model->getcabang_atmcenter($id);
    echo json_encode($data);
  }

  public function getdataitinerary()
  {
    $data = $this->Stkb_model->getitinerary();
    echo json_encode($data);
  }

  public function getjakartalist()
  {
    $data = $this->Stkb_model->getjakartalist();
    echo json_encode($data);
  }

  public function getallnamabykotapulau()
  {
    // $pulau = $this->db->query("SELECT nm_pulau as nama FROM kota WHERE nm_kota like '%jakarta%'")->row_array();
    $pulau = $this->db->query("SELECT nm_pulau as nama FROM kota WHERE nm_kota like '%$_POST[kota]%'")->row_array();
    $kota = $this->db->query("SELECT nm_kota as kota FROM kota WHERE nm_pulau = '$pulau[nama]'")->result_array();
    $listKota = [];
    foreach ($kota as $nm) {
      $listKota[] = strtoupper($nm['kota']);
    }
    $inList = "('" . implode("','", $listKota) . "')";

    $project = $_POST['project'];
    $kareg = $_POST['kareg'];
    $kota = strtoupper($_POST['kota']);
    // $project = 'SB1';$kareg = '970';$pic = '15100278';$kota = strtoupper('jakarta'); // DATA TEST
    $lintas = $this->db->query("SELECT pic FROM data_pengajuan_sdm WHERE project = '$project' AND kareg = '$kareg' AND kota_dinas = '$kota' AND status = '1'")->row_array();
    if ($lintas != NULL) {
      $lintas = $lintas['pic'];
    } else {
      $lintas = '';
    }
    $sdm = $this->db->query("SELECT id,nama,kota_asal FROM stkb_sdm WHERE id != '0' AND (id = '$lintas' OR kota_asal IN $inList)")->result_array();
    echo json_encode($sdm);
  }

  public function getkotabyidpic()
  {
    $sdm = $this->db->query("SELECT kota_asal, kota_penugasan, nama FROM stkb_sdm WHERE id = '$_POST[id]'")->row_array();
    echo json_encode($sdm);
  }
  public function getkotabyidfo()
  {
    $sdm = $this->db->query("SELECT b.nm_kota AS kota_asal, a.kota_dinas, b.nm_kota AS kota_penugasan, c.Nama as nama 
                              FROM field_sdm a 
                              JOIN kota b ON b.id = a.kota_id 
                              -- JOIN kota d ON d.id = a.kota_dinas
                              JOIN id_data c ON c.Id = a.id_data_id 
                              WHERE id_data_id = '$_POST[id]'
                              UNION
                              SELECT z.KotaTgl as kota_asal, x.kota_dinas, x.kota_dinas AS kota_penugasan, z.Nama as nama
                              FROM data_pengajuan_sdm x
                              JOIN id_data z ON x.pic = z.Id 
                              WHERE x.pic = '$_POST[id]'
                              ")->row_array();
    echo json_encode($sdm);
  }

  public function submitpengajuanlintaspulau()
  {
    error_reporting(0);
    // $project = 'SBAC';$kareg = '970';$pic = '15100278';$dinas = 'PONTIANAK'; // DATA TEST
    $project = $_POST['project'];
    $kareg = $_POST['kareg'];
    $pic = $_POST['pic'];
    $dinas = $_POST['kota']; // DATA REAL
    $cek = $this->db->query("SELECT id FROM data_pengajuan_sdm WHERE project = '$project' AND kareg = '$kareg' AND pic = '$pic' AND kota_dinas = '$dinas' AND (status = '0' OR status = '1')")->num_rows();
    if ($cek > 0) {
      echo json_encode('gagal');
    } else {
      if ($this->db->get_where('user', ['noid' => $kareg])->num_rows() >= 1) {
        $user = $this->db->get_where('user', ['noid' => $kareg])->row_array();
        $namaKareg = $user['name'];
      } else {
        $user = $this->db->get_where('id_data', ['Id' => $kareg])->row_array();
        $namaKareg = $user['Nama'];
      }
      $get = $this->db->query("SELECT nama, kota_asal AS asal FROM stkb_sdm WHERE id = '$pic'")->row_array();
      $prj = $this->db->query("SELECT nama FROM project WHERE kode = '$project'")->row_array();
      $data = [
        "project" => $project,
        "kareg" => $kareg,
        "pic" => $pic,
        "kota_dinas" => $dinas,
        "tanggal" => date('Y-m-d H:i:s')
      ];
      $this->db->insert('data_pengajuan_sdm', $data);
      $idpengajuan = $this->db->insert_id();

      $this->load->library('email');
      $config = configEmail();
      $message = '
        <p>' . $namaKareg . ' telah mengajukan <b>' . $get['nama'] . '</b> untuk melakukan penugasan lintas pulau, adapun detail penugasan sebagai berikut:</p>
        <p>
          Nama Project: ' . $project . ' - ' . $prj['nama'] . '<br>
          Nama PIC: ' . $get['nama'] . '<br>
          Asal Kota: ' . $get['asal'] . '<br>
          Penugasan ke: ' . $dinas . '
        </p>
        <a href="' . base_url('pengajuan/setuju/' . $idpengajuan) . '"><p style="color:#08d43b;font-weight:bold;">Klik disini untuk setujui pengajuan</p></a><br>
        <a href="' . base_url('pengajuan/tolak/' . $idpengajuan) . '"><p style="color:#d42a08;font-weight:bold;">Klik disini untuk tolak pengajuan</p></a><br><br>
        <p>Jika link diatas tidak dapat di akses, silahkan <a href="' . base_url('stkb/daftarpengajuanlintaspulau/') . '">Klik disini</a>.</p>
        <p style="font-size:12px;">Email ini dikirim otomatis melalui Aplikasi Operation 2.</p>
      ';
      // echo json_encode($message); die;
      $this->email->initialize($config);
      $namaPengirim = 'Marketing MRI';
      $emailPengirim = 'otomatis@mri-research-ind.com';
      // $emailPenerima = 'manajemen@mri-research-ind.com';
      $emailPenerima = $_POST['email_approval'];
      $namaPenerima = $_POST['nama_approval'];

      $this->email->from($emailPengirim, $namaPengirim);
      $this->email->subject('Pengajuan Lintas Pulau');
      $this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
      $this->email->to($emailPenerima, $namaPenerima);
      $this->email->message($message);
      // $this->email->send(FALSE);
      if ($this->email->send()) {
        echo json_encode('sukses');
      } else {
        echo json_encode('sukses2');
      }
      // echo $this->email->print_debugger();
    }
  }

  public function submitpersetujuanlintaspulau($id)
  {
    if ($this->session->userdata('id_divisi') == 99) {
      $this->db->select('a.*, p.nama as namaproject, s.nama as namapic, s.kota_asal,
        IF(u.name IS NOT NULL, u.name, (SELECT Nama FROM id_data WHERE Id = a.kareg)) as namakareg,
        IF(u.email IS NOT NULL, u.email, (SELECT Email FROM id_data WHERE Id = a.kareg)) as emailkareg
      ', FALSE);
      $this->db->from('data_pengajuan_sdm a');
      $this->db->join('project p', 'a.project = p.kode');
      $this->db->join('stkb_sdm s', 'a.pic = s.id');
      $this->db->join('user u', 'a.kareg = u.noid');
      $this->db->where('a.id = ' . $id . '');
      $get = $this->db->get()->row_array();

      $update = $this->db->where('id', $id)->update('data_pengajuan_sdm', ['status' => 1, 'tanggal' => date('Y-m-d H:i:s')]);
      if ($update) {
        $this->load->library('email');
        $config = configEmail();
        $message = '
          <p>Pengajuan lintas pulau anda telah <b>di setujui</b>, adapun detail penugasan sebagai berikut:</p>
          <p>
            Nama Project: ' . $get['namaproject'] . ', ' . $get['kareg'] . '<br>
            Nama PIC: ' . $get['pic'] . ' - ' . $get['namapic'] . '<br>
            Asal Kota: ' . $get['kota_asal'] . '<br>
            Penugasan ke: ' . $get['kota_dinas'] . '
          </p>
          <p style="font-size:12px;">Email ini dikirim otomatis melalui Aplikasi Operation 2.</p>
        ';
        $this->email->initialize($config);
        $namaPengirim = 'Manajemen MRI';
        $emailPengirim = 'manajemen@mri-research-ind.com';
        $emailPenerima = $get['emailkareg'];
        $this->email->from($emailPengirim, $namaPengirim);
        $this->email->subject('Pengajuan Lintas Pulau Di Setujui');
        $this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
        $this->email->to($emailPenerima);
        $this->email->message($message);
        $this->email->send();

        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Pengajuan Lintas Pulau (' . $get['project'] . ' - ' . $get['namaproject'] . ', ' . $get['kareg'] . ' - ' . $get['namakareg'] . ', ' . $get['pic'] . ' - ' . $get['namapic'] . ') <strong>berhasil di setujui!</strong>.
                </div>');
        redirect('stkb/daftarpengajuanlintaspulau');
      } else {
        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Pengajuan Lintas Pulau (' . $get['project'] . ' - ' . $get['namaproject'] . ', ' . $get['kareg'] . ' - ' . $get['namakareg'] . ', ' . $get['pic'] . ' - ' . $get['namapic'] . ') <strong>gagal di setujui!</strong>.
                </div>');
        redirect('stkb/daftarpengajuanlintaspulau');
      }
    }
  }

  public function submitpenolakanlintaspulau()
  {
    if ($this->session->userdata('id_divisi') == 99) {
      $id = $this->input->post('idpengajuan');
      $ket = $this->input->post('alasan');

      $this->db->select('a.*, p.nama as namaproject, s.nama as namapic, s.kota_asal,
        IF(u.name IS NOT NULL, u.name, (SELECT Nama FROM id_data WHERE Id = a.kareg)) as namakareg,
        IF(u.email IS NOT NULL, u.email, (SELECT Email FROM id_data WHERE Id = a.kareg)) as emailkareg
      ', FALSE);
      $this->db->from('data_pengajuan_sdm a');
      $this->db->join('project p', 'a.project = p.kode');
      $this->db->join('stkb_sdm s', 'a.pic = s.id');
      $this->db->join('user u', 'a.kareg = u.noid');
      $this->db->where('a.id = ' . $id . '');
      $get = $this->db->get()->row_array();

      $update = $this->db->where('id', $id)->update('data_pengajuan_sdm', ['status' => 2, 'keterangan' => $ket, 'tanggal' => date('Y-m-d H:i:s')]);
      if ($update) {
        $this->load->library('email');
        $config = configEmail();
        $message = '
          <p>Pengajuan lintas pulau anda telah <b>di tolak</b>, adapun detail penugasan sebagai berikut:</p>
          <p>
            Nama Project: ' . $get['namaproject'] . ', ' . $get['kareg'] . '<br>
            Nama PIC: ' . $get['pic'] . ' - ' . $get['namapic'] . '<br>
            Asal Kota: ' . $get['kota_asal'] . '<br>
            Penugasan ke: ' . $get['kota_dinas'] . '
          </p>
          <p style="font-size:12px;">Email ini dikirim otomatis melalui Aplikasi Operation 2.</p>
        ';
        $this->email->initialize($config);
        $namaPengirim = 'Manajemen MRI';
        $emailPengirim = 'manajemen@mri-research-ind.com';
        $emailPenerima = $get['emailkareg'];
        $this->email->from($emailPengirim, $namaPengirim);
        $this->email->subject('Pengajuan Lintas Pulau Di Tolak');
        $this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
        $this->email->to($emailPenerima);
        $this->email->message($message);
        $this->email->send();

        $this->session->set_flashdata('info', '<div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Pengajuan Lintas Pulau (' . $get['project'] . ' - ' . $get['namaproject'] . ', ' . $get['kareg'] . ' - ' . $get['namakareg'] . ', ' . $get['pic'] . ' - ' . $get['namapic'] . ') <strong>berhasil di tolak!</strong>.
                </div>');
        redirect('stkb/daftarpengajuanlintaspulau');
      } else {
        $this->session->set_flashdata('info', '<div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Pengajuan Lintas Pulau (' . $get['project'] . ' - ' . $get['namaproject'] . ', ' . $get['kareg'] . ' - ' . $get['namakareg'] . ', ' . $get['pic'] . ' - ' . $get['namapic'] . ') <strong>gagal di tolak!</strong>.
                </div>');
        redirect('stkb/daftarpengajuanlintaspulau');
      }
    }
  }

  public function daftarpengajuanlintaspulau()
  {
    if ($this->session->userdata('id_divisi') == 99) {
      $data['judul'] = "STKB || Daftar Pengajuan Lintas Pulau";
      $data['daftar'] = $this->Stkb_model->getallpengajuanlintaspulau();
      $this->load->view('templates/header', $data);
      $this->load->view('templates/sidebar');
      $this->load->view('stkb/pengajuan/daftarlintaspulau', $data);
      $this->load->view('templates/footer');
    }
  }

  public function getkotaproject()
  {
    $id = $_POST['id'];
    $cekatmbukan = $this->Stkb_model->getatmataubukan($id);

    // TAMBAHAN ADAM SANTOSO => JIKA SKENARIO APAKAH KE ATM ATAU CABANG AMBIL DATA DARI SALAH SATU
    if ($cekatmbukan) {
      $data['kota'] = $this->Stkb_model->getkotaatm($id);
      $data['type'] = $this->db->get_where('project', array('kode' => $id))->result_array();
      echo json_encode($data);
    } else {
      $data['kota'] = $this->Stkb_model->getkotaproject($id);
      $data['type'] = $this->db->get_where('project', array('kode' => $id))->result_array();
      echo json_encode($data);
    }
    // TAMBAHAN ADAM SANTOSO => AMBIL DARI KEDUANYA JIKA DI DATA 1 TIDAK ADA AMBIL DI DATA 2 DAN SEBALIKNYA
    // $data1 = $this->Stkb_model->getkotaatm($id);
    // $data2 = $this->Stkb_model->getkotaproject($id);
    // $data = array_merge($data1, $data2);
    // echo json_encode($data);
  }

  public function getdaftarcabang()
  {
    $id    = $_POST['id'];
    $kota  = $_POST['kota'];
    $cekatmbukan = $this->Stkb_model->getatmataubukan($id);
    // $data = $cekatmbukan->row_array();
    // if($data['att'] == '064' || $data['att'] == '065' || $data['att'] == '066' || $data['att'] == '067'){
    //   $data = $this->Stkb_model->getdaftarcabangatm($id,$kota);
    //   echo json_encode($data);
    // }else{
    //   $data = $this->Stkb_model->getdaftarcabang($id,$kota);
    //   echo json_encode($data);
    // }
    //var_dump($cekatmbukan);


    // TAMBAHAN ADAM SANTOSO => JIKA SKENARIO APAKAH KE ATM ATAU CABANG AMBIL DATA DARI SALAH SATU
    if ($cekatmbukan) {
      $data = $this->Stkb_model->getdaftarcabangatm($id, $kota);
      echo json_encode($data);
    } else {
      $data = $this->Stkb_model->getdaftarcabang($id, $kota);
      echo json_encode($data);
    }
    // TAMBAHAN ADAM SANTOSO => AMBIL DARI KEDUANYA JIKA DI DATA 1 TIDAK ADA AMBIL DI DATA 2 DAN SEBALIKNYA
    // $data1 = $this->Stkb_model->getdaftarcabangatm($id, $kota);
    // $data2 = $this->Stkb_model->getdaftarcabang($id, $kota);
    // $data = array_merge($data1, $data2);
    // echo json_encode($data);
  }

  public function tambahmasterplan()
  {
    $this->Stkb_model->insertkeops();
    $this->Stkb_model->insertketrk();
    $this->Stkb_model->insertkeplan();
    $this->session->set_flashdata('flash', 'Pembuatan Master Plan Berhasil');
    redirect("stkb/operational");
  }

  public function tambahmasterplan_2021()
  {
    $this->Stkb_model->insertkeops_2021();
    $this->Stkb_model->insertketrk_2021();
    $this->Stkb_model->insertkeplan_2021();
    // die;
    $this->session->set_flashdata('flash', 'Pembuatan Master Plan Berhasil');
    redirect("stkb/operational");
  }

  public function kotakab()
  {
    $data['judul'] = "STKB || Kabupaten Kota";
    $data['getallkotakab'] = $this->Stkb_model->allkotakab();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/kotakab/index', $data);
    $this->load->view('templates/footer');
  }

  public function daftarstkb()
  {
    $data['judul'] = "STKB || Daftar STKB";
    // $data['getalldaftarstkb'] = $this->Stkb_model->alldaftarstkb();
    $data['getproject'] = $this->db->order_by('nama', 'asc')->get_where('project', array('visible' => 'y', 'type' => 'n'))->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/daftarstkb/index', $data);
    $this->load->view('templates/footer');
  }

  public function hapus_daftarstkb($stkb)
  {

    $hapus_ops = $this->db->query("DELETE FROM stkb_ops WHERE nomorstkb='$stkb'");
    $hapus_trk = $this->db->query("DELETE FROM stkb_trk WHERE nostkb='$stkb'");
    $hapus_plan = $this->db->query("DELETE FROM plan WHERE nomorstkb='$stkb'");


    if ($hapus_ops && $hapus_trk && $hapus_plan) {
      $this->session->set_flashdata('flash', 'Berhasil Di Hapus');
      redirect("stkb/daftarstkb");
    } else { ?>
      <script>
        window.location = '<?php echo site_url('stkb/daftarstkb') ?>';
        window.alert('Maaf Gagal Hapus STKB');
      </script>;
    <?php
    }
  }

  public function lskontrak()
  {
    $data['judul'] = "STKB || LS Kontrak";
    $data['getalllskontrak'] = $this->Stkb_model->alllskontrak();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/lskontrak/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_lskontrak()
  {
    date_default_timezone_set('Asia/Jakarta');
    $jenkot = $this->input->post('kota');
    $jabatan = $this->input->post('jabatan');
    $penempatan = $this->input->post('penempatan');
    $cek = $this->db->get_where('stkb_lskontrak', array('kota' => $jenkot, 'jabatan' => $jabatan, 'penempatan' => $penempatan))->num_rows();

    if ($cek == 0) {
      $this->Stkb_model->tambah_lskontrak($jenkot);

      $this->session->set_flashdata('flash', 'Tambah Data LS Kontrak Berhasil');
      redirect("stkb/lskontrak");
    } else {
    ?>
      <script>
        window.alert('Maaf Matrix LS Kontrak Tersebut Sudah Ada.');
        window.location = '<?php echo site_url('stkb/lskontrak') ?>';
      </script>;
      <?php
    }
  }

  public function edit_lskontrak()
  {
    $this->Stkb_model->edit_lskontrak();

    $this->session->set_flashdata('flash', 'LS Kontrak Berhasil Diubah');
    redirect("stkb/lskontrak");
  }

  public function hapus_lskontrak($no)
  {
    $this->db->where('no', $no);
    $this->db->delete('stkb_lskontrak');
    $this->session->set_flashdata('flash', 'Berhasil Dihapus');
    redirect('stkb/lskontrak');
  }

  // public function ceklskontrak()
  // {
  //   $asal = $this->input->post('asal');
  //   $tujuan = $this->input->post('tujuan');
  //   $cek = $this->Stkb_model->getStkbPerdinByAsalTujuan($asal, $tujuan);
  //   echo json_encode($cek);
  // }
  /******* //Controller STKB Master Plan ********/

  /****** Controller STKB Tracking ******/
  public function tracking()
  {
    $data['judul'] = "STKB || Tracking";
    $data['gettracking'] = $this->Stkb_model->getalldatatracking();
    $data['q'] = $this->Stkb_model->getdata_q();
    // $data['getprogress'] = $this->Stkb_model->getallprogress();
    // var_dump($this->Stkb_model->getalldatatracking()); die;
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/tracking/index', $data);
    $this->load->view('templates/footer');
  }
  /****** //Controller STKB Tracking ******/

  /****** Controller STKB Pengajuan ******/
  public function pengajuan()
  {
    $dbMri = $this->load->database('db_mritransfer', TRUE);
    $data['judul'] = "STKB || Pengajuan";
		$jenisPembayaran = $dbMri->query("SELECT max_transfer FROM jenis_pembayaran WHERE jenispembayaran = 'STKB'")->row_array();
    $data['getpengajuan'] = $this->Stkb_model->getallpengajuan();
		$data['maxTransfer'] = $jenisPembayaran['max_transfer'];
    // $data['allpengajuanterm2'] = $this->Stkb_model->getallterm2();
    // $data['allpengajuanterm3'] = $this->Stkb_model->getallterm3();
    // $data['getrtp'] = $this->Stkb_model->getallrtp();
    // $data['getpaid'] = $this->Stkb_model->getallpaid();
    // $data['Stkb_modelnya'] = $this->Stkb_model;
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/pengajuan/index', $data);
    $this->load->view('templates/footer');
  }
  public function pengajuan2()
  {
    // $this->load->model('Stkb_model2');
    $this->load->library('datatables');
    $data['judul'] = "STKB || Pengajuan";
    $data['getpengajuan'] = $this->Stkb_model2->getallpengajuanByAdam();
    // $data['allpengajuanterm2'] = $this->Stkb_model->getallterm2();
    // $data['allpengajuanterm3'] = $this->Stkb_model->getallterm3();
    // $data['getrtp'] = $this->Stkb_model->getallrtp();
    // $data['getpaid'] = $this->Stkb_model->getallpaid();
    // $data['Stkb_modelnya'] = $this->Stkb_model;
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/pengajuan/indexcoba', $data);
    $this->load->view('templates/footer');
  }
  public function getAllDataTabByAdam()
  {
    error_reporting(0);
    $this->load->library('datatables');
    // $this->load->model('Stkb_model2');
    $tab = $_POST['data'];
    $id_user = $this->session->userdata('id_user');
    if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
      $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
    } else {
      $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
    }
    $data['user'] = $user;
    if ($tab == '#term1') {
      $this->load->view('stkb/pengajuan/tab/term1', $data);
    } else if ($tab == '#term2') {
      $this->load->view('stkb/pengajuan/tab/term2', $data);
    } else if ($tab == '#term3') {
      $this->load->view('stkb/pengajuan/tab/term3', $data);
    } else if ($tab == '#menu1') {
      $data['getrtp'] = $this->Stkb_model->getallrtp();
      $this->load->view('stkb/pengajuan/tab/menu1', $data);
    } else if ($tab == '#menu2') {
      $data['getpaid'] = $this->Stkb_model->getallpaid();
      $this->load->view('stkb/pengajuan/tab/menu2', $data);
    } else if ($tab == '#menu3') {
      $data['getproject'] = $this->Stkb_model->getallproject();

      $this->load->view('stkb/pengajuan/tab/menu3', $data);
    }
  }
  public function getAllJSONDataTabByAdam($tab)
  {
    error_reporting(0);
    $this->load->library('datatables');
    // $this->load->model('Stkb_model2');
    header('Content-Type: application/json');
    if ($tab == 'term1') {
      echo $this->Stkb_model->getallpengajuanByAdam();
    } else if ($tab == 'term2') {
      echo $this->Stkb_model->getallterm2ByAdam();
    } else if ($tab == 'term3') {
      echo $this->Stkb_model->getallterm3ByAdam();
    } else if ($tab == 'menu1') {
      echo $this->Stkb_model->getallmenu1ByAdam();
    } else if ($tab == 'menu2') {
      echo $this->Stkb_model->getallmenu2ByAdam();
    } else if ($tab == 'menu3') {
      echo $this->Stkb_model->getallmenu3();
    }
  }

  public function readytopaid()
  {
	  $dbJay2 = $this->load->database('database_kedua', TRUE);

	  // Collect data prepare
	  $sourceAccountBank = $this->source_account_bank();
	  $maxTransfer = $this->max_transfer();
	  $dataStatusPembayaran = $this->post_input('statusbayar');
	  $arrayJabodetabek = ["jakarta", "bogor", "depok"];

	  $dataInsert = [];
	  $arrDataNotifikasiWaa = [];
	  $duplicateNumber = [];
	  $projectNotRegisterOnBudget = [];
	  foreach ($dataStatusPembayaran as $key => $status) {
		  // Collect data
		  $payload = $this->payload_rtp($status);

		  $isTerm1 = $payload['term'] == 1;
		  $kodePro = $payload["kodeproject"];
		  $pengajuan = $this->pengajuan_budget_project($kodePro);
		  $waktuBudget = $pengajuan["waktu"];
		  if ($waktuBudget == null) {
			  $projectNotRegisterOnBudget[] = $status;
			  continue;
		  }
		  $project = $this->project($kodePro);
		  $userPic = $this->user_pic($payload["idpic"]);
		  $idUser = $this->session->userdata('id_user');
		  $userCreator = $this->db->query("SELECT * FROM user WHERE noid = '$idUser'")->row_array();
		  $metodePembayaran = $this->metode_pembayaran($payload["total"], $maxTransfer);
		  $dataRekening = $this->dataRekening($payload["idpic"]);
		  $jadwalPembayaran = $this->transferSchedule($isTerm1);


		  // DATA OPS
		  $dataItemBudget = $this->data_item_budget($waktuBudget, 'STKB OPS');
		  $opsTerm = $this->max_term_bpu($waktuBudget, $dataItemBudget["no"]) + 1;
		  $jumlahops = $payload['jumlahops'] + $payload["perdin"] + $payload["bpjs"] + $payload["akomodasi"];

		  // DATA PAYLOAD BPU
		  $payloadBpu = $this->set_payload_bpu(
				  $dataItemBudget,
				  'STKB OPS',
				  $jumlahops,
				  $opsTerm,
				  $userPic,
				  $userCreator["name"],
				  $dataRekening,
				  $payload,
				  $waktuBudget,
				  $jadwalPembayaran,
				  $metodePembayaran);


		  // BPU OPS
		  $this->insert_data_bpu($payloadBpu);

		  $dataKota = $this->get_kotadinas_stkb($payload["nomorstkb"]);
		  // KOTA DINAS
		  if ($this->is_jabodetabek($dataKota["kotadinas"])) {
			  // Data Kota Dinas
			  $itemBudget = $this->data_item_budget($waktuBudget, 'STKB TRK Jakarta');
			  $dinasTerm = $this->max_term_bpu($waktuBudget, $itemBudget["no"]);

			  $payloadBpu["no"] = $itemBudget["no"];
			  $payloadBpu["statusbpu"] = "STKB TRK Jakarta";
			  $payloadBpu["term"] = $dinasTerm + 1;
			  $payloadBpu["jumlah"] = $payload["jumlahtrk"];
			  $payloadBpu["jumlahbayar"] = $payload["jumlahtrk"];

			  $this->insert_data_bpu($payloadBpu);

		  } else {
			  $itemBudget = $this->data_item_budget($waktuBudget, "STKB TRK Luar Kota");
			  $luarKotaTerm = $this->max_term_bpu($waktuBudget, $itemBudget["no"]);

			  $payloadBpu["no"] = $itemBudget["no"];
			  $payloadBpu["statusbpu"] = "STKB TRK Luar Kota";
			  $payloadBpu["term"] = $luarKotaTerm + 1;
			  $payloadBpu["jumlah"] = $payload["jumlahtrk"];
			  $payloadBpu["jumlahbayar"] = $payload["jumlahtrk"];

			  $this->insert_data_bpu($payloadBpu);
		  }

		  if ($metodePembayaran == "MRI PAL") {
			  $biayaTransfer = $this->setBiayaTransfer($dataRekening['kode_bank']);
			  $idBpu = $this->getLastDataNoidBpu();
			  $totalBiaya = $payload["total"] - $biayaTransfer;

			  $dataTransfer = $this->pushToMriTransfer($payload["nomorstkb"], $dataRekening['no'], $userPic["Nama"], $userPic['Email'], $dataRekening['nama_bank'], $dataRekening['kode_bank'], "", $totalBiaya, "", $userCreator['name'], "Sistem", $pengajuan['jenis'], $project['nama'], $idBpu, $sourceAccountBank, $jadwalPembayaran, $isTerm1);
			  if (!in_array($userPic['HP'], $duplicateNumber)) {
				  $duplicateNumber[] = $userPic['HP'];
				  $arrDataNotifikasiWaa[] = $this->setDataNotifWa($payload["nomorstkb"], $userPic, $dataTransfer, $dataRekening, $totalBiaya, $biayaTransfer, $project);
			  }
		  }

		  $dataInsert[] = $payload;

		  $nomorstkb = $payload["nomorstkb"];
		  $term = $payload["term"];

		  // FROM OLD
		  if ($term == 1) {
			  // CARI APAKAH NOMORSTKB INI MERUPAKAN ATM CENTER = 1 / NON ATM CENTER = 0
			  $cekatmbukan = $this->db->query("SELECT project FROM plan WHERE nomorstkb = '$nomorstkb' AND kunjungan IN ('064','065','066','067') GROUP BY nomorstkb,kunjungan")->num_rows();
			  // ==== //
			  // HITUNG JUMLAH BANK BERDASARKAN KODE BANK DI TABEL ATMCENTER/CABANG DALAM SATU STKB
			  if ($cekatmbukan >= 1) {
				  $totalbankstkb = $this->db->query("SELECT a.project FROM plan a JOIN atmcenter z ON a.project = z.project WHERE a.kode = z.cabang AND a.nomorstkb = '$nomorstkb' GROUP BY z.kodebank")->num_rows();
			  } else {
				  $totalbankstkb = $this->db->query("SELECT a.project FROM plan a JOIN cabang y ON a.project = y.project WHERE a.kode = y.kode AND a.nomorstkb = '$nomorstkb' GROUP BY y.kodebank")->num_rows();
			  }
			  // ==== //
			  $data['printtrk'] = $this->Stkb_model->getprinttrk($nomorstkb, $cekatmbukan);
			  foreach ($data['printtrk'] as $project) {
				  if ($totalbankstkb > 1) {
					  $kodebank = $project['kodebank'];
				  } else {
					  if ($project['tabelnya'] == 'cabang') {
						  $cek = $this->db->query("SELECT y.kodebank AS kodebank FROM plan a JOIN cabang y ON a.project = y.project WHERE a.kode = y.kode AND a.nomorstkb = '$nomorstkb' AND y.kodebank = y.kodebank GROUP BY y.kodebank")->row_array();
					  } else {
						  $cek = $this->db->query("SELECT z.kodebank AS kodebank FROM plan a JOIN atmcenter z ON a.project = z.project WHERE a.kode = z.cabang AND a.nomorstkb = '$nomorstkb' AND z.kodebank = z.kodebank GROUP BY z.kodebank")->row_array();
					  }

					  if ($cek['kodebank'] == NULL) {
						  $kode = $this->db->query("SELECT bank FROM project WHERE kode = '$project[kodeproject]'")->row_array();
						  $kodebank = $kode['bank'];
					  } else {
						  $kodebank = $cek['kodebank'];
					  }
				  }
				  $dataProject = array(
					  'nostkb' => $project['nomorstkb'],
					  'kodeproject' => $project['kodeproject'],
					  'kodebank' => $kodebank,
					  'skenario' => $project['skenario'],
					  'jumlah' => $project['jumlah'],
					  'kunjungan' => $project['kunjungan'],
					  'harga' => $project['harga']
				  );
				  $this->db->insert('stkb1project_final', $dataProject);
			  }
		  }
	  }

	  $this->send_message_transfer($arrDataNotifikasiWaa);

	  $dbJay2->insert_batch('stkb_pembayaran', $dataInsert);
	  if (count($projectNotRegisterOnBudget) > 0) {
		  $message = "";
		  if (count($projectNotRegisterOnBudget) < count($dataStatusPembayaran)) {
			  $message .= "STKB Berhasil Pindah Ke RTP\n Dan untuk Nomor STKB ";
			  foreach ($projectNotRegisterOnBudget as $key => $value) {
				  $message .= $value . ", ";
			  }
			  $message .= " tidak dapat diproses dikarenakan data project tidak ditemukan di Budget Online";
		  } else {
			  $message .= "STKB Gagal dipindahkan Ke RTP\n Untuk Nomor STKB ";
			  foreach ($projectNotRegisterOnBudget as $key => $value) {
				  $message .= $value . ", ";
			  }
			  $message .= " tidak dapat diproses dikarenakan data project tidak ditemukan di Budget Online";
		  }

		  $this->session->set_flashdata('flash', $message);
	  } else {
		  $this->session->set_flashdata('flash', 'STKB Berhasil Pindah Ke RTP');
	  }
	  redirect("stkb/pengajuan");
  }

  private function is_jabodetabek($kota)
  {
	  $arrayJabodetabek = ["jakarta", "bogor", "depok"];
	  return in_array(strtolower($kota), $arrayJabodetabek);
  }

  private function get_kotadinas_stkb($nomorStkb)
  {
	  $dbJay2 = $this->load->database('database_kedua', TRUE);
	  return $dbJay2->query("SELECT kotadinas FROM stkb_ops WHERE nomorstkb='$nomorStkb'")->row_array();
  }

  private function source_account_bank()
  {
	  $dbDevelop = $this->load->database('db_develop', TRUE);
	  $queryDbKas = $dbDevelop->query("SELECT rekening FROM kas WHERE label_kas = 'Kas Project'")->row_array();

	  return $queryDbKas['rekening'] == null ? 0 : $queryDbKas['rekening'];
  }

  private function max_transfer()
  {
	  $dbMri = $this->load->database('db_mritransfer', TRUE);
	  $jenisPembayaran = $dbMri->query("SELECT max_transfer FROM jenis_pembayaran WHERE jenispembayaran = 'STKB'")->row_array();
	  return $jenisPembayaran['max_transfer'] == null ? 0 : $jenisPembayaran['max_transfer'];
  }

  private function post_input($key)
  {
	  return $this->input->post($key);
  }

  private function payload_rtp($status)
  {
	  return [
		  'nomorstkb' => $this->post_input("nomorstkb$status"),
		  "term" => $this->rtpGetStatusTerm($this->post_input("term$status")),
		  "tanggalbuat" => $this->post_input("tanggalbuat$status"),
		  "kodeproject" => $this->post_input("kodeproject$status"),
		  "idpic" => $this->post_input("idpic$status"),
		  "perdin" => $this->post_input("perdin$status"),
		  "akomodasi" => $this->post_input("akomodasi$status"),
		  "bpjs" => $this->post_input("bpjs$status"),
		  "jumlahops" => $this->post_input("jumlahops$status"),
		  "jumlahtrk" => $this->post_input("jumlahtrk$status"),
		  "total" => $this->post_input("total$status"),
		  "statusbayar" => "RTP",
	  ];
  }

  private function pengajuan_budget_project($kodepro)
  {
	  $dbBudget = $this->load->database('database_ketiga', TRUE);
	  $caribudget = $dbBudget->query("SELECT * FROM pengajuan WHERE kodeproject='$kodepro'")->row_array();
	  return $caribudget;
  }

  public function project($kodepro)
  {
	  return $this->db->query("SELECT * FROM project WHERE kode='$kodepro'")->row_array();
  }

  public function user_pic($idPic)
  {
	  return $this->db->query("SELECT * FROM id_data WHERE id='$idPic'")->row_array();
  }

  public function data_item_budget($waktuBudget, $status)
  {
	  $dbBudget = $this->load->database('database_ketiga', TRUE);
	  $itemBudget = $dbBudget->query("SELECT * FROM selesai WHERE status='$status' AND waktu='$waktuBudget'")->row_array();
	  return $itemBudget;
  }

  private function max_term_bpu($waktubudget, $noItemBudget)
  {
	  $dbBudget = $this->load->database('database_ketiga', TRUE);
	  $maxTerm = $dbBudget->query("SELECT max(term) AS maxt FROM bpu WHERE waktu='$waktubudget' AND no='$noItemBudget'")->row_array();
	  return $maxTerm['maxt'] == null ? 0 : $maxTerm['maxt'];
  }

  private function metode_pembayaran($jumlah, $maxTransfer)
  {
	  if ($jumlah > $maxTransfer || $jumlah < 0) return "MRI KAS";
	  return "MRI PAL";
  }

  public function insert_data_bpu($payload)
  {
	  $dbBudget = $this->load->database('database_ketiga', TRUE);
	  $dbBudget->insert('bpu', $payload);
  }

  public function set_payload_bpu($itemBpu, $statusBpu, $jumlah, $termBpu, $user, $creator, $dataRekening, $dataStkb, $waktuBudget, $jadwalPembayaran, $metodePembayaran)
  {
	  return [
		  "no" => $itemBpu["no"],
		  "statusbpu" => $statusBpu,
		  "jumlah" => $jumlah,
		  "tglcair" => '0000-00-00',
		  "namabank" => $dataRekening['kode_bank'],
		  "norek" => $dataRekening['no'],
		  "namapenerima" => $user['Nama'],
		  "emailpenerima" => $user['Email'],
		  "pengaju" => $creator,
		  "divisi" => $user["Posisi"],
		  "waktu" => $waktuBudget,
		  "status" => 'Belum Di Bayar',
		  "persetujuan" => 'Disetujui (Direksi)',
		  "jumlahbayar" => $jumlah,
		  "novoucher" => '',
		  "tanggalbayar" => $jadwalPembayaran,
		  "pembayar" => $creator,
		  "divpemb" => 'Finance',
		  "term" => $termBpu,
		  "nomorstkb" => $dataStkb["nomorstkb"],
		  "termstkb" => $dataStkb["term"],
		  "metode_pembayaran" => $metodePembayaran,
		  "bank_account_name" => $dataRekening['NamaRek'],
	  ];
  }

	private function rtpGetStatusTerm($term)
	{
		switch ($term) {
			case 'Term 1':
				return 1;
				break;
			case 'Term 2':
				return 2;
				break;
			case 'Term 3':
				return 3;
				break;
			
			default:
			return 1;
				break;
		}
	}

	private function setDataNotifWa($payload, $user, $dataTransfer, $dataRekening, $jumlah, $biayaAdmin, $project)
	{
		return [
			"nomor_stkb" => $payload["nomorstkb"],
			"penerima" => $user['Nama'],
			"msisdn" => $user['HP'],
			"jenis_pembayaran" => "STKB",
			"pemilik_rekening" => $user['Nama'],
			"nomor_rekening" => $dataRekening['no'],
			"bank" => $dataRekening['nama_bank'],
			"jumlah_sebelumnya" => $payload['total'],
			"jumlah" => $jumlah,
			"biaya_trf" => $biayaAdmin,
			"jadwal_transfer" => $dataTransfer['jadwal_transfer'],
			"project" => $project['nama'],
			"nomor_stkb" => $payload["term"]
		];
	}

	/***
	 * 
	 */
	private function getLastDataNoidBpu() 
	{
		$dbBudget = $this->load->database('database_ketiga', TRUE);
		$data = $dbBudget->select('noid')->order_by('noid',"desc")->limit(1)->get('bpu')->row();

		return $data->noid;
	}

	/***
	 * @param $idPic
	 * @return mixed
	 */
  private function dataRekening($idPic)
  {
		$query = "SELECT b.nama as nama_bank, d.NoRek as no, b.swift_code as kode_bank FROM datarekening d JOIN bank b ON d.CodeBank = b.kode WHERE d.Id = '$idPic'";
	  $rek = $this->db->query($query)->row_array();
	  return $rek;
  }

	/***
	 * 
	 */
	private function lastRequestTransferId()
	{
		$date = date('my');
		$dbBridge = $this->load->database('db_bridge', TRUE);
		$data = $dbBridge->select('transfer_req_id')->where('transfer_req_id LIKE', $date."%")->order_by('transfer_req_id',"desc")->limit(1)->get('data_transfer')->row();
    $lastId = (int)substr($data->transfer_req_id, -4);

		$formatId = $date . sprintf('%04d', $lastId + 1);
		return $formatId;
	}

	/***
	 * 
	 */
	private function transferSchedule($isTerm1 = false)
	{
		date_default_timezone_set('Asia/Jakarta');
		$dateNow = date("Y-m-d");
		$dateSchedule = $dateNow;
		$increaseDayString = "+0 day";
		$timestamp = strtotime($dateNow);
		$numberOfTheDay = date('w', $timestamp);
		
		if (!$isTerm1) {
			$increaseDayString = "+" . 5 - $numberOfTheDay ." day";
		} else {
			$increaseDayString = "+1 day";
		}

		$increaseDay = strtotime($increaseDayString, strtotime($dateNow));
		$dateSchedule = date("Y-m-d", $increaseDay);
    	$time = mt_rand(8,12).":".str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);


		return $dateSchedule . " " . $time . ":00";
	}

	private function correct_bank_account_number($string)
	{
		$param = [".", "-"];

		$newNorek = $string;
		foreach ($param as $key => $value) {
			$split = explode($value, $newNorek);
			$newNorek = implode("", $split);
		}

		return $newNorek;
	}

	/***
	 * @param $nomorstkb
	 * @param $norek
	 * @param $pemilikRekening
	 * @param string $emailPemilikRekening
	 * @param $bank
	 * @param $kodeBank
	 * @param string $beritaTrasnfer
	 * @param $jumlah
	 * @param $ketTransfer
	 * @param $creator
	 * @param string $otorisasi
	 * @param $statusBpu
	 * @param string $nmProject
	 * @param $noIdBpu
	 * @param string $rekeningSumber
	 * @param $transferSchedule
	 * @param bool $isTerm1
	 * @return mixed
	 */
  private function pushToMriTransfer($nomorstkb, $norek, $pemilikRekening, $emailPemilikRekening = "", $bank, $kodeBank, $beritaTrasnfer = "", $jumlah, $ketTransfer, $creator, $otorisasi = "Sistem", $statusBpu, $nmProject = "", $noIdBpu, $rekeningSumber = "", $transferSchedule, $isTerm1 = false)
  {
	  $dbBridge = $this->load->database('db_bridge', TRUE);
	  $trasnferRequestId = $this->lastRequestTransferId();
	  $biayaTrf = $this->setBiayaTransfer($kodeBank);
	  $timeNow = date('Y-m-d H:i:s');

	  $norek = $this->correct_bank_account_number($norek);

	  $dataInsert = [
		  "transfer_req_id" => $trasnferRequestId,
		  "transfer_type" => 3,
		  "jenis_pembayaran_id" => 9,
		  "keterangan" => "STKB",
		  "norek" => $norek,
		  "pemilik_rekening" => $pemilikRekening,
		  "email_pemilik_rekening" => $emailPemilikRekening,
		  "bank" => $bank,
		  "kode_bank" => $kodeBank,
		  "berita_transfer" => $beritaTrasnfer,
		  "jumlah" => $jumlah,
		  "ket_transfer" => "Antri",
		  "nm_pembuat" => $creator,
		  "nm_otorisasi" => $otorisasi,
		  "jenis_project" => $statusBpu,
		  "nm_project" => $nmProject,
		  "noid_bpu" => $noIdBpu,
		  "rekening_sumber" => $rekeningSumber,
		  "waktu_request" => $timeNow,
		  "jadwal_transfer" => $transferSchedule,
		  "biaya_trf" => $biayaTrf,
		  "terotorisasi" => 2,
		  "hasil_transfer" => 1,
		  "nm_validasi" => "Sistem",
		  "nomor_stkb" => $nomorstkb,
		  "url_callback" => base_url('api/transfer/stkb/callback')
	  ];
	  $data = $dbBridge->select('*')->where('nomor_stkb', $nomorstkb)->where('norek', $norek)->where('pemilik_rekening', $pemilikRekening)->limit(1)->get('data_transfer')->row();

	  if ($data != null) {
		  $dataInsert['jumlah'] = $dataInsert['jumlah'] + $data->jumlah;
		  $dbBridge->where('nomor_stkb', $nomorstkb)->where('norek', $norek)->where('pemilik_rekening', $pemilikRekening);
		  log_message("info", "DATA UPDATE MRI TRANSFER ". json_encode($dataInsert));
	      $isSuccess = $dbBridge->update('data_transfer', ["jumlah" => $dataInsert['jumlah']]);
	  } else {
		  log_message("info", "DATA CREATE MRI TRANSFER ". json_encode($dataInsert));
	  	  $isSuccess = $dbBridge->insert('data_transfer', $dataInsert);
	  }

	  return $dataInsert;
  }

	private function setBiayaTransfer($kodeBank = 'CENAIDJA') 
	{
		$biayaTransfer = 0;
		if ($kodeBank != "CENAIDJA") {
			$biayaTransfer = 2900;
		}
		return $biayaTransfer;
	}

  public function bayarstkb()
  {
    $this->Stkb_model->prosesbayarstkb();
    $this->session->set_flashdata('flash', 'STKB Berhasil Dibayar');
    redirect("stkb/pengajuan");
  }
  /****** //Controller STKB Pengajuan ******/
  public function printstkb($nomorstkb, $term)
  {
    ini_set('max_execution_time', '0');
    $data['judul'] = "STKB || Print STKB";
    $kp = $this->db->query("SELECT project FROM stkb_ops WHERE nomorstkb = '$nomorstkb'")->row_array();
    $cekBayar = $this->db->query("SELECT tanggalbayar FROM stkb_pembayaran WHERE nomorstkb ='$nomorstkb' AND term ='1'")->result_array();
    // CARI APAKAH NOMORSTKB INI MERUPAKAN ATM CENTER = 1 / NON ATM CENTER = 0
    $data['cekatmbukan'] = $this->db->query("SELECT project FROM plan WHERE nomorstkb = '$nomorstkb' AND kunjungan IN ('064','065','066','067') GROUP BY nomorstkb,kunjungan")->num_rows();
    // ==== //
    // HITUNG JUMLAH BANK BERDASARKAN KODE BANK DI TABEL ATMCENTER/CABANG DALAM SATU STKB
    if ($data['cekatmbukan'] >= 1) {
      $data['totalbankstkb'] = $this->db->query("SELECT a.project FROM plan a JOIN atmcenter z ON a.project = z.project WHERE a.kode = z.cabang AND a.nomorstkb = '$nomorstkb' GROUP BY z.kodebank")->num_rows();
    } else {
      $data['totalbankstkb'] = $this->db->query("SELECT a.project FROM plan a JOIN cabang y ON a.project = y.project WHERE a.kode = y.kode AND a.nomorstkb = '$nomorstkb' GROUP BY y.kodebank")->num_rows();
    }
    // ==== //
    if (count($cekBayar) > 0) {
      $cek = $this->Stkb_model->getprinttrk_final($nomorstkb, $data['cekatmbukan']);
      if (count($cek) > 0) {
        $data['printtrk'] = $cek;
        $data['printtrk'] = $this->Stkb_model->triggerGetPrintTRK($data['printtrk']);
      } else {
        // INSERT KE 1 PROJECT FINAL DARI DATA 1 PROJECT LAMA JIKA DATA STKB BELUM ADA DI 1 PROJECT FINAL
        $data['printtrk'] = $this->Stkb_model->getprinttrk($nomorstkb, $data['cekatmbukan']);
        foreach ($data['printtrk'] as $project) {
          if ($data['totalbankstkb'] > 1) {
            $kodebank = $project['kodebank'];
          } else {
            if ($project['tabelnya'] == 'cabang') {
              $cek = $this->db->query("SELECT y.kodebank AS kodebank FROM plan a JOIN cabang y ON a.project = y.project WHERE a.kode = y.kode AND a.nomorstkb = '$nomorstkb' AND y.kodebank = y.kodebank GROUP BY y.kodebank")->row_array();
            } else {
              $cek = $this->db->query("SELECT z.kodebank AS kodebank FROM plan a JOIN atmcenter z ON a.project = z.project WHERE a.kode = z.cabang AND a.nomorstkb = '$nomorstkb' AND z.kodebank = z.kodebank GROUP BY z.kodebank")->row_array();
            }

            if ($cek['kodebank'] == NULL) {
              $kode = $this->db->query("SELECT bank FROM project WHERE kode = '$project[kodeproject]'")->row_array();
              $kodebank = $kode['bank'];
            } else {
              $kodebank = $cek['kodebank'];
            }
          }
          $dataProject = array(
            'nostkb' => $project['nomorstkb'],
            'kodeproject' => $project['kodeproject'],
            'kodebank' => $kodebank,
            'skenario' => $project['skenario'],
            'jumlah' => $project['jumlah'],
            'kunjungan' => $project['kunjungan'],
            'harga' => $project['harga']
          );
          $this->db->insert('stkb1project_final', $dataProject);
          $dataProject = array();
        }

        $data['printtrk'] = $this->Stkb_model->triggerGetPrintTRK($data['printtrk']);
      }

      $this->Stkb_model->updateoneprojectfinal_tostkb($kp['project']); // TRIGGER UNTUK UPDATE 1 PROJECT FINAL KE STKB_TRK SESUAI KODE PROJEK     
      $data['rtpStatus'] = true; // READY TO PAID STATUS
    } else {
      $this->Stkb_model->updateoneprojecttostkb($kp['project']); // TRIGGER UNTUK UPDATE 1 PROJECT KE STKB_TRK SESUAI KODE PROJEK
      $data['printtrk'] = $this->Stkb_model->getprinttrk($nomorstkb, $data['cekatmbukan']);
      $data['printtrk'] = $this->Stkb_model->triggerGetPrintTRK($data['printtrk']);

      $data['rtpStatus'] = false; // READY TO PAID STATUS
    }

    // $data['kuotaq1'] = $this->db->query("SELECT a.kunjungan, count(*) as jumlah from plan a join cabang b on a.kode=b.kode where a.nomorstkb='$nomorstkb'
    // AND a.kunjungan='001' group by a.kunjungan, b.kodebank")->result();
    $data['plan'] = $this->Stkb_model->getAhFo($nomorstkb);
    if ($data['plan']) {
      $data['allprint'] = $this->Stkb_model->getallprintfield($nomorstkb, $term);
    } else {
      $data['allprint'] = $this->Stkb_model->getallprint($nomorstkb, $term);
    }

    $data['opstrk'] = $this->Stkb_model->getopstrk($nomorstkb, $term);
    $data['sldendapnya'] = $this->Stkb_model->getsaldoendap($nomorstkb, $term);
    $data['novouc1'] = $this->Stkb_model->getvoucher1($nomorstkb, $term);
    $data['novouc2'] = $this->Stkb_model->getvoucher2($nomorstkb, $term);
    $data['novouc3'] = $this->Stkb_model->getvoucher3($nomorstkb, $term);
    $data['allbackup'] = $this->Stkb_model->getbackup($nomorstkb, $term);

    if ($data['plan']) {
      $data['isRtp'] = $this->db->query("SELECT * FROM stkb_pembayaran WHERE nomorstkb = '$nomorstkb'")->num_rows();
      // var_dump($data['allprint']);
      // die;
      $this->load->view('templates/header', $data);
      $this->load->view('stkb/print/index_2021', $data);
      $this->load->view('templates/footer');
    } else {
      $this->load->view('templates/header', $data);
      $this->load->view('stkb/print/index', $data);
      $this->load->view('templates/footer');
    }
  }

  function printstkb2($nomorstkb, $term)
  {
    $data['judul'] = "STKB || Print STKB";
    $kp = $this->db->query("SELECT project FROM stkb_ops WHERE nomorstkb = '$nomorstkb'")->row_array();
    $cekBayar = $this->db->query("SELECT tanggalbayar FROM stkb_pembayaran WHERE nomorstkb ='$nomorstkb' AND term ='1'")->result_array();
    // CARI APAKAH NOMORSTKB INI MERUPAKAN ATM CENTER = 1 / NON ATM CENTER = 0
    $data['cekatmbukan'] = $this->db->query("SELECT project FROM plan WHERE nomorstkb = '$nomorstkb' AND kunjungan IN ('064','065','066','067') GROUP BY nomorstkb,kunjungan")->num_rows();
    // ==== //
    // HITUNG JUMLAH BANK BERDASARKAN KODE BANK DI TABEL ATMCENTER/CABANG DALAM SATU STKB
    if ($data['cekatmbukan'] >= 1) {
      $data['totalbankstkb'] = $this->db->query("SELECT a.project FROM plan a JOIN atmcenter z ON a.project = z.project WHERE a.kode = z.cabang AND a.nomorstkb = '$nomorstkb' GROUP BY z.kodebank")->num_rows();
    } else {
      $data['totalbankstkb'] = $this->db->query("SELECT a.project FROM plan a JOIN cabang y ON a.project = y.project WHERE a.kode = y.kode AND a.nomorstkb = '$nomorstkb' GROUP BY y.kodebank")->num_rows();
    }
    // ==== //

    $data['printtrk'] = $this->Stkb_model->getprinttrk($nomorstkb, $data['cekatmbukan']);
    $data['printtrk'] = $this->Stkb_model->triggerGetPrintTRK($data['printtrk']);

    $dealers = array(
      array(
        "kodeproject" => "SB1",
        "skenario" => "9",
        "jumlah" => "1",
        "kunjungan" => "104",
        "namabank" => "2 Bank OCBC NISP",
        "kodebank" => "028",
        "harga" => "250000",
        "namanya" => "Saldo Endap",
        "attnya" => "Backup",
        "kodeatr" => "104",
        "kuotabank" => 2,
        "banyaknya" => "1"
      ),
      array(
        "kodeproject" => "SB1",
        "skenario" => "9",
        "jumlah" => "1",
        "kunjungan" => "104",
        "namabank" => "1 Bank Mandiri",
        "kodebank" => "008",
        "harga" => "500000",
        "namanya" => "Saldo Endap",
        "attnya" => "Backup",
        "kodeatr" => "104",
        "kuotabank" => 1,
        "banyaknya" => "1"
      )
    );


    //     $dealersMin = min(array_column($dealers, 'harga'));
    //
    // $dealersWithMinCount = array_filter($dealers, function ($dealer) {
    //     global $dealersMin;
    //     return ($dealer['harga'] == $dealersMin);
    // });
    // var_dump($dealersMin); die;
    // var_dump($dealersWithMinCount[array_rand($dealersWithMinCount)]['nomorstkb']);
    // die;

    function multi_array_search_trigger($array, $search)
    {
      $result = array();
      foreach ($array as $key => $value) {
        foreach ($search as $k => $v) {
          if (!isset($value[$k]) || $value[$k] != $v) {
            continue 2;
          }
        }
        $result[] = $key;
      }
      return $result;
    }
    function multi_array_search($array, $search)
    {
      $result = array();
      $bank = [];
      $kodebank = [];
      $kuota = 0;
      foreach ($array as $key => $value) {
        foreach ($search as $k => $v) {
          if (!isset($value[$k]) || $value[$k] != $v) {
            continue 2;
          }
        }
        $result[] = $key;
        $kuota += $value['kuotabank'];
        $bank[] = $value['kuotabank'] . ' ' . $value['namabank'];
        $kodebank[] = $value['kodebank'];
        $kodeproject = $value['kodeproject'];
        $skenario = $value['skenario'];
        $jumlah = $value['jumlah'];
        $kunjungan = $value['kunjungan'];
        $harga = $value['harga'];
        $namanya = $value['namanya'];
        $attnya = $value['attnya'];
        $kodeatr = $value['kodeatr'];
        $banyaknya = $value['banyaknya'];
      }
      if ($kodeatr == '104') {
        $bank = 'ALL BANK';
        $kodebank = '-';
      } else {
        $bank = implode($bank, ', ');
        $kodebank = implode($kodebank, ',');
      }
      $new = array(
        "kodeproject" => $kodeproject,
        "skenario" => $skenario,
        "jumlah" => $jumlah,
        "kunjungan" => $kunjungan,
        "namabank" => $bank,
        "kodebank" => $kodebank,
        "harga" => $harga,
        "namanya" => $namanya,
        "attnya" => $attnya,
        "kodeatr" => $kodeatr,
        "kuotabank" => $kuota,
        "banyaknya" => $banyaknya
      );
      return $new;
    }

    // echo json_encode($data['printtrk']); die;
    $newArrayBackup = [];
    foreach ($data['printtrk'] as $value) {
      if ($value['kodeatr'] == '104') {
        $newArrayBackup[$value['skenario']][] = multi_array_search($data['printtrk'], array('skenario' => $value['skenario'], 'kodeatr' => '104', 'harga' => $value['harga']));
      }
    }
    $newArray = [];
    foreach ($data['printtrk'] as $value) {
      if ($value['kodeatr'] == '104') {
        $cek = multi_array_search_trigger($newArray, array('skenario' => $value['skenario'], 'kodeatr' => '104'));
        if (count($cek) == 0) {
          $hargaTerkecil = min(array_column($newArrayBackup[$value['skenario']], 'harga'));
          $newArray[] = multi_array_search($data['printtrk'], array('skenario' => $value['skenario'], 'kodeatr' => '104', 'harga' => $hargaTerkecil));
        }
      } else {
        $cek = multi_array_search_trigger($newArray, array('skenario' => $value['skenario'], 'kodeatr' => $value['kodeatr'], 'harga' => $value['harga']));
        if (count($cek) == 0) {
          $newArray[] = multi_array_search($data['printtrk'], array('skenario' => $value['skenario'], 'kodeatr' => $value['kodeatr'], 'harga' => $value['harga']));
        }
      }
    }

    // $cek = multi_array_search($data['printtrk'], array('skenario' => '9', 'kodeatr' => '104'));
    echo json_encode($newArray);
  }

  public function printstkbLAMA($nomorstkb, $term)
  {
    $data['judul'] = "STKB || Print STKB";
    $kp = $this->db->query("SELECT project FROM stkb_ops WHERE nomorstkb = '$nomorstkb'")->row_array();
    $cekBayar = $this->db->query("SELECT tanggalbayar FROM stkb_pembayaran WHERE nomorstkb ='$nomorstkb' AND term ='1'")->result_array();

    if (count($cekBayar) > 0) {

      $cek = $this->Stkb_model->getprinttrk_final($nomorstkb, $term);
      if (count($cek) > 0) {
        $data['printtrk'] = $cek;
      } else {
        // INSERT KE 1 PROJECT FINAL DARI DATA 1 PROJECT LAMA JIKA DATA STKB BELUM ADA DI 1 PROJECT FINAL
        $getOneProject = $this->db->query("SELECT * FROM stkb1project WHERE kodeproject = '$kp[project]'")->result_array();
        $kode = $this->db->query("SELECT bank FROM project WHERE kode = '$kp[project]'")->row_array();
        foreach ($getOneProject as $project) {
          $jml = $this->db->query("SELECT harga FROM stkb_dasar_trk WHERE kodebank = '$kode[bank]' AND kodeskenario = '$project[skenario]'")->row_array();
          $dataProject = array(
            'nostkb' => $nomorstkb,
            'kodeproject' => $project['kodeproject'],
            'skenario' => $project['skenario'],
            'jumlah' => $project['jumlah'],
            'kunjungan' => $project['kunjungan'],
            'harga' => $jml['harga']
          );
          $this->db->insert('stkb1project_final', $dataProject);
          $dataProject = array();
        }
        $data['printtrk'] = $this->Stkb_model->getprinttrk_final($nomorstkb, $term);
      }

      $data['rtpStatus'] = true; // READY TO PAID STATUS
    } else {
      $this->Stkb_model->updateoneprojecttostkb($kp['project']); // TRIGGER UNTUK UPDATE 1 PROJECT KE STKB_TRK SESUAI KODE PROJEK
      $data['printtrk'] = $this->Stkb_model->getprinttrk($nomorstkb, $term);
      $data['rtpStatus'] = false; // READY TO PAID STATUS
    }

    $data['allprint'] = $this->Stkb_model->getallprint($nomorstkb, $term);
    //var_dump($data['allprint']);
    //die;

    $data['opstrk'] = $this->Stkb_model->getopstrk($nomorstkb, $term);
    $data['sldendapnya'] = $this->Stkb_model->getsaldoendap($nomorstkb, $term);
    $data['novouc1'] = $this->Stkb_model->getvoucher1($nomorstkb, $term);
    $data['novouc2'] = $this->Stkb_model->getvoucher2($nomorstkb, $term);
    $data['novouc3'] = $this->Stkb_model->getvoucher3($nomorstkb, $term);
    $data['allbackup'] = $this->Stkb_model->getbackup($nomorstkb, $term);
    $this->load->view('templates/header', $data);
    $this->load->view('stkb/print/index', $data);
    $this->load->view('templates/footer');
  }

  public function updateallstkbops()
  {
    $datanya = $this->Stkb_model->updatestkbops();
    $this->Stkb_model->mulaiupdatenya($datanya);
    $this->session->set_flashdata('flash', 'STKB OPS Berhasil Di Update');
    redirect("stkb/operational");
  }

  public function updateallstkbtrk()
  {
    $datanya = $this->Stkb_model->updatestkbtrk();
    $this->Stkb_model->mulaiupdatetrk($datanya);
    $this->session->set_flashdata('flash', 'STKB TRK Berhasil Di Update');
    redirect("stkb/transaksi");
  }

  public function preview2p()
  {
    $data['cek_kode'] = $this->input->post('project');
    $data['judul'] = "Preview 2P/2PR";
    $data['projectnya'] = $this->Stkb_model->getallproject();
    $data['allpreview'] = $this->Stkb_model->getallpreview();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/preview2p', $data);
    $this->load->view('templates/footer');
  }

  public function editkotakabupaten()
  {
    $this->Stkb_model->editkotakabnya();
    $this->session->set_flashdata('flash', 'Edit Kota Kabupaten Berhasil');
    redirect("stkb/kotakab");
  }

  public function tambahkotakab()
  {
    $this->Stkb_model->tambahkotakabnya();
    $this->session->set_flashdata('flash', 'Tambah Kota Kabupaten Berhasil');
    redirect("stkb/kotakab");
  }

  public function detailstkbnya()
  {
    $nomorstkb = $_POST['nomor'];
    // KODINGAN LAMA
    // $data['detailnya'] = $this->db->query("SELECT
    //                                         	a.project AS project,
    //                                         	a.att AS kodekunjungan,
    //                                         	b.kode AS kodecabang,
    //                                         	b.kareg AS idpic,
    //                                           b.nomorstkb AS nomornya,
    //                                         	c.nama AS namakunjungan,
    //                                         	d.nama AS namacabang,
    //                                         	i.cabang AS namacabang,
    //                                         	e.status AS statusquest,
    //                                           i.shp_weekend_siang, i.weekend_siang, i.status_weekend_siang,
    //                                           i.shp_weekend_malam, i.weekend_malam, i.status_weekend_malam,
    //                                           i.shp_weekday_siang, i.weekday_siang, i.status_weekday_siang,
    //                                           i.shp_weekday_malam, i.weekday_malam, i.status_weekday_malam,
    //                                         	e.shp AS idshopper,
    //                                         	e.pwt AS idpwt,
    //                                         	f.nama AS namashp,
    //                                         	g.nama AS namapwt,
    //                                         	h.nama AS namapic
    //                                         FROM
    //                                         	skenario a
    //                                         LEFT JOIN plan b ON a.project = b.project AND a.kategori = b.kunjungan
    //
    //                                         JOIN attribute c ON a.att = c.kode AND c.kunjungan_q = 1
    //
    //                                         LEFT JOIN cabang d ON b.kode = d.kode
    //                                         AND b.project = d.project
    //                                         LEFT JOIN quest e ON b.project = e.project
    //                                         AND b.kode = e.cabang
    //                                         AND a.att = e.kunjungan
    //
    //                                         LEFT JOIN atmcenter i ON b.project = i.project AND b.kode = i.cabang
    //                                         LEFT JOIN id_data f ON e.shp = f.Id
    //                                         LEFT JOIN id_data g ON e.pwt = g.Id
    //                                         LEFT JOIN id_data h ON b.kareg = h.Id
    //                                         WHERE
    //                                         	b.nomorstkb = '$nomorstkb'
    //                                         ORDER BY
    //                                         	kodecabang ASC")->result_array();

    $cekatmbukan = $this->db->query("SELECT project FROM plan WHERE nomorstkb = '$nomorstkb' AND kunjungan IN ('064','065','066','067') GROUP BY nomorstkb,kunjungan")->num_rows();
    if ($cekatmbukan >= 1) {
      $data['detailnya'] = $this->db->query("SELECT
                                              	a.project AS project,
                                              	a.att AS kodekunjungan,
                                              	b.kode AS kodecabang,
                                              	b.kareg AS idpic,
                                                b.nomorstkb AS nomornya,
                                              	c.nama AS namakunjungan,
                                              	i.cabang AS namacabang,
                                                CASE
                                                  WHEN i.status_weekend_siang IS NOT NULL THEN i.status_weekend_siang
                                                  WHEN i.status_weekend_malam IS NOT NULL THEN i.status_weekend_malam
                                                  WHEN i.status_weekday_siang IS NOT NULL THEN i.status_weekday_siang
                                                  WHEN i.status_weekday_malam IS NOT NULL THEN i.status_weekday_malam
                                                  ELSE
                                                    (SELECT status FROM quest WHERE project = b.project AND cabang = b.kode AND kunjungan = a.att)
                                              	END AS statusquest,
                                                i.shp_weekend_siang, i.weekend_siang, i.status_weekend_siang,
                                                i.shp_weekend_malam, i.weekend_malam, i.status_weekend_malam,
                                                i.shp_weekday_siang, i.weekday_siang, i.status_weekday_siang,
                                                i.shp_weekday_malam, i.weekday_malam, i.status_weekday_malam,
                                              	f.Id AS idshopper,
                                              	'' AS idpwt, '' AS namapwt,
                                              	f.nama AS namashp,
                                              	h.nama AS namapic
                                              FROM
                                              	skenario a
                                              LEFT JOIN plan b ON a.project = b.project AND a.kategori = b.kunjungan

                                              JOIN attribute c ON a.att = c.kode AND c.kunjungan_q = 1

                                              -- LEFT JOIN quest e ON b.project = e.project
                                              -- AND b.kode = e.cabang
                                              -- AND a.att = e.kunjungan

                                              LEFT JOIN atmcenter i ON b.project = i.project AND b.kode = i.cabang
                                              LEFT JOIN id_data f ON i.shp_weekend_siang = f.Id OR i.shp_weekend_malam = f.Id OR i.shp_weekday_siang = f.Id OR i.shp_weekday_malam = f.Id
                                              LEFT JOIN id_data h ON b.kareg = h.Id
                                              WHERE
                                              	b.nomorstkb = '$nomorstkb'
                                              ORDER BY
                                              	kodecabang ASC")->result_array();
    } else {
      $data['detailnya'] = $this->db->query("SELECT
                                              	a.project AS project,
                                              	a.att AS kodekunjungan,
                                              	b.kode AS kodecabang,
                                              	b.kareg AS idpic,
                                                b.nomorstkb AS nomornya,
                                              	c.nama AS namakunjungan,
                                              	d.nama AS namacabang,
                                              	e.status AS statusquest,
                                              	e.shp AS idshopper,
                                              	e.pwt AS idpwt,
                                              	f.nama AS namashp,
                                              	g.nama AS namapwt,
                                              	h.nama AS namapic
                                              FROM
                                              	skenario a
                                              LEFT JOIN plan b ON a.project = b.project AND a.kategori = b.kunjungan
                                              JOIN attribute c ON a.att = c.kode AND c.kunjungan_q = 1
                                              LEFT JOIN cabang d ON b.kode = d.kode AND b.project = d.project
                                              LEFT JOIN quest e ON b.project = e.project AND b.kode = e.cabang AND a.att = e.kunjungan
                                              LEFT JOIN id_data f ON e.shp = f.Id
                                              LEFT JOIN id_data g ON e.pwt = g.Id
                                              LEFT JOIN id_data h ON b.kareg = h.Id
                                              WHERE
                                              	b.nomorstkb = '$nomorstkb'
                                              ORDER BY
                                              	kodecabang ASC")->result_array();
    }
    // $data['detailnya'] = array_merge($dataNonATM, $dataATM);
    // = $dataNonATM;
    $this->load->view('stkb/tracking/detailstkb', $data);
  }

  public function takeout_skenario()
  {
    date_default_timezone_set('Asia/Jakarta');
    $data_sken = $this->input->post('aksi_sken');


    $source_project = " ";
    $source_no_stkb = " ";
    $source_kode = " ";
    $source_kunjungan = " ";
    $source_pic = " ";
    $source_spv = " ";
    $source_tujuan = " ";




    foreach ($data_sken as $row) {
      $data_unik = explode("_", $row);
      $project = $data_unik[0];
      $kode = $data_unik[1];
      $kunjungan = $data_unik[2];
      $no_stkb = $data_unik[3];

      $c = $this->db->get_where('cabang', array('kode' => $kode))->row();
      $q = $this->db->get_where('attribute', array('kode' => $kunjungan))->row();

      $pic = $this->db->query("SELECT * FROM plan a INNER JOIN id_data b ON a.kareg=b.Id WHERE a.project='$project' AND a.kunjungan='$kunjungan' AND a.nomorstkb='$no_stkb' AND a.kode='$kode'")->row();

      $spv = $this->db->query("SELECT * FROM plan a INNER JOIN id_data b ON a.spv=b.Id WHERE a.project='$project' AND a.kunjungan='$kunjungan' AND a.nomorstkb='$no_stkb' AND a.kode='$kode'")->row();



      $source_project .= $project . ", ";
      $source_no_stkb .= $no_stkb . ", ";
      if ($c != NULL) {
        $source_kode .= $kode . " (" . $c->nama . ")" . ", ";
      } else {
        $source_kode = "";
      }
      if ($q != NULL) {
        $source_kunjungan .= $q->nama . ", ";
      } else {
        $source_kunjungan = "";
      }

      if ($pic != NULL) {
        $source_pic .= $pic->Email . ", ";
      } else {
        $source_pic = "";
      }

      if ($spv != NULL) {
        $source_spv .= $spv->Email . ", ";
      } else {
        $source_spv = "";
      }


      $pembuat = $this->db->get_where('project', array('kode' => $project))->row();
      // var_dump($pembuat->id_user);
      // var_dump($this->session->userdata('id_user'));
      // var_dump($this->input->post('alasan'));

      if ($pembuat->id_user == $this->session->userdata('id_user')) {

        $q = $this->db->get_where('plan', array('project' => $project, 'kode' => $kode, 'kunjungan' => $kunjungan, 'nomorstkb' => $no_stkb))->row_array();

        $data = [
          'project' => $q['project'],
          'kode' => $q['kode'],
          'kota' => $q['kota'],
          'planstart' => $q['planstart'],
          'planend' => $q['planend'],
          'planend_old' => $q['planend_old'],
          'spv' => $q['spv'],
          'kareg' => $q['kareg'],
          'kunjungan' => $q['kunjungan'],
          'waktu' => $q['waktu'],
          'status' => $q['status'],
          'nomorstkb' => $q['nomorstkb'],
          'kotadari' => $q['kotadari'],
          'kotadinas' => $q['kotadinas'],
          'penugasan' => $q['penugasan'],
          'user_takeout' => $this->session->userdata('id_user'),
          'waktu_takeout' => date('Y-m-d H:i:s'),
          'alasan' => $this->input->post('alasan')
        ];

        // var_dump($data);

        $this->db->insert('plan_hapus', $data);
        $where = [
          'project' => $project,
          'kode' => $kode,
          'kunjungan' => $kunjungan,
          'nomorstkb' => $no_stkb
        ];
        $delete = $this->db->delete('plan', $where);

        $quest = $this->db->get_where('quest', array('project' => $project, 'nomorstkb' => $no_stkb, 'cabang' => $kode, 'kunjungan' => $kunjungan))->row_array();
        if ($quest['status'] == '0') {
          $where_quest = [
            'project' => $project,
            'cabang' => $kode,
            'kunjungan' => $kunjungan,
            'nomorstkb' => $no_stkb
          ];
          $delete_quest = $this->db->delete('quest', $where_quest);
        }

        $ops = $this->db->get_where('stkb_ops', array('nomorstkb' => $no_stkb))->row_array();

        //BACKUP stkb_ops
        $ops_backup = $this->db->get_where('stkb_ops_backup', array('nomorstkb' => $no_stkb))->row_array();

        if ($ops_backup == NULL) {
          $data_ops = [
            'nomorstkb' => $ops['nomorstkb'],
            'project' => $ops['project'],
            'kode_iddata' => $ops['kode_iddata'],
            'urutproject' => $ops['urutproject'],
            'daerahasal' => $ops['daerahasal'],
            'kotadinas' => $ops['kotadinas'],
            'penugasan' => $ops['penugasan'],
            'tglmulai' => $ops['tglmulai'],
            'tglselesai' => $ops['tglselesai'],
            'hk' => $ops['hk'],
            'hl' => $ops['hl'],
            'jml_hari' => $ops['jml_hari'],
            'quota' => $ops['quota'],
            'q1' => $ops['q1'],
            'q2' => $ops['q2'],
            'q3' => $ops['q3'],
            'atmc' => $ops['atmc'],
            'atmm' => $ops['atmm'],
            'tlr_psh' => $ops['tlr_psh'],
            'telp_cbg' => $ops['telp_cbg'],
            'sapubersih' => $ops['sapubersih'],
            'bpjs' => $ops['bpjs'],
            'lumpsumharian' => $ops['lumpsumharian'],
            'akomodasi' => $ops['akomodasi'],
            'lumpsumops' => $ops['lumpsumops'],
            'totallumpsum' => $ops['totallumpsum'],
            'term1' => $ops['term1'],
            'approval1' => $ops['approval1'],
            'tglbayar1' => $ops['tglbayar1'],
            'novoucher1' => $ops['novoucher1'],
            'aktualbayar1' => $ops['aktualbayar1'],
            'term2' => $ops['term2'],
            'approval2' => $ops['approval2'],
            'tglbayar2' => $ops['tglbayar2'],
            'novoucher2' => $ops['novoucher2'],
            'aktualbayar2' => $ops['aktualbayar2'],
            'term3' => $ops['term3'],
            'approval3' => $ops['approval3'],
            'tglbayar3' => $ops['tglbayar3'],
            'novoucher3' => $ops['novoucher3'],
            'aktualbayar3' => $ops['aktualbayar3'],
            'perdin' => $ops['perdin'],
            'check' => $ops['check'],
            'tglbuat' => $ops['tglbuat'],
            'cekfm' => $ops['cekfm'],
            'cekfs' => $ops['cekfs'],
            'backup' => $ops['backup']
          ];
          $this->db->insert('stkb_ops_backup', $data_ops);
        }

        $t = $this->db->get_where('stkb_trk', array('nostkb' => $no_stkb))->row_array();

        //BACKUP stkb_trk
        $trk_backup = $this->db->get_where('stkb_trk_backup', array('nostkb' => $no_stkb))->row_array();

        if ($trk_backup == NULL) {
          $data_trk_b = [
            'nostkb' => $t['nostkb'],
            'nama' => $t['nama'],
            'project' => $t['project'],
            'planstart' => $t['planstart'],
            'planend' => $t['planend'],
            'total' => $t['total'],
            'term1' => $t['term1'],
            'tglpembayaran1' => $t['tglpembayaran1'],
            'novoucher1' => $t['novoucher1'],
            'aktualbayar1' => $t['aktualbayar1'],
            'term2' => $t['term2'],
            'tglpembayaran2' => $t['tglpembayaran2'],
            'novoucher2' => $t['novoucher2'],
            'aktualbayar2' => $t['aktualbayar2'],
            'term3' => $t['term3'],
            'tglpembayaran3' => $t['tglpembayaran3'],
            'novoucher3' => $t['novoucher3'],
            'aktualbayar3' => $t['aktualbayar3'],
            'cekfm' => $t['cekfm'],
            'cekfs' => $t['cekfs']
          ];
          $this->db->insert('stkb_trk_backup', $data_trk_b);
        }

        if ($kunjungan == '001') {
          $q1_baru = $ops['q1'] - 1;
          $this->db->query("UPDATE stkb_ops SET q1 = '$q1_baru' WHERE nomorstkb = '$no_stkb'");
        } else if ($kunjungan == '002') {
          $q2_baru = $ops['q2'] - 1;
          $this->db->query("UPDATE stkb_ops SET q2 = '$q2_baru' WHERE nomorstkb = '$no_stkb'");
        } else if ($kunjungan == '003') {
          $q3_baru = $ops['q3'] - 1;
          $this->db->query("UPDATE stkb_ops SET q3 = '$q3_baru' WHERE nomorstkb = '$no_stkb'");
        } else if ($kunjungan == '064' or $kunjungan == '065' or $kunjungan == '066' or $kunjungan == '067') {
          $atmc_baru = $ops['atmc'] - 1;
          $this->db->query("UPDATE stkb_ops SET atmc = '$atmc_baru' WHERE nomorstkb = '$no_stkb'");
        } else if ($kunjungan == '062') {
          $atmm_baru = $ops['atmm'] - 1;
          $this->db->query("UPDATE stkb_ops SET atmm = '$atmm_baru' WHERE nomorstkb = '$no_stkb'");
        } else if ($kunjungan == '071' or $kunjungan == '072' or $kunjungan == '073') {
          $telpcbg_baru = $ops['telp_cbg'] - 1;
          $this->db->query("UPDATE stkb_ops SET telp_cbg = '$telpcbg_baru' WHERE nomorstkb = '$no_stkb'");
        }
      } else {
        //     
      ?>

        <script>
          window.alert('Maaf hanya user pembuat project yang bisa takeout kunjungan');
          window.location = '<?php echo site_url('stkb/preview2p') ?>';
          //     
        </script>;
      <?php
      }
    }

    $data_project = substr($source_project, 0, -1);
    $data_kode = substr($source_kode, 0, -1);
    $data_kunjungan = substr($source_kunjungan, 0, -1);
    $data_no_stkb = substr($source_no_stkb, 0, -1);

    $email_pic = substr($source_pic, 0, -1);

    $email_spv = substr($source_spv, 0, -1);

    $cc = $email_pic . ", " . $email_spv;
    $user_t = $this->session->userdata('id_user');

    $u = $this->db->get_where('user', array('noid' => $user_t))->row();
    $usertakeout = $u->name;
    if ($delete)
    // if (isset($_POST['submit_takeout'])) 
    {

      $config = [

        'protocol' => 'smtp',
        'smtp_host' => '192.168.8.3',
        'smtp_port' => 25,
        'smtp_user' => 'admin.web@mri-research-ind.com',
        'smtp_pass' => 'w3bminMRI',
        'smtp_timeout' => '30',
        'crlf' => "\r\n",
        'newline' => "\r\n"

      ];

      $emailtujuan = $this->db->query("SELECT email FROM user WHERE id_divisi = '7'")->result_array();

      if ($emailtujuan != NULL) {
        foreach ($emailtujuan as $row) :
          $source_tujuan .= $row['email'] . ", ";
        endforeach;
        $send_email = substr($source_tujuan, 0, -1);
      } else {
        $send_email = "";
      }


      $this->load->library('email', $config);
      $this->email->initialize($config);

      $this->email->from('admin.web@mri-research-ind.com', 'Operation2 WebAdmin');
      $this->email->to($send_email);
      $this->email->cc($cc);
      $this->email->subject('Informasi Takeout Kunjungan Cabang STKB');
      $this->email->message('Informasi Takeout :
                  <br>Kunjungan yang di takeout : ' . $data_kunjungan . ' 
                  <br>Cabang : ' . $data_kode . ' 
                  <br>Dari STKB Nomor : ' . $data_no_stkb . ' 
                  <br>Oleh ' . $usertakeout . ', sehingga menyebabkan perubahan nominal transaksi untuk pembayaran term.
                  <br>
                  <br>
                  <br>Terima Kasih');


      $this->email->set_mailtype('html');
      // $this->email->send();

      if ($this->email->send()) {
        echo "SUCCESS MENGIRIM EMAIL";
      } else {
        show_error($this->email->print_debugger());
      }


      $this->session->set_flashdata('flash', 'Berhasil Takeout Kunjungan');
      redirect('stkb/preview2p');
    } else {
      ?>
      <script>
        window.alert('Maaf Takeout Kunjungan Gagal');
        window.location = '<?php echo site_url('stkb/preview2p') ?>';
      </script>;
    <?php
    }
  }

  public function ajukan_kas()
  {
    date_default_timezone_set('Asia/Jakarta');

    $no_pembayaran = $this->input->post('num');
    $kodekas = "Kas" . date('dmY');

    foreach ($no_pembayaran as $no) {
      $ajukan = $this->db->query("UPDATE stkb_pembayaran SET kode_kas='$kodekas' WHERE no='$no'");
    }

    // $config = Array(
    //   'protocol' => 'smtp',
    //   'smtp_host' => 'smtp.mailtrap.io',
    //   'smtp_port' => 2525,
    //   'smtp_user' => '30611d69968f28',
    //   'smtp_pass' => '23d377be12082f',
    //   'crlf' => "\r\n",
    //   'newline' => "\r\n"
    // );

    $config = [

      'protocol' => 'smtp',
      'smtp_host' => '192.168.8.3',
      'smtp_port' => 25,
      'smtp_user' => 'admin.web@mri-research-ind.com',
      'smtp_pass' => 'w3bminMRI',
      'smtp_timeout' => '30',
      'crlf' => "\r\n",
      'newline' => "\r\n"

    ];

    $get = $this->db->query("SELECT *, sum(a.total) AS pengajuan, MAX(tanggalbuat) AS max_prd, MIN(tanggalbuat) AS min_prd FROM stkb_pembayaran a JOIN project b ON a.kodeproject=b.kode WHERE kode_kas='$kodekas' GROUP BY a.kodeproject")->result_array();
    $no = 1;
    foreach ($get as $row) {
      $budget = $this->db->query("SELECT 
                                                  SUM(c.bpjs + c.lumpsumharian + c.akomodasi + c.lumpsumops + IF(c.perdin IS NULL, 0, c.perdin) + IF(d.term1 <= 0, 0, d.term1) + IF(d.term2 <= 0, 0, d.term2) + IF(d.term3 <= 0, 0, d.term3)) AS totalbudget,
                                                  SUM(c.aktualbayar1 + c.aktualbayar2 + c.aktualbayar3 + d.aktualbayar1 + d.aktualbayar2 + d.aktualbayar3) as totalbayar from project a
                                                  join bank b on a.bank = b.kode
                                                  join stkb_trk d on a.kode = d.project
                                                  join stkb_ops c on c.nomorstkb = d.nostkb
                                                  where a.kode = '$row[kodeproject]'
                                                  group by a.kode")->row_array();
      $data .= "<tr>
                  <td>" . $no++ . "</td>
                  <td>" . $row['nama'] . "</td>
                  <td>" . $row['kodeproject'] . "</td>
                  <td>Rp " . number_format($budget['totalbudget'], 0, ',', '.') . "</td>
                  <td>Rp " . number_format($budget['totalbayar'], 0, ',', '.') . "</td>
                  <td>Rp " . number_format($row['pengajuan'], 0, ',', '.') . "</td>
                  <td><center>"  . date("d M y", strtotime($row['max_prd'])) . " - " . date("d M y", strtotime($row['min_prd'])) . "</center></td>
                </tr>
                ";
      $total += $row['pengajuan'];
    }
    $sub .= "<tr>
                  <td colspan='5' class='text-center'>Total Pengajuan Kas :</td>
                  <td>Rp " . number_format($total, 0, ',', '.') . "</td>
                  <td></td>
              </tr>";

    $email = $this->db->get_where('user', array('noid' => '001'))->row_array();

    $this->load->library('email', $config);
    $this->email->initialize($config);

    $this->email->from('admin.web@mri-research-ind.com', 'Operation2 WebAdmin');
    $this->email->to($email['email']);
    $this->email->subject('Pengajuan Kas STKB');
    $this->email->message('Dengan ini bermaksud memberikan informasi mengenai pengajuan kas untuk pembayaran STKB, adapun detail pengajuan kas STKB sebagai berikut : 
          <br>
          <br>
          <table class="table table-bordered" border="1">
             
              <tr bgcolor="#e3f3fc">
                <th>No</th>
                <th>Nama Project</th>
                <th>Kode Project</th>
                <th>Total</th>
                <th>Sudah Dibayar</th>
                <th>Pengajuan Kas</th>
                <th>Periode Pengajuan Kas</th>
                                   
              </tr>
              ' . $data . $sub . '
          </table>
          <br>
          <br>
          Email ini dikirim otomatis melalui Aplikasi Operation 2');
    // $this->email->attach(base_url('assets/document/'). $filename);

    $this->email->set_mailtype('html');
    $this->email->send();

    if ($ajukan) {
      $this->session->set_flashdata('flash', 'Pengajuan Kas Berhasil');
      redirect('stkb/pengajuan');
    } else {
    ?>
      <script>
        window.alert('Maaf Pengajuan Kas Gagal');
        window.location = '<?php echo site_url('stkb/pengajuan') ?>';
      </script>;
    <?php
    }
  }


  public function approve_kas()
  {
    date_default_timezone_set('Asia/Jakarta');
    $dbkas = $this->load->database('dbkas', TRUE);

    $kodekas = $this->input->post('kode_kas');
    $kodepro = $this->input->post('kd_project');

    $jenisproject = "B1";
    $jenisbayar = "STKB";
    $statuskas = "1";

    foreach ($kodepro as $row => $value) {
      $data = [
        'kodekas' => $kodekas,
        'kodeproject' => $value,
        'jenis_project' => $jenisproject,
        'kredit' => $_POST['ajukan_kas'][$row],
        'jenisbayar' => $jenisbayar,
        'tanggalpengajuan' => date('Y-m-d H:i:s')
      ];

      $approve = $dbkas->insert('project', $data);
    }

    $statuskas = $this->db->query("UPDATE stkb_pembayaran SET status_kas = '$statuskas' WHERE kode_kas='$kodekas'");

    if ($approve && $statuskas) {

      $this->session->set_flashdata('flash', 'Berhasil Approve Pengajuan Kas');
      redirect('stkb/pengajuan');
    } else {
    ?>
      <script>
        window.alert('Maaf Approve Pengajuan Kas Gagal');
        window.location = '<?php echo site_url('stkb/pengajuan') ?>';
      </script>;
    <?php
    }
  }


  /******** Controller SDM STKB ********/
  public function sdm_stkb()
  {
    $data['judul'] = "STKB || SDM";
    $data['sdm'] = $this->db->get('stkb_sdm')->result_array();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/sdm/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_sdmstkb()
  {
    $Id = $this->input->post('Id');
    
    $cek = $this->db->get_where('stkb_sdm', array('id' => $Id))->num_rows();
    
    if ($cek == 0) {
      $this->Stkb_model->tambah_sdmstkb();

      $this->session->set_flashdata('flash', 'Berhasil Menambah Data');
      redirect('stkb/sdm_stkb');
    } else {
    ?>
      <script>
        window.alert('Maaf Nama dan ID tersebut sudah terdaftar di SDM STKB');
        window.location = '<?php echo site_url('stkb/sdm_stkb') ?>';
      </script>;
    <?php
    }
  }

  public function edit_sdmstkb()
  {
    $this->Stkb_model->edit_sdmstkb();

    $this->session->set_flashdata('flash', 'Berhasil Diubah');
    redirect('stkb/sdm_stkb');
  }

  public function hapus_sdmstkb($no)
  {
    $this->db->where('no', $no);
    $this->db->delete('stkb_sdm');
    $this->session->set_flashdata('flash', 'Berhasil Dihapus');
    redirect('stkb/sdm_stkb');
  }

  public function masterplan_2021() // Temp untuk 2021
  {
    $data['judul'] = "STKB || Master Plan";
    $data['masterplannama'] = $this->Stkb_model->getallnama();
    $data['masterplanproject'] = $this->Stkb_model->getallprojectmaster();
    $data['masterplankota'] = $this->Stkb_model->kotakabupaten();
    $data['getallitinerary'] = $this->Stkb_model->getitinerary();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/masterplan/index_2021', $data);
    $this->load->view('templates/footer', $data);
  }

  public function field_sdm()
  {
    $data['judul'] = "Field || Field SDM";
    $data['sdm_mitra'] = $this->Fieldsdm_model->getAllDataMitra();
    $data['sdm_kontrak'] = $this->Fieldsdm_model->getAllDataKontrak();
    $data['sdm_fo'] = $this->Fieldsdm_model->getAllDataFo();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/field_sdm/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_fieldsdm()
  {
    date_default_timezone_set('Asia/Jakarta');

    $cek = $this->db->get_where('field_sdm', array('id_data_id' => $this->input->post('id_data_id')))->num_rows();

    if ($cek == 0) {
      $this->Fieldsdm_model->tambah();
      $this->session->set_flashdata('flash', 'Berhasil Menambah Data');
      redirect('stkb/field_sdm');
    } else {
    ?>
      <script>
        window.alert('Maaf Nama dan ID tersebut sudah terdaftar di Field SDM');
        window.location = '<?php echo site_url('stkb/field_sdm') ?>';
      </script>;
    <?php
    }
  }

  public function edit_fieldsdm()
  {
    $this->Fieldsdm_model->edit();

    $this->session->set_flashdata('flash', 'Berhasil Diubah');
    redirect('stkb/field_sdm');
  }

  public function hapus_fieldsdm($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('field_sdm');
    $this->session->set_flashdata('flash', 'Berhasil Dihapus');
    redirect('stkb/field_sdm');
  }

  public function pembayaran_field_sdm()
  {
    $data['judul'] = "Field || Field SDM";
    $data['sdm'] = $this->Fieldsdm_model->getAllData();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/field_sdm/pembayaran', $data);
    $this->load->view('templates/footer');
  }

  public function tab_pembayaran_field_sdm()
  {
    error_reporting(0);
    $this->load->library('datatables');
    // $this->load->model('Stkb_model2');
    $tab = $_POST['data'];
    // echo ($tab);
    $id_user = $this->session->userdata('id_user');
    if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
      $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
    } else {
      $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
    }
    $data['user'] = $user;
    if ($tab == '#pengajuan') {
      $this->load->view('stkb/field_sdm/tab/pengajuan', $data);
    } else if ($tab == '#term1') {
      $this->load->view('stkb/field_sdm/tab/term1', $data);
    } else if ($tab == '#term2') {
      $this->load->view('stkb/field_sdm/tab/term2', $data);
    } else if ($tab == '#term3') {
      $this->load->view('stkb/field_sdm/tab/term3', $data);
    } else if ($tab == '#menu1') {
      $this->load->view('stkb/field_sdm/tab/menu1', $data);
    } else if ($tab == '#menu2') {
      // $data['getpaid'] = $this->Stkb_model->getallpaid();
      $this->load->view('stkb/field_sdm/tab/menu2', $data);
    } else if ($tab == '#menu3') {
      $data['getproject'] = $this->Stkb_model->getallproject();

      $this->load->view('stkb/field_sdm/tab/menu3', $data);
    }
  }

  public function get_data_json_pembayaran($tab)
  {
    error_reporting(0);
    $this->load->library('datatables');
    // $this->load->model('Stkb_model2');
    header('Content-Type: application/json');
    if ($tab == 'pengajuan') {
      echo $this->Fieldsdm_model->get_data_pengajuan();
    } else if ($tab == 'term1') {
      echo $this->Fieldsdm_model->get_data_term1();
    } else if ($tab == 'term2') {
      echo $this->Fieldsdm_model->get_data_term2();
    } else if ($tab == 'term3') {
      echo $this->Fieldsdm_model->get_data_term3();
    } else if ($tab == 'menu1') {
      // echo $this->Fieldsdm_model->get_data_term3();
      echo $this->Fieldsdm_model->get_data_rtp_mri_kas();
    } else if ($tab == 'menu2') {
      echo $this->Fieldsdm_model->get_data_rtp_mri_pal();
    } else if ($tab == 'menu3') {
      echo $this->Fieldsdm_model->get_data_paid();
    }
  }

  public function pengajuan_pembayaran_field_sdm()
  {
    $getHoliday = $this->db->query("SELECT * FROM db_cuti.kalender")->result_array();
    $holidays = [];
    foreach ($getHoliday as $item) {
      array_push($holidays, $item['tanggal']);
    }

    $progress = ($this->input->post('progress') !== null) ? $this->input->post('progress') : 0;
    // $progress = 100;
    $kode_project = ($this->input->post('kode_project') !== null) ? $this->input->post('kode_project') : null;

    $id_data_id = ($this->input->post('id_sdm') !== null) ? $this->input->post('id_sdm') : null;

    $data['sdm'] = $this->Fieldsdm_model->getSdmByIdData($id_data_id);
    $kota_id = $data['sdm']['kota_id'];
    $kota = $this->db->query("SELECT nm_kota FROM kota WHERE id = $kota_id")->row_array();

    $data['honor'] = $this->Fieldsdm_model->getSdmMatrix($data['sdm']['kota_id'], $data['sdm']['posisi'], $data['sdm']['status']);

    $project = $this->Stkb_model->getProjectByAreaHead($id_data_id, $kode_project);
    $data['namaproject'] = $this->Stkb_model->getprojectbykode($kode_project);

    $data['training'] = 0;
    $data['detail_training'] = [];
    $data['hari_kerja'] = 0;
    $data['detail_hari_kerja'] = [];
    $data['kuesioner_setempat'] = 0;
    $data['detail_kuesioner_setempat'] = [];
    $data['kuesioner_lk'] = 0;
    $data['detail_kuesioner_lk'] = [];
    $data['insentif_upload'] = 0;
    $data['detail_insentif_upload'] = [];
    $data['penalti_keterlambatan_upload'] = 0;
    $data['detail_penalti_keterlambatan_upload'] = [];
    $data['penalti_pengulangan'] = 0;
    $data['detail_penalti_pengulangan'] = [];
    $data['penalti_timeline'] = 0;
    $data['detail_penalti_timeline'] = [];
    $data['detail_insentif_kaderisasi'] = 0;
    $data['insentif_kaderisasi'] = 0;
    $data['penalti_kaderisasi'] = 0;
    $data['detail_penalti_kaderisasi'] = [];

    $data['hari_kerja'] = $this->Fieldsdm_model->countDaftarCabang($id_data_id, $kode_project);
    $data['detail_hari_kerja'] =  $this->Fieldsdm_model->getDetailDaftarCabang($id_data_id, $kode_project);

    foreach ($project as $item) {
      $plan = $this->Projectplan_model->getByProject($item['project']);
      foreach ($plan as $p) {
        $getProject = $this->Project_model->getProjectById($p['project_kode']);
        if ($p['task_id'] == 1 && $p['date_start']) {
          $tanggal_mulai_fieldwork = $p['date_start'];
          $tanggal_selesai_fieldwork = $p['date_finish'];
          if (date_diff(date_create($tanggal_mulai_fieldwork), date_create($data['sdm']['tanggal_mulai']))->format("%R") == "-") {
            $tanggal_mulai = $tanggal_mulai_fieldwork;
          } else {
            $tanggal_mulai = $data['sdm']['tanggal_mulai'];
          }


          if (date_diff(date_create($tanggal_selesai_fieldwork), date_create($data['sdm']['tanggal_selesai']))->format("%R") == "+") {
            $tanggal_selesai = $tanggal_selesai_fieldwork;
          } else {
            $tanggal_selesai = $data['sdm']['tanggal_selesai'];
          }

          // if (($tanggal_mulai <= $data['tanggal_selesai']) && ($tanggal_selesai >= $data['tanggal_mulai'])) {

          //   if (date_diff(date_create($tanggal_mulai), date_create($data['tanggal_mulai']))->format("%R") == "-") {
          //     $tanggal_mulai = $tanggal_mulai;
          //   } else {
          //     $tanggal_mulai = $data['tanggal_mulai'];
          //   }

          //   if (date_diff(date_create($tanggal_selesai), date_create($data['tanggal_selesai']))->format("%R") == "+") {
          //     $tanggal_selesai = $tanggal_selesai;
          //   } else {
          //     $tanggal_selesai = $data['tanggal_selesai'];
          //   }
          // }

          $getPlan = $this->db->query("SELECT * FROM plan WHERE area_head = '$id_data_id' AND  project = '$item[project]'  AND kunjungan NOT IN ('051', '052')")->result_array();

          $temp_last_date = null;
          foreach ($getPlan as $gp) {
            $getQuest = $this->db->query("SELECT * FROM quest WHERE project = '$gp[project]' AND cabang = '$gp[kode]' AND kunjungan = '$gp[kunjungan]' AND status >= 3")->row_array();

            if ($temp_last_date) {
              if ($temp_last_date < $getQuest['tanggal']) {
                $temp_last_date = $getQuest['tanggal'];
              }
            } else {
              $temp_last_date = $getQuest['tanggal'];
            }
          }
          $tanggal_selesai_fieldwork_nextday = date('Y-m-d', strtotime($tanggal_selesai_fieldwork . " +1 days"));

          if ($temp_last_date && $tanggal_selesai_fieldwork) {
            if (date_diff(date_create($temp_last_date), date_create($tanggal_selesai_fieldwork))->format("%R") == "-") {
              $data['detail_penalti_timeline'][$getProject['nama']] = array('last_date' => $temp_last_date, 'tanggal_selesai' => $tanggal_selesai_fieldwork_nextday);

              $data['penalti_timeline'] +=  $this->getWorkingDays($tanggal_selesai_fieldwork_nextday, $temp_last_date, $holidays);
            }
          }
        }
      }

      $get_training = $this->db->query("SELECT a.* FROM training a JOIN peserta_training b ON a.id = b.training_id WHERE a.project_kode = '$item[project]' AND b.id_data_id = '$id_data_id'")->result_array();
      foreach ($get_training as $item) {
        $get_materi = $this->db->query("SELECT COUNT(*) AS count FROM materi_training WHERE training_id = '$item[id]'")->row_array();
        $get_presensi = $this->db->query("SELECT COUNT(*) AS count FROM presensi_training a JOIN peserta_training b ON a.peserta_training_id = b.id WHERE a.training_id = '$item[id]' AND b.id_data_id = '$id_data_id'")->row_array();

        $nama = ($item['project_kode']) ? $item['project_kode'] : $item['nama_training'];
        if ($get_materi['count'] == $get_presensi['count']) {
          $start_date = $this->db->query("SELECT MIN(tanggal_mulai) AS tanggal_mulai FROM materi_training WHERE training_id = '$item[id]'")->row_array();
          $end_date = $this->db->query("SELECT MAX(tanggal_selesai) AS tanggal_selesai FROM materi_training WHERE training_id = '$item[id]'")->row_array();
          if ($start_date['tanggal_mulai'] && $end_date['tanggal_selesai']) {
            $count = $this->getWorkingDays($start_date['tanggal_mulai'], $end_date['tanggal_selesai'], $holidays);
            $data['training'] += $count;

            $data['detail_training'][$nama] = array('start_date' => $start_date['tanggal_mulai'], 'end_date' => $end_date['tanggal_selesai'], 'ket' => '');
          }
        } else {
          $data['detail_training'][$nama] = array('start_date' => '', 'end_date' => '', 'ket' => "tidak mengikuti semua materi");
        }
      }
    }

    $getPlan = $this->db->query("SELECT * FROM plan WHERE area_head = '$id_data_id' AND project = '$kode_project' AND kunjungan NOT IN ('051', '052')")->result_array();
    foreach ($getPlan as $item) {
      $getProject = $this->Project_model->getProjectById($item['project']);

      // $getQuest = $this->db->query("SELECT * FROM quest WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]' AND status >= 3")->row_array();
      $getQuest = $this->db->query("SELECT a.*, b.validator_time FROM quest a JOIN summary_2 b ON a.project = b.project_kode AND a.cabang = b.cabang_kode AND a.kunjungan = b.sub_kunjungan_kode WHERE a.project = '$item[project]' AND a.cabang = '$item[kode]' AND a.kunjungan = '$item[kunjungan]' AND a.status >= 3")->row_array();

      $getSummary = $this->db->query("SELECT * FROM summary_2 WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND sub_kunjungan_kode = '$item[kunjungan]'")->row_array();

      $getNamaCabang = $this->Cabang_model->getDataByKodeAndProject($item['kode'], $item['project']);
      if ($getQuest['validator_time'] > $data['sdm']['tanggal_mulai'] && $getQuest['validator_time'] < $data['sdm']['tanggal_selesai']) {
        $status = "Di dalam tanggal kontrak";
      } else {
        $status = "Di luar tanggal kontrak";
      }

      if ($getQuest) {
        if (strtolower($item['kota']) == strtolower($kota['nm_kota'])) {
          $data['detail_kuesioner_setempat'][$item['no']] = array('kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'project' => $getProject['nama'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama']);
          $data['kuesioner_setempat'] += 1;
        } else {
          $data['detail_kuesioner_lk'][$item['no']] = array('kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'project' => $getProject['nama'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama']);
          $data['kuesioner_lk'] += 1;
        }
      }

      if ($getQuest['validator_time'] && $getSummary['waktu_upload']) {
        if (date_diff(date_create($getQuest['validator_time']), date_create($getSummary['waktu_upload']))->format("%R") == "+") {
          if (date_diff(date_create($getQuest['validator_time']), date_create($getSummary['waktu_upload']))->format("%a") >= 2) {
            $data['detail_penalti_keterlambatan_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
            $data['penalti_keterlambatan_upload'] += 1;
          } else {
            $data['detail_insentif_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
            $data['insentif_upload'] += 1;
          }
        } else {
          $data['detail_insentif_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
          $data['insentif_upload'] += 1;
        }
      };

      $getQuestUlang = $this->db->query("SELECT cabang, project, kunjungan FROM quest_ulang WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]'
        UNION
        SELECT cabang, project, kunjungan FROM quest_do WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]'
        UNION
        SELECT cabang_kode AS cabang, project_kode AS project, kunjungan_kode AS kunjungan FROM summary_2_do WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND kunjungan_kode = '$item[kunjungan]'
        ")->result_array();
      foreach ($getQuestUlang as $gqu) {
        $getNamaCabang = $this->Cabang_model->getDataByKodeAndProject($gqu['cabang'], $gqu['project']);
        $getProject = $this->Project_model->getProjectById($gqu['project']);
        $data['detail_penalti_pengulangan'][$getProject['nama'] . $gqu['kunjungan'] . $gqu['cabang']] = array('project' => $getProject['nama'], 'kjg' => $gqu['kunjungan'], 'cbg' => $gqu['cabang'], 'namacbg' => $getNamaCabang['nama']);
      }
      $countQuestUlang = $this->db->query("SELECT cabang, project, kunjungan FROM quest_ulang WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]'
        UNION
        SELECT cabang, project, kunjungan FROM quest_do WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]'
        UNION
        SELECT cabang_kode AS cabang, project_kode AS project, kunjungan_kode AS kunjungan FROM summary_2_do WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND kunjungan_kode = '$item[kunjungan]'
        ")->num_rows();
      $data['penalti_pengulangan'] += $countQuestUlang;
    }

    $data['insentif_kaderisasi'] = $this->Fieldsdm_model->countInsentifKaderisasi(null, null, $data['sdm']['id']);
    // $data['insentif_kaderisasi'] = 3;
    // $data['insentif_upload'] = 3;
    // $data['detail_insentif_kaderisasi'] = $this->Fieldsdm_model->getInsentifKaderisasi($data['tanggal_mulai'], $data['tanggal_selesai'], $data['sdm']['id']);

    $today = date('Y-m-d');

    if (($today > $data['sdm']['selesai_kaderisasi'])) {
      $data['penalti_kaderisasi'] = $data['sdm']['jumlah_kaderisasi'] - $data['insentif_kaderisasi'];
    }

    if ($data['sdm']['status'] == 'Kontrak') {
      $total_honor_supervisi = $data['honor']['supervisi_kontrak'] * $data['hari_kerja'];
    } else if ($data['sdm']['status'] == 'Mitra') {
      $total_honor_supervisi = $data['honor']['supervisi_mitra'] * $data['hari_kerja'];
    }

    $total_honor_training = $data['honor']['training'] * $data['training'];
    $total_honor_prod_setempat = $data['honor']['produktivitas'] * $data['kuesioner_setempat'];
    $total =  $total_honor_supervisi + $total_honor_training + $total_honor_prod_setempat;


    $total_insentif_timeline = $data['honor']['insentif_timeline'] * $data['kuesioner_lk'];
    $total_insentif_kader = $data['honor']['insentif_kaderisasi'] * $data['insentif_kaderisasi'];
    $total_insentif_upload = $data['honor']['insentif_upload'] * $data['insentif_upload'];
    if ($progress == 100) {
      $total2 = $total_insentif_timeline + $total_insentif_kader + $total_insentif_upload;
    } else {
      $total2 = 0;
    }

    $total_penalti_pengulangan = $data['honor']['penalti_pengulangan'] * $data['penalti_pengulangan'];
    $total_penalti_upload = $data['honor']['penalti_keterlambatan_upload'] * $data['penalti_keterlambatan_upload'];
    $total_penalti_timeline = $data['honor']['penalti_keterlambatan_timeline'] * $data['penalti_timeline'];
    $total_penalti_kader = $data['honor']['penalti_kaderisasi'] * $data['penalti_kaderisasi'];
    if ($progress == 100) {
      $total3 = $total_penalti_pengulangan + $total_penalti_upload + $total_penalti_timeline + $total_penalti_kader;
    } else {
      $total3 = 0;
    }

    $total_keseluruhan =  $total + $total2  - $total3;
    //var_dump($total_keseluruhan);
    //die;

    if ($progress >= 0 && $progress < 50) {
      $term = 1;
    } else if ($progress >= 50 && $progress < 100) {
      $term = 2;
    } else if ($progress == 100) {
      $term = 3;
    }

    $maxTerm = $this->Fieldsdm_model->getMaxTerm($id_data_id, $kode_project);
    // var_dump($term);
    // die;
    $countTerm = 0;
    for ($i = (($maxTerm['term']) ?  $maxTerm['term'] : 1); $i <= $term; $i++) {
      $checkTerm = $this->Fieldsdm_model->countFieldPembayaran(null, $i, $id_data_id, $kode_project);

      if (!$checkTerm) {
        $insert = $this->Fieldsdm_model->insertFieldPembayaran($total_keseluruhan, $id_data_id, $progress, $kode_project, $i);
        $countTerm++;
        if (!$insert) {
          $this->session->set_flashdata('flash-fail', "Term $i Gagal Diajukan");
          redirect('stkb/pembayaran_field_sdm');
        }
      }
    }
    if ($countTerm) {
      $this->session->set_flashdata('flash', 'Data Berhasil Diajukan');
      redirect('stkb/pembayaran_field_sdm');
    } else {
      $this->session->set_flashdata('flash-fail', "Tidak ada data yang diajukan");
      redirect('stkb/pembayaran_field_sdm');
    }
  }

  public function readytopaid_fieldsdm()
  {
    $db3 = $this->load->database('database_ketiga', TRUE);
    $db_mritransfer = $this->load->database('db_mritransfer', TRUE);
    $db_develop = $this->load->database('db_develop', TRUE);
    $db_bridge = $this->load->database('db_bridge', TRUE);
    for ($i = 0; $i < count($_POST['statusbayar']); $i++) {
      $kode_project = $_POST["kodeproject-" . $_POST['statusbayar'][$i]];
      $id_sdm = $_POST['idsdm-' . $_POST['statusbayar'][$i]];
      $total = $_POST['total-' . $_POST['statusbayar'][$i]];

      $get_sdm = $this->db->query("SELECT * FROM id_data WHERE Id = '$id_sdm'")->row_array();

      $get_rek = $this->db->query("SELECT b.nama, a.NoRek as no FROM datarekening a JOIN bank b ON a.CodeBank = b.kode WHERE a.Id = '$id_sdm'")->row_array();

      $get_budget = $db3->query("SELECT * FROM pengajuan WHERE kodeproject = '$kode_project'")->row_array();
      if (in_array(strtolower($get_sdm['KotaTgl']), ['jakarta', 'jakarta utara', 'jakarta selatan', 'jakarta timur', 'jakarta barat', 'bogor', 'depok', 'tangerang', 'bekasi'])) {
        $checkItemBudget = $db3->query("SELECT * FROM selesai WHERE rincian='Honor Area Head Jakarta' AND waktu='$get_budget[waktu]'")->row_array();
      } else {
        $checkItemBudget = $db3->query("SELECT * FROM selesai WHERE rincian='Honor Area Head Luar Kota' AND waktu='$get_budget[waktu]'")->row_array();
      }

      if ($checkItemBudget) {
        $get_term = $db3->query("SELECT max(term) AS maxt FROM bpu WHERE waktu='$get_budget[waktu]' AND no='$checkItemBudget[no]'")->row_array();
        $term = $get_term['maxt'] + 1;

        $get_jenis_pembayaran = $db_mritransfer->query("SELECT * FROM jenis_pembayaran WHERE jenispembayaran = '$checkItemBudget[status]'")->row_array();

        if ($get_jenis_pembayaran) {
          if ($total > $get_jenis_pembayaran['max_transfer']) {
            $metode_pembayaran = 'MRI Kas';
          } else {
            $metode_pembayaran = 'MRI PAL';
          }
        }

        $get_bank = $this->db->query("SELECT * FROM bank WHERE nama = '$get_rek[nama]'")->row_array();

        $get_user = $this->Akun_model->getDataById($this->session->id_user);

        $insert_bpu = $db3->query("INSERT INTO bpu (no,jumlah,namabank,norek,namapenerima,emailpenerima,pengaju,divisi,waktu,status,persetujuan,metode_pembayaran,jumlahbayar,novoucher,tanggalbayar,pembayar,divpemb,term,statusbpu)
                                      VALUES
                                      ('$checkItemBudget[no]','$total','$get_bank[swift_code]','$get_rek[no]','$get_sdm[Nama]','$get_sdm[Email]','$get_user[name]','Sistem','$get_budget[waktu]','Belum Di Bayar','Disetujui oleh sistem','$metode_pembayaran','0','','','','','$term', '$checkItemBudget[status]')");

        $get_newest_bpu = $db3->query("SELECT noid FROM bpu ORDER BY noid DESC LIMIT 1")->row_array();
        if ($insert_bpu) {

          if ($metode_pembayaran == 'MRI PAL') {

            $get_kas = $db_develop->query("SELECT * FROM kas WHERE label_kas = 'Kas Project'")->row_array();

            $date = date('my');
            $count = $db_mritransfer->query("SELECT transfer_req_id FROM data_transfer WHERE transfer_req_id LIKE '$date%' ORDER BY transfer_req_id DESC LIMIT 1")->row_array();
            $count = (int)substr($count['transfer_req_id'], -4);
            $formatId = $date . sprintf('%04d', $count + 1);

            if ($get_bank['swift_code'] == "CENAIDJA") {
              $biayaTrf = 0;
            } else {
              $biayaTrf = 2900;
            }

            $currentTime = date('Y-m-d H:i:s');

            $insert_bridge =  $db_bridge->query("INSERT INTO data_transfer (transfer_req_id, transfer_type, jenis_pembayaran_id, keterangan, waktu_request, norek, pemilik_rekening, bank, kode_bank, berita_transfer, jumlah, terotorisasi, hasil_transfer, ket_transfer, nm_pembuat, nm_validasi, nm_manual, jenis_project, nm_project, noid_bpu, biaya_trf, rekening_sumber, email_pemilik_rekening, jadwal_transfer) 
        VALUES ('$formatId', '3', '1', '$checkItemBudget[status]', '$get_budget[waktu]', '$get_rek[no]', '$get_sdm[Nama]','$get_bank[nama]', '$get_bank[swift_code]', 'Pembayaran Honor Area Head','$total', '2', '1', 'Antri', '$get_user[name]', '', '', '$get_budget[jenis]', '$get_budget[nama]', '$get_newest_bpu[noid]', $biayaTrf, '$get_kas[rekening]', '$get_sdm[Email]', '$currentTime')");
          }
          if ($insert_bpu) {
            $this->Fieldsdm_model->updateStatusPembayaran($_POST['statusbayar'][$i], $metode_pembayaran, $get_newest_bpu['noid']);
          } else {
            $this->session->set_flashdata('flash-fail', "Proses data a/n " . $get_sdm['Nama'] .  " gagal, Pembuatan data transfer tidak berhasil");
            redirect('stkb/pembayaran_field_sdm');
          }
        } else {
          $this->session->set_flashdata('flash-fail', "Proses data a/n " . $get_sdm['Nama'] .  " gagal, Pembuatan BPU tidak berhasil");
          redirect('stkb/pembayaran_field_sdm');
        }
      } else {
        $this->session->set_flashdata('flash-fail', "Proses data a/n " . $get_sdm['Nama'] .  " gagal, Item budget tidak ditemukan");
        redirect('stkb/pembayaran_field_sdm');
      }
    }

    $this->session->set_flashdata('flash', 'Data Berhasil Diajukan');
    redirect('stkb/pembayaran_field_sdm');
  }

  public function paid_fieldsdm()
  {
    for ($i = 0; $i < count($_POST['statusbayar']); $i++) {
      $this->Fieldsdm_model->updateStatusPaidPembayaran($_POST['statusbayar'][$i]);
    }

    $this->session->set_flashdata('flash', 'Data Berhasil Diajukan');
    redirect('stkb/pembayaran_field_sdm');
  }

  public function getallnamabykotapulau_ah2021()
  {
    $sdm = $this->db->query("SELECT a.id_data_id as id, b.Nama as nama, c.nm_kota as kota_asal FROM field_sdm a JOIN id_data b ON a.id_data_id = b.Id LEFT JOIN kota c ON a.kota_id = c.id  WHERE  a.id != '0' AND a.posisi IN ('Area Head', 'Kepala Field')")->result_array();
    echo json_encode($sdm);
  }

  public function getallnamabykotapulau_fo2021()
  {
    $pulau = $this->db->query("SELECT nm_pulau AS nama FROM kota WHERE nm_kota like '%$_POST[kota]%'")->row_array();
    $kota = $this->db->query("SELECT * FROM kota WHERE nm_pulau = '$pulau[nama]'")->result_array();
    $listKota = [];
    foreach ($kota as $nm) {
      array_push($listKota, $nm['id']);
    }

    $inList = "('" . implode("','", $listKota) . "')";
    $sdm = $this->db->query("SELECT a.id_data_id as id, b.Nama as nama, c.nm_kota as kota_asal, a.aktif
                              FROM field_sdm a 
                              JOIN id_data b ON a.id_data_id = b.Id 
                              LEFT JOIN kota c ON a.kota_id = c.id  
                              WHERE  a.id != '0' AND a.kota_id 
                              IN $inList
                              UNION
                              SELECT a.pic as id, b.Nama as nama, b.KotaTgl as kota_asal, a.aktif 
                              FROM data_pengajuan_sdm a
                              JOIN id_data b ON a.pic = b.Id 
                              WHERE a.project = '$_POST[project]' AND a.status='1'
                              
                              ")->result_array();
    echo json_encode($sdm);
  }

  public function honor_fieldsdm()
  {
    $data['judul'] = "Field || Honor Field SDM";
    $data['getallhonor'] = $this->Fieldsdm_model->getAllHonor();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/honor_field_sdm/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_honor_fieldsdm()
  {
    date_default_timezone_set('Asia/Jakarta');

    $insert = $this->Fieldsdm_model->tambah_matrixhonor();

    if ($insert) {
      $this->session->set_flashdata('flash', 'Berhasil Menambah Data');
      redirect('stkb/honor_fieldsdm');
    } else {
    ?>
      <script>
        window.alert('Gagal Menambah Data');
        window.location = '<?php echo site_url('stkb/honor_fieldsdm') ?>';
      </script>;
    <?php
    }
  }

  public function edit_honor_fieldsdm()
  {
    date_default_timezone_set('Asia/Jakarta');

    $update = $this->Fieldsdm_model->edit_matrixhonor();

    if ($update) {
      $this->session->set_flashdata('flash', 'Berhasil Mengubah Data');
      redirect('stkb/honor_fieldsdm');
    } else {
    ?>
      <script>
        window.alert('Gagal Mengubah Data');
        window.location = '<?php echo site_url('stkb/honor_fieldsdm') ?>';
      </script>;
    <?php
    }
  }

  public function hapus_honor_fieldsdm($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('matrix_honor_sdm_field');
    $this->session->set_flashdata('flash', 'Berhasil Dihapus');
    redirect('stkb/honor_fieldsdm');
  }

  public function field_kotakab()
  {
    $data['judul'] = "Field || Field Kota Kab";
    $data['kotakab'] = $this->Fieldsdm_model->getAllKotaKab();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/field_kotakab/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_fieldkotakab()
  {
    date_default_timezone_set('Asia/Jakarta');

    $insert = $this->Fieldsdm_model->tambah_kotakab();

    if ($insert) {
      $this->session->set_flashdata('flash', 'Berhasil Menambah Data');
      redirect('stkb/field_kotakab');
    } else {
    ?>
      <script>
        window.alert('Gagal Menambah Data');
        window.location = '<?php echo site_url('stkb/field_kotakab') ?>';
      </script>;
    <?php
    }
  }

  public function edit_fieldkotakab()
  {
    $this->Fieldsdm_model->edit_kotakab();

    $this->session->set_flashdata('flash', 'Berhasil Diubah');
    redirect('stkb/field_kotakab');
  }

  public function hapus_kotakab($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('field_kotakab');
    $this->session->set_flashdata('flash', 'Berhasil Dihapus');
    redirect('stkb/field_kotakab');
  }

  public function print_reportsdm($nomorstkb, $term, $id)
  {
    ini_set('max_execution_time', '0');
	  // $dsn1 = 'mysqli://adam:Ad@mMR1db@192.168.8.2/db_cuti';
	  // $this->db1 = $this->load->database($dsn1, true);
    // $db1 = $this->load->database('db_cuti', TRUE);

    $getHoliday = $this->db->query("SELECT * FROM db_cuti.kalender")->result_array();
    $holidays = [];
    foreach ($getHoliday as $item) {
      array_push($holidays, $item['tanggal']);
    }

    $data['judul'] = "Field || Print Laporan Field SDM";

    $data['sdm'] = $this->Fieldsdm_model->getSdmById($id);
    $data['tanggal_mulai'] = ($this->input->post('tanggal_mulai') !== null) ? $this->input->post('tanggal_mulai') : null;
    $data['tanggal_selesai'] = ($this->input->post('tanggal_selesai') !== null) ? $this->input->post('tanggal_selesai') : null;
    $data['status'] = $this->input->post('status');
    $data['progress'] = ($this->input->post('progress') !== null) ? $this->input->post('progress') : 0;
    // $data['progress'] = 100;
    $data['project'] = ($this->input->post('project') !== null) ? $this->input->post('project') : null;
    $data['nomorstkb'] = ($this->input->post('nomorstkb') !== null) ? $this->input->post('nomorstkb') : null;

    $kota_id = $data['sdm']['kota_id'];
    $id_data_id = $data['sdm']['id_data_id'];
    $kota = $this->db->query("SELECT nm_kota FROM kota WHERE id = $kota_id")->row_array();

    $data['honor'] = $this->Fieldsdm_model->getSdmMatrix($data['sdm']['kota_id'], $data['sdm']['posisi'], $data['sdm']['status']);

    $data['training'] = 0;
    $data['detail_training'] = [];
    $data['hari_kerja'] = 0;
    $data['detail_hari_kerja'] = [];
    $data['kuesioner_setempat'] = 0;
    $data['detail_kuesioner_setempat'] = [];
    $data['kuesioner_lk'] = 0;
    $data['detail_kuesioner_lk'] = [];
    $data['insentif_upload'] = 0;
    $data['detail_insentif_upload'] = [];
    $data['penalti_keterlambatan_upload'] = 0;
    $data['detail_penalti_keterlambatan_upload'] = [];
    $data['penalti_pengulangan'] = 0;
    $data['detail_penalti_pengulangan'] = [];
    $data['penalti_timeline'] = 0;
    $data['detail_penalti_timeline'] = [];
    $data['detail_insentif_kaderisasi'] = 0;
    $data['insentif_kaderisasi'] = 0;
    $data['penalti_kaderisasi'] = 0;
    $data['detail_penalti_kaderisasi'] = [];

    if ($data['status'] == 'non-mitra') {
      $project = $this->Stkb_model->getProjectByAreaHead($id_data_id, null);
      foreach ($project as $item) {
        $plan = $this->Projectplan_model->getByProject($item['project']);
        foreach ($plan as $p) {
          $getProject = $this->Project_model->getProjectById($p['project_kode']);
          if ($p['task_id'] == 1 && $p['date_start'] < $data['tanggal_selesai']) {
            $tanggal_mulai_fieldwork = $p['date_start'];
            $tanggal_selesai_fieldwork = $p['date_finish'];
            if (date_diff(date_create($tanggal_mulai_fieldwork), date_create($data['sdm']['tanggal_mulai']))->format("%R") == "-") {
              $tanggal_mulai = $tanggal_mulai_fieldwork;
            } else {
              $tanggal_mulai = $data['sdm']['tanggal_mulai'];
            }

            if (date_diff(date_create($tanggal_selesai_fieldwork), date_create($data['sdm']['tanggal_selesai']))->format("%R") == "+") {
              $tanggal_selesai = $tanggal_selesai_fieldwork;
            } else {
              $tanggal_selesai = $data['sdm']['tanggal_selesai'];
            }

            if (($tanggal_mulai <= $data['tanggal_selesai']) && ($tanggal_selesai >= $data['tanggal_mulai'])) {

              if (date_diff(date_create($tanggal_mulai), date_create($data['tanggal_mulai']))->format("%R") == "-") {
                $tanggal_mulai = $tanggal_mulai;
              } else {
                $tanggal_mulai = $data['tanggal_mulai'];
              }

              if (date_diff(date_create($tanggal_selesai), date_create($data['tanggal_selesai']))->format("%R") == "+") {
                $tanggal_selesai = $tanggal_selesai;
              } else {
                $tanggal_selesai = $data['tanggal_selesai'];
              }

              if ($this->getWorkingDays($tanggal_mulai, $tanggal_selesai, $holidays) > 0) {
                $data['detail_hari_kerja'][$getProject['nama']] = array('tanggal_mulai' => $tanggal_mulai, 'tanggal_selesai' => $tanggal_selesai, 'tanggal_mulai_fieldwork' => $tanggal_mulai_fieldwork, 'tanggal_selesai_fieldwork' => $tanggal_selesai_fieldwork);

                $data['hari_kerja'] += $this->getWorkingDays($tanggal_mulai, $tanggal_selesai, $holidays);
              }
            }

            $getPlan = $this->db->query("SELECT * FROM plan WHERE area_head = '$id_data_id' AND  project = '$item[project]'  AND kunjungan NOT IN ('051', '052')")->result_array();

            $temp_last_date = null;
            foreach ($getPlan as $gp) {
              $getQuest = $this->db->query("SELECT * FROM quest WHERE project = '$gp[project]' AND cabang = '$gp[kode]' AND kunjungan = '$gp[kunjungan]' AND status >= 3")->row_array();

              if ($temp_last_date) {
                if ($temp_last_date < $getQuest['tanggal']) {
                  $temp_last_date = $getQuest['tanggal'];
                }
              } else {
                $temp_last_date = $getQuest['tanggal'];
              }
            }
            $tanggal_selesai_fieldwork_nextday = date('Y-m-d', strtotime($tanggal_selesai_fieldwork . " +1 days"));

            if ($temp_last_date && $tanggal_selesai_fieldwork) {
              if (date_diff(date_create($temp_last_date), date_create($tanggal_selesai_fieldwork))->format("%R") == "-") {
                if (date_diff(date_create($tanggal_selesai_fieldwork_nextday), date_create($data['tanggal_mulai']))->format("%R") == "-") {
                  $tanggal_mulai_penalti = $tanggal_selesai_fieldwork_nextday;
                } else {
                  $tanggal_mulai_penalti = $data['tanggal_mulai'];
                }

                if (date_diff(date_create($temp_last_date), date_create($data['tanggal_selesai']))->format("%R") == "+") {
                  $tanggal_selesai_penalti = $temp_last_date;
                } else {
                  $tanggal_selesai_penalti = $data['tanggal_selesai'];
                }

                if ($this->getWorkingDays($tanggal_mulai_penalti, $tanggal_selesai_penalti, $holidays) > 0) {
                  $data['detail_penalti_timeline'][$getProject['nama']] = array('last_date' => $tanggal_selesai_penalti, 'tanggal_selesai' => $tanggal_mulai_penalti);
                  $data['penalti_timeline'] +=  $this->getWorkingDays($tanggal_mulai_penalti, $tanggal_selesai_penalti, $holidays);
                }
              }
            }
          }
        }

        $get_training = $this->db->query("SELECT a.* FROM training a JOIN peserta_training b ON a.id = b.training_id WHERE a.project_kode = '$item[project]' AND b.id_data_id = '$id_data_id'")->result_array();
        foreach ($get_training as $item) {
          $get_materi = $this->db->query("SELECT COUNT(*) AS count FROM materi_training WHERE training_id = '$item[id]'")->row_array();
          $get_presensi = $this->db->query("SELECT COUNT(*) AS count FROM presensi_training a JOIN peserta_training b ON a.peserta_training_id = b.id WHERE a.training_id = '$item[id]' AND b.id_data_id = '$id_data_id'")->row_array();

          $nama = ($item['project_kode']) ? $item['project_kode'] : $item['nama_training'];
          if ($get_materi['count'] == $get_presensi['count']) {
            $start_date = $this->db->query("SELECT MIN(tanggal_mulai) AS tanggal_mulai FROM materi_training WHERE training_id = '$item[id]'")->row_array();
            $end_date = $this->db->query("SELECT MAX(tanggal_selesai) AS tanggal_selesai FROM materi_training WHERE training_id = '$item[id]'")->row_array();
            if ($start_date['tanggal_mulai'] && $end_date['tanggal_selesai']) {
              $count = $this->getWorkingDays($start_date['tanggal_mulai'], $end_date['tanggal_selesai'], $holidays);
              $data['training'] += $count;

              $data['detail_training'][$nama] = array('start_date' => $start_date['tanggal_mulai'], 'end_date' => $end_date['tanggal_selesai'], 'ket' => '');
            }
          } else {

            $data['detail_training'][$nama] = array('start_date' => '', 'end_date' => '', 'ket' => "tidak mengikuti semua materi");
          }
        }
      }

      $getPlan = $this->db->query("SELECT * FROM plan WHERE area_head = '$id_data_id' AND kunjungan NOT IN ('051', '052')")->result_array();
      foreach ($getPlan as $item) {
        $getProject = $this->Project_model->getProjectById($item['project']);

        $getQuest = $this->db->query("SELECT a.*, b.validator_time FROM quest a JOIN summary_2 b ON a.project = b.project_kode AND a.cabang = b.cabang_kode AND a.kunjungan = b.sub_kunjungan_kode WHERE a.project = '$item[project]' AND a.cabang = '$item[kode]' AND a.kunjungan = '$item[kunjungan]' AND a.status >= 3 AND b.validator_time BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'")->row_array();

        $getSummary = $this->db->query("SELECT * FROM summary_2 WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND sub_kunjungan_kode = '$item[kunjungan]' AND waktu_upload BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'")->row_array();

        $getNamaCabang = $this->Cabang_model->getDataByKodeAndProject($item['kode'], $item['project']);
        if ($getQuest['validator_time'] > $data['sdm']['tanggal_mulai'] && $getQuest['validator_time'] < $data['sdm']['tanggal_selesai']) {
          $status = "Di dalam tanggal kontrak";
        } else {
          $status = "Di luar tanggal kontrak";
        }

        if ($getQuest) {
          if (strtolower($item['kota']) == strtolower($kota['nm_kota'])) {
            $data['detail_kuesioner_setempat'][$item['no']] = array('kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'project' => $getProject['nama'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama']);
            $data['kuesioner_setempat'] += 1;
          } else {
            $data['detail_kuesioner_lk'][$item['no']] = array('kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'project' => $getProject['nama'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama']);
            $data['kuesioner_lk'] += 1;
          }
        }

        if ($getQuest['validator_time'] && $getSummary['waktu_upload']) {
          if (date_diff(date_create($getQuest['validator_time']), date_create($getSummary['waktu_upload']))->format("%R") == "+") {
            if (date_diff(date_create($getQuest['validator_time']), date_create($getSummary['waktu_upload']))->format("%a") >= 2) {
              $data['detail_penalti_keterlambatan_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
              $data['penalti_keterlambatan_upload'] += 1;
            } else {
              $data['detail_insentif_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
              $data['insentif_upload'] += 1;
            }
          } else {
            $data['detail_insentif_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
            $data['insentif_upload'] += 1;
          }
        };

        $getQuestUlang = $this->db->query("SELECT cabang, project, kunjungan FROM quest_ulang WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]' AND tanggal BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'
        UNION
        SELECT cabang, project, kunjungan FROM quest_do WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]' AND tanggal BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'
        UNION
        SELECT cabang_kode AS cabang, project_kode AS project, kunjungan_kode AS kunjungan FROM summary_2_do WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND kunjungan_kode = '$item[kunjungan]' AND validator_time BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'
        ")->result_array();
        // var_dump($getQuestUlang);
        // die;
        foreach ($getQuestUlang as $gqu) {
          $getNamaCabang = $this->Cabang_model->getDataByKodeAndProject($gqu['cabang'], $gqu['project']);
          $getProject = $this->Project_model->getProjectById($gqu['project']);
          $data['detail_penalti_pengulangan'][$getProject['nama'] . $gqu['kunjungan'] . $gqu['cabang']] = array('project' => $getProject['nama'], 'kjg' => $gqu['kunjungan'], 'cbg' => $gqu['cabang'], 'namacbg' => $getNamaCabang['nama']);
        }
        $countQuestUlang = $this->db->query("SELECT cabang, project, kunjungan FROM quest_ulang WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]' AND tanggal BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'
        UNION
        SELECT cabang, project, kunjungan FROM quest_do WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]' AND tanggal BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'
        UNION
        SELECT cabang_kode AS cabang, project_kode AS project, kunjungan_kode AS kunjungan FROM summary_2_do WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND kunjungan_kode = '$item[kunjungan]' AND validator_time BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'
        ")->num_rows();
        $data['penalti_pengulangan'] += $countQuestUlang;
      }

      $data['insentif_kaderisasi'] = $this->Fieldsdm_model->countInsentifKaderisasi($data['tanggal_mulai'], $data['tanggal_selesai'], $data['sdm']['id']);
      $data['detail_insentif_kaderisasi'] = $this->Fieldsdm_model->getInsentifKaderisasi($data['tanggal_mulai'], $data['tanggal_selesai'], $data['sdm']['id']);

      $today = date('Y-m-d');

      if (($today > $data['sdm']['selesai_kaderisasi']) && $data['sdm']['jumlah_kaderisasi'] != null) {
        $data['penalti_kaderisasi'] = $data['sdm']['jumlah_kaderisasi'] - $data['insentif_kaderisasi'];
      }
      // $data['penalti_kaderisasi'] = $this->Fieldsdm_model->countPenaltiKaderisasi($data['tanggal_mulai'], $data['tanggal_selesai'], $data['sdm']['id'], $data['sdm']['selesai_kaderisasi']);
      // $data['detail_penalti_kaderisasi'] = $this->Fieldsdm_model->getPenaltiKaderisasi($data['tanggal_mulai'], $data['tanggal_selesai'], $data['sdm']['id'], $data['sdm']['selesai_kaderisasi']);


    } else {
      $project = $this->Stkb_model->getProjectByAreaHead($id_data_id, $data['project']);
      $data['namaproject'] = $this->Stkb_model->getprojectbykode($data['project']);

      $data['hari_kerja'] = $this->Fieldsdm_model->countDaftarCabang($id_data_id, $data['project']);
      $data['detail_hari_kerja'] =  $this->Fieldsdm_model->getDetailDaftarCabang($id_data_id, $data['project']);
      foreach ($project as $item) {
        $plan = $this->Projectplan_model->getByProject($item['project']);
        foreach ($plan as $p) {
          $getProject = $this->Project_model->getProjectById($p['project_kode']);
          if ($p['task_id'] == 1 && $p['date_start']) {
            $tanggal_mulai_fieldwork = $p['date_start'];
            $tanggal_selesai_fieldwork = $p['date_finish'];
            if (date_diff(date_create($tanggal_mulai_fieldwork), date_create($data['sdm']['tanggal_mulai']))->format("%R") == "-") {
              $tanggal_mulai = $tanggal_mulai_fieldwork;
            } else {
              $tanggal_mulai = $data['sdm']['tanggal_mulai'];
            }

            if (date_diff(date_create($tanggal_selesai_fieldwork), date_create($data['sdm']['tanggal_selesai']))->format("%R") == "+") {
              $tanggal_selesai = $tanggal_selesai_fieldwork;
            } else {
              $tanggal_selesai = $data['sdm']['tanggal_selesai'];
            }

            $getPlan = $this->db->query("SELECT * FROM plan WHERE area_head = '$id_data_id' AND  project = '$item[project]'  AND kunjungan NOT IN ('051', '052')")->result_array();

            $temp_last_date = null;
            foreach ($getPlan as $gp) {
              $getQuest = $this->db->query("SELECT * FROM quest WHERE project = '$gp[project]' AND cabang = '$gp[kode]' AND kunjungan = '$gp[kunjungan]' AND status >= 3")->row_array();

              if ($temp_last_date) {
                if ($temp_last_date < $getQuest['tanggal']) {
                  $temp_last_date = $getQuest['tanggal'];
                }
              } else {
                $temp_last_date = $getQuest['tanggal'];
              }
            }
            $tanggal_selesai_fieldwork_nextday = date('Y-m-d', strtotime($tanggal_selesai_fieldwork . " +1 days"));

            if ($temp_last_date && $tanggal_selesai_fieldwork) {
              if (date_diff(date_create($temp_last_date), date_create($tanggal_selesai_fieldwork))->format("%R") == "-") {
                $data['detail_penalti_timeline'][$getProject['nama']] = array('last_date' => $temp_last_date, 'tanggal_selesai' => $tanggal_selesai_fieldwork_nextday);

                $data['penalti_timeline'] +=  $this->getWorkingDays($tanggal_selesai_fieldwork_nextday, $temp_last_date, $holidays);
              }
            }
          }
        }

        $get_training = $this->db->query("SELECT a.* FROM training a JOIN peserta_training b ON a.id = b.training_id WHERE a.project_kode = '$item[project]' AND b.id_data_id = '$id_data_id'")->result_array();
        foreach ($get_training as $item) {
          $get_materi = $this->db->query("SELECT COUNT(*) AS count FROM materi_training WHERE training_id = '$item[id]'")->row_array();
          $get_presensi = $this->db->query("SELECT COUNT(*) AS count FROM presensi_training a JOIN peserta_training b ON a.peserta_training_id = b.id WHERE a.training_id = '$item[id]' AND b.id_data_id = '$id_data_id'")->row_array();

          $nama = ($item['project_kode']) ? $item['project_kode'] : $item['nama_training'];
          if ($get_materi['count'] == $get_presensi['count']) {
            $start_date = $this->db->query("SELECT MIN(tanggal_mulai) AS tanggal_mulai FROM materi_training WHERE training_id = '$item[id]'")->row_array();
            $end_date = $this->db->query("SELECT MAX(tanggal_selesai) AS tanggal_selesai FROM materi_training WHERE training_id = '$item[id]'")->row_array();
            if ($start_date['tanggal_mulai'] && $end_date['tanggal_selesai']) {
              $count = $this->getWorkingDays($start_date['tanggal_mulai'], $end_date['tanggal_selesai'], $holidays);
              $data['training'] += $count;

              $data['detail_training'][$nama] = array('start_date' => $start_date['tanggal_mulai'], 'end_date' => $end_date['tanggal_selesai'], 'ket' => '');
            }
          } else {

            $data['detail_training'][$nama] = array('start_date' => '', 'end_date' => '', 'ket' => "tidak mengikuti semua materi");
          }
        }
      }

      $getPlan = $this->db->query("SELECT * FROM plan WHERE area_head = '$id_data_id' AND project = '$data[project]' AND kunjungan NOT IN ('051', '052')")->result_array();
      foreach ($getPlan as $item) {
        $getProject = $this->Project_model->getProjectById($item['project']);

        // $getQuest = $this->db->query("SELECT * FROM quest WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]' AND status >= 3 AND tanggal BETWEEN '$data[tanggal_mulai]' AND '$data[tanggal_selesai]'")->row_array();
        $getQuest = $this->db->query("SELECT a.*, b.validator_time FROM quest a JOIN summary_2 b ON a.project = b.project_kode AND a.cabang = b.cabang_kode AND a.kunjungan = b.sub_kunjungan_kode WHERE a.project = '$item[project]' AND a.cabang = '$item[kode]' AND a.kunjungan = '$item[kunjungan]' AND a.status >= 3")->row_array();

        $getSummary = $this->db->query("SELECT * FROM summary_2 WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND sub_kunjungan_kode = '$item[kunjungan]'")->row_array();

        $getNamaCabang = $this->Cabang_model->getDataByKodeAndProject($item['kode'], $item['project']);
        if ($getQuest['validator_time'] > $data['sdm']['tanggal_mulai'] && $getQuest['validator_time'] < $data['sdm']['tanggal_selesai']) {
          $status = "Di dalam tanggal kontrak";
        } else {
          $status = "Di luar tanggal kontrak";
        }

        if ($getQuest) {
          if (strtolower($item['kota']) == strtolower($kota['nm_kota'])) {
            $data['detail_kuesioner_setempat'][$item['no']] = array('kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'project' => $getProject['nama'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama']);
            $data['kuesioner_setempat'] += 1;
          } else {
            $data['detail_kuesioner_lk'][$item['no']] = array('kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'project' => $getProject['nama'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama']);
            $data['kuesioner_lk'] += 1;
          }
        }

        if ($getQuest['validator_time'] && $getSummary['waktu_upload']) {
          if (date_diff(date_create($getQuest['validator_time']), date_create($getSummary['waktu_upload']))->format("%R") == "+") {
            if (date_diff(date_create($getQuest['validator_time']), date_create($getSummary['waktu_upload']))->format("%a") >= 2) {
              $data['detail_penalti_keterlambatan_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
              $data['penalti_keterlambatan_upload'] += 1;
            } else {
              $data['detail_insentif_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
              $data['insentif_upload'] += 1;
            }
          } else {
            $data['detail_insentif_upload'][$getQuest['num']] = array('project' => $getProject['nama'], 'kjg' => $item['kunjungan'], 'cbg' => $item['kode'], 'tgl' => $getQuest['validator_time'], 'status' => $status, 'namacbg' => $getNamaCabang['nama'], 'tgl_upload' => $getSummary['waktu_upload']);
            $data['insentif_upload'] += 1;
          }
        };

        $getQuestUlang = $this->db->query("SELECT cabang, project, kunjungan FROM quest_ulang WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]'
        UNION
        SELECT cabang, project, kunjungan FROM quest_do WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]'
        UNION
        SELECT cabang_kode AS cabang, project_kode AS project, sub_kunjungan_kode AS kunjungan FROM summary_2_do WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND sub_kunjungan_kode = '$item[kunjungan]'
        GROUP BY cabang, project, kunjungan")->result_array();

        foreach ($getQuestUlang as $gqu) {
          $getNamaCabang = $this->Cabang_model->getDataByKodeAndProject($gqu['cabang'], $gqu['project']);
          $getProject = $this->Project_model->getProjectById($gqu['project']);
          $data['detail_penalti_pengulangan'][$getProject['nama'] . $gqu['kunjungan'] . $gqu['cabang']] = array('project' => $getProject['nama'], 'kjg' => $gqu['kunjungan'], 'cbg' => $gqu['cabang'], 'namacbg' => $getNamaCabang['nama']);
        }
        $countQuestUlang = $this->db->query("SELECT cabang, project, kunjungan FROM quest_ulang WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]'
        UNION
        SELECT cabang, project, kunjungan FROM quest_do WHERE project = '$item[project]' AND cabang = '$item[kode]' AND kunjungan = '$item[kunjungan]'
        UNION
        SELECT cabang_kode AS cabang, project_kode AS project, sub_kunjungan_kode AS kunjungan FROM summary_2_do WHERE project_kode = '$item[project]' AND cabang_kode = '$item[kode]' AND sub_kunjungan_kode = '$item[kunjungan]'
        ")->num_rows();
        // var_dump($countQuestUlang);
        // die;
        $data['penalti_pengulangan'] += $countQuestUlang;
      }

      $data['insentif_kaderisasi'] = $this->Fieldsdm_model->countInsentifKaderisasi(null, null, $data['sdm']['id']);
      // $data['insentif_kaderisasi'] = 3;
      // $data['insentif_upload'] = 3;
      // $data['detail_insentif_kaderisasi'] = $this->Fieldsdm_model->getInsentifKaderisasi($data['tanggal_mulai'], $data['tanggal_selesai'], $data['sdm']['id']);

    }

    $this->load->view('templates/header', $data);
    $this->load->view('stkb/field_sdm/print', $data);
    $this->load->view('templates/footer');
  }

  public function get_daftar_cabang()
  {
    $data = $this->Fieldsdm_model->getDaftarCabang($this->input->post('id_data_id'));

    $id = $this->input->post('id_data_id');
    $kode_project = $this->input->post('project');
    $html = '';

    if ($kode_project) {
      $project = $this->db->query("SELECT a.*, b.nama FROM plan a JOIN project b ON b.kode = a.project WHERE a.area_head = '$id' AND a.project = '$kode_project' GROUP BY a.project")->result_array();
    } else {
      $project = $this->db->query("SELECT a.*, b.nama FROM plan a JOIN project b ON b.kode = a.project WHERE a.area_head = '$id' GROUP BY a.project")->result_array();
    }
    foreach ($project as $item) {
      $count = 0;
      $averageProgress = 0;
      $getStkb = $this->db->query("SELECT * FROM plan WHERE area_head = '$id' AND project = '$item[project]' GROUP BY nomorstkb")->result_array();
      foreach ($getStkb as $stkb) {
        $progressnya = 0;
        $count++;
        $cabang = $this->db->query("SELECT * FROM plan WHERE area_head = '$id' AND project = '$item[project]' AND nomorstkb = '$stkb[nomorstkb]' GROUP BY kode")->result_array();
        $x = 1;
        $length = count($cabang);

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
            // echo 'NILAI P1 = '.$nilaiP1.'<br>';
            // echo 'JML KUNJUNGANNYA = '.$jmlKunjungan.'<br><br>';
          }
          $progressnya = $nilaiP1 / $jmlKunjungan;
          // echo $nilaiP1.'/'.$jmlKunjungan.'<br>';
          // echo json_encode($progressnya);
        } else {
          $progressnya = 0;
        }

        $html .= '
        <div class="row">
              <div class="col-lg-3">
                <p>' . $item['nama'] . '</p>
              </div>
              <div class="col-lg-2">
                <p>' . $stkb['nomorstkb'] . '</p>
              </div>
              <div class="col-lg-3">
                <p>';

        foreach ($cabang as $c) {
          $html .= $c['kode'];
          if ($x++ != $length)
            $html .= ', ';
        }

        $html .= '</p>
              </div>
              <div class="col-lg-2">
                <p>' . number_format((float)$progressnya, 2, '.', '') . '%</p>
              </div>
            </div>';
        $averageProgress += $progressnya;
      }

      $finalProgress = number_format((float)($averageProgress / $count), 2, '.', '');

      $html .= '
      <hr style = "border-top: 1px dotted black">
            <div class="row">
              <div class="col-lg-4">
  
              </div>
              <div class="col-lg-4">
                <p><b>Rata-rata progress</b></p>
              </div>
              <div class="col-lg-2">
                <p>' . $finalProgress . '%</p>
              </div>
              
              <div class="col-lg-2">
                <p>
                ';
      if (($averageProgress / $count) >= 0) {
        $html .= '<button type="submit" class="btn btn-primary submit-sdm-mitra" data-id_data_id="' . $id . '" data-project="' . $item['project'] . '" data-progress="' . $finalProgress . '" data-nomorstkb="' . $stkb['nomorstkb'] . '">Print</button>';
      }

      $html .= '</p>
              </div>
            </div>
            <hr>
      ';
    }

    echo $html;
  }

  public function training()
  {

    $data['judul'] = "Field || Training";
    $data['training'] = $this->Training_model->get_all_training();

    $data['project'] = $this->db->query("SELECT * FROM project")->result_array();
    $data['jenis_training'] = $this->db->query("SELECT * FROM jenis_training")->result_array();
    $data['field_sdm'] = $this->Fieldsdm_model->getAllData();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/training/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_training()
  {
    date_default_timezone_set('Asia/Jakarta');

    $insert = $this->Training_model->tambah_training();

    if ($insert) {
      $this->session->set_flashdata('flash', 'Berhasil Menambah Data');
      redirect('stkb/training');
    } else {
    ?>
      <script>
        window.alert('Gagal Menambah Data');
        window.location = '<?php echo site_url('stkb/training') ?>';
      </script>;
    <?php
    }
  }

  public function edit_training()
  {
    $this->Training_model->edit_training();

    $this->session->set_flashdata('flash', 'Berhasil Diubah');
    redirect('stkb/training');
  }

  public function hapus_training($id)
  {
    $this->Training_model->hapus_training($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect('stkb/training');
  }

  public function tambah_honor_training()
  {
    date_default_timezone_set('Asia/Jakarta');

    $insert = $this->Training_model->tambah_honor_training();

    if ($insert) {
      $this->session->set_flashdata('flash', 'Berhasil Menambah Data');
      redirect('stkb/training');
    } else {
    ?>
      <script>
        window.alert('Gagal Menambah Data');
        window.location = '<?php echo site_url('stkb/training') ?>';
      </script>;
    <?php
    }
  }

  public function get_data_honor_training()
  {
    $training_id = $this->input->post('training_id');
    $data = $this->db->query("SELECT * FROM honor_training WHERE training_id = '$training_id'")->result_array();

    echo json_encode($data);
  }

  public function upload_file_training()
  {

    date_default_timezone_set('Asia/Jakarta');

    $insert = $this->Training_model->upload_file();

    if ($insert) {
      $this->session->set_flashdata('flash', 'Berhasil Menambah Data');
      redirect('stkb/training');
    } else {
    ?>
      <script>
        window.alert('Gagal Menambah Data');
        window.location = '<?php echo site_url('stkb/training') ?>';
      </script>;
    <?php
    }
  }

  public function tambah_peserta()
  {
    $this->Training_model->tambah_peserta_training();

    $data = $this->Training_model->get_peserta_training_by_training_id($this->input->post('training_id'));

    $no = 1;
    $html = '
    <div class="table-responsive">
    <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
        <thead>
            <tr bgcolor="#F0FFF0">
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody?>';
    foreach ($data as $item) {
      $html .= '
        <tr>
          <td>' . $no++ . '</td>
          <td>' . $item['Nama'] . '</td>
          <td><a href="javascript:;" class="btn-danger btn-sm btn-hapus-peserta" data-id="' . $item['id'] . '" data-training_id="' . $item['training_id'] . '">
          <i class="fa fa-trash"></i> Hapus</a></td>
        </tr>
      ';
    }
    $html .= '
      </tbody>
      </table>
      </div>
    ';
    echo ($html);
  }

  public function get_peserta()
  {
    $data = $this->Training_model->get_peserta_training_by_training_id($this->input->post('training_id'));

    $no = 1;
    $html = '
    <div class="table-responsive">
    <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
        <thead>
            <tr bgcolor="#F0FFF0">
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody?>';
    foreach ($data as $item) {
      $html .= '
        <tr>
          <td>' . $no++ . '</td>
          <td>' . $item['Nama'] . '</td>
          <td><a href="javascript:;" class="btn-danger btn-sm btn-hapus-peserta" data-id="' . $item['id'] . '" data-training_id="' . $item['training_id'] . '">
          <i class="fa fa-trash"></i> Hapus</a></td>
        </tr>
      ';
    }
    $html .= '
      </tbody>
      </table>
      </div>
    ';
    echo ($html);
  }

  public function hapus_peserta()
  {
    $this->Training_model->hapus_peserta_training($this->input->post('id'));

    $data = $this->Training_model->get_peserta_training_by_training_id($this->input->post('training_id'));

    $no = 1;
    $html = '
    <div class="table-responsive">
    <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
        <thead>
            <tr bgcolor="#F0FFF0">
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody?>';
    foreach ($data as $item) {
      $html .= '
        <tr>
          <td>' . $no++ . '</td>
          <td>' . $item['Nama'] . '</td>
          <td><a href="javascript:;" class="btn-danger btn-sm btn-hapus-peserta" data-id="' . $item['id'] . '" data-training_id="' . $item['training_id'] . '">
          <i class="fa fa-trash"></i> Hapus</a></td>
        </tr>
      ';
    }
    $html .= '
      </tbody>
      </table>
      </div>
    ';
    echo ($html);
  }

  public function materi_pelatihan($id)
  {
    $data['judul'] = "Field || Training";
    $data['materi_training'] = $this->Training_model->get_materi_training_by_training_id($id);
    $data['training_id'] = $id;
    $data['training'] = $this->Training_model->get_training_by_id($id);
    $data['pemateri'] = $this->Training_model->get_pemateri();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/training/materi/index', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_materi_training()
  {
    date_default_timezone_set('Asia/Jakarta');
    $id = $this->input->post('training_id');

    $insert = $this->Training_model->tambah_materi_training();

    if ($insert) {
      $this->session->set_flashdata('flash', 'Berhasil Menambah Data');
      redirect("stkb/materi_pelatihan/$id");
    } else {
    ?>
      <script>
        window.alert('Gagal Menambah Data');
        window.location = '<?php echo site_url("stkb/materi_pelatihan/$id") ?>';
      </script>;
<?php
    }
  }

  public function edit_materi_training()
  {
    $id = $this->input->post('training_id');
    $this->Training_model->edit_materi_training();

    $this->session->set_flashdata('flash', 'Berhasil Diubah');
    redirect("stkb/materi_pelatihan/$id");
  }

  public function hapus_materi_training($id, $training_id)
  {
    $this->Training_model->hapus_materi_training($id);
    $this->session->set_flashdata('flash', 'Dihapus');
    redirect("stkb/materi_pelatihan/$training_id");
  }

  public function presensi_materi_training()
  {
    $training_id = $this->input->post('training_id');
    $materi_id = $this->input->post('id');
    $data = $this->Training_model->get_peserta_training_by_training_id($training_id);

    $get_peserta = $this->Training_model->get_checked_peserta_by_training_id_and_materi_id($training_id, $materi_id);

    $arr_peserta = [];
    foreach ($get_peserta as $row) {
      array_push($arr_peserta, $row['peserta_training_id']);
    }

    echo $this->list_peserta_with_checkbox($data, $materi_id, $arr_peserta);
  }

  public function update_presensi_materi_training()
  {
    $training_id = $this->input->post('training_id');
    $materi_id = $this->input->post('materi_id');

    $update = $this->Training_model->insert_presensi_training();

    $data = $this->Training_model->get_peserta_training_by_training_id($training_id);

    $get_peserta = $this->Training_model->get_checked_peserta_by_training_id_and_materi_id($training_id, $materi_id);

    $arr_peserta = [];
    foreach ($get_peserta as $row) {
      array_push($arr_peserta, $row['peserta_training_id']);
    }

    echo $this->list_peserta_with_checkbox($data, $materi_id, $arr_peserta);
  }

  private function list_peserta_with_checkbox($data, $materi_id, $arr_peserta)
  {
    $no = 1;
    $html = '
    <div class="table-responsive">
    <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
        <thead>
            <tr bgcolor="#F0FFF0">
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
    foreach ($data as $item) {
      $html .= '
        <tr>
          <td>' . $no++ . '</td>
          <td>' . $item['Nama'] . '</td>
          <td>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input checkbox-presensi" data-materi_id="' . $materi_id . '" data-training_id="' . $item['training_id'] . '" data-peserta_id="' . $item['id'] . '" ' . ((in_array($item['id'], $arr_peserta)) ? 'checked' : '') . '>
            </div>
        </td>
        </tr>
      ';
    }
    $html .= '
      </tbody>
      </table>
      </div>
    ';

    echo $html;
  }

  public function ajukan_training()
  {
    $training_id = $this->input->post('training_id');
    $update = $this->db->query("UPDATE training SET status_pengajuan = 1 WHERE id = '$training_id'");

    $data = $this->Training_model->get_materi_training_by_training_id($training_id);
    $data_budget = $this->Training_model->get_honor_by_training_id($training_id);

    $this->load->library('email');
    $config = configEmail();
    $message = '
    <p> Training sudah diajukan dengan detail materi dan budget dibawah ini: </p>
    <br>
    <h3>Detail Materi</h3>
    <table style="border:1px solid black;border-collapse:collapse;">
      <thead>
        <tr>
          <th style="border:1px solid black;">No</th>
          <th style="border:1px solid black;">Materi</th>
          <th style="border:1px solid black;">Pengisi Materi</th>
          <th style="border:1px solid black;">Tanggal Mulai</th>
          <th style="border:1px solid black;">Jam Mulai</th>
          <th style="border:1px solid black;">Tanggal Selesai</th>
          <th style="border:1px solid black;">Jam Selesai</th>
      </tr>
      </thead>
      <tbody>
      ';

    $no = 1;
    foreach ($data as $item) {
      $message .= '
      <tr>
        <td style="border:1px solid black;"> '  . $no++ . '</td>
        <td style="border:1px solid black;"> '  . $item['materi'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['name'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['tanggal_mulai'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['jam_mulai'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['tanggal_selesai'] . ' </td>
        <td style="border:1px solid black;"> '  . $item['jam_selesai'] . ' </td>
      </tr>
      ';
    }

    $message .= '
    </tbody>
    </table>
    <br>

    <h3>Detail Budget</h3>
    <table style="border:1px solid black;border-collapse:collapse;">
      <thead>
        <tr>
          <th style="border:1px solid black;">No</th>
          <th style="border:1px solid black;">Nama Honor</th>
          <th style="border:1px solid black;">Nominal</th>
      </tr>
      </thead>
      <tbody>';

    $no = 1;
    $total = 0;
    foreach ($data_budget as $item) {
      $total += $item['nominal_honor'];
      $message .= '
        <tr>
          <td style="border:1px solid black;"> '  . $no++ . '</td>
          <td style="border:1px solid black;"> '  . $item['nama_honor'] . ' </td>
          <td style="border:1px solid black;"> '  . $item['nominal_honor'] . ' </td>
        </tr>
        ';
    }

    $message .= '
    </tbody>
    </table>
    <br>
    <b>Total Budget: Rp. ' . number_format($total) . '
    <br>
    <br>';

    if ($this->input->post('keterangan')) {
      $message .= "Keterangan tambahan: " . $this->input->post('keterangan');
    }

    $message .= '
    <br>
    <br>
      <a href="' . base_url('pengajuan/setuju_training/' . $training_id) . '" onclick="return confirm(' . 'Anda yakin ingin menyetujui training?' . ')"><p style="color:#08d43b;font-weight:bold;">Klik disini untuk setujui pengajuan</p></a><br>
      <a href="' . base_url('pengajuan/tolak_training/' . $training_id) . '" onclick="return confirm(' . 'Anda yakin ingin menyetujui training?' . ')><p style="color:#d42a08;font-weight:bold;">Klik disini untuk tolak pengajuan</p></a><br><br>
      <p>Jika link diatas tidak dapat di akses, silahkan <a href="' . base_url('stkb/training') . '">Klik disini</a>.</p>
      <p style="font-size:12px;">Email ini dikirim otomatis melalui Aplikasi Operation 2.</p>
    ';
    // echo json_encode($message); die;
    $this->email->initialize($config);
    $namaPengirim = 'Marketing MRI';
    $emailPengirim = 'otomatis@mri-research-ind.com';
    // $emailPenerima = 'manajemen@mri-research-ind.com';
    $getUser = $this->db->query("SELECT * FROM user WHERE jabatan = 'RM' OR jabatan = 'Management'")->result_array();
    $emailPenerima = [];
    $namaPenerima = [];
    foreach ($getUser as $item) {
      array_push($emailPenerima, $item['email']);
      array_push($namaPenerima, $item['nama']);
    }

    $this->email->from($emailPengirim, $namaPengirim);
    $this->email->subject('Pengajuan Training');
    // $this->email->set_header('Cc', 'mri.marketing@mri-research-ind.com');
    $this->email->to($emailPenerima, $namaPenerima);
    $this->email->message($message);
    // $this->email->send(FALSE);
    if ($this->email->send()) {
      $this->session->set_flashdata('flash', 'Berhasil Diubah');
      redirect("stkb/training");
    } else {
      echo ('Data gagal diajukan');
    }
  }

  public function get_training_email_receiver()
  {
    $training = $this->Training_model->get_training_by_id($_POST['training_id']);
    $getUser = $this->db->query("SELECT * FROM user WHERE jabatan = 'RM' OR jabatan = 'Management'")->result_array();
    $emailPenerima = [];
    $namaPenerima = [];
    $html = 'Anda yakin ingin mengajukan approval training ' . $training['nama_project'] . ' ke ';
    foreach ($getUser as $item) {
      array_push($emailPenerima, $item['email']);
      array_push($namaPenerima, $item['name']);
    }

    for ($i = 0; $i < count($emailPenerima); $i++) {
      $html .= $namaPenerima[$i] . '(' . $emailPenerima[$i] . ')';
      if ($i < count($emailPenerima) - 1) {
        $html .= ', ';
      } else {
        $html .= '.';
      }
    }
    echo $html;
  }

  private function getWorkingDays($startDate, $endDate, $holidays)
  {
    // do strtotime calculations just once
    $endDate = strtotime($endDate);
    $startDate = strtotime($startDate);


    //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
    //We add one to inlude both dates in the interval.
    $days = ($endDate - $startDate) / 86400 + 1;

    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);

    //It will return 1 if it's Monday,.. ,7 for Sunday
    $the_first_day_of_week = date("N", $startDate);
    $the_last_day_of_week = date("N", $endDate);

    //---->The two can be equal in leap years when february has 29 days, the equal sign is added here
    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
    if ($the_first_day_of_week <= $the_last_day_of_week) {
      if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
      if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
    } else {
      // (edit by Tokes to fix an edge case where the start day was a Sunday
      // and the end day was NOT a Saturday)

      // the day of the week for start is later than the day of the week for end
      if ($the_first_day_of_week == 7) {
        // if the start date is a Sunday, then we definitely subtract 1 day
        $no_remaining_days--;

        if ($the_last_day_of_week == 6) {
          // if the end date is a Saturday, then we subtract another day
          $no_remaining_days--;
        }
      } else {
        // the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
        // so we skip an entire weekend and subtract 2 days
        $no_remaining_days -= 2;
      }
    }

    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
    //---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
    $workingDays = $no_full_weeks * 5;
    if ($no_remaining_days > 0) {
      $workingDays += $no_remaining_days;
    }

    //We subtract the holidays
    foreach ($holidays as $holiday) {
      $time_stamp = strtotime($holiday);
      //If the holiday doesn't fall in weekend
      if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N", $time_stamp) != 6 && date("N", $time_stamp) != 7)
        $workingDays--;
    }

//	var_dump($workingDays);

    return $workingDays;
  }
}
