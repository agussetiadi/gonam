<?php 

class Wilayah_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function provinsi() {
		$query = $this->db->get("provinsi");
		$result = $query->result_array();
		return $result;
	}
	public function kabupaten($provinsi_id) {
		$query = $this->db->get_where("kabupaten", array("provinsi_id" => $provinsi_id));
		$result = $query->result_array();
		return $result;
	}
	public function kecamatan($kabupaten_id) {
		$query = $this->db->get_where("kecamatan", array("kabupaten_id" => $kabupaten_id));
		$result = $query->result_array();
		return $result;
	}
}

?>