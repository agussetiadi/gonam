<?php 

	/**
	* 
	*/
	class Date_time 
	{
		public static $date_time;
		private static $array_bulan;
		/*fungsi untuk merubah bulan  numerik menjadi nama bulan biasa*/
		public static function arr_bulan($param){
			/*memberi nilai property $array_bulan dengan array assosiatif*/
			self::$array_bulan = array('01'=>'January','02'=>'February','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
			$result = self::$array_bulan[$param];
			return $result;
		}
		public static function ex_bulan(){
			$result =  substr(self::$date_time, 5,2);
			return $result;
		}
		public static function ex_tahun(){
			$result =  substr(self::$date_time, 0,4);
			return $result;
		}
		public static function ex_day(){
			$result =  substr(self::$date_time, 8,2);
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