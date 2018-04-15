<?php 

/**
* 
*/
class Notif_order_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function get_config(){
		$query = $this->db->get("config_notif");
		return $query->result_array();
	}
	public function edit_active($id,$data){
		$this->db->where("config_notif_id",$id);
		$query = $this->db->update("config_notif", $data);
		return $query;

	}
	
}

?>