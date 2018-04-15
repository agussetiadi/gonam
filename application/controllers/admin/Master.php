<?php

/**
* 
*/
class Master extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("admin/master_model");
		$this->load->library("template");
		$this->load->library("upload_file");
	}
	public function index(){

	}
	public function product(){
		$data['page'] = 'admin/master/product';
		$this->template->get_view($data);
	}
	public function product_all(){
		echo $this->master_model->product_all();
	}

	public function render_satuan(){
		$query = $this->db->get_where("pos_unit",array("is_deleted" => 0))->result_array();
		echo json_encode(array("status" => 'ok','data' => $query));
	}
	public function render_category(){
		$query = $this->db->get_where("pos_category",array("is_deleted" => 0))->result_array();
		echo json_encode(array("status" => 'ok','data' => $query));
	}

	public function save_satuan(){
		$admin_name = $this->session_admin->admin_name();
		$created = date("Y-m-d");
		$unit_name = $this->input->post('unit_name');

		$validate = validate_form(array('Nama Satuan' => $unit_name));
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required', 'message' => $validate)));
		}


		$query = $this->db->insert("pos_unit", array("unit_name" => $unit_name,"created_by"=> $admin_name , "created" => $created));
		if ($query) {
			echo json_encode(array("status" => 'ok'));
		}
	}
	public function save_category(){
		$category_name = $this->input->post('category_name');
		$is_publish = $this->input->post('is_publish');

		$validate = validate_form(array('Nama Kategori' => $category_name));
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required', 'message' => $validate)));
		}

		$created = date("Y-m-d");
		$query = $this->db->insert("pos_category", array("category_name" => $category_name,'is_publish' => $is_publish ,'created' => $created));
		if ($query) {
			echo json_encode(array("status" => 'ok'));
		}
	}

	public function add_product(){
		$product_name = $this->input->post("product_name");
		$unit_id = $this->input->post("unit_id");
		$category_id = $this->input->post("category_id");
		$product_price = $this->input->post("product_price");
		$product_hpp = $this->input->post("product_hpp");
		$product_info = $this->input->post("product_info");
		$product_menu = $this->input->post("product_menu");
		$product_picture = $this->input->post("product_picture");
		$is_publish = $this->input->post("is_publish");




		$arrayInsert = array("product_name" => $product_name,
							"unit_id" => $unit_id,
							"category_id" => $category_id,
							"product_price" => $product_price,
							"product_hpp" => $product_hpp,
							"product_menu" => $product_menu,
							"product_picture" => $product_picture,
							"product_info"=> $product_info,
							"is_publish"=> $is_publish);

		$query = $this->db->insert("pos_product", $arrayInsert);
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function update_product(){
		$product_id = $this->input->post("product_id");
		$product_name = $this->input->post("product_name");
		$unit_id = $this->input->post("unit_id");
		$category_id = $this->input->post("category_id");
		$product_price = $this->input->post("product_price");
		$product_hpp = $this->input->post("product_hpp");
		$product_info = $this->input->post("product_info");
		$product_menu = $this->input->post("product_menu");
		$product_picture = $this->input->post("product_picture");
		$is_publish = $this->input->post("is_publish");




		$arrayInsert = array("product_name" => $product_name,
							"unit_id" => $unit_id,
							"category_id" => $category_id,
							"product_price" => $product_price,
							"product_hpp" => $product_hpp,
							"product_menu" => $product_menu,
							"product_picture" => $product_picture,
							"product_info"=> $product_info,
							"is_publish"=> $is_publish);

		$this->db->where("product_id",$product_id);
		$query = $this->db->update("pos_product", $arrayInsert);

		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function product_generate_picture(){
		$path = 'assets/img/post_img/';
		$file = 'picture_init';
		$newName = time();
		$img = $this->upload_file->upload_image($path,$file,$newName);
		if ($img['status'] == 'ok') {
			echo json_encode(array("status"=>'ok','data' => $img['data']));
		}
		else{
			echo json_encode(array("status"=>'error'));	
		}
	}

	public function get_edit_product(){
		$product_id = $this->input->post("product_id");
		$query = $this->db->get_where("pos_product", array("product_id" => $product_id))->row_array();
		if ($query) {
			echo json_encode(array('status' => 'ok','data' => $query));
		}
	}

	public function delete_product(){
		$product_id = $this->input->post("product_id");
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("pos_product",array("is_deleted" => 1));
		if ($query) {
			echo json_encode(array("status" => 'ok'));
		}
	}

	public function user(){
		$data['page'] = 'admin/master/user';
		$this->template->get_view($data);

	}
	public function user_select_all(){
		$provider = $this->input->post("provider");
		$arr = array("provider" => $provider);
		echo $this->master_model->user_select_all($arr);
	}
	public function delete_user(){
		$user_id = $this->input->post("user_id");
		$query = $this->db->delete("user",array("user_id" => $user_id));
		if ($query) {
			echo json_encode(array("status" => 'ok'));
		}

	}
	public function add_user(){
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$phone = $this->input->post("phone");
		$user_gender = $this->input->post("user_gender");
		$address = $this->input->post("address");

		$dataInsert = array("name" => $name,
							"email" => $email,
							"password" => $password,
							"phone" => $phone,
							"user_gender" => $user_gender,
							"address" => $address,
							"join_date" => date("Y-m-d")
							);
		$arrValid = array("Nama" => $name, "Email" => $email,"Password" => $password);

		$validate = validate_form($arrValid);
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required','message' => $validate)));
		}
		$query = $this->db->insert("user", $dataInsert);
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}


	}

	public function get_user(){
		$user_id = $this->input->post("user_id");
		$query = $this->db->get_where("user", array("user_id" => $user_id))->row_array();
		if ($query) {
			echo json_encode(array('status' => 'ok','data' => $query));
		}

	}

	public function update_user(){
		$user_id = $this->input->post("user_id");
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$phone = $this->input->post("phone");
		$password = $this->input->post("password");
		$user_gender = $this->input->post("user_gender");
		$address = $this->input->post("address");

		$dataInsert = array("name" => $name,
							"email" => $email,
							"password" => $password,
							"phone" => $phone,
							"user_gender" => $user_gender,
							"address" => $address
							);
		$arrValid = array("Nama" => $name, "Email" => $email,"Password" => $password);
		$validate = validate_form($arrValid);
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required','message' => $validate)));
		}

		$this->db->where("user_id",$user_id);
		$query = $this->db->update("user", $dataInsert);
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}


	public function unit(){
		$data['page'] = 'admin/master/unit';
		$this->template->get_view($data);
	}

	public function unit_select_all(){
		echo $this->master_model->unit_select_all();
	}

	public function get_unit(){
		$unit_id = $this->input->post("unit_id");
		$query = $this->db->get_where("pos_unit", array("unit_id" => $unit_id))->row_array();
		if ($query) {
			echo json_encode(array('status' => 'ok','data' => $query));
		}
	}

	public function update_satuan(){
		$unit_id = $this->input->post("unit_id");
		$unit_name = $this->input->post("unit_name");

		$validate = validate_form(array('Nama Satuan' => $unit_name));
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required', 'message' => $validate)));
		}

		$this->db->where("unit_id",$unit_id);
		$query = $this->db->update("pos_unit", array("unit_name" => $unit_name));
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}

	}
	public function delete_unit(){
		$unit_id = $this->input->post("unit_id");
		$this->db->where("unit_id",$unit_id);
		$query = $this->db->update("pos_unit", array("is_deleted" => 1));
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}	
	}

	public function category(){
		$data['page'] = 'admin/master/category';
		$this->template->get_view($data);
	}

	public function category_select_all(){
		echo $this->master_model->category_select_all();
	}
	public function update_category(){
		$category_id = $this->input->post("category_id");
		$category_name = $this->input->post("category_name");
		$is_publish = $this->input->post("is_publish");

		$validate = validate_form(array('Nama Kategori' => $category_name));
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required', 'message' => $validate)));
		}

		$this->db->where("category_id",$category_id);
		$query = $this->db->update("pos_category", array("category_name" => $category_name,'is_publish' => $is_publish));
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}

	}
	public function get_category(){
		$category_id = $this->input->post("category_id");
		$query = $this->db->get_where("pos_category", array("category_id" => $category_id))->row_array();
		if ($query) {
			echo json_encode(array('status' => 'ok','data' => $query));
		}
	}
	public function delete_category(){
		$category_id = $this->input->post("category_id");
		$this->db->where("category_id",$category_id);
		$query = $this->db->update("pos_category", array("is_deleted" => 1));
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}	
	}

	public function customer(){
		$data['page'] = 'admin/master/customer';
		$this->template->get_view($data);
	}
	public function customer_select_all(){
		echo $this->master_model->customer_select_all();
	}

	public function save_customer(){
		$admin_name = $this->session_admin->admin_name();
		$created = date("Y-m-d");
		$customer_name = $this->input->post('customer_name');
		$customer_phone = str_replace(" ", "", $this->input->post('customer_phone'));
		$customer_address = $this->input->post('customer_address');

		$validate = validate_form(array('Nama Pelanggan' => $customer_name
										
										));
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required', 'message' => $validate)));
		}

		$this->db->order_by("customer_id","DESC");
		$q_code = $this->db->get('pos_customer',1,0)->row_array();
		$customer_code = "PLG-".intval($q_code['customer_id'] + 1);

		$dataInsert = array("customer_name" => $customer_name,
							"customer_phone" => $customer_phone,
							"customer_code" => $customer_code,
							"customer_address" => $customer_address,
							"created" => $created,
							"created_by" => $admin_name
							);

		$query = $this->db->insert("pos_customer",$dataInsert);
		if ($query) {
			echo json_encode(array("status" => 'ok'));
		}
	}
	public function update_customer(){
		$customer_name = $this->input->post('customer_name');
		$customer_phone = str_replace(" ", "", $this->input->post('customer_phone'));
		$customer_address = $this->input->post('customer_address');
		$customer_id = $this->input->post('customer_id');

		$validate = validate_form(array('Nama Pelanggan' => $customer_name
										
										));
		if (!empty($validate)) {
			die(json_encode(array('status' => 'required', 'message' => $validate)));
		}

		$dataInsert = array("customer_name" => $customer_name,
							"customer_phone" => $customer_phone,
							"customer_address" => $customer_address
							);

		$this->db->where("customer_id",$customer_id);
		$query = $this->db->update("pos_customer",$dataInsert);
		if ($query) {
			echo json_encode(array("status" => 'ok'));
		}
	}
	public function get_customer(){
		$customer_id = $this->input->post("customer_id");
		$query = $this->db->get_where("pos_customer", array("customer_id" => $customer_id))->row_array();
		if ($query) {
			echo json_encode(array('status' => 'ok','data' => $query));
		}
	}

	public function delete_customer(){
		$customer_id = $this->input->post("customer_id");
		$this->db->where("customer_id",$customer_id);
		$query = $this->db->update("pos_customer", array("is_deleted" => 1));
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}	
	}

	public function gallery(){
		$data['page'] = 'admin/master/gallery';
		$this->template->get_view($data);
	}
	public function gallery_select_all(){
		$image_category = $this->input->post("image_category");

		if ($image_category !== "all") {
			$this->db->where("image_category",$image_category);
		}
		$query = $this->db->get("image_post")->result_array();
		echo json_encode(array('status' => 'ok','data' => $query));

	}
	public function gallery_generate_picture(){
		$path = 'assets/img/post_img/';
		$file = 'picture_init';
		$newName = time();
		$img = $this->upload_file->upload_image($path,$file,$newName);
		if ($img['status'] == 'ok') {
			echo json_encode(array("status"=>'ok','data' => $img['data'],'thumb' => $img['thumb']));
		}
		else{
			echo json_encode(array("status"=>'error'));	
		}
	}

	public function add_gallery(){
		$data['src'] = $this->input->post('src');
		$data['image_thumb'] = $this->input->post('image_thumb');
		$data['image_category'] = $this->input->post('image_category');
		$data['created_by'] = $this->session_admin->admin_name();
		$data['created'] = date("Y-m-d");

		$query = $this->db->insert("image_post", $data);
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}

	}
	public function delete_gallery(){
		$image_post_id = $this->input->post('image_post_id');
		$query_get = $this->db->get_where('image_post', array('image_post_id' => $image_post_id))->row_array();
		$src =	$query_get['src'];
		$image_thumb =	$query_get['image_thumb'];
		$query_delete = $this->db->delete('image_post', array('image_post_id' => $image_post_id));
		if ($query_delete) {
			$path = 'assets/img/post_img/';
			if (file_exists($path.$src) || !empty($src)) {
				unlink("assets/img/post_img/".$src);
			}
			if (file_exists($path.$image_thumb) || !empty($image_thumb)) {
				unlink("assets/img/post_img/".$image_thumb);
			}
			echo json_encode(array('status' => 'ok'));
		}
	}
	public function get_gallery(){
		$image_post_id = $this->input->post("image_post_id");
		$query = $this->db->get_where("image_post", array('image_post_id' => $image_post_id))->row_array();
		echo json_encode(array('status' => 'ok','data' => $query));
	}

	public function admin(){
		$data['page'] = 'admin/master/admin';
		$this->template->get_view($data);
	}
	public function admin_select_all(){
		echo $this->master_model->admin_select_all();
	}

	public function admin_generate_picture(){
		$path = 'assets/img/admin/';
		$file = 'picture_init';
		$newName = time();
		$img = $this->upload_file->upload_image($path,$file,$newName);
		if ($img['status'] == 'ok') {
			echo json_encode(array("status"=>'ok','data' => $img['data'],'thumb' => $img['thumb']));
		}
		else{
			echo json_encode(array("status"=>'error'));	
		}
	}

	public function add_admin(){
		$arrayInsert['first_name'] = $this->input->post("first_name");
		$arrayInsert['username'] = $this->input->post("username");
		$arrayInsert['password'] = $this->input->post("password");
		$arrayInsert['level'] = $this->input->post("level");
		$arrayInsert['admin_foto'] = $this->input->post("admin_foto");

		

		$check = $this->db->get_where('admin', array('username' => $arrayInsert['username']))->num_rows();
		$validForm = ['Nama' => $arrayInsert['first_name'],'Username' => $arrayInsert['username'],'Password' => $arrayInsert['password']];
		$required = validate_form($validForm);



		if (!empty($required)) {
			die(json_encode(array('status' => 'required','message' => $required)));
		}
		if ($check > 0) {
			die(json_encode(array('status' => 'validate','message' => ['Username Sudah Dipakai !'])));
		}

		$query = $this->db->insert("admin",$arrayInsert);

		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}
	public function update_admin(){
		$arrayInsert['admin_id'] = $this->input->post("admin_id");
		$arrayInsert['first_name'] = $this->input->post("first_name");
		$arrayInsert['username'] = $this->input->post("username");
		$arrayInsert['password'] = $this->input->post("password");
		$arrayInsert['level'] = $this->input->post("level");
		$arrayInsert['admin_foto'] = $this->input->post("admin_foto");

		$check = $this->db->get_where('admin', array('username' => $arrayInsert['username'],'admin_id !=' => $arrayInsert['admin_id']))->num_rows();
		$validForm = ['Nama' => $arrayInsert['first_name'],'Username' => $arrayInsert['username'],'Password' => $arrayInsert['password']];
		$required = validate_form($validForm);



		if (!empty($required)) {
			die(json_encode(array('status' => 'required','message' => $required)));
		}
		if ($check > 0) {
			die(json_encode(array('status' => 'validate','message' => ['Username Sudah Dipakai !'])));
		}

		$this->db->where("admin_id", $arrayInsert['admin_id']);
		$query = $this->db->update("admin",$arrayInsert);

		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}
	public function get_admin(){
		$admin_id = $this->input->post("admin_id");
		$query = $this->db->get_where("admin", array('admin_id' => $admin_id))->row_array();
		echo json_encode(array('status' => 'ok','data' => $query));
	}

	public function delete_admin(){
		$admin_id = $this->input->post('admin_id');
		$this->db->where("admin_id",$admin_id);
		$query = $this->db->update("admin",array('is_deleted' => 1));
		
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}

	}
}