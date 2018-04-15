<div class="ajax_load">
	<h3>Order saya</h3>
	<table class="table">
		<tr>
			<th>No Order</th>
			<th>Detail Order</th>
			<th>Total</th>
			<th>Tanggal Order</th>
			<th>Status Order</th>
		</tr>
		<?php foreach ($query_order->result_array() as $key => $value) {
			
		?>
		<tr>
			<td><?php echo $value['no_trx']; ?></td>
			<td>
				
				<?php foreach ($queryDetail[$key]->result_array() as $key2 => $value2) {
					echo $value2['product_name']." ".$value2['order_qty']."<br>";
				} ?>

			</td>
			<td><?php echo $value['grand_total']; ?></td>
			<td><?php echo $value['date_created']; ?></td>
			<td><?php echo $value['order_status']; ?></td>
		</tr>
		<?php } ?>

	</table>
</div>