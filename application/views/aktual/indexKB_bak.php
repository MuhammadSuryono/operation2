<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> Aktual </h3>
    <div class="row mt">
      <div class="col-lg-12">


        <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Aktual Success </strong></h4>

              <div class="col-lg-12">
                <?= $this->session->flashdata('info'); ?>
              </div>

              <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Nama Cabang</th>
                      <th>Kode Kunjungan</th>
                      <th>Skenario</th>
                      <th>Kode Token</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id_user = $this->session->userdata('id_user');
                    $no = 1;
                    foreach ($aktual as $db) :
                      // if (strstr($db['sts'], '0') == "") :
                      if (strstr($db['sts'], '0')) :
                        $data = explode(",", $db['skenario']);
                        $data1 = explode(",", $db['kode_skenario']); ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $db['nama_project'] ?></td>
                          <td><?= $db['cabangx'] ?></td>
                          <td><?= $db['kunjungan1'] ?></td>
                          <td><?php for ($i = 0; $i < count($data1); $i++) :
                                    $cek = $this->db->get_where('quest', ['shp' => $id_user, 'project' => $db['project'], 'cabang' => $db['cabang'], 'kunjungan' => $data1[$i], 'status' => 0])->num_rows(); ?>
                              <?= $data[$i]; ?>
                              <?php if ($cek == 1) : ?>
                                (<span class="fa fa-times text-danger fa-fw"></span>),
                              <?php else : ?>
                                (<span class="fa fa-check text-success fa-fw"></span>),
                              <?php endif; ?>
                            <?php endfor; ?>
                          </td>
                          <td>
                            <!-- <?php echo isset($token) != '' ? $token : ""; ?> -->
                          </td>
                          <td>
                            
                            <?php $equest = $this->db->get_where('data_jawaban_equest', ['id_user' => $id_user, 'id_project' => $db['project'], 'kode_cabang' => $db['cabang'], 'id_kunjungan' => $db['r_kategori']])->num_rows(); ?>

                            <?php if ($equest == 1) : ?>

                              <a class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> E-quest </a>

                              <a href="<?= base_url('shp/tambah/') ?><?= $db['r_kategori'] ?>/<?= $db['project'] ?>/<?= $db['cabang'] ?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> Dialog </a>

                              <a href="<?= base_url('rekaman/tambahKB1/') ?><?= $db['r_kategori'] ?>/<?= $db['project'] ?>/<?= $db['cabang'] ?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> Rekaman </a>

                              <a href="<?= base_url('shp/uploadKB/') ?><?= $db['r_kategori'] ?>/<?= $db['project'] ?>/<?= $db['cabang'] ?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> Upload </a>

                            <?php else : ?>
                              <a href="<?= base_url('equestisi/isi/') ?><?= $db['r_kategori'] ?>/<?= $db['project'] ?>/<?= $db['cabang'] ?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> E-quest </a>

                              <a class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> Dialog </a>

                              <a class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> Rekaman </a>

                              <a class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> Upload </a>
                            <?php endif ?>
                          </td>
                        </tr>
                      <?php endif ?>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </section>
            </div>
          </div>
        </div>


      </div>
    </div>
  </section>
  <!-- /wrapper -->
</section>