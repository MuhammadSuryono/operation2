    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Tambah Proses Baru </strong></h4>
                        <div class="row">
                        <form action="<?= base_url('time/create_ebanking')?>" method="post">

                        <!-- <div class="col-md-2 mb">
                        
                            <select class="selectpicker form-control" name="project_eb" id="project_eb" data-live-search="true">
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode_project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                       
                        </div> -->
                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="bank_eb" id="bank_eb2" data-live-search="true">
                                <option value=""> Pilih Bank </option>
                                <?php foreach($bank as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="channel_eb" id="channel_eb2" data-live-search="true">
                                <option value=""> Pilih Channel </option>
                                <option value="Internet Banking"> Internet Banking </option>
                                <option value="Mobile Banking"> Mobile Banking </option>
                                <option value="SMS Banking"> SMS Banking </option>
                                
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                         <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="transaksi_eb" id="transaksi_eb2" data-live-search="true">
                                <option value=""> Pilih Transaksi </option>
                                <?php foreach($transaksi as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>



                        <div class="col-md-2 mb" id="os_eb2">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <!-- <select class="form-control" name="project" id="project" >
                                <option value=""> Pilih Skenario </option>
                                <?php foreach($attribute as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select> -->
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-2 mb" id="jenis_eb">
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-round btn-primary pull-left" ><i class="fa fa-check-circle fa-fw"></i> Buat </button>
                        </div>
                        
                  </div>
                  </form>
                  </div>
              </div>
          </div>

          <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>Lihat List Proses </strong></h4>
                <!-- <a href="<?= base_url('time/index')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah</a> -->

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <div class="row">
                <!-- <div class="form-group"> -->

                 <!--  <div class="col-md-3 mb">
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
                  </div> -->
                  <!-- <div class="col-md-2 mb">
                   <select class="selectpicker form-control" name="project_td" id="project_td" data-live-search="true">
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode_project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        </div> -->
                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="bank_td" id="bank_td" data-live-search="true">
                                <option value=""> Pilih Bank </option>
                                <?php foreach($bank as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="channel_td" id="channel_td" data-live-search="true">
                                <option value=""> Pilih Channel </option>
                                <option value="Internet Banking"> Internet Banking </option>
                                <option value="Mobile Banking"> Mobile Banking </option>
                                <option value="SMS Banking"> SMS Banking </option>
                                
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                         <div class="col-md-2 mb" id="div_transaksi">
                          <!-- <div class="col-md-2 mb"> -->
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="transaksi_td" id="transaksi_td" data-live-search="true">
                                <option value=""> Pilih Transaksi </option>
                                <?php foreach($transaksi as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                           <!--  <select class="selectpicker form-control" name="transaksi_td" id="transaksi_td" data-live-search="true">
                                <option value=""> Pilih Transaksi </option>
                                <?php foreach($transaksi as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select> -->
                        <!-- AKHIR SELECT -->
                        <!-- </div> -->

                        <div class="col-md-2 mb" id="div_os">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                           <!--  <select class="selectpicker form-control" name="transaksi_td" id="transaksi_td" data-live-search="true">
                                <option value=""> Pilih Transaksi </option>
                                <?php foreach($transaksi as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select> -->
                        <!-- AKHIR SELECT -->
                        </div>

                        <div class="col-md-2 mb" id="div_jenis">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                         <button type="button" class="btn btn-round btn-primary" id="cari_td_ebanking"><i class="fas fa-eye"></i> Lihat </button>
                            <!-- <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Buat </button> -->
                        </div>


                <!-- </div> -->
                </div>
                <br>
                <section id="dataTables_td_eb">

                </section>
            </div>
           </div>
           </div>


           <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>Rekap List Proses </strong></h4>
                <!-- <a href="<?= base_url('time/index')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah</a> -->

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <div class="row">
                <div class="col-md-1"><h4><b>Pilih :</b></h4></div>
                          <div class="form-group">

                 <form action="" method="POST">
                  <div class="col-md-2 mb">
                   <select class="selectpicker form-control" name="channel_rekap" id="channel_td" data-live-search="true">
                                <option value=""> Pilih Channel </option>
                                <option value="Internet Banking"> Internet Banking </option>
                                <option value="Mobile Banking"> Mobile Banking </option>
                                <option value="SMS Banking"> SMS Banking </option>
                                
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-1">
                         <button type="submit" name="rekap_td" class="btn btn-round btn-primary pull-right" id="rekap_td_ebanking"><i class="fas fa-eye"></i> Cari </button>
                            <!-- <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Buat </button> -->
                        </div>
                    </form>


                </div>
                </div>
                <br>
                <section id="dataTables_rekap">
                    <?php
                        if (isset($_POST['rekap_td'])) {
                             $channel = $_POST['channel_rekap'];

                             $query = $this->db->query("SELECT a.*, b.nama AS nama_bank, c.nama AS nama_transaksi
                                                        FROM ebanking_data_td a 
                                                        LEFT JOIN bank b ON a.bank=b.kode
                                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                        
                                                        WHERE a.channel='$channel'
                                                        GROUP BY a.bank, a.channel, a.transaksi, a.os, a.jenis
                                                        
                                                        ")->result_array();
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-2">
                            <thead style="background-color: #F0F8FF;">
                                <tr>
                                    <th><center>No</center></th>
                                    <!-- <th><center>Project</center></th> -->
                                    <th><center>Bank</center></th>
                                    <th><center>Channel</center></th>
                                    <th><center>Transaksi</center></th>
                                    <th><center>System</center></th>
                                    <th><center>Jenis</center></th>
                                    <th><center>Versi</center></th>
                                    <th><center>Jumlah Step</center></th>
                                    <th><center>Last Update</center></th>
                                     <!-- <th><center>Versi</center></th> -->
                                     <th><center>View</center></th>
                                     
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                 foreach ($query as $row) {
                                    $last = $this->db->query("SELECT * FROM ebanking_data_td WHERE bank='$row[bank]' AND channel='$row[channel]' AND transaksi= '$row[transaksi]' AND os='$row[os]' AND jenis='$row[jenis]' ORDER BY versi DESC, step DESC")->row_array();
                                  ?>
                                <tr>
                                   <td><?php echo $no++; ?></td>
                                   <td><?php echo $row['nama_bank']; ?></td>
                                   <td><?php echo $row['channel']; ?></td>
                                   <td><?php echo $row['nama_transaksi']; ?></td>
                                   <td><?php echo $row['os']; ?></td>
                                    <td><?php echo $row['jenis']; ?></td>
                                    <td><?php echo $last['versi']; ?></td>
                                    <td><?php echo $last['step']; ?></td>
                                    <td><?php echo $last['last_update']; ?></td>
                                    <td><center><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#view_rekap<?php echo $row['id'] ?>">
                                      <i class="fas fa-eye"></i> View
                                    </button></center>
                                    </td>    
                                </tr>
                            <?php }
                            ?>
                                 
                            </tbody>
                        </table>
                    </div>
                    <?php
                         } 
                    ?>

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

    <!-- Modal -->
    <?php
    if (isset($_POST['rekap_td'])) {
    $no=0;
     foreach ($query as $row) { $no++;

    $get = $this->db->get_where('ebanking_data_td', array('id' => $row['id'] ))->row_array();

    $get_view = $this->db->get_where('ebanking_data_td', array('bank' => $get['bank'], 'channel' => $get['channel'], 'transaksi' => $get['transaksi'], 'os' => $get['os'], 'jenis' => $get['jenis']))->result_array();
?>
<div class="modal fade" id="view_rekap<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Step TD E-Banking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr style="background-color: #7FFFD4;">
              <th><center>Step</center></th>
              <th><center>Label</center></th>
              <th><center>Versi</center></th>
              <th><center>Last Update</center></th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($get_view as $view) {
              ?>
              <tr>
                  <td><center><?php echo $view['step']; ?></center></td>
                  <td><?php echo $view['label']; ?></td>
                  <td><center><?php echo $view['versi']; ?></center></td>
                  <td ><center><?php echo $view['last_update']; ?></center></td>

              </tr>
          <?php } 
          ?>
          </tbody>
      </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal" style="background-color:     #8FBC8F; color: white;">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<?php
}
 } ?>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

    $(document).ready(function(){
$('#skenario_tdview').change(function(){
    $( function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
    // } );
    } );
    } );


    </script>
