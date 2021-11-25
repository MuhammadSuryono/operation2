<?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
}
?>
<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> STKB</h3>
    <div class="row mt">
      <div class="col-lg-12">

        <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> SDM STKB </strong> </h4>
              <?php if ($user['id_divisi'] == 99) : ?>
                <a href="" class="btn btn-round btn-primary mb" data-target="#tambahsdm" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>
              <?php endif; ?>

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>


              <section id="unseen">
                <div class="table-responsive">
                  <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                    <thead>
                      <tr bgcolor="#F0FFF0">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kota Asal</th>
                        <th>Kota Penugasan</th>
                        <th>Jabatan</th>
                        <th>Memo</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($sdm as $data) :
                      ?>
                        <tr>
                          <td><b><?php echo $no++ ?></b></td>
                          <td><?php echo $data['nama'] ?></td>
                          <td><?php echo $data['kota_asal'] ?></td>
                          <td><?php echo $data['kota_penugasan'] ?></td>
                          <td><?php echo $data['jabatan'] ?></td>
                          <td>
                            <center><?php if ($data['memo'] != NULL) {
                                      echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/memo/" . $data['memo'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i> View</a>";
                                    } else {
                                      echo "";
                                    } ?>
                            </center>
                          </td>
                          <td>
                            <center>
                              <?php if ($user['id_divisi'] == 99) : ?>
                                <a href="javascript:;" data-toggle="modal" data-target="#edit-sdmstkb<?php echo $data['no'] ?>" class="btn-success btn-sm">
                                  <i class="fa fa-edit"></i> Edit</a>
                                <a href="<?php echo base_url(); ?>stkb/hapus_sdmstkb/<?php echo $data['no']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                              <?php endif; ?>
                            </center>
                          </td>
                        </tr>
                      <?php
                      endforeach;
                      ?>
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
<!-- /MAIN CONTENT -->
<!--main content end-->

<!-- MODAL INPUT DATA SDM STKB -->
<div class="modal fade" id="tambahsdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Input SDM STKB</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('stkb/tambah_sdmstkb') ?>" enctype="multipart/form-data">
          <?php
          $data = $this->db->query("SELECT * FROM id_data order by Nama")->result_array(); ?>

          <div class="form-group">
            <label>Nama</label>
            <select name="Id" class="form-control form-control-user" required>
              <option value="" selected>--Pilih Nama--</option>
              <?php foreach ($data as $row) { ?>
                <option value="<?php echo $row['Id'] ?>"><?php echo $row['Nama'] . " - " . $row['Id'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Kota Asal</label>
            <input type="text" id="kota" name="kota_asal" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" required>
          </div>
          <div class="form-group">
            <label>Jabatan</label>
            <select class="form-control form-control-user" name="jabatan" required>
              <option value="" selected>--Pilih Jabatan--</option>
              <option value="PEWITNES">PEWITNES</option>
              <option value="SUPERVISOR">SUPERVISOR</option>
              <option value="TLF">TLF</option>

            </select>
          </div>
          <div class="form-group">
            <label>Upload Memo</label>
            <input type="file" name="memo_sdm" accept="application/pdf" class="form-control" required>
            <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Memo(.pdf)
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

<!-- MODAL EDIT SDM STKB -->
<?php
$no = 0;
foreach ($sdm as $data) : $no++;
?>
  <div class="modal fade" id="edit-sdmstkb<?php echo $data['no'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Edit SDM STKB</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?php echo base_url('stkb/edit_sdmstkb') ?>" enctype="multipart/form-data">
            <input type="hidden" name="no" id="no" value="<?php echo $data['no']; ?>">

            <div class="form-group">
              <label>Nama</label>
              <input type="text" id="nm" name="nama" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['nama'] ?>" readonly>
            </div>
            <div class="form-group">
              <label>Kota Asal</label>
              <input type="text" id="kota" name="kota_asal" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['kota_asal'] ?>">
            </div>
            <div class="form-group">
              <label>Kota Penugasan</label>
              <input type="text" id="kota" name="kota_penugasan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['kota_penugasan'] ?>">
            </div>

            <div class="form-group">
              <label>Jabatan</label>
              <select class="form-control form-control-user" name="jabatan">
                <option value="">--Pilih Jabatan--</option>
                <option value="PEWITNES" <?php if ($data['jabatan'] == "PEWITNES") {
                                            echo "selected";
                                          } ?>>PEWITNES</option>
                <option value="SUPERVISOR" <?php if ($data['jabatan'] == "SUPERVISOR") {
                                              echo "selected";
                                            } ?>>SUPERVISOR</option>
                <option value="TLF" <?php if ($data['jabatan'] == "TLF") {
                                      echo "selected";
                                    } ?>>TLF</option>

              </select>
            </div>
            <div class="form-group">
              <label>Upload Memo</label>
              <input type="file" name="memo_sdm" class="form-control form-control-user" accept="application/pdf" required>
              <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Memo(.pdf)
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
<?php endforeach; ?>