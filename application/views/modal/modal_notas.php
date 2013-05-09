<div id="modalNotas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
      <h3 id="myModalLabel">Asignación de notas</h3>
    </div>
    <div class="modal-body">
      <p>
      	Alumno: <span id="pAlumno"></span>
          <hr />  
        <form method="post" id="frm_notas">
          <input type="hidden" name="id_alumno" id="id_alumno" value="0" />
          <table class="table table-striped">
			<thead>
			<tr align="center">
			<th rowspan="2"></th>
			<th colspan="4">BIMESTRES</th>
			</tr>
			<tr>
			<th>I</th>
			<th>II</th>
			<th>III</th>
			<th>IV</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach($cursos as $row){
			echo '<tr>'+
			'<td>'.$row->name.'</td>'+
			'<td>0</td>'+
			'<td>0</td>'+
			'<td>0</td>'+
			'<td>0</td>'+
			'</tr>';
			 } ?>
			</tbody>
		</table>

        </form>        
      </p>
    </div>
    <div class="modal-footer">
      <div class="row-fluid">
        <?php echo date('Y'); ?>
      </div>
      <div>
          <button type="submit" name="btn_confirmar" id="btnSave" class="btn btn-primary">Guardar</button>
          <button type="button" name="btn_cancelar2" id="btnCancel" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
      </div>                
      </div>          
    </div>
</div>