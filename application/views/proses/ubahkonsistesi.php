    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data - Data Konsistensi <?=$project['nama_project']?> - <?=$skenario['nama_skenario']?></h3>
        <div class="row mt form-horizontal style-form">
          <div class="col-lg-12">

          <?php $no=0; foreach ($datacek as $db) : $no++?>
            <?php if($db['jenis_cek']==1) :?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Antar Kunjungan (<?=$no?>)</strong></h4>
                            <div class="form-group">
                            <label class="col-sm-2 control-label">Kode Soal</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" value="<?=$db['kode_cek_1']?>" disabled>
                            </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-2 control-label">Note Soal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ket_cek1" id="ket_cek1" value="<?=$db['ket_cek']?>" placeholder="Note untuk jawaban yang tidak konsisten" disabled>
                            </div>
                            <div class="col-sm-1">
                                <a href="" class="btn btn-round btn-danger" data-toggle="modal" data-target="#hapus<?= $db['id_cek']; ?>"> <span class="fa fa-trash fa-fw"></span> Hapus</a>
                            </div>
                            </div>

                        
                        </div>
                    </div>
                </div>
            <?php endif?>
            <?php if($db['jenis_cek']==2):?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Hanya Jika (<?=$no?>)</strong></h4>
                            <input type="hidden" name="cek_" id="cek_" value=2>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" value="<?=$db['kode_cek_1']?>" disabled>
                                </div>
                                <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="nilai_cek_1" id="nilai_cek_1" value="<?=$db['nilai_cek_1']?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-2 control-label">Note Soal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ket_cek1" id="ket_cek1" value="<?=$db['ket_cek']?>" placeholder="Note untuk jawaban yang tidak konsisten" disabled>
                            </div>
                            <div class="col-sm-1">
                                <a href="" class="btn btn-round btn-danger" data-toggle="modal" data-target="#hapus<?= $db['id_cek']; ?>"> <span class="fa fa-trash fa-fw"></span> Hapus</a>
                            </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            <?php endif?>

            <?php if($db['jenis_cek']==3):?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Jika Maka (<?=$no?>)</strong></h4>
                            <input type="hidden" name="cek_" id="cek_" value=3>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" value="<?=$db['kode_cek_1']?>" disabled>
                                </div>
                                <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="nilai_cek_1" id="nilai_cek_1" value="<?=$db['nilai_cek_1']?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" > Maka Kode Soal</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_cek2" id="kode_cek2" value="<?=$db['kode_cek_2']?>" disabled>
                                </div>
                                <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="nilai_cek2" id="nilai_cek2" value="<?=$db['nilai_cek_2']?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-2 control-label">Note Soal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ket_cek1" id="ket_cek1" value="<?=$db['ket_cek']?>" placeholder="Note untuk jawaban yang tidak konsisten" disabled>
                            </div>
                            <div class="col-sm-1">
                                <a href="" class="btn btn-round btn-danger" data-toggle="modal" data-target="#hapus<?= $db['id_cek']; ?>"> <span class="fa fa-trash fa-fw"></span> Hapus</a>
                            </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            <?php endif?>

            <?php if($db['jenis_cek']==4):?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Jika Tapi (<?=$no?>)</strong></h4>
                            <input type="hidden" name="cek_" id="cek_" value=4>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" value="<?=$db['kode_cek_1']?>" disabled>
                                </div>
                                <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control"name="nilai_cek1" id="nilai_cek1"  value="<?=$db['nilai_cek_1']?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" > Tapi Kode Soal</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_cek2" id="kode_cek2" value="<?=$db['kode_cek_2']?>" disabled>
                                </div>
                                <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="nilai_cek2" id="nilai_cek2" value="<?=$db['nilai_cek_2']?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-2 control-label">Note Soal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ket_cek1" id="ket_cek1" value="<?=$db['ket_cek']?>" placeholder="Note untuk jawaban yang tidak konsisten" disabled>
                            </div>
                            <div class="col-sm-1">
                                <a href="" class="btn btn-round btn-danger" data-toggle="modal" data-target="#hapus<?= $db['id_cek']; ?>"> <span class="fa fa-trash fa-fw"></span> Hapus</a>
                            </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            <?php endif?>

            <?php if($db['jenis_cek']==5):?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rentang Waktu (<?=$no?>)</strong></h4>
                        <input type="hidden" name="cek_" id="cek_" value=5>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_cek1" id="kode_cek1" value="<?=$db['kode_cek_1']?>" disabled>
                                </div>
                                <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="nilai_cek1" id="nilai_cek1" value="<?=$db['nilai_cek_1']?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" > Maka Kode Soal</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="kode_cek2" id="kode_cek2" value="<?=$db['kode_cek_2']?>" disabled>
                                </div>
                                <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="nilai_cek2" id="nilai_cek2" value="<?=$db['nilai_cek_2']?>" disabled>
                                </div>
                            </div>

                            <div class="form-group">
                            <label class="col-sm-2 control-label">Note Soal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="ket_cek1" id="ket_cek1" value="<?=$db['ket_cek']?>" placeholder="Note untuk jawaban yang tidak konsisten" disabled>
                            </div>
                            <div class="col-sm-1">
                                <a href="" class="btn btn-round btn-danger" data-toggle="modal" data-target="#hapus<?= $db['id_cek']; ?>"> <span class="fa fa-trash fa-fw"></span> Hapus</a>
                            </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            <?php endif?>

            <!-- MODAL HAPUS -->
                        <div class="modal fade" id="hapus<?= $db['id_cek']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Hapus Skenario</h4>
                                </div>
                                <div class="modal-body">
                                Yakin ingin menghapus Data Cek Konsistensi Ini<strong></strong> ?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-round" data-dismiss="modal">Batal</button>
                                <a href="<?= base_url('proses/hapuskosistensibyid/')?><?= $db['id_cek']; ?>" type="button" class="btn btn-primary btn-round">Hapus</a>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- AKHIR MODAL HAPUS -->
            <?php endforeach?>
            
            <div class="form-panel">
                <a href="<?= base_url('proses/buatkonsistensi')?>" type="button" class="btn btn-primary btn-round btn-block"> <span class="fa fa-check-circle fa-fw"></span> Selesai </a>
            </div>






          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->