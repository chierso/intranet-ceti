<!DOCTYPE html>
<html>
<head>
	<title>ABM Alumno - Intranet IETI Santa Rosa de Lima</title>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/style.css")?>">       
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head> 
<body> 
	<div class="container">
		<h1>Intranet Académica</h1>
		<div class="navbar navbar-inverse">
		  <div class="navbar-inner">
		    <a class="brand" href="#">IETI Santa Rosa de Lima</a>
		    <ul class="nav">
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
			<div class="span6">
				<form method="post">
					<div class="span3">
						<label for="grade">Grado: </label>
						<select class="input-small" id="grade" name="cbx_grado">
							<option value="1">1 º</option>
							<option value="2">2 º</option>
							<option value="3">3 º</option>
							<option value="4">4 º</option>
							<option value="5">5 º</option>	
						</select>
					</div>
					<div class="span4">
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
			<div class="span6">
				<form id="buscador">
				<label for="Buscador">Buscador: </label>
				<input type="text" id="Buscador" name="txt_search" class="span9" required="required" placeholder="EJ. Carlos" />
				</form>
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
			<?php 
				foreach($alumnos as $row){
					echo '<tr><td>'.$row->id_alumn.'</td>';
					echo '<td>'.$row->Alumno.'</td>';
					echo '<td>'.$row->Grade.'</td>';
					echo '<td>'.$row->Section.'</td>';
					echo '<td>
							<a data-id="'.$row->id_alumn.'" role="button" href="#modalAdd" class="btn btn-warning btn-mini"><i class="icon-white icon-edit"></i></a>
							<a data-id="'.$row->id_alumn.'" role="button" data-togle="modal" class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i></a>
						  </td></tr>';	
				}
			 ?>
			 </tbody>
			 </table>
			 <!-- TABLA ASIGNADOS -->
			 </div> 
		</div>
			<?php echo $this->load->view('template/_footer') ?> 
   		</div>
    </div> <!-- /container -->   
    <script src="<?php echo base_url("public/js/bootstrap.min.js")?>"></script>
    <!--<script src="<?php echo base_url("public/js/bootstrap-dropdown.js")?>"></script>-->
    <script src="<?php echo base_url("public/js/utility_asignacion.js")?>"></script>
    <!--<script src="<?php echo base_url("public/js/bootstrap-modal.js")?>"></script>-->
</body>
</html>