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
		$this->rolesDeUsuario = $this->getRolesDeUsuario();
		$this->construirACL();
	}
	
	function getPermisos(){
		return $this->permisos;
	}
	
	function getRol() {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."user_roles` WHERE `IdUsuario` = " . floatval($this->IdUsuario) . " ORDER BY `addDate` ASC";
		$query = $this->ci->db->query('SELECT id_rol FROM usuarios WHERE id_usuario = '. floatval($this->IdUsuario));
		$row = $query->row();
		return $row->id_rol;
	}
	
	function getPermisosDeRol($role) {
		
		//$roleSQL = "SELECT * FROM `".DB_PREFIX."role_permisos` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
		$query = $this->ci->db->query(' SELECT p.* FROM permisos p,rol_permiso rp WHERE rp.id_permiso=p.id_permiso AND rp.id_rol = 'dir';"'.$role.'"');
		$permisos = array();
		$data = $query->result_array();
		
		foreach( $data as $row )
		{
			$pK = strtolower($this->getClavePermisoPorId($row->IdPermiso));
			if ($pK == '') { continue; }
			if ($row->Valor === '1') {
				$hP = true;
			} else {
				$hP = false;
			}
			$permisos[$pK] = array('ClavePermiso' => $pK,'inheritted' => true,'Valor' => $hP,'NombrePermiso' => $this->getNombrePermisoPorId($row->IdPermiso),'IdPermiso' => $row->IdPermiso);
		}
		return $permisos;
	}
	
	
	function construirACL() {
		
		//Primero, lista las reglas para los roles del usuario
		if (count($this->rolesDeUsuario) > 0)
		{
			$this->permisos = array_merge($this->permisos,$this->getPermisosDeRol($this->rolesDeUsuario));
		}
		//Luego los permisos individuales del usuario
		$this->permisos = array_merge($this->permisos,$this->getPermisosDeUsuario($this->IdUsuario));
	}
	



	function tieneRol($IdRol) {
		foreach($this->rolesDeUsuario as $k => $v)
		{
			if (floatval($v) === floatval($IdRol))
			{
				return true;
			}
		}
		return false;
	}

	function tienePermiso($clavePermiso) {
		$clavePermiso = strtolower($clavePermiso);
		if (array_key_exists($clavePermiso,$this->permisos))
		{
			if ($this->permisos[$clavePermiso]['Valor'] === '1' || $this->permisos[$clavePermiso]['Valor'] === true)
			{
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
?>