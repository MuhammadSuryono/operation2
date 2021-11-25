<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Pengecekan Peralatan Field</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pengecekan Peralatan Field </strong></h4>
<!--                 <div class="row">
                  <div class="col-sm-12">
                  <a href="#" type="button" class="btn btn-round mb" data-toggle="modal" data-target="#Modal_provider" style="background-color: #8FBC8F; color: white;"><i class="fas fa-sim-card fa-fw"></i> Daftar Provider</a>
                  <a href="<?= base_url('project/peralatan') ?>" class="btn btn-round btn-success mb"><i class="fas fa-sim-card fa-fw"></i> Cek Peralatan</a>


                  </div>  
                </div>
 -->                 <?= $this->session->flashdata('info');?>
                <a href="#" type="button" class="btn btn-round btn-primary mb" data-toggle="modal" data-target="#tambah"><i class="fa fa-check-circle fa-fw"></i> Tambah Perangkat PC/Smartphone</a>

                <a href="#" type="button" class="btn btn-round btn-primary mb" data-toggle="modal" data-target="#tambah_stopwatch"><i class="fa fa-check-circle fa-fw"></i> Tambah Stopwatch</a>

                
                <div class="col-lg-12">
                   <!--  <?= $this->session->flashdata('info');?> -->
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no=1;
                       foreach($pengecekan as $db) :?>
                      <tr>
                            <td><?= $no++;?></td>                          
                            <td><?= $db['nama_project']?></td>
                            <td><center>
                              <button type="button" class="btn btn-warning btn-round" data-toggle="modal" data-target="#view_data<?php echo $db['id'] ?>"><i class="far fa-eye"></i> View</button>
                            </center></td>
                        </tr>


                      <?php endforeach?>
                  </tbody>
                </table>
                
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>


<!-- Modal ADD DATA PC/SMARTPHONE-->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 1140px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengecekan Peralatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('project/add_peralatan') ?>" enctype="multipart/form-data">
        <div class="form-group">
          <label for="project">Project</label>
          <select id="project" name="project" class="selectpicker form-control" data-live-search="true" required>
            <option value="">Pilih Project</option>
          <?php foreach ($project as $pro) : ?>
            <option value="<?php echo $pro['kode'] ?>"><?php echo $pro['nama'] ?></option>
          <?php
            endforeach; ?>
          </select> 
        </div>
        
      
        <button type="button" class="btn btn-primary add">Add Row</button>
      <div class="data-row">
        <div class="row" style="border-bottom: 2px solid grey;">
        <div class="col-sm-2">
          <div class="form-group">
            <label for="waktu">Nama Perangkat</label>
            <input type="text" class="form-control" id="alat" name="alat[]" required>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label for="waktu">Jenis Perangkat</label>
            <select class="form-control" id="jenis" name="jenis[]" required>
              <option value="">Pilih Jenis</option>
              <option value="PC">PC</option>
              <option value="Smartphone">Smartphone</option>
            </select>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label for="waktu">Penyimpanan Terpakai</label>
            <input type="text" class="form-control" id="terpakai" name="terpakai[]" required>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label for="waktu">Penyimpanan Kosong</label>
            <input type="text" class="form-control" id="kosong" name="kosong[]" required>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <label for="waktu">Upload SC</label>
            <input type="file" class="form-control" id="bukti" name="bukti[]" required>
          </div>
        </div>


        </div>
        </div>

        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal ADD DATA STOPWATCH-->
<div class="modal fade" id="tambah_stopwatch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 1140px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengecekan Peralatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('project/add_peralatan') ?>" enctype="multipart/form-data">
        <div class="form-group">
          <label for="project">Project</label>
          <select id="project" name="project" class="selectpicker form-control" data-live-search="true" required>
            <option value="">Pilih Project</option>
          <?php foreach ($project as $pro) : ?>
            <option value="<?php echo $pro['kode'] ?>"><?php echo $pro['nama'] ?></option>
          <?php
            endforeach; ?>
          </select> 
        </div>
        
      
        <button type="button" class="btn btn-primary add3">Add Row</button>
      <div class="data-row3">
        <div class="row" style="border-bottom: 2px solid grey;">
        <div class="col-sm-3">
          <div class="form-group">
            <label for="waktu">Stopwatch/ID</label>
            <input type="text" class="form-control" id="alat" name="alat[]" required>
          </div>
        </div>

        <input type="hidden" name="jenis[]" id="jenis" value="Stopwatch">
       
        <div class="col-sm-2">
          <div class="form-group">
            <label for="waktu">Dikalibrasi dengan</label>
            <input type="text" class="form-control" id="terpakai" name="terpakai[]" required>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label for="waktu">Hasil kalibrasi</label>
            <input type="text" class="form-control" id="kosong" name="kosong[]" required>
          </div>
        </div>

        <div class="col-sm-3">
          <div class="form-group">
            <label for="waktu">Upload SC</label>
            <input type="file" class="form-control" id="bukti" name="bukti[]" required>
          </div>
        </div>


        </div>
        </div>

        </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>



<!-- Modal VIEW DATA -->
<?php $no = 0;
foreach ($pengecekan as $db) {
 ?>
<div class="modal fade" id="view_data<?php echo $db['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 90%;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Hasil Pengecekan Peralatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form  action="<?= base_url('project/delete_peralatan')?>" method="POST">
      <div class="modal-body">
      <h4>Project <?php echo $db['nama_project']. " (".$db['project'].")"; ?></h4>
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered">
          <thead>
              <tr>
                <th>No</th>
                <th>Stopwatch/ID</th>
                <th>Dikalibrasi dengan</th>
                <th>Hasil kalibrasi</th>
                <th>Bukti</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php $alat = $this->db->query("SELECT * FROM ebanking_peralatan WHERE jenis='Stopwatch' AND project='$db[project]'")->result_array();
              $no = 1;
              foreach ($alat as $key) { ?>
              <tr>
                
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $key['nama']; ?></td>
                  <td><?php echo $key['terpakai']; ?></td>
                  <td><?php echo $key['kosong']; ?></td>
                  <td><center><?php if ($key['bukti'] != NULL) { ?> <a class="fancybox" href="<?= base_url('assets/')?>file/project/<?= $key['bukti']?>"><i class="fas fa-file-image"></i></a> <?php } ?></center></td>
                  <td><center><input type="checkbox" name="id_hapus[]" value="<?php echo $key['id']?>"></center></td>
                </tr>
               <?php } ?>
              
            </tbody>  
          </table>
        </div>
      </div>
      <br>
      <br>
      <div class="row">

        <!-- DATA PC -->
        <div class="col-sm-6">
        <div class="table-responsive">
          <table class="table table-bordered">
          <thead>
              <tr>
                <th>No</th>
                <th>PC</th>
                <th>Pernyimpanan Terpakai</th>
                <th>Penyimpanan Kosong</th>
                <th>Bukti</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php $alat = $this->db->query("SELECT * FROM ebanking_peralatan WHERE jenis='PC' AND project='$db[project]'")->result_array();
              $no = 1;
              foreach ($alat as $key) { ?>
              <tr>
                
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $key['nama']; ?></td>
                  <td><?php echo $key['terpakai']; ?></td>
                  <td><?php echo $key['kosong']; ?></td>
                  <td><center><?php if ($key['bukti'] != NULL) { ?> <a class="fancybox" href="<?= base_url('assets/')?>file/project/<?= $key['bukti']?>"><i class="fas fa-file-image"></i></a> <?php } ?></center></td>
                  <td><center><input type="checkbox" name="id_hapus[]" value="<?php echo $key['id']?>"></center></td>
                  
                </tr>
               <?php } ?>
              
            </tbody>  
          </table>
        </div>
      </div>

        <!-- DATA SMARTPHONE -->
      <div class="col-sm-6">
        <div class="table-responsive">
          <table class="table table-bordered">
          <thead>
              <tr>
                <th>No</th>
                <th>SMARTPHONE</th>
                <th>Pernyimpanan Terpakai</th>
                <th>Penyimpanan Kosong</th>
                <th>Bukti</th>
                <th>Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php $alat = $this->db->query("SELECT * FROM ebanking_peralatan WHERE jenis='Smartphone' AND project='$db[project]'")->result_array();
              $no = 1;
              foreach ($alat as $key) { ?>
              <tr>
                
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $key['nama']; ?></td>
                  <td><?php echo $key['terpakai']; ?></td>
                  <td><?php echo $key['kosong']; ?></td>
                  <td><center><?php if ($key['bukti'] != NULL) { ?> <a class="fancybox" href="<?= base_url('assets/')?>file/project/<?= $key['bukti']?>"><i class="fas fa-file-image"></i></a> <?php } ?></center></td>
                  <td><center><input type="checkbox" name="id_hapus[]" value="<?php echo $key['id']?>"></center></td>
                
                </tr>
               <?php } ?>
              
            </tbody>  
          </table>
        </div>
      </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>


        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </form>
  </div>
</div>
<?php } ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });


  $(document).ready(function() {
                     var max_fields      = 100; //maximum input boxes allowed
                     var wrapper     = $(".data-row"); //Fields wrapper
                     var add_button      = $(".add"); //Add button ID


                     // var nomor = document.getElementById('nomor').value;
                     
                     var x = 1; //initlal text box count
                     $(add_button).click(function(e){ //on add input button click
                      e.preventDefault();

                      if(x < max_fields){ //max input box allowed

                      $.ajax({
                       url: "<?php echo base_url('project/getprovider') ?>",
                       type: "POST",
                       dataType: 'json',
                       data: {

                       },
                       success: function(hasil) {
                         console.log(hasil);

                      var cobaah = "";
                      // nomor++;
                      var jam = $('#jam_field').val();


                      
                       cobaah += `<div class="row" style="border-bottom: 2px solid grey;">
                                   <div class="col-sm-2">
                                    <div class="form-group">
                                      <label for="waktu">Nama Perangkat</label>
                                      <input type="text" class="form-control" id="alat" name="alat[]" required>
                                    </div>
                                  </div>

                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label for="waktu">Jenis Perangkat</label>
                                      <select class="form-control" id="jenis" name="jenis[]" required>
                                        <option value="">Pilih Jenis</option>
                                        <option value="PC">PC</option>
                                        <option value="Smartphone">Smartphone</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label for="waktu">Penyimpanan Terpakai</label>
                                      <input type="text" class="form-control" id="terpakai" name="terpakai[]" required>
                                    </div>
                                  </div>

                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label for="waktu">Penyimpanan Kosong</label>
                                      <input type="text" class="form-control" id="kosong" name="kosong[]" required>
                                    </div>
                                  </div>

                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label for="waktu">Upload SC</label>
                                      <input type="file" class="form-control" id="bukti" name="bukti[]" required>
                                    </div>
                                  </div>
                                  <div class="col-sm-1">
                                      <a href='#' class='btn btn-danger remove_field mt-3' title='Delete'><i class='fas fa-trash-alt'></i></a>
                                      </div>

                                    </div>`;
                      
                       
                       
                       
                       x++; //text box increment
                       $(wrapper).append(cobaah); //add input box
                     }


                      });
 
                     $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                      e.preventDefault(); $(this).closest('.row').remove(); x--;
                     });

                      }
                      });

                    });

$(document).ready(function() {
                     var max_fields      = 100; //maximum input boxes allowed
                     var wrapper3     = $(".data-row3"); //Fields wrapper
                     var add_button3      = $(".add3"); //Add button ID


                     // var nomor = document.getElementById('nomor').value;
                     
                     var x = 1; //initlal text box count
                     $(add_button3).click(function(e){ //on add input button click
                      e.preventDefault();

                      if(x < max_fields){ //max input box allowed

                      $.ajax({
                       url: "<?php echo base_url('project/getprovider') ?>",
                       type: "POST",
                       dataType: 'json',
                       data: {

                       },
                       success: function(hasil) {
                         console.log(hasil);

                      var cobaah = "";
                      // nomor++;
                      var jam = $('#jam_field').val();


                      
                       cobaah += `<div class="row" style="border-bottom: 2px solid grey;">
                                   <div class="col-sm-3">
                                      <div class="form-group">
                                        <label for="waktu">Stopwatch/ID</label>
                                        <input type="text" class="form-control" id="alat" name="alat[]" required>
                                      </div>
                                    </div>

                                    <input type="hidden" name="jenis[]" id="jenis" value="Stopwatch">
                                   
                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label for="waktu">Dikalibrasi dengan</label>
                                        <input type="text" class="form-control" id="terpakai" name="terpakai[]" required>
                                      </div>
                                    </div>

                                    <div class="col-sm-2">
                                      <div class="form-group">
                                        <label for="waktu">Hasil kalibrasi</label>
                                        <input type="text" class="form-control" id="kosong" name="kosong[]" required>
                                      </div>
                                    </div>

                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label for="waktu">Upload SC</label>
                                        <input type="file" class="form-control" id="bukti" name="bukti[]" required>
                                      </div>
                                    </div>
                                  <div class="col-sm-1">
                                      <a href='#' class='btn btn-danger remove_field mt-3' title='Delete'><i class='fas fa-trash-alt'></i></a>
                                      </div>

                                    </div>`;
                      
                       
                       
                       
                       x++; //text box increment
                       $(wrapper3).append(cobaah); //add input box
                     }


                      });
 
                     $(wrapper3).on("click",".remove_field", function(e){ //user click on remove text
                      e.preventDefault(); $(this).closest('.row').remove(); x--;
                     });

                      }
                      });

                    });


</script>