<?php 


/**
* 
*/
class Testimoni_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function render_testimoni(){
		$requestData= $_REQUEST;

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];

		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("name",$src);
		    $this->db->or_like("testi_isi",$src);
		    $query = $this->db->get("testimoni");


		    $this->db->like("name",$src);
		    $this->db->or_like("testi_isi",$src);
		    $totalFiltered = $this->db->get("testimoni")->num_rows();
		} 
		else{    

		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$query = $this->db->get("testimoni");

		    $totalFiltered = $this->db->get("testimoni")->num_rows();
		}



		$data = array();

		foreach ($query->result_array() as $key => $value) {
			$nestedData=array(); 

			if (empty($value['picture'])) {
				$img = '<img class="img img-thumbnail" style="width:50px" src="'.base_url().'assets/img/male.jpg">';	
			}
			else{

			$img = '<img class="img img-thumbnail" style="width:50px" src="'.base_url().'assets/img/testimoni_img/'.$value['picture'].'">';
			}

			$nestedData[] = $value['name'].'<br>'.$img;
			$nestedData[] = $value['testi_isi'];
			$nestedData[] = $value['testi_ket'];
			$nestedData[] = $value['date_create_testi'];
			$nestedData[] = $value['status_publishing'];
			$nestedData[] = '<button class="btn btn-info btn-sm bEdit" data-value="'.$value['testimoni_id'].'"><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-sm bDelete" data-value="'.$value['testimoni_id'].'"><span class="fa fa-trash"></span></button>';
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
}


?>