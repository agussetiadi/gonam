<?php 


/**
* 
*/
class Purchase_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_data_where($array){
		$query = $this->db->get_where("purchase", $array);
		return $query;
	}
	public function get_data_where_detail($array){
		$query = $this->db->get_where("purchase_detail", $array);	
		return $query;
	}
	public function update_data($nama_table,$where,$purchase_id,$array){
		$this->db->where($where, $purchase_id);
		$query = $this->db->update($nama_table,$array);
		return $query;
	}

	public function insert_data($nama_table,$array){
		$query = $this->db->insert($nama_table,$array);
		return $query;
	}
	public function select_max_purchase(){
		$this->db->select_max("purchase_id");
		$query = $this->db->get("purchase");
		return $query->row_array();
	}

	public function delete($nama_table,$array){
		$query = $this->db->delete($nama_table, $array);
		return $query;
	}
	public function get_data_like($array){
		$this->db->like($array);
		$query = $this->db->get("purchase");
		return $query;

	}



	/*
	ajax datatables
	*/
	public function get_data_tables($table_name,$requestData,$columns,$array_select){

		/*
		action search
	    */
	    $returnsql = NULL;
		$field = NULL;
		foreach ($columns as $key => $value_columns) {
			$field .= ",".$value_columns;
		}
		$res_field = substr($field, 1);

		foreach ($array_select as $key_loop => $loop_sql) {
			$returnsql .= $key_loop."='".$loop_sql."' AND ";
		}
		$return_value = substr($returnsql, 0,-4);


		$sql1 = "SELECT ".$res_field." ";
		    $sql1.=" FROM ".$table_name." WHERE ".$return_value;
		    $sql1.=" AND ".$columns[0]." LIKE '".$requestData['search']['value']."%' ";

		    for ($i=1; $i < count($columns); $i++) { 
		    	$sql1.=" OR ".$columns[$i]." LIKE '".$requestData['search']['value']."%' ";
		    	
		    }

		    $query = $this->db->query($sql1);
		    $totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 

		    $sql1.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		    $query1 = $this->db->query($sql1);
		    $data['search'] = $query1->result_array();


		    /*
			action order by
		    */
			$sql = "SELECT ".$res_field." ";
		    $sql.=" FROM ".$table_name." WHERE ".$return_value;
		    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		    $query2 = $this->db->query($sql);
		    $data['order_by'] = $query2->result_array();

		    
			    $query4 = $this->db->get_where($table_name, $array_select);

                $this->db->limit($requestData['length'], $requestData['start']);  
			    $this->db->order_by($columns[0], "DESC");
			    $query3 = $this->db->get_where($table_name, $array_select);


			$data['select'] = $query3->result_array();
			$data['count'] = $query4->num_rows();

		    return $data;
	}
}


?>