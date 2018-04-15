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
	public function get_where($table, $array){
		$query = $this->db->get_where($table,$array);
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

	public function menu_server(){
		$requestData= $_REQUEST;

		$this->db->limit($requestData['length'],$requestData['start']);
		$ex =  $this->db->get_where("menu",array('is_deleted' => 0));
		$query = $ex->result_array();

		$totalFiltered = $this->db->get_where("menu",array('is_deleted' => 0))->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("menu_id",$src);
		    $this->db->or_like("menu_name",$src);
		    $this->db->or_like("date_create",$src);
		    $d = $this->db->get_where("menu",array('is_deleted' => 0));
		    $query = $d->result_array();
		    $totalFiltered = count($query);
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$d = $this->db->get_where("menu",array('is_deleted' => 0));
		    $query = $d->result_array();
		    
		}




		$data = array();

		foreach ($query as $key => $row) {
			$nestedData=array(); 

			$nestedData[] = $key+1;
	    	$nestedData[] = $row['menu_id'];
	    	$nestedData[] = $row['menu_name'];
	    	$nestedData[] = $row['display'];
	    	$nestedData[] = '<a class="ajax_nav" href="'.base_url().'admin/master/menu_edit/'.$row['menu_id'].'"><button class="btn btn-xs btn-info">Edit</button></a>  <a class="btn_delete" href="'.base_url().'admin/master/menu_delete/'.$row['menu_id'].'"><button class="btn btn-xs btn-danger">Hapus</button></a>';
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


	public function kambing_server(){
		$requestData= $_REQUEST;

		$this->db->limit($requestData['length'],$requestData['start']);
		$array = array("kambing.is_deleted" => 0);
		$this->db->join("kambing_category","kambing_category.kambing_category = kambing.kambing_category","LEFT");
		$query = $this->db->get_where("kambing", $array);



		$this->db->join("kambing_category","kambing_category.kambing_category = kambing.kambing_category","LEFT");
		$num = $this->db->get_where("kambing", array("kambing.is_deleted" => 0));

		$totalFiltered = $num->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("kambing.kambing_id",$src);
		    $this->db->or_like("kambing.kambing_gender",$src);
		    $this->db->or_like("kambing.price",$src);
		    $this->db->or_like("kambing.picture",$src);
		    $this->db->or_like("kambing_category.kc_name",$src);

		    $array = array("kambing.is_deleted" => 0);
			$this->db->join("kambing_category","kambing_category.kambing_category = kambing.kambing_category","LEFT");
			$query = $this->db->get_where("kambing", $array);

		    $totalFiltered = $query->num_rows();
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);


			$array = array("kambing.is_deleted" => 0);
			$this->db->join("kambing_category","kambing_category.kambing_category = kambing.kambing_category","LEFT");
			$query = $this->db->get_where("kambing", $array);
		    
		}




		$data = array();

		foreach ($query->result_array() as $key => $row) {
			$nestedData=array(); 

			if (!file_exists("assets/img".$row['picture'])) {
		    	$foto = $row['picture'];
		    }
		    else{
		    	$foto = "im.png";
		    }

		    

	    	$nestedData[] = $row['kambing_id'];
	    	$nestedData[] = $row['kambing_type'];
	    	$nestedData[] = $row['kambing_gender'];
	    	$nestedData[] = $row['price'];
	    	$nestedData[] = $row['kambing_diskon'];
	    	$nestedData[] = $row['kc_name'];
	    	$nestedData[] = "Sate ".$row['sate_qty']."<br>Gule ".$row['gule_porsi']."<br>Guling ".$row['guling_porsi'];
	    	$nestedData[] = '<a target="_blank" href="'.base_url()."assets/img/".$foto.'"><img class="img-responsive img-thumbnail" style="width:50px;" src="'.base_url().'assets/img/'.$foto.'"></a>';
	    	$nestedData[] = '<a class="ajax_nav" href="'.base_url().'admin/master/kambing_edit/'.$row['kambing_id'].'"><button class="btn btn-xs btn-info">Edit</button></a>  <a class="btn_delete" href="'.base_url().'admin/master/kambing_delete/'.$row['kambing_id'].'"><button class="btn btn-xs btn-danger">Hapus</button></a>';
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


		public function product_server(){
		$requestData= $_REQUEST;

		$this->db->limit($requestData['length'],$requestData['start']);
		$this->db->join("product_category","product_category.product_category = product.product_category","LEFT");
		$array = array("product.is_deleted" => 0);
		$query = $this->db->get_where("product", $array);



		$this->db->join("product_category","product_category.product_category = product.product_category","LEFT");
		$num = $this->db->get_where("product", array("product.is_deleted" => 0));

		$totalFiltered = $num->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("product.product_id",$src);
		    $this->db->or_like("product.product_type",$src);
		    $this->db->or_like("product.product_menu",$src);
		    $this->db->or_like("product.product_price",$src);
		    $this->db->or_like("product.product_picture",$src);
		    $this->db->or_like("product.product_category",$src);

		    

		    $this->db->join("product_category","product_category.product_category = product.product_category","LEFT");
			$array = array("product.is_deleted" => 0);
			$query = $this->db->get_where("product", $array);

		    $totalFiltered = $query->num_rows();
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);


			$this->db->join("product_category","product_category.product_category = product.product_category","LEFT");
			$array = array("product.is_deleted" => 0);
			$query = $this->db->get_where("product", $array);
		    
		}




		$data = array();

		foreach ($query->result_array() as $key => $row) {
			$nestedData=array(); 

			if (!file_exists("assets/img".$row['product_picture'])) {
		    	$foto = $row['product_picture'];
		    }
		    else{
		    	$foto = "im.png";
		    }

		    
		    

	    	$nestedData[] = $row['product_id'];
	    	$nestedData[] = $row['product_type'];
	    	$nestedData[] = $row['product_menu'];
	    	$nestedData[] = $row['product_price'];
	    	$nestedData[] = $row['product_diskon'];
	    	$nestedData[] = $row['pc_name'];
	    	$nestedData[] = $row['product_info'];
	    	$nestedData[] = '<a target="_blank" href="'.base_url()."assets/img/".$foto.'"><img class="img-responsive img-thumbnail" style="width:50px;" src="'.base_url().'assets/img/'.$foto.'"></a>';
	    	$nestedData[] = '<a class="ajax_nav" href="'.base_url().'admin/master/product_edit/'.$row['product_id'].'"><button class="btn btn-xs btn-info">Edit</button></a>  <a class="btn_delete" href="'.base_url().'admin/master/product_delete/'.$row['product_id'].'"><button class="btn btn-xs btn-danger">Hapus</button></a>';
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


	public function supplier_server(){
		$requestData= $_REQUEST;

		$this->db->limit($requestData['length'],$requestData['start']);
		$array = array("is_deleted" => 0);
		$query = $this->db->get_where("supplier", $array);


		$num = $this->db->get_where("product", array("is_deleted" => 0));

		$totalFiltered = $num->num_rows();

		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter
		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("supplier_name",$src);
		    
			$array = array("is_deleted" => 0);
			$query = $this->db->get_where("supplier", $array);

		    $totalFiltered = $query->num_rows();
		   
		    
		} 
		elseif( !empty($requestData['order'][0]['column']) ){    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);

			$array = array("is_deleted" => 0);
			$query = $this->db->get_where("supplier", $array);
		    
		}




		$data = array();

		foreach ($query->result_array() as $key => $row) {
			$nestedData=array(); 


		    

	    	$nestedData[] = intval($key+1).'<input type="hidden" class="supplier_id" value='.$row['supplier_id'].'>';
	    	$nestedData[] = $row['supplier_name'].'<input type="hidden" class="supplier_name" value='.$row['supplier_name'].'>';
	    	$nestedData[] = $row['supplier_address'].'<input type="hidden" class="supplier_address" value='.$row['supplier_address'].'>';
	    	$nestedData[] = $row['supplier_phone'].'<input type="hidden" class="supplier_phone" value='.$row['supplier_phone'].'>';

	    	$nestedData[] = '<button data-toggle="modal" data-target="#modal2" class="btn-edit-supplier btn btn-xs btn-info">Edit</button>

	    	<a class="btn_delete" href="'.base_url()."admin/master/supplier_delete/".$row['supplier_id'].'"><button class="btn btn-xs btn-danger">Hapus</button></a>';
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