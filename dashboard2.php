<?php

require_once 'includes/header.php';

$sql = "SELECT * FROM product WHERE status = 1";
$query = $connect->query($sql);
$countProduct = $query->num_rows;

$orderSql = "SELECT * FROM orders WHERE order_status = 1 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderQuery = $connect->query($orderSql);
$countOrder = $orderQuery->num_rows;

$lowStockSql = "SELECT * FROM product WHERE quantity <= 3 AND status = 1";
$lowStockQuery = $connect->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;

$StockKosongSql = "SELECT * FROM product WHERE quantity = 0 AND status = 1";
$StockKosongQuery = $connect->query($StockKosongSql);
$countStockKosong = $StockKosongQuery->num_rows;

//$Topsql = "SELECT product_id, product_name, product_image FROM product WHERE product_status = 1";
//$Topsql = "SELECT TOP 3 order_item.order_item_id, order_item.quantity, product.product_id, product.product_name, product.product_image FROM order_item 
//		INNER JOIN product ON order_item.product_id = product.product_id WHERE order_item.order_item_status = 1"; 
		
//$Topresult = $connect->query($Topsql);

$connect->close();

?>

<div id="wrapper">
	<div class="main-content">
	    
		<div class="row small-spacing">
			<div class="col-lg-3 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico fa fa-dropbox text-inverse"></i>
						<h2 class="counter text-inverse"><?php echo $countProduct; ?></h2>
						<p class="text">Total Produk</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico fa fa-list-alt text-success"></i>
						<h2 class="counter text-success"><?php echo $countOrder; ?><small> order</small></h2>
						<p class="text">Last 30 Days</p>
					</div>
				</div>
			</div>	
			<div class="col-lg-3 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico fa fa-battery-1 text-warning"></i>
						<h2 class="counter text-warning"><?php echo $countLowStock; ?></h2>
						<p class="text">Low Stock: -3</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12">
				<div class="box-content">
					<div class="statistics-box with-icon">
						<i class="ico fa fa-warning text-danger"></i>
						<h2 class="counter text-danger"><?php echo $countStockKosong; ?></h2>
						<p class="text">Stock Kosong</p>
					</div>
				</div>
			</div>
		</div>

    </div>
</div>
<?php require_once 'includes/footer.php'; ?>