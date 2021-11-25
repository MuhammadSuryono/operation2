<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Tes Pemahaman Skenario</h3>
        <div class="row mt">
          <div class="col-lg-12">

        <form action="<?=base_url('equest/kuis')?>" method="post">
          <div class="row mt">
          <div class="col-lg-8">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Data Skenario</strong> </h4>
               <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
              <div class="row">
                  <div class="col-lg-5">
                      <div class="form-group">
                        <!-- <label class="col-sm-3 control-label">Pilih Skenario</label> -->
                        <div class="col-sm-9">
                            <select class="form-control" name="projectbrief" id="projectbrief">
                            <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                      <div class="form-group">
                        <!-- <label class="col-sm-3 control-label">Pilih Skenario</label> -->
                        <div class="col-sm-9">
                            <select class="form-control" name="jenis" id="jenis">
                            <option value=""> Pilih Kunjungan </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-lg-1" >
                      <button type="button" id="play" name="play" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Setel</button>
                </div>
              </div>
            </div>

        <section id="soalsoal">
        <!-- <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman Brief SKenario </strong></h4>
                <div class="form-horizontal style-form">
                    <audio controls id="syukurcover" src="Everytime.mp3"></audio>
            </div>
            </div>
           </div>
           </div> -->
        </section>


        <section id="file_skenario">
          

        </section>
        <!-- <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> DIALOG  </strong></h4>
                    <?php if($sts_quest['status']!== '0'):?>
                    <div style="height:1400px;"><embed src="<?= base_url('assets/file/dialog/')?><?=$db['upload_dialog']?>" type="application/pdf" width="100%" height="100%"></div>
                    <?php else :?>
                    <textarea class="form-control" name="dialog" id="dialog" placeholder="Dialog Belum diupload" rows="10" style="height:1400px;" readonly><?=str_replace("<br />"," ", $db['r_teks_dialog'])?></textarea>
                    <?php endif?>
        </div> -->

        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Test Kuis</strong> </h4>
              <!-- <button type="submit" id="" name="" class="btn btn-round btn-success pull-right"><i class="fa fa-check-circle fa-fw"></i> Mulai Kuis</button> -->
              <button type="button" id="mulaikuis" name="" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Mulai Kuis</button>
              <br>
              <br>
            </div>


            </form>
          </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->