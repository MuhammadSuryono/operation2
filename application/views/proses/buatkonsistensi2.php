<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data Konsistensi </h3>
        <div class="row mt mb">
          <div class="col-lg-12">
        <form class="form-horizontal style-form" method="post" action="<?= base_url('proses/simpankonsistensi')?>">
          <section id="jumlahdata"></section>
          <section id="datakonsistensi">
            <!-- <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Antar Kunjungan </strong></h4>
                    <input type="hidden" name="cek_" id="cek_" value=1>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Kode Soal</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" required>
                    </div>
                    </div>
                
                </div>
            </div>
            </div>

            <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Hanya Jika </strong></h4>
                    <input type="hidden" name="cek_" id="cek_" value=2>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek_1" id="nilai_cek_1" required>
                        </div>
                    </div>
                
                </div>
            </div>
            </div>

            <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Jika Maka</strong></h4>
                    <input type="hidden" name="cek_" id="cek_" value=3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek_1" id="nilai_cek_1" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Maka Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2" id="kode_cek2" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2" id="nilai_cek2" required>
                        </div>
                    </div>
                
                </div>
            </div>
            </div>

            <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Jika Tapi</strong></h4>
                    <input type="hidden" name="cek_" id="cek_" value=4>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control"name="nilai_cek1" id="nilai_cek1"  required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Tapi Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2" id="kode_cek2" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2" id="nilai_cek2" required>
                        </div>
                    </div>
                
                </div>
            </div>
            </div>

            <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rentang Waktu </strong></h4>
                <input type="hidden" name="cek_" id="cek_" value=5>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek1" id="nilai_cek1" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Maka Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2" id="kode_cek2" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2" id="nilai_cek2" required>
                        </div>
                    </div>
                
                </div>
            </div>
            </div> -->
          </section>

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Keterangan </strong></h4>

                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <label class="col-sm-2 control-label">Kode Project</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" value="<?= $project['kode_project']?>" disabled>
                            <input type="hidden" class="form-control" name="id_project" id="id_project" value="<?= $project['id_project']?>">
                        </div>
                </div>
                </div>

                <div class="row mt">
                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <label class="col-sm-2 control-label">Nama Project</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" value="<?= $project['nama_project']?>" disabled>
                        </div>
                </div>
                </div>

                <div class="row mt">
                    <div class="form-group">
                        <div class="col-sm-3"></div>
                        <label class="col-sm-2 control-label">Nama Skenario</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" value="<?= $skenario['nama_skenario']?>" disabled>
                            <input type="hidden" class="form-control" name="id_skenario" id="id_skenario" value="<?= $skenario['id_skenario']?>" >
                        </div>
                </div>
                </div>

                </div>
            </div>
          </div>

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                      <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Jenis Konsistensi </strong></h4>
                      <div class="row">
                        <div class="col-md-8 mb">
                                <label class="radio-inline">
                                    <input type="radio" name="cek" id="cek" value=1>Antar Kunjungan
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="cek" id="cek" value=2>Hanya Jika
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="cek" id="cek" value=3>Jika Maka
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="cek" id="cek" value=4>Jika Tapi
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="cek" id="cek" value=5>Waktu
                                </label>
                        </div>

                        <div class="col-md-1">
                            <button type="button" class="btn btn-round btn-primary pull-right" id="addjeniskonsistensi"><i class="fa fa-check-circle fa-fw"></i> Buat </button>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-round btn-success pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan </button>
                            <a href="<?= base_url('proses/buatkonsistensi')?>" type="button" class="btn btn-round btn-danger pull-right" style="margin-right : 1rem"><i class="fa fa-times-circle fa-fw"></i> Batal </a>
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