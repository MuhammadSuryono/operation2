<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Dashboard Clients</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Clients </strong></h4>
                <a href="<?= base_url('dashboard/tambah')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah</a>
                
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama </th>
                      <th>User ID</th>
                      <th>Gender</th>
                      <th>Tanggal Lahir</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($data_user as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td style="background-color : #e2e4ff;">
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_user']?></td>
                            <td><?= $db['id_user']?></td>
                            <td><?= $db['nama_gender']?></td>
                            <td><?= $db['tanggal']?></td>
                            <td>
                                <a href="<?= base_url('dashboard/ubah/')?><?= $db['id_user']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>

                                        <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['id_user']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['id_user']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Data User</h4>
                                </div>
                                <div class="modal-body">
                                Yakin ingin menghapus user <strong><?= $db['nama_user']?></strong> ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('dashboard/hapus/')?><?= $db['id_user']?>" type="button" class="btn btn-primary btn-round">Hapus</a>
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
