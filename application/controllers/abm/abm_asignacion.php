<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_asignacion extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
      }
	
	public function index()
	{
		$this->load->model("achademyc_model");
		$data['docentes'] = $this->achademyc_model->listarDocentes();
		$this->load->view('abm/abm_asignacion',$data);
	}
	
	public function listarCurso()
	{
		//$this->grocery_crud->set_theme('twitter-bootstrap');
		
	}

}