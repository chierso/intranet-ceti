<?php
class Login_model extends CI_Model
{
   public function __construct()
   {
      parent::__construct();
   }

   public function tryLogin($email, $password)
   {
      	$this->db->select('id_user, email, password');
		$this->db->from('tbl_users');
		$this->db->where('email', $email);
		$this->db->limit(1);
		$query = $this -> db -> get(); // SELECT id,email,password FROM usuarios WHERE 'email' = 'email' LIMIT 0,1
		$data = $query->result(); // OBTIENES EL RESULTSET DE LA CONSULTA ANTERIOR
		if($query->num_rows()==1 && $data[0]->password==$password){
		$this->session->set_userdata('IdUsuario',$data[0]->id_user);
		$this->session->set_userdata('E-Mail',$data[0]->email);
		$this->session->set_userdata('Validado',"TRUE");
		return true;
	}
		return false;
   }
}
?>