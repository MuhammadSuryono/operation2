<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Bukti Kunjungan</h3>
        <div class="row mt">
          <div class="col-lg-12">
            
             <!--ADVANCED FILE INPUT-->
        <div class="row mt">
          <div class="col-lg-8">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Upload Kelengkapan Kunjungan </strong></h4>
              <form class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Pilih Skenario</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="jenis" id="jenis">
                    <option value="0"> Skenario Yang Dijalankan </option>
                      <?php foreach($jenis_skenario as $sk) :?>
                      <?php if($data_kunjungan['id_skenario'] == $sk['id_skenario']):?>
                      <option value="<?=$sk['id_skenario']?>" selected> <?=$sk['nama_skenario']?> </option>
                      <?php else :?>
                      <option value="<?=$sk['id_skenario']?>" selected> <?=$sk['nama_skenario']?> </option>
                      <?php endif?>
                      <?php endforeach?>
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">File Slip Transaksi</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $data_kunjungan['gambar_transaksi']?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">File Screenshot Equest</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $data_kunjungan['gambar_equest']?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">File Layout Cabang</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $data_kunjungan['gambar_layout']?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3"> Slip Transaksi </label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="transaksi" id="transaksi" />
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Gambar ( .jpg, .gif, .png )
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3"> Screenshot Equest </label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="equest" id="equest" />
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Gambar ( .jpg, .gif, .png )
                      </span>
                  </div>
                </div>

                 <div class="form-group">
                  <label class="control-label col-md-3"> Layout Cabang </label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="layout" id="layout" />
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Gambar ( .jpg, .gif, .png )
                      </span>
                  </div>
                </div>

                <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('shp/daftarkunjungan')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
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