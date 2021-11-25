
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
<style type="text/css">
 
.step {
  display: none;
  background-color: #F0FFFF ; 
  padding-bottom: 30px;
}
.step.active {
  display: block;
}
.row {
  padding-left: 20px;
  padding-right: 20px;
}


</style>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aktual E-Banking </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel ">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> <?php echo $data['nama_project']; ?> - EBanking </strong> </h4>
                       <!-- Nav tabs -->
                      
                      <br>
                      <?php ?>

                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                    <!-- Tab panes -->
                     
                        <form method="POST" action="<?php echo base_url('aktual/aktual_ulang') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="num" id="num" value="<?php echo $data['num'] ?>">
                        <div class="text-left" style="width: 80%; margin: auto;">
                          <div class="step step-1 active px-3">
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Nama Shopper</h5>
                          </div>
                          <div class="bg-secondary col-sm-6" style="padding: 20px;">
                           <select class="form-control" name="nama_shopper" id="nama_shopper" data-live-search="true">
                              <option value="">--Pilih Shopper--</option>
                            <?php
                            foreach ($shopper as $shp) {
                              ?>
                              <option value="<?php echo $shp['id'] ?>" <?php if ($data['nama_shopper'] == $shp['id']) {echo "selected";} ?>><?php echo $shp['nama'] ?></option>
                            <!-- <input type="radio" name="bank" id="bank" value="<?php echo $b['kode'] ?>"> <?php echo $b['nama'] ?> <br> -->
                          <?php } ?>       
                          </select>  
                          </div>
                          <div class="row">
                          <div class="col-sm-12 text-right"><button class="btn btn-primary next-btn" id="btn_shopper">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-2" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Pilih Bank</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                          <div class="container-fluid" id="bank_radio" style="margin: 20px;">
                            <select class="form-control" name="bank" id="bank" data-live-search="true">
                              <option value="<?php echo $data['bank'] ?>" selected><?php echo $data['nama_bank'] ?></option>       
                          </select>                                             
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" >Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-3" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Tanggal Evaluasi</h5>
                            <div class="row text-center"><h5 style="color:  #8B0000;"><b><i class="fas fa-exclamation-circle"></i> Pertanyaan ini wajib diisi</b></h5></div>
                          </div>
                           <div class="row">
                            <div class="col-sm-12 text-danger text-center" id="warning_hari" style="padding: 15px;"></div>
                          <div class="bg-secondary col-sm-6" style="padding: 20px;">
                            <input type="date" name="tanggal" id="tanggal_evaluasi" class="form-control" value="<?php echo $data['tanggal_evaluasi'] ?>" max="<?php echo date('Y-m-d') ?>" required readonly>
                          </div>
                        </div>       
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_tanggal">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-4">
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Jam pada saat Anda <b>MULAI</b> Evaluasi</h5>
                            <div class="row text-center"><h5 style="color:  #8B0000;"><b><i class="fas fa-exclamation-circle"></i> Pertanyaan ini wajib diisi</b></h5></div>
                          </div>
                           <div class="row">
                          <div class="bg-secondary col-sm-3" style="padding: 20px;">
                            <label>Jam & Menit</label>
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="<?php echo $data['jam_mulai'] ?>" required>
                          </div>
                        </div>
                        <!-- <div class="row">
                          <div class="bg-secondary col-sm-3" style="padding: 20px;">
                            <label>Menit</label>
                            <input type="text" name="menit_mulai" class="form-control">
                          </div>
                        </div> -->                         
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_mulai">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-5" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Jam pada saat Anda <b>SELESAI</b> Evaluasi</h5>
                            <div class="row text-center"><h5 style="color:  #8B0000;"><b><i class="fas fa-exclamation-circle"></i> Pertanyaan ini wajib diisi</b></h5></div>

                          </div>
                           <div class="row">
                            <div class="col-sm-12 text-danger text-center" id="warning_jam" style="padding: 15px;"></div>
                          <div class="bg-secondary col-sm-3" style="padding: 20px;">
                            <label>Jam & Menit</label>
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="<?php echo $data['jam_selesai'] ?>" required>
                          </div>
                        </div>
                        <!-- <div class="row">
                          <div class="bg-secondary col-sm-3" style="padding: 20px;">
                            <label>Menit</label>
                            <input type="text" name="menit_selesai" class="form-control">
                          </div>
                        </div> -->     
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_jam">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-6" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> E-banking apa yang Anda evaluasi?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="channel_ebanking" style="margin: 20px;">          
                            <select class="form-control" name="channel_eb" id="channel_eb" data-live-search="true">
                              <option value="<?php echo $data['channel'] ?>" selected><?php echo $data['channel'] ?></option>       
                          </select>                                      
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                         

                          <div class="step step-7" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Jenis <span id="jenis_ev"></span> yang di evaluasi?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="os_ebanking" style="margin: 20px;">
                           <select name="os_eb" class="selector form-control" data-live-search="true">
                            <?php if ($data['channel'] == 'SMS Banking') { ?>
                              <option value="<?php echo $data['os'] ?>"> <?php echo $data['os'] ?></option>
                            <?php } else if ($data['channel'] == 'Internet Banking') { ?>
                              <option value="<?php echo $data['os']."_".$data['jenis'] ?>"> <?php echo $data['jenis'] ?></option>
                            <?php } else {
                            ?>
                             <option value="<?php echo $data['os']."_".$data['jenis'] ?>"> <?php echo $data['jenis']." ".$data['os'] ?></option>
                             <?php } ?>
                           </select>                                                    
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>

                          <div class="step step-8" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Provider apa yang Anda Gunakan?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="provider_ebanking" style="margin: 20px;">
                           <select name="provider_eb" class="selector form-control" data-live-search="true">
                            <?php if ($data['channel'] == 'Internet Banking') { ?>
                              <option value="<?php echo $data['provider'] ?>"> <?php echo $data['provider']." (".$data['os'].")" ?></option>
                            <?php } else {
                            ?>
                             <option value="<?php echo $data['provider'] ?>"> <?php echo $data['provider'] ?></option>
                             <?php } ?>
                           </select>                                                    
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>

                          <div class="step step-9" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Transaksi yang Anda lakukan?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">     
                            <select class="form-control" name="transaksi_eb" id="transaksi_eb" data-live-search="true">
                              <option value="<?php echo $data['transaksi'] ?>" selected><?php echo $data['nama_transaksi'] ?></option>       
                            </select>                                               
                          </div>
                          <div id="jml_rek">
                            
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <?php
                          $bank = $this->db->query("SELECT a.*, b.nama AS nama_bank FROM ebanking_rekening a JOIN bank b ON a.bank=b.kode WHERE a.bank='$data[bank]' AND kategori='Rekening' ORDER BY a.nama")->result_array();
                          
                          $get = $this->db->get_where('attribute_ebanking', array('kode' => $data['transaksi']))->row_array();

                          if ($get['nama'] == 'Overbooking') {
                              $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                                          FROM ebanking_rekening a
                                                          LEFT JOIN bank b ON a.bank=b.kode 
                                                          WHERE a.bank='$data[bank]'
                                                          AND a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
                          } else if ($get['nama'] == 'Interbank Online' OR $get['nama'] == 'Interbank Offline' OR $get['nama'] == 'ITB Online' OR $get['nama'] == 'ITB Offline') {
                              $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                                          FROM ebanking_rekening a
                                                          LEFT JOIN bank b ON a.bank=b.kode 
                                                          WHERE a.bank!='$data[bank]'
                                                          AND a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
                          } else if(strpos($get['nama'],"Pulsa")) {
                               $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                                          FROM ebanking_rekening a
                                                          LEFT JOIN bank b ON a.bank=b.kode 
                                                          WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
                          } else if(strpos($get['nama'],"Kartu Kredit")) {
                               $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                                          FROM ebanking_rekening a
                                                          LEFT JOIN bank b ON a.bank=b.kode 
                                                          WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
                          } else if(strpos($get['nama'],"E-Money") OR strpos($get['nama'],"EMoney")) {
                               $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                                          FROM ebanking_rekening a
                                                          LEFT JOIN bank b ON a.bank=b.kode 
                                                          WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
                          } else {
                              $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                                          FROM ebanking_rekening a
                                                          LEFT JOIN bank b ON a.bank=b.kode 
                                                          WHERE 
                                                          a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
                          }
                          ?>

                          <div class="step step-2" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Sumber dan Tujuan Transaksi <span id="trk_nama"></span></h5>
                            <div class="row text-center"><h5 style="color:  #8B0000;"><b><i class="fas fa-exclamation-circle"></i> Pertanyaan ini wajib diisi</b></h5></div>
                          </div>
                          <div class="container-fluid" id="bank_radio" style="margin: 20px;">
                            <label>Masukkan Nomor Rekening Sumber</label>
                            <select name="norek" id="norek_eb" class="form-control">
                              <option value="">--Pilih Nomor Rekening--</option>
                              <?php
                              foreach ($bank as $no) {
                                $sumber = $no['nama']." - ".$no['norek'];
                                $db = $data['norek'];

                                 ?>
                                <option value="<?php echo $no['nama']." - ".$no['norek'] ?>" <?php if ($sumber === $db) { echo "selected"; } ?>><?php echo $no['nama']." - ".$no['norek']." - ".$no['nama_bank']; ?></option>
                               <?php } ?>
                            </select>

                            <?php 
                            if ($get['sumber'] == '2') { ?>
                               <label>Masukkan Tujuan</label>
                               <select class="form-control" name="tujuan" id="tujuan">
                               <option value="">--Pilih Tujuan--</option>
                               <?php 
                              foreach ($tujuan as $to) {
                                 if ($to['kategori'] == 'Pulsa' || $to['kategori'] == 'E-Wallet') {
                                      $sumber = $to['nama']." - ".$to['norek']." - ".$to['bank'];
                                      $db = $data['tujuan']; ?>
                                   <option value="<?php echo $to['nama']." - ".$to['norek']." - ".$to['bank'] ?>" <?php if ($sumber === $db) { echo "selected"; } ?>><?php echo $to['nama']." - ".$to['norek']." - ".$to['bank'] ?></option>

                                <?php } else {
                                      $sumber = $to['nama']." - ".$to['norek']." - ".$to['nama_bank'];
                                      $db = $data['tujuan']; ?>
                                   <option value="<?php echo $to['nama']." - ".$to['norek']." - ".$to['nama_bank'] ?>" <?php if ($sumber === $db) { echo "selected"; } ?>><?php echo $to['nama']." - ".$to['norek']." - ".$to['nama_bank'] ?></option>
                                 
                                 <?php }
                               } ?>
                               </select>

                             <?php } else { ?>
                               <input type="hidden" name="tujuan" id="tujuan" class="form-control">
                             <?php } ?>

                          </div>
                          <div class="container-fluid" id="tujuan" style="margin: 20px;">
                           
                          </div>

                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_sumber">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-10" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Apakah Transaksi yang Anda lakukan Berhasil?</h5>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">    
                              <div class="row">
                                <div class="col-sm-3"><b>Berhasil Pada Percobaan Ke- </b></div>
                                <div class="col-sm-2"><input type="number" min="0" name="percobaan_ke" id="percobaan_ke" class="form-control" required></div>
                                
                              </div>
                              <br>
                              <div class="form-inline" id="inline_ket">
                                
                              </div>
                            
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <?php
                          if ($data['channel'] == 'Internet Banking') {
                            $list = $this->db->query("SELECT *
                                                            FROM ebanking_data_td  
                                                            WHERE bank = '$data[bank]'
                                                            AND channel = '$data[channel]'
                                                            AND transaksi = '$data[transaksi]'
                                                            AND jenis = '$data[jenis]'
                                                            AND versi = '$data[versi_label]'
                                                            ORDER BY step
                                                            ")->result_array();
                          } else if ($data['channel'] == 'SMS Banking') {
                           $list = $this->db->query("SELECT *
                                                            FROM ebanking_data_td  
                                                            WHERE bank = '$data[bank]'
                                                            AND channel = '$data[channel]'
                                                            AND os = '$data[os]'
                                                            AND transaksi = '$data[transaksi]'
                                                            AND versi = '$data[versi_label]'
                                                            ORDER BY step
                                                            ")->result_array();
                          } else {
                          $list = $this->db->query("SELECT *
                                                            FROM ebanking_data_td  
                                                            WHERE bank = '$data[bank]'
                                                            AND channel = '$data[channel]'
                                                            AND os = '$data[os]'
                                                            AND transaksi = '$data[transaksi]'
                                                            AND jenis = '$data[jenis]'
                                                            AND versi = '$data[versi_label]'
                                                            ORDER BY step
                                                            ")->result_array();
                          }
                          $nilai = $this->db->query("SELECT *
                                                            FROM ebanking_td  
                                                            WHERE num_eb = '$data[num]'
                                                            AND project = '$data[project]' 
                                                            AND bank = '$data[bank]'
                                                            AND channel = '$data[channel]'
                                                            AND transaksi = '$data[transaksi]'
                                                            AND versi_label = '$data[versi_label]'
                                                            ")->row_array();
                          // var_dump($data);
                          // var_dump($nilai);
                           ?>
                          <div class="step step-11" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Time Delivery?</h5>
                            <div class="row text-center"><h5 id="ket_td" style="color:  #FFD700;"><b></b></h5></div>
                            
                          </div>
                           <div class="" id="timedelivery_ebanking" style="margin: 20px;">                                             
                                <div class="table-responsive">
                                 <table class="table">
                                 <thead>
                                 <tr>
                                 <th colspan="4"><center>Input Time Delivery<center></th>
                                 </tr>
                                 </thead>
                                 <tbody>

                                <?php foreach ($list as $li) {
                                  $step = $li['step'];
                                  // echo $step;
                                  ?>

                                   <tr>
                                   <td><center><b><?php echo $li['label']; ?></b></center></td>
                                   <td><center><b>:</b></center></td>
                                   <td><center><input type="number" name="td_step<?php echo $li['step'] ?>" id="value_td<?php echo $li['step'] ?>" step="0.01" placeholder="0.00" value="<?php echo $nilai['step'.$step]; ?>" class="form-control value_td"></center></td>
                                   <td>detik</td>

                                   </tr>
                                 <?php } ?>

                                </tbody>
                                 </table>
                                 </div>
                                 <br>

                                 <div class="form-inline">
                                 <label><b>Total TD :</b></label>
                                 <input type="text" class="form-control" id="total_td" name="total_td" value="<?php echo $data['total_td'] ?>" readonly>
                                 <input type="hidden" class="form-control" id="baris_td" name="baris_td" value="<?php echo $li['step'] ?>" readonly>
                                 <input type="hidden" class="form-control" id="versi_td" name="versi_td" value="<?php echo $data['versi_label'] ?>" readonly>
                                 </div>
                           </div>
                            <div id="btn_jumlahtd" style="margin: 20px;">
                              <button class="btn btn-primary" id="test_td" style="display: none;">Total TD</button>
                            </div>
                          <br>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="fix_td">Berikutnya</button></div>
                          </div>
                          </div>

                          <div class="step step-12" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Upload Bukti Transaksi</h5>
                          </div>
                           <div class="container-fluid" id="provider_ebanking" style="margin: 20px;">    
                            <input type="file" class="form-control" name="bukti_transaksi" id="bukti_transaksi" accept="image/*" required>
                            <span class="bg-info p-1"><b>NOTE!</b></span>&nbsp;&nbsp;Ukuran file upload maksimal 500KB!<br>
                            <img src="#" id="gambar_nodin" width="100%" alt="Preview Gambar" />                                                
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><input type="submit" name="submit" id="submit_aktual" class="btn btn-success" value="Submit" disabled></div>
                          </div>
                          </div>



                        </div>
                        </form>


                      
                



                </div>
            </div>
          </div>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

    <!-- /MAIN CONTENT -->
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

    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
     const steps = Array.from(document.querySelectorAll("form .step"));
    const nextBtn = document.querySelectorAll("form .next-btn");
    const prevBtn = document.querySelectorAll("form .previous-btn");
    const form = document.querySelector("form");

    nextBtn.forEach((button) => {
      button.addEventListener("click", () => {
        changeStep("next");
      });
    });
    prevBtn.forEach((button) => {
      button.addEventListener("click", () => {
        changeStep("prev");
      });
    });

    // form.addEventListener("submit", (e) => {
    //   e.preventDefault();
    //   const inputs = [];
    //   form.querySelectorAll("input").forEach((input) => {
    //     const { name, value } = input;
    //     inputs.push({ name, value });
    //   });
    //   console.log(inputs);
    //   // form.reset();
    // });

    function changeStep(btn) {
      let index = 0;
      const active = document.querySelector(".active");
      index = steps.indexOf(active);
      steps[index].classList.remove("active");
      if (btn === "next") {
        index++;
      } else if (btn === "prev") {
        index--;
      }
      steps[index].classList.add("active");
    }

  // var cek = document.getElementsById('value_td').value;
  // console.log(cek);
  </script>
