   <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights 2019 - <?= date('Y')?> <strong>MRI</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <strong>Marketing Reasearch Indonesia</strong>
        </div>
        <a href="blank.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>


  <script type="text/javascript" src="<?= base_url('assets/')?>lib/advanced-datatable/js/DT_bootstrap.js"></script>


  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?= base_url('assets/')?>lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery.ui.touch-punch.min.js"></script>
  <script class="include" type="text/javascript" src="<?= base_url('assets/')?>lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery.scrollTo.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery.nicescroll.js" type="text/javascript"></script>

  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="<?= base_url('assets/')?>lib/advanced-form-components.js"></script>
  <script src="<?php echo base_url('assets/sweet/') ?>js/sweetalert2.all.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>js.js"></script>
  <script src="<?php echo base_url('assets/js/') ?>jquery.table2excel.js"></script>
  <script src="<?php echo base_url('assets/js/') ?>bootstrap-select.min.js"></script>


  <!--common script for all pages-->
  <script src="<?= base_url('assets/')?>lib/common-scripts.js"></script>
  <!--script for this page-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>
  <!-- <script src="<?= base_url('assets/')?>scriptmusik.js"></script> -->

  <!-- STICKY -->
  <script>
    var fixmeTop = $('#headerrekaman').offset().top;       // get initial position of the element

    $(window).scroll(function() {                  // assign scroll event listener

        var currentScroll = $(window).scrollTop(); // get current position

        if (currentScroll >= fixmeTop) {           // apply position: fixed if you
            $('#headerrekaman').css({
                position: 'fixed',
                top: '0',
            });
        } else {                                   // apply position: static
            $('#headerrekaman').css({                      // if you scroll above it
                position: 'static'
            });
        }

    });
  </script>
  <!-- AKHIR STICKY -->

  <!-- MUSIK -->
  <script>
  var timer;
  var percent = 0;

  function seektimeupdate(){
    var audio = document.getElementById("audio");
		var nt = audio.currentTime * (100 / audio.duration);
		seekslider.value = nt;
		var curmins = Math.floor(audio.currentTime / 60);
    var cursecs = Math.floor(audio.currentTime - curmins * 60);
    var durmins = Math.floor(audio.duration / 60);
    var dursecs = Math.floor(audio.duration - durmins * 60);

    if(cursecs < 10){ cursecs = "0"+cursecs; }
    if(dursecs < 10){ dursecs = "0"+dursecs; }
    if(curmins < 10){ curmins = "0"+curmins; }
    if(durmins < 10){ durmins = "0"+durmins; }
		curtimetext.innerHTML = curmins+":"+cursecs;
	  durtimetext.innerHTML = durmins+":"+dursecs;
	}

  function advance(duration, element) {
    var progress = document.getElementById("progress");
    increment = 10/duration
    percent = Math.min(increment * element.currentTime * 10, 100);
    progress.style.width = percent+'%'
    startTimer(duration, element);
  }

  function startTimer(duration, element){
    if(percent < 100) {
      timer = setTimeout(function (){advance(duration, element)}, 100);
    }
  }

  function togglePlay (e) {
    e = e || window.event;
    var btn = e.target;
    var audio = document.getElementById("audio");
    if (!audio.paused) {
      audio.pause();
      isPlaying = false;
    var doc = document.getElementById("togglePlay");
    doc.classList.remove('fa-pause-circle');
    doc.classList.add('fa-play-circle');
    } else {
      var duration = audio.duration;
      advance(duration, audio);
      audio.play();
      isPlaying = true;
      var doc = document.getElementById("togglePlay");
      doc.classList.remove('fa-play-circle');
      doc.classList.add('fa-pause-circle');
    }
  }
  </script>
  <!-- AKHIR MUSIK -->


  <!-- Carosel -->
  <script>
    var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function plusSlides1(w, n, x) {
      if(n != ""){
        $.ajax({
          url:"<?= base_url('equestisi/jump')?>",
          type:"POST",
          dataType: 'json',
          data:{ketsoal:n,pembuat:x, soal:w},
          success:function(hasil){

            // MENGHILANGKAN SOAL SOAL DARI SKIP SKIP
          //   for(i=1;i<hasil.length;i++){
          //     // console.log(hasil[i]);
          //     if(i % 2 == 0){
          //         var css = "text-warning1";
          //       } else {
          //         var css = "text-danger";
          //       }

          //      if(hasil[i] !== n){
          //       var id = '#'+hasil[i];
          //       $(id).empty();
          //       var ht = `<div class="mySlides">
          //                   <div class="row">
          //                     <div class="col-lg-12">
          //                         <div class="form-panel">
          //                           <h3 style="text-align: center;" class="`+css+`"><strong> Silahkan Klik Tombol Next </strong></h3>
          //                            <h5 style="text-align: center;" class="`+css+`"><strong> Pertanyaan ini dilewat (Tidak Perlu Untuk Menjawab)</strong></h5>
          //                           <div style="text-align:center;"><a class="btn btn-round hover" onclick="plusSlides(1)" style="background-color:#2f323a; color : white;">&#10095;</a></div>
          //                         </div>
          //                     </div>
          //                   </div>
          //                 </div>`;
          //       // var ht;
          //       $(id).replaceWith(ht);
          //   }
          // }
          // AKHIR MENGHILANGKAN SOAL SOAL DARI SKIP SKIP
            showSlides(slideIndex = hasil[0]);
          }
        });//}
      }

      if(n == "") {
        console.log(w);
      console.log(n);
      console.log(x); //console.log("RIWAY MASUK");
        $.ajax({
          url:"<?= base_url('equestisi/jumpnull')?>",
          type:"POST",
          dataType: 'json',
          data:{ketsoal:n,pembuat:x, soal:w},
          success:function(hasil){
            // console.log("RIWAY MASUK");
            // MENGHILANGKAN SOAL SOAL DARI SKRIP SKIP
          //   for(i=1;i<hasil.length;i++){
          //     // console.log(hasil[i]);
          //       if(i % 2 == 0){
          //         var css = "text-warning1";
          //       } else {
          //         var css = "text-danger";
          //       }
          //       var id = '#'+hasil[i];
          //       $(id).empty();
          //       var ht = `<div class="mySlides">
          //                   <div class="row">
          //                     <div class="col-lg-12">
          //                         <div class="form-panel">
          //                           <h3 style="text-align: center;" class="`+css+`"><strong> Silahkan Klik Tombol Next </strong></h3>
          //                           <h5 style="text-align: center;" class="`+css+`"><strong> Pertanyaan ini dilewat (Tidak Perlu Untuk Menjawab)</strong></h5>
          //                           <div style="text-align:center;"><a class="btn btn-round hover" onclick="plusSlides(1)" style="background-color:#2f323a; color : white;">&#10095;</a></div>
          //                         </div>
          //                     </div>
          //                   </div>
          //                 </div>`;
          //       $(id).replaceWith(ht);
          //     // }
          //  }
          // AKHIR MENGHILANGKAN SOAL SOAL DARI SKIP SKIP
            showSlides(slideIndex = hasil[0]);
          }
        });
      }
    }

    // Thumbnail image controls
    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("dot");
      // if (n > slides.length) {slideIndex = 1}
      if (n > slides.length) {slideIndex = n-1}
      if (n < 1) {slideIndex = 1}
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
    }
	</script>
  <!-- Akhir Carosel -->

  <script>
  var z = 1;
  var x = 1;
  var dlama;
  function addpg(b) {
    var dbaru = b;
    if (dlama != dbaru){
        console.log(dbaru);
        z = 1;
        dlama = b;
    }
    z = z + 1;
    var ht = `<div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan Selanjutnya</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg`+z+``+b+`" id="pg`+z+``+b+`">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg`+z+``+b+`" id="kodepg`+z+``+b+`" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump`+z+``+b+`" id="jump`+z+``+b+`" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                    </div>`;
    var id = '#pilihanganda'+b;
    var name = 'pilihanganda'+b;
    $(id).append(ht);

    $(`#jumlahpg`+b).empty();
      var input = `<input type="hidden" name="jmlpg`+b+`" id="jmlpg`+b+`" value="`+z+`"/>`;
    $(`#jumlahpg`+b).append(input);
  }

  function interupsi(idnya){
    var id = "#piltd"+idnya+" option:selected";
     // TAMBAHAN CODE BARU
    var idnya = idnya + 1;
    // AKHIR
    var section = "#interupsi"+idnya;
    console.log(section);
    console.log("HAI WAY");
    var optionText = $(id).val();
    var option = $(id).text();
    // if(optionText.search("Interupsi")>=0){
      var ht = `<input type="text" class="form-control mb" name="ketinterupsi`+x+`" id="ketinterupsi`+x+`" placeholder="Keterangan `+option+`" required>`;
      $(section).empty();
      $(section).append(ht);
      x = x + 1;
      console.log("MASUK WAY");
    // }
    // var ht = `<input type="text" class="form-control mb" name="ketinterupsi1" id="ketinterupsi1" placeholder="Keterangan Interupsi 1">`;
    // var optionText = $(id).val();
    // console.log(optionText);
    // $(id)
    // console.log(id);
    // var char = $(this).children("option:selected").val();
    // var char = $(this).val();
    // console.log(char);
    // console.log(this.options[this.selectedIndex].val());
  }

  function editbyid(id, no){
    var input = "#kode"+no;
    var text = "#message"+no;
    var kode = $(input).val();
    var soal = $(text).val();
      $.ajax({
          url:"<?= base_url('equestbaru/ubahbyid')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id,kode:kode,soal:soal},
          success:function(hasil){
              $(input).val(kode);
              $(text).val(soal);
          }
      });
  }

  function editpgbyid(id1, no1){
    var input = "#pg"+no1;
    var text = "#kodepg"+no1;
    var jump1 = "#jump"+no1;
    var kode = $(input).val();
    var soal = $(text).val();
    var jump = $(jump1).val();
    console.log(id1);
    console.log(kode);
    console.log(soal);
    console.log(jump);
      $.ajax({
          url:"<?= base_url('equestbaru/ubahbyid1')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id1,kode:kode,soal:soal,jump:jump},
          success:function(hasil){
              $(input).val(kode);
              $(text).val(soal);
              $(jump1).val(jump);
          }
      });
  }

  function addpgedit(nomor){
    var section = '#jumlahpg'+nomor;
    var jumlah = '#jmlpg'+nomor;
    var jml = $(jumlah).val();
    var ht = `<div class="form-group `+nomor+``+jml+`">
                        <label class="col-sm-3 control-label">Pilihan Baru</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg`+nomor+``+jml+`" id="pg`+nomor+``+jml+`">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg`+nomor+``+jml+`" id="kodepg`+nomor+``+jml+`" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump`+nomor+``+jml+`" id="jump`+nomor+``+jml+`" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                        <div class="col-sm-2 btn`+nomor+``+jml+`">
                            <button class="btn btn-primary btn-round btn-sm" onclick="savepgedit(`+nomor+`,`+nomor+``+jml+`)"><span class="fa fa-plus fa-fw"></span> Simpan </button>
                        </div>
                    </div>`;
    var id = '#pilihanganda'+nomor;
    $(id).append(ht);

    var total = parseInt(jml) + 1;
    var ht1 = `<input type="hidden" name="jmlpg`+nomor+`" id="jmlpg`+nomor+`" value="`+total+`"/>`;
    $(section).empty();
    $(section).append(ht1);
  }

  function savepgedit(r,s){
    var id = '#id'+r;
    var id1 = $(id).val();
    var soal = $('#pg'+s).val();
    var kode = $('#kodepg'+s).val();
    var jump = $('#jump'+s).val();
    $.ajax({
          url:"<?= base_url('equestbaru/savepgedit')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id1,kode:kode,soal:soal,jump:jump},
          success:function(hasil){
              $('#kodepg'+s).val(kode);
              $('#pg'+s).val(soal);
              $('#jump'+s).val(jump);
              $('.btn'+s).empty();
              var ht = `<button onclick="editpgbyid(`+hasil.id_pg_equest+`,`+s+`)" class="btn btn-success btn-round btn-sm"><span class="fa fa-edit fa-fw"></span> Edit </button>
              <button onclick="hapuspgbyid(`+hasil.id_pg_equest+`,`+s+`)" class="btn btn-danger btn-round btn-sm"><span class="fa fa-trash fa-fw"></span> Hapus </button>`;
              $('.btn'+s).append(ht);
          }
      });
  }

  function hapusbyid(id, nomor){
    console.log(id);
    $.ajax({
          url:"<?= base_url('equestbaru/hapusbyid')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
              $('.'+nomor).remove();
          }
      });
    $('.'+nomor).remove();
  }

  function hapuspgbyid(id, nomor){
    console.log(id);
    $.ajax({
          url:"<?= base_url('equestbaru/hapuspgbyid')?>",
          type:"POST",
          dataType: 'json',
          data:{id:id},
          success:function(hasil){
            $('.'+nomor).remove();
          }
      });
      $('.'+nomor).remove();
  }

  function getLocation() {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition);
      } else {
          alert("Geolocation is not supported by this browser.");
      }
  }

    function showPosition(position) {
        $("#lang").val(position.coords.latitude);
        $("#long").val(position.coords.longitude);
    }

    // CONVERT WAKTU
    String.prototype.toHHMMSS = function () {
    var sec_num = parseInt(this, 10); // don't forget the second param
    var hours   = Math.floor(sec_num / 3600);
    var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
    var seconds = sec_num - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}
    return hours+':'+minutes+':'+seconds;
    }
    // AKHIR

    function getCurTime() {
      var vid = document.getElementById("rekaman");
      var time = ``+vid.currentTime+``;
      var time1 = time.toHHMMSS();
      var htl = `<input type="text" class="form-control mb" name="jumlahpiltd" id="jumlahpiltd" value="`+time1+`">`;
      $('#piltd1').append(htl);
    }

    function radio(id){
      var radios = document.getElementsByName('ulang'+id);
        for (var i = 0, length = radios.length; i < length; i++)
        {
          if (radios[i].checked)
          {
            var x = (radios[i].value);
            if (x==1){
              $('#ulangi'+id).empty();
              var ht = `<div class="form-group">
                            <label class="col-sm-5 control-label">Kesalahan Dari : </label>
                            <div class="col-sm-7">
                                <label class="radio-inline">
                                    <input type="radio" name="salah`+id+`" id="salah`+id+`" value=1>Salah Pewitness
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="salah`+id+`" id="salah`+id+`" value=2 checked>Bukan Salah Pewitness
                                </label>
                            </div>
                        </div>
                        <br><br>`;
              $('#ulangi'+id).append(ht);
            } else {
              $('#ulangi'+id).empty();
            }
          }
        }
    }

  $(document).ready(function(){
  $('#project2').change(function(){
            var id=$(this).val();
            console.log(id);
            $("#kunjungan").empty();
            $.ajax({
                url : "<?php echo base_url('skenario/getskenariokunjungan') ?>",
                type : "POST",
                dataType : 'json',
                data : {pro:id},
                success: function(hasil){
                  console.log("success");
                  $("#kunjungan").empty();
                  var cetak = "<option>Pilih Kunjungan</option>";
                  for (var i = 0; i < hasil.length; i++) {
                    cetak += "<option value='" + hasil[i]['kode'] + "'>" + hasil[i]['nama'] + "</option>";
                  }
                  $("#kunjungan").append(cetak);
                }
            });
        });
  });

  $(document).ready(function(){
  var i = 0;
  var j = 1;
  var k = 1;
  var l = 1;
  var m = 1;
  var n = 1;

// =========================================Javascript Kuis Shopper======================================

  $("#buat").click(function(){
  $("#idsoal").remove();
  $(".jumlah").remove();
  i = i + 1;
  var ht = `<div class="row mt soal">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Soal `+i+` </strong></h4>
                <div class="form-horizontal style-form">

                <div class="form-group">
                  <label class="col-sm-3 control-label">Pertanyaan</label>
                  <div class="col-sm-9">
                     <textarea class="form-control" name="pertanyaan`+i+`" id="pertanyaan`+i+`" placeholder="Pertanyaan.." rows="1" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Benar</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="jb`+i+`" id="jb`+i+`" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 1</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js1`+i+`" id="js1`+i+`" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 2</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js2`+i+`" id="js2`+i+`" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 3</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js3`+i+`" id="js3`+i+`" required>
                  </div>
                </div>

            </div>
            </div>
           </div>
           </div>`;
    $("#soalsoal").append(ht);
    var y = $('.soal').length;
    console.log(y);
    var id = `<input type="hidden" id="idsoal" name="idsoal" value="`+y+`">`;
    $("#soalsoal").append(id);
    var j = `<label class="col-lg-2 control-label jumlah">Jumlah Soal : `+y+`</label>`;
    $("#jumlah").append(j);
  });

  $('#projectkuis').change(function(){
    $('#kunjungan').empty();
    var pro = $('#projectkuis').val();
    console.log(pro);
    $.ajax({
        url:"<?= base_url('equest/getprojectskenario')?>",
        type:"POST",
        dataType: 'json',
        data:{pro:pro},
        success:function(hasil){
          console.log("success");
          console.log(hasil);
          var ht =`<option value="">Pilih Kunjungan</option>`
            for(it=0;it<hasil.length;it++){
                 ht += `
                   <option value="`+hasil[it].kode+`">`+hasil[it].nama+`</option>`
            }
            $('#kunjungan').append(ht);
        }
    });
  });

  $('#projectbrief').change(function(){
    $('#jenis').empty();
    var pro = $('#projectbrief').val();
    console.log(pro);
    $.ajax({
        url:"<?= base_url('equest/getprojectshpkunjungan')?>",
        type:"POST",
        dataType: 'json',
        data:{pro:pro},
        success:function(hasil){
          console.log("success");
          console.log(hasil);
          var ht =`<option value="">Pilih Kunjungan</option>`
            for(i=0;i<hasil.length;i++){
                 ht += `
                   <option value="`+hasil[i].kunjungan+`">`+hasil[i].skenario+`</option>`
            }
            $('#jenis').append(ht);
        }
    });
  });

  $('#play').click(function(){
      $('#soalsoal').empty();
      var jenis = $('#jenis').val();
      var proj = $('#projectbrief').val();
      $.ajax({
        url:"<?= base_url('equest/skenario')?>",
        type:"POST",
        dataType: 'json',
        data:{jenis:jenis, proj:proj},
        success:function(hasil){
            for(i=0;i<hasil.length;i++){
                // var ht = `<div class="row mt">
                //         <div class="col-lg-12">
                //           <div class="form-panel">
                //               <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman Brief Skenario `+hasil[i].nama_skenario+`</strong></h4>
                //               <div class="form-horizontal style-form">
                //                   <audio controls id="rekaman" src="../assets/file/skenario/`+hasil[i].file_skenario+`"></audio>
                //           </div>
                //           </div>
                //         </div>
                //         </div>`;
                var ht = `<div class="row mt">
                         <div class="col-lg-12">
                           <div class="form-panel">
                               <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman Brief Skenario `+hasil[i].nama_skenario+`</strong></h4>
                                <div class="container">
                                    <div class="progress" id="progress"></div>
                                    <audio autoplay id="audio" src="../assets/file/skenario/`+hasil[i].file_skenario+`"></audio>

                                    <button type="button" class="togglePlay" onClick="togglePlay()" ><span style="font-size: 3em;"><i class="far fa-play-circle" id="togglePlay"></i></span></button>
                                </div>
                           </div>
                         </div>
                         </div>`;
              $('#soalsoal').append(ht);
            }
        }
    });
  });

  $('#mulaikuis').click(function(){
    var x = document.getElementById("audio").duration;
    var y = document.getElementById("audio").currentTime;

    var z = x - y;

    if(z>=5){
      Swal({
        position: 'center',
        title: 'Anda Belum Menyelesaikan Rekaman Briefing',
        showConfirmButton: true,
      });
    } else {
      var project = $('#projectbrief').val();
      var sek = $('#jenis').val();
      // window.location.href = `https://180.211.92.132/kerjabakti/equest/kuisjs/`+sek+`/`+project+``;
      window.location.href = `https://180.211.92.132/kaizen/equest/kuisjs/`+sek+`/`+project+``;
    }

  });

  $('#project').change(function(){
    $('#kunjungan').empty();
    var ht1 = $('#project').val();
    $.ajax({
        url:"<?= base_url('skenario/projectkunjungan')?>",
        type:"POST",
        dataType: 'json',
        data:{jenis:ht1},
        success:function(hasil){
            for(i=0;i<hasil.length;i++){
                var ht = `
                  <option value="`+hasil[i].kunjungan+`">`+hasil[i].nama+`</option>`;
              $('#shpkunjungan').append(ht);
            }
        }
    });
  });

  $('#shpkunjungan').change(function(){
    $('#shpskenario').empty();
    var ht1 = $('#project').val();
    $.ajax({
        url:"<?= base_url('skenario/projectkunjungan')?>",
        type:"POST",
        dataType: 'json',
        data:{jenis:ht1},
        success:function(hasil){
            for(i=0;i<hasil.length;i++){
                var ht = `
                   <div class="col-sm-2">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="check[]" name="check[]" value="`+hasil[i].kunjungan+`">`+hasil[i].kunjungan+`
                        </label>
                  </div>`;

              $('#kunjungan').append(ht);
            }
        }
    });
  });


  $('#project').change(function(){
    $('#pilihcabang').empty();
    var cbg = $('#project').val();
    $.ajax({
        url:"<?= base_url('skenario/projectcabang')?>",
        type:"POST",
        dataType: 'json',
        data:{cbg:cbg},
        success:function(cbng){
                var cetak = `<option value="">Pilih Cabang</option>`
                for(i=0;i<cbng.length;i++){
                  cetak +=`<option value="`+cbng[i].kode+`">`+cbng[i].nama+`</option>`;
                  console.log(cbng[i].kode)
                }
              $('#pilihcabang').append(cetak);
        }
    });
  });

$('#modalassignshp').on('show.bs.modal', function (event) {
  var kunj = $(event.relatedTarget).attr('data-kunj');
  var cbg = $(event.relatedTarget).attr('data-kcab');
	// var kunj = $(this).attr('data-kunj');
  console.log(kunj);
  $('#appendsken').empty();
  $('#maxtgl').empty();
  $.ajax({
        url:"<?= base_url('skenario/getskennotinquest')?>",
			type:"POST",
			dataType: "json",
			data:{kunj:kunj, cbg:cbg},
			success: function(result) {
        console.log(result);
        for (let index = 0; index < result.length; index++) {
          var ht = `<label class="checkbox-inline"><input type="checkbox" id="check[]" name="check[]" value="`+result[index].ksken+`">`+result[index].sken+`</label>`
          $('#appendsken').append(ht);
        }
        var ajg = `<input type="date" class="form-control" name="datekunj" max="`+result[0].planend+`" min="<?php echo date('Y-m-d');?>">`
        $('#maxtgl').append(ajg);
			}
		});
});


// Time Delivery AUVIQ

$(document).ready(function(){

$('#loadingDiv').hide().ajaxStart( function() {
      $(this).show();  // show Loading Div
  } ).ajaxStop ( function(){
$(this).hide(); // hide loading div
});

  $("#kapan_isi_form").change(function(){
      var id = $(this).children("option:selected").val();
      if(id == 'Saat di CS' || id == 'Saat di Mesin'){
        // alert("You have selected the country - " + id);
        $("#selesai_isi_form").empty();
        var cetak = `<option value="">Pilih ...</option>`;
        cetak += `<option>Tidak isi form saat antri</option>`;
        $("#selesai_isi_form").append(cetak);
      }else{
        // alert("You have selected the country - " + id);
        $("#selesai_isi_form").empty();
        var cetak = `<option value="">Pilih ...</option>`;
        cetak += `<option>Tidak tuntas lanjut di CS</option>`;
        cetak += `<option>Tuntas isi form saat antri</option>`;
        $("#selesai_isi_form").append(cetak);
        }
  });
});

$('#project_td').change(function(){
  $('#cabangxx').empty();
  var cbg = $('#project_td').val();
  var sken = $('#formxx').val();
  $('#loadingDiv').show();
  console.log(cbg);
  console.log(sken);
  $.ajax({
      url:"<?= base_url('time/getdaftarcabang')?>",
      type:"POST",
      dataType: 'json',
      data:{id:cbg, ske:sken},
      success:function(cbng){
        $('#loadingDiv').hide();
        var cetak = `<select name="cabang" id="cabang" class="form-control">
                  <option value=""> Pilih... Sisa cabang : `+cbng.length+` </option>`;
        console.log("MASUK WAY");
              for(var i=0;i<cbng.length;i++){
                cetak +=`<option value="`+cbng[i].kode+`">`+cbng[i].kode+` - `+cbng[i].nama+`</option>`;
                console.log(cbng[i].nama);
              }
              cetak +=`</select>`;
            $('#cabangxx').append(cetak);
      }
  });
});

$('#project_tdview').change(function(){
  $('#dataTables_td').empty();
  $('#dataTables_reporttd').empty();
  $('#tabletdsummary').empty();
  $('#progresstd').empty();
  var cbg = $('#project_tdview').val();
  console.log(cbg);

  $.ajax({
      url:"<?= base_url('time/getdatatd_sort_sk')?>",
      type:"POST",
      dataType: 'json',
      data:{id:cbg},
      success:function(cbng){
        $('#skenario_tdview').empty();
        $('#skenario_td_report').empty();
        console.log("masuk");
              var cetak = `<option class="selected" value="0">Pilih Skenario</option>`
              for(var i=0;i<cbng.length;i++){
                cetak +=`<option value="`+cbng[i].sk+`">`+cbng[i].name+`</option>`;
                console.log(cbng[i].name);
              }
              cetak +=`</select>`;
            $('#skenario_tdview').append(cetak);
            $('#skenario_td_report').append(cetak);
      }
  });
});

 $('#skenario_tdview').change(function(){
  $('#dataTables_td').empty();
  var projtd = $('#project_tdview').val(),
      ske = $('#skenario_tdview').val();
      console.log(projtd+`---`+ske);

  $.ajax({
      url:"<?= base_url('time/getdatatd_sort_piltd')?>",
      type:"POST",
      async: true,
      dataType: 'json',
      data:{id:projtd, ske:ske},
      success:function(test){

          var cetak =`<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                   <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Proses<center></th>
                    </tr>
                    </thead>`
        for(var i=0;i<test.length;i++){
          var j = i+1;
           cetak += `<tr>
                       <td><center>`+j+`<center></td>
                       <td>`+test[i].pilihan_td+`</td>
                      </tr>`
        }
                    cetak +=`</table>`
          $('#dataTables_td').append(cetak);

          if (document.getElementById('dataTables-example')) {

              $('#dataTables-example').DataTable({
                  "responsive": true,
                  "searching": true,
                  "ordering": true,
                  "info":     false,
                  "scrollY": "300px",
                  "scrollCollapse": true,
                  "paging": false
                  } );
              }
      }
  });
});

$('#hidesumreport').click(function(){
  $('#tabletdsummary').empty();
});


  $('#sumreport').click(function(){
    var projtd = $('#project_tdview').val(),
        ske = $('#skenario_td_report').val();
        console.log(projtd+`---`+ske);
        $('#tabletdsummary').empty();

        if (projtd!=='' && ske!=='') {


    $.ajax({
        dataType: "json",
        url: "<?= base_url('time/getdatatd_report_sum')?>",
        type:"POST",
        async: true,
        dataType: 'json',
        data:{id:projtd, ske:ske},
        success: function(result) {
          var sh =`<thead>
                <tr>
                      <th><center>Jenis Form<center></th>
                      <th><center>Kondisi Pengisian<center></th>
                      <th><center>Rata-rata TD<center></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                      <td>Paper</td>
                      <td>Tuntas isi form saat antri</td>`
                      if (result[0].rtd == null){
               sh += `<td><center> - <center></td>`
                      }else{
               sh += `<td><center>`+result[0].rtd+`<center></td>`
                      }
          sh +=`</tr>
                <tr>
                      <td>Paper</td>
                      <td>Tidak tuntas lanjut di CS</td>`
                      if (result[1].rtd == null){
               sh += `<td><center> - <center></td>`
                      }else{
               sh += `<td><center>`+result[1].rtd+`<center></td>`
                      }
          sh +=`</tr>
                <tr>
                      <td>Paper</td>
                      <td>Tidak isi form saat antri</td>`
                      if (result[2].rtd == null){
               sh += `<td><center> - <center></td>`
                      }else{
               sh += `<td><center>`+result[2].rtd+`<center></td>`
                      }
          sh +=`</tr>
                <tr>
                      <td>Eform</td>
                      <td>Tuntas isi form saat antri</td>`
                      if (result[3].rtd == null){
               sh += `<td><center> - <center></td>`
                      }else{
               sh += `<td><center>`+result[3].rtd+`<center></td>`
                      }
          sh +=`</tr>
                <tr>
                      <td>Eform</td>
                      <td>Tidak tuntas lanjut di CS</td>`
                      if (result[4].rtd == null){
               sh += `<td><center> - <center></td>`
                      }else{
               sh += `<td><center>`+result[4].rtd+`<center></td>`
                      }
          sh +=`</tr>
                <tr>
                      <td>Eform</td>
                      <td>Tidak isi form saat antri</td>`
                      if (result[5].rtd == null){
               sh += `<td><center> - <center></td>`
                      }else{
               sh += `<td><center>`+result[5].rtd+`<center></td>`
                      }
          sh +=`</tr>
                </tbody>`

            $('#tabletdsummary').append(sh);
        }

    });

        }else{
          alert('Project dan Skenario tidak boleh kosong !');
        }

  });

  $('#skenario_td_report').change(function(){
    $('#dataTables_reporttd').empty();
    var projtd = $('#project_tdview').val(),
        ske = $('#skenario_td_report').val();
        $('#progresstd').empty();
        $('#tabletdsummary').empty();
        console.log(projtd+`---`+ske);
        $('#loadingDiv').show();
        
        var ajax1 = $.ajax({
            dataType: "json",
            url: "<?= base_url('time/getdatatd_sort_piltd')?>",
            type:"POST",
            async: true,
            dataType: 'json',
            data:{id:projtd, ske:ske},
            success: function(result1) {
              console.log("success 1");
              console.log(result1.length);
              console.log(result1);
                   var ht =`<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                   <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Nama Cabang<center></th>
                      <th><center>Kapan Isi Form<center></th>
                      <th><center>Jenis Form<center></th>
                      <th><center>Kondisi Pengisian Form<center></th>
                      <th><center>Temuan<center></th>
                      <th><center>TD Full<center></th>`
                      for(var z=0;z<result1.length;z++){
                      ht +=`<th><center>`+result1[z].pilihan_td+`<center></th>`
                      ht +=`<th><center>Keterangan<center></th>`
                      }
                    ht +=`</thead>
                            </table>`
                      $('#dataTables_reporttd').append(ht);
            }
        });

        var ajax2 = $.ajax({
            dataType: "json",
            url: "<?= base_url('time/getdatawaktutd')?>",
            type:"POST",
            async: true,
            dataType: 'json',
            data:{id:projtd, ske:ske},
            success: function(result2) {
              console.log("success 2");
            }
        });

        var ajax3 = $.ajax({
            dataType: "json",
            url: "<?= base_url('time/getjumcabang')?>",
            type:"POST",
            async: true,
            dataType: 'json',
            data:{id:projtd, ske:ske},
            success: function(result3) {
              console.log("success 3");
              // console.log(result3);
            }
        });

        var ajax4 = $.ajax({
            dataType: "json",
            url: "<?= base_url('time/getdatatd_report')?>",
            type:"POST",
            async: true,
            dataType: 'json',
            data:{id:projtd, ske:ske},
            success: function(result4) {
              console.log("success 4");
              console.log(result4.length);
              console.log(result4);
            }
        });

        $.when( ajax1 , ajax2, ajax3, ajax4 ).done(function( a1, a2, a3, a4 ) {

              var longa1 = a1[0].length; //pilihan_td
              var longa2 = a2[0].length; //data_waktu_td group by
              var longa3 = a3[0].length; //get jumlah cabang
              var longa4 = a4[0].length; //data_waktu_td full

              console.log(a3[0]);
              console.log(longa2);
              console.log(longa3);
              console.log(longa4);

    var num = 0;
    var ht =`<tbody>`
    loop1:
    for (var cz=0;cz<longa3;cz++){
    
      num = num + 1;
      ht +=`<tr>`
      ht +=`<td>`+num+`</td>`
      ht +=`<td>`+a3[0][cz].nama+`</td>`
      
      ht +=`<td><center>`
      for (let cy = 0; cy < longa2; cy++) {
      if (a3[0][cz].kode==a2[0][cy].kode_cabang) {  
      ht +=``+a2[0][cy].kapan_isi_form+``
      }
      }
      ht +=`<center></td>`
      
      ht +=`<td><center>`
      for (let cy = 0; cy < longa2; cy++) {
      if (a3[0][cz].kode==a2[0][cy].kode_cabang) {  
      ht +=``+a2[0][cy].jenis_form+``
      }
      }
      ht +=`<center></td>`
      
      ht +=`<td><center>`
      for (let cy = 0; cy < longa2; cy++) {
      if (a3[0][cz].kode==a2[0][cy].kode_cabang) {  
      ht +=``+a2[0][cy].kondisi_pengisian+``
      }
      }
      ht +=`<center></td>`
      
      ht +=`<td><center>`
      for (let cy = 0; cy < longa2; cy++) {
      if (a3[0][cz].kode==a2[0][cy].kode_cabang) {  
      ht +=``+a2[0][cy].temuan+``
      }
      }
      ht +=`<center></td>`
      
      ht +=`<td><center>`
      for (let cy = 0; cy < longa2; cy++) {
      if (a3[0][cz].kode==a2[0][cy].kode_cabang) {  
      ht +=``+a2[0][cy].full+``
      }
      }
      ht +=`<center></td>`

      for (let tt = 0; tt < longa1; tt++) {
        ht +=`<td><center>`
        loop2 :
          for (let gg = 0; gg < longa4; gg++) {
            if (a3[0][cz].kode == a4[0][gg].kode_cabang && a1[0][tt].pilihan_td == a4[0][gg].proses) {
              ht +=a4[0][gg].waktu
              break loop2;
            }
          }
        ht +=`<center></td>`

        ht +=`<td><center>`
        loop3 :
          for (let gg = 0; gg < longa4; gg++) {
            if (a3[0][cz].kode == a4[0][gg].kode_cabang && a1[0][tt].pilihan_td == a4[0][gg].proses) {
              if (a4[0][gg].ket_interupsi!==null) {
              ht +=a4[0][gg].ket_interupsi
              break loop3;
              }
            }
          }
        ht +=`<center></td>`

      }
      ht +=`</tr>`
    }

    ht +=`</tbody>`

        $('#dataTables-example').append(ht);
        var jt=
              `<h5><strong>PROGRESS : `+longa2+`/`+num+`</strong></h5>`
        $('#progresstd').append(jt);
        $('#loadingDiv').hide();

        if (document.getElementById('dataTables-example')) {

    $('#dataTables-example').DataTable({
        "responsive": true,
        "paging":   true,
        "searching": true,
        "ordering": true,
        "info":     true,
        "scrollY": "300px",
        "scrollX": "300px",
        "scrollCollapse": true,
        } );
      
    }

    });
  });

  $('#exportexcel').click(function(){
    var pro = $('#project_tdview').val();
    var ske = $('#skenario_td_report').val();
    console.log(`test`+pro);
    console.log(`test`+ske);
    if (pro=='' || ske=='') {
      alert('Project dan skenario tidak boleh kosong !')
    }else{
    var table = $('#dataTables-example').DataTable();
    $('<table>')
          .append($(table.table().header()).clone())
          .append(table.$('tr').clone())
          .table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: `Report Time Delivery-`+pro+`-`+ske,
          fileext: ".xls",
          columns: [],
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
        });
      }
    });
  
    
// TAMBAHAN MENU AUVIQ EDIT TD REKAMAN
$('#project_tdedit').change(function(){
  var cbg = $('#project_tdedit').val();
  $('#dataTables_edittd').empty();
  console.log(cbg);

  // $('#cbg_tdedit').selectpicker('refresh');
  // $('#cbg_tdedit').selectpicker('hide');
  $('#cbg_tdedit').selectpicker('destroy');
  $('#cbg_tdedit').empty();

  $.ajax({
      url:"<?= base_url('time/getdatatd_sort_sk')?>",
      type:"POST",
      dataType: 'json',
      data:{id:cbg},
      success:function(cbng){
        $('#skenario_td_edit').empty();
        console.log("masuk");
              var cetak = `<option class="selected" value="0">Pilih Skenario</option>`
              for(var i=0;i<cbng.length;i++){
                cetak +=`<option value="`+cbng[i].sk+`">`+cbng[i].name+`</option>`;
                console.log(cbng[i].name);
              }
              cetak +=`</select>`;
            $('#skenario_td_edit').append(cetak);
      }
  });
});

  $('#skenario_td_edit').change(function(){
  var cbg = $('#project_tdedit').val();
  var sken = $('#skenario_td_edit').val();

  // $('#cbg_tdedit').selectpicker('refresh');
  // $('#cbg_tdedit').selectpicker('hide');
  $('#cbg_tdedit').selectpicker('destroy');
  $('#cbg_tdedit').empty();

  $('#dataTables_edittd').empty();
  console.log(cbg);
  console.log(sken);

  $.ajax({
      url:"<?= base_url('time/getcbg_tdedit')?>",
      type:"POST",
      dataType: 'json',
      data:{id:cbg, sken:sken},
      success:function(cbng){
        console.log("masuk");
              var cetak = `<option value="">Pilih Cabang</option>`
              for(var i=0;i<cbng.length;i++){
                cetak +=`<option value="`+cbng[i].kode_cabang+`">`+cbng[i].nama+`</option>`;
              }
            $('#cbg_tdedit').append(cetak);
    
            if (document.getElementById('cbg_tdedit')) {
            $('#cbg_tdedit').selectpicker({
              liveSearch:true,
              maxOptions:1
            } );
          }
      }
  });
});

  $('#cbg_tdedit').change(function(){
  var pro = $('#project_tdedit').val();
  var sken = $('#skenario_td_edit').val();
  var cbg = $('#cbg_tdedit').val();
  $('#dataTables_edittd').empty();
  console.log(pro);
  console.log(sken);
  console.log(cbg);

  $.ajax({
      url:"<?= base_url('time/getdata_tdedit')?>",
      type:"POST",
      dataType: 'json',
      data:{cbg:cbg, sken:sken, pro:pro},
      success:function(cbng){
        console.log(cbng.length);
        if (cbng.length==0) {
          var cetak = `<br>
                      <br>
                        <div class="row">
                        <div class="col-lg-12">
                          <div class="form-row">
                            <div class="col-md-12 mb" align="center">
                              <h4> <strong> Sorry, Timestamp untuk cabang ini tidak tersedia. Harap pilih cabang lainnya ! </strong> </h4>
                            </div>
                          </div>
                        </div>
                      </div>`
        }else{
var cetak = `<div class="row">
          <div class="col-lg-12">
            <div class="form-row">
              <div class="col-md-3 mb">
                <label>Kapan isi form </label>
                   <input class="kapan_isi_form form-control" name="kapan_isi_form" id="kapan_isi_form" value="`+cbng[0].kapan_isi_form+`" readonly>
                  </div> 
              <div class="col-md-3 mb">
                <label>Jenis form </label>
                <input class="jenis_form form-control" name="jenis_form" id="jenis_form" value="`+cbng[0].jenis_form+`" readonly>
              </div> 
              <div class="col-md-3 mb">
                <label>Kondisi Pengisian </label>
                <input class="selesai_isi_form form-control" name="selesai_isi_form" id="selesai_isi_form" value="`+cbng[0].kondisi_pengisian+`" readonly>
              </div>
              <div class="col-md-1 mb">
                <label>TD Full </label>
                <input class="full form-control" name="full" id="full" value="`+cbng[0].full+`" readonly>
              </div>                    
            </div>
          </div>
        </div>`

        cetak +=`<div class="row">
                 <div class="col-lg-12">
                   <div class="form-row">
                     <div class="col-md-1 md">
                      <label>No </label>`
                      for(var i1=0;i1<cbng.length;i1++){
                        var numm = i1 +1;
              cetak +=`<input class="id_waktu form-control" name="number" id="number" value="`+numm+`" readonly>
                       <input type="hidden" name="id_waktu`+i1+`" id="id_waktu`+i1+`" value="`+cbng[i1].id_waktu+`" readonly>
                       <br>`
                      }
            cetak +=`</div> 
                     <div class="col-md-3 mb">
                       <label>Proses </label>`
                       for(var i2=0;i2<cbng.length;i2++){
              cetak +=`<input class="proses form-control" name="proses" id="proses" value="`+cbng[i2].proses+`" readonly>
                       <br>`
                      }
            cetak +=`</div> 
                     <div class="col-md-6 mb">
                     <label>Keterangan Proses </label>`
                      for(var i3=0;i3<cbng.length;i3++){
              cetak +=`<input class="ket_interupsi form-control" name="ket_interupsi" id="ket_interupsi" value="`+cbng[i3].ket_interupsi+`" readonly>
                       <br>`
                       }
            cetak +=`</div>
                     <div class="col-md-1 mb">
                     <label>Start TD </label>`
                        for(var i4=0;i4<cbng.length;i4++){
              cetak +=`<input class="start_waktu form-control" name="start_waktu" id="start_waktu" value="`+cbng[i4].start_td+`" readonly>
                       <br>`
                       }
            cetak +=`</div>
                     <div class="col-md-1 mb">
                     <label>Durasi </label>`
                     for(var i5=0;i5<cbng.length;i5++){
              cetak +=`<input class="waktu form-control" name="waktu" id="waktu" value="`+cbng[i5].waktu+`">
                       <br>`
                       }
            cetak +=`</div>
                   </div>
                 </div>
                </div>
                
            <div class="row">
              <div class="col-lg-12">
                <div class="form-row">
                  <div class="col-md-10 mb" align="right">
                      <label for=""> <strong> Akhir TD Burek </strong> </label>
                  </div>
                  <div class="col-md-1 mb">
                      <input type="text" class="form-control" name="akhirburek" id="akhirburek" value="`+cbng[0].akhir_td+`" readonly>
                  </div>
                  <div class="col-md-1 mb">
                  <a></a>
                  </div>
                </div>
              </div>
            </div>`
    if (cbng[0].part_1 !== null ){
    cetak +=`div class="row">
              <div class="col-lg-12">
                <div class="form-row">
                  <div class="col-md-10 mb" align="right">
                      <label for=""> <strong> Durasi Part 1 </strong> </label>
                  </div>
                  <div class="col-md-1 mb">
                      <input type="text" class="form-control" name="akhirburek" id="akhirburek" value="`+cbng[0].part_1+`" readonly>
                  </div>
                  <div class="col-md-1 mb">
                  <a></a>
                  </div>
                </div>
              </div>
            </div>`
          }
    cetak +=`<div class="row">
              <div class="col-lg-12">
                <div class="form-row">
                  <div class="col-md-10 mb" align="left">
                      <label for=""> <strong> Temuan </strong> </label>
                      <input type="text" class="form-control" name="akhirburek" id="akhirburek" value="`+cbng[0].temuan+`" readonly>
                  </div>
                  <div class="col-md-12 mb">
                  <a></a>
                  </div>
                </div>
              </div>
            </div>`    
        
        }
      $('#dataTables_edittd').append(cetak);
    }
  });
});


  // $('#addpg').click(function(){
  // function addpg() {
  //   j = j + 1;
  //   var ht = `<div class="form-group">
  //                       <label class="col-sm-3 control-label">Pilihan `+j+` </label>
  //                       <div class="col-sm-3">
  //                       <input type="text" class="form-control" name="pg`+j+`" id="pg`+j+`">
  //                       </div>
  //                   </div>`;
  //   // $('#pilihanganda').append(ht);
  //   $('#soalsoal').append(ht);

  //   $('#jumlahpg').empty();
  //     var input = `<input type="hidden" name="jmlpg" id="jmlpg" value="`+j+`"/>`;
  //   $('#jumlahpg').append(input);
  // }

  $('#addpglain').click(function(){
    j = j + 1;
    var ht = `<div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan `+j+` </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jb`+j+`" id="jb`+j+`">
                        </div>
                    </div>`;
    $('#pilihanlainnya').append(ht);
  });

  $('#addjenissoal').click(function(){

      var radios = document.getElementsByName('cek');
      for (var i = 0, length = radios.length; i < length; i++)
      {
        if (radios[i].checked)
        {
          var x = (radios[i].value);
        }
      }

      if(x == 1 || x == 2){
        if(x==1){
          var nilai = 1;
        } else {
          var nilai = 2;
        }
        var ht = `<div class="row">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan `+j+` </strong></h4>
                        <div class="form-horizontal style-form">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Pertanyaan</label>
                                <div class="col-sm-1">
                                <input type="text" class="form-control" name="kode`+j+`" id="kode`+j+`" placeholder="Kode">
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="message`+j+`" id="message`+j+`" placeholder="Pertanyaan.." rows="1"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="jenissoal`+j+`" id="jenissoal`+j+`" value="`+nilai+`">

                    </div>
                </div>`;
      }

      if(x == 3){
        var ht = `<div class="row" id="pertanyaan1">
                <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan `+j+` </strong></h4>
                    <div class="form-horizontal style-form">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pertanyaan</label>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kode`+j+`" id="kode`+j+`" placeholder="Kode">
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="message`+j+`" id="message`+j+`" placeholder="Pertanyaan.." rows="1"></textarea>
                        </div>
                    </div>

                    <section id="pilihanganda`+j+`">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg1`+j+`" id="pg1`+j+`">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg1`+j+`" id="kodepg1`+j+`" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump1`+j+`" id="jump1`+j+`" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                    </div>
                    </section>
                    <section id="jumlahpg`+j+`"><input type="hidden" name="jmlpg`+j+`" id="jmlpg`+j+`" value="1"/></section>
                  <input type="hidden" name="jenissoal`+j+`" id="jenissoal`+j+`" value="3">
                <button type="button" class="btn btn-round btn-primary" onclick="addpg(`+j+`)"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                </div>
                </div>`;
              }
              // <button type="button" class="btn btn-round btn-primary" id="addpg"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>

      if(x==4){
          var ht = `<div class="row" id="pertanyaan1">
                <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan `+j+` </strong></h4>
                    <div class="form-horizontal style-form">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pertanyaan</label>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kode`+j+`" id="kode`+j+`" placeholder="Kode">
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="message`+j+`" id="message`+j+`" placeholder="Pertanyaan.." rows="1" required></textarea>
                        </div>
                    </div>

                    <section id="pilihanganda`+j+`">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan 1 </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg1`+j+`" id="pg1`+j+`">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg1`+j+`" id="kodepg1`+j+`" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump1`+j+`" id="jump1`+j+`" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                    </div>
                    </section>
                    <section id="jumlahpg`+j+`"><input type="hidden" name="jmlpg`+j+`" id="jmlpg`+j+`" value="1"/></section>
                    <input type="hidden" name="jenissoal`+j+`" id="jenissoal`+j+`" value="3">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan Lainnya </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="lain" id="lain" disabled>
                        </div>
                    </div>
                  <input type="hidden" name="jenissoal`+j+`" id="jenissoal`+j+`" value="4">
                <button type="button" class="btn btn-round btn-primary" onclick="addpg(`+j+`)"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                </div>
                </div>
                </div>`;
      }

      if(x==5){
         var ht = `<div class="row" id="pertanyaan1">
                <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan `+j+` </strong></h4>
                    <div class="form-horizontal style-form">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pertanyaan</label>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kode`+j+`" id="kode`+j+`" placeholder="Kode">
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="message`+j+`" id="message`+j+`" placeholder="Pertanyaan.." rows="1"></textarea>
                        </div>
                    </div>

                    <section id="pilihanganda`+j+`">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan Multiple</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg1`+j+`" id="pg1`+j+`">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg1`+j+`" id="kodepg1`+j+`" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump1`+j+`" id="jump1`+j+`" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                    </div>
                    </section>
                    <section id="jumlahpg`+j+`"><input type="hidden" name="jmlpg`+j+`" id="jmlpg`+j+`" value="1"/></section>
                  <input type="hidden" name="jenissoal`+j+`" id="jenissoal`+j+`" value="5">
                <button type="button" class="btn btn-round btn-primary" onclick="addpg(`+j+`)"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                </div>
                </div>`;
      }


      $('#soalsoal').append(ht);
      $('#jumlahsoal').empty();
      var input = `<input type="hidden" name="jmlsoal" id="jmlsoal" value="`+j+`"/>`;
      $('#jumlahsoal').append(input);
      j= j +1;
  });

  $("#addjeniskonsistensi").click(function(){
      var radios = document.getElementsByName('cek');
      for (var i = 0, length = radios.length; i < length; i++)
      {
        if (radios[i].checked)
        {
          var x = (radios[i].value);
        }
      }

      if (x==1){
        var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Antar Kunjungan </strong></h4>
                    <input type="hidden" name="cek_`+k+`" id="cek_`+k+`" value=1>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Kode Soal</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="kode_cek1`+k+`" id="kode_cek1`+k+`" required>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1`+k+`" id="ket_cek1`+k+`" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
      }

      if(x==2){
        var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Hanya Jika </strong></h4>
                    <input type="hidden" name="cek_`+k+`" id="cek_`+k+`" value=2>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1`+k+`" id="kode_cek1`+k+`" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek1`+k+`" id="nilai_cek1`+k+`" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1`+k+`" id="ket_cek1`+k+`" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
      }

      if(x==3){
        var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Jika Maka</strong></h4>
                    <input type="hidden" name="cek_`+k+`" id="cek_`+k+`" value=3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1`+k+`" id="kode_cek1`+k+`" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek1`+k+`" id="nilai_cek1`+k+`" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Maka Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2`+k+`" id="kode_cek2`+k+`" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2`+k+`" id="nilai_cek2`+k+`" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1`+k+`" id="ket_cek1`+k+`" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
      }

      if(x==4){
        var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Jika Tapi</strong></h4>
                    <input type="hidden" name="cek_`+k+`" id="cek_`+k+`" value=4>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1`+k+`" id="kode_cek1`+k+`" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control"name="nilai_cek1`+k+`" id="nilai_cek1`+k+`"  required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Tapi Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2`+k+`" id="kode_cek2`+k+`" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2`+k+`" id="nilai_cek2`+k+`" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1`+k+`" id="ket_cek1`+k+`" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
      }

      if(x==5){
        var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rentang Waktu </strong></h4>
                <input type="hidden" name="cek_`+k+`" id="cek_`+k+`" value=5>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1`+k+`" id="kode_cek1`+k+`" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek1`+k+`" id="nilai_cek1`+k+`" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Maka Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2`+k+`" id="kode_cek2`+k+`" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2`+k+`" id="nilai_cek2`+k+`" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1`+k+`" id="ket_cek1`+k+`" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
      }

      $("#datakonsistensi").append(ht);
      $('#jumlahdata').empty();
      var input = `<input type="hidden" name="jmldata" id="jmldata" value="`+k+`"/>`;
      $('#jumlahdata').append(input);
      k= k +1;
  });

  $('#addkolomskill').click(function(){
    l= l +1;
    var ht = ` <div class="form-group">
                        <label class="col-sm-2 control-label">Kode Kolom</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="kode`+l+`" id="kode`+l+`">
                        </div>
                        <label class="col-sm-2 control-label">Pertanyaan</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="pertanyaan`+l+`" id="pertanyaan`+l+`">
                        </div>
                        <label class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="keterangan`+l+`" id="keterangan`+l+`">
                        </div>
                        </div>`;
      $('#kolomskill').append(ht);
      $('#jmlkolomskill').empty();
      var input = `<input type="hidden" name="jmlkolomskill" id="jmlkolomskill" value="`+l+`"/>`;
      $('#jmlkolomskill').append(input);
  });

  $('#addpil').click(function(){
    m= m +1;
    console.log(m);
    var ht = `<div class="form-group">
                            <label class="col-sm-2 control-label"> Pilihan `+m+` </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pil`+m+`" id="pil`+m+`">
                            </div>
              </div>`;
    $('#pil').append(ht);
    $('#jmlpilihan').empty();
    var input = `<input type="hidden" class="form-control" name="jmlpil" id="jmlpil" value="`+m+`">`;
    $('#jmlpilihan').append(input);
  });


  $('#addpiltd1').click(function(){
    var sek = $('#id_skenario_a').val(); //VIEW LIHAT VALIDASI INI GA ADA BRO
    var pro = $('#project_td').val();
    var ht = `<div class="row">
                        <div class="col-md-9 mb">
                            <select class="form-control" name="piltd`+n+`" id="piltd`+n+`" onchange="interupsi(`+n+`)">
                                <option value=""> Proses ke - `+n+` </option>
                            `;
    var f = n;
    var hx = [];
    for (g=1;g<f;g++){
      var sl = "#piltd"+g+" option:selected";
      var jx = $(sl).val();
      hx.push(jx);
    }
    $.ajax({
        url:"<?= base_url('time/jenistime')?>",
        type:"POST",
        dataType: 'json',
        data:{skenario:sek,project:pro},
        success:function(hasil){
            for(i=0;i<hasil.length;i++){
              var dec = 0
              for (var h=0;h<f;h++){
                if(hasil[i].pilihan_td == hx[h]){
                  dec = 1;
                console.log(hasil[i].pilihan_td+`><`+hx[h])
                }
              }
              if (dec == 0){
              ht = ht + `<option value="`+hasil[i].pilihan_td+`"> `+hasil[i].pilihan_td+` </option>`;
              }
            }

            // TAMBAHAN BARU
            var vid = document.getElementById("rekaman");
            var time = ``+vid.currentTime+``;
            var time1 = time.toHHMMSS(); //INI ADA FUNCTION NYA
            // AKHIR

            ht = ht  + `</select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="jbpiltd`+n+`" id="jbpiltd`+n+`" value="`+time1+`">
                        </div>
                    </div>
                    <section id="interupsi`+n+`"></section>`;
     $('#piltd1').append(ht);
        }
    });


    var htl = `<input type="hidden" class="form-control mb" name="jumlahpiltd" id="jumlahpiltd" value="`+n+`">`;
    $('#jmlpiltd').empty();
    $('#jmlpiltd').append(htl);
      n= n +1;
  });

  $('#addpiltd2').click(function(){
    var time = $('#rekaman').currentTime;
    var htl = `<input type="text" class="form-control mb" name="jumlahpiltd" id="jumlahpiltd" value="`+time+`">`;
    $('#piltd1').append(htl);
  });

  $("#formxx").change(function(){
    $("#piltd1").empty();
    $("#cabang").empty();
    // console.log("MASUK WAY");
    var id = "#formxx option:selected";
    var optionText = $(id).val();
    // console.log(optionText);
    $("#id_skenario_a").val(optionText);
    n=1;
  });

  // $("select.form-control").change(function(){
  //   console.log("MASUK WAY");
  //   var char = $(this).children("option:selected").val();
  //   console.log(char);
  // });

  $(".textarea").focus(function(){
    $(this).css("height", "300px");
  });

  $(".textarea").focusout(function(){
    $(this).css("height", "");
  });

  $('#sproject').change(function(){
        var id=$(this).val();
        $('#skunjungan').empty();
        console.log(id);
        $.ajax({
            url : "<?php echo base_url('validasi/getkunjungan') ?>",
            method : "POST",
            data : {id: id},
            // async : false,
            dataType : 'json',
            success: function(hasil){
              var cetak =`<option>Pilih Kunjungan</option>`;
              for (var i = 0; i < hasil.length; i++) {
                cetak += "<option value='" + hasil[i]['kategori'] + "'>" + hasil[i]['kunjunganx'] + "</option>";
                console.log(hasil[i]['kunjunganx']);
              }
              $(".kunjungan").append(cetak);
            }
        });
    });

  $('#skunjungan').change(function(){
        var id=$(this).val();
        var project=$('#sproject').val();
        $(".skenario").empty();
        $.ajax({
            url : "<?php echo base_url('validasi/getskenario') ?>",
            method : "POST",
            data : {id: id, pro:project},
            // async : false,
            dataType : 'json',
            success: function(hasil){
              console.log(hasil);
              var cetak = `<option>Pilih Skenario</option>`;
              for (var i = 0; i < hasil.length; i++) {
                cetak += "<option value='" + hasil[i]['att'] + "'>" + hasil[i]['skenariox'] + "</option>";
              }
              $(".skenario").append(cetak);
            }
        });
    });

  $('#rekamanskenario').change(function(){
        var project=$('#sproject').val();
        var sken=$('#rekamanskenario').val();
        $("#rekamancabang").empty();
        $.ajax({
            url : "<?php echo base_url('validasi/getcabangrekaman') ?>",
            method : "POST",
            data : {pro:project, sken:sken},
            dataType : 'json',
            success: function(hasil){
              console.log(hasil);
              var cetak = `<option>Pilih Cabang</option>`;
              for (var i = 0; i < hasil.length; i++) {
                cetak += "<option value='" + hasil[i]['kode'] + "'>" + hasil[i]['kode'] + " - " + hasil[i]['nama'] + "</option>";
              }
              $("#rekamancabang").append(cetak);
              // $(".cabang").append(cetak);
            }
        });
    });
    
  $('#temskenario').change(function(){
        var project=$('#sproject').val();
        var sken=$('#temskenario').val();
        $("#rekamancabang").empty();
        $.ajax({
            url : "<?php echo base_url('shp/getcabangrekaman') ?>",
            method : "POST",
            data : {pro:project, sken:sken},
            dataType : 'json',
            success: function(hasil){
              console.log(hasil);
              if (hasil.length>=1) {
                var cetak = `<option>Pilih Cabang</option>`;
                for (var i = 0; i < hasil.length; i++) {
                  cetak += "<option value='" + hasil[i]['kode'] + "'>" + hasil[i]['kode'] + " - " + hasil[i]['nama'] + "</option>";
                }
                $("#rekamancabang").append(cetak);
              }else{
                var cetak = `<option>Cabang tidak tersedia</option>`
                $("#rekamancabang").append(cetak);
              }
            }
        });
    });

    // $("input[name='ulang']").click(function(){
    //     var radios = document.getElementsByName('ulang');
    //     for (var i = 0, length = radios.length; i < length; i++)
    //     {
    //       if (radios[i].checked)
    //       {
    //         var x = (radios[i].value);
    //         if (x==1){
    //           $('#ulangi').empty();
    //           var ht = `<div class="form-group">
    //                         <label class="col-sm-5 control-label">Kesalahan Dari : </label>
    //                         <div class="col-sm-7">
    //                             <label class="radio-inline">
    //                                 <input type="radio" name="salah" id="salah" value=1>Salah Pewitness
    //                             </label>

    //                             <label class="radio-inline">
    //                                 <input type="radio" name="salah" id="salah" value=2 checked>Bukan Salah Pewitness
    //                             </label>
    //                         </div>
    //                     </div>
    //                     <br><br>`;
    //           $('#ulangi').append(ht);
    //         } else {
    //           $('#ulangi').empty();
    //         }
    //       }
    //     }
    // });

});

$(document).ready(function(){

var i = 0;

  $("#tambahtemuan").click(function(){

        // $("#jumlahtemuan").remove();
        i = i + 1;
        // var id = `<input type="hidden" id="jumlahtemuan" name="jumlahtemuan" value="`+i+`">`;
        $('#jumlahtemuan').val(i);

        // $("#fototemuan").append(id);

        var ht =`
            <div class="col-lg-1 mb" style="margin-right:-50px;"><p> `+i+`. </p></div>
            <div class="col-lg-8 mb">
                <input class="form-control" type="text" name="kettemuan`+i+`" placeholder="Tulis Keterangan Temuan Di sini ...">
              </div>

              <div class="col-lg-3 mb" style="margin-right:50px;">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <span class="btn btn-theme02 btn-file">
                      <span class="fileupload-new pull-right"><i class="fa fa-paperclip"></i> Pilih File</span>
                  <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                  <input type="file" class="default" name="filetemuan`+i+`" id="filetemuan`+i+`" required/>
                  </span>
                  <span class="fileupload-preview" style="margin-left:5px;"></span>
                  <a href="advanced_form_components.html#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a><br>
                </div>
                  <span class="label label-info"  style="margin-top : 2rem;">NOTE!</span>
                  <span>Format File (.jpg, .gif)
                  </span>
              </div>`
        
        $("#fototemuan").append(ht);


  });
});


$(document).ready(function(){

    var i = 0;

    $("#buatskenario").click(function(){
      $.ajax({
      url : "<?php echo base_url('skenario/getAllDataSkenario') ?>",
      async : false,
      dataType : 'json',
      success: function(hasil){
        $(".jumlah").remove();
        i = i + 1;

        var ht =
        `<div id="row`+i+`">
        <div class="row">

          <div class="col-sm-3">
            <label>Pilih skenario ke - `+i+` : </label>
          </div>

          <div class="col-sm-3">
            <select class="form-control" name="skenario`+i+`" id="skenario`+i+`" required>
             <option val="">Pilih Skenario</option>`
    for (var j = 0; j < hasil.length; j++) {
      ht += `<option value="` + hasil[j]['kode'] + `">` + hasil[j]['nama'] + `</option>`;
            }
     ht +=`</select>
          </div>
        </div>
        </div>
        <br>`;

        $("#allskenario").append(ht);
        var id = `<input type="hidden" id="jumlahskenario" name="jumlahskenario" value="`+i+`">`;
        $("#allskenario").append(id);
        var k = `<label value="`+i+`"class="col-lg-2 control-label jumlah">Jumlah Skenario : `+i+`</label>`;
        $("#jumlah").append(k);
      }
    });
  });
});

$(document).on('click', 'btn_remove', function(){
var button_id = $(this).attr("id");
$('#row'+button_id+'').remove();
});

/************ Javascript Tedi ****************/
$(document).ready(function(){
    $('#projectted').change(function(){
        var id=$(this).val();
        $.ajax({
            url : "<?php echo base_url('stkb/getkotaproject') ?>",
            method : "POST",
            data : {id: id},
            async : false,
            dataType : 'json',
            success: function(hasil){
              console.log(hasil);
              $("#kotated").empty();
              $("#tampilancabang").empty();
              var y = 0;
              var cetak = "<option>Pilih Kota</option>";;
              for (var i = 0; i < hasil.length; i++) {
                cetak += "<option value='" + hasil[i]['kota'] + "'>" + hasil[i]['kota'] + "</option>";
              }
              $("#kotated").append(cetak);
            }
        });
    });


  $('#kotated').change(function(){
    var id = $("#projectted").val(),
        kota = $("#kotated").val();

        console.log(id + " --> " + kota);
    $.ajax({
      url : "<?php echo base_url('stkb/getdaftarcabang') ?>",
      method : "POST",
      data : {id: id, kota: kota},
      async : false,
      dataType : 'json',
      success : function(coba){
        // console.log(coba);
        $("#tampilancabang").empty();
        var y = 0;
        var cobaah = "";
        for (var i = 0; i < coba.length; i++){
          // cobaah += "<div class='row'>"
          // cobaah += "<div class='col-sm-4'>"
          // cobaah += "<input type='hidden' name='cabang[]' value='" + coba[i]['kocab'] + "' class='form-control' readonly>";
          // cobaah += "<input type='text' class='form-control' placeholder='" + coba[i]['nacab'] + "' readonly>";
          // cobaah += "</div>";
          // var result,resul2;
          // result = coba[i]['skennya'].split(",");
          // // console.log(result[0]);
          // resul2 = coba[i]['namasken'].split(",");
          // // console.log(resul2);
          // for(var o = 0; o < result.length; o++){
          //   cobaah += "<div class='col-sm-1'>"
          //   cobaah += "<div class='form-group'>";
          //   cobaah += "<div class='checkbox'>";
          //   cobaah += "<label><input type='checkbox' name='kodesken' value='" + result[o] + "'>"+  resul2[o]+"</label>";
          //   cobaah += "</div>";
          //   cobaah += "</div>";
          //   cobaah += "</div>";

          // IWAYRIWAY
          cobaah += "<div class='row'>"
          cobaah += "<div class='col-sm-4'>"
          cobaah += "<input type='hidden' name='cabang"+i+"' value='" + coba[i]['kocab'] + "'>";
          cobaah += "<input type='text' class='form-control' placeholder='" + coba[i]['kocab'] + " - " + coba[i]['nacab'] + "' readonly>";
          cobaah += "</div>";
          var result,resul2;
          result = coba[i]['skennya'].split(",");
          // console.log(result[0]);
          resul2 = coba[i]['namasken'].split(",");
          // console.log(resul2);
          for(var o = 0; o < result.length; o++){
            cobaah += "<div class='col-sm-1'>"
            cobaah += "<div class='form-group'>";
            cobaah += "<div class='checkbox'>";
            cobaah += "<label><input type='checkbox' name='"+i+"kodesken[]' value='" + result[o] + "'>"+  resul2[o]+"</label>";
            cobaah += "</div>";
            cobaah += "</div>";
            cobaah += "</div>";
          // AKHIR
          }
          cobaah += "</div>";
        } cobaah += `<input type="hidden" name="jumlahcabang" id="jumlahcabang" value="`+i+`">`;
        $("#tampilancabang").append(cobaah);
      }
    })
  });
});
/************ //Javascript Tedi ****************/
</script>

<!-- <script type="text/javascript">
    $('#addpg').click(function(){
      j = j + 1;
      var ht = `<div class="form-group">
                          <label class="col-sm-3 control-label">Pilihan `+j+` </label>
                          <div class="col-sm-3">
                          <input type="text" class="form-control" name="jb`+j+`" id="jb`+j+`">
                          </div>
                      </div>`;
      $('#pilihanganda').append(ht);
    });
  </script> -->

<script src="<?= base_url('assets/')?>lib/fancybox/jquery.fancybox.js"></script>

<script type="text/javascript">
    $(function() {
      jQuery(".fancybox").fancybox();
    });
</script>
<script src="<?=base_url('assets/')?>js/jquery.dataTables.js"></script>
<script src="<?=base_url('assets/')?>js/dataTables.bootstrap.js"></script>
    <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
                $('#dataTables-example-2').dataTable();
            });
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</body>

</html>
