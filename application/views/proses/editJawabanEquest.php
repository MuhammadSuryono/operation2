    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Edit Jawaban Equest </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
          <div class="col-lg-6">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Jawaban Equest </strong></h4>
                <form class="form-horizontal style-form" method="post">
                <?php $index=0; foreach($soal as $sl):?>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><?=$sl['kode_soal']?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="<?=$index?>" id="<?=$index?>" value="<?= $jawaban[$index];?>">
                    <?= form_error("$index", '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
                <?php $index++; endforeach?>
                <button class="btn btn-round btn-danger"><span class="fa fa-times-circle fa-fw"></span>Batal</button>
                <button class="btn btn-round btn-success" type="submit"><span class="fa fa-check-circle fa-fw"></span>Simpan</button>
                </form>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Keterangan Validasi </strong></h4>
                <?php $ket_jawab = "|";
                      $ket_jawab1 = explode("|", $validasi);
                        for($r=0;$r<count($ket_jawab1)-1;$r++){
                            $id = substr("$ket_jawab1[$r]",0,stripos("$ket_jawab1[$r]", "-"));
                            $kodesoal = $this->db->get_where('data_cek', ['id_cek' => $id])->row_array();
                            $kode = $kodesoal['kode_cek_1'];
                            $ket_jawab .= str_replace("$id", "$kode", $ket_jawab1[$r]);
                            if($r!=count($ket_jawab1)-2){
                                $ket_jawab .= "|";
                            }
                        } $ganti = `<br><br><span class="fa fa-asterisk fa-fw"></span>`;?>
                <h5><?= str_replace("|", "<br><br><span class='fa fa-asterisk fa-fw'></span>", $ket_jawab)?></h5>
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