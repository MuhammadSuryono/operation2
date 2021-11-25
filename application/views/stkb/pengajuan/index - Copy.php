<?php
            $id_user = $this->session->userdata('id_user');
            // var_dump($id_user); die;
            if($this->db->get_where('user', ['noid' => $id_user])->num_rows()>=1){
              $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
              $nama = $user['name'];
            } else {
              $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
              $nama = $user['Nama'];
            }
?>
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

              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Cek Pengajuan Term 1</a></li>
                <li><a data-toggle="tab" href="#term2">Cek Pengajuan Term 2</a></li>
                <li><a data-toggle="tab" href="#term3">Cek Pengajuan Term 3</a></li>
                <li><a data-toggle="tab" href="#menu1">Ready To Paid</a></li>
                <li><a data-toggle="tab" href="#menu2">Paid</a></li>
              </ul>

          <div class="tab-content">

              <!-- Term 1 -->
              <div id="home" class="tab-pane fade in active">
                <div class="table-responsive">
                <form action="<?php echo base_url('stkb/readytopaid')?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="pengklik" value="<?php echo $this->session->userdata('id_user'); ?>">
                <table class=" table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Stkb</th>
                        <th>Term</th>
                        <th>Tanggal Buat</th>
                        <th>Tanggal Mulai</th>
                        <th>Project</th>
                        <th>Nama</th>
                        <th>Perdin</th>
                        <th>Akomodasi</th>
                        <th>Bpjs</th>
                        <th>Jumlah RTP (OPS)</th>
                        <th>Jumlah RTP (TRK)</th>
                        <th>Total</th>
                        <th>Cek</th>
                        <th>Print</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($getpengajuan as $key) :
                         $totalnya = $key['jumlahops'] + $key['jumlahtrk'] + $key['perdin'] + $key['akomodasi'] + $key['bpjs'];
                         ?>
                         <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $key['nmrstkb'] ?><input type="hidden" name="nomorstkb<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['nmrstkb'] ?>"></td>
                          <td><?php echo $key['termnya'] ?><input type="hidden" name="term<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['termnya'] ?>"></td>
                          <td><?php echo $key['tanggalbuat'] ?><input type="hidden" name="tanggalbuat<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['tanggalbuat'] ?>"></td>
                          <td><?php echo $key['tglm'] ?></td>
                          <td><?php echo $key['kodeproject'] ?> - <?php echo $key['namaproject'] ?><input type="hidden" name="kodeproject<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['kodeproject'] ?>"></td>
                          <td><?php echo $key['idpic'] ?> - <?php echo $key['namapic'] ?><input type="hidden" name="idpic<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['idpic'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['perdin'], 0 , '' , ',' ); ?><input type="hidden" name="perdin<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['perdin']?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['akomodasi'], 0 , '' , ',' ); ?><input type="hidden" name="akomodasi<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['akomodasi']?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['bpjs'], 0 , '' , ',' ); ?><input type="hidden" name="bpjs<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['bpjs']?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['jumlahops'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahops<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['jumlahops'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['jumlahtrk'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahtrk<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['jumlahtrk'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $totalnya, 0 , '' , ',' ); ?><input type="hidden" name="total<?php echo $key['nmrstkb'] ?>" value="<?php echo $totalnya; ?>"></td>
                          <td><input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree" name="statusbayar[]" value="<?php echo $key['nmrstkb'] ?>" /></td>
                          <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $key['nmrstkb']; ?>/<?php echo $key['termnya']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                        </tr>
                       <?php
                       $no++;
                      endforeach;
                        ?>
                  </tbody>
                </table>
                    <?php
                    $totalops = 0;
                    $totaltrk = 0;
                    $totalperdin = 0;
                    $totalakomodasi = 0;
                    $totalbpjs = 0;
                    foreach ($getpengajuan as $gp) {
                      $totalops += $gp['jumlahops'];
                      $totaltrk += $gp['jumlahtrk'];
                      $totalperdin += $gp['perdin'];
                      $totalakomodasi += $gp['akomodasi'];
                      $totalbpjs += $gp['bpjs'];
                    }
                    $totalseluruh = $totalops + $totaltrk + $totalperdin + $totalakomodasi + $totalbpjs;
                    ?>
                    <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2"><h3><?php echo 'Rp. ' . number_format( $totalseluruh, 0 , '' , ',' ); ?></h3></div>
                    </div>
                    <div class="row">
                    <div class="col-md-10"></div>

		    <?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
                    <div class="col-md-2"><button type="submit" class="btn btn-lg btn-success">Move To RTP >></button></div>
		    <?php endif?>

                    </div>
                    </form>
                  </div>
              </div>
              <!-- //Term 1 -->

              <!-- Term 2 -->
              <div id="term2" class="tab-pane fade">
                <div class="table-responsive">
                <form action="<?php echo base_url('stkb/readytopaid')?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="pengklik" value="<?php echo $this->session->userdata('id_user'); ?>">
                <table class=" table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Stkb</th>
                        <th>Term</th>
                        <th>Tanggal Buat</th>
                        <th>Tanggal Mulai</th>
                        <th>Project</th>
                        <th>Nama</th>
                        <th>Perdin</th>
                        <th>Akomodasi</th>
                        <th>Bpjs</th>
                        <th>Jumlah RTP (OPS)</th>
                        <th>Jumlah RTP (TRK)</th>
                        <th>Total</th>
                        <th>Cek</th>
                        <th>Print</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        $totalterm23 = 0;
                        foreach ($allpengajuanterm2 as $keyy) :
                        $nomorstkb2 = $keyy['nmrstkb'];
                        $servername = "localhost";
                        $username = "adam";
                        $password = "Ad@mMR1db";
                        $dbname = "jay2";
                        $koneksi = new mysqli($servername, $username, $password, $dbname);
                        $query = $koneksi->query("SELECT
                                                  100 * COUNT(nomorstkb) / (
                                                    SELECT
                                                      -- COUNT(b.att)
                                                      COUNT(a.kunjungan)
                                                    FROM
                                                      plan a
                                                    JOIN skenario b ON b.att = a.kunjungan
                                                    AND b.project = a.project
                                                    WHERE
                                                      a.nomorstkb = '$nomorstkb2'
                                                  ) AS jumlahnya
                                                FROM
                                                  quest
                                                WHERE
                                                  nomorstkb = '$nomorstkb2'
                                                AND STATUS = 3");
                        $progress = mysqli_fetch_array($query);
                        $progressnya = $progress['jumlahnya'];

                       if($progressnya >= 50){
                         $totalnya2 = $keyy['jumlahops'] + $keyy['jumlahtrk'];
                         $totalterm23 += $totalnya2;
                       ?>
                         <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $keyy['nmrstkb'] ?><input type="hidden" name="nomorstkb<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['nmrstkb'] ?>"></td>
                          <td><?php echo $keyy['termnya'] ?><input type="hidden" name="term<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['termnya'] ?>"></td>
                          <td><?php echo $keyy['tanggalbuat'] ?><input type="hidden" name="tanggalbuat<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['tanggalbuat'] ?>"></td>
                          <td><?php echo $keyy['tglm'] ?></td>
                          <td><?php echo $keyy['kodeproject'] ?> - <?php echo $keyy['namaproject'] ?><input type="hidden" name="kodeproject<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['kodeproject'] ?>"></td>
                          <td><?php echo $keyy['idpic'] ?> - <?php echo $keyy['namapic'] ?><input type="hidden" name="idpic<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['idpic'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?><input type="hidden" name="perdin<?php echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?><input type="hidden" name="akomodasi<?php echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?><input type="hidden" name="bpjs<?php echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php echo 'Rp. ' . number_format( $keyy['jumlahops'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahops<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['jumlahops'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $keyy['jumlahtrk'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahtrk<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['jumlahtrk'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $totalnya2, 0 , '' , ',' ); ?><input type="hidden" name="total<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $totalnya2; ?>"></td>
                          <td><input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree" name="statusbayar[]" value="<?php echo $keyy['nmrstkb'] ?>" /></td>
                          <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $keyy['nmrstkb']; ?>/<?php echo $keyy['termnya']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                       <?php
                       }
                       // else if($progressnya >= 100){
                       //   $totalnya3 = $keyy['jumlahops'] + $keyy['jumlahtrk'];
                       //   $totalterm23 += $totalnya3;
                       ?>
                         <!-- <tr>
                          <td><?php //echo $no; ?></td>
                          <td><?php //echo $keyy['nmrstkb'] ?><input type="hidden" name="nomorstkb<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['nmrstkb'] ?>"></td>
                          <td><?php //echo $keyy['termnya'] ?><input type="hidden" name="term<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['termnya'] ?>"></td>
                          <td><?php //echo $keyy['tanggalbuat'] ?><input type="hidden" name="tanggalbuat<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['tanggalbuat'] ?>"></td>
                          <td><?php //echo $keyy['tglm'] ?></td>
                          <td><?php //echo $keyy['kodeproject'] ?> - <?php //echo $keyy['namaproject'] ?><input type="hidden" name="kodeproject<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['kodeproject'] ?>"></td>
                          <td><?php //echo $keyy['idpic'] ?> - <?php //echo $keyy['namapic'] ?><input type="hidden" name="idpic<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['idpic'] ?>"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['perdin'], 0 , '' , ',' ); ?><input type="hidden" name="perdin<?php //echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['akomodasi'], 0 , '' , ',' ); ?><input type="hidden" name="akomodasi<?php //echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['bpjs'], 0 , '' , ',' ); ?><input type="hidden" name="bpjs<?php //echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['jumlahops'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahops<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['jumlahops'] ?>"></td>
                          <td><?php //echo $keyy['jumlahtrk'] ?><input type="hidden" name="jumlahtrk<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['jumlahtrk'] ?>"></td>
                          <td><?php //echo 'Rp. ' . number_format( $totalnya3, 0 , '' , ',' ); ?><input type="hidden" name="total<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $totalnya3; ?>"></td>
                          <td><input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree" name="statusbayar[]" value="<?php //echo $keyy['nmrstkb'] ?>" /></td>
                          <td><a href="<?php //echo base_url(); ?>stkb/printstkb/<?php //echo $keyy['nmrstkb']; ?>/<?php //echo $keyy['termnya']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                        </tr> -->
                      <?php
                       // }
                       $no++;
                      endforeach;
                        ?>
                  </tbody>
                </table>
                    <?php

                    ?>
                    <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2"><h3><?php echo 'Rp. ' . number_format( $totalterm23, 0 , '' , ',' ); ?></h3></div>
                    </div>
                    <div class="row">
                    <div class="col-md-10"></div>

		    <?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
                    <div class="col-md-2"><button type="submit" class="btn btn-lg btn-success">Move To RTP >></button></div>
		    <?php endif?>

                    </div>
                    </form>
                  </div>
              </div>
              <!-- Term 2 -->


              <!-- Term 3 -->
              <div id="term3" class="tab-pane fade">
                <div class="table-responsive">
                <form action="<?php echo base_url('stkb/readytopaid')?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="pengklik" value="<?php echo $this->session->userdata('id_user'); ?>">
                <table class=" table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Stkb</th>
                        <th>Term</th>
                        <th>Tanggal Buat</th>
                        <th>Tanggal Mulai</th>
                        <th>Project</th>
                        <th>Nama</th>
                        <th>Perdin</th>
                        <th>Akomodasi</th>
                        <th>Bpjs</th>
                        <th>Jumlah RTP (OPS)</th>
                        <th>Jumlah RTP (TRK)</th>
                        <th>Total</th>
                        <th>Cek</th>
                        <th>Print</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        $totalterm23 = 0;
                        foreach ($allpengajuanterm3 as $keyy) :
                        $nomorstkb2 = $keyy['nmrstkb'];
                        $servername = "localhost";
                        $username = "adam";
                        $password = "Ad@mMR1db";
                        $dbname = "jay2";
                        $koneksi = new mysqli($servername, $username, $password, $dbname);
                        $query = $koneksi->query("SELECT
                                                  100 * COUNT(nomorstkb) / (
                                                    SELECT
                                                      -- COUNT(b.att)
                                                      COUNT(a.kunjungan)
                                                    FROM
                                                      plan a
                                                    JOIN skenario b ON b.att = a.kunjungan
                                                    AND b.project = a.project
                                                    WHERE
                                                      a.nomorstkb = '$nomorstkb2'
                                                  ) AS jumlahnya
                                                FROM
                                                  quest
                                                WHERE
                                                  nomorstkb = '$nomorstkb2'
                                                AND STATUS = 3");
                        $progress = mysqli_fetch_array($query);
                        $progressnya = $progress['jumlahnya'];

                       // if($progressnya >= 50 && $progressnya < 100){
                       //   $totalnya2 = $keyy['jumlahops'] + $keyy['jumlahtrk'];
                       //   $totalterm23 += $totalnya2;
                       ?>
                         <!-- <tr>
                          <td><?php //echo $no; ?></td>
                          <td><?php //echo $keyy['nmrstkb'] ?><input type="hidden" name="nomorstkb<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['nmrstkb'] ?>"></td>
                          <td><?php //echo $keyy['termnya'] ?><input type="hidden" name="term<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['termnya'] ?>"></td>
                          <td><?php //echo $keyy['tanggalbuat'] ?><input type="hidden" name="tanggalbuat<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['tanggalbuat'] ?>"></td>
                          <td><?php //echo $keyy['tglm'] ?></td>
                          <td><?php //echo $keyy['kodeproject'] ?> - <?php //echo $keyy['namaproject'] ?><input type="hidden" name="kodeproject<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['kodeproject'] ?>"></td>
                          <td><?php //echo $keyy['idpic'] ?> - <?php //echo $keyy['namapic'] ?><input type="hidden" name="idpic<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['idpic'] ?>"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['perdin'], 0 , '' , ',' ); ?><input type="hidden" name="perdin<?php //echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['akomodasi'], 0 , '' , ',' ); ?><input type="hidden" name="akomodasi<?php //echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['bpjs'], 0 , '' , ',' ); ?><input type="hidden" name="bpjs<?php //echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['jumlahops'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahops<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['jumlahops'] ?>"></td>
                          <td><?php //echo 'Rp. ' . number_format( $keyy['jumlahtrk'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahtrk<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $keyy['jumlahtrk'] ?>"></td>
                          <td><?php //echo 'Rp. ' . number_format( $totalnya2, 0 , '' , ',' ); ?><input type="hidden" name="total<?php //echo $keyy['nmrstkb'] ?>" value="<?php //echo $totalnya2; ?>"></td>
                          <td><input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree" name="statusbayar[]" value="<?php //echo $keyy['nmrstkb'] ?>" /></td>
                          <td><a href="<?php //echo base_url(); ?>stkb/printstkb/<?php //echo $keyy['nmrstkb']; ?>/<?php //echo $keyy['termnya']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                        </tr> -->
                       <?php
                       // }
                       if($progressnya >= 100){
                         $totalnya3 = $keyy['jumlahops'] + $keyy['jumlahtrk'];
                         $totalterm23 += $totalnya3;
                       ?>
                         <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $keyy['nmrstkb'] ?><input type="hidden" name="nomorstkb<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['nmrstkb'] ?>"></td>
                          <td><?php echo $keyy['termnya'] ?><input type="hidden" name="term<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['termnya'] ?>"></td>
                          <td><?php echo $keyy['tanggalbuat'] ?><input type="hidden" name="tanggalbuat<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['tanggalbuat'] ?>"></td>
                          <td><?php echo $keyy['tglm'] ?></td>
                          <td><?php echo $keyy['kodeproject'] ?> - <?php echo $keyy['namaproject'] ?><input type="hidden" name="kodeproject<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['kodeproject'] ?>"></td>
                          <td><?php echo $keyy['idpic'] ?> - <?php echo $keyy['namapic'] ?><input type="hidden" name="idpic<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['idpic'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?><input type="hidden" name="perdin<?php echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?><input type="hidden" name="akomodasi<?php echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php echo 'Rp. ' . number_format( 0, 0 , '' , ',' ); ?><input type="hidden" name="bpjs<?php echo $keyy['nmrstkb'] ?>" value="0"></td>
                          <td><?php echo 'Rp. ' . number_format( $keyy['jumlahops'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahops<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['jumlahops'] ?>"></td>
                          <td><?php echo $keyy['jumlahtrk'] ?><input type="hidden" name="jumlahtrk<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $keyy['jumlahtrk'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $totalnya3, 0 , '' , ',' ); ?><input type="hidden" name="total<?php echo $keyy['nmrstkb'] ?>" value="<?php echo $totalnya3; ?>"></td>
                          <td><input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree" name="statusbayar[]" value="<?php echo $keyy['nmrstkb'] ?>" /></td>
                          <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $keyy['nmrstkb']; ?>/<?php echo $keyy['termnya']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                        </tr>
                      <?php
                       }
                       $no++;
                      endforeach;
                        ?>
                  </tbody>
                </table>
                    <?php

                    ?>
                    <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2"><h3><?php echo 'Rp. ' . number_format( $totalterm23, 0 , '' , ',' ); ?></h3></div>
                    </div>
                    <div class="row">
                    <div class="col-md-10"></div>

		    <?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
                    <div class="col-md-2"><button type="submit" class="btn btn-lg btn-success">Move To RTP >></button></div>
		    <?php endif?>

                    </div>
                    </form>
                  </div>
              </div>
              <!-- //TERM 3 -->



              <div id="menu1" class="tab-pane fade">
                <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Stkb</th>
                        <th>Term</th>
                        <th>Tanggal Buat</th>
                        <th>Project</th>
                        <th>Nama</th>
                        <th>Perdin</th>
                        <th>Akomodasi</th>
                        <th>Bpjs</th>
                        <th>Jumlah RTP (OPS)</th>
                        <th>Jumlah RTP (TRK)</th>
                        <th>Total</th>

			<?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
                        <th>Bayar</th>
			<?php endif?>

                        <th>Print</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($getrtp as $key2) :
                        $totalnya = $key2['jumlahops'] + $key2['jumlahtrk'] + $key2['perdin'] + $key2['bpjs'] + $key2['akomodasi'];
                       ?>
                       <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key2['nomorstkb'] ?></td>
                        <td><?php echo $key2['term'] ?></td>
                        <td><?php echo $key2['tanggalbuat'] ?></td>
                        <td><?php echo $key2['kodeproject'] ?> - <?php echo $key2['namaproject'] ?></td>
                        <td><?php echo $key2['idpic'] ?> - <?php echo $key2['namapic'] ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key2['perdin'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key2['akomodasi'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key2['bpjs'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key2['jumlahops'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key2['jumlahtrk'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $totalnya, 0 , '' , ',' ); ?></td>

			<?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
                        <td><a href="javascript:;" data-toggle="modal" data-target="#bayarstkb" data-nomorstkb="<?php echo $key2['nomorstkb']; ?>" data-pembayar="<?php echo $key2['nomorstkb']; ?>"
                              data-totalnya="<?php echo $totalnya; ?>" data-term="<?php echo $key2['term'] ?>" data-ops="<?php echo $key2['jumlahops'] ?>" data-trk="<?php echo $key2['jumlahtrk'] ?>"
                              data-perdin="<?php echo $key2['perdin'] ?>" data-akomodasi="<?php echo $key2['akomodasi'] ?>" data-bpjs="<?php echo $key2['bpjs']?>" class="btn-success btn-sm"><i class="fa fa-money"></i> Paid</a></td>
			<?php endif?>

                        <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $key2['nomorstkb']; ?>/<?php echo $key2['term']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                      </tr>
                       <?php
                       $no++;
                      endforeach;
                        ?>
                  </tbody>
                </table>
                    <?php
                    $totalops = 0;
                    $totaltrk = 0;
                    $totalperdin = 0;
                    $totalakomodasi = 0;
                    $totalbpjs = 0;
                    foreach ($getrtp as $gp) {
                      $totalops += $gp['jumlahops'];
                      $totaltrk += $gp['jumlahtrk'];
                      $totalperdin += $gp['perdin'];
                      $totalakomodasi += $gp['akomodasi'];
                      $totalbpjs += $gp['bpjs'];
                    }
                    $totalseluruh = $totalops + $totaltrk + $totalperdin + $totalakomodasi + $totalbpjs;
                    $totalseluruh = $totalops + $totaltrk;
                    ?>
                    <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2"><h3><?php echo 'Rp. ' . number_format( $totalseluruh, 0 , '' , ',' ); ?></h3></div>
                    </div>
                  </div>
              </div>

              <div id="menu2" class="tab-pane fade">
                <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed" id="dataTables-example">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Stkb</th>
                        <th>Term</th>
                        <th>Tanggal Buat</th>
                        <th>Project</th>
                        <th>Nama</th>
                        <th>Perdin</th>
                        <th>Akomodasi</th>
                        <th>Bpjs</th>
                        <th>Jumlah RTP (OPS)</th>
                        <th>Jumlah RTP (TRK)</th>
                        <th>Total</th>
                        <th>Tanggal Bayar</th>
                        <th>No. Voucher</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Print</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($getpaid as $key3) :
                        $totalnya = $key3['jumlahops'] + $key3['jumlahtrk'] + $key3['akomodasi'] + $key3['perdin'] + $key3['bpjs'];
                       ?>
                       <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key3['nomorstkb'] ?></td>
                        <td><?php echo $key3['term'] ?></td>
                        <td><?php echo $key3['tanggalbuat'] ?></td>
                        <td><?php echo $key3['kodeproject'] ?> - <?php echo $key3['namaproject'] ?></td>
                        <td><?php echo $key3['idpic'] ?> - <?php echo $key3['namapic'] ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key3['perdin'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key3['akomodasi'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key3['bpjs'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key3['jumlahops'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key3['jumlahtrk'], 0 , '' , ',' ); ?></td>
                        <td><?php echo 'Rp. ' . number_format( $totalnya, 0 , '' , ',' ); ?></td>
                        <td><?php echo $key3['tanggalbayar'] ?></td>
                        <td><?php echo $key3['novoucher'] ?></td>
                        <td><?php echo 'Rp. ' . number_format( $key3['jumlahbayar'], 0 , '' , ',' ); ?></td>
                        <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $key3['nomorstkb']; ?>/<?php echo $key3['term']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                        <!-- <td><button type="button" class="btn btn-default btn-small" onclick="printstkb('<?php //echo $key3['nomorstkb']; ?>','<?php //echo $key3['term']; ?>')"><i class="fa fa-print"></i> Print</button></td> -->
                      </tr>
                       <?php
                       $no++;
                      endforeach;
                        ?>
                  </tbody>
                </table>
                  </div>
              </div>
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

    <div class="modal" id="bayarstkb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran STKB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url('stkb/bayarstkb') ?>">
                        <input type="hidden" name="nomorstkb" id="nomorstkb">
                        <input type="hidden" name="pembayar" id="pembayar">
                        <input type="hidden" name="term" id="term">
                        <input type="hidden" name="statusbayar" value="Paid">

                        <div class="form-group">
                          <label>Total Akomodasi :</label>
                            <input type="number" id="akomodasi" name="akomodasi" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Total Perdin :</label>
                            <input type="number" id="perdin" name="perdin" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Total BPJS :</label>
                            <input type="number" id="bpjs" name="bpjs" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Aktual Bayar STKB OPS :</label>
                            <input type="number" id="ops" name="ops" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Aktual Bayar STKB TRK :</label>
                            <input type="number" id="trk" name="trk" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Total Bayar :</label>
                            <input type="number" id="totalnya" name="total" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Tanggal Bayar :</label>
                            <input type="date" name="tanggalbayar" class="form-control form-control-user" required>
                        </div>

                        <div class="form-group">
                          <label>Nomor Voucher :</label>
                            <input type="text" name="novoucher" class="form-control form-control-user"  maxlength="4" placeholder="0000" required>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="printstkb" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Print STKB</h4>
                  </div>
                  <div class="modal-body">
                      <div class="fetched-data"></div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                  </div>
              </div>
          </div>
      </div>

<script>
function printstkb(nomorstkb,term){
  // alert(nomorstkb);
  $.ajax({
      type : 'post',
      url  : '<?php echo base_url('stkb/printstkb')?>',
      data :  {nomorstkb:nomorstkb, term:term},
      success : function(data){
        $('.fetched-data').html(data);//menampilkan data ke dalam modal
        $('#printstkb').modal();
      }
  });
}
</script>
