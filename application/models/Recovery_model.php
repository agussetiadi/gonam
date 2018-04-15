<?php 


/**
* 
*/
class Recovery_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function get_where($table,$array){
		$query = $this->db->get_where($table,$array);
		return $query;
	}

	public function insert($table,$array){
		$query = $this->db->insert($table,$array);
		return $query;
	}
	public function update($table,$array,$where,$id){
		$this->db->where($where,$id);
		$query = $this->db->update($table,$array);
		return $query;
	}
}


?>