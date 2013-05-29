<!DOCTYPE html>
<html>
<head>
	<title>ABM Curso</title>
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
			<?php
				echo '<h3>Alumno: '.$cursos[0]->Alumno.'</h3>';		
			?>
			<a class="btn" href="<?php echo site_url('reports/record/reporteAlumnoParametroPDF/'.$cursos[0]->id_alumn); ?>"><i class="icon-file"> </i>PDF</a>
		<div class="span12">
			<table class="table">
				<thead>
	                <tr>
	                  <th>Curso</th>
	                  <th>Promedio I B.</th>
	                  <th>Promedio II B.</th>
	                  <th>Promedio III B.</th>
	                  <th>Promedio IV B.</th>
	                  
	              <!--<th>Grado</th>
	                  <th>Sección</th>
	                  <th>Acción</th>-->
	                </tr>
	            </thead>
	                <tbody id="tbody">
		            	<?php
		            		foreach($cursos as $row){
		            			echo '<tr>'.
		            				 '<td>'.$row->name.'</td>'.
		            				 '<td>'.$row->N1_average.'</td>'.
		            				 '<td>'.$row->N2_average.'</td>'.
		            				 '<td>'.$row->N3_average.'</td>'.
		            				 '<td>'.$row->N4_average.'</td>'.
		            				 '</tr>';
		            		}
		            	?>
		            </tbody>
				
				</table>
		</div>
			<?php echo $this->load->view('template/_footer') ?> 
   		</div>
    </div> <!-- /container -->   
    <script src="<?php echo base_url("public/js/bootstrap-dropdown.js")?>"></script>
</body>
</html>