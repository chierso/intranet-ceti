<?php
	$this->load->helper("form");
	echo form_open("abm/registro/aperturarAno");
?>
	<div class="row-fluid">
		<div class="span6">
			<label for="Ano">Año académico</label>
			<input type="number" id="Ano" name="txt_ano" class="span12" required placeholder="2013" size="16" />
		</div>
	</div>
	<button class="btn btn-success" type="submit">Agregar</button>
	<button class="btn" type="reset">Cancelar</button>
	<?php
		echo form_close();
	?>
<script src="<?php echo base_url("public/js/bootstrap-datepicker.js")?>"></script>
<script src="<?php echo base_url("public/js/utility.js")?>"></script>
