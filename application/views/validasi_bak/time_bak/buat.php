    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Skenario </strong></h4>
                        <form class="form-horizontal style-form" method="post" action="<?= base_url('time/tambah')?>">
                            
                            <input type="hidden" class="form-control" name="project" id="project" value="<?=$project?>">
                            <input type="hidden" class="form-control" name="attribute" id="attribute" value="<?=$kode?>">
                            
                            <section id="pil">
                            <div class="form-group">
                            <label class="col-sm-2 control-label"> Pilihan 1 </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pil1" id="pil1">
                            </div>
                            </div>
                            </section>
                            <section id="jmlpilihan"><input type="hidden" class="form-control" name="jmlpil" id="jmlpil" value="1"></section>
                            <a class="btn btn-round btn-primary" id="addpil">Tambah Pilihan</a>
                            <button type="submit" class="btn btn-round btn-success pull-right" >Simpan</button>
                            <a href="<?=base_url('time')?>" class="btn btn-round btn-danger pull-right mr" >Batal</a>
                        </form>
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