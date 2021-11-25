<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Form Upload Berkas Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">
                    <form class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                        <input type="hidden" class="form-control" name="nama" id="nama" value="<?= $project['nama']?>" readonly>
                        <input type="hidden" class="form-control" name="kode" id="kode" value="<?= $project['kode']?>" readonly>
           <div class="row mt">
          <div class="col-md-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Skenario </strong></h4>

                <div class="row">
                    <div class="col-md-12">
                            <div class="form-horizontal style-form">
                            <div class="form-group">
                            <label class="col-sm-2 control-label" ><strong> Nama Skenario </strong></label>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Bukti Transaksi </strong></label>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Bukti Isi Equest </strong></label>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-sm-9 pull-center control-label" ><strong> Layout Cabang </strong></label>
                            </div>
                            </div>

                            <?php $no=1; foreach($quest as $db) :?>
                            <input type="hidden" name="num<?=$no?>" id="num<?=$no?>" value="<?=$db['num']?>">
                            <div class="form-group">
                            <label class="col-sm-2 control-label"><strong> <?=$no?>. <?=$db['skenariox']?> </strong></label>
                            <div class="col-sm-3">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="transaksi<?=$no?>" id="transaksi<?=$no?>" required/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar (.jpg, .gif, .png)
                                </span>
                            </div>

                            <div class="col-sm-3">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="equest<?=$no?>" id="equest<?=$no?>" required/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar (.jpg, .gif, .png)
                                </span>
                            </div>

                            <div class="col-sm-3">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="layout<?=$no?>" id="layout<?=$no?>" required/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Gambar (.jpg, .gif, .png)
                                </span>
                            </div>

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
