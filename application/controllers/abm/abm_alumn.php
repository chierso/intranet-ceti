<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class abm_alumn extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this -> control_session -> verifyLoginOnHome();
		$this -> load -> model("abm/abm_alumno_model");
		$this -> load -> library('grocery_CRUD');
	}

	public function index() {
		$pAno = $this -> input -> post('cbx_grado', TRUE) . "";
		$pSeccion = $this -> input -> post('rbt_seccion', TRUE) . "";
		$data['alumnos'] = $this -> abm_alumno_model -> listarAlumnos($pAno, $pSeccion);
		$this -> load -> view('abm/abm_alumno', $data);
	}

	public function salon($pAno, $pSeccion) {
		$this -> load -> model("abm/abm_alumno_model");
		$data['alumnos'] = $this -> abm_alumno_model -> listarAlumnosGrado($pAno, $pSeccion);
		$this -> load -> view('abm/abm_alumno', $data);
	}

	public function insert_alumn() {
		$nombres = $this -> input -> post('txt_nombres', TRUE) . "";
		$apellidos = $this -> input -> post('txt_apellidos', TRUE) . "";
		$direccion = $this -> input -> post('txt_direccion', TRUE) . "";
		$dni = $this -> input -> post('txt_dni', TRUE) . "";
		$telefono = $this -> input -> post('txt_telefono', TRUE) . "";
		$celular = $this -> input -> post('txt_celular', TRUE) . "";
		$sexo = $this -> input -> post('rbt_sexo', TRUE) . "";
		$nacimiento = $this -> input -> post('txt_fec_nacimiento', TRUE) . "";
		$correo = $this -> input -> post('txt_email', TRUE) . "";
		$grado = $this -> input -> post('cbx_grado', TRUE) . "";
		$seccion = $this -> input -> post('rbt_seccion', TRUE) . "";
		$data = $this -> abm_alumno_model -> insertar_alumn($nombres, $apellidos, $direccion, $dni, $telefono, $celular, $sexo, $nacimiento, $correo, $grado, $seccion);
		if ($data == 'error') {echo "error";
		} else {echo "<b>Usuario registrado!</b> <br /> Usuario: " . $dni . "<br /> Password: " . $data;
		}
	}

	public function insert_alumn_excel() {
		$pAno = $this -> input -> post('grade');
		$pSeccion = $this -> input -> post('section');
		$pApellidos = $this -> input -> post('col1');
		$pNombres = $this -> input -> post('col2');
		$pDireccion = $this -> input -> post('col3');
		$pTelefono = $this -> input -> post('col4');
		$pCelular = $this -> input -> post('col5');
		$pDni = $this -> input -> post('col6');
		$pSexo = $this -> input -> post('col7');
		$pEmail = $this -> input -> post('col8');
		$pNacimiento = $this -> input -> post('col9');
		$countArray = count($pApellidos);
		$msg = "";
		for ($i = 0; $i < $countArray; $i++) {
			$pwd  = $this -> abm_alumno_model -> insertar_alumn($pNombres[$i], $pApellidos[$i], $pDireccion[$i], $pDni[$i], $pTelefono[$i], $pCelular[$i], $pSexo[$i], $pNacimiento[$i], $pEmail[$i], $pAno, $pSeccion);
			$data = "<b>Usuario registrado!</b> <br /> Usuario: " . $pDni[$i] . "<br /> Password: " . $pwd;
			$msg .= $data . "<br />* - * - * - * - * - *<br />";
		}
		echo $msg;
	}

	public function update_alumn() {
		$idPerson = $this -> input -> post('txt_person', TRUE) . "";
		$direccion = $this -> input -> post('txt_direccion', TRUE) . "";
		$telefono = $this -> input -> post('txt_telefono', TRUE) . "";
		$celular = $this -> input -> post('txt_celular', TRUE) . "";
		$correo = $this -> input -> post('txt_email', TRUE) . "";
		$alumno = array("address" => $direccion, "phone" => $telefono, "cellphone" => $celular, "e-mail" => $correo);
		$this -> abm_alumno_model -> update_alumn($idPerson, $alumno);
	}

	public function select_alumn() {
		$idAlumn = $this -> input -> post('id_alumn', TRUE) . "";
		$alumno = $this -> abm_alumno_model -> select_alumn($idAlumn);
		$this -> output -> set_content_type('json') -> set_output(json_encode($alumno));
	}

	public function buscar_alumn() {
		$pAno = $this -> input -> post('cbx_grado', TRUE) . "";
		$pSeccion = $this -> input -> post('chkseccion', TRUE);
		$pAlumno = $this -> input -> post('txt_search', TRUE) . "";
		$data = $this -> abm_alumno_model -> buscarAlumno($pAlumno, $pAno, $pSeccion);
		$this -> output -> set_content_type('json') -> set_output(json_encode($data));
	}
}