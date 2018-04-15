<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
if(!function_exists("admin_url")){
	function admin_url(){
		return base_url()."admin/";
	}
}

?>