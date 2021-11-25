    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Input Foto Temuan</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Kunjungan </strong></h4>
                        <div class="row">

                        <form action="<?= base_url('shp/upload_foto_temuan')?>" method="post" enctype='multipart/form-data'>
                        
                        <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash') ?>"></div>


                        <div class="col-lg-2">
                            <!-- <select class="selectpicker form-control" name="sproject" id="sproject" data-live-search="true" required>
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select> -->
                            <input type="hidden" name="sproject" id="sproject" value="<?= $pjk['kode'] ?>">
                            <input type="text" class="form-control" value="<?= $pjk['nama'] ?>" readonly>
                        </div>

                        <div class="col-md-2 sm">
                            <!-- <select class="form-control kunjungan" name="skunjungan" id="skunjungan" required>
                                <option value=""> Pilih Kunjungan </option>
                            </select> -->
                            <input type="hidden" name="skunjungan" id="skunjungan" value="<?= $kunj['kode'] ?>">
                            <input type="text" class="form-control" value="<?= $kunj['nama'] ?>" readonly>
                        </div>

                        <div class="col-md-2 sm">
                            <!-- <select class="form-control skenario" name="temskenario" id="temskenario" required>
                                <option value=""> Pilih Skenario </option>
                            </select> -->
                            <input type="hidden" name="temskenario" id="temskenario" value="<?= $sken['kode'] ?>">
                            <input type="text" class="form-control" value="<?= $sken['nama'] ?>" readonly>
                        </div>

                        <div class="col-md-3 sm">
                            <!-- <select class="form-control cabang" name="rekamancabang" id="rekamancabang" required>
                                <option value=""> Pilih Cabang </option>
                            </select> -->
                            <input type="hidden" name="rekamancabang" id="rekamancabang" value="<?= $cab['kode'] ?>">
                            <input type="text" class="form-control" value="<?= $cab['kode']." - ". $cab['nama']?>" readonly>
                        </div>

                        <div class="col-md-2 sm">
                            <a class="btn btn-primary fa fa-plus pull-right" id="tambahtemuan"> Tambah</a>
                        </div>

                        <div class="col-md-1 sm"></div>

                        <br></br>
    

                        <div class="row">
                          <div class="col-lg-12">
                            <div class="col-lg-12">
                            <hr>
                            <br></br>
                            <section id="temuan_sebelumnya">
                              <?php if($temuannya != NULL) { ?>
                              <h5 class="font-weight-bold">Temuan Sebelumnya : </h5>
                            <?php } ?>
                              <?php
                              $i = 0;
                              $no = 1;
                              foreach ($temuannya as $tem) {
                              ?>
                              <div class="row">
                              <div class="col-lg-1 mb" style="margin-right:-50px;"><p><?= $no++; ?>. </p></div>
                              <div class="col-lg-8 mb">
                                  <input class="form-control" type="text" name="temuan_sebelumnya<?= $i++; ?>" value="<?= $tem['ket_temuan'] ?>" readonly>
                                </div>
                              <?php if($tem['foto_temuan'] != NULL) { ?>
                                <div class="col-lg-3 mb" style="margin-right:50px;">
                                       <a href="" title="Foto Temuan" type="button" <?php echo "onclick='window.open(\"" . base_url() . "assets/file/foto_temuan/" . $tem['foto_temuan'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'"; ?>><i class="far fa-file-image fa-2x"></i></a >       
                                </div>
                              <?php } ?>
                            </div>
                            <?php } ?>
                              <hr>
                            </section>

                            <section id="fototemuan">

                            <input type="hidden" name="jumlahtemuan" id="jumlahtemuan" value="">

                              <!-- <div class="col-lg-9">
                                <input class="form-control" type="text" name="kettemuan" placeholder="Tulis Keterangan Temuan Di sini ...">
                              </div>

                              <div class="col-lg-3">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                  <span class="btn btn-theme02 btn-file">
                                      <span class="fileupload-new pull-right"><i class="fa fa-paperclip"></i> Pilih File</span>
                                  <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                  <input type="file" class="default" name="rekaman" id="rekaman" required/>
                                  </span>
                                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                                  <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                  <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                  <span>Format File (.jpg, .gif)
                                  </span>
                              </div> -->

                            </section>

                            </div>
                          </div>
                        </div>

                        <br></br>
                        <br></br>

                        <div class="row">
                          <div class="col-lg-12">
                            <div class="col-md-6">
                              <button type="submit" class="btn btn-success btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Simpan </button>
                            </div>
                          </div>
                        </div>
                        </form>
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