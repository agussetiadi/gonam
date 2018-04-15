<?php 

/**
* 
*/
class Report_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function sales_rekap_render($dateStart,$dateEnd,$sortBy){


		$arrayGet = array("date_deliver >=" => $dateStart,
						'date_deliver <='=> $dateEnd,
						'pos_order.is_deleted' => 0,
						'pos_order.order_status' => 'Done'
						);

		$this->db->select("pos_order.* , pos_customer.customer_name");
		$this->db->join("pos_customer","pos_order.customer_id = pos_customer.customer_id","INNER");
		$this->db->order_by($sortBy,'ASC');
		$query = $this->db->get_where('pos_order', $arrayGet);


		$data = [];
		$jumlhItem = 0;
		$discount = 0;
		$grand_total = 0;
		$total_paid = 0;
		$jumlah_pesanan = $query->num_rows();

		$category_id = [];
		$orderQty = [];

		$getCategory = [];
		foreach ($query->result_array() as $key => $value) {
			$nested = [];

			/*$this->db->select_sum("order_qty");
			$query_sum = $this->db->get_where("pos_order_detail", ['order_id' => $value['order_id'],'pos_order_detail.is_deleted' => 0])->row_array();*/

			$this->db->join('pos_product','pos_product.product_id = pos_order_detail.product_id','INNER');
			$queryDetail = $this->db->get_where("pos_order_detail", ['order_id' => $value['order_id'],'pos_order_detail.is_deleted' => 0]);

			$query_sum = 0;
			foreach ($queryDetail->result_array() as $key2 => $value2) {
				$ci = $value2['category_id'];
				
				if (in_array($ci, $category_id)) {
					
					foreach ($getCategory as $key3 => $value3) {
						if ($key3 == $ci) {
							$getCategory[$ci] = $value3 + $value2['order_qty'];
						}

					}
				}
				else{
					$category_id[] = $ci;
					$getCategory[$ci] = intval($value2['order_qty']);
					
				}
				$query_sum += $value2['order_qty'];
			}

			$nested[] = $key + 1;
			$nested[] = $value['no_trx'];
			$nested[] = $value['date_deliver'];
			$nested[] = $value['customer_name'];
			$nested[] = $query_sum;
			$nested[] = $value['total_discount'];
			$nested[] = $value['subtotal'];
			$nested[] = $value['grand_total'];
			$nested[] = $value['total_paid'];
			

			$data[] = $nested;

			$jumlhItem += $query_sum; 
			$discount += $value['total_discount'];
			$grand_total += $value['grand_total'];
			$total_paid += $value['total_paid'];

		}

		$categoryName = [];
		foreach ($getCategory as $keyCategory => $valueCategory) {

			$queryCategory = $this->db->get_where('pos_category', array('category_id' => $keyCategory))->row_array();
			$categoryName[$queryCategory['category_name']] = $valueCategory;
		}


		return json_encode(array('status' => 'ok',
								'data' => $data,
								'total_item' => $jumlhItem,
								'category' => $categoryName,
								'total_order' => $jumlah_pesanan,
								'total_discount' => $discount,
								'grand_total' => $grand_total,
								'total_paid' => $total_paid,
								));

	}
	public function sales_detail_render($dateStart,$dateEnd,$sortBy){


		$arrayGet = array("date_deliver >=" => $dateStart,
							'date_deliver <='=> $dateEnd,
							'pos_order.order_status' => 'Done',
							'pos_order.is_deleted' => 0);

		$this->db->select("pos_order.* , pos_customer.customer_name");
		$this->db->join("pos_customer","pos_order.customer_id = pos_customer.customer_id","INNER");
		$this->db->order_by($sortBy,'ASC');
		$query = $this->db->get_where('pos_order', $arrayGet);


		$data = [];
		$jumlhItem = 0;
		$discount = 0;
		$grand_total = 0;
		$total_paid = 0;
		$jumlah_pesanan = $query->num_rows();
		$getCategory = [];
		$category_id = [];
		foreach ($query->result_array() as $key => $value) {
			$nested = [];


			$detail = '<table class="table">';
			$detail .= '<th>Product</th><th>Qty</th><th>Harga Jual</th><th>HPP</th>';

			$this->db->select("pos_order_detail.*, pos_product.product_name , pos_category.category_id");
			$this->db->join("pos_product","pos_product.product_id = pos_order_detail.product_id","INNER");
			$this->db->join("pos_category","pos_category.category_id = pos_product.category_id","LEFT");
			$queryDetail = $this->db->get_where("pos_order_detail", array("order_id" => $value['order_id']));

			foreach ($queryDetail->result_array() as $key2 => $value2) {
				$ci = $value2['category_id'];
				if (in_array($ci, $category_id)) {
					
					foreach ($getCategory as $key3 => $value3) {
						if ($key3 == $ci) {
							$getCategory[$ci] = $value3 + $value2['order_qty'];
						}

					}
				}
				else{
					$category_id[] = $ci;
					$getCategory[$ci] = intval($value2['order_qty']);
					
				}


				$detail .= '<tr>';
				$detail .= '<td>';
				$detail .= $value2['product_name'];
				$detail .= '</td>';

				$detail .= '<td>';
				$detail .= $value2['order_qty'];
				$detail .= '</td>';

				$detail .= '<td>';
				$detail .= $value2['sales_price'];
				$detail .= '</td>';

				$detail .= '<td>';
				$detail .= $value2['sales_hpp'];
				$detail .= '</td>';

				$detail .= '</tr>';
			}

			$detail .= '</table>';

			$nested[] = $key + 1;
			$nested[] = $value['no_trx'];
			$nested[] = $value['date_deliver'];
			$nested[] = $value['customer_name'];
			$nested[] = $detail;
			$nested[] = $value['grand_total'];
			$nested[] = $value['total_paid'];
			

			$data[] = $nested;

			$discount += $value['total_discount'];
			$grand_total += $value['grand_total'];
			$total_paid += $value['total_paid'];

		}

		$categoryName = [];
		foreach ($getCategory as $keyCategory => $valueCategory) {

			$queryCategory = $this->db->get_where('pos_category', array('category_id' => $keyCategory))->row_array();
			$categoryName[$queryCategory['category_name']] = $valueCategory;
		}

		return json_encode(array('status' => 'ok',
								'data' => $data,
								'total_order' => $jumlah_pesanan,
								'category' => $categoryName,
								'total_discount' => $discount,
								'grand_total' => $grand_total,
								'total_paid' => $total_paid,
								));

	}


	public function sales_harian_render($dateStart,$dateEnd){


		$arrayGet = array("date_deliver >=" => $dateStart,
						'date_deliver <='=> $dateEnd,
						'pos_order.order_status' => 'Done',
						'pos_order.is_deleted' => 0);


		$this->db->group_by("date_deliver");
		$query = $this->db->get_where('pos_order', $arrayGet);
		$data = [];

		$num_item = 0;
		$num_order = 0;
		$num_trx = 0;
		$num_paid = 0;

		foreach ($query->result_array() as $key => $value) {
			$nested = [];

			$query2 = $this->db->get_where("pos_order", array('date_deliver' => $value['date_deliver'],'is_deleted' => 0,'pos_order.order_status' => 'Done'));
		
			$itemTerjual = 0;
			$jumlahTransaksi = 0;
			$totalTransaksi = 0;
			$totalBayar = 0;

			foreach ($query2->result_array() as $key2 => $value2) {
				$this->db->select_sum("order_qty");
				$query3 = $this->db->get_where("pos_order_detail", array('order_id' => $value2['order_id'],'is_deleted' => 0))->row_array();

				$itemTerjual += $query3['order_qty'];
				$jumlahTransaksi = $query2->num_rows();
				$totalTransaksi += $value2['grand_total'];
				$totalBayar += $value2['total_paid'];
			}

			$nested[] = $value['date_deliver'];
			$nested[] = $itemTerjual;
			$nested[] = $jumlahTransaksi;
			$nested[] = $totalTransaksi;
			$nested[] = $totalBayar;

			$num_item += $itemTerjual;
			$num_order += $jumlahTransaksi ;
			$num_trx += $totalTransaksi;
			$num_paid += $totalBayar;

			$data[] = $nested;

		}

		return json_encode(array('status' => 'ok',
								'data' => $data,
								'num_item' => $num_item,
								'num_order' => $num_order,
								'num_trx' => $num_trx,
								'num_paid' => $num_paid));

	}

	public function pembelian_rekap_render($dateStart,$dateEnd,$sortBy){
		$arrayGet = array("date_trx >=" => $dateStart,
				'date_trx <='=> $dateEnd,
				'pembelian.is_deleted' => 0,
				'pembelian.status' => 'Done'
				);


		$this->db->select("pembelian.* , supplier.supplier_name");
		$this->db->order_by($sortBy,'ASC');
		$this->db->join("supplier","pembelian.supplier_id = supplier.supplier_id","INNER");
		$query = $this->db->get_where('pembelian', $arrayGet);


		$data = [];
		$jumlhItem = 0;

		$total = 0;
		$total_paid = 0;
		$jumlah_pesanan = $query->num_rows();
		foreach ($query->result_array() as $key => $value) {
			$nested = [];

			$this->db->select_sum("jumlah_barang");
			$query_sum = $this->db->get_where("pembelian_detail", ['pembelian_id' => $value['pembelian_id'],'pembelian_detail.is_deleted' => 0])->row_array();

			$nested[] = $value['no_pembelian'];
			$nested[] = $value['no_terima'];
			$nested[] = $value['supplier_name'];
			$nested[] = $value['total'];
			$nested[] = $value['total_paid'];
			$nested[] = $value['date_trx'];
			$nested[] = $value['created_by'];
			

			$data[] = $nested;

			$jumlhItem += $query_sum['jumlah_barang']; 
			
			$total += $value['total'];
			$total_paid += $value['total_paid'];

		}

		return json_encode(array('status' => 'ok',
								'data' => $data,
								'total_item' => $jumlhItem,
								'total' => $total,
								'total_paid' => $total_paid,
								));
	}


	public function pembelian_detail_render($dateStart,$dateEnd,$sortBy){
		$arrayGet = array("date_trx >=" => $dateStart,
				'date_trx <='=> $dateEnd,
				'pembelian.is_deleted' => 0,
				'pembelian.status' => 'Done'
				);


		$this->db->select("pembelian.* , supplier.supplier_name");
		$this->db->order_by($sortBy,'ASC');
		$this->db->join("supplier","pembelian.supplier_id = supplier.supplier_id","INNER");
		$query = $this->db->get_where('pembelian', $arrayGet);


		$data = [];
		$jumlhItem = 0;

		$total = 0;
		$total_paid = 0;
		$jumlah_pesanan = $query->num_rows();
		foreach ($query->result_array() as $key => $value) {
			$nested = [];

			$queryDetail = $this->db->get_where("pembelian_detail", ['pembelian_id' => $value['pembelian_id'],'pembelian_detail.is_deleted' => 0]);

			 $query_sum = $queryDetail->row_array();

			$detail = '<table class="table">';
			$detail .= '<th>Product</th><th>Qty</th><th>Satuan</th><th>Harga Beli</th>';

			foreach ($queryDetail->result_array() as $key2 => $value2) {
				$detail .= '<tr>';
				$detail .= '<td>';
				$detail .= $value2['nama_barang'];
				$detail .= '</td>';

				$detail .= '<td>';
				$detail .= $value2['jumlah_barang'];
				$detail .= '</td>';

				$detail .= '<td>';
				$detail .= $value2['satuan_barang'];
				$detail .= '</td>';

				$detail .= '<td>';
				$detail .= $value2['harga_barang'];
				$detail .= '</td>';

				$detail .= '</tr>';
			}
			$detail .= '</table>';


			$nested[] = $value['no_pembelian'];
			$nested[] = $value['supplier_name'];
			$nested[] = $detail;
			$nested[] = $value['total'];
			$nested[] = $value['total_paid'];
			$nested[] = $value['date_trx'];
			$nested[] = $value['created_by'];
			

			$data[] = $nested;

			$jumlhItem += $query_sum['jumlah_barang']; 
			
			$total += $value['total'];
			$total_paid += $value['total_paid'];

		}

		return json_encode(array('status' => 'ok',
								'data' => $data,
								'total_item' => $jumlhItem,
								'total' => $total,
								'total_paid' => $total_paid,
								));
	}


}