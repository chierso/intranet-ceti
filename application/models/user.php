<?php
Class User extends CI_Model
{
	public function comprobar_usuario($email, $password)
   {
      $r = $this->db->query("SELECT * FROM usuarios WHERE email = '$email' AND password='$password' ");
      if ($r->num_rows() == 0)
         return false;
      else
         return true;
   }
	 function login($username, $password)
	{
		   $this->db->select('id, username, password');
		   $this->db->from('usuarios');
		   $this->db->where('username', $username);
		   $this->db->where('password', MD5($password));
		   $this->db->limit(1);
		   $query = $this -> db -> get();
		
		   if($query->num_rows()==1)
		   {
		     return $query->result();
		   }
		   else
		   {
		     return false;
		   }
	}
}
?>

