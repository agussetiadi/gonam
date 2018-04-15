<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
* 
*/
class Testimoni extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("admin/testimoni_model");
		$this->load->library('template');
		$this->load->library('upload_file');
	}
	public function index(){
		$isi['page'] = "admin/testimoni";
		$this->template->get_view($isi);
	}

	public function delete(){
		$id = $this->input->post('testimoni_id');
		$query_testi = $this->db->get_where("testimoni", array("testimoni_id" => $id))->row_array();;

		$picture = $query_testi['picture'];
		$thumb = str_replace(".", '_thumb.', $picture);
		if ($picture !== "" AND file_exists("assets/img/testimoni_img/".$picture)) {
			unlink("assets/img/testimoni_img/".$picture);
		}
		if ($thumb !== "" AND file_exists("assets/img/testimoni_img/".$thumb)) {
			unlink("assets/img/testimoni_img/".$thumb);
		}

		$query = $this->db->delete('testimoni',array('testimoni_id' => $id));
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
		else{
			echo json_encode(array('status' => 'failed'));	
		}

	}


	public function add(){
		$name 		= ucwords($this->input->post("name"));
		$testi_isi 	= ucfirst($this->input->post("testi_isi"));
		$gender 	= $this->input->post("gender");
		$testi_ket 	= ucwords($this->input->post("testi_ket"));
		$picture 	= $this->input->post("picture");
		$status_publishing 	= $this->input->post("status_publishing");

		$data_array = array('name' => $name,'testi_isi'=>$testi_isi,'date_create_testi' => date("Y-m-d"),'gender'=>$gender,'testi_ket' => $testi_ket, 'picture' => $picture, 'status_publishing' => $status_publishing);
		
		$query = $this->db->insert("testimoni",$data_array);
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}

	}

	public function update_action(){
		$testimoni_id = ucwords($this->input->post("testimoni_id"));
		$name 		= ucwords($this->input->post("name"));
		$testi_isi 	= ucfirst($this->input->post("testi_isi"));
		$gender 	= $this->input->post("gender");
		$testi_ket 	= ucwords($this->input->post("testi_ket"));
		$picture 	= $this->input->post("picture");
		$status_publishing 	= $this->input->post("status_publishing");



		$data_array = array('name' => $name,'testi_isi'=>$testi_isi,'gender'=>$gender,'testi_ket' => $testi_ket, 'picture' => $picture, 'status_publishing' => $status_publishing);

		$this->db->where("testimoni_id",$testimoni_id);
		$query = $this->db->update("testimoni",$data_array);
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}

	}

	public function render_testimoni(){
		echo $this->testimoni_model->render_testimoni();
	}


	public function upload_image(){
		$path = 'assets/img/testimoni_img/';
		$file = 'picture_init';
		$newName = time();
		$result = $this->upload_file->upload_image($path,$file,$newName);
		if ($result['status'] == 'ok') {
			echo json_encode(array('status' => 'ok', 'data' => $result['data']));
		}
		if ($result['status'] == 'error') {
			echo json_encode(array('status' => 'failed'));
		}
	}

	public function get_testimoni(){
		$testimoni_id = $this->input->post('testimoni_id');
		$query = $this->db->get_where('testimoni',array('testimoni_id' => $testimoni_id))->row_array();
		if ($query) {
			echo json_encode(array('status' => 'ok','data' => $query));
		}
	}
}


?>