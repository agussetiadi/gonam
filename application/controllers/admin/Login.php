<?php 
/**
* 
*/
class Login extends CI_controller
{
	public function index(){
		$admin_sess = $this->session->userdata('admin_id');

		if (empty($admin_sess)) {
			$this->load->view('admin/login');
		}

		else{
			$isi['content'] = 'blog';
			$this->load->view('admin/home', $isi);
		}
	}
	public function check_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','password','required');
			if ($this->form_validation->run() === false) {
				$this->load->view('admin/login');
			}
			else{
				$this->load->model('admin/login_model');
				$this->login_model->get_login($username,$password);
			}

	}
}
?>