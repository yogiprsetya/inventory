<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manstock') { 
	echo "<div class='div-request div-hide'>manstock</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order
?>


<div id="wrapper">
	<div class="main-content">
		<div class="col-xs-12">
			
		<?php if($_GET['o'] == 'add') { ?>
  		<div class="box-content card white">
		<?php } else if($_GET['o'] == 'manstock') { ?>
			<div class="box-content">
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<div class="box-content card white">
		<?php } ?>
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>
		<h4 class="box-title">Stock Masuk</h4>
		<div class="success-messages"></div> <!--/success-messages-->
		<div class="card-content">
  		<form class="form-horizontal" method="POST" action="php_action/createStock.php" id="createStockForm">
			<div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Tanggal Masuk</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="stockDate" name="stockDate" autocomplete="off" />
			    </div>
			</div> <!--/form-group-->
			<div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Supplier</label>
			    <div class="col-sm-10">
			      	<select class="form-control" id="supplier" name="supplier">
				      	<option value="">~ SELECT ~</option>
				      	<?php 
				      	$sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
								$result = $connect->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while
								
				      	?>
				    </select>
			    </div>
			</div> <!--/form-group-->
			<table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th>Product</th>
			  			<th style="width:12%;">Stock Masuk</th>
						<th style="width:13%;">Harga</th>
						<th style="width:14%;">Sub Total</th>
			  			<th style="width:4%;"></th>
			  		</tr>
			 	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 5; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="padding-right:20px;">
			  					<div class="form-group">

			  					<select class="form-control select2_1" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~ SELECT ~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
										 	} // /while 
			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:5px;padding-right:20px;">
			  					<div class="form-group">
			  					<input type="text" name="stockMasuk[]" id="stockMasuk<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
							<td style="padding-left:5px;padding-right:18px;">
			  					<div class="form-group">
			  					<input type="text" name="harga[]" id="harga<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
							<td style="padding-left:10px;padding-right:0;">
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>
			  					<button class="btn btn-default removeProductRowBtn" style="padding:9px 15px;" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>

			  <div class="col-md-6"></div> <!--/col-md-6-->

			  <div class="col-md-6">
				  <div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control text-right" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control text-right" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				</div>						  
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-3 col-sm-10 action-order">
					<button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>
					<button type="submit" id="createStockBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
					<button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
		</div>
		<?php } else if($_GET['o'] == 'manstock') { 
			// manage order
			?>

			<h4 class="box-title">Stock Masuk</h4>
			<div class="dropdown js__drop_down">
				<a href="stock.php?o=add" type="button" class="btn btn-xs btn-primary pull-right button1"><i class="ico ico-left fa fa-plus"></i>Add Transaksi</a>
			</div>
			<div id="success-messages"></div>
			<table class="table table-striped manord" id="manageStockTable">
				<thead>
					<tr>
						<th style="width:13%">Date</th>
						<th>Supplier</th>
						<th>Qty</th>
						<th style="width:11%">Option</th>
					</tr>
				</thead>
			</table>
			

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editStock') {
			// get order
			?>
			<h4 class="box-title">Edit Stock Masuk</h4>
			<div class="success-messages"></div> <!--/success-messages-->
			<div class="card-content">
  		<form class="form-horizontal" method="POST" action="php_action/editStock.php" id="editStockForm">

  			<?php $stockId = $_GET['i'];

  			$sql = "SELECT stockmasuk.stockmasuk_id, stockmasuk.stockdate, stockmasuk.supplier, stockmasuk.grandtotal FROM stockmasuk WHERE stockmasuk.stockmasuk_id = {$stockId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();
				$selSupplier = $data[2];
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="stockDate" name="stockDate" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Supplier</label>
			    <div class="col-sm-10">
			      	<select class="form-control" id="supplier" name="supplier">
				      	<option value="">~ SELECT ~</option>
				      	<?php 
				      	$Suppliersql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
								$Supplierresult = $connect->query($Suppliersql);

								while($Supplierrow = $Supplierresult->fetch_array()) {
									$Supplierselected = "";
									if( $Supplierrow['brand_id'] == $selSupplier) {
										$Supplierselected = "selected";
									} else {
										$Supplierselected = "";
									}
									echo "<option value='".$Supplierrow[0]."' ".$Supplierselected.">".$Supplierrow[1]."</option>";
								} // while
				      	?>
				    </select>
			    </div>
			</div> <!--/form-group-->

			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th>Product</th>
			  			<th style="width:12%;">Stock Masuk</th>
						<th style="width:13%;">Harga</th>
						<th style="width:14%;">Sub Total</th>
			  			<th style="width:4%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$stockItemSql = "SELECT stockmasuk_item.stockmasuk_item_id, stockmasuk_item.stockmasuk_id, stockmasuk_item.product_id, stockmasuk_item.stockmasuk_qty, stockmasuk_item.harga, stockmasuk_item.total FROM stockmasuk_item WHERE stockmasuk_item.stockmasuk_id = {$stockId}";
						$orderItemResult = $connect->query($stockItemSql);
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
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1";
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
			  					<input type="text" name="stockMasuk[]" id="stockMasuk<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['stockmasuk_qty']; ?>" >
			  				</td>
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="text" name="harga[]" id="harga<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['harga']; ?>" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="total[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>			  					
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

			  <div class="col-md-6"></div>
			  <div class="col-md-6">
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control text-right" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $data[3] ?>"  />
				      <input type="hidden" class="form-control text-right" id="grandTotalValue" name="grandTotalValue" value="<?php echo $data[3] ?>"  />
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
        <button type="button" class="btn btn-primary" id="removeStockBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->
<script src="custom/js/stock.js"></script>

<?php require_once 'includes/footer.php'; ?>


	