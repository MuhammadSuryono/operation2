<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Akun</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Akun Sosial Media</strong></h4>

                <!-- <form action="<?= base_url('skenario/tambah_ebanking')?>" method="post"> -->
              <div class="container-fluid">
              </div>
                
          <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <br>
          <section id="allskenario_trk">

            <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
          </section>
          <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active"><a href="#pengguna" id="klik_pengguna" aria-controls="cs" role="tab" data-toggle="tab">Akun Pengguna</a></li>
                        <li role="presentation"><a href="#bank" id="klik_bank" aria-controls="teller" role="tab" data-toggle="tab">Akun Bank</a></li>

                      </ul>

                <br>
                <div class="tab-content">
                        <div role="tabpanel" class="tab-pane container-fluid active" id="pengguna">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_transaksi">Tambah Akun</button>           

                <section id="unseen">
                  <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-3">
                  <thead>
                    <tr>
                      <th><center>No</center></th>
                      <th><center>Akun</center></th>
                      <th><center>Platform</center></th>

                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; foreach($akun_pribadi as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td><center>
                      <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;"><center>
                      <?php endif?>
                         <?= ++$no?><center></td>
                        <td><center><?= $db['username']?><center></td>
                        <td><center><?= $db['platform']?><center></td>
                        <td><center><a type="button" data-toggle="modal" data-target="#edit_akunpribadisosmed<?php echo $db['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo base_url('skenario/hapus_akunpribadisosmed/'.$db['id']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                        </center>
                        </td>  
                        </tr>
                    <?php endforeach?>
                  </tbody>
                </table>
              </div>
              </section>
            </div>
            <div role="tabpanel" class="tab-pane container-fluid" id="bank">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_akunbank">Tambah Akun Bank</button>           

                <section id="unseen">
                  <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-4">
                  <thead>
                    <tr>
                      <th><center>No</center></th>
                      <th><center>Akun</center></th>
                      <th><center>Bank</center></th>
                      <th><center>Platform</center></th>

                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; foreach($akun_bank as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td><center>
                      <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;"><center>
                      <?php endif?>
                         <?= ++$no?><center></td>
                        <td><center><?= $db['username']?><center></td>
                        <td><center><?= $db['nama']?><center></td>
                        <td><center><?= $db['platform']?><center></td>
                        <td><center><a type="button" data-toggle="modal" data-target="#edit_akunbanksosmed<?php echo $db['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo base_url('skenario/hapus_akunbanksosmed/'.$db['id']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

<!-- Modal -->
<div class="modal fade" id="add_transaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Pengguna Sosial Media</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/add_akunpribadisosmed')?>">
        <div class="form-group">
          <label for="transaksi">Platform</label>
          <select class="form-control selectpicker" name="platform" id="plat_akunpribadi" data-live-search="true">
            <option value="">--Pilih Platform--</option>
            <option value="Facebook">Facebook</option>
            <option value="Instagram">Instagram</option>
            <option value="Twitter">Twitter</option>
          </select>
        </div>
        <div id="disini_nama">
          
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
<?php $no = 0; foreach($akun_pribadi as $db) :?>
<div class="modal fade" id="edit_akunpribadisosmed<?php echo $db['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Akun Sosial Media Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/edit_akunpribadisosmed ')?>">
        <input type="hidden" name="kode" value="<?php echo $db['id'] ?>">
        <div class="form-group">
          <label for="transaksi">Nama Akun</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo $db['username'] ?>">
        </div>
        <div class="form-group">
          <label for="transaksi">Platform</label>
          <select class="form-control selectpicker" name="platform" data-live-search="true">
            <option value="">--Pilih Platform--</option>
            <option value="Facebook" <?php if($db['platform'] == 'Facebook'){echo "selected";} ?>>Facebook</option>
            <option value="Instagram" <?php if($db['platform'] == 'Instagram'){echo "selected";} ?>>Instagram</option>
            <option value="Twitter" <?php if($db['platform'] == 'Twitter'){echo "selected";} ?>>Twitter</option>
          </select>
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


<!-- Modal Add Akun Bank-->
<div class="modal fade" id="add_akunbank" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Akun Sosial Media Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/add_akunbanksosmed')?>">
        <div class="form-group">
          <label for="transaksi">Platform</label>
          <select class="form-control selectpicker" name="platform" id="plat_akunbank" data-live-search="true">
            <option value="">Pilih Platform</option>
            <option value="Facebook">Facebook</option>
            <option value="Instagram">Instagram</option>
            <option value="Twitter">Twitter</option>
          </select>
        </div>

        <div class="form-group">
          <label for="transaksi">Bank</label>
          <select class="form-control selectpicker" name="bank" data-live-search="true">
            <option value="">Pilih Bank</option>
            <?php $bank = $this->db->get('bank')->result_array();
            foreach ($bank as $row) {
            ?>
            <option value="<?= $row['kode'] ?>"><?= $row['nama'] ?></option>
          <?php } ?>
          </select>
        </div>

        <div id="disini_namabank">
          
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
<?php $no = 0; foreach($akun_bank as $db) :?>
<div class="modal fade" id="edit_akunbanksosmed<?php echo $db['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Akun Sosial Media Bank</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/edit_akunbanksosmed ')?>">
        <input type="hidden" name="kode" value="<?php echo $db['id'] ?>">
        <div class="form-group">
          <label for="transaksi">Nama Akun</label>
          <input type="text" class="form-control" id="username" name="username" value="<?php echo $db['username'] ?>">
        </div>
        <div class="form-group">
          <label for="transaksi">Bank</label>
          <select class="form-control selectpicker" name="bank" data-live-search="true">
            <option value="">Pilih Bank</option>
            <?php $bank = $this->db->get('bank')->result_array();
            foreach ($bank as $row) {
            ?>
            <option value="<?= $row['kode'] ?>" <?php if($db['bank'] == $row['kode']){echo "selected";} ?>><?= $row['nama'] ?></option>
          <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="transaksi">Platform</label>
          <select class="form-control selectpicker" name="platform" data-live-search="true">
            <option value="">--Pilih Platform--</option>
            <option value="Facebook" <?php if($db['platform'] == 'Facebook'){echo "selected";} ?>>Facebook</option>
            <option value="Instagram" <?php if($db['platform'] == 'Instagram'){echo "selected";} ?>>Instagram</option>
            <option value="Twitter" <?php if($db['platform'] == 'Twitter'){echo "selected";} ?>>Twitter</option>
          </select>
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



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
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