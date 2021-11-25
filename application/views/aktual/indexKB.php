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
                      <th><center>No<center></th>
                      <th><center>Nama Project<center></th>
                      <th><center>Nama Cabang<center></th>
                      <th><center>Kode Kunjungan<center></th>
                      <th><center>Skenario<center></th>
                      <!-- <th>Kode Token</th> -->
                      <th><center>Aksi<center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id_user = $this->session->userdata('id_user');
                    $no = 1;
                    foreach ($aktual as $db) :
                      if (strstr($db['sts'], '0') == "") :
                      // if (strstr($db['sts'], '0') || strstr($db['sts'], '1')) :
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
                          <!-- <td> -->
                            <?php// echo isset($token) != '' ? $token : ""; ?>
                          <!-- </td> -->
                          <td>

                              <!-- HILANGKAN TOMBOL UPLOAD JIKA SUDAH UPLOAD SEMUA -->

                              <!-- <a class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> E-quest </a> -->

                              <!-- <a href="<?= base_url('shp/tambah/') ?><?= $db['r_kategori'] ?>/<?= $db['project'] ?>/<?= $db['cabang'] ?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-pencil fa-fw"></span> Dialog </a> -->

                        <?php
                              $proj = $db['project'];
                              $cab = $db['cabang'];
                              $ktg = $db['r_kategori'];

                        // if ($ktg != '071' AND $cekq = $this->db->query("SELECT
                        //                               *
                        //                             FROM
                        //                               quest
                        //                             WHERE
                        //                               project = '$proj'
                        //                               AND cabang = '$cab'
                        //                               AND shp = '$id_user'
                        //                               AND kunjungan = '$ktg'
                        //                               AND equest is null
                        //                             ")->num_rows() != 0) :;
                        ?>
                              <!-- <center><a><span class="fa fa-warning fa-fw"></span> Anda tidak bisa upload sebelum menyelesaikan Equest </a><center> -->
                              <!-- <center><a href="<?= base_url('rekaman/tambahKB1/') ?><?= $db['r_kategori'] ?>/<?= $db['project'] ?>/<?= $db['cabang'] ?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-paperclip fa-fw"></span> Upload Bukti Kirim Rekaman </a><center> -->
                        <?//php else :?>
                              <?php
                              if ($cek = $this->db->query("SELECT
                                                          *
                                                        FROM
                                                          quest
                                                        WHERE
                                                          project = '$proj'
                                                          AND cabang = '$cab'
                                                          AND shp = '$id_user'
                                                          AND r_kategori = '$ktg'
                                                          AND rekaman_status = '0'
                                                        ")->num_rows() != 0) :;
                                ?>

                              <center><a href="<?= base_url('rekaman/tambahKB1/') ?><?= $db['r_kategori'] ?>/<?= $db['project'] ?>/<?= $db['cabang'] ?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-paperclip fa-fw"></span> Upload Bukti Kirim Rekaman </a><center>
                              <br>

                              <?php endif ?>

                              <?php
                              if ($cek = $this->db->query("SELECT
                                                          *
                                                        FROM
                                                          quest
                                                        WHERE
                                                          project = '$proj'
                                                          AND cabang = '$cab'
                                                          AND shp = '$id_user'
                                                          AND r_kategori = '$ktg'
                                                          AND `status` = '1'
                                                        ")->num_rows() != 0) :;
                                ?>

                              <center><a href="<?= base_url('shp/tambahKZ/') ?><?= $db['r_kategori'] ?>/<?= $db['project'] ?>/<?= $db['cabang'] ?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-paperclip fa-fw"></span> Dialog + Bukti Kunjungan</a><center>

                              <?php endif ?>
                          <?//php endif ?>

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
