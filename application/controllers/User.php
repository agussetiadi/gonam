<?php 


/**
* 
*/
class User extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("product_model");
		$this->load->library("form_validation");
		
		$this->load->library("user_template");
		if (empty($this->session_user->user_id())) {
			die("no access");
		}
	}
	public function index(){
		redirect(base_url());
	}

	public function saran(){
		
		$user_id = $this->session->userdata("user");
		$query = $this->user_model->get_where("user",array('user_id' => $user_id))->row_array();
		$data['provider'] = $query['provider'];

		if ($this->input->post("ajax_request")) {
			echo $this->load->view("saran", $data, TRUE);
		}
		else{
		$data['page'] = "user";
		$data['user_content'] = $this->load->view("saran", $data, TRUE);
		$this->user_template->get_view($data);
		}		
	}

	public function notif(){
		$data['num_notif'] = $this->num_notif();
		$user_id = $this->session->userdata("user");

		$this->user_model->order_by("notif_user_date","DESC");
		$this->user_model->order_by("notif_user_time","DESC");
		$query_notif = $this->user_model->get_where("notif_user", array('user_id' => $user_id));
		$data['query'] = $query_notif;


		$user_id = $this->session->userdata("user");
		$query = $this->user_model->get_where("user",array('user_id' => $user_id))->row_array();
		$data['provider'] = $query['provider'];
		if ($this->input->post("ajax_request")) {
			echo $this->load->view("notif", $data, TRUE);
		}
		else{
		$data['page'] = "user";
		$data['user_content'] = $this->load->view("notif", $data, TRUE);
		$this->user_template->get_view($data);
		}
	}

	public function profile($param = NULL){
		$data['num_notif'] = $this->num_notif();
		$user_id = $this->session_user->user_id();
		$query = $this->user_model->get_where("user",array('user_id' => $user_id))->row_array();
		$data['name'] = $query['name'];
		$data['phone'] = $query['phone'];
		$data['address'] = $query['address'];
		$data['provider'] = $query['provider'];



		if ($this->input->post("ajax_request")) {
			echo $this->load->view("profile", $data, TRUE);
		}
		else{

		$data['page'] = "user";
		$data['user_content'] = $this->load->view("profile", $data, TRUE);
		$this->user_template->get_view($data);
		}
	}
	public function my_order(){
		$data['num_notif'] = $this->num_notif();
		$user_id = $this->session->userdata("user");
		$query = $this->db->get_where("user",array('user_id' => $user_id))->row_array();
		$data['provider'] = $query['provider'];
		/*
		Jika mendapat request dari ajax
		*/
		$user_id = $this->session_user->user_id();
		$query_order = $this->db->get_where("pos_order",array('user_id' => $user_id,'order_status !='=>'Temp'));
		$data['query_order'] = $query_order;

		$queryDetail = [];
		foreach ($query_order->result_array() as $key => $value) {
			$this->db->join("pos_product", "pos_product.product_id = pos_order_detail.product_id","INNER");
			$data['queryDetail'][] = $this->db->get_where('pos_order_detail', array('order_id' => $value['order_id']));
		}

		if ($this->input->post("ajax_request")) {
			echo $this->load->view("my_order", $data, TRUE);
		}
		else{
		$data['page'] = "user";
		
		$data['user_content'] = $this->load->view("my_order", $data, TRUE);
		$this->user_template->get_view($data);
		}
	}

	public function logout(){
		$this->session->unset_userdata('user');
		redirect(base_url());
	}

	public function get_user_info($user_id){
		$query = $this->user_model->getUserModel($user_id);
		return $query;
	}
	public function check_user(){

	}
	public function update_profile(){
		$user_id = $this->session_user->user_id();
		$data['name'] = ucwords($this->input->post("name"));
		$data['phone'] = $this->input->post("phone");
		$data['address'] = $this->input->post("address");
		$query = $this->user_model->update_user($user_id,$data);
		if ($query) {
			$json_data = json_encode($data);
			$array = array("status" => "success", "name" => $data['name']);
			echo json_encode($array);
		}
	}
	public function get_user_id(){
		$result = $this->session->userdata("user");
		return $result;
	}
	public function change_password(){
		$data['num_notif'] = $this->num_notif();
		$user_id = $this->session->userdata("user");
		$query = $this->user_model->get_where("user",array('user_id' => $user_id))->row_array();
		$data['name'] = $query['name'];
		$data['phone'] = $query['phone'];
		$data['address'] = $query['address'];
		$data['provider'] = $query['provider'];


		if ($this->input->post("ajax_request")) {
			echo $this->load->view("change_password", NULL, TRUE);
		}
		else{
		$data['page'] = "user";
		
		$data['user_content'] = $this->load->view("change_password", NULL, TRUE);
		$this->user_template->get_view($data);
		}
	}
	public function change_password_action(){
		if ($this->input->post("ajax_request")) {
			$pw1 = $this->input->post("pw_1");
			$pw2 = $this->input->post("pw_2");
			$pw3 = $this->input->post("pw_3");
			$user_id = $this->get_user_id();
			$get_user = $this->user_model->get_user_login(array("user_id" => $user_id, "password" => $pw1));
			if (count($get_user) > 0) {
				$query = $this->user_model->update_user($user_id,array("password" => $pw3));
				if ($query) {
					$this->session->unset_userdata('user');
					$json_data = array("status" => "success");
					echo json_encode($json_data);
				}
				else{
					$json_data = array("status" => "failed");
					echo json_encode($json_data);	
				}
			}
			else{
				$json_data = array("status" => "failed");
				echo json_encode($json_data);	
			}
		}
		
	}
	public function testimoni(){
		$data['num_notif'] = $this->num_notif();
		$user_id = $this->session->userdata("user");
		$query = $this->user_model->get_where("testimoni",  array('user_id' => $user_id));
		$res = $query->result_array();
		$data['query'] = $res;
		
		$query1 = $this->user_model->get_where("user",array('user_id' => $user_id))->row_array();
		$data['provider'] = $query1['provider'];
		if ($this->input->post("ajax_request")) {
			echo $this->load->view("testimoni", $data, TRUE);
		}
		else{
			$data['page'] = "user";
			
			$data['user_content'] = $this->load->view("testimoni", $data, TRUE);
			$this->user_template->get_view($data);
		}
		
	}

	public function testimoni_post(){
		if ($this->input->post("posting")) {

			/*
			Ambil data user id
			*/
			$user_id = $this->get_user_id();
			$query = $this->get_user_info($user_id);

			$insert['user_id'] = $user_id;
			$insert['testi_isi'] = $this->input->post("posting");
			
			$insert['name'] = $query['name'];
			$insert['date_create_testi'] = date("Y-m-d H:i").":00";
			$insert['status_publishing'] = "waiting";

			$q_insert = $this->user_model->insert_testi($insert);

			if ($q_insert) {
				$arr_json = array("status" => "success", "report" => "good");
			}
			else{
				$arr_json = array("status" => "failed", "report" => "bad");	
			}
			echo json_encode($arr_json);
		}
		else{
			$arr_json = array("status" => "failed", "report" => "validate");	
			echo json_encode($arr_json);
		}
	}
	public function num_notif(){
		$user_id = $this->session_user->user_id();
		$query = $this->db->get_where("notif_user",array('notif_user_status' => "unread","user_id" =>$user_id));
		return $query->num_rows();
	}
	public function clear_notif(){
		$query = $this->user_model->clear_notif();
	}
	

}



?>