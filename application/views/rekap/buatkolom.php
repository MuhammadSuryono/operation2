<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Kolom Skill </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Pembuatan Kolom Skill </strong></h4>
                    <form class="form-horizontal style-form" method="post" action="<?=base_url('rekap/simpankolom')?>">
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Kode Kolom</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="kode1" id="kode1">
                        </div>
                        <label class="col-sm-2 control-label">Pertanyaan</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="pertanyaan1" id="pertanyaan1">
                        </div>
                        <label class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="keterangan1" id="keterangan1">
                        </div>
                        </div>
                        <section id="kolomskill"></section>
                        <section id="jmlkolomskill"><input type="hidden" name="jmlkolomskill" id="jmlkolomskill" value="1"/></section>

                        <a class="btn btn-round btn-info" name="addkolomskill" id="addkolomskill"> Tambah </a>
                        <button type="submit" class="btn btn-round btn-success pull-right"> Simpan </button>
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