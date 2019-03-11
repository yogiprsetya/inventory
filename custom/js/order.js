var manageOrderTable;

$(document).ready(function() {

	var divRequest = $(".div-request").text();

	if(divRequest == 'add')  {
		// add order
// top nav bar 
	$("#navOrder").addClass('current');
		// order date picker
		$("#orderDate").datepicker();

		// create order form function
		$("#createOrderForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var orderDate = $("#orderDate").val();
			var clientName = $("#clientName").val();
			var clientContact = $("#clientContact").val();
			var alamat = $("#alamat").val();
			var note = $("#note").val(); //note
			var platform = $("#platform").val();
			var shipping = $("#shipping").val();
			//var admin = $("#admin").val();

			// form validation 
			if(orderDate == "") {
				$('#orderDate').closest('.form-group').addClass('has-error');
			} else {
				$('#orderDate').closest('.form-group').addClass('has-success');
			} // /else

			if(clientName == "") {
				$('#clientName').closest('.form-group').addClass('has-error');
			} else {
				$('#clientName').closest('.form-group').addClass('has-success');
			} // /else

			if(clientContact == "") {
				$('#clientContact').closest('.form-group').addClass('has-error');
			} else {
				$('#clientContact').closest('.form-group').addClass('has-success');
			} // /else

			if(alamat == "") {
				$('#alamat').closest('.form-group').addClass('has-error');
			} else {
				$('#alamat').closest('.form-group').addClass('has-success');
			} //else

			if(platform == "") {
				$('#platform').closest('.form-group').addClass('has-error');
			} else {
				$('#platform').closest('.form-group').addClass('has-success');
			} // /else

			if(shipping == "") {
				$('#shipping').closest('.form-group').addClass('has-error');
			} else {
				$('#shipping').closest('.form-group').addClass('has-success');
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
	   	
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for       	
	   	

			if(orderDate && clientName && clientContact && alamat && platform && paymentStatus) {
				if(validateProduct == true && validateQuantity == true) {
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
	            	' <br /> <br /> <a href="invoice.php?&i='+response.order_id+'" class="btn btn-primary"> <i class="fa fa-address-card-o"></i> Invoice </a>'+
	            	'<a href="orders.php?o=add" class="btn btn-default" style="margin-left:10px;"> <i class="glyphicon glyphicon-plus-sign"></i> Add New Order </a>'+
	            	
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
	
	} else if(divRequest == 'manord') {
		// top nav child bar 
		$('#topNavManageOrder').addClass('current');

		manageOrderTable = $("#manageOrderTable").DataTable({
			'ajax': 'php_action/fetchOrder.php',
			'order': [0, 'desc'],
			'pageLength': 25
		});		
					
	} else if(divRequest == 'editOrd') {
		$('#topNavManageOrder').addClass('current');
		$("#orderDate").datepicker();

		// edit order form function
		$("#editOrderForm").unbind('submit').bind('submit', function() {
			// alert('ok');
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var orderDate = $("#orderDate").val();
			var clientName = $("#clientName").val();
			var clientContact = $("#clientContact").val();
			var alamat = $("#alamat").val();
			var note = $("#note").val();
			var platform = $("#platform").val();
			var shipping = $("#shipping").val();		

			// form validation 
			if(orderDate == "") {
				$('#orderDate').closest('.form-group').addClass('has-error');
			} else {
				$('#orderDate').closest('.form-group').addClass('has-success');
			} // /else

			if(clientName == "") {
				$('#clientName').closest('.form-group').addClass('has-error');
			} else {
				$('#clientName').closest('.form-group').addClass('has-success');
			} // /else

			if(clientContact == "") {
				$('#clientContact').closest('.form-group').addClass('has-error');
			} else {
				$('#clientContact').closest('.form-group').addClass('has-success');
			} // /else

			if(alamat == "") {
				$('#alamat').closest('.form-group').addClass('has-error');
			} else {
				$('#alamat').closest('.form-group').addClass('has-success');
			} //else

			// if(note == "") {
				// $('#note').closest('.form-group').addClass('has-error');
			// } else {
				// $('#note').closest('.form-group').addClass('has-success');
			// } // /else

			if(platform == "") {
				$('#platform').closest('.form-group').addClass('has-error');
			} else {
				$('#platform').closest('.form-group').addClass('has-success');
			} // /else

			if(shipping == "") {
				$('#shipping').closest('.form-group').addClass('has-error');
			} else {
				$('#shipping').closest('.form-group').addClass('has-success');
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
	   	
	   	var quantity = document.getElementsByName('quantity[]');		   	
	   	var validateQuantity;
	   	for (var x = 0; x < quantity.length; x++) {       
	 			var quantityId = quantity[x].id;
		    if(quantity[x].value == ''){	    	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+quantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < quantity.length; x++) {       						
		    if(quantity[x].value){	    		    		    	
		    	validateQuantity = true;
	      } else {      	
		    	validateQuantity = false;
	      }          
	   	} // for       	
	   	
			if(orderDate && clientName && clientContact && alamat && platform && shipping) {
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
					' <br /> <br /> <a type="button" href="orders.php?o=manord" class="btn btn-default"> <i class="fa fa-tasks"></i> Manage Order </a>'+					
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


// print order function
function printOrder(orderId = null) {
	if(orderId) {		
			
		$.ajax({
			url: 'php_action/printOrder.php',
			type: 'post',
			data: {orderId: orderId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Order Invoice</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
	} // /if orderId
} // /print order function

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
		data: {},
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
				'<td style="padding-left:20px;"">'+
					'<input type="text" name="rate[]" id="rate'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
					'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td style="padding-left:20px;">'+
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+
					'<input type="text" name="quantity[]" id="quantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
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
			$("#rate"+row).val("");

			$("#quantity"+row).val("");						
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
					
					$("#rate"+row).val(response.rate);
					$("#rateValue"+row).val(response.rate);

					$("#quantity"+row).val(1);

					var total = Number(response.rate) * 1;
					total = total.toFixed();
					$("#total"+row).val(total);
					$("#totalValue"+row).val(total);
					
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

// table total
function getTotal(row = null) {
	if(row) {
		var total = Number($("#rate"+row).val()) * Number($("#quantity"+row).val());
		total = total.toFixed();
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
		
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
function removeOrder(orderId = null) {
	if(orderId) {
		$("#removeOrderBtn").unbind('click').bind('click', function() {
			$("#removeOrderBtn").button('loading');

			$.ajax({
				url: 'php_action/removeOrder.php',
				type: 'post',
				data: {orderId : orderId},
				dataType: 'json',
				success:function(response) {
					$("#removeOrderBtn").button('reset');

					if(response.success == true) {

						manageOrderTable.ajax.reload(null, false);
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
// /remove order from server

// // Payment ORDER
// function paymentOrder(orderId = null) {
	// if(orderId) {

		// $("#orderDate").datepicker();

		// $.ajax({
			// url: 'php_action/fetchOrderData.php',
			// type: 'post',
			// data: {orderId: orderId},
			// dataType: 'json',
			// success:function(response) {				

				// // due 
				// $("#due").val(response.order[10]);				

				// // pay amount 
				// $("#payAmount").val(response.order[10]);

				// var paidAmount = response.order[9] 
				// var dueAmount = response.order[10];							
				// var grandTotal = response.order[8];

				// // update payment
				// $("#updatePaymentOrderBtn").unbind('click').bind('click', function() {
					// var payAmount = $("#payAmount").val();
					// var platform = $("#platform").val();
					// var paymentStatus = $("#paymentStatus").val();

					// if(payAmount == "") {
						// $("#payAmount").after('<p class="text-danger">The Pay Amount field is required</p>');
						// $("#payAmount").closest('.form-group').addClass('has-error');
					// } else {
						// $("#payAmount").closest('.form-group').addClass('has-success');
					// }

					// if(platform == "") {
						// $("platform").after('<p class="text-danger">The Pay Amount field is required</p>');
						// $("#platform").closest('.form-group').addClass('has-error');
					// } else {
						// $("#platform").closest('.form-group').addClass('has-success');
					// }

					// if(paymentStatus == "") {
						// $("#paymentStatus").after('<p class="text-danger">The Pay Amount field is required</p>');
						// $("#paymentStatus").closest('.form-group').addClass('has-error');
					// } else {
						// $("#paymentStatus").closest('.form-group').addClass('has-success');
					// }

					// if(payAmount && platform && paymentStatus) {
						// $("#updatePaymentOrderBtn").button('loading');
						// $.ajax({
							// url: 'php_action/editPayment.php',
							// type: 'post',
							// data: {
								// orderId: orderId,
								// payAmount: payAmount,
								// platform: platforme,
								// paymentStatus: paymentStatus,
								// paidAmount: paidAmount,
								// grandTotal: grandTotal
							// },
							// dataType: 'json',
							// success:function(response) {
								// $("#updatePaymentOrderBtn").button('loading');

								// // remove error
								// $('.text-danger').remove();
								// $('.form-group').removeClass('has-error').removeClass('has-success');

								// $("#paymentOrderModal").modal('hide');

								// $("#success-messages").html('<div class="alert alert-success">'+
			            // '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            // '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          // '</div>');

								// // remove the mesages
			          // $(".alert-success").delay(500).show(10, function() {
									// $(this).delay(3000).hide(10, function() {
										// $(this).remove();
									// });
								// }); // /.alert	

			          // // refresh the manage order table
								// manageOrderTable.ajax.reload(null, false);

							// } //

						// });
					// } // /if
						
					// return false;
				// }); // /update payment			

			// } // /success
		// }); // fetch order data
	// } else {
		// alert('Error ! Refresh the page again');
	// }
// }
