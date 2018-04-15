<?php 


/**
* 
*/
class Supplier_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function get_opt(){
		$query = $this->db->get_where("supplier", array("is_deleted" => 0));
		return $query->result_array();
	}
	public function get_supplier($array){
		$query = $this->db->get_where("supplier", $array);
		return $query->result_array();
	}
	public function get_supplier2($array){
		$query = $this->db->get_where("supplier", $array);
		return $query->row_array();
	}
}


?>