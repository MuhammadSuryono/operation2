<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Rekap Skill</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Skenario </strong></h4>
                <div class="row">
                <form action="<?= base_url('rekap')?>" method="post">
                <div class="col-md-3 mb">
                    <select class="form-control" name="project" id="project">
                        <option value=""> Pilih Skenario </option>
                        <?php foreach($skenario as $sk) :?>
                        <option value="<?=$sk['id_project']?>"> <?=$sk['nama_project']?> </option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Buat</button>
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
                      <th>Nama Skenario</th>
                      <th>Nama Cabang</th>
                      <th>Nama Pembuat</th>
                      <th>Dialog</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($buat_equest as $db) :?>
                      <?php if($no%2!=0):?>
                          <tr>
                          <td style="background-color : #ffffff;">
                          <?php else :?>
                          <tr style="background-color : #e2e4ff;">
                          <td>
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_skenario']?></td>
                            <td><?= $db['nama_cabang']?></td>
                            <td><?= $db['nama_user']?></td>
                            <td><?= substr($db['teks_dialog'], 0, 100)?></td>
                            <td>
                                <?php if($db['sts_dialog'] == 0) :?>
                                <a href="<?= base_url('rekap/rekap/')?><?= $db['id_dialog']?>" class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Rekap</a>
                                <?php else :?>
                                <a href="<?= base_url('rekap/rekap/')?><?= $db['id_dialog']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Rekap</a>
                                <?php endif?>

                            </td>
                        </tr>

                      <?php endforeach?>
                  </tbody>
                </table>
                 <h5><span class="fa fa-square fa-fw text-warning"></span>-- Belum direkap</h5>
                <h5><span class="fa fa-square fa-fw text-success"></span>-- Sudah direkap</h5>
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