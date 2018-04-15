<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Transaksi</title>

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
			<div class="col-md-12">
				<table style="width: 100%;  margin-bottom: 30px;" id="table1">
					<tr>
						<td width="100px">
							<img src="<?php echo base_url()."assets/img/system/logo-01.png" ?>" style="width: 100%; display: block;">
						</td>
						<td>
							<div>
								
								<b>Gonam Sentra Aqiqah</b><br>
								Kp. Sanding 2 RT 13/06,<br>
								Bojongnangka, Gunungputri, Bogor<br>
								Phone. 0852 8978 1700
								
							</div>
						</td>
						<td style="text-align: center;">
							<h3>DATA TRANSAKSI</h3>
							Printed : <?php echo str_replace("-", "/", date("Y-m-d H:s")) ?><br>
						</td>
						<td style="padding-left: 10px;">
							<div style="text-align: right;">
								Printed by <?php echo $this->session_admin->admin_name() ?><br>
								<?php if(!empty($filter4)){echo $this->class_date->arr_bulan($filter4); } ?><br>
								<?php echo "s/d "; if(!empty($filter4)){echo $this->class_date->arr_bulan($filter5); } ?><br>
								Total Data <?php echo $totalFiltered; ?> Row
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="col-md-12">
			<table class="table">
				<thead>
					<th>No. </th>
					<th>Invoice</th>
					<th>Pelanggan</th>
					<th>Pesanan</th>
					<th>Waktu Kirim</th>
					<th>Pembayaran</th>
				</thead>
				<tbody>
					<?php foreach ($query as $key => $value) { ?>
					<tr>
						<td><?php echo $key + 1; ?></td>
						<td><?php echo $value['no_trx'] ?></td>
						<td><?php echo $value['customer_name']; ?> - <?php echo $value['customer_phone']; ?><br>
							<?php echo $value['address']; ?><br>
							

						</td>
						<td>
							<?php foreach ($query_detail[$key] as $key2 => $value2) {
								$n = $key2+1;
								echo $n.". ".$value2['product_name']." ".$value2['order_qty']. " ".$value2['unit_name']."<br>(Menu : ".$value2['masakan'].")<br>";
							} ?>

						</td>

						<td><?php echo $this->class_date->arr_bulan($value['date_deliver'])."<br>Jam ".$value['time_deliver']; ?></td>
						<td><?php 
						$grand_total = $value['grand_total'];
						$total_paid = $value['total_paid'];
						if (intval($total_paid >= $grand_total)) {
							$sisa = 0;
						}
						else{
							$sisa = intval($grand_total - $total_paid);
						}
						echo "Total : ". number_format($grand_total)."<br> Dibayar : ".number_format($total_paid)."<br>Sisa : ".number_format($sisa)."<br>"; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>
			<div class="col-md-4">
				<h3>Total Per Product</h3>
				<table class="table">
				<?php foreach ($product_total as $key => $value2) { ?>
					<tr>
						<td><?php echo $key ?></td>
						
						<td style="text-align: right;"><?php echo $value2 ?></td>
					</tr>
				<?php } ?>
				</table>
			</div>
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
