
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

$id_divisi = $this->session->userdata('id_divisi');
?>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Cabang Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Daftar Cabang </strong> </h4>
                       <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation"><a href="#nonatmcenter" aria-controls="nonatmcenter" role="tab" data-toggle="tab">Cabang Bank</a></li>
                        <li role="presentation"><a href="#atmcenter" aria-controls="atmcenter" role="tab" data-toggle="tab">Cabang ATM Center</a></li>

                      </ul>
                      <br>


                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                    <!-- Tab panes -->
                      <div class="tab-content">
                        
                        <div role="tabpanel" class="tab-pane container-fluid" id="nonatmcenter">
                          <section id="unseen">
                             <h4 class="mb text-primary"><strong> Daftar Cabang Bank </strong> </h4>
                             <div class="row" style="margin-bottom: 20px">
                              <div class="col-md-6">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcabangnon">
                                Tambah Cabang
                              </button>
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addcabangnon_csv">Tambah Cabang (Import)</button>
                            </div>

                              <?php
                              if ($id_user == 970) {
                                ?>
                              <div class="col-md-6 text-right">
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#uploadtemplate_nonatm">Upload Template File</button>
                              </div>
                            <?php } ?>
                            </div>
                            <?php
                            $get = $this->db->query("SELECT * FROM project WHERE visible = 'y' AND type = 'n' AND (channel!='E-Banking' OR channel IS NULL) ORDER BY nama")->result_array(); 
                            ?>
                            <div class="row">
                              <div class="col-md-2"><h4><b>Pilih Project :</b></h4></div>
                              <div class="col-md-3">
                                <select class="form-control" id="project_nonatm">
                                  <option value="">--Pilih Project--</option>
                                  <?php foreach ($get as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                              <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="show_cabang">Show</button>
                              </div>
                              <div class="col-md-5 text-right">
                                <input type="checkbox" name="kota_cabang" value="1" id="kota_cabang" checked="checked" onclick="return false" >
                                <label for="kota_cabang">Kota</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="alamat_cabang" value="1" id="alamat_cabang" checked="checked" onclick="return false" >
                                <label for="alamat_cabang">Alamat</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="transport_cabang" value="1" id="transport_cabang" checked="checked">
                                <label for="transport_cabang">Transport</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="provinsi_cabang" value="1" id="provinsi_cabang">
                                <label for="provinsi_cabang">Provinsi</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="telp_cabang" value="1" id="telp_cabang">
                                <label for="telp_cabang">No Telepon</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="kodepos_cabang" value="1" id="kodepos_cabang">
                                <label for="kodepos_cabang">Kode Pos</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="fax_cabang" value="1" id="fax_cabang">
                                <label for="fax_cabang">Fax</label>
                                <?php if ($id_divisi == 99 OR $id_divisi == 2) {
                                  ?>
                                <input type="checkbox" name="aksi_cabang" value="1" id="aksi_cabang" checked="checked" onclick="return false" style="display: none;">
                                <?php } else { ?>
                                <input type="checkbox" name="aksi_cabang" value="1" id="aksi_cabang" onclick="return false" style="display: none;">
                              <?php } ?>
                              </div>
                            </div>
                            <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">
                            <br>

                            <div id="tabel_cabangnonatm"></div>
                              <!-- <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Project</th>
                                    <th>Kode </th>
                                    <th>Nama </th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Provinsi</th>
                                    <th>Kode Pos</th>
                                    <th>Telepon </th>
                                    <th>FAX</th>
                                    
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $no = 0;?>
                                    <?php foreach($cabang as $db) :?>
                                    <?php if($no%2!=0):?>
                                    <tr>
                                    <?php else :?>
                                    <tr style="background-color : #e2e4ff;">
                                       <?php endif?>
                                          <td><?= ++$no?></td>
                                          <td><?= $db['project']?></td>
                                          <td><?= $db['kode_cabang']?></td>
                                          <td><?= $db['nama_cabang']?></td>
                                          <td><?= $db['alamat']?></td>
                                          <td><?= $db['kota']?></td>
                                          <td><?= $db['provinsi']?></td>
                                          <td><?= $db['kodepos']?></td>
                                           <td><?= $db['notelpon']?></td>
                                           <td><?= $db['fax']?></td> -->
                                          <!-- <td>
                                              <a href="<?= base_url('cabang/ubah/')?><?= $db['num']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>
                                              <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['num']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                                          </td> -->
                                      <!-- </tr>
                                       <?php endforeach?>
                                      
                                    <?//php $no++?>
                                   
                                </tbody>
                              </table> -->
                            </section>
                        </div>

                        <div role="tabpanel" class="tab-pane container-fluid" id="atmcenter">
                       <section id="unseen">
                         <h4 class="mb text-primary"><strong> Daftar Cabang ATM Center </strong> </h4>
                            <div class="row" style=" margin-bottom: 20px">
                              <div class="col-md-6">
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addcabangatm">
                                Tambah Cabang
                              </button>
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addcabangatm_csv">Tambah Cabang (Import)</button>
                              </div>

                              <?php
                              if ($id_user == 970) {
                                ?>
                              <div class="col-md-6 text-right">
                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#uploadtemplate_atm">Upload Template File</button>
                              </div>
                            <?php } ?>
                            </div>
                            <div class="row">
                              <div class="col-md-2"><h4><b>Pilih Project :</b></h4></div>
                              <div class="col-md-3">
                                <select class="form-control" id="project_atmcenter">
                                  <option value="">--Pilih Project--</option>
                                  <?php foreach ($get as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                              <div class="col-md-2">
                                <button type="button" class="btn btn-primary" id="show_atm">Show</button>
                              </div>
                             <!--  <div class="col-md-5">
                                <input type="checkbox" name="kota_atm" value="1" id="kota_atm" checked="checked" onclick="return false" >
                                <label for="kota_cabang">Kota</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="alamat_atm" value="1" id="alamat_atm" checked="checked" onclick="return false" >
                                <label for="alamat_cabang">Alamat</label>&nbsp;
                                <span> | </span>&nbsp;
                                <input type="checkbox" name="transport_atm" value="1" id="transport_atm" checked="checked">
                                <label for="transport_cabang">Transport</label>&nbsp;
                                <span> | </span>&nbsp;

                               
                                
                              </div> -->
                              <?php if ($id_divisi == 99 OR $id_divisi == 2) {
                                  ?>
                                <input type="checkbox" name="aksi_atm" value="1" id="aksi_atm" checked="checked" onclick="return false" style="display: none;">
                                <?php } else { ?>
                                <input type="checkbox" name="aksi_atm" value="1" id="aksi_atm" onclick="return false" style="display: none;">
                              <?php } ?>
                            </div>
                            <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">
                            <br>

                            <div id="tabel_cabangatmcenter"></div>
<!-- 
                              <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-2">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Project</th>
                                    <th>Kode </th>
                                    <th>Nama </th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                  
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $no = 0;?>
                                    <?php foreach($atmcenter as $db) :?>
                                    <?php if($no%2!=0):?>
                                    <tr>
                                    <?php else :?>
                                    <tr style="background-color : #e2e4ff;">
                                       <?php endif?>
                                          <td><?= ++$no?></td>
                                          <td><?= $db['project']?></td>
                                          <td><?= $db['kode_cabang']?></td>
                                          <td><?= $db['namacabang']?></td>
                                          <td><?= $db['alamat']?></td>
                                          <td><?= $db['kota']?></td>
                                       -->    
                                          <!-- <td>
                                              <a href="<?= base_url('cabang/ubah/')?><?= $db['num']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Edit</a>
                                              <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['num']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                                          </td> -->
                                      <!-- </tr>
                                      <?php endforeach?>

                                </tbody>
                              </table> -->
                            </section>
                      </div>


                      </div>

                



                </div>
            </div>
          </div>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

    <!-- MODAL ADD CABANG NON ATM CENTER -->
                                      <div class="modal fade" id="addcabangnon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Cabang Bank</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <?php 
                                            $project = $this->db->query("SELECT * FROM project where visible='y' AND type='n' AND (channel!='E-Banking' OR channel IS NULL) ORDER BY nama")->result_array();
                                             ?>
                                            <div class="modal-body">
                                              <form method="POST" action="<?php echo base_url('cabang/tambah_cabang') ?>">
                                              <div class="form-group">
                                                <label >Project</label>
                                                 <select class="form-control form-control-user" name="project" id="kode_pjk">
                                                    <option value="" selected="">--Pilih Project--</option>
                                                    <?php foreach ($project as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?>
                                                  </select>
                                              </div>

                                              <?php 
                                            $bank = $this->db->query("SELECT * FROM bank")->result_array();
                                             ?>
                                            
                                              <div class="form-group">
                                                <label >Bank</label>
                                                 <select class="form-control form-control-user" name="bank" id="bank">
                                                    <option value="" selected="">--Pilih Bank--</option>
                                                    <?php foreach ($bank as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?>
                                                  </select>
                                              </div>
                                              <div class="form-group">
                                                <label>Kode</label>
                                                <input type="text" name="kode" class="form-control" required minlength="3" maxlength="3" onkeypress="return hanyaAngka(event)">
                                              </div>
                                              <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat" class="form-control"></textarea>
                                              </div>
                                              <div class="form-group">
                                                <label>Kota</label>
                                                <input type="text" name="kota" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Provinsi</label>
                                                <input type="text" name="provinsi" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Kode Pos</label>
                                                <input type="text" name="kodepos" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>No Telepon</label>
                                                <input type="text" name="notelpon" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Fax</label>
                                                <input type="text" name="fax" class="form-control">
                                              </div>
                                              <!-- <div class="form-group">
                                                <label>Kode Bank</label>
                                                <input type="text" name="kodebank" class="form-control" id="kd_bank" readonly>
                                              </div> -->
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- AKHIR MODAL ADD CABANG NON ATM CENTER -->


                                      <!-- MODAL ADD CABANG NON ATM CENTER (CSV) -->
                                      <div class="modal fade" id="addcabangnon_csv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Cabang Bank Via Import</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <?php 
                                            $project = $this->db->query("SELECT * FROM project where visible='y' AND type='n' AND (channel!='E-Banking' OR channel IS NULL) ORDER BY nama")->result_array();
                                            $format = $this->db->query("SELECT * FROM format_file where jenis='Cabang Bank' ORDER BY id DESC")->row_array();
                                             ?>
                                            <div class="modal-body">
                                              <form action="<?php echo base_url('cabang/tambah_cabang_csv') ?>" method="POST" enctype="multipart/form-data">
                                                <div class="form-group">
                                                <label >Project</label>
                                                 <select class="form-control form-control-user" name="project" id="kode_pjk_xls1">
                                                    <option value="" selected="">--Pilih Project--</option>
                                                    <?php foreach ($project as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?>
                                                  </select>
                                              </div>
                                              <div id="disini_uploadbank"></div>
                                              <!-- <div class="form-group">
                                                <label>Upload File</label>
                                                <input type="file" name="csv_cabang" class="form-control" required accept=".xls, .xlsx">
                                                <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Upload(.xls/.xlsx)
                                              </div> -->
                                              <div id="formatbank" style="display: none;">
                                                <p>Contoh format file excel untuk import cabang
                                                <?php if ($format['nama_file'] != NULL) {
                                    
                                                echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/cabang/" . $format['nama_file'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i> View</a>";
                                                    } else {
                                                        echo "";
                                                    } ?>
                                                  </p>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- AKHIR MODAL ADD CABANG NON ATM CENTER (CSV) -->




                                      <!-- MODAL ADD CABANG NON ATM CENTER -->
                                      <div class="modal fade" id="addcabangatm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Cabang ATM Center</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <?php 
                                            $project = $this->db->query("SELECT * FROM project where visible='y' AND type='n' AND (channel!='E-Banking' OR channel IS NULL) ORDER BY nama")->result_array();
                                             ?>
                                            <div class="modal-body">
                                              <form method="POST" action="<?php echo base_url('cabang/tambah_atmcenter') ?>">
                                              <div class="form-group">
                                                <label >Project</label>
                                                 <select class="form-control form-control-user" name="project" id="kode_pjk">
                                                    <option value="" selected="">--Pilih Project--</option>
                                                    <?php foreach ($project as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?>
                                                  </select>
                                              </div>
                                              <div class="form-group">
                                                <label>Kode</label>
                                                <input type="text" name="kode" class="form-control" required minlength="3" maxlength="3" onkeypress="return hanyaAngka(event)">
                                              </div>
                                              <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat" class="form-control"></textarea>
                                              </div>
                                              <div class="form-group">
                                                <label>Kota</label>
                                                <input type="text" name="kota" class="form-control">
                                              </div>
                                              <!-- <div class="form-group">
                                                <label>Kode Bank</label>
                                                <input type="text" name="kodebank" class="form-control" id="kd_bank" readonly>
                                              </div> -->
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- AKHIR MODAL ADD CABANG NON ATM CENTER -->
                                    <?//php $no++?>
                                    

                                    <!-- MODAL ADD CABANG ATM CENTER (CSV) -->
                                      <div class="modal fade" id="addcabangatm_csv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Cabang ATM Center Via Import</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <?php 
                                            $project = $this->db->query("SELECT * FROM project where visible='y' AND type='n' AND (channel!='E-Banking' OR channel IS NULL) ORDER BY nama")->result_array();
                                             $format = $this->db->query("SELECT * FROM format_file where jenis='Cabang ATM Center' ORDER BY id DESC")->row_array();
                                             ?>
                                            <div class="modal-body">
                                              <form method="POST" action="<?php echo base_url('cabang/tambah_atmcenter_csv') ?>" enctype="multipart/form-data">
                                                 <div class="form-group">
                                                <label >Project</label>
                                                 <select class="form-control form-control-user" name="project" id="kode_pjk_xls2">
                                                    <option value="" selected="">--Pilih Project--</option>
                                                    <?php foreach ($project as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?>
                                                  </select>
                                              </div>
                                              <div id="disini_uploadatm"></div>
                                              <!-- <div class="form-group">
                                                <label>Upload File</label>
                                                <input type="file" name="csv_atm" class="form-control" accept=".xls, .xlsx" required>
                                                <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Upload(.xls/.xlsx)
                                              </div> -->
                                              <div id="formatatm" style="display: none;">
                                                <p>Contoh format file excel untuk import cabang
                                                <?php if ($format['nama_file'] != NULL) {
                                    
                                                echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/cabang/" . $format['nama_file'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i> View</a>";
                                                    } else {
                                                        echo "";
                                                    } ?>
                                                  </p>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Import</button>
                                            </div>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- AKHIR MODAL ADD CABANG ATM CENTER (CSV) -->





                                      <!-- MODAL UPLOAD NON ATM CENTER  -->
                                      <div class="modal fade" id="uploadtemplate_nonatm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Upload Template File Import Cabang Bank</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                              <form method="POST" action="<?php echo base_url('cabang/uploadtemplate_nonatm') ?>" enctype="multipart/form-data">
                                              <div class="form-group">
                                                <label>Jenis File</label>
                                                <input type="text" name="jenis" class="form-control" value="Cabang Bank" readonly>
                                              </div>
                                              <div class="form-group">
                                          
                                                <label>Upload File</label>
                                                <input type="file" name="file_nonatm" class="form-control" accept=".xls, .xlsx" required>
                                                <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Upload(.xls/.xlsx)
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- AKHIR  MODAL UPLOAD NON ATM CENTER -->


                                      <!-- MODAL UPLOAD ATM CENTER  -->
                                      <div class="modal fade" id="uploadtemplate_atm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Upload Template File Import Cabang Non ATM Center</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                              <form method="POST" action="<?php echo base_url('cabang/uploadtemplate_atm') ?>" enctype="multipart/form-data">
                                              <div class="form-group">
                                                <label>Jenis File</label>
                                                <input type="text" name="jenis" class="form-control" value="Cabang ATM Center" readonly>
                                              </div>
                                              <div class="form-group">
                                          
                                                <label>Upload File</label>
                                                <input type="file" name="file_atm" class="form-control" accept=".xls, .xlsx" required>
                                                <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Upload(.xls/.xlsx)
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Upload</button>
                                            </div>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- AKHIR  MODAL UPLOAD ATM CENTER -->
    <!-- /MAIN CONTENT -->


    <!-- MODAL ADD CABANG NON ATM CENTER -->
                                      <div class="modal fade" id="editcabangnon" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Cabang Bank</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                              <form method="POST" action="<?php echo base_url('cabang/edit_cabang') ?>">
                                                <input type="hidden" name="num" id="edit_num" class="form-control" readonly>
                                              <div class="form-group">
                                                <label >Project</label>
                                                <input type="text" class="form-control" name="project" id="edit_project" readonly>
<!--                                                  <select class="form-control form-control-user" name="project" id="kode_pjk">
                                                    <option value="" selected="">--Pilih Project--</option>
                                                    <?php foreach ($project as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?>
                                                  </select>
 -->                                              </div>

                                              <?php 
                                            $bank = $this->db->query("SELECT * FROM bank")->result_array();
                                             ?>
                                             <?php foreach ($bank as $bk) : ?>
                                                <input type="hidden" name="bank_id" value="<?= $bk['kode'] ?>**<?= $bk['nama'] ?>">
                                              <?php endforeach ?>
                                            
                                              <div class="form-group">
                                                <label >Bank</label>
                                                <!-- <input type="text" class="form-control" name="bank" id="edit_bank" readonly> -->

                                                 <select class="form-control form-control-user" name="kodebank" id="bank_kd">
                                                    <option value="">--Pilih Bank--</option>
                                                    <!-- <?php foreach ($bank as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?> -->
                                                  </select>

                                            </div>
                                              <div class="form-group">
                                                <label>Kode</label>
                                                <input type="text" name="kode" id="edit_kode" class="form-control" required minlength="3" maxlength="3" onkeypress="return hanyaAngka(event)">
                                              </div>
                                              <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama" id="edit_nama" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat" id="edit_alamat" class="form-control"></textarea>
                                              </div>
                                              <div class="form-group">
                                                <label>Kota</label>
                                                <input type="text" name="kota" id="edit_kota" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Provinsi</label>
                                                <input type="text" name="provinsi" id="edit_provinsi" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Kode Pos</label>
                                                <input type="text" name="kodepos" id="edit_kodepos" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>No Telepon</label>
                                                <input type="text" name="notelpon" id="edit_notelpon" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Fax</label>
                                                <input type="text" name="fax" id="edit_fax" class="form-control">
                                              </div>
                                              <!-- <div class="form-group">
                                                <label>Kode Bank</label>
                                                <input type="text" name="kodebank" class="form-control" id="kd_bank" readonly>
                                              </div> -->
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- AKHIR MODAL ADD CABANG NON ATM CENTER -->


    <!-- MODAL ADD CABANG ATM CENTER -->
                                      <div class="modal fade" id="editcabangatm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Edit Cabang ATM Center</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                              <form method="POST" action="<?php echo base_url('cabang/edit_cabangatm') ?>">
                                                <input type="hidden" name="num" id="edit_num_atm" class="form-control" readonly>
                                              <div class="form-group">
                                                <label >Project</label>
                                                <input type="text" class="form-control" name="project" id="edit_project_atm" readonly>
<!--                                                  <select class="form-control form-control-user" name="project" id="kode_pjk">
                                                    <option value="" selected="">--Pilih Project--</option>
                                                    <?php foreach ($project as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?>
                                                  </select>
 -->                                              </div>

                                              <?php 
                                            $bank = $this->db->query("SELECT * FROM bank")->result_array();
                                             ?>
                                             <?php foreach ($bank as $bk) : ?>
                                                <input type="hidden" name="bank_id" value="<?= $bk['kode'] ?>**<?= $bk['nama'] ?>">
                                              <?php endforeach ?>
                                            
                                              <div class="form-group">
                                                <label >Bank</label>
                                                <!-- <input type="text" class="form-control" name="bank" id="edit_bank" readonly> -->

                                                 <select class="form-control form-control-user" name="kodebank" id="bank_kd_atm">
                                                    <option value="">--Pilih Bank--</option>
                                                    <!-- <?php foreach ($bank as $row) {
                                                      ?>
                                                      <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
                                                      <?php
                                                    } ?> -->
                                                  </select>

                                            </div>
                                              <div class="form-group">
                                                <label>Kode</label>
                                                <input type="text" name="kode" id="edit_kode_atm" class="form-control" required minlength="3" maxlength="3" onkeypress="return hanyaAngka(event)">
                                              </div>
                                              <div class="form-group">
                                                <label>Nama</label>
                                                <input type="text" name="nama" id="edit_nama_atm" class="form-control">
                                              </div>
                                              <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamat" id="edit_alamat_atm" class="form-control"></textarea>
                                              </div>
                                              <div class="form-group">
                                                <label>Kota</label>
                                                <input type="text" name="kota" id="edit_kota_atm" class="form-control">
                                              </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                          </form>
                                          </div>
                                        </div>
                                      </div>
                                      <!-- AKHIR MODAL ADD CABANG ATM CENTER -->
    <!--main content end -->
<script>
    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
