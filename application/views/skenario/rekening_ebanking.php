<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Sumber & Tujuan E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Sumber & Tujuan E-Banking</strong></h4>

                <form action="<?= base_url('skenario/tambah_ebanking')?>" method="post">
              <div class="container-fluid">
              </div>
                
          <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <br>
          <section id="allskenario_trk">

            <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
          </section>

                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_rekening">Tambah Daftar</button>

                  <!-- <button type="submit" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Simpan </button> -->
                </form>

                

                <section id="unseen">
                  <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-3">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th><center>Nama Pemilik</center></th>
                      <th><center>Bank/Provider/Aplikasi</center></th>
                      <th><center>Nomor</center></th>
                      <th><center>Kategori</center></th>
                      
                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; foreach($rekening as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td><center>
                      <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;"><center>
                      <?php endif?>
                         <?= ++$no?><center></td>
                        <td><center><?= $db['nama']?><center></td>
                        <?php if ($db['kategori'] == 'Pulsa' OR $db['kategori'] == 'E-Wallet') { ?>
                          <td><center><?= $db['bank']?><center></td>
                        <?php } else { ?>
                        <td><center><?= $db['nama_bank']?><center></td>
                        <?php } ?>
                        <td><center><?= $db['norek']?><center></td>
                        <td><center><?= $db['kategori']?><center></td>
                          
                        <td><center><a type="button" data-toggle="modal" data-target="#edit_rekening<?php echo $db['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo base_url('skenario/hapus_rekening/'.$db['id']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                        </center>
                        </td>  
                        </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
              </div>
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

<!-- Modal -->
<div class="modal fade" id="add_rekening" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Sumber & Tujuan E-Banking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/add_rekening')?>">
        <?php
        $bank = $this->db->get('bank')->result_array(); ?>
         <div class="form-group">
          <label for="nama">Nama Pemilik</label>
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" required>
        </div>
         <div class="form-group">
          <label for="kategori">Kategori</label>
          <select class="form-control" name="kategori" id="kategori">
            <option value="">--Pilih Kategori--</option>
            <option value="Rekening">Rekening</option>
            <option value="Kartu Kredit">Kartu Kredit</option>
            <option value="E-Money">E-Money</option>
            <option value="E-Wallet">E-Wallet</option>
            <option value="Pulsa">Pulsa</option>
          </select>
        </div>
        <div class="form-group" id="bank_modal">
          <label for="bank">Bank</label>
          <select class="form-control" id="bank" name="bank">
            <option value="">--Pilih Bank--</option>
            <?php foreach ($bank as $row) {
             ?>
             <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
           <?php } ?>
          </select>
        </div>

        <div class="form-group" id="no_modal">
          <label for="norek">Nomor Rekening</label>
          <input type="text" name="norek" id="norek" class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Masukkan Nomor Rekening" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<?php $no = 0; foreach($rekening as $db) :?>
<div class="modal fade" id="edit_rekening<?php echo $db['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Sumber & Tujuan E-Banking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/edit_rekening')?>">
        <input type="hidden" name="id" value="<?php echo $db['id'] ?>">
        <div class="form-group">
          <label for="nama">Nama Pemilik</label>
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" value="<?php echo $db['nama'] ?>" required>
        </div>
        <div class="form-group">
          <label for="kategori">Kategori</label>
          <select class="form-control" name="kategori" id="kategori">
            <option value="">--Pilih Kategori--</option>
             <option value="Rekening" <?php if ($db['kategori'] == "Rekening") { echo "selected"; }  ?>>Rekening</option>
            <option value="Kartu Kredit" <?php if ($db['kategori'] == "Kartu Kredit") { echo "selected"; }  ?>>Kartu Kredit</option>
            <option value="E-Money" <?php if ($db['kategori'] == "E-Money") { echo "selected"; }  ?>>E-Money</option>
            <option value="E-Wallet" <?php if ($db['kategori'] == "E-Wallet") { echo "selected"; }  ?>>E-Wallet</option>
            <option value="Pulsa" <?php if ($db['kategori'] == "Pulsa") { echo "selected"; }  ?>>Pulsa</option>
            
          </select>
        </div>
        <div class="form-group" id="bank_modal">

          <?php if ($db['kategori'] == 'Pulsa') { ?>
          <label for="kategori">Provider</label>
          <select class="form-control" name="bank" id="bank">
            <option value="">--Pilih Provider--</option>
             <option value="Indosat" <?php if ($db['bank'] == "Indosat") { echo "selected"; }  ?>>Indosat</option>
            <option value="Smartren" <?php if ($db['bank'] == "Smartren") { echo "selected"; }  ?>>Smartren</option>
            <option value="Telkomsel" <?php if ($db['bank'] == "Telkomsel") { echo "selected"; }  ?>>Telkomsel</option>
            <option value="XL" <?php if ($db['bank'] == "XL") { echo "selected"; }  ?>>XL</option>
            <option value="Tri" <?php if ($db['bank'] == "Tri") { echo "selected"; }  ?>>Tri</option>
            <option value="Axis" <?php if ($db['bank'] == "Axis") { echo "selected"; }  ?>>Axis</option>

            
          </select>
          <?php
          } else if ($db['kategori'] == 'E-Wallet') { ?>
          <label for="kategori">Provider</label>
          <select class="form-control" name="bank" id="bank">
            <option value="">--Pilih Provider--</option>
             <option value="GoPay" <?php if ($db['bank'] == "GoPay") { echo "selected"; }  ?>>GoPay</option>
            <option value="OVO" <?php if ($db['bank'] == "OVO") { echo "selected"; }  ?>>OVO</option>
            <option value="DANA" <?php if ($db['bank'] == "DANA") { echo "selected"; }  ?>>DANA</option>
            <option value="LinkAja" <?php if ($db['bank'] == "LinkAja") { echo "selected"; }  ?>>LinkAja</option>
            <option value="iSaku" <?php if ($db['bank'] == "iSaku") { echo "selected"; }  ?>>iSaku</option>
            <option value="Jenius" <?php if ($db['bank'] == "Jenius") { echo "selected"; }  ?>>Jenius</option>

            
          </select>
          <?php
          } else { ?>
          <label for="transaksi">Bank</label>
          <select class="form-control" id="bank" name="bank">
            <option value="">--Pilih Bank--</option>
            <?php foreach ($bank as $row) {
             if ($row['kode'] == $db['bank']) {
                $cek = 'selected';
             } else {
                $cek = '';
             }
             ?>
             <option value="<?php echo $row['kode'] ?>" <?php echo $cek; ?>><?php echo $row['nama']; ?></option>
           <?php } ?>
          </select>
        <?php } ?>
        </div>
         <div class="form-group" id="no_modal">
          <label for="norek">Nomor Rekening</label>
          <input type="text" name="norek" id="norek" class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Masukkan Nomor Rekening" value="<?php echo $db['norek'] ?>" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


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


  function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
         
</script>