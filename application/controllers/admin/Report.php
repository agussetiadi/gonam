<?php

/**
* 
*/
class Report extends CI_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('admin/report_model');
	}

	public function index(){

	}
	public function sales(){
		$data['page'] = 'admin/report/sales';
		$this->template->get_view($data);
	}

	public function sales_rekap(){
		$data['page'] = 'admin/report/sales_rekap';
		$this->template->get_view($data);	
	}

	public function sales_rekap_render(){
		$dateStart = $this->input->post('dateStart');
		$dateEnd = $this->input->post('dateEnd');
		$sortBy = $this->input->post('sortBy');
		echo $this->report_model->sales_rekap_render($dateStart,$dateEnd,$sortBy);
	}


	public function print_sales_rekap(){
		$data['dateStart'] = $this->input->get("dateStart");
		$data['dateEnd'] = $this->input->get("dateEnd");
		$data['sortBy'] = $this->input->get("sortBy");
		$this->load->view("admin/report/print_sales_rekap", $data);
	}
	public function pdf_sales_rekap(){
/*		if ($this->input->get("print")) {
			echo json_encode(array('status' => 'ok'));
		}
		else{
			
			require APPPATH."third_party/dompdf/autoload.inc.php";
			$data['dateStart'] = $this->input->get("dateStart");
			$data['dateEnd'] = $this->input->get("dateEnd");
			$data['sortBy'] = $this->input->get("sortBy");
			$page = $this->load->view("admin/report/print_sales_rekap", $data,true);

			$dompdf = new Dompdf\Dompdf();
			$dompdf->loadHtml($page);

			$dompdf->render();
			$dompdf->stream(time()."pdf");
		}
*/

	}

	public function print_sales_detail(){
		$data['dateStart'] = $this->input->get("dateStart");
		$data['dateEnd'] = $this->input->get("dateEnd");
		$data['sortBy'] = $this->input->get("sortBy");
		$this->load->view("admin/report/print_sales_detail", $data);
	}

	public function sales_detail(){
		$data['page'] = 'admin/report/sales_detail';
		$this->template->get_view($data);	
	}
	public function sales_detail_render(){
		$dateStart = $this->input->post('dateStart');
		$dateEnd = $this->input->post('dateEnd');
		$sortBy = $this->input->post('sortBy');
		echo $this->report_model->sales_detail_render($dateStart,$dateEnd,$sortBy);
	}

	public function sales_harian(){
		$data['page'] = 'admin/report/sales_harian';
		$this->template->get_view($data);	
	}

	public function sales_harian_render(){
		$dateStart = $this->input->post('dateStart');
		$dateEnd = $this->input->post('dateEnd');
		echo $this->report_model->sales_harian_render($dateStart,$dateEnd);
	}
	public function print_sales_harian(){
		$data['dateStart'] = $this->input->get("dateStart");
		$data['dateEnd'] = $this->input->get("dateEnd");		
		$this->load->view("admin/report/print_sales_harian", $data);
	}

	public function sales_stats(){
		$data['page'] = 'admin/report/sales_stats';
		$this->template->get_view($data);
	}

	private function get_mingguan($start){
		$this->db->group_by("date_created");
		$last = date("Y-m-t", strtotime($start));
		$query = $this->db->get_where("pos_order", array('is_deleted' => 0,'date_created >=' => $start,'date_created <=' => $last,'order_status' => 'Done'));
		
		$arrayData = [];
		$map = [];
		foreach ($query->result_array() as $key => $value) {
			$initDate = class_date::tanggal($value['date_created']);
			$queryNum = $this->db->get_where("pos_order", ['date_created' => $value['date_created'],'is_deleted' => 0,'order_status' => 'Done']);
			$arrayData[$initDate] = $queryNum->num_rows();

			$map[] = $value['kecamatan_id'];
		}
		
		$array_map = array_count_values($map);
		$pie = [];
		foreach ($array_map as $key2 => $value2) {
			$q = $this->db->get_where('kecamatan', array('kecamatan_id'=> $key2))->row_array();
			$nmKabupaten = $q['nama_kecamatan'];

			$pie[] = array('name' => $nmKabupaten,'y' => $value2);
		}

		return array('stats1' => $arrayData,'location' => $pie);
	}

	public function get_bulanan($param){

		$start = $param."-01";
		$last = $param."-12";

		$this->db->group_by('SUBSTRING(date_created,1,7)');
		$query = $this->db->get_where("pos_order",array(
				'SUBSTRING(date_created,1,7) >=' => $start,
				'SUBSTRING(date_created,1,7) <=' => $last,
				'is_deleted' => 0,
				'order_status' => 'Done'));


		$arrayData = [];
		$map = [];
		foreach ($query->result_array() as $key => $value) {
			$initDate = substr($value['date_created'], 0,7);
			$arrayData[$initDate] = $this->db->get_where("pos_order", ['SUBSTRING(date_created,1,7)' => $initDate,'order_status' => 'Done'])->num_rows();

			$map[] = $value['kabupaten_id'];
		}

		$array_map = array_count_values($map);
		$pie = [];
		foreach ($array_map as $key2 => $value2) {
			$q = $this->db->get_where('kabupaten', array('kabupaten_id'=> $key2))->row_array();
			$nmKabupaten = $q['nama_kabupaten'];

			$pie[] = array('name' => $nmKabupaten,'y' => $value2);
		}
		return array('stats1' => $arrayData,'location' => $pie);
		
	}

	public function sales_stats_render(){
		$init = $this->input->post('init');

		if ($init == 'mingguan') {

			$start = date("Y-m-01");

			$result = $this->get_mingguan($start);

			$title = 'Grafik Pemesanan Bulan Ini';
			$subtitle = 'Terhitung mulai dari '.class_date::arr_bulan($start);
			$arrayData = $result['stats1'];
			$location = $result['location'];


			/*Old*/
			$now 		= date_create();
			$init 	 	= date_modify($now, "-1 month");
			$start2	 	= date_format($init, "Y-m-01");

			$result2 = $this->get_mingguan($start2);

			$title2 = 'Grafik Pemesanan Bulan Sebelumnya';
			$subtitle2 = 'Terhitung mulai dari '.class_date::arr_bulan($start2);
			$arrayData2 = $result2['stats1'];
			$location2 = $result2['location'];


			$graph1 = array('data' => $arrayData,'title' => $title,'subtitle' => $subtitle);
			$graphOld = array('data' => $arrayData2,'title' => $title2,'subtitle' => $subtitle2);

			$map = array('data' => $location,'title' => 'Mapping Lokasi Pelanggan Bulan Ini', 'subtitle' => $subtitle);
			$mapOld = array('data' => $location2,'title' => 'Mapping Lokasi Pelanggan Bulan Sebelumnya', 'subtitle' => $subtitle2);
			
			echo json_encode(array('status' => 'ok',
									'graphic_line' => $graph1,
									'graphic_line_old' => $graphOld,
									'graphic_pie' => $map,
									'graphic_pie_old' => $mapOld
									));

		}
		if ($init == 'bulanan') {

			$start = date("Y");

			$result = $this->get_bulanan($start);


			$title = 'Grafik Pemesanan Tahun Ini';
			$subtitle = 'Terhitung mulai dari '.$start;
			$arrayData = $result['stats1'];
			$location = $result['location'];


			/*Old*/

			$result2 = $this->get_bulanan($start-1);

			$title2 = 'Grafik Pemesanan Tahun Sebelumnya';
			$subtitle2 = 'Terhitung mulai dari ';
			$arrayData2 = $result2['stats1'];
			$location2 = $result2['location'];


			$graph1 = array('data' => $arrayData,'title' => $title,'subtitle' => $subtitle);
			$graphOld = array('data' => $arrayData2,'title' => $title2,'subtitle' => $subtitle2);

			$map = array('data' => $location,'title' => 'Mapping Lokasi Pelanggan Tahun Ini', 'subtitle' => $subtitle);
			$mapOld = array('data' => $location2,'title' => 'Mapping Lokasi Pelanggan Tahun Sebelumnya', 'subtitle' => $subtitle2);
			
			echo json_encode(array('status' => 'ok',
									'graphic_line' => $graph1,
									'graphic_line_old' => $graphOld,
									'graphic_pie' => $map,
									'graphic_pie_old' => $mapOld
									));
		}


		
	}


	public function pembelian(){
		$data['page'] = 'admin/report/pembelian';
		$this->template->get_view($data);
	}

	public function pembelian_rekap(){
		$data['page'] = 'admin/report/pembelian_rekap';
		$this->template->get_view($data);	
	}

	public function pembelian_rekap_render(){

		$dateStart = $this->input->post("dateStart");
		$dateEnd = $this->input->post("dateEnd");
		$sortBy = $this->input->post("sortBy");

		echo $this->report_model->pembelian_rekap_render($dateStart,$dateEnd,$sortBy);
	}
	public function print_pembelian_rekap(){
		$data['dateStart'] = $this->input->get("dateStart");
		$data['dateEnd'] = $this->input->get("dateEnd");
		$data['sortBy'] = $this->input->get("sortBy");
		$this->load->view('admin/report/print_pembelian_rekap',$data);
	}
	public function pembelian_detail(){
		$data['page'] = 'admin/report/pembelian_detail';
		$this->template->get_view($data);
	}
	public function pembelian_detail_render(){

		$dateStart = $this->input->post("dateStart");
		$dateEnd = $this->input->post("dateEnd");
		$sortBy = $this->input->post("sortBy");
		echo $this->report_model->pembelian_detail_render($dateStart,$dateEnd,$sortBy);
	}
	public function print_pembelian_detail(){
		$data['dateStart'] = $this->input->get("dateStart");
		$data['dateEnd'] = $this->input->get("dateEnd");
		$data['sortBy'] = $this->input->get("sortBy");
		$this->load->view('admin/report/print_pembelian_detail',$data);
	}
}