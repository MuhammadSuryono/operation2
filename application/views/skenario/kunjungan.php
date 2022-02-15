<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Skenario Kunjungan</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Skenario Kunjungan</strong></h4>

                <form action="<?= base_url('skenario/tambahkunjungan')?>" method="post">

                <div class="row">

                    <div class="col-sm-3">
                        <select name="project1" id="project1" class="selectpicker form-control" data-live-search="true">
                            <option value=""> Pilih Project </option>
                            <?php foreach($project as $pr) :?>
                            <option value="<?=$pr['kode_project']?>"> <?= $pr['nama_project']?> </option>
                            <?php endforeach?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <select name="kunjungan" id="kunjungan" class="selectpicker form-control" data-live-search="true">
                            <option value=""> Pilih Kunjungan </option>
                            <?php foreach($skenario as $pr) :?>
                            <option value="<?=$pr['kode']?>"> <?= $pr['nama']?> </option>
                            <?php endforeach?>
                        </select>
                    </div>

                    <section id="jumlah"><label class="col-lg-2 control-label jumlah"></label></section>

                    <div class="col-md-3">
                      <button type="button" id="buatskenario" name="buatskenario" class="btn btn-round btn-primary pull-right"><i class="fa fa-plus fa-fw"></i> tambah skenario </button>
                    </div>

                </div>

          <br>
          <section id="allskenario">

          </section>

                <br>
                  <button type="submit" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Simpan </button>
                </form>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th><center>Kunjungan</center></th>
                      <th><center>Skenario</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $no = 0; foreach($viewskenario as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td><center>
                      <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;"><center>
                      <?php endif?>
                         <?= ++$no?><center></td>
                         <td><center><?= $db['nama_project']?><center></td>
                         <td><center><?= $db['nama_kunjungan']?><center></td>
                         <td><center><?= $db['skenariox']?><center></td>
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
