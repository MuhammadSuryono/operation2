
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
        <h3><i class="fa fa-angle-right"></i> Plotting E-Banking </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Plotting E-Banking </strong> </h4>
                       <!-- Nav tabs -->
                     
                      <br>


                    
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                        
                        <div class="container-fluid" id="nonatmcenter">
                          <section id="unseen">
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
                                <select class="form-control" id="plotting_channel">
                                  <option value="">--Pilih Channel--</option>
                                  
                                  <option value="Internet Banking">Internet Banking</option>
                                  <option value="Mobile Banking">Mobile Banking</option>
                                  <option value="SMS Banking">SMS Banking</option>
                                
                                </select>
                              </div>
                               <div class="col-md-2">
                                <select class="form-control" id="plotting_transaksi">
                                  <option value="">--Pilih Transaksi--</option>
                                  <?php foreach ($transaksi as $row) {
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
                              <div class="col-md-2">
                                <select class="form-control" id="plotting_waktu">
                                  <option value="">--Waktu--</option>
                                  
                                  <option value="Pagi">Pagi</option>
                                  <option value="Siang">Siang</option>
                                  <option value="Malam">Malam</option>
                                
                                </select>
                              </div>
                              <div class="col-md-1">
                                <input type="number" name="plotting_trx" id="plotting_trx" placeholder="--Trx Ke--" class="form-control" min="0">
                              </div>

                              <div class="col-md-1">
                                <button type="button" class="btn btn-primary btn-xs" id="show_plotting" style="display: none;">Show</button>
                                <button type="button" class="btn btn-warning btn-xs" id="update_plotting" style="display: none;">Update</button>
                                
                              </div>
                              <!-- <div class="col-md-5 text-right">
                                <input type="checkbox" name="kota_cabang" value="1" id="kota_cabang" checked="checked" onclick="return false" >
                                <label for="kota_cabang">Kota</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="alamat_cabang" value="1" id="alamat_cabang" checked="checked" onclick="return false" >
                                <label for="alamat_cabang">Alamat</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="transport_cabang" value="1" id="transport_cabang" checked="checked">
                                <label for="transport_cabang">Transport</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="provinsi_cabang" value="1" id="provinsi_cabang">
                                <label for="provinsi_cabang">Provinsi</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="telp_cabang" value="1" id="telp_cabang">
                                <label for="telp_cabang">No Telepon</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="kodepos_cabang" value="1" id="kodepos_cabang">
                                <label for="kodepos_cabang">Kode Pos</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="fax_cabang" value="1" id="fax_cabang">
                                <label for="fax_cabang">Fax</label>
                                
                              </div> -->
                            </div>
                            <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">
                            <br>

                            <form action="<?php echo base_url('aktual/plotting_ebanking') ?>" method="POST">
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


    <!--main content end -->
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
