<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Ubah Jawaban Equest </h3>
        <div class="row mt">
          <div class="col-lg-12">

        <!-- <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Ubah Jawaban Equest </strong></h4>
           </div>
           </div>
           </div> -->
           
            <form action="<?= base_url('equestisi/updateisi')?>" method="post">
                <input type="hidden" name="id_jawaban" id="id_jawaban" value="<?=$id_jawaban?>">
            <!-- CAROUSEL -->
            <div class="slideshow-container">
                <?php $no=1; foreach($soal_equest as $db) :?>
                <div class="mySlides">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-panel">
                                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan <?= $no?> </strong></h4>
                                <div class="form-horizontal style-form">
                                 <?php if($db['jenis_soal']==1) :?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $jawaban_equest[$no-1]?>">
                                        </div>
                                    </div>
                                <?php endif?>

                                <?php if($db['jenis_soal']==2) :?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="jb<?=$no?>" id="jb<?=$no?>" rows="1" required><?= $jawaban_equest[$no-1]?></textarea>
                                        </div>
                                    </div>
                                <?php endif?>
                                
                                <?php if($db['jenis_soal']==3) :?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                        <div class="col-sm-9">
                                            <?php $pilihanganda = $this->db->get_where('data_pg_equest', ['id_soal_equest' => $db['id_soal_equest']])->result_array();
                                            foreach($pilihanganda as $pg => $nilai) :?>
                                                <div class="radio">
                                                    <label>
                                                    <?php if ($nilai['id_pg_equest'] == $jawaban_equest[$no-1]) :?>
                                                    <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['id_pg_equest']?>" checked>
                                                    <?php else :?>
                                                    <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['id_pg_equest']?>">
                                                    <?php endif?>
                                                    <?= $nilai['pg_equest']?>
                                                    </label>
                                                </div>
                                            <?php endforeach?>
                                        </div>
                                    </div> 
                                <?php endif?>

                                <?php if($db['jenis_soal']==4) :?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                        <div class="col-sm-9">
                                            <?php $pilihanganda = $this->db->get_where('data_pg_equest', ['id_soal_equest' => $db['id_soal_equest']])->result_array(); 
                                            $cek = 0; $cek1 =1;
                                            foreach($pilihanganda as $pg => $nilai) :?>
                                                <div class="radio">
                                                    <label>
                                                    <?php if ($nilai['id_pg_equest'] == $jawaban_equest[$no-1]) :
                                                        $cek1 = 1; 
                                                       ?>
                                                    <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['id_pg_equest']?>" checked>
                                                    <?php else :
                                                        $cek = 0;?>
                                                    <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['id_pg_equest']?>">
                                                    <?php endif?>
                                                    <?= $nilai['pg_equest']?>
                                                    </label>
                                                </div>
                                            <?php $cek0 = $cek + $cek1; endforeach?>
                                                <div class="radio">
                                                    <label>
                                                    <input type="radio" name="optionsRadios<?= $db['id_soal_equest']?>" id="optionsRadios<?= $db['id_soal_equest']?>" value="option2" disabled>
                                                    <?php if($this->db->get_where('data_pg_equest', ['id_pg_equest' => $jawaban_equest[$no-1], 'id_soal_equest' => $db['id_soal_equest']])->row_array()) :?>
                                                    <input type="text" class="form-control" name="lain<?=$no?>" id="lain<?=$no?>" placeholder="Lainnya">
                                                    <?php else : ?>
                                                    <input type="text" class="form-control" name="lain<?=$no?>" id="lain<?=$no?>" placeholder="Lainnya" value="<?= str_replace("#@!", "", $jawaban_equest[$no-1])?>">
                                                    <?php endif?>
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
                                <?php endif?>

                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $no++; endforeach;?>
            </div>
            <br>

            <div style="text-align:center">
            <a class="btn btn-round hover" onclick="plusSlides(-1)" style="background-color:#2f323a; color : white;">&#10094;</a>
            <?php $no=1; foreach($soal_equest as $db) :?>
            <span class="dot" onclick="currentSlide(<?=$no++?>)"></span>
            <?php endforeach?> 
            <a class="btn btn-round hover" onclick="plusSlides(1)" style="background-color:#2f323a; color : white;">&#10095;</a>
            </div>
            <!-- AKHIR CAROUSEL -->

            <br>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Simpan Isi Equest </strong></h4>
                        <div style="text-align:center;">
                                <a href="<?= base_url('equestisi/cek')?>" class="btn btn-round btn-danger">Batal</a>
                                <button type="submit" class="btn btn-round btn-info">Ubah</button>
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
    <!-- /MAIN CONTENT -->
    <!--main content end-->