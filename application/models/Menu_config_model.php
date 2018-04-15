<?php 

/**
* 
*/
class Menu_config_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_menu1(){
		$query = $this->db->get_where("menu",array('display' =>  'true', 'is_deleted' => 0));
		return $query;
	}

	public function update($id,$array){
		$this->db->where("menu_id",$id);
		$query = $this->db->update("menu", $array);
		return $query;
	}
}


?>