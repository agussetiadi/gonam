<?php 

/**
* 
*/
class Class_date 
{
	public static $array_bulan;
	/*fungsi untuk merubah bulan  numerik menjadi nama bulan biasa*/
	public static function arr_bulan($param){
		/*memberi nilai property $array_bulan dengan array assosiatif*/

		if (!empty($param)) {
			
			$param_x = explode("-", $param);
			$param_0 = $param_x[0];
			$param_1 = $param_x[1];
			$param_2 = $param_x[2];
			$array_bulan = array('00'=>'-',
								'01'=>'January',
								'02'=>'February',
								'03'=>'Maret',
								'04'=>'April',
								'05'=>'Mei',
								'06'=>'Juni',
								'07'=>'Juli',
								'08'=>'Agustus',
								'09'=>'September',
								'10'=>'Oktober',
								'11'=>'November',
								'12'=>'Desember');


			$array_day = array(
								'Sunday' => 'Minggu', 
								'Monday' => 'Senin',
								'Tuesday' => 'Selasa',
								'Wednesday' => 'Rabu',
								'Thursday' => 'Kamis',
								'Friday' => 'Jumat',
								'Saturday' => 'Sabtu');
			$timestamp = strtotime($param);
			$day = date('l', $timestamp);
			$result = $array_day[$day]." ".$param_2." ".$array_bulan[$param_1]." ".$param_0;
			return $result;
		}
		else{
			return "<i>Date not Set</i>";	
		}

	}

	public static function arr_day($param){
		if (!empty($param)) {
			$param_x = explode("-", $param);
			$param_0 = $param_x[0];
			$param_1 = $param_x[1];
			$param_2 = $param_x[2];
			$array_bulan = array('00'=>'-',
								'01'=>'January',
								'02'=>'February',
								'03'=>'Maret',
								'04'=>'April',
								'05'=>'Mei',
								'06'=>'Juni',
								'07'=>'Juli',
								'08'=>'Agustus',
								'09'=>'September',
								'10'=>'Oktober',
								'11'=>'November',
								'12'=>'Desember');


			$array_day = array(
								'Sunday' => 'Minggu', 
								'Monday' => 'Senin',
								'Tuesday' => 'Selasa',
								'Wednesday' => 'Rabu',
								'Thursday' => 'Kamis',
								'Friday' => 'Jumat',
								'Saturday' => 'Sabtu');
			$timestamp = strtotime($param);
			$day = date('l', $timestamp);
			$result = $array_day[$day];
			return $result;
		}
		else{
			return "<i>Date not Set</i>";
		}
	}

	public static function tanggal($param){
		/*memberi nilai property $array_bulan dengan array assosiatif*/

		if (!empty($param)) {
			$param_x = explode("-", $param);
			$param_0 = $param_x[0];
			$param_1 = $param_x[1];
			$param_2 = $param_x[2];
			$array_bulan = array('00'=>'-',
								'01'=>'January',
								'02'=>'February',
								'03'=>'Maret',
								'04'=>'April',
								'05'=>'Mei',
								'06'=>'Juni',
								'07'=>'Juli',
								'08'=>'Agustus',
								'09'=>'September',
								'10'=>'Oktober',
								'11'=>'November',
								'12'=>'Desember');


			$timestamp = strtotime($param);
			$day = date('l', $timestamp);
			$result = $param_2." ".$array_bulan[$param_1]." ".$param_0;
			return $result;
		}
		else{
			return "<i>Date not set</i>";
		}
	}

	public static function tahun_tanggal($param){
		/*memberi nilai property $array_bulan dengan array assosiatif*/
		if (!empty($param)) {
			$param_x = explode("-", $param);
			$param_0 = $param_x[0];
			$param_1 = $param_x[1];
			$array_bulan = array('00'=>'-',
								'01'=>'January',
								'02'=>'February',
								'03'=>'Maret',
								'04'=>'April',
								'05'=>'Mei',
								'06'=>'Juni',
								'07'=>'Juli',
								'08'=>'Agustus',
								'09'=>'September',
								'10'=>'Oktober',
								'11'=>'November',
								'12'=>'Desember');


			$timestamp = strtotime($param);
			$day = date('l', $timestamp);
			$result = $array_bulan[$param_1]." ".$param_0;
			return $result;
			
		}
		else{
			return "<i>Date not set</i>";	
		}

	}


	public static function arr_jam($param){

		if (!empty($param)) {
			$param = explode(":", $param);
			$res_1 = $param[0];
			$res_2 = $param[1];
			$result = $res_1.":".$res_2;
			return $result;
		}
		else{
			return "<i>Time not set</i>";
		}

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
	public static function time_now(){
		date_default_timezone_set("Asia/Jakarta");
		$now = date("H:i:00");
		return $now;
	}
	public static function date_now(){
		date_default_timezone_set("Asia/Jakarta");
		$now = date("Y-m-d");
		return $now;
	}
}

?>