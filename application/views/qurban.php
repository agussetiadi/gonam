<div class="row">
<div class="container-fluid">
<div class="div-img-top">
	<img class="sub-h img-responsive" src="<?php echo base_url()."assets/img/subhead.png" ?>">
	<img class="sub-h-m img-responsive" src="<?php echo base_url()."assets/img/subhead1-02.png" ?>">
</div>
</div>
<div class="menu-paralax">
	<div class="menu-paralax-div">
		<a href="<?php echo base_url()."kambing/aqiqah/" ?>" class="ajax_nav nav_category">
			<h4>Aqiqah</h4>
		</a>
		<div class="nav_hair"></div>
		<a href="<?php echo base_url()."kambing/qurban/" ?>" class="ajax_nav nav_category" >
			<h4>Qurban</h4>
		</a>
		<a class="ajax_nav nav_category" href="<?php echo base_url()."kambing/kambing-guling/" ?>">
			<h4>Kambing Guling</h4>
		</a>
		<a class="ajax_nav nav_category" href="<?php echo base_url()."product/nasi-box/" ?>" >
			<h4>Nasibox/Menu Lainnya</h4>
		</a>
	</div>
</div>


<div class="menu-product-m">
	<div class="p-menu-m p-menu-color1"><a class="ajax_nav" href="<?php echo base_url()."kambing/aqiqah/" ?>"><span class="glyphicon glyphicon-cutlery" style="margin-right: 10px;"></span> Aqiqah</a></div>
	<div class="p-menu-m p-menu-color1" ><a class="ajax_nav" href="<?php echo base_url()."kambing/qurban/" ?>" class="ajax_nav nav_category"><span class="glyphicon glyphicon-cutlery" style="margin-right: 10px;"></span>Qurban</a></div>
	<div class="p-menu-m p-menu-color1"><a class="ajax_nav" href="<?php echo base_url()."kambing/kambing-guling/" ?>"><span class="glyphicon glyphicon-cutlery" style="margin-right: 10px;"></span>Kambing Guling</a></div>
	<div class="p-menu-m p-menu-color1"><a class="ajax_nav" href="<?php echo base_url()."product/nasi-box/" ?>"><span class="glyphicon glyphicon-cutlery" style="margin-right: 10px;"></span>Nasi Box</a></div>
</div>


<div class="container-fluid">
	<div class="head-image-wraper" id="aqiqah">
		<h3 style="text-align: center">Harga Kambing Qurban</h3>
	</div>
	<div class="container wrap-content">
		
		<div class="">
		<?php
		foreach ($query->result_array() as $key => $result) {
		$kambing_type = $result['kambing_type'];
		$price = $result['price'];
		$kambing_id = $result['kambing_id'];
		 ?>
			<div class="col-md-3 list-order">
			<div class="row">
				<div class="wrap-paket">
					<div class="wrap-paket-header">
						<h2 class="text-center"><b><?php echo $result['kambing_type'] ?></b></h2>
					</div>
					<div class="wrap-paket-body">
						
						<p><?php echo $result['kambing_info'] ?></p>
						
						<p>Kambing/Domba : <?php echo $result['kambing_gender'] ?></p>
						<hr>
						<h2><?php echo number_format($price) ?>,-</h2>
					</div>
					<div class="wrap-paket-footer">
						<a class="btn-product btn-kambing" href="<?php echo base_url()."order/qurban/".$kambing_id ?>">PILIH PAKET</a>
						</a>
					</div>
				</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>

</div>
<div class="container">
	<div class="delimit">
		
	</div>
</div>
<div class="container">
	<div class="col-md-6 margin-why">
		<div class="why-img">
			<img src="<?php echo base_url()."assets/img/food1-01.png" ?>">
		</div>
		<h3 class="text-center why-title">Menyediakan <b>Paket Nasi Box</b> <br>Mulai Dari Rp. 11.000,-</h3>
		<div class="" style="margin-top: 5%;">
			<img class="img-responsive" src="<?php echo base_url()."assets/img/mockup nasi box1.png" ?>">
		</div>
	</div>
	<div class="col-md-6 margin-why">
		<div class="why-img">
			<img src="<?php echo base_url()."assets/img/yes-01.png" ?>">
		</div>
		<h3 class="text-center why-title">Kenapa Memesan <b>Qurban</b><br>Di Tempat Kami ?</h3>
		<div class="why-sub-p-m">
			<ul>
				<li>Tidak Ada Biaya Tambahan</li>
				<li>Potong & Antar Gratis Area JABODETABEK</li>
				<li>Kambing Bisa Di Pilih, Sehat & Berkualitas</li>
				<li>Dokumentasi Penyembelihan Foto/Video</li>
				<li>Pemesanan Via Web/Whatsapp/Telphone</li>
				<li>Fast Response, 24 Jam Pelayanan</li>
				<li>Bersertifikat Juru Sembelih Halal</li>
				<li>Pembayaran Di Tempat/Via Transfer</li>
				<li>Siap Menyalurkan Ke Panti</li>
				<li>Masakan Bervariasi</li>
			</ul>
		</div>
	</div>
</div>

</div>