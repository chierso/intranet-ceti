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
	
	public function asignar_tutoria()
	{
		$pIdDocente	=	$this->input->post('id_docente',TRUE);
		$pAno		=	$this->input->post('cbx_grado',TRUE)."";
		$pSeccion	=	$this->input->post('rbt_seccion',TRUE)."";
		$this->load->model("achademyc_model");
		$this->achademyc_model->asignar_tutoria(intval($pIdDocente), $pAno, $pSeccion);
	}

}