<div class="row">
	<div class="col-md-8">
		<div class="block-white" style="overflow-x: scroll;">
				<table style="width: 100%;" id="table1">
				<tr>
					<td width="50px">
						<img src="<?php echo base_url()."assets/img/system/logo-01.png" ?>" style="width: 100%; display: block;">
					</td>
					<td width="300px" style="padding-left: 20px;">
						<div>
							
							<b>Gonam Sentra Aqiqah</b><br>
							Kp. Sanding 2 RT 13/06,<br>
							Bojongnangka, Gunungputri, Bogor<br>
							Phone. 0852 8978 1700
							
						</div>
					</td>
					<td width="120px" style="padding-right: 0px;">
					<pre>Nomor <?php echo $query_order['no_trx'] ?></pre>
					
					<p>Dipesan oleh <?php echo $query_order['customer_name'] ?></p>
					</td>
				</tr>
			</table>
			<hr>
			<table class="table">
			
			<th>No.</th>
			<th>Order</th>
			<th>Qty</th>
			<th>Satuan</th>
			<th>Price</th>
			<th width="20%" style="text-align: right;">Subtotal</th>
			<?php foreach ($query_order_detail->result_array() as $key => $value) {	?>
				<tr>
					<td><?php echo $key+1 ?></td>
					<td><?php echo $value['product_name'] ?></td>
					<td><?php echo $value['order_qty'] ?></td>
					<td><?php echo $value['unit_name'] ?></td>
					<td><?php echo number_format($value['sales_price']) ?></td>
					
					<td style="text-align: right;"><?php echo number_format($value['subtotal']) ?></td>
				</tr>
				<?php } ?>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="100px;" style="text-align: center;">
						Hormat Kami<br><br><br>
						Administrasi						
					</td>
					<td></td>
					<td width="220px;">
						<p style="text-align: right; padding: 10px; border:1px solid #0691c8;" >Grand Total : <?php echo "Rp.".number_format($query_order['grand_total']) ?>
						Dibayar : <?php echo "Rp.".number_format($query_order['total_paid']) ?><br>
						Sisa : <?php 
							$sisa = $query_order['grand_total'] - $query_order['total_paid'];
							echo number_format($sisa);
							 ?>

						</p>

					</td>
				</tr>

			</table>
			</div>			
	</div>
	<div class="col-md-4">
		<div class="block-white">
			<div class="alert alert-success">
				<b>Terimakasih Telah Melakukan Pemesanan</b>
				<p>Kami akan segera menghubungi anda dalam beberapa menit</p>

			</div>
		</div>
	</div>
</div>