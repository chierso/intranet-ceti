<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class import_excel_alumnos extends CI_Controller {
	
	public function __construct()
    {
         parent::__construct();
		 $this->control_session->verifyLoginOnHome();
    }
	
	public function index()
	{
		$this->load->view('util/import_excel_alumnos');
	}
	
	public function xls2array() {
		$name	  = $_FILES['file']['name'];
		$tname 	  = $_FILES['file']['tmp_name'];
		$pBimester=$this->input->post('rbt_bimester',TRUE)."";
		$pAno	  =$this->input->post('cbx_grado',TRUE)."";
		$pSeccion =$this->input->post('rbt_seccion',TRUE)."";
		require_once BASEPATH.'libraries/excel_reader2.php';
		$dato = new Spreadsheet_Excel_Reader($tname);
		$html = '<table id="tbl_excel" style="font-size:12px;" class="table table-bordered table-striped"><thead>
				<tr>';
		for($ij=1;$ij<=9;$ij++)
		{
			$value 	 = $dato->val(1,$ij);
			$html .= '<th height="60">'.$value.'</th>';	
		}
		$html .= '</tr>
				</thead>';
		$html .= '<tbody cellpadding="2" border="1">';
		$html .= '<input type="hidden" name="grade" value="'.$pAno.'" />
				  <input type="hidden" name="section" value="'.$pSeccion.'" />';
		for ($i = 2; $i <= $dato->rowcount($sheet_index=0); $i++) {
			if($dato->val($i,1) != ''){
				$html .= "<tr>";
				for ($j = 1; $j <= $dato->colcount($sheet_index=0); $j++) { 
					$value 	 = $dato->val($i,$j);
					if($j==4){$type="type='number'";}
					else if($j==6){$type="type='number'";}
					else if($j==8){$type="type='email'";}
					else if($j==9){$type="type='text'";}
					else{$type="type='text'";}
					$html .="<td><input ".$type." class='input-small' required='required' name='col".$j."[]' value='".$value."' /></td>";
				}
				$html .="</tr>";
			}
		}
		$html .="</tbody></table>";	
		$html = utf8_encode($html).'<input type="submit" class="btn btn-success" value="Confirmar" />
		<input type="reset" class="btn btn-danger" value="Cancelar" />';
		
		$data['tabla_excel']=($html);
		//$data['tabla_excel']=($html);
		$this->load->view('util/alumno_excel',$data);	
	}
}

