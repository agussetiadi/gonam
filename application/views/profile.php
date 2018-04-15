<div class="ajax_load">
	<form class="form_ajax" method="POST" action="<?php echo base_url()."user/update_profile" ?>">
			<h3>Profile</h3>
			<div class="form-group">
				<label>Nama</label>
				<input type="text" class="input-text-12" name="name" value="<?php echo $name ?>">
			</div>
			<div class="form-group">
				<label>No Hp/WA</label>
				<input type="text" class="input-text-12" name="phone" value="<?php echo $phone ?>">
			</div>
			<div class="form-group">
				<label>Alamat</label>
				<input type="text" class="input-text-12" name="address" value="<?php echo $address ?>">
			</div>
			<input type="hidden" class="input-text-12" name="ajax_request">
			<input class="div-lainnya2" id="update-profile" type="submit" name="" value="Kirim" style="margin-top: 35px">
	</form>
</div>