<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order

$userId = $_SESSION["userId"];
$ceknama = "SELECT username FROM users WHERE user_id = '$userId'";
$cekresult = $connect->query($ceknama);
$datanama = $cekresult->fetch_row();
?>


<div id="wrapper">
	<div class="main-content">
		<div class="col-xs-12">
			
		<?php if($_GET['o'] == 'add') { ?>
  		<div class="box-content card white">
		<?php } else if($_GET['o'] == 'manord') { ?>
			<div class="box-content">
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<div class="box-content card white">
		<?php } ?>
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>
		<h4 class="box-title">Transaksi</h4>
		<div class="success-messages"></div> <!--/success-messages-->
		<div class="card-content">
  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">
			<div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			</div> <!--/form-group-->
			<div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Nama Customer</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Nama Customer" autocomplete="off" />
			    </div>
			</div> <!--/form-group-->
			<div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">No. Customer</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="No. Customer" autocomplete="off" />
			    </div>
			</div> <!--/form-group-->
			<div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Alamat</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" autocomplete="off" />
			    </div>
			</div> <!--/form-group-->

			<table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Product</th>
			  			<th style="width:20%;">Rate</th>
			  			<th style="width:15%;">Quantity</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:8%;"></th>
			  		</tr>
			 	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 10; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control select2_1" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~ SELECT ~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);
										
			  							while($row = $productData->fetch_array()) {
											$imageUrl = substr($row['product_image'], 3);
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' class='tooltip'>".$row['product_name']."</option>";
										} 	 // /while 
			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="text" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>
			  					<button style="padding:9px 20px;" class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
					<?php	$arrayNumber++;	} //for ?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
				<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				</div>
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Note</label>
				    <div class="col-sm-9">
				      <textarea rows="1" type="text" class="form-control" id="note" name="note" value="" autocomplete="off"></textarea>
				    </div>
				  </div>
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Platform</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="platform" id="platform">
				      	<option value="">~ SELECT ~</option>
						<option value="0">Direct</option>
				      	<option value="1">Bukalapak</option>
				      	<option value="2">Tokopedia</option>
				      	<option value="3">Shopee</option>
						<option value="4">Lazada</option>
						<option value="5">Elevenia</option>
						<option value="6">Blanja</option>
						<option value="7">JD</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Pengiriman</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="shipping" id="shipping">
				      	<option value="">~ SELECT ~</option>
						<option value="0">Direct</option>
				      	<option value="1">JNE</option>
				      	<option value="2">SiCepat</option>
				      	<option value="3">Go-Send</option>
						<option value="4">Grab</option>
						<option value="5">Ninja Express</option>
						<option value="6">LEX</option>
						<option value="7">JX Express</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				     <label for="clientContact" class="col-sm-3 control-label">Admin</label>
				     <div class="col-sm-9">
				        <input type="text" name="admin" id="admin" value="<?php echo $datanama[0]; ?>" autocomplete="off" readonly="true" class="form-control" />
				     </div>
				  </div> <!--/form-group-->
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-3 col-sm-10 action-order">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn"> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
		</div>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<h4 class="box-title">Manage Order</h4>
			<div class="dropdown js__drop_down">
				<a href="orders.php?o=add" type="button" class="btn btn-xs btn-primary pull-right button1"><i class="ico ico-left fa fa-plus"></i>Add Transaksi</a>
			</div>
			<div id="success-messages"></div>
			<table class="table table-striped manord" id="manageOrderTable">
				<thead>
					<tr>
						<th style="width:15%">Date</th>
						<th>Client Name</th>
						<!--<th style="width:22%">Product</th>-->
						<th style="width:15%">Platform</th>
						<th style="width:15%">Shipping</th>
						<th style="width:11%">Option</th>
					</tr>
				</thead>
			</table>
			

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			<h4 class="box-title">Edit Transaksi</h4>
			<div class="success-messages"></div> <!--/success-messages-->
			<div class="card-content">
  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.alamat, orders.sub_total, orders.note, orders.platform, orders.shipping FROM orders 	
					WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Nama Customer</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="<?php echo $data[2] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">No. Customer</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="<?php echo $data[3] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Alamat</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" autocomplete="off" value="<?php echo $data[4] ?>"/>
			    </div>
			</div> <!--/form-group-->

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Product</th>
			  			<th style="width:20%;">Rate</th>
			  			<th style="width:15%;">Quantity</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity, order_item.rate, order_item.total FROM order_item WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">

			  					<select class="form-control select2_1" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE status = 1";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="text" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $data[5] ?>" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $data[4] ?>" />
				    </div>
				  </div> <!--/form-group--		  
				  <div class="form-group">
				    <label for="vat" class="col-sm-3 control-label">VAT 13%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" value="<?php //echo $data[5] ?>"  />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" value="<?php //echo $data[5] ?>"  />
				    </div>
				  </div> <!--/form-group--
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php //echo $data[6] ?>" />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php //echo $data[6] ?>"  />
				    </div>
				  </div> <!--/form-group-->
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Note</label>
				    <div class="col-sm-9">
				      <textarea type="text" class="form-control" id="note" name="note" autocomplete="off"><?php echo $data[6] ?></textarea>
				    </div>
				  </div> <!--/form-group--
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php //echo $data[8] ?>"  />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php //echo $data[8] ?>"  />
				    </div>
				  </div> <!--/form-group-->
			  </div> <!--/col-md-6-->

			  <div class="col-md-6"><!--
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php //echo $data[9] ?>"  />
				    </div>
				  </div> <!--/form-group--
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php //echo $data[10] ?>"  />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php //echo $data[10] ?>"  />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Platform</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="platform" id="platform" >
				      	<option value="">~ SELECT ~</option>
						<option value="0" <?php if($data[7] == 0) {
				      		echo "selected";
				      	} ?> >Direct</option>
				      	<option value="1" <?php if($data[7] == 1) {
				      		echo "selected";
				      	} ?> >Bukalapak</option>
				      	<option value="2" <?php if($data[7] == 2) {
				      		echo "selected";
				      	} ?>  >Tokopedia</option>
				      	<option value="3" <?php if($data[7] == 3) {
				      		echo "selected";
				      	} ?> >Shopee</option>
						<option value="4" <?php if($data[7] == 4) {
				      		echo "selected";
				      	} ?> >Lazada</option>
				      	<option value="5" <?php if($data[7] == 5) {
				      		echo "selected";
				      	} ?> >Elevenia</option>
				      	<option value="6" <?php if($data[7] == 6) {
				      		echo "selected";
				      	} ?>>Blanja</option>
				      	<option value="7" <?php if($data[7] == 7) {
				      		echo "selected";
				      	} ?>>JD.id</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Pengiriman</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="shipping" id="shipping">
				      	<option value="">~ SELECT ~</option>
				      	<option value="0" <?php if($data[8] == 0) {
				      		echo "selected";
				      	} ?>  >Direct</option>
				      	<option value="1" <?php if($data[8] == 1) {
				      		echo "selected";
				      	} ?> >JNE</option>
				      	<option value="2" <?php if($data[8] == 2) {
				      		echo "selected";
				      	} ?> >SiCepat</option>
						<option value="3" <?php if($data[8] == 3) {
				      		echo "selected";
				      	} ?> >Go-Send</option>
						<option value="4" <?php if($data[8] == 4) {
				      		echo "selected";
				      	} ?> >Grab Parcel</option>
						<option value="5" <?php if($data[8] == 5) {
				      		echo "selected";
				      	} ?> >NinjaExpress</option>
				      	<option value="6" <?php if($data[8] == 6) {
				      		echo "selected";
				      	} ?> >LEX</option>
				      	<option value="6" <?php if($data[8] == 7) {
				      		echo "selected";
				      	} ?> >JX Express</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-3 col-sm-10 action-order">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			      
			    </div>
			  </div>
			</form>
</div>
			<?php
		} // /get order else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	
</div> <!--/panel-->
</div> <!--/panel-->	


<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>

      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />					
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType" >
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Cheque</option>
			      	<option value="2">Cash</option>
			      	<option value="3">Credit Card</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Full Payment</option>
			      	<option value="2">Advance Payment</option>
			      	<option value="3">No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  				  
      	        
      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->

<script type="text/javascript">
$(document).ready(function() {
    $(".select2_1").select2();
    
});

</script>
<script src="http://gramtool.net/inv/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	