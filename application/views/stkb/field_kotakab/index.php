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
    <h3><i class="fa fa-angle-right"></i> Field</h3>
    <div class="row mt">
      <div class="col-lg-12">

        <div class="row">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Field Kota Kab </strong> </h4>
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
                        <th>Kota</th>
                        <th>Jenis Kota</th>
                        <th>UMP Harian</th>
                        <th>UMP Bulanan</th>
                        <th>Tahun</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($kotakab as $data) :
                      ?>
                        <tr>
                          <td><b><?php echo $no++ ?></b></td>
                          <td><?php echo $data['nama_kota'] ?></td>
                          <td><?php echo $data['jeniskota'] ?></td>
                          <td>Rp. <?php echo number_format($data['ump_harian']) ?></td>
                          <td>Rp. <?php echo number_format($data['ump_bulanan']) ?></td>
                          <td><?= $data['tahun'] ?></td>
                          <td>
                            <center>
                              <?php if ($user['id_divisi'] == 99) : ?>
                                <a href="javascript:;" data-toggle="modal" data-target="#edit-fieldkotakab<?php echo $data['id'] ?>" class="btn-success btn-sm">
                                  <i class="fa fa-edit"></i> Edit</a>
                                <a href="<?php echo base_url(); ?>stkb/hapus_kotakab/<?php echo $data['id']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
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
<?php $data_kota = $this->db->query("SELECT * FROM kota WHERE nm_kelurahan IS NULL order by nm_kota")->result_array(); ?>
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
        <form method="POST" action="<?php echo base_url('stkb/tambah_fieldkotakab') ?>" enctype="multipart/form-data">

          <div class="form-group">
            <label>Kota</label>
            <select name="kota_id" class="form-control form-control-user" required>
              <option value="" selected>--Pilih Kota--</option>
              <?php foreach ($data_kota as $row) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['nm_kota'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>UMP Harian</label>
            <input type="number" name="ump_harian" class="form-control" required>
          </div>
          <div class="form-group">
            <label>UMP Bulanan</label>
            <input type="number" name="ump_bulanan" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" required>
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
foreach ($kotakab as $item) : $no++;
?>
  <div class="modal fade" id="edit-fieldkotakab<?php echo $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Edit Field SDM</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="<?php echo base_url('stkb/edit_fieldkotakab') ?>" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $item['id'] ?>">
          <div class="modal-body">

            <div class="form-group">
              <label>Kota</label>
              <select name="kota_id" class="form-control form-control-user" required>
                <option value="" selected>--Pilih Kota--</option>
                <?php foreach ($data_kota as $row) { ?>
                  <option value="<?php echo $row['id'] ?>" <?= ($item['kota_id'] == $row['id']) ? "selected" : "" ?>><?php echo $row['nm_kota'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label>UMP Harian</label>
              <input type="number" name="ump_harian" class="form-control" value="<?= $item['ump_harian'] ?>" required>
            </div>
            <div class="form-group">
              <label>UMP Bulanan</label>
              <input type="number" name="ump_bulanan" class="form-control" value="<?= $item['ump_bulanan'] ?>" required>
            </div>
            <div class="form-group">
              <label>Tahun</label>
              <input type="number" name="tahun" class="form-control" value="<?= $item['tahun'] ?>" required>
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