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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> STKB Tracking </strong> </h4>
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                <section id="unseen">
                <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed" id="dataTables-example">
                  <thead>
                      <tr>
                      <th colspan="15"><center>Data STKB</center></th>
                      <th colspan="2"><center>TERM 1</center></th>
                      <th colspan="2"><center>TERM 2</center></th>
                      <th colspan="2"><center>TERM 3</center></th>
                      </tr>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Stkb</th>
                        <th>Tanggal Buat</th>
                        <th>Project</th>
                        <th>Nama</th>
                        <th>Kota Asal</th>
                        <th>Kota Tujuan</th>
                        <th>Penugasan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Q Besar</th>
                        <th>Teller</th>
                        <th>ATM Center & Malam</th>
                        <th>Telp Cabang</th>
                        <th>Progress</th>
                        <th>Total Bayar</th>
                        <th>Paid Date</th>
                        <th>Total Bayar</th>
                        <th>Paid Date</th>
                        <th>Total Bayar</th>
                        <th>Paid Date</th>
                        <th>View</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        foreach ($gettracking as $key) :
                       ?>
                       <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $key['nmrstkb'] ?></td>
                        <td><?php echo $key['tanggalbuat'] ?></td>
                        <td><?php echo $key['kodeproject'] ?> - <?php echo $key['namaproject'] ?></td>
                        <td><?php echo $key['idpic'] ?> - <?php echo $key['namapic'] ?></td>
                        <td><?php echo $key['jeniskota'] ?></td>
                        <td><?php echo $key['jeniskota2'] ?></td>
                        <td><?php echo $key['tugasnya'] ?></td>
                        <td><?php echo $key['tglmulai'] ?></td>
                        <td><?php echo $key['tglselesai'] ?></td>
                        <td><?php echo $key['kuesbesar'] ?></td>
                        <td><?php echo $key['teller'] ?></td>
                        <td><?php echo $key['atmcm'] ?></td>
                        <td><?php echo $key['telpcbg'] ?></td>
                        <td>
                          <?php
                          $nomorstkb = $key['nmrstkb'];
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
                                                  			a.nomorstkb = '$nomorstkb'
                                                  	) AS jumlahnya
                                                  FROM
                                                  	quest
                                                  WHERE
                                                  	nomorstkb = '$nomorstkb'
                                                  AND STATUS = 3");
                          $progress = mysqli_fetch_array($query);
                          echo "<b>";
                          echo round($progress['jumlahnya']);
                          echo "%</b>";
                          ?>
                        </td>
                        <?php
                        $term1 = $this->db->query("SELECT * FROM stkb_pembayaran WHERE nomorstkb='$nomorstkb' AND term= 1 AND statusbayar='Paid'")->row_array();
                        $term2 = $this->db->query("SELECT * FROM stkb_pembayaran WHERE nomorstkb='$nomorstkb' AND term= 2 AND statusbayar='Paid'")->row_array();
                        $term3 = $this->db->query("SELECT * FROM stkb_pembayaran WHERE nomorstkb='$nomorstkb' AND term= 3 AND statusbayar='Paid'")->row_array();
                         ?>
                        <td><?php echo 'Rp. ' . number_format( $term1['jumlahbayar'], 0 , '' , ',' ); ?></td>
                        <td><?php echo $term1['tanggalbayar']; ?></td>
                        <td><?php echo 'Rp. ' . number_format( $term2['jumlahbayar'], 0 , '' , ',' ); ?></td>
                        <td><?php echo $term2['tanggalbayar']; ?></td>
                        <td><?php echo 'Rp. ' . number_format( $term3['jumlahbayar'], 0 , '' , ',' ); ?></td>
                        <td><?php echo $term3['tanggalbayar']; ?></td>
                        <td><button type="button" class="btn btn-success btn-sm" onclick="detailstkb('<?php echo $nomorstkb ?>')">
                          <i class="fa fa-eye fa-fw"></i> Detail</button></td>
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

      <!-- Modal -->
      <div class="modal fade" id="modal-detailstkb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel">Progress Detail STKB</h4>
            </div>
            <div class="modal-body">
              <div class="fetched-data"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /showback -->
