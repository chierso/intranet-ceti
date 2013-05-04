<!DOCTYPE html>
<html>
<head>
	<title>Asignación de Tutoría</title>
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
            <tbody>
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
			<?php echo $this->load->view('template/_footer') ?> 
   		</div>
    </div> <!-- /container -->   
    <script src="<?php echo base_url("public/js/bootstrap.min.js")?>"></script>
    <!--<script src="<?php echo base_url("public/js/bootstrap-dropdown.js")?>"></script>-->
    <script src="<?php echo base_url("public/js/utility_asignacion.js")?>"></script>
    <!--<script src="<?php echo base_url("public/js/bootstrap-modal.js")?>"></script>-->
</body>
</html>