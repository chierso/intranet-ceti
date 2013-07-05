<?php
	$data['title'] = "Reporte Alumno - INTRANET IETI";
	echo $this->load->view('inc/header',$data);
?>
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
<?php
	echo $this->load->view('inc/footer');
?>