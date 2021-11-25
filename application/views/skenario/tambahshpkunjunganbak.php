<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> MRI OPERATION </h3>
        <div class="row mt">
          <div class="col-lg-12">


        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Kunjungan SHP </strong> </h4>
              <form class="form-horizontal style-form" method="post" action="<?= base_url('skenario/tambahkunjunganshp')?>">

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Project </label>
                  <div class="col-sm-4">
                      <select class="form-control" name="project" id="project">
                        <option value=""></option>
                      <?php foreach ($data_project as $div) :?>
                        <option value="<?= $div['kode_project']?>"> <?= $div['nama_project'] ?> </option>
                      <?php endforeach?>
                       </select>
                  </div>

                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label"> Pilih Kunjungan </label>
                  <section id="kunjungan">
                  
                  <div class="col-sm-6">
                     
                       <label class="checkbox-inline">
                            <input type="checkbox" id="check[]" name="check[]" value="option1"> 1
                        </label>
                        <label class="checkbox-inline">
                                <input type="checkbox" id="check[]" name="check[]" value="option2"> 2
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" id="check[]" name="check[]" value="option3"> 3
                        </label>

                        <label class="checkbox-inline">
                            <input type="checkbox" id="check[]" name="check[]" value="option3"> 4
                        </label>

                        <label class="checkbox-inline">
                            <input type="checkbox" id="check[]" name="check[]" value="option3"> 5
                        </label>
                      
                  </div>

                  </section>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Pilih Cabang </label>
                  <div class="col-sm-6">
                      <select name="pilihcabang" id="pilihcabang" class="form-control" required>
                        <option value=""></option>
                       </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama SHP </label>
                  <div class="col-sm-6">
                      <select name="shp" id="shp" class="selectpicker form-control" data-live-search="true">
                        <option value=""></option>
                      <?php foreach ($data_user as $div) :?>
                        <option value="<?= $div['Id']?>"><?= $div['Id']?> - <?= $div['Nama'] ?> </option>
                      <?php endforeach?>
                       </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Start Project</label>
                  <div class="col-sm-8">
                       <input name="tgl" id="tgl" class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="<?= date('m-d-Y')?>">
                       <span class="input-group-btn add-on" >
                        <button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">End Project</label>
                  <div class="col-sm-8">
                       <input name="tgl2" id="tgl2" class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" value="<?= date('m-d-Y')?>">
                       <span class="input-group-btn add-on" >
                        <button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
                        </span>
                  </div>
                </div>

              <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('skenario/shp')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
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