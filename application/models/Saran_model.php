<?php

/**
* 
*/
class Saran_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_data($table,$array){
		$query = $this->db->get_where($table,$array);
		return $query;
	}
	public function get($table){
		$query = $this->db->get($table);
		return $query;
	}
	public function join_data($table,$field,$join){
		$query = $this->db->join($table,$field,$join);
		return $query;
	}
	public function get_saran($limit = NULL,$offset = NULL){
		$this->db->join("user","user.user_id = saran.user_id","LEFT");
		$this->db->order_by("saran.saran_date","DESC");
		$query = $this->db->get("saran",$limit,$offset);
		return $query;
	}

	public function delete($id){

		$query = $this->db->delete("saran", array('saran_id' => $id));
		return $query;
	}

}



 ?>