
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
.garis-bawah {
    border: 0;
    outline: 0;
    border-bottom: 2px solid grey;

  }


</style>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aktual Ulang Evaluasi Sosial Media </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel ">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> <?php echo $data['nama_project']; ?> - Evaluasi Sosial Media </strong> </h4>
                       <!-- Nav tabs -->
                      
                      <br>
                      <?php ?>

                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                    <!-- Tab panes -->
                     
                        <form method="POST" action="<?php echo base_url('aktual/aktual_ulangsosmed') ?>" enctype="multipart/form-data">
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
                          <div class="col-sm-12 text-right"><button type="button" class="btn btn-primary next-btn" id="btn_shopper">Berikutnya</button></div>
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
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn" >Berikutnya</button></div>
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
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn" id="btn_tanggal">Berikutnya</button></div>
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
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn" id="btn_mulai">Berikutnya</button></div>
                          </div>
                          </div>


      


                          <div class="step step-5" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Platform apa yang Anda evaluasi?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="channel_ebanking" style="margin: 20px;">          
                            <select class="form-control" name="platform" id="platform" data-live-search="true">
                              <option value="<?php echo $data['platform'] ?>" selected><?php echo $data['platform'] ?></option>       
                          </select>                                      
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                         

                          <div class="step step-6" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Skenario yang Anda lakukan?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">     
                            <select class="form-control" name="skenario" id="skenario" data-live-search="true">
                              <option value="<?php echo $data['skenario'] ?>" selected><?php echo $data['nama_skenario'] ?></option>       
                            </select>                                               
                          </div>
                          <div id="jml_rek">
                            
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <?php
                          $pengirim = $this->db->get_where('sosmed_akun', array('platform' => $data['platform'], 'milik' => 'Pribadi'))->result_array();
                          ?>
                          <div class="step step-7" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> User Akun Sosial Media <span id="trk_nama"></span></h5>
                            <div class="row text-center"><h5 style="color:  #8B0000;"><b><i class="fas fa-exclamation-circle"></i> Pertanyaan ini wajib diisi</b></h5></div>
                          </div>
                          <div class="container-fluid" id="bank_radio" style="margin: 20px;">
                            <?php if ($data['platform'] == 'Facebook') {
                              echo "<label>Page name Pengirim</label>";
                            } else {
                              echo "<label>Username Pengirim</label>";
                            } ?>
                            
                            <select name="sosmed_pengirim" id="sosmed_pengirim" class="form-control">
                              <option value="">--Pilih User Akun Pengirim--</option>
                              <?php
                              foreach ($pengirim as $pg) {
                                $db = $data['sosmed_pengirim'];

                                 ?>
                                <option value="<?php echo $pg['username'] ?>" <?php if ($pg['username'] === $db) { echo "selected"; } ?>><?php echo $pg['username']; ?></option>
                               <?php } ?>
                            </select>
                            <br>

                            <?php if ($data['platform'] == 'Facebook') {
                              echo "<label>Page name Bank</label>";
                            } else {
                              echo "<label>Username Bank</label>";
                            } ?>
                            <input type="text" name="sosmed_bank" class="form-control" value="<?= $data['sosmed_bank'] ?>" readonly>

                          </div>
                          <div class="container-fluid" id="tujuan" style="margin: 20px;">
                           
                          </div>

                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn" id="btn_sumber">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-8" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Greeting Awal</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilihlah sesuai dari hasil evaluasi yang dilakukan</b></h5></div>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">     
                            <?php 
                              $greet = $this->db->order_by('urut', 'asc')->get('sosmed_greeting')->result_array();
                              $ga = unserialize($data['greeting_awal']);
                              foreach ($greet as $gt) {
                                ?>

                              <input type="checkbox" name="greeting_awal[]" <?php if (in_array($gt['score'], $ga)) {echo "checked";} ?> value="<?= $gt['score'] ?>">&nbsp; <?= $gt['greeting'] ?><br>
                              <?php } ?>
                              Lainnya <input type="text" name="greeting_awal[]" class="garis-bawah">                                               
                          </div>
                        
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-9" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Greeting Akhir (Sebelum balas OK)</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilihlah sesuai dari hasil evaluasi yang dilakukan</b></h5></div>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">     
                            <?php $g_before = unserialize($data['greeting_akhir_before']);
                              $not = array(31, 32, 33, 34);
                              // $greet = $this->db->where_not_in('score', $not)->get('sosmed_greeting')->result_array();
                              $greet = $this->db->order_by('urut', 'asc')->get('sosmed_greeting')->result_array();

                              foreach ($greet as $gt) {
                              ?>

                            <input type="checkbox" name="greeting_akhir_before[]" <?php if (in_array($gt['score'], $g_before)) {echo "checked";} ?>  value="<?= $gt['score'] ?>">&nbsp; <?= $gt['greeting'] ?><br>
                            <?php } ?>
                            Lainnya <input type="text" name="greeting_akhir_before[]" class="garis-bawah">                                               
                          </div>
                        
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-9" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Greeting Akhir (Setelah balas OK)</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilihlah sesuai dari hasil evaluasi yang dilakukan</b></h5></div>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">     
                            <?php $g_after = unserialize($data['greeting_akhir_after']);
                              $not = array(31, 32, 33, 34);
                              // $greet = $this->db->where_not_in('score', $not)->get('sosmed_greeting')->result_array();
                              $greet = $this->db->order_by('urut', 'asc')->get('sosmed_greeting')->result_array();

                              foreach ($greet as $gt) {
                              ?>

                            <input type="checkbox" name="greeting_akhir_after[]" <?php if (in_array($gt['score'], $g_after)) {echo "checked";} ?> value="<?= $gt['score'] ?>">&nbsp; <?= $gt['greeting'] ?><br>
                            <?php } ?>
                            Lainnya <input type="text" name="greeting_akhir_after[]" class="garis-bawah">                                               
                          </div>
                        
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-10" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Respon Agent?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Isilah sesuai dari hasil evaluasi yang dilakukan</b></h5></div>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">     
                                <textarea class="form-control" name="respon_agent" rows="10"><?= $data['respon_agent'] ?></textarea>
                                                                           
                          </div>
                          <div id="jml_rek">
                            
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-11" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Detail Time Delivery</h5>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">    
                              <label>Waktu Pengiriman Pesan</label>
                                <input type="datetime-local" name="waktu_kirim" id="waktu_kirim" class="form-control" value="<?php echo date('Y-m-d\TH:i:s', strtotime($data['waktu_kirim'])); ?>">
                              <br>

                                <label>Waktu Dibalas Pesan Oleh Staff</label>
                                <input type="datetime-local" name="waktu_balas" id="waktu_balas" class="form-control" <?php if($data['waktu_balas'] != NULL) { ?> value="<?php echo date('Y-m-d\TH:i:s', strtotime($data['waktu_balas'])); ?>" <?php } ?>>
                                <br>

                                <label>Aktual Time Delivery</label>
                                <input name="aktual_td" id="aktual_td" class="form-control" value="<?= $data['aktual_td'] ?>" readonly>
                                <br>
                               
                               
                                <label>Time Delivery</label><br>
                                <input type="radio" name="total_td" id="td_1" <?php if($data['total_td'] == 1){echo "checked";} ?> value="1" > &nbsp;Kurang dari 30 menit<br>
                                <input type="radio" name="total_td" id="td_2" <?php if($data['total_td'] == 2){echo "checked";} ?> value="2" > &nbsp;31 menit - 1 jam<br>
                                <input type="radio" name="total_td" id="td_3" <?php if($data['total_td'] == 3){echo "checked";} ?> value="3" > &nbsp;1 - 24 jam (respons diterima dalam hari yang sama)<br>
                                <input type="radio" name="total_td" id="td_4" <?php if($data['total_td'] == 4){echo "checked";} ?> value="4" > &nbsp;H+1<br>
                                <input type="radio" name="total_td" id="td_5" <?php if($data['total_td'] == 5){echo "checked";} ?> value="5" > &nbsp;H+2<br>
                                <input type="radio" name="total_td" id="td_6" <?php if($data['total_td'] == 6){echo "checked";} ?> value="6" > &nbsp;H+3<br>
                                <input type="radio" name="total_td" id="td_99" <?php if($data['total_td'] == 99){echo "checked";} ?> value="99" > &nbsp;Belum ada respons sama sekali hingga H+4<br>
                            
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-6" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Respon Otomatis dan Temuan</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Isilah sesuai dari hasil evaluasi yang dilakukan</b></h5></div>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">     
                                <label>Apabila time delivery respons agent lebih dari 1 jam, apakah terdapat respons otomatis yang dikirimkan bahwa staf bank sedang offline/tidak beroperasi? </label>
                                  <input type="radio" name="respon_otomatis" class="respon_1" id="respon" <?php if($data['respon_otomatis'] == 1){echo "checked";} ?> value="1" > &nbsp;Ada<br>
                                  <input type="radio" name="respon_otomatis" class="respon_2" id="respon" <?php if($data['respon_otomatis'] == 2){echo "checked";} ?> value="2" > &nbsp;Tidak<br>
                                  <input type="radio" name="respon_otomatis" class="respon_99" id="respon" <?php if($data['respon_otomatis'] == 99){echo "checked";} ?> value="99" > &nbsp;Time delivery < 1 jam<br>
                                
                                <br>

                                <div id="isi_verbatim">
                                  <?php if($data['respon_otomatis'] == 1){ ?>
                                    <label>Verbatim</label>
                                    <input name="verbatim" class="form-control" value="<?= $data['verbatim_respon'] ?>">
                                  <?php } ?>
                                </div>

                                <label>Temuan (jika ada)</label>
                                <input type="text" name="temuan" class="form-control" value="<?= $data['temuan'] ?>">
                                            
                          </div>
                          <div id="jml_rek">
                            
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button type="button" class="btn btn-primary next-btn">Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-12" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Upload Bukti Transaksi</h5>
                          </div>
                           <div class="container-fluid" id="provider_ebanking" style="margin: 20px;">    
                            <input type="file" class="form-control" name="bukti_transaksi[]" multiple id="bukti_transaksi" accept="image/*" required>
                            <span class="bg-info p-1"><b>NOTE!</b></span>
                            <br>&nbsp;&nbsp; - Ukuran file upload maksimal 500KB!
                            <br>&nbsp;&nbsp; - Upload evidence dapat multiple file image!
                            <!-- <img src="#" id="gambar_nodin" width="100%" alt="Preview Gambar" />                                                 -->
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button type="button" class="btn btn-primary previous-btn">Sebelumnya</button></div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <!-- /MAIN CONTENT -->
    <!--main content end -->
<script>
  $(document).ready(function() {
       $('#waktu_balas').change(function() {
        var datekirim = new Date($('#waktu_kirim').val());
        var datebalas = new Date($(this).val());

        var ht = ``;
        var difference = datebalas.getTime() - datekirim.getTime();

        // console.log(difference);
        console.log(datekirim.getTime());
        console.log(datebalas.getTime());

        var diff_hari = Math.floor(difference/1000/60/60/24);
        difference -= diff_hari*1000*60*60*24

        var diff_jam = Math.floor(difference/1000/60/60);
        difference -= diff_jam*1000*60*60

        var diff_menit = Math.floor(difference/1000/60);
        difference -= diff_menit*1000*60

        console.log('difference = ' + 
        diff_hari + ' day/s ' + 
        diff_jam + ' hour/s ' + 
        diff_menit + ' minute/s ');

        $('#aktual_td').val(diff_menit+` menit `+diff_jam+` jam `+diff_hari+` hari`);

   
        if (diff_menit <= 30 && diff_jam == 0 && diff_hari == 0) {
          $("#td_1").prop("checked", true);
          $(".respon_99").prop("checked", true);
        } else if ((diff_menit > 30 && diff_menit < 59 && diff_jam == 0 && diff_hari == 0) ||  (diff_menit == 0 && diff_jam == 1 && diff_hari == 0)) {
          $("#td_2").prop("checked", true);
          $(".respon_99").prop("checked", true);
        } else if (diff_jam >= 1 && diff_jam <= 24 && diff_hari == 0) {
          $("#td_3").prop("checked", true);
        } else if (diff_menit >= 0 && diff_jam >= 0  && diff_hari == 1) {
          $("#td_4").prop("checked", true);
        } else if (diff_menit >= 0 && diff_jam >= 0  && diff_hari == 2) {
          $("#td_5").prop("checked", true);
        } else if (diff_menit >= 0 && diff_jam >= 0  && diff_hari == 3) {
          $("#td_6").prop("checked", true);
        } else {
          $("#td_99").prop("checked", true);
        }

       })

       $('input[type=radio][name="respon_otomatis"]').change(function() {
          var respon = $(this).val();
          console.log(respon);
          var hz = ``;
          $('#isi_verbatim').empty();

          hz += `<div class="form-group">`;
          hz += `<label>Verbatim</label>`;
          hz += `<input name="verbatim" class="form-control">`;
          hz += `</div>`;

          if (respon == '1') {
            $('#isi_verbatim').append(hz);
          }
       });
     });



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
