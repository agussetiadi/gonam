<?php 

/**
* 
*/
class Blog_model extends CI_model
{
	public $get_num;
	private $auto_number;

	public function get_comment($id){
		$this->db->order_by("date","ASC");
		$this->db->join("user","user.user_id = comment_blog.user_id","LEFT");
		$query = $this->db->get_where("comment_blog",array("blog_id"=>$id));
		return $query->result_array();
	}
	public function get_reply($id){
		$this->db->order_by("rcb_date","ASC");
		$this->db->join("user","user.user_id = reply_comment_blog.user_id","LEFT");
		$query = $this->db->get_where("reply_comment_blog",array("id_comment_blog"=>$id));
		return $query->result_array();
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
		
		$query = $this->db->get_where("blog", array('status' => 'publish','blog_id !='=>$id),8,0);

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