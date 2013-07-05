<?php
class Login_model extends CI_Model
{
   public function __construct()
   {
      parent::__construct();
   }

   public function tryLogin($email, $password)
   {
      	$this->db->select('CONCAT(p.lastname," ",p.name) AS Usuario, u.id_user AS Id, u.email AS Email, u.password AS pwd, r.name AS Rol',false);
		$this->db->from('tbl_users u, tbl_role r, tbl_person p');
		$this->db->where('u.email = "'.$email.'" AND u.id_role = r.id_role AND u.id_user=p.id_user AND u.password = MD5("'.$password.'")');
		$this->db->limit(1);
		$query = $this -> db -> get(); // SELECT id,email,password FROM usuarios WHERE 'email' = 'email' LIMIT 0,1
		$data = $query->result(); // OBTIENES EL RESULTSET DE LA CONSULTA ANTERIOR
		if($query->num_rows()==1){
			$this->session->set_userdata('IdUsuario',$data[0]->Id);
			$this->session->set_userdata('E-Mail',$data[0]->Email);
			$this->session->set_userdata('Rol',$data[0]->Rol);
			$this->session->set_userdata('Validado',"TRUE");
			$this->session->set_userdata('Bimester',$this->setCurrentBimester());
			$this->session->set_userdata('Usuario',$data[0]->Usuario);
			return true;
		}
		return false;
   }
   
   public function setCurrentBimester()
   {
		$today = date("Y-m-d");
		$year  = date("Y");
		$this->db->select('*',false);
		$this->db->from('tbl_bimester');
		$this->db->where('year = '.$year);
		$query = $this->db->get();
		$row = $query->row();
		if($today <= $row->primer_bimestre){
			return "I";
		} else if($today <= $row->segundo_bimestre){
			return "II";
		} else if($today <= $row->tercer_bimestre){
			return "III";
		} else if($today <= $row->cuarto_bimestre){
			return "IV";
		} 
		return "-";
   }
}
?>