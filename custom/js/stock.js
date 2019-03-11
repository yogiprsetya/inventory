var manageStockTable;

$(document).ready(function() {

	var divRequest = $(".div-request").text();
	$("#navStock").addClass('current');
	$(".select2_1").select2();

	if(divRequest == 'add')  {
		// order date picker
		$("#stockDate").datepicker();

		// create order form function
		$("#createStockForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var stockDate = $("#stockDate").val();
			var supplier = $("#supplier").val();

			// form validation 
			if(stockDate == "") {
				$('#stockDate').closest('.form-group').addClass('has-error');
			} else {
				$('#stockDate').closest('.form-group').addClass('has-success');
			} // /else

			if(supplier == "") {
				$('#supplier').closest('.form-group').addClass('has-error');
			} else {
				$('#supplier').closest('.form-group').addClass('has-success');
			} // /else

			// array validation
			var productName = document.getElementsByName('productName[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;	    	
		    if(productName[x].value == ''){
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < productName.length; x++) {       						
		    if(productName[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
	   	} // for       		   	
	   	
	   	var stockMasuk = document.getElementsByName('stockMasuk[]');		   	
	   	var validatestockMasuk;
	   	for (var x = 0; x < stockMasuk.length; x++) {       
	 			var stockMasukId = stockMasuk[x].id;
		    if(stockMasuk[x].value == ''){
		    	$("#"+stockMasukId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+stockMasukId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < stockMasuk.length; x++) {       						
		    if(stockMasuk[x].value){    		    		    	
		    	validatestockMasuk = true;
	      } else {
		    	validatestockMasuk = false;
	      }          
	   	} // for
		
		var harga = document.getElementsByName('harga[]');		   	
	   	var validateharga;
	   	for (var x = 0; x < harga.length; x++) {       
	 			var hargaId = harga[x].id;
		    if(harga[x].value == ''){
		    	$("#"+hargaId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+hargaId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < harga.length; x++) {       						
		    if(harga[x].value){	    		    		    	
		    	validateharga = true;
	      } else {      	
		    	validateharga = false;
	      }          
	   	} // for       	
	   	

			if(stockDate && supplier) {
				if(validateProduct == true && validatestockMasuk == true && validateharga == true) {
					// create order button
					//$("#createOrderBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	            	' <br /> <br /> <a href="stock.php" class="btn btn-primary"> <i class="fa fa-sign-in"></i> Manage </a>'+
	            	'<a href="stock.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Order </a>'+
	            	
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".submitButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /create order form function	
	
	} else if(divRequest == 'manstock') {

		manageStockTable = $("#manageStockTable").DataTable({
			'ajax': 'php_action/fetchStock.php',
			'order': []
		});		
					
	} else if(divRequest == 'editStock') {
		$("#orderDate").datepicker();

		// edit order form function
		$("#editStockForm").unbind('submit').bind('submit', function() {
			// alert('ok');
			var form = $(this);

			var stockDate = $("#stockDate").val();
			var supplier = $("#supplier").val();

			// form validation 
			if(stockDate == "") {
				$('#stockDate').closest('.form-group').addClass('has-error');
			} else {
				$('#stockDate').closest('.form-group').addClass('has-success');
			} // /else

			if(supplier == "") {
				$('#supplier').closest('.form-group').addClass('has-error');
			} else {
				$('#supplier').closest('.form-group').addClass('has-success');
			} // /else

			// array validation
			var productName = document.getElementsByName('productName[]');				
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {       			
				var productNameId = productName[x].id;	    	
		    if(productName[x].value == ''){
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < productName.length; x++) {       						
		    if(productName[x].value){	    		    		    	
		    	validateProduct = true;
	      } else {      	
		    	validateProduct = false;
	      }          
	   	} // for       		   	
	   	
	   	var stockMasuk = document.getElementsByName('stockMasuk[]');		   	
	   	var validatestockMasuk;
	   	for (var x = 0; x < stockMasuk.length; x++) {       
	 			var stockMasukId = stockMasuk[x].id;
		    if(stockMasuk[x].value == ''){
		    	$("#"+stockMasukId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+stockMasukId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < stockMasuk.length; x++) {       						
		    if(stockMasuk[x].value){    		    		    	
		    	validatestockMasuk = true;
	      } else {
		    	validatestockMasuk = false;
	      }          
	   	} // for
		
		var harga = document.getElementsByName('harga[]');		   	
	   	var validateharga;
	   	for (var x = 0; x < harga.length; x++) {       
	 			var hargaId = harga[x].id;
		    if(harga[x].value == ''){
		    	$("#"+hargaId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+hargaId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < harga.length; x++) {       						
		    if(harga[x].value){	    		    		    	
		    	validateharga = true;
	      } else {      	
		    	validateharga = false;
	      }          
	   	} // for
	   	

			if(orderDate && clientName && clientContact && platform && shipping) {
				if(validateProduct == true && validateQuantity == true) {
					// create order button
					// $("#createOrderBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#editOrderBtn").button('reset');
							
							$(".text-danger").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
	            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            	'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
					' <br /> <br /> <a type="button" href="stock.php?o=manstock" class="btn btn-default"> <i class="fa fa-tasks"></i> Manage Order </a>'+					
	   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							$(".editButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /edit order form function	
	} 	

}); // /documernt

function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: 'php_action/fetchProductData.php',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				
				'<td>'+
					'<div class="form-group">'+

					'<select class="form-control select2_1" name="productName[]" id="productName'+count+'" onchange="getProductData('+count+')" >'+
						'<option value="">~ SELECT ~</option>';
						// console.log(response);
						$.each(response, function(index, value) {
							tr += '<option value="'+value[0]+'">'+value[1]+'</option>';							
						});
													
					tr += '</select>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+
					'<input type="text" name="stockMasuk[]" id="stockMasuk'+count+'" onkeyup="getRestock('+count+')" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:5px;padding-right:18px;">'+
			  		'<div class="form-group">'+
			  		'<input type="text" name="harga[]" id="harga<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />'+
			  		'</div>'+
			  	'</td>'+
				'<td style="padding-left:10px;padding-right:0;">'+
  					'<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />'+
  					'<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />'+
  				'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" style="padding:9px 15px;" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

// select on product data
function getProductData(row = null) {
	if(row) {
		var productId = $("#productName"+row).val();
		
		if(productId == "") {
			$("#stockMasuk"+row).val("");
			$("#harga"+row).val("");						
			$("#total"+row).val("");

			// remove check if product name is selected
			// var tableProductLength = $("#productTable tbody tr").length;			
			// for(x = 0; x < tableProductLength; x++) {
			// 	var tr = $("#productTable tbody tr")[x];
			// 	var count = $(tr).attr('id');
			// 	count = count.substring(3);

			// 	var productValue = $("#productName"+row).val()

			// 	if($("#productName"+count).val() == "") {					
			// 		$("#productName"+count).find("#changeProduct"+productId).removeClass('div-hide');	
			// 		console.log("#changeProduct"+count);
			// 	}											
			// } // /for

		} else {
			$.ajax({
				url: 'php_action/fetchSelectedProduct.php',
				type: 'post',
				data: {productId : productId},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field

					$("#stockMasuk"+row).val(1);

					var total = Number(response.quantity) + 1;
					total = total.toFixed();
					
					// check if product name is selected
					// var tableProductLength = $("#productTable tbody tr").length;					
					// for(x = 0; x < tableProductLength; x++) {
					// 	var tr = $("#productTable tbody tr")[x];
					// 	var count = $(tr).attr('id');
					// 	count = count.substring(3);

					// 	var productValue = $("#productName"+row).val()

					// 	if($("#productName"+count).val() != productValue) {
					// 		// $("#productName"+count+" #changeProduct"+count).addClass('div-hide');	
					// 		$("#productName"+count).find("#changeProduct"+productId).addClass('div-hide');								
					// 		console.log("#changeProduct"+count);
					// 	}											
					// } // /for
			
					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data

// table Restock
// function getRestock(row = null) {
	// if(row) {
		// var total = Number($("#stock"+row).val()) + Number($("#stockMasuk"+row).val());
		// total = total.toFixed();
		// $("#restock"+row).val(total);
		// $("#restockValue"+row).val(total);
		
		// var total = Number($("#stockMasuk"+row).val()) * Number($("#harga"+row).val());
		// total = total.toFixed();
		// $("#subTotal"+row).val(total);
		// $("#subTotalValue"+row).val(total);
		
		// subAmount();

	// } else {
		// alert('no row !! please refresh the page');
	// }
// }
// table total
function getTotal(row = null) {
	if(row) {
		var total = Number($("#stockMasuk"+row).val()) * Number($("#harga"+row).val());
		total = total.toFixed();
		$("#total"+row).val(total);
		$("#total"+row).val(total);
		
		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed();

	// sub total
	$("#grandTotal").val(totalSubAmount);
	$("#grandTotalValue").val(totalSubAmount);

	// total amount
	// var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
	// totalAmount = totalAmount.toFixed(2);
	// $("#totalAmount").val(totalAmount);
	// $("#totalAmountValue").val(totalAmount);

	// var discount = $("#discount").val();
	// if(discount) {
		// var grandTotal = Number($("#totalAmount").val()) - Number(discount);
		// grandTotal = grandTotal.toFixed(2);
		// $("#grandTotal").val(grandTotal);
		// $("#grandTotalValue").val(grandTotal);
	// } else {
		// $("#grandTotal").val(totalAmount);
		// $("#grandTotalValue").val(totalAmount);
	// } // /else discount	

	// var paidAmount = $("#paid").val();
	// if(paidAmount) {
		// paidAmount =  Number($("#grandTotal").val()) - Number(paidAmount);
		// paidAmount = paidAmount.toFixed(2);
		// $("#due").val(paidAmount);
		// $("#dueValue").val(paidAmount);
	// } else {	
		// $("#due").val($("#grandTotal").val());
		// $("#dueValue").val($("#grandTotal").val());
	// } // else

} // /sub total amount

// function discountFunc() {
	// var discount = $("#discount").val();
 	// var totalAmount = Number($("#totalAmount").val());
 	// totalAmount = totalAmount.toFixed(2);

 	// var grandTotal;
 	// if(totalAmount) { 	
 		// grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
 		// grandTotal = grandTotal.toFixed(2);

 		// $("#grandTotal").val(grandTotal);
 		// $("#grandTotalValue").val(grandTotal);
 	// } else {
 	// }

 	// var paid = $("#paid").val();

 	// var dueAmount; 	
 	// if(paid) {
 		// dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
 		// dueAmount = dueAmount.toFixed(2);

 		// $("#due").val(dueAmount);
 		// $("#dueValue").val(dueAmount);
 	// } else {
 		// $("#due").val($("#grandTotal").val());
 		// $("#dueValue").val($("#grandTotal").val());
 	// }

//} // /discount function

//function paidAmount() {
	// var grandTotal = $("#grandTotal").val();

	// if(grandTotal) {
		// var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
		// dueAmount = dueAmount.toFixed(2);
		// $("#due").val(dueAmount);
		// $("#dueValue").val(dueAmount);
	// } // /if
// } // /paid amoutn function


function resetOrderForm() {
	// reset the input field
	$("#createOrderForm")[0].reset();
	// remove remove text danger
	$(".text-danger").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
} // /reset order form


// remove order from server
function removeStock(stockId = null) {
	if(stockId) {
		$("#removeStockBtn").unbind('click').bind('click', function() {
			$("#removeStockBtn").button('loading');

			$.ajax({
				url: 'php_action/removeStock.php',
				type: 'post',
				data: {stockId : stockId},
				dataType: 'json',
				success:function(response) {
					$("#removeStockBtn").button('reset');

					if(response.success == true) {

						manageStockTable.ajax.reload(null, false);
						// hide modal
						$("#removeOrderModal").modal('hide');
						// success messages
						$("#success-messages").html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          

					} else {
						// error messages
						$(".removeOrderMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			});  // /ajax function to remove the order

		}); // /remove order button clicked
		

	} else {
		alert('error! refresh the page again');
	}
}