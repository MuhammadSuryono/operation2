
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Bukti Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Bukti Kunjungan  </strong></h4>
                <form action="<?= base_url('validasi')?>" method="post">
                <div class="row mb">
                <div class="col-md-3">
                    <select class="form-control" name="div" id="div">
                        <option value=""> Pilih Skenario Yang Dijalankan </option>
                      <?php foreach ($skenario as $div) :?>
                        <!-- <option value="<?= $div['id_skenario']?>"> <?= $div['nama_skenario']?> </!--> -->
                        <option value="<?= $div['id_project']?>"> <?= $div['nama_project']?> </option>
                      <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                <button type="submit" class="btn btn-round btn-primary pull-right" style="margin-right:0.5rem;"><i class="fa fa-search fa-fw"></i> Tampilkan </button>
                </div>
                </div>
                </form>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Skenario</th>
                      <th>Nama SHP</th>
                      <th>User Id</th>
                      <th>Nama Cabang</th>
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
                            <td><?= $db['nama_skenario']?></td>
                            <td><?= $db['nama_user']?></td>
                            <td><?= $db['id_user']?></td>
                            <td><?= $db['nama_cabang']?></td>
                            
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
                                <a href="<?= base_url('validasi/lihat/')?><?= $db['id_kunjungan']?>" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-warning fa-fw"></span> Lihat </a>
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
