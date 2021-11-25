<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Equest</h3>
        <div class="row mt">
          <div class="col-lg-12">

        <form action="<?=base_url('equest/tambah1')?>" method="post">
          <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Buat Soal Kuis</strong> </h4>
               <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
              <div class="row">
                  <div class="col-lg-4">
                      <div class="form-group">
                        <!-- <label class="col-sm-3 control-label">Pilih Project</label> -->
                        <div class="col-sm-6">
                            <select name="projectkuis" id="projectkuis" class="selectpicker form-control" data-live-search="true">
                                <option value="">Pilih Project</option>
                                <?php foreach($jenis_skenario as $sk) :?>
                                <option value="<?=$sk['kode_project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                      <div class="form-group">
                        <!-- <label class="col-sm-3 control-label">Pilih Skenario</label> -->
                        <div class="col-sm-6">
                            <select name="kunjungan" id="kunjungan" class="form-control">
                                <option value="">Pilih Kunjungan</option>
                            </select>
                        </div>
                    </div>
                  </div>
                  <section id="jumlah"><label class="col-lg-2 control-label jumlah">Jumlah Soal : 0</label></section>
                    
                  <div class="col-lg-3" style="margin-left:-200px;">
                      <button type="button" id="buat" name="buat" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Buat</button>
                  </div>
              </div>
            </div>

        <section id="soalsoal">
          <!-- isi dengan ajax -->
        </section>

        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Simpan Soal Kuis</strong> </h4>
              <button type="submit" id="" name="" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
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