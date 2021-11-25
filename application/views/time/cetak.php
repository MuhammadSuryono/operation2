<?php
$nama = 'timedelivery.xls';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$nama");
?>
<h5>Hasil Data Time Delivery</h5>
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <?php foreach($kolom as $klm) : ?>
                      <th><?=$klm['COLUMN_NAME']?></th>
                      <?php endforeach?>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($isi as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <?php foreach($kolom as $klm) : ?>

                              <?php if($klm['COLUMN_NAME']=='id_project') :?>
                              <td><?=$db['nama_project']?></td>
                                <?php elseif($klm['COLUMN_NAME']=='id_skenario') :?>
                                <td><?=$db['nama_skenario']?></td>
                                <?php elseif($klm['COLUMN_NAME']=='id_user') :?>
                                <td><?=$db['nama_user']?></td>
                                <?php elseif($klm['COLUMN_NAME']=='kode_cabang') :?>
                                <td><?=$db['nama_cabang']?> (<?= $db['kode_cabang']?>)</td>
                              <?php else :?>
                              <td><?=$db[$klm['COLUMN_NAME']]?></td>
                              <?php endif?>

                            <?php endforeach?>
                        </tr>

                      <?php endforeach?>  
                  </tbody>
                </table>
              </section>
              <?//php redirect("time/lihat");?>