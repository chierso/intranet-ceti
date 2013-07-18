<?php
	class util_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getBimestres($pAno) {
		$sql = 'SELECT * FROM tbl_bimester WHERE `year`= "' . $pAno . '";';
		$query = $this -> db -> query($sql);
		if($query->num_rows()>0){
			$data = $query -> result();
		}
		else
		{
			$data = null;
		}
		return $data;
	}
	
	function insertBimestres($calendario){
		$this->db->insert($this->tbl_bimester, $calendario);
        return $this->db->insert_id();
	}
	
	function updateBimestres($calendario,$year){
		$this->db->where('year', $year);
        $this->db->update('tbl_bimester', $calendario);
	}
	

}
?>

