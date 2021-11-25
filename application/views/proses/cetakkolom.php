<?php
$nama = 'kolom.xls';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$nama");
?>

<section id="unseen">
    <table class="table table-bordered table-striped table-condensed table-responsive-sm">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Project</th>
            <th >Nama Skenario</th>
            <th >Nama User</th>
            <?php foreach($soal as $db):?>
            <th><span class="tooltip1"><span class="tooltiptext1"><?=$db['soal_equest']?></span><?= $db['kode_soal']?></span></th>
            <?php endforeach?>
            <!-- <th>Aksi</th> -->
        </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($jawaban as $db) :?>
        <?php if($db['sts'] == 3) :?>
        <tr style="background-color : #dc3545; color: #ffffff">
        <?php else :?>
        <tr>
        <?php endif?>
            <td><?=$no?></td>
            <td><?=$project1['nama_project']?></td>
            <td><?=$skenario1 ['nama_skenario']?></td>
            <td > <?= $db['nama_user']?> </td>
            <?php $jawab = explode("|" , $db['jawaban_equest']);
            $varequest = explode(",", $db['var_equest']);
            $varequest2 = explode(",", $db['var_equest2']);
            $varequest3 = explode(",", $db['var_equest3']);
            $varequest4 = explode(",", $db['var_equest4']);
            $varequest5 = explode(",", $db['var_equest5']);
            $i = 0;
            foreach($soal as $cb) :?>
                <?php if ($cb['jenis_soal']  == 1 or $cb['jenis_soal']  == 2 ) :?>
                    <?php //$warning = array_search($cb['kode_soal'], $varequest); 
                    if (in_array($cb['kode_soal'], $varequest) or in_array($cb['kode_soal'], $varequest2) or in_array($cb['kode_soal'], $varequest3) or in_array($cb['kode_soal'], $varequest4) or in_array($cb['kode_soal'], $varequest5)):?>
                    <td style="background-color : #ffc107;"> 
                    <?php else :?>
                    <td>
                    <?php endif?>
                    <?=$jawab[$i]?> </td>
                <?php endif?>

                <?php if($cb['jenis_soal']  == 3 or $cb['jenis_soal']  == 4 ) :
                $pg = $this->db->get_where('data_pg_equest', ['kode_pg_equest' => $jawab[$i], 'id_soal_equest' => $cb['id_soal_equest']])->row_array();
                    if($pg) : ?>
                        <?php //$warning = array_search($cb['kode_soal'], $varequest)+1; 
                        if(in_array($cb['kode_soal'], $varequest) or in_array($cb['kode_soal'], $varequest2) or in_array($cb['kode_soal'], $varequest3) or in_array($cb['kode_soal'], $varequest4) or in_array($cb['kode_soal'], $varequest5)):?>
                        <td style="background-color : #ffc107;"> 
                        <?php else :?>
                        <td>
                        <?php endif?>
                    <span class="tooltip2"><span class="tooltiptext2"><?=$pg['pg_equest']?></span> <?=$jawab[$i]?> </span></td>
                    <?php else :?>
                        <?php //$warning = array_search($cb['kode_soal'], $varequest); 
                        //if($warning):
                        if(in_array($cb['kode_soal'], $varequest) or in_array($cb['kode_soal'], $varequest2) or in_array($cb['kode_soal'], $varequest3) or in_array($cb['kode_soal'], $varequest4) or in_array($cb['kode_soal'], $varequest5)):
                        ?>
                        <td style="background-color : #ffc107;"> 
                        <?php else :?>
                        <td>
                        <?php endif?>
                    <?=$jawab[$i]?> </td>
                    <?php endif?>
                <?php endif?>

                <?php if($cb['jenis_soal']  == 5) :
                        $jb = explode(" ",$jawab[$i]);
                        $tooltips = "";
                        for($bj=0; $bj<count($jb); $bj++){
                        $jb2 = $this->db->get_where('data_pg_equest',['kode_pg_equest' =>  $jb[$bj], 'id_soal_equest' => $cb['id_soal_equest']])->row_array();
                        $tooltips .= $jb2['pg_equest'].",";
                        }
                        if(in_array($cb['kode_soal'], $varequest) or in_array($cb['kode_soal'], $varequest2) or in_array($cb['kode_soal'], $varequest3) or in_array($cb['kode_soal'], $varequest4) or in_array($cb['kode_soal'], $varequest5)):?>
                        <td style="background-color : #ffc107;">
                        <?php else :?>
                        <td>
                        <?php endif?>
                        <span class="tooltip2"><span class="tooltiptext2"><?=$tooltips?></span> <?=$jawab[$i]?> </span></td>
                <?php endif?>

            <?php $i++; endforeach?>
        <!-- <td><a href="<?= base_url('proses/status/')?><?= $db['id_jawaban']?>/<?= $skenario1['id_skenario']?>/<?= $db['id_project']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Check</a></td> -->
        <!-- <td><a href="<?= base_url('proses/status1/')?><?= $db['id_jawaban']?>/<?= $skenario1['id_skenario']?>/<?= $db['id_project']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-edit fa-fw"></span>Check</a></td> -->
        </tr>
        <?php $no++; endforeach?>
        </tbody>
    </table>
    </section>    