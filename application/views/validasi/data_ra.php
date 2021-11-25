
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data Kunjungan</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <!-- <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Validasi </strong></h4> -->
                <form action="<?= base_url('validasi/dataRA')?>" method="post">
                <div class="row mb">
                <div class="col-md-3">
                    <select class="selectpicker form-control" name="ssproject" id="ssproject" data-live-search="true">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <!-- <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option> -->
                        <option value="<?=$pr['kode']?>"> <?=$pr['nama']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-1">
                <div class="form-control">
                  <label>Kunjungan :</label>
                </div>
                </div>

                <div class="col-md-6">
                  <div class="form-control">
                    <section id="skunjungan">

                    </section>
                </div>
                </div>

                <div class="col-md-2">
                <button type="submit" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Tampilkan </button>
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
                      <th>Dialog</th>
                      <th>Rekaman</th>
                      <th>Layout</th>
                      <th>Equest</th>
                      <th>Slip</th>
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
                            <?php $sum=$this->db->get_where('summary_2', ['shp_id'=>$db['shp'],'project_kode'=>$db['project'],'cabang_kode'=>$db['cabang'],'kunjungan_kode'=>$db['r_kategori'],'sub_kunjungan_kode'=>$db['kunjungan']])->row_array();?>

                            <?php if($sum['r_sts_dialog']==null):?>
                            <td style="background-color:#ffc107;">
                            <?php if($sum['upload_dialog']!=null OR $sum['upload_dialog']!=''):?>
                              <center><i class="fa fa-check"></i><center>
                            <?php endif?>
                            </td>
                            <?php elseif($sum['r_sts_dialog']=='0') :?>
                            <td style="background-color:#dc3545;">
                            <?php if($sum['upload_dialog']!=null OR $sum['upload_dialog']!=''):?>
                              <center><i class="fa fa-check"></i><center>
                            <?php endif?>
                            </td>
                            <?php else :?>
                            <td style="background-color:#337ab7;">
                              <?php if($sum['upload_dialog']!=null OR $sum['upload_dialog']!=''):?>
                                <center><i class="fa fa-check"></i><center>
                              <?php endif?>
                            </td>
                            <?php endif?>

                            <?php if($db['rekaman_status']=='0' or $db['rekaman_status']=='1'):?>
                            <td style="background-color:#ffc107;">
                              <?php if($db['rekaman_status']== '1'):?>
                                <center><i class="fa fa-check"></i><center>
                              <?php endif?>
                            </td>
                            <?php elseif($db['rekaman_status']=='2') :?>
                            <td style="background-color:#dc3545;">
                                <center><i class="fa fa-check"></i><center>
                            </td>
                            <?php else :?>
                            <td style="background-color:#337ab7;">
                                <center><i class="fa fa-check"></i><center>
                            </td>
                            <?php endif?>

                            <?php if($sum['r_sts_upload_layout']==null):?>
                            <td style="background-color:#ffc107;">
                              <?php if($sum['upload_layout']!=null OR $sum['upload_layout']!=''):?>
                                <center><i class="fa fa-check"></i><center>
                              <?php endif?>
                            </td>
                            <?php elseif($sum['r_sts_upload_layout']=='0') :?>
                            <td style="background-color:#dc3545;">
                              <?php if($sum['upload_layout']!=null OR $sum['upload_layout']!=''):?>
                                <center><i class="fa fa-check"></i><center>
                              <?php endif?>
                            </td>
                            <?php else :?>
                            <td style="background-color:#337ab7;">
                                <center><i class="fa fa-check"></i><center>
                            </td>
                            <?php endif?>

                            <?php if($sum['r_sts_upload_ss']==null):?>
                            <td style="background-color:#ffc107;">
                              <?php if($sum['upload_ss']!=null OR $sum['upload_ss']!=''):?>
                                <center><i class="fa fa-check"></i><center>
                              <?php endif?>
                            </td>
                            <?php elseif($sum['r_sts_upload_ss']=='0') :?>
                            <td style="background-color:#dc3545;">
                              <?php if($sum['upload_ss']!=null OR $sum['upload_ss']!=''):?>
                                <center><i class="fa fa-check"></i><center>
                              <?php endif?>
                            </td>
                            <?php else :?>
                            <td style="background-color:#337ab7;">
                              <center><i class="fa fa-check"></i><center>
                            </td>
                            <?php endif?>

                            <?php if($sum['r_sts_upload_slip_transaksi']==null):?>
                            <td style="background-color:#ffc107;">
                              <?php if($sum['upload_slip_transaksi']!=null OR $sum['upload_slip_transaksi']!=''):?>
                                <center><i class="fa fa-check"></i><center>
                              <?php endif?>
                            </td>
                            <?php elseif($sum['r_sts_upload_slip_transaksi']=='0') :?>
                            <td style="background-color:#dc3545;">
                              <?php if($sum['upload_slip_transaksi']!=null OR $sum['upload_slip_transaksi']!=''):?>
                                <center><i class="fa fa-check"></i><center>
                              <?php endif?>
                            </td>
                            <?php else :?>
                            <td style="background-color:#337ab7;">
                              <center><i class="fa fa-check"></i><center>
                            </td>
                            <?php endif?>

                            <td>
                            <?php if($this->db->get_where('summary_2', ['shp_id'=>$db['shp'],'project_kode'=>$db['project'],'cabang_kode'=>$db['cabang'],'kunjungan_kode'=>$db['r_kategori'],'sub_kunjungan_kode'=>$db['kunjungan']])->num_rows()>=1 or $this->db->get_where('data_rekaman', ['id_user'=>$db['shp'], 'id_project'=>$db['project'], 'kode_cabang'=>$db['cabang'],'kunjungan'=>$db['r_kategori'],'id_skenario'=>$db['kunjungan']])->num_rows()>=1) : ?>
                                <a target="_blank" href="<?= base_url('validasi/lihatdata/')?><?= $db['num']?>" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-eye fa-fw"></span> Lihat </a>
                            <?php endif?>
                            </td>
                        </tr>
                      <?php endforeach?>
                  </tbody>
                </table>
                <h5><span class="fa fa-square fa-fw" style="color:#ffc107;"></span>-- Belum divalidasi</h5>
                <h5><span class="fa fa-square fa-fw" style="color:#dc3545;"></span>-- Ditolak</h5>
                <h5><span class="fa fa-square fa-fw" style="color:#337ab7;"></span>-- Diterima</h5>
              </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
