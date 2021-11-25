<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Transaksi E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Transaksi E-Banking</strong></h4>

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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_transaksi">Tambah Transaksi</button>

                  <!-- <button type="submit" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Simpan </button> -->
                </form>

                

                <section id="unseen">
                  <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-3">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th><center>Transaksi</center></th>
                      <th><center>Kategori</center></th>
                      <th><center>Sumber/Tujuan</center></th>
                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; foreach($transaksi as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td><center>
                      <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;"><center>
                      <?php endif?>
                         <?= ++$no?><center></td>
                        <td><center><?= $db['nama']?><center></td>
                        <td><center><?= $db['kategori']?><center></td>
                        <td><center><?= $db['sumber']?><center></td>
                          
                        <td><center><a type="button" data-toggle="modal" data-target="#edit_transaksi<?php echo $db['kode']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo base_url('skenario/hapus_transaksi/'.$db['kode']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="add_transaksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/add_transaksi')?>">
        <div class="form-group">
          <label for="transaksi">Transaksi</label>
          <input type="text" class="form-control" id="transaksi" name="transaksi" placeholder="Transaksi">
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
        <div class="form-group">
          <label for="transaksi">Sumber</label>
          <input type="number" class="form-control" id="sumber" name="sumber" min="1" placeholder="Sumber">
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
<?php $no = 0; foreach($transaksi as $db) :?>
<div class="modal fade" id="edit_transaksi<?php echo $db['kode']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Transaksi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/edit_transaksi')?>">
        <input type="hidden" name="kode" value="<?php echo $db['kode'] ?>">
        <div class="form-group">
          <label for="transaksi">Transaksi</label>
          <input type="text" class="form-control" id="transaksi" name="transaksi" value="<?php echo $db['nama'] ?>">
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
        <div class="form-group">
          <label for="transaksi">Sumber</label>
          <input type="number" class="form-control" id="sumber" name="sumber" value="<?php echo $db['sumber'] ?>">
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