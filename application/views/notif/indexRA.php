<div class="flash-data" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Notifikasi Temuan </h3>

        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">


            <?php foreach($dialog as $db):?>
                <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <a href=""  data-toggle="modal" data-target="#askdialog<?= $db['num']?>"><strong>Temuan DIALOG!</strong> <?=$db['nama_project']?> - <?=$db['kunjunganx']?> - <?=$db['skenariox']?> - <?=$db['cabangx']?></a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="askdialog<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Temuan Kunjungan/h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Review AUVIQ </strong></h4>
                        <?php $id = $db['num'];?>
                        <form  action="<?=base_url("notifikasi/dialog/$id")?>"  method="post">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Nama Project : </label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="<?= $db['nama_project']?>" readonly>
                            <input type="hidden"  name="kode" id="kode" value="<?=$db['project_kode']?>">
                            <input type="hidden"  name="id" id="id" value="<?=$db['num']?>">
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
                            <label class="col-sm-5 control-label">Keterangan AUVIQ: </label>
                            <div class="col-sm-7">
                            <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Temuan disini..." readonly><?=$db['r_temuan_dialog']?></textarea>
                            <br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                                <h4 class="text-primary" style="margin-left:1.5rem;"> <strong> <i class="fa fa-angle-right"></i> Review RA </strong></h4>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">Keputusan Pengulangan : </label>
                                    <div class="col-sm-7">
                                        <label class="radio-inline">
                                            <input type="radio" name="ulang<?=$db['num']?>" id="ulang<?=$db['num']?>" onclick="radio(<?=$db['num']?>)" value=1>Diulang
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="ulang<?=$db['num']?>" id="ulang<?=$db['num']?>" onclick="radio(<?=$db['num']?>)" value=2 checked>Tidak Diulang
                                        </label>
                                    </div>
                                </div>

                                <br>
                                <section id="ulangi<?=$db['num']?>"></section>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">Keterangan RE: </label>
                                    <div class="col-sm-7">
                                    <textarea class="form-control" rows="10" id="keteranganRE<?=$db['num']?>" name="keteranganRE<?=$db['num']?>" placeholder="Tulis Keterangan Temuan disini..." ></textarea>
                                    <br>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- AKHIR MODAL BODY -->
                    <!-- <div class="modal-footer"> -->
                    <div class="row">
                        <div class="col-sm-12 ">
                            <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                            <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- </div> -->
                    </div>
                </div>
                </div>
                <!-- AKHIR MODAL -->
                </form>
            <?php endforeach;?>

            <?php foreach($rekaman as $db):?>
                    <div class="alert alert-warning alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <a href=""  data-toggle="modal" data-target="#askrekaman<?= $db['num']?>"><strong>Temuan REKAMAN!</strong> <?=$db['nama_project']?> - <?=$db['kunjunganx']?> - <?=$db['skenariox']?> - <?=$db['cabangx']?></a>
                    </div>

                    <!-- Modal -->
                <div class="modal fade" id="askrekaman<?= $db['num']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Review AUVIQ </strong></h4>
                        <?php $id = $db['num'];?>
                        <form  action="<?=base_url("notifikasi/rekaman/$id")?>"  method="post">
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Nama Project : </label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="<?= $db['nama_project']?>" readonly>
                            <input type="hidden"  name="kode" id="kode" value="<?=$db['project']?>">
                            <input type="hidden"  name="id" id="id" value="<?=$db['num']?>">
                            <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Kunjungan : </label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="<?= $db['kunjunganx']?>" readonly>
                            <input type="hidden"  name="kunjungan" id="kunjungan" value="<?=$db['r_kategori']?>">
                            <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Skenario : </label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="<?= $db['skenariox']?>" readonly>
                            <input type="hidden"  name="skenario" id="skenario" value="<?=$db['kunjungan']?>">
                            <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Cabang : </label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="<?= $db['cabangx']?>" readonly>
                            <input type="hidden"  name="cabang" id="cabang" value="<?=$db['cabang']?>">
                            <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Nama SHP : </label>
                            <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="<?= $db['nama_user']?>" readonly>
                            <input type="hidden"  name="shp" id="shp" value="<?=$db['shp']?>">
                            <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Keterangan AUVIQ: </label>
                            <div class="col-sm-7">
                            <textarea class="form-control" rows="10" id="keterangan" name="keterangan" placeholder="Tulis Keterangan Temuan disini..." readonly><?=$db['r_temuan_rekaman']?></textarea>
                            <br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <hr>
                                <h4 class="text-primary" style="margin-left:1.5rem;"> <strong> <i class="fa fa-angle-right"></i> Review RA </strong></h4>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">Keputusan Pengulangan : </label>
                                    <div class="col-sm-7">
                                        <label class="radio-inline">
                                            <input type="radio" name="ulang<?=$db['num']?>" id="ulang<?=$db['num']?>" onclick="radio(<?=$db['num']?>)" value=1>Diulang
                                        </label>

                                        <label class="radio-inline">
                                            <input type="radio" name="ulang<?=$db['num']?>" id="ulang<?=$db['num']?>" onclick="radio(<?=$db['num']?>)" value=2 checked>Tidak Diulang
                                        </label>
                                    </div>
                                </div>

                                <br>
                                <section id="ulangi<?=$db['num']?>"></section>
                                <div class="form-group">
                                    <label class="col-sm-5 control-label">Keterangan RE: </label>
                                    <div class="col-sm-7">
                                    <textarea class="form-control" rows="10" id="keteranganRE<?=$db['num']?>" name="keteranganRE<?=$db['num']?>" placeholder="Tulis Keterangan Temuan disini..." ></textarea>
                                    <br>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- AKHIR MODAL BODY -->
                    <!-- <div class="modal-footer"> -->
                    <div class="row">
                        <div class="col-sm-12 ">
                            <button type="submit" class="btn btn-primary pull-right ml mr mb mt" >Save changes</button>
                            <button type="button" class="btn btn-secondary pull-right ml mr mb mt" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- </div> -->
                    </div>
                </div>
                </div>
                <!-- AKHIR MODAL -->
                </form>
            <?php endforeach?>

                
                 
                
                


                


            </div>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->