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
          <div class="col-lg-8">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Buat Akun </strong> </h4>
              <form class="form-horizontal style-form" method="post" action="<?= base_url('akun/tambah') ?>">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Lengkap</label>
                  <div class="col-sm-8">
                    <input type="name" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap.." value="<?= set_value('nama') ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Divisi</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="div" id="div">
                      <?php foreach ($divisi as $div) : ?>
                        <option value="<?= $div['id'] ?>"> <?= $div['keterangan_divisi'] ?> </option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>
                <?php
                $tgl = '01' . date('m');
                $jumlah = $this->db->query("SELECT * FROM user WHERE noid LIKE '%$tgl%'")->num_rows();
                $jumlah = $jumlah + 1;

                if ($jumlah < 10) {
                  $id = '00' . $jumlah;
                } else if ($jumlah < 100) {
                  $id = '0' . $jumlah;
                } else {
                  $id = $jumlah;
                }
                $id = '01' . date('m') . $id;
                ?>
                <div class="form-group">
                  <label class="col-sm-3 control-label">User ID </label>
                  <div class="col-sm-8">
                    <input type="name" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Ulangi Password</label>
                  <div class="col-sm-8">
                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi Password">
                    <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
                <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('akun') ?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
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