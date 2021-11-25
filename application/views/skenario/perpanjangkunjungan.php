<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Perpanjang Waktu Kunjungan</h3>
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
                      <th>Plan Start</th>
                      <th>Plan End</th>
                      <th>Kode Cabang</th>
                      <th>Nama Cabang</th>
                      <th>Kode Kunjungan</th>
                      <th>Nama Skenario</th>
                      <th><center>Aksi</center></th>
                    </tr>
                  </thead>
                  <tbody>
			            <?php $no = 1; foreach ($project as $data) { foreach ($data as $value) { ?>
                    <tr>
                      <td><?= $no;?></td>
                      <td><?= $value['kodeproject'];?></td>
                      <td><?= $value['projectnama'];?></td>
                      <td><?= $value['planstart'];?></td>
                      <td><span id="textplanend<?= $value['no'];?>"><?= $value['planend'];?></span></td>
                      <td><?= $value['kodecabang'];?></td>
                      <td><?= $value['namacabang'];?></td>
                      <td><?= $value['kodekunjungan'];?></td>
                      <td><?= $value['namaatt'];?></td>
                      <td><center><a href="#" onclick="edit('<?= $value['no'].','.$value['planend'];?>')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#largeModal" title="Detail Kunjungan"><i class="fas fa-edit"></i></a></center></td>
                    </tr>
                  <?php $no++; }} ?>
                  </tbody>
                </table>
              <strong><span class="text-warning faa-flash animated">*Note : </span>
                <br>- Perpanjang waktu kunjungan hanya dapat dilakukan oleh user pembuat project!
                <br>- Data yang muncul merupakan data dimana tanggal selesai sudah terlewat dan berada di rentang 1 bulan kebelakang dari hari ini!</strong>
              </section>
            </div>
           </div>
           </div>

           <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
             <div class="modal-dialog modal-md">
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   <h4 class="modal-title" id="myModalLabel">Perpanjang Skenario Kunjungan</h4>
                 </div><input type="hidden" id="id_plan">
                 <div class="modal-body">
                   <div class="row">
                     <div class="col-sm-3"></div>
                     <div class="col-sm-6">
                       <div class="form-group">
                         <label>Ubah Tanggal Selesai Penugasan : </label>
                           <input type="date" id="tgl_ubah" name="planend" class="form-control" min="<?php //echo date('Y-m-d'); ?>" value="" required>
                       </div>
                     </div>
                     <div class="col-sm-3"></div>
                   </div>

                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   <button type="button" id="save_tglSkenario" class="btn btn-primary">Save</button>
                 </div>
               </div>
             </div>
           </div>

<script type="text/javascript">
  function edit(value){
    var value = value.split(",")
    $("#id_plan").val(value[0]);
    $("#tgl_ubah").val(value[1]);
    //$("#tgl_ubah").attr("min", value[1]);
  }
</script>


          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
