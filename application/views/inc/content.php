	<h1><?php if(isset($h1)) echo "<h1>$h1</h1>"; ?></h1>
	<?php if(isset($view)){
		  echo $this->load->view($view);
		 }
		 if(isset($content)){
				echo $content;
		 } 
	?>
		