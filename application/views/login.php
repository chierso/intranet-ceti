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
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap-responsive.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/style.css")?>">    
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head> 
<body> 
<div class="container">	
	<h1>Intranet Académica</h1>
	<div id="form_login">	
		<form id="login" method="post">
			<div id="msg"></div>
			<input type="text" required class="input-block-level" name="txt_usuario" placeholder="Correo electrónico">
			<input type="password" required class="input-block-level" name="txt_password" placeholder="Contraseña">
			<button class="btn btn-large btn-primary" type="submit">Acceder</button>
		</form>
	</div>
	<script src="<?php echo base_url("public/js/login.js")?>"></script>
	<hr />
	Intranet Académica - IETI "SANTA ROSA DE LIMA"
	</div>
</body>