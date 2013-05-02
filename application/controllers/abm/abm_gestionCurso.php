<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_gestionCurso extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
      }
	
	public function index()
	{
			$this->load->view('template/layout',$data);
	}
	
	public function listarCurso()
	{
			$parametro=$this->input->get('txt_consulta_beneficiado',TRUE)."";
			$tipo=$this->input->get('rbt_tipo_consulta',TRUE)."";
			$inicio=$this->input->get('iDisplayStart',TRUE)."";
			$tamanio=$this->input->get('iDisplayLength',TRUE)."";
			$sEcho=$this->input->get('sEcho',TRUE)."";
			$this->load->model("abm/abm_subject_model");
			$data=$this->abm_subject_model->listarSubjects($parametro,$inicio,$tamanio,$sEcho);
			$this->output->set_content_type('json')->set_output(json_encode($data));	
	}
	
}