<?php 

/**
* 
*/
class Promo_model extends Ci_model
{
	
	function __construct()
	{
		parent::__construct();
	}


	public function promo_server(){
		$requestData= $_REQUEST;

		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->order_by("promo_id","DESC");
		$ex =  $this->db->get_where("promo" , array('is_deleted' => 0 ));
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("promo" , array('is_deleted' => 0 ))->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("promo_name",$src);
		    $this->db->or_like("date_start",$src);
		    $this->db->or_like("date_end",$src);
		    $this->db->or_like("date_created",$src);
		    $this->db->or_like("date_updated",$src);
		    $d = $this->db->get_where("promo" , array('is_deleted' => 0 ));
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$d = $this->db->get_where("promo" , array('is_deleted' => 0 ));
		    $query = $d->result_array();
		    
		}




		$data = array();

		foreach ($query as $key => $row) {

			if ($row['promo_status'] == "expired") {
				$btn = "<i class='modal_update'>Disable</>";
			}
			else{
				$btn = '<a class="modal_update" data-toggle="modal" data-target="#modal2" href="#">Update</a>';
			}
			$nestedData=array(); 
			$no = $key+1;
			$nestedData[] = $no.'<input class="promo_id" type="hidden" value="'.$row['promo_id'].'">';
	    	$nestedData[] = $row['promo_kd'].'<input class="promo_kd" type="hidden" value="'.$row['promo_kd'].'">';
	    	$nestedData[] = $row['promo_name'].'<input class="promo_name" type="hidden" value="'.$row['promo_name'].'">';;
	    	$nestedData[] = $row['promo_price'].'<input class="promo_price" type="hidden" value="'.$row['promo_price'].'">';;
	    	$nestedData[] = $row['promo_minpay'].'<input class="promo_minpay" type="hidden" value="'.$row['promo_minpay'].'">';;
	    	$nestedData[] = $row['date_end'].'<input class="date_end" type="hidden" value="'.$row['date_end'].'">';;
	    	$nestedData[] = $row['promo_status'].'<input class="promo_status" type="hidden" value="'.$row['promo_status'].'">';;
	    	
	    	$nestedData[] = $row['date_updated'].'<input class="date_updated" type="hidden" value="'.$row['date_updated'].'">';;
	    	$nestedData[] = $btn." ".'<a class="btn_delete" href="'.base_url()."admin/promo/delete/".$row['promo_id'].'">Delete</a>';
	    	

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
	public function check_kd($promo_kd){
		$query = $this->db->get_where("promo",array('promo_kd' => $promo_kd,'is_deleted' => 0));
		return $query->num_rows();

	}


}




?>