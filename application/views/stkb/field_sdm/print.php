<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Field</h3>
        <div class="row mt">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Field SDM </strong> </h4>
                            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                            <section id="unseen">

                                <style>
                                    .invoice-title h2,
                                    .invoice-title h3 {
                                        display: inline-block;
                                    }

                                    .table>tbody>tr>.no-line {
                                        border-top: none;
                                    }

                                    .table>thead>tr>.no-line {
                                        border-bottom: none;
                                    }

                                    .table>tbody>tr>.thick-line {
                                        border-top: 2px solid;
                                    }
                                </style>
                                <div id="printableArea">

                                    <!-- <div class="container"> -->
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="invoice-title">
                                                <h2>Laporan Honor Area Head</h2>
                                            </div>
                                            <hr>

                                            <div class="row">
                                                <div class="col-xs-2 text-left">
                                                    <!-- <strong>Keterangan</strong><br> -->
                                                    Nama<br>
                                                    Kota Asal<br>
                                                    <!-- Kota Tujuan<br> -->
                                                    Posisi<br>
                                                    Status<br>
                                                    <?php if ($status == 'non-mitra') : ?>
                                                        Periode
                                                    <?php else : ?>
                                                        Project <br>
                                                        Progress Keseluruhan
                                                    <?php endif; ?>
                                                </div>
                                                <div class="col-xs-4 text-left">
                                                    : <?php echo $sdm['Nama'] ?> - <?php echo $sdm['id_data_id'] ?><br>
                                                    : <?php echo $sdm['kota_asal'] ?><br>
                                                    : <?php echo $sdm['posisi'] ?><br>
                                                    : <?php echo $sdm['status'] ?><br>

                                                    <?php if ($status == 'non-mitra') : ?>
                                                        : <b><?php echo $tanggal_mulai ?></b> s/d <b><?php echo $tanggal_selesai ?></b>
                                                    <?php else : ?>
                                                        : <?= $namaproject['nama']; ?> <br>
                                                        : <?= $progress; ?> %
                                                    <?php endif; ?>
                                                </div>

                                                <div class="col-xs-4">
                                                </div>
                                            </div>

                                            <br /><br />

                                            <center>
                                                <h4><strong></strong></h4>
                                            </center>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Detail Honor</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <!-- <div class="table-responsive"> -->
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center"><strong>Komponen</strong></th>
                                                                        <th class="text-center">Jenis</th>
                                                                        <th class="text-center">Matrix</th>
                                                                        <?php if ($status == 'non-mitra') : ?>
                                                                            <th class="text-center">Hari Aktif</th>
                                                                        <?php else : ?>
                                                                            <th class="text-center">Jumlah Cabang</th>
                                                                        <?php endif; ?>

                                                                        <?php if ($status == 'non-mitra') : ?>
                                                                            <th class="text-center">Kuesioner (setempat/luar kota)</th>
                                                                        <?php endif; ?>
                                                                        <th class="text-center"><strong>Harga Total</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="text-center">Honorium Pokok</td>
                                                                        <td class="text-center">-</td>
                                                                        <td class="text-center">-</td>
                                                                        <td class="text-center">-</td>
                                                                        <?php if ($status == 'non-mitra') : ?>
                                                                            <td class="text-center">-</td>
                                                                        <?php endif; ?>
                                                                        <td class="text-center">-</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center" style="vertical-align : middle;" rowspan="2">Honor Harian</td>
                                                                        <td class="text-center">Honor Supervisi</td>
                                                                        <td class="text-center">
                                                                            <?php
                                                                            if ($sdm['status'] == 'Kontrak') {
                                                                                echo "Rp. " . number_format($honor['supervisi_kontrak']);
                                                                                $total_honor_supervisi = $honor['supervisi_kontrak'] * $hari_kerja;
                                                                            } else if ($sdm['status'] == 'Mitra') {
                                                                                echo "Rp. " . number_format($honor['supervisi_mitra']);
                                                                                $total_honor_supervisi = $honor['supervisi_mitra'] * $hari_kerja;
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php if ($status == 'non-mitra') : ?>
                                                                                <div class="tooltip-cst">
                                                                                    <span style="text-decoration: none;"><?= $hari_kerja ?></span>
                                                                                    <?php if (!empty($detail_hari_kerja)) : ?>
                                                                                        <span class="tooltiptext-cst" style="width: 30em;">
                                                                                            <p style="padding: 0; border-bottom: 1px solid #fff;">Tanggal Aktif SDM: <?= $sdm['tanggal_mulai'] ?> s/d <?= $sdm['tanggal_selesai'] ?></p>
                                                                                            <?php $i = 1; ?>
                                                                                            <?php foreach ($detail_hari_kerja as $key => $item) : ?>
                                                                                                <span><?= $i++  ?>. <?= $key ?> <br>
                                                                                                    Tanggal Fieldwork: <?= $item['tanggal_mulai_fieldwork'] ?> s/d <?= $item['tanggal_selesai_fieldwork'] ?> <br>
                                                                                                    Tanggal Terhitung:
                                                                                                    <?= $item['tanggal_mulai'] . ' s/d ' .  $item['tanggal_selesai'] ?>
                                                                                                </span><br><br>
                                                                                            <?php endforeach; ?>
                                                                                        </span>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            <?php else : ?>
                                                                                <div class="tooltip-cst">
                                                                                    <span style="text-decoration: none;"><?= $hari_kerja ?></span>
                                                                                    <?php if (!empty($detail_hari_kerja)) : ?>
                                                                                        <span class="tooltiptext-cst" style="width: 10em;">
                                                                                            <?php $i = 1; ?>
                                                                                            <?php foreach ($detail_hari_kerja as $key => $item) : ?>
                                                                                                <span><?= $i++  ?>. <?= $item['project'] . '(' . $item['kode'] . ')' ?>
                                                                                                    <br>
                                                                                                <?php endforeach; ?>
                                                                                                </span>
                                                                                            <?php endif; ?>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <?php if ($status == 'non-mitra') : ?>
                                                                            <td class="text-center">-</td>
                                                                        <?php endif; ?>
                                                                        <td class="text-center">Rp. <?= number_format($total_honor_supervisi) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $total_honor_training = $honor['training'] * $training ?>
                                                                        <td class="text-center">Honor Training</td>
                                                                        <td class="text-center"><?= "Rp. " . number_format($honor['training']) ?></td>
                                                                        <td class="text-center">
                                                                            <div class="tooltip-cst">
                                                                                <?= $training ?>
                                                                                <?php if (!empty($detail_training)) : ?>
                                                                                    <span class="tooltiptext-cst" style="width: 30em;">
                                                                                        <?php $i = 1; ?>
                                                                                        <?php foreach ($detail_training as $key => $item) : ?>
                                                                                            <?php if (!$item['ket']) : ?>
                                                                                                <span><?= $i++  ?>. <?= $key ?>: <?= $item['start_date'] . ' s.d ' . $item['end_date'] ?></span><br>
                                                                                            <?php else : ?>
                                                                                                <span><?= $i++  ?>. <?= $key ?>: <?= $item['ket'] ?></span><br>
                                                                                            <?php endif; ?>
                                                                                        <?php endforeach; ?>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                        <?php if ($status == 'non-mitra') : ?>
                                                                            <td class="text-center">-</td>
                                                                        <?php endif; ?>
                                                                        <td class="text-center"><?= "Rp. " . number_format($total_honor_training) ?></td>
                                                                    </tr>
                                                                    <?php
                                                                    $total_honor_prod_setempat = 0;
                                                                    $total_honor_prod_lk = 0;
                                                                    if ($status == 'non-mitra') : ?>
                                                                        <tr>
                                                                            <?php $total_honor_prod_setempat = $honor['produktivitas'] * $kuesioner_setempat ?>
                                                                            <td class="text-center" style="vertical-align : middle;" rowspan="2">Honor Produktivitas</td>
                                                                            <td class="text-center">Setempat</td>
                                                                            <td class="text-center"><?= "Rp. " . number_format($honor['produktivitas']) ?></td>
                                                                            <td class="text-center">-</td>
                                                                            <td class="text-center">
                                                                                <div class="tooltip-cst">
                                                                                    <?= $kuesioner_setempat ?>
                                                                                    <?php if (!empty($detail_kuesioner_setempat)) : ?>
                                                                                        <span class="tooltiptext-cst" style="width: 60em;">
                                                                                            <span>[Project, Kunjungan, Cabang(Kode), Tgl Aktual, Ket]</span><br>
                                                                                            <?php $i = 1; ?>
                                                                                            <?php foreach ($detail_kuesioner_setempat as $key => $item) : ?>
                                                                                                <span>
                                                                                                    <?= $i++  ?>. [<?= (($item['project']) ? $item['project'] : '-') . ', ' . $item['kjg'] . ', ' . $item['namacbg'] . '(' . $item['cbg'] . '),' . $item['tgl'] . ', ' . $item['status']  ?>]
                                                                                                </span><br>
                                                                                            <?php endforeach; ?>
                                                                                        </span>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><?= "Rp. " . number_format($total_honor_prod_setempat) ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <?php $total_honor_prod_lk = $honor['insentif_timeline'] * $kuesioner_lk ?>
                                                                            <td class="text-center">Luar Kota</td>
                                                                            <td class="text-center"><?= "Rp. " . number_format($honor['insentif_timeline']) ?></td>
                                                                            <td class="text-center">-</td>
                                                                            <td class="text-center">
                                                                                <div class="tooltip-cst">
                                                                                    <?= $kuesioner_lk ?>
                                                                                    <?php if (!empty($detail_kuesioner_lk)) : ?>
                                                                                        <span class="tooltiptext-cst" style="width: 60em;">
                                                                                            <span>[Project, Kunjungan, Cabang(Kode), Tgl Aktual, Ket]</span><br>
                                                                                            <?php $i = 1; ?>
                                                                                            <?php foreach ($detail_kuesioner_lk as $key => $item) : ?>
                                                                                                <span>
                                                                                                    <?= $i++  ?>. [<?= (($item['project']) ? $item['project'] : '-') . ', ' . $item['kjg'] . ', ' . $item['namacbg'] . '(' . $item['cbg'] . '),' . $item['tgl'] . ', ' . $item['status']  ?>]
                                                                                                </span><br>
                                                                                            <?php endforeach; ?>
                                                                                        </span>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </td>
                                                                            <td class="text-center"><?= "Rp. " . number_format($total_honor_prod_lk) ?></td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                    <tr>
                                                                        <?php $total =  $total_honor_supervisi + $total_honor_training + $total_honor_prod_setempat + $total_honor_prod_lk ?>

                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <?php if ($status == 'non-mitra') : ?>
                                                                            <td class="thick-line"></td>
                                                                        <?php endif; ?>
                                                                        <td class="thick-line text-center"><strong>Total :</strong></td>
                                                                        <td class="thick-line text-center"><b><?php echo 'Rp. ' . number_format($total, 0, '', ','); ?></b></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Detail Insentif</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <!-- <div class="table-responsive"> -->
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Jenis</th>
                                                                        <th class="text-center">Matrix</th>
                                                                        <th class="text-center">Qty</th>
                                                                        <th class="text-center"><strong>Harga Total</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php
                                                                        // $total_insentif_timeline = $honor['insentif_timeline'] * $kuesioner_lk;
                                                                        ?>
                                                                        <td class="text-center">Mengerjakan Proyek di area lainnya sesuai dengan timeline yang disepakati, dengan syarat proyek di area nya sudah selesai sesuai timeline</td>
                                                                        <td class="text-center" style="vertical-align : middle;">Rp. <?= number_format($honor['insentif_timeline']) ?></td>
                                                                        <td class="text-center" style="vertical-align : middle;">
                                                                            0
                                                                            <!-- <div class="tooltip-cst">
                                                                                <?= $kuesioner_lk ?>
                                                                                <?php if (!empty($detail_kuesioner_lk)) : ?>
                                                                                    <span class="tooltiptext-cst" style="width: 60em;">
                                                                                        <span>[Project, Kunjungan, Cabang(Kode), Tgl Aktual, Ket]</span><br>
                                                                                        <?php $i = 1; ?>
                                                                                        <?php foreach ($detail_kuesioner_lk as $key => $item) : ?>
                                                                                            <span>
                                                                                                <?= $i++  ?>. [<?= (($item['project']) ? $item['project'] : '-') . ', ' . $item['kjg'] . ', ' . $item['namacbg'] . '(' . $item['cbg'] . '),' . $item['tgl'] . ', ' . $item['status']  ?>]
                                                                                            </span><br>
                                                                                        <?php endforeach; ?>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div> -->
                                                                        </td>
                                                                        <td class="text-center" style="vertical-align : middle;">Rp. <?= number_format(0) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $total_insentif_kader = $honor['insentif_kaderisasi'] * $insentif_kaderisasi ?>
                                                                        <td class="text-center">Kaderisasi: Insentif didapatkan bila sudah ada memo pengangkatan Field Officer yang disetujui RA
                                                                        <td class="text-center" style="vertical-align : middle;">Rp. <?= number_format($honor['insentif_kaderisasi']) ?></td>
                                                                        <td class="text-center" style="vertical-align : middle;">
                                                                            <div class="tooltip-cst">
                                                                                <?= $insentif_kaderisasi ?>
                                                                                <?php if (!empty($insentif_kaderisasi)) : ?>
                                                                                    <span class="tooltiptext-cst" style="width: 30em;">
                                                                                        <?php $i = 1; ?>
                                                                                        <?php foreach ($detail_insentif_kaderisasi as $key => $item) : ?>
                                                                                            <span><?= $i++  ?>. <?= $item['Nama'] ?> (<?= $item['tanggal_kaderisasi'] ?>)</span><br>
                                                                                        <?php endforeach; ?>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center" style="vertical-align : middle;">Rp. <?= number_format($total_insentif_kader) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $total_insentif_upload = $honor['insentif_upload'] * $insentif_upload ?>
                                                                        <td class="text-center">Upload kuesioner dan rekaman tepat waktu (h+1)</td>
                                                                        <td class="text-center">Rp. <?= number_format($honor['insentif_upload']) ?></td>
                                                                        <td class="text-center">
                                                                            <div class="tooltip-cst">
                                                                                <?= $insentif_upload ?>
                                                                                <?php if (!empty($detail_insentif_upload)) : ?>
                                                                                    <span class="tooltiptext-cst" style="width: 60em;">
                                                                                        <span>[Project, Kunjungan, Cabang(Kode), Tgl Aktual, Tgl Upload, Ket]</span><br>
                                                                                        <?php $i = 1; ?>
                                                                                        <?php foreach ($detail_insentif_upload as $key => $item) : ?>
                                                                                            <span>
                                                                                                <?= $i++  ?>. [<?= (($item['project']) ? $item['project'] : '-') . ', ' . $item['kjg'] . ', ' . $item['namacbg'] . '(' . $item['cbg'] . '),' . $item['tgl'] . ', ' . $item['tgl_upload'] . ', ' . $item['status']  ?>]
                                                                                            </span><br>
                                                                                        <?php endforeach; ?>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">Rp. <?= number_format($total_insentif_upload) ?></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php $total2 = $total_insentif_kader + $total_insentif_upload ?>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line text-center"><strong>Total :</strong></td>
                                                                        <td class="thick-line text-center"><b><?php echo 'Rp. ' . number_format($total2, 0, '', ','); ?></b></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Detail Penalti</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <!-- <div class="table-responsive"> -->
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">Jenis</th>
                                                                        <th class="text-center">Matrix</th>
                                                                        <th class="text-center">Qty</th>
                                                                        <th class="text-center"><strong>Harga Total</strong></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php $total_penalti_pengulangan = $honor['penalti_pengulangan'] * $penalti_pengulangan; ?>
                                                                        <td class="text-center">Pengulangan</td>
                                                                        <td class="text-center">Rp. <?= number_format($honor['penalti_pengulangan']) ?></td>
                                                                        <td class="text-center">
                                                                            <div class="tooltip-cst">
                                                                                <?= $penalti_pengulangan ?>
                                                                                <?php if (!empty($detail_penalti_pengulangan)) : ?>
                                                                                    <span class="tooltiptext-cst" style="width: 30em;">
                                                                                        <span>[Project, Kunjungan, Cabang(Kode)]</span><br>
                                                                                        <?php $i = 1; ?>
                                                                                        <?php foreach ($detail_penalti_pengulangan as $key => $item) : ?>
                                                                                            <span>
                                                                                                <?= $i++  ?>. [<?= (($item['project']) ? $item['project'] : '-') . ', ' . $item['kjg'] . ', ' . $item['namacbg'] . '(' . $item['cbg'] . ')' ?>]
                                                                                            </span><br>
                                                                                        <?php endforeach; ?>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">Rp. <?= number_format($total_penalti_pengulangan); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $total_penalti_upload = $honor['penalti_keterlambatan_upload'] * $penalti_keterlambatan_upload; ?>
                                                                        <td class="text-center">Keterlambatan upload kuesioner dan rekaman</td>
                                                                        <td class="text-center">Rp. <?= number_format($honor['penalti_keterlambatan_upload']) ?></td>
                                                                        <td class="text-center">
                                                                            <div class="tooltip-cst">
                                                                                <?= $penalti_keterlambatan_upload ?>
                                                                                <?php if (!empty($detail_penalti_keterlambatan_upload)) : ?>
                                                                                    <span class="tooltiptext-cst" style="width: 60em;">
                                                                                        <span>[Project, Kunjungan, Cabang(Kode), Tgl Aktual, Tgl Upload, Ket]</span><br>
                                                                                        <?php $i = 1; ?>
                                                                                        <?php foreach ($detail_penalti_keterlambatan_upload as $key => $item) : ?>
                                                                                            <span>
                                                                                                <?= $i++  ?>. [<?= (($item['project']) ? $item['project'] : '-') . ', ' . $item['kjg'] . ', ' . $item['namacbg'] . '(' . $item['cbg'] . '),' . $item['tgl'] . ', ' . $item['tgl_upload'] . ', ' . $item['status']  ?>]
                                                                                            </span><br>
                                                                                        <?php endforeach; ?>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">Rp. <?= number_format($total_penalti_upload) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $total_penalti_timeline = $honor['penalti_keterlambatan_timeline'] * $penalti_timeline ?>
                                                                        <td class="text-center">Keterlambatan penuntasan proyek/tidak sesuai timeline</td>
                                                                        <td class="text-center">Rp. <?= number_format($honor['penalti_keterlambatan_timeline']) ?></td>
                                                                        <td class="text-center">
                                                                            <div class="tooltip-cst">
                                                                                <?= $penalti_timeline ?>
                                                                                <?php if (!empty($detail_penalti_timeline)) : ?>
                                                                                    <span class="tooltiptext-cst" style="width: 30em;">
                                                                                        <?php $i = 1; ?>
                                                                                        <?php foreach ($detail_penalti_timeline as $key => $item) : ?>
                                                                                            <span><?= $i++  ?>. <?= $key ?>: <?= $item['tanggal_selesai'] . ' - ' . $item['last_date'] ?></span><br>
                                                                                        <?php endforeach; ?>
                                                                                    </span>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                        <td class="text-center">Rp. <?= number_format($total_penalti_timeline) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $total_penalti_kader = $honor['penalti_kaderisasi'] * $penalti_kaderisasi ?>
                                                                        <td class="text-center">Tidak terpenuhi target kaderisasi</td>
                                                                        <td class="text-center">Rp. <?= number_format($honor['penalti_kaderisasi']) ?></td>
                                                                        <td class="text-center">
                                                                            <?= $penalti_kaderisasi ?>
                                                                        </td>
                                                                        </td>
                                                                        <td class="text-center">Rp. <?= number_format($total_penalti_kader) ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $total3 = $total_penalti_pengulangan + $total_penalti_upload + $total_penalti_timeline + $total_penalti_kader ?>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line"></td>
                                                                        <td class="thick-line text-center"><strong>Total :</strong></td>
                                                                        <td class="thick-line text-center"><b><?php echo 'Rp. ' . number_format($total3, 0, '', ','); ?></b></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Data Total</h3>
                                                        </div>
                                                        <div class="panel-body">
                                                            <!-- <div class="table-responsive"> -->
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center"><strong>Komponen</strong></th>
                                                                        <th class="text-center"><strong>Harga Total</strong>
                                                                            <div class="tooltip-cst">
                                                                                <i class="far fa-question-circle"></i>
                                                                                <span class="tooltiptext-cst" style="width: 20em;">
                                                                                    <span>Untuk point insentif dan penalti terhitung saat progress 100%</span>
                                                                                </span>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php
                                                                        if ($status == 'mitra' && $progress != 100) {
                                                                            $total2 = 0;
                                                                            $total3 = 0;
                                                                        }
                                                                        ?>

                                                                        <td class="text-center">Honor</td>
                                                                        <td class="text-center">
                                                                            <?php echo 'Rp. ' . number_format($total, 0, '', ','); ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">Insentif</td>
                                                                        <td class="text-center"><?php echo 'Rp. ' . number_format($total2, 0, '', ','); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-center">Penalti</td>
                                                                        <td class="text-center"><?php echo '- Rp. ' . number_format($total3, 0, '', ','); ?></td>
                                                                    </tr>

                                                                    <tr>
                                                                        <?php $total_keseluruhan =  $total + $total2  - $total3 ?>

                                                                        <td class="thick-line text-center"><strong>Total :</strong></td>
                                                                        <td class="thick-line text-center"><b><?php echo 'Rp. ' . number_format($total_keseluruhan, 0, '', ','); ?></b></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if ($status == 'mitra') : ?>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title">Pencairan</h3>
                                                            </div>
                                                            <div class="panel-body">
                                                                <!-- <div class="table-responsive"> -->
                                                                <table class="table table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-center"><strong>Term</strong></th>
                                                                            <th class="text-center">Total Persentase Pencairan</th>
                                                                            <th class="text-center">Total</th>
                                                                            <th class="text-center">
                                                                                Aktual Bayar
                                                                                <div class="tooltip-cst">
                                                                                    <i class="far fa-question-circle"></i>
                                                                                    <span class="tooltiptext-cst" style="width: 20em;">
                                                                                        <span>Arahkan cursor ke nominal untuk melihat detail</span>
                                                                                    </span>
                                                                                </div>
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        $dataTerm1 = $this->db->query("SELECT total, total_aktual FROM field_pembayaran WHERE id_data_id = '$sdm[id_data_id]' AND kodeproject = '$project' AND term = 1")->row_array();
                                                                        if ($dataTerm1) {
                                                                            $term1 = $dataTerm1['total_aktual'];
                                                                            $total_keseluruhan_term1 = $dataTerm1['total'];
                                                                        } else {
                                                                            $term1 = $total_keseluruhan * 0.25;
                                                                            $total_keseluruhan_term1 = $total_keseluruhan;
                                                                        }

                                                                        $dataTerm2 = $this->db->query("SELECT total, total_aktual FROM field_pembayaran WHERE id_data_id = '$sdm[id_data_id]' AND kodeproject = '$project' AND term = 2")->row_array();
                                                                        if ($dataTerm2) {
                                                                            $term2 = $dataTerm2['total_aktual'];
                                                                            $total_keseluruhan_term2 = $dataTerm2['total'];
                                                                        } else {
                                                                            $term2 = ($total_keseluruhan * 0.5) - $term1;
                                                                            $total_keseluruhan_term2 = $total_keseluruhan;
                                                                        }

                                                                        $dataTerm3 = $this->db->query("SELECT total, total_aktual FROM field_pembayaran WHERE id_data_id = '$sdm[id_data_id]' AND kodeproject = '$project' AND term = 3")->row_array();
                                                                        if ($dataTerm3) {
                                                                            $term3 = $dataTerm3['total_aktual'];
                                                                            $total_keseluruhan_term3 = $dataTerm3['total'];
                                                                        } else {
                                                                            $term3 = $total_keseluruhan - ($term1 + $term2);
                                                                            $total_keseluruhan_term3 = $total_keseluruhan;
                                                                        }
                                                                        ?>
                                                                        <?php if ($progress >= 0) : ?>
                                                                            <tr>
                                                                                <td class="text-center">Term 1</td>
                                                                                <td class="text-center">25%</td>
                                                                                <td class="text-center"><?php echo 'Rp. ' . number_format($total_keseluruhan_term1,  0, '', ','); ?></td>
                                                                                <td class="text-center">
                                                                                    <div class="tooltip-cst">
                                                                                        <?php echo 'Rp. ' . number_format($term1,  0, '', ','); ?>
                                                                                        <span class="tooltiptext-cst" style="width: 15em;">
                                                                                            <span>total aktual = total x 25%</span>
                                                                                        </span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>
                                                                        <?php if ($progress > 50) : ?>
                                                                            <tr>
                                                                                <td class="text-center">Term 2</td>
                                                                                <td class="text-center">25%</td>
                                                                                <td class="text-center"><?php echo 'Rp. ' . number_format($total_keseluruhan_term2,  0, '', ','); ?></td>

                                                                                <td class="text-center">
                                                                                    <div class="tooltip-cst">
                                                                                        <?php echo 'Rp. ' . number_format($term2,  0, '', ','); ?>
                                                                                        <span class="tooltiptext-cst" style="width: 20em;">
                                                                                            <span>total aktual = (total x 50%) - total aktual term 1</span>
                                                                                        </span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>
                                                                        <?php if ($progress == 100) : ?>
                                                                            <tr>
                                                                                <td class="text-center">Term 3</td>
                                                                                <td class="text-center">50%</td>
                                                                                <td class="text-center"><?php echo 'Rp. ' . number_format($total_keseluruhan_term3,  0, '', ','); ?></td>
                                                                                <td class="text-center">
                                                                                    <div class="tooltip-cst">
                                                                                        <?php echo 'Rp. ' . number_format($term3,  0, '', ','); ?>
                                                                                        <span class="tooltiptext-cst" style="width: 20em;">
                                                                                            <span>total aktual = total - (total aktual term 1 + total aktual term 2)</span>
                                                                                        </span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endif; ?>


                                                                        <tr>
                                                                            <td class="thick-line"></td>
                                                                            <td class="thick-line"></td>
                                                                            <td class="thick-line text-center"><strong>Total :</strong></td>
                                                                            <td class="thick-line text-center"><b><?php echo 'Rp. ' . number_format($term1 + $term2 + $term3,  0, '', ','); ?></b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>

                                    <div class="sign" style="display: none;">
                                        <div style="display: flex; gap: 20px; justify-content: center; margin-top: 100px;">
                                            <div style="width: 200px; height: 200px; ">
                                                <p class="text-center">Mengajukan</p>
                                                <div style="border-bottom: 1px solid black; margin-top: 80%;"></div>
                                            </div>
                                            <div style="width: 200px; height: 200px; ">
                                                <p class="text-center">Mengetahui</p>
                                                <div style="border-bottom: 1px solid black; margin-top: 80%;"></div>
                                            </div>
                                            <div style="width: 200px; height: 200px; ">
                                                <p class="text-center">Menyetujui</p>
                                                <div style="border-bottom: 1px solid black; margin-top: 80%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <input type="button" onclick="printDiv('printableArea')" class="btn btn-primary" value="PRINT REPORT" />
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
    $(function() {
        $("[rel='tooltip']").tooltip();
    });

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
