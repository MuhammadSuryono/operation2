<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Upload Kolom </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Upload Kolom </strong></h4>
                 <form action="<?= base_url('upload/tambah')?>" method="post" enctype='multipart/form-data'>
                <div class="row mb">
                <div class="col-md-3">
                    <select class="form-control" name="div" id="div">
                        <option value=""> Pilih Skenario </option>
                      <?php foreach ($skenario as $div) :?>
                        <option value="<?= $div['id_skenario']?>"> <?= $div['nama_skenario']?> </option>
                      <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="fileupload fileupload-new" data-provides="fileupload">
                            <span class="btn btn-theme02 btn-file">
                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Berkas</span>
                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                            <input type="file" class="default" name="berkas" id="berkas" required/>
                            </span>
                            <span class="fileupload-preview" style="margin-left:5px;"></span>
                            <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                        </div>
                            <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                            <span>Format Dokumen ( .xls, .xlxs )</span>
                    </div>
                </div>

                <div class="col-md-2">
                <button type="submit" class="btn btn-round btn-success pull-right" style="margin-right:0.5rem;"><i class="fa fa-search fa-fw"></i> Simpan </button>
                </div>
                </div>
                </form>

                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Lihat Data Kolom </strong></h4>
                 <form action="<?= base_url('upload/index')?>" method="post" enctype='multipart/form-data'>
                <div class="row mb">
                <div class="col-md-3">
                    <select class="form-control" name="div2" id="div2">
                        <option value=""> Pilih Skenario </option>
                      <?php foreach ($skenario as $div) :?>
                        <option value="<?= $div['id_skenario']?>"> <?= $div['nama_skenario']?> </option>
                      <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-2">
                <button type="submit" class="btn btn-round btn-primary pull-right" style="margin-right:0.5rem;"><i class="fa fa-search fa-fw"></i> Lihat </button>
                </div>
                </div>
                </form>

                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Kolom RE </strong></h4>
                    <section id="unseen">
                    <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Nama Skenario</th>
                        <th>Nama Pengunggah</th>
                        <th>Nama File</th>
                        <th>Tanggal Unggah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; foreach($buat_equest1 as $db) :?>
                        <?php if($no%2!=0):?>
                            <tr>
                            <td style="background-color : #ffffff;">
                            <?php else :?>
                            <tr style="background-color : #e2e4ff;">
                            <td>
                            <?php endif?>
                                <?= ++$no?></td>
                                <td><?= $db['nama_skenario']?></td>
                                <td><?= $db['nama_user']?></td>
                                <td><a target="_blank" href="<?= base_url('upload/download/')?><?= $db['id_upload']?>"><?= $db['file_upload']?></a></td>
                                <td><?= $db['tanggal']?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                    </table>
                    
                </section>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Kolom DP </strong></h4>
                <section id="unseen">
                    <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-2">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Nama Skenario</th>
                        <th>Nama Pengunggah</th>
                        <th>Nama File</th>
                        <th>Tanggal Unggah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; foreach($buat_equest as $db) :?>
                        <?php if($no%2!=0):?>
                            <tr>
                            <td style="background-color : #ffffff;">
                            <?php else :?>
                            <tr style="background-color : #e2e4ff;">
                            <td>
                            <?php endif?>
                                <?= ++$no?></td>
                                <td><?= $db['nama_skenario']?></td>
                                <td><?= $db['nama_user']?></td>
                                <td><a target="_blank" href="<?= base_url('upload/download/')?><?= $db['id_upload']?>"><?= $db['file_upload']?></a></td>
                                <td><?= $db['tanggal']?></td>
                            </tr>
                        <?php endforeach?>
                    </tbody>
                    </table>
                    
                </section>
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