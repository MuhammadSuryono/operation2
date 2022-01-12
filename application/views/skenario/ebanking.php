<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Skenario E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Skenario E-Banking</strong></h4>
                <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>


                <form action="<?= base_url('skenario/tambah_ebanking')?>" method="post">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-sm-12">
                    <a href="<?= base_url('skenario/transaksi_ebanking')?>" class="btn btn-warning">Daftar Transaksi</a>

                    <a href="<?= base_url('skenario/rekening_ebanking')?>" class="btn btn-danger">Daftar Sumber & Tujuan</a>

                    <a href="<?= base_url('skenario/aplikasi_ebanking')?>" class="btn btn-info">Daftar Aplikasi</a>

                    <a href="<?= base_url('skenario/shopper_ebanking')?>" class="btn" style="background-color: #BA55D3; color: white;">Daftar Shopper</a>

                    
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
                        <select name="channel" id="channel" class="selectpicker form-control" data-live-search="true" required>
                            <option value=""> Pilih Channel </option>
                            <option value="SMS Banking">SMS Banking</option>
                            <option value="Internet Banking">Internet Banking</option>
                            <option value="Mobile Banking">Mobile Banking</option>
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <select name="transaksi" id="transaksi" class="selectpicker form-control" data-live-search="true" required>
                            <option value=""> Pilih Transaksi </option>
                            <?php foreach($gettransaksi as $gtr) :?>
                            <option value="<?=$gtr['kode']?>"> <?= $gtr['nama']?> </option>
                            <?php endforeach?>
                        </select>
                    </div>

                    <section id="jumlah_trk"><label class="col-lg-2 control-label jumlah"></label></section>

                    <div class="col-md-3">
                      <button type="button" id="buatskenario_ebanking" name="buatskenario" class="btn btn-round btn-primary pull-right"><i class="fa fa-plus fa-fw"></i> Tambah Waktu Transaksi </button>
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
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Skenario E-Banking</strong></h4>

                <section id="unseen">
                <form action="" method="POST">
                <div class="row mb">
                <div class="col-md-2">
                    <select class="selectpicker form-control" name="validasi_project" id="sken_project"  data-live-search="true">
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
                     <select class="selectpicker form-control" name="validasi_channel" id="sken_channel"  data-live-search="true">
                                  <option value="">--Pilih Channel--</option>
                                  
                                  <option value="Internet Banking">Internet Banking</option>
                                  <option value="Mobile Banking">Mobile Banking</option>
                                  <option value="SMS Banking">SMS Banking</option>
                                
                      </select>
                </div>
                <div class="col-md-2" id="div_sken_transaksi">
                  <input type="hidden" name="validasi_transaksi" id="validasi_transaksi" value="">
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
                $channel = $_POST['validasi_channel'];
                $transaksi = $_POST['validasi_transaksi'];
                

      if ($id != '' AND $bank != '' AND $channel != '' AND $transaksi != '') {
          
            $search = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_transaksi,
                                        d.nama AS nama_project
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        AND a.bank = '$bank'
                                        AND a.channel = '$channel'
                                        AND a.transaksi = '$transaksi'
                                        ")->result_array();
        } else if ($id != '' AND $bank != '' AND $channel != '' AND $transaksi == '') {
          
            $search = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_transaksi,
                                        d.nama AS nama_project
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        AND a.bank = '$bank'
                                        AND a.channel = '$channel'
                                        -- AND a.transaksi = '$transaksi'
                                        ")->result_array();
        } else if ($id != '' AND $bank != '' AND $channel == '' AND $transaksi == '') {
          
            $search = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_transaksi,
                                        d.nama AS nama_project
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        AND a.bank = '$bank'
                                        -- AND a.channel = '$channel'
                                        -- AND a.transaksi = '$transaksi'
                                        ")->result_array();
        } else if ($id != '' AND $bank == '' AND $channel == '' AND $transaksi == '') {
          
            $search = $this->db->query("SELECT a.*,
                                        b.nama AS nama_bank,
                                        c.nama AS nama_transaksi,
                                        d.nama AS nama_project
                                        FROM ebanking a
                                        LEFT JOIN bank b ON a.bank=b.kode
                                        LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                                        LEFT JOIN project d ON a.project=d.kode
                                        WHERE project='$id'
                                        -- AND a.bank = '$bank'
                                        -- AND a.channel = '$channel'
                                        -- AND a.transaksi = '$transaksi'
                                        ")->result_array();
        }
                ?>
                  <div class="table-responsive">
              <form action="<?= base_url('skenario/delete_ebanking')?>" method="post">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTablesnya">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th><center>Nama Project</center></th>
                      <th><center>Nama Bank</center></th>
                      <th><center>Channel</center></th>
                      <th><center>Transaksi</center></th>
                      <th><center>System</center></th>
                      <th><center>Provider</center></th>
                      <th><center>Waktu</center></th>
                      <th><center>Transaksi Ke-</center></th>
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
                         <td><center><?= $db['channel']?><center></td>
                         <td><center><?= $db['nama_transaksi']?><center></td>
                         <td><center><?= $db['os']?><center></td>
                         <td><center><?= $db['provider']?><center></td> 
                         <td><center><?= $db['hari']." - ".$db['waktu']?><center></td>
                         <td><center><?= $db['trx_ke']?><center></td>
                         <?php if ($db['status'] == 0) {
                           ?>
                           <td><center><input type="checkbox" name="ebanking[]" id="checknya" value="<?= $db['num']?>"><center></td>
                           <?php } else { ?>
                            <td><center>Sudah Aktual</center></td>
                          <?php } ?>
                         </tr>

                    <?php endforeach?>
                  </tbody>
                </table>
                <?php if($search != NULL) { ?>
                <div class="col-sm-12 text-right">
                  <input type="checkbox" id="check_all" onchange="checkAll(this)">&nbsp; <b>Check All</b>
                  <button type="submit" name="delete" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> Delete</button>
                </div>
                <?php } ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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

               $('#dataTablesnya').dataTable({
                   "responsive": true,
                   "searching": true,
                   "ordering": true,
                   "info": true,
                   "scrollY": "",
                   "scrollCollapse": true,
                   "paging": true,
                   "lengthMenu": [
                     [10, 25, 50, 100, -1],
                     [10, 25, 50, 100, "All"]
                   ]
                 });
             });


  function checkAll(box) 
  {
   let checkboxes = document.querySelectorAll("[id='checknya']");
if (box.checked) { // jika checkbox teratar dipilih maka semua tag input juga dipilih
    for (let i = 0; i < checkboxes.length; i++) {
     if (checkboxes[i].type == 'checkbox') {
      checkboxes[i].checked = true;
     }
    }
   } else { // jika checkbox teratas tidak dipilih maka semua tag input juga tidak dipilih
    for (let i = 0; i < checkboxes.length; i++) {
     if (checkboxes[i].type == 'checkbox') {
      checkboxes[i].checked = false;
     }
    }
   }
  }
         
</script>