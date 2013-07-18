<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class habiles extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this -> load -> view('reports/filtro_habiles');
	}
	
	public function toPDF() {
		$pUsuario = $this -> session -> userdata("E-Mail");
		$pTipoUsuario = $this -> session -> userdata("Rol");
		$alm = $this->input->post('txt_search',TRUE);
		$ano = $this->input->post('cbx_grado',TRUE)."";
		$sec = $this->input->post('rbt_seccion',TRUE)."";
		$this -> load -> model('abm/abm_alumno_model');
		$idLogeado = $this->abm_alumno_model->get_id_alumn($this -> session -> userdata("Usuario"),'','');
			
		if ($pTipoUsuario == 'dir')
			$pTipoUsuario = "Director";
		if ($pTipoUsuario == 'doc')
			$pTipoUsuario = "Docente";
		if ($pTipoUsuario == 'alum')
			$pTipoUsuario = "Alumno";
		if(($pTipoUsuario != "dir") AND (intval($pAlumno) != intval($idLogeado))){
			redirect('error','refresh');
		}

		$data = $this -> abm_alumno_model -> buscarAlumno($alm,$ano,$sec);
		$this -> load -> library('tcpdf/tcpdf');
		$this -> load -> helper('tcpdf_helper');
		headerPDF(' ', ' ');
		footerPDF(' Intranet IETI');
		$this -> tcpdf -> AddPage();
		$this->tcpdf->Image(base_url('public/img/logo.png'),75,10,60,20);
		$table = '<center><h2>Reporte de Alumnos Habilitados e Inhabilitados</h2></center><br />';
		$table .= '<br /><br /><br />';
		$table .= '<table border="1" align="center" style="font-size:32px;">
        			<thead>
		                <tr bgcolor="#253E7C" style="color:#fff;font-weight:bold;">
		            	  <th width="8%">Nº</th>
		                  <th width="50%">Alumno</th>
		                  <th width="8%">Año</th>
		                  <th width="8%">Sección</th>
		                  <th width="26%">Condición</th>
		            	</tr>
	            	</thead>
        			<tbody>';
		$indice = 1;
		foreach ($data as $row) {
			if($row->condicion=='I'){$cond='<span style="color:#ff0000;">Inhabilitado</span>';}else{$cond='Habilitado';}
			$table .= '<tr style="height:35px;" bgcolor="#CEE3F6" >'.
			'<td width="8%" align="right">'.$indice.'</td>'.
			'<td width="50%" align="left">'.$row->fullname.'</td>'.
			'<td width="8%" align="center">'.$row->grade.'</td>'.
			'<td width="8%" align="center">'.$row->section.'</td>'.
			'<td width="26%" align="center">'.$cond.'</td>'.
			'</tr>';
			$indice++;
		}

		$table .= '</tbody></table><br /><br />';
		$this -> tcpdf -> writeHTML($table, true, 0, true, 0);
		$this -> tcpdf -> lastPage();
		$this -> tcpdf -> writeHTML('Reporte emitido por <b>' . $pTipoUsuario . '</b>(' . $pUsuario . ')  : ' . date("d/m/Y H:i:s"), true, 0, true, 0);
		$this -> tcpdf -> Output('ReporteAlumno-' . $pAlumno . '.pdf', 'I');

	}

}
