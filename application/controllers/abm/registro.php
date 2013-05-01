<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class registro extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
      }
	
	public function index()
	{
			$this->load->view('template/layout',$data);
	}
	
	public function registrarAlumno()
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
	    $data=$this->abm_alumno_model->registrarAlumno($nombres, 
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
	    $this->output->set_content_type('json')->set_output(json_encode($data));	
	}

	public function registrarDocente()
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
	    $data=$this->abm_docente_model->registrarDocente($nombres, 
											    $apellidos, 
											    $direccion, 
											    $dni, 
											    $telefono, 
											    $celular, 
											    $sexo, 
											    $nacimiento, 
											    $correo
	    	);
	    $this->output->set_content_type('json')->set_output(json_encode($data));	
	}

	public function setDocente()
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
	    $data=$this->abm_alumno_model->registrarAlumno($nombres, 
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
	    $this->output->set_content_type('json')->set_output(json_encode($data));	
	}

	public function listarSecciones()
	{
		
	}
	
	public function listarAlumnos($pAno,$pSeccion)
	{
		$this->load->model("abm/abm_alumno_model");
		$data = $this->abm_alumno_model->listarAlumnos($pAno,$pSeccion);
		foreach ($data as $row) {
			echo $row->name;
			echo $row->lastname;
			echo $row->grade;
			echo $row->section;
			echo '<br>';
		}
	}
	
	public function aperturarAno()
	{		
		$ano=$this->input->post('txt_ano',TRUE)."";
		$this->load->model("abm/abm_record_model");
	    $data=$this->abm_record_model->aperturarAno($ano);
	    $this->output->set_content_type('json')->set_output(json_encode($data));	
	}
}