<?php 

/**
* 
*/
class Send_notif extends CI_model
{
	
	function __construct()
	{
		parent::__construct();

	}
	public function admin($admin_id,$message,$link = NULL){
		$arr =  array('admin_id' => $admin_id,"notif_admin_message"=>$message,"notif_admin_link" =>$link, "notif_admin_date" => date("Y-m-d"),"notif_admin_time" => date("H:i:s"),"notif_admin_status" => "unread");
		$query = $this->db->insert("notif_admin",$arr);
		return $query;
	}
	public function user($user_id,$message,$link = NULL){
		$arr =  array('user_id' => $user_id,"notif_user_message"=>$message,"notif_user_link" =>$link, "notif_user_date" => date("Y-m-d"),"notif_user_time" => date("H:i:s"),"notif_user_status" => "unread");
		$query = $this->db->insert("notif_user",$arr);
		return $query;
	}
}

?>