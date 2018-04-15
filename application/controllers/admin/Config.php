<?php

/**
* 
*/
class Config extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('template');
	}

	public function index(){
		$data['page'] = 'admin/config';
		$this->template->get_view($data);

	}

	public function notif(){
		$requestData= $_REQUEST;


		if( !empty($requestData['search']['value']) ) {

			$src = $requestData['search']['value'];
		    // if there is a search parameter

		    $this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
		    $this->db->limit($requestData['length'],$requestData['start']);
		    $this->db->like("notif_target",$src);
		    $this->db->or_like("notif_type",$src);
		    $query = $this->db->get("config_notif");

		    $this->db->like("notif_target",$src);
		    $this->db->or_like("notif_type",$src);
		    $totalFiltered = $this->db->get("config_notif")->num_rows();
		} 
		else{    
		    $this->db->limit($requestData['length'],$requestData['start']);
			$this->db->order_by($requestData['order'][0]['column'],$requestData['order'][0]['dir']);
			$query = $this->db->get("config_notif");

			$totalFiltered = $this->db->get("config_notif")->num_rows();
		}



		$data = array();

		foreach ($query->result_array() as $key => $value) {
			$nestedData=array(); 

			if ($value['is_active'] == '1') {
				$status = "AKTIF";
			}
			if ($value['is_active'] == '0') {
				$status = "TIDAK AKTIF";
			}

			$nestedData[] = $value['notif_type'];
			$nestedData[] = $value['notif_target'];
			$nestedData[] = $status;
			$nestedData[] = '<button class="btn btn-info btn-sm bEdit" data-value="'.$value['config_notif_id'].'"><span class="fa fa-pencil"></span></button> <button class="btn btn-danger btn-sm bDelete" data-value="'.$value['config_notif_id'].'"><span class="fa fa-trash"></span></button>';
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


		echo json_encode($json_data);  // send data as json format
	}

	public function add_notif(){
		$arr['notif_type'] = $this->input->post('notif_type');
		$arr['notif_target'] = $this->input->post('notif_target');
		$arr['is_active'] = $this->input->post('is_active');

		if (empty($arr['notif_target'])) {
			die(json_encode(['status' => 'failed','data'=>['Data Target Tidak Boleh Kosong']]));
		}

		$query = $this->db->insert('config_notif', $arr);
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function update_notif(){
		$config_notif_id = $this->input->post('config_notif_id');
		$arr['notif_type'] = $this->input->post('notif_type');
		$arr['notif_target'] = $this->input->post('notif_target');
		$arr['is_active'] = $this->input->post('is_active');

		if (empty($arr['notif_target'])) {
			die(json_encode(['status' => 'failed','data'=>['Data Target Tidak Boleh Kosong']]));
		}


		$this->db->where("config_notif_id",$config_notif_id);
		$query = $this->db->update('config_notif', $arr);


		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}
	}

	public function get_update_notif(){
		$config_notif_id = $this->input->post('config_notif_id');
		$query = $this->db->get_where('config_notif', array('config_notif_id' => $config_notif_id))->row_array();
		echo json_encode(['status' => 'ok','data' => $query]);
	}

	public function delete_notif(){
		$config_notif_id = $this->input->post('config_notif_id');
		$query = $this->db->delete('config_notif', array('config_notif_id' => $config_notif_id));
		if ($query) {
			echo json_encode(array('status' => 'ok'));
		}

	}
}