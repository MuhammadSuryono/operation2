<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Cek Konsistensi Jawaban </h3>
        <div class="row mt">
          <div class="col-lg-12">

        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Jawaban Equest </strong></h4>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Kode Kunjungan</th>
                      <th>Nama Cabang</th>
                      <th>Jawaban</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($jawaban as $db) :?>
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
                            <td><?php $satu = str_replace('|', ', ', $db['jawaban_equest']); 
                            echo str_replace('#@!', '', $satu)?></td>
                            <td>
                                <!-- <a href="<?= base_url('equestisi/ubah/')?><?= $db['id_jawaban']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a> -->

                                <a href="<?= base_url('equestisi/lihatKonsistensi/')?><?= $db['id_jawaban']?>" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;" ><span class="fa fa-warning fa-fw"></span>Lihat</a>

                                <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['id_jawaban'];?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['id_jawaban']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel"> Hapus Data Jawaban Equest </h4>
                                </div>
                                <div class="modal-body">
                                Yakin Ingin Menghapus Data Jawaban Equest Skenario <strong> <?= $nama_skenario['nama_skenario']?> ?</strong>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('equestisi/hapus/')?><?= $db['id_jawaban']?>" type="button" class="btn btn-primary">Hapus</a>
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
    <!-- /MAIN CONTENT -->
    <!--main content end-->