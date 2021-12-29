   <!--footer start-->
   <footer class="site-footer">
     <div class="text-center">
       <p>
         &copy; Copyrights 2019 - <?= date('Y') ?> <strong>MRI</strong>. All Rights Reserved
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


   <script type="text/javascript" src="<?= base_url('assets/') ?>lib/advanced-datatable/js/DT_bootstrap.js"></script>

   <!-- js placed at the end of the document so the pages load faster -->
   <script src="<?= base_url('assets/') ?>lib/jquery/jquery.min.js"></script>
   <script src="<?= base_url('assets/') ?>lib/bootstrap/js/bootstrap.min.js"></script>
   <script src="<?= base_url('assets/') ?>lib/jquery-ui-1.9.2.custom.min.js"></script>
   <script src="<?= base_url('assets/') ?>lib/jquery.ui.touch-punch.min.js"></script>
   <script class="include" type="text/javascript" src="<?= base_url('assets/') ?>lib/jquery.dcjqaccordion.2.7.js"></script>
   <script src="<?= base_url('assets/') ?>lib/jquery.scrollTo.min.js"></script>
   <script src="<?= base_url('assets/') ?>lib/jquery.nicescroll.js" type="text/javascript"></script>

   <script type="text/javascript" src="<?= base_url('assets/') ?>lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
   <script type="text/javascript" src="<?= base_url('assets/') ?>lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
   <script type="text/javascript" src="<?= base_url('assets/') ?>lib/bootstrap-daterangepicker/date.js"></script>
   <script type="text/javascript" src="<?= base_url('assets/') ?>lib/bootstrap-daterangepicker/daterangepicker.js"></script>
   <script type="text/javascript" src="<?= base_url('assets/') ?>lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
   <script type="text/javascript" src="<?= base_url('assets/') ?>lib/bootstrap-daterangepicker/moment.min.js"></script>
   <script type="text/javascript" src="<?= base_url('assets/') ?>lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
   <script src="<?= base_url('assets/') ?>lib/advanced-form-components.js"></script>
   <script src="<?php echo base_url('assets/sweet/') ?>js/sweetalert2.all.min.js"></script>
   <script src="<?php echo base_url('assets/') ?>js.js"></script>
   <script src="<?php echo base_url('assets/js/') ?>jquery.table2excel.js"></script>
   <script src="<?php echo base_url('assets/js/') ?>bootstrap-select.min.js"></script>

   <script src="<?php echo base_url('assets/js/') ?>pegadaian.js"></script>
   <script src="<?php echo base_url('assets/js/') ?>validasidata.js"></script>

   <!--common script for all pages-->
   <script src="<?= base_url('assets/') ?>lib/common-scripts.js"></script>
   <!--script for this page-->

   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js"></script>
   <!-- <script src="<?= base_url('assets/') ?>scriptmusik.js"></script> -->

   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



   <!-- STICKY -->
   <script>
     var fixmeTop = $('#headerrekaman').offset().top; // get initial position of the element

     $(window).scroll(function() { // assign scroll event listener

       var currentScroll = $(window).scrollTop(); // get current position

       if (currentScroll >= fixmeTop) { // apply position: fixed if you
         $('#headerrekaman').css({
           position: 'fixed',
           top: '0',
         });
       } else { // apply position: static
         $('#headerrekaman').css({ // if you scroll above it
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

     function seektimeupdate() {
       var audio = document.getElementById("audio");
       var nt = audio.currentTime * (100 / audio.duration);
       seekslider.value = nt;
       var curmins = Math.floor(audio.currentTime / 60);
       var cursecs = Math.floor(audio.currentTime - curmins * 60);
       var durmins = Math.floor(audio.duration / 60);
       var dursecs = Math.floor(audio.duration - durmins * 60);

       if (cursecs < 10) {
         cursecs = "0" + cursecs;
       }
       if (dursecs < 10) {
         dursecs = "0" + dursecs;
       }
       if (curmins < 10) {
         curmins = "0" + curmins;
       }
       if (durmins < 10) {
         durmins = "0" + durmins;
       }
       curtimetext.innerHTML = curmins + ":" + cursecs;
       durtimetext.innerHTML = durmins + ":" + dursecs;
     }

     function advance(duration, element) {
       var progress = document.getElementById("progress");
       increment = 10 / duration
       percent = Math.min(increment * element.currentTime * 10, 100);
       progress.style.width = percent + '%'
       startTimer(duration, element);
     }

     function startTimer(duration, element) {
       if (percent < 100) {
         timer = setTimeout(function() {
           advance(duration, element)
         }, 100);
       }
     }

     function togglePlay(e) {
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
       if (n != "") {
         $.ajax({
           url: "<?= base_url('equestisi/jump') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             ketsoal: n,
             pembuat: x,
             soal: w
           },
           success: function(hasil) {

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
         }); //}
       }

       if (n == "") {
         console.log(w);
         console.log(n);
         console.log(x); //console.log("RIWAY MASUK");
         $.ajax({
           url: "<?= base_url('equestisi/jumpnull') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             ketsoal: n,
             pembuat: x,
             soal: w
           },
           success: function(hasil) {
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
       if (n > slides.length) {
         slideIndex = n - 1
       }
       if (n < 1) {
         slideIndex = 1
       }
       for (i = 0; i < slides.length; i++) {
         slides[i].style.display = "none";
       }
       for (i = 0; i < dots.length; i++) {
         dots[i].className = dots[i].className.replace(" active", "");
       }
       slides[slideIndex - 1].style.display = "block";
       dots[slideIndex - 1].className += " active";
     }
   </script>
   <!-- Akhir Carosel -->

   <script>
     var z = 1;
     var x = 1;
     var dlama;

     function addpg(b) {
       var dbaru = b;
       if (dlama != dbaru) {
         console.log(dbaru);
         z = 1;
         dlama = b;
       }
       z = z + 1;
       var ht = `<div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan Selanjutnya</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg` + z + `` + b + `" id="pg` + z + `` + b + `">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg` + z + `` + b + `" id="kodepg` + z + `` + b + `" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump` + z + `` + b + `" id="jump` + z + `` + b + `" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                    </div>`;
       var id = '#pilihanganda' + b;
       var name = 'pilihanganda' + b;
       $(id).append(ht);

       $(`#jumlahpg` + b).empty();
       var input = `<input type="hidden" name="jmlpg` + b + `" id="jmlpg` + b + `" value="` + z + `"/>`;
       $(`#jumlahpg` + b).append(input);
     }

     function interupsi(idnya) {
       var id = "#piltd" + idnya + " option:selected";
       // TAMBAHAN CODE BARU
       var idnya = idnya + 1;
       // AKHIR
       var section = "#interupsi" + idnya;
       console.log(section);
       console.log("HAI WAY");
       var optionText = $(id).val();
       var option = $(id).text();
       // if(optionText.search("Interupsi")>=0){
       var ht = `<input type="text" class="form-control mb" name="ketinterupsi` + x + `" id="ketinterupsi` + x + `" placeholder="Keterangan ` + option + `" required>`;
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

     function editbyid(id, no) {
       var input = "#kode" + no;
       var text = "#message" + no;
       var kode = $(input).val();
       var soal = $(text).val();
       $.ajax({
         url: "<?= base_url('equestbaru/ubahbyid') ?>",
         type: "POST",
         dataType: 'json',
         data: {
           id: id,
           kode: kode,
           soal: soal
         },
         success: function(hasil) {
           $(input).val(kode);
           $(text).val(soal);
         }
       });
     }

     function editpgbyid(id1, no1) {
       var input = "#pg" + no1;
       var text = "#kodepg" + no1;
       var jump1 = "#jump" + no1;
       var kode = $(input).val();
       var soal = $(text).val();
       var jump = $(jump1).val();
       console.log(id1);
       console.log(kode);
       console.log(soal);
       console.log(jump);
       $.ajax({
         url: "<?= base_url('equestbaru/ubahbyid1') ?>",
         type: "POST",
         dataType: 'json',
         data: {
           id: id1,
           kode: kode,
           soal: soal,
           jump: jump
         },
         success: function(hasil) {
           $(input).val(kode);
           $(text).val(soal);
           $(jump1).val(jump);
         }
       });
     }

     function addpgedit(nomor) {
       var section = '#jumlahpg' + nomor;
       var jumlah = '#jmlpg' + nomor;
       var jml = $(jumlah).val();
       var ht = `<div class="form-group ` + nomor + `` + jml + `">
                        <label class="col-sm-3 control-label">Pilihan Baru</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg` + nomor + `` + jml + `" id="pg` + nomor + `` + jml + `">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg` + nomor + `` + jml + `" id="kodepg` + nomor + `` + jml + `" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump` + nomor + `` + jml + `" id="jump` + nomor + `` + jml + `" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                        <div class="col-sm-2 btn` + nomor + `` + jml + `">
                            <button class="btn btn-primary btn-round btn-sm" onclick="savepgedit(` + nomor + `,` + nomor + `` + jml + `)"><span class="fa fa-plus fa-fw"></span> Simpan </button>
                        </div>
                    </div>`;
       var id = '#pilihanganda' + nomor;
       $(id).append(ht);

       var total = parseInt(jml) + 1;
       var ht1 = `<input type="hidden" name="jmlpg` + nomor + `" id="jmlpg` + nomor + `" value="` + total + `"/>`;
       $(section).empty();
       $(section).append(ht1);
     }

     function savepgedit(r, s) {
       var id = '#id' + r;
       var id1 = $(id).val();
       var soal = $('#pg' + s).val();
       var kode = $('#kodepg' + s).val();
       var jump = $('#jump' + s).val();
       $.ajax({
         url: "<?= base_url('equestbaru/savepgedit') ?>",
         type: "POST",
         dataType: 'json',
         data: {
           id: id1,
           kode: kode,
           soal: soal,
           jump: jump
         },
         success: function(hasil) {
           $('#kodepg' + s).val(kode);
           $('#pg' + s).val(soal);
           $('#jump' + s).val(jump);
           $('.btn' + s).empty();
           var ht = `<button onclick="editpgbyid(` + hasil.id_pg_equest + `,` + s + `)" class="btn btn-success btn-round btn-sm"><span class="fa fa-edit fa-fw"></span> Edit </button>
              <button onclick="hapuspgbyid(` + hasil.id_pg_equest + `,` + s + `)" class="btn btn-danger btn-round btn-sm"><span class="fa fa-trash fa-fw"></span> Hapus </button>`;
           $('.btn' + s).append(ht);
         }
       });
     }

     function hapusbyid(id, nomor) {
       console.log(id);
       $.ajax({
         url: "<?= base_url('equestbaru/hapusbyid') ?>",
         type: "POST",
         dataType: 'json',
         data: {
           id: id
         },
         success: function(hasil) {
           $('.' + nomor).remove();
         }
       });
       $('.' + nomor).remove();
     }

     function hapuspgbyid(id, nomor) {
       console.log(id);
       $.ajax({
         url: "<?= base_url('equestbaru/hapuspgbyid') ?>",
         type: "POST",
         dataType: 'json',
         data: {
           id: id
         },
         success: function(hasil) {
           $('.' + nomor).remove();
         }
       });
       $('.' + nomor).remove();
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
     String.prototype.toHHMMSS = function() {
       var sec_num = parseInt(this, 10); // don't forget the second param
       var hours = Math.floor(sec_num / 3600);
       var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
       var seconds = sec_num - (hours * 3600) - (minutes * 60);

       if (hours < 10) {
         hours = "0" + hours;
       }
       if (minutes < 10) {
         minutes = "0" + minutes;
       }
       if (seconds < 10) {
         seconds = "0" + seconds;
       }
       return hours + ':' + minutes + ':' + seconds;
     }
     // AKHIR

     function getCurTime() {
       var vid = document.getElementById("rekaman");
       var time = `` + vid.currentTime + ``;
       var time1 = time.toHHMMSS();
       var htl = `<input type="text" class="form-control mb" name="jumlahpiltd" id="jumlahpiltd" value="` + time1 + `">`;
       $('#piltd1').append(htl);
     }

     function radio(id) {
       var radios = document.getElementsByName('ulang' + id);
       for (var i = 0, length = radios.length; i < length; i++) {
         if (radios[i].checked) {
           var x = (radios[i].value);
           if (x == 1) {
             $('#ulangi' + id).empty();
             var ht = `<div class="form-group">
                            <label class="col-sm-5 control-label">Kesalahan Dari : </label>
                            <div class="col-sm-7">
                                <label class="radio-inline">
                                    <input type="radio" name="salah` + id + `" id="salah` + id + `" value=1>Salah Pewitness
                                </label>

                                <label class="radio-inline">
                                    <input type="radio" name="salah` + id + `" id="salah` + id + `" value=2 checked>Bukan Salah Pewitness
                                </label>
                            </div>
                        </div>
                        <br><br>`;
             $('#ulangi' + id).append(ht);
           } else {
             $('#ulangi' + id).empty();
           }
         }
       }
     }

 $(document).ready(function() {
  $('#plat_akunpribadi').change(function(){
    var plat = $(this).val();
    console.log(plat);
    $('#disini_nama').empty();

    var ht = '';
    if (plat == 'Facebook') {
      ht += '<div class="form-group">';
      ht += '<label for="transaksi">Page Name Akun</label>';
      ht += '<input type="text" class="form-control" name="username">';
      ht += '</div>';
    } else {
      ht += '<div class="form-group">';
      ht += '<label for="transaksi">Username Akun</label>';
      ht += '<input type="text" class="form-control" name="username">';
      ht += '</div>';
    }
    $('#disini_nama').append(ht);

  })
 });

 $(document).ready(function() {
  $('#hostname').change(function(){
    var host = $(this).val();
    console.log(host);
    $('#dba').empty();

    var ht = '';
    $.ajax({
           url: "<?php echo base_url('project/getdba') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             host: host
           },
           success: function(hasil) {
             console.log("success");
             console.log(hasil);
             
             var cetak = "<option>Pilih Data</option>";
             for (var i = 0; i < hasil.length; i++) {
               cetak += "<option value='" + hasil[i]['project_num'] + "'>" + hasil[i]['project_name'] + "</option>";
             }
            $("#dba").append(cetak);
            $("#dba").selectpicker('refresh');

           }
         });
   
  })
 });

 $(document).ready(function() {
  $('#plat_akunbank').change(function(){
    var plat = $(this).val();
    console.log(plat);
    $('#disini_namabank').empty();

    var ht = '';
    if (plat == 'Facebook') {
      ht += '<div class="form-group">';
      ht += '<label for="transaksi">Page Name Akun</label>';
      ht += '<input type="text" class="form-control" name="username">';
      ht += '</div>';
    } else {
      ht += '<div class="form-group">';
      ht += '<label for="transaksi">Username Akun</label>';
      ht += '<input type="text" class="form-control" name="username">';
      ht += '</div>';
    }
    $('#disini_namabank').append(ht);

  })
 });

     $(document).ready(function() {
       $('#project2').change(function() {
         var id = $(this).val();
         console.log(id);
         $("#kunjungan").empty();
         $.ajax({
           url: "<?php echo base_url('skenario/getskenariokunjungan') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             pro: id
           },
           success: function(hasil) {
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

     $(document).ready(function() {
       var i = 0;
       var j = 1;
       var k = 1;
       var l = 1;
       var m = 1;
       var n = 1;

       //   $(document).ready(function() {
       //   $('input[type=radio][name="bank"]').change(function(){
       //     var id = $(this).val();
       //     // var cek = document.getElementById('bank');
       //     // console.log(cek)
       //     // alert(id);
       //     $("#channel_ebanking").empty();
       //     $.ajax({
       //       url: "<?php echo base_url('aktual/getchannel') ?>",
       //       type: "POST",
       //       dataType: 'json',
       //       data: {
       //         id: id
       //       },
       //       success: function(hasil) {
       //         console.log(hasil);
       //         // alert(hasil);
       //         // $("#channel_ebanking" ).empty();
       //         var cetak = "";
       //         for (var i = 0; i < hasil.length; i++) {

       //           cetak += `<input type="radio" name="channel_eb" id="channel_eb" value="` + hasil[i]['channel'] + `"> ` + hasil[i]['channel'] + `<br>`;
       //         }
       //         $("#channel_ebanking").append(cetak);
       //         var cek2 = document.getElementById('channel_ebanking');
       //     console.log(cek2)
       //       }
       //     });
       //   });
       // });
       $(document).ready(function() {
         $('#progress_project_sosmed').change(function() {
           var id = $(this).val();
           console.log(id);
           $("#progress_bank").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getbank_sosmed') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: id
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>--Pilih Bank--</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
               }
               $("#progress_bank").append(cetak);
             }
           });
         });
       });

       $(document).ready(function() {
       $('#progress_platform').change(function() {
         var plat = $(this).val();
         var pro = $('#progress_project_sosmed').val();
         var bank = $('#progress_bank').val();


         console.log(plat);
         console.log(bank);
         console.log(pro);



         $('#progress_skenario').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/getsken_sosmed_form') ?>",
           method: "POST",
           data: {
             plat: plat,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';

             text += '<option value="">--Pilih Skenario--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['skenario'] + '">' + coba[i]['nama_skenario'] + '</option>';

             }
             text += '</select>';

             $('#progress_skenario').append(text);
           }
         });

       });
     });


    $(document).ready(function(){
      $('#show_progress_sosmed').click(function() {
         var id_project = $('#progress_project_sosmed').val();
         var bank = $('#progress_bank').val();
         var platform = $('#progress_platform').val();
         var skenario = $('#progress_skenario').val();
         var plotting = $('#filter_plotting').val();

         // var transport_cbg = document.getElementById('transport_cabang');
         // var provinsi_cbg = document.getElementById('provinsi_cabang');
         // var kodepos_cbg = document.getElementById('kodepos_cabang');
         // var fax_cbg = document.getElementById('fax_cabang');
         // var telp_cbg = document.getElementById('telp_cabang');

         console.log(id_project);
         console.log(bank);
         console.log(platform);
         console.log(skenario);



         $.ajax({
           url: "<?php echo base_url('aktual/getprogress_sosmed') ?>",
           method: "POST",
           data: {
             id_project: id_project,
             bank: bank,
             platform: platform,
             skenario: skenario,
             plotting: plotting

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             if (coba.length > 0) {

               //
               $("#tabel_progress").empty();
               var y = 0;
               var cobaah = "";

               // TAMBAHAN SOMA

               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Progress Evaluasi Sosial Media Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Platform</b></td>";
               cobaah += "<td><b>Skenario</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Evaluasi Ke- </b></td>";
               cobaah += "<td><b>Nama Shopper </b></td>";

               cobaah += "<td><b>Tanggal Evaluasi</b></td>";
               cobaah += "<td><b>Jam Mulai</b></td>";

               cobaah += "<td><b>Temuan </b></td>";
               // cobaah += "<td><b>Keterangan Gagal</b></td>"
               cobaah += "<td><b>Time Delivery </b></td>";
               cobaah += "<td><b>Riwayat Penolakan </b></td>";


               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               var aktual = 0;
               var validasi = 0;
               var belum_aktual = 0;
               var ditolak = 0;
               var plot = 0;
               var belum_plot = 0;
               for (var i = 0; i < coba.length; i++) {
                 // var ket_gagal = json_encode(unserialize(coba[i]['penyebab']));
                 // var mystring = "the word you need is 'hello'"
                 // var matches = mystring.match(/\'(.*?)\'/);  //returns array

                 // ​console.log(matches[1]);​
                 // var unser = JSON.parse(coba[i]['penyebab']);
                 // console.log(unser);

                 if (coba[i]['status'] == '2') {
                   aktual++;
                   cobaah += "<tr style='background-color:  #98FB98;'>";
                 } else if (coba[i]['status'] == '3') {
                   validasi++;
                   cobaah += "<tr style='background-color: #9ACD32;'>";
                 } else if (coba[i]['status'] == '1') {
                   cobaah += "<tr style='background-color: #DC143C; color:white;'>";
                   ditolak++;
                 } else if (coba[i]['status'] == '0') {
                   cobaah += "<tr >";
                   belum_aktual++;
                 } else {
                   cobaah += "<tr >";
                 }

                 if (coba[i]['status'] == '0' && coba[i]['tanggal_evaluasi'] !== null) {
                   plot++;
                 }
                 if (coba[i]['status'] == '0' && coba[i]['tanggal_evaluasi'] == null) {
                   belum_plot++;
                 }


                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['nama_project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['platform'] != null) {
                   cobaah += "<td>" + coba[i]['platform'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_skenario'] != null) {
                   cobaah += "<td>" + coba[i]['nama_skenario'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['shopper'] != null) {
                   cobaah += "<td>" + coba[i]['shopper'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['tanggal_evaluasi'] != null) {
                   cobaah += "<td>" + coba[i]['tanggal_evaluasi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['jam_mulai'] != null) {
                   cobaah += "<td>" + coba[i]['jam_mulai'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }

                 
                  if (coba[i]['temuan'] != null) {
                   cobaah += "<td>" + coba[i]['temuan'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['total_td'] != null) {
                  if (coba[i]['total_td'] == 1) { var kata = 'Kurang dari 30 menit'}
                    else if(coba[i]['total_td'] == 2) { var kata = '31 menit - 1 jam'}
                    else if(coba[i]['total_td'] == 3) { var kata = '1 - 24 jam (respons diterima dalam hari yang sama)'}
                    else if(coba[i]['total_td'] == 4) { var kata = 'H+1'}
                    else if(coba[i]['total_td'] == 5) { var kata = 'H+2'}
                    else if(coba[i]['total_td'] == 6) { var kata = 'H+3'}
                    else if(coba[i]['total_td'] == 99) { var kata = 'Belum ada respons sama sekali hingga H+4'}

                   cobaah += "<td>" +kata+ "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['r_temuan'] != null) {
                   cobaah += "<td style='background-color: #DC143C; color:white;'>" + coba[i]['r_temuan'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 // if (coba[i]['upload_bukti'] != null) {
                 //       cobaah += "<td>"+ coba[i]['upload_bukti'] +"</td>";
                 // } else {
                 //       cobaah += "<td></td>"; 
                 // }

                 cobaah += "</tr>";

               }
               // cobaah += "</tr>";

               var persen_aktual = (aktual / coba.length) * 100;
               var persen_validasi = (validasi / coba.length) * 100;
               var persen_ditolak = (ditolak / coba.length) * 100;
               var persen_belum = (belum_aktual / coba.length) * 100;
               var persen_plot = (plot / coba.length) * 100;
               var persen_belum_plot = (belum_plot / coba.length) * 100;

               var total_masuk = aktual + validasi;
               var persen_total_masuk = ((aktual + validasi)/coba.length) * 100;

               cobaah += "</tbody>";
               cobaah += "</table>";
               cobaah += "</div>";
               cobaah += "</div>";
               cobaah += "<table>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b>Total Evaluasi</b></h5></td>";
               cobaah += "<td><h5><b>: " + coba.length + "</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#98FB98;'></span>--Menunggu Validasi</b></h5></td>";
               cobaah += "<td><h5><b>: " + aktual + " (" + persen_aktual.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#9ACD32;'></span>--Sudah Validasi</b></h5></td>";
               cobaah += "<td><h5><b>: " + validasi + " (" + persen_validasi.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#DC143C;'></span>--Ditolak</b></h5></td>";
               cobaah += "<td><h5><b>: " + ditolak + " (" + persen_ditolak.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#1E90FF;'></span>--Total Aktual</b></h5></td>";
               cobaah += "<td><h5><b>: " + total_masuk + " (" + persen_total_masuk.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color: #F0FFF0;'></span>--Belum Aktual</b></h5></td>";
               cobaah += "<td><h5><b>: " + belum_aktual + " (" + persen_belum.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw'></span>--Sudah Plotting</b></h5></td>";
               cobaah += "<td><h5><b>: " + plot + " (" + persen_plot.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw'></span>--Belum Plotting</b></h5></td>";
               cobaah += "<td><h5><b>: " + belum_plot + " (" + persen_belum_plot.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "</table>";




               $("#tabel_progress").append(cobaah);
             } else {
               $("#tabel_progress").empty();
               swal("Data Tidak Tersedia di Skenario!", "Periksa Kembali Filtering Anda!", "error");
             }
             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }
           }

         })
       });

    });



       $(document).ready(function() {
         $('#progress_project').change(function() {
           var id = $(this).val();
           console.log(id);
           $("#progress_bank").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getbank_progress') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: id
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>--Pilih Bank--</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
               }
               $("#progress_bank").append(cetak);
             }
           });
         });
       });

       $(document).ready(function() {
         $('#plotting_project').change(function() {
           var id = $(this).val();
           console.log(id);
           $("#plotting_bank").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getbank_progress') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: id
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>--Pilih Bank--</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
               }
               $("#plotting_bank").append(cetak);
             }
           });
         });
       });

       $(document).ready(function() {
         $('#project_eb').change(function() {
           var id = $(this).val();
           console.log(id);
           $("#bank_eb").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getbank_progress') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: id
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>--Pilih Bank--</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
               }
               $("#bank_eb").append(cetak);
               $("#bank_eb").selectpicker('refresh');
             }
           });
         });
       });

       $(document).ready(function() {
         $('#project_td').change(function() {
           var id = $(this).val();
           console.log(id);
           $("#bank_td").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getbank_progress') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: id
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>--Pilih Bank--</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
               }
               $("#bank_td").append(cetak);
               $('#bank_td').selectpicker('refresh');
             }
           });
         });
       });

       $(document).ready(function() {
         $('#akses_project').change(function() {
          var pro = $(this).val();
          console.log(pro);
          $("#akses_cabang").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getcabang_akses') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: pro
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>Pilih Cabang</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['kode'] + "'> (" + hasil[i]['kode'] +")" + hasil[i]['nama'] + "</option>";
               }
               $("#akses_cabang").append(cetak);
               $('#akses_cabang').selectpicker('refresh');
             }
           });

         })
       })

       $(document).ready(function() {
         $('#viewdata_image').click(function() {
           var project = $('#ebanking_project').val();
           var transaksi = $('#ebanking_trx').val();
           console.log(project);
           console.log(transaksi);

           $("#div_dataimage").empty();
           $.ajax({
             url: "<?php echo base_url('ebanking/getlist_image') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: project,
               transaksi: transaksi
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cobaah = "";
               cobaah += "<div class='form-group'>";
               cobaah += "<div class='text-right' style='margin-bottom: 20px;'><button type='button' class='btn btn-primary' onclick='downloadAll()'><i class='fas fa-download'></i> Download All Image</button></div>";
               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b><center>No</center></b></td>";
               cobaah += "<td><b><center>Nama Project</center></b></td>";
               cobaah += "<td><b><center>Nama Bank</center></b></td>";
               cobaah += "<td><b><center>Channel</center></b></td>";
               cobaah += "<td><b><center>Transaksi</center></b></td>";
               cobaah += "<td><b><center>Tanggal Evaluasi</center></b></td>";

               cobaah += "<td width='20%'><b><center>Bukti Transaksi</center></b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody id='AllImage'>";

               for (var i = 0; i < hasil.length; i++) {
                cobaah += "<input type='text' name='id[]' class='idnya' value='"+hasil[i]['num']+"' style='display: none;'>";

                cobaah += "<tr>";
                cobaah += "<td>"+ (i+1) +"</td>";
                cobaah += "<td>"+ hasil[i]['nama_project'] +"<input type='hidden' class='projectnya' value='"+ hasil[i]['nama_project'] +"'></td>";
                cobaah += "<td>"+ hasil[i]['nama_bank'] +"<input type='hidden' class='banknya' value='"+ hasil[i]['nama_bank'] +"'></td>";
                cobaah += "<td>"+ hasil[i]['channel'] +"<input type='hidden' class='channelnya' value='"+ hasil[i]['channel'] +"'></td>";
                cobaah += "<td>"+ hasil[i]['nama_transaksi'] +"<input type='hidden' class='transaksinya' value='"+ hasil[i]['nama_transaksi'] +"'></td>";
                cobaah += "<td>"+ hasil[i]['tanggal_evaluasi'] +"<input type='hidden' class='tanggalnya' value='"+ hasil[i]['tanggal_evaluasi'] +"'></td>";

                cobaah += "<td><a target='_blank' href='<?= base_url('assets/')?>file/buktitrk/"+ hasil[i]['upload_bukti'] +"'><center><img width='50%' class='gambarnya' src='<?= base_url('assets/')?>file/buktitrk/"+ hasil[i]['upload_bukti'] +"'></center></a></td>";
          
                cobaah += "</tr>";
               }
               cobaah += "</tbody>";
               cobaah += "</table>";
               cobaah += "</div>";
               // cobaah += "<input type='submit' class='btn btn-primary' value='Simpan'";
               cobaah += "</div>";
               
              $("#div_dataimage").append(cobaah);

              if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true,
                 "lengthMenu": [
                   [10, 50, 100, -1],
                   [10, 50, 100, "All"]
                 ]
               });
             }
             
             }
           });
         });
       });


        $(document).ready(function() {
         $('#konsistensi_project').change(function() {
           var id = $(this).val();
           console.log(id);
           $("#konsistensi_variable").empty();
           $.ajax({
             url: "<?php echo base_url('validasi/getvariable_konsistensi') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: id
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>Pilih Variable</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['variable'] + "'>" + hasil[i]['variable'] + "</option>";
               }
              $("#konsistensi_variable").append(cetak);
              $('#konsistensi_variable').selectpicker('refresh');

             }
           });
         });
       });


      $(document).ready(function() {
         $('#viewdata_konsistensi').click(function() {
           var project = $('#konsistensi_project').val();
           var variable = $('#konsistensi_variable').val();
           var status = $('#konsistensi_status').val();

           console.log(project);
           console.log(variable);
           console.log(status);

         // document.getElementById('tampilan_div').style.display = 'none';

           $("#div_datakonsistensi").empty();
           $.ajax({
             url: "<?php echo base_url('validasi/getcek_konsistensi') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: project,
               variable: variable,
               status: status
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cobaah = "";
               cobaah += "<div class='form-group'>";
               cobaah += "<div class='text-right fixme' style='padding-top: 20px; padding-bottom: 20px; padding-right: 20px; background-color: #e3f3fc; z-index:100; position: -webkit-sticky; position: sticky; top: 50px;'><input type='submit' class='btn btn-primary' value='Simpan'></div>";
               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead >";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Serial</b></td>";
               cobaah += "<td><b>Code Kunjungan</b></td>";
               cobaah += "<td><b>Cabang</b></td>";
               cobaah += "<td><b>Nama Cabang</b></td>";
               cobaah += "<td><b>Variable</b></td>";
               cobaah += "<td><b>Kode</b></td>";
               cobaah += "<td><b>Check</b></td>";

               cobaah += "<td><b>Verifikasi</b></td>";
               cobaah += "<td><b>Final Code</b></td>";
               cobaah += "<td><b>Status</b></td>";


               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               for (var i = 0; i < hasil.length; i++) {
                
                if (hasil[i]['verifikasi'] == null) { var verifikasi='';} else { var verifikasi=hasil[i]['verifikasi'];}
                if (hasil[i]['final_code'] == null) { var final='';} else { var final=hasil[i]['final_code'];}

                if (verifikasi == '' && final == '') { var status='Belum Cek Validasi';} else {var status = 'Sudah Cek Validasi';}

                cobaah += "<input type='text' name='id[]' value='"+hasil[i]['id']+"' style='display: none;'>";

                cobaah += "<tr>";
                cobaah += "<td>"+ (i+1) +"</td>";
                cobaah += "<td>"+ hasil[i]['project_name'] +"</td>";
                cobaah += "<td>"+ hasil[i]['serial'] +"</td>";
                cobaah += "<td>"+ hasil[i]['code'] +"</td>";
                cobaah += "<td>"+ hasil[i]['cabang'] +"</td>";
                cobaah += "<td>"+ hasil[i]['z3'] +"</td>";
                cobaah += "<td>"+ hasil[i]['variable'] +"</td>";
                cobaah += "<td>"+ hasil[i]['kode'] +"</td>";
                cobaah += "<td>"+ hasil[i]['check'] +"</td>";
                cobaah += "<td><input type='text' class='form-control' name='verifikasi"+hasil[i]['id']+"' value='"+verifikasi+"'></td>";
                cobaah += "<td><input type='text' class='form-control' name='finalcode"+hasil[i]['id']+"' value='"+final+"'></td>";
                cobaah += "<td>"+status+"</td>"
                cobaah += "</tr>";
               }
               cobaah += "</tbody>";
               cobaah += "</table>";
               cobaah += "</div>";
               
               cobaah += "</div>";
               
              $("#div_datakonsistensi").append(cobaah);

              if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": false
               });
             }
             
             }
           });
         });
       });

       $(document).ready(function() {
         $('#validasi_project').change(function() {
           var id = $(this).val();
           console.log(id);
           $("#validasi_bank").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getbank_progress') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: id
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>--Pilih Bank--</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
               }
               $("#validasi_bank").append(cetak);
             }
           });
         });
       });

       $(document).ready(function() {
         $('#validasi2_project').change(function() {
           var id = $(this).val();
           console.log(id);
           $("#validasi2_bank").empty();
           $.ajax({
             url: "<?php echo base_url('aktual/getbank_sosmed') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: id
             },
             success: function(hasil) {
               console.log(hasil);
               // $("#kunjungan").empty();
               var cetak = "<option value=''>--Pilih Bank--</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
               }
               $("#validasi2_bank").append(cetak);
             }
           });
         });
       });

        $(document).ready(function() {
         $('input[type=radio][id="for_sosmed"]').change(function() {
           var platform = $('input[type=radio][name="val_platform"]:checked').val();
           var tujuan = $('input[type=radio][name="val_tujuan"]:checked').val();
           var skenario = $('input[type=radio][name="val_skenario"]:checked').val();
           var tanggal = $('input[type=radio][name="val_tanggal"]:checked').val();
           var hari = $('input[type=radio][name="val_hari"]:checked').val();
           var jam = $('input[type=radio][name="val_jam"]:checked').val();
           var greetawal = $('input[type=radio][name="val_greetawal"]:checked').val();
           var greetakhir = $('input[type=radio][name="val_greetakhir"]:checked').val();
           var greetakhir_after = $('input[type=radio][name="val_greetakhir_after"]:checked').val();

           var responagent = $('input[type=radio][name="val_responagent"]:checked').val();
           var waktukirim = $('input[type=radio][name="val_waktukirim"]:checked').val();
           var waktubalas = $('input[type=radio][name="val_waktubalas"]:checked').val();
           var responotomatis = $('input[type=radio][name="val_responotomatis"]:checked').val();



           console.log(platform);
           console.log(tujuan);
           console.log(skenario);
           console.log(tanggal);
           console.log(hari);
           console.log(jam);
           console.log(greetawal);
           console.log(greetakhir);
           console.log(greetakhir_after);

           console.log(responagent);
           console.log(waktukirim);
           console.log(waktubalas);
           console.log(responotomatis);


           if (platform == '1' && tujuan == '1' && skenario == '1' && tanggal == '1' && hari == '1' && jam == '1' && greetawal == '1' && greetakhir == '1' && greetakhir_after == '1' && responagent == '1' && waktukirim == '1' && waktubalas == '1' && (responotomatis == '1' || responotomatis == '3')) {
             console.log("Bisa valid");
             console.log($('#btn_valideb'));

             $('#btn_valideb1').removeAttr('disabled');
             $('#btn_valideb2').removeAttr('disabled');

           } else {
             $('#btn_valideb1').prop('disabled', true);
             $('#btn_valideb2').prop('disabled', true);
           }

           document.getElementById('in_platform').value = platform;
           document.getElementById('in_tujuan').value = tujuan;
           document.getElementById('in_skenario').value = skenario;
           document.getElementById('in_tanggal').value = tanggal;
           document.getElementById('in_hari').value = hari;
           document.getElementById('in_jam').value = jam;
           document.getElementById('in_greetawal').value = greetawal;
           document.getElementById('in_greetakhir').value = greetakhir;
           document.getElementById('in_greetakhir_after').value = greetakhir_after;

           document.getElementById('in_responagent').value = responagent;
           document.getElementById('in_waktukirim').value = waktukirim;
           document.getElementById('in_waktubalas').value = waktubalas;
           document.getElementById('in_responotomatis').value = responotomatis;


         });
       });



       $(document).ready(function() {
         $('input[type=radio][id="for_eb"]').change(function() {
           var bank = $('input[type=radio][name="val_bank"]:checked').val();
           var tanggal = $('input[type=radio][name="val_tanggal"]:checked').val();
           var hari = $('input[type=radio][name="val_hari"]:checked').val();
           var transaksi = $('input[type=radio][name="val_transaksi"]:checked').val();
           var jam = $('input[type=radio][name="val_jam"]:checked').val();
           var tujuan = $('input[type=radio][name="val_tujuan"]:checked').val();


           console.log(bank);
           console.log(tujuan);

           console.log(tanggal);
           console.log(hari);
           console.log(transaksi);
           console.log(jam);

           if (bank == '1' && (tanggal == '1' || tanggal == '3') && hari == '1' && transaksi == '1' && jam == '1' && (tujuan == '1' || tujuan == '3')) {
             console.log("Bisa valid");
             console.log($('#btn_valideb'));

             $('#btn_valideb1').removeAttr('disabled');
             $('#btn_valideb2').removeAttr('disabled');

           } else {
             $('#btn_valideb1').prop('disabled', true);
             $('#btn_valideb2').prop('disabled', true);
           }

           document.getElementById('in_bank').value = bank;
           document.getElementById('in_tanggal').value = tanggal;
           document.getElementById('in_hari').value = hari;
           document.getElementById('in_transaksi').value = transaksi;
           document.getElementById('in_jam').value = jam;
           document.getElementById('in_tujuan').value = tujuan;



         });
       });

      


       $(document).ready(function() {
         $('#project_act_eb').change(function() {
           var pro = $(this).val();

           if (pro != '') {
             console.log("Bisa valid");
             // console.log($('#btn_valideb'));

             $('#go_eb').removeAttr('disabled');

           } else {
             $('#go_eb').prop('disabled', true);

           }



         });
       });


       $(document).ready(function() {
         $('#btn_channel').click(function() {
           var channel = $('input[type=radio][name="channel_eb"]:checked').val();

           var project = $('#kd_project').val();
           var bank = $('#bank').val();

           console.log(channel);
           console.log(project);
           console.log(bank);
           // var cek = document.getElementById('bank');
           // console.log(cek)
           // alert(bank);
           $("#os_ebanking").empty();
           $("#provider_ebanking").empty();
           $("#jenis_ev").empty();
           // $("#transaksi_ebanking").empty();

           // var dev1 = '';
           var dev2 = '';
           // var dev3 = '';

           var prov1 = '';
           var prov2 = '';

           // dev1 += `<input type="radio" name="os_eb" id="os_eb" value="Android_Mobile Banking Android 1"> Mobile Banking Android Ke-1<br>`;
           // dev1 += `<input type="radio" name="os_eb" id="os_eb" value="Android_Mobile Banking Android 2"> Mobile Banking Android Ke-2<br>`;
           // dev1 += `<input type="radio" name="os_eb" id="os_eb" value="IOS_Mobile Banking IOS 1"> Mobile Banking IOS Ke-1<br>`;
           // dev1 += `<input type="radio" name="os_eb" id="os_eb" value="IOS_Mobile Banking IOS 2"> Mobile Banking IOS Ke-2<br>`;

           dev2 += `<input type="radio" name="os_eb" id="os_eb" value="SMS Banking Ketik"> SMS Banking Ketik<br>`;
           dev2 += `<input type="radio" name="os_eb" id="os_eb" value="SMS Banking Java"> SMS Banking Java<br>`;
           dev2 += `<input type="radio" name="os_eb" id="os_eb" value="SMS Banking USSD"> SMS Banking USSD<br>`;

           // dev3 += `<input type="radio" name="os_eb" id="os_eb" value="Internet Banking 1"> Internet Banking 1<br>`;
           // dev3 += `<input type="radio" name="os_eb" id="os_eb" value="Internet Banking 2"> Internet Banking 2<br>`;
           // dev3 += `<input type="radio" name="os_eb" id="os_eb" value="Wired_Internet Banking 1"> Internet Banking 1 Wired<br>`;
           // dev3 += `<input type="radio" name="os_eb" id="os_eb" value="Wired_Internet Banking 2"> Internet Banking 2 Wired<br>`;



           prov1 += `<input type="radio" name="provider_eb" id="provider_eb" value="Indosat"> Indosat<br>`;
           prov1 += `<input type="radio" name="provider_eb" id="provider_eb" value="Telkomsel"> Telkomsel<br>`;
           prov1 += `<input type="radio" name="provider_eb" id="provider_eb" value="XL"> XL<br>`;

           prov2 += `<input type="radio" name="provider_eb" id="provider_eb" value="Indosat"> Indosat (Wireless)<br>`;
           prov2 += `<input type="radio" name="provider_eb" id="provider_eb" value="Telkomsel"> Telkomsel (Wireless)<br>`;
           prov2 += `<input type="radio" name="provider_eb" id="provider_eb" value="XL"> XL (Wireless)<br>`;
           prov2 += `<input type="radio" name="provider_eb" id="provider_eb" value="Smartfren"> Smartfren (Wireless)<br>`;
           prov2 += `<input type="radio" name="provider_eb" id="provider_eb" value="Indihome"> Indihome (Wired)<br>`;
           prov2 += `<input type="radio" name="provider_eb" id="provider_eb" value="Firstmedia"> Firstmedia (Wired)<br>`;

           $("#jenis_ev").append(channel);

           if (channel == 'Mobile Banking') {
             // $("#os_ebanking").append(dev1);
             $("#provider_ebanking").append(prov1);

           } else if (channel == 'SMS Banking') {
             // $("#os_ebanking").append(dev2);
             $("#provider_ebanking").append(prov1);
           } else if (channel == 'Internet Banking') {
             // $("#os_ebanking").append(dev3);
             $("#provider_ebanking").append(prov2);
           }
           $.ajax({
             url: "<?php echo base_url('aktual/getaplikasi_aktual') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               chan: channel,
               bank: bank,
               pro: project


             },
             success: function(hasil) {
               console.log(hasil);
               // alert(hasil);
               // $("#channel_ebanking" ).empty();
               var cetak = "";
               var cetak2 = "";
               if (channel == 'SMS Banking') {
                 for (var i = 0; i < hasil.length; i++) {

                   cetak2 += `<input type="radio" name="os_eb" id="os_eb" value="` + hasil[i]['os'] + `"> ` + hasil[i]['os'] + `<br>`;
                 }
               } else {
                 for (var i = 0; i < hasil.length; i++) {

                   cetak += `<input type="radio" name="os_eb" id="os_eb" value="` + hasil[i]['os'] + "_" + hasil[i]['nama'] + `"> ` + hasil[i]['nama'] + " " + hasil[i]['os'] + `<br>`;
                 }
               }
               if (channel == 'SMS Banking') {
                 $("#os_ebanking").append(cetak2);
               } else {
                 $("#os_ebanking").append(cetak);
               }
               //     var cek2 = document.getElementById('channel_ebanking');
               // console.log(cek2)
             }
           });
         });
       });


       $(document).ready(function() {
         $('input[type=time][name="jam_selesai"]').change(function() {
           var jam_selesai = $(this).val();
           var jam_mulai = $('input[type=time][name="jam_mulai"]').val();


           // var cek = document.getElementById('bank');
           // console.log(cek)
           // alert(jam_selesai);
           // $("#os_ebanking").empty();
           //  $("#provider_ebanking").empty();
           $("#warning_jam").empty();

           $.ajax({
             url: "<?php echo base_url('aktual/getwaktu') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               jam_mulai: jam_mulai,
               jam_selesai: jam_selesai,


             },
             success: function(hasil) {
               console.log(hasil);
               // alert(hasil.length);
               // alert(hasil);
               // $("#channel_ebanking" ).empty();
               var text = '';
               if (hasil.length > 0) {
                 // alert(hasil[0]['ket']);
                 text += `<b class="text-success">Waktu Evaluasi : ` + hasil[0]['ket'] + `</b>`;
                 $('#btn_jam').removeAttr('disabled');
               } else {
                 // alert("Waktu Tidak Termasuk di Jadwal");
                 text += `<b class="text-danger">Maaf Waktu Tidak Termasuk Di Dalam Jadwal!</b>`;
                 $('#btn_jam').attr('disabled', 'disabled');
               }
               $("#warning_jam").append(text);

             }
           });
         });
       });


       $(document).ready(function() {
         $('input[type=date][name="tanggal"]').change(function() {

           var tanggal = $(this).val();
           var cek = new Date(tanggal);

           // alert(cek.getDay());
           $("#warning_hari").empty();

           var hari = '';
           if (cek.getDay() == 6 || cek.getDay() == 0) {
             hari += `<b class="text-success">Tanggal Evaluasi Termasuk : Weekend</b>`;
           } else {
             // alert("Waktu Tidak Termasuk di Jadwal");
             hari += `<b class="text-success">Tanggal Evaluasi Termasuk : Weekday</b>`;

           }
           $("#warning_hari").append(hari);


         });
       });

       $(document).ready(function() {
         $('input[type=date][name="tanggal_field"]').change(function() {

           var tanggal = $(this).val();
           var cek = new Date(tanggal);

           // alert(cek.getDay());
           $("#ket_hari").empty();

           var hari = '';
           if (cek.getDay() == 6 || cek.getDay() == 0) {
             hari += `<b>Hari termasuk Weekend.</b>`;
             $('#hari_field').val('Weekend');
           } else {
             // alert("Waktu Tidak Termasuk di Jadwal");
             hari += `<b>Hari termasuk Weekday.</b>`;
             $('#hari_field').val('Weekday');

           }
           $("#ket_hari").append(hari);


         });

         $('input[type=time][name="jam_field"]').change(function() {
           var jam_mulai = $(this).val();
           var jam_selesai = '';


           $("#ket_waktu").empty();

           $.ajax({
             url: "<?php echo base_url('aktual/getwaktu') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               jam_mulai: jam_mulai,
               jam_selesai: jam_selesai


             },
             success: function(hasil) {
               console.log(hasil);
               var text = '';
               if (hasil.length > 0) {
                 // alert(hasil[0]['ket']);
                 text += `<b>Waktu termasuk ` + hasil[0]['ket'] + `</b>`;
                 $('#waktu_field').val(hasil[0]['ket']);
                 // $('#btn_jam').removeAttr('disabled');
               } else {
                 // alert("Waktu Tidak Termasuk di Jadwal");
                 text += `<b>Maaf Waktu Tidak Termasuk Di Dalam Jadwal!</b>`;
                 $('#waktu_field').val('');
                 // $('#btn_jam').attr('disabled', 'disabled');
               }
               $("#ket_waktu").append(text);

             }
           });
         });

       });



       $(document).ready(function() {
         $("#percobaan_ke").on("keyup change", function(e) {
           var percobaan = $(this).val();

           // alert(percobaan);
           $('#inline_ket').empty();
           var text = '';
           if (percobaan > 1) {
             for (i = 1; i < percobaan; i++) {
               text += `<label>Keterangan Gagal Percobaan Ke-` + i + `</label>&nbsp;
                                <input type="text" class="form-control" name="ket_percobaan[]"><br>`;
             }
             $('#inline_ket').append(text);
           }

         });
       });



       // =========================================Javascript Kuis Shopper======================================

       $("#buat").click(function() {
         $("#idsoal").remove();
         $(".jumlah").remove();
         i = i + 1;
         var ht = `<div class="row mt soal">
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Soal ` + i + ` </strong></h4>
                <div class="form-horizontal style-form">

                <div class="form-group">
                  <label class="col-sm-3 control-label">Pertanyaan</label>
                  <div class="col-sm-9">
                     <textarea class="form-control" name="pertanyaan` + i + `" id="pertanyaan` + i + `" placeholder="Pertanyaan.." rows="1" required></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Benar</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="jb` + i + `" id="jb` + i + `" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 1</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js1` + i + `" id="js1` + i + `" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 2</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js2` + i + `" id="js2` + i + `" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Jawaban Salah 3</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="js3` + i + `" id="js3` + i + `" required>
                  </div>
                </div>

            </div>
            </div>
           </div>
           </div>`;
         $("#soalsoal").append(ht);
         var y = $('.soal').length;
         console.log(y);
         var id = `<input type="hidden" id="idsoal" name="idsoal" value="` + y + `">`;
         $("#soalsoal").append(id);
         var j = `<label class="col-lg-2 control-label jumlah">Jumlah Soal : ` + y + `</label>`;
         $("#jumlah").append(j);
       });

       $('#projectkuis').change(function() {
         $('#kunjungan').empty();
         var pro = $('#projectkuis').val();
         console.log(pro);
         $.ajax({
           url: "<?= base_url('equest/getprojectskenario') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             pro: pro
           },
           success: function(hasil) {
             console.log("success");
             console.log(hasil);
             var ht = `<option value="">Pilih Kunjungan</option>`
             for (it = 0; it < hasil.length; it++) {
               ht += `
                   <option value="` + hasil[it].kode + `">` + hasil[it].nama + `</option>`
             }
             $('#kunjungan').append(ht);
           }
         });
       });

       $('#projectbrief').change(function() {
         $('#jenis').empty();
         var pro = $('#projectbrief').val();
         console.log(pro);
         $.ajax({
           url: "<?= base_url('equest/getprojectshpkunjungan') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             pro: pro
           },
           success: function(hasil) {
             console.log("success");
             console.log(hasil);
             var ht = `<option value="">Pilih Kunjungan</option>`
             for (i = 0; i < hasil.length; i++) {
               ht += `
                   <option value="` + hasil[i].kunjungan + `">` + hasil[i].skenario + `</option>`
             }
             $('#jenis').append(ht);
           }
         });
       });

       $('#play').click(function() {
         $('#soalsoal').empty();
         $('#file_skenario').empty();

         var jenis = $('#jenis').val();
         var proj = $('#projectbrief').val();
         $.ajax({
           url: "<?= base_url('equest/skenario') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             jenis: jenis,
             proj: proj
           },
           success: function(hasil) {
             for (i = 0; i < hasil.length; i++) {
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
                               <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman Brief Skenario ` + hasil[i].nama_skenario + `</strong></h4>
                                <div class="container">
                                    <div class="progress" id="progress"></div>
                                    <audio autoplay id="audio" src="../assets/file/skenario/` + hasil[i].file_skenario + `"></audio>

                                    <button type="button" class="togglePlay" onClick="togglePlay()" ><span style="font-size: 3em;"><i class="far fa-play-circle" id="togglePlay"></i></span></button>
                                </div>
                           </div>
                         </div>
                         </div>`;


               var fs = `<div class="row mt">
                         <div class="col-lg-12">
                           <div class="form-panel">
                               <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> File Skenario ` + hasil[i].nama_skenario + `</strong></h4>
                                <div class="container">
                                    <div class="progress" id="progress"></div>
                                    <div style="height:700px;"><embed src="../assets/file/skenario/` + hasil[i].file_kuis + `#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="100%"></div>


                                </div>
                           </div>
                         </div>
                         </div>`;

               $('#soalsoal').append(ht);
               $('#file_skenario').append(fs);

             }
           }
         });
       });

       // $(document).ready(function(){
       //       $('input[type="file"]').change(function(e){
       //           var fileName = e.target.files[0].name;
       //           var res = fileName.slice(-3);
       //           if (res !== 'MP4' ) {
       //             window.reset = function (e) {
       //                 e.wrap('<form>').closest('form').get(0).reset();
       //                 e.unwrap();
       //             }
       //           }else{
       //             alert('Anda tidak bisa input dengan format'+res);
       //           }
       //       });
       //   });


       $('#mulaikuis').click(function() {
         var x = document.getElementById("audio").duration;
         var y = document.getElementById("audio").currentTime;

         var z = x - y;

         if (z >= 5) {
           Swal({
             position: 'center',
             title: 'Anda Belum Menyelesaikan Rekaman Briefing',
             showConfirmButton: true,
           });
         } else {
           var project = $('#projectbrief').val();
           var sek = $('#jenis').val();

           var base = window.location.origin + "/";
           var host = base + window.location.pathname.split('/')[1];
           // window.location.href = `https://180.211.92.132/kerjabakti/equest/kuisjs/`+sek+`/`+project+``;
           window.location.href = `` + host + `/equest/kuisjs/` + sek + `/` + project + ``;
         }

       });

       $('#project').change(function() {
         $('#kunjungan').empty();
         var ht1 = $('#project').val();
         $.ajax({
           url: "<?= base_url('skenario/projectkunjungan') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             jenis: ht1
           },
           success: function(hasil) {
             for (i = 0; i < hasil.length; i++) {
               var ht = `
                  <option value="` + hasil[i].kunjungan + `">` + hasil[i].nama + `</option>`;
               $('#shpkunjungan').append(ht);
             }
           }
         });
       });

       $('#shpkunjungan').change(function() {
         $('#shpskenario').empty();
         var ht1 = $('#project').val();
         $.ajax({
           url: "<?= base_url('skenario/projectkunjungan') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             jenis: ht1
           },
           success: function(hasil) {
             for (i = 0; i < hasil.length; i++) {
               var ht = `
                   <div class="col-sm-2">
                        <label class="checkbox-inline">
                            <input type="checkbox" id="check[]" name="check[]" value="` + hasil[i].kunjungan + `">` + hasil[i].kunjungan + `
                        </label>
                  </div>`;

               $('#kunjungan').append(ht);
             }
           }
         });
       });


       $('#project').change(function() {
         $('#pilihcabang').empty();
         var cbg = $('#project').val();
         $.ajax({
           url: "<?= base_url('skenario/projectcabang') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             cbg: cbg
           },
           success: function(cbng) {
             var cetak = `<option value="">Pilih Cabang</option>`
             for (i = 0; i < cbng.length; i++) {
               cetak += `<option value="` + cbng[i].kode + `">` + cbng[i].nama + `</option>`;
               console.log(cbng[i].kode)
             }
             $('#pilihcabang').append(cetak);
           }
         });
       });

       $('#modalassignshp').on('show.bs.modal', function(event) {
         var kunj = $(event.relatedTarget).attr('data-kunj');
         var cbg = $(event.relatedTarget).attr('data-kcab');
         var pro = $(event.relatedTarget).attr('data-kpro');
         // var kunj = $(this).attr('data-kunj');
         console.log(kunj);
         console.log(cbg);
         console.log(pro);
         $('#appendsken').empty();
         $('#maxtgl').empty();
         $.ajax({
           url: "<?= base_url('skenario/getskennotinquest') ?>",
           type: "POST",
           dataType: "json",
           data: {
             kunj: kunj,
             cbg: cbg,
             pro: pro
           },
           success: function(result) {
             console.log(result);
             for (let index = 0; index < result.length; index++) {
               var ht = `<label class="checkbox-inline"><input type="checkbox" id="check[]" name="check[]" value="` + result[index].ksken + `">` + result[index].sken + `</label>`
               $('#appendsken').append(ht);
             }
             var array = result[0].planend.split("-");
             // var ajg = `<input type="date" class="form-control" name="datekunj" max="`+result[0].planend+`" min="<?php //echo date('Y-m-d');
                                                                                                                    ?>">`
             // var ajg = `<input type="date" class="form-control" name="datekunj" max="`+array[0]+`-`+array[2]+`-`+array[1]+`" min="<?php echo date('Y-m-d'); ?>">`
             var ajg = `<input type="date" class="form-control" name="datekunj" max="` + result[0].planend + `" min="<?php echo date('Y-m-d'); ?>">`
             $('#maxtgl').append(ajg);
           }
         });
       });


       // Time Delivery AUVIQ
       $(document).ready(function() {

         $('#loadingDiv2').hide().ajaxStart(function() {
           $(this).show(); // show Loading Div
         }).ajaxStop(function() {
           $(this).hide(); // hide loading div
         });

       });

       $(document).ready(function() {

         $('#loadingDiv').hide().ajaxStart(function() {
           $(this).show(); // show Loading Div
         }).ajaxStop(function() {
           $(this).hide(); // hide loading div
         });

         $("#kapan_isi_form").change(function() {
           var id = $(this).children("option:selected").val();
           if (id == 'Saat di CS' || id == 'Saat di Mesin') {
             // alert("You have selected the country - " + id);
             $("#selesai_isi_form").empty();
             var cetak = `<option value="">Pilih ...</option>`;
             cetak += `<option>Tidak isi form saat antri</option>`;
             $("#selesai_isi_form").append(cetak);
           } else {
             // alert("You have selected the country - " + id);
             $("#selesai_isi_form").empty();
             var cetak = `<option value="">Pilih ...</option>`;
             cetak += `<option>Tidak tuntas lanjut di CS</option>`;
             cetak += `<option>Tuntas isi form saat antri</option>`;
             $("#selesai_isi_form").append(cetak);
           }
         });
       });

       $('#project_td').change(function() {
         $('#cabangxx').empty();
         var cbg = $('#project_td').val();
         var sken = $('#formxx').val();
         $('#loadingDiv').show();
         console.log(cbg);
         console.log(sken);
         $.ajax({
           url: "<?= base_url('time/getdaftarcabang') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             id: cbg,
             ske: sken
           },
           success: function(cbng) {
             $('#loadingDiv').hide();
             var cetak = `<select name="cabang" id="cabang" class="form-control">
                  <option value=""> Pilih... Sisa cabang : ` + cbng.length + ` </option>`;
             console.log("MASUK WAY");
             for (var i = 0; i < cbng.length; i++) {
               cetak += `<option value="` + cbng[i].kode + `">` + cbng[i].kode + ` - ` + cbng[i].nama + `</option>`;
               console.log(cbng[i].nama);
             }
             cetak += `</select>`;
             $('#cabangxx').append(cetak);
           }
         });
       });

       $('#projectid').change(function() {
         var kode = $('#projectid').val();

         $.ajax({
           url: "<?php echo base_url('time/getdata_sken') ?>",
           method: "POST",
           data: {
             kode: kode

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             //
             $("#project_skn").empty();
             var y = 0;
             var cobaah = "";
             // TAMBAHAN SOMA
             cobaah += "<select class='form-control' name='project' id='project' >";
             cobaah += " <option value=''> Pilih Skenario </option>";
             for (var i = 0; i < coba.length; i++) {
               cobaah += "<option value='" + coba[i]['att'] + "'> " + coba[i]['nama_sken'] + " </option>";
             }
             cobaah += "</select>";
             $("#project_skn").append(cobaah);
           }

         })
       });


       $('#project_tdview').change(function() {
         $('#dataTables_td').empty();
         $('#dataTables_reporttd').empty();
         $('#tabletdsummary').empty();
         $('#progresstd').empty();
         var cbg = $('#project_tdview').val();
         console.log(cbg);

         $.ajax({
           url: "<?= base_url('time/getdatatd_sort_sk') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             id: cbg
           },
           success: function(cbng) {
             $('#skenario_tdview').empty();
             $('#skenario_td_report').empty();
             console.log("masuk");
             var cetak = `<option class="selected" value="0">Pilih Skenario</option>`
             for (var i = 0; i < cbng.length; i++) {
               cetak += `<option value="` + cbng[i].sk + `">` + cbng[i].name + `</option>`;
               console.log(cbng[i].name);
             }
             cetak += `</select>`;
             $('#skenario_tdview').append(cetak);
             $('#skenario_td_report').append(cetak);
           }
         });
       });

       $('#skenario_tdview').change(function() {
         $('#dataTables_td').empty();
         var projtd = $('#project_tdview').val(),
           ske = $('#skenario_tdview').val();
         console.log(projtd + `---` + ske);
             $('#butt_div').empty();

         $.ajax({
           url: "<?= base_url('time/getdatatd_sort_piltd') ?>",
           type: "POST",
           async: true,
           dataType: 'json',
           data: {
             id: projtd,
             ske: ske
           },
           success: function(test) {
            console.log(test);
            var butt = ``;

             var cetak = `<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                   <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Proses<center></th>
                    </tr>
                    </thead>`
             for (var i = 0; i < test['piltd'].length; i++) {
               var j = i + 1;
               cetak += `<tr>
                       <td><center>` + j + `<center></td>
                       <td>` + test['piltd'][i].pilihan_td + `</td>
                      </tr>`
             }
             cetak += `</table>`

             if (test['cek'] == null) {
                butt += `<a href='<?php echo base_url('time/edittd_list/') ?>` + projtd + `/`+ ske +`' class="btn btn-primary" target="_blank">Edit List TD</a>`
             
             $('#butt_div').append(butt);
             
             }

             $('#dataTables_td').append(cetak);

             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": false,
                 "scrollY": "300px",
                 "scrollCollapse": true,
                 "paging": false
               });
             }
           }
         });
       });

       $('#hidesumreport').click(function() {
         $('#tabletdsummary').empty();
       });


       $('#sumreport').click(function() {
         var projtd = $('#project_tdview').val(),
           ske = $('#skenario_td_report').val();
         console.log(projtd + `---` + ske);
         $('#tabletdsummary').empty();

         if (projtd !== '' && ske !== '') {


           $.ajax({
             dataType: "json",
             url: "<?= base_url('time/getdatatd_report_sum') ?>",
             type: "POST",
             async: true,
             dataType: 'json',
             data: {
               id: projtd,
               ske: ske
             },
             success: function(result) {
               var sh = `<thead>
                <tr>
                      <th bgcolor="#00FF00"><center>Jenis Form<center></th>
                      <th bgcolor="#00FF00"><center>Kondisi Pengisian<center></th>
                      <th bgcolor="#00FF00"><center>Rata-rata TD<center></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                      <td>Paper</td>
                      <td>Tuntas isi form saat antri</td>`
               if (result[0].rtd == null) {
                 sh += `<td><center> - <center></td>`
               } else {
                 sh += `<td><center>` + result[0].rtd + `<center></td>`
               }
               sh += `</tr>
                <tr>
                      <td>Paper</td>
                      <td>Tidak tuntas lanjut di CS</td>`
               if (result[1].rtd == null) {
                 sh += `<td><center> - <center></td>`
               } else {
                 sh += `<td><center>` + result[1].rtd + `<center></td>`
               }
               sh += `</tr>
                <tr>
                      <td>Paper</td>
                      <td>Tidak isi form saat antri</td>`
               if (result[2].rtd == null) {
                 sh += `<td><center> - <center></td>`
               } else {
                 sh += `<td><center>` + result[2].rtd + `<center></td>`
               }
               sh += `</tr>
                <tr>
                      <td>Eform</td>
                      <td>Tuntas isi form saat antri</td>`
               if (result[3].rtd == null) {
                 sh += `<td><center> - <center></td>`
               } else {
                 sh += `<td><center>` + result[3].rtd + `<center></td>`
               }
               sh += `</tr>
                <tr>
                      <td>Eform</td>
                      <td>Tidak tuntas lanjut di CS</td>`
               if (result[4].rtd == null) {
                 sh += `<td><center> - <center></td>`
               } else {
                 sh += `<td><center>` + result[4].rtd + `<center></td>`
               }
               sh += `</tr>
                <tr>
                      <td>Eform</td>
                      <td>Tidak isi form saat antri</td>`
               if (result[5].rtd == null) {
                 sh += `<td><center> - <center></td>`
               } else {
                 sh += `<td><center>` + result[5].rtd + `<center></td>`
               }
               sh += `</tr>
                <tr>
                <td></td>
                <td align="right" bgcolor="#00FF00"><strong>Rata-rata Semua Cabang<strong></td>`
               if (result[6].rtd == null) {
                 sh += `<td><center> - <center></td>`
               } else {
                 sh += `<td bgcolor="#00FF00"><center><strong>` + result[6].rtd + `<center><strong></td>`
               }
               sh += `</tr>
                </tbody>`

               $('#tabletdsummary').append(sh);
             }

           });

         } else {
           alert('Project dan Skenario tidak boleh kosong !');
         }

       });

       $('#skenario_td_report').change(function() {
         $('#dataTables_reporttd').empty();
         var projtd = $('#project_tdview').val(),
           ske = $('#skenario_td_report').val();
         $('#progresstd').empty();
         $('#tabletdsummary').empty();
         console.log(projtd + `---` + ske);
         $('#loadingDiv').show();

         var ajax1 = $.ajax({
           dataType: "json",
           url: "<?= base_url('time/getdatatd_sort_piltd') ?>",
           type: "POST",
           async: true,
           dataType: 'json',
           data: {
             id: projtd,
             ske: ske
           },
           success: function(result1) {
             console.log("success 1");
             console.log(result1.length);
             console.log(result1);
             var ht = `<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                   <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Nama Cabang<center></th>
                      <th><center>Kapan Isi Form<center></th>
                      <th><center>Jenis Form<center></th>
                      <th><center>Kondisi Pengisian Form<center></th>
                      <th><center>Temuan<center></th>
                      <th><center>TD Full<center></th>`
             for (var z = 0; z < result1.length; z++) {
               ht += `<th><center>` + result1[z].pilihan_td + `<center></th>`
               ht += `<th><center>Keterangan<center></th>`
             }
             ht += `</thead>
                            </table>`
             $('#dataTables_reporttd').append(ht);
           }
         });

         $('#kode_pjk').change(function() {
           var kode = $(this).val();

           $.ajax({
             url: "<?php echo base_url('cabang/getdata_bank') ?>",
             method: "POST",
             data: {
               kode: kode

             },
             async: false,
             dataType: 'json',
             success: function(coba) {
               //
               document.getElementById("kd_bank").value = coba['bank'];
             }

           })
         });

         var ajax2 = $.ajax({
           dataType: "json",
           url: "<?= base_url('time/getdatawaktutd') ?>",
           type: "POST",
           async: true,
           dataType: 'json',
           data: {
             id: projtd,
             ske: ske
           },
           success: function(result2) {
             console.log("success 2");
           }
         });

         var ajax3 = $.ajax({
           dataType: "json",
           url: "<?= base_url('time/getjumcabang') ?>",
           type: "POST",
           async: true,
           dataType: 'json',
           data: {
             id: projtd,
             ske: ske
           },
           success: function(result3) {
             console.log("success 3");
             // console.log(result3);
           }
         });

         var ajax4 = $.ajax({
           dataType: "json",
           url: "<?= base_url('time/getdatatd_report') ?>",
           type: "POST",
           async: true,
           dataType: 'json',
           data: {
             id: projtd,
             ske: ske
           },
           success: function(result4) {
             console.log("success 4");
             console.log(result4.length);
             console.log(result4);
           }
         });

         $.when(ajax1, ajax2, ajax3, ajax4).done(function(a1, a2, a3, a4) {

           var longa1 = a1[0].length; //pilihan_td
           var longa2 = a2[0].length; //data_waktu_td group by
           var longa3 = a3[0].length; //get jumlah cabang
           var longa4 = a4[0].length; //data_waktu_td full

           console.log(a3[0]);
           console.log(longa2);
           console.log(longa3);
           console.log(longa4);

           var num = 0;
           var ht = `<tbody>`
           loop1:
             for (var cz = 0; cz < longa3; cz++) {

               num = num + 1;
               ht += `<tr>`
               ht += `<td>` + num + `</td>`
               ht += `<td>` + a3[0][cz].nama + `</td>`

               ht += `<td><center>`
               for (let cy = 0; cy < longa2; cy++) {
                 if (a3[0][cz].kode == a2[0][cy].kode_cabang) {
                   ht += `` + a2[0][cy].kapan_isi_form + ``
                 }
               }
               ht += `<center></td>`

               ht += `<td><center>`
               for (let cy = 0; cy < longa2; cy++) {
                 if (a3[0][cz].kode == a2[0][cy].kode_cabang) {
                   ht += `` + a2[0][cy].jenis_form + ``
                 }
               }
               ht += `<center></td>`

               ht += `<td><center>`
               for (let cy = 0; cy < longa2; cy++) {
                 if (a3[0][cz].kode == a2[0][cy].kode_cabang) {
                   ht += `` + a2[0][cy].kondisi_pengisian + ``
                 }
               }
               ht += `<center></td>`

               ht += `<td><center>`
               for (let cy = 0; cy < longa2; cy++) {
                 if (a3[0][cz].kode == a2[0][cy].kode_cabang) {
                   ht += `` + a2[0][cy].temuan + ``
                 }
               }
               ht += `<center></td>`

               ht += `<td><center>`
               for (let cy = 0; cy < longa2; cy++) {
                 if (a3[0][cz].kode == a2[0][cy].kode_cabang) {
                   ht += `` + a2[0][cy].full + ``
                 }
               }
               ht += `<center></td>`

               for (let tt = 0; tt < longa1; tt++) {
                 ht += `<td><center>`
                 loop2:
                   for (let gg = 0; gg < longa4; gg++) {
                     if (a3[0][cz].kode == a4[0][gg].kode_cabang && a1[0][tt].pilihan_td == a4[0][gg].proses) {
                       ht += a4[0][gg].waktu
                       break loop2;
                     }
                   }
                 ht += `<center></td>`

                 ht += `<td><center>`
                 loop3:
                   for (let gg = 0; gg < longa4; gg++) {
                     if (a3[0][cz].kode == a4[0][gg].kode_cabang && a1[0][tt].pilihan_td == a4[0][gg].proses) {
                       if (a4[0][gg].ket_interupsi !== null) {
                         ht += a4[0][gg].ket_interupsi
                         break loop3;
                       }
                     }
                   }
                 ht += `<center></td>`

               }
               ht += `</tr>`
             }

           ht += `</tbody>`

           $('#dataTables-example').append(ht);
           var jt =
             `<h5><strong>PROGRESS : ` + longa2 + `/` + num + `</strong></h5>`
           $('#progresstd').append(jt);
           $('#loadingDiv').hide();

           if (document.getElementById('dataTables-example')) {

             $('#dataTables-example').DataTable({
               "responsive": true,
               "paging": true,
               "searching": true,
               "ordering": true,
               "info": true,
               "scrollY": "300px",
               "scrollX": "300px",
               "scrollCollapse": true,
             });

           }

         });
       });

       $('#exportexcel').click(function() {
         var pro = $('#project_tdview').val();
         var ske = $('#skenario_td_report').val();
         console.log(`test` + pro);
         console.log(`test` + ske);
         if (pro == '' || ske == '') {
           alert('Project dan skenario tidak boleh kosong !')
         } else {
           var table = $('#dataTables-example').DataTable();
           $('<table>')
             .append($(table.table().header()).clone())
             .append(table.$('tr').clone())
             .table2excel({
               exclude: ".noExl",
               name: "Excel Document Name",
               filename: `Report Time Delivery-` + pro + `-` + ske,
               fileext: ".xls",
               columns: [],
               exclude_img: true,
               exclude_links: true,
               exclude_inputs: true
             });
         }
       });




       // TAMBAHAN MENU AUVIQ EDIT TD REKAMAN
       $('#project_tdedit').change(function() {
         var cbg = $('#project_tdedit').val();
         $('#dataTables_edittd').empty();
         console.log(cbg);

         // $('#cbg_tdedit').selectpicker('refresh');
         // $('#cbg_tdedit').selectpicker('hide');
         $('#cbg_tdedit').selectpicker('destroy');
         $('#cbg_tdedit').empty();

         $.ajax({
           url: "<?= base_url('time/getdatatd_sort_sk') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             id: cbg
           },
           success: function(cbng) {
             $('#skenario_td_edit').empty();
             console.log("masuk");
             var cetak = `<option class="selected" value="0">Pilih Skenario</option>`
             for (var i = 0; i < cbng.length; i++) {
               cetak += `<option value="` + cbng[i].sk + `">` + cbng[i].name + `</option>`;
               console.log(cbng[i].name);
             }
             cetak += `</select>`;
             $('#skenario_td_edit').append(cetak);
           }
         });
       });

       $('#skenario_td_edit').change(function() {
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
           url: "<?= base_url('time/getcbg_tdedit') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             id: cbg,
             sken: sken
           },
           success: function(cbng) {
             console.log("masuk");
             var cetak = `<option value="">Pilih Cabang</option>`
             for (var i = 0; i < cbng.length; i++) {
               cetak += `<option value="` + cbng[i].kode_cabang + `">` + cbng[i].nama + `</option>`;
             }
             $('#cbg_tdedit').append(cetak);

             if (document.getElementById('cbg_tdedit')) {
               $('#cbg_tdedit').selectpicker({
                 liveSearch: true,
                 maxOptions: 1
               });
             }
           }
         });
       });

       $('#cbg_tdedit').change(function() {
         var pro = $('#project_tdedit').val();
         var sken = $('#skenario_td_edit').val();
         var cbg = $('#cbg_tdedit').val();
         $('#dataTables_edittd').empty();
         console.log(pro);
         console.log(sken);
         console.log(cbg);

         $.ajax({
           url: "<?= base_url('time/getdata_tdedit') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             cbg: cbg,
             sken: sken,
             pro: pro
           },
           success: function(cbng) {
             console.log(cbng.length);
             if (cbng.length == 0) {
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
             } else {
               var cetak = `<div class="row">
          <div class="col-lg-12">
            <div class="form-row">
              <div class="col-md-3 mb">
                <label>Kapan isi form </label>
                   <input class="kapan_isi_form form-control" name="kapan_isi_form" id="kapan_isi_form" value="` + cbng[0].kapan_isi_form + `" readonly>
                  </div>
              <div class="col-md-3 mb">
                <label>Jenis form </label>
                <input class="jenis_form form-control" name="jenis_form" id="jenis_form" value="` + cbng[0].jenis_form + `" readonly>
              </div>
              <div class="col-md-3 mb">
                <label>Kondisi Pengisian </label>
                <input class="selesai_isi_form form-control" name="selesai_isi_form" id="selesai_isi_form" value="` + cbng[0].kondisi_pengisian + `" readonly>
              </div>
              <div class="col-md-1 mb">
                <label>TD Full </label>
                <input class="full form-control" name="full" id="full" value="` + cbng[0].full + `" readonly>
              </div>
            </div>
          </div>
        </div>`

               cetak += `<div class="row">
                 <div class="col-lg-12">
                   <div class="form-row">
                     <div class="col-md-1 md">
                      <label>No </label>`
               for (var i1 = 0; i1 < cbng.length; i1++) {
                 var numm = i1 + 1;
                 cetak += `<input class="id_waktu form-control" name="number" id="number" value="` + numm + `" readonly>
                       <input type="hidden" name="id_waktu` + i1 + `" id="id_waktu` + i1 + `" value="` + cbng[i1].id_waktu + `" readonly>
                       <br>`
               }
               cetak += `</div>
                     <div class="col-md-3 mb">
                       <label>Proses </label>`
               for (var i2 = 0; i2 < cbng.length; i2++) {
                 cetak += `<input class="proses form-control" name="proses" id="proses" value="` + cbng[i2].proses + `" readonly>
                       <br>`
               }
               cetak += `</div>
                     <div class="col-md-5 mb">
                     <label>Keterangan Proses </label>`
               for (var i3 = 0; i3 < cbng.length; i3++) {
                 cetak += `<input class="ket_interupsi form-control" name="ket_interupsi" id="ket_interupsi" value="` + cbng[i3].ket_interupsi + `" readonly>
                       <br>`
               }
               cetak += `</div>
                     <div class="col-md-1 mb">
                     <label>Start TD </label>`
               for (var i4 = 0; i4 < cbng.length; i4++) {
                 cetak += `<input class="start_waktu form-control" name="start_waktu" id="start_waktu" value="` + cbng[i4].timestamp + `" readonly>
                       <br>`
               }
               cetak += `</div>
                     <div class="col-md-1 mb">
                     <label>Durasi </label>`
               for (var i5 = 0; i5 < cbng.length; i5++) {
                 cetak += `<input class="waktu form-control" name="waktu" id="waktu" value="` + cbng[i5].waktu + `">
                       <br>`
               }
               cetak += `</div>
                     <div class="col-md-1 mb">


                     </div>

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
                      <input type="text" class="form-control" name="akhirburek" id="akhirburek" value="` + cbng[0].akhir_td + `" readonly>
                  </div>
                  <div class="col-md-1 mb">
                  <a></a>
                  </div>
                </div>
              </div>
            </div>`
               if (cbng[0].part_1 !== null && cbng[0].part_1 !== '00:00:00') {
                 cetak += `<div class="row">
              <div class="col-lg-12">
                <div class="form-row">
                  <div class="col-md-10 mb" align="right">
                      <label for=""> <strong> Durasi Part 1 </strong> </label>
                  </div>
                  <div class="col-md-1 mb">
                      <input type="text" class="form-control" name="akhirburek" id="akhirburek" value="` + cbng[0].part_1 + `" readonly>
                  </div>
                  <div class="col-md-1 mb">
                  <a></a>
                  </div>
                </div>
              </div>
            </div>`
               }
               cetak += `<div class="row">
              <div class="col-lg-12">
                <div class="form-row">
                  <div class="col-md-10 mb" align="left">
                      <label for=""> <strong> Temuan </strong> </label>
                      <input type="text" class="form-control" name="akhirburek" id="akhirburek" value="` + cbng[0].temuan + `" readonly>
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

       $('#project_db_td').change(function() {
         var cbg = $('#project_db_td').val();
         $('#dataTables_db_td').empty();
         console.log(cbg);

         $.ajax({
           url: "<?= base_url('time/getdatatd_sort_sk') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             id: cbg
           },
           success: function(cbng) {
             $('#skenario_db_td').empty();
             console.log("masuk");
             var cetak = `<option class="selected" value="0">Pilih Skenario</option>`
             for (var i = 0; i < cbng.length; i++) {
               cetak += `<option value="` + cbng[i].sk + `">` + cbng[i].name + `</option>`;
               console.log(cbng[i].name);
             }
             cetak += `</select>`;
             $('#skenario_db_td').append(cetak);
           }
         });
       });

       $('#skenario_db_td').change(function() {
         var cbg = $('#project_db_td').val();
         var sken = $('#skenario_db_td').val();
         $('#loadingDiv2').show();
         $('#dataTables_db_td').empty();
         console.log(cbg);
         console.log(sken);

         $.ajax({
           url: "<?= base_url('time/get_db_td') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             id: cbg,
             sken: sken
           },
           success: function(result) {
             console.log("masuk");
             console.log(result.length);
             var ht = `<table class="table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-db_td">
                   <thead>
                    <tr>
                      <th><center>No<center></th>
                      <th><center>Kode Cabang<center></th>
                      <th><center>Kapan Isi Form<center></th>
                      <th><center>Jenis Form<center></th>
                      <th><center>Kondisi Pengisian Form<center></th>
                      <th><center>Proses<center></th>
                      <th><center>Keterangan Proses<center></th>
                      <th><center>Timestamp<center></th>
                      <th><center>Durasi<center></th>
                      <th><center>Akhir TD<center></th>
                      <th><center>TD Full<center></th>
                      <th><center>Part 1<center></th>
                      <th><center>Part 2<center></th>
                      <th><center>Temuan<center></th>
                    </tr>
                  </thead>
                  <tbody>`

             for (var idb = 0; idb < result.length; idb++) {
               var numn = idb + 1;
               ht += `<tr>
                      <td><center>` + numn + `<center></td>
                      <td>` + result[idb].kode_cabang + `</td>
                      <td>` + result[idb].kapan_isi_form + `</td>
                      <td>` + result[idb].jenis_form + `</td>
                      <td>` + result[idb].kondisi_pengisian + `</td>
                      <td>` + result[idb].proses + `</td>
                      <td>` + result[idb].ket_interupsi + `</td>
                      <td>` + result[idb].timestamp + `</td>
                      <td>` + result[idb].waktu + `</td>
                      <td>` + result[idb].akhir_td + `</td>
                      <td>` + result[idb].full + `</td>`

               if (result[idb].part_1 !== null && result[idb].part_1 !== '00:00:00') {
                 ht += `<td>` + result[idb].part_1 + `</td>`
               } else {
                 ht += `<td></td>`
               }

               if (result[idb].part_2 !== null && result[idb].part_2 !== '00:00:00') {
                 ht += `<td>` + result[idb].part_2 + `</td>`
               } else {
                 ht += `<td></td>`
               }

               ht += `<td>` + result[idb].temuan + `</td>
                    </tr>`
             }

             ht += `  <tbody>
                </table>`
             $('#dataTables_db_td').append(ht);
             $('#loadingDiv2').hide();

             if (document.getElementById('dataTables-db_td')) {

               $('#dataTables-db_td').DataTable({
                 "responsive": true,
                 "paging": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "600px",
                 "scrollCollapse": true,
               });

             }

           }
         });
       });

       $('#exportexcel_db_td').click(function() {
         var pro = $('#project_db_td').val();
         var ske = $('#skenario_db_td').val();
         console.log(`test` + pro);
         console.log(`test` + ske);
         if (pro == '' || ske == '') {
           alert('Project dan skenario tidak boleh kosong !')
         } else {
           var table = $('#dataTables-db_td').DataTable();
           $('<table>')
             .append($(table.table().header()).clone())
             .append(table.$('tr').clone())
             .table2excel({
               exclude: ".noExl",
               name: "Excel Document Name",
               filename: `Database TD-` + pro + `-` + ske,
               fileext: ".xls",
               columns: [],
               exclude_img: true,
               exclude_links: true,
               exclude_inputs: true
             });
         }
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

       $('#addpglain').click(function() {
         j = j + 1;
         var ht = `<div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan ` + j + ` </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jb` + j + `" id="jb` + j + `">
                        </div>
                    </div>`;
         $('#pilihanlainnya').append(ht);
       });

       $('#addjenissoal').click(function() {

         var radios = document.getElementsByName('cek');
         for (var i = 0, length = radios.length; i < length; i++) {
           if (radios[i].checked) {
             var x = (radios[i].value);
           }
         }

         if (x == 1 || x == 2) {
           if (x == 1) {
             var nilai = 1;
           } else {
             var nilai = 2;
           }
           var ht = `<div class="row">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan ` + j + ` </strong></h4>
                        <div class="form-horizontal style-form">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Pertanyaan</label>
                                <div class="col-sm-1">
                                <input type="text" class="form-control" name="kode` + j + `" id="kode` + j + `" placeholder="Kode">
                                </div>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="message` + j + `" id="message` + j + `" placeholder="Pertanyaan.." rows="1"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="jenissoal` + j + `" id="jenissoal` + j + `" value="` + nilai + `">

                    </div>
                </div>`;
         }

         if (x == 3) {
           var ht = `<div class="row" id="pertanyaan1">
                <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan ` + j + ` </strong></h4>
                    <div class="form-horizontal style-form">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pertanyaan</label>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kode` + j + `" id="kode` + j + `" placeholder="Kode">
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="message` + j + `" id="message` + j + `" placeholder="Pertanyaan.." rows="1"></textarea>
                        </div>
                    </div>

                    <section id="pilihanganda` + j + `">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg1` + j + `" id="pg1` + j + `">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg1` + j + `" id="kodepg1` + j + `" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump1` + j + `" id="jump1` + j + `" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                    </div>
                    </section>
                    <section id="jumlahpg` + j + `"><input type="hidden" name="jmlpg` + j + `" id="jmlpg` + j + `" value="1"/></section>
                  <input type="hidden" name="jenissoal` + j + `" id="jenissoal` + j + `" value="3">
                <button type="button" class="btn btn-round btn-primary" onclick="addpg(` + j + `)"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                </div>
                </div>`;
         }
         // <button type="button" class="btn btn-round btn-primary" id="addpg"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>

         if (x == 4) {
           var ht = `<div class="row" id="pertanyaan1">
                <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan ` + j + ` </strong></h4>
                    <div class="form-horizontal style-form">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pertanyaan</label>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kode` + j + `" id="kode` + j + `" placeholder="Kode">
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="message` + j + `" id="message` + j + `" placeholder="Pertanyaan.." rows="1" required></textarea>
                        </div>
                    </div>

                    <section id="pilihanganda` + j + `">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan 1 </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg1` + j + `" id="pg1` + j + `">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg1` + j + `" id="kodepg1` + j + `" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump1` + j + `" id="jump1` + j + `" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                    </div>
                    </section>
                    <section id="jumlahpg` + j + `"><input type="hidden" name="jmlpg` + j + `" id="jmlpg` + j + `" value="1"/></section>
                    <input type="hidden" name="jenissoal` + j + `" id="jenissoal` + j + `" value="3">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan Lainnya </label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="lain" id="lain" disabled>
                        </div>
                    </div>
                  <input type="hidden" name="jenissoal` + j + `" id="jenissoal` + j + `" value="4">
                <button type="button" class="btn btn-round btn-primary" onclick="addpg(` + j + `)"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                </div>
                </div>
                </div>`;
         }

         if (x == 5) {
           var ht = `<div class="row" id="pertanyaan1">
                <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Pertanyaan ` + j + ` </strong></h4>
                    <div class="form-horizontal style-form">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pertanyaan</label>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kode` + j + `" id="kode` + j + `" placeholder="Kode">
                        </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="message` + j + `" id="message` + j + `" placeholder="Pertanyaan.." rows="1"></textarea>
                        </div>
                    </div>

                    <section id="pilihanganda` + j + `">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Pilihan Multiple</label>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="pg1` + j + `" id="pg1` + j + `">
                        </div>
                        <div class="col-sm-1">
                        <input type="text" class="form-control" name="kodepg1` + j + `" id="kodepg1` + j + `" placeholder="Nilai">
                        </div>
                        <div class="col-sm-3">
                        <input type="text" class="form-control" name="jump1` + j + `" id="jump1` + j + `" placeholder="Lompat ke Kode Pertanyaan">
                        </div>
                    </div>
                    </section>
                    <section id="jumlahpg` + j + `"><input type="hidden" name="jmlpg` + j + `" id="jmlpg` + j + `" value="1"/></section>
                  <input type="hidden" name="jenissoal` + j + `" id="jenissoal` + j + `" value="5">
                <button type="button" class="btn btn-round btn-primary" onclick="addpg(` + j + `)"><i class="fa fa-check-circle fa-fw"></i> Tambah Pilihan</button>
                </div>
                </div>`;
         }


         $('#soalsoal').append(ht);
         $('#jumlahsoal').empty();
         var input = `<input type="hidden" name="jmlsoal" id="jmlsoal" value="` + j + `"/>`;
         $('#jumlahsoal').append(input);
         j = j + 1;
       });

       $("#addjeniskonsistensi").click(function() {
         var radios = document.getElementsByName('cek');
         for (var i = 0, length = radios.length; i < length; i++) {
           if (radios[i].checked) {
             var x = (radios[i].value);
           }
         }

         if (x == 1) {
           var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Antar Kunjungan </strong></h4>
                    <input type="hidden" name="cek_` + k + `" id="cek_` + k + `" value=1>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">Kode Soal</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="kode_cek1` + k + `" id="kode_cek1` + k + `" required>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1` + k + `" id="ket_cek1` + k + `" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
         }

         if (x == 2) {
           var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Hanya Jika </strong></h4>
                    <input type="hidden" name="cek_` + k + `" id="cek_` + k + `" value=2>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1` + k + `" id="kode_cek1` + k + `" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek1` + k + `" id="nilai_cek1` + k + `" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1` + k + `" id="ket_cek1` + k + `" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
         }

         if (x == 3) {
           var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Jika Maka</strong></h4>
                    <input type="hidden" name="cek_` + k + `" id="cek_` + k + `" value=3>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1` + k + `" id="kode_cek1` + k + `" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek1` + k + `" id="nilai_cek1` + k + `" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Maka Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2` + k + `" id="kode_cek2` + k + `" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2` + k + `" id="nilai_cek2` + k + `" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1` + k + `" id="ket_cek1` + k + `" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
         }

         if (x == 4) {
           var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Jika Tapi</strong></h4>
                    <input type="hidden" name="cek_` + k + `" id="cek_` + k + `" value=4>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1` + k + `" id="kode_cek1` + k + `" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control"name="nilai_cek1` + k + `" id="nilai_cek1` + k + `"  required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Tapi Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2` + k + `" id="kode_cek2` + k + `" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2` + k + `" id="nilai_cek2` + k + `" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1` + k + `" id="ket_cek1` + k + `" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
         }

         if (x == 5) {
           var ht = `<div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rentang Waktu </strong></h4>
                <input type="hidden" name="cek_` + k + `" id="cek_` + k + `" value=5>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Jika Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek1` + k + `" id="kode_cek1` + k + `" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek1` + k + `" id="nilai_cek1` + k + `" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" > Maka Kode Soal</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="kode_cek2` + k + `" id="kode_cek2` + k + `" required>
                        </div>
                        <label class="col-sm-2 control-label" style="text-align: center;">=</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="nilai_cek2` + k + `" id="nilai_cek2` + k + `" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Note Soal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="ket_cek1` + k + `" id="ket_cek1` + k + `" placeholder="Note untuk jawaban yang tidak konsisten" required>
                    </div>
                    </div>

                </div>
            </div>
            </div>`;
         }

         $("#datakonsistensi").append(ht);
         $('#jumlahdata').empty();
         var input = `<input type="hidden" name="jmldata" id="jmldata" value="` + k + `"/>`;
         $('#jumlahdata').append(input);
         k = k + 1;
       });

       $('#addkolomskill').click(function() {
         l = l + 1;
         var ht = ` <div class="form-group">
                        <label class="col-sm-2 control-label">Kode Kolom</label>
                        <div class="col-sm-1">
                            <input type="text" class="form-control" name="kode` + l + `" id="kode` + l + `">
                        </div>
                        <label class="col-sm-2 control-label">Pertanyaan</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="pertanyaan` + l + `" id="pertanyaan` + l + `">
                        </div>
                        <label class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" name="keterangan` + l + `" id="keterangan` + l + `">
                        </div>
                        </div>`;
         $('#kolomskill').append(ht);
         $('#jmlkolomskill').empty();
         var input = `<input type="hidden" name="jmlkolomskill" id="jmlkolomskill" value="` + l + `"/>`;
         $('#jmlkolomskill').append(input);
       });

       $(document).ready(function() {

       $('#addpil2').click(function() {
        var num = parseInt($('#jmlpil').val());
         num = num + 1;
         console.log(m);
         var ht = `<div class="form-group" id="group`+num+`">
                            <label class="col-sm-2 control-label"> Pilihan ` + num + ` </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pil` + num + `" id="pil` + num + `">
                            </div>
              </div>`;
         $('#pil').append(ht);
         $('#jmlpilihan').empty();
         var input = `<input type="hidden" class="form-control" name="jmlpil" id="jmlpil" value="` + num + `">`;
         $('#jmlpilihan').append(input);
       });

     });

       $(document).ready(function() {
         $('#addpil_eb').click(function() {
           m = m + 1;
           console.log(m);
           var ht = `<div class="form-group">
                            <label class="col-sm-2 control-label"> Step ` + m + ` </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="td_eb` + m + `" id="td_eb` + m + `">
                            </div>
                            <a href='#' class='btn btn-danger remove_field' title='Delete'><i class='fas fa-trash-alt'></i></a>
              </div>`;
           $('#pil').append(ht);
           $('#jmlpilihan').empty();
           var input = `<input type="hidden" class="form-control" name="jmlpil" id="jmlpil" value="` + m + `">`;
           $('#jmlpilihan').append(input);
         });

         $('#pil').on("click", ".remove_field", function(e) { //user click on remove text
           e.preventDefault();
           $(this).parent('div').remove();
           m = m - 1;
           $('#jmlpilihan').empty();
           var input = `<input type="hidden" class="form-control" name="jmlpil" id="jmlpil" value="` + m + `">`;
           $('#jmlpilihan').append(input);
           console.log(m);
         })
       });

       $('#addpil').click(function() {
         m = m + 1;
         console.log(m);
         var ht = `<div class="form-group">
                            <label class="col-sm-2 control-label"> Pilihan ` + m + ` </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pil` + m + `" id="pil` + m + `">
                            </div>
              </div>`;
         $('#pil').append(ht);
         $('#jmlpilihan').empty();
         var input = `<input type="hidden" class="form-control" name="jmlpil" id="jmlpil" value="` + m + `">`;
         $('#jmlpilihan').append(input);
       });


       $('#addpiltd1').click(function() {
         var sek = $('#id_skenario_a').val(); //VIEW LIHAT VALIDASI INI GA ADA BRO
         var pro = $('#project_td').val();
         var ht = `<div class="row">
                        <div class="col-md-9 mb">
                            <select class="form-control" name="piltd` + n + `" id="piltd` + n + `" onchange="interupsi(` + n + `)">
                                <option value=""> Proses ke - ` + n + ` </option>
                            `;
         var f = n;
         var hx = [];
         for (g = 1; g < f; g++) {
           var sl = "#piltd" + g + " option:selected";
           var jx = $(sl).val();
           hx.push(jx);
         }
         $.ajax({
           url: "<?= base_url('time/jenistime') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             skenario: sek,
             project: pro
           },
           success: function(hasil) {
             for (i = 0; i < hasil.length; i++) {
               var dec = 0
               for (var h = 0; h < f; h++) {
                 if (hasil[i].pilihan_td == hx[h]) {
                   dec = 1;
                   console.log(hasil[i].pilihan_td + `><` + hx[h])
                 }
               }
               if (dec == 0) {
                 ht = ht + `<option value="` + hasil[i].pilihan_td + `"> ` + hasil[i].pilihan_td + ` </option>`;
               }
             }

             // TAMBAHAN BARU
             var vid = document.getElementById("rekaman");
             var time = `` + vid.currentTime + ``;
             var time1 = time.toHHMMSS(); //INI ADA FUNCTION NYA
             // AKHIR

             ht = ht + `</select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="jbpiltd` + n + `" id="jbpiltd` + n + `" value="` + time1 + `">
                        </div>
                    </div>
                    <section id="interupsi` + n + `"></section>`;
             $('#piltd1').append(ht);
           }
         });


         var htl = `<input type="hidden" class="form-control mb" name="jumlahpiltd" id="jumlahpiltd" value="` + n + `">`;
         $('#jmlpiltd').empty();
         $('#jmlpiltd').append(htl);
         n = n + 1;
       });

       $('#addpiltd2').click(function() {
         var time = $('#rekaman').currentTime;
         var htl = `<input type="text" class="form-control mb" name="jumlahpiltd" id="jumlahpiltd" value="` + time + `">`;
         $('#piltd1').append(htl);
       });

       $("#formxx").change(function() {
         $("#piltd1").empty();
         $("#cabang").empty();
         // console.log("MASUK WAY");
         var id = "#formxx option:selected";
         var optionText = $(id).val();
         // console.log(optionText);
         $("#id_skenario_a").val(optionText);
         n = 1;
       });

       // $("select.form-control").change(function(){
       //   console.log("MASUK WAY");
       //   var char = $(this).children("option:selected").val();
       //   console.log(char);
       // });

       $(".textarea").focus(function() {
         $(this).css("height", "300px");
       });

       $(".textarea").focusout(function() {
         $(this).css("height", "");
       });

       $('#sproject').change(function() {
         var id = $(this).val();
         $('#skunjungan').empty();
         console.log(id);
         $.ajax({
           url: "<?php echo base_url('validasi/getkunjungan') ?>",
           method: "POST",
           data: {
             id: id
           },
           // async : false,
           dataType: 'json',
           success: function(hasil) {
             var cetak = `<option>Pilih Kunjungan</option>`;
             for (var i = 0; i < hasil.length; i++) {
               cetak += "<option value='" + hasil[i]['kategori'] + "'>" + hasil[i]['kunjunganx'] + "</option>";
               console.log(hasil[i]['kunjunganx']);
             }
             $(".kunjungan").append(cetak);
           }
         });
       });

       $('#ssproject').change(function() {
         var id = $(this).val();
         $('#skunjungan').empty();
         console.log(id);
         $.ajax({
           url: "<?php echo base_url('validasi/getkunjungan') ?>",
           method: "POST",
           data: {
             id: id
           },
           // async : false,
           dataType: 'json',
           success: function(hasil) {
             var cetak = ``;
             for (var i = 0; i < hasil.length; i++) {
               cetak += `<label class="radio-inline">
                    <input type="checkbox" name="cek` + i + `" id="cek` + i + `" value=` + hasil[i].kategori + `>
                    ` + hasil[i].kunjunganx + `
                    </label>
                    <input type="hidden" name="jumsken" id="jumsken" value=` + hasil.length + `>`;
               console.log(hasil[i]['kunjunganx']);
             }
             $("#skunjungan").append(cetak);
           }
         });
       });

       $('#ssprojecthapus').change(function() {
         var id = $(this).val();
         $('#skunjunganhapus').empty();
         $('#cbg_tdedit').selectpicker('destroy');
         $('#scabanghapus').empty();
         console.log(id);
         $.ajax({
           url: "<?php echo base_url('validasi/getcabang') ?>",
           method: "POST",
           data: {
             id: id
           },
           // async : false,
           dataType: 'json',
           success: function(hasil) {
             var cetak = `<select class="form-control" name="cabanghapus" id="cabanghapus">
                        <option value=""> Pilih Cabang</option>`;
             for (var i = 0; i < hasil.length; i++) {
               cetak += `<option value="` + hasil[i].kode + `"> (` + hasil[i].kode + `) ` + hasil[i].nama + `</option>`;
               // console.log(hasil[i]['kode']);
             }

             cetak += `</select>`;
             $("#scabanghapus").append(cetak);
             $('#cabanghapus').selectpicker({
               liveSearch: true,
               maxOptions: 1
             });
           }
         });

         $.ajax({
           url: "<?php echo base_url('validasi/gethapusdataTD') ?>",
           method: "POST",
           data: {
             id: id
           },
           // async : false,
           dataType: 'json',
           success: function(hasil) {
             var cetak = `<select class="form-control" name="kunjunganhapus" id="kunjunganhapus">
                        <option value=""> Pilih Kunjungan</option>`;
             for (var i = 0; i < hasil.length; i++) {
               cetak += `<option value="` + hasil[i].id_skenario + `">` + hasil[i].skenariox + `</option>`;
               console.log(hasil[i]['skenariox']);
             }

             cetak += `</select>`;
             $("#skunjunganhapus").append(cetak);
           }
         });
       });

       $('#skunjungan').change(function() {
         var id = $(this).val();
         var project = $('#sproject').val();
         $(".skenario").empty();
         $.ajax({
           url: "<?php echo base_url('validasi/getskenario') ?>",
           method: "POST",
           data: {
             id: id,
             pro: project
           },
           // async : false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
             var cetak = `<option>Pilih Skenario</option>`;
             for (var i = 0; i < hasil.length; i++) {
               cetak += "<option value='" + hasil[i]['att'] + "'>" + hasil[i]['skenariox'] + "</option>";
             }
             $(".skenario").append(cetak);
           }
         });
       });

       $('#rekamanskenario').change(function() {
         var project = $('#sproject').val();
         var sken = $('#rekamanskenario').val();
         $("#rekamancabang").empty();
         $.ajax({
           url: "<?php echo base_url('validasi/getcabangrekaman') ?>",
           method: "POST",
           data: {
             pro: project,
             sken: sken
           },
           dataType: 'json',
           success: function(hasil) {
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

       $('#temskenario').change(function() {
         var project = $('#sproject').val();
         var sken = $('#temskenario').val();
         $("#rekamancabang").empty();
         $.ajax({
           url: "<?php echo base_url('shp/getcabangrekaman') ?>",
           method: "POST",
           data: {
             pro: project,
             sken: sken
           },
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
             if (hasil.length >= 1) {
               var cetak = `<option>Pilih Cabang</option>`;
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['kode'] + "'>" + hasil[i]['kode'] + " - " + hasil[i]['nama'] + "</option>";
               }
               $("#rekamancabang").append(cetak);
             } else {
               var cetak = `<option>Cabang tidak tersedia</option>`
               $("#rekamancabang").append(cetak);
             }
           }
         });
       });

       $('#rekamancabang').change(function() {
         var cabang = $(this).val();
         var project = $('#sproject').val();
         var sken = $('#temskenario').val();
         var kunj = $('#skunjungan').val();

         console.log(project);
         console.log(kunj);
         console.log(sken);
         console.log(cabang);


         $("#temuan_sebelumnya").empty();
         $.ajax({
           url: "<?php echo base_url('shp/gettemuan_sebelumnya') ?>",
           method: "POST",
           data: {
             pro: project,
             sken: sken,
             cabang: cabang,
             kunj: kunj,
           },
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
             var ht = ``;
             var z = 0;
             if (hasil.length >= 1) {
               ht += `<h5 class="font-weight-bold">Temuan Sebelumnya : </h5>`;

               for (var i = 0; i < hasil.length; i++) {


                 z = i + 1;
                 ht += `
                 <div class="row">
                    <div class="col-lg-1 mb" style="margin-right:-50px;"><p> ` + z + `. </p></div>
                    <div class="col-lg-8 mb">
                        <input class="form-control" type="text" name="temuan_sebelumnya` + i + `" value="` + hasil[i]['ket_temuan'] + `" readonly>
                      </div>`;
                      if (hasil[i]['foto_temuan'] != null) {
                   ht +=   `<div class="col-lg-3 mb" style="margin-right:50px;">
                             <a href="" title="Foto Temuan" type="button" onclick="window.open('../assets/file/foto_temuan/` + hasil[i]['foto_temuan'] + `','newwindow','width=810,height=900'); return false;"; return false;"><i class="far fa-file-image fa-2x"></i></a href="">       
                        
                      </div>`;
                    }
                    ht +=  `</div>
                      `;
               }
               ht += `<hr>`;
               $("#temuan_sebelumnya").append(ht);

             }
           }
         });
       });

       $('#trproject').change(function() {
         var id = $(this).val();
         $('#trkunjungan').empty();
         console.log(id);
         $.ajax({
           url: "<?php echo base_url('shp/getkunjungan') ?>",
           method: "POST",
           data: {
             id: id
           },
           // async : false,
           dataType: 'json',
           success: function(hasil) {
             var cetak = `<option>Pilih Kunjungan</option>`;
             for (var i = 0; i < hasil.length; i++) {
               cetak += "<option value='" + hasil[i]['kategori'] + "'>" + hasil[i]['kunjunganx'] + "</option>";
               console.log(hasil[i]['kunjunganx']);
             }
             $(".kunjungan").append(cetak);
           }
         });
       });


       $('#trkunjungan').change(function() {
         var id = $(this).val();
         var project = $('#trproject').val();
         $(".skenario").empty();
         $.ajax({
           url: "<?php echo base_url('shp/getskenario') ?>",
           method: "POST",
           data: {
             id: id,
             pro: project
           },
           // async : false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
             var cetak = `<option>Pilih Skenario</option>`;
             for (var i = 0; i < hasil.length; i++) {
               cetak += "<option value='" + hasil[i]['att'] + "'>" + hasil[i]['skenariox'] + "</option>";
             }
             $(".skenario").append(cetak);
           }
         });
       });

       $('#trskenario').change(function() {
         var project = $('#trproject').val();
         var sken = $('#trskenario').val();
         console.log(project);
         console.log(sken);
         $('#trcabang').selectpicker('destroy');
         $("#trcabang").empty();
         $.ajax({
           url: "<?php echo base_url('shp/trcabang') ?>",
           method: "POST",
           data: {
             pro: project,
             sken: sken
           },
           dataType: 'json',
           success: function(hasil) {
             console.log('success');
             var cetak = `<option>Pilih Cabang</option>`;
             for (var i = 0; i < hasil.length; i++) {
               cetak += "<option value='" + hasil[i]['kode'] + "'>" + hasil[i]['kode'] + " - " + hasil[i]['nama'] + "</option>";
             }
             $("#trcabang").append(cetak);
             $('#trcabang').selectpicker();

           }
         });
       });

       $('#trcabang').change(function() {

         var project = $('#trproject').val();
         var sken = $('#trskenario').val();
         var cbg = $('#trcabang').val();

         $('#trackingnya').empty();

         $.ajax({
           url: "<?php echo base_url('shp/trackingq') ?>",
           method: "POST",
           data: {
             pro: project,
             sken: sken,
             cbg: cbg
           },
           dataType: 'json',
           success: function(hasil) {

             console.log(hasil);

             var rekaman = new Date(hasil[0].tglrek);
             var dialog = new Date(hasil[0].tgldialog);

             console.log(rekaman);
             console.log(dialog);


             var ht = `<div class="recent-activity">`

             if (hasil[0].tglshp != 0) {

               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-trophy"></i></div>
                    <div class="activity-panel">
                      <h5>` + hasil[0].tglshp + `</h5>
                      <p>Paid</p>
                    </div>`

             }

             if (hasil[0].tglrtp != 0) {

               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-money-bill"></i></div>
                    <div class="activity-panel">
                      <h5>` + hasil[0].tglrtp + `</h5>
                      <p>Ready to Paid</p>
                    </div>`
             }

             if (hasil[0].tglvalid != 0) {

               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-check-square"></i></div>
                    <div class="activity-panel">
                      <h5>` + hasil[0].tglvalid + `</h5>
                      <p>Validasi data kunjungan</p>
                    </div>`
             }

             if (hasil[0].tglrek != 0 && hasil[0].tgldialog != 0 && rekaman < dialog) {

               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-file-pdf"></i></div>
                    <div class="activity-panel">
                      <h5>` + hasil[0].tgldialog + `</h5>
                      <p>Upload Dialog</p>
                    </div>`

               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-video"></i></div>
                    <div class="activity-panel">
                      <h5>` + hasil[0].tglrek + `</h5>
                      <p>Upload Rekaman</p>
                    </div>`


             } else if (hasil[0].tglrek != 0 && hasil[0].tgldialog != 0 && dialog < rekaman) {


               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-video"></i></div>
                        <div class="activity-panel">
                          <h5>` + hasil[0].tglrek + `</h5>
                          <p>Upload Rekaman</p>
                        </div>`

               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-file-pdf"></i></div>
                    <div class="activity-panel">
                      <h5>` + hasil[0].tgldialog + `</h5>
                      <p>Upload Dialog</p>
                    </div>`

             } else if (hasil[0].tglrek != 0) {

               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-video"></i></div>
                        <div class="activity-panel">
                          <h5>` + hasil[0].tglrek + `</h5>
                          <p>Upload Rekaman</p>
                        </div>`

             } else if (hasil[0].tgldialog != 0) {

               ht += `<div class="activity-icon bg-theme02"><i class="fa fa-file-pdf"></i></div>
                    <div class="activity-panel">
                      <h5>` + hasil[0].tgldialog + `</h5>
                      <p>Upload Dialog</p>
                    </div>`

             }

             ht += `<div class="activity-icon bg-theme04"><i class="fa fa-rocket"></i></div>
                    <div class="activity-panel">
                      <h5>` + hasil[0].tanggal + `</h5>
                      <p>Aktual Kunjungan</p>
                    </div>`

             ht += `</div>`

             $('#trackingnya').append(ht);

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

     $(document).ready(function() {

       var i = 0;

       $("#tambahtemuan").click(function() {

         // $("#jumlahtemuan").remove();
         i = i + 1;
         // var id = `<input type="hidden" id="jumlahtemuan" name="jumlahtemuan" value="`+i+`">`;
         $('#jumlahtemuan').val(i);

         // $("#fototemuan").append(id);

         var ht = `
            <div class="col-lg-1 mb" style="margin-right:-50px;"><p> ` + i + `. </p></div>
            <div class="col-lg-8 mb">
                <input class="form-control" type="text" name="kettemuan` + i + `" placeholder="Tulis Keterangan Temuan Di sini ...">
              </div>

              <div class="col-lg-3 mb" style="margin-right:50px;">
                <div class="fileupload fileupload-new" data-provides="fileupload">
                  <span class="btn btn-theme02 btn-file">
                      <span class="fileupload-new pull-right"><i class="fa fa-paperclip"></i> Pilih File</span>
                  <span class="fileupload-exists"><i class="fa fa-undo"></i> Ubah</span>
                  <input type="file" class="default" name="filetemuan` + i + `" id="filetemuan` + i + `"/>
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


     $(document).ready(function() {

       var i = 0;

       $("#buatskenario").click(function() {
         var sken_id = $('select[name=kunjungan]').val();
         $.ajax({
           url: "<?php echo base_url('skenario/getAllDataSkenario') ?>",
           async: false,
           dataType: 'json',
           success: function(hasil) {
             $(".jumlah").remove();
             i = i + 1;

             if (sken_id == '001') {
               var sken_nama = "Q1"
             } else if (sken_id == '002') {
               var sken_nama = "Q2"
             } else if (sken_id == '003') {
               var sken_nama = "Q3"
             }

             var ht =
               `<div id="row` + i + `">
        <div class="row">

          <div class="col-sm-3">
            <label>Pilih skenario ke - ` + i + ` : </label>
          </div>

          <div class="col-sm-3">
            <select class="form-control" name="skenario` + i + `" id="skenario` + i + `" required>
             <option val="">Pilih Skenario</option>`
             //  if (sken_id == '001' || sken_id == '002' || sken_id == '003' && i == '1') {
             //   ht += `<option value="` + sken_id + `" selected>` + sken_nama + `</option>`;
             // } else {
             for (var j = 0; j < hasil.length; j++) {
               ht += `<option value="` + hasil[j]['kode'] + `">` + hasil[j]['nama'] + `</option>`;
               // }
             }
             ht += `</select>
          </div>
        </div>
        </div>
        <br>`;

             $("#allskenario").append(ht);
             var id = `<input type="hidden" id="jumlahskenario" name="jumlahskenario" value="` + i + `">`;
             $("#allskenario").append(id);
             var k = `<label value="` + i + `"class="col-lg-2 control-label jumlah">Jumlah Skenario : ` + i + `</label>`;
             $("#jumlah").append(k);
           }
         });
       });
     });

     $(document).ready(function() {

       var i = 0;

       $("#buatskenario_ebanking").click(function() {
         var sken_id = $('select[name=kunjungan]').val();
         $.ajax({
           url: "<?php echo base_url('skenario/getAllDataSkenario') ?>",
           async: false,
           dataType: 'json',
           success: function(hasil) {
             $(".jumlah").remove();
             i = i + 1;


             var ht =
               `<div id="row` + i + `">
        <div class="row">

          <div class="col-sm-3">
            <label>Pilih Waktu Evaluasi ke - ` + i + ` : </label>
          </div>

          <div class="col-sm-2">
            <select class="form-control" name="hari` + i + `" id="hari` + i + `" required>
             <option val="">Pilih Jenis Hari</option>
             <option val="Weekday">Weekday</option>
             <option val="Weekend">Weekend</option>
             
             </select>
          </div>
          <div class="col-sm-2">
            <select class="form-control" name="waktu` + i + `" id="waktu` + i + `" required>
             <option val="">Pilih Waktu</option>
             <option val="Pagi">Pagi</option>
             <option val="Siang">Siang</option>
             <option val="Malam">Malam</option>
             
             
             </select>
          </div>
          <div class="col-sm-1">
            <input type="number" class="form-control" placeholder="Jumlah" name="kuota` + i + `" id="kuota` + i + `" required>
          </div>
        <a href='#' class='btn btn-danger remove_field' title='Delete'><i class='fas fa-trash-alt'></i></a>

        </div>

                       
        </div>
        <br>`;

             $("#allskenario_trk").append(ht);
             var id = `<input type="hidden" id="jumlahskenario" name="jumlahskenario_ebanking" value="` + i + `">`;
             $("#allskenario_trk").append(id);
             var k = `<label value="` + i + `"class="col-lg-2 control-label jumlah">Jumlah Skenario : ` + i + `</label>`;
             $("#jumlah_trk").append(k);
           }
         });
       });
       $("#allskenario_trk").on("click", ".remove_field", function(e) { //user click on remove text
         e.preventDefault();
         $(this).closest('div').remove();
         i--;

         // $("#allskenario_trk").empty();
         var id = `<input type="hidden" id="jumlahskenario" name="jumlahskenario_ebanking" value="` + i + `">`;
         $("#allskenario_trk").append(id);
         $("#jumlah_trk").empty();
         var k = `<label value="` + i + `"class="col-lg-2 control-label jumlah">Jumlah Skenario : ` + i + `</label>`;
         $("#jumlah_trk").append(k);
       });
     });

     $(document).ready(function() {
       $('#channel').change(function() {
         var chan = $(this).val();

         $("#op_system").empty();
         $("#provider").empty();
         // alert(chan);
         var op = '';
         var op2 = '';
         var prov1 = '';
         var prov2 = '';

         op += '<div class="col-sm-2"><h5><b>Operating System  :</b></h5></div> ';
         op += '<div class="col-sm-1"> ';
         op += '<input type="checkbox" name="os[]" id="os1" value="Android">  <label for="os1">Android</label>';
         op += '</div>';
         op += '<div class="col-sm-1">';
         op += '<input type="checkbox" name="os[]" id="os1" value="IoS">  <label for="os1">IoS</label>';
         op += '</div>';

         op2 += '<div class="col-sm-2"><h5><b>Jenis SMS Banking  :</b></h5></div> ';
         op2 += '<div class="col-sm-2"> ';
         op2 += '<input type="checkbox" name="os[]" id="os1" value="SMS Banking Ketik">  <label for="os1">SMS Banking Ketik</label>';
         op2 += '</div>';
         op2 += '<div class="col-sm-2">';
         op2 += '<input type="checkbox" name="os[]" id="os1" value="SMS Banking Java">  <label for="os1">SMS Banking Java</label>';
         op2 += '</div>';
         op2 += '<div class="col-sm-2">';
         op2 += '<input type="checkbox" name="os[]" id="os1" value="SMS Banking USSD">  <label for="os1">SMS Banking USSD</label>';
         op2 += '</div>';


         prov1 += '<div class="col-sm-2"><h5><b>Provider  :</b></h5></div> ';
         prov1 += '<div class="col-sm-2"> ';
         prov1 += '<input type="checkbox" name="provider[]" id="provider1" value="Telkomsel">  <label for="os1">Telkomsel</label>';
         prov1 += '</div>';
         prov1 += '<div class="col-sm-2">';
         prov1 += '<input type="checkbox" name="provider[]" id="provider1" value="XL">  <label for="os1">XL</label>';
         prov1 += '</div>';
         prov1 += '<div class="col-sm-2">';
         prov1 += '<input type="checkbox" name="provider[]" id="provider1" value="Indosat">  <label for="os1">Indosat</label>';
         prov1 += '</div>';

         prov2 += '<div class="col-sm-2"><h5><b>Provider  :</b></h5></div> ';
         prov2 += '<div class="col-sm-2"> ';
         prov2 += '<input type="checkbox" name="provider[]" id="provider1" value="Telkomsel">  <label for="os1">Telkomsel</label>';
         prov2 += '</div>';
         prov2 += '<div class="col-sm-1">';
         prov2 += '<input type="checkbox" name="provider[]" id="provider1" value="XL">  <label for="os1">XL</label>';
         prov2 += '</div>';
         prov2 += '<div class="col-sm-1">';
         prov2 += '<input type="checkbox" name="provider[]" id="provider1" value="Indosat">  <label for="os1">Indosat</label>';
         prov2 += '</div>';
         prov2 += '<div class="col-sm-1">';
         prov2 += '<input type="checkbox" name="provider[]" id="provider1" value="Smartfren">  <label for="os1">Smartfren</label>';
         prov2 += '</div>'
         prov2 += '<div class="col-sm-1">';
         prov2 += '<input type="checkbox" name="provider[]" id="provider1" value="Indihome">  <label for="os1">Indihome</label>';
         prov2 += '</div>'
         prov2 += '<div class="col-sm-2">';
         prov2 += '<input type="checkbox" name="provider[]" id="provider1" value="Firstmedia">  <label for="os1">Firstmedia</label>';
         prov2 += '</div>'

         if (chan == "Mobile Banking") {
           $("#op_system").append(op);
           $("#provider").append(prov1);
         } else if (chan == "Internet Banking") {
           $("#provider").append(prov2);
         } else if (chan == "SMS Banking") {
           $("#provider").append(prov1);
           $("#op_system").append(op2);
         }


       });
     });

     $(document).ready(function(){
        $('#cek_td').click(function(){

          var pro = $('#project_eb').val();
          var chan = $('#channel_eb').val

          console.log(pro);
          console.log(chan);

        });
    });

     $(document).ready(function() {
       $('#channel_eb').change(function() {
         var chan = $(this).val();
         var pro = $('#project_eb').val();
         var bank = $('#bank_eb').val();


         console.log(chan);
         console.log(bank);
         console.log(pro);



         $('#transaksi_eb').empty();

         $("#os_eb").empty();
         $("#jenis_eb").empty();



         // }

         $.ajax({
           url: "<?php echo base_url('aktual/gettransaksi_ebanking_form') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<option value="">--Pilih Transaksi--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['transaksi'] + '">' + coba[i]['nama_transaksi'] + '</option>';

             }
             text += '</select>';

             $('#transaksi_eb').append(text);
             $('#transaksi_eb').selectpicker('refresh');


           }
         });





       });

       $('#transaksi_eb').on("change", function() { //user click on remove text
         var chan = $('#channel_eb').val();
         var bank = $('#bank_eb').val();

         $('#os_eb').empty();

         console.log(chan);
         console.log(bank);

         $.ajax({
           url: "<?php echo base_url('aktual/getaplikasi') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';
             var op2 = '';

             op2 += '<select class="form-control" name="os_eb" id="os_eb2"> ';
             op2 += '<option value=""> --Pilih SMS Banking-- </option> ';
             op2 += '<option value="SMS Banking Ketik"> SMS Banking Ketik </option>';
             op2 += '<option value="SMS Banking Java"> SMS Banking Java </option>';
             op2 += '<option value="SMS Banking USSD"> SMS Banking USSD </option>';
             op2 += '</select>';

             text += '<select class="form-control" name="os_eb" id="os_eb2">';
             text += '<option value="">--Pilih Jenis--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['os'] + "_" + coba[i]['nama'] + '">' + coba[i]['nama'] + " " + coba[i]['os'] + '</option>';

             }
             text += '</select>';

             if (chan == 'SMS Banking') {
               $('#os_eb').append(op2);
             } else {
               $('#os_eb').append(text);
               // $('#transaksi_eb').selectpicker('refresh');
             }


           }
         });
       });


       $('#transaksi_eb2').on("change", function() { //user click on remove text
         var chan = $('#channel_eb2').val();
         var bank = $('#bank_eb2').val();

         $('#os_eb2').empty();

         console.log(chan);
         console.log(bank);

         $.ajax({
           url: "<?php echo base_url('aktual/getaplikasi') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';
             var op2 = '';

             op2 += '<select class="form-control" name="os_eb" id="os_eb2"> ';
             op2 += '<option value=""> --Pilih SMS Banking-- </option> ';
             op2 += '<option value="SMS Banking Ketik"> SMS Banking Ketik </option>';
             op2 += '<option value="SMS Banking Java"> SMS Banking Java </option>';
             op2 += '<option value="SMS Banking USSD"> SMS Banking USSD </option>';
             op2 += '</select>';

             text += '<select class="form-control" name="os_eb" id="os_eb2">';
             text += '<option value="">--Pilih Jenis--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['os'] + "_" + coba[i]['nama'] + '">' + coba[i]['nama'] + " " + coba[i]['os'] + '</option>';

             }
             text += '</select>';

             if (chan == 'SMS Banking') {
               $('#os_eb2').append(op2);
             } else {
               $('#os_eb2').append(text);
               // $('#transaksi_eb').selectpicker('refresh');
             }


           }
         });
       });

       $('#os_eb').on("change", "#os_eb2", function() { //user click on remove text
         // var pro = $('#project_eb').val();
         var chan = $('#channel_eb').val();
         var bank = $('#bank_eb').val();
         var transaksi = $('#transaksi_eb').val();
         var os = $(this).val();


         $("#versi_eb_div").empty();

         console.log(chan);
         console.log(bank);
         // console.log(pro);
         console.log(transaksi);
         console.log(os);

         $.ajax({
           url: "<?php echo base_url('aktual/getversi') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             // pro: pro,
             transaksi: transaksi,
             os: os


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';
             console.log(coba.length);

             if (coba.length < 1) {
               text += '<input type="hidden" value="0" name="versi_eb" id="versi_eb">';
               $("#versi_eb_div").append(text);

             } else if (coba.length == 1) {
               text += '<input type="hidden" value="' + coba[0]['versi'] + '" name="versi_eb" id="versi_eb">';
               $("#versi_eb_div").append(text);

             } else if (coba.length > 1) {

               text += '<select class="form-control" name="versi_eb" id="versi_eb">';
               text += '<option value=""> --Pilih Versi-- </option> ';
               for (var i = 0; i < coba.length; i++) {
                 text += '<option value="' + coba[i]['versi'] + '">' + coba[i]['versi'] + '</option>';
                 // alert(coba[i]['versi']);
               }
               text += '</select>';
               $("#versi_eb_div").append(text);

             }

             // $("#versi_eb_div").append(text);
             //    op2 += '<select class="form-control" name="os_eb" id="os_eb2"> ';
             //   op2 += '<option value=""> --Pilih SMS Banking-- </option> ';
             //   op2 += '<option value="SMS Banking Ketik"> SMS Banking Ketik </option>';
             //   op2 += '<option value="SMS Banking Java"> SMS Banking Java </option>';
             //   op2 += '<option value="SMS Banking USSD"> SMS Banking USSD </option>';
             //   op2 += '</select>';

             //    text += '<select class="form-control" name="os_eb" id="os_eb2">';
             //   text += '<option value="">--Pilih Jenis--</option>';

             //   for (var i = 0; i < coba.length; i++) {

             //     text += '<option value="' + coba[i]['os']+"_"+coba[i]['nama'] + '">' + coba[i]['nama']+" "+coba[i]['os'] + '</option>';

             //   }
             //   text += '</select>';

             //  if (chan == 'SMS Banking') {
             //   $('#os_eb').append(op2);
             // } else {
             //  $('#os_eb').append(text);
             //   // $('#transaksi_eb').selectpicker('refresh');
             // }


           }
         });
       });



     });


     $(document).ready(function() {
       $('#channel_apl').change(function() {
         var chan = $(this).val();

         $('#div_system_apl').empty();


         // alert(chan);
         var sys = '';
         var sys2 = '';

         sys2 += '<input type="hidden" name="system" id="jenis_td2">';

         sys += '<label for="norek">System</label>';
         sys += '<select name="system" id="system_apl" class="form-control">';
         sys += '<option value="">--Pilih System--</option>';
         sys += '<option value="Android">Android</option>';
         sys += '<option value="IOS">IOS</option>';
         sys += '</select>';




         if (chan == "Mobile Banking") {
           $("#div_system_apl").append(sys);

         } else {
           $("#div_system_apl").append(sys2);

         }



       });
     });


     $(document).ready(function() {
       $('#channel_eb3').change(function() {
         var chan = $(this).val();

         $("#os_eb3").empty();
         $("#jenis_eb3").empty();
         // $("#provider").empty();
         // alert(chan);
         var op = '';
         var op2 = '';
         var op3 = '';
         var jenis = '';
         var jenis2 = '';
         var jenis3 = '';


         jenis2 += '<input type="hidden" name="jenis_eb" id="jenis_td2">';
         jenis3 += '<input type="hidden" name="jenis_eb" id="jenis_td2">';


         op += '<select class="form-control" name="os_eb" id="os_eb2"> ';
         op += '<option value=""> Pilih Operating System </option> ';
         op += '<option value="Android"> Android </option>';
         op += '<option value="IOS"> IOS </option>';
         op += '</select>';

         jenis += '<select class="form-control" name="jenis_eb" id="jenis_eb2"> ';
         jenis += '<option value=""> Pilih Jenis </option> ';
         jenis += '<option value="Android 1"> Android 1</option>';
         jenis += '<option value="Android 2"> Android 2</option>';
         jenis += '<option value="IOS 1"> IOS 1</option>';
         jenis += '<option value="IOS 2"> IOS 2</option>';
         jenis += '</select>';


         op2 += '<select class="form-control" name="os_eb" id="os_eb2"> ';
         op2 += '<option value=""> Pilih SMS Banking </option> ';
         op2 += '<option value="SMS Banking Ketik"> SMS Banking Ketik </option>';
         op2 += '<option value="SMS Banking Java"> SMS Banking Java </option>';
         op2 += '<option value="SMS Banking USSD"> SMS Banking USSD </option>';
         op2 += '</select>';

         op3 += '<input type="hidden" name="os_eb">';



         console.log($("#os_eb"));

         if (chan == "Mobile Banking") {
           $("#os_eb3").append(op);
           $("#jenis_eb3").append(jenis);


         } else if (chan == "Internet Banking") {
           $("#os_eb3").append(op3);
           $("#jenis_eb3").append(jenis3);

         } else if (chan == "SMS Banking") {
           $("#os_eb3").append(op2);
           $("#jenis_eb3").append(jenis2);


         }


       });
     });


     // $(document).ready(function() {
     //   $('#channel_td').change(function() {
     //     var chan = $(this).val();
     //     var pro = $('#project_td').val();
     //     var bank = $('#bank_td').val();

     //     $('#div_transaksi').empty();
     //     // $('#div_os').empty();
     //     // $('#div_jenis').empty();

     //     // $('#div_cari').empty();

     //     $.ajax({
     //       url: "<?php echo base_url('time/getvar_td') ?>",
     //       method: "POST",
     //       data: {
     //         chan: chan,
     //         bank: bank,
     //         pro: pro,


     //       },
     //       async: false,
     //       dataType: 'json',
     //       success: function(coba) {
     //         console.log(coba);

     //         var trx = '';

     //         trx += '<select class="form-control" name="transaksi_td" id="transaksi_td">';
     //         trx += '<option value=""> Pilih Transaksi </option>';
     //         for (var i = 0; i < coba.length; i++) {

     //           trx += '<option value="' + coba[i].transaksi + '"> ' + coba[i].nama + ' </option>';
     //         }
     //         trx += '</select>';

     //         $('#div_transaksi').append(trx);



     //       }
     //     });
     //   });

     $(document).ready(function() {
       $('#transaksi_td').on("change", function() { //user click on remove text
         var chan = $('#channel_td').val();
         var bank = $('#bank_td').val();

         $('#div_os').empty();

         console.log(chan);
         console.log(bank);

         $.ajax({
           url: "<?php echo base_url('aktual/getaplikasi') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';
             var op2 = '';

             op2 += '<select class="form-control" name="os_td" id="os_td2"> ';
             op2 += '<option value=""> --Pilih SMS Banking-- </option> ';
             op2 += '<option value="SMS Banking Ketik"> SMS Banking Ketik </option>';
             op2 += '<option value="SMS Banking Java"> SMS Banking Java </option>';
             op2 += '<option value="SMS Banking USSD"> SMS Banking USSD </option>';
             op2 += '</select>';

             text += '<select class="form-control" name="os_td" id="os_td2">';
             text += '<option value="">--Pilih Jenis--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['os'] + "_" + coba[i]['nama'] + '">' + coba[i]['nama'] + " " + coba[i]['os'] + '</option>';

             }
             text += '</select>';

             if (chan == 'SMS Banking') {
               $('#div_os').append(op2);
             } else {
               $('#div_os').append(text);
               // $('#transaksi_eb').selectpicker('refresh');
             }


           }
         });
       });
     });

     $(document).ready(function() {
       $('#cari_td_ebanking').click(function() {
         var chan = $('#channel_td').val();
         // var pro = $('#project_td').val();
         var bank = $('#bank_td').val();
         var transaksi = $('#transaksi_td').val();
         if (chan == 'SMS Banking') {
           var os = $('#os_td2').val();
           var jenis = '';
         } else {
           var get = $('#os_td2').val();

           var fields = get.split('_');

           var os = fields[0];
           var jenis = fields[1];
         }



         // $('#div_transaksi').empty();
         // $('#div_os').empty();
         // $('#div_cari').empty();
         // alert(os);
         console.log(chan);
         // console.log(pro);
         console.log(bank);
         console.log(transaksi);
         console.log(os);
         console.log(jenis);

         $('#dataTables_td_eb').empty();
         $.ajax({
           url: "<?php echo base_url('time/gettd_ebanking') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             // pro: pro,
             transaksi: transaksi,
             os: os,
             jenis: jenis,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             // console.log(coba);

             if (coba.length > 0) {

               var cetak = '';

               cetak += '<table class="table table-bordered table-striped table-condensed table-responsive-sm">';
               cetak += '<thead style="background-color: #E6E6FA;">';
               cetak += '<tr>';
               cetak += '<th><center>Step<center></th>';
               cetak += '<th><center>Label<center></th>';
               cetak += '<th><center>Versi<center></th>';
               cetak += '</tr>';
               cetak += '</thead>';
               cetak += '<tbody>';


               for (var i = 0; i < coba.length; i++) {

                 cetak += '<tr>';
                 cetak += '<th><center>Step ' + coba[i].step + '<center></th>';
                 cetak += '<th><center>' + coba[i].label + '<center></th>';
                 cetak += '<th><center>' + coba[i].versi + '<center></th>';
                 cetak += '</tr>';

               }
               cetak += '</tbody>';

               cetak += '</table>';

               $('#dataTables_td_eb').append(cetak);



               if (document.getElementById('dataTables-example')) {

                 $('#dataTables-example').DataTable({
                   "responsive": true,
                   "searching": true,
                   "ordering": true,
                   "info": false,
                   "scrollY": "300px",
                   "scrollCollapse": true,
                   "paging": false
                 });
               }

             } else {
               $('#dataTables_td_eb').empty();
               swal("Data Tidak Tersedia!", "Periksa Kembali Filtering Anda!", "error");
             }


           }
         });



       });
     });

     $(document).ready(function() {
       $('#kategori').change(function() {
         var kategori = $(this).val();


         console.log(kategori);

         $('#bank_modal').empty();
         $('#no_modal').empty();

         $.ajax({
           url: "<?php echo base_url('skenario/getkategori') ?>",
           method: "POST",
           data: {


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';
             var kata = '';

             if (kategori == 'Pulsa') {
               text += '<label for="bank">Provider</label>';
               text += '<select class="form-control" id="bank" name="bank">';
               text += '<option value="">--Pilih Provider--</option>';
               text += '<option value="Indosat">Indosat</option>';
               text += '<option value="Telkomsel">Telkomsel</option>';
               text += '<option value="Smartfren">Smartfren</option>';
               text += '<option value="XL">XL</option>';
               text += '<option value="Tri">Tri</option>';
               text += '<option value="Axis">Axis</option>';

               text += '</select>';

               kata += '<label for="norek">Nomor Handphone</label>';
               kata += '<input type="text" class="form-control" name="norek" id="norek" placeholder="Masukkan Nomor">';

               $('#bank_modal').append(text);
               $('#no_modal').append(kata);
             } else if (kategori == 'E-Wallet') {
               text += '<label for="bank">E-Wallet</label>';
               text += '<select class="form-control" id="bank" name="bank">';
               text += '<option value="">--Pilih E-Wallet--</option>';
               text += '<option value="GoPay">GoPay</option>';
               text += '<option value="OVO">OVO</option>';
               text += '<option value="DANA">DANA</option>';
               text += '<option value="LinkAja">LinkAja</option>';
               text += '<option value="iSaku">iSaku</option>';
               text += '<option value="Jenius">Jenius</option>';

               text += '</select>';

               kata += '<label for="norek">Nomor Handphone</label>';
               kata += '<input type="text" class="form-control" name="norek" id="norek" placeholder="Masukkan Nomor">';

               $('#bank_modal').append(text);
               $('#no_modal').append(kata);
             } else {
               text += '<label for="bank">Bank</label>';
               text += '<select class="form-control" id="bank" name="bank">';
               text += '<option value="">--Pilih Bank--</option>';
               for (var i = 0; i < coba.length; i++) {
                 text += '<option value="' + coba[i]['kode'] + '">' + coba[i]['nama'] + '</option>';
               }
               text += '</select>';

               kata += '<label for="norek">Nomor</label>';
               kata += '<input type="text" class="form-control" name="norek" id="norek" placeholder="Masukkan Nomor">';

               $('#bank_modal').append(text);
               $('#no_modal').append(kata);
             }


           }
         });

       });
     });


     $(document).ready(function() {
       $('#btn_transaksi').click(function() {
         var chan = $('input[type=radio][name="channel_eb"]:checked').val();
         var pro = $('#kd_project').val();
         var bank = $("#bank option:selected").val();
         // var bank = $('input[type=radio][name="bank"]:checked').val();


         console.log(chan);
         console.log(bank);
         console.log(pro);

         $('#transaksi_ebanking').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/gettransaksi_ebanking_form') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';

             if (coba.length > 0) {
               for (var i = 0; i < coba.length; i++) {

                 text += '<input type="radio" name="transaksi_eb" id="transaksi_eb" value="' + coba[i]['transaksi'] + '"> ' + coba[i]['nama_transaksi'] + '<br>';

               }
               $('#transaksi_ebanking').append(text);
             } else {

               text += '<div><h5><b>Transaksi belum tersedia untuk bank dan channel yang Anda pilih. Harap hubungi RA untuk konfirmasi transaksi pada bank dan channel tersebut.</b></h5></div>';
               $('#transaksi_ebanking').append(text);
             }


           }
         });

       });

       $('#transaksi_ebanking').on('change', 'input[type=radio][name="transaksi_eb"]', function() {
         var trx = $(this).val();

         console.log(trx);


         $('#jml_rek').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/getsumber') ?>",
           method: "POST",
           data: {

             trx: trx,

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             for (var i = 0; i < coba.length; i++) {

               text += '<input type="hidden" name="jumlah_sumber" id="jumlah_sumber" value="' + coba[i]['sumber'] + '">';
               text += '<input type="hidden" name="nama_trx" id="nama_trx" value="' + coba[i]['nama'] + '">';

               console.log(coba[i]['sumber']);
               console.log(coba[i]['nama']);


             }

             $('#jml_rek').append(text);
           }
         });
       });


       $('#trx_btn').click(function() {
         var transaksi = $('input[type=radio][name="transaksi_eb"]:checked').val();
         var bank = $("#bank option:selected").val();
         var jumlah = $('#jumlah_sumber').val();
         var nama_trx = $('#nama_trx').val();
         // var bank = $('input[type=radio][name="bank"]:checked').val();


         console.log(transaksi);
         console.log(bank);
         // console.log(jumlah);
         // console.log(nama_trx);

         $('#tujuan').empty();
         $('#trk_nama').empty();


         $.ajax({
           url: "<?php echo base_url('aktual/gettujuan') ?>",
           method: "POST",
           data: {
             transaksi: transaksi,
             bank: bank,
             jumlah: jumlah,
             nama_trx: nama_trx

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';

             if (jumlah == '2') {
               text += '<label>Masukkan Tujuan</label>';
               text += '<select class="form-control" name="tujuan" id="tujuan">';
               text += '<option value="">--Pilih Tujuan--</option>';
               for (var i = 0; i < coba.length; i++) {
                 if (coba[i]['kategori'] == 'Pulsa' || coba[i]['kategori'] == 'E-Wallet') {
                   text += '<option value="' + coba[i]['nama'] + " - " + coba[i]['norek'] + " - " + coba[i]['bank'] + '">' + coba[i]['nama'] + " - " + coba[i]['norek'] + " - " + coba[i]['bank'] + '</option>';

                 } else {
                   text += '<option value="' + coba[i]['nama'] + " - " + coba[i]['norek'] + " - " + coba[i]['nama_bank'] + '">' + coba[i]['nama'] + " - " + coba[i]['norek'] + " - " + coba[i]['nama_bank'] + '</option>';
                 }
               }
               text += '</select>';

             } else {
               text += '<input type="hidden" name="tujuan" id="tujuan" class="form-control">';
             }
             // console.log(text);
             $('#tujuan').append(text);
             $('#trk_nama').append(nama_trx);



           }
         });

       });
     });


     $(document).ready(function() {
       $('#nama_shopper').change(function() {

         if ($(this).val() == '') {
           $('#btn_shopper').attr('disabled', 'disabled');
         } else {
           $('#btn_shopper').removeAttr('disabled');
         }
       });

       $('#bank').change(function() {

         if ($(this).val() == '') {
           $('#next_bank').attr('disabled', 'disabled');
         } else {
           $('#next_bank').removeAttr('disabled');
         }
       });

       $('#tanggal_evaluasi').change(function() {

         if ($(this).val() == '') {
           $('#btn_tanggal').attr('disabled', 'disabled');
         } else {
           $('#btn_tanggal').removeAttr('disabled');
         }
       });

       $('#jam_mulai').change(function() {

         if ($(this).val() == '') {
           $('#btn_mulai').attr('disabled', 'disabled');
         } else {
           $('#btn_mulai').removeAttr('disabled');
         }
       });

       $('#jam_selesai').change(function() {

         if ($(this).val() == '') {
           $('#btn_jam').attr('disabled', 'disabled');
         } else {
           $('#btn_jam').removeAttr('disabled');
         }
       });

       $('input[type=radio][name="channel_eb"]').change(function() {
         console.log($(this).val());
         if ($(this).val() == '') {
           $('#btn_channel').attr('disabled', 'disabled');
         } else {
           $('#btn_channel').removeAttr('disabled');
         }
       });

       $('#os_ebanking').on("change", "#os_eb", function() {
         if ($(this).val() == '') {
           $('#btn_os').attr('disabled', 'disabled');
         } else {
           $('#btn_os').removeAttr('disabled');
         }
       });

       $('#provider_ebanking').on("change", "#provider_eb", function() {
         if ($(this).val() == '') {
           $('#btn_transaksi').attr('disabled', 'disabled');
         } else {
           $('#btn_transaksi').removeAttr('disabled');
         }
       });

       $('#transaksi_ebanking').on("change", "#transaksi_eb", function() {
         if ($(this).val() == '') {
           $('#trx_btn').attr('disabled', 'disabled');
         } else {
           $('#trx_btn').removeAttr('disabled');
         }
       });


       $('#norek_eb').change(function() {
         var tujuan = $('#tujuan option:selected').text();
         var norek = $('#norek_eb option:selected').text();

         console.log($(this).val());
         if ($(this).val() == '' || tujuan == norek) {
           $('#btn_sumber').attr('disabled', 'disabled');
         } else {
           $('#btn_sumber').removeAttr('disabled');
         }
       });

       $('#tujuan').change(function() {

         var tujuan = $('#tujuan option:selected').text();
         var norek = $('#norek_eb option:selected').text();

         if (tujuan == norek) {
           alert('Sumber dan Tujuan tidak boleh sama!')
           $('#btn_sumber').attr('disabled', 'disabled');
         } else {
           $('#btn_sumber').removeAttr('disabled');
         }
       });

       $('#percobaan_ke').on("change keyup", function() {
         console.log($(this).val());
         if ($(this).val() == '') {
           $('#fix_btn').attr('disabled', 'disabled');
         } else {
           $('#fix_btn').removeAttr('disabled');
         }
       });

       $('#timedelivery_ebanking').on("change keyup", ".value_td", function() {
         console.log($(this).val());
         if ($(this).val() == '') {
           $('#fix_td').attr('disabled', 'disabled');
         } else {
           $('#fix_td').removeAttr('disabled');
         }

         var baris = $('#baris_td').val();
         var sum = 0;
         for (var i = 1; i <= baris; i++) {

           var nilai = $('#value_td' + i).val();

           sum += +nilai;
         }

         console.log(sum.toFixed(2));
         $('#total_td').val(sum.toFixed(2));

       });








     });




     $(document).ready(function() {
       $('#next_bank').click(function() {

         var bank = $("#bank option:selected").val();


         console.log(bank);


         $('#norek_eb').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/getnorek_bank') ?>",
           method: "POST",
           data: {
             bank: bank,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';
             if (coba.length > 0) {

               text += '<option value="">--Pilih Nomor Rekening--</option>';
               for (var i = 0; i < coba.length; i++) {

                 text += '<option value="' + coba[i]['nama'] + " - " + coba[i]['norek'] + '">' + coba[i]['nama'] + ' - ' + coba[i]['norek'] + ' - ' + coba[i]['nama_bank'] + '</option>';

               }

             } else {
               text += '<option value="">--Pilih Nomor Rekening--</option>';
               text += '<option value="">-Daftar Rekening Belum Tersedia Untuk Bank Yang Dipilih-</option>';
             }



             $('#norek_eb').append(text);


           }
         });

       });
     });


     $(document).ready(function() {
       $('#fix_btn').click(function() {
         var chan = $('input[type=radio][name="channel_eb"]:checked').val();
         // var pro = $('#kd_project').val();
         // var bank = $('input[type=radio][name="bank"]:checked').val();
         var bank = $("#bank option:selected").val();
         var transaksi = $('input[type=radio][name="transaksi_eb"]:checked').val();
         if (chan == 'Mobile Banking' || chan == 'SMS Banking' || chan == 'Internet Banking') {
           var os2 = $('input[type=radio][name="os_eb"]:checked').val();


           var explode = os2.split("_");
           // var explode2 = os2.split(" ");

         }

         if (chan == 'Mobile Banking') {
           var os = explode[0];
           var jenis = explode[1];

         } else if (chan == 'SMS Banking') {
           var os = os2;
           var jenis = null;
         } else {
           var os = explode[0];
           var jenis = explode[1];
         }

         console.log(chan);
         console.log(bank);
         // console.log(pro);
         console.log(transaksi);
         console.log(os2);
         console.log(jenis);



         $('#timedelivery_ebanking').empty();
         $('#ket_td').empty();

         $.ajax({
           url: "<?php echo base_url('time/gettd_ebanking_form') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             // pro: pro,
             transaksi: transaksi,
             os: os,
             jenis: jenis,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             var text = '';
             if (coba.length > 0) {
               console.log(coba);


               text += '<div class="table-responsive">';
               text += '<table class="table">';
               text += '<thead>';
               text += '<tr>';
               text += '<th colspan="4"><center>Input Time Delivery<center></th>';
               text += '</tr>';
               text += '</thead>';
               text += '<tbody>';

               for (var i = 0; i < coba.length; i++) {

                 text += '<tr>';
                 text += '<td><center><b>' + coba[i]['label'] + '</b></center></td>';
                 text += '<td><center><b>:</b></center></td>';
                 text += '<td><center><input type="number" name="td_step' + coba[i]['step'] + '" id="value_td' + coba[i]['step'] + '" step="0.01" value="0.00" placeholder="0.00" class="form-control value_td"></center></td>';
                 text += '<td>detik</td>';

                 text += '</tr>';
               }


               text += '</tbody>';
               text += '</table>';
               text += '</div>';
               text += '<br>';

               // text += '<button class="btn btn-primary" id="test_td">Tes</button>';

               text += '<div class="form-inline">';
               text += '<label><b>Total TD :</b></label>';
               text += '<input type="text" class="form-control" id="total_td" name="total_td" value="" readonly>';
               text += '<input type="hidden" class="form-control" id="baris_td" name="baris_td" value="' + coba.length + '" readonly>';
               text += '<input type="hidden" class="form-control" id="versi_td" name="versi_td" value="' + coba[0]['versi'] + '" readonly>';
               text += '</div>';


               $('#timedelivery_ebanking').append(text);
               $('#ket_td').append("<h5>* Inputan dalam satuan detik(second)</>");
               // document.getElementById('test_td').style.display = 'block';
             } else {
               $('#btn_jumlahtd').empty();
               text += '<div><h5><b>Step-step transaksi belum tersedia untuk bank, channel dan jenis transaksi yang Anda pilih. Harap hubungi RA untuk membuat step transaksinya.</b></h5></div>';
               $('#timedelivery_ebanking').append(text);

             }


           }
         });

       });
     });


     $(document).ready(function() {
       $('#jenis_2').change(function() {
         var jenis = $(this).val();
         var chan = $('#channel_2').val();
         var bank = $('#bank_2').val();
         var transaksi = $('#transaksi_2').val();
         var os = $('#os_2').val();


         console.log(chan);
         console.log(bank);
         // console.log(pro);
         console.log(transaksi);
         console.log(os);
         console.log(jenis);



         $('#label_td_list').empty();

         $.ajax({
           url: "<?php echo base_url('time/gettd_ebanking_form') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             // pro: pro,
             transaksi: transaksi,
             os: os,
             jenis: jenis,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             var text = '';
             if (coba.length > 0) {
               console.log(coba);


               text += '<div class="table-responsive">';
               text += '<table class="table">';
               text += '<thead>';
               text += '<tr>';
               text += '<th colspan="4"><center>Input Time Delivery<center></th>';
               text += '</tr>';
               text += '</thead>';
               text += '<tbody>';

               for (var i = 0; i < coba.length; i++) {

                 text += '<tr>';
                 text += '<td><center><b>' + coba[i]['label'] + '</b></center></td>';
                 text += '<td><center><b>:</b></center></td>';
                 text += '<td><center><input type="number" name="td_step' + coba[i]['step'] + '" id="value_td' + coba[i]['step'] + '" step="0.01" value="0.00" placeholder="0.00" class="form-control value_td"></center></td>';
                 text += '<td>detik</td>';

                 text += '</tr>';
               }


               text += '</tbody>';
               text += '</table>';
               text += '</div>';
               text += '<br>';

               // text += '<button class="btn btn-primary" id="test_td">Tes</button>';

               text += '<div class="form-inline">';
               text += '<label><b>Total TD :</b></label>';
               text += '<input type="text" class="form-control" id="total_td" name="total_td" value="" readonly>';
               text += '<input type="hidden" class="form-control" id="baris_td" name="baris_td" value="' + coba.length + '" readonly>';
               text += '<input type="hidden" class="form-control" id="versi_td" name="versi_td" value="' + coba[0]['versi'] + '" readonly>';
               text += '</div>';


               $('#label_td_list').append(text);
               // document.getElementById('test_td').style.display = 'block';
             } else {
               $('#btn_jumlahtd').empty();
               text += '<div><h5><b>Step-step transaksi belum tersedia untuk bank, channel dan jenis transaksi yang Anda pilih. Harap hubungi RA untuk membuat step transaksinya.</b></h5></div>';
               $('#label_td_list').append(text);

             }


           }
         });

       });
     });








     $(document).ready(function() {
       $('#test_td').click(function() {

         var baris = $('#baris_td').val();
         var sum = 0;
         for (var i = 1; i <= baris; i++) {

           var nilai = $('#value_td' + i).val();

           sum += +nilai;
         }

         console.log(sum.toFixed(2));
         $('#total_td').val(sum.toFixed(2));

       });
     });



     $(document).ready(function() {
       $('#fix_td').click(function() {

         var baris = $('#baris_td').val();
         var sum = 0;
         for (var i = 1; i <= baris; i++) {

           var nilai = $('#value_td' + i).val();

           sum += +nilai;
         }

         console.log(sum.toFixed(2));
         $('#total_td').val(sum.toFixed(2));



       });
     });

     $(document).ready(function() {
       $('#tampilkanval_ebanking').click(function() {
         var chan = $('#validasi_channel').val();
         var pro = $('#validasi_project').val();
         var bank = $('#validasi_bank').val();
         var transaksi = $('#validasi_transaksi').val();

         var akses = $('#akses').val();


         console.log(chan);
         console.log(bank);
         console.log(pro);
         console.log(transaksi);

         // $('#div_transaksi').empty();
         // $('#div_os').empty();
         // $('#div_cari').empty();
         // alert(os);

         $('#tableval_ebanking').empty();

         $.ajax({
           url: "<?php echo base_url('validasi/getval_ebanking') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             pro: pro,
             transaksi: transaksi,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {

             console.log(coba);
             if (coba.length > 0) {

               var y = 0;
               var cobaah = "";

               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Daftar Data E-Banking Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Channel</b></td>";
               cobaah += "<td><b>Transaksi</b></td>";
               cobaah += "<td><b>System</b></td>";
               cobaah += "<td><b>Provider</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Transaksi Ke- </b></td>";
               cobaah += "<td><b>Nama Shopper </b></td>";
               cobaah += "<td><b>Tanggal </b></td>";
               cobaah += "<td><b>Jam Mulai</b></td>";
               cobaah += "<td><b>Jam Selesai</b></td>";

               cobaah += "<td><b>Jenis </b></td>";
               if (akses == 1) {
               cobaah += "<td><b>User Input</b></td>";
               }
               cobaah += "<td><b>Berhasil Percobaan Ke- </b></td>";
               cobaah += "<td><b>Total TD </b></td>";
               cobaah += "<td><b>Status</b></td>";
               cobaah += "<td><b>Riwayat Penolakan</b></td>";
               cobaah += "<td><b>Aksi </b></td>";

               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               var aktual = 0;
               var validasi = 0;
               var belum_aktual = 0;
               var ditolak = 0;
               for (var i = 0; i < coba.length; i++) {
                 if (coba[i]['status'] == '2') {
                   aktual++;
                   cobaah += "<tr style='background-color:  #98FB98;'>";
                 } else if (coba[i]['status'] == '3') {
                   validasi++;
                   cobaah += "<tr style='background-color: #00BFFF;'>";
                 } else if (coba[i]['status'] == '1') {
                   cobaah += "<tr style='background-color: #DC143C; color:white;'>";
                   ditolak++;
                 } else if (coba[i]['status'] == '0') {
                   cobaah += "<tr >";
                   belum_aktual++;
                 } else {
                   cobaah += "<tr >";
                 }
                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['channel'] != null) {
                   cobaah += "<td>" + coba[i]['channel'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_transaksi'] != null) {
                   cobaah += "<td>" + coba[i]['nama_transaksi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['os'] != null) {
                   cobaah += "<td>" + coba[i]['os'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['provider'] != null) {
                   cobaah += "<td>" + coba[i]['provider'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['shopper'] != null) {
                   cobaah += "<td>" + coba[i]['shopper'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['tanggal_evaluasi'] != null) {
                   cobaah += "<td>" + coba[i]['tanggal_evaluasi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['jam_mulai'] != null) {
                   cobaah += "<td>" + coba[i]['jam_mulai'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['jam_selesai'] != null) {
                   cobaah += "<td>" + coba[i]['jam_selesai'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['jenis'] != null) {
                   cobaah += "<td>" + coba[i]['jenis'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
              if (akses == 1) {
                if (coba[i]['user_input'] != null) {
                  if (coba[i]['penginput'] != null) {
                     cobaah += "<td>" + coba[i]['penginput'] + "</td>";
                   } else if (coba[i]['penginput2'] != null){
                     cobaah += "<td>" + coba[i]['penginput2'] + "</td>";
                   }
                } else {
                  cobaah += "<td></td>";
                }
              }
                 if (coba[i]['percobaan'] != null) {
                   cobaah += "<td>" + coba[i]['percobaan'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['total_td'] != null) {
                   cobaah += "<td>" + coba[i]['total_td'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['status'] == 1) {
                   cobaah += "<td><b>Ditolak</b></td>";
                 } else if (coba[i]['status'] == 2) {
                   cobaah += "<td><b>Belum Validasi</b></td>";
                 } else if (coba[i]['status'] == 3) {
                   cobaah += "<td><b>Diterima</b></td>";
                 }
                 if (coba[i]['r_temuan'] != null) {
                   cobaah += "<td style='background-color: #DC143C; color:white;'>" + coba[i]['r_temuan'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }

                 cobaah += "<td><a href='<?php echo base_url('validasi/lihatvalidasi_ebanking/') ?>" + coba[i]['num'] + "' class='btn btn-primary btn-sm btn-round' target='_blank'><i class='far fa-eye'></i> Lihat</a> </td>";

                 cobaah += "</tr>"

               }

               var persen_aktual = (aktual / coba.length) * 100;
               var persen_validasi = (validasi / coba.length) * 100;
               var persen_ditolak = (ditolak / coba.length) * 100;
               var persen_belum = (belum_aktual / coba.length) * 100;

               var total_masuk = aktual + validasi;
               var persen_total_masuk = ((aktual + validasi)/coba.length) * 100;

               cobaah += "</tbody>";
               cobaah += "</table>";
               cobaah += "<table>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b>Total Transaksi</b></h5></td>";
               cobaah += "<td><h5><b>: " + coba.length + "</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#98FB98;'></span>--Belum Validasi</b></h5></td>";
               cobaah += "<td><h5><b>: " + aktual + " (" + persen_aktual.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#00BFFF;'></span>--Diterima</b></h5></td>";
               cobaah += "<td><h5><b>: " + validasi + " (" + persen_validasi.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#DC143C;'></span>--Ditolak</b></h5></td>";
               cobaah += "<td><h5><b>: " + ditolak + " (" + persen_ditolak.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               // cobaah += "<tr>";
               // cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color: #F0FFF0;'></span>--Belum Aktual</b></h5></td>";
               // cobaah += "<td><h5><b>: " + belum_aktual + " (" + persen_belum.toFixed(2) + "%)</b></h5></td>";
               // cobaah += "</tr>";
               cobaah += "</table>";

               cobaah += "</div>";
               cobaah += "</div>";


               $("#tableval_ebanking").append(cobaah);

             } else {
               $("#tableval_ebanking").empty();
               swal("Daftar Validasi E-Banking Belum Tersedia", "Periksa Kembali Filtering Anda!", "error");
             }
             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }



           }
         });

       });
     });


   $(document).ready(function() {
       $('#tampilkanval_sosmed').click(function() {
         var plat = $('#validasi_platform').val();
         var pro = $('#validasi2_project').val();
         var bank = $('#validasi2_bank').val();
         var skenario = $('#validasi_skenario').val();


         console.log(plat);
         console.log(bank);
         console.log(pro);
         console.log(skenario);

         // $('#div_transaksi').empty();
         // $('#div_os').empty();
         // $('#div_cari').empty();
         // alert(os);

         $('#tableval_sosmed').empty();

         $.ajax({
           url: "<?php echo base_url('validasi/getval_sosmed') ?>",
           method: "POST",
           data: {
             plat: plat,
             bank: bank,
             pro: pro,
             skenario: skenario,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {

             console.log(coba);
             if (coba.length > 0) {

               var y = 0;
               var cobaah = "";

               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Daftar Data Evaluasi Sosial Media Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Platform</b></td>";
               cobaah += "<td><b>Skenario</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Evaluasi Ke- </b></td>";
               cobaah += "<td><b>Nama Shopper </b></td>";
               cobaah += "<td><b>Akun Pengirim </b></td>";
               cobaah += "<td><b>Akun Bank </b></td>";

               cobaah += "<td><b>Tanggal </b></td>";
               cobaah += "<td><b>Jam Mulai</b></td>";

               cobaah += "<td><b>Total TD </b></td>";
               cobaah += "<td><b>Status</b></td>";
               cobaah += "<td><b>Riwayat Penolakan</b></td>";
               cobaah += "<td><b>Aksi </b></td>";

               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               var aktual = 0;
               var validasi = 0;
               var belum_aktual = 0;
               var ditolak = 0;
               for (var i = 0; i < coba.length; i++) {
                 if (coba[i]['status'] == '2') {
                   aktual++;
                   cobaah += "<tr style='background-color:  #98FB98;'>";
                 } else if (coba[i]['status'] == '3') {
                   validasi++;
                   cobaah += "<tr style='background-color: #00BFFF;'>";
                 } else if (coba[i]['status'] == '1') {
                   cobaah += "<tr style='background-color: #DC143C; color:white;'>";
                   ditolak++;
                 } else if (coba[i]['status'] == '0') {
                   cobaah += "<tr >";
                   belum_aktual++;
                 } else {
                   cobaah += "<tr >";
                 }
                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['platform'] != null) {
                   cobaah += "<td>" + coba[i]['platform'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_skenario'] != null) {
                   cobaah += "<td>" + coba[i]['nama_skenario'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['shopper'] != null) {
                   cobaah += "<td>" + coba[i]['shopper'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['sosmed_pengirim'] != null) {
                   cobaah += "<td>" + coba[i]['sosmed_pengirim'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['sosmed_bank'] != null) {
                   cobaah += "<td>" + coba[i]['sosmed_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['tanggal_evaluasi'] != null) {
                   cobaah += "<td>" + coba[i]['tanggal_evaluasi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['jam_mulai'] != null) {
                   cobaah += "<td>" + coba[i]['jam_mulai'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['total_td'] != null) {
                  if (coba[i]['total_td'] == 1) { var kata = 'Kurang dari 30 menit'}
                    else if(coba[i]['total_td'] == 2) { var kata = '31 menit - 1 jam'}
                    else if(coba[i]['total_td'] == 3) { var kata = '1 - 24 jam (di hari yg sama)'}
                    else if(coba[i]['total_td'] == 4) { var kata = 'H+1'}
                    else if(coba[i]['total_td'] == 5) { var kata = 'H+2'}
                    else if(coba[i]['total_td'] == 6) { var kata = 'H+3'}
                    else if(coba[i]['total_td'] == 99) { var kata = 'Belum ada respons sama sekali hingga H+4'}

                   cobaah += "<td>" +kata+ "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['status'] == 1) {
                   cobaah += "<td><b>Ditolak</b></td>";
                 } else if (coba[i]['status'] == 2) {
                   cobaah += "<td><b>Belum Validasi</b></td>";
                 } else if (coba[i]['status'] == 3) {
                   cobaah += "<td><b>Diterima</b></td>";
                 }
                 if (coba[i]['r_temuan'] != null) {
                   cobaah += "<td style='background-color: #DC143C; color:white;'>" + coba[i]['r_temuan'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }

                 cobaah += "<td><a href='<?php echo base_url('validasi/lihatvalidasi_sosmed/') ?>" + coba[i]['num'] + "' class='btn btn-primary btn-sm btn-round' target='_blank'><i class='far fa-eye'></i> Lihat</a> </td>";

                 cobaah += "</tr>"

               }

               var persen_aktual = (aktual / coba.length) * 100;
               var persen_validasi = (validasi / coba.length) * 100;
               var persen_ditolak = (ditolak / coba.length) * 100;
               var persen_belum = (belum_aktual / coba.length) * 100;

               cobaah += "</tbody>";
               cobaah += "</table>";
               cobaah += "<table>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b>Total Evaluasi</b></h5></td>";
               cobaah += "<td><h5><b>: " + coba.length + "</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#98FB98;'></span>--Belum Validasi</b></h5></td>";
               cobaah += "<td><h5><b>: " + aktual + " (" + persen_aktual.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#00BFFF;'></span>--Diterima</b></h5></td>";
               cobaah += "<td><h5><b>: " + validasi + " (" + persen_validasi.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#DC143C;'></span>--Ditolak</b></h5></td>";
               cobaah += "<td><h5><b>: " + ditolak + " (" + persen_ditolak.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               // cobaah += "<tr>";
               // cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color: #F0FFF0;'></span>--Belum Aktual</b></h5></td>";
               // cobaah += "<td><h5><b>: " + belum_aktual + " (" + persen_belum.toFixed(2) + "%)</b></h5></td>";
               // cobaah += "</tr>";
               cobaah += "</table>";

               cobaah += "</div>";
               cobaah += "</div>";


               $("#tableval_sosmed").append(cobaah);

             } else {
               $("#tableval_sosmed").empty();
               swal("Daftar Validasi Evaluasi Sosial Media Belum Tersedia", "Periksa Kembali Filtering Anda!", "error");
             }

             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }



           }
         });

       });
     });


     $(document).ready(function() {
       $('#validasi_channel').change(function() {
         var chan = $(this).val();
         var pro = $('#validasi_project').val();
         var bank = $('#validasi_bank').val();


         console.log(chan);
         console.log(bank);
         console.log(pro);




         // $('#div_transaksi').empty();
         // $('#div_os').empty();
         // $('#div_cari').empty();
         // alert(os);

         $('#div_validasi_transaksi').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/gettransaksi_ebanking_form') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<select class="form-control" name="validasi_transaksi" id="validasi_transaksi">';
             text += '<option value="">--Pilih Transaksi--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['transaksi'] + '">' + coba[i]['nama_transaksi'] + '</option>';

             }
             text += '</select>';

             $('#div_validasi_transaksi').append(text);


           }
         });

       });
     });

     $(document).ready(function() {
       $('#validasi_platform').change(function() {
         var plat = $(this).val();
         var pro = $('#validasi2_project').val();
         var bank = $('#validasi2_bank').val();


         console.log(plat);
         console.log(bank);
         console.log(pro);




         // $('#div_transaksi').empty();
         // $('#div_os').empty();
         // $('#div_cari').empty();
         // alert(os);

         $('#div_validasi_skenario').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/getsken_sosmed_form') ?>",
           method: "POST",
           data: {
             plat: plat,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<select class="form-control" name="validasi_skenario" id="validasi_skenario">';
             text += '<option value="">--Pilih Skenario--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['skenario'] + '">' + coba[i]['nama_skenario'] + '</option>';

             }
             text += '</select>';

             $('#div_validasi_skenario').append(text);


           }
         });

       });
     });

     $(document).ready(function() {
       $('#progress_channel').change(function() {
         var chan = $(this).val();
         var pro = $('#progress_project').val();
         var bank = $('#progress_bank').val();


         console.log(chan);
         console.log(bank);
         console.log(pro);



         $('#progress_transaksi').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/gettransaksi_ebanking_form') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<option value="">--Pilih Transaksi--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['transaksi'] + '">' + coba[i]['nama_transaksi'] + '</option>';

             }
             text += '</select>';

             $('#progress_transaksi').append(text);


           }
         });

       });
     });


     $(document).ready(function() {
       $('#plotting_channel').change(function() {
         var chan = $(this).val();
         var pro = $('#plotting_project').val();
         var bank = $('#plotting_bank').val();


         console.log(chan);
         console.log(bank);
         console.log(pro);



         $('#plotting_transaksi').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/gettransaksi_plotting') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<option value="">--Pilih Transaksi--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['transaksi'] + '">' + coba[i]['nama_transaksi'] + '</option>';

             }
             text += '</select>';

             $('#plotting_transaksi').append(text);


           }
         });

       });
     });

     $(document).ready(function() {
       $('#plotting_platform').change(function() {
         var plat = $(this).val();
         var pro = $('#plotting_project').val();
         var bank = $('#plotting_bank').val();


         console.log(plat);
         console.log(bank);
         console.log(pro);



         $('#plotting_skenario').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/getsken_plotsosmed') ?>",
           method: "POST",
           data: {
             plat: plat,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<option value="">--Pilih Skenario--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['skenario'] + '">' + coba[i]['nama_skenario'] + '</option>';

             }
             text += '</select>';
             $('#plotting_skenario').append(text);
           }
         });

       });
     });




     $(document).ready(function() {
       $('#channel_eb3').change(function() {
         var chan = $(this).val();
         var pro = $('#project_eb').val();
         var bank = $('#bank_eb').val();


         console.log(chan);
         console.log(bank);
         console.log(pro);



         $('#transaksi_eb3').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/gettransaksi_ebanking_form') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<option value="">--Pilih Transaksi--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['transaksi'] + '">' + coba[i]['nama_transaksi'] + '</option>';

             }
             text += '</select>';

             $('#transaksi_eb3').append(text);


           }
         });

       });
     });


     $(document).ready(function() {
       $('#sken_project').change(function() {
         var id = $(this).val();
         console.log(id);
         $("#sken_bank").empty();
         $.ajax({
           url: "<?php echo base_url('aktual/getbank_progress') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             pro: id
           },
           success: function(hasil) {
             console.log(hasil);
             // $("#kunjungan").empty();
             var cetak = "<option value=''>Pilih Bank</option>";
             for (var i = 0; i < hasil.length; i++) {
               cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
             }
             $("#sken_bank").append(cetak);
             $("#sken_bank").selectpicker('refresh');
           }
         });
       });


       $('#sken_channel').change(function() {
         var chan = $(this).val();
         var pro = $('#sken_project').val();
         var bank = $('#sken_bank').val();

         console.log(chan);
         console.log(bank);
         console.log(pro);

         $('#div_sken_transaksi').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/gettransaksi_ebanking_form') ?>",
           method: "POST",
           data: {
             chan: chan,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<select class="form-control" name="validasi_transaksi" id="validasi_transaksi">';
             text += '<option value="">--Pilih Transaksi--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['transaksi'] + '">' + coba[i]['nama_transaksi'] + '</option>';

             }
             text += '</select>';

             $('#div_sken_transaksi').append(text);


           }
         });

       });

       $('#sken2_project').change(function() {
         var id = $(this).val();
         console.log(id);
         $("#sken_bank").empty();
         $.ajax({
           url: "<?php echo base_url('aktual/getbank_sosmed') ?>",
           type: "POST",
           dataType: 'json',
           data: {
             pro: id
           },
           success: function(hasil) {
             console.log(hasil);
             // $("#kunjungan").empty();
             var cetak = "<option value=''>Pilih Bank</option>";
             for (var i = 0; i < hasil.length; i++) {
               cetak += "<option value='" + hasil[i]['bank'] + "'>" + hasil[i]['nama_bank'] + "</option>";
             }
             $("#sken_bank").append(cetak);
             $("#sken_bank").selectpicker('refresh');
           }
         });
       });


       $('#sken_platform').change(function() {
         var plat = $(this).val();
         var pro = $('#sken2_project').val();
         var bank = $('#sken_bank').val();

         console.log(plat);
         console.log(bank);
         console.log(pro);

         $('#div_sken_transaksi').empty();

         $.ajax({
           url: "<?php echo base_url('aktual/getsken_sosmed_form') ?>",
           method: "POST",
           data: {
             plat: plat,
             bank: bank,
             pro: pro,


           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             var text = '';


             text += '<select class="form-control" name="validasi_skenario" id="validasi_skenario">';
             text += '<option value="">--Pilih Skenario--</option>';

             for (var i = 0; i < coba.length; i++) {

               text += '<option value="' + coba[i]['skenario'] + '">' + coba[i]['nama_skenario'] + '</option>';

             }
             text += '</select>';

             $('#div_sken_transaksi').append(text);


           }
         });

       });
     });






     $("#bukti_transaksi").change(function() {
       bacaGambar(this);
       if ($(this).val() == '') {
         $('#submit_aktual').attr('disabled', 'disabled');
       } else {
         $('#submit_aktual').removeAttr('disabled');
       }
     });

     function bacaGambar(input) {
       if (input.files && input.files[0]) {
         var reader = new FileReader();

         reader.onload = function(e) {
           $('#gambar_nodin').attr('src', e.target.result);
         }

         reader.readAsDataURL(input.files[0]);
       }
     }


     $(document).on('click', 'btn_remove', function() {
       var button_id = $(this).attr("id");
       $('#row' + button_id + '').remove();
     });

     /************ Javascript Tedi ****************/
     $(document).ready(function() {
       $('#projectted').change(function() {
         var id = $(this).val();
         console.log(id);
         $.ajax({
           url: "<?php echo base_url('stkb/getkotaproject') ?>",
           method: "POST",
           data: {
             id: id
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
             $("#showCheckAll").hide();
             $('input:checkbox[name^="kodesken"]').prop('checked', false);
             $("#namapic").empty();
             var optNamaPIC = "<option value=''>Pilih Nama</option>";
             $("#namapic").append(optNamaPIC);
             $('#namapic').selectpicker('refresh');
             //  $("#namaah").append(optNamaPIC);
             //  $('#namaah').selectpicker('refresh');
             //  $("#namafo").append(optNamaPIC);
             //  $('#namafo').selectpicker('refresh');
             $('select[name=namapic]').val('Pilih Nama');
             $('#namapic').selectpicker('refresh');
             $("#ajukanNamaLain").hide();
             $('select[name=idpicnya]').val('Pilih Nama');
             $('#idpicnya').selectpicker('refresh');
             $('#kotadari').attr('disabled', false);
             $('select[name=kotadari]').val('Pilih Kota dari');
             $('#kotadari').selectpicker('refresh');
             $('#kotadinas').attr('disabled', false);
             $('select[name=kotadinas]').val('Pilih Kota dinas');
             $('#kotadinas').selectpicker('refresh');
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

       $('#projectted_2021').change(function() {
         var id = $(this).val();
         console.log(id);
         $.ajax({
           url: "<?php echo base_url('stkb/getkotaproject') ?>",
           method: "POST",
           data: {
             id: id
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             $("#ajukanNamaLain").hide();
             $('select[name=idpicnya]').val('Pilih Nama');
             $('#idpicnya').selectpicker('refresh');
             $('#kotadari').attr('disabled', false);
             $('select[name=kotadari]').val('Pilih Kota dari');
             $('#kotadari').selectpicker('refresh');
             $('#kotadinas').attr('disabled', false);
             $('select[name=kotadinas]').val('Pilih Kota dinas');
             $('#kotadinas').selectpicker('refresh');
             $("#kotated_2021").empty();
             $("#tampilancabang").empty();
             var y = 0;
             var cetak = "<option>Pilih Kota</option>";;
             for (var i = 0; i < hasil['kota'].length; i++) {
               cetak += "<option value='" + hasil['kota'][i]['kota'] + "'>" + hasil['kota'][i]['kota'] + "</option>";
             }
             $("#type_pjk").val(hasil['type'][0]['type']);
             if (hasil['type'][0]['type'] == 'i') {
              document.getElementById('penugasan').readOnly = false;
              document.getElementById("penugasan").value = "";

             }
             console.log(hasil);
             $("#kotated_2021").append(cetak);
           }
         });
       });

       $('#checkAllSkenario').click(function() {
         if ($("#checkAllSkenario").prop("checked") == true) {
           //alert("TRUE");
           $('input:checkbox[class^="checkBoxSkenario"]').prop('checked', true);
         } else if ($("#checkAllSkenario").prop("checked") == false) {
           //alert("FALSE");
           $('input:checkbox[class^="checkBoxSkenario"]').prop('checked', false);
         }
       });

       function ambilsdmbykotapulau(kota) {
         var project = $('#projectted').val(),
           kareg = $('#karegted').val();
         $.ajax({
           url: "<?php echo base_url('stkb/getallnamabykotapulau') ?>",
           method: "POST",
           data: {
             project: project,
             kareg: kareg,
             kota: kota
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
             if (hasil.length > 0) {
               $("#ajukanNamaLain").show();
               $("#kotadinasnya").val(kota.toUpperCase());
               $("#namapic").empty();
               var cetak = "<option value=''>Pilih Nama</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['id'] + "'>" + hasil[i]['nama'] + " - " + hasil[i]['id'] + " - " + hasil[i]['kota_asal'] + "</option>";
               }
               $("#namapic").append(cetak);
               $('#namapic').selectpicker('refresh');
             } else {
               Swal({
                 position: 'top',
                 type: 'error',
                 title: 'Data kota "' + kota + '" tidak diketahui, tidak dapat menentukan Nama PIC',
                 showConfirmButton: false,
                 timer: 3000
               });
             }

           },
           error: function(request, status, error) {
             Swal({
               position: 'top',
               type: 'error',
               title: 'Data kota "' + kota + '" tidak diketahui, tidak dapat menentukan Nama PIC',
               showConfirmButton: false,
               timer: 3000
             });
           }
         });
       }


       function ambilsdmbykotapulau_2021(kota) {
         var project = $('#projectted_2021').val(),
           kareg = $('#karegted').val();
         $.ajax({
           url: "<?php echo base_url('stkb/getallnamabykotapulau_ah2021') ?>",
           method: "POST",
           data: {
             project: project,
             kareg: kareg,
             kota: kota
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log('here');
             console.log(hasil);
             if (hasil.length > 0) {
               $("#ajukanNamaLain").show();
               $("#kotadinasnya").val(kota.toUpperCase());
               $("#namaah").empty();
               var cetak = "<option value=''>Pilih Nama</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['id'] + "'>" + hasil[i]['nama'] + " - " + hasil[i]['id'] + " - " + hasil[i]['kota_asal'] + "</option>";
               }
               $("#namaah").append(cetak);
               $('#namaah').selectpicker('refresh');
             } else {
               Swal({
                 position: 'top',
                 type: 'error',
                 title: 'Data kota "' + kota + '" tidak diketahui, tidak dapat menentukan Nama Area Head/Kepala Field',
                 showConfirmButton: false,
                 timer: 3000
               });
             }

           },
           error: function(request, status, error) {
             Swal({
               position: 'top',
               type: 'error',
               title: 'Data kota "' + kota + '" tidak diketahui, tidak dapat menentukan Nama Area Head/Kepala Field',
               showConfirmButton: false,
               timer: 3000
             });
           }
         });

         $.ajax({
           url: "<?php echo base_url('stkb/getallnamabykotapulau_fo2021') ?>",
           method: "POST",
           data: {
             project: project,
             kareg: kareg,
             kota: kota
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log('here');
             console.log(hasil);
             if (hasil.length > 0) {
               $("#ajukanNamaLain").show();
               $("#kotadinasnya").val(kota.toUpperCase());
               $("#namafo").empty();
               var cetak = "<option value=''>Pilih Nama</option>";
               for (var i = 0; i < hasil.length; i++) {
                 cetak += "<option value='" + hasil[i]['id'] + "'>" + hasil[i]['nama'] + " - " + hasil[i]['id'] + " - " + hasil[i]['kota_asal'] + "</option>";
               }
               $("#namafo").append(cetak);
               $('#namafo').selectpicker('refresh');
             } else {
               Swal({
                 position: 'top',
                 type: 'error',
                 title: 'Data kota "' + kota + '" tidak diketahui, tidak dapat menentukan Nama Field Officer',
                 showConfirmButton: false,
                 timer: 3000
               });
             }

           },
           error: function(request, status, error) {
             Swal({
               position: 'top',
               type: 'error',
               title: 'Data kota "' + kota + '" tidak diketahui, tidak dapat menentukan Nama Field Officer',
               showConfirmButton: false,
               timer: 3000
             });
           }
         });
       }

       $('#show_progress').click(function() {
         var id_project = $('#progress_project').val();
         var bank = $('#progress_bank').val();
         var channel = $('#progress_channel').val();
         var transaksi = $('#progress_transaksi').val();
         var plotting = $('#filter_plotting').val();

         // var transport_cbg = document.getElementById('transport_cabang');
         // var provinsi_cbg = document.getElementById('provinsi_cabang');
         // var kodepos_cbg = document.getElementById('kodepos_cabang');
         // var fax_cbg = document.getElementById('fax_cabang');
         // var telp_cbg = document.getElementById('telp_cabang');

         console.log(id_project);
         console.log(bank);
         console.log(channel);
         console.log(transaksi);



         $.ajax({
           url: "<?php echo base_url('aktual/getprogress') ?>",
           method: "POST",
           data: {
             id_project: id_project,
             bank: bank,
             channel: channel,
             transaksi: transaksi,
             plotting: plotting

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             if (coba.length > 0) {

               //
               $("#tabel_progress").empty();
               var y = 0;
               var cobaah = "";






               // TAMBAHAN SOMA

               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Progress E-Banking Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Channel</b></td>";
               cobaah += "<td><b>Transaksi</b></td>";
               cobaah += "<td><b>System</b></td>";
               cobaah += "<td><b>Provider</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Transaksi Ke- </b></td>";
               cobaah += "<td><b>Nama Shopper </b></td>";
               cobaah += "<td><b>No Rekening </b></td>";
               cobaah += "<td><b>No Tujuan Transaksi</b></td>";

               cobaah += "<td><b>Tanggal Evaluasi</b></td>";
               cobaah += "<td><b>Jam Mulai</b></td>";
               cobaah += "<td><b>Jam Selesai</b></td>";

               cobaah += "<td><b>Jenis </b></td>";
               cobaah += "<td><b>Berhasil Percobaan Ke- </b></td>";
               // cobaah += "<td><b>Keterangan Gagal</b></td>"
               cobaah += "<td><b>Total TD </b></td>";
               cobaah += "<td><b>Riwayat Penolakan </b></td>";


               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               var aktual = 0;
               var validasi = 0;
               var belum_aktual = 0;
               var ditolak = 0;
               var plot = 0;
               var belum_plot = 0;
               for (var i = 0; i < coba.length; i++) {
                 // var ket_gagal = json_encode(unserialize(coba[i]['penyebab']));
                 // var mystring = "the word you need is 'hello'"
                 // var matches = mystring.match(/\'(.*?)\'/);  //returns array

                 // ​console.log(matches[1]);​
                 // var unser = JSON.parse(coba[i]['penyebab']);
                 // console.log(unser);

                 if (coba[i]['status'] == '2') {
                   aktual++;
                   cobaah += "<tr style='background-color:  #98FB98;'>";
                 } else if (coba[i]['status'] == '3') {
                   validasi++;
                   cobaah += "<tr style='background-color: #9ACD32;'>";
                 } else if (coba[i]['status'] == '1') {
                   cobaah += "<tr style='background-color: #DC143C; color:white;'>";
                   ditolak++;
                 } else if (coba[i]['status'] == '0') {
                   cobaah += "<tr >";
                   belum_aktual++;
                 } else {
                   cobaah += "<tr >";
                 }

                 if (coba[i]['status'] == '0' && coba[i]['tanggal_evaluasi'] !== null) {
                   plot++;
                 }
                 if (coba[i]['status'] == '0' && coba[i]['tanggal_evaluasi'] == null) {
                   belum_plot++;
                 }


                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['nama_project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['channel'] != null) {
                   cobaah += "<td>" + coba[i]['channel'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_transaksi'] != null) {
                   cobaah += "<td>" + coba[i]['nama_transaksi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['os'] != null) {
                   cobaah += "<td>" + coba[i]['os'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['provider'] != null) {
                   cobaah += "<td>" + coba[i]['provider'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['shopper'] != null) {
                   cobaah += "<td>" + coba[i]['shopper'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['norek'] != null) {
                   cobaah += "<td>" + coba[i]['norek'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['tujuan'] != null) {
                   cobaah += "<td>" + coba[i]['tujuan'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['tanggal_evaluasi'] != null) {
                   cobaah += "<td>" + coba[i]['tanggal_evaluasi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['jam_mulai'] != null) {
                   cobaah += "<td>" + coba[i]['jam_mulai'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['jam_selesai'] != null) {
                   cobaah += "<td>" + coba[i]['jam_selesai'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['jenis'] != null) {
                   cobaah += "<td>" + coba[i]['jenis'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['percobaan'] != null) {
                   cobaah += "<td>" + coba[i]['percobaan'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 //  if (coba[i]['penyebab'] != null) {
                 //   cobaah += "<td>" + coba[i]['penyebab'] + "</td>";
                 // } else {
                 //   cobaah += "<td></td>";
                 // }
                 if (coba[i]['total_td'] != null) {
                   cobaah += "<td>" + coba[i]['total_td'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['r_temuan'] != null) {
                   cobaah += "<td style='background-color: #DC143C; color:white;'>" + coba[i]['r_temuan'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 // if (coba[i]['upload_bukti'] != null) {
                 //       cobaah += "<td>"+ coba[i]['upload_bukti'] +"</td>";
                 // } else {
                 //       cobaah += "<td></td>"; 
                 // }


                 cobaah += "</tr>";

               }
               // cobaah += "</tr>";

               var persen_aktual = (aktual / coba.length) * 100;
               var persen_validasi = (validasi / coba.length) * 100;
               var persen_ditolak = (ditolak / coba.length) * 100;
               var persen_belum = (belum_aktual / coba.length) * 100;
               var persen_plot = (plot / coba.length) * 100;
               var persen_belum_plot = (belum_plot / coba.length) * 100;

               var total_masuk = aktual + validasi;
               var persen_total_masuk = ((aktual + validasi)/coba.length) * 100;

               cobaah += "</tbody>";
               cobaah += "</table>";
               cobaah += "</div>";
               cobaah += "</div>";
               cobaah += "<table>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b>Total Transaksi</b></h5></td>";
               cobaah += "<td><h5><b>: " + coba.length + "</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#98FB98;'></span>--Menunggu Validasi</b></h5></td>";
               cobaah += "<td><h5><b>: " + aktual + " (" + persen_aktual.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#9ACD32;'></span>--Sudah Validasi</b></h5></td>";
               cobaah += "<td><h5><b>: " + validasi + " (" + persen_validasi.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#DC143C;'></span>--Ditolak</b></h5></td>";
               cobaah += "<td><h5><b>: " + ditolak + " (" + persen_ditolak.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color:#1E90FF;'></span>--Total Aktual</b></h5></td>";
               cobaah += "<td><h5><b>: " + total_masuk + " (" + persen_total_masuk.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw' style='color: #F0FFF0;'></span>--Belum Aktual</b></h5></td>";
               cobaah += "<td><h5><b>: " + belum_aktual + " (" + persen_belum.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<tr>";
               cobaah += "<tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw'></span>--Sudah Plotting</b></h5></td>";
               cobaah += "<td><h5><b>: " + plot + " (" + persen_plot.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "<td><h5><b><span class='fa fa-square fa-fw'></span>--Belum Plotting</b></h5></td>";
               cobaah += "<td><h5><b>: " + belum_plot + " (" + persen_belum_plot.toFixed(2) + "%)</b></h5></td>";
               cobaah += "</tr>";
               cobaah += "</table>";




               $("#tabel_progress").append(cobaah);
             } else {
               $("#tabel_progress").empty();
               swal("Data Tidak Tersedia di Skenario!", "Periksa Kembali Filtering Anda!", "error");
             }
             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }
           }

         })
       });



       $('#show_plotting').click(function() {
         var id_project = $('#plotting_project').val();
         var bank = $('#plotting_bank').val();
         var channel = $('#plotting_channel').val();
         var transaksi = $('#plotting_transaksi').val();
         var hari = $('#plotting_hari').val();
         var waktu = $('#plotting_waktu').val();
         var trx = $('#plotting_trx').val();


         console.log(id_project);
         console.log(bank);
         console.log(channel);
         console.log(transaksi);

         document.getElementById('btn_update_plot').style.display = 'none';


         $.ajax({
           url: "<?php echo base_url('aktual/getplotting') ?>",
           method: "POST",
           data: {
             id_project: id_project,
             bank: bank,
             channel: channel,
             transaksi: transaksi,
             hari: hari,
             waktu: waktu,
             trx: trx

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             if (coba.length > 0) {

               //
               $("#tabel_plotting").empty();
               $("#id_plot").empty();

               var y = 0;
               var cobaah = "";
               var id_plot = "";


               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Plotting E-Banking Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<h6><b>Data yang ditampilkan merupakan data yang belum melalui proses plotting atau tanggal plotting sudah terlewat</b></h6>";

               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Channel</b></td>";
               cobaah += "<td><b>Transaksi</b></td>";
               cobaah += "<td><b>System</b></td>";
               cobaah += "<td><b>Provider</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Transaksi Ke- </b></td>";


               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               for (var i = 0; i < coba.length; i++) {

                 // ​console.log(matches[1]);​

                 cobaah += "<tr >";
                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['nama_project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['channel'] != null) {
                   cobaah += "<td>" + coba[i]['channel'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_transaksi'] != null) {
                   cobaah += "<td>" + coba[i]['nama_transaksi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['os'] != null) {
                   cobaah += "<td>" + coba[i]['os'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['provider'] != null) {
                   cobaah += "<td>" + coba[i]['provider'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }



                 cobaah += "</tr>";

                 id_plot += "<input type='hidden' name='id_plot[]' value='" + coba[i]['num'] + "'>";

               }

               cobaah += "</tbody>";
               cobaah += "</table>";

               cobaah += "</div>";
               cobaah += "<div class='row'>";
               cobaah += "<div class='col-sm-2'><label><b>Pilih Tanggal :</b></label></div>";
               cobaah += "<div class='col-sm-2'><input type='date' class='form-control' name='tgl_plot' required></div>";
               // cobaah =+ "<div class='col-sm-2'><button type='button' class='btn btn-primary'>Plotting</button></div>";
               cobaah += "</div>";



               // cobaah += "</tr>";

               $("#tabel_plotting").append(cobaah);
               $("#id_plot").append(id_plot);

               document.getElementById('btn_plot').style.display = 'block';

             } else {
               $("#tabel_plotting").empty();
               $("#id_plot").empty();

               swal("Data Tidak Tersedia di Skenario!", "Periksa Kembali Filtering Anda!", "error");
             }
             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }
           }

         })
       });

       $('#update_plotting').click(function() {
         var id_project = $('#plotting_project').val();
         var bank = $('#plotting_bank').val();
         var channel = $('#plotting_channel').val();
         var transaksi = $('#plotting_transaksi').val();
         var hari = $('#plotting_hari').val();
         var waktu = $('#plotting_waktu').val();
         var trx = $('#plotting_trx').val();


         console.log(id_project);
         console.log(bank);
         console.log(channel);
         console.log(transaksi);

         document.getElementById('btn_plot').style.display = 'none';


         $.ajax({
           url: "<?php echo base_url('aktual/getupdate_plotting') ?>",
           method: "POST",
           data: {
             id_project: id_project,
             bank: bank,
             channel: channel,
             transaksi: transaksi,
             hari: hari,
             waktu: waktu,
             trx: trx

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             console.log(coba);
             if (coba.length > 0) {

               //
               $("#tabel_plotting").empty();
               $("#id_plot").empty();

               var y = 0;
               var cobaah = "";
               var id_plot = "";


               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Plotting E-Banking Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<h6><b>Data yang ditampilkan merupakan data yang telah di plotting dan akan dilakukan perubahan tanggal plotting.</b></h6>";

               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Channel</b></td>";
               cobaah += "<td><b>Transaksi</b></td>";
               cobaah += "<td><b>System</b></td>";
               cobaah += "<td><b>Provider</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Transaksi Ke- </b></td>";
               cobaah += "<td><b>Tanggal Evaluasi </b></td>";



               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               for (var i = 0; i < coba.length; i++) {

                 // ​console.log(matches[1]);​

                 cobaah += "<tr >";
                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['nama_project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['channel'] != null) {
                   cobaah += "<td>" + coba[i]['channel'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_transaksi'] != null) {
                   cobaah += "<td>" + coba[i]['nama_transaksi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['os'] != null) {
                   cobaah += "<td>" + coba[i]['os'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['provider'] != null) {
                   cobaah += "<td>" + coba[i]['provider'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['tanggal_evaluasi'] != null) {
                   cobaah += "<td>" + coba[i]['tanggal_evaluasi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }



                 cobaah += "</tr>";

                 id_plot += "<input type='hidden' name='id_plot[]' value='" + coba[i]['num'] + "'>";

               }

               cobaah += "</tbody>";
               cobaah += "</table>";

               cobaah += "</div>";
               cobaah += "<div class='row'>";
               cobaah += "<div class='col-sm-2'><label><b>Pilih Tanggal :</b></label></div>";
               cobaah += "<div class='col-sm-2'><input type='date' class='form-control' name='tgl_plot' required></div>";
               // cobaah =+ "<div class='col-sm-2'><button type='button' class='btn btn-primary'>Plotting</button></div>";
               cobaah += "</div>";



               // cobaah += "</tr>";

               $("#tabel_plotting").append(cobaah);
               $("#id_plot").append(id_plot);

               document.getElementById('btn_update_plot').style.display = 'block';

             } else {
               $("#tabel_plotting").empty();
               $("#id_plot").empty();

               swal("Data Tidak Tersedia di Skenario!", "Periksa Kembali Filtering Anda!", "error");
             }
             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }
           }

         })


       });

   $(document).ready(function(){
    $('#show_plotsosmed').click(function(){
      console.log('CEK');
      var id_project = $('#plotting_project').val();
         var bank = $('#plotting_bank').val();
         var platform = $('#plotting_platform').val();
         var skenario = $('#plotting_skenario').val();
         var hari = $('#plotting_hari').val();
         var waktu = $('#plotting_waktu').val();
         var trx = $('#plotting_trx2').val();


         console.log(id_project);
         console.log(bank);
         console.log(platform);
         console.log(skenario);
          console.log(hari);
         console.log(waktu);
         console.log(trx);


         document.getElementById('btn_update_plot').style.display = 'none';


         $.ajax({
           url: "<?php echo base_url('aktual/getplotsosmed') ?>",
           method: "POST",
           data: {
             id_project: id_project,
             bank: bank,
             platform: platform,
             skenario: skenario,
             hari: hari,
             waktu: waktu,
             trx: trx

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             // console.log(coba);
             if (coba.length > 0) {

               //
               $("#tabel_plotting").empty();
               $("#id_plot").empty();

               var y = 0;
               var cobaah = "";
               var id_plot = "";


               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Plotting Evaluasi Sosial Media Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<h6><b>Data yang ditampilkan merupakan data yang belum melalui proses plotting atau tanggal plotting sudah terlewat</b></h6>";

               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Platform</b></td>";
               cobaah += "<td><b>Skenario</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Evaluasi Ke- </b></td>";


               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               for (var i = 0; i < coba.length; i++) {

                 // ​console.log(matches[1]);​

                 cobaah += "<tr >";
                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['nama_project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['platform'] != null) {
                   cobaah += "<td>" + coba[i]['platform'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_skenario'] != null) {
                   cobaah += "<td>" + coba[i]['nama_skenario'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }



                 cobaah += "</tr>";

                 id_plot += "<input type='hidden' name='id_plot[]' value='" + coba[i]['num'] + "'>";

               }

               cobaah += "</tbody>";
               cobaah += "</table>";

               cobaah += "</div>";
               cobaah += "<div class='row'>";
               cobaah += "<div class='col-sm-2'><label><b>Pilih Tanggal :</b></label></div>";
               cobaah += "<div class='col-sm-2'><input type='date' class='form-control' name='tgl_plot' required></div>";
               // cobaah =+ "<div class='col-sm-2'><button type='button' class='btn btn-primary'>Plotting</button></div>";
               cobaah += "</div>";



               // cobaah += "</tr>";

               $("#tabel_plotting").append(cobaah);
               $("#id_plot").append(id_plot);

               document.getElementById('btn_plot').style.display = 'block';

             } else {
               $("#tabel_plotting").empty();
               $("#id_plot").empty();

               swal("Data Tidak Tersedia di Skenario!", "Periksa Kembali Filtering Anda!", "error");
             }
             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }
           }

         })
    });


   $('#update_plotsosmed').click(function(){
      console.log('CEK');
      var id_project = $('#plotting_project').val();
         var bank = $('#plotting_bank').val();
         var platform = $('#plotting_platform').val();
         var skenario = $('#plotting_skenario').val();
         var hari = $('#plotting_hari').val();
         var waktu = $('#plotting_waktu').val();
         var trx = $('#plotting_trx2').val();


         console.log(id_project);
         console.log(bank);
         console.log(platform);
         console.log(skenario);
          console.log(hari);
         console.log(waktu);
         console.log(trx);


         document.getElementById('btn_plot').style.display = 'none';
         

         $.ajax({
           url: "<?php echo base_url('aktual/getupdate_plotsosmed') ?>",
           method: "POST",
           data: {
             id_project: id_project,
             bank: bank,
             platform: platform,
             skenario: skenario,
             hari: hari,
             waktu: waktu,
             trx: trx

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             // console.log(coba);
             if (coba.length > 0) {

               //
               $("#tabel_plotting").empty();
               $("#id_plot").empty();

               var y = 0;
               var cobaah = "";
               var id_plot = "";


               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Plotting Evaluasi Sosial Media Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<h6><b>Data yang ditampilkan merupakan data yang belum melalui proses plotting atau tanggal plotting sudah terlewat</b></h6>";

               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Platform</b></td>";
               cobaah += "<td><b>Skenario</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Evaluasi Ke- </b></td>";
               cobaah += "<td><b>Tanggal Evaluasi </b></td>";



               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               for (var i = 0; i < coba.length; i++) {

                 // ​console.log(matches[1]);​

                 cobaah += "<tr >";
                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['nama_project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['platform'] != null) {
                   cobaah += "<td>" + coba[i]['platform'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_skenario'] != null) {
                   cobaah += "<td>" + coba[i]['nama_skenario'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['tanggal_evaluasi'] != null) {
                   cobaah += "<td>" + coba[i]['tanggal_evaluasi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }



                 cobaah += "</tr>";

                 id_plot += "<input type='hidden' name='id_plot[]' value='" + coba[i]['num'] + "'>";

               }

               cobaah += "</tbody>";
               cobaah += "</table>";

               cobaah += "</div>";
               cobaah += "<div class='row'>";
               cobaah += "<div class='col-sm-2'><label><b>Pilih Tanggal :</b></label></div>";
               cobaah += "<div class='col-sm-2'><input type='date' class='form-control' name='tgl_plot' required></div>";
               // cobaah =+ "<div class='col-sm-2'><button type='button' class='btn btn-primary'>Plotting</button></div>";
               cobaah += "</div>";



               // cobaah += "</tr>";

               $("#tabel_plotting").append(cobaah);
               $("#id_plot").append(id_plot);

               document.getElementById('btn_update_plot').style.display = 'block';

             } else {
               $("#tabel_plotting").empty();
               $("#id_plot").empty();

               swal("Data Tidak Tersedia di Skenario!", "Periksa Kembali Filtering Anda!", "error");
             }
             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }
           }

         })
    });


   $('#plotting_trx99').change(function(){
      console.log('CEK');
      var id_project = $('#plotting_project99').val();
         var bank = $('#plotting_bank99').val();
         var platform = $('#plotting_platform99').val();
         var skenario = $('#plotting_skenario99').val();
         var hari = $('#plotting_hari99').val();
         var waktu = $('#plotting_waktu99').val();
         var trx = $(this).val();


         console.log(id_project);
         console.log(bank);
         console.log(platform);
         console.log(skenario);
          console.log(hari);
         console.log(waktu);
         console.log(trx);



         $.ajax({
           url: "<?php echo base_url('aktual/getplotsosmed99') ?>",
           method: "POST",
           data: {
             id_project: id_project,
             bank: bank,
             platform: platform,
             skenario: skenario,
             hari: hari,
             waktu: waktu,
             trx: trx

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             // console.log(coba);
             if (coba.length > 0) {

               //
               $("#venue").empty();
               $("#id_plot").empty();

               var y = 0;
               var cobaah = "";
               var id_plot = "";


               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Plotting Evaluasi Sosial Media Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               // cobaah += "<h6><b>Data yang ditampilkan merupakan data yang belum melalui proses plotting atau tanggal plotting sudah terlewat</b></h6>";

               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-responsive-sm' id='dataTables-example'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Bank</b></td>";
               cobaah += "<td><b>Platform</b></td>";
               cobaah += "<td><b>Skenario</b></td>";
               cobaah += "<td><b>Waktu</b></td>";
               cobaah += "<td><b>Evaluasi Ke- </b></td>";
               cobaah += "<td><b>Tanggal Evaluasi </b></td>";


               // cobaah += "<td><b>Bukti Transaksi</b></td>";

               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 
               for (var i = 0; i < coba.length; i++) {

                 // ​console.log(matches[1]);​

                 cobaah += "<tr >";
                 cobaah += "<td><b>" + (i + 1) + "</b></td>";

                 if (coba[i]['nama_project'] != null) {
                   cobaah += "<td>" + coba[i]['nama_project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_bank'] != null) {
                   cobaah += "<td>" + coba[i]['nama_bank'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['platform'] != null) {
                   cobaah += "<td>" + coba[i]['platform'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['nama_skenario'] != null) {
                   cobaah += "<td>" + coba[i]['nama_skenario'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 
                 if (coba[i]['hari'] != null || coba[i]['waktu'] != null) {
                   cobaah += "<td>" + coba[i]['hari'] + " - " + coba[i]['waktu'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['trx_ke'] != null) {
                   cobaah += "<td>" + coba[i]['trx_ke'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['tanggal_evaluasi'] != null) {
                   cobaah += "<td>" + coba[i]['tanggal_evaluasi'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }



                 cobaah += "</tr>";

                 id_plot += "<input type='hidden' name='id_plot[]' value='" + coba[i]['num'] + "'>";

               }

               cobaah += "</tbody>";
               cobaah += "</table>";

               cobaah += "</div>";
               cobaah += "<div class='row'>";
               cobaah += "<div class='col-sm-2'><label><b>Pilih Tanggal :</b></label></div>";
               cobaah += "<div class='col-sm-5'><input type='date' class='form-control' name='tgl_plot' required></div>";
               // cobaah =+ "<div class='col-sm-2'><button type='button' class='btn btn-primary'>Plotting</button></div>";
               cobaah += "</div>";



               // cobaah += "</tr>";

               $("#venue").append(cobaah);
               $("#id_plot99").append(id_plot);

               document.getElementById('btn_plot99').style.display = 'block';

             } else {
               $("#venue").empty();
               $("#id_plot99").empty();

               swal("Data Tidak Tersedia di Skenario!", "Periksa Kembali Filtering Anda!", "error");
             }
             if (document.getElementById('dataTables-example')) {

               $('#dataTables-example').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": true,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": true
               });
             }
           }

         })
    });
   });

       $(document).ready(function() {
         $('#show_cabang').click(function() {
           var id_project = $('#project_nonatm').val();

           var transport_cbg = document.getElementById('transport_cabang');
           var provinsi_cbg = document.getElementById('provinsi_cabang');
           var kodepos_cbg = document.getElementById('kodepos_cabang');
           var fax_cbg = document.getElementById('fax_cabang');
           var telp_cbg = document.getElementById('telp_cabang');
           var aksi_cbg = document.getElementById('aksi_cabang');

           var base = window.location.origin + "/";
           var host = base + window.location.pathname.split('/')[1];

           $.ajax({
             url: "<?php echo base_url('stkb/getcabang_nonatm') ?>",
             method: "POST",
             data: {
               id_project: id_project

             },
             async: false,
             dataType: 'json',
             success: function(coba) {
               console.log(coba);
               if (coba.length > 0) {

                 //
                 $("#tabel_cabangnonatm").empty();
                 var y = 0;
                 var cobaah = "";




                 // TAMBAHAN SOMA



                 cobaah += "<p class='text-danger'>** Wilayah Jakarta Meliputi (Jakarta, Bekasi, Bogor, Tangerang, Depok, Sukabumi, Serang, Cilegon, Cibubur, Cibinong, Cianjur, Ciputat)</p>";
                 cobaah += "<p class='text-danger'>** Diluar Wilayah tersebut masuk kedalam kategori Luar Kota</p>";
                 cobaah += "<div class='form-group'>";
                 cobaah += "<h4><b>Daftar Cabang Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
                 cobaah += "<div class='table-responsive'>";
                 cobaah += "<table class='table table-bordered table-striped table-condensed table-responsive-sm' id='dataTables-example'>";
                 cobaah += " <thead>";
                 cobaah += "<tr bgcolor='#e3f3fc' class='py-2'> ";
                 cobaah += "<td><b>No</b></td>";
                 cobaah += "<td><b>Project</b></td>";
                 cobaah += "<td><b>Kode</b></td>";
                 cobaah += "<td><b>Nama</b></td>";
                 cobaah += "<td><b>Alamat</b></td>";
                 cobaah += "<td><b>Kota</b></td>";
                 if (provinsi_cbg.checked) {
                   cobaah += "<td><b>Provinsi</b></td>";
                 }
                 if (kodepos_cbg.checked) {
                   cobaah += "<td><b>Kode Pos</b></td>";
                 }
                 if (telp_cbg.checked) {
                   cobaah += "<td><b>Telepon</b></td>";
                 }
                 if (fax_cbg.checked) {
                   cobaah += "<td><b>Fax</b></td>";
                 }
                 if (transport_cbg.checked) {
                   cobaah += "<td><b>Transport & Transport Jauh</b></td>";
                 }
                 if (aksi_cbg.checked) {
                   cobaah += "<td><b>Aksi</b></td>";
                 }



                 cobaah += "</tr>";
                 cobaah += "</thead>";
                 cobaah += "<tbody>";

                 // cobaah += "<tr>"; 

                 for (var i = 0; i < coba.length; i++) {
                   cobaah += "<tr>";

                   cobaah += "<td><b>" + (i + 1) + "</b></td>";

                   if (coba[i]['project'] != null) {
                     cobaah += "<td>" + coba[i]['project'] + "</td>";
                   } else {
                     cobaah += "<td></td>";
                   }
                   if (coba[i]['kode_cabang'] != null) {
                     cobaah += "<td>" + coba[i]['kode_cabang'] + "</td>";
                   } else {
                     cobaah += "<td></td>";
                   }
                   if (coba[i]['nama_cabang'] != null) {
                     cobaah += "<td>" + coba[i]['nama_cabang'] + "</td>";
                   } else {
                     cobaah += "<td></td>";
                   }
                   if (coba[i]['alamat'] != null) {
                     cobaah += "<td>" + coba[i]['alamat'] + "</td>";
                   } else {
                     cobaah += "<td></td>";
                   }
                   if (coba[i]['kota'] != null) {
                     cobaah += "<td>" + coba[i]['kota'] + "</td>";
                   } else {
                     cobaah += "<td></td>";
                   }
                   if (provinsi_cbg.checked) {
                     if (coba[i]['provinsi'] != null) {
                       cobaah += "<td>" + coba[i]['provinsi'] + "</td>";
                     } else {
                       cobaah += "<td></td>";
                     }
                   }
                   if (kodepos_cbg.checked) {
                     if (coba[i]['kodepos'] != null) {
                       cobaah += "<td>" + coba[i]['kodepos'] + "</td>";
                     } else {
                       cobaah += "<td></td>";
                     }
                   }
                   if (telp_cbg.checked) {
                     if (coba[i]['notelpon'] != null) {
                       cobaah += "<td>" + coba[i]['notelpon'] + "</td>";
                     } else {
                       cobaah += "<td></td>";
                     }
                   }
                   if (fax_cbg.checked) {
                     if (coba[i]['fax'] != null) {
                       cobaah += "<td>" + coba[i]['fax'] + "</td>";
                     } else {
                       cobaah += "<td></td>";
                     }
                   }

                   if (transport_cbg.checked) {
                     if (coba[i]['transport'] != null || coba[i]['transport_jauh'] != null) {
                       if (coba[i]['transport'] == null) {
                         var transport = 0
                       } else {
                         var transport = coba[i]['transport']
                       }
                       if (coba[i]['transport_jauh'] == null) {
                         var transport_jauh = 0
                       } else {
                         var transport_jauh = coba[i]['transport_jauh']
                       }

                       cobaah += "<td>" + "Rp. " + transport + " + Rp. " + transport_jauh + " (" + coba[i]['daerah'] + ")" + "</td>";
                     } else {
                       cobaah += "<td></td>";
                     }
                   }

                   if (aksi_cbg.checked) {
                     if (coba[i]['status'] == null) {
                       cobaah += "<td><a href='#' type='button' class='edit_field' title='Edit' data-toggle='modal' data-target='#editcabangnon' data-id='" + coba[i]['num'] + "'><i class='fas fa-edit'></i></a>";
                       cobaah += "<a href='" + host + "/cabang/hapus_cabang/" + coba[i]['num'] + "' title='Delete' class='tombol-hapus' onclick='return confirm(`Apakah Anda yakin ingin hapus cabang?`)'><i class='fas fa-trash'></i></a></td>";
                     } else {
                       cobaah += "<td></td>";
                     }
                   }


                   cobaah += "</tr>";

                 }
                 // cobaah += "</tr>";

                 cobaah += "</tbody>";
                 cobaah += "</table>";
                 cobaah += "</div>";
                 cobaah += "</div>";







                 $("#tabel_cabangnonatm").append(cobaah);
               } else {
                 $("#tabel_cabangnonatm").empty();
                 swal("Belum Ada Data!", "", "error");
               }
               if (document.getElementById('dataTables-example')) {

                 $('#dataTables-example').DataTable({
                   "responsive": true,
                   "searching": true,
                   "ordering": true,
                   "info": false,
                   "scrollY": "",
                   "scrollCollapse": true,
                   "paging": false
                 });
               }
             }

           })
         });
         $("#tabel_cabangnonatm").on("click", ".edit_field", function(e) { //user click on remove text
           var num = $(this).data('id');
           var base = window.location.origin + "/";
           var host = base + window.location.pathname.split('/')[1];
           console.log(base);
           console.log(host);

           $('#bank_kd').empty();

           $.ajax({
             url: "<?php echo base_url('cabang/getcabang_edit') ?>",
             method: "POST",
             data: {
               num: num

             },
             async: false,
             dataType: 'json',
             success: function(coba) {
               var ht = '';
               console.log(coba);
               $('#edit_num').val(coba['num']);
               $('#edit_project').val(coba['nama_project']);
               $('#edit_bank').val(coba['nama_bank']);
               $('#edit_kode').val(coba['kode']);
               $('#edit_nama').val(coba['nama']);
               $('#edit_alamat').val(coba['alamat']);
               $('#edit_kota').val(coba['kota']);
               $('#edit_provinsi').val(coba['provinsi']);
               $('#edit_kodepos').val(coba['kodepos']);
               $('#edit_notelpon').val(coba['notelpon']);
               $('#edit_fax').val(coba['fax']);

               $("input[name='bank_id']").each(function() {
                 var kat = $(this).val().split('**');
                 if (coba['kodebank'] == kat[0]) {
                   ht += `<option value="` + kat[0] + `" selected>` + kat[1] + `</option>`;
                 } else {
                   ht += `<option value="` + kat[0] + `">` + kat[1] + `</option>`;
                 }
               });
               $('#bank_kd').append(ht);


             }
           });

         });
       });


       $('#show_atm').click(function() {
         var id_project = $('#project_atmcenter').val();

           var aksi_atm = document.getElementById('aksi_atm');

           var base = window.location.origin + "/";
           var host = base + window.location.pathname.split('/')[1];

         $.ajax({
           url: "<?php echo base_url('stkb/getcabang_atmcenter') ?>",
           method: "POST",
           data: {
             id_project: id_project

           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             if (coba.length > 0) {
               //
               $("#tabel_cabangatmcenter").empty();
               var y = 0;
               var cobaah = "";




               // TAMBAHAN SOMA
               cobaah += "<div class='form-group'>";
               cobaah += "<h4><b>Daftar Cabang ATM Center Untuk Project " + coba[0]['nama_project'] + " (" + coba[0]['project'] + ")" + "</b></h4>";
               cobaah += "<div class='table-responsive'>";
               cobaah += "<table class='table table-bordered table-striped table-condensed table-responsive-sm' id='dataTables-example-2'>";
               cobaah += " <thead>";
               cobaah += "<tr bgcolor='#e3f3fc'>";
               cobaah += "<td><b>No</b></td>";
               cobaah += "<td><b>Project</b></td>";
               cobaah += "<td><b>Kode</b></td>";
               cobaah += "<td><b>Nama</b></td>";
               cobaah += "<td><b>Alamat</b></td>";
               cobaah += "<td><b>Kota</b></td>";
               // cobaah += "<td><b>Transport & Transport Jauh</b></td>";
               if (aksi_atm.checked) {
                   cobaah += "<td><b>Aksi</b></td>";
                 }




               cobaah += "</tr>";
               cobaah += "</thead>";
               cobaah += "<tbody>";

               // cobaah += "<tr>"; 

               for (var i = 0; i < coba.length; i++) {
                 cobaah += "<tr>";

                 cobaah += "<td><b>" + (i + 1) + "</b></td>";
                 if (coba[i]['project'] != null) {
                   cobaah += "<td>" + coba[i]['project'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['kode_cabang'] != null) {
                   cobaah += "<td>" + coba[i]['kode_cabang'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['namacabang'] != null) {
                   cobaah += "<td>" + coba[i]['namacabang'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['alamat'] != null) {
                   cobaah += "<td>" + coba[i]['alamat'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (coba[i]['kota'] != null) {
                   cobaah += "<td>" + coba[i]['kota'] + "</td>";
                 } else {
                   cobaah += "<td></td>";
                 }
                 if (aksi_atm.checked) {
                     if (coba[i]['weekend_siang'] == null && coba[i]['weekend_malam'] == null && coba[i]['weekday_siang'] == null && coba[i]['weekday_malam'] == null) {
                       cobaah += "<td><a href='#' type='button' class='edit_field_atm' title='Edit' data-toggle='modal' data-target='#editcabangatm' data-id='" + coba[i]['num'] + "'><i class='fas fa-edit'></i></a>";
                       cobaah += "<a href='" + host + "/cabang/hapus_atm/" + coba[i]['num'] + "' title='Delete' class='tombol-hapus' onclick='return confirm(`Apakah Anda yakin ingin hapus cabang?`)'><i class='fas fa-trash'></i></a></td>";
                     } else {
                       cobaah += "<td></td>";
                     }
                   }


                 // if (coba[i]['transport'] != null || coba[i]['transport_jauh'] != null) {
                 //   if (coba[i]['transport'] == null) {
                 //     var transport = 0
                 //   } else {
                 //     var transport = coba[i]['transport']
                 //   }
                 //   if (coba[i]['transport_jauh'] == null) {
                 //     var transport_jauh = 0
                 //   } else {
                 //     var transport_jauh = coba[i]['transport_jauh']
                 //   }

                 //   cobaah += "<td>" + "Rp. " + transport + " + Rp. " + transport_jauh + " (" + coba[i]['daerah'] + ")" + "</td>";
                 // } else {
                 //   cobaah += "<td></td>";
                 // }

                 cobaah += "</tr>";

               }
               // cobaah += "</tr>";

               cobaah += "</tbody>";
               cobaah += "</table>";
               cobaah += "</div>";
               cobaah += "</div>";


               $("#tabel_cabangatmcenter").append(cobaah);
             } else {
               $("#tabel_cabangatmcenter").empty();
               swal("Belum Ada Data!", "", "error");
             }
             if (document.getElementById('dataTables-example-2')) {

               $('#dataTables-example-2').DataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": false,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": false
               });
             }
           }



         })
       });

   $("#tabel_cabangatmcenter").on("click", ".edit_field_atm", function(e) { //user click on remove text
           var num = $(this).data('id');
           var base = window.location.origin + "/";
           var host = base + window.location.pathname.split('/')[1];
           console.log(base);
           console.log(host);
           console.log(num);
           

           $('#bank_kd_atm').empty();

           $.ajax({
             url: "<?php echo base_url('cabang/getcabangatm_edit') ?>",
             method: "POST",
             data: {
               num: num

             },
             async: false,
             dataType: 'json',
             success: function(coba) {
               var ht = '';
               console.log(coba);
               $('#edit_num_atm').val(coba['num']);
               $('#edit_project_atm').val(coba['nama_project']);
               $('#edit_bank_atm').val(coba['nama_bank']);
               $('#edit_kode_atm').val(coba['cabang']);
               $('#edit_nama_atm').val(coba['namacabang']);
               $('#edit_alamat_atm').val(coba['alamat']);
               $('#edit_kota_atm').val(coba['kota']);
               
               $("input[name='bank_id']").each(function() {
                 var kat = $(this).val().split('**');
                 if (coba['kodebank'] == kat[0]) {
                   ht += `<option value="` + kat[0] + `" selected>` + kat[1] + `</option>`;
                 } else {
                   ht += `<option value="` + kat[0] + `">` + kat[1] + `</option>`;
                 }
               });
               $('#bank_kd_atm').append(ht);


             }
           });

         });




       $('#kode_pjk_xls1').change(function() {
         $("#disini_uploadbank").empty();

         var pjk_xls1 = $(this).val();

         var html = '';

         html += `<div class="form-group">`;
         html += `<label>Upload File</label>`;
         html += `<input type="file" name="csv_cabang" class="form-control" required accept=".xls, .xlsx">`;
         html += `<span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Upload(.xls/.xlsx)`;
         html += `</div>`;



         if (pjk_xls1 != null || pjk_xls1 != "") {
           $("#disini_uploadbank").append(html);
           document.getElementById('formatbank').style.display = "block";
         } else {
           $("#disini_uploadbank").empty();
         }

       });

       $('#kode_pjk_xls2').change(function() {
         $("#disini_uploadatm").empty();

         var pjk_xls2 = $(this).val();

         var html = '';

         html += `<div class="form-group">`;
         html += `<label>Upload File</label>`;
         html += `<input type="file" name="csv_atm" class="form-control" required accept=".xls, .xlsx">`;
         html += `<span class="bg-info p-1">NOTE!</span>&nbsp;&nbsp;Format Upload(.xls/.xlsx)`;
         html += `</div>`;



         if (pjk_xls2 != null || pjk_xls2 != "") {
           $("#disini_uploadatm").append(html);
           document.getElementById('formatatm').style.display = "block";
         } else {
           $("#disini_uploadatm").empty();
         }

       });






       $('#kotadari').change(function() {

         var kotdari = $(this).val();
         var kotdinas = document.getElementById("kotadinas").value;


         var jakartalist = ["JAKARTA", "JAKARTA TIMUR", "JAKARTA SELATAN", "JAKARTA BARAT", "JAKARTA UTARA", "JAKARTA PUSAT", "TANGERANG", "TANGERANG SELATAN", "BEKASI", "BOGOR", "DEPOK", "SUKABUMI", "SERANG", "CILEGON", "CIBUBUR", "CIBINONG", "CIPUTAT", "KARAWANG", "JABODETABEK"];

         var cekdari = jQuery.inArray(kotdari, jakartalist);
         var cekdinas = jQuery.inArray(kotdinas, jakartalist);


           if (cekdari >= 0 && cekdinas >= 0) {
             document.getElementById("penugasan").value = "Setempat";
           } else if (kotdari == kotdinas) {
             document.getElementById("penugasan").value = "Setempat";
           } else {
             document.getElementById("penugasan").value = "Dinas";
           }

         

       });

       $('#namapic').change(function() {
         var id = $(this).val();
         $('#kotadari').attr('disabled', false);
         $('#kotadinas').attr('disabled', false);
         $.ajax({
           url: "<?php echo base_url('stkb/getkotabyidpic') ?>",
           method: "POST",
           data: {
             id: id
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             // if (hasil['kota_penugasan'] != null || hasil['kota_penugasan'] != ""){
             //  //  $('select[name=kotadari]').val(hasil['kota_penugasan']);
             //  // $('#kotadari').selectpicker('refresh');
             //  // $('#kotadari').attr('disabled', true);
             //  $('#kotadari').empty();

             //   var selectop = "";
             //   selectop += "<option value='"+ hasil['kota_asal'] +"' selected> "+ hasil['kota_asal'] +" </option>";
             //   selectop += "<option value='"+ hasil['kota_penugasan'] +"'> "+ hasil['kota_penugasan'] +" </option>"; 

             //   $("#kotadari").append(selectop);
             //   $('#kotadari').selectpicker('refresh');

             // } else {
             $('select[name=kotadari]').val(hasil['kota_asal']);
             $('#kotadari').selectpicker('refresh');
             $('#kotadari').attr('disabled', true);
             // }

             var dinas = $('#kotated').val();
             //$("#kotadinas").empty();
             var optKotaDinas = "<option value='" + dinas.toUpperCase() + "'>" + dinas.toUpperCase() + "</option>";
             $("#kotadinas").append(optKotaDinas);
             $('#kotadinas').selectpicker('refresh');
             var kotdinas = $('select[name=kotadinas]').val(dinas.toUpperCase());
             $('#kotadinas').selectpicker('refresh');
             $('#kotadinas').attr('disabled', true);


             var kotdari = document.getElementById("kotadari").value;
             var kotdinas = document.getElementById("kotadinas").value;

             var projected = $('#projectted option:selected').text();

             var jakartalist = ["JAKARTA", "JAKARTA TIMUR", "JAKARTA SELATAN", "JAKARTA BARAT", "JAKARTA UTARA", "JAKARTA PUSAT", "TANGERANG", "TANGERANG SELATAN", "BEKASI", "BOGOR", "DEPOK", "SUKABUMI", "SERANG", "CILEGON", "CIBUBUR", "CIBINONG", "CIPUTAT", "KARAWANG", "JABODETABEK"];

             var cekdari = jQuery.inArray(kotdari, jakartalist);
             var cekdinas = jQuery.inArray(kotdinas, jakartalist);


             if (cekdari >= 0 && cekdinas >= 0) {
               document.getElementById("penugasan").value = "Setempat";
             } else if (kotdari == kotdinas) {
               document.getElementById("penugasan").value = "Setempat";
             } else {
               document.getElementById("penugasan").value = "Dinas";
             }

             $('#picku').text(hasil['nama']);
             $('#kotadinasku').text(kotdinas);
             $('#projectku').text(projected);


           }
         });
       });

       $('#namafo').change(function() {
         var id = $(this).val();
         console.log('namafo' + id);
         $('#kotadari').attr('disabled', false);
         $('#kotadinas').attr('disabled', false);
            
        var type_pjk = document.getElementById("type_pjk").value;


         $.ajax({
           url: "<?php echo base_url('stkb/getkotabyidfo') ?>",
           method: "POST",
           data: {
             id: id
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log(id);
             console.log(hasil['kota_asal']);
             // if (hasil['kota_penugasan'] != null || hasil['kota_penugasan'] != ""){
             //  //  $('select[name=kotadari]').val(hasil['kota_penugasan']);
             //  // $('#kotadari').selectpicker('refresh');
             //  // $('#kotadari').attr('disabled', true);
             //  $('#kotadari').empty();

             //   var selectop = "";
             //   selectop += "<option value='"+ hasil['kota_asal'] +"' selected> "+ hasil['kota_asal'] +" </option>";
             //   selectop += "<option value='"+ hasil['kota_penugasan'] +"'> "+ hasil['kota_penugasan'] +" </option>"; 

             //   $("#kotadari").append(selectop);
             //   $('#kotadari').selectpicker('refresh');

             // } else {
             $('select[name=kotadari]').val(hasil['kota_asal'].toUpperCase());
             $('#kotadari').selectpicker('refresh');
             $('#kotadari').attr('disabled', true);
             // }

             var dinas = $('#kotated_2021').val();
             //$("#kotadinas").empty();
             var optKotaDinas = "<option value='" + dinas.toUpperCase() + "'>" + dinas.toUpperCase() + "</option>";
             $("#kotadinas").append(optKotaDinas);
             $('#kotadinas').selectpicker('refresh');
             var kotdinas = $('select[name=kotadinas]').val(dinas.toUpperCase());
             $('#kotadinas').selectpicker('refresh');
             $('#kotadinas').attr('disabled', true);


             var kotdari = document.getElementById("kotadari").value;
             var kotdinas = document.getElementById("kotadinas").value;



             var projected = $('#projectted option:selected').text();

             var jakartalist = ["JAKARTA", "JAKARTA TIMUR", "JAKARTA SELATAN", "JAKARTA BARAT", "JAKARTA UTARA", "JAKARTA PUSAT", "TANGERANG", "TANGERANG SELATAN", "BEKASI", "BOGOR", "DEPOK", "SUKABUMI", "SERANG", "CILEGON", "CIBUBUR", "CIBINONG", "CIPUTAT", "KARAWANG", "JABODETABEK"];

             var cekdari = jQuery.inArray(kotdari, jakartalist);
             var cekdinas = jQuery.inArray(kotdinas, jakartalist);

             console.log(type_pjk);

              if(type_pjk == 'n') {
                 if (cekdari >= 0 && cekdinas >= 0) {
                   document.getElementById("penugasan").value = "Setempat";
                 } else if (kotdari == kotdinas) {
                   document.getElementById("penugasan").value = "Setempat";
                 } else {
                   document.getElementById("penugasan").value = "Dinas";
                 }
              }

             $('#picku').text(hasil['nama']);
             $('#kotadinasku').text(kotdinas);
             $('#projectku').text(projected);


           }
         });
       });

       $('#kotated').change(function() {
         var id = $("#projectted").val(),
           kota = $("#kotated").val();
         ambilsdmbykotapulau(kota);
         console.log(id + " --> " + kota);
         $.ajax({
           url: "<?php echo base_url('stkb/getdaftarcabang') ?>",
           method: "POST",
           data: {
             id: id,
             kota: kota
           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             if (coba.length > 0) {
               console.log(coba);
               // CLEAR VALUE DI VIEW MASTERPLAN
               // $("#valStateBackup").val(0);
               // var setBackurek = $("#valStateBackup").val();
               // if (setBackurek == 0) {
               //   $("#checkBackup").hide();
               //   $("#valBackup").val(0);
               //   $("#valBackup").attr('max', 0);
               // } 

               //MENGISI VALUE BACKUP OTOMATIS
               //JIKA KOTA DILUAR JABODETABEK DAN CABANGNYA ADA 1 atau 2 MAKA BACKUP VALUE NYA 1

               var jakartalist = ["Jakarta", "Jakarta Timur", "Jakarta Selatan", "Jakarta Barat", "Jakarta Utara", "Jakarta Pusat", "Tangerang", "Tangerang Selatan", "Bekasi", "Bogor", "Depok", "Sukabumi", "Serang", "Cilegon", "Cibubur", "Cibinong", "Ciputat", "Karawang", "Jabodetabek"];
               var cekkota = jQuery.inArray(kota, jakartalist);


               var jumcabang = coba.length;
               if (cekkota >= 0) {
                 document.getElementById("valBackup2").value = '0';
               } else if (cekkota == -1 && jumcabang == 1 || jumcabang == 2) {
                 document.getElementById("valBackup2").value = '1';
               } else {
                 document.getElementById("valBackup2").value = '0';
               }
               // if(kota == 'Jakarta' || kota == 'Bogor' || kota == 'Depok' || kota == 'Tangerang' || kota == 'Bekasi'){
               //    document.getElementById("valBackup2").value='0';
               // } else if(kota != 'Jakarta' || kota != 'Bogor' || kota != 'Depok' || kota != 'Tangerang' || kota != 'Bekasi' && jumcabang == 1 || jumcabang == 2) {
               //     document.getElementById("valBackup2").value='1';
               // } else {
               //    document.getElementById("valBackup2").value='0';
               // }
               //
               $("#showCheckAll").show();
               $("#tampilancabang").empty();
               var y = 0;
               var cobaah = "";
               var elem = document.getElementById('tampilanbackup');
               for (var i = 0; i < coba.length; i++) {
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
                 cobaah += "<input type='hidden' name='cabang" + i + "' value='" + coba[i]['kocab'] + "'>";
                 cobaah += "<input type='text' class='form-control' placeholder='" + coba[i]['kocab'] + " - " + coba[i]['nacab'] + "' readonly>";
                 cobaah += "</div>";
                 var result, resul2;
                 result = coba[i]['skennya'].split(",");
                 //console.log("==================");
                 //console.log(result);
                 resul2 = coba[i]['namasken'].split(",");
                 //console.log("==================");
                 //console.log(resul2);
                 cobaah += "<input type='hidden' id='ceklist" + i + "' value='0'>";
                 for (var o = 0; o < result.length; o++) {
                   cobaah += "<div class='col-sm-1'>"
                   cobaah += "<div class='form-group'>";
                   cobaah += "<div class='checkbox'>";
                   var idchk = result[o] + i;
                   var res2 = resul2[o].replace(/\s/g, '');
                   cobaah += "<label><input type='checkbox' id='" + res2 + idchk + "' class='checkBoxSkenario' onclick=\"checkBox('" + idchk + "','" + res2 + "')\" name='" + i + "kodesken[]' value='" + result[o] + "'>" + resul2[o] + "</label>";
                   cobaah += "</div>";
                   cobaah += "</div>";
                   cobaah += "</div>";
                   // AKHIR
                 }
                 cobaah += "</div>";
               }
               cobaah += `<input type="hidden" name="jumlahcabang" id="jumlahcabang" value="` + i + `">`;
               $("#tampilancabang").append(cobaah);

               elem.style.display = 'block';
             } else {
               Swal({
                 position: 'top',
                 type: 'error',
                 title: 'Data skenario untuk kota ' + kota + ' sudah di proses semua!',
                 showConfirmButton: false,
                 timer: 3000
               });
               $("#showCheckAll").hide();
               $("#tampilancabang").empty();
               $('input:checkbox[name^="kodesken"]').prop('checked', false);

               $('#kotadari').attr('disabled', false);
               $('select[name=kotadari]').val('Pilih Kota dari');
               $('#kotadari').selectpicker('refresh');
               $('#kotadinas').attr('disabled', false);
               $('select[name=kotadinas]').val('Pilih Kota dinas');
               $('#kotadinas').selectpicker('refresh');
             }

           }
           /*,
                 error: function (xhr, ajaxOptions, thrownError) {
                   alert(xhr.status);
                   alert(thrownError);

                 }*/
         })
       });


       $('#kotated_2021').change(function() {
         var id = $("#projectted_2021").val(),
           kota = $("#kotated_2021").val();
         ambilsdmbykotapulau_2021(kota);
         $.ajax({
           url: "<?php echo base_url('stkb/getdaftarcabang') ?>",
           method: "POST",
           data: {
             id: id,
             kota: kota
           },
           async: false,
           dataType: 'json',
           success: function(coba) {
             if (coba.length > 0) {
               console.log(coba);

               var jakartalist = ["Jakarta", "Jakarta Timur", "Jakarta Selatan", "Jakarta Barat", "Jakarta Utara", "Jakarta Pusat", "Tangerang", "Tangerang Selatan", "Bekasi", "Bogor", "Depok", "Sukabumi", "Serang", "Cilegon", "Cibubur", "Cibinong", "Ciputat", "Karawang", "Jabodetabek"];
               var cekkota = jQuery.inArray(kota, jakartalist);

               var jumcabang = coba.length;
               if (cekkota >= 0) {
                 document.getElementById("valBackup2").value = '0';
               } else if (cekkota == -1 && jumcabang == 1 || jumcabang == 2) {
                 document.getElementById("valBackup2").value = '1';
               } else {
                 document.getElementById("valBackup2").value = '0';
               }
               $("#showCheckAll").show();
               $("#tampilancabang").empty();
               var y = 0;
               var cobaah = "";
               var elem = document.getElementById('tampilanbackup');
               for (var i = 0; i < coba.length; i++) {
                 cobaah += "<div class='row'>"
                 cobaah += "<div class='col-sm-4'>"
                 cobaah += "<input type='hidden' name='cabang" + i + "' value='" + coba[i]['kocab'] + "'>";
                 cobaah += "<input type='text' class='form-control' placeholder='" + coba[i]['kocab'] + " - " + coba[i]['nacab'] + "' readonly>";
                 cobaah += "</div>";
                 var result, resul2;
                 result = coba[i]['skennya'].split(",");
                 resul2 = coba[i]['namasken'].split(",");
                 cobaah += "<input type='hidden' id='ceklist" + i + "' value='0'>";
                 for (var o = 0; o < result.length; o++) {
                   cobaah += "<div class='col-sm-1'>"
                   cobaah += "<div class='form-group'>";
                   cobaah += "<div class='checkbox'>";
                   var idchk = result[o] + i;
                   var res2 = resul2[o].replace(/\s/g, '');
                   cobaah += "<label><input type='checkbox' id='" + res2 + idchk + "' class='checkBoxSkenario' onclick=\"checkBox('" + idchk + "','" + res2 + "')\" name='" + i + "kodesken[]' value='" + result[o] + "'>" + resul2[o] + "</label>";
                   cobaah += "</div>";
                   cobaah += "</div>";
                   cobaah += "</div>";
                   // AKHIR
                 }
                 cobaah += "</div>";
               }
               cobaah += `<input type="hidden" name="jumlahcabang" id="jumlahcabang" value="` + i + `">`;
               $("#tampilancabang").append(cobaah);

               elem.style.display = 'block';
             } else {
               Swal({
                 position: 'top',
                 type: 'error',
                 title: 'Data skenario untuk kota ' + kota + ' sudah di proses semua!',
                 showConfirmButton: false,
                 timer: 3000
               });
               $("#showCheckAll").hide();
               $("#tampilancabang").empty();
               $('input:checkbox[name^="kodesken"]').prop('checked', false);

               $('#kotadari').attr('disabled', false);
               $('select[name=kotadari]').val('Pilih Kota dari');
               $('#kotadari').selectpicker('refresh');
               $('#kotadinas').attr('disabled', false);
               $('select[name=kotadinas]').val('Pilih Kota dinas');
               $('#kotadinas').selectpicker('refresh');
             }

           }
         })
       });

       //MEMBUAT JUMLAH BARIS ITINERARY OTOMATIS BERDASARKAN SELISIH TANGGAL PENUGASAN
       $('#tglpenugasan').change(function() {
         var tglmulai = $("input[name=planstart]").val(),
           tglselesai = $("input[name=planend]").val();

         $.ajax({
           url: "<?php echo base_url('stkb/getdataitinerary') ?>",
           method: "POST",
           data: {

           },
           async: false,
           dataType: 'json',
           success: function(coba) {

             //
             $("#tabel_itinerary").empty();
             var y = 0;
             var cobaah = "";

             // varibel miliday sebagai pembagi untuk menghasilkan hari
             var miliday = 24 * 60 * 60 * 1000;
             //buat object Date
             var tanggal1 = new Date(tglmulai);
             var tanggal2 = new Date(tglselesai);
             // Date.parse akan menghasilkan nilai bernilai integer dalam bentuk milisecond
             var tglPertama = Date.parse(tanggal1);
             var tglKedua = Date.parse(tanggal2);
             var selisih = ((tglKedua - tglPertama) / miliday) + 1;


             // TAMBAHAN SOMA
             cobaah += "<div class='form-group'>";
             cobaah += "<label for='user'>Itinerary</label>";
             cobaah += "<div class='table-responsive'>";
             cobaah += "<table class='table table-striped table-bordered table-hover table-condensed'>";
             cobaah += " <thead>";
             cobaah += "<tr bgcolor='#e3f3fc'>";
             cobaah += "<td><b>Hari</b></td>";
             for (var i = 0; i < coba.length; i++) {
               cobaah += " <td><b><center>" + coba[i]['keterangan'] + "</center></b></td>";
             }
             cobaah += "</tr>";
             cobaah += "</thead>";
             cobaah += "<tbody>";
             for (var z = 1; z <= selisih; z++) {
               cobaah += "<tr>";
               cobaah += "<td><b>Hari Ke " + z + "</b></td>";
               for (var i = 0; i < coba.length; i++) {
                 cobaah += "<td><center><input type='checkbox' class='form-check-input' name='" + z + "_" + coba[i]['no'] + "' value='" + coba[i]['no'] + "'><center></td>";
               }
               cobaah += "</tr>";
             }
             cobaah += "</tbody>";
             cobaah += "</table>";
             cobaah += "</div>";
             cobaah += "</div>";


             $("#tabel_itinerary").append(cobaah);
           }

         })
       });
       // TAMBAHAN ADAM SANTOSO
       $('#formmasterplan').submit(function() {
         var cek = masterplancekperdin();
         if (cek > 0 || $('#penugasan').val() != 'Dinas') {
           return true;
         } else {
           Swal({
             position: 'top',
             type: 'warning',
             title: 'Matrix Perdin belum ada!',
             showConfirmButton: false,
             timer: 2000
           });
           return false;
         }
       });

       //  $('#formmasterplan_2021').submit(function() {
       //    var cek = masterplancekperdin();
       //    if (cek > 0 || $('#penugasan').val() != 'Dinas') {
       //      var cekKontrak = masterplanceklskontrak();
       //      if (cekKontrak > 0) {
       //        return true;
       //      } else {
       //        Swal({
       //          position: 'top',
       //          type: 'warning',
       //          title: 'Matrix Kontrak belum ada!',
       //          showConfirmButton: false,
       //          timer: 2000
       //        });
       //        return false;
       //      }
       //    } else {
       //      Swal({
       //        position: 'top',
       //        type: 'warning',
       //        title: 'Matrix Perdin belum ada!',
       //        showConfirmButton: false,
       //        timer: 2000
       //      });
       //      return false;
       //    }

       //  });

       function masterplancekperdin() {
         var hasilCek = '';
         var kotaDari = $("#kotadari").val();
         var kotaDinas = $("#kotadinas").val();
         console.log(kotaDari);
         console.log(kotaDinas);
         $.ajax({
           url: "<?php echo base_url('stkb/cekperdinkotaasaldinas') ?>",
           method: "POST",
           data: {
             asal: kotaDari,
             tujuan: kotaDinas
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             hasilCek = hasil.length;
             // if(hasil.length > 0){
             //   $("#submitmasterplan").removeClass("btn-danger");
             //   $("#submitmasterplan").addClass("btn-success");
             //   $('#submitmasterplan').html('Submit');
             //   $('#submitmasterplan').prop('disabled', false);
             // }else{
             //   $("#submitmasterplan").removeClass("btn-success");
             //   $("#submitmasterplan").addClass("btn-danger");
             //   $('#submitmasterplan').html('Matrix Perdin Belum Diisi!');
             //   $('#submitmasterplan').prop('disabled', true);
             // }
           }
         });
         return hasilCek;
       }
       // ============================ //

     });


     function detailstkb(nomor) {
       // alert(noid+' - '+waktu);
       $.ajax({
         type: 'post',
         url: '<?php echo base_url('stkb/detailstkbnya') ?>',
         data: {
           nomor: nomor
         },
         success: function(data) {
           $('.fetched-data').html(data); //menampilkan data ke dalam modal
           $('#modal-detailstkb').modal();
         }
       });
     }
     /************ //Javascript Tedi ****************/


     function getradio(id) {

       //   var radios = document.getElementsByTagName('input');
       var radios = document.getElementsByName('cek' + id);

       for (var i = 0, length = radios.length; i < length; i++) {
         if (radios[i].checked) {
           var x = (radios[i].value);
         }
       }

       if (x == '99') {

         console.log('garul');

         var ht = `<div class="col-sm-12">
                <input type="text" class="form-control" name="ketgagal` + id + `" placeholder="Tulis keterangan gagal di sini.." required>
             </div>`

         $('#gagalkunjungan' + id).append(ht);

       } else {

         console.log('garul kedua');

         $('#gagalkunjungan' + id).empty();

       }

     }

     $('#simpanrekaman').on('click', function() {
       var z = $('#jumlahsek').val();
       console.log(z);
       var xz = 0;
       for (let zz = 1; zz <= z; zz++) {
         var zzz = $('#berkas' + zz).val();
         if (zzz == 0) {
           var xz = xz + 1;
           break;
         }
       }

       console.log(xz);
       if (xz == 0) {
         for (let zz = 1; zz <= z; zz++) {

           var pro = $('#kode').val();
           var sek = $('#skenario' + zz).val();
           var kun = $('#kunjungan').val();
           var cabang = $('#cabang').val();
           var user = $('#user').val();

           console.log(pro);
           console.log(sek);
           console.log(kun);
           console.log(cabang);
           console.log(user);

           $.ajax({
             url: "<?= base_url('rekaman/updatestatusrekaman') ?>",
             type: "POST",
             dataType: 'json',
             data: {
               pro: pro,
               sek: sek,
               kun: kun,
               cabang: cabang,
               user: user
             },
             success: function(hasil) {
               console.log('sukses');
             }
           })

         }
       }
     });

     function cekDialog(rri, name) {
       var array = ["pdf"];
       var filename = rri;

       console.log(filename);
       var file = filename.split('.').pop();
       console.log(file);
       if (array.includes(file) == false) {
         $(`#` + name).val("");
         Swal({
           position: 'center',
           type: 'error',
           title: "GAGAL",
           text: "FORMAT BERKAS YANG ANDA PILIH TIDAK SESUAI. (HARUS PDF)",
           showConfirmButton: true,
         });
       }
     }

     function cekPhoto(rri, name) {
       var array = ["jpg", "png", "jpeg", "JPG", "PNG", "JPEG"];
       var filename = rri;

       console.log(filename);
       var file = filename.split('.').pop();
       console.log(file);
       if (array.includes(file) == false) {
         $(`#` + name).val("");
         Swal({
           position: 'center',
           type: 'error',
           title: "GAGAL",
           text: "FORMAT BERKAS YANG ANDA PILIH TIDAK SESUAI. (HARUS JPG, PNG, JPEG)",
           showConfirmButton: true,
         });
       }
     }

     function cekFileAudio(rri, name) {
       var array = ["mp3", "mp4", "amr", "m4a", "wav"];
       var filename = rri;

       console.log(filename);
       var file = filename.split('.').pop();
       console.log(file);
       if (array.includes(file) == false) {
         $(`#` + name).val("");
         Swal({
           position: 'center',
           type: 'error',
           title: "GAGAL",
           text: "FORMAT BERKAS YANG ANDA PILIH TIDAK SESUAI. (mp3, mp4, amr, m4a, wav)",
           showConfirmButton: true,
         });
       }
     }

     // ======= FUNCTION PERPANJANG SKENARIO KUNJUNGAN

     $(document).ready(function() {
       $('#save_tglSkenario').click(function() {
         var id = $("#id_plan").val();
         var tgl = $("#tgl_ubah").val();
         $('body').data("id" + id, "5050");
         //console.log(id+tgl);
         $.ajax({
           url: "<?php echo base_url('skenario/prosesperpanjangkunjungan') ?>",
           method: "POST",
           data: {
             id: id,
             tgl: tgl
           },
           async: false,
           dataType: 'json',
           success: function(hasil) {
             console.log(hasil);
             if (hasil) {
               $("#textplanend" + id).text(tgl);
               swal("Planend Skenario", "Tanggal akhir berhasil diubah", "success");
               $("#largeModal").modal('hide');
             }
           }
         });
       });
     });
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

   <script src="<?= base_url('assets/') ?>lib/fancybox/jquery.fancybox.js"></script>

   <script type="text/javascript">
     $(function() {
       jQuery(".fancybox").fancybox();
     });
   </script>
   <!-- <script src="<?= base_url('assets/') ?>js/jquery.dataTables.js"></script> -->
   <script src="<?= base_url('assets/') ?>js/dataTables.bootstrap.js"></script>
   <script>
     $(document).ready(function() {
       $('#dataTables-example').dataTable();
       $('#dataTables-example-2').dataTable();

       if (document.getElementById('dataTables-example-3')) {
         $('#dataTables-example-3').dataTable({
           "responsive": true,
           "searching": true,
           "ordering": true,
           "info": true,
           "scrollY": "",
           "scrollCollapse": true,
           "paging": true
         });
       }

       if (document.getElementById('dataTables-example-4')) {
         $('#dataTables-example-4').dataTable({
           "responsive": true,
           "searching": true,
           "ordering": true,
           "info": true,
           "scrollY": "",
           "scrollCollapse": true,
           "paging": true
         });
       }

       for (var i = 5; i <= 99; i++) {

         $('#dataTables-example-' + i).dataTable({
           "responsive": true,
           "searching": true,
           "ordering": true,
           "info": true,
           "scrollY": "",
           "scrollCollapse": true,
           "paging": true,
           "lengthMenu": [
             [5, 10, 50, -1],
             [5, 10, 50, "All"]
           ]
         });
       }



       $('#tables-evaluasitd').DataTable({
         "responsive": true,
         "searching": true,
         "ordering": false,
         "info": true,
         "scrollY": "",
         "scrollCollapse": true,
         "paging": false,
         dom: 'Blfrtip',
         lengthMenu: [
           [10, 25, 50, 100, -1],
           [10, 25, 50, 100, "All"]
         ],
         buttons: [{
           extend: 'excel',
           className: 'btn-primary',
           text: 'Export to Excel',

           title: 'Evaluasi TD E-Banking (' + $('#channel_eb_val').val() + ' Versi ' + $('#versi_eb').val() + ') ',
           filename: function() {
             var d = new Date();
             const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
             var n = d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
             return 'Evaluasi TD E-Banking (' + $('#channel_eb_val').val() + ' Versi ' + $('#versi_eb').val() + ') ' + n;
           },
         }],
       });

       $('#tables-reporttotal').DataTable({

         dom: 'Blfrtip',
         lengthMenu: [
           [10, 25, 50, 100, -1],
           [10, 25, 50, 100, "All"]
         ],
         buttons: [{
           extend: 'excel',
           text: 'Export to Excel',

           title: 'Report Total TD E-Banking, Project ' + $('#nama_project').val() + ' Channel ' + $('#channel_project').val() + '',
           filename: function() {
             var d = new Date();
             const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
             var n = d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
             return 'Report Total TD E-Banking (' + $('#channel_project').val() + ') ' + n;
           },
         }],
       });

       $('#tables-hasilsosmed').DataTable({

         dom: 'Blfrtip',
         lengthMenu: [
           [10, 25, 50, 100, -1],
           [10, 25, 50, 100, "All"]
         ],
         buttons: [{
           extend: 'excel',
           className: 'btn-primary',

           text: 'Export to Excel',

           title: 'Report Evaluasi Sosial Media, Project ' + $('#nama_project').val()+ " " + $('#skenario_project').val() + '',
           filename: function() {
             var d = new Date();
             const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
             var n = d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
             return 'Report Evaluasi Sosial Media (' + $('#skenario_project').val() + ') ' + n;
           },
         }],
       });

       $('#tables-konsistensi').DataTable({
        "paging":   false,
        

         dom: 'Blfrtip',
         lengthMenu: [
           [10, 25, 50, 100, -1],
           [10, 25, 50, 100, "All"]
         ],
         buttons: [{
           extend: 'excel',
           text: 'Export to Excel',

           title: 'Data Konsistensi Non Skill MS B1',
           filename: function() {
             var d = new Date();
             const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
             var n = d.getDate() + " " + months[d.getMonth()] + " " + d.getFullYear();
             return 'Data Konsistensi Non Skill MS B1 ' + n;
           },
         }],
       });

       var table_total = $('#tables-reporttotal').DataTable();
       table_total.button(0).nodes().css('background-color', '#5F9EA0').css('color', 'white').addClass('btn');

       var table_evaluasi = $('#tables-evaluasitd').DataTable();
       table_evaluasi.button(0).nodes().css('background-color', '#5F9EA0').css('color', 'white').addClass('btn');

        var table_hasil = $('#tables-hasilsosmed').DataTable();
       table_hasil.button(0).nodes().css('background-color', '#5F9EA0').css('color', 'white').addClass('btn');

        var table_konsistensi = $('#tables-konsistensi').DataTable();
       table_konsistensi.button(0).nodes().css('background-color', '#5F9EA0').css('color', 'white').addClass('btn');


     });



     $(document).ready(function() {
       // Setup - add a text input to each footer cell
       $('#dataTables-ordercelltop thead tr').clone(true).appendTo('#dataTables-ordercelltop thead');
       $('#dataTables-ordercelltop thead tr:eq(1) th').each(function(i) {

         var title = $(this).text();
         $(this).html('<center><input type="text" placeholder="Filter" /><center>');

         $('input', this).on('keyup change', function() {
           if (table.column(i).search() !== this.value) {
             table
               .column(i)
               .search(this.value)
               .draw();
           }
         });
       });

       $(document).ready(function() {
         $('#tables-reporttotal').DataTable().on('buttons-action',
           function(e, buttonApi) {
             var project = $('#kode_project').val();
             var channel = $('#channel_project').val();


             $.ajax({
               url: "<?= base_url('aktual/download_total') ?>",
               type: "POST",
               dataType: 'json',
               data: {
                 project: project,
                 channel: channel
               },
               success: function(hasil) {

                 console.log('Button ' + buttonApi.text() + ' was activated');
                 console.log(project);
                 console.log(channel);
                 console.log(hasil);

               }
             });

           });
       });


       $(document).ready(function() {
         $('#tables-evaluasitd').DataTable().on('buttons-action',
           function(e, buttonApi) {
             var input = document.getElementsByName('num[]');
             var id = [];

             for (var i = 0; i < input.length; i++) {
               var a = input[i].value;
               id.push(a);
             }

             $.ajax({
               url: "<?= base_url('aktual/download_label') ?>",
               type: "POST",
               dataType: 'json',
               data: {
                 id: id
               },
               success: function(hasil) {

                 console.log('Button ' + buttonApi.text() + ' was activated');
                 console.log(id);

                 console.log(hasil);

               }
             });

           });
       });

       $(document).ready(function() {
         $('#plotting_trx').on('keyup change', function() {
           var trx = $(this).val();
           console.log(trx);

           if (trx != '' || trx != 0) {
             document.getElementById('show_plotting').style.display = 'block';
             document.getElementById('update_plotting').style.display = 'block';

           } else if (trx == 0 || trx == '') {
             document.getElementById('show_plotting').style.display = 'none';
             document.getElementById('update_plotting').style.display = 'none';

           }
         });


         $('#plotting_trx2').on('keyup change', function() {
           var trx = $(this).val();
           console.log(trx);

           if (trx != '' || trx != 0) {
             document.getElementById('show_plotsosmed').style.display = 'block';
             document.getElementById('update_plotsosmed').style.display = 'block';

           } else if (trx == 0 || trx == '') {
             document.getElementById('show_plotsosmed').style.display = 'none';
             document.getElementById('update_plotsosmed').style.display = 'none';

           }
         });
       });

       var table = $('#dataTables-ordercelltop').DataTable({
         orderCellsTop: true,
         fixedHeader: true
       });

     });
   </script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>



   <script type="text/javascript">
     // TAMBAHAN ADAM SANTOSO
     $(document).ready(function() {
       if (window.location.href == '<?= base_url('stkb/pengajuan'); ?>') {
         aktif('#term1');
       }
       if (window.location.href == '<?= base_url('stkb/pembayaran_field_sdm'); ?>') {
         aktif('#pengajuan');
       }

     });

     function formatRupiah(angka, prefix) {
       var number_string = angka.replace(/[^,\d]/g, '').toString(),
         split = number_string.split(','),
         sisa = split[0].length % 3,
         rupiah = split[0].substr(0, sisa),
         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

       // tambahkan titik jika yang di input sudah menjadi angka ribuan
       if (ribuan) {
         separator = sisa ? '.' : '';
         rupiah += separator + ribuan.join('.');
       }

       rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
       //  return (prefix == undefined) ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
       return (prefix == undefined) ? rupiah : prefix + rupiah;
       //  return 'test';
     }
   </script>


   </body>

   </html>