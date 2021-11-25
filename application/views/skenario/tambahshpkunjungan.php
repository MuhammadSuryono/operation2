<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> MRI OPERATION </h3>
        <div class="row mt">
          <div class="col-lg-12">


        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Assign Shopper </strong> </h4>

              <section id="unseen">
                        <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Kareg</th>
                            <th>STKB</th>
                            <th>Nama Project</th>
                            <th>Plan Start</th>
                            <th>Plan End</th>
                            <th>Kota</th>
                            <th>Nama Cabang</th>
                            <th>Kunjungan</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; foreach($data_plan as $db) :
                              $atmcenter = array('064','065','066','067');
                              if (in_array($db['kunjungan'], $atmcenter)){
                                if($db['kunjungan'] == '064' AND $db['shp_weekday_siang'] != NULL){ continue; }
                                else if($db['kunjungan'] == '065' AND $db['shp_weekend_siang'] != NULL){ continue; }
                                else if($db['kunjungan'] == '066' AND $db['shp_weekday_malam'] != NULL){ continue; }
                                else if($db['kunjungan'] == '067' AND $db['shp_weekend_malam'] != NULL){ continue; }
                              }else{
                                $cekQuest = $this->db->query("SELECT num FROM quest WHERE project = '$db[kode_project]' AND kunjungan = '$db[kunjungan]' AND cabang = '$db[kode]'")->num_rows();
                                if($cekQuest >= 1){
                                  continue;
                                }
                              }
                            ?>
                            <?php if($no%2!=0):?>
                            <tr>
                              <td style="background-color : #ffffff;">
                                  <?php else :?>
                                  <tr style="background-color : #e2e4ff;">
                                      <td>
                                        <?php endif?>
                                        <?= ++$no?></td>
                                        <!-- <input type="hidden" id="kunj<?=$db['no']?>" value="<?= $db['kunjungan']?>" name="kunj"> -->
                                        <input type="hidden" id="kunj" value="<?= $db['kunjungan']?>" name="kunj">
                                    <td><?= $db['nama']?></td>
                                    <td><?= $db['nomorstkb']?></td>
                                    <td><?= $db['nama_project']?></td>
                                    <td><?= $db['planstart']?></td>
                                    <td><?= $db['planend']?></td>
                                    <td><?= $db['kota']?></td>
                                    <td><?= $db['cabang']?> (<?=$db['kode']?>)</td>
                                    <td><?= $db['skenario']?></td>
                                    <td><center><a data-toggle="modal" data-target="#modalassignshp" id="assingshp" data-kunj="<?= $db['kunjungan']?>" data-kota="<?= $db['kota']?>" data-kpro="<?= $db['project']?>" data-npro="<?= $db['nama_project']?>" data-cab="<?= $db['cabang']?>" data-kcab="<?= $db['kode']?>" data-stkb="<?= $db['nomorstkb']?>" data-kategori="<?= $db['groupkunjungan']?>" 
                                      <?php if ($db['spv'] != NULL OR $db['spv'] != '') { ?> 
                                      data-supv="<?= $db['spv']?>" <?php } else { ?>
                                      data-supv="<?= $db['area_head']?>"<?php }
                                      if($db['kareg'] != NULL OR $db['kareg'] != '') { ?>
                                       data-krg="<?= $db['kareg']?>" <?php } else { ?>
                                        data-krg="<?= $db['field_officer']?>" <?php } ?>
                                      class="btn btn-round btn-warning btn-xs"><span class="fa fa-exclamation fa-fw"></span> Assign Shopper </a></center></td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                        </table>
                    </section>

              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

    <div id="modalassignshp" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Assign Shopper</h4>
          </div>
          <div class="modal-body">
            <!-- <form action="<?= base_url('skenario/kesinibang')?>" method="POST"> -->
            <form action="<?= base_url('skenario/tambahkunjunganshp')?>" method="POST">

            <!-- garuuuuul -->

              <input type="hidden" id="kpro" name="kpro">
              <input type="hidden" id="kcab" name="kcab">
              <input type="hidden" id="kategori" name="kategori">
              <input type="hidden" id="krg" name="krg">
              <input type="hidden" id="supv" name="supv">

            <div class="form-group">
              <label for="kota">Kota :</label>
              <input class="form-control" type="text" id="kota" name="kota" readonly>
            </div>

            <div class="form-group">
                <label for="npro">Project :</label>
                <input class="form-control" type="text" id="npro" name="npro" readonly>
            </div>

            <div class="form-group">
                <label for="npro">STKB :</label>
                <input class="form-control" type="text" id="stkb" name="stkb" readonly>
            </div>

            <div class="form-group">
              <label for="cab">Cabang :</label>
              <input class="form-control" type="text" id="cab" name="cab" readonly>
            </div>

            <div class="form-group">
              <label for="appendsken">Skenario :</label>
              <section id="appendsken">
              </section>
            </div>

            <div class="form-group">
              <label for="cab">Pewitness :</label>
              <select name="pwt" class="selectpicker form-control" data-live-search="true">
                <option value="">Pilih Pewitness</option>
                <option value="">Tanpa Pewitness</option>
                <?php foreach($data_shp as $ds) :?>
                <option value="<?= $ds['Id']?>"><?=$ds['Id']?> - <?=$ds['Nama']?></option>
                <?php endforeach?>
              </select>
            </div>

            <div class="form-group">
              <label for="cab">Shopper :</label>
              <select name="shp" class="selectpicker form-control" data-live-search="true" required>
                <option value="">Pilih Shopper</option>
                <?php foreach($data_shp as $ds) :?>
                <option value="<?= $ds['Id']?>"><?=$ds['Id']?> - <?=$ds['Nama']?></option>
                <?php endforeach?>
              </select>
            </div>

            <div class="form-group">
              <label for="cab">Tanggal Kunjungan :</label>
              <section id="maxtgl">

              </section>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" id="sub_plot" class="btn btn-primary">Save</button>

          </div>
          </form>
        </div>
      </div>
    </div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>


<script>
  $('#sub_plot').one('submit', function() {
    $(this).find('button[type="submit"]').attr('disabled','disabled');
});
</script>