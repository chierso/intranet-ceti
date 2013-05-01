<a class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i> Agregar Nuevo Curso</a>
<table class="table table-condensed">
	<thead><td width="100">Curso</td><td width="150">Docente</td><td width="50">Salón</td><td width="50">Acción</td></thead>
	<tbody>
		<?php 
			$this->load->model("abm/abm_subject_model");
			$dataCurso_Docente = $this->abm_subject_model->listarCursos();
			
			foreach($dataCurso_Docente as $row) {
			echo '<tr>'.$row->curso.'</tr><tr>'.$row->docente.'</tr><tr>'.$row->salon.'</tr><tr>Alta - Baja - Mod</tr>';
			} ?>
 	</tbody>
</table>