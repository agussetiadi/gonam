<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/**
* 
*/
class Verification extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("verification_model");
		$this->load->model("user_model");
		$this->load->library("user_template");
	}
		#verification 
	public function index(){
		$AccessType = $this->input->get("AccessType");
		$AccessToken = $this->input->get("AccessToken");
		$query = $this->verification_model->check_auth(array("token"=>$AccessToken,"access_type" => $AccessType));

		if (count($query) > 0) {
		$date_create = $query['date_create'];
		$user_id = $query['user_id'];

			$this->user_model->update_user_status(array("status"=>"active"),$user_id);
			$_SESSION['user'] = $user_id;
			if ($AccessType == "UserJoin") {
				redirect(base_url());	
			}
			elseif($AccessType == "RecoveryPassword"){
				$this->session->set_userdata("RecoveryPassword",$AccessToken);
				redirect(base_url()."recovery/reset_password");
			}
		}
		else{
			die("No Access Token");
		}
	}

	public function fetch_key(){
		$AccessToken = $this->input->post("code");
		$query = $this->verification_model->check_auth(array("auth_key"=>$AccessToken));

		if (count($query) > 0) {
		$date_create = $query['date_create'];
		$user_id = $query['user_id'];
		$AccessToken = $query['token'];

			$this->user_model->update_user_status(array("status"=>"active"),$user_id);
			$this->session->set_userdata("RecoveryPassword",$AccessToken);
			$this->session->set_userdata("user",$user_id);
			redirect(base_url()."recovery/reset_password");
		}
		else{
			$data['alert'] = '<div class="alert alert-danger">Kode Tidak Valid</div>';
			$data['content'] = "get_code";
			$this->user_template->data($data);
		}
	}
}


?>