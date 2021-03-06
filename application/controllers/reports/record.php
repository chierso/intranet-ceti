<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class record extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> load -> view('reports/buscador');
	}
	
	public function record_personal() {
		//$this->load->model("abm/abm_alumno_model");
		//$id = $this->abm_alumno_model->buscar_alumno_retorna_id($pAlumno, "",""); // aqui está la búsqueda.				
		$this -> load -> model('abm/abm_alumno_model');
		$id = $this->abm_alumno_model->get_id_alumn($this -> session -> userdata("Usuario"),'','');
		$condicion = $this->abm_alumno_model->get_condicion_alumn($id);
		$this -> load -> model('abm/abm_record_model');
		$data['cursos'] = $this -> abm_record_model -> listar_notas($id);
		if($condicion!="H"){
			$data['error'] = "No tienes permiso suficiente o no estás habilitado para la intranet debido a acumulación de deuda.";
			$this->load->view('error',$data);
		}
		else if($data['cursos']=="error"){
			$data['error'] = "Aún no hay notas registradas.";
			$this->load->view('error',$data);
		}
		else{
			$this -> load -> view('reports/r_alumno_parametro', $data);	
		}
		
	}
	
	public function reporteAlumnoParametro($pAlumno) {
		//$this->load->model("abm/abm_alumno_model");
		//$id = $this->abm_alumno_model->buscar_alumno_retorna_id($pAlumno, "",""); // aqui está la búsqueda.				
		
		$id = $pAlumno;
		$this -> load -> model('abm/abm_record_model');
		$data['cursos'] = $this -> abm_record_model -> listar_notas($id);
		$this -> load -> view('reports/r_alumno_parametro', $data);
	}

	public function reporteAlumnoParametroPDF($pAlumno) {
		$pUsuario = $this -> session -> userdata("E-Mail");
		$pTipoUsuario = $this -> session -> userdata("Rol");
		$this -> load -> model('abm/abm_alumno_model');
		$idLogeado = $this->abm_alumno_model->get_id_alumn($this -> session -> userdata("Usuario"),'','');
			
		if ($pTipoUsuario == 'dir')
			$pTipoUsuario = "Director";
		if ($pTipoUsuario == 'doc')
			$pTipoUsuario = "Docente";
		if ($pTipoUsuario == 'alum')
			$pTipoUsuario = "Alumno";
		if(($pTipoUsuario != "Director") AND (intval($pAlumno) != intval($idLogeado))){
			redirect('error','refresh');
		}

		$this -> load -> model('abm/abm_record_model');
		//$data = $this->abm_record_model->listar_notas($pAlumno);
		$data = $this -> abm_record_model -> listar_notas($pAlumno);
		$this -> load -> library('tcpdf/tcpdf');
		$this -> load -> helper('tcpdf_helper');
		headerPDF(' ', '');
		footerPDF(' Intranet IETI');
		$this -> tcpdf -> AddPage();
		$this->tcpdf->Image(base_url('public/img/logo.png'),0,10,200,27);
		$table = '<div style="border:1px solid #000000;text-align:center;">
					<h1><u>BOLETA DE NOTAS </u></h1>
				  </div>';
		$table .= '<br /> <br /><b>Reporte del alumno: </b>' . $data[0] -> Alumno .'<br />';
		$table .= '<b>Grado:</b> ' . $data[0] -> Grado . '<br /><b>Sección:</b> ' . $data[0] -> Seccion . '<br /><br /><br />';
		$table .= '<table border="1" align="center" style="font-size:32px;">
        			<thead>
	                <tr bgcolor="#253E7C" style="color:#fff;font-weight:bold;">
	                  <th rowspan="2" width="42%">Áreas</th>
	                  <th align="center" width="48%">Bimestre</th>
	                  <th rowspan="2" width="10%">P. Final</th>
	                </tr>
	            	<tr bgcolor="#253E7C" style="color:#fff;font-weight:bold;">
	            	  <th width="12%">I</th>
	                  <th width="12%">II</th>
	                  <th width="12%">III</th>
	                  <th width="12%">IV</th>
	            	</tr>
	            	</thead>
        			<tbody>';
		foreach ($data as $row) {

			$promedio = floatval($row -> N1_average) + floatval($row -> N2_average) + floatval($row -> N3_average) + floatval($row -> N4_average);
			if (($row -> N1_average != null) && ($row -> N2_average != null) && ($row -> N3_average != null) && ($row -> N4_average != null)) {
				$promedio = round($promedio / 4);
			} else {
				$promedio = "-";
			}
			$table .= '<tr style="height:35px;" bgcolor="#CEE3F6" >' . '<td align="left" width="42%">' . $row -> name . '</td>' . '<td width="12%">' . $row -> N1_average . '</td>' . '<td width="12%">' . $row -> N2_average . '</td>' . '<td width="12%">' . $row -> N3_average . '</td>' . '<td width="12%">' . $row -> N4_average . '</td>
			 <td width="10%">' . $promedio . '</td>
			</tr>';
		}
		$table .= '</tbody></table><br /><br />';
		$this -> tcpdf -> writeHTML($table, true, false, true, false,'');
		$this -> tcpdf -> lastPage();
		$this -> tcpdf -> writeHTML('Reporte emitido por <b>' . $pTipoUsuario . '</b>(' . $pUsuario . ')  : ' . date("d/m/Y H:i:s"), true, 0, true, 0);
		$this -> tcpdf -> Output('ReporteAlumno-' . $pAlumno . '.pdf', 'I');
	}

}
