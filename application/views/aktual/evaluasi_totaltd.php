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
        <h3><i class="fa fa-angle-right"></i> Report Total TD E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Report Total TD E-Banking </strong></h4>
                       
                        <div class="row">
                        <form action="" method="post">

                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="project_eb" id="project_eb" data-live-search="true">
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode_project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="channel_eb" id="channel_eb" data-live-search="true">
                                <option value=""> Pilih Channel </option>
                                <option value="Internet Banking"> Internet Banking </option>
                                <option value="Mobile Banking"> Mobile Banking </option>
                                <option value="SMS Banking"> SMS Banking </option>
                                
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
                        $pro = $_POST['project_eb'];
                        $channel = $_POST['channel_eb'];
                       
                    $trx = $this->db->query("SELECT a.*, b.nama as nama_transaksi
                                              FROM ebanking a 
                                              LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                              WHERE a.project='$pro'
                                              AND a.channel='$channel'
                                              GROUP BY a.transaksi
                                              ")->result_array();
                  if ($channel != 'Internet Banking') {
                    $baris = $this->db->query("SELECT a.*, c.nama as nama_bank, b.nama as nama_transaksi
                                              FROM ebanking a 
                                              LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                              LEFT JOIN bank c ON a.bank=c.kode
                                              WHERE a.project='$pro'
                                              AND a.channel='$channel'
                                               GROUP BY a.bank, a.hari, a.waktu, a.trx_ke, a.provider, a.os
                                               ORDER BY nama_bank, a.os, a.provider, a.hari, a.num
                                              ")->result_array();
                  } else {
                    $baris = $this->db->query("SELECT a.*, c.nama as nama_bank, b.nama as nama_transaksi
                                              FROM ebanking a 
                                              LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                              LEFT JOIN bank c ON a.bank=c.kode
                                              WHERE a.project='$pro'
                                              AND a.channel='$channel'
                                               GROUP BY a.bank, a.hari, a.waktu, a.trx_ke, a.provider
                                               ORDER BY nama_bank, a.provider, a.hari, a.num
                                              ")->result_array();
                  }

                     $nama_project = $this->db->get_where('project', array('kode' => $pro))->row_array();
                     $last = $this->db->get_where('ebanking', array('project' => $pro, 'channel' => $channel))->row_array();

                     
                     $tgl_download = date("d/m/Y, H:i",strtotime($last['download_total']));
                    
                        // var_dump($td);
                    ?>
                    
                    
                    <!-- <input type="submit" name="submit" value="Export To Excel" class="btn btn-success"> -->
                    <div class="table-responsive">
                      <input type="hidden" name="nama_project" id="nama_project" value="<?php echo $nama_project['nama'] ?>">
                      <input type="hidden" name="kode_project" id="kode_project" value="<?php echo $pro ?>">
                      <input type="hidden" name="channel_project" id="channel_project" value="<?php echo $channel ?>">

                        <h4><b>Report Total TD E-Banking Untuk Project <?php echo $nama_project['nama']." Channel ".$channel; ?></b></h4>
                    <div class="row">
                      <div class="col-sm-6 text-left"><h5><strong>Last Download : <?php echo ($last['download_total']) ? $tgl_download : '-' ?></strong></h5></div>
                      <div class="col-sm-6 text-right"></div>
                    </div>
                        <table class="table table-bordered table-striped table-condensed table-hover table-responsive-sm" id="tables-reporttotal">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Bank</center></th>
                                    <!-- <th><center>Hari / Waktu / Pengulangan</center></th> -->
                                    <th><center>Tipe</center></th>
                                    <th><center>Provider</center></th>
                                    
                                    <?php
                                    foreach ($trx as $tr) { ?>
                                      <th style="background-color: #48D1CC; color: white;"><center><?php echo $tr['nama_transaksi']; ?></center></th>   
                                      <th style="background-color:  #87CEFA; color: white;"><center>Keberhasilan <?php echo $tr['nama_transaksi']; ?> ke</center></th>
                                     <?php } ?>
                                    
                                    <th ><center>Last Update</center></th>
                                     
                                </tr>
                            </thead>
                            <tbody>
                              <?php $no=1; 
                              foreach ($baris as $br) {
                                ?>
                              <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $br['nama_bank']; ?></td>
                                <!-- <td><?php echo $br['hari']." / ".$br['waktu']." / ".$br['trx_ke']; ?></td> -->
                              <?php if ($channel == 'Internet Banking') {
                                        if ($br['provider'] == 'Telkomsel' OR $br['provider'] == 'Indosat' OR $br['provider'] == 'Smartfren' OR $br['provider'] == 'XL') { ?>
                                <td>Wireless</td> 
                                        <?php } else if ($br['provider'] == 'Indihome' OR $br['provider'] == 'Firstmedia') { ?>
                                <td>Wired</td>
                              <?php
                                }
                              } else { ?>
                                <td><?php echo $br['os']; ?></td>
                              <?php } ?> 
                                <td><?php echo $br['provider']; ?></td>
                            <?php foreach ($trx as $tr) {
                               if ($channel != 'Internet Banking') {
                                    $td = $this->db->query("SELECT * FROM ebanking WHERE project='$br[project]' AND bank='$br[bank]' AND channel='$br[channel]' AND provider='$br[provider]' AND os='$br[os]' AND hari='$br[hari]' AND waktu='$br[waktu]' AND trx_ke='$br[trx_ke]' AND transaksi='$tr[transaksi]'")->row_array();
                              } else {
                                    $td = $this->db->query("SELECT * FROM ebanking WHERE project='$br[project]' AND bank='$br[bank]' AND channel='$br[channel]' AND provider='$br[provider]' AND hari='$br[hari]' AND waktu='$br[waktu]' AND trx_ke='$br[trx_ke]' AND transaksi='$tr[transaksi]'")->row_array();
                              }
                             ?>
                                <td><?php echo ($td['total_td']) ? $td['total_td'] : '-' ?></td>
                                <td><?php echo ($td['percobaan']) ? $td['percobaan'] : '-' ?></td>   

                            <?php }
                            if ($channel != 'Internet Banking') {
                                $max = $this->db->query("SELECT max(last_update) as max_last FROM ebanking WHERE project='$br[project]' AND bank='$br[bank]' AND channel='$br[channel]' AND provider='$br[provider]' AND os='$br[os]' AND hari='$br[hari]' AND waktu='$br[waktu]' AND trx_ke='$br[trx_ke]'")->row_array();
                            } else {
                                $max = $this->db->query("SELECT max(last_update) as max_last FROM ebanking WHERE project='$br[project]' AND bank='$br[bank]' AND channel='$br[channel]' AND provider='$br[provider]' AND hari='$br[hari]' AND waktu='$br[waktu]' AND trx_ke='$br[trx_ke]'")->row_array(); 
                              } ?>

                                <td><?php echo ($max['max_last']) ? date("d/m/Y",strtotime($max['max_last'])) : ' ' ?></td>
                              </tr>
                            <?php } ?>
                            </tbody>
                        </table>
 

                        

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
