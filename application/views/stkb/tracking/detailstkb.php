<div class="table-responsive">
<table class=" table table-bordered table-striped table-condensed" id="dataTables-example">
  <thead>
    <tr>
      <th>No.</th>
      <th>Project</th>
      <th>Cabang</th>
      <th>Kunjungan</th>
      <th>PIC</th>
      <th>Shopper</th>
      <th>PWT</th>
      <th>Nomor Stkb</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 1;
    foreach ($detailnya as $key) {
      $atmcenter = array('064','065','066','067');
      if (in_array($key['kodekunjungan'], $atmcenter)){
        $sts = ''; $id_shp = '';
        if($key['kodekunjungan'] == '064'){ $id_shp = $key['shp_weekday_siang']; $sts = $key['status_weekday_siang'] >= 0 ? $key['status_weekday_siang'] : NULL; }
        else if($key['kodekunjungan'] == '065'){ $id_shp = $key['shp_weekend_siang']; $sts = $key['status_weekend_siang'] >= 0 ? $key['status_weekend_siang'] : NULL; }
        else if($key['kodekunjungan'] == '066'){ $id_shp = $key['shp_weekday_malam']; $sts = $key['status_weekday_malam'] >= 0 ? $key['status_weekday_malam'] : NULL; }
        else if($key['kodekunjungan'] == '067'){ $id_shp = $key['shp_weekend_malam']; $sts = $key['status_weekend_malam'] >= 0 ? $key['status_weekend_malam'] : NULL; }

        if($sts == NULL){
          $stat ="Belum Di Plot";$warna = "#ffa587";
        }else if($sts == 1){
          $stat ="Sudah Aktual";$warna = "";
        }else if($sts == 2){
          $stat ="Sudah Upload";$warna = "";
        }else if($sts == 3){
          $stat ="Sudah Validasi";$warna = "#b0ff94";
        }else{
          $stat ="--";$warna = "";
        }

        $shp = $this->db->query("SELECT Id,Nama FROM id_data WHERE Id = '$id_shp'")->row_array();
        $id_shp = $shp['Id'];
        $nama_shp = $shp['Nama'];

      }else{
        if ($key['statusquest'] == NULL){
          $stat ="Belum Di Plot";
          $warna = "#ffa587";
        }
        else if($key['statusquest'] == 1){
          $stat ="Sudah Aktual";
          $warna = "";
        }
        else if($key['statusquest'] == 2){
          $stat ="Sudah Upload";
          $warna = "";
        }
        else if($key['statusquest'] == 3){
          $stat ="Sudah Validasi";
          $warna = "#b0ff94";
        }
        else{
          $stat ="--";
          $warna = "";
        }

        $id_shp = $key['idshopper'];
        $nama_shp = $key['namashp'];
      }
    ?>
    <tr>
      <td bgcolor="<?php echo $warna?>"><?php echo $i++ ?></td>
      <td bgcolor="<?php echo $warna?>"><?php echo $key['project']?></td>
      <td bgcolor="<?php echo $warna?>"><?php echo $key['kodecabang']?> - <?php echo $key['namacabang']?></td>
      <td bgcolor="<?php echo $warna?>"><?php echo $key['kodekunjungan']?> - <?php echo $key['namakunjungan']?></td>
      <td bgcolor="<?php echo $warna?>"><?php echo $key['idpic']?> - <?php echo $key['namapic']?></td>
      <td bgcolor="<?php echo $warna?>"><?php echo $id_shp?> - <?php echo $nama_shp?></td>
      <td bgcolor="<?php echo $warna?>"><?php echo $key['idpwt']?> - <?php echo $key['namapwt']?></td>
      <td bgcolor="<?php echo $warna?>"><?php echo $key['nomornya']?></td>
      <td bgcolor="<?php echo $warna?>"><?php echo $stat ?></td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>
</div>
