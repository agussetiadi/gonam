<?php 


/**
* 
*/
class Panti_model extends CI_model
{
	
	public function select_all(){
		$query = $this->db->get("panti");
		return $query->result_array();
	}
	public function select_where($id){
		$query = $this->db->get_where("panti",array('panti_id' => $id ));
		return $query->row_array();
	}
}


?>