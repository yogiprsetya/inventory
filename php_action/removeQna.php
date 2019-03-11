<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$QnaId = $_POST['QnaId'];

if($QnaId) { 

 $sql = "UPDATE qna SET qna_status = 2 WHERE qna_id = {$QnaId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST