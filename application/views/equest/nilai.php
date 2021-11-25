<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Equest</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="col-md-4 col-sm-4 mb col-md-offset-4">
                <div class="darkblue-panel pn" style="min-height:300px;">
                  <div class="darkblue-header">
                    <h5>SCORE ANDA</h5>
                  </div>
                  <h1 class="mt" style="font-size:100px;"><strong> <?= $jawab?> </strong></h1>
                  <h5><i class="fa fa-check-circle"></i> <?= $benar?>   <i class="fa fa-times-circle" style="margin-left:1rem;"></i> <?= $salah?> </h5>
                  <?php if($jawab>=70) :?>
                      <h5 class="text-primary">Selamat Anda Dinyatakan <span class="label label-info">LULUS!</span></h5>
                      <footer class="">
                        <div class="centered">
                        <a href="<?=base_url('equest/daftarnilai')?>" class="btn btn-small btn-info">LIHAT HISTORY NILAI</a>
                        </div>
                    </footer>
                <?php else :?>
                      <h5 class="text-primary">Maaf Anda Dinyatakan <span class="label label-danger">GAGAL!</span></h5>
                      <h5>Silahkan isi kembali soal kuis.</h5>
                      <footer class="">
                        <div class="centered">
                        <a href="<?=base_url('equest/shp')?>" class="btn btn-small btn-danger"> ULANGI KUIS </a>
                        </div>
                    </footer>
                  <?php endif?>
                </div>
                <!--  /darkblue panel -->
              </div>



          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->