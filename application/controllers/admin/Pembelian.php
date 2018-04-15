<?php 

/**
* 
*/
class Pembelian extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library("template");
		$this->load->model("admin/pembelian_model");
	}
	public function index(){
		$data['page'] = 'admin/pembelian';
		$this->template->get_view($data);
	}
	public function form($pembelian_id = NULL){
		$data['page'] = 'admin/form_pembelian';
		$data['pembelian_id'] = $pembelian_id;
		$this->template->get_view($data);
	}

	public function load_supplier(){
		echo $this->pembelian_model->load_supplier();
	}
	public function add_supplier(){
			$data['supplier_name'] 	= $this->input->post("supplier_name");
			$data['supplier_phone'] 	= $this->input->post("supplier_phone");
			$data['supplier_address'] 	= $this->input->post("supplier_address");

			$msg_success = array('action' => 'refresh');
			
		
			$required =  array("Nama Supplier" => $data['supplier_name'],
								'Telphone' => $data['supplier_phone']);

			/*
			Validasi input
			*/
			foreach ($required as $key => $value) {
				if (empty($value)) {
					$set_required[] = $key;
				}
			}

			if (!empty($set_required)) {
				$msg_validate = array('msg' => 'Validate', 'required' =>  array($set_required));
				echo json_encode($msg_validate);
			}
			else{
				$query = $this->db->insert("supplier", $data);
				if ($query) {
					echo json_encode($msg_success);
				}

			}
	}
	public function render_supplier(){
		$supplier_id = $this->input->post("supplier_id");
		$query = $this->db->get_where("supplier", array("supplier_id" => $supplier_id));
		$rowData = $query->row_array();
		if ($query->num_rows() > 0) {
			$arrayData = array("status" => 'success','data' => $rowData);
		}
		else{
			$arrayData = array("status" => 'failed');	
		}
		echo json_encode($arrayData);
	}
	public function add_detail(){
		$pembelian_id 	= $this->input->post("pembelian_id");
		$nama_barang 	= $this->input->post("nama_barang");
		$satuan_barang 	= $this->input->post("satuan_barang");
		$jumlah_barang 	= $this->input->post("jumlah_barang");
		$harga_barang 	= $this->input->post("harga_barang");

		
	
		$required =  array("Nama Barang" => $nama_barang,
							'Jumlah' => $jumlah_barang,
							'Harga Barang' => $harga_barang
							);

		/*
		Validasi input
		*/
		foreach ($required as $key => $value) {
			if (empty($value)) {
				$set_required[] = $key;
			}
		}




		if (!empty($set_required)) {
			$msg_validate = array('status' => 'failed', 'required' =>  array($set_required));
			echo json_encode($msg_validate);
		}
		else{
				

		if (empty($pembelian_id)) {
			$this->db->limit('1');
			$this->db->order_by("pembelian_id","DESC");
			$query = $this->db->get("pembelian")->row_array();
			$pembelian_id = $query['pembelian_id'] + 1;
			$no_pembelian = 'BL/'.date('Ymd').'/'.$pembelian_id;
			$created = date("Y-m-d");
			$created_by = $this->session_admin->admin_name();
			$this->db->insert("pembelian",array('pembelian_id' => $pembelian_id,'no_pembelian' => $no_pembelian,'created_by' => $created_by));
			
		}

		$subtotal = $harga_barang * $jumlah_barang;
		$dataInsert = array('pembelian_id' => $pembelian_id,
							'nama_barang' => $nama_barang,
							'satuan_barang' => $satuan_barang,
							'jumlah_barang' => $jumlah_barang,
							'harga_barang' => $harga_barang,
							'subtotal' => $subtotal
							);


			$query = $this->db->insert("pembelian_detail", $dataInsert);
			if ($query) {
				$total = $this->get_total($pembelian_id);
				$msg_success = array('status' => 'ok','pembelian_id' => $pembelian_id,"total" => $total);
				echo json_encode($msg_success);
			}

		}
	}

	public function render_detail(){
		$pembelian_id = $this->input->post("pembelian_id");
		$query = $this->db->get_where("pembelian_detail", array("pembelian_id" => $pembelian_id,"is_deleted" => 0))->result_array();

		$data = [];
		foreach ($query as $key => $value) {
			$i = $key + 1;
			$nested = [];

			$btn = '<button class="btnEdit btn btn-sm btn-primary" data-value="'.$value['pembelian_detail_id'].'"><span class="fa fa-pencil"></span></button> ';
			$btn .= '<button class="btnDelete btn btn-sm btn-danger" data-value="'.$value['pembelian_detail_id'].'"><span class="fa fa-trash"></span></button>';

			$nested[] = $i;
			$nested[] = $value['nama_barang'];
			$nested[] = $value['jumlah_barang'];
			$nested[] = $value['satuan_barang'];
			$nested[] = number_format($value['harga_barang']);
			$nested[] = number_format($value['subtotal']);
			$nested[] = $btn;
			
			$data[] = $nested;
		}
		
		echo json_encode(array('status' =>'ok', 'data' => $data));
	}

	private function get_total($pembelian_id){
		$query = $this->db->get_where("pembelian_detail",array('pembelian_id' => $pembelian_id,'is_deleted' => 0));
		$total = 0;
		foreach ($query->result_array() as $key => $value) {
			$total += $value['subtotal'];
		}
		$this->db->where("pembelian_id",$pembelian_id);
		$this->db->update("pembelian", array("total" => $total));
		return $total;
	}

	public function render_item(){
		$pembelian_detail_id 	= $this->input->post("pembelian_detail_id");
		$nama_barang 	= $this->input->post("nama_barang");
		$satuan_barang 	= $this->input->post("satuan_barang");
		$jumlah_barang 	= $this->input->post("jumlah_barang");
		$harga_barang 	= $this->input->post("harga_barang");
		$query = $this->db->get_where("pembelian_detail", array("pembelian_detail_id" => $pembelian_detail_id))->row_array();
		echo json_encode(array('status' => 'ok', 'data' => $query));
	}
	public function edit_detail(){
		$pembelian_detail_id 	= $this->input->post("pembelian_detail_id");
		$nama_barang 	= $this->input->post("nama_barang");
		$satuan_barang 	= $this->input->post("satuan_barang");
		$jumlah_barang 	= $this->input->post("jumlah_barang");
		$harga_barang 	= $this->input->post("harga_barang");
		$pembelian_id 	= $this->input->post("pembelian_id");

		
	
		$required =  array("Nama Barang" => $nama_barang,
							'Jumlah' => $jumlah_barang,
							'Harga Barang' => $harga_barang
							);

		/*
		Validasi input
		*/
		foreach ($required as $key => $value) {
			if (empty($value)) {
				$set_required[] = $key;
			}
		}




		if (!empty($set_required)) {
			$msg_validate = array('status' => 'failed', 'required' =>  array($set_required));
			echo json_encode($msg_validate);
		}
		else{
				

		$subtotal = $harga_barang * $jumlah_barang;
		$dataInsert = array('nama_barang' => $nama_barang,
							'satuan_barang' => $satuan_barang,
							'jumlah_barang' => $jumlah_barang,
							'harga_barang' => $harga_barang,
							'subtotal' => $subtotal
							);

			$this->db->where("pembelian_detail_id",$pembelian_detail_id);
			$query = $this->db->update("pembelian_detail", $dataInsert);
			if ($query) {
				$total = $this->get_total($pembelian_id);
				$msg_success = array('status' => 'ok','total' => $total);
				echo json_encode($msg_success);
			}

		}
	}
	public function save_pembelian(){
		$pembelian_id = $this->input->post('pembelian_id');
		$supplier_id = $this->input->post('supplier_id');
		$date_trx = $this->input->post('date_trx');
		$total_paid = $this->input->post('total_paid');
		$no_terima = $this->input->post('no_terima');


		$total = $this->viewTotalPembelian($pembelian_id);

		if ($total_paid >= $total) {
			$is_paid = 1;
		}
		else{
			$is_paid = 0;
		}
		$dataUpdate = ['supplier_id' => $supplier_id,
						'date_trx' => $date_trx,
						'total'=>$total,
						'total_paid'=> $total_paid,
						'status' => 'Done',
						'no_terima' => $no_terima,
						'is_paid' => $is_paid
						];
		$this->db->where("pembelian_id",$pembelian_id);
		$query = $this->db->update("pembelian", $dataUpdate);
		if ($query) {
			echo json_encode(array('status' => 'ok', 'data' => ['pembelian_id' => $pembelian_id]) );
		}
	}

	private function viewTotalPembelian($pembelian_id){
		$query = $this->db->get_where("pembelian_detail",array('pembelian_id' => $pembelian_id,'is_deleted' => 0));
		$total = 0;
		foreach ($query->result_array() as $key => $value) {
			$total += $value['subtotal'];
		}
		return $total;
	}

	public function print_pembelian($pembelian_id){

		$this->db->join("supplier","supplier.supplier_id = pembelian.supplier_id","INNER");
		$data['query1'] = $this->db->get_where("pembelian", array('pembelian_id' => $pembelian_id,'pembelian.is_deleted' => 0))->row_array();

		$data['query2'] = $this->db->get_where("pembelian_detail", array('pembelian_id' => $pembelian_id,'is_deleted' => 0));
		$this->load->view("admin/print_pembelian",$data);
	}
	public function render_pembelian(){
		echo $this->pembelian_model->render_pembelian();
	}


	public function get_render_pembelian(){
		$pembelian_id = $this->input->post("pembelian_id");
		$this->db->join("supplier","supplier.supplier_id = supplier.supplier_id","INNER");
		$query = $this->db->get_where("pembelian", array("pembelian_id" => $pembelian_id))->row_array();
		echo json_encode(['status' => 'ok','data' => $query]);
	}

	public function delete_detail(){
		$pembelian_detail_id = $this->input->post("pembelian_detail_id");
		$pembelian_id = $this->input->post("pembelian_id");
		$this->db->where("pembelian_detail_id",$pembelian_detail_id);
		$query = $this->db->update("pembelian_detail",array("is_deleted" => 1));

		$total = $this->get_total($pembelian_id);

		echo json_encode(array('status' => 'ok','total' => $total));
	}
	public function get_print(){
		$key = $this->input->get('key');
		$date = $this->input->get('date');
		$is_paid = $this->input->get('is_paid');

		$result = $this->pembelian_model->get_print();
		$data['query'] = $result['query'];
		$data['totalFiltered'] = $result['totalFiltered'];
		$this->load->view("admin/print_pembelian_filtered",$data);
	}
	public function delete(){
		$pembelian_id = $this->input->post('pembelian_id');
		$this->db->where("pembelian_id",$pembelian_id);
		$query = $this->db->update("pembelian",array("is_deleted" => 1));
		if ($query) {
			echo json_encode(array("status" => 'ok'));
		}
	}

}