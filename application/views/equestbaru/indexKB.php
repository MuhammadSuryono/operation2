<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Equest KB</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Buat Equest Baru </strong></h4>
                <div class="row">
                <form action="<?= base_url('equestbaru/skenario')?>" method="post">
                <div class="col-md-3 mb">
                    <select class="form-control" name="project" id="project">
                        <option value=""> Pilih Skenario </option>
                        <?php foreach($skenario as $sk) :?>
                        <option value="<?=$sk['kategori']?>-<?=$sk['kode_project']?>"> <?=$sk['nama_project']?>(<?=$sk['kode_project']?>) - <?=$sk['kunjunganx']?> </option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Buat</button>
                </div>
                </form>
            </div>
           </div>

           <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Equest </strong></h4>
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Project</th>
                      <th>Kunjungan</th>
                      <th>Skenario</th>
                      <th>Jumlah Soal</th>
                      <th>Tanggal Buat</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($buat_equest as $db) :?>
                      <?php if($no%2!=0):?>
                          <tr>
                          <td style="background-color : #ffffff;">
                          <?php else :?>
                          <tr style="background-color : #e2e4ff;">
                          <td>
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['kode_project']?>-<?=$db['nama_project']?></td>
                            <td><?= $db['skenariox']?></td>

                            <!-- CARI JUMLAH SOAL EQUEST -->
                            <?php $jml = $this->db->get_where('data_soal_equest', ['id_pembuat_equest' => $db['id_pembuat_equest']])->num_rows(); 
                            $kat = $db['kategori'];
                            $pro = $db['kode_project'];
                            $sek =$this->db->query("SELECT a.*,GROUP_CONCAT(b.nama ) as skenarioxx from data_skenario_kunjungan a join attribute b on a.kode=b.kode where a.kategori='$kat' and a.kode_project='$pro' group by a.kode_project, a.kategori")->row_array();
                            ?>
                            <!-- AKHIR PENCARIAN -->


                            <td><?= $sek['skenarioxx']?> </td>
                            <td><?= $jml?> </td>
                            <td><?= $db['tanggal_buat']?></td>
                            <td>
                                <a href="<?= base_url('equestbaru/buat/')?><?= $db['id_pembuat_equest']?>" class="btn btn-primary btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Tambah</a>

                                <a href="<?= base_url('equestbaru/ubah/')?><?= $db['id_pembuat_equest']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>

                                <a href="<?= base_url('equestbaru/lihat/')?><?= $db['id_pembuat_equest']?>" class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Lihat</a>

                                <a href="<?= base_url('equestbaru/hapus/')?><?= $db['id_pembuat_equest']?>" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Hapus</a>

                            </td>
                        </tr>

                      <?php endforeach?>
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
    <!-- /MAIN CONTENT -->
    <!--main content end-->