<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_notas extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		  $this->control_session->verifyLoginOnHome();
		 $this->load->library('grocery_CRUD');
      }
	
	public function index()
	{
		$pAno=$this->input->post('cbx_grado',TRUE)."";
		$pSeccion=$this->input->post('rbt_seccion',TRUE)."";
		$pAlumno=$this->input->post('txt_search',TRUE)."";
		$this->load->model("abm/abm_alumno_model");
		$this->load->model("abm/abm_subject_model");
		$data['cursos'] = $this->abm_subject_model->listarSubjects();
		$data['alumnos'] = $this->abm_alumno_model->buscarAlumno($pAlumno,$pAno,$pSeccion);
		$this->load->view("abm/abm_notas",$data);
	}
	
	public function insert()
	{
		$pBimester	=	$this->input->post('bimester',TRUE)."";
		$pSubject	=	$this->input->post('subject',TRUE)."";
		$pGrado		=	$this->input->post('grade',TRUE)."";
		$pSeccion	=	$this->input->post('seccion',TRUE)."";
		$pNotas		= 	$this->input->post('notas');
		echo $pBimester;
		echo '<br />';
		echo $pSubject;
		echo '<br />';
		echo $pGrado;
		echo '<br />';
		echo $pSeccion;
		echo '<br /><br />';
		print_r($pNotas);
		echo '<br />';
		echo '<br />';
		echo '<br />';
		
		
	}
	
	public function director()
	{
		$pAno=$this->input->post('cbx_grado',TRUE)."";
		$pSeccion=$this->input->post('rbt_seccion',TRUE)."";
		$pAlumno=$this->input->post('txt_search',TRUE)."";
		$this->load->model("abm/abm_alumno_model");
		$this->load->model("abm/abm_subject_model");
		$data['cursos'] = $this->abm_subject_model->listarSubjects();
		$data['alumnos'] = $this->abm_alumno_model->buscarAlumno($pAlumno,$pAno,$pSeccion);
		$this->load->view("abm/abm_notas_director",$data);
	}

}