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
                </div>
                
                <section id="unseen">
                  <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label><h5><b>Query</b></h5></label>
                        <textarea rows="5" class="form-control query" name="query"></textarea>

                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label><h5><b>Where/Condition</b></h5></label>
                        <textarea rows="5" class="form-control where" name="where"></textarea>

                      </div>
                    </div>
                    <div class="col-lg-2">
                      <div class="form-group">
                        <label><h5><b>Project</b></h5></label>
                        <select class="form-control selectpicker project" data-live-search="true" name="project">
                          <option value="">Pilih Project</option>
                          <?php foreach ($project as $pro) {
                            ?>
                            <option value="<?= $pro['kode'] ?>"><?= $pro['nama'] ?></option>
                          <?php } ?>
                        </select>

                      </div>
                    </div>

                    <div class="col-lg-2">
                      <div class="form-group">
                        <label><h5><b>Database</b></h5></label>
                        <select class="form-control selectpicker" data-live-search="true" name="dba">
                          <option value="">Pilih Database</option>
                          <?php foreach ($database as $db) {
                            ?>
                            <option value="<?= $db['Database'] ?>"><?= $db['Database'] ?></option>
                          <?php } ?>
                        </select>

                      </div>
                    </div>
                    <!-- <?php
                    var_dump($database);
                    ?> -->
                  </div>
                  <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label><h5><b>Modification Show Data (Ex: Order By, Group By, etc)</b></h5></label>
                        <textarea rows="5" class="form-control modif" name="modif"></textarea>

                      </div>
                    </div>
                    
                  </div>
                  <div>
                    <input type="submit" name="show_data" class="btn btn-primary" value="Show">
                  </div>
                            <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">
                  
                </form>

                <?php
                if (isset($_POST['show_data'])) {
                  $query = $_POST['query'];
                  $where = $_POST['where'];
                  $project = $_POST['project'];
                  $dba = $_POST['dba'];
                  $modif = $_POST['modif'];


                  $db_dinamis = [
                                  'dsn' => '',
                                  'hostname' => 'localhost',
                                  'username' => 'adam',
                                  'password' => 'Ad@mMR1db',
                                  'database' => $dba,
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

                  // echo $query;
                  // echo $where;
                  // echo $project;
                  if ($project != NULL OR $project != '') {
                    $full = $query." WHERE ".$where." '".$project."'"." ".$modif;
                  } else {
                    $full = $query." WHERE ".$where." ".$modif;
                  }
                  $dbnya = $this->load->database($db_dinamis, TRUE);

                  $show = $dbnya->query($full)->result_array();
                  // var_dump($show);
                   $numColumns = count($show[0]);
                    $numRows = count($show);
                    $columnsNames = array_keys($show[0]);

                ?>
                <input type="hidden" id="query" value="<?= $query ?>">
                <input type="hidden" id="where" value="<?= $where ?>">
                <input type="hidden" id="project" value="<?= $project ?>">
                <input type="hidden" id="dba" value="<?= $dba ?>">
                <input type="hidden" id="modif" value="<?= $modif ?>">



                <div class="table-responsive">
                  <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="tables-konsistensi">
                    <thead>
                      <tr>
                          <th>No</th>
                        <?php for ($i=0; $i <$numColumns ; $i++) {  ?>
                          <th><?= $columnsNames[$i] ?></th>
                       <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($show as $row) { ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <?php for ($i=0; $i <$numColumns ; $i++) {  ?>
                          <td><?= $row[$columnsNames[$i]] ?></td>
                          <?php } ?>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                
                
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


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
  $(document).ready(function() {
    var quer = $('#query').val();
    var where = $('#where').val();
    var project = $('#project').val();
    var dba = $('#dba').val();
    var modif = $('#modif').val();


    
    $('.query').val(quer);
    $('.where').val(where);
    $('.modif').val(modif);

    // $('.project').val(project);

    $('select[name=project]').val(project);
    $('.selectpicker').selectpicker('refresh');

    $('select[name=dba]').val(dba);
    $('.selectpicker').selectpicker('refresh');


  });
</script>