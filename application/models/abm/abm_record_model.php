<?php
class abm_record_model extends CI_Model {
	
    function __construct()
    {
        parent::__construct();
    }   

	function aperturarAno($pAno)
	{
		$this->db->trans_begin();
			$dataUpdate = array("condition"=>"N");
			$this->db->update('tbl_year',$dataAno,'condition="V"');
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

}
?>

