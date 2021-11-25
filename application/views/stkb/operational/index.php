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
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> STKB Operational </strong> </h4>
              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

              <section id="unseen">

                <?php
                // if ($this->session->userdata('id_user') == '973'){
                ?>
                <!-- <a href="javascript:;" data-toggle="modal" data-target="#editops" class="btn-success btn-sm"><i class="fa fa-book"></i> Update ALL</a>
                  <br/><br/> -->
                <?php
                // }else{
                // echo "";
                // }
                ?>

                <div class="table-responsive">
                  <table class=" table table-bordered table-striped table-condensed" id="dataTables-example">
                    <thead>
                      <tr bgcolor="#F0FFF0">
                        <th>No.</th>
                        <th>Nomor Stkb</th>
                        <th>Project</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Urutan Project</th>
                        <th>Daerah Asal</th>
                        <th>Kota Dinas</th>
                        <th>Penugasan</th>
                        <th>Tgl Mulai</th>
                        <th>Tgl Selesai</th>
                        <th>HK</th>
                        <th>HL</th>
                        <th>Jumlah Hari</th>
                        <th>Quota</th>
                        <th>Q1</th>
                        <th>Q2</th>
                        <th>Q3</th>
                        <th>ATM C</th>
                        <th>ATM M</th>
                        <th>Teller Terpisah</th>
                        <th>Telp Cabang</th>
                        <th>Sapu Bersih</th>
                        <th>BPJS</th>
                        <th>Lumpsum Harian</th>
                        <th>Akomodasi</th>
                        <th>Lumpsum OPS</th>
                        <th>Total</th>
                        <th bgcolor="#e3f3fc"> Term 1 </th>
                        <th bgcolor="#e3f3fc"> Tanggal Bayar </th>
                        <th bgcolor="#e3f3fc"> No Voucher </th>
                        <th bgcolor="#e3f3fc"> Aktual Bayar </th>
                        <th bgcolor="#bde4f9"> Term 2 </th>
                        <th bgcolor="#bde4f9"> Tanggal </th>
                        <th bgcolor="#bde4f9"> No Voucher </th>
                        <th bgcolor="#bde4f9"> Aktual Bayar </th>
                        <th bgcolor="#7acdf9"> Term 3 </th>
                        <th bgcolor="#7acdf9"> Tanggal </th>
                        <th bgcolor="#7acdf9"> Voucher </th>
                        <th bgcolor="#7acdf9"> Aktual Bayar </th>
                        <th> Perdin </th>
                        <th> Surat Pernyatan </th>

                        <th> Print</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      foreach ($stkbops as $key) :
                        $totalnya = $key['bpjs'] + $key['lumpsumharian'] + $key['lumpsumops'] + $key['akomodasi'] + $key['perdin'];
                        $totterm1 = $key['term1'] + $key['bpjs'] + $key['akomodasi'] + $key['perdin'];
                      ?>
                        <tr>
                          <td> <?php echo $no; ?> </td>
                          <td> <?php echo $key['nomorstkb']; ?> </td>
                          <td> <?php echo $key['project']; ?> </td>
                          <?php if ($key['namanya'] != NULL) {
                           ?>
                          <td> <?php echo $key['namanya']; ?></td>
                          <td> <?php echo $key['levelnya']; ?> </td>
                        <?php } else { ?>
                          <td> <?php echo $key['nama_fo']; ?></td>
                          <td> <?php echo $key['posisi_fo']; ?> </td>
                        <?php } ?>
                          <td> <?php echo $key['urutproject']; ?> </td>
                          <td> <?php echo $key['daerahasal']; ?> </td>
                          <td> <?php echo $key['kotadinas']; ?> </td>
                          <td> <?php echo $key['penugasan']; ?> </td>
                          <td> <?php echo $key['tglmulai']; ?> </td>
                          <td> <?php echo $key['tglselesai']; ?> </td>
                          <td> <?php echo $key['hk']; ?> </td>
                          <td> <?php echo $key['hl']; ?> </td>
                          <td> <?php echo $key['jml_hari']; ?> </td>
                          <td> <?php echo $key['quota']; ?> </td>
                          <td> <?php echo $key['q1']; ?> </td>
                          <td> <?php echo $key['q2']; ?> </td>
                          <td> <?php echo $key['q3']; ?> </td>
                          <td> <?php echo $key['atmc']; ?> </td>
                          <td> <?php echo $key['atmm']; ?> </td>
                          <td> <?php echo $key['tlr_psh']; ?> </td>
                          <td> <?php echo $key['telp_cbg']; ?> </td>
                          <td> <?php echo $key['sapubersih']; ?> </td>
                          <td> <?php echo 'Rp. ' . number_format($key['bpjs'], 0, '', ','); ?> </td>
                          <td> <?php echo 'Rp. ' . number_format($key['lumpsumharian'], 0, '', ','); ?> </td>
                          <td> <?php echo 'Rp. ' . number_format($key['akomodasi'], 0, '', ','); ?> </td>
                          <td> <?php echo 'Rp. ' . number_format($key['lumpsumops'], 0, '', ','); ?> </td>
                          <td> <?php echo 'Rp. ' . number_format($totalnya, 0, '', ','); ?> </td>
                          <td bgcolor="#e3f3fc"> <?php echo 'Rp. ' . number_format($totterm1, 0, '', ','); ?></td>
                          <td bgcolor="#e3f3fc"> <?php echo $key['tglbayar1']; ?> </td>
                          <td bgcolor="#e3f3fc">
                            <?php
                            // date_default_timezone_get('asia/bangkok');
                            // $tahun = date('Y');
                            // $bulan = date('m');
                            // $novoucher = $key['novoucher1'];
                            // $numvoucher = str_pad($novoucher, 4, '0', STR_PAD_LEFT);
                            // $voucherfix = "KKP".$tahun.$bulan.$numvoucher;
                            // if ($key['novoucher1'] == '' || $key['novoucher1'] = NULL){
                            // echo "";
                            // }
                            // else{
                            // echo $voucherfix;
                            // }
                            echo $key['novoucher1'];
                            ?>
                          </td>
                          <td bgcolor="#e3f3fc"> <?php echo 'Rp. ' . number_format($key['aktualbayar1'], 0, '', ','); ?> </td>
                          <td bgcolor="#bde4f9"> <?php echo 'Rp. ' . number_format($key['term2'], 0, '', ','); ?> </td>
                          <td bgcolor="#bde4f9"> <?php echo $key['tglbayar2']; ?> </td>
                          <td bgcolor="#bde4f9">
                            <?php
                            // date_default_timezone_get('asia/bangkok');
                            // $tahun = date('Y');
                            // $bulan = date('m');
                            // $novoucher2 = $key['novoucher2'];
                            // $numvoucher2 = str_pad($novoucher2, 4, '0', STR_PAD_LEFT);
                            // $voucherfix2 = "KKP".$tahun.$bulan.$numvoucher2;
                            // if ($key['novoucher2'] == '' || $key['novoucher2'] = NULL){
                            // echo "";
                            // }
                            // else{
                            // echo $voucherfix2;
                            // }
                            echo $key['novoucher2'];
                            ?>
                          </td>
                          <td bgcolor="#bde4f9"> <?php echo 'Rp. ' . number_format($key['aktualbayar2'], 0, '', ','); ?>
                          <td bgcolor="#7acdf9"> <?php echo 'Rp. ' . number_format($key['term3'], 0, '', ','); ?> </td>
                          <td bgcolor="#7acdf9"> <?php echo $key['tglbayar3']; ?> </td>
                          <td bgcolor="#7acdf9">
                            <?php
                            // date_default_timezone_get('asia/bangkok');
                            // $tahun = date('Y');
                            // $bulan = date('m');
                            // $novoucher3 = $key['novoucher3'];
                            // $numvoucher3 = str_pad($novoucher3, 4, '0', STR_PAD_LEFT);
                            // $voucherfix3 = "KKP".$tahun.$bulan.$numvoucher3;
                            // if ($key['novoucher3'] == '' || $key['novoucher3'] = NULL){
                            // echo "";
                            // }
                            // else{
                            // echo $voucherfix3;
                            // }
                            echo $key['novoucher3'];
                            ?> </td>
                          <td bgcolor="#7acdf9"> <?php echo 'Rp. ' . number_format($key['aktualbayar3'], 0, '', ','); ?> </td>
                          <td><?php echo 'Rp. ' . number_format($key['perdin'], 0, '', ','); ?></td>
                          <td>
                            <center><?php if ($key['suratpernyataan'] != NULL) {
                                      // echo "<span><button type='button' class='btn btn-sm btn-info waves-effect' onclick='window.open(\"" . base_url() . "assets/file/pernyataan/" . $key['suratpernyataan'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'>Lihat File</button></span>";
                                      echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/pernyataan/" . $key['suratpernyataan'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i> <br>View</a>";
                                    } else {
                                      echo "";
                                    } ?>
                            </center>
                          </td>

                          <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $key['nomorstkb']; ?>/<?php echo $key['term1']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
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

<div class="modal fade in" id="editops" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Update ALL STKB OPS</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php echo base_url('stkb/updateallstkbops') ?>">
          <p><strong>Apakah anda yakin ingin <b>Update</b> semua STKB OPS?</strong></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">UPDATE</button>
      </div>
      </form>
    </div>
  </div>
</div>