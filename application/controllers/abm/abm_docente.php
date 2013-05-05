<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_docente extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		 $this->load->library('grocery_CRUD');
      }
	
	public function index()
	{
		
	}
		
	public function registrar_docente()
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
	    $this->load->model("abm/abm_docente_model");
	    $data=$this->abm_docente_model->insertar_docente($nombres, 
											    $apellidos, 
											    $direccion, 
											    $dni, 
											    $telefono, 
											    $celular, 
											    $sexo, 
											    $nacimiento, 
											    $correo
	    	);
	    $datos['title']= $data;
		$datos['vista']='<h2>'.$data.'</h2><br /><a class="btn btn-info" href="javascript:history.back(1)">Regresar</a>';
		$this->load->view('template/layout',$datos);
	    //$this->output->set_content_type('json')->set_output(json_encode($data));	
	}
}