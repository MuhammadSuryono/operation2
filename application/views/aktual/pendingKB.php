<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Aktual </h3>
        <div class="row mt">
          <div class="col-lg-12">


          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Aktual Pending</strong></h4>

                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>

                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Project</th>
                      <th>Nama Cabang</th>
                      <th>Kode Kunjungan</th>
                      <th>Skenario</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $id_user = $this->session->userdata('id_user'); $no=1; $atmcenter = array('064','065','066','067'); foreach($aktual as $db):
                    // if(strstr($db['sts'], '0')!=""):
                    //$data = explode(",", $db['skenario']);
                    //$data1 = explode(",", $db['kode_skenario']);?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $db['nama_project']?></td>
                        <td><?= $db['cabangx']?></td>
                        <td><?= $db['kunjungan1']?></td>
                        <td><?php
                          if (in_array($db['skenario'], $atmcenter)){
                            if($db['status'] >= 1){
                              echo $db['kunjungan1'].'(<span class="fa fa-check text-success fa-fw"></span>)';
                            }else{
                              echo $db['kunjungan1'].'(<span class="fa fa-times text-danger fa-fw"></span>)';
                            }
                          }else{
                            $get = $this->db->query("SELECT GROUP_CONCAT( a.kunjungan ) AS kode_skenario, GROUP_CONCAT( d.nama ) AS skenario, GROUP_CONCAT( a.`status` ) AS sts
                                     FROM attribute d LEFT JOIN (cabang c JOIN ( quest a JOIN project b ON a.project = b.kode AND b.visible = 'y' AND b.type = 'n' ) ON a.cabang = c.kode AND a.project = c.project) ON a.kunjungan = d.kode
                                     WHERE a.shp = '$id_user' AND a.nomorstkb = '$db[nomorstkb]' GROUP BY a.project, a.cabang, a.r_kategori")->row_array();

                            $data = explode(",", $get['skenario']);
                            $data1 = explode(",", $get['kode_skenario']);
                            $sts = explode(",", $get['sts']);

                            for($i=0;$i<count($data1);$i++):
                                if($sts[$i] >= 1):
                                echo $data[$i].'(<span class="fa fa-check text-success fa-fw"></span>),';
                                else :
                                echo $data[$i].'(<span class="fa fa-times text-danger fa-fw"></span>),';
                                endif;
                            endfor;
                          }
                        ?>
                        </td>
                        <td class="text-center"><a href="<?= base_url('aktual/assign2/')?><?= $db['r_kategori']?>/<?= $db['kode_project']?>/<?=$db['cabang']?>" class="btn btn-success btn-round btn-xs"><span class="fa fa-pencil fa-fw"></span> Aktual </a></td>
                    </tr>
                  <?php //endif; ?>
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
