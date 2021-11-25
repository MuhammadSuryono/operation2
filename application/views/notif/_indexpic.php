<?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
  $email_user = $user['email'];
  $id_u = $user['noid'];
  $table = "user";
  $kolom = "email";
  $where_col = "noid";
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
  $email_user = $user['Email'];
  $id_u = $user['Id'];
  $table = "id_data";
  $kolom = "Email";
  $where_col = "Id";
}
?>

<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> Notifikasi </h3>
    <div class="row mt">
      <div class="col-lg-12">

        <div class="col-lg-12">
          <?= $this->session->flashdata('info'); ?>
           <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
           <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

        </div>

        <!-- PIC SEBAGAI SHOPPER -->

        <div class="row">
          <?php 
              if ($email_user == NULL) {
                ?>
              <input type="hidden" id="cek_email" value="Tidak Ada">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">

                    <h4 class="mb text-dark"> <strong> <i class="fa fa-angle-right"></i> Anda Belum Mendaftarkan Email</strong></h4>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#submitemail">Daftarkan</button>
                  </div>
                </div>
              </div>
                <?php
              } else {
            ?>
              <input type="hidden" id="cek_email" value="Ada">
            <?php } ?>
            <!-- Modal DAFTARKAN EMAIL -->
            <div class="modal fade" id="submitemail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftarkan Email</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button> -->
                  </div>
                  <div class="modal-body">
                  <form method="POST" action="<?php echo base_url('notifikasi/daftar_email') ?>">
                    Mohon Masukkan Email Anda disini :
                    <input type="email" name="email" class="form-control" required>
                  </div>
                    <input type="hidden" name="id_user" class="form-control" value="<?php echo $id_u; ?>">
                    <input type="hidden" name="table" class="form-control" value="<?php echo $table; ?>">
                    <input type="hidden" name="kolom" class="form-control" value="<?php echo $kolom; ?>">
                    <input type="hidden" name="where_col" class="form-control" value="<?php echo $where_col; ?>">
                    
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                     <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                  </div>
                  </form>
                </div>
              </div>
            </div>

            <?php if ($this->session->userdata('id_divisi') == 1 OR $this->session->userdata('id_divisi') == 99) { ?>
         <div class="row">
              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Persiapan Project</strong></h4>
                <?php if ($notif_project != NULL) { ?>
                    <h4><b>Project : </b></h4> 
                <?php } 

                 $no=1; foreach($notif_project as $n_pro):?>
                <?php
                  if($n_pro['channel'] != 'E-Banking'){ ?>
              
                <?php
                   $plan = $this->db->get_where('project_spec', array('project_kode' => $n_pro['kode']))->result_array(); 
                   if ($n_pro['channel'] == 'E-Banking') {
                 $skenario = $this->db->get_where('ebanking', array('project' => $n_pro['kode']))->result_array(); 
                } else {
                 $skenario = $this->db->get_where('skenario', array('project' => $n_pro['kode']))->result_array();
                 } 
                  
                $cabang = ""; 
                 if ($n_pro['channel'] == 'WIC' OR $n_pro['channel'] == 'Digital Banking') {
                 $cabang = $this->db->get_where('cabang', array('project' => $n_pro['kode']))->result_array(); 
                } else if ($n_pro['channel'] == 'ATM Center') {
                 $cabang = $this->db->get_where('atmcenter', array('project' => $n_pro['kode']))->result_array();
                 } 
                  
                 $oneproject = $this->db->get_where('stkb1project', array('kodeproject' => $n_pro['kode']))->result_array();
                
                 $dbbudget = $this->load->database('database_ketiga', TRUE);
                 $budget = $dbbudget->get_where('pengajuan', array('kodeproject' => $n_pro['kode']))->result_array(); 
                if ($plan != NULL AND $cabang != NULL AND $skenario != NULL AND $oneproject != NULL AND $budget != NULL) {
                  continue;
                }
                ?>
           
                <?php
                } else {
            
                $plan = $this->db->get_where('project_spec', array('project_kode' => $n_pro['kode']))->result_array();  
                 $skenario = $this->db->get_where('ebanking', array('project' => $n_pro['kode']))->result_array(); 
        
                 $dbbudget = $this->load->database('database_ketiga', TRUE);
                 $budget = $dbbudget->get_where('pengajuan', array('kodeproject' => $n_pro['kode']))->result_array(); 
                  
                if ($plan != NULL AND $skenario != NULL AND $budget != NULL) {
                  continue;
                }
              }
                ?>


                  
                  <span class="badge bg-warning mr"><?=$no++?></span> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_pro['nama']?> </span>
                  <br>
                  <?php
                  if($n_pro['channel'] != 'E-Banking'){ ?>
              
                    <span style="margin-left:2rem;"> Persiapan Project Yang Belum Dilakukan :  </span>
                <?php
                   $plan = $this->db->get_where('project_spec', array('project_kode' => $n_pro['kode']))->result_array(); 
                  if ($plan == NULL) {
                  ?>
                  <a href="<?php echo base_url('projectplan/index') ?>" class="btn btn-warning btn-sm"  > Project Plan</a>
                <?php } 
                ?>

                <?php if ($n_pro['channel'] == 'E-Banking') {
                 $skenario = $this->db->get_where('ebanking', array('project' => $n_pro['kode']))->result_array(); 
                } else {
                 $skenario = $this->db->get_where('skenario', array('project' => $n_pro['kode']))->result_array();
                 } 
                  if ($skenario == NULL) {
                  ?>
                  <a href="<?php echo base_url('skenario/kunjungan') ?>" class="btn btn-warning btn-sm"  > Pembuatan Skenario</a>
                <?php } 
                ?>


                <?php
                $cabang = ""; 
                 if ($n_pro['channel'] == 'WIC' OR $n_pro['channel'] == 'Digital Banking') {
                 $cabang = $this->db->get_where('cabang', array('project' => $n_pro['kode']))->result_array(); 
                } else if ($n_pro['channel'] == 'ATM Center') {
                 $cabang = $this->db->get_where('atmcenter', array('project' => $n_pro['kode']))->result_array();
                 } 
                  if ($cabang == NULL) {
                  ?>
                  <!-- <a href="<?php echo base_url('cabang') ?>" class="btn btn-warning btn-sm"  > Upload Cabang</a> -->
                  <a href="#" class="btn btn-warning btn-sm" data-trigger="hover" data-toggle="popover" data-placement="top" title="Informasi" data-content="Upload cabang dapat dilakukan oleh DP. Mohon follow up DP untuk melakukan upload cabang." > Upload Cabang</a>

                <?php } 
                ?>


                 <?php 
                 $oneproject = $this->db->get_where('stkb1project', array('kodeproject' => $n_pro['kode']))->result_array();
                  if ($oneproject == NULL) {
                  ?>
                  <!-- <a href="<?php echo base_url('stkb/oneproject') ?>" class="btn btn-warning btn-sm"  > Daftar Biaya Transaksi</a> -->
                  <a href="#" class="btn btn-warning btn-sm" data-trigger="hover" data-toggle="popover" data-placement="top" title="Informasi" data-content="Daftar biaya transaksi dapat diinputkan oleh IT. Mohon follow up IT untuk input daftar biaya transaksi." > Daftar Biaya Transaksi</a>
                  
                <?php } 
                ?>

                <?php 
                 $dbbudget = $this->load->database('database_ketiga', TRUE);
                 $budget = $dbbudget->get_where('pengajuan', array('kodeproject' => $n_pro['kode']))->result_array(); 
                  if ($budget == NULL) {
                  ?>
                  <a href="http://180.211.92.131/budget/login.php" class="btn btn-warning btn-sm" target="_blank" > Budget Online</a>
                <?php } 
                if ($plan != NULL AND $cabang != NULL AND $skenario != NULL AND $oneproject != NULL AND $budget != NULL) {
                  continue;
                }
                ?>
                


                <?php
                } else {
                  ?>
              
                    <span style="margin-left:2rem;"> Persiapan Project Yang Belum Dilakukan :  </span>
                <?php


                $plan = $this->db->get_where('project_spec', array('project_kode' => $n_pro['kode']))->result_array(); 
                  if ($plan == NULL) {
                  ?>
                  <a href="<?php echo base_url('projectplan/index') ?>" class="btn btn-warning btn-sm" > Project Plan</a>
                <?php } 
                ?>

                <?php 
                 $skenario = $this->db->get_where('ebanking', array('project' => $n_pro['kode']))->result_array(); 
                  if ($skenario == NULL) {
                  ?>
                  <a href="<?php echo base_url('skenario/ebanking') ?>" class="btn btn-warning btn-sm" > Pembuatan Skenario</a>
                <?php } 
                ?>

                <?php 
                 $dbbudget = $this->load->database('database_ketiga', TRUE);
                 $budget = $dbbudget->get_where('pengajuan', array('kodeproject' => $n_pro['kode']))->result_array(); 
                  if ($budget == NULL) {
                  ?>
                  <a href="http://180.211.92.131/budget/login.php" class="btn btn-warning btn-sm" target="_blank" > Budget Online</a>
                <?php } 
                if ($plan != NULL AND $skenario != NULL AND $budget != NULL) {
                  continue;
                }
                ?>

               <?php } ?>
                <br><br>
                <?php
                 endforeach?>

              </div>
              </div>
            </div>
          <?php } ?>

          <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Equest</strong></h4>

              <?php $no = 1;
              foreach ($notif991e1 as $nf991e1) : ?>
                <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e1['waktuassign'] ?> </span> </a>
                <br>
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('aktual') ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum mengisi EQUEST Q1 project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e1['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e1['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e1['nama_cabang'] ?> </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif991e2 as $nf991e2) : ?>
                <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e2['waktuassign'] ?> </span> </a>
                <br>
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('aktual') ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum mengisi EQUEST Q2 project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e2['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e2['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e2['nama_cabang'] ?> </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif991e3 as $nf991e3) : ?>
                <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e3['waktuassign'] ?> </span> </a>
                <br>
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('aktual') ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum mengisi EQUEST Q3 project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e3['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e3['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991e3['nama_cabang'] ?> </span> </a><br><br>
              <?php endforeach ?>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Kunjungan Anda</strong></h4>

              <?php foreach ($notif11 as $nf1) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Dialog Untuk Project
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['nama_project'] ?> </span> di cabang
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['nama_cabang'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['skenario'] ?> </span> status
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>
                </a>

                <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf1['r_temuan_dialog'] ?>"> Keterangan </a>

                  <a type=" button" class="btn btn-success btn-sm" href="<?= base_url('shp/ubahKB/') ?><?= $nf1['num'] ?>"> Upload Ulang </a>

                <br><br>
              <?php endforeach ?>
              <?php foreach ($notif21 as $nf2) : ?>

                <a style="color:#1c1c1f; font-size:1.4rem;" href="#"><span class="badge bg-warning mr"><?= $no++ ?></span> Rekaman Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['nama_project'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['cabang'] ?> - <?= $nf2['nama_cabang'] ?> </span> skenario <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['kunjungan'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>

                  <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf2['r_temuan_rekaman'] ?>"> Keterangan </a>

                  <a type="button" class="btn btn-success btn-sm" href="<?= base_url('rekaman/tambahKB2/') ?><?= $nf2['kunjungan'] ?>/<?= $nf2['project'] ?>/<?= $nf2['cabang'] ?>"> Upload Ulang Bukti Rekaman </a>
                  <br><br>
                <?php endforeach ?>

                <?php foreach ($notif31 as $nf3) : ?>
                  <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Layout Untuk Project
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['nama_project'] ?> </span> di cabang
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['nama_cabang'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['skenario'] ?> </span> status
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>
                  </a>

                  <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf3['r_temuan_layout'] ?>"> Keterangan </a>

                  <a type="button" class="btn btn-success btn-sm" href="<?= base_url('shp/ubahkunjunganKBNew/') ?><?= $nf3['num'] ?>"> Upload Ulang </a>

                  <br><br>

                <?php endforeach ?>
                <?php foreach ($notif41 as $nf4) : ?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahkunjunganKBNew/') ?><?= $nf4['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Screnshot Equest Untuk Project
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['nama_project'] ?> </span> di cabang
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['nama_cabang'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['skenario'] ?> </span> status
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> </a>

                  <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf4['r_temuan_ss'] ?>"> Keterangan </a>

                  <a type="button" class="btn btn-success btn-sm" href="<?= base_url('shp/ubahkunjunganKBNew/') ?><?= $nf4['num'] ?>"> Upload Ulang </a>

                  <br><br>
                <?php endforeach ?>
                <?php foreach ($notif51 as $nf5) : ?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahkunjunganKBNew/') ?><?= $nf5['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Slip Transaksi Untuk Project
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['nama_project'] ?> </span> di cabang
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['nama_cabang'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['skenario'] ?> </span> status
                    <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>
                  </a>

                  <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf5['r_temuan_slip_transaksi'] ?>"> Keterangan </a>

                  <a type="button" class="btn btn-success btn-sm" href="<?= base_url('shp/ubahkunjunganKBNew/') ?><?= $nf5['num'] ?>"> Upload Ulang </a>

                  <br><br>
                <?php endforeach ?>
                <?php foreach ($notif991 as $nf99) : 
                   $besok = date('Y-m-d', strtotime("+1 day", strtotime($nf99['tanggal'])))." ".'12:00:00';
                              $jam = date('H:i:s');
                              $datenow = date('Y-m-d H:i:s'); ?>
                  <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['waktuassign'] ?> </span> </a>
                  <br>
                  <?php if ($datenow >= $besok AND $nf99['keterlambatan_upload'] == NULL) { ?>
                    <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('rekaman/tambahKB1/') ?><?= $nf99['r_kategori'] ?>/<?= $nf99['project'] ?>/<?= $nf99['cabang'] ?>" disabled onclick="return(false);" ><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum upload rekaman project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_cabang'] ?> </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;" data-trigger="hover" data-toggle="popover" data-placement="top" title="Keterlambatan Upload" data-content="Anda harus mengisi form keterlambatan upload terlebih dahulu, selanjutnya Anda dapat melanjutkan Upload Bukti Rekaman"> Klik di sini untuk upload </span> </a><br><br>
                  <?php } else { ?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('rekaman/tambahKB1/') ?><?= $nf99['r_kategori'] ?>/<?= $nf99['project'] ?>/<?= $nf99['cabang'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum upload rekaman project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_cabang'] ?> </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload </span> </a><br><br>
                <?php } ?>
                <?php endforeach ?>

                <?php foreach ($notif991d as $nf991d) : 
                  $besok = date('Y-m-d', strtotime("+1 day", strtotime($nf991d['tanggal'])))." ".'12:00:00';
                              $jam = date('H:i:s');
                              $datenow = date('Y-m-d H:i:s'); ?>
                  <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['waktuassign'] ?> </span> </a>
                  <br>
                  <?php if ($datenow >= $besok AND $nf991d['keterlambatan_upload'] == NULL) { ?>
                     <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/tambahKZ/') ?><?= $nf991d['r_kategori'] ?>/<?= $nf991d['project'] ?>/<?= $nf991d['cabang'] ?>" disabled onclick="return(false);"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum upload dialog project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama_cabang'] ?> </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;" data-trigger="hover" data-toggle="popover" data-placement="top" title="Keterlambatan Upload" data-content="Anda harus mengisi form keterlambatan upload terlebih dahulu, selanjutnya Anda dapat melanjutkan Upload Dialog Project"> Klik di sini untuk upload </span> </a><br><br>
                  <?php } else { ?>

                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/tambahKZ/') ?><?= $nf991d['r_kategori'] ?>/<?= $nf991d['project'] ?>/<?= $nf991d['cabang'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum upload dialog project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama_cabang'] ?> </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload </span> </a><br><br>
                <?php } ?>
                <?php endforeach ?>
            </div>
          </div>
        </div>


        <div class="row">

          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Data Kunjungan</strong></h4>
              <?php foreach ($pengulangan as $pg) {
               $cek_quest = $this->db->get_where('quest', array('project' => $pg['project'], 'cabang' => $pg['cabang'], 'kunjungan' => $pg['kunjungan']))->result_array();
               if ($cek_quest != NULL) {
                 continue;
               }
                ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Pada Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $pg['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $pg['nama_kunjungan'] ?> </span>  di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $pg['nama_cabang'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> HARUS DIULANG </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $pg['shp'] ?> </span>

                  <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $pg['r_keterangan_ra'] ?>"> Keterangan </a>

                </a> <br><br>


              <?php } ?>


              <?php foreach ($notif1 as $nf1) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Dialog Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['project_kode'] ?> </span> - <?= $nf1['upload_dialog'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['shp_id'] ?> </span>

                  <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf1['r_temuan_dialog'] ?>"> Keterangan </a>

                </a> <br><br>
              <?php endforeach ?>
              <?php foreach ($notif2 as $nf2) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Rekaman Untuk Project <?= $nf2['project'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['cabang'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['kunjungan'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['shp'] ?> </span> </a>

                <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf2['r_temuan_rekaman'] ?>"> Keterangan </a>

                <br><br>
              <?php endforeach ?>
              <?php foreach ($notif3 as $nf3) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Layout Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['project_kode'] ?> </span> - <?= $nf3['upload_layout'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['shp_id'] ?> </span> </a>

                <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf3['r_temuan_layout'] ?>"> Keterangan </a>

                <br><br>
              <?php endforeach ?>
              <?php foreach ($notif4 as $nf4) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Screnshot Equest Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['project_kode'] ?> </span> - <?= $nf4['upload_ss'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['shp_id'] ?> </span> </a>

                <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf3['r_temuan_ss'] ?>"> Keterangan </a>

                <br><br>
              <?php endforeach ?>
              <?php foreach ($notif5 as $nf5) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Slip Transaksi Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['project_kode'] ?> </span> - <?= $nf5['upload_slip_transaksi'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['shp_id'] ?> </span> </a>

                <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $nf5['r_temuan_slip_transaksi'] ?>"> Keterangan </a>

                <br><br>
              <?php endforeach ?>
              <?php foreach ($notif99 as $nf99) : ?>
                <!-- <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Status belum hijau tua project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_cabang'] ?> </span> aktual <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['waktuassign'] ?> </span>  cek  ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['shp'] ?> </span> </a><br><br> -->
              <?php endforeach ?>

              <?php if ($no == 1) : ?>
                <center><span class="badge bg-warning mr">
                    <h5>Selamat, Anda tidak mempunyai notifikasi<h5>
                  </span>
                  <center>
                  <?php endif ?>

            </div>
          </div>
        </div>


        <div class="row">
              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Data E-Banking</strong></h4>
                <?php $no=1; foreach($notif_eb as $n_eb):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?=$no++?></span> Data E-Banking Untuk Project
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_eb['nama_project']?> </span> di bank
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_eb['nama_bank']?> </span> channel <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_eb['channel']?></span> jenis transaksi <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_eb['nama_transaksi']?> </span>   tanggal evaluasi <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_eb['tanggal_evaluasi']?> </span>  jam <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_eb['jam_mulai']." - ".$n_eb['jam_selesai']?> </span> status
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>, User Input : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?php if ($n_eb['nama_user1'] != NULL) { echo $n_eb['nama_user1']; } else { echo $n_eb['nama_user2']; } ?> </span>
                  </a>

                  <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $n_eb['r_temuan']?>"> Keterangan </a>

                   <?php if ($this->session->userdata('id_divisi') != 4){ ?>
                  <a type="button" class="btn btn-success btn-sm" href="<?=base_url('aktual/ulang_ebanking/'.$n_eb['num'])?>" target="_blank"> Upload Ulang </a>
                  <a type="button" class="btn btn-info btn-sm btn-round" href="<?=base_url('aktual/file_ebanking/'.$n_eb['num'])?>" target="_blank"> Upload Ulang File</a>
                  <?php } ?>
                  <br><br>
                <?php endforeach?>


                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Data Evaluasi Sosial Media</strong></h4>
                <?php $no=1; foreach($notif_sm as $n_sm):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?=$no++?></span> Data Evaluasi Sosial Media Untuk Project
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_sm['nama_project']?> </span> di bank
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_sm['nama_bank']?> </span> platform <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_sm['platform']?></span> skenario <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_sm['nama_skenario']?> </span>   tanggal evaluasi <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_sm['tanggal_evaluasi']?> </span>  jam <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $n_sm['jam_mulai']?> </span> status
                  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>, User Input : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?php if ($n_sm['nama_user1'] != NULL) { echo $n_sm['nama_user1']; } else { echo $n_sm['nama_user2']; } ?> </span>
                  </a>

                  <a type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal_keterangan" data-keterangan="<?= $n_sm['r_temuan']?>"> Keterangan </a>

                   <?php if ($this->session->userdata('id_divisi') != 4){ ?>
                  <a type="button" class="btn btn-success btn-sm" href="<?=base_url('aktual/ulang_sosmed/'.$n_sm['num'])?>" target="_blank"> Upload Ulang </a>
                  <?php } ?>
                  <br><br>
                <?php endforeach?>

              </div>
              </div>
            </div>




        <!-- <div class="row">
              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Pengajuan Lintas Pulau</strong></h4>
                <?php
                if ($this->session->userdata('id_divisi') == 99) {
                  $notif_lintaspulau = $this->db->query("SELECT id FROM data_pengajuan_sdm WHERE status = '0'")->num_rows();
                } else {
                  $id = $this->session->userdata('id_user');
                  $this->db->select('a.*, p.nama as namaproject, s.nama as namapic, s.kota_asal,
                    IF(u.name IS NOT NULL, u.name, (SELECT Nama FROM id_data WHERE Id = a.kareg)) as namakareg,
                    IF(u.email IS NOT NULL, u.email, (SELECT Email FROM id_data WHERE Id = a.kareg)) as emailkareg
                  ', FALSE);
                  $this->db->from('data_pengajuan_sdm a');
                  $this->db->join('project p', 'a.project = p.kode');
                  $this->db->join('stkb_sdm s', 'a.pic = s.id');
                  $this->db->join('user u', 'a.kareg = u.noid');
                  $where = "a.kareg='$id' AND (a.status='1' OR a.status='2')";
                  $this->db->where($where);
                  $get = $this->db->get()->result_array();
                  $notif_lintaspulau = count($get);
                }
                if ($notif_lintaspulau != 0) {
                  if ($this->session->userdata('id_divisi') == 99) {
                    echo '<p style="color:#1c1c1f;">Ada <span class="badge bg-warning">' . $notif_lintaspulau . '</span> pengajuan lintas pulau yang belum di proses <a style="color:#1c1c1f; font-size:1.4rem;" href="' . base_url('stkb/daftarpengajuanlintaspulau') . '"><span class="badge" style="background-color : #857f11; margin-left:0.5rem;">Klik di sini untuk proses</span></a></p>';
                  } else {
                    $no = 1;
                    foreach ($get as $data) {
                      $tgl = date('Y-m-d', strtotime("+2 weeks", strtotime($data['tanggal'])));
                      if ($data['status'] == '1') {
                        if (date('Y-m-d') < $tgl) {
                          echo '<p style="color:#1c1c1f;">' . $no++ . '. Pengajuan Lintas Pulau (' . $data['project'] . ' - ' . $data['namaproject'] . ', ' . $data['kareg'] . ' - ' . $data['namakareg'] . ', ' . $data['pic'] . ' - ' . $data['namapic'] . ', Kota Asal: ' . $data['kota_asal'] . ', Kota Dinas: ' . $data['kota_dinas'] . ') <strong class="text-success">berhasil di setujui!</strong></p>';
                        }
                      } else {
                        if (date('Y-m-d') < $tgl) {
                          echo '<p style="color:#1c1c1f;">' . $no++ . '. Pengajuan Lintas Pulau (' . $data['project'] . ' - ' . $data['namaproject'] . ', ' . $data['kareg'] . ' - ' . $data['namakareg'] . ', ' . $data['pic'] . ' - ' . $data['namapic'] . ', Kota Asal: ' . $data['kota_asal'] . ', Kota Dinas: ' . $data['kota_dinas'] . ') <strong class="text-danger">di tolak!</strong></p>';
                        }
                      }
                    }
                  }
                }
                ?>
              </div>
              </div>
            </div> -->

      </div>
    </div>
  </section>
  <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

<!-- Modal -->
<div id="modal_keterangan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Keterangan Penolakan</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <section id="iniketerangan"></section>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
$(function () {
  $('[data-toggle="popover"]').popover()
});

$(document).ready(function() {
    var cek = document.getElementById('cek_email').value;
    console.log(cek);
    // alert(cek);

    if (cek == 'Tidak Ada') {
      $('#submitemail').modal('show');
    }
  });
</script>