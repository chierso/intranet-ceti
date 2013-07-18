<?php
	$data['title'] = "ABM Alumno - INTRANET IETI";
	echo $this->load->view('inc/header',$data);
?>
		<div class="span12">
			<div class="span12">
				<form method="post" id="buscador">
					<div class="span4">
						<label for="Buscador">Buscador: </label>
						<input type="text" id="Buscador" name="txt_search" class="span12" placeholder="EJ. Carlos" />
					</div>
					<div class="span3">
						<label for="grade">Grado: </label>
						<select class="input" id="grade" name="cbx_grado">
							<option value=""></option>
							<option value="1">1 º</option>
							<option value="2">2 º</option>
							<option value="3">3 º</option>
							<option value="4">4 º</option>
							<option value="5">5 º</option>	
						</select>
					</div>
					<div class="span3">
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
					<div class="span2">
						<br />
						<button class="btn btn-info" style="vertical-align: bottom;" type="submit">Filtrar</button>
					</div>
				</form>
			</div>
			<hr />
			<div id="msg">
				
			</div>
			<div id="results">
			<form id="habilitar" method="POST">
				<table class="table table-striped">
				<thead>
	                <tr>
	                  <th>    </th>
	                  <th>Alumno</th>
	                  <th>Grado</th>
	                  <th>Sección</th>
	                </tr>
	            </thead>
	            <tbody id="tbody">
				<?php $cont = 1;
					foreach($alumnos as $row){
						echo '<tr><td><input type="checkbox" name="check[]" value='.$row->id_alumn.'/></td>';$cont++;
						echo '<td>'.$row->Alumno.'</td>';
						echo '<td>'.$row->Grade.'</td>';
						echo '<td>'.$row->Section.'</td>';
						echo '</tr>';	
					}
				 ?>
				 </tbody>
				 </table>
				 <input type="button" id="hab" class="btn btn-success" value="Habilitar" />
				 <input type="button" id="inhab" class="btn btn-error" value="Inhabilitar" />
			 </form>
			 </div> 
	</div>
    <script src="<?php echo base_url("public/js/util_habiles.js")?>"></script>
<?php
	echo $this->load->view('modals/m_abm_alumno');
	echo $this->load->view('inc/footer');    
?>