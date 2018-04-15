<?php 


class Gallery extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("user_template");
		$this->load->model("gallery_model");
	}

	public function index(){
		$data['title'] = "Gallery | Gonam Aqiqah";
		$query = $this->db->get_where("image_post", array('image_category' => 'gallery'));
		$data['query'] = $query;

		$data['page'] = 'gallery';
		$this->user_template->get_view($data);

	}
}

?>