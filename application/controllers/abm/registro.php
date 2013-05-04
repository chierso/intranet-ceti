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
	
	

	public function aperturarAno()
	{		
		$ano=$this->input->post('txt_ano',TRUE)."";
		$this->load->model("abm/abm_record_model");
	    $data=$this->abm_record_model->aperturarAno($ano);
	    $this->output->set_content_type('json')->set_output(json_encode($data));	
	}
}