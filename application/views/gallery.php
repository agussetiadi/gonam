<div class="row">
<div class="block-white">

	<?php 
	foreach ($query->result_array() as $key => $value) {
	?>
	<div class="col-md-3">

		<a href="#" class="hover-none" data-toggle="modal" data-target="#modal">
			<div class="div-gallery">
				<div class="div-gallery-body">
					<img style="" class="gallery_data" data-value="<?php echo $value['src'] ?>" src="<?php echo base_url()."assets/img/post_img/".$value['image_thumb'] ?>">
				</div>
				

			</div>
		</a>

	</div>
	<?php } ?>


<div id="modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
      	<div id="result"></div>
      	<hr>
      	<div id="res_des"></div>
      </div>
      <div class="modal-footer">

      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
</div>
</div>



<script type="text/javascript">
	$(document)	.ready(function(){

		$(document).on("click", ".div-gallery", function(){
			showLoader("#modal .modal-body");
			$("#result").html("");
			var index = $(".div-gallery").index(this);
			var url = '<?php echo base_url()."assets/img/post_img/" ?>';
				$.ajax({
					success:function(){
					removeLoader("#modal .modal-body");
					var data = $(".gallery_data").eq(index).attr('data-value');
					$("#result").html('<img class="" style="width : 100%;" src="'+url+data+'">')
					$("#res_des").html($(".gallery_deskripsi").eq(index).val())

					}
				})
		})	
	})

	$(".div-gallery img").each(function(x){
		console.log($(this).width() + '-' + $(this).height())
		if ($(this).width() > $(this).height()) {
			$(this).css({'width':'','height':'100%'});
		}
		else{
			$(this).css({'width':'100%','height':''});	
		}
		
	})
</script>