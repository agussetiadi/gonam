<?php 

/**
* 
*/
class Testimoni extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("user_template");
		$this->load->library("pagination");
		$this->load->model("testimoni_model");
	}

	public function _remap($start){

		$this->index($start);
	}

	public function index($start){

		$perpage = 6;
		if ($start > 0) {
			$start = $perpage * $start - $perpage;
		}
		else{
			$start = 0;
		}



		$query = $this->testimoni_model->list_testimoni($perpage,$start);
		$num = $this->testimoni_model->list_testimoni()->num_rows();
		$links = $this->get_paging($num,$perpage,base_url()."testimoni");

		$isi['query'] = $query;
		$isi['links'] = $links;
		$isi['page'] = "list_testimoni";
		$this->user_template->get_view($isi);
	}

	protected function get_paging($num,$perpage,$site_url){

		$config['base_url'] = $site_url;
		$config['total_rows'] = $num;
		$config['per_page'] = $perpage;
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item"><a><b>';
		$config['cur_tag_close'] = '</b></a></li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['use_page_numbers']  = TRUE;
		$this->pagination->initialize($config);
		$links = $this->pagination->create_links();
		return $links;
	}
}

?>