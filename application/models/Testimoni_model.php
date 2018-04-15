<?php 


/**
* 
*/
class Testimoni_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function get_where($table, $array){
		$query = $this->db->get_where($table,$array);
		return $query;
	}

	public function get_limit(){
		
		$this->db->order_by("date_create_testi", "DESC");
		$query = $this->db->get_where("testimoni", array('status_publishing' => 'publishing'), 6,0);
		return $query;
	}
	public function list_testimoni($perpage = NULL,$start = NULL){
		$this->db->order_by("date_create_testi", "DESC");
		$this->db->limit($perpage,$start);
		$query = $this->db->get_where("testimoni", array('status_publishing' => 'publishing'));
		return $query;
	}


	public function update($table, $array,$where,$init){
		$this->db->where($where,$init);
		$query = $this->db->update($table,$array);
		return $query;
	}
	public function insert($table,$array){
		$query = $this->db->insert($table,$array);
		return $query;
	}
	public function get_testi(){
		$this->db->order_by("date_create_testi","DESC");
		$query = $this->db->get_where("testimoni");
		return $query->result_array();
	}

	public function delete($id){
		$query = $this->db->delete("testimoni",array('testimoni_id' => $id));
		return $query;

	}
}


?>