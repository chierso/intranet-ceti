<!DOCTYPE html>
<!--[if lt IE 7]><html lang="en" class="no-js ie lt-ie9 lt-ie8 lt-ie7"></html><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie lt-ie9 lt-ie8"></html><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie lt-ie9"></html><![endif]-->
<!--[if IE 9]><html lang="en" class="no-js ie lt-ie10"></html><![endif]-->
<!--[if gt IE 9]><!--><html lang="es"><!--<![endif]-->
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap-responsive.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/datepicker.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/style.css")?>">       
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head> 
<body> 
	<div class="container">
		<h1>Intranet Académica</h1>
		<div class="navbar navbar-inverse">
		  <div class="navbar-inner">
		    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
          	</a>
		    <a class="brand" href="#">IETI Santa Rosa</a>
		    <ul class="nav nav-collapse">
		      <li><a href="<?php echo base_url("")?>">Home</a></li>
		      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acciones <b class="caret"></b></a>
                        <?php
            				echo $this->load->view('inc/nav');
            			?> 
             </li>
		     <li><a href="<?php echo site_url('login/logout'); ?>">Cerrar sesión</a></li>
		   </ul>
		  </div>
		</div>
		<div class="row-fluid">
		<div class="span12 hero">