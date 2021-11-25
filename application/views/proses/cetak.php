<?php
$nama = 'kolom.xls';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$nama");
?>

<h5>Hasil Rekap Skill Dialog Skenario</h5>
	<table border="1">
        <thead>
            <tr>
                <?php $t=[]; foreach($fields as $fd) :?>
                    <th><?= $fd['COLUMN_NAME']?></th>
                <?php endforeach?>
            </tr>
        </thead>
           <tbody>
            <?php foreach($isifields as $ifd):?>
                <tr>
                    <?php foreach($fields as $fd) :?>
                    <td><?= $ifd[$fd['COLUMN_NAME']]?></td>
                    <?php endforeach?>
                </tr>
            <?php endforeach?>
        </tbody>
	</table>