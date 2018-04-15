<?php 


/**
* 
*/
class Template extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("user");
		$this->load->library('session_admin');
	}
	public function get_view($data){
		$this->session_admin->check_login();
		
		$this->load->view("admin/header");
		$this->load->view("admin/body", $data);
		$this->load->view("admin/footer");
	}
}

?>