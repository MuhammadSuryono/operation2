<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aplikasi E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Aplikasi E-Banking</strong></h4>

                <form action="<?= base_url('skenario/tambah_aplikasi')?>" method="post">
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_aplikasi">Tambah Aplikasi</button>

                  <!-- <button type="submit" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Simpan </button> -->
                </form>

                

                <section id="unseen">
                  <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-3">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th><center>Nama</center></th>
                      <th><center>Bank</center></th>
                      <th><center>Channel</center></th>
                      <th><center>System</center></th>
                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; foreach($aplikasi as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td><center>
                      <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;"><center>
                      <?php endif?>
                         <?= ++$no?><center></td>
                        <td><center><?= $db['nama']?><center></td>
                        
                        <td><center><?= $db['nama_bank']?><center></td>
                        <td><center><?= $db['channel']?><center></td>
                        <td><center><?= $db['os']?><center></td>
                        <td><center><a type="button" data-toggle="modal" data-target="#edit_aplikasi<?php echo $db['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo base_url('skenario/hapus_aplikasi/'.$db['id']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="add_aplikasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Aplikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/add_aplikasi')?>">
        <?php
        $bank = $this->db->get('bank')->result_array(); ?>
         <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
          <label for="bank">Bank</label>
          <select class="form-control" id="bank" name="bank">
            <option value="">--Pilih Bank--</option>
            <?php foreach ($bank as $row) {
             ?>
             <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
           <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label for="norek">Channel</label>
          <select name="channel" id="channel_apl" class="form-control">
            <option value="">--Pilih Channel--</option>
            <option value="Internet Banking">Internet Banking</option>
            <option value="Mobile Banking">Mobile Banking</option>
            <option value="SMS Banking">SMS Banking</option>

          </select>
        </div>
        <div class="form-group" id="div_system_apl">
          <!-- <label for="norek">Channel</label>
          <select name="channel" id="channel" class="form-control">
            <option value="">--Pilih Channel--</option>
            <option value="Internet Banking">Internet Banking</option>
            <option value="Mobile Banking">Mobile Banking</option>
            <option value="SMS Banking">SMS Banking</option>

          </select> -->
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
<?php $no = 0; foreach($aplikasi as $db) :?>
<div class="modal fade" id="edit_aplikasi<?php echo $db['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Aplikasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/edit_aplikasi')?>">
        <input type="hidden" name="id" value="<?php echo $db['id'] ?>">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" value="<?php echo $db['nama'] ?>" required>
        </div>
        <div class="form-group">
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
        </div>
        <div class="form-group">
          <label for="norek">Channel</label>
          <select name="channel" id="channel_apl" class="form-control">
            <option value="">--Pilih Channel--</option>
            <option value="Internet Banking" <?php if ($db['channel'] == "Internet Banking") { echo "selected"; }  ?>>Internet Banking</option>
            <option value="Mobile Banking" <?php if ($db['channel'] == "Mobile Banking") { echo "selected"; }  ?>>Mobile Banking</option>
            <option value="SMS Banking" <?php if ($db['channel'] == "SMS Banking") { echo "selected"; }  ?>>SMS Banking</option>

          </select>
        </div>
        <?php
        if ($db['channel'] == "Mobile Banking") { ?>
        <div class="form-group">
          <label for="norek">System</label>
          <select name="system" id="system_apl" class="form-control">
            <option value="">--Pilih System--</option>
            <option value="Android" <?php if ($db['os'] == "Android") { echo "selected"; }  ?>>Android</option>
            <option value="IOS" <?php if ($db['os'] == "IOS") { echo "selected"; }  ?>>IOS</option>

          </select>
        </div>
        <?php
         } else { ?>
          <input type="hidden" name="system" value="<?php echo $db['os'] ?>">
        <?php } ?>
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