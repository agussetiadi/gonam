<?php 


function filter_char($string){
	$data = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   	return preg_replace('/[^A-Za-z0-9\-]/', '', $data); // Removes special chars.
}



?>