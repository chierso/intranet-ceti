<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this -> control_session -> verifyLoginOnHome();
		$this -> load -> library('grocery_CRUD');
	}

	public function index() {
		$config = array('IdUsuario' => $this -> session -> userdata('IdUsuario'));
		$this -> load -> library('acl', $config);
		$this -> session -> set_userdata('ACL', $this -> acl -> getPermisos());
		//$arreglo_pes = $this->acl->getPermisos();
		//echo "<script>alert('".print_r($arreglo_pes)."')</script>";
		$data['title'] = "Intranet Académica";
		$data['content'] = "home";
		$this -> load -> view('template/layout', $data);
	}

	public function aperturarAno() {
		$data['title'] = "Aperturar año académico - Intranet Académica";
		$data['content'] = "aperturarAno";
		$data['h1'] = "Aperturar nuevo Año";
		$this -> load -> view('template/layout', $data);
	}

	public function add_alumn() {
		$this -> load -> view('add_alumn');
	}

	public function add_docente() {
		$this -> load -> view('add_docente');
	}

	public function asignar_docente() {
		$data['title'] = "Asignar Docente - Intranet Académica";
		$data['content'] = "asignar_docente";
		$data['h1'] = "Asignar Docente a Curso";
		$this -> load -> view('template/layout', $data);
	}

	public function gestion_curso() {
		$this -> grocery_crud -> set_table('tbl_subject');
		$output = $this -> grocery_crud -> render();
		$this -> load -> view('abm/abm_subject', $output);
	}

	public function import_excel() {
		redirect('import/import_excel', 'refresh');
	}

	public function abm_asignacion() {
		$this -> load -> model("achademyc_model");
		$data['docentes'] = $this -> achademyc_model -> listarDocentes();
		$data['tutoria'] = $this -> achademyc_model -> listarTutoria();
		$this -> load -> view('abm/abm_asignacion', $data);
	}

	public function gestion_alumno() {
		redirect('abm/abm_alumn', 'refresh');
	}

	public function reporte_alumno_filtro() {
		redirect('reports/record', 'refresh');
	}

	public function ver_notas() {
		redirect('reports/record/record_personal', 'refresh');
	}

	public function habilitar() {
		redirect('habilitar', 'refresh');
	}

	public function reportar_habiles() {
		redirect('reports/habiles', 'refresh');
	}

	public function asignacion_bimestre() {
		redirect('abm/abm_asignacion_bimestre', 'refresh');
	}
	
	public function import_alum(){
		redirect('import/import_excel_alumnos', 'refresh');
	}

}
