<?php $akses = $this->session->userdata('id_divisi')?>

<section id="main-content">
      <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Data Kunjungan Diulang & History Gagal Kunjungan</h3>
        
                                                  
        <div class="row mt">
          <div class="col-lg-12">

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                  <div class="row">
	            <div class="col-lg-12">
	                <div class="form-panel">
	                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Data Kunjungan Diulang & History Gagal Kunjungan </strong> </h4>
	                       <!-- Nav tabs -->
	                      <ul class="nav nav-tabs" role="tablist">
	                        <li role="presentation" class="active"><a href="#pengulangan" aria-controls="gagal" role="tab" data-toggle="tab">Kunjungan Diulang</a></li>
	                        <li role="presentation"><a href="#gagal" aria-controls="gagal" role="tab" data-toggle="tab">History Gagal Kunjungan</a></li>
	                        <li role="presentation"><a href="#penolakan" aria-controls="penolakan" role="tab" data-toggle="tab">History Penolakan</a></li>
	                      </ul>
	                      <br>


	                <div class="tab-content">
                        
                    <div role="tabpanel" class="tab-pane container-fluid active" id="pengulangan">
                          <section id="unseen">
                             <h4 class="mb text-primary"><strong><i class="fa fa-angle-right"></i> Daftar Kunjungan Diulang </strong> </h4>
                             <div class="row" style="margin-bottom: 20px">
                             	<div class="col-md-4">
				                    <select class="selectpicker form-control" name="pengulangan_project" id="pengulangan_project" data-live-search="true">
				                        <option value=""> Pilih Project</option>
				                        <?php foreach($project as $pr):?>
				                        <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option>
				                        <?php endforeach?>
				                    </select>
				                </div>
				                
				                <div class="col-md-2">
				                <button type="button" id ="viewdata_pengulangan" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Show </button>
				                </div>
				                </div>
				                <section id="datapengulangan">

              					</section>
                         </section>
                     </div>

                     <div role="tabpanel" class="tab-pane container-fluid" id="gagal">
                          <section id="unseen">
                             <h4 class="mb text-primary"><strong><i class="fa fa-angle-right"></i> History Gagal Kunjungan </strong> </h4>
                             <div class="row" style="margin-bottom: 20px">
                             	<div class="col-md-4">
				                    <select class="selectpicker form-control" name="history_project" id="history_project" data-live-search="true">
				                        <option value=""> Pilih Project</option>
				                        <?php foreach($project as $pr):?>
				                        <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option>
				                        <?php endforeach?>
				                    </select>
				                </div>
				                
				                <div class="col-md-2">
				                <button type="button" id ="viewdata_history" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Show </button>
				                </div>
                             </div>
                             <section id="datahistory">

              					</section>
                         </section>
                     </div>

                     <div role="tabpanel" class="tab-pane container-fluid" id="penolakan">
                          <section id="unseen">
                             <h4 class="mb text-primary"><strong><i class="fa fa-angle-right"></i> History Penolakan </strong> </h4>
                             <div class="row" style="margin-bottom: 20px">
                             	<div class="col-md-4">
				                    <select class="selectpicker form-control" name="penolakan_project" id="penolakan_project" data-live-search="true">
				                        <option value=""> Pilih Project</option>
				                        <?php foreach($project as $pr):?>
				                        <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option>
				                        <?php endforeach?>
				                    </select>
				                </div>
				                
				                <div class="col-md-2">
				                <button type="button" id ="viewdata_penolakan" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Show </button>
				                </div>
                             </div>
                             <section id="datapenolakan">

              					</section>
                         </section>
                     </div>
                 	
                 	</div>

	                  </div>
	              </div>
	          </div>



          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    <script>
       function setTanggalLokal($timestamp) {
	$tgl	= $timestamp;	// Ambil 10 angka awal.
	$day	= substr($tgl,-2);			// Tanggal
		if ($day=='00') { $day='-'; }
	$month	= substr($tgl,5,2);			// Bulan
	$year	= substr($tgl,0,4);			// Tahun
		if($year=='0000') { $year='';}
	 	//Set Nama Bulan :
		if 		($month=='01') {$month='Januari';}	else if ($month=='02') {$month='Februari';}
		else if ($month=='03') {$month='Maret';}	else if ($month=='04') {$month='April';}
		else if ($month=='05') {$month='Mei';}		else if ($month=='06') {$month='Juni';}
		else if ($month=='07') {$month='Juli';}		else if ($month=='08') {$month='Agustus';}
		else if ($month=='09') {$month='September';}else if ($month=='10') {$month='Oktober';}
		else if ($month=='11') {$month='November';}	else if ($month=='12') {$month='Desember';}
		else if ($month=='00') {$month=' ';}
	$tanggal = $day." ".$month." ".$year;
	return $tanggal;
 }
</script>
