<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> E-Quest</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar E-Quest </strong></h4>
                <a href="<?= base_url('equest/tambah')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah</a>
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Skenario</th>
                      <th>Soal </th>
                      <th>Jawaban Benar</th>
                      <th>Jawaban Salah 1</th>
                      <th>Jawaban Salah 2</th>
                      <th>Jawaban Salah 3</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php ?>
                      <?php $no = 0; foreach($data_kuis as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_skenario']?></td>
                            <td><?= $db['soal_kuis']?></td>
                            <td><?= $db['benar_kuis']?></td>
                            <td><?= $db['salah1_kuis']?></td>
                            <td><?= $db['salah2_kuis']?></td>
                            <td><?= $db['salah3_kuis']?></td>
                            <td>
                                <a href="<?= base_url('equest/ubah/')?><?= $db['id_kuis']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>

                                        <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['id_kuis']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['id_kuis']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Soal Kuis</h4>
                                </div>
                                <div class="modal-body">
                                Yakin ingin menghapus user <strong><?= $db['soal_kuis']?></strong> ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('equest/hapus/')?><?= $db['id_kuis']?>" type="button" class="btn btn-primary btn-round">Hapus</a>
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
