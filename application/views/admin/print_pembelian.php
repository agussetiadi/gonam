<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pembelian</title>

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
		<div class="col-md-8" style="border: 0px solid black; padding: 20px; ">
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
							<b>BUKTI PEMBELIAN</b><br>
							Supplier<br>
							Tgl Pembelian<br>
							Admin
						</div>
					</td>
					<td width="120px;">
						<div style="float: right;"><br>
						: <?php echo $query1['supplier_name'] ?><br>
						: <?php echo $query1['date_trx'] ?><br>
						: <?php echo $query1['created_by'] ?>
						</div>
					</td>
				</tr>
			</table><br>
			
			<b>No. Pembelian : <?php echo $query1['no_pembelian']; ?></b><br>
			<b>No. Terima : <?php echo $query1['no_terima']; ?></b>
			<table class="table" style="margin-top: 20px;">
				<th>No.</th>
				<th>Order</th>
				<th>Qty</th>
				<th>Satuan</th>
				<th>Price</th>
				<th width="20%" style="text-align: right;">Subtotal</th>
				<?php foreach ($query2->result_array() as $key => $value) {
					
				?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['nama_barang'] ?></td>
					<td><?php echo $value['jumlah_barang'] ?></td>
					<td><?php echo $value['satuan_barang'] ?></td>
					<td><?php echo number_format($value['harga_barang']) ?></td>
					
					<td style="text-align: right;"><?php echo number_format($value['subtotal']) ?></td>
				</tr>
				<?php } ?>
			</table>
			<table width="100%">
				<tr>
					<td width="100px;" style="text-align: center;">
						<br><br><br>
						Administrasi						
					</td>
					<td style="text-align: center;">
						<br><br><br>
						
					</td>
					<td width="220px;">
						<p style="text-align: right; padding: 10px; border:1px solid black;" >Total : <?php echo "Rp.".number_format($query1['total']) ?><br>
						Dibayar : <?php echo "Rp.".number_format($query1['total_paid']) ?><br>
						Sisa : <?php echo "Rp.".number_format($query1['total'] - $query1['total_paid']) ?><br>

						</p>

					</td>
				</tr>

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
