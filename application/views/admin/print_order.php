<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>

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
		<div class="row">
		<div class="row">
		<?php 
		if ($this->input->get('target') == 'invoice' || $this->input->get('target') == 'all') {
		?>
		<div class="col-md-8" style="border: 0px solid black; padding: 20px; margin-bottom: 50px;">
			<table style="width: 100%" id="table1">
				<tr>
					<td width="60px">
						<img src="<?php echo base_url()."assets/img/system/logo-01.png" ?>" style="width: 100%; display: block;">
					</td>
					<td width="300px">
						<div>
							
							<b>Gonam Sentra Aqiqah</b><br>
							Kp. Sanding 2 RT 13/06,<br>
							Bojongnangka, Gunungputri, Bogor<br>
							Phone. 0852 8978 1700
							
						</div>
					</td>
					<td width="120px" style="padding-right: 0px;">
						<div style="text-align: right; padding-top: 0px ;">
							<b>INVOICE</b><br>
							Kepada Yth <?php echo $query1['customer_name'] ?><br>
							<?php echo class_date::arr_bulan($query1['date_created']) ?><br>
							Admin, <?php echo $query1['created_by'] ?>
						</div>
					</td>
				</tr>
			</table><br>
			
			<b>NOMOR : <?php echo $query1['no_trx'] ?></b>
			<table class="table" style="margin-top: 20px;">
				<th>No.</th>
				<th>Order</th>
				<th>Qty</th>
				<th>Satuan</th>
				<th>Price</th>
				<th>Discount</th>
				<th width="20%" style="text-align: right;">Subtotal</th>
				<?php foreach ($query2->result_array() as $key => $value) {
					
				?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['product_name'] ?></td>
					<td><?php echo $value['order_qty'] ?></td>
					<td><?php echo $value['unit_name'] ?></td>
					<td><?php echo number_format($value['sales_price']) ?></td>
					<td><?php echo number_format($value['discount']) ?></td>
					
					<td style="text-align: right;"><?php echo number_format($value['total']) ?></td>
				</tr>
				<?php } ?>
			</table>
			<table width="100%">
				<tr>
					<td width="100px;" style="text-align: center;">
						Hormat Kami<br><br><br>
						Administrasi						
					</td>
					<td></td>
					<td width="220px;">
						<p style="text-align: right; padding: 10px; border:1px solid #0691c8;" >Grand Total : <?php echo "Rp.".number_format($query1['grand_total']) ?><br>
						Dibayar : <?php echo "Rp.".number_format($query1['total_paid']) ?><br>
						Sisa : <?php 
							$sisa = $query1['grand_total'] - $query1['total_paid'];
							echo 'Rp. '.number_format($sisa);
							 ?>

						</p>

					</td>
				</tr>

			</table>
			<?php 
			if ($this->input->get('target') == 'all') { ?>
			<div style="border: dotted black; border-width: 0px 0px 2px 0px; margin-top: 20px;"></div>
			<?php } ?>
		</div>

		<?php } ?>
		

		<?php 
		if ($this->input->get('target') == 'form' || $this->input->get('target') == 'all') {
		?>
		<div class="col-md-8" style="border: 0px solid black; padding: 20px; margin-top: 30px;">
			<table style="width: 100%" id="table1">
				<tr>
					<td width="60px">
						<img src="<?php echo base_url()."assets/img/system/logo-01.png" ?>" style="width: 100%; display: block;">
					</td>
					<td width="300px">
						<div>
							
							
							<b>Gonam Sentra Aqiqah</b><br>
							Kp. Sanding 2 RT 13/06,<br>
							Bojongnangka, Gunungputri, Bogor<br>
							Phone. 0852 8978 1700
							
						</div>
					</td>
					<td width="120px" style="padding-right: 0px;">
						<div style="text-align: right; padding-top: 0px ;">
							<b>FORM PEMESANAN</b><br>
							Nomor <?php echo $query1['no_trx'] ?><br>
							<?php echo class_date::arr_bulan($query1['date_created']) ?><br>
							Admin, <?php echo $query1['created_by'] ?>
						</div>
					</td>
				</tr>
			</table>
			
			<hr>
			<table width="100%" id="table3">
				<tr>
					<td width="200px">Nama Pemesan</td>
					<td> : </td>
					<td><?php echo $query1['customer_name'] ?></td>
				</tr>
				<tr>
					<td>Nomor Telp.</td>
					<td> : </td>
					<td><?php echo $query1['customer_phone'] ?></td>
				</tr>
				<tr>
					<td>Alamat Pengiriman</td>
					<td> : </td>
					<td><?php echo $query1['address'] ?></td>
				</tr>
				<tr>
					<td>Waktu Pengiriman</td>
					<td> : </td>
					<td><?php echo $this->class_date->arr_bulan($query1['date_deliver'])." | Jam ".substr($query1['time_deliver'], 0,5) ?></td>
				</tr>
				<tr>
					<td>Pemotongan</td>
					<td> : </td>
					<td><?php echo $query1['pemotongan'] ?></td>
				</tr>
				<tr>
					<td>Kaki & Kulit</td>
					<td> : </td>
					<td><?php echo $query1['kakikulit'] ?></td>
				</tr>
				<tr>
					<td>Buku Risalah</td>
					<td> : </td>
					<td><?php echo $query1['buku_risalah'] ?></td>
				</tr>
				<?php foreach ($query2->result_array() as $key2 => $value2) {
				?>
				<tr>
					<td colspan="3">
						<div style="margin:10px 0px; width:70%; border: 1px dotted grey; border-right: none; border-left: none; border-bottom: none;"></div>
					</td>
				</tr>
				<tr>
					<td>Paket</td>
					<td> : </td>
					<td><?php echo $value2['product_name'] ?></td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td> : </td>
					<td><?php echo $value2['order_qty']." ".$value2['unit_name'] ?></td>
				</tr>
				<tr>
					<td>Masakan</td>
					<td> : </td>
					<td><?php echo $value2['masakan'] ?></td>
				</tr>
				<?php if(!empty($value2['nama_anak'])){ ?>
				<tr>
					<td>Nama Anak</td>
					<td> : </td>
					<td><?php echo $value2['nama_anak'] ?></td>
				</tr>
				<?php } ?>
				<?php if(!empty($value2['tanggal_lahir'])){ ?>
				<tr>
					<td>Tanggal Lahir</td>
					<td> : </td>
					<td><?php echo $value2['tanggal_lahir'] ?></td>
				</tr>
				<?php } ?>
				<?php if(!empty($value2['nama_ortu'])){ ?>
				<tr>
					<td>Nama Orang Tua</td>
					<td> : </td>
					<td><?php echo $value2['nama_ortu'] ?></td>
				</tr>
				<?php } ?>
				<?php if(!empty($value2['kemas'])){ ?>
				<tr>
					<td>Kemas</td>
					<td> : </td>
					<td><?php echo $value2['kemas'] ?></td>
				</tr>
				<?php } ?>
				<?php } ?>
				<tr>
					<td>Total</td>
					<td> : </td>
					<td><?php echo "Rp. ".number_format($query1['grand_total'])." ,-" ?></td>
				</tr>
				<tr>
					<td>Dibayar</td>
					<td> : </td>
					<td><?php echo "Rp. ".number_format($query1['total_paid'])." ,-" ?> / Sisa <?php 
					$sisa = $query1['grand_total'] - $query1['total_paid'];
					echo number_format($sisa);
					 ?></td>
				</tr>
				<tr>
					<td>Catatan</td>
					<td> : </td>
					<td>
						<?php echo $query1['information'] ?>
					</td>
				</tr>
			</table>
			

		</div>

		<?php } ?>
		</div>
		</div>


		</div>
	</div>
</div>





<script type="text/javascript">
    window.print();
</script>
</body>
</html>
