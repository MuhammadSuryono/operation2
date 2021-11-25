<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Notifikasi </h3>
        <div class="row mt">
          <div class="col-lg-12">


            <div class="row">

              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Dialog</strong></h4>
                <?php $no=1; foreach($dialog as $db):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" target="_blank" href="<?=base_url('validasi/lihatValidasiUploadUlang/')?><?= $db['num']?>">
                  <span class="badge bg-warning mr"><?=$no++?></span> 
                  Dialog Untuk Project <?= $db['project_kode']?> - <?= $db['upload_dialog']?> 
                  di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['cabang_kode']?> </span>
                  kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['sub_kunjungan_kode']?> </span> 
                  status : <strong>Sudah Diupload Kembali</strong>
                  <span class="badge" style="background-color : #337ab7; margin-left:0.5rem;"> Lihat Disini </span> </a> <br><br>
                <?php endforeach?>
              </div>
            </div>
          </div>

          <div class="row">

              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Rekaman</strong></h4>
                <?php $no=1; foreach($rekaman as $db):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" target="_blank" href="<?=base_url('validasi/lihatvalidasi/')?><?= $db['num']?>">
                  <span class="badge bg-warning mr"><?=$no++?></span> 
                  Rekaman Untuk Project <?= $db['project']?>
                  di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['cabang']?> </span>
                  kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['kunjungan']?> </span> 
                  status : <strong>Sudah Diupload Kembali</strong>
                  <span class="badge" style="background-color : #337ab7; margin-left:0.5rem;"> Lihat Disini </span> </a> <br><br>
                <?php endforeach?>
              </div>
            </div>
          </div>

            <div class="row">

              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Layout</strong></h4>
                <?php $no=1; foreach($layout as $db):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" target="_blank" href="<?=base_url('validasi/lihatValidasiUploadUlang/')?><?= $db['num']?>">
                  <span class="badge bg-warning mr"><?=$no++?></span> 
                  Layout Untuk Project <?= $db['project_kode']?> - <?= $db['upload_dialog']?> 
                  di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['cabang_kode']?> </span>
                  kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['sub_kunjungan_kode']?> </span> 
                  status : <strong>Sudah Diupload Kembali</strong>
                  <span class="badge" style="background-color : #337ab7; margin-left:0.5rem;"> Lihat Disini </span> </a> <br><br>
                <?php endforeach?>
              </div>
            </div>
          </div>

            <div class="row">

              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Slip</strong></h4>
                <?php $no=1; foreach($slip as $db):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" target="_blank" href="<?=base_url('validasi/lihatValidasiUploadUlang/')?><?= $db['num']?>">
                  <span class="badge bg-warning mr"><?=$no++?></span> 
                  Layout Untuk Project <?= $db['project_kode']?> - <?= $db['upload_dialog']?> 
                  di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['cabang_kode']?> </span>
                  kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['sub_kunjungan_kode']?> </span> 
                  status : <strong>Sudah Diupload Kembali</strong>
                  <span class="badge" style="background-color : #337ab7; margin-left:0.5rem;"> Lihat Disini </span> </a> <br><br>
                <?php endforeach?>
              </div>
            </div>
          </div>

            <div class="row">

              <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Notifikasi Slip</strong></h4>
                <?php $no=1; foreach($ss as $db):?>
                  <a style="color:#1c1c1f; font-size:1.4rem;" target="_blank" href="<?=base_url('validasi/lihatValidasiUploadUlang/')?><?= $db['num']?>">
                  <span class="badge bg-warning mr"><?=$no++?></span> 
                  Layout Untuk Project <?= $db['project_kode']?> - <?= $db['upload_dialog']?> 
                  di cabang <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['cabang_kode']?> </span>
                  kunjungan <span class="badge" style="background-color : #dc3545; margin-left:0.5rem;"> <?= $db['sub_kunjungan_kode']?> </span> 
                  status : <strong>Sudah Diupload Kembali</strong>
                  <span class="badge" style="background-color : #337ab7; margin-left:0.5rem;"> Lihat Disini </span> </a> <br><br>
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