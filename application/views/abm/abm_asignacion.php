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
                  <th>Docente</th>
                  <th>Acción</th>
                </tr>
            </thead>
            <tbody>
			<?php 
				foreach($docentes as $row){
					echo '<tr><td class="id_docente">'.$row->id_docente.'</td>';
					echo '<td>'.$row->Docente.'</td>';
					echo '<td>
							<a data-id="'.$row->id_docente.'" data-docente="'.$row->Docente.'" role="button" data-target="#modalAdd" data-toggle="modal" class="btn btn-success btn-mini"><i class="icon-white icon-plus"></i></a>
							<a data-id="'.$row->id_docente.'" role="button" href="#modalAdd" class="btn btn-warning btn-mini"><i class="icon-white icon-edit"></i></a>
							<a data-id="'.$row->id_docente.'" role="button" data-togle="modal" class="btn btn-danger btn-mini"><i class="icon-white icon-remove"></i></a>
						  </td></tr>';
					
				}
			 ?>
			 </tbody>
			 </table>
			 <!-- TABLA ASIGNADOS --> 
			 
			 <h1>Tutores <?php echo $this->session->userdata('Year'); ?></h1>
			 <table class="table">
			<thead>
                <tr>
                  <th>#</th>
                  <th>Docente</th>
                  <th>Salón</th>
                  <th>Año</th>
                </tr>
            </thead>
            <tbody>
			<?php 
				foreach($tutoria as $row){
					echo '<tr><td class="id_docente">'.$row->ID.'</td>';
					echo '<td>'.$row->Docente.'</td>';
					echo '<td>'.$row->Salon.'</td>';
					echo '<td>'.$row->Ano.'</td>';
					echo '</tr>';
				}
			 ?>
			 </tbody>
			 </table>
			 
<div id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	  <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
	    <h3 id="myModalLabel">Asignar Tutoría</h3>
	  </div>
	  <div class="modal-body">
	    <p>
	    	<form method="post" action="<?php echo base_url("abm/abm_subject/asignar_tutoria")?>" id="frm_add">
	    		Docente : <span id="pDocente"></span>
	    		<hr />
	    		<input type="hidden" name="id_docente" id="id_docente" value="0" />
	    		<div class="row-fluid">
			<div class="span6">
				<label for="grade">Grado: </label>
				<select id="grade" name="cbx_grado">
					<option value="1">1 º</option>
					<option value="2">2 º</option>
					<option value="3">3 º</option>
					<option value="4">4 º</option>
					<option value="5">5 º</option>	
				</select>
			</div>
			<div class="span6">
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
	</div>
	<input type="submit" value="add" class="btn" />
	    	</form>	    	
	    </p>
	  </div>
	  <div class="modal-footer">
	  	<div class="row-fluid fila_datos">
		  	<div class="progress progress-striped span7">
			  <div class="bar"></div>
			</div>
			<div>
				<button type="submit" name="btn_confirmar" class="btn btn-primary">Guardar</button>
		    	<button type="button" name="btn_cancelar2" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
			</div>		  					
	  	</div>	  	    
	  </div>
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