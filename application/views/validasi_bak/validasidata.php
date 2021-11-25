
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Validasi Data </h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Validasi  </strong></h4>
                <form action="<?= base_url('validasi/validasidata')?>" method="post">
                <div class="row mb">
                <div class="col-md-3">
                    <select class="form-control" name="sproject" id="sproject">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control kunjungan" name="skunjungan" id="skunjungan">
                        <option value=""> Pilih Kunjungan</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-control skenario" name="skenario" id="skenario">
                        <option value=""> Pilih Skenario</option>
                    </select>
                </div>

                <div class="col-md-2">
                <button type="submit" class="btn btn-round btn-primary pull-right" style="margin-right:0.5rem;"><i class="fa fa-search fa-fw"></i> Tampilkan </button>
                </div>
                </div>
                </form>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Project</th>
                      <th>Kunjungan</th>
                      <th>Skenario</th>
                      <th>Cabang</th>
                      <th>SHP</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($data_kunjungan as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['kunjunganx']?></td>
                            <td><?= $db['skenariox']?></td>
                            <td><?= $db['cabangx']?></td>
                            <td><?= $db['nama_user']?></td>
                            <td>
                                <a href="<?= base_url('validasi/lihatvalidasi/')?><?= $db['num']?>" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-warning fa-fw"></span> Lihat </a>
                            </td>
                        </tr>
                      <?php endforeach?>
                  </tbody>
                </table>
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
