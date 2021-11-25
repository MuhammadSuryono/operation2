<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Dialog</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Dialog </strong></h4>
                <!-- <a href="<?= base_url('shp/tambah')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus-circle fa-fw"></i> Buat Dialog </a> -->

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Nama Skenario</th>
                      <th>Nama Cabang</th>
                      <th>Kunjungan</th>
                      <th>File Dialog</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no=0; foreach($data_dialog as $db) :?>
                      <?php if($no%2==0):?>
                            <tr style="background-color : #e2e4ff;">
                            <td>
                            <?php else :?>
                            <tr>
                            <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['skenariox']?></td>
                            <td><?= $db['cabang']?></td>
                            <td><?= $db['kunjunganx']?></td>
                            <td><?= $db['upload_dialog']?></td>
                            <td>
                                <a href="<?= base_url('shp/ubahKB/')?><?= $db['num']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>

                                        <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['num']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel"> Hapus Dialog </h4>
                                </div>
                                <div class="modal-body">
                                Yakin Ingin Menghapus Dialog Skenario Ini..?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('shp/hapus/')?><?= $db['num']?>" type="button" class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->
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
