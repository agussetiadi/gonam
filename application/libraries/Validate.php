<?php 

/**
* 
*/
class Validate
{
	
	static function selected($param1,$param2)
	{
		if ($param1 == $param2) {
			echo "selected";
		}
	}
	static function select($param1,$param2)
	{
		if ($param1 == $param2) {
			$result = "selected";
			return $result;
		}
	}

	static function checked($string,$param)
	{
		if ($string == $param) {
			echo "checked";
		}
	}
}


?>