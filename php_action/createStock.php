<?php 	

require_once 'core.php';
$valid['success'] = array('success' => false, 'messages' => array(), 'stockmasuk_id' => '');

if($_POST) {	

  $stockDate 						= date('Y-m-d', strtotime($_POST['stockDate']));
  $supplier 					= $_POST['supplier'];
  $grandTotal 						= $_POST['grandTotalValue'];

				
  $sql = "INSERT INTO stockmasuk (stockdate, supplier, grandtotal, stockmasuk_status) VALUES ('$stockDate', '$supplier', '$grandTotal', 1)";
	
	
	$stockmasuk_id;
	$stockmasukStatus = false;
	if($connect->query($sql) === true) {
		$stockmasuk_id = $connect->insert_id;
		$valid['stockmasuk_id'] = $stockmasuk_id;

		$stockmasukStatus = true;
	}

	$stockmasukItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] + $_POST['stockMasuk'][$x];
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO stockmasuk_item (stockmasuk_id, product_id, stockmasuk_qty, harga, total, stockmasuk_item_status) 
				VALUES ('$stockmasuk_id', '".$_POST['productName'][$x]."', '".$_POST['stockMasuk'][$x]."', '".$_POST['harga'][$x]."', '".$_POST['grandTotalValue'][$x]."', 1)";

				$connect->query($orderItemSql);

				if($x == count($_POST['productName'])) {
					$stockmasukItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);