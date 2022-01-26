<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Data Kelompok Query</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">
             
          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Data Kelompok Query </strong></h4>
                <!-- <a href="<?= base_url('project/tambah')?>" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Tambah</a> -->
                
                <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
                    <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>

                    <button class="btn btn-primary" data-toggle="modal" data-target="#buatkelompok">Buat Kelompok Query</button>
                </div>
                                <br>
                <hr size="30px" width="95%" color="grey" style="border-top: 3px solid;">
                
                <section id="unseen">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover" id="dataTables-example">
                        <thead >
                          <tr>
                            <th><center>No</center></th>
                            <th><center>Nama Kelompok Query</center></th>
                            <th><center>Kategori Kelompok</center></th>
                            <th><center>List</center></th>
                            <th width="10%"><center>Aksi</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no = 1; foreach ($group_query as $row) {
                            ?>
                            <tr>
                              <td><center><?= $no++; ?></center></td>
                              <td><?= $row['nama_group'] ?></td>
                              <td><?= $row['kategori'] ?></td>
                              <td><center><a href="#" type="button" class="btn btn-info" data-toggle="modal" data-target="#viewlist<?= $row['kd_group'] ?>">View List</i></a></center></td>
                           
                              <td><center>
                                <div class="row">
                                <a href="#" type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $row['kd_group'] ?>"><i class="fas fa-edit"></i></a>
                                <a href="<?= base_url('project/delete_groupquery/'.$row['kd_group']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash-alt"></i></a>
                                </div>
                              </center></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
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


<div class="modal fade" id="buatkelompok" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Buat Kelompok Query</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?= base_url('project/create_groupquery') ?>">
        <div class="table-responsive">
          <div class="form-group">
          	<label>Pilih Kategori</label>
          	<select class="form-control" name="kategori" onchange="changeKtg(this.value)">
          		<option value="">Pilih Kategori</option>
          		<option value="CS">CS</option>
          		<option value="Teller">Teller</option>
          	</select>		
          </div>
          <table class="table table-bordered">
          	<thead>
          		<tr>
          			<th><center>Pilih Query</center></th>
          			<th><center>Query</center></th>
          			<th><center>Keterangan Check</center></th>

          		</tr>
          	</thead>
          	<tbody  id="tbody_satuan">
          		<tr>
          			<td colspan="3"><center>Belum Ada Data</center></td>
          		</tr>
          		<!-- <?php foreach ($query as $q) {
          			# code...?>
          		<tr>
          			<td><center><input type="checkbox" name="id_query[]" value="<?= $q['num'] ?>"></center></td>
          			<td><?= $q['query'] ?></td>
          		</tr>
          	<?php } ?> -->
          	</tbody>
          </table>
          <br>
          <div class="form-group">
          	<label>Nama Kelompok Query</label>
          	<input type="text" class="form-control" name="nama_kelompok" required>
          </div>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal View List -->
<?php $no = 0; foreach ($group_query as $row) {
	// $detail = $this->db->get_where('konsistensi_groupquery', ['kd_group' => $row['kd_group']])->result_array();
	$detail = $this->db->query("SELECT a.*, b.query AS listquery FROM konsistensi_groupquery a JOIN konsistensi_query b ON a.kd_list=b.num WHERE a.kd_group='$row[kd_group]'")->result_array();
	$que = $this->db->get_where('konsistensi_query', ['kategori' => $row['kategori']])->result_array();
	$kode = array();
	foreach ($detail as $d) {
		array_push($kode, $d['kd_list']);
	}
$no++; ?>
<div class="modal fade" id="edit<?= $row['kd_group'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Kelompok Query "<?= $detail[0]['nama_group'] ?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <form method="POST" action="<?= base_url('project/edit_groupquery') ?>">
    	<input type="hidden" name="kd_group" value="<?= $row['kd_group'] ?>">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead style="background-color: #7FFFD4">
					<tr>
						<th><center>Pilih Query</center></th>
						<th><center>Query</center></th>
          				<th><center>Keterangan Check</center></th>

					</tr>
				</thead>
				<tbody>
					<?php $num=1; foreach ($que as $key) {
					?>
					<tr>
						<td><center><input type="checkbox" name="id_query[]" <?php if(in_array($key['num'], $kode)) { echo "checked";} ?> value="<?= $key['num'] ?>"></center></td>
						<td><?= $key['query'] ?></td>
						<td><?= $key['keterangan'] ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
			<br>
          <div class="form-group">
          	<label>Kategori</label>
          	<input type="text" class="form-control" name="kategori" value="<?= $row['kategori'] ?>" readonly>
          </div>
          <div class="form-group">
          	<label>Nama Kelompok Query</label>
          	<input type="text" class="form-control" name="nama_kelompok" value="<?= $row['nama_group'] ?>">
          </div>
		</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php } ?>


<!-- Modal View List -->
<?php $no = 0; foreach ($group_query as $row) {
	// $detail = $this->db->get_where('konsistensi_groupquery', ['kd_group' => $row['kd_group']])->result_array();
	$detail = $this->db->query("SELECT a.*, b.query AS listquery, b.keterangan FROM konsistensi_groupquery a JOIN konsistensi_query b ON a.kd_list=b.num WHERE a.kd_group='$row[kd_group]'")->result_array();
$no++; ?>
<div class="modal fade" id="viewlist<?= $row['kd_group'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">List Query "<?= $detail[0]['nama_group'] ?>"</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead style="background-color: #7FFFD4">
					<tr>
						<th><center>No</center></th>
						<th><center>Query</center></th>
						<th><center>Keterangan Check</center></th>

					</tr>
				</thead>
				<tbody>
					<?php $num=1; foreach ($detail as $key) {
					?>
					<tr>
						<td><?= $num++; ?></td>
						<td><?= $key['listquery'] ?></td>
						<td><?= $key['keterangan'] ?></td>

					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php } ?>

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

  function changeKtg(ktg)
  {
  	$('#tbody_satuan').empty();
  		console.log(ktg);
  		$.ajax({
               url: "<?= base_url('project/get_satuanquery') ?>",
               type: "POST",
               dataType: 'json',
               data: {
                ktg: ktg
               },
               success: function(hasil) {
               	console.log(hasil);
               	var ht = ``;
               	if (hasil.length > 0) {
               		for (var i = 0; i < hasil.length; i++) {
		               	ht += `<tr>`;
		               	ht += `<td><center><input type="checkbox" name="id_query[]" value="`+hasil[i]['num']+`"></center></td>`;
		               	ht += `<td>`+hasil[i]['query']+`</td>`;
		               	ht += `<td>`+hasil[i]['keterangan']+`</td>`;

	               }
	            } else {
	            	ht += `<tr>
          					<td colspan="3"><center>Belum Ada Data</center></td>
          				  </tr>`;
	            }
  				$('#tbody_satuan').append(ht);

               }		
           });
  }
</script>