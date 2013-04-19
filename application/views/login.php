<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<title>Holi princeso :3</title>
	<link rel="stylesheet" href="<?php echo base_url("public/css/bootstrap.min.css")?>">
	<link rel="stylesheet" href="<?php echo base_url("public/css/style.css")?>">        
</head>
<body>
<div class="wrapper">
	<div class="container">
	<h1>Intranet Académica</h1>
	<div id="form_login">
      <form class="form-signin">
        <h2 class="form-signin-heading">Acceso al sistema</h2>
        <input type="text" required class="input-block-level" name="email" placeholder="Correo electrónico">
        <input type="password" required class="input-block-level" name="password" placeholder="Contraseña">
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Recordarme
        </label>
        <button class="btn btn-large btn-primary" type="submit">Acceder</button>
      </form>
    </div>
    </div> <!-- /container -->
</div>
</body>