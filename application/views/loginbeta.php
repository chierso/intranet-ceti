<?php
$this->load->helper("form");

echo form_open("login/comprobar_login");

// Generamos el campo email del formulario
$data = array(
   'name' => 'email',
   'id' => 'email',
   'value' => '',
   'maxlength' => '100',
   'size' => '50'
);
$data['value'] = set_value('name');
echo form_label("Email: ");
echo form_input($data);
echo form_error('email');
echo "<br/>";

// Generamos el campo password
echo form_label("Password: ");
echo form_password("pass");
echo form_error("password");
echo "<br/>";

// Generamos el botón de submit
echo form_submit("submit", "Entrar");
echo form_close();
?>