    <!--main content start-->
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
    <div class="flash-data1" data-flashdata="<?= $this->session->flashdata('info1'); ?>"></div>
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data Kunjungan </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <!-- <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Data Validasi  </strong></h4> -->
                    <section id="unseen">
                      <!-- <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example"> -->
                    <br>
                    <br>
                    <div class= "table-responsive">
                    <table class=" table table-bordered table-striped table-responsive-sm" id="data_kunjungan">
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
                        <th class="ss" style="background-color:#9c9795;color:white;"><center>Screenshot<center></th>
                        <?php elseif($db['r_sts_upload_ss']=='0') :?>
                        <th class="ss" style="background-color:#dc3545;color:white;"><center>Screenshot<center></th>
                        <?php else :?>
                        <th class="ss" style="background-color:#22b540;color:white;"><center>Screenshot<center></th>
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
                                <td align="center">1.</td>
                                <td align="center"><?= $db['nama_project']?></td>
                                <td align="center"><?= $db['kunjunganx']?></td>
                                <td align="center"><?= $db['skenariox']?></td>
                                <td align="center"><?= $db['cabangx']?></td>
                                <td align="center"><?= $db['nama_user']?></td>

                                <td align="center"><?= $db['upload_dialog'];?><br>
                                    <!-- <a class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" onclick="dialog(<?= $db['num']?>)"><span class="fa fa-check fa-fw"></span> Valid </a>
                                    <a class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" onclick="tdialog(<?= $db['num']?>)"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                    <a class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#askdialog<?= $db['num']?>"><span class="fa fa-question fa-fw"></span> Input Temuan </a>
                                </td>

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


                                <td align="center"><?= $rekaman['file_rekaman']?><br>
                                     <!-- <a onclick="rekaman(<?= $sts_quest['num']?>)" align="center" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem; "><span class="fa fa-check fa-fw"></span> Valid </a>
                                    <a onclick="trekaman(<?= $sts_quest['num']?>)" align="center" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem; "><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                    <a class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#askrekaman<?= $db['num']?>"><span class="fa fa-question fa-fw"></span> Input Temuan </a>
                                </td>

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

                                <td align="center"><a class="fancybox" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_layout']?>"><?= $db['upload_layout']?></a><br>
                                     <!-- <a onclick="layout(<?= $db['num']?>)" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-check fa-fw"></span> Valid </a> -->
                                    <!-- <a onclick="tlayout(<?//= $db['num']?>)" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                     <!-- <a href=""  data-toggle="modal" data-target="#asklayout<?= $db['num']?>" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-check fa-fw"></span> Valid </a> -->
                                    <!-- <a href=""  data-toggle="modal" data-target="#asklayout<?= $db['num']?>" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                </td>

                                
                                <!-- Modal ASK LAYOUT-->
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


                                <td align="center"><a class="fancybox" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_ss']?>"><?= $db['upload_ss']?></a><br>
                                     <!-- <a onclick="ss(<?= $db['num']?>)" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-check fa-fw"></span> Valid </a> -->
                                     <!-- <a onclick="tss(<?= $db['num']?>)" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                     <!-- <a href="" data-toggle="modal" data-target="#askss<?= $db['num']?>" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                </td>

                                <!-- Modal ASK ss-->
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

                                <td align="center"><a class="fancybox" href="<?= base_url('assets/')?>file/buktitrk/<?=$db['upload_slip_transaksi']?>"><?= $db['upload_slip_transaksi']?></a><br>
                                     <!-- <a onclick="transaksi(<?= $db['num']?>)" class="btn btn-success btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-check fa-fw"></span> Valid </a> -->
                                    <!-- <a onclick="ttransaksi(<?= $db['num']?>)" class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                    <!-- <a href="" data-toggle="modal" data-target="#askslip<?= $db['num']?>"  class="btn btn-danger btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;"><span class="fa fa-times fa-fw"></span> Tolak </a> -->
                                </td>

                                <!-- Modal ASK SLIP TRANSAKSI-->
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
            <div class="col-lg-12">
              <!-- PUNYA IWAY -->
              <?php if ($rekaman['file_rekaman'] == null): ?>
                <div class="row" id="headerrekaman"  style="z-index:1;width: 100%;">
                  <div class="col-lg-12">
                    <div class="form-panel">
                      <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman  </strong></h4>
                      <center>
                        <a><strong>Rekaman Belum Diupload<strong></a>
                      </center>
                    </div>
                  </div>
                </div>
              <?php else :?>
                <div class="row" id="headerrekaman"  style="z-index:1;width: 98.2%;">
                  <!-- <div class="col-lg-12">
                    <div class="form-panel">
                      <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman  </strong></h4>
                      <center>
                        <audio controls id="rekaman">
                          <source src="http://192.168.8.101:8080/video/<?=$rekaman['file_rekaman']?>" type="audio/mp3">
                        </audio>
                      </center>
                    </div>
                  </div> -->
                  <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman  </strong></h4>
                    <center>
                      <audio width="400" controls>
                        <!-- <source src="<?=base_url('assets/file/')?>SampleVideo_1280x720_1mb.mp4" type="video/mp4"> -->
                        <source src="http://192.168.8.101:8080/video/<?=$rekaman['file_rekaman']?>" type="audio/mp3">
                      </audio>
                    </center>
                  </div>
                </div>
                </div>
                <?php endif?>
              <!-- AKHIR PUNYA IWAY -->

              <!-- <div class="row">
                <div class="col-lg-12">
                  <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman  </strong></h4>
                    <center>
                      <video width="400" controls>
                        <!-- <source src="<?=base_url('assets/file/')?>SampleVideo_1280x720_1mb.mp4" type="video/mp4"> -->
                        <source src="http://192.168.8.101:8080/video/<?=$rekaman['file_rekaman']?>" type="video/mp4">
                      </video
                    </center>
                  </div>
                </div>
              </div> -->

                <div class="row" style="z-index:0;">
                  <!-- PUNYA BANG AGIL -->
                   <!--  <div class="col-lg-3 navbar navbar-inverse" data-spy="affix" data-offset-top="197">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman  </strong></h4>
                        <audio controls id="rekaman"> 
                            <source src="http://192.168.8.101:8080/video/<?=$rekaman['file_rekaman']?>" type="audio/mp3">
                        </audio>
                        </div>
                    </div> -->
                    <!-- AKHIR PUNYA BANG AGIL -->
              <!-- </div>

          <div class="row"> -->
          <!-- <div class="col-lg-3"></div> -->
            <div class="col-lg-12" >
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> DIALOG  </strong></h4>
                    <?php if($db['upload_dialog']!=null or $db['upload_dialog']!=''):?>
                    <div style="height:1400px;"><embed src="<?= base_url('assets/file/dialog/')?><?=$db['upload_dialog']?>" type="application/pdf" width="100%" height="100%"></div>
                    <?php else :?>
                    <textarea class="form-control" name="dialog" id="dialog" placeholder="Tulis Temuan Disini.." rows="10" style="height:1400px;" readonly><?=str_replace("<br />"," ", $db['r_teks_dialog'])?></textarea>
                    <?php endif?>
                </div>
            </div>

            <!-- AWAL KOLOM -->

                <!-- <form class="form-horizontal style-form" method="post" action="<?= base_url('time/tambahAg')?>">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> SPESIFIKASI  </strong></h4>
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

                            <div class="form-row">
                                <div class="col">
                                <label>Kapan isi form </label>
                                  <select class="kapan_isi_form form-control" name="kapan_isi_form" id="kapan_isi_form" required>
                                  <option value="">Pilih ...</option>
                                  <option>Saat antri</option>
                                  <option>Saat di CS</option>
                                  <option>Saat di Mesin</option>
                                  </select>
                                </div> 

                                <div class="col">
                                  <label>Jenis form </label>
                                  <select class="jenis_form form-control" name="jenis_form" id="jenis_form" required>
                                  <option value="">Pilih ...</option>
                                  <option>Paper (manual)</option>
                                  <option>Eform</option>
                                  </select>
                                </div> 

                                <div class="col">
                                <label>Selesai isi form </label>
                                  <select class="selesai_isi_form form-control" name="selesai_isi_form" id="selesai_isi_form" required>
                                  <option value="">Pilih ...</option>
                                  </select>
                                </div>
                              </div> 

                              <br>
                              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Part Rekaman </strong></h4>
                              <div class="form-group">
                                <label class="col-sm-3 control-label">Part 1</label>
                                <div class="col-sm-8">
                                    <input type="text" name="part1" id="part1" class="form-control" required>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label">Part 2</label>
                                <div class="col-sm-8">
                                    <input type="text" name="part2" id="part2" class="form-control">
                                </div>
                              </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> FORM INPUT  </strong></h4>
                            <section id="piltd1"></section>
                            <section id="jmlpiltd"></section>
                              <div class="row">
                                  <div class="col-md-9 mb" align="right">
                                      <label for=""> <strong> Akhir TD </strong> </label>
                                  </div>
                                  <div class="col-md-3">
                                      <input type="text" class="form-control" name="akhirburek" id="akhirburek" required>
                                  </div>
                              </div>
                              <hr> -->
                              <!-- <audio controls id="rekaman" src="http://192.168.15.101:8080/video/1"></audio> -->
                              <!-- <audio controls id="rekaman"> 
                                    <source src="http://192.168.8.101:8080/video/<?=$rekaman['file_rekaman']?>" type="audio/mp3">
                              </audio> -->

                              <!-- <button onclick="window.location.href = 'http://192.168.15.101:8080/video/<?=$rekaman['file_rekaman']?>';">Download Rekaman</button> -->

                              <!-- <audio controls id="rekaman"> 
                                    <source src="http://192.168.15.101:8080/video/1.mp3" type="audio/mp3">
                              </audio> -->
                              <!-- <audio controls id="rekaman" src="https://drive.google.com/file/d/1cSEThBtSTrp3Ug-a6b5OE1UDvbs33VaQ/preview?usp=sharing"></audio> -->
                              <!-- <hr> -->
                            <!-- <a class="btn btn-round btn-primary" id="addpiltd1">Tambah</a> -->
                            <!-- <a class="btn btn-round btn-success" id="" onclick="getCurTime()">Tambah</a> -->
                        <!-- </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> FORM TEMUAN  </strong></h4>
                            <textarea class="form-control" name="temuan" id="temuan" placeholder="Tulis Temuan Disini.." rows="10"></textarea>
                        </div>
                    </div>
                </div>
            
            </div> -->
            <!-- AKHIR KOLOM -->
          
          <!-- </div> -->
          <!-- AKHIR ROW -->

          <!-- <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <div style="text-align:center;">
                    <button type="submit" class="btn btn-round btn-success"> Simpan</button>
                </div>
                </div>
            </div>
          </div>
          </form> -->
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