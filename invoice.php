<?php

require_once 'includes/header.php';

$orderId = $_GET['i'];

	$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.sub_total, orders.note, orders.platform, orders.shipping, orders.alamat, orders.admin FROM orders 	
		WHERE orders.order_id = {$orderId}";

	$result = $connect->query($sql);
	$data = $result->fetch_row();
	
	$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total, product.product_name FROM order_item	INNER JOIN product ON order_item.product_id = product.product_id 
	WHERE order_item.order_id = $orderId";
	$orderItemResult = $connect->query($orderItemSql);
?>
<div id="wrapper">
	<div class="main-content">
		<div class="row">
			<div class="col-md-7 col-xs-12">
				<div class="invoice-box">
					<table>
						<tr class="top">
							<td colspan="4">
								<table>
									<tr>
										<td class="title">
											<a href="#" class="logo">Caesar<span>Jaco</span></a>
										</td>
										
										<td style="font-size:14px;line-height:16px">
											Invoice #: <?php echo $data[0] ?><br>
											Date: <?php echo $data[1] ?><br>
											Admin: <?php echo $data[9] ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr class="information">
							<td colspan="4">
								<table>
									<tr>
										<td style="width:54%"><?php echo $data[8] ?></td>
										
										<td>
											<?php echo $data[2] ?><br>
											Nomor: <?php echo $data[3] ?><br>
											Marketplace:
											<?php // platform
											if($data[6] == 1) { 		
												echo "Bukalapak";
											} else if($data[6] == 2) {
												echo "Tokopedia";
											} else if($data[6] == 3) {
												echo "Shopee";
											} else if($data[6] == 4) {
												echo "Lazada";
											} else if($data[6] == 5) {
												echo "Elevenia";
											} else {
												echo "Direct";
											} ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr class="heading">
							<td>Item</td>
							<td>Harga</td>
							<td style="width:10%"><center>Qty</center></td>
							<td style="width:20%" class="text-right">Sub Total</td>
						</tr>
						<?php while($row = $orderItemResult->fetch_array()) {	?>
						<tr class="item">
							<td><?php echo $row[4] ?></td>
							<td><?php echo $row[1] ?></td>
							<td><center><?php echo $row[2] ?></center></td>
							<td class="text-right"><?php echo $row[3] ?></td>
						</tr>
						<?php }?>
						
						<tr class="total"><td colspan="4">Total: Rp. <?php echo $data[4] ?></td></tr>
						<tr><td colspan="4">Note: <?php echo $data[5] ?></td></tr>
					</table>
					<div class="text-right margin-top-20">
						<ul class="list-inline">
							<li><button type="button" class="btn btn-primary"><i class='fa fa-print'></i> Print</button></li>
							<li><a type="button" href="orders.php?o=manord" class="btn btn-default"> <i class="fa fa-tasks"></i> Manage Order</a></li>
							<li><a type="button" href="orders.php?o=editOrd&i=<?php echo $orderId ?>" class="btn btn-default"> <i class="glyphicon glyphicon-edit"></i> Edit Order</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!--/#wrapper -->

<?php require_once 'includes/footer.php'; ?>