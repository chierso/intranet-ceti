<?php
	$data['title'] = "Registrar Nuevo Docente - INTRANET IETI";
	echo $this->load->view('inc/header',$data);
?>
	<h1>Registrar Docente</h1>
	<div id="msg"></div>
	<form id="add_docente" method="POST">
	<div class="row-fluid">
		<div class="span6">
			<label for="Nombres">Nombres</label>
			<input type="text" id="Nombres" name="txt_nombres" class="span12" required placeholder="EJ. Carlos Antonio" size="16" />
		</div>
		<div class="span6">
			<label for="Apellidos">Apellidos</label>
			<input type="text" id="Apellidos" name="txt_apellidos" class="span12" required placeholder="EJ. Eguizabal Torres" size="16" />
		</div>
		<div class="row-fluid">
			<div class="span8">
				<label for="Direccion">Dirección</label>
				<input type="text" id="Direccion" name="txt_direccion" class="span12" required placeholder="EJ. Av. Mercedes Indacochoa Mz. A - LT 03" size="16" />
			</div>
			<div class="span4">
			  	<label for="dni">DNI</label>
			  	<input type="number" id="dni" required="required" name="txt_dni" placeholder="EJ. 71147854">
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<label for="Telefono">Teléfono</label>
				<input type="text" id="Telefono" name="txt_telefono" class="span12" required placeholder="EJ. 7482005" size="16" />
			</div>
			<div class="span6">
				<label for="Celular">Celular</label>
				<input type="text" id="Celular" name="txt_celular" class="span12" required placeholder="EJ. 97412587" size="16" />
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4">
				<label class="etiqueta">Sexo</label>
				<label class="radio inline"> 
			  		<input type="radio" name="rbt_sexo" value="M">MASCULINO
				</label>
				<label class="radio inline"> 
					<input type="radio" name="rbt_sexo" value="F">FEMENINO
				</label>
			</div>
			<div class="span4">
				<label class="etiqueta">Fecha Nacimiento</label>
				 	<div class="input-append date" id="dpYears" data-date="19-09-1999" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
				  		<input class="span9" size="16" type="text" placeholder="dd-mm-yy" name="txt_fec_nacimiento" readonly>
						<span class="add-on"><i class="icon-th"></i></span>
					</div>
			</div>
			<div class="span4">
				<div class="input-prepend">
					<label for="prepended Input">Correo electrónico</label>			
					<span class="add-on">@</span>
					<input class="span12" id="prepended Input" name="txt_email" type="email">					
				</div>
			</div>
		</div>
	</div>
	<button class="btn btn-success" type="submit">Agregar</button>
	<button class="btn" type="reset">Cancelar</button>
</form>
<script src="<?php echo base_url("public/js/bootstrap-datepicker.js")?>" ="utf-8"></script>
<script src="<?php echo base_url("public/js/utility.js")?>" ="utf-8"></script>
<?php
	echo $this->load->view('inc/footer');
?>