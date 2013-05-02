<?php
class abm_subject_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }   
	
	function listarSubjects($parametro,$inicio,$tamanio,$sEcho)
    {
			$this->db->select('id_subject, name',false);			
	    	$this->db->from('tbl_subject');
			$this->db->limit($tamanio,$inicio);
    		//$this->db->like('name',$parametro,'after');
			$sqlSubject= $this->db->get();
		    $dataBeneficiado = $sqlSubject->result();
			$rowcount = $sqlSubject->num_rows();
			$lista_coincidencias=array();
			
			$ouput=null;
			$output = array(
						"sEcho" => intval($sEcho),
						"iTotalRecords" => 0,
						"iTotalDisplayRecords" => 0,
						"aaData" => array()
					);
			if($sqlSubject->num_rows()!=0)
			{
						
						foreach ($dataBeneficiado as $value) 
						{
							$lista_coincidencias[]=$value;
						}			
						$this->db->select('count(*) as total');		
				    	$this->db->from('tbl_subject');
						//$this->db->like('name',$parametro,'after');
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
}
?>

