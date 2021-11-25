<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Form Dialog </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Dialog </strong></h4>

                <div class="row">

                <div class="col-md-3">
                </div>

                <div class="col-md-6">
                    <form class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="kunjungan" id="kunjungan" value="<?=$kunjungan?>">
                    <input type="hidden" name="cabang" id="cabang" value="<?=$cabang?>">
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $project['nama']?>" readonly>
                    </div>
                    </div>

                    <?php foreach($datakunjungan as $db):
                      $atmcenter = array('064','065','066','067');
                      if (in_array($kunjungan, $atmcenter)){
                        $data = unserialize($db['form']);
                        $waktuassign = $data['waktuassign'];
                      }else{
                        $waktuassign = $db['waktuassign'];
                      }
                    ?>
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Cabang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="namcab" id="namcab" value="<?= $db['nama_cabang']?>" readonly>
                        <input type="hidden" class="form-control" name="kode" id="kode" value="<?= $project['kode']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Shopper</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="nameshp" id="nameshp" value="<?= $db['shp']?> - <?= $db['nama_shp']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal/ Waktu Aktual</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="tglaktual" id="tglaktual" value="<?= $waktuassign;?>" readonly>
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
                        <input type="text" class="form-control" name="kunju" id="kunju" value="<?= $db['skenariox']?>" readonly>
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

           <!-- tanda -->
           <div class="row mt">
          <div class="col-md-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Upload Dialog </strong></h4>

                <div class="row">
                    <div class="col-md-12">
                            <!-- <form class="form-horizontal style-form" method="post" action="<?//= base_url('aktual/tambahassign')?>"> -->
                            <div class="form-horizontal style-form">
                             <input type="hidden" name="project" id="project" value="<?//= $project['kode_project']?>" >
                            <!-- <div class="form-group"> -->
                            <!-- <label class="col-sm-2 control-label" ><strong> Nama Skenario </strong></label>
                            <div class="col-sm-5">
                                <label class="col-sm-9 pull-center control-label" ><strong> Upload File Dialog </strong></label>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-sm-9 pull-center control-label" ><strong> Dialog </strong></label>
                            </div> -->
                            <!-- </div> -->

                            <?php $no=0; foreach($quest as $db):?>

<!-- =======================================================filter untuk upload dialog=================================================== -->
<?php if($db['kunjungan']=='001' or $db['kunjungan']=='002'  or $db['kunjungan']=='003'  or $db['kunjungan']=='004'  or $db['kunjungan']=='051'  or $db['kunjungan']=='052' or $db['kunjungan']=='053' or $db['kunjungan']=='054' or $db['kunjungan']=='055' or $db['kunjungan']=='081' or $db['kunjungan']=='012' or $db['project']=='AND1' or $db['kunjungan']=='061' or $db['kunjungan']=='099'):?>
<!-- =======================================================filter untuk upload dialog=================================================== -->

                            <?php $no++;?>
                            <div class="form-group">
                            <label class="col-sm-2 control-label"><strong>  </strong></label>
                            <input type="hidden" name="skenario<?=$no?>" id="skenario<?=$no?>" value="<?=$db['kunjungan']?>">
                            <input type="hidden" name="number<?=$no?>" id="number<?=$no?>" value="<?=$db['num']?>">
                            <div class="col-sm-5">
                                <label class="col-sm-12 pull-center control-label" ><strong><center>Upload File Dialog <?=$db['skenariox']?><center></strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input accept="application/pdf" type="file" class="default" name="berkas<?=$no?>" id="berkas<?=$no?>"/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Dokumen ( .pdf )
                                </span>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-sm-12 pull-center control-label" ><center><strong> Dialog <?=$db['skenariox']?></strong><center></label>
                                 <textarea class="form-control textarea" id="dialog<?=$no?>" name="dialog<?=$no?>" placeholder="Tulis Dialog disini..."></textarea>
                            </div>
                            </div>
<?php elseif($db['kunjungan']=='063' or $db['kunjungan']=='070' or $db['kunjungan']=='103'or $db['kunjungan']=='038' or $db['kunjungan']=='039'): ?>
<?php $no++;?>
<input type="hidden" name="skenario<?=$no?>" id="skenario<?=$no?>" value="<?=$db['kunjungan']?>">
<input type="hidden" name="number<?=$no?>" id="number<?=$no?>" value="<?=$db['num']?>">

<input style="display: none;" accept="application/pdf" type="file" name="berkas<?=$no?>" id="berkas<?=$no?>"/>



<!-- =======================================================filter untuk upload dialog=================================================== -->
<?php endif?>
<!-- =======================================================filter untuk upload dialog=================================================== -->

                            <?php endforeach?>
                            <input type="hidden" name="jumlahsek" id="jumlahsek" value="<?=$no?>">
                            <!-- <button type="submit" id="simpandialog" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                            <a href="<?= base_url('aktual')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a> -->
                            <br>
                            <br>
                            </div>
                    <!-- </form> -->

                </div>
            </div>
           </div>
           <!-- </div> -->

        <div class="row mt">
          <div class="col-md-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Upload Bukti Kunjungan </strong></h4>

                <!-- <div class="row">
                    <div class="col-md-12"> -->
                            <!-- <div class="form-horizontal style-form">
                            <div class="form-group">
                            <label class="col-sm-2 control-label" ><strong> </strong></label>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Bukti Transaksi </strong></label>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Bukti Isi Equest </strong></label>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Layout Cabang </strong></label>
                            </div>
                            </div> -->

                            <?php $no=0; foreach($quest as $db) :?>

<!-- =====================================================filter untuk bukti transaksi=================================================== -->
<?php if($db['kunjungan']=='081' OR $db['kunjungan']=='012' OR $db['kunjungan']=='105' OR $db['kunjungan']=='100' OR $db['kunjungan']=='101' ):?>

<?php else :?>
<!-- =====================================================filter untuk bukti transaksi=================================================== -->

                        <?php $no++;?>
                        <div class="row">
                            <div class="col-md-12">
                            <input type="hidden" name="num<?=$no?>" id="num<?=$no?>" value="<?=$db['num']?>">
                            <div class="form-group">
                            <!-- <label class="col-sm-2 control-label"><strong> </strong></label> -->
                              <?php if($db['kunjungan']!='038' AND $db['kunjungan']!='039') {?>
                            <div class="col-sm-3 mb">
                                <label class="row control-label"><strong> <center>Bukti Transaksi <?=$db['skenariox']?><center> </strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <?php if ($project['channel'] == 'Digital Banking') { ?>
                                    <input type="file" class="default" name="transaksi<?=$no?>" id="transaksi<?=$no?>" accept=".jpg, .jpeg, .png, .pdf" required/>
                                <?php } else { ?>
                                    <input type="file" class="default" name="transaksi<?=$no?>" id="transaksi<?=$no?>" accept=".jpg, .jpeg, .png" required/>
                                <?php } ?>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar Bukti Transaksi(.jpg, .jpeg, .png<?php if ($project['channel'] == 'Digital Banking') { echo ", .pdf";} ?>)
                                </span>
                            </div>
                        <?php } ?>

                            <?php if($db['kunjungan']=='001' or $db['kunjungan']=='002'  or $db['kunjungan']=='003'  or $db['kunjungan']=='004'  or $db['kunjungan']=='051'  or $db['kunjungan']=='052'  or $db['kunjungan']=='053') {?>
                            <div class="col-sm-3 mb">
                            <label class="row control-label"><strong> <center>Bukti Isi Equest <?=$db['skenariox']?><center> </strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input accept=".jpg, .jpeg, .png" type="file" class="default" name="equest<?=$no?>" id="equest<?=$no?>" required/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar Bukti Isi Equest(.jpg, .jpeg, .png)
                                </span>
                            </div>

                            <div class="col-sm-3 mb">
                                <label class="row control-label"><strong> <center>Layout Cabang <?=$db['skenariox']?><center> </strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                            <?php if ($project['channel'] == 'Digital Banking') { ?>
                                <input type="file" class="default" name="layout<?=$no?>" id="layout<?=$no?>" accept=".jpg, .jpeg, .png, .pdf" required/>
                            <?php } else { ?>
                                <input type="file" class="default" name="layout<?=$no?>" id="layout<?=$no?>" accept=".jpg, .jpeg, .png" required/>
                            <?php } ?>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar Slip Transaksi(.jpg, .jpeg, .png<?php if ($project['channel'] == 'Digital Banking') { echo ", .pdf";} ?>)
                                </span>
                            </div>

                             <?php } else if($db['kunjungan'] == '038' or $db['kunjungan'] == '039') {?>

                            <div class="col-sm-3 mb">
                                <label class="row control-label"><strong> <center>Layout Cabang <?=$db['skenariox']?><center> </strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                            <?php if ($project['channel'] == 'Digital Banking') { ?>
                                <input type="file" class="default" name="layout<?=$no?>" id="layout<?=$no?>" accept=".jpg, .jpeg, .png, .pdf" required/>
                            <?php } else { ?>
                                <input type="file" class="default" name="layout<?=$no?>" id="layout<?=$no?>" accept=".jpg, .jpeg, .png" required/>
                            <?php } ?>                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar Slip Transaksi(.jpg, .jpeg, .png<?php if ($project['channel'] == 'Digital Banking') { echo ", .pdf";} ?>)
                                </span>
                            </div>
                            <?php } ?>

                            </div>
                            <!-- </div> -->

<!-- =====================================================filter untuk bukti transaksi=================================================== -->
<?php endif?>
<!-- =====================================================filter untuk bukti transaksi=================================================== -->
                            <?php endforeach?>
                            </div>
                            <div class="row">
                            <div class="form-group">
                            <div class="col-sm-11 mb">
                            <input type="hidden" name="jmlupload" id="jmlupload" value="<?=$no?>">
                            <button type="submit" class="btn btn-round btn-success pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                            <a href="<?= base_url('aktual')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
                            <br>
                            <br>
                            </div>
                            </div>
                            </div>
                    </form>

                </div>
            </div>
           </div>
           </div>

           <!-- Tammbahan -->
            </div>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
