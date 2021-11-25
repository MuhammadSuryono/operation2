<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Equest</h3>
        <div class="row mt">
          <div class="col-lg-12">


        <div class="row mt">
          <div class="col-lg-8">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Ubah Soal Kuis </strong> </h4>
              <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
              <form class="form-horizontal style-form" method="post">
                  <input type="hidden" id="id" name="id" value="<?= $data_kuis['id_kuis']?>">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Soal </label>
                  <div class="col-sm-8">
                     <textarea class="form-control" name="soal" id="soal" placeholder="Pertanyaan.." rows="1" required><?=$data_kuis['soal_kuis']?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Benar</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="jb" id="jb" value="<?=$data_kuis['benar_kuis']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 1</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js1" id="js1" value="<?=$data_kuis['salah1_kuis']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 2</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js2" id="js2" value="<?=$data_kuis['salah2_kuis']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 3</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js3" id="js3" value="<?=$data_kuis['salah3_kuis']?>">
                  </div>
                </div>

              <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('equest')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
                <br>
                <br>
              </form>
            </div>
          </div>



          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->