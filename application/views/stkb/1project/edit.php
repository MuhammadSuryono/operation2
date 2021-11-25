<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> STKB</h3>
    <div class="row mt">
      <div class="col-lg-12">

      <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

      <div class="row">
        <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong><a href="<?php echo base_url('stkb/oneproject') ?>">1 - Project</a> <i class="fa fa-angle-right"></i> Form Edit Skenario 1-Project </strong></h4>

                <center><h3><?php echo $kode['kode'] ?> - <?php echo $kode['nama'] ?> - <?php echo $kode['nama_bank'] ?><h3></center>

                <a class="btn btn-round btn-primary mb" href="" data-toggle="modal" data-target="#exampleModal" data-pro="<?php echo $kode['kode'] ?>">
                  <span class="fa fa-plus fa-fw"></span> Tambah </a>
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Trk</th>
                      <th>Biaya</th>

                      <th>Jumlah</th>
                      <th>Skenario</th>
                      <th>Total</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $i = 1;
                      foreach ($id as $db){
                        $harga = $this->db->get_where('stkb_dasar_trk', array('kodebank' => $kode['bank'], 'kodeskenario' => $db['nomor']))->row_array();
                        $total = $harga['harga']*$db['jml'];
                      ?>
                      <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $db['sken']; ?>. <?php echo $db['namanya'] ?></td>
                        <td><?php echo 'Rp. ' . number_format($harga['harga'], 0, '', ','); ?></td>
                        <td><?php echo $db['jml'] ?></td>
                        <td><?php echo $db['namakunj'] ?></td>
                        <td><?php echo 'Rp. ' . number_format($total, 0, '', ','); ?></td>


                        <td>
                          <center>
                              <a href="javascript:;" data-toggle="modal" data-target="#edit-skenproject" data-pro="<?php echo $db['kopro'] ?>"
                                data-sken="<?php echo $db['namanya'] ?>" data-juml="<?php echo $db['jml'] ?>" data-nosken="<?php echo $db['nmr']?>"
                                data-kunj="<?php echo $db['kunjungan'] ?>" class="btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>
                              <a href="<?php echo base_url(); ?>stkb/hapus_oneproject/<?php echo $db['nmr'] ?>/<?php echo $db['kopro'] ?> " class="btn-danger btn-sm tombol-hapus"><i class="fa fa-trash"></i> Delete</a>
                          </center>
                        </td>
                      </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                </table>
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

<div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Add skenario </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?php echo base_url('stkb/tambah_oneproject') ?>">

                  <input type="hidden" name="kodeproject" value="<?php echo $kode['kode'] ?>">

                  <div class="form-group">
                    <label>Skenario</label>
                      <select id="sken" name="skenario" class="form-control form-control-user" aria-describedby="emailHelp">
                        <?php
                         foreach ($sken as $skn) {
                        ?>
                          <option value="<?php echo $skn['no'] ?>"><?php echo $skn['no'].". ".$skn['nama'] ?></option>
                        <?php
                         }
                         ?>
                      <select>
                  </div>

                  <div class="form-group">
                    <label>Jumlah</label>
                      <input type="number" id="jumlah" name="jumlah" class="form-control form-control-user" min="0" aria-describedby="emailHelp" placeholder="">
                  </div>

                  <div class="form-group">
                    <label>Kunjungan :</label>
                      <select class="form-control" name="kunjungan">
                        <option>Pilih Kunjungan</option>
                        <?php
                        foreach ($kunjungangede as $kg) {
                        ?>
                        <option value="<?php echo $kg['kategori']?>"><?php echo $kg['namakunj']?></option>
                        <?php
                        }
                        ?>

                        <option id="kunj"></option>
                      </select>
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

<div class="modal" id="edit-skenproject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-skenprojectLabel">Form Edit Skenario 1-Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('stkb/proses_editoneproject') ?>">

                    <input type="hidden" name="project" id="pro">
                    <input type="hidden" name="no" id="nosken">

                    <div class="form-group">
                      <label>Nama TRK :</label>
                        <input type="text" id="sken" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                      <label>Jumlah :</label>
                        <input type="number" id="juml" name="jumlah" min="0" class="form-control">
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
