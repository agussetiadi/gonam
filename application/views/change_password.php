<div class="ajax_load">
	<form method="POST" action="<?php echo base_url()."user/change_password_action" ?>">
			<h3>Change Password</h3>
			<div class="form-group">
				<label>Password Lama</label>
				<input type="password" class="input-text-12" name="pw_1" placeholder="Tuliskan password lama">
			</div>
			<div class="form-group">
				<label>Password Baru</label>
				<input type="password" class="input-text-12" name="pw_2" placeholder="Tuliskan password baru">
				<p style="color:red" class="r1"></p>
			</div>
			<div class="form-group">
				<label>Konfirmasi Password</label>
				<input type="password" class="input-text-12" name="pw_3" placeholder="Ketik ulang password baru">
				<input type="hidden" class="" name="ajax_request" value="true">
				<p style="color:red" class="r2"></p>
			</div>
			<input class="div-lainnya2" id="update-password" type="submit" name="" value="Kirim" style="margin-top: 35px">
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(document).on("click", "#update-password",function(f){
		$('.progress-content').show();
		f.preventDefault()
		form = $('form')[0];
			$.ajax({
				method:"POST",
				url:"<?php echo base_url()."user/change_password_action" ?>",
				method:"POST",
				data:new FormData(form),
				contentType:false,
				processData:false,
				success:function(data){
					console.log(data)
					jsonStatus = JSON.parse(data);
					setTimeout(function(){
						$('.progress-content').hide();
						if (jsonStatus.status == "success") {
							swal("Berhasil", "Password berhasil diupdate ", "success");

							setTimeout(function(){
								window.location = "<?php echo base_url()."login" ?>";
							}, 500)
						}
						else{
							swal("Failed", "Password tidak sesuai ", "error");
							$('.input-text-12').val("")
						}
					}, 1000)
				}
			})
		})
	})
</script>

			<script type="text/javascript">
			$(document).ready(function(){


					var pw_new_1 = $('input[name=pw_2]');
					var pw_new_2 = $('input[name=pw_3]');
					var response_1 = $('.r1');
					var response_2 = $('.r2');
					pw_new_1.on("input", function(){
						if ($(this).val().length < 5) {
							response_1.html('Password terlalu pendek')
							return false;
						}
						else{
							response_1.html('')	

						}
					})
					pw_new_2.on("input", function(){
						if (pw_new_1.val() != pw_new_2.val()) {
							response_2.html('Password tidak cocok');
							return false;
						}
						else{
							response_2.html('');

						}
					})
	
			})
		</script>