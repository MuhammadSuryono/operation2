
<?php $akses = $this->session->userdata('id_divisi')?>

<section id="main-content">
      <section class="wrapper site-min-height">
          <h3><i class="fa fa-angle-right"></i> Akses Upload Data Kunjungan</h3>
        
                                                  
        <div class="row mt">
          <div class="col-lg-12">

              <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Akses Upload Data Kunjungan</strong></h4>
              
                <input type="hidden" id="akses" value="<?php echo $akses?>">
                <div class="row mb">
                <div class="col-md-4">
                    <select class="selectpicker form-control" name="akses_project" id="akses_project" data-live-search="true">
                        <option value=""> Pilih Project</option>
                        <?php foreach($project as $pr):?>
                        <option value="<?=$pr['kode_project']?>"> <?=$pr['nama_project']?> </option>
                        <?php endforeach?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control selectpicker" name="akses_cabang" id="akses_cabang" data-live-search="true">
                        <option value=""> Pilih Cabang</option>
                        
                    </select>
                </div>

                <div class="col-md-2">
                <button type="button" id ="viewdata_akses" onclick="dataQuest()" class="btn btn-round btn-primary pull-left" style="margin-right:0.5rem;"><i class="fa fa-eye fa-fw"></i> Tampilkan </button>
                </div>


                </div>
                <!-- </form> -->
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
             
                </div>
                
                <section id="unseen">

              </section>
            </div>
           </div>
           <div class="col-lg-12">
           	<div class="form-panel">
           		<!-- <form action="<?= base_url('validasi/verifikasi_konsistensi') ?>" method="POST"> -->
           		<section id="div_dataakses">
                  	
                 </section>
             <!-- </form> -->
           	</div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
<script>
  function dataQuest()
  {
    var pro = $('#akses_project').val();
    var cabang = $('#akses_cabang').val();
    $("#div_dataakses").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getdata_quest') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: pro,
               cabang: cabang
             },
             success: function(hasil) {
               console.log(hasil);
              if(hasil.length > 0){
                 var cetak = "";
                 cetak += "<div class='table-responsive'>";
                 cetak += "<table class='table table-bordered'>";
                 cetak += "<thead><tr>";
                 cetak += "<th><center>Action</center></th>";
                 cetak += "<th><center>Project</center></th>";
                 cetak += "<th><center>Cabang</center></th>";
                 cetak += "<th><center>Kunjungan</center></th>";
                 cetak += "<th><center>Shopper</center></th>";
                 cetak += "<th><center>Pewitness</center></th>";
                 cetak += "<th><center>Tanggal</center></th>";
                 cetak += "<th><center>Keterangan</center></th>";
                 cetak += "</tr></thead>";

                 cetak += "<tbody style='font-size: 15px;'>";
                 for (var i = 0; i < hasil.length; i++) {
                  if (hasil[i]['status'] == '1') {
                     cetak += "<tr style='background-color: #ffff06;'>";
                  } else if (hasil[i]['status'] == '2') {
                     cetak += "<tr style='background-color: #99FF99;'>";
                  } else if (hasil[i]['status'] == '3') {
                     cetak += "<tr style='background-color: #9ACA4A;'>";
                  } else {
                    cetak += "<tr>";
                  }
                     // cetak += "<td><center><a href='#' class='text-danger' onclick='approveAkses('"+hasil[i]['num']+"', '"+hasil[i]['nama_kunjungan']+"', '"+hasil[i]['nama_cabang']+"'')'><i class='fas fa-cog fa-3x'></i></a></center></td>";
                  if(hasil[i]['keterlambatan_upload'] == null) {
                     cetak += "<td><center><a href='#' class='text-danger' title='Buka Akses Upload' onclick='approveAkses(\"" + hasil[i]['num'] + "\",\"" + hasil[i]['nama_kunjungan'] + "\",\"" + hasil[i]['nama_cabang'] + "\")'><i class='fas fa-cog fa-3x'></i></a></center></td>";
                  } else {
                    cetak += "<td></td>";
                  }

                     cetak += "<td>("+hasil[i]['project']+") "+hasil[i]['nama_project']+"</td>";
                     cetak += "<td>("+hasil[i]['cabang']+") "+hasil[i]['nama_cabang']+"</td>";
                     cetak += "<td>("+hasil[i]['kunjungan']+") "+hasil[i]['nama_kunjungan']+"</td>";
                     cetak += "<td>("+hasil[i]['shp']+") "+hasil[i]['nama_shp']+"</td>";
                    if (hasil[i]['pwt'] == null) {
                     cetak += "<td>("+hasil[i]['pwt']+") "+hasil[i]['nama_pwt']+"</td>";
                    } else {
                      cetak += "<td></td>";
                    }
                     cetak += "<td>"+hasil[i]['tanggal']+"</td>";
                    if (hasil[i]['keterlambatan_upload'] == 'Approve') {
                     cetak += "<td><b>Sudah Dibuka Akses Upload <a href='#' class='text-danger' title='Reset Buka Akses Upload' onclick='resetAkses(\"" + hasil[i]['num'] + "\",\"" + hasil[i]['nama_kunjungan'] + "\",\"" + hasil[i]['nama_cabang'] + "\")'><i class='fas fa-undo-alt fa-lg'></i></a></b></td>";
                    } else {
                      cetak += "<td></td>";
                    }
                     cetak += "</tr>";      
                 }
                 cetak += "</tbody>"
                 cetak += "</table>";
                 cetak += "</div>";
                 $("#div_dataakses").append(cetak);
               } else {
                  Swal({
                     position: 'center',
                     type: 'error',
                     title: 'Maaf Belum Ada Data Kunjungan Untuk Cabang Tersebut!',
                     showConfirmButton: true
                     // timer: 3000
                   });
               }
             }
           });
  }

  function approveAkses(num, kunjungan, cabang)
  {
    if (confirm("Apakah Anda yakin ingin buka akses upload data untuk kunjungan '"+kunjungan+"' cabang '"+cabang+"' ?") == true) {
      console.log(num);
      $.ajax({
             url: "<?php echo base_url('aktual/change_aksesupload') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               num: num
               
             },
             success: function(hasil) {
              Swal({
               position: 'center',
               type: 'success',
               title: 'Berhasil Buka Akses Upload Data Kunjungan',
               showConfirmButton: true
               // timer: 3000
             });
              dataQuest();

             }
           })
    } else {
      text = "You canceled!";
    }
    
  }

  function resetAkses(num, kunjungan, cabang)
  {
    if (confirm("Apakah Anda yakin ingin reset akses keterlambatan upload data untuk kunjungan '"+kunjungan+"' cabang '"+cabang+"' ?") == true) {
      console.log(num);
      $.ajax({
             url: "<?php echo base_url('aktual/reset_aksesupload') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               num: num
               
             },
             success: function(hasil) {
              Swal({
               position: 'center',
               type: 'success',
               title: 'Berhasil Reset Akses Upload Data Kunjungan',
               showConfirmButton: true
               // timer: 3000
             });
              dataQuest();

             }
           })
    } else {
      text = "You canceled!";
    }
    
  }

</script>
