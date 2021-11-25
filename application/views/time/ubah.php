    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Edit Data Time Delivery </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-7">
                  <div class="form-panel">
                  <?//php if ($dialog['sts_valid']==0):?>
                      <h4 class="mb" style="color:#ffc107;"> <strong> <i class="fa fa-angle-right"></i> Dialog </strong></h4>
                  <?//php else :?>
                      <!-- <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Dialog </strong></h4> -->
                  <?//php endif?>
                      <div class="form-group ">
                            <textarea class="form-control " id="ccomment" name="comment" rows="30" readonly><?//= str_replace('<br />',' ',$dialog['teks_dialog'])?></textarea>
                        </div>
                  </div>
              </div>

              <div class="col-lg-5">

              <div class="form-panel">
                     <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Time Delivery </strong></h4>
                     <form class="form-horizontal style-form" method="post" action=<?#= base_url('time/simpantd')?>>
                     <section id="piltd">
                     <div class="row">
                        <div class="col-md-6 mb">
                            <select class="form-control" name="piltd1" id="piltd1" onchange="interupsi(1)">
                                <option value=""> Pilih Jenis 1</option>
                                <?php $arraypil = []; foreach($time as $sk) : array_push($arraypil, $sk['id_skenario']);?>
                                <option value="<?=$sk['pilihan_td']?>"> <?=$sk['pilihan_td']?> </option>
                                <?php endforeach?>
                                <input type="hidden" name="id_skenario" id="id_skenario" value="<?=$arraypil[0]?>">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="jbpiltd1" id="jbpiltd1">
                        </div>
                    </div>
                    <section id="interupsi1"></section>
                    </section>
                    <section id="jmlpiltd"></section>

                    <div class="row">
                        <div class="col-md-6 mb">
                            <label for="">Akhir Burek</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="akhirburek" id="akhirburek">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb">
                            <textarea class="form-control" name="temuan" id="temuan" placeholder="Tulis Temuan Disini.." rows="4"></textarea>
                        </div>
                    </div>
                    
                    <a class="btn btn-round btn-primary" id="addpiltd">Tambah</a>
                    <button type="submit" class="btn btn-round btn-success pull-right"> Simpan </button>
                    <a href="" class="btn btn-round btn-danger pull-right mr"> Batal </a>
                    </form>
                </div>

                <div class="form-panel">
                <?php if ($rekaman['sts_valid']==0):?>
                      <h4 class="mb" style="color:#ffc107;"> <strong> <i class="fa fa-angle-right"></i> Rekaman </strong></h4>
                  <?php else :?>
                      <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman </strong></h4>
                  <?php endif?>
                    <audio controls id="rekaman" src="<?=base_url('assets/')?>file/rekaman/<?= $rekaman['file_rekaman']?>"></audio>
                    <!-- <audio controls id="rekaman" src="<?=base_url('assets/')?>file/rekaman/Satu.wav"></audio> -->
                </div>

                <div class="form-panel" style="margin-top:5rem;">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?= base_url('validasi/stsInvalidDialog/')?><?=$dialog['id_dialog']?>/<?=$rekaman['id_rekaman']?>" class="btn btn-round btn-block btn-danger"><span class="fa fa-times-circle fa fw"></span> Tolak Dialog</a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url('validasi/stsValidDialog/')?><?=$dialog['id_dialog']?>/<?=$rekaman['id_rekaman']?>" class="btn btn-round btn-block btn-success"><span class="fa fa-check-circle fa fw"></span> Terima Dialog</a>
                        </div>
                    </div>
                    <div class="row mt">
                        <div class="col-md-6">
                            <a href="<?= base_url('validasi/stsInvalidRekaman/')?><?=$dialog['id_dialog']?>/<?=$rekaman['id_rekaman']?>" class="btn btn-round btn-block btn-danger"><span class="fa fa-times-circle fa fw"></span> Tolak Rekaman</a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url('validasi/stsValidRekaman/')?><?=$dialog['id_dialog']?>/<?=$rekaman['id_rekaman']?>" class="btn btn-round btn-block btn-success"><span class="fa fa-check-circle fa fw"></span> Terima Rekaman</a>
                        </div>
                    </div>
                    <div class="row mt">
                        <div class="col-md-12">
                            <a href="<?= base_url('validasi/valid/')?><?=$dialog['id_project']?>" class="btn btn-round btn-block btn-info btn-block"><span class="fa fa-check-circle fa fw"></span> Kembali </a>
                        </div>
                    </div>
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