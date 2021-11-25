
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Validasi Data</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Validasi </strong></h4>
                <?php $akses = $this->session->userdata('id_divisi')?>
                <input type="hidden" id="akses" value="<?php echo $akses?>">
                <div class="row mb">
                <div class="col-md-4">
                    <select class="selectpicker form-control" name="sssproject" id="sssproject" data-live-search="true">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <!-- <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option> -->
                        <option value="<?=$pr['kode']?>"> <?=$pr['nama']?> </option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="col-md-4">
                    <section id="sscabang">
                     <select class="selectpicker form-control" name="scabang" id="scabang" data-live-search="true">
                      <option value=""> Pilih Cabang</option>
                     </select>
                    </section>
                </div>

                <div class="col-md-2">
                <button type="button" id ="tampilkanvalidasidataRA" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Tampilkan </button>
                </div>

                <div class="col-md-2" id='loadingDiv'>
                      Please wait...  <img src="<?= base_url('assets/')?>img/ajax-loader.gif" />
                  </div> 

                </div>
                <!-- </form> -->

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    <?= $this->session->flashdata('flash');?>
                </div>
                
                <section id="unseen">
                <!-- <div class="table table-responsive"> -->
                  <section id="tabledatavalidasi">
                  </section>
                <!-- </div> -->
                <h5><span class="fa fa-square fa-fw" style="color:#ffc107;"></span>-- Belum divalidasi <b></b></h5>
                <h5><span class="fa fa-square fa-fw" style="color:#dc3545;"></span>-- Ditolak <b></b></h5>
                <h5><span class="fa fa-square fa-fw" style="color:#337ab7;"></span>-- Valid <b></b></h5>
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
