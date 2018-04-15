<!-- Page Header-->
  <header class="page-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6"><h2 class="no-margin-bottom">Pembelian Rekap</h2></div>
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
      							<option value="pembelian_id">No Transaksi</option>
      							<option value="date_trx">Tanggal</option>
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
      					<th>No Pembelian</th>
      					<th>No Terima</th>
      					<th>Nama Supplier</th>
      					<th>Total</th>
      					<th>Dibayar</th>
      					<th>Tanggal</th>
      					<th>Dibuat</th>
      				
      				</thead>
              <tbody></tbody>
      				<table width="200px" class="float-right">
              <tr>
                <td>Jumlah Item</td>
                <td> : </td>
                <td id="total_item"></td>
              </tr>
              <tr>
                <td>Total Pengeluaran</td>
                <td> : </td>
                <td id="total_out"></td>
              </tr>
              <tr>
                <td>Total Dibayar</td>
                <td> : </td>
                <td id="total_paid"></td>
              </tr>
            </table>
            <div style="clear: both"></div>
      			</table>
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
      url : '<?php echo admin_url() ?>' + 'report/pembelian_rekap_render',
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
        $("#total_item").html(result.total_item);
        $("#total_out").html($.number(result.total));
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


    window.open('<?php echo admin_url() ?>' + 'report/print_pembelian_rekap?dateStart='+dateStart+'&dateEnd='+dateEnd+'&sortBy='+sortBy,'_blank');
  })

</script>