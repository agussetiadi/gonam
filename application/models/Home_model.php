<?php 


/**
* 
*/
class Home_model extends CI_model
{
	public $num;
	function __construct()
	{
		parent::__construct();
	}
	public function num_order_pending(){
		$query = $this->db->get_where("order_kambing",array('order_status' => 'pending'));
		$this->num = $query->num_rows();
		return $query;
	}
	public function num_order_total(){
		$query = $this->db->get_where("order_kambing",array('order_status !=' => 'temp'));
		$this->num = $query->num_rows();
		return $query;
	}

	public function num_member(){
		$query = $this->db->get("user");
		$this->num = $query->num_rows();
		return $query;
	}

	public function num_activity(){
		$query = $this->db->get("activity");
		$this->num = $query->num_rows();
		return $query;
	}

	public function chart_order(){
		$date = date_create();
		$modif = date_modify($date,"-14 day");
		$result = date_format($modif, "Y-m-d");

		$query = $this->db->query("SELECT * FROM order_kambing WHERE order_status = 'Process' AND date_deliver >= '".$result."' GROUP BY date_deliver");
		return $query;
	}
	public function get_order($date){
		$query = $this->db->get_where("order_kambing",array('date_deliver' => $date));
		return $query->num_rows();
	}


	public function activity_chart(){

		$date = date_create();
		$modif = date_modify($date,"-7 day");
		$result = date_format($modif, "Y-m-d");

		$this->db->group_by("activity_date");
		$query = $this->db->get_where("activity", array('activity_date >' => $result ));
		return $query;
	}
	public function get_activity($date){
		$query = $this->db->get_where("activity",array('activity_date' => $date));
		return $query->num_rows();
	}

	public function get_num(){
		return $this->num;
	}
}


?>