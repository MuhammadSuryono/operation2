<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Hasil Rekap Skill</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Skenario </strong></h4>
                <div class="row">
                <form action="<?= base_url('rekap/hasil')?>" method="post">
                <div class="col-md-3 mb">
                    <select class="form-control" name="project" id="project">
                        <option value=""> Pilih Skenario </option>
                        <?php foreach($skenario as $sk) :?>
                        <option value="<?=$sk['id_project']?>"> <?=$sk['nama_project']?> </option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Lihat </button>
                </div>
                </form>
            </div>
           </div>   


            <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Dialog </strong></h4>

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
                      <th>Nama Cabang</th>
                      <th>Nama SHP</th>
                      <?php foreach($skill as $sk) :?>
                      <th><?= $sk['kode_kolom']?></th>
                      <?php endforeach?>
                      <!-- <th>A</th>
                      <th>B</th>
                      <th>C</th>
                      <th>D</th>
                      <th>E</th> -->
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($rekap as $db) :?>
                      <?php if($no%2!=0):?>
                          <tr>
                          <td style="background-color : #ffffff;">
                          <?php else :?>
                          <tr style="background-color : #e2e4ff;">
                          <td>
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['nama_skenario']?></td>
                            <td><?= $db['nama_cabang']?> (<?=$db['kode_cabang']?>)</td>
                            <td><?= $db['nama_user']?></td>
                            <?php foreach($skill as $sk) :?>
                            <td><?= $db[$sk['kode_kolom']]?></td>
                            <?php endforeach?>
                            <!-- <td><?= $db['a']?></td>
                            <td><?= $db['b']?></td>
                            <td><?= $db['c']?></td>
                            <td><?= $db['d']?></td>
                            <td><?= $db['e']?></td> -->
                            <!-- <td>
                                <?php if($db['sts_dialog'] == 0) :?>
                                <a href="<?= base_url('rekap/rekap/')?><?= $db['id_dialog']?>" class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Rekap</a>
                                <?php else :?>
                                <a href="<?= base_url('rekap/rekap/')?><?= $db['id_dialog']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Rekap</a>
                                <?php endif?>

                            </td> -->
                        </tr>

                      <?php endforeach?>
                  </tbody>
                </table>
                <a href="<?= base_url('rekap/cetak/')?><?=$skn?>" target="_blank" class="btn btn-round btn-success"><span class="fa fa-save fa-fw"></span> Cetak </a>
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