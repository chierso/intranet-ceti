<?php
class abm_subject_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }   
	
	function listarSubjects()
    {
			$this->db->select('id_subject, name',false);			
	    	$this->db->from('tbl_subject');
			//$this->db->like('name',$parametro,'after');
			$sqlSubject= $this->db->get();
		    return $sqlSubject->result();
			
    }
}
?>

