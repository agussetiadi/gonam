<div class="row">
	<div class="block-white">
	<div class="col-md-12">
	<div class="title-page text-center" style="border-style: none;">
		<h3 class="text-center">Daftar Member</h3>
	</div>
	</div>

	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="page-aqiqah" style="border-style: none;">
			<div class="div-register">
				<div class="head-register text-bold"></div>
					<img style="cursor: pointer;" id="bGoogle" class="btn-register-login" src="<?php echo base_url()."assets/img/btn-google.png" ?>">
					<div id="wLoader1" style="width: 150px; position: relative"></div>
				<div class="or-register text-bold">atau</div>
					<img style="cursor: pointer;" id="bFacebook" class="btn-register-login" src="<?php echo base_url()."assets/img/btn-fb.png" ?>">
					<div id="wLoader2" style="height: 50px; width: 150px; position: relative"></div>
				<div class="info-register"></div>
			</div>
		</div>
	</div>
	<div class="col-md-3"></div>

	</div>
</div>

<script type="text/javascript">
	
	var render_url = (callback)=>{
		$.ajax({
			url : '<?php echo base_url() ?>' + 'login/get_auth_url',
			method : 'POST',
			data : {},
			success : function(jsonData){
				btnRemoveLoader('#wLoader1');
				var dataObj = JSON.parse(jsonData);
					if (callback)
					callback(dataObj);

			}
		})
	}

	$(document).on("click", "#bGoogle", function(){
		btnLoader('#wLoader1','Redirect..');
			render_url(function(dataObj){
				var data = dataObj.data;
				var path = data.googleAuth

				document.location = path;
			})		
	})


	$(document).on("click", "#bFacebook", function(){
		btnLoader('#wLoader2','Redirect..');
			render_url(function(dataObj){
				var data = dataObj.data;
				var path = data.facebookAuth;
				document.location = path;
			})		
	})	
</script>

