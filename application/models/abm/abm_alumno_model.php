<?php
class abm_alumno_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_id_alumn($pAlumno, $pAno, $pSeccion) {
		$sql = 'SELECT a.id_alumn FROM (tbl_person  p, tbl_alumn  a, tbl_registration  r) WHERE a.id_person = p.id_person AND UPPER(concat((p.lastname)," ",p.name)) LIKE "%' . strtoupper($pAlumno) . '%" AND r.grade LIKE "%' . $pAno . '%" AND r.section LIKE "%' . $pSeccion . '%" GROUP BY a.id_alumn';
		$query = $this -> db -> query($sql);
		$row = $query -> row();
		return $row -> id_alumn;
	}
	
	function get_condicion_alumn($pIdAlumno) {
		$sql = 'SELECT a.condition FROM tbl_alumn a WHERE a.id_alumn = '.$pIdAlumno.' GROUP BY a.id_alumn';
		$query = $this -> db -> query($sql);
		$row = $query -> row();
		return $row -> condition;
	}
	
	function buscarAlumno($pAlumno, $pAno, $pSeccion) {
		//$sql = 'SELECT a.id_alumn , concat(p.name, " ", p.lastname) AS Alumno , r.grade AS Grade, r.section as Section FROM tbl_person p, tbl_alumn a, tbl_registration r WHERE a.id_person = p.id_person AND r.id_alumn = a.id_alumn AND r.grade LIKE "%'.$pAno.'%" AND r.section LIKE "%'.$pSeccion.'%" ;';
		//print_r($pSeccion);
		//echo count($pSeccion);
		$sentencia="";
		if(count($pSeccion)==0){$sentencia="r`.section LIKE '%%' ";}
		if(count($pSeccion)==1){$sentencia="r`.section LIKE '%".$pSeccion[0]."%' ";}
		if(count($pSeccion)==2){$sentencia="r`.section LIKE '%".$pSeccion[0]."%' OR `r`.section LIKE '%".$pSeccion[1]."%' ";}
		if(count($pSeccion)==3){$sentencia="r`.section LIKE '%".$pSeccion[0]."%' OR `r`.section LIKE '%".$pSeccion[1]."%' OR `r`.section LIKE '%".$pSeccion[2]."%' ";}
		$this -> db -> select('a.id_alumn AS id , concat(p.lastname, " ", p.name) AS fullname, r.grade AS grade, r.section as section, a.condition AS condicion', false);
		//$this->db->select('a.id_alumn AS id , concat(p.lastname, " ", p.name) AS fullname, r.grade AS grade, r.section as section, SUM(rc.N1_average) as N1, SUM(rc.N2_average) as N2, SUM(rc.N3_average) as N3, SUM(rc.N4_average) as N4',false);
		$this -> db -> from('tbl_person AS p, tbl_alumn AS a, tbl_registration AS r');
		$this -> db -> where('a.id_person = p.id_person AND r.id_alumn = a.id_alumn');
		$this -> db -> like('concat(p.lastname," ",p.name)', $pAlumno, 'both');
		$this -> db -> like('r.grade', $pAno, 'both');
		$this -> db -> where($sentencia);
		//$this -> db -> like('r.section', $pSeccion, 'both');
		$this -> db -> group_by('a.id_alumn');
		$this -> db -> order_by('p.lastname', 'ASC');
		
		$query = $this -> db -> get();
		//echo '<h1>'.$this->db->last_query().'</h1>';
		//print_r($query -> result());
		return $query -> result();

	}

	function buscar_alumno_retorna_id($pAlumno, $pAno, $pSeccion) {
		$sql = 'SELECT a.id_alumn FROM (tbl_person  p, tbl_alumn  a, tbl_registration  r) WHERE a.id_person = p.id_person AND UPPER(concat((p.lastname)," ",p.name)) LIKE "%' . strtoupper($pAlumno) . '%" AND r.grade LIKE "%' . $pAno . '%" AND r.section LIKE "%' . $pSeccion . '%" GROUP BY a.id_alumn';
		$query = $this -> db -> query($sql);
		$row = $query -> row();
		//echo $this->db->last_query();
		if($query->num_rows()>0){return $row -> id_alumn;}
		else{return -1;}
	}

	function insertar_alumn($pNombres, $pApellidos, $pDireccion, $pDni, $pTelefono, $pCelular, $pSexo, $pNacimiento, $pCorreo, $pAno, $pSeccion) {
		$this -> load -> model("abm/abm_user_model");
		$miniArray = $this -> abm_user_model -> registrarUsuario($pDni, 'alum');
		$miniArray = explode("|",$miniArray);
		$idUser = $miniArray[1];
		$this -> db -> trans_begin();
		$dataPersona = array("name" => $pNombres, "lastname" => $pApellidos, "address" => $pDireccion, "phone" => $pTelefono, "cellphone" => $pCelular, "dni" => $pDni, "sex" => $pSexo, "e-mail" => $pCorreo, "born" => $pNacimiento, "id_user" => $idUser);
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
			$data = "error";
		} else {
			$this -> db -> trans_commit();
			$data = $miniArray[0];
		}
		return $data;

		/*	$queryUser = $this->db->query('SELECT email, password FROM tbl_users  ORDER BY id_user DESC;');
		 $result = $queryUser->result();
		 $this->load->library('email');
		 $this->email->from('intranet@institutosantarosa.com', 'IETI Santa Rosa');
		 $this->email->to($pCorreo);
		 $this->email->subject('Nuevo usuario registrado!');
		 $this->email->message('Su cuenta ha sido correctamente habilitada, sus datos son : <br /> Usuario: '.$result[0]->email.' - Contraseña: '.$result[0]->password);
		 $this->email->send();*/
		return $data;
	}
	
	function select_alumn($pIdAlumn){
		$this -> db -> select('concat(p.lastname, ", ", p.name) AS alumno, p.id_person AS id, p.address, p.phone, p.cellphone, p.`e-mail` AS email', false);
		$this -> db -> from('tbl_person p, tbl_alumn a');
		$this -> db -> where('a.id_person = p.id_person AND a.id_alumn='.$pIdAlumn);
		$query = $this -> db -> get();
		return ($query -> result());
	}
	
	function update_alumn($pIdPerson, $pAlumno){
		$this->db->where('id_person', $pIdPerson);
		$this->db->update('tbl_person', $pAlumno);
	}
	
	

	function listarAlumnos($pAno, $pSeccion) {
		//$sql = 'SELECT concat(p.name," " ,p.lastname) as Alumno, a.grade, a.section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person AND a.grade="'.$pAno.'" AND a.section="'.$pSeccion.'";';
		$sql = 'SELECT a.id_alumn , concat(p.lastname, " ", p.name) AS Alumno , r.grade AS Grade, r.section as Section, a.condition AS condicion FROM tbl_person p, tbl_alumn a, tbl_registration r WHERE a.id_person = p.id_person AND r.id_alumn = a.id_alumn AND r.grade LIKE "%' . $pAno . '%" AND r.section LIKE "%' . $pSeccion . '%" GROUP BY a.id_alumn ;';
		$query = $this -> db -> query($sql);
		$data = $query -> result();
		return $data;
	}

	function habilitarAlumnos($arrayAlumnos,$condicion){
		//echo print_r($arrayAlumnos);
		foreach($arrayAlumnos as $alumn){
			$this->db->where('id_alumn', $alumn);
        	$this->db->update('tbl_alumn', array("condition" => $condicion));
		}
	}

}
?>

