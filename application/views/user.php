<div class="container-fluid wrap-page">
	<div class="container wrap-content">
	<div class="col-md-3">
	<div class="row">
		<button class="div-lainnya2 menu-user-m">Menu User</button>
		<div class="nav-user">
			<a data-id="1" class="nav-user-ref" href="<?php echo base_url()."user/profile/" ?>" id="profile">Profile</a>
			<?php 
			if ($provider == "basic") {
				
			
			?>
			<a data-id="2" class="nav-user-ref" href="<?php echo base_url()."user/change_password/" ?>">Ubah Password</a>
			<?php } ?>
			<a data-id="4" class="nav-user-ref" href="<?php echo base_url()."user/my_order/" ?>">History Pemesanan</a>
			<a data-id="5" class="nav-user-ref" href="<?php echo base_url()."user/testimoni/" ?>">Testimoni</a>
			
			<a data-id="5" class="nav-user-ref notif-btn" href="<?php echo base_url()."user/notif/" ?>">Notification<div class="badge badge-total"><?php if ($num_notif != 0) {
				echo $num_notif;
			} ?></div></a>
		</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="row">
		<div class="content-user">

		<?php echo $user_content ?>
		</div>

			<div class="progress-content">
				<img src="<?php echo base_url()."assets/img/loader.gif" ?>">
			</div>
		</div>
	</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

	var base_url = "<?php echo base_url() ?>";

		if ($(window).width() < 800) {
			$(".nav-user-ref").click(function(){
				$(".nav-user").hide();	
			})
		}

		$(".menu-user-m").click(function(){
			$(".nav-user").slideToggle("fast");
		})

	$(".notif-btn").click(function(){
		$.ajax({
		  url:base_url+"user/clear_notif",
      	  method:"POST",
      	  data:{},
      	  success:function(){
			$(".badge-total").remove();
      	  }

		})
	})
	function ajax_rq2(param_url){
      var param_url = param_url;
      $.ajax({
        url:param_url,
        method:"POST",
        data:{ajax_request:"true"},
        success:function(data){
          $('.ajax_load').replaceWith(data);
          window.history.pushState('','null', param_url);
        }
      })
    }
    $(".note-group-select-from-files").hide();

		$(document).on("click", "#update-profile",function(e){
			$('.progress-content').show();
			e.preventDefault()
			form = $('form')[0];
				$.ajax({
					method:"POST",
					url:base_url+'user/update_profile',
					method:"POST",
					data:new FormData(form),
					contentType:false,
					processData:false,
					success:function(data){
						jsonData = JSON.parse(data);

						$('.progress-content').hide();
						swal("Berhasil", "Data berhasil diupdate ", "success");
						ajax_rq2(base_url+'user/profile/')
	
					}
				})
		})

		/*$('.nav-user-ref').each(function(x){*/
			$(document).on("click" ,'.nav-user-ref',function(e){
			$('.nav-user-ref').removeClass('menu-light');
			$(this).addClass('menu-light');
			urlPath = $(this).attr("href");
			$('.progress-content').show();
			e.preventDefault();
				$.ajax({
					method:"POST",
					url:urlPath,
					data:{ajax_request:"true"},
					success:function(data){
						$('.progress-content').hide();
						$('.ajax_load').replaceWith(data);
						 window.history.pushState('','null', urlPath);
					}
				})

			})
		/*})*/

	})
</script>