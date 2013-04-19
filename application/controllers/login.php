<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
      {
         parent::__construct();
      }
	
	public function index()
	{
		$data['acceso'] = "login_view";
		$this->load->view('loginbeta');
	}
 
     public function comprobar_login()
     {
          $this->load->library("form_validation");
          $this->form_validation->set_rules("email","Email", "required");
          $this->form_validation->set_rules("password","Password", "required|min_length[5]");
          $this->form_validation->set_message("required", "El campo %s es obligatorio");
          if ($this->form_validation->run() == FALSE)
          {
             $this->index();
          }
          else
          {
             $this->load->model("login_model");
             if ($this->login_model->comprobar_usuario($_REQUEST['email'], $_REQUEST['password']))
             {
                $data["pagina"] = "main_app";
                $this->load->view("main_template", $data);
             }
             else
             {
                $this->index();
             }
          }
       }
   
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */