<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login extends CI_Controller {

	public function __construct()
      {
         parent::__construct();
      }
	
	
	public function index()
	{
			$this->control_session->verifyLogin();
			$data['title']="Acceso a Intranet";
			$this->load->view('login',$data);
	}
 
     public function sendLogin()
     {
         	$this->load->model("security/login_model");
			$usuario=$this->input->post('txt_usuario',TRUE)."";
			$password=$this->input->post('txt_password',TRUE)."";
			$valor=$this->login_model->tryLogin("$usuario","$password");
			if($valor)
			{
				echo 'logged';
			}	
			else{
				echo 'error';
			}
			
       }	
       
	public function logout()
	{
		$this->session->sess_destroy();
	   	redirect('login', 'refresh');	
	}
   
}