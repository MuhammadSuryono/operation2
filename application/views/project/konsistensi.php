<?php
$id_divisi = $this->session->userdata('id_divisi');
?>
<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data Konsistensi Non Skill MS B1</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Non Skill </strong></h4>
                <!-- <a href="<?= base_url('project/tambah')?>" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Tambah</a> -->
                
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#datahost">Data Host</button> -->
                    <?php if($id_divisi == '99') { ?>
                    <a href="<?= base_url('project/datahost') ?>" class="btn btn-primary">Data Host</a>
                    <?php } ?>
                    <a href="<?= base_url('project/listquery') ?>" class="btn btn-warning">Data List Query</a>
                    <a href="<?= base_url('project/kelompokquery') ?>" class="btn btn-info">Data Kelompok Query</a>
                </div>
                <br>
                <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">

                
                <section id="unseen">
                  <!-- <form action="" method="POST" enctype="multipart/form-data"> -->
                  <div class="row">
                    
                    
                  </div>
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                    <form action="<?= base_url('project/add_listquery') ?>" method="POST" enctype="multipart/form-data">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#daftarkan" aria-expanded="true" aria-controls="collapseOne">
                            Daftarkan Query <i class="fas fa-arrow-circle-down"></i>
                          </a>
                        </h4>
                      </div>
                      <div id="daftarkan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                           <div class="row">
                           <div class="col-lg-4">
                              <div class="form-group">
                                <label><h5><b>Query</b></h5></label>
                                <button type="button" class="btn btn-info btn-xs btn-round" data-html="true" data-toggle="popover" data-placement="top" title="<b>Contoh Query</b>" data-content="SELECT serial, code, cabang, z3, <b>[Variable]</b> AS kode FROM <b>[Data/Table]</b> WHERE <b>[Condition]</b>">Example</button>
                                <textarea rows="5" class="form-control query" name="query" style="resize: none;"></textarea>

                              </div>
                            </div>
                            <div class="col-lg-2">
                              <div class="form-group">
                                <label><h5><b>Variable</b></h5></label>
                                <input class="form-control variable" name="variable">
                              </div>
                            </div>
                            <!-- <div class="col-lg-2">
                              <div class="form-group">
                                <label><h5><b>Kode</b></h5></label>
                                <input class="form-control kode" name="kode">
                              </div>
                            </div> -->
                            <div class="col-lg-4">
                              <div class="form-group">
                                <label><h5><b>Keterangan Check</b></h5></label>
                                <input class="form-control check" name="check">
                              </div>
                            </div>
                            <div class="col-lg-2">
                              <div class="form-group">
                                <label><h5><b>Kategori</b></h5></label>
                                <select class="form-control" name="kategori">
                                  <option value="">Pilih Kategori</option>
                                  <option value="CS">CS</option>
                                  <option value="Teller">Teller</option>
                                </select>
                              </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-2">
                              <div class="form-group">
                                <input type="submit" name="submit" value="Simpan" class="btn btn-success">
                                
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  </div>

                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="panel panel-default" style="margin-top: 20px;">
                      <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Multiple Query <i class="fas fa-arrow-circle-down"></i>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                           <div class="row">
                            <div class="col-lg-2">
                      <div class="form-group">
                        <label><h5><b>Hostname</b></h5></label>
                        <select class="form-control selectpicker hostname" data-live-search="true" name="hostname" id="hostname" required>
                          <option value="">Pilih Host</option>
                          <?php foreach ($host as $row) {
                            ?>
                            <option value="<?= $row['hostname'] ?>"><?= $row['nama'] ?></option>
                          <?php } ?>
                        </select>

                      </div>
                    </div>

                    <div class="col-lg-2">
                      <div class="form-group">
                        <label><h5><b>Pilih Data</b></h5></label>
                        <select class="form-control selectpicker" data-live-search="true" name="dba" id="dba" required>
                          <option value="">Pilih Data</option>
                          <?php foreach ($database as $db) {
                            ?>
                            <option value="<?= $db['Database'] ?>"><?= $db['Database'] ?></option>

                          <?php } ?>
                        </select>

                      </div>
                    </div>
                    <input type="hidden" name="project_name" id="project_name">
                  <div class="col-lg-12">
                    <div class="table-responsive">
                      <!-- <div class="form-group" id="div_query">
                                          <label><h5><b>Select Query</b></h5></label>
                                            <button id="add_row" type="button" class="btn btn-warning" onclick="addRow2()">Add Query Options</button>
                                            <?php $no = 1; ?>
                                            <input type="hidden" id="numb" value="<?= $no ?>">
                        </div> -->
                        <div class="form-group" id="div_query">
                                          <label><h5><b>Pilih Kelompok Query</b></h5></label>
                                            <select class="form-control" name="kelompok" id="kelompok" onchange="changeKelompok(this.value)">
                                              <option value="">--Pilih Kelompok Query--</option>
                                              <?php foreach ($group_query as $key) {
                                                ?>
                                              <option value="<?= $key['kd_group'] ?>"><?= $key['nama_group'] ?></option>
                                              <?php } ?>
                                            </select>
                                            <?php $no = 1; ?>
                                            <input type="hidden" id="numb" value="<?= $no ?>">
                        </div>
                        <div class="form-group  col-lg-2">
                                          <label><h5><b>Target</b></h5></label>
                                            <input type="text" name="target" id="target" class="form-control" required>
                        </div>
                        <div class="form-group  col-lg-2">
                                          <label><h5><b>Kategori</b></h5></label>
                                            <input type="text" name="kategori" id="kategori" class="form-control" required readonly>
                        </div>
                      <table class="table">
                        <thead>
                          <tr>
                            <th width="70%"><center><b>Query</b></center></th>
                            <th><center></center></th>
                            <th><center><b>Jumlah Data Cek</b></center></th>
                            <th><center><b>Target</b></center></th>
                          </tr>
                        </thead>
                        <tbody id="tbody_data">
                          <!-- <tr>
                            <td>
                              <select class="form-control col-sm-12" name="pil_query[]" onchange="changeQuery(this.value,<?= $no ?>)" >
                                            <option value="">Pilih Query</option>
                                            <?php foreach ($query as $q) {
                                              ?>
                                              <option value="<?= $q['query'] ?>"><?= $q['query'] ?></option>
                                              <?php } ?>
                              </select>
                            </td>
                            <td></td>
                            <td id="jumlah<?= $no ?>"></td>
                            <td id="target<?= $no ?>"></td>
                          </tr> -->
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                                      
                                    </div>
                                    <div class="row">
                            <div class="col-lg-2">
                              <div class="form-group">
                                <input type="submit" name="show_data" class="btn btn-primary" value="Show" style="margin-top: 10px;">
                                
                              </div>
                            </div>
                        </div>
                                    <div>
                        </div>
                      </div>
                    </div>
                  </div>
                 
                    <!-- <input type="submit" name="show_data" class="btn btn-primary" value="Show" style="margin-top: 10px;"> -->
                  </div>
                            <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">
                  
                </form>

                <?php
                if (isset($_POST['show_data'])) {
                  $query = $_POST['query'];
                  $where = $_POST['where'];
                  // $project = $_POST['project'];
                  $dba = $_POST['dba'];
                  $modif = $_POST['modif'];
                  $hostname = $_POST['hostname'];
                  $project_name = $_POST['project_name'];
                  $variable = $_POST['variable'];
                  $kode = $_POST['kode'];
                  $check = $_POST['check'];

                  $multi = $_POST['pil_query'];



                  $host = $this->db->get_where('datahost', ['hostname' => $hostname])->row_array();
                  // var_dump($hostname);

                  $db_dinamis = [
                                  'dsn' => '',
                                  'hostname' => $host['hostname'],
                                  'username' => $host['username'],
                                  'password' => $host['password'],
                                  'database' => 'mys_db'.$dba,
                                  'dbdriver' => 'mysqli',
                                  'dbprefix' => '',
                                  'pconnect' => FALSE,
                                  'db_debug' => (ENVIRONMENT !== 'production'),
                                  'cache_on' => FALSE,
                                  'cachedir' => '',
                                  'char_set' => 'utf8',
                                  'dbcollat' => 'utf8_general_ci',
                                  'swap_pre' => '',
                                  'encrypt' => FALSE,
                                  'compress' => FALSE,
                                  'stricton' => FALSE,
                                  'failover' => array(),
                                  'save_queries' => TRUE
                                ];

                  $dbnya = $this->load->database($db_dinamis, TRUE);

                  
                  if($multi[0] == ''){
                    $full = $query." WHERE ".$where." ".$modif;
                  } else {
                    $full = implode(" UNION ALL ",$multi);
                    foreach ($multi as $row => $val) {
                      $jumlah = count($dbnya->query($val)->result_array());
                      $data = ['query' => $val,
                                'project' => $project_name,
                                'jumlah_data' => $jumlah,
                                'kd_group' => $_POST['kelompok'],
                                'target' => $_POST['target']
                              ];
                      // var_dump($data);
                      $recheck = $this->db->get_where('konsistensi_progress', ['query' => $val, 'project' => $project_name, 'kd_group' => $_POST['kelompok']])->row_array();
                      if($recheck == NULL){
                          $this->db->insert('konsistensi_progress', $data);
                      } else {
                          $this->db->update('konsistensi_progress', $data, ['num' => $recheck['num']]);
                      }
                    }
                  }
                  // var_dump($multi);
                  // }

                  $show = $dbnya->query($full)->result_array();
                  // var_dump($show);
                   $numColumns = count($show[0]);
                    $numRows = count($show);
                    $columnsNames = array_keys($show[0]);


                ?>
                <input type="hidden" id="query" value="<?= $query ?>">
                <input type="hidden" id="where" value="<?= $where ?>">
                <!-- <input type="hidden" id="project" value="<?= $project ?>"> -->
                <input type="hidden" id="hostname" value="<?= $hostname ?>">
                <input type="hidden" id="dba" value="<?= $dba ?>">
                <input type="hidden" id="modif" value="<?= $modif ?>">
                <input type="hidden" id="variable" value="<?= $variable ?>">
                <input type="hidden" id="kode" value="<?= $kode ?>">
                <input type="hidden" id="check" value="<?= $check ?>">




                <div class="table-responsive">
                  <form action="<?= base_url('project/save_konsistensi') ?>" method="POST">
                    <input type="hidden" name="kategori" class="form-control" value="<?= $_POST['kategori'] ?>">
                  <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="tables-konsistensi">
                    <thead>
                      <tr>
                          <th>No</th>
                          <th>Project</th>
                        <?php for ($i=0; $i <$numColumns ; $i++) {  ?>
                          <th><?= strtoupper($columnsNames[$i]) ?></th>
                       <?php } ?>


                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($show as $row) {   ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><input type="hidden" name="project_name" value="<?= $project_name ?>">
                            <?= $project_name ?></td>
                          <?php for ($i=0; $i <$numColumns ; $i++) { 
                            $name = strtoupper($columnsNames[$i]).$no; 
                             ?>

                          <td><input type="hidden" name="<?= $name ?>" value="<?= $row[$columnsNames[$i]] ?>">
                            <?= $row[$columnsNames[$i]] ?></td>
                          <?php } ?>

                        </tr>
                      <?php  $no++; } ?>
                    </tbody>
                  </table>
                </div>
                
                <input type="hidden" name="total_row" value="<?= $no-1 ?>">
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
              </form>
                <?php } ?>
                
                </section>
            </div>
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

<!-- Modal -->
<div class="modal fade" id="datahost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Data Host</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead >
              <tr>
                <th>No</th>
                <th>Hostname</th>
                <th>Username</th>
                <th>Password</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($host as $row) {
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $row['hostname'] ?></td>
                  <td><?= $row['username'] ?></td>
                  <td><?= $row['password'] ?></td>
                  <td></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


<script>

  $(document).ready(function() {
        $('[data-toggle="popover"]').popover();
    });


  $(document).ready(function() {
    var quer = $('#query').val();
    var where = $('#where').val();
    var project = $('#project').val();
    var dba = $('#dba').val();
    var modif = $('#modif').val();
    var hostname = $('#hostname').val();
    var variable = $('#variable').val();
    var kode = $('#kode').val();
    var check = $('#check').val();

    
    $('.query').val(quer);
    $('.where').val(where);
    $('.modif').val(modif);
    $('.query').val(quer);
    $('.kode').val(kode);
    $('.variable').val(variable);
    $('.check').val(check);


    // $('.project').val(project);

    $('select[name=project]').val(project);
    $('.selectpicker').selectpicker('refresh');

    $('select[name=hostname]').val(hostname);
    $('.selectpicker').selectpicker('refresh');

    $('select[name=dba]').val(dba);
    $('.selectpicker').selectpicker('refresh');


     $('#dba').change(function(){
      var project = $( "#dba option:selected" ).text();
      $('#project_name').val(project);
     });
  });

// $(document).ready(function() {
   function addRow2()
  {
    $('#numb').val(parseInt($('#numb').val())+1);

     numb = parseInt($('#numb').val());
    $.ajax({
               url: "<?= base_url('project/get_listquery') ?>",
               type: "POST",
               dataType: 'json',
               data: {

               },
               success: function(hasil) {
                 console.log(hasil);
                 var ht = ``;
                 ht += `<tr>`;
                 ht += `<td>`;
                 ht +=  `<select class="form-control" id="trselect" name="pil_query[]" onchange="changeQuery(this.value,`+numb+`)">`;
                  ht +=      `<option value="">Pilih Query</option>`;
                    for (var i = 0; i < hasil.length; i++) {
                      ht += `<option value="`+hasil[i]['query']+`">`+hasil[i]['query']+`</option>`;
                    }
                    ht += `</select></td>
                    <td class="col-lg-1"><a href='#' class='btn btn-danger remove_field' title='Delete'><i class='fas fa-trash-alt'></i></a></td>
                    <td id="jumlah`+numb+`"></td>
                    <td id="target`+numb+`"></td>
                    </tr>
                    `;
                    console.log(ht);
                    // console.log($('.selectnya'));
                    $('#tbody_data').append(ht);
                    // $('#trselect').selectpicker('refresh');
                  
               }
             });
  }

  $('#tbody_data').on("click", ".remove_field", function(e) { //user click on remove text
           e.preventDefault();
           $(this).closest("tr").remove();
    
         })
       // });

  function changeQuery(value, numb)
  {
    var project = $('#dba option:selected').text();
    // console.log(value);
    // console.log(numb);
    console.log(project);
                  $('#jumlah'+numb).empty();
                  $('#target'+numb).empty();
  if (project == 'Pilih Data') {
                  $('#jumlah'+numb).append('<b>Data/Project Belum Dipilih</b>');
                  $('#target'+numb).append('<b>Data/Project Belum Dipilih</b>');
                } else {
    $.ajax({
               url: "<?= base_url('project/get_progressquery') ?>",
               type: "POST",
               dataType: 'json',
               data: {
                  query: value,
                  project: project
               },
               success: function(hasil) {
                 console.log(hasil);

                 if(hasil.length > 0) {
                  $('#jumlah'+numb).append('<center><b>'+hasil[0]['jumlah_data']+'</b></center>');
                  $('#target'+numb).append('<center><b>'+hasil[0]['target']+'</b></center>');
                 } else {
                  $('#jumlah'+numb).append('<center><b>-</b></center>');
                  $('#target'+numb).append('<center><b>-</b></center>');
                 }

               }
             });
  }

  }

  function changeKelompok(kd_group)
  {
    // var kd_group = $(this).val();
    var project = $('#dba option:selected').text();

    $('#tbody_data').empty();
    $.ajax({
               url: "<?= base_url('project/get_kelompok') ?>",
               type: "POST",
               dataType: 'json',
               data: {
                kd_group : kd_group,
                project: project
               },
               success: function(response) {

                 console.log(response);
                 console.log(response['target']);

                 var ht = ``;
                 for (var i = 0; i < response['kelompok'].length; i++) {

                  var tmp;
                  $.ajax({
                     url: "<?= base_url('project/getprogress_query') ?>",
                     type: "POST",
                     async: false,
                     dataType: 'json',
                     data: {
                       query: response['kelompok'][i]['listquery'],
                       project : project,
                       kd_group: kd_group
                     },
                     // success : bar_persen
                     success: function(data) {
                          tmp = data;
                          console.log(tmp);                    
                     }
                   });
                 ht += `<tr>`;
                 ht += `<td>`+response['kelompok'][i]['listquery']+`</td>
                    <td></td>`;
                
                if (tmp != null) {
                      ht +=   `<td><center>`+tmp['jumlah_data']+`</center></td>
                                <td><center>`+tmp['target']+`</center></td>`;
                        } else {
                          ht +=   `<td><center> - </center></td>
                                <td><center> - </center></td>`;
                        }
                 ht +=   `</tr>
                       <input type="hidden" class="form-control" name="pil_query[]" value="`+response['kelompok'][i]['listquery']+`">
                    `;
                  }
                    console.log(ht);
                    // console.log($('.selectnya'));
                    $('#tbody_data').append(ht);
                    $('#kategori').val(response['kelompok'][0]['kategori']);
                    // $('#trselect').selectpicker('refresh');
                    if (response['target'].length > 0) {
                        $('#target').val(response['target'][0]['target']);
                    } else {
                        $('#target').val('');
                    }
               }
             });
  }
</script>


























<!-- 
<div class="col-lg-12">
                                        <div class="form-group" id="div_query">
                                          <label><h5><b>Select Query</b></h5></label>
                                            <button id="add_row" type="button" class="btn btn-warning" onclick="addRow2()">Add Query Options</button>
                                            <?php $no = 1; ?>
                                            <input type="hidden" id="numb" value="<?= $no ?>">
                                      
                                         <div class="row">
                                           <div class="col-lg-9"><center><b>Query</b></center></div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-1"><center><b>Jumlah Data Cek</b></center></div>
                                            <div class="col-lg-1"><center><b>Target</b></center></div>
                                         </div>
                                         <div class="row">
                                           <div class="col-lg-9">
                                             <select class="form-control-lg selectpicker col-sm-12" name="pil_query[]" onchange="changeQuery(this.value,<?= $no ?>)" data-live-search="true">
                                            <option value="">Pilih Query</option>
                                            <?php foreach ($query as $q) {
                                              ?>
                                              <option value="<?= $q['query'] ?>"><?= $q['query'] ?></option>
                                              <?php } ?>
                                          </select>
                                           </div>
                                            <div class="col-lg-1"></div>
                                            <div class="col-lg-1" id="jumlah<?= $no ?>"></div>
                                            <div class="col-lg-1" id="target<?= $no ?>"></div>
                                         </div>
                                        
                                        </div>
                                      </div> -->