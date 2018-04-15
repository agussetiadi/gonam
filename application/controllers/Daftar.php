<?php 


/**
* 
*/
class Daftar extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		$this->load->model("product_model");
		$this->load->library("form_validation");
		$this->load->library("user_template");
		$this->load->library("Facebook/fbconfig");
		$this->load->library("GoogleOauth/google");
		$this->load->library("send_notif");
	}
	public function index(){

		$data['title'] = "Register | Gonam Aqiqah";

		$data['email_validation'] = "";
		$data['page'] = "daftar";
		$data['url'] = $this->google->getUrl();
		$data['fb_login'] = $this->fbconfig->getUrl();
		$this->user_template->get_view($data);
	}


	public function action(){

		$data['url'] = $this->google->getUrl();
		$data['fb_login'] = $this->fbconfig->getUrl();

		$array['name'] 		= ucwords($this->input->post("name"));
		$array['email'] 	= $this->input->post("email");
		$array['password'] 	= $this->input->post("password");
		$array['phone'] 	= $this->input->post("wa");
		$array['user_gender'] = $this->input->post("user_gender");
		$array['address'] = $this->input->post("address");
		$array['join_date'] = date("Y-m-d");
		$array['status'] = "pending";
		$array['provider'] = "basic";
		$array['picture'] = base_url()."assets/img/yes-01.png";
		$this->form_validation->set_rules("name","Nama","required");
		$this->form_validation->set_rules("email","Email","required");
		$this->form_validation->set_rules("password","Password","required");
		$this->form_validation->set_rules("address","Alamat","required");

		
		if ($this->form_validation->run() == false) {
			#Jika data tidak valid
			$data['email_validation'] = "";
			$data['page'] = "daftar";

			$this->user_template->get_view( $data);
		}
		else{

			#Check alamat email
			#Apakah sudah terdaftar
			$arrayEmail = array("email"=>$this->input->post("email"),"provider" => "basic");
			$check_email = $this->user_model->check_email($arrayEmail);
			$status = $check_email['status'];
			if (count($check_email) > 0) {
				$valid_1 = "Silahkan verifikasi akun anda dengan mengklik tautan yang kami kirim ke email anda,";
				$valid_2 = "Jika tidak menerima email verifikasi ? <a href=".base_url()."recovery>klik disini</a>";
				if ($status == 'pending') {
					$append_valid = $valid_1."<br><br>".$valid_2."<br><br>";
				}
				else{
					$append_valid = "";	
				}
				$data['email_validation'] = "<p style=color:red>Alamat email sudah terdaftar</p>".$append_valid;
				$data['page'] = "daftar";
				$data['url'] = $this->google->getUrl();
				$data['fb_login'] = $this->fbconfig->getUrl();
				$this->user_template->get_view( $data);
			}
			else{

				$user_id = $this->check_user();

				#data insert table auth
				$key = substr(time(), 0,2).date("dm");
				$array['user_id'] = $user_id;
				$array2['user_id'] = $user_id;
				$array2['token'] = md5($user_id).time();
				$array2['auth_key'] = $key;
				$array2['access_type'] = "UserJoin";
				$array2['date_create'] = date('Y-m-d');


				$query = $this->user_model->insert_user($array);
				$array2['user_id'] = $user_id;
				$query2 = $this->user_model->insert_auth($array2);
				


				#Send Email 

				/*Merubah Pesan menjadi html*/
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "page-type:text/html;charset=iso-8859-1" . "\r\n";
				/*close*/



				$tautan = base_url()."verification?type=basic&AccessToken=".$array2['token']."&AccessType=UserJoin";
				$to = $array['email'];
				$subject = "Konfirmasi Pendaftaran Gonam Aqiqah";
				$message = '
					<table style="width: 100%; height: auto; padding: 10%; background-color: whitesmoke;">
					    <tr>
					        <td style="padding:20px; background-color: #313436;">
					            <img src="'.base_url().'assets/img/Logo-white.png'.'" style="margin:auto;width: 200px; display: block;">
					        </td>
					    </tr>
					    <tr>
					        <td style="text-align: center; padding: 10px 0;background-color: #313436;"><h2 style="color: white;">Hay '.$array['name'].'</h2><h4 style="color: white;">Selamat Bergabung Di Gonam Aqiqah</h4></td>
					    </tr>
					    <tr>
					        <td style="padding: 30px 0;">Silahkan klik tombol dibawah ini untuk konfirmasi</td>
					    </tr>
					    <tr>
					        <td style="padding: 50px 0px; text-align: center;"><a style="padding: 10px 15px; border-radius: 20px; color: white; text-decoration: none; background-color: red;" href="'.$tautan.'">Confirm Email</a></td>
					    </tr>
					    <tr>
					        <td style="padding: 30px 0;">Setelah konfirmasi anda bisa login menggunakan akun baru anda<br><br>Salam,<br>Gonam Aqiqah</td>
					    </tr>
					</table>
				';
				mail($to, $subject, $message,$headers);
				$get_email = self::getEmailProvider($to);
				
				$this->send_notif->user($user_id,"Selamat Datang ".$array['name']." Kamu Sekarang Jadi Member Kami, Dapatkan Penawaran Menarik Khusus Untukmu");

				$q_admin = $this->user_model->get_where("admin", array('is_deleted' => 0 ));
				foreach ($q_admin->result_array() as $key => $value) {
					$this->send_notif->admin($value['admin_id'],"Ada Pengguna Baru Mendaftar Sebagai Member",base_url()."admin/user_member");					
				}

				redirect(base_url()."daftar/success?continue=".$get_email);
			}
		}
	}

	#user
	#select
	#check jumlah user

	public function check_user(){
		$check_tb_user = $this->user_model->check_user();
		if (count($check_tb_user) > 0) {
			$get_max_id = $this->user_model->check_user_max();
			$user_id = intval($get_max_id['user_id']) + 1;
		}
		else{
			$user_id = 1000;	
		}
		return $user_id;
	}

	#Send Email
	public function send_email($to,$subject,$message){
		mail($to, $subject, $message);
	}


	public function success(){
		$data['continue'] = $this->input->get("continue");
		$data['page'] = "daftar_success";
		
		$this->user_template->get_view($data);
	}

	public static function msg($alert){	
	echo "<script type='text/javascript'>
		alert('$alert');
	</script>
	";
	return true;
	}

	private static function getEmailProvider($var){
		$ex1 = explode("@", $var);
		$ex2 = explode(".", $ex1[1]);
		$result = $ex2[0];
		$emailArray = array('gmail' => 'https://mail.google.com', 'yahoo' => 'https://mail.yahoo.com');
		return $emailArray[$result];
	}
}


?>