<style>
    .borderless td,
    .borderless th {
        border: none !important;
    }  
</style>
<style type="text/css" media="print">
  table td,
    table th {
        border: none !important;
    }
</style>
<?php
$id_user = $this->session->userdata('id_user');
?>

<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> Pengajuan Berita Acara Keterlambatan</h3>
    <div class="row mt">
      <div class="col-lg-12">


        <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Kunjungan </strong></h4>
              <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#need" aria-controls="need" role="tab" data-toggle="tab">Daftar Kunjungan</a></li>
                        <li role="presentation"><a href="#done" aria-controls="done" role="tab" data-toggle="tab">Pengajuan</a></li>

              </ul>

              <div class="col-lg-12">
                <?= $this->session->flashdata('info'); ?>
                 <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                 <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

              </div>

              <div class="tab-content">
                        
              <div role="tabpanel" class="tab-pane container-fluid active" id="need">
              <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Nama Project<center></th>
                      <th><center>Nama Cabang<center></th>
                      <th><center>Kode Kunjungan<center></th>
                      <!-- <th><center>Skenario<center></th> -->
                      <th><center>Tanggal Kunjungan<center></th>

                      <!-- <th>Kode Token</th> -->
                      <!-- <th><center>Aksi<center></th> -->
                      <th><center>Form Keterlambatan<center></th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id_user = $this->session->userdata('id_user');
                    $no = 1;
                    $atmcenter = array('064','065','066','067');
                    foreach ($aktual as $db) :?>
                        <tr>
                          <td class="text-center" style="vertical-align:middle"><?= $no++; ?></td>
                          <td class="text-left" style="vertical-align:middle"><?= $db['nama_project'] ?></td>
                          <td class="text-left" style="vertical-align:middle"><?= $db['cabangx'] ?></td>
                          <td class="text-left" style="vertical-align:middle"><?= $db['kunjungan1'] ?></td>
                          

                            <?php
                              $besok = date('Y-m-d', strtotime("+1 day", strtotime($db['tanggal'])))." ".'12:05:00';
                              $jam = date('H:i:s');
                              $datenow = date('Y-m-d H:i:s');

                              // echo $datenow;
                              // echo "<br>";
                              // echo $besok;
                            ?>
                          <td class="text-left" style="vertical-align:middle"><?= $db['tanggal'] ?></td>
                          
                          <td class="text-center">
                            <?php 
                            $form = $this->db->get_where('form_keterlambatan', array('num_quest' => $db['num']))->row_array();
                            // echo $form['num_quest'];
                            
                            if ($datenow <= $besok AND $db['keterlambatan_upload'] == NULL AND ($db['status'] == 1 OR $db['rekaman_status'] == 0) AND $form == NULL) {
                                       echo '<a href="'.base_url('aktual/keterlambatan/'.$db['kode_project'].'/'.$db['cabang'].'/'.$db['kunjungan']).'" class="btn btn-warning btn-round btn-xs" target="_blank" data-trigger="hover" data-toggle="popover" data-placement="top" title="Informasi" data-content="Anda harus mengajukan berita acara keterlambatan sebelum H+1 jam 12.00. Jika sudah terlewat kunjungan dianggap DO"> Pengajuan Keterlambatan</a>'; 
                                       
                            } else if ($datenow >= $besok AND $db['keterlambatan_upload'] == NULL AND $form == NULL) {
                                       echo '<a href="'.base_url('aktual/keterlambatan/'.$db['kode_project'].'/'.$db['cabang'].'/'.$db['kunjungan']).'" class="btn btn-warning btn-round btn-xs" target="_blank" disabled onclick="return(false);" data-trigger="hover" data-toggle="popover" data-placement="top" title="Informasi" data-content="Anda harus mengajukan berita acara keterlambatan sebelum H+1 jam 12.00. Jika sudah terlewat kunjungan dianggap DO"> Pengajuan Keterlambatan</a>';
                            }
                            

                            ?>  
                          </td>
                        </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </section>
            </div>

              <div role="tabpanel" class="tab-pane container-fluid" id="done">
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-2">
                  <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Nama Project<center></th>
                      <th><center>Nama Cabang<center></th>
                      <th><center>Kunjungan<center></th>
                      <th><center>Tanggal Kunjungan<center></th>

                      <!-- <th>Kode Token</th> -->
                      <th><center>Aksi<center></th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $id_user = $this->session->userdata('id_user');
                    $no = 1;
                    $atmcenter = array('064','065','066','067');
                    foreach ($done as $dt) :?>
                        <tr>
                          <td class="text-center" style="vertical-align:middle"><?= $no++; ?></td>
                          <td class="text-left" style="vertical-align:middle"><?= $dt['nama_project'] ?></td>
                          <td class="text-left" style="vertical-align:middle"><?= "(".$dt['cabang'].") ".$dt['nama_cabang'] ?></td>
                          <td class="text-left" style="vertical-align:middle"><?= $dt['nama_kunjungan'] ?></td>
                          <td class="text-left" style="vertical-align:middle"><?= $dt['tgl_kunjungan'] ?>
                            
                          </td>
                          <td class="text-center"> <button type="button" class="btn btn btn-warning btn-round btn-xs" data-toggle="modal" data-target="#done<?= $dt['id'] ?>">Show Detail!</button>
                            <?php
                              if ($dt['mengetahui'] != 'Valid' OR $dt['mengetahui'] == NULL) {
                                  echo '<a href="'.base_url('aktual/hapus_keterlambatan/'.$dt['id']).'" class="btn btn-danger btn-round btn-xs tombol-hapus"><i class="fas fa-trash"></i></a>';
                              }
                            ?>
 
                          </td>
                        </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
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
<!--  -->


<?php 
$no = 0;
foreach ($done as $dt) { $no++;

?>
<!-- Modal Pengajuan Keterlambatan -->
<div class="modal fade" id="done<?= $dt['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="cetak<?= $dt['id'] ?>">
        <table class="table table-sm borderless"  cellpadding="5">

                    <tr>
                        <td colspan="3" style="text-align: center; font-weight: bold">
                            <h4><b>BERITA ACARA KETERLAMBATAN PENGIRIMAN DATA</b></h4>
                        </td>
                    </tr>
                    <!-- <tr >
                                       <td colspan="2"></td>
                                    </tr> -->
                    <tbody style="font-size: 14px;">
                        
                        <tr>
                            <td width="30%" valign="top">Kepada-RA Project </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;"><?= $dt['nama_ra'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%" valign="top">Tembusan </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;">1. Kadiv.Research Business 1
                                                            <br> 2. Pimpinan Field Operation B1
                            </td>
                        </tr>

                        <tr>
                          <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="top">Dengan ini mengajukan <span class="font-italic"> Permohonan Keterlambatan Pengiriman Data Kunjungan </span>:</td>
                            
                        </tr>
                        <tr>
                            <td width="30%" valign="top">Job </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;"><?= $dt['nama_project'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%" valign="top">Kunjungan </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;"><?= $dt['nama_kunjungan'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%" valign="top">Cabang </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;"><?= "(".$dt['cabang'].") ".$dt['nama_cabang'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%" valign="top">Tanggal Kunjungan </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;"><?= $dt['tgl_kunjungan'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%" valign="top">Pewitness </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;"><?= $dt['pwt']." - ".$dt['nama_pwt'] ?></td>
                        </tr>
                        <tr>
                            <td width="30%" valign="top">Telat Kirim Data Karena </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;"><?= $dt['alasan'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" valign="top"><strong>Catatan :</strong></td>
                            
                        </tr>
                        <tr>
                            <td colspan="3" valign="top" style="text-align: justify;">1. Formulir Berita Acara harus di kumpulkan paling lambat : <span style="font-weight: bold; color: red; font-style: italic; text-decoration: underline;">HARI H+1 Kunjungan, JAM 12.00.</span> Jika melanggar dari hal-hal tersebut di atas, secara otomatis system akan menolak, dan data dinyatakan <strong class="font-italic">DO</strong>
                            <br>2.  Untuk yang <strong style="text-decoration: underline;">Bertugas Penerima Tugas Perjalanan Dinas</strong>, maka wajib bertanggung jawab atas data yang di DO, dan WAJIB mengatur kunjungan ulang lagi, dan jumlah hari penugasan, tidak akan ditambahkan, apabila terjadi <b>DO</b>.
                            </td>
                            
                        </tr>
                       
                        <tr>
                          <td colspan="3" style="text-align: justify;">Demikian berita acara ini saya buat dengan sebenar benarnya beserta bukti terlampir, atas perhatian dan kerjasamanya saya ucapkan terimakasih .</td>
                        </tr>
                        <tr>
                            <td width="30%" valign="top"><strong>*Lampiran (Evidence)</strong> </td>
                            <td width="3%">:</td>
                            <td style="text-align: justify;">
                              <?php if($dt['evidence'] != NULL OR $dt['evidence'] != '') { ?>
                              <a target="_blank" href="<?= base_url('assets/')?>file/foto_temuan/<?= $dt['evidence']?>"><i class="fas fa-image fa-2x"></i></a>
                              <?php } ?></td>
                        </tr>
                        <tr>
                          <td colspan="3" style="text-align: justify;"><strong>Jakarta, <?= date('d-m-Y', strtotime($dt['tgl_dibuat'])) ?></strong></td>
                        </tr>
                        <tr>
                          <td colspan="2" style="text-align: center;"><strong>Pemohon</strong></td>
                          <td style="text-align: center;"><strong>Mengetahui, </strong></td>
                        </tr>
                        <tr>
                          <td colspan="2" style="text-align: center;"><i class="fas fa-check-circle fa-2x" style="color: green;"></i><br>
                            <?= date('d-m-Y H:i:s', strtotime($dt['tgl_dibuat'])) ?></td>
                          <td style="text-align: center;">
                            <?php if ($dt['mengetahui'] == 'Valid') {
                              echo '<i class="fas fa-check-circle fa-2x" style="color: green;"></i><br>'.date('d-m-Y H:i:s', strtotime($dt['tgl_mengetahui'])).'';
                            } else {
                              if ($dt['pj_field'] == $id_user) {
                                echo '<a href="'. base_url('aktual/mengetahui/'.$dt['id']).'" class="btn btn-success btn-round btn-xs">Valid</a>';
                              }
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2" style="text-align: center;"><?php if($dt['pemohon'] != NULL){ echo $dt['pemohon'];} else {echo $dt['pemohon2'];} ?></td>
                          <td style="text-align: center;"><?= $dt['nama_pj_field'] ?></td>
                        </tr>

                        <tr>
                          <td colspan="3" style="text-align: center;"><strong>Menyetujui,</strong></td>
                        </tr>
                        <tr>
                          <td colspan="3" style="text-align: center;">
                            <?php if ($dt['approval'] == 'Approve') {
                              echo '<i class="fas fa-check-circle fa-2x" style="color: green;"></i><br>'.date('d-m-Y H:i:s', strtotime($dt['tgl_approve'])).'';
                            } else {
                              if ($dt['ra_project'] == $id_user) {
                                echo '<a href="'. base_url('aktual/approval_keterlambatan/'.$dt['id']).'" class="btn btn-success btn-round btn-xs">Approve</a>';
                              }
                            } ?>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="3" style="text-align: center;"><?= $dt['nama_ra'] ?></td>
                        </tr>
                        


                    </tbody>
                </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="printArea('<?= $dt['id'] ?>')"class="btn btn-primary">Print</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
$(function () {
  $('[data-toggle="popover"]').popover()
});

function printArea(id)
{
    console.log(id);
    var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById('cetak'+id).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
}

 function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
      }

</script>

