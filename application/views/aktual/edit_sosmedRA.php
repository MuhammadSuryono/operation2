  <?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
}
?>

<style type="text/css">
  .garis-bawah {
    border: 0;
    outline: 0;
    border-bottom: 2px solid grey;

  }
</style>

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aktual From List Evaluasi Sosial Media </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Aktual From List Evaluasi Sosial Media </strong> </h4>
                       <!-- Nav tabs -->
                      
                      <br>


                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                    <!-- Tab panes -->
                     
                        
                        <div  class="container-fluid">
                          <section id="unseen">
                          <div class="modal-body">
      <form method="POST" action="<?php echo base_url('aktual/editRA_listsosmed') ?>" enctype="multipart/form-data">
        <input type="hidden" name="num" id="num" value="<?php echo $data['num'] ?>">
        

        <div class="row">
          <div class="col-md-6" style="border-right: 3px solid;">
        <div class="form-group">
          <label for="project"><b>Project</b></label>
          <input type="text" class="form-control" name="project" id="project" value="<?php echo $data['nama_project'] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="project"><b>Nama Shopper</b></label>
          <select class="form-control selectpicker" name="nama_shopper" id="nama_shopper" data-live-search="true" required>
                              <option value="">Pilih Shopper</option>
                            <?php
                            foreach ($shopper as $shp) {
                              ?>
                              <option value="<?php echo $shp['id'] ?>" <?php if ($data['nama_shopper'] == $shp['id']) {echo "selected";} ?>><?php echo $shp['nama'] ?></option>
                          <?php } ?>       
          </select>  
        </div>
         <div class="form-group">
          <label for="bank"><b>Bank</b></label>
          <input type="text" class="form-control" name="bank" id="bank" value="<?php echo $data['nama_bank'] ?>" readonly>
        </div>
         <div class="form-group">
          <label for="tanggal"><b>Tanggal Evaluasi</b></label>
          <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $data['tanggal_evaluasi'] ?>" readonly>
        </div>
         <?php
         $waktu = $data['waktu'];
         $jam = $this->db->get_where('waktu', array('ket' => $waktu))->row_array(); ?>
         <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
            <label for="jam_mulai"><b>Jam Mulai</b></label>
            <input type="time" class="form-control" name="jam_mulai" value="<?= $data['jam_mulai']; ?>" min="<?php echo $jam['awal'] ?>" max="<?php echo $jam['akhir'] ?>" id="jam_selesai<?php echo $data['num'] ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="channel"><b>Platform</b></label>
          <input type="text" class="form-control" name="channel" id="channel" value="<?php echo $data['platform'] ?>" readonly>
        </div>
        
        <div class="form-group">
          <label for="pengirim"><b>Nama Akun Sosial Media Pengirim</b></label>
          <select class="form-control selectpicker" name="username_pengirim" id="pengirim" data-live-search="true">
            <option value="">Pilih Nama Akun Pengirim</option>
            <?php $pengirim = $this->db->get_where('sosmed_akun', array('platform' => $data['platform'], 'milik' => 'Pribadi'))->result_array();
             
              foreach ($pengirim as $pg) {
                 $db = $data['sosmed_pengirim'];

                 ?>
                <option value="<?php echo $pg['username'] ?>" <?php if ($pg['username'] === $db) { echo "selected"; } ?>><?php echo $pg['username']; ?></option>
               <?php } ?>>
          </select>
        </div>

          <div class="form-group">
        <?php if ($data['platform'] == 'Facebook') { ?>
          <label for="username_bank"><b>Page Name Bank</b></label>
        <?php } else { ?>
          <label for="username_bank"><b>Username Bank</b></label>
        <?php }
         $penerima = $this->db->get_where('sosmed_akun', array('platform' => $data['platform'], 'bank' => $data['bank'], 'milik' => 'Bank'))->row_array();
         ?>
          <input type="text" class="form-control" name="username_bank" id="username_bank" value="<?= $penerima['username'] ?>" readonly>
        </div>
        
        <div class="form-group">
          <label for="skenario"><b>Skenario</b></label>
          <input type="text" class="form-control" name="skenario" id="skenario" value="<?php echo $data['nama_skenario'] ?>" readonly>
        </div>
        <?php
          $greet = $this->db->order_by('urut', 'asc')->get('sosmed_greeting')->result_array();
          ?>
        <div class="form-group">
          <label><b>Greeting Awal</b></label><br>
          <?php $ga = unserialize($data['greeting_awal']);
           foreach ($greet as $gt) {
          // if ($gt['score'] == 31 OR $gt['score'] == 32 OR $gt['score'] == 33 OR $gt['score'] == 34) {
          //   echo "&emsp;&emsp;";
          // }
            ?>

          <input type="checkbox" name="greeting_awal[]" <?php if (in_array($gt['score'], $ga)) {echo "checked";} ?> value="<?= $gt['score'] ?>">&nbsp; <?= $gt['greeting'] ?><br>
          <?php } ?>
          Lainnya <input type="text" name="greeting_awal[]" class="garis-bawah">

        </div>
        <br>
        <br>

        <div class="form-group">
          <label><b>Greeting Akhir (Sebelum balas OK)</b></label><br>
          <?php $g_before = unserialize($data['greeting_akhir_before']);
          foreach ($greet as $gt) {
          // if ($gt['score'] == 31 OR $gt['score'] == 32 OR $gt['score'] == 33 OR $gt['score'] == 34) {
          //   echo "&emsp;&emsp;";
          // }
            ?>

          <input type="checkbox" name="greeting_akhir_before[]" <?php if (in_array($gt['score'], $g_before)) {echo "checked";} ?> value="<?= $gt['score'] ?>">&nbsp; <?= $gt['greeting'] ?><br>
          <?php } ?>
          Lainnya <input type="text" name="greeting_akhir_before[]" class="garis-bawah">
        </div>
        </div>

        <div class="col-md-6">
         <?php
         $not = array(31, 32, 33, 34);
          // $greet = $this->db->where_not_in('score', $not)->order_by('urut', 'asc')->get('sosmed_greeting')->result_array();
          $greet = $this->db->order_by('urut', 'asc')->get('sosmed_greeting')->result_array();

          ?>
        <div class="form-group">
          <label><b>Greeting Akhir (Setelah balas OK)</b></label><br>
          <?php $g_after = unserialize($data['greeting_akhir_after']);
           foreach ($greet as $gt) {
          // if ($gt['score'] == 31 OR $gt['score'] == 32 OR $gt['score'] == 33 OR $gt['score'] == 34) {
          //   echo "&emsp;&emsp;";
          // }
            ?>

          <input type="checkbox" name="greeting_akhir_after[]" <?php if (in_array($gt['score'], $g_after)) {echo "checked";} ?> value="<?= $gt['score'] ?>">&nbsp; <?= $gt['greeting'] ?><br>
          <?php } ?>
          Lainnya <input type="text" name="greeting_akhir_after[]" class="garis-bawah">
        </div> 

        <div class="form-group">
          <label><b>Respons Agent</b></label>
          <textarea class="form-control" name="respon_agent"><?= $data['respon_agent'] ?></textarea>
        </div>

        <div class="form-group">
          <label><b>Waktu Pengiriman Pesan</b></label>
          <input type="datetime-local" name="waktu_kirim" id="waktu_kirim" class="form-control" value="<?php echo date('Y-m-d\TH:i:s', strtotime($data['waktu_kirim'])); ?>">
        </div>

        <div class="form-group">
          <label><b>Waktu Dibalas Pesan Oleh Staff</b></label>
          <input type="datetime-local" name="waktu_balas" id="waktu_balas" class="form-control" <?php if($data['waktu_balas'] != NULL) { ?> value="<?php echo date('Y-m-d\TH:i:s', strtotime($data['waktu_balas'])); ?>" <?php } ?>>
        </div>

        <div id="tempat_td">
          <div class="form-group">
            <label>Aktual Time Delivery</label>
            <input name="aktual_td" id="aktual_td" class="form-control" value="<?= $data['aktual_td'] ?>" readonly>
                                <br>
          </div>
        </div>

        <div class="form-group">
          <label><b>Time Delivery</b></label><br>
          <input type="radio" name="total_td" id="td_1" <?php if($data['total_td'] == 1){echo "checked";} ?> value="1" > &nbsp;Kurang dari 30 menit<br>
          <input type="radio" name="total_td" id="td_2" <?php if($data['total_td'] == 2){echo "checked";} ?> value="2" > &nbsp;31 menit - 1 jam<br>
          <input type="radio" name="total_td" id="td_3" <?php if($data['total_td'] == 3){echo "checked";} ?> value="3" > &nbsp;1 - 24 jam (respons diterima dalam hari yang sama)<br>
          <input type="radio" name="total_td" id="td_4" <?php if($data['total_td'] == 4){echo "checked";} ?> value="4" > &nbsp;H+1<br>
          <input type="radio" name="total_td" id="td_5" <?php if($data['total_td'] == 5){echo "checked";} ?> value="5" > &nbsp;H+2<br>
          <input type="radio" name="total_td" id="td_6" <?php if($data['total_td'] == 6){echo "checked";} ?> value="6" > &nbsp;H+3<br>
          <input type="radio" name="total_td" id="td_99" <?php if($data['total_td'] == 99){echo "checked";} ?> value="99" > &nbsp;Belum ada respons sama sekali hingga H+4<br>

        </div>

        <div class="form-group">
          <label>Apabila time delivery respons agent lebih dari 1 jam, apakah terdapat respons otomatis yang dikirimkan bahwa staf bank sedang offline/tidak beroperasi? </label>
          <input type="radio" name="respon_otomatis" class="respon_1" id="respon" <?php if($data['respon_otomatis'] == 1){echo "checked";} ?> value="1" > &nbsp;Ada<br>
          <input type="radio" name="respon_otomatis" class="respon_2" id="respon" <?php if($data['respon_otomatis'] == 2){echo "checked";} ?> value="2" > &nbsp;Tidak<br>
          <input type="radio" name="respon_otomatis" class="respon_99" id="respon" <?php if($data['respon_otomatis'] == 99){echo "checked";} ?> value="99" > &nbsp;Time delivery < 1 jam<br>
        </div>

        <div id="isi_verbatim">
          <?php if($data['respon_otomatis'] == 1){ ?>
           <label>Verbatim</label>
           <input name="verbatim" class="form-control" value="<?= $data['verbatim_respon'] ?>">
                                  <?php } ?>
        </div>

        <div class="form-group">
          <label><b>Temuan (jika ada)</b></label>
          <input type="text" name="temuan" class="form-control" value="<?= $data['temuan'] ?>">
          
        </div>

        
      </div>
    
  </div>
      </div>
                            <div class="text-right">
                              <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            
                            </section>
                        </div>

                        


                      
                



                </div>
            </div>
          </div>

          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>



    <!-- /MAIN CONTENT -->
    <!--main content end -->
<script>

  $(document).ready(function() {
       $('#waktu_balas').change(function() {
        var datekirim = new Date($('#waktu_kirim').val());
        var datebalas = new Date($(this).val());

        var ht = ``;
        $('#tempat_td').empty();
        var difference = datebalas.getTime() - datekirim.getTime();

        // console.log(difference);
        console.log(datekirim.getTime());
        console.log(datebalas.getTime());

        var diff_hari = Math.floor(difference/1000/60/60/24);
        difference -= diff_hari*1000*60*60*24

        var diff_jam = Math.floor(difference/1000/60/60);
        difference -= diff_jam*1000*60*60

        var diff_menit = Math.floor(difference/1000/60);
        difference -= diff_menit*1000*60

        console.log('difference = ' + 
        diff_hari + ' day/s ' + 
        diff_jam + ' hour/s ' + 
        diff_menit + ' minute/s ');

        ht += `<div class="form-group">`;
        ht += `<label><b>Aktual Time Delivery</b></label>`;
        ht += `<input name="aktual_td" class="form-control" value="`+ diff_menit+` menit `+diff_jam+` jam `+diff_hari+` hari`+`" readonly>`;
        ht += `</div>`;

        $('#tempat_td').append(ht);

        if (diff_menit <= 30 && diff_jam == 0 && diff_hari == 0) {
          $("#td_1").prop("checked", true);
          $(".respon_99").prop("checked", true);
        } else if ((diff_menit > 30 && diff_menit < 59 && diff_jam == 0 && diff_hari == 0) ||  (diff_menit == 0 && diff_jam == 1 && diff_hari == 0)) {
          $("#td_2").prop("checked", true);
          $(".respon_99").prop("checked", true);
        } else if (diff_jam >= 1 && diff_jam <= 24 && diff_hari == 0) {
          $("#td_3").prop("checked", true);
        } else if (diff_menit >= 0 && diff_jam >= 0  && diff_hari == 1) {
          $("#td_4").prop("checked", true);
        } else if (diff_menit >= 0 && diff_jam >= 0  && diff_hari == 2) {
          $("#td_5").prop("checked", true);
        } else if (diff_menit >= 0 && diff_jam >= 0  && diff_hari == 3) {
          $("#td_6").prop("checked", true);
        } else {
          $("#td_99").prop("checked", true);
        }

       })

       $('input[type=radio][name="respon_otomatis"]').change(function() {
          var respon = $(this).val();
          console.log(respon);
          var hz = ``;
          $('#isi_verbatim').empty();

          hz += `<div class="form-group">`;
          hz += `<label><b>Verbatim</b></label>`;
          hz += `<input name="verbatim" class="form-control">`;
          hz += `</div>`;

          if (respon == '1') {
            $('#isi_verbatim').append(hz);
          }
       });
     });
   var loadFile = function(num) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('gambar_nodin'+num);
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };

    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }


  function gantiBukti(num) {
     console.log(this);
     console.log(num);
      
         var reader = new FileReader();

         reader.onload = function(e) {
           $('#gambar_nodin'+num).attr('src', e.target.result);
         }
         console.log($('#gambar_nodin'+num));

         reader.readAsDataURL(this.files[0]);
       
  }




      
      
  </script>
