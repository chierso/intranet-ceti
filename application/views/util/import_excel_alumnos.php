<?php
	$data['title'] = "Importar Alumno de Excel - INTRANET IETI";
	echo $this->load->view('inc/header',$data);
	$bim = $this -> session -> userdata("Bimester");
?>
	<h1>Importar Alumnos de Excel</h1>
	<div class="alert alert-info">
		<b>Atención!</b><br>
		Antes de subir un archivo excel, asegurate de que los nombres estén correctamente inscritos, de lo contrario la operación fallará.<br>
		Además, asegurate que el Grado y Sección sean los correctos.
	</div>
		<form action="<?php echo site_url('import/import_excel_alumnos/xls2array'); ?>" method="post" enctype="multipart/form-data">
			<div class="span4">
				<label>Solo archivos *.xls</label>
					<input data-input="false" required="required" class="filestyle" accept="application/vnd.ms-excel" type="file" name="file" />	
				
			</div>
			<div class="span4">
				<label for="grade">Grado: </label>
				<select required="required" class="input" id="grade" name="cbx_grado">
					<option value=""></option>
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
			  		<input required="required" type="radio" name="rbt_seccion" value="A">A
				</label>
				<label class="radio inline"> 
			  		<input required="required" type="radio" name="rbt_seccion" value="B">B
				</label>
				<label class="radio inline"> 
					<input required="required" type="radio" name="rbt_seccion" value="C">C
				</label>
			</div>
			<div class="span12"><input class="btn btn-info" type="submit" value="Enviar" /></div>
			
		</form>
    <script src="<?php echo base_url("public/js/utility_notas.js")?>"></script>
    <script src="<?php echo base_url("public/js/bootstrap-filestyle.min.js")?>"></script>
<?php
	echo $this->load->view('inc/footer');
?>