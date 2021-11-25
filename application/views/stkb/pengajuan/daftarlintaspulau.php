<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Daftar Pengajuan Lintas Pulau</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
                <section id="unseen">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Project</th>
                      <th>Nama Project</th>
                      <th>Nama Kareg</th>
                      <th>Nama PIC</th>
                      <th>Asal Kota</th>
                      <th>Kota Dinas</th>
                      <th>Tanggal Pengajuan</th>
                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
			            <?php $no = 1; foreach ($daftar as $data) { ?>
                    <tr>
                      <td style="vertical-align:middle;"><?= $no;?></td>
                      <td style="vertical-align:middle;"><?= $data['project'];?></td>
                      <td style="vertical-align:middle;"><?= $data['namaproject'];?></td>
                      <td style="vertical-align:middle;"><?= $data['kareg'].' - '.$data['namakareg'];?></td>
                      <td style="vertical-align:middle;"><?= $data['pic'].' - '.$data['namapic'];?></td>
                      <td style="vertical-align:middle;"><?= $data['kota_asal'];?></td>
                      <td style="vertical-align:middle;"><?= $data['kota_dinas'];?></td>
                      <td style="vertical-align:middle;"><?= $data['tanggal'];?></td>
                      <td style="text-align:center;vertical-align:middle;">
                        <a href="<?= base_url('stkb/submitpersetujuanlintaspulau/'.$data['id']);?>" class="btn btn-success btn-sm" title="ACC Pengajuan">Setuju</a>&nbsp;
                        <a href="#" onclick="tolak('<?= $data['id'].','.$data['project'].' - '.$data['namaproject'].','.$data['kareg'].' - '.$data['namakareg'].','.$data['pic'].' - '.$data['namapic'].','.$data['kota_asal'].','.$data['kota_dinas'];?>')" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#largeModal" title="Tolak Pengajuan">Tolak</a>
                      </td>
                    </tr>
                  <?php $no++; } ?>
                  </tbody>
                </table>
              </section>
            </div>
           </div>
           </div>

           <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
             <div class="modal-dialog modal-md">
               <div class="modal-content">
                 <form action="<?= base_url('stkb/submitpenolakanlintaspulau');?>" method="post"><input type="hidden" id="idpengajuan" name="idpengajuan">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title">Tolak Pengajuan Lintas Pulau</h4>
                 </div>
                 <div class="modal-body">

                     <div class="row">
                       <div class="col-xs-12">
                         <div class="form-group">
                           <label>Project:</label>
                             <input type="text" id="project" class="form-control" readonly>
                         </div>
                       </div>
                       <div class="col-xs-6">
                         <div class="form-group">
                           <label>Nama Kareg:</label>
                             <input type="text" id="kareg" class="form-control" readonly>
                         </div>
                       </div>
                       <div class="col-xs-6">
                         <div class="form-group">
                           <label>Nama PIC:</label>
                             <input type="text" id="pic" class="form-control" readonly>
                         </div>
                       </div>
                       <div class="col-xs-6">
                         <div class="form-group">
                           <label>Kota Asal:</label>
                             <input type="text" id="kota_asal" class="form-control" readonly>
                         </div>
                       </div>
                       <div class="col-xs-6">
                         <div class="form-group">
                           <label>Kota Dinas:</label>
                             <input type="text" id="kota_dinas" class="form-control" readonly>
                         </div>
                       </div>
                       <div class="col-xs-12">
                         <div class="form-group">
                           <label>Alasan Penolakan:</label>
                             <input type="text" id="alasan" name="alasan" class="form-control" placeholder="Isi Alasan Penolakan" required>
                         </div>
                       </div>
                     </div>

                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-danger">Tolak</button>
                 </div>
               </form>
               </div>
             </div>
           </div>

<script type="text/javascript">
  function tolak(value){
    // console.log(value);
    var value = value.split(",")
    $("#idpengajuan").val(value[0]); $("#project").val(value[1]); $("#kareg").val(value[2]); $("#pic").val(value[3]); $("#kota_asal").val(value[4]); $("#kota_dinas").val(value[5]);
  }
</script>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
