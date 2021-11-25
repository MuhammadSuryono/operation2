    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Cabang Bank</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Tambah Cabang Kunjungan </strong></h4>
                    <form class="form-horizontal style-form" method="post">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Kode Project</label>
                        <div class="col-sm-2">
                        <select class="form-control" name="project" id="project" required="required">
                            <option value="">Kode Project</option>
                                <?php
                                foreach ($project as $project) {
                                ?>
                                <option value="<?php echo $project['kode_project'];?>"> <?php echo $project['kode_project']; ?> </option>
                                <?php
                                }
                                ?>
                        <select>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Kode Cabang</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode" id="kode" value="<?= set_value('kode')?>">
                            <?= form_error('kode', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Cabang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama" id="nama" value="<?= set_value('nama')?>">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Telepon</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="notelpon" id="notelpon" value="<?= set_value('notelpon')?>">
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Alamat Cabang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" id="alamat" value="<?= set_value('alamat')?>">
                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Kota/Kab Cabang</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="kota" id="kota">
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Provinsi Cabang</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="provinsi" id="provinsi">
                        </div>
                        </div>

                        <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                        <a href="<?= base_url('cabang')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
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
    <!-- /MAIN CONTENT -->
    <!--main content end-->