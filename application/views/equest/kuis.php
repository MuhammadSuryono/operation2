<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Equest</h3>
        <div class="row mt">
          <div class="col-lg-12">

        <form action="<?=base_url('equest/kuis1')?>" method="post">
        
          <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Kuis Skenario <?= $this->session->flashdata('skenario');?></strong> </h4>
              <span class="label label-info">NOTE!</span>
                    <span>
                      Harap isi semua soal kuis yang ada dibawah ini.
                      </span>
                      <strong ><p class="mt">Jumlah Soal : <?=$jumlah?></p></strong>
            </div>

        <section id="soalsoal">
        <?php $no=1;?>
        <?php foreach($data_kuis as $db) :?>
        <input type="hidden" name="id" id="id" value="<?= $db['kunjungan']?>">
        <input type="hidden" name="kode" id="kode" value="<?= $db['kode_project']?>">
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Soal <?= $no?> </strong></h4>
                <div class="form-horizontal style-form">
                    <div class="form-group">
                        <label class="col-sm-12 control-label"><?= $db['soal_kuis']?></label>
                    </div>
                    <?php $soal=rand(1,4);
                    switch($soal){
                        case 1 :
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['benar_kuis'].'">A. '.$db['benar_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah1_kuis'].'">B. '.$db['salah1_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah2_kuis'].'">C. '.$db['salah2_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah3_kuis'].'">D. '.$db['salah3_kuis'].'</label></div>';
                            break;

                            case 2 :
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah1_kuis'].'">A. '.$db['salah1_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['benar_kuis'].'">B. '.$db['benar_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah2_kuis'].'">C. '.$db['salah2_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah3_kuis'].'">D. '.$db['salah3_kuis'].'</label></div>';
                            break;

                            case 3 :
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah1_kuis'].'">A. '.$db['salah1_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah2_kuis'].'">B. '.$db['salah2_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['benar_kuis'].'">C. '.$db['benar_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah3_kuis'].'">D. '.$db['salah3_kuis'].'</label></div>';
                            break;

                            case 4 :
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah1_kuis'].'">A. '.$db['salah1_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah2_kuis'].'">B. '.$db['salah2_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['salah3_kuis'].'">C. '.$db['salah3_kuis'].'</label></div>';
                            echo '<div class="radio"><label><input type="radio" name="id'.$db['id_kuis'].'" id="id'.$db['id_kuis'].'" value="'.$db['benar_kuis'].'">D. '.$db['benar_kuis'].'</label></div>';
                            break;
                    }
                    ?>
                    
                </div>
            </div>
           </div>
           </div>
        <?php $no++ ?>
        <?php endforeach?>
        </section>

        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Test Kuis</strong> </h4>
              <button type="submit" id="" name="" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Jawab</button>
              <br>
              <br>
            </div>


            </form>
          </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->