
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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Daftar SubMenu </strong> </h4>
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
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#add_submenu" style="margin-bottom: 15px;"><i class="fas fa-plus"></i> Tambah Daftar SubMenu</button>
                              <table class="table table-bordered table-hover ">
                                <thead>
                                  <tr>
                                    <th>No Urut</th>
                                    <th>Nama Submenu</th>
                                    <th>Control Submenu</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no = 1; 
                                  foreach ($submenu as $row) {
                                    
                                  ?>
                                  <tr>
                                    <td><?php echo $row['urut']; ?></td>
                                    <td><?php echo $row['nama_submenu']; ?></td>
                                    <td><?php echo $row['control_submenu']; ?></td>
                                   
                                                            
                                  
                                    <td>
                                         <button type="button" data-toggle="modal" data-target="#edit_submenu<?php echo $row['id_submenu'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                        <a href="<?php echo base_url('menu/delete_daftar_submenu/').$row['id_submenu']."/".$row['id_menu'] ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                                    </td>
                                    
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


       <!-- Modal  Add Daftar Sub Menu-->
            <div class="modal fade" id="add_submenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color:     #F8F8FF;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  

                     <form class="" action="<?php echo base_url('menu/add_daftar_submenu'); ?>" method="POST">
                        <div class="modal-body" >
                            <div class="form-group">
                                <?php
                                $id_menu = $this->uri->segment(3); ?>
                                <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>">
                                <label>No Urut</label>
                                <input type="number" name="urut" class="form-control" >
                                 <br>
                                <label>Nama SubMenu</label>
                                <input type="text" name="nama_submenu" class="form-control" >
                                 <br>
                                <label>Controller SubMenu</label>
                                <input type="text" name="control_submenu" class="form-control" >
                            </div>                             
                    </div>

                  <div class="modal-footer" style="margin-top: 20px;">
                    
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                  </div>
              </form>
                </div>
              </div>
            </div>



             <!-- Modal  Edit Daftar Menu Staff-->
             <?php
             $no = 0;
              foreach ($submenu as $row) :
                $no++;
              ?>
            <div class="modal fade" id="edit_submenu<?php echo $row['id_submenu'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color:     #F8F8FF;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Submenu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  

                     <form class="" action="<?php echo base_url('menu/edit_daftar_submenu'); ?>" method="POST">
                        <div class="modal-body" >
                            <div class="form-group">
                                <?php
                                $id_menu = $this->uri->segment(3); ?>
                                <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>">
                                <input type="hidden" name="id_submenu" value="<?php echo $row['id_submenu']; ?>">
                                
                                <label>No Urut</label>
                                <input type="number" name="urut" class="form-control" value="<?php echo $row['urut'] ?>">
                                 <br>
                                <label>Nama Menu</label>
                                <input type="text" name="nama_submenu" class="form-control" value="<?php echo $row['nama_submenu'] ?>">
                                 <br>
                                <label>Controller Menu</label>
                                <input type="text" name="control_submenu" class="form-control" value="<?php echo $row['control_submenu'] ?>">
                            </div>                             
                    </div>

                  <div class="modal-footer" style="margin-top: 20px;">
                    
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                  </div>
              </form>
                </div>
              </div>
            </div>
        <?php endforeach; ?>



<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
