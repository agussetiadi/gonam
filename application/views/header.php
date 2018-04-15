<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="<?php echo $template_meta_des ?>">
<meta name="keywords" content="aqiqah online, qurban, kambing guling, catering, nasi box">
<title><?php echo $title ?></title>

<link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/icon.png">
	
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-clockpicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/jquery-clockpicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/sweetalert.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/summernote.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/sweetalert-dev.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/validate.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-clockpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-clockpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/main.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.number.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-number-input.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/helper.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-109233447-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-109233447-1');
</script>


</head>
<body>

<div id="wa">
	<a href="https://api.whatsapp.com/send?phone=6285289781700&text=Tuliskan%20Pesan%20Anda" target="new_blank">
		<img src="<?php echo base_url()."assets/img/whatsapp.png" ?>">
	</a>
</div>


<div id="ajax-loading">
	<div class="ajax-loading-text"><h4>Sedang memuat ....</h4></div>
</div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/bootstrap.js"></script>


<div class="container-fluid" style="background-color: #F5F5F5;">
<div class="row">

		<!-- HEAD MENU OPEN -->
		<div id="wrap-head">



		<!-- Menu Mobile -->
		<div class="w-menu-2">
			
			<div id="wrap-logo">
				<div class="m-logo">
					<a href="<?php echo base_url() ?>">
					<img src="<?php echo base_url()."assets/img/Logo-01.png" ?>">
					</a>
				</div>
				<div class="w-m-cart">
					<a class="hover-none" href="<?php echo base_url()."product/cart" ?>" title="Cart Belanja">
						<img id="shopping-cart" style="" src="<?php echo base_url() ?>assets/img/shopping-cart-m.png">
						<div class="badge btn-danger order_status cartN">0</div>
						
					</a>
					<!-- Menu Responsive Mobile -->
				</div>

				<div class="m-user">
					
					<?php if (empty($this->session_user->user_id())) {
						
					 ?>
					<div class="btn-login btn-login-m" style="margin-right: 25px;">
						<a class="hover-none" href="<?php echo base_url()."login/" ?>">masuk</a>
					</div>
					
					<?php } else{ ?>

					<a href="<?php echo base_url()."user/profile/" ?>" style=" color: white; position: relative;">
						<div class="" style="">
							<img src="<?php echo base_url()."assets/img/male.jpg" ?>">
						</div>
						
					</a>

					<?php } ?>

				</div>

			</div>
				<div class="nav-m">
					<div class="close-submenu close-m-menu cursor-pointer">
						<div class="fa fa-times"></div>
					</div>
					<div class="menu-m-logo">
						<img src="<?php echo base_url()."assets/img/Logo-01.png" ?>">
					</div>
					<a class="hover-none" href="<?php echo base_url() ?>"><b>HOME</b></a>
					<a class="hover-none" href="<?php echo base_url()."product" ?>"><b>PRODUCT</b></a>
					<a class="hover-none" href="<?php echo base_url()."blog/view/" ?>"><b>BLOG</b></a>
					<a class="hover-none" href="<?php echo base_url()."gallery/" ?>"><b>GALLERY</b></a>
					<a class="hover-none" href="<?php echo base_url()."testimoni/" ?>"><b>TESTIMONI</b></a>

					<?php if (empty($this->session->userdata('user_id'))) { ?>

					<div class="menu-sub-m-reg">
						<a href="<?php echo base_url()."login/" ?>">
						<button class="div-lainnya">Masuk</button>
						</a>
					</div>
					<div class="menu-sub-m-reg">
						<a href="<?php echo base_url()."daftar/" ?>">
						<button class="div-lainnya">Daftar</button>
						</a>
					</div>
					<?php } else { ?>
						<a href="<?php echo base_url()."logout/" ?>">
						<button class="btn-m-logout">Keluar</button>
						</a>
					<?php } ?>

				</div>
				<div class="wrap-menu-mobile cursor-pointer">
					<div class="menu-pin1"></div>
					<div class="menu-pin2"></div>
					<div class="menu-pin1"></div>
				</div>
		</div>




		<!-- menu pc -->
		<div class="w-menu-1">
			<div class="p-logo">
				<a href="<?php echo base_url() ?>">
				<img src="<?php echo base_url()."assets/img/Logo-01.png" ?>">
				</a>
			</div>
			<div id="wrap-menu" class="wrap-menu-content">
				<nav>
					<ul>


						<li><a href="<?php echo base_url() ?>"><b>HOME</b></a></li>
						<li><a href="<?php echo base_url()."product" ?>"><b>PRODUCT</b></a></li>
						<li><a href="<?php echo base_url()."blog/view/" ?>"><b>BLOG</b></a></li>
						<li><a href="<?php echo base_url()."gallery/" ?>"><b>GALLERY</b></a></li>
						<li><a href="<?php echo base_url()."testimoni/" ?>"><b>TESTIMONI</b></a></li>

						<li class="li-menu">
							<a href="<?php echo base_url()."product/cart" ?>" title="Cart Belanja">
								<div class="badge btn-danger order_status cartN">0</div>
								<img id="shopping-cart" src="<?php echo base_url() ?>assets/img/shopping-cart-m.png">
								<div class="badge btn-danger order_status"></div>
							</a>
						</li>

					</ul>
				</nav>

				<?php
				if (empty($this->session_user->user_id())) { ?>
					<nav style="margin-right: 20px; margin-left: 20px;">
						<div class="btn-daftar" style="float: left;"><a href="<?php echo base_url()."login/" ?>" title="Login Member">Masuk</a></div>
						<div class="btn-login" style="float: left;"><a href="<?php echo base_url()."daftar/" ?>" title="Daftar Member">Daftar</a></div>
					</nav>
				<?php }
				else{
				 ?>
					<nav style="width: 150px;">
						<a href="<?php echo base_url()."user/profile/" ?>" style=" color: white;">
							<div class="img-user-profile" style="margin-right: 10px; float: left;">
								<img src="<?php echo base_url()."assets/img/male.jpg" ?>">
							</div>
						</a>
						<a href="<?php echo base_url()."logout/" ?>" style="font-size: 25px; color: white; margin-left: 20px;">
							<span style="" class=" glyphicon glyphicon-log-in"></span>
						</a>
					</nav>
				<?php } ?>

			</div>
		</div>



		</div>
		</div>	
<script type="text/javascript">
	$(document).ready(function(){


		$(".wrap-menu-mobile").click(function(){
			$(".nav-m").show("fast");
		})
		$(".close-submenu").click(function(){
			$(".nav-m").hide("medium");
		})


		$(".img-user-profile img").each(function(){
			if ($(this).width() > $(this).height()) {
				$(this).css("height","100%")
			}
			else{
				$(this).css("width","100%")	
			}
		})
		$(".img-layout").each(function(){
			if ($(this).width() > $(this).height()) {
				$(this).css({"height":"100%"})
			}
			else{
				$(this).css("width","100%")	
			}
		})
	})



	$(document).ready(function(){
		$(".img-flex").each(function(){
			if ($(this).width() > $(this).height()) {
				$(this).css("width","100%")
			}
			else{
				$(this).css("height","100%")	
			}
		})
	})
</script>


