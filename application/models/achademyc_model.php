<?php
class Achademyc_model extends CI_Model
{
   public function __construct()
   {
      parent::__construct();
   }

   public function anoVigente()
   {
      	$this->db->select('year');
		$this->db->from('tbl_year');
		$this->db->where('condition', 'V');
		$this->db->limit(1);
		$query = $this->db->get(); // SELECT id,email,password FROM usuarios WHERE 'email' = 'email' LIMIT 0,1
		$data = $query->result(); // OBTIENES EL RESULTSET DE LA CONSULTA ANTERIOR
		return $data[0]->year;
   }
   
   public function listarDocentes(){
   		$this->db->select('id_docente,concat(name," ",lastname) as Docente',false);
		$this->db->from('tbl_docente');
		$this->db->join('tbl_person','tbl_docente.id_person=tbl_person.id_person');
		$query= $this->db->get();
		return $query->result();
   }
   
   public function holi(){
   	$this->db->select('DNI,concat(ApellidoPaterno," ",ApellidoMaterno," ",Nombres) as NombresCompletos,NombreCarreraProfesional,NumCiclo,CondicionFinal ',false);			
	    	$this->db->from('beneficiado');
			$this->db->join('persona','beneficiado.IdPersona=persona.IdPersona');
			$this->db->join('carrera_profesional','persona.IdCarreraProfesional = carrera_profesional.IdCarreraProfesional');		
			$this->db->limit($tamanio,$inicio);
    		if($tipo==1)
			{
    		$this->db->like('DNI',$parametro,'after');
			}
			else 
			{
			$this->db->like('concat(ApellidoPaterno," ",ApellidoMaterno," ",Nombres)',$parametro,'after');
   }
   }
}
?>