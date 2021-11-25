    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Tracking Kunjungan</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Kunjungan </strong></h4>
                        <div class="row">
                        
                        <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash') ?>"></div>

                        <form action="<?= base_url('validasi/inputdatarekaman')?>" method="post" enctype='multipart/form-data'>

                        <div class="col-md-3 sm">
                            <select class="selectpicker form-control" data-live-search="true" name="trproject" id="trproject" required>
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        </div>

                        <div class="col-md-3 sm">
                            <select class="form-control kunjungan" name="trkunjungan" id="trkunjungan" required>
                                <option value=""> Pilih Kunjungan </option>
                            </select>
                        </div>

                        <div class="col-md-3 sm">
                            <select class="form-control skenario" name="trskenario" id="trskenario" required>
                                <option value=""> Pilih Skenario </option>
                            </select>
                        </div>

                        <div class="col-md-3 sm">
                            <select class="selectpicker form-control cabang" data-live-search="true" name="trcabang" id="trcabang" required>
                                <option value=""> Pilih Cabang </option>
                            </select>
                        </div>
            
                        </form>

                  <!-- </div> -->

                  </div>
              </div>
          </div>


          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel" id="trackingnya">
                    

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