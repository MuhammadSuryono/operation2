<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Skenario Evaluasi Sosial Media</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Skenario Evaluasi Sosial Media</strong></h4>
                <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>


                <form action="<?= base_url('skenario/tambah_sosmed')?>" method="post">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <a href="<?= base_url('skenario/skenario_sosmed')?>" class="btn btn-warning">Daftar Skenario</a>
                    <a href="<?= base_url('skenario/greeting_sosmed')?>" class="btn btn-info">Daftar Greeting</a>
                    <a href="<?= base_url('skenario/akun_sosmed')?>" class="btn btn-primary">Daftar Akun</a>



                    <!-- <a href="<?= base_url('skenario/rekening_ebanking')?>" class="btn btn-danger">Daftar Sumber & Tujuan</a>

                    <a href="<?= base_url('skenario/aplikasi_ebanking')?>" class="btn btn-info">Daftar Aplikasi</a>

                    <a href="<?= base_url('skenario/shopper_ebanking')?>" class="btn" style="background-color: #BA55D3; color: white;">Daftar Shopper</a> -->

                    
                  </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-sm-3">
                        <select name="project1" id="project1" class="selectpicker form-control" data-live-search="true" required>
                            <option value=""> Pilih Project </option>
                            <?php foreach($project as $pr) :?>
                            <option value="<?=$pr['kode_project']?>"> <?= $pr['nama_project']?> </option>
                            <?php endforeach?>
                        </select>
                    </div>
                

                  <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pilihbank" style="width: 100%;">Pilih Bank</button>
                        <!-- Modal -->
                          <div class="modal fade" id="pilihbank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="width: 70%;">
                              <div class="modal-content" >
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Pilih Bank Untuk Skenario</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <?php foreach ($bank as $key) {
                                      ?>
                                      <div class="col-sm-4"><input type="checkbox" name="bank[]" value="<?= $key['kode'] ?>">&nbsp; <?= $key['nama'] ?></div>
                                    <?php } ?>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                                  <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                </div>
                              </div>
                            </div>
                          </div>
                        <!-- <select name="bank" class="selectpicker form-control" data-live-search="true" required>
                            <option value="">Nama Bank </option>
                            <?php foreach($bank as $key) :?>
                            <option value="<?=$key['kode']?>"> <?= $key['nama']?> </option>
                            <?php endforeach?>
                        </select> -->
                  </div>
                

                    <div class="col-sm-2">
                        <select name="platform" id="platform" class="selectpicker form-control" data-live-search="true" required>
                            <option value=""> Pilih Platform </option>
                            <option value="Facebook">Facebook</option>
                            <option value="Instagram">Instagram</option>
                            <option value="Twitter">Twitter</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <select name="skenario" id="skenario" class="selectpicker form-control" data-live-search="true" required>
                            <option value=""> Pilih Skenario </option>
                            <?php foreach($getskenario as $gtr) :?>
                            <option value="<?=$gtr['kode']?>"> <?= $gtr['nama']?> </option>
                            <?php endforeach?>
                        </select>
                    </div>

                    <section id="jumlah_trk"><label class="col-lg-2 control-label jumlah"></label></section>

                    <div class="col-md-3">
                      <button type="button" id="buatskenario_ebanking" name="buatskenario" class="btn btn-round btn-primary pull-right"><i class="fa fa-plus fa-fw"></i> Tambah Waktu Evaluasi </button>
                    </div>

                </div>
                <br>

                <div class="row" id="op_system">
                  <!-- <div class="col-sm-2"><h5>Operating System : </h5></div>
                  <div class="col-sm-1">
                    <input type="checkbox" name="os[]" id="os1" value="Android">  <label for="os1">Android</label>
                  </div>
                  <div class="col-sm-1">
                    <input type="checkbox" name="os[]" id="os1" value="IoS">  <label for="os1">IoS</label>
                  </div> -->
                </div>

                <div class="row" id="provider">
                  <!-- <div class="col-sm-2"><h5>Provider : </h5></div>
                  <div class="col-sm-1">
                    <input type="checkbox" name="provider[]" id="provider1" value="Telkomsel">  <label for="os1">Telkomsel</label>
                  </div>
                  <div class="col-sm-1">
                    <input type="checkbox" name="provider[]" id="provider1" value="XL">  <label for="os1">XL</label>
                  </div>
                  <div class="col-sm-1">
                    <input type="checkbox" name="provider[]" id="provider1" value="Indosat">  <label for="os1">Indosat</label>
                  </div> -->
                </div>
              </div>

          <br>
          <section id="allskenario_trk">

            <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
          </section>

                <br>
                  <button type="submit" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Simpan </button>
                </form>
              </div>
            </div>

                
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Skenario Evaluasi Sosial Media</strong></h4>

                <section id="unseen">
                <form action="" method="POST">
                <div class="row mb">
                <div class="col-md-2">
                    <select class="selectpicker form-control" name="validasi_project" id="sken2_project"  data-live-search="true">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <!-- <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option> -->
                        <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="selectpicker form-control" name="validasi_bank" id="sken_bank" data-live-search="true">
                        <option value=""> Pilih Bank</option>
                        <?php foreach($bank as $bk):?>
                        <!-- <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option> -->
                        <option value="<?=$bk['kode']?>"> <?=$bk['nama']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                     <select class="selectpicker form-control" name="validasi_platform" id="sken_platform"  data-live-search="true">
                                  <option value="">--Pilih Platform--</option>
                                  
                                  <option value="Facebook">Facebook</option>
                                  <option value="Instagram">Instagram</option>
                                  <option value="Twitter">Twitter</option>
                                
                      </select>
                </div>
                <div class="col-md-2" id="div_sken_transaksi">
                  <input type="hidden" name="validasi_transaksi" id="validasi_skenario" value="">
                </div>

                <div class="col-md-2">
                <button type="submit" name="search_skenario"  class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Cari Skenario </button>
                </div>

                </div>
              </form>

              <?php
               if (isset($_POST['search_skenario'])) { 
                $id = $_POST['validasi_project'];
                $bank = $_POST['validasi_bank'];
                $platform = $_POST['validasi_platform'];
                $skenario = $_POST['validasi_skenario'];
                

      if ($id != '' AND $bank != '' AND $platform != '' AND $skenario != '') {
          
            $search = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_skenario,
                                        d.nama AS nama_project
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        AND a.bank = '$bank'
                                        AND a.platform = '$platform'
                                        AND a.skenario = '$skenario'
                                        ")->result_array();
        } else if ($id != '' AND $bank != '' AND $platform != '' AND $skenario == '') {
          
            $search = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_skenario,
                                        d.nama AS nama_project
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        AND a.bank = '$bank'
                                        AND a.platform = '$platform'
                                        -- AND a.transaksi = '$transaksi'
                                        ")->result_array();
        } else if ($id != '' AND $bank != '' AND $platform == '' AND $skenario == '') {
          
            $search = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_skenario,
                                        d.nama AS nama_project
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        AND a.bank = '$bank'
                                        -- AND a.channel = '$channel'
                                        -- AND a.transaksi = '$transaksi'
                                        ")->result_array();
        } else if ($id != '' AND $bank == '' AND $platform == '' AND $skenario == '') {
          
            $search = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_skenario,
                                        d.nama AS nama_project
                                        FROM sosmed a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN sosmed_skenario c ON a.skenario=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        -- AND a.bank = '$bank'
                                        -- AND a.channel = '$channel'
                                        -- AND a.transaksi = '$transaksi'
                                        ")->result_array();
        }
                ?>
                  <div class="table-responsive">
              <form action="<?= base_url('skenario/delete_sosmed')?>" method="post">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th><center>Nama Project</center></th>
                      <th><center>Nama Bank</center></th>
                      <th><center>Platform</center></th>
                      <th><center>Skenario</center></th>
                      <th><center>Waktu</center></th>
                      <th><center>Evaluasi Ke-</center></th>
                      <th><center>Delete</center></th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; foreach($search as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td><center>
                      <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;"><center>
                      <?php endif?>
                         <?= ++$no?><center></td>
                         <td><center><?= $db['nama_project']?><center></td>
                         <td><center><?= $db['nama_bank']?><center></td> 
                         <td><center><?= $db['platform']?><center></td>
                         <td><center><?= $db['nama_skenario']?><center></td>
                         <td><center><?= $db['hari']." - ".$db['waktu']?><center></td>
                         <td><center><?= $db['trx_ke']?><center></td>
                         <?php if ($db['status'] == 0) {
                           ?>
                           <td><center><input type="checkbox" name="sosmed[]" value="<?= $db['num']?>"><center></td>
                           <?php } else { ?>
                            <td><center>Sudah Aktual</center></td>
                          <?php } ?>
                         </tr>

                    <?php endforeach?>
                  </tbody>
                </table>
                <div class="col-sm-12 text-right">
                  <button type="submit" name="delete" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> Delete</button>
                </div>
              </form>
              </div>
            <?php
             } ?>
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
<script type="text/javascript">
 $(document).ready(function() {


               $('#dataTables-example-3').dataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": false,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": false
               });
             }
         
</script>