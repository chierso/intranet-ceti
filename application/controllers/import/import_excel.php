<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class import_excel extends CI_Controller {
	
	public function __construct()
      {
         parent::__construct();
		 $this->control_session->verifyLoginOnHome();

      }
	
	public function index()
	{
		$this->load->view('util/import_excel');
	}
	
	public function xls2array() {
		$name	  = $_FILES['file']['name'];
		$tname 	  = $_FILES['file']['tmp_name'];
		$pBimester=$this->input->post('rbt_bimester',TRUE)."";
		$pAno=$this->input->post('cbx_grado',TRUE)."";
		$pSeccion=$this->input->post('rbt_seccion',TRUE)."";
		
		require_once BASEPATH.'libraries/excel_reader2.php';
		$dato = new Spreadsheet_Excel_Reader($tname);
		$html = '<table id="tbl_excel" style="font-size:12px;" class="table table-bordered table-striped"><thead>
				<tr>
				<th>Alumno</th>
				';
		for($ij=3;$ij<=13;$ij++)
		{
			$value 	 = $dato->val(4,$ij);
			$value = utf8_decode(str_replace('Educación ','E.',utf8_encode($value))); 
			$value = utf8_decode(str_replace('Formación ','F.',utf8_encode($value))); 
			$html .= '<th width="7%">'.substr($value,0,10).'</th>';	
		}
		$html .= '</tr>
				</thead>';
		$html .= '<tbody cellpadding="2" border="1">';
		$html .= '  <input type="hidden" name="bimester" value="'.$pBimester.'" />
					<input type="hidden" name="grade" value="'.$pAno.'" />
					<input type="hidden" name="section" value="'.$pSeccion.'" />';
		
		for ($i = 4; $i <= $dato->rowcount($sheet_index=0); $i++) {
			if($dato->val($i,2) != ''){
				$html .= "<tr>";
				for ($j = 2; $j <= /*$dato->colcount($sheet_index=0)*/13; $j++) { 
					$value 	 = $dato->val($i,$j);
					$value   = str_replace(","," ",$value);
					$value	 = str_replace("   "," ",$value);
					$value	 = str_replace("  "," ",$value);
					if($j!=2){
						
						$html .="<td><input class='input-excel input-excel-full' type='text' name='col".$j."[]' value='".trim($value)."' /></td>";
				    }
					else{
						$this->load->model("abm/abm_alumno_model");
						$id = $this->abm_alumno_model->buscar_alumno_retorna_id(utf8_encode($value), $pAno,$pSeccion); // aqui está la búsqueda.
						$html .="<td>";
						//$html .="<input type='hidden' name='col1[]' value='".$id."' /><input class='input-excel' type='text' name='col".$j."[]' value='".trim($value)."' dis /></td>";
						$html .="<input type='hidden' name='col1[]' value='".$id."' />".trim($value)."</td>";
				    }
			
			
				}
				$html .="</tr>";
			}
		}
		$html .="</tbody></table>";	
		$data['tabla_excel']=utf8_encode($html);
		//$data['tabla_excel']=($html);
		$this->load->view('abm/abm_notas_excel',$data);	
	}
}

