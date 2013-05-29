<!DOCTYPE html>
<html>
<head>
	<title>Importar Notas - Intranet IETI Santa Rosa de Lima</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap-responsive.min.css")?>">
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
		    <a class="brand" href="#">IETI Santa Rosa de Lima</a>
		    <ul class="nav nav-collapse">
		      <li><a href="<?php echo base_url("")?>">Home</a></li>
		      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acciones <b class="caret"></b></a>
                        <?php
            	echo $this->load->view('template/nav');
            ?> 
             </li>
		     <li><a href="<?php echo site_url('login/logout'); ?>">Cerrar sesión</a></li>
		   </ul>
		  </div>
		</div>
		<div class="row-fluid">
			<div class="span12">
				<form action="<?php echo site_url('import/import_excel/xls2array'); ?>" method="post" enctype="multipart/form-data">
					<input class="input-large" type="file" name="file" />
					<input type="submit" value="Enviar" />
				</form>
			</div>
	<?php echo $this->load->view('template/_footer') ?> 
 	</div>
    </div> <!-- /container -->   
    <script src="<?php echo base_url("public/js/bootstrap.min.js")?>"></script>
    <script src="<?php echo base_url("public/js/utility_notas.js")?>"></script>
</body>
</html>