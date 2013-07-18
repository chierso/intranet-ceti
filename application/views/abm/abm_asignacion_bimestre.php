<?php
	$data['title'] = "Calendarización de Bimestres- INTRANET IETI";
	echo $this->load->view('inc/header',$data);
?>
	<h1>Asignacion de fechas de Bimestres para el año <?php echo date('Y'); ?></h1>
	<div id="msg">
		
	</div>
	<form id="frm_calendario" method="POST">
	<?php
		if($bimester==null){
			?>
			<input type="hidden" id="action" name="action" value="insert" /> 
			<div class="alert alert-error">
  					Aún no se han asignado las fechas para el año actual.
			</div>
			I   Bimestre : <input type="date" name="ibimestre" /><br />
			II  Bimestre : <input type="date" name="ibimestre" /><br />
			III Bimestre : <input type="date" name="ibimestre" /><br />
			IV  Bimestre : <input type="date" name="ibimestre" /><br />
			<?php } 
		else { 
			$bimestre = $bimester[0];
			?>
 			<input type="hidden" id="action" name="action" value="update" />
	 			<div class="span6">I   Bimestre :</div><input class="span6" type="date" name="ibimestre" value="<?php echo $bimestre->primer_bimestre ?>" />
				<div class="span6">II  Bimestre :</div><input class="span6" type="date" name="iibimestre" value="<?php echo $bimestre->segundo_bimestre ?>" />
				<div class="span6">III Bimestre :</div><input class="span6" type="date" name="iiibimestre" value="<?php echo $bimestre->tercer_bimestre ?>" />
				<div class="span6">IV  Bimestre :</div><input class="span6" type="date" name="ivbimestre" value="<?php echo $bimestre->cuarto_bimestre ?>" />
		<?php }	?>
			<input type="submit" class="btn btn-success" value="Guardar" />
			<input type="reset" class="btn btn-danger" value="Cancelar" />
		</form> 
    <script src="<?php echo base_url("public/js/util_bimestres.js")?>"></script>
<?php
	echo $this->load->view('inc/footer');
?>
