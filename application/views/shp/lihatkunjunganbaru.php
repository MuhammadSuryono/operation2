<?php $id = $this->session->userdata('id_user');
$akses1 = $this->db->get_where('data_user', ['id_user' => $id])->row_array();
$akses = $akses1['id_akses'];
?>
<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Bukti Kunjungan Skenario <?= $data_kunjungan['nama_skenario']?></h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Slip Transaksi </strong></h4>
               <!-- Awal -->
                <div class="project-wrapper">
                <div class="project">
                    <div class="photo-wrapper">
                    <div class="photo">
                        <a class="fancybox" href="<?= base_url('assets/')?>file/<?=$data_kunjungan['gambar_transaksi']?>"><img class="img-responsive" src="../../assets/file/<?=$data_kunjungan['gambar_transaksi']?>" alt=""></a>
                    </div>
                    <div class="overlay"></div>
                    </div>
                </div>
                </div>
                <!-- akhir -->
                <?php if($akses == 1) :?>
                  <a href="<?= base_url('validasi/stsTransaksi/')?><?= $data_kunjungan['id_kunjungan']?>" class="btn btn-success btn-round mt" data-dismiss="modal"><span class="fa fa-check fa-fw"></span> Terima </a>
                  <a href="<?= base_url('validasi/stsTransaksi1/')?><?= $data_kunjungan['id_kunjungan']?>" class="btn btn-danger btn-round mt pull-right" data-dismiss="modal"><span class="fa fa-times fa-fw"></span> Tolak </a>
                <?php endif?>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Screenshot Equest </strong></h4>
                <!-- Awal -->
                <div class="project-wrapper">
                <div class="project">
                    <div class="photo-wrapper">
                    <div class="photo">
                        <a class="fancybox" href="<?= base_url('assets/')?>file/<?=$data_kunjungan['gambar_equest']?>"><img class="img-responsive" src="../../assets/file/<?=$data_kunjungan['gambar_equest']?>" alt=""></a>
                    </div>
                    <div class="overlay"></div>
                    </div>
                </div>
                </div>
                <!-- akhir -->
                <?php if($akses == 1) :?>
                  <a href="<?= base_url('validasi/stsEquest/')?><?= $data_kunjungan['id_kunjungan']?>" class="btn btn-success btn-round mt" data-dismiss="modal"><span class="fa fa-check fa-fw"></span> Terima </a>
                  <a href="<?= base_url('validasi/stsEquest1/')?><?= $data_kunjungan['id_kunjungan']?>" class="btn btn-danger btn-round mt pull-right" data-dismiss="modal"><span class="fa fa-times fa-fw"></span> Tolak </a>
                <?php endif?>
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Layout Cabang </strong></h4>
                 <!-- Awal -->
                <div class="project-wrapper">
                <div class="project">
                    <div class="photo-wrapper">
                    <div class="photo">
                        <a class="fancybox" href="<?= base_url('assets/')?>file/<?=$data_kunjungan['gambar_layout']?>"><img class="img-responsive" src="../../assets/file/<?=$data_kunjungan['gambar_layout']?>" alt=""></a>
                    </div>
                    <div class="overlay"></div>
                    </div>
                </div>
                </div>
                <!-- akhir -->
                <?php if($akses == 1) :?>
                  <a href="<?= base_url('validasi/stsLayout/')?><?= $data_kunjungan['id_kunjungan']?>" class="btn btn-success btn-round mt" data-dismiss="modal"><span class="fa fa-check fa-fw"></span> Terima </a>
                  <a href="<?= base_url('validasi/stsLayout1/')?><?= $data_kunjungan['id_kunjungan']?>" class="btn btn-danger btn-round mt pull-right" data-dismiss="modal"><span class="fa fa-times fa-fw"></span> Tolak </a>
                <?php endif?>
                </div>
              </div>
          </div>

          <div class="row">
              <div class="col-lg-12">
                <div class="form-panel">
                    <a 
                    <?php if($akses == 1) :?>
                    href=<?=base_url('validasi/index/')?><?=$data_kunjungan['id_skenario']?> 
                    <?php else :?>
                    href=<?=base_url('shp/daftarkunjungan')?> 
                    <?php endif?>
                    type="button" class="btn btn-primary btn-lg btn-block btn-round"><i class="fa fa-check-circle-o fa-fw"></i> Selesai </a>
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