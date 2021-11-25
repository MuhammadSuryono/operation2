    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Cek Konsistensi Data Equest Antar Soal</h3>
        <div class="row mt">
          <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Equest </strong></h4>
                <form action="<?= base_url('proses')?>" method="post">
                <div class="row mb">
                <div class="col-md-3">
                    <select class="form-control" name="div" id="div">
                        <option value=""> Pilih Skenario Yang Dijalankan </option>
                      <?php foreach ($skenario as $div) :?>
                        <option value="<?= $div['id_project']?>-<?= $div['id_skenario']?>"> <?= $div['nama_project']?> - <?= $div['nama_skenario']?> </option>
                        <!-- <option value="<?= $div['id_project']?>"> <?= $div['nama_project']?> </option> -->
                      <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                <button type="submit" class="btn btn-round btn-primary pull-right" style="margin-right:0.5rem;"><i class="fa fa-search fa-fw"></i> Tampilkan </button>
                </form>
                </div>
                    <div class="col-md-3">
                        <a href="<?//= base_url('proses/status1/')?><?//= $db['id_jawaban']?>/<?//= $skenario1['id_skenario']?>/<?//= $db['id_project']?>" class="btn btn-success btn-round" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus"><span class="fa fa-check-square fa-fw"></span>Check</a>
                    </div>
                </div>

                <!-- DP -->
              <section id="unseen">
                <table class="table table-bordered table-striped table-condensed table-responsive-sm">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th >Nama Skenario</th>
                      <th >Nama User</th>
                      <?php foreach($soal as $db):?>
                      <th><span class="tooltip1"><span class="tooltiptext1"><?=$db['soal_equest']?></span><?= $db['kode_soal']?></span></th>
                      <?php endforeach?>
                      <!-- <th>Aksi</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($jawaban as $db) :?>
                    <?php if($db['sts'] == 3) :?>
                    <tr style="background-color : #; color: #">
                    <?php else :?>
                    <tr>
                    <?php endif?>
                      <td><?=$no?></td>
                      <td><?=$project1['nama_project']?></td>
                      <td><?=$skenario1 ['nama_skenario']?></td>
                      <td > <?= $db['nama_user']?> </td>
                      <?php $jawab = explode("|" , $db['jawaban_equest']);
                        $varequest = explode(",", $db['var_equest']);
                        $i = 0;
                        foreach($soal as $cb) :?>
                            <?php if ($cb['jenis_soal']  == 1 or $cb['jenis_soal']  == 2) :?>
                                <td><?=$jawab[$i]?> </td>
                            <?php else :
                            $pg = $this->db->get_where('data_pg_equest', ['id_pg_equest' => $jawab[$i]])->row_array();
                                if($pg) : ?>
                                    <td><span class="tooltip2"><span class="tooltiptext2"><?=$pg['pg_equest']?></span> <?=$jawab[$i]?> </span></td>
                                <?php else :?>
                                    <td> <?=$jawab[$i]?> </td>
                                <?php endif?>
                            <?php endif?>
                        <?php $i++; endforeach?>
                    <!-- <td><a href="<?= base_url('proses/status/')?><?= $db['id_jawaban']?>/<?= $skenario1['id_skenario']?>/<?= $db['id_project']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Check</a></td> -->
                    <!-- <td><a href="<?= base_url('proses/status1/')?><?= $db['id_jawaban']?>/<?= $skenario1['id_skenario']?>/<?= $db['id_project']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Check</a></td> -->
                    </tr>
                    <?php $no++; endforeach?>
                  </tbody>
                </table>
              </section>    
              <!-- AKHIR DP -->


                </div>
            </div>
        </div>


                             <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Cek Konsistensi Data</h4>
                                </div>
                                <!-- KONSISTENSI JIKA MAKA -->
                                <!-- <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div style="text-align: center;"> Cek Konsistensi Antar Soal </div>
                                        </div>
                                    </div>
                                    <form action="<?=base_url('proses/status3')?>" method="post">
                                    <input type="hidden" name="id_project" id="id_project" value="<?=$modalproject?>">
                                    <input type="hidden" name="id_skenario" id="id_skenario" value="<?=$modalskenario?>">
                                    <div class="row mt">
                                        <label class="col-lg-1">Jika</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode Soal">
                                        </div>
                                        <label class="col-lg-1"> = </label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Jawaban">
                                        </div>
                                    </div>
                                    <div class="row mt">
                                        <label class="col-lg-1">Maka</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="kode1" id="kode1" placeholder="Kode Soal">
                                        </div>
                                        <label class="col-lg-1"> = </label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="nilai1" id="nilai1" placeholder="Jawaban">
                                        </div>
                                    </div>
                                </div> -->
                                <!-- AKHIR KONSISTENSI JIKA MAKA -->
                                
                                <!-- KONSISTENSI JIKA TAPI -->
                                <!-- <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div style="text-align: center;"> Cek Konsistensi Antar Soal </div>
                                        </div>
                                    </div>
                                    <form action="<?=base_url('proses/status4')?>" method="post">
                                    <input type="hidden" name="id_project" id="id_project" value="<?=$modalproject?>">
                                    <input type="hidden" name="id_skenario" id="id_skenario" value="<?=$modalskenario?>">
                                    <div class="row mt">
                                        <label class="col-lg-1">Jika</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode Soal">
                                        </div>
                                        <label class="col-lg-1"> = </label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Jawaban">
                                        </div>
                                    </div>
                                    <div class="row mt">
                                        <label class="col-lg-1">Tapi</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="kode1" id="kode1" placeholder="Kode Soal">
                                        </div>
                                        <label class="col-lg-1"> = </label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="nilai1" id="nilai1" placeholder="Jawaban">
                                        </div>
                                    </div>
                                </div> -->
                                <!-- AKHIR KONSISTENSI JIKA TAPI -->

                                <!-- KONSISTENSI HANYA JIKA -->
                                  <!-- <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div style="text-align: center;"> Cek Konsistensi Antar Soal </div>
                                        </div>
                                    </div>
                                    <form action="<?=base_url('proses/status5')?>" method="post">
                                    <input type="hidden" name="id_project" id="id_project" value="<?=$modalproject?>">
                                    <input type="hidden" name="id_skenario" id="id_skenario" value="<?=$modalskenario?>">
                                    <div class="row mt">
                                        <label class="col-lg-1">Jika</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode Soal">
                                        </div>
                                        <label class="col-lg-1"> = </label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Jawaban">
                                        </div>
                                    </div>
                                </div> -->
                                <!-- AKHIR KOMSISTENSI HAMYA JIKA -->

                                <!-- KONSISTENSI WAKTU -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div style="text-align: center;"> Cek Konsistensi Antar Soal </div>
                                        </div>
                                    </div>
                                    <form action="<?=base_url('proses/status6')?>" method="post">
                                    <input type="hidden" name="id_project" id="id_project" value="<?=$modalproject?>">
                                    <input type="hidden" name="id_skenario" id="id_skenario" value="<?=$modalskenario?>">
                                    <div class="row mt">
                                        <label class="col-lg-1">Jika</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode Soal">
                                        </div>
                                        <label class="col-lg-1"> = </label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="nilai" id="nilai" placeholder="Jawaban">
                                        </div>
                                    </div>
                                    <div class="row mt">
                                        <label class="col-lg-1">Maka</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="kode1" id="kode1" placeholder="Kode Soal">
                                        </div>
                                        <label class="col-lg-1"> = </label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" name="nilai1" id="nilai1" placeholder="Jawaban">
                                        </div>
                                    </div>
                                </div>
                                <!-- AKHIR KONSISTENSI WAKTU -->

                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary btn-round">Cek Data</button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->