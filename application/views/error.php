<?php
	$data['title'] = "ERROR! - INTRANET IETI";
	echo $this->load->view('inc/header',$data);
?>
	<h1>Error</h1>
	<div class="alert alert-error"><?php echo $error; ?></div>
<?php
	echo $this->load->view('inc/footer');
?>