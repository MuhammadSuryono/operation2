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
                        <?php $id_user = $this->session->userdata('id_user'); foreach($project as $sk) :
                        $kodekunjungan = $this->db->get_where('data_skenario', ['id_skenario'=>$sk['id_skenario']])->row_array();
                            $kunjungantuntas = $this->db->get_where('data_aktual', ['id_project' => $sk['id_project'], 'id_kunjungan' => $sk['id_kunjungan'], 'id_status_equest' => 0, 'id_user' => $id_user])->num_rows();?>

                      <?php if(!$this->db->get_where('data_rekaman', ['id_user' => $id_user, 'id_project' => $sk['id_project'], 'id_skenario' => $sk['id_skenario']])->num_rows() and $kodekunjungan['kode_skenario']!="" and $kunjungantuntas == 0) :?>
                      <option value="<?=$sk['id_project']?>-<?=$sk['id_skenario']?>-<?=$sk['kode_cabang']?>"> <?=$sk['nama_project']?> - <?=$sk['nama_skenario']?>
                      </option>
                      <?php endif?>
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
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Rekaman Kunjungan </strong></h4>
               
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Nama Skenario</th>
                      <th>Nama Cabang</th>
                      <th>Nama File Rekaman</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($rekaman as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['nama_skenario']?></td>
                            <td><?= $db['nama_cabang']?></td>
                            <td><?= $db['file_rekaman']?></td>
                            
                            <td>
                                <a href="" class="btn btn-primary btn-round btn-xs"  style="margin-right : 0.5rem;" data-toggle="modal" data-target="#dengar<?= $db['id_rekaman']; ?>"><span class="fa fa-headphones fa-fw"></span> Dengar </a>

                                <a href="" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#edit<?= $db['id_rekaman']; ?>"><span class="fa fa-edit fa-fw"></span> Edit </a>

                                <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['id_rekaman']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td>
                        </tr>

                        <!-- MODAL DENGAR -->
                        <div class="modal fade" id="dengar<?= $db['id_rekaman']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Dengarkan Rekaman</h4>
                                </div>
                                <div class="modal-body">
                                <audio controls id="rekaman" src="<?=base_url('assets/')?>file/rekaman/<?= $db['file_rekaman']?>"></audio>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-round" data-dismiss="modal"> OK </button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL DENGAR -->

                        <!-- MODAL EDIT -->
                        <div class="modal fade" id="edit<?= $db['id_rekaman']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Rekaman</h4>
                                </div>
                                <div class="modal-body">
                                  <form action="<?= base_url('rekaman/edit')?>" method="post" enctype='multipart/form-data'>
                                  <input type="hidden" name="id" id="id" value="<?= $db['id_rekaman']?>">
                                  <select class="form-control mb" name="project" id="project">
                                      <option value=""> Pilih Project Yang Dijalankan </option>
                                      <?php foreach($project as $sk) :?>
                                      <?php if ($db['id_project'] == $sk['id_project']) :?>
                                      <option value="<?=$sk['id_project']?>" selected> <?=$sk['nama_project']?> </option>
                                      <?php else :?>
                                      <option value="<?=$sk['id_project']?>"> <?=$sk['nama_project']?> </option>
                                      <?php endif?>
                                      <?php endforeach?>
                                  </select>

                                  <div class="form-group">
                                      <input type="text" class="form-control" name="kode" id="kode" value="<?= $db['file_rekaman']?>" readonly>
                                  </div>

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
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success btn-round"> Ubah </button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL EDIT -->

                         <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['id_rekaman']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Rekaman</h4>
                                </div>
                                <div class="modal-body">
                                Yakin ingin menghapus Rekaman <strong><?= $db['file_rekaman']?></strong> ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('rekaman/hapus/')?><?= $db['id_rekaman']?>" type="button" class="btn btn-primary btn-round"> Hapus </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->


                      <?php endforeach?>
                  </tbody>
                </table>
              </section>

            </div>
           </div>
           </div>

          </div> 
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
