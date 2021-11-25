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
                    <h4 class="mb text-primary"><strong>1 - Project </strong> </h4>
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                      <tr>
                          <th>No</th>
                          <td>Edit</th>
                          <th>Project</th>
                          <th>Nama Klien</th>
                          <th>Tahun</th>
                      </tr>
                  </thead>
                  <tbody>

                        <?php
                          $i = 1;
                          foreach ($semuaproject as $pro) {
                          echo "<tr>";
                          echo "<td>" .$i++. "</td>";
                          ?>
                          <td><a href="<?php echo base_url(); ?>stkb/edit_oneproject/<?php echo $pro['prokod']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pen fa-sm"></i> Edit</a></td>
                          <?php
                          echo "<td>" .$pro['prokod']. " - " .$pro['pronam']. "</td>";
                          echo "<td>" .$pro['banknam']. "</td>";
                          echo "<td>" .$pro['protang']. "</td>";
                          echo "</tr>";
                          }
                        ?>
                  </tbody>
                </table>
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
