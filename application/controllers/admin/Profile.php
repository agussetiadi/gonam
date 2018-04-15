<?php

/**
* 
*/
class Profile extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('upload_file');

	}
	public function index(){

		$admin_id = $this->session_admin->admin_id();
		$query = $this->db->get_where('admin', array('admin_id' => $admin_id)) -> row_array();
		$data['query'] = $query;

		$data['page'] = 'admin/profile';
		$this->template->get_view($data);
	}

	public function render_akun(){

	}

	public function upload_image(){
		$path = "assets/img/admin/";
		$file = "fil_pp";
		$newName = time();
		$result = $this->upload_file->upload_image($path,$file,$newName);
		echo json_encode(array('status' => 'ok','data' => $result['data'],'thumb' => $result['thumb']));
	}

	public function save_image(){
		$admin_foto = $this->input->post('admin_foto');
		$admin_id = $this->session_admin->admin_id();

		$this->db->where('admin_id', $admin_id);
		$query = $this->db->update('admin',['admin_foto' => $admin_foto]);
		if ($query) {
			$this->session->set_userdata('admin_foto', $admin_foto);
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function change_password(){
		$password = $this->input->post('password');
		$pw2 = $this->input->post('pw2');
		$pw3 = $this->input->post('pw3');

		$admin_id = $this->session_admin->admin_id();
		$query1 = $this->db->get_where('admin', array('admin_id' => $admin_id,'password' => $password))->num_rows();
		if ($query1 == 0) {
			die(json_encode(array('status' => 'notValid')));
		}
		if ($pw2 !== $pw3) {
			die(json_encode(array('status' => 'notMatch')));
		}


		$this->db->where('password', $password);
		$query2 = $this->db->update('admin',['password' => $pw2]);
		if ($query2) {
			session_destroy();
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function change_name(){
		$first_name = $this->input->post('first_name');
		$admin_id = $this->session_admin->admin_id();
		$this->db->where('admin_id',$admin_id);
		$query = $this->db->update('admin', array('first_name' => $first_name));
		$this->session->set_userdata('admin_name',$first_name);
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function change_username(){
		$username = $this->input->post('username');
		$admin_id = $this->session_admin->admin_id();
		$query = $this->db->get_where("admin",["username" => $username,"is_deleted" => 0])->num_rows();
		if ($query == 0) {
			$this->session->set_userdata('user_name',$username);

			$this->db->where('admin_id', $admin_id);
			$this->db->update("admin",array('username' => $username));
			echo json_encode(['status' => 'ok']);
		}
		else{
			echo json_encode(['status' => 'notValid']);	
		}
	}

}