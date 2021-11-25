    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Report TD</a></li>
                <li><a data-toggle="tab" href="#menu1">Report TD per Cabang</a></li>
                <li><a data-toggle="tab" href="#menu2">Database TD</a></li>
          </ul>

          <div class="tab-content">

            <div id="home" class="tab-pane fade in active">
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
                        <select class="selectpicker form-control" name="project_tdview" id="project_tdview" data-live-search="true">
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
                      </div> 
                            
                    </div>
                    </div>
                    <!-- <br> -->
                            
                  <div class="row">
                      <div class="col-lg-2 mb">
                        <h5><strong>SUMMARY REPORT</strong></h5>
                      </div>
                            
                      <div class="col-md-3 mb">
                      <section id=showreport>
                            <a class="btn btn-round btn-primary" id="hidesumreport">Hide</a>
                            <a class="btn btn-round btn-primary" id="sumreport">Show</a>
                      </section>
                      </div>
                            
                  </div>
                            
                  <div class="row">
                      <div class="col-md-8 mb">
                      <table class="table table-striped" id="tabletdsummary" style="background-color:white;">
                      </table>
                      </div>
                  </div>
                            
                </div>
               </div>
               </div>
                            
                            
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">

                    <!-- <section id="exporttoexcel"> -->
                      <a class="btn btn-round btn-primary" id="exportexcel">Export To Excel</a>
                       <br></br>
                    <!-- </section> -->

                    <div class="table-responsive">
                      <section id="dataTables_reporttd">
                      <!-- <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                          </table> -->
                      </section>
                    </div>

                  </div>
                </div>
              </div>
            
            </div>

            <div id="menu1" class="tab-pane fade">

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>Report Time Delivery</strong></h4>
                  
                    <div class="col-lg-12">
                        <?= $this->session->flashdata('info');?>
                    </div>

                    <div class="row">
                      <div class="form-group">

                        <div class="col-md-3 mb">
                          <select class="selectpicker form-control" name="project_tdedit" id="project_tdedit" data-live-search="true">
                              <option>Pilih Project</option>
                              <?php foreach ($project as $pro) :?>
                              <option value="<?= $pro['kode']?>"> <?= $pro['nama'] ?> </option>
                              <?php endforeach?>
                          </select>
                        </div>
                              
                        <div class="col-md-3 mb">
                          <select class="form-control" name="skenario_td_edit" id="skenario_td_edit" >
                              <option value=""> Pilih Skenario </option>
                          </select>
                        </div>
  
                        <div class="col-md-3 mb">
                          <section id="s_cbg_tdedit">
                            <select class="form-control" name="cbg_tdedit" id="cbg_tdedit">
                                <option value=""> Pilih Cabang </option>
                            </select>
                          </section>
                        </div>
                        
                    <section id="dataTables_edittd">

                    </section>



                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>

            <div id="menu2" class="tab-pane fade">

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>Database Time Delivery</strong></h4>
                  
                    <div class="col-lg-12">
                        <?= $this->session->flashdata('info');?>
                    </div>

                    <div class="row">
                      <div class="form-group">

                        <div class="col-md-3 mb">
                          <select class="selectpicker form-control" name="project_db_td" id="project_db_td" data-live-search="true">
                              <option>Pilih Project</option>
                              <?php foreach ($project as $pro) :?>
                              <option value="<?= $pro['kode']?>"> <?= $pro['nama'] ?> </option>
                              <?php endforeach?>
                          </select>
                        </div>
                              
                        <div class="col-md-3 mb">
                          <select class="form-control" name="skenario_db_td" id="skenario_db_td" >
                              <option value=""> Pilih Skenario </option>
                          </select>
                        </div>

                        <div class="col-md-3 mb" id='loadingDiv2'>
                              Please wait...  <img src="<?= base_url('assets/')?>img/ajax-loader.gif" />
                        </div> 
                    
                      </div>
                    </div>

              <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">

                      <a class="btn btn-round btn-primary" id="exportexcel_db_td">Export To Excel</a>
                       <br></br>

                    <div class="table-responsive">
                      <section id="dataTables_db_td">
                      <!-- <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                          </table> -->
                      </section>
                    </div>
                    
                  </div>
                </div>
              </div>

                  </div>
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
