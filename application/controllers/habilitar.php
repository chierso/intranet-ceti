<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class habilitar extends CI_Controller {
	
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
		$this->load->model("abm/abm_alumno_model");
		$data['alumnos'] = $this->abm_alumno_model->listarAlumnos($pAno,$pSeccion);
		$this->load->view('util/habiles',$data);
	}
	
	public function hab()
	{		
		$array = $this->input->post('check',TRUE);
	    $this->load->model("abm/abm_alumno_model");
	    $data=$this->abm_alumno_model->habilitarAlumnos($array,'H');
	}
	
	public function inhab()
	{		
		$array = $this->input->post('check',TRUE);
	    $this->load->model("abm/abm_alumno_model");
	    $data=$this->abm_alumno_model->habilitarAlumnos($array,'I');
	}
}