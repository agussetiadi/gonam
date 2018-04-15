
<div class="row">
<div class="block-white">
	<div class="col-md-12 flex-wrap">

	<?php 
	foreach ($query as $key => $value) {
		
	
	 ?>
		<div class="col-md-4">
			<div class="list-blog-div">
				<a class="hover-none" href="<?php echo base_url()."post/".$value['blog_slug'] ?>">
				<div class="list-blog-head"><?php echo $get_image[$key] ?></div>
				</a>
				<div class="list-blog-body text-center">
					<h4 style=""><?php echo $value['judul'] ?></h4>
					<div class="blog-info">
						<div style="margin-right: 20px; float: left;">
						<span class="glyphicon glyphicon-time" style="margin-right: 13px;"></span><?php echo class_date::tanggal($value['date']) ?>
						</div>
						<div style="">
						<span class="glyphicon glyphicon-user" style="margin-right: 13px;"></span><?php echo $value['first_name'] ?>
						</div>
					</div>
					<hr>
					<p style=""><?php echo substr($get_des[$key], 0,150) ?></p>
				</div>
				<div class="list-blog-footer">
					<a class="hover-none" href="<?php echo base_url()."post/".$value['blog_slug'] ?>"><button class="btn-order">Selengkapnya</button></a>
				</div>
			</div>
		</div>

		<?php } ?>

	</div>
	</div>
</div>