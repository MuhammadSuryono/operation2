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
                <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> STKB Pengajuan </strong> </h4>
                <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

        <section id="unseen">

<style>
.invoice-title h2, .invoice-title h3 {
display: inline-block;
}

.table > tbody > tr > .no-line {
border-top: none;
}

.table > thead > tr > .no-line {
border-bottom: none;
}

.table > tbody > tr > .thick-line {
border-top: 2px solid;
}
</style>
<div id="printableArea">

          <!-- <div class="container"> -->
              <div class="row">
                  <div class="col-xs-12">
              		<div class="invoice-title">
              			<h2>STKB Operational & Transaksi</h2><h3 class="pull-right"># <?php echo $allprint['nomorstkb'] ?></h3>
              		</div>
              		<hr>

              		<div class="row">
                    <div class="col-xs-2 text-left">
                      <strong>Keterangan</strong><br>
                      Nama<br>
                      Kota Asal<br>
                      Kota Tujuan<br>
                      Status<br>
                      Periode
                    </div>
              			<div class="col-xs-4 text-left">
              				<strong>: <?php echo $allprint['namanya'] ?>/<?php echo  $allprint['jeniskota1'] ?></strong>/<?php echo $allprint['penugasan']?><br>
              					: <?php echo $allprint['namanya'] ?> - <?php echo $allprint['kode_iddata']?><br>
              				  : <?php echo $allprint['daerahasal'] ?><br>
              					: <?php echo $allprint['kotadinas'] ?><br>
                        : <?php echo $allprint['jabatannya']?><br>
                        : <b><?php echo $allprint['tglmulai'] ?></b> s/d <b><?php echo $allprint['tglselesai'] ?></b>
              			</div>

                    <div class="col-xs-4">
                    </div>

              			<div class="col-xs-2 text-left">
                  			<strong>PIC Prayed</strong><br>
              					HK &nbsp; &nbsp; &nbsp;: <b><?php echo $allprint['hk'] ?></b><br>
              					HL &nbsp; &nbsp; &nbsp;: <b><?php echo $allprint['hl'] ?></b><br>
              				  Total : <b><?php echo $allprint['jml_hari'] ?>
              			</div>
              		</div>

                  <br/><br/>


              <center><h4><strong><?php echo  $allprint['namaproject']?>-<?php echo  $allprint['project']?></strong></h4></center>

              <div class="row">
              	<div class="col-md-12">
              		<div class="panel panel-default">
              			<div class="panel-heading">
              				<h3 class="panel-title">OPS</h3>
              			</div>
              			<div class="panel-body">
              				<div class="table-responsive">
              					<table class="table table-condensed">
              						<thead>
                            <tr>
                							<td><strong>Quota</strong></td>
                							<td class="text-right"><strong>Q1</strong></td>
                							<td class="text-right"><strong>Q2</strong></td>
                							<td class="text-right"><strong>Q3</strong></td>
                              <td class="text-right"><strong>ATM C</strong></td>
                              <td class="text-right"><strong>ATM M</strong></td>
                              <td class="text-right"><strong>Teller Terpisah</strong></td>
                              <td class="text-right"><strong>Telp Cbg</strong></td>
                            </tr>
              						</thead>
              						<tbody>
              							<tr>
                              <td><?php echo $allprint['quota'] ?></td>
                              <td class="text-right"><strong><?php echo $allprint['q1'] ?></strong></td>
                							<td class="text-right"><strong><?php echo $allprint['q2'] ?></strong></td>
                							<td class="text-right"><strong><?php echo $allprint['q3'] ?></strong></td>
                              <td class="text-right"><strong><?php echo $allprint['atmc'] ?></strong></td>
                              <td class="text-right"><strong><?php echo $allprint['atmm'] ?></strong></td>
                              <td class="text-right"><strong><?php echo $allprint['tlr_psh'] ?></strong></td>
                              <td class="text-right"><strong><?php echo $allprint['telp_cbg'] ?></strong></td>
                            </tr>
                            <tr>
              								<td class="thick-line text-left"><strong>Uang Saku</strong></td>
              								<td class="thick-line text-left"><?php echo 'Rp. ' . number_format( $allprint['lumpsumharian'], 0 , '' , ',' ); ?></td>
                              <td class="thick-line"></td>
                              <td class="thick-line"></td>
                              <td class="thick-line"></td>
                              <td class="thick-line"></td>
              								<td class="thick-line text-left">Perdin</td>
              								<td class="thick-line text-right"><?php echo 'Rp. ' . number_format( $allprint['perdin'], 0 , '' , ',' ); ?></td>
              							</tr>
              							<tr>
                              <td class="text-left"><strong>Lumpsum Operational</strong></td>
              								<td class="text-left"><?php echo 'Rp. ' . number_format( $allprint['lumpsumops'], 0 , '' , ',' ); ?></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
              								<td class="text-left">Akomodasi</td>
              								<td class="text-right"><?php echo 'Rp. ' . number_format( $allprint['akomodasi'], 0 , '' , ',' ); ?></td>
              							</tr>
              							<tr>
                              <td class="text-left"><strong>Total Lumpsum</strong></td>
              								<td class="text-left"><?php echo 'Rp. ' . number_format( $allprint['lumpsumops'] + $allprint['lumpsumharian'], 0 , '' , ',' ); ?></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
              								<td class="text-left">BPJS</td>
              								<td class="text-right"><?php echo 'Rp. ' . number_format( $allprint['bpjs'], 0 , '' , ',' ); ?></td>
              							</tr>
                            <tr>
                              <td class="no-line"></td>
              								<td class="no-line"></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
                              <td class="no-line"></td>
              								<td class="text-left">Total</td>
              								<td class="text-right"><?php echo 'Rp. ' . number_format( $allprint['bpjs'] + $allprint['akomodasi'] + $allprint['perdin'], 0 , '' , ',' ); ?></td>
              							</tr>
              						</tbody>
              					</table>
              				</div>
              			</div>
              		</div>
              	</div>
              </div>


          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Transaksi</h3>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-condensed">
                      <thead>
                        <tr>
                          <th class="text-center"><strong>Lumpsum TRK</strong></th>
                          <th class="text-center">Kunjungan</th>
                          <th class="text-center"><strong>Quota</strong></th>
                          <th class="text-center"><strong>Quantity</strong></th>
                          <th class="text-center"><strong>Harga Satuan</strong></th>
                          <th class="text-center"><strong>Harga Total</strong></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $ttl = 0;
                        foreach ($printtrk as $key) {
                        ?>
                        <tr>
                          <td class="text-left"><?php echo $key['namanya'] ?></td>
                          <td class="text-center"><?php echo $key['attnya'] ?></td>
                          <td class="text-center"><?php echo $key['banyaknya'] ?></td>
                          <td class="text-center"><?php echo $key['jumlah'] ?></td>
                          <td class="text-center"><?php echo 'Rp. ' . number_format( $key['harga'], 0 , '' , ',' ); ?></td>
                          <td class="text-center">
                          <?php
                          $totaltrknya = $key['harga'] * $key['jumlah'] * $key['banyaknya'];
                          echo 'Rp. ' . number_format( $totaltrknya, 0 , '' , ',' );
                          ?>
                          </td>
                        </tr>
                        <?php
                        $ttl += $totaltrknya;
                        }
                        ?>
                        <tr>
                          <td class="thick-line"></td>
                          <td class="thick-line"></td>
                          <td class="thick-line"></td>
                          <td class="thick-line"></td>
                          <td class="thick-line text-center"><strong>Total :</strong></td>
                          <td class="thick-line text-center"><b><?php echo 'Rp. ' . number_format( $ttl, 0 , '' , ',' ); ?></b></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Pencairan Lumpsum</h3>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th class="text-center"><strong>Term</strong></th>
                      <th class="text-center">Aktual OPS</th>
                      <th class="text-center">Perdin</th>
                      <th class="text-center">Akomodasi</th>
                      <th class="text-center">BPJS</th>
                      <th class="text-center">Aktual TRK</th>
                      <th class="text-center">Aktual Bayar</th>
                      <th class="text-center">Tanggal Bayar</th>
                      <th class="text-center">Nomor Voucher</th>
                    </tr>
                  </thead>
                    <?php
                    if($allprint['nomorstkb'] == '351' || $allprint['nomorstkb'] == '358' || $allprint['nomorstkb'] == '359'){
                      $perdinnya = 0;
                      $perdinnya3 = $allprint['perdin'];
                    }else{
                      $perdinnya = $allprint['perdin'];
                      $perdinnya3 = 0;
                    }

                    $totsnya1 = $allprint['term1'] + $allprint['term1trk'] + $perdinnya + $allprint['akomodasi'] + $allprint['bpjs'];
                    $totsnya2 = $allprint['term2'] + $allprint['term2trk'];
                    $totsnya3 = $allprint['term3'] + $allprint['term3trk'] + $perdinnya3;
                    $semuanya = $totsnya1 + $totsnya2 + $totsnya3;
                    ?>
                  <tbody>
                    <tr>
                      <td class="text-center">Term 1</td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( $allprint['term1'], 0 , '' , ',' ); ?></td>
                      <td class="text-center">
                        <?php
                        if($allprint['nomorstkb'] == '351' || $allprint['nomorstkb'] == '358' || $allprint['nomorstkb'] == '359'){
                          echo 'Rp. ' . number_format( 0, 0 , '' , ',' );
                        }else{
                          echo 'Rp. ' . number_format( $allprint['perdin'], 0 , '' , ',' );
                        }
                        ?>
                      </td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( $allprint['akomodasi'], 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( $allprint['bpjs'], 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( $allprint['term1trk'], 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( $totsnya1, 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo $novouc1['tanggalbayar']; ?></td>
                      <td class="text-center"><?php echo $novouc1['novoucher'] ?></td>
                    </tr>
                    <tr>
                      <td class="text-center">Term 2</td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( $allprint['term2'], 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( $allprint['term2trk'], 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo 'Rp. ' . number_format( $totsnya2, 0 , '' , ',' ); ?></td>
                      <td class="text-center"><?php echo $novouc2['tanggalbayar']; ?></td>
                      <td class="text-center"><?php echo $novouc2['novoucher'] ?></td>
                    </tr>
                    <td class="text-center">Term 3</td>
                    <td class="text-center"><?php echo 'Rp. ' . number_format( $allprint['term3'], 0 , '' , ',' ); ?></td>
                    <td class="text-center">
                      <?php
                      if($allprint['nomorstkb'] == '351' || $allprint['nomorstkb'] == '358' || $allprint['nomorstkb'] == '359'){
                        echo 'Rp. ' . number_format( $allprint['perdin'], 0 , '' , ',' );
                      }else{
                        echo 'Rp. ' . number_format( 0, 0 , '' , ',' );
                      }
                      ?>
                    </td>
                    <td class="text-center"><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?></td>
                    <td class="text-center"><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?></td>
                    <td class="text-center"><?php echo 'Rp. ' . number_format( $allprint['term3trk'], 0 , '' , ',' ); ?></td>
                    <td class="text-center"><?php echo 'Rp. ' . number_format( $totsnya3, 0 , '' , ',' ); ?></td>
                    <td class="text-center"><?php echo $novouc3['tanggalbayar']; ?></td>
                    <td class="text-center"><?php echo $novouc3['novoucher'] ?></td>
                  </tr>
                    <tr>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                      <td class="thick-line text-center"><strong>Total :</strong></td>
                      <td class="thick-line text-center"><b><?php echo 'Rp. ' . number_format( $semuanya, 0 , '' , ',' ); ?></b></td>
                      <td class="thick-line"></td>
                      <td class="thick-line"></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  <!-- </div> -->

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

<input type="button" onclick="printDiv('printableArea')" value="PRINT STKB" />

<script>
function printDiv(divName) {
   var printContents = document.getElementById(divName).innerHTML;
   var originalContents = document.body.innerHTML;

   document.body.innerHTML = printContents;

   window.print();

   document.body.innerHTML = originalContents;
}
</script>
