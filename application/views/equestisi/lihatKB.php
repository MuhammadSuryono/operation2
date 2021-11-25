    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Soal Equest <?=$skenario['nama_project']?> - <?=$skenario['skenarioxx']?></h3>
        <div class="row mt">
            <form action="<?= base_url('equestisi/simpanisi')?>" method="post">
                <input type="hidden" name="id_pembuat_equest" id="id_pembuat_equest" value="<?=$id_pembuat_soal?>">
                <input type="hidden" name="id_project" id="id_project" value="<?=$id_project?>">
                <input type="hidden" name="kode_cabang" id="kode_cabang" value="<?=$kode_cabang?>">
                <input type="hidden" name="id_kunjungan" id="id_kunjungan" value="<?=$id_kunjungan?>">
                
            
          <div class="col-lg-12">
             
            <!-- CAROUSEL -->
            <div class="slideshow-container">
                <?php $no=1; foreach($soal_equest as $db) :?>
                <div class="mySlides" id="<?=$db['kode_soal']?>">
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
                                            <textarea class="form-control" name="jb<?=$no?>" id="jb<?=$no?>" rows="1" ></textarea>
                                        </div>
                                    </div>
                                <?php endif?>
                                
                                <?php if($db['jenis_soal']==3) :?>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                        <div class="col-sm-9">
                                            <?php $array = []; $pilihanganda = $this->db->get_where('data_pg_equest', ['id_soal_equest' => $db['id_soal_equest']])->result_array();
                                            foreach($pilihanganda as $pg => $nilai) : ?>

                                            <!-- LOMPAT LOMPAT -->
                                            <?php $id_pembuat = $this->db->get_where('data_soal_equest', ['id_soal_equest' => $db['id_soal_equest']])->row_array();
                                            $idp = $id_pembuat['id_pembuat_equest'];
                                            $jmlsoal = $this->db->query("SELECT kode_soal from data_soal_equest where id_pembuat_equest = $idp order by kode_soal ASC")->result_array();
                                                foreach($jmlsoal as $jb => $dr){
                                                    Array_push($array, $dr['kode_soal']);
                                                }
                                                $cr = $nilai['ket_soal'];
                                                $r = array_search($cr, $array);
                                                $d = $r-2;
                                            ?>
                                            <!-- LOMPAT LOMPAT -->

                                                <div class="radio">
                                                    <label>
                                                    <?php $p = $nilai['id_pg_equest'];?>
                                                    <input type="hidden" name="trigger<?=$p?>" id="trigger<?=$p?>" value="<?=$nilai['ket_soal'];//=$db['id_soal_equest']?>">
                                                    <!-- <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['id_pg_equest']?>"  onclick="plusSlides(<?=$d?>)"> -->
                                                    <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['kode_pg_equest']?>"  onclick="plusSlides1(<?=$db['id_soal_equest']?>, '<?=$nilai['ket_soal']?>', <?=$db['id_pembuat_equest']?>)">
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
                                                    <input type="radio" name="jb<?=$no?>" id="jb<?=$no?>" value="<?= $nilai['kode_pg_equest']?>">
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

                                <?php if($db['jenis_soal']==5) :?>
                                   <div class="form-group">
                                        <label class="col-sm-3 control-label"><?= $db['soal_equest']?></label>
                                        <div class="col-sm-9">
                                            <?php $pilihanganda = $this->db->get_where('data_pg_equest', ['id_soal_equest' => $db['id_soal_equest']])->result_array();
                                            foreach($pilihanganda as $pg => $nilai) :?>
                                                <div class="checkbox">
                                                    <label>
                                                    <input type="checkbox" name="jb<?=$no?>[]" id="jb<?=$no?>[]" value="<?= $nilai['kode_pg_equest']?>">
                                                    <?= $nilai['pg_equest']?>
                                                    </label>
                                                </div>
                                            <?php endforeach?>
                                        </div>
                                    </div> 
                                <?php endif?>

                            </div>
                                <?php if($db['jenis_soal']==3) : ?>
                                 <div style="text-align:center;"><a class="btn btn-round hover" style="background-color:#2f323a; color : white;" disabled>&#10095;</a></div>
                                <?php else : ?>
                                 <div style="text-align:center;"><a class="btn btn-round hover" onclick="plusSlides(1)" style="background-color:#2f323a; color : white;">&#10095;</a></div>
                                <?php endif?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $no++; endforeach;?>
            <div class="mySlides">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h2 style="text-align: center;" class="text-primary"><strong> Terima Kasih </strong></h2>
                            <h2 style="text-align: center;" class="text-primary"><strong> Anda Sudah Selesai Mengisi E-quest </strong></h2>
                            <h4 style="text-align: center;" class="text-primary"><strong> Silahkan Klik Tombol Simpan Yang Berada Dibawah Panel Ini</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
             <!-- <a class="prev" onclick="plusSlides(-1)" style="background-color:#2f323a; margin-left : -50px;">&#10094;</a> -->
            <!-- <a class="next" onclick="plusSlides(1)" style="background-color:#2f323a; margin-right : -50px;">&#10095;</a> -->
            </div>
            <br>

            <div style="text-align:center">
            <!-- <a class="btn btn-round hover" onclick="plusSlides(-1)" style="background-color:#2f323a; color : white; margin-right : 5rem;">&#10094;</a> -->
            <!-- <?php $no=1; foreach($soal_equest as $db) :?>
            <span class="dot" onclick="currentSlide(<?=$no++?>)"></span>
            <?php endforeach?>  -->
            <!-- <a class="btn btn-round hover" onclick="plusSlides(1)" style="background-color:#2f323a; color : white;">&#10095;</a> -->
            </div>
            <!-- AKHIR CAROUSEL -->
            <br>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Simpan Isi Equest </strong></h4>
                        <div style="text-align:center;">
                                <a href="<?= base_url('aktual')?>" class="btn btn-round btn-danger">Batal</a>
                                <button type="submit" class="btn btn-round btn-info">Simpan</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->