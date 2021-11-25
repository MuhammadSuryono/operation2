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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Kota Kabupaten </strong> </h4>

                    <?php
                    if ($this->session->userdata('id_user') == '973'){
                    ?>
                    <a href="" class="btn btn-round btn-primary mb" data-target="#exampleModal" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>
                    <br/><br/>
                    <?php
                    }else{
                    echo "";
                    }
                    ?>
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                <section id="unseen">
                <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed" id="dataTables-example">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Provinsi</th>
                          <th>Kota / Kabupaten</th>
                          <th>Jenis Kota</th>
                          <th>Inisial</th>
                          <th>Pulau</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                         $no = 1;
                         foreach ($getallkotakab as $data) :
                      ?>
                      <tr>
                          <td><b><?php echo $no ?></b></td>
                          <td><?php echo $data['provinsi'] ?></td>
                          <td><?php echo $data['kabupatenkota'] ?></td>
                          <td><?php echo $data['jeniskota'] ?></td>
                          <td><?php echo $data['inisial'] ?></td>
                          <td><?php echo $data['pulau'] ?></td>
                          <td>
                            <?php
                            if ($this->session->userdata('id_user') == '973'){
                            ?>
                            <a href="javascript:;" data-toggle="modal" data-target="#editkotakab" data-nonya="<?php echo $data['no']; ?>"
                               data-provinsi="<?php echo $data['provinsi'] ?>" data-kabkot="<?php echo $data['kabupatenkota'] ?>"
                               data-jns="<?php echo $data['jeniskota'] ?>" data-ins="<?php echo $data['inisial'] ?>" data-pulau="<?php echo $data['pulau']?>"
                               class="btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <?php
                            }else{
                            echo "";
                            }
                            ?>                                                    
                          </td>
                      </tr>
                      <?php
                         $no++;
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Input Data Matrix Perdin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <form method="POST" action="<?php echo base_url('stkb/tambahkotakab') ?>">

                    <div class="form-group">
                      <label>Provinsi</label>
                        <input type="text" name="provinsi" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Kota / Kabupaten</label>
                        <input type="text" name="kabupatenkota" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Jenis Kota</label>
                        <select name="jeniskota" class="form-control" required>
                          <option value="">Pilih Jenis Kota</option>
                          <option value="KOTA 1">KOTA 1</option>
                          <option value="KOTA 2">KOTA 2</option>
                          <option value="KOTA 3">KOTA 3</option>
                          <option value="KOTA 4">KOTA 4</option>
                          <option value="KOTA 5">KOTA 5</option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label>Inisial :</label>
                        <input type="text" name="inisial" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Pulau :</label>
                        <input type="text" name="pulau" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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

    <div class="modal fade" id="editkotakab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Kota Kabupaten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url('stkb/editkotakabupaten') ?>">

                        <input type="hidden" name="nonya" id="nonya">

                        <div class="form-group">
                          <label>Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                        </div>

                        <div class="form-group">
                          <label>Kota / Kabupaten</label>
                            <input type="text" id="kabkot" name="kabupatenkota" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                        </div>

                        <div class="form-group">
                          <label>Jenis Kota</label>
                            <select name="jeniskota" class="form-control" id="jns" required>
                              <option value="">Pilih Jenis Kota</option>
                              <option value="KOTA 1">KOTA 1</option>
                              <option value="KOTA 2">KOTA 2</option>
                              <option value="KOTA 3">KOTA 3</option>
                              <option value="KOTA 4">KOTA 4</option>
                              <option value="KOTA 5">KOTA 5</option>
                            </select>
                        </div>

                        <div class="form-group">
                          <label>Inisial :</label>
                            <input type="text" id="ins" name="inisial" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                        </div>

                        <div class="form-group">
                          <label>Pulau :</label>
                            <input type="text" id="pulau" name="pulau" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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
