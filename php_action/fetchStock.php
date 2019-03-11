<?php 	

require_once 'core.php';

$sql = "SELECT stockmasuk_id, stockdate, supplier FROM stockmasuk WHERE stockmasuk_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 while($row = $result->fetch_array()) {
 	$stockmasuk_id = $row[0];
	$supplier = $row[2];

 	$countOrderItemSql = "SELECT SUM(stockmasuk_qty) FROM stockmasuk_item WHERE stockmasuk_id = $stockmasuk_id";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();
	
	$supplierSql = "SELECT brand_name FROM brands WHERE brand_id = '$supplier'";
	$supplierSqlResult = $connect->query($supplierSql);
 	$supplierSqlRow = $supplierSqlResult->fetch_row();

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="stock.php?o=editStock&i='.$stockmasuk_id.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>

	    <li><a href="invoice.php?o=editOrd&i='.$stockmasuk_id.'" > <i class="fa fa-address-card-o"></i> Invoice </a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeStock('.$stockmasuk_id.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';		

 	$output['data'][] = array( 		
 		// order date
 		$row[1],
 		// client name
 		$supplierSqlRow, 
 		// client contact
 		$itemCountRow,
 		// button
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);