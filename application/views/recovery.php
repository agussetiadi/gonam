<div class="row">
	<div class="block-white">
		<div class="col-md-3"></div>
		<div class="col-md-6">
		<?php echo $alert; ?>
		<h3 style="margin-bottom: 50px; text-align: center">Recovery Akun</h3>
			<div class="form-group">

			<form method="POST" action="<?php echo base_url()."recovery/send/" ?>">
				<label>Masukan Email/username Anda</label>
				<input type="text" class="input-text-12" name="email" placeholder="Masukan email anda" style="margin-bottom: 20px;">
				<div class="row">
					<div class="col-md-6"><button type="submit" value="email" name="type" class="div-lainnya2">Kirim Verifikasi Email</button></div>
					<div class="col-md-6"><button type="submit" value="phone" name="type" class="div-lainnya2">Kirim Kode Ke No Hp</button></div>
				</div>
			</form>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>