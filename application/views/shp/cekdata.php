<?php
    $id_user = $this->session->userdata('id_user');
?>
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data Kunjungan</h3>
        <div class="row">
          <div class="col-lg-12">


          <div class="row">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Kunjungan </strong></h4>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                
                <section id="unseen">
                <div class="table table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Keterangan</th>
                      <th>Project</th>
                      <th>Skenario</th>
                      <th>Cabang</th>
                      <th>Kunjungan</th>
                      <th>Honor</th>
                      <th>Dialog</th>
                      <th>Rekaman</th>
                      <th>Layout</th>
                      <th>Screenshot</th>
                      <th>Slip</th>
                      <!-- <th>Aksi</th> -->
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no=0; foreach($data_dialog as $db) :?>

                            <?php $rek = $this->db->get_where('data_rekaman', ['id_project'=>$db['project_kode'], 'id_skenario' => $db['sub_kunjungan_kode'], 'kunjungan'=>$db['kunjungan_kode'], 'kode_cabang'=>$db['cabang_kode'], 'id_user'=>$id_user])->row_array();
                            $sts_quest = $this->db->get_where('quest', ['project'=>$db['project_kode'], 'kunjungan' => $db['sub_kunjungan_kode'], 'r_kategori'=>$db['kunjungan_kode'], 'cabang'=>$db['cabang_kode'], 'shp'=>$id_user])->row_array();?>

                      <?php if($no%2==0):?>
                            <tr style="background-color : #e2e4ff;">
                            <td>
                            <?php else :?>
                            <tr>
                            <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td>
                              <?php if($sts_quest['rekaman_status']=='3' AND $db['r_sts_dialog']=='1' AND $db['r_sts_upload_layout']=='1'  AND $db['r_sts_upload_ss']=='1'  AND $db['r_sts_upload_slip_transaksi']=='1') :?>
                                <a href="#" class="btn btn-success btn-round btn-sm">Tervalidasi</a>
                              <?php endif?>
                            </td>


                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['skenariox']?></td>
                            <td><?= $db['cabang']?></td>
                            <td><?= $db['kunjunganx']?></td>

                            <td><?php $cek = $this->db->get_where('honor', ['project'=>$db['project_kode'], 'cabang'=>$db['cabang_kode'], 'kunjungan'=>$db['sub_kunjungan_kode'], 'user'=>$db['shp_id']])->num_rows();
                                  if($cek>=1){
                                    $cek = $this->db->get_where('honor', ['project'=>$db['project_kode'], 'cabang'=>$db['cabang_kode'], 'kunjungan'=>$db['sub_kunjungan_kode'], 'user'=>$db['shp_id']])->row_array();
                                    echo $cek['total'];
                                  } else {
                                    $cek = $this->db->get_where('honorlk', ['project'=>$db['project_kode'], 'cabang'=>$db['cabang_kode'], 'kunjungan'=>$db['sub_kunjungan_kode'], 'user'=>$db['shp_id']])->row_array();
                                    echo $cek['total'];
                                  }
                                  ?></td>

                            <?php if($db['r_sts_dialog']==null):?>
                            <?php if($db['upload_dialog']==''):?>
                            <td class="dialog" style="background-color:#ffc107; color:white;"><?= substr(str_replace("<br />"," ", $db['r_teks_dialog']),0,250)?>
                              <!-- <a class="btn btn-warning btn-round btn-xs" href="<?=base_url('shp/lihatDialog/')?><?=$db['num']?>" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-eye fa-fw" aria-hidden="true"></span> Lihat </a> -->
                            </td>
                            <?php else :?>
                            <td class="dialog" style="background-color:#ffc107; color:white;"><?= $db['upload_dialog']?>
                              <a class="btn btn-warning btn-round btn-xs" href="<?=base_url('shp/lihatDialog/')?><?=$db['num']?>" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-eye fa-fw" aria-hidden="true"></span> Lihat </a>
                            </td>
                            <?php endif?>
                            <?php elseif($db['r_sts_dialog']=='0') :?>
                            <?php if($db['upload_dialog']==''):?>
                            <td class="dialog" style="background-color:#dc3545; color:white;"><?= substr(str_replace("<br />"," ", $db['r_teks_dialog']),0,250)?>
                              <!-- <a class="btn btn-warning btn-round btn-xs" href="<?=base_url('shp/lihatDialog/')?><?=$db['num']?>" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-eye fa-fw" aria-hidden="true"></span> Lihat </a> -->
                            </td>
                            <?php else :?>
                            <td class="dialog" style="background-color:#dc3545; color:white;"><?= $db['upload_dialog']?>
                              <a class="btn btn-warning btn-round btn-xs" href="<?=base_url('shp/lihatDialog/')?><?=$db['num']?>" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-eye fa-fw" aria-hidden="true"></span> Lihat </a>
                            </td>
                            <?php endif?>
                            <?php else :?>
                            <?php if($db['upload_dialog']==''):?>
                            <td class="dialog" style="background-color:#337ab7; color:white;"><?= substr(str_replace("<br />"," ", $db['r_teks_dialog']),0,250)?>
                              <!-- <a class="btn btn-warning btn-round btn-xs" href="<?=base_url('shp/lihatDialog/')?><?=$db['num']?>" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-eye fa-fw" aria-hidden="true"></span> Lihat </a> -->
                            </td>
                            <?php else :?>
                            <td class="dialog" style="background-color:#337ab7; color:white;"><?= $db['upload_dialog']?>
                              <a class="btn btn-warning btn-round btn-xs" href="<?=base_url('shp/lihatDialog/')?><?=$db['num']?>" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-eye fa-fw" aria-hidden="true"></span> Lihat </a>
                            </td>
                            <?php endif?>
                            <?php endif?>

                            <?php //$rek = $this->db->get_where('data_rekaman', ['id_project'=>$db['project_kode'], 'id_skenario' => $db['sub_kunjungan_kode'], 'kunjungan'=>$db['kunjungan_kode'], 'kode_cabang'=>$db['cabang_kode'], 'id_user'=>$id_user])->row_array();
                            //$sts_quest = $this->db->get_where('quest', ['project'=>$db['project_kode'], 'kunjungan' => $db['sub_kunjungan_kode'], 'r_kategori'=>$db['kunjungan_kode'], 'cabang'=>$db['cabang_kode'], 'shp'=>$id_user])->row_array();?>

                            <?php if($sts_quest['rekaman_status']=='0' OR $sts_quest['rekaman_status']=='1' OR $sts_quest['rekaman_status']=='4'):?>
                            <td class="rekaman"  style="background-color:#ffc107; color:white;">
                            <!-- <a href="" style="margin-right : 0.5rem; color:white;" data-toggle="modal" data-target="#dengar<?//=$rek['id_rekaman']; ?>"><?//=$rek['file_rekaman']?></a> -->
                            <a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/rekaman/<?=$rek['file_rekaman']?>"><?= $rek['file_rekaman']?></a>
                            </td>
                            <?php elseif($sts_quest['rekaman_status']=='2') :?>
                            <td class="rekaman" style="background-color:#dc3545; color:white;">
                            <!-- <a href="" style="margin-right : 0.5rem; color:white;" data-toggle="modal" data-target="#dengar<?//=$rek['id_rekaman']; ?>"><?//=$rek['file_rekaman']?></a> -->
                            <a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/rekaman/<?=$rek['file_rekaman']?>"><?= $rek['file_rekaman']?></a>
                            </td>
                            <?php else :?>
                            <td class="rekaman" style="background-color:#337ab7; color:white;">
                            <!-- <a href="" style="margin-right : 0.5rem; color:white;" data-toggle="modal" data-target="#dengar<?//= $rek['id_rekaman']; ?>"><?//=$rek['file_rekaman']?></a> -->
                            <a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/rekaman/<?=$rek['file_rekaman']?>"><?= $rek['file_rekaman']?></a>
                            </td>
                            <?php endif?>

                            <?php if($db['r_sts_upload_layout']==null):?>
                            <td class="layout" style="background-color:#ffc107; color:white;"><a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_layout']?>"><?= $db['upload_layout']?></a></td>
                            <?php elseif($db['r_sts_upload_layout']=='0') :?>
                            <td class="layout" style="background-color:#dc3545; color:white;">
                            <a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_layout']?>"><?= $db['upload_layout']?></a>
                            </td>
                            <?php else :?>
                            <td class="layout" style="background-color:#337ab7; color:white;"><a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_layout']?>"><?= $db['upload_layout']?></a></td>
                            <?php endif?>

                            <?php if($db['r_sts_upload_ss']==null):?>
                            <td class="ss" style="background-color:#ffc107; color:white;"><a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_ss']?>"><?= $db['upload_ss']?></td>
                            <?php elseif($db['r_sts_upload_ss']=='0') :?>
                            <td class="ss" style="background-color:#dc3545; color:white;"><a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_ss']?>"><?= $db['upload_ss']?></td>
                            <?php else :?>
                            <td class="ss" style="background-color:#337ab7; color:white;"><a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_ss']?>"><?= $db['upload_ss']?></td>
                            <?php endif?>

                            <?php if($db['r_sts_upload_slip_transaksi']==null):?>
                            <td class="transaksi" style="background-color:#ffc107; color:white;"><a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_slip_transaksi']?>"><?= $db['upload_slip_transaksi']?></td>
                            <?php elseif($db['r_sts_upload_slip_transaksi']=='0') :?>
                            <td class="transaksi" style="background-color:#dc3545; color:white;"><a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_slip_transaksi']?>"><?= $db['upload_slip_transaksi']?></td>
                            <?php else :?>
                            <td class="transaksi" style="background-color:#337ab7; color:white;"><a class="fancybox" style="color:white;" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_slip_transaksi']?>"><?= $db['upload_slip_transaksi']?></td>
                            <?php endif?>

                            <!-- <td>
                                 <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-round btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <span class="fa fa-edit fa-fw"></span>Edit <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                    <?php if($db['r_sts_dialog']=='0'):?>
                                    <li><a href="<?= base_url('shp/ubahKB/')?><?= $db['num']?>" >Dialog</a></li>
                                    <?php else :?>
                                    <li><a>Dialog</a></li>
                                    <?php endif?>

                                    <?php if($sts_quest['rekaman_status']=='2'):?>
                                    <li><a href="" data-toggle="modal" data-target="#edit<?= $rek['id_rekaman']; ?>">Rekaman</a></li>
                                    <?php else :?>
                                    <li><a>Rekaman</a></li>
                                    <?php endif?>

                                     <?php if($db['r_sts_upload_layout']=='0' or $db['r_sts_upload_ss']=='0' or $db['r_sts_upload_slip_transaksi']=='0'):?>
                                    <li><a href="<?= base_url('shp/ubahkunjunganKB/')?><?= $db['num']?>">Bukti Kunjungan</a></li>
                                    <?php else :?>
                                    <li><a>Bukti Kunjungan</a></li>
                                    <?php endif?>
                                    </ul>
                                </div>
                            </td> -->
                        </tr>

                         <!-- MODAL DENGAR -->
                        <div class="modal fade" id="dengar<?= $rek['id_rekaman']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Dengarkan Rekaman</h4>
                                </div>
                                <div class="modal-body">
                                <audio controls id="rekaman" src="<?=base_url('assets/')?>file/rekaman/<?= $rek['file_rekaman']?>"></audio>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-round" data-dismiss="modal"> OK </button>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL DENGAR -->

                        <!-- MODAL EDIT -->
                        <div class="modal fade" id="edit<?= $rek['id_rekaman']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Edit Rekaman</h4>
                                </div>
                                <div class="modal-body">
                                  <form action="<?= base_url('rekaman/edit')?>" method="post" enctype='multipart/form-data'>
                                  <input type="hidden" name="id" id="id" value="<?= $rek['id_rekaman']?>">
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="kode" id="kode" value="<?= $rek['file_rekaman']?>" readonly>
                                  </div>

                                  <div class="form-group">
                                  <div class="controls">
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                      <span class="btn btn-theme02 btn-file">
                                          <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Rekaman</span>
                                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah Rekaman</span>
                                      <input type="file" class="default" name="rekaman" id="rekaman" />
                                      </span>
                                      <span class="fileupload-preview" style="margin-left:5px;"></span>
                                      <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                                      </div>
                                      <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                                      <span>Format Rekaman ( Audio/Video )
                                      </span>
                                  </div>
                                  </div>

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success btn-round"> Ubah </button>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL EDIT -->

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
