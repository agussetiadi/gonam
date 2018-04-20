<script type="text/javascript" src="<?php echo base_url()."assets/admin_panel/js/table-data.js" ?>"></script>
<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Input Data Pesanan</h2></div>
        <div class="col-md-6">
        	<span class="fa fa-manual"></span>
        </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->

<div class="container-fluid top-bottom">
  <div class="row">
    <div class="col-md-12">
      <div class="block-space">
      	<div class="row">
      		<div class="col-md-6">
      		<input type="hidden" name="" id="customer_id">
      		<input type="hidden" name="" class="order_id" value="<?php echo $order_id ?>" id="order_id">
      			<table style="width: 100%;">
      				<tr>
      					<td width="30%"><label>Nomor Transaksi</label></td>
      					<td>:</td>
      					<td><input type="text" name="no_trx" id="no_trx" class="form-control form-control-sm" placeholder="Auto" disabled=""></td>
      				</tr>
      				<tr>
      					<td><label>Pelanggan</label></td>
      					<td>:</td>
      					<td><input type="text" name="" class="form-control form-control-sm" id="renderCust1" disabled=""></td>
      				</tr>
      				<tr>
      					<td><label>Phone</label></td>
      					<td>:</td>
      					<td><input type="text" name="" class="form-control form-control-sm" id="renderCust2" disabled="">
      					<a href="" data-target="#modal1" data-toggle="modal">Edit Pelanggan</a>
      					</td>
      				</tr>
      				<tr style="height: 40px;">
      					<td>Pemotongan</td>
      					<td>:</td>
      					<td>
      						<div class="form-row">
		      					<div class="custom-control custom-radio" style="margin-right: 15px;">
		      						<input type="radio" name="pemotongan" value="Menyaksikan" class="pemotongan custom-control-input" id="p1"> <label class="custom-control-label" for="p1">Menyaksikan</label>
		      					</div>
		      					<div class="custom-control custom-radio" style="margin-right: 15px;">
	      							<input type="radio" name="pemotongan" value="Tidak Menyaksikan" class="pemotongan custom-control-input" id="p2">
	      							<label class="custom-control-label" for="p2">Tidak</label>
	      						</div>
	      						<div class="custom-control custom-radio">
	      							<input type="radio" name="pemotongan" value="Dokumentasikan" class="pemotongan custom-control-input" id="p3" checked=""> <label class="custom-control-label" for="p3">Foto/Video</label>
	      						</div>
      						</div>
      					</td>
      				</tr>
      				<tr style="height: 40px;">
      					<td>Kaki & Kulit</td>
      					<td>:</td>
      					<td>
      						<div class="form-row">
	      						<div class="custom-control custom-radio" style="margin-right: 15px;">
	      							<input type="radio" name="kk" class="kakikulit custom-control-input" value="Bawa" id="k2"> <label for="k2" class="custom-control-label">Bawa </label>
	      						</div>
	      						<div class="custom-control custom-radio" style="margin-right: 15px;">
	      						<input type="radio" checked="" class="kakikulit custom-control-input" value="Tidak" id="k1" name="kk"> <label for="k1" class="custom-control-label">Tidak</b></label>
	      						</div>
      						</div>
      					</td>
      				</tr>
      				<tr>
      					<td>Buku Aqiqah</td>
      					<td>:</td>
      					<td>
      						<input type="number" id="buku_risalah" name="" class="form-control form-control-sm">
      					</td>
      				</tr>
      			</table>
      		</div>
      		<div class="col-md-6">
      			<table style="width: 100%;">
      				<tr>
      					<td colspan="2">
      						<label>Waktu Pengiriman <i>(required)</i></label>
      					</td>
      				</tr>
      				<tr>
      					<td>
      						<input type="text" name="" id="date_deliver" class="form-control form-control-sm datepicker" placeholder="Tanggal Pengiriman" required="">
      					</td>
      					<td>
      						<input type="text" name="" id="time_deliver" class="form-control form-control-sm clockpicker" placeholder="Jam Pengiriman" required="">
      					</td>
      				</tr>
					
      			</table>
      			<table width="100%" style="margin-top: 20px;">
      				<tr>
      					<td colspan="3">
      						<label>Wilayah <i>(opsional)</i></label>
      					</td>
      				</tr>
      				<tr>
      					<td>
      						<select id="provinsi" class="form-control form-control-sm selectpicker" data-live-search="true">
      							<option value="">Pilih Provinsi</option>
      							<option value="32">JAWA BARAT</option>
      							<option value="31">DKI</option>
      							<option value="36">BANTEN</option>
			      				
								
							</select>
      					</td>
      					<td>
      						<select id="kabupaten" class="form-control form-control-sm selectpicker" data-live-search="true">
								<option value="">Kabupaten</option>
							</select>
      					</td>
      					<td>
      						<select id="kecamatan" class="form-control form-control-sm selectpicker" data-live-search="true">
								<option value="">Kecamatan</option>
							</select>
      					</td>
      				</tr>
      				<tr>
      					<td colspan="3">
      						<label>Alamat Lengkap <i>(required)</i></label>
      						<textarea class="form-control form-control-sm" id="address" placeholder="Alamat Lengkap RT/RW"></textarea>
      					</td>
      				</tr>
      				
      			</table>

      		</div>
      		<div class="col-md-12">
      			<hr>
      			<table width="100%" style="margin-bottom: 20px;" class="table" bordercolor="#bfbfbf" border="1.5" id="tableOrderDetail">
      				<thead>
      					<th>No</th>
      					<th>Order</th>
      					<th>Jumlah</th>
      					<th>Satuan</th>
      					<th>Harga/paket</th>
      					<th>Discount</th>
      					<th>Subtotal</th>
      					<th width="130px">Action</th>
      				</thead>
      				<tbody>

      				</tbody>
      			</table>
      			<button class="btn btn-sm btn-info" id="btnListProduct" data-target="#modal3" data-toggle="modal"><span class="fa fa-plus"></span> Tambah Item</button>
      			<hr>
      			<div class="row">
      				<div class="col-md-6">
      					<table style="width: 100%">
      						<tr>
      							<td>
      								<h1>Total</h1>
      							</td>
      							<td><h1>:</h1></td>
      							<td> <h1 id="tt">Rp. 0,-</h1></td>
      						</tr>
      						<tr>
      							<td><h1>Dibayar</h1></td>
      							<td><h1> : </h1></td>
      							<td><input type="text" id="total_paid" class="number" name="" style="height: 50px; width: 100%; padding: 5px 10px; font-size: 25px; margin-bottom: 10px; font-weight: bold;"></td>
      						</tr>
      					</table>
      					
      				</div>
      				
      				<div class="col-md-6">
      					
  						<table width="100%">
  							<tr>
  								<td>
  									<div class="form-group">
	  									<label>Keterangan Order</label>
	  									<textarea class="form-control" id="information" placeholder="Keterangan"></textarea>
  									</div>
  								</td>
  							</tr>
  						</table>
      					
      					
      				</div>
      			</div>
      			<hr>
      			<div class="dropdown" style="float:left; margin-right:5px;">
					  <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <span class="fa fa-print"></span> Simpan + Print
					  </button>
					  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					    <a class="dropdown-item" href="#" id="saveOrder1A">Invoice</a>
					    <a class="dropdown-item" href="#" id="saveOrder1B">Form</a>
					    <a class="dropdown-item" href="#" id="saveOrder1C">Print All</a>
					  </div>
					</div>
      			<button class="btn btn-primary btn-sm" id="saveOrder2"><span class="fa fa-save"></span> Simpan</button>
      			<button class="btn btn-primary btn-sm" id="saveOrder3"><span class="fa fa-save"></span> Simpan & Posting</button>
      		</div>


      	</div>
      	


      </div>
    </div>
  </div>
</div>


<!-- Bagian Container Modal
Tempatkan semua modal disini
 -->
<div id="modal1" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Pelanggan</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>

		    <div class="modal-body">
		    	<div class="row">
		    		<div class="col-md-6">
		    			<label>Filter</label>
				    	<input type="text" name="" id="searchModal1" class="form-control form-control-sm" placeholder="Cari berdasarkan nama">

				    	

		    		</div>
		    		<div class="col-md-3">
		    			<label>Tampilkan</label>
		    			<select id="lengthModal1" class="custom-select">
		    				<option>5</option>
				    		<option>10</option>
				    		<option>25</option>
				    		<option>50</option>
				    		<option>100</option>
				    	</select>
		    		</div>
		    		<div class="col-md-3">
		    			<label>Tambah</label>
		    			<button class="btn btn-primary" data-target="#modal2" data-toggle="modal">Pelanggan Baru</button>
		    		</div>
		    	</div>
		    	<table id="customerLookup" class="table">
		    		<thead>
		    			<th>Kode Pelanggan</th>
		    			<th>Nama Pelanggan</th>
		    			<th>Telp</th>
		    			<th>Alamat</th>
		    			<th>Action</th>
		    		</thead>
		    		<tbody></tbody>
		    	</table>	

		    </div>


		</div>
	</div>
</div>
<div id="modal2" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Tambah Pelanggan</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>

		    <form method="POST" action="<?php echo admin_url()."pos/add_customer" ?>" class="ajax_form">
		    <div class="modal-body">
		    		<div class="form-group">
		    			<label>Nama Pelanggan</label>
		    			<input type="text" name="customer_name" id="customer_name" class="form-control form-control-sm" placeholder="(Required)">
		    		</div>
		    		<div class="form-group">
		    			<label>Nomor Telephone</label>
		    			<input type="text" name="customer_phone" class="form-control form-control-sm" placeholder="(Required)">
		    		</div>
		    		<div class="form-group">
		    			<label>Alamat Lengkap</label>
		    			<textarea class="form-control form-control-sm" name="customer_address" placeholder="(Opsional)"></textarea>
		    		</div>
		    </div>
		    <div class="modal-footer">
		    	<button class="btn btn-primary btn-ajax-process" id="btnSaveCustomer"><span class="fa fa-save"></span> Simpan</button>
		    </div>
		    </form>


		</div>
	</div>
</div>



<div id="modal3" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Data Item</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>
		   	<div class="modal-body">
		    <form id="form-product" method="POST" action="<?php echo admin_url()."pos/add_product" ?>">

		    <input type="hidden" name="order_id" class="order_id">

		    	<table width="100%">
		    		<tr>
		    			<td width="30%">Paket</td>
		    			<td> : </td>
		    			<td>
		    				<select id="product_id" class="form-control form-control-sm selectpicker" name="product_id" data-live-search="true">
		    					<option value="">Pilih Paket</option>
		    					<?php foreach ($query_product as $key => $value) { ?>
		    						<option value="<?php echo $value['product_id'] ?>"><?php echo $value['product_name'] ?></option>
		    					<?php } ?>
		    				</select>
		    			</td>
		    		</tr>
		    		<tr>
		    			<td>Harga/Paket</td>
		    			<td> : </td>
		    			<td><input type="number" name="sales_price" id="sales_price" class="form-control form-control-sm"></td>
		    		</tr>
		    		<tr>
		    			<td>Discount</td>
		    			<td> : </td>
		    			<td><input type="number" name="discount" id="discount" class="form-control form-control-sm"></td>
		    		</tr>
		    		<tr>
		    			<td>Qty Order</td>
		    			<td> : </td>
		    			<td><input type="number" name="order_qty" id="order_qty" class="form-control form-control-sm"></td>
		    		</tr>
		    		<tr>
		    			<td>Masakan</td>
		    			<td> : </td>
		    			<td><textarea class="form-control form-control-sm" name="masakan" id="masakan"  placeholder="Jenis Masakan"></textarea></td>
		    		</tr>
		    		<tr>
		    			<td>Kemas</td>
		    			<td> : </td>
		    			<td><input type="text" class="form-control form-control-sm" name="kemas" id="kemas" placeholder="Kemas Masakan"></td>
		    		</tr>
		    		<tr>
		    			<td>Nama Anak</td>
		    			<td> : </td>
		    			<td><input type="text" class="form-control form-control-sm" id="nama_anak" name="nama_anak" placeholder="Nama Anak yang di Aqiqah"></td>
		    		</tr>
					<tr>
		    			<td>Tanggal Lahir</td>
		    			<td> : </td>
		    			<td><input type="text" class="form-control form-control-sm" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal lahir yang di Aqiqah"></td>
		    		</tr>
		    		<tr>
		    			<td>Nama Ayah/Ibu</td>
		    			<td> : </td>
		    			<td><input type="text" id="nama_ortu" class="form-control form-control-sm" name="nama_ortu" placeholder=""></td>
		    		</tr>
		    	</table>
		    </div>
		    <div class="modal-footer">
		    	<button class="btn btn-sm btn-info" id="btnAddProduct"><span class="fa fa-save"></span> Simpan</button>
		    </div>
		    </form>
		</div>
	</div>
</div>


<div id="modal4" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Update Detail Pemesanan</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>
		   	<div class="modal-body">
		    <form id="form-product-update" method="POST" action="<?php echo admin_url()."pos/update_product" ?>">
		    <input type="hidden" name="order_detail_id" id="order_detail_id">
		    <input type="hidden" name="order_id" class="order_id">
		    	<table width="100%">
		    		<tr>
		    			<td width="30%">Paket Kambing</td>
		    			<td> : </td>
		    			<td>
		    				<select id="product_id_update" class="form-control form-control-sm selectpicker" name="product_id" data-live-search="true">
		    					<option value="">Pilih Paket</option>
		    					<?php foreach ($query_product as $key => $value) { ?>
		    						<option value="<?php echo $value['product_id'] ?>"><?php echo $value['product_name'] ?></option>
		    					<?php } ?>
		    				</select>
		    			</td>
		    		</tr>
		    		<tr>
		    			<td>Harga/Paket</td>
		    			<td> : </td>
		    			<td><input type="number" name="sales_price" id="sales_price_update" class="form-control form-control-sm"></td>
		    		</tr>
		    		<tr>
		    			<td>Discount</td>
		    			<td> : </td>
		    			<td><input type="number" name="discount" id="discount_update" class="form-control form-control-sm"></td>
		    		</tr>
		    		<tr>
		    			<td>Jumlah Kambing</td>
		    			<td> : </td>
		    			<td><input type="number" name="order_qty" id="order_qty_update" class="form-control form-control-sm"></td>
		    		</tr>
		    		<tr>
		    			<td>Masakan</td>
		    			<td> : </td>
		    			<td><textarea class="form-control form-control-sm" name="masakan" id="masakan_update"  placeholder="Jenis Masakan"></textarea></td>
		    		</tr>
		    		<tr>
		    			<td>Kemas</td>
		    			<td> : </td>
		    			<td><input type="text" class="form-control form-control-sm" name="kemas" id="kemas_update" placeholder="Kemas Masakan"></td>
		    		</tr>
		    		<tr>
		    			<td>Nama Anak</td>
		    			<td> : </td>
		    			<td><input type="text" class="form-control form-control-sm" id="nama_anak_update" name="nama_anak" placeholder="Nama Anak yang di Aqiqah"></td>
		    		</tr>
					<tr>
		    			<td>Tanggal Lahir</td>
		    			<td> : </td>
		    			<td><input type="text" class="form-control form-control-sm" name="tanggal_lahir" id="tanggal_lahir_update" placeholder="Tanggal lahir yang di Aqiqah"></td>
		    		</tr>
		    		<tr>
		    			<td>Nama Ayah/Ibu</td>
		    			<td> : </td>
		    			<td><input type="text" id="nama_ortu_update" class="form-control form-control-sm" name="nama_ortu" placeholder=""></td>
		    		</tr>
		    	</table>
		    </div>
		    <div class="modal-footer">
		    	<button class="btn btn-sm btn-info" id="btnUpdateProduct"><span class="fa fa-save"></span>  Simpan</button>
		    </div>
		    </form>
		</div>
	</div>
</div>


<div id="modal5" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

		    <div class="modal-header">
		    	<h4 class="modal-title">Detail Pemesanan</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		    </div>
		   	<div class="modal-body">
		   	<table width="100%">
		   		<tr>
		   			<td>Paket Kambing</td>
		   			<td id="product_name_view"></td>
		   		</tr>
		   		<tr>
		   			<td>Harga/Paket</td>
		   			<td id="sales_price_view"></td>
		   		</tr>
		   		<tr>
		   			<td>Jumlah Kambing</td>
		   			<td id="order_qty_view"></td>
		   		</tr>
		   		<tr>
		   			<td>Masakan</td>
		   			<td id="masakan_view"></td>
		   		</tr>
		   		<tr>
		   			<td>Kemas</td>
		   			<td id="kemas_view"></td>
		   		</tr>
		   		
		   		<tr>
		   			<td>Nama Anak</td>
		   			<td id="nama_anak_view"></td>
		   		</tr>
		   		<tr>
		   			<td>Tanggal Lahir</td>
		   			<td id="tanggal_lahir_view"></td>
		   		</tr>
		   		<tr>
		   			<td>Nama Orang Tua</td>
		   			<td id="nama_ortu_view"></td>
		   		</tr>
		   	</table>
		    </div>
		    <div class="modal-footer">
		    	<button class="btn btn-sm btn-info" data-value="" data-dismiss="modal">Close</button>
		    </div>
		</div>
	</div>
</div>

<div id="cb"></div>



 <!--  -->


<script type="text/javascript">
	var dataCustomer = new tableData({
		table : '#customerLookup',
		url : '<?php echo admin_url() ?>' + 'pos/load_customer',
		method : 'POST',
		search : '#searchModal1',
		length : '#lengthModal1',
		defaultSort : ['customer_id','DESC']
	})

	dataCustomer.render();


/*function render customer*/

function renderCustomer(customer_id){
	var renderCust1 = $("#renderCust1");
	var renderCust2 = $("#renderCust2");
	$.ajax({
		url : '<?php echo admin_url() ?>' + 'pos/render_customer',
		method : 'POST',
		data : {customer_id : customer_id},
		success:function(data){
			var dataObj = JSON.parse(data);
			if (dataObj.status == 'success') {
				renderCust1.val(dataObj.data.customer_name);
				renderCust2.val(dataObj.data.customer_phone);
			}
		}
	})
}



/*Ajax Form Tambah Data*/

$(document).on("submit", ".ajax_form", function(e){

	btnLoader("#btnSaveCustomer");

	e.preventDefault();

	var path = $(this).attr("action");
	var get_method = $(this).attr("method");

	$.ajax({
		url : path,
		method : get_method,
		data : new FormData(this),
		contentType : false,
		processData : false,
		success:function(data){

			btnRemoveLoader("#btnSaveCustomer",'<span class="fa fa-save"></span> Simpan');

			jsonData = JSON.parse(data);
			if (jsonData.action) {
				$(".ajax_form input").val("");
				$(".ajax_form textarea").val("");
				$('#modal2').modal('hide');
				dataCustomer.reload();		
			}
			else if (jsonData.msg) {
				swal(jsonData.required+" Harus terisi","warning");
			}
		}
	})
})

$(document).on("submit", "#form-product", function(e){

	e.preventDefault();
	
	btnLoader("#btnAddProduct");
	
	var path = $(this).attr("action");
	var get_method = $(this).attr("method");

	$.ajax({
		url : path,
		method : get_method,
		data : new FormData(this),
		contentType : false,
		processData : false,
		success:function(data){


			btnRemoveLoader("#btnAddProduct","Simpan");



			jsonData = JSON.parse(data);

			var order_id = jsonData.order_id;
			
			if (jsonData.status == 'ok') {
				$('#modal3 input').val("");
				$('#modal3 textarea').val("");
				$('#modal3 select option').eq(0).attr("selected","");
				$('#modal3').modal('hide');
				$(".order_id").val(order_id);
				$("#tt").html("Rp. "+$.number(jsonData.total)+" ,-");
				renderOrderDetail(order_id);

				$("#product_id").selectpicker('val','');
				$("#product_id").selectpicker('refresh');

			}
			if (jsonData.status == 'required') {
				validateForm("#modal3 .modal-body",jsonData.data);
			}

		}
	})
})

$(document).on("submit", "#form-product-update", function(e){

	e.preventDefault();
	$("#btnUpdateProduct").html("Processing ...");
	$("#btnUpdateProduct").attr("disabled","");
	var path = $(this).attr("action");
	var get_method = $(this).attr("method");
	var order_id = $(".order_id").eq(0).val();

	$.ajax({
		url : path,
		method : get_method,
		data : new FormData(this),
		contentType : false,
		processData : false,
		success:function(data){
			$("#btnUpdateProduct").html("Simpan");
			$("#btnUpdateProduct").removeAttr("disabled");
			jsonData = JSON.parse(data);
			
			if (jsonData.status == 'ok') {
				$('#modal4').modal('hide');
				$("#tt").html("Rp. "+$.number(jsonData.total)+" ,-");
				renderOrderDetail(order_id);
			}

		}
	})
})


/*Acton btn pilih customer*/
$(document).on("click",".btn-cust", function(){
	var index = $(".btn-cust").index(this);
	var idValue = $(".btn-cust").eq(index).attr('data-value');
	$("#modal1").modal("hide");
	$("#customer_id").val(idValue);
	renderCustomer(idValue);

})


    $(document).on("change", "#provinsi", function(){
      var data_send = $(this).val();
      $.ajax({
        url:'<?php echo base_url() ?>'+"wilayah/kabupaten",
        method:"POST",
        data:{provinsi_id:data_send},
        success:function(data_html){
          $("#kabupaten").html(data_html)
          $("#kecamatan").html("");
          $("#kabupaten").selectpicker('refresh');
          $("#kecamatan").selectpicker('refresh');
        }
      })
    })


    $(document).on("change", "#kabupaten", function(){
      var data_send = $(this).val();
      $.ajax({
        url:'<?php echo base_url() ?>'+"wilayah/kecamatan",
        method:"POST",
        data:{kabupaten_id:data_send},
        success:function(data_html){
          $("#kecamatan").html(data_html)
          $("#kecamatan").selectpicker('refresh');
        }
      })
    })

    var getViewProduct = (dataParam,callback) => {
    	$.ajax({
    		url : '<?php echo admin_url() ?>' + 'pos/select_product',
    		method : 'POST',
    		data : {product_id : dataParam.product_id},
    		success : function(data){
    			if (callback)
    				callback(data)
    		}
    	})
    }


    $(document).on("change", "#product_id", function(){
    	/*see helper.js*/

    	showLoader("#modal3 .modal-body");

    	var valId = $(this).val();
    	var dataParam = {product_id : valId}
    	getViewProduct(dataParam,function(data){
    		var dataObj = JSON.parse(data);
			removeLoader("#modal3 .modal-body");
			if (dataObj.status == 'ok') {
				$("#masakan").val(dataObj.masakan);
				$("#sales_price").val(dataObj.sales_price);
				$("#discount").val(dataObj.discount);
				$("#order_qty").val(1);
			}
    	})
    })

    $(document).on("change", "#product_id_update", function(){

    	showLoader("#modal4 .modal-body");

    	var valId = $(this).val();
    	var dataParam = {product_id : valId}
    	getViewProduct(dataParam,function(data){
			removeLoader("#modal4 .modal-body");
    		var dataObj = JSON.parse(data);
			if (dataObj.status == 'ok') {

				$("#masakan_update").val(dataObj.masakan);
				$("#sales_price_update").val(dataObj.sales_price);
				$("#discount_update").val(dataObj.discount);
				$("#order_qty_update").val(1);
			}
    	})
    })


    //$("#dataProduct").selectize();

    function renderOrderDetail(order_id){
    	$.ajax({
    		url : '<?php echo admin_url() ?>' + 'pos/render_detail_order',
    		method : 'POST',
    		data : {order_id : order_id},
    		success : function(resultJson){
				var result = JSON.parse(resultJson);
				var jsonData = result.data;
		        var num = jsonData.length;
		        var container = $("#tableOrderDetail tbody");
		        

		        var tr = "";

		        for (var i = 0; i < num; i++) {

		          var frontTr = '<tr>';
		          var backTr = '</tr>';

		          var nested = jsonData[i];
		          var numNested = nested.length;
		          var td = "";
		            for (var b = 0; b < numNested; b++) {
		              td += '<td>'+nested[b]+'</td>';
		            }
		          tr += frontTr+td+backTr;
		        }
		        container.html(tr);
    		}
    	})
    }

    function getRenderOrder(order_id,callback){
    	$.ajax({
    		url : '<?php echo admin_url() ?>' + 'pos/get_render_order',
    		method : 'POST',
    		data : {order_id : order_id},
    		success : function(jsonData){
    			var dataObj = JSON.parse(jsonData);
    			var status = dataObj.status;
    			var data = dataObj.data;
    			
    			$(".pemotongan").removeAttr("checked");
    			if (data.pemotongan == "Menyaksikan") {
    				$(".pemotongan").eq(0).attr("checked","");
    			}
    			else if (data.pemotongan == "Tidak Menyaksikan") {
    				$(".pemotongan").eq(1).attr("checked","");
    			}
    			else if (data.pemotongan == "Dokumentasikan") {
    				$(".pemotongan").eq(2).attr("checked","");
    			}

    			if (data.kakikulit == "Bawa") {
    				$(".kakikulit").eq(0).attr("checked","");
    			}
    			else if (data.kakikulit == "Tidak") {
    				$(".kakikulit").eq(1).attr("checked","");
    			}

    			var provinsi_id = "0";
    			var kabupaten_id = "0";
    			var kecamatan_id = "0";
    			if (data.provinsi_id != "") {
    				provinsi_id = data.provinsi_id;
    			}
    			if (data.kabupaten_id != "") {
    				kabupaten_id = data.kabupaten_id;
    			}
    			if (data.kecamatan_id != "") {
    				kecamatan_id = data.kecamatan_id;
    			}
    			

    			$(".order_id").val(order_id)
    			$("#customer_id").val(data.customer_id)
    			$("#buku_risalah").val(data.buku_risalah);
    			$("#date_deliver").val(data.date_deliver);
    			$("#time_deliver").val(data.time_deliver);
    			$("#address").val(data.address);
    			$("#tt").html("Rp. "+$.number(data.grand_total)+" ,-");
    			$("#total_paid").val(data.total_paid);
    			$("#provinsi option[value="+provinsi_id+"]").attr("selected","");
    			$("#no_trx").val(data.no_trx);
    			$("#information").val(data.information);

    			/*set select value from bootstrap select API*/
    			$("#provinsi").selectpicker('val',provinsi_id)


    			/*render wilayah*/
				  var data_send = data.provinsi_id;
			      $.ajax({
			        url:'<?php echo base_url() ?>'+"wilayah/kabupaten",
			        method:"POST",
			        data:{provinsi_id:data_send},
			        success:function(data_html){
			          $("#kabupaten").html(data_html)
			          $("#kecamatan option").html("");
			          $("#kabupaten option[value="+kabupaten_id+"]").attr("selected","");

			          	/*set select value from bootstrap select API*/
    					$("#kabupaten").selectpicker('val',kabupaten_id);
			          		
			          	var data_send2 = data.kabupaten_id;
					      $.ajax({
					        url:'<?php echo base_url() ?>'+"wilayah/kecamatan",
					        method:"POST",
					        data:{kabupaten_id:data_send2},
					        success:function(data_html){
					          $("#kecamatan").html(data_html);
					          $("#kecamatan option[value="+kecamatan_id+"]").attr("selected","");

					          	/*set select value from bootstrap select API*/
    							$("#kecamatan").selectpicker('val',kecamatan_id);

				    			renderOrderDetail(order_id);
				    			renderCustomer(data.customer_id);

				    			if (callback)
				    				callback()

					        }
					      })


			        }
			      })
				/**/

    		}
    	})
    }


    $(window).on("load", function(){

    	showLoader('.block-space');

    	var order_id = $("#order_id").val();
    	if (order_id != "") {
    		getRenderOrder(order_id, function(){
    				
    		});
    	}
    	$(document).ajaxStop(function(){
			removeLoader(".block-space");
		})
    })


    $(document).on("click" ,".btnOrderDelete", function(){
    	var alertObj = {
    		title : "Yakin Ingin Menghapus ?",
    		text : "Data akan terhapus dari sistem"
    	}
    	var btnOrderDelete = $(".btnOrderDelete");
    	var index = btnOrderDelete.index(this);
    	var valId = btnOrderDelete.eq(index).attr("data-value");
    	var order_id = $(".order_id").eq(0).val();
    	
    	dataAlert(alertObj,function(){

	    	$.ajax({
	    		url: '<?php echo admin_url() ?>' + 'pos/delete_order_detail',
	    		method : 'POST',
	    		data : {order_detail_id : valId, order_id : order_id},
	    		success : function(resultJson){
	    			var dataObj = JSON.parse(resultJson);
	    			if (dataObj.status == 'ok') {
	    				$("#tt").html("Rp. "+$.number(dataObj.total)+" ,-");
	    				renderOrderDetail(order_id);
	    			}
	    		}
	    	})

    	})


    })

    function renderUpdateDetail(valId,callback){

    	$("#order_detail_id").val(valId);
    	$.ajax({
    		url: '<?php echo admin_url() ?>' + 'pos/edit_order_detail',
    		method : 'POST',
    		data : {order_detail_id : valId},
    		success : function(resultJson){
    			var dataObj = JSON.parse(resultJson);
    			var data = dataObj.data;

    			$("#form-product-update select option").removeAttr("selected");

	    			$("#product_id_update" + " option[value="+data.product_id+"]").attr("selected","")
					$("#sales_price_update").val(data.sales_price)
					$("#discount_update").val(data.discount)
					$("#order_qty_update").val(data.order_qty)
					$("#masakan_update").val(data.masakan)
					
					$("#kemas_update").val(data.kemas)
					$("#nama_anak_update").val(data.nama_anak)
					$("#tanggal_lahir_update").val(data.tanggal_lahir)
					$("#nama_ortu_update").val(data.nama_ortu);

					$("#product_id_update").selectpicker('refresh');
					$("#product_id_update").selectpicker('val',data.product_id);

					if (callback)
						callback();


    		}
    	})
    }

    $(document).on("click" ,".btnOrderEdit", function(){

    	showLoader("#modal4 .modal-body");

    	var btnOrderEdit = $(".btnOrderEdit");
    	var index = btnOrderEdit.index(this);
    	var valId = btnOrderEdit.eq(index).attr("data-value");
    	var order_id = $(".order_id").eq(0).val();

    	$("#modal4").modal("show");
    	renderUpdateDetail(valId, function(){
			removeLoader("#modal4 .modal-body");    		
    	});


    })


    $(document).on("click", ".btnOrderView", function(){

    	showLoader("#modal5 .modal-body");

    	var btnOrderView = $(".btnOrderView");
    	var index = btnOrderView.index(this);
    	var valId = btnOrderView.eq(index).attr("data-value");

    	$("#modal5").modal("show");
    	$("#btnSetUpdate").attr("data-value",valId);
    	$.ajax({
    		url : '<?php echo admin_url() ?>' + 'pos/get_detail_order',
    		method : 'POST',
    		data : {order_detail_id : valId},
    		success : function(dataJson){
    			removeLoader("#modal5 .modal-body");
    			var dataObj = JSON.parse(dataJson);
    			var data = dataObj.data;
    			if (dataObj.status == 'ok') {

    				$("#product_name_view").html(data.product_name);
					$("#sales_price_view").html(data.sales_price)
					$("#order_qty_view").html(data.order_qty)
					$("#masakan_view").html(data.masakan)
					
					$("#kemas_view").html(data.kemas)
					$("#nama_anak_view").html(data.nama_anak)
					$("#tanggal_lahir_view").html(data.tanggal_lahir)
					$("#nama_ortu_view").html(data.nama_ortu)

    			}
    		}
    	})
    })




    var saveOrder= (callback,callback2)=>{

    	var ckPem = $(".pemotongan");
    	var kk = $(".kakikulit");
    	var order_id = $(".order_id").eq(0).val();
    	var customer_id = $("#customer_id").val();
    	var buku_risalah = $("#buku_risalah").val();
    	var date_deliver = $("#date_deliver").val();
    	var time_deliver = $("#time_deliver").val();
    	var provinsi_id = $("#provinsi").val();
    	var kabupaten_id = $("#kabupaten").val();
    	var kecamatan_id = $("#kecamatan").val();
    	var address = $("#address").val();
    	var total_paid = $("#total_paid").val();
    	var information = $("#information").val();
    	var pemotongan;
    	var kakikulit;

    	  if (customer_id == "") {
		    swal("Ooops!!","Pelanggan harus terisi",'warning');
		    return false;
		  }
		  if (order_id == "") {
		    swal("Ooops!!","Isi Data Item Dulu",'warning');
		    return false;
		  }
		  if (date_deliver == "") {
		    $("#date_deliver").focus();
		    swal("Ooops!!","Tanggal Pengiriman Harus Di isi!!",'warning');
		    return false;
		  }

	    	$(ckPem).each(function(x){
	    		if (ckPem.eq(x).prop("checked") == true) {
	    			pemotongan = ckPem.eq(x).val();
	    		}
	    	})
	    	$(kk).each(function(x){
	    		if (kk.eq(x).prop("checked") == true) {
	    			kakikulit = kk.eq(x).val();
	    		}
	    	})

	    	dataObj = {
	    		order_id : order_id,
	    		pemotongan : pemotongan,
	    		kakikulit : kakikulit,
	    		buku_risalah : buku_risalah,
	    		customer_id : customer_id,
	    		date_deliver : date_deliver,
	    		time_deliver : time_deliver,
	    		provinsi_id : provinsi_id,
	    		kabupaten_id : kabupaten_id,
	    		kecamatan_id : kecamatan_id,
	    		address : address,
	    		total_paid : total_paid,
	    		information : information
	    	}
	    		

    			var alertObj = {
		    		title : "Yakin Menyimpan",
		    		text : "Apakah anda ingin menyimpan ke database ?"
		    	}

				dataAlert(alertObj, function(){
				    if (callback2) {
			    		callback2();
			    	}
			    	$.ajax({
			    		url : '<?php echo admin_url() ?>' + 'pos/save_order',
			    		method : 'POST',
			    		data : dataObj,
			    		success : function(jsonData){
			    			var obj = JSON.parse(jsonData);
			    			if (obj.status == 'ok') {
			    				if(callback)
			    					callback(order_id);
			    			}
			    		}
			    	})
				})


    }

    $(document).on("click", "#saveOrder1A", function(){

    	saveOrder(function(order_id){
    		window.open('<?php echo admin_url() ?>'+'pos/print_order/'+order_id+'?target=invoice','_blank');
	    	document.location = '<?php echo admin_url() ?>' + 'pos';
    	},function(){
    		btnLoader("#saveOrder1A");
    	});
    })

    $(document).on("click", "#saveOrder1B", function(){

    	saveOrder(function(order_id){
    		window.open('<?php echo admin_url() ?>'+'pos/print_order/'+order_id+'?target=form','_blank');
	    	document.location = '<?php echo admin_url() ?>' + 'pos';
    	},function(){
    		btnLoader("#saveOrder1B");
    	});
    })
    $(document).on("click", "#saveOrder1C", function(){

    	saveOrder(function(order_id){
    		window.open('<?php echo admin_url() ?>'+'pos/print_order/'+order_id+'?target=all','_blank');
	    	document.location = '<?php echo admin_url() ?>' + 'pos';
    	},function(){
    		btnLoader("#saveOrder1C");
    	});
    })

    $(document).on("click", "#saveOrder2", function(){
    	saveOrder(function(){
	    	document.location = '<?php echo admin_url() ?>' + 'pos';
    	},function(){
    		btnLoader("#saveOrder2");
    	});
    })

    $(document).on("click", "#saveOrder3", function(){
    	
    	var order_id = $("#order_id").val();
    	saveOrder(function(){
    		btnLoader("#saveOrder3");
	    	$.ajax({
	    		url : '<?php echo admin_url() ?>' + 'pos/save_to_blog',
	    		method : 'POST',
	    		data : {order_id : order_id} ,
	    		success : function(data){
	    			var dataObj = JSON.parse(data);
	    			if (dataObj.status == 'ok') {
	    				window.open('<?php echo base_url() ?>'+'post/'+dataObj.slug);
	    				document.location = '<?php echo admin_url() ?>' + 'pos';
	    			}
	    		}
	    	})
    		
    	})
    })


</script>