    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Form Input Time Delivery </h3>
        <h5><i class="fa fa-warning"></i> Harap input sesuai format <strong>"hh:mm:ss"</strong> !
        Cek kembali format input sebelum klik <strong>Simpan</strong> ! Jika perlu <strong>Screenshoot</strong> terlebih dahulu !
        Setiap pilihan di FORM INPUT <strong>tidak boleh sama !</strong><i class="fa fa-warning"></i></h5>
        <h5></i> Note :</h5>
        <h5></i> Jika pada FORM INPUT ada pengulangan proses harap tambahkan pada <strong>LIST PROSES TIME DELIVERY</strong> terlebih dahulu !</h5>
        <div class="row mt">
          <div class="col-lg-12">
          <div class="row">
          <form class="form-horizontal style-form" method="post" action="<?= base_url('time/tambahAg')?>">
          <input type="hidden" name="id_skenario_a" id="id_skenario_a" value="">

          <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="col-lg-3">
            <div class="form-panel">
            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Spesifikasi </strong></h4>
              
              <div class="form-group">
                  <label class="col-sm-3 control-label">Jenis Form</label>
                  <div class="col-sm-8">
                      <select class="form-control" name="formxx" id="formxx">
                            <option value="">Pilih</option>
                            <?php foreach($form as $fr) :?>
                            <option value="<?=$fr['kode']?>"> <?= $fr['nama']?> </option>
                            <?php endforeach?>
                        </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Project</label>
                  <div class="col-sm-8">
                      <select class="form-control" name="project_td" id="project_td">
                      <option>Pilih Project</option>
                      <?php foreach ($project as $pro) :?>
                        <option value="<?= $pro['kode']?>"> <?= $pro['nama'] ?> </option>
                      <?php endforeach?>
                       </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Cabang</label>
                  <div class="col-sm-8">
                      <div id='loadingDiv'>
                          Please wait...  <img src="<?= base_url('assets/')?>img/ajax-loader.gif" />
                      </div> 
                    <section id="cabangxx">
                        <select name="cabang" id="cabang" class="selectpicker form-control" data-live-search="true">
                            <option value=""> Pilih Cabang </option>
                        </select>
                    </section>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col">
                   <label>Kapan isi form </label>
                    <select class="kapan_isi_form form-control" name="kapan_isi_form" id="kapan_isi_form" required>
                     <option value="">Pilih ...</option>
                     <option>Saat antri</option>
                     <option>Saat di CS</option>
                     <option>Saat di Mesin</option>
                    </select>
                   </div> 

                  <div class="col">
                    <label>Jenis form </label>
                    <select class="jenis_form form-control" name="jenis_form" id="jenis_form" required>
                     <option value="">Pilih ...</option>
                     <option>Paper (manual)</option>
                     <option>Eform</option>
                    </select>
                  </div> 

                  <div class="col">
                  <label>Selesai isi form </label>
                    <select class="selesai_isi_form form-control" name="selesai_isi_form" id="selesai_isi_form" required>
                     <option value="">Pilih ...</option>
                    </select>
                  </div>
                </div> 

                <br>
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Part Rekaman </strong></h4>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Part 1</label>
                  <div class="col-sm-8">
                      <input type="text" name="part1" id="part1" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Part 2</label>
                  <div class="col-sm-8">
                      <input type="text" name="part2" id="part2" class="form-control">
                  </div>
                </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-panel">
            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Input </strong></h4>
            <section id="piltd1"></section>
            <section id="jmlpiltd"></section>
            <div class="row">
                        <div class="col-md-9 mb" align="right">
                            <label for=""> <strong> Akhir TD </strong> </label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="akhirburek" id="akhirburek" required>
                        </div>
                    </div>
            <a class="btn btn-round btn-primary" id="addpiltd1">Tambah</a>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Temuan </strong></h4>
                <textarea class="form-control" name="temuan" id="temuan" placeholder="Tulis Temuan Disini.." rows="10"></textarea>
            </div>
          </div>

          </div>
          
          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <div style="text-align:center;">
                    <button type="submit" class="btn btn-round btn-success"> Simpan</button>
                </div>
                </div>
            </div>
          </div>
          </form>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
