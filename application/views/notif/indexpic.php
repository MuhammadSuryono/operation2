<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> Notifikasi </h3>
    <div class="row mt">

      <div class="col-lg-12">

        <div class="col-lg-12">
          <?= $this->session->flashdata('info'); ?>
        </div>
        <!-- PIC SEBAGAI SHOPPER -->

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
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahKB/') ?><?= $nf1['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Dialog Untuk Project <?= $nf1['project_kode'] ?> - <?= $nf1['upload_dialog'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a> <br><br>
              <?php endforeach ?>
              <?php foreach ($notif21 as $nf2) : ?>

                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/cekdata') ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Rekaman Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['nama_project'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['cabang'] ?> - <?= $nf2['nama_cabang'] ?> </span> skenario <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['kunjungan'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a> <br><br>
              <?php endforeach ?>

              <?php foreach ($notif31 as $nf3) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahkunjunganKB/') ?><?= $nf3['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Layout Untuk Project <?= $nf3['project_kode'] ?> - <?= $nf3['upload_layout'] ?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif41 as $nf4) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahkunjunganKB/') ?><?= $nf4['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Screnshot Equest Untuk Project <?= $nf4['project_kode'] ?> - <?= $nf4['upload_ss'] ?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif51 as $nf5) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahkunjunganKB/') ?><?= $nf5['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Slip Transaksi Untuk Project <?= $nf5['project_kode'] ?> - <?= $nf5['upload_slip_transaksi'] ?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif991 as $nf99) : ?>
                <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['waktuassign'] ?> </span> </a>
                <br>
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('rekaman/tambahKB1/') ?><?= $nf99['kunjungan'] ?>/<?= $nf99['project'] ?>/<?= $nf99['cabang'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum upload rekaman project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_cabang'] ?> </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif991d as $nf991d) : ?>
                <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['waktuassign'] ?> </span> </a>
                <br>
                <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/tambahKZ/') ?><?= $nf991d['kunjungan'] ?>/<?= $nf991d['project'] ?>/<?= $nf991d['cabang'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum upload dialog project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf991d['nama_cabang'] ?> </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload </span> </a><br><br>
              <?php endforeach ?>
            </div>
          </div>
        </div>


        <div class="row">

          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Data Kunjungan</strong></h4>
              <?php foreach ($notif1 as $nf1) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Dialog Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['project_kode'] ?> </span> - <?= $nf1['upload_dialog'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['shp_id'] ?> </span> </a> <br><br>
              <?php endforeach ?>
              <?php foreach ($notif2 as $nf2) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Rekaman Untuk Project <?= $nf2['project'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['cabang'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['kunjungan'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['shp'] ?> </span> </a> <br><br>
              <?php endforeach ?>
              <?php foreach ($notif3 as $nf3) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Layout Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['project_kode'] ?> </span> - <?= $nf3['upload_layout'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['shp_id'] ?> </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif4 as $nf4) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Screnshot Equest Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['project_kode'] ?> </span> - <?= $nf4['upload_ss'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['shp_id'] ?> </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif5 as $nf5) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Slip Transaksi Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['project_kode'] ?> </span> - <?= $nf5['upload_slip_transaksi'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['shp_id'] ?> </span> </a><br><br>
              <?php endforeach ?>
              <?php foreach ($notif99 as $nf99) : ?>
                <a style="color:#1c1c1f; font-size:1.4rem;"><span class="badge bg-warning mr"><?= $no++ ?></span> Status belum hijau tua project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_cabang'] ?> </span> aktual <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['waktuassign'] ?> </span> cek ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['shp'] ?> </span> </a><br><br>
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

      </div>
    </div>
  </section>
  <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>