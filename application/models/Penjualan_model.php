<?php 


/**
* 
*/
class Penjualan_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_data($open,$end,$start,$perpage){
		$query = $this->db->query("SELECT * FROM order_kambing WHERE order_status = 'Process' AND date_deliver >= '".$open."' AND date_deliver <= '".$end."' ORDER BY date_deliver DESC LIMIT ".$start.",".$perpage);
		return $query;
	}
	public function get_data_num($open,$end){
		$query = $this->db->query("SELECT * FROM order_kambing WHERE order_status = 'Process' AND date_deliver >= '".$open."' AND date_deliver <= '".$end."'");
		return $query;
	}



	public function get_like($q,$perpage,$start){
		$this->db->like("order_id",$q);
		$this->db->or_like("order_id",$q);
		$this->db->or_like("costumer_name",$q);
		$this->db->or_like("phone",$q);
		$this->db->or_like("address",$q);
		$this->db->or_like("map_address",$q);
		$this->db->limit($perpage,$start);
		$query = $this->db->get("order_kambing");
		return $query;
	}
	public function num_get_like($q){
		$this->db->like("order_id",$q);
		$this->db->or_like("order_id",$q);
		$this->db->or_like("costumer_name",$q);
		$this->db->or_like("phone",$q);
		$this->db->or_like("address",$q);
		$this->db->or_like("map_address",$q);
		$query = $this->db->get("order_kambing");
		return $query;
	}
	public function min_order(){
		$this->db->select_min("date_deliver");
		$query = $this->db->get_where("order_kambing", array('date_deliver !=' => "0000" ));
		$get = $query->row_array();
		return $get['date_deliver'];
	}
}




?>