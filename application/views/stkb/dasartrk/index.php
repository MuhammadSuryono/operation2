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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Dasar TRK </strong> </h4>
                    <a class="btn btn-round btn-primary mb" href="<?= base_url('stkb/tambah_dasartrk')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a>

                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                <section id="unseen">
                <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed" id="dataTables-example">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Edit</th>
                          <th>Bank</th>
                          <?php
                          foreach ($stkbdasartrksken as $sken) :
                          ?>
                          <th><?php echo $sken['nama']; ?></th>
                          <?php
                          endforeach;
                           ?>
                      </tr>
                  </thead>
                  <tbody id="prosesdasar">
                    <?php
                         $no = 1;
                         foreach ($stkbdasartrkbank as $data) :
                      ?>
                      <tr>
                          <td><b><?php echo $no++ ?></b></td>
                          <td><a href="<?php echo base_url(); ?>stkb/edit_dasartrk/<?php echo $data['kode']; ?> " class="btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a></td>
                          <td><?php echo $data['nama']; ?></td>
                            <?php
                            foreach ($stkbdasartrksken as $skentd){
                            ?>
                            <td>
                              <?php
                              $db2 = $this->load->database('database_kedua', TRUE);
                              $caridasarnya = "SELECT * FROM stkb_dasar_trk WHERE kodebank='$data[kode]' AND kodeskenario='$skentd[no]'";
                              $cds = $db2->query($caridasarnya)->row_array();
                              ?>
                              <?php echo 'Rp. ' . number_format( $cds['harga'], 0 , '' , ',' ); ?>
                            </td>
                          <?php } ?>
                      </tr>
                      <?php
                     endforeach;
                     ?>
                  </tbody>
                </table>
              </div>
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
