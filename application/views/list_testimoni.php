<div class="row">
<div class="block-white">
		<h3 class="text-center">Testimoni Pelanggan Kami</h3>
		<div class="row">
			<div class="container flex-wrap">

				<?php foreach ($query->result_array() as $key => $value) {
					
				?>
				<div class="col-md-4 foo">
					<div class="testi-wrap">
					<div class="row">
						<div class="col-md-4">
							<div class="img-testi-div">
							<img class="img-responsive" src="<?php echo image_exists("assets/img/testimoni_img/",$value['picture'],"yes-01.png"); ?>">
							</div>
						</div>
						<div class="col-md-8"><h4 style="line-height: 1.5"><b><?php echo $value['name'] ?></b><br><?php echo $value['testi_ket'] ?></h4></div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12 test-w-body">
						<p><i>
							" <?php echo $value['testi_isi'] ?>"
							</i>
						</p>
						</div>
					</div>
					
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
<div id="a"></div>

<div class="col-md-12 text-center" style="margin-top: 50px;">
	<nav aria-label="...">
	  <ul class="pagination pagination-lg">
	  	<?php echo $links ?>
	  </ul>
	</nav>
</div>
</div>
</div>

