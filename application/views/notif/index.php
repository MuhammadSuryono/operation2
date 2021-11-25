    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Notifikasi </h3>
        <div class="row mt">
          <div class="col-lg-12">
            <?= $this->session->flashdata('info'); ?>
          </div>
          <div class="col-lg-12">

            <div class="row">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Equest</strong></h4>
                    <?= $this->session->flashdata('info'); ?>
                    <?php $no = 1;
                    foreach ($notif as $db) :
                      $nof = explode(",", $db['ket_cek']);
                      $jwb = explode("|", $db['ket_jawab']);
                      $ulang = 0; ?>
                      <?php for ($j = 0; $j < count($jwb) - 1; $j++) {
                        $kodenotif = substr("$jwb[$j]", 0, stripos("$jwb[$j]", "-"));
                        $cariarr = array_search("$kodenotif", $nof);
                        unset($nof[$cariarr]);
                      } ?>
                      <?php $nof2 = array_values($nof);
                      for ($i = $ulang; $i < count($nof2) - 1; $i++) :
                        $ps = $this->db->get_where('data_cek', ['id_cek' => $nof2[$i]])->row_array(); ?>
                        <a style="color:#1c1c1f; font-size:1.4rem;" data-toggle="modal" data-target="#cek<?= $ps['id_cek'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> <?= $ps['ket_cek'] ?></a>
                        <br>
                        <br>
                        <!-- MODAL cek -->
                        <div class="modal fade" id="cek<?= $ps['id_cek'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Keterangan Validasi Data Equest</h4>
                              </div>
                              <div class="modal-body">
                                <form class="form-horizontal " method="post" action="<?= base_url('notifikasi/simpan') ?>">
                                  <div class="form-group">
                                    <div class="col-sm-12">
                                      <input type="text" class="form-control" name="jawab" id="jawab" placeholder="JAWAB DISINI...">
                                      <input type="hidden" class="form-control" name="id_cek" id="id_cek" value="<?= $ps['id_cek'] ?>">
                                      <input type="hidden" class="form-control" name="id_jawaban" id="id_jawaban" value="<?= $db['id_jawaban'] ?>">
                                    </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary btn-round">Simpan</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->
                      <?php endfor ?>
                    <?php endforeach ?>

                    <?php $no = 1;
                    foreach ($notif99e1 as $nf99e1) : ?>
                      <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e1['waktuassign'] ?> </span> </a>
                      <br>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('aktual') ?>"><span class="badge bg-warning mr"><?= $no ?></span> Anda belum mengisi EQUEST Q1 project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e1['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e1['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e1['nama_cabang'] ?> </span> </a><br><br>
                    <?php endforeach ?>
                    <?php foreach ($notif99e2 as $nf99e2) : ?>
                      <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e2['waktuassign'] ?> </span> </a>
                      <br>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('aktual') ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum mengisi EQUEST Q2 project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e2['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e2['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e2['nama_cabang'] ?> </span> </a><br><br>
                    <?php endforeach ?>
                    <?php foreach ($notif99e3 as $nf99e3) : ?>
                      <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e3['waktuassign'] ?> </span> </a>
                      <br>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('aktual') ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum mengisi EQUEST Q3 project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e3['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e3['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99e3['nama_cabang'] ?> </span> </a><br><br>
                    <?php endforeach ?>

                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Data Kunjungan</strong></h4>
                    <?php foreach ($notif1 as $nf1) : ?>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahKB') ?>/<?= $nf1['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Dialog Untuk Project <?= $nf1['project_kode'] ?> - <?= $nf1['upload_dialog'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['cabang_kode'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['sub_kunjungan_kode'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a> <br><br>
                    <?php endforeach ?>
                    <?php foreach ($notif2 as $nf2) : ?>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/cekdata') ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Rekaman Untuk Project <?= $nf2['project'] ?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['cabang'] ?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['kunjungan'] ?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> </a> <br><br>
                    <?php endforeach ?>
                    <?php foreach ($notif3 as $nf3) : ?>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahkunjunganKB') ?>/<?= $nf3['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Layout Untuk Project <?= $nf3['project_kode'] ?> - <?= $nf3['upload_layout'] ?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a><br><br>
                    <?php endforeach ?>
                    <?php foreach ($notif4 as $nf4) : ?>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahkunjunganKB') ?>/<?= $nf4['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Screnshot Equest Untuk Project <?= $nf4['project_kode'] ?> - <?= $nf4['upload_ss'] ?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a><br><br>
                    <?php endforeach ?>
                    <?php foreach ($notif5 as $nf5) : ?>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/ubahkunjunganKB') ?>/<?= $nf5['num'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Slip Transaksi Untuk Project <?= $nf5['project_kode'] ?> - <?= $nf5['upload_slip_transaksi'] ?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload ulang </span> </a><br><br>
                    <?php endforeach ?>
                    <?php foreach ($notif99 as $nf99) : ?>
                      <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['waktuassign'] ?> </span> </a>
                      <br>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('rekaman/tambahKB1/') ?><?= $nf99['kunjungan'] ?>/<?= $nf99['project'] ?>/<?= $nf99['cabang'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum upload rekaman project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_cabang'] ?> </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload </span> </a><br><br>
                    <?php endforeach ?>
                    <?php foreach ($notif99d as $nf99d) : ?>
                      <a>Tanggal Kunjungan : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99d['waktuassign'] ?> </span> </a>
                      <br>
                      <a style="color:#1c1c1f; font-size:1.4rem;" href="<?= base_url('shp/tambahKZ/') ?><?= $nf99d['kunjungan'] ?>/<?= $nf99d['project'] ?>/<?= $nf99d['cabang'] ?>"><span class="badge bg-warning mr"><?= $no++ ?></span> Anda belum upload dialog project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99d['nama_project'] ?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99d['nama'] ?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99d['nama_cabang'] ?> </span> <span class="badge" style="background-color : #857f11; margin-left:0.5rem;"> Klik di sini untuk upload </span> </a><br><br>
                    <?php endforeach ?>
                  </div>
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