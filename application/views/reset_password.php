<div class="container">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		
		<div class="ajax_load">
	<form method="POST" action="<?php echo base_url()."recovery/change_password_action" ?>">
			<h3>Change Password</h3>
			<div class="form-group">
				<label>Password Baru</label>
				<input type="password" class="input-text-12" name="pw_2" placeholder="Tuliskan password baru" required="">
				<p style="color:red" class="r1"></p>
			</div>
			<div class="form-group">
				<label>Konfirmasi Password</label>
				<input type="password" class="input-text-12" name="password" placeholder="Ketik ulang password baru" required="">
				<p style="color:red" class="r2"></p>
			</div>
			<div class="row">
				<div class="col-md-6">
					<input class="div-lainnya2" id="update-password" type="submit" value="Kirim">
					
				</div>
				<div class="col-md-6">
					<a class="hover-none" href="<?php echo base_url()."user/profile/" ?>">
					<input class="div-lainnya2" type="button" value="Kembali Ke Profil">
					</a>
				</div>
			</div>
	</form>
</div>


			<script type="text/javascript">
			$(document).ready(function(){


					var pw_new_1 = $('input[name=pw_2]');
					var pw_new_2 = $('input[name=password]');
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
					$("form").on("submit", function(){
						if (pw_new_1.val() != pw_new_2.val()) {
							response_2.html('Password tidak cocok');
							return false;
						}
						if (pw_new_1.val().length < 5) {
							return false;
						}
					})
	
			})
		</script>

	</div>
	<div class="col-md-3"></div>
</div>