<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> MRI OPERATION </h3>
    <div class="row mt">
      <div class="col-lg-12">


        <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Account </strong></h4>
              <a href="<?= base_url('akun/tambah') ?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah</a>

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
              <div class="col-lg-12">
                <?= $this->session->flashdata('info'); ?>
              </div>

              <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama </th>
                      <th>User ID</th>
                      <th>Divisi</th>
                      <th>Aksi</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0;
                    foreach ($akun as $db) : ?>
                      <?php if ($no % 2 == 0) : ?>
                        <tr style="background-color : #e2e4ff;">
                          <td style="background-color : #e2e4ff;">
                          <?php else : ?>
                        <tr>
                          <td style="background-color : #ffffff">
                          <?php endif ?>
                          <?= ++$no ?></td>
                          <td><?= $db['name'] ?></td>
                          <td><?= $db['noid'] ?></td>
                          <td><?= $db['keterangan_divisi'] ?></td>
                          <td>
                            <a href="<?= base_url('akun/ubah/') ?><?= $db['noid'] ?>" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>

                            <!-- <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['noid']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a> -->
                          </td>
                          <td>
                                            <?php if ($db['status'] == '0') {
                                              
                                        ?>
                                            <a href="<?php echo base_url('akun/ubahstatus/'.$db['noid'].'/1') ?>" type="button" class="btn btn-danger btn-round btn-xs" title="Disable" onclick="return(false);"><i class="fas fa-times-circle" ></i>  &nbsp;Disable</a>
                                        <?php } else if ($db['status'] == '1') {
                                            
                                         ?>
                                            <a href="<?php echo base_url('akun/ubahstatus/'.$db['noid'].'/0') ?>" type="button" class="btn btn-success btn-round btn-xs" title="Enable" onclick="return(false);"><i class="fas fa-check-circle" ></i> &nbsp;&nbsp;Enable</a>
                                        <?php } ?>
                                            
                                            
                                            
                                        </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['noid'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Data User</h4>
                              </div>
                              <div class="modal-body">
                                Yakin ingin menghapus user <strong><?= $db['name'] ?></strong> ?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('akun/hapus/') ?><?= $db['noid'] ?>" type="button" class="btn btn-primary btn-round">Hapus</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->
                      <?php endforeach ?>
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