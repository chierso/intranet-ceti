<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class abm_subject extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		 $this->load->library('grocery_CRUD');
      }
	
	public function index()
	{
			$this->listarCurso();
	}
	
	public function listarCurso()
	{
		//$this->grocery_crud->set_theme('twitter-bootstrap');
		//$this->grocery_crud->set_theme('datatables');
		$this->grocery_crud->set_table('tbl_subject_registration');
		$this->grocery_crud->display_as('id_subject','Curso');
		$this->grocery_crud->set_subject('Curso');
		$this->grocery_crud->add_fields('id_subject','year_section');
		$this->grocery_crud->field_type('id_subject', 'multiselect');
		$this->grocery_crud->set_relation('id_subject','tbl_subject','name');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	public function _example_output($output = null){
				$this->load->view('abm/abm_subject',$output);
	} 
}