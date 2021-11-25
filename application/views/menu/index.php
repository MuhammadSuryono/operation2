
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
        <h3><i class="fa fa-angle-right"></i> Akses Menu </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Akses Menu </strong> </h4>
                       <!-- Nav tabs -->
                      
                      <br>


                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                    <!-- Tab panes -->
                     
                        
                        <div  class="container-fluid">
                          <section id="unseen">
                            
                            <div class="row">
                              <table class="table table-bordered table-hover ">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Divisi</th>
                                    <th>Menu</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no = 1; 
                                  foreach ($divisi as $div) {
                                    
                                  ?>
                                  <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $div['keterangan_divisi']; ?></td>
                                    <td><a href="<?php echo base_url('menu/daftar_menu/').$div['id'] ?>" class="btn btn-primary"><i class="fas fa-arrow-circle-right"></i></a></td>
                                    
                                  </tr>
                                <?php } ?>
                                </tbody>
                              </table>
                             
                            </div>
                            <br>

                            
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

    <!-- /MAIN CONTENT -->
    <!--main content end -->
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
