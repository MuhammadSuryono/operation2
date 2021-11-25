<div class="flash-data4" data-flashdata="<?= $this->session->flashdata('hapus'); ?>"></div>
<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> HAPUS TD</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Hapus Data Time Delivery </strong></h4>
              <form action="<?= base_url('validasi/hapusTd')?>" method="post">
                <div class="row mb">
                <div class="col-md-3">
                    <select class="selectpicker form-control" name="ssprojecthapus" id="ssprojecthapus" data-live-search="true">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <option value="<?=$pr['kode']?>"> <?=$pr['nama']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                
                <div class="col-md-3">
                  <section id="scabanghapus">
                   <select class="selectpicker form-control" name="ssprojecthapus" id="ssprojecthapus">
                        <option value=""> Pilih Cabang</option>
                    </select>
                    </section>
                </div>

                <div class="col-md-3">
                    <section id="skunjunganhapus">
                    <select class="selectpicker form-control" name="ssprojecthapus" id="ssprojecthapus">
                        <option value=""> Pilih Kunjungan</option>
                    </select>
                    </section>
                </div>

                <div class="col-md-2">
                <button type="submit" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Tampilkan </button>
                </div>
                </div>
                </form>

                <section id="unseen">
                <div class="table table-responsive">
                <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Project</th>
                      <th>Cabang</th>
                      <th>Kunjungan</th>
                      <th>Proses</th>
                      <th>Timestamp</th>
                      <th>Waktu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 0; foreach($waktutd as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                    <td><?=$db['id_project']?></td>
                    <td><?=$db['kode_cabang']?></td>
                    <td><?=$db['id_skenario']?></td>
                    <td><?=$db['proses']?></td>
                    <td><?=$db['timestamp']?></td>
                    <td><?=$db['waktu']?></td>
                  </tr>
                <?php endforeach?>
                  </tbody>
                </table>
                <a href="<?=base_url('validasi/hapusTdNya/')?><?=$idproject?>/<?=$idcabang?>/<?=$idskenario?>" class="btn btn-round btn-danger btn-sm mb">HAPUS</a>
                </div>
              </section>


            </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->