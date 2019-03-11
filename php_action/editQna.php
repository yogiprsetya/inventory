<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$kondisi = $_POST['editQnaName'];
  $penanganan = nl2br($_POST['editPenanganan']); 
  $QnaId = $_POST['editQnaId'];

	$sql = "UPDATE qna SET kondisi = '$kondisi', penanganan = '$penanganan' WHERE Qna_id = '$QnaId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the QNA";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST