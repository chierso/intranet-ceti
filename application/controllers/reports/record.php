<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class record extends CI_Controller {
	
	public function __construct()
    {
      	parent::__construct();
   }
	
	public function index()
	{
		$this->load->view('template/layout',$data);
	}

	public function reporteAlumno($pAlumno)
	{
		$this->load->model('abm/abm_record_model');
		//$data = $this->abm_record_model->listar_notas($pAlumno);
		$data['cursos'] = $this->abm_record_model->listar_notas($pAlumno);
		//print_r($data);
		$this->load->view('reports/r_alumno_parametro',$data);
	}
}