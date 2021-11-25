<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Dashboard - Client</h3>
        <div class="row mt">
          <div class="col-lg-12">


        <div class="row mt">
          <div class="col-lg-8">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Buat Akun Client</strong> </h4>
              <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Client</label>
                  <div class="col-sm-8">
                    <input type="name" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap Client.." value="<?= $data_user['nama_user']?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal Lahir</label>
                  <div class="col-sm-8">
                    <input type="name" class="form-control" id="tgl" name="tgl" placeholder="dd-mm-yyyy" value="<?= $data_user['tanggal']?>">
                    <?= form_error('tgl', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jenis Kelamin</label>
                  <div class="col-sm-8">
                      <select class="form-control" name="jk" id="jk">
                          <?php foreach($jk as $j) :?>
                          <?php if ($data_user['jenis_kelamin']==$j['id_gender']) :?>
                            <option value="<?=$j['id_gender']?>" selected> <?= $j['nama_gender']?> </option>
                            <?php else :?>
                            <option value="<?=$j['id_gender']?>"> <?= $j['nama_gender']?> </option>
                            <?php endif?>
                          <?php endforeach?>
                       </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">User ID Client</label>
                  <div class="col-sm-8">
                    <input type="name" class="form-control" id="id" name="id" value="<?= $data_user['id_user']?>" readonly>
                  </div>
                </div>

              <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('dashboard')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
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