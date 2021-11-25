    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Report TD</a></li>
                <li><a data-toggle="tab" href="#menu1">Edit TD</a></li>
                <!-- <li><a data-toggle="tab" href="#menu2">Database TD</a></li> -->
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
                        <select class="selectpicker form-control" name="pro_gadai" id="pro_gadai" data-live-search="true" readonly>
                            <!-- <option>Pilih Project</option> -->
                            <?php //foreach ($project as $pro) :?>
                            <option value="AND1"> ANDAMAN </option>
                            <?php //endforeach?>
                        </select>
                      </div>
                            
                      <div class="col-md-3 mb">
                        <select class="form-control" name="skenario_gadai" id="skenario_gadai" >
                            <option value=""> Pilih Skenario </option>
                            <option value="001"> Q1 </option>
                            <option value="002"> Q2 </option>
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
                            
                  <!-- <div class="row">
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
                      <table class="table table-striped" id="sum_td_gadai" style="background-color:white;">
                      </table>
                      </div>
                  </div> -->
                            
                </div>
               </div>
               </div>
                            
                            
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">

                    <!-- <section id="exporttoexcel"> -->
                      <a class="btn btn-round btn-primary" id="exportexcelgd">Export To Excel</a>
                       <br></br>
                    <!-- </section> -->

                    <div class="table-responsive">
                      <section id="dataTables_reporttd">
                        <!-- <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                        <thead>
                          <tr align='center'>
                          	<th rowspan="2"><center>Kode<center></th> 
                          	<th rowspan="2"><center>Cabang<center></th> 
                            <th colspan="4"><center>T1A. TD ANTRI PENAKSIR<center></th>
                            <th colspan="4"><center>T9A. TD PENAKSIR<center></th>
                            <th><center>C01. Apakah staf Kasir = staf Penaksir?<center></th>
                            <th colspan="4"><center>X1. TD TOTAL GADAI<center></th>
                          </tr>
                          	<th><center>Selesai isi slip gadai/ diminta menunggu dipanggil<center></th>
                            <th><center>Dipanggil penaksir<center></th>
                            <th><center>Lama TD<center></th>
                            <th><center>Penyebab  lama (jika lebih dari 10 menit)<center></th>

                          	<th><center>Dipanggil penaksir<center></th>
                            <th><center>Selesai dilayani penaksir<center></th>
                            <th><center>Lama TD<center></th>
                            <th><center>Penyebab  lama (jika lebih dari 10 menit)<center></th>

                            <th><center>1. Ya 2. Tidak <center></th>

                          	<th><center>Dipanggil penaksir<center></th>
                            <th><center>Menerima uang dan slip gadai dari kasir<center></th>
                            <th><center>Lama TD<center></th>
                            <th><center>Penyebab  lama (jika lebih dari 15 menit)<center></th>

                          </tr>
                          </thead>                            
                          <tbody>                            
                          <tr>
                            <td>January</td>
                            <td>$100</td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                            <td><center>$100<center></td>
                          </tr>
                          </tbody>  
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
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>Edit Time Delivery</strong></h4>
                  
                    <div class="col-lg-12">
                        <?= $this->session->flashdata('flash');?>
                    </div>

                    <div class="row">
                      <div class="form-group">

                        <div class="col-md-3 mb">
                          <select class="selectpicker form-control" name="project_td_gd_edit" id="project_td_gd_edit" data-live-search="true">
                              <!-- <option>Pilih Project</option> -->
                              <option value="AND1"> ANDAMAN </option>
                          </select>
                        </div>
                              
                        <div class="col-md-3 mb">
                          <select class="form-control" name="skenario_td_gd_edit" id="skenario_td_gd_edit" >
                              <option value=""> Pilih Skenario </option>
                              <option value="001"> Q1 </option>
                              <option value="002"> Q2 </option>
                          </select>
                        </div>
  
                        <div class="col-md-3 mb">
                          <section id="s_cbg_tdedit">
                            <select class="form-control" name="cbg_td_gd_edit" id="cbg_td_gd_edit">
                                <option value=""> Pilih Cabang </option>
                            </select>
                          </section>
                        </div>

                    <form action="<?=base_url('time/edit_td_gd')?>" method="post">
                    <div class="row">
                    <div class="col-lg-12">
                    <section id="kasir_penaksi">
 
                    </section>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-12">
                    <div class="form-panel">
                    <section id="dataTables_edittd_gd">

                    </section>
                    </div>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-12">
                    <section id="button_gd">

                    <div class="form-panel">
                      <div style="text-align:center;">
                      <button id="cancel" href="<?= base_url('time/view_gadai')?>" class="btn btn-round btn-danger"> Cancel</button>
                      <button id="simpan_edit_gd" type="submit" class="btn btn-round btn-success"> Save</button>
                      </div>
                    </div>

                    </section>
                    </div>
                    </div>

                    </form>

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
