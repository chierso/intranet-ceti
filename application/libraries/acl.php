<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo al script');
class Acl
{
	var $permisos = array();		//Array : Stores the permissions for the user
	var $IdUsuario;			//Integer : Stores the ID of the current user
	var $rolesDeUsuario = array();	//Array : Stores the roles of the current user
	var $ci;
	function __construct($config=array()) {
		$this->ci = &get_instance();
		$this->IdUsuario = floatval($config['IdUsuario']);
		$this->rolesDeUsuario = $this->getRol();
		$this->construirACL();
	}
	
	function getPermisos(){
		return $this->permisos;
	}
	
	function getRol() {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."user_roles` WHERE `IdUsuario` = " . floatval($this->IdUsuario) . " ORDER BY `addDate` ASC";
		$query = $this->ci->db->query('SELECT id_role FROM tbl_users WHERE id_user = '. floatval($this->IdUsuario));
		$row = $query->row();
		return $row->id_role;
	}
	
	function getPermisosDeRol($role) {
		
		//$roleSQL = "SELECT * FROM `".DB_PREFIX."role_permisos` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
		// rp.id_permission=p.id_permission AND ;
		$query = $this->ci->db->query(' SELECT p.* FROM tbl_permission p,tbl_role_permission rp WHERE rp.id_role = "'.$role.'"');
		$permisos = array();
		$data = $query->result_array();		
		foreach( $data as $row )
		{
			//$pK = strtolower($this->getClavePermisoPorId($row->IdPermiso));
			//if ($pK == '') { continue; }
			//if ($row->Valor === '1') {
				//$hP = true;
			//} else {
			//	$hP = false;
			//}
			$permisos = array('IdPermiso'=>$data->id_permission, "Permiso"=>$data->name);
		}
		return $permisos;
	}
	
	
	function construirACL() {
		//Luego los permisos individuales del usuario
		$this->permisos = $this->getPermisosDeRol($this->rolesDeUsuario);
	}
	
	
}
?>