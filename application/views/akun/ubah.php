<!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
<!--main content start-->
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> MRI OPERATION </h3>
    <div class="row mt">
      <div class="col-lg-12">


        <div class="row mt">
          <div class="col-lg-8">
            <div class="form-panel">
              <h4 class="mb text-primary"><strong> <i class="fa fa-angle-right"></i> Ubah Akun </strong> </h4>
              <form class="form-horizontal style-form" method="post">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Lengkap</label>
                  <div class="col-sm-8">
                    <input type="name" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap.." value="<?= $user['name'] ?>">
                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Divisi</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="div" id="div">
                      <?php foreach ($divisi as $div) : ?>
                        <?php if ($user['id_divisi'] == $div['id']) : ?>
                          <option value="<?= $div['id'] ?>" selected> <?= $div['keterangan_divisi'] ?> </option>
                        <?php else : ?>
                          <option value="<?= $div['id'] ?>"> <?= $div['keterangan_divisi'] ?> </option>
                        <?php endif ?>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label">User ID </label>
                  <div class="col-sm-8">
                    <input type="name" class="form-control" id="id" name="id" value="<?= $user['noid'] ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Status </label>
                  <div class="col-sm-8">
                    <select class="form-control" name="status" id="statusku">
                      <option value="">--Pilih Status--</option>
                      <option value="1" <?php if ($user['status'] == '1') { echo "selected"; } ?>>Enable</option>
                      <option value="0" <?php if ($user['status'] == '0') { echo "selected"; } ?>>Disable</option>
                      
                    </select>
                  </div>
                </div>
                <div class="form-group" id="label_pass" style="display: none;">
                  
                </div>
                <button type="submit" class="btn btn-round btn-primary pull-right"><i class="fa fa-check-circle fa-fw"></i> Simpan</button>
                <a href="<?= base_url('akun') ?>" class="btn btn-round btn-danger pull-right" style="margin-right:0.5rem;"><i class="fa fa-ban fa-fw"></i> Batal</a>
                <br>
                <br>
              </form>
            </div>
          </div>



        </div>
      </div>
  </section>
  <!-- /wrapper -->
</section>
<!-- /MAIN CONTENT -->
<!--main content end-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<script>
   $(document).ready(function() {
         $('#statusku').change(function() {
           var id = $(this).val();
           console.log(id);

          $('#label_pass').empty();

           var ht = ``;

           ht += `<label class="col-sm-3 control-label">New Password </label>`;
           ht +=  `<div class="col-sm-8">`;
           ht +=  `<input type="password" name="new_password" class="form-control" required>`;
           ht += `</div>`;

           if (id == 1) {
            document.getElementById('label_pass').style.display = 'block';
            $('#label_pass').append(ht);

           } else {
            document.getElementById('label_pass').style.display = 'none';
            
           }
         });
       });

</script>