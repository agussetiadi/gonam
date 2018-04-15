<input type="hidden" id="price" value="<?php echo $query['price'] ?>" name="">
<div class="row">
<div class="container-fluid">
	<div class="container wrap-content">
		<div class="col-md-12">
			<div class="title-page text-center">
				<h3>Data Qurban</h3>
			</div>
		</div>
		<div class="col-md-6">
			<div class="page-aqiqah">


			<!-- START FORM -->
			<form method="POST" action="<?php echo base_url()."order/add_order_kambing" ?>">
			<input type="hidden" id="kambing_id" value="<?php echo $query['kambing_id'] ?>" name="kambing_id">
				


				<div class="h3 margin-2">
					Data Pesanan
				</div>
				<div class="row">
					<div class="col-md-12 margin-1">
						<div class="row">
							<div class="col-md-6">Paket</div>
							<div class="col-md-6"><div class="badge badge-qty"><?php echo $query['kambing_type']." ".$query['kambing_gender']; ?></div></div>
						</div>
					</div>
					<div class="col-md-12 margin-1">
						<div class="row">
							<div class="col-md-6">Info</div>
							<div class="col-md-6"><?php echo $query['kambing_info']; ?></div>
						</div>
					</div>
					<div class="col-md-12 margin-1">
						<div class="row">
							<div class="col-md-6">Harga Perekor</div>
							<div class="col-md-6">Rp. <?php echo number_format($query['price']); ?>,-</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12 margin-1">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Jumlah</label>
								</div>
							</div>
							<div class="col-md-6">								
								<div class="form-group" >
									<input id="" name="kambing_qty" class="after form-control" type="number" required="" value="1" min="1" max="20" />
								</div>

							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label>Tambahkan Keterangan</label>
							<textarea class="form-control" name="keterangan" placeholder="Tambahkan keterangan mengenai pesanan anda"></textarea>
						</div>
					</div>
					<div class="col-md-12">
					<div class="form-group">
						<input type="submit" name="" id="btn-next" class="btn-order" data-target="#exampleModal" data-toggle="modal" value="Selanjutnya">
					</div> 
					</div>
				</div>

			</form>
			<!-- END FORM -->
			</div>
		</div>

		<div class="col-md-6">
			<div class="div-flow">
				<div class="line-flow"></div>
				<div class="div-flow-img">
					<img class="flow-img" src="<?php echo base_url()."assets/img/flow_1.png" ?>">
					<h4>Pilih Paket Sesuai Kebutuhan</h4>
				</div>
				<div class="div-flow-img">
					<img class="flow-img" src="<?php echo base_url()."assets/img/flow_2.png" ?>">
					<h4>Isi Detail Pemesanan Anda</h4>
				</div>
				<div class="div-flow-img">
					<img class="flow-img" src="<?php echo base_url()."assets/img/flow_3.png" ?>">
					<h4>Pilih Lokasi Pengiriman</h4>
				</div>
				<div class="div-flow-img">
					<img class="flow-img" src="<?php echo base_url()."assets/img/flow_4.png" ?>">
					<h4>Kami Akan Verifikasi Pesanan Anda</h4>
				</div>
				<div class="div-flow-img">
					<img class="flow-img" src="<?php echo base_url()."assets/img/flow_5.png" ?>">
					<h4>Pesanan Dikirim</h4>
				</div>
			</div>
		</div>
	</div>
</div>
</div>