<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Dashboard">
	<meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<title><?= $judul ?></title>

	<style>
		.text-warning1 {
			color: #ffc107;
		}

		@media print {
			.sign {
				display: block !important;
			}
		}

		/* .table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  -ms-overflow-style: -ms-autohiding-scrollbar;
}

.table-responsive > .table-bordered {
  border: 0;
} */
		@media (max-width: 575.98px) {
			.table-responsive-sm {
				display: block;
				width: 100%;
				overflow-x: auto;
				-webkit-overflow-scrolling: touch;
				-ms-overflow-style: -ms-autohiding-scrollbar;
			}

			.table-responsive-sm>.table-bordered {
				border: 0;
			}

			.kecil {
				max-width: 250px !important;
			}

			.prev {
				margin-left: 0 !important;
			}

			.next {
				margin-right: 0 !important;
			}
		}
	</style>

	<!-- Favicons -->
	<link href="<?= base_url('assets/') ?>img/favicon.png" rel="icon">
	<link href="<?= base_url('assets/') ?>img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Bootstrap core CSS -->
	<link href="<?= base_url('assets/') ?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!--external css-->
	<link href="<?= base_url('assets/') ?>lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.0.8/font-awesome-animation.min.css" />

	<!-- Custom styles for this template -->
	<link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
	<link href="<?= base_url('assets/') ?>css/style-responsive.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>lib/bootstrap-fileupload/bootstrap-fileupload.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>lib/bootstrap-datepicker/css/datepicker.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>lib/bootstrap-daterangepicker/daterangepicker.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>lib/bootstrap-timepicker/compiled/timepicker.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>lib/bootstrap-datetimepicker/css/datetimepicker.css" />

	<link href="<?= base_url('assets/') ?>lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
	<link href="<?= base_url('assets/') ?>lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>lib/advanced-datatable/css/DT_bootstrap.css" />
	<link href="<?= base_url('assets/') ?>lib/fancybox/jquery.fancybox.css" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap-select.min.css" />

	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
	<link href="<?= base_url('assets/') ?>stylemusik.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<script src="https://kit.fontawesome.com/f04104d6a4.js" crossorigin="anonymous"></script>

	<!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
	<!-- Carosel -->
	<style>
		* {
			box-sizing: border-box
		}

		/* Slideshow container */
		.slideshow-container {
			max-width: 1000px;
			position: relative;
			margin: auto;
		}

		/* Hide the images by default */
		.mySlides {
			display: none;
		}

		.prev:hover,
		.next:hover {
			/* background-color: rgba(0,0,0,0.8); */
			background-color: rgba(78, 205, 196, 0.8) !important;
		}

		.hover:hover {
			background-color: rgba(78, 205, 196, 0.8) !important;
		}

		/* YANG IWAYRIWAY UBAH CSS NYA*/
		/* .text {
		  color: #f2f2f2;
		  font-size: 15px;
		  padding: 8px 12px;
		  position: absolute;
		  bottom: 8px;
		  width: 100%;
		  text-align: center;
		} */

		/* Number text (1/3 etc) */
		.numbertext {
			color: #1c1d2f;
			font-size: 12px;
			padding: 8px 12px;
			position: absolute;
			top: 0;
		}

		/* The dots/bullets/indicators */
		.dot {
			cursor: pointer;
			height: 15px;
			width: 15px;
			margin: 0 2px;
			background-color: #bbb;
			border-radius: 50%;
			display: inline-block;
			transition: background-color 0.6s ease;
		}

		.active,
		.dot:hover {
			/* background-color: #4ecdc4; */
		}

		/* Fading animation */
		.fade {
			-webkit-animation-name: fade;
			-webkit-animation-duration: 1.5s;
			animation-name: fade;
			animation-duration: 1.5s;
		}

		.tooltip1 {
			position: relative;
		}

		.tooltip1 .tooltiptext1 {
			visibility: hidden;
			width: 120px;
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;
			position: absolute;
			z-index: 1;
			top: -5px;
			right: 110%;
		}

		.tooltip1 .tooltiptext1::after {
			content: "";
			position: absolute;
			top: 50%;
			left: 100%;
			margin-top: -5px;
			border-width: 5px;
			border-style: solid;
			border-color: transparent transparent transparent black;
		}

		.tooltip1:hover .tooltiptext1 {
			visibility: visible;
		}

		.tooltip2 {
			position: relative;
		}

		.tooltip2 .tooltiptext2 {
			visibility: hidden;
			width: 120px;
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;
			position: absolute;
			z-index: 1;
			top: 150%;
			left: 50%;
			margin-left: -60px;
		}

		.tooltip2 .tooltiptext2::after {
			content: "";
			position: absolute;
			bottom: 100%;
			left: 50%;
			margin-left: -5px;
			border-width: 5px;
			border-style: solid;
			border-color: transparent transparent black transparent;
		}

		.tooltip2:hover .tooltiptext2 {
			visibility: visible;
		}

		.tooltip3 {
			position: relative;
			/* display: inline-block; */
		}

		.tooltip3 .tooltiptext3 {
			visibility: hidden;
			width: 120px;
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;
			position: absolute;
			z-index: 1;
			bottom: 125%;
			left: 50%;
			margin-left: -60px;
			opacity: 0;
			transition: opacity 0.3s;

		}

		.tooltip3 .tooltiptext3::after {
			/* content: "";
				position: absolute;
				top: 100%;
				left: 50%;
				margin-left: -5px;
				border-width: 5px;
				border-style: solid;
				border-color: transparent transparent black transparent; */
			/* TOP */
			content: " ";
			position: absolute;
			top: 100%;
			left: 50%;
			margin-left: -5px;
			border-width: 5px;
			border-style: solid;
			border-color: black transparent transparent transparent;
			/* AKHIR TOP */

		}

		.tooltip3:hover .tooltiptext3 {
			visibility: visible;
			opacity: 1;
		}


		@-webkit-keyframes fade {
			from {
				opacity: .4
			}

			to {
				opacity: 1
			}
		}

		@keyframes fade {
			from {
				opacity: .4
			}

			to {
				opacity: 1
			}
		}
	</style>
	<!-- Akhir Carosel -->

	<!-- Tooltip -->
	<style>
		.tooltip-cst {
			position: relative;
			display: inline-block;
		}

		.tooltip-cst .tooltiptext-cst {
			visibility: hidden;
			width: 120px;
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;
			position: absolute;
			z-index: 1;
			top: -15px;
			right: 110%;
		}

		.tooltip-cst .tooltiptext::after-cst {
			content: "";
			position: absolute;
			top: 50%;
			left: 100%;
			margin-top: -5px;
			border-width: 5px;
			border-style: solid;
			border-color: transparent transparent transparent black;
		}

		.tooltip-cst:hover .tooltiptext-cst {
			visibility: visible;
		}
	</style>
	<!-- End Tooltip -->
</head>

<body>
	<section id="container" class="sidebar-closed">

		<?php date_default_timezone_set('Asia/Bangkok'); ?>

		<!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
		<!--header start-->
		<header class="header black-bg">
			<div class="sidebar-toggle-box">
				<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation" aria-hidden="true"></div>
			</div>
			<!--logo start-->
			<a href="#" class="logo"><b>MRI<span> ENTERPRISE</span></b></a>
			<!--logo end-->
			<!-- <div class="nav notify-row">
        <ul class="nav top-menu">
          <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
              <i class="fa fa-bell-o"></i>
              <span class="badge bg-warning">7</span>
              </a>
            <ul class="dropdown-menu extended notification">
              <div class="notify-arrow notify-arrow-yellow"></div>
              <li>
                <p class="yellow">You have 7 new notifications</p>
              </li>
              <li>
                <a href="index.html#">
                  <span class="label label-danger"><i class="fa fa-bolt"></i></span>
                  Server Overloaded.
                  </a>
              </li>
            </ul>
          </li>
        </ul>
      </div> -->
			<div class="top-menu">
				<ul class="nav pull-right top-menu">
					<li><a class="logout" href="<?= base_url('auth2/logout') ?>">Logout</a></li>
				</ul>
			</div>
			<!--logo end-->

		</header>
		<!--header end-->
		<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->