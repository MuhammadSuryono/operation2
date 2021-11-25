    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery</h3>
        <div class="row mt">
          <div class="col-lg-12">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
            

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Report Time Delivery </strong></h4>
                        
                    <div class="row">
                      <div class="form-group">

                        <div class="col-md-3 mb">
                          <input type="text" name="project" class="form-control" value="<?= $row_data['nama_project'] ?>" readonly>
                        </div>
                              
                        <div class="col-md-3 mb">
                          <input type="text" name="kunjungan" class="form-control" value="<?= $row_data['nama_skenario'] ?>" readonly>
                        </div>
  
                        <div class="col-md-3 mb">
                          <section id="s_cbg_tdedit">
                          <input type="text" name="cabang" class="form-control" value="<?= $row_data['nama_cabang'] ?>" readonly>
                          </section>
                        </div>
                        
                        
                        
                    <section id="dataTables_edittd">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-row">
                            <div class="col-md-2 mb">
                              <label>Last Update </label>
                              <input class="last_update form-control" name="last_update" id="last_update" value="<?= date('d/m/Y', strtotime($row_data['tanggal_revisi'])) ?>" readonly>
                            </div>
                            <div class="col-md-2 mb">
                              <label>User Update </label>
                              <input class="user_update form-control" name="user_update" id="user_update" value="<?= $row_data['user_revisi']." - ".$row_data['nama_user'] ?>" readonly>
                            </div>
                            <div class="col-md-3 mb">
                              <label>Alasan Revisi </label>
                              <textarea class="form-control" name="alasan" id="alasan" readonly><?= $row_data['alasan_revisi'] ?></textarea>
                            </div>
                            <div class="col-md-2 mb">
                              <label>Revisi RA </label>
                              <input class="full form-control" name="full" id="full" value="<?= $row_data['revisi_ra'] ?>" readonly>
                            </div>
                            <div class="col-md-1 mb">
                              <label></label><br>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editRA">Edit</button>
                          
                            </div>
                          </div>
                        </div>
                      </div>
                    <div class="row">
                        <div class="col-lg-12">
                          <div class="form-row">
                            <div class="col-md-3 mb">
                              <label>Kapan isi form </label>
                                 <input class="kapan_isi_form form-control" name="kapan_isi_form" id="kapan_isi_form" value="<?= $row_data['kapan_isi_form'] ?>" readonly>
                                </div>
                            <div class="col-md-3 mb">
                              <label>Jenis form </label>
                              <input class="jenis_form form-control" name="jenis_form" id="jenis_form" value="<?= $row_data['jenis_form'] ?>" readonly>
                            </div>
                            <div class="col-md-3 mb">
                              <label>Kondisi Pengisian </label>
                              <input class="selesai_isi_form form-control" name="selesai_isi_form" id="selesai_isi_form" value="<?= $row_data['kondisi_pengisian'] ?>" readonly>
                            </div>
                            <div class="col-md-3 mb">
                              <div class="col-md-6">
                              <label>TD Full </label>
                              <input class="full form-control" name="full" id="full" value="<?= $row_data['full'] ?>" readonly>
                              </div>
                              <div class="col-md-6">
                              <label></label><br>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editmedia">Edit Jenis Form</button>
                          
                            </div>
                            </div>
                            
                            
                          </div>
                        </div>

                        <div class="col-lg-12"> 
                            <div class="form-row">
                              
                              <div class="col-md-1 md">
                                 <label>No </label>
                                 <?php $no1 = 0;
                                        foreach ($report_td as $td1) {
                                      $no1++;
                                  ?>
                                   <input class="id_waktu form-control" name="number" id="number" value="<?= $no1; ?>" readonly>
                                    <input type="hidden" name="id_waktu<?= $no1; ?>" id="id_waktu<?= $no1; ?>" value="<?= $td1['id_waktu']; ?>" readonly>
                                         <br>
                                 <?php } ?>
                                 </div>

                                 <div class="col-md-3 md">
                                 <label>Proses </label>
                                 <?php $no2 = 0;
                                        foreach ($report_td as $td2) {
                                      $no2++;
                                  ?>
                                   <input class="proses form-control" name="proses" id="proses" value="<?= $td2['proses']  ?>" readonly>
                                    <br>
                                 <?php } ?>
                                 </div>

                                 <div class="col-md-5 md">
                                 <label>Keterangan Proses </label>
                                 <?php $no3 = 0;
                                        foreach ($report_td as $td3) {
                                      $no3++;
                                  ?>
                                   <input class="ket_interupsi form-control" name="ket_interupsi" id="ket_interupsi" value="<?= $td3['ket_interupsi']  ?>" readonly>
                                    <br>
                                 <?php } ?>
                                 </div>

                                 <div class="col-md-3 md">
                                 <div class="col-md-6">
                                 <label>Start TD </label>
                                 <?php $no4 = 0;
                                        foreach ($report_td as $td4) {
                                      $no4++;
                                  ?>
                                   <input class="start_waktu form-control" name="start_waktu" id="start_waktu" value="<?= $td4['timestamp']  ?>" readonly>
                                    <br>
                                 <?php } ?>
                                 </div>

                                 <div class="col-md-6">
                                 <label>Durasi </label>
                                 <?php $no5 = 0;
                                        foreach ($report_td as $td5) {
                                      $no5++;
                                  ?>
                                   <input class="waktu form-control" name="waktu" id="waktu" value="<?= $td5['waktu']  ?>">
                                    <br>
                                 <?php } ?>
                                 </div>
                               </div>

                                <!--  <div class="col-md-1 mb">


                                </div> -->

                            </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-row">
                            <div class="col-md-10 mb" align="right">
                                <label for=""> <strong> Akhir TD Burek </strong> </label>
                            </div>
                            <div class="col-md-2 mb">
                                <input type="text" class="form-control" name="akhirburek" id="akhirburek" value="<?= $row_data['akhir_td'] ?>" readonly>
                            </div>
                            <div class="col-md-1 mb">
                            <a></a>
                            </div>
                          </div>
                        </div>
                      </div>

                    <?php  if ($row_data['part_1'] !== NULL AND $row_data['part_1'] !== '00:00:00') { ?>
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-row">
                          <div class="col-md-10 mb" align="right">
                              <label for=""> <strong> Durasi Part 1 </strong> </label>
                          </div>
                          <div class="col-md-1 mb">
                              <input type="text" class="form-control" name="akhirburek" id="akhirburek" value="<?= $row_data['part_1'] ?>" readonly>
                          </div>
                          <div class="col-md-1 mb">
                          <a></a>
                          </div>
                        </div>
                      </div>
                    </div>
                      <?php } ?>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-row">
                            <div class="col-md-10 mb" align="left">
                                <label for=""> <strong> Temuan </strong> </label>
                                <input type="text" class="form-control" name="temuan" id="temuan" value="<?= $row_data['temuan'] ?>" readonly>
                            </div>
                            <div class="col-md-12 mb">
                            <a></a>
                            </div>
                          </div>
                        </div>
                      </div>

                      
                    </section>



                      </div>
                    </div>


                  </div>
              </div>
          </div>



          </div>
        </div>
            <!-- Modal -->

</div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!-- Modal -->
<div class="modal fade" id="editRA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Revisi TD Full</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('time/edittd_RA') ?>" method="POST">
        <input type="hidden" name="project" class="form-control" value="<?= $project ?>">
        <input type="hidden" name="skenario" class="form-control" value="<?= $skenario ?>">
        <input type="hidden" name="cabang" class="form-control" value="<?= $cabang ?>">

      <div class="modal-body">
        <div class="form-group">
          <label>TD Full</label>
          <input type="text" name="total_td" class="form-control" placeholder="00:00:00">
        </div>
        <div class="form-group">
          <label>Alasan Revisi</label>
          <textarea class="form-control" name="alasan_revisi"></textarea>
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



<div class="modal fade" id="editmedia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Revisi Jenis Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('time/editmedia_RA') ?>" method="POST">
        <input type="hidden" name="project" class="form-control" value="<?= $project ?>">
        <input type="hidden" name="skenario" class="form-control" value="<?= $skenario ?>">
        <input type="hidden" name="cabang" class="form-control" value="<?= $cabang ?>">

      <div class="modal-body">
        <div class="form-group">
          <label>Jenis Form</label>
          <input type="text" name="jenis_form" class="form-control" value="<?= $row_data['jenis_form'] ?>">
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
    <!--main content end-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });


  $(document).ready(function() {
                     var max_fields      = 100; //maximum input boxes allowed
                     var wrapper     = $(".input_row"); //Fields wrapper
                     var add_button      = $(".add"); //Add button ID


                     // var nomor = document.getElementById('nomor').value;
                     
                     var x = 1; //initlal text box count
                     $(add_button).click(function(e){ //on add input button click
                      e.preventDefault();

                      if(x < max_fields){ //max input box allowed

                      var cobaah = "";
                      // nomor++;


                      
                       cobaah += "<tr class='py-3'>";
                       cobaah += "<input type='hidden' id='id_label' name='id_label[]' value='null';>";
                       cobaah += " <td><input type='text' id='step_td' name='step_td[]' class='form-control' placeholder='step ke-'></td>";
                       cobaah += " <td><input type='text' id='label_td' name='label_td[]' class='form-control' placeholder='label'></td>";
                       cobaah += " <td><input type='text' id='versi_td' name='versi_td[]' class='form-control' placeholder='versi'></td>";
                       cobaah += "<td><center>";
                       cobaah += "<a href='#' class='btn btn-danger remove_field' title='Delete'><i class='fas fa-trash-alt'></i></a>"
                       cobaah += "</center></td>";
                       cobaah += " </tr>";
                       
                       
                       
                       x++; //text box increment
                       $(wrapper).append(cobaah); //add input box
                     }

                      });
 
                     $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                      e.preventDefault(); $(this).closest('tr').remove(); x--;
                     })
                    });
</script>