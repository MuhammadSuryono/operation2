<?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
  $email_user = $user['email'];
  $id_u = $user['noid'];
  $table = "user";
  $kolom = "email";
  $where_col = "noid";
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
  $email_user = $user['Email'];
  $id_u = $user['Id'];
  $table = "id_data";
  $kolom = "Email";
  $where_col = "Id";
}

$plan = $this->db->query("SELECT a.*, b.name FROM plan a JOIN user b ON a.area_head=b.noid WHERE a.project='$quest[project]' AND a.nomorstkb='$quest[nomorstkb]'")->row_array();

$pwt = $this->db->get_where('id_data', array('Id' => $quest['pwt']))->row_array();
$shp = $this->db->get_where('id_data', array('Id' => $quest['shp']))->row_array(); 

?>
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> Form Pengajuan Keterlambatan </h3>
    <div class="row mt">
      <div class="col-lg-12">


        <div class="row mt">

          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="form-panel">
              <h2 class="mb text-center"> <strong>  BERITA ACARA KETERLAMBATAN PENGIRIMAN DATA </strong></h2>

              <div class="col-lg-12">
                <?= $this->session->flashdata('info'); ?>
              </div>

              <section id="unseen" style="margin-top: 80px;">
                <form action="<?= base_url('aktual/input_keterlambatan') ?>" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="num" value="<?= $quest['num'] ?>">
                  <input type="hidden" name="project" value="<?= $quest['project'] ?>">
                  <input type="hidden" name="cabang" value="<?= $quest['cabang'] ?>">
                  <input type="hidden" name="kunjungan" value="<?= $quest['kunjungan'] ?>">
                  <input type="hidden" name="r_kategori" value="<?= $quest['r_kategori'] ?>">
                  <input type="hidden" name="pemohon" value="<?= $this->session->userdata('id_user') ?>">
                  <input type="hidden" name="pj_field" value="<?= $plan['area_head'] ?>">
                  <?php if ($quest['pwt'] != NULL) {
                   ?>
                  <input type="hidden" name="pwt" value="<?= $quest['pwt'] ?>">
                <?php } else { ?>
                  <input type="hidden" name="pwt" value="<?= $quest['shp'] ?>">
                <?php } ?>



                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="nama_ra" ><strong>Kepada - RA Project</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7">
                      <select class="form-control selectpicker" data-live-search="true" name="ra_project" required>
                        <option value="">Pilih Nama RA Project</option>
                        <?php foreach ($ra as $row) {
                         ?>
                        <option value="<?= $row['noid'] ?>"><?= $row['name'] ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Tembusan</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7">  1. Kadiv.Research Business 1<br> 2. Pimpinan Field Operation B1</div>
                  </div>
                </div>
                <br><br>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12 font-weight-bold"><strong>Dengan ini mengajukan Permohonan  Keterlambatan Pengiriman Data Kunjungan :</strong></div>
                  </div>
                </div>
                  <div class="form-group" style="margin-top: 10px;">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3"><label for="tembusan" ><strong>Job</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7">   <input type="text" class="form-control" id="project" value="<?= $project['nama'] ?>" readonly></div>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 10px;">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3"><label for="tembusan" ><strong>Kunjungan</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7">   <input type="text" class="form-control" id="kunjungan" value="<?= $kunjungan['nama'] ?>" readonly></div>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 10px;">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3"><label for="tembusan" ><strong>Cabang</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7">   <input type="text" class="form-control" id="kunjungan" value="<?= $cabang['nama'] ?>" readonly></div>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 10px;">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3"><label for="tembusan" ><strong>Tanggal Kunjungan</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7">   <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $quest['tanggal'] ?>" readonly></div>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 10px;">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3"><label for="tembusan" ><strong>Pewitness</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <?php if ($quest['pwt'] != NULL) {
                   ?>
                    <div class="col-sm-8 col-xs-7">   <input type="text" class="form-control" value="<?= $quest['pwt']." - ".$pwt['Nama'] ?>"></div>
                    <?php } else { ?>
                    <div class="col-sm-8 col-xs-7">   <input type="text" class="form-control" value="<?= $quest['shp']." - ".$shp['Nama'] ?>"></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group" style="margin-top: 10px;">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3"><label for="tembusan" ><strong>Telat Kirim Data Karena</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7"> <textarea class="form-control" name="alasan" id="alasan" rows="5"></textarea>  </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12 font-weight-bold"><strong>Catatan :
                          <br>1.  Formulir Berita Acara harus di kumpulkan paling lambat : <span style="font-weight: bold; color: red; font-style: italic;">HARI H+1 Kunjungan, JAM 12.00.</span> Jika melanggar dari hal-hal tersebut di atas, secara otomatis system akan menolak, dan data dinyatakan <strong class="font-italic">DO</strong>
                            <br>2.  Untuk yang <strong>Bertugas Penerima Tugas Perjalanan Dinas</strong>, maka wajib bertanggung jawab atas data yang di DO, dan WAJIB mengatur kunjungan ulang lagi, dan jumlah hari penugasan, tidak akan ditambahkan, apabila terjadi <b>DO.</b>

                          <br><br>Demikian berita acara ini saya buat dengan sebenar benarnya beserta bukti terlampir, atas perhatian dan kerjasamanya saya ucapkan terimakasih .
                          </strong></div>
                  </div>
                </div>
                <br>

                <div class="form-group" style="margin-top: 10px;">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3"><label for="tembusan" ><strong>Upload Evidence</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7">   <input type="file" class="form-control" id="evidence" name="evidence" accept="image/*">
                      <small class="form-text text-muted"><b class="text-warning">NOTE!</b></span>&nbsp;&nbsp;File upload berupa image (JPG/JPEG/PNG) dengan ukuran maksimal 50KB!</small>
                      
                    </div>
                  </div>
                </div>
                <br><br>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12 font-weight-bold"><strong>Jakarta, <?= date('d-m-Y'); ?></strong></div>
                  </div>
                </div>
                <br><br>

                <div class="form-group">
                  <div class="row text-center">
                    <div class="col-sm-6 col-xs-6"><strong>Pemohon, </strong><br><br><br><br><br>
                      <span style="margin-top: 100px;"><?= $nama ?></span></div>
                    <div class="col-sm-6 col-xs-6"><strong>Diketahui Oleh, </strong><br><br><br><br><br>
                      <span style="margin-top: 100px;"><?= $plan['name'] ?></span></div>

                  </div>
                </div>
                <br><br>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-12 text-right">
                      <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                  </div>
                </div>


                
                </div>

              </form>
              </section>
            </div>
          </div>
          <div class="col-lg-2"></div>

        </div>


      </div>
    </div>
  </section>
  <!-- /wrapper -->
</section>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
$(function () {
  $('[data-toggle="popover"]').popover()
});

  var uploadField = document.getElementById("evidence");
uploadField.onchange = function() {
    if(this.files[0].size > 50000){ // ini untuk ukuran 800KB, 1000000 untuk 1 MB.
       alert("Maaf. File Terlalu Besar ! Maksimal Upload 50 KB");
       this.value = "";
    };
};

</script>

