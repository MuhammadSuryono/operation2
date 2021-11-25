<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Bukti Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Bukti Kunjungan  </strong></h4>
                
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
                      <th>Kunjungan</th>
                      <th>File Layout Cabang </th>
                      <th>File Screenshot Equest</th>
                      <th>File Slip Transaksi</th>
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
                            <!-- <td><?= $db['nama_project']?></td> -->
                            <td><?= $db['nama']?></td>
                            <td><?= $db['skenariox']?></td>
                            <td><?= $db['kunjunganx']?></td>

                            <?php if($db['r_sts_upload_layout']==0) :?>
                            <td class="text-warning"><?= $db['upload_layout']?></td>
                            <?php endif?>
                            <?php if($db['r_sts_upload_layout']==1) :?>
                            <td class="text-primary"><?= $db['upload_layout']?></td>
                            <?php endif?>
                            <?php if($db['r_sts_upload_layout']==2) :?>
                            <td class="text-danger"><?= $db['upload_layout']?></td>
                            <?php endif?>

                            <?php if($db['r_sts_upload_ss']==0) :?>
                            <td class="text-warning"><?= $db['upload_ss']?></td>
                            <?php endif?>
                            <?php if($db['r_sts_upload_ss']==1) :?>
                            <td class="text-primary"><?= $db['upload_ss']?></td>
                            <?php endif?>
                            <?php if($db['r_sts_upload_ss']==2) :?>
                            <td class="text-danger"><?= $db['upload_ss']?></td>
                            <?php endif?>

                            <?php if($db['r_sts_upload_slip_transaksi']==0) :?>
                            <td class="text-warning"><?= $db['upload_slip_transaksi']?></td>
                            <?php endif?>
                            <?php if($db['r_sts_upload_slip_transaksi']==1) :?>
                            <td class="text-primary"><?= $db['upload_slip_transaksi']?></td>
                            <?php endif?>
                            <?php if($db['r_sts_upload_slip_transaksi']==2) :?>
                            <td class="text-danger"><?= $db['upload_slip_transaksi']?></td>
                            <?php endif?>

                            <td>
                                <a href="<?= base_url('shp/lihat/')?><?= $db['num']?>" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-warning fa-fw"></span> Lihat </a>

                                <a href="<?= base_url('shp/ubahkunjunganKB/')?><?= $db['num']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>
                            </td>
                        </tr>

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
