<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Greeting</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Sampel Greeting</strong></h4>

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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_transaksi">Tambah</button>

                  <!-- <button type="submit" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Simpan </button> -->
                </form>

                

                <section id="unseen">
                  <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover table-condensed table-responsive-sm" id="dataTables-example-3">
                  <thead>
                    <tr>
                      <th>Urutan</th>
                      <th>Kode</th>
                      <th><center>Greeting</center></th>
                     <!--  <th><center>Kategori</center></th>
                      <th><center>Sumber/Tujuan</center></th> -->
                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; foreach($greeting as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td><center>
                      <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;"><center>
                      <?php endif?>
                         <?= $db['urut'] ?><center></td>
                        <td><center><?= $db['score']?><center></td>
                        <td><center><?= $db['greeting']?><center></td>
<!--                         <td><center><?= $db['kategori']?><center></td>
                        <td><center><?= $db['sumber']?><center></td>
 -->                          
                        <td><center><a type="button" data-toggle="modal" data-target="#edit_sosmed<?php echo $db['kode']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                          <a href="<?php echo base_url('skenario/hapus_greetsosmed/'.$db['kode']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Skenario Evaluasi Sosial Media</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/add_greetsosmed')?>">
        <div class="form-group">
          <label for="transaksi">Urutan</label>
          <input type="number" class="form-control" id="urut" name="urut">
        </div>
        <div class="form-group">
          <label for="transaksi">Kode</label>
          <input type="text" class="form-control" id="score" name="score">
        </div>
        <div class="form-group">
          <label for="transaksi">Kalimat</label>
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Kalimat">
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
<?php $no = 0; foreach($greeting as $db) :?>
<div class="modal fade" id="edit_sosmed<?php echo $db['kode']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Skenario Evaluasi Sosial Media</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/edit_greetsosmed ')?>">
        <input type="hidden" name="kode" value="<?php echo $db['kode'] ?>">
        <div class="form-group">
          <label for="transaksi">Urutan</label>
          <input type="number" class="form-control" id="urut" name="urut" value="<?= $db['urut'] ?>">
        </div>
        <div class="form-group">
          <label for="transaksi">Kode</label>
          <input type="text" class="form-control" id="score" name="score" value="<?php echo $db['score'] ?>">
        </div>
        <div class="form-group">
          <label for="transaksi">Kalimat</label>
          <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $db['greeting'] ?>">
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