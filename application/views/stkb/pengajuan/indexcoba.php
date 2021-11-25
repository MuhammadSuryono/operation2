<?php
            $id_user = $this->session->userdata('id_user');
            // var_dump($id_user); die;
            if($this->db->get_where('user', ['noid' => $id_user])->num_rows()>=1){
              $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
              $nama = $user['name'];
            } else {
              $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
              $nama = $user['Nama'];
            }
?>
<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> STKB</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> STKB Pengajuan </strong> </h4>
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

            <section id="unseen">

              <ul onclick="aktif()" class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#term1">Cek Pengajuan Term 1</a></li>
                <li><a data-toggle="tab" href="#term2">Cek Pengajuan Term 2</a></li>
                <li><a data-toggle="tab" href="#term3">Cek Pengajuan Term 3</a></li>
                <li><a data-toggle="tab" href="#menu1">Ready To Paid</a></li>
                <li><a data-toggle="tab" href="#menu2">Paid</a></li>
              </ul>

          <div class="tab-content">
              <!-- Term 1 -->
              <div id="term1" class="tab-pane fade in active">
                <div class="table-responsive">
                <form action="<?php echo base_url('stkb/readytopaid')?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="pengklik" value="<?php echo $this->session->userdata('id_user'); ?>">
                <table class=" table table-bordered table-striped table-condensed">
                  <thead>
                      <tr>
                        <th>No.</th>
                        <th>Nomor Stkb</th>
                        <th>Term</th>
                        <th>Tanggal Buat</th>
                        <th>Tanggal Mulai</th>
                        <th>Project</th>
                        <th>Nama</th>
                        <th>Perdin</th>
                        <th>Akomodasi</th>
                        <th>Bpjs</th>
                        <th>Jumlah RTP (OPS)</th>
                        <th>Jumlah RTP (TRK)</th>
                        <th>Total</th>
                        <th>Cek</th>
                        <th>Print</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                        $no = 1;
                        $totalterm13 = 0;
                        $data = json_decode($getpengajuan, true);
                        foreach ($data['data'] as $key) :
                         $totalnya = $key['jumlahops'] + $key['jumlahtrk'] + $key['perdin'] + $key['akomodasi'] + $key['bpjs'];
                         $totalterm13 += $totalnya;
                         ?>
                         <tr>
                          <td><?php echo $no; ?></td>
                          <td><?php echo $key['nmrstkb'] ?><input type="hidden" name="nomorstkb<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['nmrstkb'] ?>"></td>
                          <td><?php echo $key['termnya'] ?><input type="hidden" name="term<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['termnya'] ?>"></td>
                          <td><?php echo $key['tanggalbuat'] ?><input type="hidden" name="tanggalbuat<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['tanggalbuat'] ?>"></td>
                          <td><?php echo $key['tglm'] ?></td>
                          <td><?php echo $key['kodeproject'] ?> - <?php echo $key['namaproject'] ?><input type="hidden" name="kodeproject<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['kodeproject'] ?>"></td>
                          <td><?php echo $key['idpic'] ?> - <?php echo $key['namapic'] ?><input type="hidden" name="idpic<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['idpic'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['perdin'], 0 , '' , ',' ); ?><input type="hidden" name="perdin<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['perdin']?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['akomodasi'], 0 , '' , ',' ); ?><input type="hidden" name="akomodasi<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['akomodasi']?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['bpjs'], 0 , '' , ',' ); ?><input type="hidden" name="bpjs<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['bpjs']?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['jumlahops'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahops<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['jumlahops'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $key['jumlahtrk'], 0 , '' , ',' ); ?><input type="hidden" name="jumlahtrk<?php echo $key['nmrstkb'] ?>" value="<?php echo $key['jumlahtrk'] ?>"></td>
                          <td><?php echo 'Rp. ' . number_format( $totalnya, 0 , '' , ',' ); ?><input type="hidden" name="total<?php echo $key['nmrstkb'] ?>" value="<?php echo $totalnya; ?>"></td>
                          <td><input type="checkbox" style="width: 30px" class="checkbox form-control" id="agree1" name="statusbayar[]" value="<?php echo $key['nmrstkb'] ?>" /></td>
                          <td><a href="<?php echo base_url(); ?>stkb/printstkb/<?php echo $key['nmrstkb']; ?>/<?php echo $key['termnya']; ?>" target="_blank"><i class="fa fa-print"></i> Print</a></td>
                        </tr>
                       <?php
                       $no++;
                      endforeach;
                        ?>
                  </tbody>
                </table>
                    <?php
                    // $totalops = 0;
                    // $totaltrk = 0;
                    // $totalperdin = 0;
                    // $totalakomodasi = 0;
                    // $totalbpjs = 0;
                    // foreach ($getpengajuan as $gp) {
                    //   $totalops += $gp['jumlahops'];
                    //   $totaltrk += $gp['jumlahtrk'];
                    //   $totalperdin += $gp['perdin'];
                    //   $totalakomodasi += $gp['akomodasi'];
                    //   $totalbpjs += $gp['bpjs'];
                    // }
                    // $totalseluruh = $totalops + $totaltrk + $totalperdin + $totalakomodasi + $totalbpjs;
                    ?>
                    <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2"><h3><?php echo 'Rp. ' . number_format( $totalterm13, 0 , '' , ',' ); ?></h3></div>
                    </div>
                    <div class="row">
                    <div class="col-md-9"></div>

                <?php if ($user['id_divisi'] == 7 or $user['id_divisi'] == 99) :?>
                    <div class="col-md-1 text-center">
                      <!-- <center><input type="checkbox" style="width: 30px" class="checkbox form-control" onclick="checkall1()" id="checkAll1" disabled /></center>
                      <label for="checkAll1">Check All</label> -->
                    </div>
                    <div class="col-md-2"><button type="submit" class="btn btn-lg btn-success">Move To RTP <i class="fas fa-angle-double-right"></i></button></div>
                <?php endif?>
                    </div>
                    </form>
                  </div>
              </div>
              <!-- //Term 1 -->

              <!-- Term 2 -->
              <input type="hidden" id="stateterm2" value="0">
              <div id="term2" class="tab-pane fade">

              </div>
              <!-- Term 2 -->


              <!-- Term 3 -->
              <input type="hidden" id="stateterm3" value="0">
              <div id="term3" class="tab-pane fade">

              </div>
              <!-- //TERM 3 -->


              <input type="hidden" id="statemenu1" value="0">
              <div id="menu1" class="tab-pane fade">

              </div>

              <input type="hidden" id="statemenu2" value="0">
              <div id="menu2" class="tab-pane fade">

              </div>
            </div>
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

    <div class="modal" id="bayarstkb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran STKB</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?php echo base_url('stkb/bayarstkb') ?>">
                        <input type="hidden" name="nomorstkb" id="nomorstkb">
                        <input type="hidden" name="pembayar" id="pembayar">
                        <input type="hidden" name="term" id="term">
                        <input type="hidden" name="statusbayar" value="Paid">

                        <div class="form-group">
                          <label>Total Akomodasi :</label>
                            <input type="number" id="akomodasi" name="akomodasi" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Total Perdin :</label>
                            <input type="number" id="perdin" name="perdin" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Total BPJS :</label>
                            <input type="number" id="bpjs" name="bpjs" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Aktual Bayar STKB OPS :</label>
                            <input type="number" id="ops" name="ops" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Aktual Bayar STKB TRK :</label>
                            <input type="number" id="trk" name="trk" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Total Bayar :</label>
                            <input type="number" id="totalnya" name="total" class="form-control form-control-user" readonly>
                        </div>

                        <div class="form-group">
                          <label>Tanggal Bayar :</label>
                            <input type="date" name="tanggalbayar" class="form-control form-control-user" required>
                        </div>

                        <div class="form-group">
                          <label>Nomor Voucher :</label>
                            <input type="text" name="novoucher" class="form-control form-control-user"  maxlength="4" placeholder="0000" required>
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="printstkb" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Print STKB</h4>
                  </div>
                  <div class="modal-body">
                      <div class="fetched-data"></div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                  </div>
              </div>
          </div>
      </div>

<script type="text/javascript">
function printstkb(nomorstkb,term){
  // alert(nomorstkb);
  $.ajax({
      type : 'post',
      url  : '<?php echo base_url('stkb/printstkb')?>',
      data :  {nomorstkb:nomorstkb, term:term},
      success : function(data){
        $('.fetched-data').html(data);//menampilkan data ke dalam modal
        $('#printstkb').modal();
      }
  });
}

//NEW BY ADAM SANTOSO
 function checkall1(){
  if($("#checkAll1").prop("checked") == true){
    $('input:checkbox[id^="agree1"]').prop('checked', true);
  }else if($("#checkAll1").prop("checked") == false){
    $('input:checkbox[id^="agree1"]').prop('checked', false);
  }
 }
 function checkall2(){
  if($("#checkAll2").prop("checked") == true){
    $('input:checkbox[id^="agree2"]').prop('checked', true);
  }else if($("#checkAll1").prop("checked") == false){
    $('input:checkbox[id^="agree2"]').prop('checked', false);
  }
 }
 function checkall3(){
  if($("#checkAll3").prop("checked") == true){
    $('input:checkbox[id^="agree3"]').prop('checked', true);
  }else if($("#checkAll1").prop("checked") == false){
    $('input:checkbox[id^="agree3"]').prop('checked', false);
  }
 }

 function aktif(){
   var stateTab = 'state'+$("#nav li a").context.activeElement.hash.replace('#','');
   var tab = $("#nav li a").context.activeElement.hash;

   if($('#'+stateTab).val() == '0' && tab != '#term1'){
     $(tab).empty().html("<div class='text-center' id='loading' style='margin:50px 50px;font-size:16px;'><i class='fas fa-spinner fa-spin'></i> Sedang mengambil data</div>");
     $.ajax({
        type : 'post',
        url  : '<?= base_url('stkb/getAllDataTabByAdam');?>',
        data :  {data:tab},
        success : function(data){
         $(tab).empty().html(data);
         $('#'+stateTab).val('1');
        },
        error: function(jqXHR,error, errorThrown) {
          $(tab).empty().html("<div class='text-center' id='loading' style='margin:50px 50px;font-size:16px;'><i class='fas fa-close'></i> Gagal mengambil data<br><span style='font-size:14px;'>Silahkan ulangi dengan klik pada menu tab yang anda pilih</span></div>");
        }
     });
   }
 }

</script>
