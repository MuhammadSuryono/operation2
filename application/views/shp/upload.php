<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Bukti Kunjungan</h3>
        <div class="row mt">
          <div class="col-lg-12">
            
             <!--ADVANCED FILE INPUT-->
        <div class="row mt">
          <div class="col-lg-8">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Upload Kelengkapan Kunjungan </strong></h4>
              <form action="<?= base_url('shp/upload')?>" class="form-horizontal style-form" method="post" enctype='multipart/form-data'>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Pilih Skenario</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="jenis" id="jenis">
                    <option value="0"> Skenario Yang Dijalankan </option>
                      <?php $id_user = $this->session->userdata('id_user'); foreach($jenis_skenario as $sk) :
                        $kodekunjungan = $this->db->get_where('data_skenario', ['id_skenario'=>$sk['id_skenario']])->row_array();
                        
                        $kunjungantuntas = $this->db->get_where('data_aktual', ['id_project' => $sk['id_project'], 'id_kunjungan' => $sk['id_kunjungan'], 'id_status_equest' => 0, 'id_user' => $id_user])->num_rows();?>
                      <!-- <option value="<?=$sk['id_skenario']?>"> <?=$sk['nama_skenario']?> </option> -->

                      <?php if(!$this->db->get_where('data_kunjungan', ['id_user' => $id_user, 'id_project' => $sk['id_project'], 'id_skenario' => $sk['id_skenario']])->num_rows() and $kodekunjungan['kode_skenario']!="" and $kunjungantuntas == 0) :?>
                      <option value="<?=$sk['id_project']?>-<?=$sk['id_skenario']?>-<?=$sk['kode_cabang']?>"> <?=$sk['nama_project']?> - <?=$sk['nama_skenario']?>
                      </option>
                      <?php endif?>

                      <?php endforeach?>
                  </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3"> Slip Transaksi </label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="transaksi" id="transaksi" required/>
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Gambar ( .jpg, .gif, .png )
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3"> Screenshot Equest </label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="equest" id="equest" required/>
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Gambar ( .jpg, .gif, .png )
                      </span>
                  </div>
                </div>

                 <div class="form-group">
                  <label class="control-label col-md-3"> Layout Cabang </label>
                  <div class="controls col-md-9">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Gambar</span>
                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                      <input type="file" class="default" name="layout" id="layout" required/>
                      </span>
                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                    </div>
                    <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                    <span>Format Gambar ( .jpg, .gif, .png )
                      </span>
                  </div>
                </div>

                <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('shp/daftarkunjungan')?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
                <br>
                <br>
                </div>
              </form>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>






          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->