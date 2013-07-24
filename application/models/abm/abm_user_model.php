<?php
class abm_user_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function registrarUsuario($pCorreoElectronico, $pRol) {
		$this -> db -> trans_begin();
		$string = "";
		$possible = "0123456789bcdfghjkmnpqrstvwxyz";
		$i = 0;
		while ($i < 8) {
			$char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
			$string .= $char;
			$i++;
		}
		$dataUser = array("email" => $pCorreoElectronico, "password" => md5($string), "id_role" => $pRol);
		$this -> db -> insert('tbl_users', $dataUser);
		$id = $this -> db -> insert_id();
		$this -> db -> trans_complete();
		$data = null;
		if ($this -> db -> trans_status() === FALSE) {
			$this -> db -> trans_rollback();
			$data = "error";
		} else {
			$this -> db -> trans_commit();
			$data = $string."|".$id;
		}
		return $data;
	}


}
?>

