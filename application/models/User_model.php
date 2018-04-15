<?php 


class User_model extends CI_model
{
	
	#table user
	#select
	public function check_user(){
		$query = $this->db->get("user");
		return $query->result_array();
	}

	#table user
	#select
	#login
	public function get_user_login($array){
		$query = $this->db->get_where("user", $array);
		return $query->row_array();
	}


	#table user
	#select max
	public function check_user_max(){
		$this->db->select_max("user_id");
		$query = $this->db->get("user");
		return $query->row_array();
	}


	#Table user
	#insert
	public function insert_user($array){
		$query = $this->db->insert("user",$array);
		return $query;
	}

	#Table testimoni
	#insert
	public function insert_testi($array){
		$query = $this->db->insert("testimoni",$array);
		return $query;
	}

	#table auth
	#insert
	public function insert_auth($array){
		$this->db->insert("auth",$array);
	}

	#table user
	#select
	public function check_email($array){
		$query = $this->db->get_where("user",$array);
		return $query->row_array();
	}

	#table auth
	#select
	#check access token
	public function check_auth($array){
		$this->db->order_by("auth_id", "DESC");
		$query = $this->db->get_where("auth",$array);
		return $query->row_array();
	}


	#table user
	#update
	public function update_user($user_id,$array){
		$this->db->where("user_id",$user_id);
		$query = $this->db->update("user",$array);
		return $query;
	}

	#table user
	#update
	#check after verification
	public function update_user_status($array,$user_id){
		$this->db->where("user_id",$user_id);
		$query = $this->db->update("user",$array);
		return $query;
	}

	public function getUserModel($user_id){
		$query = $this->db->get_where("user", array("user_id"=>$user_id));

		return $query->row_array();
	}

	public function get_image($arr){
		$query = $this->db->get_where("image_post", $arr);
		return $query->result_array();	
	}

	public function insert_image($array){
		$query = $this->db->insert("image_post", $array);
		return $query;
	}



	public function get_where($table, $array){
		$query = $this->db->get_where($table,$array);
		return $query;
	}
	public function get_table($table){
		$query = $this->db->get($table);
		return $query;
	}
	public function update($table, $array,$where,$init){
		$this->db->where($where,$init);
		$query = $this->db->update($table,$array);
		return $query;
	}
	public function insert($table,$array){
		$query = $this->db->insert($table,$array);
		return $query;
	}
	public function join($table,$field,$join){
		$query = $this->db->join($table,$field,$join);
		return $query;
	}

	public function order_by($field,$sort = "DESC"){
		$query = $this->db->order_by($field,$sort);
		return $query;
	}

	public function member_datatable($array){

		$requestData= $_REQUEST;
		$this->db->limit($requestData['length'],$requestData['start']);

		$ex =  $this->db->get_where("user",$array);
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("user",$array)->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("email",$src);
		    $this->db->or_like("name",$src);
		    $this->db->or_like("address",$src);
		    $d = $this->db->get_where("user",$array);
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$d = $this->db->get_where("user",$array);
		    $query = $d->result_array();
		    
		}




		$data = array();

		foreach ($query as $key => $row) {
			$nestedData=array(); 
		    

	    	$nestedData[] = '<a target="_blank" href="'.$row['picture'].'"><img class="img-50" src="'.$row['picture'].'"></a>';
	    	$nestedData[] = $row['name']."<br>".$row['email']."<br>".$row['user_id'];
	    	$nestedData[] = $row['phone'];
	    	$nestedData[] = $row['user_gender'];
	    	$nestedData[] = $row['address'];
	    	$nestedData[] = $row['join_date'];
	    	$nestedData[] = $row['status'];
	    	$nestedData[] = $row['provider'];
	    	
		    /*
			End
		    */

		    $data[] = $nestedData;
			}


		    $json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalFiltered ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );


			return json_encode($json_data);  // send data as json format

	}

	public function clear_notif(){
		$user_id = $this->session->userdata("user");
		$this->db->where("user_id",$user_id);
		$query = $this->db->update("notif_user",array("notif_user_status" => "read"));
	}
}

?>