<?php
class abm_docente_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }   
	
	function listarDocentes($pAno,$pSeccion){
		$sql = 'SELECT p.name, p.lastname, a.grade, a.section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person AND a.grade="'.$pAno.'" AND a.section="'.$pSeccion.'";';
		$query = $this->db->query($sql);
		$data = $query->result();
		return $query->result();
	}
	
	function insertar_docente($pNombres, $pApellidos, $pDireccion, $pDni, $pTelefono, $pCelular, $pSexo, $pNacimiento, $pCorreo)
	{
		$this->load->model("abm/abm_user_model");
		$this->abm_user_model->registrarUsuario($pCorreo,'doc');
		$this->db->trans_begin();
		$dataPersona = array(
				"name"		=> $pNombres,
				"lastname" 	=> $pApellidos,
				"address" 	=> $pDireccion,
				"phone"		=> $pTelefono,
				"cellphone"	=> $pCelular,
				"dni"		=> $pDni,
				"sex"		=> $pSexo,
				"e-mail" 	=> $pCorreo,
				"born"		=> $pNacimiento
			);
		$this->db->insert('tbl_person', $dataPersona); 
		$IdPersona = $this->db->insert_id();
		$dataDocente = array(			
				 "id_person"=>$IdPersona
			);
		$this->db->insert('tbl_docente', $dataDocente); 
		$this->db->trans_complete();
		$data=null;
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $data="Error! No se pudo registrar.";
		}
		else
		{
		    $this->db->trans_commit();
		    $data="Correcto! Los datos se cargaron correctamente.";
		}
		return $data;
	}


}
?>

