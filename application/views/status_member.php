<li class="user-login cursor-pointer">
	<div class="user-profile"></div>
	<?php echo $getUser['picture'] ?>
	<div class="sub-ul">
		<li><a id="u_name" href="<?php echo base_url()."user/profile/".$getUser['replace_name'] ?>"><?php echo $getUser['name'] ?></a></li>
		<li><a href="<?php echo base_url()."user/logout" ?>">Logout</a></li>
	</div>
</li>
<script type="text/javascript">
	$(document).ready(function(){
		$('.user-login').click(function(){
			$(this).find('ul').toggle();

		})
	})
</script>