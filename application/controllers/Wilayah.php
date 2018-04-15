<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Wilayah extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("wilayah_model");
	}
	public function provinsi(){
		$query = $this->db->get("provinsi");
		echo "<option value=> - Pilih Provinsi - </option>";
		foreach ($query->result_array() as $key => $value) {
			echo "<option value=".$value['provinsi_id'].">".$value['nama_provinsi']."</option>";
		}
	}
	public function kabupaten(){
		$provinsi_id = $this->input->post("provinsi_id");
		$query = $this->wilayah_model->kabupaten($provinsi_id);
		echo "<option value=> - Pilih Kabupaten/kota - </option>";
		foreach ($query as $key => $value) {
			echo "<option value=".$value['kabupaten_id'].">".$value['nama_kabupaten']."</option>";
		}
	}
	public function kecamatan(){
		$kabupaten_id = $this->input->post("kabupaten_id");
		$query = $this->wilayah_model->kecamatan($kabupaten_id);
		echo "<option value=> - Pilih Kecamatan - </option>";
		foreach ($query as $key => $value) {
			echo "<option value=".$value['kecamatan_id'].">".$value['nama_kecamatan']."</option>";
		}
	}
}


?>