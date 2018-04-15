<?php 
/**
* 
*/
class Master_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function product_all(){
		$requestData= $_REQUEST;

		$columns = array( 
		// datatable column index  => database column name
		    0 => 'product_id',
		    1 => 'product_name', 
		    2 => 'product_menu',
		    3 => 'product_price',
		    4 => 'product_hpp',
		    5 => 'category_id' ,
		    6 => 'product_id',
		    6 => 'is_publish',
		);
		
		$arrSelect = array('pos_product.is_deleted' => 0);

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
			$this->db->select('pos_product.* , pos_category.category_name');
		    $this->db->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("product_name",$src);
		    $this->db->join("pos_category","pos_category.category_id = pos_product.category_id","INNER");
		    $query = $this->db->get_where("pos_product",$arrSelect);

		    $this->db->like("product_name",$src);
		    $this->db->join("pos_category","pos_category.category_id = pos_product.category_id","INNER");
		    $totalFiltered = $this->db->get_where("pos_product",$arrSelect)->num_rows();
		} 
		else{    
			$this->db->select('pos_product.* , pos_category.category_name');
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->join("pos_category","pos_category.category_id = pos_product.category_id","INNER");
			$this->db->order_by($columns[$requestData['order'][0]['column']],$requestData['order'][0]['dir']);

			$query = $this->db->get_where("pos_product",$arrSelect);
			$totalFiltered = $query->num_rows();

			$this->db->select('pos_product.* , pos_category.category_name');
			$this->db->join("pos_category","pos_category.category_id = pos_product.category_id","INNER");
			$totalFiltered = $this->db->get_where("pos_product",$arrSelect)->num_rows();
		}



		$data = array();

		foreach ($query->result_array() as $key => $value) {
			$nestedData=array(); 

			if (empty($value['product_picture'])) {
				$f = '<img style="width:50px" class="img img-responsive" src="'.base_url().'assets/img/photo-camera-01.png">';
			}
			else{
				$exFoto = str_replace(".", "_thumb.", $value['product_picture']);
				$f = '<img style="width:50px" class="img img-responsive" src="'.base_url()."assets/img/post_img/".$exFoto.'">';
			}

			$btnAction = '<button class="btn btn-info btn-sm bEdit" data-value="'.$value['product_id'].'"><span class="fa fa-pencil"></span></button>';
			$btnAction .= ' <button class="btn btn-danger btn-sm bDel" data-value="'.$value['product_id'].'"><span class="fa fa-trash"></span></button>';

			if ($value['is_publish'] == '1') {
				$is_publish = 'Publish';
			}
			else{
				$is_publish = 'Hanya Admin';	
			}

			$nestedData[] = $f;
	    	$nestedData[] = $value['product_name'];
	    	$nestedData[] = $value['product_menu'];
	    	$nestedData[] = $value['product_price'];
	    	$nestedData[] = $value['product_hpp'];;
	    	$nestedData[] = $value['category_name'];
	    	$nestedData[] = $is_publish;
	    	$nestedData[] = $btnAction;
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


	public function user_select_all($array){
		$requestData 	= $_POST;
		$provider = $array['provider'];

		$arr = array("is_deleted" => 0);
		if ($provider !== "all") {
			$arr['provider'] = $provider;
		}
		
		if( !empty($requestData['search']) ) {

		    // if there is a search parameter

		    $this->db->order_by($requestData['field'],$requestData['sort']);
		    $this->db->limit($requestData['length'],$requestData['start']);


		    $this->db->like("name",$requestData['search']);
		    $query = $this->db->get_where("user", $arr);
		    


		    $this->db->like("name",$requestData['search']);
		   	$totalFiltered = $this->db->get_where("user", $arr)->num_rows();
		    
		} 
		else{
		    
			$this->db->order_by($requestData['field'],$requestData['sort']);
			$this->db->limit($requestData['length'],$requestData['start']);

			$query =  $this->db->get_where("user", $arr);

			$totalFiltered = $this->db->get_where("user", $arr)->num_rows();
		}

		$data = [];
		foreach ($query->result_array() as $key => $value) {
			$nested = [];

			$nested[] = '<a target="_blank" href="'.$value['picture'].'"><img style="width:50px;" src="'.base_url().'assets/img/male.jpg"></a>';
	    	$nested[] = $value['name']."<br>".$value['email']."<br>";
	    	$nested[] = $value['phone'];
	    	$nested[] = $value['user_gender'];
	    	$nested[] = $value['address'];
	    	$nested[] = $value['join_date'];
	    	$nested[] = $value['status'];
	    	$nested[] = $value['provider'];
	    	$nested[] = '<button class="btn btn-info btn-sm bEdit" data-value="'.$value['user_id'].'"><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-sm bDelete" data-value="'.$value['user_id'].'"><span class="fa fa-trash"></span></button>';
			

			$data[] = $nested;
		}

		$json = array('data' => $data,'total' => $totalFiltered);
		return json_encode($json);
	}

	public function unit_select_all(){
		$requestData= $_REQUEST;

		
		$arrSelect = array('is_deleted' => 0);

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter

		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("unit_name",$src);
		    $query = $this->db->get_where("pos_unit",$arrSelect);

		    $this->db->like("unit_name",$src);
		    $totalFiltered = $this->db->get_where("pos_unit",$arrSelect)->num_rows();
		} 
		else{    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$query = $this->db->get_where("pos_unit",$arrSelect);

			$totalFiltered = $this->db->get_where("pos_unit",$arrSelect)->num_rows();
		}



		$data = array();

		foreach ($query->result_array() as $key => $value) {
			$nestedData=array(); 

			$num = $this->db->get_where("pos_product", array("unit_id" => $value['unit_id']))->num_rows();


			$nestedData[] = $key+1;
			$nestedData[] = $value['unit_name'];
			$nestedData[] = $value['created_by'];
			$nestedData[] = $value['created'];
			$nestedData[] = $num." Data";
			$nestedData[] = '<button class="btn btn-info btn-sm bEdit" data-value="'.$value['unit_id'].'"><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-sm bDelete" data-value="'.$value['unit_id'].'"><span class="fa fa-trash"></span></button>';
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

	public function category_select_all(){
		$requestData= $_REQUEST;

		
		$arrSelect = array('is_deleted' => 0);

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter

		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("category_name",$src);
		    $query = $this->db->get_where("pos_category",$arrSelect);

		    $this->db->like("category_name",$src);
		    $totalFiltered = $this->db->get_where("pos_category",$arrSelect)->num_rows();
		} 
		else{    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$query = $this->db->get_where("pos_category",$arrSelect);

			$totalFiltered = $this->db->get_where("pos_category",$arrSelect)->num_rows();
		}



		$data = array();

		foreach ($query->result_array() as $key => $value) {
			$nestedData=array(); 

			$num = $this->db->get_where("pos_product", array("category_id" => $value['category_id']))->num_rows();
			if ($value['is_publish'] == '1') {
				$is_publish = 'Publish';
			}
			else{
				$is_publish = 'Hanya Admin';	
			}

			$nestedData[] = $key+1;
			$nestedData[] = $value['category_name'];
			$nestedData[] = $value['created_by'];
			$nestedData[] = $value['created'];
			$nestedData[] = $num." Data";
			$nestedData[] = $is_publish;
			$nestedData[] = '<button class="btn btn-info btn-sm bEdit" data-value="'.$value['category_id'].'"><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-sm bDelete" data-value="'.$value['category_id'].'"><span class="fa fa-trash"></span></button>';
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

	public function customer_select_all(){
		$requestData= $_REQUEST;

		
		$arrSelect = array('is_deleted' => 0);

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter

		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("customer_name",$src);
		    $query = $this->db->get_where("pos_customer",$arrSelect);

		    $this->db->like("customer_name",$src);
		    $totalFiltered = $this->db->get_where("pos_customer",$arrSelect)->num_rows();
		} 
		else{    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$query = $this->db->get_where("pos_customer",$arrSelect);

			$totalFiltered = $this->db->get_where("pos_customer",$arrSelect)->num_rows();
		}



		$data = array();

		foreach ($query->result_array() as $key => $value) {
			$nestedData=array(); 

			$num = $this->db->get_where("pos_order", array("customer_id" => $value['customer_id']))->num_rows();

			$nestedData[] = $value['customer_code'];
			$nestedData[] = $value['customer_name'];
			$nestedData[] = $value['customer_phone'];
			$nestedData[] = $value['customer_address'];
			$nestedData[] = $value['created'];
			$nestedData[] = $value['created_by'];
			$nestedData[] = $num;
			$nestedData[] = '<button class="btn btn-info btn-sm bEdit" data-value="'.$value['customer_id'].'"><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-sm bDelete" data-value="'.$value['customer_id'].'"><span class="fa fa-trash"></span></button>';
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
	public function admin_select_all(){
		$requestData= $_REQUEST;

		
		$arrSelect = array('is_deleted' => 0);

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter

		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("first_name",$src);
		    $query = $this->db->get_where("admin",$arrSelect);

		    $this->db->like("first_name",$src);
		    $totalFiltered = $this->db->get_where("admin",$arrSelect)->num_rows();
		} 
		else{    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$query = $this->db->get_where("admin",$arrSelect);

			$totalFiltered = $this->db->get_where("admin",$arrSelect)->num_rows();
		}



		$data = array();

		foreach ($query->result_array() as $key => $value) {
			$nestedData=array(); 

			$admin_foto = str_replace(".", "_thumb.", $value['admin_foto']);

			if (!empty($value['admin_foto'])) {
				$img = '<img class="img-thumnial" style="width:50px" src="'.base_url().'assets/img/admin/'.$admin_foto.'">';
			}
			else{
				$img = '<img class="img-thumnial" style="width:50px" src="'.base_url().'assets/img/male.jpg">';
			}

			$nestedData[] = $value['first_name'];
			$nestedData[] = $img;
			$nestedData[] = $value['username'];
			$nestedData[] = $value['password'];
			$nestedData[] = $value['level'];
			$nestedData[] = $value['last_login_admin'];
			$nestedData[] = '<button class="btn btn-info btn-sm bEdit" data-value="'.$value['admin_id'].'"><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-sm bDelete" data-value="'.$value['admin_id'].'"><span class="fa fa-trash"></span></button>';
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