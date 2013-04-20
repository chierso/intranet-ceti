<?php
class Login_model extends CI_Model
{
   public function __construct()
   {
      parent::__construct();
   }

   public function tryLogin($email, $password)
   {
      	$this->db->select('id, email, password');
		$this->db->from('usuarios');
		$this->db->where('email', $email);
		$this->db->limit(1);
		$query = $this -> db -> get();
		$data = $query->result();
		if($data[0]->password==$password && $query->num_rows()==1){
		$this->session->set_userdata('E-Mail',$data[0]->email);
		$this->session->set_userdata('Validado',"true");
		return true;
	}
		return false;
   }
}
?>