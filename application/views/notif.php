<div class="ajax_load">
	<h3>Notifikasi Member</h3>
	<div class="wrap-user-notif">
		<ul>
			<?php foreach ($query->result_array() as $key => $value) {
				
			?>
			<a class="hover-none" href="<?php echo $value['notif_user_link'] ?>"><li><hr><?php echo $value['notif_user_message']."<br><i>".class_date::arr_bulan($value['notif_user_date'])." ".substr($value['notif_user_time'], 0,5)."</i>" ?></li></a>
			<?php } ?>
		</ul>
	</div>
</div>