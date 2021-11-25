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
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Matrix Honor Field SDM</strong> </h4>

              <?php if ($user['id_divisi'] == 99) : ?>
                <a href="" class="btn btn-round btn-primary mb" data-target="#tambahls" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>
              <?php endif; ?>

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

              <section id="unseen">
                <div class="table-responsive">
                  <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                    <thead>
                      <tr bgcolor="#e3f3fc">
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">No</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Kategori Kota</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Posisi</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Status</th>
                        <th colspan="2">
                          <center>Supervisi</center>
                        </th>
                        <th colspan="2" style="vertical-align : middle;text-align:center;">Produktivitas</th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Training</th>
                        <th colspan="3">
                          <center>Insentif</center>
                        </th>
                        <th colspan="4">
                          <center>Penalti</center>
                        </th>
                        <th rowspan="2" style="vertical-align : middle;text-align:center;">Aksi</th>
                      </tr>
                      <tr bgcolor="#e3f3fc">
                        <th>Mitra</th>
                        <th>Kontrak</th>

                        <th>Setempat</th>
                        <th>Luar Kota</th>

                        <th>Sesuai Timeline</th>
                        <th>Kaderisasi</th>
                        <th>Upload Tepat Waktu</th>

                        <th>Pengulangan</th>
                        <th>Keterlambatan Upload</th>
                        <th>Keterlambatan Timeline</th>
                        <th>Target Kaderisasi Tidak Terpenuhi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $urut = 1;
                      foreach ($getallhonor as $data) :
                      ?>
                        <tr>
                          <td><b><?php echo $urut++; ?></b></td>
                          <td><?php echo $data['jeniskota'] ?></td>
                          <td><?php echo $data['posisi'] ?></td>
                          <td><?php echo $data['status'] ?></td>
                          <td><?php echo "Rp " . number_format($data['supervisi_mitra'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['supervisi_kontrak'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['produktivitas'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['produktivitas_lk'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['training'], 0, ',', '.'); ?></td>

                          <td><?php echo "Rp " . number_format($data['insentif_timeline'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['insentif_kaderisasi'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['insentif_upload'], 0, ',', '.'); ?></td>

                          <td><?php echo "Rp " . number_format($data['penalti_pengulangan'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['penalti_keterlambatan_upload'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['penalti_keterlambatan_timeline'], 0, ',', '.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['penalti_kaderisasi'], 0, ',', '.'); ?></td>
                          <td>
                            <center>
                              <?php if ($user['id_divisi'] == 99) : ?>
                                <button type="button" data-toggle="modal" data-target="#edit_honor<?php echo $data['id'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button><br>
                                <a href="<?php echo base_url(); ?>stkb/hapus_honor_fieldsdm/<?php echo $data['id']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
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

<div class="modal fade " id="tambahls" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Input Matrix Honor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('stkb/tambah_honor_fieldsdm') ?>">
          <div class="form-group">
            <label>Kategori Kota</label>
            <select class="form-control form-control-user" name="kota">
              <option value="" selected="">--Pilih Kategori Kota--</option>
              <option value="KOTA 1">KOTA 1</option>
              <option value="KOTA 2">KOTA 2</option>
              <option value="KOTA 3">KOTA 3</option>
            </select>
          </div>

          <div class="form-group">
            <label>Posisi</label>
            <select class="form-control form-control-user" name="posisi" required>
              <option value="" selected>--Pilih Posisi--</option>
              <option value="Kepala Field">Kepala Field</option>
              <option value="Area Head">Area Head</option>
              <option value="Field Officer">Field Officer</option>
            </select>
          </div>

          <div class="form-group">
            <label>Status</label>
            <select class="form-control form-control-user" name="status" required>
              <option value="" selected>--Pilih Status--</option>
              <option value="Kontrak">Kontrak</option>
              <option value="Mitra">Mitra</option>
            </select>
          </div>

          <div class="form-group">
            <label>Honor Produktivitas Setempat</label>
            <input type="number" name="produktivitas" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
          </div>

          <div class="form-group">
            <label>Honor Produktivitas Luar Kota</label>
            <input type="number" name="produktivitas_lk" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
          </div>

          <div class="row-supervisi" style="display: none;">
            <div class="form-group">
              <label>Honor Supervisi Mitra (per cabang)</label>
              <input type="number" name="supervisi_mitra" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
            </div>

            <div class="form-group">
              <label>Honor Supervisi Kontrak (per hari)</label>
              <input type="number" name="supervisi_kontrak" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
            </div>
          </div>

          <div class="form-group">
            <label>Honor Training (per training)</label>
            <input type="number" name="training" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
          </div>

          <div class="form-group">
            <label>Honor Insentif : </label>
            <div class="row">
              <div class="col-md-4 form-group">
                <label>Sesuai Timeline (per kuesioner)</label>
                <input type="number" name="insentif_timeline" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
              </div>
              <div class="col-md-4 form-group">
                <label>Kaderisasi (per orang)</label>
                <input type="number" name="insentif_kaderisasi" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
              </div>
              <div class="col-md-4 form-group">
                <label>Upload Tepat Waktu (per kuesioner)</label>
                <input type="number" name="insentif_upload" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Penalti :</label>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>Pengulangan (per kuesioner)</label>
                <input type="number" name="penalti_pengulangan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
              </div>

              <div class="col-md-6 form-group">
                <label>Target Kaderisasi Tidak Terpenuhi (per orang)</label>
                <input type="number" name="penalti_kaderisasi" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label>Telat Upload (per kuesioner)</label>
                <input type="number" name="penalti_keterlambatan_upload" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
              </div>
              <div class="col-md-6 form-group">
                <label>Telat Timeline (per hari)</label>
                <input type="number" name="penalti_keterlambatan_timeline" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
              </div>
            </div>
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


<?php
$no = 0;
foreach ($getallhonor as $item) : $no++;
?>
  <div class="modal fade" id="edit_honor<?php echo $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Edit Matrix Honor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="POST" action="<?php echo base_url('stkb/edit_honor_fieldsdm') ?>">
            <input type="hidden" name="id" value="<?= $item['id'] ?>">
            <div class="form-group">
              <label>Kategori Kota</label>
              <select class="form-control form-control-user" name="kota">
                <option value="" selected="">--Pilih Kategori Kota--</option>
                <option value="KOTA 1" <?= ($item['jeniskota'] == 'KOTA 1') ? 'selected' : ''; ?>>KOTA 1</option>
                <option value="KOTA 2" <?= ($item['jeniskota'] == 'KOTA 2') ? 'selected' : ''; ?>>KOTA 2</option>
                <option value="KOTA 3" <?= ($item['jeniskota'] == 'KOTA 3') ? 'selected' : ''; ?>>KOTA 3</option>
              </select>
            </div>

            <div class="form-group">
              <label>Posisi</label>
              <select class="form-control form-control-user" name="posisi" required>
                <option value="Kepala Field" <?= ($item['posisi'] == 'Kepala Field') ? 'selected' : ''; ?>>Kepala Field</option>
                <option value="Area Head" <?= ($item['posisi'] == 'Area Head') ? 'selected' : ''; ?>>Area Head</option>
                <option value="Field Officer" <?= ($item['posisi'] == 'Field Officer') ? 'selected' : ''; ?>>Field Officer</option>
              </select>
            </div>

            <div class="form-group">
              <label>Status</label>
              <select class="form-control form-control-user" name="status" required>
                <option value="Kontrak" <?= ($item['status'] == 'Kontrak') ? 'selected' : ''; ?>>Kontrak</option>
                <option value="Mitra" <?= ($item['status'] == 'Mitra') ? 'selected' : ''; ?>>Mitra</option>
              </select>
            </div>

            <div class="row-supervisi" style="<?= ($item['posisi'] != 'Area Head') ? "display: none;" : '' ?>">
              <div class="form-group">
                <label>Honor Supervisi Mitra (per cabang)</label>
                <input type="number" name="supervisi_mitra" class="form-control form-control-user" aria-describedby="emailHelp" value="<?= ($item['supervisi_mitra']) ? $item['supervisi_mitra'] : '0' ?>">
              </div>

              <div class="form-group">
                <label>Honor Supervisi Kontrak (per hari)</label>
                <input type="number" name="supervisi_kontrak" class="form-control form-control-user" aria-describedby="emailHelp" value="<?= ($item['supervisi_kontrak']) ? $item['supervisi_kontrak'] : '0' ?>">
              </div>
            </div>

            <div class="form-group">
              <label>Honor Produktivitas Setempat</label>
              <input type="number" name="produktivitas" class="form-control form-control-user" aria-describedby="emailHelp" value="<?= ($item['produktivitas']) ? $item['produktivitas'] : '0' ?>">
            </div>

            <div class="form-group">
              <label>Honor Produktivitas Luar Kota</label>
              <input type="number" name="produktivitas_lk" class="form-control form-control-user" aria-describedby="emailHelp" value="<?= ($item['produktivitas_lk']) ? $item['produktivitas_lk'] : '0' ?>">
            </div>

            <div class="form-group">
              <label>Honor Training (per training)</label>
              <input type="number" name="training" class="form-control form-control-user" value="<?= ($item['training']) ? $item['training'] : '0' ?>">
            </div>

            <div class="form-group">
              <label>Honor Insentif : </label>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>Sesuai Timeline (per kuesioner)</label>
                  <input type="number" name="insentif_timeline" class="form-control form-control-user" value="<?= ($item['insentif_timeline']) ? $item['insentif_timeline'] : '0' ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label>Kaderisasi (per orang)</label>
                  <input type="number" name="insentif_kaderisasi" class="form-control form-control-user" value="<?= ($item['insentif_kaderisasi']) ? $item['insentif_kaderisasi'] : '0' ?>">
                </div>
              </div>
              <div class="form-group">
                <label>Upload Tepat Waktu (per kuesioner)</label>
                <input type="number" name="insentif_upload" class="form-control form-control-user" value="<?= ($item['insentif_upload']) ? $item['insentif_upload'] : '0' ?>">
              </div>
            </div>

            <div class="form-group">
              <label>Penalti :</label>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>Pengulangan (per kuesioner)</label>
                  <input type="number" name="penalti_pengulangan" class="form-control form-control-user" value="<?= ($item['penalti_pengulangan']) ? $item['penalti_pengulangan'] : '0' ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label>Target Kaderisasi Tidak Terpenuhi (per orang)</label>
                  <input type="number" name="penalti_kaderisasi" class="form-control form-control-user" value="<?= ($item['penalti_kaderisasi']) ? $item['penalti_kaderisasi'] : '0' ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>Telat Upload (per hari)</label>
                  <input type="number" name="penalti_keterlambatan_upload" class="form-control form-control-user" value="<?= ($item['penalti_keterlambatan_upload']) ? $item['penalti_keterlambatan_upload'] : '0' ?>">
                </div>
                <div class="col-md-6 form-group">
                  <label>Telat Timeline (per hari)</label>
                  <input type="number" name="penalti_keterlambatan_timeline" class="form-control form-control-user" value="<?= ($item['penalti_keterlambatan_timeline']) ? $item['penalti_keterlambatan_timeline'] : '0' ?>">
                </div>
              </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
  $('select[name="posisi"]').change(function() {
    if ($(this).val() == 'Area Head') {
      $('.row-supervisi').show();
    } else {
      $('.row-supervisi').hide();
      $('input[name=supervisi_mitra]').val(0);
      $('input[name=supervisi_kontrak]').val(0);
    }
  })
</script>