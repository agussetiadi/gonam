<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
if(!function_exists("validate_form")){
	function validate_form($array){
		$push = array();
		foreach ($array as $key => $value) {
			if (empty($value)) {
				$push[] = $key;
			}
		}
		return $push;
	}
}