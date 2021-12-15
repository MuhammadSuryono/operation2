    <!--main content start-->
   <!--  <div class="flash-data" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <div class="flash-data1" data-flashdata="<?= $this->session->flashdata('info1'); ?>"></div> -->
  <?php
    $akses = $this->session->userdata('id_divisi');
  ?>
    <section id="main-content">
      <section class="wrapper site-min-height">
        <?php if ($akses == 1) { ?>
          <h3><i class="fa fa-angle-right"></i> Detail Data Aktual E-Banking</h3>
        <?php } else { ?>
          <h3><i class="fa fa-angle-right"></i> Validasi Data E-Banking</h3>
        <?php } ?>
         <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
              <?php if ($akses == 1) { ?>
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Aktual E-Banking</strong></h4>
              <?php } else { ?>
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Validasi E-Banking</strong></h4>
              <?php } ?>
              <input type="hidden" name="divisi" id="divisi" value="<?= $akses ?>">
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
                        <th><center>Channel<center></th>
                        <th><center>Transaksi<center></th>
                        <th><center>System<center></th>
                        <th><center>Provider<center></th>
                        <th><center>Waktu<center></th>
                        <th><center>Transaksi Ke-<center></th>
                        <th><center>Nama Shopper<center></th>
                        <th><center>No Rekening<center></th>
                        <th><center>No Tujuan Transaksi<center></th>
                          
                        <th><center>User Input<center></th>
                        <th><center>Tanggal Evaluasi<center></th>
                        <th><center>Jam Mulai<center></th>
                        <th><center>Jam Selesai<center></th>
                        <th><center>Jenis<center></th>
                        <th><center>Berhasil Percobaan Ke-<center></th>
                        <th><center>Keterangan Gagal<center></th>
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
                        <?php if($akses != 1){ ?>
                            <th><center>Aksi<center></th>
                        <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                      $ket = unserialize($db['penyebab']);
                      $num = count($ket) ?>
                            <tr style="background-color : #e2e4ff;">
                                <td>1.</td>
                                <td><?= $db['nama_project']?></td>
                                <td><?= $db['nama_bank']?></td>
                                <td><?= $db['channel']?></td>
                                <td><?= $db['nama_transaksi']?></td>
                                <td><?= $db['os']?></td>
                                <td><?= $db['provider']?></td>
                                <td><?= $db['hari']." - ".$db['waktu']?></td>
                                <td><?= $db['trx_ke']?></td>
                                <td><?= $db['shopper']?></td>
                                <td><?= $db['norek']?></td>
                                <td><?= $db['tujuan']?></td>
                                <?php if ($db['nama_input'] != NULL) {
                                  ?>
                                <td><?= $db['user_input']." - ".$db['nama_input']?></td>
                              <?php } else { ?>
                                <td><?= $db['user_input']." - ".$db['nama_shp']?></td>
                              <?php } ?>
                                <td><?= $db['tanggal_evaluasi']?></td>
                                <td><?= $db['jam_mulai']?></td>
                                <td><?= $db['jam_selesai']?></td>
                                <td><?= $db['jenis']?></td>
                                <td><?= $db['percobaan']?></td>
                                <td><?php 
                                for ($i=0; $i <$num ; $i++) { 
                                   $no = $i+1;
                                   if ($ket[$i] != null) {
                                     
                                   echo $no.". ".$ket[$i]."<br>";
                                  }

                                 } 
                                 ?></td>
                                <td><?= $db['total_td']?></td>
                                <!-- <td><a class="fancybox" href="<?= base_url('assets/')?>file/memo/<?= $db['upload_bukti']?>"><?= $db['upload_bukti']?></a></td> -->
                        <?php if($akses != 1){ ?>
                                
                                <td data-trigger="hover" data-toggle="popover" data-placement="top" title="Info" data-content="Isi form validasi terlebih dahulu, jika semua telah 'Sesuai' maka tombol Valid akan aktif">
                                 <button onclick="valid(<?= $db['num']?>);" id="btn_valideb1" align="center" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem; " disabled><span class="fa fa-check fa-fw"></span> Valid </button><br>
                                 <?php
                                 if ($db['status'] != 3) {
                                    ?>
                                 <a class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#tolak<?= $db['num']?>"><span class="fa fa-times fa-fw"></span> Tolak </a>
                               <?php 
                                } ?>
                               </td>
                        <?php } ?>
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
          if ($db['channel'] == 'Mobile Banking') {
            
          // $potong = explode(" ", $db['jenis']);
          // $data = $potong[3];
          $jenis = $db['jenis'];
          $os = $db['os'];
        } else if ($db['channel'] == 'Internet Banking') {
          $jenis = $db['jenis'];
          $os = null;
        } else {
          $jenis = null;
          $os = $db['os'];
        }
          $get_label = $this->db->query("SELECT * FROM ebanking_data_td WHERE bank='$db[bank]' AND channel='$db[channel]' AND os='$os' AND jenis='$jenis' AND transaksi='$db[transaksi]' AND versi='$db[versi_label]'")->result_array();
          ?>

        <div class="row">
            <div class="col-lg-6">
              <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> BUKTI TRANSAKSI  </strong></h4>
                        <a target="_blank" href="<?= base_url('assets/')?>file/buktitrk/<?= $db['upload_bukti']?>"><img width="100%" src="<?= base_url('assets/')?>file/buktitrk/<?= $db['upload_bukti']?>" ></a>
                          
                      </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> DETAIL TD  </strong></h4>
                          <div class="table-responsive">
                            <table class="table">
                              <?php
                              // var_dump($get_label);
                              // var_dump($db['project']);
                              // var_dump($db['bank']);
                              // var_dump($db['channel']);
                              // var_dump($db['os']);
                              // var_dump($db['transaksi']);
                              
                              // var_dump($jenis);
                              
                              
                              
                              foreach ($get_label as $get) {
                              $step = $get['step'];  
                               ?>
                              <tr>
                                <td><b><?php echo $get['label']; ?></b></td>
                                <td><b> : </b></td>
                                <td><?php echo $td['step'.$step]; ?></td>
                                <td>detik</td>
                              </tr>
                            <?php } ?>
                            </table>
                          </div>
                      </div>
                    </div>
            </div>
          </div>


        <div class="col-lg-6">
              <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <?php if ($akses == 1) { ?>
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> HASIL FORM VALIDASI </strong></h4>
                        <?php } else { ?>
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> ISI FORM VALIDASI </strong></h4>
                        <?php } ?>
                          <div class="table-responsive">
                            <table class="table">
                              <?php 
                              $cek_form = $this->db->get_where('form_validasi', ['num_eb' => $db['num']])->row_array();
                              ?>
                             
                              <tr>
                                <td width="300px">1. Apakah <strong>bank dan nomor rekening</strong> yang digunakan untuk transaksi sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_bank" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_bank" id="for_eb" class="for_eb "value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['bank'] == '1') { ?>
                                <td><input type="radio" name="val_bank" id="for_eb" class="for_eb" value="1" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_bank" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_bank" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_bank" id="for_eb" class="for_eb" value="2" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                               <tr>
                                <td width="300px">2. Apakah <strong>bank/provider dan nomor tujuan</strong> yang digunakan untuk transaksi sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="3" <?php if($akses == 1){echo "onclick='return false;'";} ?>> N/A</td>
                                
                              <?php } else {
                              if ($cek_form['tujuan'] == '1') { ?>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="1" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="3" <?php if($akses == 1){echo "onclick='return false;'";} ?>> N/A</td>
                                
                               <?php } else if ($cek_form['tujuan'] == '2') { ?>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="2" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_eb" class="for_eb" value="3" <?php if($akses == 1){echo "onclick='return false;'";} ?>> N/A</td>

                              <?php } else { ?>
                                <td><input type="radio" name="val_tujuan" id="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                <td><input type="radio" name="val_tujuan" id="for_eb" value="3" checked="" <?php if($akses == 1){echo "onclick='return false;'";} ?>> N/A</td>
                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">3. Apakah <strong>jenis transaksi</strong> yang dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_transaksi" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_transaksi" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['transaksi'] == '1') { ?>
                                <td><input type="radio" name="val_transaksi" id="for_eb" class="for_eb" value="1" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_transaksi" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_transaksi" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_transaksi" id="for_eb" class="for_eb" value="2" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">4. Apakah <strong>hari</strong> transaksi yang dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_hari" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_hari" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['hari'] == '1') { ?>
                                <td><input type="radio" name="val_hari" id="for_eb" class="for_eb" value="1" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_hari" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_hari" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_hari" id="for_eb" class="for_eb" value="2" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">5. Apakah <strong>tanggal</strong> transaksi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload) </td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="3" <?php if($akses == 1){echo "onclick='return false;'";} ?>> N/A</td>
                              <?php } else {
                              if ($cek_form['tanggal'] == '1') { ?>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="1" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="3" <?php if($akses == 1){echo "onclick='return false;'";} ?>> N/A</td>

                                
                               <?php } else if ($cek_form['tanggal'] == '2') { ?>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="2" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="3" <?php if($akses == 1){echo "onclick='return false;'";} ?>> N/A</td>

                              <?php } else { ?>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                <td><input type="radio" name="val_tanggal" id="for_eb" class="for_eb" value="3" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> N/A</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                              <tr>
                                <td width="300px">6. Apakah <strong>jam</strong> transaksi dilakukan sudah sesuai? (Antara data yang diinput dengan bukti yang diupload)</td>
                                <td><b> : </b></td>
                                <?php
                                if ($cek_form == NULL) {
                                   ?>
                                <td><input type="radio" name="val_jam" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_jam" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                              <?php } else {
                              if ($cek_form['jam'] == '1') { ?>
                                <td><input type="radio" name="val_jam" id="for_eb" class="for_eb" value="1" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_jam" id="for_eb" class="for_eb" value="2" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>
                                
                               <?php } else { ?>
                                <td><input type="radio" name="val_jam" id="for_eb" class="for_eb" value="1" <?php if($akses == 1){echo "onclick='return false;'";} ?>> Sesuai</td>
                                <td><input type="radio" name="val_jam" id="for_eb" class="for_eb" value="2" checked <?php if($akses == 1){echo "onclick='return false;'";} ?>> Tidak Sesuai</td>

                              <?php
                                    }
                               } ?>
                              </tr>
                        <?php if($akses != 1){ ?>

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
                            <?php }
                            } ?>
                            
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
                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Data E-Banking</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="<?=base_url('validasi/tolak_eb')?>" class="form-horizontal style-form" method="post">
                                              <input type="hidden"  name="id" id="id" value="<?=$db['num']?>">

                                              <input type="hidden" name="bank" id="in_bank">
                                              <input type="hidden" name="tanggal" id="in_tanggal">
                                              <input type="hidden" name="hari" id="in_hari">
                                              <input type="hidden" name="transaksi" id="in_transaksi">
                                              <input type="hidden" name="jam" id="in_jam">
                                              <input type="hidden" name="tujuan" id="in_tujuan">
                                              
                                              
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
                                        <form action="<?=base_url('validasi/reset_eb')?>" class="form-horizontal style-form" method="post">
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

    var akses = $('#divisi').val();
    // var radionya = document.querySelector("[id='for_eb']");
    var radionya =$('[id="for_eb"]');

    // if (akses == 1) {
    //   // alert(akses);
    //   console.log(radionya);
    //   for (let i = 0; i < radionya.length; i++) {
    //     console.log(radionya[i]);
    //      if (radionya[i].type == 'radio') {
    //       radionya[i].disabled = true;
    //      }
    //     }
    // }

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

            var bank = $('input[type=radio][name="val_bank"]:checked').val();
           var tanggal = $('input[type=radio][name="val_tanggal"]:checked').val();
           var hari = $('input[type=radio][name="val_hari"]:checked').val();
           var transaksi = $('input[type=radio][name="val_transaksi"]:checked').val();
           var jam = $('input[type=radio][name="val_jam"]:checked').val();
           var tujuan = $('input[type=radio][name="val_tujuan"]:checked').val();
           

        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasi_eb')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id,
            bank : bank,
            tanggal : tanggal,
            hari : hari,
            transaksi : transaksi,
            jam : jam,
            tujuan: tujuan},
          success:function(hasil){
            console.log(bank);
            console.log(tanggal);
            console.log(hari);
            console.log(transaksi);
            console.log(jam);
            
            console.log(hasil);
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
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

    </script>
