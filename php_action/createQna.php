<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$kondisi = $_POST['kondisi'];
  $penanganan = nl2br($_POST['penanganan']);

	$sql = "INSERT INTO qna (kondisi, penanganan, qna_status) VALUES ('$kondisi', '$penanganan', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the QNA";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST