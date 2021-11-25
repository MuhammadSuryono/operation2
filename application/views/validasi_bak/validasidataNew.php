
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Validasi Data </h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Validasi </strong></h4>
                <form action="<?= base_url('validasi/validasidataNew')?>" method="post">
                <div class="row mb">
                <div class="col-md-3">
                    <select class="form-control" name="sproject" id="sproject">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <!-- <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option> -->
                        <option value="<?=$pr['kode']?>"> <?=$pr['nama']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control kunjungan" name="skunjungan" id="skunjungan">
                        <option value=""> Pilih Kunjungan</option>
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
                      <th>Tanggal Assign Kunjungan</th>
                      <th>Tanggal Upload</th>
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
                            <td><?= $db['waktu_assign']?></td>
                            <td><?= $db['waktu_upload']?></td>
                            <?php $sum=$this->db->get_where('summary_2', ['shp_id'=>$db['shp'],'project_kode'=>$db['project'],'cabang_kode'=>$db['cabang'],'kunjungan_kode'=>$db['r_kategori'],'sub_kunjungan_kode'=>$db['kunjungan']])->row_array();?>

                            <?php if($sum['r_sts_dialog']==null):?>
                            <td style="background-color:#ffc107;"></td>
                            <?php elseif($sum['r_sts_dialog']=='0') :?>
                            <td style="background-color:#dc3545;"></td>
                            <?php else :?>
                            <td style="background-color:#337ab7;"></td>
                            <?php endif?>

                            <?php if($db['rekaman_status']=='0'):?>
                            <td style="background-color:#ffc107;"></td>
                            <?php elseif($db['rekaman_status']=='2') :?>
                            <td style="background-color:#dc3545;"></td>
                            <?php else :?>
                            <td style="background-color:#337ab7;"></td>
                            <?php endif?>

                            <?php if($sum['r_sts_upload_layout']==null):?>
                            <td style="background-color:#ffc107;"></td>
                            <?php elseif($sum['r_sts_upload_layout']=='0') :?>
                            <td style="background-color:#dc3545;"></td>
                            <?php else :?>
                            <td style="background-color:#337ab7;"></td>
                            <?php endif?>

                            <?php if($sum['r_sts_upload_ss']==null):?>
                            <td style="background-color:#ffc107;"></td>
                            <?php elseif($sum['r_sts_upload_ss']=='0') :?>
                            <td style="background-color:#dc3545;"></td>
                            <?php else :?>
                            <td style="background-color:#337ab7;"></td>
                            <?php endif?>

                            <?php if($sum['r_sts_upload_slip_transaksi']==null):?>
                            <td style="background-color:#ffc107;"></td>
                            <?php elseif($sum['r_sts_upload_slip_transaksi']=='0') :?>
                            <td style="background-color:#dc3545;"></td>
                            <?php else :?>
                            <td style="background-color:#337ab7;"></td>
                            <?php endif?>

                            <td>
                            <?php if($db['kunjungan']=='001' OR $db['kunjungan']=='002' OR $db['kunjungan']=='003' OR $db['kunjungan'] == '051' OR $db['kunjungan'] == '052') : ?>

                               <?php //if($this->db->group_by('DATE(waktuassign)')->get_where('quest', ['shp'=>$db['shp'],'project'=>$db['project'],'cabang'=>$db['cabang'],'r_kategori'=>$db['r_kategori'], 'status!=' => '3', 'kunjungan!=' => '001','kunjungan!=' => '002', 'kunjungan!=' => '003', 'kunjungan!=' => '051', 'kunjungan!=' => '052',])->num_rows() == 0) :?>

                               <?php 
                                $shp = $db['shp'];
                                $proj = $db['project'];
                                $cab = $db['cabang'];
                                $ktg = $db['r_kategori'];
                                
                                if ($cek = $this->db->query("SELECT
                                                          * 
                                                        FROM
                                                          quest 
                                                        WHERE
                                                          project = '$proj'
                                                          AND cabang = '$cab' 
                                                          AND shp = '$shp' 
                                                          AND r_kategori = '$ktg' 
                                                          AND `status` != '3'
                                                          AND kunjungan != '001'
                                                          AND kunjungan != '002'
                                                          AND kunjungan != '003'
                                                          AND kunjungan != '051'
                                                          AND kunjungan != '052'")->num_rows() == 0) :; 
                                ?>

                                                <?php //var_dump($cek);
                                                //die; ?>

                                <a href="<?= base_url('validasi/lihatvalidasi/')?><?= $db['num']?>" class="btn btn-info btn-round btn-xs"   style="margin-right : 0.5rem;"><span class="fa fa-warning fa-fw"></span> Lihat </a>
                              
                              <?php endif?>
                            
                            <?php elseif($this->db->get_where('summary_2', ['shp_id'=>$db['shp'],'project_kode'=>$db['project'],'cabang_kode'=>$db['cabang'],'kunjungan_kode'=>$db['r_kategori'],'sub_kunjungan_kode'=>$db['kunjungan']])->num_rows()>=1 AND $this->db->get_where('data_rekaman', ['id_user'=>$db['shp'], 'id_project'=>$db['project'], 'kode_cabang'=>$db['cabang'],'kunjungan'=>$db['r_kategori'],'id_skenario'=>$db['kunjungan']])->num_rows()>=1) : 
                            ?>
                                <a href="<?= base_url('validasi/lihatvalidasi/')?><?= $db['num']?>" class="btn btn-info btn-round btn-xs" style="margin-right : 0.5rem;"><span class="fa fa-warning fa-fw"></span> Lihat </a>
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
