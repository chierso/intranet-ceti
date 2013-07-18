<?php
	$data['title'] = "Importar Notas de Excel - INTRANET IETI";
	echo $this->load->view('inc/header',$data);
?>
	<h1>Resultado del archivo excel</h1>
	<div id="msg"></div>
	<div class="progress progress-striped active" >
  		<div id="progress" class="bar" style="width: 0%;" data-percentage="100"></div>
	</div>
		<form id="frm_excel_sql" method="POST">
			<?php echo $tabla_excel; ?>
		</form> 
    <script src="<?php echo base_url("public/js/utility_excel.js")?>"></script>
<?php
	echo $this->load->view('inc/footer');
?>
