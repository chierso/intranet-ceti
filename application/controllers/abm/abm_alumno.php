<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_alumno extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
      }
	
	public function index()
	{
		$pAno = 
		$this->load->model("abm/abm_alumno_model");
		$data['alumnos'] = $this->abm_alumno_model->listarAlumnos();
		$this->load->view('abm/abm_alumno',$data);
	}
	
	public function salon($pAno, $pSeccion)
	{
		
		$this->load->model("abm/abm_alumno_model");
		$data['alumnos'] = $this->abm_alumno_model->listarAlumnosGrado($pAno,$pSeccion);
		$this->load->view('abm/abm_alumno',$data);
	}
	
	
	public function asignar_tutoria()
	{
		$pIdDocente	=	$this->input->post('id_docente',TRUE);
		$pAno		=	$this->input->post('cbx_grado',TRUE)."";
		$pSeccion	=	$this->input->post('rbt_seccion',TRUE)."";
		$this->load->model("achademyc_model");
		$this->achademyc_model->asignar_tutoria(intval($pIdDocente), $pAno, $pSeccion);
	}

}