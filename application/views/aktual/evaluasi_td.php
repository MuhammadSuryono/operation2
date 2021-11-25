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
        <h3><i class="fa fa-angle-right"></i> Evaluasi TD E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Evaluasi TD E-Banking </strong></h4>
                          <a href="<?php echo base_url('aktual/data_totaltd') ?>" class="btn btn-warning mb-2">Report Total TD E-Banking</a>
                        

                        <div class="row" style="margin-top: 20px;">
                        <form action="" method="post">

                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="project_eb" id="project_eb" data-live-search="true" required>
                                <option value=""> Pilih Project </option>
                                <?php foreach($project as $sk) :?>
                                <option value="<?=$sk['kode_project']?>"> <?=$sk['nama_project']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="bank_eb" id="bank_eb" data-live-search="true">
                                <option value=""> Pilih Bank </option>
                                <?php foreach($bank as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
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
                         <div class="col-md-2 mb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <select class="selectpicker form-control" name="transaksi_eb" id="transaksi_eb" data-live-search="true">
                                <option value=""> Pilih Transaksi </option>
                                <?php foreach($transaksi as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select>
                        <!-- AKHIR SELECT -->
                        </div>



                        <div class="col-md-2 mb" id="os_eb">
                        <!-- SELECT INI DAPAT DIGUNAKAN -->
                            <!-- <select class="form-control" name="project" id="project" >
                                <option value=""> Pilih Skenario </option>
                                <?php foreach($attribute as $sk) :?>
                                <option value="<?=$sk['kode']?>"> <?=$sk['nama']?> </option>
                                <?php endforeach?>
                            </select> -->
                        <!-- AKHIR SELECT -->
                        </div>
                        <div class="col-md-2 mb" id="versi_eb_div">
                        </div>

                        <div class="col-md-6">
                            <button type="submit" name="cek_td" class="btn btn-round btn-primary pull-left" ><i class="fa fa-check-circle fa-fw"></i> Search </button>
                        </div>
                        
                  </div>
                  </form>
                  <br>
            <form action="<?php echo base_url('aktual/edittd') ?>" method="POST">
                <section id="dataTables_td_eb">
                    <?php 
                    if (isset($_POST['cek_td'])) :
                        $pro = $_POST['project_eb'];
                        $bank = $_POST['bank_eb'];
                        $channel = $_POST['channel_eb'];
                        $transaksi = $_POST['transaksi_eb'];
                        if (isset($_POST['os_eb']) AND $_POST['os_eb'] != NULL) {

                            if ($channel == 'SMS Banking') {
                                $os = $_POST['os_eb'];
                                $jenis = '';
                            } else {
                                $get = $this->input->post('os_eb');
                                
                                if($get != NULL) {
                                $split = explode("_", $get);

                                $os = $split[0];
                                $jenis = $split[1];
                                }
                            }
                        }
                        if (isset($_POST['versi_eb'])) {
                            $versi = $_POST['versi_eb'];
                        }

                        if (isset($_POST['os_eb']) AND $_POST['os_eb'] != NULL) {
                            $jenis_mb = $channel." ".$jenis;
                        }

                        if (isset($_POST['os_eb']) AND $_POST['os_eb'] != NULL) {
                        $data = [
                                // 'project' => $pro,
                                'bank' => $bank,
                                'channel' => $channel,
                                'transaksi' => $transaksi,
                                'os' => $os,
                                'jenis' => $jenis,
                                'versi' => $versi
                                // 'status !=' => 0
                                ];
                            }
                        // var_dump($data);
                    if ($bank == NULL OR $channel == NULL OR $transaksi == NULL) {
                        // $td = $this->db->order_by('step', 'ASC')->get_where('ebanking_data_td', $data)->result_array();                       

                        $this->db->select('a.*, b.nama AS nama_bank, c.nama AS nama_transaksi, d.nama AS nama_project, f.nama AS shopper');
                                $this->db->from('ebanking a');
                                $this->db->join('bank b', 'a.bank=b.kode', 'left');
                                $this->db->join('attribute_ebanking c', 'a.transaksi=c.kode', 'left');
                                $this->db->join('project d', 'a.project=d.kode', 'left');
                                $this->db->join('ebanking_shopper f', 'a.nama_shopper=f.id', 'left');

                                $this->db->where('a.project', $pro);
                            if ($bank != '') {
                                $this->db->where('a.bank', $bank);
                            }
                            if ($channel != '') {
                                $this->db->where('a.channel', $channel);
                            }
                            if ($transaksi != '') {
                                $this->db->where('a.transaksi', $transaksi);
                            }
                                $this->db->where('a.status !=', 0);
                             

                                $aktual = $this->db->get()->result_array(); ?>
                    
                    <input type="hidden" name="project_eb" id="project_eb" value="<?php echo $pro ?>">
                    <input type="hidden" name="bank_eb" id="bank_eb" value="<?php echo $bank ?>">
                    
                    <input type="hidden" name="channel_eb" id="channel_eb_val" value="<?php echo $channel ?>">
                    <input type="hidden" name="transaksi_eb" id="transaksi_eb" value="<?php echo $transaksi ?>">

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="tables-evaluasitd">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Project</center></th>
                                    <th><center>Bank</center></th>
                                    <th><center>Channel</center></th>
                                    <th><center>Transaksi</center></th>
                                    <th><center>System</center></th>
                                    <th><center>Provider</center></th>
                                    <th><center>Jenis</center></th>
                                     <th><center>Total TD</center></th>
                                     <th><center>Berhasil Pada Percobaan ke-</center></th>
                                    <?php if($user['id_divisi'] == 1 OR $user['id_divisi'] == 99) { ?>
                                     <!-- <th><center>Aksi</center></th> -->
                                 <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                $jumlah_td = 0;
                                 foreach ($aktual as $row) { ?>
                                    <tr>
                                   <td><?php echo $no++; ?></td>
                                   <td><?php echo $row['nama_project']; ?></td>
                                   <td><?php echo $row['nama_bank']; ?></td>
                                   <td><?php echo $row['channel']; ?></td>
                                   <td><?php echo $row['nama_transaksi']; ?></td>
                                   <td><?php echo $row['os']; ?></td>
                                   <td><?php echo $row['provider']; ?></td>
                                   
                                    <td><?php echo $row['jenis']; ?></td>
                                    <td><?php echo $row['total_td']; ?></td>
                                    <td><?php echo $row['percobaan']; ?></td>

                                    
                                <!-- <?php if($user['id_divisi'] == 1 OR $user['id_divisi'] == 99) { ?>
                                    <td><center><button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#edittd<?php echo $row['num'] ?>">
                                         <i class="fas fa-edit"></i>  Edit
                                        </button></center>
                                    </td>
                                <?php } ?> -->
                                     
                                </tr>

                            <?php
                            $jumlah_td += $row['total_td'];
                             }
                             $jumlah_data = count($aktual);
                             if ($jumlah_data != 0) {
                                 
                             $avg = $jumlah_td / $jumlah_data;
                            } else {
                                $avg = 0;
                            }
                              ?>
                            </tbody>
                        </table>
                    </div>

                    <table width="20%">
                            <tr>
                                <td><h5><b>Jumlah Data </b></h5></td>
                                <td><h5><b> : </b></h5></td>
                                <td><h5><b> <?php echo $jumlah_data; ?></b></h5></td>
                            </tr>
                            <tr>
                                <td><h5><b>Jumlah TD </b></h5></td>
                                <td><h5><b> : </b></h5></td>
                                <td><h5><b> <?php echo $jumlah_td; ?></b></h5></td>
                            </tr>
                            <tr>
                                <td><h5><b>Rata-Rata TD </b></h5></td>
                                <td><h5><b> : </b></h5></td>
                                <td><h5><b> <?php echo round($avg, 2); ?></b></h5></td>
                            </tr>
                        </table>
                    

                    <?php
                    } else {

                    if ($channel == 'Internet Banking') {
                        $query = $this->db->query("SELECT a.*, e.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project 
                                                    FROM `ebanking` a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    JOIN ebanking_td e ON a.num=e.num_eb
                                                    WHERE a.project='$pro' AND a.bank='$bank' AND a.channel='$channel' AND a.transaksi='$transaksi'
                                                     -- AND os IS NULL
                                                      AND jenis='$jenis' AND a.versi_label='$versi' AND a.status != 0");
                        
                        $aktual = $query->result_array();
                        $update = $query->row_array();
                    } else if ($channel == 'Mobile Banking'){
                        $query = $this->db->query("SELECT a.*, e.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project 
                                                    FROM `ebanking` a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    JOIN ebanking_td e ON a.num=e.num_eb
                                                    WHERE a.project='$pro' AND a.bank='$bank' AND a.channel='$channel' AND a.transaksi='$transaksi' AND os='$os' AND jenis='$jenis' AND a.versi_label='$versi' AND a.status != 0");
                       
                        $aktual = $query->result_array();
                        $update = $query->row_array();
                    } if ($channel == 'SMS Banking') {
                        $query = $this->db->query("SELECT a.*, e.*,
                                                    b.nama AS nama_bank,
                                                    c.nama AS nama_transaksi,
                                                    d.nama AS nama_project 
                                                    FROM `ebanking` a
                                                    LEFT JOIN bank b ON a.bank=b.kode
                                                    LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                                    LEFT JOIN project d ON a.project=d.kode
                                                    JOIN ebanking_td e ON a.num=e.num_eb
                                                    WHERE a.project='$pro' AND a.bank='$bank' AND a.channel='$channel' AND a.transaksi='$transaksi'
                                                     AND os='$os' 
                                                     AND jenis='$os' AND a.versi_label='$versi' AND a.status != 0");
                        
                        $aktual = $query->result_array();
                        $update = $query->row_array();
                    } 

                    $td = $this->db->order_by('step', 'ASC')->get_where('ebanking_data_td', $data)->result_array();                       

                    $tgl_update = date("d/m/Y, H:i",strtotime($update['last_update']));
                    $tgl_download = date("d/m/Y, H:i",strtotime($update['download_label']));
                    
                        // var_dump($td);
                    ?>
                    <input type="hidden" name="project_eb" id="project_eb" value="<?php echo $pro ?>">
                    <input type="hidden" name="bank_eb" id="bank_eb" value="<?php echo $bank ?>">
                    
                    <input type="hidden" name="channel_eb" id="channel_eb_val" value="<?php echo $channel ?>">
                    <input type="hidden" name="transaksi_eb" id="transaksi_eb" value="<?php echo $transaksi ?>">
                    <input type="hidden" name="os_eb" id="os_eb" value="<?php echo $os ?>">
                    <input type="hidden" name="jenis_eb" id="jenis_eb" value="<?php echo $jenis ?>">
                    <input type="hidden" name="jenis_mb" id="jenis_mb" value="<?php echo $jenis_mb ?>">
                    <input type="hidden" name="versi_eb" id="versi_eb" value="<?php echo $versi ?>">

                    
                    
                    <!-- <input type="submit" name="submit" value="Export To Excel" class="btn btn-success"> -->
                    <div class="row">
                      <div class="col-sm-6 text-left"><h5><strong>Last Download : <?php echo ($update['download_label']) ? $tgl_download : '-' ?></strong></h5></div>
                      <div class="col-sm-6 text-right"><h5><strong>Last Update : <?php echo ($update['last_update']) ? $tgl_update : '-' ?></strong></h5></div>
                    </div>
                    <div class="table-responsive">

                        <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="tables-evaluasitd">
                            <thead>
                                <tr>
                                    <th><center>No</center></th>
                                    <th><center>Project</center></th>
                                    <th><center>Bank</center></th>
                                    <th><center>Channel</center></th>
                                    <th><center>Transaksi</center></th>
                                    <th><center>System</center></th>
                                    <th><center>Provider</center></th>
                                    <th><center>Jenis</center></th>
                                    <?php
                                    foreach ($td as $col) { ?>
                                      <th style="background-color: #ADFF2F;"><center><?php echo $col['label']; ?></center></th>   
                                     <?php } ?>
                                     <th><center>Total TD</center></th>
                                     <th><center>Berhasil Pada Percobaan ke-</center></th>

                                    <?php if($user['id_divisi'] == 1 OR $user['id_divisi'] == 99) { ?>
                                     <th><center>Aksi</center></th>
                                 <?php } ?>
                                     
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no=1;
                                $jumlah_td = 0;
                                 foreach ($aktual as $row) {
                                    $detail = $this->db->get_where('ebanking_td', array('num_eb' => $row['num']))->row_array();
                                  ?>
                                <tr>
                                   <td><?php echo $no++; ?></td>
                                   <td><?php echo $row['nama_project']; ?></td>
                                   <td><?php echo $row['nama_bank']; ?></td>
                                   <td><?php echo $row['channel']; ?></td>
                                   <td><?php echo $row['nama_transaksi']; ?></td>
                                   <td><?php echo $row['os']; ?></td>
                                   <td><?php echo $row['provider']; ?></td>
                                   
                                    <td><?php echo $row['jenis']; ?></td>
                                    <?php

                                    foreach ($td as $col) {

                                    $step = $col['step']; ?>
                                      <td><?php echo $row['step'.$step]; ?></td>


                                     <?php
                                     
                                      }
                                       ?> 
                                    <td><?php echo $row['total_td']; ?></td>
                                    <td><?php echo $row['percobaan']; ?></td>

                                    
                                <?php if($user['id_divisi'] == 1 OR $user['id_divisi'] == 99) { ?>
                                    <td><center><button type="button" class="btn btn-primary btn-round" data-toggle="modal" data-target="#edittd<?php echo $row['num'] ?>">
                                         <i class="fas fa-edit"></i>  Edit
                                        </button></center>
                                    </td>
                                <?php } ?>
                                     
                                </tr>
                            <?php
                            $jumlah_td += $row['total_td'];
                             }
                             $jumlah_data = count($aktual);
                             if ($jumlah_data != 0) {
                                 
                             $avg = $jumlah_td / $jumlah_data;
                            } else {
                                $avg = 0;
                            }
                              ?>

                               <tr style="background-color: #D8BFD8; font-weight: bold;">
                                  <td colspan="8"><center>MAX</center></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>

                                  <?php
                                    foreach ($td as $col) {
                                      $step = $col['step'];
                                    if ($aktual != NULL) {
                                    
                                    ?>
                                    <td><?php echo max(array_column($aktual, 'step'.$step)) ?></td>
                                <?php } else { ?>
                                    <td></td>
                                   <?php
                                     } 
                                  } 
                                    
                                    if ($aktual != NULL) {
                                      ?>
                                    <td><?php echo max(array_column($aktual, 'total_td')) ?></td>
                                  <?php } else { ?>
                                    <td></td>
                                  <?php } 
                                   if($user['id_divisi'] == 1 OR $user['id_divisi'] == 99) { ?>
                                    <td></td>
                                <?php } ?>
                                    <td></td>
                                
                              </tr>
                               <tr style="background-color: #F5DEB3;  font-weight: bold;">
                                  <td colspan="8"><center>MIN</center></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>

                                  <?php
                                    foreach ($td as $col) {
                                      $step = $col['step'];
                                    if ($aktual != NULL) {
                                    ?>
                                    <td><?php echo min(array_column($aktual, 'step'.$step)) ?></td>
                               <?php } else { ?>
                                    <td></td>
                                  <?php
                                    } 
                                  } 
                                    
                                    if ($aktual != NULL) {
                                      ?>
                                    <td><?php echo min(array_column($aktual, 'total_td')) ?></td>
                                  <?php } else { ?>
                                    <td></td>
                                  <?php } 
                                   if($user['id_divisi'] == 1 OR $user['id_divisi'] == 99) { ?>
                                    <td></td>
                                <?php } ?>
                                    <td></td>

                              </tr>

                              <tr style="background-color: #FAF0E6;  font-weight: bold;">
                                  <td colspan="8"><center>AVERAGE</center></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>
                                  <td style="display: none;"></td>

                                  <?php
                                    foreach ($td as $col) {
                                      $step = $col['step'];
                                    if ($aktual != NULL) {
                                    ?>
                                    <td><?php echo round(array_sum(array_column($aktual, 'step'.$step)) / count($aktual), 2) ?></td>
                                <?php } else { ?>
                                    <td></td>
                                  <?php
                                     } 
                                  } 

                                      if ($aktual != NULL) {
                                      ?>
                                    <td><?php echo round(array_sum(array_column($aktual, 'total_td')) / count($aktual), 2) ?></td>
                                  <?php } else { ?>
                                    <td></td>
                                  <?php } 
                                    if($user['id_divisi'] == 1 OR $user['id_divisi'] == 99) { ?>
                                    <td></td>
                                  <?php } ?>
                                    <td></td>
                                  
                              </tr>

<!--                              <tr>
                                  <th colspan="8">MIN</th>
                                <?php
                                    foreach ($td as $col) {
                                    ?>
                                    <th></th>
                                <?php } ?>
                                    <th></th>
                              </tr>
                              <tr>
                                  <th colspan="8">AVERAGE</th>
                                <?php
                                    foreach ($td as $col) {
                                    ?>
                                    <th></th>
                                <?php } ?>
                                    <th></th>

                              </tr> -->
                            </tbody>
                        </table>
                    <?php if($user['id_divisi'] == 1 OR $user['id_divisi'] == 99) { ?>
                        <div class="col-md-12 text-right">
                            <button type="submit" data-toggle="popover" data-placement="left" title="Attention" data-content="Anda telah mengubah nilai TD, mohon klik button Update ini agar data yang Anda ubah dapat tersimpan!" class="btn btn-success" id="update"><i class="far fa-save fa-lg"></i> Update</button>
                        </div>
                    <?php } ?>
                    </div>
                
                        <table width="20%">
                            <tr>
                                <td><h5><b>Jumlah Data </b></h5></td>
                                <td><h5><b> : </b></h5></td>
                                <td><h5><b> <?php echo $jumlah_data; ?></b></h5></td>
                            </tr>
                            <tr>
                                <td><h5><b>Jumlah TD </b></h5></td>
                                <td><h5><b> : </b></h5></td>
                                <td><h5><b> <?php echo $jumlah_td; ?></b></h5></td>
                            </tr>
                            <tr>
                                <td><h5><b>Rata-Rata TD </b></h5></td>
                                <td><h5><b> : </b></h5></td>
                                <td><h5><b> <?php echo round($avg, 2); ?></b></h5></td>
                            </tr>
                        </table>


                        

                    <?php
                    }
                    endif;
                    ?>
                
                </section>
                  </div>
              </div>
          </div>


          <?php
          if (isset($_POST['cek_td'])) :
          $no=0;
           foreach ($aktual as $row) {  $no++;
            $data = [
                                // 'project' => $pro,
                                'bank' => $row['bank'],
                                'channel' => $row['channel'],
                                'transaksi' => $row['transaksi'],
                                'os' => $row['os'],
                                'jenis' => $row['jenis'],
                                'versi' => $row['versi_label']
                                // 'status !=' => 0
                                ];
                    // $td = $this- >db->order_by('step', 'ASC')->get_where('ebanking_data_td', $data)->result_array();                       

             $detail = $this->db->get_where('ebanking_td', array('num_eb' => $row['num']))->row_array();
              ?>
          <!-- Modal -->
            <div class="modal fade" id="edittd<?php echo $row['num'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Nilai TD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="num[]" value="<?php echo $row['num'] ?>">
                    <table class="table">

                         <?php
                         foreach ($td as $col) {
                         $step = $col['step']; ?>
                            <tr>
                                <td><?php echo $col['label']; ?></td>
                                <td><input type="number" class="form-control" id="nilaitd<?php echo $row['num'].$step?>" name="nilaitd<?php echo $row['num'].$step?>" value="<?php echo $detail['step'.$step]; ?>" min="0.00" step="0.01" onchange="cekTotal('<?php echo $row['num'] ?>');" onkeyup="cekTotal('<?php echo $row['num'] ?>');"></td>
                                <td>detik</td>   
                            </tr>
                        <?php } ?>
                        <tr style="background-color:#E0FFFF;">
                            <td>
                                <!-- <button type="button" class="btn btn-primary" onclick="cekTD('<?php echo $row['num'] ?>');">Total TD</button> -->
                            <strong>TOTAL TD</strong>
                            </td>
                            <td><input type="number" class="form-control" name="td_total<?php echo $row['num']?>" id="td_total<?php echo $row['num'] ?>" value="<?php echo $row['total_td'] ?>" readonly></td>
                            <td>detik</td>
                        </tr>
                        <input type="hidden" name="step" id="step<?php echo $row['num']?>" value="<?php echo $step ?>">
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>
        <?php }
        endif; ?>
                      
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
