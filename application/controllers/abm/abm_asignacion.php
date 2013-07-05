<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_asignacion extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		  $this->control_session->verifyLoginOnHome();
      }
	
	public function index()
	{
		$this->load->model("role_model");
		$this->load->view('abm/abm_asignacion',$data);
	}
	

}