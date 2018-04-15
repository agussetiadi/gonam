<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
if(!function_exists("image_exists")){
	function image_exists($path,$img,$alternate = NULL){
		
		if (file_exists($path.$img) && !empty($img)) {
			return base_url().$path.$img;
		}
		else{
			if ($alternate !== NULL) {
				return base_url().$path.$alternate;		
			}
			else{
				return base_url()."assets/img/im.png";
			}
		}

	}
}