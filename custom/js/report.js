$(document).ready(function() {
	$('#navReport').addClass('current');
	// order date picker
	$("#startDate").datepicker();
	// order date picker
	$("#endDate").datepicker();

	$("#getOrderReportForm").unbind('submit').bind('submit', function() {
		
		var startDate = $("#startDate").val();
		var endDate = $("#endDate").val();

		if(startDate == "" || endDate == "") {
			if(startDate == "") {
				$("#startDate").closest('.form-group').addClass('has-error');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}

			if(endDate == "") {
				$("#endDate").closest('.form-group').addClass('has-error');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}
		} else {
			//$(".form-group").removeClass('has-error');
			//$(".text-danger").remove();
			return submit;

		} // /else

		return false;
	});

});