<?php 

/**
* 
*/
class Blog_model extends CI_model
{
	public $get_num;
	private $auto_number;
	public function get_all_blog($paging="false",$start=NULL,$perpage=NULL){
		/*$ci = $this->db->select('*');
		$ci = $this->db->from('blog');
		$ci = $this->db->join('comment_blog','blog.blog_id = comment_blog.blog_id', 'left');*/
		if ($paging == "true") {
			$this->db->limit($perpage,$start);
		}
		$this->db->order_by("date","DESC");
		$query = $this->db->get("blog");
		$this->get_num = $query->num_rows();
		return $query->result_array();
	}
	public function get_comment($id){
		$this->db->order_by("date","ASC");
		$this->blog_model->join("user","user.user_id = comment_blog.user_id","LEFT");
		$query = $this->db->get_where("comment_blog",array("blog_id"=>$id));
		return $query->result_array();
	}
	public function get_reply($id){
		$this->db->order_by("rcb_date","ASC");
		$this->blog_model->join("user","user.user_id = reply_comment_blog.user_id","LEFT");
		$query = $this->db->get_where("reply_comment_blog",array("id_comment_blog"=>$id));
		return $query->result_array();
	}
	
	public function get_blog_specs($id){
		$data = array('blog_id' => $id);
		$query = $this->db->get_where("blog", $data);
		return $query->row_array();
	}

	public function get_new_post(){
		$this->db->order_by("date","DESC");
		$query = $this->db->get_where("blog", array('status' => 'publish'),8,0);
		return $query;
	}
	public function get_top_post(){
		$this->db->order_by("lihat","DESC");
		$query = $this->db->get_where("blog", array('status' => 'publish'),8,0);
		return $query;
	}

	public function get_relevan_post($id,$judul){
		$query = $this->db->get_where("blog", array('status' => 'publish','blog_id !='=>$id));

		$data = [];
		foreach ($query->result_array() as $key => $value) {
			similar_text($judul, $value['judul'], $result);
			if ($result > 25) {
				# code...
			$data[] = ["slug"=>$value['blog_slug'],"judul"=>$value['judul']];
			}
		}
		return $data;
	}


	public function blog_arsip(){
		$query = $this->db->query("SELECT SUBSTRING(date,1,7) FROM `blog` GROUP BY SUBSTRING(date,1,7) ORDER BY date DESC");
		return $query;
	}

	public function update(){
		$id = $this->input->post('blog_id');
		$str = $this->input->post('judul');
		#check data berdasarkan slug
		$str_low = strtolower($str);
		$cleared = str_replace(array('|', '"', ',' , ';', '<', '>','?','!','@','$','^','&','*','(',')','-','+','=','{','}','[',']','.','/','!','~','`' ), ' ', $str_low);
		$str_replace = str_replace("  ", "", $cleared);
		$str_replace = str_replace(" ", "-", $str_replace);

			/*check query*/
			$query = $this->db->get_where("blog", array("blog_id !=" =>$id,"blog_slug" => $str_replace));
			if ($query->num_rows() > 0) {
				$slug = $str_replace."-".time();
			}
			else{
				$slug = $str_replace;	
			}


		$value['blog_slug'] = filter_char($slug);
		$value['judul'] = ucwords($str);
		
		$value['hastag'] = $this->input->post('hastag');
		$value['meta_des'] = $this->input->post('meta_des');
		$value['deskripsi'] = ucfirst($this->input->post('deskripsi'));
		$value['status'] = $this->input->post('status');

		$value['format'] = $this->input->post('format');
		$value['category_id'] = $this->input->post('category_id');

		$arrayValidate = ['Judul tidak boleh kosong' => $str,'Meta'];
		if (!empty($resultValidate)) {
			die(json_encode(array('status'=>'required','message' => $resultValidate)));
			
		}

		$this->db->where("blog_id", $id);
		$query = $this->db->update("blog", $value);
		if ($query) {
			die(json_encode(array('status' => 'ok','slug' => $value['blog_slug'])));
		}

	}
	public function add(){
		$str = $this->input->post('judul');


		#check data berdasarkan slug
		$str_low = strtolower($str);
		$cleared = str_replace(array('|', '"', ',' , ';', '<', '>','?','!','@','$','^','&','*','(',')','-','+','=','{','}','[',']','.','/','!','~','`' ), '', $str_low);
		$str_replace = str_replace("  ", "", $cleared);
		$str_replace = str_replace(" ", "-", $str_replace);
			/*check query*/
			$query = $this->db->get_where("blog", array("blog_slug" => $str_replace,"date"=>date("Y-m-d")));
			if ($query->num_rows() > 0) {
				$slug = $str_replace."-".time();
			}
			else{
				$slug = $str_replace;	
			}


		$value['blog_slug'] = filter_char($slug);
		$value['judul'] = ucwords($str);
		$value['blog_id'] = time();
		$value['admin_id'] = $this->session->userdata("admin_id");
		$value['hastag'] = $this->input->post('hastag');
		$value['meta_des'] = $this->input->post('meta_des');
		$value['deskripsi'] = ucfirst($this->input->post('deskripsi'));
		$value['status'] = $this->input->post('status');
		$value['date'] = date('Y-m-d');
		$value['time'] = date('H:i:s');

		$arrayValidate = ['Judul tidak boleh kosong' => $str];
		$resultValidate = $this->validate_form($arrayValidate);
		$value['format'] = $this->input->post('format');
		$value['category_id'] = $this->input->post('category_id');

		if (!empty($resultValidate)) {
			die(json_encode(array('status'=>'required','message' => $resultValidate)));
			
		}

		$query = $this->db->insert("blog", $value);
		if ($query) {
			die(json_encode(array('status' => 'ok','slug' => $value['blog_slug'])));
		}
	}

	public function list_blog($perpage = NULL,$start = NULL){
		$this->db->order_by("date","DESC");
		$this->db->limit($perpage,$start);
		$this->db->join("admin","admin.admin_id = blog.admin_id","LEFT");
		$query = $this->db->get_where("blog", array('blog.status' => 'publish','blog.format' => 'artikel'));
		return $query;
	}

	public function list_tag($match = NULL){
		$this->db->order_by("date","DESC");
		$this->db->join("admin","admin.admin_id = blog.admin_id","LEFT");
		$query = $this->db->get_where("blog", array('blog.status' => 'publish'));


		$data = [];
		foreach ($query->result_array() as $key => $value) {
			similar_text($match, $value['judul'], $result);
			if ($result > 60) {
				# code...
			$data[] = ["blog_slug"=>$value['blog_slug'],
						"judul"=>$value['judul'],
						"deskripsi"=>$value['deskripsi'],
						"date"=>$value['date'],
						"first_name"=>$value['first_name'],
						];
			}
		}

		return $data;
	}

	private function validate_form($array){
		$push = array();
		foreach ($array as $key => $value) {
			if (empty($value)) {
				$push[] = $key;
			}
		}
		return $push;
	}
	

}


?>