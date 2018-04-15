<?php 

/**
* 
*/
class Session_user extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
		if (empty($this->session->user_visitors)) {
			$this->session->set_userdata('user_visitors',session_id());
		}
	}
	public function user_visitors(){
		return $this->session->userdata('user_visitors');
	}
	public function user_id(){
		return $this->session->userdata('user_id');
	}
	public function redirect(){
		return $this->session->userdata('redirect');
	}


}