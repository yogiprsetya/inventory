<?php 	

require_once 'core.php';

$sql = "SELECT order_id, order_date, client_name, platform, shipping FROM orders WHERE order_status = 1 AND order_date >= DATE_ADD(NOW(), INTERVAL -31 DAY)";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $shipping = "";
 $platform = "";

 while($row = $result->fetch_array()) {
 	$orderId = $row[0];

 	//$orderItemSql = "SELECT product_id FROM order_item WHERE order_id = '$orderId'";
	//$product = $connect->query($orderItemSql);
	//$dataproduct = $product->fetch_row();
	//$beliapa = $dataproduct[0];
							
	//$productItemSql = "SELECT product_id, product_name FROM product WHERE product_id = '$beliapa'";
	//$productapa = $connect->query($productItemSql);
	//$beliini = $productapa->fetch_row();

	// platform
 	if($row[3] == 1) { 		
 		$platform = "Bukalapak";
 	} else if($row[3] == 2) {
 		$platform = "Tokopedia";
	} else if($row[3] == 3) {
 		$platform = "Shopee";
	} else if($row[3] == 4) {
 		$platform = "Lazada";
 	} else if($row[3] == 5) {
 		$platform = "Elevenia";
 	} else if($row[3] == 6) {
 		$platform = "Blanja";
 	} else if($row[3] == 7) {
 		$platform = "JD.ID";
 	} else {
 		$platform = "Direct";
 	}
	
 	// shipping
 	if($row[4] == 1) { 		
 		$shipping = "JNE";
 	} else if($row[4] == 2) {
 		$shipping = "SiCepat";
	} else if($row[4] == 3) {
 		$shipping = "Go-Send";
	} else if($row[4] == 4) {
 		$shipping = "Grab";
	} else if($row[4] == 5) {
 		$shipping = "Ninja";
	} else if($row[4] == 6) {
 		$shipping = "LEX";
	} else if($row[4] == 7) {
 		$shipping = "JX Express";
 	} else {
 		$shipping = "Direct";
 	}
 	
 	$link = '<a href="invoice.php?i='.$orderId.'" target="_blank" class="invoice-link">'.$row[2].'</a>';

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="orders.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>

	    <li><a href="invoice.php?i='.$orderId.'" > <i class="fa fa-address-card-o"></i> Invoice </a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';
	
	 	$output['data'][] = array( 		
 		// order date
 		$row[1],
 		// client name
 		$link,
 		// client contact
 		//$beliini[1],
 		$platform,
 		$shipping,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);