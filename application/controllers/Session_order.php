<?php 


/**
* 
*/
class Session_order extends CI_controller
{
	
	public function __construct(){
		parent::__construct();
		$this->load->model("product_model");
		$result = $this->get_order();
		return $result;
	}

	#session order
	public function session_order(){
		#Jika Tidak Ada sesi maka buat sesi dengan session_id()
		#JIka sudah ada sesi maka gunakan sesi yang ada
		if (empty($_SESSION['sesi'])) {
			$_SESSION['sesi'] = session_id();
			$sesi = $_SESSION['sesi'];
		}
		else{
			$sesi = $_SESSION['sesi'];
		}

		return $sesi;
	}

	protected function get_order(){
		$sesi = $this->session_order();
		$query_sess = $this->product_model->get_product_session(array('session_id' => $sesi));
		$order_id = $query_sess['order_id'];
		$query1 = $this->product_model->join_order1($order_id);
		return $query1;
	}


}

?>