<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aktual Assign</h3>
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
                    <form class="form-horizontal style-form" method="post">

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
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $project['tanggal']?>" readonly>
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
                </form>
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

                    <div class="col-md-6">
                            <form class="form-horizontal style-form" method="post" action="<?= base_url('aktual/tambahassign')?>">
                             <input type="hidden" name="project" id="project" value="<?= $project['id_project']?>" >
                             

                            <div class="form-group">
                            <label class="col-sm-3 control-label"><strong> Nama Skenario </strong></label>
                            <div class="col-sm-9">
                                <label class="col-sm-9 pull-center control-label" style="text-align: center;"><strong> Keterangan </strong></label>
                            </div>
                            </div>
                            
                            <?php foreach($skenario as $sk) :?>
                            <input type="hidden" name="kodekunjungan" id="kodekunjungan" value="<?= $sk['id_kunjungan']?>">
                            <div class="form-group">
                            <label class="col-sm-3 control-label"><?= $sk['nama_skenario']?></label>
                            <div class="col-sm-9">
                                    <label class="radio-inline">
                                    <?php if($sk['id_status'] == '1') :?>
                                    <input type="radio" name="cek<?=$sk['id_aktual']?>" id="cek<?=$sk['id_aktual']?>" value=1 checked> 
                                    <?php else :?>
                                    <input type="radio" name="cek<?=$sk['id_aktual']?>" id="cek<?=$sk['id_aktual']?>" value=1> 
                                    <?php endif?>
                                    Sudah Dilakukan
                                    </label>

                                    <label class="radio-inline">
                                    <?php if($sk['id_status'] == '0') :?>
                                    <input type="radio" name="cek<?=$sk['id_aktual']?>" id="cek<?=$sk['id_aktual']?>" value=0 checked> 
                                    <?php else :?>
                                    <input type="radio" name="cek<?=$sk['id_aktual']?>" id="cek<?=$sk['id_aktual']?>" value=0> 
                                    <?php endif?>
                                    Belum Dilakukan
                                    </label>

                                    <label class="radio-inline">
                                    <?php if($sk['id_status'] == '3') :?>
                                    <input type="radio" name="cek<?=$sk['id_aktual']?>" id="cek<?=$sk['id_aktual']?>" value=3 checked> 
                                    <?php else :?>
                                    <input type="radio" name="cek<?=$sk['id_aktual']?>" id="cek<?=$sk['id_aktual']?>" value=3> 
                                    <?php endif?>
                                    Tidak Dilakukan
                                    </label>
                                    
                            </div>
                            </div>
                            <?php endforeach?>

                            <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                            <a href="<?= base_url('aktual/pending')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
                            <br>
                            <br>
                        </form>
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
