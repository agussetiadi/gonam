<?php 

/**
* 
*/
class Session_admin extends CI_model
{
	

	function __construct()
	{
		parent::__construct();
	}


	public function check_login(){
		if (empty($this->session->userdata("admin_id"))) {
			redirect(admin_url()."login");
		}
	}
	public function admin_id(){
		return $this->session->userdata("admin_id");
	}
	public function admin_name(){
		return $this->session->userdata("admin_name");
	}
	public function on_login($param){
		/*admin_id
		admin_name
		user_name
		picture
		*/
		$array['admin_name'] = $param['admin_name'];
		$array['admin_foto'] = $param['admin_foto'];
		$array['admin_id'] = $param['admin_id'];
		$array['username'] = $param['username'];
		$this->session->set_userdata($array);
	}

	public function admin_foto(){
		return $this->session->userdata('admin_foto');
	}

}