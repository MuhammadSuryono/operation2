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
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<style type="text/css">
  
</style>
<section id="main-content">
  <section class="wrapper site-min-height">
    <h3><i class="fa fa-angle-right"></i> LOGIN </h3>
    <div class="row mt">
      <div class="col-lg-12">


        <div class="row mt">

          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="form-panel">
              <div class="row">
                <div class="col-sm-12">
                <!-- <h5 class="mb text-left text-secondary" style=""> <strong> DASHBOARD </strong></h5> -->
                <!-- <h2 class="mb text-left text-primary" style="font-weight: bolder;"> <strong> PROGRESS MISTERY SHOPPER </strong></h2> -->
                <small class="text-muted" style="font-size: 15px; display: none;"><strong>DASHBOARD</strong></small>
                <div style="font-family: 'Fredoka One', cursive; font-size: 30pt; background: linear-gradient(to bottom, #FF0000 50%, #4169E1 50%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">PROGRESS MISTERY SHOPPING</div>
              <hr style="height:0; border-top:5px solid grey; border-radius: 20px;">
               
                </div>
              </div>

              <div class="col-lg-12">
                <?= $this->session->flashdata('info'); ?>
              </div>

              <section id="unseen">
                <form action="<?= base_url('project/input_client') ?>" method="POST" enctype="multipart/form-data">
                
                <div class="form-group">
                  <div class="row">
                    
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Username</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-5 col-xs-7"><input type="text" name="username" class="form-control"></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3 col-xs-3 font-weight-bold"><label for="tembusan" ><strong>Password</strong></label></div>
                    <div class="col-sm-1 col-xs-1">:</div>
                    <div class="col-sm-5 col-xs-7"><input type="password" name="password" class="form-control"></div>
                  </div>
                </div>


                <div class="form-group">
                <div class="row text-right">
                    <div class="col-sm-9">
                      <a href=""><strong>FORGOT PASSWORD?</strong></a>
                      <!-- <input type="reset" name="reset" id="reset" class="btn btn-danger" value="RESET"> -->
                      &nbsp;
                      <input type="submit" name="submit" class="btn btn-primary btn-round" value="LOGIN">
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

