<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Form Dialog </h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="row form-panel mt mb">
            <div class="col-md-4">
                <form action="<?=base_url('shp/tambah')?>" method="post">
                <h2 class="text-primary"><strong> Pilih Project - Skenario yang Dijalankan </strong> </h2>
                <select class="form-control" name="jenis" id="jenis">
                    <option value="0"> Pilih Project - Skenario </option>
                      <?php $id_user = $this->session->userdata('id_user'); foreach($jenis_skenario as $sk) : 
                        $kodekunjungan = $this->db->get_where('data_skenario', ['id_skenario'=>$sk['id_skenario']])->row_array();
                        
                        $kunjungantuntas = $this->db->get_where('data_aktual', ['id_project' => $sk['id_project'], 'id_kunjungan' => $sk['id_kunjungan'], 'id_status_equest' => 0, 'id_user' => $id_user])->num_rows();?>

                      <?php if(!$this->db->get_where('data_dialog', ['id_user' => $id_user, 'id_project' => $sk['id_project'], 'id_skenario' => $sk['id_skenario']])->num_rows() and $kodekunjungan['kode_skenario']!="" and $kunjungantuntas == 0) :?>
                      <option value="<?=$sk['id_project']?>-<?=$sk['id_skenario']?>-<?=$sk['kode_cabang']?>"> <?=$sk['nama_project']?> - <?=$sk['nama_skenario']?>
                      </option>
                      <?php endif?>
                      <?php endforeach?>
                  </select>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6 mt mb" >
                <textarea class="form-control" row="10" id="dialog" name="dialog" required style="min-height:290px;" placeholder="Tulis Dialog disini..."></textarea>
            </div>
             <div class="row">
                <div class="col-md-12">
                      <a href="<?= base_url('shp')?>" class="btn btn-round btn-danger"><i class="fa fa-times-circle"></i> Batal </a>
                  <button type="submit" class="btn btn-round btn-primary"><i class="fa fa-check-circle"></i> Simpan </button>
                  </form>
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