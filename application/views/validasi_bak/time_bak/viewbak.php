    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>Report</strong></h4>
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
                    <select class="form-control" name="skenario_td_report" id="skenario_td_report" >
                        <option value=""> Pilih Skenario </option>
                    </select>
                  </div>

                  <div class="col-md-3 mb" id='loadingDiv'>
                          Please wait...  <img src="<?= base_url('assets/')?>img/ajax-loader.gif" />
                  </div> 

                  <div class="col-md-3 mb" id='progresstd'>
                      
                      <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100" style="width:70%">
                          <span class="sr-only">70% Complete</span>
                        </div>
                      </div>
                    
                  </div> 

                </div>
                </div>
                <br>
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables_reporttd">
                  <!-- <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Nama Cabang<center></th>
                      <th><center>Kapan Isi Form<center></th>
                      <th><center>Jenis Form<center></th>
                      <th><center>Kondisi Pengisian Form<center></th> -->
                      <!-- <th><center>Nama Cabang<center></th> -->
                      <!-- <th><center>Aksi<center></th> -->
                    <!-- </tr>
                  </thead>
                  <tbody id="table_report">
                  </tbody> -->
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