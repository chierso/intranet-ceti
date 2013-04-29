<ul class="nav nav-tabs nav-stacked">
	<li class="nav-header">Enlaces</li>
    	<?php 
	    	$data = $this->session->userdata('ACL');
	    	ksort($data);
	    	foreach($data as $role)
			{
				if($role['Valor']==TRUE)
				echo '<li><a href="'.site_url('home/'.$role['ClavePermiso']).'">'.$role['NombrePermiso'].'</a></li>';	
			}
		?>
</ul>