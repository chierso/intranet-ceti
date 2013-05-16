<div id="modalNotas">
	  <p>
          <input type="hidden" name="id_alumno" id="id_alumno" value="0" />
          <input type="hidden" name="bimester" id="bimester" value="0" />
          <table class="table table-condensed table-bordered">
			<thead>
			<tr align="center">
			<th rowspan="2">Alumno: <span id="pAlumno"></span></th>
			<th colspan="4">BIMESTRES</th>
			</tr>
			<tr>
			<th>I</th><th>II</th><th>III</th><th>IV</th>
			</tr>
			</thead>
			<tbody>
				<tr></tr>
			<?php 
			foreach($cursos as $row){
			echo '<tr>'.
			'<td>'.$row->name.'</td>'.
			'<td><input name="'.$row->id_subject.'[]" data-bimester="I" type="number" min="0" max="20" class="input-small" /></td>'.
			'<td><input name="'.$row->id_subject.'[]" data-bimester="II" type="number" min="0" max="20" class="input-small" /></td>'.
			'<td><input name="'.$row->id_subject.'[]" data-bimester="III" type="number" min="0" max="20" class="input-small" /></td>'.
			'<td><input name="'.$row->id_subject.'[]" data-bimester="IV" type="number" min="0" max="20" class="input-small" /></td>'.
			'</tr>';
			 } ?>
			</tbody>
		</table>
		<input type"submit" id="Guardar" data-bimester="I" />
    º  </p>
</div>