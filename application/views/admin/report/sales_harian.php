<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Penjualan Harian</h2></div>
          <div class="col-md-6">
          </div>
        </div>
    </div>
  </header>
<!-- Dashboard Counts Section-->
<div class="container-fluid top-bottom">
    <div class="row">
        <div class="col-md-12">
        	<div class="block-space">

        	     <table style="width: 100%;" class="table-td-padd">
      				<tr>
      					<td>Periode</td>
      					<td>
      						<div class="custom-fa-calender">
      							<input type="text" id="dateStart" class="form-control form-control-sm datepicker" name="" placeholder="tanggal mulai">
      						</div>
      					</td>
      					<td>s/d</td>
      					<td>
      						<input type="text" id="dateEnd" class="form-control form-control-sm datepicker" name="" placeholder="tanggal akhir">
      					</td>
      					
      					
      					<td>
      						<button class="btn btn-info" id="bProcess"><span class="fa fa-refresh"></span> Proses</button>
      						<button class="btn btn-info" id="bPint"><span class="fa fa-print"></span> Print</button>
      					</td>
      				</tr>
      			</table>  
      			<hr>
      			<table class="table" id="tableRender">
      				<thead>
      					<th>Tanggal</th>
      					<th>Item Terjual</th>
      					<th>Jumlah Transaksi</th>
      					<th>Total Transaksi</th>
      					<th>Total Bayar Masuk</th>
      				</thead>
      				<tbody>
      					
      				</tbody>
      			</table>
      			<table width="200px" class="float-right">
      				<tr>
      					<td>Jumlah Item</td>
      					<td> : </td>
      					<td id="num_item"></td>
      				</tr>
      				<tr>
      					<td>Jumlah Pesanan</td>
      					<td> : </td>
      					<td id="num_order"></td>
      				</tr>

      				<tr>
      					<td>Total Omset</td>
      					<td> : </td>
      					<td id="num_trx"></td>
      				</tr>
      				<tr>
      					<td>Total Dibayar</td>
      					<td> : </td>
      					<td id="num_paid"></td>
      				</tr>
      			</table>
      			<div style="clear: both"></div>

        	</div>
        </div>
    </div>
</div>

<script type="text/javascript">
	
	$(document).on("click", "#bProcess", function(){
	var dateStart = $("#dateStart").val();
	var dateEnd = $("#dateEnd").val();
	

	if (dateStart == "") {
		swal('Tanggal mulai harus terisi !!')
		return false;
	}
	if (dateEnd == "") {
		swal('Tanggal akhir harus terisi !!')
		return false;
	}

	btnLoader(this,'Prosess');

	$.ajax({
		url : '<?php echo admin_url() ?>' + 'report/sales_harian_render',
		method : 'POST',
		data : {
			dateStart : dateStart,
			dateEnd : dateEnd
			
		},
		success : function(resultJson){

			btnRemoveLoader("#bProcess",'<span class="fa fa-refresh"></span> Prosess');

			var result = JSON.parse(resultJson);
			renderTable("#tableRender", result.data);

			$("#num_item").html(result.num_item);
			$("#num_order").html(result.num_order);
			$("#num_trx").html($.number(result.num_trx));
			$("#num_paid").html($.number(result.num_paid));
		}
	})
})

$(document).on("click", "#bPint", function(){

	var dateStart = $("#dateStart").val();
	var dateEnd = $("#dateEnd").val();


	if (dateStart == "") {
		swal('Tanggal mulai harus terisi !!')
		return false;
	}
	if (dateEnd == "") {
		swal('Tanggal akhir harus terisi !!')
		return false;
	}


	window.open('<?php echo admin_url() ?>' + 'report/print_sales_harian?dateStart='+dateStart+'&dateEnd='+dateEnd);
})

</script>