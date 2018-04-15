<?php


/**
* 
*/
class Redirect_404 extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		redirect(base_url());
	}
}


 ?>