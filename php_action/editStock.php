<?php 	

require_once 'core.php';
$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$stockId = $_POST['stockId'];

   $stockDate 						= date('Y-m-d', strtotime($_POST['stockDate']));
  $supplier 					= $_POST['supplier'];
  $grandTotal 						= $_POST['grandTotalValue'];

				
	$sql = "UPDATE stockmasuk SET stockdate = '$stockDate', supplier = '$supplier', grandtotal = '$grandTotal', order_status = 1 WHERE stockmasuk_id = {$stockId}";	
	$connect->query($sql);
	
	$readyToUpdateOrderItem = false;
	// add the quantity from the order item to product table
	for($x = 0; $x < count($_POST['productName']); $x++) {		
		//  product table
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);			
			
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			// order item table add product quantity
			$orderItemTableSql = "SELECT stockmasuk_item.stockmasuk_qty FROM stockmasuk_item WHERE stockmasuk_item.stockmasuk_id = {$stockId}";
			$orderItemResult = $connect->query($orderItemTableSql);
			$orderItemData = $orderItemResult->fetch_row();

			$editQuantity = $updateProductQuantityResult[0] + $orderItemData[0];							

			$updateQuantitySql = "UPDATE product SET quantity = $editQuantity WHERE product_id = ".$_POST['productName'][$x]."";
			$connect->query($updateQuantitySql);		
		} // while	
		
		if(count($_POST['productName']) == count($_POST['productName'])) {
			$readyToUpdateOrderItem = true;			
		}
	} // /for quantity

	// remove the order item data from order item table
	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$removeOrderSql = "DELETE FROM stockmasuk_item WHERE stockmasuk_id = {$stockId}";
		$connect->query($removeOrderSql);	
	} // /for quantity

	if($readyToUpdateOrderItem) {
			// insert the order item data 
		for($x = 0; $x < count($_POST['productName']); $x++) {			
			$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
			$updateProductQuantityData = $connect->query($updateProductQuantitySql);
			
			while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
				$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['stockMasuk'][$x];							
					// update product table
					$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
					$connect->query($updateProductTable);

					// add into stockmasuk_item
				$orderItemSql = "INSERT INTO stockmasuk_item (stockmasuk_id, product_id, stockmasuk_qty, harga, total, order_item_status) 
				VALUES ({$stockId}, '".$_POST['productName'][$x]."', '".$_POST['stockMasuk'][$x]."', '".$_POST['harga'][$x]."', '".$_POST['total'][$x]."', 1)";

				$connect->query($orderItemSql);		
			} // while	
		} // /for quantity
	}

	

	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);