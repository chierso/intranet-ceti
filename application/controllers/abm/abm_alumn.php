<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_alumn extends CI_Controller {
	
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
		$this->load->view('abm/abm_alumno',$data);
	}
	
	public function salon($pAno, $pSeccion)
	{
		
		$this->load->model("abm/abm_alumno_model");
		$data['alumnos'] = $this->abm_alumno_model->listarAlumnosGrado($pAno,$pSeccion);
		$this->load->view('abm/abm_alumno',$data);
	}
		
	public function registrar_alumn()
	{		
		$persona		=	$this->input->post('tipo_persona',TRUE)."";
		$nombres		=	$this->input->post('txt_nombres',TRUE)."";
		$apellidos		=	$this->input->post('txt_apellidos',TRUE)."";
		$direccion		=	$this->input->post('txt_direccion',TRUE)."";
		$dni			=	$this->input->post('txt_dni',TRUE)."";
		$telefono		=	$this->input->post('txt_telefono',TRUE)."";
		$celular		=	$this->input->post('txt_celular',TRUE)."";
		$sexo			=	$this->input->post('rbt_sexo',TRUE)."";
		$nacimiento		=	$this->input->post('txt_fec_nacimiento',TRUE)."";
		$correo			=	$this->input->post('txt_email',TRUE)."";
		$grado			=	$this->input->post('cbx_grado',TRUE)."";
		$seccion		=	$this->input->post('rbt_seccion',TRUE)."";
	    $this->load->model("abm/abm_alumno_model");
	    $data=$this->abm_alumno_model->insertar_alumn($nombres, 
											    $apellidos, 
											    $direccion, 
											    $dni, 
											    $telefono, 
											    $celular, 
											    $sexo, 
											    $nacimiento, 
											    $correo, 
											    $grado, 
											    $seccion
	    	);
		$datos['title']= $data;
		$datos['vista']='<h2>'.$data.'</h2><br /><a class="btn btn-info" href="javascript:history.back(1)">Regresar</a>';
		$this->load->view('template/layout',$datos);	
	}

	public function buscar_alumn(){
		$pAlumno=$this->input->post('txt_search',TRUE)."";
		$this->load->model("abm/abm_alumno_model");
		$data = $this->abm_alumno_model->listarAlumnos($pAno,$pSeccion);
		$this->output->set_content_type('json')->set_output(json_encode($data));
	}
}