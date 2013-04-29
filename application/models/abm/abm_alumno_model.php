<?php
class abm_alumno_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }   
	
	function listarAlumnos($pAno,$pSeccion){
		$sql = 'SELECT p.name, p.lastname, a.grade, a.section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person AND a.grade="'.$pAno.'" AND a.section="'.$pSeccion.'";';
		$query = $this->db->query($sql);
		//echo $sql;
		$data = $query->result();
		/*foreach ($data as $row) {
			echo $row->p.name;
			echo $row->p.lastname;
			echo $row->a.grade;
			echo $row->a.section;
			
		}*/
		return $query->result();
	}
	
  	function consultarAlumnos($parametro,$tipo,$inicio,$tamanio,$sEcho)
    {

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
		$sqlBeneficiado= $this->db->get();
		   $dataBeneficiado = $sqlBeneficiado->result();
		$rowcount = $sqlBeneficiado->num_rows();
		$lista_coincidencias=array();
		
		$ouput=null;
		$output = array(
					"sEcho" => intval($sEcho),
					"iTotalRecords" => 0,
					"iTotalDisplayRecords" => 0,
					"aaData" => array()
				);
		if($sqlBeneficiado->num_rows()!=0)
		{
					
			foreach ($dataBeneficiado as $value) 
			{
				$lista_coincidencias[]=$value;
			}			
			$this->db->select('count(*) as total');		
	    	$this->db->from('beneficiado');
			$this->db->join('persona','beneficiado.IdPersona=persona.IdPersona');
			if($tipo==1)
			{
    			$this->db->like('concat(ApellidoPaterno," ",ApellidoMaterno," ",Nombres)',$parametro,'after');
			}
			else 
			{
				$this->db->like('concat(ApellidoPaterno," ",ApellidoMaterno," ",Nombres)',$parametro,'after');
			}
			$sqlTotal= $this->db->get();
		    $dataTotal = $sqlTotal->result();
			$output = array(
				"sEcho" => intval($sEcho),
				"iTotalRecords" => $rowcount,
				"iTotalDisplayRecords" => $dataTotal[0]->total,
				"aaData" => $lista_coincidencias
			);
		}
		return $output ;
    }
	function registrarAlumno($pNombres, $pApellidos, $pDireccion, $pDni, $pTelefono, $pCelular, $pSexo, $pNacimiento, $pCorreo, $pAno, $pSeccion)
	{
		$this->db->trans_begin();
		$dataPersona = array(
				"name"		=> $pNombres,
				"lastname" 	=> $pApellidos,
				"address" 	=> $pDireccion,
				"phone"		=> $pTelefono,
				"cellphone"	=> $pCelular,
				"dni"		=> $pDni,
				"sex"		=> $pSexo,
				"e-mail" 	=> $pCorreo,
				"born"		=> $pNacimiento
			);
		$this->db->insert('tbl_person', $dataPersona); 
		$IdPersona = $this->db->insert_id();
		$dataAlumno = array(			
				 "id_person"=>$IdPersona,   
			     "grade"=>$pAno,
			     "section"=>$pSeccion,
			     "condition"=>"H"
			);
		$this->db->insert('tbl_alumn', $dataAlumno); 
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

