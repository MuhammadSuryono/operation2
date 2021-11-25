    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Time Delivery E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row">
              <div class="col-lg-12">
                  <div class="form-panel">
                        <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Skenario </strong></h4>
                        <form class="form-horizontal style-form" method="post" action="<?= base_url('time/tambah_ebanking')?>">
                            
                            <!-- <input type="hidden" class="form-control" name="project" id="project" value="<?=$project?>"> -->
                            <input type="hidden" class="form-control" name="bank" id="bank" value="<?=$bank?>">
                            <input type="hidden" class="form-control" name="channel" id="channel" value="<?=$channel?>">
                            <input type="hidden" class="form-control" name="transaksi" id="transaksi" value="<?=$transaksi?>">
                            <input type="hidden" class="form-control" name="os" id="os" value="<?=$os?>">
                            <input type="hidden" class="form-control" name="jenis" id="jenis" value="<?=$jenis?>">
                            
                            <?php if ($hasilcek != NULL) {

                              $result = [
                                        'bank' => $bank, 'channel' => $channel, 'transaksi' => $transaksi, 'os' => $os, 'jenis' => $jenis
                                      ];
                              $label = $this->db->order_by('versi', 'ASC')->order_by('step', 'ASC')->get_where('ebanking_data_td', $result)->result_array();
                                         echo '<script>alert("Time Delivery tersebut sudah dibuat. Jika Anda melanjutkan artinya Anda membuat versi terbaru!")</script>';
                            $ver = $hasilcek['versi'] + 1;
                            ?>
                            <div class="row">
                            <div class="col-sm-1"><h5><b>Versi</b></h5></div>
                            <div class="col-sm-1"><input type="text" class="form-control" name="versi" id="versi" value="<?php echo $ver ?>" readonly></div>
                            <div class="col-sm-2"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#show_label">Lihat Versi</button></div>
                            
                            </div>
                            <br>
                            <?php
                            } else {
                              ?>
                            <input type="hidden" class="form-control" name="versi" id="versi" value="1">

                          <?php } ?>
                            
                            
                            <section id="pil">
                            <div class="form-group">
                            <label class="col-sm-2 control-label"> Step 1 </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="td_eb1" id="td_eb1">
                            </div>
                            </div>
                            </section>
                            <section id="jmlpilihan"><input type="hidden" class="form-control" name="jmlpil" id="jmlpil" value="1"></section>
                            <a class="btn btn-round btn-primary" id="addpil_eb">Tambah Pilihan</a>
                            <?php if ($hasilcek == NULL) { ?>
                            <button type="submit" class="btn btn-round btn-success pull-right" >Simpan</button>
                          <?php } else { ?>
                            <button type="button" data-toggle="modal" data-target="#confirm_save" class="btn btn-round btn-success pull-right" >Simpan</button>

                            <div class="modal fade" id="confirm_save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <strong>Pastikan semua data sudah terinput dengan versi lama, lanjutkan Update atau Batal?</strong>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-success">Update</button>
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          
                          <?php } ?>
                            <a href="<?=base_url('time/index_ebanking')?>" class="btn btn-round btn-danger pull-right mr" >Batal</a>
                          
                        </form>
                  </div>
              </div>
          </div>



          </div>
        </div>
            <!-- Modal -->
<div class="modal fade" id="show_label" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Versi TD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form  action="<?= base_url('time/edittd_ebanking')?>" method="POST">
         <!-- <input type="hidden" class="form-control" name="project" id="project" value="<?=$project?>"> -->
         <input type="hidden" class="form-control" name="bank" id="bank" value="<?=$bank?>">
         <input type="hidden" class="form-control" name="channel" id="channel" value="<?=$channel?>">
         <input type="hidden" class="form-control" name="transaksi" id="transaksi" value="<?=$transaksi?>">
         <input type="hidden" class="form-control" name="os" id="os" value="<?=$os?>">
         <input type="hidden" class="form-control" name="jenis" id="jenis" value="<?=$jenis?>">
      <div class="modal-body">
       
        <table class="table">
          <thead>
            <tr>
              <th width="70px"><center>Step</center></th>
              <th><center>Label</center></th>
              <th width="70px"><center>Versi</center></th>
              <th><center>Aksi Delete</center></th>
            </tr>
          </thead>
          <tbody class="input_row">
              <?php foreach ($label as $row) :

            $this->db->select('*');
            $this->db->from('ebanking');
            // $this->db->where('project', $row['project']);
            $this->db->where('bank', $row['bank']);
            $this->db->where('channel', $row['channel']);
            $this->db->where('transaksi', $row['transaksi']);
            if ($channel == 'Mobile Banking' OR $channel == 'Internet Banking') {
            $this->db->where('jenis', $row['jenis']);
            }
            if ($channel == 'Mobile Banking' OR $channel == 'SMS Banking') {
            $this->db->where('os', $row['os']);
            }
            $this->db->where('versi_label', $row['versi']);
        
            $aksi = $this->db->get()->result_array();
            // var_dump($aksi);
            if ($aksi == NULL) {
                    
                ?>
                <tr>
                  <input type="hidden" name="id_label[]" value="<?php echo $row['id'] ?>">
                  <td><center><input type="text" name="step_td[]" class="form-control" value="<?php echo $row['step']; ?>"></center></td>
                  <td><center><input type="text" name="label_td[]" class="form-control" value="<?php echo $row['label']; ?>"></center></td>
                  <td><center><input type="text" name="versi_td[]" class="form-control" value="<?php echo $row['versi']; ?>" readonly></center></td>
                  <td><center><input type="checkbox" name="delete_id[]" value="<?php echo $row['id']; ?>"></center></td>
                  
                </tr>
              <?php } else { ?>
                <tr>
                  <input type="hidden" name="id_label[]" value="<?php echo $row['id'] ?>">
                  <td><center><input type="text" name="step_td[]" class="form-control" value="<?php echo $row['step']; ?>" readonly></center></td>
                  <td><center><input type="text" name="label_td[]" class="form-control" value="<?php echo $row['label']; ?>" readonly></center></td>
                  <td><center><input type="text" name="versi_td[]" class="form-control" value="<?php echo $row['versi']; ?>" readonly></center></td>
                  <td><center><input type="checkbox" name="delete_id[]" value="<?php echo $row['id']; ?>" onclick="return false;"></center></td>
                  
                </tr>

              <?php }
               endforeach; ?>
            </tbody>
          
        </table>
        <div class="row">
          <div class="col-sm-6 text-left">
            <button type="button" class="btn btn-primary add">Add Row</button>
          </div>
        <div class="col-sm-6 text-right">
          <button type="submit" class="btn btn-warning" name="update_td"> <i class="fas fa-edit"></i> Update</button>
          <button type="submit" class="btn btn-danger" name="hapus_td"> <i class="fas fa-trash-alt"></i> Delete</button>
        </div>
      </div>
      </form>
      </div>

      <div class="modal-footer">
        <div class="text-left">
        <span class="bg-info p-1"><b>NOTE!</b></span>&nbsp;&nbsp;Jika label tidak dapat di edit dan di delete maka versi tersebut sudah pernah digunakan untuk aktual!
      </div>
        <button type="button" class="btn" data-dismiss="modal" style="background-color:     #8FBC8F; color: white;">Close</button>
       
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
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