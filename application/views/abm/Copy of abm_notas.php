<!DOCTYPE html>
<html>
<head>
	<title>ABM Alumno - Intranet IETI Santa Rosa de Lima</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap-responsive.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/style.css")?>">       
	<script src="<?php echo base_url("public/js/jquery.min.js")?>"></script>
	<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
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
                  <?php echo $this->load->view('template/nav'); ?> 
             </li>
		     <li><a href="<?php echo site_url('login/logout'); ?>">Cerrar sesión</a></li>
		   </ul>
		  </div>
		</div>
		<div class="row-fluid">
		<div class="span12">
			<div class="row-fluid">
			<div class="span12">
				<form method="post" id="buscador">
					<div class="span4">
						<label for="Buscador">Buscador: </label>
						<input type="text" id="Buscador" name="txt_search" class="span9" placeholder="EJ. Carlos" />
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
					  		<input type="radio" name="rbt_seccion" value="A">A
						</label>
						<label class="radio inline"> 
					  		<input type="radio" name="rbt_seccion" value="B">B
						</label>
						<label class="radio inline"> 
							<input type="radio" name="rbt_seccion" value="C">C
						</label>
					</div>
					<div class="span4">
						<br />
						<button class="btn btn-info" style="vertical-align: bottom;" type="submit">Filtrar</button>
					</div>
				</form>
			</div>
			</div>
			<hr />
			<div id="results">
			<table class="table">
			<thead>
                <tr>
                  <th>#</th>
                  <th>Alumno</th>
                  <th>Grado</th>
                  <th>Sección</th>
                  <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tbody">
			<?php $cont = 1;
				foreach($alumnos as $row){
					echo '<tr><td>'.$cont.'</td>';$cont++;
					echo '<td>'.$row->fullname.'</td>';
					echo '<td>'.$row->grade.'</td>';
					echo '<td>'.$row->section.'</td>';
					echo '<td>
							<a data-id="'.$row->id.'" class="btn btn-mini" id="test"">As</a>
							<a data-id="'.$row->id.'" role="button" data-target="#modalNotas	" data-toggle="modal" class="btn btn-warning btn-mini"><i class="icon-white icon-edit"></i></a>
							<a data-id="'.$row->id.'" role="button" data-target="#modalDel" data-togle="modal" class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i></a>
						  </td></tr>';	
				}
			 ?>
			 </tbody>
			 </table>
			 </div> 
	</div>
	<?php
 		$data['cursos'] = $cursos; 
 		echo $this->load->view('modal/modal_notas',$data);
	?>
		<?php echo $this->load->view('template/_footer') ?> 
 	</div>

 		
    </div> <!-- /container -->   
    <script src="<?php echo base_url("public/js/bootstrap.min.js")?>"></script>
    <script src="<?php echo base_url("public/js/utility_notas.js")?>"></script>
</body>
</html>