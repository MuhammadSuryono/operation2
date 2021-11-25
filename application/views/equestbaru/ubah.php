    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Ubah Soal Equest <?=$skenario['kode_project']?> <?= $skenario['skenarioxx']?></h3>
        <div class="row mt">
            <!-- <form method="post"> -->
                <input type="hidden" name="id_pembuat_equest" id="id_pembuat_equest" value="<?=$id_pembuat_soal?>">
                
            
          <div class="col-lg-12">
            
            <?php $pgno =1; $no=1; foreach($soal_equest as $db) :?>
                 <div class="row">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan <?= $no++?></strong></h4>
                        <div class="form-horizontal style-form">

                        <?php if($db['jenis_soal']==1) :?>
                            <div class="form-group <?=$no?>">
                                <label class="col-sm-1 control-label">Pertanyaan</label>
                                <div class="col-sm-1">
                                <input type="text" class="form-control" name="kode<?=$no?>" id="kode<?=$no?>" placeholder="Kode" value="<?= $db['kode_soal']?>">
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="message<?=$no?>" id="message<?=$no?>" placeholder="Pertanyaan.." rows="1"><?= $db['soal_equest']?></textarea>
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="editbyid(<?=$db['id_soal_equest']?>, <?=$no?>)" class="btn btn-success btn-round btn-sm"><span class="fa fa-edit fa-fw"></span> Edit </button>
                                    <button onclick="hapusbyid(<?=$db['id_soal_equest']?>, <?=$no?>)" class="btn btn-danger btn-round btn-sm"><span class="fa fa-trash fa-fw"></span> Hapus </button>
                                </div>
                            </div>
                        <?php endif?>

                        <?php if($db['jenis_soal']==2) :?>
                            <div class="form-group <?=$no?>">
                                <label class="col-sm-1 control-label">Pertanyaan</label>
                                <div class="col-sm-1">
                                <input type="text" class="form-control" name="kode<?=$no?>" id="kode<?=$no?>" placeholder="Kode" value="<?= $db['kode_soal']?>">
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="message<?=$no?>" id="message<?=$no?>" placeholder="Pertanyaan.." rows="1"><?= $db['soal_equest']?></textarea>
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="editbyid(<?=$db['id_soal_equest']?>, <?=$no?>)" class="btn btn-success btn-round btn-sm"><span class="fa fa-edit fa-fw"></span> Edit </button>
                                    <button onclick="hapusbyid(<?=$db['id_soal_equest']?>, <?=$no?>)" class="btn btn-danger btn-round btn-sm"><span class="fa fa-trash fa-fw"></span> Hapus </button>
                                </div>
                            </div>
                        <?php endif?>
                        
                        <?php if($db['jenis_soal']==3 or $db['jenis_soal']==4 or $db['jenis_soal']==5) :?>
                         <div class="form-group <?=$no?>">
                         <input type="hidden" name="id<?=$no?>" id="id<?=$no?>" value="<?=$db['id_soal_equest']?>">
                                <label class="col-sm-2 control-label">Pertanyaan</label>
                                <div class="col-sm-1">
                                <input type="text" class="form-control" name="kode<?=$no?>" id="kode<?=$no?>" placeholder="Kode" value="<?= $db['kode_soal']?>">
                                </div>
                                <div class="col-sm-7">
                                    <textarea class="form-control" name="message<?=$no?>" id="message<?=$no?>" placeholder="Pertanyaan.." rows="1"><?= $db['soal_equest']?></textarea>
                                </div>
                                <div class="col-sm-2">
                                    <button onclick="editbyid(<?=$db['id_soal_equest']?>, <?=$no?>)" class="btn btn-success btn-round btn-sm"><span class="fa fa-edit fa-fw"></span> Edit </button>
                                    <button onclick="hapusbyid(<?=$db['id_soal_equest']?>, <?=$no?>)" class="btn btn-danger btn-round btn-sm"><span class="fa fa-trash fa-fw"></span> Hapus </button>
                                </div>
                            </div>

                            <section id="pilihanganda<?=$no?>">
                            <?php $pilihanganda = $this->db->get_where('data_pg_equest', ['id_soal_equest' => $db['id_soal_equest']])->result_array(); $jml =1;
                            foreach($pilihanganda as $pg => $nilai) :?>
                                <div class="form-group <?=$pgno?>">
                                    <label class="col-sm-3 control-label">Pilihan </label>
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control" name="pg<?=$pgno?>" id="pg<?=$pgno?>" value="<?=$nilai['pg_equest']?>">
                                    </div>
                                    <div class="col-sm-1">
                                    <input type="text" class="form-control" name="kodepg<?=$pgno?>" id="kodepg<?=$pgno?>" placeholder="Nilai" value="<?=$nilai['kode_pg_equest']?>">
                                    </div>
                                    <div class="col-sm-3">
                                    <input type="text" class="form-control" name="jump<?=$pgno?>" id="jump<?=$pgno?>" placeholder="Lompat ke Kode Pertanyaan" value="<?=$nilai['ket_soal']?>">
                                    </div>
                                    <div class="col-sm-2">
                                    <button onclick="editpgbyid(<?=$nilai['id_pg_equest']?>, <?=$pgno?>)" class="btn btn-success btn-round btn-sm"><span class="fa fa-edit fa-fw"></span> Edit </button>
                                    <button onclick="hapuspgbyid(<?=$nilai['id_pg_equest']?>, <?=$pgno?>)" class="btn btn-danger btn-round btn-sm"><span class="fa fa-trash fa-fw"></span> Hapus </button>
                                </div>
                                </div>
                            <?php $jml++; $pgno++; endforeach?>
                            </section>
                             <section id="jumlahpg<?=$no?>"><input type="hidden" name="jmlpg<?=$no?>" id="jmlpg<?=$no?>" value="<?=$jml?>"/></section>
                            <button type="button" class="btn btn-round btn-primary" onclick="addpgedit(<?=$no?>)"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                        <?php endif?>


                    </div>
                </div>
            <?php endforeach?>
            <!-- </form> -->
            <!-- AKHIR LIHAT -->
             

        <div class="row">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <a href="<?= base_url('equestbaru/equest')?>" class="btn btn-round btn-primary btn-block"> Selesai </a>
                    </div>
                </div>
            </div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->