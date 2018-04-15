<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Recovery extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("user_template");
		$this->load->model("recovery_model");
	}
	public function index(){
		$data['alert'] = NULL;
		$data['title'] = "Recovery Akun | Gonam Aqiqah";

		$data['page'] = "recovery";
		$this->user_template->get_view($data);
	}
	public function send(){
		$email = $this->input->post("email");
		$type = $this->input->post("type");
		$data = array('email' => $email,'type'=>$type);
		$get_user = $this->recovery_model->get_where("user",array('email' => $email,'provider' => 'basic'));
		if ($get_user->num_rows() > 0) {
			$query = $get_user->row_array();
			$user_id = $query['user_id'];
			$telepon = $query['phone'];


			$key = substr(time(), -2).$user_id;
			$array2['user_id'] = $user_id;
			$array2['token'] = md5($user_id).time();
			$array2['auth_key'] = $key;
			$array2['access_type'] = "RecoveryPassword";
			$array2['date_create'] = date('Y-m-d');
			$this->recovery_model->insert("auth", $array2);
			if ($type == "email") {
				$to = $this->input->post("email");

				/*Merubah Pesan menjadi html*/
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				/*close*/

				$subject = "Recovery Akun Gonam Aqiqah";
				$tautan = base_url()."verification?type=basic&AccessToken=".$array2['token']."&AccessType=RecoveryPassword";

				$message = '
					<table style="width: 100%; height: auto; padding: 10%; background-color: whitesmoke;">
					    <tr>
					        <td style="padding:20px; background-color: #313436;">
					            <img src="'.base_url().'assets/img/Logo-white.png'.'" style="margin:auto;width: 200px; display: block;">
					        </td>
					    </tr>
					    <tr>
					        <td style="text-align: center; padding: 10px 0;background-color: #313436;"><h2 style="color: white;">Hay '.$array['name'].'</h2><h4 style="color: white;">Recovery Akun Gonam Aqiqah</h4></td>
					    </tr>
					    <tr>
					        <td style="padding: 30px 0;">Silahkan klik tombol dibawah ini untuk reset password</td>
					    </tr>
					    <tr>
					        <td style="padding: 50px 0px; text-align: center;"><a style="padding: 10px 15px; border-radius: 20px; color: white; text-decoration: none; background-color: red;" href="'.$tautan.'">Confirm Email</a></td>
					    </tr>
					    <tr>
					        <td style="padding: 30px 0;">Setelah konfirmasi anda bisa login menggunakan password baru anda<br><br>Salam,<br>Gonam Aqiqah</td>
					    </tr>
					</table>
				';

				
				mail($to,$subject,$message);
			}
			elseif($type == "phone"){

				$userkey = "or981u"; //userkey lihat di zenziva
				$passkey = "gonamaqiqah906"; // set passkey di zenziva
				$message = "Gonam Aqiqah, Recovery Akun, Masukan Kode Ini ".$key;
				$url = "https://reguler.zenziva.net/apps/smsapi.php";
				$curlHandle = curl_init();
				curl_setopt($curlHandle, CURLOPT_URL, $url);
				curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$telepon.'&pesan='.urlencode($message));
				curl_setopt($curlHandle, CURLOPT_HEADER, 0);
				curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
				curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
				curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
				curl_setopt($curlHandle, CURLOPT_POST, 1);
				$results = curl_exec($curlHandle);
				curl_close($curlHandle);

				$XMLdata = new SimpleXMLElement($results);
				$status = $XMLdata->message[0]->text;

			}

			redirect(base_url()."recovery/get_code/");
		}
		else{
			$data['alert'] = '<div class="alert alert-danger">Sepertinya Email Tidak Terdaftar</div>';
			$data['title'] = "Recovery Akun | Gonam Aqiqah";
			$data['page'] = "recovery";
			$this->user_template->get_view($data);
		}
	}

	public function reset_password(){
		if (empty($this->session->userdata("RecoveryPassword"))) {
			die("You have not permission");
		}
		if (empty($this->session->userdata("user"))) {
			redirect(base_url());
		}

		$token = $this->session->userdata("RecoveryPassword");
		$user_id = $this->session->userdata("user");
		$data['page'] = "reset_password";
		$this->user_template->get_view($data);

	}	

	public function register_send_again(){
		$data['page'] = "recovery";
		$this->user_template->get_view($data);		
	}

	public function get_code(){
		$data['alert'] = NULL;
		$data['page'] = "get_code";
		$this->user_template->get_view($data);
	}
	public function change_password_action(){
		if (empty($this->session->userdata("RecoveryPassword"))) {
			die("You have not permission");
		}
		if (empty($this->session->userdata("user"))) {
			redirect(base_url());
		}
		$password = $this->input->post("password");
		$user_id = $this->session->userdata("user");
		$this->recovery_model->update("user",array('password' => $password), "user_id",$user_id);
		redirect(base_url()."user/profile/");
	}

}


?>