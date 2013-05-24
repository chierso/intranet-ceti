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
		verifyRegistro();
		$pBimester	= $this->input->post('bimester',TRUE)."";
		$pSubject	= $this->input->post('subject',TRUE)."";
		$pGrado		= $this->input->post('grade',TRUE)."";
		$pSeccion	= $this->input->post('section',TRUE)."";
		$pAlumnos	= $this->input->post('alumno');
		$pNotas		= $this->input->post('notas');
		$alumnNotas	= array_merge($pAlumnos,$pNotas);
		$this->load->model("abm/abm_record_model");
		$countArray = count($pAlumnos);
		for($i=0;$i<$countArray;$i++){
			$string = $this->abm_record_model->insertar_notas($pAlumnos[$i], $pGrado, $pSeccion, $pSubject, $pBimester, $pNotas[$i]);
			echo $string."<br />";
		}
		/*echo $pBimester;
		echo '<br />';
		echo $pSubject;
		echo '<br />';
		echo $pGrado;
		echo '<br />';
		echo $pSeccion;
		echo '<br /><br />';
		print_r($pAlumnos);
		echo '<br /><br />';
		print_r($pNotas);
		echo '<br />';
		echo '<br />';
		echo '<br />';
		*/
		
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