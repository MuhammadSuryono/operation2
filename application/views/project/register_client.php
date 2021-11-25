<?php
$id_user = $this->session->userdata('id_user');
// var_dump($id_user); die;
if ($this->db->get_where('user', ['noid' => $id_user])->num_rows() >= 1) {
  $user = $this->db->get_where('user', ['noid' => $id_user])->row_array();
  $nama = $user['name'];
  $email_user = $user['email'];
  $id_u = $user['noid'];
  $table = "user";
  $kolom = "email";
  $where_col = "noid";
} else {
  $user = $this->db->get_where('id_data', ['Id' => $id_user])->row_array();
  $nama = $user['Nama'];
  $email_user = $user['Email'];
  $id_u = $user['Id'];
  $table = "id_data";
  $kolom = "Email";
  $where_col = "Id";
}

?>
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> Register User Client </h3>
    <div class="row mt">
      <div class="col-lg-12">


        <div class="row mt">

          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="form-panel">
              <h2 class="mb text-center"> <strong>  Form Register User Client </strong></h2>
              <hr style="height:0; border-top:10px solid #FF0000; border-radius: 20px;">
                <hr style="height:0; border-top:10px solid #4169E1; border-radius: 20px;">

              <div class="col-lg-12">
                <?= $this->session->flashdata('info'); ?>
              </div>

              <section id="unseen" style="margin-top: 80px;">
                <form action="<?= base_url('project/input_client') ?>" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Nama Lengkap</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7"><input type="text" name="nama" class="form-control" required></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Username</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7"><input type="text" name="username" class="form-control" required></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Password</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7"><input type="password" name="password" class="form-control" required></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Nama Bank</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7">
                      <select class="form-control selectpicker" data-live-search="true" name="bank" id="bank" required>
                        <option value="">Pilih Nama Bank</option>
                        <?php foreach ($bank as $row) {
                         ?>
                        <option value="<?= $row['kode'] ?>"><?= $row['nama'] ?></option>
                      <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Branch</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7"><input type="radio" name="branch" value="Yes">&nbsp; YES
                                                  <br><input type="radio" name="branch" value="No">&nbsp; NO</div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Email</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-8 col-xs-7"><input type="email" name="email" class="form-control" placeholder="ex : name@example.com" required></div>
                  </div>
                </div>

                <div class="form-group">
                <div class="row">
                    <div class="col-sm-12">
                      <input type="reset" name="reset" id="reset" class="btn btn-danger" value="RESET">
                      &nbsp;
                      <input type="submit" name="submit" class="btn btn-primary" value="SUBMIT">
                    </div>
                  </div>
                </div>
                <br><br>

              

                
                </div>

              </form>
              </section>
            </div>
          </div>
          <div class="col-lg-2"></div>

        </div>


      </div>
    </div>
  </section>
  <!-- /wrapper -->
</section>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script>
$(function () {
  $('[data-toggle="popover"]').popover()
});

 $('#reset').click(function(){
  console.log('klik reset');
  $('#bank').prop('selectedIndex',-1);
  $("#bank").selectpicker("refresh");

 });

</script>

