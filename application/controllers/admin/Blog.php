<?php 

/**
* 
*/
class Blog extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");
		$this->load->library("upload_file");
		$this->load->model("admin/blog_model");

	}

	public function index(){
		$data['page'] = 'admin/blog';
		$this->template->get_view($data);
	}

	public function render_blog(){
		$requestData 	= $_POST;
		$arr = array("blog.status" => 'publish');
		
		if( !empty($requestData['search']) ) {

		    // if there is a search parameter

		    $this->db->order_by($requestData['field'],$requestData['sort']);
		    $this->db->limit($requestData['length'],$requestData['start']);


		    $this->db->like("judul",$requestData['search']);
		    $this->db->or_like("deskripsi",$requestData['search']);
		    $this->db->join("admin", "admin.admin_id = blog.admin_id", "INNER");
		    $d = $this->db->get_where("blog", $arr);
		    $query = $d->result_array();


		    $this->db->like("judul",$requestData['search']);
		    $this->db->or_like("deskripsi",$requestData['search']);
		    $this->db->join("admin", "admin.admin_id = blog.admin_id", "INNER");
		   	$totalFiltered = $this->db->get_where("blog", $arr)->num_rows();
		    
		} 
		else{
		    $this->db->join("admin", "admin.admin_id = blog.admin_id", "INNER");
			$this->db->order_by($requestData['field'],$requestData['sort']);
			$this->db->limit($requestData['length'],$requestData['start']);

			$ex =  $this->db->get_where("blog", $arr);
			$query = $ex->result_array();

			$this->db->join("admin", "admin.admin_id = blog.admin_id", "INNER");
			$totalFiltered = $this->db->get_where("blog", $arr)->num_rows();	
		}



		$data = [];
		foreach ($query as $key => $value) {
			$nested = [];
			$path = admin_url()."blog/manage/".$value['blog_id'];

			$btn = '<a href="'.admin_url().'blog/manage/'.$value['blog_id'].'"><button class="btn btn-sm btn-info"><span class="fa fa-pencil"></span></button></a>';
			$btn .= ' <a target="new_blank" href="'.base_url().'post/'.$value['blog_slug'].'"><button class="btn btn-sm btn-primary"><span class="fa fa-external-link-square"></span></button></a>';
			$btn .= ' <a class="bDelete" data-value="'.$value['blog_id'].'"><button class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></button></a>';


			$num_comments = $this->db->get_where("comment_blog", array('blog_id' => $value['blog_id']))->num_rows();

			$nested[] = intval($requestData['start'] + 1) + $key;
			$nested[] = '<a style="color:#666" href="'.$path.'">'.$value['judul']."<br><i>".str_replace(",", " #", $value['hastag'])."</i>";
			$nested[] = $value['first_name'];
			$nested[] = $value['lihat'].'<span style="margin-left:5px;" class="fa fa-eye"><span> ';
			$nested[] = $num_comments.'<span style="margin-left:5px;" class="fa fa-comment"><span> ';;
			$nested[] = str_replace("-", "/", $value['date']).'</a>';
			$nested[] = $btn;
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		echo json_encode($json);
	}

	public function manage($blog_id = NULL){
		$data['blog_id'] = $blog_id;
		$data['page'] = 'admin/manage_blog';
		$data['query_category'] = $this->db->get_where("pos_category", array("is_deleted" => 0))->result_array();

		$this->template->get_view($data);
	}
	public function get_blog(){
		$blog_id = $this->input->post("blog_id");
		$query = $this->db->get_where("blog", array("blog_id" => $blog_id))->row_array();
		echo json_encode(array('status' => 'ok', 'data' => $query));
	}

	public function add(){
		$this->blog_model->add();
	}
	public function update(){
		$this->blog_model->update();
	}
	public function delete(){
		$blog_id = $this->input->post("blog_id");
		$this->db->where("blog_id",$blog_id);
		$query = $this->db->delete("blog");
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}
	public function upload_image(){
		$path = 'assets/img/post_img/';
		$file = "file_init";
		$newName = time();
		$upload = $this->upload_file->upload_image($path,$file,$newName);
		$created_by = $this->session_admin->admin_name();
		$created = date("Y-m-d");

		if ($upload['status'] == 'ok') {
			$this->db->insert('image_post',['src' => $upload['data'],'alt' => $upload['data'],'image_thumb' => $upload['thumb'],'image_category' => 'posting']);

			echo json_encode($upload);
		}
		else{
			echo json_encode(array('status' => 'failed'));
		}
	}
	public function get_img_post(){
		$arr = array("image_post_id >" => 0);
		$this->db->order_by("image_post_id","DESC");
		$query = $this->db->get_where("image_post", $arr);
		$dataHtml = '<div class="row">';
		foreach ($query->result_array() as $key => $value) {
        
		$dataHtml .= '<div class="col-4"><img src="'.base_url().'assets/img/post_img/'.$value['src'].'" class="img-select img-responsive img-thumbnail"></div>';

		} 
		$dataHtml .= '</div>';

		echo $dataHtml;
	}

}