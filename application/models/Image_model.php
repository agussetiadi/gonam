<?php 


class Image_model extends CI_model
{
	
	function __construct(){
		parent::__construct();
	}
	public function get_image($arr){

	}

	public function insert_image($array){
		$query = $this->db->insert("image_post", $array);
		return $query;
	}
	public function get_data($array){
		$query = $this->db->get_where("image_post", $array);
		return $query;
	}
}

?>