<?php 	

require_once 'core.php';

$sql = "SELECT qna_id, kondisi, penanganan FROM qna WHERE qna_status = 1";
$result = $connect->query($sql);$arrayNumber = 0;

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$QnaId = $row[0];
	
	$kondisi = '<p style="font-size:15px">'.$row[1].'</p>';
	$copyareaclass = 'copyarea' . $arrayNumber;
	
	$copyarea = '<div class="copyarea" id="'.$copyareaclass.'">'.$row[2].'</div><button onclick="copyToClipboard('.$copyareaclass.')" class="btn copy-btn">Copy</button>';

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editQnaModalBtn" data-target="#editQnaModal" onclick="editQna('.$QnaId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeQnaModal" id="removeQnaModalBtn" onclick="removeQna('.$QnaId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array(
 		$kondisi,
 		$copyarea,
 		$button 		
 		);
	$arrayNumber++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);