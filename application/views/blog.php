<div class="row">
<div class="block-white">
<div class="container-fluid">
	<div class="container wrap-content">

		<div class="col-md-8">
			<div class="blog-heading">
				<h2><?php echo $get_blog['judul'];  ?></h2>
				<div style="margin-right: 50px; float: left;">
				<span class="glyphicon glyphicon-folder-open" style="margin-right: 13px;"></span><?php echo class_date::arr_bulan($get_blog['date']) ?>
				</div>
				<div style="margin-right: 50px; float: left;">
				<span class="glyphicon glyphicon-comment" style="margin-right: 13px;"></span><?php echo $num_comment." Comments " ?>
				</div>
				<div style="margin-right: 50px;">
				<span class="glyphicon glyphicon-user" style="margin-right: 13px;"></span><?php echo $get_blog['first_name'] ?>
				</div>
			</div>
			<hr>

			<div class="blog-content" style="line-height: 2.3;">
				<p><?php echo $get_blog['deskripsi'];  ?></p>
			</div>

			<div class="row">
			<div id="wrapHarga">
				<?php foreach ($query_sisip as $key => $value) { ?>
				<div class="col-md-3 list-order">
					<div class="row">
						<div class="wrap-paket" data-value="<?php echo $value['product_id'] ?>">

							<div class="wrap-paket-header">
								<img class="" src="<?php echo image_exists("assets/img/post_img/",$value['product_picture']) ?>">
							</div>
							<div class="wrap-paket-body">
								<h4 style="margin: 0; color: #1ca3db;" class=""><b style="margin: 0"><?php echo $value['product_name'] ?></b></h4>
								<p><i><?php echo $value['product_menu'] ?></i></p>
								<p style="font-size: 12px;"><?php echo substr($value['product_info'], 0,100) ?></p>
							</div>
							<hr style="margin:0">
							<div class="wrap-paket-footer">
								<h4 style="margin: 0; color:#D41016 "><b><?php echo "Rp. ".number_format($value['product_price']) ?></b></h4>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			</div>


			<div class="row">
				<div class="col-md-8" style="margin-top: 20px;">
					<p>Tags</p><p><?php echo $get_tag ?></p>
				</div>
				<div class="col-md-4" >
					<div class="share">
						<p>Share</p>
						<div class="share-img-div">
							<a href="" target="popup" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u='+window.location.href,'popup','width=600,height=600'); return false;">
							<img class="img-responsive" src="<?php echo base_url()."assets/img/share1.png" ?>">
							</a>
						</div>
						<div class="share-img-div">
							<a href="" onclick="window.open('https://plus.google.com/share?url='+window.location.href,'popup','width=600,height=600'); return false;">
								<img class="img-responsive" src="<?php echo base_url()."assets/img/share2.png" ?>">
							</a>
						</div>
						<div class="share-img-div">
							<a href="" onclick="window.open('whatsapp://send?text='+window.location.href,'popup','width=600,height=600'); return false;">
							<img class="img-responsive" src="<?php echo base_url()."assets/img/share3.png" ?>">
							</a>
						</div>
						<div class="share-img-div">
							<a href="" onclick="window.open('https://twitter.com/home?status='+window.location.href,'popup','width=600,height=600'); return false;">
								<img class="img-responsive" src="<?php echo base_url()."assets/img/share4.png" ?>">
							</a>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div style="margin-bottom: 70px">
				<h2><?php echo $num_comment; ?> Comments <a href="#comment_new">Leave New</a></h2>
				<hr>
			</div>
		<div id="comment_new"></div>

		</div>

		<div class="col-md-4">
			<div class="col-md-12">

				<div class="row">
				<div class="col-md-9" style="margin-bottom: 15px;">
					<div class="row">
						<input type="text" class="	input-text-12" name="" placeholder="Cari sesuatu" style="">
					</div>
				</div>
				<div class="col-md-3">
					<div class="row">
						<button class="btn-search"><span class="glyphicon glyphicon-search" style="margin-right: 5px"></span> Cari</button>
					</div>
					</div>
				</div>
				<div class="artikel-terbaru">
					<h3>Artikel Terkait</h3>
					<ul class="artikel-terbaru-list">
						<?php foreach ($relevan_artikel as $key_r => $value_r) {
							
						 ?>
						<li><a href="<?php echo base_url()."post/".$value_r['slug'] ?>"><?php echo $value_r['judul'] ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<hr>
				<div class="artikel-terbaru">
					<h3>Artikel Terbaru</h3>
					<ul class="artikel-terbaru-list">
						<?php foreach ($new_artikel->result_array() as $key_n => $value_n) {
							
						 ?>
						<li><a href="<?php echo base_url()."post/".$value_n['blog_slug'] ?>"><?php echo $value_n['judul'] ?></a></li>
						<?php } ?>
					</ul>
				</div>

				<hr>
				<div class="artikel-terbaru">
					<h3>Artikel Populer</h3>
					<ul class="artikel-terbaru-list">
						<?php foreach ($top_artikel->result_array() as $key_t => $value_t) {
							
						 ?>
						<li><a href="<?php echo base_url()."post/".$value_t['blog_slug'] ?>"><?php echo $value_t['judul'] ?></a></li>
						<?php } ?>
					</ul>
				</div>


				<hr>
				<div class="row">
				<div class="paket-lainnya">
					<a href="<?php echo base_url()."product/" ?>">
					<button class="div-lainnya2 btn-hover">Lihat Paket Kami Yang Lainnya</button>
					</a>
				</div>
				</div>
				<hr>



			</div>
		</div>



	</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(".link").val(window.location.href);
	$(document).on("click", ".ajax_reply", function(){
		var index = $(".ajax_reply").index(this);
		var id = $(".id_comment_blog").eq(index).val();
		var curr = window.location.href;
		$(".result").html("");
		$('#ajax-loading').show();
		$.ajax({
			url:"<?php echo base_url()."blog/comment_access" ?>",
			method:"GET",
			data:{init:id,continue:curr},
			success:function(data){
				$(".result").eq(index).html(data)
				$('#ajax-loading').hide();
				$('.link').val(window.location.href);
			}
		})	
	})

	$(document).on("click", ".btn-cancel", function(){
		var index = $(".btn-cancel").index(this);
		$(".result").html("");
	})

	var img_p = $(".img-profile-div img");
    $(img_p).each(function(){
        var $this = $(this);
        if ($this.width() > $this.height()) {
            img_p.css("height","100%")
        }
        else{
            img_p.css("width","100%")  
        }
    });

    $(document).on("click", ".wrap-paket", function(){
		var wrapPaket = $(".wrap-paket");
		var index = wrapPaket.index(this);
		var valId = wrapPaket.eq(index).attr('data-value');
		redirect = '<?php echo base_url() ?>' + 'product/detail/'+valId;
		document.location = redirect;
	})

	$(".wrap-paket-header img").each(function(x){
		if ($(this).width() > $(this).height()) {
			$(this).css({'width':'auto','height':'100%'});
		}
		else{
			$(this).css({'width':'100%','height':'auto'});	
		}
			
	})
</script>