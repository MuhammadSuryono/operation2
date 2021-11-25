    <!--main content start-->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
    <div class="flash-data1" data-flashdata="<?= $this->session->flashdata('info1'); ?>"></div>
    <div class="flash-data2" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Validasi Data Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">

                    <!-- <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Validasi  </strong></h4> -->
                    <section id="unseen">
                    <!-- <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example"> -->
                    <div class="table-responsive">
                    <table class=" table table-bordered table-striped" id="data_kunjungan_validasi">
                    <thead>
                        <tr>
                        <th><center>No<center></th>
                        <th><center>Project<center></th>
                        <th><center>Kunjungan<center></th>
                        <th><center>Skenario<center></th>
                        <th><center>Cabang<center></th>
                        <th><center>SHP<center></th>
                        <?php if($db['r_sts_dialog']==null):?>
                        <th class="dialog" style="background-color:#9c9795;color:white;"><center>Dialog<center></th>
                        <?php elseif($db['r_sts_dialog']=='0') :?>
                        <th class="dialog" style="background-color:#dc3545;color:white;"><center>Dialog<center></th>
                        <?php else :?>
                        <th class="dialog" style="background-color:#22b540;color:white;"><center>Dialog<center></th>
                        <?php endif?>

                        <?php if($sts_quest['rekaman_status']=='0' OR $sts_quest['rekaman_status']=='1'):?>
                        <th class="rekaman"  style="background-color:#9c9795;color:white;"><center>Rekaman<center></th>
                        <?php elseif($sts_quest['rekaman_status']=='2') :?>
                        <th class="rekaman" style="background-color:#dc3545;color:white;"><center>Rekaman<center></th>
                        <?php else :?>
                        <th class="rekaman" style="background-color:#22b540;color:white;"><center>Rekaman<center></th>
                        <?php endif?>

                        <?php if($db['r_sts_upload_layout']==null):?>
                        <th class="layout" style="background-color:#9c9795;color:white;;"><center>Layout<center></th>
                        <?php elseif($db['r_sts_upload_layout']=='0') :?>
                        <th class="layout" style="background-color:#dc3545;color:white;"><center>Layout<center></th>
                        <?php else :?>
                        <th class="layout" style="background-color:#22b540;color:white;"><center>Layout<center></th>
                        <?php endif?>

                        <?php if($db['r_sts_upload_ss']==null):?>
                        <th class="ss" style="background-color:#9c9795;color:white;"><center>Equest<center></th>
                        <?php //elseif($db['equest']=='0') :?>
                        <!-- <th class="ss" style="background-color:#dc3545;color:white;"><center>Screenshot<center></th> -->
                        <?php else :?>
                        <th class="ss" style="background-color:#22b540;color:white;"><center>Equest<center></th>
                        <?php endif?>

                        <?php if($db['r_sts_upload_slip_transaksi']==null):?>
                        <th class="transaksi" style="background-color:#9c9795;color:white;"><center>Slip Transaksi<center></th>
                        <?php elseif($db['r_sts_upload_slip_transaksi']=='0') :?>
                        <th class="transaksi" style="background-color:#dc3545;color:white;"><center>Slip Transaksi<center></th>
                        <?php else :?>
                        <th class="transaksi" style="background-color:#22b540;color:white;"><center>Slip Transaksi<center></th>
                        <?php endif?>
                        </tr>
                    </thead>
                    <tbody>
                            <tr style="background-color : #e2e4ff;">
                                <td>1.</td>
                                <td><?= $db['nama_project']?></td>
                                <td><?= $db['kunjunganx']?></td>
                                <td><?= $db['skenariox']?></td>
                                <td><?= $db['cabangx']?></td>
                                <td><?= $db['nama_user']?></td>

                                <td align='center'><?= $db['upload_dialog'];?><br>
                                    <a class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" onclick="dialog(<?= $db['num']?>)"><span class="fa fa-check fa-fw"></span> Valid </a><br>
                                    <!-- <a class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" onclick="tdialog(<?= $db['num']?>)"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                    <a class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#tolakdialog2<?= $db['num']?>"><span class="fa fa-times fa-fw"></span> Tolak </a>
                                    <a class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#askdialog<?= $db['num']?>"><span class="fa fa-question fa-fw"></span> Ask </a>
                                </td>

                                <!-- Modal TOLAK DIALOG-->
                                <div class="modal fade" id="tolakdialog2<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Tolak Dialog</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?=base_url('validasi/tolakdialog2')?>" class="form-horizontal style-form" method="post">
                                                <input type="hidden"  name="kode" id="kode" value="<?=$db['project_kode']?>">
                                                <input type="hidden"  name="id" id="id" value="<?=$sts_quest['num']?>">
                                                <input type="hidden"  name="kunjungan" id="kunjungan" value="<?=$db['kunjungan_kode']?>">
                                                <input type="hidden"  name="skenario" id="skenario" value="<?=$db['sub_kunjungan_kode']?>">
                                                <input type="hidden"  name="cabang" id="cabang" value="<?=$db['cabang_kode']?>">
                                                <input type="hidden"  name="shp" id="shp" value="<?=$db['shp_id']?>">
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Keterangan : </label>
                                              <div class="col-sm-7">
                                              <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Penolakan disini..."></textarea>
                                                <br>
                                              </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                            <div class="col-sm-12 ">
                                              <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                                              <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>

                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- AKHIR MODAL TOLAK DIALOG -->

                                <!-- Modal ASK DIALOG-->
                                <div class="modal fade" id="askdialog<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Temuan Dialog</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?=base_url('validasi/temuandialog')?>" class="form-horizontal style-form" method="post">
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Nama Project : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['nama_project']?>" readonly>
                                                <input type="hidden"  name="kode" id="kode" value="<?=$db['project_kode']?>">
                                                <input type="hidden"  name="id" id="id" value="<?=$sts_quest['num']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Kunjungan : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['kunjunganx']?>" readonly>
                                                <input type="hidden"  name="kunjungan" id="kunjungan" value="<?=$db['kunjungan_kode']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Skenario : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['skenariox']?>" readonly>
                                                <input type="hidden"  name="skenario" id="skenario" value="<?=$db['sub_kunjungan_kode']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Cabang : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['cabangx']?>" readonly>
                                                <input type="hidden"  name="cabang" id="cabang" value="<?=$db['cabang_kode']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Nama SHP : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['nama_user']?>" readonly>
                                                <input type="hidden"  name="shp" id="shp" value="<?=$db['shp_id']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Keterangan : </label>
                                              <div class="col-sm-7">
                                              <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Temuan disini..."></textarea>
                                                <br>
                                              </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                            <div class="col-sm-12 ">
                                              <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                                              <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>

                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- AKHIR MODAL ASK DIALOG -->

                                <td align='center'><?= $rekaman['file_rekaman']?><br>
                                     <a onclick="rekaman(<?= $sts_quest['num']?>)" align="center" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem; "><span class="fa fa-check fa-fw"></span> Valid </a><br>
                                    <!-- <a onclick="trekaman(<?= $sts_quest['num']?>)" align="center" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem; "><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                    <a class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#tolakrekaman2<?= $sts_quest['num']?>"><span class="fa fa-times fa-fw"></span> Tolak </a>
                                    <a class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#askrekaman<?= $db['num']?>"><span class="fa fa-question fa-fw"></span> Ask </a>
                                </td>

                                <!-- Modal TOLAK Rekaman-->
                                <div class="modal fade" id="tolakrekaman2<?= $sts_quest['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Rekaman</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="<?=base_url('validasi/tolakrekaman22')?>" class="form-horizontal style-form" method="post">
                                              <input type="hidden"  name="kode" id="kode" value="<?=$db['project_kode']?>">
                                              <input type="hidden"  name="id" id="id" value="<?=$sts_quest['num']?>">
                                              <input type="hidden"  name="kunjungan" id="kunjungan" value="<?=$db['kunjungan_kode']?>">
                                              <input type="hidden"  name="skenario" id="skenario" value="<?=$db['sub_kunjungan_kode']?>">
                                              <input type="hidden"  name="cabang" id="cabang" value="<?=$db['cabang_kode']?>">
                                              <input type="hidden"  name="shp" id="shp" value="<?=$db['shp_id']?>">
                                          <div class="form-group">
                                            <label class="col-sm-5 control-label">Keterangan : </label>
                                            <div class="col-sm-7">
                                            <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Penolakan disini..."></textarea>
                                              <br>
                                            </div>
                                          </div>
                                      </div>
                                        <div class="row">
                                          <div class="col-sm-12 ">
                                            <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                                            <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                          </div>
                                        </div>

                                        </form>
                                    </div>
                                  </div>
                                </div>
                                <!-- AKHIR MODAL TOLAK Rekaman -->

                                <!-- Modal ASK rekaman-->
                                  <div class="modal fade" id="askrekaman<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Temuan Rekaman</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                        <form  action="<?=base_url('validasi/temuanrekaman')?>" class="form-horizontal style-form" method="post">
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Nama Project : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['nama_project']?>" readonly>
                                                <input type="hidden"  name="kode" id="kode" value="<?=$db['project_kode']?>">
                                                <input type="hidden"  name="id" id="id" value="<?=$sts_quest['num']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Kunjungan : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['kunjunganx']?>" readonly>
                                                <input type="hidden"  name="kunjungan" id="kunjungan" value="<?=$db['kunjungan_kode']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Skenario : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['skenariox']?>" readonly>
                                                <input type="hidden"  name="skenario" id="skenario" value="<?=$db['sub_kunjungan_kode']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Cabang : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['cabangx']?>" readonly>
                                                <input type="hidden"  name="cabang" id="cabang" value="<?=$db['cabang_kode']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Nama SHP : </label>
                                              <div class="col-sm-7">
                                                <input type="text" class="form-control" placeholder="<?= $db['nama_user']?>" readonly>
                                                <input type="hidden"  name="shp" id="shp" value="<?=$db['shp_id']?>">
                                                <br>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Keterangan : </label>
                                              <div class="col-sm-7">
                                              <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Temuan disini..."></textarea>
                                                <br>
                                              </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                            <div class="col-sm-12 ">
                                              <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                                              <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- AKHIR MODAL ASK REKAMAN -->

                                <td align='center'>
                                <a class="fancybox" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_layout']?>"><?= $db['upload_layout']?></a><br>
                                     <a onclick="layout(<?= $db['num']?>)" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-check fa-fw"></span> Valid </a><br>
                                    <!-- <a onclick="tlayout(<?//= $db['num']?>)" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                     <!-- <a href=""  data-toggle="modal" data-target="#asklayout<?= $db['num']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-check fa-fw"></span> Valid </a> -->
                                    <a href=""  data-toggle="modal" data-target="#asklayout<?= $db['num']?>" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a>
                                </td>

                                <!-- Modal TOLAK LAYOUT-->
                                <div class="modal fade" id="asklayout<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Tolak Upload Layout</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?=base_url('validasi/temuanlayout')?>" class="form-horizontal style-form" method="post">
                                                <input type="hidden"  name="kode" id="kode" value="<?=$db['project_kode']?>">
                                                <input type="hidden"  name="id" id="id" value="<?=$sts_quest['num']?>">
                                                <input type="hidden"  name="kunjungan" id="kunjungan" value="<?=$db['kunjungan_kode']?>">
                                                <input type="hidden"  name="skenario" id="skenario" value="<?=$db['sub_kunjungan_kode']?>">
                                                <input type="hidden"  name="cabang" id="cabang" value="<?=$db['cabang_kode']?>">
                                                <input type="hidden"  name="shp" id="shp" value="<?=$db['shp_id']?>">
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Keterangan : </label>
                                              <div class="col-sm-7">
                                              <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Penolakan disini..."></textarea>
                                                <br>
                                              </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                            <div class="col-sm-12 ">
                                              <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                                              <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>

                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- AKHIR MODAL TOLAK LAYOUT -->

                                <td align='center'>
                                      <?php if($sts_quest['equest']==null):?>
                                     <strong>equest belum di isi<strong>
                                     <?php else:?>
                                      <strong>equest done<strong>
                                      <?php endif?>
                                      <br>
                                      <a onclick="ss(<?= $db['num']?>)" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-check fa-fw"></span> Valid </a>
                                </td>

                                <!-- Modal TOLAK SS-->
                                <div class="modal fade" id="askss<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Tolak Upload SS</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?=base_url('validasi/temuanss')?>" class="form-horizontal style-form" method="post">
                                                <input type="hidden"  name="kode" id="kode" value="<?=$db['project_kode']?>">
                                                <input type="hidden"  name="id" id="id" value="<?=$sts_quest['num']?>">
                                                <input type="hidden"  name="kunjungan" id="kunjungan" value="<?=$db['kunjungan_kode']?>">
                                                <input type="hidden"  name="skenario" id="skenario" value="<?=$db['sub_kunjungan_kode']?>">
                                                <input type="hidden"  name="cabang" id="cabang" value="<?=$db['cabang_kode']?>">
                                                <input type="hidden"  name="shp" id="shp" value="<?=$db['shp_id']?>">
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Keterangan : </label>
                                              <div class="col-sm-7">
                                              <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Penolakan disini..."></textarea>
                                                <br>
                                              </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                            <div class="col-sm-12 ">
                                              <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                                              <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>

                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- AKHIR MODAL TOLAK SS -->

                                <td align='center'>
                                <a class="fancybox" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_slip_transaksi']?>"><?= $db['upload_slip_transaksi']?></a>
                                  <!-- PDF STYLE -->
                                  <!-- <a target="_blank"> href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_slip_transaksi']?>"><?= $db['upload_slip_transaksi']?></a> -->
                                  <!-- AKHIR -->
                                  <br>
                                     <a onclick="transaksi(<?= $db['num']?>)" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-check fa-fw"></span> Valid </a><br>
                                    <!-- <a onclick="ttransaksi(<?= $db['num']?>)" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                    <a href="" data-toggle="modal" data-target="#askslip<?= $db['num']?>"  class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a>
                                </td>

                                <!-- Modal TOLAK SLIP TRANSAKSI-->
                                <div class="modal fade" id="askslip<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Tolak Upload SS</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <form action="<?=base_url('validasi/temuanslip')?>" class="form-horizontal style-form" method="post">
                                                <input type="hidden"  name="kode" id="kode" value="<?=$db['project_kode']?>">
                                                <input type="hidden"  name="id" id="id" value="<?=$sts_quest['num']?>">
                                                <input type="hidden"  name="kunjungan" id="kunjungan" value="<?=$db['kunjungan_kode']?>">
                                                <input type="hidden"  name="skenario" id="skenario" value="<?=$db['sub_kunjungan_kode']?>">
                                                <input type="hidden"  name="cabang" id="cabang" value="<?=$db['cabang_kode']?>">
                                                <input type="hidden"  name="shp" id="shp" value="<?=$db['shp_id']?>">
                                            <div class="form-group">
                                              <label class="col-sm-5 control-label">Keterangan : </label>
                                              <div class="col-sm-7">
                                              <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Penolakan disini..."></textarea>
                                                <br>
                                              </div>
                                            </div>
                                        </div>
                                          <div class="row">
                                            <div class="col-sm-12 ">
                                              <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                                              <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>

                                          </form>
                                      </div>
                                    </div>
                                  </div>
                                  <!-- AKHIR MODAL TOLAK SLIP TRANSAKSI -->
                            </tr>
                    </tbody>
                    </table>
                    </div>
                    <h5><span class="fa fa-square fa-fw text"></span>-- Belum divalidasi</h5>
                    <h5><span class="fa fa-square fa-fw text-danger"></span>-- Ditolak</h5>
                    <h5><span class="fa fa-square fa-fw text-success"></span>-- Diterima</h5>
                </section>

                </div>
            </div>
          </div>

        <!-- AWAL ROW -->
        <?php if($rekaman['id_skenario'] == null):?>
          <div class="col-lg-12">
          <div class="row" id="headerrekaman"  style="z-index:1;width: 99.2%;">
            <div class="col-lg-12">
              <div class="form-panel">
                <h4 class="mb text-primary"> <center><strong> <i class="fa fa-angle-right"></i> Rekaman <i class="fa fa-angle-left"></i> </strong><center></h4>
                <center>
                  <a><strong>Rekaman Belum Diupload<strong></a>
                <center>
              </div>
            </div>
          </div>
        </div>
        <?php else :?>
        <div class="col-lg-12">
          <!-- <div class="row" id="headerrekaman" style="z-index:1;width: 99.2%;"> -->
          <div class="row" id="toot">
            <div class="col-lg-12">
              <div class="form-panel">
              <h4 class="mb text-primary"> <center><strong> <i class="fa fa-angle-right"></i> Rekaman <i class="fa fa-angle-left"></i> </strong><center></h4>
                <center>
                <video controls id="rekaman">
                  <source src="http://192.168.8.101:8080/video/<?=$rekaman['file_rekaman']?>" type="video/mp4">
                </video>
                <br>
                <h4> Jangan lupa setelah isi TD klik tombol SIMPAN ! </h4>
                <center>
              </div>
            </div>
          </div>
        </div>
        <?php endif?>

          <div class="row">
          <?php if ($sts_quest['kunjungan'] == '001' OR $sts_quest['kunjungan'] == '002' ):?>
            <div class="col-lg-6" >
          <?php else :?>
            <div class="col-lg-12" >
          <?php endif?>
                <div class="form-panel">
                    <h4 class="mb text-primary"><center> <strong> <i class="fa fa-angle-right"></i> DIALOG <i class="fa fa-angle-left"></i> </strong><center></h4>
                    <?php if($db['upload_dialog']!=null or $db['upload_dialog']!=''):?>
                    <div style="height:1400px;"><embed src="<?= base_url('assets/file/dialog/')?><?=$db['upload_dialog']?>" type="application/pdf" width="100%" height="100%"></div>
                    <?php else :?>
                    <textarea class="form-control" name="dialog" id="dialog" placeholder="Tulis Temuan Disini.." rows="10" style="height:1400px;" readonly><?=str_replace("<br />"," ", $db['r_teks_dialog'])?></textarea>
                    <?php endif?>
                </div>
            </div>

            <!-- AWAL KOLOM -->
            <?php if ($sts_quest['kunjungan'] == '001' OR $sts_quest['kunjungan'] == '002' ):?>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"><center> <strong> <i class="fa fa-angle-right"></i> FORM INPUT TIME DELIVERY  <i class="fa fa-angle-left"></i> </strong><center></h4>
                      </div>
                    </div>
                </div>

                <form class="form-horizontal style-form" method="post" action="<?= base_url('time/tambah_gadai_1')?>">
                <input type="hidden" name="numberq" value="<?= $sts_quest['num']?>">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> DATA KUNJUNGAN  </strong></h4>
                            <div class="form-group">
                              <label class="col-sm-3 control-label">Jenis Form</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="formxx" id="formxx" value="<?=$sts_quest['r_kategori']?>">
                                  <input type="text" class="form-control" value="<?=$db['kunjunganx']?>" readonly>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-3 control-label">Project</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="project_td" id="project_td" value="<?=$sts_quest['project']?>">
                                  <input type="hidden" name="id_skenario_a" id="id_skenario_a" value="<?=$sts_quest['kunjungan']?>">
                                  <input type="text" class="form-control" value="<?=$db['nama_project']?>" readonly>
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="col-sm-3 control-label">Cabang</label>
                              <div class="col-sm-8">
                                  <input type="hidden" name="cabang" id="cabang" value="<?=$sts_quest['cabang']?>">
                                  <input type="text" class="form-control" value="<?=$db['cabangx']?>" readonly>
                              </div>
                            </div>

                              <br>

                        </div>
                    </div>
                </div>

                <?php if ($sts_quest['kunjungan'] == '001') : ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> FORM INPUT  </strong></h4>
                            <hr>

                              <!-- Bagian 1 -->
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <label for=""> <strong> T1A. TD ANTRI PENAKSIR </strong> </label>
                                      <input type="hidden" name="proses_1" id="proses_1" value="T1A. TD ANTRI PENAKSIR">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Selesai isi slip gadai/ diminta menunggu dipanggil </strong> </label>
                                      <input type="hidden" name="subproses_1_1" value="Selesai isi slip gadai/ diminta menunggu dipanggil">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Dipanggil penaksir </strong> </label>
                                      <input type="hidden" name="subproses_1_2" value="Dipanggil penaksir">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Durasi </strong> </label>
                                      <input type="hidden" name="subproses_1_3" value="Durasi">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_1_1" id="td_1_1" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_1_2" id="td_1_2" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_1_3" id="td_1_3" required>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <input type="text" placeholder="Penyebab  lama (jika lebih dari 10 menit)" class="form-control" name="penyebab_lama_1" id="penyebab_lama_1">
                                  </div>
                              </div>
                              <hr>
                              <br>

                              <!-- Bagian 2 -->
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <label for=""> <strong> T9A. TD PENAKSIR </strong> </label>
                                      <input type="hidden" name="proses_2" id="proses_2" value="T9A. TD PENAKSIR">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Dipanggil penaksir </strong> </label>
                                      <input type="hidden" name="subproses_2_1" value="Dipanggil penaksir">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Selesai dilayani penaksir </strong> </label>
                                      <input type="hidden" name="subproses_2_2" value="Selesai dilayani penaksir">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Durasi </strong> </label>
                                      <input type="hidden" name="subproses_2_3" value="Durasi">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_2_1" id="td_2_1" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_2_2" id="td_2_2" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_2_3" id="td_2_3" required>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <input type="text" placeholder="Penyebab  lama (jika lebih dari 10 menit)" class="form-control" name="penyebab_lama_2" id="penyebab_lama_2">
                                  </div>
                              </div>
                              <hr>
                              <br>

                              <!-- bagian 3 -->
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <label for=""> <strong> X1. TD TOTAL GADAI </strong> </label>
                                      <input type="hidden" name="proses_3" id="proses_3" value="X1. TD TOTAL GADAI">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Dipanggil penaksir </strong> </label>
                                      <input type="hidden" name="subproses_3_1" value="Dipanggil penaksir">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Menerima uang dan slip gadai dari kasir </strong> </label>
                                      <input type="hidden" name="subproses_3_2" value="Menerima uang dan slip gadai dari kasir">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Durasi </strong> </label>
                                      <input type="hidden" name="subproses_3_3" value="Durasi">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_3_1" id="td_3_1" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_3_2" id="td_3_2" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_3_3" id="td_3_3" required>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <input type="text" placeholder="Penyebab  lama (jika lebih dari 15 menit)" class="form-control" name="penyebab_lama_3" id="penyebab_lama_3">
                                  </div>
                              </div>
                              <hr>
                              <br>

                              <div class="row">
                                  <div class="col-md-8 mb" align="center">
                                      <label for=""> <strong> C01. Apakah staf Kasir = staf Penaksir? </strong> </label>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <select class="form-control" name="kasir_penaksir" required>
                                        <option value="">Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="2">TIDAK</option>
                                      </select>
                                  </div>
                              </div>

                              <br>
                              <br>

                        </div>
                    </div>
                </div>

                <?php elseif($sts_quest['kunjungan'] == '002') :?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> FORM INPUT  </strong></h4>
                            <hr>

                              <!-- Bagian 1 -->
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <label for=""> <strong> C20A. TD KASIR </strong> </label>
                                      <input type="hidden" name="proses_1" id="proses_1" value="C20A. TD KASIR">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Shp mengatakan ( ingin tebus ) </strong> </label>
                                      <input type="hidden" name="subproses_1_1" value="Shp mengatakan ( ingin tebus )">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Shp selesai pelayanan di kasir </strong> </label>
                                      <input type="hidden" name="subproses_1_2" value="Shp selesai pelayanan di kasir">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Durasi </strong> </label>
                                      <input type="hidden" name="subproses_1_3" value="Durasi">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_1_1" id="td_1_1" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_1_2" id="td_1_2" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_1_3" id="td_1_3" required>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <input type="text" placeholder="Penyebab  lama (jika lebih dari 15 menit)" class="form-control" name="penyebab_lama_1" id="penyebab_lama_1">
                                  </div>
                              </div>
                              <hr>
                              <br>

                              <!-- Bagian 2 -->
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <label for=""> <strong> G1A. TD PENGELOLA AGUNAN </strong> </label>
                                      <input type="hidden" name="proses_2" id="proses_2" value="G1A. TD PENGELOLA AGUNAN">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Shp selesai pembayaran di kasir </strong> </label>
                                      <input type="hidden" name="subproses_2_1" value="Shp selesai pembayaran di kasir">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Shp mendapatkan barang gadai </strong> </label>
                                      <input type="hidden" name="subproses_2_2" value="Shp mendapatkan barang gadai">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Durasi </strong> </label>
                                      <input type="hidden" name="subproses_2_3" value="Durasi">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_2_1" id="td_2_1" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_2_2" id="td_2_2" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_2_3" id="td_2_3" required>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <input type="text" placeholder="Penyebab  lama (jika lebih dari 10 menit)" class="form-control" name="penyebab_lama_2" id="penyebab_lama_2">
                                  </div>
                              </div>
                              <hr>
                              <br>

                              <!-- bagian 3 -->
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <label for=""> <strong> Y1. TD TOTAL TEBUS </strong> </label>
                                      <input type="hidden" name="proses_3" id="proses_3" value="Y1. TD TOTAL TEBUS">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Shp mengatakan ( ingin tebus ) ke kasir </strong> </label>
                                      <input type="hidden" name="subproses_3_1" value="Shp mengatakan ( ingin tebus ) ke kasir">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Shp mendapatkan barang gadai </strong> </label>
                                      <input type="hidden" name="subproses_3_2" value="Shp mendapatkan barang gadai">
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <label for=""> <strong> Durasi </strong> </label>
                                      <input type="hidden" name="subproses_3_3" value="Durasi">
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_3_1" id="td_3_1" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_3_2" id="td_3_2" required>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <input type="text" placeholder="hh:mm:ss" class="form-control" name="td_3_3" id="td_3_3" required>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12 mb" align="center">
                                      <input type="text" placeholder="Penyebab  lama (jika lebih dari 15 menit)" class="form-control" name="penyebab_lama_3" id="penyebab_lama_3">
                                  </div>
                              </div>
                              <hr>
                              <br>

                              <div class="row">
                                  <div class="col-md-8 mb" align="center">
                                      <label for=""> <strong> G01. Apakah staf Kasir = staf Pengelola agunan ? </strong> </label>
                                  </div>
                                  <div class="col-md-4 mb" align="center">
                                      <select class="form-control" name="kasir_penaksir" required>
                                        <option value="">Pilih</option>
                                        <option value="1">YA</option>
                                        <option value="2">TIDAK</option>
                                      </select>
                                  </div>
                              </div>

                              <br>
                              <br>

                        </div>
                    </div>
                </div>

                <?php endif ?>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> FORM TEMUAN  </strong></h4>
                            <textarea class="form-control" name="temuan" id="temuan" placeholder="Tulis Temuan Disini.." rows="10"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <?php endif?>
            <!-- AKHIR KOLOM -->

          </div>
          <!-- AKHIR ROW -->

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <div style="text-align:center;">
                    <button id="simpan_gadai" type="submit" class="btn btn-round btn-success"> Simpan</button>
                </div>
                </div>
            </div>
          </div>
          </form>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->

    <script>
    function dialog(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasidialog')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
            console.log(hasil);
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.dialog').css("background-color", "#22b540");
          }
      });
    }

    function tdialog(id){
        $.ajax({
          url:"<?= base_url('validasi/tolakdialog')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.dialog').css("background-color", "#dc3545");
          }
      });
    }

    function rekaman(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasirekaman')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
            console.log(hasil);
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.rekaman').css("background-color", "#22b540");
          }
      });
    }

    function trekaman(id){
        $.ajax({
          url:"<?= base_url('validasi/tolakrekaman')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.rekaman').css("background-color", "#dc3545");
          }
      });
    }

    function layout(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasilayout')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.layout').css("background-color", "#22b540");
          }
      });
    }

    function tlayout(id){
        $.ajax({
          url:"<?= base_url('validasi/tolaklayout')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.layout').css("background-color", "#dc3545");
          }
      });
    }

    function ss(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasiss')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.ss').css("background-color", "#22b540");
          }
      });
    }

    function tss(id){
        $.ajax({
          url:"<?= base_url('validasi/tolakss')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.ss').css("background-color", "#dc3545");
          }
      });
    }

    function transaksi(id){
        console.log(id);
        $.ajax({
          url:"<?= base_url('validasi/validasitransaksi')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'success',
                title: "Tervalidasi",
                text: "data berhasil divalidasi",
                showConfirmButton: false,
                timer: 2000
            });
            $('.transaksi').css("background-color", "#22b540");
          }
      });
    }

    function ttransaksi(id){
        $.ajax({
          url:"<?= base_url('validasi/tolaktransaksi')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              Swal({
                position: 'center',
                type: 'error',
                title: "Tolak",
                text: "data ditolak",
                showConfirmButton: false,
                timer: 2000
            });
            $('.transaksi').css("background-color", "#dc3545");
          }
      });
    }

    </script>
