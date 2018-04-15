<?php 

/**
* 
*/
class Login_model extends CI_model
{
	public function __construct(){
		parent::__construct();
		$this->load->library('session_admin');
	}
	public function get_login($username,$password){
		date_default_timezone_set("Asia/jakarta");
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('admin');
		if ($query->num_rows() > 0) {
			$query = $query->row_array();
			

			$admin_id = $query['admin_id'];
			$username = $query['username'];
			$admin_foto = $query['admin_foto'];
			$admin_name = $query['first_name'];

			$array = array('admin_id' =>$admin_id,
							"username" => $username,
							"admin_name" => $admin_name,
							"admin_foto" => $admin_foto
					);
			$this->session_admin->on_login($array);

			$this->db->where("admin_id",$admin_id);
			$this->db->update("admin", array('last_login_admin' =>date("Y-m-d H:i:s") ));
			redirect('admin');
		}
		else{
			redirect('admin/login');
		}
	}
}


?>