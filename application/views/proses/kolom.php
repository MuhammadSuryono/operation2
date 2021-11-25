<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Proses Kolom </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Project </strong></h4>

                    <div class="row">
                        <form action="<?= base_url('proses/buatkolom')?>" method="post">
                        <div class="col-md-3 mb">
                            <select class="form-control" name="project" id="project">
                                <option value=""> Pilih Skenario </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['id_project']?>"> <?=$sk['kode_project']?> - <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Buat</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Database </strong></h4>

                <section id="unseen">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed" id="dataTables-example">
                      <thead>
                        <tr>
                         <?php $t=[]; foreach($fields as $fd) :?>
                          <th><?= $fd['COLUMN_NAME']?></th>
                        <?php endforeach?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($isifields as $ifd):?>
                        <tr>
                          <?php foreach($fields as $fd) :?>
                            <td><?= $ifd[$fd['COLUMN_NAME']]?></td>
                          <?php endforeach?>
                        </tr>
                        <?php endforeach?>
                      </tbody>
                    </table>
                    </div>
                  </section>
              </div>
            </div>
          </div>



          <a href="<?=base_url('proses/cetak')?>" target="_blank" class="btn btn-round btn-success" sttyle="margin-bottom:2rem;"><span class="fa fa-save fa-fw"></span>Cetak</a>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->


