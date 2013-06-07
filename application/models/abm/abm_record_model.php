<?php
class abm_record_model extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }
	
	
	function insertar_notas($pAlumno, $pGrado, $pSeccion, $pCurso, $pBimester, $pNota){
		$this->db->trans_begin();
			// first registration
			$idRegistration = null;
			$pBimester = "N".$pBimester;
/*			if($this->verify_registration($pAlumno,$pGrado,$pSeccion)==null){
				$dataRegistration = array(
						"id_alumn"	=> $pAlumno,
						"grade" 	=> $pGrado,
						"section"	=> $pSeccion,
						"year"		=> date('Y')
						);
				$this->db->insert('tbl_registration', $dataRegistration); 
				$idRegistration = $this->db->insert_id();
			}
			else{*/
			$idRegistration = $this->verify_registration($pAlumno,$pGrado,$pSeccion,date('Y'));
			//}
				
			$dataRecord = array(			
					"id_subject"			=> $pCurso,   
					$pBimester."_average"  	=> $pNota,
					"id_registration"		=> $idRegistration
				);
			$this->db->insert('tbl_record', $dataRecord); 
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $data="No se pudo registrar";
		}
		else
		{
		    $this->db->trans_commit();
		    $data="El registro del beneficiado";
		}
		return $data;
	}   

	function listar_notas($pAlumno){
		$this->db->select('r.id_alumn, concat(UPPER(p.lastname), " ", p.name) AS Alumno, r.grade AS Grado, r.section as Seccion, s.name, rc.N1_average, rc.N2_average, rc.N3_average, rc.N4_average',false);
		$this->db->from('tbl_person AS p, tbl_alumn AS a, tbl_registration AS r, tbl_record AS rc, tbl_subject AS s');
		$this->db->where('r.id_alumn = '.$pAlumno.' AND a.id_person = p.id_person AND r.id_alumn = a.id_alumn AND rc.id_registration =  r.id_registration AND s.id_subject = rc.id_subject');
		$query = $this->db->get();
		return ($query->result());
	}   
	
	function update_notas($idRecord,$pAlumno, $pGrado, $pSeccion, $pCurso, $pBimester, $pNota){
		$this->db->trans_begin();
			$pBimester = "N".$pBimester;
			$dataRecord = array(			
					"id_subject"			=> $pCurso,   
					$pBimester."_average"  	=> $pNota
				);
			$this->db->where('id_record',$idRecord);
			$this->db->update('tbl_record', $dataRecord);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    $data="No se pudo registrar";
		}
		else
		{
		    $this->db->trans_commit();
		    $data="El registro del beneficiado";
		}
		return $data;
	}
	
	function verify_record($pAlumno, $pGrado, $pSeccion, $pCurso){
		$this->db->select('rc.id_record');
		$this->db->from('tbl_registration rg, tbl_record rc');
		$this->db->where('rg.id_alumn = '.$pAlumno.' AND rg.grade = '.$pGrado.' AND rg.section = "'.$pSeccion.'" AND rc.id_subject = '.$pCurso.' AND rc.id_registration = rg.id_registration');
		$query = $this->db->get();
		$row = $query->row(); 
		if($query->num_rows()>0){
		   return $row->id_record;
		} 
		else{
			return null;
		}
	}
	
	function verify_registration($pAlumno, $pGrado, $pSeccion,$pYear){
		echo 'holi-><h1>'.$pAlumno.'!</h1><br />';
		$this->db->select('id_registration');
		$this->db->from('tbl_registration');
		$this->db->where('id_alumn = '.$pAlumno.' AND grade = '.$pGrado.' AND section = "'.$pSeccion.'" AND year ='.$pYear);
		$query = $this->db->get();
		$row = $query->row(); 
		if($query->num_rows()>0){
		   return $row->id_registration;
		} 
		else{
			return null;
		}
	}
	

	function aperturarAno($pAno)
	{
		$this->db->trans_begin();
			if($this->db->count_all('tbl_year')){
				$dataUpdate = array("condition"=>"N");
				$this->db->where("condition","V");
				$this->db->update('tbl_year',$dataUpdate);
				
			}
			$dataAno = array(
					"year"		=> $pAno,
					"condition" => "V"
					);
			$this->db->insert('tbl_year', $dataAno);
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
	
	function asignarDocenteCurso($pIdDocente,$pIdCurso,$pSeccion){
		$this->db->trans_begin();
			$dataAsignacion = array(
					"id_subject" => $pIdCurso,
					"id_docente" => $pIdDocente,
					"seccion"	 => $pSeccion
					);
			$this->db->insert('tbl_subject_docente', $dataAsignacion);
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

	function agregarRegistration($pIdAlumno,$pGradeSection,$pYear){
		$this->db->trans_begin();
		$query = $this->db->query(''); // this.db.query();
			$dataRegistration = array(
				"id_alumn" 		=>	$pIdAlumno,
				"grade_section"	=>  $pGradeSection,
				"year"			=>  $pYear 
			);
			$this->db->insert('tbl_registration',$dataRegistration);
		$this->db->trans_complete();
		if($this->db->trans_status()==FALSE){
			$this->db->trans_roolback();			
		}
		else{
			$this->db->trans_commit();
		}
		return "Se insertó correctamente";
	}
}
?>

