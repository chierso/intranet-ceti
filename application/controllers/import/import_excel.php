<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class import_excel extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		 $this->control_session->verifyLoginOnHome();
		// $this->load->library('PHPExcel');
      }
	
	public function index()
	{
		$this->load->view('util/import_excel');
	}
	
	public function xls2array() {
		$name	  = $_FILES['file']['name'];
		$tname 	  = $_FILES['file']['tmp_name'];
		require_once BASEPATH.'libraries/excel_reader2.php';
		$dato = new Spreadsheet_Excel_Reader($tname);
		$html = "<table cellpadding='2' border='1'>";
		for ($i = 4; $i <= $dato->rowcount($sheet_index=0); $i++) {
			if($dato->val($i,2) != ''){
				$html .= "<tr>";
				for ($j = 1; $j <= /*$dato->colcount($sheet_index=0)*/20; $j++) { 
					$value 	 = $dato->val($i,$j); 
					$html .="<td>".$value."&nbsp;</td>";
				}
				$html .="</tr>";
			}
		}
		$html .="</table>";	
		$data['tabla_excel']=utf8_encode($html);
		$this->load->view('abm/abm_notas_excel',$data);	
	}
}

