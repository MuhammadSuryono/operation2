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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Matrix Perdin </strong> </h4>
                     <?php if ($user['id_divisi'] == 99) : ?>
                    <a href="" class="btn btn-round btn-primary mb" data-target="#exampleModal" data-toggle="modal"><span class="fa fa-plus fa-fw"></span> Tambah </a>
                  <?php endif; ?>

                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                <section id="unseen">
                <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                      <tr bgcolor="#F0FFF0">
                          <th><center>No</center></th>
                          <th><center>Kota Asal</center></th>
                          <th><center>Kota Tujuan</center></th>
                          <th><center>Jenis</center></th>
                          <th><center>Transport Perjalanan Dinas <br>Dari Rumah - Kota Dinas - Rumah</center></th>
                          <th><center>Memo</center></th>
                          <th><center>Aksi</center></th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                         $no = 1;
                         foreach ($stkbperdin as $data) :
                           $nomornya      = $data['no'];
                           $rpmatrixhonor = $data['matrixhonor'];
                             ?>
                      <tr>
                          <td><b><?php echo $no ?></b></td>
                          <td><?php echo $data['kotaasal'] ?></td>
                          <td><?php echo $data['kotatujuan'] ?></td>
                          <td><?php echo $data['jenis'] ?></td>
                          <td><?php echo 'Rp. ' . number_format( $rpmatrixhonor, 0 , '' , ',' ); ?></td>
                          <td>
                            <center><?php if ($data['memo'] != NULL) {                            
                                    echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/memo/" . $data['memo'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i> View</a>";
                                } else {
                                    echo "";
                                } ?>
                            </center>
                          </td>
                          <td>
                              <center>
                                 <?php if ($user['id_divisi'] == 99) : ?>
                                  <a href="javascript:;" data-toggle="modal" data-target="#edit-matrixperdin" data-id="<?php echo $nomornya; ?>" data-ka="<?php echo $data['kotaasal'] ?>"
                                                                             data-kt="<?php echo $data['kotatujuan'] ?>" data-j="<?php echo $data['jenis'] ?>" data-mh="<?php echo $data['matrixhonor'] ?>" class="btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                  <a href="<?php echo base_url(); ?>stkb/hapus_matrixperdin/<?php echo $nomornya; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                                <?php endif; ?>
                              </center>
                          </td>
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
                  <form method="POST" action="<?php echo base_url('stkb/tambah_matrixperdin') ?>" enctype="multipart/form-data">

                      <div class="form-group">
                        <label>Kota Asal</label>
                          <input type="text" id="ka" name="kotaasal" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" required>
                      </div>

                      <div class="form-group">
                        <label>Kota Tujuan</label>
                          <input type="text" id="kt" name="kotatujuan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" required>
                      </div>

                      <div class="form-group">
                        <label>Jenis</label>
                          <select id="j" name="jenis" class="form-control form-control-user">
                            <option value=""></option>
                          <select>
                      </div>

                      <div class="form-group">
                        <label>Transport Perjalanan Dinas</label>
                          <input type="number" id="mh" name="matrixhonor" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="" required>
                      </div>

                      <div class="form-group">
                          <label>Upload Memo</label>
                          <input type="file" name="memo_perdin" accept="application/pdf" class="form-control" required>
                          <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Memo(.pdf)
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

    <div class="modal fade" id="edit-matrixperdin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Matrix Perdin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url('stkb/edit_matrixperdin') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="no" id="no">

                        <div class="form-group">
                          <label>Kota Asal</label>
                            <input type="text" id="ka" name="kotaasal" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                        </div>

                        <div class="form-group">
                          <label>Kota Tujuan</label>
                            <input type="text" id="kt" name="kotatujuan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                        </div>

                        <div class="form-group">
                          <label>Jenis</label>
                            <select name="jenis" class="form-control" id="j">
                              <option value=""></option>
                            </select>
                        </div>

                        <div class="form-group">
                          <label>Transport Perjalanan Dinas</label>
                            <input type="number" id="mh" name="matrixhonor" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                        </div>

                        <div class="form-group">
                          <label>Upload Memo</label>
                          <input type="file" name="memo_perdin" accept="application/pdf" class="form-control" required>
                          <span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Memo(.pdf)
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
