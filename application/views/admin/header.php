<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>System Gonam Aqiqah</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <link rel="stylesheet" href="<?php echo base_url()."assets/admin_panel/" ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/admin_panel/" ?>css/fontastic.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/admin_panel/" ?>css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url()."assets/admin_panel/" ?>css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()."assets/admin_panel/" ?>css/custom.css">
    <link rel="shortcut icon" href="favicon.png">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_panel/css/main.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin_panel/css/summernote-bs4.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_panel/css/dataTables.bootstrap4.min.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin_panel/css/responsive.dataTables.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_panel/css/glyphicons.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/admin_panel/css/sweetalert.css" ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin_panel/css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin_panel/css/jquery-clockpicker.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/admin_panel/css/bootstrap-select.min.css">
  
    
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>

<div class="wrap-alert">
  
</div>
    <!-- Javascript files-->
    
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/jquery-3.3.1.js"> </script>
  
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/jquery.validate.min.js"> </script>
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/bootstrap.bundle.js"></script>
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/jquery.cookie/jquery.cookie.js"></script>
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/front.js"></script>
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/main.js"></script>
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/jquery-ui.js"></script>
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/sweetalert.js"></script>
    <script src="<?php echo base_url()."assets/admin_panel/" ?>js/jquery.number.min.js"></script>
    <script src="<?php echo base_url()."assets/admin_panel/js/jquery-clockpicker.js" ?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."assets/admin_panel/js/bootstrap-select.min.js" ?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."assets/admin_panel/js/summernote-bs4.js" ?>" type="text/javascript"></script>
    <script src="<?php echo base_url()."assets/admin_panel/js/selectize.js" ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/admin_panel/js/highcharts.js"></script>
    <script src="<?php echo base_url()."assets/admin_panel/js/helper.js" ?>" type="text/javascript"></script>

    
    



    



    <div class="page home-page">
      <!-- Main Navbar-->
      <header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>



          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                <!-- Navbar Brand --><a href="index.html" class="navbar-brand">
                  <div class="brand-text brand-big"><span>Admin </span><strong>Dashboard</strong></div>
                  <div class="brand-text brand-small"><strong>AD</strong></div></a>
                <!-- Toggle Button--><a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Search-->
                <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="icon-search"></i></a></li>
                <!-- Notifications-->
                <li class="nav-item dropdown"> <a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell-o"></i><span class="badge bg-red" id="numNotif">0</span></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu" id="wNotif" style="max-height: 400px;overflow-y: scroll; ;">


                  </ul>
                </li>
                <!-- Messages-->

                <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-cog"></i></a>
                  <ul aria-labelledby="notifications" class="dropdown-menu">

                    <li><a rel="nofollow" href="<?php echo admin_url()."profile" ?>" class="dropdown-item d-flex">     
                        <div class="msg-body">
                          <h3 class="h5"><span class="fa fa-user"></span> Akun Saya</h3>
                        </div>
                        </a>
                    </li>
                    
                  </ul>
                </li>

                <!-- Logout    -->
                <li class="nav-item"><a href="<?php echo admin_url()."logout/" ?>" class="nav-link logout">Logout<i class="fa fa-sign-out"></i></a></li>
              </ul>
            </div>
          </div>
        </nav>
      </header>
      <div class="page-content d-flex align-items-stretch">
        <!-- Side Navbar -->
        <nav class="side-navbar">
          <!-- Sidebar Header-->


          <div class="sidebar-header d-flex align-items-center">
            <div class="avatar">
              <div style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; border:2px solid whitesmoke">
                <img id="fImgAdmin" src="<?php echo base_url().'assets/img/admin/'.str_replace(".", "_thumb.", $this->session_admin->admin_foto()); ?>" class="">
              </div>
            </div>
            <div class="title">
              <h1 class="h4" id="fAdminName"><?php echo $this->session_admin->admin_name(); ?></h1>
              <p>Admin</p>
            </div>
          </div>


          <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
          <ul class="list-unstyled">

            <li class=""> <a href="<?php echo admin_url() ?>"><i class="icon-home"></i>Home</a></li>
            <li> <a href="<?php echo admin_url()."pos" ?>"><i class="fa fa-folder-open-o"></i>Data Pesanan</a></li>
            <li> <a href="<?php echo admin_url()."pembelian" ?>"><i class="fa fa-shopping-cart"></i>Data Pembelian</a></li>


            <li><a href="#dashvariants" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-database"></i>Master </a>
              <ul id="dashvariants" class="collapse list-unstyled">
                <li><a href="<?php echo admin_url()."master/product" ?>">Data Product</a></li>
                <li><a href="<?php echo admin_url()."master/customer" ?>">Data Pelanggan</a></li>
                <li><a href="<?php echo admin_url()."master/admin" ?>">Data Admin</a></li>
                <li><a href="<?php echo admin_url()."master/user" ?>">Data Member</a></li>
                <li><a href="<?php echo admin_url()."master/unit" ?>">Data Satuan</a></li>
                <li><a href="<?php echo admin_url()."master/category" ?>">Data Kategori</a></li>
                <li><a href="<?php echo admin_url()."master/gallery" ?>">Gallery</a></li>
              </ul>
            </li>

            <li> <a href="<?php echo admin_url()."blog" ?>"><i class="fa fa-newspaper-o"></i>Kelola Blog</a></li>
            <li> <a href="<?php echo admin_url()."testimoni" ?>"><i class="fa  fa-commenting-o"></i>Kelola Testimoni</a></li>

            <li><a href="#lap" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-book"></i>Laporan </a>
              <ul id="lap" class="collapse list-unstyled">
                <li><a href="<?php echo admin_url()."report/sales" ?>">Laporan Penjualan</a></li>
                <li><a href="<?php echo admin_url()."report/pembelian" ?>">Laporan Pembelian</a></li>
              </ul>
            </li>


            <li> <a href="<?php echo admin_url()."config/" ?>"><i class="fa fa-wrench"></i>Pengaturan</a></li>
        </nav>
        <div class="content-inner">

         <script type="text/javascript">
           
           if ($("#fImgAdmin").width() > $("#fImgAdmin").height()) {
              $("#fImgAdmin").css({'width':'auto','height':'100%'});
           }
           else{
              $("#fImgAdmin").css({'height':'auto','width':'100%'});
           }

         </script>