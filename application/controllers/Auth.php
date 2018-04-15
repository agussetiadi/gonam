<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Auth extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->library("GoogleOauth/google");
	}
	public function googleAuth(){
		$this->google->callBack();
		redirect(base_url()."auth/show");
	}


	public function show(){
		$result = $this->google->getPeople();

		$insert['key_id'] = $result['id'];
		
		$query_check = $this->user_model->get_user_login(array("key_id" => $insert['key_id']));
		$query_user_max = $this->user_model->check_user_max();
		$user_id = $query_user_max['user_id'];
		$new_user_id = intval($user_id)+1;

		#Jika data berdasarkan key id sudah ada
		#maka insert data
		if (count($query_check) == 0) {
			$this->session->set_userdata('user_id',$new_user_id);

			$this->db->order_by("customer_id","DESC");
			$q_code = $this->db->get('pos_customer',1,0)->row_array();
			$customer_id = $q_code['customer_id'] + 1;
			$customer_code = "PLG-".$customer_id;


			$insert['user_id'] = $new_user_id;
			$insert['email'] = $result['emails'][0]['value'];
			$insert['name'] = ucwords($result['displayName']);
			$insert['user_gender'] = $result['gender'];
			$insert['picture'] = $result['image']['url'];
			$insert['join_date'] = date("Y-m-d");
			$insert['status'] = "active";
			$insert['provider'] = "google";
			$insert['customer_id'] = $customer_id;

			$dataInsert = array("customer_name" => $insert['name'],
					"customer_code" => $customer_code,
					"created" => date('Y-m-d')
					);

			$query = $this->db->insert("pos_customer",$dataInsert);

			$this->db->insert("user",$insert);

		}
		#jika belum ada maka update data yg diperlukan
		else{
			$update['email'] = $result['emails'][0]['value'];
			$update['name'] = ucwords($result['displayName']);
			$update['picture'] = $result['image']['url'];
			
			$this->session->set_userdata('user_id',$query_check['user_id']);

			$query_update = $this->user_model->update_user($query_check['user_id'],$update);
		}
		$this->check_redirect();

	}
	public function check_redirect(){
		if (!empty($this->session->userdata("redirect"))) {
			redirect($this->session->userdata("redirect"));
			unset($_SESSION['redirect']);
		}
		else{
			redirect(base_url()."user/profile/");
		}
	}
}



?>