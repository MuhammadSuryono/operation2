<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data Host</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data-Data Host </strong></h4>
                <!-- <a href="<?= base_url('project/tambah')?>" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Tambah</a> -->
                
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahhost">Tambah Data</button>
                </div>
                                <br>
                <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">


                
                <section id="unseen">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover" id="dataTables-example">
                        <thead >
                          <tr>
                            <th><center>No</center></th>
                            <th><center>Host</center></th>
                            <th><center>Nama</center></th>
                            <th><center>Username</center></th>
                            <th><center>Password</center></th>
                            <th><center>Aksi</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; foreach ($host as $row) {
                            ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $row['hostname'] ?></td>
                              <td><?= $row['nama'] ?></td>
                              <td><?= $row['username'] ?></td>
                              <td><?= $row['password'] ?></td>
                              <td><center>
                                <button class="btn btn-warning" type="button" data-toggle="modal" data-target="#edithost<?= $row['id'] ?>">Edit</button>
                                <a href="<?= base_url('project/deletehost/'.$row['id']) ?>" class="btn btn-danger tombol-hapus">Delete</a>
                              </center></td>
                            </tr>
                          <?php } ?>
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


<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahhost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Host</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('project/tambahhost') ?>">
        <div class="form-group">
          <label>Host</label>
          <input type="text" name="hostname" class="form-control" >
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" >
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" >
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="password" class="form-control" >
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

<!-- Modal Edit -->
<?php $no = 0; foreach ($host as $row) {
$no++; ?>
<div class="modal fade" id="edithost<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Host</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('project/edithost') ?>">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div class="form-group">
          <label>Host</label>
          <input type="text" name="hostname" class="form-control" value="<?= $row['hostname'] ?>">
        </div>
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" class="form-control" value="<?= $row['nama'] ?>">
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" name="username" class="form-control" value="<?= $row['username'] ?>">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="text" name="password" class="form-control" value="<?= $row['password'] ?>">
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
<?php } ?>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
  $(document).ready(function() {
    var quer = $('#query').val();
    var where = $('#where').val();
    var project = $('#project').val();
    var dba = $('#dba').val();
    var modif = $('#modif').val();


    
    $('.query').val(quer);
    $('.where').val(where);
    $('.modif').val(modif);

    // $('.project').val(project);

    $('select[name=project]').val(project);
    $('.selectpicker').selectpicker('refresh');

    $('select[name=dba]').val(dba);
    $('.selectpicker').selectpicker('refresh');


  });
</script>