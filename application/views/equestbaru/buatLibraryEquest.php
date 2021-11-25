<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Equest </h3>
        <div class="row mt">
          <div class="col-lg-12">
          <form action="<?= base_url('equestbaru/simpanLibraryEquest')?>" method="post">
            <input type="hidden" value="<?=$nama?>" name="nama_library" id="nama_library">
            <input type="hidden" name="jmlsoal" id="jmlsoal" value="1">

            <section id="soalsoal" class="mt">
        </section>

        <section id="jumlahsoal">
        </section>

          <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Buat Equest </strong></h4>
                <div class="row">
                <div class="col-md-7 mb">
                        <label class="radio-inline">
                            <input type="radio" name="cek" id="cek" value=1>Singkat
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="cek" id="cek" value=2>Panjang
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="cek" id="cek" value=3>Pilihan Ganda
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="cek" id="cek" value=4>Pilihan Ganda + Lainnya
                        </label>

                        <label class="radio-inline">
                            <input type="radio" name="cek" id="cek" value=5>Pilihan Multiple
                        </label>
                </div>

                <div class="col-md-1">
                    <button type="button" class="btn btn-round btn-primary pull-right" id="addjenissoal"><i class="fa fa-check-circle fa-fw"></i> Buat </button>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-round btn-success pull-right" id="" ><i class="fa fa-check-circle fa-fw"></i> Simpan </button>
                    <a href="<?=base_url('equestbaru/equest')?>" class="btn btn-round btn-danger pull-right" id="" style="margin-right:1rem;"><i class="fa fa-times-circle fa-fw"></i> Batal </a>
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
