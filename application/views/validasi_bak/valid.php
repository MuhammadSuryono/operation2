    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Validasi Dialog - Rekaman </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Project </strong></h4>
                      <div class="row">
                        <form action="<?= base_url('validasi/valid')?>" method="post">
                        <div class="col-md-3 mb">
                            <select class="form-control" name="project" id="project">
                                <option value=""> Pilih Skenario </option>
                                <?php foreach($skenario as $sk) :?>
                                <option value="<?=$sk['id_project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Lihat </button>
                        </div>
                        </form>
                  </div>
              </div>
          </div>
          </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Dialog - Rekaman </strong></h4>
                    <section id="unseen">
                        <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Nama Project</th>
                            <th>Nama Skenario</th>
                            <th>Nama Cabang</th>
                            <th>Nama SHP</th>
                            <th>Teks Dialog</th>
                            <th>File Rekaman</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($rekap as $db) :?>
                            <?php if($no%2!=0):?>
                                <tr>
                                <td style="background-color : #ffffff;">
                                <?php else :?>
                                <tr style="background-color : #e2e4ff;">
                                <td>
                                <?php endif?>
                                    <?= ++$no?></td>
                                    <td><?= $db['nama_project']?></td>
                                    <td><?= $db['nama_skenario']?></td>
                                    <td><?= $db['nama_cabang']?> (<?=$db['kode_cabang']?>)</td>
                                    <td><?= $db['nama_user']?></td>
                                    <td><?= substr($db['teks_dialog'],0,100)?></td>
                                    <td><?= $db['file_rekaman']?></td>
                                    <?php if($db['sts_rekaman']==0 or $db['sts_dialog']==0) : ?>
                                    <td><a href="<?= base_url('validasi/cekvalid/')?><?=$db['id_rekaman']?>/<?= $db['id_dialog']?>" class="btn btn-round btn-warning btn-xs"><span class="fa fa-exclamation fa-fw"></span> Lihat </a></td>
                                    <?php else :?>
                                    <td><a href="<?= base_url('validasi/cekvalid/')?><?=$db['id_rekaman']?>/<?= $db['id_dialog']?>" class="btn btn-round btn-success btn-xs"><span class="fa fa-exclamation fa-fw"></span> Lihat </a></td>
                                    <?php endif?>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                        </table>
                    </section>
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