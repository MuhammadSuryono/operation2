<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Daftar Score Kuis Skenario</h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
             <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Score </strong></h4>

            <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Project</th>
                      <th>Kunjunngan</th>
                      <th>Score</th>
                      <th>Benar</th>
                      <th>Salah</th>
                      <th>Tanggal Uji</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($data_nilai as $db) :?>
                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                          <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['kunjunganx']?></td>
                            <td><?= $db['total_nilai']?></td>
                            <td><?= $db['benar_nilai']?></td>
                            <td><?= $db['salah_nilai']?></td>
                            <td><?=$db['tanggal']?></td>
                        </tr>
                        <?php endforeach?>
                  </tbody>
                </table>
              </section>
            </div>
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
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->