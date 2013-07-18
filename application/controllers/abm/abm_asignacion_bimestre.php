<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_asignacion_bimestre extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		 $this->load->model("util_model");
		 $this->control_session->verifyLoginOnHome();
      }
	
	public function index()
	{
		$ano_vigente = date('Y');
		$data['bimester'] = $this->util_model->getBimestres($ano_vigente);
		$this->load->view('abm/abm_asignacion_bimestre',$data);
	}
	
	public function insert()
	{
		$ano_vigente = date('Y');
		$i 		= $this->input->post('ibimestre',TRUE)."";
		$ii 	= $this->input->post('iibimestre',TRUE)."";
		$iii 	= $this->input->post('iiibimestre',TRUE)."";
		$iv		= $this->input->post('ivbimestre',TRUE)."";
		$calendario = array(
			"primer_bimestre" 	=>$i,
			"segundo_bimestre" 	=>$ii,
			"tercer_bimestre" 	=>$iii,
			"cuarto_bimestre" 	=>$iv,
			"year"				=>$ano_vigente
		);
		$this->util_model->insertBimestres($calendario);
	}
	
	public function update()
	{
		$ano_vigente = date('Y');
		$i 		= $this->input->post('ibimestre',TRUE)."";
		$ii 	= $this->input->post('iibimestre',TRUE)."";
		$iii 	= $this->input->post('iiibimestre',TRUE)."";
		$iv		= $this->input->post('ivbimestre',TRUE)."";
		$calendario = array(
			"primer_bimestre" 	=>$i,
			"segundo_bimestre" 	=>$ii,
			"tercer_bimestre" 	=>$iii,
			"cuarto_bimestre" 	=>$iv
		);
		$this->util_model->updateBimestres($calendario,$ano_vigente);
	}
	
	

}