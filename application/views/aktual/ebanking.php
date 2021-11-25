
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

    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aktual E-Banking </h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Aktual E-Banking </strong> </h4>
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
                            
                            <div class="row">
                              <form action="<?php echo base_url('aktual/form_ebanking') ?>" method="POST">
                              <div class="col-md-2"><h4><b>Pilih Project :</b></h4></div>
                              <div class="col-md-3">
                                <select class="form-control" id="project_act_eb" name="project">
                                  <option value="">--Pilih Project--</option>
                                  <?php foreach ($daftarproject as $row) {
                                  ?>
                                  <option value="<?php echo $row['kode_project'] ?>"><?php echo $row['nama_project'] ?></option>
                                  <?php
                                  } ?>
                                </select>
                              </div>
                              <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" id="go_eb" disabled>Go</button>
                              </div>
                              </form>
                            </div>
                            <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">
                            <br>

                            
                            </section>
                        </div>

                        


                      
                



                </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Aktual From List E-Banking </strong> </h4>
                       <!-- Nav tabs -->
                      
                      <br>


                    <!-- <a class="btn btn-round btn-primary mb" href="<?= base_url('cabang/tambah')?>"><span class="fa fa-plus fa-fw"></span> Tambah </a> -->
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                     <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

                    <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    </div>
                

                    <!-- Tab panes -->
                     
                        <?php  
                        // $search = $this->db->query("SELECT a.*,
                        //                 b.nama AS nama_bank,
                        //                 c.nama AS nama_transaksi,
                        //                 d.nama AS nama_project
                        //                 FROM ebanking a
                        //                 LEFT JOIN bank b ON a.bank=b.kode
                        //                 LEFT JOIN attribute_ebanking c ON a.transaksi=c.kode
                        //                 LEFT JOIN project d ON a.project=d.kode
                        //                 WHERE tanggal_evaluasi IS NOT NULL
                        //                 AND a.status = 0 AND d.`type`='n'
                        //                 ")->result_array();
                         ?>
                        <div  class="container-fluid">
                          <section id="unseen">
                            
                            <div class="row table-responsive">
                              <!-- <div class="table-responsive"> -->
                          <!-- <form action="<?= base_url('skenario/delete_ebanking')?>" method="post"> -->
                            <table class=" table table-bordered table-striped table-hover table-condensed table-responsive-sm" id="table1">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th><center>Nama Project</center></th>
                                  <th><center>Nama Bank</center></th>
                                  <th><center>Channel</center></th>
                                  <th><center>Transaksi</center></th>
                                  <th><center>System</center></th>
                                  <th><center>Provider</center></th>
                                  <th><center>Waktu</center></th>
                                  <th><center>Tanggal Evaluasi</center></th>
                                  <th><center>Aksi</center></th>
                                  
                                </tr>
                              </thead>
                              <tbody>
                              <!-- <?php $no = 0; foreach($search as $db) :?>
                                  <?php if($no%2==0):?>
                                     <tr style="background-color : #e2e4ff;">
                                     <td><center>
                                  <?php else :?>
                                     <tr>
                                     <td style="background-color : #ffffff;"><center>
                                  <?php endif?>
                                     <?= ++$no?><center></td>
                                     <td><center><?= $db['nama_project']?><center></td>
                                     <td><center><?= $db['nama_bank']?><center></td> 
                                     <td><center><?= $db['channel']?><center></td>
                                     <td><center><?= $db['nama_transaksi']?><center></td>
                                     <td><center><?= $db['os']?><center></td>
                                     <td><center><?= $db['provider']?><center></td> 
                                     <td><center><?= $db['hari']." - ".$db['waktu']?><center></td>
                                     <td><center><?= $db['tanggal_evaluasi']?><center></td>
                                     <td><center><button class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#aktual<?= $db['num']?>">Aktual!</button></center></td>
                                     </tr>

                                <?php endforeach?> -->
                              </tbody>
                            </table>
                          </div>
                            
                          <!-- </form> -->

                            
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

<!-- Modal Aktual -->
<!-- <?php $no = 0;
foreach ($search as $db) { $no++;
   ?>
<div class="modal fade" id="aktual<?php echo $db['num'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aktual E-Banking From List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('aktual/aktual_list') ?>" enctype="multipart/form-data">
        <input type="hidden" name="project_2" value="<?php echo $db['project'] ?>">
        <input type="hidden" name="channel_2" id="channel_2<?php echo $db['num'] ?>" value="<?php echo $db['channel'] ?>">
        <input type="hidden" name="bank_2" id="bank_2<?php echo $db['num'] ?>" value="<?php echo $db['bank'] ?>">
        <input type="hidden" name="transaksi_2" id="transaksi_2<?php echo $db['num'] ?>" value="<?php echo $db['transaksi'] ?>">
        <input type="hidden" name="os_2" id="os_2<?php echo $db['num'] ?>" value="<?php echo $db['os'] ?>">

        <input type="hidden" name="num" id="num<?php echo $db['num'] ?>" value="<?php echo $db['num'] ?>">
        <input type="hidden" name="waktu" id="waktu<?php echo $db['num'] ?>" value="<?php echo $db['waktu'] ?>">


        <div class="row">
          <div class="col-md-6" style="border-right: 3px solid;">
        <div class="form-group">
          <label for="project">Project</label>
          <input type="text" class="form-control" name="project" id="project" value="<?php echo $db['nama_project'] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="project">Nama Shopper</label>
          <select class="form-control" name="nama_shopper" id="nama_shopper" data-live-search="true" required>
                              <option value="">--Pilih Shopper--</option>
                            <?php
                            foreach ($shopper as $shp) {
                              ?>
                              <option value="<?php echo $shp['id'] ?>"><?php echo $shp['nama'] ?></option>
                          <?php } ?>       
          </select>  
        </div>
         <div class="form-group">
          <label for="bank">Bank</label>
          <input type="text" class="form-control" name="bank" id="bank" value="<?php echo $db['nama_bank'] ?>" readonly>
        </div>
         <div class="form-group">
          <label for="tanggal">Tanggal Evaluasi</label>
          <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $db['tanggal_evaluasi'] ?>" readonly>
        </div>
         <?php
         $waktu = $db['waktu'];
         $jam = $this->db->get_where('waktu', array('ket' => $waktu))->row_array(); ?>
         <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" class="form-control" name="jam_mulai" min="<?php echo $jam['awal'] ?>" max="<?php echo $jam['akhir'] ?>" id="jam_mulai<?php echo $db['num'] ?>">
            </div>
            <div class="col-sm-6">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" class="form-control" name="jam_selesai" min="<?php echo $jam['awal'] ?>" max="<?php echo $jam['akhir'] ?>" id="jam_selesai<?php echo $db['num'] ?>">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="channel">Channel</label>
          <input type="text" class="form-control" name="channel" id="channel" value="<?php echo $db['channel'] ?>" readonly>
        </div>
        <?php if ($db['channel'] == 'Mobile Banking') { ?>
          <div class="form-group">
          <label for="channel">System</label>
          <input type="text" class="form-control" name="os" id="channel" value="<?php echo $db['os'] ?>" readonly>
        </div>
        <?php } ?>
        <?php if ($db['channel'] == 'SMS Banking') {
        $jenis = $this->db->query("SELECT *
                                    FROM ebanking
                                    WHERE channel = '$db[channel]'
                                    AND project ='$db[project]'
                                    AND bank='$db[bank]'
                                    GROUP BY os
                                    ")->result_array();
        } else {
        $jenis = $this->db->query("SELECT *
                                    FROM ebanking_aplikasi
                                    WHERE bank = '$db[bank]'
                                    AND channel = '$db[channel]'
                                    GROUP BY nama
                                    ")->result_array();
        } ?>
        <div class="form-group">
          <label for="jenis">Jenis</label>
          <select  name="jenis" id="jenis_2<?php echo $db['num'] ?>" class="form-control" onchange="gantiJenis('<?php echo $db['num'] ?>');">
            <option value="">--Pilih Jenis--</option>
          
          <?php 
           if ($db['channel'] == 'SMS Banking') {
                 foreach ($jenis as $jns) { ?>

                   <option value="<?php echo $jns['os'] ?>"><?php echo $jns['os'] ?></option>
                
               <?php  }
               } else {
                 foreach ($jenis as $jns) { ?>

                  <option value="<?php echo $jns['nama'] ?>"><?php echo $jns['nama'] ?></option>
              <?php
                 }
               } ?>
             </select>
        </div>
        <div class="form-group">
          <label for="provider">Provider</label>
          <input type="text" class="form-control" name="provider" id="provider" value="<?php echo $db['provider'] ?>" readonly>
        </div>
        <div class="form-group">
          <label for="transaksi">Transaksi</label>
          <input type="text" class="form-control" name="transaksi" id="transaksi" value="<?php echo $db['nama_transaksi'] ?>" readonly>
        </div>

        <?php
        $sumber = $this->db->query("SELECT a.*, b.nama AS nama_bank FROM ebanking_rekening a JOIN bank b ON a.bank=b.kode WHERE a.bank='$db[bank]' AND kategori='Rekening' ORDER BY a.nama")->result_array();
        $get = $this->db->get_where('attribute_ebanking', array('kode' => $db['transaksi']))->row_array();

        if ($get['nama'] == 'Overbooking') {
            $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.bank='$db[bank]'
                                        AND a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else if ($get['nama'] == 'Interbank Online' OR $get['nama'] == 'Interbank Offline' OR $get['nama'] == 'ITB Online' OR $get['nama'] == 'ITB Offline') {
            $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.bank!='$db[bank]'
                                        AND a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else if(strpos($get['nama'],"Pulsa")) {
             $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else if(strpos($get['nama'],"Kartu Kredit")) {
             $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else if(strpos($get['nama'],"E-Money") OR strpos($get['nama'],"EMoney")) {
             $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } else {
            $tujuan = $this->db->query("SELECT a.*, b.nama AS nama_bank 
                                        FROM ebanking_rekening a
                                        LEFT JOIN bank b ON a.bank=b.kode 
                                        WHERE 
                                       
                                        a.kategori='$get[kategori]' ORDER BY a.nama")->result_array();
        } ?>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
            <label for="jam_mulai">Sumber Rekening</label>
            <select name="norek" id="norek_eb<?php echo $db['num'] ?>" class="form-control selectpicker" data-live-search="true">
                              <option value="">--Pilih Nomor Rekening--</option>
                              <?php
                              foreach ($sumber as $no) {
                                 ?>
                                <option value="<?php echo $no['nama']." - ".$no['norek'] ?>"><?php echo $no['nama']." - ".$no['norek']." - ".$no['nama_bank']; ?></option>
                               <?php } ?>
                            </select>
            </div>
            <div class="col-sm-6">
   
            <?php if ($get['sumber'] == '2') { ?>
               <label>Masukkan Tujuan</label>
               <select class="form-control selectpicker" name="tujuan" id="tujuan<?php echo $db['num'] ?>" onchange="gantiTujuan('<?php echo $db['num'] ?>')" data-live-search="true">
               <option value="">--Pilih Tujuan--</option>
             <?php  foreach ($tujuan as $to) {
                 if ($to['kategori'] == 'Pulsa' || $to['kategori'] == 'E-Wallet') { ?>
                   <option value="<?php echo $to['nama']." - ".$to['norek']." - ".$to['bank'] ?>"><?php echo $to['nama']." - ".$to['norek']." - ".$to['bank'] ?></option>

              <?php   } else { ?>
                    <option value="<?php echo $to['nama']." - ".$to['norek']." - ".$to['nama_bank'] ?>"><?php echo $to['nama']." - ".$to['norek']." - ".$to['nama_bank'] ?></option>
              <?php   }
               } ?>
               </select>

             <?php } else { ?>
               <input type="hidden" name="tujuan" id="tujuan<?php echo $db['num'] ?>" class="form-control">
            <?php  } ?>
            </div>
          </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="form-group" style="background-color:  #F5FFFA;">
          <div class="" id="transaksi_ebanking" >    
                              <div class="row">
                                <div class="col-sm-5"><b>Berhasil Pada Percobaan Ke- </b></div>
                                <div class="col-sm-3"><input type="number" min="0" name="percobaan_ke" onchange="gantiPercobaan('<?php echo $db['num'] ?>');" id="percobaan_ke<?php echo $db['num'] ?>" class="form-control" required></div>
                                
                              </div>
                              <br>
                              <div class="form-inline" id="inline_ket<?php echo $db['num'] ?>">
                                
                              </div>
                            
              </div>
            </div>
            <br>

          
        <div class="form-group" style="background-color: #F5FFFA;">
          <label>Time Delivery</label>
          <div id="label_td_list<?php echo $db['num'] ?>"></div>
        </div>
        <div class="form-group">
          <label>Upload Bukti Transaksi</label>
                          <input type="file" class="form-control" name="bukti_transaksi" id="bukti_transaksi<?php echo $db['num'] ?>" accept="image/*" onchange="loadFile('<?php echo $db['num'] ?>')" required="">
                            <span class="bg-info p-1"><b>NOTE!</b></span>&nbsp;&nbsp;Ukuran file upload maksimal 500KB!<br>
                            <img src="#" id="gambar_nodin<?php echo $db['num'] ?>" width="100%" alt="Preview Gambar" />
        </div>
      </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>

  </div>
</div>
<?php } ?> -->

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>



    <!-- /MAIN CONTENT -->
    <!--main content end -->
<script>
  $(document).ready(function(){
    $('#table1').DataTable( {
        "processing": true,
        "serverSide": true,
        "order" : [],
        "ajax": {
          "url": "<?= base_url('aktual/get_ajax') ?>",
          "type" : "POST" 
        },
        "columnDefs": [
            {
              "targets": [0, 8, -1],
              "orderable": false
            }
          ]
    } );

        // tampil_data_barang(); 
         
        // $('#mydata').dataTable();
          
        // function tampil_data_barang(){
        //     $.ajax({
        //         type  : 'ajax',
        //         url   : '<?php echo base_url('aktual/ebanking2') ?>',
        //         async : false,
        //         dataType : 'json',
        //         success : function(data){
        //             var html = '';
        //             var i;
        //             for(i=0; i<data.length; i++){
        //               var num = i+1;
        //                 html += '<tr>'+
        //                         '<td>'+num+'</td>'+
        //                         '<td>'+data[i]['nama_project']+'</td>'+
        //                         '<td>'+data[i]['nama_bank']+'</td>'+
        //                         '<td>'+data[i]['channel']+'</td>'+
        //                         '<td>'+data[i]['nama_transaksi']+'</td>';
        //                         if (data[i]['os'] != null) {
        //                        html += '<td>'+data[i]['os']+'</td>';
        //                           } else {
        //                       html += '<td></td>';
        //                           }
        //                 html += '<td>'+data[i]['provider']+'</td>'+
        //                         '<td>'+data[i]['hari']+' - '+data[i]['waktu']+'</td>'+
        //                         '<td>'+data[i]['tanggal_evaluasi']+'</td>'+
        //                         '<td><center><button class="btn btn-warning btn-round btn-xs" style="margin-right : 0.5rem; margin-top:0.5rem;" data-toggle="modal" data-target="#aktual'+data[i]['num']+'">Aktual!</button></center></td>'+
        //                         '</tr>';

        //             }
        //             $('#show_data').html(html);
        //         }
 
        //     });
        // }
 
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

  function gantiTujuan(num) {
     var tujuan = $('#tujuan'+num+ ' option:selected').text();
     var norek = $('#norek_eb'+num+ ' option:selected').text();

     console.log(num);

     if (tujuan == norek) {
      alert('Sumber dan Tujuan tidak boleh sama!');
      document.getElementById('tujuan'+num).selectedIndex = 0;
      console.log($('#tujuan'+num));
     }
      
         
       
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




 function gantiJenis(num){
        var num = $('#num'+num).val();
         var chan = $('#channel_2'+num).val();
         var bank = $('#bank_2'+num).val();
         var transaksi = $('#transaksi_2'+num).val();
         var os = $('#os_2'+num).val();
        if (chan == 'SMS Banking') {
          var jenis = '';
        } else {
          var jenis = $('#jenis_2'+num).val();

        }

         console.log(chan);
         console.log(bank);
         // console.log(pro);
         console.log(transaksi);
         console.log(os);
         console.log(jenis);



         $('#label_td_list'+num).empty();
         
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
                 text += '<td><center><input type="number" name="td_step' + coba[i]['step'] + '" id="value_td' + coba[i]['step'] +num+'" step="0.01" value="0.00" placeholder="0.00" class="form-control value_td" onchange="ubahNilai('+num+')"></center></td>';
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
               text += '<input type="text" class="form-control" id="total_td'+num+'" name="total_td" value="" readonly>';
               text += '<input type="hidden" class="form-control" id="baris_td'+num+'" name="baris_td" value="' + coba.length + '" readonly>';
               text += '<input type="hidden" class="form-control" id="versi_td" name="versi_td" value="' + coba[0]['versi'] + '" readonly>';
               text += '</div>';


               $('#label_td_list'+num).append(text);
               // document.getElementById('test_td').style.display = 'block';
             } else {
               text += '<div><h5><b>Step-step transaksi belum tersedia untuk bank, channel dan jenis transaksi yang Anda pilih. Harap hubungi RA untuk membuat step transaksinya.</b></h5></div>';
               $('#label_td_list'+num).append(text);

             }


           }
         });
       }

       function gantiPercobaan(num) {
        var percobaan = $('#percobaan_ke'+num).val();

           console.log(percobaan);
           $('#inline_ket'+num).empty();
           var text = '';
           if (percobaan > 1) {
             for (i = 1; i < percobaan; i++) {
               text += `<label>Keterangan Gagal Percobaan Ke-` + i + `</label>&nbsp;
                                <input type="text" class="form-control" name="ket_percobaan[]"><br>`;
             }
             $('#inline_ket'+num).append(text);
           }


       }

       function ubahNilai(num) {
          var baris = $('#baris_td'+num).val();
         var sum = 0;
         for (var i = 1; i <= baris; i++) {

           var nilai = $('#value_td' + i+num).val();

           sum += +nilai;
         }

         console.log(sum.toFixed(2));
         $('#total_td'+num).val(sum.toFixed(2));

       }

      
  </script>
