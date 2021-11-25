<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <?php
    date_default_timezone_set('Asia/Jakarta');
    ?>
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> STKB</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Master Plan </strong> </h4>

                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                <section id="unseen">

          <!-- Mulai codingan -->
          <form action="<?php echo base_url('stkb/tambahmasterplan')?>" method="POST" enctype="multipart/form-data" id="formmasterplan">

            <input type="hidden" name="kareg" value="<?php echo $this->session->userdata('id_user'); ?>">

            <div class="form-group">
              <label>Nama : </label>
                <select class="form-control selectpicker" data-live-search="true" name="pic" id="nama" required>
                  <option value="">Pilih Nama</option>
                  <?php
                  foreach ($masterplannama as $nama) {
                    ?>
                  <option value="<?php echo $nama['id'];?>"><?php echo $nama['nama']; ?> - <?php echo $nama['id']; ?></option>
                    <?php
                  }
                  ?>
                <select>
            </div>

            <div class="form-group">
              <label>Project : </label>
                <select class="form-control" name="project" id="projectted" required>
                  <option value="">Pilih Project</option>
                  <?php
                  foreach ($masterplanproject as $project) {
                    ?>
                  <option value="<?php echo $project['kode'];?>"><?php echo $project['nama']; ?></option>
                    <?php
                  }
                  ?>
                <select>
            </div>

            <div class="form-group">
              <label>Kota : </label>
                <select class="kota form-control" name="kota" id="kotated" required>
                  <option value="">Pilih kota</option>
                </select>
            </div>

            <!-- <div id="showCheckAll" style="display:none;">
              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                  <div class="form-group">
                    <input type="checkbox" id="checkAllSkenario" disabled>
                    <label for="checkAllSkenario">Checklist All</label>
                  </div>
                </div>
              </div>
            </div> -->
            <div id="tampilancabang"></div>

            <div class="form-group">
              <label>Kota dari : </label>
                <select class="form-control selectpicker" data-live-search="true" name="kotadari" id="kotadari" required>
                  <option value="">Pilih Kota dari</option>
                  <?php
                  foreach ($masterplankota as $kota) {
                    ?>
                  <option value="<?php echo $kota['kabupatenkota'];?>"><?php echo $kota['kabupatenkota']; ?></option>
                    <?php
                  }
                  ?>
                <select>
            </div>

            <div class="form-group">
              <label>Kota Dinas : </label>
                <select class="form-control selectpicker" data-live-search="true" name="kotadinas" id="kotadinas" required>
                  <option value="">Pilih Kota dinas</option>
                  <?php
                  foreach ($masterplankota as $kota) {
                    ?>
                  <option value="<?php echo $kota['kabupatenkota'];?>"><?php echo $kota['kabupatenkota']; ?></option>
                    <?php
                  }
                  ?>
                <select>
            </div>

            <div class="row">

              <div class="col-sm-4">
                <div class="form-group">
                  <label>Penugasan : </label>
                    <select class="form-control" name="penugasan" id="penugasan" required>
                      <option value="">Pilih penugasan</option>
                      <option value="Setempat">Setempat</option>
                      <option value="Dinas">Dinas</option>
                      <option value="Mutasi">Mutasi</option>
                    <select>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                 <label>Tanggal Mulai Penugasan : </label>
                  <input type="date" name="planstart" class="form-control" min="<?php //echo date('Y-m-d'); ?>" required>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label>Tanggal Selesai Penugasan : </label>
                    <input type="date" name="planend" class="form-control" min="<?php //echo date('Y-m-d'); ?>" required>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                 <label>Tanggal Mulai Pengerjaan : </label>
                  <input type="date" name="planstartPengerjaan" class="form-control" min="<?php //echo date('Y-m-d'); ?>" required>
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label>Tanggal Selesai Pengerjaan : </label>
                    <input type="date" name="planendPengerjaan" class="form-control" min="<?php //echo date('Y-m-d'); ?>" required>
                </div>
              </div>

            </div>

            <!--div class="row">

              <div class="col-sm-6">
                <div class="form-group">
                 <label>Tanggal Mulai Pengerjaan : </label>
                  <input type="date" name="planstartPengerjaan" class="form-control" min="<?php //echo date('Y-m-d'); ?>" required>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tanggal Selesai Pengerjaan : </label>
                    <input type="date" name="planendPengerjaan" class="form-control" min="<?php //echo date('Y-m-d'); ?>" required>
                </div>
              </div>

            </div-->

            <div class="form-group">
              <label for="suratpernyataan">Upload Surat Pernyataan :</label>
              <input type="file" class="form-control" name="suratpernyataan" required>
            </div>

            <div id="checkBackup" class="form-group" style="display:none;">
              <label for="backuprek">Jumlah Backup Rekening (bila ada) :</label>
              <input id="valStateBackup" type="hidden" value="0">
              <input id="valBackup" type="number" class="form-control" min="0" name="backuprek">
            </div>

            <br/>

            <div class="form-group">
              <label for="user">Itinerary</label>
              <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                  <tr>
                    <td><b>Hari</b></td>
                    <?php
                    foreach ($getallitinerary as $key) {
                    ?>
                    <td><?php echo $key['keterangan'] ?></td>
                    <?php
                    }
                    ?>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=1; $i <= 7; $i++) {
                  ?>
                  <tr>
                    <td><b>Hari Ke <?php echo $i; ?></b></td>
                    <?php
                    foreach ($getallitinerary as $key) {
                    ?>
                    <td><center><input type="checkbox" class="form-check-input" name="<?php echo $i; echo "_"; echo $key['no']; ?>" value="<?php echo $key['no'] ?>"><center></td>
                    <?php
                    }
                    ?>
                  </tr>
                  <?php
                  }?>
                </tbody>
              </table>
            </div>



          </br></br>
            <button type="submit" name="submit" class="btn btn-success" id="submitmasterplan">Submit</button>

          </form>
          <!-- //End Coding -->

        </section>



          </div>
      </div>
    </div>

    </div>
  </div>
</section>
<!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script>
$("input").on("change", function() {
    this.setAttribute(
        "data-date",
        moment(this.value, "YYYY-MM-DD")
        .format( this.getAttribute("data-date-format") )
    )
}).trigger("change")

function checkBox(idnya,val){
  var id = '#'+val+idnya;
  // var ceklist = id.substring(id.length - 1, id.length); // LAMA ERROR
  var ceklist = idnya.substr(3, 10); // BARU 30 NOVEMBER 2020
  // console.log("ID: "+id+" | CEK: "+ceklist);
  var valCeklist = parseInt($('#ceklist'+ceklist).val());
  var cekStateBackup = parseInt($("#valStateBackup").val());
  var addValCeklist = 0;
  // console.log("ID VAL: "+$(id).val());
  if($(id).is(':checked')){

    if($(id).val() == '001' || $(id).val() == '002' || $(id).val() == '064' || $(id).val() == '065' || $(id).val() == '066'){
      if(valCeklist >= 0 && valCeklist <= 2){

        if(valCeklist == 0){
          var addStateBackup = cekStateBackup+1;
          $("#valStateBackup").val(addStateBackup);
          $('#ceklist'+ceklist).val(1);
        }
        if(valCeklist == 1){
          addValCeklist = valCeklist+1;
          $('#ceklist'+ceklist).val(addValCeklist);
        }

      }
    }

  }else{

    if($(id).val() == '001' || $(id).val() == '002' || $(id).val() == '064' || $(id).val() == '065' || $(id).val() == '066'){
      if(valCeklist <= 2){
        addValCeklist = valCeklist-1;
        $('#ceklist'+ceklist).val(addValCeklist);

        if(valCeklist == 1){
          addValCeklist = valCeklist-1;
          $('#ceklist'+ceklist).val(addValCeklist);
          var addStateBackup = cekStateBackup-1;
          $("#valStateBackup").val(addStateBackup);
        }

      }
    }

  }

  var checkBackurek = $("#valStateBackup").val();
  if(checkBackurek > 0){
    $("#checkBackup").show();
      var x = checkBackurek;
      var y = 2;
      var a = x / y;
      var b = x % y;

      if(b == 1){
      	var nilai = a.toString();
        nilai = Math.trunc(nilai);
      }else{
      	var nilai = a;
      }
    $("#valBackup").val(nilai);
    $("#valBackup").attr('max', nilai);
  }else{
    $("#checkBackup").hide();
    $("#valBackup").val(0);
    $("#valBackup").attr('max', 0);
  }
  $("#valBackup").val(0); // SET KE 0 LAGI UNTUK JUML
}

</script>
