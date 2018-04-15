<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Filtered Pembelian</title>

    <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" />
    <style type="text/css">
    	#table1 td{
    		padding: 0px 20px 0px 0px;
    		
    	}
    	#table3 td{
    		padding:2px;
    		
    	}



    </style>
</head>
<body>
<div>
	<div class="container">
		<div class="row">
		<div class="col-md-12" style="border: 0px solid black; padding: 20px; ">
			<table style="width: 100%" border="0" id="table1">
				<tr>
					<td width="100px">
						<img src="<?php echo base_url()."assets/img/system/logo.png" ?>" style="width: 100%; display: block;">
					</td>
					<td width="250px">
						<div>
							
							<b>Gonam Sentra Aqiqah</b><br>
							Kp. Sanding 2 RT 13/06,<br>
							Bojongnangka, Gunungputri, Bogor<br>
							Phone. 0852 8978 1700
							
						</div>
					</td>
					<td style="">
						<div style="padding-top: 0px ; float: right;">
							<b>Print Data Pembelian</b><br>
							Di Print<br>
							Admin<br>
							Total Data
						</div>
					</td>
					<td width="120px;">
						<div style="float: right;">
						<br>
						: <?php echo date("Y-m-d"); ?><br>
						: <?php echo $this->session_admin->admin_name(); ?><br>
						: <?php echo $totalFiltered; ?>
						</div>
					</td>
				</tr>
			</table><br>
			
			<table class="table" style="margin-top: 20px;">
				<th>No.</th>
				<th>No. Pembelian</th>
	            <th>No. Terima</th>
	            <th>Supplier</th>
	            <th>Total</th>
	            <th>Di Bayar</th>
	            <th>Tanggal Transaksi</th>
				<?php foreach ($query as $key => $value) {
				?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['no_pembelian'] ?></td>
					<td><?php echo $value['no_terima'] ?></td>
					<td><?php echo $value['supplier_name'] ?></td>
					<td><?php echo number_format($value['total']) ?></td>
					<td><?php echo number_format($value['total_paid']) ?></td>
					<td><?php echo $value['date_trx'] ?></td>

				</tr>
				<?php } ?>
			</table>
			<hr>
		</div>



		


		</div>
	</div>
</div>





<script type="text/javascript">
    window.print();
</script>
</body>
</html>
