<style>
    .borderless td,
    .borderless th {
        border: none !important;
    }
  @media print {
  table td,
    table th {
        border: none !important;
    }
  }  
</style>
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> Aktual </h3>
    <div class="row mt">
      <div class="col-lg-12">


        <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Aktual Success </strong></h4>

              <div class="col-lg-12">
                <?= $this->session->flashdata('info'); ?>
                <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                 <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
              </div>

              <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Nama Project<center></th>
                      <th><center>Nama Cabang<center></th>
                      <th><center>Kode Kunjungan<center></th>
                      <th><center>Skenario<center></th>
                      <th><center>Tanggal Kunjungan<center></th>

                      <!-- <th>Kode Token</th> -->
                      <th><center>Aksi<center></th>
                      <!-- <th><center>Form Keterlambatan<center></th> -->

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
                          <td class="text-left" style="vertical-align:middle">
                            <?php
                              if (in_array($db['skenario'], $atmcenter)){
                                if($db['status'] >= 1){
                                  echo $db['kunjungan1'].'(<span class="fa fa-check text-success fa-fw"></span>)';
                                }else{
                                  echo $db['kunjungan1'].'(<span class="fa fa-times text-danger fa-fw"></span>)';
                                }
                              }else{
                                $get = $this->db->query("SELECT GROUP_CONCAT( a.kunjungan ) AS kode_skenario, GROUP_CONCAT( d.nama ) AS skenario, GROUP_CONCAT( a.`status` ) AS sts
                                         FROM attribute d LEFT JOIN (cabang c JOIN ( quest a JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n' ) ON a.cabang = c.kode AND a.project = c.project) ON a.kunjungan = d.kode
                                         WHERE a.shp = '$id_user' AND a.nomorstkb = $db[nomorstkb] GROUP BY a.project, a.cabang, a.r_kategori")->row_array();
                                $data = explode(",", $get['skenario']);
                                $data1 = explode(",", $get['kode_skenario']);
                                $sts = explode(",", $get['sts']);

                                for($i=0;$i<count($data1);$i++):
                                    if($sts[$i] >= 1):
                                    echo $data[$i].'(<span class="fa fa-check text-success fa-fw"></span>),';
                                    else :
                                    echo $data[$i].'(<span class="fa fa-times text-danger fa-fw"></span>),';
                                    endif;
                                endfor;
                              }
                              $besok = date('Y-m-d', strtotime("+1 day", strtotime($db['tanggal'])))." ".'12:00:00';
                              $jam = date('H:i:s');
                              $datenow = date('Y-m-d H:i:s');
                            ?>
                          </td>
                          <td class="text-left" style="vertical-align:middle"><?= $db['tanggal'] ?></td>
                          <td class="text-center">
                              <?php
                              $proj = $db['nama_project']; $cab = $db['cabang']; $ktg = $db['r_kategori'];
                              if (in_array($db['skenario'], $atmcenter)){
                                $status = unserialize($db['rekaman_status']);
                                if($status['rekaman_status'] == 0){
                                      if ($datenow >= $besok AND $db['keterlambatan_upload'] == NULL) {
                                  echo '<a href="'.base_url('rekaman/tambahKB1/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs" disabled onclick="return(false);" data-trigger="hover" data-toggle="popover" data-placement="top" title="Keterlambatan Upload" data-content="Anda harus mengisi form keterlambatan upload terlebih dahulu, selanjutnya Anda dapat melanjutkan Upload Bukti Rekaman"><span class="fa fa-paperclip fa-fw"></span> Upload Bukti Kirim Rekaman </a><br><br>';

                                      } else if ($datenow >= $besok AND $db['keterlambatan_upload'] == 'Approve'){
                                  echo '<a href="'.base_url('rekaman/tambahKB1/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs"><span class="fa fa-paperclip fa-fw"></span> Upload Bukti Kirim Rekaman </a><br><br>';

                                      } else { 
                                  echo '<a href="'.base_url('rekaman/tambahKB1/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs"><span class="fa fa-paperclip fa-fw"></span> Upload Bukti Kirim Rekaman </a><br><br>';
                                      }
                                }
                                if($db['status'] == 1){
                                      if ($datenow >= $besok AND $db['keterlambatan_upload'] == NULL) {
                                  echo '<a href="'.base_url('shp/tambahKZ/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs" disabled onclick="return(false);" data-trigger="hover" data-toggle="popover" data-placement="top" title="Keterlambatan Upload" data-content="Anda harus mengisi form keterlambatan upload terlebih dahulu, selanjutnya Anda dapat melanjutkan Upload Dialog + Bukti Kunjungan"><span class="fa fa-paperclip fa-fw"></span> Dialog + Bukti Kunjungan</a>';

                                      } else if ($datenow >= $besok AND $db['keterlambatan_upload'] == 'Approve'){
                                  echo '<a href="'.base_url('shp/tambahKZ/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs"><span class="fa fa-paperclip fa-fw"></span> Dialog + Bukti Kunjungan</a>';

                                      } else {
                                  echo '<a href="'.base_url('shp/tambahKZ/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs"><span class="fa fa-paperclip fa-fw"></span> Dialog + Bukti Kunjungan</a>';
                                    }
                                }
                              }else{
                                //if ($cek = $this->db->query("SELECT * FROM quest WHERE project = '$proj' AND cabang = '$cab' AND shp = '$id_user' AND r_kategori = '$ktg' AND rekaman_status = '0'")->num_rows() != 0){
                                if($db['rekaman_status'] == 0){
                                      if ($datenow >= $besok AND $db['keterlambatan_upload'] == NULL) {
                                        echo '<a href="'.base_url('rekaman/tambahKB1/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs" disabled onclick="return(false);" data-trigger="hover" data-toggle="popover" data-placement="top" title="Keterlambatan Upload" data-content="Anda harus mengisi form keterlambatan upload terlebih dahulu, selanjutnya Anda dapat melanjutkan Upload Bukti Rekaman"><span class="fa fa-paperclip fa-fw"></span> Upload Bukti Kirim Rekaman </a><br><br>';
                                      } else if ($datenow >= $besok AND $db['keterlambatan_upload'] == 'Approve'){
                                      echo '<a href="'.base_url('rekaman/tambahKB1/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs"><span class="fa fa-paperclip fa-fw"></span> Upload Bukti Kirim Rekaman </a><br><br>';
                                      } else {
                                        echo '<a href="'.base_url('rekaman/tambahKB1/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs"><span class="fa fa-paperclip fa-fw"></span> Upload Bukti Kirim Rekaman </a><br><br>';
                                      }
                                }
                                //if ($cek = $this->db->query("SELECT * FROM quest WHERE project = '$proj' AND cabang = '$cab' AND shp = '$id_user' AND r_kategori = '$ktg'AND `status` = '1'")->num_rows() != 0){
                                if($db['status'] == 1){
                                      if ($datenow >= $besok AND $db['keterlambatan_upload'] == NULL) {
                                        echo '<a href="'.base_url('shp/tambahKZ/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs" disabled onclick="return(false);" data-trigger="hover" data-toggle="popover" data-placement="top" title="Keterlambatan Upload" data-content="Anda harus mengisi form keterlambatan upload terlebih dahulu, selanjutnya Anda dapat melanjutkan Upload Dialog + Bukti Kunjungan"><span class="fa fa-paperclip fa-fw"></span> Dialog + Bukti Kunjungan</a><br>';

                                      } else if ($datenow >= $besok AND $db['keterlambatan_upload'] == 'Approve'){
                                        echo '<a href="'.base_url('shp/tambahKZ/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs"><span class="fa fa-paperclip fa-fw"></span> Dialog + Bukti Kunjungan</a><br>';

                                      } else {
                                        echo '<a href="'.base_url('shp/tambahKZ/'.$db['r_kategori'].'/'.$db['kode_project'].'/'.$db['cabang']).'" class="btn btn-success btn-round btn-xs"><span class="fa fa-paperclip fa-fw"></span> Dialog + Bukti Kunjungan</a><br>';
                                     
                                      }   
                                }
                                      

                              }
                              ?>
                          </td>
                          <!-- <td class="text-center">
                            <?php 
                            $form = $this->db->get_where('form_keterlambatan', array('num_quest' => $db['num']))->row_array();
                            if ($form != NULL) {
                              echo '<button type="button" class="btn btn btn-primary btn-round btn-xs" data-toggle="modal" data-target="#form'.$db['num'].'">Show Form!</button>';
                              if ($form['mengetahui'] != 'Valid' OR $form['mengetahui'] == NULL) {
                                  echo '<a href="'.base_url('aktual/hapus_keterlambatan/'.$form['id']).'" class="btn btn-danger btn-round btn-xs tombol-hapus"><i class="fas fa-trash"></i></a>';
                              }
                              echo "<br><br>";
                            }
                            if ($db['status'] == 1 OR $db['rekaman_status'] == 0) {
                                       echo '<a href="'.base_url('aktual/keterlambatan/'.$db['kode_project'].'/'.$db['cabang'].'/'.$db['kunjungan']).'" class="btn btn-warning btn-round btn-xs" target="_blank"> Pengajuan Keterlambatan</a>'; 
                                       
                                      }
                            

                            ?>  
                          </td> -->
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
  </section>
  <!-- /wrapper -->
</section>

<?php 
$no = 0;
foreach ($aktual as $ak) { $no++;
        $atmcenter = array('064','065','066','067');
    if (in_array($ak['skenario'], $atmcenter)){
    $dt = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.namacabang AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN atmcenter c ON a.cabang=c.cabang AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    a.num_quest = $ak[num]
                                GROUP BY
                                    a.num_quest
                                    ")->row_array();
    } else{
        $dt = $this->db->query("SELECT
                                    a.*,
                                    b.nama AS nama_project,
                                    c.nama AS nama_cabang,
                                    d.nama AS nama_kunjungan,
                                    e.nama AS pemohon,
                                    f.name AS pemohon2,
                                    g.name AS nama_pj_field,
                                    h.name AS nama_ra,
                                    i.Nama AS nama_pwt
                                FROM
                                    form_keterlambatan a
                                    JOIN project b ON a.project=b.kode
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    JOIN attribute d ON a.kunjungan=d.kode
                                    LEFT JOIN user f ON a.pemohon=f.noid
                                    LEFT JOIN id_data e ON a.pemohon=e.id
                                    LEFT JOIN user g ON a.pj_field=g.noid
                                    LEFT JOIN user h ON a.ra_project=h.noid
                                    LEFT JOIN id_data i ON a.pwt=i.Id
                                WHERE
                                    a.num_quest = $ak[num]
                                GROUP BY
                                    a.num_quest
                                    
                                    ")->row_array();
    }

?>
<!-- Modal Pengajuan Keterlambatan -->
<div class="modal fade" id="form<?= $ak['num'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            } 
                             ?>
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


</script>

