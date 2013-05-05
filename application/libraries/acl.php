<?php if ( ! defined('BASEPATH')) exit('No se permite acceso directo al script');
class Acl
{
	var $permisos = array();		//Array : Stores the permissions for the user
	var $IdUsuario;			//Integer : Stores the ID of the current user
	var $obtenerRol = array();	//Array : Stores the roles of the current user
	var $ci;
	function __construct($config=array()) {
		$this->ci = &get_instance();
		$this->IdUsuario = floatval($config['IdUsuario']);
		$this->obtenerRol = $this->getobtenerRol();
		$this->construirACL();
	}

	function construirACL() {
		
		//Primero, lista las reglas para los roles del usuario
		if (count($this->obtenerRol)>0)
		{
			$this->permisos = array_merge($this->permisos,$this->getPermisosDeRol($this->obtenerRol));
		}
		//Luego los permisos individuales del usuario
//		$this->permisos = array_merge($this->permisos,$this->getPermisosDeUsuario($this->IdUsuario));
	}

	// Retornar Los permisos 
	function getPermisos(){
		return $this->permisos;
	}

	function getClavePermisoPorId($IdPermiso) {
		//$strSQL = "SELECT `clavePermiso` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($IdPermiso) . " LIMIT 1";
		$this->ci->db->select('key_permission');
		$this->ci->db->where('id_permission',floatval($IdPermiso));
		$sql = $this->ci->db->get('tbl_permission',1);
		$data = $sql->result();
		return $data[0]->key_permission;
	}

	function getNombrePermisoPorId($IdPermiso) {
		//$strSQL = "SELECT `nombrePermiso` FROM `".DB_PREFIX."permissions` WHERE `ID` = " . floatval($IdPermiso) . " LIMIT 1";
		$this->ci->db->select('name');
		$this->ci->db->where('id_permission',floatval($IdPermiso));
		$sql = $this->ci->db->get('tbl_permission',1);
		$data = $sql->result();
		return $data[0]->name;
	}

	function getNombreRolPorId($IdRol) {
		//$strSQL = "SELECT `NombreRol` FROM `".DB_PREFIX."roles` WHERE `ID` = " . floatval($IdRol) . " LIMIT 1";
		$this->ci->db->select('name');
		$this->ci->db->where('id_role',$IdRol,1);
		$sql = $this->ci->db->get('role');
		$data = $sql->result();
		return $data[0]->name;
	}

	function getobtenerRol() {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."user_roles` WHERE `IdUsuario` = " . floatval($this->IdUsuario) . " ORDER BY `addDate` ASC";

		$this->ci->db->where(array('id_user'=>floatval($this->IdUsuario)));
		//$this->ci->db->order_by('FechaCreacion','asc');
		$sql = $this->ci->db->get('tbl_users');
		$data = $sql->result();

		$resp = array();
		foreach( $data as $row )
		{
			$resp[] = $row->id_role;
		}
		return $resp;
	}

	function getTodoLosRoles($format='ids') {
		//$format = strtolower($format);
		//$strSQL = "SELECT * FROM `".DB_PREFIX."rol` ORDER BY `NombreRol` ASC";
		$this->ci->db->order_by('name','asc');
		$sql = $this->ci->db->get('tbl_role');
		$data = $sql->result();

		$resp = array();
		foreach( $data as $row )
		{
			if ($format == 'full')
			{
				$resp[] = array("IdRol" => $row->id_role,"NombreRol" => $row->name);
			} else {
				$resp[] = $row->id_role;
			}
		}
		return $resp;
	}

	function getTodosLosPermisos($format='ids') {
		//$format = strtolower($format);
		//$strSQL = "SELECT * FROM `".DB_PREFIX."permissions` ORDER BY `clavePermiso` ASC";

		$this->ci->db->order_by('name','asc');
		$sql = $this->ci->db->get('tbl_permission');
		$data = $sql->result();

		$resp = array();
		foreach( $data as $row )
		{
			if ($format == 'full')
			{
				$resp[$row->clavePermiso] = array('IdPermiso' => $row->id_permission, 'NombrePermiso' => $row->name, 'ClavePermiso' => $row->key_permission);
			} else {
				$resp[] = $row->id_permission;
			}
		}
		return $resp;
	}

	function getPermisosDeRol($role) {
		if (is_array($role))
		{
			//$roleSQL = "SELECT * FROM `".DB_PREFIX."role_permisos` WHERE `roleID` IN (" . implode(",",$role) . ") ORDER BY `ID` ASC";
			$this->ci->db->where_in('id_role',$role);
		} else {
			//$roleSQL = "SELECT * FROM `".DB_PREFIX."role_permisos` WHERE `roleID` = " . floatval($role) . " ORDER BY `ID` ASC";
			$this->ci->db->where(array('id_role'=>floatval($role)));

		}
		$this->ci->db->order_by('id_role_permission','asc');
		$sql = $this->ci->db->get('tbl_role_permission'); //$this->ci->db->select($roleSQL);
		$data = $sql->result();
		$permisos = array();
		foreach( $data as $row )
		{
			//$pK = strtolower($this->getClavePermisoPorId($row->id_permission));
			$pK = ($this->getClavePermisoPorId($row->id_permission));
			if ($pK == '') { continue; }
			/*if ($row->valor === '1') {
				$hP = TRUE;
			} else {
				$hP = FALSE;
			}*/
			$permisos[$pK] = array('ClavePermiso' => $pK,'inheritted' => true,/*'Valor' => $hP,*/'NombrePermiso' => $this->getNombrePermisoPorId($row->id_permission),'IdPermiso' => $row->id_permission);
		}
		return ($permisos);
	}

	function getPermisosDeUsuario($IdUsuario) {
		//$strSQL = "SELECT * FROM `".DB_PREFIX."user_permisos` WHERE `IdUsuario` = " . floatval($IdUsuario) . " ORDER BY `addDate` ASC";

		$this->ci->db->where('IdUsuario',floatval($IdUsuario));
		$this->ci->db->order_by('FechaCreacion','asc');
		$sql = $this->ci->db->get('usuario_permiso');
		$data = $sql->result();

		$permisos = array();
		foreach( $data as $row )
		{
			//$pK = strtolower($this->getClavePermisoPorId($row->IdPermiso));
			$pK = ($this->getClavePermisoPorId($row->IdPermiso));
			if ($pK == '') { continue; }
			if ($row->Valor == '1') {
				$hP = true;
			} else {
				$hP = false;
			}
			$permisos[$pK] = array('ClavePermiso' => $pK,'inheritted' => false,'Valor' => $hP,'NombrePermiso' => $this->getNombrePermisoPorId($row->IdPermiso),'id' => $row->IdPermiso);
		}
		return $permisos;
	}

	function tieneRol($IdRol) {
		foreach($this->obtenerRol as $k => $v)
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