    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pilih Skenario </strong></h4>
                        <div class="row">
                        <form action="<?= base_url('time/buat')?>" method="post">
                        <div class="col-md-3 mb">
                            <select class="form-control" name="project" id="project">
                                <option value=""> Pilih Skenario </option>
                                <?php foreach($skenario as $sk) :?>
                                <option value="<?=$sk['id_skenario']?>"> <?=$sk['nama_skenario']?> </option>
                                <?php endforeach?>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-round btn-primary pull-right" ><i class="fa fa-check-circle fa-fw"></i> Buat </button>
                        </div>
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