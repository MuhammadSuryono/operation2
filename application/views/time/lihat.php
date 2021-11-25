    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery </h3>
        <div class="row mt">
          <div class="col-lg-12">

           <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Project </strong></h4>
                      <div class="row">
                        <form action="<?= base_url('time/lihat')?>" method="post">
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
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Time Delivery </strong></h4>

                <section id="unseen">
                <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <?php foreach($kolom as $klm) : ?>
                      <th><?=$klm['COLUMN_NAME']?></th>
                      <?php endforeach?>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($isi as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <?php foreach($kolom as $klm) : ?>

                              <?php if($klm['COLUMN_NAME']=='id_project') :?>
                              <td><?=$db['nama_project']?></td>
                                <?php elseif($klm['COLUMN_NAME']=='id_skenario') :?>
                                <td><?=$db['nama_skenario']?></td>
                                <?php elseif($klm['COLUMN_NAME']=='id_user') :?>
                                <td><?=$db['nama_user']?></td>
                                <?php elseif($klm['COLUMN_NAME']=='kode_cabang') :?>
                                <td><?=$db['nama_cabang']?> (<?= $db['kode_cabang']?>)</td>
                              <?php else :?>
                              <td><?=$db[$klm['COLUMN_NAME']]?></td>
                              <?php endif?>

                            <?php endforeach?>
                            <td>
                                <!-- <a href="<?= base_url('time/ubah/')?><?= $db['id_waktu']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a> -->

                                        <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['id_waktu']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['id_waktu']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Data Time Delivery </h4>
                                </div>
                                <div class="modal-body">
                                Yakin ingin menghapus Data Time Delivery berikut ini..?<br>
                                <br> Nama Project : <strong><?= $db['nama_project']?></strong> .
                                <br> Nama Skenario : <strong><?= $db['nama_skenario']?></strong> .
                                <br> Nama User : <strong><?= $db['nama_user']?></strong> .
                                <br> Nama Cabang : <strong><?= $db['nama_cabang']?> (<?=$db['kode_cabang']?>)</strong> .
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('time/hapus/')?><?= $db['id_waktu']?>" type="button" class="btn btn-primary btn-round">Hapus</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->

                      <?php endforeach?>  
                  </tbody>
                </table>
                </div>
              </section>

                    </div>
                <a href="<?= base_url('time/ubah/')?><?= $project?>" class="btn btn-success btn-round" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Cetak</a>
                </div>
            </div>
            

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->