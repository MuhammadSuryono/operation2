    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Notifikasi </h3>
        <div class="row mt">
          <div class="col-lg-12">


            <!-- PIC SEBAGAI SHOPPER -->

            <div class="row">

              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Kunjungan Anda</strong></h4>

                <?php $no=1; foreach($notif11 as $nf1):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?=base_url('shp/cekdata')?>"><span class="badge bg-warning mr"><?=$no++?></span> Dialog Untuk Project <?= $nf1['project_kode']?> - <?= $nf1['upload_dialog']?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['cabang_kode']?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['sub_kunjungan_kode']?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>  </a> <br><br>
                <?php endforeach?>
                <?php foreach($notif21 as $nf2):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?=base_url('shp/cekdata')?>"><span class="badge bg-warning mr"><?=$no++?></span> Rekaman Untuk Project <?= $nf2['project']?><span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> </a> <br><br>
                <?php endforeach?>
                <?php foreach($notif31 as $nf3):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?=base_url('shp/cekdata')?>"><span class="badge bg-warning mr"><?=$no++?></span> Layout Untuk Project <?= $nf3['project_kode']?> - <?= $nf3['upload_layout']?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>  </a><br><br>
                <?php endforeach?>
                <?php foreach($notif41 as $nf4):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?=base_url('shp/cekdata')?>"><span class="badge bg-warning mr"><?=$no++?></span> Screnshot Equest Untuk Project <?= $nf4['project_kode']?> - <?= $nf4['upload_ss']?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>  </a><br><br>
                <?php endforeach?>
                <?php foreach($notif51 as $nf5):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?=base_url('shp/cekdata')?>"><span class="badge bg-warning mr"><?=$no++?></span> Slip Transaksi Untuk Project <?= $nf5['project_kode']?> - <?= $nf5['upload_slip_transaksi']?> <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span>  </a><br><br>
                <?php endforeach?>
                <?php foreach($notif991 as $nf99):?>
                  <a>Tanggal : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['waktuassign']?> </span> </a>
                  <br>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="<?=base_url('aktual')?>"><span class="badge bg-warning mr"><?=$no++?></span> Anda belum upload rekaman project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_project']?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama']?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_cabang']?> </span> </a><br><br>
                <?php endforeach?>

              </div>
            </div>
          </div>


          <div class="row">

              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Data Kunjungan</strong></h4>
                <?php foreach($notif1 as $nf1):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="#"><span class="badge bg-warning mr"><?=$no++?></span> Dialog Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['project_kode']?> </span> - <?= $nf1['upload_dialog']?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['cabang_kode']?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['sub_kunjungan_kode']?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf1['shp_id']?> </span> </a> <br><br>
                <?php endforeach?>
                <?php foreach($notif2 as $nf2):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="#"><span class="badge bg-warning mr"><?=$no++?></span> Rekaman Untuk Project <?= $nf2['project']?>  di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['cabang']?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['kunjungan']?> </span> status  <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf2['id_user']?> </span> </a> <br><br>
                <?php endforeach?>
                <?php foreach($notif3 as $nf3):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="#"><span class="badge bg-warning mr"><?=$no++?></span> Layout Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['project_kode']?> </span> - <?= $nf3['upload_layout']?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['cabang_kode']?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['sub_kunjungan_kode']?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf3['shp_id']?> </span> </a><br><br>
                <?php endforeach?>
                <?php foreach($notif4 as $nf4):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="#"><span class="badge bg-warning mr"><?=$no++?></span> Screnshot Equest Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['project_kode']?> </span> - <?= $nf4['upload_ss']?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['cabang_kode']?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['sub_kunjungan_kode']?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf4['shp_id']?> </span> </a><br><br>
                <?php endforeach?>
                <?php foreach($notif5 as $nf5):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="#"><span class="badge bg-warning mr"><?=$no++?></span> Slip Transaksi Untuk Project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['project_kode']?> </span> - <?= $nf5['upload_slip_transaksi']?> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['cabang_kode']?> </span> kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['sub_kunjungan_kode']?> </span> status <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> DITOLAK </span> ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf5['shp_id']?> </span> </a><br><br>
                <?php endforeach?>
                <?php foreach($notif99 as $nf99):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" href="#"><span class="badge bg-warning mr"><?=$no++?></span> Status belum hijau project <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_project']?> </span> untuk kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama']?> </span> di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['nama_cabang']?> </span> aktual <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['waktuassign']?> </span> ID SHP : <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $nf99['shp']?> </span> </a><br><br>
                <?php endforeach?>

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