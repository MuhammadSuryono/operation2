<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> STKB || Tambah dasar TRK</h3>
    <div class="row mt">
      <div class="col-lg-12">

      <div class="row">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Form Tambah Dasar TRK </strong></h4>
                <form action="<?php echo base_url('stkb/prosestambahdasartrk') ?>" method="POST" class="row">
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
                            <a href="<?php echo base_url('stkb/stkb_dasartrk') ?>" class=" btn btn-danger"> Back</a>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Kota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('perusahaan/tambahBidang') ?>">
           <div class="form-group">
            <label>Bidang Usaha Customer</label>
                        <input type="text" name="bidang" class="form-control form-control-user" aria-describedby="emailHelp"  required>
                    </div>
          <div class="form-group">
            <label>Keterangan</label>
                        <input type="text" name="ket" class="form-control form-control-user" aria-describedby="emailHelp" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
