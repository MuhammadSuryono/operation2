<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aktual </h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Aktual Pending </strong></h4>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Nama Cabang</th>
                      <?php foreach($skenario as $sk) :?>
                         <th><?= $sk['nama_skenario']?></th>
                      <?php endforeach?>
                    </tr>
                  </thead>
                  <tbody>
                      <?php $no = 0; foreach($aktual as $db) :?>
                      <?php
                            $project = $db['id_project'];
                            $id_user = $this->session->userdata('id_user');
                            $kunjungan = $db['id_kunjungan'];
                            $pending = $this->db->query("SELECT * FROM data_aktual WHERE (id_user = '$id_user' and id_project = $project and id_kunjungan = $kunjungan) and (id_status LIKE '%0' or id_status LIKE '%3')")->num_rows();
                       ?>
                       <?php if($pending == 0) :?>

                      <?php if($no%2==0):?>
                         <tr style="background-color : #e2e4ff;">
                         <td>
                         <?php else :?>
                         <tr>
                         <td style="background-color : #ffffff;">
                         <?php endif?>
                            <?= ++$no?></td>
                            <td><?= $db['nama_project']?></td>
                            <td><?= $db['nama_cabang']?></td>
                            <?php foreach($skenario as $sk) :?>
                                <td>
                                    <?php $cek = $this->db->get_where('data_aktual', ['id_user' => $this->session->userdata('id_user'), 'id_project' => $db['id_project'], 'id_skenario' => $sk['id_skenario']])->row_array();?>

                                    <?php if($cek['id_status'] == '1'):?>
                                        <span class="fa fa-check text-success fa-fw"></span>
                                    <?php endif?>

                                    <?php if($cek['id_status'] == '') :?>
                                    <span class="fa fa-ban fa-fw"></span>
                                    <?php endif?>
                                </td>
                            <?php endforeach?>
                        </tr>
                        <?php endif?>
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
      <!-- /wrapper -->
    </section>
