<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class home extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		 $this->control_session->verifyLoginOnHome();
		 $this->load->library('grocery_CRUD');
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
	
	public function add_alumn()
	{
			$data['title'] = "Agregar Alumno - Intranet Académica";
			$data['content'] = "add_alumn"; 
			$data['h1'] = "Registro de nuevo alumno";
			$this->load->view('template/layout',$data);
	}
		
   	public function add_docente()
	{
			$data['title'] = "Agregar Docente - Intranet Académica";
			$data['content'] = "add_docente";
			$data['h1'] = "Registro de nuevo docente";
			$this->load->view('template/layout',$data);
	}
	
	public function asignar_docente()
	{
			$data['title'] = "Asignar Docente - Intranet Académica";
			$data['content'] = "asignar_docente";
			$data['h1'] = "Asignar Docente a Curso"; 
			$this->load->view('template/layout',$data);
	}

	public function gestion_curso()
	{
			$this->grocery_crud->set_table('tbl_subject');
			$output = $this->grocery_crud->render();
			$this->load->view('abm/abm_subject',$output);
	}
	
	public function abm_asignacion()
	{
			$this->load->model("achademyc_model");
			$data['docentes'] = $this->achademyc_model->listarDocentes();
			$data['tutoria'] = $this->achademyc_model->listarTutoria();
			$this->load->view('abm/abm_asignacion',$data);
	}
	
	public function abm_alumno()
	{
			redirect('abm/abm_alumn', 'refresh');
	}
	
	public function reporte_alumno_filtro()
	{
			redirect('reports/record', 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */