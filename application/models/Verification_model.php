<?php 

/**
* 
*/
class Verification_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	#table auth
	#select
	#check access token
	public function check_auth($array){
		$this->db->order_by("auth_id", "DESC");
		$query = $this->db->get_where("auth",$array);
		return $query->row_array();
	}

}

?>