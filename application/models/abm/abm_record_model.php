<?php
class abm_record_model extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
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

}
?>

