<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Pengecekan Kelengkapan Field</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pengecekan Kelengkapan Field </strong></h4>
                <div class="row">
                  <div class="col-sm-12">
                  <a href="#" type="button" class="btn btn-round btn-warning mb" data-toggle="modal" data-target="#Modal_provider"><i class="fas fa-sim-card fa-fw"></i> Daftar Provider</a>
                  <a href="<?= base_url('project/peralatan') ?>" class="btn btn-round btn-success mb"><i class="fas fa-tools fa-fw"></i></i> Cek Peralatan</a>


                  </div>  
                </div>
                 <?= $this->session->flashdata('info');?>
                <a href="#" type="button" class="btn btn-round btn-primary mb" data-toggle="modal" data-target="#tambah"><i class="fa fa-check-circle fa-fw"></i> Tambah</a>
                
                <div class="col-lg-12">
                   <!--  <?= $this->session->flashdata('info');?> -->
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <!-- <th>Provider</th> -->
                      <th>Tanggal</th>
                      <!-- <th>Hari</th>
                      <th>Jam</th>
                      <th>Waktu</th>
                      <th>Kecepatan Unduh</th>
                      <th>Kecepatan Unggah</th> -->
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no=1;
                       foreach($pengecekan as $db) :?>
                      <tr>
                            <td><?= $no++;?></td>                          
                            <td><?= $db['nama_project']?></td>
                            <!-- <td><?= $db['provider']?></td> -->
                            <td><?= $db['tanggal']?></td>
                            <!-- <td><?= $db['hari']?></td>
                            <td><?= $db['jam']?></td>
                            <td><?= $db['waktu']?></td>
                            <td><?= $db['download']?> Mbps</td>
                            <td><?= $db['upload']?> Mbps</td> -->
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


<!-- Modal ADD DATA -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pengecekan Kecepatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('project/add_pengecekan') ?>" enctype="multipart/form-data">
        <div class="form-group">
          <label for="project">Project</label>
          <select id="project" name="project" class="selectpicker form-control" data-live-search="true">
            <option value="">Pilih Project</option>
          <?php foreach ($project as $pro) : ?>
            <option value="<?php echo $pro['kode'] ?>"><?php echo $pro['nama'] ?></option>
          <?php
            endforeach; ?>
          </select> 
        </div>
        <div class="form-group">
          <label for="tanggal">Tanggal</label>
          <input type="date" class="form-control" id="tanggal_field" name="tanggal_field" value="<?php echo date('Y-m-d'); ?>">
           <small id="ket_hari" class="form-text text-muted text-danger"><b>Hari termasuk <?php if (date('D') == 'Sat' OR date('D') == 'Sun') {
             echo "Weekend";
           } else {
            echo "Weekday";
           } ?>.</b></small>
        </div>
        <input type="hidden" name="hari_field" id="hari_field" value="<?php if (date('D') == 'Sat' OR date('D') == 'Sun') {
             echo "Weekend";
           } else {
            echo "Weekday";
           } ?>">

        <?php
        $jam = date('H:i');
        $get = $this->db->query("SELECT * FROM `waktu` WHERE awal <= '$jam' AND akhir >= '$jam'")->row_array();

        if ($get != NULL) {
            $ket_waktu = $get['ket'];
        } else {
            $ket_waktu = "Tidak Terdaftar";
        } ?>

        <div class="form-group">
          <label for="waktu">Waktu</label><br>
          <input type="radio" id="waktu" name="waktu_field" value="Pagi"> Pagi &nbsp;&nbsp;&nbsp;
          <input type="radio" id="waktu" name="waktu_field" value="Siang"> Siang &nbsp;&nbsp;&nbsp;
          <input type="radio" id="waktu" name="waktu_field" value="Malam"> Malam

        </div>
        <button type="button" class="btn btn-primary add">Add Row</button>
      <div class="data-row">
        <div class="row" style="border-bottom: 2px solid grey;">
        <div class="col-sm-2">
          <div class="form-group">
            <label for="waktu">Waktu</label>
            <input type="time" class="form-control" id="jam_field" name="jam_field[]" value="<?php echo date('H:i'); ?>">
            <!-- <small id="ket_waktu" class="form-text text-muted text-danger"><b>Waktu termasuk <?php echo $ket_waktu; ?></b></small> -->
          </div>
        </div>
        <!-- <input type="hidden" name="waktu_field" id="waktu_field" value="<?php echo $ket_waktu ?>"> -->
        <?php
            $prov = $this->db->get('ebanking_provider')->result_array(); 
        ?>
        <div class="col-sm-3">
          <div class="form-group">
            <label for="provider">Provider</label>
            <select id="provider" name="provider[]" class="form-control" >
              <option value="">Pilih Provider</option>
              <?php foreach ($prov as $db) { ?>
               <option value="<?php echo $db['nama'] ?>"><?php echo $db['nama'] ?></option>
             <?php } ?>
              
            </select> 
          </div>
        </div>
        
          <div class="col-sm-2">
            <div class="form-group">
              <label for="download">Kecepatan Unduh</label>
              <input type="number" step="0.01" class="form-control" id="download" name="download[]">
              <small id="ket_download" class="form-text text-muted">Satuan dalam (Mbps)</small>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="upload">Kecepatan Unggah</label>
              <input type="number" step="0.01" class="form-control" id="upload" name="upload[]">
              <small id="ket_upload" class="form-text text-muted">Satuan dalam (Mbps)</small>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="upload">Upload Screenshoot</label>
              <input type="file" class="form-control bukti" id="bukti" name="bukti[]" accept="image/*" onchange="uploadfile()">
              <small id="ket_upload" class="form-text text-danger">Ukuran file upload maksimal 50KB!</small>
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


<!-- Modal PROVIDER -->
<div class="modal fade" id="Modal_provider" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Provider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form  action="<?= base_url('project/editprovider')?>" method="POST">
      <div class="modal-body">
       
        <table class="table">
          <thead>
            <tr>
              <th><center>Provider</center></th>
              <th><center>Aksi Delete</center></th>
            </tr>
          </thead>
          <tbody class="input_row2">
              <?php 

            $this->db->select('*');
            $this->db->from('ebanking_provider');
            
            $aksi = $this->db->get()->result_array();
                foreach ($aksi as $row) :
                ?>
                <tr>
                  <input type="hidden" name="id[]" value="<?php echo $row['id'] ?>">
                  <td><center><input type="text" name="nama[]" class="form-control" value="<?php echo $row['nama']; ?>"></center></td>
                  <td><center><input type="checkbox" name="delete_id[]" value="<?php echo $row['id']; ?>"></center></td>
                  
                </tr>
            
            <?php            
               endforeach; ?>
            </tbody>
          
        </table>
        <div class="row">
          <div class="col-sm-6 text-left">
            <button type="button" class="btn btn-primary add2">Add Row</button>
          </div>
        <div class="col-sm-6 text-right">
          <button type="submit" class="btn btn-warning" name="update"> <i class="fas fa-edit"></i> Update</button>
          <button type="submit" class="btn btn-danger" name="hapus"> <i class="fas fa-trash-alt"></i> Delete</button>
        </div>
      </div>
      </form>
      </div>

      <div class="modal-footer">
       
        <button type="button" class="btn" data-dismiss="modal" style="background-color:     #8FBC8F; color: white;">Close</button>
       
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<!-- Modal VIEW DATA -->
<?php $no = 0;
foreach ($pengecekan as $db) {
 ?>
<div class="modal fade" id="view_data<?php echo $db['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 1140px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Hasil Pengecekan Kecepatan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form  action="<?= base_url('project/delete_daftar')?>" method="POST">
      <div class="modal-body">
        <?php $haritanggal = date('D, d M Y', strtotime($db['tanggal']));
         $nm_hari = ['Pagi', 'Siang', 'Malam'];
         ?>
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <td rowspan="3"><b>Provider</b></td>
                <td colspan="15"><center><b><?php echo $haritanggal; ?></b></center></td>
              </tr>
              <tr>
                <?php foreach ($nm_hari as $value) { ?>
                <td colspan="5"><center><b><?php echo $value; ?></b></center></td>
               <?php } ?>
              </tr>
              <tr>
                <?php foreach ($nm_hari as $value) { ?>
                <td><center><b>Waktu</b></center></td>
                <td><center><b>Unduh</b></center></td>
                <td><center><b>Unggah</b></center></td>
                <td><center><b>Upload SC</b></center></td>
                <td><center><b>Delete</b></center></td>

               <?php } ?>
              </tr>
              <?php foreach ($prov as $pvd) { ?>
              <tr>
                    <td><?php echo $pvd['nama']; ?></td>
                <?php foreach ($nm_hari as $value) {

                $data = $this->db->query("SELECT * FROM ebanking_cekfield WHERE project='$db[project]' AND tanggal='$db[tanggal]' AND waktu='$value' AND provider='$pvd[nama]'")->row_array(); ?>
                    <td><center><?php if ($data != NULL) { echo date('H:i', strtotime($data['jam'])); } ?></center></td>
                    <td><center><?php if ($data != NULL) { echo $data['download']; ?> Mbps <?php } ?></center></td>
                    <td><center><?php if ($data != NULL) { echo $data['upload']; ?> Mbps <?php } ?></center></td>
                    <td><center><?php if ($data != NULL) { ?> <a class="fancybox" href="<?= base_url('assets/')?>file/project/<?= $data['bukti']?>"><i class="fas fa-file-image"></i></a> <?php } ?></center></td>
                    <td><center><?php if ($data != NULL) { ?> <input type="checkbox" name="id_delete[]" value="<?php echo $data['id'] ?>"> <?php } ?></center></td>

               <?php } ?>
              </tr>
            <?php } ?>
            </thead>
          </table>
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
                                        <label for="waktu">Waktu</label>
                                        <input type="time" class="form-control" id="jam_field" name="jam_field[]" value="`+jam+`">
                                        
                                      </div>
                                    </div>
                                    <div class="col-sm-3">
                                      <div class="form-group">
                                        <label for="provider">Provider</label>
                                        <select id="provider" name="provider[]" class="form-control">
                                          <option value="">Pilih Provider</option>`;
                                      for (i = 0; i < hasil.length; i++) {
                          cobaah +=     `<option value="`+hasil[i]['nama']+`">`+hasil[i]['nama']+`</option>`
                                        }
                          cobaah +=   `</select> 
                                      </div>
                                    </div>
                                    
                                      <div class="col-sm-2">
                                        <div class="form-group">
                                          <label for="download">Kecepatan Unduh</label>
                                          <input type="number" step="0.01" class="form-control" id="download" name="download[]">
                                          <small id="ket_download" class="form-text text-muted">Satuan dalam (Mbps)</small>
                                        </div>
                                      </div>
                                      <div class="col-sm-2">
                                        <div class="form-group">
                                          <label for="upload">Kecepatan Unggah</label>
                                          <input type="number" step="0.01" class="form-control" id="upload" name="upload[]">
                                          <small id="ket_upload" class="form-text text-muted">Satuan dalam (Mbps)</small>
                                        </div>
                                      </div>
                                      <div class="col-sm-2">
                                        <div class="form-group">
                                          <label for="upload">Upload Screenshoot</label>
                                          <input type="file" class="form-control bukti" id="bukti" name="bukti[]" accept="image/*" onchange="uploadfile()">
                                          <small id="ket_upload" class="form-text text-danger">Ukuran file upload maksimal 50KB!</small>
                                          
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
                     var max_fields2      = 100; //maximum input boxes allowed
                     var wrapper2     = $(".input_row2"); //Fields wrapper
                     var add_button2      = $(".add2"); //Add button ID


                     // var nomor = document.getElementById('nomor').value;
                     
                     var x = 1; //initlal text box count
                     $(add_button2).click(function(e){ //on add input button click
                      e.preventDefault();

                      if(x < max_fields2){ //max input box allowed

                      var cobaah = "";
                      // nomor++;


                      
                       cobaah += "<tr class='py-3'>";
                       cobaah += "<input type='hidden' id='id_label' name='id[]' value='null';>";
                       cobaah += " <td><input type='text' id='label_td' name='nama[]' class='form-control' placeholder='Nama Provider'></td>";
                       cobaah += "<td><center>";
                       cobaah += "<a href='#' class='btn btn-danger remove_field' title='Delete'><i class='fas fa-trash-alt'></i></a>"
                       cobaah += "</center></td>";
                       cobaah += " </tr>";
                       
                       
                       
                       x++; //text box increment
                       $(wrapper2).append(cobaah); //add input box
                     }

                      });
 
                     $(wrapper2).on("click",".remove_field", function(e){ //user click on remove text
                      e.preventDefault(); $(this).closest('tr').remove(); x--;
                     })
                    });

// var uploadField = document.querySelectorAll("#bukti");
// var uploadField = document.getElementsByClassName("bukti");
// uploadField.onchange = function() {
//   // alert('Ganti');
//     if(this.files[0].size > 50000){ // ini untuk ukuran 800KB, 1000000 untuk 1 MB.
//        alert("Maaf. File Terlalu Besar ! Maksimal Upload 50 KB");
//        this.value = "";
//     };
// };

function uploadfile(){
  console.log(this);
  if($('#bukti')[0].files[0].size > 50000){ // ini untuk ukuran 800KB, 1000000 untuk 1 MB.
       alert("Maaf. File Terlalu Besar ! Maksimal Upload 50 KB");
       this.value = "";
       // $(this).removeAttr('value');
    }
}
</script>