<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> STKB || Matrix Perdin </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Matrix Perdin </strong> </h4>
                    <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>


                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Project</th>
                      <th>Kode </th>
                      <th>Nama </th>
                      <th>Telepon </th>
                      <th>Alamat</th>
                      <th>Kota</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0;?>
                      <?php foreach($cabang as $db) :?>
                      <?php if($no%2!=0):?>
                      <tr>
                      <?php else :?>
                      <tr style="background-color : #e2e4ff;">
                         <?php endif?>
                            <td><?= ++$no?></td>
                            <td><?= $db['project']?></td>
                            <td><?= $db['kode']?></td>
                            <td><?= $db['nama']?></td>
                            <td><?= $db['notelpon']?></td>
                            <td><?= $db['alamat']?></td>
                            <td><?= $db['kota']?></td>
                            <td>
                                <a href="<?= base_url('cabang/ubah/')?><?= $db['num']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>
                                <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['num']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Data Cabang</h4>
                                </div>
                                <div class="modal-body">
                                Yakin ingin menghapus Cabang <strong><?= $db['nama']?></strong> ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('cabang/hapus/')?><?= $db['num']?>" type="button" class="btn btn-primary btn-round">Hapus</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->
                      <?//php $no++?>
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
