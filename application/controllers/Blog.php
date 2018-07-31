<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Blog extends CI_controller
{
	
	function __construct()
	{	
		parent::__construct();
		$this->load->model("blog_model");
		$this->load->library("user_template");
		$this->load->library("user");
		$this->load->library('pagination');
		$this->load->library('send_notif');
	}

	public function index(){
		
	}
	public function view($start = 0){
		$data['title'] = "Blog | Gonam Aqiqah";		

		$perpage = 6;
		$query = $this->blog_model->list_blog($perpage,$start);
		$num = $this->blog_model->list_blog()->num_rows();

		if ($start !== 0) {
			$start = $start*$perpage - $perpage;
		}
		else{
			$start = 0;
		}


		$data['links'] = $this->get_paging($num,$perpage,base_url()."blog/view/");
		$data['query'] = $query;
		$data['num'] = $num;

		$get_image = array();
		$get_des = array();
		$doc = new DOMDocument();

		// set error level
		$internalErrors = libxml_use_internal_errors(true);

		
		foreach ($query->result_array() as $key => $value) {
			$deskripsi = $value['deskripsi'];


			$doc->loadHTML($deskripsi);


			$filter = NULL;
			$tags = $doc->getElementsByTagName('img');
			$p = $doc->getElementsByTagName('p');
			foreach($tags as $key2 => $link) {
		        $filter[] = $link->getAttribute('src');
		  	}
		  	
		  	foreach ($p as $key_p => $value_p) {
		  		$set_p[$key_p] = $value_p->nodeValue;
		  		
		  	}

		  	foreach ($set_p as $key_s => $value_s) {
		  		$get_p = $value_s;
		  		if (!empty($value_s)) {
		  			break;
		  		}
		  	}
		  	


		  	$img_link = $filter[0];
		  	if (!empty($img_link)) {
				$get_image[] = '<img class="img-flex img-responsive" src="'.$img_link.'">';
		  		
		  	}
		  	else{
		  		$get_image[] = '<img class="img-no-flex img-responsive" src="'.base_url()."assets/img/im.png".'">';
		  	}

		  	$data['get_des'][$key] = $get_p;

		}
		// Restore error level
		libxml_use_internal_errors($internalErrors);
		
		$data['get_image'] = $get_image;
		$data['page'] = 'blog_list';

		$data2['title'] = "Blog | Gonam Aqiqah";
		$this->user_template->get_view($data,$data2);
	}

	public function tag(){
		$perpage = 5;
		$start = $this->input->get("page");
		if ($this->input->get("page")) {
			$start = $this->input->get("page")*$perpage - $perpage;
		}
		else{
			$start = 0;
		}

		$q = $this->input->get("q");
		$query = $this->blog_model->list_tag($q);

		$data['query'] = $query;

		$get_image = array();
		$get_des = array();
		$doc = new DOMDocument();
		$internalErrors = libxml_use_internal_errors(true);
		foreach ($query as $key => $value) {
			$deskripsi = $value['deskripsi'];


			$doc->loadHTML($deskripsi);


			$filter = NULL;
			$tags = $doc->getElementsByTagName('img');
			$p = $doc->getElementsByTagName('p');
			foreach($tags as $key2 => $link) {
		        $filter[] = $link->getAttribute('src');
		  	}
		  	$get_des[] = $p[0]->nodeValue;


		  	$img_link = $filter[0];
		  	if (!empty($img_link)) {
				$get_image[] = '<img class="img-flex img-responsive" src="'.$img_link.'">';
		  		
		  	}
		  	else{
		  		$get_image[] = '<img class="img-no-flex img-responsive" src="'.base_url()."assets/img/im.png".'">';
		  	}


		}
		libxml_use_internal_errors($internalErrors);
		$data['get_des'] = $get_des;
		$data['get_image'] = $get_image;
		$data['page'] = 'tag_list';
		$this->user_template->get_view($data);
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

	public function get_blog($slug){
		$this->db->join("admin", "admin.admin_id = blog.admin_id","LEFT");
		$getBlog = $this->db->get_where("blog", array('blog_slug' => $slug ))->row_array();
		$id = $getBlog['blog_id'];

		if (count($getBlog) == 0) {
			redirect(base_url()."blog/view/");
		}


		$title = $getBlog['judul']." | Gonam Aqiqah";

		$getComment = $this->blog_model->get_comment($id);
		$data['get_comment'] = $getComment;
		$data['num_comment'] = count($getComment);

		
		$set_lihat = $getBlog['lihat'] + 1;

		$this->db->where("blog_id", $id);
		$this->db->update("blog", array('lihat' => $set_lihat));	

		$explode = explode(",", $getBlog['hastag']);
		$get_tag = NULL;
		foreach ($explode as $key => $value) {
				$get_tag .= '<a style="color:white;" href="'.base_url().'blog/tag?q='.$value.'"><div class="hastag">'.$value.'</div></a>';
		}
		$data['get_tag'] = $get_tag;


		$set_user = [];
		$set_foto = [];
		$set_user2 = [];
		$set_foto2 = [];

		foreach ($getComment as $key1 => $value1) {
			$id_comment_blog = $value1['id_comment_blog'];
			$user_id = $value1['user_id'];
			$picture = $value1['picture'];
			if (empty($user_id)) {
				$set_user[$key1] = "<i>Admin</i>";
				$set_foto[$key1] = base_url()."assets/img/"."male.jpg";
			}
			else{
				$set_user[$key1] = $value1['name'];
				if (empty($picture)) {
					$set_foto[$key1] = base_url()."assets/img/"."male.jpg";	
				}
				else{
					if (file_exists("assets/img/".$picture)) {
						$set_foto[$key1] = base_url()."assets/img/".$picture;
					}
					else{
						$set_foto[$key1] = $picture;	
					}
				}
			}

			$query3 = $this->blog_model->get_reply($id_comment_blog);
			$data['get_reply'][] = $query3;
			foreach ($query3 as $key3 => $value3) {
				$user_id3 = $value3['user_id'];
				$picture3 = $value3['picture'];

				if (empty($user_id3)) {
					$set_user2[$key1][$key3] = "<i>Admin</i>";
					$set_foto2[$key1][$key3] = base_url()."assets/img/"."male.jpg";
				}
				else{
					$set_user2[$key1][$key3] = $value3['name'];
					if (empty($picture3)) {
						$set_foto2[$key1][$key3] = base_url()."assets/img/"."male.jpg";	
					}
					else{
						if (file_exists("assets/img/".$picture3)) {
							$set_foto2[$key1][$key3] = base_url()."assets/img/".$picture3;
						}
						else{
							$set_foto2[$key1][$key3] = $picture3;	
						}
					}
				}

			}

		}


		$sisip_hrg = $getBlog['category_id'];
		/*
		Get Sisipan Harga OPEN
		*/
		if ($sisip_hrg != 0) {
			$query_sisip1 = $this->db->get_where("pos_product",array("category_id"=>$sisip_hrg,"is_deleted"=>0, 'is_publish' => 1));
			$data['query_sisip'] = $query_sisip1->result_array();
		}
		else{
			$data['query_sisip'] = [];
		}


		
		/*CLOSE*/




		$data['set_user'] = $set_user;
		$data['set_foto'] = $set_foto;
		$data['set_user2'] = $set_user2;
		$data['set_foto2'] = $set_foto2;

		$data['blog_id'] = $id;

		$data['admin'] = $this->user->admin($getBlog['admin_id']);

		$user_id = $this->session->userdata("user");
		$data['user_query'] = $this->user->member($user_id);


		/*
		New Artikel
		*/
		$new_artikel = $this->blog_model->get_new_post();
		$data['new_artikel'] = $new_artikel;

		$top_artikel = $this->blog_model->get_top_post();
		$data['top_artikel'] = $top_artikel;

		$relevan_artikel = $this->blog_model->get_relevan_post($getBlog['blog_id'],$getBlog['judul']);
		$data['relevan_artikel'] = $relevan_artikel;

		$data['get_blog'] = $getBlog;
		$data['page'] = 'blog';
		$data['blog_title'] = $getBlog['judul'];

		$data2['template_meta_des'] = $getBlog['meta_des'];
		$data2['title'] = $getBlog['judul']." | Gonam Aqiqah";


		$this->user_template->get_view($data,$data2);
	}




	public function reply_post(){
		$id_comment_blog = $this->input->post("id_comment_blog");
		$rcb_comment = $this->input->post("rcb_comment");
		$link = $this->input->post("link");
		$rcb_date = date("Y-m-d");
		$rcb_time = date("H:i:s");


		$user_id = $this->session->userdata("user");
		$admin_id = $this->session->userdata("admin_id");

		if (!empty($admin_id)) {
			$user_id = NULL;

		}
		else{
			$admin_id = NULL;			

		}




		$array =  array('id_comment_blog' =>$id_comment_blog , 'rcb_comment'=>$rcb_comment,'user_id'=>$user_id,'admin_id'=>$admin_id,'rcb_date'=>$rcb_date,'rcb_time'=>$rcb_time);
		$query = $this->blog_model->insert("reply_comment_blog",$array);

			/*START NOTIFIKASI*/

			/*Send ke User*/
			/*Grouping User
			mengirim notifikasi ke User
			dengan cara mengrouping
			*/
			$get_comment = $this->blog_model->get_data("comment_blog", array("id_comment_blog" => $id_comment_blog))->row_array();
			$user_comment = $get_comment['user_id']; 
			$admin_comment = $get_comment['admin_id'];



			/*Mengirim Notif Ke user yang berkomentar*/
			if ($user_comment != NULL && $user_comment != $user_id) {
				$this->send_notif->user($get_comment['user_id'],"Seseorang Membalas Komentar Anda",$link);
			}
			elseif ($admin_comment != NULL && $admin_comment != $admin_id) {
				$this->send_notif->admin($get_comment['admin_id'],"Seseorang Membalas Komentar Anda",$link);
			}


			/*Mengririm notif ke user yang memberi reply komentar*/
			$this->blog_model->grouping("user_id");
			$get_reply = $this->blog_model->get_data("reply_comment_blog", array("id_comment_blog" => $id_comment_blog));

			foreach ($get_reply->result_array() as $key => $value) {

				/*
				Kirim Notif Jika
				pengirim != pengomentar
				pengirim != Pembalas komentar
				*/
				if ($value['user_id'] != NULL && $user_id != $value['user_id'] && $value['user_id'] != $user_comment) {
					/*kirim notif ke user jika*/
					$this->send_notif->user($value['user_id'],"Seseorang Membalas Komentar Anda",$link);
				}
			}


			/*Mengririm notif ke Admin yang memberi reply komentar*/
			$this->blog_model->grouping("admin_id");
			$get_reply = $this->blog_model->get_data("reply_comment_blog", array("id_comment_blog" => $id_comment_blog));

			foreach ($get_reply->result_array() as $key => $value) {

				/*
				Kirim Notif Jika
				pengirim != pengomentar
				pengirim != Pembalas komentar
				*/
				if ($value['admin_id'] != NULL && $admin_id != $value['admin_id'] && $value['admin_id'] != $admin_comment) {
					/*kirim notif ke user jika*/
					$this->send_notif->admin($value['admin_id'],"Seseorang Membalas Komentar Anda",$link);
				}
			}




		if ($query) {
			echo json_encode(array('status' =>'success' ));
		}
	}

	public function delete_reply($id){
		$array  = array('rcb_id' => $id);
		$query = $this->blog_model->delete_data("reply_comment_blog",$array);
		if ($query) {
			echo json_encode(array('status' =>'success'));	
		}

	}

	public function delete_comment($id){
		$array  = array('id_comment_blog' => $id);
		$query = $this->blog_model->delete_data("comment_blog",$array);
		if ($query) {
			echo json_encode(array('status' =>'success'));	
		}

	}

	public function comment_post(){
		$blog_id = $this->input->post("blog_id");
		$comment = $this->input->post("comment");
		$link = $this->input->post("link");
		$user_id = $this->session->userdata("user");
		$admin_id = $this->session->userdata("admin_id");




		if (!empty($admin_id)) {
			$user_id = NULL;
		}
		else{
			$admin_id = NULL;
			$get_blog = $this->blog_model->get_data("blog" ,array('blog_id' => $blog_id))->row_array();
			$get_admin = $get_blog['admin_id'];
			$this->send_notif->admin($get_admin,"Seseorang Mengomentari Postingan Anda",$link);
		}




		$date = date("Y-m-d");
		$time = date("H:i:s");
		$array = array('blog_id' =>$blog_id,'user_id' =>$user_id,'admin_id' =>$admin_id,'comment' =>$comment,'date' =>$date,'time' =>$time);
		$query = $this->blog_model->insert("comment_blog",$array);
		if ($query) {
			echo json_encode(array('status' =>'success' ));
		}	


	}



	public function comment_access(){
		$id = $this->input->get("init");
		$continue = $this->input->get("continue");
		if (!empty($this->session->userdata("user")) || !empty($this->session->userdata("admin_id"))) {
			echo '

			<div class="col-md-12" style="margin-top: 40px;">
				<form class="form_ajax" method="POST" action="'.base_url()."blog/reply_post/".'">
				<label>Tuliskan Komentar</label>
				<input type="hidden" value="'.$id.'" name="id_comment_blog">
				<input type="hidden" name="link" class="link">
				<textarea name="rcb_comment" required style="margin-bottom: 20px;" class="form-control" placeholder="Tuliskan sesuatu"></textarea>
				<button class="div-lainnya2">Kirim</button>
				<button type="button" class="btn-cancel div-lainnya2">Batal</button>
				</form>
			</div>';
		}
		else{
			echo '<a href="'.base_url()."login?continue=".$continue.'"><button style="margin-top:15px;" class="div-lainnya2">Silahkan Login Dulu</button></a>';
		}
	}





}



?>