<?php
	$data['title'] = "Filtro Habilitados - INTRANET IETI";
	echo $this->load->view('inc/header',$data);
?>
		<div class="span12">
			<div class="span12">
				<form method="post" id="filtro">
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
			<div id="results">
			<table class="table table-striped">
			<thead>
                <tr>
                  <th>#</th>
                  <th>Alumno</th>
                  <th>Grado</th>
                  <th>Sección</th>
                  <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tbody">
			
			 </tbody>
			 </table>
	<form id="toPDF" method="post" action="<?php echo site_url('reports/habiles/toPDF'); ?>">
		<input type="hidden" id="txt_search" name="txt_search" />
		<input type="hidden" id="g" name="cbx_grado" />
		<input type="hidden" id="s" name="rbt_seccion" />
	</form>
	<a class="btn btn-info" id="reportar">Exportar a PDF</a>
			 </div> 
	</div>
	<script src="http://localhost:81/intranet-ceti/public/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url("public/js/util_habiles.js")?>"></script>
<?php
	echo $this->load->view('inc/footer');    
?>