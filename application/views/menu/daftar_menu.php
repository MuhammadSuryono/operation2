
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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Daftar Menu </strong> </h4>
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
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#add_menu" style="margin-bottom: 15px;"><i class="fas fa-plus"></i> Tambah Daftar Menu</button>
                              <table class="table table-bordered table-hover thead-light">
                                <thead>
                                  <tr>
                                    <th>No Urut</th>
                                    <th>Nama Menu</th>
                                    <th>Control Menu</th>
                                    <th>Icon</th>
                                    <th>Submenu</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $no = 1; 
                                  foreach ($master as $row) {
                                    
                                  ?>
                                  <tr>
                                    <td><?php echo $row['urut']; ?></td>
                                    <td><?php echo $row['nama_menu']; ?></td>
                                    <td><?php echo $row['control_menu']; ?></td>
                                    <td><?php echo $row['icon']; ?></td>
                                                            
                                  <?php if ($row['sub'] == '1') {
                                   ?>
                                     <td><a href="<?php echo base_url('menu/daftar_submenu/').$row['id_menu'] ?>" class="btn btn-primary"><i class="fas fa-arrow-circle-right"></i></a></td>
                                    <?php } else { ?>
                                        <td></td>
                                    <?php } ?>
                                    <td>
                                         <button type="button" data-toggle="modal" data-target="#edit_menu<?php echo $row['id_menu'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                        <a href="<?php echo base_url('menu/delete_daftar_menu/').$row['id_menu']."/".$row['id_divisi'] ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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


        <!-- Modal  Add Daftar Menu-->
            <div class="modal fade" id="add_menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color:     #F8F8FF;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  

                     <form class="" action="<?php echo base_url('menu/add_daftar_menu'); ?>" method="POST">
                        <div class="modal-body" >
                            <div class="form-group">
                                <?php
                                $id_divisi = $this->uri->segment(3); ?>
                                <input type="hidden" name="id_divisi" value="<?php echo $id_divisi; ?>">
                                <label>No Urut</label>
                                <input type="number" name="urut" class="form-control" >
                                <br>
                                <label>Nama Menu</label>
                                <input type="text" name="nama_menu" class="form-control" >
                                <br>
                                <label>Icon</label>
                                <input type="text" name="icon" class="form-control" >
                                <br>
                                <input type="checkbox" id="sub1" name="sub" value="1">
                                <label for="sub">Memiliki Submenu</label>
                                 <br>
                                 <br>
                                <label>Controller Menu</label>
                                <input type="text" id="control_menu1" name="control_menu" class="form-control" >
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
              foreach ($master as $row) :
                $no++;
              ?>
            <div class="modal fade" id="edit_menu<?php echo $row['id_menu'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content" style="background-color:     #F8F8FF;">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  

                     <form class="" action="<?php echo base_url('menu/edit_daftar_menu'); ?>" method="POST">
                        <div class="modal-body" >
                            <div class="form-group">
                                <?php
                                 $id_divisi = $this->uri->segment(3); ?>
                                <input type="hidden" name="id_divisi" value="<?php echo $id_divisi; ?>">
                                <input type="hidden" name="id_menu" value="<?php echo $row['id_menu']; ?>">
                                <label>No Urut</label>
                                <input type="number" name="urut" class="form-control" value="<?php echo $row['urut'] ?>">
                                <br>
                                <label>Nama Menu</label>
                                <input type="text" name="nama_menu" class="form-control" value="<?php echo $row['nama_menu'] ?>">
                                <br>
                                <label>Icon</label>
                                <input type="text" name="icon" class="form-control" value="<?php echo $row['icon'] ?>">
                                <br>
                                <?php 
                                if ($row['sub'] == '1') {
                                     ?>
                                <input type="checkbox" id="sub2" name="sub" value="1" checked="">
                                <?php } else { ?>
                                <input type="checkbox" id="sub2" name="sub" value="1">
                                <?php } ?>
                                <label for="sub">Memiliki Submenu</label>
                                 <br>
                                 <br>
                                <label>Controller Menu</label>
                                <input type="text" name="control_menu" id="control_menu2" class="form-control" value="<?php echo $row['control_menu'] ?>">
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


 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


<script>
   $("input[type=checkbox]").on("change", function(evt) {
    var sub = $('input[id=sub1]:checked');
    var sub2 = $('input[id=sub2]:checked');
   
    if (sub.length == 1) {
      $("input[id=control_menu1]").prop("readonly", true);
    } else {
      $("input[id=control_menu1]").prop("readonly", false);
    }

    if (sub2.length == 1) {
      $("input[id=control_menu2]").prop("readonly", true);
    } else {
      $("input[id=control_menu2]").prop("readonly", false);
    }
  });
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
