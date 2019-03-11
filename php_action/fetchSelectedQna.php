<?php 	

require_once 'core.php';

$QnaId = $_POST['QnaId'];

$sql = "SELECT qna_id, kondisi, penanganan FROM qna WHERE qna_id = $QnaId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);