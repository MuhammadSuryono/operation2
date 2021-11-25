<div class="table-responsive">
<form action="<?php echo base_url('stkb/readytopaid')?>" method="POST" enctype="multipart/form-data">
<input type="hidden" name="pengklik" value="<?php echo $this->session->userdata('id_user'); ?>">
<table class=" table table-bordered table-striped table-condensed">
  <thead>
      <tr>
        <th>No.</th>
        <th>Nomor Stkb</th>
        <th>Term</th>
        <th>Tanggal Buat</th>
        <th>Tanggal Mulai</th>
        <th>Project</th>
        <th>Nama</th>
        <th>Perdin</th>
        <th>Akomodasi</th>
        <th>Bpjs</th>
        <th>Jumlah RTP (OPS)</th>
        <th>Jumlah RTP (TRK)</th>
        <th>Total</th>
        <th>Cek</th>
        <th>Print</th>
      </tr>
  </thead>
  <tbody>
      <?php
        $no = 1;
        $totalterm13 = 0;
        foreach ($getpengajuan as $key) :
         $totalnya = $key['jumlahops'] + $key['jumlahtrk'] + $key['perdin'] + $key['akomodasi'] + $key['bpjs'];
         $totalterm13 += $totalnya;
         ?>
         <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $key['nmrstkb'] ?><input type="hidden" name="nomorstkb<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['nmrstkb'] ?>"></td>
          <td><?php echo $key['termnya'] ?><input type="hidden" name="term<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['termnya'] ?>"></td>
          <td><?php echo $key['tanggalbuat'] ?><input type="hidden" name="tanggalbuat<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['tanggalbuat'] ?>"></td>
          <td><?php echo $key['tglm'] ?></td>
          <td><?php echo $key['kodeproject'] ?> - <?php echo $key['namaproject'] ?><input type="hidden" name="kodeproject<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['kodeproject'] ?>"></td>
          <td><?php echo $key['idpic'] ?> - <?php echo $key['namapic'] ?><input type="hidden" name="idpic<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['idpic'] ?>"></td>
          <td><?php echo 'Rp. ' . number_format( $key['perdin'], 0 , '' , ',' ); ?><input type="hidden" name="perdin<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['perdin']?>"></td>
          <td><?php echo 'Rp. ' . number_format( $key['akomodasi'], 0 , '' , ',' ); ?><input type="hidden" name="akomodasi<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['akomodasi']?>"></td>
          <td><?php echo 'Rp. ' . number_format( $key['bpjs'], 0 , '' , ',' ); ?><input type="hidden" name="bpjs<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['bpjs']?>"></td>
          <td><?php echo 'Rp. ' . number_format( $key['jumlahops'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahops<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['jumlahops'] ?>"></td>
          <td><?php echo 'Rp. ' . number_format( $key['jumlahtrk'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahtrk<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['jumlahtrk'] ?>"></td>
          <td><?php echo 'Rp. ' . number_format( $totalnya, 0 , '' , ',' ); ?><input type="hidden" name="total<?php echo $key['nmrstkb'] ?>" value="<?php echo $totalnya; ?>"></td>
          <td><input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree1" name="statusbayar[]" value="<?php echo $key['nmrstkb'] ?>" /></td>
          <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $key['nmrstkb']; ?>/<?php echo $key['termnya']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
        </tr>
       <?php
       $no++;
      endforeach;
        ?>
  </tbody>
</table>
    <?php
    // $totalops = 0;
    // $totaltrk = 0;
    // $totalperdin = 0;
    // $totalakomodasi = 0;
    // $totalbpjs = 0;
    // foreach ($getpengajuan as $gp) {
    //   $totalops += $gp['jumlahops'];
    //   $totaltrk += $gp['jumlahtrk'];
    //   $totalperdin += $gp['perdin'];
    //   $totalakomodasi += $gp['akomodasi'];
    //   $totalbpjs += $gp['bpjs'];
    // }
    // $totalseluruh = $totalops + $totaltrk + $totalperdin + $totalakomodasi + $totalbpjs;
    ?>
    <div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2"><h3><?php echo 'Rp. ' . number_format( $totalterm13, 0 , '' , ',' ); ?></h3></div>
    </div>
    <div class="row">
    <div class="col-md-9"></div>

<?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
    <div class="col-md-1 text-center">
      <!-- <center><input type="checkbox" style="width: 30px" class="checkbox form-control" onclick="checkall1()" id="checkAll1" disabled /></center>
      <label for="checkAll1">Check All</label> -->
    </div>
    <div class="col-md-2"><button type="submit" class="btn btn-lg btn-success">Move To RTP <i class="fas fa-angle-double-right"></i></button></div>
<?php endif?>
    </div>
    </form>
  </div>
