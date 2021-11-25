
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
        <h3><i class="fa fa-angle-right"></i> Progress Evaluasi Sosial Media </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Progress Evaluasi Sosial Media </strong> </h4>
                       <!-- Nav tabs -->
                     
                      <br>


                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                        
                        <div class="container-fluid">
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
                              <div class="col-md-2">
                                <select class="form-control" id="progress_project_sosmed">
                                  <option value="">--Pilih Project--</option>
                                   <?php foreach ($project as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode_project'] ?>"><?php echo $row['nama_project'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                               <div class="col-md-2">
                                <select class="form-control" id="progress_bank">
                                  <option value="">--Pilih Bank--</option>
                                   <?php foreach ($bank as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                               <div class="col-md-2">
                                <select class="form-control" id="progress_platform">
                                  <option value="">--Pilih Platform--</option>
                                  
                                  <option value="Facebook">Facebook</option>
                                  <option value="Instagram">Instagram</option>
                                  <option value="Twitter">Twitter</option>
                                
                                </select>
                              </div>
                               <div class="col-md-2">
                                <select class="form-control" id="progress_skenario">
                                  <option value="">--Pilih Skenario--</option>
                                  <?php foreach ($skenario as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                  <?php
                                  } ?> 
                                </select>
                              </div>
                              <div class="col-md-2">
                                <select class="form-control" id="filter_plotting">
                                  <option value="">--Filter Plotting--</option>
                                  <option value="1">Sudah Plotting</option>
                                  <option value="0">Belum Plotting</option>
                                </select>
                              </div>
                              <div class="col-md-1">
                                <button type="button" class="btn btn-primary" id="show_progress_sosmed">Show</button>
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

                            <div id="tabel_progress"></div>
                            
                                       
                                   
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
