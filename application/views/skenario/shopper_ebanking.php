<section id="main-content">
      <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Shopper E-Banking</h3>
        <div class="row mt">
          <div class="col-lg-12">

          <div class="row mt">

          <div class="col-lg-12">
            <div class="form-panel">
                <h4 class="mb text-primary"> <strong> <i class="fa fa-angle-right"></i> Daftar Shopper E-Banking</strong></h4>

                <form action="<?= base_url('skenario/tambah_aplikasi')?>" method="post">
              <div class="container-fluid">
              </div>
                
          <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

          <br>
          <section id="allskenario_trk">

            <div class="col-lg-12">
                    <?= $this->session->flashdata('info');?>
                </div>
          </section>

                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_shopper">Tambah Shopper</button>

                  <!-- <button type="submit" class="btn btn-round btn-primary mb"><i class="fa fa-check-circle fa-fw"></i> Simpan </button> -->
                </form>

                

                <section id="unseen">
                  <div class="table-responsive">
                <table class=" table table-bordered table-striped table-condensed table-responsive-sm table-hover" id="dataTables-example-3">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th><center>Nama</center></th>
                      <th><center>Jenis Kelamin</center></th>
                      <th><center>No Handphone</center></th>
                      <th><center>Email</center></th>
                      <th><center>Tanggal Mulai</center></th>
                      <th><center>Tanggal Selesai</center></th>
                      <th><center>User ID</center></th>
                      <th><center>Aksi</center></th>

                    </tr>
                    
                  </thead>
                  <tbody>
                    <?php $no = 1;
                     foreach ($shopper as $shp) { ?> 
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo $shp['nama']; ?></td>
                      <td><?php echo $shp['jk']; ?></td>
                      <td><?php echo $shp['no_hp']; ?></td>
                      <td><?php echo $shp['email']; ?></td>
                      <td><?php echo $shp['tanggal_mulai']; ?></td>
                      <td><?php echo $shp['tanggal_selesai']; ?></td>
                      <td><?php echo $shp['user_id']; ?></td>

                      <td><center>
                        <a type="button" data-toggle="modal" data-target="#edit_shopper<?php echo $shp['id']; ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <a href="<?php echo base_url('skenario/hapus_shopper/'.$shp['id']) ?>" class="btn btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="add_shopper" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Daftar Shopper</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/add_shopper')?>">
        <?php
        $bank = $this->db->get('bank')->result_array(); ?>
         <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
          <label for="norek">Jenis Kelamin</label>
          <select name="jk" id="jk" class="form-control">
            <option value="">--Pilih Jenis Kelamin--</option>
            <option value="Laki-Laki">Laki-Laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="no_hp">No Handphone</label>
          <input type="text" name="no_hp" id="no_hp" class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Masukkan Nomor Handphone">
        </div>

        <div class="form-group">
          <label for="no_hp">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email" required>
        </div>
        <div class="form-group">
          <label for="no_hp">Tanggal Mulai Mitra</label>
          <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" >
        </div>
        <div class="form-group">
          <label for="selesai">Tanggal Selesai Mitra</label>
          <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" >
        </div>

         <!-- <div class="form-group">
          <label for="nama">Alamat</label>
          <textarea name="alamat" id="alamat" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="tempat_lahir">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
        </div>
        <div class="form-group">
          <label for="tanggal_lahir">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="no_ktp">No KTP</label>
          <input type="text" name="no_ktp" id="no_ktp" class="form-control" onkeypress="return hanyaAngka(event)">
        </div>

        <div class="form-group">
          <label for="bank">Bank</label>
          <select class="form-control" id="bank" name="bank">
            <option value="">--Pilih Bank--</option>
            <?php foreach ($bank as $row) {
             ?>
             <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
           <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="norek">No Rekening</label>
          <input type="text" name="norek" id="norek" class="form-control" onkeypress="return hanyaAngka(event)">
        </div> -->
       <!--  <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="ex:name@example.com">
        </div>

 -->
        <div class="form-group" id="div_system_apl">
          <!-- <label for="norek">Channel</label>
          <select name="channel" id="channel" class="form-control">
            <option value="">--Pilih Channel--</option>
            <option value="Internet Banking">Internet Banking</option>
            <option value="Mobile Banking">Mobile Banking</option>
            <option value="SMS Banking">SMS Banking</option>

          </select> -->
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


<?php $no=0;
foreach ($shopper as $shp) { $no++;
 ?>
 <!-- Modal -->
<div class="modal fade" id="edit_shopper<?php echo $shp['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Daftar Shopper</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php echo base_url('skenario/edit_shopper')?>">
        <?php
        $bank = $this->db->get('bank')->result_array(); ?>
        <input type="hidden" name="id" value="<?php echo $shp['id'] ?>">
         <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $shp['nama'] ?>" placeholder="Masukkan Nama" required>
        </div>
        <div class="form-group">
          <label for="norek">Jenis Kelamin</label>
          <select name="jk" id="jk" class="form-control">
            <option value="">--Pilih Jenis Kelamin--</option>
            <option value="Laki-Laki" <?php if ($shp['jk'] == 'Laki-Laki') { echo "selected";} ?>>Lai-Laki</option>
            <option value="Perempuan" <?php if ($shp['jk'] == 'Perempuan') { echo "selected";} ?>>Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="no_hp">No Handphone</label>
          <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?php echo $shp['no_hp'] ?>" onkeypress="return hanyaAngka(event)" placeholder="Masukkan Nomor Handphone">
        </div>
        <div class="form-group">
          <label for="no_hp">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="<?php echo $shp['email'] ?>" placeholder="Masukkan Email" required>
        </div>
        <div class="form-group">
          <label for="no_hp">Tanggal Mulai Mitra</label>
          <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" value="<?php echo $shp['tanggal_mulai'] ?>">
        </div>
        <div class="form-group">
          <label for="selesai">Tanggal Selesai Mitra</label>
          <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="<?php echo $shp['tanggal_selesai'] ?>">
        </div>
        <?php if ($this->session->userdata('id_divisi') == 99) { ?>
        <div>
        <?php } else { ?>
        <div style="display: none;">
        <?php } ?>
        <div class="form-group">
          <label for="user_id">User ID</label>
          <input type="text" name="user_id" id="user_id" class="form-control" value="<?php echo $shp['user_id'] ?>">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" name="password" id="password" class="form-control" value="<?php echo $shp['password'] ?>">
        </div>
        </div>

         <!-- <div class="form-group">
          <label for="nama">Alamat</label>
          <textarea name="alamat" id="alamat" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label for="tempat_lahir">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
        </div>
        <div class="form-group">
          <label for="tanggal_lahir">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
        </div>
      
        <div class="form-group">
          <label for="no_ktp">No KTP</label>
          <input type="text" name="no_ktp" id="no_ktp" class="form-control" onkeypress="return hanyaAngka(event)">
        </div>

        <div class="form-group">
          <label for="bank">Bank</label>
          <select class="form-control" id="bank" name="bank">
            <option value="">--Pilih Bank--</option>
            <?php foreach ($bank as $row) {
             ?>
             <option value="<?php echo $row['kode'] ?>"><?php echo $row['nama']; ?></option>
           <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="norek">No Rekening</label>
          <input type="text" name="norek" id="norek" class="form-control" onkeypress="return hanyaAngka(event)">
        </div> -->
        <!-- <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="form-control" value="<?php echo $shp['email'] ?>" placeholder="ex:name@example.com">
        </div>
 -->

        <div class="form-group" id="div_system_apl">
          <!-- <label for="norek">Channel</label>
          <select name="channel" id="channel" class="form-control">
            <option value="">--Pilih Channel--</option>
            <option value="Internet Banking">Internet Banking</option>
            <option value="Mobile Banking">Mobile Banking</option>
            <option value="SMS Banking">SMS Banking</option>

          </select> -->
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>


<script type="text/javascript">



               $('#dataTables-example-3').dataTable({
                 "responsive": true,
                 "searching": true,
                 "ordering": true,
                 "info": false,
                 "scrollY": "",
                 "scrollCollapse": true,
                 "paging": false
               });
  


  function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
         
</script>