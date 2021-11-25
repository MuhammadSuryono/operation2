<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> STKB || Edit Stkb Dasar TRK</h3>
    <div class="row mt">
      <div class="col-lg-12">

      <div class="row">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Edit Stkb Dasar TRK </strong></h4>
                <form action="" method="POST">

                    <input type="hidden" name="kodebank" value="<?php echo $kode['kodebank']; ?>">

                    <div class="form-group">
                      <label for="user">Bank</label>
                        <input type="text" class="form-control" id="kodebank" placeholder="<?php echo $kode['nama']; ?>" disabled>
                    </div>

                    <?php
                    foreach ($skenario as $fl) {
                    ?>
                    <div class="form-group">
                      <label for="user"><?php echo $fl['nama'] ?></label>
                        <input type="number" name="<?php echo $fl['kodeskenario']; ?>" class="form-control" id="kodebank" value="<?php echo $fl['harga']; ?>">
                    </div>
                    <?php
                    }
                    ?>

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo base_url('stkbdasartrk') ?>" class=" btn btn-danger"> Back</a>
                    </div>

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
