
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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> <?php echo $project; ?> - EBanking </strong> </h4>
                       <!-- Nav tabs -->
                      
                      <br>
                      <?php ?>

                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                    <!-- Tab panes -->
                     
                        <form method="POST" action="<?php echo base_url('aktual/autodetect') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="kd_project" id="kd_project" value="<?php echo $kode_project ?>">
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
                              <option value="<?php echo $shp['id'] ?>"><?php echo $shp['nama'] ?></option>
                            <!-- <input type="radio" name="bank" id="bank" value="<?php echo $b['kode'] ?>"> <?php echo $b['nama'] ?> <br> -->
                          <?php } ?>       
                          </select>  
                          </div>
                          <div class="row">
                          <div class="col-sm-12 text-right"><button class="btn btn-primary next-btn" id="btn_shopper" disabled>Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-2" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Pilih Bank</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                          <div class="container-fluid" id="bank_radio" style="margin: 20px;">
                            <select class="form-control" name="bank" id="bank" data-live-search="true">
                              <option value="">--Pilih Bank--</option>
                            <?php
                            foreach ($bank as $b) {
                              ?>
                              <option value="<?php echo $b['kode'] ?>"><?php echo $b['nama'] ?></option>
                            <!-- <input type="radio" name="bank" id="bank" value="<?php echo $b['kode'] ?>"> <?php echo $b['nama'] ?> <br> -->
                          <?php } ?>       
                          </select>                                             
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="next_bank" disabled>Berikutnya</button></div>
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
                            <input type="date" name="tanggal" id="tanggal_evaluasi" class="form-control" max="<?php echo date('Y-m-d') ?>" required>
                          </div>
                        </div>       
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_tanggal" disabled>Berikutnya</button></div>
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
                            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
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
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_mulai" disabled>Berikutnya</button></div>
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
                            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
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
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_jam" disabled>Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-6" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> E-banking apa yang Anda evaluasi?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="channel_ebanking" style="margin: 20px;">          
                            <?php
                            foreach ($channel as $c) {
                              ?>
                            <input type="radio" name="channel_eb" id="channel_eb" value="<?php echo $c['channel'] ?>"> <?php echo $c['channel'] ?> <br>
                          <?php } ?>                                      
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_channel" disabled>Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-7" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Jenis <span id="jenis_ev"></span> yang di evaluasi?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="os_ebanking" style="margin: 20px;">                                                    
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_os" disabled>Berikutnya</button></div>
                          </div>
                          </div>

                          <div class="step step-8" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Provider apa yang Anda Gunakan?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="provider_ebanking" style="margin: 20px;">                                                    
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_transaksi" disabled>Berikutnya</button></div>
                          </div>
                          </div>

                          <div class="step step-9" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Transaksi yang Anda lakukan?</h5>
                            <div class="row text-center"><h5 style="color:  #FFD700;"><b><i class="fas fa-exclamation-circle"></i> Pilih salah satu dari jawaban berikut</b></h5></div>
                          </div>
                           <div class="container-fluid" id="transaksi_ebanking" style="margin: 20px;">     
                            <?php
                            foreach ($transaksi as $t) {
                              ?>
                            <input type="radio" name="transaksi_eb" id="transaksi_eb" value="<?php echo $t['transaksi'] ?>"> <?php echo $t['nama'] ?> <br>
                          <?php } ?>                                                
                          </div>
                          <div id="jml_rek">
                            
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="trx_btn" disabled>Berikutnya</button></div>
                          </div>
                          </div>

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
                              foreach ($norek as $no) {
                                 ?>
                                <option value="<?php echo $no['norek'] ?>"><?php echo $no['nama']." - ".$no['norek']." - ".$no['nama_bank']; ?></option>
                               <?php } ?>
                            </select>

                          </div>
                          <div class="container-fluid" id="tujuan" style="margin: 20px;">
                           
                          </div>

                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="btn_sumber" disabled>Berikutnya</button></div>
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
                                <!-- <label>Test</label>&nbsp;
                                <input type="text" class="form-control" name=""><br>
                                <label>Test</label>&nbsp;
                                <input type="text" class="form-control" name=""><br> -->
                                
                              </div>
                                                          <!-- <table class="table">
                              <thead>
                                <tr>
                                  <td></td>
                                  <td><center><b>1. Berhasil</b></center></td>
                                  <td><center><b>2. Tidak Berhasil</b></center></td>
                                </tr>
                              </thead>
                              <tbody id="tbody_percobaan">
                                <tr>
                                  <td>Dial/Percobaan 1</td>
                                  <td><center><input type="radio" name="percobaan1" id="percobaan" value="Berhasil"></center></td>
                                  <td><center><input type="radio" name="percobaan1" id="percobaan" value="Tidak Berhasil"></center></td>
                                </tr>
                              </tbody>
                            </table> -->
                          </div>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="fix_btn" disabled>Berikutnya</button></div>
                          </div>
                          </div>


                          <div class="step step-11" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Time Delivery?</h5>
                            <div class="row text-center"><h5 id="ket_td" style="color:  #FFD700;"><b></b></h5></div>
                            
                          </div>
                           <div class="" id="timedelivery_ebanking" style="margin: 20px;">                                             

                           </div>
                            <div id="btn_jumlahtd" style="margin: 20px;">
                              <button class="btn btn-primary" id="test_td" style="display: none;">Total TD</button>
                            </div>
                          <br>
                          <div class="row">
                          <div class="col-sm-6 text-left"><button class="btn btn-primary previous-btn">Sebelumnya</button></div>
                          <div class="col-sm-6 text-right"><button class="btn btn-primary next-btn" id="fix_td" disabled>Berikutnya</button></div>
                          </div>
                          </div>

                          <div class="step step-12" >
                          <div class="bg-primary" style="padding: 20px;">
                            <h5><i class="fas fa-star-of-life text-danger"></i> Upload Bukti Transaksi</h5>
                          </div>
                           <div class="container-fluid" id="provider_ebanking" style="margin: 20px;">    
                            <input type="file" class="form-control" name="bukti_transaksi" id="bukti_transaksi" accept="image/*" required="">
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
