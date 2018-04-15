<?php 

/**
* 
*/
class User extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function admin($admin_id){
		$query = $this->db->get_where("admin", array("admin_id" => $admin_id));
		return $query->row_array();
	}
	public function member($user_id){
		$query = $this->db->get_where("user", array("user_id" => $user_id));
		return $query->row_array();
	}
}


?>