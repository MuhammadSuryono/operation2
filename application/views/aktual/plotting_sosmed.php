
  <?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
}
?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Plotting Evaluasi Sosial Media </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Plotting Evaluasi Sosial Media </strong> </h4>
                       <!-- Nav tabs -->
                     
                      <br>


                    
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                        
                        <div class="container-fluid" id="nonatmcenter">
                          <section id="unseen">
                            <div class="row">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editplot_bank">Edit Plotting Bank</button>
                            </div>
                             <!-- <div class="row" style="margin-bottom: 20px">
                              <div class="col-md-6">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcabangnon">
                                Tambah Cabang
                              </button>
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addcabangnon_csv">Tambah Cabang (Import)</button>
                            </div>

                              <?php
                              if ($id_user == 970) {
                                ?>
                              <div class="col-md-6 text-right">
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#uploadtemplate_nonatm">Upload Template File</button>
                              </div>
                            <?php } ?>
                            </div> -->
                            <?php
                            $get = $this->db->query("SELECT * FROM project WHERE visible = 'y' AND type = 'n' ORDER BY nama")->result_array(); 
                            ?>
                            <div class="row">
                              <div class="col-md-1"><h4><b>Pilih :</b></h4></div>
                            </div>
                            <div class="row">
                              <div class="col-md-2">
                                <select class="form-control" id="plotting_project">
                                  <option value="">--Pilih Project--</option>
                                   <?php foreach ($project as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode_project'] ?>"><?php echo $row['nama_project'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                               <div style="display: none;">
                                <select class="form-control" id="plotting_bank">
                                  <option value="">--Pilih Bank--</option>
                                   <?php foreach ($bank as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                               <div class="col-md-2">
                                <select class="form-control" id="plotting_platform">
                                  <option value="">--Pilih Platform--</option>
                                  
                                  <option value="Facebook">Facebook</option>
                                  <option value="Instagram">Instagram</option>
                                  <option value="Twitter">Twitter</option>
                                
                                </select>
                              </div>
                               <div class="col-md-2">
                                <select class="form-control" id="plotting_skenario">
                                  <option value="">--Pilih Skenario--</option>
                                  <?php foreach ($skenario as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                  <?php
                                  } ?> 
                                </select>
                              </div>
                              <div class="col-md-2">
                                <select class="form-control" id="plotting_hari">
                                  <option value="">--Hari--</option>
                                  
                                  <option value="Weekday">Weekday</option>
                                  <option value="Weekend">Weekend</option>
                               
                                </select>
                              </div>
                              <div class="col-md-3">
                                <div class="row">
                                <div class="col-sm-6">
                                <select class="form-control" id="plotting_waktu">
                                  <option value="">--Waktu--</option>
                                  
                                  <option value="Pagi">Pagi</option>
                                  <option value="Siang">Siang</option>
                                  <option value="Malam">Malam</option>
                                
                                </select>
                              </div>
                              <!-- </div>
                              <div class="col-md-1"> -->
                                <div class="col-sm-6">
                                <input type="number" name="plotting_trx" id="plotting_trx2" placeholder="--Evaluasi Ke--" class="form-control" min="0">
                              </div>
                              </div>
                              </div>

                              <div class="col-md-1">
                                <button type="button" class="btn btn-primary btn-xs" id="show_plotsosmed" style="display: none;">Show</button>
                                <button type="button" class="btn btn-warning btn-xs" id="update_plotsosmed" style="display: none;">Update</button>
                                
                              </div>
                            </div>
                            <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">
                            <br>

                            <form action="<?php echo base_url('aktual/plotadd_sosmed') ?>" method="POST">
                                <div id="tabel_plotting"></div>
                                <div id="id_plot"></div>
                                <button type="submit" class="btn btn-primary" style="display: none;" id="btn_plot">Plotting</button>
                                <button type="submit" class="btn btn-success" style="display: none;" id="btn_update_plot">Update Plotting</button>

                            </form>
                            
                                       
                                   
                                </tbody>
                              </table>
                            </section>
                        </div>



                      

                



                </div>
            </div>
          </div>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

    <!-- Modal -->
<div class="modal fade" id="editplot_bank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content " >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Plotting Tanggal Evaluasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
                              <div class="col-md-12 mr-3">
                                <select class="form-control" id="plotting_project99">
                                  <option value="">--Pilih Project--</option>
                                   <?php foreach ($project as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode_project'] ?>"><?php echo $row['nama_project'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                               <div class="col-md-12">
                                <select class="form-control selectpicker" id="plotting_bank99" data-live-search="true">
                                  <option value="">--Pilih Bank--</option>
                                   <?php foreach ($bank as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                               <div class="col-md-12">
                                <select class="form-control" id="plotting_platform99">
                                  <option value="">--Pilih Platform--</option>
                                  
                                  <option value="Facebook">Facebook</option>
                                  <option value="Instagram">Instagram</option>
                                  <option value="Twitter">Twitter</option>
                                
                                </select>
                              </div>
                               <div class="col-md-12">
                                <select class="form-control" id="plotting_skenario99">
                                  <option value="">--Pilih Skenario--</option>
                                  <?php foreach ($skenario as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                  <?php
                                  } ?> 
                                </select>
                              </div>
                              <div class="col-md-12">
                                <select class="form-control" id="plotting_hari99">
                                  <option value="">--Hari--</option>
                                  
                                  <option value="Weekday">Weekday</option>
                                  <option value="Weekend">Weekend</option>
                               
                                </select>
                              </div>
                              <div class="col-md-12">
                                <div class="row">
                                <div class="col-sm-12">
                                <select class="form-control" id="plotting_waktu99">
                                  <option value="">--Waktu--</option>
                                  
                                  <option value="Pagi">Pagi</option>
                                  <option value="Siang">Siang</option>
                                  <option value="Malam">Malam</option>
                                
                                </select>
                              </div>
                              <!-- </div>
                              <div class="col-md-1"> -->
                                <div class="col-sm-12">
                                <input type="number" name="plotting_trx" id="plotting_trx99" placeholder="--Evaluasi Ke--" class="form-control" min="0">
                              </div>
                              </div>
                              </div>

                            </div>
                            <form action="<?php echo base_url('aktual/plotadd_sosmed') ?>" method="POST">
                                <div id="venue"></div>
                                <div id="id_plot99"></div>
                                <button type="submit" class="btn btn-primary" style="display: none;" id="btn_plot99">Update Plotting</button>
                                
                            </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


    <!--main content end -->
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
