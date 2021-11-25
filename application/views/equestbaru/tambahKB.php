<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Equest </h3>
        <div class="row mt">
          <div class="col-lg-12">
          <form action="<?= base_url('equestbaru/simpan')?>" method="post">
            <input type="hidden" value="<?=$skenario?>" name="id_skenario" id="id_skenario">
            <input type="hidden" name="jmlsoal" id="jmlsoal" value="1">

            <section id="soalsoal" class="mt">
            <!-- <div class="row" id="pertanyaan1">
                <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan 1 </strong></h4>
                    <div class="form-horizontal style-form">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pertanyaan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="message" id="message" placeholder="Pertanyaan.." rows="1" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="jenissoal" id="jenissoal" value="3">
                    <section id="pilihanganda">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan 1 </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg1" id="pg1">
                        </div>
                    </div>
                    </section>
                    <section id="jumlahpg"></section>
                <button type="button" class="btn btn-round btn-primary" id="addpg"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                </div>
                </div> -->
                
                <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan 2 </strong></h4>
                        <div class="form-horizontal style-form">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Pertanyaan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="message" id="contact-message" placeholder="Pertanyaan.." rows="1" required></textarea>
                                </div>
                            </div>

                    </div>
                </div> -->

                <!-- <div class="row" id="pertanyaan1">
                <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan 1 </strong></h4>
                    <div class="form-horizontal style-form">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pertanyaan</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="message" id="contact-message" placeholder="Pertanyaan.." rows="1" required></textarea>
                        </div>
                    </div>

                    <section id="pilihanlainnya">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan 1 </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jb" id="jb">
                        </div>
                    </div>
                    </section>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan Lainnya </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="lain" id="lain" disabled>
                        </div>
                    </div>

                <button type="button" class="btn btn-round btn-primary" id="addpglain"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                </div>
                </div>
                </div> -->
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
                    <button type="button" class="btn btn-round btn-danger pull-right" id="" style="margin-right:1rem;"><i class="fa fa-times-circle fa-fw"></i> Batal </button>
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
