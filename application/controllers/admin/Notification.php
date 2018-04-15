<?php 

/**
* 
*/
class Notification extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('session_admin');
		$this->load->model("admin/notification_model");
	}
	public function get_notif(){
		$admin_id = $this->session_admin->admin_id();
		$query_notif = $this->db->get_where("notif_admin", array('admin_id' => $admin_id,'notif_admin_status' => 'unread'))->num_rows();

		echo $query_notif;
	}

	public function render_notif(){
		$admin_id = $this->session_admin->admin_id();
		$this->db->order_by("notif_admin_date","DESC");
		$this->db->order_by("notif_admin_time","DESC");
		$query_notif = $this->db->get_where("notif_admin", array('admin_id' => $admin_id));

		$this->db->where(array('admin_id' => $admin_id, "notif_admin_status" => "unread"));
		$this->db->update("notif_admin", array('notif_admin_status' =>"read" ));

		$this->load->view('admin/notification',array('query' => $query_notif));
	}
	public function order_by($field,$sort = "DESC"){
		$query = $this->db->order_by($field,$sort);
		return $query;
	}

}


?>