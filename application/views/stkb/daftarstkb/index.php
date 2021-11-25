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
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Pilih Project </strong> </h4>
                    
                <div class="row">
                  <form action="" method="POST">
                  <div class="col-sm-4">

                  <select class="selectpicker form-control" name="project" data-live-search="true">
                    <option value="">--Pilih Project--</option>
                    <?php foreach ($getproject as $pro) {
                      ?>
                      <option value="<?= $pro['kode'] ?>"><?= $pro['nama'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-1">
                  <button type="submit" name="cari_stkb" class="btn btn-primary"><i class="far fa-eye"></i> Cari</button>
                </div>
                  </form>
                </div>
                    
            </div>
          </div>
        </div>

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Daftar STKB </strong> </h4>
                    
                    

                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                <?php if (isset($_POST['cari_stkb'])) {
                    $kode_pro = $_POST['project'];

                    $getalldaftarstkb = $this->db->query("SELECT a . * , b.nama AS nama_project, c.nama AS nama_kareg, h.nama AS nama_spv, z.spv, z.area_head
                            FROM stkb_ops a
                            LEFT JOIN project b ON a.project = b.kode
                            LEFT JOIN plan z ON a.nomorstkb = z.nomorstkb
                            LEFT JOIN id_data c ON a.kode_iddata = c.Id
                            LEFT JOIN id_data h ON z.spv = h.Id OR z.area_head = h.Id
                            WHERE b.kode = '$kode_pro' 
                            GROUP BY a.nomorstkb
                            ORDER by a.nomorstkb")->result_array();

                 ?>
                <section id="unseen">
                <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                      <tr bgcolor="#F0FFF0">
                          <th>No</th>
                          <th>Nomor STKB</th>
                          <th>Project</th>
                          <th>Kareg</th>
                          <th>SPV</th>
                          <th>Daerah Asal</th>
                          <th>Kota Dinas</th>
                          <th>Penugasan</th>
                          <th>Tanggal Mulai</th>
                          <th>Tanggal Selesai</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($getalldaftarstkb as $row) :
                      $cekPembayaran = $this->db->query("SELECT nomorstkb FROM stkb_pembayaran WHERE nomorstkb = '$row[nomorstkb]'")->num_rows();
                            if($cekPembayaran >= 1){
                              continue;
                            }
                     ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row['nomorstkb']; ?></td>
                        <td><?php echo $row['project']." - ".$row['nama_project']; ?></td>
                        <td><?php echo $row['kode_iddata']." - ".$row['nama_kareg']; ?></td>
                        <?php if ($row['spv'] != NULL OR $row['spv'] != '') {
                          ?>
                        <td><?php echo $row['spv']." - ".$row['nama_spv']; ?></td>
                      <?php } else { ?>
                        <td><?php echo $row['area_head']." - ".$row['nama_spv']; ?></td>
                      <?php } ?>
                        <td><?php echo $row['daerahasal']; ?></td>
                        <td><?php echo $row['kotadinas']; ?></td>
                        <td><?php echo $row['penugasan']; ?></td>
                        <td><?php echo $row['tglmulai']; ?></td>
                        <td><?php echo $row['tglselesai']; ?></td>
                        <td>
                          <?php if ($user['id_divisi'] == 99) : ?>
                          <a href="<?php echo base_url(); ?>stkb/hapus_daftarstkb/<?php echo $row['nomorstkb']; ?> " class="btn-danger btn-sm tombol-hapus" title="Delete"><i class="fa fa-trash"></i> </a>
                        <?php endif; ?>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              </section>
            <?php } ?>

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


