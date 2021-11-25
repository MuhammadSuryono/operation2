<section id="main-content">
    <!-- <form class="form-horizontal style-form" method="post"> -->
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aktual Kunjungan</h3>
    <form action="<?= base_url('aktual/tambahassign')?>" class="form-horizontal style-form" method="post">
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Project </strong></h4>

                <div class="row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6">

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $project['nama_project']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Kode Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $project['kode_project']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Project</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $project['tanggal_project']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Jenis Project</label>
                    <div class="col-sm-9">
                    <?php
                            if ($project['jenis_project'] == 'n') {
                                $jenis = 'Adhoc';
                            } else {
                                $jenis = 'Industri';
                            }
                    ?>
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $jenis?>" readonly>
                    </div>
                    </div>

                     <div class="form-group">
                    <label class="col-sm-3 control-label">Get Maps</label>
                     <div class="col-sm-9">
                        <a class="btn btn-round btn-warning btn-block" onclick="getLocation()"><i class="fa fa-location-arrow fa-fw"></i> Get Location </a>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Langitude</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="lang" id="lang" value="106.25" readonly>
                        <?= form_error('lang', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Longitude</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="long" id="long" value="-6.55" readonly>
                        <?= form_error('long', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
            </div>
                </div>

            </div>
           </div>
           </div>

           <!-- tanda -->
           <div class="row mt">
          <div class="col-md-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Skenario </strong></h4>

                <div class="row">
                    <div class="col-md-3">
                    </div>

                    <div class="col-md-9">
                            <div class="form-horizontal style-form">
                             <input type="hidden" name="project" id="project" value="<?= $project['kode_project']?>" >
                            <div class="form-group">
                            <label class="col-sm-2 control-label"><strong> Nama Skenario </strong></label>
                            <div class="col-sm-5">
                                <label class="col-sm-9 pull-center control-label" style="text-align: center;"><strong> Keterangan </strong></label>
                            </div>
                            </div>

                            <?php
                            $no = 1;
                            foreach($skenario as $sk) :?>
                            <input type="hidden" name="kodekunjungan" id="kodekunjungan" value="<?= $sk['r_kategori']?>">
                            <input type="hidden" name="cabang" id="cabang" value="<?= $sk['cabang']?>">
                            <input type="hidden" name="numnya" id="numnya" value="<?= $sk['num']?>">
                            <input type="hidden" name="kodeskenario<?=$sk['num']?>" id="kodeskenario" value="<?= $sk['kunjungan']?>">
                            <input type="hidden" name="tglkunj<?=$sk['num']?>" id="tglkunj" value="<?= $sk['tanggal']?>">
                            <input type="hidden" name="stkb<?=$sk['num']?>" id="stkb" value="<?= $sk['nomorstkb']?>">
                            <div class="form-group">
                            <label style="text-align: left;" class="col-sm-2 control-label"><?= $sk['skenario']?></label>
                            <div class="col-sm-5">
                                    <label class="radio-inline">
                                    <?php if($sk['status'] == '1' OR $sk['status'] == '2' OR $sk['status'] == '3') :?>
                                    <input type="radio" onclick="getradio(<?=$sk['num']?>) name="cek<?=$sk['num']?>" id="cek<?=$sk['num']?>" value=1 checked>
                                    <?php else :?>
                                    <input type="radio" onclick="getradio(<?=$sk['num']?>)" name="cek<?=$sk['num']?>" id="cek<?=$sk['num']?>" value=1>
                                    <?php endif?>
                                    Sudah Dilakukan
                                    </label>

                                    <label class="radio-inline">
                                    <?php if($sk['status'] == '0') :?>
                                    <input type="radio" onclick="getradio(<?=$sk['num']?>)" name="cek<?=$sk['num']?>" id="cek<?=$sk['num']?>" value=0 checked>
                                    <?php else :?>
                                    <input type="radio" onclick="getradio(<?=$sk['num']?>)" name="cek<?=$sk['num']?>" id="cek<?=$sk['num']?>" value=0>
                                    <?php endif?>
                                    Belum Dilakukan
                                    </label>
                                    <?php $atmcenter = array('064','065','066','067');
                                    if (!in_array($sk['r_kategori'], $atmcenter)){ ?>
                                    <label class="radio-inline">
                                    <?php if($sk['status'] == '9') :?>
                                    <input type="radio" onclick="getradio(<?=$sk['num']?>) name="cek<?=$sk['num']?>" id="cek<?=$sk['num']?>" value=3 checked>
                                    <?php else :?>
                                    <input type="radio" onclick="getradio(<?=$sk['num']?>)" name="cek<?=$sk['num']?>" id="cek<?=$sk['num']?>" value="99">
                                    <?php endif?>
                                    Gagal Dilakukan
                                    </label>
                                  <?php } ?>

                            </div>
                            <div class="col-sm-5">
                                <section id="gagalkunjungan<?=$sk['num']?>">

                                </section>
                            </div>

                            </div>
                            <?php endforeach?>
                            <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                            <a href="<?= base_url('aktual/pending')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
                            <br>
                            <br>
                            </div>

                </div>
            </div>
           </div>
           </div>


          </div>
        </div>
        </form>
      </section>
      <!-- /wrapper -->
    </section>
