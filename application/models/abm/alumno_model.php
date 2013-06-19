<?php
class alumno_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function add($pNombres, $pApellidos, $pDireccion, $pDni, $pTelefono, $pCelular, $pSexo, $pNacimiento, $pCorreo, $pAno, $pSeccion) {
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
		return $data;
	}

	function get_by_id($id){
        $this->db->like('id_person', $id);
        return $this->db->get('tbl_person');
    }
    
    function update($id, $person){
        $this->db->where('id_person', $id);
        $this->db->update('tbl_person', $person);
    }
    
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('tbl_person');
    }
	
	function listarAlumnos($pAno, $pSeccion) {
		//$sql = 'SELECT concat(p.name," " ,p.lastname) as Alumno, a.grade, a.section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person AND a.grade="'.$pAno.'" AND a.section="'.$pSeccion.'";';
		$sql = 'SELECT a.id_alumn , concat(p.name, " ", p.lastname) AS Alumno , r.grade AS Grade, r.section as Section FROM tbl_person p, tbl_alumn a, tbl_registration r WHERE a.id_person = p.id_person AND r.id_alumn = a.id_alumn AND r.grade LIKE "%' . $pAno . '%" AND r.section LIKE "%' . $pSeccion . '%" GROUP BY a.id_alumn ;';
		$query = $this -> db -> query($sql);
		$data = $query -> result();
		return $data;
	}

}
?>

