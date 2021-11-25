<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Project</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Project </strong></h4>
                <a href="<?= base_url('project/tambah')?>" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Tambah</a>
                
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Project</th>
                      <th>Nama Project</th>
                      <th>Nama Bank</th>
                      <th>Start Project</th>
                      <th>End Project</th>
                      <th>Jenis Project</th>
                      <!-- <th>Project Spec</th> -->
                      <!-- <th>Aksi</th> -->
                    </tr>
                  </thead>
                  <tbody>
                      <?php foreach($data_project as $db) :?>
                      <?php if($start%2!=0):?>
                          <tr>
                          <td style="background-color : #ffffff;">
                          <?php else :?>
                          <tr style="background-color : #e2e4ff;">
                          <td>
                         <?php endif?>
                            <?= ++$start?></td>
                            <td><?= $db['kode']?></td>
                            <td><?= $db['nama']?></td>
                            <td><?= $db['bank']?></td>
                            <td><?= $db['tanggal']?></td>
                            <td><?= $db['tanggal2']?></td>
                            <?php if($db['type'] == 'n') :?>
                            <td>Adhoc</td>
                            <?php else :?>
                            <td>Industri</td>
                            <?php endif?>
                            <!-- <td><a href="<?=base_url('project/download/')?><?= $db['file_projectspec']?>" target="_blank"><?= $db['file_projectspec']?></a></td> -->
                            <!-- <td>
                                <a href="<?= base_url('project/ubah/')?><?= $db['kode']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>

                                <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['kode']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td> -->
                        </tr>

                        <!-- MODAL HAPUS -->
                        <!-- <div class="modal fade" id="hapus<?= $db['kode']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel"> Hapus Data Project </h4>
                                </div>
                                <div class="modal-body">
                                Yakin Ingin Menghapus Project <strong> <?= $db['nama']?> ?</strong>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('project/hapus/')?><?= $db['kode']?>" type="button" class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                            </div>
                        </div> -->
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
