    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Cek Data Inkonsistensi Equest </h3>
        <div class="row mt">
          <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Equest </strong></h4>
                <form action="<?= base_url('proses/inkonsistensi')?>" method="post">
                <div class="row mb">
                <div class="col-md-3">
                    <select class="form-control" name="div" id="div">
                        <option value=""> Pilih Skenario Yang Dijalankan </option>
                      <?php foreach ($skenario as $div) :?>
                        <option value="<?= $div['id_project']?>-<?= $div['id_skenario']?>"> <?= $div['nama_project']?> - <?= $div['nama_skenario']?> </option>
                      <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                <button type="submit" class="btn btn-round btn-primary pull-right" style="margin-right:0.5rem;"><i class="fa fa-search fa-fw"></i> Tampilkan </button>
                </form>
                </div>
                </div>

                <!-- DP -->
              <section id="unseen">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th >Nama Skenario</th>
                      <th >Nama User</th>
                      <th >Nama Cabang</th>
                      <!-- <th >Keterangan</th> -->
                      <?php foreach($soal as $db):?>
                      <th><span class="tooltip1"><span class="tooltiptext1"><?=$db['soal_equest']?></span><?= $db['kode_soal']?></span></th>
                      <?php endforeach?>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($jawaban as $db) : ?>
                    <?php if($db['sts'] == 3) :?>
                    <tr style="background-color : #dc3545; color: #ffffff">
                    <td style="background-color : #dc3545; color: #ffffff">
                    <?php else :?>
                    <tr>
                    <td>
                    <?php endif?>
                      <?=$no?></td>
                      <td><?=$project1['nama_project']?></td>
                      <td><?=$skenario1 ['nama_skenario']?></td>
                      <td > <?= $db['nama_user']?> </td>
                      <td > <?= $db['nama_cabang']?> (<?= $db['kode_cabang']?>) </td>
                      <?php $jawab = explode("|" , $db['jawaban_equest']);
                        $varequest = explode(",", $db['var_equest']);
                        $varequest2 = explode(",", $db['var_equest2']);
                        $varequest3 = explode(",", $db['var_equest3']);
                        $varequest4 = explode(",", $db['var_equest4']);
                        $varequest5 = explode(",", $db['var_equest5']);
                        $i = 0;
                        foreach($soal as $cb) :?>
                            <?php if ($cb['jenis_soal']  == 1 or $cb['jenis_soal']  == 2 ) :?>
                              <?php 
                              if (in_array($cb['kode_soal'], $varequest) or in_array($cb['kode_soal'], $varequest2) or in_array($cb['kode_soal'], $varequest3) or in_array($cb['kode_soal'], $varequest4) or in_array($cb['kode_soal'], $varequest5)):?>
                                <td style="background-color : #ffc107;"> 
                              <?php else :?>
                                <td>
                              <?php endif?>
                              <?=$jawab[$i]?> </td>
                            <?php endif?>

                            <?php if($cb['jenis_soal']  == 3 or $cb['jenis_soal']  == 4 ) :
                            $pg = $this->db->get_where('data_pg_equest', ['kode_pg_equest' => $jawab[$i], 'id_soal_equest' => $cb['id_soal_equest']])->row_array();
                                if($pg) : ?>
                                  <?php 
                                  if(in_array($cb['kode_soal'], $varequest) or in_array($cb['kode_soal'], $varequest2) or in_array($cb['kode_soal'], $varequest3) or in_array($cb['kode_soal'], $varequest4) or in_array($cb['kode_soal'], $varequest5)):?>
                                    <td style="background-color : #ffc107;"> 
                                  <?php else :?>
                                    <td>
                                  <?php endif?>
                                <span class="tooltip2"><span class="tooltiptext2"><?=$pg['pg_equest']?></span> <?=$jawab[$i]?> </span></td>
                                <?php else :?>
                                  <?php 
                                    if(in_array($cb['kode_soal'], $varequest) or in_array($cb['kode_soal'], $varequest2) or in_array($cb['kode_soal'], $varequest3) or in_array($cb['kode_soal'], $varequest4) or in_array($cb['kode_soal'], $varequest5)):
                                  ?>
                                    <td style="background-color : #ffc107;"> 
                                  <?php else :?>
                                    <td>
                                  <?php endif?>
                                <?=$jawab[$i]?> </td>
                                <?php endif?>
                            <?php endif?>

                            <?php if($cb['jenis_soal']  == 5) :
                                  $jb = explode(" ",$jawab[$i]);
                                  $tooltips = "";
                                  for($bj=0; $bj<count($jb); $bj++){
                                  $jb2 = $this->db->get_where('data_pg_equest',['kode_pg_equest' =>  $jb[$bj], 'id_soal_equest' => $cb['id_soal_equest']])->row_array();
                                  $tooltips .= $jb2['pg_equest'].",";
                                  }
                                  if(in_array($cb['kode_soal'], $varequest) or in_array($cb['kode_soal'], $varequest2) or in_array($cb['kode_soal'], $varequest3) or in_array($cb['kode_soal'], $varequest4) or in_array($cb['kode_soal'], $varequest5)):?>
                                  <td style="background-color : #ffc107;">
                                  <?php else :?>
                                  <td>
                                  <?php endif?>
                                  <span class="tooltip2"><span class="tooltiptext2"><?=$tooltips?></span> <?=$jawab[$i]?> </span></td>
                            <?php endif?>

                        <?php $i++; endforeach?>
                    </td>
                    <td><a href="<?= base_url('proses/editJawabanEquest/')?><?= $db['id_jawaban']?>" class="btn btn-round btn-success btn-sm">Edit</a></td>
                    </tr>
                    <?php $no++; endforeach?>
                  </tbody>
                </table>
                </div>
              </section>    
              <!-- AKHIR DP -->

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