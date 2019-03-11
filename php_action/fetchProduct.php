<?php

require_once 'core.php';

$sql = "SELECT product.product_id, product.product_name, product.product_image, product.brand_id,
 		product.categories_id, product.quantity, product.rate, product.posisi, product.status, 
 		brands.brand_name, categories.categories_name FROM product 
		INNER JOIN brands ON product.brand_id = brands.brand_id 
		INNER JOIN categories ON product.categories_id = categories.categories_id  
		WHERE product.status = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 $active = ""; 

 while($row = $result->fetch_array()) {
 	$productId = $row[0];
 	// active

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

	$brand = $row[9];
	$category = $row[10];
	$imageUrl = substr($row[2], 3);
	$productImage = "<a class='image-viewer' href='".$imageUrl."'><img src='".$imageUrl."' style='height:30px; width:50px;'/></a>";

 	$output['data'][] = array( 		
 		// image
 		$productImage,
 		// product name
 		$row[1], 
 		// rate
 		$row[6],
 		// quantity 
 		$row[5], 		 	
 		// brand
 		$brand,
 		// category 		
 		$category,
 		// active
 		$row[7],
 		// button
 		$button 		
 		); 	
 } // /while

}// if num_rows

$connect->close();

echo json_encode($output);