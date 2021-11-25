<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title> MRI - Operation </title>

  <!-- Favicons -->
  <link href="<?= base_url('assets/') ?>img/favicon.png" rel="icon">
  <link href="<?= base_url('assets/') ?>img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url('assets/') ?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="<?= base_url('assets/') ?>lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" action="<?= base_url('auth2') ?>" method="post">
        <h2 class="form-login-heading">sign in now</h2>
        <br>
        <div class="col-lg-12">
          <?= $this->session->flashdata('info'); ?>
        </div>
        <div class="login-wrap">
          <input type="text" id="username" name="username" class="form-control" placeholder="User ID" value="<?= set_value('username') ?>" autofocus>
          <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
          <br>
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
          <hr>
          <button type="submit" class="btn btn-theme btn-block"><i class="fa fa-lock"></i> SIGN IN</button>
        </div>
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="<?= base_url('assets/') ?>lib/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="<?= base_url('assets/') ?>lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
  </script>
</body>

</html>