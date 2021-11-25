    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Bukti Kunjungan <?=$data_kunjungan['nama_project']?> - <?=$data_kunjungan['skenariox']?> [<?= $data_kunjungan['kunjunganx']?>]</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Slip Transaksi </strong></h4>
               <!-- Awal -->
                <div class="project-wrapper">
                <div class="project">
                    <div class="photo-wrapper">
                    <div class="photo">
                        <a class="fancybox" href="<?= base_url('assets/')?>file/buktitrk/<?=$data_kunjungan['upload_slip_transaksi']?>"><img class="img-responsive" src="../../assets/file/buktitrk/<?=$data_kunjungan['upload_slip_transaksi']?>" alt=""></a>
                    </div>
                    <div class="overlay"></div>
                    </div>
                </div>
                </div>
                <!-- akhir -->
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Screenshot Equest </strong></h4>
               <!-- Awal -->
                <div class="project-wrapper">
                <div class="project">
                    <div class="photo-wrapper">
                    <div class="photo">
                        <a class="fancybox" href="<?= base_url('assets/')?>file/buktitrk/<?=$data_kunjungan['upload_ss']?>"><img class="img-responsive" src="../../assets/file/buktitrk/<?=$data_kunjungan['upload_ss']?>" alt=""></a>
                    </div>
                    <div class="overlay"></div>
                    </div>
                </div>
                </div>
                <!-- akhir -->
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Layout Cabang </strong></h4>
               <!-- Awal -->
                <div class="project-wrapper">
                <div class="project">
                    <div class="photo-wrapper">
                    <div class="photo">
                        <a class="fancybox" href="<?= base_url('assets/')?>file/buktitrk/<?=$data_kunjungan['upload_layout']?>"><img class="img-responsive" src="../../assets/file/buktitrk/<?=$data_kunjungan['upload_layout']?>" alt=""></a>
                    </div>
                    <div class="overlay"></div>
                    </div>
                </div>
                </div>
                <!-- akhir -->
                </div>
              </div>

          </div>

          <div class="row">
              <div class="col-lg-12">
                <div class="form-panel">
                    <a href=<?=base_url('shp/daftarkunjungan')?> 
                    type="button" class="btn btn-primary btn-lg btn-block btn-round"><i class="fa fa-check-circle-o fa-fw"></i> Selesai </a>
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