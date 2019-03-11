<?php 	

require_once 'core.php';

$sql = "SELECT order_id, client_name, client_contact, alamat, platform FROM orders WHERE order_status = 1";
$result = $connect->query($sql);
$x = 1;

$output = array('data' => array());

if($result->num_rows > 0) { 

 $platform = "";

 while($row = $result->fetch_array()) {
 	//$orderId = $row[0];

 	// $countOrderItemSql = "SELECT SUM(quantity) FROM order_item WHERE order_id = $orderId";
 	// $itemCountResult = $connect->query($countOrderItemSql);
 	// $itemCountRow = $itemCountResult->fetch_row();


	// platform
 	if($row[4] == 1) { 		
 		$platform = "Bukalapak";
 	} else if($row[4] == 2) {
 		$platform = "Tokopedia";
	} else if($row[4] == 3) {
 		$platform = "Shopee";
	} else if($row[4] == 4) {
 		$platform = "Lazada";
	} else if($row[4] == 5) {
 		$platform = "Elevenia";
 	} else {
 		$platform = "Direct";
 	}	

 	$output['data'][] = array(
		$x,
 		$row[1],
 		$row[2],
 		$row[3],
 		$platform
 		);
	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);