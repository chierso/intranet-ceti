<?php
class abm_subject_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }   
	
	function listarSubjects()
    {
			$this->db->select('*',false);			
	    	$this->db->from('tbl_subject');
			$sqlSubject= $this->db->get();
		    return $sqlSubject->result();
    }
}
?>

