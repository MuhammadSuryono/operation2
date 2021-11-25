<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Form Dialog</h3>
        <div class="row mt">
          <div class="col-lg-12">
                    <form class="form-horizontal style-form" method="post" enctype='multipart/form-data'>

                    <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Dialog </strong></h4>

                <div class="row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6">
                    <form class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $dialog['nama']?>" readonly>
                    </div>
                    </div>

                    <?php foreach($datakunjungan as $db):?>
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Cabang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="namcab" id="namcab" value="<?= $db['nama_cabang']?>" readonly>
                        <input type="hidden" class="form-control" name="kode" id="kode" value="<?= $dialog['kode']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Shopper</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="namshp" id="namshp" value="<?= $db['shp']?> - <?= $db['nama_shp']?>" readonly>
                        <input type="hidden" class="form-control" name="tgl" id="tgl" value="<?= $dialog['tanggal']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal/Waktu Aktual</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="tglak" id="tglak" value="<?= $db['waktuassign']?>" readonly>
                        <input type="hidden" class="form-control" name="tgl" id="tgl" value="<?= $dialog['tanggal']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Kunjungan</label>
                    <div class="col-sm-9">

                    <?php 
                            if ($dialog['type'] == 'n') {
                                $jenis = 'Adhoc';
                            } else {
                                $jenis = 'Industri';
                            }
                    ?>
                        <input type="text" class="form-control" name="kunj" id="kunj" value="<?= $db['skenariox']?>" readonly>
                        <input type="hidden" class="form-control" name="jenis" id="jenis" value="<?= $jenis?>" readonly>
                    </div>
                    </div>

                </div>
                <?php endforeach?>
                <!-- </form> -->
                </div>
                
            </div>
           </div>
           </div>
           
           <div class="row mt">
          <div class="col-md-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Skenario </strong></h4>

                <div class="row">
                    <div class="col-md-12">
                            <div class="form-horizontal style-form">
                            <!-- <div class="form-group">
                            <label class="col-sm-2 control-label" ><strong> Nama Skenario </strong></label>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Layout </strong></label>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Equest </strong></label>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Transaksi </strong></label>
                            </div>
                            </div> -->

                            <?php $no=1; foreach($quest as $db) :?>
                            <!-- <input type="hidden" class="form-control" name="nama" id="nama" value="<?= $db['nama_project']?>" readonly>
                            <input type="hidden" class="form-control" name="kode" id="kode" value="<?= $db['kode_project']?>" readonly> -->
                            <input type="hidden" class="form-control" name="nama" id="nama" value="<?= $db['nama']?>" readonly>
                            <input type="hidden" class="form-control" name="kode" id="kode" value="<?= $db['kode']?>" readonly>
                            <input type="hidden" name="num<?=$no?>" id="num<?=$no?>" value="<?=$db['num']?>">
                            <div class="form-group">
                            <label class="col-sm-2 control-label"><strong>  </strong></label>

                            <!-- Tambah if di sini munculin yang hanya di tolak saja (OUKEY BANG SIAAAP)-->
                            <?php if($db['r_sts_upload_layout']=='0'):?>
                            <div class="col-sm-3">
                                <label class="row control-label" ><strong> <center> Layout <?=$db['skenariox']?> <center> </strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="layout<?=$no?>" id="layout<?=$no?>" accept="image/*"/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar (.jpg, .gif, .png)
                                </span>
                            </div>
                           <?php endif?>
                            
                           <?php if($db['r_sts_upload_ss']=='0'):?>
                            <div class="col-sm-3">
                                <label class="row control-label" ><strong> <center> Bukti Isi Equest <?=$db['skenariox']?> <center> </strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="equest<?=$no?>" id="equest<?=$no?>" accept="image/*"/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar (.jpg, .gif, .png)
                                </span>
                            </div>
                            <?php endif?>

                            <?php if($db['r_sts_upload_slip_transaksi']=='0'):?>
                            <div class="col-sm-3">
                                <label class="row control-label" ><strong> <center> Bukti Transaksi <?=$db['skenariox']?> <center> </strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="transaksi<?=$no?>" id="transaksi<?=$no?>" accept="image/*"/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar (.jpg, .gif, .png)
                                </span>
                            </div>
                            <?php endif?>

                            </div>
                            <?php $no++; endforeach?>
                            <input type="hidden" name="jmlupload" id="jmlupload" value="<?=$no?>">
                            <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                            <a href="<?= base_url('aktual')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
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
      <!-- /wrapper -->
    </section>
