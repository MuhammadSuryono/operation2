
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
        <h3><i class="fa fa-angle-right"></i> Panduan Apikasi </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Panduan Aplikasi </strong>
                       <!-- Nav tabs -->
                       <?php if ($user['id_divisi'] == 99) {
                           ?>
                          <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Add New</a>
                      <?php } ?>
                       </h4>
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
                            
                             <?php foreach($panduan as $db):
                                  $tanggalupload = $db['tanggalupload'];
                              ?>
                              <div class="col-sm-4">
                                  <div class="card text-center" style="background-color: #F0FFFF;">
                                      <div class="card-header text-center" style="padding-top: 20px;">
                                          <h4 class="text-primary text-bold"><strong><?=$db['judul']?></strong></h4>
                                      </div>
                                      <div class="card-body">
                                          <div style="margin-top: 20px;">
                                          <?php if ($db['fileupload'] != NULL) {
                                                  echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/panduan/" . $db['fileupload'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-book fa-5x'></i></a>";
                                                      } else {
                                                          echo "";
                                                      } ?>
                                          </div>
                                          <div style="padding-top: 20px;">
                                          <h5><strong>Tanggal Upload : <?php echo date('d M Y', strtotime($tanggalupload)); ?></strong></h5>
                                          </div>
                                      </div>
                                      <?php if ($user['id_divisi'] == 99) { ?>
                                          <div class="card-footer">
                                              <!-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit" data-nama_kategori="<?=$db['nama_kategori']?>" data-id_kategori="<?=$db['id_kategori']?>"><i class="fas fa-edit fa-fw"></i>Ubah</a> -->
                                              <a href="<?=base_url('menu/hapuspanduan/')?><?=$db['id']?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash fa-fw"></i>Hapus</a>
                                          </div>
                                      <?php } ?>
                                      </div>
                                  
                              </div>

                              <?php endforeach?>
                              <!-- AKHIR COLOM -->

                            
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


  <!-- MODAL TAMBAH -->

<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Upload Panduan Aplikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>

        <form action="<?=base_url('menu/uploadpanduan')?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
                    
        <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" id="judul" class="form-control" required>
        </div>
        <div class="form-group">
                <label>Upload File</label>
                <input type="file" name="file_upload" id="file_upload" class="form-control" accept="application/pdf" required>
        </div>
        <!-- <div class="form-group">
                <label>Tanggal Upload</label>
                <input type="text" name="tanggal" id="tanggal" class="form-control" value="<?php echo $datenow ?>" readonly>
        </div> -->
        
        </div>
        <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
    </div>
    </div>
</div>
</div>
<!-- MODAL TAMBAH -->


             


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
