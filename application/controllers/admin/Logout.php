<?php 

/**
* 
*/
class Logout extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		session_destroy();
		redirect(admin_url()."login");
	}

}