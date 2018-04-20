<?php 

/**
* 
*/
class Pos_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function load_customer(){


		$requestData 	= $_REQUEST;


		/*Required Dont change*/
		$field 		= $requestData['field'];
		$sort 			= $requestData['sort'];

		$search 		= $requestData['search'];

		$length 		= $requestData['length'];
		$start 			= $requestData['start'];
		/*Required Dont change*/



		


		if( !empty($search) ) {

		    // if there is a search parameter

		    $this->db->order_by($field,$sort);
		    $this->db->limit($length,$start);
		    $this->db->like("customer_name",$search);
		    $d = $this->db->get_where("pos_customer", array("is_deleted" => 0));
		    $query = $d->result_array();


		    $this->db->like("customer_name",$search);
		   	$totalFiltered = $this->db->get_where("pos_customer", array("is_deleted" => 0))->num_rows();
		    
		} 
		else{
			$this->db->order_by($field,$sort);
			$this->db->limit($length,$start);

			$ex =  $this->db->get_where("pos_customer", array("is_deleted" => 0));
			$query = $ex->result_array();

			$totalFiltered = $this->db->get_where("pos_customer", array("is_deleted" => 0))->num_rows();	
		}



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$nested[] = $value['customer_code'];
			$nested[] = $value['customer_name'];
			$nested[] = $value['customer_phone'];
			$nested[] = $value['customer_address'];
			$nested[] = '<button class="btn btn-info btn-sm btn-cust" data-value="'.$value['customer_id'].'">Pilih</button>';
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}

	public function q_order($requestData){
	    if (!empty($requestData['length'])) {
	    	$this->db->limit($requestData['length'],$requestData['start']);
	    }
	    if (!empty($requestData['search'])) {
	    	$this->db->like("customer_name",$requestData['search']);
	    }
	    if (!empty($requestData['sort'])) {
	    	$this->db->order_by($requestData['field'],$requestData['sort']);
	    }

	    $arr = $requestData['where'];
		$this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "LEFT");
	    $d = $this->db->get_where("pos_order", $arr);
	    return $d;
	}

	public function render_order(){

		$requestData 	= $_POST;
		$arr = array("pos_order.is_deleted" => 0,'order_status !=' => 'Temp');

		if ($requestData['paid_off'] == "L") {
			$arr['paid_off'] = 1;
		}
		elseif ($requestData['paid_off'] == "BL") {
			$arr['paid_off'] = 0;
		}

		if ($requestData['order_status'] == 'Done') {
			$arr['order_status'] = "Done";
		}
		elseif ($requestData['order_status'] == 'Pending') {
			$arr['order_status'] = "Pending";	
		}

		if (!empty($requestData['date_deliver'])) {
			$arr['date_deliver >='] = $requestData['date_deliver'];
		}
		if (!empty($requestData['date_deliver2'])) {
			$arr['date_deliver <='] = $requestData['date_deliver2'];
		}


		
		
		if( !empty($requestData['search']) ) {

			$params1 = [
				'length' => $requestData['length'],
				'start' => $requestData['start'],
				'search' => $requestData['search'],
				'sort' => $requestData['sort'],
				'field' => $requestData['field'],
				'where' => $arr
			];

			$params2 = [
				'search' => $requestData['search'],
				'where' => $arr
			];

			$query = $this->q_order($params1)->result_array();
			$totalFiltered = $this->q_order($params2)->num_rows();


		    // if there is a search parameter

		    /*$this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "LEFT");
		    $this->db->order_by($requestData['field'],$requestData['sort']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("customer_name",$requestData['search']);
		    $d = $this->db->get_where("pos_order", $arr);
		    $query = $d->result_array();*/


		    /*$this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "LEFT");
		    $this->db->like("customer_name",$requestData['search']);
		   	$totalFiltered = $this->db->get_where("pos_order", $arr)->num_rows();*/
		    
		} 
		else{

			$params1 = [
				'length' => $requestData['length'],
				'start' => $requestData['start'],
				'sort' => $requestData['sort'],
				'field' => $requestData['field'],
				'where' => $arr
			];

			$params2 = [
				'where' => $arr
			];

			$query = $this->q_order($params1)->result_array();
			$totalFiltered = $this->q_order($params2)->num_rows();

			/*$this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "LEFT");
			$this->db->order_by($requestData['field'],$requestData['sort']);
			$this->db->limit($requestData['length'],$requestData['start']);

			$ex =  $this->db->get_where("pos_order", $arr);
			$query = $ex->result_array();

			$this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "LEFT");
			$totalFiltered = $this->db->get_where("pos_order", $arr)->num_rows();*/	
		}



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			if ($value['paid_off'] == 1) {
				$stb = "Lunas";
			}
			else{
				$stb = "Belum Lunas";
			}

			$btn = '<a href="'.admin_url()."pos/order/".$value['order_id'].'"><button class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></button></a> ';
			$btn .= '<div class="dropdown" style="float:left; margin-right:5px;">
					  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="fa fa-print"></span>
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <a target="_blank" class="dropdown-item" href="'.admin_url()."pos/print_order/".$value['order_id'].'?target=invoice">Invoice</a>
					    <a target="_blank" class="dropdown-item" href="'.admin_url()."pos/print_order/".$value['order_id'].'?target=form">Form</a>
					    <a target="_blank" class="dropdown-item" href="'.admin_url()."pos/print_order/".$value['order_id'].'?target=all">Print All</a>
					  </div>
					</div>';

			$btn .= '<a class="btnDeleteOrder" href="'.admin_url()."pos/delete_order/".$value['order_id'].'"><button class="btn btn-sm btn-danger"><span class="fa fa-trash"></button></a>';

			$nested[] = $value['no_trx'];
			$nested[] = $value['customer_name']." - ".$value['customer_phone']."<br>".$value['address'];
			$nested[] = $this->class_date->arr_bulan($value['date_deliver'])."<br> Jam ".substr($value['time_deliver'], 0,5);
			$nested[] = $value['grand_total'];
			$nested[] = $stb;
			$nested[] = $value['order_status'];
			$nested[] = $btn;
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}

	public function print_flitered_order(){

		$requestData 	= $_REQUEST;
		$arr = array("pos_order.is_deleted" => 0);

		if ($requestData['paid_off'] == "1") {
			$arr['paid_off'] = 1;
		}
		elseif ($requestData['paid_off'] == "0") {
			$arr['paid_off'] = 0;
		}

		if ($requestData['order_status'] == 'Done') {
			$arr['order_status'] = "Done";
		}
		elseif ($requestData['order_status'] == 'Pending') {
			$arr['order_status'] = "Pending";	
		}

		if (!empty($requestData['date_deliver'])) {
			$arr['date_deliver >='] = $requestData['date_deliver'];
		}
		if (!empty($requestData['date_deliver2'])) {
			$arr['date_deliver <='] = $requestData['date_deliver2'];
		}


		
		
		if( !empty($requestData['search']) ) {

		    // if there is a search parameter
		    $this->db->like("customer_name",$requestData['search']);
		    $this->db->or_like("no_trx",$requestData['search']);
		    $this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "INNER");
		    $this->db->order_by($requestData['field'],$requestData['sort']);
		    $d = $this->db->get_where("pos_order", $arr);
		    $query = $d->result_array();


		    $this->db->like("customer_name",$requestData['search']);
		    $this->db->or_like("no_trx",$requestData['search']);
		    $this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "INNER");
		   	$totalFiltered = $this->db->get_where("pos_order", $arr)->num_rows();
		    
		} 
		else{

			$this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "INNER");
			$this->db->order_by($requestData['field'],$requestData['sort']);
			$ex =  $this->db->get_where("pos_order", $arr);
			$query = $ex->result_array();

			$this->db->join("pos_customer", "pos_customer.customer_id = pos_order.customer_id", "INNER");
			$totalFiltered = $this->db->get_where("pos_order", $arr)->num_rows();	
		}


		$arrayData = array('query' => $query,'totalFiltered' => $totalFiltered);
		return $arrayData;
	}

	public function save_to_blog($title, $hastag, $meta_des, $description){

		$str = $title;
		#check data berdasarkan slug
		$str_low = strtolower($str);
		$cleared = str_replace(array('|', '"', ',' , ';', '<', '>','?','!','@','$','^','&','*','(',')','-','+','=','{','}','[',']','.','/','!','~','`' ), ' ', $str_low);
		$str_replace = str_replace("  ", "", $cleared);
		$str_replace = str_replace(" ", "-", $str_replace);

			/*check query*/
			$query = $this->db->get_where("blog", array("blog_slug" => $str_replace));
			if ($query->num_rows() > 0) {
				$slug = $str_replace."-".time();
			}
			else{
				$slug = $str_replace;	
			}
		$value['blog_slug'] = filter_char($slug);
		$value['admin_id'] = $this->session_admin->admin_id();
		$value['judul'] = ucwords($str);
		
		$value['deskripsi'] = ucfirst($description);
		$value['date'] = date("Y-m-d");
		$value['time'] = date("H:i:s");
		$value['hastag'] = $hastag;
		$value['meta_des'] = $meta_des;
		$value['format'] = 'artikel';
		$value['status'] = 'publish';

		$query = $this->db->insert("blog", $value);
		if ($query) {
			return $value;
		}
	}
}