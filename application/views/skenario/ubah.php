<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Skenario</h3>
        <div class="row mt">
          <div class="col-lg-12">
            
           <!--ADVANCED FILE INPUT-->
        <div class="row mt">
          <div class="col-lg-8">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Ubah Rekaman Briefing dan Skenario </strong></h4>
              <form action="" class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Kunjungan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="skenario" id="skenario" value="<?= $data_skenario['kunjungan']?>">
                    <?= form_error('skenario', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama File Rekaman Briefing</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="file_skenario" id="file_skenario" value="<?= $data_skenario['file_skenario']?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama File Kuis</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="file_kuis" id="file_kuis" value="<?= $data_skenario['file_kuis']?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Rekaman Briefing</label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Update Berkas</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="berkas" id="berkas"/>
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Rekaman ( .mp3, .wav, .wma, .ogg )
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Berkas Kuis</label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Update Berkas</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="kuis" id="kuis"/>
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Dokumen ( .pdf )
                      </span>
                  </div>
                </div>

                <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('skenario')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
                <br>
                <br>
                </div>
              </form>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->