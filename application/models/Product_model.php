<?php 

/**
* 
*/
class Product_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getCartOrder($order_id){

		

		$queryOrder = $this->db->get_where("pos_order", array('order_id' => $order_id,'order_status' => 'Temp'))->row_array();
		
		$this->db->join("pos_product","pos_product.product_id = pos_order_detail.product_id","INNER");
		$queryOrderDetail = $this->db->get_where("pos_order_detail", array('order_id' => $order_id))->result_array();

		$dataDetail = [];
		foreach ($queryOrderDetail as $key => $value) {
			$dataDetail[] = array(
					'product_id' => $value['product_id'],
					'product_name' => $value['product_name'],
					'product_picture' => image_exists("assets/img/post_img/",$value['product_picture']),
					'product_info' => $value['product_info'],
					'masakan' => $value['masakan'],
					'order_qty' => $value['order_qty'],
					'sales_price' => $value['sales_price'],
					'total' => $value['total']
				);
		}

		$dataObj = array('order' => $queryOrder,
						'order_detail' => $dataDetail
						);

		return json_encode(array('status' => 'ok', 'data' => $dataObj));
	}
}