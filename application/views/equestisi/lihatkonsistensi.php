    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Cek Konsistensi Equest</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Jawaban Equest | Skenario - <?=$skenario['nama_skenario']?></strong></h4>

                <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Pertanyaan</th>
                      <th>Jawaban</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach ($soal_equest as $db):?>
                    <tr>
                      <td><?= $no?></td>
                      <td><?= $db['soal_equest']?></td>

                      <?php if($db['jenis_soal']==1 or $db['jenis_soal']==2):?>
                      <td><?=$jawaban_equest[$no-1]?></td>
                      <?php endif?>

                      <?php if($db['jenis_soal']==5) :?>
                        <td><?php $jb = explode(" ",$jawaban_equest[$no-1]);
                        for($bj=0; $bj<count($jb); $bj++){
                             $jb2 = $this->db->get_where('data_pg_equest',['kode_pg_equest' =>  $jb[$bj], 'id_soal_equest' => $db['id_soal_equest']])->row_array();
                            echo $jb2['pg_equest'].", ";
                        }?></td>
                      <?php endif?>

                      <?php if($db['jenis_soal']==3 or $db['jenis_soal']==4) :?>
                      <td><?php $jb = $this->db->get_where('data_pg_equest',['kode_pg_equest' =>  $jawaban_equest[$no-1], 'id_soal_equest' => $db['id_soal_equest']])->row_array();//php $jb = $this->db->get_where('data_pg_equest',['id_pg_equest' =>  $jawaban_equest[$no-1]])->row_array();
                      if($jb){
                        echo $jb['pg_equest'];
                      } else {
                          echo  str_replace("#@!", "", $jawaban_equest[$no-1]);
                      }
                      ?></td>
                      <?php endif?>
                    </tr>
                    <?php $no++; endforeach?>
                  </tbody>
                </table>
              </section>

              <!-- DP -->
              <!-- <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th >Nama Skenario</th>
                      <th >Nama User</th>
                      <?php foreach($soal as $db):?>
                      <th class="tooltip1"><span class="tooltiptext1"><?=$db['soal_equest']?></span><?= $db['id_soal_equest']?></th>
                      <?php endforeach?>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($jawaban as $db) :?>
                    <?php if($db['sts'] == 1) :?>
                    <tr style="background-color : #e2e4ff;">
                    <?php else :?>
                    <tr>
                    <?php endif?>
                      <td><?=$no?></td>
                      <td>-</td>
                      <td><?=$skenario['nama_skenario']?></td>
                      <td > <?= $db['nama_user']?> </td>
                      <?php $jawab = explode("|" , $db['jawaban_equest']);
                        for($i=0; $i<count($jawab); $i++) :?>
                            <?php $pg = $this->db->get_where('data_pg_equest', ['id_pg_equest' => $jawab[$i]])->row_array();
                            if($pg) : ?>
                            <td class="tooltip2"><span class="tooltiptext2"><?=$pg['pg_equest']?></span> <?=$jawab[$i]?> </td>
                            <?php else :?>
                            <td > <?=$jawab[$i]?> </td>
                            <?php endif?>
                        <?php endfor?>
                    <td><a href="#<?= base_url('cek/ubah/')?><?//= $db['id_project']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Check</a></td>
                    </tr>
                    <?php $no++; endforeach?>
                  </tbody>
                </table>
              </section>     -->
              <!-- AKHIR DP -->

            <a href="<?= base_url('equestisi/cek')?>" class="btn btn-round btn-info"><span class="fa fa-arrow-circle-left fa-fw"></span>Kembali</a>

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