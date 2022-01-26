<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data List Query</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data List Query </strong></h4>
                <!-- <a href="<?= base_url('project/tambah')?>" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Tambah</a> -->
                
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

                    <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#tambahhost">Tambah Data</button> -->
                </div>
                                <br>
                <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">


                
                <section id="unseen">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover" id="dataTables-example">
                        <thead >
                          <tr>
                            <th><center>No</center></th>
                            <th><center>Query</center></th>
                            <th><center>Keterangan Check</center></th>
                            <th><center>Kategori</center></th>
                            <th><center>User Input</center></th>
                            <th><center>Tanggal</center></th>
                            <th width="8%"><center>Aksi</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; foreach ($query as $row) {
                            ?>
                            <tr>
                              <td><?= $no++; ?></td>
                              <td><?= $row['query'] ?></td>
                              <td><?= $row['keterangan'] ?></td>
                              <td><?= $row['kategori'] ?></td>
                              <td><?= $row['name'] ?></td>
                              <td><?= $row['tgl_input'] ?></td>

                              <td><center>
                                <div class="row">
                                <a href="#" type="button" class="btn btn-warning" data-toggle="modal" data-target="#editquery<?= $row['num'] ?>"><i class="fas fa-edit"></i></a>
                                <a href="<?= base_url('project/deletequery/'.$row['num']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash-alt"></i></a>
                                </div>
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



<!-- Modal Edit -->
<?php $no = 0; foreach ($query as $row) {
$no++; ?>
<div class="modal fade" id="editquery<?= $row['num'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('project/editquery') ?>">
          <input type="hidden" name="num" value="<?= $row['num'] ?>">
        <div class="form-group">
          <label>Query</label>
          <textarea class="form-control" name="query" rows="5"><?= $row['query'] ?></textarea>
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <select class="form-control" name="kategori">
            <option value="">Pilih Kategori</option>
            <option value="CS" <?php if($row['kategori'] == 'CS'){ echo "selected";} ?>>CS</option>
            <option value="Teller" <?php if($row['kategori'] == 'Teller'){ echo "selected";} ?>>Teller</option>

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