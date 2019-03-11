var manageQnaTable;

$(document).ready(function() {
	// active top navbar categories
	$('#navAdmin').addClass('current');
	
	var element = document.getElementById('editPenanganan');
	function replaceNewlines(e) {
		this.value = this.value.replace(/<br\s*\/?>/g, '');
	}
	element.onfocus = replaceNewlines;
	
	$('#editQnaModal').on('shown.bs.modal', function () {
		$("#editPenanganan").focus();
	});

	manageQnaTable = $('#manageQnaTable').DataTable({
		'ajax' : 'php_action/fetchQna.php',
		'order': [],
		//'bLengthChange': false,
		'paging': !1,
        // 'ordering': false,
        'info': false,
        'scrollY': "400px",
        'scrollCollapse': !0,
        'columnDefs': [{ 'searchable': false, 'targets': [1,2]}],
	}); // manage categories Data Table
	
	$('th', '#labels').each( function(i) {
    if ($(this).hasClass( 'filter' )) {
        $('td', '#filter').eq(i)
          .html( fnCreateSelect(oTable.fnGetColumnData(i)) )
          .find('select')
          .change(function () { oTable.fnFilter($(this).val(), i); });
    }
    });    

	// on click on submit categories form modal
	$('#addQnaModalBtn').unbind('click').bind('click', function() {
		// reset the form text
		$("#submitQnaForm")[0].reset();
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// submit categories form function
		$("#submitQnaForm").unbind('submit').bind('submit', function() {

			var kondisi = $("#kondisi").val();
			var penanganan = $("#penanganan").val();

			if(kondisi == "") {
				$('#kondisi').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#kondisi").find('.text-danger').remove();
				// success out for form 
				$("#kondisi").closest('.form-group').addClass('has-success');	  	
			}

			if(penanganan == "") {
				$("#penanganan").after('<p class="text-danger">Brand Name field is required</p>');
				$('#penanganan').closest('.form-group').addClass('has-error');
			} else {
				// remov error text field
				$("#penanganan").find('.text-danger').remove();
				// success out for form 
				$("#penanganan").closest('.form-group').addClass('has-success');	  	
			}

			if(kondisi && penanganan) {
				var form = $(this);
				// button loading
				$("#createQnaBtn").button('loading');

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success:function(response) {
						// button loading
						$("#createQnaBtn").button('reset');

						if(response.success == true) {
							// reload the manage member table 
							manageQnaTable.ajax.reload(null, false);						

	  	  			// reset the form text
							$("#submitQnaForm")[0].reset();
							// remove the error text
							$(".text-danger").remove();
							// remove the form error
							$('.form-group').removeClass('has-error').removeClass('has-success');
	  	  			
	  	  			$('#add-qna-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
						}  // if

					} // /success
				}); // /ajax	
			} // if

			return false;
		}); // submit categories form function
	}); // /on click on submit categories form modal	

}); // /document

// edit categories function
function editQna(QnaId = null) {
	if(QnaId) {
		// remove the added categories id 
		$('#editQnaId').remove();
		// reset the form text
		$("#editQnaForm")[0].reset();
		// reset the form text-error
		$(".text-danger").remove();
		// reset the form group errro		
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// edit categories messages
		$("#edit-qna-messages").html("");
		// modal spinner
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-qna-result').addClass('div-hide');
		//modal footer
		$(".editqnaFooter").addClass('div-hide');		

		$.ajax({
			url: 'php_action/fetchSelectedQna.php',
			type: 'post',
			data: {QnaId: QnaId},
			dataType: 'json',
			success:function(response) {

				// modal spinner
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-qna-result').removeClass('div-hide');
				//modal footer
				$(".editQnaFooter").removeClass('div-hide');	

				// set the categories name
				$("#editQnaName").val(response.kondisi);
				// set the categories status
				$("#editPenanganan").val(response.penanganan);
				// add the categories id 
				$(".editQnaFooter").after('<input type="hidden" name="editQnaId" id="editQnaId" value="'+response.qna_id+'" />');


				// submit of edit categories form
				$("#editQnaForm").unbind('submit').bind('submit', function() {
					var kondisi = $("#editQnaName").val();
					var penanganan = $("#editPenanganan").val();

					if(kondisi == "") {
						$('#editQnaName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editQnaName").find('.text-danger').remove();
						// success out for form 
						$("#editQnaName").closest('.form-group').addClass('has-success');	  	
					}

					if(penanganan == "") {
						$('#editPenanganan').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editPenanganan").find('.text-danger').remove();
						// success out for form 
						$("#editPenanganan").closest('.form-group').addClass('has-success');	  	
					}

					if(kondisi && penanganan) {
						var form = $(this);
						// button loading
						$("#editQnaBtn").button('loading');

						$.ajax({
							url : form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {
								// button loading
								$("#editQnaBtn").button('reset');

								if(response.success == true) {
									// reload the manage member table 
									manageQnaTable.ajax.reload(null, false);									  	  			
									
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');
			  	  			
			  	  			$('#edit-qna-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								}  // if

							} // /success
						}); // /ajax	
					} // if


					return false;
				}); // /submit of edit categories form

			} // /success
		}); // /fetch the selected categories data

	} else {
		alert('Oops!! Refresh the page');
	}
} // /edit categories function

// remove categories function
function removeQna(QnaId = null) {
		
	$.ajax({
		url: 'php_action/fetchSelectedQna.php',
		type: 'post',
		data: {QnaId: QnaId},
		dataType: 'json',
		success:function(response) {			

			// remove categories btn clicked to remove the categories function
			$("#removeQnaBtn").unbind('click').bind('click', function() {
				// remove categories btn
				$("#removeQnaBtn").button('loading');

				$.ajax({
					url: 'php_action/removeQna.php',
					type: 'post',
					data: {QnaId: QnaId},
					dataType: 'json',
					success:function(response) {
						if(response.success == true) {
 							// remove categories btn
							$("#removeQnaBtn").button('reset');
							// close the modal 
							$("#removeQnaModal").modal('hide');
							// update the manage categories table
							manageQnaTable.ajax.reload(null, false);
							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} else {
 							// close the modal 
							$("#removeQnaModal").modal('hide');

 							// udpate the messages
							$('.remove-messages').html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

	  	  			$(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert
 						} // /else
						
						
					} // /success function
				}); // /ajax function request server to remove the categories data
			}); // /remove categories btn clicked to remove the categories function

		} // /response
	}); // /ajax function to fetch the categories data
} // remove categories function

function copyToClipboard(element) {
  var $temp = $("<textarea>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}