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
                    <form class="form-horizontal style-form" method="post" enctype='multipart/form-data' action="<?=base_url('shp/simpanKZ')?>">
                    <input type="hidden" name="kunjungan" id="kunjungan" value="<?=$kunjungan?>">
                    <input type="hidden" name="cabang" id="cabang" value="<?=$cabang?>">
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Nama Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $project['nama']?>" readonly>
                    </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="col-sm-3 control-label">Kode Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="kode" id="kode" value="<?= $project['kode']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Tanggal Project</label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" name="tgl" id="tgl" value="<?= $project['tanggal']?>" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-3 control-label">Jenis Project</label>
                    <div class="col-sm-9">
                    <?php 
                            if ($project['type'] == 'n') {
                                $jenis = 'Adhoc';
                            } else {
                                $jenis = 'Industri';
                            }
                    ?>
                        <input type="text" class="form-control" name="jenis" id="jenis" value="<?= $jenis?>" readonly>
                    </div>
                    </div>

                </div>
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
                            <div class="form-group">
                            <label class="col-sm-2 control-label" ><strong> Nama Skenario </strong></label>
                            <div class="col-sm-5">
                                <label class="col-sm-9 pull-center control-label" ><strong> Upload File Dialog </strong></label>
                            </div>
                            <div class="col-sm-5">
                                <label class="col-sm-9 pull-center control-label" ><strong> Dialog </strong></label>
                            </div>
                            </div>

                            <?php $no=1; foreach($quest as $db):?>
                            <div class="form-group">
                            <label class="col-sm-2 control-label"><strong> <?=$no++?>. <?=$db['skenariox']?> </strong></label>
                            <input type="hidden" name="skenario<?=$no?>" id="skenario<?=$no?>" value="<?=$db['kunjungan']?>">
                            <input type="hidden" name="number<?=$no?>" id="number<?=$no?>" value="<?=$db['num']?>">
                            <div class="col-sm-5">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-theme02 btn-file">
                                    <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                                <input type="file" class="default" name="berkas<?=$no?>" id="berkas<?=$no?>"/>
                                </span>
                                <span class="fileupload-preview" style="margin-left:5px;"></span>
                                <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                </div>
                                <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                <span>Format Dokumen ( .pdf )
                                </span>
                            </div>
                            <div class="col-sm-5">
                                 <textarea class="form-control textarea" id="dialog<?=$no?>" name="dialog<?=$no?>" placeholder="Tulis Dialog disini..."></textarea>
                            </div>
                            </div>
                            <?php endforeach?>
                            <input type="hidden" name="jumlahsek" id="jumlahsek" value="<?=$no?>">
                            <button type="submit" id="simpandialog" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
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
