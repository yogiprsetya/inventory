<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$stockId = $_POST['stockmasuk_Id'];

if($orderId) { 

 $sql = "UPDATE stockmasuk SET stockmasuk_status = 2 WHERE stockmasuk_id = {$stockId}";

 $orderItem = "UPDATE stockmasuk_item SET stockmasuk_item_status = 2 WHERE stockmasuk_id = {$orderId}";

 if($connect->query($sql) === TRUE && $connect->query($orderItem) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST