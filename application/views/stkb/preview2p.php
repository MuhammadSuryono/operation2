<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Preview 2P/2PR</h3>

        <!-- INLINE FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Project >></h4>
              <form role="form" action="<?php echo base_url('stkb/preview2p'); ?>" method="POST">
                <div class="form-group">
                  <label>Project :</label>
                  <select class="form-control" name="project" required>
                    <option value="">Pilih Project</option>
                    <?php
                    foreach ($projectnya as $key) {
                    ?>
                    <option value="<?php echo $key['prokod']?>"><?php echo $key['pronam']?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <button type="submit" class="btn btn-theme">Submit</button>
               <!--  <?php var_dump($cek_kode); ?> -->
              </form>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        <!-- /row -->



        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Preview 2P/2PR </strong> </h4>

                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                    
                    <form role="form" action="<?php echo base_url('stkb/takeout_skenario'); ?>" method="POST">
                <section id="unseen">
              <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                      <tr>
                        <th>  No. </th>
                        <th>  Nomor STKB</th>
                        <th>	Project	</th>
                        <th>	Cabang	</th>
                        <th>	Kota	</th>
                        <th>  Plan Start </th>
                        <th>  Plan End </th>
                        <th>	Kareg </th>
                        <th>	PIC Project </th>
                        <th>	List Shopper </th>
                        <th>	Skenario </th>
                        <th>  Takeout Kunjungan </th>
                        <th>  History Takeout </th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach($allpreview AS $key2)
                    {
                    ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $key2['nomorstkb']; ?></td>
                        <td><?php echo $key2['project']; ?> - <?php echo $key2['namapro']; ?></td>
                        <td><?php echo $key2['kode']; ?> - <?php echo $key2['namacab']; ?></td>
                        <td><?php echo $key2['kota']; ?></td>
                        <td><?php echo $key2['planstart']; ?></td>
                        <td><?php echo $key2['planend']; ?></td>
                        <td><?php echo $key2['namakareg']; ?></td>
                        <td><?php echo $key2['namaspv']; ?></td>
                        <td><?php echo $key2['idshp']; ?> - <?php echo $key2['namashp']; ?></td>
                        <td><?php echo $key2['namsken']; ?></td>


                       
                        <td>
                          <?php 
                           $data_array = explode(',',$key2['kd_sken']);
                           foreach ($data_array as $row) :
                           $q = $this->db->get_where('attribute', array('kode' => $row))->row();
                           ?>
                          <input type="checkbox" name="aksi_sken[]" value="<?php echo $key2['project']."_".$key2['kode']."_".$row."_".$key2['nomorstkb']  ?>">
                          <label><?php echo $q->nama; ?></label>
                          <label></label>
                          <?php endforeach; ?>
                        </td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view<?php echo $key2['kode'].$key2['nomorstkb'] ?>">View</button></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
                      <div class="form-inline text-right" >
                        <input type="hidden" name="kd_project" value="<?php echo $cek_kode ?>">
                        <label class="text-dark">Alasan Takeout</label>
                      <input type="text" name="alasan" class="form-control" style="width: 30%;">
                      <?php
                      if ($cek_kode) {
                        
                              $pembuat = $this->db->get_where('project', array('kode' => $cek_kode))->row();

                            if ($pembuat->id_user == $this->session->userdata('id_user')) {        
                      ?>
                      <input type="submit" name="submit_takeout" class="btn btn-primary" value="Take Out" title="Take Out Skenario">
                    <?php } else { ?>
                      <input type="submit" class="btn btn-primary" value="Take Out" title="Take Out Skenario" disabled>
                    <?php } 
                  } ?>

                    </div>
                    <div class="text-right mt-2">
                      <p>Note : Takeout kunjungan hanya bisa dilakukan oleh user pembuat project</p>
                    </div>
                  </form>


              </div>
              </section>
                <?php
              $no = 0;
              foreach ($allpreview AS $key2) :
                $no++;
              ?>
            <div class="modal fade" id="view<?php echo $key2['kode'].$key2['nomorstkb'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document" style="width: 70%;">
                <div class="modal-content" style="background-color:     #F8F8FF;">
                  <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">History Takeout Kunjungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="table-responsive">
                      <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                      <tr>
                        <th>  No. </th>
                        <th>  Nomor STKB</th>
                        <th>  Project </th>
                        <th> Cabang  </th>
                        <th>  Kota  </th>
                        <th>  Plan Start </th>
                        <th>  Plan End </th>
                        <th> Kareg </th>
                        <th>  PIC Project </th>
                        <th>  List Shopper </th>
                        <th>  Skenario </th>
                        <th>  User Takeout </th>
                        <th>  Waktu Takeout </th>
                        <th>  Alasan  </th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                    $pronya = $key2['project'];
                    $kodenya = $key2['kode'];
                    $stkbnya = $key2['nomorstkb'];
                    $i = 1;
                   $query = $this->db->query("
                                SELECT
                                  a.*
                                  , b.nama namapro,
                                  c.nama namacab,
                                  d.nama namakareg,
                                  e.nama namaspv,
                                 f.nama AS namsken,

                                g.shp AS idshp,
                                h.nama AS namashp,
                                i.name AS nama_user
                                FROM
                                  plan_hapus a
                                JOIN project b ON a.project = b.kode
                                JOIN cabang c ON a.kode = c.kode
                                AND a.project = c.project
                                JOIN id_data d ON a.spv = d.id
                                LEFT JOIN id_data e ON a.kareg = e.id
                                JOIN attribute f ON a.kunjungan = f.kode
                                JOIN quest g ON a.project = g.project AND a.kode = g.cabang
                                LEFT JOIN id_data h ON g.shp = h.id
                                JOIN user i ON a.user_takeout = i.noid
                                WHERE
                                  a.project = '$pronya' AND a.kode = '$kodenya' AND a.nomorstkb = '$stkbnya'
                                GROUP BY a.kode, a.nomorstkb, a.kunjungan
                                ORDER BY a.kode ASC
                                ")->result_array();

                   if ($query != NULL) {
                     
                   foreach ($query as $q) {
                   
                    ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $q['nomorstkb']; ?></td>
                        <td><?php echo $q['project']; ?> - <?php echo $q['namapro']; ?></td>
                        <td><?php echo $key2['kode']; ?> - <?php echo $key2['namacab']; ?></td>
                        <td><?php echo $q['kota']; ?></td>
                        <td><?php echo $q['planstart']; ?></td>
                        <td><?php echo $q['planend']; ?></td>
                        <td><?php echo $key2['namakareg']; ?></td>
                        <td><?php echo $key2['namaspv']; ?></td>
                        <td><?php echo $key2['idshp']; ?> - <?php echo $key2['namashp']; ?></td>
                        <td><?php echo $q['namsken']; ?></td>
                        <td><?php echo $q['nama_user']; ?></td>
                        <td><?php echo $q['waktu_takeout']; ?></td>
                        <td><?php echo $q['alasan']; ?></td>
                        
                        
                    </tr>
                  <?php } 
                    } else { ?>
                      <tr>
                        <td colspan="14" style="text-align: center;">Belum ada data tersedia</td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
                    
                  </div>
                  

                </div>
              </div>
            </div>
        <?php endforeach; ?>


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
