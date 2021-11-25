<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Soal Equest <?=$skenario['kode_project']?> <?= $skenario['skenarioxx']?></h3>
        <div class="row mt">
            <form action="<?= base_url('equestisi/simpanisi')?>" method="post">
                <input type="hidden" name="id_pembuat_equest" id="id_pembuat_equest" value="<?=$id_pembuat_soal?>">
                
            
          <div class="col-lg-12">
            
            <?php $no=1; foreach($soal_equest as $db) :?>
                 <div class="row">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan <?= $no++?> </strong></h4>
                        <div class="form-horizontal style-form">

                        <?php if($db['jenis_soal']==1) :?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="jb" id="jb">
                                </div>
                            </div>
                        <?php endif?>

                        <?php if($db['jenis_soal']==2) :?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="message" id="contact-message" rows="1" required></textarea>
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
                                            <input type="radio" name="pg<?= $db['id_soal_equest']?>" id="pg<?= $db['id_soal_equest']?>" value="<?= $nilai['id_pg_equest']?>">
                                            (<?= $nilai['kode_pg_equest']?>) <?= $nilai['pg_equest']?>
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
                                    foreach($pilihanganda as $pg => $nilai) :?>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="pg<?= $db['id_soal_equest']?>" id="pg<?= $db['id_soal_equest']?>" value="<?= $nilai['id_pg_equest']?>">
                                            (<?= $nilai['kode_pg_equest']?>) <?= $nilai['pg_equest']?>
                                            </label>
                                        </div>
                                    <?php endforeach?>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="optionsRadios<?= $db['id_soal_equest']?>" id="optionsRadios<?= $db['id_soal_equest']?>" value="option2" disabled>
                                            <input type="text" class="form-control" name="jb" id="jb" placeholder="Lainnya">
                                            </label>
                                        </div>
                                </div>
                            </div>
                        <?php endif?>

                        <?php if($db['jenis_soal']==5) :?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                <div class="col-sm-9">
                                    <?php $pilihanganda = $this->db->get_where('data_pg_equest', ['id_soal_equest' => $db['id_soal_equest']])->result_array();
                                    foreach($pilihanganda as $pg => $nilai) :?>
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox" name="pg<?= $db['id_soal_equest']?>[]" id="pg<?= $db['id_soal_equest']?>[]" value="<?= $nilai['id_pg_equest']?>">
                                            (<?= $nilai['kode_pg_equest']?>) <?= $nilai['pg_equest']?>
                                            </label>
                                        </div>
                                    <?php endforeach?>
                                </div>
                            </div>
                        <?php endif?>


                    </div>
                </div>
            <?php endforeach?>
            <!-- AKHIR LIHAT -->
             
            <!-- CAROUSEL -->
            <!-- <div class="slideshow-container">
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
                                            <input type="text" class="form-control" name="jb<?=$no?>" id="jb<?=$no?>">
                                        </div>
                                    </div>
                                <?php endif?>

                                <?php if($db['jenis_soal']==2) :?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="jb<?=$no?>" id="jb<?=$no?>" rows="1" required> </textarea>
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
                                                    <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['id_pg_equest']?>">
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
                                            foreach($pilihanganda as $pg => $nilai) :?>
                                                <div class="radio">
                                                    <label>
                                                    <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['id_pg_equest']?>">
                                                    <?= $nilai['pg_equest']?>
                                                    </label>
                                                </div>
                                            <?php endforeach?>
                                                <div class="radio">
                                                    <label>
                                                    <input type="radio" name="optionsRadios<?= $db['id_soal_equest']?>" id="optionsRadios<?= $db['id_soal_equest']?>" value="option2" disabled>
                                                    <input type="text" class="form-control" name="lain<?=$no?>" id="lain<?=$no?>" placeholder="Lainnya">
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
            <!-- <! <a class="prev" onclick="plusSlides(-1)" style="background-color:#2f323a; margin-left : -50px;">&#10094;</a>
            <a class="next" onclick="plusSlides(1)" style="background-color:#2f323a; margin-right : -50px;">&#10095;</a> -->
            <!-- </div>
            <br>

            <div style="text-align:center">
            <a class="btn btn-round hover" onclick="plusSlides(-1)" style="background-color:#2f323a; color : white;">&#10094;</a>
            <?php $no=1; foreach($soal_equest as $db) :?>
            <span class="dot" onclick="currentSlide(<?=$no++?>)"></span>
            <?php endforeach?> 
            <a class="btn btn-round hover" onclick="plusSlides(1)" style="background-color:#2f323a; color : white;">&#10095;</a>
            </div> -->
            <!-- AKHIR CAROUSEL -->
            <!-- <br>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Simpan Isi Equest </strong></h4>
                        <div style="text-align:center;">
                                <button class="btn btn-round btn-danger">Batal</button>
                                <button type="submit" class="btn btn-round btn-info">Simpan</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div> -->
        <!-- </form> -->

        <div class="row">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <a href="<?= base_url('equestbaru/equest')?>" class="btn btn-round btn-primary btn-block"> Selesai </a>
                    </div>
                </div>
            </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->