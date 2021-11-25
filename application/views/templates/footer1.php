 <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>MRI - <?= date('Y')?></strong>. 
        </p>
        <div class="credits">
            All Rights Reserved
        </div>
        <a href class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?= base_url('assets/')?>lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery.ui.touch-punch.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery.scrollTo.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="<?= base_url('assets/')?>lib/common-scripts.js"></script>
  <!--script for this page-->

  

  <script src="<?= base_url('assets/')?>lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="<?= base_url('assets/')?>lib/advanced-datatable/js/jquery.js"></script>
  <script src="<?= base_url('assets/')?>lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery.scrollTo.min.js"></script>
  <script src="<?= base_url('assets/')?>lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="<?= base_url('assets/')?>lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/advanced-datatable/js/DT_bootstrap.js"></script>


  <!-- SCRIP BARU IWAY -->
   <script src="<?=base_url('assets/')?>lib/jquery/jquery.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="<?=base_url('assets/')?>lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="<?=base_url('assets/')?>lib/jquery.scrollTo.min.js"></script>
  <script src="<?=base_url('assets/')?>lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="<?=base_url('assets/')?>lib/common-scripts.js"></script>
  <!--script for this page-->
  <script src="<?=base_url('assets/')?>lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/')?>lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/')?>lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/')?>lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/')?>lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/')?>lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/')?>lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?=base_url('assets/')?>lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="<?=base_url('assets/')?>lib/advanced-form-components.js"></script>
  <!-- AKHIR SCRIP BARU IWAY -->

  <!-- PAGINATION DAN PENCARIAN -->
  <script src="<?= base_url('assets/')?>js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="<?= base_url('assets/')?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/')?>js/jquery.dataTables.js"></script>
    <script src="<?= base_url('assets/')?>js/dataTables.bootstrap.js"></script>
  <!-- AKHIR PAGINATION DAN PENCARIAN -->

<script>
  $(document).ready(function(){
  var i = 0;

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


  $('#play').click(function(){
      $('#soalsoal').empty();
      var jenis = $('#jenis').val();

      $.ajax({
        url:"<?= base_url('equest/skenario')?>",
        type:"POST",
        dataType: 'json',
        data:{jenis:jenis},
        success:function(hasil){
            for(i=0;i<hasil.length;i++){
                var ht = `<div class="row mt">
                        <div class="col-lg-12">
                          <div class="form-panel">
                              <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Rekaman Brief Skenario `+hasil[i].nama_skenario+`</strong></h4>
                              <div class="form-horizontal style-form">
                                  <audio controls id="rekaman" src="../assets/file/`+hasil[i].file_skenario+`"></audio>
                          </div>
                          </div>
                        </div>
                        </div>`;
              $('#soalsoal').append(ht);
            }
        }
    });
  });


  $('.fa-bars').click(function() {
    if ($('#sidebar > ul').is(":visible") === true) {
      $('#main-content').css({
        'margin-left': '0px'
      });
      $('#sidebar').css({
        'margin-left': '-210px'
      });
      $('#sidebar > ul').hide();
      $("#container").addClass("sidebar-closed");
    } else {
      $('#main-content').css({
        'margin-left': '210px'
      });
      $('#sidebar > ul').show();
      $('#sidebar').css({
        'margin-left': '0'
      });
      $("#container").removeClass("sidebar-closed");
    }
  });

  $('#project').change(function(){
    $('#skenario').empty();
    var ht1 = $('#project').val();
    $.ajax({
        url:"<?= base_url('skenario/jenisskenario')?>",
        type:"POST",
        dataType: 'json',
        data:{jenis:ht1},
        success:function(hasil){
            for(i=0;i<hasil.length;i++){
                var ht = `<label class="checkbox-inline">
                            <input type="checkbox" id="check[]" name="check[]" value="`+hasil[i].id_skenario+`">`+hasil[i].nama_skenario+`
                        </label>`;
              $('#skenario').append(ht);
            }
        }
    });
  });

});
</script>

<script>
function searchTable() {
    var input;
    var saring;
    var status; 
    var tbody; 
    var tr; 
    var td;
    var i; 
    var j;
    input = document.getElementById("caridata");
    saring = input.value.toUpperCase();
    tbody = document.getElementsByTagName("tbody")[0];
    tr = tbody.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(saring) > -1) {
                status = true;
            }
        }
        if (status) {
            tr[i].style.display = "";
            status = false;
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>

<script>
        $(document).ready(function () {
            $('#dataTables-example').dataTable();
        });
</script>

<script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?= base_url('assets/')?>lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="<?= base_url('assets/')?>lib/advanced-form-components.js"></script>
   <script src="<?= base_url('assets/')?>lib/fancybox/jquery.fancybox.js"></script>

  <script type="text/javascript">
    $(function() {
      //    fancybox
      jQuery(".fancybox").fancybox();
    });
  </script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
</body>

</html>

