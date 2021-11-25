<div class="table-responsive">
<table class=" table table-bordered table-striped table-condensed">
  <thead>
      <tr>
        <th>No.</th>
        <th>Nomor Stkb</th>
        <th>Term</th>
        <th>Tanggal Buat</th>
        <th>Project</th>
        <th>Nama</th>
        <th>Perdin</th>
        <th>Akomodasi</th>
        <th>Bpjs</th>
        <th>Jumlah RTP (OPS)</th>
        <th>Jumlah RTP (TRK)</th>
        <th>Total</th>

<?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
        <th>Bayar</th>
<?php endif?>

        <th>Print</th>
      </tr>
  </thead>
  <tbody>
      <?php
        $no = 1;
        $totalrtp = 0;
        foreach ($getrtp as $key2) :
        $totalnya = $key2['jumlahops'] + $key2['jumlahtrk'] + $key2['perdin'] + $key2['bpjs'] + $key2['akomodasi'];
        $totalrtp += $totalnya;
       ?>
       <tr>
        <td><?php echo $no; ?></td>
        <td><?php echo $key2['nomorstkb'] ?></td>
        <td><?php echo $key2['term'] ?></td>
        <td><?php echo $key2['tanggalbuat'] ?></td>
        <td><?php echo $key2['kodeproject'] ?> - <?php echo $key2['namaproject'] ?></td>
        <td><?php echo $key2['idpic'] ?> - <?php echo $key2['namapic'] ?></td>
        <td><?php echo 'Rp. ' . number_format( $key2['perdin'], 0 , '' , ',' ); ?></td>
        <td><?php echo 'Rp. ' . number_format( $key2['akomodasi'], 0 , '' , ',' ); ?></td>
        <td><?php echo 'Rp. ' . number_format( $key2['bpjs'], 0 , '' , ',' ); ?></td>
        <td><?php echo 'Rp. ' . number_format( $key2['jumlahops'], 0 , '' , ',' ); ?></td>
        <td><?php echo 'Rp. ' . number_format( $key2['jumlahtrk'], 0 , '' , ',' ); ?></td>
        <td><?php echo 'Rp. ' . number_format( $totalnya, 0 , '' , ',' ); ?></td>

<?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
        <td><a href="javascript:;" data-toggle="modal" data-target="#bayarstkb" data-nomorstkb="<?php echo $key2['nomorstkb']; ?>" data-pembayar="<?php echo $key2['nomorstkb']; ?>"
              data-totalnya="<?php echo $totalnya; ?>" data-term="<?php echo $key2['term'] ?>" data-ops="<?php echo $key2['jumlahops'] ?>" data-trk="<?php echo $key2['jumlahtrk'] ?>"
              data-perdin="<?php echo $key2['perdin'] ?>" data-akomodasi="<?php echo $key2['akomodasi'] ?>" data-bpjs="<?php echo $key2['bpjs']?>" class="btn-success btn-sm"><i class="fa fa-money"></i> Paid</a></td>
<?php endif?>

        <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $key2['nomorstkb']; ?>/<?php echo $key2['term']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
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
    // foreach ($getrtp as $gp) {
    //   $totalops += $gp['jumlahops'];
    //   $totaltrk += $gp['jumlahtrk'];
    //   $totalperdin += $gp['perdin'];
    //   $totalakomodasi += $gp['akomodasi'];
    //   $totalbpjs += $gp['bpjs'];
    // }
    // $totalseluruh = $totalops + $totaltrk + $totalperdin + $totalakomodasi + $totalbpjs;
    //$totalseluruh = $totalops + $totaltrk;
    ?>
    <div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-2"><h3><?php echo 'Rp. ' . number_format( $totalrtp, 0 , '' , ',' ); ?></h3></div>
    </div>
  </div>
