    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Tambah Proses Baru </strong></h4>
                        <div class="row">
                        <form action="<?= base_url('time/buatA')?>" method="post">

                        <div class="col-md-3 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="form-control" name="projectid" id="projectid" >
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>

                        <div class="col-md-3 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="form-control" name="project" id="project" >
                                <option value=""> Pilih Skenario </option>
                                <?php foreach($attribute as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Buat </button>
                        </div>
                        </form>
                  </div>
                  </div>
              </div>
          </div>

          <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>List Proses </strong></h4>
                <!-- <a href="<?= base_url('time/indexA')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah</a> -->
                
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <div class="row">
                <div class="form-group">

                  <div class="col-md-3 mb">
                    <select class="form-control" name="project_tdview" id="project_tdview">
                        <option>Pilih Project</option>
                        <?php foreach ($project as $pro) :?>
                        <option value="<?= $pro['kode']?>"> <?= $pro['nama'] ?> </option>
                        <?php endforeach?>
                    </select>
                  </div>

                  <div class="col-md-3 mb">
                    <select class="form-control" name="skenario_tdview" id="skenario_tdview" >
                        <option value=""> Pilih Skenario </option>
                    </select>
                  </div>

                </div>
                </div>
                <br>
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables_td">
                  <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>List Proses<center></th>
                      <!-- <th><center>Aksi<center></th> -->
                    </tr>
                  </thead>
                  <tbody id="table_viewtd">
                  </tbody>
                </table>
              </section>
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