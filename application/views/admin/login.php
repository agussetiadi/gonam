<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Aplikasi Aqiqah Online</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/css/" ?>bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>font-awesome.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>material-design-iconic-font.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>animate.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>animsition.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>select2.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>daterangepicker.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_login/" ?>main.css">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form"  method="POST" action="<?php echo base_url()."admin/login/check_login" ?>">
					
					<span class="login100-form-title p-b-48">
						<img src="<?php echo base_url()."assets/img/system/logo-01.png" ?>">
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Required">
						<input class="input100" type="text" name="username">
						<span class="focus-input100" data-placeholder="Username" ></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>


				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
	
	
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>

	<script src="<?php echo base_url()."assets/admin_login/"; ?>animsition.min.js"></script>

	<script src="<?php echo base_url()."assets/admin_login/"; ?>popper.js"></script>
	<script src="<?php echo base_url()."assets/js/"; ?>bootstrap.js"></script>

	<script src="<?php echo base_url()."assets/admin_login/"; ?>select2.min.js"></script>

	<script src="<?php echo base_url()."assets/admin_login/"; ?>moment.min.js"></script>
	<script src="<?php echo base_url()."assets/admin_login/"; ?>daterangepicker.js"></script>

	<script src="<?php echo base_url()."assets/admin_login/"; ?>countdowntime.js"></script>

	<script src="<?php echo base_url()."assets/admin_login/"; ?>main.js"></script>

</body>
</html>