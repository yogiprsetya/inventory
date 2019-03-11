<?php
session_start();
require_once 'php_action/core.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="author" content="Aneka Petindo">

	<title>Inventory</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.1.5/nprogress.css">
		
	<!-- Data Tables -->
	<link rel="stylesheet" href="assets/plugin/datatables/media/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
	
	<!-- file input -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.2/css/fileinput.min.css">

	<!-- jquery -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	
	<link rel="stylesheet" href="http://gramtool.net/inv/style.min.css">
</head>

<body>


<div class="main-menu">
	<header class="header">
		<a href="index.php" class="logo">CJ-Invent</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<div class="content">
		<div class="navigation">
			<h5 class="title">Navigation</h5>
			<ul class="menu js__accordion">
				<li id="navOrder"><a href="orders.php?o=add"><i class="menu-icon fa fa-cart-plus"></i><span>Order Baru</span></a></li>
				<li id="topNavManageOrder"><a href="orders.php?o=manord"><i class="menu-icon fa fa-tasks"></i><span>Manage Order</span></a></li>
				<!--<li id="navStock"><a href="stock.php?o=manstock"><i class="menu-icon fa fa-sign-in"></i><span>Stock Masuk</span></a></li>-->
			</ul>
			<h5 class="title">Data Master</h5>
			<ul class="menu js__accordion">
				<li id="navBrand"><a href="brand.php"><i class="menu-icon fa fa-legal"></i><span>Supplier</span></a></li>
				<li id="navCategories"><a href="categories.php"><i class="menu-icon fa fa-folder-open"></i><span>Kategori</span></a></li>
				<li id="navProduct"><a href="product.php"><i class="menu-icon fa fa-dropbox"></i><span>Stok Produk</span></a></li>
			</ul>
			<h5 class="title">Report</h5>
			<ul class="menu js__accordion">
				<li id="navReport"><a href="report.php"><i class="menu-icon fa fa-sticky-note-o"></i><span>Laporan Penjualan</span></a></li>
				<li id="navCust"><a href="datacust.php"><i class="menu-icon fa fa-address-book"></i><span>Data Customer</span></a></li>
			</ul>
			<a href="admincenter.php"><h5 class="title admin"><i class="menu-icon fa fa-comments-o"></i>Admin Center</h5></a>
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
	</div>
	<div class="pull-right">
		<a href="index.php" class="home-btn"><i class="fa fa-home"></i></a>
		<div class="ico-item extra-btn">
			<i class="fa fa-user-circle-o"></i>
			<ul class="sub-ico-item">
			    <li><a href="https://docs.google.com/spreadsheets/d/1iEqTBvNiKv7l-0U3jbZllWANGv7zgLq9c7sb3IubNuQ/edit" target="_blank">Stock Out</a></li>
			    <li class="divider"></li>
				<li><a href="setting.php">Settings</a></li>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</div>
	</div>
</div>
