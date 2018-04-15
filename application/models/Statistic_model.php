<?php 

/**
* 
*/
class Statistic_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function get_data_group($open){
		$query = $this->db->query("SELECT * FROM order_kambing WHERE order_status = 'Process' AND date_deliver >= '".$open."' GROUP BY date_deliver");
		return $query;
	}
	public function get_data_group_bulan($open){
		$query = $this->db->query("SELECT * FROM order_kambing WHERE order_status = 'Process' AND SUBSTRING(date_deliver,1,7) >= '".$open."' GROUP BY SUBSTRING(date_deliver, 1,7)");
		return $query;
	}
	public function get_data_group_tahun($open){
		$query = $this->db->query("SELECT * FROM order_kambing WHERE order_status = 'Process' AND SUBSTRING(date_deliver,1,4) >= '".$open."' GROUP BY SUBSTRING(date_deliver, 1,4)");
		return $query;
	}
	public function select($table,$array){
		$query = $this->db->get_where($table, $array);
		return $query;
	}
	public function min_order(){
		$this->db->select_min("date_deliver");
		$query = $this->db->get_where("order_kambing", array('date_deliver !=' => "0000" ));
		$get = $query->row_array();
		$result = substr($get['date_deliver'], 0,4);
		return $result;
	}

	public function activity_server(){
		$requestData= $_REQUEST;

		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->order_by("activity_date","DESC");
		$this->db->order_by("activity_time","DESC");
		$ex =  $this->db->get("activity");
		$query = $ex->result_array();

		$totalFiltered = $this->db->get("activity")->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("user_id",$src);
		    $this->db->or_like("activity_date",$src);
		    $this->db->or_like("activity_time",$src);
		    $this->db->or_like("activity_link",$src);
		    $d = $this->db->get("activity");
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$d = $this->db->get("activity");
		    $query = $d->result_array();
		    
		}




		$data = array();

		foreach ($query as $key => $row) {
			$nestedData=array(); 

			$nestedData[] = $key+1;
	    	$nestedData[] = $row['user_id'];
	    	$nestedData[] = $row['activity_ip'];
	    	$nestedData[] = $row['activity_date']." ".$row['activity_time'];;
	    	$nestedData[] = $row['activity_page'];
	    	$nestedData[] = $row['activity_link'];
	    	$nestedData[] = $row['activity_browser'];

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
}


?>