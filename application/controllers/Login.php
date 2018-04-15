<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model("product_model");
		$this->load->model("user_model");
		$this->load->library("user_template");
	}
	public function index(){

		$data['title'] = "Login | Gonam Aqiqah";

		if ($this->input->get("continue")) {
			$str = $this->input->get("continue");
			$this->session->set_userdata("redirect",$str);
		}
			

		$data['msg_error'] = "";

		
		$data['page'] = "login";
		$this->user_template->get_view($data);
	}
	public function facebookAuth(){
		$this->load->library("Facebook/fb_callback");
		$getUser  = $this->fb_callback->get_callback();
		$id = $getUser['key_id'];


		#Check data user where id
		#select
		$select = $this->user_model->get_user_login(array("key_id"=>$id));

		#select max table user
		$select_max = $this->user_model->check_user_max();


		#get Data response API
		$data_insert['email'] 		= $getUser['email'];
		$data_insert['name'] 		= $getUser['name'];
		$data_insert['user_gender'] = $getUser['user_gender'];
		$data_insert['picture'] 	= $getUser['picture'];
		$data_insert['key_id'] 		= $id;



		#update data jika key id sudah ada
		if (count($select) > 0) {
			$this->session->set_userdata('user_id',$select['user_id']);
			#query update
			$query_update = $this->user_model->update_user($select['user_id'],$data_insert);
			$this->check_redirect(base_url()."user/profile/");
		}
		#inset data jika key id belum ada
		else{
			$this->db->order_by("customer_id","DESC");
			$q_code = $this->db->get('pos_customer',1,0)->row_array();
			$customer_id = $q_code['customer_id'] + 1;
			$customer_code = "PLG-".$customer_id;


			$data_insert['user_id'] = intval($select_max['user_id'])+1;
			$data_insert['join_date'] = date("Y-m-d");
			$data_insert['status'] = "active";
			$data_insert['provider'] = "facebook";
			$data_insert['customer_id'] = $customer_id;
			$query_insert = $this->db->insert('user',$data_insert);


			$dataInsert = array("customer_name" => $data_insert['name'],
					"customer_code" => $customer_code,
					"created" => date('Y-m-d')
					);

			$query = $this->db->insert("pos_customer",$dataInsert);

			if ($query) {
				$this->session->set_userdata('user_id',$data_insert['user_id']); 
				$this->check_redirect(base_url()."user/profile/");
			}
		}

	}
	public function check(){

		$this->load->library("Facebook/fbconfig");
		$this->load->library("GoogleOauth/google");
		$array['email'] = $this->input->post("username");
		$array['password'] = $this->input->post("password");
		$array['provider'] = 'basic';
		$query = $this->user_model->get_user_login($array);
		$user_id = $query['user_id'];

		$data['url'] = $this->google->getUrl();
		$data['fb_login'] = $this->fbconfig->getUrl();

		# table user
		# jika terdapat data sesuai email dan password
		# maka lakukan
		if (count($query) > 0) {

			# Jika status adalah pending maka 
			# tampilkan alert dan verifikasi email
			if ($query['status'] == 'pending') {
				$data['page'] = "login";
				$data['msg_error'] = '<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3>OOPS !!!</h3>
						<p>Sepertinya anda belum verifikasi akun</p>
						<p>Jika belum menerima email verifikasi ? <a href="'.base_url()."recovery/register_send_again".'">klik disini</a></p>
						</div>';		
			}

			#Jika status aktif
			#maka alihkan ke halaman utama
			elseif($query['status'] == 'active'){
				$this->session->set_userdata('user_id',$user_id);
				$this->check_redirect(base_url());
			}
		}

		# Jika email dan password yang dimasukan
		# tidak terdapat dalam database
		# aka tampilkan alert
		else{
			$data['page'] = "login";
			$data['msg_error'] = '<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3>OOPS !!!</h3>
					<h5>Email Atau Password Tidak Sesuai</h5>
					</div>';
		}
		$this->user_template->get_view($data);	


	}

	public function check_redirect($param){
		if (!empty($this->session->userdata("redirect"))) {
			redirect($this->session->userdata("redirect"));
			unset($_SESSION['redirect']);
		}
		else{
			redirect($param);
		}
	}

	public function get_auth_url(){
		$this->load->library("Facebook/fbconfig");
		$this->load->library("GoogleOauth/google");
		$googleAuth = $this->google->getUrl();
		$facebookAuth = $this->fbconfig->getUrl();

		$dataObj = array('status' => 'ok',
						 'data' => array('googleAuth' => $googleAuth,
						 				 'facebookAuth' => $facebookAuth)
						);
		echo json_encode($dataObj);
	}

}


?>