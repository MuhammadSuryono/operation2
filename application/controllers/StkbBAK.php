<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StkbBAK extends CI_Controller
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

    $this->load->model('Stkb_model');
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
  public function masterplan()
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

  public function getkotaproject()
  {
    $id = $_POST['id'];
    $cekatmbukan = $this->Stkb_model->getatmataubukan($id);

    // TAMBAHAN ADAM SANTOSO => JIKA SKENARIO APAKAH KE ATM ATAU CABANG AMBIL DATA DARI SALAH SATU
    if ($cekatmbukan) {
      $data = $this->Stkb_model->getkotaatm($id);
      echo json_encode($data);
    } else {
      $data = $this->Stkb_model->getkotaproject($id);
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

  public function kotakab()
  {
    $data['judul'] = "STKB || Kabupaten Kota";
    $data['getallkotakab'] = $this->Stkb_model->allkotakab();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('stkb/kotakab/index', $data);
    $this->load->view('templates/footer');
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
  /******* //Controller STKB Master Plan ********/

  /****** Controller STKB Tracking ******/
  public function tracking()
  {
    $data['judul'] = "STKB || Tracking";
    $data['gettracking'] = $this->Stkb_model->getalldatatracking();
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
    $data['judul'] = "STKB || Pengajuan";
    //$data['getpengajuan'] = $this->Stkb_model->getallpengajuan();
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
  public function getAllDataTabByAdam(){ error_reporting(0);
    $tab = $_POST['data'];
    $id_user = $this->session->userdata('id_user');
    if($this->db->get_where('user', ['noid' => $id_user])->num_rows()>=1){
      $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
    } else {
      $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
    }
    $data['user'] = $user;
    if($tab == '#term1'){
      $this->load->view('stkb/pengajuan/tab/term1', $data);
    }else if($tab == '#term2'){
      $this->load->view('stkb/pengajuan/tab/term2', $data);
    }else if($tab == '#term3'){
      $this->load->view('stkb/pengajuan/tab/term3', $data);
    }else if($tab == '#menu1'){
      $this->load->view('stkb/pengajuan/tab/menu1', $data);
    }else if($tab == '#menu2'){
      $this->load->view('stkb/pengajuan/tab/menu2', $data);
    }
  }
  public function getAllJSONDataTabByAdam($tab){ error_reporting(0);
    $this->load->library('datatables');
    // $this->load->model('Stkb_model2');
    header('Content-Type: application/json');
    if($tab == 'term1'){
      echo $this->Stkb_model->getallpengajuanByAdam();
    }else if($tab == 'term2'){
      echo $this->Stkb_model->getallterm2ByAdam();
    }else if($tab == 'term3'){
      echo $this->Stkb_model->getallterm3ByAdam();
    }else if($tab == 'menu1'){
      echo $this->Stkb_model->getallmenu1ByAdam();
    }else if($tab == 'menu2'){
      echo $this->Stkb_model->getallmenu2ByAdam();
    }else if($tab == 'coba'){
      echo $this->Stkb_model->getallcobaByAdam();
    }
  }

  public function readytopaid()
  { ini_set('max_execution_time', '0');
    $db2 = $this->load->database('database_kedua', TRUE);
    $db3 = $this->load->database('database_ketiga', TRUE);
    $insert = [];

    foreach ($_POST['statusbayar'] as $key => $status) {
      $term = $this->input->post("term$status");
      if ($term == 'Term 1') {
        $trm = 1;
      }
      if ($term == 'Term 2') {
        $trm = 2;
      }
      if ($term == 'Term 3') {
        $trm = 3;
      }

      $data = [
        'nomorstkb' => $this->input->post("nomorstkb$status"),
        "term" => $trm,
        "tanggalbuat" => $this->input->post("tanggalbuat$status"),
        "kodeproject" => $this->input->post("kodeproject$status"),
        "idpic" => $this->input->post("idpic$status"),
        "perdin" => $this->input->post("perdin$status"),
        "akomodasi" => $this->input->post("akomodasi$status"),
        "bpjs" => $this->input->post("bpjs$status"),
        "jumlahops" => $this->input->post("jumlahops$status"),
        "jumlahtrk" => $this->input->post("jumlahtrk$status"),
        "total" => $this->input->post("total$status"),
        "statusbayar" => "RTP",
      ];

      // array_push($data, $insert);
      array_push($insert, $data);

      $nomorstkb = $this->input->post("nomorstkb$status");
      $term = $trm;
      $tanggalbuat = $this->input->post("tanggalbuat$status");
      $kodeproject = $this->input->post("kodeproject$status");
      $idpic = $this->input->post("idpic$status");
      $perdin = $this->input->post("perdin$status");
      $akomodasi = $this->input->post("akomodasi$status");
      $bpjs = $this->input->post("bpjs$status");
      $jumlahops = $this->input->post("jumlahops$status");
      $jumlahtrk = $this->input->post("jumlahtrk$status");
      $total = $this->input->post("total$status");
      $statusbayar = "RTP";

      // Masuk budget Online
      $kodepro = $this->input->post("kodeproject$status");
      $caribudget = $db3->query("SELECT * FROM pengajuan WHERE kodeproject='$kodepro'")->row_array();

      $waktubudget = $caribudget['waktu'];

      $cariops = $db3->query("SELECT * FROM selesai WHERE status='STKB OPS' AND waktu='$waktubudget'")->row_array();

      $noselops = $cariops['no'];

      $maxbpuops = $db3->query("SELECT max(term) AS maxt FROM bpu WHERE waktu='$waktubudget' AND no='$noselops'")->row_array();
      $opsterm = $maxbpuops['maxt'] + 1;

      $db3->query("INSERT INTO bpu (no,jumlah,tglcair,namabank,norek,namapenerima,pengaju,divisi,waktu,status,persetujuan,jumlahbayar,novoucher,tanggalbayar,pembayar,divpemb,term,nomorstkb)
                                      VALUES
                                      ('$noselops','$jumlahops','0000-00-00','-','-','TLF','Sistem','Sistem','$waktubudget','Belum Di Bayar','Disetujui (Direksi)','0','','','','','$opsterm','$nomorstkb')");


      $carijakorluar = $db2->query("SELECT kotadinas FROM stkb_ops WHERE nomorstkb='$nomorstkb'")->row_array();

      if ($carijakorluar['kotadinas'] == 'Jakarta' || $carijakorluar['kotadinas'] == 'Bogor' || $carijakorluar['kotadinas'] == 'Depok') {

        $caritrkjak = $db3->query("SELECT * FROM selesai WHERE status='STKB TRK Jakarta' AND waktu='$waktubudget'")->row_array();

        $noseltrkjak = $caritrkjak['no'];

        $maxbputrkjak = $db3->query("SELECT max(term) AS maxt FROM bpu WHERE waktu='$waktubudget' AND no='$noseltrkjak'")->row_array();
        $trkjakterm = $maxbputrkjak['maxt'] + 1;

        $db3->query("INSERT INTO bpu (no,jumlah,tglcair,namabank,norek,namapenerima,pengaju,divisi,waktu,status,persetujuan,jumlahbayar,novoucher,tanggalbayar,pembayar,divpemb,term,nomorstkb)
                                        VALUES
                                        ('$noseltrkjak','$jumlahtrk','0000-00-00','-','-','TLF','Sistem','Sistem','$waktubudget','Belum Di Bayar','Disetujui (Direksi)','0','','','','','$trkjakterm','$nomorstkb')");
      } else {

        $caritrkluar = $db3->query("SELECT * FROM selesai WHERE status='STKB TRK Luar Kota' AND waktu='$waktubudget'")->row_array();

        $noseltrkluar = $caritrkluar['no'];

        $maxbputrkluar = $db3->query("SELECT max(term) AS maxt FROM bpu WHERE waktu='$waktubudget' AND no='$noseltrkluar'")->row_array();
        $trkluarterm = $maxbputrkluar['maxt'] + 1;

        $db3->query("INSERT INTO bpu (no,jumlah,tglcair,namabank,norek,namapenerima,pengaju,divisi,waktu,status,persetujuan,jumlahbayar,novoucher,tanggalbayar,pembayar,divpemb,term,nomorstkb)
                                        VALUES
                                        ('$noseltrkluar','$jumlahtrk','0000-00-00','-','-','TLF','Sistem','Sistem','$waktubudget','Belum Di Bayar','Disetujui (Direksi)','0','','','','','$trkluarterm','$nomorstkb')");
      }
      //Masuk Budget Online

      //TAMBAHAN ADAM SANTOSO
      if($trm == 1){
        $totalbankstkb = $this->db->query("SELECT a.project FROM plan a LEFT JOIN cabang y ON a.project = y.project LEFT JOIN atmcenter z ON a.project = z.project WHERE (a.kode = y.kode OR a.kode = z.cabang) AND a.nomorstkb = '$nomorstkb' GROUP BY y.kodebank, z.kodebank")->num_rows();
        $data['printtrk'] = $this->Stkb_model->getprinttrk($nomorstkb, $totalbankstkb);
        foreach ($data['printtrk'] as $project) {
          if($totalbankstkb > 1){
            $kodebank = $project['kodebank'];
          }else{
            $cek = $this->db->query("SELECT IF(y.kodebank IS NOT NULL,y.kodebank,z.kodebank) AS kodebank FROM plan a LEFT JOIN cabang y ON a.project = y.project LEFT JOIN atmcenter z ON a.project = z.project WHERE (a.kode = y.kode OR a.kode = z.cabang) AND a.nomorstkb = '$nomorstkb' AND (y.kodebank = y.kodebank OR z.kodebank = z.kodebank) GROUP BY y.kodebank, z.kodebank")->row_array();
            if($cek['kodebank'] == NULL){
              $kode = $this->db->query("SELECT bank FROM project WHERE kode = '$project[kodeproject]'")->row_array();
              $kodebank = $kode['bank'];
            }else{
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
        // KODEINGAN LAMA SEBELUM 2 BANK BERBEDA //
        // $getOneProject = $this->db->query("SELECT * FROM stkb1project WHERE kodeproject = '$kodeproject'")->result_array();
        // $kode = $this->db->query("SELECT bank FROM project WHERE kode = '$kodeproject'")->row_array();
        // foreach ($getOneProject as $project) {
        //   $jml = $this->db->query("SELECT harga FROM stkb_dasar_trk WHERE kodebank = '$kode[bank]' AND kodeskenario = '$project[skenario]'")->row_array();
        //   $dataProject = array(
        //     'nostkb' => $nomorstkb,
        //     'kodeproject' => $project['kodeproject'],
        //     'skenario' => $project['skenario'],
        //     'jumlah' => $project['jumlah'],
        //     'kunjungan' => $project['kunjungan'],
        //     'harga' => $jml['harga']
        //   );
        //   $db2->insert('stkb1project_final', $dataProject);
        //   $dataProject = array();
        // }
        // ========= //
      }

      $data = [];

    }

    $db2->insert_batch('stkb_pembayaran', $insert);
    $this->session->set_flashdata('flash', 'STKB Berhasil Pindah Ke RTP');
    redirect("stkb/pengajuan");
  }

  public function bayarstkb()
  {
    $this->Stkb_model->prosesbayarstkb();
    $this->session->set_flashdata('flash', 'STKB Berhasil Dibayar');
    redirect("stkb/pengajuan");
  }
  /****** //Controller STKB Pengajuan ******/

  public function printstkb($nomorstkb, $term)
  { ini_set('max_execution_time', '0');
    $data['judul'] = "STKB || Print STKB";
    $kp = $this->db->query("SELECT project FROM stkb_ops WHERE nomorstkb = '$nomorstkb'")->row_array();
    $cekBayar = $this->db->query("SELECT tanggalbayar FROM stkb_pembayaran WHERE nomorstkb ='$nomorstkb' AND term ='1'")->result_array();
    // CARI APAKAH NOMORSTKB INI MERUPAKAN ATM CENTER = 1 / NON ATM CENTER = 0
    $data['cekatmbukan'] = $this->db->query("SELECT project FROM plan WHERE nomorstkb = '$nomorstkb' AND kunjungan IN ('064','065','066','067') GROUP BY nomorstkb,kunjungan")->num_rows();
    // ==== //
    // HITUNG JUMLAH BANK BERDASARKAN KODE BANK DI TABEL ATMCENTER/CABANG DALAM SATU STKB
    if($data['cekatmbukan'] == 1){
      $data['totalbankstkb'] = $this->db->query("SELECT a.project FROM plan a JOIN atmcenter z ON a.project = z.project WHERE a.kode = z.cabang AND a.nomorstkb = '$nomorstkb' GROUP BY z.kodebank")->num_rows();
    }else{
      $data['totalbankstkb'] = $this->db->query("SELECT a.project FROM plan a JOIN cabang y ON a.project = y.project WHERE a.kode = y.kode AND a.nomorstkb = '$nomorstkb' GROUP BY y.kodebank")->num_rows();
    }
    // ==== //
    if(count($cekBayar) > 0){
      $cek = $this->Stkb_model->getprinttrk_final($nomorstkb, $data['totalbankstkb']);
      if(count($cek) > 0){
        $data['printtrk'] = $cek;
                    if($data['totalbankstkb'] > 1){ // TOTAL BANK LEBIH DARI 1
                      $data['printtrk'] = $this->Stkb_model->triggerGetPrintTRK($data['printtrk'], $data['totalbankstkb']);
                    }
      }else{
        // INSERT KE 1 PROJECT FINAL DARI DATA 1 PROJECT LAMA JIKA DATA STKB BELUM ADA DI 1 PROJECT FINAL
        $data['printtrk'] = $this->Stkb_model->getprinttrk($nomorstkb, $data['totalbankstkb']);
        foreach ($data['printtrk'] as $project) {
          if($data['totalbankstkb'] > 1){
            $kodebank = $project['kodebank'];
          }else{
            $cek = $this->db->query("SELECT IF(y.kodebank IS NOT NULL,y.kodebank,z.kodebank) AS kodebank FROM plan a LEFT JOIN cabang y ON a.project = y.project LEFT JOIN atmcenter z ON a.project = z.project WHERE (a.kode = y.kode OR a.kode = z.cabang) AND a.nomorstkb = '$nomorstkb' AND (y.kodebank = y.kodebank OR z.kodebank = z.kodebank) GROUP BY y.kodebank, z.kodebank")->row_array();
            if($cek['kodebank'] == NULL){
              $kode = $this->db->query("SELECT bank FROM project WHERE kode = '$project[kodeproject]'")->row_array();
              $kodebank = $kode['bank'];
            }else{
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
        if($data['totalbankstkb'] > 1){ // TOTAL BANK LEBIH DARI 1
          $data['printtrk'] = $this->Stkb_model->triggerGetPrintTRK($data['printtrk'], $data['totalbankstkb']);
        }

      }
      $data['rtpStatus'] = true; // READY TO PAID STATUS
    }else{
      $this->Stkb_model->updateoneprojecttostkb($kp['project']); // TRIGGER UNTUK UPDATE 1 PROJECT KE STKB_TRK SESUAI KODE PROJEK
      $data['printtrk'] = $this->Stkb_model->getprinttrk($nomorstkb, $data['totalbankstkb']);
                  if($data['totalbankstkb'] > 1){ // TOTAL BANK LEBIH DARI 1
                    $data['printtrk'] = $this->Stkb_model->triggerGetPrintTRK($data['printtrk'], $data['totalbankstkb']);
                  }
      $data['rtpStatus'] = false; // READY TO PAID STATUS
    }
    $data['allprint'] = $this->Stkb_model->getallprint($nomorstkb, $term);


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

  public function printstkb2($nomorstkb)
  { ini_set('max_execution_time', '0');
    $getprint = $this->db->query("SELECT
                                      a.*, '$nomorstkb' AS nomorstkb, b.bank, c.harga, d.nama AS namanya, e.nama AS attnya, a.kunjungan AS kodeatr,
                                      CASE
                                    	WHEN a.kunjungan = 001 THEN (SELECT q1 FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 002 THEN (SELECT q2 FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                      WHEN a.kunjungan = 003 THEN (SELECT q3 FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 062 THEN (SELECT atmm FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 064 THEN (SELECT atmc FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 065 THEN (SELECT atmc FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 066 THEN (SELECT atmc FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 067 THEN (SELECT atmc FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 000 THEN (SELECT tlr_psh FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 071 THEN (SELECT telp_cbg FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 072 THEN (SELECT telp_cbg FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    	WHEN a.kunjungan = 073 THEN (SELECT telp_cbg FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                      WHEN a.kunjungan = 104 THEN (SELECT backup FROM stkb_ops WHERE nomorstkb = '$nomorstkb')
                                    END	AS banyaknya
                                    	FROM
                                    	stkb1project a
                                      JOIN project b ON a.kodeproject = b.kode
                                      JOIN stkb_dasar_trk c ON b.bank = c.kodebank AND c.kodeskenario = a.skenario
                                      JOIN stkb_skenario d ON a.skenario = d.NO
                                      JOIN attribute e ON a.kunjungan = e.kode
                                      WHERE
                                    	kodeproject = (
                                    		SELECT
                                    			project
                                    		FROM
                                    			stkb_trk
                                    		WHERE
                                    			nostkb = '$nomorstkb'
                                    	)
                                    ");
    echo json_encode($getprint->result_array());
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
    $data['detailnya'] = $this->db->query("SELECT
                                            	a.project AS project,
                                            	a.att AS kodekunjungan,
                                            	b.kode AS kodecabang,
                                            	b.kareg AS idpic,
                                              b.nomorstkb AS nomornya,
                                            	c.nama AS namakunjungan,
                                            	d.nama AS namacabang,
                                            	i.cabang AS namacabang,
                                            	e.status AS statusquest,
                                              i.shp_weekend_siang, i.weekend_siang, i.status_weekend_siang,
                                              i.shp_weekend_malam, i.weekend_malam, i.status_weekend_malam,
                                              i.shp_weekday_siang, i.weekday_siang, i.status_weekday_siang,
                                              i.shp_weekday_malam, i.weekday_malam, i.status_weekday_malam,
                                            	e.shp AS idshopper,
                                            	e.pwt AS idpwt,
                                            	f.nama AS namashp,
                                            	g.nama AS namapwt,
                                            	h.nama AS namapic
                                            FROM
                                            	skenario a
                                            LEFT JOIN plan b ON a.project = b.project AND a.kategori = b.kunjungan

                                            JOIN attribute c ON a.att = c.kode AND c.kunjungan_q = 1

                                            LEFT JOIN cabang d ON b.kode = d.kode
                                            AND b.project = d.project
                                            LEFT JOIN quest e ON b.project = e.project
                                            AND b.kode = e.cabang
                                            AND a.att = e.kunjungan

                                            LEFT JOIN atmcenter i ON b.project = i.project AND b.kode = i.cabang
                                            LEFT JOIN id_data f ON e.shp = f.Id
                                            LEFT JOIN id_data g ON e.pwt = g.Id
                                            LEFT JOIN id_data h ON b.kareg = h.Id
                                            WHERE
                                            	b.nomorstkb = '$nomorstkb'
                                            ORDER BY
                                            	kodecabang ASC")->result_array();
    $this->load->view('stkb/tracking/detailstkb', $data);
  }




}
