    <!--main content start-->
   <!--  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data1" data-flashdata="<?= $this->session->flashdata('info1'); ?>"></div> -->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Validasi Data Evaluasi </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Validasi Evaluasi Sosial Media  </strong></h4>
                    <section id="unseen">
                       <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
                       <div class="flash-data" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
                        <div class="flash-data2" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                        <div class="flash-data1" data-flashdata="<?= $this->session->flashdata('info1'); ?>"></div>
                    <!-- <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example"> -->
                    <div class="table-responsive">
                    <table class=" table table-bordered table-striped" id="data_kunjungan_validasi">
                    <thead>
                         <?php if ($db['status'] == 1) {
                          ?>
                        <tr id="bk_eb" style="background-color: #DC143C; color:white;">
                        <?php } else if ($db['status'] == 3) {
                          ?>
                        <tr id="bk_eb" style="background-color: #00BFFF; ">
                        <?php } else {
                          ?>
                        <tr id="bk_eb">
                        <?php } ?>
                        <th><center>No<center></th>
                        <th><center>Project<center></th>
                        <th><center>Bank<center></th>
                        <th><center>Platform<center></th>
                        <th><center>Skenario<center></th>
                        <th><center>Waktu<center></th>
                        <th><center>Evaluasi Ke-<center></th>
                        <th><center>Nama Shopper<center></th>
                        <th><center>Nama Akun Sosial Media Pengirim<center></th>
                        <?php if($db['platform'] == 'Facebook') { ?>
                            <th><center>Page Name Bank<center></th>
                        <?php } else { ?>
                            <th><center>Username Bank<center></th>
                        <?php } ?>
                        <th><center>User Input<center></th>
                        <th><center>Tanggal Evaluasi<center></th>
                        <th><center>Jam Mulai<center></th>
                        <th><center>Total TD<center></th>
                        <!-- <?php if ($db['status'] == 1) {
                          ?>
                        <th id="bk_eb" style="background-color: #DC143C;">
                        <?php } else if ($db['status'] == 3) {
                          ?>
                        <th id="bk_eb" style="background-color: #22b540;">
                        <?php } else {
                          ?>
                        <th id="bk_eb">
                        <?php } ?>
                          <center>Bukti Transaksi<center></th> -->
                        <th><center>Aksi<center></th>
                        
                        </tr>
                    </thead>
                    <tbody>
                            <tr style="background-color : #e2e4ff;">
                                <td>1.</td>
                                <td><?= $db['nama_project']?></td>
                                <td><?= $db['nama_bank']?></td>
                                <td><?= $db['platform']?></td>
                                <td><?= $db['nama_skenario']?></td>
                                <td><?= $db['hari']." - ".$db['waktu']?></td>
                                <td><?= $db['trx_ke']?></td>
                                <td><?= $db['shopper']?></td>
                                <td><?= $db['sosmed_pengirim']?></td>
                                <td><?= $db['sosmed_bank']?></td>
                                <?php if ($db['nama_input'] != NULL) {
                                  ?>
                                <td><?= $db['user_input']." - ".$db['nama_input']?></td>
                              <?php } else { ?>
                                <td><?= $db['user_input']." - ".$db['nama_shp']?></td>
                              <?php } ?>
                                <td><?= $db['tanggal_evaluasi']?></td>
                                <td><?= $db['jam_mulai']?></td>
                                </td>
                                 <?php if ($db['total_td'] == 1) { $kalimat = 'Kurang dari 30 menit'; }
                                 else if ($db['total_td'] == 2) { $kalimat = '31 menit - 1 jam'; }
                                 else if ($db['total_td'] == 3) { $kalimat = '1 - 24 jam (respons diterima dalam hari yang sama)'; }
                                 else if ($db['total_td'] == 2) { $kalimat = '31 menit - 1 jam'; }
                                 else if ($db['total_td'] == 4) { $kalimat = 'H+1'; }
                                 else if ($db['total_td'] == 5) { $kalimat = 'H+2'; }
                                 else if ($db['total_td'] == 6) { $kalimat = 'H+3'; }
                                 else if ($db['total_td'] == 99) { $kalimat = 'Belum ada respons sama sekali hingga H+4'; }
                                  ?>
                                <td><?= $kalimat ?></td>
                                <!-- <td><a class="fancybox" href="<?= base_url('assets/')?>file/memo/<?= $db['upload_bukti']?>"><?= $db['upload_bukti']?></a></td> -->
                                <td data-trigger="hover" data-toggle="popover" data-placement="top" title="Info" data-content="Isi form validasi terlebih dahulu, jika semua telah 'Sesuai' maka tombol Valid akan aktif">
                                 <button onclick="valid(<?= $db['num']?>);" id="btn_valideb1" align="center" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem; " disabled><span class="fa fa-check fa-fw"></span> Valid </button><br>
                                 <?php
                                 if ($db['status'] != 3) {
                                    ?>
                                 <a class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#tolak<?= $db['num']?>"><span class="fa fa-times fa-fw"></span> Tolak </a>
                               <?php 
                                } ?>
                               </td>
                            </tr>
                    </tbody>
                    </table>
                  </div>
                   <!--  <h5><span class="fa fa-square fa-fw text"></span>-- Belum divalidasi</h5>
                    <h5><span class="fa fa-square fa-fw text-danger"></span>-- Ditolak</h5>
                    <h5><span class="fa fa-square fa-fw text-success"></span>-- Diterima</h5> -->
                </section>

                </div>
            </div>
          </div>
          <?php
                      $g_awal = unserialize($db['greeting_awal']); $num_awal = count($g_awal);
                      $g_akhir = unserialize($db['greeting_akhir_before']); $num_akhir = count($g_akhir);
                      $g_akhir_after = unserialize($db['greeting_akhir_after']); $num_after = count($g_akhir_after);


                      $img = unserialize($db['upload_bukti']);
                      $num = count($img) ?>

        <div class="row">
            <div class="col-lg-6">
              <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> DETAIL  </strong></h4>
                        <div class="table-responsive">
                            <table class="table">
                            <tr>
                              <td><b>Greeting Awal</b></td>
                              <td><b>:</b></td>
                              <td><?php
                                  for ($i=0; $i <$num_awal ; $i++) { 
                                    if ($g_awal[$i] == NULL OR $g_awal[$i] == '') {
                                      continue;
                                    }
                                      $kat = $this->db->get_where('sosmed_greeting', array('score' => $g_awal[$i]))->row_array();
                                      if ($kat == NULL) {
                                        echo $g_awal[$i]."<br>";
                                      } else {
                                        echo "<i class='fas fa-arrow-circle-right'></i> ".$kat['greeting']."<br>";
                                      }
                                   } ?>
                              </td>
                            </tr>
                            <tr>
                              <td><b>Greeting Akhir (Sebelum balas OK)</b></td>
                              <td><b>:</b></td>
                              <td><?php
                                  for ($i=0; $i <$num_akhir ; $i++) { 
                                    if ($g_akhir[$i] == NULL OR $g_akhir[$i] == '') {
                                      continue;
                                    }
                                      $kat = $this->db->get_where('sosmed_greeting', array('score' => $g_akhir[$i]))->row_array();
                                      if ($kat == NULL) {
                                        echo $g_akhir[$i]."<br>";
                                      } else {
                                        echo "<i class='fas fa-arrow-circle-right'></i> ".$kat['greeting']."<br>";
                                      }
                                   } ?>
                              </td>
                            </tr>
                            <tr>
                              <td><b>Greeting Akhir (Setelah balas OK)</b></td>
                              <td><b>:</b></td>
                              <td><?php
                                  for ($i=0; $i <$num_after ; $i++) { 
                                    // echo $g_akhir_after[$i];
                                    if ($g_akhir_after[$i] == NULL OR $g_akhir_after[$i] == '') {
                                      continue;
                                    }
                                      $kat = $this->db->get_where('sosmed_greeting', array('score' => $g_akhir_after[$i]))->row_array();
                                      if ($kat == NULL) {
                                        echo "<i class='fas fa-arrow-circle-right'></i> ".$g_akhir_after[$i]."<br>";
                                      } else {
                                        echo "<i class='fas fa-arrow-circle-right'></i> ".$kat['greeting']."<br>";
                                      }
                                   } ?>
                              </td>
                            </tr>
                            <tr>
                              <td><b>Respon Agent</b></td>
                              <td><b>:</b></td>
                              <td><?= $db['respon_agent'] ?></td>
                            </tr>
                            <tr>
                              <td><b>Waktu Pengiriman Pesan</b></td>
                              <td><b>:</b></td>
                              <td><?= date('d/m/Y, H:i:s', strtotime($db['waktu_kirim'])) ?></td>
                            </tr>
                            <tr>
                              <td><b>Waktu Pesan Dibalas Oleh Staff</b></td>
                              <td><b>:</b></td>
                              <td><?php if($db['waktu_balas'] != NULL) { echo date('d/m/Y, H:i:s', strtotime($db['waktu_balas'])); } ?></td>
                            </tr>
                            <tr>
                              <td><b>Aktual Time Delivery</b></td>
                              <td><b>:</b></td>
                              <td><?= $db['aktual_td'] ?></td>
                            </tr>
                            <tr>
                              <td><b>Respons otomatis yang dikirimkan bahwa staf bank sedang offline/tidak beroperasi?</b></td>
                              <td><b>:</b></td>
                              <td><?php
                              if($db['respon_otomatis'] == 1){$word ='Ada';}
                              else if($db['respon_otomatis'] == 2){$word ='Tidak Ada';}
                              else if($db['respon_otomatis'] == 99){$word ='Time delivery < 1 jam';}

                                echo $word;
                                if ($db['respon_otomatis'] == 1) {
                                  echo "<br>(".$db['verbatim_respon'].")";
                                }
                                ?></td>
                            </tr>

                            <tr>
                              <td><b>Temuan</b></td>
                              <td><b>:</b></td>
                              <td><?= $db['temuan'] ?></td>
                            </tr>
                            </table>
                        </div>
                          
                      </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> EVIDENCE EVALUASI  </strong></h4>
                        <?php
                          for ($i=0; $i <$num ; $i++) { 
                        ?>
                        <a target="_blank" href="<?= base_url('assets/')?>file/buktitrk/<?= $img[$i]?>">
                          <img width="100%" src="<?= base_url('assets/')?>file/buktitrk/<?= $img[$i]?>" s>
                        </a>
                      <?php } ?>
                          
                      </div>
                    </div>                    
                    
            </div>
          </div>


        <div class="col-lg-6">
              <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> ISI FORM VALIDASI </strong></h4>
                          <div class="table-responsive">
                            <table class="table">
                              <?php 
                              $cek_form = $this->db->get_where('sosmed_form_validasi', ['num_sos' => $db['num']])->row_array();
                              ?>
                             
                              <tr>
                                <td width="300px">1. Apakah <strong>platform</strong> yang digunakan untuk evaluasi sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_platform" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_platform" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['platform'] == '1') { ?>
                                <td><input type="radio" name="val_platform" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_platform" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_platform" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_platform" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                               <tr>
                                <td width="300px">2. Apakah <strong><?php if($db['platform'] == 'Facebook'){echo "bank dan page name bank";} else {echo "bank dan username bank";} ?></strong> untuk evaluasi sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_tujuan" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['tujuan'] == '1') { ?>
                                <td><input type="radio" name="val_tujuan" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_tujuan" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">3. Apakah <strong>jenis skenario</strong> yang dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_skenario" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_skenario" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['skenario'] == '1') { ?>
                                <td><input type="radio" name="val_skenario" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_skenario" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_skenario" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_skenario" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">4. Apakah <strong>hari</strong> evaluasi yang dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_hari" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_hari" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['hari'] == '1') { ?>
                                <td><input type="radio" name="val_hari" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_hari" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_hari" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_hari" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">5. Apakah <strong>tanggal</strong> evaluasi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload) </td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_tanggal" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['tanggal'] == '1') { ?>
                                <td><input type="radio" name="val_tanggal" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_tanggal" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">6. Apakah <strong>jam</strong> evaluasi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_jam" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_jam" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['jam'] == '1') { ?>
                                <td><input type="radio" name="val_jam" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_jam" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_jam" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_jam" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">7. Apakah <strong>greeting awal</strong> yang diterima saat evaluasi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_greetawal" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_greetawal" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['greetawal'] == '1') { ?>
                                <td><input type="radio" name="val_greetawal" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_greetawal" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_greetawal" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_greetawal" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">8. Apakah <strong>greeting akhir (sebelum balas OK)</strong> yang diterima saat evaluasi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_greetakhir" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_greetakhir" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['greetakhir'] == '1') { ?>
                                <td><input type="radio" name="val_greetakhir" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_greetakhir" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_greetakhir" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_greetakhir" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">9. Apakah <strong>greeting akhir (setelah balas OK)</strong> yang diterima saat evaluasi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_greetakhir_after" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_greetakhir_after" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['greetakhir_after'] == '1') { ?>
                                <td><input type="radio" name="val_greetakhir_after" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_greetakhir_after" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_greetakhir_after" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_greetakhir_after" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">10. Apakah <strong>respon agent</strong> yang diterima saat evaluasi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_responagent" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_responagent" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['responagent'] == '1') { ?>
                                <td><input type="radio" name="val_responagent" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_responagent" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_responagent" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_responagent" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">11. Apakah <strong>waktu pengiriman pesan</strong> pada saat evaluasi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_waktukirim" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_waktukirim" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['waktukirim'] == '1') { ?>
                                <td><input type="radio" name="val_waktukirim" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_waktukirim" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_waktukirim" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_waktukirim" id="for_sosmed" value="2" checked> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">12. Apakah <strong>waktu pesan dibalas oleh staff</strong> pada saat evaluasi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_waktubalas" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_waktubalas" id="for_sosmed" value="2"> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['waktubalas'] == '1') { ?>
                                <td><input type="radio" name="val_waktubalas" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_waktubalas" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_waktubalas" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_waktubalas" id="for_sosmed" value="2" checked> Tidak Sesuai</td>
                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">13. Apakah terdapat <strong>respon otomatis</strong> yang dikirimkan bahwa staf bank sedang offline/tidak beroperasi? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="3"> N/A</td>
                                
                              <?php } else {
                              if ($cek_form['responotomatis'] == '1') { ?>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="1" checked> Sesuai</td>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="3"> N/A</td>
                                
                               <?php } else if ($cek_form['responotomatis'] == '2') { ?>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="2" checked> Tidak Sesuai</td>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="3"> N/A</td>

                              <?php } else { ?>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="1"> Sesuai</td>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="2"> Tidak Sesuai</td>
                                <td><input type="radio" name="val_responotomatis" id="for_sosmed" value="3" checked=""> N/A</td>
                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td colspan="4">
                                  <button onclick="valid(<?= $db['num']?>);" id="btn_valideb2" align="center" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem; " disabled><span class="fa fa-check fa-fw"></span> Valid </button>
                                  <?php
                                 if ($db['status'] != 3) {
                                    ?>
                                 <a class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#tolak<?= $db['num']?>"><span class="fa fa-times fa-fw"></span> Tolak </a>
                               <?php } ?>
                                </td>

                              </tr>
                              <?php if ($db['status'] == '1' OR $db['status'] == '3') {
                                ?>
                              <tr>
                                <td colspan="4"><a class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#reset<?= $db['num']?>"><i class="fas fa-undo"></i> Reset Riwayat Validasi </a></td>
                              </tr>
                            <?php } ?>
                            
                            </table>
                          </div>
                      </div>
                    </div>
            </div>
        </div>
     

         <!--  <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <div style="text-align:center;">
                    <button type="submit" class="btn btn-round btn-success"> Simpan</button>
                </div>
                </div>
            </div>
          </div> -->
          </form>
          </div>


          
   

        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

     <!-- Modal TOLAK-->
                                <div class="modal fade" id="tolak<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Data Evaluasi Sosial Media</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="<?=base_url('validasi/tolak_sosmed')?>" class="form-horizontal style-form" method="post">
                                              <input type="hidden"  name="id" id="id" value="<?=$db['num']?>">

                                              <input type="hidden" name="platform" id="in_platform">
                                              <input type="hidden" name="tujuan" id="in_tujuan">
                                              <input type="hidden" name="skenario" id="in_skenario">
                                              <input type="hidden" name="tanggal" id="in_tanggal">
                                              <input type="hidden" name="hari" id="in_hari">
                                              <input type="hidden" name="jam" id="in_jam">
                                              <input type="hidden" name="greetawal" id="in_greetawal">
                                              <input type="hidden" name="greetakhir" id="in_greetakhir">
                                              <input type="hidden" name="greetakhir_after" id="in_greetakhir_after">
                                              <input type="hidden" name="responagent" id="in_responagent">
                                              <input type="hidden" name="waktukirim" id="in_waktukirim">
                                              <input type="hidden" name="waktubalas" id="in_waktubalas">
                                              <input type="hidden" name="responotomatis" id="in_responotomatis">

                                              
                                          <div class="form-group">
                                            <label class="col-sm-12 control-label">Keterangan : </label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Penolakan disini..." required></textarea>
                                              <br>
                                            </div>
                                          </div>
                                      </div>
                                        <div class="row">
                                          <div class="col-sm-12 ">
                                            <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save</button>
                                            <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>

                                        </form>
                                    </div>
                                  </div>
                                </div>

<!-- MODAL RESET -->
<div class="modal fade" id="reset<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reset Riwayat Validasi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="<?=base_url('validasi/reset_sosmed')?>" class="form-horizontal style-form" method="post">
                                              <input type="hidden"  name="id" id="id" value="<?=$db['num']?>">
                                              
                                          <div class="form-group">
                                            <label class="col-sm-12 control-label">Keterangan : </label>
                                            <div class="col-sm-12">
                                            <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Catatan Kesalahan Validasi Sebelumnya disini..." required></textarea>
                                              <br>
                                            </div>
                                          </div>
                                      </div>
                                        <div class="row">
                                          <div class="col-sm-12 ">
                                            <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save</button>
                                            <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>

                                        </form>
                                    </div>
                                  </div>
                                </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


    <script>

      

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });


    function dialog(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasidialog')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
            console.log(hasil);
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.dialog').css("background-color", "#22b540");
          }
      });
    }

    function tdialog(id){
        $.ajax({
          url:"<?= base_url('validasi/tolakdialog')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.dialog').css("background-color", "#dc3545");
          }
      });
    }

    function valid(id){

            var platform = $('input[type=radio][name="val_platform"]:checked').val();
           var tujuan = $('input[type=radio][name="val_tujuan"]:checked').val();
           var skenario = $('input[type=radio][name="val_skenario"]:checked').val();
           var tanggal = $('input[type=radio][name="val_tanggal"]:checked').val();
           var hari = $('input[type=radio][name="val_hari"]:checked').val();
           var jam = $('input[type=radio][name="val_jam"]:checked').val();
           var greetawal = $('input[type=radio][name="val_greetawal"]:checked').val();
           var greetakhir = $('input[type=radio][name="val_greetakhir"]:checked').val();
           var greetakhir_after = $('input[type=radio][name="val_greetakhir_after"]:checked').val();
           var responagent = $('input[type=radio][name="val_responagent"]:checked').val();
           var waktukirim = $('input[type=radio][name="val_waktukirim"]:checked').val();
           var waktubalas = $('input[type=radio][name="val_waktubalas"]:checked').val();
           var responotomatis = $('input[type=radio][name="val_responotomatis"]:checked').val();





           

        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasi_sosmed')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id,
             platform: platform,
            tujuan : tujuan,
            skenario : skenario,
            tanggal : tanggal,
            hari : hari,
            jam : jam,
           greetawal : greetawal,
            greetakhir : greetakhir,
            greetakhir_after : greetakhir_after,

            responagent : responagent,
            waktukirim : waktukirim,
            waktubalas : waktubalas,
            responotomatis : responotomatis
          },
          success:function(hasil){
            console.log(bank);
            console.log(tanggal);
            console.log(hari);
            console.log(transaksi);
            console.log(jam);
            Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            console.log(hasil);
              
            $('#bk_eb').css("background-color", "#00BFFF");
          }
      });
        window.location.reload();

        
    }

    function trekaman(id){
        $.ajax({
          url:"<?= base_url('validasi/tolakrekaman')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.rekaman').css("background-color", "#dc3545");
          }
      });
    }

    function layout(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasilayout')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.layout').css("background-color", "#22b540");
          }
      });
    }

    function tlayout(id){
        $.ajax({
          url:"<?= base_url('validasi/tolaklayout')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.layout').css("background-color", "#dc3545");
          }
      });
    }

    function ss(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasiss')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.ss').css("background-color", "#22b540");
          }
      });
    }

    function tss(id){
        $.ajax({
          url:"<?= base_url('validasi/tolakss')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.ss').css("background-color", "#dc3545");
          }
      });
    }

    function transaksi(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasitransaksi')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.transaksi').css("background-color", "#22b540");
          }
      });
    }

    function ttransaksi(id){
        $.ajax({
          url:"<?= base_url('validasi/tolaktransaksi')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.transaksi').css("background-color", "#dc3545");
          }
      });
    }
    </script>
