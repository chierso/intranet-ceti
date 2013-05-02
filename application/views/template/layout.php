<!DOCTYPE html>
<!--[if lt IE 7]><html lang="en" class="no-js ie lt-ie9 lt-ie8 lt-ie7"></html><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie lt-ie9 lt-ie8"></html><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie lt-ie9"></html><![endif]-->
<!--[if IE 9]><html lang="en" class="no-js ie lt-ie10"></html><![endif]-->
<!--[if gt IE 9]><!--><html lang="en"><!--<![endif]-->
<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/datepicker.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/style.css")?>">       
	<link rel="stylesheet" href="<?php echo base_url("public/css/jquery.dataTables.css")?>">    
	<link rel="stylesheet" href="<?php echo base_url("public/css/jquery.dataTables_themeroller.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/jquery/jquery-ui-1.8.23.custom.css")?>">
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head> 
<body> 
	<div class="container">
		<h1>Intranet Académica</h1>
		<div class="navbar navbar-inverse">
		  <div class="navbar-inner">
		    <a class="brand" href="#">IETI Santa Rosa de Lima</a>
		    <ul class="nav">
		      <li class="active"><a href="#">Home</a></li>
		      <li><a href="#">Link</a></li>
		      <li><a href="<?php echo site_url('login/logout'); ?>">Cerrar sesión</a></li>
		    </ul>
		  </div>
		</div>
		<div class="row-fluid">
		<div class="span3">
          <div class="well sidebar-nav">
            <?php
            	echo $this->load->view('template/nav');
            ?> 
          </div><!--/.well -->
        </div>
		<div class="span9">
			<h1><?php if(isset($h1)) echo $h1; ?></h1>
			<?php echo $this->load->view($content) ?>  
		</div>
			<?php echo $this->load->view('template/_footer') ?> 
   		</div>
    </div> <!-- /container -->   
</body>
</html>