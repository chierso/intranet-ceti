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
		$error    = "";
		require_once BASEPATH.'libraries/excel_reader2.php';
		$dato = new Spreadsheet_Excel_Reader($tname);
		$html = '<table id="tbl_excel" style="font-size:12px;" class="table table-bordered table-striped"><thead>
				<tr>
				<th height="120"><span>Alumno</span></th>';
		for($ij=3;$ij<=13;$ij++)
		{
			$value 	 = $dato->val(4,$ij);
			$html .= '<th width="7%" height="120"><span>'.$value.'</span></th>';	
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
						
						$html .="<td><input class='input-excel input-excel-full' required='required' type='number' name='col".$j."[]' min='0' max='20' value='".trim($value)."' /></td>";
				    }
					else{
						$this->load->model("abm/abm_alumno_model");
						$id = $this->abm_alumno_model->buscar_alumno_retorna_id(utf8_encode($value), $pAno,$pSeccion); // aqui está la búsqueda.
						if($id<0){
							$error.="<b>Error!</b> Error con el alumno ".utf8_encode($value)."<br />";
						}
						$html .="<td>";
						//$html .="<input type='hidden' name='col1[]' value='".$id."' /><input class='input-excel' type='text' name='col".$j."[]' value='".trim($value)."' dis /></td>";
						$html .="<input type='hidden' name='col1[]' value='".$id."' />".trim($value)."</td>";
				    }
			
				}
				$html .="</tr>";
			}
		}
		$html .="</tbody></table>";	
		if($error!=""){
			$html = '<div class="alert alert-error">'.$error.'</div>';
		}
		else
			{
				$html = utf8_encode($html).'<input type="submit" class="btn btn-success" value="Confirmar" />
			<input type="reset" class="btn btn-danger" value="Cancelar" />';
			}
		$data['tabla_excel']=($html);
		//$data['tabla_excel']=($html);
		$this->load->view('abm/abm_notas_excel',$data);	
	}
}

