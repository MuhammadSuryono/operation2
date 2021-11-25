    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery</h3>
        <div class="row mt">
          <div class="col-lg-12">


            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Skenario </strong></h4>
                        <form class="form-horizontal style-form" method="post" action="<?= base_url('time/editstep_listtd')?>">
                            
                            <input type="hidden" class="form-control" name="project" id="project" value="<?=$project?>">
                            <input type="hidden" class="form-control" name="attribute" id="attribute" value="<?=$kode?>">
                            
                            <section id="pil">
                            <?php $num = 1;
                             foreach ($list as $row) {
                              ?>
                            <div class="form-group" >
                            <label class="col-sm-2 control-label"> Pilihan <?= $num; ?> </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pil<?= $num ?>" id="pil<?= $num ?>" value="<?= $row['pilihan_td'] ?>">
                                <!-- <?php echo $num; ?> -->
                            </div>
                            <a href='<?= base_url('time/deletestep_listtd/'.$row['id_td'])?>' class='btn btn-danger tombol-hapus' title='Delete'><i class='fas fa-trash-alt'></i></a>
                            </div>
                          <?php
                          $num++;
                           } ?>
                            </section>
                            <section id="jmlpilihan"><input type="hidden" class="form-control" name="jmlpil" id="jmlpil" value="<?= count($list) ?>"></section>
                            <a class="btn btn-round btn-primary" id="addpil2">Tambah Pilihan</a>
                            <button type="submit" class="btn btn-round btn-success pull-right" >Simpan</button>
                            <a href="<?=base_url('time')?>" class="btn btn-round btn-danger pull-right mr" >Batal</a>
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