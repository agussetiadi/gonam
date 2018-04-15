<?php 
/**
* 
*/
class Pages extends CI_controller
{
	public function __construct(){
		parent::__construct();
		$this->load->library("user_template");
	}
	public function index(){
		$this->db->order_by("date_create_testi", "DESC");
		$query = $this->db->get_where("testimoni", array('status_publishing' => 'publishing'), 6,0);
		$isi['query'] = $query;
		$data = array();
		foreach ($query->result_array() as $key => $value) {
			$img = $value['picture'];
			if (file_exists("assets/img/".$img)) {
				$data[$key] = $img;
			}
			else{
				$data[$key] = "user_unknow.png";	
			}

		}
		$isi['img'] = $data;
		$isi['page'] = "home";
		$data2['title'] = "Home | Gonam Aqiqah";
		$this->user_template->get_view_2($isi,$data2);
	}

	
}
?>