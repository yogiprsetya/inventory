<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$productId = $_POST['productId'];

if($productId) { 

 $sql = "UPDATE product SET status = 2 WHERE product_id = {$productId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the product";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST