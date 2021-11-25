<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Form Upload Rekaman </h3>
        <div class="row mt">
            <div class="col-lg-12">

            <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Kunjungan </strong></h4>

                <div class="row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6">
<form class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                    <?php $user = $this->session->userdata('id_user');?>

                    <input type="hidden" name="user" id="user" value="<?=$user?>">
                    <input type="hidden" name="kunjungan" id="kunjungan" value="<?=$kunjungan?>">
                    <input type="hidden" name="cabang" id="cabang" value="<?=$cabang?>">
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $project['nama']?>" readonly>
                    </div>
                    </div>
                    <?php foreach($datakunjungan as $db):?>
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Kode Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="namcab" id="namcab" value="<?= $db['nama_cabang']?>" readonly>
                        <input type="hidden" class="form-control" name="kode" id="kode" value="<?= $project['kode']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Shopper</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="namshp" id="namshp" value="<?= $db['shp']?> - <?= $db['nama_shp']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal/ Waktu Aktual</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="tglaktual" id="tglaktual" value="<?= $db['waktuassign']?>" readonly>
                        <input type="hidden" class="form-control" name="tgl" id="tgl" value="<?= $project['tanggal']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Kunjungan</label>
                    <div class="col-sm-9">
                    <?php 
                            if ($project['type'] == 'n') {
                                $jenis = 'Adhoc';
                            } else {
                                $jenis = 'Industri';
                            }
                    ?>
                        <input type="text" class="form-control" name="sken" id="sken" value="<?= $db['skenariox']?>" readonly>
                        <input type="hidden" class="form-control" name="jenis" id="jenis" value="<?= $jenis?>" readonly>
                    </div>
                    </div>

                </div>
                <?php endforeach?>
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
                    <div class="col-md-12">
                            <div class="form-horizontal style-form">

                            <?php $no=0; foreach($quest as $db):?>
                            <?php $no++; ?>
                            <div class="form-group">
                            <input type="hidden" name="skenario<?=$no?>" id="skenario<?=$no?>" value="<?=$db['kunjungan']?>">
                            <input type="hidden" name="number<?=$no?>" id="number<?=$no?>" value="<?=$db['num']?>">
                            <div class="col-sm-12"><center>
                                <h4 class="col-sm-12 control-label"><center> <strong> <?=$no?>. Rekaman - <?=$db['skenariox']?> </strong><center></h4>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                     <div id='filelist'></div>
                                    </div>
                                </div>

                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                    <input onchange="cekFileAudio(this.value, `berkas<?=$no?>`)" type="file" class="default" name="uploadFile" id="uploadFile" required>
                                </span>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Berkas Wajib Gambar (.amr/.wav/.mp3/.mp4/.m4a)</span>
                            </div>
                            <center></div>
                            <?php endforeach?>
                            <input type="hidden" name="jumlahsek" id="jumlahsek" value="<?=$no?>">
                            <button id="upload" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                            <a href="<?= base_url('aktual')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>

                            <input type="hidden" id="file_ext" name="file_ext" value="<?=substr( md5( rand(10,100) ) , 0 ,10 )?>">
		                    <div id="console"></div>

                            <br>
                            <br>
                            </div>
</form>
                
                </div>
            </div>
           </div>
           </div>


	        </div>
	    </div>
    </section>
</section>

<script type="text/javascript">
    BASE_URL = "<?php echo base_url();?>"
    console.log(BASE_URL);
</script>

<script src="<?=base_url('public/')?>js/plupload/plupload.full.min.js"></script>
<script type="text/javascript" src="<?=base_url('public/')?>js/application.js"></script>