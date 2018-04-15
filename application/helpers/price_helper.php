<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
if(!function_exists("price")){
	function price($number){
		$str = str_replace(",", "", $number);
		$convert = intval($str);
		return $convert;
	}
}