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

  a[href]:after {
    content: none !important;
  }

  }  
</style>
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Skenario Kunjungan SHP</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Skenario Kunjungan SHP</strong></h4>
                <a href="<?= base_url('skenario/tambahkunjunganshp')?>" class="btn btn-round btn-primary mb"><i class="fa fa-plus fa-fw"></i> Tambah </a>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal Kunjungan</th>
                      <th>STKB</th>
                      <th>Nama Cabang</th>
                      <th>Nama PWT</th>
                      <th>Nama SHP</th>
                      <th>Nama Project</th>
                      <th>Kunjungan</th>
                      <th>Skenario</th>
                      <!-- <th class="text-center">Aksi</th> -->
                    </tr>
                  </thead>
                  <tbody>
                      <?php error_reporting(1); $no = 0; foreach($aktual as $key => $db) :
                        $atmcenter = array('064','065','066','067');
                        if (in_array($db['r_kategori'], $atmcenter)){
                          if($db['r_kategori'] == '064'){ $id_shp = $db['shp_weekday_siang']; $tanggal = $db['tgl_weekday_siang']; }
                          else if($db['r_kategori'] == '065'){ $id_shp = $db['shp_weekend_siang']; $tanggal = $db['tgl_weekend_siang']; }
                          else if($db['r_kategori'] == '066'){ $id_shp = $db['shp_weekday_malam']; $tanggal = $db['tgl_weekday_malam']; }
                          else if($db['r_kategori'] == '067'){ $id_shp = $db['shp_weekend_malam']; $tanggal = $db['tgl_weekend_malam']; }

                          if($id_shp != NULL){
                            $shp = $this->db->query("SELECT Id,Nama FROM id_data WHERE Id = '$id_shp'")->row_array();
                            $id_pwt = ''; $nama_pwt = '';
                            $id_shp = $shp['Id']; $nama_shp = $shp['Nama'];
                          }else{
                            continue;
                          }

                        }else{
                          $id_pwt = $db['pwt']; $nama_pwt = $db['nama_pwt'];
                          $id_shp = $db['shp']; $nama_shp = $db['Nama']; $tanggal = $db['tanggal'];
                          if($id_shp == NULL){ continue; }
                        }
                            $besok = date('Y-m-d', strtotime("+1 day", strtotime($db['tanggal'])))." ".'12:00:00';
                              $jam = date('H:i:s');
                              $datenow = date('Y-m-d H:i:s');
                      ?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $tanggal?></td>
                            <td><?= $db['nomorstkb']?></td>
                            <td><?= $db['nama_cabang']?></td>
                            <td><?= $id_pwt?> - <?= $nama_pwt?></td>
                            <td><?= $id_shp?> - <?= $nama_shp?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['r_kategori']?></td>
                            <td><?= $db['skenario']?></td>
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
                            if ($datenow >= $besok AND $db['keterlambatan_upload'] == NULL AND ($db['status'] == 1 OR $db['rekaman_status'] == 0)) {
                                       echo '<a href="'.base_url('aktual/keterlambatan/'.$db['project'].'/'.$db['cabang'].'/'.$db['kunjungan']).'" class="btn btn-warning btn-round btn-xs" target="_blank"> Pengajuan Keterlambatan</a>'; 
                                       
                                      }
                            

                            ?>  
                          </td> -->
                            <!-- <td>
                                <a href="" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem;" data-toggle="modal" data-target="#hapus<?= $db['num']; ?>"><span class="fa fa-trash fa-fw"></span>Hapus</a>
                            </td> -->
                        </tr>

                        <!-- MODAL HAPUS -->
                        <!-- <div class="modal fade" id="hapus<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Skenario</h4>
                                </div>
                                <div class="modal-body">
                                Yakin ingin menghapus <strong><?= $db['Nama']?> </strong> pada kunjungan <strong><?= $db['skenario']?></strong> di cabang <strong><?= $db['nama_cabang']?></strong> ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('skenario/hapusshpkunjungan/')?><?= $db['num']?>" type="button" class="btn btn-primary btn-round">Hapus</a>
                                </div>
                            </div>
                            </div>
                        </div> -->
                        <!-- AKHIR MODAL HAPUS -->
                      <?php endforeach?>
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