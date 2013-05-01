<?php
class abm_user_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }   
	
	function registrarUsuario($pCorreoElectronico,$pRol)
	{
		$this->db->trans_begin();
		$string = "";
  		$possible = "0123456789bcdfghjkmnpqrstvwxyz";
  		$i = 0;
			while ($i < 8) {
			   $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			   $string .= $char;
			   $i++;
			}
			$dataUser = array(
				"email"		=> $pCorreoElectronico,
				"password" 	=> $string,
				"id_role"	=> $pRol
				);
			$this->db->insert('tbl_users', $dataUser); 
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

	
	function exportarBeneficiados($parametro,$tipo)
    {
	    	$this->db->select('DNI,NombresCompletos,NombreCarreraProfesional,NumCiclo,CondicionFinal');				
	    	$this->db->from('beneficiado');
			$this->db->join('carrera_profesional','beneficiado.IdCarreraProfesional = carrera_profesional.IdCarreraProfesional');
    		if($tipo==1)
			{
    		$this->db->like('DNI',$parametro,'after');
			}
			else 
			{
			$this->db->like('NombresCompletos',$parametro,'after');
			}
			$sqlBeneficiado= $this->db->get();
		    $dataBeneficiado = $sqlBeneficiado->result();
			$rowcount = $sqlBeneficiado->num_rows();
			$lista_coincidencias=array();
			$output=null;
			if($sqlBeneficiado->num_rows()!=0)
			{
						$indice = 0;
						foreach ($dataBeneficiado as $value) 
						{
							$lista_coincidencias[$indice]['dni']=$value->DNI;
							$lista_coincidencias[$indice]['nombrescompletos']=$value->NombresCompletos;
							$lista_coincidencias[$indice]['nombrecarreraprofesional']=$value->NombreCarreraProfesional;
							$lista_coincidencias[$indice]['numciclo']=$value->NumCiclo;
							$lista_coincidencias[$indice]['condicionfinal']=$value->CondicionFinal;
							$indice++;
						}			
				$output = $lista_coincidencias;
				
			}
			return $output ;
    }
}
?>

