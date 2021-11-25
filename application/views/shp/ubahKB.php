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

           <!-- tanda -->
           <div class="row mt">
          <div class="col-md-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Skenario </strong></h4>

                <div class="row">
                    <div class="col-md-12">
                            <!-- <form class="form-horizontal style-form" method="post" action="<?//= base_url('aktual/tambahassign')?>"> -->
                            <div class="form-horizontal style-form">
                             <input type="hidden" name="project" id="project" value="<?//= $dialog['kode_project']?>" >
                            <!-- <div class="form-group">
                            <label class="col-sm-2 control-label" ><strong> Nama Skenario </strong></label>
                            <div class="col-sm-5">
                                <label class="col-sm-9 pull-center control-label" ><strong> Upload </strong></label>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-sm-9 pull-center control-label" ><strong> Dialog </strong></label>
                            </div>
                            </div> -->

                            <div class="form-group">
                            <label class="col-sm-2 control-label"><strong>  </strong></label>
                            <div class="col-sm-5">
                                <label class="row control-label" ><strong> <center> Upload Dialog <?=$dialog['skenariox']?> <center> </strong></label>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="berkas" id="berkas" accept="application/pdf"/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Dokumen ( .pdf )
                                </span>
                            </div>
                            <div class="col-sm-5">
                                <label class="row control-label" ><strong> <center> Tulis Dialog <?=$dialog['skenariox']?> <center> </strong></label>
                                 <textarea class="form-control textarea" id="dialog" name="dialog" placeholder="Tulis Dialog disini..."></textarea>
                            </div>
                            </div>
                            <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                            <a href="<?= base_url('shp/cekdata')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal </a>
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
