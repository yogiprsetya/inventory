var dataCustomerTable;

$(document).ready(function() {
	// top bar active
	$('#navCust').addClass('current');
	
	// manage brand table
	dataCustomerTable = $("#dataCustomerTable").DataTable({
		'ajax': 'php_action/fetchDataCustomer.php',
		'order': [],
		'pageLength': 100
	});
});