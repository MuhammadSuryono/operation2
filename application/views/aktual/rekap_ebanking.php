    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Reporting Data E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

        <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>Reporting Data Skenario E-Banking </strong></h4>
                <!-- <a href="<?= base_url('time/index')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah</a> -->

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <div class="row">
                <div class="col-md-1"><h4><b>Pilih :</b></h4></div>
                          <div class="form-group">

                 <form action="" method="POST">
                  <div class="col-md-2 mb">
                   <select class="selectpicker form-control" name="project_rekap_sken" id="project_rekap_sken" data-live-search="true" required>
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode_project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>

                  <div class="col-md-2 mb">
                   <select class="selectpicker form-control" name="channel_rekap_sken" id="channel_rekap_sken" data-live-search="true" required>
                                <option value=""> Pilih Channel </option>
                                <option value="Internet Banking">Internet Banking</option>
                                <option value="Mobile Banking">Mobile Banking</option>
                                <option value="SMS Banking">SMS Banking</option>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-1">
                         <button type="submit" name="rekap_sken_ebanking" class="btn btn-round btn-primary pull-right" id="rekap_sken_ebanking"><i class="fas fa-eye"></i> Lihat </button>
                            <!-- <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Buat </button> -->
                        </div>
                    </form>


                </div>
                </div>
                <br>
                <section id="dataTables_rekap">
                    <?php
                        if (isset($_POST['rekap_sken_ebanking'])) {
                             $project = $_POST['project_rekap_sken'];
                             $channel = $_POST['channel_rekap_sken'];

                            $nama_project = $this->db->query("SELECT * FROM project WHERE kode='$project'")->row_array();

                             $bank = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                                        FROM ebanking a 
                                                        LEFT JOIN bank b ON a.bank=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        GROUP BY a.bank
                                                        ")->result_array();

                             $transaksi = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        GROUP BY a.transaksi
                                                        ")->result_array();

                    ?>
                    <div class="table-responsive">
                      <h4>Report Data Skenario E-Banking Project <strong><?php echo $nama_project['nama']; ?></strong> Channel <strong><?php echo $channel; ?></strong></h4>
                      <br>
                        <table class="table table-bordered table-condensed table-hover table-responsive-sm" >
                            <thead>
                                <tr style="background-color: #FFC0CB;">
                                    <th><center></center></th>
                                    <?php
                                    foreach ($transaksi as $trx) { ?>
                                    <th><center><?php echo $trx['nama_transaksi']; ?></center></th>
                                     <?php } ?>
                                     
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($bank as $bnk) : ?>
                                    <tr>
                                      <th style="background-color: #FAEBD7;"><?php echo $bnk['nama_bank']; ?></th>
                                      <?php foreach ($transaksi as $trx) {
                                        $count_bank = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' AND transaksi='$trx[transaksi]'")->num_rows(); ?>
                                      <th style="background-color: #FAEBD7;"><center><?php echo $count_bank; ?></center></th>
                                      <?php } ?>
                                    </tr>
                                    <?php $provider = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' GROUP BY provider")->result_array();
                                    foreach ($provider as $prov) {
                                      ?>
                                    <tr>
                                      <th><center><?php echo $prov['provider']; ?></center></th>
                                      <?php foreach ($transaksi as $trx) {
                                        $count_prov = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' AND transaksi='$trx[transaksi]' AND provider='$prov[provider]'")->num_rows(); ?>
                                      <td><center><?php echo $count_prov; ?></center></td>
                                      <?php } ?>
                                    </tr>

                                     <?php 
                                     }
                                    endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                         } 
                    ?>

                </section>
            </div>
           </div>
           </div>


           <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i>Reporting Data Aktual E-Banking </strong></h4>
                <!-- <a href="<?= base_url('time/index')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah</a> -->

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                
                <br>
                <section id="dataTables_rekap">
                    <?php
                        if (isset($_POST['rekap_sken_ebanking'])) {
                             $project = $_POST['project_rekap_sken'];
                             $channel = $_POST['channel_rekap_sken'];

                            $nama_project = $this->db->query("SELECT * FROM project WHERE kode='$project'")->row_array();

                             $bank = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                                        FROM ebanking a 
                                                        LEFT JOIN bank b ON a.bank=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        GROUP BY a.bank
                                                        ")->result_array();

                             $transaksi = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        GROUP BY a.transaksi
                                                        ")->result_array();

                    ?>
                    <div>
                      <h4>Report Data Aktual E-Banking Project <strong><?php echo $nama_project['nama']; ?></strong> Channel <strong><?php echo $channel; ?></strong></h4>
                      <br>
                      <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-hover table-responsive-sm" >
                            <thead>
                                <tr style="background-color: #FFC0CB;">
                                    <th rowspan="3"><center></center></th>
                                    <?php
                                    foreach ($transaksi as $trx) { 
                                      $hari = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        GROUP BY a.hari, a.waktu
                                                        ");
                                      $num_col = $hari->num_rows();
                                     
                                      ?>
                                    <th colspan="<?php echo $num_col ?>"><center><?php echo $trx['nama_transaksi']; ?></center></th>
                                     <?php } ?>
                                 <th rowspan="3" style="vertical-align : middle;text-align:center;">TARGET</th>
                                 <th rowspan="3" style="vertical-align : middle;text-align:center;">TOTAL<br> DONE</th>
                                 <th rowspan="3" style="vertical-align : middle;text-align:center;">SISA</th>
                                 <th rowspan="3" style="vertical-align : middle;text-align:center;">PERSENTASE</th>

                                  
                                     
                                </tr>
                                <tr style="background-color: #FFC0CB;">
                               
                                <?php foreach ($transaksi as $trx) { 
                                      $hari = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        GROUP BY a.hari
                                                        ");
                                      $num_day = $hari->num_rows();
                                      $day = $hari->result_array();
                                      foreach ($day as $d) {
                                        $waktu = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        AND a.hari = '$d[hari]'
                                                        GROUP BY a.waktu
                                                        ORDER BY a.num
                                                        ");
                                      $num_time = $waktu->num_rows();
                                      $time = $waktu->result_array();
                                        
                                      ?>
                                      <th colspan="<?php echo $num_time ?>" ><center><?php echo $d['hari']; ?></center></th>
                                    <?php }
                                  } ?>
                                                                  
                                </tr>
                                <tr style="background-color: #FFC0CB;">
                              
                                <?php foreach ($transaksi as $trx) { 
                                      $hari = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        GROUP BY a.hari
                                                        ");
                                      $num_day = $hari->num_rows();
                                      $day = $hari->result_array();
                                      foreach ($day as $d) {
                                        $waktu = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        AND a.hari = '$d[hari]'
                                                        GROUP BY a.waktu
                                                        ORDER BY a.num
                                                        ");
                                      $num_time = $waktu->num_rows();
                                      $time = $waktu->result_array();
                                      foreach ($time as $t) {
                                        
                                      ?>
                                      <th><center><?php echo substr($t['waktu'], 0, 1); ?></center></th>
                                    <?php }
                                    }
                                  } ?>
                                                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($bank as $bnk) :
                                    if ($channel != 'Internet Banking') {
                                        $cek_prov = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' GROUP BY provider, os ORDER BY os, provider");
                                    } else {
                                        $cek_prov = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' GROUP BY provider");
                                    }
                                        $target = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]'")->num_rows();
                                        $done = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' AND status != 0")->num_rows();
                                        $sisa = $target - $done;
                                        $persentase = ($done/$target)*100;

                                        $provider = $cek_prov->result_array();
                                        $baris_prov = $cek_prov->num_rows(); ?>
                                    <tr>
                                      <th style="background-color: #FAEBD7;"><?php echo $bnk['nama_bank']; ?></th>
                                      <?php foreach ($transaksi as $trx) {

                                        $hari = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        GROUP BY a.hari
                                                        ");
                                      $num_day = $hari->num_rows();
                                      $day = $hari->result_array();
                                      foreach ($day as $d) {
                                        $waktu = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        AND a.hari = '$d[hari]'
                                                        GROUP BY a.waktu
                                                        ORDER BY a.num
                                                        ");
                                      $num_time = $waktu->num_rows();
                                      $time = $waktu->result_array();
                                      foreach ($time as $t) {
                                        $count_bank = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' AND transaksi='$trx[transaksi]' AND hari='$d[hari]' AND waktu='$t[waktu]' AND status!='0'")->num_rows(); ?>
                                      <th style="background-color: #FAEBD7;"><center><?php echo $count_bank; ?></center></th>
                                      <?php }
                                        }
                                      } ?>
                                    <th rowspan="<?php echo $baris_prov+1 ?>" style="vertical-align : middle;text-align:center;"><?php echo $target; ?></th>
                                    <th rowspan="<?php echo $baris_prov+1 ?>" style="vertical-align : middle;text-align:center;"><?php echo $done; ?></th>
                                    <th rowspan="<?php echo $baris_prov+1 ?>" style="vertical-align : middle;text-align:center;"><?php echo $sisa; ?></th>
                                    <th rowspan="<?php echo $baris_prov+1 ?>" style="vertical-align : middle;text-align:center;"><?php echo number_format($persentase, 1)."%"; ?></th>
                                    
                                    
                                    </tr>
                                    <?php
                                    foreach ($provider as $prov) {
                                      ?>
                                    <tr> 
                                    <?php if ($channel == 'Mobile Banking') { ?>
                                      <th><center><?php echo $prov['provider']." / ".$prov['os']; ?></center></th>
                                    <?php } else if ($channel == 'SMS Banking') {
                                      $pecah = explode(" ", $prov['os']); ?>
                                      <th><center><?php echo $prov['provider']." / ".$pecah[2]; ?></center></th>
                                    <?php } else { ?>
                                      <th><center><?php echo $prov['provider']; ?></center></th>
                                    <?php } ?>
                                      <?php foreach ($transaksi as $trx) {

                                        $hari = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        GROUP BY a.hari
                                                        ");
                                      $num_day = $hari->num_rows();
                                      $day = $hari->result_array();
                                      foreach ($day as $d) {
                                        $waktu = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        AND a.hari = '$d[hari]'
                                                        GROUP BY a.waktu
                                                        ORDER BY a.num
                                                        ");
                                      $num_time = $waktu->num_rows();
                                      $time = $waktu->result_array();
                                      foreach ($time as $t) {
                                       if ($channel != 'Internet Banking') {
                                        $count_prov = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' AND transaksi='$trx[transaksi]' AND hari='$d[hari]' AND waktu='$t[waktu]' AND provider='$prov[provider]' AND os='$prov[os]' AND status!='0'")->num_rows();

                                        $sesuai = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' AND transaksi='$trx[transaksi]' AND hari='$d[hari]' AND waktu='$t[waktu]' AND provider='$prov[provider]' AND os='$prov[os]'")->num_rows();
                                       } else {
                                        $count_prov = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' AND transaksi='$trx[transaksi]' AND hari='$d[hari]' AND waktu='$t[waktu]' AND provider='$prov[provider]' AND status!='0'")->num_rows();

                                        $sesuai = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND bank='$bnk[bank]' AND transaksi='$trx[transaksi]' AND hari='$d[hari]' AND waktu='$t[waktu]' AND provider='$prov[provider]'")->num_rows();                                        
                                        }

                                      if ($count_prov == $sesuai AND $count_prov != 0) { ?>
                                              <td style="background-color: #7FFFD4;"><center><?php echo $count_prov; ?></center></td>
                                       <?php } else if ($count_prov > 0 AND $count_prov < $sesuai) { ?>
                                              <td style="background-color: #FFFF66;"><center><?php echo $count_prov; ?></center></td>
                                       <?php } else if ($sesuai == 0) { ?>
                                              <td style=" background-color: #000000;"><center></center></td>
                                       <?php } else { ?>
                                              <td><center><?php echo $count_prov; ?></center></td>
                                      <?php }


                                       }
                                      }
                                    } ?>
                                    </tr>

                                     <?php 
                                     }
                                    endforeach; ?>
                                    <tr style="background-color: #D8BFD8;">
                                      <th>TOTAL</th>
                                      <?php
                                    foreach ($transaksi as $trx) { 
                                      $hari = $this->db->query("SELECT a.*, b.nama AS nama_transaksi 
                                                        FROM ebanking a 
                                                        LEFT JOIN attribute_ebanking b ON a.transaksi=b.kode
                                                        WHERE a.project='$project'
                                                        AND a.channel='$channel'
                                                        AND a.transaksi='$trx[transaksi]'
                                                        GROUP BY a.hari, a.waktu
                                                        ");
                                      $num_col = $hari->num_rows();
                                     
                                      ?>
                                    <th colspan="<?php echo $num_col ?>"><center></center></th>
                                     <?php }
                                        $target_total = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' ")->num_rows();
                                        $done_total = $this->db->query("SELECT * FROM ebanking WHERE project='$project' AND channel='$channel' AND  status != 0")->num_rows();
                                        $sisa_total = $target_total - $done_total; 

                                        $persentase_total =($target_total != 0)?($done_total/$target_total)*100:0; ?>
                                       <th style="vertical-align : middle;text-align:center;"><?php echo $target_total; ?></th>
                                       <th style="vertical-align : middle;text-align:center;"><?php echo $done_total; ?></th>
                                       <th style="vertical-align : middle;text-align:center;"><?php echo $sisa_total; ?></th>
                                       <th style="vertical-align : middle;text-align:center;"><?php echo number_format($persentase_total, 1)."%"; ?></th>
                                       
                                    </tr>
                            </tbody>
                        </table>
                      </div>
                        <p ><strong>Note : </strong>
                        <br> - Jika berwarna <i class="fa fa-square fa-2x" style="color: #7FFFD4;"></i> artinya jumlah sudah sesuai dengan target pengulangan yang ada di skenario
                        <br> - Jika berwarna <i class="fa fa-square fa-2x" style="color: #FFFF66;"></i> artinya sudah berprogress namun belum mencapai target pengulangan yang ada di skenario
                        <br> - Jika berwarna <i class="fa fa-square fa-2x" style="color: #000000;"></i> artinya jenis transaksi/hari/waktu untuk bank tersebut belum/tidak di daftarkan di skenario
                      </p>
                    </div>
                    <?php
                         } 
                    ?>

                </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

    <!-- Modal -->
    <?php
    if (isset($_POST['rekap_td'])) {
    $no=0;
     foreach ($query as $row) { $no++;

    $get = $this->db->get_where('ebanking_data_td', array('id' => $row['id'] ))->row_array();

    $get_view = $this->db->get_where('ebanking_data_td', array('project' => $get['project'], 'bank' => $get['bank'], 'channel' => $get['channel'], 'transaksi' => $get['transaksi'], 'os' => $get['os'], 'jenis' => $get['jenis']))->result_array();
?>
<div class="modal fade" id="view_rekap<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">View Step TD E-Banking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th><center>Step</center></th>
              <th><center>Label</center></th>
              <th><center>Versi</center></th>
              
            </tr>
          </thead>
          <tbody>
            <?php foreach ($get_view as $view) {
              ?>
              <tr>
                  <td><center><?php echo $view['step']; ?></center></td>
                  <td><?php echo $view['label']; ?></td>
                  <td><center><?php echo $view['versi']; ?></center></td>
              </tr>
          <?php } 
          ?>
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
<?php
}
 } ?>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

    $(document).ready(function(){
$('#skenario_tdview').change(function(){
    $( function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
    // } );
    } );
    } );
    </script>
