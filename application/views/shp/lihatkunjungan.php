<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Bukti Kunjungan Skenario <?= $data_kunjungan['nama_skenario']?></h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Slip Transaksi</strong></h4>
                <img src="../../assets/file/<?=$data_kunjungan['gambar_transaksi']?>" alt="" class="thumbnail kecil" style="width: 360px; height: 400px;"/>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Screenshot Equest </strong></h4>
                <img src="../../assets/file/<?=$data_kunjungan['gambar_equest']?>" alt="" class="thumbnail kecil" style="width: 360px; height: 400px;"/>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Layout Cabang </strong></h4>
                 <img src="../../assets/file/<?=$data_kunjungan['gambar_layout']?>" alt="" class="thumbnail kecil" style="width: 360px; height: 400px;"/> -->
                </div>
              </div>
          </div>

          <div class="row">
              <div class="col-lg-12">
                <div class="form-panel">
                    <a href=<?=base_url('shp/daftarkunjungan')?> type="button" class="btn btn-primary btn-lg btn-block btn-round"><i class="fa fa-check-circle-o fa-fw"></i> Selesai </a>
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