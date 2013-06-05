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
		$html = '<table id="tbl_excel" style="font-size:12px;" class="table table-bordered"><thead>
				<tr>
				<th>N</th>
				<th>Alumno</th>
				';
		for($ij=3;$ij<=13;$ij++)
		{
			$value 	 = $dato->val(4,$ij);
			$value = utf8_decode(str_replace('Educación ','E.',utf8_encode($value))); 
			$value = utf8_decode(str_replace('Formación ','F.',utf8_encode($value))); 
			$html .= '<th>'.substr($value,0,10).'</th>';	
		}
		$html .= '</tr>
				</thead>';
		$html .= '<tbody cellpadding="2" border="1">';
		for ($i = 4; $i <= $dato->rowcount($sheet_index=0); $i++) {
			if($dato->val($i,2) != ''){
				$html .= "<tr>";
				for ($j = 1; $j <= /*$dato->colcount($sheet_index=0)*/13; $j++) { 
					$value 	 = $dato->val($i,$j);
					$html .="<td>".trim(str_replace(',','',$value))."</td>";
				}
				$html .="</tr>";
			}
		}
		$html .="</tbody></table>";	
		$data['tabla_excel']=utf8_encode($html);
		$this->load->view('abm/abm_notas_excel',$data);	
	}
}

