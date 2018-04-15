<?php

/**
* 
*/
class Home extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");
		
	}

	public function index(){
		$data['page'] = 'admin/home';
		$this->template->get_view($data);
	}
	public function render_count_data(){
		$queryUsers = $this->db->get_where("user", array("is_deleted" => 0))->num_rows();
		$queryOrders = $this->db->get_where("pos_order", array("is_deleted" => 0,'order_status' => 'Done'))->num_rows();
		$queryPurchase = $this->db->get_where("pembelian", array("is_deleted" => 0,'status' => 'Done'))->num_rows();
		$queryCustomers = $this->db->get_where("pos_customer", array("is_deleted" => 0))->num_rows();
		echo json_encode(array(
			'status' => 'ok',
			'data' => array(
				'countUsers' => $queryUsers,
				'countOrders' => $queryOrders,
				'countPurchase' => $queryPurchase,
				'countCustomers' => $queryCustomers
				)
			));

	}

	public function render_visitors(){
		$now = date_create();
		$date_modify 	 = date_modify($now, "-7 day");
		$initData =  date_format($date_modify, "Y-m-d");

		$query = $this->db->get_where("activity", array('activity_date >=' => $initData));
		$date = [];
		foreach ($query->result_array() as $key => $value) {
			$dt = $value['activity_date'];
			$alDate = class_date::arr_day($dt);
			$date[$alDate] = $this->db->get_where("activity", array('activity_date' => $dt))->num_rows();
		}
		echo json_encode(array('status' => 'ok', 'data' => $date));
	}

	public function render_product(){
		$this->db->limit(8,0);
		$this->db->order_by('product_hits','DESC');
		$queryProduct = $this->db->get_where("pos_product", array('is_deleted' => 0));

		
		$data = [];
		foreach ($queryProduct->result_array() as $key => $value) {
			$num = $this->db->get_where('pos_order_detail', array('product_id' => $value['product_id']))->num_rows();
			$name = $value['product_name'];
			$y = $num;

			$data[] = array(
				'name' => $name,
				'y' => $y
				);
		}

		echo json_encode(array('status' => 'ok','data' => $data));
	}

}