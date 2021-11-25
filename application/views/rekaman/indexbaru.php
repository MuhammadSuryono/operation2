<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Rekaman Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Tambah Rekaman Kunjungan </strong></h4>
                <div class="row">
                <form action="<?= base_url('rekaman/tambah')?>" method="post" enctype='multipart/form-data'>

                <div class="col-md-3 mb">
                    <select class="form-control" name="project" id="project">
                        <option value=""> Pilih Project Yang Dijalankan </option>
                        <?php foreach($project as $sk) :?>
                        <option value="<?=$sk['id_project']?>"> <?=$sk['nama_project']?> </option>
                        <?php endforeach?>
                    </select>
                </div>

                <div class="col-md-7">
                    <div class="form-group">
                    <div class="controls">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                        <span class="btn btn-theme02 btn-file">
                            <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Rekaman</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah Rekaman</span>
                        <input type="file" class="default" name="rekaman" id="rekaman" />
                        </span>
                        <span class="fileupload-preview" style="margin-left:5px;"></span>
                        <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                        </div>
                        <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                        <span>Format Rekaman ( .mp3, .wav )
                        </span>
                    </div>
                    </div>
                </div>

                <div class="col-md-2" style="margin-left: -500px;">
                    <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                </div>
                </form>
            </div>
           </div>
           <div class="row mt">
                <div class="col-lg-12">
                <div class="form-panel">
                <img src="<?=base_url('assets/')?>file/rekaman/abayar.jpg" alt="">
                <audio controls id="rekaman" src="<?=base_url('assets/')?>file/rekaman/Everytime.mp3"></audio>
                <?//php $lokasi = FCPATH . 'assets\file\rekaman\abayar.jpg';?>
                <p><?//=$lokasi?></p>
                <img src="<?//= $lokasi?>" alt="">
                </div>
                </div>
            </div>


           </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
