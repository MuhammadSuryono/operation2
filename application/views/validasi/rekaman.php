<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Rekaman Kunjungan SHP</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Cari Rekaman Kunjungan </strong></h4>
                <div class="row">
                <form action="<?= base_url('validasi/rekaman')?>" method="post">
                <div class="col-md-3 mb">
                    <select class="form-control" name="project" id="project">
                        <option value=""> Pilih Project Yang Dijalankan </option>
                        <?php foreach($project as $sk) :?>
                        <option value="<?=$sk['id_project']?>"> <?=$sk['nama_project']?> </option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Tampilkan</button>
                </div>
                </form>
            </div>
           </div>
           <div class="row mt">
                <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Rekaman Kunjungan </strong></h4>

                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Nama Skenario</th>
                      <th>Nama User</th>
                      <th>Nama Cabang</th>
                      <th>Nama File Rekaman</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($rekaman as $db) :?>
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
                            <td><?= $db['nama_user']?></td>
                            <td><?= $db['nama_cabang']?></td>
                            <td><?= $db['file_rekaman']?></td>
                            
                            <td>
                                <a href="" class="btn btn-primary btn-round btn-xs"  style="margin-right : 0.5rem;" data-toggle="modal" data-target="#dengar<?= $db['id_rekaman']; ?>"><span class="fa fa-headphones fa-fw"></span> Dengar </a>

                                <?php if($db['sts_rekaman'] == '0') : ?>
                                <a href="<?= base_url('validasi/updateStsRekaman/')?><?= $db['id_rekaman']?>" class="btn btn-warning btn-round btn-xs"  style="margin-right : 0.5rem;"><span class="fa fa-check fa-fw"></span> Cek </a>
                                <?php else : ?>
                                <a href="<?= base_url('validasi/updateStsRekaman/')?><?= $db['id_rekaman']?>" class="btn btn-success btn-round btn-xs"  style="margin-right : 0.5rem;"><span class="fa fa-check fa-fw"></span> Cek </a>
                                <?php endif?>
                            </td>
                        </tr>

                        <!-- MODAL DENGAR -->
                        <div class="modal fade" id="dengar<?= $db['id_rekaman']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Dengarkan Rekaman</h4>
                                </div>
                                <div class="modal-body">
                                <audio controls id="rekaman" src="<?=base_url('assets/')?>file/rekaman/<?= $db['file_rekaman']?>"></audio>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-round" data-dismiss="modal"> OK </button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL DENGAR -->
                        

                      <?php endforeach?>
                  </tbody>
                </table>
              </section>


                </div>
                </div>
            </div>


           </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
