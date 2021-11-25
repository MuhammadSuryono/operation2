<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Blank Page</h3>
        <div class="row mt">
          <div class="col-lg-12">
            
          


          <div class="content-panel">
            <div class="adv-table" style="margin-right : 2rem; margin-left:2rem;">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info" >
                <thead>
                  <tr>
                    <!-- <th>No</!-->
                    <th>Kode Project</th>
                    <th>Nama Project</th>
                    <th>Tanggal Project</th>
                    <th>Jenis Project</th>
                    <th>Jenis Project</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr class="gradeD">
                    <td>Trident</td>
                    <td>Internet Explorer 4.0</td>
                    <td class="hidden-phone">Win 95+</td>
                    <td class="center hidden-phone">4</td>
                    <td class="center hidden-phone">X</td>
                  </tr> -->

                  <?php foreach($data_project as $db) :?>
                         <tr class="gradeD">
                            <td><?= $db['kode_project']?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['tanggal']?></td>
                            <?php if($db['jenis_project'] == 1) :?>
                            <td>Adhoc</td>
                            <?php else :?>
                            <td>Industri</td>
                            <?php endif?>
                            <td>
                                <a href="<?= base_url('project/ubah/')?><?= $db['id_project']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>

                                        <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['id_project']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['id_project']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                </div>
                                <div class="modal-body">
                                <?= $db['nama_project']?>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('project/hapus/')?><?= $db['id_project']?>" type="button" class="btn btn-primary">Hapus</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->

                      <?php endforeach?>
                </tbody>
              </table>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->