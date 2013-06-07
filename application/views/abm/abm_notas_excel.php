<!DOCTYPE html>
<html>
<head>
	<title>ABM Alumno - Intranet IETI Santa Rosa de Lima</title>
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
				<div class="span12">
					<form method="post" id="buscador">
						<div class="row-fluid">
						<div class="span3">
							Bimestre:<br />
							<label class="radio inline"> 
						  		<input type="radio" name="rbt_bimester" value="1">I
							</label>
							<label class="radio inline"> 
						  		<input type="radio" name="rbt_bimester" value="2">II
							</label>
							<label class="radio inline"> 
								<input type="radio" name="rbt_bimester" value="3">III
							</label>
							<label class="radio inline"> 
								<input type="radio" name="rbt_bimester" value="4">IV
							</label>
							<!--<label for="Buscador">Buscador: </label>
							<input type="text" id="Buscador" name="txt_search" class="span9" placeholder="EJ. Carlos" />-->
						</div>
						<div class="span2">
							<label for="grade">Grado: </label>
							<select class="input-small" id="grade" name="cbx_grado">
								<option value="1">1 º</option>
								<option value="2">2 º</option>
								<option value="3">3 º</option>
								<option value="4">4 º</option>
								<option value="5">5 º</option>	
							</select>
						</div>
						<div class="span2">
							<label>Sección: </label>
							<label class="radio inline"> 
						  		<input type="radio" name="rbt_section" value="A">A
							</label>
							<label class="radio inline"> 
						  		<input type="radio" name="rbt_section" value="B">B
							</label>
							<label class="radio inline"> 
								<input type="radio" name="rbt_section" value="C">C
							</label>
						</div>
						<div class="span3">
							<label>Curso:</label>
							<select id="subject" name="cbx_subject">
								<?php foreach($cursos as $row){
								echo '<option value="'.$row->id_subject.'">'.$row->name.'</option>';	
								}?>	
							</select>
						</div>
						<div class="span2">
							<br />
							<button class="btn btn-info" style="vertical-align: bottom;" type="submit">Filtrar</button>
						</div>
						</div>
					</form>
				</div>
				<div class="row-fluid">
					<hr />
				</div>
				<form id="frm_excel_sql" method="POST">
		            
		            	<?php echo $tabla_excel; ?>
		
					<input type="submit" class="btn btn-success" value="Confirmar" />
					<input type="reset" class="btn btn-danger" value="Cancelar" />
				</form> 
		</div>
	<?php echo $this->load->view('template/_footer') ?> 
 	</div>
    </div> <!-- /container -->   
    <script src="<?php echo base_url("public/js/bootstrap.min.js")?>" charset="utf-8" ></script>
    <script src="<?php echo base_url("public/js/utility_excel.js")?>"></script>
</body>
</html>