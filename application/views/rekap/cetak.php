<?php
$nama = 'rekapskill.xls';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$nama");
?>

<h5>Hasil Rekap Skill Dialog Skenario</h5>
                    <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example" border="1">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Nama Skenario</th>
                      <th>Nama Cabang</th>
                      <th>Nama SHP</th>
                      <?php foreach($skill as $sk) :?>
                      <th><?= $sk['kode_kolom']?></th>
                      <?php endforeach?>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($rekap as $db) :?>
                      <?php if($no%2!=0):?>
                          <tr>
                          <td style="background-color : #ffffff;">
                          <?php else :?>
                          <tr style="background-color : #e2e4ff;">
                          <td>
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['nama_skenario']?></td>
                            <td><?= $db['nama_cabang']?> (<?=$db['kode_cabang']?>)</td>
                            <td><?= $db['nama_user']?></td>
                            <?php foreach($skill as $sk) :?>
                            <td><?= $db[$sk['kode_kolom']]?></td>
                            <?php endforeach?>
                        </tr>

                      <?php endforeach?>
                  </tbody>
                </table>
              </section>