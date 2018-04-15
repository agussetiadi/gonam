<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Penjualan Detail</h2></div>
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
      					<td>Urutkan Berdasar</td>
      					<td>
      						<select class="custom-select" id="sortBy" style="margin:0">
      							<option value="order_id">No Transaksi</option>
      							<option value="date_deliver">Tanggal</option>
      						</select>
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
                <th>No</th>
      					<th>No Transaksi</th>
      					<th>Tanggal</th>
      					<th>Pelanggan</th>
                <th>Order</th>
      					<th>Grand Total</th>
      					<th>Dibayar</th>
      				</thead>
      				<tbody>
      					
      				</tbody>
      			</table>
      			<table width="400px" class="float-right">
      				<tr>
      					<td>Jumlah Item</td>
      					<td> : </td>
      					<td id="total_item"></td>
      				</tr>
      				<tr>
      					<td>Jumlah Pesanan</td>
      					<td> : </td>
      					<td id="total_order"></td>
      				</tr>
              <tr>
                <td>Total Per Kategory</td>
                <td> : </td>
                <td id="category"></td>
              </tr>
      				<tr>
      					<td>Total Discount</td>
      					<td> : </td>
      					<td id="total_discount"></td>
      				</tr>
      				<tr>
      					<td>Total Omset</td>
      					<td> : </td>
      					<td id="total_omzet"></td>
      				</tr>
      				<tr>
      					<td>Total Dibayar</td>
      					<td> : </td>
      					<td id="total_paid"></td>
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
		var sortBy = $("#sortBy").val();

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
			url : '<?php echo admin_url() ?>' + 'report/sales_detail_render',
			method : 'POST',
			data : {
				dateStart : dateStart,
				dateEnd : dateEnd,
				sortBy : sortBy
			},
			success : function(resultJson){

				btnRemoveLoader("#bProcess",'<span class="fa fa-refresh"></span> Prosess');

				var result = JSON.parse(resultJson);
				renderTable("#tableRender", result.data);

        var td = '';
        Object.keys(result.category).forEach(function(key){
          td += key + ' ' + result.category[key] + '<br>';
          
        })

        $("#category").html(td);
				$("#total_order").html(result.total_order);
				$("#total_discount").html(result.total_discount);
				$("#total_omzet").html($.number(result.grand_total));
				$("#total_paid").html($.number(result.total_paid));

			}
		})
	})

	$(document).on("click", "#bPint", function(){



		var dateStart = $("#dateStart").val();
		var dateEnd = $("#dateEnd").val();
		var sortBy = $("#sortBy").val();


		if (dateStart == "") {
			swal('Tanggal mulai harus terisi !!')
			return false;
		}
		if (dateEnd == "") {
			swal('Tanggal akhir harus terisi !!')
			return false;
		}


		window.open('<?php echo admin_url() ?>' + 'report/print_sales_detail?dateStart='+dateStart+'&dateEnd='+dateEnd+'&sortBy='+sortBy,'_blank');
	})

</script>