 <?php
$id_user = $this->session->userdata('id_user');
$id_divisi = $this->session->userdata('id_divisi');

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
        <h3><i class="fa fa-angle-right"></i> Report Hasil Evaluasi Sosial Media</h3>
        <div class="row mt">
          <div class="col-lg-12">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Report Hasil Evaluasi Sosial Media </strong></h4>
                       
                        <div class="row">
                        <form action="" method="post">

                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="project_sos" id="project_sos" data-live-search="true">
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode_project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="skenario_sos" id="skenario_sos" data-live-search="true">
                                <option value=""> Pilih Skenario </option>
                                <?php foreach ($skenario as $sken) {
                                  ?>
                                  <option value="<?= $sken['kode'] ?>"><?= $sken['nama'] ?></option>
                                <?php } ?>
                                
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>

                        <div class="col-md-2">
                            <button type="submit" name="cek_td" id="cek_td" class="btn btn-round btn-primary pull-left" ><i class="fa fa-check-circle fa-fw"></i> Search </button>
                        </div>
                        
                  </div>
                  </form>
                  <br>
            <form action="<?php echo base_url('aktual/edittd') ?>" method="POST">
                <section id="dataTables_td_eb">
                    <?php 
                    if (isset($_POST['cek_td'])) :
                        $pro = $_POST['project_sos'];
                        $sken = $_POST['skenario_sos'];

                        $eval = $this->db->query("SELECT a.*, b.nama as nama_skenario, c.nama AS nama_bank
                                              FROM sosmed a 
                                              LEFT JOIN sosmed_skenario b ON a.skenario=b.kode
                                              LEFT JOIN bank c ON a.bank=c.kode
                                              WHERE a.project='$pro'
                                              AND a.skenario='$sken'
                                              AND status='3'
                                              -- GROUP BY a.transaksi
                                              ")->result_array();

                     $nama_project = $this->db->get_where('project', array('kode' => $pro))->row_array();
                     $skenario = $this->db->get_where('sosmed_skenario', array('kode' => $sken))->row_array();

                   ?>
                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#greeting">Info Kode Greeting</button>
                   <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#td">Info Kode TD & Respon Otomatis</button>


                   <div class="table-responsive">
                      <input type="hidden" name="nama_project" id="nama_project" value="<?php echo $nama_project['nama'] ?>">
                      <input type="hidden" name="kode_project" id="kode_project" value="<?php echo $pro ?>">
                      <input type="hidden" name="skenario_project" id="skenario_project" value="<?php echo $skenario['nama'] ?>">

                        <h4><b>Report Hasil Evalasi Sosial Media Untuk Project <?php echo $nama_project['nama']." ".$skenario['nama']; ?></b></h4>
                    <div class="row">
                      <!-- <div class="col-sm-6 text-left"><h5><strong>Last Download : <?php echo ($last['download_total']) ? $tgl_download : '-' ?></strong></h5></div> -->
                      <div class="col-sm-6 text-right"></div>
                    </div>
                        <table class="table table-bordered table-striped table-condensed table-hover table-responsive-sm" id="tables-hasilsosmed">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Bank</th>
                                <th>Platform</th>
                                <th>Username/Pagename Bank</th>
                                <th>Tanggal Evaluasi</th>

                                <th>Greeting Awal</th>
                                <th>Greeting Akhir<br> (Sebelum balas OK)</th>
                                <th>Greeting Akhir<br> (Setelah balas OK)</th>

                                <th>Waktu Pengiriman Pesan</th>
                                <th>Waktu Pesan Dibalas Oleh Staff</th>
                                <th>Aktual Time Delivery</th>
                                <th>Time Delivery</th>
                                <th>Respon Otomatis</th>
                                <th>Last Update</th>

                                <?php if($id_divisi == 1 OR $id_divisi == 99) { ?>
                                  <th>Aksi</th>
                                <?php } ?>


                              </tr>
                            </thead>
                            <tbody>
                              <?php $no=1;
                              foreach ($eval as $db) {
                                 ?>
                                 <tr>
                                   <td><?= $no++; ?></td>
                                   <td><?= $db['nama_bank']; ?></td>
                                   <td><?= $db['platform']; ?></td>
                                   <td><?= $db['sosmed_bank']; ?></td>
                                   <td><?= $db['tanggal_evaluasi']; ?></td>

                                   <?php
                                    $g_awal = unserialize($db['greeting_awal']); $num_awal = count($g_awal);
                                    $g_akhir = unserialize($db['greeting_akhir_before']); $num_akhir = count($g_akhir);
                                    $g_akhir_after = unserialize($db['greeting_akhir_after']); $num_after = count($g_akhir_after);


                                   ?>
                                   <td><?php
                                  for ($i=0; $i <$num_awal ; $i++) { 
                                    if ($g_awal[$i] == NULL OR $g_awal[$i] == '') {
                                      continue;
                                    }
                                      $kat = $this->db->get_where('sosmed_greeting', array('score' => $g_awal[$i]))->row_array();
                                      if ($kat == NULL) {
                                        echo $g_awal[$i]." ";
                                      } else {
                                        echo $kat['score']." ";
                                      }
                                   } ?></td>

                                   <td><?php
                                  for ($i=0; $i <$num_akhir ; $i++) { 
                                    if ($g_akhir[$i] == NULL OR $g_akhir[$i] == '') {
                                      continue;
                                    }
                                      $kat = $this->db->get_where('sosmed_greeting', array('score' => $g_akhir[$i]))->row_array();
                                      if ($kat == NULL) {
                                        echo $g_akhir[$i]." ";
                                      } else {
                                        echo $kat['score']." ";
                                      }
                                   } ?></td>
                                   
                                   <td><?php
                                  for ($i=0; $i <$num_after ; $i++) { 
                                    if ($g_akhir_after[$i] == NULL OR $g_akhir_after[$i] == '') {
                                      continue;
                                    }
                                      $kat = $this->db->get_where('sosmed_greeting', array('score' => $g_akhir_after[$i]))->row_array();
                                      if ($kat == NULL) {
                                        echo $g_akhir_after[$i]." ";
                                      } else {
                                        echo $kat['score']." ";
                                      }
                                   } ?></td>

                                   <td><?= $db['waktu_kirim']; ?></td>
                                   <td><?= $db['waktu_balas']; ?></td>
                                   <td><?= $db['aktual_td']; ?></td>
                                   <td><?= $db['total_td']; ?></td>
                                   <td><?= $db['respon_otomatis']; ?></td>
                                   <td><?php if($db['tgl_update'] != NULL){echo $db['tgl_update'];} else {echo "<center>-</center>";} ?></td>
                                  <?php if($id_divisi == 1 OR $id_divisi == 99) { ?>
                                    <td><a href="<?= base_url('aktual/edit_sosmedRA/'.$db['num']) ?>" target="_blank" class="btn btn-warning btn-xs btn-round">Edit</a></td>
                                  <?php } ?>

                                 </tr>

                              <?php } ?>
                              
                            </tbody>
                        </table>
                      </div>
                        

                    <?php
                    endif;
                    ?>
                
                </section>
                  </div>
              </div>
          </div>


                      
    </form>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

    <!-- Modal -->
<div class="modal fade" id="greeting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Informasi Kode Greeting</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php $greet = $this->db->order_by('urut', 'asc')->get('sosmed_greeting')->result_array(); ?>
       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th>Kode</th>
             <th>Keterangan</th>
           </tr>
         </thead>
         <tbody>
          <?php foreach ($greet as $row) {
           ?>
           <tr>
             <td><?= $row['score'] ?></td>
             <td><?= $row['greeting'] ?></td>
           </tr>
         <?php } ?>
         </tbody>
       </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>




    <!-- Modal -->
<div class="modal fade" id="td" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Informasi Time Delivery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
        <div class="table-responsive">
          <h5><b>Keterangan Kode Time Delivery</b></h5>
       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th>Kode</th>
             <th>Keterangan</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td>1</td>
             <td>Kurang dari 30 menit</td>
           </tr>
           <tr>
             <td>2</td>
             <td>31 menit - 1 jam</td>
           </tr>
           <tr>
             <td>3</td>
             <td>1 - 24 jam (respons diterima dalam hari yang sama)</td>
           </tr>
           <tr>
             <td>4</td>
             <td>H+1</td>
           </tr>
           <tr>
             <td>5</td>
             <td>H+2</td>
           </tr>
           <tr>
             <td>6</td>
             <td>H+3</td>
           </tr>
           <tr>
             <td>99</td>
             <td>Belum ada respons sama sekali hingga H+4</td>
           </tr>
           
         </tbody>
       </table>
     </div>
   </div>

   <div class="col-sm-6">
          <h5><b>Keterangan Kode Respon Otomatis</b></h5>
     <div class="table-responsive">
       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th>Kode</th>
             <th>Keterangan</th>
           </tr>
         </thead>
         <tbody>
           <tr>
             <td>1</td>
             <td>Ada</td>
           </tr>
           <tr>
             <td>2</td>
             <td>Tidak Ada</td>
           </tr>
           <tr>
             <td>99</td>
             <td>Time Delivery < 1 jam</td>
           </tr>
         </tbody>
       </table>
     </div>
   </div>
 </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>



    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>


    

    <script>
    

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
