<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class home extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		 $this->control_session->verifyLoginOnHome();
      }
	
	public function index()
	{
			
			$config = array('IdUsuario'=>$this->session->userdata('IdUsuario'));				
			$this->load->library('acl',$config);				
			$this->session->set_userdata('ACL',$this->acl->getPermisos()); 
			//$arreglo_pes = $this->acl->getPermisos();  
			//echo "<script>alert('".print_r($arreglo_pes)."')</script>";
			$data['title'] = "Intranet Académica";
			$data['content'] = "home"; 
			$this->load->view('template/layout',$data);
	}
	
	public function aperturarAno()
	{
			$data['title'] = "Aperturar año académico - Intranet Académica";
			$data['content'] = "aperturarAno"; 
			$data['h1'] = "Aperturar nuevo Año";
			$this->load->view('template/layout',$data);
	}
	
	public function addAlumn()
	{
			$data['title'] = "Agregar Alumno - Intranet Académica";
			$data['content'] = "addAlumn"; 
			$data['h1'] = "Registro de nuevo alumno";
			$this->load->view('template/layout',$data);
	}
	
	public function asignarAlumn()
	{
			$data['title'] = "Agregar Alumno - Intranet Académica";
			$data['content'] = "addAlumno"; 
			$this->load->view('template/layout',$data);
	}

	public function editAlumn()
	{
			$data['title'] = "Agregar Alumno - Intranet Académica";
			$data['content'] = "addAlumno"; 
			$this->load->view('template/layout',$data);
	}
	
	public function elimAlumn()
	{
			$data['title'] = "Agregar Alumno - Intranet Académica";
			$data['content'] = "addAlumno"; 
			$this->load->view('template/layout',$data);
	}
	
   	public function addDocente()
	{
			$data['title'] = "Agregar Docente - Intranet Académica";
			$data['content'] = "addDocente";
			$data['h1'] = "Registro de nuevo docente";
			$this->load->view('template/layout',$data);
	}
	
	public function asignarDocente()
	{
			$data['title'] = "Asignar Docente - Intranet Académica";
			$data['content'] = "asignarDocente";
			$data['h1'] = "Asignar Docente a Curso"; 
			$this->load->view('template/layout',$data);
	}

	public function editDocente()
	{
			$data['title'] = "Agregar Docenteo - Intranet Académica";
			$data['content'] = "addDocenteo"; 
			$this->load->view('template/layout',$data);
	}
	
	public function elimDocente()
	{
			$data['title'] = "Agregar Docenteo - Intranet Académica";
			$data['content'] = "addDocenteo"; 
			$this->load->view('template/layout',$data);
	}

	public function gestionCurso()
	{
			$data['title'] = "ABM Cursos - Intranet Académica";
			$data['content'] = "abm/abm_gestionCurso"; 
			$this->load->view('template/layout',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */