<?php 

class Page extends CI_model
{
	function __construct(){
		parent::__construct();
		$this->load->library('pagination');
	}
	public function get_paging($num,$perpage,$site_url){
		if ($num > $perpage) {
			$perpage = $num/$perpage;
			$perpage = ceil($perpage);
		}
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
		$this->pagination->initialize($config);
		$links = $this->pagination->create_links();
		return $links;
	}
	public function query_paging($array){
		/*$array = array("nama_table" => "nama_table", "get_where" => "true", "data_array" => "data_array", "uri_segment" => "4","perpage" => 2,"order_by" => "id","sort" => Desc)*/

		if ($array['get_where'] == "true") {
			$get_all = $this->db->get_where($array['nama_table'],$array['data_array']);		
		}		
		else{
			$get_all = $this->db->get($array['nama_table']);		
		}
		$num = $get_all->num_rows();
		$start = $this->uri->segment($array['uri_segment']);

		$this->db->limit($array['perpage'],$start);
		$this->db->order_by($array['order_by'], $array['sort']);
		if ($array['get_where'] == "true") {
			$query = $this->db->get_where($array['nama_table'], $array['data_array']);
		}
		else{
			$query = $this->db->get($array['nama_table']);	
		}
		$result['query'] = $query->result_array();

		$result['links'] = $this->get_paging($num,$array['perpage'],$array['site_url']);
		return $result;
	}
}

?>