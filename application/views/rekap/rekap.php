<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Rekap Skill </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">

              <div class="col-md-6">
                  <div class="form-panel">
                      <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Dialog Skenario - Nama </strong></h4>
                        <div class="form-group ">
                            <textarea class="form-control " id="ccomment" name="comment" rows="30" readonly><?= str_replace('<br />',' ',$dialog['teks_dialog'])?></textarea>
                        </div>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-panel">
                      <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Rekap Skill Dialog </strong></h4>
                      <form method="post" action="<?= base_url('rekap/rekap1')?>">
                        <input type="hidden" name="skenario" id="skenario" value="<?= $dialog['id_skenario']?>">
                        <input type="hidden" name="project" id="project" value="<?= $dialog['id_project']?>">
                        <input type="hidden" name="dialog" id="dialog" value="<?= $dialog['id_dialog']?>">
                        <input type="hidden" name="cabang" id="cabang" value="<?= $dialog['kode_cabang']?>">

                      <?php $kolom = $this->db->get('data_skill')->result_array(); foreach($kolom as $klm => $kl) :?>
                      <div class="form-group row">
                        <label for="cname" class="control-label col-lg-2"> <span class="tooltip2 tooltip3"><span class="tooltiptext3"><?=$kl['nama_kolom']?></span> <span class="tooltiptext2"><?=$kl['ket_kolom']?></span><?=$kl['kode_kolom']?> </span></label>
                        <div class="col-lg-10">
                          <input class=" form-control" id="<?=$kl['kode_kolom']?>" name="<?=$kl['kode_kolom']?>" type="text" value="<?= set_value($kl['kode_kolom']) ?>"/>
                        </div>
                      </div>
                      <?php endforeach?>

                      <!-- <div class="form-group row">
                        <label for="cname" class="control-label col-lg-2">B</label>
                        <div class="col-lg-10">
                          <input class=" form-control" id="col2" name="col2" type="text" value="<?= set_value('col2') ?>"/>
                          <?= form_error('col2', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="cname" class="control-label col-lg-2">C</label>
                        <div class="col-lg-10">
                          <input class=" form-control" id="col3" name="col3" type="text" value="<?= set_value('col3') ?>"/>
                          <?= form_error('col3', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="cname" class="control-label col-lg-2">D</label>
                        <div class="col-lg-10">
                          <input class=" form-control" id="col4" name="col4" type="text" value="<?= set_value('col4') ?>"/>
                          <?= form_error('col4', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="cname" class="control-label col-lg-2">E</label>
                        <div class="col-lg-10">
                          <input class=" form-control" id="col5" name="col5" type="text" value="<?= set_value('col5') ?>"/>
                          <?= form_error('col5', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                      </div> -->
                      <button type="submit" class="btn btn-round btn-primary pull-right" style="margin-right : 0.5rem;">Simpan</button>
                      <a href="<?=base_url('rekap/index/')?><?= $dialog['id_skenario']?>" type="button" class="btn btn-round btn-danger pull-right" style="margin-right : 0.5rem;">Batal</a>
                      </form>
                      <br>
                      <br>
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