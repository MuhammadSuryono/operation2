<?php
    $id_user = $this->session->userdata('id_user');
?>
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Foto Temuan </strong></h4>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <div class="table table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-ordercelltop">
                  <thead>
                    <tr>
                      <!-- <th><center>No</center></th> -->
                      <th><center>Project</center></th>
                      <th><center>Cabang</center></th>
                      <th><center>Kunjungan</center></th>
                      <th><center>Skenario</center></th>
                      <th><center>Bukti Foto</center></th>
                      <th><center>Keterangan</center></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no=0; foreach($data_temuan as $db) :?>
                      <!-- <?php if($no%2==0):?>
                            <tr style="background-color : #e2e4ff;">
                            <td>
                            <?php else :?>
                            <tr>
                            <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td> -->
                            <td><?= $db['project']?></td>
                            <td><?= $db['cabang']?> - (<?=$db['kode_cabang']?>)</td>
                            <td><?= $db['kunjungan']?></td>
                            <td><?= $db['skenario']?></td>
                            <td>
                            <a class="fancybox" href="<?= base_url('assets/')?>file/foto_temuan/<?=$db['foto_temuan']?>"><?= $db['foto_temuan']?>
                            </td>
                            <td><?= $db['ket_temuan']?></td>
                        </tr>

                      <?php endforeach?>
                  </tbody>
                </table>
                </div>
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
