<?php
class abm_alumno_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }   
	
	function listarAlumnos(){
		//$sql = 'SELECT concat(p.name," " ,p.lastname) as Alumno, a.grade, a.section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person AND a.grade="'.$pAno.'" AND a.section="'.$pSeccion.'";';
		$sql = 'SELECT a.id_alumn, concat(p.name," " ,p.lastname) as Alumno, a.grade as Grade, a.section as Section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person;';
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
	}
	
	function listarAlumnosGrado($pAno,$pSeccion){
		//$sql = 'SELECT concat(p.name," " ,p.lastname) as Alumno, a.grade, a.section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person AND a.grade="'.$pAno.'" AND a.section="'.$pSeccion.'";';
		$sql = 'SELECT a.id_alumn, concat(p.name," " ,p.lastname) as Alumno, a.grade as Grade, a.section as Section FROM tbl_person p, tbl_alumn a WHERE a.id_person=p.id_person AND a.grade="'.$pAno.'" AND a.section="'.$pSeccion.'" ;';
		echo '<script>alert("'.$sql.'")</script>';
		$query = $this->db->query($sql);
		$data = $query->result();
		return $data;
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
	function insertar_alumn($pNombres, $pApellidos, $pDireccion, $pDni, $pTelefono, $pCelular, $pSexo, $pNacimiento, $pCorreo, $pAno, $pSeccion)
	{
		$this->load->model("abm/abm_user_model");
		$this->abm_user_model->registrarUsuario($pCorreo,'alum');
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
				     "condition"=>"H"
				);
			$this->db->insert('tbl_alumn', $dataAlumno); 
			
		$this->db->trans_complete();
		$data=null;
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $data="Error! No se pudo registrar.";
		}
		else
		{
		    $this->db->trans_commit();
		    $data="Correcto! Los datos se cargaron correctamente.";
		}
	
	/*	$queryUser = $this->db->query('SELECT email, password FROM tbl_users  ORDER BY id_user DESC;');
		$result = $queryUser->result();
		$this->load->library('email');
		$this->email->from('intranet@institutosantarosa.com', 'IETI Santa Rosa');
		$this->email->to($pCorreo); 
		$this->email->subject('Nuevo usuario registrado!');
		$this->email->message('Su cuenta ha sido correctamente habilitada, sus datos son : <br /> Usuario: '.$result[0]->email.' - Contraseña: '.$result[0]->password);	
		$this->email->send();
	*/			
		return $data;
	}

	
}
?>

