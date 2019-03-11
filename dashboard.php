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

$lowstocktableSql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id, product.quantity, brands.brand_name FROM product 
					INNER JOIN brands ON product.brand_id = brands.brand_id 
					WHERE quantity <= 3 AND quantity != 0 AND status = 1";
$lowstocktableResult = $connect->query($lowstocktableSql);

$stockKosongtableSql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id, product.quantity, brands.brand_name FROM product 
						INNER JOIN brands ON product.brand_id = brands.brand_id 
						WHERE quantity = 0 AND status = 1";
$stockKosongtableResult = $connect->query($stockKosongtableSql);

$orderTokopedia = "SELECT * FROM orders WHERE platform = 2 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderTokopediaQuery = $connect->query($orderTokopedia);
$countOrderTokopedia = $orderTokopediaQuery->num_rows;

$orderBukalapak = "SELECT * FROM orders WHERE platform = 1 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderBukalapakQuery = $connect->query($orderBukalapak);
$countOrderBukalapak = $orderBukalapakQuery->num_rows;

$orderShopee = "SELECT * FROM orders WHERE platform = 3 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderShopeeQuery = $connect->query($orderShopee);
$countOrderShopee = $orderShopeeQuery->num_rows;

$orderLazada = "SELECT * FROM orders WHERE platform = 3 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderLazadaQuery = $connect->query($orderLazada);
$countOrderLazada = $orderLazadaQuery->num_rows;

$orderLazada = "SELECT * FROM orders WHERE platform = 4 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderLazadaQuery = $connect->query($orderLazada);
$countOrderLazada = $orderLazadaQuery->num_rows;

$orderElevenia = "SELECT * FROM orders WHERE platform = 5 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderEleveniaQuery = $connect->query($orderElevenia);
$countOrderElevenia = $orderEleveniaQuery->num_rows;

$orderBlanja = "SELECT * FROM orders WHERE platform = 6 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderBlanjaQuery = $connect->query($orderBlanja);
$countOrderBlanja = $orderBlanjaQuery->num_rows;

$orderJD = "SELECT * FROM orders WHERE platform = 7 AND order_date >= DATE_ADD(NOW(), INTERVAL -30 DAY)";
$orderJDQuery = $connect->query($orderJD);
$countOrderJD = $orderJDQuery->num_rows;

$TopProduct = "SELECT * FROM order_item WHERE order_item_status = 1 LIMIT 8";
$TopProductQuery = $connect->query($TopProduct);

$connect->close();

?>

<div id="wrapper">
	<div class="main-content">
	    
		<div class="row small-spacing">
			<div class="col-lg-3 col-xs-12">
				<div class="box-content hovered">
					<a href="product.php" class="statistics-box with-icon">
						<i class="ico fa fa-dropbox text-inverse"></i>
						<h2 class="counter text-inverse"><?php echo $countProduct; ?></h2>
						<p class="text">Total Produk</p>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12">
				<div class="box-content hovered">
					<a href="orders.php?o=manord" class="statistics-box with-icon">
						<i class="ico fa fa-list-alt text-success"></i>
						<h2 class="counter text-success"><?php echo $countOrder; ?><small> order</small></h2>
						<p class="text">Last 30 Days</p>
					</a>
				</div>
			</div>	
			<div class="col-lg-3 col-xs-12">
				<div class="box-content hovered">
					<a href="#" data-toggle="modal" data-target="#lowStockModal" class="statistics-box with-icon">
						<i class="ico fa fa-battery-1 text-warning"></i>
						<h2 class="counter text-warning"><?php echo $countLowStock; ?></h2>
						<p class="text">Low Stock: -3</p>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-xs-12">
				<div class="box-content hovered">
					<a href="#" data-toggle="modal" data-target="#StockKosongModal" class="statistics-box with-icon">
						<i class="ico fa fa-warning text-danger"></i>
						<h2 class="counter text-danger"><?php echo $countStockKosong; ?></h2>
						<p class="text">Stock Kosong</p>
					</a>
				</div>
			</div>
		</div>
	
	    <div class="row small-spacing">
		    <div class="col-lg-6 col-md-6">
			    <div class="box-content">
				    <h4 class="box-title mini-margin">Trend Marketplace: last 30 days</h4>
				    <canvas id="mp-chart" height="300" width="451"></canvas>
			    </div>
		    </div>
		    
		    <div class="col-lg-6 col-md-6">
			    <div class="box-content">
				    <h4 class="box-title mini-margin">Top Product: last 30 days</h4>
				        <ul class="list-group">
				            <?php while ($LoopTopProduct = $TopProductQuery->fetch_assoc()) { ?>
                            <!--<li class="list-group-item"><span class="badge badge-primary">14</span><?php //echo $LoopTopProduct[2]; ?></li>-->
                            <?php } ?>
                        </ul>
			    </div>
		    </div>
        </div>
        
    </div>

<div class="modal fade" id="lowStockModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-battery-1"></i> Table Low Stock</h4>
	    </div>
	    <div class="modal-body">
			<table class="table table-striped manord" id="lowStockTable">
				<thead>
					<tr>
						<th>Photo</th>
						<th>Product</th>
						<th>Qty</th>
						<th>Supplier</th> 
					</tr>
				</thead>
				<tbody>
				<?php
					while($lowstockData = $lowstocktableResult->fetch_array()) {
					
					$imageUrl = substr($lowstockData[2], 3);
				?>
					<tr>
						<td style="width:5%"><a class="image-viewer" href="<?php echo $imageUrl ?>"><img src="<?php echo $imageUrl ?>" style='height:30px; width:50px;'/></a></td>
						<td><?php echo $lowstockData[1] ?></td>
						<td style="width:5%"><?php echo $lowstockData[4] ?></td>
						<td style="width:10%"><?php echo $lowstockData[5] ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
	    </div> <!-- /modal-body -->
    </div>
  </div><!-- /modal-dailog -->
</div>

<div class="modal fade" id="StockKosongModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    	<div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-warning"></i> Table Low Stock</h4>
	    </div>
	    <div class="modal-body">
			<table class="table table-striped manord" id="StockKosongTable">
				<thead>
					<tr>
						<th>Photo</th>
						<th>Product</th>
						<th>Qty</th>
						<th>Supplier</th> 
					</tr>
				</thead>
				<tbody>
				<?php
					
					while($stockKosongData = $stockKosongtableResult->fetch_array()) {
					
					$imageUrl = substr($stockKosongData[2], 3);
				?>
					<tr>
						<td style="width:5%"><a class="image-viewer" href="<?php echo $imageUrl ?>"><img src="<?php echo $imageUrl ?>" style='height:30px; width:50px;'/></a></td>
						<td><?php echo $stockKosongData[1] ?></td>
						<td style="width:5%"><?php echo $stockKosongData[4] ?></td>
						<td style="width:10%"><?php echo $stockKosongData[5] ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
	    </div> <!-- /modal-body -->
    </div>
  </div><!-- /modal-dailog -->
</div>

<script type="text/javascript">
$(document).ready(function(){
    $('#lowStockTable').DataTable();
	$('#StockKosongTable').DataTable();
});
</script>

<script type="text/javascript" src="assets/plugin/export/tableExport.js"></script>
<script type="text/javascript" src="assets/plugin/export/jquery.base64.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
new Chart(document.getElementById("mp-chart"), {
    type: 'bar',
    data: {
      labels: ["Bukalapak", "Shopee", "Tokopedia", "Lazada", "Elevenia", "Blanja", "JD.ID"],
      datasets: [{
        label: "Jumlah transaksi",
        backgroundColor: ["#fe4365","#ff5f2e","#3ac569","#54546c","#fcbe32","#e32413", "#c92530"],
        data: [<?php echo $countOrderBukalapak ?>,<?php echo $countOrderShopee ?>,<?php echo $countOrderTokopedia ?>,<?php echo $countOrderLazada ?>,<?php echo $countOrderElevenia ?>,<?php echo $countOrderBlanja ?>,<?php echo $countOrderJD ?>]
      }]
    },
    options: {
	  legend: {
            display: false,
            labels: {
                boxWidth: 12,
            }
        }
    }
});

</script>

<?php require_once 'includes/footer.php'; ?>