<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Reporting Internal</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

            <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
             
          <div class="col-lg-12">
            <!-- <div class="form-panel"> -->
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Reporting Internal </strong></h4>
                
                 <?= $this->session->flashdata('info');?>
                <?php 
                $project = $this->db->query("SELECT *, a.kode AS kode_pro, a.nama AS nama_project, b.nama AS nama_bank FROM project a JOIN bank b ON a.bank=b.kode WHERE type='n' ORDER BY b.nama")->result_array();
                ?>
                
                
                <section id="unseen">
                <div class="row mx-3">
                <div class="col-sm-6">
                    <div class="form-panel">
                        <h3><b> Daftar Project</b></h3>
                        <div class="row">
                        <form action="<?= base_url('project/detail_report') ?>" method="POST">
                       <div class="col-sm-12">
                       <select name="project" id="project" class="selectpicker form-control" data-live-search="true" onchange="if(this.value != 0) { this.form.submit(); }">
                            <option value="">Pilih Project</option>
                            <?php foreach ($project as $pro) { ?>
                              <option value="<?php echo $pro['kode_pro'] ?>"><?php echo $pro['nama_bank']." - ".$pro['nama_project']." - ".date('Y', strtotime($pro['tanggal'])) ?></option>
                            <?php } ?>
                      </select>
                      </div>
                    </form>
                  </div>
                  </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-panel">
                        <div class="row">
                        <!-- <form action="<?= base_url('project/detail_report') ?>" method="POST"> -->
                       <div class="col-sm-6">
                        <h3><b> User Client</b></h3>

                       <a href="<?= base_url('project/register_client') ?>" class="btn btn-primary">Register Client</a>
                      </div>
                      <div class="col-sm-6">
                        <h3><b> Sinkronisasi Data</b></h3>
                        <?php $last = $this->db->query("SELECT * FROM last_sinkron ORDER BY id DESC")->row_array(); ?>
                       <a href="<?= base_url('sinkronisasi/refresh') ?>" class="btn btn-success">Sinkronisasi</a>
                       <br><span style="font-weight: bold;">Last Sync : <?= date('d M Y, H:i', strtotime($last['time'])); ?></span>
                      </div>
                    <!-- </form> -->
                  </div>
                  </div>
                </div>
              </div>
                
                <div class="row">
                  <div class="col-sm-6">
                      <div class="form-panel">
                        <h3><b>Project</b></h3>
                        <div class="row">
                        <!-- <div class="col-sm-6"> -->
                          <?php $total_project  = $this->db->where('type', 'n')->get('project')->num_rows();
                          // $active  = $this->db->get_where('project', ['visible' => 'y'])->num_rows(); 
                          // $closed  = $this->db->get_where('project', ['visible !=' => 'y'])->num_rows(); 
                          $year = $this->db->query("SELECT * , YEAR( tanggal ) AS tahun, 
                                                    SUM(CASE WHEN visible='y' then 1 Else 0 End) AS active,
                                                    SUM(CASE WHEN visible='n' then 1 Else 0 End) AS close
                                                    FROM `project`
                                                    WHERE type='n'
                                                    GROUP BY YEAR( tanggal )")->result_array();
                          $tahun = array();
                          $active = array();
                          $close = array();
                          
                          foreach ($year as $key) {
                            $tahun[] = $key['tahun'];
                            $active[] = $key['active'];
                            $close[] = $key['close'];

                          }

                          // $data = [$active, $closed];


                          ?>
                          
<!-- 
                          <center><p style="font-size: 100px; color: #1E90FF; text-shadow: 0 0 6px #FF0000"><?php echo $total_project; ?></p></center>
                          <center><h4>Total Project</h4></center>
                          
                        </div> -->
                        <div class="col-sm-12">
                          <div>
                            <canvas id="myChart"></canvas>
                          </div>
                       </div>
                       <br>
                       <!-- <form action="<?= base_url('project/detail_report') ?>" method="POST">
                       <div class="col-sm-12">
                       <select name="project" id="project" class="selectpicker form-control" data-live-search="true" onchange="if(this.value != 0) { this.form.submit(); }">
                            <option value="">Pilih Project</option>
                            <?php foreach ($project as $pro) { ?>
                              <option value="<?php echo $pro['kode_pro'] ?>"><?php echo $pro['nama_bank']." - ".$pro['nama_project']." - ".date('Y', strtotime($pro['tanggal'])) ?></option>
                            <?php } ?>
                      </select>
                      </div>
                    </form> -->
                     </div>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-panel">
                        <h3><b> Channel Project</b></h3>
                        <div class="row col-sm-12">
                          <div class="col-sm-12">
                            <div id="channel" ></div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div id="channel2" style="width: 100%; height: 110px; "></div>
                          </div>
                          <div class="col-sm-6">
                            <div id="channel3" style="width: 100%; height: 110px; "></div>
                          </div>
                         </div>
                    </div>
                  </div>
                <!-- </div> -->

                

                </div>
                
                

                </section>
            <!-- </div> -->
           </div>
           </div>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js" integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">

  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();
  });

  var ctx = document.getElementById("myChart").getContext('2d');
     
     var list = <?php echo json_encode($year); ?>;
     console.log(list);
      var myChart = new Chart(ctx, {

        type: 'bar',
        data: {
          labels: <?php echo json_encode($tahun); ?>,
          datasets: [{
            label: 'Active',
            data: <?php echo json_encode($active); ?>,
            backgroundColor: [
            'rgba(60, 179, 113, 1)',
            ],
            borderColor: [
            'rgba(60, 179, 113,1)',
            ],
            borderWidth: 1,
            datalabels: {
              color: 'black',
              anchor: 'end',
              align: 'top'
            }
          },
          {
            label: 'Close',
            data: <?php echo json_encode($close); ?>,
            backgroundColor: [
            'rgba(240, 128, 128, 1)',
            ],
            borderColor: [
            'rgba(240, 128, 128, 1)',
            ],
            borderWidth: 1,
            datalabels: {
              color: 'black',
              anchor: 'end',
              align: 'top'
            }
          },
          ]
        },
        plugins: [ChartDataLabels],
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero:true,

              }
            }]
          }
        }
      });



      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['channel', 'jumlah'],
           <?php
         $sql = $this->db->query("SELECT channel, COUNT(channel) AS jumlah FROM project WHERE type='n' GROUP BY channel")->result_array();
            foreach ($sql as $result) {
                # code...
            echo"['".$result['channel']."',".$result['jumlah']."],";
         }
         ?>
        ]);
        var data2 = google.visualization.arrayToDataTable([
          ['channel', 'jumlah'],
           <?php
         $sql = $this->db->query("SELECT channel, COUNT(channel) AS jumlah FROM project WHERE visible='y' AND type='n' GROUP BY channel")->result_array();
            foreach ($sql as $result) {
                # code...
            echo"['".$result['channel']."',".$result['jumlah']."],";
         }
         ?>
        ]);
        var data3 = google.visualization.arrayToDataTable([
          ['channel', 'jumlah'],
           <?php
         $sql = $this->db->query("SELECT channel, COUNT(channel) AS jumlah FROM project WHERE visible='n' AND type='n' GROUP BY channel")->result_array();
            foreach ($sql as $result) {
                # code...
            echo"['".$result['channel']."',".$result['jumlah']."],";
         }
         ?>
        ]);

       
        var options = {
          title: 'Statistik Total Project Berdasarkan Channel',
          is3D: true
        };
        var options2 = {
          title: 'Statistik Total Project Status Active Berdasarkan Channel',
          is3D: true
        };
        var options3 = {
          title: 'Statistik Total Project Status Closed Berdasarkan Channel',
          is3D: true
        };
       
        var chart = new google.visualization.PieChart(document.getElementById('channel'));
        var chart2 = new google.visualization.PieChart(document.getElementById('channel2'));
        var chart3 = new google.visualization.PieChart(document.getElementById('channel3'));

       
        chart.draw(data, options);
        chart2.draw(data2, options2);
        chart3.draw(data3, options3);

        
      }
</script>