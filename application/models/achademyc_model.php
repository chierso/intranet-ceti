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
   
   public function listarTutoria(){
   		$query = $this->db->query('SELECT d.id_docente as ID, concat(p.name, " ", p.lastname) as Docente, t.salon as Salon, t.year as Ano FROM (tbl_docente d, tbl_asignacion_tutoria t, tbl_person p) WHERE d.id_person=p.id_person AND d.id_docente = t.id_docente ;');
   		return $query->result();
   }
   
   function asignar_tutoria($pIdDocente, $pAno, $pSeccion)
	{
		$salon = $pAno."-".$pSeccion;
		$year = $this->session->userdata("Year");
		$this->db->trans_begin();
			$dataTutoria = array(
					"id_docente"	=> $pIdDocente,
					"salon" 		=> $salon,
					"year" 			=> $year
				);
			$this->db->insert('tbl_asignacion_tutoria', $dataTutoria); 
		$this->db->trans_complete();
		$data=null;
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $data=array("tipoMensaje"=>"E","mensaje"=>"No se pudo registrar");
		}
		else
		{
		    $this->db->trans_commit();
		    $data=array("tipoMensaje"=>"S","mensaje"=>"El registro del beneficiado");
		}
		return $data;
	}
}
?>