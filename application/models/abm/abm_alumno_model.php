<?php
class abm_alumno_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function listarAlumnos($pAno, $pSeccion) {
		//$sql = 'SELECT concat(p.name," " ,p.lastname) as Alumno, a.grade, a.section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person AND a.grade="'.$pAno.'" AND a.section="'.$pSeccion.'";';
		$sql = 'SELECT a.id_alumn , concat(p.name, " ", p.lastname) AS Alumno , r.grade AS Grade, r.section as Section FROM tbl_person p, tbl_alumn a, tbl_registration r WHERE a.id_person = p.id_person AND r.id_alumn = a.id_alumn AND r.grade LIKE "%' . $pAno . '%" AND r.section LIKE "%' . $pSeccion . '%" GROUP BY a.id_alumn ;';
		$query = $this -> db -> query($sql);
		$data = $query -> result();
		return $data;
	}

	function buscarAlumno($pAlumno, $pAno, $pSeccion) {
		//$sql = 'SELECT a.id_alumn , concat(p.name, " ", p.lastname) AS Alumno , r.grade AS Grade, r.section as Section FROM tbl_person p, tbl_alumn a, tbl_registration r WHERE a.id_person = p.id_person AND r.id_alumn = a.id_alumn AND r.grade LIKE "%'.$pAno.'%" AND r.section LIKE "%'.$pSeccion.'%" ;';
		$this -> db -> select('a.id_alumn AS id , concat(p.lastname, " ", p.name) AS fullname, r.grade AS grade, r.section as section', false);
		//$this->db->select('a.id_alumn AS id , concat(p.lastname, " ", p.name) AS fullname, r.grade AS grade, r.section as section, SUM(rc.N1_average) as N1, SUM(rc.N2_average) as N2, SUM(rc.N3_average) as N3, SUM(rc.N4_average) as N4',false);
		$this -> db -> from('tbl_person AS p, tbl_alumn AS a, tbl_registration AS r');
		$this -> db -> where('a.id_person = p.id_person AND r.id_alumn = a.id_alumn');
		$this -> db -> like('concat(p.lastname," ",p.name)', $pAlumno, 'both');
		$this -> db -> like('r.grade', $pAno, 'both');
		$this -> db -> like('r.section', $pSeccion, 'both');
		$this -> db -> group_by('a.id_alumn');
		$this -> db -> order_by('p.lastname', 'ASC');
		$query = $this -> db -> get();
		return $query -> result();

	}

	function buscar_alumno_retorna_id($pAlumno, $pAno, $pSeccion) {
		//$sql = 'SELECT a.id_alumn , concat(p.name, " ", p.lastname) AS Alumno , r.grade AS Grade, r.section as Section FROM tbl_person p, tbl_alumn a, tbl_registration r WHERE a.id_person = p.id_person AND r.id_alumn = a.id_alumn AND r.grade LIKE "%'.$pAno.'%" AND r.section LIKE "%'.$pSeccion.'%" ;';
		
		
		//$this->db->select('alumno.id_alumn AS id',false);
		//$this->db->select('a.id_alumn AS id , concat(p.lastname, " ", p.name) AS fullname, r.grade AS grade, r.section as section, SUM(rc.N1_average) as N1, SUM(rc.N2_average) as N2, SUM(rc.N3_average) as N3, SUM(rc.N4_average) as N4',false);
		//$this->db->from('tbl_person p, tbl_alumn alumno, tbl_registration r');
		//$this->db->where('alumno.id_person = p.id_person AND r.id_alumn = alumno.id_alumn');
		//$this->db->like('p.name',$pNombres,'both');
		//$this->db->like('concat(p.lastname, " ", p.name) = "'.$pAlumno.'"');
		//$this -> db -> like('concat(p.lastname," ",p.name)', $pAlumno, 'both');
		//$this->db->like('concat(p.lastname, " ", p.name)',$pApellidos." ".$pNombres, 'both');
		//$this->db->like('r.grade',$pAno,'both');
		//$this->db->like('r.section',$pSeccion,'both');
		//$query = $this->db->get();
		//echo $this->db->last_query(); 
		//$row   = $query->row();
		//return $row->id;
//		$this->db->group_by('a.id_alumn');
		
		/*$target = '% '.strval($pAlumno).'%';
		$target = str_replace("% ", "%", $target);
		echo $pAlumno."-".$target;* */
		$sql = 'SELECT a.id_alumn FROM (tbl_person  p, tbl_alumn  a, tbl_registration  r) WHERE a.id_person = p.id_person AND concat((p.lastname)," ",p.name) LIKE "'.$pAlumno.'" AND r.grade LIKE "%' . $pAno . '%" AND r.section LIKE "%' . $pSeccion . '%" GROUP BY a.id_alumn COLLATE utf8_general_ci';
		echo $sql;
		$query = $this -> db -> query($sql);
		$data = $query -> result();	
		return $data[0]->id_alumn;
		}

	function insertar_alumn($pNombres, $pApellidos, $pDireccion, $pDni, $pTelefono, $pCelular, $pSexo, $pNacimiento, $pCorreo, $pAno, $pSeccion) {
		$this -> load -> model("abm/abm_user_model");
		$this -> abm_user_model -> registrarUsuario($pCorreo, 'alum');
		$this -> db -> trans_begin();
		$dataPersona = array("name" => $pNombres, "lastname" => $pApellidos, "address" => $pDireccion, "phone" => $pTelefono, "cellphone" => $pCelular, "dni" => $pDni, "sex" => $pSexo, "e-mail" => $pCorreo, "born" => $pNacimiento);
		$this -> db -> insert('tbl_person', $dataPersona);
		$IdPersona = $this -> db -> insert_id();
		$dataAlumno = array("id_person" => $IdPersona, "condition" => "H");
		$this -> db -> insert('tbl_alumn', $dataAlumno);
		$IdAlumno = $this -> db -> insert_id();
		$dataRegistration = array("id_alumn" => $IdAlumno, "grade" => $pAno, "section" => $pSeccion, "year" => date('Y'));
		$this -> db -> insert('tbl_registration', $dataRegistration);
		$this -> db -> trans_complete();
		$data = null;
		if ($this -> db -> trans_status() === FALSE) {
			$this -> db -> trans_rollback();
			$data = "Error! No se pudo registrar.";
		} else {
			$this -> db -> trans_commit();
			$data = "Correcto! Los datos se cargaron correctamente.";
		}

		/*	$queryUser = $this->db->query('SELECT email, password FROM tbl_users  ORDER BY id_user DESC;');
		 $result = $queryUser->result();
		 $this->load->library('email');
		 $this->email->from('intranet@institutosantarosa.com', 'IETI Santa Rosa');
		 $this->email->to($pCorreo);
		 $this->email->subject('Nuevo usuario registrado!');
		 $this->email->message('Su cuenta ha sido correctamente habilitada, sus datos son : <br /> Usuario: '.$result[0]->email.' - Contraseña: '.$result[0]->password);
		 $this->email->send();
		 */
		return $data;
	}

}
?>

