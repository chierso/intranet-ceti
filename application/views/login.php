	<h1>Intranet Académica</h1>
<div id="form_login">	
	<?php
		$this->load->helper("form");
		echo form_open("login/sendLogin");
	
		echo form_label("Email: ");
		echo '<input type="text" required class="input-block-level" name="txt_usuario" placeholder="Correo electrónico">';
		echo form_error('email');
		echo "<br/>";
		
		// Generamos el campo password
		echo form_label("Password: ");
		echo '<input type="password" required class="input-block-level" name="txt_password" placeholder="Contraseña">';
		echo form_error("password");
		echo "<br/>";
		
		// Generamos el botón de submit
		echo '<label class="checkbox">
	          <input type="checkbox" value="remember-me"> Recordarme
	        </label>
	        <button class="btn btn-large btn-primary" type="submit">Acceder</button>';
		echo form_close();
	?>
</div>
    
