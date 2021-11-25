<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Project</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
          <div class="col-lg-8">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Input Project </strong></h4>
                <form class="form-horizontal style-form" method="post" action="<?= base_url('project/tambah')?>" enctype='multipart/form-data'>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Project</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama')?>" required>
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Bank</label>
                  <div class="col-sm-9">
                        <select name="bank" class="selectpicker form-control" data-live-search="true" required>
                            <option value="">Nama Bank </option>
                            <?php foreach($bank as $key) :?>
                            <option value="<?=$key['kode']?>"> <?= $key['nama']?> </option>
                            <?php endforeach?>
                        </select>
                  </div>
                </div>
                <?php
                $kode = random_string('alpha',3);
                // $num = random_string('nozero',1);
                $rand = rand(1, 9);
                 ?>
                 <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Project Untuk Client</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="project_client" id="project_client" value="">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Kode Project</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="kode" id="kode" value="<?= strtoupper($kode.$rand)?>" readonly required>
                    <?= form_error('kode', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Channel</label>
                  <div class="col-sm-9">
                      <select class="selectpicker form-control" name="channel" id="channel" data-live-search="true" required>
                         <option value="">Channel </option>
                        <option value="ATM Center"> ATM Center </option>
                        <option value="WIC"> WIC </option>
                        <option value="Digital Banking"> Digital Banking </option>
                        <option value="E-Banking"> E-Banking </option>
                        
                       </select>
                  </div>
                </div>


                <div class="form-group">
                  <label class="col-sm-3 control-label">Start Project</label>
                  <div class="col-sm-8">
                       <input name="tgl" id="tgl" class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="<?= date('m-d-Y')?>" required>
                       <span class="input-group-btn add-on" >
                        <button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">End Project</label>
                  <div class="col-sm-8">
                       <input name="tgl2" id="tgl2" class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="<?= date('m-d-Y')?>" required>
                       <span class="input-group-btn add-on" >
                        <button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jenis Project</label>
                  <div class="col-sm-9">
                      <select class="form-control" name="jenis" id="jenis" required>
                        <option value="n"> Adhoc </option>
                        <option value="i"> Industri </option>
                       </select>
                  </div>
                </div>

                <!-- <div class="form-group">
                  <label class="control-label col-md-3">Project Spesification</label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="projectspec" id="projectspec" required/>
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Berkas ( .pdf )
                      </span>
                  </div>
                </div> -->

                <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('project')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
                <br>
                <br>
              </form>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>