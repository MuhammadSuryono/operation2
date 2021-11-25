<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> STKB</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Skenario </strong> </h4>
                    <a href="" class="btn btn-round btn-primary mb" data-target="#exampleModal" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>

                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>


                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Keterangan</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                         $no = 1;
                         foreach ($stkbskenario as $data) :
                             ?>
                      <tr>
                          <td><b><?php echo $no++ ?></b></td>
                          <td><?php echo $data['nama'] ?></td>
                          <td><?php echo $data['keterangan'] ?></td>
                          <td>
                              <center>
                                  <a href="javascript:;" data-toggle="modal" data-target="#edit-stkbskenario" data-id="<?php echo $data['no']; ?>"
                                    data-nm="<?php echo $data['nama'] ?>" data-kt2="<?php echo $data['keterangan'] ?>" class="btn-success btn-sm">
                                    <i class="fa fa-edit"></i> Edit</a>
                                  <a href="<?php echo base_url(); ?>stkb/hapus_skenario/<?php echo $data['no']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                              </center>
                          </td>
                      </tr>
                      <?php
                     endforeach;
                     ?>
                  </tbody>
                </table>
              </section>



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
                    <h5 class="modal-title" id="exampleModalLabel">Form Input Skenario STKB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="<?php echo base_url('stkb/tambah_skenario') ?>">

                      <div class="form-group">
                        <label>Nama :</label>
                          <input type="text" id="ka" name="nama" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>Keterangan</label>
                          <input type="text" id="kt" name="keterangan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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

    <div class="modal fade" id="edit-stkbskenario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Skenario STKB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url('stkb/edit_skenario') ?>">
                        <input type="hidden" name="no" id="no">

                        <div class="form-group">
                          <label>Nama</label>
                            <input type="text" id="nm" name="nama" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                        </div>

                        <div class="form-group">
                          <label>Keterangan</label>
                            <input type="text" id="kt" name="keterangan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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
