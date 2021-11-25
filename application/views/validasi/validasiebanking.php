
<?php $akses = $this->session->userdata('id_divisi')?>

<section id="main-content">
      <section class="wrapper site-min-height">
        <?php if ($akses == 1) { ?>
          <h3><i class="fa fa-angle-right"></i> Detail Data Aktual E-Banking</h3>
        <?php } else { ?>
          <h3><i class="fa fa-angle-right"></i> Validasi Data E-Banking</h3>
        <?php } ?>
        <!-- <h5><strong>Demi meningkatkan kecepatan loading page, maka ada perubahan filter untuk validasi yang sebelumnya filter dengan PROJECT dan KUNJUNGAN sekarang berubah PROJECT dan CABANG. <br>

         Anda bisa menampilkan data dengan memilih salah satu filter - Terima kasih </strong></h5> -->                                             
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
              <?php if ($akses == 1) { ?>
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Aktual E-Banking</strong></h4>
              <?php } else { ?>
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Validasi E-Banking</strong></h4>
              <?php } ?>
                <input type="hidden" id="akses" value="<?php echo $akses?>">
                <div class="row mb">
                <div class="col-md-2">
                    <select class="selectpicker form-control" name="validasi_project" id="validasi_project" data-live-search="true">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <!-- <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option> -->
                        <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-control" name="validasi_bank" id="validasi_bank" >
                        <option value=""> Pilih Bank</option>
                        <?php foreach($bank as $bk):?>
                        <!-- <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option> -->
                        <option value="<?=$bk['kode']?>"> <?=$bk['nama']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                     <select class="selectpicker form-control" name="validasi_channel" id="validasi_channel" data-live-search="true">
                                  <option value="">--Pilih Channel--</option>
                                  
                                  <option value="Internet Banking">Internet Banking</option>
                                  <option value="Mobile Banking">Mobile Banking</option>
                                  <option value="SMS Banking">SMS Banking</option>
                                
                      </select>
                </div>
                <div class="col-md-2" id="div_validasi_transaksi">
                  <input type="hidden" name="validasi_transaksi" id="validasi_transaksi" value="">
                     <!-- <select class="form-control" name="validasi_channel" id="validasi_channel">
                                  <option value="">--Pilih Channel--</option>
                                  
                                  <option value="Internet Banking">Internet Banking</option>
                                  <option value="Mobile Banking">Mobile Banking</option>
                                  <option value="SMS Banking">SMS Banking</option>
                                
                      </select> -->
                </div>

                <!-- <div class="col-md-4">
                    <section id="sscabang">
                     <select class="selectpicker form-control" name="scabang" id="scabang" data-live-search="true">
                      <option value=""> Pilih Cabang</option>
                     </select>
                    </section>
                </div> -->

                <div class="col-md-2">
                <button type="button" id ="tampilkanval_ebanking" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Tampilkan </button>
                </div>

                <!-- <div class="col-md-2" id='loadingDiv'>
                      Please wait...  <img src="<?= base_url('assets/')?>img/ajax-loader.gif" />
                  </div>  -->

                </div>
                <!-- </form> -->
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    <?= $this->session->flashdata('flash');?>
                </div>
                
                <section id="unseen">
                <!-- <div class="table table-responsive"> -->
                  <section id="tableval_ebanking">
                  </section>
                <!-- </div> -->
                <!-- <h5><span class="fa fa-square fa-fw" style="color:#98FB98;"></span>-- Belum divalidasi</h5>
                <h5><span class="fa fa-square fa-fw" style="color:#dc3545;"></span>-- Ditolak</h5>
                <h5><span class="fa fa-square fa-fw" style="color:#00BFFF;"></span>-- Diterima</h5> -->
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

    <div id="modalinputrekaman" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Input Rekaman</h4>
          </div>
          <div class="modal-body">
            <!-- <form action="<?= base_url('validasi/updatetglrekaman')?>" method="POST"> -->

            <input type="hidden" id="urutan" name="urutan">

            <div class="form-group">
                <label for="npro">Project :</label>
                <input class="form-control" type="text" id="pro" name="pro" readonly>
                <input type="hidden" id="kpro" name="kpro">
            </div>

            <div class="form-group">
              <label for="cab">Cabang :</label>
              <input class="form-control" type="text" id="cab" name="cab" readonly>
              <input type="hidden" id="kcab" name="kcab">
            </div>

            <div class="form-group">
              <label for="appendsken">Skenario :</label>
              <input class="form-control" type="text" id="sken" name="sken" readonly>
              <input type="hidden" id="ksken" name="ksken">
            </div>

            <div class="form-group">
              <label for="cab">* Tanggal Rekaman Masuk :</label>
              <input type="date" class="form-control" name="datemasukrekaman" id="datemasukrekaman" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" id="saverekaman">Save</button>

          </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
