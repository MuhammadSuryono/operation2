 <?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;

if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
  $Id = $user['noid'];
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
  $Id = $user['Id'];
}
?>   
 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <!--main content start-->

    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Upload Ulang Bukti Transaksi E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Upload Ulang Bukti Transaksi E-Banking </strong></h4>
                       
                        <div class="row">
                          <div class="container-fluid">

                          <section id="unseen">
                        <form method="POST" action="<?php echo base_url('aktual/uploadfile_ebanking') ?>" enctype="multipart/form-data">
                          <input type="hidden" name="num" value="<?= $db['num']; ?>">
                        
                          <table class="table">
                            <tr>
                              <td width="20%">Project</td>
                              <td>:</td>
                              <td><?= $db['nama_project'] ?></td>
                            </tr>
                            <tr>
                              <td width="20%">Nama Bank</td>
                              <td>:</td>
                              <td><?= $db['nama_bank'] ?></td>
                            </tr>
                            <tr>
                              <td width="20%">Channel</td>
                              <td>:</td>
                              <td><?= $db['channel'] ?></td>
                            </tr>
                            <tr>
                              <td width="20%">Jenis Transaksi</td>
                              <td>:</td>
                              <td><?= $db['nama_transaksi'] ?></td>
                            </tr>
                            <tr>
                              <td width="20%">Provider</td>
                              <td>:</td>
                              <td><?= $db['provider'] ?></td>
                            </tr>
                            <tr>
                              <td width="20%">System</td>
                              <td>:</td>
                              <td><?php if($db['os'] != NULL){echo $db['os'];} else {echo "-";} ?></td>
                            </tr>

                            <tr>
                              <td width="20%">Tanggal Evaluasi</td>
                              <td>:</td>
                              <td><?= $db['tanggal_evaluasi'] ?></td>
                            </tr>
                            <tr>
                              <td width="20%">Jam</td>
                              <td>:</td>
                              <td><?= $db['jam_mulai']." - ".$db['jam_selesai'] ?></td>
                            </tr>
                          </table>
                        
                          <div class="container-fluid form-group" id="provider_ebanking" style="margin: 20px;">
                          <label><b>Upload Bukti Transaksi</b></label>    
                            <input type="file" class="form-control" name="bukti_transaksi" id="bukti_transaksi" accept="image/*" required="">
                            <span class="bg-info p-1"><b>NOTE!</b></span>&nbsp;&nbsp;Ukuran file upload maksimal 500KB!<br>
                            <img src="#" id="gambar_nodin" width="100%" alt="Preview Gambar" />                                                
                          </div>

                          <div class="row text-center">
                            <input type="submit" name="submit" class="btn btn-success" value="Save">
                          </div>
                        </form>
                      </section>
                        </div>

                        </div>
                  <br>
          

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--main content end -->
<script type="text/javascript">
  var uploadField = document.getElementById("bukti_transaksi");
uploadField.onchange = function() {
    if(this.files[0].size > 500000){ // ini untuk ukuran 800KB, 1000000 untuk 1 MB.
       alert("Maaf. File Terlalu Besar ! Maksimal Upload 500 KB");
       this.value = "";
    };
};
    

    $(document).ready(function(){
$('#skenario_tdview').change(function(){
    $( function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
    // } );
    } );

    
    } );
});

  $(document).ready(function() {
    $('[data-toggle="popover"]').popover();
  });

     function cekTD(num){

        var step = document.getElementById("step"+num).value;
        console.log(step);
        var sum = 0;
        for (var i = 1; i <= step; i++) {

           var nilai = $('#nilaitd'+num+i).val();

           sum += +nilai;
         }
         console.log(sum);
         $('#td_total'+num).val(sum.toFixed(2));
        
          
    }

    function cekTotal(num){
        document.getElementById("update").style.backgroundColor = "#AA0000";
        $("#update").popover("show");
        var step = document.getElementById("step"+num).value;
        console.log(step);
        var sum = 0;
        for (var i = 1; i <= step; i++) {

           var nilai = $('#nilaitd'+num+i).val();

           sum += +nilai;
         }
         console.log(sum);
         $('#td_total'+num).val(sum.toFixed(2));
        
          
    }


    </script>
