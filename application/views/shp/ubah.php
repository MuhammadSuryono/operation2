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
                <form method="post">
                <h2 class="text-primary"><strong> Pilih Skenario yang Dijalankan </strong> </h2>
                <select class="form-control" name="jenis" id="jenis">
                    <option value="0"> Pilih Skenario </option>
                      <?php foreach($jenis_skenario as $sk) :?>
                      <?php if ($sk['id_skenario'] == $data_dialog['id_skenario']) :?>
                      <option value="<?=$sk['id_skenario']?>" selected> <?=$sk['nama_skenario']?> </option>
                      <?php else :?>
                      <option value="<?=$sk['id_skenario']?>"> <?=$sk['nama_skenario']?> </option>
                      <?php endif?>
                      <?php endforeach?>
                  </select>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6 mt mb" >
                <textarea class="form-control" row="10" id="dialog" name="dialog" required style="min-height:290px;" placeholder="Tulis Dialog disini..."><?= str_replace('<br />',' ',$data_dialog['teks_dialog'])?></textarea>
            </div>
             <div class="row">
                <div class="col-md-12">
                      <a href="<?= base_url('shp')?>" type="button" class="btn btn-round btn-danger"><i class="fa fa-times-circle"></i> Batal </a>
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