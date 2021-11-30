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
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Field SDM </strong> </h4>
              <?php if ($user['id_divisi'] == 99) : ?>
                <a href="" class="btn btn-round btn-primary mb" data-target="#tambahsdm" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>
              <?php endif; ?>

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#kontrak">Kontrak</a></li>
                <li><a data-toggle="tab" href="#mitra">Mitra</a></li>
                <li><a data-toggle="tab" href="#fo">Field Officer & Pewitness</a></li>
              </ul>


              <div class="tab-content">
                <div id="kontrak" class="tab-pane fade in active">
                  <section id="unseen">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                        <thead>
                          <tr bgcolor="#F0FFF0">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kota</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tanggal Pengangkatan Kaderisasi</th>
                            <th>Jumlah Target Kaderisasi</th>
                            <th>Rentang Waktu Target Kaderisasi</th>
                            <th>Nama PJ Kaderisasi</th>
                            <th>Nama Kepala Field</th>
                            <th>Nama Pengangkat Kaderisasi</th>
                            <th>Memo</th>
                            <th width="150px">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($sdm_kontrak as $data) :
                          ?>
                            <tr>
                              <td><b><?php echo $no++ ?></b></td>
                              <td><?php echo $data['Nama'] ?></td>
                              <td><?php echo $data['nm_kota'] ?></td>
                              <td><?php echo $data['posisi'] ?></td>
                              <td><?php echo ($data['status']) ? $data['status'] : '-' ?></td>
                              <td><?php echo ($data['tanggal_mulai']) ? $data['tanggal_mulai'] : '-' ?></td>
                              <td><?php echo ($data['tanggal_selesai']) ? $data['tanggal_selesai'] : '-' ?></td>
                              <td><?php echo ($data['tanggal_kaderisasi']) ? $data['tanggal_kaderisasi'] : '-' ?></td>
                              <td><?php echo ($data['jumlah_kaderisasi']) ? $data['jumlah_kaderisasi'] : '-' ?></td>
                              <td><?php echo ($data['mulai_kaderisasi']) ? $data['mulai_kaderisasi'] . ' - ' . $data['selesai_kaderisasi'] : '-' ?></td>

                              <?php
                              $kader_id = $data['kader_id'];
                              if ($kader_id != NULL or $kader_id != '') {
                                $nama_kader = $this->db->query("SELECT 
                                    b.Nama
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                WHERE 
                                    a.id = '$kader_id'
                                ")->row_array();
                              } else {
                                $nama_kader = null;
                              }

                              $penanggung_jawab_kaderisasi = $data['penanggung_jawab_kaderisasi'];
                              if ($penanggung_jawab_kaderisasi != NULL or $penanggung_jawab_kaderisasi != '') {
                                $nama_pj = $this->db->query("SELECT 
                                    b.Nama
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                WHERE 
                                    a.id = '$penanggung_jawab_kaderisasi'
                                ")->row_array();
                              } else {
                                $nama_pj = null;
                              }

                              ?>
                              <td><?php echo isset($nama_pj['Nama']) ? $nama_pj['Nama'] : '-' ?></td>
                              <td><?php echo ($data['nama_kepala']) ? $data['nama_kepala'] : '-' ?></td>
                              <td><?php echo isset($nama_kader['Nama']) ? $nama_kader['Nama'] : '-' ?></td>
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
                                    <a data-toggle="modal" data-target="#edit-fieldsdm" class="btn-success btn-sm btn-edit-field" data-id="<?= $data['id'] ?>" data-id_data="<?= $data['id_data_id'] ?>" data-kota_id="<?= $data['kota_id'] ?>" data-posisi="<?= $data['posisi'] ?>" data-status="<?= $data['status'] ?>" data-tanggal_mulai="<?= $data['tanggal_mulai'] ?>" data-tanggal_selesai="<?= $data['tanggal_selesai'] ?>" data-tanggal_kaderisasi="<?= $data['tanggal_kaderisasi'] ?>" data-kader_id="<?= $data['kader_id'] ?>" data-jumlah_kaderisasi="<?= $data['jumlah_kaderisasi'] ?>" data-mulai_kaderisasi="<?= $data['mulai_kaderisasi'] ?>" data-selesai_kaderisasi="<?= $data['selesai_kaderisasi'] ?>" data-penanggung_jawab_kaderisasi="<?= $data['penanggung_jawab_kaderisasi'] ?>">
                                      <i class="fa fa-edit"></i> Edit</a>
                                    <a href="<?php echo base_url(); ?>stkb/hapus_fieldsdm/<?php echo $data['id']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                                  <?php endif; ?>
                                  <br>
                                  <?php if (($data['posisi'] == 'Area Head' OR $data['posisi'] == 'Kepala Field') && ($user['id_divisi'] == 99 || $user['id_divisi'] == 8 || $user['id_divisi'] == 7)) : ?>
                                    <!-- href="<?php echo base_url(); ?>stkb/print_reportsdm/675/0/<?php echo $data['id']; ?>" -->
                                    <?php if ($data['status'] == 'Mitra') : ?>
                                      <a class="btn-primary btn-sm btn-print-sdm-mitra" data-toggle="modal" data-target="#printSdmMitra" data-id_data_id="<?= $data['id_data_id'] ?>" data-id="<?= $data['id'] ?>"><i class="fa fa-print"></i> Print</a>
                                    <?php else : ?>
                                      <a class="btn-primary btn-sm btn-print-sdm" data-toggle="modal" data-target="#printsdm" data-id="<?= $data['id'] ?>"><i class="fa fa-print"></i> Print</a>
                                    <?php endif; ?>
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
                <div id="mitra" class="tab-pane fade">
                  <section id="unseen">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-2">
                        <thead>
                          <tr bgcolor="#F0FFF0">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kota</th>
                            <th>Posisi</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Tanggal Pengangkatan Kaderisasi</th>
                            <th>Jumlah Target Kaderisasi</th>
                            <th>Rentang Waktu Target Kaderisasi</th>
                            <th>Nama PJ Kaderisasi</th>
                            <th>Nama Kepala Field</th>
                            <th>Nama Pengangkat Kaderisasi</th>
                            <th>Memo</th>
                            <th width="150px">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($sdm_mitra as $data) :
                          ?>
                            <tr>
                              <td><b><?php echo $no++ ?></b></td>
                              <td><?php echo $data['Nama'] ?></td>
                              <td><?php echo $data['nm_kota'] ?></td>
                              <td><?php echo $data['posisi'] ?></td>
                              <td><?php echo ($data['status']) ? $data['status'] : '-' ?></td>
                              <td><?php echo ($data['tanggal_mulai']) ? $data['tanggal_mulai'] : '-' ?></td>
                              <td><?php echo ($data['tanggal_selesai']) ? $data['tanggal_selesai'] : '-' ?></td>
                              <td><?php echo ($data['tanggal_kaderisasi']) ? $data['tanggal_kaderisasi'] : '-' ?></td>
                              <td><?php echo ($data['jumlah_kaderisasi']) ? $data['jumlah_kaderisasi'] : '-' ?></td>
                              <td><?php echo ($data['mulai_kaderisasi']) ? $data['mulai_kaderisasi'] . ' - ' . $data['selesai_kaderisasi'] : '-' ?></td>

                              <?php
                              $kader_id = $data['kader_id'];
                              if ($kader_id != NULL or $kader_id != '') {
                                $nama_kader = $this->db->query("SELECT 
                                    b.Nama
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                WHERE 
                                    a.id = '$kader_id'
                                ")->row_array();
                              } else {
                                $nama_kader = null;
                              }

                              $penanggung_jawab_kaderisasi = $data['penanggung_jawab_kaderisasi'];
                              if ($penanggung_jawab_kaderisasi != NULL or $penanggung_jawab_kaderisasi != '') {
                                $nama_pj = $this->db->query("SELECT 
                                    b.Nama
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                WHERE 
                                    a.id = '$penanggung_jawab_kaderisasi'
                                ")->row_array();
                              } else {
                                $nama_pj = null;
                              }

                              ?>
                              <td><?php echo isset($nama_pj['Nama']) ? $nama_pj['Nama'] : '-' ?></td>
                              <td><?php echo ($data['nama_kepala']) ? $data['nama_kepala'] : '-' ?></td>
                              <td><?php echo isset($nama_kader['Nama']) ? $nama_kader['Nama'] : '-' ?></td>
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
                                    <a data-toggle="modal" data-target="#edit-fieldsdm" class="btn-success btn-sm btn-edit-field" data-id="<?= $data['id'] ?>" data-id_data="<?= $data['id_data_id'] ?>" data-kota_id="<?= $data['kota_id'] ?>" data-posisi="<?= $data['posisi'] ?>" data-status="<?= $data['status'] ?>" data-tanggal_mulai="<?= $data['tanggal_mulai'] ?>" data-tanggal_selesai="<?= $data['tanggal_selesai'] ?>" data-tanggal_kaderisasi="<?= $data['tanggal_kaderisasi'] ?>" data-kader_id="<?= $data['kader_id'] ?>" data-jumlah_kaderisasi="<?= $data['jumlah_kaderisasi'] ?>" data-mulai_kaderisasi="<?= $data['mulai_kaderisasi'] ?>" data-selesai_kaderisasi="<?= $data['selesai_kaderisasi'] ?>" data-penanggung_jawab_kaderisasi="<?= $data['penanggung_jawab_kaderisasi'] ?>">
                                      <i class="fa fa-edit"></i> Edit</a>
                                    <a href="<?php echo base_url(); ?>stkb/hapus_fieldsdm/<?php echo $data['id']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                                  <?php endif; ?>
                                  <br>
                                  <?php if ($data['posisi'] == 'Area Head' && ($user['id_divisi'] == 99 || $user['id_divisi'] == 8 || $user['id_divisi'] == 7)) : ?>
                                    <!-- href="<?php echo base_url(); ?>stkb/print_reportsdm/675/0/<?php echo $data['id']; ?>" -->
                                    <?php if ($data['status'] == 'Mitra') : ?>
                                      <a class="btn-primary btn-sm btn-print-sdm-mitra" data-toggle="modal" data-target="#printSdmMitra" data-id_data_id="<?= $data['id_data_id'] ?>" data-id="<?= $data['id'] ?>" data-nama="<?= $data['Nama'] ?>"><i class="fa fa-print"></i> Print</a>
                                    <?php else : ?>
                                      <a class="btn-primary btn-sm btn-print-sdm" data-toggle="modal" data-target="#printsdm" data-id="<?= $data['id'] ?>"><i class="fa fa-print"></i> Print</a>
                                    <?php endif; ?>
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
                <div id="fo" class="tab-pane fade">
                  <section id="unseen">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-2">
                        <thead>
                          <tr bgcolor="#F0FFF0">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kota</th>
                            <th>Posisi</th>
                            <th>Tanggal Pengangkatan Kaderisasi</th>
                            <th>Nama Kepala Field</th>
                            <th>Nama Pengangkat Kaderisasi</th>
                            <th>Memo</th>
                            <th width="150px">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($sdm_fo as $data) :
                          ?>
                            <tr>
                              <td><b><?php echo $no++ ?></b></td>
                              <td><?php echo $data['Nama'] ?></td>
                              <td><?php echo $data['nm_kota'] ?></td>
                              <td><?php echo $data['posisi'] ?></td>
                              <td><?php echo ($data['tanggal_kaderisasi']) ? $data['tanggal_kaderisasi'] : '-' ?></td>

                              <?php
                              $kader_id = $data['kader_id'];
                              if ($kader_id != NULL or $kader_id != '') {
                                $nama_kader = $this->db->query("SELECT 
                                    b.Nama
                                FROM
                                    field_sdm a
                                    JOIN id_data b ON a.id_data_id = b.Id
                                    LEFT JOIN kota c ON a.kota_id = c.id
                                WHERE 
                                    a.id = '$kader_id'
                                ")->row_array();
                              } else {
                                $nama_kader = null;
                              }

                              ?>
                              <td><?php echo ($data['nama_kepala']) ? $data['nama_kepala'] : '-' ?></td>
                              <td><?php echo isset($nama_kader['Nama']) ? $nama_kader['Nama'] : '-' ?></td>
                              <td>
                                <center><?php if ($data['memo'] != NULL) {
                                          echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/field_sdm/" . $data['memo'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i> View</a>";
                                        } else {
                                          echo "";
                                        } ?>
                                </center>
                              </td>
                              <td>
                                <center>
                                  <?php if ($user['id_divisi'] == 99) : ?>
                                    <a data-toggle="modal" data-target="#edit-fieldsdm" class="btn-success btn-sm btn-edit-field" data-id="<?= $data['id'] ?>" data-id_data="<?= $data['id_data_id'] ?>" data-kota_id="<?= $data['kota_id'] ?>" data-posisi="<?= $data['posisi'] ?>" data-status="<?= $data['status'] ?>" data-tanggal_mulai="<?= $data['tanggal_mulai'] ?>" data-tanggal_selesai="<?= $data['tanggal_selesai'] ?>" data-tanggal_kaderisasi="<?= $data['tanggal_kaderisasi'] ?>" data-kader_id="<?= $data['kader_id'] ?>" data-jumlah_kaderisasi="<?= $data['jumlah_kaderisasi'] ?>" data-mulai_kaderisasi="<?= $data['mulai_kaderisasi'] ?>" data-selesai_kaderisasi="<?= $data['selesai_kaderisasi'] ?>" data-penanggung_jawab_kaderisasi="<?= $data['penanggung_jawab_kaderisasi'] ?>">
                                      <i class="fa fa-edit"></i> Edit</a>
                                    <a href="<?php echo base_url(); ?>stkb/hapus_fieldsdm/<?php echo $data['id']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                                  <?php endif; ?>
                                  <br>
                                  <?php if ($data['posisi'] == 'Area Head' && ($user['id_divisi'] == 99 || $user['id_divisi'] == 8 || $user['id_divisi'] == 7)) : ?>
                                    <!-- href="<?php echo base_url(); ?>stkb/print_reportsdm/675/0/<?php echo $data['id']; ?>" -->
                                    <?php if ($data['status'] == 'Mitra') : ?>
                                      <a class="btn-primary btn-sm btn-print-sdm-mitra" data-toggle="modal" data-target="#printSdmMitra" data-id_data_id="<?= $data['id_data_id'] ?>" data-id="<?= $data['id'] ?>" data-nama="<?= $data['Nama'] ?>"><i class="fa fa-print"></i> Print</a>
                                    <?php else : ?>
                                      <a class="btn-primary btn-sm btn-print-sdm" data-toggle="modal" data-target="#printsdm" data-id="<?= $data['id'] ?>"><i class="fa fa-print"></i> Print</a>
                                    <?php endif; ?>
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
      </div>
    </div>
  </section>
  <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

<?php
$data = $this->db->query("SELECT * FROM id_data order by Nama")->result_array();
$dataKepalaField = $this->db->query("SELECT * FROM field_sdm JOIN id_data ON id_data.Id = field_sdm.id_data_id WHERE field_sdm.posisi = 'Kepala Field' order by id_data.Nama")->result_array();
$data_kota = $this->db->query("SELECT * FROM kota WHERE nm_kelurahan IS NULL order by nm_kota")->result_array();
$dataAreaHead = $this->db->query("SELECT * FROM field_sdm JOIN id_data ON id_data.Id = field_sdm.id_data_id WHERE field_sdm.posisi = 'Area Head' order by id_data.Nama")->result_array();

?>

<!-- MODAL INPUT DATA SDM STKB -->
<div class="modal fade" id="tambahsdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Input Field SDM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('stkb/tambah_fieldsdm') ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label>Posisi</label>
            <select class="form-control form-control-user" name="posisi" required>
              <option value="" selected>--Pilih Posisi--</option>
              <option value="Kepala Field">Kepala Field</option>
              <option value="Area Head">Area Head</option>
              <option value="Field Officer">Field Officer</option>
              <option value="Pewitnes">Pewitnes</option>
            </select>
          </div>
          <?php
          ?>

          <div class="form-group">
            <label>Nama</label>
            <select name="id_data_id" class="form-control form-control-user" required>
              <option value="" selected>--Pilih Nama--</option>
              <?php foreach ($data as $row) { ?>
                <option value="<?php echo $row['Id'] ?>"><?php echo $row['Nama'] . " - " . $row['Id'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group row-status">
            <label>Status</label>
            <select class="form-control form-control-user" name="status" id="status">
              <option value="" selected>--Pilih Status--</option>
              <option value="Kontrak">Kontrak</option>
              <option value="Mitra">Mitra</option>
            </select>
          </div>

          <div class="form-group">
            <label>Kota</label>
            <select name="kota_id" class="form-control form-control-user" required>
              <option value="" selected>--Pilih Kota--</option>
              <?php foreach ($data_kota as $row) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['nm_kota'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group row-jumlah-kaderisasi">
            <label>Jumlah Target Kaderisasi</label>
            <input type="number" name="jumlah_kaderisasi" class="form-control">
          </div>
          <div class="form-group row-rentang-kaderisasi">
            <label>Rentang Tanggal Target Kaderisasi</label>
            <div class="row">
              <div class="col-sm-6">
                <label>Dari</label>
                <input type="date" name="mulai_kaderisasi" class="form-control">
              </div>
              <div class="col-sm-6">
                <label>Sampai</label>
                <input type="date" name="selesai_kaderisasi" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group row-nama-pj-kaderisasi">
            <label>Penanggung Jawab Kaderisasi</label>
            <select name="penanggung_jawab_kaderisasi" class="form-control form-control-user">
              <option value="" selected>--Pilih Kepala Field--</option>
              <?php foreach ($dataKepalaField as $row) { ?>
                <option value="<?php echo $row['id_data_id'] ?>"><?php echo $row['Nama'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group row-tanggal-mulai">
            <label>Tanggal Mulai Kontrak/Mitra</label>
            <input type="date" name="tanggal_mulai" class="form-control">
          </div>
          <div class="form-group row-tanggal-selesai">
            <label>Tanggal Selesai Kontrak/Mitra</label>
            <input type="date" name="tanggal_selesai" class="form-control">
          </div>
          <div class="form-group row-tanggal-kaderisasi">
            <label>Tanggal Kaderisasi</label>
            <input type="date" name="tanggal_kaderisasi" class="form-control">
          </div>

          <div class="form-group row-nama-kaderisasi">
            <label>Nama Kepala Field</label>
            <select name="kepala_id" class="form-control form-control-user">
              <option value="" selected>--Pilih Kepala Field--</option>
              <?php foreach ($dataKepalaField as $row) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['Nama'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group row-nama-kaderisasi">
            <label>Nama Kader</label>
            <select name="kader_id" class="form-control form-control-user">
              <option value="" selected>--Pilih Kader--</option>
              <?php foreach ($dataAreaHead as $row) { ?>
                <option value="<?php echo $row['id_data_id'] ?>"><?php echo $row['Nama'] ?></option>
              <?php } ?>
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
<div class="modal fade" id="edit-fieldsdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Field SDM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="<?php echo base_url('stkb/edit_fieldsdm') ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="project" value="">
        <input type="hidden" name="progress" value="">
        <div class="modal-body">

          <div class="form-group">
            <label>Posisi</label>
            <select class="form-control form-control-user" name="posisi" required>
              <option value="Kepala Field">Kepala Field</option>
              <option value="Area Head">Area Head</option>
              <option value="Field Officer">Field Officer</option>
              <option value="Pewitnes">Pewitnes</option>
            </select>
          </div>

          <div class="form-group">
            <label>Nama</label>
            <select name="id_data_id" class="form-control form-control-user" required>
              <option value="" selected>--Pilih Nama--</option>
              <?php foreach ($data as $row) { ?>
                <option value="<?php echo $row['Id'] ?>"><?php echo $row['Nama'] . " - " . $row['Id'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group row-status">
            <label>Status</label>
            <select class="form-control form-control-user" name="status">
              <option value="Kontrak">Kontrak</option>
              <option value="Mitra">Mitra</option>
            </select>
          </div>

          <div class="form-group">
            <label>Kota</label>
            <select name="kota_id" class="form-control form-control-user" required>
              <option value="" selected>--Pilih Kota--</option>
              <?php foreach ($data_kota as $row) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['nm_kota'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group row-jumlah-kaderisasi">
            <label>Jumlah Target Kaderisasi</label>
            <input type="number" name="jumlah_kaderisasi" class="form-control">
          </div>
          <div class="form-group row-rentang-kaderisasi">
            <label>Rentang Tanggal Target Kaderisasi</label>
            <div class="row">
              <div class="col-sm-6">
                <label>Dari</label>
                <input type="date" name="mulai_kaderisasi" class="form-control">
              </div>
              <div class="col-sm-6">
                <label>Sampai</label>
                <input type="date" name="selesai_kaderisasi" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group row-nama-pj-kaderisasi">
            <label>Penanggung Jawab Kaderisasi</label>
            <select name="penanggung_jawab_kaderisasi" class="form-control form-control-user">
              <option value="" selected>--Pilih Kepala Field--</option>
              <?php foreach ($dataKepalaField as $row) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['Nama'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group row-tanggal-mulai">
            <label>Tanggal Mulai Kontrak/Mitra</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="">
          </div>
          <div class="form-group row-tanggal-selesai">
            <label>Tanggal Selesai Kontrak/Mitra</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="">
          </div>
          <div class="form-group row-tanggal-kaderisasi">
            <label>Tanggal Kaderisasi</label>
            <input type="date" name="tanggal_kaderisasi" class="form-control" value="">
          </div>
          <div class="form-group row-nama-kaderisasi">
            <label>Nama Kepala Field</label>
            <select name="kepala_id" class="form-control form-control-user">
              <option value="" selected>--Pilih Kepala Field--</option>
              <?php foreach ($dataKepalaField as $row) { ?>
                <option value="<?php echo $row['id_data_id'] ?>"><?php echo $row['Nama'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group row-nama-kaderisasi">
            <label>Nama Kader</label>
            <select name="kader_id" class="form-control form-control-user">
              <option value="" selected>--Pilih Kader--</option>
              <?php foreach ($dataAreaHead as $row) { ?>
                <option value="<?php echo $row['id'] ?>"><?php echo $row['Nama'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label>Upload Memo</label>
            <input type="file" name="memo_sdm" accept="application/pdf" class="form-control">
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

<div class="modal fade" id="printsdm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Input Periode</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" target="_blank" action="" enctype="multipart/form-data" id="form-print-sdm">
          <input type="hidden" name="status" value="non-mitra">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control" required>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" class="form-control" required>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Print</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="printSdmMitra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Data Mitra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" target="_blank" action="" enctype="multipart/form-data" id="form-print-sdm-mitra">
        <input type="hidden" name="status" value="mitra">
        <input type="hidden" name="progress" value="">
        <input type="hidden" name="project" value="">
        <input type="hidden" name="nomorstkb" value="">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-3">
              <p><b>Project</b></p>
            </div>
            <div class="col-lg-2">
              <p><b>Nomor STKB</b></p>
            </div>
            <div class="col-lg-3">
              <p><b>Cabang</b></p>
            </div>
            <div class="col-lg-2">
              <p><b>Progress</b></p>
            </div>
            <div class="col-lg-2">
              <p><b>Action</b></p>
            </div>
          </div>
          <hr>
          <div class="content-body">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="submit" class="btn btn-primary">Print</button> -->
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
  $(document).on('click', '.btn-print-sdm', function() {
    $('#form-print-sdm').attr('action', '<?php echo base_url(); ?>stkb/print_reportsdm/675/0/' + $(this).data('id'))
  })
  $(document).on('click', '.btn-print-sdm-mitra', function() {
    console.log($(this).data('nama'));
    $('#printSdmMitra .modal-title').text('Data Mitra ' + $(this).data('nama'));
    $('#form-print-sdm-mitra').attr('action', '<?php echo base_url(); ?>stkb/print_reportsdm/675/0/' + $(this).data('id'))
  })

  $(document).on('click', '.btn-edit-field', function() {
    if ($(this).data('posisi') == 'Field Officer' || $(this).data('posisi') == 'Pewitnes') {
      $('.row-status').hide();
      $('.row-tanggal-mulai').hide();
      $('.row-tanggal-selesai').hide();
      $('.row-rentang-kaderisasi').hide();
      $('.row-jumlah-kaderisasi').hide();

      $('.row-tanggal-kaderisasi').show();
      $('.row-nama-kaderisasi').show();
    } else {
      $('.row-tanggal-kaderisasi').hide();
      $('.row-nama-kaderisasi').hide();

      $('.row-status').show();
      $('.row-tanggal-selesai').show();
      $('.row-tanggal-mulai').show();


      $('select[name=status]').empty();
      var text = '';
      text += '<option value="" selected>--Pilih Status--</option>';
      text += '<option value="Kontrak">Kontrak</option>';
      text += '<option value="Mitra">Mitra</option>';

      var text2 = '';
      text2 += '<option value="" selected>--Pilih Status--</option>';
      text2 += '<option value="Kontrak">Kontrak</option>';
      text2 += '<option value="Permanen">Permanen</option>';

      if ($(this).data('posisi') == 'Kepala Field') {
        $('.row-rentang-kaderisasi').hide();
        $('.row-jumlah-kaderisasi').hide();
        $('select[name=status]').append(text2);
      } else if ($(this).data('posisi' == 'Area Head')) {
        $('.row-rentang-kaderisasi').show();
        $('.row-jumlah-kaderisasi').show();
        $('select[name=status]').append(text);
      }
    }

    $('#edit-fieldsdm [name=id]').val($(this).data('id'));
    $('#edit-fieldsdm [name=id_data_id]').val($(this).data('id_data')).change();
    $('#edit-fieldsdm [name=kota_id]').val($(this).data('kota_id')).change();
    $('#edit-fieldsdm [name=posisi]').val($(this).data('posisi')).change();
    $('#edit-fieldsdm [name=status]').val($(this).data('status')).change();
    $('#edit-fieldsdm [name=tanggal_mulai]').val($(this).data('tanggal_mulai')).change();
    $('#edit-fieldsdm [name=tanggal_selesai]').val($(this).data('tanggal_selesai')).change();
    $('#edit-fieldsdm [name=tanggal_kaderisasi]').val($(this).data('tanggal_kaderisasi')).change();
    $('#edit-fieldsdm [name=kader_id]').val($(this).data('kader_id')).change();
    $('#edit-fieldsdm [name=jumlah_kaderisasi]').val($(this).data('jumlah_kaderisasi')).change();
    $('#edit-fieldsdm [name=mulai_kaderisasi]').val($(this).data('mulai_kaderisasi')).change();
    $('#edit-fieldsdm [name=selesai_kaderisasi]').val($(this).data('selesai_kaderisasi')).change();
    $('#edit-fieldsdm [name=penanggung_jawab_kaderisasi]').val($(this).data('penanggung_jawab_kaderisasi')).change();

  });

  $(document).on('click', '.submit-sdm-mitra', function() {
    $('#printSdmMitra [name=project]').val($(this).data('project'));
    $('#printSdmMitra [name=progress]').val($(this).data('progress'));
    $('#printSdmMitra [name=nomorstkb]').val($(this).data('nomorstkb'));
  });

  $(document).on('click', '.btn-print-sdm-mitra', function() {
    $('#printSdmMitra .content-body').empty();
    const id_data_id = $(this).data('id_data_id');
    $.ajax({
      url: "<?php echo base_url('stkb/get_daftar_cabang') ?>",
      type: "post",
      data: {
        'id_data_id': id_data_id
      },
      success: function(result) {
        $('#printSdmMitra .content-body').append(result);
      }
    })
  })
  $(document).ready(function() {
    $('select[name="posisi"]').change(function() {
      if ($(this).val() == 'Field Officer' || $(this).val() == 'Pewitnes') {
        $('.row-status').hide();
        $('.row-tanggal-selesai').hide();
        $('.row-tanggal-mulai').hide();

        $('.row-tanggal-kaderisasi').show();
        $('.row-nama-kaderisasi').show();

        $('.row-jumlah-kaderisasi').hide();
        $('.row-rentang-kaderisasi').hide();
        $('.row-nama-pj-kaderisasi').hide();
      } else {
        $('.row-tanggal-kaderisasi').hide();
        $('.row-nama-kaderisasi').hide();

        $('.row-status').show();
        $('.row-tanggal-selesai').show();
        $('.row-tanggal-mulai').show();

        $('select[name=status]').empty();
        var text = '';
        text += '<option value="" selected>--Pilih Status--</option>';
        text += '<option value="Kontrak">Kontrak</option>';
        text += '<option value="Mitra">Mitra</option>';

        var text2 = '';
        text2 += '<option value="" selected>--Pilih Status--</option>';
        text2 += '<option value="Kontrak">Kontrak</option>';
        text2 += '<option value="Permanen">Permanen</option>';
        if ($(this).val() == 'Kepala Field') {
          $('.row-rentang-kaderisasi').hide();
          $('.row-jumlah-kaderisasi').hide();
          $('.row-nama-pj-kaderisasi').hide();
          $('select[name=status]').append(text2);
        } else if ($(this).val() == 'Area Head') {
          $('.row-rentang-kaderisasi').show();
          $('.row-jumlah-kaderisasi').show();
          $('.row-nama-pj-kaderisasi').show();
          $('select[name=status]').append(text);
        }
      }
    })
  })
</script>