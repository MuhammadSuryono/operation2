<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> STKB</h3>
    <div class="row mt">
      <div class="col-lg-12">

      <div class="row">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Tambah Dasar TRK </strong></h4>
                <form action="<?php echo base_url('city/tambah') ?>" method="POST" class="row">
                    <div class="col-xl-5 col-md-6 mb-4">
                        <div class="form-group">
                            <label for="user">Pilih Bank</label>
                            <select class="form-control" name="bank">
                            <option value="">Pilih Bank</option>
                            <?php
                            foreach ($stkbbanktanpa as $banknya) {
                            echo "<option value='" .$banknya['kode']. "'>" .$banknya['nama']. "</option>";
                            }
                            ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a href="<?php echo base_url('stkb/dasartrk') ?>" class=" btn btn-danger"> Back</a>
                        </div>

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
