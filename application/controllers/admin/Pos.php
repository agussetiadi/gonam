<?php 

/**
* 
*/
class Pos extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");
		$this->load->model("admin/pos_model");
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index(){
		$data['page'] = 'admin/pos';
		$this->template->get_view($data);
	}

	public function order($order_id = NULL){
	
		$data['query_product'] = $this->db->get_where("pos_product", array("is_deleted" => 0))->result_array();
		$data['page'] = 'admin/order';
		$data['order_id'] = $order_id;
		$this->template->get_view($data);
	}

	public function load_customer(){
		echo $this->pos_model->load_customer();

	}

	public function add_customer(){
			$data['customer_name'] 	= $this->input->post("customer_name");
			$data['customer_phone'] 	= str_replace(" ", "", $this->input->post("customer_phone"));
			$data['customer_address'] 	= $this->input->post("customer_address");

			$msg_success = array('action' => 'refresh');
			
		
			$required =  array("Nama Pelanggan" => $data['customer_name']);

			/*
			Validasi input
			*/
			foreach ($required as $key => $value) {
				if (empty($value)) {
					$set_required[] = $key;
				}
			}

			if (!empty($set_required)) {
				$msg_validate = array('msg' => 'Validate', 'required' =>  array($set_required));
				echo json_encode($msg_validate);
			}
			else{

				$this->db->order_by("customer_id","DESC");
				$q_code = $this->db->get('pos_customer',1,0)->row_array();
				$data['customer_code'] = "PLG-".intval($q_code['customer_id'] + 1);

				$data['created_by'] = $this->session_admin->admin_name();
				$data['created'] = date("Y-m-d");
				$query = $this->db->insert("pos_customer", $data);
				if ($query) {
					echo json_encode($msg_success);
				}

			}
	}


	public function add_product(){
		$order_id	 	= $this->input->post("order_id");
		$product_id	 	= $this->input->post("product_id");
		$masakan 		= $this->input->post("masakan");
		$order_qty 		= $this->input->post("order_qty");
		$sales_price 	= $this->input->post("sales_price");
		$discount 		= $this->input->post("discount");
		
		$nama_anak 		= $this->input->post("nama_anak");
		$tanggal_lahir 	= $this->input->post("tanggal_lahir");
		$nama_ortu 		= $this->input->post("nama_ortu");
		$kemas 			= $this->input->post("kemas");

		$validate  = validate_form(['Produk' => $product_id,
									'Harga' => $sales_price,
									'Jumlah' => $order_qty
									]);
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required','data' => $validate)));
		}

		$getProduct = $this->db->get_where("pos_product", array("product_id" => $product_id)) -> row_array();
		


		$total_discount = $discount * $order_qty;
		$sales_hpp = $getProduct['product_hpp'];

		$subtotal = $order_qty * $sales_price;
		$total = $order_qty * ($sales_price - $discount);

		$product_hits = $getProduct['product_hits'] + 1;


		/*Generate No TRX*/

		if (empty($order_id)) {
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
									'order_status' => 'Pending');
			$this->db->insert("pos_order", $arrayInsertOrder);
		}


		$arrayDetail = array("order_id"=>$order_id,
							"product_id"=>$product_id,
							"masakan"=>$masakan,
							"order_qty"=>$order_qty,
							"sales_price"=>$sales_price,
							"discount"=>$discount,
							"discount_total"=>$total_discount,
							"sales_hpp"=>$sales_hpp,
							"subtotal"=>$subtotal,
							"total"=>$total,
							"nama_anak"=>$nama_anak,
							"tanggal_lahir"=>$tanggal_lahir,
							"nama_ortu"=>$nama_ortu,
							"kemas"=>$kemas
							);
		$queryInsert = $this->db->insert("pos_order_detail", $arrayDetail);
		if ($queryInsert) {
			$this->db->where('product_id' ,$product_id);
			$this->db->update("pos_product", array('product_hits' => $product_hits));

			$total = $this->get_total($order_id);
			echo json_encode(array('status' => 'ok', 'order_id' => $order_id,'total' => $total));
		}


	}


	public function update_product(){

		$order_detail_id= $this->input->post("order_detail_id");
		$order_id	 	= $this->input->post("order_id");
		$product_id	 	= $this->input->post("product_id");
		$masakan 		= $this->input->post("masakan");
		$order_qty 		= $this->input->post("order_qty");
		$sales_price 	= $this->input->post("sales_price");
		$discount 		= $this->input->post("discount");
		$nama_anak 		= $this->input->post("nama_anak");
		$tanggal_lahir 	= $this->input->post("tanggal_lahir");
		$nama_ortu 		= $this->input->post("nama_ortu");
		$kemas 			= $this->input->post("kemas");


		$getProduct = $this->db->get_where("pos_product", array("product_id" => $product_id)) -> row_array();


		
		$sales_hpp = $getProduct['product_hpp'];
		
		$total_discount = $discount * $order_qty;
		$subtotal = $order_qty * $sales_price;
		$total = $order_qty * $sales_price - $total_discount;


		$arrayDetail = array("product_id"=>$product_id,
							"masakan"=>$masakan,
							"order_qty"=>$order_qty,
							"sales_price"=>$sales_price,
							"discount"=>$discount,
							"discount_total"=>$total_discount,
							"sales_hpp"=>$sales_hpp,
							"subtotal"=>$subtotal,
							"total"=>$total,
							"nama_anak"=>$nama_anak,
							"tanggal_lahir"=>$tanggal_lahir,
							"nama_ortu"=>$nama_ortu,
							"kemas"=>$kemas
							);
		$this->db->where("order_detail_id",$order_detail_id);
		$queryUpdate = $this->db->update("pos_order_detail", $arrayDetail);
		if ($queryUpdate) {
			$total = $this->get_total($order_id);
			echo json_encode(array('status' => 'ok','total' => $total));
		}


	}


	public function render_customer(){
		$customer_id = $this->input->post("customer_id");
		$query = $this->db->get_where("pos_customer", array("customer_id" => $customer_id));
		$rowData = $query->row_array();
		if ($query->num_rows() > 0) {
			$arrayData = array("status" => 'success','data' => $rowData);
		}
		else{
			$arrayData = array("status" => 'failed');	
		}
		echo json_encode($arrayData);
	}

	public function select_product(){
		$product_id = $this->input->post("product_id");
		$query = $this->db->get_where("pos_product", array('product_id' => $product_id))->row_array();
		$jsonData = array(
			"status" => 'ok', 
			'masakan' => $query['product_menu'],
			'sales_price' => $query['product_price'],
			'discount' => 0);
		echo json_encode($jsonData);
	}
	
	public function render_detail_order(){
		$order_id = $this->input->post("order_id");
		$this->db->select("pos_order_detail.* , pos_product.product_name, pos_unit.unit_name");
		$this->db->join("pos_product", "pos_product.product_id = pos_order_detail.product_id","LEFT");
		$this->db->join("pos_unit", "pos_unit.unit_id = pos_product.unit_id","LEFT");
		$query = $this->db->get_where("pos_order_detail", array("order_id" => $order_id,"pos_order_detail.is_deleted" => 0))->result_array();

		$data = [];
		foreach ($query as $key => $value) {
			$i = $key + 1;
			$nested = [];

			$btn = '<button class="btnOrderView btn btn-sm btn-info" data-value="'.$value['order_detail_id'].'"><span class="fa fa-eye"></span></button> ';
			$btn .= '<button class="btnOrderEdit btn btn-sm btn-primary" data-value="'.$value['order_detail_id'].'"><span class="fa fa-pencil"></span></button> ';
			$btn .= '<button class="btnOrderDelete btn btn-sm btn-danger" data-value="'.$value['order_detail_id'].'"><span class="fa fa-trash"></span></button>';

			$nested[] = $i;
			$nested[] = $value['product_name'];
			$nested[] = $value['order_qty'];
			$nested[] = $value['unit_name'];
			$nested[] = number_format($value['sales_price']);
			$nested[] = number_format($value['discount']);
			$nested[] = number_format($value['total']);
			$nested[] = $btn;
			
			$data[] = $nested;
		}

		echo json_encode(array('status' =>'ok', 'data' => $data));


	}
	public function delete_order_detail(){
		$order_id = $this->input->post("order_id");
		$order_detail_id = $this->input->post("order_detail_id");
		$this->db->where("order_detail_id",$order_detail_id);
		$queryUpdate = $this->db->update("pos_order_detail", array("is_deleted" => 1));

		if ($queryUpdate) {
			$total = $this->get_total($order_id);
			echo json_encode(array("status" => "ok",'total' => $total));
		}

	}

	public function edit_order_detail(){
		$order_detail_id = $this->input->post("order_detail_id");
		$queryGetDetail = $this->db->get_where("pos_order_detail", array("order_detail_id" => $order_detail_id))->row_array();

		echo json_encode(array('status' => 'ok', 'data' => $queryGetDetail));

	}

	public function get_detail_order(){
		$order_detail_id = $this->input->post("order_detail_id");
		$this->db->select("pos_order_detail.* , pos_product.product_name");
		$this->db->join("pos_product", "pos_product.product_id = pos_order_detail.product_id","LEFT");
		$query = $this->db->get_where("pos_order_detail", array("order_detail_id" => $order_detail_id)) -> row_array();
		echo json_encode(array("status" => 'ok','data' => $query));

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

	public function save_order(){
		$order_id 	= $this->input->post('order_id');
		$dataUpdate['pemotongan'] 	= $this->input->post('pemotongan');
		$dataUpdate['kakikulit'] 	= $this->input->post('kakikulit');
		$dataUpdate['buku_risalah'] = $this->input->post('buku_risalah');
		$dataUpdate['customer_id'] 	= $this->input->post('customer_id');
		$dataUpdate['date_deliver'] = $this->input->post('date_deliver');
		$dataUpdate['time_deliver'] = $this->input->post('time_deliver');
		$dataUpdate['provinsi_id'] 	= $this->input->post('provinsi_id');
		$dataUpdate['kabupaten_id'] = $this->input->post('kabupaten_id');
		$dataUpdate['kecamatan_id'] = $this->input->post('kecamatan_id');
		$dataUpdate['address'] 		= $this->input->post('address');
		$dataUpdate['total_paid'] 	= $this->input->post('total_paid');
		$dataUpdate['information'] 	= $this->input->post('information');
		$dataUpdate['order_status'] 	= "Done";

		$dataUpdate['date_created'] 	= $dataUpdate['date_deliver'];
		
		$dataUpdate['created_by'] 	= $this->session->userdata("admin_name");

			$queryOrder = $this->db->get_where("pos_order", array("order_id" => $order_id))->row_array();
			if ($dataUpdate['total_paid']  >= $queryOrder['grand_total']) {
				$dataUpdate['paid_off'] = 1;
			}
			else{
				$dataUpdate['paid_off'] = 0;	
			}


		$this->db->where("order_id",$order_id);
		$query = $this->db->update("pos_order", $dataUpdate);

		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}
	public function print_order($order_id){
		if (empty($this->session->userdata("admin_id"))) {
			die("Access Denied!!");
		}
		$this->db->join("pos_customer","pos_customer.customer_id = pos_order.customer_id","INNER");
		$data['query1'] = $this->db->get_where("pos_order", array("order_id" => $order_id))->row_array();
		
		$this->db->select("pos_order_detail.* , pos_product.product_name, pos_unit.unit_name");
		$this->db->join("pos_product", "pos_product.product_id = pos_order_detail.product_id","LEFT");
		$this->db->join("pos_unit", "pos_unit.unit_id = pos_product.unit_id","LEFT");
		$data['query2'] = $this->db->get_where("pos_order_detail", array('order_id' => $order_id,"pos_order_detail.is_deleted" => 0));
		$this->load->view("admin/print_order",$data);
	}

	public function render_order(){
		echo $this->pos_model->render_order();
	}
	public function print_filtered_order(){
		$filter1 = $this->input->get("search");
		$filter2 = $this->input->get("order_status");
		$filter3 = $this->input->get("paid_off");
		$filter4 = $this->input->get("date_deliver");
		$filter5 = $this->input->get("date_deliver2");

		if ($filter2 == '1') {
			$filter2 = "Lunas";
		}
		elseif ($filter2 == '0') {
			$filter2 = 'Belum Lunas';
		}
		else{
			$filter2 = "Tampilkan Semua";	
		}




		$data = array('filter1' => $filter1 , 'filter2' => $filter2, 'filter3' => $filter3, 'filter4' => $filter4,'filter5' => $filter5);

		$result = $this->pos_model->print_flitered_order();
		$query = $result['query'];

		$paid_off = array();
		$queryDetail = array();

		$pi = [];
		$product_id = [];
		$getProduct = [];
		foreach ($query as $key => $value) {
			if ($value['paid_off'] == 1) {
				$paid_off[$key] = 'Lunas';
			}
			else{
				$paid_off[$key] = 'Belum Lunas';	
			}

			$order_id = $value['order_id'];

			$this->db->select("pos_order_detail.* , pos_product.product_name, pos_unit.unit_name");
			$this->db->join("pos_product", "pos_product.product_id = pos_order_detail.product_id","LEFT");
			$this->db->join("pos_unit", "pos_unit.unit_id = pos_product.unit_id","LEFT");
			$qDetail =  $this->db->get_where("pos_order_detail",array('order_id' => $order_id ));


			$queryDetail[] = $qDetail->result_array();

			foreach ($qDetail->result_array() as $key2 => $value2) {
				$pi = $value2['product_id'];
				
				if (in_array($pi, $product_id)) {
					
					foreach ($getProduct as $key3 => $value3) {
						if ($key3 == $pi) {
							$getProduct[$pi] = $value3 + $value2['order_qty'];
						}

					}
				}
				else{
					$product_id[] = $pi;
					$getProduct[$pi] = intval($value2['order_qty']);
					
				}
			}



		}

		$productName = [];
		foreach ($getProduct as $keyProduct => $valueProduct) {
			$this->db->select("pos_product.product_name, pos_unit.unit_name");
			$this->db->join("pos_unit", "pos_unit.unit_id = pos_product.unit_id","LEFT");
			$queryProduct = $this->db->get_where('pos_product', array('product_id' => $keyProduct))->row_array();
			$productName[$queryProduct['product_name']] = $valueProduct." ".$queryProduct['unit_name'];
		}


		$data['query_detail'] = $queryDetail;

		$data['product_total'] = $productName;

		$data['paid_off'] = $paid_off;
		$data['query'] = $query;
		$data['totalFiltered'] = $result['totalFiltered'];

		$this->load->view('admin/print_filtered_order',$data);
	}

	public function get_render_order(){
		$order_id = $this->input->post("order_id");
		$query = $this->db->get_where("pos_order",array("order_id" => $order_id))->row_array();
		echo json_encode(array("status" => 'ok','data'=>$query));
	}

	public function delete_order($order_id){
		$this->db->where("order_id",$order_id);
		$query = $this->db->update("pos_order", array("is_deleted" => 1));
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function save_to_blog(){
		$order_id 	= $this->input->post("order_id");
		$this->db->select("pos_order.* , provinsi.nama_provinsi , kabupaten.nama_kabupaten , kecamatan.nama_kecamatan, pos_customer.customer_name");
		$this->db->join("pos_customer","pos_order.customer_id = pos_customer.customer_id","INNER");
		$this->db->join("provinsi","provinsi.provinsi_id = pos_order.provinsi_id","LEFT");
		$this->db->join("kabupaten","kabupaten.kabupaten_id = pos_order.kabupaten_id","LEFT");
		$this->db->join("kecamatan","kecamatan.kecamatan_id = pos_order.kecamatan_id","LEFT");
		$query = $this->db->get_where("pos_order", array("pos_order.order_id" => $order_id))->row_array();



		$this->db->select("pos_order_detail.* , pos_product.product_name, pos_unit.unit_name");
		$this->db->join("pos_product", "pos_product.product_id = pos_order_detail.product_id","LEFT");
		$this->db->join("pos_unit", "pos_unit.unit_id = pos_product.unit_id","LEFT");
		$query2 = $this->db->get_where("pos_order_detail",array('order_id' => $order_id));
		$pesanan = "";
		foreach ($query2->result_array() as $key => $value) {
			$pesanan .= $value['product_name']." ".$value['order_qty']." ".$value['unit_name'].", ";
		}
		$sdr = $query['customer_name'];
		$kec = $query['nama_kecamatan'];
		$kab = $query['nama_kabupaten'];
		$pkt = $pesanan;
		$description = $this->post_order_template($sdr,$pkt,$kec,$kab);
		$title = $this->post_meta_title($kec,$kab);
		$hastag = $this->post_hastag($kec,$kab);
		$meta_des = $this->post_meta_description($kec,$kab);


		$saveBlog = $this->pos_model->save_to_blog($title, $hastag, $meta_des, $description);


		echo json_encode(array('status' => 'ok', 'slug' => $saveBlog['blog_slug']));
	}

	public function post_order_template($sdr,$pkt,$kec,$kab){
		$kab = ucwords(strtolower($kab));
		$kec = ucwords(strtolower($kec));

		$text = '<h2>Aqiqah '.$kec.' '.$kab.'</h2><br><p>Terima kasih kepada saudara '.$sdr.' telah memesan '.$pkt.' semoga menjadi berkah bagi kita semua, <br>pesanan di kirim ke daerah '.$kec.', '.$kab.'.<br><p>Bagi anda yang berada di '.$kec.' dan sedang mencari layanan untuk acara Aqiqah, atau anda sedang mencari jasa kambing guling atau nasi box untuk catering, anda datang di tempat yang tepat, Gonam Aqiqah siap melayani dengan sepenuh hati, harga yang kami tawarkan dijamin lebih hemat karena :</p><ul><li>Tidak ada biaya tambahan<br></li><li>Gratis biaya antar sampai dilokasi<br></li><li>Gratis biaya masak</li><li>Gratis biaya pemotongan</li><li>Menu masakan bervariasi</li><li>Gratis Buku risalah dan sertifikat<br></li></ul><h3 style="visibility: visible; transform: translateY(0px) scale(1); opacity: 1; transition: transform 1.2s cubic-bezier(0.6, 0.2, 0.1, 1) 0s, opacity 1.2s cubic-bezier(0.6, 0.2, 0.1, 1) 0s;">Pemesanan Aqiqah Di Daerah '.$kec.' '.$kab.'</h3><p>Harga yang tertera di website adalah harga resmi dan terupdate, anda 
			bisa langsung memesan di website atau bisa juga menghubungi (Roni Hidayat) di 
			nomor 0852 8978 1700 <a href="tel:085289781700">TELP</a> / <a href="https://api.whatsapp.com/send?phone=6285289781700&amp;text=Tuliskan%20Pesan%20Anda">WA</a></p><p><br></p><p>Gonam Aqiqah berdiri sebagai sebuah usaha yang bergerak di 
			bidang jasa olahan daging kambing/domba seperti Aqiqah, Qurban, Kambing 
			Guling, Nasi Box dll. Fokus kami adalah memberikan pelayanan yang 
			terbaik untuk para pelanggan.
			Untuk saat ini pelayanan aqiqah kami telah tersebar di beberapa 
			kota besar seperti Jakarta, Bogor, '.$kec.' '.$kab.', Tangerang dan Bekasi.</p><p><br></p><blockquote><p><span class="footer-text-content">Baca Testimoni Pelanggan Kami <a href="https://www.gonamaqiqah.com/testimoni/">Disini</a><br></span></p></blockquote><h3>Jual Kambing Aqiqah di '.$kec.' '.$kab.'</h3><h2><span class="footer-text-content"><br></span></h2><h3><br></h3><h3>Daftar Harga Paket Aqiqah Di '.$kec.' '.$kab.' dan Sekitarnya</h3></p>';

		return $text;
	}

	public function post_meta_title($kec,$kab){
		$kec = ucwords(strtolower($kec));
		$kab = ucwords(strtolower($kab));
		$text = 'Jasa Layanan Paket Aqiqah '.$kec.' '.$kab.'';
		$text = ucwords($text);
		return $text;
	}

	public function post_hastag($kec, $kab){
		$kec = strtolower($kec);
		$kab = strtolower($kab);
		$text = 'aqiqah '.$kec.' '.$kab.', aqiqah di '.$kec.' '.$kab.' murah, jual paket aqiqah daerah '.$kec.' '.$kab.'';
		return $text;
	}
	public function post_meta_description($kec, $kab){
		$kec = ucwords(strtolower($kec));
		$kab = ucwords(strtolower($kab));
		$text = 'Tempat dan jasa aqiqah di '.$kec.' '.$kab.' , pelayanan profesional masakan variatif harga hemat gratis biaya potong masak pengiriman';
		return $text;
	}


}