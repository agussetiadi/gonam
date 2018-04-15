<?php 

/**
* 
*/
class classDateTime 
{
	public static $array_bulan;
	/*fungsi untuk merubah bulan  numerik menjadi nama bulan biasa*/
	public static function arr_bulan($param){
		/*memberi nilai property $array_bulan dengan array assosiatif*/
		$param = explode("-", $param);
		$param_0 = $param[0];
		$param_1 = $param[1];
		$param_2 = $param[2];
		$array_bulan = array('01'=>'January','02'=>'February','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
		$result = $param_2." ".$array_bulan[$param_1]." ".$param_0;
		return $result;
	}

	public static function arr_jam($param){
		$param = explode(":", $param);
		$res_1 = $param[0];
		$res_2 = $param[1];
		$result = $res_1.":".$res_2;
		return $result;
	}
	public static function toDay(){
		$tanggal_ini = date('m');
		$result = self::arr_bulan($tanggal_ini);
		return $result;
	}
	public static function tomorow(){
		$tanggal_ini = date('m')+1;
		$result = date('Y-m').$tanggal_ini;
		return $result;	
	}
	public static function now(){
		date_default_timezone_set("Asia/Jakarta");
		$now = date("Y-m-d H:i:00");
		return $now;
	}
}

?>