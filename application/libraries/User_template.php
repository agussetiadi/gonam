<?php 
/**
* 
*/
class User_template extends CI_model
{
	
	function __construct()
	{
		//$this->load->model("product_model");
		//$this->load->model("user_model");
		$this->load->library('session_user');
	}

	public function get_view($data,$dataHeader = NULL){

		if (empty($dataHeader['template_meta_des'])) {	
			$dataHeader['template_meta_des'] = "Jasa layanan aqiqah, qurban, kambing guling dan catering profesional di jakarta bogor depok tangerang";
		}
		if (empty($dataHeader['title'])) {
			$dataHeader['title'] = "Gonam Sentra Aqiqah";
		}


	
		$session_user = $this->session_user->user_id();
		if (empty($session_user)) {
			$dataHeader['numCart'] = 0;			
		}
		else{
			$orderQ = $this->db->get_where('pos_order', array('session_id' => $session_user))->row_array();
			$dataHeader['numCart'] = $this->db->get_where('pos_order_detail', array('order_id' => $orderQ['order_id']))->num_rows();
		}

		$this->load->view("header", $dataHeader);
		$this->load->view("body", $data);
		$this->load->view("footer");
	}

	public function get_view_2($data,$dataHeader = NULL){

		if (empty($dataHeader['template_meta_des'])) {	
			$dataHeader['template_meta_des'] = "Jasa layanan aqiqah, qurban, kambing guling dan catering profesional di jakarta bogor depok tangerang";
		}
		if (empty($dataHeader['title'])) {
			$dataHeader['title'] = "Gonam Sentra Aqiqah";
		}


	
		$session_user = $this->session_user->user_id();
		if (empty($session_user)) {
			$dataHeader['numCart'] = 0;			
		}
		else{
			$orderQ = $this->db->get_where('pos_order', array('session_id' => $session_user))->row_array();
			$dataHeader['numCart'] = $this->db->get_where('pos_order_detail', array('order_id' => $orderQ['order_id']))->num_rows();
		}

		$this->get_visitors();

		$this->load->view("header", $dataHeader);
		$this->load->view("body2", $data);
		$this->load->view("footer");
	}

	public function get_visitors(){
	    if (isset($_SERVER['HTTP_CLIENT_IP'])){
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    }
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else if(isset($_SERVER['HTTP_X_FORWARDED'])){
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    }
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    }
	    else if(isset($_SERVER['HTTP_FORWARDED'])){
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    }
	    else if(isset($_SERVER['REMOTE_ADDR'])){
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    }
	    else{
        	$ipaddress = 'Unknow';
    	}
	 		

	 	if(!empty($_SERVER['HTTP_USER_AGENT'] )){
	 		$browser = $_SERVER['HTTP_USER_AGENT'];
	 	}
	 	else{
	 		$browser = "Unknow";	
	 	}

	 	if (!empty($_SERVER['REQUEST_URI'])) {
	 		$a_page = $_SERVER['REQUEST_URI'];
	 	}
	 	else{
	 		$a_page = "Unknow";
	 	}


	 	$data = array('activity_ip' => $ipaddress,
	 					'activity_link' => $a_page,
	 					'activity_browser' => $browser,
	 					'activity_date' => date("Y-m-d"),
	 					'activity_time' => date("H:i:s")
	 					);
	 	$query = $this->db->insert("activity", $data);
	 	if ($query) {
	 		return true;
	 	}
	}
}

?>