<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class home extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
      }
	
	public function index()
	{
			$this->control_session->verifyLoginOnHome();
			$config = array('IdUsuario'=>$this->session->userdata('IdUsuario'));				
			$this->load->library('acl',$config);				
			$this->session->set_userdata('ACL',$this->acl->getPermisos()); 
			$arreglo_pes = $this->acl->getPermisos();  
			//	echo "<script>alert('".print_r($arreglo_pes)."')</script>";
			$data['title'] = "Intranet Académica";
			$data['content'] = "home"; 
			$this->load->view('template/layout',$data);
	}
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */