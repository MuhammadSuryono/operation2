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
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> STKB Transaksi </strong> </h4>

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

              <section id="unseen">

                <?php
                // $user = $this->session->userdata('id_divisi');
                // if ($user == 8){
                ?>
                <!-- <a href="javascript:;" data-toggle="modal" data-target="#edittrk" class="btn-success btn-sm"><i class="fa fa-book"></i> Update ALL</a>
                  <br/><br/> -->
                <?php
                // }
                ?>

                <div class="table-responsive">
                  <table class=" table table-bordered table-striped table-condensed" id="dataTables-example">
                    <thead>
                      <tr>
                        <th> No. </th>
                        <th> Nomor STKB </th>
                        <th> Project </th>
                        <th> Nama </th>
                        <th> Tanggal Mulai </th>
                        <th> Tanggal Selesai </th>
                        <th> Total </th>
                        <th bgcolor="#e3f3fc"> Term 1 </th>
                        <th bgcolor="#e3f3fc"> Tanggal Bayar </th>
                        <th bgcolor="#e3f3fc"> No Voucher </th>
                        <th bgcolor="#e3f3fc"> Aktual Bayar </th>
                        <th bgcolor="#bde4f9"> Term 2 </th>
                        <th bgcolor="#bde4f9"> Tanggal Bayar </th>
                        <th bgcolor="#bde4f9"> No Voucher </th>
                        <th bgcolor="#bde4f9"> Aktual Bayar </th>
                        <th bgcolor="#7acdf9"> Term 3 </th>
                        <th bgcolor="#7acdf9"> Tanggal </th>
                        <th bgcolor="#7acdf9"> Voucher </th>
                        <th bgcolor="#7acdf9"> Aktual Bayar </th>
                        <th>Print</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($getstkbtrk as $key) :
                      ?>
                        <tr>
                          <td> <?php echo $no; ?> </td>
                          <td> <?php echo $key['nostkb']; ?> </td>
                          <td> <?php echo $key['project']; ?> </td>
                          <?php if ($key['namanya'] != NULL) {
                            ?>
                          <td> <?php echo $key['namanya']; ?></td>
                        <?php } else { ?>
                          <td> <?php echo $key['namanya2']; ?></td>
                        <?php } ?>
                          <td> <?php echo $key['planstart']; ?> </td>
                          <td> <?php echo $key['planend']; ?> </td>
                          <td> <?php echo $key['total']; ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo 'Rp. ' . number_format($key['term1'], 0, '', ','); ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo $key['tglpembayaran1']; ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo $key['novoucher1']; ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo 'Rp. ' . number_format($key['aktualbayar1'], 0, '', ','); ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo 'Rp. ' . number_format($key['term2'], 0, '', ','); ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo $key['tglpembayaran2']; ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo $key['novoucher2']; ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo 'Rp. ' . number_format($key['aktualbayar2'], 0, '', ','); ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo 'Rp. ' . number_format($key['term3'], 0, '', ','); ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo $key['tglpembayaran3']; ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo $key['novoucher3']; ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo 'Rp. ' . number_format($key['aktualbayar3'], 0, '', ','); ?> </td>
                          <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $key['nostkb']; ?>/<?php echo $key['term1']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                        </tr>
                      <?php
                        $no++;
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

<div class="modal fade in" id="edittrk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update ALL STKB TRK</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('stkb/updateallstkbtrk') ?>">
          <p><strong>Apakah anda yakin ingin <b>Update</b> semua STKB TRK?</strong></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">UPDATE</button>
      </div>
      </form>
    </div>
  </div>
</div>