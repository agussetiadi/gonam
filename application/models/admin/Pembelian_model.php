<?php

/**
* 
*/
class Pembelian_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function load_supplier(){
		$requestData 	= $_REQUEST;


		/*Required Dont change*/
		$field 			= $requestData['field'];
		$sort 			= $requestData['sort'];

		$search 		= $requestData['search'];

		$length 		= $requestData['length'];
		$start 			= $requestData['start'];
		/*Required Dont change*/



		


		if( !empty($search) ) {

		    // if there is a search parameter

		    $this->db->order_by($field,$sort);
		    $this->db->limit($length,$start);
		    $this->db->like("supplier_name",$search);
		    $d = $this->db->get_where("supplier", array("is_deleted" => 0));
		    $query = $d->result_array();


		    $this->db->like("supplier_name",$search);
		   	$totalFiltered = $this->db->get_where("supplier", array("is_deleted" => 0))->num_rows();
		    
		} 
		else{
			$this->db->order_by($field,$sort);
			$this->db->limit($length,$start);

			$ex =  $this->db->get_where("supplier", array("is_deleted" => 0));
			$query = $ex->result_array();

			$totalFiltered = $this->db->get_where("supplier", array("is_deleted" => 0))->num_rows();	
		}



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$nested[] = $key + 1;
			$nested[] = $value['supplier_name'];
			$nested[] = $value['supplier_phone'];
			$nested[] = $value['supplier_address'];
			$nested[] = '<button class="btn btn-info btn-sm btn-sup" data-value="'.$value['supplier_id'].'">Pilih</button>';
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}
	public function render_pembelian(){
		$requestData 	= $_POST;
		$arr = array("pembelian.is_deleted" => 0);
		if (!empty($requestData['date_trx'])) {
			$arr['date_trx'] = $requestData['date_trx'];
		}

		if ($requestData['is_paid'] == "1") {
			$arr['is_paid'] = 1;
		}
		elseif ($requestData['is_paid'] == "0") {
			$arr['is_paid'] = 0;
		}
		
		if( !empty($requestData['search']) ) {

		    // if there is a search parameter

		    $this->db->order_by($requestData['field'],$requestData['sort']);
		    $this->db->limit($requestData['length'],$requestData['start']);


		    $this->db->like("supplier_name",$requestData['search']);
		    $this->db->or_like("no_pembelian",$requestData['search']);
		    $this->db->or_like("no_terima",$requestData['search']);
		    $this->db->join("supplier", "supplier.supplier_id = pembelian.supplier_id", "INNER");
		    $d = $this->db->get_where("pembelian", $arr);
		    $query = $d->result_array();


		    $this->db->like("supplier_name",$requestData['search']);
		    $this->db->or_like("no_pembelian",$requestData['search']);
		    $this->db->or_like("no_terima",$requestData['search']);
		    $this->db->join("supplier", "supplier.supplier_id = pembelian.supplier_id", "INNER");
		   	$totalFiltered = $this->db->get_where("pembelian", $arr)->num_rows();
		    
		} 
		else{
			$this->db->join("supplier", "supplier.supplier_id = pembelian.supplier_id", "INNER");
			$this->db->order_by($requestData['field'],$requestData['sort']);
			$this->db->limit($requestData['length'],$requestData['start']);

			$ex =  $this->db->get_where("pembelian", $arr);
			$query = $ex->result_array();

			$this->db->join("supplier", "supplier.supplier_id = pembelian.supplier_id", "INNER");
			$totalFiltered = $this->db->get_where("pembelian", $arr)->num_rows();	
		}



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];

			$btn = '<a href="'.admin_url()."pembelian/form/".$value['pembelian_id'].'"><button class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></button></a> ';
			$btn .= '<a target="_blank" href="'.admin_url()."pembelian/print_pembelian/".$value['pembelian_id'].'"><button class="btn btn-primary btn-sm" data-value="'.$value['pembelian_id'].'"><span class="fa fa-print"></span></button></a> ';
			$btn .= '<button class="bDelete btn btn-danger btn-sm" data-value="'.$value['pembelian_id'].'"><span class="fa fa-trash"></span></button>';

			$nested[] = $value['no_pembelian'];
			$nested[] = $value['no_terima'];
			$nested[] = $value['supplier_name'];
			$nested[] = number_format($value['total']);
			$nested[] = number_format($value['total_paid']);
			$nested[] = $value['date_trx'];
			$nested[] = $btn;
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}
	public function get_print(){
		$requestData 	= $_REQUEST;
		$arr = array("pembelian.is_deleted" => 0);
		if (!empty($requestData['date'])) {
			$arr['date_trx'] = $requestData['date'];
		}

		if ($requestData['is_paid'] == "1") {
			$arr['is_paid'] = 1;
		}
		elseif ($requestData['is_paid'] == "0") {
			$arr['is_paid'] = 0;
		}
		

		if( !empty($requestData['key']) ) {

		    // if there is a search parameter

		    $this->db->like("supplier_name",$requestData['key']);
		    $this->db->or_like("no_pembelian",$requestData['key']);
		    $this->db->or_like("no_terima",$requestData['key']);
		    $this->db->join("supplier", "supplier.supplier_id = pembelian.supplier_id", "INNER");
		    $d = $this->db->get_where("pembelian", $arr);
		    $query = $d->result_array();


		    $this->db->like("supplier_name",$requestData['key']);
		    $this->db->or_like("no_pembelian",$requestData['key']);
		    $this->db->or_like("no_terima",$requestData['key']);
		    $this->db->join("supplier", "supplier.supplier_id = pembelian.supplier_id", "INNER");
		   	$totalFiltered = $this->db->get_where("pembelian", $arr)->num_rows();
		    
		} 
		else{
			$this->db->join("supplier", "supplier.supplier_id = pembelian.supplier_id", "INNER");
			

			$ex =  $this->db->get_where("pembelian", $arr);
			$query = $ex->result_array();

			$this->db->join("supplier", "supplier.supplier_id = pembelian.supplier_id", "INNER");
			$totalFiltered = $this->db->get_where("pembelian", $arr)->num_rows();	
		}

		$result = array('query' => $query,'totalFiltered'=>$totalFiltered);
		return $result;
	}



}