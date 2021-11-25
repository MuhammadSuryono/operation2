<?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Matriks Lumpsum Operasional </strong> </h4>
                    
                    <?php if ($user['id_divisi'] == 99) : ?>
                    <a href="" class="btn btn-round btn-primary mb" data-target="#tambahls" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>
                    <?php endif; ?>

                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

            <section id="unseen">
              <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                      <tr bgcolor="#e3f3fc">
                          <th rowspan="2" style="vertical-align : middle;text-align:center;">No</th>
                          <th rowspan="2" style="vertical-align : middle;text-align:center;">Kota</th>
                          <th rowspan="2" style="vertical-align : middle;text-align:center;">Jabatan</th>
                          <th rowspan="2" style="vertical-align : middle;text-align:center;">Penempatan</th>
                          <th rowspan="2">Per Diem <br> (Uang Saku)</th>
                          <th colspan="3"><center>LS Operasional Harian</center></th>
                          <th colspan="3"><center>LS Operasional Kunjungan</center></th>
                          <th rowspan="2" style="vertical-align : middle;text-align:center;">Transport Teller Terpisah</th>
                          <th rowspan="2" style="vertical-align : middle;text-align:center;"> Transport ATM Center & Malam</th>
                          <th rowspan="2">Akomodasi Dinas <br>(1 - 7 hari kerja)</th>
                          <th rowspan="2">Akomodasi DInas <br>(1 - 14 hari kerja)</th>
                          <th rowspan="2" style="vertical-align : middle;text-align:center;">BPJS</th>
                          <th rowspan="2" style="vertical-align : middle;text-align:center;">Aksi</th>
                          
                      </tr>
                      <tr bgcolor="#e3f3fc">
                        <th>Biaya Pulsa</th>
                        <th>Biaya ATK</th>
                        <th>Transport Kegiatan Harian</th>

                        <th>Biaya Fotocopy</th>
                        <th>Biaya Pengiriman</th>
                        <th>Transport Kunjungan Ke Cabang</th>                        
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                         $urut = 1;
                         foreach ($getalllskontrak as $data) :
                      ?>
                      <tr>
                          <td><b><?php echo $urut++; ?></b></td>
                          <td><?php echo $data['kota'] ?></td>
                          <td><?php echo $data['jabatan'] ?></td>
                          <td><?php echo $data['penempatan'] ?></td>
                          <td><?php echo "Rp " . number_format($data['dinas'],0,',','.'); ?></td>
                          <!-- <td><?php echo "Rp " . number_format($data['lsharikerja'],0,',','.'); ?></td> -->
                          <td><?php echo "Rp " . number_format($data['biaya_pulsa'],0,',','.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['biaya_atk'],0,',','.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['transport_harian'],0,',','.'); ?></td>
                          
                          <td><?php echo "Rp " . number_format($data['biaya_fc'],0,',','.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['biaya_pengiriman'],0,',','.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['transport_kecabang'],0,',','.'); ?></td>

                          <td><?php echo "Rp " . number_format($data['kunjungan'],0,',','.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['atmcentermalam'],0,',','.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['lsakomodasi1_8'],0,',','.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['lsakomodasi9_16'],0,',','.'); ?></td>
                          <td><?php echo "Rp " . number_format($data['bpjs'],0,',','.'); ?></td>
                          <td>
                              <center>
                                <?php if ($user['id_divisi'] == 99) : ?>
                                <button type="button" data-toggle="modal" data-target="#edit_lskontrak<?php echo $data['no'] ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</button><br>
                               
                                
                                 <!-- <a href="<?php echo base_url(); ?>stkb/hapus_lskontrak/<?php echo $data['no']; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                                 

                                   <a href="javascript:;" data-toggle="modal" data-target="#edit-matrixperdin" data-id="<?php //echo $nomornya; ?>" data-ka="<?php //echo $data['kotaasal'] ?>"
                                                                             data-kt="<?php //echo $data['kotatujuan'] ?>" data-j="<?php //echo $data['jenis'] ?>" data-mh="<?php //echo $data['matrixhonor'] ?>" class="btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                  <a href="<?php //echo base_url(); ?>stkb/hapus_matrixperdin/<?php //echo $nomornya; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a> -->
                                <?php endif; ?>
                              </center>
                          </td>
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

    <div class="modal fade" id="tambahls" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Input Data LS Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="<?php echo base_url('stkb/tambah_lskontrak') ?>">
                      <div class="form-group">
                        <?php
                        $kokab = $this->db->get('stkb_kotakab')->result_array(); ?>
                        <label>Kota</label>
                          <select class="form-control form-control-user" name="kota">
                            <option value="" selected="">--Pilih Kota/Kabupaten--</option>
                            <?php foreach ($kokab as $row) {
                              ?>
                              <option value="<?php echo $row['jeniskota'] ?>"><?php echo $row['kabupatenkota']; ?></option>
                              <?php
                            } ?>
                          </select>
                      </div>

                      <div class="form-group">
                        <label>Jabatan</label>
                          <select class="form-control form-control-user" name="jabatan">
                            <option value="" selected="">--Pilih Jabatan--</option>
                            <option value="PEWITNES">PEWITNES</option>
                            <option value="SUPERVISOR">SUPERVISOR</option>
                            <option value="TLF">TLF</option>
                            
                          </select>
                        </div>

                      <div class="form-group">
                        <label>Penempatan</label>
                          <select class="form-control form-control-user" name="penempatan">
                            <option value="" selected="">--Pilih Penempatan--</option>
                            <option value="DINAS">DINAS</option>
                            <option value="SETEMPAT">SETEMPAT</option>
                            
                          </select>
                      </div>

                      <div class="form-group">
                        <label>Per Diem (Uang Saku)</label>
                          <input type="number" id="mh" name="dinas" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>LS Operasional Harian : </label>
                          <!-- <input type="number" id="mh" name="lsharikerja" class="form-control form-control-user" aria-describedby="emailHelp" placeholder=""> -->
                          <div class="row">
                            <div class="col-md-3 form-group">
                              <label>Biaya Pulsa</label>
                              <input type="number" id="mh" name="biaya_pulsa" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                            </div>
                            <div class="col-md-4 form-group">
                              <label>Biaya ATK</label>
                              <input type="number" id="mh" name="biaya_atk" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                            </div>
                            <div class="col-md-5 form-group">
                              <label>Transport Harian</label>
                              <input type="number" id="mh" name="transport_harian" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                        <label>LS  Operasional Kunjungan</label>
                          <!-- <input type="number" id="mh" name="lsops" class="form-control form-control-user" aria-describedby="emailHelp" placeholder=""> -->
                          <div class="row">
                            <div class="col-md-3 form-group">
                              <label>Biaya Fotocopy</label>
                              <input type="number" id="mh" name="biaya_fc" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                            </div>
                            <div class="col-md-4 form-group">
                              <label>Biaya Pengiriman</label>
                              <input type="number" id="mh" name="biaya_pengiriman" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                            </div>
                            <div class="col-md-5 form-group">
                              <label>Transport Kunjungan Ke Cabang</label>
                              <input type="number" id="mh" name="transport_kecabang" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                            </div>
                          </div>

                      </div>
                      
                      <!-- <div class="form-group">
                        <label>OPS Kunjungan</label>
                          <input type="number" id="mh" name="opskunjungan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                      </div> -->

                      <div class="form-group">
                        <label>Transport Teller Terpisah</label>
                          <input type="number" id="mh" name="kunjungan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>Transport ATM Center & Malam</label>
                          <input type="number" id="mh" name="atmcentermalam" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                      </div>

                      

                      <div class="form-group">
                        <label>Akomodasi Dinas (1 - 7 Hari Kerja)</label>
                          <input type="number" id="mh" name="lsakomodasi1_8" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>Akomodasi Dinas (1 - 14 Hari Kerja)</label>
                          <input type="number" id="mh" name="lsakomodasi9_16" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                      </div>

                      <div class="form-group">
                        <label>BPJS</label>
                          <input type="number" id="mh" name="bpjs" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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


    <?php
      $no = 0;
      foreach ($getalllskontrak as $data) : $no++;
    ?>
    <div class="modal fade" id="edit_lskontrak<?php echo $data['no'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit LS Kontrak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url('stkb/edit_lskontrak') ?>">
                        <input type="hidden" name="no" id="no" value="<?php echo $data['no'] ?>">


                       <div class="form-group">
                        <label>Kota</label>
                          <input type="text" id="ka" name="kota" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['kota'] ?>" readonly>
                      </div>

                      <div class="form-group">
                        <label>Jabatan</label>
                         <input type="text" id="ka" name="jabatan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['jabatan'] ?>" readonly>
                          <!-- <select class="form-control form-control-user" name="jabatan">
                            <option value="">--Pilih Jabatan--</option>
                            <option value="PEWITNES" <?php if($data['jabatan']=="PEWITNES"){echo "selected";} ?>>PEWITNES</option>
                            <option value="SUPERVISOR" <?php if($data['jabatan']=="SUPERVISOR"){echo "selected";} ?>>SUPERVISOR</option>
                            <option value="TLF" <?php if($data['jabatan']=="TLF"){echo "selected";} ?>>TLF</option>
                            
                          </select> -->
                      </div>

                      <div class="form-group">
                        <label>Penempatan</label>
                         <input type="text" id="ka" name="penempatan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['penempatan'] ?>" readonly>
                         <!-- <select class="form-control form-control-user" name="penempatan">
                            <option value="" selected="">--Pilih Penempatan--</option>
                            <option value="DINAS" <?php if($data['penempatan']=="DINAS"){echo "selected";} ?>>DINAS</option>
                            <option value="SETEMPAT" <?php if($data['penempatan']=="SETEMPAT"){echo "selected";} ?>>SETEMPAT</option>
                            
                          </select> -->
                      </div>

                      <div class="form-group">
                        <label>Per Diem (Uang Saku)</label>
                          <input type="number" id="mh" name="dinas" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['dinas'] ?>">
                      </div>

                      <div class="form-group">
                        <label>LS Operasional Harian : </label>
                          <!-- <input type="number" id="mh" name="lsharikerja" class="form-control form-control-user" aria-describedby="emailHelp" placeholder=""> -->
                          <div class="row">
                            <div class="col-md-3 form-group">
                              <label>Biaya Pulsa</label>
                              <input type="number" id="mh" name="biaya_pulsa" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['biaya_pulsa'] ?>">
                            </div>
                            <div class="col-md-4 form-group">
                              <label>Biaya ATK</label>
                              <input type="number" id="mh" name="biaya_atk" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['biaya_atk'] ?>">
                            </div>
                            <div class="col-md-5 form-group">
                              <label>Transport Harian</label>
                              <input type="number" id="mh" name="transport_harian" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['transport_harian'] ?>">
                            </div>
                          </div>
                      </div>

                      <div class="form-group">
                        <label>LS  Operasional Kunjungan : </label>
                          <!-- <input type="number" id="mh" name="lsops" class="form-control form-control-user" aria-describedby="emailHelp" placeholder=""> -->
                          <div class="row">
                            <div class="col-md-3 form-group">
                              <label>Biaya Fotocopy</label>
                              <input type="number" id="mh" name="biaya_fc" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['biaya_fc'] ?>">
                            </div>
                            <div class="col-md-4 form-group">
                              <label>Biaya Pengiriman</label>
                              <input type="number" id="mh" name="biaya_pengiriman" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['biaya_pengiriman'] ?>">
                            </div>
                            <div class="col-md-5 form-group">
                              <label>Transport Kunjungan Ke Cabang</label>
                              <input type="number" id="mh" name="transport_kecabang" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['transport_kecabang'] ?>">
                            </div>
                          </div>

                      </div>
                      
                      <!-- <div class="form-group">
                        <label>OPS Kunjungan</label>
                          <input type="number" id="mh" name="opskunjungan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                      </div> -->

                      <div class="form-group">
                        <label>Transport Teller Terpisah</label>
                          <input type="number" id="mh" name="kunjungan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['kunjungan'] ?>">
                      </div>

                      <div class="form-group">
                        <label>Transport ATM Center & Malam</label>
                          <input type="number" id="mh" name="atmcentermalam" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['atmcentermalam'] ?>">
                      </div>

                      

                      <div class="form-group">
                        <label>Akomodasi Dinas (1 - 7 Hari Kerja)</label>
                          <input type="number" id="mh" name="lsakomodasi1_8" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['lsakomodasi1_8'] ?>">
                      </div>

                      <div class="form-group">
                        <label>Akomodasi Dinas (1 - 14 Hari Kerja)</label>
                          <input type="number" id="mh" name="lsakomodasi9_16" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['lsakomodasi9_16'] ?>">
                      </div>

                      <div class="form-group">
                        <label>BPJS</label>
                          <input type="number" id="mh" name="bpjs" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" value="<?php echo $data['bpjs'] ?>">
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
  <?php endforeach; ?>
