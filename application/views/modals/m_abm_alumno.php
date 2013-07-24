<div id="modalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <form method="post" action="<?php echo base_url("abm/abm_subject/asignar_tutoria")?>" id="frm_edit_alumn">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
      <h3 id="myModalLabel">Editar Alumno</h3>
    </div>
    <div class="modal-body">
      <p>
          Alumno : <span id="pAlumno"></span>
          <hr />
      <input type="hidden" name="txt_person" id="id_person" value="0" />
      <div class="row-fluid">
  			<div class="row-fluid">
				<div class="span12">
					<label for="Direccion">Dirección</label>
					<input required="required" type="text" id="pDireccion" name="txt_direccion" class="span12"  placeholder="EJ. Av. Mercedes Indacochoa Mz. A - LT 03" size="16" />
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
				  	<div class="input-prepend">
						<label for="prepended Input">Correo electrónico</label>			
						<span class="add-on">@</span>
						<input required="required" class="span12" id="pEmail" id="prepended Input" name="txt_email" type="email">					
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<label for="Telefono">Teléfono</label>
					<input required="required" type="text" id="pTelefono" name="txt_telefono" class="span12" placeholder="EJ. 7482005" size="16" />
				</div>
				<div class="span6">
					<label for="Celular">Celular</label>
					<input required="required" type="text" id="pCelular" name="txt_celular" class="span12" placeholder="EJ. 97412587" size="16" />
				</div>
			</div>
	  </div>
  			</p>
    </div>
    <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Guardar" />
        <input type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-dangerr" value="Cancelar" />
      </div>     
      </form>     
</div>
