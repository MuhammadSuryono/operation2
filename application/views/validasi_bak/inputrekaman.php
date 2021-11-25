    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Input Rekaman</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Kunjungan </strong></h4>
                        <div class="row">
                        
                        <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash') ?>"></div>

                        <form action="<?= base_url('validasi/inputdatarekaman')?>" method="post" enctype='multipart/form-data'>

                        <div class="col-md-2 sm">
                            <select class="form-control" name="sproject" id="sproject" required>
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        </div>

                        <div class="col-md-2 sm">
                            <select class="form-control kunjungan" name="skunjungan" id="skunjungan" required>
                                <option value=""> Pilih Kunjungan </option>
                            </select>
                        </div>

                        <div class="col-md-2 sm">
                            <select class="form-control skenario" name="rekamanskenario" id="rekamanskenario" required>
                                <option value=""> Pilih Skenario </option>
                            </select>
                        </div>

                        <div class="col-md-2 sm">
                            <select class="form-control cabang" name="rekamancabang" id="rekamancabang" required>
                                <option value=""> Pilih Cabang </option>
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih File</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="rekaman" id="rekaman" required/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format File (.mp3, .wav, .ogg)
                                </span>
                        </div>
                        <br></br>
                        <br></br>
                        <br></br>
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="col-md-6">
                              <button type="submit" class="btn btn-success btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Simpan </button>
                            </div>
                          </div>
                        </div>
                        </form>
                  </div>
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