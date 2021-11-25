<?php
$divisi = $this->session->userdata('id_divisi');
$datenow = date('Y-m-d');

$propro = $this->db->get_where('project', array('kode' => $project))->row_array();


$satu = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Kick-off Meeting'")->row_array();
$dua = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Persiapan Fieldwork'")->row_array();
$empat = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Data Processing'")->row_array();
$lima = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Analisis Data'")->row_array();
$enam = $this->db->query("SELECT *, a.id AS idku FROM project_plan a JOIN task b ON a.task_id=b.id WHERE a.project_kode='$project' AND b.kegiatan='Laporan'")->row_array();

$all = $this->db->query("SELECT * FROM `cabang` a JOIN skenario b on a.project=b.project WHERE a.project='$project' AND b.att IN ('001', '002', '003', '004', '051', '052', '053', '054', '094')")->num_rows();
$done = $this->db->query("SELECT * FROM `quest` WHERE project = '$project' AND kunjungan IN ('001', '002', '003', '004', '051', '052', '053', '054', '094') AND status='3'")->num_rows();

$hitung = ($done/$all)*100;
// $hitung = 100;
$cek = number_format($hitung, 0)."%";
?>

<style>
  meter::-webkit-meter-bar {
  background: none;
  background-color: lightgrey;
  box-shadow: 0 3px 3px -3px #333 inset;
}

meter::-webkit-meter-optimum-value{
  box-shadow: 0 3px 3px -3px #999 inset;
  background-image: linear-gradient( 90deg,  #F1F70D 100%, #00FFCC 95%, #00FFCC 100%);
  background-size: 100% 100%;
}
meter::-webkit-meter-suboptimum-value{
  box-shadow: 0 3px 3px -3px #999 inset;
  background-image: linear-gradient( 90deg,  #00FF7F 100%, #00FFCC 95%, #00FFCC 100%);
  background-size: 100% 100%;
}
  .circle-Bar {
    text-align: center;
    font-family: tahoma;
  }

  .circle-Bar .round {
    min-height: 255px;
    margin-top: 30px;
    position: relative;
    margin-bottom: 20px;
  }

  .circle-Bar .round strong{
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -50px;
    transform: translate(-50%);
    font-size: 40px;
    color: #212121;
    font-weight: 100;
  }

  .circle-Bar span{
    display: block;
    color: #999;
    font-size: 17px;
    margin-top: 10px;
  }

  .tab-content > .tab-pane:not(.active),
.pill-content > .pill-pane:not(.active) {
    display: block;
    height: 0;
    overflow-y: hidden;
}

           .switch{  
                width:10px;  
                height:10px;  
                background:#E5E5E5;  
                z-index:0;  
                margin:0;  
                padding:0;  
                appearance:none;  
                border:none;  
                cursor:pointer;  
                position:relative;  
                border-radius:100px;  
           }  
           .switch:before{  
                content: ' ';  
                position:absolute;  
                left:5px;  
                top:5px;  
                width:65px;  
                height:28px;  
                background:#FFFFFF;  
                z-index:1;  
                border-radius:95px;  
           }  
           .switch:after{  
                content:' ';  
                width:26px;  
                height:26px;  
                border-radius:86px;  
                z-index:2;  
                background:#FFFFFF;  
                position:absolute;  
                transition-duration:500ms;  
                top:6px;  
                left:6px;  
                box-shadow:0 2px 5px #999999;  
           }  
           .switchOn, .switchOn:before{  
                background:#4cd964; !important;  
           }  
           .switchOn:after{  
                left:42px;   
           } 

.contaier { width: 100%; }
.progressbar {
  padding-top: 20px;
  padding-bottom:  20px;

  counter-reset: step;
}
.progressbar li {
  list-style: none;
  display: inline-block;
  width: 13%;
  position: relative;
  text-align: center;
  cursor: pointer;
  font-weight: bold;
}
.progressbar2 li {
  list-style: none;
  display: inline-block;
  width: 13%;
  position: relative;
  text-align: center;
  cursor: pointer;
  font-weight: bold;
}
.progressbar li:before {
  content: " ";
  counter-increment: step;
  width: 80px;
  height: 80px;
  line-height : 80px;
  border: 1px solid #ddd;
  border-radius: 100%;
  display: block;
  text-align: center;
  margin: 0 auto 10px auto;
  background-color:   #DCDCDC;
  z-index : 2;

}
.progressbar li:after {
  content: "";
  position: absolute;
  width: 100%;
  height: 70px;
  background-color: #D3D3D3;
  top: 5px;
  left: -50%;
  z-index : -1;
}
.progressbar li:first-child:after {
  content: none;
}
.progressbar li.end {
  color: green;
}
.progressbar li.end:before {
  border-color: green;
  background-color: green;
  content: "\2713";
  color:#FFFFFF;
  font-size: 30px;
}
.progressbar li.semi:before {
  border-color:   #FFD700;
  background-color:   #FFD700;
  font-family: FontAwesome;
    content: "\f252";
  color:#FFFFFF;
  font-size: 30px;
} 
.progressbar li.end + li:after {
  background-color:   #90EE90;
}

.progressbar li.semiku:before {
  border-color:   #FFD700;
  background-color:   #FFD700;
    content: "<?= $cek ?>";
  color:#FFFFFF;
  font-size: 30px;
}

@media only screen and (max-width: 760px) {
  .panjangkan {
    width: 1000px;
  }
} 


</style>

<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Detail Reporting Internal</h3>
        
        <div class="row mt">

          <div class="col-lg-12">

          <div class="row mt">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

            <div class="row" >
              <div class="col-lg-12 contaier">
                <!-- <div class="form-panel balik"> -->
            <div class="table-responsive">
            <div class="panjangkan">      
            <ul class="progressbar2">
            <li  data-trigger="hover" data-toggle="popover" data-placement="top" title="Note" data-content="Status progress dapat diubah." >  <a type="button" data-toggle="modal" data-target="#ubah_status"  onclick="SetStatus(<?= $satu['idku'] ?>)">Kick-off Meeting</a>
              <br><span style="font-size: 10px;"><?= date('d M y', strtotime($satu['date_start']))." - ". date('d M y', strtotime($satu['date_finish'])); ?></span></li>
            <li data-trigger="hover" data-toggle="popover" data-placement="top" title="Note" data-content="Status progress dapat diubah." >  <a type="button"  data-toggle="modal" data-target="#ubah_status"  onclick="SetStatus(<?= $dua['idku'] ?>)">Persiapan<br> Fieldwork</a>
              <br><span style="font-size: 10px;"><?= date('d M y', strtotime($dua['date_start']))." - ".  date('d M y', strtotime($dua['date_finish'])); ?></span></li>
              <li>Fieldwork &<br> Validation</li>
              <li  data-trigger="hover" data-toggle="popover" data-placement="top" title="Note" data-content="Status progress dapat diubah."><a type="button"  data-toggle="modal" data-target="#ubah_status"  onclick="SetStatus(<?= $empat['idku'] ?>)">Data Processing</a>
                <br><span style="font-size: 10px;"><?= date('d M y', strtotime($empat['date_start']))." - ". date('d M y', strtotime($empat['date_finish'])); ?></span></li>
            <li data-trigger="hover" data-toggle="popover" data-placement="top" title="Note" data-content="Status progress dapat diubah.">  <a type="button" data-toggle="modal" data-target="#ubah_status"  onclick="SetStatus(<?= $lima['idku'] ?>)">Analisa</a>
              <br><span style="font-size: 10px;"><?= date('d M y', strtotime($lima['date_start']))." - ". date('d M y', strtotime($lima['date_finish'])); ?></span></li>
            <li data-trigger="hover" data-toggle="popover" data-placement="top" title="Note" data-content="Status progress dapat diubah.">  <a type="button" data-toggle="modal" data-target="#ubah_status"  onclick="SetStatus(<?= $enam['idku'] ?>)">Reporting</a>
              <br><span style="font-size: 10px;"><?= date('d M y', strtotime($enam['date_start']))." - ". date('d M y', strtotime($enam['date_finish'])); ?></span></li>
              <li>Project End :<br><?= date('d M Y', strtotime($propro['tanggal_end'])); ?></li>
            </ul>
            <ul class="progressbar">
              <li class="
              <?php if($satu['status'] != NULL) { 
                if($satu['status'] == 'Not Started'){ echo "belum";} else if($satu['status'] == 'On Progress') {   echo "semi";} else if($satu['status'] == 'Completed') {   echo "end";}
              } else{
                if($datenow < $satu['date_start']){ echo "belum";} else if($satu['date_start'] >= $datenow AND $datenow < $satu['date_finish']) {   echo "semi";} else if($datenow >= $satu['date_finish']) {   echo "end";}
              }  ?>">Kick-off Meeting</li>
              <li class="
              <?php if($dua['status'] != NULL){ 
                if($dua['status'] == 'Not Started'){ echo "belum";} else if($dua['status'] == 'On Progress') {   echo "semi";} else if($dua['status'] == 'Completed') {   echo "end";}
              } else {
                if($datenow < $dua['date_start']){ echo "belum";} else if($datenow >= $dua['date_start'] AND $datenow < $dua['date_finish']) {   echo "semi";} else if($datenow >= $dua['date_finish']) {   echo "end";}
              }  ?>">Persiapan Fieldwork</li>
              <li class="<?php if($done == 0){ echo "belum";} else if($done > 0 AND $hitung < 100){echo "semiku";} else if($hitung >= 100){echo "end";}  ?>">Fieldwork & Validation</li>
              <li class="
              <?php if($empat['status'] != NULL){
               if($empat['status'] == 'Not Started'){ echo "belum";} else if($empat['status'] == 'On Progress') {   echo "semi";} else if($empat['status'] == 'Completed') {   echo "end";} 
               } else {
                if($datenow < $empat['date_start']){ echo "belum";} else if($datenow >= $empat['date_start'] AND $datenow < $empat['date_finish']) {   echo "semi";} else if($datenow >= $empat['date_finish']) {   echo "end";}
               } ?>">Data Processing</li>
              <li class="
              <?php if($lima['status'] != NULL) {
               if($lima['status'] == 'Not Started'){ echo "belum";} else if($lima['status'] == 'On Progress') {   echo "semi";} else if($lima['status'] == 'Completed') {   echo "end";}
               } else {
                if($datenow < $lima['date_start']){ echo "belum";} else if($datenow >= $lima['date_start'] AND $datenow < $lima['date_finish']) {   echo "semi";} else if($datenow >= $lima['date_finish']) {   echo "end";}
               }  ?>">Analisa</li>
              <li class="
              <?php if($enam['status']) {
               if($enam['status'] == 'Not Started'){ echo "belum";} else if($enam['status'] == 'On Progress') {   echo "semi";} else if($enam['status'] == 'Completed') {   echo "end";}  
             } else {
               if($datenow < $enam['date_start']){ echo "belum";} else if($datenow >= $enam['date_start']  AND $datenow < $enam['date_finish']) {   echo "semi";} else if($datenow >= $enam['date_finish']) {   echo "end";}
             } ?>">Reporting</li>
              
              <li >&nbsp;</li>
            </ul>
          </div>
          <!-- </div> -->
        </div>
        </div>
      </div>
             
          <div class="col-lg-12">
            <!-- <div class="form-panel"> -->
                <!-- <div class="row"> -->
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Project <?php echo $detail['nama']; ?>
                <?php 
                  $db_cl = $this->load->database('db_client', TRUE);
                  $cek_pj = $db_cl->get_where('project', array('kode' => $project))->result_array();
                  if ($cek_pj == NULL) {
                 ?>
                &nbsp;<a href="<?= base_url('project/activation/'.$project) ?>" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin aktivasi project <?php echo $propro['nama']  ?>?')">Aktivasi Project</a>
                 <?php } else { ?>
                &nbsp;<a href="#" style="background-color:  #A9A9A9;" class="btn" data-trigger="hover" data-toggle="popover" data-placement="top" title="Note" data-content="Project dashboard sudah diaktivasi." disabled>Aktivasi Project</a>

                 <?php } ?>
                 <a href="<?= base_url('sinkronisasi/refresh') ?>" class="btn btn-success">Sinkronisasi</a>
                 </strong></h4>
                <!-- </div> -->

                 <?= $this->session->flashdata('info');?>
                <?php 
                $pro = $this->db->get_where('project', ['kode' => $project])->row_array();
                // var_dump($project);
                $client = $this->db->query("SELECT a.*, b.nama AS nama_bank FROM project a join bank b ON a.bank=b.kode WHERE a.kode='$project'")->row_array();
                $jml_cl = $this->db->query("SELECT * FROM cabang WHERE project='$project' AND kodebank='$client[bank]' AND provinsi IS NOT NULL")->num_rows();

                $komp = $this->db->query("SELECT a.*, b.nama AS nama_bank FROM cabang a join bank b ON a.kodebank=b.kode WHERE a.project='$project' AND a.kodebank!='$client[bank]' GROUP BY a.kodebank")->result_array();
                $jml_komp = $this->db->query("SELECT * FROM cabang WHERE project='$project' AND kodebank!='$client[bank]' AND provinsi IS NOT NULL")->num_rows();

                $cabang_cl = $this->db->query("SELECT a.*, b.nama AS nama_bank FROM cabang a join bank b ON a.kodebank=b.kode WHERE a.project='$project' AND a.kodebank='$client[bank]' AND provinsi IS NOT NULL")->result_array();
                $cabang_komp = $this->db->query("SELECT a.*, b.nama AS nama_bank FROM cabang a join bank b ON a.kodebank=b.kode WHERE a.project='$project' AND a.kodebank!='$client[bank]' AND provinsi IS NOT NULL")->result_array();
                ?>

                <div class="bg-secondary">
                <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active"><a href="#progress" aria-controls="progress" role="tab" data-toggle="tab">Progress</a></li>
                        <li role="presentation"><a href="#cabang" aria-controls="cabang" role="tab" data-toggle="tab">Cabang</a></li>

                </ul>
                <input type="hidden" name="kd_project" id="kd_project" value="<?= $project ?>">

              <div class="tab-content">
                <div role="tabpanel" class="tab-pane" id="cabang">  
                <section id="unseen">
                <div class="row mx-3">
                  <div class="col-sm-6">
                    <div class="form-panel">
                        <h3><b> <?php echo $client['nama_bank']; ?></b></h3>
                        <h5><b>Jumlah Cabang Di Evaluasi <?php echo $jml_cl; ?> Cabang</b></h5>
                        <div class="row">
                          <div class="col-sm-12">
                            <div id="cabang1" style="width: 100%; height: 100%; "></div>
                          </div>
                         </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-panel">
                        <h3><b> Kompetitor : <?php foreach($komp as $row) { echo $row['nama_bank'].", "; } ?></b></h3>
                        <h5><b>Jumlah Cabang Di Evaluasi <?php echo $jml_komp; ?> Cabang</b></h5>

                        <div class="row">
                          <div class="col-sm-12">
                            <div id="cabang2" style="width: 100%; height: 100%; "></div>
                          </div>
                         </div>
                    </div>
                  </div>

                  
                  </div>
                  
                </section>

                <section id="unseen">
                <div class="row mx-3">
                  <div class="col-sm-6">
                    <div class="form-panel">
                        <h3><b>List Cabang <?php echo $client['nama_bank']; ?></b></h3>
                        <div class="row">
                          <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-5">
                              <thead>
                               <tr>
                                <th>No</th>
                                <th>Nama Cabang</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Performance</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $no=1;
                                foreach ($cabang_cl as $dt) {
                                  ?>
                                <tr>
                                  <td><?php echo $no++; ?></td>
                                  <td><?php echo $dt['nama']; ?></td>
                                  <td><?php echo $dt['alamat']; ?></td>
                                  <td><?php echo $dt['kota']; ?></td>
                                  <td><?php echo $dt['provinsi']; ?></td>
                                  <td></td>
                                </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                          </div>
                         </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-panel">
                        <h3><b>List Cabang <?php foreach($komp as $row) { echo $row['nama_bank'].", "; } ?></b></h3>
                        <div class="row">
                          <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-6">
                              <thead>
                               <tr>
                                <th>No</th>
                                <th>Nama Cabang</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Performance</th>

                              </tr>
                              </thead>
                              <tbody>
                              <?php $no=1;
                                foreach ($cabang_komp as $dt) {
                                  ?>
                                <tr>
                                  <td><?php echo $no++; ?></td>
                                  <td><?php echo $dt['nama']; ?></td>
                                  <td><?php echo $dt['alamat']; ?></td>
                                  <td><?php echo $dt['kota']; ?></td>
                                  <td><?php echo $dt['provinsi']; ?></td>
                                  <td></td>
                                </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                          </div>
                         </div>
                    </div>
                  </div>

                  
                  </div>
                  
                </section>
            <!-- </div> -->
           </div>
           
        


      <div role="tabpanel" class="tab-pane active" id="progress">
          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Progress </strong> </h4>
                       <!-- Nav tabs -->


                      <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active"><a href="#cs" id="klik_cs" aria-controls="cs" role="tab" data-toggle="tab">Customer Service</a></li>
                        <li role="presentation"><a href="#teller" id="klik_teller" aria-controls="teller" role="tab" data-toggle="tab">Teller</a></li>

                      </ul>
                      <br>


                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                    <!-- Tab panes -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane container-fluid active" id="cs">
                          <div class="row">
                          <section id="unseen">
                             <h4 class="mb text-primary"><strong> Progress Evaluasi Customer Service </strong> </h4>
                             <div class="row circle-Bar" style="margin-bottom: 20px">
                            <?php foreach ($skenario_cs as $cs) {

                              $q_done = $this->db->query("SELECT a.* FROM quest a 
                                    JOIN skenario b ON a.kunjungan=b.att AND a.project=b.project AND a.r_kategori=b.kategori
                                    WHERE a.kunjungan IN ('001', '002', '003', '004') AND
                                      a.kunjungan NOT IN ('051', '052', '053', '054', '094') AND 
                                     a.status='3' AND a.r_kategori='$cs[ktg]' AND a.project='$project'")->num_rows();
                              // $q_all = $this->db->query("SELECT a.* FROM quest a 
                              //                             JOIN skenario b ON a.kunjungan=b.att AND a.project=b.project AND a.r_kategori=b.kategori
                              //                             WHERE a.kunjungan IN ('001', '002', '003', '004') AND
                              //                             a.kunjungan NOT IN ('051', '052', '053', '054', '094') AND 
                              //                              a.r_kategori='$cs[ktg]' AND a.project='$project'")->num_rows();
                              // $q_all = $this->db->query("SELECT c.* FROM cabang a 
                              //                             LEFT JOIN quest c ON a.kode=c.cabang AND a.project=c.project                                    
                              //                             LEFT JOIN skenario b ON c.kunjungan=b.att AND c.project=b.project AND c.r_kategori=b.kategori
                              //                             WHERE ((c.kunjungan IN ('001', '002', '003', '004') AND
                              //                             c.kunjungan NOT IN ('051', '052', '053', '054', '094')) OR c.kunjungan IS NULL) AND 
                              //                              (c.r_kategori='$cs[ktg]' OR c.r_kategori IS NULL) AND a.project='$project'")->num_rows();
                              $q_all = $this->db->query("SELECT * FROM cabang WHERE project='$project'")->num_rows();
                             // echo $q_all;
                              $progress_q = round(@($q_done/$q_all), 2);

                              ?>
                              <div class="col-sm-6 circle-Bar">
                                <div class="round" data-value="<?php echo $progress_q ?>" data-size="200" data-thickness="12">
                                  <?php $pr = $progress_q * 100; ?>
                                  <strong><?php echo $pr ?>%</strong>
                                  <span>Progress <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?></span>
                                </div>
                              </div>
                            <?php } ?>
                          </div>

                        </section>

                        <section id="unseen">
                          <div class="row">
                            <div class="col-sm-6">
                              <select name="filter" class="form-control selectpicker" id="filter_data" data-live-search="true">
                               <option value="">--Pilih Filtering Progress--</option>
                               <option value="Kanwil">Kanwil</option>
                               <option value="Provinsi">Provinsi</option>
                               <option value="Kota">Kota</option>
                               <!-- <option value="All Data">All Data</option> -->

                             </select> 
                            </div>
                            <div class="col-sm-2" style="display: none;">
                              <select class="form-control" id="add-filter">
                                <option value="">-Pilih Filter--</option>
                              </select>
                            </div>
                          </div>
                             <!-- <h4 class="mb text-primary"><strong> Progress Costumer Service </strong> </h4> -->
                             
                        </section>
                      

                            <div class="col-lg-12" id="data_lengkap"></div>

                        <?php
                        $no = 7;
                        $kate = array();
                        $nama_kate = array();
                         foreach ($skenario_cs as $cs) {
                            $kate[] = $cs['ktg'];
                            $nama_kate[] = $cs['nama'];
                            $data_pro = $this->db->query("SELECT c.*, a.nama AS nama_cabang, a.kode AS code_cabang, d.* FROM cabang a 
                                    -- LEFT JOIN quest c ON a.kode=c.cabang AND a.project=c.project
                                    -- LEFT JOIN skenario b ON c.kunjungan=b.att AND c.project=b.project AND c.r_kategori=b.kategori
                                    LEFT JOIN skenario b ON a.project=b.project
                                    LEFT JOIN quest c ON a.kode=c.cabang AND a.project=c.project AND b.att=c.kunjungan AND b.kategori=c.r_kategori
                                    
                                    LEFT JOIN data_waktu_td  d ON c.project=d.id_project AND c.cabang=d.kode_cabang AND c.kunjungan=d.id_skenario
                                    WHERE (b.att IN ('001', '002', '003', '004') AND 
                                    b.att NOT IN ('051', '052', '053', '054', '094')) AND 
                                    (b.kategori='$cs[ktg]') AND a.project='$project'
                                    GROUP BY a.project, a.kode, b.att, a.nama
                                    ORDER BY a.kode")->result_array();

                             // $data_pro = $this->db->query("SELECT c.*, a.nama AS nama_cabang, d.* FROM cabang a 
                             //        LEFT JOIN quest c ON a.kode=c.cabang AND a.project=c.project
                                    
                             //        LEFT JOIN skenario b ON c.kunjungan=b.att AND c.project=b.project AND c.r_kategori=b.kategori
                             //        LEFT JOIN data_waktu_td  d ON c.project=d.id_project AND c.cabang=d.kode_cabang AND c.kunjungan=d.id_skenario
                             //        WHERE ((c.kunjungan IN ('001', '002', '003', '004') AND 
                             //        c.kunjungan NOT IN ('051', '052', '053', '054', '094')) OR c.kunjungan IS NULL) AND 
                             //        (c.r_kategori='$cs[ktg]' OR c.r_kategori IS NULL) AND a.project='$project'
                             //        GROUP BY a.project, c.cabang, c.kunjungan, a.nama
                             //        ORDER BY a.kode")->result_array(); 

                           ?>
                          <input type="hidden" name="ktg" id="ktg" value="<?= $cs['ktg'] ?>">
                          <input type="hidden" name="pro" id="pro" value="<?= $project ?>">

                        <div class="col-sm-12" id="unseen" style="background-color: #F0FFFF; margin-top: 20px;">
                             <h4 class="mb text-primary"><strong> Status Progress <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?> </strong> </h4>
                             <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-<?php echo $no++; ?>">
                              <thead>
                               <tr>
                                <th>No</th>
                                <th>Cabang</th>
                                <th>Status</th>
                                <th>Detail</th>
                                <th>Publish</th>
                                <th>Performance</th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php $num=1; foreach ($data_pro as $db) {
                                  ?>
                                  <tr>
                                    <td><?= $num++; ?></td>
                                    <td><?= $db['nama_cabang'] ?></td>
                                    <td>
                                      <?php if ($db['status'] == '3'){
                                        echo "Proses analisa researcher";
                                      } else if ($db['status'] == '2' OR $db['status'] == '1' OR $db['status'] == '0') {
                                        echo "Proses evaluasi mystery shopper";
                                      } else if ($db['status'] == NULL) {
                                        echo "Belum Kunjungan";
                                      } ?>
                                        
                                    </td>
                                    <td>
                                      <?php if ($db['status'] == 3) {
                                         $temuan = $this->db->query("SELECT * FROM data_foto_temuan WHERE project='$project' AND cabang='$db[kode_cabang]' AND kunjungan='$db[r_kategori]' AND skenario='$db[kunjungan]'")->result_array();
                                        ?>
                                      <button type="button" class="btn btn-warning btn-round btn-sm" data-toggle="modal" data-target="#detail<?php echo $db['num'] ?>">View</button>
                                    <?php
                                       if ($temuan != NULL) {
                                          echo '<i class="fas fa-star-of-life" style="color: red;"></i>';
                                       }
                                     } ?>
                                    </td>
                                    <td><?php if ($db['publish'] == 'No' AND $db['status'] == 3) { ?>
                                       <a data-trigger="hover" data-toggle="popover" data-placement="top" title="Note" data-content="Button publish dapat diubah setelah melalui proses pengecekan data pada popup view terlebih dahulu.">
                                        <label >  
                                         <input type="checkbox" name="switch" id="switch<?php echo $db['num'] ?>" class="checkbox" value="1" style="display: none;" />  
                                         <div class="switch" style="pointer-events: none;" id="publish<?= $db['num']; ?>" onclick="publish(<?php echo $db['num']; ?>)"></div>  
                                    </label>
                                  </a>
                                    <?php  } else if ($db['publish'] == 'Yes' AND $db['status'] == 3) { ?>
                                      <label>  
                                         <input type="checkbox" name="switch" checked id="switch<?php echo $db['num'] ?>" class="checkbox" value="1" style="display: none;" />  
                                         <div class="switch switchOn" id="publish<?= $db['num']; ?>" onclick="publish(<?php echo $db['num']; ?>)"></div>  
                                      </label>
                                    <?php } ?>  </td>
                                    <td></td>
                                  </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                          </div>

                        </div>
                      <?php }
                      // var_dump($nama_kate); ?>

                        </div>
                      </div>


                        <div role="tabpanel" class="tab-pane container-fluid" id="teller" style="display: none;">
                          <section id="unseen">
                             <h4 class="mb text-primary"><strong> Progress Teller </strong> </h4>
                             <div class="row circle-Bar" style="margin-bottom: 20px">
                            <?php foreach ($skenario_tl as $tl) {

                              $q_done = $this->db->query("SELECT a.* FROM quest a 
                                    JOIN skenario b ON a.kunjungan=b.att AND a.project=b.project AND a.r_kategori=b.kategori
                                    WHERE a.status='3' AND a.kunjungan='$tl[att]' AND a.project='$project'")->num_rows();
                              // $q_all = $this->db->query("SELECT a.* FROM quest a 
                              //                             JOIN skenario b ON a.kunjungan=b.att AND a.project=b.project AND a.r_kategori=b.kategori
                              //                             WHERE a.kunjungan='$tl[att]' AND a.project='$project'")->num_rows();
                              // $q_all = $this->db->query("SELECT c.* FROM cabang a 
                              //                             LEFT JOIN quest c ON a.kode=c.cabang AND a.project=c.project                                    
                              //                             LEFT JOIN skenario b ON c.kunjungan=b.att AND c.project=b.project AND c.r_kategori=b.kategori
                              //                             WHERE (c.kunjungan='$tl[att]' OR c.kunjungan IS NULL) AND 
                              //                              a.project='$project'")->num_rows();
                              $q_all = $this->db->query("SELECT * FROM cabang WHERE project='$project'")->num_rows();
                              
                              $progress_q = round(@($q_done/$q_all), 2);

                              ?>
                              <div class="col-sm-6 circle-Bar">
                                <div class="round" data-value="<?php echo $progress_q ?>" data-size="200" data-thickness="12">
                                  <?php $pr = $progress_q * 100; ?>
                                  <strong><?php echo $pr ?>%</strong>
                                  <span>Progress <?php echo $tl['nama']; ?></span>
                                </div>
                              </div>
                            <?php } ?>

                             </section>

                             <section id="unseen">
                          <div class="row">
                            <div class="col-sm-6">
                              <select name="filter" class="form-control selectpicker" id="filter_data2" data-live-search="true">
                               <option value="">--Pilih Filtering Progress--</option>
                               <option value="Kanwil">Kanwil</option>
                               <option value="Provinsi">Provinsi</option>
                               <option value="Kota">Kota</option>
                               <!-- <option value="All Data">All Data</option> -->

                             </select> 
                            </div>
                            <div class="col-sm-2" style="display: none;">
                              <select class="form-control" id="add-filter2">
                                <option value="">-Pilih Filter--</option>
                              </select>
                            </div>
                          </div>
                             <!-- <h4 class="mb text-primary"><strong> Progress Costumer Service </strong> </h4> -->
                             
                        </section>
                      

                            <div class="col-lg-12" id="data_lengkap2"></div>

                             <?php
                        $no = 11;
                         foreach ($skenario_tl as $cs) {
                          $data_pro = $this->db->query("SELECT c.*, a.nama AS nama_cabang, a.kode AS code_cabang, d.* FROM cabang a 
                                                -- LEFT JOIN quest c ON a.kode=c.cabang AND a.project=c.project
                                                -- LEFT JOIN skenario b ON c.kunjungan=b.att AND c.project=b.project AND c.r_kategori=b.kategori
                                                LEFT JOIN skenario b ON a.project=b.project
                                                LEFT JOIN quest c ON a.kode=c.cabang AND a.project=c.project AND b.att=c.kunjungan AND b.kategori=c.r_kategori
                                                
                                                LEFT JOIN data_waktu_td  d ON c.project=d.id_project AND c.cabang=d.kode_cabang AND c.kunjungan=d.id_skenario
                                                WHERE b.att='$cs[att]' AND a.project='$project'
                                                GROUP BY a.project, a.kode, b.att, a.nama
                                                ORDER BY a.kode")->result_array();

                         // $data_pro = $this->db->query("SELECT c.*, a.nama AS nama_cabang, d.* FROM cabang a 
                         //            LEFT JOIN quest c ON a.kode=c.cabang AND a.project=c.project
                                    
                         //            LEFT JOIN skenario b ON c.kunjungan=b.att AND c.project=b.project AND c.r_kategori=b.kategori
                         //            LEFT JOIN data_waktu_td  d ON c.project=d.id_project AND c.cabang=d.kode_cabang AND c.kunjungan=d.id_skenario
                         //            WHERE (c.kunjungan='$cs[att]' OR c.kunjungan IS NULL) AND a.project='$project'
                         //            GROUP BY a.project, a.kode, c.kunjungan, a.nama
                         //            ORDER BY a.kode")->result_array(); 

                          ?>
                        <div class="col-sm-12" id="unseen" style="background-color: #F0FFFF; margin-top: 20px;">
                             <h4 class="mb text-primary"><strong> Status Progress <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?> </strong> </h4>
                             <div class="col-sm-12 table-responsive">
                            <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-<?php echo $no++; ?>">
                              <thead>
                               <tr>
                                <th>No</th>
                                <th>Cabang</th>
                                <th>Status</th>
                                <!-- <th>Jenis Form</th> -->
                                <th>Detail</th>
                                <!-- <th>Lama Pengisian Form</th>
                                <th>Lama Proses <?= $cs['nama'] ?></th>
                                <th>Temuan</th> -->
                                <th>Publish</th>
                                <th>Performance</th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php $num=1; foreach ($data_pro as $db) {
                                  ?>
                                  <tr>
                                    <td><?= $num++; ?></td>
                                    <td><?= $db['nama_cabang'] ?></td>
                                    <td>
                                      <?php if ($db['status'] == '3'){
                                        echo "Proses analisa researcher";
                                      } else if ($db['status'] == '2' OR $db['status'] == '1' OR $db['status'] == '0') {
                                        echo "Proses evaluasi mystery shopper";
                                      } else if ($db['status'] == NULL) {
                                        echo "Belum Kunjungan";
                                      } ?>
                                        
                                    </td>
                                    <td>
                                      <?php if ($db['status'] != NULL) {
                                         $temuan = $this->db->query("SELECT * FROM data_foto_temuan WHERE project='$project' AND cabang='$db[kode_cabang]' AND kunjungan='$db[r_kategori]' AND skenario='$db[kunjungan]'")->result_array();
                                        ?>
                                      <button type="button" class="btn btn-warning btn-round btn-sm" data-toggle="modal" data-target="#detail<?php echo $db['num'] ?>">View</button>
                                    <?php
                                        if ($temuan != NULL) {
                                          echo '<i class="fas fa-star-of-life" style="color: red;"></i>';
                                        }
                                     } ?>
                                    </td>
                                    <!-- <td><?= $db['jenis_form'] ?></td>
                                    <td><?= $db['full'] ?></td>
                                    <td><?= $db['akhir_td'] ?></td>
                                     -->
                                     <!-- <td></td> -->
                                    <td><?php if ($db['publish'] == 'No') { ?>
                                        <label>  
                                         <input type="checkbox" name="switch" id="switch<?php echo $db['num'] ?>" class="checkbox" value="1" style="display: none;" />  
                                         <div class="switch" style="pointer-events: none;" id="publish<?= $db['num']; ?>" onclick="publish(<?php echo $db['num']; ?>)"></div>  
                                    </label>
                                    <?php  } else if ($db['publish'] == 'Yes') { ?>
                                      <label>  
                                         <input type="checkbox" name="switch" checked id="switch<?php echo $db['num'] ?>" class="checkbox" value="1" style="display: none;" />  
                                         <div class="switch switchOn" onclick="publish(<?php echo $db['num']; ?>)"></div>  
                                      </label>
                                    <?php } ?>   </td>
                                    <td></td>

                                  </tr>
                              <?php } ?>
                              </tbody>
                            </table>
                          </div>

                        </div>
                      <?php } ?>
                        </div>




                      </div>

                



                </div>
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

<!-- Modal Detail CS-->
<?php foreach ($skenario_cs as $cs) {
                         $data_pro = $this->db->query("SELECT a.*, c.nama AS nama_cabang, d.*, c.kode AS kode_cabang FROM quest a
                                    JOIN skenario b ON a.kunjungan=b.att AND a.project=b.project AND a.r_kategori=b.kategori
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    LEFT JOIN data_waktu_td  d ON a.project=d.id_project AND a.cabang=d.kode_cabang AND a.kunjungan=d.id_skenario
                                    WHERE a.kunjungan IN ('001', '002', '003', '004') AND
                                    a.kunjungan NOT IN ('051', '052', '053', '054', '094') AND 
                                    a.r_kategori='$cs[ktg]' AND a.project='$project'
                                    GROUP BY a.project, a.cabang, a.kunjungan")->result_array();
   $num=0; foreach ($data_pro as $db) { $num++; 
    $temuan = $this->db->query("SELECT * FROM data_foto_temuan WHERE project='$project' AND cabang='$db[kode_cabang]' AND kunjungan='$db[r_kategori]' AND skenario='$db[kunjungan]'")->result_array();
    ?>

<div class="modal fade" id="detail<?php echo $db['num'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Kunjungan <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Cabang : <?php echo $db['nama_cabang']; ?></h4>
        <table class="table">
          <tr>
            <td><input type="checkbox" name="jenis<?= $db['num'] ?>" id="jenis<?= $db['num'] ?>" onchange="setPublish(<?= $db['num'] ?>)" <?php if ($db['kol_jenis'] == 'Yes') { echo "checked";} ?>></td>
            <td>Media <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?></td>
            <td> : </td>
            <td><?php echo $db['jenis_form']; ?></td>
            <td></td>
          </tr>
          <!-- <tr>
            <td>Lama Pengisian Form</td>
            <td> : </td>
            <td><?php echo $db['full']; ?></td>
          </tr> -->
          <tr>
            <td><input type="checkbox" name="td<?= $db['num'] ?>" id="td<?= $db['num'] ?>" onchange="setPublish(<?= $db['num'] ?>)" <?php if ($db['kol_td'] == 'Yes') { echo "checked";} ?>></td>
            <td>Time Delivery <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?></td>
            <td> : </td>
            <td><?php if ($db['revisi_ra'] == NULL OR $db['revisi_ra'] == '00:00:00') {
             echo $db['full'];
            } else {
             echo $db['revisi_ra'];
             } ?></td>
            <td>
              <?php
                if ($divisi == 99 OR $divisi == 1) { ?>
                  <a href="<?= base_url('time/editRA/'.$project."/".$db['kunjungan']."/".$db['cabang']) ?>" class="btn btn-primary" target="_blank">Edit TD</a>
              <?php  }
              ?>
            </td>            
          </tr>
          <tr>
            <td><input type="checkbox" name="temuan<?= $db['num'] ?>" id="temuan<?= $db['num'] ?>" onchange="setPublish(<?= $db['num'] ?>)" <?php if ($db['kol_temuan'] == 'Yes') { echo "checked";} ?>></td>
            <td>Temuan</td>
            <td> : </td>
            <td><?php $no=1; foreach ($temuan as $tm) {
              echo $no++.". ".$tm['ket_temuan'];
              if($tm['foto_temuan'] != NULL) {
              echo " &nbsp;<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/foto_temuan/" . $tm['foto_temuan'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i></a>";
              }
            echo "<br>";
            } ?></td>
            <td>
              <?php
                if ($divisi == 99 OR $divisi == 1) { ?>
                  <a href="<?= base_url('shp/upload_foto_temuanRA/'.$project."/".$db['r_kategori']."/".$db['kunjungan']."/".$db['cabang']) ?>" class="btn btn-primary" target="_blank">Input Temuan</a>
              <?php  }
              ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<?php } 
} ?>

<!-- Modal Detail Teller-->
<?php foreach ($skenario_tl as $cs) {
                         $data_pro = $this->db->query("SELECT a.*, c.nama AS nama_cabang, d.* FROM quest a 
                                    JOIN skenario b ON a.kunjungan=b.att AND a.project=b.project AND a.r_kategori=b.kategori
                                    JOIN cabang c ON a.cabang=c.kode AND a.project=c.project
                                    LEFT JOIN data_waktu_td  d ON a.project=d.id_project AND a.cabang=d.kode_cabang AND a.kunjungan=d.id_skenario
                                    WHERE a.kunjungan='$cs[att]' AND a.project='$project'
                                    GROUP BY a.project, a.cabang, a.kunjungan")->result_array();
   $num=0; foreach ($data_pro as $db) { $num++;
    $temuan = $this->db->query("SELECT * FROM data_foto_temuan WHERE project='$project' AND cabang='$db[kode_cabang]' AND kunjungan='$db[r_kategori]' AND skenario='$db[kunjungan]'")->result_array();
    ?>

<div class="modal fade" id="detail<?php echo $db['num'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Kunjungan <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Cabang : <?php echo $db['nama_cabang']; ?></h4>
        <table class="table">
          <tr>
            <td><input type="checkbox" name="jenis<?= $db['num'] ?>" id="jenis<?= $db['num'] ?>" onchange="setPublish(<?= $db['num'] ?>)" <?php if ($db['publish'] == 'Yes') { echo "checked";} ?>></td>
            <td>Media <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?></td>
            <td> : </td>
            <td><?php echo $db['jenis_form']; ?></td>
            <td></td>
          </tr>
          <tr>
            <td><input type="checkbox" name="td<?= $db['num'] ?>" id="td<?= $db['num'] ?>" onchange="setPublish(<?= $db['num'] ?>)" <?php if ($db['publish'] == 'Yes') { echo "checked";} ?>></td>
            <td>Time Delivery <?php if ($cs['nama'] == 'Komplain'){ echo "Handling Customer's Request";} else { echo $cs['nama'];} ?></td>
            <td> : </td>
            <td><?php if ($db['revisi_ra'] == NULL OR $db['revisi_ra'] == '00:00:00') {
             echo $db['full'];
            } else {
             echo $db['revisi_ra'];
             } ?></td>
             <td>
              <?php
                if ($divisi == 99 OR $divisi == 1) { ?>
                  <a href="<?= base_url('time/editRA/'.$project."/".$db['kunjungan']."/".$db['cabang']) ?>" class="btn btn-primary" target="_blank">Edit TD</a>
              <?php  }
              ?>
            </td>
          </tr>
          <tr>
            <td><input type="checkbox" name="temuan<?= $db['num'] ?>" id="temuan<?= $db['num'] ?>" onchange="setPublish(<?= $db['num'] ?>)" <?php if ($db['publish'] == 'Yes') { echo "checked";} ?>></td>
            
            <td>Temuan</td>
            <td> : </td>
            <td><?php $no = 1; foreach ($temuan as $tm) {
              echo $no++.". ".$tm['ket_temuan'];
              if($tm['foto_temuan'] != NULL) {
              echo "<a href='' type='button' onclick='window.open(\"" . base_url() . "assets/file/foto_temuan/" . $tm['foto_temuan'] . "\", \"newwindow\", \"width=810,height=900\"); return false;'><i class='fa fa-file'></i></a>";
              }
              echo "<br>";
            } ?></td>
            <td><?php
                if ($divisi == 99 OR $divisi == 1) { ?>
                  <a href="<?= base_url('shp/upload_foto_temuanRA/'.$project."/".$db['r_kategori']."/".$db['kunjungan']."/".$db['cabang']) ?>" class="btn btn-primary" target="_blank">Input Temuan</a>
              <?php  }
              ?></td> 
          </tr>
        </table>      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<?php } 
} ?>

<!-- Modal -->
<div class="modal fade" id="ubah_status" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Status Progress</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id_set" id="id_set">
        <div class="form-group">
            <label for="status">Status Progress</label>
            <select class="form-control" name="status_progress" id="status_progress">
              <option value="">--Pilih Status Progress</option>
              <option value="Not Started">Not Started</option>
              <option value="On Progress">On Progress</option>
              <option value="Completed">Completed</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="save_set" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.0/circle-progress.min.js" integrity="sha512-xlGek7L5p0odaCy8lkU1WpUJLuoxjuLDaiGpYrHJhp1YUNaA4x+c3PYvEIInH5clr0uHFucar2bhUR0Ef4R0ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">

function SetStatus(idku){
  console.log(idku);
  $('#id_set').empty();
  $('#id_set').val(idku);
}

$(document).ready(function(){  
                $('.switch').click(function(){  
                     $(this).toggleClass("switchOn");  
                });  

$('#save_set').click(function(){
    var idku = $('#id_set').val();
   var status_progress = $('#status_progress').val();
    console.log(idku);
    console.log(status_progress);
      $.ajax({
           url: "<?= base_url('project/stepprogress') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             idku:idku,
             status_progress: status_progress
           },
           success: function(hasil) {
             console.log('Berhasil Ubah Status Progress')
           }
         });

    $('#ubah_status').modal('toggle');
    location.reload(true);
});
});  


function publish(num){
    var val = document.getElementById('switch'+num).checked;
    console.log(val);
    console.log(num);
    if (val == false) {
      var publish = 'Yes';
      console.log(publish);
    }else{
      var publish = 'No';
      console.log(publish);
    }
    $.ajax({
           url: "<?= base_url('project/setpublish') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             num: num,
             publish: publish
           },
           success: function(hasil) {
             console.log('Berhasil Ubah Publish')
           }
         });
  }  
  $('#klik_cs').on('click', function() {
       $('#cs').css('display', 'block');
       $('#teller').css('display', 'none');
       // alert('klik cs');

     });

  $('#klik_teller').on('click', function() {
       $('#cs').css('display', 'none');
       $('#teller').css('display', 'block');
       // alert('klik teller');
       console.log(document.getElementById('teller'));


     });

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });




      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['provinsi', 'jumlah'],
           <?php
         // $sql = $this->db->query("SELECT channel, COUNT(channel) AS jumlah FROM project GROUP BY channel")->result_array();
            foreach ($sql as $result) {
                # code...
            echo"['".$result['provinsi']."',".$result['jumlah']."],";
         }
         ?>
        ]);
         var data2 = google.visualization.arrayToDataTable([
          ['provinsi', 'jumlah'],
           <?php
         // $sql = $this->db->query("SELECT channel, COUNT(channel) AS jumlah FROM project GROUP BY channel")->result_array();
            foreach ($sql_kompetitor as $result) {
                # code...
            echo"['".$result['provinsi']."',".$result['jumlah']."],";
         }
         ?>
        ]);

       
        var options = {
          title: 'Statistik Daftar Cabang Bank Client',
          pieHole: 0.4
        };
        var options2 = {
          title: 'Statistik Daftar Cabang Bank Kompetitor',
          pieHole: 0.4
          
        };
       
        var chart = new google.visualization.PieChart(document.getElementById('cabang1'));
        var chart2 = new google.visualization.PieChart(document.getElementById('cabang2'));

       
        chart.draw(data, options);
        chart2.draw(data2, options2);

      }

      function Circlle(el){
        $(el).circleProgress({fill: {color: '#ff5c5c'}}).on('circle-animation-progress', function(event, progress, stepValue){
          // $(this).find('strong').text(String(stepValue.toFixed(2)).substr(2)+'%');
        });
      };
      Circlle('.round');

      $('#filter_data').on('change', function() {
        var kata = $(this).val();
        var pro = $('#kd_project').val();

        $('#data_lengkap').empty();
        $.ajax({
           url: "<?= base_url('project/getfilter') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             kata : kata,
             pro: pro
           },

           success: function(hasil) {
            console.log(hasil);
            var ht = '';

            ht += '<div class="table-responsive" style="margin-top: 20px;">';
            ht += '<h5><b>Progress Per '+kata+'</p></h5>';
            ht += '<table class="table table-bordered" id="dataTables-example" >';
            ht += '<thead>';
            ht += '<tr>';
            // ht += '<td>No</td>';
            ht += '<td>'+kata+'</td>';
            ht += '<td>Jumlah Cabang</td>';
            ht += '<td>Progress</td>';
            ht += '</tr>';
            ht += '</thead>';
            ht += '<tbody>';
            for (var i = 0; i < hasil.length; i++) {
              var num = i+1;
             
            ht += '<tr>';
            // ht += '<td>'+num+'</td>';
            ht += '<td>'+hasil[i]['filter']+'</td>';
            ht += '<td>'+hasil[i]['jumlah']+'</td>';
            ht += '<td>';

            // ht += '<td><div class="row"><div class="col-sm-1 text-center font-weight-bold">'+persen+'%</div><div class="col-sm-10"><meter class="belumselesai" value="'+persen+'" min="0" max="100"  low="99" style="height: 30px; width: 100%; color: red;"></meter></div></div>    </td>';
            var filter = hasil[i]['filter'];
            var tmp;
            $.ajax({
               url: "<?= base_url('project/getfilter_progress') ?>",
               type: "POST",
               async: false,
               dataType: 'json',
               data: {
                 kata : kata,
                 filter : filter,
                 pro: pro
               },
               // success : bar_persen
               success: function(data) {
                    tmp = data;                    
               }
             });
            console.log(tmp);
                if (tmp == null) {
                  var jumlah = 0;
                  var finish = 0;
                  var persen = 0;
                } else {
                  var jumlah = tmp['total'];
                  var finish = tmp['finish'];
                  var persen = (((finish/jumlah) * 100).toFixed(0));
                }
                console.log(jumlah+" - "+finish+" - "+persen)
                   ht += '<div class="row"><div class="col-sm-1 text-center font-weight-bold">'+persen+'%</div><div class="col-sm-10"><meter class="belumselesai" value="'+persen+'" min="0" max="100"  low="99" style="height: 30px; width: 100%; color: red;"></meter></div></div>';

            ht += '</td>';
            ht += '</tr>';
            }
            ht += '</tbody>';
            ht += '</table>';
            ht += '</div>';

          // var akhir = ht + zx;
        $('#data_lengkap').append(ht);

        // $('#add-filter').append(ht);
              if (document.getElementById('dataTables-example')) {

                $('#dataTables-example').dataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true,
                 "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
               });
              }
          }
        });
      });


      $('#filter_data2').on('change', function() {
        var kata = $(this).val();
        var pro = $('#kd_project').val();

        $('#data_lengkap2').empty();
        $.ajax({
           url: "<?= base_url('project/getfilter2') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             kata : kata,
             pro: pro
           },

           success: function(hasil) {
            console.log(hasil);
            var ht = '';

            ht += '<div class="table-responsive" style="margin-top: 20px;">';
            ht += '<h5><b>Progress Per '+kata+'</p></h5>';
            ht += '<table class="table table-bordered" id="dataTables-example-99" >';
            ht += '<thead>';
            ht += '<tr>';
            // ht += '<td>No</td>';
            ht += '<td>'+kata+'</td>';
            ht += '<td>Jumlah Cabang</td>';

            ht += '<td>Progress</td>';
            ht += '</tr>';
            ht += '</thead>';
            ht += '<tbody>';
            for (var i = 0; i < hasil.length; i++) {

            ht += '<tr>';
            // ht += '<td>'+num+'</td>';
            ht += '<td>'+hasil[i]['filter']+'</td>';
            ht += '<td>'+hasil[i]['jumlah']+'</td>';

            ht += '<td>';

            // ht += '<td><div class="row"><div class="col-sm-1 text-center font-weight-bold">'+persen+'%</div><div class="col-sm-10"><meter class="belumselesai" value="'+persen+'" min="0" max="100"  low="99" style="height: 30px; width: 100%; color: red;"></meter></div></div>    </td>';
            var filter = hasil[i]['filter'];
            // console.log(kata);
            // console.log(filter);
            // console.log(pro);

            var tmp2;
            $.ajax({
               url: "<?= base_url('project/getfilter_progress2') ?>",
               type: "POST",
               async: false,
               dataType: 'json',
               data: {
                 kata : kata,
                 filter : filter,
                 pro: pro
               },
               // success : bar_persen
               success: function(data) {
                    tmp2 = data;
                    // console.log(data);                    
               }
             });
            console.log(tmp2);
                if (tmp2 == null || tmp2.length == 0) {
                  var jumlah = 0;
                  var finish = 0;
                  var persen = 0;
                } else if (tmp2 != null || tmp2.length > 0) {
                  var jumlah = tmp2[0]['total'];
                  var finish = tmp2[0]['finish'];
                  var persen = (((finish/jumlah) * 100).toFixed(0));
                }
                // console.log(jumlah+" - "+finish+" - "+persen)
                   ht += '<div class="row"><div class="col-sm-1 text-center font-weight-bold">'+persen+'%</div><div class="col-sm-10"><meter class="belumselesai" value="'+persen+'" min="0" max="100"  low="99" style="height: 30px; width: 100%; color: red;"></meter></div></div>';

            ht += '</td>';
            ht += '</tr>';
            }
            ht += '</tbody>';
            ht += '</table>';
            ht += '</div>';


        $('#data_lengkap2').append(ht);

        // $('#add-filter').append(ht);
              if (document.getElementById('dataTables-example-99')) {

                $('#dataTables-example-99').dataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true,
                 "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
               });
              }
          }
        });
      });


      function setPublish(num)
      {
           var jenis = $('input[type=checkbox][name="jenis'+num+'"]:checked').val();
           var td = $('input[type=checkbox][name="td'+num+'"]:checked').val();
           var temuan = $('input[type=checkbox][name="temuan'+num+'"]:checked').val();

           console.log(jenis);
           console.log(td);
           console.log(temuan);
           console.log(num);


           if (jenis == 'on' || td == 'on' || temuan == 'on') 
           {
            document.getElementById('publish'+num).style.pointerEvents = 'auto';
          } else {
            document.getElementById('publish'+num).style.pointerEvents = 'none';

          }

          
            $.ajax({
               url: "<?= base_url('project/setkolom_view') ?>",
               type: "POST",
               dataType: 'json',
               data: {
                 num: num,
                 jenis: jenis,
                 td: td,
                 temuan: temuan
               },
               success: function(hasil) {
                 console.log('Berhasil Set Kolom')
               }
             });
          


      }

      $( document ).ready(function() {
        $(".end").text("Completed");
        $(".semi").text("On Progress");
        $(".semiku").text("On Progress");
        $(".belum").text("Not started");



    });

     //  $('#filter_data').on('change', function() {
     //    var kata = $(this).val();
     //    var ktg = <?php echo json_encode($kate); ?>;
     //    var pro = $('#pro').val();
     //    var judul = <?php echo json_encode($nama_kate); ?>;
     //    console.log(ktg);
     //    for (var i = 0; i < ktg.length; i++) {
     //      var no = 7 + i;
     //                var ht = '';
     //    console.log(ktg[i]);

     //    $.ajax({
     //       url: "<?= base_url('project/gettable') ?>",
     //       type: "POST",
     //       dataType: 'json',
     //       data: {
     //         kata : kata,
     //         ktg : ktg[i],
     //         pro : pro
     //       },

     //       success: function(hasil) {

     //        console.log(hasil);
     //        console.log(judul[i]);
     //          ht += `<div class="col-sm-12" id="unseen" style="background-color: #F0FFFF;">
     //                         <h4 class="mb text-primary"><strong> Status Progress </strong> </h4>
     //                         <div class="col-sm-12 table-responsive">
     //                        <table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example-`+no+`">
     //                          <thead>
     //                           <tr>
     //                            <th>No `+no+`</th>
     //                            <th>Cabang</th>
     //                            <th>Status</th>
     //                            <th>Detail</th>
     //                            <th>Publish</th>
     //                            <th>Performance</th>
     //                          </tr>
     //                          </thead>
     //                          <tbody>
     //                            `;
     //                            for (var i = 0; i < hasil.length; i++) {
     //                              var num = i+1;
     //                            ht += `
     //                              <tr>
     //                                <td>`+num+`</td>
     //                                <td>`+hasil[i]['nama_cabang']+`</td>
     //                                <td>
     //                                `+hasil[i]['status']+`
                                        
     //                                </td>
     //                                <td><button type="button" class="btn btn-warning btn-round btn-sm" data-toggle="modal" data-target="#detail`+hasil[i]['num']+`">Detail <i class="fas fa-exclamation"></i></button></td>
     //                                <td>`+hasil[i]['publish']+`</td>
     //                                <td></td>
     //                              </tr>
     //                            `;
     //                          }
     //                       ht +=   `
     //                          </tbody>
     //                        </table>
     //                      </div>

     //                    </div>`;

     //      $('#data_lengkap').append(ht);

     //        }
     //     });
        
     //  }
     //  console.log(ht);
     // });
</script>