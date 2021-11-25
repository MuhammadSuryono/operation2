<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Bukti Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Bukti Kunjungan  </strong></h4>
                <a href="<?= base_url('shp/upload')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Buat Bukti Kunjungan</a>
                
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
                      <th>File Slip Transaksi</th>
                      <th>File Screenshot Equest</th>
                      <th>File Layout Cabang </th>
                      <th>Tanggal Input</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($data_kunjungan as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['nama_skenario']?></td>
                            <!-- <td class="text-primary"><?= $db['gambar_transaksi']?></td>
                            <td class="text-primary"><?= $db['gambar_equest']?></td>
                            <td class="text-primary"><?= $db['gambar_layout']?></td> -->

                            <?php if($db['sts_transaksi']==0) :?>
                            <td class="text-warning"><?= $db['gambar_transaksi']?></td>
                            <?php endif?>
                            <?php if($db['sts_transaksi']==1) :?>
                            <td class="text-primary"><?= $db['gambar_transaksi']?></td>
                            <?php endif?>
                            <?php if($db['sts_transaksi']==2) :?>
                            <td class="text-danger"><?= $db['gambar_transaksi']?></td>
                            <?php endif?>

                            <?php if($db['sts_equest']==0) :?>
                            <td class="text-warning"><?= $db['gambar_equest']?></td>
                            <?php endif?>
                            <?php if($db['sts_equest']==1) :?>
                            <td class="text-primary"><?= $db['gambar_equest']?></td>
                            <?php endif?>
                            <?php if($db['sts_equest']==2) :?>
                            <td class="text-danger"><?= $db['gambar_equest']?></td>
                            <?php endif?>

                            <?php if($db['sts_layout']==0) :?>
                            <td class="text-warning"><?= $db['gambar_layout']?></td>
                            <?php endif?>
                            <?php if($db['sts_layout']==1) :?>
                            <td class="text-primary"><?= $db['gambar_layout']?></td>
                            <?php endif?>
                            <?php if($db['sts_layout']==2) :?>
                            <td class="text-danger"><?= $db['gambar_layout']?></td>
                            <?php endif?>

                            <td><?= $db['tanggal']?></td>
                            <td>
                                <a href="<?= base_url('shp/lihat/')?><?= $db['id_kunjungan']?>" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-warning fa-fw"></span> Lihat </a>

                                <a href="<?= base_url('shp/ubahkunjungan/')?><?= $db['id_kunjungan']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>

                                        <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['id_kunjungan']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['id_kunjungan']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Skenario</h4>
                                </div>
                                <div class="modal-body">
                                Yakin ingin menghapus Bukti Kunjungan <strong><?= $db['nama_skenario']?></strong> ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('shp/hapuskunjungan/')?><?= $db['id_kunjungan']?>" type="button" class="btn btn-primary btn-round"> Hapus </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->
                      <?php endforeach?>
                  </tbody>
                </table>

                <h5><span class="fa fa-square fa-fw text-warning"></span>-- Belum divalidasi</h5>
                <h5><span class="fa fa-square fa-fw text-danger"></span>-- Gambar ditolak</h5>
                <h5><span class="fa fa-square fa-fw text-primary"></span>-- Gambar diterima</h5>
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
