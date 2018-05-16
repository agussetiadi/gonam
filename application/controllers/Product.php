<?php

/**
* 
*/
class Product extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("user_template");
		$this->load->library("session_user");
		$this->load->model("product_model");
	}
	public function index(){
		$data['page'] = 'product';
		$data['queryCategory'] = $this->db->get_where('pos_category', array('is_deleted' => 0));
		$data2['title'] = "Produk & Layanan | Gonam Aqiqah";
		$this->user_template->get_view($data,$data2);
	}

	public function render_data(){
		$sort = $this->input->post("sort");
		$category_id = $this->input->post("category_id");
		$key_word = $this->input->post("key_word");

		$this->db->where('is_publish',1);
		$this->db->where('is_deleted',0);
		$this->db->where_in('category_id',$category_id);

		if (!empty($key_word)) {
			$this->db->like('product_name',$key_word);
		}
		
		if ($sort == "popular") {
			$this->db->order_by('product_hits','DESC');
		}
		if ($sort == "cheapest") {
			$this->db->order_by('product_price','ASC');
		}

		$query  = $this->db->get('pos_product')->result_array();


		$data = [];
		foreach ($query as $key => $value) {
			$data[] = array(
					'product_id' => $value['product_id'],
					'product_name' => $value['product_name'],
					'product_menu' => $value['product_menu'],
					'product_picture' => image_exists("assets/img/post_img/",$value['product_picture']),
					'product_info' => $value['product_info'],
					'product_price' => $value['product_price'],
					'is_publish' => $value['is_publish'],
				);
		}


		echo json_encode(array('status' => 'ok', 'data' => $data));

	}

	public function detail($product_id){
		$this->db->select('pos_product.*, pos_category.category_name');
		$this->db->join("pos_category","pos_category.category_id = pos_product.category_id","INNER");
		$query = $this->db->get_where('pos_product', array('product_id' => $product_id));
		$data['page'] = 'detail';
		$data['query'] = $query->row_array();

		$data2['title'] = $query->row_array()['product_name']." | Gonam Aqiqah";

		$this->user_template->get_view($data,$data2);
	}

	public function add_to_cart(){
		$session = $this->session_user->user_visitors();

		$product_id	 	= $this->input->post("product_id");
		$getOrder_qty	 	= $this->input->post("order_qty");
		$state	 	= $this->input->post("state"); /*cartWindow, productWindow*/




		$getProduct = $this->db->get_where("pos_product", array("product_id" => $product_id)) -> row_array();
		

		$product_hits = $getProduct['product_hits'] + 1;


		/*
		Check USer 
		apakah sudah melakukan session cart
		*/
		$num = $this->db->get_where("pos_order",array('session_id' => $session,'order_status' => 'Temp'));

		if ($num->num_rows() == 0) {
			$this->db->limit(1);
			$this->db->order_by("order_id","DESC");
			$getOrder = $this->db->get("pos_order")->row_array();
			$order_id = $getOrder['order_id'] + 1;
			$no_trx = "INV/".date("Ymd")."/".$order_id;
			$date_created 	= date("Y-m-d");
			/*query insert*/		
			$arrayInsertOrder = array('order_id' => $order_id,
									"no_trx" => $no_trx,
									'date_created' => $date_created,
									'session_id' => $session);
			$this->db->insert("pos_order", $arrayInsertOrder);
		}
		else{
			$queryOrder = $num->row_array();
			$order_id = $queryOrder['order_id'];
		}


		$queryCartDetail = $this->db->get_where("pos_order_detail",array('product_id' => $product_id,'order_id' => $order_id,'is_deleted' => 0));
		$numCartDetail = $queryCartDetail->row_array();


		if ($queryCartDetail->num_rows() == 0) {

			$product_menu 	= $getProduct['product_menu'];
			$sales_price 	= $getProduct['product_price'];
			$sales_hpp 		= $getProduct['product_hpp'];


			$discount = 0;
			$subtotal = $getOrder_qty * $sales_price;
			$total = $getOrder_qty * ($sales_price - $discount);


			$arrayDetail = array("order_id"=>$order_id,
								"product_id"=>$product_id,
								"masakan"=>$product_menu,
								"order_qty"=>$getOrder_qty,
								"sales_price"=>$sales_price,
								"sales_hpp"=>$sales_hpp,
								"subtotal"=>$subtotal,
								"total"=>$total
								);
			$queryEnd = $this->db->insert("pos_order_detail", $arrayDetail);
		}
		else{

			if ($state == 'cartWindow') {
				$order_qty = $getOrder_qty;
			}
			if ($state == 'productWindow') {
				$order_qty = $numCartDetail['order_qty'] + $getOrder_qty;
			}

			
			$price = $numCartDetail['sales_price'];
			$discount = $numCartDetail['discount'];

			$subtotal = $price * $order_qty;
			$total = ($price - $discount) * $order_qty;
			$this->db->where(array('order_id' => $order_id,'product_id' => $product_id));
			$queryEnd = $this->db->update('pos_order_detail',array(
					'order_qty' => $order_qty,
					'subtotal' => $subtotal,
					'total' => $total
			));

		}

		if ($queryEnd) {
			$this->db->where('product_id' ,$product_id);
			$this->db->update("pos_product", array('product_hits' => $product_hits));

			$updateTotal = $this->get_total($order_id);
			echo json_encode(array('status' => 'ok', 'order_id' => $order_id));
		}

	}
	private function get_total($order_id){
		$query = $this->db->get_where("pos_order_detail",array('order_id' => $order_id,'is_deleted' => 0));
		$total = 0;
		$subtotal = 0;
		$discount = 0;

		foreach ($query->result_array() as $key => $value) {
			$discount += $value['discount'];
			$total += $value['total'];
			$subtotal += $value['subtotal'];
		}

		$grand_total = $subtotal - $discount;

		$this->db->where("order_id",$order_id);
		$this->db->update("pos_order", array("grand_total" => $grand_total, 
							'subtotal' => $subtotal, 
							'total_discount' => $discount));
		return $total;
	}

	public function render_order(){
		$order_id = $this->input->post('order_id');
		echo $this->product_model->getCartOrder($order_id);
	}

	public function delete_cart(){
		$session = $this->session_user->user_visitors();
		$queryOrder = $this->db->get_where('pos_order', array('session_id' => $session))->row_array();
		$order_id = $queryOrder['order_id'];

		$product_id = $this->input->post('product_id');
		$this->db->delete('pos_order_detail', array('product_id' => $product_id,'order_id' => $order_id));

		$updateTotal = $this->get_total($order_id);
	
		echo json_encode(array('status' => 'ok','order_id' => $order_id));
	}

	public function checkout(){
		$user_id = $this->session_user->user_id();
		if (empty($user_id)) {
			redirect(base_url());
		}

		$data['query']  = $this->db->get_where('user', array('user_id' => $user_id))->row_array();

		$data['page'] = 'checkout';
		$data2['title'] = "Checkout | Gonam Aqiqah";
		$this->user_template->get_view($data,$data2);
	}

	public function get_cart(){
		$session = $this->session_user->user_visitors();

		$query = $this->db->get_where('pos_order', array('session_id' => $session,'order_status' => 'Temp'))->row_array();
		$order_id = $query['order_id'];
		$queryDetail = $this->db->get_where('pos_order_detail', array('order_id' => $order_id,'is_deleted' => 0))->num_rows();
		echo json_encode(array('status' => 'ok','data' => $queryDetail));
	}	

	public function cart_ok(){
			$phone = $this->input->post('phone');
	    	$date_deliver = $this->input->post('date_deliver');
	    	$time_deliver = $this->input->post('time_deliver');
	    	$provinsi_id = $this->input->post('provinsi_id');
	    	$kabupaten_id = $this->input->post('kabupaten_id');
	    	$kecamatan_id = $this->input->post('kecamatan_id');
	    	$address = $this->input->post('address');
	    	$information = $this->input->post('information');

	    	$user_id = $this->session_user->user_id();
	    	$session = $this->session_user->user_visitors();

	    	$getUser = $this->db->get_where('user', array('user_id' => $user_id))->row_array();
	    	$customer_id = $getUser['customer_id'];


	    	/*Fetching Data Order*/
	    	$getOrder = $this->db->get_where('pos_order', array('session_id' => $session))->row_array();
	    	$order_id = $getOrder['order_id'];

/*	    	var_dump($session);
	    	die();*/
	    	$this->db->where('customer_id',$customer_id);
	    	$query = $this->db->update('pos_customer', array('customer_phone' => $phone));

	    	if ($query) {
	    		$dataUpdate = array(
	    				'user_id' => $user_id,
				    	'date_deliver' => $date_deliver,
				    	'time_deliver' => $time_deliver,
				    	'provinsi_id' => $provinsi_id,
				    	'kabupaten_id' => $kabupaten_id,
				    	'kecamatan_id' => $kecamatan_id,
				    	'address' => $address,
				    	'information' => $information,
				    	'customer_id' => $customer_id,
				    	'order_status' => 'Pending',
				    	'session_id' => ''
	    			);

	    		$this->db->where('order_id',$order_id);
	    		$queryUpdate = $this->db->update('pos_order', $dataUpdate);
	    		if ($queryUpdate) {

	    			$this->db->join("pos_customer","pos_customer.customer_id = pos_order.customer_id","INNER");
			    	$getOrder = $this->db->get_where('pos_order', array('user_id' => $user_id))->row_array();
			    	$order_id = $getOrder['order_id'];
			    	$no_trx = $getOrder['no_trx'];

	    			$this->db->select('pos_order_detail.* , pos_product.product_name');
	    			$this->db->join('pos_product', 'pos_product.product_id = pos_order_detail.product_id','INNER');
	    			$qDetail = $this->db->get_where('pos_order_detail', array('order_id' => $order_id,'pos_order_detail.is_deleted' => 0));

	    			$tr = "";
	    			foreach ($qDetail->result_array() as $key => $value) {
	    				$tr .= '<tr>'
			    				.'<td style="padding: 10px;">'.$value['product_name'].'</td>'
			    				.'<td style="padding: 10px;">'.$value['order_qty'].'</td>'
			    				.'<td style="padding: 10px;">'.$value['sales_price'].'</td>'
			    				.'<td style="padding: 10px;">'.$value['subtotal'].'</td>'
	    				.'</tr>';
	    			}

	    			$subject = 'Gonam Aqiqah Pesanan Masuk';

	    			$message = '<!DOCTYPE html>
									<html>
									<head>
										<title></title>
									</head>
									<body>';
	    			$message .= '<table style="padding: 10px;">
									<tr>
										<td style="text-align: center;"><h4>Hay Admin Sepertinya Pesanan Baru Masuk</h4></td>
									</tr>
								</table>
								<table style="padding: 10px;">
									<tr>
										<td style="padding: 10px;">Nomor Pemesanan</td>
										<td style="padding: 10px;"> : </td>
										<td style="padding: 10px;">'.$getOrder['no_trx'].'</td>
									</tr>
									<tr>
										<td style="padding: 10px;">Nama Pemesan</td>
										<td style="padding: 10px;"> : </td>
										<td style="padding: 10px;">'.$getOrder['customer_name'].'</td>
									</tr>
									<tr>
										<td style="padding: 10px;">Nomor Telephone</td>
										<td style="padding: 10px;"> : </td>
										<td style="padding: 10px;">'.$getOrder['customer_phone'].'</td>
									</tr>
									<tr>
										<td style="padding: 10px;">Alamat</td>
										<td style="padding: 10px;"> : </td>
										<td style="padding: 10px;">'.$getOrder['address'].'</td>
									</tr>
								</table>
								<table style="padding: 10px;">
									<tr>
									<td style="padding: 10px;">
										Detail Pesanan
									</td></tr>
								</table>
								<table>
									<tr>
										<td style="padding: 10px;">Nama Produk</td>
										<td style="padding: 10px;">Jumlah</td>
										<td style="padding: 10px;">Harga</td>
										<td style="padding: 10px;">Total</td>
									</tr>
									'.$tr.'
								</table>

								<table>
									<tr>
										<td style="padding: 10px;">
										1. Segera hubungi pemesan sesuai dengan contact diatas<br>
										2. Untuk melihat detail silahkan menuju halaman admin<br>
										3. Anda akan dialihkan kehalaman Admin
										</td>
									</tr>
									<tr>
										<td style="padding: 10px;">
											<a href="'.base_url().'admin/pos/order'.$order_id.'">
											<button style="background-color: #249adb; padding:10px 20px; border:none; color:white; border-radius: 20px;">Selengkapnya</button>
											</a>
										</td>
									</tr>
								</table>';
						$message .= '</body></html>';

	    			$this->send_notif_order($subject,$message);

	    			echo json_encode(array('status' => 'ok','data' => array(
	    				'no_trx' => $no_trx
	    				)));
	    		}
	    	}

	    }

	    public function send_notif_order($subject, $message){



	    	$query = $this->db->get_where('config_notif', array('is_active' => 1,'notif_type' => 'email'))->result_array();

	    	foreach ($query as $key => $value) {
		    	/*Merubah Pesan menjadi html*/
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				/*close*/

	    		$to = $value['notif_target'];
				mail($to, $subject, $message,$headers);
	    	}


	    }

	    public function order(){
	    	$no_trx = $this->input->get('init');

	    	$user_id = $this->session_user->user_id();
	    	$this->db->join('pos_customer','pos_customer.customer_id = pos_order.customer_id','INNER');
	    	$query = $this->db->get_where("pos_order", array('no_trx' => $no_trx,'user_id' => $user_id))->row_array();

	    	$order_id = $query['order_id'];
	    	$this->db->join('pos_product','pos_product.product_id = pos_order_detail.product_id','INNER');
	    	$this->db->join('pos_unit','pos_product.unit_id = pos_unit.unit_id','INNER');
	    	$queryDetail = $this->db->get_where("pos_order_detail", array('order_id' => $order_id));

	    	$data['query_order'] = $query;
	    	$data['query_order_detail'] = $queryDetail;
	    	$data['page'] = 'order';
	    	$this->user_template->get_view($data);
	    }

	    public function cart(){
	    	$session = $this->session_user->user_visitors();

	    	$cart_num = $this->db->get_where('pos_order',array('session_id' => $session,'order_status' => 'Temp'));
	    	$data['cart_num'] = $cart_num->num_rows();
	    	$data['page'] = 'cart';

	    	$data2['title'] = "Keranjang Belanja | Gonam Aqiqah";
	    	$this->user_template->get_view($data,$data2);

	    }

	    public function get_cart_order(){
	    	$session 	= $this->session_user->user_visitors();
	    	$queryOrder = $this->db->get_where('pos_order', array('session_id' => $session));

	    	if ($queryOrder->num_rows() == 0) {
	    		die(json_encode(array('status' => 'failed')));
	    	}

	    	$rowOrder 	= $queryOrder->row_array();
	    	$order_id 	= $rowOrder['order_id'];
	    	echo $this->product_model->getCartOrder($order_id);
	    }
	    
	    public function check_login(){
	    	if (empty($this->session_user->user_id())) {
	    		
	    		$redirect = $this->input->post('redirect');
	    		$this->session->set_userdata('redirect',$redirect);

	    		die(json_encode(array('status' => 'ok',
	    								'data' => array('login' => 'required')
	    						)));
	    	}
	    	else{
	    		die(json_encode(array('status' => 'ok',
	    								'data' => array('login' => 'success')
	    						)));
	    	}
	    }
}
